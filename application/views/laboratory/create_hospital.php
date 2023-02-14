<style type="text/css">
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
</style>

<div class="content container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Add Clinic</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">New Clinic</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
            </div>
        </div>
    </div>

    <?php
    if ($this->session->flashdata('error') != '') { ?>
        <div class="error_list" style="color: red;">
            <?= $this->session->flashdata('error'); 
            unset($_SESSION['error']);
            ?>
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('success') != '') { ?>
        <div class="success_list" style="color: green;">
            <?= $this->session->flashdata('success'); 
            unset($_SESSION['success']);
            ?>
        </div>
    <?php } ?>

    <?php echo form_open_multipart('', array('id' => 'hospital_form')); ?>
    <div class="row">
        <div class="col-md-12">
            <section class="form-group">
                <div class="card profile-box flex-fill">
                    <div class="card-body">
                        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
                        <input type="hidden" name="is_active_directory" value="" id="is_active_directory"/>
						<input type="hidden" name="hospital_information" value="H">
                        <input type="hidden" name="has_error" class="has_error" value="0">
                        <p class="text-danger"></p>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Clinic Name <span class="text-danger">*</span></label>
                                    <input class="enter_hospital form-control <?php if ($errors) echo empty($form_data['hospital_name']['error']) ? 'is-valid' : 'is-invalid' ?>" <?php if ($errors) echo empty($form_data['hospital_name']['error']) ? '' : 'aria-invalid="true"' ?> name="hospital_name" id="hospital_name" type="search" value="<?php echo set_value('hospital_name'); ?>" autocomplete="off">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['hospital_name']['error'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>First Initial<span class="text-danger">*</span></label>
                                    <input class="form-control <?php if ($errors) echo empty($form_data['hospital_initials_1']['error']) ? 'is-valid' : 'is-invalid';  ?>" <?php if ($errors) echo empty($form_data['hospital_initials_1']['error']) ? '' : 'aria-invalid="true"' ?> name="hospital_initials_1" id="hospital_initials_1" maxlength="1" type="text" value="<?php echo set_value('hospital_initials_1'); ?>">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['hospital_initials_1']['error'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Second Initial<span class="text-danger">*</span></label>
                                    <input class="form-control <?php if ($errors) echo empty($form_data['hospital_initials_2']['error']) ? 'is-valid' : 'is-invalid';  ?>" <?php if ($errors) echo empty($form_data['hospital_initials _2']['error']) ? '' : 'aria-invalid="true"' ?> name="hospital_initials_2" id="hospital_initials_2" maxlength="1" type="text" value="<?php echo set_value('hospital_initials_2'); ?>">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['hospital_initials_2']['error'] ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" autocomplete="off" name="hospital_address" id="hospital_address" value="<?php echo set_value('hospital_address'); ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control" name="hospital_country" id="hospital_country">
                                        <option value="">Select Country</option>                                        
                                        <?php foreach ($countries as $country) {  ?>
                                            <?php 
                                            $selected = ''; 
                                            if ($country['nicename'] === 'United Kingdom') {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                            ?>
                                            <?php if ($country['id'] === set_value('hospital_country')) $selected = 'selected'; ?>
                                            <option <?php echo $selected; ?> value="<?php echo $country['id']; ?>"><?php echo $country['nicename']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>City</label>
                                    <input class="form-control" name="hospital_city" id="hospital_city" value="<?php echo set_value('hospital_city'); ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>State/Province</label>
                                    <input class="form-control" type="text" name="hospital_state" id="hospital_state" placeholder="" value="<?php echo set_value('hospital_state'); ?>">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input class="form-control" name="hospital_post_code" <?php echo $errors ? $form_data['hospital_post_code']['value'] : ''; ?> id="hospital_post_code" value="<?php echo set_value('hospital_post_code'); ?>" type="text">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input autocomplete="off" class="form-control <?php if ($errors) echo empty($form_data['hospital_email']['error']) ? 'is-valid' : 'is-invalid' ?>" <?php if ($errors) echo empty($form_data['hospital_email']['error']) ? '' : 'aria-invalid="true"' ?> name="hospital_email" id="hospital_email" value="<?php echo set_value('hospital_email'); ?>" type="email">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['hospital_email']['value']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Confirm Email</label>
                                    <input autocomplete="off" class="form-control <?php if ($errors) echo empty($form_data['hospital_email_confirm']['error']) ? 'is-valid' : 'is-invalid' ?>" <?php if ($errors) echo empty($form_data['hospital_email_confirm']['error']) ? '' : 'aria-invalid="true"' ?> name="hospital_email_confirm" id="hospital_email_confirm" value="<?php echo set_value('hospital_email_confirm'); ?>" type="email">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['hospital_email_confirm']['value']; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Channel Number</label>
                                    <select class="form-control" name="channel_no">
                                        <?php  
                                            for ($i=1; $i <= 6; $i++) { 
                                                echo "<option value=$i>$i</option>";
                                            }
                                        ?>
                                    </select>
                                    
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Organisation site identifier</label>
                                    <input class="form-control" name="site_identifier" id="site_identifier" value="<?php echo set_value('site_identifier'); ?>" type="text">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Organisation identifier</label>
                                    <input class="form-control" name="identifier" id="identifier" value="<?php echo set_value('identifier'); ?>" type="text">
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input class="form-control" name="hospital_number" id="hospital_number" value="<?php echo set_value('hospital_number'); ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input class="form-control" name="hospital_logo" id="hospital_logo" value="" type="file">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- <img style="max-height: 94px; width: auto;" class="hospital-logo-preview" src="<?php// echo base_url('/uploads/logo/uralensis_latest.jpg'); ?>" alt="Logo"> -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
             <h3>Admin</h3>
            <section>
                
                
                <div class="card flex-fill profile-box">
                    
                    <div class="card-body">
                        
                        
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    
                    
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary" data-toggle="collapse"
                                    data-target="#active-directory-select-container">Active Directory
                            </button>
                        </div>
                                    <div class="col-md-12"><div class="collapse" id="active-directory-select-container"></div></div> 
                    

              
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-img-wrap edit-img">
                                            <img class="inline-block" id="profile-pic-preview" src="<?php echo base_url('assets/newtheme/img/profiles/avatar-02.jpg'); ?>" alt="user">
                                            <div class="fileupload btn">
                                                <san class="btn-text">edit</span>
                                                    <input class="upload" type="file" id="profile-pic" name="admin_profile_pic" accept="image/*" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group  ">
                                                <i class="lnr lnr-user"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'admin_first_name', 'id' => 'admin_first_name', 'value' => set_value('admin_first_name'), 'class' => 'form-control ', 'placeholder' => 'First Name')); ?>
                                                <div class="invalid-feedback">
                                                    Please provide a valid name
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group  ">
                                                <i class="lnr lnr-user"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'admin_last_name', 'id' => 'admin_last_name', 'value' => set_value('admin_last_name'), 'class' => 'form-control', 'placeholder' => 'Last Name')); ?>
                                                <div class="invalid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group  ">
                                                <i class="lnr lnr-apartment"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'admin_company', 'id' => 'admin_company', 'value' => set_value('admin_company'), 'class' => 'form-control', 'placeholder' => 'Company Name')); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group  ">
                                                <i class="lnr lnr-phone-handset"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'admin_phone', 'id' => 'admin_phone', 'value' => set_value('admin_phone'), 'class' => 'form-control', 'placeholder' => 'Phone')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                    <div class="form-group col-md-6" id="memo-row">
                                        <i class="lnr lnr-apartment"></i>
                                        <?php echo form_input(array('type' => 'text', 'name' => 'admin_memorable', 'id' => 'admin_memorable', 'value' => set_value('admin_memorable'), 'class' => 'form-control', 'placeholder' => 'Memorable', 'maxlength' => 10, 'size' => 10)); ?>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <i class="lnr lnr-envelope"></i>
                                        <?php echo form_input(array('type' => 'text', 'name' => 'admin_email', 'id' => 'admin_email', 'value' => set_value('admin_email'), 'class' => 'form-control ', 'placeholder' => 'Email', 'autocomplete' => 'off')); ?>
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                    </div>
                                    <div class="row" id="password-row">
                                        <div class="col-md-6">
                                            <div class="form-group  ">
                                                <i class="lnr lnr-lock"></i>
                                                <?php echo form_input(array('type' => 'password', 'name' => 'admin_password', 'id' => 'admin_password', 'value' => set_value('admin_password'), 'class' => 'form-control', 'placeholder' => 'Password')); ?>
                                                <div class="invalid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group  ">
                                                <i class="lnr lnr-lock"></i>
                                                <?php echo form_input(array('type' => 'password', 'name' => 'admin_password_confirm', 'id' => 'admin_password_confirm', 'value' => set_value('admin_password_confirm'), 'class' => 'form-control', 'placeholder' => 'Retype Password')); ?>
                                                <div class="invalid-feedback">
                                                    Password does not match
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </section> 
            <!-- <h3>Account Holders</h3>
            <section>
                <div class="card flex-fill profile-box">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col">
                                        <h4>Account Holder</h4>
                                    </div>
                                    <div class="col text-right">
                                        <div class="form-check">
                                            <input type="checkbox" checked class="form-check-input" id="ac_checkbox" name="ac_checkbox">
                                        </div>
                                    </div>
                                </div>
                                <div id="ac_form" class="card mb-4">
                                    <div class="card-body">
                                         Profile Picture Input 
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="profile-img-wrap edit-img">
                                                    <img class="inline-block" id="ac-profile-pic-preview" src="<?php echo base_url('assets/newtheme/img/profiles/avatar-02.jpg'); ?>" alt="user">
                                                    <div class="fileupload btn">
                                                        <san class="btn-text">edit</span>
                                                            <input class="upload" type="file" id="ac-profile-pic" name="ac_profile_pic" accept="image/*" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                         User Personal Information START 
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group  ">
                                                        <i class="lnr lnr-user"></i>
                                                        <?php echo form_input(array('type' => 'text', 'name' => 'ac_first_name', 'id' => 'ac_first_name', 'value' => '', 'class' => 'form-control ', 'placeholder' => 'First Name')); ?>
                                                        <div class="invalid-feedback">
                                                            Please provide a valid name
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group  ">
                                                        <i class="lnr lnr-user"></i>
                                                        <?php echo form_input(array('type' => 'text', 'name' => 'ac_last_name', 'id' => 'ac_last_name', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Last Name')); ?>
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group  ">
                                                        <i class="lnr lnr-apartment"></i>
                                                        <?php echo form_input(array('type' => 'text', 'name' => 'ac_company', 'id' => 'ac_company', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Company Name')); ?>
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group  ">
                                                        <i class="lnr lnr-phone-handset"></i>
                                                        <?php echo form_input(array('type' => 'text', 'name' => 'ac_phone', 'id' => 'ac_phone', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Phone')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group  ">
                                                <i class="lnr lnr-envelope"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'ac_email', 'id' => 'ac_email', 'value' => '', 'class' => 'form-control ', 'placeholder' => 'Email')); ?>
                                                <div class="invalid-feedback">

                                                </div>
                                            </div>
                                            <div class="row" id="password-row">
                                                <div class="col-md-6">
                                                    <div class="form-group  ">
                                                        <i class="lnr lnr-lock"></i>
                                                        <?php echo form_input(array('type' => 'password', 'name' => 'ac_password', 'id' => 'ac_password', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Password')); ?>
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group  ">
                                                        <i class="lnr lnr-lock"></i>
                                                        <?php echo form_input(array('type' => 'password', 'name' => 'ac_password_confirm', 'id' => 'ac_password_confirm', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Retype Password')); ?>
                                                        <div class="invalid-feedback">
                                                            Password does not match
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group  " id="memo-row">
                                                <i class="lnr lnr-apartment"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'ac_memorable', 'id' => 'ac_memorable', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Memorable', 'maxlength' => 10, 'size' => 10)); ?>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col">
                                        <h4>Deputy Account Holder</h4>
                                    </div>
                                    <div class="col text-right">
                                        <div class="form-check">
                                            <input type="checkbox" checked class="form-check-input" id="dac_checkbox" name="dac_checkbox">
                                        </div>
                                    </div>
                                </div>
                                <div id="dac_form" class="card mb-4">
                                    <div class="card-body">
                                         Profile Picture Input 
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="profile-img-wrap edit-img">
                                                    <img class="inline-block" id="dac-profile-pic-preview" src="<?php echo base_url('assets/newtheme/img/profiles/avatar-02.jpg'); ?>" alt="user">
                                                    <div class="fileupload btn">
                                                        <san class="btn-text">edit</span>
                                                            <input class="upload" type="file" id="dac-profile-pic" name="dac_profile_pic" accept="image/*" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                         User Personal Information START 
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group  ">
                                                        <i class="lnr lnr-user"></i>
                                                        <?php echo form_input(array('type' => 'text', 'name' => 'dac_first_name', 'id' => 'dac_first_name', 'value' => '', 'class' => 'form-control ', 'placeholder' => 'First Name')); ?>
                                                        <div class="invalid-feedback">
                                                            Please provide a valid name
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group  ">
                                                        <i class="lnr lnr-user"></i>
                                                        <?php echo form_input(array('type' => 'text', 'name' => 'dac_last_name', 'id' => 'dac_last_name', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Last Name')); ?>
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group  ">
                                                        <i class="lnr lnr-apartment"></i>
                                                        <?php echo form_input(array('type' => 'text', 'name' => 'dac_company', 'id' => 'dac_company', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Company Name')); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group  ">
                                                        <i class="lnr lnr-phone-handset"></i>
                                                        <?php echo form_input(array('type' => 'text', 'name' => 'dac_phone', 'id' => 'dac_phone', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Phone')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group  ">
                                                <i class="lnr lnr-envelope"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'dac_email', 'id' => 'dac_email', 'value' => '', 'class' => 'form-control ', 'placeholder' => 'Email')); ?>
                                                <div class="invalid-feedback">

                                                </div>
                                            </div>
                                            <div class="row" id="password-row">
                                                <div class="col-md-6">
                                                    <div class="form-group  ">
                                                        <i class="lnr lnr-lock"></i>
                                                        <?php echo form_input(array('type' => 'password', 'name' => 'dac_password', 'id' => 'dac_password', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Password')); ?>
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group  ">
                                                        <i class="lnr lnr-lock"></i>
                                                        <?php echo form_input(array('type' => 'password', 'name' => 'dac_password_confirm', 'id' => 'dac_password_confirm', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Retype Password')); ?>
                                                        <div class="invalid-feedback">
                                                            Password does not match
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group  " id="memo-row">
                                                <i class="lnr lnr-apartment"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'dac_memorable', 'id' => 'dac_memorable', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Memorable', 'maxlength' => 10, 'size' => 10)); ?>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <h3 class="mb-4">Report Header</h3>
            <section>
                <div class="card flex-fill profile-box">
                    <input type="hidden" name="hospital_information">
                    <div class="card-body">
                        <div class="well" style="width:100%;float:left;">
                            <div class="row py-3">
                                <div class="col-md-3 text-center">
                                    <img style="" src="<?php echo base_url('/uploads/logo/uralensis_latest.jpg'); ?>" class="img-responsive img-fluid" alt="">

                                    <h2 class="mt-4">Report</h2>
                                </div>
                                <div class="col-md-9">
                                    
                                    <?php //if ($errors) {
                              //  echo $form_data['hospital_information']['value'];
                           // } else { ?>
                                <table id="hospital_info_table">
                                    <tr>
                                        <td width="24%" style="font-size:16px;text-align:right;">
                                            <!-- <table>
                                                <tr>
                                                    <td><b contenteditable="true">Uralensis Ltd</b></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="http://uralensis.com">http://uralensis.com</a></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="mailto:iskander.chaudhry@nhs.net">iskander.chaudhry@nhs.net</a> </td>
                                                </tr>
                                                <tr>
                                                    <td>Office: <span>01619808882</span></td>
                                                </tr>
                                                <tr>
                                                    <td contenteditable="true">305 Brooklands Road</td>
                                                </tr>
                                                <tr>
                                                    <td contenteditable="true">Manchester</td>
                                                </tr>
                                                <tr>
                                                    <td contenteditable="true">M239HE</td>
                                                </tr>
                                            </table> -->
                                        </td>
                                        <td width="3.7%"></td>
                                        <td width="30%" style="font-size:13px;text-align:left;">
                                            <!-- <table>
                                                <tr>
                                                    <td id="table-institute-name"><b>Virgin Care Limited</b></td>
                                                </tr>
                                                <tr>
                                                    <td><a id="table-website-url" href=""></a></td>
                                                </tr>
                                                <tr>
                                                    <td><a id="table-email" href=""></a> </td>
                                                </tr>
                                                <tr>
                                                    <td>Office: <span id="table-phone"></span></td>
                                                </tr>
                                                <tr>
                                                    <td id="table-address-line-1">6400 Daresbury Business Park</td>
                                                </tr>
                                                <tr>
                                                    <td id="table-address-line-2">Daresbury</td>
                                                </tr>
                                                <tr>
                                                    <td id="table-address-line-3">Warrington </td>
                                                </tr>
                                                <tr>
                                                    <td id="table-address-line-4">WA4 4GE </td>
                                                </tr>
                                                <tr>
                                                    <td>Account holder is <span id="table-account-holder"></span></td>
                                                </tr>
                                            </table> 
                                        </td>
                                    </tr>
                                </table>
                            <?php //} ?>

                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </section> -->
        </div>
    </div>
    <div class="row">
     <div class="col-sm-12 text-center">   
    <button disable="true" id="form-submit-btn" class="btn btn-primary btn-rounded">Submit</button>
     </div>
    </div>
    </form>

</div>
<!-- /Page Content