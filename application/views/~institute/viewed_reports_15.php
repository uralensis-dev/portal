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

<div class="row">
    <div class="col-md-12">
        <?php echo $this->session->flashdata('record-msg'); ?>
        <table id="display_viewed_records" class="table table-striped">
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
                    <th>Status</th>
                    <th>View Report</th>
                    <th>Download Report</th>
                    <th>Documents</th>
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
                    <th>Status</th>
                    <th>View Report</th>
                    <th>Download Report</th>
                    <th>Documents</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                if (!empty($query)) {
                    foreach ($query as $row) {
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
                            <td><a href="<?php echo site_url() . '/Institute/view_singlerecord/' . $row->uralensis_request_id; ?>"><img src="<?php echo base_url('assets/img/detail.png'); ?>"></a></td>
                            <td>
                                <?php
                                if ($row->status == 0) :
                                    echo '<span>In Progress <img src="/uralensis/assets/img/fail.gif"></span>';
                                else :
                                    echo '<span style="color:green;"><img src="' . base_url('assets/img/completed.png') . '"></span>';
                                endif;
                                ?>
                            </td>
                            <?php
                            if ($row->specimen_publish_status == 1) :

                                echo '<td><a target="_blank" href="' . site_url('Institute/view_single_final/' . $row->uralensis_request_id) . '"><img src="' . base_url('assets/img/view.png') . '">&nbsp;View</a></td>';

                            else :
                                echo '<td><span>Not Submitted by Dr.</span></td>';
                            endif;
                            ?>
                            <?php
                            if ($row->specimen_publish_status == 1) :

                                echo '<td><a download href="' . site_url('Institute/download_pdf/' . $row->uralensis_request_id) . '"><img src="' . base_url('assets/img/download.png') . '">Download</a></td>';

                            else :
                                echo '<td><span>Not Submitted by Dr.</span></td>';
                            endif;
                            ?>
                            <td>
                                <a href="<?php echo site_url() . '/institute/institute_download_section/' . $row->uralensis_request_id; ?>"><img src="<?php echo base_url('assets/img/adobe.png'); ?>" />&nbsp;Docs</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>

    </div>
</div>

