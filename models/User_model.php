<?php

class User_model extends CI_Model
{
        public function __construct()
        {
            parent::__construct();
        }
        public function getDefaultPhoto($data, $prefix = null, $mode = FALSE){
            $key = $prefix.'photo_addr';

            if( $mode == FALSE ){
                foreach ($data as $row) {
                    //特殊處理
                    if( $row->$key == FALSE ){
                        $row->$key = 'http://i.imgur.com/CPKzVQp.png';
                    }
                }
            }
            else{
                if( isset($data) ){
                    if( $data->$key == FALSE ){
                        $data->$key = 'http://i.imgur.com/CPKzVQp.png';
                    }
                }
            }
            return $data;
        }
        /*
        
            USER_PROFILE

         */
        public function getUser($uid){
            $uid = (int) $uid;

            $sql = 'SELECT username,join_time,photo_addr FROM user WHERE uid = ?';
            $result = $this->db->query($sql, $uid);
            $data = $result->row();
            $data = $this->getDefaultPhoto($data, '', TRUE);
            return $data;
        }
        public function getUserByEmail($email){

            $sql = 'SELECT * FROM user WHERE email = ?';
            $result = $this->db->query($sql, $email);
            $data = $result->row();
            $data = $this->getDefaultPhoto($data, '', TRUE);
            return $data;
        }

        public function getNum_post($uid){
            $uid = (int) $uid;

            $sql = 'SELECT count(*) FROM article WHERE uid = ?';
            $result = $this->db->query($sql, $uid);
            $data = $result->row();
            
            //會傳回一個array
            return get_object_vars($data)['count(*)'];
        }

        public function getUserProfile($uid){
            $sql = 'SELECT * FROM user WHERE uid = ?';
            $result = $this->db->query($sql, $uid);
            $data = $result->row();
            $data = $this->getDefaultPhoto($data, '', TRUE);
            
            //TOPICS of user
            $sql = 'SELECT aid,topicname,edit_time FROM topics WHERE uid = ? LIMIT 20';
            $result = $this->db->query($sql, array( $data->uid ));
            $topics = $result->result();  

            $data->topics = $topics;
            return $data;
        }

        /*
        
            MANAGEMENT

         */
        public function addUser($data)
        {
            $sql = $this->db->insert_string('user', $data);
            return $this->db->simple_query($sql);
        }
        public function updateProfile($data, $where)
        {
            $sql = $this->db->update_string('user', $data, $where);
            return $this->db->simple_query($sql);
        }
}