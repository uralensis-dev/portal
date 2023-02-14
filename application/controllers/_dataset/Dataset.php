<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dataset extends CI_Controller {

    private $h_data = array('styles' => array('newtheme/css/project_employee.css'));
    private $f_data = array('javascripts' => array('newtheme/js/multiselect.min.js', 'fullcalendar/core/main.js', 'fullcalendar/daygrid/main.js', 'fullcalendar/interaction/main.js', 'newtheme/js/jquery.blockUI.js', 'newtheme/_dataset/datasets.js','js/bcc_dataset.js'));

    public function __construct() {

        parent::__construct();
        error_reporting(0);
        $this->load->model('Ion_auth_model');
        $this->load->model('_dataset/DatasetsModel', 'datasets');
        $this->load->helper(array('form', 'url', 'file', 'cookie', 'activity_helper', 'ec_helper', '_custom_helper/custom_functions_helper'));
        track_user_activity(); //Track user activity function which logs user track actions.
    }

    public function dashboard() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $dataSet['userList'] = $this->datasets->getUsersList();
        $dataset_name = $group_id = $user_id = '';
        if ($_GET) {
            if ($this->input->get('dataset_name') != '') {
                $dataset_name = $this->input->get('dataset_name');
            }
            if ($this->input->get('hospital_id') != '') {
                $hospital_id = $this->input->get('hospital_id');
            }
            if ($this->input->get('specialty_id') != '') {
                $specialty_id = $this->input->get('specialty_id');
            }
        }
        $dataSet['datasetList'] = $this->datasets->getDatasetList($dataset_name, $hospital_id, $specialty_id);
        $this->load->view('templates/header-new', $this->h_data);
        $this->load->view('_dataset/dashboard', $dataSet);
        $this->load->view('templates/footer-new', $this->f_data);
    }

    public function saveData() {
//        _print_r($_POST); die();
        $validationConfigArr = array(
            array('field' => 'dataset_name', 'label' => 'Dataset', 'rules' => 'required'),
            array('field' => 'hospital_id', 'label' => 'Hospital', 'rules' => 'required'),
            array('field' => 'specialty_id', 'label' => 'Specialty', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($validationConfigArr);
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', TRUE);
            $this->session->set_flashdata('error_msg', validation_errors());
            redirect('_dataset/dataset/dashboard/', 'refresh');
        } else {
            $datasetID = $this->input->post('dataset_id');
            $datasetData = array();
            $datasetData['hospital_id'] = $this->input->post('hospital_id');
            $datasetData['specialty_id'] = $this->input->post('specialty_id');
            $datasetData['dataset_name'] = $this->input->post('dataset_name');
            $datasetData['parent_dataset_id'] = $this->input->post('parent_dataset_id');
            $isUpdate = FALSE;
            if ($datasetID != '' && $datasetID != 0) {
                $datasetData['modified_by'] = $this->ion_auth->user()->row()->id;
                $datasetData['modified_at'] = date('Y-m-d H:i:s');
                $this->datasets->updateDataset($datasetData, $datasetID);
                $isUpdate = TRUE;
            } else {
                $datasetData['created_by'] = $this->ion_auth->user()->row()->id;
                $datasetID = $this->datasets->saveDataset($datasetData);
            }


            $this->session->set_flashdata('inserted', TRUE);
            if ($isUpdate) {
                $this->session->set_flashdata('tckSuccessMsg', 'Dataset Updated...');
            } else {
                $this->session->set_flashdata('tckSuccessMsg', 'Dataset Added...');
            }
            redirect('_dataset/dataset/dashboard/', 'refresh');
        }
    }

    public function getDatasetData($datasetID = '') {
        $datasetID = $this->input->post('datasetID');
        $datasetData = $this->datasets->getDatasetData($datasetID);
        echo json_encode($datasetData);
        die();
    }

    public function removeDataset() {
        $datasetID = $this->input->post('dataset_id');
        if ($datasetID != '' && is_numeric($datasetID)) {
            $this->datasets->removeDataset($datasetID);
            $this->session->set_flashdata('type', 'success');
            $this->session->set_flashdata('tckSuccessMsg', 'Dataset Removed...');
        } else {
            $this->session->set_flashdata('type', 'error');
            $this->session->set_flashdata('tckSuccessMsg', 'In-Valid Dataset ID...');
        }
        $this->session->set_flashdata('inserted', TRUE);
        redirect('_dataset/dataset/dashboard/', 'refresh');
    }

    public function getUsers() {
        $groupID = $this->input->post('group_id');
        $userListData = $this->datasets->getUsersList($groupID);
        echo json_encode($userListData);
        die();
    }

}
