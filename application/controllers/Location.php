<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller
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

    public function add_location()
    {
        $session_data = $this->session->userdata('logged_in');
        if ($this->session->userdata('logged_in') && $session_data['login_user_type']=="SUPER") {
			if($session_data['login_user_type']=="TENANT"){
				redirect(base_url().'visitor/private_visits');
			}
//            echo "<pre>";
//            print_r($session_data['type']);die;
            if($session_data['login_user_type']!="SUPER"){
                redirect(base_url().'visitor/visitors');
            }
            if (!empty($_POST)) {
                unset($_POST['submit']);
                $message = '';

                if (isset($_POST['location']) && $_POST['location'] == '') {
                    $message .= "Location cannot be blank <br>";
                }

                if ($message == '') {
                        //save location...
                        $insert_id = $this->location_model->add_location($_POST);
                        if ($insert_id) {
                            $this->log_model->create_log("ADD LOCATION",$_POST,$insert_id);
                            $this->session->set_flashdata('message', array('message' => 'Location Added Successfully !!!', 'type' => 'success'));
                            redirect(base_url().'location/add_location');
                        }
                } else {
                    $this->session->set_flashdata('message', array('message' => "$message", 'type' => 'error'));
                }


            }

            $data = array();
            $data['page_title'] = 'Add New Location';
            if (isset($_POST)) {
                $data['info'] = $_POST;
            }

            $this->load->view('common/header', $data);
            if ($session_data['login_user_type'] == "SUPER") {
                $this->load->view('location/add_location');
            } else{
                redirect(base_url().'visitor/addvisitor');
            }
            $this->load->view('common/footer');
        } else {
            redirect("visitor/visitors");
        }
    }

    public function edit_location($id)
    {
        if ($this->session->userdata('logged_in')) {
            if (!empty($_POST)) {
                unset($_POST['submit']);
                $message = '';
                if (isset($_POST['location']) && $_POST['location'] == '') {
                    $message .= "Location cannot be blank <br>";
                }

                if ($message == '') {
                    //update user...
                    $result = $this->location_model->update_location($_POST, $id);
                    if ($result) {
                        $this->log_model->create_log("EDIT LOCATION",$_POST,$id);
                        $this->session->set_flashdata('message', array('message' => 'Location Updated Successfully !!!', 'type' => 'success'));
                        redirect(base_url().'location/edit_location/'.$id);
                    }

                } else {
                    $this->session->set_flashdata('message', array('message' => "$message", 'type' => 'error'));
                    redirect(base_url().'location/edit_location/'.$id);
                }

            }

            $data = array();
            $data['page_title'] = "Edit Location";
            //get users details...
            $result = $this->location_model->get_location($id);
            $data['info'] = $result;
            $this->load->view('common/header', $data);
            $this->load->view('location/edit_location', $data);
            $this->load->view('common/footer');
        } else {
            redirect(base_url());
        }
    }

    public function delete_location($id)
    {
        if ($this->session->userdata('logged_in')) {
            $data = array();
            $data['page_title'] = "Location";
            $result = $this->location_model->delete_location($id);
            $this->log_model->create_log("DELETE LOCATION","",$id);
            if($result){
                $this->session->set_flashdata('message', array('message' => "Location deleted successfully !!!", 'type' => 'error'));
                redirect(base_url().'location/list_locations');
            }


        } else {
            redirect(base_url());
        }
    }

    public function list_locations(){
        $session_data = $this->session->userdata('logged_in');
        if ($this->session->userdata('logged_in') && $session_data['login_user_type']=="SUPER") {
			if($session_data['login_user_type']=="TENANT"){
				redirect(base_url().'visitor/private_visits');
			}
            $data = array();
            $data['page_title'] = 'Locations';
//            $result=$this->location_model->get_all_locations();
//            $data['locations']=$result;

            $this->load->view('common/header', $data);
            $this->load->view('location/list_locations', $data);
            $this->load->view('common/footer');

        }else{
            redirect("visitor/visitors");
        }
    }

    public function get_ajax_locations(){
        $result=$this->location_model->get_all_locations($_GET['iDisplayStart'],$_GET['iDisplayLength'],$_GET['sSearch'],$_GET['iSortCol_0'],$_GET['sSortDir_0']);
        $total_locations=count($result);
        $data2= array("sEcho" => $_GET['sEcho'],
            "iTotalRecords" => $total_locations,
            "iTotalDisplayRecords" => $total_locations,
        );
        foreach($result as $key=>$val){
            $id=$val['id'];
            $data2['aaData'][] = array(
                'location' => $val['location'],
                'created_datetime' => $val['created_datetime'],
                'issue_card' => ($val['issue_card']==1)?"Yes":"No",
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
        $edit_url=base_url()."location/edit_location/$id";
        $delete_url = base_url() . "location/delete_location/$id";
        return "
                <a href='$edit_url'><i class='fa fa-pencil'></i></a>
                <a href='$delete_url' onclick='return confirm(\"Are you sure you want to delete this Location?\");'>
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
