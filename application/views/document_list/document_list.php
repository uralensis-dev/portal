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
#share_document .modal-dialog {
    max-width: 650px;
}
#share_document .share-doc .select2-container{
    width:100%!important;
}

</style>

<link href="<?php echo base_url('assets/css/bootstrap4-toggle/bootstrap4-toggle.min.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/js/bootstrap4-toggle/bootstrap4-toggle.min.js');   ?>"></script>

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Documents</h3>
            <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('Document') ?>">Dashboard</a></li>
               
            </ul>
        </div>
       
        <div class="col-auto float-right ml-auto">
		    <a href="<?php echo base_url('Document_List/document_section/0'); ?>" class="btn add-btn"><i class="fa fa-plus"></i>  Add</a>
			 
			<a href="<?php echo base_url('Document_List/sub_category_list'); ?>" class="btn add-btn mr-2"><i class="fa fa-list-alt"></i> Sub Calegory </a>
			
			<a href="<?php echo base_url('Document_List/category_list'); ?>" class="btn add-btn  mr-2"><i class="fa fa-list-alt"></i>  Calegory </a>
			

			
			
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
   <a href="<?php echo base_url('Document_List/index/1'); ?>" title="after the review date" class="btn btn-danger" style="padding:15px; margin:2px; border:solid 0px"></a>
   <a  href="<?php echo base_url('Document_List/index/2'); ?>" title="within 3 months of review date "  class="btn btn-warning" style="padding:15px; margin:2px; border:solid 0px"></a>
   <a  href="<?php echo base_url('Document_List/index/3'); ?>" title="more than 3 months" class="btn btn-success" style="padding:15px; margin:2px; border:solid 0px"></a>
   
    <a  href="<?php echo base_url('Document_List'); ?>" title="Reset" class="btn btn-light" style="padding:15px; margin:2px; border:solid 0px"></a>
   
 
</div>

    <form action="<?= site_url('Document_List/delete_bulk_document'); ?>" method="post" id="delete_pt_frm">
    <input type="hidden" name='<?= $this->security->get_csrf_token_name(); ?>' value='<?= $this->security->get_csrf_hash(); ?>'>
        <table class="table table-striped no-footer" id="document-list-table" style="width: 100%;">
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




<div class="modal custom-modal fade" id="delete_patient_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Patient</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary continue-btn patient-delete-btn">Delete</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-dismiss="modal"
                                class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<div class="modal custom-modal fade" id="publish_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Publish Document</h3>
                    <p>Are you sure want to Publish?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary continue-btn publish-btn">Publish</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-dismiss="modal"
                                class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 





<div class="modal custom-modal fade" id="active_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Active Document</h3>
                    <p>Are you sure want to Active?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary continue-btn active-btn">Active</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-dismiss="modal"
                                class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 


<div class="modal custom-modal fade" id="inactive_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>InActive Document</h3>
                    <p>Are you sure want to InActive?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary continue-btn inactive-btn">InActive</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-dismiss="modal"
                                class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                        <div class="form-group tg-inputwithicon share-doc">
                                           <label>User </label>
										   <select name="to_user_id[]" id="to_user_id"  class="form-control select2 to_user_id_selcet" multiple="multiple">
											<option value=" ">Select User</option>
                                            <?php foreach($user_info as $user) : ?>
                                                <option  value="<?php echo $user['id']; ?>" title="<?php echo base_url($user['profile_picture_path']); ?>"> 
												
												<?php echo $user['first_name']." ".$user['last_name']; ?></option>
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


<div id="comments_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Comments</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
				
				<div id="notification-message" class="alert ">
					
				</div>
				
            </div>
            <div class="modal-body">
			<div class="notification1 alert" id="notification-message1"></div>
                <div class="tg-editformholder">
                    <?php echo form_open('', array('id' => 'comments-send-form', 'class' => 'tg-formtheme tg-editform create_user_form')); ?>
					
                    <div class="card mb-4">
                        <div class="card-body">
                            <fieldset>
									<div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group tg-inputwithicon">
										<label>Comments</label>	
										<textarea rows="5" name="comments" id="comments" class="form-control"> </textarea>
											
                                        </div>
                                    </div>
									</div>
									
									
									<input type="hidden" name="document_id" id="document_id">	
								<br/>
                                                                    
                                <div class="row">
									<div class="col-md-12">
									<div class="form-group">
										<button class="btn btn-success" id="user-create-btn">Submit</button>
										
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




<script type="text/javascript">
    

    $(document).ready( function() {
		
		$(".select2").select2({
            placeholder: 'Nothing Selected',
            width: '100%'
        });
		
		
        setTimeout(function (){
            $('.notification').hide(9000);
			
        }, 5000);
		
		
		
		function formatState (state) {
		
		
		
		var baseUrl = state.title;
		var $state = $(
		'<span><img width="30" height="30" src="' + baseUrl +'" class="img-flag" /> ' + state.text + '</span>'
		);
		return $state;
	};

	$(".to_user_id_selcet").select2({
		templateResult: formatState
	});

		
		
		
		
    });
    var site_url = '<?= base_url(); ?>';
	var searchtype = <?= $searchtype; ?>;
	
	
	
	
	
	
	
</script>

