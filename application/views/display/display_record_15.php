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
                        <form action="<?php echo site_url('Admin/search_request'); ?>" method="post">
                            <table class="table table-bordered">
                                <tr class="bg-primary">
                                    <th>Patient Name</th>
                                    <th>Lab No</th>
                                    <th>Hos No</th>
                                    <th>Date Taken</th>
                                    <th>DOB</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input class="form-control" type="text" id="patient_name" name="patient_name">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="lab_no" name="lab_no">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="hos_no" name="hos_no">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="date_taken_search" name="date_taken">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="dob_search" name="dob">
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
<div class="row">
    <div class="col-md-12">
        <?php
        if ($this->session->flashdata('edit_message') != '') {
            echo $this->session->flashdata('edit_message');
        }
        ?>
        <?php
        if ($this->session->flashdata('specimen_added') != '') {
            echo $this->session->flashdata('specimen_added');
        }
        ?>
        <?php
        if ($this->session->flashdata('specimen_deleted') != '') {
            echo $this->session->flashdata('specimen_deleted');
        }
        ?>
        <?php
        if ($this->session->flashdata('unpublish_record_message') != '') {
            echo $this->session->flashdata('unpublish_record_message');
        }
        ?>
        <?php
        if ($this->session->flashdata('record_status') != '') {
            echo $this->session->flashdata('record_status');
        }
        ?>
        <table id="admin_display_records" class="table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr class="info">
                    <th>Serial No</th>
                    <th>First Name</th>
                    <th>Sur Name</th>
                    <th>EMIS No</th>
                    <th>NHS No.</th>
                    <th>LAB No.</th>
                    <th>Gender</th>
                    <th>Request Time</th>
                    <th>Detail</th>
                    <th>Edit</th>
                    <th>A.Status</th>
                    <th>P.Status</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tfoot>
                <tr class="info">
                    <th>Serial No</th>
                    <th>First Name</th>
                    <th>Sur Name</th>
                    <th>EMIS No</th>
                    <th>NHS No.</th>
                    <th>LAB No.</th>
                    <th>Gender</th>
                    <th>Request Time</th>
                    <th>Detail</th>
                    <th>Edit</th>
                    <th>A.Status</th>
                    <th>P.Status</th>
                    <th>Delete</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                foreach ($query as $row) :
                    ?>
                    <tr>
                        <td style="font-size:11px;font-weight: bold;"><?php echo $row->serial_number; ?></td>
                        <td><?php echo $row->f_name; ?></td>
                        <td><?php echo $row->sur_name; ?></td>
                        <td><?php echo $row->emis_number; ?></td>
                        <td><?php echo $row->nhs_number; ?></td>
                        <td><?php echo $row->lab_number; ?></td>
                        <td><?php echo $row->gender; ?></td>
                        <td><?php echo $row->request_datetime; ?></td>
                        <td style="text-align:center;"><a href="<?php echo site_url() . '/Admin/detail_view_record/' . $row->uralensis_request_id; ?>"><img src="<?php echo base_url('assets/img/detail.png'); ?>"></a></td>
                        <td><a href="<?php echo site_url() . '/Admin/edit_report/' . $row->uralensis_request_id; ?>"><img src="<?php echo base_url('assets/img/edit.png'); ?>">&nbsp;Edit Report</a></td>
                        <td>
                            <?php if ($row->assign_status == 1): ?>
                                <?php echo '<span style="color:green;"><img src="' . base_url('assets/img/correct.png') . '" />&nbsp;Assigned<span>' ?>

                                <?php
                            else:
                                echo '<span style=""><img src="' . base_url('assets/img/error.png') . '" />&nbsp;Not Assigned</span>';
                            endif;
                            ?>
                        </td>
                        <td>
                            <?php if ($row->specimen_publish_status == 1) : ?>
                                <button class="record_id_unpublish btn btn-link" data-recordserial="<?php echo $row->serial_number; ?>" data-unpublishrecordid="<?php echo site_url() . '/admin/unpublish_record/' . $row->uralensis_request_id; ?>">
                                    Un-Publish
                                </button>
                                <?php
                            else :
                                echo 'Not Published';
                            endif;
                            ?>
                        </td>
                        <td>
                            <button class="record_id_delete btn btn-link" data-recordserial="<?php echo $row->serial_number; ?>" data-delrecordid="<?php echo site_url() . '/admin/delete_admin_side_record/' . $row->uralensis_request_id; ?>">
                                <img src="<?php echo base_url('assets/img/delete.png'); ?>" />
                            </button>

                        </td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>



