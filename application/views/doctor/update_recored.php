<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$id = $this->uri->segment(3);
$data1['query'] = $this->Doctor_model->doctor_record_detail($id);
$data2['query'] = $this->Doctor_model->doctor_record_detail_specimen($id);

$view_pdf = array_merge($data1, $data2);

/* Snomed T Code */
require_once('application/views/doctor/inc/snomed/snomed-t-code.php');

/* Snomed P Code */
require_once('application/views/doctor/inc/snomed/snomed-p-code.php');

/* Snomed M Code */
require_once('application/views/doctor/inc/snomed/snomed-m-code.php');
?>

<div class="row">
    <div class="col-md-12">
        <?php
        if ($this->session->flashdata('update_report_message') != '') {
            echo $this->session->flashdata('update_report_message');
        }
        ?>
        <?php
        if ($this->session->flashdata('update_specimen_message') != '') {
            echo $this->session->flashdata('update_specimen_message');
        }
        ?>
        <?php
        if ($this->session->flashdata('final_report_message') != '') {
            echo $this->session->flashdata('final_report_message');
        }
        ?>
        <div class="row">
            <div class="col-md-2">
                <a href="<?php echo base_url('index.php/doctor/doctor_record_detail/' . $id); ?>"><button class="btn btn-primary"><< Go Back</button></a>
            </div>
            <div class="col-md-3 col-md-offset-4">
                <?php

                //Check if the specimen Update show the view pdf button.
                foreach ($data1['query'] as $pdf) {
                    if ($pdf->specimen_update_status == 1) {
                        ?>
                        <a target="_blank" href="<?php echo site_url() . '/doctor/view_report/' . $id; ?>"><button class="btn btn-info">View Pre-Publish Report</button></a>
                        <?php
                    }
                }
                ?>
            </div>
            <div class="col-md-3">
                <?php
                foreach ($data1['query'] as $check_publish) {
                    if ($check_publish->specimen_update_status == 1) : ?>
                    <form method="post" action="<?php echo site_url('doctor/publish_report/' . $id); ?>">
                        <button type="submit" class="pull-right btn btn-warning" name="submit"><strong>Publish Report</strong></button>
                    </form>
                    <?php
                    else : 
                        echo '<div class="alert alert-info">To Publish This Record Update the Record First.</div>';
                    endif;
                }
                ?>

            </div>
        </div>

        <h1 style="text-align: center;">Edit Request</h1>
        <hr />
        <form method="post" action="<?php echo site_url('doctor/update_only_report/' . $id); ?>">
            <?php foreach ($data1['query'] as $row): ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>SurName</label>
                            <input readonly type="text" class="form-control" name="sur_name" id="sur_name" placeholder="SurName" value="<?php echo $row->sur_name; ?>" />
                        </div>
                        <div class="form-group">
                            <label>First Name</label>
                            <input readonly type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?php echo $row->f_name; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Emis Number :</label>
                            <input readonly type="text" class="form-control" name="emis_number"  id="emis_number" placeholder="Emis Number" value="<?php echo $row->emis_number; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Nhs Number :</label>
                            <input readonly type="text" class="form-control" name="nhs_number"  id="nhs_number" placeholder="Nhs Number" value="<?php echo $row->nhs_number; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Lab Number</label>
                            <input type="text" class="form-control" name="lab_number" id="lab_number" placeholder="Lab Number" value="<?php echo $row->lab_number; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Hospital Number</label>
                            <input type="text" class="form-control" name="hos_number" id="hos_number" placeholder="Hospital Number" value="<?php echo $row->hos_number; ?>" />
                        </div>

                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input readonly type="text" class="form-control" name="dob" id="dob" placeholder="Date of Birth" value="<?php echo $row->dob; ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Gender</label>
                            <input readonly type="text" class="form-control" name="gender" id="dob" placeholder="Gender" value="<?php echo $row->gender; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Clinical Requesting Work</label>
                            <input readonly type="text" class="form-control" name="clrk" id="clrk" placeholder="Clinical Requesting Work" value="<?php echo $row->clrk; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Date Taken</label>
                            <input type="text" class="form-control" name="date_taken" id="datetaken_doctor" placeholder="Date Taken" value="<?php echo $row->date_taken; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Request Urgent</label>
                            <input readonly type="text" class="form-control" name="urgent" id="date" placeholder="Urgent" value="<?php echo $row->urgent; ?>" />
                        </div>
                        <div class="form-group">
                            <label> Request HSC205</label>
                            <input readonly type="text" class="form-control" name="hsc" id="date" placeholder="HSC205" value="<?php echo $row->hsc; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Clinical Detail <b style="color:red;">*</b></label>
                            <textarea required class="form-control"  name="cl_detail" id="cl_detail" placeholder="Clinical Detail"><?php echo $row->cl_detail; ?></textarea>
                        </div>
                        <hr />
                        <button type="submit" class="btn btn-info" name="submit">Update Report</button>
                    </div>
                </div>

            <?php endforeach; ?>
        </form>
        <hr />
        <?php
        $count = 1;
        foreach ($data2['query'] as $row) :
            $session_data = array(
                'specimen_id' => $row->specimen_id
            );
            $this->session->set_userdata($session_data);
            $specimen_id = $this->session->userdata('specimen_id');
            ?>
            <form method="post" action="<?php echo site_url('doctor/update_client_report/' . $specimen_id); ?>">

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-info">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $count; ?>" aria-expanded="true" aria-controls="collapseOne">
                                            Specimen <?php echo $count; ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="<?php echo $count; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Specimen Type</label>
                                                    <input readonly type="text" class="form-control" name="specimen_type" id="date" placeholder="Specimen Type" value="<?php echo $row->specimen_type; ?>" />
                                                </div>
                                                <div class="form-group">
                                                    <label>Specimen Site</label>
                                                    <input type="text" class="form-control" name="specimen_site" id="date" value="<?php echo $row->specimen_site; ?>"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Specimen Block</label>
                                                    <input type="text" class="form-control" name="specimen_block" id="date" value="<?php echo $row->specimen_block; ?>"/>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Specimen Slides</label>
                                                    <input type="text" class="form-control" name="specimen_slides" id="date" value="<?php echo $row->specimen_slides; ?>"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Specimen Block Type</label>
                                                    <input type="text" class="form-control" name="specimen_block_type" id="date" value="<?php echo $row->specimen_block_type; ?>"/>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Specimen Status</label>
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td><b>Specimen Right</b></td>
                                                        <td><b>Specimen Left</b></td>
                                                        <td><b>Specimen NA</b></td>
                                                        <td><b>Specimen Urgent</b></td>
                                                        <td><b>Specimen HSC 205</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo $row->specimen_right; ?></td>
                                                        <td><?php echo $row->specimen_left; ?></td>
                                                        <td><?php echo $row->specimen_na; ?></td>
                                                        <td><?php echo $row->specimen_urgent; ?></td>
                                                        <td><?php echo $row->specimen_hsc_205; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6 dynamic_data">
                                            <div class="form-group">
                                                <label>Specimen Macroscopic Code</label>
                                                <input type="text" class="form-control" name="specimen_macroscopic_code" id="specimen_macroscopic_code" value="<?php echo $row->specimen_macroscopic_code; ?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Specimen Macroscopic Description <b style="color:red;">*</b></label>
                                                <textarea required class="form-control" name="specimen_macroscopic_description" id="specimen_macroscopic_description"><?php echo $row->specimen_macroscopic_description; ?></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>Specimen Microscopic Code </label>
                                                <input type="text" class="form-control specimen_microscopic_code" name="specimen_microscopic_code" id="specimen_microscopic_code" value="<?php echo $row->specimen_microscopic_code; ?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Specimen Microscopic Description <b style="color:red;">*</b></label>
                                                <textarea required class="form-control specimen_microscopic_description" name="specimen_microscopic_description" id="specimen_microscopic_description"><?php echo $row->specimen_microscopic_description; ?></textarea>

                                            </div>
                                            <div class="form-group">
                                                <label>Specimen Info Save</label>
                                                <input  type="text" class="form-control" name="specimen_info_save_code" id="specimen_info_save_code" value="<?php echo $row->specimen_info_save_code; ?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Specimen Info Save Description</label>
                                                <textarea class="form-control" name="specimen_info_save_description" id="specimen_info_save_description"><?php echo $row->specimen_info_save_description; ?></textarea>

                                            </div>
                                            <div class="form-group">
                                                <label>Specimen Comment Code</label>
                                                <input type="text" class="form-control" name="specimen_comment_code" id="specimen_comment_code" value="<?php echo $row->specimen_comment_code; ?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Specimen Comment Description</label>
                                                <textarea class="form-control" name="specimen_comment_description" id="specimen_comment_description"><?php echo $row->specimen_comment_description; ?></textarea>

                                            </div>


                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Specimen Diagnosis Code</label>
                                                <input type="text" class="form-control" name="specimen_diagnosis_code" id="specimen_diagnosis_code" value="<?php echo $row->specimen_diagnosis_code; ?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Specimen Diagnosis Description</label>
                                                <textarea class="form-control" name="specimen_diagnosis_description" id="specimen_diagnosis_description"><?php echo $row->specimen_diagnosis_description; ?></textarea>

                                            </div>
                                            <div class="form-group">
                                                <label>Specimen Snomed Code</label>
                                                <input  type="text" class="form-control" name="specimen_snomed_code" id="specimen_snomed_code"  value="<?php echo $row->specimen_snomed_code; ?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Specimen Snomed Description</label>
                                                <textarea class="form-control" name="specimen_snomed_description" id="specimen_snomed_description"><?php echo $row->specimen_snomed_description; ?></textarea>

                                            </div>

                                            <div class="form-group">
                                                <?php
                                                $snomed_t_array = snomed_t_code();
                                                $snomed_t_id = $row->specimen_snomed_t;
                                                if (isset($snomed_t_id) && !empty($snomed_t_id)) {

                                                    $snomed_t_saved_value = snomed_t_code($snomed_t_id, 'value');
                                                } else {
                                                    $snomed_t_saved_value = 'Select Snomed To Save';
                                                }
                                                ?>
                                                <label for="specimen_snomed_t">Snomed T &nbsp;|&nbsp;<span class="bg-success">Saved Value is : <?php echo $snomed_t_saved_value; ?></span> </label>
                                                <select  name="specimen_snomed_t" id="specimen_snomed_t"  class="form-control selectpicker" data-live-search="true">
                                                    <?php
                                                    foreach ($snomed_t_array as $key => $snomed_t_code) {
                                                        $selected = '';
                                                        if ($key == $row->specimen_snomed_t) {

                                                            $selected = 'selected';
                                                        }
                                                        ?>
                                                        <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $snomed_t_code; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>

                                            </div>

                                            <div class="form-group">
                                                <?php
                                                $snomed_p_array = snomed_p_code();
                                                $snomed_p_id = $row->specimen_snomed_p;
                                                if (isset($snomed_p_id) && !empty($snomed_p_id)) {

                                                    $snomed_p_saved_value = snomed_p_code($snomed_p_id, 'value');
                                                } else {
                                                    $snomed_p_saved_value = 'Select Snomed To Save';
                                                }
                                                ?>
                                                <label for="specimen_snomed_p">Snomed P &nbsp;|&nbsp;<span class="bg-success">Saved Value is : <?php echo $snomed_p_saved_value; ?></span> </label>
                                                <select name="specimen_snomed_p" id="specimen_snomed_p"  class="form-control selectpicker" data-live-search="true">
                                                    <?php
                                                    foreach ($snomed_p_array as $key => $snomed_p_code) {
                                                        $selected = '';
                                                        if ($key == $row->specimen_snomed_p) {

                                                            $selected = 'selected';
                                                        }
                                                        ?>
                                                        <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $snomed_p_code; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>

                                            </div>

                                            <div class="form-group">
                                                <?php
                                                $snomed_m_array = snomed_m_code();
                                                $snomed_m_id = $row->specimen_snomed_m;
                                                if (isset($snomed_m_id) && !empty($snomed_m_id)) {

                                                    $snomed_m_saved_value = snomed_m_code($snomed_m_id, 'value');
                                                } else {
                                                    $snomed_m_saved_value = 'Select Snomed To Save';
                                                }
                                                ?>
                                                <label for="specimen_snomed_m">Snomed M &nbsp;|&nbsp;<span class="bg-success">Saved Value is : <?php echo $snomed_m_saved_value; ?></span> </label>
                                                <select name="specimen_snomed_m" id="specimen_snomed_m"  class="form-control selectpicker" data-live-search="true">

                                                    <?php
                                                    foreach ($snomed_m_array as $key => $snomed_m_code) {
                                                        $selected = '';
                                                        if ($key == $row->specimen_snomed_m) {

                                                            $selected = 'selected';
                                                        }
                                                        ?>
                                                        <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $snomed_m_code; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Specimen Information Code</label>
                                                <input type="text" class="form-control" name="specimen_information_code" id="date" value="<?php echo $row->specimen_information_code; ?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Specimen Information Description</label>
                                                <textarea class="form-control" name="specimen_information_description" id="date"><?php echo $row->specimen_information_description; ?></textarea>
                                            </div>
                                            <input type="hidden" name="data_hidden" value="<?php echo $row->id; ?>" />
                                            <button type="submit" class="btn btn-info" name="submit">Update Diagnosis</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <?php
            $count++;
        endforeach;
        ?>
        <br /><br /><br />
    </div>
</div>
</div>



