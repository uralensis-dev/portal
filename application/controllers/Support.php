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
class Support extends CI_Controller
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
        $this->load->model('Laboratory_model');
        track_user_activity(); //Track user activity function which logs user track actions.
    }
    
    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('support/inc/header-new');
        $this->load->view('support/dashboard');
        $this->load->view('support/inc/footer-new');
    }
    public function faq()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('support/inc/header-new');
        $this->load->view('support/faq');
        $this->load->view('support/inc/footer-new');
    }

    public function requestor_histology_nnuh_new()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('support/inc/header-new');
        $this->load->view('pages/requestor');
        $this->load->view('support/inc/footer-new');
    }

    public function requestor_histology_nnuh_redesigned()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('support/inc/header-new');
        $this->load->view('pages/requestor_redesigned');
        $this->load->view('support/inc/footer-new');
    }

    public function requestor_histology_nnuh()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
 		$data['javascripts'] = array('js/further-request.js');
       
        $data['styles'] = [];

        //Get all level 1
        $data['test_categories'] = $this->Laboratory_model->get_laboratory_test_hirarchy(null, 1);
        //Get all childrens
        $data['complete_records'] = [];
        if(is_array($data['test_categories']) && !empty($data['test_categories'])){
            foreach ($data['test_categories']as $test_category){
                $data['complete_records'][]= [
                    'text' => $test_category['name'],
                    'nodes' => $this->Laboratory_model->get_test_category_hirarchy_children($test_category['id'], $test_category['level']),
                    'id' => $test_category['id'],
                    'parent_id' => $test_category['id'],
                    'level' => $test_category['level'],
                    'has_level' => $test_category['has_level'],
                ];
            }
        }

        $test_columns = ['lt.id','lt.name', 'lt.cost', 'lt.sale', 'lt.test_id'];
        if(is_array($data['complete_records']) && !empty($data['complete_records'])){
            foreach ($data['complete_records'] as $first_level_key => $first_level_record){
                if(is_null($first_level_record['has_level'])){
                    $data['complete_records'][$first_level_key]['tests'] =  $this->Laboratory_model->getCategoryTests($first_level_record['id'], $test_columns);
                }

                if($first_level_record['has_level'] == 1)
				{
                    foreach ($first_level_record['nodes'] as $second_level_key => $second_level_record)
                        $data['complete_records'][$first_level_key]['nodes'][$second_level_key]['tests'] =  $this->Laboratory_model->getCategoryTests($first_level_record['id'], $test_columns);
                }

                if($first_level_record['has_level'] == 2){
                    foreach ($first_level_record['nodes'] as $second_level_key => $second_level_record)
                        foreach ($second_level_record['nodes'] as $third_level_key => $third_level_record){
                            $data['complete_records'][$first_level_key]['nodes'][$second_level_key]['nodes'][$third_level_key]['tests'] =  $this->Laboratory_model->getCategoryTests($third_level_record['id'], $test_columns);
                        }
                }
            }
        }

		$data['lab_number']=$this->get_lab_numbers();
        $this->load->view('support/inc/header-new');
        $this->load->view('pages/requestor_new', $data);
        $this->load->view('support/inc/footer-new');
    }


//    protected function get_test_data_hierarchy (&$records){
//
//        //Get Test Records on for those who has "has_level" not null
//        if(is_array($records && !empty($records))){
//            foreach ($records as $key => &$record){
//                if(is_null($record['has_leve'])){
//                    $record['test'] = $this->Laboratory_model->getCategoryTests($record['id'], ['lt.name']);
//                }else{
//                    $this->get_test_data_hierarchy($record);
//                }
//            }
//        }
//    }


    public function get_test_data()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $parent_id = $this->input->post('parent_id');
        $level = $this->input->post('level');

        //Get all childrens of first object
        $data['test_subCategories'] = $this->Laboratory_model->get_test_category_hirarchy_children($parent_id, $level);
        if(is_array($data['test_subCategories']) && !empty($data['level1_test_subCategories'])){
            foreach ($data['test_subCategories'] as $key => $level1_test_subCategory){
                $data['test_subCategories'][$key]['tests'] = $this->Laboratory_model->getCategoryTests ($level1_test_subCategory['id'], ['lt.name']);
            }
        }


        echo json_encode($data);
        exit();

    }
	
	public function get_lab_numbers() {
        if (!in_array($this->group_type, ['H', 'A', 'L'])) {
           // $this->output->set_status_header(405);
           // return;
        }

        if ($this->group_type === 'L') 
		{
            $hospitals = $this->db
                ->select('hospital_id')
                ->where('group_id', $this->group_id)
                ->get('hospital_group')->result_array();    
            $hospital_ids = [];
            foreach($hospitals as $h) 
			{
                array_push($hospital_ids, $h['hospital_id']);
            }
            $ids = implode(",", $hospital_ids);
            $this->db->select('DISTINCT `lab_number`', FALSE);
            $this->db->join('users_request', 'users_request.request_id = request.uralensis_request_id', 'INNER');
            $this->db->where("`group_id` IN ($ids)", '', FALSE);
            $this->db->where('lab_number IS NOT NULL', '', FALSE);
            $lab_numbers =$this->db->get('request')->result_array();
            $lab = [];
            foreach ($lab_numbers as $ln) {
                array_push($lab, $ln['lab_number']);
            }
            $this->output->set_content_type('application/json')
            ->set_output(json_encode($lab));
        } else {
            $this->db->select('DISTINCT `lab_number`', FALSE);
            
            if ($this->group_type === 'HA') {
                $this->db->join('users_request', 'users_request.request_id = request.uralensis_request_id', 'INNER');
                $this->db->where('group_id', $this->group_id);
            }
            
            $this->db->where('lab_number IS NOT NULL', '', FALSE);
            $lab_numbers =$this->db->get('request')->result_array();
            $lab = [];
            foreach ($lab_numbers as $ln) {
                array_push($lab, $ln['lab_number']);
            }
            return $lab;
        }
    }
    
}