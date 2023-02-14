<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Reports Model
 * @package    CI
 * @subpackage Model
 * @author     Anonymous
 * @version    1.0.0
 */
class ReportsModel extends CI_Model
{

    // ######### Doctors, TAT<10 graph Last 12 Months #############
    public function doctor_tat_last_12_month($doctor_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT DATE_FORMAT(rq.publish_datetime, '%Y-%m') as y_m, DATE_FORMAT(rq.publish_datetime, '%m/%y') as publish_month, 
            COUNT(rq.uralensis_request_id) as num_of_cases, 
            COUNT(IF(DATEDIFF(rq.publish_datetime, rq.date_taken)<=10,1,NULL)) AS tat_less_ten, 
            ROUND((COUNT(IF(DATEDIFF(rq.publish_datetime, rq.date_taken)<=10,1,NULL))/COUNT(rq.uralensis_request_id))*100,2) AS tat_less_ten_percent,
            ROUND((90/100)*COUNT(rq.uralensis_request_id),2) AS target_less_ten  
            FROM request rq
            INNER JOIN request_assignee ra ON rq.uralensis_request_id = ra.request_id
            WHERE ra.user_id = $doctor_id
            AND (DATE_FORMAT(rq.publish_datetime, '%Y%m') BETWEEN DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 12 MONTH), '%Y%m') 
            AND DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 1 MONTH), '%Y%m'))
            GROUP BY DATE_FORMAT(rq.publish_datetime, '%Y%m')
            ORDER BY DATE_FORMAT(rq.publish_datetime, '%Y%m') ");

        return $query->result();
    }
    // ######### All Doctors, TAT<10 graph last month #############
    public function all_doctor_tat_last_month($start_date,$end_date, $chart_group_by, $HGroup_id)
    {

        echo '';
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT CONCAT(AES_DECRYPT(users.first_name, '".DATA_KEY."'),' ', AES_DECRYPT(users.last_name, '".DATA_KEY."')) AS doctor_name, DATE_FORMAT(rq.publish_datetime, '%Y-%m') AS y_m, DATE_FORMAT(rq.publish_datetime, '%m/%y') AS publish_month, 
            speciality_group.spec_grp_name AS speciality_group, COUNT(rq.uralensis_request_id) AS num_of_cases, 
            COUNT(IF(DATEDIFF(rq.publish_datetime, rq.date_taken)<=10,1,NULL)) AS tat_less_ten, 
            ROUND((COUNT(IF(DATEDIFF(rq.publish_datetime, rq.date_taken)<=10,1,NULL))/COUNT(rq.uralensis_request_id))*100,2) AS tat_less_ten_percent,
            ROUND((90/100)*COUNT(rq.uralensis_request_id),2) AS target_less_ten  
            FROM request rq
            INNER JOIN users_request ur ON rq.uralensis_request_id = ur.request_id
            INNER JOIN users ON ur.doctor_id = users.id
            INNER JOIN users_groups AS ug ON users.id=ug.user_id
            INNER JOIN speciality_group ON speciality_group.spec_grp_id = rq.speciality_group_id 
            WHERE 1=1 AND ug.institute_id=$HGroup_id ";
        if($start_date!="" AND $end_date!=""){
            $sql.="AND DATE_FORMAT(rq.publish_datetime, '%Y-%m') BETWEEN '$start_date' AND '$end_date' ";
        }else{
            $sql.="AND DATE_FORMAT(rq.publish_datetime, '%Y-%m')= '2020-06' ";
        }
        if($chart_group_by == "Doctor"){
            $sql.="GROUP BY ur.doctor_id ";
        }
        if($chart_group_by == "Speciality"){
            $sql.="GROUP BY rq.speciality_group_id ";
        }
        $sql.="
            ORDER BY DATE_FORMAT(rq.publish_datetime, '%Y%m');";
    //    echo $sql; exit;
        $query = $this->db->query($sql);

        return $query->result();
    }

    // ######### Doctors, TAT<10 graph Last 12 Months #############
    public function doctor_avg_tat_by_period($doctor_id, $interval)
    {
        $interval = (int) $interval;
        $avg_divisor=$interval*30;
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT DATE_FORMAT(rq.publish_datetime, '%m/%y') AS publish_month, 
            DATE_FORMAT(CURDATE(),'%m/%y') AS curr_month,
            DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL $interval MONTH), '%m/%y') AS last_month, 
            COUNT(rq.uralensis_request_id) AS num_of_cases, 
            ROUND((COUNT(rq.uralensis_request_id)/$avg_divisor),0) AS avg_tat
            FROM request rq
            INNER JOIN request_assignee ra ON rq.uralensis_request_id = ra.request_id
            WHERE ra.user_id = $doctor_id
            AND (DATE_FORMAT(rq.publish_datetime, '%Y%m') BETWEEN DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL $interval MONTH), '%Y%m') 
            AND DATE_FORMAT(CURDATE(), '%Y%m'))
            ORDER BY DATE_FORMAT(rq.publish_datetime, '%Y%m') ");

        return $query->result()[0];
    }

    
    public function add_download_log($log_data)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->db->insert('report_download_logs', $log_data);
        return true;
    }

}