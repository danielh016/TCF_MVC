<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

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

	public function index()
	{
        $this->Auth_model->getAuthStat();        
        $data = array('tags' => $this->Topic_model->getTags());
        $this->load->view('template/head.php', $data);

		$data = array
		(
			'carousels' => $this->Topic_model->getRandomTopics(5)
		);
		$this->load->view('index_carousel.php', $data);

		$data = array
		(
			'hot' => $this->Topic_model->getTopics('hot', 0, 7),
			'latest' => $this->Topic_model->getTopics('latest', 0, 7)
		);
		$this->load->view('index_topics.php', $data);

		$this->load->view('template/footer.php');
	}

    public function error()
    {
        show_error('系統要爆炸啦塊陶阿');
    }
}
