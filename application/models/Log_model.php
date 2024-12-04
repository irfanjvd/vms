<?php

Class Log_model extends CI_Model {
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


    public function create_log($action,$data,$record_id='') {
        $data=json_encode($data);
        $session_data = $this->session->userdata('logged_in');
        $user_id=$session_data['login_user_id'];
        $this->db->insert('log', array(
                'user_id'=>$user_id,
                'record_id'=>$record_id,
                'action'=>$action,
                'data'=>$data
                ));
        return $this->db->insert_id();
    }

}

?>