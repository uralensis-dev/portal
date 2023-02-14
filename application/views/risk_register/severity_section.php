<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    .edit-icon-top i {
    top: 47px;
}
.sec_title.p_id{
    position: relative;
    background: #fff;
    padding: 0px;
    border-bottom: 0;
    margin-bottom: 30px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
}
.sec_title.p_id .info_nndn2{
    border: 1px solid #eee!important;
}
.page-wrapper > .content{
background: #f5f5f5;
}
.sec_title.p_id .info_nndn2 tr td{
    padding: 5px 15px;
}
.border-pd {
    padding: 5px 15px;
}

.tox-statusbar__branding{
	display:none;
}


 </style>   
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">

            <h3 class="page-title"><?php echo (isset($page_title))?$page_title:'Document Section' ?></h3>
            <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('Document') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('Risk_Register') ?>">Risk Register</a></li>
			 <li class="breadcrumb-item"><a href="<?php echo base_url('Risk_Register/severity_list') ?>">Severity</a></li>
			
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

<div class="">

<?php echo form_open('', array('id' => 'add-category-form', 'class' => 'tg-formtheme tg-editform create_user_form')); ?>

<div class="sec_title p_id form-group">
                 
                <div class="border-pd">

		                       <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon edit-icon-top">
                                        <label>Severity Name</label>
                                            <i class="lnr lnr-apartment"></i>
                                            <input type="text" name="name" id="document_number-input" value="<?php echo (isset($result['name']))?$result['name']:''; ?>" class="form-control" placeholder="Severity Name">
											<?php echo  form_error('name'); ?>
                                        </div>
                                    </div>
                                   
                                    
																	
                                </div>
                               

                               </div>
                           </div>	
	

		
		 <div class="row">
						
		<button type="submit" style="margin:10px;" class="btn btn-primary btn-rounded create_new_next_button pull-right"
								id="create_new_record_btn"
								name="submit">Submit
		</button>
									
       
    </div>
	</form>	
	
	
</div>




