<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends SFRA_Controller {

	function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('uuid');
        $this->load->model('login_model','login');
        $this->load->model('emailtemplate_model','emailtemplate');
    }

    function index(){
       
    }

    function loginUser(){
        $this->form_validation->set_rules(
            'logusername', 
            'Username',
            'required'
        );

        $this->form_validation->set_rules(
            'logpassword', 
            'Password', 
            'required'
        );

        if($this->form_validation->run()){
            $data = array(                
                'username' => $this->input->post('logusername'),
                'password' => sha1($this->input->post('logpassword')),
                'isactivated' => TRUE
            );
            $query = $this->login->checkCredentials($data);

            if($query->num_rows() > 0){
                $row = $query->row();
                $fullname = $row->first_name.' '. $row->last_name;
                $mysessionData = array(                
                    'islogin'     => TRUE,
                    'loggedname'  => $fullname,
                    'userRole'    => $row->role,               
                    'username'    => $row->username,
                    'useremail'   => $row->email,              
                    'profilepic'   => $row->picture
                );

                $this->session->set_userdata('sfra_s3ss10n_l0g', $mysessionData);
                $this->getUserSettings($row->username);

                $this->session->set_flashdata('flash_message', 'Welcome, '.$fullname.' You have successfully login');
                echo json_encode(array("status" => TRUE));
            } else {
                $errors = 'Invalid Username / Password or Account is not activated!';
                echo json_encode(array("status" => FALSE,"errors" => $errors));
            }
        } else {
            $errors = validation_errors();
            echo json_encode(array("status" => FALSE,"errors" => $errors));
            redirect(base_url(),'refresh');
        }

    }

    function signUp(){
        $this->form_validation->set_rules(
            'username', 
            'Username',
            'trim|required|min_length[5]|max_length[15]|callback_username_check'
        );
        $this->form_validation->set_rules(
            'password', 
            'Password', 
            'trim|required|min_length[8]'
        );
        $this->form_validation->set_rules(
            'password_confirmation', 
            'Password Confirmation', 
            'trim|required|matches[password]'
        );
        $this->form_validation->set_rules(
            'firstname', 
            'First Name', 
            'required|alpha'
        );
        $this->form_validation->set_rules(
            'lastname', 
            'Last Name', 
            'required|alpha'
        );
        $this->form_validation->set_rules(
            'useremail', 
            'Email',
            array(
                'trim',
                'required',
                'valid_email',
                'callback_checkUserEmail'
            )            
        );
        $this->form_validation->set_rules(
            'address', 
            'Address',
            'required'
        );

        if($this->form_validation->run()){
            $useremail = $this->input->post('useremail');

            $isValidEmail = valid_email($useremail);

            if($isValidEmail){
                $userguid = $this->uuid->v4();

                $data = array(
                    'first_name'    => $this->input->post('firstname'),
                    'middle_name'   => $this->input->post('middlename'),
                    'last_name'     => $this->input->post('lastname'),
                    'suffix'        => $this->input->post('suffix'),
                    'password'      => sha1($this->input->post('password')),
                    'username'      => $this->input->post('username'),
                    'email'         => $useremail,
                    'userguid'      => $userguid
                );

                // to secure data
                $data = $this->security->xss_clean($data);                
                $id = $this->login->signUpUser($data);
                $linkv = 'login/verifyAccount/'.$userguid;

                $signupdata = array(
                    'to'        => $useremail,
                    'verifybtn' =>  '<a class="btn btn-primary" href="'.base_url($linkv).'">activate my account</a>',
                    'fname'     =>  $data['first_name']
                );

                $this->emailtemplate->sendEmail($signupdata,'signup');

                if($id){

                    $data = array(
                        'userid'    =>  $id,
                        'username'  => $this->input->post('username'),
                        'address'   => $this->input->post('address')
                    ); 

                    $this->login->addUserDetails($data);
                }
                
                $this->session->set_flashdata('flash_message', 'Kindly check your email and follow the steps to activate');
                echo json_encode(array("status" => TRUE));
            } else {
                $errors = 'Your Email is not valid!!!';
                echo json_encode(array("status" => FALSE,"errors" => $errors));
            }  
        } else {
            //$errors = $this->form_validation->error_array();
            $errors = validation_errors();
            echo json_encode(array("status" => FALSE,"errors" => $errors));            
        }
    }

    function endSession(){
        //$this->session->unset_userdata('sfra_s3ss10n_l0g');
        //$this->session->unset_userdata('sfra_s3ss10n_l0g_settings');

        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
    }

    public function username_check($str)
    {
            if ($str == 'tests')
            {
                $this->form_validation->set_message('username_check', 'The {field} field can not be the word "tests"');
                return FALSE;
            }else if ($str == ''){
                 return TRUE;
            }
            else
            {
                $isExist = $this->login->isUserNameExist($str);

                if($isExist){
                    $this->form_validation->set_message('username_check', 'The {field} already exists!');
                    return FALSE;
                }else{
                    return TRUE;
                }
            }
    }

    public function checkUserEmail($str)
    {
           
        $isExist = $this->login->isUserEmailExist($str);

        if($isExist){
            $this->form_validation->set_message('checkUserEmail', 'The {field} already exists!');
            return FALSE;
        }else{
            return TRUE;
        }
        
    }

    public function testemail(){
        //$this->load->library('uuid');
       /**
        $data = array(
            'to'        => 'joebyzaldivar1886@gmail.com',
            'verifybtn' =>  '<a class="btn btn-primary" href="'.base_url().'">activate my account</a>',
            'fname'     =>  'Joeby'
        );
        **/
       echo $this->uuid->v4(); 
        //$this->emailtemplate->sendEmail($data,'signup');
        

    }

    /*
    public function sendEmail($data){

        $this->email->from('joebyzaldivar1886@gmail.com', 'SFR(A) - Admininstrator');
        $this->email->to($data['to']);

        $this->email->subject($data['subject']);
        $this->email->message($data['message']);

        if($this->email->send()){
            $msg = 'Email sent successfully'; 
        }else {   
            $msg ='Error in sending';
        }
        echo $msg;
    }
    */
    public function checkSpam($email)
    {
        $this->load->library('genuinemail');

        $check = $this->genuinemail->check($email);
        if($check===TRUE) return true;
        return false;

    }

    public function verifyAccount($uuid)
    {
        $results = $this->login->verifyAccount($uuid);

        if($results > 0){
            $this->session->set_flashdata('flash_message', 'Account has been activated!!!');
        }else{
            $this->session->set_flashdata('error_message', 'Cannot activated your account! Kindy contact the Admininstrator.');
        }
        redirect(base_url(), 'refresh');
    }

    public function getUserSettings($user)
    {
        $this->load->model('crud_model','crud');
        $this->crud->set_table('settingsuser');
        
        $query = $this->crud->getResultsCriteria(array('username' => $user),null);

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $mysessionData = array(                
                'sidebarcolor' => $row->sidebarcolor,                    
                'dateformat'   => $row->dateformat
            );
            $this->session->set_userdata('sfra_s3ss10n_l0g_settings', $mysessionData);
        } else {
            $mysessionData = array(                
                'sidebarcolor' => 'red',                    
                'dateformat'   => 'd M Y'
            );
            $this->session->set_userdata('sfra_s3ss10n_l0g_settings', $mysessionData);
        }
       
    }

}