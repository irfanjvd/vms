<?php

Class Banned_cnic_model extends CI_Model {
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

    function get_banned_user($id) {
        $this->db->select('*');
        $this->db->from('banned_users');
        $this->db->where('id', $id);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        return $query->row_array();
    }
    /**
     * 
     * @param type $parent_id
     * @return type
     * @author Irfan Javed <irfanjvd@gmail.com>
     */
    function get_all_banned_users($limit=null,$lenght=null,$search0=null,$sort_column=null,$sort_order=null) {
        $allColumns=array(
            "cnic",
            "type",
            "visit_left",
            "date_range",
            "reason",
            "created_datetime"
        );

        $this->db->select('*');
        $this->db->from('banned_users');
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

        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_cnic($data) {
        $this->db->insert('banned_users', $data);
        return $this->db->insert_id();
    }

    function is_visitor_banned($cnic){
        $this->db->select("*");
        $this->db->from("banned_users");
        $this->db->where('cnic', "$cnic");
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_banned_user($data,$id) {
        $this->db->where('id', $id);
        return $this->db->update('banned_users', $data);
    }

    public function delete_banned_user($id){
        $this->db->where('id', $id);
        return $this->db->update('banned_users', array('is_deleted'=>1));
    }

    public function update_visit_left($id,$visit_left){
        $this->db->where('id', $id);
        return $this->db->update('banned_users', array('visit_left'=>$visit_left));
    }



}

?>