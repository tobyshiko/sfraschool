<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends SFRA_Controller {

	function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('crud_model','crud');
    }

    function index(){

        $this->isAdminUser();

        $this->crud->set_table('courses');
        $query = $this->crud->getResults(); 
        $this->data['courseinfo'] = $query->result();

        if($this->input->post('btnApplyFilter')){

            $query = $this->crud->call_SP('getCourseUserDetails',$this->input->post('course'));
            mysqli_next_result( $this->db->conn_id );
        	$this->page = 'admin/reports';
            $this->data['page_active'] = 'reports';
            $this->data['page_title'] = 'Reports';       
            $this->data['page_data'] = $query->result();
            

        }else if($this->input->post('btnShowDetails')){
            $query = $this->crud->call_SP('getCourseUserDetails',$this->input->post('course'));
            mysqli_next_result( $this->db->conn_id );
            $this->page = 'admin/reports';
            $this->data['page_active'] = 'reports';
            $this->data['page_title'] = 'Reports';       
            $this->data['page_data'] = $query->result();

        }else{
        
            $this->page = 'admin/reports';
            $this->data['page_active'] = 'reports';
            $this->data['page_title'] = 'Reports';        
            $this->data['page_data'] = '';
        }


        $this->layout();
    }


    function show_reqdetails($user,$courseid){

        $this->isAdminUser();


        $params = $courseid.",'".$user."'";
        $query = $this->crud->call_SP('getCourseReqDetails',$params);

        echo json_encode(array('status'=>TRUE,'results'=>$query->result()));

    }

    function attachment_action(){
        
        $this->isAdminUser();

        $myusername = $this->session->userdata('sfra_s3ss10n_l0g')['username'];
        $myfullname = $this->session->userdata('sfra_s3ss10n_l0g')['loggedname'];

        $this->crud->set_table('studentcoursereq');
        if($this->input->post('btnApproveAttachment')){           
            $screqid = $this->input->post('studentcoursereq');
            //$username = $this->input->post('username');
            $data = array(
                'reqstatus'  => 'Verified'
            );

            $results = $this->crud->update(array('studentcoursereqid' => $screqid), $data);
            
            if($results > 0){
                //$this->session->set_flashdata('flash_message', 'Attachment had been tag as Verified');
                
                $query = $this->crud->call_SP('getRequirementCourse',$screqid);
                mysqli_next_result( $this->db->conn_id );
                //$user = $this->crud->getUsersDetails($username);
                //FOR NOTIFICATIONS
                if($query->num_rows() > 0){
                    $coursereq = $query->row();
                    $notidata = array(
                        'touser'    =>  $coursereq->username,
                        'toname'    =>  $coursereq->first_name.' '.$coursereq->last_name,
                        'fromuser'  =>  $myusername,
                        'fromname'  =>  $myfullname,
                        'message'   =>  'Requirement '.$coursereq->requirementname.' for the Course '.$coursereq->coursecode.' '.$coursereq->courseclass.' has been verified',
                        'sentdatetime'  =>  mdate("%Y-%m-%d %H:%i:%s"),
                        'isread'    => 0
                    );
                    $this->crud->set_table('notifications');
                    $this->crud->save($notidata);
                }
                

                echo json_encode(array("status" => TRUE,'message'=>'Attachment had been tag as Verified','elementInput'=>array("reqstatus".$screqid,"Verified")));
            }else{
                echo json_encode(array("status" => FALSE,'errors'=>'Attachment already Verified'));
            }

        }else if($this->input->post('btnResubmitAttachment')){
            $screqid = $this->input->post('studentcoursereq');
            $data = array(
                'reqstatus'  => 'Resubmit'
            );

            $results = $this->crud->update(array('studentcoursereqid' => $this->input->post('studentcoursereq')), $data);

            if($results > 0){
                //$this->session->set_flashdata('flash_message', 'Attachment had been tag as Resubmit');

                $query = $this->crud->call_SP('getRequirementCourse',$screqid);
                mysqli_next_result( $this->db->conn_id );
                //$user = $this->crud->getUsersDetails($username);
                //FOR NOTIFICATIONS
                if($query->num_rows() > 0){
                    $coursereq = $query->row();
                    $notidata = array(
                        'touser'    =>  $coursereq->username,
                        'toname'    =>  $coursereq->first_name.' '.$coursereq->last_name,
                        'fromuser'  =>  $myusername,
                        'fromname'  =>  $myfullname,
                        'message'   =>  'Requirement '.$coursereq->requirementname.' for the Course '.$coursereq->coursecode.' '.$coursereq->courseclass.' has been rejected and tag Resubmit. Kindly submit natcasesort(array)ew attachment.',
                        'sentdatetime'  =>  mdate("%Y-%m-%d %H:%i:%s"),
                        'isread'    => 0
                    );
                    $this->crud->set_table('notifications');
                    $this->crud->save($notidata);
                }

                echo json_encode(array("status" => TRUE,'errors'=>'Attachment had been tag as Resubmit','elementInput'=>array("reqstatus".$screqid,"Resubmit")));
            }

        }else{
            redirect(base_url());
        }


    }

    function approve_reg(){

        $this->isAdminUser();

        $myusername = $this->session->userdata('sfra_s3ss10n_l0g')['username'];
        $myfullname = $this->session->userdata('sfra_s3ss10n_l0g')['loggedname'];

        if($this->input->post('btnApproveReg')){
            $course = $this->input->post('hiddencourse');
            $user = $this->input->post('hiddenuser');
            $scr = $this->input->post('hiddenscr');
            if($user !="" && $course != ""){

                $params = $course.",'".$user."'";
                $query = $this->crud->call_SP('checkUserReqStatus',$params);
                mysqli_next_result( $this->db->conn_id );
                if($query->num_rows() == 1){
                    $row = $query->row();
                    if($row->reqstatus == 'Verified'){

                        $query = $this->crud->call_SP('getCourseReqDetails',$params);
                        mysqli_next_result( $this->db->conn_id );
                        foreach($query->result() as $row){
                            $data = array(
                                'status'    => 'APPROVED',
                                'remarks'   => 'Registration has been approved',
                                'approvaldatetime' => mdate("%Y-%m-%d %H:%i:%s"),
                                'approvedby'    => $myusername
                            );
                            $this->crud->set_table('studentcoursereq');
                            $this->crud->update(array('studentcoursereqid' => $row->studentcoursereqid),$data);
                        }

                        $query = $this->crud->call_SP('getRequirementCourse',$scr);
                        mysqli_next_result( $this->db->conn_id );
                        //$user = $this->crud->getUsersDetails($username);
                        //FOR NOTIFICATIONS
                        if($query->num_rows() > 0){
                            $coursereq = $query->row();
                            $notidata = array(
                                'touser'    =>  $coursereq->username,
                                'toname'    =>  $coursereq->first_name.' '.$coursereq->last_name,
                                'fromuser'  =>  $myusername,
                                'fromname'  =>  $myfullname,
                                'message'   =>  'Your Registration for the Course '.$coursereq->coursecode.' '.$coursereq->courseclass.' has been Approved.',
                                'sentdatetime'  =>  mdate("%Y-%m-%d %H:%i:%s"),
                                'isread'    => 0
                            );
                            $this->crud->set_table('notifications');
                            $this->crud->save($notidata);
                        }


                        echo json_encode(array("status" => TRUE,'message'=>'Registration has been Approved','elementInput'=>array("status".$scr,"APPROVED")));
                    }else{
                        echo json_encode(array("status" => FALSE,'errors'=>'Attachment must be verified'));
                    }
                }else{
                    echo json_encode(array("status" => FALSE,'errors'=>'Attachment must be verified'));
                }

                
            }else{
                echo json_encode(array("status" => FALSE,'errors'=>'Please select the course and registered user!!!'));
            }
        }
        //  
    }

}