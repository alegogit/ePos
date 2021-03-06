<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventory_model extends CI_Model {
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
  
  function get_user_rest($id,$role=0){
		if($role!=1){   
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
    return $query->row();
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
  
  function get_restid_logo($id){
		$this->db->where('ID',$id); 
    $query = $this->db->select('LOGO_URL')
                      ->from('RESTAURANTS')
                      ->limit(1)
                      ->get('');
    return $query->row()->LOGO_URL;
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
  	
	function get_inventory0($rest_id)
	{
	    $query = $this->db->query('SELECT I.NAME,  
		      CONCAT(I.QUANTITY," ",R.VALUE) AS QUANTITY,
		        CASE WHEN I.QUANTITY = 0 THEN "NONE"
			         WHEN I.QUANTITY < MIN_QUANTITY THEN "LOW"
               WHEN I.LAST_UPDATED_DATE <SUBDATE(SYSDATE(),7) THEN "Not Moving"
            ELSE "OK"
            END AS STATUS
          FROM INVENTORY I
		  JOIN REF_VALUES R ON R.CODE = I.METRIC
		  WHERE REST_ID='.$rest_id.';');
		    return $query->result();
	}
  
	function get_inventory($rest_id){
	    $query = $this->db->query("SELECT	I.NAME,	CONCAT(I.QUANTITY,' ',I.METRIC) AS QUANTITY,
                                  CASE WHEN  I.QUANTITY = 0 THEN 'NONE'
                              		  WHEN I.QUANTITY < MIN_QUANTITY THEN 'LOW'
                                    WHEN I.LAST_UPDATED_DATE <SUBDATE(SYSDATE(),7) THEN 'Not Moving'
                                    ELSE 'OK'
                                    END AS STATUS
                                  FROM INVENTORY I
		                              WHERE REST_ID=".$rest_id.";");   
      return $query->result();
	}             
                                     	
	function inv_status_color($status){
    if ($status=="NONE"){
      $color = "#d9534f";
    } elseif ($status=="LOW"){ 
      $color = "#f0ad4e";
    } elseif ($status=="Not Moving"){ 
      $color = "#777";
    } else {
      $color = "#333";
    }
    return $color;
  }
  
	function inv_status_class($status){
    if ($status=="NONE"){
      $class = "danger";
    } elseif ($status=="LOW"){ 
      $class = "warning";
    } elseif ($status=="Not Moving"){ 
      $class = "active";
    } else {
      $class = "";
    }
    return $class;
  }
		
}