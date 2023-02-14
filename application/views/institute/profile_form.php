<<<<<<< HEAD
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
// $first_name = $this->ion_auth->user()->row()->first_name;
// $last_name = $this->ion_auth->user()->row()->last_name;
// $email = $this->ion_auth->user()->row()->email;
// $phone = $this->ion_auth->user()->row()->phone;
// $company = $this->ion_auth->user()->row()->company;
$first_name = $decryptedDetails->first_name;
$last_name = $decryptedDetails->last_name;
$email = $decryptedDetails->email;
$phone = $decryptedDetails->phone;
$company = $decryptedDetails->company;
$memorable = $this->ion_auth->user()->row()->memorable;
$username = $this->ion_auth->user()->row()->username;
$profile_picture_path = $this->ion_auth->user()->row()->profile_picture_path;	
?>
<div class="row">
    <div style="width:60%;margin:0 auto;">
        <p class="pull-right"><i class="glyphicon glyphicon-user">&nbsp;</i><a data-toggle="modal" data-target="#change_password">Change Password</a></p>
        <div class="clearfix"></div>
        <?php echo validation_errors(); ?>
        <?php
        if ($this->session->flashdata('success_update') != '') {
            echo $this->session->flashdata('success_update');
        }
        if ($this->session->flashdata('general_error') != '') {
            echo $this->session->flashdata('general_error');
        }
        ?>
        <?php
        if ($this->session->flashdata('upload_error') != '') {
            echo $this->session->flashdata('upload_error');
        }
        ?>
        <h3 class="text-center">Update Profile Information</h3>
        <form enctype="multipart/form-data" id="dashboard_profile" class="form" action="<?php echo base_url('index.php/institute/update_profile'); ?>" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" id="first_name">First Name</label>
                        <input class="form-control" type="text" name="first_name" id="first_name" value="<?php echo (!empty($first_name)) ? html_purify($first_name) : ''; ?>" >
                    </div>
                    <div class="form-group">
                        <label class="control-label" id="email_address">Email</label>
                        <input class="form-control" type="email" name="email_address" id="email_address" value="<?php echo (!empty($email)) ? html_purify($email) : ''; ?>" >
                        <span><?php echo form_error('email_address'); ?></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" id="username">Username</label>
                        <input class="form-control" type="text" name="username" id="username" value="<?php echo (!empty($username)) ? html_purify($username) : ''; ?>" >
                    </div>
                    <div class="form-group">
                        <label class="control-label" id="company">Company</label>
                        <input class="form-control" type="text" name="company" id="company" value="<?php echo (!empty($company)) ? html_purify($company) : ''; ?>" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" id="last_name">Last Name</label>
                        <input class="form-control" type="text" name="last_name" id="last_name" value="<?php echo (!empty($last_name)) ? html_purify($last_name) : ''; ?>" >
                    </div>
                    <div class="form-group">
                        <label class="control-label" id="phone">Phone</label>
                        <input class="form-control" type="tel" name="phone" id="phone" value="<?php echo (!empty($phone)) ? $phone : ''; ?>" >
                        <span><?php echo form_error('phone'); ?></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" id="memorable">Memorable Word (10 Alphabet Letters Only)</label>
                        <input class="form-control memorable" type="password" name="memorable" id="memorable" value="<?php echo (!empty($memorable)) ? html_purify($memorable) : ''; ?>" >
                        <p><a href="" id="show_mem">Show Memorable Word</a></p>
                        <span><?php echo form_error('memorable'); ?></span>
                    </div> 
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label" id="profile_picture">Profile Picture (jpg | png Allowed)</label>
                        <input class="form-control" type="file" name="profile_picture" id="profile_picture" >
                        <input type="hidden" name="profile_picture_hidden" value="<?php echo (!empty($profile_picture_path)) ? $profile_picture_path : ''; ?>" >
                        <span>
                          <?php echo (!empty($profile_picture_path)) ? $profile_picture_path : ''; ?>  
                        </span>
                    </div>
                </div>
            </div>
            <button style="width:100%;" id="update_profile" type="submit" class="pull-left btn btn-success">Update</button>
        </form>
    </div>
</div>

<div id="change_password" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Password</h4>
            </div>
            <div class="modal-body">
                <div id="confirm_pass_msg"></div>
                <form class="form" id="change_password_form">
                    <div class="form-group">
                        <label for="old_pass">Enter Old Password</label>
                        <input type="password" name="old_pass" id="old_pass">
                    </div>
                    <div class="form-group">
                        <label for="new_pass">Enter New Password</label>
                        <input type="password" name="new_pass" id="new_pass">
                    </div>
                    <div class="form-group">
                        <label for="new_confirm_pass">Confirm New Password</label>
                        <input type="password" name="new_confirm_pass" id="new_confirm_pass">

                    </div>
                    <div class="form-group">
                        <button id="save_pass_btn" class="btn btn-success" type="button">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


=======
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
// $first_name = $this->ion_auth->user()->row()->first_name;
// $last_name = $this->ion_auth->user()->row()->last_name;
// $email = $this->ion_auth->user()->row()->email;
// $phone = $this->ion_auth->user()->row()->phone;
// $company = $this->ion_auth->user()->row()->company;
$first_name = $decryptedDetails->first_name;
$last_name = $decryptedDetails->last_name;
$email = $decryptedDetails->email;
$phone = $decryptedDetails->phone;
$company = $decryptedDetails->company;
$memorable = $this->ion_auth->user()->row()->memorable;
$username = $this->ion_auth->user()->row()->username;
$profile_picture_path = $this->ion_auth->user()->row()->profile_picture_path;	
?>
<div class="row">
    <div style="width:60%;margin:0 auto;">
        <p class="pull-right"><i class="glyphicon glyphicon-user">&nbsp;</i><a data-toggle="modal" data-target="#change_password">Change Password</a></p>
        <div class="clearfix"></div>
        <?php echo validation_errors(); ?>
        <?php
        if ($this->session->flashdata('success_update') != '') {
            echo $this->session->flashdata('success_update');
        }
        if ($this->session->flashdata('general_error') != '') {
            echo $this->session->flashdata('general_error');
        }
        ?>
        <?php
        if ($this->session->flashdata('upload_error') != '') {
            echo $this->session->flashdata('upload_error');
        }
        ?>
        <h3 class="text-center">Update Profile Information</h3>
        <form enctype="multipart/form-data" id="dashboard_profile" class="form" action="<?php echo base_url('index.php/institute/update_profile'); ?>" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" id="first_name">First Name</label>
                        <input class="form-control" type="text" name="first_name" id="first_name" value="<?php echo (!empty($first_name)) ? html_purify($first_name) : ''; ?>" >
                    </div>
                    <div class="form-group">
                        <label class="control-label" id="email_address">Email</label>
                        <input class="form-control" type="email" name="email_address" id="email_address" value="<?php echo (!empty($email)) ? html_purify($email) : ''; ?>" >
                        <span><?php echo form_error('email_address'); ?></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" id="username">Username</label>
                        <input class="form-control" type="text" name="username" id="username" value="<?php echo (!empty($username)) ? html_purify($username) : ''; ?>" >
                    </div>
                    <div class="form-group">
                        <label class="control-label" id="company">Company</label>
                        <input class="form-control" type="text" name="company" id="company" value="<?php echo (!empty($company)) ? html_purify($company) : ''; ?>" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" id="last_name">Last Name</label>
                        <input class="form-control" type="text" name="last_name" id="last_name" value="<?php echo (!empty($last_name)) ? html_purify($last_name) : ''; ?>" >
                    </div>
                    <div class="form-group">
                        <label class="control-label" id="phone">Phone</label>
                        <input class="form-control" type="tel" name="phone" id="phone" value="<?php echo (!empty($phone)) ? $phone : ''; ?>" >
                        <span><?php echo form_error('phone'); ?></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" id="memorable">Memorable Word (10 Alphabet Letters Only)</label>
                        <input class="form-control memorable" type="password" name="memorable" id="memorable" value="<?php echo (!empty($memorable)) ? html_purify($memorable) : ''; ?>" >
                        <p><a href="" id="show_mem">Show Memorable Word</a></p>
                        <span><?php echo form_error('memorable'); ?></span>
                    </div> 
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label" id="profile_picture">Profile Picture (jpg | png Allowed)</label>
                        <input class="form-control" type="file" name="profile_picture" id="profile_picture" >
                        <input type="hidden" name="profile_picture_hidden" value="<?php echo (!empty($profile_picture_path)) ? $profile_picture_path : ''; ?>" >
                        <span>
                          <?php echo (!empty($profile_picture_path)) ? $profile_picture_path : ''; ?>  
                        </span>
                    </div>
                </div>
            </div>
            <button style="width:100%;" id="update_profile" type="submit" class="pull-left btn btn-success">Update</button>
        </form>
    </div>
</div>

<div id="change_password" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Password</h4>
            </div>
            <div class="modal-body">
                <div id="confirm_pass_msg"></div>
                <form class="form" id="change_password_form">
                    <div class="form-group">
                        <label for="old_pass">Enter Old Password</label>
                        <input type="password" name="old_pass" id="old_pass">
                    </div>
                    <div class="form-group">
                        <label for="new_pass">Enter New Password</label>
                        <input type="password" name="new_pass" id="new_pass">
                    </div>
                    <div class="form-group">
                        <label for="new_confirm_pass">Confirm New Password</label>
                        <input type="password" name="new_confirm_pass" id="new_confirm_pass">

                    </div>
                    <div class="form-group">
                        <button id="save_pass_btn" class="btn btn-success" type="button">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


>>>>>>> 13e207a12f405c4440efdb747fbfdf8deabedf8f
