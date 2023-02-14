<!-- Page Content -->

<style type="text/css">
    .section_title {
        font-size: 22px;
        font-weight: 500;
        padding: 0px 0 20px;
        display: block;
    }

    .modal-header {
        display: block;
    }

    .btn-xs {
        padding: 3px 5px;
        line-height: 1;
        border-radius: 3px;
    }

    img.setting_images {
        width: 40px;
        height: 40px;
        margin-bottom: 15px;
    }

    .dropdown-action {
        position: absolute;
        right: 0;
        top: 0;
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

    .breadcrumb-item + .breadcrumb-item::before {
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
                <h3 class="page-title">Admin Settings</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Admin Settings</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <!--                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i>-->
                <!--                    Add User</a>-->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Hospital/Clinic Settings</h3>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <section class="form-group">
                <div class="card profile-box flex-fill">
                    <div class="card-body">
                        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
                        <div class="col-md-12" style="margin-bottom: 80px !important;">
                            <div class="form-group">
                                <input type="text" data-microcodeid="" data-formid="" name="sr_hospital_name"
                                       style="width: 100%;"
                                       class="form-control sr_hospital_name " id="sr_hospital_name"
                                       placeholder="Search Hospital" value="">
                            </div>
                        </div>
                        <h3 class="card-title"><a href="#" id="btn_edit_hosp" class="edit-icon hidden"
                                                  data-toggle="modal"
                                                  data-target="#edit_user"><i class="fa fa-pencil"></i></a></h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Institute Name <span class="text-danger">*</span></label>
                                    <input class="form-control" name="hospital_name" id="hospital_name" type="text"
                                           value="" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Institute Initials <span class="text-danger">*</span></label>
                                    <input class="form-control" name="hospital_initials" id="hospital_initials"
                                           type="text" value="" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Group Name <span class="text-danger">*</span></label>
                                    <input class="form-control" name="group_name" id="group_name" type="text" value=""
                                           disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" name="hospital_address" id="hospital_address" value=""
                                           type="text" disabled="">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Country</label>
                                    <!--                                    <input class="form-control" name="hospital_country" id="hospital_country" type="text" placeholder="" disabled>-->
                                    <select class="form-control" name="hospital_country" id="hospital_country"
                                            readonly="">
                                        <option value="">Select Country</option>
                                        <?php foreach ($countries as $country) { ?>
                                            <option value="<?php echo $country['id']; ?>"><?php echo $country['nicename']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>City</label>
                                    <input class="form-control" name="hospital_city" id="hospital_city" value=""
                                           type="text" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>State/Province</label>
                                    <input class="form-control" type="text" name="hospital_province"
                                           id="hospital_province" placeholder=""
                                           disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input class="form-control" name="hospital_post_code" id="hospital_post_code"
                                           value="" type="text" disabled>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" name="hospital_email" id="hospital_email" value=""
                                           type="email" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input class="form-control" name="hospital_number" id="hospital_number" value=""
                                           type="text" disabled>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input class="form-control" name="hospital_mobile_num" id="hospital_mobile_num"
                                           value="" type="text" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fax</label>
                                    <input class="form-control" name="hospital_fax" id="hospital_fax" value=""
                                           type="text" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Website Url</label>
                                    <input class="form-control" name="hospital_website" id="hospital_website" value=""
                                           type="text" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Upload Logo</label>
                                    <input class="form-control" name="upload_logo" id="upload_logo" value="" type="file"
                                           disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="form-group">
                <div class="section_title">Account Holders</div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label><img src="<?php echo base_url() ?>assets/img/user.jpg" class="user_image"/>
                                    Account Holder</label>
                                <select class="form-control">
                                    <?php foreach ($Admin as $rec) { ?>
                                        <option><?php echo $rec['email'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label><img src="<?php echo base_url() ?>assets/img/user.jpg" class="user_image"/>
                                    Deputy Account Holder</label>
                                <select class="form-control">
                                    <option>Andrew Patterson, andrew.patterson@pathhub.com</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="form-group">


                <div class="section_title">
                    Network
                    <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#add_network"><i
                                class="fa fa-plus"></i></button>

                    <button class="btn btn-success pull-right" data-toggle="modal" data-target="#search_by_network">
                        Search by Network
                    </button>

                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <?php $hospital_group_id = getAllUsersGroups('H');
                                ?>

                                <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
                                <div class="dash-widget-info">
                                    <h3><?php echo(!empty($Hospital[0]['TOTROWS']) ? $Hospital[0]['TOTROWS'] : 0) ?></h3>
                                    <span><a href="<?php echo base_url('index.php?group_id=' . intval($hospital_group_id)); ?>">Hospital</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="form-group">


                <div class="section_title">User Categories</div>
                <div class="row">

                    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><img
                                            src="<?php echo base_url() ?>assets/icons/Clinical-Physician.png"
                                            alt=""></span>
                                <?php
                                $clinicianGroups = getAllUsersGroups('C')[0]['id'];
                                ?>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                       aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:;"><i class="fa fa-home m-r-5"></i>
                                            Dashboard</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                    class="fa fa-user m-r-5"></i> Users</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                    class="fa fa-lock m-r-5"></i> Permissions</a>
                                    </div>
                                </div>
                                <div class="dash-widget-info">
                                    <h3><?php echo(!empty($Clinician[0]['TOTROWS']) ? $Clinician[0]['TOTROWS'] : 0) ?></h3>
                                    <span><a href="javascript:;">Clinician</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><img
                                            src="<?php echo base_url() ?>assets/icons/Profiles.png" alt=""></span>
                                <div class="dash-widget-info">
                                    <h3><?php echo(!empty($Requestor[0]['TOTROWS']) ? $Requestor[0]['TOTROWS'] : 0) ?></h3>
                                    <span><a href="javascript:;">Requestor</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><img
                                            src="<?php echo base_url() ?>assets/icons/Clinical.png" alt=""></span>
                                <div class="dash-widget-info">
                                    <?php
                                    $cancerGroups = getAllUsersGroups('CS')[0]['id'];
                                    ?>
                                    <h3><?php echo(!empty($CancerService[0]['TOTROWS']) ? $CancerService[0]['TOTROWS'] : 0) ?></h3>
                                    <span><a href="javascript:;">Cancer Service</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <?php
                                $labs = getAllUsersGroups('L');
                                $lab_group_id = $labs[0]['id'];
                                ?>
                                <span class="dash-widget-icon"><img
                                            src="<?php echo base_url() ?>assets/icons/Laboratory.png" alt=""></span>
                                <div class="dash-widget-info">
                                    <h3><?php echo(!empty($Laboratory[0]['TOTROWS']) ? $Laboratory[0]['TOTROWS'] : 0) ?></h3>
                                    <span><a href="<?php echo base_url('index.php?group_id=' . intval($lab_group_id)); ?>">Laboratory</a> </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <?php $doctor_group_id = getAllUsersGroups('D')[0]['id'];
                                ?>
                                <span class="dash-widget-icon"><img
                                            src="<?php echo base_url() ?>assets/icons/Pathologist.png" alt=""></span>
                                <div class="dash-widget-info">
                                    <h3><?php echo(!empty($Pathologist[0]['TOTROWS']) ? $Pathologist[0]['TOTROWS'] : 0) ?></h3>
                                    <span><a href="<?php echo base_url('index.php?group_id=' . intval($doctor_group_id)); ?>">Pathologist</a></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <?php $sec_group_id = getAllUsersGroups('S')[0]['id'];
                                ?>
                                <span class="dash-widget-icon"><img
                                            src="<?php echo base_url() ?>assets/icons/Secratory.png"></span>
                                <div class="dash-widget-info">
                                    <h3><?php echo(!empty($Secretary[0]['TOTROWS']) ? $Secretary[0]['TOTROWS'] : 0) ?></h3>
                                    <span><a href="<?php echo base_url('index.php?group_id=' . intval($sec_group_id)); ?>">Secretary</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><img
                                            src="<?php echo base_url() ?>assets/icons/Trainee.png" alt=""></span>
                                <div class="dash-widget-info">
                                    <h3><?php echo(!empty($Trainee[0]['TOTROWS']) ? $Trainee[0]['TOTROWS'] : 0) ?></h3>
                                    <span><a href="javascript:;">Trainee</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="form-group">
                <div class="section_title">Admin Hospital Settings</div>
                <div class="row">
                    <div class="col-md-2 col-sm-6 text-center form-group">
                        <div class="card" style="min-height: 121px;">
                            <div class="card-body">
                                <img src="<?php echo base_url() ?>assets/icons/admin_set01.png " class="setting_images">
                                <div class="text">Report Template</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 text-center form-group">
                        <div class="card" style="min-height: 121px;">
                            <div class="card-body">
                                <img src="<?php echo base_url() ?>assets/icons/admin_set02.png " class="setting_images">
                                <div class="text">MDT Dates</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 text-center form-group">
                        <div class="card" style="min-height: 121px;">
                            <div class="card-body">
                                <img src="<?php echo base_url() ?>assets/icons/admin_set03.png " class="setting_images">
                                <div class="text">Short Codes</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 text-center form-group">
                        <div class="card" style="min-height: 121px;">
                            <div class="card-body">
                                <img src="<?php echo base_url() ?>assets/icons/admin_set04.png " class="setting_images">
                                <div class="text">Clinic Dates</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 hidden-xs hidden-sm text-center form-group">
                        <div class="card" style="min-height: 121px;">
                            <div class="card-body">
                                <div class="text">
                                    <a href="<?php echo base_url("leaveManagement/leaveSettings")?>">Leave Settings</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 hidden-xs hidden-sm text-center form-group">
                        <div class="card" style="min-height: 121px;">
                            <div class="card-body">
                                <div class="text">
                                    <a href="<?php echo base_url("leaveManagement/leaveRequests")?>">Leave Requests</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-2 col-sm-6 text-center form-group">
                        <div class="card" style="min-height: 121px;">
                            <div class="card-body">
                                <a href="#"><img src="<?php echo base_url() ?>assets/icons/admin_set01.png " class="setting_images">
                                    <div class="text">Price Code Template</div> </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-2 col-sm-6 text-center form-group">
                        <div class="card" style="min-height: 121px;">
                            <div class="card-body">
                                <a href="#"><img src="<?php echo base_url() ?>assets/icons/admin_set01.png " class="setting_images">
                                    <div class="text">LAB Template</div> </a>
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
                        <div class="card" style="min-height: 121px;">
                            <div class="card-body change_time_div">
                                <img src="<?php echo base_url() ?>assets/icons/admin_set04.png " class="setting_images">
                                <div class="text">Password Expiry Time</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 text-center form-group">
                        <div class="card" style="min-height: 121px;">
                            <div class="card-body">
                                <img src="<?php echo base_url() ?>assets/icons/2.png " class="setting_images">
                                <div class="text">
                                    <a href="<?php echo base_url() ?>settings/urlManagement">URL Manager</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 text-center form-group">
                        <div class="card" style="min-height: 121px;">
                            <div class="card-body">
                                <img src="<?php echo base_url() ?>assets/icons/Setting.png " class="setting_images">
                                <div class="text">
                                    <a href="<?php echo base_url() ?>settings/payment_info">Payment Info</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
<!-- /Page Content -->


<!-- Add User Modal -->
<div id="add_user" class="modal custom-modal fade" role="dialog">
    <?php echo form_open_multipart(uri_string(), array('class' => 'form tg-formtheme tg-editform')); ?>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <?php echo form_open("auth/create_user", array('class' => 'tg-formtheme tg-editform create_user_form')); ?>
                <?php if ($this->ion_auth->is_admin()): ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <?php echo form_input(array('type' => 'text', 'name' => 'first_name', 'id' => 'first_name', 'value' => '', 'class' => 'form-control', 'placeholder' => 'First Name')); ?>


                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <?php echo form_input(array('type' => 'text', 'name' => 'last_name', 'id' => 'last_name', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Last Name')); ?>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Company Nam <span class="text-danger">*</span></label>
                                <?php echo form_input(array('type' => 'text', 'name' => 'company', 'id' => 'company', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Company Name')); ?>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone <span class="text-danger">*</span></label>
                                <?php echo form_input(array('type' => 'text', 'name' => 'phone', 'id' => 'phone', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Phone')); ?>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Password</label>
                                <?php echo form_input(array('type' => 'password', 'name' => 'password', 'id' => 'password', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Password')); ?>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <?php echo form_input(array('type' => 'password', 'name' => 'password_confirm', 'id' => 'password_confirm', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Retype Password')); ?>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email </label>
                                <?php echo form_input(array('type' => 'text', 'name' => 'email', 'id' => 'email', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Email')); ?>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Role</label>

                                <select class="select form-control" id="tg-hospital" name="user_groups"
                                        onChange="gethospital(this.value)">
                                    <?php
                                    $getgroups = getRecords("*", "groups", array("type_cate" => "category"));
                                    foreach ($getgroups as $key) {
                                        ?>
                                        <option value="<?php echo $key->id ?>"><?php echo html_purify($key->name); ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Memorable</label>
                                <?php echo form_input(array('type' => 'text', 'name' => 'memorable', 'id' => 'memorable', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Memorable', 'maxlength' => 10, 'size' => 10)); ?>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" id="Selectsub" style="display:none">
                                <label>Select Hospital Group</label>

                                <select class="select form-control" name="group_id">
                                    <?php
                                    $user_groups = getAllUsersGroups();
                                    //echo last_query();
                                    if (!empty($user_groups)) {
                                        foreach ($user_groups as $ugkey => $ugval) {
                                            ?>
                                            <option value="<?php echo intval($ugval['id']); ?>"><?php echo html_purify($ugval['description']); ?></option>
                                        <?php }
                                    } ?>

                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Upload Profile Image <span class="text-danger">*</span></label>
                                <label for="tg-uploadfiletwo">
                                    <a id="profile_image_uplaod"><i class="fa fa-link"></i>Attach File</a>
                                </label>
                                <div id="plupload-profile-container"></div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="profile_image_name" id="profile_image_name" value="">
                    <input type="hidden" name="profile_image_path" id="profile_image_path" value="">
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<div id="edit_user" class="modal custom-modal fade" role="dialog">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <!--            --><?php //echo form_open(current_url(), array('class' => 'tg-formtheme ')); ?>
            <form id="hosp_info_form" class="hosp_info_form">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Hospital Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <div class="modal-body">
                    <input type="hidden" name="role_id" id="role_id"/>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Institute Name <span class="text-danger">*</span></label>
                                <input class="form-control" name="hosp_name" id="hosp_name" type="text" value=""
                                       disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Institute Initials <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="hosp_initials" id="hosp_initials" value=""
                                       disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Group Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="h_group_name" id="h_group_name" value=""
                                       disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control" name="hosp_address" id="hosp_address" value="" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Country</label>
                                <select class="form-control" name="hosp_country" id="hosp_country">
                                    <option value="">Select Country</option>
                                    <?php foreach ($countries as $country) { ?>
                                        <option value="<?php echo $country['id']; ?>"><?php echo $country['nicename']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>City</label>
                                <input class="form-control" name="hosp_city" id="hosp_city" value="" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>State/Province</label>
                                <input class="form-control" name="hosp_state" id="hosp_state" value="" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Postal Code</label>
                                <input class="form-control" name="hosp_post_code" id="hosp_post_code" value=""
                                       type="text">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="hosp_email" id="hosp_email" value="" type="email">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input class="form-control" name="hosp_phone" id="hosp_phone" value="" type="text">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <input class="form-control" name="hosp_mobile" id="hosp_mobile" value="" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fax</label>
                                <input class="form-control" name="hosp_fax" id="hosp_fax" value="" type="text">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Website Url</label>
                                <input class="form-control" name="hosp_website" id="hosp_website" value="" type="text">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="col-md-12 text-center">
                        <button class="btn btn-primary submit-btn save_hosp_info">Submit</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Profile Modal -->
<div id="password_info" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Password Expiry Time</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(uri_string(), array('id' => 'update_password_form')); ?>
                <input type="hidden" name="password_status" id="password_status" value="0"/>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-1 col-form-label"></label>
                    <label for="staticEmail" class="col-sm-3 col-form-label">Select hospital</label>
                    <div class="col-sm-6">
                        <select name="hospital_id" class="form-control">
                            <option value="">Choose Hospital</option>
                            <?php
                            if (!empty($hospitals_list)) {
                                foreach ($hospitals_list as $hospitals) {
                                    echo '<option value="' . $hospitals->id . '">' . $hospitals->description . '</option> ';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-1 col-form-label"></label>
                    <label for="staticEmail" class="col-sm-3 col-form-label">No. of Days</label>
                    <div class="col-sm-6">
                        <input type="number" min="0" id="num_days" name="num_days" class="form-control" value="">
                    </div>
                </div>
                <div class="submit-section">
                    <button class="btn btn-primary updatepwd-submit-btn" type="button">Submit</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- /Profile Modal -->

<div id="add_network" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Network</h4>
            </div>
            <form action="">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Select hospital <span class="text-danger">*</span></label>
                        <select name="hospital_id" class="form-control tg-select display_mdt_list_on_hospital">
                            <option value="">Choose Hospital</option>
                            <option value="9">Belgrave Hospital and Cancer Centre</option>
                            <option value="18">Knightbridge University Medical Centre</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Clinic Name</label>
                        <input type="text" name="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Search Clinicians</label>
                        <select name="clinical_id" class="form-control tg-select display_mdt_list_on_hospital">
                            <option value="">Choose Clinicians</option>
                            <option value="9">Belgrave Hospital and Cancer Centre</option>
                            <option value="18">Knightbridge University Medical Centre</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Hospital</label>
                        <select name="clinical_id" class="form-control tg-select display_mdt_list_on_hospital">
                            <option value="">Choose Clinicians</option>
                            <option value="9">Belgrave Hospital and Cancer Centre</option>
                            <option value="18">Knightbridge University Medical Centre</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info">Add Network</button>
                </div>
            </form>

        </div>

    </div>
</div>
<div id="search_by_network" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Search By Network</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>

        </div>

    </div>
</div>