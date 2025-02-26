<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
//        $this->load->model('user_model');
//        $this->load->model('location_model');
//    }

    public function index()
    {
        $this->load->library('recaptcha');

        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');

            if ($session_data['login_user_type'] == "SUPER") {
                redirect(base_url() . 'visitor');
            } elseif ($session_data['login_user_type'] == "TENANT") {
                redirect(base_url() . 'visitor/addvisitor');
            } elseif ($session_data['login_user_type'] == "VIEW_ONLY" || $session_data['login_user_type'] == "NORMAL") {
                redirect(base_url() . 'visit/visits');
            } else {
                redirect(base_url() . 'visitor/addvisitor');
            }
        }

        if (!empty($_POST)) {
            $email = $this->input->post('email', true);
            $password = $this->input->post('password', true);
            $result = $this->user_model->login($email, $password);
            $message = array();
            $tenant = 0;

            if ($result) {
                foreach ($result as $row) {
                    if ($row->is_deleted == 1) {
                        $message['status'] = 'Your account has been deleted by admin.';
                    } else {
                        // sess_expiration for others: 5 min, view-only users: 30 days
                        $this->session->sess_expiration = ($row->type == 'VIEW_ONLY') ? 2592000 : 300;
                        $message['status'] = 'success';
                    }
                }
            } else {
                //check user is a tenant user or not??
                // $tenant_result=$this->tenant_login($email,$password);
                // //echo "<pre>";
                // //print_r($tenant_result);die;
                // if($tenant_result){
                //     $message['status']='success';
                // 	$tenant=1;
                //     redirect(base_url().'visitor/private_visits');
                // }else{
                $message['status'] = 'Invalid Email or Password';
//                 }
            }

            //$recaptcha = $this->input->post('g-recaptcha-response');
            //$response = $this->recaptcha->verifyResponse($recaptcha);

            //if (isset($response['success']) and $response['success'] === true) {
            //echo "You got it!";die;
            //}else{
            //$message['status']="invalid captcha";
            //}
            if ($message['status'] == "success") {
                $message['type'] = $result[0]->type;

                //set session values...
                $sess_array = array(
                    'login_user_id' => $result[0]->id,
                    'login_user_fullname' => $result[0]->first_name . ' ' . $result[0]->last_name,
                    'login_user_image' => $result[0]->image_file,
                    'login_username' => $result[0]->username,
                    'login_user_email' => $result[0]->email,
                    'login_user_type' => $result[0]->type,
                    'login_user_location' => 1,
                    'login_user_location_title' => "Main Reception",
                    'login_user_issue_card' => 1,
                    //For tenant user
                    'login_employee_id' => $result[0]->employee_id,
                    'login_tenant_id' => $result[0]->tenant_id,
                    'login_branch_id' => $result[0]->branch_id,
                );

                $this->session->set_userdata('logged_in', $sess_array);

                if ($result[0]->type == "BARRIER") { die('user controller line 109');
                    redirect(base_url() . 'visitor/private_visits');
                }

                redirect(base_url());
            } else {
                $this->session->set_flashdata('message', $message['status']);
                redirect(base_url());
            }
        }

        $locations = $this->location_model->get_all_locations();
        $data = array();
        $data['locations'] = $locations;
        $this->load->view('user/login', $data);
    }

    function verifyOtp()
    {
        $data = array();
        if (!empty($_POST)) {
            $otp_code = $this->input->post('otp_code');
            $session_data = $this->session->userdata('logged_in');
            $user_id = $session_data['login_user_id'];
            $code_result = $this->common_model->find("tenant_employees", 'otp_code', 1, array('user_id' => $user_id));
            if (!empty($code_result)) {
                if ($code_result['otp_code'] == $otp_code) {
                    //update code verified...
                    $this->common_model->update('tenant_employees', array('otp_code' => '', 'otp_verified' => 1), array('user_id' => $user_id));
                    redirect(base_url() . 'visitor/private_visits');
                } else {
                    $this->session->set_flashdata('message', 'Invalid code');
                    redirect(base_url() . 'user/verifyOtp');
                }
            }
            //verify code...
        }

        $this->load->view('user/verify_otp', $data);
    }

    public function add_user()
    {
        if (sessiondata('login_user_type') == "VIEW_ONLY") {
            redirect(base_url() . 'visit/visits');
        }

        $session_data = $this->session->userdata('logged_in');

        if ($this->session->userdata('logged_in') && $session_data['login_user_type'] == "SUPER") {
            $session_data = $this->session->userdata('logged_in');

            if ($session_data['login_user_type'] == "TENANT") {
                redirect(base_url() . 'visitor/private_visits');
            }
//            echo "<pre>";
//            print_r($session_data['type']);die;
            if ($session_data['login_user_type'] != "SUPER") {
                redirect(base_url() . 'visitor/visitors');
            }


            if ($session_data['login_user_type'] == "VIEW_ONLY") {
                redirect(base_url() . 'visit/visits');
            }

            if (!empty($_POST)) {
                unset($_POST['submit']);
                $message = '';

                if (isset($_POST['first_name']) && $_POST['first_name'] == '') {
                    $message .= "First name cannot be blank <br>";
                }
                if (isset($_POST['last_name']) && $_POST['last_name'] == '') {
                    $message .= "Last name cannot be blank <br>";
                }
                if (isset($_POST['email']) && $_POST['email'] == '') {
                    $message .= "Email cannot be blank <br>";
                }
                if (isset($_POST['password']) && $_POST['password'] == '') {
                    $message .= "Password cannot be blank <br>";
                } else {
                    $_POST['password'] = md5($_POST['password']);
                }

                //upload profile picture...
                if ($_FILES['image_file']['name'] != '') {
                    $image_name = $_FILES['image_file']['name'];
                    $name_arr = explode(".", $image_name);
                    $image_type = strtolower($name_arr[1]);
                    if ($image_type == "jpg" || $image_type == "jpeg" || $image_type == "png") {
                        $size = $_FILES['image_file']['size'] / 1048576;
                        if ($size <= 1.0) {
                            //upload file...
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

                }

                if ($message == '') {
                    //check username or email already exist or not???
                    $result = $this->user_model->email_already_exist($_POST['email']);

                    if ($result) {
                        //already exist...
                        $this->session->set_flashdata('message', array('message' => 'Email Already Taken !!!', 'type' => 'error'));
                    } else {
                        //save user...
                        $insert_id = $this->user_model->add_user($_POST);
                        if ($insert_id) {
                            $this->session->set_flashdata('message', array('message' => 'User Created Successfully !!!', 'type' => 'success'));
                            $this->log_model->create_log("ADD USER", $_POST, $insert_id);
                            redirect(base_url() . 'user/add_user');
                        }
                    }
                } else {
                    $this->session->set_flashdata('message', array('message' => "$message", 'type' => 'error'));
                }
            }

            $data = array();
            $data['page_title'] = 'Add New User';

            if (isset($_POST)) {
                $data['info'] = $_POST;
            }

            if ($session_data['login_user_type'] == "SUPER") {
                $this->load->view('common/header', $data);
                $this->load->view('user/add_user');
                $this->load->view('common/footer');
            } else if ($session_data['login_user_type'] == "VIEW_ONLY") {
                redirect(base_url() . 'visit/visits');
            } else {
                redirect(base_url() . 'visitor/addvisitor');
            }

        } else {
            redirect("visitor/visitors");
        }
    }

    public function edit_user($id)
    {
        if (sessiondata('login_user_type') == "VIEW_ONLY") {
            redirect(base_url() . 'visit/visits');
        }

        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');

            if ($session_data['login_user_type'] == "TENANT") {
                redirect(base_url() . 'visitor/private_visits');
            }

            if ($session_data['login_user_type'] == "VIEW_ONLY") {
                redirect(base_url() . 'visit/visits');
            }

            if (!empty($_POST)) {
                unset($_POST['submit']);
                $message = '';
                if (isset($_POST['first_name']) && $_POST['first_name'] == '') {
                    $message .= "First name cannot be blank <br>";
                }
                if (isset($_POST['last_name']) && $_POST['last_name'] == '') {
                    $message .= "Last name cannot be blank <br>";
                }
                if (isset($_POST['email']) && $_POST['email'] == '') {
                    $message .= "Email cannot be blank <br>";
                }
                if (isset($_POST['password']) && $_POST['password'] == '') {
                    unset($_POST['password']);
                } else {
//                    $_POST['password'] = md5($_POST['password']);
                }

                //upload profile picture...
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
                            //if edit user is current user update logo in session also...
//                            $this->session->set_userdata('logged_in', array('login_user_image'=>$file_name));
                            $_SESSION['logged_in']['login_user_image'] = $file_name;
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


                if ($message == '') {
                    //update user...
                    $result = $this->user_model->update_user($_POST, $id);
                    if ($result) {
                        $this->session->set_flashdata('message', array('message' => 'User Updated Successfully !!!', 'type' => 'success'));
                        $this->log_model->create_log("EDIT USER", $_POST, $id);
                        redirect(base_url() . 'user/edit_user/' . $id);
                    }

                } else {
                    $this->session->set_flashdata('message', array('message' => "$message", 'type' => 'error'));
                    redirect(base_url() . 'user/edit_user/' . $id);
                }

            }

            $data = array();
            $data['page_title'] = "Edit User";
            //get users details...
            $result = $this->user_model->get_user($id);
            $data['tenants'] = $this->tenant_model->get_all_tenants();
            $data['info'] = $result;
            $this->load->view('common/header', $data);
            $this->load->view('user/edit_user', $data);
            $this->load->view('common/footer');
        } else {
            redirect(base_url());
        }
    }

    public function delete_user($id)
    {
        if (sessiondata('login_user_type') == "VIEW_ONLY") {
            redirect(base_url() . 'visit/visits');
        }

        if ($this->session->userdata('logged_in')) {
            $data = array();
            $data['page_title'] = "Users";
            $result = $this->user_model->delete_user($id);
            $this->log_model->create_log("DELETE USER", "", $id);
            if ($result) {
                $this->session->set_flashdata('message', array('message' => "User deleted successfully !!!", 'type' => 'error'));
                redirect(base_url() . 'user/list_users');
            }


        } else {
            redirect(base_url());
        }
    }


    public function add_visitor()
    {
        if (sessiondata('login_user_type') == "VIEW_ONLY") {
            redirect(base_url() . 'visit/visits');
        }

        $data = array();
        $this->load->view('common/header', $data);
        $this->load->view('user/add_visitor');
        $this->load->view('common/footer');
    }

    public function tenant_login($user_name, $password)
    {
        $user_name = urlencode($user_name);
        $password = urlencode($password);
        //$user_name=$_POST['email'];
        //$password=$_POST['password'];
        $url = "https://astp.punjab.gov.pk/WebService/TenantEmployeeService.asmx/Get_Tenant_Login?Tenant_User_Name=$user_name&Tenant_Password=$password&Key=astp54000tenant";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        $return_data = curl_exec($ch);
        //echo $url;die;
        //echo "<pre>";
        //print_r(json_decode($return_data));die;
        if (curl_errno($ch)) {
            echo 'Request Error:' . curl_error($ch);
            die;
        }
        curl_close($ch);

        $xml = simplexml_load_string($return_data);
        $result = json_decode($xml[0], TRUE);
        //echo "<pre>";
        //print_r($result);die;
        if ($result[0]['Status'] == 1) {
            //echo "<pre>";
            //print_r($result);
            //die("dddd");
            $tenant_id = $result[0]['Tenant_ID'];
            $user_id = $result[0]['Employee_ID'];
            //get otp for this user
            $this->generateOTP($user_id);
            //get tenant info...
            $tenant_result = $this->tenant_model->get_tenant($tenant_id);
            $tenant_employee_result = $this->common_model->find("tenant_employees", "employee_name", 1, array('employee_id' => $result[0]['Employee_ID']));
            // echo "<pre>";
            // echo $this->db->last_query();
            // print_r($tenant_employee_result);die;
            $sess_array = array(
                'login_employee_id' => $result[0]['Employee_ID'],
                'login_user_id' => $result[0]['User_ID'],
                'login_tenant_id' => $result[0]['Tenant_ID'],
                'login_user_fullname' => $tenant_employee_result['employee_name'],
                'login_user_image' => '',
                'login_user_location_title' => '',
                'login_username' => $user_name,
                'login_user_type' => "TENANT",
            );
            $message['status'] = "success";
            $message['type'] = "TENANT";
            $this->session->set_userdata('logged_in', $sess_array);
            //find tenant info already saved or not???
            $tenant_info_result = $this->common_model->find("t_info", 'column1', 1, array('column1' => $user_name));
            if (!empty($tenant_info_result)) {
                //update tenant info...
                $this->common_model->update("t_info", array('column1' => $user_name, 'column2' => $password), array('column1' => $user_name));
            } else {
                //save tenant login info....
                $this->common_model->save("t_info", array('column1' => $user_name, 'column2' => $password));
            }
            //echo json_encode($message);
            return true;
        } else {
            //die("ddd");
            return false;
            //$message['status'] = 'Invalid Email or Password';
            //echo json_encode($message);
        }
    }

    function generateOTP($user_id)
    {
        //generate a random string for OTP...
        $otp_code = $this->generateRandomString(5);
        // $post_data=array(
        //     'sec_key'=>'451319be9caefc0904db10a735ab0708',
        //     'sms_text'=>"VMS OTP Code is $otp_code",
        //     'phone_no'=>'03454094853',
        //     'sms_language'=>'english'
        // );
        // $url="https://smsgateway.pitb.gov.pk/api/send_sms";
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL,$url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        // $return_data = curl_exec($ch);
        // if(curl_errno($ch)){
        //     echo 'Request Error:' . curl_error($ch);die;
        // }
        // curl_close ($ch);

        $this->common_model->update("tenant_employees", array('otp_code' => $otp_code, 'otp_verified' => 0), array('user_id' => $user_id));
        return true;
    }

    public function login()
    {
        $this->load->library('Recaptcha');

        $location_title = '';
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        $location = $this->input->post('location', true);

        $result = $this->user_model->login($email, $password);

        $message = array();

        if ($result) { //die('sani');
            foreach ($result as $row) {
                if ($row->is_deleted == 1) {
                    $message['status'] = 'Your account has been deleted by admin';
                } else {
//                    $this->session->sess_expiration = ($row->type == 'VIEW_ONLY') ? 2592000 : 300; // others: 5 min, view-only: 30 days
                    $message['status'] = 'success';
                }
            }
        } else {
            $message['status'] = 'Invalid Email or Password';
        }

        if ($result) {
            if ($result[0]->type != "SUPER") {
                if ($location == "") {
                    $message['status'] = 'Location is required';
                }
            }
        }

        if ($location != '') {
            $location_result = $this->location_model->get_location($location);
            $location_title = $location_result['location'];
            $issue_card = $location_result['issue_card'];
        } else {
            $issue_card = "";
        }

//        }else{
//            $message['status'] = 'Location is required';
//        }

        $recaptcha = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($recaptcha);

        if (isset($response['success']) and $response['success'] === true) {
            //echo "You got it!";die;
        } else {
            //$message['status']="invalid captcha";
        }

        echo "<pre>";
        print_r($message);
        echo "</pre>";
        die();

        if (isset($message['status']) && $message['status'] == "success") {
            $message['type'] = $result[0]->type;
//set session values...
            $sess_array = array(
                'login_user_id' => $result[0]->id,
                'login_user_fullname' => $result[0]->first_name . ' ' . $result[0]->last_name,
                'login_user_image' => $result[0]->image_file,
                'login_username' => $result[0]->username,
                'login_user_email' => $result[0]->email,
                'login_user_type' => $result[0]->type,
                'login_user_location' => $location,
                'login_user_location_title' => $location_title,
                'login_user_issue_card' => $issue_card,
                //For tenant user
                'login_employee_id' => $result[0]->id,
                'login_tenant_id' => $result[0]->id,
            );

            $this->session->set_userdata('logged_in', $sess_array);

            //echo "<pre>"; print_r($this->session->userdata('logged_in')); echo "</pre>"; 
            //die();
            echo json_encode($message);
        } else {
            echo json_encode($message);
        }

    }

    function logout()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            //array parameters : action, description, before, after, app_id, app_name, form_id, form_name
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('view_session');
            session_destroy();
        }
        $this->session->set_flashdata('validate', array('message' => 'You are successfully logged out.', 'type' => 'success'));
        redirect(base_url());
    }

    public function list_users()
    {
        if (sessiondata('login_user_type') == "VIEW_ONLY") {
            redirect(base_url() . 'visit/visits');
        }

        $session_data = $this->session->userdata('logged_in');
        if ($this->session->userdata('logged_in') && $session_data['login_user_type'] == "SUPER") {

            if ($session_data['login_user_type'] == "TENANT") {
                redirect(base_url() . 'visitor/private_visits');
            }
            $data = array();
            $data['page_title'] = 'Users';
//        $result=$this->user_model->get_all_users();
//        $data['users']=$result;
            $this->load->view('common/header', $data);
            $this->load->view('user/list_users', $data);
            $this->load->view('common/footer');
        } else {
            redirect("visitor/visitors");
        }
    }

    public function get_ajax_users()
    {
        if (sessiondata('login_user_type') == "VIEW_ONLY") {
            redirect(base_url() . 'visit/visits');
        }

        $result = $this->user_model->get_all_users($_GET['iDisplayStart'], $_GET['iDisplayLength'], $_GET['sSearch'], $_GET['iSortCol_0'], $_GET['sSortDir_0']);
        $total_result = $this->user_model->get_all_users(null, null, $_GET['sSearch'], $_GET['iSortCol_0'], $_GET['sSortDir_0']);
        $total_users = count($total_result);
        $data2 = array("sEcho" => $_GET['sEcho'],
            "iTotalRecords" => $total_users,
            "iTotalDisplayRecords" => $total_users,
        );
        foreach ($result as $key => $val) {
            $id = $val['id'];
            $type = $val['type'];
            $data2['aaData'][] = array(
                'first_name' => $val['first_name'],
                'last_name' => $val['last_name'],
                'email' => $val['email'],
                'status' => $val['status'],
                'type' => $val['type'],
                'created_datetime' => $val['created_datetime'],
                'action' => $this->create_action_button($id, $type),
//                'delete' => $this->create_delete_button($id,$type),

//                    'app_file' => $filename,
//                    'empty_form' => $empty_form,
//                    'form_id' => $form_id,
            );
        }

        if ($total_users == 0) {
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


    public function get_ajax_user_visit_details()
    {
        $result = $this->user_model->get_all_users_visit_details($_GET['iDisplayStart'], $_GET['iDisplayLength'], $_GET['sSearch'], $_GET['iSortCol_0'], $_GET['sSortDir_0'], $_GET['sSearch_2'], $_GET['sSearch_3'], $_GET['sSearch_4']);
        $total_result = $this->user_model->get_all_users_visit_details(null, null, $_GET['sSearch'], $_GET['iSortCol_0'], $_GET['sSortDir_0'], $_GET['sSearch_2'], $_GET['sSearch_3'], $_GET['sSearch_4']);
        //$total_users=count($total_result);
        $data2 = array("sEcho" => $_GET['sEcho'],
            "iTotalRecords" => $total_result,
            "iTotalDisplayRecords" => $total_result,
        );

        foreach ($result as $key => $val) {
            if ($val['identity_type'] == "visitor_identity_no") {
                $identity_no = $val['visitor_identity_no'];
                $identity_type = "CNIC";
            } elseif ($val['identity_type'] == "visitor_employee_card") {
                $identity_no = $val['visitor_employee_card'];
                $identity_type = "Employee Card";
            } elseif ($val['identity_type'] == "visitor_driving_license") {
                $identity_no = (isset($val['visitor_driving_license'])) ? $val['visitor_driving_license'] : '';
                $identity_type = "Driving License";
            } elseif ($val['identity_type'] == "visitor_passport_id") {
                $identity_no = (isset($val['visitor_passport_id'])) ? $val['visitor_passport_id'] : '';
                $identity_type = "Passport ID";
            } else {
                $identity_no = $val['visitor_identity_no'];
                $identity_type = "Not Set";
            }


            $data2['aaData'][] = array(
                'visitor_name' => $val['visitor_name'],
                'visitor_cell_no' => $val['visitor_cell_no'],
                'identity_type' => $identity_type,
                'visitor_identity_no' => $identity_no,
                'visit_reason' => $val['visit_reason'],
                'visit_transport_mode' => $val['visit_transport_mode'],
                'visit_transport_registration_no' => $val['visit_transport_registration_no'],
                'visit_to_tenant' => $val['visit_to_tenant'],
                'visit_to_employee' => $val['visit_to_employee'],
                'visit_issued_card' => $val['visit_issued_card'],
                'visit_from_company' => $val['visit_from_company'],
                'action' => str_replace("_", " ", $val['action']),
                'user_id' => $val['email'],
                'created_datetime' => $val['created_datetime'],
//                'delete' => $this->create_delete_button($id,$type),

//                    'app_file' => $filename,
//                    'empty_form' => $empty_form,
//                    'form_id' => $form_id,
            );
        }

        if ($total_result == 0) {
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

    public function create_action_button($id, $type)
    {

        $session_data = $this->session->userdata('logged_in');
        if ($session_data['login_user_id'] == $id && $type == "SUPER") {
            $edit_url = base_url() . "user/edit_user/$id";

            return "<a href='$edit_url'><i class='fa fa-pencil'></i></a>";
        } else if ($type == "SUPER") {
            return "";
        } else {
            $edit_url = base_url() . "user/edit_user/$id";
            $delete_url = base_url() . "user/delete_user/$id";
            return "<a href='$edit_url'><i class='fa fa-pencil'></i></a>
                    <a href='$delete_url' onclick='return confirm(\"Are you sure you want to delete this user?\");'>
                 <i class='fa fa-remove'></i>
                 </a>";
        }

    }

    public function create_delete_button($id, $type)
    {
        if ($type != "SUPER") {
            $url = base_url() . "user/delete_user/$id";
            return "<a href='$url' onclick='return confirm(\"Are you sure you want to delete this user?\");'>
                 <i class='fa fa-remove'></i>
                 </a>";
        }
        return;

    }


    public function create_user()
    {
        if (sessiondata('login_user_type') == "VIEW_ONLY") {
            redirect(base_url() . 'visit/visits');
        }

        $data = array();
        if (!empty($_POST)) {
            unset($_POST['submit']);
//check username or email already exist or not???

            $data['user'] = $_POST;
        }
        $data['page_title'] = 'Add User';
        $this->load->view('common/header', $data);
        $this->load->view('user/create_user');
        $this->load->view('common/footer');
    }

    function change_password()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $user_id = $session_data['login_user_id'];
            if (!empty($_POST)) {
                unset($_POST['submit']);
                $message = '';

                if (isset($_POST['old_password']) && $_POST['old_password'] == '') {
                    $message .= "Old password cannot be blank <br>";
                } else {
                    //verify password...
                    $old_result = $this->user_model->current_password_check(md5($_POST['old_password']), $user_id);
//                    echo $old_result;die;
                    if ($old_result == false) {
                        $message .= "Wrong password entered <br>";
                    }

                }
                if (isset($_POST['new_password']) && $_POST['new_password'] == '') {
                    $message .= "New password cannot be blank <br>";
                }
                if (isset($_POST['confirm_password']) && $_POST['confirm_password'] == '') {
                    $message .= "Confirm password cannot be blank <br>";
                }


                if ($message == '') {
                    if ($_POST['new_password'] != $_POST['confirm_password']) {
                        $message .= "New password and confirm password do not match <br>";
                        $this->session->set_flashdata('message', array('message' => "$message", 'type' => 'error'));
                        redirect(base_url() . 'user/change_password');
                    }
                    //update password...
                    $result = $this->user_model->change_password(md5($_POST['new_password']), $user_id);
                    if ($result) {
                        $this->session->set_flashdata('message', array('message' => 'Password Changed Successfully !!!', 'type' => 'success'));
                        redirect(base_url() . 'user/change_password');
                    }
                } else {
                    $this->session->set_flashdata('message', array('message' => "$message", 'type' => 'error'));
                }


            }
            $data = array();
            $data['page_title'] = "Change Password";
            $this->load->view('common/header', $data);
            $this->load->view('user/change_password', $data);
            $this->load->view('common/footer');

        } else {
            redirect(base_url());
        }


    }

    public function user_visit_details()
    {

        $session_data = $this->session->userdata('logged_in');
        if ($this->session->userdata('logged_in') && $session_data['login_user_type'] == "SUPER") {
            if ($session_data['login_user_type'] == "TENANT") {
                redirect(base_url() . 'visitor/private_visits');
            }
            $data = array();
            $data['page_title'] = 'User Visit Details';
//        $result=$this->user_model->get_all_users();
//        $data['users']=$result;
            $this->load->view('common/header', $data);
            $this->load->view('user/user_visit_details', $data);
            $this->load->view('common/footer');
        } else {
            redirect("visitor/visitors");
        }
    }

    function get_users_for_filter()
    {
        $result = $this->user_model->get_users_for_filter();
        echo $result;
    }

    public function import_tenant()
    {
        $session_data = $this->session->userdata('logged_in');
        if ($this->session->userdata('logged_in') && $session_data['login_user_type'] == "SUPER") {
            $data = array();
            $data['page_title'] = 'Import Tenant';

            if (isset($_POST["submit"])) {
                $file = $_FILES['file']['tmp_name'];
                $handle = fopen($file, "r");
                $c = 0;
                while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
                    if ($c > 0) {
                        $tenant_id = $filesop[0];
                        $tenant_name = $filesop[1];
                        $employee_name = $filesop[3];
                        $father_name = $filesop[4];
                        $designation = $filesop[5];
                        $mobile_no = $filesop[6];
                        $status = $filesop[7];
                        $import_data[] = array(
                            'tenant_id' => $tenant_id,
                            'tenant_name' => $tenant_name,
                            'employee_name' => $employee_name,
                            'father_name' => $father_name,
                            'designation' => $designation,
                            'mobile_no' => $mobile_no,
                            'status' => $status
                        );
                    }
                    $c = $c + 1;
                }
                $sql = $this->user_model->save_import_tenant($import_data);

                if ($sql) {
                    echo "You database has imported successfully. You have inserted " . $c . " recoreds";
                } else {
                    echo "Sorry! There is some problem.";
                }

            }


            $this->load->view('common/header', $data);
            $this->load->view('user/import_tenant', $data);
            $this->load->view('common/footer');
        } else {
            redirect("visitor/visitors");
        }
    }

    function generateRandomString($length = null)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

}
