<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Admin Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <firebug.j@gmail.com>
 * @version    1.0.0
 */
class Settings extends CI_Controller
{
    /**
     * Constructor to load models and helpers
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->load->model('TicketsModel');
        $this->load->model('Userextramodel');
        $this->load->model('Institute_model');
        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));
        track_user_activity(); //Track user activity function which logs user track actions.
    }

    public function index($usergroupid=""){
        if (!$this->ion_auth->logged_in()) 
		{
            redirect('auth/login', 'refresh');
        }
        if ($this->ion_auth->user()->row()->user_type !== 'A') {
            //redirect('auth/', 'refresh');
        }
        $data = array();
        $h_f_data = array();
        $h_f_data['javascripts'] = array(
            '/js/typeahead.jquery.js',
            '/newtheme/js/custom_js/admin_settings.js',
        );
        $h_f_data['styles'] = array();

        $this->load->model("Admin_model");
        $data['countries'] = $this->Institute_model->get_countries();
        $data['hospitals_list'] = $this->Admin_model->get_hospital_groups();

        $this->load->view('templates/header-new',$h_f_data);
        $this->load->view('pages/settings.php',$data);
        $this->load->view('templates/footer-new',$h_f_data);

    }


    /**
     * Hospital Detail Autosuggest
     *
     * @return void
     */
    public function hospital_autosuggest()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $userid = $this->ion_auth->user()->row()->id;
        if (isset($_REQUEST['query'])) {
            $search_query = $_REQUEST['query'];
            $sql = "SELECT * FROM groups WHERE groups.group_type = 'H' AND groups.description LIKE '%{$search_query}%'";
            $query = $this->db->query($sql);
            $array = array();
            foreach ($query->result() as $row) {
                $array[$row->id]['hsp_id'] = $row->id;
                $array[$row->id]['hsp_name'] = $row->name;
                $array[$row->id]['hsp_desc'] = $row->description;
                $array[$row->id]['hsp_grp_type'] = $row->group_type;
            }
            echo json_encode($array);
        }
    }

    /**
     * Populate microdescription data
     *
     * @return void
     */
    public function set_populate_hospital_data()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        if (!empty($_POST['hsp_id'])) {
            $hsp_id = $_POST['hsp_id'];
            $hsp_data = $this->Userextramodel->populate_hospital_data($hsp_id);
            if (!empty($hsp_data)) {
                echo json_encode($hsp_data[0]);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'No Record Found';
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'No Record Found';
            echo json_encode($json);
            die;
        }
    }

    public function account_holder(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('templates/header-new');
        $this->load->view('pages/account_holder.php');
        $this->load->view('templates/footer-new');
    }


    /**
     * Save Hospital Info
     *
     * @return void
     */
    public function save_hospital_info()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        if (!empty($_POST['role_id'])) {
            $role_id = $_POST['role_id'];
            $data = array(
                'group_id'=>$this->input->post('role_id'),
                'hosp_address'=>$this->input->post('hosp_address'),
                'hosp_country'=>$this->input->post('hosp_country'),
                'hosp_city'=>$this->input->post('hosp_city'),
                'hosp_state'=>$this->input->post('hosp_state'),
                'hosp_post_code'=>$this->input->post('hosp_post_code'),
                'hosp_email'=>$this->input->post('hosp_email'),
                'hosp_phone'=>$this->input->post('hosp_phone'),
                'hosp_mobile'=>$this->input->post('hosp_mobile'),
                'hosp_fax'=>$this->input->post('hosp_fax'),
                'hosp_website'=>$this->input->post('hosp_website'),
            );
            $hsp_data = $this->Userextramodel->save_hospital_info($role_id, $data);
            if (!empty($hsp_data)) {
                $json['type'] = 'success';
                $json['msg'] = $hsp_data;
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'Something went wrong';
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something went wrong';
            echo json_encode($json);
            die;
        }
    }

    public function urlManagement()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $form_status = $this->input->post("form_status");
            if($form_status=="delete"){
                $deleteId = $this->input->post("dataId");
                $chkRecord = $this->Userextramodel->deleteData('url_management', array("id" => $deleteId));

                if ($chkRecord) {
                    $response['status'] = "success";
                    $response['message'] = "Record Deleted successfully";
                } else {
                    $response['status'] = "fail";
                    $response['message'] = "Failed to delete record. Please try again";
                }
            } else {
                $this->form_validation->set_rules('module', 'Module', 'required');
                $this->form_validation->set_rules('url', 'URL', 'required');
                $this->form_validation->set_rules('description', 'Description', 'required');
                if ($this->form_validation->run() == FALSE) {
                    $response['status'] = "fail";
                    $response['message'] = strip_tags(validation_errors());
                } else {
                    $insRecord['module_id'] = $this->input->post('module');
                    $insRecord['url'] = $this->input->post('url');
                    $insRecord['description'] = $this->input->post('description');
                    if ($this->input->post('form_status') == "edit") {
                        $editId = $this->input->post('edit_id');
                        $chkRecord = $this->Userextramodel->updateTable('url_management', $insRecord, array("id" => $editId));
                    } else {
                        $chkRecord = $this->Userextramodel->addRecord('url_management', $insRecord);
                    }

                    if ($chkRecord) {
                        $response['status'] = "success";
                        $response['message'] = "Record added successfully";
                    } else {
                        $response['status'] = "fail";
                        $response['message'] = "Failed to add record. Please try again";
                    }
                }
            }
            echo json_encode($response);
            exit;
        }
        $data['javascripts'] = array(
            'newtheme/js/custom_js/admin_settings.js'
        );
        $data['urlData'] = $this->Userextramodel->getURLData();
        $data['moduleData'] = $this->Userextramodel->getModuleData();
//        $data['leaveTypes'] = $this->leave_model->leaveTypes();
        $this->load->view('templates/header-new');
        $this->load->view('pages/url_list', $data);
        $this->load->view('templates/footer-new', $data);
    }

    public function moduleManagement()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $form_status = $this->input->post("form_status");
            if($form_status=="delete"){
                $deleteId = $this->input->post("dataId");
                $chkRecord = $this->Userextramodel->deleteData('modules', array("id" => $deleteId));

                if ($chkRecord) {
                    $response['status'] = "success";
                    $response['message'] = "Record Deleted successfully";
                } else {
                    $response['status'] = "fail";
                    $response['message'] = "Failed to delete record. Please try again";
                }
            } else {
                $this->form_validation->set_rules('name', 'Name', 'required');
                if ($this->form_validation->run() == FALSE) {
                    $response['status'] = "fail";
                    $response['message'] = strip_tags(validation_errors());
                } else {
                    $insRecord['name'] = $this->input->post('name');
                    if ($this->input->post('form_status') == "edit") {
                        $editId = $this->input->post('edit_id');
                        $chkRecord = $this->Userextramodel->updateTable('modules', $insRecord, array("id" => $editId));
                    } else {
                        $chkRecord = $this->Userextramodel->addRecord('modules', $insRecord);
                    }

                    if ($chkRecord) {
                        $response['status'] = "success";
                        $response['message'] = "Record added successfully";
                    } else {
                        $response['status'] = "fail";
                        $response['message'] = "Failed to add record. Please try again";
                    }
                }
            }
            echo json_encode($response);
            exit;
        }
        $data['javascripts'] = array(
            'newtheme/js/custom_js/admin_settings.js'
        );
        $data['moduleData'] = $this->Userextramodel->getModuleData();
//        $data['leaveTypes'] = $this->leave_model->leaveTypes();
        $this->load->view('templates/header-new');
        $this->load->view('pages/module_list', $data);
        $this->load->view('templates/footer-new', $data);
    }

    public function payment_info(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $data['detail'] = $this->db->get('payment_info')->row()->detail;
        if($this->input->post()){
            $this->form_validation->set_rules('detail', 'Payment Info', 'required');
            if ($this->form_validation->run() === TRUE) {
                $post = $this->input->post(NULL, true);
                $res = $this->db->update('payment_info', ['detail' => $post['detail'], 'updated_by' => $this->user_id], ['id'=>1]);
                if($res){
                    $this->session->set_flashdata('success', 'Payment info updated successfully');
                    redirect("settings/payment_info");
                }else{
                    $this->session->set_flashdata('error', 'Something went wrong, Please Try Again.');
                }
            }else{
                $this->session->set_flashdata('error', validation_errors());
            }
        }

        $this->load->view('templates/header-new');
        $this->load->view('pages/payment_info',$data);
        $this->load->view('templates/footer-new');
    }

}