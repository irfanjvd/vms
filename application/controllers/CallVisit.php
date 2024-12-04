<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CallVisit extends CI_Controller
{ 

	function index(){
		redirect(base_url().'CallVisit/visits');
	}



    public function edit_visitor_visit_by_call($id){

        $session_data = $this->session->userdata('logged_in');

        if ($this->session->userdata('logged_in') && $session_data['login_user_type']!="SUPER") {
            
            $data = array();
            
            if($session_data['login_user_type']=="TENANT"){
                redirect(base_url().'visitor/private_visits');
            }

            if ($this->input->post()) {

                /*echo "<pre>";
                print_r($this->input->post());
                die;*/
                
                $message="";
                if (isset($_POST['visitor_identity_no']) && $_POST['visitor_identity_no'] == '' && $_POST['visitor_employee_card']=="" && $_POST['visitor_driving_license']=="" && $_POST['visitor_passport_id']=="") {
                    $message .= "Visitor Identity cannot be blank <br>";
                }
                if (isset($_POST['visitor_name']) && $_POST['visitor_name'] == '') {
                    $message .= "Visitor name cannot be blank <br>";
                }
                
                $issue_card_required=(isset($session_data['login_user_issue_card']))?$session_data['login_user_issue_card']:0;
                


                    if($message!=''){
                        $this->session->set_flashdata('message', array('message' => "$message", 'type' => 'error'));
                        $this->session->set_flashdata('post',$_POST);
                        redirect(base_url().'CallVisitor/addvisitor');

                    }

                $cnic = trim($this->input->post('visitor_identity_no'));
                $visitor_info = $this->visitor_model->get_visitor_call($cnic);
                $timestamp = date('Y-m-d H:i:s', strtotime($this->input->post('visit_checkin')));
                
                // if (!$visitor_info) {
                    
                    
                    $edit_visitor = array(
                        'employee_name' => trim($this->input->post('caller_name')),
                        "employee_company" => trim($this->input->post('visit_to_tenant')),
                        'employee_designation' => trim($this->input->post('caller_designation')),
                        'visitor_name' => trim($this->input->post('visitor_name')),
                        'visit_reason' => trim($this->input->post('visit_reason')),
                        'visit_date' => $timestamp,
                        'visitor_identity_no' => trim($this->input->post('visitor_identity_no')),
                        
                    );
                    
                    $table = 'visit_by_call as vpc';
                    $where = 'vpc.id ='.$id;
                    
                    $update_visit = $this->common_model->update($table,$edit_visitor,$where);
                    // var_dump($update_visit);die;
                    // $this->db->update('visit_by_call', $edit_visitor);
                    $action = "";
                    
                    if($message==''){
                        if($action=="CHECK_OUT"){
                            $this->session->set_flashdata('message', array('message' => "Visit checkout done successfully !!!", 'type' => 'success'));
                        }else{
                            $this->session->set_flashdata('message', array('message' => "Visit editted successfully !!!", 'type' => 'success'));
                        }


                    }
                    redirect(base_url().'CallVisit/visits');
                // } 
                        
            } // end if input post check
                $id = $id;

                $locations=$this->location_model->get_all_locations();
                $cities=$this->location_model->get_all_cities();
                $tenants=$this->tenant_model->get_all_tenants();
                    

                $data['locations']=$locations;
                $data['cities']=$cities;
                $data['tenants']=$tenants;
                $data['page_title'] = 'Add New Visitor';
                $result = $this->visit_model->get_call_visit_for_edit($id);
                $data['member_info'] = $result;

                // echo "<pre>";
                // print_r($data['member_info']);
                // die;

                $this->load->view('common/header', $data);
                // $this->load->view('visit_by_call/edit_visit',$data);
                $this->load->view('visitor_by_call/add_visitor',$data);
                $this->load->view('common/footer');
            
        
        
        } // end session userdata logged in and login user type check

        else{
            redirect(base_url());
        }

    }

    public function visits()
    {
        if ($this->session->userdata('logged_in')) {
			$session_data=$this->session->userdata('logged_in');
			if($session_data['login_user_type']=="TENANT"){
				redirect(base_url().'visitor/private_visits');
			}
            $data = array();
            $data['page_title'] = 'Visits(Phone Call) list';
            $data['tenants']=$this->tenant_model->get_all_tenants();
            $this->load->view('common/header', $data);
            $this->load->view('visit_by_call/visits');
            $this->load->view('common/footer');
        } else {
            redirect(base_url());
        }
    }


    public function get_ajax_visits_list()
    {
        

        $visitor_name = $this->input->get('visitor_name');
        $employee_name = $this->input->get('employee_name');
        $tenant = $this->input->get('employee_company');

        

        $result = $this->visit_model->get_all_visits_call($_GET['iDisplayStart'], $_GET['iDisplayLength'], $_GET['sSearch'], $_GET['iSortCol_0'], $_GET['sSortDir_0'],$employee_name,$visitor_name,$tenant);

        $total_visits = $this->visit_model->get_all_visits_call(null, null, $_GET['sSearch'], $_GET['iSortCol_0'], $_GET['sSortDir_0'],$employee_name,$visitor_name,$tenant);


        $data2 = array("sEcho" => $_GET['sEcho'],
            "iTotalRecords" => $total_visits,
            "iTotalDisplayRecords" => $total_visits,
        );

       


        foreach ($result as $key => $val) {
            $id = $val['id'];
           
           

            $data2['aaData'][] = array(

                'visitor_name' => $val['visitor_name'],
                'identity_no' => $val['visitor_identity_no'],
                'visit_reason' => $val['visit_reason'],
                'visit_to_tenant' => $val['employee_company'],
                'visit_to_employee' => $val['employee_name'],
                'visit_date' => $val['visit_date'],
                'action' => $this->create_visits_edit_button($id)
               // 'delete' => $this->create_delete_button($id),

            );
        }

        if ($total_visits == 0) {
            echo json_encode(array(
                "sEcho" => 0,
                "iTotalRecords" => "0",
                "iTotalDisplayRecords" => "0",
                "critical" => 0,
                "aaData" => array()
            ));
        } else {
            echo json_encode($data2);
        }


    }


    public function get_ajax_visits_list_dashboard($type)
    {
        $result = $this->visit_model->get_all_visits_dashboard($_GET['iDisplayStart'], $_GET['iDisplayLength'],$type);
        $total_result = $this->visit_model->get_all_visits_dashboard(null, null, $type);

        $total_visits = count($total_result);
        $data2 = array("sEcho" => $_GET['sEcho'],
            "iTotalRecords" => $total_visits,
            "iTotalDisplayRecords" => $total_visits,
        );

        foreach ($result as $key => $val) {
            $id = $val['visit_id'];
            if ($val['identity_type'] == "visitor_identity_no") {
                $identity_no = $val['visitor_identity_no'];
                $identity_type = "CNIC";
            } elseif ($val['identity_type'] == "visitor_employee_card") {
                $identity_no = $val['visitor_employee_card'];
                $identity_type = "Employee Card";
            } elseif ($val['identity_type'] == "visitor_driving_license") {
                $identity_no = $val['visitor_driving_license'];
                $identity_type = "Driving License";
            } elseif ($val['identity_type'] == "visitor_passport_id") {
                $identity_no = $val['visitor_passport_id'];
                $identity_type = "Passport ID";
            } else {
                $identity_no = $val['visitor_identity_no'];
                $identity_type = "Not Set";
            }

            $data2['aaData'][] = array(
                'visitor_name' => $val['visitor_name'],
                'visitor_address' => $val['visitor_address'],
                'visitor_cell_no' => $val['visitor_cell_no'],
                'identity_type' => $identity_type,
                'identity_no' => $identity_no,
                'visit_reason' => $val['visit_reason'],
                'visit_from_company' => $val['visit_from_company'],
                'visit_transport_mode' => $val['visit_transport_mode'],
                'visit_transport_registration_no' => strtoupper($val['visit_transport_registration_no']),
                'visit_issued_card' => $val['visit_issued_card'],
                'visit_checkin' => $val['visit_checkin'],
                'visit_checkout' => ($val['visit_checkout'] == "") ? "Not Set" : $val['visit_checkout'],
                'visit_date' => $val['visit_date'],
                'location' => $val['location'],
               // 'next_location' => $val['next_location'],
               // 'action' => $this->create_visits_edit_button($id)
               // 'delete' => $this->create_delete_button($id),

            );
        }


        if ($total_visits == 0) {
            echo json_encode(array(
                "sEcho" => 0,
                "iTotalRecords" => "0",
                "iTotalDisplayRecords" => "0",
                "aaData" => array()
            ));
        } else {
            echo json_encode($data2);
        }

    }




    function track_visit($visit_id){
        //get visit track info
        $data=array();
        $result=$this->visit_model->get_visit_track($visit_id);
        $data['track_info']=$result;
        $this->load->view('visit/track_visit',$data);
    }

    function visit_info($visit_id){
        //get visit track info
        $data=array();
        $result=$this->visit_model->get_visit_info($visit_id);
        $data['visit_info']=$result;
        $this->load->view('visit/visit_info',$data);
    }

    function create_checkout_link($val,$id){
        $session_data = $this->session->userdata('logged_in');
        if($session_data['login_user_type']=="SUPER"){
            return ($val['visit_checkout']=="")?"----":$val['visit_checkout'];
        }else{
            return ($val['visit_checkout'] == "" ) ? "<a onclick='opencolorbox(rel)' href='javascript:void(0)' rel='checkout?id=$id' id='checkoutbox' class='checkoutbox' style='text-decoration: none;'> CHECKOUT</a>" : $val['visit_checkout'];
        }

    }



    public function create_visits_edit_button($id){
        $session_data = $this->session->userdata('logged_in');
        $url=base_url()."CallVisit/edit_visitor_visit_by_call/$id";
        $track_url=base_url()."CallVisit/track_visit/$id";
        $visit_info_url=base_url()."CallVisit/visit_info/$id";
        $delete_visit = base_url()."CallVisit/delete_visit/$id";
       // if($session_data['login_user_type']=="SUPER"){
            return "
            <a href='$url'><i class='fa fa-pencil'></i></a>
            <a href='$delete_visit' onclick='return confirm(\"Are you sure you want to delete this visit?\");'>
                 <i class='fa fa-lock'></i>
                 </a>
            ";

    }

    function delete_visit($id){

            $table = 'visit_by_call';
            $where = 'id='.$id;

            $response = $this->common_model->delete($table,$where);
            
            if($response > 0){
                $this->session->set_flashdata('visit_delete', 'Visit information deleted successfully.');
                redirect("CallVisit/visits");
            }
            else{
                $this->session->set_flashdata('not_visit_delete', 'Unable to delete Visit Information. Try again!');
                redirect("CallVisit/visits");
            }

    }

    public function create_visits_delete_button($id){
        $url=base_url()."visit/delete_visit/$id";
        return "<a href='$url' onclick='return confirm(\"Are you sure you want to delete this user?\");'>
                 <i class='fa fa-lock'></i>
                 </a>";
    }


    public function scanned() {
        $cnic = $this->input->post('cnic');
        $name = $this->input->post('name');
        $father_name = $this->input->post('father_name');
        $address = $this->input->post('address');
        $family_no = $this->input->post('family_no');
        $cnic_status = $this->input->post('cnic_status');
        $visitor_info = $this->visitor_model->get_visitor($cnic);
        if(!$visitor_info){
            //Get information from NADRA
            $visitor_identity_no = $cnic;
            $visit_reason = '';
            $visit_transport_registration_no = '';
            $visit_transport_mode = '';
            $visit_from_company = '';
        }else{
            $visit_info = $this->visit_model->get_visit($visitor_info['visitor_id']);
            $visitor_identity_no = $visitor_info['visitor_identity_no'];
            $name = $visitor_info['visitor_name'];
            $father_name = $visitor_info['father_name'];
            $address = $visitor_info['visitor_address'];
            $visit_reason = $visit_info['visit_reason'];
            $visit_transport_registration_no = $visit_info['visit_transport_registration_no'];
            $visit_transport_mode = $visit_info['visit_transport_mode'];
            $visit_from_company = $visit_info['visit_from_company'];
        }

        $jsone_array = array(
            'visitor_identity_no' => $visitor_identity_no,
            'visitor_name' => $name,
            'visitor_father_name' => $father_name,
            'visitor_address' => $address,
            'visitor_cell_no' => $visitor_info['visitor_cell_no'],
            'visit_reason' => $visit_reason,
            'visit_transport_registration_no' => $visit_transport_registration_no,
            'visit_transport_mode' => $visit_transport_mode,
            'visit_from_company' => $visit_from_company,
            'visit_from_company' => $cnic_status,
            //'name' => $visitor_info['visitor_address'],
        );
        echo json_encode($jsone_array);
        exit;
    }

    function checkout(){
        //status bad mean operator is doing checkout from such location where user have not checked in...
        $session_data = $this->session->userdata('logged_in');
        if(!empty($_POST)){
            $visit_id=$_POST['visit_id'];
            $visit_checkout=(isset($_POST['visit_checkout']) && $_POST['visit_checkout']!="")?$_POST['visit_checkout']:date("m/d/Y H:i:s");
            //get visit location...
            $visit_result=$this->visit_model->get_visit_by_id($visit_id);
            $visit_location=$visit_result['location_id'];
            $location_id=$session_data['login_user_location'];
            if($visit_location==$location_id) {
                $this->visit_model->update_visit_checkout($visit_id, $visit_checkout);
                $this->log_model->create_log("VISIT CHECKOUT",$visit_checkout,$visit_id);
            }
            //add track info also...
            $add_track=array(
                "visit_id_fk" => $visit_id,
                "user_id" => $session_data['login_user_id'],
                "location_id" => $session_data['login_user_location'],
                "location_title" => $session_data['login_user_location_title'],
                "action" => "CHECK_OUT"

            );
            $this->db->insert('visit_track', $add_track);
            $track_id=$this->db->insert_id();
            $this->log_model->create_log("VISIT TRACK",$add_track,$track_id);

            redirect(base_url()."visit/visits");
        }else {
            $check_out_status='bad';
            $location_title=$session_data['login_user_location_title'];
            $vist_id = $_GET['id'];
            //get track of this visit...
            $track_result=$this->visit_model->get_visit_track($vist_id,"DESC");
            foreach($track_result as $key=>$val){
                $vals_array=array_values($val);
                if(in_array("CHECK_IN",$vals_array) && in_array($location_title,$vals_array)){
                    $check_out_status="good";
                    $checkin_date=$val['created_datetime'];
                    break;
                }
            }

            foreach($track_result as $key=>$val){
                $vals_array=array_values($val);
                if(in_array("CHECK_OUT",$vals_array) && in_array($location_title,$vals_array)){
                    if(strtotime($checkin_date) < strtotime($val['created_datetime']) ) {
                        $check_out_status = "bad";
                        break;
                    }
                }
            }


            $data = array();
            $data['id'] = $vist_id;
            $data['checkout_status'] = $check_out_status;
            $this->load->view('visit/checkout', $data);
        }
    }

    public function create_image($image){
        return "<a onclick='opencolorboximage(\"$image\")' href='javascript:void(0)'  id='checkoutbox' class='checkoutbox' style='text-decoration: none;'><img src='$image' width='50'>";
    }

   /*function export(){
       echo "<pre>";
       print_r($_POST);
   }*/

   function test_query(){

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
        // if($limit==null && $length==null){
            // $this->db->select('vpc.id');    
        // }else{
            $this->db->select('vpc.*');  
        // }
        
        $this->db->from('visit_by_call vpc');
        
        // if($sort_column!=null && $sort_order!=null){
            // $this->db->order_by("$all_columns[$sort_column]", ucwords($sort_order));
        // }else{
            $this->db->order_by("vpc.id", 'DESC');
        // }

        // if($length!=-1) {
        //     if ($limit != null && $length != null) {
        //         $this->db->limit($length, $limit);
        //     }
        // }
            $employee_name = 'sadsad';
            $employee_company ='';
            $visito_name = '';

        if(isset($employee_name) || isset($employee_company) || isset($visitor_name)){
            
            if(isset($employee_name)){
                
                $this->db->or_like("vpc.employee_name",$employee_name);
            }

            if(isset($employee_company)){
                $this->db->or_where("vpc.employee_company",$employee_company);
            }

            if(isset($visitor_name)){
                
                $this->db->or_like("vpc.visitor_name",$visitor_name);
            }


        }
        $query = $this->db->get();
        echo $this->db->last_query();

   }
	

} // end class CallVisit

?>