<style>
    .view_password {
        position: absolute;
        top: 42px;
        right: 30px;
        cursor: pointer;
    }

    .custom-error::after, .custom-success::after {
        top: 42px !important;
    }


    .field-icon {
        position: absolute;
        top: 42px;
        right: 30px;
        cursor: pointer;
    }
</style>
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
<div class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="tg-dashboardbox">
                <div class="tg-dashboardboxtitle">
                    <h2>Create New User</h2>
                </div>
                <input type="hidden" id="base_url_value" value="<?php echo base_url(); ?>">
                <input type="hidden" id="csrf_token_name" value="<?php echo $this->security->get_csrf_token_name(); ?>">
                <input type="hidden" id="csrf_token_hash" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <input type="hidden" id="user_group_id" value="<?php echo $user_group_id; ?>">
                <input type="hidden" id="admin_type" value="<?php echo (!$this->ion_auth->in_group('admin')?"no":"yes"); ?>">
                <div class="tg-editformholder">
                    <div id="infoMessage"><?php echo $message; ?></div>
                    <?php echo form_open_multipart(($cgroup_id && $cgroup_id != '') ? "laboratory/create_user/".base64_encode($cgroup_id)."/".$hsa : "laboratory/create_user", array('class' => 'tg-formtheme tg-editform create_user_form','id' => 'create_user_form')); ?>

                    <input type="hidden" id="password_status" value="0">
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
                                            <span class="btn-text">edit</span>
                                            <input class="upload" type="file" id="profile-pic" name="profile_pic"
                                                   accept="image/*"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- User Personal Information START -->
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-user"></i>
                                            <label>First Name</label>
                                            <?php echo form_input(array('type' => 'text', 'name' => 'first_name', 'id' => 'first_name', 'value' => set_value('first_name'), 'class' => 'form-control', 'placeholder' => 'First Name')); ?>
                                            <span class="text-danger"><?php echo form_error('first_name'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-user"></i>
                                            <label>Last Name</label>
                                            <?php echo form_input(array('type' => 'text', 'name' => 'last_name', 'id' => 'last_name', 'value' => set_value('last_name'), 'class' => 'form-control', 'placeholder' => 'Last Name')); ?>
                                            <span class="text-danger"><?php echo form_error('last_name'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-apartment"></i>
                                            <label>Organization Name</label>
                                            <?php echo form_input(array('type' => 'text', 'name' => 'company', 'id' => 'company', 'value' => set_value('company'), 'class' => 'form-control', 'placeholder' => 'Organization Name')); ?>
                                            <span class="text-danger"><?php echo form_error('company'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-phone-handset"></i>
                                            <label>Phone</label>
                                            <?php echo form_input(array('type' => 'text', 'name' => 'phone', 'id' => 'phone', 'value' => set_value('phone'), 'class' => 'form-control', 'placeholder' => 'Phone')); ?>
                                            <span class="text-danger"><?php echo form_error('phone'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-envelope"></i>
                                            <label>Email</label>
                                            <?php echo form_input(array('type' => 'text', 'name' => 'email', 'id' => 'email', 'value' => '', 'class' => 'form-control check_email2 email_check', 'placeholder' => 'Email')); ?>
                                            <span class="text-danger"><?php echo form_error('email'); ?></span>
                                            <span id="email_span" style="display: none;color: red"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-envelope"></i>
                                            <label>Confirm Email</label>
                                            <?php echo form_input(array('type' => 'text', 'name' => 'email_confirm', 'id' => 'email_confirm', 'value' => '', 'class' => 'form-control email_check', 'placeholder' => 'Confirm email')); ?>
                                            <span class="text-danger"><?php echo form_error('email_confirm'); ?></span>
                                            <span id="email_confirm_span" style="display: none;color: red">Email not matched</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group tg-inputwithicon">
                                    <i class="lnr lnr-envelope"></i>
                                    <label>Email</label>
                                    <?php echo form_input(array('type' => 'text', 'name' => 'email', 'id' => 'email', 'value' => set_value('email'), 'class' => 'form-control check_email2', 'placeholder' => 'Email')); ?>
                                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                                    <span id="email_span" style="display: none;color: red"></span>
                                </div> -->
                                <input type="hidden" name="password_status" id="password_status" value="0"/>
                                <input type="hidden" name="email_status" id="email_status" value="0"/>


                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <label>User Role</label>
                                            <select class="form-control" name="user_role" id="user_role_lab">
                                                <option value="">Select Role</option>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('user_role'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <label id="roleWrap">Clinic</label>
                                            <select class="form-control" name="clinic_id" id="clinic_id" style="pointer-events : <?php echo ($userType && $userType == 'H') ? "none" : ""; ?>">
                                                <option value="">Select Clinic</option>
                                                <?php foreach ($clinicArr as $clinic) { ?>
                                                    <option value="<?= $clinic->id; ?>" <?php echo (($cgroup_id && $cgroup_id != '' && $cgroup_id == $clinic->id) || ($clinichId && $clinichId != '' && $clinichId == $clinic->id)) ? "selected" : ""; ?>><?= $clinic->description; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('clinic_id'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 user_sub_role" style="display: none">
                                        <div class="form-group tg-inputwithicon">
                                            <label>Sub Role</label>
                                            <select class="form-control" name="user_sub_role" id="user_sub_role">
                                                <option value="">Select Sub Role</option>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('user_sub_role'); ?></span>
                                        </div>
                                    </div>

                                    <!--<div class="col-md-6">
                                        <div class="form-group tg-inputwithicon" id="hospital">
                                            <label>Select Group</label>
                                            <select class="select2 form-control" id="Hgroup_id" name="Hgroup_id[]" multiple>
                                                <option value="">Select Group</option>
                                            </select>
                                            <span class="text-danger"><?php /*echo form_error('user_role'); */?></span>
                                        </div>
                                    </div>-->
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-lock"></i>
                                            <label>Password</label>
                                            <?php echo form_input(array('type' => 'password', 'name' => 'password', 'id' => 'password', 'value' => '', 'class' => 'form-control show_pass pr-password check_password', 'placeholder' => 'Password')); ?>
                                            <span class="text-danger"><?php echo form_error('password'); ?></span>
                                            <span id="pass_span" style="display: none;color: red"></span>
                                            <div class="view_password"><i class="fa fa-eye"></i></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-lock"></i>
                                            <label>Confirm Password</label>
                                            <?php echo form_input(array('type' => 'password', 'name' => 'password_confirm', 'id' => 'password_confirm', 'value' => '', 'class' => 'form-control show_pass check_password', 'placeholder' => 'Retype Password')); ?>
                                            <span class="text-danger"><?php echo form_error('password_confirm'); ?></span>
                                            <span id="confirm_span" style="display: none;color: red">Password not matched</span>
                                            <div class="view_password"><i class="fa fa-eye"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-apartment"></i>
                                            <label>Memorable</label>
                                            <?php echo form_input(array('type' => 'password', 'name' => 'memorable', 'id' => 'memorable', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Memorable', 'maxlength' => 10, 'size' => 10)); ?>
                                            <span class="text-danger"><?php echo form_error('memorable'); ?></span>
                                            <span toggle="#memorable" class="fa fa-fw fa-eye field-icon toggle_value"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7 col-md-offset-6">
                                        <button type="submit" id="user-create-btn" class="btn add-btn mt-5"> Add User</button>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <?php echo form_close(); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function show_comp(ids) {
        alert(ids);
    }
</script>