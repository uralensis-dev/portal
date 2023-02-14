<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>View Record</h3>
            <?php foreach ($query as $row) : ?>
                <?php if ($row->assign_status == 0) : ?>
                    <div class="pull-right">
                        <?php
                        $req_id = $this->session->userdata('id');
                        ?>
                        <a href="<?php echo site_url() . '/Admin/list_doctors/' . $req_id; ?>"><button type="button" class="btn btn-primary">Assign</button></a>
                    </div>
                    <?php
                else :
                    $user_data['users'] = $this->admin_model->get_doctor_name();
                    foreach ($user_data['users'] as $users) :
                        echo '<span style="color:green;">Request has been assigned to : <b>' . $users->first_name . ' ' . $users->last_name . '</b></span>';
                    endforeach;
                endif;
                ?>
                <table class="table table-bordered">
                    <tr class="info">
                        <th>NHS No.</th>
                        <th>LAB No.</th>
                        <th>HOS No.</th>
                        <th>Date/Time</th>
                    </tr>

                    <tr>
                        <td><?php echo $row->nhs_number; ?></td>
                        <td><?php echo $row->lab_number; ?></td>
                        <td><?php echo $row->hos_number; ?></td>
                        <td><?php echo $row->request_datetime; ?></td>
                    </tr>
                    <tr>
                        <td class="active"><strong>Name</strong></td>
                        <td><?php echo $row->first_name; ?></td>
                        <td class="active"><strong>Sur Name</strong></td>
                        <td><?php echo $row->sur_name; ?></td>
                    </tr>
                    <tr>
                        <td class="active"><strong>Date of Birth</strong></td>
                        <td><?php echo $row->dob; ?></td>
                        <td class="active"><strong>Gender</strong></td>
                        <td><?php echo $row->gender; ?></td>
                    </tr>
                    <tr>
                        <td class="active"><strong>Clinician Requesting Work</strong></td>
                        <td><?php echo $row->first_name; ?></td>
                        <td class="active"><strong>Date Taken</strong></td>
                        <td><?php echo $row->date_taken; ?></td>
                    </tr>
                    <tr>
                        <td class="active"><strong>Urgent</strong></td>
                        <td><?php echo $row->urgent; ?></td>
                        <td class="active"><strong>HSC205</strong></td>
                        <td><?php echo $row->hsc; ?></td>
                    </tr>
                </table>
                <div class="row">
                    <div class="col-md-3">
                        <strong>Clinical Details : </strong>
                    </div>
                    <div class="col-md-9">
                        <p>
                            <?php echo $row->cl_detail; ?>
                        </p>
                    </div>
                </div> 
                <?php
            endforeach;
            ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
            </div>
            <h3>Specimen Record</h3>
            <?php foreach ($query as $row) : ?>
                <table class="table table-bordered">

                    <tr>
                        <td class="active"><strong>Specimen Site</strong></td>
                        <td><?php echo $row->specimen_site; ?></td>
                        <td class="active"><strong>Specimen Type</strong></td>
                        <td><?php echo $row->specimen_type; ?></td>

                    <tr>
                        <td class="active"><strong>Specimen Block</strong></td>
                        <td><?php echo $row->specimen_type; ?></td>
                        <td class="active"><strong>Specimen Slides</strong></td>
                        <td><?php echo $row->specimen_slides; ?></td>
                    </tr>
                    <tr>
                        <td class="active"><strong>Specimen Block Type</strong></td>
                        <td><?php echo $row->specimen_block_type; ?></td>
                        <td class="active"><strong>Specimen Macroscopic Code</strong></td>
                        <td><?php echo $row->specimen_macroscopic_code; ?></td>
                    </tr>
                    <tr>
                        <td class="active"><strong>Specimen Macroscopic Description</strong></td>
                        <td><?php echo $row->specimen_macroscopic_description; ?></td>
                        <td class="active"><strong>Specimen Info Save Code</strong></td>
                        <td><?php echo $row->specimen_info_save_code; ?></td>

                    </tr>
                    <tr>
                        <td class="active"><strong>Specimen Info Save Description</strong></td>
                        <td><?php echo $row->specimen_info_save_description; ?></td>
                        <td class="active"><strong>Specimen Microscopic Code</strong></td>
                        <td><?php echo $row->specimen_microscopic_code; ?></td>
                    </tr>
                    <tr>
                        <td class="active"><strong>Specimen Microscopic Description</strong></td>
                        <td><?php echo $row->specimen_microscopic_description; ?></td>
                        <td class="active"><strong>Specimen Diagnosis Code</strong></td>
                        <td><?php echo $row->specimen_diagnosis_code; ?></td>
                    </tr>
                    <tr>
                        <td class="active"><strong>Specimen Diagnosis Description</strong></td>
                        <td><?php echo $row->specimen_diagnosis_description; ?></td>
                        <td class="active"><strong>Specimen Comment Code</strong></td>
                        <td><?php echo $row->specimen_comment_code; ?></td>
                    </tr>
                    <tr>
                        <td class="active"><strong>Specimen Comment Description</strong></td>
                        <td><?php echo $row->specimen_comment_description; ?></td>
                        <td class="active"><strong>Specimen Snomed Code</strong></td>
                        <td><?php echo $row->specimen_snomed_code; ?></td>
                    </tr>
                    <tr>
                        <td class="active"><strong>Specimen Snomed Description</strong></td>
                        <td><?php echo $row->specimen_snomed_description; ?></td>
                        <td class="active"><strong>Specimen Information Code</strong></td>
                        <td><?php echo $row->specimen_information_code; ?></td>
                    </tr>
                    <tr>
                        <td class="active"><strong>Specimen Information Description</strong></td>
                        <td><?php echo $row->specimen_information_description; ?></td>
                        <td class="active"><strong>Specimen Status</strong></td>
                        <td><?php echo $row->specimen_status; ?></td>
                    </tr>
                    <tr>
                        <td class="active"><strong>Specimen Right</strong></td>
                        <td><?php echo $row->specimen_right; ?></td>
                        <td class="active"><strong>Specimen Left</strong></td>
                        <td><?php echo $row->specimen_left; ?></td>
                    </tr>
                    <tr>
                        <td class="active"><strong>Specimen NA</strong></td>
                        <td><?php echo $row->specimen_na; ?></td>
                        <td class="active"><strong>Specimen Urgent</strong></td>
                        <td><?php echo $row->specimen_urgent; ?></td>
                    </tr>
                    <tr>
                        <td class="active"><strong>Specimen Hsc 205</strong></td>
                        <td><?php echo $row->specimen_hsc_205; ?></td>
                        <td class="active"><strong>Request Id</strong></td>
                        <td><?php //echo $row->first_name;    ?></td>
                    </tr>
                </table>
            <?php endforeach; ?>
        </div>
    </div>
</div>



