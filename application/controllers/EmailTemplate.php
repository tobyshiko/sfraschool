<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailTemplate extends SFRA_Controller {

	function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('crud_model','crud');
        $this->crud->set_table('emailtemplate');
        $this->crud->set_keyid('emailtemplateid');
    }

    function index(){

        $this->isAdminUser();

        $query = $this->crud->getResults(); 
    	$this->page = 'admin/emailtemplate';
        $this->data['page_active'] = 'emailtemplate';
        $this->data['page_title'] = 'Email Template';        
        $this->data['page_data'] = $query->result();
        $this->layout();

    }

}