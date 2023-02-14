<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Slide_model extends CI_Model {

    public function getRequestId($labNumber){
        $query = $this->db->select('uralensis_request_id')
        ->from('request')
        ->where('lab_number' , $labNumber)->limit(1)
        ->get();
        return $query->row()->uralensis_request_id;
    }

	public function getSpecimens($request_id)
    {
		$query = $this->db->select('GROUP_CONCAT(specimen.specimen_id) as specimenIds')
        ->from('request')
		->join('specimen', 'specimen.request_id = request.uralensis_request_id')
		->where('specimen.request_id' , $request_id)
        ->where('request.uralensis_request_id' , $request_id)
        ->get();
        return $query->row()->specimenIds;
    }

	public function getSpecimensBlocks($specimenIds, $blockNo, $test)
    {
		$query = $this->db->select('id, specimen_id')
        ->from('specimen_blocks')
		->where("specimen_id IN (".$specimenIds.")",NULL, false)
		->where('name' , $test)
        ->where('block_no' , $blockNo)->limit(1)
        ->get();
        return $query->row();
    }
    public function checkSlideExist($filename){
        $query = $this->db->select('id')
        ->from('specimen_slide')
        ->where('slide_name' , $filename)->limit(1)
        ->get();
        return $query->row()->id;
    }
}