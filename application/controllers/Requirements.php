<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requirements extends SFRA_Controller {

	function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('crud_model','crud');
        $this->crud->set_table('requirements');
        $this->crud->set_keyid('requirementid');
    }

    /**
    function index(){

        $this->isAdminUser();

        $query = $this->crud->getResults(); 

        $this->page = 'admin/requirements';
        $this->data['page_active'] = 'requirements';
        $this->data['page_title'] = 'Requirements';        
        $this->data['page_data'] = $query->result();
        $this->layout();   	
        
    }
    **/

    function view_list(){

        $this->isAdminUser();

        $query = $this->crud->getResults(); 

        $this->page = 'admin/requirements';
        $this->data['page_active'] = 'requirements';
        $this->data['page_title'] = 'Requirements';        
        $this->data['page_data'] = $query->result();
        $this->layout();    
        
    }

    function add_update(){

        $this->isAdminUser();

        if($this->input->post('btnAddRequirement')){

            $myusername = $this->session->userdata('sfra_s3ss10n_l0g')['username'];

            $data = array(
                
                'requirementname'   => $this->input->post('requirementname'),
                'requirementdesc'   => $this->input->post('requirementdesc'),
                'createdby'         => $myusername,
                'updatedby'         => $myusername
            );

            $this->crud->save($data);

            $this->session->set_flashdata('flash_message', 'Requirement successfully addedd!!!');
            echo json_encode(array("status" => TRUE));
        }else if($this->input->post('btnUpdateRequirements')){

            $myusername = $this->session->userdata('sfra_s3ss10n_l0g')['username'];

            $data = array(
                
                'requirementname'   => $this->input->post('requirementname'),
                'requirementdesc'   => $this->input->post('requirementdesc'),
                'updatedby'         => $myusername,
                'updateddatetime'   => mdate("%Y-%m-%d %H:%i:%s")
            );

            $this->crud->update(array('requirementid' => $this->input->post('id')),$data);

            $this->session->set_flashdata('flash_message', 'Requirement successfully updated!!!');
            echo json_encode(array("status" => TRUE));

        }else{
            redirect(base_url());
        }

    }

    function edit($id){

        $this->isAdminUser();       

        $data = $this->crud->get_by_id($id);        

        echo json_encode($data);

    }

    function delete($id){

        $this->isAdminUser();

        $this->crud->delete_by_id($id);
        echo json_encode(array("status" => TRUE));

    }

    function enrollment(){

        $this->isLogUser();
        $this->page = 'student/enrollment';
        $this->data['page_active'] = 'courses';
        $this->data['page_title'] = 'Courses';        
        //$this->data['page_data'] = $query->result();
        $this->layout();   
    }

    function enroll(){

        $this->isLogUser();

        $this->crud->set_table('usersdetails');

        $query = $this->crud->getResultsCriteria(array('username'=>$this->session->userdata('sfra_s3ss10n_l0g')['username'],'isupdated'=>1),null);

        if($query->num_rows() > 0){
            
            
            
            $this->session->set_flashdata('flash_message', 'Kindly fillup required fields to complete your enrollment');
            echo json_encode(array("status" => TRUE,'message'=>'Kindly fillup required fields to complete your enrollment','pageredirect'=>base_url('courses/enrollment/')));
        }else{
            //
            $this->session->set_flashdata('error_message', 'Update your profile first!!! Before you can enroll to the course');
            echo json_encode(array("status" => FALSE,'message'=>'Update your profile first!!!','pageredirect'=>base_url('user')));
        }

        

    }
}