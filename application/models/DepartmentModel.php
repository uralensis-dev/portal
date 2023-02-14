<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DepartmentModel extends CI_Model
{
    public function fetch_hospitals()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_groups()->row();
        $group_type = $group_row->group_type;
        $group_id = $group_row->id;
        $res = array();
        if ($group_type == 'A') {
            // Get all hospitals
            $res = $this->db->get_where('groups', array('group_type' => 'H'))->result_array();
        }
        if ($group_type == 'H') {
            $res = $this->db->get_where('groups', array('id' => $group_id))->result_array();
        }
        if ($group_type == 'D') {
            $res = $this->db
                ->join('groups', 'groups.id = users_groups.institute_id')
                ->where('user_id', $user_id)
                ->where('institute_id !=', 'null')
                ->get('users_groups')->result_array();
        }
        return $res;
    }

    public function fetch_labs()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_groups()->row();
        $group_type = $group_row->group_type;
        $group_id = $group_row->id;
        $res = array();
        if ($group_type == 'A') {
            // Get all hospitals
            $res = $this->db->get_where('groups', array('group_type' => 'L'))->result_array();
        }
        if ($group_type == 'L') {
            $res = $this->db->get_where('groups', array('id' => $group_id))->result_array();
        }
        if ($group_type == 'H') {
            $res = $this->db
                ->join('hospital_group', 'groups.id = hospital_group.group_id')
                ->where('hospital_id', $group_id)
                ->get('groups')->result_array();
        }
        return $res;
    }

    public function fetch_departments($department_ids=array())
    {
        $this->db
            ->select("
        departments.department_id, departments.department as department_name, departments.created_at as department_created_at, departments.updated_at as department_updated_at,
        speciality_group.spec_grp_id as speciality_id, spec_grp_name as speciality_name,
        specialties.id as category_id,  specialties.specialty as category_name, specialties.pa as pa,
        specimen_type.spec_type_id as specimen_type_id, specimen_type.type as specimen_type
        ")
            ->join("speciality_group", "speciality_group.department_id = departments.department_id", 'left')
            ->join("specialties", "specialties.speciality_group_id = speciality_group.spec_grp_id", 'left')
            ->join("specimen_type", "specimen_type.spec_group_id = speciality_group.spec_grp_id", 'left');
        
        if (is_array($department_ids) && !empty($department_ids)) 
        {
            $ids = "(";
            foreach($department_ids as $id) {
                $ids .= $id.",";
            }

            $ids = substr_replace($ids, ")", -1);
            $this->db->where("departments.department_id in ".$ids, "", FALSE);
        }
      


        $flat_tree = $this->db->get("departments")->result_array();
        
      
        $departments = array();

        foreach ($flat_tree as $entry) {
            $d_id = $entry['department_id'];
            $s_id = $entry['speciality_id'];
            $c_id = $entry['category_id'];
            $st_id = $entry['specimen_type_id'];

            $specialties = array();
            if (!empty($s_id)) {
                $categories = array();
                if (!empty($c_id)) {
                    $categories = array(
                        $c_id => array(
                            "name" => $entry['category_name'],
                            "pa" => $entry['pa']
                        )
                    );
                }
                $specimen_types = array();
                if (!empty($st_id)) {
                    $specimen_types = array(
                        $st_id => array("name" => $entry["specimen_type"])
                    );
                }

                $specialties = array(
                    $s_id => array(
                        "name" => $entry['speciality_name'],
                        "categories" => $categories,
                        "specimen_types" => $specimen_types
                    )
                );
            }


            if (!array_key_exists($d_id, $departments)) {
                $departments[$d_id] = array(
                    "created_at" => $entry['department_created_at'],
                    "updated_at" => $entry['department_updated_at'],
                    "name" => $entry['department_name'],
                    "specialties" => $specialties
                );
                continue;
            }

            if (!empty($s_id) && !array_key_exists($s_id, $departments[$d_id]["specialties"])) {
                $departments[$d_id]['specialties'][$s_id] = array(
                    "name" => $entry["speciality_name"],
                    "categories" => $categories,
                    "specimen_types" => $specimen_types
                );
            }

            if (!empty($c_id) && !array_key_exists($c_id, $departments[$d_id]['specialties'][$s_id]['categories'])) {
                $departments[$d_id]['specialties'][$s_id]['categories'][$c_id] = array(
                    "name" => $entry['category_name'],
                    "pa" => $entry['pa']
                );
            }

            if (!empty($st_id) && !array_key_exists($st_id, $departments[$d_id]['specialties'][$s_id]['specimen_types'])) {
                $departments[$d_id]['specialties'][$s_id]['specimen_types'][$st_id] = array(
                    "name" => $entry['specimen_type'],
                );
            }   
        }

        foreach ($departments as $d_id => $dep) {
            foreach ($dep['specialties'] as $s_id => $spec) {
                $departments[$d_id]['specialties'][$s_id]['test_categories'] = $this->get_test_categories($s_id);
            }
        }

        return $departments;
    }


    public function add_hospital_department($h_id, $name, $user_id,$division)
    {
        $exists = $this->db->get_where('groups', array('id' => $h_id))->num_rows();
        if ($exists === 0) {
            throw new Exception("Hospital Not found", 404);
        }

        if (empty($name)) {
            throw new Exception("Name not provided", 400);
        }

        $exists = $this->db->get_where('department_settings', array('hospital_id' => $h_id, 'department_name' => $name))->num_rows();
        if ($exists > 0) {
            throw new Exception("Department already exists", 400);
        }

        $now = date('Y-m-d H:i:s');

        // Get last department id
        $id = $this->db
            ->select('department_id')
            ->where('`department_id` is not NULL', '', FALSE)
            ->order_by('department_id', 'DESC')
            ->limit(1)
            ->get('department_settings')
            ->result_array();
        if (empty($id)) {
            $id = 1;
        } else {
            $id = intval($id[0]['department_id']) + 1;
        }


        $data = array(
            'hospital_id' => $h_id,
            'department_id' => $id,
            'department_name' => $name,
			'division_id' => $division,
            'created_by' => $user_id,
            'updated_by' => $user_id,
            'created_at' => $now,
            'updated_at' => $now
        );

        $this->db
            ->insert('department_settings', $data);

        return $id;
    }

    public function add_hospital_specialty($h_id, $d_id, $name, $user_id)
    {
        $exists = $this->db->get_where('groups', array('id' => $h_id))->num_rows();
        if ($exists === 0) {
            throw new Exception("Hospital Not Found", 404);
        }

        $department = $this->db->get_where('department_settings', array('department_id' => $d_id, 'hospital_id' => $h_id))->result_array();
        if (empty($department)) {
            throw new Exception("Department Not Found", 404);
        }

        $department = $department[0];

        $exists = $this->db->get_where('department_settings', array('hospital_id' => $h_id, 'department_id' => $d_id, 'specialty' => $name))->num_rows();
        if ($exists > 0) {
            throw new Exception("Specialty already exists", 400);
        }

        $id = $this->db
            ->select('specialty_id')
            ->where('hospital_id', $h_id)
            ->where('department_id', $d_id)
            ->where('`specialty_id` is not NULL', '', FALSE)
            ->order_by('specialty_id', 'DESC')
            ->limit(1)
            ->get('department_settings')
            ->result_array();

        if (empty($id)) {
            $id = 1;
        } else {
            $id = intval($id[0]['specialty_id']) + 1;
        }

        $now = date('Y-m-d H:i:s');

        $data = array(
            'hospital_id' => $h_id,
            'department_id' => $department['department_id'],
            'department_name' => $department['department_name'],
            'specialty_id' => $id,
            'specialty' => $name,
            'created_at' => $now,
            'updated_at' => $now,
            'created_by' => $user_id,
            'updated_by' => $user_id
        );

        $this->db->insert('department_settings', $data);

        return $id;
    }


    public function add_hospital_category($h_id, $d_id, $s_id, $name, $pa, $user_id)
    {
        $exists = $this->db->get_where('groups', array('id' => $h_id))->num_rows();
        if ($exists === 0) {
            throw new Exception("Hospital Not Found", 404);
        }

        $specialty = $this->db->get_where('department_settings', array('specialty_id' => $s_id, 'hospital_id' => $h_id, 'department_id' => $d_id))->result_array();
        if (empty($specialty)) {
            throw new Exception("Specialty Not Found", 404);
        }

        $specialty = $specialty[0];

        $exists = $this->db->get_where('department_settings', array('hospital_id' => $h_id, 'specialty_id' => $s_id, 'category' => $name, 'department_id' => $d_id))->num_rows();
        if ($exists > 0) {
            throw new Exception("Category already exists", 400);
        }


        $id = $this->db
            ->select('category_id')
            ->where('hospital_id', $h_id)
            ->where('specialty_id', $s_id)
            ->where('department_id', $d_id)
            ->where('`category_id` is not NULL', '', FALSE)
            ->order_by('category_id', 'DESC')
            ->limit(1)
            ->get('department_settings')
            ->result_array();

        if (empty($id)) {
            $id = 1;
        } else {
            $id = intval($id[0]['category_id']) + 1;
        }

        $now = date('Y-m-d H:i:s');

        $data = array(
            'hospital_id' => $h_id,
            'department_id' => $specialty['department_id'],
            'department_name' => $specialty['department_name'],
            'specialty_id' => $specialty['specialty_id'],
            'specialty' => $specialty['specialty'],
            'category_id' => $id,
            'category' => $name,
            'pa' => $pa,
            'created_at' => $now,
            'updated_at' => $now,
            'created_by' => $user_id,
            'updated_by' => $user_id
        );

        $this->db->insert('department_settings', $data);

        return $this->db->insert_id();
    }

    
    public function add_hospital_test_category($h_id, $d_id, $s_id, $name)
    {
        $exists = $this->db->get_where('groups', array('id' => $h_id))->num_rows();
        if ($exists === 0) {
            throw new Exception("Hospital Not Found", 404);
        }

        $specialty = $this->db->get_where('department_settings', array('specialty_id' => $s_id, 'hospital_id' => $h_id, 'department_id' => $d_id))->result_array();
        if (empty($specialty)) {
            throw new Exception("Specialty Not Found", 404);
        }

        $specialty = $specialty[0];

        $data = array(
            'hospital_id' => $h_id,
            'department_id' => $specialty['department_id'],
            'speciality_id' => $specialty['specialty_id'],
            'name' => $name,
        );

        if ($this->db->get_where('hospital_test_category', $data)->num_rows() > 0) {
            throw new Exception("Test category already exists", 400);
        }
        $this->db->insert('hospital_test_category', $data);

        return $this->db->insert_id();
    }

    public function edit_hospital_test_category($id, $name) {
        $this->db->set('name', $name)
            ->where('id', $id)
            ->update('hospital_test_category');
    }

    
    public function delete_hospital_test_category($id) {
        $this->db->delete('hospital_test_category', array('id' => $id));
    }

    public function edit_hospital_department($h_id, $ids=array(), $type, $user_id, $name, $pa=0)
    {
        $exists = $this->db->get_where('groups', array('id' => $h_id))->num_rows();
        
        $now = date('Y-m-d H:i:s');
        
        if ($exists === 0) {
            throw new Exception("Hospital Not Found", 404);
        }


        switch ($type) {
            case "department":
                $department_id = $ids['department_id'];

                $exists = $this->db
                ->where('department_id !=', $department_id)
                ->where('hospital_id', $h_id)
                ->where('department_name', $name)
                ->get('department_settings')->num_rows();

                if ($exists > 0) {
                    throw new Exception("Department already exists", 400);
                }

                $data = array('department_name' => $name, 'updated_by' => $user_id, 'updated_at' => $now);
                
                $this->db
                    ->where('department_id', $department_id)
                    ->where('hospital_id', $h_id)
                    ->update('department_settings', $data);

                break;


            case "speciality":
                $department_id = $ids['department_id'];
                $specialty_id = $ids['specialty_id'];

                $exists = $this->db
                ->where('department_id', $department_id)
                ->where('specialty_id !=', $specialty_id)
                ->where('hospital_id', $h_id)
                ->where('specialty', $name)
                ->get('department_settings')->num_rows();

                if ($exists > 0) {
                    throw new Exception("Specialty already exists", 400);
                }

                $data = array('specialty' => $name, 'updated_by' => $user_id, 'updated_at' => $now);
                
                $this->db
                    ->where('department_id', $department_id)
                    ->where('specialty_id', $specialty_id)
                    ->where('hospital_id', $h_id)
                    ->update('department_settings', $data);

                break;

            case "category":
                $department_id = $ids['department_id'];
                $specialty_id = $ids['specialty_id'];
                $category_id = $ids['category_id'];

                $exists = $this->db
                ->where('department_id', $department_id)
                ->where('specialty_id', $specialty_id)
                ->where('category_id !=', $category_id)
                ->where('hospital_id', $h_id)
                ->where('category', $name)
                ->get('department_settings')->num_rows();

                if ($exists > 0) {
                    throw new Exception("Category already exists", 400);
                }

                $data = array('category' => $name, 'updated_by' => $user_id, 'updated_at' => $now, 'pa' => $pa);
                
                $this->db
                    ->where('department_id', $department_id)
                    ->where('specialty_id', $specialty_id)
                    ->where('category_id', $category_id)
                    ->where('hospital_id', $h_id)
                    ->update('department_settings', $data);

                break;

            case "specimen_type":
                $department_id = $ids['department_id'];
                $specialty_id = $ids['specialty_id'];
                $specimen_type_id = $ids['specimen_type_id'];

                $exists = $this->db
                ->where('department_id', $department_id)
                ->where('specialty_id', $specialty_id)
                ->where('specimen_type_id !=', $specimen_type_id)
                ->where('hospital_id', $h_id)
                ->where('specimen_type', $name)
                ->get('department_settings')->num_rows();

                if ($exists > 0) {
                    throw new Exception("Specimen Type already exists", 400);
                }

                $data = array('specimen_type' => $name, 'updated_by' => $user_id, 'updated_at' => $now);
                
                $this->db
                    ->where('department_id', $department_id)
                    ->where('specialty_id', $specialty_id)
                    ->where('specimen_type_id', $specimen_type_id)
                    ->where('hospital_id', $h_id)
                    ->update('department_settings', $data);

                break;

            default:
                throw new Exception("Invalid type", 400);
        }

    }

    public function delete_hospital_department($h_id, $ids=array(), $type) 
    {
        $exists = $this->db->get_where('groups', array('id' => $h_id))->num_rows();
        if ($exists === 0) {
            throw new Exception("Hospital Not Found", 404);
        }

        $this->db
        ->where('hospital_id', $h_id);

        switch ($type) {
            case "department":
                $this->db->where('department_id', $ids['department_id']);
                break;
            
            case "speciality":
                $this->db->where('department_id', $ids['department_id']);
                $this->db->where('specialty_id', $ids['specialty_id']);
                break;
            
            case "category":
                $this->db->where('department_id', $ids['department_id']);
                $this->db->where('specialty_id', $ids['specialty_id']);
                $this->db->where('category_id', $ids['category_id']);
                break;
            
            case "specimen_type":
                $this->db->where('department_id', $ids['department_id']);
                $this->db->where('specialty_id', $ids['specialty_id']);
                $this->db->where('specimen_type_id', $ids['specimen_type_id']);
                break;
            
            default:
                throw new Exception("Invalid type", 400);
        }

        $this->db
        ->delete('department_settings');

    }

    public function delete_laboratory_department($h_id, $ids=array(), $type)
    {
        $exists = $this->db->get_where('groups', array('id' => $h_id))->num_rows();
        if ($exists === 0) {
            throw new Exception("Laboratory Not Found", 404);
        }

        $this->db
        ->where('hospital_id', $h_id);

        switch ($type) {
            case "department":
                $this->db->where('department_id', $ids['department_id']);
                break;

            case "speciality":
                $this->db->where('department_id', $ids['department_id']);
                $this->db->where('specialty_id', $ids['specialty_id']);
                break;

            case "category":
                $this->db->where('department_id', $ids['department_id']);
                $this->db->where('specialty_id', $ids['specialty_id']);
                $this->db->where('category_id', $ids['category_id']);
                break;

            case "specimen_type":
                $this->db->where('department_id', $ids['department_id']);
                $this->db->where('specialty_id', $ids['specialty_id']);
                $this->db->where('specimen_type_id', $ids['specimen_type_id']);
                break;

            default:
                throw new Exception("Invalid type", 400);
        }

        $this->db
        ->delete('department_settings_labs');

    }

    public function add_hospital_specimen_type($h_id, $d_id, $s_id, $name, $user_id,$c_id=0)
    {
        $exists = $this->db->get_where('groups', array('id' => $h_id))->num_rows();
        if ($exists === 0) {
            throw new Exception("Hospital Not Found", 404);
        }

        $specialty = $this->db->get_where('department_settings', array('specialty_id' => $s_id, 'department_id' => $d_id ,'hospital_id' => $h_id))->result_array();
        if (empty($specialty)) 
		{
            throw new Exception("Specialty Not Found", 404);
        }

        $specialty = $specialty[0];

        $exists = $this->db->get_where('department_settings', array('hospital_id' => $h_id, 'specialty_id' => $s_id, 'department_id' => $d_id, 'specimen_type' => $name))->num_rows();
        if ($exists > 0) {
            throw new Exception("Specimen Type already exists", 400);
        }


        $id = $this->db
            ->select('specimen_type_id')
            ->where('hospital_id', $h_id)
            ->where('specialty_id', $s_id)
            ->where('department_id', $d_id)
            ->where('`specimen_type_id` is not NULL', '', FALSE)
            ->order_by('specimen_type_id', 'DESC')
            ->limit(1)
            ->get('department_settings')
            ->result_array();

        if (empty($id)) {
            $id = 1;
        } else {
            $id = intval($id[0]['specimen_type_id']) + 1;
        }

        $now = date('Y-m-d H:i:s');

        $data = array(
            'hospital_id' => $h_id,
            'department_id' => $specialty['department_id'],
            'department_name' => $specialty['department_name'],
            'specialty_id' => $specialty['specialty_id'],
            'specialty' => $specialty['specialty'],
            'specimen_type_id' => $id,
			'category_id' => $c_id,
            'specimen_type' => $name,
            'created_at' => $now,
            'updated_at' => $now,
            'created_by' => $user_id,
            'updated_by' => $user_id
        );

        $this->db->insert('department_settings', $data);
    }

    public function get_hospital_department($h_id)
    {
        $exists = $this->db->get_where('groups', array('id' => $h_id))->num_rows();
        if ($exists === 0) {
            throw new Exception("Hospital not found", 404);
        }

        $flat_tree = $this->db->get_where('department_settings', array('hospital_id' => $h_id))->result_array();

        $departments = array();

        foreach ($flat_tree as $entry) 
		{
            $d_id = $entry['department_id'];
            $s_id = $entry['specialty_id'];
            $c_id = $entry['category_id'];
            $st_id = $entry['specimen_type_id'];

            $specialties = array();
            if (!empty($s_id)) {
                $categories = array();
                if (!empty($c_id)) {
                    $categories = array(
                        $c_id => array(
                            "name" => $entry['category'],
                            "pa" => $entry['pa']
                        )
                    );
                }
                $specimen_types = array();
                if (!empty($st_id)) {
                    $specimen_types = array(
                        $st_id => array("name" => $entry["specimen_type"])
                    );
                }

                $specialties = array(
                    $s_id => array(
                        "name" => $entry['specialty'],
                        "categories" => $categories,
                        "specimen_types" => $specimen_types,
						"category_id" => $entry['category_id']
                    )
                );
            }

            if (!array_key_exists($d_id, $departments)) {
                $departments[$d_id] = array(
                    "created_at" => $entry['created_at'],
                    "updated_at" => $entry['updated_at'],
                    "updated_by" => $entry['updated_by'],
                    "updated_by" => $entry['created_by'],
                    "name" => $entry['department_name'],
                    "specialties" => $specialties
                );
                continue;
            }

            if (!empty($s_id) && !array_key_exists($s_id, $departments[$d_id]["specialties"])) {
                $departments[$d_id]['specialties'][$s_id] = array(
                    "name" => $entry["specialty"],
                    "categories" => $categories,
                    "specimen_types" => $specimen_types
                );
            }

            if (!empty($c_id) && !array_key_exists($c_id, $departments[$d_id]['specialties'][$s_id]['categories'])) {
                $departments[$d_id]['specialties'][$s_id]['categories'][$c_id] = array(
                    "name" => $entry['category'],
                    "pa" => $entry['pa'],
					"category_id" => $entry['category_id']
                );
            }

            if (!empty($st_id) && !array_key_exists($st_id, $departments[$d_id]['specialties'][$s_id]['specimen_types'])) {
                $departments[$d_id]['specialties'][$s_id]['specimen_types'][$st_id] = array(
                    "name" => $entry['specimen_type'],
					"category_id" => $entry['category_id']
                );
            }
        }

        foreach ($departments as $d_id => $dep) {
            foreach ($dep['specialties'] as $s_id => $spec) {
                $departments[$d_id]['specialties'][$s_id]['test_categories'] = $this->get_hospital_test_categories($h_id, $d_id, $s_id);
            }
        }

        return $departments;
    }

    public function get_laboratory_department($lab_id)
    {
        // ini_set('display_errors', 1);
        // ini_set('display_startup_errors', 1);
        // error_reporting(E_ALL);
        $exists = $this->db->get_where('groups', array('id' => $lab_id))->num_rows();
        if ($exists === 0) {          
            throw new Exception("Laboratory not found", 404);
        }

        //$flat_tree = $this->db->get_where('department_settings_labs', array('hospital_id' => $lab_id))->result_array();
        //echo '<pre>'; print_r($_SESSION);exit;
        $query = $this->db->select("dsl.*, ssc.snomed_code_desc")
            ->FROM('department_settings_labs dsl')
            ->join('speciality_snomed_codes ssc', 'dsl.hospital_id=ssc.lab_id AND dsl.department_id=ssc.department_id AND dsl.specialty_id=ssc.speciality_id AND dsl.category_id=ssc.category_id and  ssc.category_id = dsl.category_id and ssc.lab_id = '.$lab_id.' and ssc.snomed_code_desc IS NOT NULL', 'left')
            ->where('dsl.hospital_id ='.$lab_id);
        $query = $this->db->get();
        $flat_tree = $query->result_array();
        //echo $this->db->last_query();exit;
        $departments = array();

        foreach ($flat_tree as $k=> $entry) {            
            $d_id = $entry['department_id'];
            $s_id = $entry['specialty_id'];
            $c_id = $entry['category_id'];
            $subc_id = $entry['sub_category_id'];
            $st_id = $entry['specimen_type_id'];
            $specialties = array();
            if (!empty($s_id)) {                
                $categories = array();
                if (!empty($c_id)) {                    
                    if (!empty($subc_id)) {
                        $sub_categories = array(
                            $subc_id => array(
                                "name" => $entry['sub_category_name']
                            )
                        );
                    }
                    $categories = array(
                        $c_id => array(
                            "name" => $entry['category'],
                            "pa" => $entry['pa'],
                            "snomed_code_desc" => $entry['snomed_code_desc'],
                            "sub_categories" => $sub_categories
                        )
                    );
                }
                $specimen_types = array();
                if (!empty($st_id)) {
                    $specimen_types = array(
                        $st_id => array("name" => $entry["specimen_type"])
                    );
                }

                $specialties = array(
                    $s_id => array(
                        "name" => $entry['specialty'],
                        "categories" => $categories,
                        "specimen_types" => $specimen_types
                    )
                );
            }

            if (!array_key_exists($d_id, $departments)) {
                $departments[$d_id] = array(
                    "created_at" => $entry['created_at'],
                    "updated_at" => $entry['updated_at'],
                    "updated_by" => $entry['updated_by'],
                    "created_by" => $entry['created_by'],
                    "name" => $entry['department_name'],
                    "specialties" => $specialties
                );
                continue;
            }

            if (!empty($s_id) && !array_key_exists($s_id, $departments[$d_id]["specialties"])) {
                $departments[$d_id]['specialties'][$s_id] = array(
                    "name" => $entry["specialty"],
                    "categories" => $categories,
                    "specimen_types" => $specimen_types
                );
            }

            if (!empty($c_id) && !array_key_exists($c_id, $departments[$d_id]['specialties'][$s_id]['categories'])) {                
                $departments[$d_id]['specialties'][$s_id]['categories'][$c_id] = array(
                    "name" => $entry['category'],
                    "pa" => $entry['pa'],
                    "snomed_code_desc" => $entry['snomed_code_desc'],    // **** @auther GSO
                );
            }
            /**** @auther GSO - start ******/
            else if(!empty($c_id) && array_key_exists($c_id, $departments[$d_id]['specialties'][$s_id]['categories'])){
                $departments[$d_id]['specialties'][$s_id]['categories'][$c_id] = array(
                    "name" => $entry['category'],
                    "pa" => $entry['pa'],
                    "snomed_code_desc" => $departments[$d_id]['specialties'][$s_id]['categories'][$c_id]['snomed_code_desc'].', '.$entry['snomed_code_desc'],
                );
            }
            /**** @auther GSO - End ******/

            if(!empty($subc_id && !array_key_exists($subc_id, $departments[$d_id]['specialties'][$s_id]['categories'][$c_id]['sub_categories']))) {
                $departments[$d_id]['specialties'][$s_id]['categories'][$c_id]['sub_categories'][$subc_id] = array(
                    "name" => $entry['sub_category_name'],
                );
            }

            if (!empty($st_id) && !array_key_exists($st_id, $departments[$d_id]['specialties'][$s_id]['specimen_types'])) {
                $departments[$d_id]['specialties'][$s_id]['specimen_types'][$st_id] = array(
                    "name" => $entry['specimen_type'],
                );
            }
        }

        foreach ($departments as $d_id => $dep) {
            foreach ($dep['specialties'] as $s_id => $spec) {
                $departments[$d_id]['specialties'][$s_id]['tissue_type'] = $this->get_laboratory_tissue_type($lab_id, $d_id, $s_id);
                $departments[$d_id]['specialties'][$s_id]['test_categories'] = $this->get_laboratory_test_categories($lab_id, $d_id, $s_id);
            }
        }

        return $departments;
    }

    public function get_laboratory_pathology($lab_id) {
        $lab_deps = $this->get_laboratory_department($lab_id);
        foreach($lab_deps as $d_id => $dep) {
            if ($dep['name'] === "Pathology") {
                return $dep['specialties'];
            }
        }
        return null;
    }

    public function get_hospital_test_categories($hospital_id, $department_id, $speciality_id) {
        return $this->db->get_where('hospital_test_category', array('hospital_id' => $hospital_id, 'department_id' => $department_id, 'speciality_id' => $speciality_id))->result_array();
    }

    public function get_laboratory_tissue_type($hospital_id, $department_id, $speciality_id) {
        return $this->db->get_where('tissue_type', ['hospital_id' => $hospital_id, 'department_id' => $department_id, 'speciality_id' => $speciality_id])->result_array();
    }

    public function get_laboratory_test_categories($laboratory_id, $department_id, $speciality_id) {
        return $this->db->get_where('laboratory_test_category', array('laboratory_id' => $laboratory_id, 'department_id' => $department_id, 'speciality_id' => $speciality_id))->result_array();
    }

    public function get_test_categories($spec_id) {
        return $this->db->get_where('test_category', array('speciality_id' => $spec_id))->result_array();
    }

    public function add_test_category($data) {
        return $this->db->insert('test_category', $data);
    }

    public function edit_test_category($id, $name) {
        $this->db->set('name', $name)
            ->where('id', $id)
            ->update('test_category');
    }
    

    public function delete_test_category($id) {
        $this->db->where('id', $id)->delete('test_category');
    }



    public function add_laboratory_department($h_id, $name, $user_id)
    {
        $exists = $this->db->get_where('groups', array('id' => $h_id))->num_rows();
        if ($exists === 0) {
            throw new Exception("Laboratory Not found", 404);
        }

        if (empty($name)) {
            throw new Exception("Name not provided", 400);
        }

        $exists = $this->db->get_where('department_settings_labs', array('hospital_id' => $h_id, 'department_name' => $name))->num_rows();
        if ($exists > 0) {
            throw new Exception("Department already exists", 400);
        }

        $now = date('Y-m-d H:i:s');

        // Get last department id
        $id = $this->db
            ->select('department_id')
            ->where('`department_id` is not NULL', '', FALSE)
            ->order_by('department_id', 'DESC')
            ->limit(1)
            ->get('department_settings_labs')
            ->result_array();
        if (empty($id)) {
            $id = 1;
        } else {
            $id = intval($id[0]['department_id']) + 1;
        }


        $data = array(
            'hospital_id' => $h_id,
            'department_id' => $id,
            'department_name' => $name,
            'created_by' => $user_id,
            'updated_by' => $user_id,
            'created_at' => $now,
            'updated_at' => $now
        );

        $this->db
            ->insert('department_settings_labs', $data);

        return $id;
    }

    public function add_laboratory_specialty($h_id, $d_id, $name, $user_id)
    {
        $exists = $this->db->get_where('groups', array('id' => $h_id))->num_rows();
        if ($exists === 0) {
            throw new Exception("Laboratory Not Found", 404);
        }

        $department = $this->db->get_where('department_settings_labs', array('department_id' => $d_id, 'hospital_id' => $h_id))->result_array();
        if (empty($department)) {
            throw new Exception("Department Not Found", 404);
        }

        $department = $department[0];

        $exists = $this->db->get_where('department_settings_labs', array('hospital_id' => $h_id, 'department_id' => $d_id, 'specialty' => $name))->num_rows();
        if ($exists > 0) {
            throw new Exception("Specialty already exists", 400);
        }

        $id = $this->db
            ->select('specialty_id')
            ->where('hospital_id', $h_id)
            ->where('department_id', $d_id)
            ->where('`specialty_id` is not NULL', '', FALSE)
            ->order_by('specialty_id', 'DESC')
            ->limit(1)
            ->get('department_settings_labs')
            ->result_array();

        if (empty($id)) {
            $id = 1;
        } else {
            $id = intval($id[0]['specialty_id']) + 1;
        }

        $now = date('Y-m-d H:i:s');

        $data = array(
            'hospital_id' => $h_id,
            'department_id' => $department['department_id'],
            'department_name' => $department['department_name'],
            'specialty_id' => $id,
            'specialty' => $name,
            'created_at' => $now,
            'updated_at' => $now,
            'created_by' => $user_id,
            'updated_by' => $user_id
        );

        $this->db->insert('department_settings_labs', $data);

        return $id;
    }


    public function add_laboratory_category($h_id, $d_id, $s_id, $name, $pa, $user_id)
    {
        $exists = $this->db->get_where('groups', array('id' => $h_id))->num_rows();
        if ($exists === 0) {
            throw new Exception("Laboratory Not Found", 404);
        }

        $specialty = $this->db->get_where('department_settings_labs', array('specialty_id' => $s_id, 'hospital_id' => $h_id, 'department_id' => $d_id))->result_array();

        if (empty($specialty)) {
            throw new Exception("Specialty Not Found", 404);
        }

        $specialty = $specialty[0];

        $exists = $this->db->get_where('department_settings_labs', array('hospital_id' => $h_id, 'specialty_id' => $s_id, 'category' => $name, 'department_id' => $d_id))->num_rows();
        if ($exists > 0) {
            throw new Exception("Category already exists", 400);
        }

        $id = $this->db
            ->select('category_id')
            ->where('hospital_id', $h_id)
            ->where('specialty_id', $s_id)
            ->where('department_id', $d_id)
            ->where('`category_id` is not NULL', '', FALSE)
            ->order_by('category_id', 'DESC')
            ->limit(1)
            ->get('department_settings_labs')
            ->result_array();

        if (empty($id)) {
            $id = 1;
        } else {
            $id = intval($id[0]['category_id']) + 1;
        }

        $now = date('Y-m-d H:i:s');

        $data = array(
            'hospital_id' => $h_id,
            'department_id' => $specialty['department_id'],
            'department_name' => $specialty['department_name'],
            'specialty_id' => $specialty['specialty_id'],
            'specialty' => $specialty['specialty'],
            'category_id' => $id,
            'category' => $name,
            'pa' => $pa,
            'created_at' => $now,
            'updated_at' => $now,
            'created_by' => $user_id,
            'updated_by' => $user_id
        );

        $this->db->insert('department_settings_labs', $data);

        return $this->db->insert_id();
    }

    public function add_laboratory_specimen_type($h_id, $d_id, $s_id, $name, $user_id)
    {
        $exists = $this->db->get_where('groups', array('id' => $h_id))->num_rows();
        if ($exists === 0) {
            throw new Exception("Laboratory Not Found", 404);
        }

        $specialty = $this->db->get_where('department_settings_labs', array('specialty_id' => $s_id, 'department_id' => $d_id ,'hospital_id' => $h_id))->result_array();
        if (empty($specialty)) {
            throw new Exception("Specialty Not Found", 404);
        }

        $specialty = $specialty[0];

        $exists = $this->db->get_where('department_settings_labs', array('hospital_id' => $h_id, 'specialty_id' => $s_id, 'department_id' => $d_id, 'specimen_type' => $name))->num_rows();
        if ($exists > 0) {
            throw new Exception("Specimen Type already exists", 400);
        }


        $id = $this->db
            ->select('specimen_type_id')
            ->where('hospital_id', $h_id)
            ->where('specialty_id', $s_id)
            ->where('department_id', $d_id)
            ->where('`specimen_type_id` is not NULL', '', FALSE)
            ->order_by('specimen_type_id', 'DESC')
            ->limit(1)
            ->get('department_settings_labs')
            ->result_array();

        if (empty($id)) {
            $id = 1;
        } else {
            $id = intval($id[0]['specimen_type_id']) + 1;
        }

        $now = date('Y-m-d H:i:s');

        $data = array(
            'hospital_id' => $h_id,
            'department_id' => $specialty['department_id'],
            'department_name' => $specialty['department_name'],
            'specialty_id' => $specialty['specialty_id'],
            'specialty' => $specialty['specialty'],
            'specimen_type_id' => $id,
            'specimen_type' => $name,
            'created_at' => $now,
            'updated_at' => $now,
            'created_by' => $user_id,
            'updated_by' => $user_id
        );

        $this->db->insert('department_settings_labs', $data);
    }

    public function add_laboratory_test_category($lab_id, $d_id, $s_id, $name)
    {
        $exists = $this->db->get_where('groups', array('id' => $lab_id))->num_rows();
        if ($exists === 0) {
            custom_log("Lab Test Category Add Exception Lab not found");
            throw new Exception("Laboratory Not Found", 404);
        }

        $specialty = $this->db->get_where('department_settings_labs', array('specialty_id' => $s_id, 'hospital_id' => $lab_id, 'department_id' => $d_id))->result_array();
        if (empty($specialty)) {
            custom_log("Lab Test Category Add Exception speciality not found");
            throw new Exception("Specialty Not Found", 404);
        }

        $specialty = $specialty[0];

        $data = array(
            'laboratory_id' => $lab_id,
            'department_id' => $specialty['department_id'],
            'speciality_id' => $specialty['specialty_id'],
            'name' => $name,
        );

        $data_test = array(
            'name' => $name
        );

        if ($this->db->get_where('tests_main_categories', $data_test)->num_rows() > 0) {
            custom_log("Lab Test Category Add Exception Category already exists");
            throw new Exception("Test category already exists", 400);
        } else{
            $this->db->insert('tests_main_categories', $data_test);
        }

        if ($this->db->get_where('laboratory_test_category', $data)->num_rows() > 0) {
            custom_log("Lab Test Category Add Exception Category already exists");
            throw new Exception("Test category already exists", 400);
        }
        $this->db->insert('laboratory_test_category', $data);
        custom_log("Lab Test Category Add message, successfully added");

        return $this->db->insert_id();
    }

    public function edit_laboratory_department($h_id, $ids=array(), $type, $user_id, $name, $pa=0)
    {
        $exists = $this->db->get_where('groups', array('id' => $h_id))->num_rows();

        $now = date('Y-m-d H:i:s');

        if ($exists === 0) {
            throw new Exception("Laboratory Not Found", 404);
        }


        switch ($type) {
            case "department":
                $department_id = $ids['department_id'];

                $exists = $this->db
                    ->where('department_id !=', $department_id)
                    ->where('hospital_id', $h_id)
                    ->where('department_name', $name)
                    ->get('department_settings_labs')->num_rows();

                if ($exists > 0) {
                    throw new Exception("Department already exists", 400);
                }

                $data = array('department_name' => $name, 'updated_by' => $user_id, 'updated_at' => $now);

                $this->db
                    ->where('department_id', $department_id)
                    ->where('hospital_id', $h_id)
                    ->update('department_settings_labs', $data);

                break;


            case "speciality":
                $department_id = $ids['department_id'];
                $specialty_id = $ids['specialty_id'];

                $exists = $this->db
                    ->where('department_id', $department_id)
                    ->where('specialty_id !=', $specialty_id)
                    ->where('hospital_id', $h_id)
                    ->where('specialty', $name)
                    ->get('department_settings_labs')->num_rows();

                if ($exists > 0) {
                    throw new Exception("Specialty already exists", 400);
                }

                $data = array('specialty' => $name, 'updated_by' => $user_id, 'updated_at' => $now);

                $this->db
                    ->where('department_id', $department_id)
                    ->where('specialty_id', $specialty_id)
                    ->where('hospital_id', $h_id)
                    ->update('department_settings_labs', $data);

                break;

            case "category":
                $department_id = $ids['department_id'];
                $specialty_id = $ids['specialty_id'];
                $category_id = $ids['category_id'];

                $exists = $this->db
                    ->where('department_id', $department_id)
                    ->where('specialty_id', $specialty_id)
                    ->where('category_id !=', $category_id)
                    ->where('hospital_id', $h_id)
                    ->where('category', $name)
                    ->get('department_settings_labs')->num_rows();

                if ($exists > 0) {
                    throw new Exception("Category already exists", 400);
                }

                $data = array('category' => $name, 'updated_by' => $user_id, 'updated_at' => $now, 'pa' => $pa);

                $this->db
                    ->where('department_id', $department_id)
                    ->where('specialty_id', $specialty_id)
                    ->where('category_id', $category_id)
                    ->where('hospital_id', $h_id)
                    ->update('department_settings_labs', $data);

                break;

            case "specimen_type":
                $department_id = $ids['department_id'];
                $specialty_id = $ids['specialty_id'];
                $specimen_type_id = $ids['specimen_type_id'];

                $exists = $this->db
                    ->where('department_id', $department_id)
                    ->where('specialty_id', $specialty_id)
                    ->where('specimen_type_id !=', $specimen_type_id)
                    ->where('hospital_id', $h_id)
                    ->where('specimen_type', $name)
                    ->get('department_settings_labs')->num_rows();

                if ($exists > 0) {
                    throw new Exception("Specimen Type already exists", 400);
                }

                $data = array('specimen_type' => $name, 'updated_by' => $user_id, 'updated_at' => $now);

                $this->db
                    ->where('department_id', $department_id)
                    ->where('specialty_id', $specialty_id)
                    ->where('specimen_type_id', $specimen_type_id)
                    ->where('hospital_id', $h_id)
                    ->update('department_settings_labs', $data);

                break;

            default:
                throw new Exception("Invalid type", 400);
        }

    }

    public function get_lab_specialty_snomed_codes($lab_id, $dept_id, $specialty_id){
        $this->db->select('snm_codes.*,
        (CASE WHEN snm_codes.schedule_type = "weekly" AND snm_codes.schedule_value != "" THEN CONCAT("weekly on ", snm_codes.schedule_value) WHEN snm_codes.schedule_type = "days" AND snm_codes.schedule_value != "" THEN CONCAT("after ", snm_codes.schedule_value, " days") ELSE "N/A" END) as schedule_title, 
        (SELECT DISTINCT(category) FROM department_settings_labs dsl WHERE dsl.hospital_id=snm_codes.lab_id AND 
        dsl.department_id=snm_codes.department_id AND dsl.specialty_id=snm_codes.speciality_id 
        AND dsl.category_id=snm_codes.category_id) as category_name, 
        (SELECT DISTINCT(sub_category_name) FROM department_settings_labs dsl 
        WHERE dsl.hospital_id=snm_codes.lab_id AND dsl.department_id=snm_codes.department_id 
        AND dsl.specialty_id=snm_codes.speciality_id AND dsl.category_id=snm_codes.category_id 
        AND dsl.sub_category_id=snm_codes.sub_category_id) as sub_category_name ');
        $this->db->where('lab_id', $lab_id);
        $this->db->where('department_id', $dept_id);
        $this->db->where('speciality_id', $specialty_id);
        $this->db->from("speciality_snomed_codes snm_codes");
        $this->db->order_by('department_id, speciality_id, category_id ASC');
        $query = $this->db->get();
        $response = array();
        $result = $query->result_array();
        //echo $this->db->last_query();exit;
        if(!empty($result)){
            $response = $result;
        }
        return $response;
    }

    public function add_lab_specialty_snomed_codes($data){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->db->insert('speciality_snomed_codes', $data);
        return true;
    }
    public function get_snomed_code($id){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query('select * from speciality_snomed_codes where snomed_code_id ='.$id.' limit 1');
        return $query->row_array();
    }
    public function save_edit_code($snomed_id, $data){
        $this->db->where('snomed_code_id', $snomed_id);
        $this->db->update('speciality_snomed_codes', $data);
        $this->db->limit(1);
        return true;
    }
}
