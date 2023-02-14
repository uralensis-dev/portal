<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Breast_cancer_dataset extends CI_Controller {

    public function __construct() {

        parent::__construct();

        error_reporting(0);

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
            $data['get_record'] = $data['dataset_breast_cancer'] = get_breast_cancer_dataset_record($this->uri->segment(4), $this->uri->segment(13));
            $data['dataset_breast_cancer_specimen'] = get_breast_cancer_dataset_specimen($this->uri->segment(4));

            if (!empty($data['get_record'])) {
                $this->load->view('templates/header-new');
                $this->load->view('_dataset/breast_cancer_dataset/dashboard_edit', $data);
                $this->load->view('templates/footer-new');
            } else {
                $this->load->view('templates/header-new');
                $this->load->view('_dataset/breast_cancer_dataset/dashboard', $data);
                $this->load->view('templates/footer-new');
            }
        }
    }

    public function save_record() {
        $ins_array = array(
            "record_id" => $this->input->post('record_id'),
            "dataset_id" => $this->input->post('dataset_id'),
            "dataset_type" => $this->input->post('dataset_type'),
            "dataset_title" => $this->input->post('dataset_title'),
            "specimen_sides" => $this->input->post('specimen_sides'),
            "specimen_type_select" => $this->input->post('specimen_type_select'),
            "specimen_radio_seen" => $this->input->post('specimen_radio_seen'),
            "memo_absormality" => $this->input->post('memo_absormality'),
            "core_biopsy_seen" => $this->input->post('core_biopsy_seen'),
            "histological_calcification" => $this->input->post('histological_calcification'),
            "Benign_lesions" => $this->input->post('Benign_lesions'),
            "Epithelial_proliferation" => $this->input->post('Epithelial_proliferation'),
            "Invasive_carcinoma" => $this->input->post('Invasive_carcinoma'),
            "Size_and_extent" => $this->input->post('Size_and_extent'),
            "Invasive_tumour_type" => $this->input->post('Invasive_tumour_type'),
            "Histological_grade" => $this->input->post('Histological_grade'),
            "Lymphovascular_invasion" => $this->input->post('Lymphovascular_invasion'),
            "Residual_tumour_size_and_extent" => $this->input->post('Residual_tumour_size_and_extent'),
            "Residual_invasive_tumour_type" => $this->input->post('Residual_invasive_tumour_type'),
            "Residual_tumour_histological_grade" => $this->input->post('Residual_tumour_histological_grade'),
            'breast_cancer_data' => json_encode($this->input->post()),
            'breast_cancer_response_html' => $this->input->post('breast_cancer_response_html'),
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
//            $this->session->set_flashdata('type', 'success');
//            $this->session->set_flashdata('tckSuccessMsg', 'Dataset Removed...');
            redirect('doctor/doctor_record_detail_old/' . $record_id);
        }
//        else {
//            $this->session->set_flashdata('type', 'error');
//            $this->session->set_flashdata('tckSuccessMsg', 'In-Valid Dataset...');
//        }
    }

}
