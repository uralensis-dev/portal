<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * General Helper Functions
 */
if (!function_exists('uralensis_get_user_detail')) {

    /**
     * Get User Detail
     *
     * @param string $user_img
     * @param string $user_date
     * @param string $display_type
     */
    function uralensis_get_user_detail($user_img = '', $user_date = '', $display_type = '')
    {
        $ci = &get_instance();
        $user_id = $ci->ion_auth->user()->row()->id;
        $getusername = $ci->ion_auth->getUserDecryptedDetailsByid($user_id);

        $username = '';

        //$f_name = $ci->ion_auth->user($user_id)->row()->first_name;
        // $l_name = $ci->ion_auth->user($user_id)->row()->last_name;
        $f_name = $getusername->first_name;
        $l_name = $getusername->last_name;
        $username = $f_name . ' ' . $l_name;
        $login_time = $ci->ion_auth->user($user_id)->row()->user_login_time;
        $convert_login_time = date('F d, Y', strtotime($login_time));
        if (!empty($display_type) && $display_type === 'top') {
            ob_start();
            ?>
            <a href="javascript:;" id="tg-adminnav" class="tg-btndropdown" data-toggle="dropdown" aria-expanded="false">
                <?php
                if (!empty($user_img) && $user_img === 'true') {
                    //Get the picture name
                    $img_name = $ci->ion_auth->user($user_id)->row()->picture_name;
                    ?>
                    <span class="tg-userdp">
                        <img src="<?php echo base_url('uploads/' . $img_name); ?>" alt="Uralensis">
                    </span>
                <?php } ?>
                <div class="tg-userinfo">
                    <span class="tg-name">
            <?php echo $username; ?></span>
                    <span class="tg-role">
                        <?php echo 'Uralensis Inov8 Ltd'; ?>
                        <?php if (!empty($user_date) && $user_date === 'true') { ?>
                            <em><?php echo $convert_login_time; ?></em>
                        <?php } ?>
                    </span>
                </div>
            </a>
            <?php
            echo ob_get_clean();
        } elseif (!empty($display_type) && $display_type === 'bottom') {
            ob_start();
            if (!empty($user_img) && $user_img === 'true') {
                $img_name = $ci->ion_auth->user($user_id)->row()->picture_name;
                ?>
                <figure class="tg-hospitalimg">
                    <img src="<?php echo base_url('uploads/' . $img_name); ?>" alt="Uralensis">
                </figure>
            <?php } ?>
            <div class="tg-usercontent">
                <span>
            <?php echo $username; ?></span>
                <?php if (!empty($user_date) && $user_date === 'true') { ?>
                    <h3>
                        <?php echo date('H:i, d-m-Y', strtotime($login_time)); ?>
                    </h3>
                <?php } ?>
            </div>
            <?php
            echo ob_get_clean();
        }
    }

}

if (!function_exists('uralensis_get_record_status_counter')) {

    /**
     * Get Record Counter With Status
     *
     * @param string $type
     */
    function uralensis_get_record_status_counter($type = '')
    {
        $ci = &get_instance();
        $ci->load->model('Institute_model');
        $user_id = $ci->ion_auth->user()->row()->id;
        if (!empty($type) && $type === 'reported') {
            echo $ci->Institute_model->status_bar_result_count_published();
        } elseif ($type === 'unreported') {
            echo $ci->Institute_model->status_bar_result_count_un_reported();
        }
    }

}

if (!function_exists('uralensis_get_contact_db_details')) {

    /**
     * Get Contact Information From User Table
     *
     * @param string $type
     */
    function uralensis_get_contact_db_details($type = '')
    {
        $ci = &get_instance();
        $user_id = $ci->ion_auth->user()->row()->id;
        $data = $ci->ion_auth->getUserDecryptedDetailsByid($user_id);
        //echo last_query();exit;
        return $data->$type;
        /*  if (!empty($type)) {
          $query = $ci->db->select($type)->where('id', $user_id)->get('users')->row_array()[$type];
          return $query;
          } */
    }

}

if (!function_exists('uralensis_get_welcome_message')) {

    /**
     * Uralensis After login welcome message
     *
     */
    function uralensis_get_welcome_message()
    {
        $Hour = date('G');
        if ($Hour >= 5 && $Hour <= 11) {
            echo "Morning,";
        } else if ($Hour >= 12 && $Hour <= 18) {
            echo "Afternoon,";
        } else if ($Hour >= 19 || $Hour <= 4) {
            echo "Evening,";
        }
    }

}

if (!function_exists('uralensis_get_hospital_name')) {

    /**
     * Get hospital name
     *
     */
    function uralensis_get_hospital_name($hospital_id = '')
    {
        $ci = &get_instance();
        if (!empty($hospital_id)) {
            $group_id = $hospital_id;
        } else {
            $user_id = $ci->ion_auth->user()->row()->id;
            $group_id = $ci->ion_auth->get_users_groups($user_id)->row()->id;
        }

        return $ci->ion_auth->group($group_id)->row()->description;
    }

}

if (!function_exists('uralensis_get_further_work_data')) {

    /**
     * Get Further Work Data
     *
     */
    function uralensis_get_further_work_data()
    {
        $ci = &get_instance();
        $ci->load->model('Institute_model');

        $count_data = $ci->Institute_model->further_view();

        return count($count_data);
    }

}

if (!function_exists('uralensis_get_super_admin_login_screen')) {

    /**
     * Get all users by group data
     *
     */
    function uralensis_get_super_admin_login_screen()
    {
        $ci = &get_instance();
        $ci->load->model('Institute_model');

        $get_users_by_group = $ci->Institute_model->get_all_users_by_group();
        return $ci->Institute_model->get_all_group_users_data($get_users_by_group);
    }

}

if (!function_exists('uralensis_get_time_format')) {

    /**
     * Get time in different formats
     *
     * @param string $start_time
     * @param string $end_time
     * @param boolean $std_format
     */
    function uralensis_get_time_format($start_time, $end_time, $std_format = false)
    {
        $total_time = $end_time - $start_time;
        $days = floor($total_time / 86400);
        $hours = floor($total_time / 3600);
        $minutes = intval(($total_time / 60) % 60);
        $seconds = intval($total_time % 60);
        $results = "";
        if ($std_format == false) {
            if ($days > 0)
                $results .= $days . (($days > 1) ? " days " : " day ");
            if ($hours > 0)
                $results .= $hours . (($hours > 1) ? " Hr " : " hour ");
            if ($minutes > 0)
                $results .= $minutes . (($minutes > 1) ? " Min " : " minute ");
            if ($seconds > 0)
                $results .= $seconds . (($seconds > 1) ? " Sec " : " second ");
        } else {
            if ($days > 0)
                $results = $days . (($days > 1) ? " days " : " day ");
            $results = sprintf("%s%02d:%02d:%02d", $results, $hours, $minutes, $seconds);
        }
        return $results;
    }

}


if (!function_exists('uralensis_get_all_hospital_users')) {

    /**
     * Get All hospital users for same group
     * excluding the current logedin user.
     *
     */
    function uralensis_get_all_hospital_users()
    {
        $ci = &get_instance();
        $ci->load->model('Institute_model');
        $get_users_by_group = $ci->Institute_model->get_all_users_by_group();
        return $ci->Institute_model->get_all_group_users_exclude_current($get_users_by_group);
    }

}


if (!function_exists('uralensis_get_hospital_assigned_doctors')) {

    /**
     * Get all doctors which is assigned to records.
     *
     */
    function uralensis_get_hospital_assigned_doctors()
    {
        $ci = &get_instance();
        $ci->load->model('Institute_model');
        $user_id = $ci->ion_auth->user()->row()->id;
        $group_id = $ci->ion_auth->get_users_groups($user_id)->row()->id;
        $doctor_ids = $ci->Institute_model->get_all_hospital_assigned_doctors($group_id);
        $doctor_id_array = array();
        if (!empty($doctor_ids)) {
            foreach ($doctor_ids as $id) {
                $doctor_id_array[] = $id['doctor_id'];
            }
        }
        return $ci->Institute_model->get_all_hospital_assigned_doctors_data($doctor_id_array);
    }

}

if (!function_exists('uralensis_get_total_inbox_msg')) {

    /**
     * Get Total inbox messages
     *
     */
    function uralensis_get_total_inbox_msg()
    {
        $ci = &get_instance();
        $ci->load->model('Institute_model');
        $hospital_id = $ci->ion_auth->user()->row()->id;
        return $ci->Institute_model->display_institute_msg_model($hospital_id, 'inbox');
    }

}

/**
 * Get DB session records data.
 */
if (!function_exists('uralensis_get_db_session_records_data')) {

    /**
     * Get DB sessions record data
     *
     * @param string $current_date
     */
    function uralensis_get_db_session_records_data($current_date)
    {
        $ci = &get_instance();
        if (!empty($current_date)) {
            //Get current date data from session record db.
            return $ci->db->where('ura_date_format', $current_date)->get('uralensis_track_session_records')->result_array();
        }
    }

}

if (!function_exists('uralensis_get_username_enc')) {

    /**
     * Get User first and last name
     *
     * @param int $user_id
     */
    function uralensis_get_username_enc($user_id)
    {
        $ci = &get_instance();
        if (!empty($user_id)) {
            $f_name = $ci->ion_auth->user($user_id)->row()->first_name;
            $l_name = $ci->ion_auth->user($user_id)->row()->last_name;
            $username = $f_name . ' ' . $l_name;
            return $username;
        }
    }

}

if (!function_exists('uralensis_get_username')) {

    /**
     * Get User first and last name
     *
     * @param int $user_id
     */
    function uralensis_get_username($user_id)
    {
        $ci = &get_instance();
        if (!empty($user_id)) {
            $f_name = $ci->ion_auth->user($user_id)->row()->first_name;
            $l_name = $ci->ion_auth->user($user_id)->row()->last_name;
            $username = $f_name . ' ' . $l_name;
            return $username;
        }
    }

}
/*     * *
 *
 * get Number of records
 * * */


if (!function_exists('getTotalNumberOfRecords')) {

    /**
     * Get User first and last name
     *
     *
     * @return int totalRows
     */
    function getTotalNumberOfRecords()
    {

        $totRecords = getRecords("COUNT(*) AS TOTROW", "request");

        return $totRecords[0]->TOTROW;
    }

}


if (!function_exists('uralensisGetUsername')) {

    /**
     * Get User Information
     *
     * @param int $user_id
     */
    function uralensisGetUsername($user_id, $type = 'fullname')
    {
        $ci = &get_instance();
        $f_name = '';
        $l_name = '';
        $username = '';
        if (!empty($user_id) && $type === 'fullname') {
            $username = getRecords("AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name", "users", array("id" => $user_id));

            // if (!empty($ci->ion_auth->user($user_id)->row()->first_name)) {
            //     $f_name = $ci->ion_auth->user($user_id)->row()->first_name;
            // }
            // if (!empty($ci->ion_auth->user($user_id)->row()->last_name)) {
            //     $l_name = $ci->ion_auth->user($user_id)->row()->last_name;
            // }
            $username = $username[0]->first_name . ' ' . $username[0]->last_name;
        } elseif ($type === 'username') {
            $username = getRecords("AES_DECRYPT(username, '" . DATA_KEY . "') AS username,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name", "users", array("id" => $user_id));

            // if (!empty($ci->ion_auth->user($user_id)->row()->username)) {
            //     $username =  $ci->ion_auth->user($user_id)->row()->username;
            // }
        }

        return $username;
    }

}


if (!function_exists('uralensis_get_record_db_detail')) {

    /**
     * Get Record DB Detail
     *
     * @param int $record_id
     * @param string $type
     */
    function uralensis_get_record_db_detail($record_id = '', $type = '')
    {
        $ci = &get_instance();
        if (!empty($record_id)) {
            switch ($type) {
                case $type:
                    return $ci->db->select($type)->where('uralensis_request_id', $record_id)->get('request')->row_array()[$type];
                    break;
                default:
                    echo "Somehow Value not found!.";
            }
        }
    }

}

if (!function_exists('uralensis_get_tat_date_settings')) {

    /**
     * Get TAT Date settings
     *
     * @param string $hospital_id
     */
    function uralensis_get_tat_date_settings($hospital_id = '')
    {
        $ci = &get_instance();
        if (!empty($hospital_id)) {
            return $ci->db->select('ura_tat_date_data')->where('ura_tat_hospital_id', $hospital_id)->get('uralensis_tat_settings')->row_array();
        }
    }

}

if (!function_exists('get_record_specialty')) {

    function get_record_specialty($request_id = '')
    {
        $ci = &get_instance();
        if (!empty($request_id)) {
            $res = $ci->db->query("SELECT `specialty` FROM `request` 
            INNER JOIN `request_specimen` ON `request_specimen`.`rs_request_id` = `request`.`uralensis_request_id`
            INNER JOIN `specimen` ON `request_specimen`.`rs_specimen_id` = `specimen`.`specimen_id`
            INNER JOIN `specialties` ON `specialties`.`id` = `specimen`.`speciality_id` WHERE uralensis_request_id = $request_id")->result_array();

            if (count($res) == 0) {
                return '';
            }
            return $res[0]['specialty'];
        }
    }

}
if (!function_exists('get_record_specialty_id')) {

    function get_record_specialty_id($request_id = '')
    {
        $ci = &get_instance();
        if (!empty($request_id)) {
            $res = $ci->db->query("SELECT `specialties`.`id`, `specialty` FROM `request` 
            INNER JOIN `request_specimen` ON `request_specimen`.`rs_request_id` = `request`.`uralensis_request_id`
            INNER JOIN `specimen` ON `request_specimen`.`rs_specimen_id` = `specimen`.`specimen_id`
            INNER JOIN `specialties` ON `specialties`.`id` = `specimen`.`speciality_id` WHERE uralensis_request_id = $request_id")->result_array();

            if (count($res) == 0) {
                return '';
            }
            return $res[0]['id'];
        }
    }

}

if (!function_exists('uralensis_get_cost_code_dropdown')) {

    /**
     * Get Cost Codes Dropdown
     *
     * @param int $hospital_id
     * @param string $data
     */
    function uralensis_get_cost_code_dropdown($hospital_id = '', $data = '')
    {
        $ci = &get_instance();
        $cost_code_data = array();
        $output = '';
        if (!empty($hospital_id)) {
            $cost_code_data = $ci->db->where('ura_hos_id', $hospital_id)->get('uralensis_hospital_inovice_opt')->row_array();
            if (!empty($cost_code_data)) {
                //unserialize the data
                $tat_data = unserialize($cost_code_data['ura_hos_opt']);
                $output .= '<label for="cost_codes">Cost Code</label>';
                $output .= '<select name="cost_codes" class="form-control" disabled> ';
                if ($cost_code_data['ura_tat_option'] === 'true') {
                    if (!empty($tat_data)) {
                        $output .= '<option value="">Choose Cost Code</option>';
                        foreach ($tat_data as $key => $value) {
                            $selected = '';
                            if (!empty($value['make_default']) && $value['make_default'] === 'on') {
                                $selected = 'selected';
                            } else {
                                if (!empty($data) && is_object($data) && $key === $data->cost_codes) {
                                    $selected = 'selected';
                                }
                            }
                            $output .= '<option ' . $selected . ' value="' . $key . '">' . $key . '</option>';
                        }
                    }
                } else {
                    $selected = '';
                    if (isset($data) && is_object($data) && !empty($tat_data) && $tat_data['cost_code_name'] === $data->cost_codes) {
                        $selected = 'selected';
                    }
                    $output .= '<option ' . $selected . ' value="' . $tat_data['cost_code_name'] . '">' . $tat_data['cost_code_name'] . '</option>';
                }
                $output .= '</select>';
            }
            echo $output;
        }
    }

}


if (!function_exists('uralensis_get_average_tat_calculate')) {

    /**
     * Get average TAT calculation
     *
     * @param string $hospital_id
     * @param string $doctor_id
     * @param string $type
     */
    function uralensis_get_average_tat_calculate($hospital_id = '', $doctor_id = '', $type = '')
    {
        $ci = &get_instance();
        $ci->load->model('Institute_model');
        $tat_average = '';
        if (!empty($hospital_id) && !empty($doctor_id) && !empty($type)) {
            $tat_settings = uralensis_get_tat_date_settings($hospital_id);
            if (!empty($tat_settings) && $tat_settings['ura_tat_date_data'] === 'date_sent_touralensis') {
                $date_sent_to_uralensis = 'date_sent_touralensis';
                $tat_date = $date_sent_to_uralensis;
            } elseif ($tat_settings['ura_tat_date_data'] === 'date_rec_by_doctor') {
                $date_rec_by_doctor = 'date_rec_by_doctor';
                $tat_date = $date_rec_by_doctor;
            } elseif ($tat_settings['ura_tat_date_data'] === 'data_processed_bylab') {
                $data_processed_bylab = 'data_processed_bylab';
                $tat_date = $data_processed_bylab;
            } elseif ($tat_settings['ura_tat_date_data'] === 'date_received_bylab') {
                $date_received_bylab = 'date_received_bylab';
                $tat_date = $date_received_bylab;
            } elseif ($tat_settings['ura_tat_date_data'] === 'publish_datetime') {
                $publish_datetime = 'publish_datetime';
                $tat_date = $publish_datetime;
            } else {
                $tat_date = 'request_datetime';
            }

            $start_date = '';
            $end_date = '';
            if (isset($_GET['mode']) && $_GET['mode'] === 'period') {
                $start_date = date("Y-m-d", strtotime($_GET['start_date']));
                $end_date = date("Y-m-d", strtotime($_GET['end_date']));
            }
            $tat_records = $ci->Institute_model->get_average_tat_records($hospital_id, $doctor_id, $type, $tat_date, $start_date, $end_date);
            //Loop the record and count the all date_diff field.
            if (!empty($tat_records)) {
                $total_cases = 0;
                $date_diff_count = 0;
                foreach ($tat_records as $key => $value) {
                    $date_diff_count = $date_diff_count + $value['DATE_DIFF'];
                    $total_cases++;
                }
                $tat_average = $date_diff_count / $total_cases;
            }
            //Calculate Total Average Percentatge of TAT
            return round($tat_average);
        }
    }

}

if (!function_exists('uralensis_get_weekday_record_data')) {

    /**
     * Get Weekday Record Data
     *
     * @param int $doctor_id
     * @param string $current_date
     * @param int $hospital_id
     */
    function uralensis_get_weekday_record_data($doctor_id = '', $current_date = '', $hospital_id = '')
    {
        $ci = &get_instance();
        $ci->load->model('Institute_model');

        $record_data = array();
        if (!empty($doctor_id) && !empty($current_date) && !empty($hospital_id)) {
            $record_data = $ci->Institute_model->get_weekly_record_data($current_date, $doctor_id, $hospital_id);

            return $record_data;
        }
    }

}

if (!function_exists('get_accumulative_doctor_hospital_records')) {

    /**
     * Get total accumulative records for hospital against doctor
     *
     * @param int $doctor_id
     * @param int $hospital_id
     * @param string $current_year
     */
    function get_accumulative_doctor_hospital_records($doctor_id = '', $hospital_id = '', $current_year = '')
    {
        $ci = &get_instance();
        $ci->load->model('Institute_model');
        $record_data = array();
        if (!empty($doctor_id) && !empty($hospital_id) && !empty($current_year)) {
            $record_data = $ci->Institute_model->get_accumulative_doctor_hospital_records($doctor_id, $hospital_id, $current_year);
            return $record_data;
        }
    }

}

if (!function_exists('requestedPagesFutherWork')) {

    /**
     * Get Doctor total publish records number...
     *
     * @param string $type
     */
    function requestedPagesFutherWork($type = '', $id = '')
    {
        $ci = &get_instance();
        $ci->load->model('Admin_model');

        $totalrecords = $ci->Admin_model->display_further_work_model_requested_Count();

        return $totalrecords[0]->TOTROWS;
    }

}

if (!function_exists('TotalPublishRecordsCount')) {

    /**
     * Get Doctor total publish records number...
     *
     * @param string $type
     */
    function TotalPublishRecordsCount($type = '', $id = '')
    {
        $ci = &get_instance();
        $ci->load->model('Admin_model');

        $totalrecords = $ci->Admin_model->display_all_requested_Count();

        return $totalrecords[0]->TOTROWS;
    }

}


if (!function_exists('completedPagesFutherWork')) {

    /**
     * Get Doctor total publish records number...
     *
     * @param string $type
     */
    function completedPagesFutherWork($type = '', $id = '')
    {
        $ci = &get_instance();
        $ci->load->model('Admin_model');

        $totalrecords = $ci->Admin_model->display_further_work_model_completed_Count();

        return $totalrecords[0]->TOTROWS;
    }

}


if (!function_exists('uralensis_get_doctor_publish_records_count')) {

    /**
     * Get Doctor total publish records number...
     *
     * @param string $type
     */
    function uralensis_get_doctor_publish_records_count($type = '', $id = '')
    {
        $ci = &get_instance();
        $ci->load->model('Doctor_model');
        if ($id == '') {
            $id = $ci->session->userdata('user_id');
        }
        if (!empty($type) && $type === 'reported') {
            echo $ci->Doctor_model->status_bar_result_count_published($id);
        } else {
            echo $ci->Doctor_model->status_bar_result_count_un_reported($id);
        }
    }

}

if (!function_exists('uralensis_get_doctor_further_work_data_count')) {

    /**
     * Get total further work records
     *
     */
    function uralensis_get_doctor_further_work_data_count()
    {
        $ci = &get_instance();
        $ci->load->model('Doctor_model');
        $count_data = $ci->Doctor_model->further_view();
        return count($count_data);
    }

}

if (!function_exists('getAllUsersGroups')) {

    /**
     * Get All Groups
     *
     * @param array $selective_group
     */
    function getAllUsersGroups($selective_group = '')
    {
        $ci = &get_instance();
        $ci->load->model('Admin_model');
        if (!empty($selective_group)) {
            return $ci->Admin_model->getAllHopsitalsGroups($selective_group);
        } else {
            return $ci->Admin_model->getAllHopsitalsGroups();
        }
    }

}

if (!function_exists('getStaticGroupNames')) {

    function getStaticGroupNames()
    {
        return array(
            'A' => 'Administrator',
            'D' => 'Doctor',
            'H' => 'Hospital',
            'L' => 'Laboratory',
            'S' => 'Secretary'
        );
    }

}


if (!function_exists('getAllUsersByGroupId')) {

    /**
     * Get all users by group ID
     *
     * @param int $group_id
     */
    function getAllUsersByGroupId($group_id = '')
    {
        $ci = &get_instance();
        $user_data = array();
        if (!empty($group_id)) {
            //Get all user ids by group id
            $user_ids = $ci->db->select('user_id')->where('group_id', $group_id)->get('users_groups')->result_array();
            if (!empty($user_ids)) {
                foreach ($user_ids as $user_key => $user_val) {
                    $user_data[] = $ci->db->select('id')->where('id', $user_val['user_id'])->get('users')->row_array();
                }
            }
        }
        return $user_data;
    }

}

/**
 * Get Laboratory User ID
 *
 * @param string $lab_name
 */
function getLaboratoryUserId($lab_name = '')
{
    if (!empty($lab_name)) {
        $ci = &get_instance();
        //Get User ID based on Lab Name
        return $ci->db->select('id, user_lab_default_status, description')->where('name', $lab_name)->get('groups')->row_array();
    }
}

if (!function_exists('getUserEmail')) {

    function getUserEmail($id = '')
    {
        if (!empty($id)) {
            $ci = &get_instance();
            // Get all users in the group ID
            $all_users = $ci->db->query("SELECT user_id FROM `users_groups` WHERE group_id = $id")->result_array();
            $emails = array();
            foreach ($all_users as $user) {
                $res = $ci->db->query("SELECT  AES_DECRYPT(email, '" . DATA_KEY . "') AS user_email FROM users WHERE id = " . $user['user_id'] . " AND email IS NOT NULL AND email != ''")->result_array();
                array_push($emails, $res[0]['user_email']);
            }
            return $emails;
        }
        return null;
    }

}

if (!function_exists('getSpecificUserIdFromGroups')) {

    /**
     * Get Specific user id from groups table
     *
     * @param int $user_id
     */
    function getSpecificUserIdFromGroups($user_id = '')
    {
        if (!empty($user_id)) {
            $ci = &get_instance();
            return $ci->db->select('user_lab_default_status')->where('user_lab_default_status', $user_id)->get('groups')->row_array()['user_lab_default_status'];
        }
    }

}

if (!function_exists('getUsersCountOnGroups')) {

    /**
     * Get Users Count Based On Their Groups
     *
     * @param int $group_id
     */
    function getUsersCountOnGroups($group_id = '')
    {
        $ci = &get_instance();
        $ci->load->model('Admin_model');
        if (!empty($group_id)) {
            return $ci->Admin_model->getAllUserCountsOnGroupId($group_id);
        }
    }

}

if (!function_exists('getAllHospitalGroup')) {

    /**
     * Return Counted Hospital Group Users
     *
     */
    function getAllHospitalGroup()
    {
        $user_groups = getAllUsersGroups('H');
        $count_total_hospital_users = 0;
        foreach ($user_groups as $ugkey => $ugval) {
            $count_total_hospital_users++;
        }
        return $count_total_hospital_users;
    }

}

if (!function_exists('getAllHospitals')) {

    function getAllHospitals()
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT * FROM `groups` WHERE `group_type` = 'H'")->result_array();
    }

}

if (!function_exists('getAllLaboratoryGroup')) {

    /**
     * Return Counted Laboratory Group
     *
     */
    function getAllLaboratoryGroup()
    {
        $user_groups = getAllUsersGroups('L');
        $count_total_laboratory_users = 0;
        foreach ($user_groups as $ugkey => $ugval) {
            $count_total_laboratory_users++;
        }
        return $count_total_laboratory_users;
    }

}

/**
 * Truncate Text
 *
 * @param string $text
 * @param int $chars
 */
function uralensisTruncateText($text, $chars = 25)
{
    if (strlen($text) <= $chars) {
        return $text;
    }
    $text = $text . " ";
    $text = substr($text, 0, $chars);
    $text = substr($text, 0, strrpos($text, ' '));
    $text = $text . "...";
    return $text;
}

if (!function_exists('getAllUsers')) {

    /**
     * Get Customized Users Data Results
     * Specific Group Users or All Users
     *
     * @param int $url_user_group_id
     */
    function getAllUsers($url_user_group_id = '')
    {

        $ci = &get_instance();

        if (!empty($url_user_group_id)) {
            $users_array = $ci->ion_auth->users($url_user_group_id)->result();
            echo last_query();
            exit;
            foreach ($users_array as $k => $user) {
                $users_array[$k]->groups = $ci->ion_auth->get_users_groups($user->id)->result();
            }
        } else {
            $users_array = $ci->ion_auth->users()->result();
            //echo last_query();exit;
            foreach ($users_array as $k => $user) {
                $users_array[$k]->groups = $ci->ion_auth->get_users_groups($user->id)->result();
            }
        }

        return $users_array;
    }

}


if (!function_exists('getPrivateMessageCount')) {

    /**
     * Get Private Messages Counts
     *
     * @param string $msg_status
     */
    function getPrivateMessageCount($msg_status = '')
    {
        $ci = &get_instance();
        $messages = '0';

        if (!empty($msg_status) && $msg_status === 'inbox') {
            $messages = $ci->pm_model->get_messages(MSG_NONDELETED);
        } elseif ($msg_status === 'unread') {
            $messages = $ci->pm_model->get_messages(MSG_UNREAD);
        } elseif ($msg_status === 'sent') {
            $messages = $ci->pm_model->get_messages(MSG_SENT);
        } elseif ($msg_status === 'deleted') {
            $messages = $ci->pm_model->get_messages(MSG_DELETED);
        }
        return count($messages);
    }

}

if (!function_exists('getSnomedCodes')) {

    /**
     * Get Snomed T Code
     *
     * @param string $type
     */
    function getSnomedCodes($type = '')
    {
        $ci = &get_instance();
        if (!empty($type)) {
            return $ci->db->select('usmd_code_id, usmdcode_code, usmdcode_code_desc, snomed_diagnoses, rc_path_score, snomed_added_by')->where('snomed_type', $type)->from('uralensis_snomed_codes')->get()->result_array();
        } else {
            return array();
        }
    }

}

if (!function_exists('getMicroCodes')) {

    /**
     * Get Micro Codes
     *
     * @param string $type
     */
    function getMicroCodes()
    {
        $ci = &get_instance();
        return $ci->db->select('umc_id , umc_code , umc_title, umc_micro_desc, umc_disgnosis, umc_snomed_t_code, umc_snomed_t2_code, umc_snomed_m_code, umc_added_by, umc_rcpath_score, umc_status, timestamp')->from('uralensis_micro_codes')->order_by('umc_id', 'DESC')->get()->result_array();
    }

}

if (!function_exists('getSnomedCodesData')) {

    /**
     * Get Snomed Codes Data
     *
     * @param string $type
     */
    function getSnomedCodesData($type = '')
    {
        $ci = &get_instance();
        return $ci->db->where('snomed_type', $type)->from('uralensis_snomed_codes')->get()->result_array();
    }

}


if (!function_exists('getUserPermission')) {

    /**
     * Get User Permission
     *
     * @param int $user_id
     * @param string $type
     */
    function getUserPermission($user_id, $type = '')
    {
        $ci = &get_instance();
        $user_perm = '';
        switch ($type) {
            case "micro_perm":
                $user_perm = $ci->ion_auth->user($user_id)->row()->user_change_micro_codes;
                break;
        }
        return $user_perm;
    }

}


if (!function_exists('getRecordAssignUserID')) {

    /**
     * Get Record Assign User ID
     *
     * @param string $record_id
     */
    function getRecordAssignUserID($record_id = '')
    {
        $ci = &get_instance();
        if (!empty($record_id)) {
            return $ci->db->select('user_id')->where('request_id', $record_id)->get('request_assignee')->row_array()['user_id'];
        }
    }

}


if (!function_exists('getUserLogins')) {

    /**
     * Get Total Logins Based on Type and Identity
     *
     * @param string $identity
     * @param string $type
     */
    function getUserLogins($identity = '', $type = '')
    {
        $ci = &get_instance();
        if (!empty($identity) && $type === 'failed') {
            return $ci->db->select('*')->where('login', $identity)
                ->get('login_attempts')->num_rows();
        } elseif ($type === 'logins') {
            return $ci->db->select('*')->where('users_login_id', $identity)
                ->get('users_login_records')->num_rows();
        }
    }

}

if (!function_exists('randomNameInitialsColors')) {

    /**
     * Generate Random Colors
     *
     */
    function randomNameInitialsColors()
    {
        $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');

        $color = '#' .
            $rand[rand(0, 15)] .
            $rand[rand(0, 15)] .
            $rand[rand(0, 15)] .
            $rand[rand(0, 15)] .
            $rand[rand(0, 15)] .
            $rand[rand(0, 15)];

        return $color;
    }

}

if (!function_exists('getInitialsFromName')) {

    /**
     * Get Initials From Name
     *
     */
    function getInitialsFromName($user_id = '')
    {
        $ci = &get_instance();
        $initials = 'NA';
        if (!empty($user_id)) {

            /* $first_name = $ci->db->select('first_name')
              ->where('id', $user_id)->get('users')
              ->row_array()['first_name'];
              $last_name = $ci->db->select('last_name')
              ->where('id', $user_id)->get('users')
              ->row_array()['last_name']; */
            $getName = getRecords("AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name", "users", array("id" => $user_id));
            $first_name = $getName[0]->first_name;
            $last_name = $getName[0]->last_name;

            $first_name = !empty($first_name) ? strtoupper($first_name[0]) : 'N';
            $last_name = !empty($last_name) ? strtoupper($last_name[0]) : 'A';

            $initials = $first_name . $last_name;
        }

        return $initials;
    }

}

if (!function_exists('getUserMetaDetail')) {

    /**
     * Returns User Meta Details
     *
     * @param string $user_id
     * @param string $type
     * @param string $table
     */
    function getUserMetaDetail($user_id = '', $type = '', $table = '')
    {
        $ci = &get_instance();
        return $ci->db->select($type)->where('id', $user_id)
            ->get($table)->result_array();
    }

}

if (!function_exists('getMessagesForDashbaord')) {

    /**
     * Get  messages for dashboard in popup
     *
     * @param string $user_id
     */
    function getMessagesForDashbaord($user_id = '')
    {

        $ci = &get_instance();

        $sql = "SELECT privmsg_subject,
                privmsg_date,
                privmsg_body,
                privmsg_id,
                aes_decrypt(users.first_name, '" . DATA_KEY . "') AS enc_first_name,
           aes_decrypt(users.last_name, '" . DATA_KEY . "') AS enc_last_name,
           profile_picture_path
         FROM `privmsgs` JOIN `privmsgs_to` ON `pmto_message` = `privmsg_id`
                INNER JOIN users ON users.id=privmsg_author
                WHERE `pmto_recipient` = '" . $user_id . "' AND pmto_read IS NULL AND `pmto_deleted` IS NULL GROUP BY `privmsg_id` ORDER BY `privmsg_date` DESC";
        $query = $ci->db->query($sql);
        return $query->result();
    }

}
if (!function_exists('getLoggedInUserProfile')) {

    /**
     * Get  messages for dashboard in popup
     *
     * @param string $user_id
     */
    function getLoggedInUserProfile($user_id = '')
    {

        $ci = &get_instance();

        $sql = "SELECT profile_picture_path,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username  FROM users
                                WHERE id=" . $user_id;


        $query = $ci->db->query($sql);
        return $query->result();
    }

}

if (!function_exists('getNotificationCount')) {

    /**
     * Get total inbox messages
     *
     * @param string $user_id
     */
    function getNotificationCount($user_id = '')
    {
        $ci = &get_instance();
        $query = $ci->db->query(
            "SELECT * FROM system_notifications
            WHERE notification_status=1 AND user_id=$user_id ORDER BY notification_id DESC LIMIT 5"
        );
        return $query->result();
    }

}
if (!function_exists('addNotification')) {

    /**
     * Get total inbox messages
     *
     * @param array $data
     */
    function addNotification($data = array())
    {
        // Get a reference to the controller object
        $obj_Controller = get_instance();

        // load the model if it hasn't been pre-loaded
        $obj_Controller->load->model('Userextramodel');

        // calling model function to get drop down options list
        $dropdown_list = $obj_Controller->Userextramodel->add_notification($data);
        return $dropdown_list;
    }

}

if (!function_exists('getOpinionsRequestedCount')) {

    /**
     * Get total opinions requests per request
     *
     * @param string $user_id
     */
    function getOpinionsRequestedCount($request_id = '')
    {
        $ci = &get_instance();
        //        return $request_id;
        $query = $ci->db->query(
            "SELECT * FROM uralensis_opinions WHERE ura_opinion_req_id = $request_id AND ura_opinion_parent_id =0 "
        );
        $ura_opinions = $query->result_array();
        $ura_opinion_ids = "";

        foreach ($ura_opinions as $key => $value) {
            $ura_opinion_ids .= $value['ura_opinion_id'] . ",";
        }
        $ura_opinion_ids = rtrim($ura_opinion_ids, ',');

        $query2 = $ci->db->query(
            "SELECT * FROM uralensis_opinion_recipient WHERE ura_opinion_id IN($ura_opinion_ids) "
        );
        $ura_opinion_requests = $query2->result_array();
//            echo $ci->db->last_query();
        $total_count = count($ura_opinion_requests);
        $pending_count = 0;
        $accepted_count = 0;
        $rejected_count = 0;
        $replied_count = 0;

        $op_req_status = array();
        foreach ($ura_opinion_requests as $k => $val) {
            array_push($op_req_status, $val['ura_rec_opinion_status']);
            if ($val['ura_rec_opinion_status'] == "Pending") {
                $pending_count += 1;
            }
            if ($val['ura_rec_opinion_status'] == "Accepted") {
                $accepted_count += 1;
            }
            if ($val['ura_rec_opinion_status'] == "Declined") {
                $rejected_count += 1;
            }
            if ($val['ura_rec_opinion_status'] == "Reply Sent") {
                $replied_count += 1;
            }
        }
        $opinion_status_return = array();

//            echo "<pre>";print_r($op_req_status);
//            $opinion_status_return['text'] = "Invited";
//            $opinion_status_return['status'] = "Pending";
//            $opinion_status_return['badge_color'] = "badge-warning";
        $opinion_status_return['total'] = $total_count;
        $opinion_status_return['pending_count'] = $pending_count;
        $opinion_status_return['accepted_count'] = $accepted_count;
        $opinion_status_return['rejected_count'] = $rejected_count;
        $opinion_status_return['replied_count'] = $replied_count;


        if (in_array("Pending", $op_req_status)) {
            //            if($pending_count == $total_count){
            $opinion_status_return['text'] = "Invited";
            $opinion_status_return['status'] = "Pending";
            $opinion_status_return['badge_color'] = "badge-warning";
            $opinion_status_return['total'] = $total_count;
            $opinion_status_return['filled'] = $pending_count;
            //            }
        }
        if (in_array("Accepted", $op_req_status)) {
            //            if($accepted_count == $total_count){
            $opinion_status_return['text'] = "Pending Opinion Reply";
            $opinion_status_return['status'] = "Accepted";
            $opinion_status_return['badge_color'] = "#ff6a1a";
            $opinion_status_return['badge_icon'] = "la-check-circle";
            $opinion_status_return['total'] = $total_count;
            $opinion_status_return['filled'] = $accepted_count;
            //            }
        }
        if (in_array("Declined", $op_req_status)) {
            //            if($rejected_count == $total_count){
            $opinion_status_return['text'] = "Declined";
            $opinion_status_return['status'] = "Declined";
            $opinion_status_return['badge_color'] = "#cc0000";
            $opinion_status_return['badge_icon'] = "la-times-circle";
            $opinion_status_return['total'] = $total_count;
            $opinion_status_return['filled'] = $rejected_count;
            //            }
        }
        if (in_array("Reply Sent", $op_req_status)) {
            //            if($replied_count == $total_count){
            $opinion_status_return['text'] = "Reply Sent";
            $opinion_status_return['status'] = "Reply Sent";
            $opinion_status_return['badge_color'] = "#188508";
            $opinion_status_return['badge_icon'] = "la-check-circle";
            $opinion_status_return['total'] = $total_count;
            $opinion_status_return['filled'] = $pending_count;
            //            }
        }
        //        echo '<pre>'; print_r($opinion_status_return);
        return $opinion_status_return;
    }

}

if (!function_exists('getInboxMessagesCounter')) {

    /**
     * Get total inbox messages
     *
     * @param string $user_id
     */
    function getUnreadMessagesCounter($user_id = '')
    {
        $ci = &get_instance();
        $query = $ci->db->query(
            "SELECT * FROM privmsgs_to
            WHERE privmsgs_to.pmto_recipient = $user_id AND (pmto_read IS  NULL OR pmto_read=0)"
        );
        return $query->result();
    }

}

if (!function_exists('getdraftMessagesCounter')) {

    /**
     * Get total inbox messages
     *
     * @param string $user_id
     */
    function getdraftMessagesCounter($user_id = '')
    {
        $ci = &get_instance();
        $query = $ci->db->query(
            "SELECT * FROM privmsgs_draft
            WHERE is_deleted=0 AND privmsg_author = $user_id"
        );
        return $query->result();
    }

}
if (!function_exists('getDeleteMessagesCounter')) {

    /**
     * Get total inbox messages
     *
     * @param string $user_id
     */
    function getDeleteMessagesCounter($user_id = '')
    {
        $ci = &get_instance();
//        $query = $ci->db->query(
//            "SELECT * FROM privmsgs_to
//            WHERE pmto_deleted=1 AND pmto_recipient = $user_id" ;
        $query = $ci->db->query(
            "SELECT
                    `privmsgs`.*
                FROM
                    `privmsgs`
                JOIN `privmsgs_to` ON `pmto_message` = `privmsg_id`
                WHERE
                    `pmto_recipient` = $user_id AND `pmto_deleted` = 1 OR `privmsg_author` = $user_id AND `privmsg_deleted` = 1
                GROUP BY
                    `privmsg_id`"
        );
        return $query->result();
    }

}
if (!function_exists('getSentMessagesCounter')) {

    /**
     * Get total inbox messages
     *
     * @param string $user_id
     */
    function getSentMessagesCounter($user_id = '')
    {
        $ci = &get_instance();
        $query = $ci->db->query(
            "SELECT * FROM privmsgs
            WHERE privmsg_author = $user_id"
        );
        return $query->result();
    }

}

if (!function_exists('getHospitalAssignedToDoctorCount')) {

    /**
     * Get Hospital Assigned To Doctor Count
     *
     * @param string $user_id
     */
    function getHospitalAssignedToDoctorCount($user_id = '')
    {
        $ci = &get_instance();
        return $ci->db->query(
            "SELECT * FROM users_request
             WHERE users_request.doctor_id = $user_id
             GROUP BY users_request.group_id"
        )->num_rows();
    }

}


if (!function_exists('timeagoCustom')) {

    function timeagoCustom($date)
    {
        $timestamp = strtotime($date);

        $strTime = array("second", "minute", "hour", "day", "month", "year");
        $length = array("60", "60", "24", "30", "12", "10");

        $currentTime = time();
        if ($currentTime >= $timestamp) {
            $diff = time() - $timestamp;
            for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
                $diff = $diff / $length[$i];
            }

            $diff = round($diff);
            return $diff . " " . $strTime[$i] . "(s) ago ";
        }
    }

}

if (!function_exists('get_institute_logo')) {

    function get_institute_logo($h_id)
    {
        $ci = &get_instance();
        $res = $ci->db->get_where('hospital_information', array('group_id' => $h_id))->result_array();
        if (!empty($res)) {
            $logo = $res[0]['logo'];
            if (!empty($logo)) {
                return $logo;
            }
        }
        return NULL;
    }

}

if (!function_exists('get_profile_picture')) {

    function get_profile_picture($profile_picture_path, $first_name, $last_name)
    {
        $profile_picture = "";
        if (!empty($profile_picture_path) && $profile_picture_path != DEFAULT_PROFILE_PIC && file_exists(APPPATH . '../' . $profile_picture_path)) {
            $profile_picture = base_url($profile_picture_path);
        } else {
            $profile_picture = UI_AVATAR . urlencode($first_name . ' ' . $last_name);
        }
        return $profile_picture;
    }

}

if (!function_exists("format_nhs_number")) {

    function format_nhs_number($nhs)
    {
        if (empty($nhs))
            return "";

        if (strlen($nhs) !== 10) {
            return $nhs;
        }

        $part1 = substr($nhs, 0, 3);
        $part2 = substr($nhs, 3, 3);
        $part3 = substr($nhs, 6);
        return $part1 . ' ' . $part2 . ' ' . $part3;
    }

}

if (!function_exists("request_has_slides")) {

    function request_has_slides($request_id)
    {
        $ci = &get_instance();
        $res = $ci->db
            ->join("request_specimen", "request.uralensis_request_id = request_specimen.rs_request_id")
            ->join("specimen_slide", "request_specimen.rs_specimen_id = specimen_slide.specimen_id ")
            ->where("uralensis_request_id", $request_id)
            ->get("request")
            ->num_rows();
        return $res > 0;
    }

}

if (!function_exists("get_session_reset_time")) {

    function get_session_reset_time()
    {
        if (ENVIRONMENT === "server-supp" || ENVIRONMENT === "development") {
            return 9999999;
        }
        return 10000;
    }

}

if (!function_exists('get_user_status')) {

    function get_user_status($status)
    {
        if ($status == 0) {
            $statusText = "Not Validated";
        } else if ($status == 1) {
            $statusText = "Validated";
        } else if ($status == 2) {
            $statusText = "Locked";
        } else if ($status == 3) {
            $statusText = "Spam";
        } else if ($status == 4) {
            $statusText = "Banned";
        } else {
            $statusText = "Unknown";
        }
        return $statusText;
    }

}

if (!function_exists('ip_info')) {

    function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
    {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city" => @$ipdat->geoplugin_city,
                            "state" => @$ipdat->geoplugin_regionName,
                            "country" => @$ipdat->geoplugin_countryName,
                            "country_code" => @$ipdat->geoplugin_countryCode,
                            "continent" => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
//        echo "<pre>";print_r($output);exit;
        return $output;


//            $ipdat = @json_decode(file_get_contents(
//                "http://www.geoplugin.net/json.gp?ip=" . $ip));
//
//            $output['country'] =  $ipdat->geoplugin_countryName ;
//            $output['city'] = $ipdat->geoplugin_city ;
//            $output['continent'] = $ipdat->geoplugin_continentName ;
//            $output['latitude'] = $ipdat->geoplugin_latitude ;
//            $output['longitude'] = $ipdat->geoplugin_longitude ;
//            $output['currency_symbol'] = $ipdat->geoplugin_currencySymbol ;
//            $output['currency_code'] = $ipdat->geoplugin_currencyCode ;
//            $output['timezone'] = $ipdat->geoplugin_timezone;
//            return $output;
    }

}

if (!function_exists('secondsToTime')) {

    function secondsToTime($inputSeconds)
    {

        $secondsInAMinute = 60;
        $secondsInAnHour = 60 * $secondsInAMinute;
        $secondsInADay = 24 * $secondsInAnHour;

        // extract days
        $days = floor($inputSeconds / $secondsInADay);

        // extract hours
        $hourSeconds = $inputSeconds % $secondsInADay;
        $hours = floor($hourSeconds / $secondsInAnHour);

        // extract minutes
        $minuteSeconds = $hourSeconds % $secondsInAnHour;
        $minutes = floor($minuteSeconds / $secondsInAMinute);

        // extract the remaining seconds
        $remainingSeconds = $minuteSeconds % $secondsInAMinute;
        $seconds = ceil($remainingSeconds);

        // return the final array
        $obj = array(
            'day' => (int)$days,
            'hr' => (int)$hours,
            'min' => (int)$minutes,
            'sec' => (int)$seconds,
        );

        $timeParts = "";
        foreach ($obj as $name => $value) {
            if ($value > 0) {
                $timeParts .= $value . " " . $name . " ";
            }
        }
        return $timeParts;
    }

}

function getPricingCodeAgainstCategory($catId)
{
    //echo $catId; exit;
    $ci = &get_instance();
    $ci->load->model('invoice_model');
    $data["result"] = $ci->invoice_model->priceCodeListingAgainstCategory($catId);
    $data["result"] = $data["result"][0];

    return $data["result"];
}

function getCodeDetails($catId)
{
    // echo $catId; exit;
    $ci = &get_instance();
    $ci->load->model('invoice_model');
    $data["result"] = $ci->invoice_model->getCodeDetails($catId);
    //$data["result"] = $data["result"][0];

    return $data["result"];
}

function getLabTests($catId)
{
    // echo $catId; exit;
    $ci = &get_instance();
//        $ci->load->model('invoice_model');
//        $data["result"] = $ci->invoice_model->getCodeDetails($catId);
    //$data["result"] = $data["result"][0];
    $userId = $ci->session->userdata('user_id');
    $qry = "SELECT * FROM laboratory_tests WHERE test_category_id = $catId ";
    $res = $ci->db->query($qry)->result_array();
//        echo "<pre>";
//        print_r($res); exit;
    return $res;
}

function getUserTrackActivity($logId)
{
    $ci = &get_instance();
    $ci->db->select("usertracking_activity.*,profile_picture_path,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
        AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,modules.id as module_id,modules.name as module,url_management.description");
    $ci->db->join('users', 'users.id = usertracking_activity.track_session_userid');
    $ci->db->join('url_management', 'usertracking_activity.request_uri LIKE  CONCAT("%", url_management.url, "%")', 'LEFT');
    $ci->db->join('modules', 'url_management.module_id=modules.id', 'LEFT');
    $ci->db->order_by("user_activity_id", "DESC");
    $ci->db->where('userlogin_log_id', $logId);
    $get_data = $ci->db->get("usertracking_activity");
    $get_data = $get_data->result();
    return $get_data;
}

function getMainTestCategories()
{
    //echo 1; exit;
    $CI = &get_instance();

    $query = "SELECT * FROM tests_main_categories WHERE is_active ='1'";
    $result = $CI->db->query($query)->result_array();

    return $result;
}

function getSubTestCatAgainstMainCat($cat_id)
{
    //echo 1; exit;
    $CI = &get_instance();

    $query = "SELECT * FROM tests_sub_categories WHERE is_active ='1' AND main_category_id = $cat_id";
    $result = $CI->db->query($query)->result_array();

    return $result;
}

function getTestAgsinstSubCat($subCat, $labId='')
{

    if(!empty($labId)){
        $CI = &get_instance();
        $query = "SELECT * FROM laboratory_tests WHERE lab_id = $labId AND specialty_id = $subCat";
        $result = $CI->db->query($query)->result_array();
        return $result;
    }else{
        return [];
    }

}

function getLabAgainstId($labId)
{

    //echo 1; exit;
    $CI = &get_instance();

    $query = "SELECT * FROM sub_categories_tests_setup WHERE is_active ='1' AND sub_category_id = $subCat";
    $result = $CI->db->query($query)->result_array();

    return $result;
}

function getHospitalLabs($group_id)
{
    $CI = &get_instance();
    $query = "SELECT
                    groups.`id`,
                    groups.`name`,
                    groups.first_initial,
                    groups.description,
                    groups.group_type,
                    groups.last_initial,
                    groups.information
                FROM
                groups
                INNER JOIN hospital_group ON groups.id = hospital_group.group_id
                WHERE
              hospital_group.hospital_id = $group_id";

    $result = $CI->db->query($query)->result_array();
    return $result;
}


function getLabsHospitals($group_id)
{
    $CI = &get_instance();
    $query = "SELECT
                    groups.`id`,
                    groups.`name`,
                    groups.first_initial,
                    groups.description,
                    groups.group_type,
                    groups.last_initial,
                    groups.information
                FROM
                groups
                 INNER JOIN hospital_group ON groups.id = hospital_group.hospital_id
                WHERE
              hospital_group.group_id = $group_id";

    $result = $CI->db->query($query)->result_array();
    return $result;
}

function getLabsDetailss($group_id)
{
    $CI = &get_instance();
    $query = "SELECT
                    groups.`id`,
                    groups.`name`,
                    groups.first_initial,
                    groups.description,
                    groups.group_type,
                    groups.last_initial,
                    groups.information
                FROM
                groups                 
                WHERE
              id = $group_id";

    $result = $CI->db->query($query)->result_array();
    return $result;
}

function getTimesheetData()
{
    $CI = &get_instance();
    $user_id = $CI->ion_auth->user()->row()->id;
    $current_date = date("Y-m-d");
    $sqlQuery = "SELECT count(ut.id) as total,ut.start_time
                          FROM `user_timesheet` ut
                          WHERE ut.user_id=$user_id AND ut.task_date='$current_date' AND ut.end_time IS NULL";

    $getData = $CI->db->query($sqlQuery)->row();
    $data['start_time'] = $getData->start_time;
    $data['end_time_status'] = $getData->total;

    return $data;
}

if (!function_exists('saveFlagLikeData')) {

    /**
     * Get total inbox messages
     *
     * @param string $user_id
     */
    function saveFlagLikeData($postData)
    {
        $ci = &get_instance();
        $user_id = $ci->ion_auth->user()->row()->id;
        $dataId = $postData["dataId"];
        $dataSection = $postData["dataSection"];
        $dataStatus = $postData["dataStatus"];
        $dataRecordId = $postData["dataRecordId"];
        $updateData['comment_id'] = $dataId;
        $updateData['is_liked'] = $dataStatus;
        $updateData['user_id'] = $user_id;
//            $retRes = $this->db->where(array('id'=>$time_id))->update("user_timesheet",$updateData);
        $checkIfLiked = $ci->db->select("id")->where(array("comment_id"=>$dataId))->get("comment_likes")->row();
        if(empty($checkIfLiked)){
            $retRes = $ci->db->insert("comment_likes",$updateData);
        } else {
            $retRes = $ci->db->where(array("comment_id"=>$dataId,"user_id"=>$user_id))->update("comment_likes",$updateData);
        }

        $commentHtml = getFlagCommentDetails($dataRecordId,$postData);

        if($retRes){
            $response['status'] = "success";
            $response['html'] = $commentHtml;
        } else {
            $response['status'] = "fail";
        }
        return $response;
    }

}

if (!function_exists('getFlagCommentsCount')) {

    /**
     * Get total inbox messages
     *
     * @param string $user_id
     */
    function getFlagCommentsCount($record_id,$dataSection)
    {
        $ci = &get_instance();
        $sqlQuery = "SELECT COUNT(ts.id) as total
                          FROM `section_comments` ts
                          WHERE ts.record_id=$record_id AND ts.module_id=$dataSection";
        $totalCount = $ci->db->query($sqlQuery)->row()->total;
        return $totalCount;
    }

}

if (!function_exists('getFlagCommentDetails')) {

    /**
     * Get total inbox messages
     *
     * @param string $user_id
     */
    function getFlagCommentDetails($commentId,$postData,$dataSection=FALSE)
    {
        $ci = &get_instance();
        $log_user_id = $ci->ion_auth->user()->row()->id;
        $whereClauseAd = "";
        if($postData["dataSection"]){
            $whereClauseAd = "AND module_id=".$postData["dataSection"]."";
            $dataSection = $postData["dataSection"];
        } else if($dataSection){
            $whereClauseAd = "AND module_id=".$dataSection."";
        }
        $sqlQuery = "SELECT ts.*,cl.is_liked,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
                             AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
                             profile_picture_path
                          FROM `section_comments` ts
                          JOIN `users` on users.id=ts.user_id
                          LEFT JOIN `comment_likes` cl on ts.id=cl.comment_id
                          WHERE ts.record_id=$commentId $whereClauseAd  ORDER BY id DESC";
        $time_data = $ci->db->query($sqlQuery)->result();
        $returnHtml = '';
        foreach ($time_data as $result){
            $datacId = $result->id;

            $sqlQuery = "SELECT AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
                             AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
                             profile_picture_path
                          FROM `comment_likes` cl
                          JOIN `users` on users.id=cl.user_id
                          WHERE cl.comment_id=$datacId";
            $users_data = $ci->db->query($sqlQuery)->result();
            $likedColor = $disLikedColor = $innerUsersL = $innerUsersDL = "";
            if($result->is_liked==1){
                $likedColor = "color:#00c5fb";
                $innerUsersL = "";
                foreach ($users_data as $userD){
                    $innerUsersL .= "<li>".$userD->first_name." ".$userD->last_name."</li>";
                }
            } else if($result->is_liked==2){
                $disLikedColor = "color:#00c5fb";
                $innerUsersDL = "";
                foreach ($users_data as $userD){
                    $innerUsersDL .= "<li>".$userD->first_name." ".$userD->last_name."</li>";
                }
            }

            $addMoreOpt = "";
            if($result->user_id==$log_user_id){
                $addMoreOpt = '<li class="list-inline-item">
                                                   <div class="like p-2 dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item edit-comment-btn" data-id="'.$result->id.'" data-recordid="'.$result->record_id.'" href="javascript:;"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item delete-comment-btn" data-id="'.$result->id.'"  data-recordid="'.$result->record_id.'" href="javascript:;" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                        </div>
                                                   </div>
                                                </li>';
            }

            $returnHtml .='<div class="bg-white p-2 main-com-div">
                                    <div class="user-info"><img class="rounded-circle pull-left img-rounded" style="margin-right:15px;" src="'.get_profile_picture($result->profile_picture_path, $result->first_name, $result->last_name).'" width="40">
                                        <div class="ml-2"><span class="font-weight-bold name">'.$result->first_name.' '.$result->last_name.'</span><span style="margin-left:10px;" class="date text-muted">'.date("d-M-Y h:i A",strtotime($result->created_date)).'</span>
                                            <ul class="list-inline pull-right timesheet_ul" style="font-size:15px">
                                                <li class="list-inline-item">
                                                    <div class="like p-2 cursor comment_like" data-id="'.$result->id.'" data-recordid="'.$result->record_id.'" data-status="1" data-section="'.$dataSection.'" style="'.$likedColor.'">
                                                        <i class="fa fa-thumbs-o-up" style="font-size:24px;"></i> <span class="ml-1"></span>
                                                        <ul class="list-unstyled users_hh">
                                                        '.$innerUsersL.'
                                                        </ul>
                                                    </div>
                                                </li>
                                                <li class="list-inline-item">
                                                    <div class="like p-2 cursor comment_like" data-id="'.$result->id.'" data-recordid="'.$result->record_id.'" data-status="2" data-section="'.$dataSection.'" style="'.$disLikedColor.'">
                                                        <i class="fa fa-thumbs-o-down" style="font-size:24px;"></i> <span class="ml-1"></span>
                                                         <ul class="list-unstyled users_hh">
                                                        '.$innerUsersDL.'
                                                        </ul>
                                                    </div>
                                                </li>
                                              '.$addMoreOpt.'
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <p class="comment-text comment-text-cl">'.$result->description.'</p>
                                    </div>
                              </div>';
//                <div class="d-flex flex-row fs-12">
//				                        <div class="like p-2 cursor comment_like" data-id="'.$result->id.'" data-section="'.$dataSection.'" style="'.$likedColor.'"><i class="fa fa-thumbs-o-up"></i><span class="ml-1">'.$likedSen.'</span></div>
//				                        <div class="like p-2 cursor comment_share" data-id="'.$result->id.'" data-section="'.$dataSection.'""><i class="fa fa-share"></i><span class="ml-1">Share</span></div>
//                <li><div class="like p-2 cursor"><i class="fa fa-share"></i> <span class="ml-1">Share</span></div></li>

        }

        return $returnHtml;
    }

}

   
    