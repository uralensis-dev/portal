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
class ShortCodes extends CI_Controller
{
    
    /**
     * Constructor to load models and helpers
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Doctor_model');
        $this->load->model('Ion_auth_model');
        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));
        track_user_activity(); //Track user activity function which logs user track actions.
    }
    
    public function dashboard()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $data['micro_codes'] = $this->Doctor_model->get_all_microscopic_codes();

        $this->load->view('short_codes/inc/header-new');
        $this->load->view('short_codes/dashboard', $data);
        $this->load->view('short_codes/inc/footer-new');
    }
}