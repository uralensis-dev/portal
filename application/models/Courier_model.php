<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Doctor Model
 *
 * @package    CI
 * @subpackage Model
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */
Class Courier_model extends CI_Model
{

    public function select_where($select, $table, $where)
    {

        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }

    public function generate_userids($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->db->select("AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name");
        $this->db->select("AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name");
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result =  $query->result_array();
        if (count($result) == 0) {
            return NULL;
        }
        $result = $result[0];
        $first_initial = 'F';
        $last_initial = 'L';
        if (strlen($result['first_name']) > 0) {
            $first_initial = strtoupper($result['first_name'])[0];
        }

        if (strlen($result['last_name']) > 0) {
            $last_initial = strtoupper($result['last_name'])[0];
        }
        $g_user_id = $first_initial . $last_initial . sprintf("%04d", $id);
        return $g_user_id;
    }

}
