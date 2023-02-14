<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @file Global Helper Functions
 *
 */


/*
	Comments: 16 Aug, 2018 by Adeel Yaqoob
	function to set user group privileges in session at the time of successful login
*/
if (!function_exists('set_user_privileges'))
{
    function set_user_privileges(){

        $CI =& get_instance();
        $CI->load->library('session');
        $session_data = $CI->session->userdata('admin_info');

        // Get a reference to the controller object
        $obj_Controller = get_instance();

        // load the model if it hasn't been pre-loaded
        $obj_Controller->load->model('Admin_model');

        $user_group = $obj_Controller->Admin_model->get_user_group($session_data['admin_id']);
        $user_group_data = array($user_group['ugrp_id']=>$user_group['ugrp_name']);
        $session_data['group'] = $user_group_data;

        $user_privileges = $obj_Controller->Admin_model->get_user_group_privileges($session_data['admin_group_fk']);
        $session_data['privileges'] = $user_privileges;
//        echo '<pre>'; print_r($session_data); exit;
        $CI->session->set_userdata('admin_info',$session_data);
//        echo '<pre>'; print_r($user_group); exit;
        return true;
    }
}

/*
	Comments: 16 Aug, 2018 by Adeel Yaqoob
	function to check if this privilege is assigned to the logged in user
*/
if (!function_exists('user_is_privileged'))
{
    function user_is_privileged($privilege){
        $check = FALSE;
        $CI =& get_instance();
        $CI->load->library('session');
        $session_data = $CI->session->userdata('admin_info');
        $session_privileges = $session_data['privileges'];
        foreach($session_privileges as $key=>$value){
            if($privilege==$value){
                $check = TRUE;
            }
        }
        return $check;
    }

}

/*
	Comments: 08 Aug, 2020 by Adeel Yaqoob
	function to shorten long numbers
*/
if (!function_exists('number_format_short'))
{
    function number_format_short( $n, $precision = 1 ) {
        if ($n < 900) {
            // 0 - 900
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else if ($n < 900000) {
            // 0.9k-850k
            $n_format = number_format($n / 1000, $precision);
            $suffix = 'K';
        } else if ($n < 900000000) {
            // 0.9m-850m
            $n_format = number_format($n / 1000000, $precision);
            $suffix = 'M';
        } else if ($n < 900000000000) {
            // 0.9b-850b
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = 'T';
        }

        // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
        // Intentionally does not affect partials, eg "1.50" -> "1.50"
        if ( $precision > 0 ) {
            $dotzero = '.' . str_repeat( '0', $precision );
            $n_format = str_replace( $dotzero, '', $n_format );
        }

        return $n_format . $suffix;
    }

}

/*
	Comments: 16 Aug, 2018 by Adeel Yaqoob
	controller function to get IPaddress
*/
if (!function_exists('getVisitorIP')) {
    function getVisitorIP()
    {
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        return $ip;
    }
}

/*
    Comments: 17 Aug, 2018 by Adeel Yaqoob
    function to create dynamic treeview for group privileges
*/
if(!function_exists('createPrivilegeTree')){

    function createPrivilegeTree($parent, $privileges)
    {
        $html = "";
        if (isset($privileges['parents'][$parent])) {
            $html .="";
            foreach ($privileges['parents'][$parent] as $itemId) {
                $privilege_id   = $privileges['items'][$itemId]['upriv_id'];
                $privilege_name = $privileges['items'][$itemId]['upriv_name'];

                if (isset($privileges['parents'][$itemId])) {
                    $html .= "

                <ol class='dd-list'>
                <li class='dd-item'>
                <div class='dd2-content'> ".$privilege_name."</div>
                ";
                    $html .= createPrivilegeTree($itemId, $privileges);
                    $html .= "
                </li> </ol>";
                }
                if (!isset($privileges['parents'][$itemId])) {
                    $html .= "
                <ol class='dd-list'>
                <li class='dd-item'>
                <div class='dd2-content'> ".$privilege_name."</div>
                </li> </ol> ";
                }
            }
        }
        return $html;

    }
}

/*
    Comments: 18 Aug, 2018 by Adeel Yaqoob
    function to create dynamic treeview for group privileges
*/
if(!function_exists('createGroupPrivilegeTree')){

    function createGroupPrivilegeTree($parent, $privileges,$group_privileges)
    {
        if(empty($group_privileges)){
            $group_privileges = array();
        }
        $html = "";
        if (isset($privileges['parents'][$parent])) {
            $html .="";
            foreach ($privileges['parents'][$parent] as $itemId) {
                $privilege_id   = $privileges['items'][$itemId]['upriv_id'];
                $privilege_name = $privileges['items'][$itemId]['upriv_name'];

                if (isset($privileges['parents'][$itemId])) {
                    $current_status = (in_array($privilege_id, $group_privileges)) ? 1 : 0;
                    $new_status = (in_array($privilege_id, $group_privileges)) ? 'checked="checked"' : NULL;
                    $html .= "

                <ol class='dd-list'>
                <li class='dd-item'>
                <input type='hidden' name='update[".$privilege_id."][id]' value='".$privilege_id."'/>
                <input type='hidden' name='update[".$privilege_id."][current_status]' value='".$current_status."'/>
                <input type='hidden' name='update[".$privilege_id."][new_status]' value='0'/>
                <div class='dd2-content'> ".$privilege_name."</div>
                <input type='checkbox' class='privilege_checkbox' name='update[".$privilege_id."][new_status]' value='1' ".$new_status."/>";
                    $html .= createGroupPrivilegeTree($itemId, $privileges,$group_privileges);
                    $html .= "
                </li> </ol>";
                }
                if (!isset($privileges['parents'][$itemId])) {
                    $current_status = (in_array($privilege_id, $group_privileges)) ? 1 : 0;
                    $new_status = (in_array($privilege_id, $group_privileges)) ? 'checked="checked"' : NULL;
                    $html .= "
                <ol class='dd-list'>
                <li class='dd-item'>
                <input type='hidden' name='update[".$privilege_id."][id]' value='".$privilege_id."'/>
                <input type='hidden' name='update[".$privilege_id."][current_status]' value='".$current_status."'/>
                <input type='hidden' name='update[".$privilege_id."][new_status]' value='0'/>
                <div class='dd2-content'> ".$privilege_name."</div>
                <input type='checkbox' class='privilege_checkbox' name='update[".$privilege_id."][new_status]' value='1' ".$new_status." />
                </li> </ol> ";
                }
            }
        }
        return $html;

    }

}

/*
	Comments: 05 Oct, 2018 by Adeel Yaqoob
	function to get unique and random token for product
*/
if (!function_exists('getToken'))
{
    function getToken($length,$token="")
    {
        //$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        //$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet	= "1234567890";
        $max = strlen($codeAlphabet); // edited

        //for ($i=0; $i < $length; $i++)
        //{
        $token .= $codeAlphabet[crypto_rand_secure($min=0, $max)];
        //}
        if(strlen(trim($token)) < $length)
        {
            return getToken($length,$token);
        }
        else
        {
            return $token;
        }
    }

    if (!function_exists('downloadFile'))
    {
        function downloadFile($filePath,$fileName)
        {
            if(!empty($fileName))
            {

                $download_file =  $filePath;
                // Check file is exists on given path.
                if(file_exists($download_file))
                {
                    // Getting file extension.
                    $extension = explode('.',$fileName);
                    $extension = $extension[count($extension)-1];
                    // For Gecko browsers
                    header('Content-Transfer-Encoding: binary');
                    header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($filePath)) . ' GMT');
                    // Supports for download resume
                    header('Accept-Ranges: bytes');
                    // Calculate File size
                    header('Content-Length: ' . filesize($download_file));
                    header('Content-Encoding: none');
                    // Change the mime type if the file is not PDF
                    header('Content-Type: application/'.$extension);
                    // Make the browser display the Save As dialog
                    header('Content-Disposition: attachment; filename=' . $fileName);
                    readfile($download_file);
                    //exit;
                }
                else
                {
                    echo 'File does not exists on given path';
                }

            }
        }
    }
}

/*
    Comments: 23 Aug, 2021 by Adeel Yaqoob
    function to get record laboratory prefixes for specimens and block and
    also check for existing blocks to continue from there
*/
if(!function_exists('getRecordLaboratoryPrefixes')){

    function getRecordLaboratoryPrefixes($record_id, $lab_id)
    {
        $CI =& get_instance();
        // Get a reference to the controller object
        $obj_Controller = get_instance();
        // load the model if it hasn't been pre-loaded
        $obj_Controller->load->model('Laboratory_model');

        $start_Alpha = 'A';
        $start_Numeric = 1;
        $lab_info = $obj_Controller->Laboratory_model->get_lab_information($lab_id);
        $specimen_prefix = ($lab_info['lab_specimen_prefix']==ALPHABETICAL?$start_Alpha:$start_Numeric);
        $specimen_block_prefix = ($lab_info['lab_specimen_block_prefix']==ALPHABETICAL?$start_Alpha:$start_Numeric);
        $record_specimen_blocks = $obj_Controller->Laboratory_model->get_record_blocks($record_id);
//        echo '<pre>'; print_r($record_specimen_blocks); exit;
        $response = array();
        $final_array = array();
        $response['error'] = "";
        if($lab_info){
            if(!empty($record_specimen_blocks)){
                foreach($record_specimen_blocks as $key=>$value){
                    $specimen_id = $value['specimen_id'];
                    $request_id = $value['request_id'];
                    $specmn_prefix = $specimen_prefix++;
                    if(!empty($value['blocks'])){
                        $specmn_blck_prefix = $specimen_block_prefix;
                        foreach ($value['blocks'] as $k=>$v){
                            $specmn_blck_prefix = ++$specmn_blck_prefix;
                            $record_specimen_blcks = $specmn_blck_prefix;
                        }
                    }else{
                        $record_specimen_blcks = $specimen_block_prefix;
                    }
                    $final_array[$value['specimen_id']]['specimen_id'] = $specimen_id;
                    $final_array[$value['specimen_id']]['request_id'] = $request_id;
                    $final_array[$value['specimen_id']]['specimen_prefix'] = $specmn_prefix;
                    $final_array[$value['specimen_id']]['specimen_block_prefix'] = $record_specimen_blcks;
                }
                $response = $final_array;
            }else{
                $final_array[0] = array(
                    'specimen_id'=>0,
                    'request_id'=>0,
                    'specimen_prefix'=>$specimen_prefix,
                    'specimen_block_prefix'=>$specimen_block_prefix,
                );
                $response = $final_array;
            }
        }else{
            $response['error'] = "Please set the Lab Prefixes first from Laboratory Dashboard";
        }
//        echo '<pre>'; print_r($response); exit;
        return $response;
    }
}

/*
    Comments: 08 Sep, 2021 by Adeel Yaqoob
    function to get group name by its id
*/
if(!function_exists('getGroupNameById')){

    function getGroupNameById($group_id)
    {
        $CI =& get_instance();
        // Get a reference to the controller object
        $obj_Controller = get_instance();
        // load the model if it hasn't been pre-loaded
        $obj_Controller->load->model('Doctor_model');

        $group_info = $obj_Controller->Doctor_model->getGroupNameById($group_id);
        $group_name = "";
        if(!empty($group_info)){
            $group_name = $group_info['description'];
        }
        return $group_name;
    }
}

if(!function_exists('searchRecordDetailSuggestion')){

    function searchRecordDetailSuggestion($searchKey='')
    {
        $CI =& get_instance();
        $ci = & get_instance();
        $ci->load->database();

        $doctor_id = $CI->ion_auth->user()->row()->id;

        if (!empty($searchKey)) {
            $searchKey = $_REQUEST['query'];
            $sql = "SELECT DISTINCT *, CONCAT_WS(groups.first_initial, ' ', groups.last_initial) as short_lab FROM request 
                    INNER JOIN request_assignee 
                    LEFT JOIN groups ON groups.id=request.hospital_group_id 
                    WHERE request.uralensis_request_id = request_assignee.request_id AND 
                          request_assignee.user_id = $doctor_id AND 
                          request.serial_number LIKE '%{$searchKey}%' AND 
                          request.specimen_publish_status = 0 AND 
                          request.supplementary_review_status = 'false' OR 
                          request.ura_barcode_no LIKE '%{$searchKey}%' OR 
                          request.patient_initial LIKE '%{$searchKey}%' OR 
                          request.pci_number LIKE '%{$searchKey}%' OR 
                          request.emis_number LIKE '%{$searchKey}%' OR 
                          request.nhs_number LIKE '%{$searchKey}%' OR 
                          request.lab_number LIKE '%{$searchKey}%' OR 
                          request.hos_number LIKE '%{$searchKey}%' OR 
                          request.sur_name LIKE '%{$searchKey}%' OR 
                          request.f_name LIKE '%{$searchKey}%' OR 
                          request.dob LIKE '%{$searchKey}%' OR 
                          request.gender LIKE '%{$searchKey}%' OR 
                          request.report_urgency LIKE '%{$searchKey}%' 
                    GROUP BY request.uralensis_request_id 
                    ORDER BY request.uralensis_request_id";
            $query = $CI->db->query($sql);
            $array = array();
            foreach ($query->result() as $row) {
                $array[$row->uralensis_request_id]['record_id'] = $row->uralensis_request_id;
                $array[$row->uralensis_request_id]['serial_number'] = $row->serial_number;
                $array[$row->uralensis_request_id]['f_name'] = $row->f_name;
                $array[$row->uralensis_request_id]['sur_name'] = $row->sur_name;
                $array[$row->uralensis_request_id]['lab'] = $row->short_lab;
            }
            return json_encode($array); //Return the JSON Array
        }
    }
}