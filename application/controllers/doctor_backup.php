<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Doctor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('doctor_model');
    }

    public function index() {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('doctor/inc/header');
        $this->load->view('doctor/dashboard');
        $this->load->view('doctor/inc/footer');
    }

    public function doctor_record_list() {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $data['query'] = $this->doctor_model->doctor_record_list();
        $this->load->view('doctor/inc/header');
        $this->load->view('doctor/record_list', $data);
        $this->load->view('doctor/inc/footer');
    }

    public function doctor_record_detail($id) {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $data['query'] = $this->doctor_model->doctor_record_detail($id);
        // print_r($data);
        $session_data = array(
            'id' => $id
        );
        $this->session->set_userdata($session_data);
        $user_id = $this->session->userdata('id');

        $this->load->view('doctor/inc/header');
        $this->load->view('doctor/record_detail', $data);
        $this->load->view('doctor/inc/footer');
    }

    public function generate_report($id) {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $data['query'] = $this->doctor_model->doctor_record_detail($id);
        $this->load->helper('pdf_helper');
        $this->load->view('doctor/pdf', $data);

    }

    public function update_report() {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('doctor/inc/header');
        $this->load->view('doctor/update_recored');
        $this->load->view('doctor/inc/footer');
    }

    public function update_client_report() {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
    $request_id = $this->session->userdata('id');
     
        $spec = array(
            'specimen_microscopic_code' => $this->input->post('specimen_microscopic_code'),
            'specimen_microscopic_description' => $this->input->post('specimen_microscopic_description'),
            'specimen_diagnosis_code' => $this->input->post('specimen_diagnosis_code'),
            'specimen_diagnosis_description' => $this->input->post('specimen_diagnosis_description'),
            'specimen_comment_code' => $this->input->post('specimen_comment_code'),
            'specimen_comment_description' => $this->input->post('specimen_comment_description'),
             'specimen_type' => $this->input->post('specimen_type'),
            'specimen_information_code' => $this->input->post('specimen_information_code'),
            'specimen_information_description' => $this->input->post('specimen_information_description'),
            'specimen_info_save_code' => $this->input->post('specimen_info_save_code'),
            'specimen_info_save_description' => $this->input->post('specimen_info_save_description'),
            'specimen_snomed_code' => $this->input->post('specimen_snomed_code'),
            'specimen_snomed_description' => $this->input->post('specimen_snomed_description')
                
        );
        //print_r($this->session->userdata('id'));die;


        $this->db->where('request_id', $request_id);
        $this->db->update('specimen', $spec);
        $data = array(
            'status' => 1
        );
        $this->db->where('id', $request_id);
        $query = $this->db->update('request', $data);
        print_r($query);
        redirect('doctor/doctor_record_list', 'refresh');
    }

}
