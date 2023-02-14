<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Admin Model
 *
 * @package    CI
 * @subpackage Model
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */

class Tracking_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Fetch all the history entry of a record
     */
    public function fetch_record_history($lab_number) {
        // Get record id from lab number
        $this->db->select('uralensis_request_id');
        $this->db->from('request');
        $this->db->where('lab_number', $lab_number);
        $query = $this->db->get();
        $result = $query->result_array();
        if (count($result) == 0) {
            return NULL;
        }
        $request_id = $result[0]['uralensis_request_id'];
        $this->db->select('*');
        $this->db->from('uralensis_record_history');
        $this->db->where('rec_history_record_id', $request_id);
        $this->db->order_by('ura_rec_history_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();
        $final_result  = array();
        foreach($result as $key => $res) {
            $final_result[$key] = $res;
            $final_result[$key]['timestamp'] = date('d/m/y H:i A', $final_result[$key]['timestamp']);
         }
        return $final_result;
    }

    public function fetch_record_block_history($request_id) {
        // Get record id from lab number
        $this->db->select('*');
        $this->db->from('uralensis_block_history');
        $this->db->where('rec_history_record_id', $request_id);
        $this->db->order_by('ura_rec_history_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();
        $final_result  = array();
        foreach($result as $key => $res) {
            $final_result[$key] = $res;
            $final_result[$key]['timestamp'] = date('d/m/y H:i A', $final_result[$key]['timestamp']);
         }
        return $final_result;
    }

    public function fetch_track_status($lab_number) {
        // Get record id from lab number
        $this->db->select('uralensis_request_id');
        $this->db->from('request');
        $this->db->where('lab_number', $lab_number);
        $query = $this->db->get();
        $result = $query->result_array();
        if (count($result) == 0) {
            return '';
        }
        $request_id = $result[0]['uralensis_request_id'];
        $this->db->select('ura_rec_track_status');
        $this->db->where('ura_rec_track_record_id', $request_id);
        $res = $this->db->get('uralensis_record_track_status')->result_array();
        if (count($res) == 0)
            return '';
        return $res[0]['ura_rec_track_status'];
    }

    

    public function update_track_status($lab_number, $status)
    {
        // Get record id from lab number
        $this->db->select('uralensis_request_id');
        $this->db->from('request');
        $this->db->where('lab_number', $lab_number);
        $query = $this->db->get();
        $result = $query->result_array();
        if (count($result) == 0) {
            return NULL;
        }
        $request_id = $result[0]['uralensis_request_id'];

        // Check if record exists
        $this->db->select('ura_rec_track_record_id');
        $this->db->where('ura_rec_track_record_id', $request_id);
        $res = $this->db->get('uralensis_record_track_status')->result_array();
        if (count($res) == 0) {
            // Insert record
            $data = array(
                'ura_rec_track_record_id' => $request_id,
                'ura_rec_track_status' => $status,
                'timestamp' => strtotime('now')
            );
            $this->db->insert('uralensis_record_track_status', $data);
        } else {
            $this->db->set('ura_rec_track_status', $status);
            $this->db->set('timestamp', time());
            $this->db->where('ura_rec_track_record_id', $request_id);
            $this->db->update('uralensis_record_track_status');
        }
        
        $user =  $this->ion_auth->user()->row()->id;
        $timestamp = strtotime('now');
        $record_data = array(
            'rec_history_user_id' => $user,
            'rec_history_record_id' => $request_id,
            'rec_history_data' => $status,
            'rec_history_status' => 'track_status',
            'timestamp' => $timestamp
        );
        $this->db->insert('uralensis_record_history', $record_data);
        return True;
    }

    public function getRequestData($lab_number) {
        $select = "rq.uralensis_request_id as rq_id, rq.lab_number as lab_no, rq.pci_number as lims_no, concat(rq.f_name,' ',rq.sur_name) as patient, count(DISTINCT(sp.specimen_id)) as speciman_no, CONCAT(AES_DECRYPT(patho.first_name, '" . DATA_KEY . "'),' ' ,AES_DECRYPT(patho.last_name, '" . DATA_KEY . "')) AS pathologist, group_concat(DISTINCT(IF(sp_block.name='', null, sp_block.name))) as test, group_concat(DISTINCT(CONCAT(sp_block.id,'_',sp_block.name,'_', sp_block.block_no))) as all_test_id1, group_concat(DISTINCT(sp_block.id)) as all_test_id, rq.lab_id, rq.patient_id, br.id as br_id, barcode_image as barcode_img, pt.hospital_id, group_concat(DISTINCT(sp.specimen_id)) as sp_id, group_concat(DISTINCT concat(IF(sp_block.name='', '', sp_block.name),'_',sp.specimen_id,'_',sp_block.block_no) separator ',') as ctest, rq.hospital_group_id as req_hospital_group_id, rq.ref_lab_number,rq.uralensis_request_id as rq_id,hip.channel_no";
        $subQuery = "(SELECT  req_assign_id,user_id,request_id,MAX(req_assign_id) Maxpath FROM  request_assignee GROUP BY req_assign_id) rq_as";
        $this->db->select($select, FALSE);
        $this->db->join($subQuery, 'rq_as.request_id = rq.uralensis_request_id', 'inner');
        $this->db->join('users patho', 'patho.id = rq_as.user_id', 'left');
        $this->db->join('hospital_information hip', 'hip.group_id = rq.hospital_group_id', 'left');
        $this->db->join('users u', 'rq.request_add_user = u.id', 'left');
        $this->db->join('tbl_courier cr', 'cr.id=rq.emis_number', 'left');
		$this->db->join('patients pt', 'pt.id = rq.patient_id', 'inner');
		$this->db->join('specimen sp', 'sp.request_id = rq.uralensis_request_id', 'inner'); 
		$this->db->join('specimen_blocks sp_block', 'sp_block.specimen_id=sp.specimen_id', 'LEFT'); 
		$this->db->join('barcode br', 'br.request_id = rq.uralensis_request_id', 'left');
		$this->db->where('rq.lab_number', $lab_number)->limit(1);
        $query  = $this->db->get('request rq');
        return $query->row_array();
    }
}
