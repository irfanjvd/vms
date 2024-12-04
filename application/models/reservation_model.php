<?php

Class Reservation_model extends CI_Model {
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



    function get_tenants_for_filter(){
        $query=$this->db->query("select tenant_name from tenant ");
        $result=$query->result_array();
        $string='';
        foreach($result as $key=>$val) {
            $string.=$val['tenant_name'].',';
        }
        $final_string=rtrim($string,',');
        return $final_string;
    }

    function get_employees($tenant){
        $this->db->select('*');
        $this->db->from('tenant_employees');
        $this->db->where('status', 1);
        $this->db->where('tenant_name', $tenant);
        $this->db->order_by('employee_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }


    function get_reservation($id) {
        $this->db->select('*');
        $this->db->from('reservations');
        $this->db->where('id', $id);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function add_reservation($data) {
        $this->db->insert('reservations', $data);
        return $this->db->insert_id();
    }


    public function update_reservation($data,$id) {
        $this->db->where('id', $id);
        return $this->db->update('reservations', $data);
    }

    public function delete_reservation($id){
        $this->db->where('id', $id);
        return $this->db->update('reservations', array('is_deleted'=>1));
    }

    function get_all_reservations($limit=null,$lenght=null,$search0=null,$sort_column=null,$sort_order=null) {
        $allColumns=array(
            "cnic",
            "name",
            "employee_name",
            "vehicle_type",
            "vehicle_no",
            "location",
            "",
            "created_datetime"
        );

        $this->db->select('*');
        $this->db->from('reservations');
        $this->db->where('is_deleted', 0);
        if($search0!=null){
            $this->db->like('cnic', "$search0");
        }
        if($lenght!=null && $limit!=null) {
            $this->db->limit($lenght, $limit);
        }
        if($sort_column!=null && $sort_order!=null){
            $this->db->order_by($allColumns[$sort_column], ucwords($sort_order));
        }else{
            $this->db->order_by('id', 'DESC');
        }
//        $this->db->order_by('tenant_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

}

?>