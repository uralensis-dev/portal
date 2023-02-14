<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php 
$user_id = $this->ion_auth->user()->row()->id;
$hospital_user_specimen_data = $this->ion_auth->user($user_id)->row()->hospital_user_specimen_data;
?>
<style type="text/css">
    .nav-tabs.nav-tabs-solid>li {
        margin-bottom: 6px;
    }

    .nav-tabs.nav-tabs-solid>li>a {
        color: #fff;
        margin-left: 10px;
        font-size: 20px;
        font-family: inherit;
        border-radius: 0px !important;
        padding: 15px 20px;
        float: left;
    }
    .tooltipIcon img {
        max-width: 34px;
        margin-top: 10px;
    }
    
    .btn-link:hover{
        text-decoration: none;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding-left: 45px;
    }

    #template_preview .card {
        min-height: 475px;
    }

    .custom_card .card {
        min-height: 597px;
    }

    span.tooltipIcon {
        position: absolute;
        top: 0px;
        left: 17px;
        display: none;
    }

    button.add_temp {
        height: auto;
        right: 0;
        padding: 0 12px;
        width: auto;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .fa-file-o {
        position: absolute;
        left: 20px;
        width: 40px;
        text-align: center;
        font-size: 32px;
        z-index: 99;
        top: 15px;
    }
    .page-header .breadcrumb {
        background-color: transparent;
        color: #6c757d;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 0;
        padding: 0;
    }

    .page-header .breadcrumb a {
        color: #333;
    }

    .breadcrumb-item.active {
        color: #6c757d;
    }


    #barcode_no {
        height: 50px;
    }

    .nav-tabs.nav-tabs-solid>li>.dropdown-action {
        float: right;
    }

    /*.blue-border {
    border: 1px solid blue !important;
}*/

    .dropdown-menu-right a.dropdown-item {
        background: transparent;
        color: #222;
        font-size: 14px;
    }

    .nav-tabs.nav-tabs-solid>li>a:hover,
    .nav-tabs.nav-tabs-solid>li>a:focus {
        background-color: #00c5fb !important;
        border-color: #00c5fb !important;
        color: #fff !important;
    }

    .list_view {
        display: none;
    }

    .show {
        display: block;
    }

    .hide {
        display: none;
    }

    .cog-class {
        line-height: 1;
        margin-top: 10px;
    }

    .fa-th:before {
        content: "\f00a" !important;
    }

    a.action-icon.dropdown-toggle {
        background: #1b75cd;
        color: #fff;
        padding: 0 10px;
        height: 51px;
        border-radius: 0 !important;
        padding: 13px;
    }

    a.action-icon.dropdown-toggle:hover,
    a.action-icon.dropdown-toggle:focus {
        background-color: #00c5fb !important;
        border-color: #00c5fb !important;
        color: #fff !important;
    }

    .card {
        margin-bottom: 0;
    }

    .accordion-button {
        font-size: 1.5rem;
    }

    #patient-table tbody tr:hover {
        background-color: lightblue;
        cursor: pointer;
    }

    .page-wrapper.sidebar-patient {
        padding: 75px 30px 0;
    }

    .danger-text { 
        color: red;
    }

    #speciality-container {
        display: flex;
        flex-wrap: wrap;
    }

    .speciality-box {
        min-width: 200px;
        margin-right: 20px;
        padding: 20px 25px;
        border-radius: 12px;
        margin-bottom: 50px;
        box-shadow: 5px 5px 20px rgba(200, 200, 200, 0.7);
        cursor: pointer;
    }

    .selected-speciality {
        background-color: lightblue;
    }

    #next-button {
        position:absolute;
        bottom: 0;
        right: 10px;
        display: none;
    }

    .profile-widget{
        padding: 50px 15px;

    }

    .profile-img{
        width: auto;
        height: auto;
        margin-bottom: 20px;
    }

    .danger-text { 
        color: red;
    }

    #speciality-container {
        display: flex;
        flex-wrap: wrap;
    }


    .speciality-box {
        min-width: 200px;
        margin-right: 20px;
        padding: 20px 25px;
        border-radius: 12px;
        margin-bottom: 50px;
        box-shadow: 5px 5px 20px rgba(200, 200, 200, 0.7);
        cursor: pointer;
    }

    .selected-speciality {
        background-color: lightblue;
    }


</style>
<button class='btn btn-primary' data-toggle="modal" data-target="#record_download_history">Record Download History</button>
<div id="record_download_history" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Record Download History</h4>
            </div>
            <div class="modal-body">
                <table class='table table-bordered'>
                    <tr>
                        <th>ID</th>
                        <th>Record</th>
                        <th>Timestamp</th>
                    </tr>
                    <?php
                    if (!empty($download_history)) {
                        foreach ($download_history as $key => $value) {
                            $timestamp = '';
                            if (!empty($value['ura_bulk_report_timestamp'])) {
                                $timestamp = date('d-m-Y H:i:s', $value['ura_bulk_report_timestamp']);
                            }
                            ?>
                            <tr>
                                <td><?php echo html_purify($value['ura_bulk_report_history']); ?></td>
                                <td><?php echo html_purify($value['ura_bulk_report_record_data']); ?></td>
                                <td><?php echo $timestamp; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="flag_column" style="width:100px !important; float:right; position: inherit;">
    <div class="hover_flags record_detail_page">
        <div class="flag_images">
            <?php if ($query1[0]->flag_status === 'flag_red') { ?>
                <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_red.png'); ?>">
            <?php } elseif ($query1[0]->flag_status === 'flag_yellow') { ?>
                <img data-toggle="tooltip" data-placement="top" title="This case marked for review." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_yellow.png'); ?>">
            <?php } elseif ($query1[0]->flag_status === 'flag_blue') { ?>
                <img data-toggle="tooltip" data-placement="top" title="This case marked for ready to authorize." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_blue.png'); ?>">
            <?php } elseif ($query1[0]->flag_status === 'flag_black') { ?>
                <img data-toggle="tooltip" data-placement="top" title="This case marked as complete." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_black.png'); ?>">
            <?php } else { ?>
                <img data-toggle="tooltip" data-placement="top" title="This case marked as new case." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_green.png'); ?>">
            <?php } ?>

        </div>
        <ul class="report_flags list-unstyled list-inline">
            <?php
            $active = '';
            if ($query1[0]->flag_status === 'flag_green') {
                $active = 'flag_active';
            }
            ?>
            <li class="<?php echo $active; ?>">
                <a href="javascript:;" data-flag="flag_green" data-serial="<?php echo html_purify($query1[0]->serial_number); ?>" data-recordid="<?php echo $query1[0]->uralensis_request_id; ?>" class="hospital_flag_change_detail">
                    <img data-toggle="tooltip" data-placement="top" title="This case marked as new case." src="<?php echo base_url('assets/img/flag_green.png'); ?>">
                </a>
            </li>
            <?php
            $active = '';
            if ($query1[0]->flag_status === 'flag_red') {
                $active = 'flag_active';
            }
            ?>
            <li class="<?php echo $active; ?>">
                <a href="javascript:;" data-flag="flag_red" data-serial="<?php echo html_purify($query1[0]->serial_number); ?>" data-recordid="<?php echo intval($query1[0]->uralensis_request_id); ?>" class="hospital_flag_change_detail">
                    <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="<?php echo base_url('assets/img/flag_red.png'); ?>">
                </a>
            </li>
            <?php
            $active = '';
            if ($query1[0]->flag_status === 'flag_yellow') {
                $active = 'flag_active';
            }
            ?>
            <li class="<?php echo $active; ?>">
                <a href="javascript:;" data-flag="flag_yellow" data-serial="<?php echo html_purify($query1[0]->serial_number); ?>" data-recordid="<?php echo intval($query1[0]->uralensis_request_id); ?>" class="hospital_flag_change_detail">
                    <img data-toggle="tooltip" data-placement="top" title="This case marked for review." src="<?php echo base_url('assets/img/flag_yellow.png'); ?>">
                </a>
            </li>
            <?php
            $active = '';
            if ($query1[0]->flag_status === 'flag_blue') {
                $active = 'flag_active';
            }
            ?>
            <li class="<?php echo $active; ?>">
                <a href="javascript:;" data-flag="flag_blue" data-serial="<?php echo html_purify($query1[0]->serial_number); ?>" data-recordid="<?php echo intval($query1[0]->uralensis_request_id); ?>" class="hospital_flag_change_detail">
                    <img data-toggle="tooltip" data-placement="top" title="This case marked for ready to authorize." src="<?php echo base_url('assets/img/flag_blue.png'); ?>">
                </a>
            </li>
            <?php
            $active = '';
            if ($query1[0]->flag_status === 'flag_black') {
                $active = 'flag_active';
            }
            ?>
            <li class="<?php echo $active; ?>">
                <a href="javascript:;" data-flag="flag_black" data-serial="<?php echo html_purify($query1[0]->serial_number); ?>" data-recordid="<?php echo intval($query1[0]->uralensis_request_id); ?>" class="hospital_flag_change_detail">
                    <img data-toggle="tooltip" data-placement="top" title="This case marked as complete." src="<?php echo base_url('assets/img/flag_black.png'); ?>">
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr />
        <h3>Attached Documents</h3>
        <?php
        $record_id = $this->uri->segment(3);

        $session_data = array(
            'record_id' => $record_id
        );
        $this->session->set_userdata($session_data);
        ?>
        <?php
        if ($this->session->flashdata('upload_error') != '') {
            echo $this->session->flashdata('upload_error');
        }
        ?>
        <?php
        if ($this->session->flashdata('upload_success') != '') {
            echo $this->session->flashdata('upload_success');
        }
        ?>
        <?php
        if ($this->session->flashdata('delete_file') != '') {
            echo $this->session->flashdata('delete_file');
        }
        ?>
        <div id="accordion_docs" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="related_docs">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion_docs" href="#relateddocs" aria-expanded="true" aria-controls="relateddocs">
                            Click To Open Related Documents.
                        </a>
                        <img align="right" src="<?php echo base_url('assets/img/adobe.png'); ?>" />
                    </h4>
                </div>
                <div id="relateddocs" class="general_padding_t_r_b_l panel-collapse collapse" role="tabpanel" aria-labelledby="related_docs">
                    <form method="post" class="form-inline" enctype="multipart/form-data" action="<?php echo base_url('index.php/institute/do_upload/' . intval($record_id)); ?>">
                        <div class="form-group">
                            <input required id="upload_user_file" class="form-control" type="file" name="userfile" />
                        </div>
                        <button type="submit" class="btn btn-default">Upload</button>
                    </form>
                    <div id="files">
                        <table class="table table-striped">
                            <h3>Files</h3>
                            <tr style="background-color:#fff">
                                <th>File Name</th>
                                <th>Type</th>
                                <th>File Ext</th>
                                <th>View File</th>
                                <th>Download File</th>
                                <th>Delete</th>
                                <th>Uploaded by</th>
                                <th>Upload on</th>
                            </tr>
                            <?php
                            if (isset($files) && is_array($files)) {
                                $hospital_id = $this->ion_auth->user()->row()->id;
                                foreach ($files as $file) {
                                    $file_id = $file->files_id;
                                    $file_path = $file->file_path;
                                    $session_data = array(
                                        'file_path' => $file_path
                                    );
                                    $this->session->set_userdata($session_data);
                                    ?>
                                    <tr>
                                        <td><?php echo html_purify($file->title); ?></td>
                                        <td><?php
                                            if ($file->is_image == 1) {
                                                echo '<img src="' . base_url('assets/img/image_type.png') . '" />';
                                            } else {
                                                echo '<img src="' . base_url('assets/img/doc_type.png') . '" />';
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo html_purify($file->file_ext); ?></td>
                                        <td>
                                            <a href="<?php echo base_url() . 'uploads/' . html_purify($file->file_name); ?>" target="_blank">
                                                <img src="<?php echo base_url('assets/img/view.png'); ?>" />
                                                <?php echo ucfirst($file->title); ?>
                                            </a>
                                        </td>
                                        <td>
                                            <a download href="<?php echo base_url() . 'uploads/' . html_purify($file->file_name); ?>" target="_blank">
                                                <img src="<?php echo base_url('assets/img/download.png'); ?>" />
                                                <?php echo ucfirst($file->title); ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php if ($hospital_id == $file->user_id) : ?>
                                                <a href="<?php echo site_url() . '/institute/delete_record_files/' . intval($file_id); ?>">
                                                    <img src="<?php echo base_url('assets/img/delete.png'); ?>" />
                                                </a>
                                            <?php else : ?>
                                                <span>No Access</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo ucwords($file->user); ?></td>
                                        <td><?php
                                            $time = $file->upload_date;
                                            echo date('M j Y g:i A', strtotime($time));
                                            ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<?php if ($query1[0]->specimen_publish_status == 1) { ?>
    <div class="row">
        <div class="col-md-12">
            <?php
            $recordid = $this->uri->segment(3);

            display_mdt($mdt_cats, $recordid, $query1);
            ?>
        </div>
    </div>
    <hr>
<?php } ?>
<div class="row">
    <div class="col-md-12">

        <?php foreach ($query1 as $row) : ?>
            <div><b>Current Status is : </b>
                <?php
                if ($row->status == 0) :
                    echo '<span>In Progress <img src="' . base_url('/assets/img/fail.gif') . '"></span> ';
                else :
                    echo '<span style="color:green;">Completed <img src="' . base_url('/assets/img/success.gif') . '"></span> ';
                endif;
                ?>
            </div>
            <table class="table table-bordered">
                <tr class="info">
                    <th style="width:20%;">NHS No.</th>
                    <th style="width:20%;">LAB No.</th>
                    <th style="width:20%;">Emis No.</th>
                    <th style="width:40%;">Date/Time</th>
                </tr>
                <tr>
                    <td><?php echo $row->nhs_number; ?></td>
                    <td><?php echo $row->lab_number; ?></td>
                    <td><?php echo $row->emis_number; ?></td>
                    <td><?php echo $row->request_datetime; ?></td>
                </tr>
                <tr>
                    <td class="active"><strong>Patient Initial</strong></td>
                    <td><?php echo $row->patient_initial; ?></td>
                    <td class="active"><strong>PCI No.</strong></td>
                    <td><?php echo $row->pci_number; ?></td>

                </tr>
                <tr>
                    <td class="active"><strong>Gender</strong></td>
                    <td><?php echo $row->gender; ?></td>
                    <td class="active"><strong>Date of Birth</strong></td>
                    <td><?php echo $row->dob; ?></td>

                </tr>
                <tr>
                    <td class="active"><strong>Lab Name</strong></td>
                    <td><?php echo $row->lab_name; ?></td>

                </tr>
                <tr>
                    <td class="active"><strong>First Name</strong></td>
                    <td><?php echo $row->f_name; ?></td>
                    <td class="active"><strong>Surname</strong></td>
                    <td><?php echo $row->sur_name; ?></td>

                </tr>
                <tr>
                    <td class="active"><strong>Lab Receiving Date</strong></td>
                    <td><?php echo $row->date_received_bylab; ?></td>
                </tr>
                <tr>
                    <td class="active"><strong>Received back from Lab</strong></td>
                    <td><?php echo $row->date_sent_touralensis; ?></td>
                    <td class="active"><strong>Clinician Requesting Work</strong></td>
                    <td><?php echo $row->clrk; ?></td>

                </tr>
                <tr>
                    <td class="active"><strong>Date Taken</strong></td>
                    <td><?php echo $row->date_taken; ?></td>
                    <td class="active"><strong>Report Urgency</strong></td>
                    <td><?php echo $row->report_urgency; ?></td>

                </tr>
                <tr>
                    <td  class="active"><strong>Clinical Details</strong></td>
                    <td><?php echo $row->cl_detail; ?></td>
                    <td  class="active"><strong>Case Category</strong></td>
                    <td><?php echo $row->cases_category; ?></td>
                </tr>
            </table>
            <?php
        endforeach;
        ?>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-md-12">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <h3>Specimen Record</h3>
            <?php
            $count = 1;
            foreach ($query2 as $row) {
                ?>
                <div class="panel panel-info">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $count; ?>" aria-expanded="true" aria-controls="collapseOne">
                                Specimen <?php echo $count; ?>
                            </a>
                        </h4>
                    </div>
                    <div id="<?php echo $count; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <?php if($hospital_user_specimen_data !== 'on') { ?>
                                <tr>
                                    <td style="width:20%;" class="active"><strong>Specimen Site (T Code)</strong></td>
                                    <td style="width:40%;"><?php echo $row->specimen_site; ?></td>
                                    <td style="width:20%;" class="active"><strong>Specimen Procedure (P Code)</strong></td>
                                    <td style="width:40%;"><?php echo $row->specimen_procedure; ?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td style="width:20%;" class="active"><strong>Specimen Type</strong></td>
                                    <td style="width:20%;"><?php echo $row->specimen_type; ?></td>
                                    <td class="active"><strong>Specimen Slides</strong></td>
                                    <td><?php echo $row->specimen_slides; ?></td>
                                </tr>
                                <?php if($hospital_user_specimen_data !== 'on') { ?>
                                <tr>
                                    <td class="active"><strong>Specimen Block</strong></td>
                                    <td><?php echo $row->specimen_block; ?></td>
                                    <td class="active"><strong>Specimen Block Type</strong></td>
                                    <td><?php echo $row->specimen_block_type; ?></td>

                                </tr>
                                <?php } ?>
                                <tr>
                                    <td class="active"><strong>Specimen Macroscopic Description</strong></td>
                                    <td><?php echo $row->specimen_macroscopic_description; ?></td>
                                    <?php if($hospital_user_specimen_data !== 'on') { ?>
                                    <td class="active"><strong>Specimen Microscopic Code</strong></td>
                                    <td><?php echo $row->specimen_microscopic_code; ?></td>
                                    <?php } ?>
                                </tr>
                                <?php if($hospital_user_specimen_data !== 'on') { ?>
                                <tr>
                                    <td class="active"><strong>Specimen Microscopic Description</strong></td>
                                    <td><?php echo $row->specimen_microscopic_description; ?></td>
                                    <td class="active"><strong>Specimen Snomed Code</strong></td>
                                    <td><?php echo $row->specimen_snomed_code; ?></td>
                                </tr>
                                <?php } ?>
                                <?php if($hospital_user_specimen_data !== 'on') { ?>
                                <tr>
                                    <td class="active"><strong>Specimen Snomed Description</strong></td>
                                    <td><?php echo $row->specimen_snomed_description; ?></td>
                                    <td class="active"><strong>Specimen RCPath Code</strong></td>
                                    <td><?php echo $row->specimen_rcpath_code; ?></td>
                                </tr>
                                <?php } ?>
                                <?php if($hospital_user_specimen_data !== 'on') { ?>
                                <tr>
                                    <td  class="active"><strong>Specimen Diagnosis</strong></td>
                                    <td><?php echo $row->specimen_diagnosis_description; ?></td>
                                    <td  class="active"><strong>Specimen Cancer Register</strong></td>
                                    <td><?php echo $row->specimen_cancer_register; ?></td>
                                </tr>
                                <?php } ?>
                            </table>
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
<hr>
