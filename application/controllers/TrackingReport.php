<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Admin Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <firebug.j@gmail.com>
 * @version    1.0.0
 */
class TrackingReport extends CI_Controller
{
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
        $this->load->model('Laboratory_model', 'lab');
        $this->load->helper(array('url', 'activity_helper'));
        $this->load->model('TrackingReport_model');
        $this->load->model('Institute_model');
        $this->load->model('Pm_model');
        $this->load->model('invoice_model');
        $this->load->model('billing_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'activity_helper', 'dashboard_functions_helper', 'datasets_helper', 'ec_helper'));
        $this->load->library('email');
        // $this->load->library('word');
        $this->load->helper("file");
        $this->load->model('Userextramodel');
        $this->load->model('Laboratory_model');
        $this->load->model('Admin_model');
        track_user_activity();

        $this->user_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_groups()->row();
        $this->group_type = $group_row->group_type;
        $this->group_id = $group_row->id;
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $hospital_row = $this->ion_auth->get_users_main_groups()->row();
        $groupType = $hospital_row->group_type;
        $hospital_id = $hospital_row->id;
        $hospitalUserGroupArray = array("H", "HA");
        if (in_array($groupType, $hospitalUserGroupArray)) {
            $data["hospital_info"] = $this->Laboratory_model->get_alllab_Hospitalinfo($hospital_id);
        } else {
            $data["hospital_info"] = $this->Laboratory_model->get_alllab_Hospitalinfo(0);
        }
        $data['user_error'] = array();
        $data['title'] = 'Track Report';
        $this->load->view('templates/header-new');
        $this->load->view('trackingreport/index', $data);
        $this->load->view('templates/footer-new');
    }

    public function lab_record_list($request_status = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->mybreadcrumb->add('Dashboard', base_url('index.php/TrackingReport'));
        $this->mybreadcrumb->add('Record Listing', base_url('index.php/TrackingReport/lab_record_list'));

        $doctor_id = $this->ion_auth->user()->row()->id;

        // if($this->input->get() && $this->input->get('start'))
        //$filter = " AND request.speciality_group_id IN(1,2)";
        $filter = '';
        if (!empty($this->input->get())) {
            $start_date = date("Y-m-d", strtotime($this->input->get('start')));
            $end_date = date("Y-m-d", strtotime($this->input->get('end')));

            $published_start_date = date("Y-m-d", strtotime($this->input->get('publish-start')));
            $published_end_date = date("Y-m-d", strtotime($this->input->get('publish-end')));

            $supstart = date("Y-m-d", strtotime($this->input->get('sup-start')));
            $supend = date("Y-m-d", strtotime($this->input->get('sup-end')));


            if ($this->input->get('start') != '' && $this->input->get('end') != '') {
                $filter .= " AND request.request_datetime BETWEEN '" . $start_date . " 00:00:00' AND '" . $end_date . " 23:59:59'";
            }
            if ($this->input->get('publish-start') != '' && $this->input->get('publish-end') != '') {
                $filter .= " AND request.publish_datetime BETWEEN '" . $published_start_date . " 00:00:00' AND '" . $published_end_date . " 23:59:59'";
            }
            if ($this->input->get('group') != '') {
                $filter .= " AND request.hospital_group_id = '" . $this->input->get('group') . "'";
            }
            if ($this->input->get('reportType') != 'all') {
                $filter .= " AND request.specimen_publish_status = 1";
            }
            if ($this->input->get('supplementaryReported') == '1') {
                $filter .= " AND additional_work.additional_id IS NOT NULL";
            }
            if ($this->input->get('furtherwork') == '1') {
                $filter .= " AND further_work.fw_id IS NOT NULL";
            }
            if ($this->input->get('sup-start') != '' && $this->input->get('sup-end') != '') {
                $filter .= " AND additional_work.additional_work_time BETWEEN '" . $supstart . " 00:00:00' AND '" . $supend . " 23:59:59'";
            }
            if ($this->input->get('age') != '') {
                if($this->input->get('ageBetween') != 'above'){
                    $filter .= " AND ((DATE_FORMAT(FROM_DAYS(DATEDIFF(now(),DATE_FORMAT(STR_TO_DATE(dob, '%d-%m-%Y'), '%Y-%m-%d'))), '%Y')+0 <= '" . $this->input->get('age') . "' AND DATE_FORMAT(FROM_DAYS(DATEDIFF(now(),DATE_FORMAT(STR_TO_DATE(dob, '%d-%m-%Y'), '%Y-%m-%d'))), '%Y')+0 IS NOT NULL))";
                }else{
                    $filter .= " AND ((DATE_FORMAT(FROM_DAYS(DATEDIFF(now(),DATE_FORMAT(STR_TO_DATE(dob, '%d-%m-%Y'), '%Y-%m-%d'))), '%Y')+0 >= '" . $this->input->get('age') . "' AND DATE_FORMAT(FROM_DAYS(DATEDIFF(now(),DATE_FORMAT(STR_TO_DATE(dob, '%d-%m-%Y'), '%Y-%m-%d'))), '%Y')+0 IS NOT NULL))";
                }
            }
        }
        $data['doctor_list'] = $this->Admin_model->get_doctors();
        $data['courier_data'] = $this->Institute_model->get_courier();
        $data["query"] = $this->TrackingReport_model->lab_record_list($doctor_id, $filter, $request_status);
        // echo "<pre>";
        // print_r($data['query']);die;
        // $data['request_slides_id'] = $this->TrackingReport_model->lab_record_list_with_slide($doctor_id, $filter, $request_status);
        $data['filterStatus'] = $request_status;
        $data['request_data'] = $this->input->get();
        if (empty($this->input->get())) {
            $data['request_data']['fields'] = array(
                'speciality' => '1',
                'labNo' => '1',
                'clinic' => '1',
                'courierNo' => '1',
                'patient' => '1',
                'pathologist' => '1',
                'addedby' => '1',
                'requestedDate' => '1',
                'publishedDate' => '1',
                'tat' => '1'
            );
        }
        $checkhospital = getRecords(
            "group_id",
            "users_groups_type",
            array("user_id" => $doctor_id)
        );
        $hospitallist = array();
        foreach ($checkhospital as $rec) {
            $hospitallist[] = $rec->group_id;
        }


        // $this->load->view('lab/inc/header-new');
        $this->load->view('trackingreport/inc/header');
        $this->load->view('trackingreport/record_list', $data);
        $this->load->view('trackingreport/inc/footer');
    }

    public function GetPathologist(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $html = '<option value="">-- Select Pathologist --</option>';
        $groupId = $this->input->post('groupId');
        $data["pathologist_info"] = $this->TrackingReport_model->get_lab_users('',$groupId);
        if(count($data["pathologist_info"]) > 0){
            foreach($data["pathologist_info"] as $key => $pathologist){
                $html .= '<option value="'.$pathologist['id'].'">'.$pathologist['first_name'].' '.$pathologist['last_name'].'</option>';
            }
        }
        echo $html;exit;
    }
}
