<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends SFRA_Controller {

	function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('crud_model','crud');
        $this->crud->set_table('notifications');
        $this->crud->set_keyid('notificationid');
    }

    function index(){
    	
        $this->isLogUser();
        
        $myusername = $this->session->userdata('sfra_s3ss10n_l0g')['username'];
        $myrole = $this->session->userdata('sfra_s3ss10n_l0g')['userRole'];

        $query = $this->crud->getResultsCriteria(array('touser' => $myusername),null);

		$this->page = 'admin/notification/inbox';
        $this->data['page_active'] = 'notification';
        $this->data['page_title'] = 'My Inbox';        
        $this->data['page_data'] = $query->result();

        $this->crud->set_table('users');
        if($myrole == 'admin'){
            $criteria = array(
                'role' => 'student'
            );
        }else{
            $criteria = array(
                'role' => 'admin'
            );
        }

        $query = $this->crud->getResultsCriteria($criteria,array('orderkey' => 'first_name', 'orderset' => 'asc'));
        $this->data['useradminlist'] = $query->result();

        $this->layout();

    }


    function sent_messages(){
        
        $this->isLogUser();
        
        $myusername = $this->session->userdata('sfra_s3ss10n_l0g')['username'];
        //$myrole = $this->session->userdata('sfra_s3ss10n_l0g')['userRole'];

        $query = $this->crud->getResultsCriteria(array('fromuser' => $myusername),null);

        $this->page = 'admin/notification/sentnotification';
        $this->data['page_active'] = 'notification';
        $this->data['page_title'] = 'My Inbox';        
        $this->data['page_data'] = $query->result();

        $this->layout();

    }

    function read_message($msgid){
        
        $this->isLogUser();

        
        //$this->crud->update(array('notificationid'=>$msgid),$data);

        echo json_encode(array("status" => TRUE,'pageredirect'=>base_url('notification/read/'.$msgid)));

       
        
    }

    function read($msgid){
        
        $this->isLogUser();

        
        $query = $this->crud->getResultsCriteria(array('notificationid' => $msgid),null);   

        if($query->row()->isread == 0){

            $data = array(
                'isread' => 1            
            );

            $this->crud->update(array('notificationid'=>$msgid),$data);

        }    
        
        $this->page = 'admin/notification/readmessage';
        $this->data['page_active'] = 'notification';
        $this->data['page_title'] = 'My Inbox';        
        $this->data['page_data'] = $query->result();

        $this->layout();
        
    }


     function reply_message(){
        
        $this->isLogUser();
        if($this->input->post('btnSendReplyMessage')){

            $myusername = $this->session->userdata('sfra_s3ss10n_l0g')['username'];
            $myfullname = $this->session->userdata('sfra_s3ss10n_l0g')['loggedname'];
            
            //$touserinfo = explode('-', $this->input->post('useradmin'));

            $data = array(
                
                'notificationof'=> $this->input->post('id'),
                'touser'        => $this->input->post('fromuser'),
                'toname'        => $this->input->post('fromname'),
                'fromuser'      => $myusername,
                'fromname'      => $myfullname,
                'message'       => $this->input->post('replymsg'),
                'sentdatetime'  => mdate("%Y-%m-%d %H:%i:%s"),
                'isread'        => 0
            );

            $this->crud->save($data);

            $this->session->set_flashdata('flash_message', 'Message successfully sent!!!');
            redirect(base_url('notification'));
            //echo json_encode(array("status" => TRUE,'pageredirect'=>base_url('notification')));
        }else{

            $this->session->set_flashdata('error_message', 'Pleasse contact the Admin!!!');
            //echo json_encode(array("status" => FALSE,'pageredirect'=>base_url('notification')));
            redirect(base_url('notification'));
        }
        
    }


    function send_message(){
        
        $this->isLogUser();
        
        if($this->input->post('btnSendMessage')){

            $myusername = $this->session->userdata('sfra_s3ss10n_l0g')['username'];
            $myfullname = $this->session->userdata('sfra_s3ss10n_l0g')['loggedname'];
            
            $touserinfo = explode('-', $this->input->post('useradmin'));

            $data = array(
                
                'touser'        => $touserinfo[0],
                'toname'        => $touserinfo[1],
                'fromuser'      => $myusername,
                'fromname'      => $myfullname,
                'message'       => $this->input->post('message'),
                'sentdatetime'  => mdate("%Y-%m-%d %H:%i:%s"),
                'isread'        => 0
            );

            $this->crud->save($data);

            $this->session->set_flashdata('flash_message', 'Message successfully sent!!!');
            echo json_encode(array("status" => TRUE));
        }else{

            $this->session->set_flashdata('error_message', 'Pleasse contact the Admin!!!');
            echo json_encode(array("status" => FALSE));
            redirect(base_url());
        }

    }

}