<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Admin Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <firebug.j@gmail.com>
 * @version    1.0.0
 */
class Comms extends CI_Controller
{
    
    /**
     * Constructor to load models and helpers
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));
        track_user_activity(); //Track user activity function which logs user track actions.
    }
    
    public function chat()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('comms/inc/header-new');
        $this->load->view('comms/chat', $dataSet);
        $this->load->view('comms/inc/footer-new');
    }
    public function events()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('comms/inc/header-new');
        $this->load->view('comms/events', $dataSet);
        $this->load->view('comms/inc/footer-new');
    }
    public function contacts()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('comms/inc/header-new');
        $this->load->view('comms/contacts', $dataSet);
        $this->load->view('comms/inc/footer-new');
    }
    public function inbox()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('comms/inc/header-new');
        $this->load->view('comms/inbox', $dataSet);
        $this->load->view('comms/inc/footer-new');
    }
    public function file_manager()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('comms/inc/header-new');
        $this->load->view('comms/file_manager', $dataSet);
        $this->load->view('comms/inc/footer-new');
    }
}