
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Users</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i> Add User</a>
        </div>
    </div>
</div>
<!-- /Page Header -->
<!-- Search Filter -->
<?php echo form_open(''); ?>
<div class="row filter-row">
    <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus">
            <input type="text" name="name" value="<?php echo $name?>" class="form-control floating">
            <label class="focus-label">Name</label>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus select-focus">
            <select class="select floating" name="status">
                <option value="">Select Status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            <label class="focus-label">Status</label>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus select-focus">
        <?php
        $getgroups = getRecords("*","groups");
         ?>
            <select class="select floating" name="groups" onChange="this.form.submit()">
                <option value="">Select Role</option>
                <?php $admin_group_id = getAllUsersGroups('A')[0]['id']; ?>
                <option value="<?php echo  intval($admin_group_id) ?>">Admin</option>
                <?php $doctor_group_id = getAllUsersGroups('D')[0]['id']; ?>
                <option value="<?php echo  intval($doctor_group_id) ?>">Pathologist</option>
                <?php
                $user_groups = getAllUsersGroups('H');
                if (!empty($user_groups)) {
                    foreach ($user_groups as $ugkey => $ugval) {
                        ?>
                        <option value="<?php echo  intval($ugval['id']) ?>"><?php echo html_purify($ugval['description']); ?></option>
                    <?php }
                } ?>
                <?php
                $user_groups = getAllUsersGroups('L');
                if (!empty($user_groups)) {
                    foreach ($user_groups as $ugkey => $ugval) {
                        ?>
                        <option value="<?php echo  intval($ugval['id']) ?>"><?php echo html_purify($ugval['description']); ?></option>
                    <?php }
                } ?>
                <?php $group_id = getAllUsersGroups('C')[0]; ?>
                <option value="<?php echo  intval($group_id['id']) ?>"><?php echo $group_id['description'];?></option>
                <?php $group_id = getAllUsersGroups('CS')[0]; ?>
                <option value="<?php echo  intval($group_id['id']) ?>"><?php echo $group_id['description'];?></option>
                <?php $group_id = getAllUsersGroups('S')[0]; ?>
                <option value="<?php echo  intval($group_id['id']) ?>"><?php echo $group_id['description'];?></option>
                <?php $group_id = getAllUsersGroups('R')[0]; ?>
                <option value="<?php echo  intval($group_id['id']) ?>"><?php echo $group_id['description'];?></option>
                <?php $group_id = getAllUsersGroups('T')[0]; ?>
                <option value="<?php echo  intval($group_id['id']) ?>"><?php echo $group_id['description'];?></option>
            </select>
            <label class="focus-label">Role</label>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <button type="submit" class="btn btn-success btn-block">Filter</button>
        <!--<a href="#" class="btn btn-success btn-block"> Search </a> -->
    </div>
</div>
</form>
<!-- /Search Filter -->
<div class="row staff-grid-row">
    <?php
    /**
     * Check if Query String is Set in URL
     */
    $url_user_group_id = '';
    if (isset($_GET) && !empty($_GET['group_id'])) {
        $url_user_group_id = $_GET['group_id'];
    }
    //var_dump($url_user_group_id);exit;
    //$custom_users = getAllUsers($url_user_group_id);
    $custom_users = $userslist;
    //debug($custom_users);
    // echo last_query();exit;
    // echo "<pre>";
    // print_r($custom_users);
    //debug($custom_users);exit;
    if (!empty($custom_users)) {
        ?>
        <?php
        $color_count = 0;
        foreach ($custom_users as $key => $value) {
            $is_hospital_admin = $value->is_hospital_admin;
            $jointable = array("groups" => "groups.id=users_groups.group_id");
            $getGroupinfo = getRecords("groups.id,	name", "users_groups", array("user_id" => $value->user_id), "", "", $jointable);
            $full_name = '';
            // $first_name = htmlspecialchars($value->first_name, ENT_QUOTES, 'UTF-8');
            $first_name = htmlspecialchars($value->enc_first_name, ENT_QUOTES, 'UTF-8');
            $last_name = htmlspecialchars($value->enc_last_name, ENT_QUOTES, 'UTF-8');
            // $last_name = htmlspecialchars($value->last_name, ENT_QUOTES, 'UTF-8');
            if (!empty($first_name) || !empty($last_name)) {
                $full_name = $first_name . ' ' . $last_name;
            }
            // $user_email = htmlspecialchars($value->email, ENT_QUOTES, 'UTF-8');
            $user_email = htmlspecialchars($value->enc_email, ENT_QUOTES, 'UTF-8');
            if ($value->active) {
                $user_active_status = anchor("auth/deactivate/" . $value->id, lang('index_active_link'));
            } else {
                $user_active_status = anchor("auth/activate/" . $value->id, lang('index_inactive_link'));
            }
            //Get Hospital Group ID From User Meta Table
            $user_meta_hospiatl_group_id = $this->db->select('surgeon_clinician_hos_group_id')->where('id', $value->id)->get('users')->row_array()['surgeon_clinician_hos_group_id'];
            $hospital_linked_name = '';
            
            if (!empty($user_meta_hospiatl_group_id)) {
                $hospital_linked_name = '<i>Linked With: ' . $this->ion_auth->group($user_meta_hospiatl_group_id)->row()->description . '</i>';
            }
            ?>
            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                <div class="profile-widget">
                    <div class="profile-img">
                    <?php if($value->profile_picture_path!="" ){?>
                        <a href="<?php echo  base_url() ?>auth/edit_user/<?php echo  $value->id ?>" class="avatar"><img src="<?php echo base_url($value->profile_picture_path)?>" alt=""></a>

                    <?php }else{?>
                        <a href="<?php echo  base_url() ?>auth/edit_user/<?php echo  $value->id ?>" class="avatar"><img src="<?php echo  base_url() ?>assets/img/dummy-doctors.jpg" alt=""></a>
                    <?php } ?>
                    </div>
                    <div class="dropdown profile-action">
                        <a class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="<?php echo  base_url() ?>auth/edit_user/<?php echo  $value->id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                        </div>
                    </div>
                    <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a><?php echo html_purify($full_name); ?></a></h4>
                    <div class="small text-muted"><?php
                        foreach ($getGroupinfo as $group) {
                            echo anchor("auth/edit_group/" . intval($group->id), htmlspecialchars(ucwords($group->name), ENT_QUOTES, 'UTF-8'));
                        }
                        ?>
                    </div>
                   
                    <a href="javascript:;" onClick="loadasAdmin(<?php echo intval($value->id); ?>)">
                     
                        <img src="<?php echo  base_url() ?>assets/icons/adminlogin.png" class="adminlogin"/>
                    </a>
                </div>
            </div>
            <?php $color_count++;
        } ?>
    <?php } ?>
</div>
</div>
<!-- /Page Content -->
<!-- Add User Modal -->
<div id="add_user" class="modal custom-modal fade" role="dialog">

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
                                 
                                <select class="select form-control" id="tg-hospital" name="user_groups" onChange="gethospital(this.value)"  >
                                 <?php
                                $groups_list = getStaticGroupNames();
                                foreach ($groups_list as $key => $value) {?>
                                    <option value="<?php echo $key ?>" <?php echo $active; ?>><?php echo html_purify($value); ?></option>
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
                                 
                                <select class="select form-control" name="group_id"  >
                                <?php
                            $user_groups = getAllUsersGroups();
                            //echo last_query();
                            if (!empty($user_groups)) {
                                foreach ($user_groups as $ugkey => $ugval) {
                                    ?>
                                    <option value="<?php echo intval($ugval['id']); ?>" ><?php echo html_purify($ugval['description']); ?></option>
                                    <?php }} ?>
                                    
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
</div>
<!-- /Add User Modal -->
<!-- Edit User Modal -->
<div id="edit_user" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input class="form-control" value="John" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" value="Doe" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Username <span class="text-danger">*</span></label>
                                <input class="form-control" value="johndoe" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input class="form-control" value="johndoe@example.com" type="email">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" type="password">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input class="form-control" type="password">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone </label>
                                <input class="form-control" value="9876543210" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="select">
                                    <option>Admin</option>
                                    <option>Client</option>
                                    <option selected>Employee</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Company</label>
                                <select class="select">
                                    <option>Global Technologies</option>
                                    <option>Delta Infotech</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Employee ID <span class="text-danger">*</span></label>
                                <input type="text" value="FT-0001" class="form-control floating">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive m-t-15">
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
                                    <input checked="" type="checkbox">
                                </td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                            </tr>
                            <tr>
                                <td>Holidays</td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                            </tr>
                            <tr>
                                <td>Leaves</td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                            </tr>
                            <tr>
                                <td>Events</td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                                <td class="text-center">
                                    <input checked="" type="checkbox">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit User Modal -->
<!-- Delete User Modal -->
<div class="modal custom-modal fade" id="delete_user" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete User</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function gethospital(myval)
    {
      if(myval=='H')
      {
          $("#Selectsub").show();
      }else{
          $("#Selectsub").hide();
      }
    }
    </script>