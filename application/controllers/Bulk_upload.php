<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// require APPPATH . 'libraries/RestController.php';

class Bulk_upload extends CI_Controller {

	public function __construct(){
        parent::__construct();  

        $this->dir = '';
        $this->destdir = FCPATH.'slides';        
		$this->load->model('Bulk_upload_model', 'bulk');
		$this->load->helper('activity_helper');
		track_user_activity();
	}

    public function index()
	{ 
		$this->dir = "/var/www/html/test";
		$this->listFolderFiles($this->dir);
	}

	private function create_folder($folder, $path){
		if($this->dir == $path){
			$parent_id = 0;
			$parent_folder_name = 'root';
		}else{
			$tmp_path = explode('/', $path);
			$parent_folder = end($tmp_path);
			$folder_record = $this->bulk->get_folder($parent_folder);
			$parent_id = $folder_record['id'];
			$parent_folder_name = $folder_record['name'];
		}
		$folder_data = $this->bulk->folder_exist($folder, $parent_id);
		if(empty($folder_data)){
			// make an entry of folder in database
			$folder_data = [
				'name' => trim($folder),
				'parent_id' => $parent_id,
			];
			$folder_id = $this->bulk->create_folder($folder_data);
			echo 'Folder <strong>'.$folder.'</strong> has been created under <strong>'.$parent_folder_name.'</strong>.<br><br>';
			return $folder_id;
		}else{
			echo 'Folder with <strong>'.$folder_data['name'].'</strong> is already exist.<br><br>';
			return 0;
		}
	}
	private function upload_slide($link){
		$destdir = $this->destdir;
		$size = filesize($link);
		$file = file_get_contents($link);
		//echo $destdir;
		$temp_url = explode('/', $link);
		$temp_file = explode('.', end($temp_url));	
		$rand_no = mt_rand(1, 100);	
		$file_name = $temp_file[0].'_'.date('ymdHis').$rand_no.'.'.$temp_file[1];
		if(file_put_contents($destdir.'/'.$file_name,$file)){
			$file_data = ['file_name' => $file_name, 'status' => 'success', 'size' => $size];
		}else{
			echo 'Fail to upload file <strong>'.end($temp_url).'</strong>.<br><br>';
			$file_data = ['file_name' => 0, 'status' => 'fail', 'size' => $size];
		}
		return $file_data;
		
	}

	private function create_slide($file_name, $path){
		$tmp_path = explode('/', $path);
		$parent_folder_name = $tmp_path[count($tmp_path) -2];
		$parent_folder = end($tmp_path);
		array_pop($tmp_path);
		$parent_path = implode('/',$tmp_path);
		if($parent_path == $this->dir){
			$parent_folder_name = 'root';
		}else{
			$parent_folder_name = $parent_folder_name;
		}		
		$folder_record = $this->bulk->get_slide_folder($parent_folder, $parent_folder_name);
		if(!empty($folder_record))
		{
			$parent_id = $folder_record['id'];		
			$temp_name = explode('.', $file_name);
			$exist_slide = $this->bulk->slide_exist($temp_name[0], $folder_record['id']);
			if(empty($exist_slide))
			{
				$upload_status =  $this->upload_slide($path.'/'.$file_name);
				if($upload_status['status'] == 'success'){
					$slide_data = [
						'name' => $temp_name[0],
						'scanned_by' => 'Philips',
						'scanned_date' => date('Y-m-d'),
						'inserted_by' => $this->session->userdata['user_id'],
						'inserted_date' => date('Y-m-d'),
						'slide_type' => 2,
						'url_path' => $upload_status['file_name'],
						'folder_id' => $parent_id,
						'filesize' => $upload_status['size'],
						'is_deleted' => 0			
					];
					$slide_id = $this->bulk->create_slide($slide_data);	
					echo 'Slide <strong>'.$file_name.'</strong> has been created under folder <strong>'.$folder_record['name'].'</strong>.<br><br>';
				}
				
			}else{
				echo '<strong>'.$file_name.'</strong> is already exist.<br><br>';
				return 0;
			}
			
		}else{
			echo 'Folder not exist.<br><br>';
			return 0;			
		}
	}

	private function listFolderFiles($dir){		
		$ffs = scandir($dir);
	    unset($ffs[array_search('.', $ffs, true)]);
	    unset($ffs[array_search('..', $ffs, true)]);
    
	    if (count($ffs) < 1)
	        return;
	    
	    foreach($ffs as $ff){	        
	        if(is_dir($dir.'/'.$ff)) { 
	        	$parent_id = $this->create_folder($ff, $dir);
	        	$this->listFolderFiles($dir.'/'.$ff); 
	        }else{	        	
	        	$slide_id = $this->create_slide($ff, $dir);
	        }	        
	    }
	}		
}