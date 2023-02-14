<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @helper function 
 * Check if Function Exists
 * 
 * @param string
 * @return Boolean
 * 
 */
if (!function_exists('check_user_role')) {

    function check_user_role($permission_key) {

        $ci = & get_instance();
        $ci->load->database();

        $user_id = $ci->ion_auth->user()->row()->id;
        $query = $ci->db->query("SELECT * FROM users
                INNER JOIN roles
                INNER JOIN user_roles
                WHERE users.id = user_roles.user_id
                AND roles.role_id = user_roles.role_id
                AND users.id = $user_id");

        $result = $query->result();

        $user_role = !empty($result[0]->role_name) ? $result[0]->role_name : '';

        /**
         * Define Array of Permissions
         * Standard, Premium, Admin
         */
        $permissions = array(
            'Standard' => array(
                'profile' => true,
                'new_case' => true,
                'mdt' => true,
                'view_case' => true,
                'search_request' => true
            ),
            'Premium' => array(
                'profile' => true,
                'new_case' => true,
                'mdt' => true,
                'view_case' => true,
                'show_requestform' => true,
                'add_institute' => true,
                'show_specimen' => true,
                'add_specimen' => true,
                'view_request_detailall' => true,
                'view_singlerecord' => true,
                'further_display_work' => true,
                'search_request' => true,
                'do_upload' => true,
                'do_upload_download_section_files' => true,
                'delete_record_files' => true,
                'delete_download_section_files' => true,
                'upload_center' => true,
                'upload_center_request_form' => true,
                'upload_center_checklist_form' => true,
                'delete_upc_files' => true,
                'teaching_cases' => true,
                'message_center' => true,
            ),
            'Admin' => array(
                'financial' => true,
                'profile' => true,
                'new_case' => true,
                'mdt' => true,
                'view_case' => true,
                'show_requestform' => true,
                'add_institute' => true,
                'show_specimen' => true,
                'add_specimen' => true,
                'view_request_detailall' => true,
                'view_singlerecord' => true,
                'further_display_work' => true,
                'search_request' => true,
                'do_upload' => true,
                'do_upload_download_section_files' => true,
                'delete_record_files' => true,
                'delete_download_section_files' => true,
                'upload_center' => true,
                'upload_center_request_form' => true,
                'upload_center_checklist_form' => true,
                'delete_upc_files' => true,
                'teaching_cases' => true,
                'message_center' => true
            ),
            'SuperAdmin' => array(
                'financial' => true,
                'profile' => true,
                'new_case' => true,
                'mdt' => true,
                'view_case' => true,
                'show_requestform' => true,
                'add_institute' => true,
                'show_specimen' => true,
                'add_specimen' => true,
                'view_request_detailall' => true,
                'view_singlerecord' => true,
                'further_display_work' => true,
                'search_request' => true,
                'do_upload' => true,
                'do_upload_download_section_files' => true,
                'delete_record_files' => true,
                'delete_download_section_files' => true,
                'upload_center' => true,
                'upload_center_request_form' => true,
                'upload_center_checklist_form' => true,
                'delete_upc_files' => true,
                'teaching_cases' => true,
                'message_center' => true,
                'show_login_users' => false,
                'show_reports' => true
            )
        );

        /**
         * Check Permission if Role Match and 
         * Permission Key exists against this role.
         */
        if (isset($permissions[$user_role][$permission_key])) {
            return true;
        } else {
            return false;
        }
    }

}


