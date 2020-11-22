<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RequirementsCourses extends SFRA_Controller {

	function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('crud_model','crud');
        $this->crud->set_table('courserequirements');
        $this->crud->set_keyid('coursereqid');
    }

    function index(){

        $this->isAdminUser();

        $query = $this->crud->getResults(); 

        $this->page = 'admin/coursesrequirements';
        $this->data['page_active'] = 'coursesrequirements';
        $this->data['page_title'] = 'Requirements per Courses';        
        $this->data['page_data'] = $query->result();

        $this->crud->set_table('courses');
        $criteria = array(
            'active' => TRUE
        );
        $query = $this->crud->getResultsCriteria($criteria,array('orderkey' => 'coursename', 'orderset' => 'desc'));
        $this->data['courseslist'] = $query->result();

        /*
        $criteria = array(
            'courseid' => $query->result()->row()->courseid
        );
        $this->crud->set_table('courserequirements');        
        $query = $this->crud->getResultsCriteria($criteria,null);
        $this->data['courserequirementslist'] = $query->result();
        */
        $this->crud->set_table('requirements');        
        $query = $this->crud->getResults();
        $this->data['requirementslist'] = $query->result();

        $this->layout();   	
        
    }

    function add(){

        $this->isAdminUser();

        if($this->input->post('btnAddCourseRequirement')){

            $myusername = $this->session->userdata('sfra_s3ss10n_l0g')['username'];
            $useremail = $this->session->userdata('sfra_s3ss10n_l0g')['useremail'];

            $number = count($this->input->post('requirements')); 

            if($number > 0)  
            {  
                

                for($i=0; $i<$number; $i++)  
                {  
                    if(trim($this->input->post('requirements')[$i] != ''))  
                    {  
                        $data = array(
                            'requirementid' => $this->input->post('requirements')[$i],
                            'courseid'      => $this->input->post('course'),
                            'createdby'     => $myusername,
                            'updatedby'     => $myusername
                        );
                        $this->crud->set_table('courserequirements');
                        $insertid = $this->crud->save($data);

                        // IF Requirements added in course it will added in student reg if exists
                        $this->crud->set_table('studentcoursereq');
                        $this->crud->set_keyid('coursereqid');
                        $query = $this->crud->getJoinResultsCriteria(array('courseid'=>$this->input->post('course')),array('table'=>'courserequirements','col'=>'coursereqid'),'studentcoursereq.username');

                        if($query->num_rows() > 0 && $insertid){

                           foreach($query->result() as $row){
                                 $data1 = array(
                                    'username'          =>  $row->username,
                                    'useremail'         =>  $row->useremail,
                                    'coursereqid'       =>  $insertid,
                                    'dateregistration'  =>  mdate("%Y-%m-%d"),
                                    'status'            => 'DRAFT',
                                    'remarks'           =>  'Registration on draft'
                                );
                                
                                $this->crud->save($data1);
                           }

                           
                        }

                    }  
                } 

                $this->session->set_flashdata('flash_message', 'Records successfully addedd!!!');
                echo json_encode(array("status" => TRUE));
            }
            

            
        }else{
            redirect(base_url());
        }

    }

    function delete($id){

        $this->isAdminUser();

        $this->crud->delete_by_id($id);
        
        redirect(base_url('requirementscourses'));

    }

    /**
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

    **/
}