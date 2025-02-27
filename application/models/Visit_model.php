<?php

Class Visit_model extends CI_Model {

 
    /**
     * 
     * @param type 
     * @return type
     * @author Zahid Nadeem <zahidiubb@yahoo.com>
     */

    public function __construct() {
        $this->load->database();
    }

    function get_visit($visitor_id) {
        $this->db->select('v.*');
        $this->db->from('visit v');
        $this->db->where('v.visit_visitor_id_fk', $visitor_id);
        $this->db->where('v.visit_checkout', null);
        $this->db->limit(1);
        $this->db->order_by('visit_id','desc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row_array();
    }

    function get_last_visit($visitor_id){
        $this->db->select('v.*');
        $this->db->from('visit v');
        $this->db->where('v.visit_visitor_id_fk', $visitor_id);
//        $this->db->where('v.visit_checkout', "");
        $this->db->limit(1);
        $this->db->order_by('visit_id','desc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row_array();
    }

    function get_visit_by_id($visit_id) {

        $this->db->select('*');
        $this->db->from('visit v');
        $this->db->where('v.visit_id', $visit_id);
        $this->db->where('v.visit_checkout', null);
        $this->db->limit(1);
        $this->db->order_by('visit_id','desc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row_array();
    }


    function get_single_visit_by_id($visit_id)
    {

        $this->db->select('*');
        $this->db->from('visit v');
        $this->db->where('v.visit_id', $visit_id);
        //$this->db->where('v.visit_checkout', null);
        //$this->db->limit(1);
        //$this->db->order_by('visit_id','desc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row_array();
    }

    function get_visit_track_by_id($visit_id) {

        $this->db->select('vt.*');
        $this->db->from('visit_track vt');
        $this->db->where('vt.visit_id_fk', $visit_id);
        $this->db->limit(1);
        $this->db->order_by('vt.created_datetime','desc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row_array();
    }

    function get_visit_for_edit($visit_id) {

        $this->db->select('*');
        $this->db->from('visit v');
        $this->db->join('visitor_profile vp', 'vp.visitor_id = v.visit_visitor_id_fk');
        $this->db->where('v.visit_id', $visit_id);
        $this->db->limit(1);
        $this->db->order_by('visit_id','desc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row_array();
    }
	
	function get_call_visit_for_edit($visit_id) {

        $this->db->select('*');
        $this->db->from('visit_by_call v');
        $this->db->where('v.id', $visit_id);
        $this->db->limit(1);
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row_array();
    }

    function get_all_visits($limit=null,$length=null,$search0=null,$sort_column=null,$sort_order=null,$visitor_name=null, $visitor_cell=null,$identity_no=null,$vehicle_number=null,$tenant=null,$issued_card=null,$company_from=null,$checkout=null, $date_range=null,$location=null){
        date_default_timezone_set('Asia/Karachi');
        $all_columns=array(
            'vp.visitor_picture',
            'vp.visitor_name',
            '',
            'v.identity_type',
            'vp.visitor_identity_no',
            'v.visit_code',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            'v.visit_date',
            'l.location',
            ''
//            'nl.location'
        );

		//if ($limit != null && $length != null) {
		//	$this->db->select('v.visit_id');
		//}else{
			//$this->db->select('v.*,vp.*,l.location as location,nl.location as next_location');	
		//}
		if($limit==null && $length==null){
			$this->db->select('v.visit_id');	
		}else{
			$this->db->select('v.*,vp.*,vg.name as allowed_gate,l.location as location,nl.location as next_location,t.tenant_name,te.employee_name');
		}
        
        $this->db->from('visit v');
        if($visitor_name!=null){
            $this->db->like('vp.visitor_name', "$visitor_name");

        }
        if($visitor_cell!=null){
            $this->db->like('vp.visitor_cell_no', "$visitor_cell");
        }

        if($location!=null){
            $this->db->like('l.location', "$location");
            $this->db->where("v.visit_checkout=null");
        }

        if($issued_card!=null){
            $this->db->where('v.visit_issued_card', "$issued_card");
        }

        if($vehicle_number!=null){
            $this->db->like('v.visit_transport_registration_no', "$vehicle_number");
        }

        if($checkout!=null){
            if($checkout=="Critical"){
                $this->db->select('time_to_sec(timediff( NOW(),v.visit_date )) / 3600 as hours');
                $this->db->having('hours >=10');
            }
            $this->db->where('v.visit_checkout', null);
        }

        if($tenant!=null){
            $this->db->like('v.tenant_id', "$tenant");
        }

        if($company_from!=null){
            $this->db->like('v.visit_from_company', "$company_from");
        }
        if($identity_no!=null){
            $this->db->like('vp.visitor_identity_no', "$identity_no");
        }

        if ($date_range != null && $date_range != "-yadcf_delim-") {
            if (strpos($date_range, "-yadcf_delim-") >= 0) {
                $dates = explode("-yadcf_delim-", $date_range);
            } else {
                $dates = explode("~", $date_range);
            }
            $from = date("Y-m-d", strtotime($dates[0]));
            $to = date("Y-m-d", strtotime($dates[1]));
            $this->db->where("date(v.visit_checkin) BETWEEN '$from' AND '$to' ");
        }
        $this->db->join('visit_gates vg', 'vg.id = v.gate_number', 'left');
        $this->db->join('locations l', 'l.id = v.location_id', 'left');
        $this->db->join('locations nl', 'nl.id = v.next_location_id', 'left');
        $this->db->join('visitor_profile vp', 'v.visit_visitor_id_fk = vp.visitor_id', 'left');
        $this->db->join('tenant t', 't.id = v.tenant_id', 'left');
        $this->db->join('tenant_employees te', 'te.id = v.employee_id', 'left');
        
        //check if guard is logged-in. guard can only see approved requests
        
        if (sessiondata('login_user_type') == "VIEW_ONLY" ||
            sessiondata('login_user_type') == "NORMAL")  {
            $this->db->where('v.status', 'Approved');
        }

        //check if guard / viewonly has assigned any branch
        if (sessiondata('login_user_type') == "VIEW_ONLY" && sessiondata('login_branch_id') > 0) 
        {
//            $this->db->where('v.tenant_id', sessiondata('login_branch_id'));
        }

        if($sort_column!=null && $sort_order!=null){
            $this->db->order_by("$all_columns[$sort_column]", ucwords($sort_order));
        }else{
            $this->db->order_by("v.visit_id", 'DESC');
        }

        if(sessiondata('login_user_type') == "TENANT")
        {
            $this->db->where('v.created_by', sessiondata('login_user_id'));
        }

        if($length!=-1) {
            if ($limit != null && $length != null) {
                $this->db->limit($length, $limit);
            }
        }
        $query = $this->db->get();
        
		if($limit==null && $length==null){
			return $query->num_rows();
		}
        return $query->result_array();
    }
	
	
	function get_all_visits_call($limit=null,$length=null,$search0=null,$sort_column=null,$sort_order=null,$employee_name = null, $visitor_name = null,$employee_company = null){
        date_default_timezone_set('Asia/Karachi');
        $all_columns=array(
            'vpc.employee_name',
            'vpc.employee_company',
            '',
            'v.identity_type',
            'vpc.visitor_identity_no',
            '',
            'vpc.visit_date',
            ''
           // 'nl.location'
        );

        //if ($limit != null && $length != null) {
        //  $this->db->select('v.visit_id');
        //}else{
            //$this->db->select('v.*,vp.*,l.location as location,nl.location as next_location');    
        //}
        if($limit==null && $length==null){
            $this->db->select('vpc.id');    
        }else{
            $this->db->select('vpc.*');  
        }
        
        $this->db->from('visit_by_call vpc');
        
        if($sort_column!=null && $sort_order!=null){
            $this->db->order_by("$all_columns[$sort_column]", ucwords($sort_order));
        }else{
            $this->db->order_by("v.visit_id", 'DESC');
        }

        if($length!=-1) {
            if ($limit != null && $length != null) {
                $this->db->limit($length, $limit);
            }
        }

        if($employee_name != ''){
            $this->db->like("vpc.employee_name",$employee_name);

        }

        if($employee_company != ''){
            $this->db->like("vpc.employee_company",$employee_company);
            
        }

        if($visitor_name != ''){
            $this->db->like("vpc.visitor_name",$visitor_name);
            
        }



        /*if(isset($employee_name) || isset($employee_company) || isset($visitor_name)){
            
            if(isset($employee_name) && ($employee_company == '' || $visitor_name == '')){
                
            }

            elseif(isset($employee_company) && ($employee_name == '' || $visitor_name == '') ){
            }

            elseif(isset($visitor_name) && ($employee_name == '' || $employee_company == '') ){
                
            }

            elseif((isset($employee_name) && isset($employee_company)) && $visitor_name == '' ){
                
                $this->db->or_like("vpc.employee_name",$employee_name);
                $this->db->or_where("vpc.employee_company",$employee_company);      
            }


        }*/
        $query = $this->db->get();
        // print_r(json_encode($this->db->last_query(),true));
        // echo $this->db->last_query();
        if($limit==null && $length==null){
            return $query->num_rows();
        }
       //echo $this->db->last_query();
        return $query->result_array();
    }
	

    public function update_visit($data,$visit_id) {
        $this->db->where('visit_id', $visit_id);
        return $this->db->update('visit', $data);
    }

    public function update_visit_checkout($visit_id,$visit_checkout) {
        $data=array("visit_checkout"=>$visit_checkout);
        $this->db->where('visit_id', $visit_id);
        return $this->db->update('visit', $data);
    }

    public function get_not_checkout_visits($date1='',$date2='') {
        $this->db->select("visit_id,visit_date");
        $this->db->from("visit");
        $this->db->where('visit_checkout', null);
        if($date1!='' && $date2!=''){
            $this->db->where("visit_date BETWEEN '$date1' AND '$date2'");
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_visit_track($visit_id,$sort='ASC'){
        $this->db->select("vt.*,vp.visitor_name,v.visit_checkin,v.visit_checkout,u.first_name,u.last_name");
        $this->db->from("visit_track vt");
        $this->db->where('vt.visit_id_fk', $visit_id);
        $this->db->join('visit v', 'v.visit_id = vt.visit_id_fk');
        $this->db->join('user u', 'u.id = vt.user_id');
        $this->db->join('visitor_profile vp', 'vp.visitor_id = v.visit_visitor_id_fk');
        $this->db->order_by('vt.created_datetime', $sort);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getVisitorByVisitId($visit_id){
        $this->db->select("vp.visitor_id,vp.visitor_name,v.visit_id,v.visit_checkin,v.visit_checkout");
        $this->db->select("vp.visitor_driving_license,vp.visitor_passport_id,vp.visitor_family_no");
        $this->db->select("vp.visitor_identity_no,vp.visitor_employee_card,vp.visitor_picture");
        $this->db->from("visit v");
        $this->db->join('visitor_profile vp', 'vp.visitor_id = v.visit_visitor_id_fk');
        $this->db->where('v.visit_id', $visit_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getVisitorTrack($visitor_id,$sort='desc'){
        $this->db->select("vt.*,v.visit_checkin,v.visit_checkout,concat(u.first_name, ' ',u.last_name) as officer_name");
        $this->db->select("v.status,typ.name as visit_type,t.tenant_name");
        $this->db->from("visit_track vt");
        $this->db->join('visit v', 'v.visit_id = vt.visit_id_fk');
        $this->db->join('tenant t', 't.id = v.tenant_id','left');
        $this->db->join('visit_types typ', 'typ.id = v.visit_types','left');
        $this->db->join('user u', 'u.id = vt.user_id');
        $this->db->where('v.visit_visitor_id_fk', $visitor_id);
        $this->db->order_by('vt.created_datetime', $sort);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_all_visits_dashboard($limit,$length,$type){
        if($type=="today") {
            $date1 = date('Y-m-d');
            $date2 = date('Y-m-d');
			
        }elseif($type=="weekly"){
			$ts=date("Y-m-d");
            $date1=date("Y-m-d",strtotime('sunday this week -1 week', $ts));
            $date2=date("Y-m-d",strtotime('saturday this week', $ts));
        }elseif($type=="monthly"){
            $date1=date("Y-m-d",strtotime(date('Y-m-01')));
            $date2= date("Y-m-d",strtotime(date('Y-m-t')));
        }
        $this->db->select("v.*,vp.*,l.location as location");
        $this->db->from("visit v");
        $this->db->join('visitor_profile vp', 'vp.visitor_id = v.visit_visitor_id_fk');
        if($type!='all') {
            $this->db->where('v.visit_checkin >=', $date1);
   //          $this->db->where('v.visit_checkout <=', $date2);
   //          $this->db->or_where("v.visit_checkout >=", "$date1");
   //          $this->db->where("v.visit_checkout <=", "$date2");
			// $this->db->or_where("v.visit_checkout", null);
        }
        $this->db->join('locations l', 'l.id = v.location_id', 'left');

        if($limit!=null && $length!=null){
            $this->db->limit($length,$limit);
        }
        $this->db->order_by('v.visit_id', "DESC");
        $query = $this->db->get();
		//echo $this->db->last_query();die;
        return $query->result_array();
    }

    function get_today_checkin(){
        $date=date("Y-m-d");
        $this->db->select("v.visit_id");
        $this->db->from("visit v");
        $this->db->where('v.visit_checkout', null);
        $this->db->where("date(v.visit_checkin)","$date");
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_today_checkout(){
        $date=date("Y-m-d");
        $this->db->select("v.visit_id");
        $this->db->from("visit v");
        $this->db->where('v.visit_checkin !=', null);
        $this->db->where("date(v.visit_checkout)","$date");
        $this->db->where("v.visit_checkout !=",null);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_range_checkin($monday,$sunday){
		//$monday=date("Y-m-d",strtotime($monday));
		//$sunday=date("Y-m-d",strtotime($sunday));
        $this->db->select("v.visit_id, 
						DATE_FORMAT( STR_TO_DATE( REPLACE( v.visit_checkin, '/', '-' ) , '%d-%m-%Y' ) , '%Y-%m-%d' ) AS mycheckin, 
						DATE_FORMAT( STR_TO_DATE( REPLACE( v.visit_checkout, '/', '-' ) , '%d-%m-%Y' ) , '%Y-%m-%d' ) AS mycheckout");
        $this->db->from("visit v");
        $this->db->where('v.visit_checkout', null);
        $this->db->where("date(v.visit_checkin) BETWEEN '$monday' and '$sunday'");
		//$this->db->having("mycheckin >= '$monday' AND mycheckin <='$sunday'");
		//$this->db->where('v.visit_checkin >=', "$monday");
        //$this->db->where("v.visit_checkin <=","$sunday");
        $query = $this->db->get();
		//echo $this->db->last_query();die;
        return $query->num_rows();
    }

    function get_range_checkout($monday,$sunday){
        $this->db->select("v.visit_id");
        $this->db->from("visit v");
        $this->db->where('v.visit_checkin !=', null);
        $this->db->where("date(v.visit_checkout) BETWEEN '$monday' and '$sunday'");
        //$this->db->where('v.visit_checkout >=', "$monday");
        //$this->db->where("v.visit_checkout <=","$sunday");
        $this->db->where("v.visit_checkout !=",null);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_total_checkin(){
        $this->db->select("v.visit_id");
        $this->db->from("visit v");
        $this->db->where('v.visit_checkout', null);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_total_checkout(){
        $this->db->select("v.visit_id");
        $this->db->from("visit v");
        $this->db->where('v.visit_checkin !=', null);
        $this->db->where("v.visit_checkout !=", null);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_visit_info($visit_id){

        $this->db->select("v.*,vp.*,l.location as location_title,typ.name as visit_type,concat(u.first_name, ' ',u.last_name) as officer_name,t.tenant_name");
        $this->db->from("visit v");
        $this->db->where('v.visit_id', "$visit_id");
        $this->db->join('user u', 'u.id = v.created_by');
        $this->db->join('tenant t', 't.id = v.tenant_id');
        $this->db->join('visitor_profile vp', 'vp.visitor_id = v.visit_visitor_id_fk');
        $this->db->join('visit_types typ', 'typ.id = v.visit_types','left');
        $this->db->join('locations l', 'l.id = v.location_id', 'left');

        $this->db->order_by('v.visit_id', "DESC");

        $query = $this->db->get();
        return $query->row_array();
    }

    function find_visit_with_issue_card($issue_card){
        $this->db->select("v.*");
        $this->db->from("visit v");
        $this->db->where('v.visit_issued_card', "$issue_card");
        $this->db->where('v.visit_checkin !=', null);
        $this->db->where('v.visit_checkout', null);
        $query = $this->db->get();
        return $query->num_rows();
    }
}

?>