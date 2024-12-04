<?php

Class Location_model extends CI_Model {
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

    function get_location($id) {
        $this->db->select('l.*');
        $this->db->from('locations l');
        $this->db->where('l.id', $id);
        $this->db->where('l.is_deleted', 0);
        $query = $this->db->get();
        return $query->row_array();
    }
    /**
     * 
     * @param type $parent_id
     * @return type
     * @author Irfan Javed <irfanjvd@gmail.com>
     */
    function get_all_locations($limit=null,$lenght=null,$search0=null,$sort_column=null,$sort_order=null) {
        $allColumns=array(
            "location",
            "created_datetime"
        );

        $this->db->select('l.*');
        $this->db->from('locations l');
        $this->db->where('l.is_deleted', 0);

        if($search0!=null){
            $this->db->like('l.location', "$search0");
        }
        if($lenght!=null && $limit!=null) {
            $this->db->limit($lenght, $limit);
        }
        if($sort_column!=null && $sort_order!=null){
            $this->db->order_by($allColumns[$sort_column], ucwords($sort_order));
        }else{
            $this->db->order_by('id', 'ASC');
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_location($data) {
        $this->db->insert('locations', $data);
        return $this->db->insert_id();
    }

    public function update_location($data,$user_id) {
        if($data['issue_card']==1){
            $issue_card_data=array('issue_card'=>0);
            $this->db->update('locations', $issue_card_data);
        }
        $this->db->where('id', $user_id);
        return $this->db->update('locations', $data);
    }

    public function delete_location($user_id){
        $this->db->where('id', $user_id);
        return $this->db->update('locations', array('is_deleted'=>1));
    }

    function get_locations_for_filter(){
        $query=$this->db->query("select DISTINCT location from locations where is_deleted=0");
        $result=$query->result_array();
        $string='';
        foreach($result as $key=>$val) {
            $string.=$val['location'].',';
        }
        $final_string=rtrim($string,',');
        return $final_string;
    }

    function get_all_cities(){
        $query=$this->db->query("select * from city order by Name");
        $result=$query->result_array();
        return $result;
    }



}

?>