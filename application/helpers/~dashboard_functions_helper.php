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
     * @return void
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
     * @return void
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
     * @return void
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
        }*/
    }

}

if (!function_exists('uralensis_get_welcome_message')) {

    /**
     * Uralensis After login welcome message
     *
     * @return void
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
     * @return void
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
     * @return void
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
     * @return void
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
     * @return void
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
     * @return void
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
     * @return void
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
     * @return void
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
     * @return void
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

if (!function_exists('uralensis_get_username')) {

    /**
     * Get User first and last name
     *
     * @param int $user_id
     * @return void
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

if (!function_exists('uralensisGetUsername')) {

    /**
     * Get User Information
     *
     * @param int $user_id
     * @return void
     */
    function uralensisGetUsername($user_id, $type = 'fullname')
    {
        $ci = &get_instance();
        $f_name = '';
        $l_name = '';
        $username = '';
        if (!empty($user_id) && $type === 'fullname') {
            if (!empty($ci->ion_auth->user($user_id)->row()->first_name)) {
                $f_name = $ci->ion_auth->user($user_id)->row()->aes_decrypt(first_name, "7kgtY3rYvbx6krm2HGiR");
            }
            if (!empty($ci->ion_auth->user($user_id)->row()->last_name)) {
                $l_name = $ci->ion_auth->user($user_id)->row()->aes_decrypt(last_name, "7kgtY3rYvbx6krm2HGiR");
            }
            $username = $f_name . ' ' . $l_name;
        } elseif ($type === 'username') {
            if (!empty($ci->ion_auth->user($user_id)->row()->username)) {
                $username =  $ci->ion_auth->user($user_id)->row()->aes_decrypt(username, "7kgtY3rYvbx6krm2HGiR");
            }
            
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
     * @return void
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
     * @return void
     */
    function uralensis_get_tat_date_settings($hospital_id = '')
    {
        $ci = &get_instance();
        if (!empty($hospital_id)) {
            return $ci->db->select('ura_tat_date_data')->where('ura_tat_hospital_id', $hospital_id)->get('uralensis_tat_settings')->row_array();
        }
    }

}


if (!function_exists('uralensis_get_cost_code_dropdown')) {

    /**
     * Get Cost Codes Dropdown
     *
     * @param int $hospital_id
     * @param string $data
     * @return void
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
                $output .= '<select name="cost_codes" class="form-control">';
                if ($cost_code_data['ura_tat_option'] === 'true') {
                    if (!empty($tat_data)) {
                        $output .= '<option value="">Choose Cost Code</option>';
                        foreach ($tat_data as $key => $value) {
                            $selected = '';
                            if (!empty($value['make_default']) && $value['make_default'] === 'on') {
                                $selected = 'selected';
                            } else {
                                if ($key === $data->cost_codes) {
                                    $selected = 'selected';
                                }
                            }
                            $output .= '<option ' . $selected . ' value="' . $key . '">' . $key . '</option>';
                        }
                    }
                } else {
                    $selected = '';
                    if (!empty($tat_data) && $tat_data['cost_code_name'] === $data->cost_codes) {
                        $selected = 'selected';
                    }
                    $output .= '<option ' . $selected . ' value="' . $tat_data['cost_code_name'] . '">' . $tat_data['cost_code_name'] . '</option>';
                }
                $output .= '</select>';
                $output .= '<label for="cost_codes">Cost Code</label>';
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
     * @return void
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
     * @return void
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
     * @return void
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


if (!function_exists('uralensis_get_doctor_publish_records_count')) {

    /**
     * Get Doctor total publish records number...
     *
     * @param string $type
     * @return void
     */
    function uralensis_get_doctor_publish_records_count($type = '', $id = '')
    {
        $ci = &get_instance();
        $ci->load->model('Doctor_model');
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
     * @return void
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
     * @return void
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
     * @return void
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
 * @return void
 */
function getLaboratoryUserId($lab_name = '') {
    if (!empty($lab_name)) {
        $ci = &get_instance();
        //Get User ID based on Lab Name
        return $ci->db->select('id, user_lab_default_status, description')->where('name', $lab_name)->get('groups')->row_array();
    }
}

if (!function_exists('getSpecificUserIdFromGroups')) {

    /**
     * Get Specific user id from groups table
     *
     * @param int $user_id
     * @return void
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
     * @return void
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
     * @return void
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


if (!function_exists('getAllLaboratoryGroup')) {

    /**
     * Return Counted Laboratory Group
     *
     * @return void
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
 * @return void
 */
function uralensisTruncateText($text, $chars = 25) {
    if (strlen($text) <= $chars) {
        return $text;
    }
    $text = $text." ";
    $text = substr($text,0,$chars);
    $text = substr($text,0,strrpos($text,' '));
    $text = $text."...";
    return $text;
}

if (!function_exists('getAllUsers')) {

    /**
     * Get Customized Users Data Results
     * Specific Group Users or All Users
     *
     * @param int $url_user_group_id
     * @return void
     */
    function getAllUsers($url_user_group_id = '')
    {
        $ci = &get_instance();

        if (!empty($url_user_group_id)) {
            $users_array = $ci->ion_auth->users($url_user_group_id)->result();
           // echo last_query();exit;
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
     * @return void
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
     * @return void
     */
    function getSnomedCodes($type = '')
    {
        $ci = &get_instance();
        if (!empty($type)) {
            return $ci->db->select('usmdcode_code, usmdcode_code_desc, snomed_diagnoses, rc_path_score, snomed_added_by')->where('snomed_type', $type)->from('uralensis_snomed_codes')->get()->result_array();
        } else {
            return array();
        }
    }
}

if (!function_exists('getSnomedCodesData')) {
    /**
     * Get Snomed Codes Data
     *
     * @param string $type
     * @return void
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
     * @return void
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
     * @return void
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
     * @return void
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
     * @return void
     */
    function randomNameInitialsColors()
    {
        $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');

        $color = '#'.
        $rand[rand(0, 15)].
        $rand[rand(0, 15)].
        $rand[rand(0, 15)].
        $rand[rand(0, 15)].
        $rand[rand(0, 15)].
        $rand[rand(0, 15)];

        return $color;
    }
}

if (!function_exists('getInitialsFromName')) {
    /**
     * Get Initials From Name
     *
     * @return void
     */
    function getInitialsFromName($user_id = '') 
    {
        $ci = &get_instance();
        $initials = 'NA';
        if (!empty($user_id)) {

            $first_name = $ci->db->select('first_name')
                ->where('id', $user_id)->get('users')
                ->row_array()['first_name'];
            $last_name = $ci->db->select('last_name')
                ->where('id', $user_id)->get('users')
                ->row_array()['last_name'];

            $first_name = !empty($first_name) ? strtoupper($first_name[0]) : 'N';
            $last_name = !empty($last_name) ? strtoupper($last_name[0]) : 'A';

            $initials = $first_name.$last_name;
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
     * @return void
     */
    function getUserMetaDetail($user_id = '', $type = '', $table = '')
    {
        $ci = &get_instance();
        return $ci->db->select($type)->where('id', $user_id)
            ->get($table)->result_array();
    }
}


if (!function_exists('getInboxMessagesCounter')) {
    /**
     * Get total inbox messages
     *
     * @param string $user_id
     * @return void
     */
    function getUnreadMessagesCounter($user_id = '')
    {
        $ci = &get_instance();
        $query = $ci->db->query(
            "SELECT * FROM privmsgs_to
            WHERE privmsgs_to.pmto_read IS NULL
            AND privmsgs_to.pmto_recipient = $user_id"
        );
        return $query->result();
    }
}

if (!function_exists('getHospitalAssignedToDoctorCount')) {
    /**
     * Get Hospital Assigned To Doctor Count
     *
     * @param string $user_id
     * @return void
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
