<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Visitor extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
   /* public function __construct() {
        
		parent::__construct();
		
    }*/

     public function __construct()
    {
        parent::__construct();
        
           if(sessiondata('login_user_type')=="VIEW_ONLY")
            {
                redirect(base_url().'visit/visits');
            }
    }

    public function index($type=null) {
		
        if ($this->session->userdata('logged_in')) 
        {
			$session_data=$this->session->userdata('logged_in'); 
			if($session_data['login_user_type']=="TENANT"){
				redirect(base_url().'visitor/private_visits');
			}

            
            if ($type == null) {
                $type = "today";
            }
            $data = array();
            $data['page_title'] = 'Visitor list';
//        $dashboard_visits=$this->visit_model->get_visits_dashboard($type);
//        echo "<pre>";
//        print_r($dashboard_visits);die;
            $today_checkin = $this->visit_model->get_today_checkin();
			//echo $today_checkin;
            $today_checkout = $this->visit_model->get_today_checkout();
            $today_total = $today_checkin + $today_checkout;
            $data['today_checkin'] = $today_checkin;
            $data['today_checkout'] = $today_checkout;
            $data['today_total'] = $today_total;
            //get week visits
            //$monday = date("Y-m-d", strtotime("monday"));
            //$sunday = date("Y-m-d", strtotime("sunday"));
            //echo $sunday."-".$monday;
            $sunday = date("Y-m-d");
			$monday = date("Y-m-d",strtotime(date("Y-m-d", strtotime($sunday)) . " -6 days"));
            //$monday = date("Y-m-d",strtotime('sunday this week -1 week', $ts));
            //$sunday = date("Y-m-d",strtotime('saturday this week', $ts));
			 //echo $start."-".$end;
            // echo "<pre>";print_r( array(date('Y-m-d', $start), date('Y-m-d', $end)));die;
            //echo $monday." ".$sunday;
            $week_checkin = $this->visit_model->get_range_checkin($monday, $sunday);
            $week_checkout = $this->visit_model->get_range_checkout($monday, $sunday);
            $data['week_checkin'] = $week_checkin;
            $data['week_checkout'] = $week_checkout;
            $data['week_total'] = $week_checkin + $week_checkout;

            //get monthly visits...
            $month_first = date("Y-m-d", strtotime(date('Y-m-01')));
            $month_last = date("Y-m-d", strtotime(date('Y-m-t')));
            $month_checkin = $this->visit_model->get_range_checkin($month_first, $month_last);
            $month_checkout = $this->visit_model->get_range_checkout($month_first, $month_last);
            //echo $month_checkout;
			$data['month_checkin'] = $month_checkin;
            $data['month_checkout'] = $month_checkout;
			
            $data['month_total'] = $month_checkin + $month_checkout;

            //get overall visits...
            $total_checkin = $this->visit_model->get_total_checkin();
            $total_checkout = $this->visit_model->get_total_checkout();
            $data['total_checkin'] = $total_checkin;
            $data['total_checkout'] = $total_checkout;
            $data['total_total'] = $total_checkin + $total_checkout;
            $data['type'] = $type;
            //get current week visits by date
            $week_result=$this->common_model->find("visit","date(visit_date) as name,COUNT(*)as y",false,"date(visit_checkin) BETWEEN '$monday' and '$sunday'",false,false,"date(visit_checkin)");
            if(!empty($week_result)){
                foreach($week_result as $key=>$val){
                    $week_result[$key]['name']=date("Y-M-d",strtotime($val['name']));
                }    
            }
            
            $joins[]="tenant t";
            $joins_on=array(
                "t.id=visit.tenant_id",
            );
            $current_date=date("Y-m-d");
            $tenant_graph_result=$this->common_model->find("visit","t.tenant_name as name,COUNT(*)as y",false,"date(visit_checkin) BETWEEN '$current_date' and '$current_date' and tenant_id!=0",$joins,$joins_on,"tenant_id");
            
            //add url
            // foreach($week_result as $key=>$val){
            //     $week_result[$key]['url']="http://www.google.com";
            // }
            $data['week_result']=$week_result;
            $data['tenant_graph_result']=$tenant_graph_result;
            // echo "<pre>";
            // print_r($tenant_graph_result);die;
            //echo json_encode($week_result);die;
            $this->load->view('common/header', $data);
            $this->load->view('visitor/index');
            $this->load->view('common/footer');
        } else {
            redirect(base_url());
        }
    }


    public function edit_visitor($id)
    {
        if ($this->session->userdata('logged_in')) {
            if (!empty($_POST)) {

                $visitor_type=$_POST['visitor_type'];


                unset($_POST['submit']);
                $message = '';
                if (isset($_POST['visitor_identity_no']) && $_POST['visitor_identity_no'] == '') {
                    $message .= "Identity number cannot be blank <br>";
                }
                if (isset($_POST['visitor_name']) && $_POST['visitor_name'] == '') {
                    $message .= "Visitor name cannot be blank <br>";
                }
//                if (isset($_POST['visitor_father_name']) && $_POST['visitor_father_name'] == '') {
//                    $message .= "Father name cannot be blank <br>";
//                }
//                if (isset($_POST['visitor_address']) && $_POST['visitor_address'] == '') {
//                    $message .= "Address cannot be blank <br>";
//                }
                if (isset($_POST['visitor_city']) && $_POST['visitor_city'] == '') {
                    $message .= "Visitor city cannot be blank <br>";
                }


                //upload profile picture...
                if(isset($_FILES['image_file'])) {
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
//                    echo "<pre>";
//                    print_r($_POST);die;
                    try {
                        //PDO query execution goes here.
                        $update_visitor = array(
                            'visitor_name' => trim($this->input->post('visitor_name')),
                            "$visitor_type" => trim($this->input->post('visitor_identity_no')),
                            'visitor_address' => trim($this->input->post('visitor_address')),
                            'visitor_cell_no' => trim($this->input->post('visitor_cell_no')),
                            'visitor_city' => trim($this->input->post('visitor_city')),
//                            'visitor_picture' => $imgName,
                        );
                        $result = $this->visitor_model->update_visitor($update_visitor, $id);
                        $this->log_model->create_log("EDIT VISITOR",$update_visitor,$id);
                        if($result==""){
                            throw new Exception();
                        }
                    }
                    catch (Exception $e) {
//                        echo "<pre>";
//                        print_r($e->error);die;
                        $this->session->set_flashdata('message', array('message' => 'Visitor Identity Already exist !!!', 'type' => 'error'));
                        redirect(base_url().'visitor/edit_visitor/'.$id);
                    }

                    if ($result) {
                        $this->session->set_flashdata('message', array('message' => 'Visitor Info Updated Successfully !!!', 'type' => 'success'));
                        redirect(base_url().'visitor/edit_visitor/'.$id);
                    }

                } else {
                    $this->session->set_flashdata('message', array('message' => "$message", 'type' => 'error'));
                    redirect(base_url().'visitor/edit_visitor/'.$id);
                }

            }

            $data = array();
            $data['page_title'] = "Edit Visitor";
            //get users details...
            $result = $this->visitor_model->get_visitor_by_id($id);

            $data['info'] = $result;
            $this->load->view('common/header', $data);
            $this->load->view('visitor/edit_visitor', $data);
            $this->load->view('common/footer');
        } else {
            redirect(base_url());
        }
    }


    public function get_ajax_visitors(){
        $result=$this->visitor_model->get_all_visitors($_GET['iDisplayStart'],$_GET['iDisplayLength'],$_GET['sSearch'],$_GET['iSortCol_0'],$_GET['sSortDir_0'],$_GET['sSearch_2'],$_GET['sSearch_4'],$_GET['sSearch_5']);
        $total_result=$this->visitor_model->get_all_visitors(null,null,$_GET['sSearch'],$_GET['iSortCol_0'],$_GET['sSortDir_0'],$_GET['sSearch_2'],$_GET['sSearch_4'],$_GET['sSearch_5']);
        $total_visitors=count($total_result);
        $data2= array("sEcho" => $_GET['sEcho'],
            "iTotalRecords" => $total_visitors,
            "iTotalDisplayRecords" => $total_visitors,
        );
        foreach($result as $key=>$val){
            $visitor_identity=($val['visitor_identity_no']=="")?"Not Set":$val['visitor_identity_no'];
            $visitor_employee_card=($val['visitor_employee_card']=="")?"Not Set":$val['visitor_employee_card'];
            $driving_license=($val['visitor_driving_license']=="")?"Not Set":$val['visitor_driving_license'];
            $passport_id=($val['visitor_passport_id']=="")?"Not Set":$val['visitor_passport_id'];

            $id=$val['visitor_id'];
            $data2['aaData'][] = array(
                'visitor_picture' => $this->create_image($val['visitor_picture']),
                'visitor_identity_no' => "<b>CNIC:</b> ".$visitor_identity."<b> Employee Card:</b>".$visitor_employee_card." <b>License</b>: ".$driving_license." <b>Passport:</b> ".$passport_id,
                'visitor_family_no' => $val['visitor_family_no'],
                'visitor_name' => $val['visitor_name'],
                'visitor_father_name' => $val['visitor_father_name'],
                'visitor_address' => $val['visitor_address'],
                'visitor_cell_no' => $val['visitor_cell_no'],
                'visitor_district' => $val['visitor_district'],
                'visitor_city' => $val['visitor_city'],
                'visitor_registration_mode' => $val['visitor_registration_mode'],
                'created_datetime' => $val['created_datetime'],
                'edit' => $this->create_edit_button($id),
//                'delete' => $this->create_delete_button($id),

//                    'app_file' => $filename,
//                    'empty_form' => $empty_form,
//                    'form_id' => $form_id,
            );
        }

        if($total_visitors==0){
            echo json_encode(array(
                "sEcho" => 0,
                "iTotalRecords" => "0",
                "iTotalDisplayRecords" => "0",
                "aaData" => array()
            ));
        }else {
            echo json_encode($data2);
        }
    }

	public function get_ajax_private_visits(){
        //get user_id from employee_id...
        if($_REQUEST['employee_id']){
            $employee_id=$_REQUEST['employee_id'];
            $user_result=$this->common_model->find("tenant_employees","user_id",true,array('id'=>$employee_id));
            $_REQUEST['employee_id']=$user_result['user_id'];

        }
        
        $result=$this->visitor_model->get_all_private_visits($_REQUEST['iDisplayStart'],$_REQUEST['iDisplayLength'],$_REQUEST['sSearch'],$_REQUEST['iSortCol_0'],$_REQUEST['sSortDir_0'],$_REQUEST['name'],$_REQUEST['cnic'],$_REQUEST['mobile'],$_REQUEST['number_plate'],$_REQUEST['status'],$_REQUEST['employee_id'],$_REQUEST['date_range'],$_REQUEST['tenant_id'],$_REQUEST['visit_code']);
        $total_result=$this->visitor_model->get_all_private_visits(null,null,$_REQUEST['sSearch'],$_REQUEST['iSortCol_0'],$_REQUEST['sSortDir_0'],$_REQUEST['name'],$_REQUEST['cnic'],$_REQUEST['mobile'],$_REQUEST['number_plate'],$_REQUEST['status'],$_REQUEST['employee_id'],$_REQUEST['date_range'],$_REQUEST['tenant_id'],$_REQUEST['visit_code']);
        $total_visitors=count($total_result);
        $data2= array("sEcho" => $_REQUEST['sEcho'],
            "iTotalRecords" => $total_visitors,
            "iTotalDisplayRecords" => $total_visitors,
        );

        foreach($result as $key=>$val){
            //$date=date("Y-m-d",$val['date']);
			//$date2=strtotime('2017-11-11');
            $id=$val['id'];
			$status=$val['status'];
			if($status=="PENDING"){
				$color="orange";
			}else if($status=="MARKED"){
				
				$color="red";
			}else{
				$color="green";
			}

			if($status=="PENDING"){
                if($_SESSION['logged_in']['login_user_type']!="TENANT"){
                    $status_msg="<p id='visit_status_$val[id]'><span class='btn btn-warning' onclick='change_status($val[id],\"$status\")'>".$val['status']."</span></p>";
                }else{
                    $status_msg="<p id='visit_status_$val[id]'><span class='btn btn-warning'>".$val['status']."</span></p>";
                }
				
			}else if($status=="MARKED"){
				$status_msg="<p id='visit_status_$val[id]'><span class='btn btn-info'>".$val['status']."</span></p>";
			}else{
				$status_msg="<p id='visit_status_$val[id]'><span class='btn btn-success'>".$val['status']."</span></p>";
			}
            $data2['aaData'][] = array(
                'null' => $val['id'],
                // 'title' => $val['title'],
                'agenda' => $val['agenda'],
                'date_time' => $val['created_datetime'],
                'tenant' => $this->getTenantName($val['tenant_id']),
                'employee' => $this->getEmployeeName($val['employee_id']),
                'is_cargo' => ($val['is_cargo']==1)?"Yes":"No",
                'visit_code' => $val['visit_code'],
				'total' => $val['total'],
                'status' => "$status_msg",
            );
        }

        if($total_visitors==0){
            echo json_encode(array(
                "sEcho" => 0,
                "iTotalRecords" => "0",
                "iTotalDisplayRecords" => "0",
                "aaData" => array()
            ));
        }else {
            echo json_encode($data2);
        }
    }
	
	function change_private_visit_status(){
		$id=$this->input->post('id');
		$status=$this->input->post('status');
		if($status=="PENDING"){
			$status="MARKED";
		}else{
			$status="PENDING";
		}
		$this->visitor_model->change_private_visit_status($id,$status);
		echo $status;
		
		
	}
	
	function getEmployeeName($id){
		$this->db->select('employee_name');
		$this->db->from('tenant_employees');
		$this->db->where('employee_id',$id);
		$query = $this->db->get();
		$result= $query->row_array();
		if(!empty($result)){
			return  $result['employee_name'];
		}else{
			return "Not Found";
		}
	}
	
	function getTenantName($id){
		$this->db->select('tenant_name');
		$this->db->from('tenant');
		$this->db->where('id',$id);
		$query = $this->db->get();
		$result= $query->row_array();
		if(!empty($result)){
			return  $result['tenant_name'];
		}else{
			return "Not Found";
		}
	}
	
    public function create_image($image){
        return "<a onclick='opencolorboximage(\"$image\")' href='javascript:void(0)'  id='checkoutbox' class='checkoutbox' style='text-decoration: none;'><img src='$image' width='50'>";
    }

    public function create_edit_button($id){
        $session_data = $this->session->userdata('logged_in');
        $url=base_url()."visitor/edit_visitor/$id";
        $url1=base_url()."visitor/get_visitor_full_track/$id";
//        if($session_data['login_user_type']=="SUPER") {
            return "
            <a href='$url' title='Edit visitor info'><i class='fa fa-pencil'></i></a>
            <a target='_blank' href='$url1' title='Show visitor track'><i class='fa fa-book'></i></a>

            ";
//        }else{
//            return "
//            <a href='$url1' title='Show visitor track'><i class='fa fa-book'></i></a>
//
//            ";
//        }
    }
	
	public function create_action_button($id){
        $session_data = $this->session->userdata('logged_in');
        $url=base_url()."visitor/edit_visitor/$id";
        $url1=base_url()."visitor/get_visitor_full_track/$id";
            return "
            <a href='$url' title='Edit visitor info'><i class='fa fa-pencil'></i></a>

            ";
    }

    public function create_delete_button($id){
        $url=base_url()."visitor/delete_visitor/$id";
        return "<a href='$url' onclick='return confirm(\"Are you sure you want to delete this user?\");'>
                 <i class='fa fa-remove'></i>
                 </a>";
    }

    public function visitors() {
        if ($this->session->userdata('logged_in')) {
			$session_data=$this->session->userdata('logged_in');
			if($session_data['login_user_type']=="TENANT"){
				redirect(base_url().'visitor/private_visits');
			}
            $data = array();
            $data['page_title'] = 'Visitor list';
            $this->load->view('common/header', $data);
            $this->load->view('visitor/visitors');
            $this->load->view('common/footer');
        }else{
            redirect(base_url());
        }
//        die("dddd");
    }
	
	public function private_visits() {
        // echo "<pre>";
        // print_r($_SESSION);die;
        if ($this->session->userdata('logged_in')) {
            //check user otp verified???
            //$this->otpVerified();
            $data = array();
			//set notification count 0;
			$this->common_model->update("notifications",array('total'=>0),array('id'=>1));
            $tenants=$this->common_model->find("tenant","*",false,array('status'=>1));
            $data['page_title'] = 'Visitor list';
            $data['tenants']=$tenants;
            $this->load->view('common/header', $data);
            $this->load->view('visitor/private_visits',$data);
            $this->load->view('common/footer');
        }else{
            redirect(base_url());
        }
//        die("dddd");
    }

    function otpVerified(){
        $session_data=$this->session->userdata('logged_in');
        $user_id=$session_data['login_user_id'];
        $otp_result=$this->common_model->find("tenant_employees","otp_verified",1,array('user_id'=>$user_id));
        if($otp_result['otp_verified']==0){
            //redirect to verification page....
            redirect(base_url()."user/verifyOtp");
        }
        // echo '<pre>';
        // print_r($otp_result);die;
    }
    

    public function addvisitor($id='') 
    {
		
        date_default_timezone_set('Asia/Karachi');
        $private_visit_check = 0;
        $session_data = $this->session->userdata('logged_in');
        if ($this->session->userdata('logged_in') && $session_data['login_user_type'] != "SUPER") {
            $data = array();

            if ($this->uri->segment(4)) {
                $private_visit_check = $this->uri->segment(4);
                $data['private_visit_check'] = $private_visit_check;
            }

            $data = $private_visit_check;
            if ($session_data['login_user_type'] == "TENANT") {
                redirect(base_url() . 'visitor/private_visits');
            }

            if ($this->input->post()) 
            {
                $message = "";

                if($this->input->post('visitor_identity_no'))
                {
                    $is_blacklist = $this->verify_black_listed($this->input->post('visitor_identity_no'));

                    if($is_blacklist)
                    {
                        $message .= "This user is back listed. <br>";
                    }
                }

                if (isset($_POST['visitor_identity_no']) && $_POST['visitor_identity_no'] == '' && $_POST['visitor_employee_card'] == "" && $_POST['visitor_driving_license'] == "" && $_POST['visitor_passport_id'] == "") {
                    $message .= "Visitor Identity cannot be blank <br>";
                }
                if (isset($_POST['visitor_name']) && $_POST['visitor_name'] == '') {
                    $message .= "Visitor name cannot be blank <br>";
                }
                if (isset($_POST['visitor_cell_no']) && $_POST['visitor_cell_no'] == '') {
                    $message .= "Visitor cell no cannot be blank <br>";
                }
                if (isset($_POST['visitor_city']) && $_POST['visitor_city'] == '') {
                    $message .= "Visitor city cannot be blank <br>";
                }
                if (isset($_POST['tenant_id']) && $_POST['tenant_id'] == '') {
                    $message .= "Visitor tenant cannot be blank <br>";
                }
                if (isset($_POST['employee_id']) && $_POST['employee_id'] == '') {
                    $message .= "Please select tenant employee <br>";
                }
                // $issue_card_required=(isset($session_data['login_user_issue_card']))?$session_data['login_user_issue_card']:0;
                // if($issue_card_required==1) {
                //     if($_POST['visit_status']!="CHECK_OUT") {
                //         if (isset($_POST['visit_issued_card']) && $_POST['visit_issued_card'] == '') {
                //             $message .= "Visit issued card cannot be blank <br>";
                //         }
                //     }
                //     //issue card filed is required so check card already issued or not???
                //     $is_issued=$this->visit_model->find_visit_with_issue_card($_POST['visit_issued_card']);
                //     if($_POST['visit_status']!="CHECK_OUT") {
                //         if ($is_issued > 0) {
                //             $card = $_POST['visit_issued_card'];
                //             $message .= "Visit card $card already issued <br>";
                //         }
                //     }
                //     unset($_POST['visit_status']);

                // }

                $visitor_type = trim($this->input->post('visitor_type'));
                if ($visitor_type == "visitor_identity_no") {
                    $cnic = trim($this->input->post('visitor_identity_no'));
                    if (strlen($cnic) < 15 || strlen($cnic) > 15) {
                        $message .= "Enter a valid CNIC  <br>";
                    }
                }


                if ($message != '') {

                    $this->session->set_flashdata('message', array('message' => "$message", 'type' => 'error'));
                    $this->session->set_flashdata('post', $_POST);

                    if ($this->uri->segment(3) != '') {
                        $private_id = $this->uri->segment(3);
                    } else {
                        $private_id = 0;
                    }
                    redirect(base_url() . 'visitor/addvisitor/' . $private_id);

                }


                $visitor_info = $this->visitor_model->get_visitor($cnic, $visitor_type);
                //print_r($visitor_info);
                // exit;

                $im = $this->input->post('visitor_picture');
                $imgName = '';

                if (strpos($im, "no_image.png") == false) {
                    echo "in";
                    $data = str_replace('data:image/png;base64,', '', $im);
                    $data = str_replace('[removed]', '', $data);
                    $data = trim($data);
                    $data = base64_decode($data);
                    $im = @imagecreatefromstring($data);
                    //echo "<pre>";
                    //print_r($im);die;
                    if ($im !== false) {
                        $imgnae = $cnic;
                        header('Content-Type: image/png');
                        $path = './assets/data/visitor_profile/';
                        imagepng($im, $path . 'visitor_' . $imgnae . ".png");

                        $imgName = base_url() . 'assets/data/visitor_profile/visitor_' . $imgnae . ".png";
                        //$images_array[] = $imgName;
                    } else {
                        echo 'Image upload error. zahid ';
                    }
                }
//                die("dddd");

//                if($imgName=='' && strpos("no_image.png",$im)==true){
//                    $imgName = base_url() . 'assets/data/visitor_profile/no_image.png';
//                }
//                echo $imgName;die;

                if (!$visitor_info) {
//                    $visitor_type=trim($this->input->post('visitor_type'));
                    $foreign_no = $this->input->post('foreign_no');
                    if (isset($foreign_no) && $foreign_no == 1) {
                        $cell_no = $this->input->post('visitor_cell_no');
                    } else {
                        $cell_no = $this->input->post('visitor_cell_no');
                        if ($cell_no != '') {
                            $cell_no = ltrim($cell_no, "0");
                            $cell_no = "+92" . $cell_no;
                        }
                    }
                    $add_visitor = array(
                        'visitor_name' => trim($this->input->post('visitor_name')),
                        "$visitor_type" => trim($this->input->post('visitor_identity_no')),
                        'visitor_address' => trim($this->input->post('visitor_address')),
                        'visitor_cell_no' => $cell_no,
                        'visitor_city' => trim($this->input->post('visitor_city')),
                        'visitor_picture' => $imgName,
                    );
//                    echo "<pre>";
//                    print_r($add_visitor);die;
                    $this->db->insert('visitor_profile', $add_visitor);
                    $visitor_id_fk = $this->db->insert_id();
                    $this->log_model->create_log("ADD VISITOR", $add_visitor, $visitor_id_fk);
                    if ($this->uri->segment(3) != "") {
                        $private_id = $this->uri->segment(3);
                        //get private visit id...

                        //get this visit mobile number to send message...
                        $joins[] = "private_visits pv";
                        $joins[] = "private_members pm";

                        $joins_on = array(
                            "pv.user_id=te.user_id",
                            "pm.private_visit_id=pv.id",

                        );
                        $private_member_result = $this->common_model->find("tenant_employees te", "te.mobile_no,pm.name,pm.private_visit_id", true, array('pm.id' => $private_id), $joins, $joins_on);
                        $private_id = $private_member_result['private_visit_id'];
                        //echo $this->db->last_query();die;
                        if (!empty($private_member_result)) {
                            $mobile_no = $private_member_result['mobile_no'];
                            $private_member_name = $private_member_result['name'];
                            //send meesage...
                            $sms_message = "VMS <br>Your visitor $private_member_name checked in successfully !!!";
                            send_sms($mobile_no, $sms_message);
                        }

                    } else {
                        $private_id = 0;
                    }

                    $add_visit = array(
                        'private_visit_id' => $private_id,
                        'visit_visitor_id_fk' => $visitor_id_fk,
                        'visit_reason' => trim($this->input->post('visit_reason')),
                        'visit_checkin' => ($this->input->post('visit_checkin') == "") ? date("Y-m-d H:i:s") : trim($this->input->post('visit_checkin')),
                        'visit_checkout' => ($this->input->post('visit_checkout') == "") ? null : trim($this->input->post('visit_checkout')),
                        'visit_transport_mode' => trim($this->input->post('visit_transport_mode')),
                        'visit_transport_registration_no' => trim($this->input->post('visit_transport_registration_no')),
                        'tenant_id' => trim($this->input->post('tenant_id')),
                        'employee_id' => trim($this->input->post('employee_id')),
                        'visit_issued_card' => trim($this->input->post('visit_issued_card')),
                        'visit_from_company' => trim($this->input->post('visit_from_company')),
                        'location_id' => $session_data['login_user_location'],
                        'identity_type' => $visitor_type,
//                        'next_location_id' => $this->input->post('next_location_id'),
                    );
                    $this->db->insert('visit', $add_visit);
                    $visit_id = $this->db->insert_id();
                    $this->log_model->create_log("ADD VISIT", $add_visit, $visit_id);
                    if ($private_id != 0) {

                        //mark private visit as visited....
                        $this->db->where('id', $private_id);
                        $this->db->update('private_visits', array('status' => 'VISITED'));

                    }
                    //insert into track table...
                    $add_track = array(
                        "visit_id_fk" => $visit_id,
                        "user_id" => $session_data['login_user_id'],
                        "location_id" => $session_data['login_user_location'],
                        "location_title" => $session_data['login_user_location_title'],
                        "action" => "CHECK_IN"

                    );
                    $this->db->insert('visit_track', $add_track);
                    $track_id = $this->db->insert_id();
                    $this->log_model->create_log("ADD VISIT TRACK", $add_track, $track_id);
                    if ($message == '') {
                        if ($action == "CHECK_OUT") {
                            $this->session->set_flashdata('message', array('message' => "Visit checkout done successfully !!!", 'type' => 'success'));
                        } else {
                            $this->session->set_flashdata('message', array('message' => "Visit created successfully !!!", 'type' => 'success'));
                        }


                    }
                    redirect(base_url() . 'visitor/addvisitor');
                } else {

                    if ($imgName == '') {
                        $imgName = $visitor_info['visitor_picture'];
                    }

                    //checking other identifications...
                    $other_identity = '';
                    if ($this->input->post('visitor_employee_card') != "") {
                        $other_identity = "visitor_employee_card";
                    } elseif ($this->input->post('visitor_driving_license') != "") {
                        $other_identity = "visitor_driving_license";
                    } elseif ($this->input->post('visitor_passport_id') != "") {
                        $other_identity = "visitor_passport_id";
                    }

                    if ($other_identity != '') {
                        //update visitor profile...
                        $update_visitor = array(
                            "$other_identity" => trim($this->input->post("$other_identity")),
                        );
                        $this->db->where('visitor_id', $visitor_info['visitor_id']);
                        $this->db->update('visitor_profile', $update_visitor);
                    }

                    $edit_visitor = array(
                        'visitor_name' => trim($this->input->post('visitor_name')),
                        'visitor_identity_no' => trim($this->input->post('visitor_identity_no')),
                        'visitor_address' => trim($this->input->post('visitor_address')),
                        'visitor_cell_no' => trim($this->input->post('visitor_cell_no')),
                        'visitor_city' => trim($this->input->post('visitor_city')),
                        'visitor_picture' => $imgName,
                    );
                    $this->db->where('visitor_id', $visitor_info['visitor_id']);
                    $this->db->update('visitor_profile', $edit_visitor);
//                    if($imgName == ''){
                    if ($this->uri->segment(3) != "") {
                        $private_member_id = $this->uri->segment(3);
                        //get this visit mobile number to send message...
                        $joins[] = "private_visits pv";
                        $joins[] = "private_members pm";

                        $joins_on = array(
                            "pv.user_id=te.user_id",
                            "pm.private_visit_id=pv.id",

                        );
                        $private_member_result = $this->common_model->find("tenant_employees te", "te.mobile_no,pm.name,pm.private_visit_id", true, array('pm.id' => $private_member_id), $joins, $joins_on);
                        $private_id = $private_member_result['private_visit_id'];
                        $joins = array();
                        $joins_on = array();
                    } else {
                        $private_id = 0;
                    }

                    $add_visit = array(
                        'private_visit_id' => $private_id,
                        'visit_visitor_id_fk' => $visitor_info['visitor_id'],
                        'visit_reason' => trim($this->input->post('visit_reason')),
                        'visit_checkin' => ($this->input->post('visit_checkin') == "") ? date("Y-m-d H:i:s") : trim($this->input->post('visit_checkin')),
                        'visit_checkout' => ($this->input->post('visit_checkout') == "") ? null : trim($this->input->post('visit_checkout')),
                        'visit_transport_mode' => trim($this->input->post('visit_transport_mode')),
                        'visit_transport_registration_no' => trim($this->input->post('visit_transport_registration_no')),
                        'tenant_id' => trim($this->input->post('tenant_id')),
                        'employee_id' => trim($this->input->post('employee_id')),
                        'visit_issued_card' => trim($this->input->post('visit_issued_card')),
                        'visit_from_company' => trim($this->input->post('visit_from_company')),
                        'location_id' => $session_data['login_user_location'],
//                        'next_location_id' => trim($this->input->post('next_location_id')),
                    );
                    if ($private_id != 0) {

                        //mark private visit as visited....
                        $this->db->where('id', $private_id);
                        $this->db->update('private_visits', array('status' => 'VISITED'));

                    }
                    //get last visit info of this visit....
                    $last_visit_id = $this->input->post('visit_id');
                    if (isset($last_visit_id) && $last_visit_id != '') {
                        /*
                         * get this visit location and compare it with current user location
                            if both locations are same mean user is goona check out and we will update this visit
                            else we will create a new visit
                        */
//                        $last_visit_result=$this->visit_model->get_visit_by_id($last_visit_id);
                        //get visit info from visit track...
                        $last_visit_track_result = $this->visit_model->get_visit_track_by_id($last_visit_id);
                        $last_visit_track_action = $last_visit_track_result['action'];
                        //get visit location info
                        $visit_info = $this->visit_model->get_visit_by_id($last_visit_id);
                        if ($visit_info['location_id'] == $last_visit_track_result['location_id'] && $visit_info['location_id'] == $session_data['login_user_location']) {
                            if ($last_visit_track_action == "CHECK_OUT") {
                                $action = "CHECK_IN";
                            } else {
                                $action = "CHECK_OUT";
                            }
//                        if($last_visit_result['location_id']==$session_data['login_user_location']){
                            //location is same mean user will checkout and we will update the visit.
                            $visit_check_out = array(
                                'visit_checkout' => ($this->input->post('visit_checkout') != '') ? trim($this->input->post('visit_checkout')) : date("Y-m-d H:i:s"),
                            );
                            $this->db->where('visit_id', $last_visit_id);
                            $this->db->update('visit', $visit_check_out);
                            $add_track = array(
                                "visit_id_fk" => $last_visit_id,
                                "user_id" => $session_data['login_user_id'],
                                "location_id" => $session_data['login_user_location'],
                                "location_title" => $session_data['login_user_location_title'],
                                "action" => "$action"

                            );
                            $this->db->insert('visit_track', $add_track);
                            $track_id = $this->db->insert_id();
                            //create log
                            $this->log_model->create_log("ADD VISIT TRACK", $add_track, $track_id);

                        } else {
                            //location is not same so new visit will be created...
//                            $this->db->insert('visit', $add_visit);
//                            $visit_id=$this->db->insert_id();
                            //insert in visit_trak table...
                            if ($last_visit_track_result['location_id'] == $session_data['login_user_location']) {
                                if ($last_visit_track_result['action'] == "CHECK_OUT") {
                                    $action = "CHECK_IN";
                                } else {
                                    $action = "CHECK_OUT";
                                }
                            } else {
                                if ($visit_info['location_id'] == $session_data['login_user_location']) {
                                    $action = "CHECK_OUT";
                                    $visit_check_out = array(
                                        'visit_checkout' => ($this->input->post('visit_checkout') != '') ? trim($this->input->post('visit_checkout')) : date("Y-m-d H:i:s"),
                                    );
                                    $this->db->where('visit_id', $last_visit_id);
                                    $this->db->update('visit', $visit_check_out);
                                } else {
                                    $action = "CHECK_IN";
                                }
                            }


                            $add_track = array(
//                                "visit_id_fk" => $visit_id,
                                "visit_id_fk" => $last_visit_id,
                                "user_id" => $session_data['login_user_id'],
                                "location_id" => $session_data['login_user_location'],
                                "location_title" => $session_data['login_user_location_title'],
                                "action" => "$action"

                            );
                            $this->db->insert('visit_track', $add_track);
                            $track_id = $this->db->insert_id();
                            //create log
                            $this->log_model->create_log("ADD VISIT TRACK", $add_track, $track_id);

                        }


                    } else {
                        if ($this->uri->segment(3) != "") {
                            $private_id = $this->uri->segment(3);
                            //get this visit mobile number to send message...
                            $joins[] = "private_visits pv";
                            $joins[] = "private_members pm";

                            $joins_on = array(
                                "pv.user_id=te.user_id",
                                "pm.private_visit_id=pv.id",

                            );
                            $private_member_result = $this->common_model->find("tenant_employees te", "te.mobile_no,pm.name,pm.private_visit_id", true, array('pm.id' => $private_id), $joins, $joins_on);
                            //echo $this->db->last_query();die;
                            if (!empty($private_member_result)) {
                                $private_id = $private_member_result['private_visit_id'];
                                $mobile_no = $private_member_result['mobile_no'];
                                $private_member_name = $private_member_result['name'];
                                //send meesage...
                                $sms_message = "VMS <br>Your visitor $private_member_name checked in successfully !!!";
                                send_sms($mobile_no, $sms_message);
                            }
                        } else {
                            $private_id = 0;
                        }
                        if ($private_id != 0) {

                            //mark private visit as visited....
                            $this->db->where('id', $private_id);
                            $this->db->update('private_visits', array('status' => 'VISITED'));

                        }
                        //controll will come here if visitor comes here second time...
                        $add_visit = array(
                            'private_visit_id' => $private_id,
                            'visit_visitor_id_fk' => $visitor_info['visitor_id'],
                            'visit_reason' => trim($this->input->post('visit_reason')),
                            'visit_checkin' => ($this->input->post('visit_checkin') == "") ? date("Y-m-d H:i:s") : trim($this->input->post('visit_checkin')),
                            'visit_checkout' => ($this->input->post('visit_checkout') == "") ? null : trim($this->input->post('visit_checkout')),
                            'visit_transport_mode' => trim($this->input->post('visit_transport_mode')),
                            'visit_transport_registration_no' => trim($this->input->post('visit_transport_registration_no')),
                            'tenant_id' => trim($this->input->post('tenant_id')),
                            'employee_id' => trim($this->input->post('employee_id')),
                            'visit_issued_card' => trim($this->input->post('visit_issued_card')),
                            'visit_from_company' => trim($this->input->post('visit_from_company')),
                            'location_id' => $session_data['login_user_location'],
                            'identity_type' => $visitor_type,
//                            'next_location_id' => $this->input->post('next_location_id'),
                        );

                        $this->db->insert('visit', $add_visit);
                        $visit_id = $this->db->insert_id();
                        //create log
                        $this->log_model->create_log("ADD VISIT", $add_visit, $visit_id);
                        //insert into track table...
                        $action = "CHECK_IN";
                        $add_track = array(
                            "visit_id_fk" => $visit_id,
                            "user_id" => $session_data['login_user_id'],
                            "location_id" => $session_data['login_user_location'],
                            "location_title" => $session_data['login_user_location_title'],
                            "action" => "$action"

                        );
                        $this->db->insert('visit_track', $add_track);
                        $track_id = $this->db->insert_id();
                        //create log
                        $this->log_model->create_log("ADD VISIT TRACK", $add_track, $track_id);

                    }
//                    $this->db->insert('visit', $add_visit);
//                }
                    if ($message == '') {
                        if ($action == "CHECK_OUT") {
                            $this->session->set_flashdata('message', array('message' => "Visit checkout done successfully !!!", 'type' => 'success'));
                        } else {
                            $this->session->set_flashdata('message', array('message' => "Visit created successfully !!!", 'type' => 'success'));
                        }


                    }
                    redirect(base_url() . 'visitor/addvisitor');
                }
            }
            $locations = $this->location_model->get_all_locations();
            $cities = $this->location_model->get_all_cities();
            $tenants = $this->tenant_model->get_all_tenants();
            $issue_card_required = (isset($session_data['login_user_issue_card'])) ? $session_data['login_user_issue_card'] : 0;
            $data = array();
            if ($id != '') 
            {
                //get this member details and populate the form...
                $joins[] = "private_members pm";
                $joins[] = "tenant_employees te";
                $joins_on = array(
                    "private_visits.id=pm.private_visit_id",
                    "private_visits.user_id=te.user_id",
                );

                $member_info = $this->common_model->find("private_visits", "private_visits.tenant_id,private_visits.agenda,private_visits.employee_id as emp_id,pm.*,te.employee_name,te.id as system_employee_id", true, array('pm.id' => $id), $joins, $joins_on);

                if($member_info && !empty($member_info))
                {
                    $cnic = $member_info['cnic'];
                    //check this member already exist in our system or not???
                    $visitor_profile = $this->common_model->find("visitor_profile", "*", true, array('visitor_identity_no' => $cnic));

                    if (!empty($visitor_profile)) {
                        $member_info['already_member'] = 1;
                    } else {
                        $member_info['already_member'] = 0;
                    }
                    //get tenant name...
                    if(isset($member_info['tenant_id']))
                    {
                         $tenant_result = $this->common_model->find("tenant", "*", true, array('id' => $member_info['tenant_id']));
                     }else{
                             $tenant_result = [];  
                          }
                   
                    $member_info['tenant_name'] = is_array($tenant_result) && !empty($tenant_result) ? $tenant_result['tenant_name'] : '';
                    $data['member_info']=$member_info;
                }

                
			}
            $data['locations']=$locations;
            $data['cities']=$cities;
            $data['tenants']=$tenants;
            $data['issue_card_required']=$issue_card_required;
			$data['private_visit_check'] = $private_visit_check;
            $data['page_title'] = 'Add New Visitor';
            $this->load->view('common/header', $data);
            $this->load->view('visitor/add_visitor',$data);
            $this->load->view('common/footer');
            
        
        
        }else{
            redirect(base_url());
        }
    }
    
    public function takepicture() {
        
        
        if ($this->session->userdata('logged_in')) {
            $data = array();
             //die('ahmar');
            //$data['page_title'] = 'Add New Visitor';
            //$this->load->view('common/header', $data);
            $this->load->view('visitor/take_picture');
            //$this->load->view('common/footer');
        }else{
            redirect(base_url());
        }
    }

    public function scanned() {
        $visit_id='';
        $visit_issued_card='';
        $visitor_status='';
        $visit_to_tenant='';
        $visit_to_employee='';
        $visitor_type = $this->input->post('visitor_type');
        $cnic = $this->input->post('cnic');

        $session_data = $this->session->userdata('logged_in');
        $visitor_info = $this->visitor_model->get_visitor($cnic,$visitor_type);
        if(!$visitor_info){
            $response_array=array(
                'status'=>2
            );
            echo json_encode($response_array);exit;
            $family_no = $this->input->post('family_no');
            $cnic_status = $this->input->post('cnic_status');
            $name="";
            $father_name="";
            $address="";
            $visitor_identity_no = $cnic;
            $visit_reason = '';
            $visit_transport_registration_no = '';
            $visit_transport_mode = 'Car';
            $visit_from_company = '';
            $visitor_cell_no = '';
            $visitor_city = '';
            $visitor_employee_card = '';
            $visitor_driving_license = '';
            $visitor_passport_id = '';
            $visitor_picture = base_url() . "assets/data/visitor_profile/no_image.png";
        }else{
            $cnic_status = '';
            $visit_info = $this->visit_model->get_visit($visitor_info['visitor_id']);
            $visit_info_to_load = $this->visit_model->get_last_visit($visitor_info['visitor_id']);
            $visit_location_id=$visit_info['location_id'];
            $last_visit_id=$visit_info['visit_id'];
            $visitor_status='';
            $last_visit_track_result=$this->visit_model->get_visit_track_by_id($last_visit_id);
            $last_visit_track_location_id=$last_visit_track_result['location_id'];
            $last_visit_track_action=$last_visit_track_result['action'];

//            if($visit_location_id==$session_data['login_user_location']){
            if($last_visit_track_location_id==$session_data['login_user_location'] && $last_visit_track_action=="CHECK_IN"){
                $visitor_status="CHECK_OUT";
            }else{
                if($visit_info['location_id']==$session_data['login_user_location']){
                    $visitor_status="CHECK_OUT";
                }else {
                    $visitor_status = "CHECK_IN";
                }
            }

            $visitor_identity_no = $visitor_info[$visitor_type];
            if($visitor_info['visitor_picture']==''){
                $visitor_picture = base_url() . "assets/data/visitor_profile/no_image.png";
            }else{
                $visitor_picture = $visitor_info['visitor_picture'];
            }



            $visit_id=$visit_info['visit_id'];
            $visit_from_company=$visit_info_to_load['visit_from_company'];
            $visit_reason=$visit_info_to_load['visit_reason'];
            $visit_issued_card=$visit_info_to_load['visit_issued_card'];
            $name = $visitor_info['visitor_name'];
            $visit_to_tenant = $visit_info_to_load['visit_to_tenant'];
            $visit_to_employee = $visit_info_to_load['visit_to_employee'];
            $visitor_city = $visitor_info['visitor_city'];
            $visitor_employee_card = $visitor_info['visitor_employee_card'];
            $visitor_driving_license = $visitor_info['visitor_driving_license'];
            $visitor_passport_id = $visitor_info['visitor_passport_id'];
            $father_name = $visitor_info['visitor_father_name'];
            $address = $visitor_info['visitor_address'];
            $visitor_cell_no = $visitor_info['visitor_cell_no'];
            $visit_transport_registration_no = $visit_info_to_load['visit_transport_registration_no'];
            $visit_transport_mode = $visit_info_to_load['visit_transport_mode'];

        }

        $jsone_array = array(
            'visit_id' => $visit_id,
            'visit_from_company' => $visit_from_company,
            'visit_reason' => $visit_reason,
            'visit_issued_card' => $visit_issued_card,
            'visitor_identity_no' => $visitor_identity_no,
            'visitor_name' => $name,
            'visit_to_tenant' => $visit_to_tenant,
            'visit_to_employee' => $visit_to_employee,
            'visitor_city' => $visitor_city,

            'visitor_employee_card' => $visitor_employee_card,
            'visitor_driving_license' => $visitor_driving_license,
            'visitor_passport_id' => $visitor_passport_id,
            'visitor_father_name' => $father_name,
            'visitor_address' => $address,
            'visitor_cell_no' => $visitor_cell_no,
            'visitor_picture' => $visitor_picture,
            'visit_transport_registration_no' => $visit_transport_registration_no,
            'visit_transport_mode' => $visit_transport_mode,
//            'visit_from_company' => $cnic_status,
            'visitor_status' => $visitor_status

        );

        echo json_encode($jsone_array);
        exit;
    }


    function get_visitor_full_track($visitor_id){
        $data=array();
        if ($this->session->userdata('logged_in')) {
            $data['page_title'] = 'Visitor Track';
            $full_track = $this->visitor_model->get_visitor_full_track($visitor_id);
            $data['track_info'] = $full_track;
            $data['visitor_id'] = $visitor_id;
            $this->load->view('common/header', $data);
            $this->load->view('visitor/visitor_full_track');
            $this->load->view('common/footer');
        }else{
            redirect(base_url());
        }
    }

    function get_ajax_full_visit_track($visitor_id){
        $track_info=$this->visitor_model->get_visitor_full_track($visitor_id,$_GET['iDisplayStart'],$_GET['iDisplayLength'],$_GET['sSearch_3']);
        $total_result=$this->visitor_model->get_visitor_full_track($visitor_id,$_GET['iDisplayStart'],$_GET['iDisplayLength'],$_GET['sSearch_3'],1);

        $total_visitors=count($total_result);
        $data2= array("sEcho" => $_GET['sEcho'],
            "iTotalRecords" => $total_visitors,
            "iTotalDisplayRecords" => $total_visitors,
        );

          $visit_number=$_GET['iDisplayStart']+1;
        if(!empty($track_info)) {
            foreach ($track_info as $key => $val) {
                $visit_id=$val['visit_id'];
                $location_arr = array_reverse(explode(",", $val['location_title']));
                $action_arr = array_reverse(explode(",", $val['action']));
                $date_arr = array_reverse(explode(",", $val['created_datetime']));
                $duration=$this->get_visit_duration($visit_id);
                $visit_reason=($val['visit_reason']!="")?$val['visit_reason']:"Not Set";
                $data2['aaData'][] = array(
                    'visitor_name' => "<p><b>Visit # " . $visit_number . "</b></p><p style='margin-bottom:0px'> $duration </p><p><b>Visit Reason :</b> ". $visit_reason."</p>",
                    'visitor_location' => "",
                    'action' => "",
                    'created_datetime' => "",
                );

                foreach ($location_arr as $key1 => $val1) {
                    $data2['aaData'][] = array(
                        'visitor_name' => $val['visitor_name'],
                        'visitor_location' => $val1,
                        'action' => str_replace("_", " ", $action_arr[$key1]),
                        'created_datetime' => $date_arr[$key1],

                    );
                }

                $visit_number++;

            }
        }else{
            echo json_encode(array(
                "sEcho" => 0,
                "iTotalRecords" => "0",
                "iTotalDisplayRecords" => "0",
                "aaData" => array()
            ));die;
        }
        echo json_encode($data2);
    }

    function get_visit_duration($visit_id){
        $track_info=$this->visit_model->get_visit_track($visit_id);
        $count=count($track_info);
        $start_date=$track_info[0]['created_datetime'];
        $start_location_title=$track_info[0]['location_title'];
        $start_action=$track_info[0]['action'];
        $end_date=$track_info[$count-1]['created_datetime'];
        $end_location_title=$track_info[$count-1]['location_title'];
        $end_action=$track_info[$count-1]['action'];
        if($count-1==0){
            date_default_timezone_set('Asia/Karachi');
            $end_date=date("Y-m-d H:i:s",time());
            $visit_status="<font color='orange'>IN PROGRESS</font>";
        }else{
            if($start_action=="CHECK_IN" && $end_action=="CHECK_OUT" && $start_location_title==$end_location_title){
                $visit_status="<font color='green'>COMPLETED</font>";
            }else{
                $visit_status="<font color='orange'>IN PROGRESS</font>";
            }
        }
        $date1 = $end_date;
        $date2 = $start_date;
        $diff = strtotime($date1) - strtotime($date2);
        $diff_in_hrs = $diff/3600;
        if($diff_in_hrs<1){
            return "<b>Visit Duration : </b> <font color='orange'> ".round(abs($diff) / 60,2). " Minutes</font>
                            | <b>Visit Status:</b> $visit_status";
        }else {
            return "<b>Visit Duration : </b> <font color='orange'>".round(abs($diff) / 3600,2). " Hours</font>
                            | <b>Visit Status:</b> $visit_status";
        }


    }


    function verify_black_listed($cnic)
    {
        $query = "SELECT * FROM black_listed WHERE visitor_cnic = '".$cnic."'";

        $execution = $this->db->query($query);

        if($execution->num_rows()>0)
        {
            return true;
        }else{
                return false;
             }
    }

}
