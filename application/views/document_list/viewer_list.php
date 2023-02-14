<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
 .table-responsive {
	overflow-x: hidden;	
}  
</style>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Document Viewer</h3>
            <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('Document') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('Document_List') ?>">Document</a></li>
                
            </ul>
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
        <table class="table table-striped no-footer" id="revision_table_datatable" style="width: 100%;">
            <thead>        
                <tr>
					<th>S.No.</th>
                    <th>Doc No.</th>
					<th>Owner</th>
					<th>Category</th>
					<th>Viewer</th>
					<th>Viewed at</th>
                </tr>
				 </thead>
				 <tbody>
				<?php  
				$sn = 1;
				foreach($result as $row){
					echo '<tr>
                	<td>'.$sn.'</td>
                    <td>#'.$row['document_number'].'<br>'.$row['document_title'].'</td>
					<td><img style="border-radius: 50%;" width="30" height="30" title="'.$owner.'" src="'.$row['img'].'"></td>
                    <td>'.$row['cat_name'].'</td>
                    <td><img style="border-radius: 50%;" width="30" height="30" title="'.$ownerv.'" src="'.$row['imgv'].'"></td>
                    <td>'.date("d/m/Y h:i:s",strtotime($row['vcreated_at'])).'</td>';
                    
                  echo '</tr>';
				$sn++;
				 }	
				?>
			                
            </tbody>
        </table> 
    </form>     

                    
        
    
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
	
	
</script>