<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class blacklisted extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('blacklist_model');
        $this->load->library('pagination');

        if (!$this->session->userdata('logged_in')) {
            redirect('/');
        }
    }

    function index()
    {
        redirect('blacklisted/listing');
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

        $fetchRecord = $this->blacklist_model->black_listedlisting($start_index, $limit_per_page);
        $total_records = $fetchRecord["total"];
        $data["record"] = $fetchRecord["record"];
        $data["total_rows"] = $fetchRecord["total"];
        $data["per_page"] = $limit_per_page;

        $config["base_url"] = base_url() . "blacklisted/listing";
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

        //$this->load->view('blacklisted/listing', $data);
        $data['page_title'] = 'Visit gates list';
        $this->load->view('common/header', $data);
        $this->load->view('blacklisted/listing', $data);
        $this->load->view('common/footer');

    }


    function remove_from_list()
    {
        $response = [
            'status' => 401,
            'message' => 'error',
            'data' => 'Invalid record id.',
        ];

        if ($this->input->post('id')) {

            $id = (int)$this->input->post('id', true);

            $this->db->where('visit_id', $id)
                ->update("visit", ['status' => 'Pending']);

            $this->db->where('visit_idfk', $id);
            $this->db->delete('black_listed');

//            $this->db->query("DELETE FROM black_listed WHERE visit_idfk = '" . $id . "'");
            $response['status'] = 200;
            $response['message'] = 'success';
            $response['data'] = 'User has been removed from blacklist.';
        }

        echo json_encode($response);
    }
}

?>