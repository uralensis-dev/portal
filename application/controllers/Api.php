<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . "libraries/RestController.php");

use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Api_model');
        $this->load->model('Userextramodel');
        $this->load->model('Admin_model');
        $this->load->helper(array('ec_helper'));
    }

    function user_get()
    {
        $data = array('returned:' . $this->get('id'));
        $this->response($data);
    }

    function user_post() {
        $this->response(['message' =>'Posted'], 200);
    }


    /****
  get profile using email id
     */
    function userprofile_post()
    {
        $this->load->model('Ion_auth_model');
        $email =  $this->post('email');

        $userdt = $this->Userextramodel->getuserId($email);

        $result = $this->Api_model->getUserDecryptedDetailsByid($userdt[0]->id);


        $metainfo = $this->Api_model->getMetainfoofuser($userdt[0]->id);

        if (count($result) > 0) {
            $this->response(["status" => "success", "data" => array_merge($result, $metainfo)], REST_Controller::HTTP_OK);
        }
        if (count($result) == 0) {
            $this->response(["status" => "error", "message" => "profile incomplete"], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function register_post()
    {
        $this->load->model('Ion_auth_model');
        $email =  $this->post('email');
        $password =   $this->post('password');


        $result = $this->Ion_auth_model->getregisterapiuser($email, $password);
        if ($result == 1) {
            $this->response(["status" => "error", "message" => "account_creation_duplicate_identity."], REST_Controller::HTTP_BAD_REQUEST);
        }
        if ($result == 0) {
            $this->response(["status" => "error", "message" => "Password is null."], REST_Controller::HTTP_BAD_REQUEST);
        }
        if ($result == 2) {
            $this->response([
                "status" => "success",
                'message' => 'User Account Created But not active.',
            ], REST_Controller::HTTP_OK);
        }
        // $this->response($r);
    }
    function emailExist_post()
    {
        $email =  $this->post('email');
        $userdt = $this->Userextramodel->getuserId($email);
        if ($userdt[0]->id != "") {
            $this->response(["status" => "success", "message" => "Email Exists"], REST_Controller::HTTP_OK);
            exit;
        } else {

            $this->response(["status" => "error", "message" => "Email not Exists"], REST_Controller::HTTP_BAD_REQUEST);
            exit;
        }
    }
    function caserecordupload_post()
    {
        $this->load->model('Ion_auth_model');
        $this->load->model('Institute_model');
        $this->load->model('Doctor_model');
        $email =  $this->post('email');
        $firstName =   $this->post('firstName');
        $lastName =   $this->post('lastName');
        $gender =   $this->post('gender');
        $address1 =   $this->post('address1');
        $dateOfBirth =   $this->post('dateOfBirth');
        $address2 =   $this->post('address2');
        $city =   $this->post('city');
        $state =   $this->post('state');
        $country =   $this->post('country');
        $zip =   $this->post('zip');
        $phone =   $this->post('phone');
        $user_id = $this->post('userid');
        $status = $this->post('status');
        $slides = $this->post('slides');
        $macroDescription =  $this->post('macroDescription');
        $numberOfSlides = $this->post('numberOfSlides');
        $numberOfBlocks = $this->post('numberOfBlocks');
        $blockDetail = $this->post('blockDetail');
        $documents = $this->post('documents');
        $media = $this->post('media');
        $userdt = $this->Userextramodel->getuserId($email);

        $result = $this->Api_model->getUserDecryptedDetailsByid($userdt[0]->id);
        $clinic_user_id = $userdt[0]->id;

        $record_edit_status = array(
            'patient_initial' => 'no',
            'f_name' => $firstName,
            'sur_name' => $lastName,
            'emis_number' => 'no',
            'lab_number' => 'no',
            'dob' => $dateOfBirth,
            'date_received_bylab' => 'no',
            'date_sent_touralensis' => 'no',
            'rec_by_doc_date' => 'no',
            'clrk' => 'no',
            'dermatological_surgeon' => 'no',
            'pci_number' => 'no',
            'nhs_number' => 'no',
            'lab_name' => 'no',
            'gender' => $gender,
            'date_taken' => 'no',
            'report_urgency' => 'no',
            'cases_category' => 'no'
        );
        $request = array(
            'serial_number' => 00,
            'ura_barcode_no' => 'no',
            'hospital_group_id' => 0,
            'report_urgency' =>  '',
            'lab_name' =>  '',
            'status' => intval(0),
            'request_code_status' => 'new',
            'record_edit_status' => serialize($record_edit_status),
            'request_add_user' => $user_id,
            'request_add_user_timestamp' => time()
        );
        $this->Institute_model->institute_insert($request);

        $record_last_id = $this->db->insert_id();
        $specimen = array(
            'request_id' => $record_last_id,
            'specimen_status' => $status,
            'specimen_site' => '',
            'specimen_procedure' => '',
            'specimen_type' => '',
            'specimen_block' => '',
            'specimen_slides' => $slides,
            'specimen_block_type' => '',
            'specimen_macroscopic_description' => $macroDescription,
            'specimen_diagnosis_description' => '',
            'specimen_cancer_register' => '',
            'specimen_rcpath_code' => '',
            'numberOfSlides' => $numberOfSlides,
            'numberOfBlocks' => $numberOfBlocks,
            'blockDetail' => $blockDetail,
            'documents' => $documents,
            'media' => $media
        );
        $this->db->insert('specimen', $specimen);
        $specimen_id = $this->db->insert_id();
        $data = array('rs_request_id' => $record_last_id, 'rs_specimen_id' => $specimen_id);
        $this->db->insert('request_specimen', $data);
        $user_req_data = array(
            'request_id' => $record_last_id,
            'users_id' => $clinic_user_id,
            'group_id' => 1
        );
        $this->db->insert("users_request", $user_req_data);
        $request_assign = array(
            'request_id' => $record_last_id,
            'user_id' => 0,
        );
        $this->db->insert("request_assignee", $request_assign);
        $assign_request_args = array(
            'assign_status' => intval(1),
            'report_status' => intval(1),
            'request_code_status' => 'assign_doctor',
            'request_assign_status' => intval(1)
        );
        $this->db->where('uralensis_request_id', $record_last_id);
        $this->db->update("request", $assign_request_args);



        $this->response([
            "status" => "success",
            'message' => 'record updated',
        ], REST_Controller::HTTP_OK);
        exit;
    }

    /**
     * Record api
     *
     * @param int $id
     * @return void
     */
    function getPatientRecords_post()
    {
        $userdt = $this->Userextramodel->getuserId($this->post('userid'));
        $list = getRecords('*', 'request', array('request_add_user' => $userdt[0]->id));


        $this->response(["status" => "success", "data" => $list], REST_Controller::HTTP_OK);
    }
    function userupdate_post()
    {

        $this->load->model('Ion_auth_model');
        $email =  $this->post('email');
        $firstName =   $this->post('firstName');
        $lastName =   $this->post('lastName');
        $gender =   $this->post('gender');
        $address1 =   $this->post('address1');
        $dateOfBirth =   $this->post('dateOfBirth');
        $address2 =   $this->post('address2');
        $city =   $this->post('city');
        $state =   $this->post('state');
        $country =   $this->post('country');
        $zip =   $this->post('zip');
        $phone =   $this->post('phone');

        if ($_FILES['profilePicture']) //when user submit basic profile info with profile image
        {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size'] = '10000';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('profilePicture')) {
                $this->response(["status" => "error", "message" => "File Upload not Completed."], REST_Controller::HTTP_BAD_REQUEST);
                exit;
            } else {
                $filedata = array('upload_data' => $this->upload->data());
                $profile_image = base_url() . 'uploads/' . $filedata['upload_data']['file_name'];
                $error = 1;
            }
        }

        $meta_data_user_detail = array(
            'dob' => $this->input->post('dateOfBirth'),
            'address1' => $this->input->post('address1'),
            'gender' => $this->input->post('gender'),
            'address2' => $this->input->post('address2'),
            'city' => $this->input->post('city'),
            'country' => $this->input->post('country'),
            'zip' => $this->input->post('zip')
        );
        $userdt = $this->Userextramodel->getuserId($email);


        foreach ($meta_data_user_detail as $key => $value) {
            //Check if Specific data exists in DB
            $db_meta = $this->db->where('user_id', $userdt[0]->id)->where('meta_key', $key)->get('usermeta')->row_array();
            if (!empty($db_meta)) {
                $this->db->where('user_id', $db_meta['user_id'])
                    ->where('meta_key', $db_meta['meta_key'])
                    ->update(
                        'usermeta',
                        array('meta_value' => $value)
                    );
            } else {
                if (!empty($value)) {
                    $this->db->insert('usermeta', array('user_id' => $userdt[0]->id, 'meta_key' => $key, 'meta_value' => $value));
                }
            }
        }


        $result = $this->Api_model->UpdateBasicInfoUserDoctor($firstName, $lastName, $phone, $email, $userdt[0]->id, $profile_image);
        if ($result == 1) {
            $this->response(["status" => "success", "message" => "information updated!!."], REST_Controller::HTTP_OK);
        }
        if ($result == 0) {
            $this->response(["status" => "error", "message" => "Something went wrong."], REST_Controller::HTTP_BAD_REQUEST);
        }
        // $this->response($r);
    }

    function login_post()
    {
        $this->load->model('Ion_auth_model');
        $email =  $this->post('email');
        $password =   $this->post('password');


        $result = $this->Ion_auth_model->loginapi($email, $password);


        if ($result == 0) {
            $this->response(["status" => "error", "message" => "username or password is empty."], REST_Controller::HTTP_BAD_REQUEST);
        }
        if ($result == 1) {
            $this->response([
                "status" => "error",
                'message' => 'Login attempts exceeded your account is blocked.',
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        if ($result == 2) {
            $this->response([
                "status" => "error",
                'message' => 'User Account is not active.',
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        if ($result == 3) {
            $this->response([
                "status" => "success",
                'message' => 'user is valid login successfull.',
            ], REST_Controller::HTTP_OK);
        }
    }

    function specimenslide_post()
    {
        $this->load->model('Ion_auth_model');
        $specimen_id = $this->post('specimen_id');
        $url = $this->post('slide_url');
        $thumbnail = $this->post('thumbnail');
        $slide_name = $this->post('slide_name');

        $res = $this->Api_model->insertSpecimenSlide($specimen_id, $url, $thumbnail, $slide_name);
        if (!$res) {
            $res = array('status' => 'error', 'message' => 'Empty Param');
            $this->response($res, REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $res = array('status' => 'success', 'message' => 'Successfully added slide');
            $this->response($res, REST_Controller::HTTP_OK);
        }
    }

    function user_put()
    {
        $data = array('returned: ' . $this->put('id'));
        $this->response($data);
    }

    function user_delete()
    {
        $data = array('returned: ' . $this->delete('id'));
        $this->response($data);
    }

    // Base_url/api/add_slide_to_specimen
    function addSlideToSpecimen_post() {
        // lab_number
        // req_identifier
        // array [{url, thumbnail, slide_name}]
        $lab_number = $this->post("req_identifier");
        $slide_array = $this->post("slide_array");
        $res = $this->db->get_where('request', array('lab_number' => $lab_number))->result_array();
        if (empty($res)) {
            $this->response(array('status' => 'error', 'message' => 'Request not found'), REST_Controller::HTTP_BAD_REQUEST);
        }
        $request_id = $res[0]['uralensis_request_id'];
        $res = $this->db->get_where('request_specimen', array('rs_request_id' => $request_id))->result_array();
        if (empty($res)) {
            $this->response(array('status' => 'error', 'message' => 'Specimen not found'), REST_Controller::HTTP_BAD_REQUEST);
        }
        $specimen_id = $res[0]['rs_specimen_id'];
        foreach ($slide_array as $slide) {
            // Check if slide_name exits in DB
            $slide_name = $slide['slide_name'];
            $res = $this->db->get_where('specimen_slide', array('specimen_id' => $specimen_id, 'slide_name' => $slide_name))->result_array();
            if (empty($res)) {
                $this->db->insert('specimen_slide', array('specimen_id' => $specimen_id, 'url' => $slide['url'], 'thumbnail' => $slide['thumbnail'], 'slide_name' => $slide['slide_name']));
            }
        }
        // Respond with success
        $this->response(array('status' => 'success', 'message' => 'Slide added successfully'), REST_Controller::HTTP_OK); 
    }
}
