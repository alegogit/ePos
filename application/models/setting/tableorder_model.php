<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tableorder_model extends CI_Model {
  function __construct(){
    // Call the Model constructor
    parent::__construct();
  }
	 
	function get_profile(){
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['id'];
		$this->db->where('ID',$id);
    $query = $this->db->get('USERS');
    return $query->row();
  } 
  
  function get_restaurant(){
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['id'];
		if($session_data['role']!=1){   
      $this->db->where('USERS_RESTAURANTS.USER_ID',$id);
      $query = $this->db->select('*')
                        ->from('RESTAURANTS')
                        ->join('USERS_RESTAURANTS', 'RESTAURANTS.ID = USERS_RESTAURANTS.REST_ID')
                        ->get('');
    } else {  
      $query = $this->db->select('*,ID AS REST_ID')
                        ->from('RESTAURANTS')
                        ->get('');
    }
    return $query->result();
  }                        
  
  function get_rest_logo(){
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['id'];
		$this->db->where('USERS_RESTAURANTS.USER_ID',$id); 
		$this->db->where('USERS_RESTAURANTS.DEFAULT_REST',1);
    $query = $this->db->select('LOGO_URL')
                      ->from('RESTAURANTS')
                      ->join('USERS_RESTAURANTS', 'RESTAURANTS.ID = USERS_RESTAURANTS.REST_ID')
                      ->limit(1)
                      ->get('');
    return $query->row()->LOGO_URL;
  }
    
	function get_username($id){
    $query = $this->db->select('NAME,USERNAME')
                      ->from('USERS')
                      ->where('ID',$id)
                      ->limit(1)
                      ->get('');
    return $query->row();
  }
  
	function get_restaurant_name($id){
    $query = $this->db->select('NAME AS REST_NAME')
                      ->from('RESTAURANTS')
                      ->where('ID',$id)
                      ->get('');
    return $query->row()->REST_NAME;
  }
       
	function get_rest_tableorder($rest_id){    
    $this->db->where('REST_ID',$rest_id);
    $query = $this->db->get('TABLES');
    return $query->result();
  }                                      
  
	function get_status(){  
    $this->db->where('LOOKUP_NAME','STATUS');
    $query = $this->db->get('REF_VALUES');
    return $query->result();
  }
  
  function set_status($stat){
    if($stat==1){
      $output = "Active";
    } else {
      $output = "<span style='color:#dd1144 !important;'>Inactive</span>";
    }
  } 
   
	function new_tableorder($TNUM,$POSITION,$REST_ID){       
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['id'];
    $query = $this->db->query('INSERT INTO TABLES
      (TABLE_NUMBER,POSITION,REST_ID,CREATED_BY,CREATED_DATE,LAST_UPDATED_BY,LAST_UPDATED_DATE) 
      VALUES 
      ('.$TNUM.','.$POSITION.','.$REST_ID.','.$id.',NOW(),'.$id.',NOW());');
		//return $query->row();
  }
}