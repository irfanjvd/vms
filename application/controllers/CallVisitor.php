<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CallVisitor extends CI_Controller {

   /* public function __construct() {
        
		parent::__construct();
		
    }*/

    public function index(){
    
        redirect(base_url().'CallVisitor/addvisitor');        
    }

    public function addvisitor() {
        
        $session_data = $this->session->userdata('logged_in');

        if ($this->session->userdata('logged_in') && $session_data['login_user_type']!="SUPER") {
            
            $data = array();
            
            if($session_data['login_user_type']=="TENANT"){
                redirect(base_url().'visitor/private_visits');
            }

            if ($this->input->post()) {
                
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
                $timestamp = date('Y-m-d H:i:s', strtotime($this->input->post('visit_checkin')));
                    
                    
                    $add_visitor = array(
                        'employee_name' => trim($this->input->post('caller_name')),
                        "employee_company" => trim($this->input->post('visit_to_tenant')),
                        'employee_designation' => trim($this->input->post('caller_designation')),
                        'visitor_name' => trim($this->input->post('visitor_name')),
                        'visit_reason' => trim($this->input->post('visit_reason')),
                        // 'visit_date' => ($this->input->post('visit_checkin')=="")?date("Y-m-d H:i:s"):trim($this->input->post('visit_checkin')),
                        'visit_date' => $timestamp,
                        'visitor_identity_no' => trim($this->input->post('visitor_identity_no')),
                        
                    );

                    //print_r($add_visitor);
                    //die;
                   
                    $this->db->insert('visit_by_call', $add_visitor);
                    $action = "";
                    
                    if($message==''){
                        if($action=="CHECK_OUT"){
                            $this->session->set_flashdata('message', array('message' => "Visit checkout done successfully !!!", 'type' => 'success'));
                        }else{
                            $this->session->set_flashdata('message', array('message' => "Visit created successfully !!!", 'type' => 'success'));
                        }


                    }
                    
                    redirect(base_url().'CallVisit/visits');
                 
                        
            } // end if input post check

                $locations=$this->location_model->get_all_locations();
                $cities=$this->location_model->get_all_cities();
                $tenants=$this->tenant_model->get_all_tenants();
                    

                $data['locations']=$locations;
                $data['cities']=$cities;
                $data['tenants']=$tenants;
                $data['page_title'] = 'Add New Visitor';
                $this->load->view('common/header', $data);
                $this->load->view('visitor_by_call/add_visitor',$data);
                $this->load->view('common/footer');
            
        
        
        } // end session userdata logged in and login user type check

        else{
            redirect(base_url());
        }
    }

    public function import(){
        $data = array();
        $memData = array();
        
        // If import request is submitted
        if($this->input->post('importSubmit')){
            // Form field validation rules
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
            
            // Validate submitted form data
            if($this->form_validation->run() == true){
                $insertCount = $updateCount = $rowCount = $notAddCount = 0;
                
                // If file uploaded
                if(is_uploaded_file($_FILES['file']['tmp_name'])){
                    // Load CSV reader library
                    $this->load->library('CSVReader');
                    
                    // Parse data from CSV file
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                    
                    // Insert/update CSV data into database
                    if(!empty($csvData)){
                        foreach($csvData as $row){ $rowCount++;
                            
                            // Prepare data for DB insertion
                            $memData = array(
                                'name' => $row['Name'],
                                'email' => $row['Email'],
                                'phone' => $row['Phone'],
                                'status' => $row['Status'],
                            );
                            
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'email' => $row['Email']
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->member->getRows($con);
                            
                            if($prevCount > 0){
                                // Update member data
                                $condition = array('email' => $row['Email']);
                                $update = $this->member->update($memData, $condition);
                                
                                if($update){
                                    $updateCount++;
                                }
                            }else{
                                // Insert member data
                                $insert = $this->member->insert($memData);
                                
                                if($insert){
                                    $insertCount++;
                                }
                            }
                        }
                        
                        // Status message with imported data count
                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg = 'Members imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Updated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';
                        $this->session->set_userdata('success_msg', $successMsg);
                    }
                }else{
                    $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
                }
            }else{
                $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('members');
    }

} // end class Call Visitor