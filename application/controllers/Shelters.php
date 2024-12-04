<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shelters extends CI_Controller
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

    public function __construct(){
        parent::__construct();
        $this->load->model('shelter_room_model');
    }

    public function add_shelter(){
        $session_data = $this->session->userdata('logged_in');
        if ($this->session->userdata('logged_in') && $session_data['login_user_type']=="SUPER") {
            if($session_data['login_user_type']!="SUPER"){
                redirect(base_url().'visitor/visitors');
            }

            if (!empty($_POST)) {
                unset($_POST['submit']);
                $message = '';

                if (isset($_POST['shelter']) && $_POST['shelter'] == '') {
                    $message .= "Location cannot be blank <br>";
                }
                if (isset($_POST['room']) && $_POST['room'] == '') {
                    $message .= "Rooms cannot be blank <br>";
                }

                if ($message == '') {
                        //save Shelter...
                        $insert_id = $this->common_model->save('shelters',$_POST);
                        if ($insert_id) {
                            $this->log_model->create_log("ADD SHELTER",$_POST,$insert_id);
                            $this->session->set_flashdata('message', array('message' => 'Shelter Added Successfully !!!', 'type' => 'success'));
                            redirect(base_url().'shelters/add_shelter');
                        }
                } else {
                    $this->session->set_flashdata('message', array('message' => "$message", 'type' => 'error'));
                }


            }

            $data = array();
            $data['page_title'] = 'Add New Shelter';
            if (isset($_POST)) {
                $data['info'] = $_POST;
            }

            $this->load->view('common/header', $data);
            if ($session_data['login_user_type'] == "SUPER") {
                $this->load->view('shelter/add_shelter');
            } else{
                redirect(base_url().'visitor/addvisitor');
            }
            $this->load->view('common/footer');
        } else {
            redirect("visitor/visitors");
        }
    }

    public function edit_shelter($id){
        if ($this->session->userdata('logged_in')) {
            if (!empty($_POST)) {
                unset($_POST['submit']);
                $message = '';
                if (isset($_POST['shelter']) && $_POST['shelter'] == '') {
                    $message .= "Shelter cannot be blank <br>";
                }
                if (isset($_POST['rooms']) && $_POST['rooms'] == '') {
                    $message .= "Rooms cannot be blank <br>";
                }

                if ($message == '') {
                    //update user...
                    $result = $this->common_model->update('shelters',$_POST, array('id'=>$id));
                    if ($result) {
                        $this->log_model->create_log("EDIT SHELTER",$_POST,$id);
                        $this->session->set_flashdata('message', array('message' => 'Record Updated Successfully !!!', 'type' => 'success'));
                        redirect(base_url().'shelters/list_shelters');
                    }

                } else {
                    $this->session->set_flashdata('message', array('message' => "$message", 'type' => 'error'));
                    redirect(base_url().'shelters/edit_shelter/'.$id);
                }

            }

            $data = array();
            $data['page_title'] = "Edit Shelter";
            //get users details...
            $result = $this->common_model->find('shelters',"*",1,array('id'=>$id));
            $data['info'] = $result;
            $this->load->view('common/header', $data);
            $this->load->view('shelter/edit_shelter', $data);
            $this->load->view('common/footer');
        } else {
            redirect(base_url());
        }
    }

    public function delete_shelter($id)
    {
        if ($this->session->userdata('logged_in')) {
            $data = array();
            $data['page_title'] = "Shelter";
            $result = $this->common_model->update("shelters",array('is_deleted'=>1),array('id'=>$id));
            $this->log_model->create_log("DELETE SHELTER","",$id);
            if($result){
                $this->session->set_flashdata('message', array('message' => "Shelter deleted successfully !!!", 'type' => 'error'));
                redirect(base_url().'shelters/list_shelters');
            }


        } else {
            redirect(base_url());
        }
    }

    public function list_shelters(){
        $session_data = $this->session->userdata('logged_in');
        if ($this->session->userdata('logged_in') && $session_data['login_user_type']=="SUPER") {
			
            $data = array();
            $data['page_title'] = 'Shelters';
//            $result=$this->location_model->get_all_locations();
//            $data['locations']=$result;

            $this->load->view('common/header', $data);
            $this->load->view('shelter/list_shelters', $data);
            $this->load->view('common/footer');

        }else{
            redirect("visitor/visitors");
        }
    }

    public function get_ajax_shelters(){
        $result=$this->location_model->get_all_locations($_GET['iDisplayStart'],$_GET['iDisplayLength'],$_GET['sSearch'],$_GET['iSortCol_0'],$_GET['sSortDir_0']);
        $total_locations=count($result);
        $data2= array("sEcho" => $_GET['sEcho'],
            "iTotalRecords" => $total_locations,
            "iTotalDisplayRecords" => $total_locations,
        );
        foreach($result as $key=>$val){
            $id=$val['id'];
            $data2['aaData'][] = array(
                'shelter' => $val['shelter'],
                'room' => $val['room'],
                'action' => $this->create_action_button($id),
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
        $edit_url=base_url()."shelters/edit_shelter/$id";
        $delete_url = base_url() . "shelters/delete_shelter/$id";
        return "
                <a href='$edit_url'><i class='fa fa-pencil'></i></a>
                <a href='$delete_url' onclick='return confirm(\"Are you sure you want to delete this?\");'>
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


    // Shelter rooms section start
    public function add_shelter_rooms(){
        $session_data = $this->session->userdata('logged_in');
        if ($this->session->userdata('logged_in') && $session_data['login_user_type']=="SUPER") {
            if($session_data['login_user_type']!="SUPER"){
                redirect(base_url().'visitor/visitors');
            }

            if (!empty($_POST)) {
                unset($_POST['submit']);
                $message = '';

                if (isset($_POST['shelter_id']) && $_POST['shelter_id'] == '') {
                    $message .= "Shelter cannot be blank <br>";
                }
                if (isset($_POST['room']) && $_POST['room'] == '') {
                    $message .= "Rooms cannot be blank <br>";
                }
                if (isset($_POST['capacity']) && $_POST['capacity'] == '') {
                    $message .= "Capacity cannot be blank <br>";
                }

                if ($message == '') {
                        //save Shelter...
                        $insert_id = $this->common_model->save('shelter_rooms',$_POST);
                        if ($insert_id) {
                            $this->log_model->create_log("ADD SHELTER ROOMS",$_POST,$insert_id);
                            $this->session->set_flashdata('message', array('message' => 'Shelter Room Added Successfully !!!', 'type' => 'success'));
                            redirect(base_url().'shelters/list_shelter_rooms');
                        }
                } else {
                    $this->session->set_flashdata('message', array('message' => "$message", 'type' => 'error'));
                }


            }

            $data = array();
            $data['page_title'] = 'Add New Shelter Room';
            $data['shelters']=$this->common_model->find("shelters","*",false,array('is_deleted'=>0));
            if (isset($_POST)) {
                $data['info'] = $_POST;
            }

            $this->load->view('common/header', $data);
            if ($session_data['login_user_type'] == "SUPER") {
                $this->load->view('shelter/add_shelter_room',$data);
            } else{
                redirect(base_url().'visitor/addvisitor');
            }
            $this->load->view('common/footer');
        } else {
            redirect("visitor/visitors");
        }
    }

    public function edit_shelter_room($id){
        if ($this->session->userdata('logged_in')) {
            if (!empty($_POST)) {
                unset($_POST['submit']);
                $message = '';
                if (isset($_POST['shelter_id']) && $_POST['shelter_id'] == '') {
                    $message .= "Shelter cannot be blank <br>";
                }
                if (isset($_POST['room']) && $_POST['room'] == '') {
                    $message .= "Room cannot be blank <br>";
                }
                if (isset($_POST['capacity']) && $_POST['capacity'] == '') {
                    $message .= "Capacity cannot be blank <br>";
                }


                if ($message == '') {
                    //update user...
                    $result = $this->common_model->update('shelter_rooms',$_POST, array('id'=>$id));

                    if ($result) {
                        $this->log_model->create_log("EDIT SHELTER ROOM",$_POST,$id);
                        $this->session->set_flashdata('message', array('message' => 'Record Updated Successfully !!!', 'type' => 'success'));
                        redirect(base_url().'shelters/list_shelter_rooms');
                    }

                } else {
                    $this->session->set_flashdata('message', array('message' => "$message", 'type' => 'error'));
                    redirect(base_url().'shelters/edit_shelter_room/'.$id);
                }

            }

            $data = array();
            $data['page_title'] = "Edit Shelter Room";
            $data['shelters']=$this->common_model->find("shelters","*",false,array('is_deleted'=>0));
            //get users details...
            $result = $this->common_model->find('shelter_rooms',"*",1,array('id'=>$id));
            $data['info'] = $result;
            $this->load->view('common/header', $data);
            $this->load->view('shelter/edit_shelter_room', $data);
            $this->load->view('common/footer');
        } else {
            redirect(base_url());
        }
    }

    public function delete_shelter_room($id)
    {
        if ($this->session->userdata('logged_in')) {
            $data = array();
            $data['page_title'] = "Shelter Room";
            $result = $this->common_model->update("shelter_rooms",array('is_deleted'=>1),array('id'=>$id));
            $this->log_model->create_log("DELETE SHELTER ROOM","",$id);
            if($result){
                $this->session->set_flashdata('message', array('message' => "Shelter Room deleted successfully !!!", 'type' => 'error'));
                redirect(base_url().'shelters/list_shelter_rooms');
            }


        } else {
            redirect(base_url());
        }
    }

    public function list_shelter_rooms(){
        $session_data = $this->session->userdata('logged_in');
        if ($this->session->userdata('logged_in') && $session_data['login_user_type']=="SUPER") {
            
            $data = array();
            $data['page_title'] = 'Shelter Rooms';
//            $result=$this->location_model->get_all_locations();
//            $data['locations']=$result;

            $this->load->view('common/header', $data);
            $this->load->view('shelter/list_shelter_rooms', $data);
            $this->load->view('common/footer');

        }else{
            redirect("visitor/visitors");
        }
    }

    public function get_ajax_shelter_rooms(){
        $result=$this->shelter_room_model->get_all_shelter_rooms($_GET['iDisplayStart'],$_GET['iDisplayLength'],$_GET['sSearch'],$_GET['iSortCol_0'],$_GET['sSortDir_0']);
        $total_locations=count($result);
        $data2= array("sEcho" => $_GET['sEcho'],
            "iTotalRecords" => $total_locations,
            "iTotalDisplayRecords" => $total_locations,
        );
        
        foreach($result as $key=>$val){
            $id=$val['id'];
            $data2['aaData'][] = array(
                'shelter_id' => $val['shelter'],
                'room' => $val['room'],
                'capacity' => $val['capacity'],
                'action' => $this->create_shelter_room_action_button($id),
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


    public function create_shelter_room_action_button($id){
        $edit_url=base_url()."shelters/edit_shelter_room/$id";
        $delete_url = base_url() . "shelters/delete_shelter_room/$id";
        return "
                <a href='$edit_url'><i class='fa fa-pencil'></i></a>
                <a href='$delete_url' onclick='return confirm(\"Are you sure you want to delete this?\");'>
                 <i class='fa fa-remove'></i>
                 </a>
                    ";


    }






}
