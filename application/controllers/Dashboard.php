<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
        parent::__construct();
    }

    function index(){    	

        if($this->session->userdata('sfra_s3ss10n_l0g')['islogin']){

            $data['page_dir'] = 'student';
            $data['page_name'] = 'dashboard';
            $data['page_menu'] = 'My';
            $data['page_active'] = 'dashboard'; 
            $data['page_title'] = 'My Dashboard';
            $data['page_data'] = 'table123';
            $this->load->view('template/main',$data);
            
            

        } else {;

            $data['page_dir'] = 'student';
            $data['page_name'] = 'dashboard';
            $data['page_menu'] = '';
            $data['page_active'] = 'dashboard'; 
            $data['page_title'] = 'Dashboard';
            $data['page_data'] = 'table123';
            $this->load->view('template/main',$data);
        }
    }

}