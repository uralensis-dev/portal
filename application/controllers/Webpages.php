<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Admin Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */
class Webpages extends CI_Controller
{
    /**
     * Constructor to load models and helpers
     */
    public function __construct()
    {
        // echo "ddd";exit;
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Ion_auth_model');
        $this->load->model('Institute_model');
        $this->load->model('Userextramodel');
        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));
        track_user_activity(); //Track user activity function which logs user track actions.
    }

    public function page($pagename="")
    {
        $this->load->view('templates/header-new');
        if($pagename=="projects")
        {
            $this->load->view('pages/project');
        }elseif($pagename=="task")
        {
            $this->load->view('pages/task');
        }elseif($pagename=="leads")
        {
            $this->load->view('pages/leads');
        }elseif($pagename=="ticket")
        {
            $this->load->view('pages/ticket');
        }
        elseif($pagename=="estimates")
        {
        $this->load->view('pages/estimates');
        
        }elseif($pagename=="invoices")
        {
        $this->load->view('pages/invoices');
        }
        elseif($pagename=="Payments")
        {
        $this->load->view('pages/Payments');
        }
        elseif($pagename=="Expenses")
        {
        $this->load->view('pages/Expenses');
        
        }elseif($pagename=="provident-fund")
        {
        $this->load->view('pages/provident-fund');
        
        }elseif($pagename=="taxes")
        {
        $this->load->view('pages/taxes');
        
        }elseif($pagename=="salary")
        {
        $this->load->view('pages/salary');
        
        }elseif($pagename=="salary-view")
        {
        $this->load->view('pages/salary-view');
        
        }elseif($pagename=="payroll-items")
        {
         $this->load->view('pages/payroll-items');
        
        }elseif($pagename=="policies")
        {
        $this->load->view('pages/policies');
        
        }elseif($pagename=="expense-reports")
        {
        $this->load->view('pages/expense-reports');
        
        }elseif($pagename=="invoice-reports")
        {
        $this->load->view('pages/invoice-reports');
        
        }elseif($pagename=="performance-indicator")
        {
         $this->load->view('pages/performance-indicator');
        }
        elseif($pagename=="performance")
        {
         $this->load->view('pages/performance');
        }
        elseif($pagename=="performance-appraisal")
        {
         $this->load->view('pages/performance-appraisal');
        }
        elseif($pagename=="goal-tracking")
        {
         $this->load->view('pages/goal-tracking');
        }
        elseif($pagename=="goal-type")
        {
         $this->load->view('pages/goal-type');
        }
        elseif($pagename=="training")
        {
         $this->load->view('pages/training');
        }
        elseif($pagename=="training")
        {
         $this->load->view('pages/training');
        }
        elseif($pagename=="trainers")
        {
         $this->load->view('pages/trainers');
        }
        elseif($pagename=="training-type")
        {
         $this->load->view('pages/training-type');
        }
        elseif($pagename=="promotion")
        {
         $this->load->view('pages/promotion');
        }
        elseif($pagename=="resignation")
        {
         $this->load->view('pages/resignation');
        }
        elseif($pagename=="termination")
        {
         $this->load->view('pages/termination');
        }





        $this->load->view('templates/footer-new');
    }

    
   
}
