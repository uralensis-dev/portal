<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Request</h3>
            </div>
            <div class="panel-body">
                <img src="<?php echo base_url('assets/img/view_record.png'); ?>" />
                <span><?php echo anchor('secretary/view_reports', '<strong style="padding-left:4px;">View Your Request</strong>', 'title="view"'); ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <?php
        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();

        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        
        if (in_array('sec_can_add_clinic', $sec_perm)) {
            ?>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Courier & Clinic Dates</h3>
                </div>
                <div class="panel-body">
                    <?php echo anchor('secretary/show_hospital_clinic_dates', '<strong style="font-size:15px;"><img src="' . base_url('assets/img/clinic_dates.png') . '">&nbsp;&nbsp;&nbsp;Add Clinic Dates</strong>', 'title="Add Clinic Dates"'); ?>
                    <hr>
                    <?php echo anchor('secretary/show_courier', '<strong style="font-size:15px;"><img src="' . base_url('assets/img/courier.png') . '">&nbsp;&nbsp;&nbsp;Courier</strong>', 'title="Courier"'); ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="col-md-5">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Account Detail</h3>
            </div>
            <div class="panel-body">
                <?php
                $user_id = $this->ion_auth->user()->row()->id;
                // $first_name = $this->ion_auth->user()->row()->first_name;
                // $last_name = $this->ion_auth->user()->row()->last_name;
                // $company = $this->ion_auth->user()->row()->company;
                // $email = $this->ion_auth->user()->row()->email;
                // $phone = $this->ion_auth->user()->row()->phone;
                $first_name = $decryptedDetails->first_name;
                $last_name = $decryptedDetails->last_name;
                $company = $decryptedDetails->company;
                $email = $decryptedDetails->email;
                $phone = $decryptedDetails->phone;
                $profile_pic = $this->ion_auth->user()->row()->picture_name;
                $user_pin = $this->ion_auth->user()->row()->user_auth_pass;
                ?>
                <div class="col-md-5">
                    <?php if (!empty($profile_pic)) { ?>
                        <img src="<?php echo base_url('uploads/' . html_purify($profile_pic)); ?>" class="img-rounded img-responsive">
                    <?php } else { ?>
                        <img src="<?php echo base_url('assets/img/user_default.jpg'); ?>" class="img-rounded img-responsive">
                    <?php } ?>
                </div>
                <div class="col-md-7">
                    <blockquote>
                        <?php if (isset($first_name) && isset($last_name)) { ?>
                            <p><?php echo html_purify($first_name) . '&nbsp;' . html_purify($last_name); ?></p>
                        <?php } ?>
                        <?php if (isset($company)) { ?>
                            <small><cite title="<?php echo html_purify($company); ?>"><?php echo html_purify($company); ?></cite></small>
                        <?php } ?>
                    </blockquote>
                    <p>
                        <?php if (isset($email)) { ?>
                            <i class="glyphicon glyphicon-envelope">&nbsp;</i> <?php echo html_purify($email); ?> <br>
                        <?php } ?>
                        <?php if (isset($phone)) { ?>
                            <i class="glyphicon glyphicon-phone">&nbsp;</i> <?php echo html_purify($phone); ?> <br>
                        <?php } ?>
                    </p>
                    <p><i class="glyphicon glyphicon-edit">&nbsp;</i><a href="<?php echo base_url('index.php/secretary/profile_form'); ?>">Edit Profile</a></p>
                </div>
                <div class="clearfix"></div>
                <h4 class="text-center"><label class="label label-success" style="padding: 10px 124px;">Last Login Attempts</label></h4>
                <table class="table table-condensed text-center">
                    <?php
                    if (!empty($previous_login) && is_array($previous_login)) {

                        foreach ($previous_login as $login_time) {
                            $time = $login_time->users_login_time;
                            $converted_date = date('M j Y', strtotime($time));
                            $converted_time = date('g:i A', strtotime($time));
                            ?>
                            <tr>
                                <td><img src="<?php echo base_url('assets/img/calendar.png'); ?>"></td>
                                <td><?php echo $converted_date; ?></td>
                                <td><img src="<?php echo base_url('assets/img/clock.png'); ?>"></td>
                                <td><?php echo $converted_time; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>