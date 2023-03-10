<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @brief     Pm Model
 * @details
 * The model works using two tables: table1 contains the messages, table2
 * the referencing between the messages and the recipients - by message
 * and user IDs.
 *
 * NOTE: All operations are performed for the current user, given by
 * user id. This id is gotten from the {@link User_model} which contains
 * a dummy method always returning the first user id found. Replace this
 * method with a more meaningful own method.
 *
 * The class can be initialized by calling {@link initialize} which will
 * allow changing dateformat and enforce_field_types vars. It makes use
 * of the {@link Table_model} class to read, write and update table data.
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
class Pm_model extends CI_Model
{
    /**
     * @var object: table_model object that manages table1 (messages)
     */
    private $table1;
    /**
     * @var object: table_model object that manages table2 (links)
     */
    private $table2;
    /**
     * @var object: global CI instance that contains e.g. the db object
     */
    private $ci;
    /**
     * @var int: user id of the logged in user from the db
     */
    private $user_id = null;
    private $user_email = null;
    /**
     * @var array|array|mixed: two dimensional associative array with message fields
     * (1st dimension int, 2nd dimension associative with field names as keys)
     * set upon call to {@link get_messages} or {@link get_message}.
     */
    public $messages = array();
    /**
     * @var array|array|integer two dimensional array with recipients (by userid)
     * of messsages - set upon call to {@link get_recipients}.
     */
    public $recipients = array();

    /**
     * @brief Pm_model constructor
     *
     * Pm_model constructor.
     *
     * @param dateformat string: format to display dates in
     * @param enforce_field_types bool: setting whether to enforce field types in PHP by cast
     * @return void
     */
    public function __construct($dateformat = "Y.m.d - H:i:s", $enforce_field_types = true)
    {
        parent::__construct();
        $this->ci = &get_instance();
        $this->load->model('User_model', 'user_model');
        $this->load->model('Ion_auth_model');
        $this->load->library('Table_model');
        $this->table1 = new Table_model(TABLE_PM, $dateformat, $enforce_field_types);
        $this->table2 = new Table_model(TABLE_PMTO, $dateformat, $enforce_field_types);
        $this->user_id = $this->ion_auth->user()->row()->id;//$this->user_model->current_id();
        $this->user_email = $this->ion_auth->user()->row()->enc_email;//$this->user_model->current_id();
    }

    /**
     * @brief initialize
     *
     * Initializes values for this class.
     *
     * @param dateformat string: format to display dates in
     * @param enforce_field_types bool: setting whether to enforce field types in PHP by cast
     * @return void
     */
    public function initialize($dateformat = "d.m.Y - H:i", $enforce_field_types = true)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        // Define the date format & whether db field types are enforced in PHP by type cast
        $this->table1->initialize($dateformat, $enforce_field_types);
        $this->table2->initialize($dateformat, $enforce_field_types);
    }

    /**
     * @brief Get messages
     *
     * Get messages to or from the logged in user and return CI results
     * array. Get messages of the given type, see below. Order results
     * by date created, descending.
     *
     * @param type integer: message type to get. Use one of the following:
     * MSG_NONDELETED: received by user, not deleted (default);
     * MSG_DELETED: received or sent by user, deleted;
     * MSG_UNREAD: received by user, not deleted, not read;
     * MSG_SENT: sent by user, not deleted;
     * type < 0: get ALL messages, deleted or not, sent to or by this user
     * @return array
     */
    public function get_messages($type = MSG_NONDELETED)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        // Lets use abbreviations
        $t1 = $this->table1->get_name();
        $t2 = $this->table2->get_name();

        $this->db->select($t1 . '.*');
        $this->db->from($t1);
        $user_id = $this->user_id;
        $user_email = $this->user_email;
        // Specify what type of messages you want to get - conditions work with join;
        // Since db evaluates "AND" first "A AND B OR C AND D" = "(A AND B) OR (C AND D)"

        switch ($type) {
            // Message types RECEIVED
            case MSG_NONDELETED:
                $whereClause = "(" . TF_PMTO_RECIPIENT . "=$user_id OR " . TF_PM_CC . " LIKE '%$user_email%' OR " . TF_PM_BCC . " LIKE '%$user_email%')";
//                $this->db->where(TF_PMTO_RECIPIENT, $this->user_id);
                $this->db->where($whereClause);
                $this->db->where(TF_PMTO_DELETED, null);
                break;
            case MSG_DELETED:
                // this produces "(A AND B) OR (C AND D)"
                $this->db->where(TF_PMTO_RECIPIENT, $this->user_id);
                $this->db->where(TF_PMTO_DELETED, 1);
                $this->db->or_where(TF_PM_AUTHOR, $this->user_id);
                $this->db->where(TF_PM_DELETED, 1);
                break;
            case MSG_UNREAD:
                $this->db->where(TF_PMTO_RECIPIENT, $this->user_id);
                $this->db->where(TF_PMTO_DELETED, null);
                $this->db->where(TF_PMTO_READ, null);
                break;
            // Message type SENT
            case MSG_SENT:
                $this->db->where(TF_PM_AUTHOR, $this->user_id);
                $this->db->where(TF_PM_DELETED, null);

                break;
            // Message type RECEIVED OR SENT (deleted or not, sent to or by this user)
            default:
                $this->db->where(TF_PMTO_RECIPIENT, $this->user_id);
                $this->db->where(TF_PM_AUTHOR, $this->user_id);
                break;
        }
        // Get messages by join of table1 & 2
        $this->db->join($t2, TF_PMTO_MESSAGE . ' = ' . TF_PM_ID);
        $this->db->group_by(TF_PM_ID); // To get only distinct messages
        $this->db->order_by(TF_PM_DATE, 'desc');

        return $this->table1->get_data();
    }

    public function getUserDecryptedDetailsByid($id)
    {


        $query = $this->db->query("SELECT  is_hospital_admin,profile_picture_path,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username  FROM users
                                WHERE id=" . $this->db->escape($id));
        //query->collumn_name

        return $query->row();
    }

    public function getUserDecryptedDetailsByEmail($email)
    {


        $query = $this->db->query("SELECT  is_hospital_admin,profile_picture_path,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username  FROM users
                                WHERE AES_DECRYPT(email, '" . DATA_KEY . "')=" . "'$email'");
        //query->collumn_name

        return $query->row();
    }

    /**
     * @brief Get message
     *
     * Get a specific message by message id to or from the logged in user
     * and return CI results array.
     *
     * @param msg_id integer: message id of the message to get
     * @return array
     */
    public function get_message($msg_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        // Lets use abbreviations
        $t1 = $this->table1->get_name();
        $t2 = $this->table2->get_name();
        $user_id = $this->user_id;
        $user_email = $this->user_email;
//        $whereClause = "(".TF_PM_ID."=$msg_id AND ".TF_PM_TO." LIKE '%$user_email%') OR (".TF_PM_ID."=$msg_id AND ".TF_PMTO_RECIPIENT."=$user_id) OR (".TF_PM_CC." LIKE '%$user_email%') OR (".TF_PM_BCC." LIKE '%$user_email%')";
//        echo $whereClause;exit;

        // Get message by join of table1 & 2
        $this->db->select($t1 . '.*,' . $t2 . ".pmto_recipient,profile_picture_path,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email");
        $this->db->from($t1);
        // this produces "(A AND B) OR (A AND C)" = "A AND (B OR C)"
//		$this->db->where(TF_PM_ID, $msg_id);
        $this->db->where(TF_PM_ID, $msg_id);
        $this->db->where(TF_PM_TO . " LIKE '%$user_email%'");
//		$this->db->where(TF_PMTO_RECIPIENT, $this->user_id);
        $this->db->or_where(TF_PM_ID, $msg_id);
        $this->db->where(TF_PM_AUTHOR, $this->user_id);
        $this->db->join($t2, TF_PMTO_MESSAGE . ' = ' . TF_PM_ID);
        $this->db->join("users", "privmsg_author=id","LEFT");

        return $this->table1->get_data();
    }

    /**
     * @brief Get recipients
     *
     * Get user ids of all recipients of a specific message given by msg
     * id. Do that for any message, not just the ones authored by the
     * logged in user.
     * Returns CI result array with recipient ids or empty array.
     *
     * @param msg_id integer: message id of the message to get recipients for
     * @return array
     */
    public function get_recipients($msg_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        // Lets use abbreviations
        $t2 = $this->table2->get_name();

        // Get recipients from table2
        $this->db->select(TF_PMTO_RECIPIENT);
        $this->db->from($t2);
        $this->db->where(TF_PMTO_MESSAGE, $msg_id);

        return $this->table2->get_data();
    }

    /**
     * @brief Get author
     *
     * Get user id of author of a specific message given by msg
     * id. Do that for any message, not just the ones authored by the
     * logged in user.
     * Returns user id directly if msg found or -1 otherwise.
     *
     * @param msg_id integer: message id of the message to get author for
     * @return int
     */
    public function get_author($msg_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $message = $this->get_message($msg_id);
        if ($message) {
            $message = reset($message);
            $author = $message[TF_PM_AUTHOR];
        } else
            $author = -1;

        return $author;
    }

    /**
     * @brief Flag read
     *
     * Flag a message (by id) as read. If optional 2nd param is set
     * FALSE, the sender will not get to know that msg was read.
     * Returns TRUE if successful, FALSE otherwise.
     *
     * @param msg_id integer: db message id of the message to flag as read
     * @param allow_notify bool: boolean indicating whether author may be notified if requested
     * @return bool
     */
    function flag_read($msg_id, $allow_notify = true)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        // Lets use abbreviations
        $t2 = $this->table2->get_name();

        $this->db->set(TF_PMTO_READ, 1);
        $this->db->set(TF_PMTO_RDATE, 'NOW()', false);
        if ($allow_notify) $this->db->set($t2 . '.' . TF_PMTO_ALLOWNOTIFY, 1);
        $this->db->limit(1, 0);
        $this->db->where(TF_PMTO_MESSAGE, $msg_id);
        $this->db->where(TF_PMTO_RECIPIENT, $this->user_id);

        return $this->table2->update_data();
    }

    /*******************
     * @parms $email
     * @return $result
     **************/

    public function getuserId($email)
    {


        $query = $this->db->query("SELECT id FROM users WHERE email= AES_ENCRYPT(" . $this->db->escape($email) . ", '" . DATA_KEY . "')");


        return $query->result();
    }

    /*******************
     * @parms $useridSessio
     * @return $arrays
     **************/

    public function getUserList($id)
    {


        $query = $this->db->query("SELECT  is_hospital_admin,profile_picture_path,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username  FROM users");
        //query->collumn_name

        return $query->result_array();
    }

    /**
     * @brief Flag message deleted
     *
     * Flag a message (by id) as deleted.
     * Note: depending on whether the user was recipient or author the
     * message will be flaged deleted in table2 or table1, i.e. it will
     * be determined automatically if the msg is to be deleted from
     * sent-folder or inbox of the user.
     * Optionally through 2nd param a costum value can be supplied to
     * update the "deleted" field to, while the default is 1. This also
     * can be used to restore the msg instead of deleting it, by e.g.
     * passing NULL.
     * NOTE: The "DDATE" will be set to "NOW" regardeless of the "status"
     *         value passed.
     * Returns TRUE if successful, FALSE otherwise.
     *
     * @param msg_id integer: db message id of the message to flag as deleted
     * @param status integer: optional value to update "deleted" field to, default 1
     * @return bool
     */
    function flag_deleted($msg_id, $status = 1)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->db->limit(1, 0);
        if ($this->get_author($msg_id) == $this->user_id) {
            $this->db->set(TF_PM_DELETED, $status);
            $this->db->set(TF_PM_DDATE, 'NOW()', false);
            $this->db->where(TF_PM_ID, $msg_id);
            $this->db->where(TF_PM_AUTHOR, $this->user_id);
            return $this->table1->update_data();
        } else {
            $this->db->set(TF_PMTO_DELETED, $status);
            $this->db->set(TF_PMTO_DDATE, 'NOW()', false);
            $this->db->where(TF_PMTO_MESSAGE, $msg_id);
            $this->db->where(TF_PMTO_RECIPIENT, $this->user_id);
            return $this->table2->update_data();
        }
    }

    /**
     * @brief Flag message undeleted
     *
     * Flag a message (by id) as NOT deleted.
     * Note: This method is just using the {@link flag_deleted} method
     * with "NULL" as 2nd param. This will make the DDATE be the
     * "restored date".
     * Returns TRUE if successful, FALSE otherwise.
     *
     * @param msg_id integer: db message id of the message to flag as deleted
     * @return bool
     */
    function flag_undeleted($msg_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        return $this->flag_deleted($msg_id, null);
    }

    /**
     * @brief Send message
     *
     * Add a new personal message to table1 and recipients to table2.
     * Note: sending messages to oneself is not allowed and this should
     * stay this way, since it would cause problems with deleting &
     * restoring messages.
     * Returns TRUE if successful, returns FALSE otherwise.
     *
     * @param recipients integer: array of one or more user ids of the recipients
     * (can be array or single var) of the message to add.
     * @param subject string: subject of the message
     * @param body string: message text
     * @param notify bool: notify flag, whether to notify sender upon read, default TRUE
     * @return bool
     */
    function send_message($recipients, $subject, $body, $notify = true, $is_reply = 'false', $message_id = '', $record_id = '', $others = FALSE)
    {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        // Check notify
        if (!$notify) $notify = null;
        else $notify = true;
        // Check recipients
        if (!is_array($recipients)) $recipients = array($recipients);

        foreach ($recipients as $recipient)
            if (!$this->user_model->table1->is_valid_index($recipient))
                return false;

        // insert message in table1
        $this->db->set(TF_PM_AUTHOR, $this->user_id);
        $this->db->set(TF_PM_DATE, 'NOW()', false);
        $this->db->set(TF_PM_TO, $others['recipients']);
        $this->db->set(TF_PM_CC, $others['cc']);
        $this->db->set(TF_PM_BCC, $others['bcc']);
        $this->db->set(TF_PM_SUBJECT, $subject);
        $this->db->set(TF_PM_BODY, $body);
        $this->db->set(TF_PM_NOTIFY, $notify);
        $this->db->set(TF_PM_REPLY_PARENT_ID, 0);

        if (!$this->table1->insert_data())
            return false;
        $msg_id = $this->table1->insert_id;
        if (!empty($is_reply) && $is_reply === 'true') {
            $this->db->where('privmsg_id', $msg_id)->update('privmsgs', array(TF_PM_REPLY_PARENT_ID => $message_id));
        }
        //echo last_query();
        // insert links to it for recipients in table2
        $failed = false; // if sth. fails here, more complex cleanup is required
        foreach ($recipients as $recipient) {
            // Do not allow sending messages to oneself!
            if ($recipient != $this->user_id) {
                $this->db->set(TF_PMTO_MESSAGE, $msg_id);
                $this->db->set(TF_PMTO_RECIPIENT, $recipient);
                if (!$this->table2->insert_data())
                    $failed = true;
            }
        }

        // on failure remove all we just inserted & return FALSE
        if ($failed) {
            $this->table1->delete_data(array(TF_PM_ID => $msg_id));
            $this->table2->delete_data(array(TF_PMTO_MESSAGE, $msg_id));
            return false;
        }

        //Update Record ID in Message Table if the message Comes From Doctor Side For Laboratory.
        if (!empty($record_id)) {
            $this->db->where('privmsg_id', $msg_id)->update('privmsgs', array('record_id' => intval($record_id)));
        }

        return $msg_id;
    }

    /**
     * @brief Draft message
     *
     * Add a new personal message to table1 and recipients to table2.
     * Note: sending messages to oneself is not allowed and this should
     * stay this way, since it would cause problems with deleting &
     * restoring messages.
     * Returns TRUE if successful, returns FALSE otherwise.
     *
     * @param recipients integer: array of one or more user ids of the recipients
     * (can be array or single var) of the message to add.
     * @param subject string: subject of the message
     * @param body string: message text
     * @param notify bool: notify flag, whether to notify sender upon read, default TRUE
     * @return bool
     */
    function draft_message($recipients, $subject, $body, $notify = true, $is_reply = 'false', $message_id = '', $record_id = '')
    {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        // Check notify
        if (!$notify) $notify = null;
        else $notify = true;
        // Check recipients
        if (!is_array($recipients)) $recipients = array($recipients);

        foreach ($recipients as $recipient)
            if (!$this->user_model->table1->is_valid_index($recipient))
                return false;

        // insert message in table1
        $this->db->set(TF_PM_AUTHOR, $this->user_id);
        $this->db->set(TF_PM_DATE, 'NOW()', false);
        $this->db->set(TF_PM_SUBJECT, $subject);
        $this->db->set(TF_PM_BODY, $body);
        $this->db->set(TF_PM_NOTIFY, $notify);
        $this->db->set(TF_PM_REPLY_PARENT_ID, 0);

        if (!$this->table1->insert_data())
            return false;
        $msg_id = $this->table1->insert_id;
        if (!empty($is_reply) && $is_reply === 'true') {
            $this->db->where('privmsg_id', $msg_id)->update('privmsgs_draft', array(TF_PM_REPLY_PARENT_ID => $message_id));
        }
        //echo last_query();
        // insert links to it for recipients in table2
        $failed = false; // if sth. fails here, more complex cleanup is required
        foreach ($recipients as $recipient) {
            // Do not allow sending messages to oneself!
            if ($recipient != $this->user_id) {
                $this->db->set(TF_PMTO_MESSAGE, $msg_id);
                $this->db->set(TF_PMTO_RECIPIENT, $recipient);
                if (!$this->table2->insert_data())
                    $failed = true;
            }
        }

        // on failure remove all we just inserted & return FALSE
        if ($failed) {
            $this->table1->delete_data(array(TF_PM_ID => $msg_id));
            $this->table2->delete_data(array(TF_PMTO_MESSAGE, $msg_id));
            return false;
        }

        //Update Record ID in Message Table if the message Comes From Doctor Side For Laboratory.
        if (!empty($record_id)) {
            $this->db->where('privmsg_id', $msg_id)->update('privmsgs_draft', array('record_id' => intval($record_id)));
        }

        return true;
    }

    public function get_parent_reply($message_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($message_id)) {
            return $this->db->where('privmsg_reply_parent_id', $message_id)->get('privmsgs')->result_array();
        } else {
            return array();
        }

    }
}

/* End of file Pm_model.php */
