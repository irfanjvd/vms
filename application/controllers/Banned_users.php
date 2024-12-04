<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banned_users extends CI_Controller
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

    public function add_banned_user()
    {
        $session_data = $this->session->userdata('logged_in');
        if ($this->session->userdata('logged_in') && $session_data['login_user_type']=="SUPER") {
//            echo "<pre>";
//            print_r($session_data['type']);die;
            if($session_data['login_user_type']!="SUPER"){
                redirect(base_url().'visitor/visitors');
            }
            if (!empty($_POST)) {
                unset($_POST['submit']);
                $message = '';

                if (isset($_POST['cnic']) && $_POST['cnic'] == '') {
                    $message .= "CNIC cannot be blank <br>";
                }

                if ($message == '') {
                    //check cnic already banned or not???
                    $banned_result=$this->banned_cnic_model->is_visitor_banned($_POST['cnic']);
                    if(!empty($banned_result)){
                        $this->session->set_flashdata('message', array('message' => 'Cnic '.$_POST['cnic'].' already in banned list !!!', 'type' => 'error'));
                        redirect(base_url().'banned_users/add_banned_user');
                    }

                    //save banned user...
                    $insert_id = $this->banned_cnic_model->add_cnic($_POST);
                    if ($insert_id) {
                        $this->log_model->create_log("ADD BANNED CNIC",$_POST,$insert_id);
                        $this->session->set_flashdata('message', array('message' => 'Cnic Added Successfully !!!', 'type' => 'success'));
                        redirect(base_url().'banned_users/add_banned_user');
                    }
                } else {
                    $this->session->set_flashdata('message', array('message' => "$message", 'type' => 'error'));
                }


            }

            $data = array();
            $data['page_title'] = 'Add Banned Cnic';
            if (isset($_POST)) {
                $data['info'] = $_POST;
            }

            $this->load->view('common/header', $data);
            if ($session_data['login_user_type'] == "SUPER") {
                $this->load->view('banned_users/add_banned_user');
            } else{
                redirect(base_url().'visitor/addvisitor');
            }
            $this->load->view('common/footer');
        } else {
            redirect("visitor/visitors");
        }
    }

    public function edit_banned_user($id)
    {
        if ($this->session->userdata('logged_in')) {
            if (!empty($_POST)) {
                unset($_POST['submit']);
                $message = '';
                if (isset($_POST['reason']) && $_POST['reason'] == '') {
                    $message .= "Reason cannot be blank <br>";
                }

                if ($message == '') {
                    //update user...
                    $result = $this->banned_cnic_model->update_banned_user($_POST, $id);
                    if ($result) {
                        $this->log_model->create_log("EDIT BANNED USER",$_POST,$id);
                        $this->session->set_flashdata('message', array('message' => 'Reason Updated Successfully !!!', 'type' => 'success'));
                        redirect(base_url().'banned_users/list_banned_users');
                    }

                } else {
                    $this->session->set_flashdata('message', array('message' => "$message", 'type' => 'error'));
                    redirect(base_url().'banned_users/edit_banned_user/'.$id);
                }

            }

            $data = array();
            $data['page_title'] = "Edit Banned User";
            //get banned users details...
            $result = $this->banned_cnic_model->get_banned_user($id);
            $data['info'] = $result;
            $this->load->view('common/header', $data);
            $this->load->view('banned_users/edit_banned_user', $data);
            $this->load->view('common/footer');
        } else {
            redirect(base_url());
        }
    }

    public function delete_banned_user($id)
    {
        if ($this->session->userdata('logged_in')) {
            $data = array();
            $data['page_title'] = "Location";
            $result = $this->banned_cnic_model->delete_banned_user($id);
            $this->log_model->create_log("DELETE BANNED USER","",$id);
            if($result){
                $this->session->set_flashdata('message', array('message' => "Banned user deleted successfully !!!", 'type' => 'error'));
                redirect(base_url().'banned_users/list_banned_users');
            }


        } else {
            redirect(base_url());
        }
    }

    public function list_banned_users(){
        $session_data = $this->session->userdata('logged_in');
        if ($this->session->userdata('logged_in') && $session_data['login_user_type']=="SUPER") {
            $data = array();
            $data['page_title'] = 'Banned Users';
//            $result=$this->location_model->get_all_locations();
//            $data['locations']=$result;

            $this->load->view('common/header', $data);
            $this->load->view('banned_users/list_banned_users', $data);
            $this->load->view('common/footer');

        }else{
            redirect("visitor/visitors");
        }
    }

    public function get_ajax_banned_users(){
        $result=$this->banned_cnic_model->get_all_banned_users($_GET['iDisplayStart'],$_GET['iDisplayLength'],$_GET['sSearch'],$_GET['iSortCol_0'],$_GET['sSortDir_0']);
        $total_locations=count($result);
        $data2= array("sEcho" => $_GET['sEcho'],
            "iTotalRecords" => $total_locations,
            "iTotalDisplayRecords" => $total_locations,
        );
        foreach($result as $key=>$val){
            $id=$val['id'];
            $data2['aaData'][] = array(
                'cnic' => $val['cnic'],
                'type' => $val['type'],
                'visit_left' => $val['visit_left'],
                'date_range' => $val['date_range'],
                'reason' => $val['reason'],
                'created_datetime' => $val['created_datetime'],
                'action' => $this->create_action_button($id),
//                'delete' => $this->create_delete_button($id),

//                    'app_file' => $filename,
//                    'empty_form' => $empty_form,
//                    'form_id' => $form_id,
            );
        }

        if($total_locations==0){
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

    function get_locations_for_filter(){
        $result=$this->location_model->get_locations_for_filter();
        echo $result;
    }

    public function create_action_button($id){
        $edit_url=base_url()."banned_users/edit_banned_user/$id";
        $delete_url = base_url() . "banned_users/delete_banned_user/$id";
        return "
                <a href='$edit_url'><i class='fa fa-pencil'></i></a>
                <a href='$delete_url' onclick='return confirm(\"Are you sure you want to delete this record?\");'>
                 <i class='fa fa-remove'></i>
                 </a>
                    ";


    }

    public function create_delete_button($id){
            $url = base_url() . "location/delete_location/$id";
            return "<a href='$url' onclick='return confirm(\"Are you sure you want to delete this Location?\");'>
                 <i class='fa fa-remove'></i>
                 </a>";
        return ;

    }

}
