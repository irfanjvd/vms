<?php

Class Shelter_room_model extends CI_Model {
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

    
    function get_all_shelter_rooms($limit=null,$lenght=null,$search0=null,$sort_column=null,$sort_order=null) {
        $allColumns=array(
            "shelter_id",
            "room",
            "capacity",
            "created_datetime"
        );

        $this->db->select('sr.*,s.shelter');
        $this->db->from('shelter_rooms sr');
        $this->db->join("shelters s","sr.shelter_id=s.id");
        $this->db->where('sr.is_deleted', 0);

        if($search0!=null){
            $this->db->like('sr.shelter_id', "$search0");
        }
        if($lenght!=null && $limit!=null) {
            $this->db->limit($lenght, $limit);
        }
        if($sort_column!=null && $sort_order!=null){
            $this->db->order_by($allColumns[$sort_column], ucwords($sort_order));
        }else{
            $this->db->order_by('sr.id', 'ASC');
        }

        $query = $this->db->get();
        return $query->result_array();
    }

}

?>