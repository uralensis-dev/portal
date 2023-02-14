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

<?php echo form_open('', array('id' => 'add-document-form', 'class' => 'tg-formtheme tg-editform create_user_form')); ?>

<div class="sec_title p_id form-group">
                  <table class="custom-table info_nndn2" style="margin-bottom: 0; width:100%">
                     <tbody>
                        <tr style="box-shadow:0px 0px 0px 0px !important;">
                           <td style="width:40%">
                              <span style="font-weight: 500; display:inline-block; margin-top: 12px; font-size:18px;">General Data</span>
                           </td>
                         
                        </tr>
                     </tbody>
                  </table>
                <div class="border-pd">

		                       <div class="row">
                                    
                                    <div class="col-md-3">
                                        <div class="form-group tg-inputwithicon edit-icon-top">
                                        <label>Document Number<sup>*</sup></label>
                                            <i class="lnr lnr-apartment"></i>
                                            <input type="text" name="document_number" id="document_number-input" value="<?php echo (isset($result['document_number']))?$result['document_number']:''; ?>" class="form-control" placeholder="Document Number">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group tg-inputwithicon edit-icon-top">
                                            <label>Document Title<sup>*</sup></label>
                                            <i class="lnr lnr-apartment"></i>
                                            <input type="text" name="document_title" id="document_title-input" value="<?php echo (isset($result['document_title']))?$result['document_title']:''; ?>" class="form-control" placeholder="Document Title">
                                        </div>
                                    </div>
                               
								
							
                                    
                                    <div class="col-md-3">
                                        <div class="form-group tg-inputwithicon">
                                           
											<label>Document Category/ Type<sup>*</sup></label>
                                           <select onchange="getSubCategory(this.value)" name="document_category_id" id="document_category_id" class="form-control select1">						
											<option value="">Select Category</option>
										    <?php foreach ($category as $crow) : ?>
												 <?php $category = (isset($result['document_category_id']))?$result['document_category_id']:''; 
												 
												 $select ='';
												 if($category==$crow['id']){
													 $select ='selected="selected"';
												 }
												 
												 ?>
											
                                                <option <?php echo $select; ?> value="<?php echo $crow['id'] ?>"><?php echo $crow['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        </div>
                                    </div>
                                    

									 <div class="col-md-3">
                                        <div class="form-group tg-inputwithicon">
											<label>Sub Category </label>
                                            <select  name="document_subcategy_id" id="document_subcategy_id-input" value="" class="form-control">
										    <option value="">Select Sub Category</option>
											<?php foreach ($sub_cat as $hospital) : ?>
                                                <option value="<?php echo $hospital['sid'] ?>" <?php if($hospital['sid'] == $result['document_subcategy_id']) echo "selected";?>><?php echo $hospital['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        </div>
                                    </div>									
                                </div>
								
                                <div class="row">
                                    
                                    <div class="col-md-3">
                                        <div class="form-group tg-inputwithicon edit-icon-top">
                                            <label for="dob-input">Date of 1st Issue<sup>*</sup></label>
                                            <i class="lnr lnr-calendar-full"></i>
                                            <input type="date" name="date_of_1_issue" id="date_of_1_issue" value="<?php echo (isset($result['date_of_1_issue']))?$result['date_of_1_issue']:date("Y-m-d"); ?>" class="form-control" placeholder="Date of 1st Issue">
                                        </div>
                                    </div>
									
                                    <div class="col-md-3">
                                        <div class="form-group tg-inputwithicon edit-icon-top">
                                            <label for="dob-input">Date of Current Issue<sup>*</sup> </label>
                                            <i class="lnr lnr-calendar-full"></i>
                                            <input type="date" name="date_of_current_issue" id="date_of_current_issue" value="<?php echo (isset($result['date_of_current_issue']))?$result['date_of_current_issue']:''; ?>" class="form-control" placeholder="Date of Current Issue">
                                        </div>
                                    </div>
                              
                                    <div class="col-md-3">
                                        <div class="form-group tg-inputwithicon">
                                           <label>Live Revision Number </label>
										   <select name="live_revision_number" id="live_revision_number" value="" class="form-control select">
											<option value=" ">Select Live Revision Number</option>
                                            <?php for($i=1;$i<=10;$i++) : ?>
												
												<?php $live_revision_number = (isset($result['live_revision_number']))?$result['live_revision_number']:''; 
												 
												 $select ='';
												 if($live_revision_number==$i){
													 $select ='selected="selected"';
												 }
												 
												 ?>
												 
											
                                                <option <?php echo $select; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php endfor; ?>
											</select>
											
                                        </div>
                                    </div>
                                
                                    <div class="col-md-3">
                                         <div class="form-group tg-inputwithicon">                                           
											<label>Status<sup>*</sup></label>
											<select type="text" name="status" id="status_input" value="" class="form-control">
											<option value="">Select Status</option>
											<?php foreach($status as $k=>$val){ 
												$status = (isset($result['status']))?$result['status']:''; 
												 $select ='';
												 if($status==$k){
													 $select ='selected="selected"';
												 }
												echo '<option  '.$select.' value="'.$k.'">'.$val.'</option>';
											}
											?>
                                            
											 </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="gender-input">Location<sup>*</sup></label>
                                             <input type="text" name="location" id="location_input" value="<?php echo (isset($result['location']))?$result['location']:''; ?>" class="form-control" placeholder="Location">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group tg-inputwithicon edit-icon-top">
                                            <label for="dob-input">No. of Copies</label>
                                           
											
											<select name="no_of_copies" id="no_of_copies" value="" class="form-control select">
											<option value=" ">Select No. of Copies</option>
                                            <?php for($i=1;$i<=10;$i++) : ?>
												<?php 
												
												$no_of_copies = (isset($result['no_of_copies']))?$result['no_of_copies']:''; 
												 $select ='';
												 if($no_of_copies==$i){
													 $select ='selected="selected"';
												 }
												?>
											
                                                <option <?php echo $select; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php endfor; ?>
											</select>
											
                                        </div>
                                    </div>
                                
                                   
                                   <div class="col-md-3">
                                         <div class="form-group tg-inputwithicon">                                           
											<label>Interval Months<sup>*</sup></label>
											<select type="text" name="interval_months" id="interval_months-input" value="" class="form-control">
											<option value="">Select Interval Months</option>
											
											<?php foreach($interval_months as $k=>$val){ 
												$intervalmonths = (isset($result['interval_months']))?$result['interval_months']:''; 
												 $select ='';
												 if($intervalmonths==$k){
													 $select ='selected="selected"';
												 }
												echo '<option  '.$select.' value="'.$k.'">'.$val.'</option>';
											}
											?>
                                            
											</select>
                                        </div>
                                    </div>
                               
                                    <div class="col-md-3">
                                        <div class="form-group tg-inputwithicon edit-icon-top">
                                            <label for="address1-input">Revised Review Date<sup>*</sup></label>
                                            <i class="lnr lnr-calendar-full"></i>
                                            <input type="date" name="revised_review_date" id="revised_review_date" value="<?php echo (isset($result['revised_review_date']))?$result['revised_review_date']:''; ?>" class="form-control" placeholder="Revised Review Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group tg-inputwithicon">
                               
                                            <label for="address1-input">Obsolete Document Owner<sup>*</sup></label>
                                            <input type="text" name="obsolete_document_owner" id="obsolete_document_owner" value="<?php echo (isset($result['obsolete_document_owner']))?$result['obsolete_document_owner']:$loginUsername; ?>" class="form-control" placeholder="Obsolete Document Owner">
                                        </div>
                                    </div>
                               
                                    <div class="col-md-3">
                                        <div class="form-group tg-inputwithicon">
                                            <label for="address1-input">Issued to<sup>*</sup></label>
											<select name="issued_to" id="issued_to" value="" class="form-control select1">
											<option value="">Select Issued to</option>
                                            <?php foreach ($issueTo as $irow) : ?>
												<?php 
												
												$issued_to = (isset($result['issued_to']))?$result['issued_to']:''; 
												 $select ='';
												 if($issued_to==$irow['id']){
													 $select ='selected="selected"';
												 }
												
												?>
											
                                                <option <?php echo $select; ?> value="<?php echo $irow['id'] ?>"><?php echo $irow['name']; ?></option>
                                            <?php endforeach; ?>
											</select>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-3">
                                        <div class="form-group tg-inputwithicon edit-icon-top">
                                        <label>Document Information</label>
                                            <i class="lnr lnr-apartment"></i>
                                            <input type="text" name="document_Information" id="document_Information" value="<?php echo (isset($result['document_Information']))?$result['document_Information']:''; ?>" class="form-control" placeholder="Document Information">
                                        </div>
                                    </div>
                                </div>

                                                </div>
                           </div>	
	

	
	 <div class="row">
	 <div class="col-md-12">
			<div class="form-group tg-inputwithicon">
				<label for="address1-input">Disclaimer </label>
				<textarea name="disclaimer" id="disclaimer" class="texteditor"> 
					<?php echo (isset($result['disclaimer'])?$result['disclaimer']:'');  ?>
				</textarea>				
			</div>
		</div>
	 
	 
     	</div>
	 <div class="row">
	 <div class="col-md-12">
			<div class="form-group tg-inputwithicon">
				<label for="address1-input">Content</label>
				<textarea name="content" id="content" class="texteditor"> 
					<?php echo (isset($result['content'])?$result['content']:'');  ?>
				</textarea>				
			</div>
		</div>
	 
	 
     	</div>	
	
	
	 <div class="row">
	 <div class="col-md-12">
			<div class="form-group tg-inputwithicon">
				<label for="address1-input">Information</label>
				<textarea name="documents" id="documents" class="texteditor"> 
					<?php echo (isset($result['documents'])?$result['documents']:'');  ?>
				</textarea>				
			</div>
		</div>
	 
	 
     	</div>
		 
		
		<div class="row">
			<div class="col-md-12">
				<div class="form-group tg-inputwithicon">
					<label for="address1-input">Footer<sup>*</sup></label>
					<input type="text" name="footer" id="footer" value="<?php echo (isset($result['footer']))?$result['footer']:''; ?>" class="form-control" placeholder="Footer">
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

<script src="https://cdn.tiny.cloud/1/f8sp5zqzyxi13z9989lhfjelqs8ghu2obrs2i98ftniu66hx/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<!-- undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment
 -->

<!-- 
undo redo ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help | link image | code -->
 <script>
 
 
   tinymce.init({
        menubar: false,
        selector: '.texteditor',

        toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
        plugins: 'print preview importcss tinydrive searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons'
        // font_formats: "CircularStd=CircularStd;",
        // content_style: "@import url('https://db.onlinewebfonts.com/c/860c3ec7bbc5da3e97233ccecafe512e?family=CircularStd'); body { font-family: 'CircularStd' , sans-serif !important; font-size:18px; }"
    });
 
 
  </script>
