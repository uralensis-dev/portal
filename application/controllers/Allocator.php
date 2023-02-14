<?php

class Allocator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Specialty_model');
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->helper('Permission_helper');
        $this->load->helper('form');
        $this->load->helper(array('url', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));
        track_user_activity();
    }
    
    public function allocate_requests($hospital_id = NULL)
    {
        if (check_user_role('add_institute')) 
		{
            if (empty($hospital_id)) {
                $hospital_id = 1;
            }
            //Show Group Menu
            $data['group_menu'] = [
                'hospital_id' => $hospital_id,
                'groups' => $this->User_model->get_groups(),
                'view' => 'allocate_requests'
            ];
        } 
		else
		{
            $hospital_id = $this->ion_auth->get_users_groups()->row()->id;
        }
        $data['hospital_id'] = $hospital_id;
        $data['requests_by_specialty'] = $this->Specialty_model->get_unassigned_requests($hospital_id);
        $data['requests_needing_attention'] = $this->Specialty_model->get_requests_needing_attention($hospital_id);
        $this->load->view('templates/header-new');
        $this->load->view('allocator/allocate_by_specialty', $data);
        $this->load->view('templates/footer-new');
    }
    
    public function needs_attention($hospital_id = NULL)
    {
        if (check_user_role('add_institute')) {
            if (empty($hospital_id)) {
                $hospital_id = 1;
            }
            //Show Group Menu
            $data['group_menu'] = [
                'hospital_id' => $hospital_id,
                'groups' => $this->User_model->get_groups(),
                'view' => 'needs_attention'
            ];
        } else {
            $hospital_id = $this->ion_auth->get_users_groups()->row()->id;
        }
        $data['requests'] = $this->Specialty_model->get_needs_attention_list($hospital_id);
        $this->load->view('templates/header-new');
        $this->load->view('allocator/needs_attention', $data);
        $this->load->view('templates/footer-new');
    }
    
    public function allocate_specialty_old($specialty_id, $hospital_id = NULL)
    {
        if (check_user_role('add_institute')) {
            if (empty($hospital_id)) {
                $hospital_id = 1;
            }
        } else {
            $hospital_id = $this->ion_auth->get_users_groups()->row()->id;
        }
        $requests = $this->Specialty_model->get_specialty_requests($specialty_id, $hospital_id);
        //Start with next day
        $i = 1;
        $assigend_data = array();
        $date = strtotime("+1 days");
        $end_of_week = false;
        while ($requests) {
            $temp_data = array();
            $date = strtotime("+$i days");
            //Leave loop if end of week is reached
            // if (in_array(date('w', $date), [0, 6])) {
            //     $end_of_week = true;
            //     break;
            // }
            $available_doctors = $this->Specialty_model->get_available_doctors($specialty_id, $hospital_id, date('Y-m-d', $date));
            if (!empty($available_doctors)) {
                //Get next request
                $request = array_pop($requests);
                $assigned = FALSE;
                foreach ($available_doctors as $available_doctor) {
                    //Check for availability for this request
                    if ($request->rcpath <= $available_doctor->available_points) {
                        $this->Specialty_model->assign_to_doctor($request->users_request_id, $available_doctor->doctor_id, date('Y-m-d', $date));
                        $temp_data['request_id'] = $request->users_request_id;
                        $temp_data['date'] = date('Y-m-d', $date);
                        $temp_data['doctor_id'] = $available_doctor->doctor_id;
                        $res = $this->Specialty_model->get_doctor_name($available_doctor->doctor_id);
                        $temp_data['doctor_name'] = $res['first_name']. ' '.$res['last_name'];
                        array_push($assigend_data, $temp_data);
                        $assigned = TRUE;
                        //Exit loop after assigning
                        break 1;
                    }
                }
                if (!$assigned) {
                    //Put request back if not assigned
                    array_push($requests, $request);
                    //Go to next day
                    $i++;
                }
            } else {
                //Go to next day
                $i++;
            }
            if ($i > 7) {    
                break;
            }
        }
        if (empty($requests)) {
            $message = "All cases for this specialty have been allocated<br/>";
            foreach($assigend_data as $data) {
                $message .= "Request with id ".$data['request_id']." is assigned to Dr. ".$data['doctor_name']." with id = ".$data['doctor_id']." on date = ".$data['date']."<br/>";
            }
            $this->session->set_flashdata('allocation_success', $message);
        } else {
            if ($i > 7) {
                $this->session->set_flashdata('allocation_warning', 'No avaible doctors found till date '.date('Y-m-d', $date));
            }
            else if ($end_of_week){
                $this->session->set_flashdata('allocation_warning', 'Allocation could not be completed, no doctors avaiable till weekend');
            }else {
                $this->session->set_flashdata('allocation_warning', 'Allocation could not be completed');
            }
        }
        redirect('allocator/allocate_requests/'.$hospital_id);
    }

    public function allocate_specialty_api($specialty_id, $hospital_id) {
        $requests = $this->Specialty_model->get_specialty_requests_id($specialty_id, $hospital_id);
        $response = array();
        foreach($requests as $req) {
            $specimen_data = $this->Specialty_model->get_request_specimens_data($req['uralensis_request_id']);
            $rc_path_score = 0;
            $t_codes = array();
            foreach($specimen_data as $spec) {
                $rc_path_score += intval($spec['specimen_rcpath_code']);
                array_push($t_codes, array('t_code' => $spec['usmdcode_code'], 'desc' => $spec['specimen_type']));
            }

            // Get Available doctor
            // Start from today and go till weekend
            $day = 1;
            $date = strtotime("+$day days");
            $doctors = array();
            $found = false;
            do {
                $available_doctors = $this->Specialty_model->get_available_doctors($specialty_id, $hospital_id, date('Y-m-d', $date));
                foreach($available_doctors as $doc) {
                    if ($rc_path_score <= $doc->available_points) {
                        $res = $this->Specialty_model->get_doctor_name($doc->doctor_id);
                        $name = $res['first_name']. ' '.$res['last_name'];
                        array_push($doctors, array(
                            'id' => $doc->doctor_id,
                            'name' => $name,
                            'points' => $doc->available_points,
                            'picture' => $res['profile_picture_path'],
                        ));
                        $found = true;
                    }
                }
                if ($found) {
                    break;
                }
                $day_of_week = strtolower(date('D', $date));
                if ($day_of_week == 'sun') {
                    break;
                }
                $day += 1;
                $date = strtotime("+$day days");
            }while(true);
            
            array_push($response, array(
                'request_id' => $req['uralensis_request_id'],
                'serial_number' => $req['serial_number'],
                'date_requested' => date('d-m-Y', strtotime($req['request_datetime'])),
                'specimen_count' => count($specimen_data),
                't_codes' => $t_codes,
                'rc_path_points' => $rc_path_score,
                'date_found' => $found ? date('d-m-Y', $date): null,
                'doctors' => $doctors
            ));
        }
        header('Content-Type: application/json');
        echo json_encode( $response );
    }
    public function allocator($hospital_id=NULL)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        // Get current user
        $user_id = $this->ion_auth->user()->row()->id;
        // Check user type
        $user_type = $this->Specialty_model->get_user_type($user_id);
        if ($user_type == NULL) {
           // return redirect('/', 'refresh');
        }
        $hospitals_list = array();
        $can_allocate = true;
        $choose_hospital = true;
        switch($user_type) {
            case 'A':
                // All hospitals
                $hospitals = $this->Specialty_model->get_hospitals();
                if ($hospital_id == NULL || !is_numeric($hospital_id) || !$this->Specialty_model->is_valid_hospital($hospital_id)) {
                    return redirect('allocator/allocator/'.$hospitals[0]['id'],'refresh');
                }
                foreach ($hospitals as $h) {
                    array_push($hospitals_list, array('id' => $h['id'], 'name' => $h['description']));
                }
            break;
            case 'D':
                // Only allow assigned hospitals
                $hospitals = $this->Specialty_model->get_hospitals();
                if ($hospital_id == NULL || !is_numeric($hospital_id) || !$this->Specialty_model->is_valid_hospital($hospital_id)) {
                    return redirect('allocator/allocator/'.$hospitals[0]['id'],'refresh');
                }
                foreach ($hospitals as $h) {
                    array_push($hospitals_list, array('id' => $h['id'], 'name' => $h['description']));
                }
                $can_allocate = false;
            break;
            case 'H':
                // Get hospital
                $hospital = $this->Specialty_model->get_hospital_user($user_id);
                if ($hospital_id == NULL || !is_numeric($hospital_id) || $hospital['id'] != $hospital_id) {
                    return redirect('allocator/allocator/'.$hospital['id'],'refresh');
                }
                $choose_hospital = false;
				break;
            case 'L':
                // Get hospital
                $hospital = $this->Specialty_model->get_hospital_user($user_id);
                if ($hospital_id == NULL || !is_numeric($hospital_id) || $hospital['id'] != $hospital_id) {
                    return redirect('allocator/allocator/'.$hospital['id'],'refresh');
                }
                $choose_hospital = false;
            break;
            default:
            return redirect('/', 'refresh');
        }
        
        // Week start = 0
        $week = 0;
        $inp_week = $this->input->get('week');
        
        if (is_numeric($inp_week)) {
            $week = intval($inp_week);
            if ($week < 0) $week = 0;
        }
        $monday = strtotime("last monday");
        $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
        
        if ($week > 0) {
            $monday = strtotime("-".($week * 7)." days", $monday);
        }
        $this_week_sd = date("Y-m-d",$monday);
        $today = null;
        if ($week == 0) {
            $today = date("Y-m-d");
        }else{
            $today = date("Y-m-d", strtotime("+6 days", $monday));
        }
        $report = $this->Specialty_model->get_week_allocation_report($hospital_id, $this_week_sd, $today);
        $unique_specialty = array();
        $specs_all = $this->db->query("SELECT * FROM `specialties` ORDER BY `specialty` ASC")->result_array();
        foreach ($specs_all as  $value) {
            array_push($unique_specialty, $value['specialty']);
        }

        $summary_all = array();
        foreach ($report as $day => $r) {
            $assigend_all = 0;
            $unassigned_all = 0;
            $total_all = 0;
            foreach ($unique_specialty as $specialty) {
                $assigned_total = 0;
                $unassigned_total = 0;
                foreach ($r['assigned'] as $a) {
                    if ($a['specialty'] == $specialty) {
                        $assigned_total = intval($a['rcpath_points'] == NULL ? '0': $a['rcpath_points']);
                    }
                }
                foreach ($r['unassigned'] as $a) {
                    if ($a['specialty'] == $specialty) {
                        $unassigned_total = intval($a['rcpath_points'] == NULL ? '0': $a['rcpath_points']);
                    }
                }
                $assigend_all = $assigend_all + $assigned_total;
                $unassigned_all = $unassigned_all + $unassigned_total;
                $total_all = $total_all + ($assigned_total + $unassigned_total);
            }
            $summary_all[$day] = array(
                'unassigned' => $unassigned_all,
                'assigned' => $assigend_all,
                'total' => $total_all
            );
        }
        
        
        $summary = array();
        foreach ($unique_specialty as $specialty) {
            $day_summary = array();
            foreach ($report as $day => $r) {
                $assigned = 0;
                $unassigned = 0;
                foreach($r['assigned'] as $a) {
                    if ($a['specialty'] == $specialty) {
                        $assigned = intval($a['rcpath_points'] == NULL ? '0': $a['rcpath_points']);
                        break;
                    }
                }
                foreach($r['unassigned'] as $a) {
                    if ($a['specialty'] == $specialty) {
                        $unassigned = intval($a['rcpath_points'] == NULL ? '0': $a['rcpath_points']);
                        break;
                    }
                }
                $total = $unassigned + $assigned;
                $day_summary[$day] = array(
                    'assigned' => $assigned,
                    'unassigned' => $unassigned,
                    'total' => $total
                );
            }
            $summary[$specialty] = $day_summary;
        }

        // TODO: Change dates to current
        // $this_week_sd = date("Y-m-d", strtotime('2020-08-03'));
        // $today = date("Y-m-d", strtotime('2020-08-05'));
        $start_date = $this_week_sd;
        $day_of_weeks = array();
        $specialty_report_till_today = array();
        $specialty_rcpath_total = array();
        $days = array();
        while ($start_date <= $today) {
            $day_of_week = strtolower(date('D', strtotime($start_date)));
            array_push($day_of_weeks, $day_of_week);
            array_push($days, $start_date);
            $specialty_rcpath_total[$day_of_week] = $this->Specialty_model->get_total_rcpath_day($start_date, $hospital_id);
            $specialty_report_till_today[$day_of_week] = $this->Specialty_model->get_doctor_calculated_day($start_date, $hospital_id);
            $start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));
        }


        $specialty_report_complete = array();

        foreach ($specialty_report_till_today as $day => $report) {
            foreach ($report as $spec => $docs) {
                $specialty_report_complete[$spec] = array();
                $specialty_report_complete[$spec][0] = array();
                foreach ($day_of_weeks as $day2) {
                    $specialty_report_complete[$spec][0][$day2] = array('rcpath' => 0, 'cases' => 0);   
                }
                foreach ($docs as $ind => $doc) {
                    $specialty_report_complete[$spec][$doc['doc']] = array();
                    foreach ($day_of_weeks as $day2) {
                        $specialty_report_complete[$spec][$doc['doc']][$day2] = array();
                        
                    }
                }
            }
        }

        $count = 0;
        foreach ($specialty_report_till_today as $day => $report) {
            $spec_str = "(";
            foreach($report as $spec => $docs) {
                $total_est_points = 0;
                foreach ($docs as $ind => $doc) {
                    $total_est_points += $doc['est'];
                }
                foreach($docs as $ind => $doc) {
                    
                    $doc['est_percent'] = $total_est_points == 0? 0: $doc['est'] / $total_est_points * 100;

                    array_push($specialty_report_complete[$spec][$doc['doc']][$day], $doc);
                }
                $spec_str = $spec_str.''.$spec.',';
            }
            if (strlen($spec_str) != 1) {
                $spec_str = substr($spec_str, 0, -1).')';
                $unalloc = $this->Specialty_model->get_unallocated_specialty_day($spec_str, $days[$count], $hospital_id);
                foreach ($unalloc as $val) {
                    $specialty_report_complete[$val['speciality_id']][0][$day]['rcpath'] = $val['rcpath'];
                    $specialty_report_complete[$val['speciality_id']][0][$day]['cases'] = $val['requests'];
                }
            }
            $count++;
        }
        
        $doctor_week_report = $this->Specialty_model->get_doctor_week_report($hospital_id, $this_week_sd, $today);

        $current_tab = $this->input->get('tab') == NULL ? '': $this->input->get('tab');
        $specialty_tab = $this->input->get('specialty') == NULL ? '' : $this->input->get('specialty');

        $all_weeks_list = array();
        $last_moday = strtotime("last monday");
        $last_moday = date('w', $last_moday)==date('w') ? $last_moday+7*86400 : $last_moday;
        
        
        for ($i=0; $i < 21; $i++) { 
            $temp = $last_moday;    
            if ($i > 0) {
                $temp = strtotime("-".($i * 7)." days", $temp);
            }
            $start = date("d-M-Y",$temp);
            $end = null;
            if ($i == 0) {
                $end = date("d-M-Y");
            }else{
                $end = date("d-M-Y", strtotime("+6 days", $temp));
            }
            array_push($all_weeks_list, $start.' - '.$end);
        }

        $data = array(
            'week_summary' => $summary,
            'week_summary_all' => $summary_all,
            'specialty_report_complete' => $specialty_report_complete,
            'doctor_week_report' => $doctor_week_report,
            'specialties' => $this->Specialty_model->get_specialty_name_list(),
            'doctors' => $this->Specialty_model->get_doctor_name_list(),
            'current_tab' => $current_tab,
            'current_specialty' => $specialty_tab,
            'hospitals' => $hospitals_list,
            'hospital_name' => $this->db->query("SELECT `description` FROM `groups` WHERE `id` = $hospital_id")->result_array()[0]['description'],
            'choose_hospital' => $choose_hospital,
            'can_allocate' => $can_allocate,
            'hospital_id' => $hospital_id,
            'week_start' => $this_week_sd,
            'week_end' => $today,
            'week' => $week,
            'week_list' => $all_weeks_list
        );
        $this->load->view('templates/header-new');
        $this->load->view('allocator/allocator', $data);
        $this->load->view('templates/footer-new');
    }
    public function work_load_activity()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('templates/header-new');
        
        $this->load->view('allocator/work_load_activity');
        $this->load->view('templates/footer-new');
    }
    public function allocated_requests($hospital_id = NULL)
    {
        if (check_user_role('add_institute')) {
            if (empty($hospital_id)) {
                $hospital_id = 1;
            }
            //Show Group Menu
            $data['group_menu'] = [
                'hospital_id' => $hospital_id,
                'groups' => $this->User_model->get_groups(),
                'view' => 'allocated_requests'
            ];
        } else {
            $hospital_id = $this->ion_auth->get_users_groups()->row()->id;
        }
        $day = date('w');
        $week_start = date('Y-m-d', strtotime('-' . $day . ' days'));
        $week_end = date('Y-m-d', strtotime('+5 days'));
        $week = [];
        $allocation = [];
        $leave = [];
        //TODO: Get user leave in terms of group
        $leave_requests = $this->User_model->get_user_leave($week_start, $week_end);
        foreach ($leave_requests as $leave_request) {
            $leave[$leave_request->name] = $leave_request;
        }
        for ($i = 1; $i <= 5; $i++) {
            $date = date('Y-m-d', strtotime($week_start . ' +' . $i . 'days'));
            $week[] = $date;
            $result = $this->Specialty_model->get_allocated_requests($date, $hospital_id);
            foreach ($result as $row) {
                $allocation[$row->name][$date] = $row;
            }
        }
        $data['week'] = $week;
        $data['allocation'] = $allocation;
        $data['leave'] = $leave;
        $this->load->view('templates/header-new');
        $this->load->view('allocator/allocated_requests', $data);
        $this->load->view('templates/footer-new');
    }

    public function allocate_specialty_requests() {
        $data = $this->input->post('data');
        $specialty_id = $this->input->post('specialty_id');
        $hospital_id = $this->input->post('hospital_id');
        $this->Specialty_model->allocate_request_specialty($specialty_id, $data, $hospital_id);
        $this->db->where('id', $specialty_id);
        $res = $this->db->get('specialties')->result_array();
        $specialty = '';
        if (count($res) != 0) {
            $specialty = $res[0]['specialty'];
        } 
        header('Content-Type: application/json');
        echo json_encode( array('status'=> 'success', 'specialty' => $specialty));
    }


    // THIS IS FOR DEVELOPEMENT PURPOSES ONLY
    public function request_updates() {
        if (!$this->ion_auth->logged_in()) {
            return redirect('auth/login', 'refresh');
        }
        if (base_url() != 'https://pathhub.uralensisdigital.co.uk/development/') {
            return redirect('/', 'refresh');
        }
        $res = $this->db->query("SELECT request_id FROM `users_request` WHERE `doctor_id` = 0")->result_array();
        $unallocated = count($res);
        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            $this->load->view('allocator/request_updates', array(
                'unallocated' => $unallocated
            ));
        } else if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->input->post('allocator_type');
            $script_path = '/home/uralensisdigital/py_scripts/';
            $res = '';
            if ($data == 'dates') {
                $res = shell_exec("python3 ".$script_path."update_request_dates.py");
            }else if ($data == 'ic') {
                $res = shell_exec("python3 ".$script_path."shuffle_date_10.py");
            }else if ($data == 'unallocated') {
                $res = shell_exec("python3 ".$script_path."unallocate.py");
            }
            
            return redirect('/allocator/request_updates', 'refresh');
        }

    }
    
}