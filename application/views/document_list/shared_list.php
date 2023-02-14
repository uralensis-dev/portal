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
</style>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Document</h3>
            <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('Document_List/shared_list') ?>"> Shared</a></li>
                
            </ul>
        </div>
       
        <div class="col-auto float-right ml-auto">
           
              
            
        </div>
    </div>
</div>

<div class="notification">
    <?php if ($this->session->flashdata('success') != '') { ?>
        <div class="success_list">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('error') != '') { ?>
        <div class="error_list">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
</div>



  <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body dash_tabs">
                    <ul class="nav nav-pills" id="courier_nav_tabs">
                        <li class="nav-item"><a class="nav-link active" href="#sharedFrom_tab" data-toggle="tab">Sent</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#sharedTo_tab" data-toggle="tab">Received</a></li>
                    </ul>
                    <div class="tab-content" >
                        <div class="tab-pane active" id="sharedFrom_tab">
                            
							<div class="table-responsive">
								<form action="<?= site_url('Document_List/delete_bulk_document'); ?>" method="post" id="delete_pt_frm">
								<input type="hidden" name='<?= $this->security->get_csrf_token_name(); ?>' value='<?= $this->security->get_csrf_hash(); ?>'>
									<table class="table table-striped no-footer" id="shared-list-table" style="width: 100%;">
										<thead>        
											<tr>
												<th colspan="10" class="boder-bottom" style="padding:8px 0px;">
													<div class='col-md-2' style="padding:0;">
													<a href="javascript:delete_document('bulk_delete');" class="btn btn-danger deletebtn"  style='display:none;' id="btn_pt_delete">Delete Selected</a>
													</div>
												</th>
											</tr>
											<tr>
												 <!--th><input type="checkbox" name="all_patient" id="all_patient" class=""></th>
												<th>No.</th-->
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
												<th>Review Date</th>
												<th>Description</th>												
												<th class="text-right">Action</th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
									</table> 
								</form>         
							</div>	
								
										
                          
                        </div>
                        <div class="tab-pane" id="sharedTo_tab">
                            <div class="row">
                                
								
									<div class="table-responsive">
								<form action="<?= site_url('Document_List/delete_bulk_document'); ?>" method="post" id="delete_pt_frm">
								<input type="hidden" name='<?= $this->security->get_csrf_token_name(); ?>' value='<?= $this->security->get_csrf_hash(); ?>'>
									<table class="table table-striped no-footer" id="sharedto-list-table" style="width: 100%;">
										<thead>        
											<tr>
												<th colspan="10" class="boder-bottom" style="padding:8px 0px;">
													<div class='col-md-2' style="padding:0;">
													<a href="javascript:delete_document('bulk_delete');" class="btn btn-danger deletebtn"  style='display:none;' id="btn_pt_delete">Delete Selected</a>
													</div>
												</th>
											</tr>
											<tr>
												 <!--th><input type="checkbox" name="all_patient" id="all_patient" class=""></th>
												<th>No.</th-->
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
												<th>Review Date</th>
												<th>Description</th>												
												<th class="text-right">Action</th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
									</table> 
								</form>         
							</div>	
										
										
										
                              
                               
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>









<div class="modal custom-modal fade" id="delete_patient_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Document</h3>
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
        setTimeout(function (){
            $('.notification').hide(9000);
        }, 5000);
    });
    var site_url = '<?= base_url(); ?>';
	var searchtype = '';
</script>