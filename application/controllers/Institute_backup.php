<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Institute extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Institute_model');
		$this->load->model('Doctor_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('url');
    }
    public function index() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('institute/inc/header');
        $this->load->view('institute/dashboard');
        $this->load->view('institute/inc/footer');
    }
    public function add_institute() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->form_validation->set_rules('emis_number', 'Emis Number', 'required');
        $this->form_validation->set_rules('nhs_number', 'Nhs Number', 'required');
        $this->form_validation->set_rules('lab_number', 'Lab Number', 'required');
        $this->form_validation->set_rules('hos_number', 'Hospital Number', 'required');
        $this->form_validation->set_rules('sur_name', 'SurName', 'required');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('clrk', 'Clinical Requesting Work', 'required');
        $this->form_validation->set_rules('date_taken', 'Date Taken', 'required');
        $this->form_validation->set_rules('cl_detail', 'Clinical Detail', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('institute/inc/header');
            $this->load->view('institute/institute_add_request');
            $this->load->view('institute/inc/footer');
        } else {
            $get_serial_number = $this->db->query("SELECT * FROM request ORDER BY id DESC LIMIT 1")->row_array();
            if ($get_serial_number == '') {
                $req_id_before_insert = 1;
            }else{

                $req_id_before_insert = $get_serial_number['id'];
            }
            $serial_query = $this->db->query("SELECT serial_number FROM request WHERE id = $req_id_before_insert" );



            if ($serial_query->num_rows() > 0)
            {
                $row = $serial_query->row();
                $last_inserted_serial_number = $row->serial_number;
                $keyParts = explode('-',$last_inserted_serial_number);
                if($keyParts[1]==date('y')){
                    $key = $keyParts[0]."-".$keyParts[1]."-".($keyParts[2]+1);
                }else{
                    $key = $keyParts[0]."-".date("y")."-1";
                }
            }elseif($serial_query->num_rows() < 0){
                $key = 'UL-'.date('y').'-1';
            }
            else{
                $key = 'UL-'.date('y').'-1';
            }

            //$serial_number;



            //echo $newKey;
            $request = array(
                'serial_number' => $key,
                'emis_number' => $this->input->post('emis_number'),
                'nhs_number' => $this->input->post('nhs_number'),
                'lab_number' => $this->input->post('lab_number'),
                'hos_number' => $this->input->post('hos_number'),
                'sur_name' => $this->input->post('sur_name'),
                'f_name' => $this->input->post('first_name'),
                'dob' => $this->input->post('dob'),
                'gender' => $this->input->post('gender'),
                'clrk' => $this->input->post('clrk'),
                'date_taken' => $this->input->post('date_taken'),
                'urgent' => $this->input->post('urgent'),
                'hsc' => $this->input->post('hsc'),
                'cl_detail' => $this->input->post('cl_detail'),
                'status' => 0,
            );

            $result_request = $this->Institute_model->institute_insert($request);
            $this->Institute_model->request_assign();
			$hos_id = $this->ion_auth->user()->row()->id;
            $req_id = $this->session->userdata('id');
			$work = array('request_id' => $req_id, 'hospital_id' => $hos_id );
			$this->Doctor_model->further_work_add($work);
//            $additional_work_add = array('request_id' => $req_id, 'hospital_id' => $hos_id );
//            $this->Doctor_model->additional_work_add($additional_work_add);
            $this->session->set_flashdata('message', 'Request Submitted.');
            $msg = '<p class="bg-info" style="padding: 7px;">Request Submitted, Please Add Specimen Below.</p>';
            $this->session->set_flashdata('message2', $msg);
            //$this->session->keep_flashdata('message');
            redirect('Institute/show_specimen');
        }
    }
    public function show_requestform() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('institute/inc/header');
        $this->load->view('institute/institute_add_request');
        $this->load->view('institute/inc/footer');

    }
    public function show_specimen() {
        $this->load->view('institute/inc/header');
        $this->load->view('institute/specimen');
        $this->load->view('institute/inc/footer');
    }

    public function add_specimen() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $last_row_id = $this->session->userdata('id');
        $specimen = array(
            'request_id' => $last_row_id,
            'specimen_site' => $this->input->post('specimen_site'),
            'specimen_type' => $this->input->post('specimen_type'),
            'specimen_block' => $this->input->post('specimen_block'),
            'specimen_slides' => $this->input->post('specimen_slides'),
            'specimen_block_type' => $this->input->post('specimen_block_type'),
            'specimen_macroscopic_code' => $this->input->post('specimen_macroscopic_code'),
            'specimen_macroscopic_description' => $this->input->post('specimen_macroscopic_description'),
            'specimen_right' => $this->input->post('specimenright'),
            'specimen_left' => $this->input->post('specimenleft'),
            'specimen_na' => $this->input->post('specimenna'),
            'specimen_urgent' => $this->input->post('specimen_urgent'),
            'specimen_hsc_205' => $this->input->post('specimen_hsc_205')
        );
        $result_specimen = $this->Institute_model->insert_specimen($specimen);

        /*7/27/2015*/
        $this->Institute_model->request_specimen_add();
        /*7/27/2015*/

                $specimen_message = '<p class="bg-info" style="padding:7px;">Specimen Added.</p>';
                $this->session->set_flashdata('message3', $specimen_message);

        redirect('Institute/show_specimen');
    }
    public function finish_specimen(){
        redirect('Institute/index');
    }
     public function view_request_detailall() {
        /*Pagination Start*/

         $config = array();
         $config["base_url"] = base_url() . "index.php/Institute/view_request_detailall";
         $config["total_rows"] = $this->db->where('specimen_publish_status',0)->get('request')->num_rows();
         $config["per_page"] = 10;

         $config['cur_tag_open'] = '&nbsp;<a class="current">';
         $config['cur_tag_close'] = '</a>';
         $config['next_link'] = 'Next';
         $config['prev_link'] = 'Previous';
         $config["num_links"] = $this->db->where('specimen_publish_status',0)->get('request')->num_rows();
         $this->pagination->initialize($config);
         $str_links = $this->pagination->create_links();
         if($this->db->affected_rows() > 0) :
             $data["links"] = explode('&nbsp;',$str_links );
         endif;
         $data["query"] = $this->Institute_model->view_final_record($config["per_page"], $this->uri->segment(3));

         $this->load->view('institute/inc/header');
         $this->load->view('institute/request_view_recored', $data);
         $this->load->view('institute/inc/footer');
    }

    public function view_singlerecord($id) {
        $data1['query1'] = $this->Institute_model->request_singlerecord($id);
        $data2['query2'] = $this->Institute_model->request_singlerecord_specimen($id);
        $result =  array_merge($data1, $data2);
        $this->load->view('institute/inc/header');
        $this->load->view('institute/view_single_record', $result);
        $this->load->view('institute/inc/footer');
    }
     public function view_single_final($id) {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
		 $status = array('publish_status' => 0);
        $this->db->where('id',$id);
        $this->db->update('request',$status);
        $data1['query1'] = $this->Institute_model->doctor_record_detail($id);
        $data2['query2'] = $this->Institute_model->doctor_record_detail_specimen($id);
        $data3['query4'] = $this->Institute_model->get_additional_work($id);
        $result = array_merge($data1, $data2, $data3);
        //$this->load->helper('pdf_helper');
        $this->load->view('institute/view-pdf', $result);
    }
	public function download_pdf($id) {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
		 $status = array('publish_status' => 0);
        $this->db->where('id',$id);
        $this->db->update('request',$status);
        $data1['query1'] = $this->Institute_model->doctor_record_detail($id);
        $data2['query2'] = $this->Institute_model->doctor_record_detail_specimen($id);
        $data3['query4'] = $this->Institute_model->get_additional_work($id);
        $result = array_merge($data1, $data2, $data3);
        //$this->load->helper('pdf_helper');
        $this->load->view('institute/download-pdf', $result);
    }
	 public function further_display_work() {
     
      $data['query'] = $this->Institute_model->further_view();
      $this->load->view('institute/inc/header');
      $this->load->view('institute/display_further_work',$data);
      $this->load->view('institute/inc/footer');
        
    }
	/*Search Functionality Code Start*/
    public function search_request() {
        
        $emis_no = $this->input->post('emis_no');
        $nhs_no = $this->input->post('nhs_no');
        $f_name = $this->input->post('f_name');
        $l_name = $this->input->post('l_name');
        $lab_no = $this->input->post('lab_no');

        $data['query'] = $this->Institute_model->get_search_request($emis_no, $nhs_no, $f_name, $l_name, $lab_no);

        $this->load->view('institute/inc/header');
        $this->load->view('institute/search_result', $data);
        $this->load->view('institute/inc/footer');
        
    }
    /*Search Functionality Code End*/

    /*New Request Page Code Start 24 August 2015*/
    public function published_reports() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $config = array();
        $config["base_url"] = base_url() . "index.php/Institute/published_reports";
        $config["total_rows"] = $this->db->where('specimen_publish_status', 1)->where('publish_status', 1)->get('request')->num_rows();
        $config["per_page"] = 10;

        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $config["num_links"] = $this->db->where('specimen_publish_status', 1)->where('publish_status', 1)->get('request')->num_rows();
        $this->pagination->initialize($config);
        $str_links = $this->pagination->create_links();
        if ($this->db->affected_rows() > 0) :
            $data["links"] = explode('&nbsp;', $str_links);
        endif;
        $data["query"] = $this->Institute_model->institute_record_published($config["per_page"], $this->uri->segment(3));
        
        $this->load->view('institute/inc/header');
        $this->load->view('institute/record_latest', $data);
        $this->load->view('institute/inc/footer');
    }

    /**
     * Viewed Published single Report Data
     */
    public function view_single_published($id) {
        $data1['query1'] = $this->Institute_model->request_singlerecord($id);
        $data2['query2'] = $this->Institute_model->request_singlerecord_specimen($id);
        $result =  array_merge($data1, $data2);

        $status = array('publish_status' => 0);
        $this->db->where('id',$id);
        $this->db->update('request',$status);
        $this->load->view('institute/inc/header');
        $this->load->view('institute/view_single_record', $result);
        $this->load->view('institute/inc/footer');
    }


    /**
     * Viewed Reports
     */
    public function viewed_reports(){
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $config = array();
        $config["base_url"] = base_url() . "index.php/Institute/viewed_reports";
        $config["total_rows"] = $this->db->where('specimen_publish_status',1)->where('publish_status', 0)->get('request')->num_rows();
        $config["per_page"] = 10;

        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $config["num_links"] = $this->db->where('specimen_publish_status',1)->where('publish_status', 0)->get('request')->num_rows();
        $this->pagination->initialize($config);
        $str_links = $this->pagination->create_links();
        if($this->db->affected_rows() > 0) :
            $data["links"] = explode('&nbsp;',$str_links );
        endif;
        $data["query"] = $this->Institute_model->institute_record_viewed($config["per_page"], $this->uri->segment(3));

        $this->load->view('institute/inc/header');
        $this->load->view('institute/viewed_reports', $data);
        $this->load->view('institute/inc/footer');
    }
	
	/**
     * @param type $id
     */
    public function institute_download_section($id) {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $session_data = array(
            'record_id' => $id
        );
        $this->session->set_userdata($session_data);
        //$record_id = $this->session->userdata('record_id');

        /* Get Doctor Files Data 11/12/2015 */
        $files_data["files"] = $this->Institute_model->fetch_files_data();
        /* Get Doctor Files Data 11/12/2015 */

        $this->load->view('institute/inc/header');
        $this->load->view('institute/download_section', $files_data);
        $this->load->view('institute/inc/footer');
    }

    /**
     * @param type $record_id
     */
    public function do_upload($record_id) {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '9000';
//      $config['max_width'] = '1024';
//      $config['max_height'] = '768';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => '<p class="bg-danger" style="padding:7px;">'.$this->upload->display_errors().'</p>');
            $this->session->set_flashdata('upload_error', $error['error']);

            redirect('institute/institute_download_section/' . $record_id, 'refresh');
        } else {

            $user = $this->ion_auth->user()->row()->username;
            $hospital_id = $this->ion_auth->user()->row()->id;
            $data = $this->upload->data();

            $file_id = $this->Institute_model->update_file(
                    $data['file_name'],
                    $data['raw_name'],
                    $data['full_path'],
                    $data['file_ext'],
                    $data['is_image'],
                    $hospital_id,
                    $user
            );

            $uplaod_success = '<p class="bg-success" style="padding:7px;">File Successfully Uploaded.</p>';
            $this->session->set_flashdata('upload_success', $uplaod_success);
            redirect('institute/institute_download_section/' . $record_id, 'refresh');

//            /$this->load->view('doctor/upload_success', $data);
        }
    }

    /**
     * @param type $file_id
     */
    public function delete_record_files($file_id) {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->db->query("DELETE FROM files WHERE files_id = $file_id");
        $file_path = $this->session->userdata('file_path');
        unlink($file_path);
        $record_id = $this->session->userdata('record_id');
        $delete_file = '<p class="bg-warning" style="padding:7px;">File Successfully Deleted.</p>';
        $this->session->set_flashdata('delete_file', $delete_file);
        redirect('institute/institute_download_section/' . $record_id, 'refresh');
    }

}
?>