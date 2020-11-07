<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
        parent::__construct();
    }

    function index(){

    	$data['user_role'] = 'student';
    	$data['page_name'] = 'table';
    	$data['page_data'] = 'table123';
    	$this->load->view('template/main',$data);
    }

}