<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Doctor Model
 *
 * @package    CI
 * @subpackage Model
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */
class TrackingReport_model extends CI_Model
{
    public function lab_record_list($lab_id, $filter = '', $status = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $status_where = '';
        if ($status != '') {
            //$status_where = " AND request_code_status = '".base64_decode($status)."'";
        }
        $group_row = $this->ion_auth->get_users_groups()->row();
        $group_type = $group_row->group_type;

        if($group_type != 'A'){
            $labIdStr = $this->getLabIdsFromUser($lab_id);
            $labIds = (!empty($labIdStr)) ? $labIdStr : '0';
            $filter .= " AND request.lab_id IN ($labIds)";
        }

        // $query = $this->db->query("SELECT *, CONCAT(AES_DECRYPT(users.first_name, '" . DATA_KEY . "'),' ' ,AES_DECRYPT(users.last_name, '" . DATA_KEY . "')) AS added_by, tbl_courier.courier_no as courier_number, count(DISTINCT(specimen.specimen_id)) as speciman_no FROM request
        //     INNER JOIN request_assignee                     
        //     LEFT JOIN users ON request.request_add_user = users.id
		// 	LEFT JOIN billing_data ON billing_data.id = request.billing_code_ids			
        //     LEFT JOIN tbl_courier ON tbl_courier.id=request.emis_number
        //     LEFT JOIN specimen on specimen.request_id = request.uralensis_request_id
        //     WHERE request.uralensis_request_id = request_assignee.request_id
        //     $filter $status_where GROUP BY request.uralensis_request_id");
        $query = $this->db->query("SELECT *, DATE_FORMAT(FROM_DAYS(DATEDIFF(now(),DATE_FORMAT(STR_TO_DATE(dob, '%d-%m-%Y'), '%Y-%m-%d'))), '%Y')+0 AS calculatedAge,
        DATE_FORMAT(FROM_DAYS(DATEDIFF(now(),DATE_FORMAT(STR_TO_DATE(dob, '%Y-%m-%d'), '%Y-%m-%d'))), '%Y')+0 AS calculatedAge1, CONCAT(AES_DECRYPT(users.first_name, '" . DATA_KEY . "'),' ' ,AES_DECRYPT(users.last_name, '" . DATA_KEY . "')) AS added_by, tbl_courier.courier_no as courier_number, count(DISTINCT(specimen.specimen_id)) as speciman_no FROM request
            INNER JOIN request_assignee                     
            /*LEFT JOIN section_comments ON section_comments.record_id=request.uralensis_request_id*/
            LEFT JOIN users ON request.request_add_user = users.id
            LEFT JOIN tbl_courier ON tbl_courier.id=request.emis_number
            LEFT JOIN specimen on specimen.request_id = request.uralensis_request_id
            LEFT JOIN additional_work on additional_work.request_id = request.uralensis_request_id
            LEFT JOIN further_work on further_work.request_id = request.uralensis_request_id
            WHERE request.uralensis_request_id = request_assignee.request_id
            $filter $status_where GROUP BY `request`.`uralensis_request_id`");
        // echo $this->db->last_query(); exit;
        /*AND request.request_add_user = $lab_id */

        return $query->result();
    }

    public function lab_record_list_with_slide($lab_id, $filter = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("
        SELECT DISTINCT request.uralensis_request_id as record_id
        FROM request 
        INNER JOIN request_assignee ON request.uralensis_request_id = request_assignee.request_id 
        INNER JOIN request_specimen ON request.uralensis_request_id = request_specimen.rs_request_id 
        INNER JOIN specimen_slide 
        where request.request_add_user = $lab_id
        AND request_specimen.rs_specimen_id = specimen_slide.specimen_id 
        AND request.specimen_publish_status = 0 
        AND request.supplementary_review_status = 'false' " . $filter);

        return $query->result();
    }
    public function getLabIdsFromUser($user_id)
    {
        //$user_id = $this->ion_auth->user()->row()->id;
        $lab_ids = $this->db->select('institute_id as lab_id')
            ->from('groups gr')
            ->join('users_groups ugr', 'gr.id = ugr.institute_id', 'left')
            ->where([
                'gr.group_type' => 'L',
                'ugr.user_id' => $user_id,
                //'ugr.institute_id' => $user_id
            ])
            ->get()->row()->lab_id;
        return $lab_ids;
    }

    public function get_lab_users($hospital_id = '', $group_id = '') {
        $lab_id = $group_id;
        $this->db->select("`users`.`id` as id,count(`users`.`id`) as countuser,  AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name, 
        AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name,profile_picture_path,last_login,users.user_type,AES_DECRYPT(company, '".DATA_KEY."') AS company,
        AES_DECRYPT(email, '".DATA_KEY."') AS email, users.active, aes_decrypt(users.phone, '" . DATA_KEY . "') AS enc_phone, users.in_directory, groups.description, groups.first_initial, groups.last_initial, users_groups.group_id, groups.group_type, groups.type_cate", FALSE);
        $this->db->join('users', 'users.id = users_groups.user_id');
        $this->db->join('groups', 'users.user_type = groups.group_type', 'left');      
        $this->db->where('institute_id', $lab_id);
        $this->db->where('groups.group_type', "D");
        $this->db->group_by('users.user_type');
        $result = $this->db->get('users_groups')->result_array();
        return $result;
    }
}
