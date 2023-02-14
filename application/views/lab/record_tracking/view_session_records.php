<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-8">
                <h3 class="page-title">View Session Records</h3>
            </div>
            <div class="col-sm-4">
                <div class="pull-right">
                <!-- <a href="javascript:void(0);" id="doctor_advance_search"><i class="fa fa-cog fa-2x"></i></a> -->
                <!-- <a id="doctor_advance_search" class="btn btn-info btn-lg newbtn" href="javascript:void(0);"> Advance Search</a> -->
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-breadcrumbarea tg-searchrecordhold">
                    <ol class="tg-breadcrumb tg-breadcrumbvtwo">
                        <li><a href="javascript:;">Dashboard</a></li>
                        <li><a href="javascript:;">Record Tracking</a></li>
                    </ol>
                    <!-- <button class="btn btn-primary" data-toggle="collapse" data-target="#collapse_filter_hospital">Filter By Hospital</button> -->
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel-group" id="accordion">
                <?php
                $count = 0;
                for ($i = 0; $i <= 29; $i++) {
                    $day_name = date('l d F Y', strtotime('-' . $i . ' days'));
                    $current_date = date('Y-m-d', strtotime('-' . $i . ' days'));
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#sess_record_<?php echo $count; ?>">
                                    <?php echo $day_name; ?>
                                </a>
                            </h4>
                        </div>
                        <div id="sess_record_<?php echo $count; ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <?php
                                $session_record_data = uralensis_get_db_session_records_data($current_date);
                                if (!empty($session_record_data)) {
                                    ?>
                                    <table class="table table-bordered">
                                        <tr class="bg-primary">
                                            <th>ID</th>
                                            <th>Added By</th>
                                            <th>Timestamp</th>
                                            <th>Actions</th>
                                        </tr>
                                        <?php
                                        foreach ($session_record_data as $key => $value) {
                                            //extract the serialize data
                                            ?>
                                            <tr>
                                                <td><?php echo $value['ura_track_sess_rec_id']; ?></td>
                                                <td><?php echo uralensis_get_username($value['ura_track_sess_rec_user_id']); ?></td>
                                                <td><?php echo date('d-m-Y H:i:s', $value['timestamp']); ?></td>
                                                <td><a href="<?php echo base_url('index.php/doctor/print_session_records_document/'.$value['ura_track_sess_rec_id']); ?>" target="_blank">View PDF Report</a></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $count++;
                }
                ?>
            </div>
        </div>
    </div>
       
</div>