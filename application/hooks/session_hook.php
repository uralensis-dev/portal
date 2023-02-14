<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Check whether the site is offline or not.
 *
 */
class Session_hook
{
    public function logout_check(){
        $ci =& get_instance();
        $ci->load->library("session");

        if(!empty($ci->session->userdata['activity_detail'])){
            $userSession = $ci->session->userdata['activity_detail'];
            $whereArray['random_id'] = $userSession['random_id'];

            $updateData['logout_time'] = time();

            $ci->db->where($whereArray);
            $ci->db->update('userlogin_activity',$updateData);

            $ci->db->reset_query();
            $ci->db->where($whereArray);
            $ci->db->update('userlogin_log',$updateData);
        }
    }

    public function track_user_activity()
    {

        $ci = &get_instance();
        $ci->load->database();
        $ci->load->library('user_agent');
        $ci->load->library('session');
        $ci->load->helper("activity_helper");
        if(!empty($ci->session->userdata['activity_detail'])){
            $activity_data['userlogin_log_id'] = $ci->session->userdata['activity_detail']['log_id'];
            $activity_data['track_session_userid'] = !empty($ci->session->userdata['user_id']) ? $ci->session->userdata['user_id'] : '';
            $activity_data['request_uri'] = str_replace("//", "/", $ci->input->server('REQUEST_URI'));
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
            $activity_data['referer_page'] = $data = str_replace("//", "/", $ci->agent->referrer());
            $activity_data['user_activity_ip'] = getRealIpAddr();
            $activity_data['user_activity_login_time'] = $ci->session->userdata['activity_detail']['login_time'];
            $activity_data['u_track_session_id'] = session_id();
            if (!$ci->ion_auth->logged_in()) {
                redirect('auth/login', 'refresh');
            } else {
                $ci->db->insert('usertracking_activity', $activity_data);
            }
        }
    }
}