<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topic extends CI_Controller {

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



    public function getTopics($mode = 'latest', $index = 0, $limit = 10)
    {
        $this->Auth_model->getAuthStat();        
        $output = array('tags' => $this->Topic_model->getTags());
        $this->load->view('template/head.php', $output);

        $mode = strtolower((String)$mode);
        $index = (int)$index;
        $limit = (int)$limit;

        if( $index < 0 ){
            $index = 0;
        }
        if( $limit <=0 ){
            $limit = 10;
        }

        $data = $this->Topic_model->getTopics($mode, $index, $limit);

    	$output = array
        (
            'topics' => $data,
            'mode' => $mode,
            'limit' => $limit,
            'index' => $index
        );
    	$this->load->view('topic/topic_list.php', $output);
    	$this->load->view('template/footer.php');
    }

    public function getSpecifiedTopics($mode = 'tag', $index = 0, $limit = 10, $keys = null)
    {
        $this->Auth_model->getAuthStat();        
        $output = array('tags' => $this->Topic_model->getTags());
        $this->load->view('template/head.php', $output);

        if( ! $keys_a = $this->input->post('q') ){
            $keys_a = $this->input->get('q');
            $encoding = $this->input->get('encoding');

            if( isset($encoding) ){
                if( $encoding == 'b64' ){
                    $keys_a = base64_decode($keys_a);
                }
            }
        }

        $keys_b = explode(' ',$keys_a);
        $mode = strtolower((String)$mode);
        $index = (int)$index;
        $limit = (int)$limit;

        if( $index < 0 ){
            $index = 0;
        }
        if( $limit <=0 ){
            $limit = 10;
        }

        $data = $this->Topic_model->getSpecifiedTopics($mode, $limit, $index, $keys_b);

        $output = array
        (
            'topics' => $data,
            'mode' => $mode,
            'limit' => $limit,
            'index' => $index,
            'keys' => $keys_a
        );
        $this->load->view('topic/topic_list.php', $output);
        $this->load->view('template/footer.php');
    }



	public function getThread($aid)
	{
        //GET ARTICLE BY AID
        if( ! $article = $this->Topic_model->getArticle( $aid ) ){
            show_error('提取目標文章'.'時發生錯誤<br>'.$this->db->error());
            exit();
        }
        $topicname = $article->topicname;
        $first_article_aid = $this->Topic_model->getFirstArticleID($topicname);
        //重新導向到topicname底下第一篇文章
        if( (int)$aid != (int)$first_article_aid ){
            redirect(base_url().'Topic/'.$first_article_aid);
            exit();
        }
        //GET THREAD BY NAME
        if( ! $articles = $this->Topic_model->getThread( $topicname ) ){
            show_error('取得討論串'.'時發生錯誤<br>'.$this->db->error());
            exit();
        }

        $this->Auth_model->getAuthStat();        
        $output = array('tags' => $this->Topic_model->getTags(), 'topicname'=>$topicname);
        $this->load->view('template/head.php', $output);

        $i = 0;
		foreach( $articles as $row ){
            if( $i == 0 ){
                //首篇文章時抓取資料
                $photo_addr = $row->topic_photo_addr;
                $views = $row->views;
                //瀏覽數更新
                $value = array('views' => (int)($views)+1);
                $where = "aid='".$row->aid."'";
                if( ! $this->Topic_model->updateArticle($value, $where) ){
                    show_error('瀏覽數更新'.'時發生錯誤<br>'.$this->db->error());
                    exit();
                }
            }
            //發文者文章總數
            if( ! $row->num_topics = $this->User_model->getNum_post( $row->uid ) ){
                show_error('計算文章總數'.'時發生錯誤<br>'.$this->db->error());
                exit();
            }
            //HTML解碼
            $row->content = html_entity_decode($row->content);
            //計數器
            $i++;
        }

        //BODY
        $output = array
        (
            'articles' => $articles,
            'topicname' => $topicname,
            'photo_addr' => $photo_addr
        );
		$this->load->view('topic/thread.php', $output);
		//FOOTER
		$this->load->view('template/footer.php');
	}
}
