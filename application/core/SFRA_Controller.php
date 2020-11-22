<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SFRA_Controller extends CI_Controller {

	protected $data = array();

	function __construct()
 	{
		parent::__construct();	

		$this->data['loggedin'] 	= $this->session->userdata('sfra_s3ss10n_l0g')['islogin'];
		$this->data['myusername'] 	= $this->session->userdata('sfra_s3ss10n_l0g')['username'];
		$this->data['profilepic'] 	= $this->session->userdata('sfra_s3ss10n_l0g')['profilepic'];
  		$this->data['myuserRole'] 	= $this->session->userdata('sfra_s3ss10n_l0g')['userRole'];
  		$this->data['loggeduser']  	= $this->session->userdata('sfra_s3ss10n_l0g')['loggedname'];
  		$this->data['colorSidebar']	= $this->session->userdata('sfra_s3ss10n_l0g_settings')['sidebarcolor'];
  		$this->data['uidateFormat']	= $this->session->userdata('sfra_s3ss10n_l0g_settings')['dateformat'] ? $this->session->userdata('sfra_s3ss10n_l0g_settings')['dateformat'] : 'd M Y';

	}

	public function layout()
	{

		$this->template['page'] = $this->load->view($this->page,$this->data,TRUE);
		$this->load->view('template/main',$this->template);
	}

	public function isLogUser(){
		if(!$this->data['loggedin']){
            //show_error('Shove off, this is for Logged in User.');
            redirect(base_url());
        }
	}

	public function isAdminUser(){
		if(!$this->data['loggedin']){
            //show_error('Shove off, this is for Logged in User.');
            redirect(base_url());
        }else if($this->data['myuserRole'] != 'admin'){
        	//show_error('Shove off, You dont\' have rights.');
        	redirect(base_url());
        }
	}
}
