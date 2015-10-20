<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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

        //require_once __DIR__ . '\..\libraries\facebook-php-sdk\src\Facebook\autoload.php';
        $this->load->library('Facebook');
        $this->fb = new Facebook\Facebook([
            'app_id' => $data->app_id,
            'app_secret' => $data->app_secret,
            'default_graph_version' => 'v2.4',
        ]);
    }


	public function getProfile($uid)
	{
		$this->Auth_model->getAuthStat();        
        $data = array('tags' => $this->Topic_model->getTags());
        $this->load->view('template/head.php', $data);
    	$data = $this->User_model->getUserProfile($uid);
    	$this->load->view('user/user_profile.php', array('user' => $data));
    	$this->load->view('template/footer.php');
	}

    public function getProfileEditor($uid)
    {
        //檢查登入
        if( ! isset($_SESSION['uid']) ){
            redirect( base_url().'Signin' );
        }
        //檢查帳號
        if( $_SESSION['uid'] != $uid ){
            show_error('不能編輯別人的資料');
            exit();
        }
        
        $this->Auth_model->getAuthStat();
        $output = array('tags' => $this->Topic_model->getTags());
        $this->load->view('template/head.php', $output);

        $data = $this->User_model->getUserProfile($uid);
        $output = array
        (
            'username' => $data->username,
            'email' => $data->email,
            'introducing' => html_entity_decode($data->introducing),
            'photo_addr' => $data->photo_addr,
            'url' => base_url().'User/do/edit/'.$uid
        );
        $this->load->view('user/user_editor.php', $output);
        $this->load->view('template/footer.php');
    }

    public function updateProfile($uid)
    {
        //檢查登入
        if( ! isset($_SESSION['uid']) ){
            redirect( base_url().'Signin' );
        }
        //檢查帳號
        if( $_SESSION['uid'] != $uid ){
            show_error('不能編輯別人的資料');
            exit();
        }
        //檢查輸入
        $username = $this->input->post('profile_username');
        $introducing = $this->input->post('profile_introducing');
        $photo_addr = $this->input->post('profile_photo_addr');

        if( !($username) ){
            echo json_encode(array( 'redirect_url' => base_url().'error' ));
            exit();
        }

        //輸入資料
        $data = array
        (
            'username' => $username,
            //'email' => $email,
            'introducing' => $introducing,
            'photo_addr' => $photo_addr
        );
        $where = " uid=".$uid." ";

        if( $this->User_model->updateProfile($data, $where) )
        {
            echo json_encode(array( 'redirect_url' => base_url().'User/'.$uid ));
        }
        else
        {
            echo json_encode(array( 'redirect_url' => base_url().'error' ));
        }
    }
}
