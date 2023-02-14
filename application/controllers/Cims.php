<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Admin Controller
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <firebug.j@gmail.com>
 * @version    1.0.0
 */

class CIMS extends CI_Controller
{
    /**
     * Constructor to load models and helpers
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->load->model('TicketsModel');
        $this->load->model('Doctor_model');
        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));
        track_user_activity(); //Track user activity function which logs user track actions.
    }

    public function cims_dashboard(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->view('cims/inc/header');
        $this->load->view('cims/cims_dashboard');
        $this->load->view('cims/inc/footer');

    }

    public function cims_record_menu(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->view('cims/inc/header');
        $this->load->view('cims/cims_record_menu');
        $this->load->view('cims/inc/footer');

    }

    public function cims_record_list(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->view('doctor/inc/header-new');
        $this->load->view('cims/cims_record_list');
        $this->load->view('doctor/inc/footer-new');

    }
    public function cims_record_detail(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->view('doctor/inc/header-new');
        $this->load->view('cims/cims_record_detail');
        $this->load->view('doctor/inc/footer-new');
    }

    public function visual_tumor_board(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('cims/inc/header');
        $this->load->view('cims/visual_tumor_board');
        $this->load->view('cims/inc/footer');
    }

    public function tat_chart()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['javascripts'] = array(
            'newtheme/js/app.js',
            'js/amcharts/core.js',
            'js/amcharts/charts.js',
            'js/amcharts/animated.js',
            'js/custom_js/tat_doctors.js',
        );
        $data['styles'] = array();


        $userinfo = getLoggedInUserProfile(intval($this->ion_auth->user()->row()->id));
        $full_name = $userinfo[0]->first_name.' '.$userinfo[0]->last_name;
        $doctor_id = $this->ion_auth->user()->row()->id;
        $data['user_name'] = $full_name;
        $twelve_m_data = $this->Doctor_model->doctor_tat_last_12_month($doctor_id);

        $yms = array();
        $now = date('Y-m');
        for($x = 12; $x >=1; $x--) {
            $ym = date('Y-m', strtotime($now . " -$x month"));
            $yms[$ym] = $ym;
        }

        $data_sorted = array();
        $data_sort_itr = 0;

        foreach ($yms as $key=>$value){
            $found_obj = 0;
            $count = 0;
            $yr_mon = $value;
            foreach ($twelve_m_data as $k=>$v){
                if($v->y_m == $yr_mon){
                    $count++;
                    $found_obj = $v;
                }
            }
            if($count==0){
//                Months Not Exists
                $dt_comp = $yr_mon."-01";
                $date_formatted = date('m/y', strtotime($dt_comp));
                $empty_obj = (object) ['y_m' => $yr_mon,'publish_month' => $date_formatted,'num_of_cases' => 0,'tat_less_ten' => 0,'tat_less_ten_percent' => 0,'target_less_ten' => 0, ];
                array_push($data_sorted,$empty_obj);

            }else{
                array_push($data_sorted,$found_obj);
            }
        }

//        echo "<pre>";print_r($data_sorted); echo "</pre>"; exit;
        $data['twelve_month_tat'] = $data_sorted;
        $data['avg_lm_tat'] = $this->Doctor_model->doctor_avg_tat_by_period($doctor_id, 1);
        $data['avg_l3m_tat'] = $this->Doctor_model->doctor_avg_tat_by_period($doctor_id, 3);
        $data['avg_l6m_tat'] = $this->Doctor_model->doctor_avg_tat_by_period($doctor_id, 6);

//        echo '<pre>'; print_r($data['avg_l6m_tat']); exit;
        $this->load->view('templates/header-new', $data);
        $this->load->view('reports/tat_doctors/tat_chart', $data);
        $this->load->view('templates/footer-new',$data);
    }

    public function tat_chart_pdf()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $userinfo = getLoggedInUserProfile(intval($this->ion_auth->user()->row()->id));
        $full_name = $userinfo[0]->last_name.' '.$userinfo[0]->first_name;
        $doctor_id = $this->ion_auth->user()->row()->id;
        $data['user_name'] = $full_name;
        $twelve_m_data = $this->Doctor_model->doctor_tat_last_12_month($doctor_id);

        $yms = array();
        $now = date('Y-m');
        for($x = 12; $x >=1; $x--) {
            $ym = date('Y-m', strtotime($now . " -$x month"));
//            $ym = date_format(strtotime($ym),'y/m');
            $yms[$ym] = $ym;
        }

        $data_sorted = array();
        $data_sort_itr = 0;

        foreach ($yms as $key=>$value){
            $found_obj = 0;
            $count = 0;
            $yr_mon = $value;
            foreach ($twelve_m_data as $k=>$v){
                if($v->y_m == $yr_mon){
//                    echo "Found: ".$yr_mon."<br>";
                    $count++;
                    $found_obj = $v;
                }
            }
            if($count==0){
//                Months Not Exists
                $dt_comp = $yr_mon."-01";
                $date_formatted = date('m/y', strtotime($dt_comp));
                $empty_obj = (object) ['y_m' => $yr_mon,'publish_month' => $date_formatted,'num_of_cases' => 0,'tat_less_ten' => 0,'tat_less_ten_percent' => 0,'target_less_ten' => 0, ];
                array_push($data_sorted,$empty_obj);

            }else{
                array_push($data_sorted,$found_obj);
            }
        }
        $log_data = array(
            'request_uri'=>current_url(),
            'file_type'=>'pdf',
            'downloaded_by'=>$doctor_id,
            'downloaded_at'=>date('Y-m-d H:i:s')
        );

        $log_insert = $this->Doctor_model->add_download_log($log_data);
        $data['twelve_month_tat'] = $data_sorted;
//        echo "<pre>";print_r($data['twelve_month_tat']); echo "</pre>"; exit;
        $this->load->view('reports/tat_doctors/tat_chart_pdf', $data);
    }

    public function tat_chart_csv()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $userinfo = getLoggedInUserProfile(intval($this->ion_auth->user()->row()->id));
        $full_name = $userinfo[0]->last_name.' '.$userinfo[0]->first_name;
        $doctor_id = $this->ion_auth->user()->row()->id;
        $data['user_name'] = $full_name;
        $twelve_m_data = $this->Doctor_model->doctor_tat_last_12_month($doctor_id);

        $yms = array();
        $now = date('Y-m');
        for($x = 12; $x >=1; $x--) {
            $ym = date('Y-m', strtotime($now . " -$x month"));
//            $ym = date_format(strtotime($ym),'y/m');
            $yms[$ym] = $ym;
        }

        $data_sorted = array();
        $data_sort_itr = 0;

        foreach ($yms as $key=>$value){
            $found_obj = 0;
            $count = 0;
            $yr_mon = $value;
            foreach ($twelve_m_data as $k=>$v){
                if($v->y_m == $yr_mon){
//                    echo "Found: ".$yr_mon."<br>";
                    $count++;
                    $found_obj = $v;
                }
            }
            if($count==0){
//                Months Not Exists
                $dt_comp = $yr_mon."-01";
                $date_formatted = date('m/y', strtotime($dt_comp));
                $empty_obj = (object) ['y_m' => $yr_mon,'publish_month' => $date_formatted,'num_of_cases' => 0,'tat_less_ten' => 0,'tat_less_ten_percent' => 0,'target_less_ten' => 0, ];
                array_push($data_sorted,$empty_obj);

            }else{
                array_push($data_sorted,$found_obj);
            }
        }
        $log_data = array(
            'request_uri'=>current_url(),
            'file_type'=>'csv',
            'downloaded_by'=>$doctor_id,
            'downloaded_at'=>date('Y-m-d H:i:s')
        );

        $log_insert = $this->Doctor_model->add_download_log($log_data);
        $data['twelve_month_tat'] = $data_sorted;
//        echo "<pre>";print_r($data['twelve_month_tat']); echo "</pre>"; exit;
        $this->load->view('reports/tat_doctors/tat_chart_csv', $data);
    }

    public function tat_chart_excel()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $userinfo = getLoggedInUserProfile(intval($this->ion_auth->user()->row()->id));
        $full_name = $userinfo[0]->last_name.' '.$userinfo[0]->first_name;
        $doctor_id = $this->ion_auth->user()->row()->id;
        $data['user_name'] = $full_name;
        $twelve_m_data = $this->Doctor_model->doctor_tat_last_12_month($doctor_id);

        $yms = array();
        $now = date('Y-m');
        for($x = 12; $x >=1; $x--) {
            $ym = date('Y-m', strtotime($now . " -$x month"));
//            $ym = date_format(strtotime($ym),'y/m');
            $yms[$ym] = $ym;
        }

        $data_sorted = array();
        $data_sort_itr = 0;

        foreach ($yms as $key=>$value){
            $found_obj = 0;
            $count = 0;
            $yr_mon = $value;
            foreach ($twelve_m_data as $k=>$v){
                if($v->y_m == $yr_mon){
//                    echo "Found: ".$yr_mon."<br>";
                    $count++;
                    $found_obj = $v;
                }
            }
            if($count==0){
//                Months Not Exists
                $dt_comp = $yr_mon."-01";
                $date_formatted = date('m/y', strtotime($dt_comp));
                $empty_obj = (object) ['y_m' => $yr_mon,'publish_month' => $date_formatted,'num_of_cases' => 0,'tat_less_ten' => 0,'tat_less_ten_percent' => 0,'target_less_ten' => 0, ];
                array_push($data_sorted,$empty_obj);

            }else{
                array_push($data_sorted,$found_obj);
            }
        }

        $log_data = array(
            'request_uri'=>current_url(),
            'file_type'=>'excel',
            'downloaded_by'=>$doctor_id,
            'downloaded_at'=>date('Y-m-d H:i:s')
        );

        $log_insert = $this->Doctor_model->add_download_log($log_data);
        $data['twelve_month_tat'] = $data_sorted;
//        echo "<pre>";print_r($data['twelve_month_tat']); echo "</pre>"; exit;
        $this->load->view('reports/tat_doctors/tat_chart_excel', $data);
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