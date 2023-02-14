<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rota_inner_category extends CI_Controller {

    private $h_data = array('styles' => array('newtheme/css/rota_custom.css'));
    private $f_data = array('javascripts' => array('newtheme/plugins/timepicker/jquery.timepicker.js', 'newtheme/js/multiselect.min.js', 'js/rota/app.js'));

    public function __construct() {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->load->model('_rota/RotaModel', 'rota');
        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'ec_helper', '_custom_helper/custom_functions_helper'));
        track_user_activity(); //Track user activity function which logs user track actions.
    }

    public function index($team_id = '') {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->data['dataSet'] = $this->rota->getRotaInnerCategoryList();
        $this->load->view('templates/header-new', $this->h_data);
        $this->load->view('_rota/rota_inner_category', $this->data);
        $this->load->view('templates/footer-new', $this->f_data);
    }

    
    public function removeRotaInnerCategory() {
        $ID = $this->input->post('rota_inner_category_id');
        if ($ID != '' && is_numeric($ID)) {
            $this->rota->removeRotaInnerCategory($ID);
            $this->session->set_flashdata('type', 'success');
            $this->session->set_flashdata('tckSuccessMsg', 'Rota Category Removed...');
        } else {
            $this->session->set_flashdata('type', 'error');
            $this->session->set_flashdata('tckSuccessMsg', 'In-Valid Rota Category ID...');
        }
        redirect('_rota/rota_inner_category/', 'refresh');
    }
    
    public function addRotaInnerCategory() {
        $this->load->library('form_validation');
        $validationConfigArr = array(
            array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
            array('field' => 'short_name', 'label' => 'Short Name', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($validationConfigArr);
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', TRUE);
            $this->session->set_flashdata('error_msg', validation_errors());
            redirect('_rota/rota_inner_category/', 'refresh');
        } else {
            $ID = $this->input->post('rota_inner_category_id');
            $RotaInnerCategoryData = array();
            $RotaInnerCategoryData['name'] = $this->input->post('name');
            $RotaInnerCategoryData['short_name'] = $this->input->post('short_name');
            $isUpdate = FALSE;
            if ($ID != '' && $ID != 0) {
                $teamData['modified_by'] = $this->ion_auth->user()->row()->id;
                $teamData['modified_at'] = date('Y-m-d H:i:s');
                $this->rota->updateRotaInnerCategory($RotaInnerCategoryData, $ID);
                $isUpdate = TRUE;
            } else {
                $RotaInnerCategoryData['created_by'] = $this->ion_auth->user()->row()->id;
                $ID = $this->rota->saveRotaInnerCategory($RotaInnerCategoryData);
            }


            $this->session->set_flashdata('inserted', TRUE);
            if ($isUpdate) {
                $this->session->set_flashdata('tckSuccessMsg', 'Rota Category Updated...');
            } else {
                $this->session->set_flashdata('tckSuccessMsg', 'Rota Category Added...');
            }
            redirect('_rota/rota_inner_category/', 'refresh');
        }
    }
    
}
