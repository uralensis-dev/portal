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

class Timesheet extends CI_Controller
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

        $this->user_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_groups()->row();
        $this->group_type = $group_row->group_type;
        $this->group_id = $group_row->id;
    }

    public function index(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->model('Userextramodel');
//        $data['javascripts'] = array(
//            'datetime/moment.js',
//            'datetime/bootstrap-datetimepicker.min.js',
//            'js/custom_js/timesheet.js',
//        );
//        $data['styles'] = array(
//            'datetime/bootstrap-datetimepicker.min.css'
//        );
        $user_id= $this->ion_auth->user()->row()->id;
        $getTimeSheetList = "SELECT count(ut.id) as total_task,ut.user_id,ut.task_date,SUM(ut.hours) as total_duration,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
                             AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
                             profile_picture_path
                         FROM `user_timesheet` ut
                          JOIN users us ON ut.user_id=us.id
                          WHERE ut.user_id=$user_id GROUP BY ut.task_date";

        $data['userTimeSheetData'] = $this->db->query($getTimeSheetList)->result();

        $current_date = date("Y-m-d");
        $sqlQuery = "SELECT count(ut.id) as total,ut.start_time
                          FROM `user_timesheet` ut
                          WHERE ut.user_id=$user_id AND ut.task_date='$current_date' AND ut.end_time IS NULL";

        $getData = $this->db->query($sqlQuery)->row();
        $data['start_time'] = $getData->start_time;
        $data['end_time_status'] = $getData->total;

//        echo "<pre>";print_r($getUserData);exit;



        $data['javascripts'] = array(
//            'subassets/js/new_jquery.datetimepicker.js',
            'js/custom_js/timesheet.js',
        );
//        $data['styles'] = array(
//            'subassets/css/new_jquery.datetimepicker.css'
//        );


        $this->load->view('templates/header-new',$data);
        $this->load->view('timesheet/timesheet',$data);
        $this->load->view('templates/footer-new',$data);
    }

    public function timeDetail($getData){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->model('Userextramodel');

        $decodeData = explode("__",base64_decode($getData));
        $user_id = $decodeData[0];
        $task_date = $decodeData[1];


//        $data['javascripts'] = array(
//            'datetime/moment.js',
//            'datetime/bootstrap-datetimepicker.min.js',
//            'js/custom_js/timesheet.js',
//        );
//        $data['styles'] = array(
//            'datetime/bootstrap-datetimepicker.min.css'
//        );
//        $user_id= $this->ion_auth->user()->row()->id;
        $getTimeSheetList = "SELECT ut.*,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
                             AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
                             profile_picture_path
                         FROM `user_timesheet` ut
                          JOIN users us ON ut.user_id=us.id
                          WHERE ut.user_id=$user_id AND ut.task_date='$task_date'";

        $data['userTimeSheetData'] = $this->db->query($getTimeSheetList)->result();

        $current_date = date("Y-m-d");
        $sqlQuery = "SELECT count(ut.id) as total,ut.start_time
                          FROM `user_timesheet` ut
                          WHERE ut.user_id=$user_id AND ut.task_date='$current_date' AND ut.end_time IS NULL";

        $getData = $this->db->query($sqlQuery)->row();
        $data['start_time'] = $getData->start_time;
        $data['end_time_status'] = $getData->total;

//        echo "<pre>";print_r($getUserData);exit;



        $data['javascripts'] = array(
//            'subassets/js/new_jquery.datetimepicker.js',
            'js/custom_js/timesheet.js',
        );
//        $data['styles'] = array(
//            'subassets/css/new_jquery.datetimepicker.css'
//        );


        $this->load->view('templates/header-new',$data);
        $this->load->view('timesheet/timesheet_detail',$data);
        $this->load->view('templates/footer-new',$data);
    }

    public function timeReport(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->model('Userextramodel');
//        $data['javascripts'] = array(
//            'datetime/moment.js',
//            'datetime/bootstrap-datetimepicker.min.js',
//            'js/custom_js/timesheet.js',
//        );
//        $data['styles'] = array(
//            'datetime/bootstrap-datetimepicker.min.css'
//        );

        if($this->group_type=="A"){
            $this->db->select("id,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
                                  AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
                                  profile_picture_path", FALSE);
            $userResult = $this->db->get('users')->result();
        }
        else if($this->group_type=="HA"){
            $hospital_id = $this->ion_auth->get_user_group_type()->row()->id;
            $this->db->select("`users`.`id` as id, AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, 
                                  AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
                                  AES_DECRYPT(email, '" . DATA_KEY . "') AS email,profile_picture_path
                                  ", FALSE);
            $this->db->join('users', 'users.id = users_groups.user_id');
            $this->db->where('institute_id', $hospital_id);
            $this->db->where('group_id IS NULL');
            $userResult = $this->db->get('users_groups')->result();
        }
        else if($this->group_type=="LA"){
            $laboratoryId = $this->ion_auth->get_user_group_type()->row()->id;
            $this->db->select("`users`.`id` as id, AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name, 
                                    AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name,
                                    AES_DECRYPT(email, '".DATA_KEY."') AS email,profile_picture_path
                                    ", FALSE);
            $this->db->join('users', 'users.id = users_groups.user_id');
            $this->db->where('institute_id', $laboratoryId);
            $this->db->where('group_id IS NULL');
            $userResult = $this->db->get('users_groups')->result();
        }
        $data['usersData'] = $userResult;


        if($_SERVER['REQUEST_METHOD']=="POST"){
            $postDates = $this->input->post("start_end_date");
            $timeUser = $this->input->post("timereport_users");
            $explodeDates = explode(" - ",$postDates);
            $startDate = date("Y-m-d",strtotime($explodeDates[0]));
            $endDate = date("Y-m-d",strtotime($explodeDates[1]));

            if($this->group_type=="A"){
//                $sqlQuery = "SELECT count(ut.id) as total_task,ut.user_id,ut.task_date,SUM(ut.hours) as total_duration,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
//                             AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
//                             profile_picture_path
//                             FROM `user_timesheet` ut
//                             JOIN users us ON ut.user_id=us.id
//                             WHERE ut.task_date BETWEEN '$startDate' AND '$endDate' GROUP BY ut.task_date,ut.user_id
//                             ORDER BY ut.task_date DESC";
                $this->db->select("count(ut.id) as total_task,ut.user_id,ut.task_date,SUM(ut.hours) as total_duration,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
                                  AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
                                  profile_picture_path", FALSE);
                $this->db->join('users', 'users.id = ut.user_id');
                $this->db->where("ut.task_date BETWEEN '$startDate' AND '$endDate'");
                if($timeUser!=""){
                    $this->db->where("ut.user_id",$timeUser);
                }
                $this->db->group_by("ut.task_date,ut.user_id");
                $this->db->order_by("ut.task_date DESC");
                $result = $this->db->get('user_timesheet ut')->result();
            }
            else if($this->group_type=="HA"){
                $hospital_id = $this->ion_auth->get_user_group_type()->row()->id;
                $this->db->select("count(ut.id) as total_task,ut.user_id,ut.task_date,SUM(ut.hours) as total_duration,`users`.`id` as id, AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, 
                                  AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
                                  AES_DECRYPT(email, '" . DATA_KEY . "') AS email
                                  ", FALSE);
                $this->db->join('users', 'users.id = users_groups.user_id');
                $this->db->join('user_timesheet ut', 'ut.user_id = users.id');
                $this->db->where('institute_id', $hospital_id);
                $this->db->where('group_id IS NULL');
                $this->db->where("ut.task_date BETWEEN '$startDate' AND '$endDate'");
                if($timeUser!=""){
                    $this->db->where("ut.user_id",$timeUser);
                }
                $this->db->group_by("ut.task_date,ut.user_id");
                $this->db->order_by("ut.task_date DESC");
                $result = $this->db->get('users_groups')->result();
            }
            else if($this->group_type=="LA"){
                $laboratoryId = $this->ion_auth->get_user_group_type()->row()->id;
                $this->db->select("count(ut.id) as total_task,ut.user_id,ut.task_date,SUM(ut.hours) as total_duration,`users`.`id` as id, AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name, 
                                    AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name,
                                    AES_DECRYPT(email, '".DATA_KEY."') AS email
                                    ", FALSE);
                $this->db->join('users', 'users.id = users_groups.user_id');
                $this->db->join('user_timesheet ut', 'ut.user_id = users.id');
                $this->db->where('institute_id', $laboratoryId);
                $this->db->where('group_id IS NULL');
                $this->db->where("ut.task_date BETWEEN '$startDate' AND '$endDate'");
                if($timeUser!=""){
                    $this->db->where("ut.user_id",$timeUser);
                }
                $this->db->group_by("ut.task_date,ut.user_id");
                $this->db->order_by("ut.task_date DESC");
                $result = $this->db->get('users_groups')->result();
            }
            $data['userTimeSheetData'] = $result;

            $data['date_filtered'] = $postDates;
            $data['postDates'] = $startDate." - ".$endDate;
            $data['userFilter'] = $timeUser;

        }

//        echo "<pre>";print_r($data['usersData']);exit;

        $data['styles'] = array(
            'css/daterangepicker.css'
        );
        $data['javascripts'] = array(
            'js/daterangepicker.js',
            'js/custom_js/timesheet.js',
        );

        $this->load->view('templates/header-new',$data);
        $this->load->view('timesheet/timesheet_report',$data);
        $this->load->view('templates/footer-new',$data);
    }

    public function addTask(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $current_date = date("Y-m-d");
            $user_id=$this->ion_auth->user()->row()->id;
            $sqlQuery = "SELECT ut.*
                          FROM `user_timesheet` ut
                          WHERE ut.user_id=$user_id AND ut.task_date='$current_date' AND ut.end_time IS NULL";

            $time_data = $this->db->query($sqlQuery)->row();

            if(!empty($time_data)){
                $time_id = $time_data->id;
                $end_time = date("H:i:s");
                $start_date_time = $time_data->task_date." ".$time_data->start_time;
                $end_date_time = $time_data->task_date." ".$end_time;
                // Create two new DateTime-objects...
                $date1 = new DateTime($start_date_time);
                $date2 = new DateTime($end_date_time);

                // The diff-methods returns a new DateInterval-object...
                $diff = $date2->diff($date1);
                // Call the format method on the DateInterval-object
                $hours = $diff->format('%h');
                $mint = $diff->format('%i');
                $totalHour = number_format((float)($hours+($mint/60)), 2, '.', '');

                $updateData['end_time'] = $end_time;
                $updateData['hours'] = $totalHour;
                $updateData['description'] = $this->input->post("task_detail");
                $retRes = $this->db->where(array('id'=>$time_id))->update("user_timesheet",$updateData);
                if($retRes){
                    $response['status'] = "success";
                    $response['message'] = "Time stopped successfully";
                } else {
                    $response['status'] = "fail";
                    $response['message'] = "Failed to stop time. Please try again.";
                }
                echo json_encode($response);exit;
            }
        }
    }

    public function startTime(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $insRecord['user_id'] = $this->ion_auth->user()->row()->id;
            $insRecord['task_name'] = NULL;
            $insRecord['task_date'] = date("Y-m-d");
            $insRecord['start_time'] = date("H:i:s");
//            $insRecord['end_time'] = date("H:i:s");
//            $insRecord['description'] = $this->input->post("description");
//            $insRecord['assigned_by'] = $this->ion_auth->user()->row()->id;
            $insRecord['created_date'] = date("Y-m-d H:i:s");
            $retRes = $this->db->insert("user_timesheet",$insRecord);
            if($retRes){
                $response['status'] = "success";
                $response['message'] = "Time started successfully";
            } else {
                $response['status'] = "fail";
                $response['message'] = "Failed to start time. Please try again.";
            }
            echo json_encode($response);exit;
        }
    }

    public function stopTime(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $current_date = date("Y-m-d");
            $user_id=$this->ion_auth->user()->row()->id;
            $sqlQuery = "SELECT ut.*
                          FROM `user_timesheet` ut
                          WHERE ut.user_id=$user_id AND ut.task_date='$current_date' AND ut.end_time IS NULL";

            $time_data = $this->db->query($sqlQuery)->row();

            if(!empty($time_data)){
                $time_id = $time_data->id;
                $end_time = date("H:i:s");
                $start_date_time = $time_data->task_date." ".$time_data->start_time;
                $end_date_time = $time_data->task_date." ".$end_time;
                // Create two new DateTime-objects...
                $date1 = new DateTime($start_date_time);
                $date2 = new DateTime($end_date_time);

                // The diff-methods returns a new DateInterval-object...
                $diff = $date2->diff($date1);
                // Call the format method on the DateInterval-object
                $hours = $diff->format('%h');
                $mint = $diff->format('%i');
                $totalHour = number_format((float)($hours+($mint/60)), 2, '.', '');

                $updateData['end_time'] = $end_time;
                $updateData['hours'] = $totalHour;
                $retRes = $this->db->where(array('id'=>$time_id))->update("user_timesheet",$updateData);
                if($retRes){
                    $response['status'] = "success";
                    $response['message'] = "Time stopped successfully";
                } else {
                    $response['status'] = "fail";
                    $response['message'] = "Failed to stop time. Please try again.";
                }
                echo json_encode($response);exit;
            }
        }
    }

    public function updateSessionTime(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $current_date = date("Y-m-d");
            $user_id=$this->ion_auth->user()->row()->id;
            $sqlQuery = "SELECT ut.*
                          FROM `user_timesheet` ut
                          WHERE ut.user_id=$user_id AND ut.task_date='$current_date' AND ut.end_time IS NULL";

            $time_data = $this->db->query($sqlQuery)->row();

            if(!empty($time_data)){
                $time_id = $time_data->id;
                $end_time = date("H:i:s");
                $start_date_time = $time_data->start_time;
                $end_date_time = $end_time;
                // Create two new DateTime-objects...
                $date1 = new DateTime($start_date_time);
                $date2 = new DateTime($end_date_time);

                // The diff-methods returns a new DateInterval-object...
                $diff = $date2->diff($date1);
                // Call the format method on the DateInterval-object
                $hours = $diff->format('%h');
                $mint = $diff->format('%i');
                $totalDurationSessionTime = sprintf("%02d", $hours).":".sprintf("%02d", $mint);

                $response['status'] = "success";
                $response['totalDurationSessionTime'] = "Session Time: ".$totalDurationSessionTime;
                echo json_encode($response);exit;
            }
        }
    }

    public function updateTaskDetail(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $time_id = $this->input->post("timesheet_id");
            $updateData['description'] = $this->input->post("task_detail");
            $retRes = $this->db->where(array('id'=>$time_id))->update("user_timesheet",$updateData);
            if($retRes){
                $response['status'] = "success";
                $response['message'] = "Details added successfully";
            } else {
                $response['status'] = "fail";
                $response['message'] = "Failed to add detail. Please try again.";
            }
            echo json_encode($response);exit;
        }
    }

    public function updateTaskComment(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $time_id = $this->input->post("task_comment_id");
            $user_id = $this->ion_auth->user()->row()->id;
            $description = $this->input->post("flag_comment");
            $dataSection = $this->input->post("data_section");
            $updateData['record_id'] = $time_id;
            $updateData['user_id'] = $user_id;
            $updateData['description'] = $description;
            $updateData['module_id'] = C_TIMESHEET;
//            $retRes = $this->db->where(array('id'=>$time_id))->update("user_timesheet",$updateData);

            $edit_status = $this->input->post("edit_status");
            if($edit_status==1){
                $edit_id = $this->input->post("edit_com_id");
                $updateInData['description'] = $description;
                $updateInData['created_date'] = date("Y-m-d H:i:s");
                $retRes = $this->db->where(array("id"=>$edit_id))->update("section_comments",$updateInData);
            } else {
                $retRes = $this->db->insert("section_comments",$updateData);

            }

            $getCommentDetails = $this->getCommentDetails($time_id,$dataSection,true);

            if($retRes){
                $response['status'] = "success";
                $response['message'] = "Comment Saved Successfully";
                $response['html'] = $getCommentDetails;
            } else {
                $response['status'] = "fail";
                $response['message'] = "Failed to add detail. Please try again.";
            }
            echo json_encode($response);exit;
        }
    }

    public function likeComment(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $response = saveFlagLikeData($_POST);
            echo json_encode($response);exit;
        }
    }

    public function getCommentDetails($commentId,$dataSection=FALSE,$retFlag=FALSE){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if($_SERVER["REQUEST_METHOD"]=="POST" OR !empty($commentId)){
            $commentHtml = getFlagCommentDetails($commentId,$_POST,$dataSection);
            if($retFlag){
                return $commentHtml;
            } else {
                $response['status'] = "success";
                $response['html'] = $commentHtml;
                echo json_encode($response);exit;
            }
        }
    }
}