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
class Employee extends CI_Controller
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
    
    public function staff()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('employee/inc/header-new');
        $this->load->view('employee/dashboard', $dataSet);
        $this->load->view('employee/inc/footer-new');
    }

    public function holidays()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('employee/inc/header-new');
        $this->load->view('employee/holidays', $dataSet);
        $this->load->view('employee/inc/footer-new');
    }
    public function admin_leaves()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('employee/inc/header-new');
        $this->load->view('employee/leaves/admin_leaves', $dataSet);
        $this->load->view('employee/inc/footer-new');
    }
    public function employee_leaves()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('employee/inc/header-new');
        $this->load->view('employee/leaves/employee_leaves', $dataSet);
        $this->load->view('employee/inc/footer-new');
    }
    public function leave_settings()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('employee/inc/header-new');
        $this->load->view('employee/leaves/leave_settings', $dataSet);
        $this->load->view('employee/inc/footer-new');
    }
    public function admin_attendance()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('employee/inc/header-new');
        $this->load->view('employee/attendance/admin_attendance', $dataSet);
        $this->load->view('employee/inc/footer-new');
    }
    public function employee_attendance()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('employee/inc/header-new');
        $this->load->view('employee/attendance/employee_attendance', $dataSet);
        $this->load->view('employee/inc/footer-new');
    }
    public function departments()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('employee/inc/header-new');
        $this->load->view('employee/departments', $dataSet);
        $this->load->view('employee/inc/footer-new');
    }
    public function designations()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('employee/inc/header-new');
        $this->load->view('employee/designations', $dataSet);
        $this->load->view('employee/inc/footer-new');
    }
    public function timesheet()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('employee/inc/header-new');
        $this->load->view('employee/timesheet', $dataSet);
        $this->load->view('employee/inc/footer-new');
    }
    public function overtime()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('employee/inc/header-new');
        $this->load->view('employee/overtime', $dataSet);
        $this->load->view('employee/inc/footer-new');
    }
       
    
    
}