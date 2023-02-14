<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
 .table-responsive {
	overflow-x: hidden;	
}  


</style>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Risk Register</h3>
            <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('Document') ?>">Dashboard</a></li>
                
            </ul>
        </div>
       
        <div class="col-auto float-right ml-auto">           
                <a href="<?php echo base_url('Risk_Register/risk_register_section/0'); ?>" class="btn add-btn"><i class="fa fa-plus"></i>Risk Register</a>
				
				
				<a href="<?php echo base_url('Risk_Register/Severity_list'); ?>" class="btn add-btn mr-2"><i class="fa fa-list-alt"></i> Severity </a>
				
				<a href="<?php echo base_url('Risk_Register/sub_category_list'); ?>" class="btn add-btn mr-2"><i class="fa fa-list-alt"></i> Sub Calegory </a>
			
				<a href="<?php echo base_url('Risk_Register/category_list'); ?>" class="btn add-btn  mr-2"><i class="fa fa-list-alt"></i>  Calegory </a>
				
				
            
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



<div class="table-responsive">
    <form action="<?= site_url('Document_List/delete_bulk_document'); ?>" method="post" id="delete_pt_frm">
    <input type="hidden" name='<?= $this->security->get_csrf_token_name(); ?>' value='<?= $this->security->get_csrf_hash(); ?>'>
        <table class="table table-striped no-footer" id="risk_register_datatable1" style="width: 100%;">
            <thead>        
                <tr>
                    
                    <th>Id</th>
                    <th>Date Raised</th>
                    <th>Risk Description</th>
                    <th>Likelihood</th>
                    <th>Impact</th>
                    <th>Severity</th>
                    <th>Mitigating Actions</th>
					<th>Owner</th>
					<th>Status</th>
					<th>Date Closed</th>
                    <th>Next Revision Date</th>
				    <th class="text-right">Action</th>
                </tr>
				 </thead>
				 <tbody>
				<?php  
				$sn = 1;
				foreach($result as $row){
                    $tdColor = "";
                    // Check if date is 3 month old
                    $next_revision_date = $row['next_revision_date'];
                    if (strtotime($next_revision_date) < strtotime('-6 months') && !empty($next_revision_date)) {
                       $trColor = "background-color:#ffe600!important;";
                       $tdColor = "style=color:#000;";
                       $next_revision_date = date_create($next_revision_date);
                       $next_revision_date1 = date_format($next_revision_date,'d-M-Y');
                    }
                    else if(strtotime($next_revision_date) < strtotime('-3 months') && !empty($next_revision_date)){
                        $trColor = "background-color:red!important;";
                        $tdColor = "style=color:white;";
                        $next_revision_date = date_create($next_revision_date);
                        $next_revision_date1 = date_format($next_revision_date,'d-M-Y');
                    }
                    elseif (!empty($next_revision_date)) {
                        $next_revision_date = date_create($next_revision_date);
                        $next_revision_date1 = date_format($next_revision_date,'d-M-Y');
                    }
                    else {
                        $trColor = "";
                        $next_revision_date1 = '';
                    } 
                    
                        // For Date Raised
                        $date_raised = date_create($row['date_raised']);
                        $date_closed = date_create($row['date_closed']);
                        
						$ststus = 'Closed';
						if($row['status']==1){
							$ststus = 'Open';
						}
					echo '<tr style='.$trColor.'>
                    
                    <td '.$tdColor.'>'.$sn.'</td>
                    <td '.$tdColor.'>'.date_format($date_raised,"d-M-Y").'</td>
                    <td '.$tdColor.'>'.substr($row['risk_description'],0,30).'</td>
                    <td '.$tdColor.'>'.$row['likelihood'].'</td>
                    <td '.$tdColor.'>'.$row['impact'].'</td>
                    <td '.$tdColor.'>'.$row['severity'].'</td>
                    <td '.$tdColor.'>'.$row['mitigating_actions'].'</td>
					<td><img style="border-radius: 50%;" width="30" height="30" title="'.$user[$row['owner_id']].'" src="'.$row['img'].'"></td>
					<td '.$tdColor.'>'.$ststus.'</td>
					<td '.$tdColor.'>'.date_format($date_closed,"d-M-Y").'</td>
                    <td '.$tdColor.'> '.$next_revision_date1.'</td>' ?>
				    <td class="text-right" style="padding-right: 0;padding-left: 0;"><a href="<?php echo base_url('Risk_Register/risk_register_view/'.$row['riskId']); ?>"><i class="fa fa-eye m-r-5"></i></a>
                    <a href="<?php echo base_url('Risk_Register/risk_register_section/'.$row['riskId']); ?>" ><i class="fa fa-edit m-r-5"></i></a>
                        <a class="" href="javascript:delete_record('<?= base_url('Risk_Register/delete_record/'.$row['riskId']); ?>')" ><i class="fa fa-trash-o m-r-5"></i> </a></td>
               <?php  echo '</tr>';
				$sn++;
				 }	
				?>
			                
            </tbody>
        </table> 
    </form>     

                    
        
    
</div>




<div class="modal custom-modal fade" id="delete_record_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Risk Register</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary continue-btn delete_record-btn">Delete</a>
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
                                        <div class="form-group tg-inputwithicon">
                                           <label>User </label>
										   <select name="to_user_id[]" id="to_user_id"  class="form-control select2 " multiple="multiple">
											<option value=" ">Select User</option>
                                            <?php foreach($user_info as $user) : ?>
                                                <option value="<?php echo $user['id']; ?>"><?php echo $user['first_name']." ".$user['first_name']; ?></option>
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



<script type="text/javascript">
  

    $(document).ready( function() {
		
		$('#risk_register_datatable').DataTable();
		
		
		$(".select2").select2({
            placeholder: 'Nothing Selected',
            width: '100%'
        });
		
		
        setTimeout(function (){
            $('.notification').hide(9000);
			
        }, 5000);
    });
    var site_url = '<?= base_url(); ?>';
	
	
</script>