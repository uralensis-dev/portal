<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid">
    

    <div class="page-header">
        <div class="row">
            <div class="col-sm-8">
                <h3 class="page-title">Record Tracking</h3>
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
                        <li><a href="javascript:;" class="active">Record Tracking</a></li>
                    </ol>
                    <!-- <button class="btn btn-primary" data-toggle="collapse" data-target="#collapse_filter_hospital">Filter By Hospital</button> -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 form-group">
        <div class="col-md-5">
            <div class="temp_title">
                <h4>MY Templates</h4>
                <a class="tg-btnopenbox add_new_track_template" href="javascript:;"><i>+</i></a>
                <span class="tg-totalcount"><em><?php echo count($track_templates); ?></em></span>
            </div>
        </div>
        
        <div class="col-md-4">
            <ul id="myList" class="list-unstyled load-temp-data-list">
                <?php
                if (!empty($track_templates)) {
                    foreach ($track_templates as $template) {
                        ?>
                        <li>
                            <a href="javascript:;" class="btn btn-success"
                               data-hospitalid="<?php echo $template['temp_hospital_user']; ?>"
                               data-clinicid="<?php echo $template['temp_clinic_user']; ?>"
                               data-pathologist="<?php echo $template['temp_pathologist']; ?>"
                               data-labname="<?php echo $template['temp_lab_name']; ?>"
                               data-urgency="<?php echo $template['temp_report_urgency']; ?>"
                               data-speci="<?php echo $template['temp_skin_type']; ?>"
                               data-templateid="<?php echo $template['ura_rec_temp_id']; ?>">
                                <i class="fa fa-pencil"></i>
                                <span><?php echo $template['temp_input_name']; ?></span>
                            </a>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>

        <div class="col-md-3 text-right">
            <div class="tg-btnmore load_more_templates show-more pull-right"><span>More</span><i class="fa fa-angle-down"></i></div>
        </div>

        <div class="clearfix"></div>

    </div>
        <div class="clearfix"></div>

    <div class="panel panel-default search_status">
        <div class="panel-heading"><a href="#doctor" aria-controls="doctor" role="tab" data-toggle="tab" aria-expanded="false" style="color:#222;">Doctor</a></div>
        <div class="panel-body">
            <div class="tg-trackrecords">
        
                <div class="tg-tabholder statuses_tab">
                    
                    <div class="tg-tabcontent tab-content tab_status_content">
                        <div role="tabpanel" class="tab-pane fade active in" id="doctor">
                            <ul class="tg-findbtnsarea track_status_list">
                                <li>
                                    <a href="javascript:;" class="check_status_btn" data-statuscode="Micro Report Preview">
                                        <span>Micro Report</span>
                                        <h3>Preview</h3>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;" class="check_status_btn" data-statuscode="FW Request">
                                        <span>FW</span>
                                        <h3>Request</h3>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;" class="check_status_btn" data-statuscode="FW Received">
                                        <span>FW</span>
                                        <h3>Received</h3>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;" class="check_status_btn" data-statuscode="Authourised Report">
                                        <span>Authourised</span>
                                        <h3>Report</h3>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;" class="check_status_btn" data-statuscode="Supplementary Report">
                                        <span>Supplementary</span>
                                        <h3>Report</h3>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="tg-specimensearch">
                            <div class="tg-searchcontent">
                                <h3 class="change_status_text">Specimen Track Options</h3>
                                <div class="tg-searchspecimen">
                                    <fieldset>
                                        <div class="form-group tg-inputicon tg-inputwithicon">
                                            <span class="lnr lnr-magnifier barcode_no_search"></span>
                                            <input type="search" name="barcode_no" class="form-control" placeholder="Search By Track Number">
                                        </div>
                                    </fieldset>
                                    <fieldset class="tg-recordfound hidden-boxes">
                                        <span><i class="fa fa-check"></i></span><p></p>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">

        <hr class="haslayout">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
            <div class="tracking_search_result"></div>
        </div>
        <div class="clearfix"></div>
        <button class="btn btn-danger btn-lg btn-rounded pull-left create_sess_list_btn">Create New Session List</button>
        <a href="<?php echo base_url('index.php/doctor/view_session_records'); ?>" target="_blank">
            <button class="btn btn-success btn-lg btn-rounded pull-right">View Session Records</button>
        </a>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 record_add_result">
            <?php if (!empty($session_data)) { ?>
                <a target="_blank" href="<?php echo base_url('index.php/doctor/print_session_records'); ?>">Print Records</a>
                <table class="table track_search_table custom-table table-stripped">
                    <thead>
                        <tr>
                            <th>UL No.</th>
                            <th>Track No.</th>
                            <th>Client</th>
                            <th>First Name</th>
                            <th>Surname</th>
                            <th>DOB</th>
                            <th>NHS No.</th>
                            <th>Lab No.</th>
                            <th>Type</th>
                            <th>Release Date</th>
                            <th>Statuses</th>
                            <th>Flag</th>
                            <th><img src="<?php echo base_url('assets/img/comment-bubble-white.png'); ?>"></th>
                            <th><img src="<?php echo base_url('assets/img/docs-white.png'); ?>"></th>
                            <th>TAT</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($session_data as $row_data) { ?>
                        <tr class="track_session_row" data-trackno="<?php echo $row_data['ura_barcode_no']; ?>">
                            <td><?php echo $row_data['serial_number']; ?></td>
                            <td><?php echo $row_data['ura_barcode_no']; ?></td>
                            <td>
                                <?php
                                $f_initial = '';
                                $l_initial = '';
                                if (!empty($this->ion_auth->group($row_data['hospital_group_id'])->row()->first_initial)) {
                                    $f_initial = $this->ion_auth->group($row_data['hospital_group_id'])->row()->first_initial;
                                }
                                if (!empty($this->ion_auth->group($row_data['hospital_group_id'])->row()->last_initial)) {
                                    $l_initial = $this->ion_auth->group($row_data['hospital_group_id'])->row()->last_initial;
                                }
                                ?>
                                <a class="hospital_initials" data-toggle="tooltip" data-placement="top" title="<?php echo $this->ion_auth->group($row_data['hospital_group_id'])->row()->description; ?>" href="javascript:;" ><?php echo $f_initial . ' ' . $l_initial; ?></a>
                            </td>
                            <td><?php echo $row_data['f_name']; ?></td>
                            <td><?php echo $row_data['sur_name']; ?></td>
                            <td>
                                <?php
                                $dob = '';
                                if (!empty($row_data['dob'])) {
                                    $dob = date('d-m-Y', strtotime($row_data['dob']));
                                }
                                echo $dob;
                                ?>
                            </td>
                            <td><?php echo $row_data['nhs_number']; ?></td>
                            <td><a target="_blank" href="<?php echo site_url() . '/doctor/doctor_record_detail/' . $row_data['uralensis_request_id']; ?>"><?php echo $row_data['lab_number']; ?></a></td>
                            <td><?php echo ucwords(substr($row_data['report_urgency'], 0, 1)); ?></td>
                            <td>
                                <?php
                                $publish_date = '';
                                if (!empty($row_data['publish_datetime'])) {
                                    $publish_date = date('d-m-Y', strtotime($row_data['publish_datetime']));
                                }
                                echo $publish_date;
                                ?>
                            </td>
                            <td class="dropdown tg-userdropdown tg-liststatuses">
                                <?php
                                $list_statuses = $this->Doctor_model->get_track_template_statuses($row_data['uralensis_request_id'], 'all');
                                $scroll_class = '';
                                if (count($list_statuses) > 4) {
                                    $scroll_class = 'custom-list-scroll ura-custom-scrollbar';
                                }
                                ?>
                                <a href="javascript:;" data-toggle="dropdown" aria-expanded="true"><?php echo $this->Doctor_model->get_track_template_statuses($row_data['uralensis_request_id'], 'recent')['ura_rec_track_status']; ?></a>
                                <ul class="dropdown-menu tg-themedropdownmenu <?php echo $scroll_class; ?>" aria-labelledby="tg-adminnav">
                                    <?php
                                    if (!empty($list_statuses)) {
                                        foreach ($list_statuses as $statuses) {
                                            ?>
                                            <li>
                                                <a href="javascript:;">
                                                    <span><?php echo $statuses['ura_rec_track_status']; ?></span>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </td>
                            <td class="flag_column">
                                <div class="hover_flags">
                                    <div class="flag_images">
                                        <?php
                                        if ($row_data['flag_status'] === 'flag_red') {
                                            echo '<img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_red.png') . '">';
                                        } elseif ($row_data['flag_status'] === 'flag_yellow') {
                                            echo '<img data-toggle="tooltip" data-placement="top" title="This case marked for typing." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_yellow.png') . '">';
                                        } elseif ($row_data['flag_status'] === 'flag_blue') {
                                            echo '<img data-toggle="tooltip" data-placement="top" title="This case marked for Pre-Authorization." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_blue.png') . '">';
                                        } elseif ($row_data['flag_status'] === 'flag_black') {
                                            echo '<img data-toggle="tooltip" data-placement="top" title="This case marked as further work." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_black.png') . '">';
                                        } elseif ($row_data['flag_status'] === 'flag_gray') {
                                            echo '<img data-toggle="tooltip" data-placement="top" title="This case marked as awaiting reviews." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_gray.png') . '">';
                                        } else {
                                            echo '<img data-toggle="tooltip" data-placement="top" title="This case marked as released." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_green.png') . '">';
                                        }
                                        ?>
                                    </div>
                                    <ul class="report_flags list-unstyled list-inline" style="display:none;">
                                        <?php
                                        $active = '';
                                        if ($row_data['flag_status'] === 'flag_green') {
                                            $active = 'flag_active';
                                        }
                                        ?>
                                        <li class="<?php echo $active; ?>">
                                            <a href="javascript:;" data-flag="flag_green" data-serial="<?php echo $row_data['serial_number']; ?>" data-recordid="<?php echo $row_data['uralensis_request_id']; ?>" class="flag_change">
                                                <img data-toggle="tooltip" data-placement="top" title="This case marked as released." src="<?php echo base_url('assets/img/flag_green.png'); ?>">
                                            </a>
                                        </li>
                                        <?php
                                        $active = '';
                                        if ($row_data['flag_status'] === 'flag_red') {
                                            $active = 'flag_active';
                                        }
                                        ?>
                                        <li class="<?php echo $active; ?>">
                                            <a href="javascript:;" data-flag="flag_red" data-serial="<?php echo $row_data['serial_number']; ?>" data-recordid="<?php echo $row_data['uralensis_request_id']; ?>" class="flag_change">
                                                <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="<?php echo base_url('assets/img/flag_red.png'); ?>">
                                            </a>
                                        </li>
                                        <?php
                                        $active = '';
                                        if ($row_data['flag_status'] === 'flag_yellow') {
                                            $active = 'flag_active';
                                        }
                                        ?>

                                        <li class="<?php echo $active; ?>">
                                            <a href="javascript:;" data-flag="flag_yellow" data-serial="<?php echo $row_data['serial_number']; ?>" data-recordid="<?php echo $row_data['uralensis_request_id']; ?>" class="flag_change">
                                                <img data-toggle="tooltip" data-placement="top" title="This case marked for typing." src="<?php echo base_url('assets/img/flag_yellow.png'); ?>">
                                            </a>
                                        </li>
                                        <?php
                                        $active = '';
                                        if ($row_data['flag_status'] === 'flag_blue') {
                                            $active = 'flag_active';
                                        }
                                        ?>
                                        <li class="<?php echo $active; ?>">
                                            <a href="javascript:;" data-flag="flag_blue" data-serial="<?php echo $row_data['serial_number']; ?>" data-recordid="<?php echo $row_data['uralensis_request_id']; ?>" class="flag_change">
                                                <img data-toggle="tooltip" data-placement="top" title="This case marked for pre authorization." src="<?php echo base_url('assets/img/flag_blue.png'); ?>">
                                            </a>
                                        </li>
                                        <?php
                                        $active = '';
                                        if ($row_data['flag_status'] === 'flag_black') {
                                            $active = 'flag_active';
                                        }
                                        ?>

                                        <li class="<?php echo $active; ?>">
                                            <a href="javascript:;" data-flag="flag_black" data-serial="<?php echo $row_data['serial_number']; ?>" data-recordid="<?php echo $row_data['uralensis_request_id']; ?>" class="flag_change">
                                                <img data-toggle="tooltip" data-placement="top" title="This case marked further work." src="<?php echo base_url('assets/img/flag_black.png'); ?>">
                                            </a>
                                        </li>
                                        <?php
                                        $active = '';
                                        if ($row_data['flag_status'] === 'flag_gray') {
                                            $active = 'flag_active';
                                        }
                                        ?>
                                        <li class="<?php echo $active; ?>">
                                            <a href="javascript:;" data-flag="flag_gray" data-serial="<?php echo $row_data['serial_number']; ?>" data-recordid="<?php echo $row_data['uralensis_request_id']; ?>" class="flag_change">
                                                <img data-toggle="tooltip" data-placement="top" title="This case marked awaiting reviews." src="<?php echo base_url('assets/img/flag_gray.png'); ?>">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <a class="custom_badge_track" data-toggle="tooltip" data-placement="top" title="" data-original-title="View your record comments or add comments.">
                                    <img src="<?php echo base_url('assets/img/comment-bubble.png'); ?>">&nbsp;
                                    <span class="badge bg-danger">0</span>
                                </a>
                            </td>
                            <td>
                                <?php
                                $doctor_id = $this->Doctor_model->get_record_assignee_doctor_id($row_data['uralensis_request_id']);
                                $count_docs_result = $this->Doctor_model->count_documents($row_data['uralensis_request_id'], $doctor_id);
                                ?>
                                <a class="custom_badge_track" data-toggle="tooltip" data-placement="top" title="" data-original-title="View your record comments or add comments.">
                                    <img src="<?php echo base_url('assets/img/docs-black.png'); ?>">&nbsp;
                                    <span class="badge bg-danger"><?php echo $count_docs_result; ?></span>
                                </a>
                            </td>
                            <td>
                                <a class="custom_badge_tat">
                                    <?php
                                    $now = time(); // or your date as well
                                    $date_taken = !empty($row_data['date_taken']) ? $row_data['date_taken'] : '';
                                    $request_date = !empty($row_data['request_datetime']) ? $row_data['request_datetime'] : '';
                                    $tat_date = '';

                                    if (!empty($date_taken)) {
                                        $tat_date = $date_taken;
                                    } else {
                                        $tat_date = $request_date;
                                    }

                                    $compare_date = strtotime("$tat_date");
                                    $datediff = $now - $compare_date;
                                    $record_old_count = floor($datediff / (60 * 60 * 24));

                                    $badge = '';
                                    if ($record_old_count <= 10) {
                                        $badge = 'bg-success';
                                    } elseif ($record_old_count > 10 && $record_old_count <= 20) {
                                        $badge = 'bg-warning';
                                    } else {
                                        $badge = 'bg-danger';
                                    }
                                    ?>
                                    <span class="badge <?php echo $badge; ?>"><?php echo $record_old_count; ?></span>
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo base_url('index.php/doctor/doctor_record_detail/' . $row_data['uralensis_request_id']); ?>"><img src="<?php echo base_url('assets/img/edit.png'); ?>"></a>
                            </td>
                            <td class="dropdown tg-userdropdown tg-menu-dropdown">
                                <a href="javascript:;" data-toggle="dropdown" aria-expanded="true"><span class="lnr lnr-menu"></span></a>
                                <ul class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-adminnav">
                                    <li>
                                        <a href="javascript:;"><i class="lnr lnr-trash"></i><em>Delete</em></a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
</div>