<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PrivateVisits extends CI_Controller
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
//    public function __construct() {
//        parent::__construct();
//        $this->load->model('visitor_model');
//        $this->load->model('visit_model');
//        $this->load->model('location_model');
//    }


    public function get_ajax_private_visits()
    {
        $result = $this->visitor_model->get_all_private_visits($_GET['iDisplayStart'], $_GET['iDisplayLength'], $_GET['sSearch'], $_GET['iSortCol_0'], $_GET['sSortDir_0'], $_GET['sSearch_0'], $_GET['sSearch_1'], $_GET['sSearch_2'], $_GET['sSearch_5'], $_GET['sSearch_9']);
        $total_result = $this->visitor_model->get_all_private_visits(null, null, $_GET['sSearch'], $_GET['iSortCol_0'], $_GET['sSortDir_0'], $_GET['sSearch_0'], $_GET['sSearch_1'], $_GET['sSearch_2'], $_GET['sSearch_5'], $_GET['sSearch_9']);
        $total_visitors = count($total_result);
        $data2 = array("sEcho" => $_GET['sEcho'],
            "iTotalRecords" => $total_visitors,
            "iTotalDisplayRecords" => $total_visitors,
        );
        foreach ($result as $key => $val) {
            //$date=date("Y-m-d",$val['date']);
            //$date2=strtotime('2017-11-11');
            $id = $val['id'];
            $status = $val['status'];
            if ($status == "PENDING") {
                $color = "orange";
            } else {
                $color = "green";
            }

            $data2['aaData'][] = array(
                'name' => $val['name'],
                'cnic' => $val['cnic'],
                'mobile' => $val['mobile'],
                'date_time' => $val['date'] . ' ' . $val['time'],
                'transport' => $val['mode_transport'],
                'number_plate' => $val['number_plate'],
                'employee' => $this->getEmployeeName($val['employee_id']),
                'user' => $val['user_id'],
                'comment' => $val['comments'],
                'status' => "<p id='$val[id]'><span style='color:$color;cursor:pointer;' onclick='change_status($val[id],\"$status\")'>" . $val['status'] . "</span></p>",
            );
        }

        if ($total_visitors == 0) {
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

    function change_private_visit_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        if ($status == "PENDING") {
            $status = "VISITED";
        } else {
            $status = "PENDING";
        }
        $this->visitor_model->change_private_visit_status($id, $status);
        echo $status;


    }

    function getEmployeeName($id)
    {
        $this->db->select('employee_name');
        $this->db->from('tenant_employees');
        $this->db->where('employee_id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        if (!empty($result)) {
            return $result['employee_name'];
        } else {
            return "Not Found";
        }
    }


    public function create_action_button($id)
    {
        $session_data = $this->session->userdata('logged_in');
        $url = base_url() . "visitor/edit_visitor/$id";
        $url1 = base_url() . "visitor/get_visitor_full_track/$id";
        return "
            <a href='$url' title='Edit visitor info'><i class='fa fa-pencil'></i></a>

            ";
    }


    public function add_private_visit()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            if ($session_data['login_user_type'] == "SUPER") {
                redirect(base_url() . '/visitor/private_visits');
            }
            $tenant_id = $session_data['login_tenant_id'];
            $user_id = $session_data['login_user_id'];
            if (!empty($_POST)) {
                /*$_POST['tenant_id']=$tenant_id;
                $_POST['user_id']=$user_id;
                $data=$_POST;*/
                if (!empty($_SESSION['private_visit']['p_visit'])) {
                    $visit_data = $_SESSION['private_visit']['p_visit'];
                    //generate visit code...
                    $visit_code = $this->generateRandomNumber(8);
                    $visit_data['visit_code'] = $visit_code;
                    $visit_data['user_name'] = $session_data['login_username'];
                    //save private visit...
                    $visit_id = $this->common_model->save('private_visits', $visit_data);
                    foreach ($_SESSION['private_visit']['p_members'] as $key => $val) {
                        $_SESSION['private_visit']['p_members'][$key]['private_visit_id'] = $visit_id;
                    }
                } else {
                    $this->session->set_flashdata('message', array('message' => 'Please add one member atleast !!!', 'type' => 'error'));
                    redirect(base_url() . 'PrivateVisits/add_private_visit');
                }

                $p_members = $_SESSION['private_visit']['p_members'];
                $visit_members = array_filter($p_members, function ($item) {
                    return !empty($item['name']);
                });
                $this->common_model->save('private_members', $visit_members, 1);
                //add notification...
                $this->common_model->add_one('notifications', 'total', 1);
                unset($_SESSION['private_visit']);
                $this->session->set_flashdata('message', array('message' => 'Visit Created Successfully !!!', 'type' => 'success'));
                redirect(base_url() . 'visitor/private_visits');

            } else {
                unset($_SESSION['private_visit']);
                $data = array();
                //find tenant employees...
                $tenant_employees = $this->common_model->find('tenant_employees', "*", false, array('tenant_id' => $tenant_id));
                $data['tenant_employees'] = $tenant_employees;
                $data['page_title'] = 'Add Private Visit';
                $this->load->view('common/header', $data);
                $this->load->view('private_visits/add', $data);
                $this->load->view('common/footer');
            }
        } else {
            redirect(base_url());
        }
//        die("dddd");
    }

    function test_code()
    {
        echo $visit_code = $this->generateRandomNumber(8);
    }

    function generateRandomNumber($length = null)
    {
        $code = substr(str_shuffle(str_repeat($x = '0123456789', ceil($length / strlen($x)))), 1, $length);
        //check number exist in db or not??
        $code_result = $this->common_model->find('private_visits', "*", true, array('visit_code' => $code));
        if (!empty($code_result)) {
            $this->generateRandomNumber(8);
        }
        return $code;
    }

    function getTenantGatesArray()
    {
        $tenant = sessiondata('login_tenant_id');
        $query = $this->db->get_where('visit_gates', ['tenant_id' => $tenant]);
        //echo $this->db->last_query();
        $result = $query->result_array();
        if (sizeof($result)) {
            return array_column($result, 'name', 'id');
        }
        return [];
    }

    public function get_notifications()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $response = ['total' => 0];
            $result = $this->common_model->find("notifications", "*", true, array('id' => 1));
            if (is_array($result)) {
                $response['total'] = $result['total'];
            }
            $response['status'] = 'success';
            $response['user_type'] = $session_data['login_user_type'];
        } else {
            $response['status'] = 'logout';
        }
        echo json_encode($response);
    }

    public function add_members()
    {
        if ($this->session->userdata('logged_in')) {
            if (!empty($_POST)) {
                unset($_POST['csrf_test_name']);
                $data = $_POST;
                $session_data = $this->session->userdata('logged_in');
                $tenant_id = $session_data['login_tenant_id'];
                $user_id = $session_data['login_user_id'];
                $employee_id = $session_data['login_employee_id'];
                $private_visit = array(
                    //'title'=>$data['title'],
                    'agenda' => $data['agenda'],
                    'is_cargo' => (isset($data['is_cargo'])) ? $data['is_cargo'] : 0,
                    'employee_id' => $session_data['login_employee_id'],
                    'tenant_id' => $tenant_id,
                    'user_id' => $user_id,
                );
                $member_data = array(
                    'name' => $data['name'],
                    'cnic' => $data['cnic'],
                    'mobile' => $data['mobile'],
                    'mode_transport' => $data['mode_transport'],
                    'number_plate' => $data['number_plate'],
                    'date_from' => $data['date_from'],
                    'date_to' => $data['date_to'],
                    'time' => $data['time'],
                );
                $_SESSION['private_visit']['p_visit'] = $private_visit;
                $_SESSION['private_visit']['p_members'][$data['private_members_counter']] = $member_data;
                //save private visit...
                //$visit_id=$this->common_model->save('private_members',$data);
                //$message['id']=$visit_id;
                $message['status'] = 'success';
                $message['data'] = $member_data;
                echo json_encode($message);
            }
        } else {
            redirect(base_url());
        }
//        die("dddd");
    }

    public function remove_member()
    {
        $session_data = $this->session->userdata('private_visit');
        $id = $_POST['id'];
        unset($session_data['p_members'][$id]);
        $this->session->set_userdata('private_visit', $session_data);
        echo "deleted";

    }

    public function get_members()
    {
        $id = $_POST['id'];
        $members = $this->common_model->find('private_members', "*", false, array('private_visit_id' => $id));
        echo json_encode($members);
    }

    function import_csv()
    {
        $session_data = $this->session->userdata('logged_in');
        if ($this->session->userdata('logged_in') && $session_data['login_user_type'] != "VIEW_ONLY") {
            if (isset($_FILES["csv_data"])) {
                if (is_uploaded_file($_FILES['csv_data']['tmp_name'])) {
                    // Load CSV reader library
                    $this->load->library('CSVReader');
                    $rowCount = 1;
                    // Parse data from CSV file
                    $csvData = $this->csvreader->parse_csv($_FILES['csv_data']['tmp_name']);
                    // Insert/update CSV data into database
                    if (!empty($csvData)) {
                        $error_msg = '';
                        if ($this->input->post('agenda') == "") {
                            $error_msg = "Please Enter Visit Purpose<br>";
                        } else {
                            $visit_code = $this->generateRandomNumber(7);
                        }
                        $tenantGates = $this->getTenantGatesArray();
                        $gateNumbers = array_flip($tenantGates);
                        $response = true;
                        foreach ($csvData as $key => $row) {
                            if (!isset($row['name'])) {
                                $error_msg .= "In CSV Please Enter Name Column as 'name'<br>";
                            }
                            if (!isset($row['identity_value'])) {

                                $error_msg .= "In CSV Please Enter Cnic/Emp Code/Driving Licence/Passport ID Column as 'identity_value'<br>";
                            }
                            if (!isset($row['mobile'])) {
                                $error_msg .= "In CSV Please Enter Mobile Column as 'mobile'<br>";
                            }
                            if (!isset($row['date_from'])) {
                                $error_msg .= "In CSV Please Enter Date From Column as 'date_from'<br>";
                            }
                            if (!isset($row['date_to'])) {
                                $error_msg .= "In CSV Please Enter Date To Column as 'date_to'<br>";
                            }
                            if (!isset($row['time'])) {
                                $error_msg .= "In CSV Please Enter Time Column as 'time'<br>";
                            }

                            if (!isset($row['from_company'])) {
                                $error_msg .= "In CSV Please Enter From Company Column as 'from_company'<br>";
                            }

                            if ($error_msg != '') {
                                $this->session->set_flashdata('error_msg', $error_msg);
                                redirect(base_url() . 'PrivateVisits/import_csv');
                            }

                            $this->db->trans_start(); // Begin Transaction

                            $visitor_query = $this->db->get_where('visitor_profile', ['visitor_'.$row['identity_type'] => trim($row['identity_value'])]);
                            if ($visitor_query->num_rows() === 0) {
                                $add_visitor = array(
                                    'visitor_name' => trim($row['name']),
                                    'visitor_'.$row['identity_type'] => trim($row['identity_value']),
                                    'visitor_address' => trim($row['address']),
                                    'visitor_cell_no' => trim($row['mobile']),
                                    'visitor_city' => trim($row['city']),
                                    'visitor_picture' => ''
                                );
                                $this->db->insert('visitor_profile', $add_visitor);
                                $visitor_id = $this->db->insert_id();
                            } else {
                                $visitor = $visitor_query->row();
                                $visitor_id = $visitor->visitor_id;
                            }
                            $gate_number = array_key_exists(trim($row['allowed_gate']),$gateNumbers) ?
                                $gateNumbers[trim($row['allowed_gate'])] : reset($gateNumbers);
                            $add_visit = array(
                                'private_visit_id' => 0,
                                'visit_visitor_id_fk' => $visitor_id,
                                'date_from' => date('Y-m-d', strtotime($row['date_from'])),
                                'date_to' => date('Y-m-d', strtotime($row['date_to'])),
                                'visit_time' => $row['time'] ? $row['time'] : '00:00:00',
                                'visit_reason' => trim($row['visit_reason']),
                                'visit_transport_mode' => trim($row['visit_transport_mode']),
                                'visit_transport_registration_no' => trim($row['registration_no']),
                                'tenant_id' => sessiondata('login_tenant_id'),
                                'employee_id' => sessiondata('login_employee_id'),
                                'visit_from_company' => trim($row['from_company']),
                                'location_id' => sessiondata('login_user_location'),
                                'identity_type' => 'visitor_'.$row['identity_type'],
                                'gate_number' => $gate_number,
                                'created_by' => sessiondata('login_user_id'),
                                'created_at' => date('Y-m-d H:i:s'),
                                'visit_code' => generateRandomString()
                            );
//                            print_r($add_visit);
                            $this->db->insert('visit', $add_visit);

                            $this->db->trans_complete(); // Commit if all queries are successful, otherwise rollback

                            if ($this->db->trans_status() === FALSE) {
                                $response = false;
                            }
                        }

                        if ($response) { echo 'done?';
                            $this->session->set_flashdata('success_msg', 'Visitor Data Imported Successfully!!!');
//                            redirect(base_url() . 'PrivateVisits/import_csv');
                        } else {
                            $this->session->set_userdata('no_success_msg', 'Data cannot be imported! Please try later');
                        }
                    } else {
                        $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
                    }

                } else {

                    $this->session->set_flashdata('error_message', 'No file selected');
                    $data['page_title'] = 'Import Visitor Data';
                    $this->load->view('common/header', $data);
                    $this->load->view('private_visits/import_visitor_data', $data);
                    $this->load->view('common/footer');
                }

            } else {

                $data['page_title'] = 'Import Visitor Data';
                $this->load->view('common/header', $data);
                $this->load->view('private_visits/import_visitor_data', $data);
                $this->load->view('common/footer');
            }
        }
        else {
            redirect(base_url());
        }
        // end session userdata logged in and login user type
    } // end function import_csv
}
