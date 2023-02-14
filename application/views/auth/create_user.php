<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="tg-dashboardbox">
                <div class="tg-dashboardboxtitle">
                    <h2>Create New User</h2>
                    <span>Please enter the users information below.</span>
                </div>
                <div class="tg-editformholder">
                    <div id="infoMessage"><?php echo $message; ?></div>
                    <?php echo form_open("auth/create_user", array('class' => 'tg-formtheme tg-editform create_user_form')); ?>
                    <div class="tg-groupschecks">
                        <div class="tg-title">
                            <h4>Select Group</h4>
                        </div>
                        <?php if ($this->ion_auth->is_admin()): ?>
                        <div class="tg-formradiohold">
                            <div class="tg-radio">
                                <input id="tg-admin" type="radio" name="user_groups" data-groupinitial="<?php echo html_purify(getAllUsersGroups('A')[0]['group_type']); ?>" value="<?php echo intval(getAllUsersGroups('A')[0]['id']); ?>">
                                <label for="tg-admin">Admin</label>
                            </div>
                            <div class="tg-radio">
                                <input id="tg-doctor" type="radio" name="user_groups" data-groupinitial="<?php echo html_purify(getAllUsersGroups('D')[0]['group_type']); ?>" value="<?php echo intval(getAllUsersGroups('D')[0]['id']); ?>">
                                <label for="tg-doctor">Doctor</label>

                            </div>
                            <div class="tg-radio">
                                <input id="tg-hospital" type="radio" class="tg-open-hospital-list" name="user_groups" value="H">
                                <label for="tg-hospital">Hospital</label>
                            </div>
                            <div class="tg-radio">
                                <input id="tg-secretary" type="radio" name="user_groups" data-groupinitial="<?php echo html_purify(getAllUsersGroups('S')[0]['group_type']); ?>" value="<?php echo intval(getAllUsersGroups('S')[0]['id']); ?>">
                                <label for="tg-secretary">Secretary</label>
                            </div>
                           <div class="tg-radio">
                                <input id="tg-laboratory" type="radio" class="tg-open-laboratory-list" name="user_groups" value="L">
                                <label for="tg-laboratory">Laboratory</label>
                            </div>
                            <div class="tg-radio">
                                <input id="tg-surgeon" class="surgeon_and_clinician" type="radio" name="user_groups" data-groupinitial="<?php echo !empty(getAllUsersGroups('G')[0]['group_type']) ? getAllUsersGroups('G')[0]['group_type'] : ''; ?>" value="<?php echo !empty(getAllUsersGroups('G')[0]['group_type']) ? intval(getAllUsersGroups('G')[0]['id']) : ''; ?>">
                                <label for="tg-surgeon">Dermatological Surgeon</label>
                            </div>
                            <div class="tg-radio">
                                <input id="tg-clinician" class="surgeon_and_clinician" type="radio" name="user_groups" data-groupinitial="<?php echo !empty(getAllUsersGroups('G')[0]['group_type']) ? getAllUsersGroups('C')[0]['group_type'] : ''; ?>" value="<?php echo !empty(getAllUsersGroups('C')[0]['group_type']) ? intval(getAllUsersGroups('C')[0]['id']) : ''; ?>">
                                <label for="tg-clinician">Clinician</label>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="tg-groupschecks hide_content open-hospital-group-list">
                        <div class="tg-title">
                            <h4>Select Hospital Group</h4>
                        </div>
                        <div class="tg-formradiohold">
                            <?php
                            $user_groups = getAllUsersGroups();
                            //echo last_query();
                            if (!empty($user_groups)) {
                                foreach ($user_groups as $ugkey => $ugval) {
                                    ?>
                                    <div class="tg-radio">
                                        <input id="tg-<?php echo strtolower(str_replace(" ", "", html_purify($ugval['name']))); ?>" type="radio" name="hospital_list" value="<?php echo intval($ugval['id']); ?>">
                                        <label for="tg-<?php echo strtolower(str_replace(" ", "", html_purify($ugval['name']))); ?>"><?php echo html_purify($ugval['description']); ?></label>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="tg-groupschecks hide_content open-laboratory-group-list">
                        <div class="tg-title">
                            <h4>Select Laboratory Group</h4>
                        </div>
                        <div class="tg-formradiohold">
                            <?php
                            $user_groups = getAllUsersGroups('L');
                            if (!empty($user_groups)) {
                                foreach ($user_groups as $ugkey => $ugval) {
                                    ?>
                                    <div class="tg-radio">
                                        <input id="tg-<?php echo strtolower(str_replace(" ", "", html_purify($ugval['name']))); ?>" type="radio" name="laboratory_list" value="<?php echo intval($ugval['id']); ?>">
                                        <label for="tg-<?php echo strtolower(str_replace(" ", "", html_purify($ugval['name']))); ?>"><?php echo html_purify($ugval['description']); ?></label>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <input type="hidden" name="user_group_type" value="">
                    <fieldset>
                        <div class="form-group tg-inputwithicon">
                            <i class="lnr lnr-user"></i>
                            <?php echo form_input(array('type' => 'text', 'name' => 'first_name', 'id' => 'first_name', 'value' => '', 'class' => 'form-control', 'placeholder' => 'First Name')); ?>
                        </div>
                        <div class="form-group tg-inputwithicon">
                            <i class="lnr lnr-user"></i>
                            <?php echo form_input(array('type' => 'text', 'name' => 'last_name', 'id' => 'last_name', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Last Name')); ?>
                        </div>
                        <div class="form-group tg-inputwithicon">
                            <i class="lnr lnr-apartment"></i>
                            <?php echo form_input(array('type' => 'text', 'name' => 'company', 'id' => 'company', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Company Name')); ?>
                        </div>
                        <div class="form-group tg-inputwithicon">
                            <i class="lnr lnr-phone-handset"></i>
                            <?php echo form_input(array('type' => 'text', 'name' => 'phone', 'id' => 'phone', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Phone')); ?>
                        </div>
                        <div class="form-group tg-inputwithicon">
                            <i class="lnr lnr-lock"></i>
                            <?php echo form_input(array('type' => 'password', 'name' => 'password', 'id' => 'password', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Password')); ?>
                        </div>
                        <div class="form-group tg-inputwithicon">
                            <i class="lnr lnr-lock"></i>
                            <?php echo form_input(array('type' => 'password', 'name' => 'password_confirm', 'id' => 'password_confirm', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Retype Password')); ?>
                        </div>
                        <div class="form-group tg-inputwithicon">
                            <i class="lnr lnr-envelope"></i>
                            <?php echo form_input(array('type' => 'text', 'name' => 'email', 'id' => 'email', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Email')); ?>
                        </div>
                        <div class="form-group tg-inputwithicon">
                            <i class="lnr lnr-apartment"></i>
                            <?php echo form_input(array('type' => 'text', 'name' => 'memorable', 'id' => 'memorable', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Memorable', 'maxlength' => 10, 'size' => 10)); ?>
                        </div>
                        <div class="form-group tg-inputwithicon surgeon_and_clinician_hospitals">
                            <?php if (!empty($hospital_groups)) { ?>
                                <select name="hospital_group" class="form-control">
                                    <option value="">Choose Hospital</option>
                                    <?php foreach ($hospital_groups as $key => $value) { ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['description']; ?></option>
                                    <?php } ?>
                                </select>
                            <?php } ?>
                        </div>
                        <div class="form-group tg-inputwithicon surgeon_clinician_group">
                            <label>Both Surgeon & Clinician</label>
                            <input type="checkbox" name="surgeon_clinician_group" value="GC">
                        </div>
                    </fieldset>
                    <div class="tg-uploadimgbars">
                        <div class="tg-title">
                            <h4>Upload Profile Photo</h4>
                            <label for="tg-uploadfiletwo">
                                <a id="profile_image_uplaod"><i class="fa fa-link"></i>Attach File</a>
                            </label>
                            <div id="plupload-profile-container"></div>
                        </div>
                        <ul class="tg-attachmentdetails profile-img-wrap"></ul>
                    </div>
                    <div class="tg-btnarea">
                        <input type="hidden" name="profile_image_name" id="profile_image_name" value="">
                        <input type="hidden" name="profile_image_path" id="profile_image_path" value="">
                        <button type="button" class="tg-btn create_user_btn">Create User</button>
                        <?php  echo form_submit('submit', 'Create User', "class='tg-btn'"); ?>
                    </div>
                    <?php echo form_close(); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>