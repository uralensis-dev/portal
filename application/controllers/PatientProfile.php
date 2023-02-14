<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Admin Controller
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <firebug.j@gmail.com>
 * @version    1.0.0
 */

class PatientProfile extends CI_Controller

{
    /**
     * Constructor to load models and helpers
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->load->model('Doctor_model');
        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));

        track_user_activity(); //Track user activity function which logs user track actions.

    }

     public function dashboard(){

        

        if (!$this->ion_auth->logged_in()) {

            redirect('auth/login', 'refresh');

        }

        $this->load->view('patient-profile/inc/header');
        $this->load->view('patient-profile/dashboard');
        $this->load->view('patient-profile/inc/footer');

    }

    public function patient_profile(){

        

        if (!$this->ion_auth->logged_in()) {

            redirect('auth/login', 'refresh');

        }

        $this->load->view('patient-profile/inc/header-new');
        $this->load->view('patient-profile/patient_profile');
        $this->load->view('patient-profile/inc/footer-new');

    }

    public function request_investigation(){

        

        if (!$this->ion_auth->logged_in()) {

            redirect('auth/login', 'refresh');

        }

        $this->load->view('patient-profile/inc/header-new');
        $this->load->view('patient-profile/request_investigation');
        $this->load->view('patient-profile/inc/footer-new');

    }

}