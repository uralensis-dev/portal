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
class Invoice extends CI_Controller
{

    /**
     * Constructor to load models and helpers
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->load->model('invoice_model');
        $this->load->model('billing_model');
        $this->load->model('departmentModel');
        $this->load->model('laboratory_model', "lab");
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language', 'cookie', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');

        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));
        track_user_activity(); //Track user activity function which logs user track actions.

        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;

        if ($group_type != 'A') {
            // return redirect('', 'refresh');
        }
    }

    public function billingCodeList()
    {
//        echo "<pre>";
//        print_r($this->session->all_userdata()); exit; 


        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $h_data = array('styles' => array());
        $f_data = array('javascripts' => array(
            '/assets/js/laboratory.js',
        ));

        $userId = $this->session->userdata('user_id');
        $groupId = $this->ion_auth->get_users_main_groups()->row()->id;

        $data = array();
        // $data["result"] = $this->invoice_model->priceCodeListing($groupId);
        $data['result'] = $this->billing_model->getClinicBillingData($groupId);
        $data["billing_codes"] = $this->invoice_model->getBillingCodes();

    //    echo "<pre>";
    //    print_r($data["result"]); 
    //    exit; 

        $this->load->view('templates/header-new');
        $this->load->view('invoice/pricing', $data);
        $this->load->view('templates/footer-new');
    }

    public function addBillingCode()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $userId = $this->session->userdata('user_id');
        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $groupId = $this->ion_auth->get_users_groups()->row();

        $data = array();
        // $data["lab_test_category"] = $this->invoice_model->getLabTests();
//         $data["lab_departments"] = $this->invoice_model->getLabDepartments();
//         $data["test_categories"] = $this->invoice_model->getLabTests();
//         $data['speciality_groups'] = $this->lab->get_speciality_group_data();

//         print_r($data["test_categories"]); 
//         exit; 

//         echo "<pre>";
//         print_r($data["lab_departments"]); exit; 
        //$data["labData"] = $this->departmentModel->get_laboratory_department($groupId->id);
        $data["billing_codes"] = $this->invoice_model->getBillingCodes();
        $data["pathhub_index"] = "PHA-" . date("d") . "-" . rand(1000, 9999); #4 digits random number

        #Lab categories 
//        $testCategories = array();
//        foreach ($data["labData"] as $labKey => $labValue) {
//            foreach ($labValue["specialties"] as $sepKey => $sepValue) {
//                $testCategories[] = $sepValue["test_categories"];
//            }
//        }
        // $data["test_categories"] = $testCategories[0];

        $this->form_validation->set_rules('billing_price', 'Rate', 'required');
        $this->form_validation->set_rules('billing_code[]', 'Billing Code', 'required');
        $this->form_validation->set_rules('billing_code_name[]', 'Code Name', 'required');

        if ($this->form_validation->run() === TRUE) {
            $POST = $this->input->post(NULL, true);
//            echo "<pre>";
//            print_r($POST); 
//            exit; 

//            $addData = array(
//                "lab_department" => $POST["lab_departments"],
//                "lab_specialty" => $POST["lab_specialty"],
//                "lab_test_categories" => $POST["lab_test_categories"],
//                "group_id" => $groupId->id,
//                "rate" => $POST["billing_price"],
//                "country" => $POST["country"],
//               
//                "description" => $POST["description"],
//                "created_at" => date("U"),
//                "created_by" => $userId
//            );
//
//            $this->db->insert('uralensis_pricing_setup', $addData);

//            if ($this->db->affected_rows() > 0) {
//
//                $setupId = $this->db->insert_id();

            if (count($POST["code_type"]) > 0) {
                $codeData = array();
                $i = 0;
                foreach ($POST["code_type"] as $codeType) {
                    $codeData[$i]["code_type"] = $codeType;
                    $b = 0;
                    foreach ($POST["billing_code"] as $billingCode) {
                        $codeData[$b]["billing_code"] = $billingCode;
                        $b++;
                    }

                    $c = 0;
                    foreach ($POST["billing_code_name"] as $billing_code_name) {
                        $codeData[$c]["billing_code_name"] = $billing_code_name;
                        $c++;
                    }

                    $i++;
                }


                foreach ($codeData as $cKey => $cValue) {
                    $codeEntry = array(
                        "code_type" => $cValue["code_type"],
                        "billing_code" => $cValue["billing_code"],
                        "billing_code_name" => $cValue["billing_code_name"],
                        "billing_rate" => $POST["billing_price"],
                        "country" => $POST["country"],
                        "description" => $POST["description"],
                        "created_at" => date("U"),
                        "created_by" => $userId,


                    );

                    $this->db->insert('uralensis_billing_code_setup', $codeEntry);
                }
            }
            redirect('invoice/billingCodeList?a=1');
            // $data['success'] = $this->session->set_flashdata('message', 'Successfully added');
            //}
            //echo $this->db->last_query(); exit; 
        }
        // print_r(validation_errors()); exit; 

        $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));


        $this->load->view('templates/header-new');
        $this->load->view('invoice/create_pricing', $data);
        $this->load->view('templates/footer-new');
    }

    public function editBillingCode()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $userId = $this->session->userdata('user_id');
        $data = array();


        $this->form_validation->set_rules('edit_id', 'ID', 'required');
        $this->form_validation->set_rules('code_type', 'Code Type', 'required');
        $this->form_validation->set_rules('billing_price', 'Rate', 'required');
        $this->form_validation->set_rules('billing_code', 'Billing Code', 'required');
        $this->form_validation->set_rules('billing_code_name', 'Code Name', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');

        if ($this->form_validation->run() === TRUE) {
            $edit_id = $this->input->post("edit_id");
            $codeEntry = array(
                "code_type" => $this->input->post("code_type"),
                "billing_code" => $this->input->post("billing_code"),
                "billing_code_name" => $this->input->post("billing_code_name"),
                "billing_rate" => $this->input->post("billing_price"),
                "country" => $this->input->post("country"),
                "description" => $this->input->post("description")
            );

            $retStatus = $this->db->where(array("id"=>$edit_id))->update('uralensis_billing_code_setup', $codeEntry);
            if($retStatus){
                $response['status'] = "success";
                $response['msg'] = "Data updated successfully";
            } else {
                $response['status'] = "fail";
                $response['msg'] = "There might be some error. Please try again.";
            }
        } else {
            $response['status'] = "fail";
            $response['msg'] = validation_errors();
        }
        echo json_encode($response);exit;
    }

    public function deleteBillingCode($dataId)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $retStatus = $this->db->delete("uralensis_billing_code_setup",array("id"=>$dataId));
        redirect("invoice/billingCodeList");
    }


    public function details()
    {
//        echo "<pre>";
//        print_r($this->session->all_userdata()); exit; 


        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $h_data = array('styles' => array());
        $f_data = array('javascripts' => array(
            '/assets/js/laboratory.js',
        ));

        $id = $this->uri->segment(3);

        $data = array();
        $data["result"] = $this->invoice_model->priceCodeRecord($id);
        $data["priceCode"] = $this->invoice_model->getCodeDetails($id);


//        echo "<pre>";
//        print_r( $data["priceCode"]); 
//        exit; 

        $this->load->view('templates/header-new');
        $this->load->view('invoice/view_detail', $data);
        $this->load->view('templates/footer-new');
    }

    public function details__()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('billing/inc/header-new');
        $this->load->view('billing/view-invoice');
        $this->load->view('billing/inc/footer-new');
    }

}
