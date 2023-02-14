<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Department extends CI_Controller
{
    private $h_data = array('styles' => array('css/linearicons.css', 'css/department/style.css'));
    private $f_data = array('javascripts' => array(
        'js/jsrender.min.js',
        'js/jsviews.min.js',
        'js/department/script.js',
    ));

    private $group_id = 0;
    private $user_id = 0;
    private $group_type = "";

    /**
     * Constructor to load models and helpers
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        // Libs and helper
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language', 'cookie', 'activity_helper', 'dashboard_functions_helper', 'ec_helper','globalfunctions_helper'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->load->model('DepartmentModel', 'department');
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            return redirect('', 'refresh');
        }
        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;

        if ($group_type != 'A' && $group_type != 'H' && $group_type != 'HA' && $group_type != 'L' && $group_type != 'LA') {
            //return redirect('', 'refresh');
        }

        $this->user_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_groups()->row();
        $this->group_type = $group_row->group_type;
        $this->group_id = $group_row->id;

        // Load language
        $this->lang->load('department');

    }

    public function index()
    {
        $getResult = $this->ion_auth->get_users_main_groups()->row();		
        if (in_array($group_type,HOSPITAL_GROUP)) {
            return redirect("/department/institute/" . $getResult->id, "refresh");
        }
        if (in_array($this->group_type,LAB_GROUP)) {
            return redirect("/department/laboratory/" . $getResult->id, "refresh");
        }
        redirect("/department/institute", "refresh");
    }

    public function institute($hospital_id = "")
    {
//        if(empty($hospital_id)){
//            $hospital_id = $this->group_id;
//        }

        $data = array();
        if (in_array($group_type,HOSPITAL_GROUP)) 
		{
            $getResult = $this->ion_auth->get_users_main_groups()->row();

            if (empty($hospital_id) || $hospital_id != $getResult->id) {
//                echo "<pre>";print_r($getResult);exit;
                // Redirect to institute
                return redirect("/department/institute/" . $getResult->id, "refresh");
            }
        }

        if ($this->group_type == "A") {
            $data['hospitals'] = $this->department->fetch_hospitals();
        }
        else if($this->group_type == "HA"){
           $data['hospitals'] =  $this->db->get_where('groups', array('group_type' => 'H'))->result_array();
        }
        else if($this->group_type == "LA"){
            $data['hospitals'] =  $this->db->get_where('groups', array('group_type' => 'H'))->result_array();
         }
        else{
            $data['hospitals'][0] = (array) $getResult;
        }

        if (!empty($hospital_id)) 
		{
            try {
                $data['departments'] = $this->department->get_hospital_department($hospital_id);
                $data['hospital'] = $this->db->get_where('groups', array('id' => $hospital_id))->result_array()[0];
                $data['template_departments'] = $this->department->fetch_departments();
                // echo "<pre>"; print_r(json_encode($data));die;
            } catch (Exception $e) {
                show_404();
                return;
            }
        }

        $data['group_type'] = $this->group_type;
       

        array_push($this->f_data['javascripts'], 'js/department/hospital.js');
       
        $this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('department/department.php', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);
    }

    public function laboratory($laboratory_id = "")
    {
        $data = array();
        if (in_array($this->group_type,LAB_GROUP)) {
            $getResult = $this->ion_auth->get_users_main_groups()->row();
            if (empty($laboratory_id) || $laboratory_id != $getResult->id) {
                // Redirect to institute
                return redirect("/department/laboratory/" . $this->group_id, "refresh");
            }
        }

        if ($this->group_type == "A") {
            $data['hospitals'] = $this->department->fetch_hospitals();
        }else{
            $data['hospitals'][0] = (array) $getResult;
        }

        if (!empty($laboratory_id)) {
            try {
                $data['departments'] = $this->department->get_laboratory_department($laboratory_id);
                custom_log($data['departments'], "Department");
                $data['hospital'] = $this->db->get_where('groups', array('id' => $laboratory_id))->result_array()[0];
                $data['template_departments'] = $this->department->fetch_departments();
            } catch (Exception $e) {
                show_404();
                return;
            }
        }

        $data['group_type'] = $this->group_type;
        
        #add section of Test Categories
        $data["testMainCategories"] = getMainTestCategories();
        $testSubCategoryArr = array();
            $i = 0;
            foreach ($data["testMainCategories"] as $mainCatArray => $mainCatValue) {

                $getSubCatAgainstMain = getSubTestCatAgainstMainCat($mainCatValue["id"]);
                //  print_r($getSubCatAgainstMain ); exit; 
                $testSubCategoryArr["main_cat"][$i]["main_cat_name"] = $mainCatValue["name"];
                $testSubCategoryArr["main_cat"][$i]["main_cat_id"] = $mainCatValue["id"];
                $s = 0;
                foreach ($getSubCatAgainstMain as $subValue => $subKey) {
                    //$testSubCategoryArr["main_cat"][$i][$mainCatValue["name"]]["sub_cat"][$s]["sub_cat_id"] = $subKey["id"];
                    $testSubCategoryArr["main_cat"][$i]["sub_cat"][$s]["sub_cat_name"] = $subKey["name"];
                    $testSubCategoryArr["main_cat"][$i]["sub_cat"][$s]["sub_cat_id"] = $subKey["id"];
                    $testSubCategoryArr["main_cat"][$i]["sub_cat"][$s]["main_cat_id"] = $subKey["main_category_id"];
                    
                 #Add tests under sub Categories
                    $t = 0;
                   $subCategoriesTests = getTestAgsinstSubCat($subKey["id"]);
                   foreach($subCategoriesTests as $testKey => $testValue){
                        $testSubCategoryArr["main_cat"][$i]["sub_cat"][$s]["tests"][$t]["test_id"] = $testValue["id"];
                        $testSubCategoryArr["main_cat"][$i]["sub_cat"][$s]["tests"][$t]["test_name"] = $testValue["name"];
                        $t++;
                   }
                    
                   
                   $s++;
                    
                    
                }

                $i++;
            }

            $data["test_sub_categories"] = $testSubCategoryArr;


        $lab_id = $this->group_id;


        $getLabArea = $this->db->select("*")->where(array("lab_id"=>$lab_id))->get("lab_support_area")->result();

        $data['lab_areas'] = $getLabArea;
//            print_r($data["test_sub_categories"]);
//            exit;
        
        
        array_push($this->f_data['javascripts'], 'js/department/laboratory.js');

        $this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('department/department_labs.php', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);
    }


    public function add_hospital_department()
    {
        if ($this->input->method() != 'post') {
            $this->output
                ->set_status_header(405);
            return;
        }

        $hospital_id = $this->input->post("hospital_id", TRUE);
        $template = $this->input->post("template", TRUE);
        $departments = $this->input->post("departments", TRUE);
		$division = $this->input->post("division", TRUE);


        if (!is_numeric($hospital_id) || empty($template)) {
            $this->output
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        if ($template == "true") {
            
            if (!is_array($departments)) {
                $this->output
                    ->set_status_header(400)
                    ->set_output($this->lang->line("msg_400"));
                return;
            }

            $template_departments = $this->department->fetch_departments($departments);
            foreach ($template_departments as $d_id => $department) {
                try {
                    $new_d_id =  $this->department->add_hospital_department($hospital_id, $department['name'], $this->user_id,$division);
                    foreach ($department['specialties'] as $s_id => $specialty) {
                        try {
     $new_s_id = $this->department->add_hospital_specialty($hospital_id, $new_d_id, $specialty['name'], $this->user_id,$division);

                            foreach ($specialty['categories'] as $c_id => $category) {
                                try {
                                    $this->department->add_hospital_category($hospital_id, $new_d_id, $new_s_id, $category['name'], $category['pa'], $this->user_id,$division);
                                } catch (Exception $e) {
                                    custom_log($e->getCode(), "Error Occurred at Category level: " . $e->getMessage());
                                    if ($e->getCode() === 400) {
                                        continue;
                                    } else {
                                        throw $e;
                                    }
                                }
                            }
                            foreach ($specialty['specimen_types'] as $t_ct => $specimen_type) {
                                try {
                                    $this->department->add_hospital_specimen_type($hospital_id, $new_d_id, $new_s_id, $specimen_type['name'], $this->user_id);
                                } catch (Exception $e) {
                                    custom_log($e->getCode(), "Error Occurred at Specimen Type level: " . $e->getMessage());
                                    if ($e->getCode() === 400) {
                                        continue;
                                    } else {
                                        throw $e;
                                    }
                                }
                            }
                            foreach ($specialty['test_categories'] as $test_category) {
                                try {
                                    $this->department->add_hospital_test_category($hospital_id, $new_d_id, $new_s_id, $test_category['name']);
                                } catch (Exception $e) {
                                    custom_log($e->getCode(), "Error Occurred at Test Category level: " . $e->getMessage());
                                    if ($e->getCode() === 400) {
                                        continue;
                                    } else {
                                        throw $e;
                                    }
                                }
                            }


                        } catch (Exception $e) {
                            custom_log($e->getCode(), "Error Occurred at Specialty level: " . $e->getMessage());
                            if ($e->getCode() === 400) {
                                continue;
                            } else {
                                throw $e;
                            }
                        }
                    }
                } catch (Exception $e) {
                    custom_log($e->getCode(), "Error Occurred at department level: " . $e->getMessage());
                    if ($e->getCode() === 400) {
                        continue;
                    } else {
                        $this->output
                            ->set_status_header(404)
                            ->set_output($this->lang->line("hospital_404"));
                        return;
                    }
                }
            }
        } else if ($template == "false") {
            if (empty($departments) || !is_string($departments)) {
                $this->output
                    ->set_status_header(400)
                    ->set_output($this->lang->line("msg_400"));
                return;
            }
            try {
                $this->department->add_hospital_department($hospital_id, $departments, $this->user_id,$division);
            } catch (Exception $e) {
                if ($e->getCode() == 404) {
                    $this->output
                        ->set_status_header(404)
                        ->set_output($this->lang->line("hospital_404"));
                } else if ($e->getCode() == 400) {
                    $this->output
                        ->set_status_header(404)
                        ->set_output($this->lang->line("department_400"));
                } else {
                    $this->output
                        ->set_status_header(404)
                        ->set_output($this->lang->line("msg_500"));
                }
                return;
            }
        } else {
            $this->output
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('status' => 'success')));
    }

    public function add_laboratory_department()
    {
        if ($this->input->method() != 'post') {
            $this->output
                ->set_status_header(405);
            return;
        }

        $hospital_id = $this->input->post("hospital_id", TRUE);
        $template = $this->input->post("template", TRUE);
        $departments = $this->input->post("departments", TRUE);


        if (!is_numeric($hospital_id) || empty($template)) {
            $this->output
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        if ($template == "true") {

            if (!is_array($departments)) {
                $this->output
                    ->set_status_header(400)
                    ->set_output($this->lang->line("msg_400"));
                return;
            }

            $template_departments = $this->department->fetch_departments($departments);
            foreach ($template_departments as $d_id => $department) {
                try {
                    $new_d_id =  $this->department->add_laboratory_department($hospital_id, $department['name'], $this->user_id);
                    foreach ($department['specialties'] as $s_id => $specialty) {
                        try {
                            $new_s_id = $this->department->add_laboratory_specialty($hospital_id, $new_d_id, $specialty['name'], $this->user_id);

                            foreach ($specialty['categories'] as $c_id => $category) {
                                try {
                                    $this->department->add_laboratory_category($hospital_id, $new_d_id, $new_s_id, $category['name'], $category['pa'], $this->user_id);
                                } catch (Exception $e) {
                                    custom_log($e->getCode(), "Error Occurred at Category level: " . $e->getMessage());
                                    if ($e->getCode() === 400) {
                                        continue;
                                    } else {
                                        throw $e;
                                    }
                                }
                            }
                            foreach ($specialty['specimen_types'] as $t_ct => $specimen_type) {
                                try {
                                    $this->department->add_laboratory_specimen_type($hospital_id, $new_d_id, $new_s_id, $specimen_type['name'], $this->user_id);
                                } catch (Exception $e) {
                                    custom_log($e->getCode(), "Error Occurred at Specimen Type level: " . $e->getMessage());
                                    if ($e->getCode() === 400) {
                                        continue;
                                    } else {
                                        throw $e;
                                    }
                                }
                            }
                            foreach ($specialty['test_categories'] as $test_category) {
                                try {
                                    $this->department->add_laboratory_test_category($hospital_id, $new_d_id, $new_s_id, $test_category['name']);
                                } catch (Exception $e) {
                                    custom_log($e->getCode(), "Error Occurred at Test Category level: " . $e->getMessage());
                                    if ($e->getCode() === 400) {
                                        continue;
                                    } else {
                                        throw $e;
                                    }
                                }
                            }


                        } catch (Exception $e) {
                            custom_log($e->getCode(), "Error Occurred at Specialty level: " . $e->getMessage());
                            if ($e->getCode() === 400) {
                                continue;
                            } else {
                                throw $e;
                            }
                        }
                    }
                } catch (Exception $e) {
                    custom_log($e->getCode(), "Error Occurred at department level: " . $e->getMessage());
                    if ($e->getCode() === 400) {
                        continue;
                    } else {
                        $this->output
                            ->set_status_header(404)
                            ->set_output($this->lang->line("hospital_404"));
                        return;
                    }
                }
            }
        } else if ($template == "false") {
            if (empty($departments) || !is_string($departments)) {
                $this->output
                    ->set_status_header(400)
                    ->set_output($this->lang->line("msg_400"));
                return;
            }
            try {
                $this->department->add_laboratory_department($hospital_id, $departments, $this->user_id);
            } catch (Exception $e) {
                if ($e->getCode() == 404) {
                    $this->output
                        ->set_status_header(404)
                        ->set_output($this->lang->line("hospital_404"));
                } else if ($e->getCode() == 400) {
                    $this->output
                        ->set_status_header(404)
                        ->set_output($this->lang->line("department_400"));
                } else {
                    $this->output
                        ->set_status_header(404)
                        ->set_output($this->lang->line("msg_500"));
                }
                return;
            }
        } else {
            $this->output
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('status' => 'success')));
    }
    
    public function add_hospital_specialty()
    {
        if ($this->input->method() != 'post') {
            $this->output
                ->set_status_header(405);
            return;
        }

        $hospital_id = $this->input->post("hospital_id", TRUE);
        $department_id = $this->input->post("department_id", TRUE);
        $template = $this->input->post("template", TRUE);
        $specialties = $this->input->post("specialties", TRUE);


        if (!is_numeric($hospital_id) || !is_numeric($department_id) || empty($template)) {
            $this->output
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        if ($template == "true") {
            $template_dep_id = $this->input->post("template_id", TRUE);
            if (!is_array($specialties) || !is_numeric($template_dep_id)) {
                $this->output
                    ->set_status_header(400)
                    ->set_output($this->lang->line("msg_400"));
                return;
            }

            $template_departments = $this->department->fetch_departments(array($template_dep_id));
            foreach ($template_departments as $d_id => $department) {
                try {
                    foreach ($department['specialties'] as $s_id => $specialty) {
                        if (!in_array($s_id, $specialties)) {
                            continue;
                        }
                        try {
                            $new_s_id = $this->department->add_hospital_specialty($hospital_id, $department_id, $specialty['name'], $this->user_id);
                            foreach ($specialty['categories'] as $c_id => $category) {
                                try {
                                    $this->department->add_hospital_category($hospital_id, $department_id, $new_s_id, $category['name'], $category['pa'], $this->user_id);
                                } catch (Exception $e) {
                                    custom_log($e->getCode(), "Error Occurred at Category level: " . $e->getMessage());
                                    if ($e->getCode() === 400) {
                                        continue;
                                    } else {
                                        throw $e;
                                    }
                                }
                            }

                            foreach ($specialty['specimen_types'] as $st_id => $specimen_type) {
                                try {
                                    $this->department->add_hospital_specimen_type($hospital_id, $department_id, $new_s_id, $specimen_type['name'], $this->user_id);
                                } catch (Exception $e) {
                                    custom_log($e->getCode(), "Error Occurred at Specimen Type level: " . $e->getMessage());
                                    if ($e->getCode() === 400) {
                                        continue;
                                    } else {
                                        throw $e;
                                    }
                                }
                            }
                            foreach ($specialty['test_categories'] as $test_category) {
                                try {
                                    $this->department->add_hospital_test_category($hospital_id, $department_id, $new_s_id, $test_category['name']);
                                } catch (Exception $e) {
                                    custom_log($e->getCode(), "Error Occurred at Test Category level: " . $e->getMessage());
                                    if ($e->getCode() === 400) {
                                        continue;
                                    } else {
                                        throw $e;
                                    }
                                }
                            }
                        } catch (Exception $e) {
                            custom_log($e->getCode(), "Error Occurred at Specialty level: " . $e->getMessage());
                            if ($e->getCode() === 400) {
                                continue;
                            } else {
                                throw $e;
                            }
                        }
                    }
                } catch (Exception $e) {
                    custom_log($e->getCode(), "Error Occurred at department level: " . $e->getMessage());
                    if ($e->getCode() === 400) {
                        continue;
                    } else {
                        $this->output
                            ->set_status_header(404)
                            ->set_output($this->lang->line("hospital_404"));
                        return;
                    }
                }
            }
        } else if ($template == "false") {
            if (empty($specialties) || !is_string($specialties)) {
                $this->output
                    ->set_status_header(400)
                    ->set_output($this->lang->line("msg_400"));
                return;
            }
            try {
                $this->department->add_hospital_specialty($hospital_id, $department_id, $specialties, $this->user_id);
            } catch (Exception $e) {
                if ($e->getCode() == 404) {
                    $this->output
                        ->set_status_header(404)
                        ->set_output($this->lang->line("hospital_404"));
                } else if ($e->getCode() == 400) {
                    $this->output
                        ->set_status_header(404)
                        ->set_output($this->lang->line("specialty_400"));
                } else {
                    $this->output
                        ->set_status_header(404)
                        ->set_output($this->lang->line("msg_500"));
                }
                return;
            }
        } else {
            $this->output
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('status' => 'success')));
    }

    public function add_laboratory_specialty()
    {
        if ($this->input->method() != 'post') {
            $this->output
                ->set_status_header(405);
            return;
        }

        $hospital_id = $this->input->post("hospital_id", TRUE);
        $department_id = $this->input->post("department_id", TRUE);
        $template = $this->input->post("template", TRUE);
        $specialties = $this->input->post("specialties", TRUE);


        if (!is_numeric($hospital_id) || !is_numeric($department_id) || empty($template)) {
            $this->output
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        if ($template == "true") {
            $template_dep_id = $this->input->post("template_id", TRUE);
            if (!is_array($specialties) || !is_numeric($template_dep_id)) {
                $this->output
                    ->set_status_header(400)
                    ->set_output($this->lang->line("msg_400"));
                return;
            }

            $template_departments = $this->department->fetch_departments(array($template_dep_id));
            foreach ($template_departments as $d_id => $department) {
                try {
                    foreach ($department['specialties'] as $s_id => $specialty) {
                        if (!in_array($s_id, $specialties)) {
                            continue;
                        }
                        try {
                            $new_s_id = $this->department->add_laboratory_specialty($hospital_id, $department_id, $specialty['name'], $this->user_id);
                            foreach ($specialty['categories'] as $c_id => $category) {
                                try {
                                    $this->department->add_laboratory_category($hospital_id, $department_id, $new_s_id, $category['name'], $category['pa'], $this->user_id);
                                } catch (Exception $e) {
                                    custom_log($e->getCode(), "Error Occurred at Category level: " . $e->getMessage());
                                    if ($e->getCode() === 400) {
                                        continue;
                                    } else {
                                        throw $e;
                                    }
                                }
                            }

                            foreach ($specialty['specimen_types'] as $st_id => $specimen_type) {
                                try {
                                    $this->department->add_laboratory_specimen_type($hospital_id, $department_id, $new_s_id, $specimen_type['name'], $this->user_id);
                                } catch (Exception $e) {
                                    custom_log($e->getCode(), "Error Occurred at Specimen Type level: " . $e->getMessage());
                                    if ($e->getCode() === 400) {
                                        continue;
                                    } else {
                                        throw $e;
                                    }
                                }
                            }
                            foreach ($specialty['test_categories'] as $test_category) {
                                try {
                                    $this->department->add_laboratory_test_category($hospital_id, $department_id, $new_s_id, $test_category['name']);
                                } catch (Exception $e) {
                                    custom_log($e->getCode(), "Error Occurred at Test Category level: " . $e->getMessage());
                                    if ($e->getCode() === 400) {
                                        continue;
                                    } else {
                                        throw $e;
                                    }
                                }
                            }
                        } catch (Exception $e) {
                            custom_log($e->getCode(), "Error Occurred at Specialty level: " . $e->getMessage());
                            if ($e->getCode() === 400) {
                                continue;
                            } else {
                                throw $e;
                            }
                        }
                    }
                } catch (Exception $e) {
                    custom_log($e->getCode(), "Error Occurred at department level: " . $e->getMessage());
                    if ($e->getCode() === 400) {
                        continue;
                    } else {
                        $this->output
                            ->set_status_header(404)
                            ->set_output($this->lang->line("hospital_404"));
                        return;
                    }
                }
            }
        } else if ($template == "false") {
            if (empty($specialties) || !is_string($specialties)) {
                $this->output
                    ->set_status_header(400)
                    ->set_output($this->lang->line("msg_400"));
                return;
            }
            try {
                $this->department->add_laboratory_specialty($hospital_id, $department_id, $specialties, $this->user_id);
            } catch (Exception $e) {
                if ($e->getCode() == 404) {
                    $this->output
                        ->set_status_header(404)
                        ->set_output($this->lang->line("hospital_404"));
                } else if ($e->getCode() == 400) {
                    $this->output
                        ->set_status_header(404)
                        ->set_output($this->lang->line("specialty_400"));
                } else {
                    $this->output
                        ->set_status_header(404)
                        ->set_output($this->lang->line("msg_500"));
                }
                return;
            }
        } else {
            $this->output
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('status' => 'success')));
    }

    public function add_laboratory_tissue(){
        $json['status'] = "error";
        $json['message'] = "There might be some error. Please try again";

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $userId = $this->ion_auth->user()->row()->id;
            $this->db->insert('tissue_type', [
                'hospital_id'   => $this->input->post('hospital_id'),
                'department_id' => $this->input->post('department_id'),
                'speciality_id' => $this->input->post('speciality_id'),
                'name'          => $this->input->post('tissue_type'),
                'created_by'    => $userId,
                'updated_by'    => $userId,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ]);
            if ($this->db->insert_id() > 0) {
                $json['status'] = "success";
                $json['message'] = "Tissue type added successfully";
            }
        }
        echo json_encode($json); exit;
    }

    public function edit_laboratory_tissue(){
        $json['status'] = "error";
        $json['message'] = "There might be some error. Please try again";

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $userId = $this->ion_auth->user()->row()->id;
            $whereArr = [
                'id' => $this->input->post('id'),
                'hospital_id' => $this->input->post('hospital_id')
            ];
            $setArr = [
                'name'          => $this->input->post('name'),
                'updated_by'    => $userId,
                'updated_at'    => date('Y-m-d H:i:s')
            ];
            $res = $this->db->update('tissue_type', $setArr, $whereArr);
            if ($res) {
                $json['status'] = "success";
                $json['message'] = "Tissue type update successfully";
            }
        }
        echo json_encode($json); exit;
    }

    public function delete_laboratory_tissue(){
        $json['status'] = "error";
        $json['message'] = "There might be some error. Please try again";

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $whereArr = [
                'id'            => $this->input->post('tissue_type_id'),
                'hospital_id'   => $this->input->post('hospital_id'),
                'department_id' => $this->input->post('department_id'),
                'speciality_id' => $this->input->post('specialty_id')
            ];
            $res = $this->db->delete('tissue_type', $whereArr);
            if ($res) {
                $json['status'] = "success";
                $json['message'] = "Tissue type delete successfully";
            }
        }
        echo json_encode($json); exit;
    }

    public function add_hospital_category()
    {
        if ($this->input->method() != 'post') {
            $this->output
                ->set_status_header(405);
            return;
        }

        $hospital_id = $this->input->post("hospital_id", TRUE);
        $department_id = $this->input->post("department_id", TRUE);
        $specialty_id = $this->input->post("specialty_id", TRUE);
        $template = $this->input->post("template", TRUE);
        $categories = $this->input->post("categories", TRUE);

        if (!is_numeric($hospital_id) || !is_numeric($department_id) || !is_numeric($specialty_id) ||  empty($template)) {
            $this->output
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        if ($template == "true") {
            $template_dep_id = $this->input->post("template_did", TRUE);
            $template_spec_id = $this->input->post("template_sid", TRUE);
            if (!is_array($categories) || !is_numeric($template_dep_id) || !is_numeric($template_spec_id)) {
                $this->output
                    ->set_status_header(400)
                    ->set_output($this->lang->line("msg_400"));
                return;
            }

            $template_departments = $this->department->fetch_departments(array($template_dep_id));
            foreach ($template_departments as $d_id => $department) {
                try {
                    if (!array_key_exists($template_spec_id, $department['specialties'])) {
                        throw new Exception("Specialty not found", 400);
                    }
                    $template_specialty = $department['specialties'][$template_spec_id];
                    $template_categories = array();
                    foreach ($categories as $cat) {
                        if (!array_key_exists($cat, $template_specialty['categories'])) {
                            continue;
                        }
                        array_push($template_categories, $template_specialty['categories'][$cat]);
                    }
                    foreach ($template_categories as $cat) {
                        try {
                            $this->department->add_hospital_category($hospital_id, $department_id, $specialty_id, $cat['name'], $cat['pa'], $this->user_id);
                        } catch (Exception $e) {
                            custom_log($e->getCode(), "Error Occurred at Category level: " . $e->getMessage());
                            if ($e->getCode() === 400) {
                                continue;
                            } else {
                                throw $e;
                            }
                        }
                    }
                } catch (Exception $e) {
                    custom_log($e->getCode(), "Error Occurred at department level: " . $e->getMessage());
                    if ($e->getCode() === 400) {
                        continue;
                    } else {
                        $this->output
                            ->set_status_header(404)
                            ->set_output($this->lang->line("hospital_404"));
                        return;
                    }
                }
            }
        } else if ($template == "false") {
            $pa = $this->input->post('pa', TRUE);
            if (empty($pa) || !is_numeric($pa)) {
                $pa = 0;
            }
            if (empty($categories) || !is_string($categories)) {
                $this->output
                    ->set_status_header(400)
                    ->set_output($this->lang->line("msg_400"));
                return;
            }
            try {
                $this->department->add_hospital_category($hospital_id, $department_id, $specialty_id, $categories, $pa, $this->user_id);
            } catch (Exception $e) {
                if ($e->getCode() == 404) {
                    $this->output
                        ->set_status_header(404)
                        ->set_output($this->lang->line("hospital_404"));
                } else if ($e->getCode() == 400) {
                    $this->output
                        ->set_status_header(400)
                        ->set_output($this->lang->line("category_400"));
                } else {
                    $this->output
                        ->set_status_header(500)
                        ->set_output($this->lang->line("msg_500"));
                }
                return;
            }
        } else {
            $this->output
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('status' => 'success')));
    }

    public function add_laboratory_category()
    {
        if ($this->input->method() != 'post') {
            $this->output
                ->set_status_header(405);
            return;
        }

        $hospital_id = $this->input->post("hospital_id", TRUE);
        $department_id = $this->input->post("department_id", TRUE);
        $specialty_id = $this->input->post("specialty_id", TRUE);
        $template = $this->input->post("template", TRUE);
        $categories = $this->input->post("categories", TRUE);

        if (!is_numeric($hospital_id) || !is_numeric($department_id) || !is_numeric($specialty_id) ||  empty($template)) {
            $this->output
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        if ($template == "true") {
            $template_dep_id = $this->input->post("template_did", TRUE);
            $template_spec_id = $this->input->post("template_sid", TRUE);
            if (!is_array($categories) || !is_numeric($template_dep_id) || !is_numeric($template_spec_id)) {
                $this->output
                    ->set_status_header(400)
                    ->set_output($this->lang->line("msg_400"));
                return;
            }

            $template_departments = $this->department->fetch_departments(array($template_dep_id));
            foreach ($template_departments as $d_id => $department) {
                try {
                    if (!array_key_exists($template_spec_id, $department['specialties'])) {
                        throw new Exception("Specialty not found", 400);
                    }
                    $template_specialty = $department['specialties'][$template_spec_id];
                    $template_categories = array();
                    foreach ($categories as $cat) {
                        if (!array_key_exists($cat, $template_specialty['categories'])) {
                            continue;
                        }
                        array_push($template_categories, $template_specialty['categories'][$cat]);
                    }
                    foreach ($template_categories as $cat) {
                        try {
                                $this->department->add_laboratory_category($hospital_id, $department_id, $specialty_id, $cat['name'], $cat['pa'], $this->user_id);
                        } catch (Exception $e) {
                            custom_log($e->getCode(), "Error Occurred at Category level: " . $e->getMessage());
                            if ($e->getCode() === 400) {
                                continue;
                            } else {
                                throw $e;
                            }
                        }
                    }
                } catch (Exception $e) {
                    custom_log($e->getCode(), "Error Occurred at department level: " . $e->getMessage());
                    if ($e->getCode() === 400) {
                        continue;
                    } else {
                        $this->output
                            ->set_status_header(404)
                            ->set_output($this->lang->line("hospital_404"));
                        return;
                    }
                }
            }
        } else if ($template == "false") {
            $pa = $this->input->post('pa', TRUE);
            if (empty($pa) || !is_numeric($pa)) {
                $pa = 0;
            }
            if (empty($categories) || !is_string($categories)) {
                $this->output
                    ->set_status_header(400)
                    ->set_output($this->lang->line("msg_400"));
                return;
            }
            try {
                $this->department->add_laboratory_category($hospital_id, $department_id, $specialty_id, $categories, $pa, $this->user_id);
            } catch (Exception $e) {
                if ($e->getCode() == 404) {
                    $this->output
                        ->set_status_header(404)
                        ->set_output($this->lang->line("hospital_404"));
                } else if ($e->getCode() == 400) {
                    $this->output
                        ->set_status_header(400)
                        ->set_output($this->lang->line("category_400"));
                } else {
                    $this->output
                        ->set_status_header(500)
                        ->set_output($this->lang->line("msg_500"));
                }
                return;
            }
        } else {
            $this->output
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('status' => 'success')));
    }

    public function add_hospital_specimen()
    {
        if ($this->input->method() != 'post') {
            $this->output
                ->set_status_header(405);
            return;
        }

        $hospital_id = $this->input->post("hospital_id", TRUE);
        $department_id = $this->input->post("department_id", TRUE);
        $specialty_id = $this->input->post("specialty_id", TRUE);
        $template = $this->input->post("template", TRUE);
        $specimens = $this->input->post("specimens", TRUE);
		$category_id = $this->input->post("category_id", TRUE);

        if (!is_numeric($hospital_id) || !is_numeric($department_id) || !is_numeric($specialty_id) ||  empty($template)) {
            $this->output
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        if ($template == "true") 
		{
            $template_dep_id = $this->input->post("template_did", TRUE);
            $template_spec_id = $this->input->post("template_sid", TRUE);
            if (!is_array($specimens) || !is_numeric($template_dep_id) || !is_numeric($template_spec_id)) {
                $this->output
                    ->set_status_header(400)
                    ->set_output($this->lang->line("msg_400"));
                return;
            }

            $template_departments = $this->department->fetch_departments(array($template_dep_id));
            foreach ($template_departments as $d_id => $department) 
			{
                try {
                    if (!array_key_exists($template_spec_id, $department['specialties'])) {
                        throw new Exception("Specialty not found", 400);
                    }
                    $template_specialty = $department['specialties'][$template_spec_id];
                    $template_specimen = array();
                    foreach ($specimens as $sp) {
                        if (!array_key_exists($sp, $template_specialty['specimen_types'])) {
                            continue;
                        }
                        array_push($template_specimen, $template_specialty['specimen_types'][$sp]);
                    }
                    foreach ($template_specimen as $cat) {
                        try {
                            $this->department->add_hospital_specimen_type($hospital_id, $department_id, $specialty_id, $cat['name'], $this->user_id);
                        } catch (Exception $e) {
                            custom_log($e->getCode(), "Error Occurred at Specimen level: " . $e->getMessage());
                            if ($e->getCode() === 400) {
                                continue;
                            } else {
                                throw $e;
                            }
                        }
                    }
                } catch (Exception $e) {
                    custom_log($e->getCode(), "Error Occurred at department level: " . $e->getMessage());
                    if ($e->getCode() === 400) {
                        continue;
                    } else {
                        $this->output
                            ->set_status_header(404)
                            ->set_output($this->lang->line("hospital_404"));
                        return;
                    }
                }
            }
        } else if ($template == "false") 
		{
            if (empty($specimens) || !is_string($specimens)) {
                $this->output
                    ->set_status_header(400)
                    ->set_output($this->lang->line("msg_400"));
                return;
            }
            try {
                $this->department->add_hospital_specimen_type($hospital_id, $department_id, $specialty_id, $specimens, $this->user_id,$category_id);
            } catch (Exception $e) {
                if ($e->getCode() == 404) {
                    $this->output
                        ->set_status_header(404)
                        ->set_output($this->lang->line("hospital_404"));
                } else if ($e->getCode() == 400) {
                    $this->output
                        ->set_status_header(400)
                        ->set_output($this->lang->line("specimen_400"));
                } else {
                    $this->output
                        ->set_status_header(500)
                        ->set_output($this->lang->line("msg_500"));
                }
                return;
            }
        } else {
            $this->output
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('status' => 'success')));
    }

    public function add_laboratory_specimen()
    {
        if ($this->input->method() != 'post') {
            $this->output
                ->set_status_header(405);
            return;
        }
        $hospital_id = $this->input->post("hospital_id", TRUE);
        $department_id = $this->input->post("department_id", TRUE);
        $specialty_id = $this->input->post("specialty_id", TRUE);
        $template = $this->input->post("template", TRUE);
        $specimens = $this->input->post("specimens", TRUE);

        if (!is_numeric($hospital_id) || !is_numeric($department_id) || !is_numeric($specialty_id) ||  empty($template)) {
            $this->output
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        if ($template == "true") {
            $template_dep_id = $this->input->post("template_did", TRUE);
            $template_spec_id = $this->input->post("template_sid", TRUE);
            if (!is_array($specimens) || !is_numeric($template_dep_id) || !is_numeric($template_spec_id)) {
                $this->output
                    ->set_status_header(400)
                    ->set_output($this->lang->line("msg_400"));
                return;
            }

            $template_departments = $this->department->fetch_departments(array($template_dep_id));
            foreach ($template_departments as $d_id => $department) {
                try {
                    if (!array_key_exists($template_spec_id, $department['specialties'])) {
                        throw new Exception("Specialty not found", 400);
                    }
                    $template_specialty = $department['specialties'][$template_spec_id];
                    $template_specimen = array();
                    foreach ($specimens as $sp) {
                        if (!array_key_exists($sp, $template_specialty['specimen_types'])) {
                            continue;
                        }
                        array_push($template_specimen, $template_specialty['specimen_types'][$sp]);
                    }
                    foreach ($template_specimen as $cat) {
                        try {
                            $this->department->add_laboratory_specimen_type($hospital_id, $department_id, $specialty_id, $cat['name'], $this->user_id);
                        } catch (Exception $e) {
                            custom_log($e->getCode(), "Error Occurred at Specimen level: " . $e->getMessage());
                            if ($e->getCode() === 400) {
                                continue;
                            } else {
                                throw $e;
                            }
                        }
                    }
                } catch (Exception $e) {
                    custom_log($e->getCode(), "Error Occurred at department level: " . $e->getMessage());
                    if ($e->getCode() === 400) {
                        continue;
                    } else {
                        $this->output
                            ->set_status_header(404)
                            ->set_output($this->lang->line("hospital_404"));
                        return;
                    }
                }
            }
        } else if ($template == "false") {
            if (empty($specimens) || !is_string($specimens)) {
                $this->output
                    ->set_status_header(400)
                    ->set_output($this->lang->line("msg_400"));
                return;
            }
            try {
                $this->department->add_laboratory_specimen_type($hospital_id, $department_id, $specialty_id, $specimens, $this->user_id);
            } catch (Exception $e) {
                if ($e->getCode() == 404) {
                    $this->output
                        ->set_status_header(404)
                        ->set_output($this->lang->line("hospital_404"));
                } else if ($e->getCode() == 400) {
                    $this->output
                        ->set_status_header(400)
                        ->set_output($this->lang->line("specimen_400"));
                } else {
                    $this->output
                        ->set_status_header(500)
                        ->set_output($this->lang->line("msg_500"));
                }
                return;
            }
        } else {
            $this->output
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('status' => 'success')));
    }

    public function edit_hospital_department()
    {
        if ($this->input->method() !== 'post') {
            $this->input
                ->set_status_header(405)
                ->set_output("Method not allowed");
            return;
        }

        $hospital_id = $this->input->post('hospital_id', TRUE);
        $name = $this->input->post('name', TRUE);
        $department_id = $this->input->post('department_id', TRUE);

        if (!is_numeric($hospital_id) || empty($name) || !is_numeric($department_id)) {
            $this->input
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        try {
            $this->department->edit_hospital_department($hospital_id, array('department_id' => $department_id), 'department', $this->user_id, $name);
        } catch (\Exception $e) {
            if ($e->getCode() == 400) {
                $this->output->set_error_handler(400)
                ->set_output($this->lang->line("department_400"));
                
            }  else if ($e->getCode() == 404) {
                $this->output->set_error_handler(404)
                ->set_output($this->lang->line("hospital_404"));
            } else {
                $this->output->set_error_handler(500)
                ->set_output($this->lang->line("msg_500"));
            }
        }
    }

    public function edit_laboratory_department()
    {
        if ($this->input->method() !== 'post') {
            $this->input
                ->set_status_header(405)
                ->set_output("Method not allowed");
            return;
        }

        $hospital_id = $this->input->post('hospital_id', TRUE);
        $name = $this->input->post('name', TRUE);
        $department_id = $this->input->post('department_id', TRUE);

        if (!is_numeric($hospital_id) || empty($name) || !is_numeric($department_id)) {
            $this->input
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        try {
            $this->department->edit_laboratory_department($hospital_id, array('department_id' => $department_id), 'department', $this->user_id, $name);
        } catch (\Exception $e) {
            if ($e->getCode() == 400) {
                $this->output->set_error_handler(400)
                ->set_output($this->lang->line("department_400"));

            }  else if ($e->getCode() == 404) {
                $this->output->set_error_handler(404)
                ->set_output($this->lang->line("hospital_404"));
            } else {
                $this->output->set_error_handler(500)
                ->set_output($this->lang->line("msg_500"));
            }
        }
    }

    public function add_hospital_test_category() {
        if ($this->input->method() != 'post') {
            $this->output
                ->set_status_header(405);
            return;
        }

        $hospital_id = $this->input->post("hospital_id", TRUE);
        $department_id = $this->input->post("department_id", TRUE);
        $specialty_id = $this->input->post("specialty_id", TRUE);
        $template = $this->input->post("template", TRUE);
        $test_category = $this->input->post("category", TRUE);

        if (!is_numeric($hospital_id) || !is_numeric($department_id) || !is_numeric($specialty_id) ||  empty($template)) {
            $this->output
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        if ($template == "true") {
            $template_dep_id = $this->input->post("template_did", TRUE);
            $template_spec_id = $this->input->post("template_sid", TRUE);
            if (!is_array($test_category) || !is_numeric($template_dep_id) || !is_numeric($template_spec_id)) {
                $this->output
                    ->set_status_header(400)
                    ->set_output($this->lang->line("msg_400"));
                return;
            }

            $template_departments = $this->department->fetch_departments(array($template_dep_id));
            foreach ($template_departments as $d_id => $department) {
                try {
                    if (!array_key_exists($template_spec_id, $department['specialties'])) {
                        throw new Exception("Specialty not found", 400);
                    }
                    $template_specialty = $department['specialties'][$template_spec_id];
                    $template_tcs = array();
                    foreach ($template_specialty['test_categories'] as $tc) {
                        if (in_array($tc['id'], $test_category))
                            $template_tcs[$tc['id']] = $tc['name'];
                    }

                    foreach ($template_tcs as $tc) {
                        try {
                            $this->department->add_hospital_test_category($hospital_id, $department_id, $specialty_id, $tc);
                        } catch (Exception $e) {
                            custom_log($e->getCode(), "Error Occurred at Specimen level: " . $e->getMessage());
                            if ($e->getCode() === 400) {
                                continue;
                            } else {
                                throw $e;
                            }
                        }
                    }
                } catch (Exception $e) {
                    custom_log($e->getCode(), "Error Occurred at department level: " . $e->getMessage());
                    if ($e->getCode() === 400) {
                        continue;
                    } else {
                        $this->output
                            ->set_status_header(404)
                            ->set_output($this->lang->line("hospital_404"));
                        return;
                    }
                }
            }
        } else if ($template == "false") {
            if (empty($test_category) || !is_string($test_category)) {
                $this->output
                    ->set_status_header(400)
                    ->set_output($this->lang->line("msg_400"));
                return;
            }
            try {
                $this->department->add_hospital_test_category($hospital_id, $department_id, $specialty_id, $test_category);
            } catch (Exception $e) {
                if ($e->getCode() == 404) {
                    $this->output
                        ->set_status_header(404)
                        ->set_output($this->lang->line("hospital_404"));
                } else if ($e->getCode() == 400) {
                    $this->output
                        ->set_status_header(400)
                        ->set_output($this->lang->line("specimen_400"));
                } else {
                    $this->output
                        ->set_status_header(500)
                        ->set_output($this->lang->line("msg_500"));
                }
                return;
            }
        } else {
            $this->output
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('status' => 'success')));
    }

    public function add_laboratory_test_category() {
        if ($this->input->method() != 'post') {
            $this->output
                ->set_status_header(405);
            return;
        }

        $hospital_id = $this->input->post("hospital_id", TRUE);
        $department_id = $this->input->post("department_id", TRUE);
        $specialty_id = $this->input->post("specialty_id", TRUE);
        $template = $this->input->post("template", TRUE);
        $test_category = $this->input->post("category", TRUE);

        if (!is_numeric($hospital_id) || !is_numeric($department_id) || !is_numeric($specialty_id) ||  empty($template)) {
            $this->output
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        if ($template == "true") {
            $template_dep_id = $this->input->post("template_did", TRUE);
            $template_spec_id = $this->input->post("template_sid", TRUE);
            if (!is_array($test_category) || !is_numeric($template_dep_id) || !is_numeric($template_spec_id)) {

                $this->output
                    ->set_status_header(400)
                    ->set_output($this->lang->line("msg_400"));
                return;
            }

            $template_departments = $this->department->fetch_departments(array($template_dep_id));
            foreach ($template_departments as $d_id => $department) {
                try {
                    if (!array_key_exists($template_spec_id, $department['specialties'])) {
                        throw new Exception("Specialty not found", 400);
                    }
                    $template_specialty = $department['specialties'][$template_spec_id];
                    $template_tcs = array();
                    foreach ($template_specialty['test_categories'] as $tc) {
                        if (in_array($tc['id'], $test_category))
                            $template_tcs[$tc['id']] = $tc['name'];
                    }

                    foreach ($template_tcs as $tc=>$tcValue) {
                        try {
                            $this->department->add_laboratory_test_category($hospital_id, $department_id, $specialty_id, $tcValue);
                        } catch (Exception $e) {
                            custom_log($e->getCode(), "Error Occurred at Specimen level: " . $e->getMessage());
                            if ($e->getCode() === 400) {
                                continue;
                            } else {
                                throw $e;
                            }
                        }
                    }
                } catch (Exception $e) {
                    custom_log($e->getCode(), "Error Occurred at department level: " . $e->getMessage());
                    if ($e->getCode() === 400) {
                        continue;
                    } else {
                        $this->output
                            ->set_status_header(404)
                            ->set_output($this->lang->line("hospital_404"));
                        return;
                    }
                }
            }
        } else if ($template == "false") {
            if (empty($test_category) || !is_string($test_category)) {
                $this->output
                    ->set_status_header(400)
                    ->set_output($this->lang->line("msg_400"));
                return;
            }
            try {
                $this->department->add_laboratory_test_category($hospital_id, $department_id, $specialty_id, $test_category);
            } catch (Exception $e) {
                if ($e->getCode() == 404) {
                    $this->output
                        ->set_status_header(404)
                        ->set_output($this->lang->line("hospital_404"));
                } else if ($e->getCode() == 400) {
                    $this->output
                        ->set_status_header(400)
                        ->set_output($this->lang->line("specimen_400"));
                } else {
                    $this->output
                        ->set_status_header(500)
                        ->set_output($this->lang->line("msg_500"));
                }
                return;
            }
        } else {
            $this->output
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('status' => 'success')));
    }

    public function add_laboratory_test_sub_category() {
        if ($this->input->method() != 'post') {
            $this->output
                ->set_status_header(405);
            return;
        }

        $t_id = $this->input->post("t_id", TRUE);
        $ts_name = $this->input->post("ts_name", TRUE);

        if (!is_numeric($t_id) || empty($ts_name)) {
            $this->output
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        $main_cat_id = $this->db->from('laboratory_test_category as t1')->join('tests_main_categories as t2', 't1.name=t2.name')->where(['t1.id'=>$t_id])->select('t2.id')->get()->row()->id;

        $data_array =array(
            "main_category_id" => (isset($main_cat_id)) ? $main_cat_id : $t_id,
            "name" => $ts_name
        );

        if ($this->db->get_where('tests_sub_categories', $data_array)->num_rows() > 0) {
            custom_log("Lab Test Category Add Exception Category already exists");
            throw new Exception("Test category already exists", 400);
        } else{
            $this->db->insert("tests_sub_categories",$data_array);
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('status' => 'success')));
    }

    public function edit_hospital_specialty()
    {
        if ($this->input->method() !== 'post') {
            $this->input
                ->set_status_header(405)
                ->set_output("Method not allowed");
            return;
        }

        $hospital_id = $this->input->post('hospital_id', TRUE);
        $name = $this->input->post('name', TRUE);
        $department_id = $this->input->post('department_id', TRUE);
        $specialty_id = $this->input->post('specialty_id', TRUE);

        if (!is_numeric($hospital_id) || empty($name) || !is_numeric($department_id) || !is_numeric($specialty_id)) {
            $this->input
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        try {
            $this->department->edit_hospital_department($hospital_id, array('department_id' => $department_id, 'specialty_id' => $specialty_id), 'speciality', $this->user_id, $name);
        } catch (\Exception $e) {
            if ($e->getCode() == 400) {
                $this->output->set_error_handler(400)
                ->set_output($this->lang->line("specialty_400"));
                
            }  else if ($e->getCode() == 404) {
                $this->output->set_error_handler(404)
                ->set_output($this->lang->line("hospital_404"));
            } else {
                $this->output->set_error_handler(500)
                ->set_output($this->lang->line("msg_500"));
            }
        }
    }

    public function edit_laboratory_specialty()
    {
        if ($this->input->method() !== 'post') {
            $this->input
                ->set_status_header(405)
                ->set_output("Method not allowed");
            return;
        }

        $hospital_id = $this->input->post('hospital_id', TRUE);
        $name = $this->input->post('name', TRUE);
        $department_id = $this->input->post('department_id', TRUE);
        $specialty_id = $this->input->post('specialty_id', TRUE);

        if (!is_numeric($hospital_id) || empty($name) || !is_numeric($department_id) || !is_numeric($specialty_id)) {
            $this->input
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        try {
            $this->department->edit_laboratory_department($hospital_id, array('department_id' => $department_id, 'specialty_id' => $specialty_id), 'speciality', $this->user_id, $name);
        } catch (\Exception $e) {
            if ($e->getCode() == 400) {
                $this->output->set_error_handler(400)
                ->set_output($this->lang->line("specialty_400"));

            }  else if ($e->getCode() == 404) {
                $this->output->set_error_handler(404)
                ->set_output($this->lang->line("hospital_404"));
            } else {
                $this->output->set_error_handler(500)
                ->set_output($this->lang->line("msg_500"));
            }
        }
    }

    public function edit_hospital_category()
    {
        if ($this->input->method() !== 'post') {
            $this->input
                ->set_status_header(405)
                ->set_output("Method not allowed");
            return;
        }

        $hospital_id = $this->input->post('hospital_id', TRUE);
        $name = $this->input->post('name', TRUE);
        $department_id = $this->input->post('department_id', TRUE);
        $specialty_id = $this->input->post('specialty_id', TRUE);
        $category_id = $this->input->post('category_id', TRUE);
        $pa = $this->input->post('pa', TRUE);

        if (!is_numeric($hospital_id) || empty($name) || !is_numeric($department_id) || !is_numeric($specialty_id)) {
            $this->input
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        if (empty($pa) || !is_numeric($pa)) {
            $pa = 0;
        }

        try {
            $this->department->edit_hospital_department($hospital_id, array('department_id' => $department_id, 'specialty_id' => $specialty_id, 'category_id' => $category_id, 'pa' => $pa), 'category', $this->user_id, $name);
        } catch (\Exception $e) {
            if ($e->getCode() == 400) {
                $this->output->set_error_handler(400)
                ->set_output($this->lang->line("category_400"));
                
            }  else if ($e->getCode() == 404) {
                $this->output->set_error_handler(404)
                ->set_output($this->lang->line("hospital_404"));
            } else {
                $this->output->set_error_handler(500)
                ->set_output($this->lang->line("msg_500"));
            }
        }
    }

    
    public function edit_hospital_specimen()
    {
        if ($this->input->method() !== 'post') {
            $this->input
                ->set_status_header(405)
                ->set_output("Method not allowed");
            return;
        }

        $hospital_id = $this->input->post('hospital_id', TRUE);
        $name = $this->input->post('name', TRUE);
        $department_id = $this->input->post('department_id', TRUE);
        $specialty_id = $this->input->post('specialty_id', TRUE);
        $specimen_id = $this->input->post('specimen_id', TRUE);

        if (!is_numeric($hospital_id) || empty($name) || !is_numeric($department_id) || !is_numeric($specialty_id) || !is_numeric($specimen_id)) {
            $this->input
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        
        try {
            $this->department->edit_hospital_department($hospital_id, array('department_id' => $department_id, 'specialty_id' => $specialty_id, 'specimen_type_id' => $specimen_id), 'specimen_type', $this->user_id, $name);
        } catch (\Exception $e) {
            if ($e->getCode() == 400) {
                $this->output->set_error_handler(400)
                ->set_output($this->lang->line("category_400"));
                
            }  else if ($e->getCode() == 404) {
                $this->output->set_error_handler(404)
                ->set_output($this->lang->line("hospital_404"));
            } else {
                $this->output->set_error_handler(500)
                ->set_output($this->lang->line("msg_500"));
            }
        }
    }

    public function edit_laboratory_specimen()
    {
        if ($this->input->method() !== 'post') {
            $this->input
                ->set_status_header(405)
                ->set_output("Method not allowed");
            return;
        }

        $hospital_id = $this->input->post('hospital_id', TRUE);
        $name = $this->input->post('name', TRUE);
        $department_id = $this->input->post('department_id', TRUE);
        $specialty_id = $this->input->post('specialty_id', TRUE);
        $specimen_id = $this->input->post('specimen_id', TRUE);

        if (!is_numeric($hospital_id) || empty($name) || !is_numeric($department_id) || !is_numeric($specialty_id) || !is_numeric($specimen_id)) {
            $this->input
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }


        try {
            $this->department->edit_laboratory_department($hospital_id, array('department_id' => $department_id, 'specialty_id' => $specialty_id, 'specimen_type_id' => $specimen_id), 'specimen_type', $this->user_id, $name);
        } catch (\Exception $e) {
            if ($e->getCode() == 400) {
                $this->output->set_error_handler(400)
                ->set_output($this->lang->line("category_400"));

            }  else if ($e->getCode() == 404) {
                $this->output->set_error_handler(404)
                ->set_output($this->lang->line("hospital_404"));
            } else {
                $this->output->set_error_handler(500)
                ->set_output($this->lang->line("msg_500"));
            }
        }
    }

    public function edit_test_category()
    {
        if ($this->input->method() !== 'post') {
            $this->input
                ->set_status_header(405)
                ->set_output("Method not allowed");
            return;
        }

        $id = $this->input->post('id', TRUE);
        $name = $this->input->post('name', TRUE);

        if (!is_numeric($id) || empty($name)) {
            $this->input
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }


        try {
            $this->db->where(array("id"=>$id))->update("tests_main_categories",array("name"=>$name));
        } catch (\Exception $e) {
            if ($e->getCode() == 400) {
                $this->output->set_error_handler(400)
                ->set_output($this->lang->line("category_400"));

            }  else if ($e->getCode() == 404) {
                $this->output->set_error_handler(404)
                ->set_output($this->lang->line("hospital_404"));
            } else {
                $this->output->set_error_handler(500)
                ->set_output($this->lang->line("msg_500"));
            }
        }
    }

    public function edit_test_sub_category()
    {
        if ($this->input->method() !== 'post') {
            $this->input
                ->set_status_header(405)
                ->set_output("Method not allowed");
            return;
        }

        $id = $this->input->post('id', TRUE);
        $name = $this->input->post('name', TRUE);

        if (!is_numeric($id) || empty($name)) {
            $this->input
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }


        try {
            $this->db->where(array("id"=>$id))->update("tests_sub_categories",array("name"=>$name));
        } catch (\Exception $e) {
            if ($e->getCode() == 400) {
                $this->output->set_error_handler(400)
                ->set_output($this->lang->line("category_400"));

            }  else if ($e->getCode() == 404) {
                $this->output->set_error_handler(404)
                ->set_output($this->lang->line("hospital_404"));
            } else {
                $this->output->set_error_handler(500)
                ->set_output($this->lang->line("msg_500"));
            }
        }
    }

    public function delete_test_category()
    {
        if ($this->input->method() !== 'post') {
            $this->input
                ->set_status_header(405)
                ->set_output("Method not allowed");
            return;
        }

        $id = $this->input->post('id', TRUE);

        try {
            $cname = $this->db->get_where('tests_main_categories', ["id"=>$id])->row()->name;
            $flag = $this->db->where(array("id"=>$id))->delete("tests_main_categories");
            if($flag){
                $this->db->where(array("name"=>$cname))->delete("laboratory_test_category");
            }
        } catch (\Exception $e) {
            if ($e->getCode() == 400) {
                $this->output->set_error_handler(400)
                    ->set_output($this->lang->line("category_400"));

            }  else if ($e->getCode() == 404) {
                $this->output->set_error_handler(404)
                    ->set_output($this->lang->line("hospital_404"));
            } else {
                $this->output->set_error_handler(500)
                    ->set_output($this->lang->line("msg_500"));
            }
        }
    }

    public function delete_test_sub_category()
    {
        if ($this->input->method() !== 'post') {
            $this->input
                ->set_status_header(405)
                ->set_output("Method not allowed");
            return;
        }

        $id = $this->input->post('id', TRUE);

        try {
            $this->db->where(array("id"=>$id))->delete("tests_sub_categories");
        } catch (\Exception $e) {
            if ($e->getCode() == 400) {
                $this->output->set_error_handler(400)
                    ->set_output($this->lang->line("category_400"));

            }  else if ($e->getCode() == 404) {
                $this->output->set_error_handler(404)
                    ->set_output($this->lang->line("hospital_404"));
            } else {
                $this->output->set_error_handler(500)
                    ->set_output($this->lang->line("msg_500"));
            }
        }
    }

    public function delete_hospital_department()
    {
        if ($this->input->method() !== 'post') {
            $this->input
                ->set_status_header(405)
                ->set_output("Method not allowed");
            return;
        }

        $hospital_id = $this->input->post('hospital_id', TRUE);
        $department_id = $this->input->post('department_id', TRUE);

        if (!is_numeric($hospital_id) || !is_numeric($department_id)) {
            $this->input
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        try {
            $this->department->delete_hospital_department($hospital_id, array('department_id' => $department_id), 'department');
        } catch (\Exception $e) {
            $this->output->set_error_handler(500)
            ->set_output($this->lang->line("msg_500"));
        }
    }

    public function delete_laboratory_department()
    {
        if ($this->input->method() !== 'post') {
            $this->input
                ->set_status_header(405)
                ->set_output("Method not allowed");
            return;
        }

        $hospital_id = $this->input->post('hospital_id', TRUE);
        $department_id = $this->input->post('department_id', TRUE);

        if (!is_numeric($hospital_id) || !is_numeric($department_id)) {
            $this->input
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        try {
            $this->department->delete_laboratory_department($hospital_id, array('department_id' => $department_id), 'department');
        } catch (\Exception $e) {
            $this->output->set_error_handler(500)
            ->set_output($this->lang->line("msg_500"));
        }
    }

    public function delete_hospital_specialty()
    {
        if ($this->input->method() !== 'post') {
            $this->input
                ->set_status_header(405)
                ->set_output("Method not allowed");
            return;
        }

        $hospital_id = $this->input->post('hospital_id', TRUE);
        $department_id = $this->input->post('department_id', TRUE);
        $specialty_id = $this->input->post('specialty_id', TRUE);

        if (!is_numeric($hospital_id) || !is_numeric($department_id) || !is_numeric($specialty_id)) {
            $this->input
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        try {
            $this->department->delete_hospital_department($hospital_id, array('department_id' => $department_id, 'specialty_id' => $specialty_id), 'speciality');
        } catch (\Exception $e) {
            $this->output->set_error_handler(500)
            ->set_output($this->lang->line("msg_500"));
        }
    }

    public function delete_laboratory_specialty()
    {
        if ($this->input->method() !== 'post') {
            $this->input
                ->set_status_header(405)
                ->set_output("Method not allowed");
            return;
        }

        $hospital_id = $this->input->post('hospital_id', TRUE);
        $department_id = $this->input->post('department_id', TRUE);
        $specialty_id = $this->input->post('specialty_id', TRUE);

        if (!is_numeric($hospital_id) || !is_numeric($department_id) || !is_numeric($specialty_id)) {
            $this->input
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        try {
            $this->department->delete_laboratory_department($hospital_id, array('department_id' => $department_id, 'specialty_id' => $specialty_id), 'speciality');
        } catch (\Exception $e) {
            $this->output->set_error_handler(500)
            ->set_output($this->lang->line("msg_500"));
        }
    }

    public function delete_hospital_category()
    {
        if ($this->input->method() !== 'post') {
            $this->input
                ->set_status_header(405)
                ->set_output("Method not allowed");
            return;
        }

        $hospital_id = $this->input->post('hospital_id', TRUE);
        $department_id = $this->input->post('department_id', TRUE);
        $specialty_id = $this->input->post('specialty_id', TRUE);
        $category_id = $this->input->post('category_id', TRUE);

        if (!is_numeric($hospital_id) || !is_numeric($department_id) || !is_numeric($specialty_id) || !is_numeric($category_id)) {
            $this->input
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        try {
            $this->department->delete_hospital_department($hospital_id, array('department_id' => $department_id, 'specialty_id' => $specialty_id, 'category_id' => $category_id), 'category');
        } catch (\Exception $e) {
            $this->output->set_error_handler(500)
            ->set_output($this->lang->line("msg_500"));
        }
    }

    public function delete_laboratory_category()
    {
        if ($this->input->method() !== 'post') {
            $this->input
                ->set_status_header(405)
                ->set_output("Method not allowed");
            return;
        }

        $hospital_id = $this->input->post('hospital_id', TRUE);
        $department_id = $this->input->post('department_id', TRUE);
        $specialty_id = $this->input->post('specialty_id', TRUE);
        $category_id = $this->input->post('category_id', TRUE);

        if (!is_numeric($hospital_id) || !is_numeric($department_id) || !is_numeric($specialty_id) || !is_numeric($category_id)) {
            $this->input
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        try {
            $this->department->delete_laboratory_department($hospital_id, array('department_id' => $department_id, 'specialty_id' => $specialty_id, 'category_id' => $category_id), 'category');
        } catch (\Exception $e) {
            $this->output->set_error_handler(500)
            ->set_output($this->lang->line("msg_500"));
        }
    }

    public function delete_hospital_specimen()
    {
        if ($this->input->method() !== 'post') {
            $this->input
                ->set_status_header(405)
                ->set_output("Method not allowed");
            return;
        }

        $hospital_id = $this->input->post('hospital_id', TRUE);
        $department_id = $this->input->post('department_id', TRUE);
        $specialty_id = $this->input->post('specialty_id', TRUE);
        $specimen_type_id = $this->input->post('specimen_id', TRUE);

        if (!is_numeric($hospital_id) || !is_numeric($department_id) || !is_numeric($specialty_id) || !is_numeric($specimen_type_id)) {
            $this->input
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        try {
            $this->department->delete_hospital_department($hospital_id, array('department_id' => $department_id, 'specialty_id' => $specialty_id, 'specimen_type_id' => $specimen_type_id), 'specimen_type');
        } catch (\Exception $e) {
            $this->output->set_error_handler(500)
            ->set_output($this->lang->line("msg_500"));
        }
    }

    public function delete_laboratory_specimen()
    {
        if ($this->input->method() !== 'post') {
            $this->input
                ->set_status_header(405)
                ->set_output("Method not allowed");
            return;
        }

        $hospital_id = $this->input->post('hospital_id', TRUE);
        $department_id = $this->input->post('department_id', TRUE);
        $specialty_id = $this->input->post('specialty_id', TRUE);
        $specimen_type_id = $this->input->post('specimen_id', TRUE);

        if (!is_numeric($hospital_id) || !is_numeric($department_id) || !is_numeric($specialty_id) || !is_numeric($specimen_type_id)) {
            $this->input
                ->set_status_header(400)
                ->set_output($this->lang->line("msg_400"));
            return;
        }

        try {
            $this->department->delete_laboratory_department($hospital_id, array('department_id' => $department_id, 'specialty_id' => $specialty_id, 'specimen_type_id' => $specimen_type_id), 'specimen_type');
        } catch (\Exception $e) {
            $this->output->set_error_handler(500)
            ->set_output($this->lang->line("msg_500"));
        }
    }


    public function admin($action = "")
    {
        switch ($action) {
            case "update":
                $this->_update_admin_field();
                break;
            case "delete":
                $this->_delete_admin_field();
                break;
            case "add":
                $this->_add_admin_field();
                break;
            case "":
                $this->_render_admin_view();
                break;
            default:
                show_404();
                break;
        }
    }

    private function _update_admin_field()
    {
        if ($this->input->method() != "post") {
            // Method not allowed
            $this->output->set_status_header(405);
            return;
        }

        $failed_input_message = 'Request Failed, try again later';

        $validation_config = array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'id',
                'label' => 'ID',
                'rules' => 'trim|required|numeric',
            ),
            array(
                'filed' => 'type',
                'label' => 'Label',
                'rules' => 'trim|required'
            )
        );
        $this->form_validation->set_rules($validation_config);
        if ($this->form_validation->run() === FALSE) {
            if (!empty(form_error('name'))) {
                $this->output->set_output("Please provide name");
            } else {
                $this->output->set_output($failed_input_message);
            }
            // Bad request
            $this->output->set_status_header(400);
            return;
        }

        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $name = $this->input->post('name');

        switch ($type) {
            case "department":
                $rows = $this->db
                    ->where('department_id != ', $id)
                    ->where('department', $name)
                    ->get('departments')
                    ->num_rows();
                if ($rows > 0) {
                    $this->output
                        ->set_output("Department Already exists")
                        ->set_status_header(400);
                    return;
                }
                $this->db
                    ->set('department', $name)
                    ->where('department_id', $id)
                    ->update('departments');
                break;


            case "speciality":
                $rows = $this->db
                    ->where('spec_grp_id != ', $id)
                    ->where('spec_grp_name', $name)
                    ->get('speciality_group')
                    ->num_rows();
                if ($rows > 0) {
                    $this->output
                        ->set_output("Speciality Already exists")
                        ->set_status_header(400);
                    return;
                }
                $this->db
                    ->where('spec_grp_id', $id)
                    ->update('speciality_group', array(
                        'spec_grp_name' => $name,
                        'updated_by' => $this->user_id,
                        'updated_at' => date('Y-m-d H:i:s')
                    ));
                break;

            case "category":
                $rows = $this->db
                    ->where('id != ', $id)
                    ->where('specialty', $name)
                    ->get('specialties')
                    ->num_rows();
                if ($rows > 0) {
                    $this->output
                        ->set_output("Category Already exists")
                        ->set_status_header(400);
                    return;
                }
                $pa = $this->input->post('pa');
                if (empty($pa) || !is_numeric($pa)) {
                    $pa = 0;
                }
                $this->db
                    ->where('id', $id)
                    ->update('specialties', array('specialty' => $name, 'pa' => $pa));
                break;

            case "specimen":
                $rows = $this->db
                    ->where('spec_type_id != ', $id)
                    ->where('type', $name)
                    ->get('specimen_type')
                    ->num_rows();
                if ($rows > 0) {
                    $this->output
                        ->set_output("Specimen Type Already exists")
                        ->set_status_header(400);
                    return;
                }
                $this->db
                    ->where('spec_type_id', $id)
                    ->update('specimen_type', array(
                        'type' => $name,
                        'updated_by' => $this->user_id,
                        'updated_at' => date('Y-m-d H:i:s')
                    ));
                break;
            default:
                $this->output
                    ->set_output($failed_input_message)
                    ->set_status_header(400);
        }
    }

    private function _add_admin_field()
    {
        if ($this->input->method() != "post") {
            // Method not allowed
            $this->output->set_status_header(405);
            return;
        }

        $failed_input_message = 'Request Failed, try again later';

        $validation_config = array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required',
            ),
            array(
                'filed' => 'type',
                'label' => 'Label',
                'rules' => 'trim|required'
            )
        );
        $this->form_validation->set_rules($validation_config);
        if ($this->form_validation->run() === FALSE) {
            if (!empty(form_error('name'))) {
                $this->output->set_output("Please provide name");
            } else {
                $this->output->set_output($failed_input_message);
            }
            // Bad request
            $this->output->set_status_header(400);
            return;
        }

        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $name = $this->input->post('name');

        if ($type != "department") {
            if (empty($id) || !is_numeric($id)) {
                $this->output
                    ->set_output($failed_input_message)
                    ->set_status_header(400);
                return;
            }
        }

        $today =  date('Y-m-d H:i:s');

        switch ($type) {
            case "department":
                $rows = $this->db
                    ->where('department', $name)
                    ->get('departments')
                    ->num_rows();
                if ($rows > 0) {
                    $this->output
                        ->set_output("Department Already exists")
                        ->set_status_header(400);
                    return;
                }
                $data = array('department' => $name, 'created_at' => $today, 'updated_at' => $today);
                $this->db->insert('departments', $data);
                $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json')
                    ->set_output(json_encode($this->db->insert_id()));
                break;

            case "speciality":
                $rows = $this->db
                    ->where('department_id', $id)
                    ->where('spec_grp_name', $name)
                    ->get('speciality_group')
                    ->num_rows();
                if ($rows > 0) {
                    $this->output
                        ->set_output("Speciality Already exists")
                        ->set_status_header(400);
                    return;
                }
                // Check if department exists
                $deps = $this->db->get_where('departments', array('department_id' => $id))->num_rows();
                if ($deps == 0) {
                    $this->output->set_output($failed_input_message)->set_status_header(400);
                    return;
                }
                $data = array('spec_grp_name' => $name, 'created_by' => $this->user_id, 'created_at' => $today, 'updated_by' => $this->user_id, 'updated_at' => $today, 'department_id' => $id);
                $this->db->insert('speciality_group', $data);
                $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json')
                    ->set_output(json_encode($this->db->insert_id()));
                break;

            case "category":
                $rows = $this->db
                    ->where('speciality_group_id', $id)
                    ->where('specialty', $name)
                    ->get('specialties')
                    ->num_rows();
                if ($rows > 0) {
                    $this->output
                        ->set_output("Category Already exists")
                        ->set_status_header(400);
                    return;
                }
                $pa = $this->input->post('pa');
                if (empty($pa) || !is_numeric($pa)) {
                    $pa = 0;
                }
                // Check if speciality group exists
                $sp_g = $this->db->get_where('speciality_group', array('spec_grp_id' => $id))->num_rows();
                if ($sp_g == 0) {
                    $this->output->set_output($failed_input_message)->set_status_header(400);
                    return;
                }
                $data = array('specialty' => $name, 'pa' => $pa, 'speciality_group_id' => $id);
                $this->db->insert('specialties', $data);
                $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json')
                    ->set_output(json_encode($this->db->insert_id()));
                break;

            case "specimen":
                $rows = $this->db
                    ->where('spec_group_id', $id)
                    ->where('type', $name)
                    ->get('specimen_type')
                    ->num_rows();
                if ($rows > 0) {
                    $this->output
                        ->set_output("Specimen Type Already exists")
                        ->set_status_header(400);
                    return;
                }
                // Check if speciality group exists
                $sp_g = $this->db->get_where('speciality_group', array('spec_grp_id' =>  $id))->num_rows();
                if ($sp_g == 0) {
                    $this->output->set_output($failed_input_message)->set_status_header(400);
                    return;
                }
                $data = array('type' => $name, 'spec_group_id' => $id, 'created_by' => $this->user_id, 'updated_by' => $this->user_id, 'updated_at' => $today, 'created_at' => $today);
                $this->db->insert('specimen_type', $data);
                $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json')
                    ->set_output(json_encode($this->db->insert_id()));
                break;
            default:
                custom_log($type, "Action type not found");
                $this->output
                    ->set_output($failed_input_message)
                    ->set_status_header(400);
        }
    }

    private function _delete_admin_field()
    {
        if ($this->input->method() != "post") {
            // Method not allowed
            $this->output->set_status_header(405);
            return;
        }


        $failed_input_message = 'Request Failed, try again later';

        $validation_config = array(
            array(
                'field' => 'id',
                'label' => 'Name',
                'rules' => 'trim|required|numeric',
            ),
            array(
                'filed' => 'type',
                'label' => 'Label',
                'rules' => 'trim|required'
            )
        );
        $this->form_validation->set_rules($validation_config);
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output($failed_input_message);
            // Bad request
            $this->output->set_status_header(400);
            return;
        }

        $id = $this->input->post('id');
        $type = $this->input->post('type');

        switch ($type) {
            case "department":
                $deps = $this->db->get_where('departments', array('department_id' => $id))->num_rows();
                if ($deps == 0) {
                    $this->output->set_output($failed_input_message)->set_status_header(400);
                    return;
                }
                $this->db->query(
                    "
                        DELETE FROM specimen_type
                        WHERE spec_group_id in (select spec_grp_id from speciality_group where department_id = " . $id . ")
                    "
                );

                $this->db->query(
                    "
                        DELETE FROM specialties
                        WHERE speciality_group_id in (select spec_grp_id from speciality_group where department_id = " . $id . ")
                    "
                );

                $this->db->query(
                    "
                        DELETE FROM speciality_group
                        WHERE department_id = " . $id . "
                    "
                );

                $this->db->query(
                    "
                        DELETE FROM departments
                        WHERE department_id = " . $id . "
                    "
                );

                break;
            case "speciality":
                $this->db->query(
                    "
                        DELETE FROM specimen_type
                        WHERE spec_group_id  = " . $id . "
                    "
                );

                $this->db->query(
                    "
                        DELETE FROM specialties
                        WHERE speciality_group_id = " . $id . "
                    "
                );

                $this->db->query(
                    "
                        DELETE FROM speciality_group
                        WHERE spec_grp_id = " . $id . "
                    "
                );


                break;
            case "category":
                $this->db->query(
                    "
                        DELETE FROM specialties
                        WHERE id = " . $id . "
                    "
                );
                break;
            case "specimen":
                $this->db->query(
                    "
                        DELETE FROM specimen_type
                        WHERE spec_type_id  = " . $id . "
                    "
                );

                break;
            default:
                custom_log($type, "Action type not found");
                $this->output
                    ->set_output($failed_input_message)
                    ->set_status_header(400);
        }
    }

    private function _render_admin_view()
    {
        if ($this->input->method() != "get") {
            // Method not allowed
            $this->output->set_status_header(405);
            return;
        }
        $data = array();
        if ($this->group_type !== "A") {
            return redirect("/department/institute/" . $this->group_id, "refresh");
        }

        array_push($this->f_data['javascripts'], 'js/department/admin.js');

        $data['departments'] = $this->department->fetch_departments();
        $this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('department/department_admin.php', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);
    }

    public function add_test_category() {
        $name = $this->input->post('name');
        $spec_id = $this->input->post('id');
        if (!empty($name) && !empty($spec_id) && is_numeric($spec_id)) {
            $data = array(
                'name' => $name,
                'speciality_id' => $spec_id
            );
            $this->department->add_test_category($data);
        }
        redirect('department/admin');
    }

    // TODO: same as above function
    public function lab_snomed_codes($department_id="", $specialty_id="")
    {
        if (!$this->ion_auth->logged_in()) {
            return redirect('', "refresh");
        }
        $data = array();
        $f_data['javascripts'] = array(
            'js/custom_js/specialty_categories_snomed.js'
        );
        $this->load->model('Admin_model');
		
	  $group_row = $this->ion_auth->get_users_main_groups()->row();
      $this->group_type = $group_row->group_type;
      $laboratory_id = $group_row->id;
	  
        //$laboratory_id = $this->group_id;

        $lab_departments_data = $this->department->get_laboratory_department($laboratory_id);
//        echo '<pre>'; print_r($lab_departments_data); exit;
        $speciality_categories_sub_categories = array();
        if(!empty($lab_departments_data)){

            foreach ($lab_departments_data as $key=>$value){
                $department_name = $value['name'];
                if($key == $department_id){
                    foreach ($value['specialties'] as $sp_key=>$sp_value){
                        $specialty_name = $sp_value['name'];
                        if($sp_key == $specialty_id){
                            $speciality_categories_sub_categories['department_id'] = $department_id;
                            $speciality_categories_sub_categories['department'] = $department_name;
                            $speciality_categories_sub_categories['specialty_id'] = $specialty_id;
                            $speciality_categories_sub_categories['specialty'] = $specialty_name;
                            $speciality_categories_sub_categories['categories'] = $sp_value['categories'];
                        }
                    }
                }
            }
        }

		$specialty_codes = $this->department->get_lab_specialty_snomed_codes($laboratory_id,
		$speciality_categories_sub_categories['department_id'],
		$speciality_categories_sub_categories['specialty_id']);

        $data['group_id'] = $laboratory_id;
        $data['categories'] = $speciality_categories_sub_categories;
        $data['specialties'] = $this->db->get('specialties')->result();
//        $data['specialtyCodes'] = $this->Admin_model->get_specialty_code_data();
        $data['specialtyCodes'] = $specialty_codes;
//        $data['specialtyNav'] = $this->load->view('display/navigation/specialty_navigation', $data, TRUE);
        $this->load->view('templates/header-new');
        $this->load->view('department/snomed_codes', $data);
        $this->load->view('templates/footer-new', $f_data);
    }

    public function add_lab_snomed_codes()
	{
        if (!in_array($group_type,LAB_GROUP)) {
            //return redirect('', "refresh");
        }
        
        $user_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_main_groups()->row();
      $this->group_type = $group_row->group_type;
      $laboratory_id = $group_row->id;
        $schedule_type = $this->input->post('schedule_type');
        if($schedule_type == 'weekly'){
            $schedule_value = $this->input->post('week_name');
        } elseif ($schedule_type == 'days'){
            $schedule_value = $this->input->post('days_count');
        }else{
            $schedule_value = '';
        }

        $data = array(
            'lab_id'=>$laboratory_id,
            'department_id'=>$this->input->post('hid_dept_id'),
            'speciality_id'=>$this->input->post('hid_specialty_id'),
            'category_id'=>$this->input->post('hid_cat_id'),
            'sub_category_id'=>($this->input->post('hid_sub_cat_id')=="0"?"":$this->input->post('hid_sub_cat_id')),
            'snomed_type'=>"T",
            'snomed_code_desc'=>$this->input->post('code'),
            'schedule_type'=>$schedule_type,
            'schedule_value'=> $schedule_value,
            'snomed_status'=>1,
            'created_by'=>$user_id,
            'created_at'=>date('Y-m-d H:i:s'),
        );
        $insert_record = $this->department->add_lab_specialty_snomed_codes($data);

        $response = array();
        $response['status'] = 'error';
        if($insert_record){
            $response['msg'] = "Data inserted successfully!";
            $response['status'] = 'success';
        }        
        echo json_encode($response);
        exit;
    }
    public function get_code(){
        
        $snomed_code = intval($this->input->post('snomed_code'));
        $data = $this->department->get_snomed_code($snomed_code);
        echo json_encode($data);exit;

    }
    public function save_edit_code(){
        $data['snomed_code_desc'] = trim($this->input->post('code'));
        $data['schedule_type'] = $this->input->post('edit_schedule_type');
        if(strtolower($data['schedule_type']) == 'weekly')
        {
            $data['schedule_value'] = $this->input->post('week_name');
        } else{
            $data['schedule_value'] = $this->input->post('edit_days');
        }        
        $snomed_id = intval($this->input->post('snomed_code_id'));
        $t = $this->department->save_edit_code($snomed_id, $data);
        echo 1;exit; 
    }
    public function specialties() {
        $formData = $this->input->post();
        if (!empty($formData)) {
            if ($formData['action'] == 'delete_specialty_code') {
                $this->db->where('snomed_code_id', $formData['id'])->delete('speciality_snomed_codes');
            }
        }
        if($this->input->post('redirect_url')){
            return redirect(base_url().$this->input->post('redirect_url'), "refresh");
        }
        else{
            return redirect("/department", "refresh");
        }
    }
}
