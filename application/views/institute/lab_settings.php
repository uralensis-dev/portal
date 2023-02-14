<!-- Page Content -->

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
                <h3 class="page-title">Add Laboratory</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">New Laboratory</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
            </div>
        </div>
    </div>
<form action="<?php echo base_url('institute/AddLaboratory'); ?>" id="laboratory_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
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
                                    <input class="form-control <?php if ($errors) echo empty($form_data['laboratory_name']['error']) ? 'is-valid' : 'is-invalid' ?>" <?php if ($errors) echo empty($form_data['laboratory_name']['error']) ? '' : 'aria-invalid="true"' ?> name="laboratory_name" id="laboratory_name" type="search" onchange="CheckHospitalName()" onblur="CheckHospitalName()" value="<?php echo $errors ? $form_data['laboratory_name']['value'] : ''; ?>">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['laboratory_name']['error'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>First Initial<span class="text-danger">*</span></label>
                                    <input class="form-control <?php if ($errors) echo empty($form_data['laboratory_initials_1']['error']) ? 'is-valid' : 'is-invalid';  ?>" <?php if ($errors) echo empty($form_data['laboratory_initials_1']['error']) ? '' : 'aria-invalid="true"' ?> name="laboratory_initials_1" id="laboratory_initials_1" maxlength="1" type="text" value="<?php echo $errors ? $form_data['laboratory_initials_1']['value'] : ''; ?>">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['laboratory_initials_1']['error'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Second Initial<span class="text-danger">*</span></label>
                                    <input class="form-control <?php if ($errors) echo empty($form_data['laboratory_initials_2']['error']) ? 'is-valid' : 'is-invalid';  ?>" <?php if ($errors) echo empty($form_data['laboratory_initials _2']['error']) ? '' : 'aria-invalid="true"' ?> name="laboratory_initials_2" id="laboratory_initials_2" maxlength="1" type="text" value="<?php echo $errors ? $form_data['laboratory_initials_2']['value'] : ''; ?>">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['laboratory_initials_2']['error'] ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" name="laboratory_address" id="laboratory_address" value="<?php echo $errors ? $form_data['laboratory_address']['value'] : ''; ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control" name="laboratory_country" id="laboratory_country">
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
                                            <?php if ($errors && $country['id'] === $form_data['laboratory_country']['value']) $selected = 'selected'; ?>
                                            <option <?php echo $selected; ?> value="<?php echo $country['id']; ?>"><?php echo $country['nicename']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>City</label>
                                    <input class="form-control" name="laboratory_city" id="laboratory_city" value="<?php echo $errors ? $form_data['laboratory_city']['value'] : ''; ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>State/Province</label>
                                    <input class="form-control" type="text" name="laboratory_state" id="laboratory_state" placeholder="" value="<?php echo $errors ? $form_data['laboratory_state']['value'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input class="form-control" name="laboratory_post_code" <?php echo $errors ? $form_data['laboratory_post_code']['value'] : ''; ?> id="laboratory_post_code" value="" type="text">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control <?php if ($errors) echo empty($form_data['laboratory_email']['error']) ? 'is-valid' : 'is-invalid' ?>" <?php if ($errors) echo empty($form_data['laboratory_email']['error']) ? '' : 'aria-invalid="true"' ?> name="laboratory_email" id="laboratory_email" value="<?php echo $errors ? $form_data['laboratory_email']['value'] : ''; ?>" type="email">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['laboratory_email']['value']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Organisation site identifier</label>
                                    <input class="form-control" name="site_identifier" id="site_identifier" value="<?php echo $errors ? $form_data['hospital_number']['value'] : ''; ?>" type="text">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Organisation identifier</label>
                                    <input class="form-control" name="identifier" id="identifier" value="<?php echo $errors ? $form_data['hospital_mobile_num']['value'] : ''; ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input class="form-control" name="laboratory_number" id="laboratory_number" value="<?php echo $errors ? $form_data['laboratory_number']['value'] : ''; ?>" type="text">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input class="form-control" name="laboratory_mobile_num" id="laboratory_mobile_num" value="<?php echo $errors ? $form_data['laboratory_mobile_num']['value'] : ''; ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fax</label>
                                    <input class="form-control" name="laboratory_fax" id="laboratory_fax" value="<?php echo $errors ? $form_data['laboratory_fax']['value'] : ''; ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Website Url</label>
                                    <input class="form-control <?php if ($errors) echo empty($form_data['laboratory_website']['error']) ? 'is-valid' : 'is-invalid' ?>" <?php if ($errors) echo empty($form_data['laboratory_website']['error']) ? '' : 'aria-invalid="true"' ?> name="laboratory_website" id="laboratory_website" value="<?php echo $errors ? $form_data['laboratory_website']['value'] : ''; ?>" type="text">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['laboratory_website']['value']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input class="form-control" name="laboratory_logo" id="laboratory_logo" value="" type="file">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <img style="display:none" style="max-height: 94px; width: auto;" class="hospital-logo-preview" src="" alt="Logo">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
             <h3>Laboratory Admin</h3>
            <section>
                <div class="card flex-fill profile-box">
                    <div class="card-body">
                        <div class="card mb-4">
                            <div class="card-body">
                                <!-- Profile Picture Input -->
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

                                <!-- User Personal Information START -->
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group  ">
                                                <i class="lnr lnr-user"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'admin_first_name', 'id' => 'admin_first_name', 'value' => '', 'class' => 'form-control ', 'placeholder' => 'First Name')); ?>
                                                <div class="invalid-feedback">
                                                    Please provide a valid name
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group  ">
                                                <i class="lnr lnr-user"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'admin_last_name', 'id' => 'admin_last_name', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Last Name')); ?>
                                                <div class="invalid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group  ">
                                                <i class="lnr lnr-apartment"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'admin_company', 'id' => 'admin_company', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Company Name')); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group  ">
                                                <i class="lnr lnr-phone-handset"></i>
                                                <?php echo form_input(array('type' => 'text', 'name' => 'admin_phone', 'id' => 'admin_phone', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Phone')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group  ">
                                        <i class="lnr lnr-envelope"></i>
                                        <?php echo form_input(array('type' => 'text', 'name' => 'admin_email', 'id' => 'admin_email', 'value' => '', 'class' => 'form-control ', 'placeholder' => 'Email')); ?>
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                    <div class="row" id="password-row">
                                        <div class="col-md-6">
                                            <div class="form-group  ">
                                                <i class="lnr lnr-lock"></i>
                                                <?php echo form_input(array('type' => 'password', 'name' => 'admin_password', 'id' => 'admin_password', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Password')); ?>
                                                <div class="invalid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group  ">
                                                <i class="lnr lnr-lock"></i>
                                                <?php echo form_input(array('type' => 'password', 'name' => 'admin_password_confirm', 'id' => 'admin_password_confirm', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Retype Password')); ?>
                                                <div class="invalid-feedback">
                                                    Password does not match
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group  " id="memo-row">
                                        <i class="lnr lnr-apartment"></i>
                                        <?php echo form_input(array('type' => 'text', 'name' => 'admin_memorable', 'id' => 'admin_memorable', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Memorable', 'maxlength' => 10, 'size' => 10)); ?>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
<!--            <h3>Account Holders</h3>
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
            </section>-->
<!--            <h3 class="mb-4">Connections</h3>
            <section>
                <div class="card flex-fill">
                    <input type="hidden" name="laboratory_information">
                    <div class="card-body">
                        <div class="well" style="width:100%;float:left;">
                            <div class="row py-3">
                                <div class="col-md-6 text-left">
                                    <h4 class="mt-1">No Hospital or Lab Connections <input type="checkbox" name="lab_connection" id="lab_connection" /></h4>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>

            </section>-->
        </div>
    </div>
    <button disable="true" id="form-submit-btn" class="btn btn-primary btn-lg btn-rounded">Submit</button>
    </form>
	
	<script>
	function markInputInvalid(ele, msg="Please enter a valid input") {
    $(ele).addClass('is-invalid').removeClass('is-valid');
    if ($(ele).siblings('.invalid-feedback').length === 0) {
        $(ele).insertAfter($(`<div class="invalid-feedback">${msg}</div>`))
    } else {
        $(ele).siblings('.invalid-feedback').html(msg);
    }
}

function markInputValid(ele) {
    $(ele).addClass('is-valid').removeClass('is-invalid');
}


function CheckHospitalName()
{
        var val = $("#laboratory_name").val();
		//alert(val);
		//alert("hello this");
        val = val.trim();
        if (val.length === 0) {
            markInputInvalid($("#laboratory_name").get(0), 'Please enter laboratory name');
        } else {
            $.get(_base_url+`auth/setting_validation_is_unique_hospital_name?name=${encodeURIComponent(val)}`, function(is_unique) {
                if (is_unique) {
                    markInputValid($("#laboratory_name").get(0));
                    var hospital_name = val;
                   var first_initials = hospital_name.charAt(0);
                    $("#laboratory_initials_1").val(first_initials);
                    
                   var matches = hospital_name.match(/\b(\w)/g); // ['J','S','O','N']
                   var acronym = matches.join(''); // JSON
                    var last_initials = acronym.charAt(1);
                   $("#laboratory_initials_2").val(last_initials);
                   
                } else {
                    markInputInvalid($("#laboratory_name").get(0), "Records with same name already exists");
                }
            }).fail(function(err) {
                console.log(err);
                markInputInvalid($("#laboratory_name").get(0), 'Server error try again later');
            });
        }
       // $("#table-institute-name").html(`<b>${val}</b>`);
  
}

function emailvalidate()
{

        var val = $('#laboratory_email').val().trim();
        var _this = this;
        if (val.length === 0) {
            $('#laboratory_email').addClass('is-invalid');
            $('#laboratory_email').siblings('.invalid-feedback').html("Please provide an email");
        } else {
            $.get(_base_url + `auth/validation_is_unique_user_email?email=${encodeURIComponent(val)}`, function(is_unique) {
                console.log("is unique provided");
                if (is_unique) {
                    $(_this).addClass('is-valid');
                    $(_this).removeClass('is-invalid');
                } else {
                    $(_this).addClass('is-invalid');
                    $(_this).siblings('.invalid-feedback').html("User already exists");
                    $(_this).removeClass('is-valid');
                }
            });
        }
    
}	
	
	</script>

</div>
<!-- /Page Content -->