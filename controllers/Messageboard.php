<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Messageboard extends CI_Controller {


        public function __construct()
        {
                parent::__construct();
                $this->load->model('messageboard_model');
                $this->load->helper('url');
                $this->load->library('session');  
                $this->load->library("pagination");

        }


        public function index($page = 0)
        {

           

            $config = array();
            $config["base_url"] = base_url() . "index.php/messageboard/index";
            $config["total_rows"] = $this->messageboard_model->topic_count();
            $config["per_page"] = 5;
            $config["uri_segment"] = 3;
            $config["num_links"] = 10;
            $config["num_tag_open"] = "&nbsp";
            $config["num_tag_close"] = "&nbsp";  
    
            $config['full_tag_open'] = '<div><ul class="pagination pagination-small pagination-centered ">';
            $config['full_tag_close'] = '</ul></div>'; 
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = "<li class='disabled'><li class='active'  ><a href='#' style=\"color:black; background-color:red;\" >"; 
            $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
     
            $config['next_tag_open'] = "<li>";
            $config['next_tagl_close'] = "</li>";
            $config['prev_tag_open'] = "<li>";
            $config['prev_tagl_close'] = "</li>";  
            $config['first_tag_open'] = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['last_tag_open'] = "<li>";
            $config['last_tagl_close'] = "</li>";
            $config['first_link'] = "<span aria-hidden=\"true\">&laquo;</span>";
            $config['last_link'] = "<span aria-hidden=\"true\">&raquo;</span>"; 
            $config['prev_link'] = '&lt; Prev';
            $config['next_link'] = 'Next &gt;';


            $this->pagination->initialize($config);
                  
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["topics"] = $this->messageboard_model->
               fetch_topics($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();

            $data['pagename'] = "Message board";
        
            $this->load->view('messageboard/templates/header.php',$data);
            $this->load->view('messageboard/messageboard.php',$data);
            $this->load->view('messageboard/templates/footer.php');

          
        }


        public function login()
        {

            $this->load->helper( array('form','url') );
            $this->load->library('form_validation');

            $data['pagename'] = "Login";
            
            $this->form_validation->set_rules('username', 'Username', 'required|strip_tags|callback_login_check');
            $this->form_validation->set_rules('password', 'Password', 'required|strip_tags');


            if ($this->form_validation->run() === FALSE)
            {
               $this->load->view('messageboard/templates/header.php',$data);
               $this->load->view('messageboard/login.php',$data);
               $this->load->view('messageboard/templates/footer.php');

            }                      
           
     
        }

            public function login_check($str)
            {
            
                   $uname = $this->input->post('username');
                   $pword = $this->input->post('password');

                   if(!$data['user'] = $this->messageboard_model->verify_user($uname, $pword) )
                   { 

                       $this->form_validation->set_message('login_check', 'The username and password do not match a valid account');  
                       return FALSE;

                   }
                   else
                   {
                       $_SESSION['loggedin']['name'] = $data['user']['username'];
                       $_SESSION['loggedin']['userid'] = $data['user']['userid'];
                         
                       redirect('messageboard');   

                   }  
                   
 
            }


        public function logout()
        {

            $this->session->unset_userdata('loggedin');
            redirect('messageboard');

        }


        public function show_messages($topic, $page=0) 
        {

           
       
            $config = array();
            $config["base_url"] = base_url() . "index.php/messageboard/show_messages/" . $topic;
            $config["total_rows"] = $this->messageboard_model->message_count($topic);
            $config["per_page"] = 5;
            $config["uri_segment"] = 4;
            $config["num_links"] = 10;
            $config["num_tag_open"] = "&nbsp";
            $config["num_tag_close"] = "&nbsp";  
       
            $config['full_tag_open'] = '<div><ul class="pagination pagination-small pagination-centered ">';
            $config['full_tag_close'] = '</ul></div>'; 
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = "<li class='disabled'><li class='active'  ><a href='#' style=\"color:black; background-color:red;\" >"; 
            $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
     
            $config['next_tag_open'] = "<li>";
            $config['next_tagl_close'] = "</li>";
            $config['prev_tag_open'] = "<li>";
            $config['prev_tagl_close'] = "</li>";  
            $config['first_tag_open'] = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['last_tag_open'] = "<li>";
            $config['last_tagl_close'] = "</li>";
            $config['first_link'] = "<span aria-hidden=\"true\">&laquo;</span>";
            $config['last_link'] = "<span aria-hidden=\"true\">&raquo;</span>"; 
            $config['prev_link'] = '&lt; Prev';
            $config['next_link'] = 'Next &gt;';






            $this->pagination->initialize($config);
                  
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $data["messages"] = $this->messageboard_model->
               fetch_messages($topic,$config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();

            $data['pagename'] = "Message board";
        
            $this->load->view('messageboard/templates/header.php',$data);
            $this->load->view('messageboard/messageboard.php',$data);
            $this->load->view('messageboard/templates/footer.php');

     
        }


        public function register()
        {

            $this->load->helper( array('form','url') );
            $this->load->library('form_validation');

            $data['pagename'] = "Register";
            
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');  

            $this->form_validation->set_message('is_unique', 'That %s is already taken');

            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('email2', 'Confirmation email', 'required|matches[email]');

            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password2', 'Confirmation password', 'required|matches[password]');

            if ($this->form_validation->run() === FALSE)
            {
               $this->load->view('messageboard/templates/header.php',$data);
               $this->load->view('messageboard/register.php',$data);
               $this->load->view('messageboard/templates/footer.php');

            }                      
            else
            {

               $un = $this->input->post('username');
               $em = $this->input->post('email'); 
               $pw = $this->input->post('password');

               $this->messageboard_model->register_part1($un,$em,$pw);                
 
               
               $md = "Messageboard details";
               $bdy = '<h3>To register for the message board click the link below</h3>
                      <h2><a href=http://localhost/portfolio/codeigniter3/index.php/messageboard/activate_account/' . rawurlencode($un) . '/' . rawurlencode($pw) . '>Click here to register on the messageboard</a></h2><BR>
                      Your username is ' . $un . '<BR><BR>Your password is ' . $pw . '<BR>';  
               $mime = "MIME-Version: 1.0\r\nContent-type: text/html; charset=charset=ISO-8859-1\r\nFrom:www.examples.net84.net\r\n";
     
               mail($em,$md,$bdy,$mime);

               $data['pagename'] = "Activate account";

               $this->load->view('messageboard/templates/header.php',$data);

               $this->load->view('messageboard/emailsent.php');
               
               $this->load->view('messageboard/templates/footer.php');
        
            }
   
     
        }

        public function activate_account($un,$pw)
        {
             
            $un = rawurldecode($un);                 
            $pw = rawurldecode($pw);       
         
            $data['pagename'] = "Activate account";

            $this->load->view('messageboard/templates/header.php',$data);
            
            if($this->messageboard_model->activate_account($un, $pw) )
            {
             /*  echo "<h4>You're account as now been activated. You can login</h4>"; */
                 $data['accmessage'] = "You're account as now been activated. You can login";
            }
            else
            {
             /*  echo "<h4>You're account is already active or you're here by mistake</h4>"; */
                 $data['accmessage'] = "You're account is already active or you're here by mistake";
            } 

            $this->load->view('messageboard/activateaccount.php',$data);
            $this->load->view('messageboard/templates/footer.php');
        

        }

        public function newmessages($topicid)
        {


            $this->load->helper( array('form','url') );
            $this->load->library('form_validation');

            $this->form_validation->set_rules('messagebox', 'message', 'trim|required|strip_tags|htmlentities');

            $data['topicid'] = $topicid;

            $data['pagename'] = "Enter your message";

            $data['topicname'] = $this->messageboard_model->get1topicname($topicid);


            if ($this->form_validation->run() === FALSE)
            { 
               $this->load->view('messageboard/templates/header.php',$data);            
               $this->load->view('messageboard/submitmessage.php',$data);   
               $this->load->view('messageboard/templates/footer.php');
            } 
            else
            {
             
                 $message = $this->input->post('messagebox');             

                 $data2 = array(
                         'topicid'      => $topicid,
                         'userid'       => $_SESSION['loggedin']['userid'],
                         'message'      => $message
                 );

                 $this->db->set('date_posted', 'NOW()', FALSE);
                 $this->db->insert('messages', $data2);

                 $mcount = floor($this->messageboard_model->message_count($topicid));
                 $data['message_count'] = floor($mcount/5); 
                 if($mcount % 5 == 0) {$data['message_count'] = $data['message_count'] - 1; } 
                 $data['message_count'] = $data['message_count'] * 5;
                  
 
                 $this->load->view('messageboard/templates/header.php',$data);            
                 $this->load->view('messageboard/messageok.php',$data);   
                 $this->load->view('messageboard/templates/footer.php');


            } 




        }


        public function newtopic()
        {


            $this->load->helper( array('form','url') );
            $this->load->library('form_validation');

            $this->form_validation->set_rules('topicbox', 'new thread', 'required');

            $data['pagename'] = "Start new topic";

            if ($this->form_validation->run() === FALSE)
            { 
               $this->load->view('messageboard/templates/header.php',$data);            
               $this->load->view('messageboard/newtopic.php',$data);   
               $this->load->view('messageboard/templates/footer.php');
            } 
            else
            {
             
                 $topicname = $this->input->post('topicbox');             
                 $topicname =  (string)TRIM($topicname);
                 $topicname = htmlentities($topicname);
                 $topicname = strip_tags($topicname);  

                 $data2 = array(
                         'topicname'    => $topicname,
                         'userid'       => $_SESSION['loggedin']['userid']                         
                 );

                 $this->db->insert('topic', $data2);
                 $insert_id = $this->db->insert_id();
                 
                 redirect('messageboard/newmessages/' . $insert_id);


            } 




        }






}