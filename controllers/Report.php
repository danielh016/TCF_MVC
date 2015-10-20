<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {


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
    public function signReport($aid){
        //檢查登入
        if( ! isset($_SESSION['uid']) ){
            redirect( base_url().'Signin' );
        }

        $this->Auth_model->getAuthStat();        
        $data = array('tags' => $this->Topic_model->getTags());
        $this->load->view('template/head.php', $data);

        $this->load->view('report/signreport.php', array('aid'=>$aid));

        $this->load->view('template/footer.php');
    }

    public function addReport($aid){
        //檢查登入
        if( ! isset($_SESSION['uid']) ){
            redirect( base_url().'Signin' );
        }
        
        $aid = (int)$aid;
        $data = array(
            'rpid' => null,
            'aid' => $aid,
            'uid' => $_SESSION['uid'],
            'reason' => $this->input->post('report_reason'),
            'content' => $this->input->post('report_content')
        );

        if( ! $this->Topic_model->addReport($data) ){
            show_error('檢舉文章'.'時發生錯誤<br>'.$this->db->error());
        }
        redirect( base_url().'Topic/'.$aid );
    }
}
