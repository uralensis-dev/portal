<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
 .table-responsive {
	overflow-x: hidden;	
}  

table.dataTable thead > tr > th.sorting{
	    padding-right: 20px !important;
}
</style>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Document Revision</h3>
            <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('Document') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('Document_List') ?>">Document</a></li>
                
            </ul>
        </div>
       
       
    </div>
</div>

<div class="notification">
    <?php if ($this->session->flashdata('message') != '') { ?>
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



<div class="table-responsive">
    <form action="<?= site_url('Document_List/delete_bulk_document'); ?>" method="post" id="delete_pt_frm">
    <input type="hidden" name='<?= $this->security->get_csrf_token_name(); ?>' value='<?= $this->security->get_csrf_hash(); ?>'>
        <table class="table table-striped no-footer" id="revision_table_datatable">
            <thead>        
                <tr>
                    
                    <th>Doc No.</th>
					<th>Updated By</th>
					<th>Category</th>
					<th>1st Issue Date</th>
					<th>Current Date</th>
					<th>Revision No.</th>
					<th>Status</th>
					<th>Location</th>
					<th>Type</th>
					<th>Interval</th>
					<th>Review Date</th>							
					<th class="text-right">Action</th>
                </tr>
				 </thead>
				 <tbody>
				<?php  
				$sn = 1;
				foreach($result as $row){
					
						$ststus = 'Live';
						if($row['status']==2){
							$ststus = 'Obsolete';
						}
					echo '<tr>
                    
					
                    <td>#'.$row['document_number'].'<br>'.$row['document_title'].'</td>
					<td><img style="border-radius: 50%;" width="30" height="30" title="'.$user[$row['updated_by']].'" src="'.$row['img'].'"></td>
                    <td>'.$row['cat_name'].'</td>
                    <td>'.$row['date_of_1_issue'].'</td>
                    <td>'.$row['date_of_current_issue'].'</td>
                    <td>'.$row['live_revision_number'].'</td>
					<td>'.$ststus.'</td>
					<td>'.$row['location'].'</td>
					<td>'.$row['short_name'].'</td>					
					<td>'.$row['interval_months'].'M</td>
					<td>'.$row['date_of_next_review'].'</td>';?>
					
				<?php if($row['revision_status']==1){ ?>
					<td><span class="badge badge-danger">Reject</span>
					
					<a class="" href="javascript:delete_record('<?= base_url('Document_List/delete_revision/'.$row['id'].'/'.$documentId); ?>')" ><i class="fa fa-trash-o m-r-5"></i> </a>
					
					
					</td>
					
				<?php } else if($row['revision_status']==2){ ?>	
					 <td><span class="badge badge-success"> Approved </span>
					 
					<a class="" href="javascript:delete_record('<?= base_url('Document_List/delete_revision/'.$row['id'].'/'.$documentId); ?>')" ><i class="fa fa-trash-o m-r-5"></i> </a>
					 
					 </td>	
				<?php }else { ?>
				    <td class="text-right">
						<a href="<?php echo base_url('Document_List/document_revision_verify/'.$row['id']); ?>" ><i class="fa fa-check m-r-5"></i> </a>
						
						
						<a class="" href="javascript:delete_record('<?= base_url('Document_List/delete_revision/'.$row['id'].'/'.$documentId); ?>')" ><i class="fa fa-trash-o m-r-5"></i> </a>
						
						
					</td>
					
					<?php } ?>	
					
					
					
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
                    <h3>Delete Revision</h3>
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








<script type="text/javascript">
  

    $(document).ready( function() {
		
		$('#revision_table_datatable').DataTable();
		
		
		$(".select2").select2({
            placeholder: 'Nothing Selected',
            width: '100%'
        });
		
		
        setTimeout(function (){
            $('.notification').hide(9000);
			
        }, 5000);
    });
    var site_url = '<?= base_url(); ?>';
	var searchtype  ='';
	
	
</script>