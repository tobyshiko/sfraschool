<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Login_model extends CI_Model { 
	
	function __construct(){
        parent::__construct();
    }

    function userLoginFunction (){

        $accountid = $this->input->post('lo');           
        $password = $this->input->post('password'); 
        $org = $this->input->post('organization'); 
        
        $credential = array('accountid' => $accountid, 'password' => sha1($password), 'organization' => $org, 'isactive' => 'true');

        if($org != ''){
            $query = $this->db->get_where('organization', array('orgname' => $org));

            if($query->num_rows() > 0){
                $row = $query->row();                
                
                $this->db->from('t_user');
                $this->db->join('t_userlogin', 't_user.id_user = t_userlogin.userid');                
                $this->db->where($credential);

                $query = $this->db->get();

                if ($query->num_rows() > 0) {
                    $row = $query->row();

                    $fullname = $row->firstname.' '. $row->lastname;

                    $mysessionData = array(
                        'organization'      => $row->organization,
                        'islogin'           => '1',
                        'loggedname'        => $fullname,
                        'login_type'        => $row->roles,
                        'userrankposition'  => 'CPT',
                        'userid'            => $row->id_user,
                        'accountid'         => $row->accountid,
                        'profileimage'      => $row->profileimage
                    );

                    $this->getUserRoles($row->roles);                 

                    
                    $this->session->set_userdata($mysessionData);
                    
                    $this->session->set_flashdata('flash_message', $fullname. ' '.'Successfully Login');
                    
                    redirect(base_url() . 'user', 'refresh');

                }else{
                    $this->session->set_flashdata('error_message', 'Invalid Login Detail');
                    redirect(base_url() . 'login', 'refresh');
                }

            }else{

                $this->session->set_flashdata('error_message', 'Invalid Login Detail');
                redirect(base_url() . 'login', 'refresh');
            
            }
        }else{
            $this->session->set_flashdata('error_message', 'Invalid Login Detail');
            redirect(base_url() . 'login', 'refresh');
        }
    }

    function signUpUser($data){

        $this->db->insert('users', $data);
        return $this->db->insert_id();

    }

    function checkCredentials($data){

        $this->db->from('users');
        $this->db->where($data);
        return $this->db->get();

    }

    function addUserDetails($data){
        $this->db->insert('usersdetails', $data);    
    }

    function getUserRoles($role){
        $this->db->from('t_roles');
        $this->db->join('t_rolesaccessto', 't_rolesaccessto.id_rolesaccessto = t_roles.id_roles');
        $this->db->join('t_rolesaccessdefinition', 't_rolesaccessdefinition.id_rad = t_rolesaccessto.id_rolesaccessto');
        $this->db->where('id_roles', $role);
        $result = $this->db->get()->result();

        $data = array();
        foreach ($result as $role) { 
            $data['userRoles'] = $role->roles;

            //if($role->modulecode == 'DOC_GEN'){
                $data['hasDocumentGenerator'] = $role->can_view;
            //}

            //if($role->modulecode == 'APP_ADM'){
                $data['hasAdmin'] = $role->can_view;   
            //}

                    
        }
        $this->session->set_userdata($data);
    }    

    public function isUserNameExist($username){
        $data = array(
            'username' => $username
        );

        $this->db->from('users');       
        $this->db->where($data);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isUserEmailExist($email){
        $data = array(
            'email' => $email
        );

        $this->db->from('users');       
        $this->db->where($data);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }    


    public function verifyAccount($uuid){
        $where = array(
            'userguid' => $uuid
        );

        $this->db->update('users', array('isactivated'=>TRUE), $where);
        return $this->db->affected_rows();
    }
	
}
