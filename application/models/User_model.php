<?php

Class User_model extends CI_Model {
    /**
     * 
     * @param type $username
     * @param type $password
     * @return boolean
     * @author Zahid Nadeem <zahidiubb@yahoo.com>
     */
    public function __construct() {
        $this->load->database();
    }

    function login($username, $password)
    {
        $this->db->select('u.*, te.tenant_id,te.employee_id');
        $this->db->from('user u');
        $this->db->join('tenant_employees te', 'u.id=te.user_id', 'left');
        $this->db->where('u.password', MD5($password));
        $this->db->where('u.email', $username);
        $this->db->where('u.is_deleted', '0');
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        }
        return false;
    }

    /**
     * 
     * @param type $parent_id
     * @return type
     * @author Zahid Nadeem <zahidiubb@yahoo.com>
     */
    function get_user($id) {
        $this->db->select('u.*, te.tenant_id');
        $this->db->from('user u');
        $this->db->join('tenant_employees te','te.user_id=u.id','left');
        $this->db->where('u.id', $id);
        $this->db->where('u.is_deleted', 0);
        $query = $this->db->get();
        return $query->row_array();
    }
    /**
     * 
     * @param type $parent_id
     * @return type
     * @author Zahid Nadeem <zahidiubb@yahoo.com>
     */
    function get_all_users($limit=null,$lenght=null,$search0=null,$sort_column=null,$sort_order=null) {
        $allColumns=array(
            "first_name",
            "last_name",
            "email",
            "status",
            "type",
            "created_datetime"
        );

        $this->db->select('u.*');
        $this->db->from('user u');
        $this->db->where('u.is_deleted', 0);

        if($search0!=null){
            $this->db->like('u.first_name', "$search0");
            $this->db->or_like('u.last_name', "$search0");
            $this->db->or_like('u.email', "$search0");
            $this->db->or_like('u.type', "$search0");
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

    function get_all_users_visit_details($limit,$lenght,$search0=null,$sort_column=null,$sort_order=null, $action=null,$visit_by_user=null,$date_range) {
        date_default_timezone_set('Asia/Karachi');
        $allColumns=array(
            "first_name",
            "last_name",
            "email",
            "action",
            "user_id",
            "created_datetime"
        );
		if($limit==null && $lenght==null){
			$this->db->select('COUNT(vt.id) as total');
		}else{
			$this->db->select('u.first_name,u.last_name,u.email,vp.visitor_name,vp.visitor_cell_no,vp.visitor_identity_no, vt.*,v.*');
		}
        
        $this->db->from('visit_track vt');
        $this->db->join('user u', 'u.id = vt.user_id');
        $this->db->join('visit v', 'v.visit_id = vt.visit_id_fk');
        $this->db->join('visitor_profile vp', 'vp.visitor_id = v.visit_visitor_id_fk');
        $this->db->where('u.is_deleted', 0);

        if($action!=null){
            $this->db->where('vt.action', $action);
        }

        if($visit_by_user!=null){
            $this->db->where('u.email', $visit_by_user);
        }

        if($date_range!=null && $date_range!="-yadcf_delim-"){
            if(strpos($date_range,"-yadcf_delim-") >= 0){
                $dates=explode("-yadcf_delim-",$date_range);
            }else {
                $dates = explode("~", $date_range);
            }
//            echo "<pre>";
//            print_r($dates);die;
            $date_from_hours=explode(" ",$dates[0]);
            $date_to_hours=explode(" ",$dates[1]);
            if($dates[0]=="") {
                $from= date("Y-m-d H:i:s");
            }else{
                if ($date_from_hours[1] == 00) {
                    $from_hours = "00";
                } else {
                    $from_hours = $date_from_hours[1];
                }
                $from=$date_from_hours[0]." ".$from_hours.":00:00";
            }

            if($dates[1]==""){
                $to= date("Y-m-d H:i:s");
            }else {
                if ($date_to_hours[1] == 00) {
                    $to_hours = "23";
                } else {
                    $to_hours = $date_to_hours[1];
                }
                $to=$date_to_hours[0]." ".$to_hours.":00:00";
            }
//            $this->db->where("v.visit_date BETWEEN '$from' AND '$to' ");
            $this->db->where('vt.created_datetime >=',"$from");
            $this->db->where('vt.created_datetime <=',"$to");

        }

        if($lenght!=-1) {
            if ($lenght != null && $limit != null) {
                $this->db->limit($lenght, $limit);
            }
        }
        if($sort_column!=null && $sort_order!=null){
            $this->db->order_by($allColumns[$sort_column], ucwords($sort_order));
        }else{
            $this->db->order_by('id', 'DESC');
        }

        $query = $this->db->get();
		if($limit==null && $lenght==null){
			$result=$query->row_array();
			return $result['total'];
		}else{
			return $query->result_array();
		}
        
    }

    /**
     * 
     * @return type
     * @author Zahid Nadeem <zahidiubb@yahoo.com>
     */
    function get_super_admin() {

        $this->db->select('u.id id, u.username,u.email,u.first_name,u.last_name');
        $this->db->from('users u');

        $this->db->where('u.is_deleted', 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * 
     * @param type $user_id
     * @return type
     * @author Zahid Nadeem <zahidiubb@yahoo.com>
     */
    function get_user_by_id($user_id) {
        $this->db->select('u.*');
        $this->db->from('users u');

        $this->db->where('u.id', $user_id);
        $this->db->where('u.is_deleted', 0);
        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * 
     * @param type $user_name
     * @return boolean
     * @author Zahid Nadeem <zahidiubb@yahoo.com>
     */
    public function username_already_exist($user_name) {

        $query = $this->db->get_where('users', array('username' => $user_name, 'is_deleted' => '0'));
        $exist = $query->result_array();
        if ($exist) {
            return  $this->db->insert_id();
        } else {
            return false;
        }
    }

    /**
     * 
     * @param type $email
     * @return boolean
     * @author Zahid Nadeem <zahidiubb@yahoo.com>
     */
    public function email_already_exist($email) {

        $query = "SELECT *
                    FROM `user`
                    WHERE `email` = '$email'
                    AND is_deleted = '0'";
        $query = $this->db->query($query);
        $exist = $query->result_array();
        if ($exist) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param type $user_name
     * @return boolean
     * @author Zahid Nadeem <zahidiubb@yahoo.com>
     */
    public function get_user_by_username($user_name) {

        $query = $this->db->get_where('users', array('username' => $user_name, 'is_deleted' => '0'));
        $exist = $query->row_array();
        if ($exist) {
            return $exist;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param type $user_name
     * @return boolean
     * @author Zahid Nadeem <zahidiubb@yahoo.com>
     */
    public function get_user_by_email($email) {

        $query = $this->db->get_where('users', array('email' => $email, 'is_deleted' => '0'));
        $exist = $query->row_array();
        if ($exist) {
            return $exist;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param type $user_name
     * @param type $user_id
     * @return boolean
     * @author Zahid Nadeem <zahidiubb@yahoo.com>
     */
    public function user_name_already_exist($user_name, $user_id) {

        $query = $this->db->get_where('users', array('username' => $user_name, 'is_deleted' => '0', 'id !=' => $user_id));
        $exist = $query->result_array();
        if ($exist) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param type $user_name
     * @param type $user_id
     * @return boolean
     * @author Zahid Nadeem <zahidiubb@yahoo.com>
     */
    public function email_already_exist_edit($email, $user_id) {

        $query = $this->db->get_where('users', array('email' => $email, 'is_deleted' => '0', 'id !=' => $user_id));
        $exist = $query->result_array();
        if ($exist) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param type $password
     * @param type $user_id
     * @return boolean
     * @author Zahid Nadeem <zahidiubb@yahoo.com>
     */
    public function current_password_check($password, $user_id) {

        $query = $this->db->get_where('user', array('password' => $password, 'is_deleted' => '0', 'id' => $user_id));
        $exist = $query->result_array();
//        echo "<pre>";
//        print_r($exist);die;
        if (!empty($exist)) {
//            echo "good";
            return true;
        } else {
//            echo "bad";
            return false;
        }
    }


    public function add_user($data) {
        $this->db->insert('user', $data);
        $user_id = $this->db->insert_id();

        $this->db->insert('tenant_employees', [
            'user_id' => $user_id,
            'tenant_id' => $data['branch_id'],
            'employee_name' => $data['first_name'] . ' ' . $data['last_name'],
            'status' => 1,
            'created_datetime' => date('Y-m-d H:i:s')
        ]);
        $employee_id = $this->db->insert_id();

        $this->db->where('id', $employee_id)
            ->update('tenant_employees', ['employee_id' => $employee_id]);
        return $user_id;
    }

    public function update_user($data,$user_id) {
        $this->db->where('id', $user_id);
        return $this->db->update('user', $data);
    }

    public function delete_user($user_id){
        $this->db->where('id', $user_id);
        return $this->db->update('user', array('is_deleted'=>1));
    }

    function change_password($password,$user_id){
        $this->db->where('id', $user_id);
        return $this->db->update('user', array('password'=>$password));
    }

    function get_users_for_filter(){
        $query=$this->db->query("select DISTINCT email from user where is_deleted=0 AND type!='SUPER'");
        $result=$query->result_array();
        $string='';
        foreach($result as $key=>$val) {
            $string.=$val['email'].',';
        }
        $final_string=rtrim($string,',');
        return $final_string;
    }

    function save_import_tenant($tenants){
        $this->db->insert_batch('tenant_employees', $tenants);
    }



}

?>