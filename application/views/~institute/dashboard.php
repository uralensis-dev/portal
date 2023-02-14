<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $user_id = $this->ion_auth->user()->row()->id; ?>
<div class="tg-dashboard">
    <div class="row">
        <div class="container">
            <div class="tg-contactcompanyholder">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="tg-companyuserpic">
                        <div class="tg-hospitaluser">
                            <div class="tg-usercontent">
                                <span><?php echo uralensis_get_welcome_message(); ?></span>
                                <h3> <?php echo uralensis_get_hospital_name(''); ?> </h3>
                            </div>
                        </div>
                        <div class="tg-hospitaluser tg-useradmin">
                            <?php uralensis_get_user_detail('true', 'true', 'bottom'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="tg-contactarea">
                        <a class="tg-btnedite" target="_blank" href="<?php echo base_url('index.php/institute/profile_form'); ?>"><i class="fa fa-pencil"></i><span>Edit</span></a>
                        <ul class="tg-contactus">
                            <li class="tg-email"><span class="tg-contacticon"><i class="lnr lnr-envelope"></i></span><a href="mailto:<?php echo uralensis_get_contact_db_details('email'); ?>"><?php echo uralensis_get_contact_db_details('email'); ?></a></li>
                            <li class="tg-phone"><span class="tg-contacticon"><i class="lnr lnr-phone"></i></span><em><a href="tel:<?php echo uralensis_get_contact_db_details('phone'); ?>"><?php echo uralensis_get_contact_db_details('phone'); ?></a></em></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="tg-trackspecimens">
                <?php
                $monday = strtotime("last monday");
                $monday = date('w', $monday) == date('w') ? $monday + 7 * 86400 : $monday;
                $current_date = date('Y-m-d', $monday);
                if (isset($_GET['date'])) {
                    $this_week_ed = date('Y-m-d', strtotime('+7 days', strtotime($_GET['date'])));
                    $this_week_sd = $_GET['date'];
                    $prev_date = date('Y-m-d', strtotime('-7 days', strtotime($_GET['date'])));
                    $next_date = $this_week_ed;
                } else {
                    $monday = strtotime("last monday");
                    $monday = date('w', $monday) == date('w') ? $monday + 7 * 86400 : $monday;
                    $sunday = strtotime(date("Y-m-d", $monday) . " +6 days");
                    $this_week_sd = date("Y-m-d", $monday);
                    $this_week_ed = date("Y-m-d", $sunday);
                    $prev_date = date('Y-m-d', strtotime('-7 days', strtotime($this_week_sd)));
                    $next_date = date('Y-m-d', strtotime('+7 days', strtotime($this_week_sd)));
                    $current_date = date('Y-m-d', $monday);
                }
                ?>
                <div class="tg-specimemtablearea">
                    <a class="btn btn-default pull-left" href="<?php echo base_url('index.php/institute?date=' . $prev_date); ?>"><span class="lnr lnr-arrow-left"></span>&nbsp;&nbsp;Previous</a>
                    <a class="btn btn-default pull-left" href="<?php echo base_url('index.php/institute?date=' . $current_date); ?>">&nbsp;&nbsp;Current</a>
                    <?php if (strtotime($next_date) <= strtotime(date('Y-m-d'))) { ?>
                        <a class="btn btn-default pull-left" href="<?php echo base_url('index.php/institute?date=' . $next_date); ?>">Next&nbsp;&nbsp;<span class="lnr lnr-arrow-right"></span></a>
                    <?php } ?>
                    <a href="#demo" data-toggle="collapse" class="pull-right select-period-tat-report">Select Period&nbsp;&nbsp;&nbsp;&nbsp;<i class="lnr lnr-cog"></i></a>
                    <div class="clearfix"></div>
                    <span><label class="label label-success" style="font-size:13px;">From: <?php echo isset($_GET['start_date']) ? date('Y-m-d', strtotime($_GET['start_date'])) : $this_week_sd; ?></label></span>
                    <span><label class="label label-success" style="font-size:13px;">To: <?php echo isset($_GET['end_date']) ? date('Y-m-d', strtotime($_GET['end_date'])) : $this_week_ed; ?></label></span>
                    <div class="clearfix"></div>
                    <div id="demo" class="collapse">
                        <hr>
                        <form class="form form-horizontal" method="get">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input style="margin-top:0px;" class="form-control tat_rec_from" type="text" name="start_date" placeholder="From Date">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input style="margin-top:0px;" class="form-control tat_rec_to" type="text" name="end_date" placeholder="To Date">
                                    <input type="hidden" name="mode" value="period" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <?php
                    $start_date = '';
                    $end_date = '';
                    if (isset($_GET['mode']) && $_GET['mode'] === 'period') {
                        $start_date = date("Y-m-d", strtotime($_GET['start_date']));
                        $end_date = date("Y-m-d", strtotime($_GET['end_date']));
                    }
                    if (!empty($hos_tat_rec_data) && isset($_GET['mode']) && $_GET['mode'] === 'period') {
                        ?>
                        <table class="table table-bordered dashboard-total-reports">
                            <tr class="bg-primary">
                                <th>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Doctor">
                                        <i class="lnr lnr-user"></i>
                                    </a>
                                </th>
                                <th>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Specimen Type">
                                        <i class="lnr lnr-layers"></i>
                                    </a>
                                </th>
                                <th>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Urgent">
                                        <i class="lnr lnr-cog"></i>
                                    </a>
                                </th>
                                <th>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Routine">
                                        <i class="lnr lnr-cog"></i>
                                    </a>
                                </th>
                                <th>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="2WW">
                                        <i class="lnr lnr-cog"></i>
                                    </a>
                                </th>
                                <th>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Total">
                                        <i class="lnr lnr-book"></i>
                                    </a>
                                </th>
                                <th>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Average TAT (Un-Reported)">
                                        <i class="lnr lnr-history"></i>
                                    </a>
                                </th>
                                <th>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Average TAT (Reported)">
                                        <i class="lnr lnr-undo"></i>
                                    </a>
                                </th>
                            </tr>
                            <?php
                            foreach ($hos_tat_rec_data as $key => $data) { ?>
                                <tr>
                                    <td><?php echo $data['Doctor']; ?></td>
                                    <td><?php echo ucwords($data['Specimen_Type']); ?></td>
                                    <td><?php echo $data['Urgent']; ?></td>
                                    <td><?php echo $data['Routine']; ?></td>
                                    <td><?php echo $data['TwoWW']; ?></td>
                                    <td><?php echo $data['Total']; ?></td>
                                    <td><span class="tg-notification-dashboard-tat"><?php echo uralensis_get_average_tat_calculate(intval($data['Hospital_ID']), intval($data['Doctor_ID']), 'unreport', $start_date, $end_date); ?></span></td>
                                    <td><span class="tg-notification-dashboard-tat"><?php echo uralensis_get_average_tat_calculate(intval($data['Hospital_ID']), intval($data['Doctor_ID']), 'report', $start_date, $end_date); ?></span></td>
                                </tr>
                            <?php } ?>
                        </table>
                    <?php } else { ?>
                        <?php if (!empty($this_week_sd) && !empty($this_week_ed)) { ?>
                            <table class="table table-bordered dashboard-total-reports">
                                <tr class="bg-primary">
                                    <th>Doctor</th>
                                    <?php
                                    for ($i = 0; $i <= 6; $i++) {
                                        $day_name = date('D ', strtotime($this_week_sd . $i . ' days'));
                                        ?>
                                        <th><?php echo $day_name; ?></th>
                                    <?php } ?>
                                    <th>Total</th>
                                    <!--<th>Total</th>-->
                                </tr>
                                <tr class="bg-primary">
                                    <th>&nbsp;</th>
                                    <?php
                                    for ($i = 0; $i <= 6; $i++) {
                                        $day_name = date('d/m/y', strtotime($this_week_sd . $i . ' days'));
                                        ?>
                                        <th><?php echo $day_name; ?></th>
                                    <?php } ?>
                                    <th>&nbsp;</th>
                                    <!--<th>Accum</th>-->
                                </tr>
                                <?php
                                if (!empty($hos_weekdays_tat_rec_data)) {
                                    $user_id = $this->ion_auth->user()->row()->id;
                                    $hospital_group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
                                    $count = 0;
                                    foreach ($hos_weekdays_tat_rec_data as $key => $data) {
                                        ?>
                                        <tr>
                                            <td><?php echo $data['Doctor']; ?></td>
                                            <?php
                                            $total_count = 0;
                                            $total_pub_count = 0;
                                            $total_unpub_count = 0;
                                            for ($i = 0; $i <= 6; $i++) {
                                                $day_name = date('D d/m/y', strtotime($this_week_sd . $i . ' days'));
                                                $current_date = date('Y-m-d', strtotime($this_week_sd . $i . ' days'));
                                                ?>
                                                <td>
                                                    <?php
                                                    $tat_record_data = uralensis_get_weekday_record_data($data['Doctor_ID'], $current_date, $hospital_group_id);
                                                    $encode_key_pub = $data['Doctor_ID'] . '|' . $hospital_group_id . '|' . $current_date . '|pub';
                                                    $encode_key_unpub = $data['Doctor_ID'] . '|' . $hospital_group_id . '|' . $current_date . '|unpub';
                                                    $encode_key_week_day_total = $data['Doctor_ID'] . '|' . $hospital_group_id . '|' . $current_date . '|week_day_total';
                                                    echo '<a href="' . base_url('index.php/institute/search_weekly_records?search_key=' . base64_encode($encode_key_week_day_total)) . '"><span class="blue-tat" data-toggle="tooltip" data-placement="top" title="Total Records">' . $tat_record_data[0]['Total_Cases'] . '</span></a><br>';
                                                    echo '<a href="' . base_url('index.php/institute/search_weekly_records?search_key=' . base64_encode($encode_key_pub)) . '"><span class="green-tat" data-toggle="tooltip" data-placement="top" title="Published Records">' . $tat_record_data[0]['Published'] . '</span></a><br>';
                                                    echo '<a href="' . base_url('index.php/institute/search_weekly_records?search_key=' . base64_encode($encode_key_unpub)) . '"><span class="red-tat" data-toggle="tooltip" data-placement="top" title="Un-Published Records">' . $tat_record_data[0]['UnPublished'] . '</span></a><br>';
                                                    $total_count = $total_count + $tat_record_data[0]['Total_Cases'];
                                                    $total_pub_count = $total_pub_count + $tat_record_data[0]['Published'];
                                                    $total_unpub_count = $total_unpub_count + $tat_record_data[0]['UnPublished'];

                                                    $encode_key_week_total = $data['Doctor_ID'] . '|' . $hospital_group_id . '|' . $this_week_sd . '|' . $this_week_ed . '|week_total';
                                                    $encode_key_pub_total = $data['Doctor_ID'] . '|' . $hospital_group_id . '|' . $this_week_sd . '|' . $this_week_ed . '|pub';
                                                    $encode_key_unpub_total = $data['Doctor_ID'] . '|' . $hospital_group_id . '|' . $this_week_sd . '|' . $this_week_ed . '|unpub';

                                                    $current_year = date('Y', strtotime($this_week_sd));
                                                    ?>
                                                </td>
                                            <?php } ?>
                                            <td>
                                                <?php
                                                echo '<a href="' . base_url('index.php/institute/search_weekly_records?search_key=' . base64_encode($encode_key_week_total) . '&mode=total') . '"><span class="blue-tat" data-toggle="tooltip" data-placement="top" title="Total Records">' . intval($total_count) . '</span></a><br>';
                                                echo '<a href="' . base_url('index.php/institute/search_weekly_records?search_key=' . base64_encode($encode_key_pub_total) . '&mode=total') . '"><span class="green-tat" data-toggle="tooltip" data-placement="top" title="Published Records">' . intval($total_pub_count) . '</span></a><br>';
                                                echo '<a href="' . base_url('index.php/institute/search_weekly_records?search_key=' . base64_encode($encode_key_unpub_total) . '&mode=total') . '"><span class="red-tat" data-toggle="tooltip" data-placement="top" title="Un-Published Records">' . intval($total_unpub_count) . '</span></a><br>';
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                }
                                ?>
                            </table>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="tg-trackinvoicearea">
                    <div class="tg-boxholder">
                        <div class="tg-boxholdercontent tg-trackspecimen">
                            <h4>TRACK SPECIMENS</h4>
                            <fieldset>
                                <div class="form-group tg-inputicon tg-inputwithicon-dashboard">
                                    <span class="lnr lnr-magnifier barcode_no_search_dashboard"></span>
                                    <input type="search" name="searchspecimen" class="form-control" placeholder="Track Number">
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="tg-boxholder">
                        <div class="tg-boxholdercontent tg-furthurwork">
                            <h4>FURTHER WORK REQUESTS</h4>
                            <span><?php echo uralensis_get_further_work_data(); ?></span>
                            <ul class="tg-viewprint">
                                <li class="tg-viewtrack"><a target="_blank" href="<?php echo base_url('index.php/institute/further_display_work'); ?>"><i class="fa fa-eye"></i></a></li>
                                <li class="tg-print"><a class="display_fw_print_opt" href="javascript:;" class=""><i class="fa fa-print"></i></a></li>
                            </ul>
                            <div class="fw_print_option haslayout hidden-boxes">
                                <hr>
                                <p>
                                    <a href="<?php echo base_url('index.php/institute/print_fw_records?fw_type=completed'); ?>">Complete</a>
                                    -- OR --
                                    <a href="<?php echo base_url('index.php/institute/print_fw_records?fw_type=requested'); ?>">Requested</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="tg-boxholder">
                        <div class="tg-boxholdercontent tg-invoices">
                            <h4>Invoices</h4>
                            <div class="tg-btnholder">
                                <a class="tg-btncurrent tg-btninvoices" target="_blank" href="<?php echo base_url('index.php/institute/generate_hospital_latest_invoice'); ?>"><span>Latest Invoice</span><i class="fa fa-angle-right"></i></a>
                                <a class="tg-accumulative tg-btninvoices" target="_blank" href="<?php echo base_url('index.php/institute/accumulative_invoices_display'); ?>"><span>Accumulative</span><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="tg-boxholder">
                        <div class="tg-boxholdercontent tg-courier">
                            <h4>Courier</h4>
                            <div class="tg-btnholder">
                                <a class="tg-btncurrent tg-btninvoices" href="javascript:;"><span>Courier Status</span><i class="fa fa-angle-right"></i></a>
                                <a class="tg-accumulative tg-btninvoices" href="javascript:;"><span>Previous Deliveries</span><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tg-dashboardtabsholder">
                <ul class="tg-navtabs" role="tablist">
                    <li role="presentation" class="active"><a href="#upload_center" aria-controls="lastlogin" role="tab" data-toggle="tab">Request Forms</a></li>
                    <li role="presentation"><a href="#client_documents" aria-controls="lastlogin" role="tab" data-toggle="tab">Client Documents</a></li>
                    <li role="presentation"><a href="#lastlogin" aria-controls="lastlogin" role="tab" data-toggle="tab">Last Login</a></li>
                    <li role="presentation"><a href="<?php echo base_url('index.php/pm'); ?>" >Message Board</a></li>
                    <li role="presentation"><a href="#documents" aria-controls="documents" role="tab" data-toggle="tab">Documents</a></li>
                    <li role="presentation"><a href="#reports" aria-controls="reports" role="tab" data-toggle="tab">Incident Reports</a></li>
                    <li role="presentation"><a href="#clinics" aria-controls="clinics" role="tab" data-toggle="tab">Clinics</a></li>
                </ul>
                <div class="tg-tabcontent tab-content">
                    <div role="tabpanel" class="tab-pane fade" id="lastlogin">
                        <div class="tg-borderheading">
                            <h3>Last Login</h3>
                        </div>
                        <div id="tg-accordion" class="tg-accordion" role="tablist" aria-multiselectable="true">
                            <div class="tg-panel">
                                <h4>Hospital Users (<?php echo count(uralensis_get_super_admin_login_screen()); ?>)<i class="fa fa-angle-right"></i></h4>
                                <div class="tg-panelcontent">
                                    <div class="tg-description">
                                        <div class="documents-scroll-holder ura-custom-scrollbar">
                                            <?php
                                            if (!check_user_role('show_login_users')) {
                                                echo 'You have not any privlege to access this content.';
                                            } else {
                                                $logged_in_users = uralensis_get_super_admin_login_screen();
                                                if (!empty($logged_in_users)) {
                                                    ?>
                                                    <table class="table table-bordered">
                                                        <tr class="bg-primary">
                                                            <th>User Type</th>
                                                            <th>Title</th>
                                                            <th>Date</th>
                                                            <th>Duration</th>
                                                            <th colspan="6">Actions</th>
                                                        </tr>
                                                        <?php
                                                        foreach ($logged_in_users as $log_users) {
                                                            $user_type = '';
                                                            if ($log_users['user_type'] === 'H') {
                                                                $user_type = 'Hospital';
                                                            }
                                                            $f_name = $this->ion_auth->user($log_users['id'])->row()->first_name;
                                                            $l_name = $this->ion_auth->user($log_users['id'])->row()->last_name;
                                                            $username = $f_name . ' ' . $l_name;

                                                            $user_login_time = '';
                                                            if (!empty($log_users['user_login_time'])) {
                                                                $user_login_time = date('d/m/Y - H:i', strtotime($log_users['user_login_time']));
                                                                $previous_time = strtotime($log_users['user_login_time']);
                                                                $current_time = time();

                                                                $seconds_diff = $current_time - $previous_time;
                                                                $time_diff = uralensis_get_time_format($previous_time, $current_time);
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td><?php echo html_purify($user_type); ?></td>
                                                                <td><?php echo html_purify($username); ?></td>
                                                                <td><?php echo $user_login_time; ?></td>
                                                                <td><?php echo $time_diff; ?></td>
                                                                <td><a href="javascript:;"><span class="lnr lnr-pencil"></span></a></td>
                                                                <td><a href="javascript:;"><span class="lnr lnr-lock"></span><span class="lnr lnr-sync"></span></a></td>
                                                                <td><a href="javascript:;"><span class="lnr lnr-envelope"></span></a></td>
                                                                <td><a href="javascript:;"><span class="lnr lnr-exit"></span></a></td>
                                                                <td><a href="javascript:;"><span class="lnr lnr-history"></span></a></td>
                                                                <td><a href="javascript:;"><span class="lnr lnr-trash"></span></a></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tg-panel">
                                <h4>Pathologists (<?php echo count(uralensis_get_hospital_assigned_doctors()); ?>)<i class="fa fa-angle-right"></i></h4>
                                <div class="tg-panelcontent">
                                    <div class="tg-description">
                                        <div class="documents-scroll-holder ura-custom-scrollbar">
                                            <?php
                                            $hospital_assign_doctors = uralensis_get_hospital_assigned_doctors();
                                            if (!empty($hospital_assign_doctors)) {
                                                ?>
                                                <table class="table table-bordered">
                                                    <tr class="bg-primary">
                                                        <th>User Type</th>
                                                        <th>Title</th>
                                                        <th>Date</th>
                                                        <!--<th>Duration</th>-->
                                                        <th colspan="6">Actions</th>
                                                    </tr>
                                                    <?php
                                                    foreach ($hospital_assign_doctors as $doc_data) {
                                                        $user_type = '';
                                                        if ($doc_data['user_type'] === 'D') {
                                                            $user_type = 'Doctor';
                                                        }
                                                        $f_name = $this->ion_auth->user($doc_data['id'])->row()->first_name;
                                                        $l_name = $this->ion_auth->user($doc_data['id'])->row()->last_name;
                                                        $username = $f_name . ' ' . $l_name;

                                                        $user_login_time = '';
                                                        if (!empty($doc_data['user_login_time'])) {
                                                            $user_login_time = date('d/m/Y - H:i', strtotime($doc_data['user_login_time']));
                                                            $previous_time = strtotime($doc_data['user_login_time']);
                                                            $current_time = time();

                                                            $seconds_diff = $current_time - $previous_time;
                                                            $time_diff = uralensis_get_time_format($previous_time, $current_time);
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td><?php echo html_purify($user_type); ?></td>
                                                            <td><?php echo html_purify($username); ?></td>
                                                            <td><?php echo $user_login_time; ?></td>
                                                            <!--<td><?php //echo $time_diff;                                                                                                                                             ?></td>-->
                                                            <td><a href="javascript:;"><span class="lnr lnr-pencil"></span></a></td>
                                                            <td><a href="javascript:;"><span class="lnr lnr-lock"></span><span class="lnr lnr-sync"></span></a></td>
                                                            <td><a href="javascript:;"><span class="lnr lnr-envelope"></span></a></td>
                                                            <td><a href="javascript:;"><span class="lnr lnr-exit"></span></a></td>
                                                            <td><a href="javascript:;"><span class="lnr lnr-history"></span></a></td>
                                                            <td><a href="javascript:;"><span class="lnr lnr-trash"></span></a></td>
                                                        </tr>
                                                    <?php } ?>
                                                </table>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane upload_center active fade in" id="upload_center">
                        <div class="tg-borderheading">
                            <h3>Request Forms</h3>
                        </div>
                        <div class="documents-scroll-holder ura-custom-scrollbar">
                            <span style="font-size: 30px;font-weight: bold;color:#00b3e5;" data-toggle="modal" data-target="#upload_docs" class="lnr lnr-upload"></span>
                            <div class="clearfix"></div>
                            <div id="upload_docs" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Upload Documents</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form upload_area_form">
                                                <?php
                                                $hospital_users = uralensis_get_all_hospital_users();
                                                if (!empty($hospital_users)) {
                                                    ?>
                                                    <p>Allow permissions for these users to view Upload Area</p>
                                                    <div class="form-group">
                                                        <?php
                                                        foreach ($hospital_users as $users) {
                                                            $first_name = $this->ion_auth->user($users['id'])->row()->first_name;
                                                            $last_name = $this->ion_auth->user($users['id'])->row()->last_name;
                                                            $username = $first_name . '&nbsp;' . $last_name;
                                                            ?>   
                                                            <label for=""><?php echo html_purify($username); ?></label>
                                                            <input type="checkbox" value="<?php echo intval($users['id']); ?>" name="upload_area_users[]">
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group">
                                                    <label>Upload your document here.</label>
                                                    <a id="upload_area_docs" href="javascript:;" class="btn btn-success"><span class="lnr lnr-upload"></span></a>
                                                    <div id="plupload-profile-container"></div>
                                                    <div class="profile-img-wrap"></div>
                                                </div>
                                                <input type="hidden" value="<?php echo intval($user_id); ?>" name="upload_area_users[]">
                                                <input type="hidden" name="upload_area_file_name" value="">
                                                <input type="hidden" name="upload_area_file_path" value="">
                                                <input type="hidden" name="upload_area_full_path" value="">
                                                <input type="hidden" name="upload_area_file_ext" value="">
                                                <button type="button" class="btn btn-primary upload_area_btn">Save Document</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if (!empty($upload_area)) { ?>
                                <table class="table table-bordered">
                                    <tr class="bg-primary">
                                        <th>Name</th>
                                        <th>Permissions</th>
                                        <th>Timestamp</th>
                                        <th colspan="2">Actions</th>
                                    </tr>
                                    <?php
                                    foreach ($upload_area as $docs) {
                                        //extract the serialize data

                                        $get_users_data = unserialize($docs['ura_upload_area_file_perms']);
                                        if (in_array($user_id, $get_users_data)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $docs['ura_upload_area_filename']; ?></td>
                                                <td>
                                                    <a data-toggle="modal" data-target="#change_permissions_<?php echo intval($docs['ura_upload_area_id']); ?>">Change Permissions</a>
                                                    <div id="change_permissions_<?php echo intval($docs['ura_upload_area_id']); ?>" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Change Permissions</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="update_upload_area_perm">
                                                                        <p>Allow permissions for these users to view Upload Area</p>
                                                                        <div class="form-group">
                                                                            <?php
                                                                            foreach ($hospital_users as $users) {
                                                                                $first_name = $this->ion_auth->user($users['id'])->row()->first_name;
                                                                                $last_name = $this->ion_auth->user($users['id'])->row()->last_name;
                                                                                $username = $first_name . '&nbsp;' . $last_name;
                                                                                $checked = '';
                                                                                if (!empty($get_users_data) && is_array($get_users_data)) {
                                                                                    if (in_array($users['id'], $get_users_data)) {
                                                                                        $checked = 'checked';
                                                                                    }
                                                                                }
                                                                                ?>   
                                                                                <label for=""><?php echo html_purify($username); ?></label>
                                                                                <input <?php echo $checked; ?> type="checkbox" value="<?php echo intval($users['id']); ?>" name="upload_area_change_perm_users[]">
                                                                            <?php } ?>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="hidden" value="<?php echo intval($user_id); ?>" name="upload_area_change_perm_users[]">
                                                                            <input type="hidden" name="file_id" value="<?php echo ($docs['ura_upload_area_id']); ?>">
                                                                            <button type="button" class="btn btn-primary update_file_perms">Update Permissions</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?php echo date('d/m/Y H:i:s', $docs['timestamp']); ?></td>
                                                
                                                <td><a class="download_request_form" data-fileid="<?php echo intval($docs['ura_upload_area_id']); ?>"><img src="<?php echo base_url('/assets/img/download.png'); ?>"></a></td>
                                                <td><a href="javascript:;" class="upload_area_delete_file" data-fileid="<?php echo intval($docs['ura_upload_area_id']); ?>" data-fullpath="<?php echo html_purify($docs['ura_upload_area_fullpath']); ?>"><img src="<?php echo base_url('/assets/img/delete.png'); ?>"></a></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </table>
                            <?php } ?>
                        </div>
                    </div>


                    <!--Client Documents Area Start-->
                    <div role="tabpanel" class="tab-pane client_documents" id="client_documents">
                        <div class="tg-borderheading">
                            <h3>Client Documents</h3>
                        </div>
                        <div class="documents-scroll-holder ura-custom-scrollbar">
                            <span style="font-size: 30px;font-weight: bold;color:#00b3e5;" data-toggle="modal" data-target="#client_doc_modal" class="lnr lnr-upload"></span>
                            <div class="clearfix"></div>
                            <div id="client_doc_modal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Upload Client Documents</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form cl_doc_upload_area_form">
                                                <?php
                                                $cl_doc_hospital_users = uralensis_get_all_hospital_users();
                                                if (!empty($cl_doc_hospital_users)) {
                                                    ?>
                                                    <p>Allow permissions for these users to view Upload Area</p>
                                                    <div class="form-group">
                                                        <?php
                                                        foreach ($cl_doc_hospital_users as $users) {
                                                            $first_name = $this->ion_auth->user($users['id'])->row()->first_name;
                                                            $last_name = $this->ion_auth->user($users['id'])->row()->last_name;
                                                            $username = $first_name . '&nbsp;' . $last_name;
                                                            ?>   
                                                            <label for=""><?php echo html_purify($username); ?></label>
                                                            <input type="checkbox" value="<?php echo intval($users['id']); ?>" name="upload_area_users[]">
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group">
                                                    <label>Upload your document here.</label>
                                                    <a id="cl_doc_upload_area_docs" href="javascript:;" class="btn btn-success"><span class="lnr lnr-upload"></span></a>
                                                    <div id="plupload-profile-container"></div>
                                                    <div class="cl-doc-profile-img-wrap"></div>
                                                </div>
                                                <input type="hidden" value="<?php echo intval($user_id); ?>" name="upload_area_users[]">
                                                <input type="hidden" name="upload_area_file_name" value="">
                                                <input type="hidden" name="upload_area_file_path" value="">
                                                <input type="hidden" name="upload_area_full_path" value="">
                                                <input type="hidden" name="upload_area_file_ext" value="">
                                                <button type="button" class="btn btn-primary cl_doc_upload_area_btn">Save Document</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if (!empty($cl_doc_upload_area)) { ?>
                                <table class="table table-bordered">
                                    <tr class="bg-primary">
                                        <th>Name</th>
                                        <th>Permissions</th>
                                        <th>Timestamp</th>
                                        <th colspan="3">Actions</th>
                                    </tr>
                                    <?php
                                    foreach ($cl_doc_upload_area as $docs) {
                                        //extract the serialize data

                                        $get_users_data = unserialize($docs['ura_upload_area_file_perms']);
                                        if (in_array($user_id, $get_users_data)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $docs['ura_upload_area_filename']; ?></td>
                                                <td>
                                                    <a data-toggle="modal" data-target="#change_permissions_<?php echo intval($docs['ura_upload_area_id']); ?>">Change Permissions</a>
                                                    <div id="change_permissions_<?php echo intval($docs['ura_upload_area_id']); ?>" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Change Permissions</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="cl_doc_update_upload_area_perm">
                                                                        <p>Allow permissions for these users to view Upload Area</p>
                                                                        <div class="form-group">
                                                                            <?php
                                                                            foreach ($hospital_users as $users) {
                                                                                $first_name = $this->ion_auth->user($users['id'])->row()->first_name;
                                                                                $last_name = $this->ion_auth->user($users['id'])->row()->last_name;
                                                                                $username = $first_name . '&nbsp;' . $last_name;
                                                                                $checked = '';
                                                                                if (!empty($get_users_data) && is_array($get_users_data)) {
                                                                                    if (in_array($users['id'], $get_users_data)) {
                                                                                        $checked = 'checked';
                                                                                    }
                                                                                }
                                                                                ?>   
                                                                                <label for=""><?php echo html_purify($username); ?></label>
                                                                                <input <?php echo $checked; ?> type="checkbox" value="<?php echo intval($users['id']); ?>" name="upload_area_change_perm_users[]">
                                                                            <?php } ?>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="hidden" value="<?php echo intval($user_id); ?>" name="upload_area_change_perm_users[]">
                                                                            <input type="hidden" name="file_id" value="<?php echo intval($docs['ura_upload_area_id']); ?>">
                                                                            <button type="button" class="btn btn-primary cl_doc_update_file_perms">Update Permissions</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?php echo date('d/m/Y H:i:s', $docs['timestamp']); ?></td>
                                                <td>
                                                    <a href="javascript:;" data-toggle="modal" data-target="#upload_area_view_file_<?php echo intval($docs['ura_upload_area_id']); ?>"><img src="<?php echo base_url('/assets/img/view.png'); ?>"></a>

                                                    <div id="upload_area_view_file_<?php echo intval($docs['ura_upload_area_id']); ?>" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <?php
                                                                    if ($docs['ura_upload_area_fileext'] === '.jpg' || $docs['ura_upload_area_fileext'] === '.png') {
                                                                        echo '<img src="' . $docs['ura_upload_area_filepath'] . '">';
                                                                    } elseif ($docs['ura_upload_area_fileext'] === '.pdf') {
                                                                        echo '<object type="application/pdf" width="900" height="900" data="' . $docs['ura_upload_area_filepath'] . '"></object>';
                                                                    } elseif ($docs['ura_upload_area_fileext'] === '.pptx') {
                                                                        echo '<object type="application/vnd.ms-powerpoint" data="' . $docs['ura_upload_area_filepath'] . '" style="height: 80vh;" width="100%"></object>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="<?php echo $docs['ura_upload_area_filepath']; ?>" download><img src="<?php echo base_url('/assets/img/download.png'); ?>"></a></td>
                                                <td><a href="javascript:;" class="cl_doc_upload_area_delete_file" data-fileid="<?php echo intval($docs['ura_upload_area_id']); ?>" data-fullpath="<?php echo $docs['ura_upload_area_fullpath']; ?>"><img src="<?php echo base_url('/assets/img/delete.png'); ?>"></a></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </table>
                            <?php } ?>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="messageboard">
                        <div class="tg-borderheading">
                            <h3>Message Board</h3>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="documents">
                        <div class="tg-borderheading">
                            <h3>Documents</h3>
                        </div>
                        <div class="documents-scroll-holder ura-custom-scrollbar">
                            <?php if ($hospital_docs) { ?>
                                <table class="table table-bordered">
                                    <tr class="bg-primary">
                                        <th>File Name</th>
                                        <th>Uploaded By</th>
                                        <th>Uploaded On</th>
                                        <th colspan="3">Action</th>
                                    </tr>
                                    <?php foreach ($hospital_docs as $docs) { ?>
                                        <tr>
                                            <td><?php echo html_purify($docs->title); ?></td>
                                            <td><?php echo ucwords($docs->user); ?></td>
                                            <td><?php echo $docs->upload_date; ?></td>
                                            <td><a target="_blank" href="<?php echo base_url('uploads/' . $docs->file_name); ?>"><span class="lnr lnr-eye"></span></a></td>
                                            <td><a download href="<?php echo base_url('uploads/' . $docs->file_name); ?>"><span class="lnr lnr-download"></span></a></td>
                                            <td><a class="delete_hospital_doc" data-filesid="<?php echo intval($docs->files_id); ?>" href=""><span class="lnr lnr-trash"></span></a></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            <?php } ?>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="reports">
                        <div class="tg-borderheading">
                            <h3>Incident Reports</h3>
                        </div>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#incident_report_modal">Add Incident Report</button>
                        <button class="btn btn-primary" data-toggle="collapse" data-target="#archive_reports">Archive Reports</button>

                        <div id="archive_reports" class="collapse">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>View</th>
                                        <th>Added By</th>
                                        <th>Timestamp</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($incident_reports)) { 
                                        foreach($incident_reports as $key => $value) {
                                        ?>
                                    <tr>
                                        <td><?php echo intval($value['ura_incident_reports_id']); ?></td>
                                        <td><a href="<?php echo base_url('index.php/institute/viewIncidentReport/'.intval($value['ura_incident_reports_id'])); ?>"><img src="<?php echo base_url('assets/img/view.png'); ?>"></a></td>
                                        <td><?php echo uralensisGetUsername($value['ura_incident_user_id'], 'fullname'); ?></td>
                                        <td><?php echo date('d-m-Y H:i:s', $value['timestamp']); ?></td>
                                        <th><a href="<?php echo base_url('index.php/institute/editIncidentReport/'.intval($value['ura_incident_reports_id'])); ?>"><img src="<?php echo base_url('assets/img/edit.png'); ?>"></a></th>
                                        <td><a href="javascript:;" class="delete_incident_report" data-recordid="<?php echo  intval($value['ura_incident_reports_id']); ?>"><img src="<?php echo base_url('assets/img/delete.png'); ?>"></a></td>
                                    </tr>
                                    <?php }
                                 } ?>
                                </tbody>
                                
                            </table>
                        </div>
                        <div id="incident_report_modal" class="modal fade incident_report_modal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modal Header</h4>
                            </div>
                            <div class="modal-body">
                                <div class="custom-form-scroll">
                                    <form class="form save_incident_report_form">
                                    <fieldset>
                                    <strong>Details of Person Reporting the Incident</strong>
                                        <div class="form-group">
                                            <label class="form-label">Type</label>
                                            <input type="text" name="person_type" class="form-control" placeholder="Type">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Subtype</label>
                                            <input type="text" name="person_subtype" class="form-control" placeholder="Subtype">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="person_title" class="form-control" placeholder="Title">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">First Name</label>
                                            <input type="text" name="person_first_name" class="form-control" placeholder="First Name">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Surname</label>
                                            <input type="text" name="person_surname" class="form-control" placeholder="Surname">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Telephone</label>  
                                            <input type="number" name="person_telephone" class="form-control" placeholder="Telephone">
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                    <strong>Incident Details</strong>
                                        <div class="form-group">
                                            <label class="form-label">Incident Date</label>
                                            <input type="date" name="inc_detail_date" class="form-control" placeholder="Incident Date">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Time</label>
                                            <input type="time" name="inc_detail_time" class="form-control" placeholder="Time">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Main Location</label>
                                            <input type="text" name="inc_detail_main_loca" class="form-control" placeholder="Main Location">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Division</label>
                                            <input type="text" name="inc_detail_division" class="form-control" placeholder="Division">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Specialty</label>
                                            <input type="text" name="inc_detail_specialty" class="form-control" placeholder="Specialty">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Location (type)</label>
                                            <input type="text" name="inc_detail_loca_type" class="form-control" placeholder="Location (type)">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Location (exact)</label>
                                            <input type="text" name="inc_detail_loca_exact" class="form-control" placeholder="Location (exact)">
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                    <strong>Description and Immediate Action Taken</strong>
                                        <div class="form-group">
                                        <label class="form-label">Description of incident</label>
                                            <input type="text" name="desc_immed_desc_inci" class="form-control" placeholder="Description of incident">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Immediate action taken</label>
                                            <input type="text" name="desc_immed_immediate_action" class="form-control" placeholder="Immediate action taken">
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                    <strong>Type of Incident and Result</strong>
                                        <div class="form-group">
                                        <label class="form-label">Type of Incident</label>
                                            <input type="text" name="type_inci_type" class="form-control" placeholder="Type of Incident">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Detail</label>
                                            <input type="text" name="type_inci_detail" class="form-control" placeholder="Detail">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Adverse event</label>
                                            <input type="text" name="type_inci_adverse_event" class="form-control" placeholder="Adverse event">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Result</label>
                                            <input type="text" name="type_inci_result" class="form-control" placeholder="Result">
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                    <strong>Additional Information: People Affected</strong>
                                    <div class="well">
                                        <div class="form-group">
                                        <label class="form-label">Person Type</label>
                                            <input type="text" name="peop_affec1_type" class="form-control" placeholder="Person Type">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Title</label>
                                            <input type="text" name="peop_affec1_title" class="form-control" placeholder="Title">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">First names</label>
                                            <input type="text" name="peop_affec1_f_name" class="form-control" placeholder="First names">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Surname</label>
                                            <input type="text" name="peop_affec1_surname" class="form-control" placeholder="Surname">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Address</label>
                                            <input type="text" name="peop_affec1_address" class="form-control" placeholder="Address">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Postcode</label>
                                            <input type="text" name="peop_affec1_postcode" class="form-control" placeholder="Postcode">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Telephone</label>
                                            <input type="number" name="peop_affec1_tel" class="form-control" placeholder="Telephone">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Email</label>
                                            <input type="text" name="peop_affec1_email" class="form-control" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Gender</label>
                                            <input type="text" name="peop_affec1_gender" class="form-control" placeholder="Gender">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Ethnicity</label>
                                            <input type="text" name="peop_affec1_ethnicity" class="form-control" placeholder="Ethnicity">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Was the person injured in the incident?</label>
                                            <input type="text" name="peop_affec1_was_person_injur" class="form-control" placeholder="Was the person injured in the incident?">
                                        </div>
                                    </div>
                                    <div class="well">
                                        <div class="form-group">
                                        <label class="form-label">Person Type</label>
                                            <input type="text" name="peop_affec2_type" class="form-control" placeholder="Person Type">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Title</label>
                                            <input type="text" name="peop_affec2_title" class="form-control" placeholder="Title">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">First names</label>
                                            <input type="text" name="peop_affec2_f_name" class="form-control" placeholder="First names">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Surname</label>
                                            <input type="text" name="peop_affec2_surname" class="form-control" placeholder="Surname">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Address</label>
                                            <input type="text" name="peop_affec2_address" class="form-control" placeholder="Address">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Postcode</label>
                                            <input type="text" name="peop_affec2_postcode" class="form-control" placeholder="Postcode">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Telephone</label>
                                            <input type="number" name="peop_affec2_tel" class="form-control" placeholder="Telephone">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Email</label>
                                            <input type="text" name="peop_affec2_email" class="form-control" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Gender</label>
                                            <input type="text" name="peop_affec2_gender" class="form-control" placeholder="Gender">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Ethnicity</label>
                                            <input type="text" name="peop_affec2_ethnicity" class="form-control" placeholder="Ethnicity">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Was the person injured in the incident?</label>
                                            <input type="text" name="peop_affec2_was_person_injur" class="form-control" placeholder="Was the person injured in the incident?">
                                        </div>
                                    </div>
                                    </fieldset>
                                    <fieldset>
                                    <strong>Anyone else involved in the incident</strong>
                                        <div class="form-group">
                                        <label class="form-label">Other Contact</label>
                                            <input type="text" name="any_inv_inci_other_cont" class="form-control" placeholder="Other Contact">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">How was this person involved?</label>
                                            <input type="text" name="any_inv_inci_pers_inv" class="form-control" placeholder="How was this person involved?">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Type</label>
                                            <input type="text" name="any_inv_inci_type" class="form-control" placeholder="Type">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Title</label>
                                            <input type="text" name="any_inv_inci_title" class="form-control" placeholder="Title">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">First names</label>
                                            <input type="text" name="any_inv_inci_f_name" class="form-control" placeholder="First names">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Surname</label>
                                            <input type="text" name="any_inv_inci_surname" class="form-control" placeholder="Surname">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Address</label>
                                            <input type="text" name="any_inv_inci_address" class="form-control" placeholder="Address">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Postcode</label>
                                            <input type="text" name="any_inv_inci_postcode" class="form-control" placeholder="Postcode">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Telephone</label>
                                            <input type="number" name="any_inv_inci_tel" class="form-control" placeholder="Telephone">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Email</label>
                                            <input type="text" name="any_inv_inci_email" class="form-control" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Gender</label>
                                            <input type="text" name="any_inv_inci_gender" class="form-control" placeholder="Gender">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Ethnicity</label>
                                            <input type="text" name="any_inv_inci_ethnicity" class="form-control" placeholder="Ethnicity">
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                    <strong>Equipment Details</strong>
                                        <div class="form-group">
                                        <label class="form-label">Product Type</label>
                                            <input type="text" name="equip_detail_type" class="form-control" placeholder="Product Type">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Brand name</label>
                                            <input type="text" name="equip_detail_brand_name" class="form-control" placeholder="Brand name">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Serial No</label>
                                            <input type="text" name="equip_detail_serial_no" class="form-control" placeholder="Serial No">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Description of device</label>
                                            <input type="text" name="equip_detail_desc_device" class="form-control" placeholder="Description of device">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Description of effect</label>
                                            <input type="text" name="equip_detail_desc_effect" class="form-control" placeholder="Description of effect">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Current location</label>
                                            <input type="text" name="equip_detail_curr_loca" class="form-control" placeholder="Current location">
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                    <strong>Medication Involved</strong>
                                        <div class="form-group">
                                        <label class="form-label">Was this medication incident?</label>
                                            <input type="text" name="medic_inv_was_medic_inci" class="form-control" placeholder="Was this medication incident?">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Was this an incident of violence or aggression towards staff?</label>
                                            <input type="text" name="medic_inv_was_inci_viol" class="form-control" placeholder="Was this an incident of violence or aggression towards staff?">
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                    <strong>Security Involved Incident</strong>
                                        <div class="form-group">
                                        <label class="form-label">If Security was called or involved in this incident you must put “YES” in this box.</label>
                                            <input type="text" name="secur_inv_inci_was_medic_inci" class="form-control" placeholder="If Security was called or involved in this incident you must put “YES” in this box.">
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                    <strong>Dementia or Learning Difficulties</strong>
                                        <div class="form-group">
                                        <label class="form-label">Does this patient have dementia or learning Disabilities</label>
                                            <input type="text" name="dementia_learn_does_patient_dementia" class="form-control" placeholder="Does this patient have dementia or learning Disabilities">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Pressure Sore hospital or Community Acquired</label>
                                            <input type="text" name="dementia_learn_pressure_sore" class="form-control" placeholder="Pressure Sore hospital or Community Acquired">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Witnessed or Unwitnessed Patient Fall</label>
                                            <input type="text" name="dementia_learn_witness_patient_fall" class="form-control" placeholder="Witnessed or Unwitnessed Patient Fall">
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                    <strong>Incident Report</strong>
                                        <div class="form-group">
                                        <label class="form-label">Harm Level (see appendix 2)</label>
                                            <input type="text" name="incident_report_harm_level" class="form-control" placeholder="Harm Level (see appendix 2)">
                                        </div>
                                        <div class="form-group">
                                        <label class="form-label">Responsibility</label>
                                            <input type="text" name="incident_report_responsibility" class="form-control" placeholder="Responsibility">
                                        </div>
                                    </fieldset>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success pull-left save_incident_report_btn">Add Report</button>
                                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="clinics">
                        <div class="tg-borderheading">
                            <h3>Clinic Dates</h3>
                        </div>
                        <?php if (!empty($clinic_dates)) { ?>
                            <div class="documents-scroll-holder ura-custom-scrollbar">
                                <table class="table table-bordered">
                                    <tr class="bg-primary">
                                        <th><strong>Clinic Date</strong></th>
                                        <th><strong>Clinic Ref</strong></th>
                                        <th><strong>Status</strong></th>
                                        <th><strong>P</strong></th>
                                        <th><strong>S</strong></th>
                                        <th colspan="2"><strong>Checklist</strong></th>
                                    </tr>
                                    <?php
                                    foreach ($clinic_dates as $cl_dates) {
                                        //Format clinic date
                                        $change_date = date('d/m/Y', $cl_dates['ura_clinic_date']);
                                        ?>
                                        <tr>
                                            <td><?php echo $change_date; ?></td>
                                            <td><?php echo $cl_dates['ura_clinic_ref_no']; ?></td>
                                            <td></td>
                                            <td><?php echo $cl_dates['ura_clinic_total_patients']; ?></td>
                                            <td><?php echo $cl_dates['ura_clinic_total_samples']; ?></td>
                                            <td><a href="<?php echo base_url('index.php/institute/edit_clinic_date?rec_id=' . intval($cl_dates['ura_clinic_date_id']) . '&hopital_id=' . intval($cl_dates['ura_clinic_hospital_id']) . '&ref_key=' . $cl_dates['ura_clinic_ref_no']); ?>"><span class="lnr lnr-eye"></span></a></td>
                                            <td><a href="#"><span class="lnr lnr-trash"></span></a></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        <?php } ?>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tracking">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>