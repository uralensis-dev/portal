<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cutaneous_malignant_melanoma_dataset extends CI_Controller {

    public function __construct() {
        error_reporting(0);
        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));
        track_user_activity(); //Track user activity function which logs user track actions.
    }

    public function dashboard() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if ($this->uri->segment(4) != '') {
            $this->load->model('Doctor_model');
            $data['specimen_query'] = $this->Doctor_model->doctor_record_detail_specimen($this->uri->segment(4));
            $data['get_record'] = $data['dataset_cmm'] = get_cmm_dataset_record($this->uri->segment(4), $this->uri->segment(13));
            $data['dataset_cmm_specimen'] = get_cmm_dataset_specimen($this->uri->segment(4));
            if (!empty($data['get_record'])) {
                $this->load->view('templates/header-new');
                $this->load->view('_dataset/cutaneous_malignant_melanoma_dataset/dashboard_edit', $data);
                $this->load->view('templates/footer-new');
            } else {
                $this->load->view('templates/header-new');
                $this->load->view('_dataset/cutaneous_malignant_melanoma_dataset/dashboard', $data);
                $this->load->view('templates/footer-new');
            }
        }
    }

    public function save_record() {
//        _print_r($_POST); die();
        $ins_array = array(
            "record_id" => $this->input->post('record_id'),
            "dataset_id" => $this->input->post('dataset_id'),
            "dataset_type" => $this->input->post('dataset_type'),
            "dataset_title" => $this->input->post('dataset_title'),
            'cmm_data' => json_encode($this->input->post()),
            'cmm_response_html' => $this->input->post('cmm_respons_html'),
            'patient_specimen' => $this->input->post('patient_specimen')
        );

        if ($this->input->post('dataset_record_id') == '') {
            $ins_array['created_by'] = $this->ion_auth->user()->row()->id;
            $this->db->insert('tbl_dataset_record', $ins_array);
        } else {
            $ins_array['modified_by'] = $this->ion_auth->user()->row()->id;
            $ins_array['modified_at'] = date('Y-m-d H:i:s');
            $this->db->where('dataset_record_id', $this->input->post('dataset_record_id'));
            $this->db->update('tbl_dataset_record', $ins_array);
        }

        redirect('doctor/doctor_record_detail_old/' . $this->input->post('record_id'));
    }

    public function removeDatasetbyID($id, $record_id) {
        if ($id != '' && is_numeric($id)) {
            $this->db->where('dataset_record_id', $id);
            $this->db->where('record_id', $record_id);
            $this->db->delete('tbl_dataset_record');
            redirect('doctor/doctor_record_detail_old/' . $record_id);
        }
    }

}
