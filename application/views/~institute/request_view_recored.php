<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
                        <form action="<?php echo site_url('Institute/search_request'); ?>" method="post">
                            <table class="table table-bordered">
                                <tr class="bg-primary">
                                    <th>Emis No</th>
                                    <th>NHS No</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Lab No</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input class="form-control" type="text" id="emis_no" name="emis_no">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="nhs_no" name="nhs_no">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="f_name" name="f_name">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="l_name" name="l_name">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="lab_no" name="lab_no">
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
<?php
?>
<!--Flag Sorting Start-->
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
<!--Flag Sorting End-->
<div class="row report_listing">
    <div class="col-md-12">
        <h3 class="text-center">Submitted Records</h3>
        <div class="flag_message"></div>
        <?php echo $this->session->flashdata('record-msg'); ?>
        <table id="display_submitted_records" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr class="bg-primary">
                <th>UL No.<br/>Track No.</th>
                <th>Client<br/>Clinic</th>
                <th>Batch<br/>PCI No.</th>
                <th>Specialty</th>
                <th>First<br/>Surname</th>
                <th>NHS No.<br/>DOB</th>
                <th>LAB No.<br/>EMIS No.</th>
                <th><i class="lnr lnr-layers" style="font-size:18px;"></i></th>
                <th style="text-align: center; width: 104px;">Flag</th>
                <th><i class="lnr lnr-bubble" style="font-size:18px;"></i></th>
                <th><i class="lnr lnr-file-empty" style="font-size:18px;"></i></th>
                <th>Detail</th>
                <th>Status</th>
                <th>V.Report</th>
                <th>D.Report</th>
                <th>Docs</th>
                <th>Allocate</th>
                <th class="hide_content">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $flag_count = 11;
            if (count($query) == 0) {
                echo '<p class="bg-danger" style="padding:5px;">Sorry there is no record yet. Kindly Add Request to see the submitted request.</p>';
            } else {
                foreach ($query as $row) {
                    $row_code = '';
                    if (!empty($row->request_code_status) && $row->request_code_status === 'new') {
                        $row_code = 'row_yellow';
                    } else if (!empty($row->request_code_status) && $row->request_code_status === 'rec_by_lab') {
                        $row_code = 'row_orange';
                    } else if (!empty($row->request_code_status) && $row->request_code_status === 'pci_added') {
                        $row_code = 'row_purple';
                    } else if (!empty($row->request_code_status) && $row->request_code_status === 'assign_doctor') {
                        $row_code = 'row_green';
                    } else if (!empty($row->request_code_status) && $row->request_code_status === 'micro_add') {
                        $row_code = 'row_skyblue';
                    } else if (!empty($row->request_code_status) && $row->request_code_status === 'add_to_authorize') {
                        $row_code = 'row_blue';
                    } else if (!empty($row->request_code_status) && $row->request_code_status === 'furtherwork_add') {
                        $row_code = 'row_brown';
                    } else if (!empty($row->request_code_status) && $row->request_code_status === 'record_publish') {
                        $row_code = 'row_white';
                    }
                    $urgency_class = '';
                    $urgency_title = '';
                    if (!empty($row->report_urgency) && $row->report_urgency === 'Urgent') {
                        $urgency_class = 'lnr lnr-star';
                        $urgency_title = 'Urgent';
                    } else if (!empty($row->report_urgency) && $row->report_urgency === '2WW') {
                        $urgency_class = 'lnr lnr-heart';
                        $urgency_title = '2WW';
                    } else {
                        $urgency_class = 'lnr lnr-sync';
                        $urgency_title = 'Routine';
                    }
                    $dob = '';
                    if (!empty($row->dob)) {
                        $dob = date('d-m-Y', strtotime($row->dob));
                    }
                    $lab_release_date = '';
                    if (!empty($row->date_received_bylab)) {
                        $lab_release_date = date('d-m-Y', strtotime($row->date_received_bylab));
                    }
                    $batch_no = '';
                    if (!empty($row->record_batch_id)) {
                        $batch_no = $row->record_batch_id;
                    }
                    ?>
                    <tr class="<?php echo $row_code; ?>">
                        <td class="<?php echo $row_code; ?>"><?php echo html_purify($row->serial_number); ?><br><?php echo $row->ura_barcode_no; ?></td>
                        <td>
                            <?php
                            $f_initial = '';
                            $l_initial = '';
                            if (!empty($this->ion_auth->group($row->hospital_group_id)->row()->first_initial)) {
                                $f_initial = $this->ion_auth->group($row->hospital_group_id)->row()->first_initial;
                            }
                            if (!empty($this->ion_auth->group($row->hospital_group_id)->row()->last_initial)) {
                                $l_initial = $this->ion_auth->group($row->hospital_group_id)->row()->last_initial;
                            }
                            ?>
                            <a class="hospital_initials" data-toggle="tooltip" data-placement="top" title="<?php echo $this->ion_auth->group(intval($row->hospital_group_id))->row()->description; ?>" href="javascript:;">
                                <?php echo $f_initial . ' ' . $l_initial; ?>
                            </a>
                        </td>
                        <td><?php echo html_purify($batch_no); ?><br><?php echo html_purify($row->pci_number); ?></td>
                        <td><?php echo  empty($row->specialty) ? "General Pathology" : $row->specialty; ?></td>
                        <td><?php echo html_purify($row->f_name); ?><br><?php echo $row->sur_name; ?></td>
                        <td><?php echo html_purify($row->nhs_number); ?><br><?php echo $dob; ?></td>
                        <td><?php echo html_purify($row->lab_number); ?><br><?php echo html_purify($row->emis_number); ?></td>
                        <td><i class="<?php echo $urgency_class; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $urgency_title; ?>" style="font-size:18px;"></i></td>
                        <td class="flag_column">
                            <div class="hover_flags">
                                <div class="flag_images">
                                    <?php if ($row->flag_status === 'flag_red') { ?>
                                        <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_red.png'); ?>">
                                    <?php } else if ($row->flag_status === 'flag_yellow') { ?>
                                        <img data-toggle="tooltip" data-placement="top" title="This case marked for typing." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_yellow.png'); ?>">
                                    <?php } else if ($row->flag_status === 'flag_blue') { ?>
                                        <img data-toggle="tooltip" data-placement="top" title="This case marked for Pre-Authorization." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_blue.png'); ?>">
                                    <?php } else if ($row->flag_status === 'flag_black') { ?>
                                        <img data-toggle="tooltip" data-placement="top" title="This case marked as further work." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_black.png'); ?>">
                                    <?php } else if ($row->flag_status === 'flag_gray') { ?>
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
                                        <a href="javascript:;" data-flag="flag_gray" data-serial="<?php echo html_purify($row->serial_number); ?>" data-recordid="<?php echo intval($row->uralensis_request_id); ?>" class="flag_change">
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked awaiting reviews." src="<?php echo base_url('assets/img/flag_gray.png'); ?>">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <div class="comments_icon">
                                <a style="color:#000;" href="javascript:;" id="display_comment_box" class="display_comment_box" data-recordid="<?php echo intval($row->uralensis_request_id); ?>" data-modalid="<?php echo $flag_count; ?>">
                                    <i class="lnr lnr-bubble" style="font-size:18px;font-weight:bold;"></i>
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
                        </td>
                        <td>
                            <div class="comments_icon">
                                <a style="color:#000;" href="javascript:;" id="show_comments_list" class="show_comments_list" data-recordid="<?php echo intval($row->uralensis_request_id); ?>" data-modalid="<?php echo $flag_count; ?>">
                                    <i class="lnr lnr-file-empty" style="font-size:18px;font-weight:bold;"></i>
                                </a>
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
                        <td style="text-align:center;"><a href="<?php echo site_url() . '/Institute/view_singlerecord/' . intval($row->uralensis_request_id); ?>"><img src="<?php echo base_url('assets/img/detail.png'); ?>"></a></td>
                        <td style="text-align:center;">
                            <?php
                            if ($row->status == 0) {
                                echo '<span data-toggle="tooltip" data-placement="top" title="In Progress."><img src="' . base_url('assets/img/error.png') . '"></span>';
                            } else {
                                echo '<span data-toggle="tooltip" data-placement="top" title="Completed." style="color:green;"><img src="/uralensis/assets/img/success.gif"></span>';
                            }
                            ?>
                        </td>
                        <?php
                        if ($row->specimen_publish_status == 1) {
                            echo '<td style="text-align:center;"><a data-toggle="tooltip" data-placement="top" title="View Report." target="_blank" href="' . site_url('Institute/view_single_final/' . intval($row->uralensis_request_id)) . '">V.Report</a></td>';
                        } else {
                            echo '<td style="text-align:center;"><span data-toggle="tooltip" data-placement="top" title="Report not submitted by doctor.">N-S</span></td>';
                        }
                        ?>
                        <?php
                        if ($row->specimen_publish_status == 1) {
                            echo '<td style="text-align:center;"><a data-toggle="tooltip" data-placement="top" title="Download Report." href="' . site_url('Institute/download_pdf/' . intval($row->uralensis_request_id)) . '"><img src="' . base_url('assets/img/download.png') . '">D.Report</a></td>';
                        } else {
                            echo '<td style="text-align:center;"><span data-toggle="tooltip" data-placement="top" title="Not Submitted By Doctor.">N-S</span></td>';
                        }
                        ?>
                        <td style="text-align:center;">
                            <a data-toggle="tooltip" data-placement="top" title="Record Attached Documents." href="<?php echo site_url() . '/institute/institute_download_section/' . intval($row->uralensis_request_id); ?>"><img
                                    src="<?php echo base_url('assets/img/adobe.png'); ?>"/></a>
                        </td>
                        <td><a href="/admin/allocate/<?php echo  $row->specimen_id; ?>"><i class="fa fa-arrow-right"></i></a></td>
                        <td class="hide_content">
                            <p style="display:none;"><?php echo $row->flag_status; ?></p>
                        </td>
                    </tr>
                    <?php
                    $flag_count++;
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

