<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('authy_function')) {

    /**
     * Twilio Authy Library
     * Send Request to Authy
     *
     * @param string $email_id
     * @param string $user_phone
     * @param int $user_id
     * @return void
     */
    function get_authy_data($email_id, $user_phone, $user_id) {
        $json = array();
        require_once('authy/autoload.php');
        $prod = true;
        $apiKey = 'yrmec8UustCNguF85B9WrQQtaBm9Mfvk';
        $apiUrl = ($prod == true) ? 'https://api.authy.com' : 'https://sandbox-api.authy.com';
        $api = new Authy\AuthyApi($apiKey, $apiUrl);
        if (!empty($email_id) && !empty($user_phone)) {
            $userEmail = $email_id;
            $Phone = $user_phone;
//            $userCountryCode = 92;
            $userCountryCode = 44;
            $user = $api->registerUser("$userEmail", "$Phone", $userCountryCode);
            if ($user->ok()) {
                //echo 'Authy ID for user "' . $userEmail . '": ' . $user->id() . "\n";
                $ci = & get_instance();
                $ci->load->database();
                $ci->db->where('id', $user_id);
                $ci->db->update('users', array('authy_id' => $user->id()));
                $api->requestSms($user->id(), array("force" => "true"));
//                $api->phoneCall($user->id(), array("force" => "true"));
                $json['type'] = 'success';
                $json['msg'] = 'Memorable Combination match and Auth Code Sent Successfull.';
            } else {
                foreach ($user->errors() as $field => $error) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Error on ' . $field . ': ' . $error;
                }
            }
            echo json_encode($json);
            die;
        }
    }

    /**
     * Check Token Authentication
     * And Send Access Code
     * 
     * @param int $authy_id
     * @param string $user_access
     * @return void
     */
    function check_access($authy_id, $user_access) {

        require_once('authy/autoload.php');
        $prod = true;
//        $apiKey = 'y39FrklYmQ1e53PdyNMUJBUzRQPyxWdj'; //For Local
//        $apiKey = '0WPAespLh7u0hs9YizwC8Ef7ChBkGKMa';
        $apiKey = 'yrmec8UustCNguF85B9WrQQtaBm9Mfvk';
        $apiUrl = ($prod == true) ? 'https://api.authy.com' : 'https://sandbox-api.authy.com';

        $api = new Authy\AuthyApi($apiKey, $apiUrl);
        $verification = $api->verifyToken($authy_id, $user_access);

        if ($verification->ok()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Resend Access Code
     *
     * @param [type] $authy_id
     * @return void
     */
    function resend_access_code($authy_id) {
        require_once('authy/autoload.php');
        $prod = true;
//        $apiKey = 'y39FrklYmQ1e53PdyNMUJBUzRQPyxWdj'; //For Local
//        $apiKey = '0WPAespLh7u0hs9YizwC8Ef7ChBkGKMa';
        $apiKey = 'yrmec8UustCNguF85B9WrQQtaBm9Mfvk';
        $apiUrl = ($prod == true) ? 'https://api.authy.com' : 'https://sandbox-api.authy.com';
        $api = new Authy\AuthyApi($apiKey, $apiUrl);
        //$api->requestSms($user->id(), array("force" => "true"));
        if ($api->requestSms($authy_id, array("force" => "true"))) {
            return true;
        } else {
            return false;
        }
    }

}
