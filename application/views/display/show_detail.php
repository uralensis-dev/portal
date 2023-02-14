<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--Search Code Start-->
<div class="row">
    <div class="col-md-12">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-info">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
<!--Search Code End-->
<?php
if ($this->session->flashdata('account_lock_status') != '') {
    echo $this->session->flashdata('account_lock_status');
}
if ($this->session->flashdata('account_unlock_status') != '') {
    echo $this->session->flashdata('account_unlock_status');
}
?>
<hr>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <?php
    $count = 1;
    foreach ($show_users_query as $users_data) :
        ?>
        <div class="panel panel-info">
            <div class="panel-heading" role="tab" id="heading-<?php echo $count; ?>">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#record_detail-<?php echo $count; ?>" aria-expanded="true" aria-controls="record_detail-<?php echo $count; ?>">
                        User : <?php echo $users_data->first_name . ' ' . $users_data->last_name; ?>
                    </a>
                </h4>
            </div>
            <div id="record_detail-<?php echo $count; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-<?php echo $count; ?>">
                <div class="panel-body">
                    <?php
                    $user_status = '';
                    $user_login_status = $users_data->user_status;
                    $user_login_time = $users_data->user_login_time;
                    $user_logout_time = $users_data->user_logout_time;

                    $login_time = date_create($user_login_time);
                    $logout_time = date_create($user_logout_time);
                    $user_spent_time = date_diff($login_time, $logout_time);

                    if ($user_login_status == 'true') {
                        $user_status = '<span class="label label-success" style="font-size:12px;">Logged In</span>';
                    } elseif ($user_login_status == 'false') {
                        $user_status = '<span class="label label-warning" style="font-size:12px;">Logged Out</span>';
                    } else {
                        $user_status = '<span class="label label-danger" style="font-size:12px;">Not Yet Login</span>';
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="well" style="text-align:center;">
                                <span class="label label-default" style="font-size:12px;">Account Status : </span>

                                <?php
                                if ($users_data->active == 1) {
                                    echo '<span class="label label-success" style="font-size:12px;">Un-Locked</span>';
                                } else {
                                    echo '<span class="label label-danger" style="font-size:12px;">Locked</span>';
                                }
                                ?>
                                <hr>
                                <form action="<?php echo base_url('index.php/admin/change_account_status/' . $users_data->user_id); ?>" method="post">
                                    <div class="form-group">
                                        <label for="account_lock_status">Change Account Status (Locked / Unlocked)</label>
                                        <select id="account_lock_status" name="account_lock_status">
                                            <option value="lock">Lock</option>
                                            <option value="unlock">Unlock</option>
                                        </select>
                                        <button id="change_account_status">Change Status</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="well" style="text-align:center;">
                                        <span class="label label-default" style="font-size:12px;">User Status : </span>
                                        <?php echo $user_status; ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="well" style="text-align:center;">
                                        <span class="label label-default" style="font-size:12px;">Login At : </span>
                                        <span class="label label-success" style="font-size:12px;"><?php echo $user_login_time; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="well" style="text-align:center;">
                                        <span class="label label-default" style="font-size:12px;">Logout At : </span>
                                        <span class="label label-success" style="font-size:12px;"><?php echo $user_logout_time; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="well" style="text-align:center;">
                                        <span class="label label-default" style="font-size:12px;">Time Spent : </span>
                                        <span class="label label-success" style="font-size:12px;"><?php echo $user_spent_time->format("%H Hours and %i Minutes and %s Seconds"); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="well" style="text-align:center;">
                                        <span class="label label-default" style="font-size:12px;">User IP : </span>
                                        <span class="label label-success" style="font-size:12px;"><?php echo $users_data->user_logged_ip; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $count++;
    endforeach;
    ?>
</div>
