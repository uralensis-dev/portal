<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Document</h3>
            <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('Document_List') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Document</a></li>
            </ul>
        </div>
       
        <div class="col-auto float-right ml-auto">
           
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_document">Live</a>
            
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

<div class="container-fluid">

<?php echo form_open('', array('id' => 'add-document-form', 'class' => 'tg-formtheme tg-editform create_user_form')); ?>

		<div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-apartment"></i>
                                            <input type="text" name="document_number" id="document_number-input" value="" class="form-control" placeholder="Document Number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-apartment"></i>
                                            <input type="text" name="document_title" id="document_title-input" value="" class="form-control" placeholder="Document Title">
                                        </div>
                                    </div>
                                </div>
								
								<div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                           
											<label>Document Category/ Type</label>
                                            <select onchange="getSubCategory(this.value)" type="text" name="document_category_id" id="document_category_id" value="" class="form-control select">
											<option value="">Select Category</option>
										    <?php foreach ($category as $crow) : ?>
                                                <option value="<?php echo $crow['id'] ?>"><?php echo $crow['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        </div>
                                    </div>
                                    
									 <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">                                           
											<label>Sub Category </label>
                                            <select type="text" name="document_subcategy_id" id="document_subcategy_id-input" value="" class="form-control">
										    <option value=" ">Select Sub Category</option>
											<?php foreach ($hospitals as $hospital) : ?>
                                                <option value="<?php echo $hospital['id'] ?>"><?php echo $hospital['description']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        </div>
                                    </div>									
                                </div>
								
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <label for="dob-input">Date of 1st Issue</label>
                                            <i class="lnr lnr-calendar-full"></i>
                                            <input type="date" name="date_of_1_issue" id="date_of_1_issue" value="" class="form-control" placeholder="Date of 1st Issue">
                                        </div>
                                    </div>
									
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <label for="dob-input">Date of Current Issue </label>
                                            <i class="lnr lnr-calendar-full"></i>
                                            <input type="date" name="date_of_current_issue" id="date_of_current_issue" value="" class="form-control" placeholder="Date of Current Issue">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                           <label>Live Revision Number </label>
										   <select name="live_revision_number" id="live_revision_number" value="" class="form-control select">
											<option value=" ">Select Live Revision Number</option>
                                            <?php for($i=1;$i<=10;$i++) : ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php endfor; ?>
											</select>
											
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                         <div class="form-group tg-inputwithicon">                                           
											<label>Status </label>
											<select type="text" name="status" id="status_input" value="" class="form-control">
											<option value="">Select Status</option>
											<option value="1">Live</option>
                                             <option value="2">Obsolete </option>
											 </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender-input">Location</label>
                                             <input type="text" name="location" id="location_input" value="" class="form-control" placeholder="Location">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <label for="dob-input">No. of Copies</label>
                                            <i class="lnr lnr-calendar-full"></i>
											
											<select name="no_of_copies" id="no_of_copies" value="" class="form-control select">
											<option value=" ">Select No. of Copies</option>
                                            <?php for($i=1;$i<=10;$i++) : ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php endfor; ?>
											</select>
											
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   
                                   <div class="col-md-6">
                                         <div class="form-group tg-inputwithicon">                                           
											<label>Interval Months </label>
											<select type="text" name="interval_months" id="interval_months-input" value="" class="form-control">
											<option value=" ">Select Interval Months</option>
											<option value="12">12</option>
                                            <option value="24">24 </option>
											<option value="36">36 </option>
											</select>
                                        </div>
                                    </div>
                               
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <label for="address1-input">Revised Review Date (if reviewed early)</label>
                                            <i class="lnr lnr-calendar-full"></i>
                                            <input type="date" name="revised_review_date" id="revised_review_date" value="" class="form-control" placeholder="Revised Review Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                               
                                            <label for="address1-input">Obsolete Document Owner</label>
                                            <input type="text" name="obsolete_document_owner" id="obsolete_document_owner" value="" class="form-control" placeholder="Obsolete Document Owner">
                                        </div>
                                    </div>
                               
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <label for="address1-input">Issued to</label>
											<select name="issued_to" id="issued_to" value="" class="form-control select">
											<option value=" ">Select Issued to</option>
                                            <?php foreach ($issueTo as $irow) : ?>
                                                <option value="<?php echo $irow['id'] ?>"><?php echo $irow['name']; ?></option>
                                            <?php endforeach; ?>
											</select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-apartment"></i>
                                            <input type="text" name="document_Information" id="document_Information" value="" class="form-control" placeholder="Document Information">
                                        </div>
                                    </div>
                                </div>
								
	

	
	 <div class="row">
	 <div class="col-md-12">
			<div class="form-group tg-inputwithicon">
				<label for="address1-input">Disclaimer </label>
				<textarea name="disclaimer" id="document"> 
					<?php echo (isset($document_info['document_infomation'])?$document_info['document_infomation']:'');  ?>
				</textarea>				
			</div>
		</div>
	 
	 
     	</div>
		
		
	
	 <div class="row">
	 <div class="col-md-12">
			<div class="form-group tg-inputwithicon">
				<label for="address1-input">Content</label>
				<textarea name="content" id="document"> 
					<?php echo (isset($document_info['document_infomation'])?$document_info['document_infomation']:'');  ?>
				</textarea>				
			</div>
		</div>
	 
	 
     	</div>	
	
	
	 <div class="row">
	 <div class="col-md-12">
			<div class="form-group tg-inputwithicon">
				<label for="address1-input">Information</label>
				<textarea name="document_data" id="document"> 
					<?php echo (isset($document_info['document_infomation'])?$document_info['document_infomation']:'');  ?>
				</textarea>				
			</div>
		</div>
	 
	 
     	</div>
		 
		
		<div class="row">
			<div class="col-md-12">
				<div class="form-group tg-inputwithicon">
					<label for="address1-input">Footer</label>
					<input type="text" name="footer" id="footer" value="" class="form-control" placeholder="Footer">
				</div>
			</div>
			</div>
		
		 <div class="row">
						
		<button type="submit" style="margin:10px;" class="btn btn-primary btn-rounded create_new_next_button pull-right"
								id="create_new_record_btn"
								name="submit">Update Record
					  </button>
									
       
    </div>
	</form>	
	
	
</div>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

  
<script>tinymce.init({selector:'#document'});</script>
