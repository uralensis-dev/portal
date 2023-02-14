<?php
defined('BASEPATH') or exit('No direct script access allowed');

//require APPPATH . 'libraries/REST_Controller.php';
//use Restserver\Libraries\REST_Controller;

class PatientAPI extends CI_Controller {

    public function __construct() {

        //header('Access-Control-Allow-Origin: *');
        //header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('ec_helper'));
        $this->load->model("PatientModel", "patient");
    }

    public function patient_detail($id=906){
        if (isset($id) && !empty($id)){
            $patient = $this->db->query("SELECT * FROM `patients` WHERE id = $id")->result();
            if(count($patient) > 0){
                $this->load->helper('file');
                $content = $this->text_file_content($patient[0]);
                $filePath = "./uploads/patient_detail/$id-".time().".txt";

                if(!is_dir('./uploads/patient_detail')){
                    mkdir('./uploads/patient_detail', 0777, TRUE);
                }
                if(!write_file($filePath, $content)){
                    echo 'Unable to write the file';
                }else{
                    echo "<hr>Successfully created text file<hr>";
                    $this->patient_detail_show($id);
                }

                $patient[0]->request_details = $this->db->query("
                SELECT users.id,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,
                    AES_DECRYPT(company, '" . DATA_KEY . "') AS company,
                    AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
                    AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
                    AES_DECRYPT(email, '" . DATA_KEY . "') AS email,
                    AES_DECRYPT(username, '" . DATA_KEY . "') AS username,patient_id as p_id,
                    uralensis_request_id, record_batch_id, 
                    serial_number, ura_barcode_no, 
                    patient_initial,patient_id, pci_number, 
                    request_datetime, publish_datetime,
                    publish_datetime_modified, emis_number, 
                    nhs_number, lab_number, hos_number, sur_name,
                    f_name, dob, age, lab_id, lab_name, date_received_bylab, 
                    data_processed_bylab, date_sent_touralensis,
                    date_rec_by_doctor, gender, clrk, dermatological_surgeon, 
                    date_taken, urgent, hsc, report_urgency, cl_detail, specimen_id,
                    request.status, specimen_update_status, specimen_publish_status, 
                    further_work_status, supplementary_report_status, supplementary_review_status, 
                    report_status, publish_status, hospital_group_id, additional_data_state,
                    comment_section, comment_section_date, teaching_case, mdt_case,
                    mdt_case_status, mdt_list_id, mdt_specimen_status, 
                    mdt_case_assignee_username, mdt_case_msg, mdt_case_msg_timestamp, 
                    mdt_case_add_to_report_status, mdt_outcome_text, fw_levels, fw_immunos,
                    fw_imf, special_notes, special_notes_date, record_secretary_id, 
                    record_assign_sec_time, record_secretary_status, secretary_record_edit_status,
                    cases_category, cost_codes, flag_status, authorize_status, request_add_user, 
                    request_add_user_timestamp, clinic_ref_number, clinic_request_form, 
                    request_code_status, record_edit_status, ura_rec_temp_dataset, remote_record, `location`, `apd`.*, `vrd`.*, urtt.courier_no
                FROM request
                INNER JOIN request_assignee ON request_assignee.request_id = request.uralensis_request_id
                LEFT JOIN request_autopsy_detail apd ON apd.request_id = request.uralensis_request_id
                LEFT JOIN request_virology_detail vrd ON vrd.request_id = request.uralensis_request_id
                LEFT JOIN uralensis_record_track_template AS urtt ON urtt.ura_rec_temp_id = request.template_id
                INNER JOIN users ON request_assignee.user_id = users.id
                WHERE request.patient_id = $id ")->result();
            }
        }
    }

    public function patient_detail_show($id=906){
        $patient = $this->db->query("SELECT * FROM `patients` WHERE id = $id")->result();
        if(count($patient) > 0) {
            $this->load->helper('file');
            $content = $this->text_file_content($patient[0]);
            $patient[0]->request_details = $this->db->query("
                SELECT users.id,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,
                    AES_DECRYPT(company, '" . DATA_KEY . "') AS company,
                    AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
                    AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
                    AES_DECRYPT(email, '" . DATA_KEY . "') AS email,
                    AES_DECRYPT(username, '" . DATA_KEY . "') AS username,patient_id as p_id,
                    uralensis_request_id, record_batch_id, 
                    serial_number, ura_barcode_no, 
                    patient_initial,patient_id, pci_number, 
                    request_datetime, publish_datetime,
                    publish_datetime_modified, emis_number, 
                    nhs_number, lab_number, hos_number, sur_name,
                    
                    /*f_name, dob, age, lab_id, lab_name, date_received_bylab, 
                    data_processed_bylab, date_sent_touralensis,
                    date_rec_by_doctor, gender, clrk, dermatological_surgeon, 
                    date_taken, urgent, hsc, report_urgency, cl_detail, specimen_id,
                    request.status, specimen_update_status, specimen_publish_status, 
                    further_work_status, supplementary_report_status, supplementary_review_status, 
                    report_status, publish_status, hospital_group_id, additional_data_state,
                    comment_section, comment_section_date, teaching_case, mdt_case,
                    mdt_case_status, mdt_list_id, mdt_specimen_status, 
                    mdt_case_assignee_username, mdt_case_msg, mdt_case_msg_timestamp, 
                    mdt_case_add_to_report_status, mdt_outcome_text, fw_levels, fw_immunos,
                    fw_imf, special_notes, special_notes_date, record_secretary_id, 
                    record_assign_sec_time, record_secretary_status, secretary_record_edit_status,
                    cases_category, cost_codes, flag_status, authorize_status, request_add_user, 
                    request_add_user_timestamp, clinic_ref_number, clinic_request_form, 
                    request_code_status, record_edit_status, ura_rec_temp_dataset, remote_record, `location`, `apd`.*, `vrd`.*, urtt.courier_no,*/
                    
                    courier.*, courier.sender_email as sender_name, courier.receiver_email as receiver_name
                FROM request
                INNER JOIN request_assignee ON request_assignee.request_id = request.uralensis_request_id
                LEFT JOIN request_autopsy_detail apd ON apd.request_id = request.uralensis_request_id
                LEFT JOIN request_virology_detail vrd ON vrd.request_id = request.uralensis_request_id
                LEFT JOIN uralensis_record_track_template AS urtt ON urtt.ura_rec_temp_id = request.template_id
                LEFT JOIN tbl_courier AS courier ON courier.id = request.emis_number
                INNER JOIN users ON request_assignee.user_id = users.id
                WHERE request.patient_id = $id ")->result();

            pre($patient[0], false);
            pre("<hr>$content");
        }
    }

    private function text_file_content($data){

        /* Patient Details */
        $senderName = $data->sender_name;
        $senderCompany = $data->sender_company;
        $receiverName = $data->receiver_name;
        $receiverCompany = $data->receiver_company;
        $pFirstName = $data->first_name;
        $pLastName = $data->last_name;
        $pDob = $data->dob;
        $pGender = ($data->gender == 'Male') ? 'M' : 'F';
        $pId1 = $data->p_id_1;
        $pId2 = $data->p_id_2;

        $res = '';
        $res .= "MSH|^~\&|Best Practice 1.12.0.965|BP099999|$receiverName|$receiverCompany|20220222162828+1000||ORM^O01|9999920220222.42743AFE00|P|2.4|121||NE|AL|AU\n";
        $res .= "PID|1||73^^^BPS^PI~8003606789131483^^^AUSHIC^NI||$pFirstName^$pLastName^^^^^L||19451214|$pGender||9^Not Stated/Inadequately Described^602543|76 Frederick St^^Woodlane^SA^5254^^1||^PRN^CP^^^^0468955011\n";
        return $res;
    }
}