<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>

</style>
<?php 

$user_id = $this->uri->segment(3);

$group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
$group_type = $this->Ion_auth_model->get_group_type($group_id);

//Include Forms File
require_once('application/views/auth/user_forms/user-forms.php');
?>
<div class="tg-dbsectionspace tg-haslayout">
    <div class="row">
    <div class="col-12 col-sm-12 col-md-4 col-lg-3">
        <div class="tg-userinfo-holder" data-userinitial="<?php echo getInitialsFromName($user_id); ?>">
            <div class="tg-user-img">
                <?php if (!empty($profile_image_name['value']) && !empty($profile_image_path['value'])) { ?>
                    <img src="<?php echo base_url() .'uploads/'. $profile_image_name['value']; ?>" alt="<?php echo html_purify($profile_image_name['value']); ?>">
                     <?php } else { ?>
                    <h2><?php echo getInitialsFromName(intval($user_id)); ?></h2>
                <?php } ?>
            </div>
            
            <div class="tg-userinfo-content">
                <div class="tg-user-title">
                    <h3><?php echo $first_name['value'] ." ".$last_name['value']; //echo uralensisGetUsername(intval($user_id), 'fullname'); ?></h3>
                    <a href="javascript:;"><?php echo html_purify($email['value']); //html_purify(getUserMetaDetail($user_id, 'email', 'users')[0]['email']); echo last_query();exit; ?></a>
                    <span>Member Since: <?php echo date('F d , Y', getUserMetaDetail($user_id, 'created_on', 'users')[0]['created_on']); ?></span>
                </div>
                <div class="tg-userinfo-nav">
                    <?php if ($this->ion_auth->users()->row()->id !== $user_id) { ?>
                    <a href="javascript:;" class="btn btn-primary login-as-admin" data-userid="<?php echo intval($user_id); ?>">Login As Admin</a>
                    <hr/>
                    <?php if($getCheckPin > 0){
                        
                    ?>
                     <a href="<?php echo base_url();?>index.php/auth/downloadpins/<?php echo $myuseremail;?>" target="_blank" class="btn btn-primary downloads" >Downloads Pins</a>

                    <?php }else{?>
                    <a href="javascript:;" class="btn btn-primary generate-pin" data-userid="<?php echo intval($user_id); ?>">Generate Pins</a>

                    <?php }} ?>
                    <?php
                        //Check Total Login attempts
                        $max_attemps_exceeded = $this->ion_auth->is_max_login_attempts_exceeded($user->email);
                        if (!empty($max_attemps_exceeded) && $max_attemps_exceeded !== 0) {
                            echo '<button class="btn btn-primary unlock_account pull-right" data-useremail="' . html_purify($user->email) . '">Unlock Account</button>';
                        }
                        ?>
                    <ul>
                        <?php 
                        if ($group_type[0]->group_type === 'D') {
                        ?>
                        <li>
                            <a href="javascript:;">Practice Assigned To:<em><?php echo getHospitalAssignedToDoctorCount(intval($user_id)); ?> Hospitals</em></a>
                        </li>
                        <li>
                            <a href="javascript:;">Cases Reported:<em><?php uralensis_get_doctor_publish_records_count('reported', intval($user_id)); ?></em></a>
                        </li>
                        <li>
                            <a href="javascript:;">Unauthourised Cases:<em><?php uralensis_get_doctor_publish_records_count('unreported', intval($user_id)); ?></em></a>
                        </li>
                        <?php } ?>
                        <li>
                            <a href="javascript:;">Messages:<em><?php echo count(getUnreadMessagesCounter(intval($user_id))); ?></em></a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                Number of logins:
                                <em>
                                    <?php
                                   // $user_email = getUserMetaDetail($user_id, 'email', 'users')[0]['email'];
                                    echo html_purify(getUserLogins($$email['value'], 'logins')); ?>
                                </em>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">Last login:<em><?php echo date('F d , Y', getUserMetaDetail($user_id, 'last_login', 'users')[0]['last_login']); ?></em></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-8 col-lg-9">
        <?php if (isset($message)) { ?>
            <div id="infoMessage" class="alert alert-info alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>    
                <?php echo html_purify($message); ?>
            </div>
        <?php } ?>
        
        
        <ul class="tg-themenavtabstwo nav navbar-nav">
            <li class="nav-item active">
                <a class="" id="home-tab" data-toggle="tab" href="#userdetails">User Details</a>
            </li>
            <?php if ($group_type[0]->group_type !== 'A') { ?>
            <li class="nav-item">
                <a id="profile-tab" data-toggle="tab" href="#speciality">Outsource &amp; Speciality</a>
            </li>
            <li class="nav-item">
                <a id="messages-tab" data-toggle="tab" href="#reference">Professional Reference</a>
            </li>
            <li class="nav-item">
                <a id="settings-tab" data-toggle="tab" href="#summary">User Summary</a>
            </li>
            <li class="nav-item">
                <a id="permission-tab" data-toggle="tab" href="#permissions">Permissions</a>
            </li>
            <?php } ?>
            <!-- <li class="at-tabactiveselect">
                <span class="tg-select">
                    <select data-placeholder="Block checked by:" name="Block checked by:">
                        <option value="">All Recent Activity</option>
                        <option value="">type1</option>
                        <option value="">type2</option>
                        <option value="">type3</option>
                    </select>
                </span>
            </li> -->
        </ul>
        <div class="tg-tabcontentvthree tab-content">
            <div class="tg-tabuserdetails tab-pane active fade in" id="userdetails">
                <div class="tg-user-tabcontent">
                    <div class="tg-groups-holder">
                        <div class="tg-title">
                            <h4>Member of Groups</h4>
                        </div>
                        <nav class="tg-usergroupnav">
                            <ul>
                                <?php
                                $groups_list = getStaticGroupNames();
                                foreach ($groups_list as $key => $value) {
                                    $active = '';
                                    if ($group_type[0]->group_type === $key) {
                                        $active = 'tg-active';
                                    }
                                    echo '<li class="'.html_purify($active).'"><a href="javascript:;">'.html_purify($value).'</a></li>';
                                } 
                                ?>
                            </ul>
                        </nav>
                    </div>
                    <div class="tg-rightarea tg-useruploadimgholder">
                        <label for="tg-uploaduserimg">
                            <a id="profile_image_uplaod"><span>Upload Profile Photo <em>Click to upload</em></span></a>
                        </label>
                        <div id="plupload-profile-container"></div>
                        
                        <?php if (!empty($profile_image_name['value']) && !empty($profile_image_path['value'])) { ?>
                            <div class="tg-useruploadimg">
                                <a href="javascript:void(0);"><i class="lnr lnr-cross delete_profile_pic"></i></a>
                                <img src="<?php echo base_url() .'uploads/'. $profile_image_name['value']; ?>" name="<?php echo html_purify($profile_image_name['value']); ?>">
                            </div>
                        <?php } else { ?>
                        <div class="tg-useruploadimg">
                            <i class="lnr lnr-user"></i>
                        </div>
                        <?php } ?>
                    </div>
                    <!--Form Area Start-->
                    <div class="tg-user-detail-form">
                        <?php echo form_open(uri_string(), array('class' => 'form tg-formtheme tg-editform')); ?>
                        <?php if($currentGroups[0]->id==6){ ?>
                        <fieldset>
        <div class="form-field-group">
        <div class="tg-usertitle"><h4>Practice Details</h4></div>
            <div class="form-group tg-inputwithicon tg-input-onethird">
            <select name="hos_id[]" id="multiselect" multiple="multiple">
                                    <option value="">Choose Practice</option>
                                    <?php 
                                    
                                   
                                    foreach($get_hospitals as $rec){
                                        
                                        $selected = '';
                                        if(in_array($rec->id,$usergrouphospital))
                                        {
                                            $selected = 'selected="selected"';
                                        }
                                        ?>
                                         <option value="<?php echo $rec->id?>" <?php echo $selected;?>><?php echo $rec->name; ?></option>
                                        <?php
                                    }?>
                                    </select>


                                           </div>
           
        </div>
    </fieldset>
  
    <input type="hidden" name="usergroup_type" value="<?php echo $currentGroups[0]->id;?>" />
                        <?php 
                        }
                        //Edit By Bilal
                       // var_dump($get_hospitals);exit;
                        
                        displayGeneralFormFields(
                            $first_name,
                            $last_name,
                            $company,
                            $phone,
                            $password,
                            $password_confirm,
                            $email,
                            $dob,
                            $memorable,
                            $street_address,
                            $post_code,
                            $additional_number,
                            $gmc_no,
                            $current_position,
                            $current_status,
                            $current_employer,
                            $work_street_address,
                            $work_post_code,
                            $work_number,
                            $work_email,
                            $work_gmc_no,
                            $responsible_officer,
                            $revalidation_date,
                            $last_appraisal_date,
                            $last_appraisal_location,
                            $last_appraisal_person,
                            $fitness_to_practice,
                            $conflict_of_interest,
                            $get_hospitals
                        ); ?>
                        <div class="tg-btnarea">
                            <?php echo form_hidden('id', $user->id); ?>
                            <?php echo form_input($profile_image_name); ?>
                            <?php echo form_input($profile_image_path); ?>
                            <?php echo form_hidden($csrf); ?>
                            <button type="submit" class="tg-btn">Save &amp; Continue</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <!--Form Area End-->
                </div>
            </div>
            <?php if ($group_type[0]->group_type !== 'A') { ?>
            <div class="tg-tabspeciality tab-pane" id="speciality">
                <div class="tg-user-tabcontent">
                    <div class="tg-user-detail-form">
                        <?php echo form_open(base_url() .'index.php/auth/updateUserCustomForm/'. $user->id , array('class' => 'form tg-formtheme tg-editform')); ?>
                        <?php displayOutsourceSpecialityFormFields(
                            $outsource_work_name,
                            $outsource_work_avail_date,
                            $account_name,
                            $account_number,
                            $account_csv_code,
                            $cases_limit,
                            $cases_posted_address,
                            $report_from_home,
                            $receive_work_days
                        ); ?>
                        <div class="tg-btnarea">
                            <?php echo form_hidden('id', $user->id); ?>
                            <input type="hidden" name="outsource_speacility" value="true">
                            <?php echo form_hidden($csrf); ?>
                            <button type="submit" class="tg-btn">Save &amp; Continue</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="tg-tabreference tab-pane" id="reference">
            3
            </div>
            <div class="tg-tabsummary tab-pane" id="summary">
            4
            </div>
            <div class="tg-tabpermissions tab-pane" id="permissions">
                <div class="tg-dashboardbox tg-userhistoryhold">
                    <div class="tg-dashboardboxtitle">
                        <h2>Permissions</h2>
                    </div>
                    <?php
                    if ($group_type[0]->group_type === 'H') {
                        ?>
                        <ul class="tg-userhistory">
                            <li>
                                <h4>Assign Role</h4>
                                <p>Choose the role from below dropdown.<p>
                                <form id="assign_roles_form" class="form">
                                    <label for="roles_name">Roles</label>
                                    <?php $user_id = $this->uri->segment(3); ?>
                                    <select class="form-control" name="roles_name" id="roles_name">
                                        <option value="0">Choose Role</option>
                                        <?php
                                        $get_roles = $this->Ion_auth_model->get_roles_list();
                                        $user_role = $this->Ion_auth_model->get_user_role_data($user_id);
                                        if (!empty($get_roles)) {
                                            foreach ($get_roles as $roles) {
                                                $selected = '';
                                                if ($user_role[0]->role_id === $roles->role_id) {
                                                    $selected = 'selected';
                                                }
                                                echo '<option ' . $selected . ' value="' . intval($roles->role_id) . '">' . html_purify($roles->role_name) . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                </form>
                            </li>
                            <?php
                            $hospital_permissions = $this->ion_auth->user($user_id)->row()->user_doc_rec_perm;
                            $hospital_user_specimen_data = $this->ion_auth->user($user_id)->row()->hospital_user_specimen_data;
                            $exclude_user_request_viewed = $this->ion_auth->user($user_id)->row()->exclude_user_request_viewed;
                            $checked = '';
                            if ($hospital_permissions === 'on') {
                                $checked = 'checked';
                            }
                            ?>
                            <li>
                                <label for="can_add_record">Can perform lab tracking also.</label>
                                <input <?php echo $checked; ?> type="checkbox" name="hospital_lab_track" data-userid="<?php echo intval($user_id); ?>">
                                <div class="user_role_msg"></div>
                            </li>
                            <!--Permission to hide specimen data-->
                            <?php
                            $checked = '';
                            if ($hospital_user_specimen_data === 'on') {
                                $checked = 'checked';
                            }
                            ?>
                            <li>
                                <label for="hide_specimen_data">Hide Specimen Data</label>
                                <input <?php echo $checked; ?> type="checkbox" name="hide_specimen_data" data-userid="<?php echo intval($user_id); ?>">
                            </li>
                            <?php
                            $checked = '';
                            if ($exclude_user_request_viewed === 'on') {
                                $checked = 'checked';
                            }
                            ?>
                            <li>
                                <label for="exclude_user_from_request_viewed">Exclude User From Record Viewed</label>
                                <input <?php echo $checked; ?> type="checkbox" name="exclude_user_from_request_viewed" data-userid="<?php echo intval($user_id); ?>">
                            </li>
                            <!--Permission to hide specimen data-->
                        </ul>
                        <?php
                    }

                    if ($group_type[0]->group_type === 'S') {
                        $sec_permissions = $this->ion_auth->user($user_id)->row()->user_sec_rec_permission;

                        $permissions_array = array();
                        if (!empty($sec_permissions)) {
                            $permissions_array = unserialize($sec_permissions);
                        }
                        ?>
                        <ul class="tg-userhistory">
                            <form id="sec_record_permissions">
                                <?php
                                $checked = '';
                                if (!empty($permissions_array) && in_array('sec_can_add_record', $permissions_array)) {
                                    $checked = 'checked';
                                }
                                ?>
                                <li>
                                    <input <?php echo $checked; ?> type="checkbox" name="sec_add_report_perm[]" id="sec_add_report" value="sec_can_add_record">
                                    <label for="sec_add_report">Can Secretary Add Report.</label><br />
                                </li>                       
                                <?php
                                $checked = '';
                                if (!empty($permissions_array) && in_array('sec_can_add_clinic', $permissions_array)) {
                                    $checked = 'checked';
                                }
                                ?>
                                <li>
                                    <input <?php echo $checked; ?> type="checkbox" name="sec_add_report_perm[]" id="sec_add_clinic" value="sec_can_add_clinic">
                                    <label for="sec_add_clinic">Can Add Clinic & Batches.</label><br />
                                </li> 
                                <?php
                                $checked = '';
                                if (!empty($permissions_array) && in_array('sec_can_assign_cases', $permissions_array)) {
                                    $checked = 'checked';
                                }
                                ?>
                                <li>
                                    <input <?php echo $checked; ?> type="checkbox" name="sec_add_report_perm[]" id="sec_assign_cases" value="sec_can_assign_cases">
                                    <label for="sec_assign_cases">Can Assign Cases.</label><br />
                                </li>                        
                                <?php
                                $checked = '';
                                if (!empty($permissions_array) && in_array('sec_can_download_tracker', $permissions_array)) {
                                    $checked = 'checked';
                                }
                                ?>
                                <li>
                                    <input <?php echo $checked; ?> type="checkbox" name="sec_add_report_perm[]" id="sec_download_tracker" value="sec_can_download_tracker">
                                    <label for="sec_download_tracker">Can Download Tracker.</label><br />
                                </li>
                                <?php
                                $checked = '';
                                if (!empty($permissions_array) && in_array('sec_can_view_mdt', $permissions_array)) {
                                    $checked = 'checked';
                                }
                                ?>
                                <li>
                                    <input <?php echo $checked; ?> type="checkbox" name="sec_add_report_perm[]" id="sec_view_mdt" value="sec_can_view_mdt">
                                    <label for="sec_view_mdt">Can View MDT Lists.</label><br />
                                </li>
                                <?php
                                $checked = '';
                                if (!empty($permissions_array) && in_array('sec_can_edit_record', $permissions_array)) {
                                    $checked = 'checked';
                                }
                                ?>
                                <li>
                                    <input <?php echo $checked; ?> type="checkbox" name="sec_add_report_perm[]" id="sec_edit_record" value="sec_can_edit_record">
                                    <label for="sec_edit_record">Can Edit Record.</label><br />
                                </li>
                                <?php
                                $checked = '';
                                if (!empty($permissions_array) && in_array('sec_can_add_mdt', $permissions_array)) {
                                    $checked = 'checked';
                                }
                                ?>
                                <li>
                                    <input <?php echo $checked; ?> type="checkbox" name="sec_add_report_perm[]" id="sec_add_mdt" value="sec_can_add_mdt">
                                    <label for="sec_add_mdt">Can Add to MDT</label><br />
                                </li>
                                <?php
                                $checked = '';
                                if (!empty($permissions_array) && in_array('sec_can_request_fw', $permissions_array)) {
                                    $checked = 'checked';
                                }
                                ?>
                                <li>
                                    <input <?php echo $checked; ?> type="checkbox" name="sec_add_report_perm[]" id="sec_request_fw" value="sec_can_request_fw">
                                    <label for="sec_request_fw">Can Request Further Work</label><br />

                                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                    <button type="button" id="add_sec_permissions" class="btn btn-primary">Assign</button>
                                </li>
                            </form>
                        </ul>
                        <?php
                    }

                    if ($group_type[0]->group_type === 'D') {

                        $doc_permissions = $this->ion_auth->user($user_id)->row()->user_doc_rec_perm;
                        $manage_codes_permissions = $this->ion_auth->user($user_id)->row()->user_change_micro_codes;
                        $doc_checked = '';
                        if ($doc_permissions === 'on') {
                            $doc_checked = 'checked';
                        }
                        $codes_checked = '';
                        if ($manage_codes_permissions === 'on') {
                            $codes_checked = 'checked';
                        }
                        ?>
                        <ul class="tg-userhistory">
                            <li>
                                <label for="can_add_record">Can Add Record.</label>
                                <input <?php echo $doc_checked; ?> type="checkbox" name="doctor_add_record" data-userid="<?php echo intval($user_id); ?>">
                            </li>
                            <li>
                                <label for="doctor_manage_codes">Can Change Micro Codes.</label>
                                <input <?php echo $codes_checked; ?> type="checkbox" name="doctor_manage_codes" data-userid="<?php echo intval($user_id); ?>">
                            </li>
                        </ul>
                        <?php
                    }

                    if ($group_type[0]->group_type === 'G' || $group_type[0]->group_type === 'C') {
                        ?>
                        <ul class="tg-userhistory">
                            <li>
                                <label for="can_view_other_records">Can View Other Records</label>
                                <input type="checkbox" name="can_view_other_records" data-userid="<?php echo intval($user_id); ?>">
                            </li>
                        </ul>
                        <?php
                    }
                    ?>                       
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="clearfix"></div>
    </div>
</div>
