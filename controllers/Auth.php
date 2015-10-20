<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {


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

	public function signin()
	{
		//檢查登入
        if( isset($_SESSION['uid']) ){
            redirect( base_url() );
        }
        $this->Auth_model->getAuthStat();
        $data_tags = array('tags' => $this->Topic_model->getTags());
        $this->load->view('template/head.php', $data_tags);
        $this->load->view('auth/signin.php');
	}
	public function signout()
	{
		$this->session->sess_destroy();
		redirect( base_url() );
	}
	public function signup($data)
	{
		$this->signin();
	}

	public function addUser()
	{
		//檢查登入
        if( isset($_SESSION['uid']) ){
            show_error('你已經登入了');
            exit();
        }
        //檢查輸入
        $username = $this->input->post('signup_username');
        $password = $this->input->post('signup_password');
        $email = $this->input->post('signup_email');
        $introducing = $this->input->post('signup_introducing');
        $photo_addr = $this->input->post('signup_photo_addr');

        if( !($username && $password && $email ) ){
            show_error('請輸入必填欄位');
            exit();
        }
        //檢查帳號可用性
        if( $this->User_model->getUserByEmail($email) ){
            show_error('這個電子信箱已經被註冊過了');
            exit();
        }
        //特別處理
        if( strlen($password) < 8 ){
        	show_error('請設定長度至少8位的密碼');
            exit();
        }
        //輸入資料
        $data = array
        (
            'uid' => null,
            'username' => $username,
            'password' => md5($password),
            'email' => $email,
            'introducing' => $introducing,
            'photo_addr' => $photo_addr,
            'join_time' => date("Y-m-d h:i:s", time()+(8*60*60)),
            'oauthid' => null,
            'rid' => 2,
            'utid' => 1,
            'activate' => 1
        );
        if( ! $this->User_model->addUser($data) )
        {
            show_error('註冊帳號'.'時發生錯誤<br>'.$this->db->error());
            exit();
        }
        if( ! $this->auth(1, $email, $password) ){
            show_error('登入帳號'.'時發生錯誤<br>'.$this->db->error());
            exit();
        }
        redirect( base_url() );
	}


	public function auth($utid, $email = null, $password = null)
    {
    	//檢查登入
        if( isset($_SESSION['uid']) ){
            redirect( base_url() );
        }
		//準備資料
    	$utid = (int)$utid;

    	if( $utid == 1 ){
    		if( ! ($email && $password) ){
    			$email = $this->input->post('signin_email');
    			$password = $this->input->post('signin_password');
    		}
            $password = md5($password);
    	}
    	else if( $utid == 2 ){
    		//                                   FACEBOOK                                    //
        	$helper = $this->fb->getRedirectLoginHelper();
			try{
				$accessToken = $helper->getAccessToken();
				if( isset($accessToken) )
				{
					$response = $this->fb->get('/me?fields=name,id,picture', $accessToken);
					$user = $response->getGraphUser();
					$photo = $user['picture']->getUrl();
				}
			} catch(Facebook\Exceptions\FacebookResponseException $e){
				// When Graph returns an error
				show_error('Graph returned an error: ' . $e->getMessage());
				exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e){
				// When validation fails or other local issues
				show_error('Facebook SDK returned an error: ' . $e->getMessage());
				exit;
			}
			if( ! isset($user) ){
				show_error('Graph getGraphUser function failed');
				exit;
			}
			//                                   FACEBOOK                                    //
    	}

        //嘗試登入
		switch( $utid )
		{
			case 1:
				if( ! $data = $this->Auth_model->auth($utid, $email, $password) ){
                    show_error('登入帳號'.'時發生錯誤<br>'.$this->db->error());
                    exit();
                }
				break;
			case 2:
                $data = $this->Auth_model->auth($utid, $user['id']);
				if( ! $data->uid ){
					//註冊
					$data = array
					(
						'username' => $user['name'],
						'oauthid' => $user['id'],
						'activate' => 1,
						'rid' => 2,
						'utid' => 2,
						'photo_addr' => $photo
					);
					if( ! $this->User_model->addUser($data) ){
            			show_error('註冊FB帳號'.'時發生錯誤<br>'.$this->db->error());
                        exit();
            		}
            		//重新登入
            		$data = $this->Auth_model->auth($utid, $user['id']);
        			if( ! $data->uid ){
            			show_error('登入FB帳號時'.'時發生錯誤<br>'.$this->db->error());
                        exit();
        			}
            	}
				break;
		}
		//成功登入，準備SESSION資料
		$session_data = array
        (
        	'authstat' => 1,
        	'uid' => $data->uid,
            'rid' => $data->rid,
        	'username' => $data->username,
        	'photo_addr' => $data->photo_addr
        );
        $this->session->set_userdata($session_data);
		redirect( base_url() );
    }
}
