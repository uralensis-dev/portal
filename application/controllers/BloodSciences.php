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

class BloodSciences extends CI_Controller

{

    /**

     * Constructor to load models and helpers

     */

    public function __construct()

    {

        parent::__construct();

        $this->load->model('Ion_auth_model');

        $this->load->model('TicketsModel');

        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));

        track_user_activity(); //Track user activity function which logs user track actions.

    }



    public function index(){

        

        if (!$this->ion_auth->logged_in()) {

            redirect('auth/login', 'refresh');

        }
        $data = 0;

        $this->load->view('blood-sciences/inc/header-new');
        $this->load->view('blood-sciences/dashboard', $data);
        $this->load->view('blood-sciences/inc/footer-new');

    }
    public function record_details(){

        

        if (!$this->ion_auth->logged_in()) {

            redirect('auth/login', 'refresh');

        }
        $data = 0;

        $this->load->view('blood-sciences/inc/header-new');
        $this->load->view('blood-sciences/record_details', $data);
        $this->load->view('blood-sciences/inc/footer-new');

    }

}