<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <?php
        if (isset($_GET['msg']) && $_GET['msg'] == 'success') {

            echo '<p class="bg-success" style="padding:7px;">Report Has Been Successfully Published.</p>';
        }
        if ($this->session->flashdata('unpublish_record_message') != '') {
            echo $this->session->flashdata('unpublish_record_message');
        }
        ?>
        <?php
        if ($this->session->flashdata('record_status') != '') {
            echo $this->session->flashdata('record_status');
        }
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        if ($this->session->flashdata('general_error') != '') {
            echo $this->session->flashdata('general_error');
        }
        ?>
        <form action="<?php echo site_url('doctor/filter_results'); ?>" method="post">
            <table class="table table-bordered">
                <tr class="bg-primary">
                    <th>Choose Clinic</th>
                    <th>Report Urgency</th>
                </tr>
                <tr>
                    <td class="col-md-6">
                        <select class="form-control" name="hospital_id">
                            <option value="0">Choose Clinic</option>
                            <?php
                            if (!empty($get_hospitals)) {
                                foreach ($get_hospitals as $list_hospitals) {
                                    echo '<option value="' . $list_hospitals->id . '">' . $list_hospitals->description . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td class="col-md-6">
                        <select name="report_urgency" class="form-control">
                            <option value="0">Choose Urgency</option>
                            <?php
                            $report_urgency = array(
                                'Routine' => 'Routine',
                                'Urgent' => 'Urgent',
                                '2WW' => '2WW'
                            );
                            foreach ($report_urgency as $key => $urgency) {
                                ?>
                                <option value="<?php echo $key; ?>"><?php echo $urgency; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
            </table>
            <div class="pull-right">
                <button type="submit" class="btn btn-warning">Filter Result</button>
            </div>
        </form>
    </div>
</div>

<div class="row report_listing">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2">
                <a onclick="window.history.back();"><button class="btn btn-primary"><< Go Back</button></a>
                <br /><br />
            </div>
        </div>
        <div class="flag_message"></div>
        <div id="advance_search_table">
        <?php
           $attributes = array('class' => '');
            echo form_open("Doctor/search_request", $attributes);
            ?>
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
                <div>
                    <button type="submit" class="btn btn-warning">Search</button>
                </div> 
            </form>
        </div>
        <p class="pull-right"><a id="doctor_advance_search" href="javascript:void(0);">Advance Search</a></p>
        <div class="clearfix"></div>

        <div class="tat_radio">
            <div class="row">
                <div class="col-md-2">
                    <div class="tat_radio_primary">
                        <input class="tat" type="radio" name="tat" id="tat5">
                        <label for="tat5">TAT < 5</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="tat_radio_success">
                        <input class="tat" type="radio" name="tat" id="tat10">
                        <label for="tat10">TAT < 10</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="tat_radio_warning">
                        <input class="tat" type="radio" name="tat" id="tat20">
                        <label for="tat20">TAT < 20</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="tat_radio_danger">
                        <input class="tat" type="radio" name="tat" id="tat30">
                        <label for="tat30">TAT > 20</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="tat_radio_info">
                        <input class="tat" type="radio" name="tat" id="all_tat">
                        <label for="all_tat">Show All</label>
                    </div>
                </div>
            </div>
        </div>

        <!--Flag Sorting Start-->
        <div class="flag_sorting">
            <?php
            if ($this->session->userdata('color_code') !== '') {
                $session_color = $this->session->userdata('color_code');
            }
            ?>
            <label for="flag_green">
                <?php
                $checked = '';
                if (!empty($session_color) && $session_color === 'green') {
                    $checked = 'checked';
                }
                ?>
                <input <?php echo $checked; ?> type="radio" name="flag_sorting" id="flag_green" class="flag_status">
                <img data-toggle="tooltip" data-placement="top" title="This case marked as released." src="<?php echo base_url('assets/img/flag_green.png'); ?>">
            </label>
            <label for="flag_red">
                <?php
                $checked = '';
                if (!empty($session_color) && $session_color === 'red') {
                    $checked = 'checked';
                }
                ?>
                <input <?php echo $checked; ?> type="radio" name="flag_sorting" id="flag_red" class="flag_status">
                <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="<?php echo base_url('assets/img/flag_red.png'); ?>">
            </label>
            <label for="flag_yellow">
                <?php
                $checked = '';
                if (!empty($session_color) && $session_color === 'yellow') {
                    $checked = 'checked';
                }
                ?>
                <input <?php echo $checked; ?> type="radio" name="flag_sorting" id="flag_yellow" class="flag_status">
                <img data-toggle="tooltip" data-placement="top" title="This case marked for typing." src="<?php echo base_url('assets/img/flag_yellow.png'); ?>">
            </label>
            <label for="flag_blue">
                <?php
                $checked = '';
                if (!empty($session_color) && $session_color === 'blue') {
                    $checked = 'checked';
                }
                ?>
                <input <?php echo $checked; ?> type="radio" name="flag_sorting" id="flag_blue" class="flag_status">
                <img data-toggle="tooltip" data-placement="top" title="This case marked for pre authorization." src="<?php echo base_url('assets/img/flag_blue.png'); ?>">
            </label>
            <label for="flag_black">
                <?php
                $checked = '';
                if (!empty($session_color) && $session_color === 'black') {
                    $checked = 'checked';
                }
                ?>
                <input <?php echo $checked; ?> type="radio" name="flag_sorting" id="flag_black" class="flag_status">
                <img data-toggle="tooltip" data-placement="top" title="This case marked as further work." src="<?php echo base_url('assets/img/flag_black.png'); ?>">
            </label>
            <label for="flag_all">
                <?php
                $checked = '';
                if (empty($session_color)) {
                    $checked = 'checked';
                }
                ?>
                <input <?php echo $checked; ?> type="radio" name="flag_sorting" id="flag_all" class="flag_status">
                <img src="<?php echo base_url('assets/img/flag_all.png'); ?>">
            </label>
            <input type="hidden" name="flag_code" value="">
        </div>
        <!--Flag Sorting End-->
        <table id="doctor_record_list_table" class="table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr class="info">
                    <th>UL No.</th>
                    <th>Track No.</th>
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
                    <th>Docs</th>
                    <th>TAT</th>
                    <th class="text-center">Flag</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tfoot>
                <tr class="info">
                    <th>UL No.</th>
                    <th>Track No.</th>
                    <th>First name</th>
                    <th>Surname:</th>
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
                    <th>Docs</th>
                    <th>TAT</th>
                    <th class="text-center">Flag</th>
                    <th>&nbsp;</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                $flag_count = 11;
                foreach ($query as $row) :
                    ?>
                    <?php
                    $row_code = '';

                    if (!empty($row->request_code_status) && $row->request_code_status === 'new') {
                        $row_code = 'row_yellow';
                    } elseif (!empty($row->request_code_status) && $row->request_code_status === 'rec_by_lab') {
                        $row_code = 'row_orange';
                    } elseif (!empty($row->request_code_status) && $row->request_code_status === 'pci_added') {
                        $row_code = 'row_purple';
                    } elseif (!empty($row->request_code_status) && $row->request_code_status === 'assign_doctor') {
                        $row_code = 'row_green';
                    } elseif (!empty($row->request_code_status) && $row->request_code_status === 'micro_add') {
                        $row_code = 'row_skyblue';
                    } elseif (!empty($row->request_code_status) && $row->request_code_status === 'add_to_authorize') {
                        $row_code = 'row_blue';
                    } elseif (!empty($row->request_code_status) && $row->request_code_status === 'furtherwork_add') {
                        $row_code = 'row_brown';
                    } elseif (!empty($row->request_code_status) && $row->request_code_status === 'record_publish') {
                        $row_code = 'row_white';
                    }
                    ?>
                    <tr class="<?php echo $row_code; ?>">
                        <td><?php echo $row->serial_number; ?></td>
                        <td><?php echo $row->ura_barcode_no; ?></td>
                        <td><?php echo $row->f_name; ?></td>
                        <td><?php echo $row->sur_name; ?></td>
                        <td>
                            <?php
                            if (!empty($row->dob)) {
                                echo date('d-m-Y', strtotime($row->dob));
                            }
                            ?>
                        </td>
                        <td><?php echo $row->pci_number; ?></td>
                        <td><?php echo $row->emis_number; ?></td>
                        <td><?php echo $row->nhs_number; ?></td>
                        <td><?php echo $row->lab_number; ?></td>
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
                            <a class="hospital_initials" data-toggle="tooltip" data-placement="top" title="<?php echo $this->ion_auth->group($row->hospital_group_id)->row()->description; ?>" href="javascript:void(0);" >
                                <?php echo $f_initial . ' ' . $l_initial; ?>
                            </a>
                        </td>
                        <td><?php echo $row->report_urgency; ?></td>
                        <td>
                            <?php
                            if (!empty($row->request_datetime)) {
                                echo date('d-m-Y', strtotime($row->request_datetime));
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if (!empty($row->date_received_bylab)) {
                                echo date('d-m-Y', strtotime($row->date_received_bylab));
                            }
                            ?>
                        </td>
                        <td style="text-align:center;" class="record_detail_link">

                            <?php
                            if ($row->specimen_update_status == 0 && $row->specimen_publish_status == 0) :
                                echo '<a href="' . site_url() . '/doctor/doctor_record_detail/' . $row->uralensis_request_id . '" data-toggle="tooltip" data-placement="top" title="Please Update this ' . $row->serial_number . ' Record First."><img src="' . base_url('assets/img/detail.png') . '"></a>';
                            elseif ($row->specimen_update_status == 1 && $row->specimen_publish_status == 0) :
                                echo '<a href="' . site_url() . '/doctor/doctor_record_detail/' . $row->uralensis_request_id . '" data-toggle="tooltip" data-placement="top" title="' . $row->serial_number . ' Record is Updated."><img src="' . base_url('assets/img/update.png') . '"></a>';
                            elseif ($row->specimen_update_status == 1 && $row->specimen_publish_status == 1) :
                                echo '<a href="' . site_url() . '/doctor/doctor_record_detail/' . $row->uralensis_request_id . '" data-toggle="tooltip" data-placement="top" title="' . $row->serial_number . ' Record is Published."><img src="' . base_url('assets/img/correct.png') . '"></a>';
                            endif;
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($row->further_work_status == 1) {
                                echo '<a data-toggle="tooltip" data-placement="top" title="Further Work Requested For This ' . $row->serial_number . ' Record" href="javascript:void(0);"><img src="' . base_url('assets/img/further_work.png') . '"></a>';
                            }
                            ?> 
                        </td>
                        <td>
                            <?php
                            $user_id = $this->ion_auth->user()->row()->id;
                            $count_result = $this->Doctor_model->count_documents($row->uralensis_request_id, $user_id);
                            ?>
                            <a class="custom_badge" data-toggle="tooltip" data-placement="top" title="View Your Record Related Documents." href="<?php echo site_url() . '/doctor/doctor_record_detail/' . $row->uralensis_request_id; ?>">
                                <img src="<?php echo base_url('assets/img/adobe.png'); ?>" />&nbsp;
                                <?php if ($count_result != 0) { ?>
                                    <span class="badge bg-danger"><?php echo $count_result; ?></span>
                                <?php } ?>
                            </a>
                        </td>
                        <td>
                            <a class="custom_badge_tat">
                                <?php
                                $now = time();
                                $date_taken = !empty($row->date_taken) ? $row->date_taken : '';
                                $request_date = !empty($row->request_datetime) ? $row->request_datetime : '';
                                $tat_date = '';

                                //Get TAT Settings From Admin Side
                                $tat_settings = uralensis_get_tat_date_settings($row->hospital_group_id);

                                if (!empty($tat_settings) && $tat_settings['ura_tat_date_data'] === 'date_sent_touralensis') {
                                    $date_sent_to_uralensis = !empty($row->date_sent_touralensis) ? $row->date_sent_touralensis : '';
                                    $tat_date = $date_sent_to_uralensis;
                                } elseif ($tat_settings['ura_tat_date_data'] === 'date_rec_by_doctor') {
                                    $data_rec_by_doctor = !empty($row->date_rec_by_doctor) ? $row->date_rec_by_doctor : '';
                                    $tat_date = $data_rec_by_doctor;
                                } elseif ($tat_settings['ura_tat_date_data'] === 'data_processed_bylab') {
                                    $data_processed_bylab = !empty($row->data_processed_bylab) ? $row->data_processed_bylab : '';
                                    $tat_date = $data_processed_bylab;
                                } elseif ($tat_settings['ura_tat_date_data'] === 'date_received_bylab') {
                                    $date_received_bylab = !empty($row->date_received_bylab) ? $row->date_received_bylab : '';
                                    $tat_date = $date_received_bylab;
                                } elseif ($tat_settings['ura_tat_date_data'] === 'publish_datetime') {
                                    $publish_datetime = !empty($row->publish_datetime) ? $row->publish_datetime : '';
                                    $tat_date = $publish_datetime;
                                } else {
                                    if (!empty($date_taken)) {
                                        $tat_date = $date_taken;
                                    } else {
                                        $tat_date = $request_date;
                                    }
                                }

                                if (!empty($tat_settings) && empty($tat_date)) {
                                    $record_old_count = 'Not Received';
                                } elseif (!empty($tat_settings) && !empty($tat_date)) {
                                    $compare_date = strtotime("$tat_date");
                                    $datediff = $now - $compare_date;
                                    $record_old_count = floor($datediff / (60 * 60 * 24));
                                } else {
                                    $compare_date = strtotime("$tat_date");
                                    $datediff = $now - $compare_date;
                                    $record_old_count = floor($datediff / (60 * 60 * 24));
                                }

                                $badge = '';
                                if ($record_old_count <= 10) {
                                    $badge = 'bg-success';
                                } elseif ($record_old_count > 10 && $record_old_count <= 20) {
                                    $badge = 'bg-warning';
                                } else {
                                    $badge = 'bg-danger';
                                }
                                ?>
                                <span class="badge <?php echo $badge; ?>">
                                    <?php echo $record_old_count; ?>
                                </span>
                            </a>
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
                                        <a href="javascript:;" data-flag="flag_green" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
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
                                        <a href="javascript:;" data-flag="flag_red" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
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
                                        <a href="javascript:;" data-flag="flag_yellow" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
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
                                        <a href="javascript:;" data-flag="flag_blue" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
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
                                        <a href="javascript:;" data-flag="flag_black" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
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
                                        <a href="javascript:;" data-flag="flag_gray" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked awaiting reviews." src="<?php echo base_url('assets/img/flag_gray.png'); ?>">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="comments_icon">
                                <a href="javascript:;" id="display_comment_box" class="display_comment_box" data-recordid="<?php echo $row->uralensis_request_id; ?>" data-modalid="<?php echo $flag_count; ?>">
                                    <img src="<?php echo base_url('assets/img/information.png'); ?>">
                                </a>
                                <a href="javascript:;" id="show_comments_list" class="show_comments_list" data-recordid="<?php echo $row->uralensis_request_id; ?>" data-modalid="<?php echo $flag_count; ?>">
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
                                                    <input type="hidden" name="record_id" value="<?php echo $row->uralensis_request_id; ?>">
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
                        <td><p style="display:none;"><?php echo $row->flag_status; ?></p>
                        </td>
                    </tr>
                    <?php
                    $flag_count++;
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>
