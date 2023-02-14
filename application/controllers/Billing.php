<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Admin Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <firebug.j@gmail.com>
 * @version    1.0.0
 */
class Billing extends CI_Controller
{
    
    /**
     * Constructor to load models and helpers
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->load->model('billing_model');
        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));
        track_user_activity(); //Track user activity function which logs user track actions.
    }
    
    public function invoice()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('billing/inc/header-new');
        $this->load->view('billing/invoice');
        $this->load->view('billing/inc/footer-new');
    }
    public function create_invoice()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('billing/inc/header-new');
        $this->load->view('billing/create-invoice');
        $this->load->view('billing/inc/footer-new');
    }
    public function view_invoice()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('billing/inc/header-new');
        $this->load->view('billing/view-invoice');
        $this->load->view('billing/inc/footer-new');
    }

    public function bill_track(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $groupData = $this->ion_auth->get_users_main_groups()->row();
        $userId = $this->session->userdata('user_id');
        $groupId = $groupData->id;
        $groupType = $groupData->group_type;

        $currentGroupType = $this->ion_auth->get_users_groups()->row()->group_type;
        if(in_array($currentGroupType, ['D'])){
            return redirect('billing/invoice_list');
        }

//        $currentGroupType = $this->ion_auth->get_users_groups()->row()->group_type;
//        if(in_array($groupType, ['H', 'HA']) || in_array($currentGroupType, ['D'])){
//            return redirect('billing/bill_report');
//        }

        $data = array();
        $data['result'] = $this->billing_model->bill_track_data($userId, $groupId);
        $data['is_invoice_generate'] = (in_array($groupType, ['L', 'LA'])) ? true : false;

        $this->load->view('templates/header-new');
        $this->load->view('billing/bill_track', $data);
        $this->load->view('templates/footer-new');
    }

    public function bill_report(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $groupData = $this->ion_auth->get_users_main_groups()->row();
        $userId = $this->session->userdata('user_id');
        $groupId = $groupData->id;
        $groupType = $groupData->group_type;

        $currentGroupType = $this->ion_auth->get_users_groups()->row()->group_type;
        if(in_array($currentGroupType, ['D'])){
            return redirect('billing/invoice_list');
        }
//        if(!in_array($currentGroupType, ['L', 'LA'])){
//            return redirect('billing/bill_track');
//        }

//        $idArr = $this->billing_model->get_clinic_ids($userId, $groupId);
//        $clinicIdArr = array_column($idArr, 'id');
////pre($clinicIdArr);
///
        $data = array();
        $data['clinic_id'] = $groupId;
        //$data['result'] = $this->billing_model->bill_track_data($userId, $groupId);
        $data['is_invoice_generate'] = ((in_array($groupType, ['L', 'LA']) || in_array($currentGroupType, ['A'])) && $currentGroupType != 'D') ? true : false;

        $this->load->view('templates/header-new');
        $this->load->view('billing/bill_report', $data);
        $this->load->view('templates/footer-new');
    }

    public function invoice_list(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $groupData = $this->ion_auth->get_users_main_groups()->row();
        $groupType = $groupData->group_type;
        //$userId = $this->session->userdata('user_id');
        //$groupId = $groupData->id;

        $data = array();
        //$data['clinic_id'] = $groupId;
        //$data['is_change_status'] = (in_array($groupType, ['H', 'HA'])) ? false : true;
        $currentGroupType = $this->ion_auth->get_users_groups()->row()->group_type;
        $data['is_change_status'] = (in_array($groupType, ['L', 'LA']) && $currentGroupType != 'D') ? true : false;

        $this->load->view('templates/header-new');
        $this->load->view('billing/invoice_list', $data);
        $this->load->view('templates/footer-new');
    }

    public function get_single_bill_track_data($clinicId){
        $userId = $this->session->userdata('user_id');
        $groupId = $this->ion_auth->get_users_main_groups()->row()->id;
        //$groupId = $this->ion_auth->get_users_groups()->row()->id;

        $data = array('data' => array());
        $res = $this->billing_model->bill_track_data_for_single($userId, $groupId, $clinicId);

        $cnt = 0;
        foreach ($res as $row){
            $cnt++;
            $billTrack = array(
                'count'         => $cnt,
                'lab_number'    => $row["lab_number"],
                'pci_number'    => $row["pci_number"],
                'specimen'      => $row["specimen"],
                'bill_price'    => $row["bill_price"],
                //'clinic'        => $row["clinic"],
                'request_date'  => date('d/m/Y', strtotime($row["request_datetime"])),
                'created_at'    => date('d/m/Y', strtotime($row["created_at"])),
                'bill_code'     => $row["bill_code_text"],
                'id'            => $row["id"],
                'invoice_path'  => $row["invoice_path"]
            );
            array_push($data['data'], $billTrack);
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function get_bill_track_data($clinicId){
        $userId = $this->session->userdata('user_id');
        $groupId = $this->ion_auth->get_users_main_groups()->row()->id;
        //$groupId = $this->ion_auth->get_users_groups()->row()->id;

        $data = array('data' => array());
        $res = $this->billing_model->bill_track_data_for_all($userId, $groupId, $clinicId);

        $cnt = 0;
        foreach ($res as $row){
            $cnt++;
            $billTrack = array(
                'count'         => $cnt,
                'lab_number'    => $row["lab_number"],
                'pci_number'    => $row["pci_number"],
                'specimen'      => $row["specimen"],
                'bill_price'    => $row["bill_price"],
                //'clinic'        => $row["clinic"],
                'request_date'  => date('d/m/Y', strtotime($row["request_datetime"])),
                'created_at'    => date('d/m/Y', strtotime($row["created_at"])),
                'bill_code'     => $row["bill_code_text"],
                'id'            => $row["id"],
                'invoice_path'  => $row["invoice_path"]
            );
            array_push($data['data'], $billTrack);
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function get_invoice_track_data(){
        $userId = $this->session->userdata('user_id');
        $groupData = $this->ion_auth->get_users_main_groups()->row();
        $groupId = $groupData->id;
        $groupType = $groupData->group_type;
        $currentGroupType = $this->ion_auth->get_users_groups()->row()->group_type;
        $is_delete = ((in_array($groupType, ['L', 'LA']) || in_array($currentGroupType, ['A'])) && $currentGroupType != 'D') ? true : false;

        $idArr = $this->billing_model->get_clinic_ids($userId, $groupId);
        $clinicIdArr = array_column($idArr, 'id');

        $data = array('data' => array());
        $res = $this->billing_model->get_invoice_data($clinicIdArr);

        $cnt = 0;
        foreach ($res as $row){
            $cnt++;
            $invoiceDate = date('d M, Y', strtotime($row["created_at"]));
            $dueDateVal = (!empty($row["due_date"])) ? $row["due_date"] : (date('Y-m-d', strtotime("+1 month", strtotime($row["created_at"]))));
            $dueDate = date('d M, Y', strtotime($dueDateVal));
            $invoiceData = array(
                'count'             => $cnt,
                'invoice_number'    => $row["invoice_number"],
                'clinic'            => $row["clinic"],
                'quantity'          => $row["quantity"],
                'amount'            => (!empty($row["amount"]) ? $row["amount"] : '0.00'),
                'status'            => $row["status"],
                'invoice_date'      => $invoiceDate,
                'invoice_due_date'  => $dueDate,
                'file_path'         => base_url($row["file_path"]),
                'id'                => $row["id"],
                'is_delete'         => $is_delete,
                'delete_url'        => base_url('billing/delete_invoice/') . $row["id"],
            );
            array_push($data['data'], $invoiceData);
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function addBillingDataFromCsv(){

        if($_REQUEST) {
            $errors = [];
            $fileName = $_FILES["UploadCSV"]["tmp_name"];
            if ($_FILES["UploadCSV"]["size"] > 0){
                $i = 0;
                $count = 0;
                $file = fopen($fileName, "r");
                $hospitalId = $this->ion_auth->get_users_main_groups()->row()->id;
                $loginUserId = $this->ion_auth->user()->row()->id;

                while (($column = fgetcsv($file, 10000, ",")) !== FALSE){
                    if ($i >= 1) {

                        if (isset($column[0])){
                            $clinic = $this->db->where_in('group_type', ['H','L','LA'])->get_where('groups', ['description' => $column[0]]);
                            if($clinic->num_rows() == 0){
                                $clinicID = $this->add_clinic($column[0]); //add new clinic
                                if($clinicID){
                                    $bData['clinic_id'] = $clinicID;
                                }else{
                                    $errors[] = "Clinic ($column[0]) not inserted proper. So, this clinic related billing code not added.";
                                    continue;
                                }
                            }else{
                                $bData['clinic_id'] = $clinic->row()->id;
                            }
                        }

                        if (isset($column[1])) {
                            $bData['type'] = $column[1];
                        }

                        if (isset($column[2])) {
                            $bData['category'] = $column[2];
                        }

                        if (isset($column[3])) {
                            $bData['bill_code'] = $column[3];
                        }

                        if (isset($column[4])) {
                            $bData['bill_description'] = $column[4];
                        }

                        if (isset($column[5])) {
                            $bData['specimen_type_id'] = $column[5];
                            $specimen_type = $this->db->get_where('specimen_type', ['type' => $column[5]]);
                            if($specimen_type->num_rows() == 0){
                                $this->db->insert('specimen_type', [
                                    'type'          => $column[5],
                                    'spec_group_id' => 1,
                                    'created_by'    => $loginUserId,
                                    'updated_by'    => $loginUserId,
                                    'created_at'    => date("Y-m-d H:i:s"),
                                    'updated_at'    => date("Y-m-d H:i:s")
                                ]);
                                $bData['specimen_type_id'] = $this->db->insert_id();
                            }else{
                                $bData['specimen_type_id'] = $specimen_type->row()->spec_type_id;
                            }
                        }

                        if (isset($column[6])) {
                            $bData['price'] = $column[6];
                        }

                        if (isset($column[7])) {
                            $bData['tissue_type'] = $column[7];
                        }

                        $bData['created_by'] = $loginUserId;
                        $bData['updated_by'] = $loginUserId;
                        $bData['created_at'] = date("Y-m-d H:i:s");
                        $bData['updated_at'] = date("Y-m-d H:i:s");

                        $this->db->insert('billing_data', $bData);
                        $count++;
                    }
                    $i++;
                }
                if($count > 0){
                    $this->session->set_flashdata('success', "Total $count billing records are import successfully.");
                }else{
                    $errors[] = 'No records are imported successfully';
                }
                $this->session->set_flashdata('error', implode('<br>', $errors));
            } else {
                $this->session->set_flashdata('error', 'Something went wrong, Please Try Again..!');
            }
        } else {
            $this->session->set_flashdata('error', 'Something went wrong, Please Try Again..!');
        }
        redirect('laboratory/billing', 'refresh'); exit;
    }

    private function add_clinic($clinicName){
        $clinic = explode(' ', $clinicName, 2);
        $username = strtolower(str_replace(' ', '_', $clinicName));

        $this->load->model('Admin_model');

        $new_group_id = $this->ion_auth->create_group_main(
            strtolower(str_replace(' ', '', $clinicName)),
            $clinic[0][0],
            $clinic[1][0],
            $clinicName,
            'H',
            $clinicName,
            '',
            'usergroup'
        );

        if ($new_group_id) {
            $user_type = 'HA';
            $group_id = $new_group_id;
            $profile_picture = DEFAULT_PROFILE_PIC;
            $shortName = $clinic[0][0] . $clinic[1][0];
            $email = $shortName .time() . '@yopmail.com';
            $identity = $shortName .time() . '@yopmail.com';
            $password = "$shortName@123";

            $this->Admin_model->insertHospitalInformation([
                'group_id'          => $new_group_id,
                'hosp_address'      => '',
                'hosp_country'      => '',
                'hosp_city'         => '',
                'hosp_state'        => '',
                'hosp_post_code'    => '',
                'hosp_email'        => $email,
                'hosp_phone'        => '',
                'site_identifier'   => '',
                'identifier'        => ''
            ]);

            $additional_data = [
                'username'              => $this->db->escape($username),
                'first_name'            => $this->db->escape($clinic[0]),
                'last_name'             => $this->db->escape($clinic[1]),
                'company'               => $this->db->escape($clinicName),
                'phone'                 => $this->db->escape('9999988888'),
                'memorable'             => $this->db->escape('helloworld'),
                'is_hospital_admin'     => 1,
                'profile_picture_path'  => $this->db->escape($profile_picture),
                'user_type'             => $this->db->escape($user_type),
                'group_id'              => ""
            ];

            $groups_array = array();
            if ($group_id !== -1) {
                $groups_array = array($group_id);
            }
            $user_ids=$this->ion_auth->register($identity, $password, $email, $additional_data, $groups_array,0);
            if ($user_ids) {
                return $new_group_id;
            }
        }
        return false;
    }

    public function preview_pdf(){
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $clinicId = $this->input->post('clinic_id');
            $billingIdArr = $this->input->post('billing_id_arr');
            $invoiceNumber = time();
            $data = $this->get_invoice_data($clinicId, $invoiceNumber, $billingIdArr);
            $invoice_view = $this->load->view('billing/preview-invoice', $data, TRUE);
            $dataArr = [
                'status' => "success",
                'message' => 'Invoice PDF view successfully',
                'html' => $invoice_view
            ];
        }else{
            $dataArr = ['status' => "error", 'message' => 'Something went wrong, Please Try Again.'];
        }
        echo json_encode($dataArr);exit;
    }

    public function generate_pdf(){
        $dataArr = ['status' => "error", 'message' => 'Something went wrong, Please Try Again.'];
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $res = $this->manage_pdf($this->input->post());
            if($res){
                $dataArr = ['status' => "success", 'message' => 'Invoice PDF save successfully'];
            }
        }
        echo json_encode($dataArr);exit;
    }

    private function manage_pdf($postArr){

        $clinicId = $postArr['clinic_id'];
        $invoiceNumber = $postArr['invoice_number'];
        $totalAmount = $postArr['total_amount'];
        $quantity = $postArr['quantity'];
        $billingIdArr = $postArr['billing_id_arr'];

        $data = $this->get_invoice_data($clinicId, $invoiceNumber, $billingIdArr);
        $this->load->view('billing/generate-invoice', $data);

        // Get output html
        $html = $this->output->get_output();
        //$html = $this->load->view('billing/preview-invoice', $data, true);

        // Load pdf library
        $this->load->library('pdf');

        // Load HTML content
        $this->dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper('A4', 'portrait'); //landscape

        // Render the HTML as PDF
        $this->dompdf->render();

        $fileName = "Invoice_$invoiceNumber.pdf";

        // Output the generated PDF (1 = download and 0 = preview)
        //$this->dompdf->stream($fileName, array("Attachment"=>0));

        $output = $this->dompdf->output();
        $pdf_path = "./uploads/pdf_files/" . $fileName;
        if (file_put_contents($pdf_path, $output)) {
            $userId = $this->session->userdata('user_id');
            $this->db->insert('invoice', [
                'clinic_id'      => $clinicId,
                'invoice_number' => $invoiceNumber,
                'quantity'       => $quantity,
                'amount'         => $totalAmount,
                'due_date'       => date("Y-m-d", strtotime("+1 month", time())),
                'file_path'      => $pdf_path,
                'created_by'     => $userId,
                'updated_by'     => $userId
            ]);
            if($this->db->insert_id()){
                $this->db->where_in('id', $billingIdArr)->update('request_billing_code', ['invoice_path' => $pdf_path]);
                return true;
            }
        }
        return false;
        //exit;




//        $result = $this->get_invoice_data($clinicId);
//        $data['invoiceHtml'] = $result;
//        $this->load->view('billing/generate-invoice', $data);

//        $data['invoiceHtml'] = $this->load->view('billing/preview-invoice', $result, TRUE);
//        //pre($data);
//        $this->load->view('billing/generate-invoice', $data);
    }

    public function get_invoice_data($clinicId, $invoiceNumber, $billingIdArr=[]){
        $userId = $this->session->userdata('user_id');
        $groupId = $this->ion_auth->get_users_main_groups()->row()->id;

        //$result = $this->billing_model->bill_track_invoice_data($userId, $groupId, $clinicId, $billingIdArr);
        $result = $this->billing_model->bill_track_invoice_data($clinicId, $billingIdArr);
        if($result && count($result) > 0) {
            if(isset($result[0]['user_id'])){
                $assignedUserId = $result[0]['user_id'];
                $userInfo = $this->ion_auth->user($assignedUserId)->row();
                $userInfo->data = $this->db->get_where('usermeta', ['user_id' => $assignedUserId])->result_array();
                $data['userInfo'] = $userInfo;
            }
            if(isset($result[0]['lab_id'])){
                $data['labInfo'] = $this->billing_model->get_lab_info($result[0]['lab_id']);
            }
            $data['invoiceNumber'] = $invoiceNumber;
            $data['billingIdArr'] = $billingIdArr;
        }
        $data['payment_info'] = $this->db->get('payment_info')->row()->detail;
        $data['result'] = $result;
        return $data;
    }

    public function delete_invoice($id){
        if(!empty($id) && $id > 0){
            $data = $this->db->get_where('invoice', ['id' => $id]);
            if($data->num_rows() > 0){
                $row = $data->row();
                unlink($row->file_path);
                $res = $this->db->where('id', $id)->delete('invoice');
                if($res){
                    $this->session->set_flashdata('success', 'Invoice delete successfully');
                    redirect('billing/invoice_list');
                }else{
                    $this->session->set_flashdata('error', 'Something went wrong, Please Try Again.');
                }
            }else{
                $this->session->set_flashdata('error', 'Record not found, Please try again.');
            }
        }else{
            $this->session->set_flashdata('error', 'Record ID not valid.');
        }
        redirect("billing/invoice_list", "refresh");exit;
    }

    public function update_invoice_status(){
        $dataArr = ['status' => "error", 'message' => 'Something went wrong, Please Try Again.'];
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $id = $this->input->post('invoice_id');
            $status = $this->input->post('status');
            $res = $this->db->update('invoice', ['status' => $status], ['id' => $id]);
            if($res){
                $dataArr = ['status' => "success", 'message' => 'Invoice status update successfully'];
            }
        }
        echo json_encode($dataArr);exit;
    }

}