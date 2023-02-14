<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-md-12">
        <hr>
        <div class="panel-group" id="accordion">
            <?php
            $count = 0;
            for ($i = 0; $i <= 29; $i++) {
                $day_name = date('l d F Y', strtotime('-' . $i . ' days'));
                $current_date = date('Y-m-d', strtotime('-' . $i . ' days'));
                 $session_record_data = uralensis_get_db_session_records_data($current_date);
                            if (!empty($session_record_data)) {
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
                                            <td><?php echo uralensisGetUsername($value['ura_track_sess_rec_user_id']); ?></td>
                                            <td><?php echo date('d-m-Y H:i:s', $value['timestamp']); ?></td>
                                            <td><a href="<?php echo base_url('index.php/institute/print_session_records_document/'.$value['ura_track_sess_rec_id']); ?>" target="_blank">View PDF Report</a></td>
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
                            }
                $count++;
            }
            ?>
        </div>
    </div>
</div>