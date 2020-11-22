<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notfound extends SFRA_Controller {

	function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('crud_model','crud');
    }

    function index(){

		$this->page = 'staticpage/notfound';
        $this->data['page_active'] = '';
        $this->data['page_title'] = '';        
        $this->data['page_data'] = 'Page Not Found!!!';
        $this->layout();

    }

}