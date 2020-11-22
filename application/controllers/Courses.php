<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends SFRA_Controller {

	function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('crud_model','crud');
        $this->load->model('emailtemplate_model','emailtemplate');
        $this->crud->set_table('courses');
        $this->crud->set_keyid('courseid');
    }

    function index(){

        if(!$this->session->userdata('sfra_s3ss10n_l0g')['islogin']){
            //$this->crud->set_table('courses');
            $criteria = array(
                'active' => TRUE,
            );
            $query = $this->crud->getResultsCriteria($criteria,array('orderkey' => 'coursename', 'orderset' => 'desc')); 

            $this->page = 'student/courses';
            $this->data['page_active'] = 'courses';
            $this->data['page_title'] = 'Courses';        
            $this->data['page_data'] = $query->result();
            $this->layout(); 

            return true; 
        }



        $this->crud->set_table('courserequirements');
        $this->crud->set_keyid('coursereqid');

        $query = $this->crud->getResults(); 
        
        $this->page = 'student/coursereq';
        $this->data['page_active'] = 'courses';
        $this->data['page_title'] = 'Courses';        
        $this->data['page_data'] = $query->result();

        $this->crud->set_table('courses');
        $criteria = array(
            'active' => TRUE
        );
        $query = $this->crud->getResultsCriteria($criteria,array('orderkey' => 'coursename', 'orderset' => 'desc'));
        $this->data['courseslist'] = $query->result();

        $this->crud->set_table('requirements');        
        $query = $this->crud->getResults();
        $this->data['requirementslist'] = $query->result();

        $this->layout();     	
        
    }

    function view_list(){
        
        $this->isAdminUser();

        $query = $this->crud->getResults();
        $this->page = 'admin/courses';
        $this->data['page_active'] = 'admincourse';
        $this->data['page_title'] = 'Courses';        
        $this->data['page_data'] = $query->result();
        $this->layout();    
    }

    function add_update(){

        $this->isAdminUser();

        if($this->input->post('btnAddCourse')){

            $newDateCourseStart = nice_date(str_replace(' ','-', $this->input->post('coursestarted')),'Y-m-d');
            $newDateCourseStart = nice_date(str_replace('/','-', $this->input->post('coursestarted')),'Y-m-d');

            $newDateRegStart = nice_date(str_replace(' ','-', $this->input->post('regstart')),'Y-m-d');
            $newDateRegStart = nice_date(str_replace('/','-', $this->input->post('regstart')),'Y-m-d');

            $newDateRegEnd = nice_date(str_replace(' ','-', $this->input->post('regend')),'Y-m-d');
            $newDateRegEnd = nice_date(str_replace('/','-', $this->input->post('regend')),'Y-m-d');

            $data = array(
                'coursecode'        => $this->input->post('coursecode'),
                'coursename'        => $this->input->post('coursename'),
                'coursedescription' => $this->input->post('coursedesc'),
                'courseclass'       => $this->input->post('courseclass'),
                'coursethumbnail'   => $this->input->post('picture'),
                'active'            => $this->input->post('active') == 'on' ? 1 : 0,
                'coursestarted'     => $newDateCourseStart,
                'regstart'          => $newDateRegStart,
                'regend'            => $newDateRegEnd,
                'totalquota'        => $this->input->post('totalquota'),
                'sfraunitquota'     => $this->input->post('sfra'),
                'armyquota'         => $this->input->post('army'),
                'navyquota'         => $this->input->post('navy'),
                'airforcequota'     => $this->input->post('airforce'),
                'policequota'       => $this->input->post('police'),
                'createdby'         => $this->session->userdata('sfra_s3ss10n_l0g')['username'],
                'updatedby'         => $this->session->userdata('sfra_s3ss10n_l0g')['username']
            );

            $this->crud->save($data);

            $this->session->set_flashdata('flash_message', 'Course successfully addedd!!!');
            echo json_encode(array("status" => TRUE));
        }else if($this->input->post('btnUpdateCourse')){

            $newDateCourseStart = nice_date(str_replace(' ','-', $this->input->post('coursestarted')),'Y-m-d');
            $newDateCourseStart = nice_date(str_replace('/','-', $this->input->post('coursestarted')),'Y-m-d');

            $newDateRegStart = nice_date(str_replace(' ','-', $this->input->post('regstart')),'Y-m-d');
            $newDateRegStart = nice_date(str_replace('/','-', $this->input->post('regstart')),'Y-m-d');

            $newDateRegEnd = nice_date(str_replace(' ','-', $this->input->post('regend')),'Y-m-d');
            $newDateRegEnd = nice_date(str_replace('/','-', $this->input->post('regend')),'Y-m-d');


            $data = array(
                'coursecode'        => $this->input->post('coursecode'),
                'coursename'        => $this->input->post('coursename'),
                'coursedescription' => $this->input->post('coursedesc'),
                'courseclass'       => $this->input->post('courseclass'),
                'coursethumbnail'   => $this->input->post('picture'),                
                'coursestarted'     => $newDateCourseStart,
                'regstart'          => $newDateRegStart,
                'regend'            => $newDateRegEnd,
                'totalquota'        => $this->input->post('totalquota'),
                'sfraunitquota'     => $this->input->post('sfra'),
                'armyquota'         => $this->input->post('army'),
                'navyquota'         => $this->input->post('navy'),
                'airforcequota'     => $this->input->post('airforce'),
                'policequota'       => $this->input->post('police'),                
                'updatedby'         => $this->session->userdata('sfra_s3ss10n_l0g')['username'],
                'updateddatetime'   => mdate("%Y-%m-%d %H:%i:%s")
            );

            $this->crud->update(array('courseid' => $this->input->post('id')),$data);

            $this->session->set_flashdata('flash_message', 'Course successfully updated!!!');
            echo json_encode(array("status" => TRUE));
        }else{

            $this->session->set_flashdata('error_message', 'Pleasse contact the Admin!!!');
            echo json_encode(array("status" => FALSE));
            redirect(base_url());
        }

    }

    function edit($id){

        $this->isAdminUser();

        $dateformat = $this->session->userdata('sfra_s3ss10n_l0g_settings')['dateformat'];

        $data = $this->crud->get_by_id($id);
        //  $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility

        $data->coursestarted = ($data->coursestarted == '0000-00-00') ? '' : nice_date($data->coursestarted, $dateformat);
        $data->regstart = ($data->regstart == '0000-00-00') ? '' : nice_date($data->regstart, $dateformat);
        $data->regend = ($data->regend == '0000-00-00') ? '' : nice_date($data->regend, $dateformat);

        echo json_encode($data);

    }

    function delete($id){

        $this->isAdminUser();

        $this->crud->delete_by_id($id);
        echo json_encode(array("status" => TRUE));

    }

    function enabled($id){

        $this->isAdminUser();

        $data = array(
            'active' => 1
        );
        $this->crud->update(array('courseid' => $id), $data);
        echo json_encode(array("status" => TRUE));

    }

    function disabled($id){

        $this->isAdminUser();

         $data = array(
            'active' => 0
        );
        $this->crud->update(array('courseid' => $id), $data);
        echo json_encode(array("status" => TRUE));

    }


    function enrollment($decoy, $id, $pactive=null, $ptitle=null){

        $this->isLogUser();

        $myusername = $this->session->userdata('sfra_s3ss10n_l0g')['username'];

        if($decoy == sha1($id)){
            $this->crud->set_table('courses');
            $this->page = 'student/enrollment';
            $this->data['page_active'] = $pactive ? $pactive : 'courses';
            $this->data['page_title'] = $ptitle ? str_replace('%20', ' ', $ptitle) : 'Courses';        

            $criteria = array(
                'active'    => TRUE,
                'courseid'  => $id
            );
            $query = $this->crud->getResultsCriteria($criteria,null); 
            $this->data['courseinfo'] =  $query->result();


            $criteria = array(
                'active'    => TRUE,
                'courseid'  => $id
            );
            $query = $this->crud->getResultsCriteria($criteria,null); 
            $this->data['courseinfo'] =  $query->result();


            $criteria = array(
                'courseid'  => $id,
                'username'  => $myusername
            );
            $this->crud->set_table('studentcoursereq');
            $this->crud->set_keyid('coursereqid');
            $query = $this->crud->getJoin2ResultsCriteria($criteria,array(
                'table1'    =>  'courserequirements',
                'col1'      =>  'coursereqid',
                'col1_1'    =>  'requirementid',
                'table2'    =>  'requirements',
                'col2'      =>  'requirementid'

            ),'courseid'); 
            //$enrollmentinfo = array('status' =>  'DRAFT','remarks' => 'Transaction on Draft');
            $this->data['enrollmentinfo'] = $query->result();

            /**
            $criteria = array(
                'courseid'  => $id
            );
            $this->crud->set_table('courserequirements');
            $this->crud->set_keyid('requirementid');
            $query = $this->crud->getJoinResultsCriteria($criteria,array('table'=>'requirements', 'col'=>'requirementid'));
            $this->data['requirementsinfo'] =  $query->result();
            **/

            $criteria = array(
                'courseid'  => $id,
                'username'  => $myusername
            );

            //$this->crud->set_table('studentcoursereq');
            //$this->crud->set_keyid('coursereqid');
            $query = $this->crud->getJoin2ResultsCriteria($criteria,array(
                'table1'    =>  'courserequirements',
                'col1'      =>  'coursereqid',
                'col1_1'    =>  'requirementid',
                'table2'    =>  'requirements',
                'col2'      =>  'requirementid'

            ),null); 

            //$query = $this->crud->getJoin2ResultsCriteria($criteria,array('table'=>'requirements', 'col'=>'requirementid'));
            $this->data['requirementsinfo'] =  $query->result();

            $this->layout();
        }else{
            redirect(base_url('notfound'));
        }
    }

    function enroll($id){

        $this->isLogUser();

        $myusername = $this->session->userdata('sfra_s3ss10n_l0g')['username'];
        $useremail = $this->session->userdata('sfra_s3ss10n_l0g')['useremail'];

        $this->crud->set_table('usersdetails');
        $this->crud->set_keyid('userid');
        $cid = sha1($id);

        $query = $this->crud->getResultsCriteria(array('username'=>$myusername,'isupdated'=>1),null);

        if($query->num_rows() > 0){

            $this->crud->set_table('courserequirements');
            $this->crud->set_keyid('coursereqid');
            $query = $this->crud->getResultsCriteria(array('courseid' => $id),null);

            if($query->num_rows() > 0){
                foreach ($query->result() as $row){

                    $data = array(
                        'username'          =>  $myusername,
                        'useremail'         =>  $useremail,
                        'coursereqid'       =>  $row->coursereqid,
                        'dateregistration'  =>  mdate("%Y-%m-%d"),
                        'status'            => 'DRAFT',
                        'remarks'           =>  'Registration on draft'
                    );


                    $this->crud->set_table('studentcoursereq');
                    $this->crud->set_keyid('studentcoursereqid');
                    $insertid = $this->crud->save($data);  

                    if(!$insertid){
                        $this->session->set_flashdata('error_message', 'Registered');
                    }

                }
                /**
                if($insertid){
                    $this->session->set_flashdata('flash_message', 'Kindly fillup required fields to complete your enrollment');                    
                }else{
                    echo "Already Registered";
                    return
                }
                */
                $this->session->set_flashdata('flash_message', 'Kindly fillup required fields to complete your enrollment'); 
                echo json_encode(array("status" => TRUE,'message'=>'Kindly fillup required fields to complete your enrollment','pageredirect'=>base_url('courses/enrollment/').$cid.'/'.$id));
            }else{
                $this->session->set_flashdata('error_message', 'Course not configured yet, Contact Administrator');
                echo json_encode(array("status" => FALSE));
            }
            
        } else {
            //
            $this->session->set_flashdata('error_message', 'Update your profile first!!! Before you can enroll to the course');
            echo json_encode(array("status" => FALSE,'message'=>'Update your profile first!!!','pageredirect'=>base_url('user')));
        }      

    }

    function mycourses(){

        $this->isLogUser();

        $this->crud->set_table('studentcoursereq');
        $this->crud->set_keyid('coursereqid');

        $criteria = array(
            'username' => $this->session->userdata('sfra_s3ss10n_l0g')['username']
        );

        $query = $this->crud->getJoin2ResultsCriteria($criteria,array(
            'table1'    =>  'courserequirements',
            'col1'      =>  'coursereqid',
            'col1_1'    =>  'courseid',
            'table2'    =>  'courses',
            'col2'      =>  'courseid'

        ),'courseid'); 

        $this->page = 'student/mycourses';
        $this->data['page_active'] = 'mycourses';
        $this->data['page_title'] = 'My Courses';        
        $this->data['page_data'] = $query->result();
        $this->layout(); 

        return true; 

    }

    function submit_req($id){

        $this->isLogUser();

        //$adminemail = 'tobytetet@gmail.com';

        $myusername = $this->session->userdata('sfra_s3ss10n_l0g')['username'];
        $myfullname = $this->session->userdata('sfra_s3ss10n_l0g')['loggedname'];

        $this->crud->set_table('studentcoursereq');
        $this->crud->set_keyid('coursereqid');

        $criteria = array(
            'courses.courseid'  => $id,
            'username'  => $myusername
        );

        $query = $this->crud->getJoin2ResultsCriteria($criteria,array(
            'table1'    =>  'courserequirements',
            'col1'      =>  'coursereqid',
            'col1_1'    =>  'courseid',
            'table2'    =>  'courses',
            'col2'      =>  'courseid'

        ),null); 

        $result = '';
        $cname = '';
        $ccode = '';
        $cclass = '';
        $courseadmin = '';
        
        foreach ($query->result() as $row){
            $data = array(                
                'status'            => 'PENDING',
                'remarks'           =>  'Registration on verification'
            );

            $cname = $row->coursename;
            $ccode = $row->coursecode;
            $cclass = $row->courseclass;
            $courseadmin = $row->courseadmin;
            $result = $this->crud->update(array('coursereqid'=>$row->coursereqid),$data);           
        }

        if($result){

            $linkv = 'courses/view_list';
            $user = $this->crud->getUsersDetails($courseadmin);


            //FOR EMAIL
            $verificationdata = array(
                'to'        =>  $user->email,//$adminemail,
                'linkbtn'   =>  '<a class="btn btn-primary" href="'.base_url($linkv).'">Check Requirements</a>',
                'fname'     =>  $this->session->userdata('sfra_s3ss10n_l0g')['loggedname'],
                'cname'     => $cname,
                'ccode'     => $ccode,
                'cclass'     => $cclass
            );
            $this->emailtemplate->sendEmailVerification($verificationdata,'verification');

            //FOR NOTIFICATIONS
            $notidata = array(
                'touser'    =>  $user->username,
                'toname'    =>  $user->first_name.' '.$user->last_name,
                'fromuser'  =>  $myusername,
                'fromname'  =>  $myfullname,
                'message'   => 'Requirements submitted for verification',
                'sentdatetime'  =>  mdate("%Y-%m-%d %H:%i:%s"),
                'isread'    => 0
            );
            $this->crud->set_table('notifications');
            $this->crud->save($notidata);

            $this->session->set_flashdata('flash_message', 'Submitted for Verification process by SFR(A) Team!!!');

            //echo json_encode(array("status" => TRUE,'message'=>'Submitted for Verification process'));
            redirect(base_url('courses/enrollment/'.sha1($row->courseid).'/'.$row->courseid.'/mycourses/My Courses')); 
        }else{
            //echo json_encode(array("status" => FALSE,'message'=>'Contact Administrator'));
            $this->session->set_flashdata('error_message', 'Contact Administrator!!!');
            redirect(base_url('courses/enrollment/'.sha1($row->courseid).'/'.$row->courseid.'/mycourses/My Courses'));  
        }

        

    }

    function upload_req($param1,$param2){

        $myusername = $this->session->userdata('sfra_s3ss10n_l0g')['username'];

        $pathToUpload = "images/attachment/".$myusername;

        $config['upload_path']=$pathToUpload;
        $config['allowed_types']='gif|jpg|png';
        $config['max_size']      = 5000; 

        $this->load->helper('file');
        $this->load->library('upload',$config);


        if($this->upload->do_upload("imageUpload")){
            $data = array('upload_data' => $this->upload->data());
            $image= $data['upload_data']['file_name'];            
            $data = array(
                'attachment' => $pathToUpload.'/'.$image,
                'reqstatus' => 'Uploaded'
            );

            $this->crud->set_table('studentcoursereq');            
            $this->crud->update(array('username' => $myusername, 'studentcoursereqid' => $this->input->post('studentcoursereq')), $data);


            $this->session->set_flashdata('flash_message', 'Attachment uploaded successfully!!!');

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

            redirect(base_url('courses/enrollment/'.$param1.'/'.$param2.'/mycourses/My Courses')); 
        }else{
          
            $this->session->set_flashdata('error_message', $this->upload->display_errors());

            redirect(base_url('courses/enrollment/'.$param1.'/'.$param2.'/mycourses/My Courses')); 
        } 
    }
}