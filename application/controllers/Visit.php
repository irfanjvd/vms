<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Visit extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
//    public function __construct()
//    {
//        parent::__construct();
//        $this->load->model('visitor_model');
//        $this->load->model('visit_model');
//    }

    public function index()
    {
        $data = array();
        $data['page_title'] = 'Visitor list';
        $this->load->view('common/header', $data);
        $this->load->view('visitor/index');
        $this->load->view('common/footer');
    }


    public function edit_visit($id)
    {
        if ($this->session->userdata('logged_in')) {
            if (!empty($_POST)) {
                unset($_POST['submit']);
                $message = '';
                if (isset($_POST['visit_from_company']) && $_POST['visit_from_company'] == '') {
                    $message .= "Company name cannot be blank <br>";
                }
                if (isset($_POST['visit_checkin']) && $_POST['visit_checkin'] == '') {
                    $message .= "Checkin time cannot be blank <br>";
                }
                if (isset($_POST['visit_issued_card']) && $_POST['visit_issued_card'] == '') {
                    $message .= "Visit issued card cannot be blank <br>";
                }

                //upload profile picture...
                if (isset($_FILES['image_file'])) {
                    if ($_FILES['image_file']['name'] != '') {
                        $image_name = $_FILES['image_file']['name'];
                        $name_arr = explode(".", $image_name);
                        $image_type = strtolower($name_arr[1]);
                        if ($image_type == "jpg" || $image_type == "jpeg" || $image_type == "png") {
                            $size = $_FILES['image_file']['size'] / 1048576;
                            if ($size <= 1.0) {
                                //upload file...
                                $old_image = $_POST['old_image'];
                                unlink(FCPATH . "assets" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "user_images" . DIRECTORY_SEPARATOR . $old_image);
                                unset($_POST['old_image']);
                                $file_name = time() . $_FILES["image_file"]["name"];
                                $target_file = FCPATH . "assets" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "user_images" . DIRECTORY_SEPARATOR . $file_name;
                                move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file);
                                $_POST['image_file'] = $file_name;
                            } else {
                                //exceding size...
                                $message .= "File size must be less or equal to 1mb !!!";
                                $this->session->set_flashdata('message', array('message' => "$message", 'type' => 'error'));
                            }
                        } else {
                            //Only jpg and png files types are allowed...
                            $message .= "Only JPG and PNG images are allowed !!!";
                            $this->session->set_flashdata('message', array('message' => "$message", 'type' => 'error'));
                        }

                    } else {
                        unset($_POST['old_image']);
                    }
                }


                if ($message == '') {
                    //update user...
                    $result = $this->visit_model->update_visit($_POST, $id);
                    if ($result) {
                        $this->log_model->create_log("EDIT VISIT",$_POST,$id);
                        $this->session->set_flashdata('message', array('message' => 'Visit Info Updated Successfully !!!', 'type' => 'success'));
                    }

                } else {
                    $this->session->set_flashdata('message', array('message' => "$message", 'type' => 'error'));
                }

            }

            $data = array();
            $data['page_title'] = "Edit Visit";
            //get users details...
            $result = $this->visit_model->get_visit_for_edit($id);
            $tenants=$this->tenant_model->get_all_tenants();
            $data['tenants'] = $tenants;

            $data['info'] = $result;
            $this->load->view('common/header', $data);
            $this->load->view('visit/edit_visit', $data);
            $this->load->view('common/footer');
        } else {
            redirect(base_url());
        }
    }

    public function visits()
    {
        if ($this->session->userdata('logged_in')) 
        {
			$session_data=$this->session->userdata('logged_in');
			// if($session_data['login_user_type']=="TENANT"){
			// 	redirect(base_url().'visitor/private_visits');
			// }

            

            $data = array();
            $data['page_title'] = 'Visits list';
            $this->load->view('common/header', $data);
            $this->load->view('visit/visits');
            $this->load->view('common/footer');
        } else {
            redirect(base_url());
        }
    }

    public function get_ajax_visits_list()
    {
                                                                                                                                                                  //visitor_name      visitor_cell        identity number       vehiclenumber       tenant               issue card           company from        checkout             visit date           location
        $result = $this->visit_model->get_all_visits($_GET['iDisplayStart'], $_GET['iDisplayLength'], $_GET['sSearch'], $_GET['iSortCol_0'], $_GET['sSortDir_0'], $_GET['sSearch_1'], $_GET['sSearch_2'], $_GET['sSearch_4'], $_GET['sSearch_7'], $_GET['sSearch_8'], $_GET['sSearch_10'], $_GET['sSearch_11'], $_GET['sSearch_13'], $_GET['sSearch_14'], $_GET['sSearch_15']);

        $total_visits = $this->visit_model->get_all_visits(null, null, $_GET['sSearch'], $_GET['iSortCol_0'], $_GET['sSortDir_0'], $_GET['sSearch_1'], $_GET['sSearch_2'], $_GET['sSearch_4'], $_GET['sSearch_7'], $_GET['sSearch_8'], $_GET['sSearch_10'], $_GET['sSearch_11'], $_GET['sSearch_13'], $_GET['sSearch_14'], $_GET['sSearch_15']);
        
        //$total_visits = count($total_result);
        //get not checkout visits....
        $not_checkout_result = $this->visit_model->get_not_checkout_visits();
        date_default_timezone_set('Asia/Karachi');
        $end_date=date("Y-m-d H:i:s");
        $critical=0;

        $data2 = array("sEcho" => $_GET['sEcho'],
            "iTotalRecords" => $total_visits,
            "iTotalDisplayRecords" => $total_visits,
            "critical" => 0,
        );

        foreach($not_checkout_result as $key_checkout=>$val_checkout){
            $start_date = $val_checkout['visit_date'];
            $date1 = $end_date;
            $date2 = $start_date;
            $diff = strtotime($date1) - strtotime($date2);
            $diff_in_hrs = $diff / 3600;
            if ($diff_in_hrs >= 12) {
                $critical++;
                $data2['critical'] = $critical;
            }
        }

        $loop_index = 0;
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
//            if($_GET['sSearch_12']=="Critical"){
//                //get number of hours between visit date
//                $date1 = date("Y-m-d H:i:s");
//                $date2 = $val['visit_date'];
//                $diff = strtotime($date1) - strtotime($date2);
//                $diff_in_hrs = $diff/3600;
//                if($diff_in_hrs<=10){
//                    continue;
//                }
//            }


            $current_status = '<span class="btn btn-warning">Pending</span>';

            switch($val['status'])
            {
                case 'Approved': $current_status = '<span class="btn btn-success">Approved</span>'; break;
                case 'Rejected': $current_status = '<span class="btn btn-danger">Rejected</span>'; break;
                case 'Blacklisted': $current_status = '<span class="btn btn-default">Blacklisted</span>'; break;
            }

            $data2['aaData'][$loop_index] = array(
                'visitor_picture' => $this->create_image($val['visitor_picture']),
                'visitor_name' => $val['visitor_name'],
                'visitor_address' => $val['visitor_address'],
                'visitor_cell_no' => $val['visitor_cell_no'],
                'identity_type' => $identity_type,
                'identity_no' => $identity_no,
                'visit_reason' => $val['visit_reason'],
                'visit_from_company' => $val['visit_from_company'],

                'visit_transport_mode' => ($val['visit_transport_mode']=="")?"Not set":$val['visit_transport_mode'],
                'visit_transport_registration_no' => strtoupper($val['visit_transport_registration_no']),
                'visit_to_tenant' => $val['tenant_name'],
                'visit_from_company' => $val['visit_from_company'],
                'visit_to_employee' => $val['employee_name'],
                'visit_issued_card' => $val['visit_issued_card'],
                'visit_checkin' => $val['visit_checkin'],
                'visit_checkout' => $this->create_checkout_link($val,$id),
                'visit_date' => $val['visit_date'],
                'location' => $val['location'],
                'status' => $current_status,
//                'next_location' => $val['next_location'],
//                'action' => $this->create_visits_edit_button($id)
//                'delete' => $this->create_delete_button($id),

            );

            if(sessiondata('login_user_type')!="VIEW_ONLY")
            {
                $data2['aaData'][$loop_index]['action'] = '';

                switch($val['status'])
                {
                    case 'Pending':
                            $data2['aaData'][$loop_index]['action'] = $this->create_visits_edit_button($id); 
                            break;
                    case 'Approved':
                            $data2['aaData'][$loop_index]['action'] = $this->create_visits_onapproved_button($id); 
                            break;
                }
                // if($val['status'] == 'Pending')
                // {
                //     $data2['aaData'][$loop_index]['action'] = $this->create_visits_edit_button($id);
                // }else{
                //         $data2['aaData'][$loop_index]['action'] = '';
                //      }
                
            }else{
                    $data2['aaData'][$loop_index]['action'] = '';
                 }

            $loop_index++;
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
//                'next_location' => $val['next_location'],
//                'action' => $this->create_visits_edit_button($id)
//                'delete' => $this->create_delete_button($id),

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

    public function create_visits_edit_button($id)
    {
        $session_data   = $this->session->userdata('logged_in');
        $url            = base_url()."visit/edit_visit/$id";
        $track_url      = base_url()."visit/track_visit/$id";
        $visit_info_url = base_url()."visit/visit_info/$id";
        $visit_blacklist= base_url()."visit/black_list/$id";

        //$approve_url    = base_url()."visit/approved_requests/$id";
        //$reject_url    = base_url()."visit/reject_requests/$id";

//        if($session_data['login_user_type']=="SUPER"){
            $links = "
            <a href='$url'><i class='fa fa-pencil'></i></a>
            <a href='javascript:void(0)' rel='$track_url' onclick='open_track(rel)' title='Open track'>
                <i class='fa fa-book track_color_box' ></i>
            </a>
            <a href='javascript:void(0)' rel='$visit_info_url' onclick='open_visit_info(rel)' title='Open visit info'>
                <i class='fa fa-eye track_color_box' ></i>
            </a>
            ";

            
            //if($session_data['login_user_type']=="SUPER")
            //{
                $btn_approved = " <a href='javascript:void(0)' rel='$id' onclick='approved_requests(rel)' title='Approve it'><i class='fa fa-check-circle' aria-hidden='true'></i></a> ";

                $btn_rejected = " <a href='javascript:void(0)' rel='$id' onclick='rejected_requests(rel)' title='Reject it'><i class='fa fa-times-circle' aria-hidden='true'></i></a> ";

                $btn_blacklist= " <a href='javascript:void(0)' rel='$id' onclick='blacklist_requests(rel)' title='Blacklist him'><i class='fa fa-ban' aria-hidden='true'></i></a> ";

                $links .= $btn_approved." ".$btn_rejected." ".$btn_blacklist;
           // }

            return $links;

//        }else{
//            return "
//            <a href='javascript:void(0)' rel='$track_url' onclick='open_track(rel)' title='Open track'>
//                <i class='fa fa-book track_color_box' ></i>
//            </a>
//            <a href='javascript:void(0)' rel='$visit_info_url' onclick='open_visit_info(rel)' title='Open visit info'>
//                <i class='fa fa-eye track_color_box' ></i>
//            </a>
//            ";
//        }

    }


    public function create_visits_onapproved_button($id)
    {
        $session_data   = $this->session->userdata('logged_in');
        $url            = base_url()."visit/edit_visit/$id";
        $track_url      = base_url()."visit/track_visit/$id";
        $visit_info_url = base_url()."visit/visit_info/$id";
        $visit_blacklist= base_url()."visit/black_list/$id";
        $edit_visit     = base_url()."visitor/edit_visitor/$id";

        //$approve_url    = base_url()."visit/approved_requests/$id";
        //$reject_url    = base_url()."visit/reject_requests/$id";

//        if($session_data['login_user_type']=="SUPER"){
        $links = "";
            // $links = "
            // <a href='$url'><i class='fa fa-pencil'></i></a>
            // <a href='javascript:void(0)' rel='$track_url' onclick='open_track(rel)' title='Open track'>
            //     <i class='fa fa-book track_color_box' ></i>
            // </a>
            // <a href='javascript:void(0)' rel='$visit_info_url' onclick='open_visit_info(rel)' title='Open visit info'>
            //     <i class='fa fa-eye track_color_box' ></i>
            // </a>
            // ";

            $result = $this->visit_model->get_single_visit_by_id($id); //print_r($result);
//echo "<pre>".print_r($result); die();
            if($result['visit_checkin'] == "")
            {
                $links .= "<a href='$edit_visit'>Check-in</a>";
            }
            

            if($session_data['login_user_type']=="SUPER")
            {
                $btn_approved = " <a href='javascript:void(0)' rel='$id' onclick='approved_requests(rel)' title='Approve it'><i class='fa fa-check-circle' aria-hidden='true'></i></a> ";

                $btn_rejected = " <a href='javascript:void(0)' rel='$id' onclick='rejected_requests(rel)' title='Reject it'><i class='fa fa-times-circle' aria-hidden='true'></i></a> ";

                $btn_blacklist= " <a href='javascript:void(0)' rel='$id' onclick='blacklist_requests(rel)' title='Blacklist him'><i class='fa fa-ban' aria-hidden='true'></i></a> ";

                $links .= $btn_approved." ".$btn_rejected." ".$btn_blacklist;
            }

            return $links;

//        }else{
//            return "
//            <a href='javascript:void(0)' rel='$track_url' onclick='open_track(rel)' title='Open track'>
//                <i class='fa fa-book track_color_box' ></i>
//            </a>
//            <a href='javascript:void(0)' rel='$visit_info_url' onclick='open_visit_info(rel)' title='Open visit info'>
//                <i class='fa fa-eye track_color_box' ></i>
//            </a>
//            ";
//        }

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
            $visit_checkout=(isset($_POST['visit_checkout']) && $_POST['visit_checkout']!="")?$_POST['visit_checkout']:date("Y-m-d H:i:s");
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

    function get_graph_visits(){
        $type=$this->input->post("date");
        if($type=="monthly"){
            $start = date("Y-m-d", strtotime(date('Y-m-01')));
            $end = date("Y-m-d", strtotime(date('Y-m-t')));
            $month_result=$this->common_model->find("visit","date(visit_date) as name,COUNT(*)as y",false,"date(visit_checkin) BETWEEN '$start' and '$end'",false,false,"date(visit_checkin)");
            echo json_encode($month_result,JSON_NUMERIC_CHECK);
        }else if($type=="weekly"){
			$end=date("Y-m-d");
			$start = date("Y-m-d",strtotime(date("Y-m-d", strtotime($end)) . " -6 days"));
			
            //$start = date("Y-m-d", strtotime("monday"));
            //$end = date("Y-m-d", strtotime("sunday"));
            $week_result=$this->common_model->find("visit","date(visit_date) as name,COUNT(*)as y",false,"date(visit_checkin) BETWEEN '$start' and '$end'",false,false,"date(visit_checkin)");
            echo json_encode($week_result,JSON_NUMERIC_CHECK);
        }else if($type==-15){
            $end=date("Y-m-d");
            $start = date("Y-m-d",strtotime(date("Y-m-d", strtotime($end)) . " -14 days"));
            $week_result=$this->common_model->find("visit","date(visit_date) as name,COUNT(*)as y",false,"date(visit_checkin) BETWEEN '$start' and '$end'",false,false,"date(visit_checkin)");
            echo json_encode($week_result,JSON_NUMERIC_CHECK);
            
        }else if($type==-30){
            $end=date("Y-m-d");
            $start = date("Y-m-d",strtotime(date("Y-m-d", strtotime($end)) . " -29 days"));
            $week_result=$this->common_model->find("visit","date(visit_date) as name,COUNT(*)as y",false,"date(visit_checkin) BETWEEN '$start' and '$end'",false,false,"date(visit_checkin)");
            echo json_encode($week_result,JSON_NUMERIC_CHECK);
            
        }
    }

    function get_critical_visits(){
        $end=date("Y-m-d");
        $start = date("Y-m-d",strtotime(date("Y-m-d", strtotime($end)) . " -6 days"));
        $not_checkout_result = $this->visit_model->get_not_checkout_visits($start,$end);
        date_default_timezone_set('Asia/Karachi');
        $end_date=date("Y-m-d H:i:s");
        $critical=0;

        foreach($not_checkout_result as $key_checkout=>$val_checkout){
            $start_date = $val_checkout['visit_date'];
            $date1 = $end_date;
            $date2 = $start_date;

            $diff = strtotime($date1) - strtotime($date2);
            $diff_in_hrs = $diff / 3600;
            if ($diff_in_hrs >= 12) {
                $critical++;
                
            }
        }
        echo $critical;
    }


    function perform_visit_action()
    {
        $id = (int)$this->input->post('id');
        $actions = $this->input->post('actions');

        $response = [];

        if($id > 0 && sessiondata('login_user_type') == 'SUPER')
        {
            $updateData = [];

            if($actions == 'Approve' || $actions == 'Reject'  || $actions == 'Blacklist')
            {
                switch($actions)
                {
                    case 'Approve':   $updateData['status'] = 'Approved'; break;
                    case 'Reject':    $updateData['status'] = 'Rejected'; break;
                    case 'Blacklist': $updateData['status'] = 'Blacklisted'; $this->blacklist($id); break;
                }

                

                $where = array('visit_id' => $id);


                $this->db->update('visit', $updateData, $where);
                //echo $this->db->last_query();


                $response['code']    = 200;
                $response['message'] = 'success';
                $response['data']    = "Action has been performed successfully.";
            }else{
                    $response['code']    = 403;
                    $response['message'] = 'error';
                    $response['data']    = "Invalid action.";
                 }

            


            
        }else{
                $response['code']    = 403;
                $response['message'] = 'error';
                $response['data']    =  "You do not have permissions to perform this action.";
             }

        //header('Content-Type: application/json');
        echo json_encode($response);
    }


    function blacklist($id)
    {
        $query = "SELECT * FROM visit v INNER JOIN visitor_profile vf ON (vf.visitor_id = v.visit_visitor_id_fk) WHERE visit_id = '".$id."'";

        $get_visitor_Detail = $this->db->query($query)->row();

        if($get_visitor_Detail)
        {
            $cnic           = $get_visitor_Detail->visitor_identity_no;
            $visitor_id     = $get_visitor_Detail->visit_visitor_id_fk;
            $black_list_by  = sessiondata('login_user_id');
            $action_date    = date('Y-m-d H:i:s'); 

            $insert_data = array('visitor_id'   => $visitor_id, 
                                 'visitor_cnic' => $cnic, 
                                 'created_by'   => $black_list_by, 
                                 'created_at'   => $action_date, 
                                );

            $this->db->insert('black_listed', $insert_data);
        }


    }

}
