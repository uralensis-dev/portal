<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="tg-dashboardbox inner-page-content">
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
                        <div class="well">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <a href="<?php echo site_url('/admin/download_reports'); ?>" class="thumbnail">
                                        <img src="<?php echo base_url('assets/img/tracker_reprot.jpg'); ?>" alt="Tracker Report">
                                    </a>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <a href="<?php echo site_url('admin/show_finance_display'); ?>" class="thumbnail">
                                        <img src="<?php echo base_url('assets/img/fiance_report.jpg'); ?>" alt="Finance Report">
                                    </a>
                                </div>
                                </div> 
                                <br/><br/><div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <a href="<?php echo site_url('admin/tatscores_reports'); ?>" class="thumbnail">
                                        <img src="<?php echo base_url('assets/img/tatscores_report.jpg'); ?>" alt="TAT Scores Report">
                                    </a>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <a href="<?php echo site_url('admin/classification_reports'); ?>" class="thumbnail">
                                        <img src="<?php echo base_url('assets/img/classification_report.jpg'); ?>" alt="Classification Reports">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>