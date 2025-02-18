<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Visit_Types extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Visit_Types_model');
        $this->load->library('pagination');

        if (!$this->session->userdata('logged_in')) {
            redirect('/');
        }
    }

    function index()
    {
        redirect('Visit_Types/listing');
    }

    public function listing()
    {
        $data["Title"] = "List";
        $limit_per_page = 30;
        $start = 0;

        if ($this->uri->segment(3) && $this->uri->segment(3) > 1) {
            $start = ($this->uri->segment(3) - 1) * $limit_per_page;
        }

        $start_index = $start;

        $fetchRecord = $this->Visit_Types_model->visit_typeslisting($start_index, $limit_per_page);
        $total_records = $fetchRecord["total"];
        $data["record"] = $fetchRecord["record"];
        $data["total_rows"] = $fetchRecord["total"];
        $data["per_page"] = $limit_per_page;

        $config["base_url"] = base_url() . "Visit_Types/listing";
        $config["total_rows"] = $total_records;
        $config["per_page"] = $limit_per_page;
        $config["uri_segment"] = 3;
        $config["use_page_numbers"] = TRUE;
        //$config["num_links"] 		= 5;
        $config["next_link"] = "Next";
        $config["prev_link"] = "Previous";
        $config["full_tag_open"] = "<ul class='pagination'>";
        $config["full_tag_close"] = "</ul>";
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active'><a name='active' style='z-index: 2; color: #fff; cursor: default; background-color: #0E667F !important; border-color: #0E667F !important;'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["prev_tag_open"] = $config["next_tag_open"] = "<li>";
        $config["prev_tag_close"] = $config["next_tag_close"] = "</li>";
        $config["last_tag_open"] = $config["first_tag_open"] = "<li>";
        $config["last_tag_close"] = $config["first_tag_close"] = "</li>";

        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();


        $data['page_title'] = 'Visit types list';
        $this->load->view('common/header', $data);
        $this->load->view('visit_types/listing', $data);
        $this->load->view('common/footer');

        //$this->load->view('Visit_Types/listing', $data);

    }

    function adding()
    {
        $data["Title"] = "Add";


        $this->load->helper(array("form", "url"));
        $this->form_validation->set_rules('form_name', 'Name', 'required');


        if ($this->form_validation->run() == FALSE) {

        } else {
            $insert_data = array('name' => $this->input->post('form_name', true),
                'tenant_id' => $this->input->post('tenant_id', true),
                'created_by' => sessiondata('login_user_id'),
                'created_at' => date('Y-m-d H:i:s'),
            );
            //$this->db->trans_begin();
            if ($this->db->insert('visit_types', $insert_data)) {
                $this->session->set_flashdata('message', 'Data saved successfully');
                redirect('visit_types/listing');
            } else {
                $dbError = $this->db->error();
                $this->session->set_flashdata('error', $dbError);
            }

            /*
            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $message = 'There is some problem in data while insertion';
            }else{
                    $this->db->trans_commit();
                    $message = 'Data saved successfully';
                 }
            */

            //$data['message'] = 'Data saved successfully';
            //$this->session->set_flashdata('message', 'Data saved successfully');
            //redirect('Visit_Types/listing');
        }

        $data['tenants'] = $this->db->get('tenant')->result();
        $data['page_title'] = 'Visit types list';
        $this->load->view('common/header', $data);
        $this->load->view('visit_types/adding', $data);
        $this->load->view('common/footer');
        //
        // 
        // $this->load->view('visit_types/adding', $data);
        // 
    }

    function updating($id)
    {
        $data["title"] = "Edit";
        $record = $this->Visit_Types_model->visit_typeslisting(false, false, $id);
        $data["record"] = $record["record"];

        $this->load->helper(array("form", "url"));
        $this->form_validation->set_rules('form_name', 'form_name', 'required');


        if ($this->form_validation->run() == FALSE) {

        } else {

            //$this->db->trans_begin();
            $update_data = array(
                'name' => $this->input->post('form_name', true),
                'tenant_id' => $this->input->post('tenant_id', true),
                'updated_by' => sessiondata('login_user_id'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
            if ($this->db->update('visit_types', $update_data, array('id' => $id))) {
                $this->session->set_flashdata('message', 'Data saved successfully');
                $this->session->set_flashdata("success", "Data has updated successfully");
                redirect('Visit_Types/listing');
            } else {
                $dbError = $this->db->error();
                $this->session->set_flashdata("error", $dbError);
            }

            /*
            if ($this->db->trans_status() === FALSE)
            {
                $CheckAnyError 	= true;
                $dbError 		= $this->db->error();
                $this->db->trans_rollback();
                $message 		= $dbError["message"];
                $data["error"] 	= $message;
                $this->session->set_flashdata("msg_fail", $data["error"]);
            }else{
                    $this->db->trans_commit();
                    $message 			= "Data has updated successfully";
                    $data["success"] 	= $message;
                    $this->session->set_flashdata("msg_success", $data["success"]);
                    redirect('Visit_Types/listing');
                 }
        */

        }

        //$this->load->view('Visit_Types/updating', $data);
        $data['page_title'] = 'Visit types list';
        $data['tenants'] = $this->db->get('tenant')->result();
        $this->load->view('common/header', $data);
        $this->load->view('visit_types/updating', $data);
        $this->load->view('common/footer');

    }

    function deleting($id)
    {
        if (in_array($this->session->userdata('logged_in')['login_user_type'], ['SUPER','TENANT'])) {
            if ($this->db->delete('visit_types', array('id' => $id))) {
                $this->session->set_flashdata("success", "Data deleted successfully.");
            } else {
                $dbError = $this->db->error();
                $this->session->set_flashdata("error", $dbError);
            }
        } else {
            $this->session->set_flashdata("error", 'Admin/Department user can delete!');
        }

        redirect('Visit_Types/listing');
    }

    function detail($id)
    {
        $data["Title"] = "Detail";
        $data["record"] = $this->Visit_Types_model->visit_typesdetail($id);

        $this->load->view('Visit_Types/detail', $data);
    }


}

