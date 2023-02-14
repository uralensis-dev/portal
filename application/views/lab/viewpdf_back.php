<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
/**
 * Get Prepublish preview
 *
 * @param array $user_record_data
 * @param array $request_query
 * @param array $get_additional
 * @param array $specimen_query
 * @param array $get_hospital_info
 * @return void
 */
function get_prepublish_preview($user_record_data, $request_query, $get_additional, $specimen_query, $get_hospital_info) 
{
    ?>
    <a style="cursor: pointer;" data-toggle="modal" data-target="#prepublish_view">
        <img data-toggle="tooltip" data-placement="top" title="Click To View Pre-Publish Report" src="<?php echo base_url('assets/img/docs.png'); ?>">
    </a>
    <div id="prepublish_view" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Pre-Publish Report View</h4>
                </div>
                <div class="modal-body">
                    <?php get_publish_button($user_record_data, $request_query); ?>
                    <?php
                    $logo = base_url('assets/img/uralensis_latest.png');
                    if (!empty($request_query)) {
                        foreach ($request_query as $row1) :
                            global $serial_number;
                            global $pci_number;
                            global $first_name;
                            global $sur_name;
                            global $emis_number;
                            global $lab_number;
                            global $nhs_number;
                            global $dob;
                            global $clrk;
                            global $date_taken;
                            global $converted_time;
                            global $date_rec_bylab;

                            $id = $row1->id;
                            $time = $row1->publish_datetime;

                            $converted_time = '';
                            if ($time != '') {
                                $converted_time = date('M j Y', strtotime($time));
                            }
                            $serial_number = $row1->serial_number;
                            $pci_number = $row1->pci_number;
                            $emis_number = $row1->emis_number;
                            $nhs_number = $row1->nhs_number;
                            $lab_number = $row1->lab_number;
                            $hos_number = $row1->hos_number;
                            $sur_name = $row1->sur_name;
                            $first_name = $row1->f_name;
                            $var = $row1->dob;
                            $date = str_replace('/', '-', $var);
                            $change_dob = date('d-m-Y', strtotime($date));
                            $dob = !empty($change_dob) ? $change_dob : '';
                            $gender = $row1->gender;
                            $clrk = $row1->clrk;
                            $date_taken = !empty($row1->date_taken) ? date('d-m-Y', strtotime($row1->date_taken)) : '';
                            $urgent = $row1->urgent;
                            $hsc = $row1->hsc;
                            $cl_detail = $row1->cl_detail;
                            $date_rec_bylab = !empty($row1->date_received_bylab) ? date('d-m-Y', strtotime($row1->date_received_bylab)) : '';
                            $Result_clinical = str_replace("\n", '<br />', $cl_detail);
                            $comment_section = $row1->comment_section;
                            $comment_section_date = $row1->comment_section_date;
                        endforeach;
                    }

                    if (!empty($get_additional)) {
                        foreach ($get_additional as $row4) {
                            $additional_work = $row4->description;
                            $Result_additional = str_replace("\n", '<br />', $additional_work);
                            $additional_work_time = $row4->additional_work_time;
                        }
                    }

                    if (!empty($specimen_query)) {
                        foreach ($specimen_query as $row2) {
                            $specimen_type = $row2->specimen_type;
                            $specimen_site = $row2->specimen_site;
                            $specimen_right = $row2->specimen_right;
                            $specimen_left = $row2->specimen_left;
                            $specimen_na = $row2->specimen_na;
                            $user_first_name = $row2->first_name;
                            $user_last_name = $row2->last_name;
                            $user_email = $row2->email;
                            $user_phone = $row2->phone;
                        }
                    }

                    if (!empty($get_hospital_info)) {
                        foreach ($get_hospital_info as $row5) {
                            global $hospital_information;
                            $hospital_information = $row5->information;
                        }
                    }
                    ?>
                    <div style="margin:0 auto;">
                        <div class="row">
                            <div class="col-md-12">
                                <table width="100%">
                                    <tr>
                                        <td width="25%" align="left">
                                            <img width="180px" src="<?php echo $logo; ?>" />
                                        </td>
                                        <td width="32%" align="center" style="font-size:20px;"><b>Histopathology Report</b></td>
                                        <td width="50%" align="right">
                                            <table style="font-size:13.6px;text-align:left;">
                                                <tr><td width="45%">Serial Number : </td><td><b><?php echo $serial_number; ?></b></td></tr>
                                                <tr><td>PCI Number : </td><td><b><?php echo $pci_number; ?></b></td></tr>
                                                <tr><td>Patient Name : </td><td><b><?php echo $first_name . ' ' . $sur_name; ?></b></td></tr>
                                                <tr><td>EMIS Number : </td><td><b><?php echo $emis_number; ?></b></td></tr>
                                                <tr><td>LAB Ref : </td><td><?php echo $lab_number; ?></td></tr>
                                                <tr><td>NHS Ref : </td><td><?php echo $nhs_number; ?></td></tr>
                                                <tr><td>Date of Birth : </td><td><?php echo $dob; ?></td></tr>
                                                <tr><td>Clinician : </td><td><?php echo $clrk; ?></td></tr>
                                                <tr><td>Clinic Date : </td><td><?php echo $date_taken; ?></td></tr>
                                                <tr><td>Date Received By Lab : </td><td><?php echo $date_rec_bylab; ?></td></tr>
                                                <tr><td>Date Published : </td><td><?php echo $converted_time; ?></td></tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <?php echo $hospital_information; ?>
                                <?php
                                $count = 1;
                                if (!empty($specimen_query)) {
                                    foreach ($specimen_query as $row2) {
                                        $Result_macro = str_replace("\n", '<br />', $row2->specimen_macroscopic_description);
                                        $Result_micro = str_replace("\n", '<br />', $row2->specimen_microscopic_description);
                                        ?>
                                        <div style="border-bottom:1px solid black;"></div><br />
                                        <table>
                                            <tr>
                                                <td width="30%" style="font-size:18px;"><b>Specimen <?php echo $count; ?></b></td>
                                                <td></td>
                                            </tr>
                                            <br />
                                            <tr>
                                                <td width="13%"><b>Specimen : </b></td>
                                                <td width="2%"></td>
                                                <td width="85%"><?php echo $row2->specimen_type . '&nbsp;' . $row2->specimen_right . '&nbsp;' . $row2->specimen_left . '&nbsp;' . $row2->specimen_na . '&nbsp;' . $row2->specimen_site; ?></td>
                                            </tr>
                                            <br />
                                            <tr>
                                                <td width="13%"><b>Macroscopic Description : </b></td>
                                                <td width="2%"></td>
                                                <td width="85%"><?php echo $Result_macro; ?></td>
                                            </tr>
                                            <br />
                                            <tr>
                                                <td width="13%"><b>Microscopic Description : </b></td>
                                                <td width="2%"></td>
                                                <td width="85%"><?php echo $Result_micro; ?></td>
                                            </tr>
                                        </table>
                                        <?php
                                        $count++;
                                    }
                                }
                                ?>
                                <?php
                                $supp_count = 1;
                                foreach ($get_additional as $row4) {
                                    $additional_work = $row4->description;
                                    $Result_additional = str_replace("\n", '<br />', $additional_work);
                                    $additional_work_time = $row4->additional_work_time;
                                    if (isset($Result_additional) && $Result_additional != '') {
                                        ?>
                                        <br /><br />
                                        <div style="border-bottom:1px solid black;"></div>
                                        <table>
                                            <tr>
                                                <td><b>Supplementary Report <?php echo $supp_count . ' &nbsp; | &nbsp; Requested Time : ' . date('M j Y g:i A', strtotime($additional_work_time)); ?> </b></td>
                                            </tr>
                                            <br />
                                            <tr>
                                                <td><?php echo $Result_additional; ?></td>
                                            </tr>
                                        </table>
                                        <?php
                                    }
                                    $supp_count++;
                                }
                                ?>
                                <?php
                                if (isset($comment_section) && $comment_section != '') {
                                    ?>

                                    <br /><br />
                                    <div style="border-bottom:1px solid black;"></div>
                                    <table>
                                        <tr>
                                            <td><b>Additional Comments  &nbsp; | &nbsp; Comment Time : <?php echo date('d-m-Y g:i A', strtotime($comment_section_date)); ?></b></td>
                                        </tr>
                                        <br />
                                        <tr>
                                            <td><?php echo $comment_section; ?></td>
                                        </tr>
                                    </table>
                                <?php } ?>
                                <br /><br />
                                <div style="border-bottom:1px solid black;"></div>
                                <table>
                                    <tr>
                                        <td style="font-size:14px;"><b>Reported by: Dr. <?php echo $user_first_name . ' ' . $user_last_name; ?></b><b>GMC: 4336598. </b><b>Email: <?php echo $user_email; ?></b><b>Mobile: <?php echo $user_phone; ?></b></td>
                                    </tr>
                                </table>
                                <?php
                                if ($request_query[0]->mdt_case_status === 'not_for_mdt' && $request_query[0]->mdt_case === 'add_to_report') {
                                    ?>
                                    <div style="border-bottom:1px solid black;"></div>
                                    <table>
                                        <tr>
                                            <td style="font-size:14px;"><b>This case is NOT required for the Local Skin MDT</b></td>
                                        </tr>
                                    </table>
                                    <?php
                                }
                                if ($request_query[0]->mdt_case_status === 'for_mdt' && !empty($request_query[0]->mdt_case)) {
                                    ?>
                                    <div style="border-bottom:1px solid black;"></div>
                                    <table>
                                        <tr>
                                            <td style="font-size:14px;"><b>This case should be listed for the Local Skin MDT</b></td>
                                        </tr>
                                    </table>
                                    <?php
                                }

                                if ($request_query[0]->mdt_case_status === 'for_mdt') {
                                    if (!empty($request_query[0]->mdt_specimen_status)) {
                                        $specimen_data = unserialize($request_query[0]->mdt_specimen_status);
                                        ?>
                                        <table>
                                            <tr>
                                                <td style="font-size:14px;"><b>MDT Specimens.</b></td>
                                                <?php
                                                foreach ($specimen_data as $specimen_mdt) {
                                                    ?>
                                                    <td style="font-size:14px;"><b><?php echo $specimen_mdt; ?></b></td>
                                                    <?php
                                                }
                                                ?>
                                            </tr>
                                        </table>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Get Publish Button
 *
 * @param array $user_record_data
 * @param array $request_query
 * @return void
 */
function get_publish_button($user_record_data, $request_query) 
{

    if (!empty($user_record_data)) {
        $record_id = $user_record_data['record_id'];
        $user_id = $user_record_data['user_id'];
    }
    if (isset($request_query)) {

        foreach ($request_query as $check_publish) {
            if ($check_publish->specimen_update_status == 1) :
                if ($check_publish->specimen_publish_status == 0) {
                    ?>
                    <div class="col-md-2 custom_width">
                        <a style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Click To Publish This Report" id="user_auth_pop" >
                            <img src="<?php echo base_url('assets/img/pdf.png'); ?>">
                        </a>
                        <div id="user_auth_popup" style="display: none;">
                            <?php if (empty($check_publish->mdt_case) && empty($check_publish->mdt_case_status)) { ?>
                                <div class="well">
                                    <p>Please Select One Of The MDT Option.</p>
                                    <button class="btn btn-sm btn-success" id="close_popups_for_mdt">Add MDT</button>
                                </div>
                            <?php } ?>
                            <span class="button b-close"><span>X</span></span>
                            <div id="publish_button"></div>
                            <div class="publish_report_form">
                                <form class="form" method="post" id="check_auth_pass_form">
                                    <p>Enter Your Pin To Publish This Report.</p>
                                    <input autofocus maxlength="1" type="password" id="auth_pass1" name="auth_pass1">
                                    <input maxlength="1" type="password" name="auth_pass2">
                                    <input maxlength="1" type="password" name="auth_pass3">
                                    <input maxlength="1" type="password" name="auth_pass4">
                                    <input name="request_id" type="hidden" value="<?php echo $record_id; ?>">
                                    <input name="user_id" type="hidden" value="<?php echo $user_id; ?>">
                                    <hr>
                                    <button id="check_pass" class="pull-right btn btn-warning">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <?php
            else :
                echo '<div class="col-md-2 custom_width">';
                echo '<div class="alert alert-info" style="margin-bottom:0px; padding:7px;">Update Record.</div>';
                echo '</div>';
            endif;
        }
    }
}
