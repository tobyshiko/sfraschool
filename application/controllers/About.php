<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends SFRA_Controller {

	function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('crud_model','crud');
    }

    function index(){

      
		$this->page = 'staticpage/about';
        $this->data['page_active'] = 'about';
        $this->data['page_title'] = 'About';        
        $this->data['page_data'] = '123';
        $this->layout();

       
    }

}