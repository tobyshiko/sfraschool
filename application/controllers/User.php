<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends SFRA_Controller {

	function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('crud_model','crud');
        $this->load->model('emailtemplate_model','emailtemplate');
        $this->crud->set_table('users');
        $this->crud->set_keyid('id');
    }

    function index(){
        $this->isAdminUser();
    	        
        $query = $this->crud->getJoinResultsCriteria(null,array('table'=>'usersdetails','col'=>'userid'));

        $this->page = 'admin/users';
        $this->data['page_active'] = 'users';
        $this->data['page_title'] = 'Users';        
        $this->data['page_data'] = $query->result();
        $this->layout();
    }

    function activated($id){

        $this->isAdminUser();

        $data = array(
            'isactivated' => 1
        );
        $this->crud->update(array('id' => $id), $data);
        echo json_encode(array("status" => TRUE));

    }

    function deactivated($id){

        $this->isAdminUser();

         $data = array(
            'isactivated' => 0
        );
        $this->crud->update(array('id' => $id), $data);
        echo json_encode(array("status" => TRUE));

    }

    function profile(){
        $this->isLogUser();
        
        $myusername = $this->session->userdata('sfra_s3ss10n_l0g')['username'];

        $query = $this->crud->getJoinResultsCriteria(array('users.username' => $myusername),array('table'=>'usersdetails','col'=>'userid'));

        $this->page = 'student/userprofile';
        $this->data['page_active'] = 'userprofile';
        $this->data['page_title'] = 'User Profile';        
        $this->data['page_data'] = $query->result();
        $this->layout();
    }

    function update_settings(){

        if($this->input->post('btnUpdateSettings')){
            $this->crud->set_table('settingsuser');

            $data = array(
                'sidebarcolor'  => $this->input->post('sidebarcolor'),
                'dateformat'    => $this->input->post('dateformat'),
                'username'      => $this->session->userdata('sfra_s3ss10n_l0g')['username']
            );

            $results = $this->crud->update(array('username' => $this->session->userdata('sfra_s3ss10n_l0g')['username']), $data);

            if($results > 0){
                $this->session->set_flashdata('flash_message', 'Settngs has been updated!!!');
                $this->session->set_userdata('sfra_s3ss10n_l0g_settings', $data);
                echo json_encode(array("status" => TRUE));
            }else{
                $this->crud->save($data);
                $this->session->set_userdata('sfra_s3ss10n_l0g_settings', $data);
                echo json_encode(array("status" => TRUE));
            }
        }else{
            redirect(base_url());
        }       

    }

    function update_profile(){


        if($this->input->post('updateProfile')){

            $myusername = $this->session->userdata('sfra_s3ss10n_l0g')['username'];
            
            $newDate = nice_date(str_replace(' ','-', $this->input->post('dateofbirth')),'Y-m-d');

            $newDate = nice_date(str_replace('/','-', $this->input->post('dateofbirth')),'Y-m-d');
         
            
            $datauser = array(
                'email'         => $this->input->post('emailaddress'),
                'first_name'    => $this->input->post('firstname'),
                'middle_name'   => $this->input->post('middlename'),
                'last_name'     => $this->input->post('lastname'),
                'suffix'        => $this->input->post('suffix')

            );

            $datauserdetails = array(
                'afpsn'                 => $this->input->post('afpsn'),
                'afpos'                 => $this->input->post('afpos'),
                'contactnumber'         => $this->input->post('contactnumber'),
                'birthday'              => $newDate,
                'unitassigned'          => $this->input->post('unitassigned'),
                'address'               => $this->input->post('address'),
                'bloodtype'             => $this->input->post('bloodtype'),
                'emergencycontactperson'=> $this->input->post('ercontactperson'),
                'emergencycontactnumber'=> $this->input->post('ercontactnumber'),
                'isupdated'             => TRUE
            );
            
            $this->crud->update(array('username' => $myusername), $datauser);

            $this->crud->set_table('usersdetails');
            $this->crud->update(array('username' => $myusername), $datauserdetails);
            echo json_encode(array("status" => TRUE,'date'=>$newDate));

        }else{
            redirect(base_url());
        }    

        //echo json_encode(array("status" => FALSE));
    }

    public function profileupload(){

        $this->load->helper('file');
        $sessionData = $this->session->userdata('sfra_s3ss10n_l0g');
        $myusername = $sessionData['username'];
        $pathToUpload = "images/profile/".$myusername;

        $config['upload_path']=$pathToUpload;
        $config['allowed_types']='gif|jpg|png';
        $config['max_size']      = 2000; 
        $config['max_width']     = 400; 
        $config['max_height']    = 400; 
        
        $this->load->library('upload',$config);
        
            if($this->upload->do_upload("profileUpload")){
                $data = array('upload_data' => $this->upload->data());
                $image= $data['upload_data']['file_name'];                 
                $data = array(
                    'picture' => $pathToUpload.'/'.$image
                );

                $sessionData['profilepic'] = $data['picture'];
                $this->session->set_userdata('sfra_s3ss10n_l0g', $sessionData);

                $this->crud->update(array('username' => $myusername), $data);

                $this->session->set_flashdata('flash_message', 'Profile image updated successfully');

                $data = '<!DOCTYPE html>
                        <html>
                        <head>
                            <title>403 Forbidden</title>
                        </head>
                        <body>

                        <p>Directory access is forbidden.</p>

                        </body>
                        </html>';
                if ( ! write_file($pathToUpload.'/index.html', $data,'r+'))
                {
                       // echo 'Unable to write the file';
                }                
                //redirect(base_url('user'), 'refresh');
            }else{
                
                $this->session->set_flashdata('error_message', $this->upload->display_errors());
            }   

            redirect(base_url('user/profile'), 'refresh');


         /**   
        }else{

            $array = array(
                'error'   => true,
                'profilephoto_error' => form_error('userfile')
            );

        }
        **/


        //echo json_encode($array);

    }

    function change_password(){

        if($this->input->post('btnChangePassword')){
            $myusername = $this->session->userdata('sfra_s3ss10n_l0g')['username'];

            $currentpwd = sha1($this->input->post('currentpassword'));
            $newpwd = $this->input->post('newpassword');

            $query = $this->crud->getResultsCriteria(array('username' => $myusername, 'password' => $currentpwd),null);

            if($query->num_rows() > 0){

                $data = array(
                    'password'  => sha1($newpwd),
                    'userkey'   => $newpwd
                );

                $this->crud->update(array('username' => $myusername),$data);

                echo json_encode(array("status" => TRUE,'message'=>'Password has been change!!!'));
            }else{

                echo json_encode(array("status" => FALSE,'errors'=>'Password is incorrect!!!','pageredirect'=>base_url('user')));

            }

            $data = array(
                
            );
        }else{
            redirect(base_url());
        }

    }

    function view_user($user){

        $this->isAdminUser();
        
        $query = $this->crud->getJoinResultsCriteria(array('users.userguid' => $user),array('table'=>'usersdetails','col'=>'userid'));

        $this->page = 'admin/userprofileview';
        $this->data['page_active'] = 'users';
        $this->data['page_title'] = 'User Profile';        
        $this->data['page_data'] = $query->result();
        $this->layout();

    }

    function forgot_password(){

        if($this->input->post('btnForgotPassword')){
            $url= $_SERVER['HTTP_REFERER'];
            
            $email = $this->input->post('emailadd');

            $query = $this->crud->getResultsCriteria(array('email' => $email),null);

            if($query->num_rows() > 0){
                
                $row = $query->row();

                $data = array(
                    'to'        => $email,
                    'password'  =>  $row->userkey,
                    'fname'     =>  $row->first_name
                );

                $this->emailtemplate->sendEmailForgotPassword($data,'forgotpassword');

                //echo json_encode(array("status" => TRUE,'message'=>'Password has been change!!!'));
                $this->session->set_flashdata('flash_message', 'Kindly check your email inbox!!!');
                redirect($url);
            }else{

                //echo json_encode(array("status" => FALSE,'errors'=>'Email is not exists!!!'));
                $this->session->set_flashdata('error_message', 'Email does not exists!!!');
                redirect($url);

            }
        }else{
            redirect(base_url());
        }
        
    }

}