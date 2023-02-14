<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Institute_model extends CI_Model {

    public function institute_insert($request) {

        $this->db->insert("request", $request);
        $id = $this->db->insert_id();
        $session_data = array(
            'id' => $id
        );
        $this->session->set_userdata($session_data);
        //return $id;
    }

    public function insert_specimen($specimen) {
        $this->db->insert("specimen", $specimen);
        $specimen_id = $this->db->insert_id();
        $session_data = array(
            'specimen_id' => $specimen_id
        );
        $this->session->set_userdata($session_data);
        if ($this->db->affected_rows() > 0) {
            echo 'Record Inserted';
        } else {
            echo 'Record Not Inserted';
        }
    }

    public function specimen_type() {
        $query = $this->db->get('request_type');
        return $query->result();
    }

    public function view_request_detail() {
        $query = $this->db->get('request');
        return $query->result();
    }

    public function request_assign() {
        $user_id = $this->ion_auth->user()->row()->id;
        $req_id = $this->session->userdata('id');
        $req_spec = array('request_id' => $req_id, 'users_id' => $user_id);
        $this->db->insert("users_request", $req_spec);
    }

    /* 7/27/2015 */

    public function request_specimen_add() {
        $request_id = $this->session->userdata('id');
        $specimen_id = $this->session->userdata('specimen_id');

        $data = array('rs_request_id' => $request_id, 'rs_specimen_id' => $specimen_id);
        $this->db->insert('request_specimen', $data);
    }

    /* 7/27/2015 */

    public function view_final_record($limit, $offset) {
        $user_id = $this->ion_auth->user()->row()->id;
        $this->db->limit($limit, $offset);

        $this->db->select('*')->from('request')
                ->join('users_request', 'users_request.request_id = request.id')
                ->where('users_request.users_id', $user_id)
                ->where('specimen_publish_status', 0)
        ;
        $query = $this->db->get();
        //$qry = $this->db->query("SELECT * FROM request INNER JOIN users_request where users_request.request_id = request.id AND users_request.users_id = $user_id");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
        }

        if ($this->db->affected_rows() == 0) :
            $msg = '<p class="bg-danger">Sorry there is no record yet. Kindly Add Request to see the submitted request.</p>';
            $this->session->set_flashdata('record-msg', $msg);
            $this->session->keep_flashdata('record-msg');
        endif;
        return $query->result();
    }

    public function request_singlerecord($id) {
        $query1 = $this->db->query("SELECT * FROM request WHERE request.id = $id");
        return $query1->result();
    }

    public function request_singlerecord_specimen($id) {
        $query2 = $this->db->query("SELECT DISTINCT * FROM request_specimen INNER JOIN request INNER JOIN specimen WHERE request_specimen.rs_request_id = $id AND request.id = $id AND request.id = request_specimen.rs_request_id AND request.id = specimen.request_id AND specimen.specimen_id = request_specimen.rs_specimen_id");
        return $query2->result();
    }

    public function doctor_record_detail($id) {
        //$query = $this->db->query("SELECT * FROM request INNER JOIN specimen INNER JOIN users INNER JOIN users_request WHERE request.id = $id AND specimen.request_id = $id AND users_request.request_id = $id AND users.id = users_request.doctor_id");
        $query1 = $this->db->query("SELECT * FROM request INNER JOIN users INNER JOIN users_request WHERE request.id = $id AND users_request.request_id = $id AND users.id = users_request.doctor_id");
        $session_data = array(
            'id' => $id
        );
        $this->session->set_userdata($session_data);
        //$user_id = $this->session->userdata('id');
        return $query1->result();
    }

    public function doctor_record_detail_specimen($id) {
        //$query = $this->db->query("SELECT * FROM request INNER JOIN specimen INNER JOIN users INNER JOIN users_request WHERE request.id = $id AND specimen.request_id = $id AND users_request.request_id = $id AND users.id = users_request.doctor_id");
        $query2 = $this->db->query("SELECT * FROM request INNER JOIN specimen INNER JOIN users INNER JOIN users_request WHERE request.id = $id AND specimen.request_id = $id AND users_request.request_id = $id AND users.id = users_request.doctor_id");
        $session_data = array(
            'id' => $id
        );
        $this->session->set_userdata($session_data);
        //$user_id = $this->session->userdata('id');
        return $query2->result();
    }

    /* This Code will get the additional work detail */

    public function get_additional_work($id) {
        $query = $this->db->query("SELECT * FROM request INNER JOIN additional_work WHERE request.id = $id AND additional_work.request_id = $id");
        return $query->result();
    }

    public function further_view() {
        $user_id = $this->ion_auth->user()->row()->id;
        $query = $this->db->query("SELECT * FROM further_work INNER JOIN request INNER JOIN users WHERE further_work.request_id = request.id AND further_work.hospital_id = $user_id AND further_work.doctor_id = users.id ");
        return $query->result();
    }

    /* Search Functionality Code Start */

    public function get_search_request($emis_no, $nhs_no, $f_name, $l_name, $lab_no) {


        $where = array();

        if ($emis_no != '') {
            $where['emis_number'] = $emis_no;
        }

        if ($nhs_no != '') {
            $where['nhs_number'] = $nhs_no;
        }

        if ($f_name != '') {
            $where['f_name'] = $f_name;
        }

        if ($l_name != '') {
            $where['sur_name'] = $l_name;
        }

        if ($lab_no != '') {
            $where['lab_number'] = $lab_no;
        }

        if (empty($where)) {

            return array(); // ... or NULL
        } else {

            $query = $this->db->get_where('request', $where);
            $rowcount = $query->num_rows();

            if ($this->db->affected_rows() == 0) {
                $record_not_found = '<p class="bg-danger" style="padding:7px;">Sorry there is no record found mathing with your words. Please try to find with different words.</p>';
                $this->session->set_flashdata('record_found', $record_not_found);
            } else {

                $record_found = '<p class="bg-success" style="padding:7px;font-size:13px;font-weight:bold;">We have found ' . $rowcount . ' result/s based on your search query.</p>';
                $this->session->set_flashdata('record_found', $record_found);
            }
            return $query->result();
        } 
    }

    /* Search Functionality Code End */

    /**
     * @param $limit
     * @param $offset
     * @return mixed
     * New Request Page Code Start 9 September 2015
     */
    public function institute_record_published($limit, $offset) {
        $user_id = $this->ion_auth->user()->row()->id;
        $this->db->limit($limit, $offset);
        //$this->db->query("SELECT DISTINCT * FROM request INNER JOIN request_assignee WHERE request_assignee.user_id = $id AND request.id = request_assignee.request_id");

        $this->db->select('*')->from('request')
                ->join('users_request', 'users_request.request_id = request.id')
                ->where('users_request.users_id', $user_id)
                ->where('specimen_publish_status', 1)
                ->where('publish_status', 1)
        ;
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
        }
        return $query->result();
    }

    /**
     * Viewed Reports
     */
    public function institute_record_viewed($limit, $offset) {
        $user_id = $this->ion_auth->user()->row()->id;
        $this->db->limit($limit, $offset);
        //$this->db->query("SELECT DISTINCT * FROM request INNER JOIN request_assignee WHERE request_assignee.user_id = $id AND request.id = request_assignee.request_id");

        $this->db->select('*')->from('request')
                ->join('users_request', 'users_request.request_id = request.id')
                ->where('users_request.users_id', $user_id)
                ->where('specimen_publish_status', 1)
                ->where('publish_status', 0)
        ;
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
        }
        return $query->result();
    }

    /* Insert Uploaded Files Data into DB Code - 11/13/2015 */

    /**
     * 
     * @param type $filename
     * @param type $title
     * @param type $path
     * @param type $file_ext
     * @param type $is_image
     * @param type $doc_id
     * @param type $record_id
     */
    public function update_file($filename, $title, $path, $file_ext, $is_image, $hos_id, $user) {
        
        $record_id = $this->session->userdata('record_id');

        
            $data = array(
                'file_name' => $filename,
                'title' => $title,
                'file_path' => $path,
                'file_ext' => $file_ext,
                'is_image' => $is_image,
                'user_id' => $hos_id,
                'user' => $user,
                'record_id' => $record_id
            );
            $this->db->insert('files', $data);
    }

    /**
     * @return type $query
     */
    public function fetch_files_data() {
        
        $hospital_id = $this->ion_auth->user()->row()->id;
        $record_id = $this->session->userdata('record_id');

        $query = $this->db->query("SELECT * FROM files WHERE record_id = $record_id");

        return $query->result();
    }

}

?>
