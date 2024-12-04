<?php

class Common_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->db->flush_cache();
    }

    function save($table, $data,$batch_insert=0) {
        
        if($batch_insert==1){
        	/*echo "<pre>";
        	print_r($data);die;*/
        	$this->db->insert_batch($table, $data);
        	return true;
        }else{
        	$this->db->insert($table, $data);
        	return $this->db->insert_id();	
        }
        
    }

    function save_bulk($table, $data) {
        $this->db->insert_batch($table, $data);
        return $this->db->insert_id();
    }

    function update($table, $data, $where) {
        $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }

    function find($table, $select = false,$one=false, $where = false, $joins = false, $joins_on = false, $group = false, $order = false, $having = false, $limit1 = false, $limit2 = false, $where_in = FALSE, $where_in_col = FALSE, $join_type = false) {
        if ($select) {
            $this->db->select($select);
        } else {
            $this->db->select('*');
        }

        if (is_array($joins) && is_array($joins_on)) {
            $index = 0;
            foreach ($joins as $join) {
				
                if($join_type){
                    $this->db->join($join, $joins_on[$index], $join_type[$index]);
                }else{
                    $this->db->join($join, $joins_on[$index], 'left');
                }
                $index++;
            }
        } else {
            if ($joins && $joins_on) {
                $this->db->join($joins, $joins_on, 'left');
            }
        }

        if ($where) {
            //$where array or string
            $this->db->where($where);
        }
        if ($where_in) {
            //$where array or string
            $this->db->where_in($where_in_col, $where_in);
        }
        if ($group) {
            //$group array or string
            $this->db->group_by($group);
        }
        if ($order) {
            //$order string
            $this->db->order_by($order);
        }
        if ($having) {
            //$having string or array
            $this->db->having($having);
        }
        if (!$limit2 && $limit1) {
            $this->db->limit($limit1);
        } else {
            if ($limit1) {
                $this->db->limit($limit1, $limit2);
            }
        }
        $query = $this->db->get($table);
        //echo $this->db->last_query(); die;
        //echo mysql_error();
        if ($query->num_rows() > 0) {
        	if($one==1){
            	return $query->row_array();
        	}else{
        		return $query->result_array();
        	}
        } else {
            return false;
        }
    }
	
	function add_one($table,$column,$id){
		$query="UPDATE $table SET $column = $column + 1 WHERE id = $id";
		$this->db->query($query);
	}

    function delete($table, $where = false) {
        $this->db->delete($table, $where);
        return $this->db->affected_rows();
    }
    
    

    function send_mail($email, $sms_content, $subject) {
        $this->load->library('email');
		$this->email->from('info@phota.com', "PHOTA");
		$this->email->to($email);
		$this->email->subject($subject);
		$message = "<b>Welcome to PHOTA</b><br />";
		$message .= "<br /><br /><br />Note: This is system generated e-mail. Please do not reply<br>";
		$message .= "<br /><b>NSPP</b>";
		$this->email->message($sms_content);
		$this->email->set_mailtype('html');
		$this->email->send();
        return true;
    }



    function get_ajax_listing($table,$select='',$all_columns=array(),$joins=array(),$joins_on=array(),$join_types=array(),$limit=null,$lenght=null,$search0=null,$sort_column=null,$sort_order=null,$username=null,$email=null,$user_imei=null) {
        
    	if($select!=''){
    		$this->db->select($select);
    	}else{
    		$this->db->select('*');	
    	}
        
        $this->db->from("$table");
        $this->db->where("$table.is_deleted", 0);
        
        if (is_array($joins) && is_array($joins_on)) {
            $index = 0;
            foreach ($joins as $join) {
				
                if($join_types){
                    $this->db->join($join, $joins_on[$index], $join_types[$index]);
                }else{
                    $this->db->join($join, $joins_on[$index], 'left');
                }
                $index++;
            }
        } else {
            if ($joins && $joins_on) {
                $this->db->join($joins, $joins_on, 'left');
            }
        }


        /*if($search0!=null){
            $this->db->like("$table.first_name", "$search0");
        }

        if($username!=null){
            $this->db->like("$table.username", "$username");
        }

        if($email!=null){
            $this->db->like("$table.email", "$email");
        }*/

        if($lenght!=null && $limit!=null) {
            $this->db->limit($lenght, $limit);
        }
        if($sort_column!=null && $sort_order!=null){

            $this->db->order_by($all_columns[$sort_column], ucwords($sort_order));
        }else{
            $this->db->order_by("$table.id", 'ASC');
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    

}