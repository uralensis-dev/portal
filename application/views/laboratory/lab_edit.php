<!-- Page Content -->
<style type="text/css">
    .view-all {
        margin-left: auto;
        margin-right: 0;
        border-radius: 5px;
    }
    .section_title {
        font-size: 22px;
        font-weight: 500;
        padding: 0px 0 20px;
        display: block;
    }

    img.setting_images {
        width: 40px;
        height: 40px;
        margin-bottom: 15px;
    }

    .text {
        font-size: 16px;
        font-weight: 500;
    }

    .user_image {
        max-width: 40px;
        border-radius: 20px;
        margin-right: 5px;
    }

    .breadcrumb-item+.breadcrumb-item::before {
        display: inline-block;
        padding-right: .5rem;
        color: #6c757d;
        content: "/";
    }
    .error_list {
        margin: 15px 0px;
        background-color: red;
        color: white;
        padding: 10px;
        border-radius: 5px;
    }
    .success_list {
        margin: 15px 0px;
        background-color: lightgreen;
        color: white;
        padding: 10px;
        border-radius: 5px;
    }
</style>

<div class="content container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Laboratory Setting</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">Laboratory Setting</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
            </div>
        </div>
    </div>

    <?php if ($this->session->flashdata('error') != '') { ?>
        <div class="error_list">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('success') != '') { ?>
        <div class="success_list">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php } ?>
   
<form action="<?php echo base_url('laboratory/labsetting'); ?>" id="laboratory_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

    <div class="row">
        <div class="col-md-12">
            <section class="form-group">
                <div class="card profile-box flex-fill">
                    <div class="card-body">
                        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
                        <p class="text-danger"></p>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Laboratory Name <span class="text-danger">*</span></label>
                                    <input class="form-control <?php if ($errors) echo empty($form_data['laboratory_name']['error']) ? 'is-valid' : 'is-invalid' ?>" <?php if ($errors) echo empty($form_data['laboratory_name']['error']) ? '' : 'aria-invalid="true"' ?> name="laboratory_name" id="laboratory_name" type="search" value="<?php print $lab_info['name']; ?>">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['laboratory_name']['error'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>First Initial<span class="text-danger">*</span></label>
                                    <input class="form-control <?php if ($errors) echo empty($form_data['laboratory_initials_1']['error']) ? 'is-valid' : 'is-invalid';  ?>" <?php if ($errors) echo empty($form_data['laboratory_initials_1']['error']) ? '' : 'aria-invalid="true"' ?> name="laboratory_initials_1" id="laboratory_initials_1" maxlength="1" type="text" value="<?php print $lab_info['first_initial']; ?>">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['laboratory_initials_1']['error'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Second Initial<span class="text-danger">*</span></label>
                                    <input class="form-control <?php if ($errors) echo empty($form_data['laboratory_initials_2']['error']) ? 'is-valid' : 'is-invalid';  ?>" <?php if ($errors) echo empty($form_data['laboratory_initials _2']['error']) ? '' : 'aria-invalid="true"' ?> name="laboratory_initials_2" id="laboratory_initials_2" maxlength="1" type="text" value="<?php print $lab_info['last_initial']; ?>">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['laboratory_initials_2']['error'] ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" name="lab_address" id="lab_address" value="<?php print $lab_info['lab_address']; ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control" name="lab_country" id="lab_country">
                                        <option value="">Select Country</option>
                                        
                                        <?php foreach ($countries as $country) {
                                            $selected = ($country['id'] == $lab_info['lab_country']) ? 'selected' : '';
                                            ?>
                                            <?php if ($errors && $country['id'] === $lab_info['lab_country']) $selected = 'selected'; ?>
                                            <option <?php echo $selected; ?> value="<?php echo $country['id']; ?>"><?php echo $country['nicename']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>City</label>
                                    <input class="form-control" name="lab_city" id="lab_city" value="<?php print $lab_info['lab_city']; ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>State/Province</label>
                                    <input class="form-control" type="text" name="lab_state" id="lab_state" placeholder="" value="<?php print $lab_info['lab_state']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input class="form-control" name="lab_post_code" <?php echo $errors ? $form_data['lab_post_code']['value'] : ''; ?> id="lab_post_code" value="<?php print $lab_info['lab_post_code']; ?>" type="text">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control <?php if ($errors) echo empty($form_data['laboratory_email']['error']) ? 'is-valid' : 'is-invalid' ?>" <?php if ($errors) echo empty($form_data['laboratory_email']['error']) ? '' : 'aria-invalid="true"' ?> name="laboratory_email" id="laboratory_email" value="<?php print $lab_info['lab_email']; ?>" type="email">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['laboratory_email']['value']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input class="form-control" name="lab_phone" id="lab_phone" value="<?php print $lab_info['lab_phone']; ?>" type="text">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input class="form-control" name="lab_mobile" id="lab_mobile" value="<?php print $lab_info['lab_mobile']; ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fax</label>
                                    <input class="form-control" name="lab_fax" id="lab_fax" value="<?php print $lab_info['lab_fax']; ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Website Url</label>
                                    <input class="form-control <?php if ($errors) echo empty($form_data['laboratory_website']['error']) ? 'is-valid' : 'is-invalid' ?>" <?php if ($errors) echo empty($form_data['laboratory_website']['error']) ? '' : 'aria-invalid="true"' ?> name="lab_website" id="lab_website" value="<?php print $lab_info['lab_website']; ?>" type="text">
                                    <div class="invalid-feedback">                                        
                                    </div>
                                </div>
                            </div>  
                            <div class="col-md-12 text-right">
                                    <button class="btn btn-success">Update</button>
                                </div>                          
                        </div>
                    </div>
                </div>
            </section>
<!--            <section class="form-group">
                <div class="section_title">Account Holders</div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label><img src="<?php echo base_url() ?>assets/img/user.jpg" class="user_image"/>
                                    Account Holder</label>
                                <select class="select form-control" id="account_holder">                                    
                                    <?php foreach ($lab_users as $user) : ?>
                                        <option value="<?php echo $user['id']; ?>"><?php echo $user['first_name'] . ' ' . $user['last_name'] . ' (' . $user['email'] . ')'; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                          <div class="col-md-6">
                                <label><img src="<?php echo base_url() ?>assets/img/user.jpg" class="user_image"/>
                                    Deputy Account Holder</label>
                                <select class="select form-control" id="deputy_account_holder">
                                    
                                    <?php foreach ($lab_users as $user) : ?>
                                        <option value="<?php echo $user['id']; ?>"><?php echo $user['first_name'] . ' ' . $user['last_name'] . ' (' . $user['email'] . ')'; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </section>-->
          
           <h3 class="mb-4">Connections</h3>
            <section>
                                                 
                <div class="row">
                <?php
                foreach($get_hosp_count as $Lhos_data)
				{				
				?>
                   
                 <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><img src="<?php echo base_url() ?>assets/icons/Laboratory.png" alt=""></span>
                                <div class="dash-widget-info">
                                    <h3 id="lab-count-title"><?php print $Lhos_data->total_hosp; ?></h3>
                                    <span><a href="<?php echo base_url() ?>customer/labcustomer">Customers</a></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                   <?php } ?>


                    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><img src="<?php echo base_url() ?>assets/icons/pathologist.png" alt=""></span>
                                <div class="dash-widget-info">
                                    <h3 id="lab-count-title"><?php echo $pathologist_count; ?></h3>
                                    <span><a href="<?= base_url('laboratory/pathologist_view'); ?>">Pathologist</a></span>
                                </div>
                            </div>
                        </div>
                    </div>

                 </div>
            </section>
          
           
           <section class="form-group">
<div class="section_title">Finance</div>
                <div class="row">                                        
                    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card dash-widget" onclick="openGroupModal('L');">
                            <div class="card-body">

                                <span class="dash-widget-icon"><img src="<?php echo base_url() ?>assets/icons/Laboratory.png" alt=""></span>
                                <div class="dash-widget-info">
                                    <h3 id="lab-count-title">0</h3>
                                    <span><a href="#">Customers</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>                   
</section> 
           
           
         
           
           
        </div>
    </div>
<!--    <button disable="true" id="form-submit-btn" class="btn btn-success btn-rounded">Submit</button>-->
    </form>
     <?php if($group_type =="LA") { ?> 
     <section class="form-group">

        
                <div class="section_title">Add Users</div>
                <div class="row">

                    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card dash-widget" onclick="openCategoryModal('<?php echo $group_type?>', '<?php echo $group_id;?>');">
                            <div class="card-body">
                                <span class="dash-widget-icon"><img
                                            src="<?php echo base_url() ?>assets/icons/Clinical-Physician.png"
                                            alt=""></span>

                                <div class="dash-widget-info">
                                    <h3 id="c-count-title"></h3>
                                    <span><a href="#">Add LAB User</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

         <section class="form-group">
             <div class="section_title">Admin Settings</div>
             <div class="row">
                 <div class="col-md-3 col-sm-6 text-center form-group">
                     <div class="card" style="min-height: 121px;">
                         <div class="card-body dash-widget" data-toggle="modal" data-target="#add_template_modal">
                             <img src="<?= base_url('assets/icons/admin_set01.png'); ?>" class="setting_images">
                             <div class="text">Report Template(<?= $total_lab_templates; ?>)</div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-3 col-sm-6 text-center form-group">
                     <div class="card dash-widget" style="min-height: 121px;">
                         <div class="card-body">
                             <img src="<?= base_url('assets/icons/admin_set02.png'); ?>" class="setting_images">
                             <div class="text">MDT Dates</div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-3 col-sm-6 text-center form-group">
                     <div class="card dash-widget" style="min-height: 121px;">
                         <div class="card-body">
                             <img src="<?= base_url('assets/icons/admin_set03.png'); ?>" class="setting_images">
                             <div class="text">Short Codes</div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-3 col-sm-6 text-center form-group">
                     <div class="card dash-widget" style="min-height: 121px;">
                         <div class="card-body">
                             <img src="<?= base_url('assets/icons/admin_set04.png'); ?>" class="setting_images">
                             <div class="text">Clinic Dates</div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-3 col-sm-6 hidden-xs hidden-sm text-center form-group">
                     <div class="card dash-widget" style="min-height: 121px;">
                         <div class="card-body">
                             <img src="<?= base_url('assets/icons/admin_icon.png '); ?>" class="setting_images">

                             <div class="text">
                                 <a href="<?php echo base_url("leaveManagement/leaveSettings") ?>" style="color: #333">Leave
                                     Settings</a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-3 col-sm-6 hidden-xs hidden-sm text-center form-group">
                     <div class="card dash-widget" style="min-height: 121px;">
                         <div class="card-body">
                             <img src="<?= base_url('assets/icons/admin_set01.png'); ?>" class="setting_images">

                             <div class="text">
                                 <a href="<?php echo base_url("leaveManagement/leaveRequests") ?>" style="color: #333">Leave
                                     Requests</a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-md-3 col-sm-6 hidden-xs hidden-sm text-center form-group">
                     <div class="card dash-widget" style="min-height: 121px;">
                         <div class="card-body">

          <span class="dash-widget-icon"><img
                      src="<?php echo base_url() ?>assets/icons/Pathologist.png" alt=""></span>
                             <div class="dash-widget-info" data-toggle="modal" data-target="#courier_user_modal">
                                 <h3 id="ds-count-title"></h3>
                                 <span><a href="#">Courier</a></span>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <!--        </div>-->
         </section>

         <section class="form-group">
             <div class="section_title">Security</div>
             <div class="row">
                 <div class="col-md-2 col-sm-6 text-center form-group">
                     <div class="card dash-widget" style="min-height: 121px;">
                         <div class="card-body change_time_div">
                             <img src="<?= base_url('assets/icons/admin_set04.png'); ?>" class="setting_images">
                             <div class="text">Password Expiry Time</div>
                         </div>
                     </div>
                 </div>
             </div>
         </section>
     <?php } ?>
    
    
    
    
    <div id="category-modal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Users</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h3>User</h3>
                        </div>
                        <div class="col-md-6 text-right">

                            <a href="#" id="add-category-btn" class="btn add-btn"><i class="fa fa-plus"></i><span>User</span></a>
                        </div>
                    </div>
                    <ul class="list-group" id="category-list-container">

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="add-user-modal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">New User</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card mb-4 ac-card">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <button class="btn btn-primary" data-toggle="collapse"
                                        data-target="#active-directory-select-container">Active Directory
                                </button>
                            </div>
                        </div>
                        <div class="collapse" id="active-directory-select-container"></div>

                    </div>
                    <div class="tg-editformholder">
                        <?php if (array_key_exists('general', $user_error)) : ?>
                            <div class="row">
                                <div class="col">
                                    <p style="color: red;">Cannot create user now try again later</p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php echo form_open_multipart("institute/create_user_lab", array('class' => 'tg-formtheme tg-editform create_user_form')); ?>
                        <input type="hidden" name="user_group_type" id="user_group_type" />
                        <div class="card mb-4">
                            <div class="card-body">
                                <!-- Profile Picture Input -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-img-wrap edit-img">
                                            <img class="inline-block" id="profile-pic-preview"
                                                 src="<?php echo base_url('assets/newtheme/img/profiles/avatar-02.jpg'); ?>"
                                                 alt="user">
                                            <div class="fileupload btn">
                                                <san class="btn-text">edit</span>
                                                    <input class="upload" type="file" id="profile-pic" name="profile_pic"
                                                           accept="image/*"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- User Personal Information START -->
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group tg-inputwithicon">
                                                <i class="lnr lnr-lock"></i>
                                                <select class="select2 form-control" name="user_group_type" id="user_group_type" required="required">
                                                    <option value="">Select User Type</option>
                                                    <?php foreach ($getAllLabsUsersGroup as $groupKey => $groupValue) { ?>
                                                        <option value="<?php echo $groupValue['id']; ?>"><?php echo $groupValue['description']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group tg-inputwithicon">
                                                <i class="lnr lnr-user"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'first_name', 'id' => 'first_name', 'value' => $user_data['first_name'], 'class' => 'form-control ' . (array_key_exists('first_name', $user_error) ? 'is-invalid' : ''), 'placeholder' => 'First Name')); ?>
                                                <div class="invalid-feedback">
                                                    Please provide a valid name
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group tg-inputwithicon">
                                                <i class="lnr lnr-user"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'last_name', 'id' => 'last_name', 'value' => $user_data['last_name'], 'class' => 'form-control', 'placeholder' => 'Last Name')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group tg-inputwithicon">
                                                <i class="lnr lnr-apartment"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'company', 'id' => 'company', 'value' => $user_data['company'], 'class' => 'form-control', 'placeholder' => 'Company Name')); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group tg-inputwithicon">
                                                <i class="lnr lnr-phone-handset"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'phone', 'id' => 'phone', 'value' => $user_data['phone'], 'class' => 'form-control', 'placeholder' => 'Phone')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group tg-inputwithicon">
                                        <i class="lnr lnr-envelope"></i>
                                        <?php echo form_input(array('type' => 'text', 'name' => 'email', 'id' => 'email', 'value' => $user_data['email'], 'class' => 'form-control check_email' . (array_key_exists('email', $user_error) ? 'is-invalid' : ''), 'placeholder' => 'Email')); ?>
                                        <span id="email_span" style="display: none;color: red"></span>
                                        <div class="invalid-feedback">
                                            <?php echo array_key_exists('email', $user_error) ? $user_error['email'] : ''; ?>
                                        </div>
                                    </div>
                                    <div class="row" id="password-row">
                                        <div class="col-md-6">
                                            <div class="form-group tg-inputwithicon">
                                                <i class="lnr lnr-lock"></i>
                                                <?php echo form_input(array('type' => 'password', 'name' => 'password', 'id' => 'password', 'value' => '', 'class' => 'form-control show_pass pr-password check_password', 'placeholder' => 'Password')); ?>
                                                <div class="view_password"><i class="fa fa-eye"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group tg-inputwithicon">
                                                <i class="lnr lnr-lock"></i>
                                                <?php echo form_input(array('type' => 'password', 'name' => 'password_confirm', 'id' => 'password_confirm', 'value' => '', 'class' => 'form-control show_pass check_password', 'placeholder' => 'Retype Password')); ?>
                                                <span id="confirm_span" style="display: none;color: red">Password not matched</span>
                                                <div class="view_password"><i class="fa fa-eye"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group tg-inputwithicon" id="memo-row">
                                                <i class="lnr lnr-apartment"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'memorable', 'id' => 'memorable', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Memorable', 'maxlength' => 10, 'size' => 10)); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group tg-inputwithicon" id="pin-row">
                                                <i class="lnr lnr-apartment"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'pin_code', 'id' => 'pin_code', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Pin Code', 'maxlength' => 4, 'size' => 4)); ?>
                                            </div>
                                        </div>
                                        <!--                                    <div class="col-md-6">-->
                                        <!--                                        <div class="form-group tg-inputwithicon">-->
                                        <!--                                            <i class="lnr lnr-lock"></i>-->
                                        <!--                                            --><?php //echo form_input(array('type' => 'text', 'name' => 'company', 'id' => 'company', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Organisation/ Company')); ?>
                                        <!--                                        </div>-->
                                        <!--                                    </div>-->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group tg-inputwithicon">
                                                <i class="lnr lnr-lock"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'address1', 'id' => 'address1', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Address 1')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group tg-inputwithicon">
                                                <i class="lnr lnr-lock"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'address2', 'id' => 'address2', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Address 2')); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
    <!--                                    <div class="col-md-6">
                                            <div class="form-group tg-inputwithicon">
                                                <i class="lnr lnr-lock"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'county', 'id' => 'county', 'value' => '', 'class' => 'form-control', 'placeholder' => 'County')); ?>
                                            </div>
                                        </div>-->
                                        <div class="col-md-6">
                                            <div class="form-group tg-inputwithicon">
                                                <i class="lnr lnr-lock"></i>
                                                <select class="select2 form-control" name="country" id="country">
                                                    <option value="">Select Country</option>
                                                    <?php foreach ($countries as $country) { ?>
                                                        <option value="<?php echo $country['nicename']; ?>"><?php echo $country['nicename']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                            <div class="col-md-6">
                                            <div class="form-group tg-inputwithicon">
                                                <i class="lnr lnr-lock"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'postcode', 'id' => 'postcode', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Post Code')); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group tg-inputwithicon">
                                                <i class="lnr lnr-lock"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'telephone', 'id' => 'telephone', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Telephone No.')); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="group_id" value="<?php echo $user_data['group_id'] ?>">
                                    <input type="hidden" name="active_directory_user"
                                           value="<?php echo $user_data['active_directory_user'] ?>">
                                    <div class="form-group">
                                        <button class="btn btn-success" id="user-create-btn">Create</button>
                                        <button class="btn btn-warning" id="user-form-clear-btn" type="button">Clear
                                        </button>
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
</div>

<div class="modal fade" id="add_template_modal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Template</h4>
                <div class="view-all">
                    <a class="btn btn-info" href="<?= base_url('laboratory/lab_template'); ?>"><i class="fa fa-eye m-r-5"></i> View All</a>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('laboratory/add_template'); ?>" enctype="multipart/form-data" id="add_template" class="tg-formtheme tg-editform create_user_form">
            <?php //echo form_open_multipart("laboratory/add_template", array('method'=>'post', 'class' => 'tg-formtheme tg-editform create_user_form', 'id'=>'add_template')); ?>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="group_id" value="<?= $group_id; ?>" />
                    <input type="hidden" name="lab_id" value="<?= $user_id; ?>" />
                    <div class="col-md-9 form-group">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="focus-label">Template Name</label>
                                <input type="text" name="template_name" value="" class="form-control input-lg" placeholder="Enter template name">
                                <span class="text-danger"><?php echo form_error('template_name'); ?></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="focus-label">Categories:</label>
                                <select name="category_id" class="select2" data-rule-required='true'>
                                    <option value="">Select Category</option>
                                    <?php foreach ($categories as $category) { ?>
                                        <option value="<?= $category['id']; ?>"><?= $category["name"]; ?></option>
                                    <?php } ?>
                                </select>
                            </div><div class="col-md-6 form-group">
                                <label class="focus-label">Clinic:</label>
                                <select name="hospital_id" class="select2 clinic" data-rule-required='true' id="hospital_id">
                                    <option value="">Select Clinic</option>
                                    <?php foreach ($hospital_list as $hospital) { ?>
                                        <option value="<?= $hospital['hosp_id']; ?>" data-group-id="<?= $hospital["group_id"]; ?>"><?= $hospital["name"]; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="profile-img-wrap edit-img">
                            <img class="inline-block" id="profile-pic-preview" src="<?= base_url('assets/newtheme/img/profiles/avatar-02.jpg'); ?>" alt="user">
                            <div class="fileupload btn">
                                <span class="btn-text">edit</span>
                                <input class="upload" type="file" id="files" name="files[]" accept="image/*"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="focus-label">Header</label>
                        <textarea type="text" name="header" class="form-control input-lg" rows="5" placeholder="Enter header content"></textarea>
                        <span class="text-danger"><?php echo form_error('header'); ?></span>
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="focus-label">Footer</label>
                        <textarea type="text" name="footer" class="form-control input-lg" rows="5" placeholder="Enter footer content"></textarea>
                        <span class="text-danger"><?php echo form_error('footer'); ?></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12 text-center submit_all">
                    <button class="btn btn-info" type="submit">Submit</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /Page Content -->

<script type="text/javascript">
    $(document).ready(function () {
        $(".select2").select2({
            placeholder: 'Nothing Selected',
            width: '100%'
        });
        $(document).find('.clinic').trigger('change');
        $(document).on('change', '.clinic', function (){
            let group_id = $(this).find(":selected").data("group-id");
            $('#add_template_modal').find('input[name=group_id]').val(group_id);
        });
    });
</script>