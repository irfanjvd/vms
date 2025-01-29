<?php

Class Visitor_model extends CI_Model {

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
    function get_visitor($cnic,$visitor_type=null) {

        $this->db->select('*');
        $this->db->from('visitor_profile vp');
        if($visitor_type!=null){
            $this->db->where("vp.$visitor_type", $cnic);
        }else {
            $this->db->where('vp.visitor_identity_no', $cnic);
        }
        $query = $this->db->get();
        //echo $this->db->last_query();
       // exit;
        return $query->row_array();
    }
	
	function get_visitor_call($cnic) {

        $this->db->select('*');
        $this->db->from('visit_by_call vp');

        
            $this->db->where('vp.visitor_identity_no', $cnic);

        $query = $this->db->get();
        //echo $this->db->last_query();
       // exit;
        return $query->row_array();
    }

    function get_visitor_by_id($id){
        $this->db->select('*');
        $this->db->from('visitor_profile vp');
        $this->db->where('vp.visitor_id', $id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        // exit;
        return $query->row_array();
    }

    public function update_visitor($data,$visitor_id) {
        $this->db->where('visitor_id', $visitor_id);
        return $result=$this->db->update('visitor_profile', $data);


    }


    function get_all_visitors($limit=null,$lenght=null,$search0=null,$sort_column=null,$sort_order=null,$visitor_name=null, $visitor_cell=null, $visitor_city=null) {
        $allColumns=array(
            "visitor_picture",
            "visitor_identity_no",
//            "visitor_family_no",
            "visitor_name",
//            "visitor_father_name",
            "",
            "visitor_cell_no",
//            "visitor_district",
            "visitor_city",
//            "visitor_registration_mode",
            "created_datetime",
            ""
        );

        $this->db->select('*');
        $this->db->from('visitor_profile');
//        $this->db->where('is_deleted', 0);

        if($this->session->userdata('login_user_type') != "VIEW_ONLY")
        {
            //$this->db->where('');
        }

        if($visitor_name!=null){
            $this->db->like('visitor_name', "$visitor_name");

        }
        if($visitor_cell!=null){
            $this->db->like('visitor_cell_no', "$visitor_cell");
        }
        if($visitor_city!=null){
            $this->db->like('visitor_city', "$visitor_city");
        }
//        if($search0!=null){
//            $this->db->like('visitor_identity_no', "$search0");
//            $this->db->or_like('visitor_family_no', "$search0");
//            $this->db->or_like('visitor_name', "$search0");
//            $this->db->or_like('visitor_father_name', "$search0");
//        }
        if($lenght!=null && $limit!=null) {
            $this->db->limit($lenght, $limit);
        }

        if($sort_column!=null && $sort_order!=null){
            $this->db->order_by($allColumns[$sort_column], ucwords($sort_order));
        }else{
            $this->db->order_by('visitor_id', 'DESC');
        }

        $query = $this->db->get();
        return $query->result_array();
    }

	
	function get_all_private_visits($limit=null,$lenght=null,$search0=null,$sort_column=null,$sort_order=null,$name=null, $cnic=null, $mobile=null, $number_plate=null,$status=null,$employee_id=null,$date_range=null,$tenant=null,$visit_code=null) {
        $allColumns=array(
            "id",
			"title",
            "agenda",
            "tenant_id",
            "user_id",
            "comments",
            "status",
            "created_datetime",
            ""
        );

		$this->db->distinct('DISTINCT private_visits.id');
        $this->db->select('private_visits.*,COUNT(private_members.id) as total');
        $this->db->from('private_visits');
		if($name!=null || $cnic!=null || $mobile!=null || $number_plate!=null || ($date_range!=null && $date_range!="-yadcf_delim-")){
			//$this->db->join('private_members', 'private_visits.id = private_members.private_visit_id');
		}
		$this->db->join('private_members', 'private_visits.id = private_members.private_visit_id');
//        $this->db->where('is_deleted', 0);

        if($name!=null){
            $this->db->like('private_members.name', "$name");

        }
        if($cnic!=null){
			//$this->db->join('private_members', 'private_visits.id = private_members.private_visit_id');
            $this->db->like('private_members.cnic', "$cnic");
        }
        if($mobile!=null){
            //$this->db->like('mobile', "$mobile");
			$this->db->like('private_members.mobile', "$mobile");
        }
		if($number_plate!=null){
            //$this->db->like('number_plate', "$number_plate");
			$this->db->like('private_members.number_plate', "$number_plate");
        }
		if($status!=null){
            $this->db->where('private_visits.status', "$status");
			
        }
		if($employee_id!=null){
            $this->db->where('private_visits.user_id', "$employee_id");
			
        }
		if($tenant!=null){
            $this->db->where('private_visits.tenant_id', "$tenant");
			
        }
        if($visit_code!=null){
            $this->db->where('private_visits.visit_code', "$visit_code");
            
        }
		if($date_range!=null){
            $dates = explode("~", $date_range);
            $date_from=explode(" ",$dates[0]);
            $date_to=explode(" ",$dates[1]);
            $from=date("Y-m-d",strtotime($date_from[0]));
			$to=date("Y-m-d",strtotime($date_to[1]));
			if(empty($dates[1])){
				$to=date('Y-m-d');
			}
			
			if($to==$from){
				$this->db->where("(
                    ( private_members.date_from>='$from' AND private_members.date_to<='$to')
                    OR
                    ( private_members.date_to>='$to' AND private_members.date_from<='$from')
                    
                    )");
                /*$this->db->where("(
                    ( UNIX_TIMESTAMP(private_members.date_from)>=UNIX_TIMESTAMP('$from') AND UNIX_TIMESTAMP(private_members.date_to)<=UNIX_TIMESTAMP('$to'))
                    OR
                    ( UNIX_TIMESTAMP(private_members.date_to)>=UNIX_TIMESTAMP('$to') AND UNIX_TIMESTAMP(private_members.date_from)<=UNIX_TIMESTAMP('$from'))
                    
                    )");*/
            }else{
                $this->db->where("(
                    ( UNIX_TIMESTAMP(private_members.date_from)>=UNIX_TIMESTAMP('$from') AND UNIX_TIMESTAMP(private_members.date_to)<=UNIX_TIMESTAMP('$to'))
                    OR
                    ( UNIX_TIMESTAMP(private_members.date_to)>=UNIX_TIMESTAMP('$to') AND UNIX_TIMESTAMP(private_members.date_from)<=UNIX_TIMESTAMP('$from'))
                    
                    )");
            }

        }
		$this->db->group_by('private_visits.id');
		$session_data = $this->session->userdata('logged_in');
		$login_type=$session_data['login_user_type'];
		if($login_type=="TENANT"){
			$tenant_user_id=$session_data['login_user_id'];
			$this->db->where('private_visits.user_id', "$tenant_user_id");
		}
		
//        if($search0!=null){
//            $this->db->like('visitor_identity_no', "$search0");
//            $this->db->or_like('visitor_family_no', "$search0");
//            $this->db->or_like('visitor_name', "$search0");
//            $this->db->or_like('visitor_father_name', "$search0");
//        }
        if($lenght!=null && $limit!=null) {
            $this->db->limit($lenght, $limit);
        }

        if($sort_column!=null && $sort_order!=null){
            $this->db->order_by($allColumns[$sort_column], ucwords($sort_order));
        }else{
            $this->db->order_by('id', 'DESC');
        }

        $query = $this->db->get();
		//echo $this->db->last_query();die;
        return $query->result_array();
    }
	
	
    function get_visitor_full_track($visitor_id,$limit=null,$length=null,$date_range=null,$total=null){
        date_default_timezone_set('Asia/Karachi');
        $this->db->select("v.visit_id,,v.visit_reason,vp.visitor_name,GROUP_CONCAT(vt.location_title)location_title, GROUP_CONCAT(vt.action order by vt.created_datetime DESC)action ,GROUP_CONCAT(vt.created_datetime order by vt.created_datetime DESC)created_datetime");
        $this->db->from("visit_track vt");
        $this->db->join('visit v', 'v.visit_id = vt.visit_id_fk');
        $this->db->join('visitor_profile vp', 'vp.visitor_id = v.visit_visitor_id_fk');
        $this->db->where('v.visit_visitor_id_fk', $visitor_id);
        $this->db->group_by("vt.visit_id_fk");
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
            $this->db->where('v.visit_date >=',"$from");
            $this->db->where('v.visit_date <=',"$to");
        }
        if($total!=1) {
            if ($length != null && $limit != null) {
                $this->db->limit($length, $limit);
            }
        }
        $this->db->order_by('vt.visit_id_fk', "DESC");
        $query = $this->db->get();
        return $query->result_array();
    }
	
	function change_private_visit_status($id,$status){
		$data=array('status'=>$status);
		$this->db->where('id', $id);
        return $result=$this->db->update('private_visits', $data);
	}

    public function visit_types()
    {
        $this->db->select('id, name'); // Replace 'id' and 'name' with your actual column names
        $this->db->from('visit_types'); // Replace 'your_table_name' with your table name
        $query = $this->db->get();
        return $query->result_array(); // Returns the data as an array
    }

    public function visit_gates()
    {
        $this->db->select('id, name'); // Replace 'id' and 'name' with your actual column names
        $this->db->from('visit_gates'); // Replace 'your_table_name' with your table name
        $query = $this->db->get();
        return $query->result_array(); // Returns the data as an array
    }

}

?>