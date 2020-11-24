<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Emailtemplate_model extends CI_Model { 
	
	function __construct(){
        parent::__construct();
    }

    public function sendEmail($data, $templatename){

    	$dataEmail = array();

    	$this->db->from('emailtemplate');       
        $this->db->where(array('templatename' => $templatename));
        $query = $this->db->get();

        if($query->result()){
    		$row = $query->row();
    		$dataEmail['subject'] = $row->subject;
    		$dataEmail['message'] =	str_replace('{fname}',$data['fname'],$row->message); 
    		$dataEmail['message'] =	str_replace('{verifybtn}',$data['verifybtn'],$dataEmail['message']); 
    	}

        $this->email->from('admin@sfra.online', 'SFR(A) - Admininstrator');
        $this->email->to($data['to']);

        $this->email->subject($dataEmail['subject']);
        $this->email->message($dataEmail['message']);

        $this->email->send();
    }

    public function sendEmailVerification($data, $templatename){

        $dataEmail = array();

        $this->db->from('emailtemplate');       
        $this->db->where(array('templatename' => $templatename));
        $query = $this->db->get();

        if($query->result()){
            $row = $query->row();
            $dataEmail['subject'] = $row->subject;
            $dataEmail['message'] = str_replace('{fname}',$data['fname'],$row->message); 
            $dataEmail['message'] = str_replace('{coursename}',$data['cname'],$dataEmail['message']);
            $dataEmail['message'] = str_replace('{coursecode}',$data['ccode'],$dataEmail['message']);
            $dataEmail['message'] = str_replace('{courseclass}',$data['cclass'],$dataEmail['message']);
            $dataEmail['message'] = str_replace('{linkbtn}',$data['linkbtn'],$dataEmail['message']); 
        }

        $this->email->from('admin@sfra.online', 'SFR(A) - Admininstrator');
        $this->email->to($data['to']);

        $this->email->subject($dataEmail['subject']);
        $this->email->message($dataEmail['message']);

        $this->email->send();
    }

    public function sendEmailForgotPassword($data, $templatename){

        $dataEmail = array();

        $this->db->from('emailtemplate');       
        $this->db->where(array('templatename' => $templatename));
        $query = $this->db->get();

        if($query->result()){
            $row = $query->row();
            $dataEmail['subject'] = $row->subject;
            $dataEmail['message'] = str_replace('{fname}',$data['fname'],$row->message); 
            $dataEmail['message'] = str_replace('{password}',$data['password'],$dataEmail['message']); 
        }

        $this->email->from('admin@sfra.online', 'SFR(A) - Admininstrator');
        $this->email->to($data['to']);

        $this->email->subject($dataEmail['subject']);
        $this->email->message($dataEmail['message']);

        $this->email->send();
    }


    function signUpEmailTemplate(){
    	$data = array();
    	$query = $this->getSignUpEmailTemplate();

    	if($query->result()){
    		$row = $query->row();
    		$data['subject'] = 	$row->subject;
    		$data['message'] =	$row->message; 
    	}

    	return $data;
    }

    function getSignUpEmailTemplate(){

    	$this->db->from('emailtemplate');       
        $this->db->where(array('templatename' => 'signup'));
        return $this->db->get();

    }

    function getEmailTemplate($data){


    	$this->db->from('emailtemplate');       
        $this->db->where($data);
        return $this->db->get();

    }
}