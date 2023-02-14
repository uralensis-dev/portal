<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Invoice Model
 *
 * @package    CI
 * @subpackage Model
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */
Class Invoice_model extends CI_Model {
    #get test against LAB
    #currently we dont have any mapping of labs and departments in session
    #therefore, we get all tests

    public function getLabTests() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM laboratory_test_category where id IN (1,2,3)");
//        echo $this->db->last_query(); exit;

        return $query->result();
    }

    public function getLabDepartments() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM departments");
//        echo $this->db->last_query(); exit;

        return $query->result();
    }

    public function getBillingCodes() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM billing_codes");
//        echo $this->db->last_query(); exit;

        return $query->result();
    }

    public function getBillingCodesName() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_billing_code_setup");
//        echo $this->db->last_query(); exit;

        return $query->result();
    }
	
	public function getCostCodesName() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query2 = $this->db->query("SELECT * FROM uralensis_cost_codes");
       //echo $this->db->last_query(); exit;
        return $query2->result();
    }

    public function priceCodeListingDetails($userId) {

        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;
        $WHERE = "1=1";
        if (true) {
            $WHERE .= " AND ups.created_by = $userId";
        }

        $query = "SELECT
                    ups.*, upc.billing_code, upc.billing_code_name, upc.code_type
                FROM
                        uralensis_pricing_setup AS ups
                INNER JOIN uralensis_pricing_code_setup upc ON ups.id = upc.billing_setup_id
                where $WHERE";
        $result = $this->db->query($query)->result_array();

        return $result;
    }

    public function priceCodeListing($userId) {

        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;
        $WHERE = "1=1";
        if (true) {
            $WHERE .= " AND uralensis_billing_code_setup.created_by = $userId";
        }

        $query = "SELECT * FROM uralensis_billing_code_setup where $WHERE"; 
                  
        $result = $this->db->query($query)->result_array();

        return $result;
    }

    public function getCodeDetails($id) {
        if ($id > 0) {
            $query = "SELECT
                    * FROM uralensis_pricing_code_setup WHERE billing_setup_id = $id";
            $result = $this->db->query($query)->result_array();

            return $result;
        } else return true; 
    }

    public function priceCodeRecord($id) {

        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;
        $WHERE = "1=1";
        if (true) {
            $WHERE .= " AND ups.id = $id";
        }

        $query = "SELECT
                    ups.*, departments.department as department_name, ltc.`name` as test_category, sg.spec_grp_name as speciality_name
                  FROM
                    uralensis_pricing_setup AS ups
                    LEFT JOIN departments ON departments.department_id = ups.lab_department
                    LEFT JOIN laboratory_test_category ltc ON ltc.id = ups.lab_test_categories
                    LEFT JOIN speciality_group sg ON sg.spec_grp_id = ups.lab_specialty
                    WHERE $WHERE ORDER BY ups.id desc";
        $result = $this->db->query($query)->result_array();

        return $result;
    }

    public function priceCodeListingAgainstCategory($category_id) {

        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;
        $WHERE = "1=1";
        if (true) {
            $WHERE .= " AND ups.lab_test_categories = $category_id";
        }

        $query = "SELECT
                    ups.*, departments.department as department_name, ltc.`name` as test_category, sg.spec_grp_name as speciality_name
                  FROM
                    uralensis_pricing_setup AS ups
                    LEFT JOIN departments ON departments.department_id = ups.lab_department
                    LEFT JOIN laboratory_test_category ltc ON ltc.id = ups.lab_test_categories
                    LEFT JOIN speciality_group sg ON sg.spec_grp_id = ups.lab_specialty
                    WHERE $WHERE ORDER BY ups.id desc";
        $result = $this->db->query($query)->result_array();

        return $result;
    }

}
