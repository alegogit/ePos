<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_model extends CI_Model {
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
		$this->db->where('USERS_RESTAURANTS.USER_ID',$id);
    	$query = $this->db->select('*')
                      ->from('RESTAURANTS')
                      ->join('USERS_RESTAURANTS', 'RESTAURANTS.ID = USERS_RESTAURANTS.REST_ID')
                      ->get('');
    	return $query->result();
  	}
	
  	function get_default_rest(){   
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['id'];                      
    	$query = $this->db->query('SELECT USERS_RESTAURANTS.*, RESTAURANTS.NAME AS REST_NAME
                              FROM USERS_RESTAURANTS
                              JOIN RESTAURANTS ON USERS_RESTAURANTS.REST_ID = RESTAURANTS.ID
                              WHERE USERS_RESTAURANTS.DEFAULT_REST=1 AND USERS_RESTAURANTS.USER_ID = '.$id.'
							  LIMIT 1;');
    	//$output = ($this->db->affected_rows()>0)?$query->row():"NONE";
    	//return $output;
    	return $query->row();
  	}
	
	function update_name($name){
	  	date_default_timezone_set('Asia/Jakarta');
		$dt = date('Y-m-d H:i:s');
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['id'];
		$data = array(
               'NAME' => $name,
               'LAST_UPDATED_BY' => $id,
               'LAST_UPDATED_DATE' => $dt
            );
		$this->db->where('ID', $id);
		$this->db->update('USERS', $data);
	}
	
	function update_email($email){
	  	date_default_timezone_set('Asia/Jakarta');
		$dt = date('Y-m-d H:i:s');
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['id'];
		$data = array(
               'EMAIL_ADDRESS' => $email,
               'LAST_UPDATED_BY' => $id,
               'LAST_UPDATED_DATE' => $dt
            );
		$this->db->where('ID', $id);
		$this->db->update('USERS', $data);
	}
	
	function update_username($user){
	  	date_default_timezone_set('Asia/Jakarta');
		$dt = date('Y-m-d H:i:s');
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['id'];
		$data = array(
               'USERNAME' => $user,
               'LAST_UPDATED_BY' => $id,
               'LAST_UPDATED_DATE' => $dt
            );
		$this->db->where('ID', $id);
		$this->db->update('USERS', $data);
	}
	
	function update_pass($pass){
	  	date_default_timezone_set('Asia/Jakarta');
		$dt = date('Y-m-d H:i:s');
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['id'];
		$passwd = sha1(md5($pass));
		$data = array(
               'PASSWORD' => $passwd,
               'LAST_UPDATED_BY' => $id,
               'LAST_UPDATED_DATE' => $dt
            );
		$this->db->where('ID', $id);
		$this->db->update('USERS', $data);
	}
	
	function update_photo($image){
	  	date_default_timezone_set('Asia/Jakarta');
		$dt = date('Y-m-d H:i:s');
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['id'];
		$data = array(
               'IMAGE' => $image,
               'LAST_UPDATED_BY' => $id,
               'LAST_UPDATED_DATE' => $dt
            );
		$this->db->where('ID', $id);
		$this->db->update('USERS', $data);
	}
	
	function update_def_rest($rest_id){
	  	date_default_timezone_set('Asia/Jakarta');
		$dt = date('Y-m-d H:i:s');
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['id'];
		$data0 = array(
               'DEFAULT_REST' => 0,
               'LAST_UPDATED_BY' => $id,
               'LAST_UPDATED_DATE' => $dt
            );
		$this->db->where('USER_ID', $id);
		$this->db->update('USERS_RESTAURANTS', $data0);
		$data = array(
               'DEFAULT_REST' => 1,
               'LAST_UPDATED_BY' => $id,
               'LAST_UPDATED_DATE' => $dt
            );
		$this->db->where('USER_ID', $id);
		$this->db->where('REST_ID', $rest_id);
		$this->db->update('USERS_RESTAURANTS', $data);
	}
    
	function get_username($id){
    	$query = $this->db->select('USERNAME')
                      ->from('USERS')
                      ->where('ID',$id)
                      ->get('');
    	return $query->row();
  	}
  
	function get_restaurant_name($id){
    	$query = $this->db->select('NAME AS REST_NAME')
                      ->from('RESTAURANTS')
                      ->where('ID',$id)
                      ->get('');
    	return $query->row();
  	}    
  
	function get_rest_profile($rest_id){    
    	$this->db->where('REST_ID',$rest_id);
    	$query = $this->db->get('INVENTORY');
    	return $query->result();
  	}
	
	function get_metrics(){
    	$query = $this->db->select('CODE,VALUE')
                      ->from('REF_VALUES')
                      ->where('LOOKUP_NAME', 'METRIC')
                      ->get('');
    	return $query->result();
	} 
	
	function get_metric_name($metric_id){
    	$query = $this->db->select('VALUE')
                      ->from('REF_VALUES')
                      ->where('LOOKUP_NAME', 'METRIC')
                      ->where('CODE', $metric_id)
                      ->limit(1)
                      ->get('');
    	return $query->row();
	} 
   
	function new_profile($NAME,$QTY,$METRIC,$MINQ,$REST_ID){       
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['id'];
    	$query = $this->db->query('INSERT INTO profile
      		(NAME,QUANTITY,METRIC,MIN_QUANTITY,REST_ID,CREATED_BY,CREATED_DATE,LAST_UPDATED_BY,LAST_UPDATED_DATE) 
      		VALUES 
      		("'.$NAME.'",'.$QTY.',"'.$METRIC.'","'.$MINQ.'",'.$REST_ID.','.$id.',NOW(),'.$id.',NOW());');
		//return $query->row();
  	}
	
	function set_class($qty,$std){
		if($qty>$std){
			$class = "";
		} else {
			if($qty!=0){
				$class = "warning";
			} else {
				$class = "danger";
			}
		}
		return $class;	
	}
  
}