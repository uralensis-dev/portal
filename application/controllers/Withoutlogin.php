<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Withoutlogin Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */

class Withoutlogin extends CI_Controller
{

    /**
     * Constructor to load models and helpers
     */
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'cookie', 'ec_helper'));
        $this->load->library('encryption');
        $this->load->library('user_agent');
        $this->load->model('Ion_auth_model');
        $this->load->model('Userextramodel');
    }

    /**
     * Check User Login Details
     *
     * @return void
     */
    public function checkUserLoginDetails()
    {
        $json = array();
        if (isset($_POST)) {
            $identity = $this->input->post('user_identity');
            $password = $this->input->post('user_password');

            if (empty($identity)) {
                $json['type'] = 'error';
                $json['msg'] = 'Please enter email address';
                $json['error_class'] = 'error';
                echo json_encode($json);
                die;
            }
            if (empty($password)) {
                $json['type'] = 'error';
                $json['msg'] = 'Please enter your password';
                $json['error_class'] = 'error';
                echo json_encode($json);
                die;
            }
            if (!filter_var($identity, FILTER_VALIDATE_EMAIL)) {
                $this->checkLoginAttempts($identity, $password);

                $json['type'] = 'error';
                $json['msg'] = 'Please enter a valid email';
                echo json_encode($json);
                die;
            }

            //Get User ID Based on Email Address
            $user_id = $this->Userextramodel->getuserId($identity);

            $user_id =  $user_id[0]->id;

            $set_auth_cookie = array(
                'name' => 'user_id',
                'value' => $user_id,
                'expire' => '2678400'
            );
            $this->input->set_cookie($set_auth_cookie);
            $db_data = $this->Userextramodel->getAllUserData($identity);

            if (!empty($db_data)) {

                if (!$this->Ion_auth_model->verify_password($password, $db_data[0]['password'])) {
                    $this->checkLoginAttempts($identity, $password);
                    $attempts_remaining = $this->checkRemainingAttempts($identity);
                    $json['type'] = 'error';
                    $json['msg'] = 'Incorrect Password, ' . $attempts_remaining . ' Attempts remaining';
                    echo json_encode($json);
                    die;
                }
                if ($this->Ion_auth_model->is_max_login_attempts_exceeded($identity)) {
                    //Hash something anyway, just to take up time
                    $this->Ion_auth_model->hash_password($password);
                    $this->Ion_auth_model->trigger_events('post_login_unsuccessful');
                    $this->Ion_auth_model->set_error('login_timeout');
                    $json['type'] = 'error';
                    $json['msg'] = 'Your account is now locked. Contact system admin, operations@pathhub.com'; //strip_tags($this->ion_auth->errors());
                    echo json_encode($json);
                    die;
                }

                //Check IF remember Token
                $checkToken = $this->Userextramodel->checkUserRememberToken($user_id);
                if($checkToken){
                    $this->pushLoginData($identity);
                    $json['login'] = 'success';
                }


                /*
                End of Function 
                */
                $json['type'] = 'success';
                $json['msg'] = 'Credentials Match Successfully';
                echo json_encode($json);
                die;
            } else {
                $this->checkLoginAttempts($identity, $password);
                $json['type'] = 'error';
                $json['msg'] = 'This email did not exists';
                echo json_encode($json);
                die;
            }
        }
    }
    /**
     * 
     * Token Generating sending 
     */


    public function GenerateTokenByEmailId($email_id, $name)
    {

        $token = getToken(5);

        $user_id = !empty($_SESSION['temp_data']['user_id']) ? $_SESSION['temp_data']['user_id'] : '';

        $login_token = null;

        $temp  = $this->db->query("SELECT login_token FROM users WHERE AES_DECRYPT(email, '" . DATA_KEY . "') = '$email_id'")->result_array();
        if (count($temp) > 0) {
            $login_token = $temp[0]['login_token'];
            if (!is_null($login_token)) {
                $login_token = trim($login_token);
                if (strlen($login_token) < 4) {
                    $login_token = null;
                } else {
                    $token = $login_token;
                }
            }
        }

        $data = array(
            'token_status' => 0
        );

        $this->db->where('useremail', $email_id);
        $this->db->update('tbl_twofactortoken', $data);

        $this->db->insert('tbl_twofactortoken', array('useremail' => $email_id, 'token' => $this->encryption->encrypt($token), 'token_status' => 1));

        $config = array(
            'mailtype' => 'html',
            'charset' => 'utf-8',  //iso-8859-1
            'newline' =>  '\r\n',
            'wordwrap' => TRUE
        );

        if ($this->agent->is_browser()) {
            $agent = $this->agent->browser() . ' ' . $this->agent->version();
        } elseif ($this->agent->is_robot()) {
            $agent = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
            $agent = $this->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }
        $whitelist = [
            // IPv4 address
            '127.0.0.1',

            // IPv6 address
            '::1'
        ];
        if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
            // $data = 'Some file data';
            $fp = fopen('./uploads/email.txt', 'w');
            fwrite($fp, $token);
            fclose($fp);
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
            $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
            $message = '';
            $message .= '<b>Portal Authentication Access Token</b><br/>';
            $message .= '<br/>Dear User<br/>';
            $message .= '<br/>You have tried to access PathHub Pathology Reporting Portal.<br/>';
            $message .= '<br/>Details of access:<br/>';
            $message .= '<br/>Account :' . $email_id . '<br/> From: <b>' . $agent . '</b><br/> Operating System:<b>' . $this->agent->platform() . ' </b><br/> Date:<b>';
            $message .= date("F j, Y, g:i a") . '</b> <br/> IP address:<b>' . $_SERVER['REMOTE_ADDR'] . '</b><br/>';

            $message .= '<br/><p>Please find your access token: </p>';
            $message .= '<span style="background-color: blue;color:WHITE">' . $token . '</span><br/>';
            $message .= '<p>Copy your access token and paste it in the Authentication Code Field in login form.</p>';
            $message .= '<p>If you have any questions please contact us at: support@pathhub.com</p>';
            $message .=  '<p><b>Best wishes</b><br/></p>';
            $message .=   '<b/><b>Central Control</b><br/>';
            $message .=  '<b>PathHub Operating Systems Inc</b><br/>';


            $this->load->library('email', $config);
            // $this->email->set_header('Content-type', 'text/html\r\n');
            $this->email->set_mailtype("html");
            $this->email->set_newline("\r\n");
            $this->email->from('info@uralensiswebapp.co.uk'); // change it to yours
            $this->email->reply_to('info@uralensiswebapp.co.uk', 'Pathhub Support Team');
            $this->email->cc('dev@oxbridgemedica.com');
            $this->email->to($email_id); // change it to yours
            $this->email->subject('Aleatha Authentication Access Token');
            // $mesg = $this->load->view('auth/pinemailtemplate',$dataTemp,true);
            $this->email->message($message);

            //$this->email->message($mesg);
            if ($this->email->send()) {

                $set_auth_cookie = array(
                    'name' => 'temp_access_token_validation_' . $user_id,
                    'value' => $user_id,
                    'expire' => '100'
                );
                $this->input->set_cookie($set_auth_cookie);

                $json['type'] = 'success';
                $json['msg'] = 'One time token sent to registered email';
                echo json_encode($json);
                die;
            }
            //echo $details->city;
        }
    }

    /**
     * Check User Memorable Details
     *
     * @return void
     */
    public function checkUserMemorableDetails()
    {
        $json = array();
        if (isset($_POST)) {
            $identity = $this->input->post('user_identity');
            $password = $this->input->post('user_password');
            $memorable1 = $this->input->post('memorable1');
            $memorable2 = $this->input->post('memorable2');
            $hidden_mem1 = $this->input->post('hidden_mem1');
            $hidden_mem2 = $this->input->post('hidden_mem2');
            if (empty($memorable1)) {
                $json['type'] = 'error';
                $json['msg'] = 'Memorable 1 Must Not Be Empty';
                $json['error_class'] = 'error';
                echo json_encode($json);
                die;
            }
            if (empty($memorable2)) {
                $json['type'] = 'error';
                $json['msg'] = 'Memorable 2 Must Not Be Empty';
                $json['error_class'] = 'error';
                echo json_encode($json);
                die;
            }

            //Get Memorable From User Data
            $db_memorable = $this->Userextramodel->getAllUserData($identity);
            // $db_memorable = $this->db->select('memorable')->where('email', $identity)->get('users')->row_array()['memorable'];
            // echo last_query();exit;
            if (empty($db_memorable)) {
                $attempts_remaining = $this->checkRemainingAttempts($identity);
                $json['type'] = 'error';
                $json['msg'] = 'Memorable word did not exists, ' . $attempts_remaining . ' Attempts remaining';
                echo json_encode($json);
                die;
            }
            $correct_mem1 = substr($db_memorable[0]['memorable'], $hidden_mem1 - 1, 1);
            $correct_mem2 = substr($db_memorable[0]['memorable'], $hidden_mem2 - 1, 1);
            if (!empty($memorable1) && $correct_mem1 != $memorable1) {
                $this->checkLoginAttempts($identity, $password);
                $data = array(
                    'token_status' => 0
                );

                $this->db->where('useremail', $identity);
                $this->db->update('tbl_twofactortoken', $data);
                $attempts_remaining = $this->checkRemainingAttempts($identity);
                $json['type'] = 'error';
                $json['msg'] = 'Your Memorable 1 did not match, ' . $attempts_remaining . ' Attempts remaining';
                echo json_encode($json);
                die;
            }
            if (!empty($memorable2) && $correct_mem2 != $memorable2) {
                $this->checkLoginAttempts($identity, $password);
                $data = array(
                    'token_status' => 0
                );

                $this->db->where('useremail', $identity);
                $this->db->update('tbl_twofactortoken', $data);
                $attempts_remaining = $this->checkRemainingAttempts($identity);
                $json['type'] = 'error';
                $json['msg'] = 'Your Memorable 2 did not match, ' . $attempts_remaining . ' Attempts remaining';
                echo json_encode($json);
                die;
            }
            if ($correct_mem1 == $memorable1 && $correct_mem2 == $memorable2) {
                if ($this->Ion_auth_model->is_max_login_attempts_exceeded($identity)) {
                    //Hash something anyway, just to take up time
                    $this->Ion_auth_model->hash_password($password);
                    $this->Ion_auth_model->trigger_events('post_login_unsuccessful');
                    $this->Ion_auth_model->set_error('login_timeout');
                    $json['type'] = 'error';
                    $json['msg'] = 'Your account is now locked. Contact system admin, operations@pathhub.com';
                    echo json_encode($json);
                    die;
                }
                //Check if phone number exists against user.
                /*$db_phone = $this->db->select('phone')->where('email', $identity)->get('users')->row_array()['phone'];
                if (empty($db_phone)) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Phone Number is not added yet for 2FA';
                    echo json_encode($json);
                    die;
                }*/
//                $this->Ion_auth_model->identity_column = $this->config->item('identity', 'ion_auth');
//                $this->Ion_auth_model->tables = $this->config->item('tables', 'ion_auth');
//                $user = $this->Userextramodel->getDataForSession($this->Ion_auth_model->identity_column, $this->Ion_auth_model->tables['users'], $identity);
                /* $query = $this->db->select($this->Ion_auth_model->identity_column . ', AES_DECRYPT(username, "7kgtY3rYvbx6krm2HGiR") AS username, AES_DECRYPT(email, "7kgtY3rYvbx6krm2HGiR") AS email, id, password, active, last_login, memorable')
                    ->where($this->Ion_auth_model->identity_column, $identity)
                    ->limit(1)
                    ->order_by('id', 'desc')
                    ->get($this->Ion_auth_model->tables['users']);
                $user = $query->row();*/
                //echo last_query();exit;
//                $this->Ion_auth_model->set_session($user, 'yes');

                if (isset($_SESSION['temp_data'])) {
                    /**
                     * Get Session Data
                     * Check Phone Varification BY User ID
                     */
                    $email_id = !empty($_SESSION['temp_data']['identity']) ? $_SESSION['temp_data']['identity'] : '';
                    $user_id = !empty($_SESSION['temp_data']['user_id']) ? $_SESSION['temp_data']['user_id'] : '';

                    $check_cookie = $this->input->cookie('remember_auth_access_' . $user_id, true);

                    //Generate Random Access Token
                    $access_token = bin2hex(random_bytes(intval(16)));
                    //Encode Access Token to send user by email.
                    $encoded_access_token = base64_encode($access_token);

                    if (!isset($check_cookie)) {

                        $this->db->where('user_id', $user_id)->where('meta_key', 'access_token')->delete('usermeta');
                        $this->db->insert('usermeta', array('user_id' => $user_id, 'meta_key' => 'access_token', 'meta_value' => $access_token));

                        $config = array(
                            // 'protocol' => 'smtp',
                            // 'smtp_host' => 'ssl://smtp.googlemail.com',
                            // 'smtp_port' => 465,
                            // 'smtp_user' => 'xxx@gmail.com', // change it to yours
                            // 'smtp_pass' => 'xxx', // change it to yours
                            'mailtype' => 'html',
                            'charset' => 'iso-8859-1',
                            'wordwrap' => TRUE
                        );

                        $message = '';
                        $message .= '<p>You have received an authentication access token.</p>';
                        $message .= $encoded_access_token;
                        $message .= '<p>Copy your access token and paste it in the Authentication Code Field in login form.</p>';
                        //$this->load->library('email', $config);
                        $this->email->set_newline("\r\n");
                        $this->email->from('info@uralensiswebapp.co.uk'); // change it to yours
                        $this->email->to($email_id); // change it to yours
                        $this->email->subject('Uralensis Authentication Access Token');
                        $this->email->message($message);
                        /* if ($this->email->send()) {

                            $set_auth_cookie = array(
                                'name' => 'temp_access_token_validation_' . $user_id,
                                'value' => $user_id,
                                'expire' => '100'
                            );
                            $this->input->set_cookie($set_auth_cookie);
                            
                            $json['type'] = 'success';
                            $json['msg'] = 'Memorable Combination match and Auth Code Sent Successfull';
                            echo json_encode($json);
                            die;
                        } else {
                            $json['type'] = 'error';
                            $json['msg'] = show_error($this->email->print_debugger());
                            echo json_encode($json);
                            die;
                        }*/
                    }
                    /**
                     * Call 2FA Method
                     * @param email_id
                     * @param user_phone
                     */
                    // $this->load->helper('authy_helper');
                    // get_authy_data($email_id, $db_phone, $user_id);
                }

                /**********Sending Email with Random Token Key
                 * Developed By Mohsin Raza Date 14/02/2020
                 *
                 * ************ */
                $this->GenerateTokenByEmailId($identity, $db_memorable[0]['first_name']);
                $json['type'] = 'success';
                $json['msg'] = 'Memorable combinations matched';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Check Users Members Only
     *
     * @return void
     */
    public function checkUserMemorableOnly()
    {
        $json = array();
        if (isset($_POST)) {
            $identity = $this->input->post('user_identity');
            $password = $this->input->post('user_password');
            $memorable1 = $this->input->post('memorable1');
            $memorable2 = $this->input->post('memorable2');
            $hidden_mem1 = $this->input->post('hidden_mem1');
            $hidden_mem2 = $this->input->post('hidden_mem2');
            if (empty($memorable1)) {
                $json['type'] = 'error';
                $json['msg'] = 'Memorable 1 Must Not Be Empty';
                $json['error_class'] = 'error';
                echo json_encode($json);
                die;
            }
            if (empty($memorable2)) {
                $json['type'] = 'error';
                $json['msg'] = 'Memorable 2 Must Not Be Empty';
                $json['error_class'] = 'error';
                echo json_encode($json);
                die;
            }

            //Get Memorable From User Data
            $db_memorable = $this->db->select('memorable')->where('email', $identity)->get('users')->row_array()['memorable'];

            if (empty($db_memorable)) {
                $json['type'] = 'error';
                $json['msg'] = 'Memorable word did not exists';
                echo json_encode($json);
                die;
            }
            $correct_mem1 = substr($db_memorable, $hidden_mem1 - 1, 1);
            $correct_mem2 = substr($db_memorable, $hidden_mem2 - 1, 1);
            if (!empty($memorable1) && $correct_mem1 != $memorable1) {
                $this->checkLoginAttempts($identity, $password);
                $data = array(
                    'token_status' => 0
                );

                $this->db->where('useremail', $identity);
                $this->db->update('tbl_twofactortoken', $data);
                //echo last_query();exit;
                $json['type'] = 'error';
                $json['msg'] = 'Your Memorable 1 did not match';
                echo json_encode($json);
                die;
            }
            if (!empty($memorable2) && $correct_mem2 != $memorable2) {
                $this->checkLoginAttempts($identity, $password);
                $data = array(
                    'token_status' => 0
                );

                $this->db->where('useremail', $identity);
                $this->db->update('tbl_twofactortoken', $data);
                $json['type'] = 'error';
                $json['msg'] = 'Your Memorable 2 did not match';
                echo json_encode($json);
                die;
            }
            if ($correct_mem1 == $memorable1 && $correct_mem2 == $memorable2) {
                if ($this->Ion_auth_model->is_max_login_attempts_exceeded($identity)) {
                    //Hash something anyway, just to take up time
                    $this->Ion_auth_model->hash_password($password);
                    $this->Ion_auth_model->trigger_events('post_login_unsuccessful');
                    $this->Ion_auth_model->set_error('login_timeout');
                    $json['type'] = 'error';
                    $json['msg'] = 'Your account is now locked. Contact system admin, operations@pathhub.com';
                    echo json_encode($json);
                    die;
                }
                $json['type'] = 'success';
                $json['msg'] = 'Memorable combinations matched';
                echo json_encode($json);
                die;
            }
        }
    }

    /****************Checking Email Access Token Developed By Mohsin Raza 14/02/2020**************************** */

    public function CheckEmailTokenValidations()
    {
        $json = array();
        if (isset($_POST)) {

            $verify_auth = $this->input->post('verify_auth');
            $identity = $this->input->post('user_identity');
            $password = $this->input->post('user_password');
            $password = $this->input->post('user_password');
            if (empty($verify_auth)) {
                $json['type'] = 'error';
                $json['msg'] = 'Please enter one time access token';
                $json['error_class'] = 'error';
                echo json_encode($json);
                die;
            }
            if ($this->CheckTokenTime($verify_auth, $identity, $this->input->post('user_password')) === true) {
                //Get User ID Based on Email Address
                $user_id = $this->Userextramodel->getuserId($identity);
                $user_id =  $user_id[0]->id;
                if($this->input->post("remember_pc")==1){
                    $checkIp = $this->Userextramodel->checkUserIPToken($user_id);
                    $userIp = getRealIpAddr();
                    if($checkIp){
                        $this->db->where("user_id",$user_id);
                        $this->db->where("client_ip",$userIp);
                        $this->db->update("user_remember_pc",array("remember_token_date"=>date("Y-m-d", strtotime(" +1 months"))));
                    } else {
                        $insData['user_id'] = $user_id;
                        $insData['client_ip'] = $userIp;
                        $insData['remember_token_date'] = date("Y-m-d", strtotime(" +1 months"));
                        $this->db->insert("user_remember_pc",$insData);
                    }

                }
                $this->pushLoginData($identity);
//                $this->Ion_auth_model->set_session('', 'no');
                $json['type'] = 'success';
                $json['msg'] = 'Successful login';
                echo json_encode($json);
                die;
            } else {
                $this->checkLoginAttempts($identity, $password);
                $attempts_remaining = $this->checkRemainingAttempts($identity);
                $json['type'] = 'error';
                $json['msg'] = 'Access Token Not Verified, ' . $attempts_remaining . ' Attempts remaining';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * string(5) "R7Fbg" string(22) "dev@oxbridgemedica.com" SELECT `created` FROM `tbl_twofactortoken` WHERE `token` = '5115553991069395978f36ec99f942b7813d24c75d280e2d894b6a6587480e15dc8544ed8cae6493fb5021b59b60be811a785f213165d808d4d9a3f93365293cXFRW1G0+UT0yaJPUiiNh0NLQoYk6MjBFlcdasKNzItA=' AND `useremail` = '59c65ea83d2c5c8198f314e229478ce30e7ec116b3c0f3e670f937f6b73698a286227e4ac2a475a0865f8a7810326abaa51c10dfbe88e022be9d59784fc79b6d02krXx8PIwWAqXxDdUTDGAgw3hYq3sW/k9pybGT9TdT70xe+pyCuvQDNReJvA1DZ' AND `token_status` = 1
     * 
     */

    public function CheckTokenTime($verify_auth = '', $user_id = '', $password = '')
    {
        if (!empty($verify_auth) && !empty($user_id)) {

            //var_dump($this->encryption->decrypt('5115553991069395978f36ec99f942b7813d24c75d280e2d894b6a6587480e15dc8544ed8cae6493fb5021b59b60be811a785f213165d808d4d9a3f93365293cXFRW1G0+UT0yaJPUiiNh0NLQoYk6MjBFlcdasKNzItA='));

            $token = $this->encryption->encrypt($verify_auth);
            // $user_id = $this->encryption->encrypt($user_id);



            $db_token = $this->db->select('COUNT(*) AS TOTROWS,created,token')
                ->where('useremail', $user_id)
                ->where('token_status', 1)
                ->order_by('created', 'desc')
                ->limit(1)
                ->get('tbl_twofactortoken')
                ->row();
            // echo $db_token->TOTROWS;exit;
            if ($db_token->TOTROWS == 0) {

                $db_token3 = $this->db->select('COUNT(*) AS TOTROWS,created,token')
                    ->where('useremail', $user_id)
                    ->where('token_status', 1)
                    ->where('token', $verify_auth)
                    ->order_by('token_id', 'asc')
                    ->limit(1)
                    ->get('tbl_pins')
                    ->row();

                if ($db_token3->TOTROWS > 0) {
//                    echo __LINE__."<br/>";
                    $json['type'] = 'success';
                    $json['msg'] = 'Access Token Verified';
                    $data = array(
                        'token_status' => 0
                    );

                    $this->db->where('useremail', $user_id);
                    $this->db->where('token', $verify_auth);
                    $this->db->update('tbl_pins', $data);

                    return true;
//                    echo json_encode($json);
//                    die;
                }

                $this->checkLoginAttempts($user_id, $password);
                $attempts_remaining = $this->checkRemainingAttempts($user_id);
                $json['type'] = 'error';
                $json['msg'] = 'Access Token Not Verified, ' . $attempts_remaining . ' Attempts remaining';

                die;
            }
            $createdDate = $db_token->created;
            $Token = $this->encryption->decrypt($db_token->token);


            // Current date and time`
            // echo date("Y-m-d H:i:s")."_".$createdDate;

            // $to_time = strtotime(date("Y-m-d H:i:s"));
            // var_dump(date("Y-m-d H:i:s")."----".$createdDate);
            // $minuts = round(abs($to_time-strtotime($createdDate) ) / 60,2);

            $minuts = (time() - strtotime($createdDate)) / 60;


            if ($minuts > 5) {
                $db_token3 = $this->db->select('COUNT(*) AS TOTROWS,created,token')
                    ->where('useremail', $user_id)
                    ->where('token_status', 1)
                    ->where('token', $verify_auth)
                    ->order_by('token_id', 'asc')
                    ->limit(1)
                    ->get('tbl_pins')
                    ->row();

                if ($db_token3->TOTROWS > 0) {
//                    echo __LINE__."<br/>";
                    $json['type'] = 'success';
                    $json['msg'] = 'Access Token Verified';
                    $data = array(
                        'token_status' => 0
                    );

                    $this->db->where('useremail', $user_id);
                    $this->db->where('token', $verify_auth);
                    $this->db->update('tbl_pins', $data);

                    return true;
//                    echo json_encode($json);
//                    die;
                }
                $this->checkLoginAttempts($user_id, $password);
                $attempts_remaining = $this->checkRemainingAttempts($user_id);
                $json['type'] = 'error';
                $json['msg'] = 'Access Token Not Verified, ' . $attempts_remaining . ' Attempts remaining';

                /*   $data = array(
                            'token_status' => 0
                    );
                    
                    $this->db->where('useremail', $user_id);
                    $this->db->update('tbl_twofactortoken', $data);*/


                // echo json_encode($json);
                //redirect('auth/logout', 'refresh');

            } else if ($verify_auth == $Token) {
                $json['type'] = 'success';
                $json['msg'] = 'Access Token Verified';
                $data = array(
                    'token_status' => 0
                );

                $this->db->where('useremail', $user_id);
                $this->db->update('tbl_twofactortoken', $data);

                return true;
//                echo json_encode($json);
//                die;
            }

            $db_token3 = $this->db->select('COUNT(*) AS TOTROWS,created,token')
                ->where('useremail', $user_id)
                ->where('token_status', 1)
                ->where('token', $verify_auth)
                ->order_by('token_id', 'asc')
                ->limit(1)
                ->get('tbl_pins')
                ->row();


            if ($db_token3->TOTROWS > 0) {
//                echo __LINE__."<br/>";
                $json['type'] = 'success';
                $json['msg'] = 'Access Token Verified';
                $data = array(
                    'token_status' => 0
                );

                $this->db->where('useremail', $user_id);
                $this->db->where('token', $verify_auth);
                $this->db->update('tbl_pins', $data);

                return true;
//                echo json_encode($json);
//                die;
            } else {
                $this->checkLoginAttempts($user_id, $password);
                $attempts_remaining = $this->checkRemainingAttempts($user_id);
                $json['type'] = 'error';
                $json['msg'] = 'Access Token Not Verified, ' . $attempts_remaining . ' Attempts remaining';
                echo json_encode($json);
                die;
            }
        }
    }


    /*****************End Of Checking Email Access Token Developed By Mohsin Raza******************************* */

    /**
     * Check Email Access Token
     *
     * @return void
     */
    public function checkEmailAccessToken()
    {
        $json = array();
        if (isset($_POST)) {
            $verify_auth = $this->input->post('verify_auth');
            $remember_pc = $this->input->post('remember_pc');

            if (empty($verify_auth)) {
                $json['type'] = 'error';
                $json['msg'] = 'Please enter one time access token';
                $json['error_class'] = 'error';
                echo json_encode($json);
                die;
            }

            if (isset($_SESSION['temp_data'])) {
                $email_id = !empty($_SESSION['temp_data']['identity']) ? $_SESSION['temp_data']['identity'] : '';
                $user_id = !empty($_SESSION['temp_data']['user_id']) ? $_SESSION['temp_data']['user_id'] : '';


                if ($this->checkEmailAccessTokenVerification($verify_auth, $user_id) === true) {
                    if (isset($remember_pc) && $remember_pc === 'true') {
                        $set_auth_cookie = array(
                            'name' => 'remember_auth_access_' . $user_id,
                            'value' => $user_id,
                            'expire' => '2678400'
                        );
                        $this->input->set_cookie($set_auth_cookie);
                    }
                    delete_cookie('temp_access_token_validation_' . $user_id);
                    $this->Ion_auth_model->set_session('', 'no');
                    $json['type'] = 'success';
                    $json['msg'] = 'Access Token Verified. Please Wait';
                    echo json_encode($json);
                    die;
                } else {
                    $attempts_remaining = $this->checkRemainingAttempts($user_id);
                    $json['type'] = 'error';
                    $json['msg'] = 'Access Token Not Verified, ' . $attempts_remaining . ' Attempts remaining';
                    echo json_encode($json);
                    die;
                }
            } else {
                redirect('auth/login', 'refresh');
            }
        }
    }



    /**
     * Check Email Access Token
     *
     * @return void
     */
    public function checkEmailAccessTokenVerification($verify_auth = '', $user_id = '')
    {

        $check_cookie = $this->input->cookie('temp_access_token_validation_' . $user_id, true);

        if (!isset($check_cookie)) {
            $this->db->where('user_id', $user_id)
                ->where('meta_key', 'access_token')
                ->delete('usermeta');
            $json['type'] = 'error';
            $json['msg'] = 'Your Token Has Been Expired';
            echo json_encode($json);
            die;
        }
        if (!empty($verify_auth) && !empty($user_id)) {
            //Get the token from DB

            //decode user input token
            $user_input_token = base64_decode($verify_auth);
            $db_token = $this->db->select('meta_value')
                ->where('meta_key', 'access_token')
                ->where('user_id', $user_id)
                ->get('usermeta')
                ->row_array()['meta_value'];
            if (strcmp($user_input_token, $db_token) !== 0) {
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * Check Access Token
     *
     * @return void
     */
    public function checkAccessToken()
    {
        $json = array();
        if (isset($_POST)) {
            $identity = $this->input->post('user_identity');
            $password = $this->input->post('user_password');
            $verify_auth = $this->input->post('verify_auth');
            $remember_pc = $this->input->post('remember_pc');
            if (empty($verify_auth)) {
                $json['type'] = 'error';
                $json['msg'] = 'Please enter one time access token';
                $json['error_class'] = 'error';
                echo json_encode($json);
                die;
            }
            if (isset($_SESSION['temp_data'])) {
                $email_id = !empty($_SESSION['temp_data']['identity']) ? $_SESSION['temp_data']['identity'] : '';
                $user_id = !empty($_SESSION['temp_data']['user_id']) ? $_SESSION['temp_data']['user_id'] : '';
                $access_data = $this->Ion_auth_model->get_accestoken_by_user($email_id, $user_id);
                $authy_id = $access_data[0]->authy_id;
                /**
                 * Call 2FA Method
                 * @param email_id
                 * @param user_phone
                 */
                $this->load->helper('authy_helper');
                if (check_access($authy_id, $verify_auth, $user_id) === true) {
                    if (isset($remember_pc) && $remember_pc === 'true') {
                        $set_auth_cookie = array(
                            'name' => 'remember_auth_access_' . $user_id,
                            'value' => $user_id,
                            'expire' => '2678400'
                        );
                        $this->input->set_cookie($set_auth_cookie);
                    }
                    $this->Ion_auth_model->set_session('', 'no');
                    $json['type'] = 'success';
                    $json['msg'] = 'Access Token Verified';
                    echo json_encode($json);
                    die;
                } else {
                    $attempts_remaining = $this->checkRemainingAttempts($user_id);
                    $json['type'] = 'error';
                    $json['msg'] = 'Access Token Not Verified, ' . $attempts_remaining . ' Attempts remaining';
                    echo json_encode($json);
                    die;
                }
            } else {
                redirect('auth/login', 'refresh');
            }
        }
    }

    /**
     * Check Login Attemps on Jquery Steps Wizard
     *
     * @param int $identity
     * @param string $password
     * @return void
     */
    public function checkLoginAttempts($identity = '', $password = '')
    {
        $json = array();
        if ($this->Ion_auth_model->is_max_login_attempts_exceeded($identity)) {
            //Hash something anyway, just to take up time
            $this->Ion_auth_model->hash_password($password);
            $this->Ion_auth_model->trigger_events('post_login_unsuccessful');
            $this->Ion_auth_model->set_error('login_timeout');
            $json['type'] = 'error';
            $json['msg'] = 'Your account is now locked. Contact system admin, operations@pathhub.com';
            echo json_encode($json);
            die;
        }
        $this->Ion_auth_model->hash_password($password);
        $this->Ion_auth_model->increase_login_attempts($identity);
        $this->Ion_auth_model->trigger_events('post_login_unsuccessful');
    }

    public function checkRemainingAttempts($identity)
    {
        $result = $this->ion_auth->get_attempts_num($identity);
        $attempts_remaining = 4 - $result;
        return $attempts_remaining;
    }

    public function pushLoginData($identity){
        $this->Ion_auth_model->identity_column = $this->config->item('identity', 'ion_auth');
        $this->Ion_auth_model->tables = $this->config->item('tables', 'ion_auth');
        $user = $this->Userextramodel->getDataForSession($this->Ion_auth_model->identity_column, $this->Ion_auth_model->tables['users'], $identity);
        $this->Ion_auth_model->set_session($user, 'yes');

        $this->load->helper(array('activity_helper', 'dashboard_functions_helper'));
        user_login_activity();
        if (isset($remember_pc) && $remember_pc === 'true') {
            $set_auth_cookie = array(
                'name' => 'remember_auth_access_' . $user->id,
                'value' => $user->id,
                'expire' => '2678400'
            );
            $this->input->set_cookie($set_auth_cookie);
        }
        delete_cookie('temp_access_token_validation_' . $user->id);
    }
}
