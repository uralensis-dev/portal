<?php

defined('BASEPATH') or exit('No direct script access allowed');

function insertRecord($table = '', $data = array()) {
    // CALL METHOD
    //insertRecord('division_list',$_POST);
    $CI = &get_instance();

    $fieldsArrTime = array('created', 'modified');
    $fieldsArrUser = array('created_by', 'modified_by');

    $fields = $CI->db->list_fields($table);

    if ($CI->db->insert($table, $data)) {
        return 1;
    }
    return 0;
}

function updateRecord($table = '', $data = array(), $where = array()) {
    $CI = &get_instance();

    $fieldsArrTime = array('modified');
    $fieldsArrUser = array('modified_by');

    $fields = $CI->db->list_fields($table);

    foreach ($fields as $key => $field) {
        if (in_array($field, $fieldsArrTime)) {
            $data[$field] = date('Y-m-d H:i:s');
        }
        if (in_array($field, $fieldsArrUser)) {
            $data[$field] = $CI->session->userdata("admin_user_id"); //!empty($CI->session->userdata("admin_user_id"))?$CI->session->userdata("admin_user_id"):0;
        }
    }

    if (is_array($where) && !empty($where)) {
        foreach ($where as $key => $res) {
            $CI->db->where($key, $res);
        }
    }
    if ($CI->db->update($table, $data)) {
        return 1;
    }
    return 0;
}

function testmode() {
    $CI = &get_instance();
    if ($CI->config->item("TEST_MODE")) {
        if (isset($_SERVER['REMOTE_ADDR']) and $_SERVER['REMOTE_ADDR'] == '10.52.85.230' and $_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
            ##do nothing
        } else {

            error_reporting(E_ALL);
            ini_set('display_errors', 1); ## to debug your maintenance view

            require_once 'maintenance.php'; ## call view
            return;
            exit();
        }
    }
}

function last_query($die = '') {
    $CI = &get_instance();
    echo $CI->db->last_query();
    if ($die == 1) {
        die;
    }
}

function getRecords($fields = array(), $table = '', $where = array(), $order_by = '', $limit = '', $joinTable = '', $print = '', $groupBy = '') {
    // CALL METHOD
    //getRecords(array('id','ps_name_urd'),'division_list',array('id'=>1),array('id'=>desc),1,1);
    $CI = &get_instance();
    if (is_array($fields)) {
        $fields = implode(",", $fields);
    }

    $CI->db->select($fields);

    if (is_array($joinTable) && !empty($joinTable)) {
        foreach ($joinTable as $tableName => $condtions) {
            $CI->db->join($tableName, $condtions, 'left'); //array('Soundtrack'=> 'Soundtrack.album_id = Album.album_id' )
        }
    }

    if (is_array($where) && !empty($where)) {
        foreach ($where as $key => $res) {
            $escape = (is_numeric($res)) ? FALSE : TRUE;
            $CI->db->where($key, $res, $escape);
        }
    }
    if (!empty($groupBy)) {
        $CI->db->group_by($groupBy);
    }
    if (!empty($limit)) {
        $CI->db->limit($limit);
    }
    if (is_array($order_by) && !empty($order_by)) {

        foreach ($order_by as $key => $res) {
            $CI->db->order_by($key, $res);
        }
    }


    if ($print == '1') {
        echo $CI->db->last_query();
        die;
    }

    $query = $CI->db->get($table);
    $data = array();
    if ($query !== FALSE && $query->num_rows() > 0) {
        $data = $query->result();
    }

    return $data;
}

function getRecordsIn($fields = array(), $table = '', $where = array(), $order_by = '', $limit = '', $joinTable = '', $print = '') {
    // CALL METHOD
    //getRecords(array('id','ps_name_urd'),'division_list',array('id'=>1),array('id'=>desc),1,1);
    $CI = &get_instance();
    if (is_array($fields)) {
        $fields = implode(",", $fields);
    }

    $CI->db->select($fields);

    if (is_array($joinTable) && !empty($joinTable)) {
        foreach ($joinTable as $tableName => $condtions) {
            $CI->db->join($tableName, $condtions, 'left'); //array('Soundtrack'=> 'Soundtrack.album_id = Album.album_id' )
        }
    }

    if (is_array($where) && !empty($where)) {
        foreach ($where as $key => $res) {
            $result_array = array();
            $strings_array = is_array($res) ? $res : explode(',', $res);

            foreach ($strings_array as $each_number) {
                $result_array[] = (int) $each_number;
            }


            $CI->db->protect_identifiers = FALSE;
            $CI->db->where_in($key, $result_array);
        }
    }
    if (!empty($limit)) {
        $CI->db->limit($limit);
    }
    if (!empty($order_by) && is_array($order_by)) {

        foreach ($order_by as $key => $res) {
            $CI->db->order_by($key, $res);
        }
    }
    if ($print == '1') {
        echo $CI->db->last_query();
        die;
    }
    $query = $CI->db->get($table);
    // $CI->db->last_query();
    $data = array();
    if ($query !== FALSE && $query->num_rows() > 0) {
        $data = $query->result();
    }

    return $data;
}

function getRecordsInner($fields = array(), $table = '', $where = array(), $order_by = '', $limit = '', $joinTable = '', $print = '') {
    // CALL METHOD
    //getRecords(array('id','ps_name_urd'),'division_list',array('id'=>1),array('id'=>desc),1,1);
    $CI = &get_instance();
    if (is_array($fields)) {
        $fields = implode(",", $fields);
    }

    $CI->db->select($fields);

    if (is_array($joinTable) && !empty($joinTable)) {
        foreach ($joinTable as $tableName => $condtions) {
            $CI->db->join($tableName, $condtions, 'inner'); //array('Soundtrack'=> 'Soundtrack.album_id = Album.album_id' )
        }
    }

    if (is_array($where) && !empty($where)) {
        foreach ($where as $key => $res) {
            $result_array = array();
            $strings_array = is_array($res) ? $res : explode(',', $res);

            foreach ($strings_array as $each_number) {
                $result_array[] = (int) $each_number;
            }


            $CI->db->protect_identifiers = FALSE;
            $CI->db->where_in($key, $result_array);
        }
    }
    if (!empty($limit)) {
        $CI->db->limit($limit);
    }
    if (!empty($order_by) && is_array($order_by)) {

        foreach ($order_by as $key => $res) {
            $CI->db->order_by($key, $res);
        }
    }

    $query = $CI->db->get($table);
    // $CI->db->last_query();
    $data = array();
    if ($query !== FALSE && $query->num_rows() > 0) {
        $data = $query->result();
    }

    return $data;
}

function check_comment_like($doctor_id,$ura_opinion_id) {
    $ci = & get_instance();
    $dataArray['recipient_id'] = $doctor_id;
    $dataArray['ura_opinion_id'] = $ura_opinion_id;
    $recordExist = $ci->db->select("*")->where($dataArray)->get("opinion_comment_likes")->row();
    if(empty($recordExist)){
        return false;
    } else {
        return true;
    }
}

function debug($data, $die = 0) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    if ($die == 1) {
        die;
    }
}

if (!function_exists('ec_limit_characters')) {

    function ec_limit_characters($string, $count) {
        $pieces = str_split($string);
        $string = "";
        if (count($pieces) > $count) {
            for ($i = 0; $i < $count; $i++)
                $string = $string . "" . $pieces[$i];
            $string = trim($string);
            $string = $string . "...";
        } else {
            for ($i = 0; $i < count($pieces); $i++)
                $string = $string . "" . $pieces[$i];
            $string = trim($string);
        }
        return $string;
    }

}

if (!function_exists('ec_limit_words')) {

    function ec_limit_words($string, $count) {
        $pieces = explode(" ", $string);
        $string = "";

        for ($i = 0; $i < $count; $i++)
            $string = $string . " " . $pieces[$i];

        $string = trim($string);
        if (count($pieces) > $count)
            $string = $string . "...";

        return $string;
    }

}

if (!function_exists('ec_random_string')) {

    function ec_random_string($length = 10, $stringType = "uln") {
        $characters = "";
        if ($stringType == "n")
            $characters = "0123456789";
        else if ($stringType == "un")
            $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        else if ($stringType == "ln")
            $characters = "0123456789abcdefghijklmnopqrstuvwxyz";
        else if ($stringType == "uln")
            $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        else if ($stringType == "ul")
            $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

}

if (!function_exists('ec_human_timing')) {

    function ec_human_timing($time) {
        $time = time() - $time; // to get the time since that moment

        $tokens = array(
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) {
                continue;
            }
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
        }
    }

}



if (!function_exists('ec_random_color')) {

    function ec_random_color() {
        return "#" . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) .
                str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) .
                str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }

}

// Custom Log Function
function custom_log($object, $label = '') {
    log_message('error', $_SERVER['REQUEST_URI'] . " | " . $_SERVER['REQUEST_METHOD'] . "\n" . $label . ':  ' . print_r($object, true));
}

if (!function_exists('ec_calculate_age')) {

    function ec_calculate_age($birthDate) {
        $from = new DateTime($birthDate);
        $to = new DateTime('today');

        return $from->diff($to)->y;
    }

}

function crypto_rand_secure($min, $max) {
    $range = $max - $min;
    if ($range < 1)
        return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}

function getToken($length) {
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet .= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i = 0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max - 1)];
    }

    return $token;
}

if (!function_exists('get_ds_status')) {



    function get_ds_status($record_id) {
        $ci = &get_instance();
        $ci->db->select('count(*) as total');
        $ci->db->from('tbl_dataset_record');
        $ci->db->where('record_id', $record_id);
        $res = $ci->db->get();
        return $res->row()->total;
    }

}

if (!function_exists('get_breast_cancer_dataset_record')) {



    function get_breast_cancer_dataset_record($record_id, $specimen_type) {
        $ci = &get_instance();
        $ci->db->select('*');
        $ci->db->from('tbl_dataset_record');
        $ci->db->where('record_id', $record_id);
        if ($specimen_type != '') {
            $ci->db->where('patient_specimen', $specimen_type);
        }
        $ci->db->where('dataset_type', 'Breast');
        $res = $ci->db->get();
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return array();
        }
    }

}

if (!function_exists('get_bcc_dataset_record')) {



    function get_bcc_dataset_record($record_id, $specimen_type) {
        $ci = &get_instance();
        $ci->db->select('*');
        $ci->db->from('tbl_dataset_record');
        $ci->db->where('record_id', $record_id);
        if ($specimen_type != '') {
            $ci->db->where('patient_specimen', $specimen_type);
        }
        $ci->db->where('dataset_type', 'Basal Cell');
        $res = $ci->db->get();
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return array();
        }
    }

}

if (!function_exists('get_cmm_dataset_record')) {



    function get_cmm_dataset_record($record_id, $specimen_type) {
        $ci = &get_instance();
        $ci->db->select('*');
        $ci->db->from('tbl_dataset_record');
        $ci->db->where('record_id', $record_id);
        if ($specimen_type != '') {
            $ci->db->where('patient_specimen', $specimen_type);
        }
        $ci->db->where('dataset_type', 'Cutaneous Malignant Melanoma');
        $res = $ci->db->get();
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return array();
        }
    }

}

if (!function_exists('get_ssc_dataset_record')) {



    function get_ssc_dataset_record($record_id, $specimen_type) {
        $ci = &get_instance();
        $ci->db->select('*');
        $ci->db->from('tbl_dataset_record');
        $ci->db->where('record_id', $record_id);
        if ($specimen_type != '') {
            $ci->db->where('patient_specimen', $specimen_type);
        }
        $ci->db->where('dataset_type', 'Squamous Cell');
        $res = $ci->db->get();
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return array();
        }
    }

}

if (!function_exists('get_bcc_dataset_specimen')) {



    function get_bcc_dataset_specimen($record_id) {
        $ci = &get_instance();
        $ci->db->select('group_concat(tbl_dataset_record.patient_specimen) as ps');
        $ci->db->from('tbl_dataset_record');
        $ci->db->where('record_id', $record_id);
        $ci->db->where('dataset_type', 'Basal Cell');
        $res = $ci->db->get();
        if ($res->num_rows() > 0) {
            return $res->row()->ps;
        } else {
            return array();
        }
    }

}

if (!function_exists('get_cmm_dataset_specimen')) {



    function get_cmm_dataset_specimen($record_id) {
        $ci = &get_instance();
        $ci->db->select('group_concat(tbl_dataset_record.patient_specimen) as ps');
        $ci->db->from('tbl_dataset_record');
        $ci->db->where('record_id', $record_id);
        $ci->db->where('dataset_type', 'Cutaneous Malignant Melanoma');
        $res = $ci->db->get();
        if ($res->num_rows() > 0) {
            return $res->row()->ps;
        } else {
            return array();
        }
    }

}

if (!function_exists('get_ssc_dataset_specimen')) {



    function get_ssc_dataset_specimen($record_id) {
        $ci = &get_instance();
        $ci->db->select('group_concat(tbl_dataset_record.patient_specimen) as ps');
        $ci->db->from('tbl_dataset_record');
        $ci->db->where('record_id', $record_id);
        $ci->db->where('dataset_type', 'Squamous Cell');
        $res = $ci->db->get();
        if ($res->num_rows() > 0) {
            return $res->row()->ps;
        } else {
            return array();
        }
    }

}

if (!function_exists('get_breast_cancer_dataset_specimen')) {



    function get_breast_cancer_dataset_specimen($record_id) {
        $ci = &get_instance();
        $ci->db->select('group_concat(tbl_dataset_record.patient_specimen) as ps');
        $ci->db->from('tbl_dataset_record');
        $ci->db->where('record_id', $record_id);
        $ci->db->where('dataset_type', 'Breast');
        $res = $ci->db->get();
        if ($res->num_rows() > 0) {
            return $res->row()->ps;
        } else {
            return array();
        }
    }

}

if (!function_exists('check_dataset_record')) {



    function check_dataset_record($record_id, $specimen_type) {
        $ci = &get_instance();
        $ci->db->select('dataset_type');
        $ci->db->from('tbl_dataset_record');
        $ci->db->where('record_id', $record_id);
        if ($specimen_type != '') {
            $ci->db->where('patient_specimen', $specimen_type);
        }
        $res = $ci->db->get();
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return array();
        }
    }

}


if (!function_exists('_print_r')) {



    function _print_r($array) {

        echo "<pre>";

        print_r($array);

        echo "</pre>";
    }

}

if (!function_exists('get_related_hospital')) {

    function get_related_hospital($user_id, $group_id, $group_type, $type_cate) {
        $ci = &get_instance();
        if ($group_type === 'H') {
            return $ci->db
                            ->select('groups.description, groups.first_initial, groups.last_initial, groups.id as group_id')
                            ->join('users_groups', 'users_groups.group_id = groups.id')
                            ->where('user_id', $user_id)
                            ->get('groups')->result_array();
        }
        if ($type_cate === 'usergroup') {
            return $ci->db
                            ->select('groups.description, groups.first_initial, groups.last_initial, groups.id as group_id')
                            ->join('hospital_group', 'hospital_group.hospital_id = groups.id')
                            ->where('hospital_group.group_id', $group_id)
                            ->get('groups')->result_array();
        } else if ($type_cate === 'category') {
            $temp = $ci->db
                            ->select('groups.description, groups.first_initial, groups.last_initial, groups.id as group_id')
                            ->join('groups', 'groups.id = users_groups.institute_id')
                            ->where('users_groups.institute_id !=', '0')
                            ->where('users_groups.user_id', $user_id)
                            ->get('users_groups')->result_array();
            return $temp;
        }
    }

}



if (!function_exists('get_usergroup_tyep_cate')) {

    function get_usergroup_tyep_cate($user_id) {
        $ci = &get_instance();

        return $ci->db
                            ->select('users.id as user_id, users.user_type, groups.id as groupid, groups.group_type,groups.type_cate')
                            ->join('users_groups', 'users_groups.user_id = users.id')
                            ->join('groups', 'users_groups.institute_id = groups.id')
                            ->where('users.id', $user_id)
                            ->get('users')->row_array();
       
    }

}

if (!function_exists('get_user_related_lab_hospital')) {

    function get_user_related_lab_hospital($user_id, $group_id, $group_type, $type_cate) {
        $ci = &get_instance();


        if ($group_type === 'H') {
            return $ci->db
                            ->select('*')
                            ->join('users_groups', 'users_groups.group_id = groups.id')
                            ->where('user_id', $user_id)
                            ->get('groups')->result_array();
        }
        if ($type_cate === 'usergroup') {
            return $ci->db
                            ->select('*')
                            ->join('hospital_group', 'hospital_group.hospital_id = groups.id')
                            ->where('hospital_group.group_id', $group_id)
                            ->get('groups')->result_array();
        } else if ($type_cate === 'category') {
            $temp = $ci->db
                            ->select('*')
                            ->join('groups', 'groups.id = users_groups.institute_id')
                            ->where('users_groups.institute_id !=', '0')
                            ->where('users_groups.user_id', $user_id)
                            ->get('users_groups')->result_array();
            return $temp;
        }
    }

}

function iamdev(){
    //if(NETWORK_PROBLEM){ return true; }
    return in_array($_SERVER['REMOTE_ADDR'], DEV_IP_LIST);
}
function pre($array,$die = true){
    if(iamdev()){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
        if($die)
            die;
    }
}

function serial_number($table_name, $field, $prefix='', $condition=[]){
    $ci = &get_instance();
    $ci->db->from($table_name);
    if(count($condition) > 0){
        $ci->db->where($condition);
    }
    $resData = $ci->db->order_by($field, "DESC")->limit(1)->get()->row()->$field;
    if($resData){
        $res = $prefix . "-00000" .($resData + 1);
    }else{
        $res = $prefix . "-000001";
    }
    return $res;
}