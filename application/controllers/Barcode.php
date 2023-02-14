<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barcode extends CI_Controller {
	public function __construct(){

        parent::__construct();
		$this->load->model('Barcode_model', 'barcode');
        $this->load->helper(array('url', 'activity_helper'));
        $this->load->helper(array('url', 'activity_helper', 'dashboard_functions_helper', 'datasets_helper', 'ec_helper'));        
	}
    public function index(){
        echo 'Access Denied!';exit;
    }

    public function get_template(){
        $hospital_id =  intval($this->input->get('hospital_id'));
        $data['template'] = $this->barcode->get_template($hospital_id);
        echo json_encode($data['template']);exit;
    }

	public function save_template(){
        // ini_set('display_errors', 1);
		// ini_set('display_startup_errors', 1);
		// error_reporting(E_ALL);
        $ex_patient_name = intval($this->input->post('ex_patient_name'));
        $ex_nhs_no = intval($this->input->post('ex_nhs_no'));
        $ex_dob = intval($this->input->post('ex_dob'));
        $ex_age = intval($this->input->post('ex_age'));
        $ex_gender = intval($this->input->post('ex_gender'));
        $ex_lab_no = intval($this->input->post('ex_lab_no'));
        $ex_contact_no = intval($this->input->post('ex_contact_no'));
        $ex_lab_no2 = intval($this->input->post('ex_lab_no2'));
        $hospital_id = intval($this->input->post('hospital_id'));
        if($hospital_id > 0){
            $data = array(
                'patient_name' => $ex_patient_name,
                'nhs_no' => $ex_nhs_no,
                'dob' => $ex_dob,
                'age' => $ex_age,
                'gender' => $ex_gender,
                'lab_no' => $ex_lab_no,
                'contact_no' => $ex_contact_no,
                'lab_no2' => $ex_lab_no2,
                'hospital_id' => $hospital_id,
            );        
            $record = $this->barcode->get_template($hospital_id);
            if(empty($record)){
                $data['created_by'] = $this->ion_auth->user()->row()->id;
                $result = $this->barcode->save_template($data, 'create'); 
            }else{
                $result = $this->barcode->save_template($data, 'update'); 
            }
            echo $result;exit;
        }else{
            echo 0;exit;
        }
        
	}	
}