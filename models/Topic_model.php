<?php

class Topic_model extends CI_Model
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
                if( isset($data[0]) ){
                    if( $data[0]->$key == FALSE ){
                        $data[0]->$key = 'http://i.imgur.com/CPKzVQp.png';
                    }
                }
            }
            return $data;
        }
        /*
        
            LIST

         */
        public function getTags()
        {
            $sql = 'SELECT DISTINCT tag FROM topics';
            $result = $this->db->query($sql);
            $output = $result->result();
            return $output;
        }
        public function getRandomTopics($limit = 3)
        {
            $sql = 'SELECT * FROM topics ORDER BY rand() LIMIT ?';
            $result = $this->db->query($sql, $limit);
            $output = $result->result();
            $output = $this->getDefaultPhoto($output, 'topic_', FALSE);
            return $output;
        }
        public function getTopics($mode, $limit)
        {
            switch($mode)
            {
                case 'latest':
                    $sql = 'SELECT * FROM topics ORDER BY edit_time DESC LIMIT ?';
                    break;
                default:
                case 'hot':
                    $sql = 'SELECT *,views+10*num_articles AS hotindex FROM topics ORDER BY hotindex DESC LIMIT ?';
                    break;
            }
            $result = $this->db->query($sql, $limit);
            $output = $result->result();
            $output = $this->getDefaultPhoto($output, 'topic_', FALSE);
            return $output;
        }
        public function getSpecifiedTopics($mode, $keys, $limit)
        {
            foreach( $keys as $key )
            {
                $this->db->or_like($mode, $key, 'both');
            }
            $this->db->limit($limit);


            $sql = $this->db->get_compiled_select('topics');
            $result = $this->db->query($sql, $limit);
            $output = $result->result();
            $output = $this->getDefaultPhoto($output, 'topic_', FALSE);
            return $output;
        }

        /*
        
            ARTICLE INFO

         */
        public function getArticle($aid)
        {
            $sql = 'SELECT * FROM article WHERE aid = ?';
            $result = $this->db->query($sql, array( $aid ));
            $output = $result->row();
            return $output;
        }
        public function getArticleInfo($aid, $cols)
        {
            $sql = "SELECT $cols FROM article WHERE aid = ?";
            $result = $this->db->query($sql, $aid);
            $output = $result->row();
            return $output;
        }
        public function getInsertedArticle($data)
        {
            $sql = 'SELECT max(aid) FROM article WHERE uid = ?';
            $result = $this->db->query($sql, $data);
            $output = get_object_vars($result->row())['max(aid)'];
            return $output;
        }
        /*
        
            THREAD

         */
        public function getFirstArticleID($topicname)
        {
            $topicname = (string) $topicname;

            $sql = 'SELECT aid FROM topics WHERE topicname = ?';
            $result = $this->db->query($sql, array( $topicname ));
            $output = $result->row()->aid;
            return $output;
        }
        public function getThread($topicname)
        {
            $topicname = (string) $topicname;

            $sql = 'SELECT A1.aid,A1.uid,A1.topicname,A1.content,A1.photo_addr topic_photo_addr,A1.edit_time,A1.views,A1.ano,U1.username,U1.photo_addr user_photo_addr,U1.join_time
                    FROM article A1, user U1
                    WHERE A1.topicname = ? AND U1.uid = A1.uid 
                    ORDER BY A1.aid';
            $result = $this->db->query($sql, array( $topicname ));
            $output = $result->result();
            $output = $this->getDefaultPhoto($output, 'topic_', TRUE);
            return $output;
        }

        /*
        
            ADD / UPDATE

         */
        public function addArticle($data)
        {
            $sql = $this->db->insert_string('article', $data);
            return $this->db->simple_query($sql);
        }
        public function updateArticle($data, $where)
        {
            $sql = $this->db->update_string('article', $data, $where);
            return $this->db->simple_query($sql, $data);
        }
        public function addReport($data)
        {
            $sql = $this->db->insert_string('report', $data);
            return $this->db->simple_query($sql);
        }
}