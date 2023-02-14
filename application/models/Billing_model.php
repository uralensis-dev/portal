<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Billing_model extends CI_Model {

    public function billingData($userId) {
        return $this->db->from('billing_data as bd')
                    ->join('specimen_type as st', 'st.spec_type_id = bd.specimen_type_id')
                    ->join('groups', 'groups.id = bd.clinic_id')
                    ->where(['bd.created_by' => $userId])
                    ->select('bd.*, st.type as specimen_type, groups.description as clinic')
                    ->order_by('bd.id', 'DESC')
                    ->get()
                    ->result_array();
    }

    public function pathologistData($userId, $lab_id) {
        return $this->db->from('pathologist_data as pd')
            ->join('users', 'users.id = pd.pathologist_id')
            ->where('pd.lab_id', $lab_id)
            //->where('pd.created_by', $userId)
            ->select("pd.*, CONCAT(AES_DECRYPT(users.first_name, '" . DATA_KEY . "'), ' ',AES_DECRYPT(users.last_name, '" . DATA_KEY . "')) as pathologist")
            ->order_by('pd.id', 'DESC')
            ->get()
            ->result_array();
    }

    public function get_pathologist_detail($path_data_id){
        return $this->db->select('*')->get_where('pathologist_data', ['id' => $path_data_id])->row();
    }

    public function getClinicBillingData($userId) {
        return $this->db->from('billing_data as bd')
                    ->join('specimen_type as st', 'st.spec_type_id = bd.specimen_type_id')
                    ->join('groups', 'groups.id = bd.clinic_id')
                    ->where(['bd.clinic_id' => $userId])
                    ->select('bd.*, st.type as specimen_type, groups.description as clinic')
                    ->order_by('bd.id', 'DESC')
                    ->get()
                    ->result_array();
    }

    public function get_specimen_type() {
        return $this->db->get(['specimen_type'])->result_array();
    }

    public function get_request_data($hos_group_id){
        return $this->db->select('uralensis_request_id as id, ura_barcode_no as title')->get_where('request',['hospital_group_id' => $hos_group_id])->result_array();
    }

    public function get_bill_code_data($clinic_id, $userId){
        return $this->db->select('id, bill_code as code, bill_description as description, price')
            ->get_where('billing_data', ['clinic_id' => $clinic_id, 'created_by' => $userId])
            ->result_array();
    }

    public function get_bill_detail($bill_id){
        return $this->db->select('*')->get_where('billing_data', ['id' => $bill_id])->row();
    }

    public function get_req_bill_detail($req_id){
        return $this->db->select('*')->get_where('request_billing_code', ['request_id' => $req_id])->result_array();
    }

    public function get_clinic_ids($userId, $groupId){
        return $this->db->from('billing_data as bd')
                    ->join('groups', 'groups.id = bd.clinic_id')
                    ->where('bd.created_by', $userId)
                    ->or_where('bd.group_id', $groupId)
                    //->or_where('bd.clinic_id', $groupId)
                    //->or_where('groups.group_type', 'D')  // TODO: pathologist
                    ->select('groups.id')
                    ->group_by('groups.id')
                    ->get()
                    ->result_array();
    }

    public function bill_track_data($userId, $groupId){
        $columnArr = [
            'groups.id',
            'groups.description as clinic',
            'SUM(rbc.bill_price) as price'
        ];
        return $this->db->from('request_billing_code as rbc')
            ->join('billing_data as bd', 'bd.id=rbc.bill_code')
            ->join('request', 'request.uralensis_request_id = rbc.request_id')
            ->join('groups', 'groups.id = bd.clinic_id')
            //->join('specimen', 'specimen.request_id = rbc.request_id')
            ->where('request.publish_datetime !=', NULL)   // condition for public data only
            ->group_start()
                ->where('bd.created_by', $userId)
                ->or_where('bd.clinic_id', $groupId)
            ->group_end()
            //->or_where('groups.group_type', 'D') // TODO: pathologist
            ->select($columnArr)
            ->group_by('groups.id')
            ->get()
            ->result_array();
    }

    public function bill_track_data_for_all($userId, $groupId, $clinicId){
        $columnArr = [
            'request.lab_number',
            'request.pci_number',
            'request.request_datetime',
            'groups.description as clinic',
            'GROUP_CONCAT(specimen.specimen_id) as specimens',
            'rbc.*'
        ];
        $result = $this->db->from('request_billing_code as rbc')
            ->join('billing_data as bd', 'bd.id=rbc.bill_code')
            ->join('request', 'request.uralensis_request_id = rbc.request_id')
            ->join('groups', 'groups.id = bd.clinic_id')
            ->join('specimen', 'specimen.request_id = rbc.request_id')
            ->where('request.publish_datetime !=', NULL)   // condition for public data only
            ->where('bd.created_by', $userId)
            //->or_where('bd.clinic_id', $clinicId)
            //->or_where('bd.clinic_id', $groupId)
            ->select($columnArr)
            ->group_by('rbc.id')
            ->get()
            ->result_array();

        foreach ($result as $key=>$row){
            $specimenArr = explode(',', $row['specimens']);
            $result[$key]['specimen'] = array_keys($specimenArr, $row['specimen_id'])[0] + 1;
        }

        return $result;
    }

    public function bill_track_data_for_single($userId, $groupId, $clinicId){
        $columnArr = [
            'request.lab_number',
            'request.pci_number',
            'request.request_datetime',
            'groups.description as clinic',
            'GROUP_CONCAT(specimen.specimen_id) as specimens',
            'rbc.*'
        ];
        $result = $this->db->from('request_billing_code as rbc')
            ->join('billing_data as bd', 'bd.id=rbc.bill_code')
            ->join('request', 'request.uralensis_request_id = rbc.request_id')
            ->join('groups', 'groups.id = bd.clinic_id')
            ->join('specimen', 'specimen.request_id = rbc.request_id')
            ->where('request.publish_datetime !=', NULL)   // condition for public data only
            ->where('bd.clinic_id', $clinicId)
            //->where('bd.created_by', $userId)
            //->or_where('bd.clinic_id', $groupId)
            ->select($columnArr)
            ->group_by('rbc.id')
            ->get()
            ->result_array();

        foreach ($result as $key=>$row){
            $specimenArr = explode(',', $row['specimens']);
            $result[$key]['specimen'] = array_keys($specimenArr, $row['specimen_id'])[0] + 1;
        }
        return $result;
    }

    public function bill_track_invoice_data($clinicId, $billingIdArr){
        return $this->db->from('request_billing_code as rbc')
            ->join('billing_data as bd', 'bd.id=rbc.bill_code')
            ->join('request', 'request.uralensis_request_id = rbc.request_id')
            ->join('request_assignee ra', 'ra.request_id = request.uralensis_request_id')
            //->where('bd.clinic_id', $clinicId)
            ->where_in('rbc.id', $billingIdArr)
            ->select('rbc.*, COUNT(rbc.id) as quantity, SUM(bd.price) as price_sum, request.lab_id, ra.user_id')
            ->group_by('rbc.bill_code')
            ->get()
            ->result_array();
    }
    public function bill_track_invoice_data_OLD($userId, $groupId, $clinicId){
        return $this->db->from('request_billing_code as rbc')
            ->join('billing_data as bd', 'bd.id=rbc.bill_code')
            ->join('request', 'request.uralensis_request_id = rbc.request_id')
            ->join('request_assignee ra', 'ra.request_id = request.uralensis_request_id')
            ->where('bd.clinic_id', $clinicId)
            ->select('rbc.*, COUNT(rbc.id) as quantity, SUM(bd.price) as price_sum, request.lab_id, ra.user_id')
            ->group_by('rbc.bill_code')
            ->get()
            ->result_array();
    }

    public function get_lab_info($groupId){
        return $this->db->from('groups')
            ->join('laboratory_information lab', 'lab.group_id=groups.id', 'left')
            ->where('groups.id', $groupId)
            ->select('groups.description as lab_name, lab.*')
            ->get()->row();
    }

    public function get_invoice_data($clinicIds){
        if(count($clinicIds) == 0){ return []; }
        return $this->db->from('invoice')
            ->join('groups', 'groups.id = invoice.clinic_id')
            ->where_in('invoice.clinic_id', $clinicIds)
            ->select('invoice.*, groups.description as clinic')
            ->group_by('invoice.id')
            ->get()
            ->result_array();
    }
}