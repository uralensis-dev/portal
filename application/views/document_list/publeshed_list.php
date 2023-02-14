<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
  .table thead th{
        font-weight:600!important;
    } 
.table td, .table th {
    padding: 15px 5px;
} 
.deletebtn {
    padding: 7px 5px;
    font-size: 14px;
}  
.main-div {
    overflow: hidden;
}
.page-item.disabled .page-link {
    font-size: 14px;
}
.page-link {
    line-height: 18px;
}
.row_red1{
	background-color:#f62d51!important;
}

.row_orange1{
	background-color:#e9ab2e!important;
}

.row_green1{
	background-color:#55ce63!important;
}

.chat-boxst .card {
    height: 500px;
    border-radius: 15px !important;
    background: #10759621;
}

.img_cont_msg {
    height: 40px;
    width: 40px;
}
.user_img_msg {
    height: 40px;
    width: 40px;
    border: 1.5px solid #f5f6fa;
}
.msg_cotainer {
    margin-top: auto;
    margin-bottom: auto;
    margin-left: 10px;
    border-radius: 25px;
    background-color: #82ccdd;
    padding: 10px;
    position: relative;
}
.msg_cotainer_send {
    margin-top: auto;
    margin-bottom: auto;
    margin-right: 10px;
    border-radius: 25px;
    background-color: #78e08f;
    padding: 10px;
    position: relative;
}
.msg_time_send {
    position: absolute;
    right: 0;
    bottom: -15px;
    color: #000;
    font-size: 10px;
}
.input-group-append {
    margin-left: -1px;
}
.attach_btn {
    border-radius: 15px 0 0 15px !important;
    background-color: rgb(6 54 123) !important;
    border: 0 !important;
    color: white !important;
    cursor: pointer;
}
.type_msg {
    background-color: rgb(255 255 255) !important;
    border: 0 !important;
    color: white !important;
    height: 60px !important;
    overflow-y: auto;
    padding-top: 20px;
}
.send_btn {
    border-radius: 0 15px 15px 0 !important;
    background-color: rgb(7 51 124) !important;
    border: 0 !important;
    color: white !important;
    cursor: pointer;
}
.send_btn i{
    font-size: 18px;
}
.msg_card_body {
    overflow-y: auto;
}
.chat-boxst .modal-dialog {
    max-width: 1000px;
}
.chat-boxst .modal-body {
    padding: 0px 30px;
}
.chat-boxst .card-footer {
    background: #10759621;
}

</style>

<link href="<?php echo base_url('assets/css/bootstrap4-toggle/bootstrap4-toggle.min.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/js/bootstrap4-toggle/bootstrap4-toggle.min.js');   ?>"></script>

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Document Published</h3>
            <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('Document') ?>">Dashboard</a></li>
               
            </ul>
        </div>
       
    </div>
</div>

<div class="notification">
    <?php if ($this->session->flashdata('showMessage') != '') { ?>
        <div class="success_list">
            <?= $this->session->flashdata('message'); ?>
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('error') != '') { ?>
        <div class="error_list">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
</div>



<div class="table-responsive main-div">

<div class="btn-group" role="group" aria-label="Basic example">
   <a href="<?php echo base_url('Document_List/published/1'); ?>" title="after the review date" class="btn btn-danger" style="padding:15px; margin:2px; border:solid 0px"></a>
   <a  href="<?php echo base_url('Document_List/published/2'); ?>" title="within 3 months of review date "  class="btn btn-warning" style="padding:15px; margin:2px; border:solid 0px"></a>
   <a  href="<?php echo base_url('Document_List/published/3'); ?>" title="more than 3 months" class="btn btn-success" style="padding:15px; margin:2px; border:solid 0px"></a>
   
    <a  href="<?php echo base_url('Document_List/published'); ?>" title="Reset" class="btn btn-light" style="padding:15px; margin:2px; border:solid 0px"></a>
   
 
</div>

    <form action="<?= site_url('Document_List/delete_bulk_document'); ?>" method="post" id="delete_pt_frm">
    <input type="hidden" name='<?= $this->security->get_csrf_token_name(); ?>' value='<?= $this->security->get_csrf_hash(); ?>'>
        <table class="table table-striped no-footer" id="publeshed-list-table" style="width: 100%;">
            <thead>        
                
                <tr>
                     <!--th><input type="checkbox" name="all_patient" id="all_patient" class=""></th-->
                   
                    <th>Doc No.</th>
                   
                    <th>Owner</th>
                    <th>Category</th>
                    <th>1st Issue Date</th>
                    <th>Current Date</th>
					<th>Revision No.</th>
					<th>Status</th>
					<th>Location</th>
					<th>Type</th>
					<th>Interval</th>
					<th>Viewer</th>
					<th>Review Date</th>					
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table> 
    </form>     

                    
        
    
</div>



<div id="share_document" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Share Document</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
				
				<div id="notification-message" class="alert ">
					
				</div>
				
            </div>
            <div class="modal-body">
			<div class="notification1 alert" id="notification-message1"></div>
                <div class="tg-editformholder">
                    <?php echo form_open('', array('id' => 'share-document-form', 'class' => 'tg-formtheme tg-editform create_user_form')); ?>
					
                    <div class="card mb-4">
                        <div class="card-body">
                            <!-- Patient Personal Information START -->
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group tg-inputwithicon">
                                           <label>User </label>
										   <select name="to_user_id[]" id="to_user_id"  class="form-control select2 " multiple="multiple">
											<option value=" ">Select User</option>
                                            <?php foreach($user_info as $user) : ?>
                                                <option value="<?php echo $user['id']; ?>"><?php echo $user['first_name']." ".$user['last_name']; ?></option>
                                            <?php endforeach; ?>
											</select>
											
                                        </div>
                                    </div>
                                
                                </div>
								
								<div class="row">

                                        <div class="col-md-4">
                                            <div class="">
                                                <!-- <label for="home-input">Deceased</label> -->
                                                <input type="checkbox" name="view_permission" id="view_permission" value="1" checked=""><span style="color: #000;">  View</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="checkbox" name="delete_permission" id="delete_permission" value="1" class=""><span style="color: #000;"> Delete</span>
                                            </div>
                                        </div>
										
										
										
										<div class="col-md-4">
                                            <div class="form-group">
                                                <input type="checkbox" name="edit_permission" id="edit_permission" value="1" class=""><span style="color: #000;"> Edit</span>
                                            </div>
                                        </div>
										
										 <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="checkbox" name="download_permission" id="download_permission" value="1" class=""><span style="color: #000;"> Download</span>
                                            </div>
                                        </div>
										
                                    </div>
									
									
									
									<div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group tg-inputwithicon">
                                             
                                            <input type="text" name="description" id="Description" value="" class="form-control" placeholder="Description">
                                        </div>
                                    </div>
									</div>
									
									
									<div class="row">
										<div class="col-md-12" id="add_user">
											<span class="badge badge-secondary">Secondary <span><a href="">X</a> </span></span>
											<span class="badge badge-secondary">Secondary <span><a href="">X</a> </span></span>
										</div>
									</div>
									
									
									<input type="hidden" name="document_id" id="document_id">	
								<br/>
                                                                    
                                <div class="row">
									<div class="col-md-12">
									<div class="form-group">
										<button class="btn btn-success" id="user-create-btn">Share</button>
										<button class="btn btn-warning" id="user-form-clear-btn" type="button">Clear</button>
										</div>
									</div>
								</div>
                            </fieldset>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="view_doc" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open_multipart(uri_string(), array('id'=>'edit_cv_appraisal','name' => 'edit_cv_appraisal')); ?>
            <input type="hidden" name="edit_cv_appraisal" value="1">
            <div class="modal-body" id="doc_embed">
				
            </div>
            <div class="modal-footer">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>



<div id="comments_modal" class="modal chat-boxst custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Comment Send</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
				
				<div id="notification-message" class="alert ">
					
				</div>
				
            </div>
            <div class="modal-body">
			<div class="notification1 alert" id="notification-message1"></div>
                <div class="tg-editformholder">
                    <?php echo form_open('', array('id' => 'share-document-form', 'class' => 'tg-formtheme tg-editform create_user_form')); ?>
					
                   
							
								<div class="row">
								
								
								<div class="col-sm-12">
									<div class="card">
									  
									  <div class="card-body msg_card_body">
											<div class="d-flex justify-content-start mb-4">
												<div class="img_cont_msg">
													<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
												</div>
												<div class="msg_cotainer">
													Hi, how are you samim?
													<span class="msg_time">8:40 AM, Today</span>
												</div>
											</div>
											<div class="d-flex justify-content-end mb-4">
												<div class="msg_cotainer_send">
													Hi Khalid i am good tnx how about you?
													<span class="msg_time_send">8:55 AM, Today</span>
												</div>
												<div class="img_cont_msg">
											<img src="http://localhost/pci/assets/img/person-male.png" class="rounded-circle user_img_msg">
												</div>
											</div>
											<div class="d-flex justify-content-start mb-4">
												<div class="img_cont_msg">
													<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
												</div>
												<div class="msg_cotainer">
													I am good too, thank you for your chat template
													<span class="msg_time">9:00 AM, Today</span>
												</div>
											</div>
											<div class="d-flex justify-content-end mb-4">
												<div class="msg_cotainer_send">
													You are welcome
													<span class="msg_time_send">9:05 AM, Today</span>
												</div>
												<div class="img_cont_msg">
											<img src="http://localhost/pci/assets/img/person-male.png" class="rounded-circle user_img_msg">
												</div>
											</div>
											<div class="d-flex justify-content-start mb-4">
												<div class="img_cont_msg">
													<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
												</div>
												<div class="msg_cotainer">
													I am looking for your next templates
													<span class="msg_time">9:07 AM, Today</span>
												</div>
											</div>
											<div class="d-flex justify-content-end mb-4">
												<div class="msg_cotainer_send">
													Ok, thank you have a good day
													<span class="msg_time_send">9:10 AM, Today</span>
												</div>
												<div class="img_cont_msg">
										<img src="http://localhost/pci/assets/img/person-male.png" class="rounded-circle user_img_msg">
												</div>
											</div>
											<div class="d-flex justify-content-start mb-4">
												<div class="img_cont_msg">
													<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
												</div>
												<div class="msg_cotainer">
													Bye, see you
													<span class="msg_time">9:12 AM, Today</span>
												</div>
											</div>
										</div>
										<div class="card-footer">
											<div class="input-group">
												<div class="input-group-append">
													<span class="input-group-text attach_btn"><i class="fa fa-paperclip" aria-hidden="true"></i></span>
												</div>
												<textarea name="" class="form-control type_msg" placeholder="Type your message..."></textarea>
												<div class="input-group-append">
													<span class="input-group-text send_btn"><i class="fa fa-location-arrow" aria-hidden="true"></i></span>
												</div>
											</div>
										</div>
									</div>

								</div>
								
								
								<div class="col-md-12 hide">
									<div class="form-group tg-inputwithicon">
										<input type="text" name="message" id="message" value="" class="form-control" placeholder="Comments">
									</div>
								</div>
								</div>									
									
									<input type="hidden" name="document_id" id="document_id">	
								<br/>
                                                                    
                                <div class="row hide">
									<div class="col-md-12">
									<div class="form-group">
										<button class="btn btn-success" id="user-create-btn">Send</button>
										<button class="btn btn-warning" id="user-form-clear-btn" type="button">Clear</button>
										</div>
									</div>
								</div>
                            
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





<script type="text/javascript">
    

    $(document).ready( function() {
		
		$(".select2").select2({
            placeholder: 'Nothing Selected',
            width: '100%'
        });
		
		
        setTimeout(function (){
            $('.notification').hide(9000);
			
        }, 5000);
    });
    var site_url = '<?= base_url(); ?>';
	var searchtype = <?= $searchtype; ?>;
	
	
	
</script>

