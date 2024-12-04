<?php

class Api_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->db->flush_cache();
	}


	 function save($table, $data,$batch_insert=0) {
        
        if($batch_insert==1){
        	/*echo "<pre>";
        	print_r($data);die;*/
        	$this->db->insert_batch($table, $data);
        	
        }else{
        	$this->db->insert($table, $data);
        	return $this->db->insert_id();	
        }
        
    }
	
	function update($table,$where,$data){
		$this->db->where($where);
		return $this->db->update("$table", $data);
	}
	
	function tenant_info($id){
		$this->db->select('id,tenant_name');
		$this->db->from('tenant');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row_array();
		
	}
	
	function tenant_employee_info($id){
		$this->db->select('id,tenant_id,employee_name,father_name,designation');
		$this->db->from('tenant_employees');
		$this->db->where('tenant_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_visits($start,$end,$user_id){
		$this->db->select('*');
		$this->db->from('private_visits');
		$this->db->where('created_datetime >=', $start);
		$this->db->where('created_datetime <=', $end);
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	

}