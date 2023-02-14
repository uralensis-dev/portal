<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<style>
    .job-plan-spec {
        font-size: 0.8rem;
    }

    button.btn.btn-block.btn-user-status:before {
        position: absolute;
        top: -40px;
        min-width: 100px;
        width: inherit;
        left: 50%;
        transform: translateX(-50%);
        content: '';
        background: #6c757e;
        color: #fff;
        border-radius: 5px;
        padding: 5px;
        text-align: center;
        font-size: 14px;
        display: none;
    }

    button.btn.btn-block.btn-danger.btn-user-status:before,
    button.btn.btn-block.btn-warning.btn-user-status:before,
    button.btn.btn-block.btn-primary.btn-user-status:before {
        content: 'Active';
    }

    button.btn.btn-block.btn-danger.btn-user-status:before {
        background: #e6294b;
    }

    button.btn.btn-block.btn-warning.btn-user-status:before {
        background: #ffbc34;
    }

    button.btn.btn-block.btn-primary.btn-user-status:before {
        background: #00b7ed;
    }

    button.btn.btn-block.btn-user-status:after {
        position: absolute;
        top: -10px;
        content: '';
        border: 10px solid transparent;
        /*border-top-color: #6c757e;*/
        left: 50%;
        transform: translateX(-50%);
        display: none;
    }

    button.btn.btn-block.btn-danger.btn-user-status:after {
        border-top-color: #e6294b;
    }

    button.btn.btn-block.btn-warning.btn-user-status:after {
        border-top-color: #ffbc34;
    }

    button.btn.btn-block.btn-primary.btn-user-status:after {
        border-top-color: #00b7ed;
    }

    button.btn.btn-block.btn-danger.btn-user-status:hover:after,
    button.btn.btn-block.btn-danger.btn-user-status:hover:before,
    button.btn.btn-block.btn-warning.btn-user-status:hover:after,
    button.btn.btn-block.btn-warning.btn-user-status:hover:before,
    button.btn.btn-block.btn-primary.btn-user-status:hover:after,
    button.btn.btn-block.btn-primary.btn-user-status:hover:before {
        display: block;
    }

    .working_for {
        margin-left: 20px;
        font-size: 0.8rem;
        font-style: italic;
        font-weight: 100;
        color: gray;
    }

    .view_password {
        position: absolute;
        top: 10px;
        right: 30px;
        cursor: pointer;
    }
</style>

<?php
$user_id = $this->uri->segment(3);
$group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
$group_type = $this->Ion_auth_model->get_group_type($group_id);
// Include Forms File
?>


<style type="text/css">
    div#calendar {
        min-height: 400px !important;
    }

    a.btn.btn-default.pull-right {
        border: 1px solid #ddd;
        color: #000;
        margin-left: 10px;
        line-height: 1
    }

    a.btn.btn-default.pull-right i {
        font-size: 18px
    }

    .field-icon {
        float: right;
        margin-left: -25px;
        margin-top: -25px;
        position: relative;
        z-index: 222;
    }

    .user-img {
        width: 32px;
        height: 32px;
        border-radius: 100px;
        margin-right: 10px;
    }

    .secretary-container {
        width: 40%;
        min-width: 300px;
    }

    .user-img img {
        width: 100%;
        height: auto;
    }

    .list-group-item .remove-item.mouseover {
        background: #aaf;
        cursor: pointer;
    }

    .icons_users_type img {
        width: auto !important;
        height: auto !important;
    }

    .icons_users_type {
        margin-top: 0px;
        margin-left: 35px;
        max-width: 50px;
        padding: 4px;
        border-radius: 11px;
        background: #ddd;
    }
    .p_hidden{
        display: none !important;
    }
</style>
<?php
$show_pathologist_groups = 'p_hidden';
$show_pathologist_users = 'p_hidden';
?>
<input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id ?>"/>
<div class="page-header">
    <div class="row">
        <div class="col-sm-8">
            <h3 class="page-title">Profile</h3>

            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url() ?>index.php/admin/home">Dashboard</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul class="list-inline pull-right">
                <li class="list-inline-item">
                    <a href="javascript:;" class="btn btn-default pull-right thumb_view_btn hidden">
                        <i class="fa fa-th-large"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-default pull-right list_view_btn">
                        <i class="fa fa-th-list"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Page Header -->
<div id="loginalert" class="alert alert-warning alert-dismissible fade show" role="alert" style="display:none">
    <div id="loginmessage"></div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<?php if ($this->ion_auth->in_group('admin') && $this->ion_auth->is_max_login_attempts_exceeded($user_details['email'])): ?>
    <?php echo form_open('/auth/unlock_user') ?>
    <input type="submit" class="btn btn-success" value="Unlock User"
           style="position: absolute; right: 100px; top: 100px;"></input>
    <input type="hidden" name="id" value="<?php echo $user_id ?>">
    <input type="hidden" name="email" value="<?php echo $user_details['email'] ?>">
    <?php echo form_close() ?>
<?php endif; ?>
<div class="card mb-0">
    <div class="card-body">

        <div class="row">
            <div class="col-md-12">
                <div class="profile-view">
                    <div class="profile-img-wrap" style="height: 160px;">
                        <div class="profile-img">
                            <!--profile image upload -->
                            <?php echo form_open_multipart(uri_string(), array('id' => 'edit_profile_picture', 'class' => 'form tg-formtheme tg-editform')); ?>
                            <div class="tg-rightarea tg-useruploadimgholder">

                                <div id="plupload-profile-container"></div>
                                <div class="tg-useruploadimg">
                                    <a href="javascript:void(0);"><i class="lnr lnr-cross delete_profile_pic"></i></a>
                                    <img class="profile-pic"
                                         src="<?php echo get_profile_picture($profile_picture_path, $user_details['first_name'], $user_details['last_name']); ?>">
                                </div>
                            </div>
                            <!-- profile image upload-->
                            <div class="text-center mt-3">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a id="profile_image_uplaod" class="dropdown-item">
                                        <!-- <span>Upload Profile</span> -->
                                        <!--  <i class="fa fa-camera upload-button"></i> -->
                                        <input class="file-upload" type="file" id="txt_profile_pic" name="profile_pic"
                                               accept="image/*"/>
                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"/>
                                        <div class="upload-pic">Upload New Photo</div>

                                    </a>
                                    <a class="dropdown-item" href="#">Remove Photo</a>

                                </div>

                            </div>
                            <ul class="mt-3 list-unstyled">
                                <?php if ($user->status == 0) { ?>
                                    <li class="list-inline-item">
                                        <a class="btn btn-light icons_users_type btn-sm validating_icon"
                                           href="javascript:;">
                                            <img src="<?php echo base_url() ?>assets/icons/validating_icon.png"
                                                 class="img-fluid"/>
                                        </a>
                                    </li>

                                <?php } else if ($user->status == 1) { ?>
                                    <li class="list-inline-item">
                                        <a class="btn btn-light icons_users_type btn-sm validated_icon"
                                           href="javascript:;">
                                            <img src="<?php echo base_url() ?>assets/icons/validated_icon.png"
                                                 class="img-fluid"/>
                                        </a>
                                    </li>
                                <?php } else if ($user->status == 2) { ?>
                                    <li class="list-inline-item">
                                        <a class="btn btn-light icons_users_type btn-sm locked_icon"
                                           href="javascript:;">
                                            <img src="<?php echo base_url() ?>assets/icons/locked_icon.png"
                                                 class="img-fluid"/>
                                        </a>
                                    </li>
                                <?php } else if ($user->status == 3) { ?>
                                    <li class="list-inline-item">
                                        <a class="btn btn-light icons_users_type btn-sm spammers_icon"
                                           href="javascript:;">
                                            <img src="<?php echo base_url() ?>assets/icons/spam_icon.png"
                                                 class="img-fluid"/>
                                        </a>
                                    </li>
                                <?php } else if ($user->status == 4) { ?>
                                    <li class="list-inline-item">
                                        <a class="btn btn-light icons_users_type btn-sm banned_icon user_status"
                                           href="javascript:;" data-id="4">
                                            <img src="<?php echo base_url() ?>assets/icons/banned_icon.png"
                                                 class="img-fluid"/>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                            <div class="clearfix"></div>

                            <?php echo form_close(); ?>


                        </div>


                    </div>

                    <div class="profile-basic">
                        <div class="row">

                            <div class="col-md-5">
                                <div class="profile-info-left">
<!--                                    <div style="position: absolute;right: 30px;top: 0">-->
<!--                                        <a data-target="#password_info" data-toggle="modal" class="edit-password"-->
<!--                                           href="#">-->
<!--                                            <i class="fa fa-key"></i>-->
<!--                                        </a>-->
<!--                                    </div>-->

                                    <h3 class="user-name m-t-0 mb-0"><?php echo $user_details['first_name'] . " " . $user_details['last_name']; //echo uralensisGetUsername(intval($user_id), 'fullname'); ?></h3>
                                    <?php
                                    $doctorname = $user_details['first_name'] . " " . $user_details['last_name'];
                                    $groups_list = getStaticGroupNames();

                                    //print "<pre>";
                                    //print_r($currentGroups);				
                                    print "<strong>Member of</strong>";

                                    foreach ($currentGroups as $key2) {
                                        if (1) {
                                            if ($key2->group_type == 'A') {
                                                $gro_type = "Administrator";
                                            } else if ($key2->group_type == 'H') {
                                                $gro_type = "Hospital";
                                            } else if ($key2->group_type == 'L') {
                                                $gro_type = "Laboratory";
                                            } else if ($key2->group_type == 'C') {
                                                $gro_type = "Clinic";
                                            } else {
                                                $gro_type = "User";
                                            }

                                            ?>
                                            <h5 class="text-muted"><?= $gro_type ?>
                                                : <?= html_purify($key2->name) ?>  </h5>
                                            <?php
                                        }
                                    }

                                    foreach ($groups_list as $key => $value) {

                                        if ($group_type[0]->group_type === $key2->group_type) {
                                            //<strong>Member of</strong> <h6 class="text-muted"><?=html_purify($value) : <?=html_purify($key2->name)</h6>
                                            ?>

                                            <?php

                                        }

                                    } ?>
                                    <!--<small class="text-muted">Web Designer</small>
                                    <div class="staff-id">Employee ID : FT-0001</div>-->
                                    <div class="small doj text-muted">Date of Join
                                        : <?php echo date('F d , Y', getUserMetaDetail($user_id, 'created_on', 'users')[0]['created_on']); ?></div>
                                    <br> <br>
                                    <?php if ($this->ion_auth->users()->row()->id !== $user_id) { ?>

                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary btn-block mb-2 dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Account Actions
                                        </button>
                                        <div class="dropdown-menu">
                                            <?php if ($this->ion_auth->in_group('admin') and $this->session->user_id != $user_id): ?>
                                                <a class="dropdown-item login-as-admin" href="javascript:;"
                                                   data-userid="<?php echo intval($user_id); ?>"><i
                                                            class="fa fa-key"></i> Sign in
                                                    as <?php echo $user_details['first_name'] . " " . $user_details['last_name']; //echo uralensisGetUsername(intval($user_id), 'fullname'); ?></h3>
                                                </a>
                                            <?php endif; ?>
                                            <a class="dropdown-item" href="#"><i class="fa fa-compress"></i> Merge with
                                                another account</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-trash"></i> Delete</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-download"></i> Download
                                                personal Information</a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-md-12">

                                        <button class="btn btn-secondary mb-2 btn-block dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                    class="fa fa-key"></i> Security
                                        </button>

                                        <div class="dropdown-menu">

                                            <a class="dropdown-item" data-target="#password_info" data-toggle="modal"
                                               class="edit-password" href="#"><i class="fa fa-lock"></i> Update Password
                                            </a>
                                            <a class="dropdown-item" data-target="#pin_info" data-toggle="modal"
                                               class="edit-pin" href="#"><i class="fa fa-key"></i> Update Pin</a>

                                        </div>
                                        <div class="clearfix"></div>
                                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-12 mb-2">
                                                    <button class="btn btn-block btn-<?php echo($user->status == 1 ? "primary" : "secondary"); ?>  btn-user-status"
                                                            data-id="1">Validated
                                                    </button>
                                                </div>
                                                <div class="col-lg-4 col-md-12 mb-2">
                                                    <button class="btn btn-block btn-<?php echo($user->status == 2 ? "primary" : "secondary"); ?>  btn-user-status"
                                                            data-id="2">Lock
                                                    </button>
                                                </div>
                                                <div class="col-lg-4 col-md-12 mb-2">
                                                    <button class="btn btn-block btn-<?php echo($user->status == 3 ? "warning" : "secondary"); ?>  btn-user-status"
                                                            data-id="3">Spam
                                                    </button>
                                                </div>
                                                <div class="col-lg-4 col-md-12 mb-2">
                                                    <button class="btn btn-block btn-<?php echo($user->status == 4 ? "danger" : "secondary"); ?>  btn-user-status"
                                                            data-id="4">Ban
                                                    </button>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <!--
                                        Status 0: Not Validated 1: Validated 2: Locked 3: Spam 4: Banned
                                            <a href="javascript:;" class="btn btn-primary ">Admin Login</a> -->

                                    </div>
                                    <div class="clearfix"></div>
                                        <?php if ($getCheckPin > 0) {
                                        ?>
                                    <div class="col-lg-4 col-md-12">
                                            <a href="<?php echo base_url(); ?>index.php/auth/downloadpins/<?php echo $myuseremail; ?>"
                                               target="_blank" class="btn btn-secondary">
                                                <img src="<?php echo base_url() ?>assets/icons/white/download_pins.png"
                                                     style="width:22px;" alt="Download Pins"/>
                                            </a>
                                    </div>
                                        <?php } else { ?>
                                            <div class="col-lg-4 col-md-12">
                                            <a href="javascript:;" class="btn btn-secondary btn-block"
                                               data-userid="<?php echo intval($user_id); ?>">
                                                <img src="<?php echo base_url() ?>assets/icons/white/download_pins.png"
                                                     style="width:22px;" alt="Download Pins"/>
                                            </a>
                                        </div>
                                        <?php }

                                    } ?>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <ul class="personal-info thumb_view">
                                    <li>
                                        <div class="title">User ID</div>
                                        <div class="text"><?php echo $generated_user_id; ?></div>
                                    </li>
                                    <li>
                                        <div class="title">Frist Name:</div>
                                        <div class="text"><?php echo $user_details['first_name'] ?></div>
                                    </li>
                                    <li>
                                        <div class="title">Last Name:</div>
                                        <div class="text"><?php echo $user_details['last_name'] ?></div>
                                    </li>
                                    <li>
                                        <div class="title">Phone:</div>
                                        <div class="text"><a href=""><?php echo $user_details['phone'] ?></a></div>
                                    </li>
                                    <li>
                                        <div class="title">Memorable:</div>
                                        <div class="text"><a href=""><?php echo $user_details['memorable'] ?></a></div>
                                    </li>
                                    <li>
                                        <div class="title">Email:</div>
                                        <div class="text"><a href=""><?php echo $user_details['email'] ?></a></div>
                                    </li>
                                    <li>
                                        <div class="title">Company:</div>
                                        <div class="text"><?php echo $user_details['company'] ?></div>
                                    </li>
                                    <li>
                                        <div class="title">Hospital:</div>
                                        <div class="text">
                                            <?php
                                            foreach ($get_hospitals as $rec) {
                                                $selected = '';
                                                if (in_array($rec->id, $usergrouphospital)) {
                                                    ?>
                                                    <?php echo $rec->name . ","; ?>
                                                <?php }
                                            } ?>
                                        </div>
                                    </li>
                                </ul>
                                <div class="row list_view hidden">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped custom-table">
                                                <thead>
                                                <tr>
                                                    <th>Name:</th>
                                                    <th>Phone:</th>
                                                    <th>Memorable:</th>
                                                    <th>Email:</th>
                                                    <th>Company:</th>
                                                    <th>Hospital:</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <?php echo $user_details['first_name'] ?><?php echo $user_details['last_name'] ?>
                                                    </td>
                                                    <td><a href=""><?php echo $user_details['phone'] ?></a></td>
                                                    <td><a href=""><?php echo $user_details['memorable'] ?></a></td>
                                                    <td><a href=""><?php echo $user_details['email'] ?></a></td>
                                                    <td><a href=""><?php echo $user_details['company'] ?></a></td>
                                                    <td>
                                                        <?php
                                                        foreach ($get_hospitals as $rec) {
                                                            $selected = '';
                                                            if (in_array($rec->id, $usergrouphospital)) {
                                                                ?>
                                                                <?php echo $rec->name . ","; ?>
                                                            <?php }
                                                        } ?>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i
                                    class="fa fa-pencil"></i></a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card tab-box">
    <div class="row user-tabs">
        <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
            <ul class="nav nav-tabs nav-tabs-bottom">
                <li class="nav-item"><a href="#emp_profile" data-toggle="tab" class="nav-link active">Profile</a></li>
                <!-- <li class="nav-item"><a href="#emp_projects" data-toggle="tab" class="nav-link">Outsource & Speciality</a></li> -->
                <li class="nav-item"><a href="#bank_statutory" data-toggle="tab" class="nav-link">Outsource & Speciality
                        <small class="text-danger">(Admin Only)</small></a></li>
                <?php if (!empty($specialties)): ?>
                    <li class="nav-item"><a href="#specialties" data-toggle="tab" class="nav-link">Specialties <small
                                    class="text-danger">(Admin Only)</small></a></li>
                <?php endif; ?>
                <?php if ($this->ion_auth->in_group('admin') && $group_type[0]->group_type === 'D'): ?>
                    <li class="nav-item"><a href="#secretary_assign" data-toggle="tab" class="nav-link">Assign Secretary
                            <small class="text-danger">(Admin Only)</small></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<div class="tab-content">
    <!-- Profile Info Tab -->
    <div id="emp_profile" class="pro-overview tab-pane fade show active">
        <div class="row">
            <div class="col-md-6 d-flex">
                <div class="card profile-box flex-fill">
                    <div class="card-body">
                        <h3 class="card-title">Personal Informations
<!--                            <a href="#" class="edit-icon" data-toggle="modal"-->
<!--                                                                        data-target="#personal_info_modal"><i-->
<!--                                        class="fa fa-pencil"></i></a>-->
                        </h3>
                        <ul class="personal-info thumb_view">
                            <li>
                                <div class="title">Current Position.</div>
                                <div class="text"><?php echo $user_details['current_position'] ?></div>
                            </li>
                            <li>
                                <div class="title">Current Status.</div>
                                <div class="text"><?php echo $user_details['current_status'] ?></div>
                            </li>
                            <li>
                                <div class="title">Current Employer.</div>
                                <div class="text"><a href=""><?php echo $user_details['current_employer'] ?></a></div>
                            </li>
                            <li>
                                <div class="title">Street Address</div>
                                <div class="text"><?php echo $user_details['work_street_address'] ?></div>
                            </li>
                            <li>
                                <div class="title">Address:</div>
                                <div class="text"><?php echo($user_details['street_address'] != "" ? $user_details['street_address'] : "No Address") ?></div>
                            </li>
                            <li>
                                <div class="title">Last Appraisal</div>
                                <div class="text"><?php echo $user_details['last_appraisal_date'] ?></div>
                            </li>
                            <li>
                                <div class="title">Date of Birth</div>
                                <div class="text"><?php echo $user_details['dob'] ?></div>
                            </li>
                            <li>
                                <div class="title">Phone No</div>
                                <div class="text"><?php echo $user_details['phone'] ?></div>
                            </li>
                        </ul>
                        <div class="table-responsive list_view hidden">
                            <table class="table table-striped custom-table">
                                <thead>
                                <tr>
                                    <th>Current Position</th>
                                    <th>Current Status</th>
                                    <th>Current Employer</th>
                                    <th>Street Address</th>
                                    <th>Address</th>
                                    <th>Last Appraisal</th>
                                    <th>Date of Birth</th>
                                    <th>Phone No</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?php echo $user_details['current_position'] ?></td>
                                    <td><?php echo $user_details['current_status'] ?></td>
                                    <td><?php echo $user_details['current_employer'] ?></td>
                                    <td><?php echo $user_details['work_street_address'] ?></td>
                                    <td><?php echo($user_details['street_address'] != "" ? $user_details['street_address'] : "No Address") ?></td>
                                    <td><?php echo $user_details['last_appraisal_date'] ?></td>
                                    <td><?php echo $user_details['dob'] ?></td>
                                    <td><?php echo $user_details['phone'] ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="card profile-box flex-fill">
                    <div class="card-body">
                        <!-- <h3 class="card-title">Job Plan <a href="#" class="edit-icon" data-toggle="modal" data-target="#job_plan_modal"><i class="fa fa-pencil"></i></a></h3> -->
                        <h3 class="card-title">Job Plan <a
                                    href="<?php echo base_url() ?>auth/job_plan/<?php echo $user_id ?>"
                                    class="edit-icon"><i class="fa fa-pencil"></i></a></h3>
                        <h5 class="section-title"></h5>
                        <hr>
                        <?php
                        $week = array(
                            'mon' => array(),
                            'tue' => array(),
                            'wed' => array(),
                            'thu' => array(),
                            'fri' => array(),
                            'sat' => array(),
                            'sun' => array()
                        );

                        foreach ($job_plan as $plan) {
                            switch ($plan['dayOfWeek']) {
                                case 'mon':
                                    array_push($week['mon'], $plan);
                                    break;
                                case 'tue':
                                    array_push($week['tue'], $plan);
                                    break;
                                case 'wed':
                                    array_push($week['wed'], $plan);
                                    break;
                                case 'thu':
                                    array_push($week['thu'], $plan);
                                    break;
                                case 'fri':
                                    array_push($week['fri'], $plan);
                                    break;
                                case 'sat':
                                    array_push($week['sat'], $plan);
                                    break;
                                case 'sun':
                                    array_push($week['sun'], $plan);
                                    break;
                            }
                        }

                        $max_length = 0;
                        foreach ($week as $w) {
                            $len = count($w);
                            if ($len > $max_length) {
                                $max_length = $len;
                            }
                        }
                        ?>
                        <?php if ($max_length == 0) { ?>
                            <h4>No Job Plan Saved</h4>
                        <?php } else { ?>
                            <h5 class="section-title">Job Plan</h5>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Mon</th>
                                        <th>Tue</th>
                                        <th>Wed</th>
                                        <th>Thu</th>
                                        <th>Fri</th>
                                        <th>Sat</th>
                                        <th>Sun</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $total_pa = array();
                                    $total_pa['mon'] = 0;
                                    $total_pa['tue'] = 0;
                                    $total_pa['wed'] = 0;
                                    $total_pa['thu'] = 0;
                                    $total_pa['fri'] = 0;
                                    $total_pa['sat'] = 0;
                                    $total_pa['sun'] = 0;
                                    ?>
                                    <?php for ($i = 0; $i < $max_length; $i++) { ?>
                                        <tr>
                                            <?php
                                            $mon_text = '';
                                            if ($i < count($week['mon'])) {
                                                $mon_text = '';
                                                $mon_plan = $week['mon'][$i];
                                                if ($mon_plan['event'] == 'Microscopy' && $mon_plan['specialty_id'] != NULL) {
                                                    $from_time = $mon_plan['from_time'];
                                                    $to_time = $mon_plan['to_time'];
                                                    $diff = round((strtotime($to_time) - strtotime($from_time)) / 3600, 1);
                                                    $diff = $diff < 0 ? $diff * -1 : $diff;
                                                    $pa = $diff / 4;
                                                    $mon_text = $week['mon'][$i]['event'] . '<br>' . '<span class="job-plan-spec">(' . $mon_plan['specialty'] . ')</span><br><span>PA: ' . round($pa, 2) . '</span><br>' . date("H:i", strtotime($week['mon'][$i]['from_time'])) . ' - ' . date('H:i', strtotime($week['mon'][$i]['to_time']));
                                                    $total_pa['mon'] += $pa;
                                                } else {
                                                    $mon_text = $week['mon'][$i]['event'] . '<br>' . date("H:i", strtotime($week['mon'][$i]['from_time'])) . ' - ' . date('H:i', strtotime($week['mon'][$i]['to_time']));
                                                }
                                            }
                                            if ($week_leave['mon']) {
                                                $mon_text = '<span class="text-danger"> On Leave </span>';
                                                if ($i > 0) {
                                                    $mon_text = 0;
                                                }
                                            }

                                            $tue_text = '';
                                            if ($i < count($week['tue'])) {
                                                $tue_text = '';
                                                $tue_plan = $week['tue'][$i];
                                                if ($tue_plan['event'] == 'Microscopy' && $tue_plan['specialty_id'] != NULL) {
                                                    $from_time = $tue_plan['from_time'];
                                                    $to_time = $tue_plan['to_time'];
                                                    $diff = round((strtotime($to_time) - strtotime($from_time)) / 3600, 1);
                                                    $diff = $diff < 0 ? $diff * -1 : $diff;
                                                    $pa = $diff / 4;
                                                    $tue_text = $week['tue'][$i]['event'] . '<br>' . '<span class="job-plan-spec">(' . $tue_plan['specialty'] . ')</span><br><span>PA: ' . round($pa, 2) . '</span><br>' . date("H:i", strtotime($week['tue'][$i]['from_time'])) . ' - ' . date('H:i', strtotime($week['tue'][$i]['to_time']));
                                                    $total_pa['tue'] += $pa;
                                                } else {
                                                    $tue_text = $week['tue'][$i]['event'] . '<br>' . date("H:i", strtotime($week['tue'][$i]['from_time'])) . ' - ' . date('H:i', strtotime($week['tue'][$i]['to_time']));
                                                }

                                            }
                                            if ($week_leave['tue']) {
                                                $tue_text = '<span class="text-danger"> On Leave </span>';
                                                if ($i > 0) {
                                                    $tue_text = 0;
                                                }
                                            }

                                            $wed_text = '';
                                            if ($i < count($week['wed'])) {
                                                $wed_text = '';
                                                $wed_plan = $week['wed'][$i];
                                                if ($wed_plan['event'] == 'Microscopy' && $wed_plan['specialty_id'] != NULL) {
                                                    $from_time = $wed_plan['from_time'];
                                                    $to_time = $wed_plan['to_time'];
                                                    $diff = round((strtotime($to_time) - strtotime($from_time)) / 3600, 1);
                                                    $diff = $diff < 0 ? $diff * -1 : $diff;
                                                    $pa = $diff / 4;
                                                    $wed_text = $week['wed'][$i]['event'] . '<br>' . '<span class="job-plan-spec">(' . $wed_plan['specialty'] . ')</span><br><span>PA: ' . round($pa, 2) . '</span><br>' . date("H:i", strtotime($week['wed'][$i]['from_time'])) . ' - ' . date('H:i', strtotime($week['wed'][$i]['to_time']));
                                                    $total_pa['wed'] += $pa;
                                                } else {
                                                    $wed_text = $week['wed'][$i]['event'] . '<br>' . date("H:i", strtotime($week['wed'][$i]['from_time'])) . ' - ' . date('H:i', strtotime($week['wed'][$i]['to_time']));
                                                }
                                            }
                                            if ($week_leave['wed']) {
                                                $wed_text = '<span class="text-danger"> On Leave </span>';
                                                if ($i > 0) {
                                                    $wed_text = 0;
                                                }
                                            }

                                            $thu_text = '';
                                            if ($i < count($week['thu'])) {
                                                $thu_text = '';
                                                $thu_plan = $week['thu'][$i];
                                                if ($thu_plan['event'] == 'Microscopy' && $thu_plan['specialty_id'] != NULL) {
                                                    $from_time = $thu_plan['from_time'];
                                                    $to_time = $thu_plan['to_time'];
                                                    $diff = round((strtotime($to_time) - strtotime($from_time)) / 3600, 1);
                                                    $diff = $diff < 0 ? $diff * -1 : $diff;
                                                    $pa = $diff / 4;
                                                    $thu_text = $week['thu'][$i]['event'] . '<br>' . '<span class="job-plan-spec">(' . $thu_plan['specialty'] . ')</span><br><span>PA: ' . round($pa, 2) . '</span><br>' . date("H:i", strtotime($week['thu'][$i]['from_time'])) . ' - ' . date('H:i', strtotime($week['thu'][$i]['to_time']));
                                                    $total_pa['thu'] += $pa;
                                                } else {
                                                    $thu_text = $week['thu'][$i]['event'] . '<br>' . date("H:i", strtotime($week['thu'][$i]['from_time'])) . ' - ' . date('H:i', strtotime($week['thu'][$i]['to_time']));
                                                }
                                            }
                                            if ($week_leave['thu']) {
                                                $thu_text = '<span class="text-danger"> On Leave </span>';
                                                if ($i > 0) {
                                                    $thu_text = 0;
                                                }
                                            }
                                            $fri_text = '';
                                            if ($i < count($week['fri'])) {
                                                $fri_text = '';
                                                $fri_plan = $week['fri'][$i];
                                                if ($fri_plan['event'] == 'Microscopy' && $fri_plan['specialty_id'] != NULL) {
                                                    $from_time = $fri_plan['from_time'];
                                                    $to_time = $fri_plan['to_time'];
                                                    $diff = round((strtotime($to_time) - strtotime($from_time)) / 3600, 1);
                                                    $diff = $diff < 0 ? $diff * -1 : $diff;
                                                    $pa = $diff / 4;
                                                    $fri_text = $week['fri'][$i]['event'] . '<br>' . '<span class="job-plan-spec">(' . $fri_plan['specialty'] . ')</span><br><span>PA: ' . round($pa, 2) . '</span><br>' . date("H:i", strtotime($week['fri'][$i]['from_time'])) . ' - ' . date('H:i', strtotime($week['fri'][$i]['to_time']));
                                                    $total_pa['fri'] += $pa;
                                                } else {
                                                    $fri_text = $week['fri'][$i]['event'] . '<br>' . date("H:i", strtotime($week['fri'][$i]['from_time'])) . ' - ' . date('H:i', strtotime($week['fri'][$i]['to_time']));
                                                }
                                            }
                                            if ($week_leave['fri']) {
                                                $fri_text = '<span class="text-danger"> On Leave </span>';
                                                if ($i > 0) {
                                                    $fri_text = 0;
                                                }
                                            }

                                            $sat_text = '';
                                            if ($i < count($week['sat'])) {
                                                $sat_text = '';
                                                $sat_plan = $week['sat'][$i];
                                                if ($sat_plan['event'] == 'Microscopy' && $sat_plan['specialty_id'] != NULL) {
                                                    $from_time = $sat_plan['from_time'];
                                                    $to_time = $sat_plan['to_time'];
                                                    $diff = round((strtotime($to_time) - strtotime($from_time)) / 3600, 1);
                                                    $diff = $diff < 0 ? $diff * -1 : $diff;
                                                    $pa = $diff / 4;
                                                    $sat_text = $week['sat'][$i]['event'] . '<br>' . '<span class="job-plan-spec">(' . $sat_plan['specialty'] . ')</span><br><span>PA: ' . round($pa, 2) . '</span><br>' . date("H:i", strtotime($week['sat'][$i]['from_time'])) . ' - ' . date('H:i', strtotime($week['sat'][$i]['to_time']));
                                                    $total_pa['sat'] += $pa;
                                                } else {
                                                    $sat_text = $week['sat'][$i]['event'] . '<br>' . date("H:i", strtotime($week['sat'][$i]['from_time'])) . ' - ' . date('H:i', strtotime($week['sat'][$i]['to_time']));
                                                }
                                            }
                                            if ($week_leave['sat']) {
                                                $sat_text = '<span class="text-danger"> On Leave </span>';
                                                if ($i > 0) {
                                                    $sat_text = 0;
                                                }
                                            }

                                            $sun_text = '';
                                            if ($i < count($week['sun'])) {
                                                $sun_text = '';
                                                $sun_plan = $week['sun'][$i];
                                                if ($sun_plan['event'] == 'Microscopy' && $sun_plan['specialty_id'] != NULL) {
                                                    $from_time = $sun_plan['from_time'];
                                                    $to_time = $sun_plan['to_time'];
                                                    $diff = round((strtotime($to_time) - strtotime($from_time)) / 3600, 1);
                                                    $diff = $diff < 0 ? $diff * -1 : $diff;
                                                    $pa = $diff / 4;
                                                    $sun_text = $week['sun'][$i]['event'] . '<br>' . '<span class="job-plan-spec">(' . $sun_plan['specialty'] . ')</span><br><span>PA: ' . round($pa, 2) . '</span><br>' . date("H:i", strtotime($week['sun'][$i]['from_time'])) . ' - ' . date('H:i', strtotime($week['sun'][$i]['to_time']));
                                                    $total_pa['sun'] += $pa;
                                                } else {
                                                    $sun_text = $week['sun'][$i]['event'] . '<br>' . date("H:i", strtotime($week['sun'][$i]['from_time'])) . ' - ' . date('H:i', strtotime($week['sun'][$i]['to_time']));
                                                }
                                            }
                                            if ($week_leave['sun']) {
                                                $sun_text = '<span class="text-danger"> On Leave </span>';
                                                if ($i > 0) {
                                                    $sun_text = 0;
                                                }
                                            }
                                            ?>
                                            <td><a href="javascript:;" class="text-dark"
                                                   style="font-size: 1rem;"><strong><?php echo 'Session ' . ($i + 1); ?></strong></a>
                                            </td>
                                            <td><a href="javascript:;" class="text-dark"><?php echo $mon_text; ?></a>
                                            </td>
                                            <td><a href="javascript:;" class="text-dark"><?php echo $tue_text; ?></a>
                                            </td>
                                            <td><a href="javascript:;" class="text-dark"><?php echo $wed_text; ?></a>
                                            </td>
                                            <td><a href="javascript:;" class="text-dark"><?php echo $thu_text; ?></a>
                                            </td>
                                            <td><a href="javascript:;" class="text-dark"><?php echo $fri_text; ?></a>
                                            </td>
                                            <td><a href="javascript:;" class="text-dark"><?php echo $sat_text; ?></a>
                                            </td>
                                            <td><a href="javascript:;" class="text-dark"><?php echo $sun_text; ?></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td><a href="javascript:;" class="text-dark" style="font-size: 1rem;"><strong>Total</strong></a>
                                        </td>
                                        <td><a href="javascript:;"
                                               class="text-dark"><strong><?php echo round($total_pa['mon'], 2) ?></strong></a>
                                        </td>
                                        <td><a href="javascript:;"
                                               class="text-dark"><strong><?php echo round($total_pa['tue'], 2) ?></strong></a>
                                        </td>
                                        <td><a href="javascript:;"
                                               class="text-dark"><strong><?php echo round($total_pa['wed'], 2) ?></strong></a>
                                        </td>
                                        <td><a href="javascript:;"
                                               class="text-dark"><strong><?php echo round($total_pa['thu'], 2) ?></strong></a>
                                        </td>
                                        <td><a href="javascript:;"
                                               class="text-dark"><strong><?php echo round($total_pa['fri'], 2) ?></strong></a>
                                        </td>
                                        <td><a href="javascript:;"
                                               class="text-dark"><strong><?php echo round($total_pa['sat'], 2) ?></strong></a>
                                        </td>
                                        <td><a href="javascript:;"
                                               class="text-dark"><strong><?php echo round($total_pa['sun'], 2) ?></strong></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="card profile-box flex-fill">
                    <div class="card-body">
                        <h3 class="card-title">Connecting Hospitals</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="card profile-box flex-fill">
                    <div class="card-body">
                        <h3 class="card-title">Leave

                            <a href="#" class="btn btn-primary btn-rounded btn-sm pull-right" data-toggle="modal"
                               data-target="#leave_modal">Apply Leave</a>

                        </h3>
                        <br>
                        <style>
                            .profile-widget {
                                background-color: transparent !important;
                                border: none !important;
                                border-radius: 4px;
                                margin-bottom: 30px;
                                padding: 20px;
                                text-align: center;
                                position: relative;
                                box-shadow: none !important;
                                overflow: hidden;
                            }

                            .hospital-container {
                                position: absolute;
                                left: 0.6rem;
                                top: 0.5rem;
                                display: inline;
                            }

                            .hospital-info {
                                border: 2px solid #0192E6;
                                display: inline;
                                padding: 6px 4px;
                                border-radius: 600px;
                                font-size: 0.75rem;
                                color: #0192E6;
                            }
                        </style>
                        <div class="profile-widget">
                            <div class="hospital-container">
                                <?php foreach ($userHospitals as $userHospital) { ?>
                                    <div data-toggle="tooltip" data-placement="top" title=""
                                         class="hospital-info hos_open" data-id="<?php echo $userHospital->id; ?>"
                                         data-original-title="<?php echo $userHospital->hospital_name; ?>"><?php echo $userHospital->first_initial . $userHospital->last_initial ?></div>
                                <?php } ?>
                                <!--                                <div data-toggle="tooltip" data-placement="top" title="" class="hospital-info" data-original-title="Newlife Hospital">NH</div>-->
                            </div>
                        </div>

                        <?php $groupId = $this->ion_auth->get_users_groups($user_id)->row()->id;

                        if ($groupId == 1) {
                            ?>
                            <div class="col-md-12 form-group thumb_view">
                                <?php if (!empty($usersLeaveBalance)){?>
                                    <div class="row">
                                        <div class="col-md-12 nopadding">
                                            <h4 class="form-group">Total Leaves :</h4>
                                            <div class="time-list">
                                                <div class="clearfix"></div>
                                                <?php foreach ($usersLeaveBalance as $userLeave) {
                                                    ?>
                                                    <div class="dash-stats-list">
                                                        <h4><?php echo $userLeave->quota; ?></h4>
                                                        <p><?php echo $userLeave->name; ?></p>
                                                    </div>
                                                    <?php
                                                } ?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 nopadding">
                                            <h4 class="form-group">Leaves Taken:</h4>
                                            <div class="time-list">
                                                <div class="clearfix"></div>
                                                <?php foreach ($usersLeaveBalance as $userLeave) {
                                                    $leaveDataEncode = base64_encode($userLeave->hospital_id . "_" . $userLeave->leave_type_id);
                                                    ?>
                                                    <div class="dash-stats-list">
                                                        <h4>
                                                            <a href="<?php echo base_url("leaveManagement/leaveDetail/$leaveDataEncode") ?>"><?php echo $userLeave->availed; ?></a>
                                                        </h4>
                                                        <p><?php echo $userLeave->name; ?></p>
                                                    </div>
                                                    <?php
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } else { ?>
                            <div class="col-md-12 form-group thumb_view">
                                <?php $counter=1; foreach ($userHospitals as $userHospital) { ?>
                                    <div id="hospital_<?php echo $userHospital->id; ?>" class="all_leave_show"
                                         style="display: <?php echo ($counter==1?"block":"none")?>">
                                        <?php if (!empty($usersLeaveBalance)){?>
                                            <div class="row">
                                                <div class="col-md-12 nopadding">
                                                    <h4 class="form-group">Total Leaves :</h4>
                                                    <div class="time-list">
                                                        <div class="clearfix"></div>
                                                        <?php foreach ($usersLeaveBalance as $userLeave) {
                                                            if ($userLeave->hospital_id == $userHospital->id) {
                                                                ?>
                                                                <div class="dash-stats-list">
                                                                    <h4><?php echo $userLeave->quota; ?></h4>
                                                                    <p><?php echo $userLeave->name; ?></p>
                                                                </div>
                                                                <!--                                            <div class="dash-stats-list">-->
                                                                <!--                                                <h4>90</h4>-->
                                                                <!--                                                <p>Professional/ Study</p>-->
                                                                <!--                                            </div>-->
                                                                <!--                                            <div class="dash-stats-list">-->
                                                                <!--                                                <h4>18</h4>-->
                                                                <!--                                                <p>Sick</p>-->
                                                                <!--                                            </div>-->
                                                            <?php }
                                                        } ?>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 nopadding">
                                                    <h4 class="form-group">Leaves Taken:</h4>
                                                    <div class="time-list">
                                                        <div class="clearfix"></div>
                                                        <?php foreach ($usersLeaveBalance as $userLeave) {
                                                            if ($userLeave->hospital_id == $userHospital->id) {
                                                                $leaveDataEncode = base64_encode($userLeave->hospital_id . "_" . $userLeave->leave_type_id);
                                                                ?>
                                                                <div class="dash-stats-list">
                                                                    <h4>
                                                                        <a href="<?php echo base_url("leaveManagement/leaveDetail/$leaveDataEncode") ?>"><?php echo $userLeave->availed; ?></a>
                                                                    </h4>
                                                                    <p><?php echo $userLeave->name; ?></p>
                                                                </div>
                                                            <?php }
                                                        } ?>

                                                        <!--                                        <div class="dash-stats-list">-->
                                                        <!--                                            <h4>0</h4>-->
                                                        <!--                                            <p>Professional/ Study</p>-->
                                                        <!--                                        </div>-->
                                                        <!--                                        <div class="dash-stats-list">-->
                                                        <!--                                            <h4>5</h4>-->
                                                        <!--                                            <p>Sick</p>-->
                                                        <!--                                        </div>-->
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }?>
                                    </div>
                                <?php $counter ++;} ?>
                            </div>
                        <?php } ?>

                        <div class="col-md-12 form-group list_view" style="display: none">
                            <table class="table table-striped custom-table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Annual</th>
                                    <th>Professional<br> Study</th>
                                    <th>Sick</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Total</td>
                                    <td>24</td>
                                    <td>90</td>
                                    <td>18</td>
                                </tr>
                                <tr>
                                    <td>Taken</td>
                                    <td>12</td>
                                    <td>0</td>
                                    <td>8</td>
                                </tr>
                                <tr>
                                    <td>Balance</td>
                                    <td>12</td>
                                    <td>90</td>
                                    <td>10</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="card profile-box flex-fill">
                    <div class="card-body">
                        <h3 class="card-title">Roles & Permissions
                            <a href="<?php echo base_url() ?>Admin/roles_permissions" class="edit-icon"><i
                                        class="fa fa-pencil"></i></a>
                        </h3>

                        <br>
                        <div class="col-md-12 form-group thumb_view">
                            <div class="m-b-30">
                                <ul class="list-group notification-list">
                                    <li class="list-group-item">
                                        Employee
                                        <div class="status-toggle">
                                            <input type="checkbox" id="staff_module" class="check" checked="">
                                            <label for="staff_module" class="checktoggle">checkbox</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        Holidays
                                        <div class="status-toggle">
                                            <input type="checkbox" id="holidays_module" class="check" checked="">
                                            <label for="holidays_module" class="checktoggle">checkbox</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        Leaves
                                        <div class="status-toggle">
                                            <input type="checkbox" id="leave_module" class="check" checked="">
                                            <label for="leave_module" class="checktoggle">checkbox</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        Events
                                        <div class="status-toggle">
                                            <input type="checkbox" id="events_module" class="check" checked="">
                                            <label for="events_module" class="checktoggle">checkbox</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        Chat
                                        <div class="status-toggle">
                                            <input type="checkbox" id="chat_module" class="check" checked="">
                                            <label for="chat_module" class="checktoggle">checkbox</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        Jobs
                                        <div class="status-toggle">
                                            <input type="checkbox" id="job_module" class="check">
                                            <label for="job_module" class="checktoggle">checkbox</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12 form-group list_view" style="display: none">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table">
                                    <thead>
                                    <tr>
                                        <th>Module Permission</th>
                                        <th class="text-center">Read</th>
                                        <th class="text-center">Write</th>
                                        <th class="text-center">Create</th>
                                        <th class="text-center">Delete</th>
                                        <th class="text-center">Import</th>
                                        <th class="text-center">Export</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Employee</td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Holidays</td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="" disabled>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="" disabled>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="" disabled>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="" disabled>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="" disabled>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Leaves</td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="" disabled>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="" disabled>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="" disabled>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="" disabled>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="" disabled>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Events</td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="" disabled>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="" disabled>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="" disabled>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="" disabled>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="" disabled>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" checked="" disabled>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Profile Info Tab -->
    <!-- Projects Tab -->
    <div class="tab-pane fade" id="emp_projects">
        <div class="row">
        </div>
    </div>
    <?php if ($this->ion_auth->in_group('admin') && $group_type[0]->group_type === 'D'): ?>
        <div class="tab-pane fade" id="secretary_assign">
            <div class="card">
                <div class="card-body">
                    <div class="secretary-container">
                        <h3>Assign Secretary</h3>
                        <h5>Secretary Assigned</h5>
                        <ul class="list-group">
                            <?php foreach ($secretary_data as $secretary): ?>
                                <li class="list-group-item">
                            <span class="secretary_details">
                                <span class="user-img">
                                    <img src="<?php echo base_url($secretary['profile_picture']); ?>" alt="">
                                 </span>
                                <?php echo $secretary['first_name'] . ' ' . $secretary['last_name'] ?>
                            </span>
                                    <button value="<?php echo $secretary['id']; ?>"
                                            class="btn btn-default btn-xs pull-right remove-secretary remove-item">
                                        <i class="fa fa-user-times" aria-hidden="true"></i>
                                    </button>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="form-gorup">
                            <button class="btn btn-success float-right" id="add-secretary-id">Add Secretary</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- /Projects Tab -->
    <!-- Bank Statutory Tab -->
    <div class="tab-pane fade" id="bank_statutory">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title"> Outsource & Speciality </h3>
                <?php echo form_open(base_url() . 'index.php/auth/updateUserCustomForm/' . $user->id, array('class' => 'form tg-formtheme tg-editform')); ?>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-form-label">Outsource Work <span class="text-danger">*</span></label>
                            <input type="text" name="outsource_work_name" class="form-control"
                                   value="<?php echo($user_details['outsource_work_name'] != "" ? $user_details['outsource_work_name'] : "") ?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-form-label">Date Available</label>
                            <div class="input-group">
                                <div class="cal-icon">
                                    <input type="text" name="outsource_work_avail_date"
                                           class="form-control datetimepicker"
                                           value="<?php echo($user_details['outsource_work_avail_date'] != "" ? $user_details['outsource_work_avail_date'] : "") ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-form-label">Account Name</label>
                            <input type="text" name="account_number" class="form-control"
                                   value="<?php echo($user_details['account_number'] != "" ? $user_details['account_number'] : "No Data") ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-form-label">Account CSV <span class="text-danger">*</span></label>
                            <input type="text" name="account_csv_code" class="form-control"
                                   value="<?php echo($user_details['account_csv_code'] != "" ? $user_details['account_csv_code'] : "No Data") ?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-form-label">Case Details</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" name="cases_limit" class="form-control"
                                       value="<?php echo(!empty($user_details['cases_limit']) ? $user_details['cases_limit'] : "No Data") ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-form-label">Case Address</label>
                            <input type="text" name="cases_posted_address" class="form-control"
                                   value="<?php echo($user_details['cases_posted_address'] != "" ? $user_details['cases_posted_address'] : "No Data") ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-form-label">Home Address <span class="text-danger">*</span></label>
                            <input type="text" name="report_from_home" class="form-control"
                                   value="<?php echo($user_details['report_from_home'] != "" ? $user_details['report_from_home'] : "No Data") ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-form-label">Receive Works</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" name="receive_work_days" class="form-control"
                                       value="<?php echo(!empty($user_details['receive_work_days']) ? $user_details['receive_work_days'] : "No Data") ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" type="submit">Save</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- /Bank Statutory Tab -->
    <div class="tab-pane fade" id="specialties">
        <?php if (!empty($specialties)): ?>
            <!-- Specialties Tab -->
            <h3 class="card-title">Specialties</h3>
            <div class="m-b-30">
                <ul class="list-group notification-list">
                    <?php foreach ($specialties as $specialty): ?>
                        <li class="list-group-item">
                            <?php echo $specialty->specialty; ?>
                            <div class="status-toggle">
                                <input type="checkbox"
                                       onchange="toggleSpecialty(<?php echo $specialty->id; ?>,<?php echo $user->id ?>)"
                                       id="specialty-<?php echo $specialty->id; ?>"<?php echo empty($specialty->user_id) ? "" : "checked"; ?>
                                       class="check">
                                <label for="specialty-<?php echo $specialty->id; ?>"
                                       class="checktoggle">checkbox</label>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- /Specialties Tab -->
        <?php endif; ?>
    </div>
</div>
<!-- /Page Content -->

<!-- Profile Modal -->
<div id="profile_info" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 1200px!important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Profile Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart(uri_string(), array('class' => 'form tg-formtheme tg-editform', 'id' => 'edit-form_hos')); ?>
                <input type="hidden" name="input_type" value="basic_info"/>
                <input type="hidden" name="pre_email" class="form-control" value="<?php echo $user_details['email'] ?>">
                <input type="hidden" name="pre_status" class="form-control" value="<?php echo $user->status; ?>">
                <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
                <input type="hidden" id="csrf_token_name" value="<?php echo $this->security->get_csrf_token_name();?>">
                <input type="hidden" id="csrf_token_hash" value="<?php echo $this->security->get_csrf_hash();?>">

                <div class="row">
                    <div class="col-md-12">
                        <div class="tg-useruploadimg-pop">
                        </div>
                        <div class="profile-img-wrap edit-img">
                            <img class="inline-block profile-pic"
                                 src="<?php echo get_profile_picture($profile_picture_path, $user_details['first_name'], $user_details['last_name']); ?>"
                                 alt="Profile Picture">

                            <div class="fileupload btn">
                                <div id='img_contain'></div>
                                <span class="btn-text">edit</span>
                                <input class="imgInp custom-file-input upload profile_edit" id="inputGroupFile01"
                                       name="profile_image_name" type="file" aria-describedby="inputGroupFileAddon01">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" class="form-control" name="first_name"
                                           value="<?php echo $user_details['first_name'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" class="form-control"
                                           value="<?php echo $user_details['last_name'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone No</label>
                                    <input class="form-control" name="phone" type="text"
                                           value="<?php echo $user_details['phone'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" value="<?php echo $user_details['email'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Division</label>
                               <select class="form-control" name="division_id"  onchange="getDepartment_list(this.value)"> 
                                 <option value=""> Select Division</option>
                                 <?php if(!empty($division)){
                                  foreach($division as $dv){
                                    ?>
                                    <option value="<?php echo $dv['id'];?>" <?php if($user_details['division_id']==$dv['id']){echo "selected";}?>><?php echo $dv['title'];?></option>
                                  <?php 
                                    }
                                  }
                                  ?>
                                 
                               </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                                <label>Department</label>
                              <div class="form-group">
                               <select class="form-control" name="department_id" id="devision_department_list" onchange="department_spe(this.value)">
                                    <option value=""> Select Department</option>
                                    
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                                <label>Speciality</label>
                              <div class="form-group">
                                <select class="form-control" name="speciality_id" id="speciality_list" onchange="getcategory(this.value)">
                                     <option value=""> Select Speciality</option>
                                    
                                   </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                                <label>Category</label>
                              <div class="form-group">
                                <select class="form-control" name="category_id" id="cat_department_list">
                                     <option value=""> Select Category</option>
                                    
                                   </select>
                              </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row">


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Memorable Word</label>
                            <input id="mem_word_field" class="form-control" name="memorable" type="password"
                                   value="<?php echo $user_details['memorable'] ?>">
                            <span toggle="#mem_word_field" class="fa fa-fw fa-eye field-icon toggle_value"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Company</label>
                            <input type="text" name="company" class="form-control"
                                   value="<?php echo $user_details['company'] ?>">
                        </div>
                    </div>
<!--                    <div class="col-md-6">-->
<!--                        <div class="form-group">-->
<!--                            <label>Institute</label>-->
<!--                            <select class="select" name="hos_id[]" id="multiselect" multiple="multiple">-->
<!--                                <option value="">Choose Institute</option>-->
<!--                                --><?php
//                                $groups_list = getRecords('*', 'groups', array('type_cate' => 'usergroup'));
//                                foreach ($groups_list as $rec) {
//                                    $selected = '';
//                                    if (in_array($rec->id, $usergrouphospital)) {
//                                        $selected = 'selected="selected"';
//                                    }
//                                    ?>
<!--                                    <option value="--><?php //echo $rec->id ?><!--" --><?php //echo $selected; ?> <?php //echo html_purify($rec->name); ?><!--</option>-->
<!--                                    --><?php
//                                } ?>
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Login Token</label>
                            <input id="login_token_field" class="form-control" name="login_token" type="password"
                                   value="<?php echo $user_details['login_token'] ?>">
                            <span toggle="#login_token_field" class="fa fa-fw fa-eye field-icon toggle_value"></span>
                        </div>
                    </div>
                    <div class="col-md-6" style="display: none;">
                        <div class="form-group">
                            <label>Member Of</label>
                            <select class="select form-control" id="member_of_select2" multiple="multiple" name="group_id[]" > 
                                <?php
                                $groups_list = getRecords('*', 'groups', array('group_type !=' => 'M'));
                                $selected_grps_by_db = array();
                                foreach ($groups_list as $key) {
                                    $active = '';
                                    if (in_array($key->id, $user_member_groups)) {
                                        $active = 'selected="selected"';
                                        $selected_grps_by_db[]=$key->group_type;
                                    }
                                    ?>
                                    <option value="<?php echo $key->id ?>"  data-grouptype="<?php echo $key->group_type; ?>" <?php echo $active; ?> ><?php echo html_purify($key->name); ?></option>
                                    <?php

                                } ?>
                            </select>
                            <label id="member_of_select2-error" class="error" for="member_of_select2" style="display: none">Member of is required</label>
                            <label id="member_of_err_label" class="error"></label>
                            <input type="hidden" id="selected_grps_by_db" name="selected_grps_by_db" value='<?php echo json_encode($selected_grps_by_db); ?>'>
                        </div>
                    </div>

                    <div class="col-md-6" style="display: none;">
                        <div class="form-group">
                            <label>User Group</label>
                            <select class="select form-control" name="child_user_group" id="child_user_groups" onchange="checkchildpathologistgroup(this)">
                                <option value="">Choose Role</option>
                                <?php if(!empty($child_groups)){
                                    foreach($child_groups as $childgroup){
                                        $selected = '';
                                        if($childgroup['id'] == $user_child_group['id']){
                                            $selected = 'selected';
                                            if($childgroup['group_type']=='D'){
                                                $show_pathologist_groups = '';
                                            }
                                        }
                                        if($selected=='' && (($user_child_group['group_type']=='T' || $user_child_group['group_type'] =='PS') && $childgroup['group_type']=='D')){
                                            $selected = 'selected';
                                            $show_pathologist_users = '';
                                            if($childgroup['group_type']=='D'){
                                                $show_pathologist_groups = '';
                                            }
                                        }
                                        ?>
                                        <option value="<?php echo $childgroup['id']; ?>" data-grouptype="<?php echo $childgroup['group_type']; ?>" <?php echo $selected; ?> ><?php echo $childgroup['name']; ?></option>
                                <?php } }?>
                            </select>
                            <label id="child_user_groups-error" class="error" for="child_user_groups"></label>
                        </div>
                    </div>

                    <div class="col-md-6 <?php echo $show_pathologist_groups; ?>" id="pathologist_role_div">
                        <div class="form-group">
                            <label>Pathologist Group</label>
                            <select class="select form-control" name="child_pathologist_user_group" id="child_pathologist_user_group" onchange="checkPathologistManager(this)" >
                                <option value="">Choose Role</option>
                                <?php if(!empty($child_pathologist_groups)){
                                    foreach($child_pathologist_groups as $childpathologist){?>
                                        <option value="<?php echo $childpathologist['id']; ?>" data-grouptype="<?php echo $childpathologist['group_type']; ?>" <?php echo (($childpathologist['id'] == $user_child_group['id'])?'selected':''); ?> ><?php echo $childpathologist['name']; ?></option>
                                    <?php } }?>
                            </select>
                            <label id="child_pathologist_user_group-error" class="error" for="child_pathologist_user_group"></label>
                        </div>
                    </div>

                    <div class="col-md-6 <?php echo $show_pathologist_users; ?>" id="pathologist_manager_div">
                        <div class="form-group">
                            <label>Manager Pathologist</label>
                            <select class="select form-control" name="manager_pathologist[]" multiple="multiple" id="manager_pathologist" >
                                <option value="">Choose Pathologist</option>
                                <?php if(!empty($all_pathologists)){
                                    foreach($all_pathologists as $a_pathologist){?>
                                        <option value="<?php echo $a_pathologist['id']; ?>" <?php echo ((in_array($a_pathologist['id'], $manager_pathologist))?'selected':''); ?> ><?php echo $a_pathologist['pathologist_name']; ?></option>
                                    <?php } }?>
                            </select>
                            <label id="manager_pathologist-error" class="error" for="manager_pathologist"></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Current Position</label>
                            <input type="text" name="current_position" class="form-control"
                                   value="<?php echo $user_details['current_position'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="street_address" class="form-control"
                                   value="<?php echo $user_details['address1'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Current Status</label>
                            <input class="form-control" name="current_status" type="text"
                                   value="<?php echo $user_details['current_status'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Current Employer</label>
                            <input class="form-control" name="current_employer" type="text"
                                   value="<?php echo $user_details['current_employer'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Street Address <span class="text-danger">*</span></label>
                            <input class="form-control" name="work_street_address" type="text"
                                   value="<?php echo $user_details['address2'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Last Appraisal</label>
                            <div class="cal-icon">
                                <input class="form-control datetimepicker" name="last_appraisal_date" type="text"
                                       value="<?php echo $user_details['last_appraisal_date'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>DOB</label>
                            <div class="cal-icon">
                                <input class="form-control datetimepicker" name="dob" type="text"
                                       value="<?php echo $user_details['dob'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" name="phone" type="text" value="<?php echo $user_details['phone'] ?>">
                        </div>
                    </div>
                </div>
                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- /Profile Modal -->
<!-- Profile Modal -->
<div id="password_info" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(uri_string(), array('id' => 'update_password_form')); ?>
                <input type="hidden" name="user_id" value="<?php echo $user_id ?>"/>
                <input type="hidden" name="password_status" id="password_status" value="0"/>
                <?php if (!$this->ion_auth->in_group('admin')): ?>
                    <div class="form-group row tg-inputwithicon">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Current Password</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <input type="password" id="prepass" name="prepass" class="form-control show_pass"
                                       value="">
                                <span id="prepass_span" style="display: none;color: red"></span>
                                <div class="view_password"><i class="fa fa-eye"></i></div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="form-group row tg-inputwithicon">
                    <label for="staticEmail" class="col-sm-3 col-form-label">New Password</label>
                    <div class="col-sm-8">
                        <div class="row">
                            <input type="password" id="newpassword" name="password"
                                   class="pr-password form-control show_pass" value="">
                            <span id="pass_span" style="display: none;color: red"></span>
                            <div class="view_password"><i class="fa fa-eye"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group row tg-inputwithicon">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Confirm Password</label>
                    <div class="col-sm-8">
                        <div class="row">
                            <input type="password" id="confirmpassword" name="re_password"
                                   class="form-control show_pass"
                                   value="">
                            <span id="confirm_span" style="display: none;color: red">Password not matched</span>
                            <div class="view_password"><i class="fa fa-eye"></i></div>
                        </div>
                    </div>
                </div>
                <div class="submit-section">
                    <button class="btn btn-primary password-submit-btn" type="button">Submit</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<div id="pin_info" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change PIN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(uri_string(), array('id' => 'update_pin_form')); ?>
                <input type="hidden" name="user_id" value="<?php echo $user_id ?>"/>
                <input type="hidden" name="pin_status" id="pin_status" value="0"/>
                <input type="hidden" name="current_pin_code" id="current_pin_code"
                       value="<?php echo $user->user_auth_pass; ?>"/>
                <?php if (!$this->ion_auth->in_group('admin')): ?>
                    <div class="form-group row tg-inputwithicon">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Current PIN</label>
                        <div class="col-sm-8">
                            <div class="row init_pin">
                                <!--                                <input type="password" id="pre_pin" name="pre_pin" class="form-control show_pass"  required>-->
                                <input type="password" id="" class="form-control show_pass pre_pin col-lg-2"
                                       maxlength="1"
                                       data-class="pre_pin" name="pre_pin[]" style="margin-left: 12px">
                                <input type="password" id="" class="form-control show_pass pre_pin col-lg-2"
                                       maxlength="1"
                                       data-class="pre_pin" name="pre_pin[]" style="margin-left: 12px">
                                <input type="password" id="" class="form-control show_pass pre_pin col-lg-2"
                                       maxlength="1"
                                       data-class="pre_pin" name="pre_pin[]" style="margin-left: 12px">
                                <input type="password" id="" class="form-control show_pass pre_pin col-lg-2"
                                       maxlength="1"
                                       data-class="pre_pin" name="pre_pin[]" style="margin-left: 12px">
                                <span id="pin_span" style="display: none;color: red">PIN Not Matched</span>
                                <!--                                <div class="view_password"><i class="fa fa-eye"></i></div>-->
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="form-group row tg-inputwithicon">
                    <label for="staticEmail" class="col-sm-4 col-form-label">PIN</label>
                    <div class="col-sm-8">
                        <div class="row init_pin">
                            <!-- <input type="password" id="user_pin" name="user_pin" class="form-control show_pass check_pin"  required> -->
                            <input type="password" id="" class="form-control show_pass user_pin col-lg-2" maxlength="1"
                                   data-class="user_pin" name="user_pin[]" style="margin-left: 12px">
                            <input type="password" id="" class="form-control show_pass user_pin col-lg-2" maxlength="1"
                                   data-class="user_pin" name="user_pin[]" style="margin-left: 12px">
                            <input type="password" id="" class="form-control show_pass user_pin col-lg-2" maxlength="1"
                                   data-class="user_pin" name="user_pin[]" style="margin-left: 12px">
                            <input type="password" id="" class="form-control show_pass user_pin col-lg-2" maxlength="1"
                                   data-class="user_pin" name="user_pin[]" style="margin-left: 12px">
                            <span id="user_pin_span" style="display: none;color: red">PIN is required</span>
                            <!-- <div class="view_password"><i class="fa fa-eye"></i></div> -->
                        </div>
                    </div>
                </div>
                <div class="form-group row tg-inputwithicon">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Confirm PIN</label>
                    <div class="col-sm-8">
                        <div class="row init_pin">
                            <!-- <input type="password" id="confirm_user_pin" name="confirm_user_pin" class="form-control show_pass check_pin" required> -->
                            <!-- <div class="view_password"><i class="fa fa-eye"></i></div> -->
                            <input type="password" id="" class="form-control show_pass confirm_user_pin col-lg-2"
                                   maxlength="1" data-class="confirm_user_pin" name="confirm_user_pin[]"
                                   style="margin-left: 12px">
                            <input type="password" id="" class="form-control show_pass confirm_user_pin col-lg-2"
                                   maxlength="1" data-class="confirm_user_pin" name="confirm_user_pin[]"
                                   style="margin-left: 12px">
                            <input type="password" id="" class="form-control show_pass confirm_user_pin col-lg-2"
                                   maxlength="1" data-class="confirm_user_pin" name="confirm_user_pin[]"
                                   style="margin-left: 12px">
                            <input type="password" id="" class="form-control show_pass confirm_user_pin col-lg-2"
                                   maxlength="1" data-class="confirm_user_pin" name="confirm_user_pin[]"
                                   style="margin-left: 12px">
                            <span id="confirm_user_pin_span" style="display: none;color: red">PIN is required</span>
                        </div>
                    </div>
                </div>
                <div class="submit-section">
                    <button class="btn btn-primary pin-submit-btn" type="submit">Submit</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- /Profile Modal -->
<!-- Personal Info Modal -->
<div id="personal_info_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Personal Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(uri_string(), array('class' => 'form tg-formtheme tg-editform')); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Current Position</label>
                            <input type="text" name="current_position" class="form-control"
                                   value="<?php echo $user_details['current_position']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="street_address" class="form-control"
                                   value="<?php echo $user_details['street_address'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Current Status</label>
                            <input class="form-control" name="current_status" type="text"
                                   value="<?php echo $user_details['current_status'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Current Employer</label>
                            <input class="form-control" name="current_employer" type="text"
                                   value="<?php echo $user_details['current_employer'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Street Address <span class="text-danger">*</span></label>
                            <input class="form-control" name="work_street_address" type="text"
                                   value="<?php echo $user_details['work_street_address'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Last Appraisal</label>
                            <div class="cal-icon">
                                <input class="form-control datetimepicker" name="last_appraisal_date" type="text"
                                       value="<?php echo $user_details['last_appraisal_date'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>DOB</label>
                            <div class="cal-icon">
                                <input class="form-control datetimepicker" name="dob" type="text"
                                       value="<?php echo $user_details['dob'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" name="phone" type="text" value="<?php echo $user_details['phone'] ?>">
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- /Personal Info Modal -->
    <!-- Outsource Info Modal -->
    <!-- Family Info Modal -->
    <div id="family_info_modal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Family Informations</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-scroll">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Family Member <a href="javascript:void(0);"
                                                                            class="delete-icon"><i
                                                    class="fa fa-trash-o"></i></a></h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Relationship <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date of birth <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Education Informations <a href="javascript:void(0);"
                                                                                     class="delete-icon"><i
                                                    class="fa fa-trash-o"></i></a></h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Relationship <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date of birth <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="add-more">
                                        <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Family Info Modal -->
    <!-- Emergency Contact Modal -->
    <div id="emergency_contact_modal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Personal Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Primary Contact</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Relationship <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone 2</label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Primary Contact</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Relationship <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone 2</label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Emergency Contact Modal -->
    <!-- Education Modal -->
    <div id="education_info" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Education Informations</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-scroll">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Education Informations <a href="javascript:void(0);"
                                                                                     class="delete-icon"><i
                                                    class="fa fa-trash-o"></i></a></h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-focus focused">
                                                <input type="text" value="Oxford University"
                                                       class="form-control floating">
                                                <label class="focus-label">Institution</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus focused">
                                                <input type="text" value="Computer Science"
                                                       class="form-control floating">
                                                <label class="focus-label">Subject</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus focused">
                                                <div class="cal-icon">
                                                    <input type="text" value="01/06/2002"
                                                           class="form-control floating datetimepicker">
                                                </div>
                                                <label class="focus-label">Starting Date</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus focused">
                                                <div class="cal-icon">
                                                    <input type="text" value="31/05/2006"
                                                           class="form-control floating datetimepicker">
                                                </div>
                                                <label class="focus-label">Complete Date</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus focused">
                                                <input type="text" value="BE Computer Science"
                                                       class="form-control floating">
                                                <label class="focus-label">Degree</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus focused">
                                                <input type="text" value="Grade A" class="form-control floating">
                                                <label class="focus-label">Grade</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Education Informations <a href="javascript:void(0);"
                                                                                     class="delete-icon"><i
                                                    class="fa fa-trash-o"></i></a></h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-focus focused">
                                                <input type="text" value="Oxford University"
                                                       class="form-control floating">
                                                <label class="focus-label">Institution</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus focused">
                                                <input type="text" value="Computer Science"
                                                       class="form-control floating">
                                                <label class="focus-label">Subject</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus focused">
                                                <div class="cal-icon">
                                                    <input type="text" value="01/06/2002"
                                                           class="form-control floating datetimepicker">
                                                </div>
                                                <label class="focus-label">Starting Date</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus focused">
                                                <div class="cal-icon">
                                                    <input type="text" value="31/05/2006"
                                                           class="form-control floating datetimepicker">
                                                </div>
                                                <label class="focus-label">Complete Date</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus focused">
                                                <input type="text" value="BE Computer Science"
                                                       class="form-control floating">
                                                <label class="focus-label">Degree</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus focused">
                                                <input type="text" value="Grade A" class="form-control floating">
                                                <label class="focus-label">Grade</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="add-more">
                                        <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Education Modal -->
    <!-- Experience Modal -->
    <div id="experience_info" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Experience Informations</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-scroll">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Experience Informations <a href="javascript:void(0);"
                                                                                      class="delete-icon"><i
                                                    class="fa fa-trash-o"></i></a></h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <input type="text" class="form-control floating"
                                                       value="Digital Devlopment Inc">
                                                <label class="focus-label">Company Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <input type="text" class="form-control floating" value="United States">
                                                <label class="focus-label">Location</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <input type="text" class="form-control floating" value="Web Developer">
                                                <label class="focus-label">Job Position</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control floating datetimepicker"
                                                           value="01/07/2007">
                                                </div>
                                                <label class="focus-label">Period From</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control floating datetimepicker"
                                                           value="08/06/2018">
                                                </div>
                                                <label class="focus-label">Period To</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Experience Informations <a href="javascript:void(0);"
                                                                                      class="delete-icon"><i
                                                    class="fa fa-trash-o"></i></a></h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <input type="text" class="form-control floating"
                                                       value="Digital Devlopment Inc">
                                                <label class="focus-label">Company Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <input type="text" class="form-control floating" value="United States">
                                                <label class="focus-label">Location</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <input type="text" class="form-control floating" value="Web Developer">
                                                <label class="focus-label">Job Position</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control floating datetimepicker"
                                                           value="01/07/2007">
                                                </div>
                                                <label class="focus-label">Period From</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control floating datetimepicker"
                                                           value="08/06/2018">
                                                </div>
                                                <label class="focus-label">Period To</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="add-more">
                                        <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Profile</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="card mb-0">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view">
                        <div class="profile-img-wrap">
                            <div class="profile-img">
                                <a href="#"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
                            </div>
                        </div>
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <h3 class="user-name m-t-0 mb-0"><?php echo $user_details['first_name'] . " " . $user_details['last_name']; //echo uralensisGetUsername(intval($user_id), 'fullname'); ?></h3>
                                        <?php
                                        $groups_list = getStaticGroupNames();
                                        foreach ($groups_list as $key => $value) {
                                            $active = '';
                                            if ($group_type[0]->group_type === $key) {
                                                $active = 'tg-active';
                                            }
                                            echo '<h6 class="text-muted">' . html_purify($value) . '</h6>';
                                        } ?>
                                        <!--<small class="text-muted">Web Designer</small>
                                        <div class="staff-id">Employee ID : FT-0001</div>-->
                                        <div class="small doj text-muted">Date of Join
                                            : <?php echo date('F d , Y', getUserMetaDetail($user_id, 'created_on', 'users')[0]['created_on']); ?></div>
                                        <div class="staff-msg"><a class="btn btn-custom" href="javascript:">Send
                                                Message</a></div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Frist Name:</div>
                                            <div class="text"><?php echo $user_details['first_name'] ?></div>
                                        </li>
                                        <li>
                                            <div class="title">Last Name:</div>
                                            <div class="text"><?php echo $user_details['last_name'] ?></div>
                                        </li>
                                        <li>
                                            <div class="title">Phone:</div>
                                            <div class="text"><a href=""><?php echo $user_details['phone'] ?></a></div>
                                        </li>
                                        <li>
                                            <div class="title">Email:</div>
                                            <div class="text"><a href=""><?php echo $user_details['email'] ?></a></div>
                                        </li>
                                        <li>
                                            <div class="title">Company:</div>
                                            <div class="text"><?php echo $user_details['company'] ?></div>
                                        </li>
                                        <li>
                                            <div class="title">Address:</div>
                                            <div class="text"><?php echo $user_details['street_address']; ?></div>
                                        </li>
                                        <li>
                                            <div class="title">Hospital:</div>
                                            <div class="text">
                                                <?php
                                                foreach ($get_hospitals as $rec) {
                                                    $selected = '';
                                                    if (in_array($rec->id, $usergrouphospital)) {
                                                        ?> <a href="profile.html">
                                                            <?php echo $rec->name; ?>
                                                        </a>
                                                    <?php }
                                                } ?>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon"
                                                 href="#"><i class="fa fa-pencil"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card tab-box">
        <div class="row user-tabs">
            <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="nav-item"><a href="#emp_projects" data-toggle="tab" class="nav-link">Projects</a></li>
                    <li class="nav-item"><a href="#bank_statutory" data-toggle="tab" class="nav-link">Bank & Statutory
                            <small class="text-danger">(Admin Only)</small></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <!-- Projects Tab -->
        <div class="tab-pane fade" id="emp_projects">
            <div class="row">
                <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown profile-action">
                                <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle"
                                   href="#"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i
                                                class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i
                                                class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>
                            <h4 class="project-title"><a href="project-view.html">Office Management</a></h4>
                            <small class="block text-ellipsis m-b-15">
                                <span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
                                <span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
                            </small>
                            <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. When an unknown printer took a galley of type and
                                scrambled it...
                            </p>
                            <div class="pro-deadline m-b-15">
                                <div class="sub-title">
                                    Deadline:
                                </div>
                                <div class="text-muted">
                                    17 Apr 2019
                                </div>
                            </div>
                            <div class="project-members m-b-15">
                                <div>Project Leader :</div>
                                <ul class="team-members">
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt=""
                                                                                                     src="assets/img/profiles/avatar-16.jpg"></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="project-members m-b-15">
                                <div>Team :</div>
                                <ul class="team-members">
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="John Doe"><img alt=""
                                                                                                src="assets/img/profiles/avatar-02.jpg"></a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="Richard Miles"><img alt=""
                                                                                                     src="assets/img/profiles/avatar-09.jpg"></a></a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="John Smith"><img alt=""
                                                                                                  src="assets/img/profiles/avatar-10.jpg"></a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt=""
                                                                                                    src="assets/img/profiles/avatar-05.jpg"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="all-users">+15</a>
                                    </li>
                                </ul>
                            </div>
                            <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                            <div class="progress progress-xs mb-0">
                                <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar"
                                     class="progress-bar bg-success" data-original-title="40%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown profile-action">
                                <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle"
                                   href="#"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i
                                                class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i
                                                class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>
                            <h4 class="project-title"><a href="project-view.html">Project Management</a></h4>
                            <small class="block text-ellipsis m-b-15">
                                <span class="text-xs">2</span> <span class="text-muted">open tasks, </span>
                                <span class="text-xs">5</span> <span class="text-muted">tasks completed</span>
                            </small>
                            <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. When an unknown printer took a galley of type and
                                scrambled it...
                            </p>
                            <div class="pro-deadline m-b-15">
                                <div class="sub-title">
                                    Deadline:
                                </div>
                                <div class="text-muted">
                                    17 Apr 2019
                                </div>
                            </div>
                            <div class="project-members m-b-15">
                                <div>Project Leader :</div>
                                <ul class="team-members">
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt=""
                                                                                                     src="assets/img/profiles/avatar-16.jpg"></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="project-members m-b-15">
                                <div>Team :</div>
                                <ul class="team-members">
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="John Doe"><img alt=""
                                                                                                src="assets/img/profiles/avatar-02.jpg"></a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="Richard Miles"><img alt=""
                                                                                                     src="assets/img/profiles/avatar-09.jpg"></a></a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="John Smith"><img alt=""
                                                                                                  src="assets/img/profiles/avatar-10.jpg"></a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt=""
                                                                                                    src="assets/img/profiles/avatar-05.jpg"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="all-users">+15</a>
                                    </li>
                                </ul>
                            </div>
                            <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                            <div class="progress progress-xs mb-0">
                                <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar"
                                     class="progress-bar bg-success" data-original-title="40%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown profile-action">
                                <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle"
                                   href="#"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i
                                                class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i
                                                class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>
                            <h4 class="project-title"><a href="project-view.html">Video Calling App</a></h4>
                            <small class="block text-ellipsis m-b-15">
                                <span class="text-xs">3</span> <span class="text-muted">open tasks, </span>
                                <span class="text-xs">3</span> <span class="text-muted">tasks completed</span>
                            </small>
                            <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. When an unknown printer took a galley of type and
                                scrambled it...
                            </p>
                            <div class="pro-deadline m-b-15">
                                <div class="sub-title">
                                    Deadline:
                                </div>
                                <div class="text-muted">
                                    17 Apr 2019
                                </div>
                            </div>
                            <div class="project-members m-b-15">
                                <div>Project Leader :</div>
                                <ul class="team-members">
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt=""
                                                                                                     src="assets/img/profiles/avatar-16.jpg"></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="project-members m-b-15">
                                <div>Team :</div>
                                <ul class="team-members">
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="John Doe"><img alt=""
                                                                                                src="assets/img/profiles/avatar-02.jpg"></a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="Richard Miles"><img alt=""
                                                                                                     src="assets/img/profiles/avatar-09.jpg"></a></a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="John Smith"><img alt=""
                                                                                                  src="assets/img/profiles/avatar-10.jpg"></a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt=""
                                                                                                    src="assets/img/profiles/avatar-05.jpg"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="all-users">+15</a>
                                    </li>
                                </ul>
                            </div>
                            <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                            <div class="progress progress-xs mb-0">
                                <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar"
                                     class="progress-bar bg-success" data-original-title="40%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown profile-action">
                                <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle"
                                   href="#"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i
                                                class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i
                                                class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>
                            <h4 class="project-title"><a href="project-view.html">Hospital Administration</a></h4>
                            <small class="block text-ellipsis m-b-15">
                                <span class="text-xs">12</span> <span class="text-muted">open tasks, </span>
                                <span class="text-xs">4</span> <span class="text-muted">tasks completed</span>
                            </small>
                            <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. When an unknown printer took a galley of type and
                                scrambled it...
                            </p>
                            <div class="pro-deadline m-b-15">
                                <div class="sub-title">
                                    Deadline:
                                </div>
                                <div class="text-muted">
                                    17 Apr 2019
                                </div>
                            </div>
                            <div class="project-members m-b-15">
                                <div>Project Leader :</div>
                                <ul class="team-members">
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt=""
                                                                                                     src="assets/img/profiles/avatar-16.jpg"></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="project-members m-b-15">
                                <div>Team :</div>
                                <ul class="team-members">
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="John Doe"><img alt=""
                                                                                                src="assets/img/profiles/avatar-02.jpg"></a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="Richard Miles"><img alt=""
                                                                                                     src="assets/img/profiles/avatar-09.jpg"></a></a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="John Smith"><img alt=""
                                                                                                  src="assets/img/profiles/avatar-10.jpg"></a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt=""
                                                                                                    src="assets/img/profiles/avatar-05.jpg"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="all-users">+15</a>
                                    </li>
                                </ul>
                            </div>
                            <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                            <div class="progress progress-xs mb-0">
                                <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar"
                                     class="progress-bar bg-success" data-original-title="40%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Projects Tab -->
        <!-- Bank Statutory Tab -->
        <div class="tab-pane fade" id="bank_statutory">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"> Basic Salary Information</h3>
                    <form>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Salary basis <span
                                                class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select salary basis type</option>
                                        <option>Hourly</option>
                                        <option>Daily</option>
                                        <option>Weekly</option>
                                        <option>Monthly</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Salary amount <small class="text-muted">per
                                            month</small></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Type your salary amount"
                                               value="0.00">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Payment type</label>
                                    <select class="select">
                                        <option>Select payment type</option>
                                        <option>Bank transfer</option>
                                        <option>Check</option>
                                        <option>Cash</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h3 class="card-title"> PF Information</h3>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">PF contribution</label>
                                    <select class="select">
                                        <option>Select PF contribution</option>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">PF No. <span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select PF contribution</option>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Employee PF rate</label>
                                    <select class="select">
                                        <option>Select PF contribution</option>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Additional rate <span
                                                class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select additional rate</option>
                                        <option>0%</option>
                                        <option>1%</option>
                                        <option>2%</option>
                                        <option>3%</option>
                                        <option>4%</option>
                                        <option>5%</option>
                                        <option>6%</option>
                                        <option>7%</option>
                                        <option>8%</option>
                                        <option>9%</option>
                                        <option>10%</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Total rate</label>
                                    <input type="text" class="form-control" placeholder="N/A" value="11%">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Employee PF rate</label>
                                    <select class="select">
                                        <option>Select PF contribution</option>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Additional rate <span
                                                class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select additional rate</option>
                                        <option>0%</option>
                                        <option>1%</option>
                                        <option>2%</option>
                                        <option>3%</option>
                                        <option>4%</option>
                                        <option>5%</option>
                                        <option>6%</option>
                                        <option>7%</option>
                                        <option>8%</option>
                                        <option>9%</option>
                                        <option>10%</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Total rate</label>
                                    <input type="text" class="form-control" placeholder="N/A" value="11%">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h3 class="card-title"> ESI Information</h3>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">ESI contribution</label>
                                    <select class="select">
                                        <option>Select ESI contribution</option>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">ESI No. <span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select ESI contribution</option>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Employee ESI rate</label>
                                    <select class="select">
                                        <option>Select ESI contribution</option>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Additional rate <span
                                                class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select additional rate</option>
                                        <option>0%</option>
                                        <option>1%</option>
                                        <option>2%</option>
                                        <option>3%</option>
                                        <option>4%</option>
                                        <option>5%</option>
                                        <option>6%</option>
                                        <option>7%</option>
                                        <option>8%</option>
                                        <option>9%</option>
                                        <option>10%</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Total rate</label>
                                    <input type="text" class="form-control" placeholder="N/A" value="11%">
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Bank Statutory Tab -->
    </div>
</div>
<!-- /Page Content -->
<!-- Profile Modal -->
<div id="profile_info" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Profile Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('', array('class' => 'form tg-formtheme tg-editform')); ?>
                <input type="hidden" name="typeinput" value="basic_info"/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-img-wrap edit-img">
                            <img class="inline-block" src="assets/img/profiles/avatar-02.jpg" alt="user">
                            <div class="fileupload btn">
                                <span class="btn-text">edit</span>
                                <input class="upload" type="file">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" class="form-control" name="first_name"
                                           value="<?php echo $user_details['first_name'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" class="form-control"
                                           value="<?php echo $user_details['last_name'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone No</label>
                                    <input class="form-control" name="phone" type="text"
                                           value="<?php echo $user_details['phone'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" value="<?php echo $user_details['email'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Company</label>
                            <input type="text" name="company" class="form-control"
                                   value="<?php echo $user_details['company'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" value="<?php echo $user_details['street_address'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Hospital</label>
                            <select class="select2" name="hos_id[]" id="multiselect" multiple="multiple">
                                <option value="">Choose Hospital</option>
                                <?php
                                foreach ($get_hospitals as $rec) {
                                    $selected = '';
                                    if (in_array($rec->id, $usergrouphospital)) {
                                        $selected = 'selected="selected"';
                                        break;
                                    }
                                    ?>
                                    <option value="<?php echo $rec->id ?>" <?php echo $selected; ?>><?php echo $rec->first_name; ?></option>
                                    <?php
                                } ?>
                            </select>
                        </div>
                    </div>

                </div>



                <div class="submit-section">
                    <button class="btn btn-primary submit-btn">Submit</button>
                </div>


                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- /Profile Modal -->
<!-- Personal Info Modal -->
<div id="personal_info_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Personal Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Passport No</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Passport Expiry Date</label>
                                <div class="cal-icon">
                                    <input class="form-control datetimepicker" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tel</label>
                                <input class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nationality <span class="text-danger">*</span></label>
                                <input class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Religion</label>
                                <div class="cal-icon">
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Marital status <span class="text-danger">*</span></label>
                                <select class="select form-control">
                                    <option>-</option>
                                    <option>Single</option>
                                    <option>Married</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Employment of spouse</label>
                                <input class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No. of children </label>
                                <input class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Personal Info Modal -->
<!-- Family Info Modal -->
<div id="family_info_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Family Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-scroll">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Family Member <a href="javascript:void(0);"
                                                                        class="delete-icon"><i
                                                class="fa fa-trash-o"></i></a></h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Relationship <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date of birth <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Education Information <a href="javascript:void(0);"
                                                                                class="delete-icon"><i
                                                class="fa fa-trash-o"></i></a></h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Relationship <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date of birth <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="add-more">
                                    <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Family Info Modal -->
<!-- Emergency Contact Modal -->
<div id="emergency_contact_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Personal Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Primary Contact</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Relationship <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone 2</label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Primary Contact</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Relationship <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone 2</label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Emergency Contact Modal -->
<!-- Education Modal -->
<div id="education_info" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Education Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-scroll">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Education Information <a href="javascript:void(0);"
                                                                                class="delete-icon"><i
                                                class="fa fa-trash-o"></i></a></h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-focus focused">
                                            <input type="text" value="Oxford University" class="form-control floating">
                                            <label class="focus-label">Institution</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus focused">
                                            <input type="text" value="Computer Science" class="form-control floating">
                                            <label class="focus-label">Subject</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus focused">
                                            <div class="cal-icon">
                                                <input type="text" value="01/06/2002"
                                                       class="form-control floating datetimepicker">
                                            </div>
                                            <label class="focus-label">Starting Date</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus focused">
                                            <div class="cal-icon">
                                                <input type="text" value="31/05/2006"
                                                       class="form-control floating datetimepicker">
                                            </div>
                                            <label class="focus-label">Complete Date</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus focused">
                                            <input type="text" value="BE Computer Science"
                                                   class="form-control floating">
                                            <label class="focus-label">Degree</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus focused">
                                            <input type="text" value="Grade A" class="form-control floating">
                                            <label class="focus-label">Grade</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Education Information <a href="javascript:void(0);"
                                                                                class="delete-icon"><i
                                                class="fa fa-trash-o"></i></a></h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-focus focused">
                                            <input type="text" value="Oxford University" class="form-control floating">
                                            <label class="focus-label">Institution</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus focused">
                                            <input type="text" value="Computer Science" class="form-control floating">
                                            <label class="focus-label">Subject</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus focused">
                                            <div class="cal-icon">
                                                <input type="text" value="01/06/2002"
                                                       class="form-control floating datetimepicker">
                                            </div>
                                            <label class="focus-label">Starting Date</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus focused">
                                            <div class="cal-icon">
                                                <input type="text" value="31/05/2006"
                                                       class="form-control floating datetimepicker">
                                            </div>
                                            <label class="focus-label">Complete Date</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus focused">
                                            <input type="text" value="BE Computer Science"
                                                   class="form-control floating">
                                            <label class="focus-label">Degree</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus focused">
                                            <input type="text" value="Grade A" class="form-control floating">
                                            <label class="focus-label">Grade</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="add-more">
                                    <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Education Modal -->
<!-- Experience Modal -->
<div id="experience_info" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Experience Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-scroll">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Experience Information <a href="javascript:void(0);"
                                                                                 class="delete-icon"><i
                                                class="fa fa-trash-o"></i></a></h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input type="text" class="form-control floating"
                                                   value="Digital Devlopment Inc">
                                            <label class="focus-label">Company Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input type="text" class="form-control floating" value="United States">
                                            <label class="focus-label">Location</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input type="text" class="form-control floating" value="Web Developer">
                                            <label class="focus-label">Job Position</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <div class="cal-icon">
                                                <input type="text" class="form-control floating datetimepicker"
                                                       value="01/07/2007">
                                            </div>
                                            <label class="focus-label">Period From</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <div class="cal-icon">
                                                <input type="text" class="form-control floating datetimepicker"
                                                       value="08/06/2018">
                                            </div>
                                            <label class="focus-label">Period To</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Experience Information <a href="javascript:void(0);"
                                                                                 class="delete-icon"><i
                                                class="fa fa-trash-o"></i></a></h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input type="text" class="form-control floating"
                                                   value="Digital Devlopment Inc">
                                            <label class="focus-label">Company Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input type="text" class="form-control floating" value="United States">
                                            <label class="focus-label">Location</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input type="text" class="form-control floating" value="Web Developer">
                                            <label class="focus-label">Job Position</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <div class="cal-icon">
                                                <input type="text" class="form-control floating datetimepicker"
                                                       value="01/07/2007">
                                            </div>
                                            <label class="focus-label">Period From</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <div class="cal-icon">
                                                <input type="text" class="form-control floating datetimepicker"
                                                       value="08/06/2018">
                                            </div>
                                            <label class="focus-label">Period To</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="add-more">
                                    <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Job Plan Modal -->
<div id="job_plan_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Job Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(site_url('/auth/edit_user/' . $user_id)); ?>
                <?php echo form_hidden('action', 'update_job_plan'); ?>
                <div class="form-group row">
                    <div class="col-md-1">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"
                                       name="uses_rcpath"<?php echo $job_plan->uses_rcpath ? 'checked' : ''; ?> /> Uses
                                RCPath Points
                            </label>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">PA</label>
                        <input class="form-control" type="number" name="pa" value="<?php echo $job_plan->pa; ?>"/>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Days Leave</label>
                        <input class="form-control" type="number" name="leave" value="<?php echo $job_plan->leave; ?>"/>
                    </div>
                </div>
                <div class="form-group row">`
                    <label class="col-form-label col-md-2">Work Schedule</label>
                    <!-- <div class="col-md-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="sun"<?php echo $job_plan->sun ? 'checked' : ''; ?> /> Sunday
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="mon"<?php echo $job_plan->mon ? 'checked' : ''; ?> /> Monday
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="tue"<?php echo $job_plan->tue ? 'checked' : ''; ?> /> Tuesday
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="wed"<?php echo $job_plan->wed ? 'checked' : ''; ?> /> Wednesday
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="thu"<?php echo $job_plan->thu ? 'checked' : ''; ?> /> Thursday
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="fri"<?php echo $job_plan->fri ? 'checked' : ''; ?> /> Friday
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="sat"<?php echo $job_plan->sat ? 'checked' : ''; ?> /> Saturday
                            </label>
                        </div>
                    </div> -->
                    <div id="calendar"></div>
                    <!-- <table class="table table-striped custom-table">
                        <thead>
                            <tr>
                                <th>Mon</th>
                                <th>Tue</th>
                                <th>Wed</th>
                                <th>Thu</th>
                                <th>Fri</th>
                                <th>Sat</th>
                                <th>Sun</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Do wordprss</td>
                                <td>Do allocator</td>
                                <td><span class="text-danger"> On Leave </span></td>
                                <td>Do the design</td>
                                <td>Fri</td>
                                <td>Holiday</td>
                                <td>Holiday</td>
                            </tr>
                            <tr>
                                <td>Do wordprss</td>
                                <td><span class="text-danger"> On Leave </span></td>
                                <td>Do allocator</td>
                                <td><span class="text-danger"> On Leave </span></td>
                                <td>Do the design</td>
                                <td>Holiday</td>
                                <td>Holiday</td>
                            </tr>
                            <tr>
                                <td><span class="text-danger"> On Leave </span></td>
                                <td>Do allocator</td>
                                <td>Do wordprss</td>
                                <td><span class="text-danger"> On Leave </span></td>
                                <td>Do the design</td>
                                <td>Holiday</td>
                                <td>Holiday</td>
                            </tr>
                        </tbody>
                    </table> -->
                </div>
                <div class="submit-section">
                    <button class="btn btn-primary submit-btn">Submit</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- /Job Plan Modal -->
<!-- Leave Modal -->
<div id="leave_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Apply For Leave</h5>
                <input type="hidden" id="min_date" value="01-01-<?php echo date("Y"); ?>"/>
                <input type="hidden" id="max_date" value="31-12-<?php echo date("Y"); ?>"/>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $attributes = array('id' => 'addLeaveTypeForm');
                echo form_open('', $attributes);
                ?>
                <input class="form-control" type="hidden" id="form_status" name="form_status">
                <input class="form-control" type="hidden" id="edit_id" name="edit_id">
                <div class="row">
                    <?php if (!empty($isMultiple)) { ?>
                        <div class="col-md-4 form-group">
                            <label>Hospital<span class="text-danger">*</span></label>
                            <select class="select" id="leave_hospital" name="leave_hospital">
                                <option>Select Hospital</option>
                                <?php foreach ($userHospitals as $userHospital) { ?>
                                    <option value="<?php echo $userHospital->id; ?>"><?php echo $userHospital->hospital_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } else { ?>
                        <input class="form-control" type="hidden" id="leave_hospital" name="leave_hospital"
                               value="<?php echo $usersLeaves[0]->hospital_id; ?>">
                    <?php } ?>
                    <div class="col-md-4 form-group">
                        <label>Leave<span class="text-danger">*</span></label>
                        <select class="select" id="leave_code" name="leave_code">
                            <option>Select Leave</option>
                            <?php if (empty($isMultiple)) {
                                foreach ($usersLeaves as $leaves) { ?>
                                    <option value="<?php echo $leaves->id; ?>"><?php echo $leaves->name; ?></option>
                                <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Start End Date</label>
                        <input class="form-control datepicker range2Picker" type="text" name="start_end_date"
                               id="start_end_date" readonly/>
                    </div>
                    <!--                    <div class="col-md-4">-->
                    <!--                        <label class="form-label">To</label>-->
                    <!--                        <input class="form-control datepicker" type="text" name="end_date" id="end_date"/>-->
                    <!--                    </div>-->
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Notes <span class="text-danger">*</span></label>
                        <textarea rows="4" class="form-control" id="leave_remarks" name="leave_remarks"></textarea>
                    </div>
                </div>
                <button class="btn btn-primary btn-rounded submit-btn">Submit</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Job Plan Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped custom-modal">
                    <thead>
                    <tr>
                        <th>Session Name</th>
                        <th>Time</th>
                        <th>Category</th>
                        <th>PA</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Do the wordpress</td>
                        <td>04:35 PM</td>
                        <td>Development</td>
                        <td>20.0</td>
                    </tr>
                    <tr>
                        <td>Do the wordpress</td>
                        <td>04:35 PM</td>
                        <td>Development</td>
                        <td>20.0</td>
                    </tr>
                    <tr>
                        <td>Do the wordpress</td>
                        <td>04:35 PM</td>
                        <td>Development</td>
                        <td>20.0</td>
                    </tr>
                    <tr>
                        <td>Do the wordpress</td>
                        <td>04:35 PM</td>
                        <td>Development</td>
                        <td>20.0</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- /Leave Modal -->

<div id="add-secretary-modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Secretary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush " id="available-secretary-list">
                    <template id="secretary-list-template">
                        <li class="list-group-item">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input add-secretary-check-button">
                                <label class="custom-control-label">
                                <span class="user-img">
                                    <img src="" alt="">
                                 </span>
                                    <span class="secretary_name">
                                    
                                </span>
                                    <span class="working_for">

                                </span>
                                </label>
                            </div>
                        </li>
                    </template>
                </ul>
                <div class="form-group">
                    <button class="btn btn-success assign-secretary-btn float-right">Assign</button>
                </div>
                <h3 id="no_secretary">No available Secretary</h3>
            </div>
        </div>
    </div>
</div>

<script>
    let user_id = `<?php echo $user_id;?>`;

    function toggleSpecialty(id, userid) {
        //toggle
        console.log(id, userid);
        let data = {
            id: id,
            user_id: userid
        };

        if ($('#specialty-' + id).is(":checked")) {
            data.action = 'add_specialty';
        } else {
            data.action = 'remove_specialty';
        }

        $.ajax({
            url: '<?php echo site_url('/auth/toggle_specialty');?>/' + userid,
            data: data
        }).done(function (data) {
            console.log(data);
        });
    }

</script>


<script type="text/javascript">
    $(document).ready(function () {
        $(".list_view_btn").click(function () {
            $(".list_view_btn").hide();
            $(".thumb_view_btn").show();
            $(".thumb_view").hide();
            $(".list_view").show();

        });
        $(".thumb_view_btn").click(function () {
            $(".thumb_view_btn").hide();
            $(".list_view_btn").show();
            $(".thumb_view").show();
            $(".list_view").hide();

        });

        var readURL = function (input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.profile-pic').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        };


        $(".file-upload").on('change', function (e) {
            e.preventDefault();
            readURL(this);
        });

        $(document).ready(function () {
            getDepartment_list('<?php echo $user_details['division_id']?>');
            department_spe('<?php echo $user_details['department_id']?>');
            getcategory('<?php echo $user_details['speciality_id']?>');

            $('#edit_profile_picture').on('submit', function (e) {
                e.preventDefault();
                if ($('#txt_profile_pic').val() == '') {
                    alert("Please Select Picture to update");
                } else {
                    $.ajax({
                        url: "<?php echo base_url('/index.php/Auth/edit_profile_picture'); ?>",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        success: function (data) {
//                            console.log(res); return false;
                            if (data.type === 'error') {
                                alert(data.msg);
                            } else {
                                alert(data.msg);
                            }
                            setTimeout(function () {
                                window.location.reload();
                            }, 3000);
                        }
                    });
                }
            });
        });
        $(".profile_edit").on('change', function () {
            readURL(this);
//            use AJAX here to update image path in database
        });

        $(".upload-pic").on('click', function () {
            $(".file-upload").click();
        });
    });

    $(".toggle_value").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    const base_url = '<?php echo base_url();?>';

    function pswderr() {
        var pswd1 = document.getElementById("pass").value;
        var pswd2 = document.getElementById("re_pass").value;
        let regex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@$!%*?&])[A-Za-z\\d@$!%*?&]{8,}$");
        document.getElementById("pass_error").innerHTML = "";
        document.getElementById("re_pass_error").innerHTML = "";

        if (pswd1 !== "" && !(regex.test(pswd1))) {
            document.getElementById("pass_error").innerHTML = "Password must be alpha numerical with at least one special character";
            return false;
        }
        if (pswd2 !== "" && !(regex.test(pswd2))) {
            document.getElementById("re_pass_error").innerHTML = "Password must be alpha numerical with at least one special character";
            return false;
        }

        if (pswd1 !== pswd2) {
            document.getElementById("re_pass_error").innerHTML = "Password not matched with confirm password";
            return false;
        } else {
            document.getElementById("re_pass_error").innerHTML = "";
            return true;
        }
    }

    // $("body").on('click', '.view_password', function () {
    //     $(this).children().toggleClass("fa-eye fa-eye-slash");
    //     if ($(".show_pass").attr("type") === "password") {
    //         $(".show_pass").attr("type", "text");
    //     } else {
    //         $(".show_pass").attr("type", "password");
    //     }
    //
    // });

  

    var division_id='';
var department_id='';
function getDepartment_list(divisionid){
  division_id = divisionid;
  setTimeout(function () {
    $.get(_base_url + 'institute/get_active_department?type=' + division_id, function (data) {
     var html='<option value="">Select Department</option>';
     for (let i = 0; i < data.length; i++) {
      if(data[i]['id']==division_id){
        let departLen = data[i]['department'];
        let d_id = '<?php echo $user_details['department_id']?>';
        let dslt = '';
        for (var key in departLen){
            if(departLen[key]['d_id'] == d_id){
                dslt = 'selected';
            }else{
                dslt = '';
            }
            var value = departLen[key];
            html+=`<option value="`+departLen[key]['d_id']+`" `+dslt+`>`+departLen[key]['name']+`</option>`;
        }       
      }
      
     } 
     $('#devision_department_list').html(html);
     $('#speciality_list').html('<option value="">Select Speciality</option>');
     $('#cat_department_list').html('<option value="">Select Category</option>');
    });
  }, 500);
}

function department_spe(departmentid){
  department_id = departmentid;
  setTimeout(function () {
    $.get(_base_url + 'institute/get_active_department?type=' + division_id, function (data) {
     var html='<option value="">Select Department</option>';
     for (let i = 0; i < data.length; i++) {
      if(data[i]['id']==division_id){
        let departLen = data[i]['department'];

        for (var key in departLen){
          if(key == department_id){
          let speciality = departLen[key]['specialties'];
          
            let sid = '<?php echo $user_details['speciality_id']?>';
             let ssld = '';
            for (var k1 in speciality){
                if(speciality[k1]['s_id'] == sid){
                ssld = 'selected';
            }else{
                ssld = '';
            }
              html+=`<option value="`+speciality[k1]['s_id']+`" `+ssld+`>`+speciality[k1]['name']+`</option>`;
            }
          }
            
            
        }       
      }
      
     } 
     $('#speciality_list').html(html);
     $('#cat_department_list').html('<option value="">Select Category</option>');
    });
  }, 500);

}

function getcategory(specialityid){
 setTimeout(function () {
    $.get(_base_url + 'institute/get_active_department?type=' + division_id, function (data) {
     var html='<option value="">Select Department</option>';
     for (let i = 0; i < data.length; i++) {
      if(data[i]['id']==division_id){
        let departLen = data[i]['department'];

        for (var key in departLen){
          if(key == department_id){
          let speciality = departLen[key]['specialties'];
            for (var k1 in speciality){
               let cid = '<?php echo $user_details['category_id']?>';
             let ccid = '';
              let category =speciality[k1]['categories'];
              for (var k2 in category){
                if(category[k2]['category_id'] == cid){
                    ccid = 'selected';
                }else{
                    ccid = '';
                }
                html+=`<option value="`+category[k2]['category_id']+`" `+ccid+`>`+category[k2]['name']+`</option>`;
              }
              
            }
            
          }
        }       
      }
      
     } 
     $('#cat_department_list').html(html);
    });
  }, 500);

  
}
</script>