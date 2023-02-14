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
<div class="row">
    <div class="col-md-12">
        <?php echo $this->session->flashdata('record-msg'); ?>
        <table id="display_viewed_records" class="table table-striped">
            <thead>
                <tr class="bg-primary">
                    <th><input type="checkbox" name="check_all"><a href="javascript:;" class="generate-bulk-reports-viewed" data-bulkurl="<?php echo base_url('index.php/doctor/generateBulkReports'); ?>"><img width="22px" src="<?php echo base_url('assets/img/download-1.png'); ?>"></a><input type="hidden" name="bulk_report_ids"></th>
                    <th>Serial No</th>
                    <th>Track No</th>
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
        </table>
    </div>
</div>

