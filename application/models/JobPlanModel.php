<?php

class JobPlanModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_user_job_plan($user_id) {
        if (!is_numeric($user_id)) {
            return null;
        }
        return $this->db->query("SELECT `job_plan`.*, `specialties`.specialty as 'specialty', `specialties`.`pa` as 'pa' from `job_plan`
        left join `specialties` on `specialties`.`id` = `specialty_id`
        where `user_id` = $user_id")->result_array();
    }

    public function get_user_week_rcpath($user_id) {
        if (!is_numeric($user_id)) {
            return null;
        }
        $week_plan = $this->db->query("SELECT * from `job_plan` 
        inner join `specialties` on `specialties`.`id` = `specialty_id` 
        where `user_id`=$user_id and `specialty_id` is not null AND TRIM(`event`) = 'Microscopy'")->result_array();
        $total_rcpath = 0;
        foreach ($week_plan as $event) {
            $from_time = $event['from_time'];
            $to_time = $event['to_time'];
            $diff =  round((strtotime($to_time) - strtotime($from_time))/3600, 1);
            $diff = $diff < 0 ? $diff * -1 : $diff;
            $pa = $diff / 4;
            $rcpath = $pa * intval($event['pa']);
            $total_rcpath = $total_rcpath + $rcpath;
        }
        return $total_rcpath;
    }

    public function get_user_day_rcpath($user_id, $day_of_week) {
        if (!is_numeric($user_id)) {
            return null;
        }
        $day_plan = $this->db->query("SELECT * from `job_plan`
        INNER JOIN `specialties` on `specialties`.`id` = `specialty_id`
        where `user_id` = $user_id and `dayOfWeek` = '$day_of_week' and `specialty_id` is not null AND TRIM(`event`) = 'Microscopy'")->result_array();
        // 1PA = 4hrs
        $total_rcpath = 0;
        foreach ($day_plan as $event) {
            $from_time = $event['from_time'];
            $to_time = $event['to_time'];
            $diff =  round((strtotime($to_time) - strtotime($from_time))/3600, 1);
            $diff = $diff < 0 ? $diff * -1 : $diff;
            $pa = $diff / 4;
            $rcpath = $pa * intval($event['pa']);
            $total_rcpath = $total_rcpath + $rcpath;
        }
        return $total_rcpath;
    }

    public function get_user_specialties($user_id) {
        if (!is_numeric($user_id)) {
            return null;
        }
        return $this->db->query(
            "SELECT `specialties`.`id` as specialty_id, `specialty` FROM `usermeta` INNER JOIN `specialties` on `specialties`.`id` = `meta_value`
            WHERE `user_id` = $user_id AND
            `meta_key` = 'specialty_id'
            "
        )->result_array();
    }

    public function add_job_plan($values) {
        $this->db->insert('job_plan', $values);
    }

    public function valid_specialty($user_id, $specialty_id) {
        if (!is_numeric($user_id)) {
            return false;
        }
        if (strlen(trim($specialty_id)) == 0) {
            return true;
        }
        else if (!is_numeric(trim($specialty_id))) {
            return false; 
        }
        $res = $this->db->query("SELECT * from `usermeta` where `user_id`=$user_id and `meta_value`=$specialty_id and `meta_key`='specialty_id'")->result_array();
        if (count($res) > 0) {
            return true;
        }        
        else{
            return false;
        }
    }

    public function update_job_plan($data) {
        $this->db->query("
        UPDATE `job_plan` SET 
        `event` = '".$data['event']."',
        `dayOfWeek` = '".$data['dayOfWeek']."',
        `from_time` = '".$data['from_time']."',
        `to_time` = '".$data['to_time']."',
        `color` = '".$data['color']."',
        `specialty_id` = ".$data['specialty_id']."
        WHERE `user_id` = ".$data['user_id']." AND `id` = ".$data['event_id']."
        ");
    }

    public function delete_job_plan($id, $user_id) {
        if (!is_numeric($user_id) && !is_numeric($id)) {
            return null;
        }
        $this->db->query("
        DELETE FROM `job_plan`
        WHERE `id` = $id and `user_id` = $user_id
        ");
    }
}