<?php

class DatasetsModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function saveDataset($datasetData) {
        $sql = $this->db->set($datasetData);
        $this->db->insert('tbl_datasets');
        return $this->db->insert_id();
    }

    public function updateDataset($datasetData, $datasetID) {
        $sql = $this->db->set($datasetData);
        $this->db->where('dataset_id', $datasetID);
        $this->db->update('tbl_datasets');
        return $this->db->insert_id();
    }

    public function getLeadList() {
        //TODO: GET APPROPRIATE TEAM LEAD LIST
        $userID = $this->ion_auth->user()->row()->id;
        $isAdmin = $this->ion_auth->is_admin();
        $this->db->select(array(
            "id as user_id",
            "aes_decrypt(users.first_name, '" . DATA_KEY . "') AS enc_first_name",
            "aes_decrypt(users.last_name, '" . DATA_KEY . "') AS enc_last_name",
            "profile_picture_path"
        ));
        $res = $this->db->get("users");
        $retArr = array();
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return array();
        }
    }

    public function getUsersList($groupID = '') {
        $userID = $this->ion_auth->user()->row()->id;
        $isAdmin = $this->ion_auth->is_admin();
        $this->db->select(array(
            "users.id as user_id",
            "aes_decrypt(users.first_name, '" . DATA_KEY . "') AS enc_first_name",
            "aes_decrypt(users.last_name, '" . DATA_KEY . "') AS enc_last_name",
            "profile_picture_path"
        ));
        if ($groupID != '') {
            $this->db->join('users_groups', 'users_groups.user_id = users.id', 'left');
            $this->db->where('users_groups.group_id', $groupID);
        }
        $res = $this->db->get("users");
        // echo $this->db->last_query();die();
        $retArr = array();
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return array();
        }
    }

    public function getClientList() {
        $userID = $this->ion_auth->user()->row()->id;
        $userGrp = $this->getUserGroup($userID);
        if ($userGrp->group_type == 'A') {
            return $this->getHospitals();
        } elseif ($userGrp->group_type == 'D') {
            // TODO: UPADTE THE FOLLOWING FUNCTION
            return $this->getPathologistHospitals();
        } else {
            return $this->getHospitals($userGrp->group_id);
        }
    }

    public function getDatasetList($dataset_name, $hospital_id, $specialty_id) {
        $userID = $this->ion_auth->user()->row()->id;
        $isAdmin = $this->ion_auth->is_admin();
        $this->db->select('tbl_datasets.*');
        $this->db->select('tds.dataset_id as pDatasetID');
        $this->db->select('tds.dataset_name as pDatasetName');
        $this->db->select('specialties.specialty');
        $this->db->select('groups.name as hospital');
        $this->db->join('specialties', 'tbl_datasets.specialty_id=specialties.id');
        $this->db->join('tbl_datasets tds', 'tbl_datasets.parent_dataset_id=tds.dataset_id', 'left');
        $this->db->join('groups', 'tbl_datasets.hospital_id=groups.id');
        $this->db->from('tbl_datasets');
        if (!$isAdmin) {
            $this->db->where('tbl_datasets.created_by', $userID);
        }

        if ($dataset_name != '') {
            $this->db->like('tbl_datasets.dataset_name', $dataset_name);
        }
        if ($specialty_id != '') {
            $this->db->where('tbl_datasets.specialty_id', $specialty_id);
        }
        if ($hospital_id != '') {
            $this->db->where('tbl_datasets.hospital_id', $hospital_id);
        }
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return array();
        }
    }

    public function getGroupName($groupIds) {
        if (!array($userIds)) {
            $this->db->where('id', $groupIds);
        } else {
            $this->db->where_in('id', $groupIds);
        }

        $this->db->select('name');
        $res = $this->db->get("groups");
        $retArr = array();
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return array();
        }
    }

    public function getUserDetails($userIds) {
        if (!array($userIds)) {
            $this->db->where('id', $userIds);
        } else {
            $this->db->where_in('id', $userIds);
        }

        $this->db->select(array(
            "id as user_id",
            "aes_decrypt(users.first_name, '" . DATA_KEY . "') AS enc_first_name",
            "aes_decrypt(users.last_name, '" . DATA_KEY . "') AS enc_last_name",
            "profile_picture_path"
        ));
        $this->db->order_by('created_on', 'DESC');
        $res = $this->db->get("users");
        $retArr = array();
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return array();
        }
    }

    public function removeDataset($datasetID) {
        $this->db->where('dataset_id', $datasetID);
        $this->db->delete('tbl_datasets');
    }

    private function getUserGroup($userID) {
        $this->db->select(['group_id', 'group_type']);
        $this->db->join('groups', ' groups.id = users_groups.group_id', 'left');
        $this->db->where('user_id', $userID);
        $userGrpRES = $this->db->get('users_groups');
        if ($userGrpRES->num_rows() > 0) {
            $grpRSLT = $userGrpRES->row();
            return $grpRSLT;
        }
    }

    private function getHospitals($userGrp = '') {
        if ($userGrp != '') {
            $this->db->where('id', $userGrp);
        }
        $this->db->where('group_type', 'H');
        $this->db->select(array('description as client_name', 'id as client_id'));
        $hospitalsRES = $this->db->get('groups');
        if ($hospitalsRES->num_rows() > 0) {
            $grpRSLT = $hospitalsRES->result_array();
            return $grpRSLT;
        } else {
            return array();
        }
    }

    private function getPathologistHospitals($userID = '') {
        // TODO: UPDATE THIS FUNCTION TO GET ALL 
        //       HOSPITALS where the Pathologist is Working
        if ($userID != '') {
            $this->db->where('id', $userID);
        }
        $this->db->where('group_type', 'H');
        $this->db->select(array('description as client_name', 'id as client_id'));
        $hospitalsRES = $this->db->get('groups');
        if ($hospitalsRES->num_rows() > 0) {
            $grpRSLT = $hospitalsRES->result_array();
            return $grpRSLT;
        } else {
            return array();
        }
    }

    public function setDatasetNumber($datasetID, $datasetType) {
        $this->db->set('ticket_number', strtoupper($datasetType) . "-" . $datasetID);
        $this->db->where('dataset_id', $datasetID);
        $this->db->update('datasets');
    }

    public function addFileData($fileData) {
        $sql = $this->db->set($fileData);
        $this->db->insert('mskss_dataset_attachment');
        return $this->db->insert_id();
    }

    public function getDatasetData($datasetID) {
        $this->db->where('dataset_id', $datasetID);
        $res = $this->db->get("datasets");
        $retArr = array();
        if ($res->num_rows() > 0) {
            $this->db->where('attachment_dataset_id', $datasetID);
            $res_attch = $this->db->get("mskss_dataset_attachment");
            if ($res->num_rows() > 0) {
                $retArr ['dataset_attach_data'] = $res_attch->result_array();
            }
            $retArr ['dataset_data'] = $res->result_array();
            return $retArr;
        } else {
            return array();
        }
    }

    public function getDatasetCommentsData($datasetID) {
        $this->db->select(array(
            "aes_decrypt(users.first_name, '" . DATA_KEY . "') AS enc_first_name",
            "aes_decrypt(users.last_name, '" . DATA_KEY . "') AS enc_last_name",
            "ticket_comment_addedBy",
            "ticket_comment_addedOn",
            "ticket_comment_id",
            "ticket_comment_text",
            "comment_dataset_id"
        ));
        $this->db->where('comment_dataset_id', $datasetID);
        $this->db->where('isActive', '1');
        $this->db->join("users", 'users.id = datasets_comments.ticket_comment_addedBy', 'LEFT');
        $res = $this->db->get("datasets_comments");
        $retArr = array();
        if ($res->num_rows() > 0) {
            $retArr = $res->result_array();
            // var_dump($retArr);die();
            return $retArr;
        } else {
            return array();
        }
    }

    public function getDatasetAssignee($datasetID) {
        $this->db->select(array(
            "aes_decrypt(users.first_name, '" . DATA_KEY . "') AS enc_first_name",
            "aes_decrypt(users.last_name, '" . DATA_KEY . "') AS enc_last_name",
            "profile_picture_path"
        ));
        $this->db->where('assignee_dataset_id', $datasetID);
        $this->db->join('users', 'assignee_id = users.id');
        $res = $this->db->get("mskss_ticket_assignee");
        $retArr = array();
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return array();
        }
    }

}
