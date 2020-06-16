<?php
class Messageboard_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
                $this->load->helper('date');
        }




        public function get_topics()
        {
                $query = $this->db->select('topic.topicid, topic.topicname, topic.userid, COUNT(messages.topicid) as message_count', FALSE)
                                  ->from('topic')
                                  ->join('messages', 'topic.topicid=messages.topicid','left')
                                  ->group_by('topic.topicid')
                                  ->order_by('topic.topicid', 'desc')    
                                  ->get();
            
                return $query->result_array();
        }

  
        public function get1topicname($topicid)
        {
                $query = $this->db->select('topicname', FALSE)     
                                  ->limit(1)
                                  ->get_where('topic',array('topicid' => $topicid));
            
                return $query->result_array();
        }


        public function get_messages($topicid)
        {
                $query = $this->db->select('messages.date_posted, messages.message , users.username as username, topic.topicname as topicname, topic.topicid as topicid', FALSE)        
                                  ->join('users', 'messages.userid=users.userid')
                                  ->join('topic', 'messages.topicid=topic.topicid')
                                  ->order_by('messages.date_posted,messages.messageid', 'ASC')  
                                  ->get_where('messages', array('messages.topicid' => $topicid)); 
   
                return $query->result_array();
        }

 



        public function verify_user($uname, $pword)
        {
           
            $query = $this->db->get_where('users', array('username' => $uname, 'password_enc' => SHA1($pword), 'registered' => 'Y'  ));
            return $query->row_array();

        }


        public function register_part1($un,$em,$pw)
        {
  
            $epw = SHA1($pw); 

            $data = array(
              'username' => $un,
              'email' => $em,
              'password' => $pw,
              'password_enc' => $epw
            );

            $this->db->insert('users',$data);

        }


        public function activate_account($un,$pw)
        {     

           $un = urldecode($un);
           $pw = urldecode($pw);
       
           $encpw = SHA1($pw);

           $data = array(
           'registered' => 'Y'
           );
           
           $this->db->where('username', $un);
           $this->db->where('password_enc', $encpw);
           $this->db->where('registered', null);
           $this->db->set('date_joined', 'NOW()', FALSE);
           $this->db->update('users', $data);
           return $this->db->affected_rows();
       
          
        } 

    
        public function topic_count() {
        return $this->db->count_all("topic");
    }
 
     public function fetch_topics($limit, $start) {

        /*
        $this->db->limit($limit, $start);
        $query = $this->db->get("topic");
        */

        $query = $this->db->select('topic.topicid, topic.topicname, topic.userid, COUNT(messages.topicid) as message_count', FALSE)
                      ->from('topic')
                      ->limit($limit, $start)
                      ->join('messages', 'topic.topicid=messages.topicid','left')
                      ->group_by('topic.topicid')
                      ->order_by('topic.topicid', 'desc')    
                      ->get();

        if ($query->num_rows() > 0) {
               return $query->result_array();
                
        }
        return false;
   }

    

        public function message_count($topicnum) {
               $this->db->from('messages');
               $this->db->where(array('topicid' => $topicnum));
        return $this->db->count_all_results();
    }


        public function fetch_messages($topicid,$limit,$start)
        {
                $query = $this->db->select('messages.date_posted, messages.message , users.username as username, topic.topicname as topicname, topic.topicid as topicid' , FALSE)
                                  ->join('users', 'messages.userid=users.userid')
                                  ->join('topic', 'messages.topicid=topic.topicid')
                                  ->order_by('messages.date_posted,messages.messageid', 'ASC')   
                                  ->limit($limit,$start)
                                  ->get_where('messages', array('messages.topicid' => $topicid));
                                 
   
                return $query->result_array();
        }
    


    

       



}