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
.red_dot{
    color: red;
}
</style>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title"><?php echo (isset($page_title))?$page_title:'Risk Register Section' ?></h3>
            <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('Document') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('Risk_Register'); ?>">Risk Register</a></li>
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

<div class="tg-editformholder">
                    <?php echo form_open('', array('id' => 'add-risk-form', 'class' => 'tg-formtheme tg-editform create_user_form')); ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <!-- Patient Personal Information START -->
                            <fieldset>
									
								<div class="row">
                                    
                                    <div class="col-md-6">
                                    <label for="address1-input">Project Name<span class="red_dot">  *</span></label>
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-apartment"></i>
                                            <input type="text" name="project_name" id="project_name" value="<?php echo (isset($result['project_name']))?$result['project_name']:''; ?>" class="form-control" placeholder="Project Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
									    <div class="form-group tg-inputwithicon">
                                         <label for="address1-input">Project Manager<span class="red_dot">  *</span></label>
										    <select name="project_manager_id" id="project_manager_id" value="" class="form-control select" required="required">
											<option value="">Select Project Manager</option>
										    <?php foreach ($user_info as $crow) : ?>
											     <?php 
												 $project_manager_id =(isset($result['project_manager_id']))?$result['project_manager_id']:'';   
													$select = '';
													if($project_manager_id==$crow['id']){
														$select = 'selected="selected"';
													}
												 ?>
												 
                                                <option <?php echo $select; ?> value="<?php echo $crow['id'] ?>"><?php echo $crow['first_name']." ".$crow['last_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        </div>
									   
                                    </div>
                                </div>
								
								<div class="row">
                                    
                                    <div class="col-md-12">
                                         <div class="form-group tg-inputwithicon">
                                            <label for="address1-input">Risk Description<span class="red_dot">  *</span></label>
                                            <textarea name="risk_description" class="form-control" rows="4" cols="124" required><?php echo (isset($result['risk_description']))? trim($result['risk_description']):''; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                           
											<label>Category<span class="red_dot">  *</span></label>
                                            <select onchange="getSubCategory(this.value)" type="text" name="risk_register_category_id" id="risk_register_category_id" value="" class="form-control select" required="required">
											<option value="">Select Category</option>
										    <?php foreach ($category as $crow) : ?>
											
											 <?php 
												 $risk_register_category_id =(isset($result['risk_register_category_id']))?$result['risk_register_category_id']:'';   
													$select = '';
													if($risk_register_category_id==$crow['id']){
														$select = 'selected="selected"';
													}
												 ?>
												
                                                <option <?php echo $select; ?> value="<?php echo $crow['id'] ?>"><?php echo $crow['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        </div>
                                    </div>
                                    
									 <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">                                           
											<label>Sub Category <span class="red_dot">  *</span></label>
                                            <select  name="risk_register_subcategy_id" id="risk_register_subcategy_id"  class="form-control select" required="required">
										    <option value="">Select Sub Category</option>
											 <?php foreach ($subcategoey as $crow) : ?>
											
											 <?php 
												 $risk_register_subcategy_id =(isset($result['risk_register_subcategy_id']))?$result['risk_register_subcategy_id']:'';   
													$select = '';
													if($risk_register_subcategy_id==$crow['id']){
														$select = 'selected="selected"';
													}
												 ?>
												
                                                <option <?php echo $select; ?> value="<?php echo $crow['id'] ?>"><?php echo $crow['name']; ?></option>
                                            <?php endforeach; ?>
											
                                        </select>
                                        </div>
                                    </div>									
                                </div>
								
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <label for="dob-input">Date Raised <span class="red_dot">  *</span></label>
                                            <input type="date" name="date_raised" id="date_raised" value="<?php echo (isset($result['date_raised']))?$result['date_raised']: date("Y-m-j") ; ?>" class="form-control" placeholder="Date Raised">
                                        </div>
                                    </div>
									
                                    <div class="col-md-6">
                                        
										<div class="form-group tg-inputwithicon">
											<label>Likelihood<span class="red_dot">  *</span></label>
                                            <select type="text" name="likelihood_id" id="likelihood_id" value="" class="form-control select" required="required">
											<option value="">Select Likelihood</option>
										    <?php foreach ($likelihood as $crow) : ?>
												
												<?php 
												 $likelihood_id =(isset($result['likelihood_id']))?$result['likelihood_id']:'';   
													$select = '';
													if($likelihood_id==$crow['id']){
														$select = 'selected="selected"';
													}
												 ?>
											
                                                <option <?php echo $select; ?> value="<?php echo $crow['id'] ?>"><?php echo $crow['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        </div>
										
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                       
									   <div class="form-group tg-inputwithicon">
											<label>Impact<span class="red_dot">  *</span> </label>
                                            <select type="text" name="Impact_id" id="Impact_id" value="" class="form-control select" required="required">
											<option value="">Select Impact </option>
										    <?php foreach ($impact as $crow) : ?>
												
												<?php 
												 $Impact_id =(isset($result['Impact_id']))?$result['Impact_id']:'';   
													$select = '';
													if($Impact_id==$crow['id']){
														$select = 'selected="selected"';
													}
												 ?>
											
                                                <option <?php echo $select; ?> value="<?php echo $crow['id'] ?>"><?php echo $crow['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        </div>
									   
                                    </div>
                                
                                    <div class="col-md-6">
                                        
										 <div class="form-group tg-inputwithicon">
											<label>Severity <span class="red_dot">  *</span></label>
                                            <select type="text" name="severity_id" id="severity_id" value="" class="form-control select" required="required">
											<option value="">Select Severity </option>
										    <?php foreach ($severity as $crow) : ?>
												
												<?php 
												 $severity_id =(isset($result['severity_id']))?$result['severity_id']:'';   
													$select = '';
													if($severity_id==$crow['id']){
														$select = 'selected="selected"';
													}
												 ?>
											
                                                <option <?php echo $select; ?> value="<?php echo $crow['id'] ?>"><?php echo $crow['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        </div>
										
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender-input">Mitigating Actions</label>
                                             <input type="text" name="mitigating_actions" id="mitigating_actions" value="<?php echo (isset($result['mitigating_actions']))?$result['mitigating_actions']:''; ?>" class="form-control" placeholder="Mitigating Actions">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <label for="dob-input">Status<span class="red_dot">  *</span></label>
                                            
											<select name="status" id="status" value="" class="form-control select" required="required">
											<option value="">Select Status</option>
											<?php foreach($status as $sr=>$row){
													$status =(isset($result['status']))?$result['status']:'';   
													$select = '';
													if($status==$sr){
														$select = 'selected="selected"';
													 }
												
													echo '<option '.$select.' value="'.$sr.'">'.$row.'</option>';
												
												}
											?>
												
											</select>
											
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   
                                   <div class="col-md-6">
                                         <div class="form-group tg-inputwithicon">     
											<label for="address1-input">Date Closed</label>
                                            <input type="date" name="date_closed" id="date_closed" value="<?php echo (isset($result['date_closed']))?$result['date_closed']: date("Y-m-j"); ?>" class="form-control" placeholder="Date Closed">                                      
											
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">     
                                            <label for="address1-input">Risk Reference</label>
                                            <input type="text" name="risk_ref" value="<?php echo (isset($result['risk_ref']))?$result['risk_ref']:''; ?>" class="form-control">                                      
                                            
                                        </div>
                                    </div>
                               
                                    
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                         <div class="form-group tg-inputwithicon">     
                                            <label for="address1-input">Source Of Businnes Risk</label>
                                            <input type="text" name="risk_source" value="<?php echo (isset($result['risk_source']))?$result['risk_source']:''; ?>" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">     
                                            <label for="address1-input">Current Controls</label>
                                            <input type="text" name="current_controls" value="<?php echo (isset($result['current_controls']))?$result['current_controls']:''; ?>" class="form-control">
                                        </div>
                                    </div>  


                                   <div class="col-md-6">
                                         <div class="form-group tg-inputwithicon">     
                                            <label for="address1-input">Cons</label>
                                            <!-- <textarea name="risk_cons" class="form-control" rows="4" cols="124"><?php //echo (isset($result['risk_cons']))?$result['risk_cons']:''; ?></textarea> -->
                                            <input type="text" name="risk_cons" value="<?php echo (isset($result['risk_cons']))?$result['risk_cons']:''; ?>" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">     
                                            <label for="address1-input">Likely</label>
                                            <!-- <textarea name="likely" class="form-control" rows="4" cols="124"><?php //echo (isset($result['likely']))?$result['likely']:''; ?></textarea> -->
                                            <input type="text" name="likely" value="<?php echo (isset($result['likely']))?$result['likely']:''; ?>" class="form-control">
                                        </div>
                                    </div>   

                                     <div class="col-md-6">
                                         <div class="form-group tg-inputwithicon">     
                                            <label for="address1-input">Risk Score</label>
                                            <!-- <input type="text" name="risk_score" value="<?php //echo (isset($result['risk_score']))?$result['risk_score']:''; ?>" class="form-control"> -->
                                            <select name="risk_score" class="form-control">
                                                <?php 
                                                    for ($i=1; $i < 26; $i++) { 
                                                        $selected = $result['risk_score'] == $i ? " selected":'';
                                                        echo "<option value=".$i."$selected>$i</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">     
                                            <label for="address1-input">Risk Level</label>
                                            <select name="risk_level" class="form-control">
                                                <option value="E">Extreme</option>
                                                <option value="H">High</option>
                                                <option value="M">Moderate</option>
                                                <option value="L">Low</option>
                                            </select>
                                        </div>
                                    </div> 

                                    <div class="col-md-12">
                                         <div class="form-group tg-inputwithicon">     
                                            <label for="address1-input">Action Plan And Progress</label>
                                            <textarea rows="4" cols="124" class="form-control" name="action_plan_progress"><?php echo (isset($result['action_plan_progress']))?$result['action_plan_progress']:''; ?></textarea>
                                            <!-- <input type="text" name="action_plan_progress" value="<?php //echo (isset($result['action_plan_progress']))?$result['action_plan_progress']:''; ?>" class="form-control"> -->
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                         <div class="form-group tg-inputwithicon">     
                                            <label for="address1-input">Cost(£) pa<span class="red_dot">  *</span></label>
                                            <input type="text" name="risk_cost" value="<?php echo (isset($result['risk_cost']))?$result['risk_cost']:''; ?>" class="form-control" required="required">
                                        </div>
                                    </div>

                                     <div class="col-md-6">
                                         <div class="form-group tg-inputwithicon">     
                                            <label for="address1-input">Risk Owner</label>
                                            <input type="text" name="risk_owner" value="<?php echo (isset($result['risk_owner']))?$result['risk_owner']:''; ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                         <div class="form-group tg-inputwithicon">     
                                            <label for="address1-input">Date On Register</label>
                                            <input type="date" name="register_date" value="<?php echo (isset($result['register_date']))?$result['register_date']: date("Y-m-j"); ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success" id="user-create-btn">Submit</button>
                                    
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    </form>
                </div>



<div id="add_document" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">New Risk Register</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
				
				<div id="notification-message" class="alert ">
					
				</div>
				
            </div>
            <div class="modal-body">
                <div class="tg-editformholder">
                    <?php echo form_open('', array('id' => 'add-risk-form', 'class' => 'tg-formtheme tg-editform create_user_form')); ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <!-- Patient Personal Information START -->
                            <fieldset>
									
								<div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-apartment"></i>
                                            <input type="text" name="project_name" id="project_name" value="" class="form-control" placeholder="Project Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
									    <div class="form-group tg-inputwithicon">
										    <select name="project_manager_id" id="project_manager_id" value="" class="form-control select">
											<option value="">Select Project Manager</option>
										    <?php foreach ($user_info as $crow) : ?>
                                                <option value="<?php echo $crow['id'] ?>"><?php echo $crow['first_name']." ".$crow['last_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        </div>
									   
                                    </div>
                                </div>
								
								<div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                           
											<label>Category</label>
                                            <select onchange="getSubCategory(this.value)" type="text" name="risk_register_category_id" id="risk_register_category_id" value="" class="form-control select">
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
                                            <select type="text" name="risk_register_subcategy_id" id="risk_register_subcategy_id" value="" class="form-control">
										    <option value=" ">Select Sub Category</option>
											
                                        </select>
                                        </div>
                                    </div>									
                                </div>
								
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <label for="dob-input">Date Raised</label>
                                            <input type="date" name="date_raised" id="date_raised" value="" class="form-control" placeholder="Date Raised">
                                        </div>
                                    </div>
									
                                    <div class="col-md-6">
                                        
										<div class="form-group tg-inputwithicon">
											<label>Likelihood</label>
                                            <select type="text" name="likelihood_id" id="likelihood_id" value="" class="form-control select">
											<option value="">Select Likelihood</option>
										    <?php foreach ($likelihood as $crow) : ?>
                                                <option value="<?php echo $crow['id'] ?>"><?php echo $crow['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        </div>
										
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                       
									   <div class="form-group tg-inputwithicon">
											<label>Impact </label>
                                            <select type="text" name="Impact_id " id="Impact_id" value="" class="form-control select">
											<option value="">Select Impact </option>
										    <?php foreach ($impact as $crow) : ?>
                                                <option value="<?php echo $crow['id'] ?>"><?php echo $crow['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        </div>
									   
                                    </div>
                                
                                    <div class="col-md-6">
                                        
										 <div class="form-group tg-inputwithicon">
											<label>Severity </label>
                                            <select type="text" name="severity_id " id="severity_id" value="" class="form-control select">
											<option value="">Select Severity </option>
										    <?php foreach ($severity as $crow) : ?>
                                                <option value="<?php echo $crow['id'] ?>"><?php echo $crow['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        </div>
										
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender-input">Mitigating Actions</label>
                                             <input type="text" name="mitigating_actions" id="mitigating_actions" value="" class="form-control" placeholder="Mitigating Actions">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <label for="dob-input">Status</label>
                                            
											<select name="status" id="status" value="" class="form-control select">
											<option value="">Select Status</option>
											<option value="1">Open</option>
											<option value="2">Closed</option>
                                            
											</select>
											
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   
                                   <div class="col-md-6">
                                         <div class="form-group tg-inputwithicon">     
											<label for="address1-input">Date Closed</label>
                                            <input type="date" name="date_closed" id="date_closed" value="" class="form-control" placeholder="Date Closed">                                      
											
                                        </div>
                                    </div>
                               
                                    <div class="col-md-6">
                                         <div class="form-group tg-inputwithicon">
                                            <label for="address1-input">Risk Description</label>
                                            
                                            <input type="text" name="risk_description" id="risk_description" value="" class="form-control" placeholder="Risk Description">
                                        </div>
                                    </div>
                                </div>
                                
                               
                                
                                <div class="form-group">
                                    <button class="btn btn-success" id="user-create-btn">Create</button>
                                    <button class="btn btn-warning" id="user-form-clear-btn" type="button">Clear</button>
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