<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Topic_model');
        $this->load->model('User_model');
        $this->load->model('Auth_model');
        $data = $this->Auth_model->getOauth('facebook');

        $this->load->library('Facebook');
        $this->fb = new Facebook\Facebook([
            'app_id' => $data->app_id,
            'app_secret' => $data->app_secret,
            'default_graph_version' => 'v2.4',
        ]);
    }

    public function index($mode = null, $id = null)
    {
        //檢查登入
        if( ! isset($_SESSION['uid']) ){
            redirect( base_url().'Signin' );
        }
        //HEAD
        $this->Auth_model->getAuthStat();        
        $tags = $this->Topic_model->getTags();
        $this->load->view('template/head.php', array('tags' => $tags) );

        //TAGS
        $i = 0;
        $tags_num_rows = count($tags);
        foreach( $tags as $row ){
            if( $i == 0 ){
                $tags_string = "'$row->tag',";
            }
            else if( $i == $tags_num_rows-1 ){
                $tags_string .= "'$row->tag'";
            }
            else{
                $tags_string .= "'$row->tag',";
            }
            $i++;
        }
        //流程控制
        switch (strtolower($mode)) {
            case 'add':
                $output = array
                (
                    'url' => base_url().'Article/do/add',
                    'mode' => 'add',
                    'tags' => $tags_string
                );
                break;
            case 'reply':
                if( ! $data = $this->Topic_model->getArticle($id) ){
                    show_error('提取文章'.'時發生錯誤<br>'.$this->db->error());
                }
                $output = array
                (
                    'url' => base_url().'Article/do/reply/'.$id,
                    'mode' => 'reply',
                    'tags' => $tags_string,
                    'topicname' => $data->topicname,
                    'tag' => $data->tag
                );
                break;
            case 'edit':
                if( ! $data = $this->Topic_model->getArticle($id) ){
                    show_error('提取文章'.'時發生錯誤<br>'.$this->db->error());
                }
                if( $_SESSION['uid'] != $data->uid ){
                    show_error('無法編輯這篇文章');
                }
                $output = array
                (
                    'url' => base_url().'Article/do/edit/'.$id,
                    'mode' => 'reply',
                    'tags' => $tags_string,
                    'topicname' => $data->topicname,
                    'tag' => $data->tag,
                    'edit_time' => $data->edit_time,
                    'views' => $data->views,
                    'content' => html_entity_decode($data->content),
                    'photo_addr' => $data->photo_addr
                );
                break;
        }
        $this->load->view('article/article_editor.php', $output);
        $this->load->view('template/footer.php');
    }



    public function getInputContent($keys, $prefix = null, $admin_mode = false)
    {
        $output = array();
        $keys = explode(',',$keys);
        if( in_array('all', $keys) ){
            $keys = explode(',', 'aid,uid,topicname,content,tag,photo_addr,edit_time,views,ano');
        }

        foreach( $keys as $key ){
            //GET
            $content = $this->input->post($prefix.$key);
            //後處理
            //$content = $this->db->escape($content);
            //儲存
            $output[$key] = $content;
        }
        return $output;
    }

    public function checkContents($keys, $data)
    {
        $keys = explode(',',$keys);
        if( in_array('all', $keys) ){
            $keys = explode(',', 'aid,uid,topicname,content,tag,photo_addr,edit_time,views,ano');
        }
        
        foreach( $keys as $key ){
            if( $key == 'views' )
                if( $data[$key] < 0 ){
                    $data[$key] = 0;
                    break;
                }

            if( ! $data[$key] ){
                return FALSE;
            }
        }
        return TRUE;
    }

    public function setOutputContent($keys, $data, $admin_mode = false)
    {
        $output = $data;
        $keys = explode(',',$keys);
        if( in_array('all', $keys) ){
            $keys = explode(',', 'aid,uid,topicname,content,tag,photo_addr,edit_time,views,ano');
        }
    
        if( TRUE ){
            //慣例
            foreach( $keys as $key ){
                if( isset($output[$key]) ){
                    if( $output[$key] == FALSE ){
                        //用在處理 使用者可以設定，但卻沒輸入資料的值
                        switch ($key) {
                            case 'tag':
                                $output[$key] = 'Allpost';
                                break;
                            case 'edit_time':
                                date_default_timezone_set('Asia/Taipei');
                                $output[$key] = date("Y-m-d h:i:s", time());
                                break;
                            case 'views':
                                $output[$key] = 0;
                                break;
                        }//switch
                    }//if == FALSE
                }//if isset
                else{
                    //用在處理 getPOST時 我們不會去抓，使用者也無權設定的值
                    switch ($key) {
                        case 'aid':
                            $output[$key] = null;
                            break;
                        case 'uid':
                            $output[$key] = $_SESSION['uid'];
                            break;
                        default:
                            $output[$key] = null;
                            break;
                    }//switch
                }//else
            }//foreach
        }
        return $output;
    }


    public function add()
    {
        //檢查登入
        if( ! isset($_SESSION['uid']) ){
            redirect( base_url().'Signin' );
        }
        /*
            1. 根據模式取得輸入資料 (getInputContent)
            2. 檢查一定要輸入的欄位有沒有輸入 (checkContents)
            3. 產生要塞進資料庫的資料
               一併把 需要但使用者無權決定的資料、需要且使用者有權力決定但卻沒有輸入的資料補齊 (setOutputContent)

            getInputContent : keys : 需要取得的欄位資料
            checkContents   : keys : 需要檢查的必填欄位
            setOutputContent: keys : 必須存在以便塞進資料庫的欄位

         */
        //取得資料
        if( (int)$_SESSION['rid'] == 4 ){
            //特權模式
            $data = $this->getInputContent('topicname,content,tag,photo_addr,edit_time,views,ano', 'article_', false);

            //檢查資料
            if( ! $this->checkContents('topicname,content', $data)){
                echo json_encode(array( 'redirect_url' => base_url().'error' ));
                exit();
            }
            $data = $this->setOutputContent('all', $data, false);
        }
        else{
            //一般帳號
            $data = $this->getInputContent('topicname,content,tag,photo_addr,ano', 'article_', false);

            if( ! $this->checkContents('topicname,content', $data)){
                echo json_encode(array( 'redirect_url' => base_url().'error' ));
                exit();
            }
            $data = $this->setOutputContent('all', $data, false);
        }
        
        //輸入資料
        if( $this->Topic_model->addArticle($data) )
        {
            $aid = $this->Topic_model->getInsertedArticle(array('uid' =>$_SESSION['uid']));
            echo json_encode(array( 'redirect_url' => base_url().'Topic/'.$aid ));
        }
        else
        {
            echo json_encode(array( 'redirect_url' => base_url().'error' ));
        }
    }





    public function reply($aid)
    {
        //檢查登入
        if( ! isset($_SESSION['uid']) ){
            redirect( base_url().'Signin' );
        }
        //取得資料
        if( (int)$_SESSION['rid'] == 4 ){
            $data = $this->getInputContent('content,edit_time,views,ano', 'article_', false);

            if( ! $this->checkContents('content', $data)){
                echo json_encode(array( 'redirect_url' => base_url().'error' ));
                exit();
            }
        }
        else{
            $data = $this->getInputContent('content,ano', 'article_', false);

            if( ! $this->checkContents('content', $data)){
                echo json_encode(array( 'redirect_url' => base_url().'error' ));
                exit();
            }
        }
        if( ! $article = $this->Topic_model->getArticle($aid) ){
            echo json_encode(array( 'redirect_url' => base_url().'error' ));
            exit();
        }

        $data = $this->setOutputContent('all', $data, false);
        //從 aid抓與article的資料來覆蓋
        $data['topicname'] = $article->topicname;
        $data['tag'] = $article->tag;

        if( $this->Topic_model->addArticle($data) )
        {
            $aid = $this->Topic_model->getInsertedArticle(array('uid' =>$_SESSION['uid']));
            echo json_encode(array( 'redirect_url' => base_url().'Topic/'.$aid ));
        }
        else
        {
            echo json_encode(array( 'redirect_url' => base_url().'error' ));
        }
    }






    public function edit($aid)
    {
        //檢查登入
        if( ! isset($_SESSION['uid']) ){
            redirect( base_url().'Signin' );
        }
        //取得資料
        if( (int)$_SESSION['rid'] == 4 ){
            $data = $this->getInputContent('topicname,content,tag,photo_addr,edit_time,views,ano', 'article_', false);

            if( ! $this->checkContents('topicname,content,tag,edit_time', $data)){
                echo json_encode(array( 'redirect_url' => base_url().'error' ));
                exit();
            }
            $data = $this->setOutputContent('topicname,content,tag,photo_addr,edit_time,views,ano', $data, false);
        }
        else{
            $data = $this->getInputContent('content,tag,photo_addr,ano', 'article_', false);

            if( ! $this->checkContents('content', $data)){
                echo json_encode(array( 'redirect_url' => base_url().'error' ));
                exit();
            }
            $data = $this->setOutputContent('edit_time,tag,photo_addr,content,ano', $data, false);
        }

        $where = " aid='".$aid."' ";

        if( $this->Topic_model->updateArticle($data, $where) )
        {
            $aid = $this->Topic_model->getInsertedArticle(array('uid' =>$_SESSION['uid']));
            echo json_encode(array( 'redirect_url' => base_url().'Topic/'.$aid ));
        }
        else
        {
            echo json_encode(array( 'redirect_url' => base_url().'error' ));
        }
    }
}