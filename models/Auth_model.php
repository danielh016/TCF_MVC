<?php

class Auth_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getOauth($type = 'facebook')
    {
    	switch($type)
    	{
    		default:
    		case 'facebook':
    			$sql = 'SELECT * FROM oauth WHERE oid = 1';
    			break;
    	}

    	$result = $this->db->query($sql);
        $data = $result->row();
    	return $data;
    }

        public function getAuthStat()
        {
            if( $this->session->authstat )
            {
                $this->session->set_userdata('authstat', 1);
                return TRUE;
            }
            else
            {
                $this->session->set_userdata('authstat', 0);
                $this->getFacebookLoginButton();
                return FALSE;
            }
        }

        public function getFacebookLoginButton()
        {
            //                                   FACEBOOK                                    //
            $helper = $this->fb->getRedirectLoginHelper();
            $permissions = []; // optional
            $loginUrl = $helper->getLoginUrl( base_url().'Auth/facebook/', $permissions);
            //                                   FACEBOOK                                    //
            $this->session->set_userdata('fb_login_button', ('<a class="btn btn-block btn-social btn-facebook" href="'.$loginUrl.'"><i class="fa fa-facebook"></i> 用Facebook帳號登入</a>'));
        }



        public function auth($utid, $id, $password = null)
        {
            $utid = (String)$utid;
            switch( $utid )
            {
               case '1':
                    $sql = 'SELECT uid,rid,username,photo_addr FROM user WHERE email = ? AND password = ?';
                    $result = $this->db->query($sql, array($id,$password));
                    $data = $result->row();
                    return $data;
                    break;
                case '2':
                    $sql = 'SELECT uid,rid,username,photo_addr FROM user WHERE oauthid = ?';
                    $result = $this->db->query($sql, $id);
                    $data = $result->row();
                    return $data;
                    break;
            }
        }
}