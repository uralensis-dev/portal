<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="tg-dashboardbox">
        <div class="col-md-12">
            <div class="tg-dashboardboxtitle">
                <a href="<?php echo base_url('index.php/admin/home'); ?>">
                    <button class="btn btn-primary">Go Back</button>
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-responsive">
                <tr>
                    <th>IP</th>
                    <th>Login Time</th>
                    <th>Logout Time</th>
                    <th>Request URL</th>
                    <th>Agent</th>
                    <th>Platform</th>
                    <th>Request Origin</th>

                </tr>
                <?php if (!empty($user_activity)) { ?>
                    <?php foreach ($user_activity as $activity) { ?>
                        <tr>
                            <td><?php echo $activity->user_activity_ip; ?></td>
                            <td>
                                <?php
                                if (!empty($activity->user_activity_login_time)) {
                                    echo date("d-m-Y h:i:s A T",$activity->user_activity_login_time);
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($activity->user_activity_logout_time)) {
                                    echo date('d-m-Y h:i:s A T', $activity->user_activity_logout_time);
                                }
                                ?>
                            </td>
                            <td><?php echo $activity->request_uri; ?></td>
                            <td><?php echo $activity->client_user_agent; ?></td>
                            <td><?php echo $activity->user_agent_platform; ?></td>
                            <td><?php echo $activity->referer_page; ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>
        </div>
    </div>
</div>