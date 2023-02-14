<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @mainpage
 * @section Introduction
 * This is a simple boilerplate for a CodeIgniter private messaging system.
 * It comes with the following functionality:
 * \li Send messages to multiple users
 * \li Reply, delete, restore messages
 * \li Browse messages by status: deleted, unread, not deleted, sent, ...
 * \li AJAX ready function for auto-completing recipient names
 * \li ORM like base classes to convert MySQL types to PHP types
 * \li Sample views to demonstrate usage
 * \li Database structure and sample content
 *
 * It is written according to the CI coding guides, but it does not support
 * database prefixes.
 *
 * @section Installation
 * Grab a fresh CodeIgniter installation and connect it to a MySQL database.
 * Download all ci_pm files and extract them to your "application" CI folder.
 * Be sure to overwrite the "constants.php" file! As next step open the
 * "db.sql" file in the "application" folder and execute its contents
 * in a MySQL db. Delete the file afterwards.
 * Now you should be able to reach the module via ".../index.php/pm".
 *
 * @section Usage
 *
 * To test the system surf to ".../index.php/pm" on your server. To test the
 * auto-completing of recipient names enter only "Foo" to the recipient
 * field and click "send".
 *
 * To use the private messaging system with your own application you will
 * want to extend the {@link User_model} with your own user authentication
 * system. Therefore you have to replace the "current_id" method in
 * {@link User_model} with your own method returning the id of the currently
 * logged in user. {@link Pm_model} uses "current_id" to get the user id
 * of the current user.
 *
 * As next step you will want to replace the views and implement e.g. AJAX calls
 * to auto-complete recipient names or show more of the backend messages to the user.
 * Also you might want to delete the sample contents from the database and implement
 * your own routing.
 */

/**
 * @brief     Pm Controller
 * @details
 * Some methods in this controller will set a flashdata status message
 * to be used by the views they load. (e.g. {@link messages})
 * Most methods also pass variables to the views they load.
 * All output passed on to the views is documented in each controller
 * method description.
 * This controller does not care what user the actions are performed for:
 * that is entirely determined in the model class.
 *
 * Copyright (c) 2015
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 * @author    Balint Morvai
 * @version   0.9
 * @copyright MIT License
 */
class Pm extends CI_Controller
{
    /**
     * @var string: URI of home to redirect to uppon many occasions
     */
    public $base_uri = '/pm/';
    /**
     * @var object: global CI instance that contains e.g. the db object
     */
    private $ci;

    /**
     * @brief PM constructor
     *
     * @return void
     */
    function __construct()
    {
        parent::__construct();

        $this->ci = &get_instance();
        $this->load->model('Ion_auth_model');
        $this->config->load('form_validation', TRUE);
        $this->config->load('pm', TRUE);
        $this->load->helper(array('url', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('Pm_model', 'pm_model');
        $this->load->model('User_model', 'user_model');
        $this->lang->load('pm', 'english');
        track_user_activity();
    }

    /**
     * @brief initialize
     *
     * Initializes values for this class.
     *
     * @param dateformat string: format to display dates in
     * @return void
     */
    public function initialize($dateformat = "Y.m.d - H:i:s")
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->pm_model->initialize($dateformat);
    }

    /**
     * @brief CI index function
     *
     * CI index function called if no other is specified
     *
     * @return void
     */
    function index($id = "", $label_id = "")
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->inbox($id, $label_id);
    }

    function inbox($id = "", $label_id = "")
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->messages($id, $label_id);
    }

    /**
     * @Compose new message CI index function
     *
     * CI index function called if no other is specified
     *
     * @return void
     */
    function compose($id = "", $draft = "")
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;

        if ($id != "") {
            $messageTo = array();

            if ($draft != "") {
                $getData = getRecords("*", "privmsgs_draft", array("privmsg_id" => $id));
                $json  = json_encode($getData);
                $getData = json_decode($json, true);

                $data['message'] = $getData;
                $data['userinfo']->email = $getData[0]['privmsg_to'];
                $data["draft"] = 1;

                $messageTo = explode(",",$getData[0]['privmsg_to']);

            } else {
                $data['message'] = $this->pm_model->get_message($id);
//                echo $this->db->last_query();exit;
                log_message('error', print_r($data['message'], true));
                //	debug($data['message']);exit;
                $data['userinfo'] = $this->pm_model->getUserDecryptedDetailsByid($data['message'][0]['privmsg_author']);
//                debug($data['message']);exit;
                foreach ($data['message'] as $messageData){
                    if($messageData['pmto_recipient']!=$user_id){
                        $messageTo[] = $messageData['pmto_recipient'];
                    }
                }
                //Include Author
                if($data['message'][0]['privmsg_author']!=$user_id){
                    $messageTo[] = $data['message'][0]['privmsg_author'];
                }
                $data['message_id'] = $id;
            }


            $data['messageTo'] = $messageTo;
        }

        $data['userList'] = $this->pm_model->getUserList($user_id);
//        	debug($data);exit;
        //if($this->ion_auth->is_admin()){

        $this->load->view('pm/inc/header');

        /*}elseif (!empty($groups) && $groups[0]->group_type === 'H') {
            $this->load->view('institute/inc/header');
        } elseif (!empty($groups) && $groups[0]->group_type === 'D') {
            $this->load->view('doctor/inc/header-new');
        } elseif (!empty($groups) && $groups[0]->group_type === 'S') {
            $this->load->view('secretary/inc/header');
        } elseif (!empty($groups) && $groups[0]->group_type === 'L') {
            $this->load->view('laboratory/inc/header');
        }*/

        //$this->load->view('pm/container-header');
        //$this->load->view('pm/menu');

        $this->load->view('pm/compose', $data);

        //$this->load->view('pm/container-footer');

        //if($this->ion_auth->is_admin()){

        $this->load->view('pm/inc/footer');

        /*	}elseif (!empty($groups) && $groups[0]->group_type === 'H') {
                $this->load->view('institute/inc/footer');
            } elseif (!empty($groups) && $groups[0]->group_type === 'D') {
                $this->load->view('doctor/inc/footer-new');
            } elseif (!empty($groups) && $groups[0]->group_type === 'S') {
                $this->load->view('secretary/inc/footer');
            } elseif (!empty($groups) && $groups[0]->group_type === 'L') {
                $this->load->view('laboratory/inc/footer');
            }*/

    }

    /**
     * @brief Send message
     *
     * Send a new message to the users given by username,
     * with the given subject and given text body.
     * Views loaded: menu, compose.
     * Data for 'compose' view:
     * $found_recipients (bool), $suggestions (array|string),
     * $status (string), $message (associative array|string).
     * Flashdata for 'compose' view: 'status'.
     *
     * @param recipients array|string: array with usernames
     * @param subject string: message subject
     * @param body string: message text
     * @return void
     */
    function SendMessage()
    {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }


//        $rules = $this->config->item('pm_form', 'form_validation');
//
//        $this->form_validation->set_rules($rules);



        if($this->input->post("send") == 1){
            $this->form_validation->set_rules('recipients[]', 'Recipients', 'required');
        }

        if ($this->form_validation->run() or $this->input->post("send") == 2) {

//            echo "<pre>";
//            print_r($_POST);
//            print_r($_FILES);
//            exit;

            $recipients = $this->input->post("recipients");
            $email_cc = implode(";",$this->input->post("email_cc"));
            $email_bcc = implode(";",$this->input->post("email_bcc"));

            $subject = $this->input->post("privmsg_subject");
            $body = $this->input->post("privmsg_body");

            $recipient_ids = array();
            // Get user ids of recipients - if not found, get usernames of suggestions

            foreach ($recipients as $key=>$value){
                $result = $this->pm_model->getuserId($value);
                array_push($recipient_ids, $result[0]->id);
            }
//print_r($recipient_ids);exit;

            $others['cc'] = $email_cc;
            $others['bcc'] = $email_bcc;
            $others['recipients'] = (!empty($recipients)?implode(";",$recipients):"");

//            array_push($recipient_ids, $result[0]->id);

            if ($this->input->post('message_id') != "") {
                $message_id = $this->input->post('message_id');
                $reply = true;
            } else {
                $message_id = "";
                $reply = false;
            }

            if ($this->input->post("send") == 2) {
                $user_id = $this->ion_auth->user()->row()->id;
                $data = array("privmsg_author" => $user_id, "privmsg_date" => date("Y-m-d"), "privmsg_to" => implode(",",$recipient_ids), "privmsg_cc" => $email_cc, "privmsg_bcc" => $email_bcc, "privmsg_subject" => $subject, "privmsg_body" => $body, "to_ids" => $result[0]->id);

                if($this->input->post("draft_id")){
                    $draft_id = $this->input->post("draft_id");
                    $insertdraft = updateRecord("privmsgs_draft", $data,array("privmsg_id"=>$draft_id));
                } else {
                    $insertdraft = insertRecord("privmsgs_draft", $data);
                }



                redirect('pm/draft', 'refresh');


            } else {
                if($this->input->post("draft_id")){
                    //Check if email is sending from draft
                    $draft_id = $this->input->post("draft_id");
                    $this->db->delete("privmsgs_draft",array("privmsg_id"=>$draft_id));
                }
                $result = $this->pm_model->send_message($recipient_ids, $subject, $body, true, $reply, $message_id, '', $others);

                if (!empty($result)) {


                    // If files are selected to upload
                    if (!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0) {
                        $filesCount = count($_FILES['files']['name']);
                        for ($i = 0; $i < $filesCount; $i++) {
                            $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                            $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                            $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                            $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                            // File upload configuration
                            $uploadPath = 'uploads/emails/';
                            $config['upload_path'] = $uploadPath;
                            $config['allowed_types'] = 'jpg|jpeg|png|gif|xlsx|docs|txt|pdf';
                            //$config['max_size']    = '100';
                            //$config['max_width'] = '1024';
                            //$config['max_height'] = '768';

                            // Load and initialize upload library
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            $errorUploadType = '';
                            // Upload file to server
                            if ($this->upload->do_upload('file')) {
                                // Uploaded file data
                                $fileData = $this->upload->data();
                                $uploadData[$i]['file_name'] = $fileData['file_name'];
                                $uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");

                                $insertfile = insertRecord("privmsgs_attachments", array("privmsgid" => $result, "files" => $uploadData[$i]['file_name']));
                            } else {
                                $errorUploadType .= $_FILES['file']['name'] . ' | ';
                            }
                        }

                        $errorUploadType = !empty($errorUploadType) ? '<br/>File Type Error: ' . trim($errorUploadType, ' | ') : '';

                    }


                    redirect('pm/sent', 'refresh');
                } else {
                    redirect('pm/compose', 'refresh');
                }

            }


        } else {
//            print_r($_POST);
            print_r(validation_errors());
        }

    }

    /**
     * @brief Show a specific message
     *
     * Show a specific message by message id.
     * Views loaded: menu, details.
     * Data for 'details' view: $message.
     *
     * @param msg_id integer: id of the message to get
     * @return void
     */
    function message($msg_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$msg_id) return;

        // Get message and flag it as read
        $message = $this->pm_model->get_message($msg_id);
//        echo $this->db->last_query();exit;


        if ($message) {
            $message = reset($message);
//            echo "<pre>";print_r($message);exit;
            // Flag message as read
            $this->pm_model->flag_read($msg_id);

            // Get recipients & get usernames instead of user ids for recipients and author
            $message[TF_PM_AUTHOR] = $message['first_name']." ".$message['last_name'];
            $message[PM_RECIPIENTS] = $this->pm_model->get_recipients($message[TF_PM_ID]);

            // print_r($message[TF_PM_AUTHOR]);
            // die;
            $i = 0;
            foreach ($message[PM_RECIPIENTS] as $recipient) {
                $id = $recipient[TF_PMTO_RECIPIENT];
                $message[PM_RECIPIENTS][$i] = $this->user_model->get_user_name($id);
                $message["recipients_ids"][$i] = $id;
                $i++;
            }
            $data['message'] = $message;
        } else $data['message'] = array();

        if (!empty($this->ion_auth->get_users_groups()->row()->id)) {
            $groups = $this->Ion_auth_model->get_group_type($this->ion_auth->get_users_groups()->row()->id);
        }

//        debug($data);exit;
        //if($this->ion_auth->is_admin()){
        $this->load->view('pm/inc/header');
        //	}elseif (!empty($groups) && $groups[0]->group_type === 'H') {
        //    $this->load->view('institute/inc/header');
        //  } elseif (!empty($groups) && $groups[0]->group_type === 'D') {
        //      $this->load->view('doctor/inc/header-new');
        // } elseif (!empty($groups) && $groups[0]->group_type === 'S') {
        //      $this->load->view('secretary/inc/header');
        // } elseif (!empty($groups) && $groups[0]->group_type === 'L') {
        //      $this->load->view('laboratory/inc/header');
        //	}
        $data['message_id'] = $msg_id;
        //$this->load->view('pm/container-header');
        //$this->load->view('pm/menu');
        $this->load->view('pm/details', $data);
        //$this->load->view('pm/container-footer');

        //	if($this->ion_auth->is_admin()){
        $this->load->view('pm/inc/footer');
        //	}elseif (!empty($groups) && $groups[0]->group_type === 'H') {
        //       $this->load->view('institute/inc/footer');
        //   } elseif (!empty($groups) && $groups[0]->group_type === 'D') {
        //      $this->load->view('doctor/inc/footer-new');
        //   } elseif (!empty($groups) && $groups[0]->group_type === 'S') {
        //     $this->load->view('secretary/inc/footer');
        //  } elseif (!empty($groups) && $groups[0]->group_type === 'L') {
        //      $this->load->view('laboratory/inc/footer');
        //ss }

    }

    public function downloadFile($filename)
    {
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin())) {
            redirect('auth', 'refresh');
        }

        $this->load->helper('download');
        $data = file_get_contents(FCPATH . "uploads/emails/" . $filename); // Read the file's contents
        $name = $filename;
        force_download($name, $data);
    }

    /**
     * @brief Show messages
     *
     * Show messages.
     * Views loaded: menu, list.
     * Data for 'list' view: $messages (associative array|array|string).
     *
     * @param type integer: message type to get.
     * Use one of the following:
     * MSG_NONDELETED: received by user, not deleted;
     * MSG_DELETED: received by user, deleted;
     * MSG_UNREAD: received by user, not deleted, not read;
     * MSG_SENT: sent by user (no trashbin, i.e. no deleted state);
     * $type < 0: get ALL messages, deleted or not, sent to or by this user;
     * @return void
     */

    function messages($type = MSG_NONDELETED, $label_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }


        // Get & pass to view the messages view type (e.g. MSG_SENT)

        $data['type'] = $type;
        $data['label_id'] = $label_id;
        $messages = $this->pm_model->get_messages($type);
//        echo last_query();exit;
        //echo "<pre>";
        //print_r($messages);exit;
        if ($messages) {
            // Get recipients & get usernames instead of user ids
            // for recipients and author & render message body correctly
            $i = 0;
            foreach ($messages as $message) {
                $messages[$i][TF_PM_BODY] = $this->render($messages[$i][TF_PM_BODY]);
                $messages[$i][TF_PM_AUTHOR] = $this->user_model->get_user_name($message[TF_PM_AUTHOR]);
                $messages[$i][PM_RECIPIENTS] = $this->pm_model->get_recipients($messages[$i][TF_PM_ID]);
                $j = 0;
                foreach ($messages[$i][PM_RECIPIENTS] as $recipient) {
                    $id = $recipient[TF_PMTO_RECIPIENT];
                    $messages[$i][PM_RECIPIENTS][$j] = $this->user_model->get_user_name($id);
                    $j++;
                }
                $i++;
            }
            $data['messages'] = $messages;
        } else $data['messages'] = array();

        if (!empty($this->ion_auth->get_users_groups()->row()->id)) {
            $groups = $this->Ion_auth_model->get_group_type($this->ion_auth->get_users_groups()->row()->id);
        }
//        echo "<pre>";print_r($data);exit;

        //if($this->ion_auth->is_admin()){
        $this->load->view('pm/inc/header');
        /*}elseif (!empty($groups) && $groups[0]->group_type === 'H') {
            $this->load->view('institute/inc/header');
        } elseif (!empty($groups) && $groups[0]->group_type === 'D') {
            $this->load->view('doctor/inc/header-new');
        } elseif (!empty($groups) && $groups[0]->group_type === 'S') {
            $this->load->view('secretary/inc/header');
        } elseif (!empty($groups) && $groups[0]->group_type === 'L') {
            $this->load->view('laboratory/inc/header');
        }*/

        //$this->load->view('pm/container-header');
        //	$this->load->view('pm/menu');
        $this->load->view('pm/inbox', $data);
        //	$this->load->view('pm/list', $data);
        //	$this->load->view('pm/container-footer');

        //if($this->ion_auth->is_admin()){
        $this->load->view('pm/inc/footer');
        /*}elseif (!empty($groups) && $groups[0]->group_type === 'H') {
            $this->load->view('institute/inc/footer');
        } elseif (!empty($groups) && $groups[0]->group_type === 'D') {
            $this->load->view('doctor/inc/footer-new');
        } elseif (!empty($groups) && $groups[0]->group_type === 'S') {
            $this->load->view('secretary/inc/footer');
        } elseif (!empty($groups) && $groups[0]->group_type === 'L') {
            $this->load->view('laboratory/inc/footer');
        }*/
    }

    /**
     * @brief Show messages
     *
     * Show messages.
     * Views loaded: menu, list.
     * Data for 'list' view: $messages (associative array|array|string).
     *
     * @param type integer: message type to get.
     * Use one of the following:
     * MSG_NONDELETED: received by user, not deleted;
     * MSG_DELETED: received by user, deleted;
     * MSG_UNREAD: received by user, not deleted, not read;
     * MSG_SENT: sent by user (no trashbin, i.e. no deleted state);
     * $type < 0: get ALL messages, deleted or not, sent to or by this user;
     * @return void
     */

    function sent($type = MSG_SENT)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        // Get & pass to view the messages view type (e.g. MSG_SENT)
        $data['type'] = MSG_SENT;
        $messages = $this->pm_model->get_messages($type);

        //echo "<pre>";
        //print_r($messages);exit;
        if ($messages) {
            // Get recipients & get usernames instead of user ids
            // for recipients and author & render message body correctly
            $i = 0;
            foreach ($messages as $message) {
                $messages[$i][TF_PM_BODY] = $this->render($messages[$i][TF_PM_BODY]);
                $messages[$i][TF_PM_AUTHOR] = $this->user_model->get_user_name($message[TF_PM_AUTHOR]);
                $messages[$i][PM_RECIPIENTS] = $this->pm_model->get_recipients($messages[$i][TF_PM_ID]);
                $j = 0;
//                echo "<pre>";print_r($messages[$i][PM_RECIPIENTS]);exit;
                foreach ($messages[$i][PM_RECIPIENTS] as $recipient) {
                    $id = $recipient[TF_PMTO_RECIPIENT];
                    $messages[$i][PM_RECIPIENTS][$j] = $this->user_model->get_user_name($id);
                    $j++;
                }
                $i++;
            }
            $data['messages'] = $messages;
        } else $data['messages'] = array();

        if (!empty($this->ion_auth->get_users_groups()->row()->id)) {
            $groups = $this->Ion_auth_model->get_group_type($this->ion_auth->get_users_groups()->row()->id);
        }

        //if($this->ion_auth->is_admin()){
        $this->load->view('pm/inc/header');
        /*}elseif (!empty($groups) && $groups[0]->group_type === 'H') {
            $this->load->view('institute/inc/header');
        } elseif (!empty($groups) && $groups[0]->group_type === 'D') {
            $this->load->view('doctor/inc/header-new');
        } elseif (!empty($groups) && $groups[0]->group_type === 'S') {
            $this->load->view('secretary/inc/header');
        } elseif (!empty($groups) && $groups[0]->group_type === 'L') {
            $this->load->view('laboratory/inc/header');
        }*/

        //$this->load->view('pm/container-header');
        //	$this->load->view('pm/menu');
        $this->load->view('pm/inbox', $data);
        //	$this->load->view('pm/list', $data);
        //	$this->load->view('pm/container-footer');

        //                echo/*	if($this->ion_auth->is_admin()){
        $this->load->view('pm/inc/footer');
        /*}elseif (!empty($groups) && $groups[0]->group_type === 'H') {
            $this->load->view('institute/inc/footer');
        } elseif (!empty($groups) && $groups[0]->group_type === 'D') {
            $this->load->view('doctor/inc/footer-new');
        } elseif (!empty($groups) && $groups[0]->group_type === 'S') {
            $this->load->view('secretary/inc/footer');
        } elseif (!empty($groups) && $groups[0]->group_type === 'L') {
            $this->load->view('laboratory/inc/footer');
        }*/
    }

    function deleted($type = MSG_DELETED)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        // Get & pass to view the messages view type (e.g. MSG_SENT)
        $data['type'] = MSG_SENT;
        $messages = $this->pm_model->get_messages($type);

        //echo "<pre>";
        //print_r($messages);exit;
        if ($messages) {
            // Get recipients & get usernames instead of user ids
            // for recipients and author & render message body correctly
            $i = 0;
            foreach ($messages as $message) {
                $messages[$i][TF_PM_BODY] = $this->render($messages[$i][TF_PM_BODY]);
                $messages[$i][TF_PM_AUTHOR] = $this->user_model->get_user_name($message[TF_PM_AUTHOR]);
                $messages[$i][PM_RECIPIENTS] = $this->pm_model->get_recipients($messages[$i][TF_PM_ID]);
                $j = 0;
                foreach ($messages[$i][PM_RECIPIENTS] as $recipient) {
                    $id = $recipient[TF_PMTO_RECIPIENT];
                    $messages[$i][PM_RECIPIENTS][$j] = $this->user_model->get_user_name($id);
                    $j++;
                }
                $i++;
            }
            $data['messages'] = $messages;
        } else $data['messages'] = array();

        if (!empty($this->ion_auth->get_users_groups()->row()->id)) {
            $groups = $this->Ion_auth_model->get_group_type($this->ion_auth->get_users_groups()->row()->id);
        }

        //if($this->ion_auth->is_admin()){
        $this->load->view('pm/inc/header');
        /*}elseif (!empty($groups) && $groups[0]->group_type === 'H') {
            $this->load->view('institute/inc/header');
        } elseif (!empty($groups) && $groups[0]->group_type === 'D') {
            $this->load->view('doctor/inc/header-new');
        } elseif (!empty($groups) && $groups[0]->group_type === 'S') {
            $this->load->view('secretary/inc/header');
        } elseif (!empty($groups) && $groups[0]->group_type === 'L') {
            $this->load->view('laboratory/inc/header');
        }*/

        //$this->load->view('pm/container-header');
        //	$this->load->view('pm/menu');
        $this->load->view('pm/inbox', $data);
        //	$this->load->view('pm/list', $data);
        //	$this->load->view('pm/container-footer');

        //                echo/*	if($this->ion_auth->is_admin()){
        $this->load->view('pm/inc/footer');
        /*}elseif (!empty($groups) && $groups[0]->group_type === 'H') {
            $this->load->view('institute/inc/footer');
        } elseif (!empty($groups) && $groups[0]->group_type === 'D') {
            $this->load->view('doctor/inc/footer-new');
        } elseif (!empty($groups) && $groups[0]->group_type === 'S') {
            $this->load->view('secretary/inc/footer');
        } elseif (!empty($groups) && $groups[0]->group_type === 'L') {
            $this->load->view('laboratory/inc/footer');
        }*/
    }


    /**
     * @brief Show messages
     *
     * Show messages.
     * Views loaded: menu, list.
     * Data for 'list' view: $messages (associative array|array|string).
     *
     * @param type integer: message type to get.
     * Use one of the following:
     * MSG_NONDELETED: received by user, not deleted;
     * MSG_DELETED: received by user, deleted;
     * MSG_UNREAD: received by user, not deleted, not read;
     * MSG_SENT: sent by user (no trashbin, i.e. no deleted state);
     * $type < 0: get ALL messages, deleted or not, sent to or by this user;
     * @return void
     */

    function draft()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        // Get & pass to view the messages view type (e.g. MSG_SENT)
        $user_id = $this->ion_auth->user()->row()->id;
        $isdeleted = '0';
        $data['draf'] = getRecords("*", "privmsgs_draft", array("privmsg_author" => $user_id, "is_deleted" => $isdeleted));


        //if($this->ion_auth->is_admin()){
        $this->load->view('pm/inc/header');
        /*}elseif (!empty($groups) && $groups[0]->group_type === 'H') {
            $this->load->view('institute/inc/header');
        } elseif (!empty($groups) && $groups[0]->group_type === 'D') {
            $this->load->view('doctor/inc/header-new');
        } elseif (!empty($groups) && $groups[0]->group_type === 'S') {
            $this->load->view('secretary/inc/header');
        } elseif (!empty($groups) && $groups[0]->group_type === 'L') {
            $this->load->view('laboratory/inc/header');
        }*/

        //$this->load->view('pm/container-header');
        //	$this->load->view('pm/menu');
        $this->load->view('pm/draft', $data);
        //	$this->load->view('pm/list', $data);
        //	$this->load->view('pm/container-footer');

        //if($this->ion_auth->is_admin()){
        $this->load->view('pm/inc/footer');
        /*}elseif (!empty($groups) && $groups[0]->group_type === 'H') {
            $this->load->view('institute/inc/footer');
        } elseif (!empty($groups) && $groups[0]->group_type === 'D') {
            $this->load->view('doctor/inc/footer-new');
        } elseif (!empty($groups) && $groups[0]->group_type === 'S') {
            $this->load->view('secretary/inc/footer');
        } elseif (!empty($groups) && $groups[0]->group_type === 'L') {
            $this->load->view('laboratory/inc/footer');
        }*/
    }

    /**
     * @brief Send message
     *
     * Send a new message to the users given by username,
     * with the given subject and given text body.
     * Views loaded: menu, compose.
     * Data for 'compose' view:
     * $found_recipients (bool), $suggestions (array|string),
     * $status (string), $message (associative array|string).
     * Flashdata for 'compose' view: 'status'.
     *
     * @param recipients array|string: array with usernames
     * @param subject string: message subject
     * @param body string: message text
     * @return void
     */
    function send($recipients = NULL, $subject = NULL, $is_reply = 'false', $message_id = '')
    {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $rules = $this->config->item('pm_form', 'form_validation');
        $this->form_validation->set_rules($rules);

        $data['found_recipients'] = TRUE; // assume we'll find recipients - set to FALSE below otherwise
        $data['suggestions'] = array(); // if recipients not found by exact search, save suggestions here
        $message = array();
        // Set default vals passed via parameters
        $message[PM_RECIPIENTS] = $recipients;
        $message[TF_PM_SUBJECT] = $subject;
        // $message[TF_PM_BODY] 	= $body;

        if ($this->form_validation->run()) {

            // Overwrite default vals from params if form validated with vals from POST
            $message[PM_RECIPIENTS] = $this->input->post(PM_RECIPIENTS, TRUE);
            $message[TF_PM_SUBJECT] = $this->input->post(TF_PM_SUBJECT, TRUE);
            $message[TF_PM_BODY] = $this->input->post(TF_PM_BODY, TRUE);
            // Lets operate on copies of POST input to preserve orig vals in case of failure
            $recipients = explode(";", $this->input->post(PM_RECIPIENTS, TRUE));
            $subject = $this->input->post(TF_PM_SUBJECT, TRUE);
            $body = $this->input->post(TF_PM_BODY, TRUE);

            $recipient_ids = array();
            // Get user ids of recipients - if not found, get usernames of suggestions


            if (count($recipients) > 1) {
                foreach ($recipients as $recipient) {
                    $result = $this->user_model->get_userids(trim($recipient));

                    array_push($recipient_ids, reset($result));

                    // Try non-exact search if none found to have suggestions - in this case $data['suggestions']
                    // will contain an array with original strings as keys & arrays with suggestions as values.
                    if (!reset($result)) {
                        $data['found_recipients'] = FALSE;
                        $suggestions = $this->user_model->get_userids(trim($recipient), FALSE);
                        if ($suggestions)
                            foreach ($suggestions as $suggestion)
                                $data['suggestions'][$recipient] = $this->user_model->get_user_name($suggestion);
                    }
                }

            } else {
                $result = $this->user_model->get_userids(trim($this->input->post(PM_RECIPIENTS, TRUE)));


                array_push($recipient_ids, reset($result));
                //var_dump($recipient_ids);exit;

            }


            if ($data['found_recipients']) {

                if ($this->pm_model->send_message($recipient_ids, $subject, $body, true, $is_reply, $message_id)) {
                    // On success: redirect to list view of messages
                    $this->session->set_flashdata('status', $this->lang->line('msg_sent'));
                    redirect($this->base_uri . 'messages/' . MSG_SENT);//MSG_NONDELETED
                } else {
                    $status = $this->lang->line('msg_not_sent');
                    $this->session->set_flashdata('status', $status);
                    redirect($this->base_uri . 'send/' .
                        $message[PM_RECIPIENTS] . '/' .
                        $message[TF_PM_SUBJECT] . '/' .
                        $message[TF_PM_BODY]);
                }
            } else $data['status'] = $this->lang->line('recipients_not_found');
        }

        // Only happens if sending msg unsuccessful above
        if (isset($status)) {
            $data['status'] = $status;
            $this->session->set_flashdata('status', $status);
        }
        $data['message'] = $message;

        if (!empty($this->ion_auth->get_users_groups()->row()->id)) {
            $groups = $this->Ion_auth_model->get_group_type($this->ion_auth->get_users_groups()->row()->id);
        }

        //if($this->ion_auth->is_admin()){
        $this->load->view('templates/header');
        /*	}elseif (!empty($groups) && $groups[0]->group_type === 'H') {
                $this->load->view('institute/inc/header');
            } elseif (!empty($groups) && $groups[0]->group_type === 'D') {
                $this->load->view('doctor/inc/header');
            } elseif (!empty($groups) && $groups[0]->group_type === 'S') {
                $this->load->view('secretary/inc/header');
            } elseif (!empty($groups) && $groups[0]->group_type === 'L') {
                $this->load->view('laboratory/inc/header');
            }*/

        $this->load->view('pm/container-header');
        $this->load->view('pm/menu');
        $this->load->view('pm/compose', $data);
        $this->load->view('pm/container-footer');

        //	if($this->ion_auth->is_admin()){
        $this->load->view('templates/footer');
        /*	}elseif (!empty($groups) && $groups[0]->group_type === 'H') {
                $this->load->view('institute/inc/footer');
            } elseif (!empty($groups) && $groups[0]->group_type === 'D') {
                $this->load->view('doctor/inc/footer');
            } elseif (!empty($groups) && $groups[0]->group_type === 'S') {
                $this->load->view('secretary/inc/footer');
            } elseif (!empty($groups) && $groups[0]->group_type === 'L') {
                $this->load->view('laboratory/inc/footer');
            }*/
    }

    function massmail($subject = NULL, $is_reply = 'false', $message_id = '')
    {
        //var_dump($this->ion_auth->is_admin());

        if (!$this->ion_auth->is_admin()) {

            redirect('pm', 'refresh');
        }
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        //$rules = $this->config->item('pm_form2', 'form_validation');
        //var_dump($rules);

        $this->form_validation->set_rules('privmsg_subject', 'privmsg_subject', 'required');
        $this->form_validation->set_rules('privmsg_body', 'privmsg_body', 'required');
        //$this->form_validation->set_rules($rules);

        //$data['found_recipients'] = TRUE; // assume we'll find recipients - set to FALSE below otherwise
        $data['suggestions'] = array(); // if recipients not found by exact search, save suggestions here
        $message = array();
        // Set default vals passed via parameters
        //$message[PM_RECIPIENTS] = $recipients;
        $message[TF_PM_SUBJECT] = $subject;
        // $message[TF_PM_BODY] 	= $body;

        if ($this->form_validation->run()) {
            // Overwrite default vals from params if form validated with vals from POST
            //$message[PM_RECIPIENTS] = $this->input->post(PM_RECIPIENTS, TRUE);
            $message[TF_PM_SUBJECT] = $this->input->post(TF_PM_SUBJECT, TRUE);
            $message[TF_PM_BODY] = $this->input->post(TF_PM_BODY, TRUE);
            // Lets operate on copies of POST input to preserve orig vals in case of failure
            //$getUserEmails = getRecords("email","users",array("id!="=>$_SESSION["user_id"]))
            $recipients = explode(";", $this->input->post(PM_RECIPIENTS, TRUE));
            $subject = $this->input->post(TF_PM_SUBJECT, TRUE);
            $body = $this->input->post(TF_PM_BODY, TRUE);

            $recipient_ids = array();
            $getUserEmails = getRecords("email", "users", array("id!=" => $_SESSION["user_id"]));
            // Get user ids of recipients - if not found, get usernames of suggestions
            foreach ($getUserEmails as $recipient) {
                $result = $this->user_model->get_userids(trim($recipient->email));


                array_push($recipient_ids, reset($result));
                // Try non-exact search if none found to have suggestions - in this case $data['suggestions']
                // will contain an array with original strings as keys & arrays with suggestions as values.
                if (!reset($result)) {
                    $data['found_recipients'] = FALSE;
                    $suggestions = $this->user_model->get_userids(trim($recipient), FALSE);
                    if ($suggestions)
                        foreach ($suggestions as $suggestion)
                            $data['suggestions'][$recipient] = $this->user_model->get_user_name($suggestion);
                }
            }
            //var_dump($data['found_recipients']);exit;


            if ($this->pm_model->send_message($recipient_ids, $subject, $body, true, $is_reply, $message_id)) {
                //var_dump($this->lang->line('msg_sent'));exit;
                // On success: redirect to list view of messages
                $this->session->set_flashdata('status', $this->lang->line('msg_sent'));
                redirect($this->base_uri . 'messages/' . MSG_SENT);
            } else {
                $status = $this->lang->line('msg_not_sent');
                $this->session->set_flashdata('status', $status);
                redirect($this->base_uri . 'send/' .
                    $message[PM_RECIPIENTS] . '/' .
                    $message[TF_PM_SUBJECT] . '/' .
                    $message[TF_PM_BODY]);
            }

        }

        // Only happens if sending msg unsuccessful above
        if (isset($status)) {
            $data['status'] = $status;
            $this->session->set_flashdata('status', $status);
        }
        $data['message'] = $message;

        if (!empty($this->ion_auth->get_users_groups()->row()->id)) {
            $groups = $this->Ion_auth_model->get_group_type($this->ion_auth->get_users_groups()->row()->id);
        }

        if ($this->ion_auth->is_admin()) {
            $this->load->view('templates/header');
        } elseif (!empty($groups) && $groups[0]->group_type === 'H') {
            $this->load->view('institute/inc/header');
        } elseif (!empty($groups) && $groups[0]->group_type === 'D') {
            $this->load->view('doctor/inc/header');
        } elseif (!empty($groups) && $groups[0]->group_type === 'S') {
            $this->load->view('secretary/inc/header');
        } elseif (!empty($groups) && $groups[0]->group_type === 'L') {
            $this->load->view('laboratory/inc/header');
        }

        $this->load->view('pm/container-header');
        $this->load->view('pm/menu');
        $this->load->view('pm/massmail', $data);
        $this->load->view('pm/container-footer');

        if ($this->ion_auth->is_admin()) {
            $this->load->view('templates/footer');
        } elseif (!empty($groups) && $groups[0]->group_type === 'H') {
            $this->load->view('institute/inc/footer');
        } elseif (!empty($groups) && $groups[0]->group_type === 'D') {
            $this->load->view('doctor/inc/footer');
        } elseif (!empty($groups) && $groups[0]->group_type === 'S') {
            $this->load->view('secretary/inc/footer');
        } elseif (!empty($groups) && $groups[0]->group_type === 'L') {
            $this->load->view('laboratory/inc/footer');
        }
    }

    /**
     * @brief Mark as Read message
     *
     * Delete a message from inbox or sent-folder (move to trash). If 3rd parameter
     * "redirect" is TRUE, redirect to the view specified by 2nd parameter "type".
     * Usually this will be the same view the user deleted the message from.
     * Views loaded: - (no view loaded since redirect).
     * Flashdata for view redirected to: 'status'.
     *
     * @param msg_id integer: message to delete by msg id.
     * @param type integer: messages view type to redirect to, e.g. MSG_SENT {@link messages}.
     * @param redirect bool: indicating whether to redirect to a view after msg deleted.
     * @return void
     */

    function markasread()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $message_ids = explode(",", $this->input->post('messages_id'));
        foreach ($message_ids as $rec) {
            if ($rec != "") {
                $update = updateRecord("privmsgs_to", array('pmto_read' => $this->input->post('id')), array("pmto_message" => $rec, 'pmto_recipient' => $this->ion_auth->user()->row()->id));


            }

        }

        $json['type'] = 'success';
        $json['msg'] = 'Message is updated.';
        echo json_encode($json);
        die;


    }

    /**
     * @brief Mark as Label message
     *
     * Delete a message from inbox or sent-folder (move to trash). If 3rd parameter
     * "redirect" is TRUE, redirect to the view specified by 2nd parameter "type".
     * Usually this will be the same view the user deleted the message from.
     * Views loaded: - (no view loaded since redirect).
     * Flashdata for view redirected to: 'status'.
     *
     * @param msg_id integer: message to delete by msg id.
     * @param type integer: messages view type to redirect to, e.g. MSG_SENT {@link messages}.
     * @param redirect bool: indicating whether to redirect to a view after msg deleted.
     * @return void
     */

    function markaslabeled()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $message_ids = explode(",", $this->input->post('messages_id'));
        foreach ($message_ids as $rec) {
            if ($rec != "") {
                $checkifsamelable = getRecords("COUNT(*) AS TOTROWS", "privmsgs_labels_id", array("message_id" => $rec, "label_id" => $this->input->post('id')));
                if ($checkifsamelable[0]->TOTROWS == 0) {
                    $insertLabel = insertRecord("privmsgs_labels_id", array("message_id" => $rec, "label_id" => $this->input->post('id')));

                }


            }

        }

        $json['type'] = 'success';
        $json['msg'] = 'Message is updated.';
        echo json_encode($json);
        die;


    }

    /**
     * @brief Delete Draft Messages     *
     * Delete a message from inbox or sent-folder (move to trash). If 3rd parameter
     * "redirect" is TRUE, redirect to the view specified by 2nd parameter "type".
     * Usually this will be the same view the user deleted the message from.
     * Views loaded: - (no view loaded since redirect).
     * Flashdata for view redirected to: 'status'.
     *
     * @param msg_id integer: message to delete by msg id.
     * @param type integer: messages view type to redirect to, e.g. MSG_SENT {@link messages}.
     * @param redirect bool: indicating whether to redirect to a view after msg deleted.
     * @return void
     */

    function deletedraft()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $message_ids = $this->input->post('id');

        if ($message_ids != "") {
            $update = updateRecord("privmsgs_draft", array("is_deleted" => 1), array('privmsg_id' => $this->input->post('id')));


        }


        $json['type'] = 'success';
        $json['msg'] = 'Message is Deleted.';
        echo json_encode($json);
        die;


    }

    function createlabel()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $groupname = $this->input->post('groupname');
        $user_id = $this->input->post('user_id');

        $insert = insertRecord("privmsgs_labels", array("name" => $groupname, "created_by" => $user_id));


        $json['type'] = 'success';
        $json['msg'] = 'Label is created.';
        echo json_encode($json);
        die;


    }

    /**
     * @brief Delete message
     *
     * Delete a message from inbox or sent-folder (move to trash). If 3rd parameter
     * "redirect" is TRUE, redirect to the view specified by 2nd parameter "type".
     * Usually this will be the same view the user deleted the message from.
     * Views loaded: - (no view loaded since redirect).
     * Flashdata for view redirected to: 'status'.
     *
     * @param msg_id integer: message to delete by msg id.
     * @param type integer: messages view type to redirect to, e.g. MSG_SENT {@link messages}.
     * @param redirect bool: indicating whether to redirect to a view after msg deleted.
     * @return void
     */
    function delete($msg_id, $type = MSG_NONDELETED, $redirect = TRUE)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if ($msg_id >= 0)
            if ($this->pm_model->flag_deleted($msg_id)) $status = $this->lang->line('msg_deleted');
            else $status = $this->lang->line('msg_not_deleted');
        else $status = $this->lang->line('msg_invalid_id');
        $this->session->set_flashdata('status', $status);

        // Redirect to $type (e.g. MSG_NONDELETED) view of messages
        if ($redirect) redirect($this->base_uri . 'deleted');
        else $this->session->keep_flashdata('status');
    }

    /**
     * @brief Restore message
     *
     * Restore a message from trash: move to inbox or sent-folder, depending
     * on where it was deleted from. The method determines which is correct.
     * If 2nd parameter "redirect" is TRUE, redirect to trash view.
     * Views loaded: - (no view loaded since redirect).
     * Flashdata for view redirected to: 'status'.
     *
     * @param msg_id integer: message to restore by msg id.
     * @param redirect bool: indicating whether to redirect to a view after msg deleted.
     * @return void
     */
    function restore($msg_id, $redirect = TRUE)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if ($msg_id >= 0)
            if ($this->pm_model->flag_undeleted($msg_id)) $status = $this->lang->line('msg_restored');
            else $status = $this->lang->line('msg_not_restored');
        else $status = $this->lang->line('msg_invalid_id');
        $this->session->set_flashdata('status', $status);

        // Redirect to trash bin view of messages
        if ($redirect) redirect($this->base_uri . 'messages/' . MSG_DELETED);
        else $this->session->keep_flashdata('status');
    }

    /**
     * @brief Render message text
     *
     * Render the message body text.
     *
     * @param message_body string: text of the message body to be rendered
     * @return string
     */
    function render($message_body)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $message_body = strip_tags($message_body, '');
        $message_body = stripslashes($message_body);
        $message_body = nl2br($message_body);
        return $message_body;
    }

    function contactlist()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $data["getContacts"] = getRecords("id,username,first_name,last_name,company", "users", array("id!=" => $_SESSION["user_id"]));


        $this->load->view('pm/contactlist', $data);


    }

    function getUsersPic()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->input->post("user_id");

        $userList = $this->pm_model->getUserDecryptedDetailsByEmail($user_id);
        $response['type'] = "success";
        $response['msg'] = $userList->profile_picture_path;
        echo json_encode($response);exit;
    }

}

/* End of file Pm.php */