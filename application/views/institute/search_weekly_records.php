<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <a class="btn btn-default" href="<?php echo base_url('index.php/institute/'); ?>"><span class="lnr lnr-arrow-left"></span>&nbsp;&nbsp;Go Back</a>
        <hr>
        <?php
        if (!empty($weekly_day_data)) {
            ?>
            <table id="display_submitted_records" class="table table-striped">
                <thead>
                    <tr class="info">
                        <th>Serial No</th>
                        <th>Track No</th>
                        <th>First Name</th>
                        <th>Sur Name</th>
                        <th>EMIS No</th>
                        <th>NHS No.</th>
                        <th>LAB No.</th>
                        <th>Gender</th>
                        <th>Request Time</th>
                        <th>Detail</th>
                        <th>View Report</th>
                        <th>Download Report</th>
                        <th>Documents</th>
                        <th class="text-center">Flag</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="info">
                        <th>Serial No</th>
                        <th>Track No</th>
                        <th>First Name</th>
                        <th>Sur Name</th>
                        <th>EMIS No</th>
                        <th>NHS No.</th>
                        <th>LAB No.</th>
                        <th>Gender</th>
                        <th>Request Time</th>
                        <th>Detail</th>
                        <th>View Report</th>
                        <th>Download Report</th>
                        <th>Documents</th>
                        <th class="text-center">Flag</th>
                        <th>&nbsp;</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $flag_count = 11;
                    foreach ($weekly_day_data as $row) {
                        ?>
                        <tr>
                            <td style="font-size:11px;font-weight: bold;"><?php echo $row['serial_number']; ?></td>
                            <td><?php echo $row['ura_barcode_no']; ?></td>
                            <td><?php echo html_purify($row['f_name']); ?></td>
                            <td><?php echo html_purify($row['sur_name']); ?></td>
                            <td><?php echo html_purify($row['emis_number']); ?></td>
                            <td><?php echo $row['nhs_number']; ?></td>
                            <td><?php echo html_purify($row['lab_number']); ?></td>
                            <td><?php echo html_purify($row['gender']); ?></td>
                            <td><?php echo $row['request_datetime']; ?></td>
                            <td><a href="<?php echo site_url() . '/Institute/view_singlerecord/' . intval($row['uralensis_request_id']); ?>"><img src="<?php echo base_url('assets/img/detail.png'); ?>"></a></td>
                            <?php
                            if ($row['specimen_publish_status'] == 1) :

                                echo '<td><a target="_blank" href="' . site_url('Institute/view_single_final/' . intval($row['uralensis_request_id'])) . '">View Report</a></td>';

                            else :
                                echo '<td><span>Not Submitted by Dr.</span></td>';
                            endif;
                            ?>
                            <?php
                            if ($row['specimen_publish_status'] == 1) :

                                echo '<td><a href="' . site_url('Institute/download_pdf/' . intval($row['uralensis_request_id'])) . '"><img src="' . base_url('assets/img/download.png') . '">Download Report</a></td>';

                            else :
                                echo '<td><span>Not Submitted by Dr.</span></td>';
                            endif;
                            ?>
                            <td>
                                <a href="<?php echo site_url() . '/institute/institute_download_section/' . intval($row['uralensis_request_id']); ?>"><img src="<?php echo base_url('assets/img/adobe.png'); ?>" />&nbsp;Docs</a>
                            </td>
                            <td class="flag_column">
                                <div class="hover_flags">
                                    <div class="flag_images">
                                        <?php if ($row['flag_status'] === 'flag_red') { ?>
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_red.png'); ?>">
                                        <?php } elseif ($row['flag_status'] === 'flag_yellow') { ?>
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked for typing." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_yellow.png'); ?>">
                                        <?php } elseif ($row['flag_status'] === 'flag_blue') { ?>
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked for Pre-Authorization." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_blue.png'); ?>">
                                        <?php } elseif ($row['flag_status'] === 'flag_black') { ?>
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked as further work." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_black.png'); ?>">
                                        <?php } elseif ($row['flag_status'] === 'flag_gray') { ?>
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked as awaiting reviews." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_gray.png'); ?>">
                                        <?php } else { ?>
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked as released." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_green.png'); ?>">
                                        <?php } ?>
                                    </div>
                                    <ul class="report_flags list-unstyled list-inline" style="display:none;">
                                        <?php
                                        $active = '';
                                        if ($row['flag_status'] === 'flag_green') {
                                            $active = 'flag_active';
                                        }
                                        ?>
                                        <li class="<?php echo $active; ?>">
                                            <a href="javascript:;" data-flag="flag_green" data-serial="<?php echo html_purify($row['serial_number']); ?>" data-recordid="<?php echo intval($row['uralensis_request_id']); ?>" class="flag_change">
                                                <img data-toggle="tooltip" data-placement="top" title="This case marked as released." src="<?php echo base_url('assets/img/flag_green.png'); ?>">
                                            </a>
                                        </li>
                                        <?php
                                        $active = '';
                                        if ($row['flag_status'] === 'flag_red') {
                                            $active = 'flag_active';
                                        }
                                        ?>
                                        <li class="<?php echo $active; ?>">
                                            <a href="javascript:;" data-flag="flag_red" data-serial="<?php echo html_purify($row['serial_number']); ?>" data-recordid="<?php echo intval($row['uralensis_request_id']); ?>" class="flag_change">
                                                <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="<?php echo base_url('assets/img/flag_red.png'); ?>">
                                            </a>
                                        </li>
                                        <?php
                                        $active = '';
                                        if ($row['flag_status'] === 'flag_yellow') {
                                            $active = 'flag_active';
                                        }
                                        ?>
                                        <li class="<?php echo $active; ?>">
                                            <a href="javascript:;" data-flag="flag_yellow" data-serial="<?php echo html_purify($row['serial_number']); ?>" data-recordid="<?php echo intval($row['uralensis_request_id']); ?>" class="flag_change">
                                                <img data-toggle="tooltip" data-placement="top" title="This case marked for typing." src="<?php echo base_url('assets/img/flag_yellow.png'); ?>">
                                            </a>
                                        </li>
                                        <?php
                                        $active = '';
                                        if ($row['flag_status'] === 'flag_blue') {
                                            $active = 'flag_active';
                                        }
                                        ?>
                                        <li class="<?php echo $active; ?>">
                                            <a href="javascript:;" data-flag="flag_blue" data-serial="<?php echo html_purify($row['serial_number']); ?>" data-recordid="<?php echo intval($row['uralensis_request_id']); ?>" class="flag_change">
                                                <img data-toggle="tooltip" data-placement="top" title="This case marked for pre authorization." src="<?php echo base_url('assets/img/flag_blue.png'); ?>">
                                            </a>
                                        </li>
                                        <?php
                                        $active = '';
                                        if ($row['flag_status'] === 'flag_black') {
                                            $active = 'flag_active';
                                        }
                                        ?>
                                        <li class="<?php echo $active; ?>">
                                            <a href="javascript:;" data-flag="flag_black" data-serial="<?php echo html_purify($row['serial_number']); ?>" data-recordid="<?php echo intval($row['uralensis_request_id']); ?>" class="flag_change">
                                                <img data-toggle="tooltip" data-placement="top" title="This case marked further work." src="<?php echo base_url('assets/img/flag_black.png'); ?>">
                                            </a>
                                        </li>
                                        <?php
                                        $active = '';
                                        if ($row['flag_status'] === 'flag_gray') {
                                            $active = 'flag_active';
                                        }
                                        ?>
                                        <li class="<?php echo $active; ?>">
                                            <a href="javascript:;" data-flag="flag_gray" data-serial="<?php echo html_purify($row['serial_number']); ?>" data-recordid="<?php echo intval($row['uralensis_request_id']); ?>" class="flag_change">
                                                <img data-toggle="tooltip" data-placement="top" title="This case marked awaiting reviews." src="<?php echo base_url('assets/img/flag_gray.png'); ?>">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="comments_icon">
                                    <a href="javascript:;" id="display_comment_box" class="display_comment_box" data-recordid="<?php echo intval($row['uralensis_request_id']); ?>" data-modalid="<?php echo $flag_count; ?>">
                                        <img src="<?php echo base_url('assets/img/information.png'); ?>">
                                    </a>
                                    <a href="javascript:;" id="show_comments_list" class="show_comments_list" data-recordid="<?php echo intval($row['uralensis_request_id']); ?>" data-modalid="<?php echo $flag_count; ?>">
                                        <img src="<?php echo base_url('assets/img/chat_comments.png'); ?>">
                                    </a>
                                </div>
                                <div id="flag_comment_model-<?php echo $flag_count; ?>" class="flag_comment_model modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Flag Reason Comment</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="flag_msg"></div>
                                                <form class="form flag_comments" id="flag_comments_form">
                                                    <div class="form-group">
                                                        <textarea name="flag_comment" id="flag_comment" class="form-control flag_comment"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <hr>
                                                        <input type="hidden" name="record_id" value="<?php echo intval($row['uralensis_request_id']); ?>">
                                                        <a class="btn btn-primary" id="flag_comments_save" href="javascript:;">Save Comments</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="display_comments_list-<?php echo $flag_count; ?>" class="modal fade display_comments_list" role="dialog" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Flag Comments</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="display_flag_msg"></div>
                                                <div class="flag_comments_dynamic_data"></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><p style="display:none;"><?php echo $row['flag_status']; ?></p></td>
                        </tr>
                        <?php
                        $flag_count++;
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } else {
            echo '<div class="alert alert-danger">No Record Found.</div>';
        }
        ?>
    </div>
</div>