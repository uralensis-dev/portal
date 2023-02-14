<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Doctor Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */
Class CancerService extends CI_Controller
{
    
    /**
     * Constructor to load models and helpers
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pm_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper(array('url', 'activity_helper', 'dashboard_functions_helper', 'datasets_helper', 'ec_helper'));
        $this->load->library('email');
        // $this->load->library('word');
        $this->load->helper("file");
        $this->load->library('Mybreadcrumb');
        $this->load->model('Userextramodel');
        track_user_activity();
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        return redirect('tumorBoard', 'refresh');
    }
}