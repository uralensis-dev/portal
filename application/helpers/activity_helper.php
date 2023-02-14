<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @helper function
 * Check if Function Exists
 *
 * @param string
 * @return Boolean
 *
 */
if (!function_exists('track_user_activity')) {

    function track_user_activity()
    {

        $ci = &get_instance();
        $ci->load->database();
        $ci->load->library('user_agent');
        $ci->load->library('session');
        $input_data = array();
        $input_data['session_identity'] = !empty($ci->session->userdata['identity']) ? $ci->session->userdata['identity'] : '';
        $input_data['session_username'] = !empty($ci->session->userdata['username']) ? $ci->session->userdata['username'] : '';
        $input_data['session_userid'] = !empty($ci->session->userdata['user_id']) ? $ci->session->userdata['user_id'] : '';
        $activity_data['track_session_userid'] = !empty($ci->session->userdata['user_id']) ? $ci->session->userdata['user_id'] : '';
        $activity_data['request_uri'] = $ci->input->server('REQUEST_URI');
        $input_data['login_time'] = time();
        $input_data['client_ip'] = getRealIpAddr();
        if ($ci->agent->is_browser()) {
            $agent = $ci->agent->browser() . ' ' . $ci->agent->version();
        } elseif ($ci->agent->is_robot()) {
            $agent = $ci->agent->robot();
        } elseif ($ci->agent->is_mobile()) {
            $agent = $ci->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }
        $activity_data['client_user_agent'] = $agent;
        $activity_data['user_agent_platform'] = $ci->agent->platform();
        $activity_data['referer_page'] = $ci->agent->referrer();
        $activity_data['user_activity_ip'] = getRealIpAddr();
        $activity_data['user_activity_login_time'] = time();
        $activity_data['u_track_session_id'] = session_id();
        if (!empty($ci->session->userdata['user_id'])) {
            $user_id = $ci->session->userdata['user_id'];
            $check_record = array();
            $check_query = $ci->db->query("SELECT * FROM usertracking WHERE usertracking.session_userid = $user_id");
            $check_record = $check_query->result();
        }
        if (!$ci->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } else {
//            $ci->db->insert('usertracking_activity', $activity_data);
            if (count($check_record) > 0) {
                $login_time = time();
                $ci->db->query("UPDATE usertracking SET usertracking.login_time = $login_time WHERE usertracking.session_userid = $user_id");
            } else {
                $ci->db->insert('usertracking', $input_data);
            }
        }
    }
}

if (!function_exists('getRealIpAddr')) {
    /**
     * Get Remote IP Address
     *
     * @return void
     */
    function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
}

if (!function_exists('user_login_activity')) {

    function user_login_activity()
    {

//        echo "<pre>";print_r($_SESSION);exit;
        $ci = &get_instance();
        $ci->load->database();
        $ci->load->library('user_agent');
        $ci->load->library('session');
        $input_data = array();
        $getIPAddress = getRealIpAddr();
        $input_data['session_identity'] = !empty($ci->session->userdata['identity']) ? $ci->session->userdata['identity'] : '';
        $input_data['session_username'] = !empty($ci->session->userdata['username']) ? $ci->session->userdata['username'] : '';
        $input_data['session_userid'] = !empty($ci->session->userdata['user_id']) ? $ci->session->userdata['user_id'] : '';
        $input_data['login_time'] = time();
        $input_data['client_ip'] = $getIPAddress;
        if ($ci->agent->is_browser()) {
            $agent = $ci->agent->browser();
        } elseif ($ci->agent->is_robot()) {
            $agent = $ci->agent->robot();
        } elseif ($ci->agent->is_mobile()) {
            $agent = $ci->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }
        $input_data['client_user_agent'] = $agent;
        $input_data['user_agent_platform'] = $ci->agent->platform();
        $input_data['random_id'] = $input_data['login_time'].$input_data['session_userid'].rand(1,100);
        $input_data['is_active'] = 1;
        if (!empty($ci->session->userdata['identity'])) {
            $user_id = $ci->session->userdata['identity'];

            $whereArray['session_identity'] = $user_id;
            $whereArray['client_ip'] = $getIPAddress;
//            $whereArray['remember'] = 1;
            $check_record = array();
            $check_query = $ci->db->select("*")->where($whereArray)->get("userlogin_activity");
            $check_record = $check_query->row();
//
//            $query = "SELECT AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
//                    AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name from users where AES_DECRYPT(email, '" . DATA_KEY . "') = '$user_id'";
//            $user_query = $ci->db->query($query);
//            $user_data = $user_query->row();

//            unset($whereArray['remember']);
            $ci->db->reset_query();
            $ci->db->insert('userlogin_log', $input_data);
            $last_id = $ci->db->insert_id();
            //SET Session
            $_SESSION['activity_detail'] = $input_data;
            $_SESSION['activity_detail']['log_id'] = $last_id;
            if (!empty($check_record)) {

                if($check_record->remember==1){
                    $login_time = time();
                    $updateData['login_time'] = $login_time;
                    $updateData['client_user_agent'] = $agent;
                    $updateData['user_agent_platform'] = $ci->agent->platform();
                    $updateData['random_id'] = $input_data['random_id'];
                    $updateData['is_active'] = 1;
//                $ci->db->update("userlogin_activity", $updateData)->where(array("session_identity" => $user_id, "client_ip" => getRealIpAddr()));

                    $ci->db->where($whereArray);
                    $ci->db->update('userlogin_activity',$updateData);
                } else {
                    $ci->db->where($whereArray);
                    $ci->db->update('userlogin_activity',$input_data);
                }
            } else {

                $ci->db->reset_query();
                $ci->db->insert('userlogin_activity', $input_data);

                //Save IP Location
                $ci->db->reset_query();
                $ci->db->where('ip_address',$getIPAddress);
                $q = $ci->db->get('ip_location');

                if ( $q->num_rows() == 0 )
                {
                    //$getIPLocation = json_decode(get_ip_location($getIPAddress),true);
                    if(!empty($getIPLocation)){
                        $insIP['ip_address'] = $getIPLocation['ip'];
                        $insIP['country_code'] = $getIPLocation['country_code'];
                        $insIP['country_name'] = $getIPLocation['country_name'];
                        $insIP['region_code'] = $getIPLocation['region_code'];
                        $insIP['region_name'] = $getIPLocation['region_name'];
                        $insIP['city'] = $getIPLocation['city'];
                        $insIP['zip_code'] = $getIPLocation['zip_code'];
                        $insIP['time_zone'] = $getIPLocation['time_zone'];
                        $insIP['raw_data'] = json_encode($getIPLocation);
                        $ci->db->insert('ip_location',$insIP);
                    }
                }
                //End Save IP Location

                $dataArray = $input_data;
                $dataArray['first_name'] = $_SESSION['first_name'];
                //$ci->db->insert('usertracking', $input_data);
                $message = $ci->load->view("auth/email/user_activity", $dataArray, TRUE);
                $config = array(
                    'mailtype' => 'html',
                    'charset' => 'utf-8',  //iso-8859-1
                    'newline' => '\r\n',
                    'wordwrap' => TRUE
                );
                $ci->load->library('email', $config);
                // $this->email->set_header('Content-type', 'text/html\r\n');
                $ci->email->set_mailtype("html");
                $ci->email->set_newline("\r\n");
                $ci->email->from('info@uralensiswebapp.co.uk'); // change it to yours
                $ci->email->reply_to('info@uralensiswebapp.co.uk', 'PathHub Support Team');
//                $this->email->cc('dev@oxbridgemedica.com');
                $ci->email->to($user_id); // change it to yours
                $ci->email->subject('PathHub: New Sign In Activity');
                // $mesg = $this->load->view('auth/pinemailtemplate',$dataTemp,true);
                $ci->email->message($message);

                //$this->email->message($mesg);
                $ci->email->send();
            }
        }
    }
}

if (!function_exists('update_logout_activity')) {

    function update_logout_activity()
    {
        $ci = &get_instance();
        $ci->load->database();
        $ci->load->library('user_agent');
        $ci->load->library('session');

        $whereArray['session_userid'] = $_SESSION['activity_detail']['session_userid'];
        $whereArray['client_ip'] = $_SESSION['activity_detail']['client_ip'];
        $whereArray['random_id'] = $_SESSION['activity_detail']['random_id'];

        $updateData['logout_time'] = time();
        $updateData['is_active'] = 0;

        $ci->db->where($whereArray);
        $ci->db->update('userlogin_activity',$updateData);

        $ci->db->reset_query();
        $ci->db->where($whereArray);
        $ci->db->update('userlogin_log',$updateData);

    }
}

if (!function_exists('get_ip_location')) {

    function get_ip_location($ip)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://freegeoip.app/json/'.$ip.'?apikey=82d89e20-5842-11ec-8946-1588f05b6a58',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }
}

/**
 * Record Logout Time
 *
 * @return void
 */
function insert_logout_time()
{
    $ci = &get_instance();
    $ci->load->database();
    $ci->load->library('session');

    $user_id = !empty($ci->session->userdata['user_id']) ? $ci->session->userdata['user_id'] : '';
    $session_id = session_id();
    $logout_time = time();

    if (!empty($user_id)) {
        $ci->db->where('session_userid', $user_id)->update('usertracking', array('logout_time' => $logout_time));
        $ci->db->where('u_track_session_id', $session_id)->update('usertracking_activity', array('user_activity_logout_time' => $logout_time));
        return true;
    } else {
        return false;
    }
}

function get_table_data($table_n,$q_id)
{
    $ci = &get_instance();
    $ci->load->database();
	if($q_id!='')	
	{
		$val_arr=explode("=",$q_id);
	
		if($val_arr[1]!='')
		{
		$sql = "SELECT * FROM $table_n WHERE 1 and $q_id";	
		$query = @$ci->db->query($sql)->result();
		return $query;
		}
		else
		{
		return 0;	
		}
		
	}
	else
	{
		return 0; 
	}
	
}

function get_record_count($table_n,$q_id)
{
    $ci = &get_instance();
    $ci->load->database();
    $count = 0;
	if($q_id!=''){
		$val_arr=explode("=",$q_id);
		if($val_arr[1]!=''){
			$sql = "SELECT count(*) as total FROM $table_n WHERE 1 and $q_id";
			$query = @$ci->db->query($sql)->row();
			if ($query && $query->total) {
                $count = $query->total;
            }
		}
	}
    return $count;
}

function request_viewed($param){
    //ini_set('display_errors', 1);
    $ci = &get_instance();
    $ci->load->database();
    $exist = $ci->db->query('select id from request_viewers where viewer_id = '.$param["user_id"].' and request_id = '.$param['request_id'])->row('id');
    $vw_id = 0;
    if(!$exist){
        $group_id = $ci->db->query('select * from users_groups where group_id is not null and user_id = '.$param["user_id"].' limit 1')->row('group_id');
        
        if($group_id){
            $view_data = array(
                'request_id' => $param['request_id'],
                'viewer_id' => $param['user_id'],
                'viewer_group' => $group_id,
            );
            $ci->db->insert('request_viewers', $view_data);
            $vw_id = $ci->db->insert_id();
        } 
    }    
    return $vw_id;
    
}

if(!function_exists('dateCovertString'))
{
    function dateCovertString($digit)
    {
        if (strlen($digit) == 8)
        {
            $dArr = str_split($digit, 2);
            return implode('-', [$dArr[0] . $dArr[1], $dArr[2], $dArr[3]]);
        }
        elseif (strlen($digit) == 14)
        {
            $dArr = str_split($digit, 2);
            $date = implode('-', [$dArr[0] . $dArr[1], $dArr[2], $dArr[3]]);
            $time = implode(':', [$dArr[4], $dArr[5], $dArr[6]]);
            return implode(' ', [$date, $time]);
        }
        return $digit;
    }
}

if (!function_exists('setValue'))
{
    function setValue($val)
    {
        $res = (!empty($val)) ? $val : NULL;
        return $res;
    }
}

if (!function_exists('ageCalculate'))
{
    function ageCalculate($startDate, $endDate='', $format='%y')
    {
        $exp = (!empty($endDate)) ? $endDate : date('Y-m-d');
        $dob = dateCovertString($startDate);
        $diff = date_diff(date_create($dob), date_create($exp), TRUE);
        $age = $diff->format($format);
        return $age;
    }
}