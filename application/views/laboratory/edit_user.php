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
<div class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="tg-dashboardbox">
                <div class="tg-dashboardboxtitle">
                    <h2>Edit User</h2>
                </div>
                <input type="hidden" id="base_url_value" value="<?php echo base_url(); ?>">
                <input type="hidden" id="csrf_token_name" value="<?php echo $this->security->get_csrf_token_name(); ?>">
                <input type="hidden" id="csrf_token_hash" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <input type="hidden" id="user_id" value="<?php echo $user_id; ?>">
                <input type="hidden" name="pre_email" class="form-control" value="<?php echo $user_details['email']; ?>">
                <div class="tg-editformholder">
                    <div id="infoMessage"><?php echo $message; ?></div>
                    <?php echo form_open_multipart("laboratory/edit_user/$user_id", array('class' => 'tg-formtheme tg-editform create_user_form','id' => 'edit_user_form')); ?>

                    <input type="hidden" id="password_status" value="0">
                    <div class="card mb-4">
                        <div class="card-body">
                            <!-- Profile Picture Input -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="profile-img-wrap edit-img">
                                        <?php
                                            $profile_pic = (!empty($user_details['profile_image_path'])) ? base_url($user_details['profile_image_path']) : base_url('assets/newtheme/img/profiles/avatar-02.jpg');
                                            /*if(!file_exists($profile_pic)){
                                                $img = base_url('assets/newtheme/img/profiles/avatar-02.jpg');
                                            }else{
                                                $img = $profile_pic;
                                            }*/
                                        ?>
                                        <img class="inline-block" id="profile-pic-preview"
                                             src="<?= $profile_pic; ?>"
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
                                            <?php echo form_input(array('type' => 'text', 'name' => 'first_name', 'id' => 'first_name', 'value' => (isset($user_details['first_name']) ? $user_details['first_name'] : ''), 'class' => 'form-control', 'placeholder' => 'First Name')); ?>
                                            <span class="text-danger"><?php echo form_error('first_name'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-user"></i>
                                            <label>Last Name</label>
                                            <?php echo form_input(array('type' => 'text', 'name' => 'last_name', 'id' => 'last_name', 'value' => (isset($user_details['last_name']) ? $user_details['last_name'] : ''), 'class' => 'form-control', 'placeholder' => 'Last Name')); ?>
                                            <span class="text-danger"><?php echo form_error('last_name'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-apartment"></i>
                                            <label>Company Name</label>
                                            <?php echo form_input(array('type' => 'text', 'name' => 'company', 'id' => 'company', 'value' => (isset($user_details['company']) ? $user_details['company'] : ''), 'class' => 'form-control', 'placeholder' => 'Company Name')); ?>
                                            <span class="text-danger"><?php echo form_error('company'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-phone-handset"></i>
                                            <label>Phone</label>
                                            <?php echo form_input(array('type' => 'text', 'name' => 'phone', 'id' => 'phone', 'value' => (isset($user_details['phone']) ? $user_details['phone'] : ''), 'class' => 'form-control', 'placeholder' => 'Phone')); ?>
                                            <span class="text-danger"><?php echo form_error('phone'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group tg-inputwithicon">
                                    <i class="lnr lnr-envelope"></i>
                                    <label>Email</label>
                                    <?php echo form_input(array('type' => 'text', 'name' => 'email', 'id' => 'email', 'value' => (isset($user_details['email']) ? $user_details['email'] : ''), 'class' => 'form-control check_email2', 'placeholder' => 'Email')); ?>
                                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                                    <span id="email_span" style="display: none;color: red"></span>
                                </div>
                                <input type="hidden" name="password_status" id="password_status" value="0"/>

                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group tg-inputwithicon">
                                            <label>User Role</label>
                                            <input type="hidden" name="existing_user_role" value="<?= $user_details['user_role_id']; ?>" id="user_role_id" />
                                            <input type="hidden" value="<?= $user_details['user_role_name']; ?>" id="role_name" />
                                            <select class="form-control" name="user_role" id="user_role_lab">
                                                <option value="">Select Role</option>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('user_role'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group tg-inputwithicon">
                                            <label>Clinic</label>
                                            <select class="form-control" name="clinic_id" id="clinic_id">
                                                <option value="">Select Clinic</option>
                                                <?php foreach ($clinicArr as $clinic) { ?>
                                                    <option value="<?= $clinic->id; ?>" <?= ($clinic->id == $user_details['clinic_id']) ? 'selected' : ''; ?>><?= $clinic->description; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('clinic_id'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-user"></i>
                                            <label>Fee / Case</label>
                                            <?php echo form_input(array('type' => 'text', 'name' => 'fee_per_case', 'id' => 'fee_per_case', 'value' => (isset($user_details['fee_per_case']) ? $user_details['fee_per_case'] : ''), 'class' => 'form-control', 'placeholder' => 'Enter fee per case')); ?>
                                            <span class="text-danger"><?php echo form_error('fee_per_case'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-user"></i>
                                            <label>Fee / Specimen</label>
                                            <?php echo form_input(array('type' => 'text', 'name' => 'fee_per_specimen', 'id' => 'fee_per_specimen', 'value' => (isset($user_details['fee_per_specimen']) ? $user_details['fee_per_specimen'] : ''), 'class' => 'form-control', 'placeholder' => 'Enter fee per specimen')); ?>
                                            <span class="text-danger"><?php echo form_error('fee_per_specimen'); ?></span>
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
                                            <?php echo form_input(array('type' => 'password', 'name' => 'memorable', 'id' => 'memorable', 'value' => (isset($user_details['memorable']) ? $user_details['memorable'] : ''), 'class' => 'form-control', 'placeholder' => 'Memorable', 'maxlength' => 10, 'size' => 10)); ?>
                                            <span class="text-danger"><?php echo form_error('memorable'); ?></span>
                                            <span toggle="#memorable" class="fa fa-fw fa-eye field-icon toggle_value"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-apartment"></i>
                                            <label>Login Token</label>
                                            <?php echo form_input(array('type' => 'number', 'name' => 'token', 'value' => (isset($user_details['token']) ? $user_details['token'] : ''), 'class' => 'form-control', 'placeholder' => 'Login Token', 'maxlength' => 4)); ?>
                                            <span class="text-danger"><?php echo form_error('token'); ?></span>
                                        </div>
                                    </div>

                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-7 col-md-offset-6">
                                        <button type="submit" id="user-create-btn" class="btn add-btn mt-5"><i class="fa fa-plus"></i> Update User</button>
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

<script type="text/javascript">
    $(document).ready(function () {
        let roleID = $('#user_role_id').val();
        setTimeout(function (){
            $('#user_role_lab option').removeAttr('selected').filter('[value="'+ roleID +'"]').attr('selected', true).parents('select').trigger('change');
        }, 1000);
    });
</script>