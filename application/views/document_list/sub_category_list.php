<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
 

.table-responsive {
	overflow-x: hidden;	
}
</style>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Sub Category</h3>
            <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('Document') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('Document_List') ?>">Document</a></li>
                
            </ul>
        </div>
		
		<div class="col-auto float-right ml-auto">
		    <a href="<?php echo base_url('Document_List/sub_category_section/0'); ?>" class="btn add-btn"><i class="fa fa-plus"></i>  Add</a>
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
        <table class="table table-striped no-footer" id="revision_table_datatable" style="width: 100%;">
            <thead>        
                <tr>
					<th>S.No.</th>
                    <th>Name</th>
					<th>Category Name</th>
					<th>Created at</th>
					<th class="text-right">Action</th>
                </tr>
				 </thead>
				 <tbody>
				<?php  
				$sn = 1;
				foreach($result as $row){
					echo '<tr>
                	<td>'.$sn.'</td>
                    <td>'.$row['sname'].'</td>
					 <td>'.$row['name'].'</td>
				    <td>'.date("d/m/Y",strtotime($row['screated_at'])).'</td>'; ?>
                 	<td class="text-right"><a href="<?php echo base_url('Document_List/sub_category_section/'.$row['cid'].'/'.$row['sid']); ?>" ><i class="fa fa-edit m-r-5"></i> </a>
                        <a class="" href="javascript:delete_record('<?= base_url('Document_List/delete_sub_category/'.$row['sid']); ?>')" ><i class="fa fa-trash-o m-r-5"></i> </a></td>
				<?php 	
                  echo '</tr>';
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
                    <h3>Delete Sub Category</h3>
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
	var searchtype ='';
	
	
</script>