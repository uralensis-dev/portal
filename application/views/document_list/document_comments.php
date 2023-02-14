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
.commnt-head {
    border-bottom: 1px solid #ccc;
    padding: 10px 15px;
    margin-bottom: 10px;
	background: #00b6f5;
    color: #fff;
}
.chat-box img{
	border-radius: 50px;
	display: block;
    margin: auto;
}
.chat-box .col-md-10 select {
    width: 100%;
    max-width: 250px;
}
.chat-box .col-md-10 {
    text-align: justify;
}
.chat-box .col-md-10 p {
    margin-bottom: 5px;
}


 </style>   
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">

            <h3 class="page-title"><?php echo (isset($page_title))?$page_title:'Document Comments' ?></h3>
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

<div class="">

<?php echo form_open('', array('id' => 'add-category-form', 'class' => 'tg-formtheme tg-editform create_user_form')); ?>

<div class="sec_title p_id form-group">
                 
                <div class="border-pd">
							<div class="row"> 
						    <div class="col-sm-12 commnt-head">		
							Title: <?php echo $document['document_title'] ?>
							Owner: <?php echo $user_info->first_name.' '.$user_info->last_name; ?>
							Created : <?php echo date("d/m/Y",strtotime($document['created_at'])); ?>
							</div>
							
							</div>
							
							<?php foreach($comments as $row){ ?>	
							<div class="row chat-box">									
									   <div class="col-md-2">
									      <img width="100" height="100" src="<?php echo base_url($row['profile_picture_path']); ?>">
									   </div>
									   
									

									   <div class="col-md-10">

										<p><strong>Date:-</strong> 14/09/2022</p>
									     <?php echo $row['comments']; ?>
                
										 
										 <select  onchange="commentStatus(<?php echo $row['cid'] ?>,this.value)" class="form-control">
												<option value=""> Status </option>
												<?php foreach($statusArr as $opk=>$opv){
														$select = '';
														if($opk==$row['cstatus']){
															$select = 'selected="selected"';
														}
													echo '<option '.$select.' value="'.$opk.'">'.$opv.'</option>';					
												}
												?>
												
											</select>
											
									      <?php echo $row['']; ?>
									   </div>
									   					
                                </div>
								<hr/>
							<?php }	?>

                               </div>
                           </div>	
	

		
		 <div  style="display:none" class="row">
						
		<button type="submit" style="margin:10px;" class="btn btn-primary btn-rounded create_new_next_button pull-right"
								id="create_new_record_btn"
								name="submit">Submit
		</button>
									
       
    </div>
	</form>	
	
	
</div>



<script>
var searchtype  = '';
</script>
