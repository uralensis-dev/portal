<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="tg-dashboardbox inner-page-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-info">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            Enable/Disable Search
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <form action="<?php echo site_url('Admin/search_request'); ?>" method="post">
                                            <table class="table table-bordered">
                                                <tr class="bg-primary">
                                                    <th>First Name</th>
                                                    <th>Sur Name</th>
                                                    <th>EMIS No</th>
                                                    <th>LAB No</th>
                                                    <th>NHS No</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input class="form-control" type="text" id="first_name" name="first_name">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" id="sur_name" name="sur_name">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" id="emis_no" name="emis_no">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" id="lab_no" name="lab_no">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" id="nhs_no" name="nhs_no">
                                                    </td>
                                                </tr>
                                            </table>
                                            <div class="pull-right">
                                                <button type="submit" class="btn btn-warning">Search</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Inbox</h3>
                            </div>
                            <div class="panel-body">
                                <?php echo anchor('pm', '<strong style="padding-left:4px;"><img src="' . base_url('assets/img/view_record.png') . '">&nbsp;&nbsp;&nbsp;Message Center</strong>', 'title="check inbox"'); ?>
                                <?php echo anchor('admin/viewIncidentReports', '<strong style="padding-left:4px;"><img src="' . base_url('assets/img/view_record.png') . '">&nbsp;&nbsp;&nbsp;Incident Reports</strong>', 'title="check inbox"'); ?>
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Other Options</h3>
                            </div>
                            <div class="panel-body">
                                <?php echo anchor('admin/logoutAllUsers', '<strong style="padding-left:4px;">Logged Out All Users</strong>', 'class="logout-all-users"'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Courier & Clinic Dates</h3>
                            </div>
                            <div class="panel-body">
                                <?php echo anchor('admin/show_hospital_clinic_dates', '<strong style="font-size:15px;"><img src="' . base_url('assets/img/clinic_dates.png') . '">&nbsp;&nbsp;&nbsp;Add Clinic Dates</strong>', 'title="Add Clinic Dates"'); ?>
                                <hr>
                                <?php echo anchor('admin/show_courier', '<strong style="font-size:15px;"><img src="' . base_url('assets/img/courier.png') . '">&nbsp;&nbsp;&nbsp;Courier</strong>', 'title="Courier"'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h3>Failed Login Attempts</h3>
                        <table id="failed_login_attempts_table" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr class="info">
                                    <th>IP Address</th>
                                    <th>User Email</th>
                                    <th>Login Time</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr class="info">
                                    <th>IP Address</th>
                                    <th>User Email</th>
                                    <th>Login Time</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                if (!empty($failed_attempts)) {
                                    foreach ($failed_attempts as $attempts) {
                                        ?>
                                <tr>
                                    <td>
                                        <?php echo $attempts->ip_address; ?>
                                    </td>
                                    <td>
                                        <?php echo $attempts->login; ?>
                                    </td>
                                    <td>
                                        <?php echo date('d-m-Y h:i A', $attempts->time); ?>
                                    </td>
                                </tr>
                                <?php
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h3>User Tracking</h3>
                        <table id="user_tracking_table" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr class="info">
                                    <th>IP</th>
                                    <th>Email</th>
                                    <th>Login</th>
                                    <th>Logout</th>
                                    <th>Activity</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr class="info">
                                    <th>IP</th>
                                    <th>Email</th>
                                    <th>Login</th>
                                    <th>Logout</th>
                                    <th>Activity</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php 
                                if (!empty($tracking)) { 
                                    foreach ($tracking as $user_tracking) { ?>
                                <tr>
                                    <td>
                                        <?php echo $user_tracking->client_ip; ?>
                                    </td>
                                    <td>
                                        <?php echo $user_tracking->session_identity; ?>
                                    </td>
                                    <td>
                                        <?php echo date('d-m-Y h:i A', $user_tracking->login_time); ?>
                                    </td>
                                    <td>
                                        <?php
                                        if (!empty($user_tracking->logout_time)) {
                                            echo date('d-m-Y h:i A', $user_tracking->logout_time);
                                        } ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('index.php/admin/get_user_activity/' . $user_tracking->session_userid); ?>">
                                            <img src="<?php echo base_url('assets/img/view.png'); ?>">
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                    } ?>
                                <?php
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>