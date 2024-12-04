<?php

Class Tenant_model extends CI_Model {
    /**
     * 
     * @param type $username
     * @param type $password
     * @return boolean
     * @author Irfan Javed <irfanjvd@gmail.com>
     */

    public function __construct() {
        $this->load->database();
    }
    /**
     * 
     * @param type $parent_id
     * @return type
     * @author Irfan Javed <irfanjvd@gmail.com>
     */


    function get_all_tenants() {
        $this->db->select('*');
        $this->db->from('tenant');
        $this->db->where('status', 1);
        $this->db->order_by('tenant_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_tenants_for_filter(){
        $query=$this->db->query("select id,tenant_name from tenant ");
        return $result=$query->result_array();
        $string='';
        foreach($result as $key=>$val) {
            $string.=$val['tenant_name'].',';
        }
        $final_string=rtrim($string,',');
        return $final_string;
    }
	
	function get_tenant_employees_for_filter($tenant_id){
		if($tenant_id!=''){
			$query=$this->db->query("select id,employee_name from tenant_employees where tenant_id=$tenant_id");
		}else{
			$query=$this->db->query("select id,employee_name from tenant_employees");	
		}
        
        $result=$query->result_array();
        return ($result);
    }
	
	function get_tenant_for_private_visits($tenant_id){
		if($tenant_id!=''){
			$query=$this->db->query("select id,tenant_name from tenant where tenant_id=$tenant_id");
		}else{
			$query=$this->db->query("select id,tenant_name from tenant");	
		}
        
        $result=$query->result_array();
        return ($result);
    }

    function get_employees($tenant){
        $this->db->select('id,employee_name');
        $this->db->from('tenant_employees');
        $this->db->where('status', 1);
        $this->db->where('tenant_id', $tenant);
        $this->db->order_by('employee_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
	
	function get_tenant($id){
		$this->db->select('*');
        $this->db->from('tenant');
        //$this->db->where('status', 1);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
	}
	
	function get_tenant_employee($id='',$name=''){
		$this->db->select('*');
        $this->db->from('tenant_employees');
        //$this->db->where('status', 1);
		if($id!=''){
			$this->db->where('tenant_id', $id);
		}
		if($name!=''){
			$this->db->where('employee_name', $name);
		}
        $query = $this->db->get();
        return $query->row_array();
	}
	
	function save_tenants($table,$data){
		return $this->db->insert_batch($table, $data); 
	}
	
	function update_employee_info($id,$name,$data){
		 $this->db->where('tenant_id', $id);
		 $this->db->where('employee_name', $name);
        return $this->db->update('tenant_employees', $data);
	}
	
	function update_tenant_info($id,$data){
		$this->db->where('id', $id);
        return $this->db->update('tenant', $data);
	}

}

?>