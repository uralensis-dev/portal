<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rota_category extends CI_Controller {

    /**

     * Constructor to load models and helpers

     */
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


        $this->data['dataSet'] = $this->rota->getRotaCategoryList();
        $data['javascripts'] = array('newtheme/_rota/rota.js');
        $data['styles'] = array('');

        $this->load->view('doctor/inc/header-new', $data);
        $this->load->view('_rota/rota_category', $this->data);
        $this->load->view('doctor/inc/footer-new', $data);
    }

    
    public function removeRotaCategory() {
        $ID = $this->input->post('rota_category_id');
        if ($ID != '' && is_numeric($ID)) {
            $this->rota->removeRotaCategory($ID);
            $this->session->set_flashdata('type', 'success');
            $this->session->set_flashdata('tckSuccessMsg', 'Rota Group Removed...');
        } else {
            $this->session->set_flashdata('type', 'error');
            $this->session->set_flashdata('tckSuccessMsg', 'In-Valid Rota Group ID...');
        }
        redirect('_rota/rota_category/', 'refresh');
    }
    
    public function addRotaCategory() {
           $this->load->library('form_validation');
        $validationConfigArr = array(
            array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
            array('field' => 'short_name', 'label' => 'Short Name', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($validationConfigArr);
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', TRUE);
            $this->session->set_flashdata('error_msg', validation_errors());
            redirect('_rota/rota_category/', 'refresh');
        } else {
            $ID = $this->input->post('rota_category_id');
            $RotaCategoryData = array();
            $RotaCategoryData['name'] = $this->input->post('name');
            $RotaCategoryData['short_name'] = $this->input->post('short_name');
            $isUpdate = FALSE;
            if ($ID != '' && $ID != 0) {
                $teamData['modified_by'] = $this->ion_auth->user()->row()->id;
                $teamData['modified_at'] = date('Y-m-d H:i:s');
                $this->rota->updateRotaCategory($RotaCategoryData, $ID);
                $isUpdate = TRUE;
            } else {
                $RotaCategoryData['created_by'] = $this->ion_auth->user()->row()->id;
                $ID = $this->rota->saveRotaCategory($RotaCategoryData);
            }


            $this->session->set_flashdata('inserted', TRUE);
            if ($isUpdate) {
                $this->session->set_flashdata('tckSuccessMsg', 'Rota Group Updated...');
            } else {
                $this->session->set_flashdata('tckSuccessMsg', 'Rota Group Added...');
            }
            redirect('_rota/rota_category/', 'refresh');
        }
    }
    
}
