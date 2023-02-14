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
class Performance extends CI_Controller
{
    
    /**
     * Constructor to load models and helpers
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        // $this->load->model('TicketsModel');
        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));
        track_user_activity(); //Track user activity function which logs user track actions.
    }
    
    public function indicator()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('billing/inc/header-new');
        $this->load->view('billing/indicator', $dataSet);
        $this->load->view('billing/inc/footer-new');
    }
    public function review()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('billing/inc/header-new');
        $this->load->view('billing/review', $dataSet);
        $this->load->view('billing/inc/footer-new');
    } 
    public function appraisal()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('billing/inc/header-new');
        $this->load->view('billing/appraisal', $dataSet);
        $this->load->view('billing/inc/footer-new');
    }
    
}