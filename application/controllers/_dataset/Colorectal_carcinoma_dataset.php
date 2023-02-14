<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Colorectal_carcinoma_dataset extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('Ion_auth_model');

        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));

        track_user_activity(); //Track user activity function which logs user track actions.
    }

    public function dashboard() {



        if (!$this->ion_auth->logged_in()) {

            redirect('auth/login', 'refresh');
        }

        $this->load->view('_dataset/colorectal_carcinoma_dataset/inc/header-new');
        $this->load->view('_dataset/colorectal_carcinoma_dataset/dashboard', $data);
        $this->load->view('_dataset/colorectal_carcinoma_dataset/inc/footer-new');
    }

    public function dashboard_2() {

        if (!$this->ion_auth->logged_in()) {

            redirect('auth/login', 'refresh');
        }

        $this->load->view('_dataset/colorectal_carcinoma_dataset/inc/header-new');
        $this->load->view('_dataset/colorectal_carcinoma_dataset/mdt2', $data);
        $this->load->view('_dataset/colorectal_carcinoma_dataset/inc/footer-new');
    }

    public function dashboard_3() {

        if (!$this->ion_auth->logged_in()) {

            redirect('auth/login', 'refresh');
        }

        $this->load->view('_dataset/colorectal_carcinoma_dataset/inc/header-new');
        $this->load->view('_dataset/colorectal_carcinoma_dataset/mdt3', $data);
        $this->load->view('_dataset/colorectal_carcinoma_dataset/inc/footer-new');
    }

}
