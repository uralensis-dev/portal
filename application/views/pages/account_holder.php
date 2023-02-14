<!-- Page Content -->
<div class="content container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Account Holder</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Account Holder</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i> Add User</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Account Holder</h3>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            
            <form>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Hospital/Clinic Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" value="Uralensis">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Contact Person</label>
                            <input class="form-control " value="Dr. Iskandar Chaudhry" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Address</label>
                            <input class="form-control " value="London, UK" type="text">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="form-group">
                            <label>Country</label>
                            <select class="form-control select">
                                <option>United Kingdom</option>
                                <option>USA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="form-group">
                            <label>City</label>
                            <input class="form-control" value="London" type="text">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="form-group">
                            <label>State/Province</label>
                            <select class="form-control select">
                                <option>London</option>
                                <option>Alaska</option>
                                <option>Alabama</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="form-group">
                            <label>Postal Code</label>
                            <input class="form-control" value="WC2N 5DU" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" value="iskander.chaudhry@nhs.net" type="email">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input class="form-control" value="+44-0759-3043609" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input class="form-control" value="+44-0759-3043609" type="text">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Fax</label>
                            <input class="form-control" value="818-978-7102" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Website Url</label>
                            <input class="form-control" value="https://mskcc.uralensisdigital.co.uk/" type="text">
                        </div>
                    </div>
                </div>
                <div class="submit-section">
                    <button class="btn btn-primary submit-btn">Save</button>
                </div>
            </form>
        </div>
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