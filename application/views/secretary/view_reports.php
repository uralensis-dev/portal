<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="flag_sorting">
    <label for="flag_green">
        <input type="radio" name="flag_sorting" id="flag_green" class="flag_status">
        <img data-toggle="tooltip" data-placement="top" title="This case marked as released." src="<?php echo base_url('assets/img/flag_green.png'); ?>">
    </label>
    <label for="flag_red">
        <input type="radio" name="flag_sorting" id="flag_red" class="flag_status">
        <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="<?php echo base_url('assets/img/flag_red.png'); ?>">
    </label>
    <label for="flag_yellow">
        <input type="radio" name="flag_sorting" id="flag_yellow" class="flag_status">
        <img data-toggle="tooltip" data-placement="top" title="This case marked for typing." src="<?php echo base_url('assets/img/flag_yellow.png'); ?>">
    </label>
    <label for="flag_blue">
        <input type="radio" name="flag_sorting" id="flag_blue" class="flag_status">
        <img data-toggle="tooltip" data-placement="top" title="This case marked for pre authorization." src="<?php echo base_url('assets/img/flag_blue.png'); ?>">
    </label>
    <label for="flag_black">
        <input type="radio" name="flag_sorting" id="flag_black" class="flag_status">
        <img data-toggle="tooltip" data-placement="top" title="This case marked as further work." src="<?php echo base_url('assets/img/flag_black.png'); ?>">
    </label>
    <label for="flag_all">
        <input type="radio" name="flag_sorting" id="flag_all" class="flag_status">
        <img src="<?php echo base_url('assets/img/flag_all.png'); ?>">
    </label>
</div>

<div class="row report_listing">
    <div class="col-md-12">
        <div class="flag_message"></div>
        <table id="sec_view_records" class="table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr class="info">
                    <th>UL No.</th>
                    <th>First name</th>
                    <th>Surname</th>
                    <th>DOB.</th>
                    <th>PCI No.</th>
                    <th>EMIS No.</th>
                    <th>NHS No.</th>
                    <th>Lab. No.</th>
                    <th>Client</th>
                    <th>Type</th>
                    <th>Request Date:</th>
                    <th>Received by Lab.</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
                    <th class="text-center">Flag</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($records)) {
                    $flag_count = 11;
                    foreach ($records as $row) {
                        ?>
                        <tr>
                            <td><?php echo html_purify($row->serial_number); ?></td>
                            <td><?php echo html_purify($row->f_name); ?></td>
                            <td><?php echo html_purify($row->sur_name); ?></td>
                            <td><?php echo html_purify($row->dob); ?></td>
                            <td><?php echo html_purify($row->pci_number); ?></td>
                            <td><?php echo html_purify($row->emis_number); ?></td>
                            <td><?php echo html_purify($row->nhs_number); ?></td>
                            <td><?php echo html_purify($row->lab_number); ?></td>
                            <td><a data-toggle="tooltip" data-placement="top" title="<?php echo $this->ion_auth->group(intval($row->hospital_group_id))->row()->description; ?>" href="javascript:void(0);" ><img  src="<?php echo base_url('assets/img/hospital.png'); ?>"></a></td>
                            <td><?php echo $row->report_urgency; ?></td>
                            <td><?php echo date('M j Y', strtotime($row->request_datetime)); ?></td>
                            <td><?php echo $row->date_received_bylab; ?></td>
                            <td style="text-align:center;">
                                <?php
                                if ($row->specimen_update_status == 0 && $row->specimen_publish_status == 0) :
                                    echo '<a href="' . site_url() . '/secretary/record_detail/' . intval($row->uralensis_request_id) . '" data-toggle="tooltip" data-placement="top" title="Please Update this ' . $row->serial_number . ' Record First."><img src="' . base_url('assets/img/detail.png') . '"></a>';
                                elseif ($row->specimen_update_status == 1 && $row->specimen_publish_status == 0) :
                                    echo '<a href="' . site_url() . '/secretary/record_detail/' . intval($row->uralensis_request_id) . '" data-toggle="tooltip" data-placement="top" title="' . $row->serial_number . ' Record is Updated."><img src="' . base_url('assets/img/update.png') . '"></a>';
                                elseif ($row->specimen_update_status == 1 && $row->specimen_publish_status == 1) :
                                    echo '<a href="' . site_url() . '/secretary/record_detail/' . intval($row->uralensis_request_id) . '" data-toggle="tooltip" data-placement="top" title="' . $row->serial_number . ' Record is Published."><img src="' . base_url('assets/img/correct.png') . '"></a>';
                                endif;
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($row->further_work_status == 1) {
                                    echo '<a data-toggle="tooltip" data-placement="top" title="Further Work Requested For This ' . html_purify($row->serial_number) . ' Record" href="javascript:void(0);"><img src="' . base_url('assets/img/further_work.png') . '"></a>';
                                }
                                ?> 
                            </td>
                            <td class="flag_column">
                                <div class="hover_flags">
                                    <div class="flag_images">
                                        <?php if ($row->flag_status === 'flag_red') { ?>
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_red.png'); ?>">
                                        <?php } elseif ($row->flag_status === 'flag_yellow') { ?>
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked for typing." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_yellow.png'); ?>">
                                        <?php } elseif ($row->flag_status === 'flag_blue') { ?>
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked for Pre-Authorization." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_blue.png'); ?>">
                                        <?php } elseif ($row->flag_status === 'flag_black') { ?>
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked as further work." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_black.png'); ?>">
                                        <?php } elseif ($row->flag_status === 'flag_gray') { ?>
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked as awaiting reviews." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_gray.png'); ?>">
                                        <?php } else { ?>
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked as released." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_green.png'); ?>">
                                        <?php } ?>

                                    </div>
                                    <ul class="report_flags list-unstyled list-inline" style="display:none;">
                                        <?php
                                        $active = '';
                                        if ($row->flag_status === 'flag_green') {
                                            $active = 'flag_active';
                                        }
                                        ?>
                                        <li class="<?php echo $active; ?>">
                                            <a href="javascript:;" data-flag="flag_green" data-serial="<?php echo html_purify($row->serial_number); ?>" data-recordid="<?php echo intval($row->uralensis_request_id); ?>" class="flag_change">
                                                <img data-toggle="tooltip" data-placement="top" title="This case marked as released." src="<?php echo base_url('assets/img/flag_green.png'); ?>">
                                            </a>
                                        </li>
                                        <?php
                                        $active = '';
                                        if ($row->flag_status === 'flag_red') {
                                            $active = 'flag_active';
                                        }
                                        ?>
                                        <li class="<?php echo $active; ?>">
                                            <a href="javascript:;" data-flag="flag_red" data-serial="<?php echo html_purify($row->serial_number); ?>" data-recordid="<?php echo intval($row->uralensis_request_id); ?>" class="flag_change">
                                                <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="<?php echo base_url('assets/img/flag_red.png'); ?>">
                                            </a>
                                        </li>
                                        <?php
                                        $active = '';
                                        if ($row->flag_status === 'flag_yellow') {
                                            $active = 'flag_active';
                                        }
                                        ?>
                                        <li class="<?php echo $active; ?>">
                                            <a href="javascript:;" data-flag="flag_yellow" data-serial="<?php echo html_purify($row->serial_number); ?>" data-recordid="<?php echo intval($row->uralensis_request_id); ?>" class="flag_change">
                                                <img data-toggle="tooltip" data-placement="top" title="This case marked for typing." src="<?php echo base_url('assets/img/flag_yellow.png'); ?>">
                                            </a>
                                        </li>
                                        <?php
                                        $active = '';
                                        if ($row->flag_status === 'flag_blue') {
                                            $active = 'flag_active';
                                        }
                                        ?>
                                        <li class="<?php echo $active; ?>">
                                            <a href="javascript:;" data-flag="flag_blue" data-serial="<?php echo html_purify($row->serial_number); ?>" data-recordid="<?php echo intval($row->uralensis_request_id); ?>" class="flag_change">
                                                <img data-toggle="tooltip" data-placement="top" title="This case marked for pre authorization." src="<?php echo base_url('assets/img/flag_blue.png'); ?>">
                                            </a>
                                        </li>
                                        <?php
                                        $active = '';
                                        if ($row->flag_status === 'flag_black') {
                                            $active = 'flag_active';
                                        }
                                        ?>
                                        <li class="<?php echo $active; ?>">
                                            <a href="javascript:;" data-flag="flag_black" data-serial="<?php echo html_purify($row->serial_number); ?>" data-recordid="<?php echo intval($row->uralensis_request_id); ?>" class="flag_change">
                                                <img data-toggle="tooltip" data-placement="top" title="This case marked further work." src="<?php echo base_url('assets/img/flag_black.png'); ?>">
                                            </a>
                                        </li>
                                        <?php
                                        $active = '';
                                        if ($row->flag_status === 'flag_gray') {
                                            $active = 'flag_active';
                                        }
                                        ?>
                                        <li class="<?php echo $active; ?>">
                                            <a href="javascript:;" data-flag="flag_gray" data-serial="<?php echo html_purify($row->serial_number); ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                                                <img data-toggle="tooltip" data-placement="top" title="This case marked awaiting reviews." src="<?php echo base_url('assets/img/flag_gray.png'); ?>">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="comments_icon">
                                    <a href="javascript:;" id="display_comment_box" class="display_comment_box" data-recordid="<?php echo intval($row->uralensis_request_id); ?>" data-modalid="<?php echo $flag_count; ?>">
                                        <img src="<?php echo base_url('assets/img/information.png'); ?>">
                                    </a>

                                    <a href="javascript:;" id="show_comments_list" class="show_comments_list" data-recordid="<?php echo intval($row->uralensis_request_id); ?>" data-modalid="<?php echo $flag_count; ?>">
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
                                                        <input type="hidden" name="record_id" value="<?php echo intval($row->uralensis_request_id); ?>">
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
                            <td><p style="display:none;"><?php echo $row->flag_status; ?></p></td>
                        </tr>
                        <?php
                        $flag_count++;
                    }
                }
                ?>
            </tbody>
    </div>
</div>