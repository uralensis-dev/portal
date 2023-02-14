<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Reports Controller
 * @package    CI
 * @subpackage Controller
 * @author     Anonymous
 * @version    1.0.0
 */
class Reports extends CI_Controller
{
    /**
     * Constructor to load models and helpers
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->load->model('ReportsModel');
        $this->load->model('Userextramodel');
        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));
        track_user_activity(); //Track user activity function which logs user track actions.
    }

    public function tat_chart()
    {
        $isHAdmin = $this->Userextramodel->isHospitalAdmin();

        $doctor_id = $this->ion_auth->user()->row();
        // echo '<pre>'; print_r($isHAdmin); exit;

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (empty($isHAdmin)) {
            redirect('auth/', 'refresh');
        }

        $HGroup_id = $isHAdmin['group_id'];
        $data['javascripts'] = array(
            'newtheme/js/app.js',
            'js/amcharts/core.js',
            'js/amcharts/charts.js',
            'js/amcharts/animated.js',
            'js/daterangepicker.js',
            'js/custom_js/tat_all_docs.js',
        );
        $data['styles'] = array(
            'css/daterangepicker.css',
        );

        $userinfo = getLoggedInUserProfile(intval($this->ion_auth->user()->row()->id));
        $full_name = $userinfo[0]->first_name.' '.$userinfo[0]->last_name;
        $doctor_id = $this->ion_auth->user()->row()->id;
        $data['user_name'] = $full_name;
        $start_dt = "";
        $end_dt   = "";
        $first_day_this_month = date('Y/m/01');
        $last_day_this_month  = date('Y/m/t');
        $chart_group_by = "Doctor";
        $sr_dt_range = $first_day_this_month." - ".$last_day_this_month;
        $sr_group_by = "Doctor";

        if($this->input->post()){
            $date_range = $this->input->post('date_range');
            $splitted = (explode("-", $date_range));

            $start_dt = date("Y-m", strtotime($splitted[0]));
            $end_dt = date("Y-m", strtotime($splitted[1]));

            $sr_dt_range = $date_range;
            $chart_group_by = $this->input->post('chart_group_by');
            $sr_group_by = $chart_group_by;
//            echo "Start:".$start_dt." --- End Date:".$end_dt;
//            exit;
        }


        $all_docs_data = $this->ReportsModel->all_doctor_tat_last_month($start_dt, $end_dt, $chart_group_by, $HGroup_id);
//        echo '<pre>'; print_r($all_docs_data); exit;

        $data['all_docs_l_month_data'] = $all_docs_data;
        $data['avg_lm_tat'] = $this->ReportsModel->doctor_avg_tat_by_period($doctor_id, 1);
        $data['avg_l3m_tat'] = $this->ReportsModel->doctor_avg_tat_by_period($doctor_id, 3);
        $data['avg_l6m_tat'] = $this->ReportsModel->doctor_avg_tat_by_period($doctor_id, 6);
        $data['sr_dt_range'] = $sr_dt_range;
        $data['sr_group_by'] = $sr_group_by;
//        echo '<pre>'; print_r($data['avg_l6m_tat']); exit;
        $this->load->view('templates/header-new', $data);
        $this->load->view('reports/tat_chart_all_docs', $data);
        $this->load->view('templates/footer-new', $data);
    }

    public function tat_chart_pdf($date_range="", $group_by="")
    {
        $isHAdmin = $this->Userextramodel->isHospitalAdmin();

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (empty($isHAdmin)) {
            redirect('auth/', 'refresh');
        }
        $HGroup_id = $isHAdmin['group_id'];

        $date_range = urldecode(urldecode($date_range));
        $group_by   = urldecode($group_by);
        $userinfo = getLoggedInUserProfile(intval($this->ion_auth->user()->row()->id));
        $full_name = $userinfo[0]->first_name.' '.$userinfo[0]->last_name;
        $doctor_id = $this->ion_auth->user()->row()->id;
        $data['user_name'] = $full_name;
        $start_date = "";
        $end_date   = "";

        $splitted = (explode("-", $date_range));

        $start_dt = date("Y-m", strtotime($splitted[0]));
        $end_dt = date("Y-m", strtotime($splitted[1]));

        $all_docs_data = $this->ReportsModel->all_doctor_tat_last_month($start_dt, $end_dt, $group_by, $HGroup_id);
//        echo '<pre>'; print_r($all_docs_data); exit;

        $data['all_docs_l_month_data'] = $all_docs_data;
        $log_data = array(
            'request_uri'=>current_url(),
            'file_type'=>'pdf',
            'downloaded_by'=>$doctor_id,
            'downloaded_at'=>date('Y-m-d H:i:s')
        );

        $log_insert = $this->ReportsModel->add_download_log($log_data);
        $data['all_docs_l_month_data'] = $all_docs_data;
        $data['group_by'] = $group_by;
    //    echo "<pre>";print_r($data['all_docs_l_month_data']); echo "</pre>"; exit;
        $this->load->view('reports/export_formats/tat_chart_pdf', $data);
    }

    public function tat_chart_csv()
    {
        $isHAdmin = $this->Userextramodel->isHospitalAdmin();

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (empty($isHAdmin)) {
            redirect('auth/', 'refresh');
        }
        $HGroup_id = $isHAdmin['group_id'];

        $date_range = urldecode(urldecode($date_range));
        $group_by   = urldecode($group_by);
        $userinfo = getLoggedInUserProfile(intval($this->ion_auth->user()->row()->id));
        $full_name = $userinfo[0]->first_name.' '.$userinfo[0]->last_name;
        $doctor_id = $this->ion_auth->user()->row()->id;
        $data['user_name'] = $full_name;
        $start_date = "";
        $end_date   = "";

        $splitted = (explode("-", $date_range));

        $start_dt = date("Y-m", strtotime($splitted[0]));
        $end_dt = date("Y-m", strtotime($splitted[1]));

        $all_docs_data = $this->ReportsModel->all_doctor_tat_last_month($start_dt, $end_dt, $group_by, $HGroup_id);
//        echo '<pre>'; print_r($all_docs_data); exit;

        $data['all_docs_l_month_data'] = $all_docs_data;
        $log_data = array(
            'request_uri'=>current_url(),
            'file_type'=>'csv',
            'downloaded_by'=>$doctor_id,
            'downloaded_at'=>date('Y-m-d H:i:s')
        );

        $log_insert = $this->ReportsModel->add_download_log($log_data);
        $data['all_docs_l_month_data'] = $all_docs_data;
        // echo "<pre>";print_r($data['all_docs_l_month_data']); echo "</pre>"; exit;
        $this->load->view('reports/export_formats/tat_chart_csv', $data);
    }

    public function tat_chart_excel()
    {
        $isHAdmin = $this->Userextramodel->isHospitalAdmin();

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (empty($isHAdmin)) {
            redirect('auth/', 'refresh');
        }
        $HGroup_id = $isHAdmin['group_id'];

        $date_range = urldecode(urldecode($date_range));
        $group_by   = urldecode($group_by);
        $userinfo = getLoggedInUserProfile(intval($this->ion_auth->user()->row()->id));
        $full_name = $userinfo[0]->first_name.' '.$userinfo[0]->last_name;
        $doctor_id = $this->ion_auth->user()->row()->id;
        $data['user_name'] = $full_name;
        $start_date = "";
        $end_date   = "";

        $splitted = (explode("-", $date_range));

        $start_dt = date("Y-m", strtotime($splitted[0]));
        $end_dt = date("Y-m", strtotime($splitted[1]));

        $all_docs_data = $this->ReportsModel->all_doctor_tat_last_month($start_dt, $end_dt, $group_by, $HGroup_id);
//        echo '<pre>'; print_r($all_docs_data); exit;

        $data['all_docs_l_month_data'] = $all_docs_data;
        $log_data = array(
            'request_uri'=>current_url(),
            'file_type'=>'excel',
            'downloaded_by'=>$doctor_id,
            'downloaded_at'=>date('Y-m-d H:i:s')
        );

        $log_insert = $this->ReportsModel->add_download_log($log_data);
        $data['all_docs_l_month_data'] = $all_docs_data;
    //    echo "<pre>";print_r($data['all_docs_l_month_data']); echo "</pre>"; exit;
        $this->load->view('reports/export_formats/tat_chart_excel', $data);
    }

    public function month_records_detail()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->mybreadcrumb->add('Dashboard', base_url('index.php/doctor'));
        $this->mybreadcrumb->add('Reports', '#');
        $this->mybreadcrumb->add('TAT Chart', base_url('index.php/cims/tat_chart'));
        $this->mybreadcrumb->add('Record Search Results', base_url('index.php/cims/month_records_detail'));
        $doctor_id = $this->ion_auth->user()->row()->id;
        $month_val = $this->input->get('m');
        $filter_query=" AND DATE_FORMAT(request.publish_datetime, '%m/%y') = '$month_val'";

        $data['filter_called'] = "0";
//            echo "<pre>"; print_r($this->input->post()); exit;
        $data['sr_by_month'] = 1;
        $data['sr_from'] = '';
        $data['sr_to'] = '';

        if ($this->input->post('search_called')) {
            $data['filter_called']="1";
            $filter_query = "";

            $sr_by_month = $this->input->post('sr_by_month');
            $sr_from = $this->input->post('sr_from');
            $sr_to = $this->input->post('sr_to');

//                echo "By Month: $sr_by_month <br>";
//                echo "From: $sr_from <br>";
//                echo "To: $sr_to <br>";
//                exit;

            if (!empty($sr_by_month)) {
                $data['sr_by_month'] = $sr_by_month;
                if($sr_by_month == '1'){
                    $filter_query = " AND (DATE_FORMAT(request.publish_datetime, '%Y%m') BETWEEN DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 1 MONTH), '%Y%m') 
                                      AND DATE_FORMAT(CURDATE(), '%Y%m'))";
                }
                if($sr_by_month == '2'){
                    $filter_query = " AND (DATE_FORMAT(request.publish_datetime, '%Y%m') BETWEEN DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 3 MONTH), '%Y%m') 
                                      AND DATE_FORMAT(CURDATE(), '%Y%m'))";
                }
                if($sr_by_month == '3'){
                    $filter_query = " AND (DATE_FORMAT(request.publish_datetime, '%Y%m') BETWEEN DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 6 MONTH), '%Y%m') 
                                      AND DATE_FORMAT(CURDATE(), '%Y%m'))";
                }
                if($sr_by_month == '4'){
                    $filter_query = " AND (DATE_FORMAT(request.publish_datetime, '%Y%m') BETWEEN DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 12 MONTH), '%Y%m') 
                                      AND DATE_FORMAT(CURDATE(), '%Y%m'))";
                }
                if($sr_by_month == '5'){
                    $filter_query = " AND (DATE_FORMAT(request.publish_datetime, '%Y%m') BETWEEN DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 24 MONTH), '%Y%m') 
                                      AND DATE_FORMAT(CURDATE(), '%Y%m'))";
                }
//                    echo $data['sr_by_month']; exit;
            }
            if (!empty($sr_from)) {
                $data['sr_from'] = $sr_from;
                $from_dt = date('Ym', strtotime($sr_from));
                echo "From Date: ".$from_dt."<br>";
//                    echo $data['sr_from']; exit;
                $filter_query .= " AND DATE_FORMAT(request.publish_datetime, '%Y%m') >= $from_dt ";
            }
            if (!empty($sr_to)) {
                $data['sr_to'] = $sr_to;
                $to_dt = date('Ym', strtotime($sr_from));
                $filter_query .= " AND DATE_FORMAT(request.publish_datetime, '%Y%m') <= $to_dt ";
            }
//                echo $filter_query; exit;
        }
//        echo "By Month: $sr_by_month <br>";
//        echo "From: $sr_from <br>";
//        echo "To: $sr_to <br>";
//        echo $month_val;exit;

        $data['month_val'] = $month_val;
        $data["query"] = $this->Doctor_model->tat_doctor_record_list($doctor_id, $filter_query);
        $data['request_slides_id'] = $this->Doctor_model->doctor_record_list_with_slide($doctor_id);
//        echo last_query();
        $checkhospital = getRecords("group_id", "users_groups_type", array("user_id" => $doctor_id));
        $hospitallist = array();
        foreach ($checkhospital as $rec) {
            $hospitallist[] = $rec->group_id;
        }
        //echo last_query();exit;
        $hospitals["get_hospitals"] = $this->Doctor_model->display_hospitals_list($hospitallist);
        // echo last_query();exit;
        $breadcrumb['breadcrumbs'] = $this->mybreadcrumb->render();
        $result = array_merge($data, $hospitals, $breadcrumb, $hospitallist);
//        echo '<pre>'; print_r($result); exit;
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/tat_record_list', $result);
        $this->load->view('doctor/inc/footer-new');
    }

    public function month_report_detail()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json['type'] = 'error';
        $json['msg'] = 'Something went wrong';

        $doctor_id = $this->ion_auth->user()->row()->id;
        $report_month = $this->input->post('report_month');
        $report_month = str_replace("/","-",$report_month);
        $data = $this->Doctor_model->doctor_tat_month_detail($doctor_id, $report_month);
//        echo json_encode($data); exit;

        if($data){
            $json['type'] = 'success';
            $json['data'] = $data;
            $json['msg'] = 'Data fetched successfully.';
        }
        echo json_encode($json);
        die;
    }

}