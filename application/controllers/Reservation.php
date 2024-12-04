<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation extends CI_Controller
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
//        $this->load->model('location_model');
//    }


    function add_reservation(){
        $session_data = $this->session->userdata('logged_in');
        if ($this->session->userdata('logged_in') ) {

            if (!empty($_POST)) {
                unset($_POST['submit']);
                $message = '';
                if (isset($_POST['cnic']) && $_POST['cnic'] == '') {
                    $message .= "CNIC cannot be blank <br>";
                }

                if (isset($_POST['name']) && $_POST['name'] == '') {
                    $message .= "Visitor Name cannot be blank <br>";
                }

                if (isset($_POST['employee_name']) && $_POST['employee_name'] == '') {
                    $message .= "Employee Name cannot be blank <br>";
                }

                if ($message == '') {
                    //save location...
                    $insert_id = $this->reservation_model->add_reservation($_POST);
                    if ($insert_id) {
                        $this->log_model->create_log("ADD RESERVATION",$_POST,$insert_id);
                        $this->session->set_flashdata('message', array('message' => 'Reservation Added Successfully !!!', 'type' => 'success'));
                        redirect(base_url().'reservation/add_reservation');
                    }
                } else {
                    $this->session->set_flashdata('message', array('message' => "$message", 'type' => 'error'));
                }


            }

            $data = array();
            $data['page_title'] = 'Add New Reservation';
            if (isset($_POST)) {
                $data['info'] = $_POST;
            }

            $this->load->view('common/header', $data);
            $this->load->view('reservation/add_reservation');
            $this->load->view('common/footer');
        } else {
            redirect(base_url());
        }
    }

    public function edit_reservation($id)
    {
        if ($this->session->userdata('logged_in')) {
            if (!empty($_POST)) {
                unset($_POST['submit']);
                $message = '';
                if (isset($_POST['cnic']) && $_POST['cnic'] == '') {
                    $message .= "CNIC cannot be blank <br>";
                }

                if (isset($_POST['name']) && $_POST['name'] == '') {
                    $message .= "Visitor Name cannot be blank <br>";
                }

                if (isset($_POST['employee_name']) && $_POST['employee_name'] == '') {
                    $message .= "Employee Name cannot be blank <br>";
                }

                if ($message == '') {
                    //update reservation...
                    $result = $this->reservation_model->update_reservation($_POST, $id);
                    if ($result) {
                        $this->log_model->create_log("EDIT RESERVATION",$_POST,$id);
                        $this->session->set_flashdata('message', array('message' => 'Reservation Updated Successfully !!!', 'type' => 'success'));
                        redirect(base_url().'reservation/edit_reservation/'.$id);
                    }

                } else {
                    $this->session->set_flashdata('message', array('message' => "$message", 'type' => 'error'));
                    redirect(base_url().'reservation/edit_reservation/'.$id);
                }

            }

            $data = array();
            $data['page_title'] = "Edit Reservation";
            //get users details...
            $result = $this->reservation_model->get_reservation($id);
            $data['info'] = $result;
            $this->load->view('common/header', $data);
            $this->load->view('reservation/edit_reservation', $data);
            $this->load->view('common/footer');
        } else {
            redirect(base_url());
        }
    }

    public function list_reservations(){
        $session_data = $this->session->userdata('logged_in');
        if ($this->session->userdata('logged_in')) {
            $data = array();
            $data['page_title'] = 'Reservations';
//            $result=$this->location_model->get_all_locations();
//            $data['locations']=$result;

            $this->load->view('common/header', $data);
            $this->load->view('reservation/list_reservations', $data);
            $this->load->view('common/footer');

        }else{
            redirect(base_url());
        }
    }


    public function delete_reservation($id)
    {
        if ($this->session->userdata('logged_in')) {
            $data = array();
            $data['page_title'] = "Reservations";
            $result = $this->reservation_model->delete_reservation($id);
            $this->log_model->create_log("DELETE RESERVATION","",$id);
            if($result){
                $this->session->set_flashdata('message', array('message' => "Reservation deleted successfully !!!", 'type' => 'error'));
                redirect(base_url().'reservation/list_reservations');
            }


        } else {
            redirect(base_url());
        }
    }



    public function get_ajax_reservations(){
        $result=$this->reservation_model->get_all_reservations($_GET['iDisplayStart'],$_GET['iDisplayLength'],$_GET['sSearch'],$_GET['iSortCol_0'],$_GET['sSortDir_0']);
        $result2=$this->reservation_model->get_all_reservations(null,null,$_GET['sSearch'],$_GET['iSortCol_0'],$_GET['sSortDir_0']);
        $total_tenant_employees=count($result2);
        $data2= array("sEcho" => $_GET['sEcho'],
            "iTotalRecords" => $total_tenant_employees,
            "iTotalDisplayRecords" => $total_tenant_employees,
        );
        foreach($result as $key=>$val){
            $id=$val['id'];
            $data2['aaData'][] = array(
                'cnic' => $val['cnic'],
                'name' => $val['name'],
                'employee_name' => $val['employee_name'],
                'vehicle_type' => $val['vehicle_type'],
                'vehicle_no' => $val['vehicle_no'],
                'reservation_date' => $val['reservation_date'],
                'location' => $val['location'],

                'action' => $this->create_action_button($id),

            );
        }

        if($total_tenant_employees==0){
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

    function get_tenant_employees(){
        $tenant=$_POST['tenant'];
        $tenant_employees=$this->tenant_model->get_employees($tenant);
        echo json_encode($tenant_employees);


    }

    function get_tenants_for_filter(){
        $result=$this->tenant_model->get_tenants_for_filter();
        echo $result;
    }

    public function create_action_button($id){
        $edit_url=base_url()."reservation/edit_reservation/$id";
        $delete_url = base_url() . "reservation/delete_reservation/$id";
        return "
                <a href='$edit_url'><i class='fa fa-pencil'></i></a>
                <a href='$delete_url' onclick='return confirm(\"Are you sure you want to delete this reservation?\");'>
                 <i class='fa fa-remove'></i>
                 </a>
                    ";


    }

}
