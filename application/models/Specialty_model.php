<?php

class Specialty_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_request_specimens($request_id)
    {
        return $this->db->select('specimen_id, specimen_type, speciality_id')
                        ->from('request_specimen')
                        ->join('specimen', 'rs_specimen_id = specimen_id')
                        ->where('rs_request_id', $request_id)
                        ->get()
                        ->result();
    }
    
    public function get_available_doctors($specialty_id, $hospital_id, $date = NULL)
    {
        $date = empty($date) ? date('Y-m-d', strtotime('+1 days')) : $date;
        $day_of_week = strtolower(date('D', strtotime($date)));
        //TODO check leave and job plan when pulling doctors
        //TODO restrict doctors to a hospital
        $doctor_group = $this->db->get_where('groups', ['group_type' => 'D'])->row();
        $doctors = $this->db->select('users_groups.user_id, pa')
                            ->from('users_groups')
                            ->join('usermeta', 'users_groups.user_id = usermeta.user_id')
                            ->join('user_job_plan', 'users_groups.user_id = user_job_plan.user_id')
                            ->where('group_id', $doctor_group->id)
                            ->where('meta_key', 'specialty_id')
                            ->where('meta_value', $specialty_id)
                            ->where($day_of_week, 1) //Is working this day
                            ->get()
                            ->result();
        "SELECT users_groups.user_id, pa from users_groups join usermeta on users_groups.user_id = usermeta.user_id
                join user_job_plan on users_groups.user_id = user_job_plan.user_id where group_id = 6 and meta_key = 'specialty_id' and meta_value = 2
        ";
        $available_doctors = [];
        foreach ($doctors as $doctor) {
            $on_leave = $this->db->where("user_id", $doctor->user_id)
                                 ->where("DATE('$date') BETWEEN start AND end", NULL)
                                 ->count_all_results("user_leave");
            //If doctor is not on leave
            if ($on_leave === 0) {
                $request_query = "SELECT doctor_id,
                       COUNT(date_assigned) AS cases,
                       pa,
                       SUM(CASE WHEN date_assigned = '$date' THEN specimen_rcpath_code ELSE 0 END)      AS current_points,
                       pa - SUM(CASE WHEN date_assigned = '$date' THEN specimen_rcpath_code ELSE 0 END) AS available_points
                FROM users_request
                         JOIN user_job_plan ON users_request.doctor_id = user_job_plan.user_id
                         JOIN request ON users_request.request_id = uralensis_request_id
                         JOIN request_specimen ON request_id = request_specimen.rs_request_id
                         JOIN specimen ON request_specimen.rs_specimen_id = specimen.specimen_id
                WHERE doctor_id = $doctor->user_id";
                $doctor_availability = $this->db->query($request_query)->row();
                //Fill with default
                $doctor_availability->doctor_id = $doctor_availability->doctor_id ?? $doctor->user_id;
                $doctor_availability->current_points = $doctor_availability->current_points ?? 0;
                $doctor_availability->available_points = $doctor_availability->available_points ?? $doctor->pa;
                $available_doctors[] = $doctor_availability;
            }
        }
        
        return $available_doctors;
    }
    
    public function assign_to_doctor($request_id, $doctor_id, $date)
    {

        // $this->db->where('users_request_id', $request_id)
        //          ->update('users_request', [
        //              'doctor_id' => $doctor_id,
        //              'date_assigned' => $date
        //          ]);
        return;
        $this->db->query("update request set
            assign_status = 1 where uralensis_request_id = $request_id");

        $this->db->query("insert into request_assignee (request_id, user_id, assign_status)
        values ($request_id, $doctor_id, 1)");
        
        $this->db->query("update users_request set doctor_id = $doctor_id, date_assigned = '$date' where request_id = $request_id");
        $doctor_name = $this->get_doctor_name($doctor_id);
        $name = $doctor_name['first_name'].' '.$doctor_name['last_name'];
        $this->db->query("update uralensis_record_track_status
        set ura_rec_track_status = 'With Doctor',
        ura_rec_track_pathologist = '$name'
        where ura_rec_track_record_id = $request_id");


    }

    public function get_doctor_name($doctor_id) {
        $query = "SELECT AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
                    AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, profile_picture_path from users where id = $doctor_id";
        return $this->db->query($query)->result_array()[0];
    }

    public function get_specialty_name_list() {
        $res = $this->db->query("SELECT * FROM `specialties`")->result_array();
        $specialties = array();
        foreach ($res as $val) {
            $specialties[intval($val['id'])] = $val['specialty'];
        }
        return $specialties;
    }

    public function get_doctor_name_list() {
        $query =  "SELECT AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name, AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name, `users`.`id` as `id` from `users` INNER JOIN users_groups ON `users`.`id` = `users_groups`.`user_id` INNER JOIN `groups` ON `groups`.`id` = `users_groups`.`group_id` WHERE `groups`.`group_type` = 'D'";
        $res = $this->db->query($query)->result_array();
        $doctors = array();
        foreach ($res as $val) {
            $doctors[intval($val['id'])] = 'Dr. '.$val['first_name'].' '.$val['last_name'];
        }
        return $doctors;
    }

    public function get_doctor_name_list_new($hospital_id) {
        $query =  "SELECT AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name, AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name, `users`.`id` as `id` 
        from `users` 
        INNER JOIN users_groups ON `users`.`id` = `users_groups`.`user_id` 
        WHERE users_groups.institute_id=$hospital_id";
        $res = $this->db->query($query)->result_array();

        $query2 = "SELECT GROUP_CONCAT(users.id) as id from `users` INNER JOIN users_groups ON `users`.`id` = `users_groups`.`user_id` INNER JOIN `groups` ON `groups`.`id` = `users_groups`.`group_id` WHERE `groups`.`group_type` = 'D'";
        $totalIds = $this->db->query($query2)->row()->id;
        $drIdArr = explode(',', $totalIds);

        $doctors = array();
        foreach ($res as $val) {
            if(in_array($val['id'], $drIdArr)){
                $doctors[intval($val['id'])] = 'Dr. '.$val['first_name'].' '.$val['last_name'];
            }
        }
        return $doctors;
    }
    
    public function get_specialty_requests($speciality_id, $hospital_id)
    {
        $query = "SELECT uralensis_request_id,
                   users_request_id,
                   users_id,
                   serial_number,
                   DATE(request_datetime)    as request_datetime,
                   SUM(specimen_rcpath_code) as rcpath,
                   COUNT(rs_specimen_id) as num_specimen,
            FROM uralensis_record_track_status
                     JOIN users_request ON ura_rec_track_record_id = request_id
                     JOIN request ON request_id = uralensis_request_id
                     JOIN request_specimen ON uralensis_request_id = request_specimen.rs_request_id
                     JOIN specimen ON request_specimen.rs_specimen_id = specimen.specimen_id
            WHERE group_id = $hospital_id
              AND speciality_id = $speciality_id
              AND ura_rec_track_status = 'Ready To Allocate'
              AND specimen_rcpath_code > 0
              AND doctor_id = 0
            GROUP BY speciality_id, uralensis_request_id
            ORDER BY request_datetime DESC";
        return $this->db->query($query)->result();
    }

    public function get_specialty_requests_id($speciality_id, $hospital_id) {
        $query = "SELECT uralensis_request_id, serial_number, DATE(request_datetime) as request_datetime
            FROM uralensis_record_track_status
                     JOIN users_request ON ura_rec_track_record_id = request_id
                     JOIN request ON request_id = uralensis_request_id
                     JOIN request_specimen ON uralensis_request_id = request_specimen.rs_request_id
                     JOIN specimen ON request_specimen.rs_specimen_id = specimen.specimen_id
            WHERE group_id = $hospital_id
              AND speciality_id = $speciality_id
              AND ura_rec_track_status = 'Ready To Allocate'
              AND specimen_rcpath_code > 0
              AND doctor_id = 0
            GROUP BY speciality_id, uralensis_request_id
            ORDER BY request_datetime DESC";
        return $this->db->query($query)->result_array();
    }
    
    public function get_request_specimens_data($request_id) {
        $query = 
        "SELECT usmdcode_code, specimen_type, specimen_rcpath_code 
        from specimen
        JOIN request_specimen ON specimen.specimen_id = request_specimen.rs_specimen_id
        LEFT JOIN uralensis_snomed_codes ON specimen_type = uralensis_snomed_codes.usmdcode_code_desc
        where request_specimen.rs_request_id = $request_id";

        return $this->db->query($query)->result_array();
    }

    public function get_unassigned_requests($group_id)
    {
        //Get unassigned requests by specialty
        $query = "SELECT specialty,
       DATE_FORMAT(MIN(request_datetime), '%d %M %Y') as from_date,
       COUNT(DISTINCT users_request.request_id)                     as cases,
       SUM(specimen_rcpath_code)                      as rcpath,
       speciality_id,
       specimen_type
FROM uralensis_record_track_status
         JOIN users_request ON ura_rec_track_record_id = request_id
         JOIN request ON request_id = uralensis_request_id
         JOIN request_specimen ON uralensis_request_id = request_specimen.rs_request_id
         JOIN specimen ON request_specimen.rs_specimen_id = specimen.specimen_id
         JOIN specialties on speciality_id = specialties.id
WHERE group_id = $group_id
  AND ura_rec_track_status = 'Ready To Allocate'
  AND specimen_rcpath_code > 0
  AND doctor_id = 0
GROUP BY specialty";
        $requests = $this->db->query($query)->result();
        
        return $requests;
    }
    
/**
 * OLD QUERY TO FETCH SPECIALTY 
 * FROM uralensis_record_track_status	FROM uralensis_record_track_status
 *        JOIN users_request ON ura_rec_track_record_id = request_id	         JOIN users_request ON ura_rec_track_record_id = request_id
 *        JOIN request ON request_id = uralensis_request_id	         JOIN request ON request_id = uralensis_request_id
 *        JOIN request_specimen ON uralensis_request_id = request_specimen.rs_request_id	         JOIN request_specimen ON uralensis_request_id = request_specimen.rs_request_id
 *        JOIN specimen ON request_specimen.rs_specimen_id = specimen.specimen_id	         JOIN specimen ON request_specimen.rs_specimen_id = specimen.specimen_id
 *        JOIN uralensis_snomed_codes ON specimen_type = uralensis_snomed_codes.usmdcode_code_desc	         JOIN specialties on speciality_id = specialties.id
 *        JOIN specialty_codes on uralensis_snomed_codes.usmdcode_code = specialty_codes.code	
 *        JOIN specialties on specialty_id = specialties.id	
 *       WHERE group_id = $group_id	WHERE group_id = $group_id
 *       AND ura_rec_track_status = 'Ready To Allocate'	  AND ura_rec_track_status = 'Ready To Allocate'
 *       AND specimen_rcpath_code > 0
 * 
 */

    public function get_needs_attention_list($group_id)
    {
        //Get All requests needing attention
        $query = "SELECT specialty,
       DATE_FORMAT(request_datetime, '%d %M %Y') as from_date,
       uralensis_request_id,
       specimen_rcpath_code,
       speciality_id,
       specimen_type
FROM uralensis_record_track_status
         JOIN users_request ON ura_rec_track_record_id = request_id
         JOIN request ON request_id = uralensis_request_id
         JOIN request_specimen ON uralensis_request_id = request_specimen.rs_request_id
         JOIN specimen ON request_specimen.rs_specimen_id = specimen.specimen_id
         LEFT JOIN specialties on speciality_id = specialties.id
WHERE group_id = $group_id
  AND ura_rec_track_status = 'Ready To Allocate'
  AND (
        specimen_rcpath_code = 0
        OR speciality_id = 0
        OR speciality_id is null
    )
GROUP BY uralensis_request_id
ORDER BY request_datetime DESC";
        
        return $this->db->query($query)->result();
    }
    
    public function get_requests_needing_attention($group_id)
    {
        //Get All other requests needing attention
        $query = "SELECT DATE_FORMAT(MIN(request_datetime), '%d %M %Y') as from_date,
       uralensis_request_id,
       specialty,
       COUNT(specimen.request_id)                     as cases,
       SUM(specimen_rcpath_code)                      as rcpath,
       speciality_id,
       specimen_type
FROM request
       LEFT JOIN users_request ON request.uralensis_request_id = users_request.request_id
       JOIN request_specimen on uralensis_request_id = rs_request_id
       JOIN specimen ON request_specimen.rs_specimen_id = specimen.specimen_id
        JOIN specialties on speciality_id = specialties.id
WHERE users_request.request_id IS NULL
  AND (specimen_rcpath_code = 0 OR speciality_id IS NULL OR speciality_id = 0)
ORDER BY request_datetime DESC";
        $query = "SELECT specialty,
       DATE_FORMAT(MIN(request_datetime), '%d %M %Y') as from_date,
       COUNT(specimen.request_id)                     as cases,
       SUM(specimen_rcpath_code)                      as rcpath,
       speciality_id,
       specimen_type
FROM uralensis_record_track_status
         JOIN users_request ON ura_rec_track_record_id = request_id
         JOIN request ON request_id = uralensis_request_id
         JOIN request_specimen ON uralensis_request_id = request_specimen.rs_request_id
         JOIN specimen ON request_specimen.rs_specimen_id = specimen.specimen_id
         JOIN specialties on speciality_id = specialties.id
WHERE group_id = $group_id
  AND ura_rec_track_status = 'Ready To Allocate'
  AND (
        specimen_rcpath_code = 0
        OR specialty IS NULL
        OR speciality_id = 0
        OR speciality_id IS NULL
    )";
        
        return $this->db->query($query)->row();
    }
    
    public function get_allocated_requests($date, $hospital_id)
    {
        $query = "SELECT CONCAT(AES_DECRYPT(first_name, '" . DATA_KEY . "'), ' ',AES_DECRYPT(last_name, '" . DATA_KEY . "')) as name,
                   specialty,
                   doctor_id,
                   specimen_type,
                   SUM(specimen_rcpath_code)                                 rc_points,
                   COUNT(*)                                               as cases,
                   SUM(specimen_rcpath_code) / pa                         as total_pa
                FROM uralensis_record_track_status
                         JOIN users_request ON ura_rec_track_record_id = request_id
                         JOIN users ON users_request.doctor_id = users.id
                         JOIN request ON request_id = uralensis_request_id
                         JOIN request_specimen ON uralensis_request_id = request_specimen.rs_request_id
                         JOIN specimen ON request_specimen.rs_specimen_id = specimen.specimen_id
                         JOIN specialties on speciality_id = specialties.id
                WHERE group_id = $hospital_id
                  AND doctor_id > 0
                  AND DATE(date_assigned) = '$date'
                  AND specimen_rcpath_code >= 0
                GROUP BY doctor_id, specialty
            ORDER BY name ASC";
        return $this->db->query($query)->result();
    }

    public function get_week_allocation_report($hospital_id, $this_week_sd, $today) {
        // Check user type

        $monday = strtotime("last monday");
        $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
        // TODO: Change dates to current
        // $this_week_sd = date("Y-m-d", strtotime('2020-08-03'));
        // $today = date("Y-m-d", strtotime('2020-08-05'));
        $start_date = $this_week_sd;
        $days = array();
        while ($start_date <= $today) {
            array_push($days, $start_date);
            $start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));
        }
        $record_summary = array();
        foreach ($days as $day) {
            // Assigned requests
            $assigned_requests = $this->db->query(
                "SELECT uralensis_request_id, specialty, SUM(specimen_rcpath_code) as rcpath_points
                FROM request
                INNER JOIN request_specimen ON uralensis_request_id = request_specimen.rs_request_id
                INNER JOIN users_request ON uralensis_request_id = users_request.request_id
                INNER JOIN specimen ON request_specimen.rs_specimen_id = specimen.specimen_id
                INNER JOIN specialties on specimen.speciality_id = specialties.id
                WHERE DATE(request_datetime) = '$day'
                AND users_request.doctor_id != 0 AND users_request.doctor_id IS NOT NULL
                AND hospital_group_id = $hospital_id
                GROUP BY specimen.speciality_id
                ")->result_array();

            $unassigned_requests = $this->db->query(
                "SELECT uralensis_request_id, specialty, SUM(specimen_rcpath_code) as rcpath_points
                FROM request
                INNER JOIN request_specimen ON uralensis_request_id = request_specimen.rs_request_id
                INNER JOIN users_request ON uralensis_request_id = users_request.request_id
                INNER JOIN specimen ON request_specimen.rs_specimen_id = specimen.specimen_id
                INNER JOIN specialties on specimen.speciality_id = specialties.id
                WHERE DATE(request_datetime) = '$day'
                AND users_request.doctor_id = 0 OR users_request.doctor_id IS NULL
                AND hospital_group_id = $hospital_id
                GROUP BY specimen.speciality_id
                "
            )->result_array();

            $day_of_week = strtolower(date('D', strtotime($day)));
            $record_summary[$day_of_week] = array(
                'assigned' => $assigned_requests,
                'unassigned' => $unassigned_requests
            );
        }
        
        return $record_summary;
    }

    public function get_specialty_week_report($this_week_sd, $today) {
        // Get user type
        $monday = strtotime("last monday");
        $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
 
        // TODO: Change dates to current
        // $this_week_sd = date("Y-m-d", strtotime('2020-08-03'));
        // $today = date("Y-m-d", strtotime('2020-08-05'));
        $start_date = $this_week_sd;
        $days = array();
        while ($start_date <= $today) {
            array_push($days, $start_date);
            $start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));
        }
        $specialties = array();
        foreach ($days as $day) {
            // Assigned requests
            $sps = $this->db->query(
                "SELECT specialty, specimen.speciality_id as specialty_id 
                FROM request
                INNER JOIN request_specimen ON uralensis_request_id = request_specimen.rs_request_id
                INNER JOIN specimen ON request_specimen.rs_specimen_id = specimen.specimen_id
                INNER JOIN specialties on specimen.speciality_id = specialties.id
                WHERE DATE(request_datetime) = '$day'
                GROUP BY specimen.speciality_id
                ")->result_array();
            
            foreach($sps as $sp) {
                if (!in_array($sp['specialty'], $specialties))
                    $specialties[$sp['specialty_id']] = $sp['specialty'];
            }
        }

        $full_report = array();
        foreach ($specialties as $specialty_id => $specialty) {
            $doctor_ids = $this->db->query(
                "SELECT `user_id`, AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
                AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name FROM `usermeta`
                INNER JOIN `users` on `users`.`id` = `usermeta`.`user_id`
                WHERE `meta_key` = 'specialty_id' AND `meta_value` = $specialty_id")->result_array();
            $specialty_report = array();
            foreach ($doctor_ids as $id) {
                $doctor_day_report = array();
                $doctor_id = $id['user_id'];
                $doctor_name = 'Dr. '.$id['first_name'].' '.$id['last_name'];
                foreach ($days as $day) {
                    $doctor_assigned = $this->db->query(
                        "SELECT uralensis_request_id, specialty, SUM(specimen_rcpath_code) as rcpath_points
                        FROM request
                        INNER JOIN request_specimen ON uralensis_request_id = request_specimen.rs_request_id
                        INNER JOIN users_request ON uralensis_request_id = users_request.request_id
                        INNER JOIN specimen ON request_specimen.rs_specimen_id = specimen.specimen_id
                        INNER JOIN specialties on specimen.speciality_id = specialties.id
                        WHERE DATE(request_datetime) = '$day'
                        AND users_request.doctor_id = $doctor_id
                        AND specimen.speciality_id = $specialty_id")->result_array();

                    $dayOfWeek = strtolower(date('D', strtotime($day)));
                    $this->load->model('JobPlanModel');
                    $estimated = $this->JobPlanModel->get_user_day_rcpath($doctor_id, $dayOfWeek);
                    $actual = $doctor_assigned[0]['rcpath_points'];
                    $actual = $actual == NULL ? 0: intval($actual);
                    $variance = $estimated - $actual;
                    $doctor_day_report[$dayOfWeek] = array(
                        'estimated' => $estimated,
                        'actual' => $actual,
                        'variance' => $variance
                    );
                }
                $specialty_report[$doctor_name] = $doctor_day_report;
            }
            $full_report[$specialty] = $specialty_report;
        }
        return $full_report;
    }


    public function get_doctor_calculated_day($day, $hospital_id) {
        // Add User type
        $day_of_week = strtolower(date('D', strtotime($day)));

        $specialties = array();
        $unallocated = $this->db->query(
            "SELECT `uralensis_request_id`, `speciality_id`, `specimen_rcpath_code`, DATE(`request_datetime`) FROM `request` 
            INNER JOIN `request_specimen` ON `rs_request_id` = `request`.`uralensis_request_id`
            INNER JOIN `specimen` ON `specimen`.`specimen_id` = `request_specimen`.`rs_specimen_id` 
            INNER JOIN `users_request` ON `users_request`.`request_id` = `request`.`uralensis_request_id`
            WHERE DATE(`request_datetime`) 
            <= '$day' AND `doctor_id` = 0
            AND hospital_group_id = $hospital_id"
        )->result_array();

        // log_message('error', 'Cases Unallocated today: '.print_r($unallocated, true));
        
        $assigned_today = $this->db->query(
            "SELECT `uralensis_request_id`, `speciality_id`, `doctor_id`, `specimen_rcpath_code`, DATE(`request_datetime`) FROM `users_request`
            INNER JOIN `request` ON `users_request`.`request_id` = `request`.`uralensis_request_id`
            INNER JOIN `request_specimen` ON `rs_request_id` = `users_request`.`request_id`
            INNER JOIN `specimen` ON `specimen`.`specimen_id` = `request_specimen`.`rs_specimen_id` 
            WHERE `date_assigned` = '$day'
            AND `doctor_id` != 0
            AND hospital_group_id = $hospital_id"
        )->result_array();
        
        $specs_all = $this->db->query("SELECT * FROM `specialties` ORDER BY `specialty` ASC")->result_array();
        foreach ($specs_all as $value) {
            array_push($specialties, $value['id']);
        }

        $specialty_doctor = array();
        foreach ($specialties as $specialty) {
            $specialty_doctor[$specialty] = array();
            $docs = $this->db->query("SELECT `user_id` FROM `usermeta` WHERE `meta_key` = 'specialty_id' AND `meta_value` = $specialty")->result_array();
            foreach($docs as $doc) {
                array_push($specialty_doctor[$specialty], $doc['user_id']);
            }
        }

        $specialty_doctor_plan = array();

        // Calculate Total Assigned Points On that Day
        foreach ($specialty_doctor as $sp => $docs) {
            $specialty_doctor_plan[$sp] = array();
            foreach ($docs as $doc) {
                $temp_doc = array();
                // Total assigned points
                $total_assigned_points = 0;
                foreach ($assigned_today as $assigned) {
                    if ($assigned['doctor_id'] == $doc) {
                        $total_assigned_points = $total_assigned_points + intval($assigned['specimen_rcpath_code']);
                    }
                }
                // Total estimated points
                $doc_plan = $this->db->query(
                    "SELECT * 
                    FROM `job_plan`
                    INNER JOIN `specialties` ON `specialties`.`id` = `specialty_id`
                    WHERE `user_id` = $doc
                    AND `dayOfWeek` = '$day_of_week'
                    AND `specialty_id` = $sp")->result_array();
                
                $total_est_points = 0;
                foreach ($doc_plan as $plan) {
                    $from_time = $plan['from_time'];
                    $to_time = $plan['to_time'];
                    $diff =  round((strtotime($to_time) - strtotime($from_time))/3600, 1);
                    $diff = $diff < 0 ? $diff * -1 : $diff;
                    $total_est_points = $total_est_points + intval($plan['pa']) * $diff / 4;
                }
                $temp_doc = array(
                    'doc' => $doc,
                    'est' => $total_est_points,
                    'assigned' => $total_assigned_points,
                    'remaining' => $total_est_points - $total_assigned_points,
                    'percent_alloc' => 0,
                    'calculated_points' => 0,
                    'case_calculated' => array()
                );

                array_push($specialty_doctor_plan[$sp], $temp_doc);
            }
        }
        


        foreach($specialty_doctor_plan as $spec => $docs) {
            $total_remaining = 0;
            foreach($docs as $ind => $doc) {
                $rem = $specialty_doctor_plan[$spec][$ind]['remaining'];
                $rem = $rem < 0 ? 0: $rem;
                $total_remaining = $total_remaining + $rem;
            }

            foreach($docs as $ind => $doc) {
                $rem = $specialty_doctor_plan[$spec][$ind]['remaining'];
                $rem = $rem < 0 ? 0: $rem;
                $percent_alloc = 0;
                if ($total_remaining == 0) {
                    $percent_alloc = 0;
                }else{
                    $percent_alloc = $rem / $total_remaining;
                }
                $specialty_doctor_plan[$spec][$ind]['percent_alloc'] = $percent_alloc;
            }

            $case_points = array();
            $total_case_points = 0;
            foreach($unallocated as $cases) {
                if ($cases['speciality_id'] == $spec) {
                    if(!array_key_exists($cases['uralensis_request_id'], $case_points)) {
                        $case_points[$cases['uralensis_request_id']] = 0;
                    }
                    $case_points[$cases['uralensis_request_id']] += intval($cases['specimen_rcpath_code']) ;
                    $total_case_points += intval($cases['specimen_rcpath_code']);
                }
            }
            foreach($docs as $ind => $doc) {
                $alloc_points = $specialty_doctor_plan[$spec][$ind]['percent_alloc'] * $total_case_points;
                $specialty_doctor_plan[$spec][$ind]['calculated_points'] = 0;
                $calc = 0;
                $specialty_doctor_plan[$spec][$ind]['case_calculated'] = array();
                
                while ($specialty_doctor_plan[$spec][$ind]['calculated_points'] < $alloc_points && count($case_points) > 0) {
                    $case = key($case_points);
                    $points = $case_points[$case];
                    unset($case_points[$case]);
                    $specialty_doctor_plan[$spec][$ind]['calculated_points'] += $points;
                    $calc += $points;
                    array_push($specialty_doctor_plan[$spec][$ind]['case_calculated'], $case);
                }
            }
        }
        return $specialty_doctor_plan;
    }
    

    public function get_total_rcpath_day($day, $hospital_id) {
        // Add user type
        $res = $this->db->query(
            "SELECT SUM(`specimen_rcpath_code`) as rcpath, `speciality_id`
            FROM `request`
            INNER JOIN `users_request` ON `request`.`uralensis_request_id` = `users_request`.`request_id`
            INNER JOIN `request_specimen` ON `request_specimen`.`rs_request_id` = `request`.`uralensis_request_id`
            INNER JOIN `specimen` ON `specimen`.`specimen_id` = `request_specimen`.`rs_specimen_id`
            WHERE DATE(`request_datetime`) = '$day' OR `date_assigned` = '$day'
            AND hospital_group_id = $hospital_id
            GROUP BY `speciality_id`")->result_array();
        return $res;
    }

    public function get_unallocated_specialty_day($specialty_ids, $date, $hospital_id) {
        // Add user type
        $res =  $this->db->query(
            "SELECT SUM(`specimen_rcpath_code`) AS `rcpath`, `speciality_id`, COUNT(`uralensis_request_id`) as requests FROM `request`
            INNER JOIN `users_request` ON `request`.`uralensis_request_id` = `users_request`.`request_id`
            INNER JOIN `request_specimen` ON `request_specimen`.`rs_request_id` = `request`.`uralensis_request_id`
            INNER JOIN `specimen` ON `specimen`.`specimen_id` = `request_specimen`.`rs_specimen_id`
            WHERE
            `doctor_id` IS NULL OR `doctor_id` = 0
            AND `speciality_id` IN $specialty_ids
            AND DATE(`request_datetime`) <= '$date'
            AND hospital_group_id = $hospital_id
            GROUP BY `speciality_id`
            "
            )->result_array();
        
        // log_message('error', 'LAST QUERY:  '.print_r($this->db->last_query(), true));
        return $res;
    } 

    public function allocate_request_specialty($specialty_id, $data, $hospital_id) {
        //TODO: Today change 
        $day = date("Y/m/d");
        // $day = date("Y-m-d", strtotime('2020-06-25'));
        $res = $this->db->query(
            "SELECT `uralensis_request_id`, `speciality_id`, SUM(`specimen_rcpath_code`) as rcpath, DATE(`request_datetime`) FROM `request` 
            INNER JOIN `request_specimen` ON `rs_request_id` = `request`.`uralensis_request_id`
            INNER JOIN `specimen` ON `specimen`.`specimen_id` = `request_specimen`.`rs_specimen_id` 
            INNER JOIN `users_request` ON `users_request`.`request_id` = `request`.`uralensis_request_id`
            WHERE DATE(`request_datetime`) 
            <= '$day' AND `doctor_id` = 0 AND `speciality_id` = $specialty_id AND hospital_group_id = $hospital_id
            GROUP BY `uralensis_request_id`
            ORDER BY DATE(`request_datetime`) ASC"
        )->result_array();
        $total_points = 0;
        foreach ($res as $val) {
            $total_points += intval($val['rcpath']);
            
        }
        $curr_case = 0;
        foreach ($data as $doc => $d) {
            $to_be_assigned = $d['percent_alloc'] * $total_points;
            while ($to_be_assigned > 0 && $curr_case < count($res)) {
                $to_be_assigned = $to_be_assigned - intval($res[$curr_case]['rcpath']);
                // Assign case here.
                $request_id = $res[$curr_case]['uralensis_request_id'];
                $this->db->query(
                    "UPDATE `request` set
                    assign_status = 1,
                    request_assign_status = 1
                    where `uralensis_request_id` = $request_id"
                );
                $exists_request_assignee = $this->db->query("SELECT * FROM `request_assignee` WHERE `request_id` = $request_id")->result_array();
                if (count($exists_request_assignee) > 0) {
                    $this->db->query(
                        "UPDATE `request_assignee` SET `assign_status` = 1, `user_id` = $doc WHERE `request_id` = $request_id");
                }else{
                    $this->db->query(
                        "INSERT INTO `request_assignee` (`request_id`, `user_id`, `assign_status`)
                        VALUES ($request_id, $doc, 1)"
                    );
                }

                $this->db->query(
                    "UPDATE `users_request` SET `doctor_id` = $doc, `date_assigned` = '$day' WHERE `request_id` = $request_id");
                $doc_name = $this->get_doctor_name($doc);
                $doc_name = 'Dr. '.$doc_name['first_name'].' '.$doc_name['last_name'];
                $this->db->query(
                    "update uralensis_record_track_status
                    set ura_rec_track_status = 'With Doctor',
                    ura_rec_track_pathologist = '$doc_name'
                    where ura_rec_track_record_id = $request_id
                    "
                );

                log_message('error', 'Assigning case '.$res[$curr_case]['uralensis_request_id'].' to doctor with id '.$doc);
                $curr_case++;
            }
        }
    }

    public function get_doctor_week_report($hospital_id, $this_week_sd, $today) {
        // Add user type
        $monday = strtotime("last monday");
        $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
 
        // $this_week_sd = date("Y-m-d",$monday);
        // $today = date("Y-m-d");
        // TODO: Change dates to current
        // $this_week_sd = date("Y-m-d", strtotime('2020-08-03'));
        // $today = date("Y-m-d", strtotime('2020-08-05'));
        $start_date = $this_week_sd;
        $days = array();
        while ($start_date <= $today) {
            array_push($days, $start_date);
            $start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));
        }
        $report = array();
        $doctors = $this->get_doctor_name_list_new($hospital_id);
        foreach ($doctors as $doc_id => $name) {
            // Get doctor specialty
            $specialties = $this->db->query("SELECT `meta_value` FROM `usermeta` WHERE `meta_key` = 'specialty_id' AND `user_id` = $doc_id")->result_array();
            $spec_report = array();
            foreach ($specialties as $key => $value) {
                $spec = $value['meta_value'];
                $day_report = array();
                foreach ($days as $day) {
                    $day_of_week = strtolower(date("D", strtotime($day)));
                    // Total estimated points
                    $doc_plan = $this->db->query(
                        "SELECT * 
                        FROM `job_plan`
                        INNER JOIN `specialties` ON `specialties`.`id` = `specialty_id`
                        WHERE `user_id` = $doc_id
                        AND `dayOfWeek` = '$day_of_week'
                        AND `specialty_id` = $spec")->result_array();
                
                    $total_est_points = 0;
                    foreach ($doc_plan as $plan) {
                        $from_time = $plan['from_time'];
                        $to_time = $plan['to_time'];
                        $diff =  round((strtotime($to_time) - strtotime($from_time))/3600, 1);
                        $diff = $diff < 0 ? $diff * -1 : $diff;
                        $total_est_points = $total_est_points + intval($plan['pa']) * $diff / 4;
                    }

                    // Calculate total allocated points
                    $res = $this->db->query(
                        "SELECT SUM(`specimen_rcpath_code`) as rcpath FROM `request` 
                        INNER JOIN `request_specimen` ON `rs_request_id` = `request`.`uralensis_request_id`
                        INNER JOIN `specimen` ON `specimen`.`specimen_id` = `request_specimen`.`rs_specimen_id` 
                        INNER JOIN `users_request` ON `users_request`.`request_id` = `request`.`uralensis_request_id`
                        WHERE DATE(`date_assigned`) = '$day' AND `doctor_id` = $doc_id AND `speciality_id` = $spec AND hospital_group_id = $hospital_id
                        "
                    )->result_array();
                    $total_allocated = 0;
                    if (count($res) != 0) {
                        $total_allocated = intval($res[0]['rcpath']);
                    }


                    $day_report[$day_of_week] = array(
                        'est' => $total_est_points,
                        'allocated' => $total_allocated,
                        'variance' => $total_est_points - $total_allocated    
                    );
                }
                $spec_report[$spec] = $day_report;
            }
            $report[$doc_id] = $spec_report;

        }
        return $report;
    }
    
    public function get_user_type($user_id) {
        // A - Admin
        // D - Pathologist
        // H - Hospital
        // C - Clinicia
        // CS - Cancer Service
        // S - Secratary
        // R - Requestor
        // NULL - User type not found
        $res = $this->db->query("SELECT `group_type` FROM `users` 
        INNER JOIN `users_groups` ON `users`.`id` = `users_groups`.`user_id`
        INNER JOIN `groups` ON `groups`.`id` = `users_groups`.`group_id`
        WHERE `users`.`id` = $user_id")->result_array();
        if (count($res) == 0) {
            return NULL;
        }else {
            return $res[0]['group_type'];
        }
    }

    public function get_hospitals() {
        return $this->db->query("SELECT * FROM `groups` WHERE `group_type` = 'H'")->result_array();
    }

    public function get_hospital_pathologists($user_id) {

    }

    public function get_hospital_user($user_id) {
        $hospital = $this->db->query("SELECT `groups`.* FROM `groups` 
        INNER JOIN `users_groups` ON `users_groups`.`group_id` = `groups`.`id`
        WHERE `users_groups`.`user_id` = $user_id")->result_array();
        return $hospital[0];
    }

    public function is_valid_hospital($hospital_id) {
        $res = $this->db->query("SELECT * FROM `groups` WHERE `id` = $hospital_id")->num_rows();
        return $res != 0;
    }
}