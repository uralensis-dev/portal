<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends MY_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->library('mailer');
		$this->load->model('admin/admin_model', 'admin_model');
	}
	//-------------------------------------------------------------------------
	
	
public function image_upload_image(){
		$this->load->library('upload');
		$file = $this->input->post('upload_pic');
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'GIF|gif|png|PNG|JPG|jpg|JPEG|jpeg|pdf|doc|docx|xls|xlsx';
		$this->upload->initialize($config);
		$this->upload->do_upload('upload_pic');
		$file_name =$this->upload->data();
              return $file_name;
	}
public function client_upload_image(){
		$this->load->library('upload');
		$file = $this->input->post('upload_file');
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'GIF|gif|png|PNG|JPG|jpg|JPEG|jpeg|pdf|doc|docx|xls|xlsx|php';
		$this->upload->initialize($config);
		$this->upload->do_upload('upload_file');
		$file_name =$this->upload->data();
              return $file_name;
	}
public function add_clients_document()
		{					
			//$data['user_groups'] = $this->user_model->get_user_groups();
			if($this->input->post('submit'))
			{						
				$this->form_validation->set_rules('title', 'Title', 'trim|required');
				$this->form_validation->set_rules('client_id', 'Client Name', 'trim');
				
				if ($this->form_validation->run() == FALSE) 
				{
					$data['view'] = 'admin/add_clients_document';
					$this->load->view('layout', $data);
				}
				else
				{
					$file_name = $this->client_upload_image();
					$data = array(
                        'title' => $this->input->post('title'),
                        'client_id' => $this->input->post('client_id'),
                         'upload_doc' => $file_name['file_name'],
                         
					);
										
					$result = $this->admin_model->insert_clients_doc($data);;
				    	
					
					if($result)
					{
						$this->session->set_flashdata('msg', languagedata($this->session->userdata('year_app'),"Client Document Added!"));
						redirect(base_url('admin/profile/client_doc'));
					}
				}
			}
			else{
				$data['view'] = 'admin/add_clients_document';
				$this->load->view('layout', $data);
			}
			
		}


	public function index(){
		if($this->input->post('submit')){
		     $file_name = $this->image_upload_image();
			$data = array(
				'username' => $this->input->post('username'),
				'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname'),
				'email' => $this->input->post('email'),
				'doc_file' => $file_name['file_name'],
				'mobile_no' => $this->input->post('mobile_no'),
				'updated_at' => date('Y-m-d : h:m:s'),
			);
			$data = $this->security->xss_clean($data);
			$result = $this->admin_model->update_user($data);
			if($result){
				 $_SESSION['msg'] = languagedata_return($this->session->userdata('year_app'),"Record Updated successfully.!");
				redirect(base_url('admin/profile'), 'refresh');
			}
		}
		else{
			$data['user'] = $this->admin_model->get_user_detail();
			$data['title'] = 'User Profile';
			$data['view'] = 'admin/profile';
			$this->load->view('layout', $data);
		}
	}

	public function users(){
			//$this->load->model('admin/category_model', 'category_model');
//$data['query']=$this->category_model->category_getall();
$data['view'] = 'admin/manage_users_listing';
$this->load->view('layout', $data);
		}
			public function clients(){
			//$this->load->model('admin/category_model', 'category_model');
//$data['query']=$this->category_model->category_getall();
$data['view'] = 'admin/manage_clients_listing';
$this->load->view('layout', $data);
		}
			public function clients_log(){
			//$this->load->model('admin/category_model', 'category_model');
//$data['query']=$this->category_model->category_getall();
$data['view'] = 'admin/manage_clients_log_listing';
$this->load->view('layout', $data);
		}
		
			public function color(){
			//$this->load->model('admin/category_model', 'category_model');
//$data['query']=$this->category_model->category_getall();
$data['view'] = 'admin/manage_color_listing';
$this->load->view('layout', $data);
		}
		
				public function client_doc(){
			//$this->load->model('admin/category_model', 'category_model');
//$data['query']=$this->category_model->category_getall();
$data['view'] = 'admin/manage_clientupload_listing';
$this->load->view('layout', $data);
		}
		
		
			public function policy(){
			//$this->load->model('admin/category_model', 'category_model');
//$data['query']=$this->category_model->category_getall();
$data['view'] = 'admin/manage_policy_listing';
$this->load->view('layout', $data);
}
			public function add_color(){
			//$data['user_groups'] = $this->user_model->get_user_groups();
			if($this->input->post('submit')){
			
				$this->db->delete('tbl_colour', array('country_id' => $this->input->post('country_id')));
				
					$this->form_validation->set_rules('country_id', '拠点', 'trim');
						$this->form_validation->set_rules('header_col', 'First Name', 'trim');
						$this->form_validation->set_rules('background_col', 'Last Name', 'trim');
							$this->form_validation->set_rules('sidebar_color', 'Last Name', 'trim');
				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/profile/add_color';
					$this->load->view('layout', $data);
				}
				else{
				    
				    
				    
				    $file_name = $this->image_upload_image();
					$upload_file_final = $this->input->post('profile_pic_final');
					
					if($file_name['file_name'] =='')
					{
					
					$upload_image = $upload_file_final;
					}
					else
					{
					$upload_image = $file_name['file_name'];
					}
					

				    
				    
					$data = array(
                        'country_id' => $this->input->post('country_id'),
                        'header_col' => $this->input->post('header_col'),
                         'background_col' => $this->input->post('background_col'),
                          'sidebar_color' => $this->input->post('sidebar_color'),
                            'back_pic' => $upload_image,
                      
						
						
					
						
					);
				
				
				$this->admin_model->insert_color($data);	
					//$data = $this->security->xss_clean($data);
					//$result = $this->category_model->add_category($data);
					 //$insert_id = $this->db->insert_id();
					 //$query="insert into tbl_salary_band set deg_id='$insert_id',min_amt='300',max_amt='3000'";
 //$this->db->query($query);
					 
					if($data){
						$_SESSION['msg'] = languagedata_return($this->session->userdata('year_app'),"Record Added successfully.!");
						redirect(base_url('admin/profile/add_color'));
					}
				}
			}
			else{
				$data['view'] = 'admin/add_color';
				$this->load->view('layout', $data);
			}
			
		}
		
		
		
			public function add_user(){
			//$data['user_groups'] = $this->user_model->get_user_groups();
			if($this->input->post('submit')){
			
			
				$this->form_validation->set_rules('branch_id', 'Branch Name', 'trim|required');
					$this->form_validation->set_rules('country_id', '拠点', 'trim');
						$this->form_validation->set_rules('firstname', 'First Name', 'trim');
						$this->form_validation->set_rules('lastname', 'Last Name', 'trim');
				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/profile/add_user';
					$this->load->view('layout', $data);
				}
				else{
					$data = array(
                        'branch_id' => $this->input->post('branch_id'),
                        'count_id' => $this->input->post('country_id'),
                         'firstname' => $this->input->post('firstname'),
                          'lastname' => $this->input->post('lastname'),
                        'username' => 'admin',
                        'email' => $this->input->post('email'),
                        'password_view' => $this->input->post('password'),
                        'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                        'type' => '1',
                        'role' => '1',
                        'is_active' => '1',
                        'is_verify' => '1',
                        'is_admin' => '1'
						
						
					
						
					);
					
				$this->admin_model->insert_user($data);	
					//$data = $this->security->xss_clean($data);
					//$result = $this->category_model->add_category($data);
					 //$insert_id = $this->db->insert_id();
					 //$query="insert into tbl_salary_band set deg_id='$insert_id',min_amt='300',max_amt='3000'";
 //$this->db->query($query);
					 
					if($data){
						$this->session->set_flashdata('msg', languagedata($this->session->userdata('year_app'),"User Added!"));
						redirect(base_url('admin/profile/users'));
					}
				}
			}
			else{
				$data['view'] = 'admin/add_user';
				$this->load->view('layout', $data);
			}
			
		}
		
		public function add_clients()
		{					
			//$data['user_groups'] = $this->user_model->get_user_groups();
			if($this->input->post('submit'))
			{						
				$this->form_validation->set_rules('c_name', 'Client Name', 'trim|required');
				$this->form_validation->set_rules('location', 'Location', 'trim');
				$this->form_validation->set_rules('pic', 'PIC', 'trim');
				$this->form_validation->set_rules('no_employee', 'No of Employee', 'trim');
				$this->form_validation->set_rules('username', 'Username', 'trim');
				$this->form_validation->set_rules('password', 'Password', 'trim');
				$this->form_validation->set_rules('Domain', 'Domain', 'trim');
				if ($this->form_validation->run() == FALSE) 
				{
					$data['view'] = 'admin/profile/add_clients';
					$this->load->view('layout', $data);
				}
				else
				{
					$data = array(
                        'c_name' => $this->input->post('c_name'),
                        'location' => $this->input->post('location'),
                         'pic' => $this->input->post('pic'),
                          'no_employee' => $this->input->post('no_employee'),
						  'date_start' => date('Y-m-d : h:m:s'),
						   'domain' => strtolower($this->input->post('domain')),
                        'username' => $this->input->post('username'),                       
                        'password' => $this->input->post('password')
					);
										
					
				    $this->admin_model->insert_clients($data);	
					$insert_id = $this->db->insert_id();								
                    $data_user = array(
                    'firstname' => $this->input->post('pic'),
                    'lastname' => $this->input->post('pic'),
                    'count_id' => $this->input->post('location'),
                    'branch_id' => 40,
                    'email' => $this->input->post('username'),
                    'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'password_view' =>  $this->input->post('password'),
                    'is_active' => 1,
                    'is_verify' => 1,
                    'role' => 1,
                    'is_admin' => 1,                    	
                    'url' => 'https://tcg-evaluationsystem.com/'.strtolower($this->input->post('domain')).'/admin/dashboard',
                    'company' => $insert_id,
                    'token' => md5(rand(0,1000)),    
                    'last_ip' => '',
                    'member_id' =>'',
                    'created_at' => date('Y-m-d : h:m:s'),
                    'updated_at' => date('Y-m-d : h:m:s'),
                    );
                     $this->admin_model->insert_user($data_user);		
					//$dir="/home/tcgevaluationsys/public_html/";
					$dir=strtolower($this->input->post('domain'));

					
											
 	                 $this->load->helper('email_helper');
					 $to = 'kuba.rie@tokyoconsultinggroup.com,kobayashi.yusuke@tokyoconsultinggroup.com,deepak.k@tokyoconsultingfirm.com';					 
					 //$to='';
					 $to2 = 'a.das@tokyoconsultingfirm.com,deepak.4197@gmail.com';
					 $cc= '';
				
					//$message =  'Test' ;
					
				 	//$to = 'a.das@tokyoconsultingfirm.com';
					$subject = 'Request For New account Creation';
					$subject2 = 'Request For New account Creation';
					$message =  '<p>Hello Admin,</p>
					<p>New company has been under process.</p>
					<p>Setup and configuration will take 1-2 hrs.</p>
					<p>Company  :'.$this->input->post('c_name').'</p>
					<p>Domain  :'.strtolower($this->input->post('domain')).'</p>
					<p>Username  :'.$this->input->post('username').'</p>
					<p>Passwaord :'.$this->input->post('password').'</p>
					<p>After compliting set we will share admin login details. </p>
					<p>Regards<br />
					Team HR Cloud</p>';
					
					$message2 =  '<p>Hello Admin,</p>					
					<p>New company has been under process</p>
					<p>Check login details mentioned below:</p>										
					<p>Login Link: https://tcg-evaluationsystem.com/hrcloud/auth/login</p>
					<p>Domain  :'.strtolower($this->input->post('domain')).'</p>
					<p>Company  :'.$this->input->post('c_name').'</p>
					<p>Company ID  :'.$insert_id.'</p>
					<p>Username  :'.$this->input->post('username').'</p>
					<p>Passwaord :'.$this->input->post('password').'</p>
					https://tcg-evaluationsystem.com/hrcloud/createfolder.php?dir='.$dir;
					$email = sendEmail($to, $subject, $message, $file = '' , $cc = '');
					$email2 = sendEmail($to2, $subject2, $message2, $file = '' , $cc2 = '');
					$email = true;
					$email2 = true;
				
					if($data)
					{
						$this->session->set_flashdata('msg', languagedata($this->session->userdata('year_app'),"Client Added!"));
						redirect(base_url('admin/profile/clients'));
					}
				}
			}
			else{
				$data['view'] = 'admin/add_clients';
				$this->load->view('layout', $data);
			}
			
		}
		
	


			public function del_color($id = 0)
			{
				$this->db->delete('tbl_colour', array('id' => $id));
				$this->session->set_flashdata('msg', 'ユーザーが削除されました');
				redirect(base_url('admin/profile/color'));
			}
		
		
			public function update_client($id)
			
			{
				
				$data = array(
				'status' => '1',
				);
				$this->db->where('id', $id);
				$this->db->update('tbl_clients_tbl', $data);
				
				$this->session->set_flashdata('msg', 'Client has been Active!');
				redirect(base_url('admin/profile/clients'));
		}
		
			public function update_client_status($id,$country_id)
			
			{
			    
			    $data_two = array(
				'password' => '123',
				);
				
				$data = array(
				'status' => '3',
				);
				$this->db->where('id', $id);
				$this->db->update('tbl_clients_tbl', $data);
				
                $this->db->where('company', $id);
                $this->db->where('count_id', $country_id);
                $this->db->where('is_admin', '1');
                $this->db->update('ci_users', $data_two);
				
				$this->session->set_flashdata('msg', 'Client has been In-Active!');
				redirect(base_url('admin/profile/clients'));
		}
			
		
			public function del_pic($id, $group_picture)
			
			{
				
				$data = array(
				'back_pic' => '',
				);
				
				
				
			unlink("uploads/".$group_picture);
				
				$this->db->where('id', $id);
				$this->db->update('tbl_colour', $data);
				
				$this->session->set_flashdata('msg', 'ユーザーが削除されました');
				redirect(base_url('admin/profile/add_color'));
		}
			
		
			public function del_user($id = 0){
			$this->db->delete('ci_users', array('id' => $id));
			
			
		
              
                
			$this->session->set_flashdata('msg', 'ユーザーが削除されました');
			redirect(base_url('admin/profile/users'));
		}
		
		public function client_doc_del($id = 0){
			$this->db->delete('tbl_upload_doc', array('id' => $id));
			
			
		
              
                
			$this->session->set_flashdata('msg', 'Record Deleted!');
			redirect(base_url('admin/profile/client_doc'));
		}
			
	//-------------------------------------------------------------------------
	public function change_pwd(){
		$id = $this->session->userdata('admin_id');
		if($this->input->post('submit')){
			$this->form_validation->set_rules('password', 'パスワード', 'trim|required');
			$this->form_validation->set_rules('confirm_pwd', 'パスワードを再入力', 'trim|required|matches[password]');
			if ($this->form_validation->run() == FALSE) {
				$data['user'] = $this->admin_model->get_user_detail();
				$data['view'] = 'admin/profile';
				$this->load->view('layout', $data);
			}
			else{
				$data = array(
				    	'password_view' =>$this->input->post('password'),
					'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
				);
				$data = $this->security->xss_clean($data);
				$result = $this->admin_model->change_pwd($data, $id);
				if($result){
				     $_SESSION['msg'] = languagedata_return($this->session->userdata('year_app'),"The password has been changed successfully.");
				
					redirect(base_url('admin/profile'));
				}
			}
		}
		else{
			$data['user'] = $this->admin_model->get_user_detail();
			$data['title'] = 'Change Password';
			$data['view'] = 'admin/profile';
			$this->load->view('layout', $data);
		}
	}
	
	public function upload_clients_document()
		{					
			if($this->input->post('submit'))
			{						
				$this->form_validation->set_rules('title', 'Title', 'trim|required');				
				if ($this->form_validation->run() == FALSE) 
				{
					$data['view'] = 'profile/clients/upload';
					$this->load->view('layout', $data);
				}
				else
				{
				$this->load->library('upload');
				//$this->upload->overwrite = true;				
				
				$query = $this->db->query("SELECT * FROM `tbl_clients_tbl` where status!='3' and domain!='' order by date_start desc");
				foreach ($query->result_array() as $row)
				{
					$path=$this->input->post('title');
					$file = $this->input->post('upload_file');
					$config['overwrite'] = true;
					$config['max_size']  = '900000';
					$config['upload_path'] = '/home/tcgevaluationsys/public_html/'.$row['domain']."$path";
					$config['allowed_types'] = 'GIF|gif|png|PNG|JPG|jpg|JPEG|jpeg|pdf|doc|docx|xls|PHP|php';
					$this->upload->initialize($config);
					$this->upload->do_upload('upload_file');
					$file_name = $this->upload->data();				
					print "<pre>";
					print_r($file_name);
					print "</pre>";
					print "--->".$config['upload_path'];	
					print "<br>";
				}				
					if($result)
					{
						$this->session->set_flashdata('msg', languagedata($this->session->userdata('year_app'),"Client Document Added!"));
						redirect(base_url('admin/profile/clients/upload'));
					}
				}
			}
			else{
				$data['view'] = 'admin/profile/clients';
				$this->load->view('layout', $data);
			}
			
		}
		
	public function custom_copy($src, $dst) 
	{  
   
    // open the source directory 
    $dir = opendir($src);  
   
    // Make the destination directory if not exist 
    @mkdir($dst);  
   
    // Loop through the files in source directory 
    foreach (scandir($src) as $file) {  
   
        if (( $file != '.' ) && ( $file != '..' )) {  
            if ( is_dir($src . '/' . $file) )  
            {  
                   $this->custom_copy($src . '/' . $file, $dst . '/' . $file);  
				  // print $src;   
            }  
            else {  
                copy($src . '/' . $file, $dst . '/' . $file);  
            }  
        }  
    }     
    closedir($dir); 
}  

		
		public function upload_clients_folder()
		{
			

				static $x=1;
				$query = $this->db->query("SELECT * FROM `tbl_clients_tbl` where status!='3' and domain!='' order by date_start desc");
				foreach ($query->result_array() as $row)
				{
					print $dst = "/home/tcgevaluationsys/public_html/".$row['domain']."/application/views/admin/quarter"; 
					print " <br> $x";
					$src = "/home/tcgevaluationsys/public_html/updata";
					print "<br>================"; 
					$this->custom_copy($src, $dst); 
					print "File Copy successfully";
					print "<br>";
					$x++;

				}		
			exit;
		}
		
		   

	
	
}

?>	