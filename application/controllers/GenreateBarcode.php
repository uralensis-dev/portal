<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GenreateBarcode extends CI_Controller {

	public function __construct(){

        parent::__construct();
		$this->load->model('Barcode_model', 'barcode');
	}
	public function index()
	{
		$code = trim($this->input->post('code'));
		$save_it = intval($this->input->post('save_it'));
				
		//I'm just using rand() function for data example
		$this->set_barcode($code, $save_it);
	}
	
	private function set_barcode($code, $save_it)
	{
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		
		$data = json_decode($this->input->post('br_data'), true);
		//load library
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
		//Zend_Barcode::render('code128', 'image', array('text'=>$code, 'barHeight' => '80'), array());
		$barcode_data = $this->barcode->check_barcode_exist($data['request_id'], $data['test_id']);
		if(empty($barcode_data)){
			$t = Zend_Barcode::factory('Code39', 'image', array('text'=>$code, 'drawText' => false), array())->draw();
			$file_name = trim($code).rand(10,100).'.png';
			$barcode_image = FCPATH.'barcodes/'.$file_name;	
			$barcode_url = base_url().'barcodes/'.$file_name;

			
			//echo $save_it;print_r($data); exit;
			if($save_it == 1 && !empty($data)){
				$barcode_data = array(
					'lab_id' => $data['lab_id'],
					'lab_number' => $data['lab_no'],
					'digi_number' => $code,
					'test_id' => $data['test_id'],
					'request_id' => $data['request_id'],
					'patient_id' => intval($this->input->post('patient_id')),
					'barcode_image' => $file_name,
				); 
				//print_r($barcode_data);exit;
				$this->barcode->save_barcode($barcode_data);
			}	
			imagepng($t,$barcode_image, 0, NULL);
			echo $barcode_url;exit;	
		}else{
			echo base_url().'barcodes/'.$barcode_data['barcode_image'];exit;
		}
		
	}
	
}