<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <a href="<?php echo base_url('index.php/institute/show_clinic_dates'); ?>" class="btn btn-primary">Go Back</a>
        <?php
        if ($this->session->flashdata('upload_error') != '') {
            echo '<div class="alert alert-danger">' . $this->session->flashdata('upload_error') . '</div>';
        }
        ?>
        <?php
        if ($this->session->flashdata('clinic_edit') != '') {
            echo $this->session->flashdata('clinic_edit');
        }
        ?>
    </div>
</div>
<hr>
<?php
if (!empty($clinic_data)) {

    $total_patients = '';
    $total_samples = '';
    $imf_samples = '';
    foreach ($clinic_data as $clinic) {
        $total_patients = $clinic->ura_clinic_total_patients;
        $total_samples = $clinic->ura_clinic_total_samples;
        $imf_samples = $clinic->ura_clinic_imf_samples;
    }
}
?>
<div class="row">
    <form id="edit_clinic_date_form" action="<?php echo base_url('index.php/institute/process_edit_clinic_date'); ?>" enctype="multipart/form-data" method="post">
        <div class="col-md-6">
            <div class="form-group">
                <label for="total_patients">Total Patients</label>
                <input class="form-control" id="total_patients" type="text" name="total_patients" placeholder="Total No of Patients" value="<?php echo!empty($total_patients) ? $total_patients : ''; ?>">
            </div>
            <div class="form-group">
                <label for="total_samples">Total Samples</label>
                <input class="form-control" id="total_samples" type="text" name="total_samples" placeholder="Total No of Sampels" value="<?php echo!empty($total_samples) ? $total_samples : ''; ?>">
            </div>
            <div class="form-group">
                <label for="imf_samples">IMF Samples</label>
                <input class="form-control" id="imf_samples" type="text" name="imf_samples" placeholder="Total No of IMF Samples" value="<?php echo!empty($imf_samples) ? $imf_samples : ''; ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" style="margin-bottom:0px;">
                <label for="upload_checklist">Upload Checklist</label>
                <input class="form-control" id="upload_checklist" type="file" name="upload_checklist" style="margin-top:8px;">
                <div class="row">
                    <div class="col-md-9">
                        <div id="upload_checklist_items" class="collapse">
                            <?php
                            if (!empty($checklist_data)) {
                                echo '<ul class="list-group">';
                                foreach ($checklist_data as $checklist) {
                                    $file_ext = ltrim($checklist->ura_clinic_checklist_ext, ".");
                                    $modify_ext = strtolower($file_ext);
                                    ?>
                                    <li class="list-group-item"><?php echo $checklist->ura_clinic_checklist_form; ?>
                                        <a data-filetype="checklist_files" data-fileid="<?php echo $checklist->ucd_checklist_upload_id; ?>" href="javascript:;" class="delete_clinic_files">
                                            <i class="glyphicon glyphicon-remove pull-right" style="color: red;"></i>
                                        </a>
                                        <a data-exttype="<?php echo $modify_ext; ?>" class="hover_image" data-imageurl="<?php echo base_url() . 'clinic_uploads/' . $checklist->ura_clinic_checklist_form; ?>" href="<?php echo base_url() . 'clinic_uploads/' . $checklist->ura_clinic_checklist_form; ?>" target="_blank">
                                            <i class="glyphicon glyphicon-eye-open pull-right" style="color:#5cb85c; margin-right:10px;"></i>
                                        </a>
                                        <?php if ($modify_ext === 'png' || $modify_ext === 'jpg') { ?>
                                            <div style="display:none;" class="hover_image_frame clinic_docs_frame hover_<?php echo $modify_ext; ?>" >
                                                <img src="<?php echo base_url() . 'clinic_uploads/' . $checklist->ura_clinic_checklist_form; ?>">
                                                <hr>
                                                <button class="btn btn-warning" id="close_hover_image">Close</button>
                                            </div>
                                        <?php } ?>
                                        <?php if ($modify_ext === 'pdf' || $modify_ext === 'txt') { ?>
                                            <div style="display:none;" class="hover_image_frame clinic_docs_frame hover_<?php echo $modify_ext; ?>" >
                                                <iframe width="700" height="500"  src="<?php echo base_url() . 'clinic_uploads/' . $checklist->ura_clinic_checklist_form; ?>"></iframe>
                                                <hr>
                                                <button class="btn btn-warning" id="close_hover_image">Close</button>
                                            </div>
                                        <?php } ?>
                                    </li>

                                    <?php
                                }
                                echo '</ul>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button class="pull-right" type="button" data-toggle="collapse" data-target="#upload_checklist_items">View Files</button>
                    </div>
                </div>
            </div>
            <div class="form-group" style="margin-bottom:0px;">
                <label for="upload_request_form">Upload Request Form</label>
                <input class="form-control" id="upload_request_form" type="file" name="upload_request_form" style="margin-top:8px;">
                <div class="row">
                    <div class="col-md-9">
                        <div id="upload_request_form_items" class="collapse">
                            <?php
                            if (!empty($request_data)) {
                                $hopital_id = $_GET['hopital_id'];
                                echo '<ul class="list-group">';
                                foreach ($request_data as $request) {
                                    $file_ext = ltrim($request->ura_clinic_request_ext, ".");
                                    $modify_ext = strtolower($file_ext);
                                    ?>
                                    <li class="list-group-item"><?php echo $request->ura_clinic_request_form; ?>
                                        <a data-filetype="request_files" data-fileid="<?php echo $request->ucd_requestform_upload_id; ?>" href="javascript:;" class="delete_clinic_files">
                                            <i class="glyphicon glyphicon-remove pull-right" style="color: red;"></i>
                                        </a>
                                        <a data-exttype="<?php echo $modify_ext; ?>" class="hover_image" data-imageurl="<?php echo base_url() . 'clinic_uploads/' . $request->ura_clinic_request_form; ?>" href="<?php echo base_url() . 'clinic_uploads/' . $request->ura_clinic_request_form; ?>" target="_blank">
                                            <i class="glyphicon glyphicon-eye-open pull-right" style="color:#5cb85c; margin-right:10px;"></i>
                                        </a>
                                        <?php if ($modify_ext === 'png' || $modify_ext === 'jpg') { ?>
                                            <div style="display:none;" class="hover_image_frame clinic_docs_frame hover_<?php echo $modify_ext; ?>" >
                                                <img src="<?php echo base_url() . 'clinic_uploads/' . $request->ura_clinic_request_form; ?>">
                                                <hr>
                                                <button class="btn btn-warning" id="close_hover_image">Close</button>
                                            </div>
                                        <?php } ?>
                                        <?php if ($modify_ext === 'pdf' || $modify_ext === 'txt') { ?>
                                            <div style="display:none;" class="hover_image_frame clinic_docs_frame hover_<?php echo $modify_ext; ?>" >
                                                <iframe width="700" height="500"  src="<?php echo base_url() . 'clinic_uploads/' . $request->ura_clinic_request_form; ?>"></iframe>
                                                <hr>
                                                <button class="btn btn-warning" id="close_hover_image">Close</button>
                                            </div>
                                        <?php } ?>
                                    </li>
                                    <?php
                                }
                                echo '</ul>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button class="pull-right" type="button" data-toggle="collapse" data-target="#upload_request_form_items">View Files</button>
                    </div>
                </div>
            </div>
            <div class="form-group" style="margin-bottom:0px;">
                <label for="upload_other_doc">Upload Other Docs</label>
                <input class="form-control" id="upload_other_doc" type="file" name="upload_other_doc" style="margin-top:8px;">
                <div class="row">
                    <div class="col-md-9">
                        <div id="upload_other_doc_items" class="collapse">
                            <?php
                            if (!empty($otherdoc_data)) {
                                echo '<ul class="list-group">';
                                foreach ($otherdoc_data as $otherdoc) {
                                    $file_ext = ltrim($otherdoc->ura_clinic_otherdoc_ext, ".");
                                    $modify_ext = strtolower($file_ext);
                                    ?>
                                    <li class="list-group-item"><?php echo $otherdoc->ura_clinic_otherdoc_form; ?>
                                        <a data-filetype="other_files" data-fileid="<?php echo $otherdoc->ucd_otherdocs_upload_id; ?>" href="javascript:;" class="delete_clinic_files">
                                            <i class="glyphicon glyphicon-remove pull-right" style="color: red;"></i>
                                        </a>
                                        <a data-exttype="<?php echo $modify_ext; ?>" class="hover_image" data-imageurl="<?php echo base_url() . 'clinic_uploads/' . $otherdoc->ura_clinic_otherdoc_form; ?>" href="<?php echo base_url() . 'clinic_uploads/' . $otherdoc->ura_clinic_otherdoc_form; ?>" target="_blank">
                                            <i class="glyphicon glyphicon-eye-open pull-right" style="color:#5cb85c; margin-right:10px;"></i>
                                        </a>
                                        <?php if ($modify_ext === 'png' || $modify_ext === 'jpg') { ?>
                                            <div style="display:none;" class="hover_image_frame clinic_docs_frame hover_<?php echo $modify_ext; ?>" >
                                                <img src="<?php echo base_url() . 'clinic_uploads/' . $otherdoc->ura_clinic_otherdoc_form; ?>">
                                                <hr>
                                                <button class="btn btn-warning" id="close_hover_image">Close</button>
                                            </div>
                                        <?php } ?>
                                        <?php if ($modify_ext === 'pdf' || $modify_ext === 'txt') { ?>
                                            <div style="display:none;" class="hover_image_frame clinic_docs_frame hover_<?php echo $modify_ext; ?>" >
                                                <iframe width="700" height="500"  src="<?php echo base_url() . 'clinic_uploads/' . $otherdoc->ura_clinic_otherdoc_form; ?>"></iframe>
                                                <hr>
                                                <button class="btn btn-warning" id="close_hover_image">Close</button>
                                            </div>
                                        <?php } ?>
                                    </li>
                                    <?php
                                }
                                echo '</ul>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button class="pull-right" type="button" data-toggle="collapse" data-target="#upload_other_doc_items">View Files</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
            <div class="form-group">
                <?php
                $rec_id = $_GET['rec_id'];
                $hopital_id = $_GET['hopital_id'];
                $ref_key = $_GET['ref_key'];
                ?>
                <input type="hidden" name="rec_id" value="<?php echo $rec_id; ?>">
                <input type="hidden" name="hospital_id" value="<?php echo $hopital_id; ?>">
                <input type="hidden" name="ref_key" value="<?php echo $ref_key; ?>">
                <input type="submit" class="btn btn-success" name="save_clinic_date" value="Save Clinic Date">
            </div>
        </div>
    </form>
</div>

<?php
if (!empty($request_form)) {
    ?>
    <p class="lead text-center">Clinic Date Records</p>
    <table id="clinic_date_records" class="table table-striped">
        <thead>
            <tr class="bg-primary">
                <th>Serial No</th>
                <th>First Name</th>
                <th>Sur Name</th>
                <th>EMIS No</th>
                <th>NHS No.</th>
                <th>LAB No.</th>
                <th>Gender</th>
                <th>Request Time</th>
                <th>Detail</th>
                <th>Status</th>
                <th>View Report</th>
                <th>Download Report</th>
                <th>Request Form</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($request_form as $row) { ?>
                <tr>
                    <td style="font-size:11px;font-weight: bold;"><?php echo $row->serial_number; ?></td>
                    <td><?php echo $row->f_name; ?></td>
                    <td><?php echo $row->sur_name; ?></td>
                    <td><?php echo $row->emis_number; ?></td>
                    <td><?php echo $row->nhs_number; ?></td>
                    <td><?php echo $row->lab_number; ?></td>
                    <td><?php echo $row->gender; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row->request_datetime)); ?></td>
                    <td><a href="<?php echo site_url() . '/Institute/view_singlerecord/' . $row->uralensis_request_id; ?>"><img src="<?php echo base_url('assets/img/detail.png'); ?>"></a></td>
                    <td>
                        <?php
                        if ($row->status == 0) {
                            echo '<span>In Progress <img src="' . base_url('assets/img/error.png') . '"></span>';
                        } else {
                            echo '<span style="color:green;">Completed <img src="/uralensis/assets/img/success.gif"></span>';
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($row->specimen_publish_status == 1) {
                            echo '<a target="_blank" href="' . site_url('Institute/view_single_final/' . $row->uralensis_request_id) . '">View Report</a>';
                        } else {
                            echo '<span>Not Submitted by Dr.</span>';
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($row->specimen_publish_status == 1) {
                            echo '<a href="' . site_url('Institute/download_pdf/' . $row->uralensis_request_id) . '"><img src="' . base_url('assets/img/download.png') . '">Download Report</a>';
                        } else {
                            echo '<span>Not Submitted by Dr.</span>';
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        $request_form_id = $row->clinic_request_form;
                        $clinic_record_id = $row->clinic_ref_number;
                        $request_form_data = $this->Institute_model->get_request_form_data($request_form_id, $clinic_record_id);

                        $file_ext = '';
                        if (!empty($request_form_data)) {
                            $file_ext = ltrim($request_form_data[0]->ura_clinic_request_ext, ".");
                        }

                        $modify_ext = strtolower($file_ext);
                        if (!empty($request_form_data)) {
                            echo '<a href="' . base_url() . 'clinic_uploads/' . $request_form_data[0]->ura_clinic_request_form . '" target="_blank"><img src="' . base_url('assets/img/view.png') . '"></a>';
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php
}
?>