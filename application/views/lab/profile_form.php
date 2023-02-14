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
$username = $decryptedDetails->username;
$profile_picture_path = $this->ion_auth->user()->row()->profile_picture_path;
$user_pin = $this->ion_auth->user()->row()->user_auth_pass;
$gmc_code = $this->ion_auth->user()->row()->gmc_code;
?>


<div class="row" style="padding:25px 0;">

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Update Profile Information</h3>
            </div>
            <div class="panel-body">
            <button type="button" class="btn btn-info btn-lg pull-left" data-toggle="modal" data-target="#change_pin"> <i class="glyphicon glyphicon-wrench"></i> &nbsp; Change Pin</button>
            <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#change_password"> <i class="glyphicon glyphicon-user"></i> &nbsp; Change Password</button>


        <div class="clearfix form-group"></div>
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
        <form enctype="multipart/form-data" id="dashboard_profile" class="form" action="<?php echo base_url('index.php/doctor/update_profile'); ?>" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" id="first_name">First Name</label>
                        <input class="form-control" type="text" name="first_name" id="first_name" value="<?php echo (!empty($first_name)) ? $first_name : ''; ?>" >
                    </div>
                    <div class="form-group">
                        <label class="control-label" id="email_address">Email</label>
                        <input class="form-control" type="email" name="email_address" id="email_address" value="<?php echo (!empty($email)) ? $email : ''; ?>" >
                        <span><?php echo form_error('email_address'); ?></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" id="username">Username</label>
                        <input class="form-control" type="text" name="username" id="username" value="<?php echo (!empty($username)) ? $username : ''; ?>" >
                    </div>
                    <div class="form-group">
                        <label class="control-label" id="company">Company</label>
                        <input class="form-control" type="text" name="company" id="company" value="<?php echo (!empty($company)) ? $company : ''; ?>" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" id="last_name">Last Name</label>
                        <input class="form-control" type="text" name="last_name" id="last_name" value="<?php echo (!empty($last_name)) ? $last_name : ''; ?>" >
                    </div>
                    <div class="form-group">
                        <label class="control-label" id="phone">Phone</label>
                        <input class="form-control" type="tel" name="phone" id="phone" value="<?php echo (!empty($phone)) ? $phone : ''; ?>" >
                        <span><?php echo form_error('phone'); ?></span>
                    </div>
                    <div class="form-group" style="margin-bottom:2px;">
                        <label class="control-label" id="memorable">Memorable Word (10 Alphabet Letters Only)</label>
                        <input class="form-control memorable" type="password" name="memorable" id="memorable" value="<?php echo (!empty($memorable)) ? $memorable : ''; ?>" >
                        <p style="margin-bottom:0px;"><a href="" id="show_mem">Show Memorable Word</a></p>
                        <span><?php echo form_error('memorable'); ?></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" id="gmc_code">GMC Code</label>
                        <input class="form-control" type="text" name="gmc_code" id="gmc_code" value="<?php echo (!empty($gmc_code)) ? $gmc_code : ''; ?>" >
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
            <button style="width:100%;" id="update_profile" type="submit" class="pull-left btn btn-success btn-lg">Update</button>
        </form>
            </div>
        </div>
    </div>
</div>



<div id="change_pin" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="modal-title">Change Pin (Only Digits)</div>
            </div>
            <div class="modal-body">
                <div class="old_pin_msg"></div>
                <div id="confirm_pin_msg"></div>
                <form class="form" id="change_pin_form">
                    <div class="form-group">
                        <label for="old_pin">Enter Old Pin</label>
                        <input maxlength="4" type="password" name="old_pin" id="old_pin">
                    </div>
                    <div class="new_pin_area">
                        <div class="form-group">
                            <label for="new_pin">Enter New Pin</label>
                            <input maxlength="4" type="password" name="new_pin" id="new_pin">
                        </div>
                        <div class="form-group">
                            <label for="new_confirm_pin">Confirm New Pin</label>
                            <input maxlength="4" type="password" name="new_confirm_pin" id="new_confirm_pin">

                        </div>
                        <div class="form-group">
                            <button id="save_pin_btn" class="btn btn-success  btn-block btn-lg" type="button">Save Pin</button>
                        </div>

                    </div>
                </form>
                <script>
                    jQuery(document).ready(function () {
                        var timer;
                        jQuery('#change_pin_form').keyup('#old_pin', function (e) {

                            clearInterval(timer);
                            timer = setTimeout(function () {

                                var user_input = jQuery('#old_pin').val();
                                var db_input = '<?php echo $user_pin; ?>';

                                if (user_input !== db_input) {
                                    jQuery('.old_pin_msg').html('<div class="alert bg-danger">Wrong Old Pin</div>').show();
                                    jQuery('.new_pin_area').hide();
                                } else {

                                    jQuery('.old_pin_msg').html('<div class="alert bg-success">Old Pin Match</div>').hide(2000);
                                    jQuery('.new_pin_area').show();
                                }
                            }, 900);
                        });
                    });

                </script>
            </div>

        </div>
    </div>
</div>
<div id="change_password" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="modal-title">Change Password</div>
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
                        <button id="save_pass_btn" class="btn btn-success btn-block btn-lg" type="button">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>