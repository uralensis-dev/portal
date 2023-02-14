<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style type="text/css">
    .modal.show .modal-dialog{
        max-width: 1000px;
    }
    .custom-modal .modal-body{
        max-height: 550px;
        overflow-y: auto;
    }
</style>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Patient Dashboard</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Patient Dashboard</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_patient"><i class="fa fa-plus"></i> Add Record/Specimen</a>
        </div>
    </div>
</div>


<div class="table-responsive">
    <table class="table custom-table datatable">
        <thead>
            <tr>
                <th>Sr.</th>
                <th>Patient Name</th>
                <th>Lab No. <br> Digi No.</th>
                <th>Collection Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>ABC</td>
                <td>9383 <br> 74374</td>
                <td>24-08-2020</td>
                <td style="text-align:right">
                    <div class="dropdown dropdown-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                            <a class="dropdown-item" href="#"><i class="fa fa-eye m-r-5"></i> View</a>
                            <a class="dropdown-item" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>




<div id="add_patient" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ADD RECORD/SPECIMEN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <section class="col-md-12 text-uppercase">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="">Lab No.</label>
                            <input type="text" class="form-control">
                            <label for=""></label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Digi No.</label>
                            <input type="text" class="form-control">
                            <label for=""></label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Lab</label>
                            <input type="text" class="form-control">
                            <label for=""></label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Sample Release Date (by Lab)</label>
                            <input type="text" class="form-control datetimepicker">
                            <label for=""></label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Sample Receipt Date (by Doctor)</label>
                            <input type="text" class="form-control">
                            <label for=""></label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Spacimen Nature</label>
                            <input type="text" class="form-control">
                            <label for="">PCR0970</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Spacimen Category</label>
                            <input type="text" class="form-control">
                            <label for=""></label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Status</label>
                            <input type="text" class="form-control">
                            <label for=""></label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Sample Collection Date</label>
                            <input type="text" class="form-control datetimepicker">
                            <label for="">PCR1010</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Sample Reciept Date (by Lab)</label>
                            <input type="text" class="form-control">
                            <label for="">Pcr0770</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Snomed version (Pathology)</label>
                            <input type="text" class="form-control">
                            <label for="">Pcr6990</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Authorisation Code</label>
                            <input type="text" class="form-control datetimepicker">
                            <label for="">Pcr0780</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Service Report Identifier</label>
                            <input type="text" class="form-control">
                            <label for="">Pcr0950</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Pathology Observation report identifier </label>
                            <input type="text" class="form-control">
                            <label for="">Pcr0900</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Service report status</label>
                            <input type="text" class="form-control">
                            <label for="">Pcr0950</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Clinician</label>
                            <input type="text" class="form-control">
                            <label for="">Pcr7120</label>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="">Clinician entry identifier</label>
                            <input type="text" class="form-control">
                            <label for="">Pcr7120</label>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="">Surgeon</label>
                            <input type="text" class="form-control">
                            <label for="">Pcr7120</label>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="">Surgeon entry identifier</label>
                            <input type="text" class="form-control">
                            <label for="">Pcr7120</label>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="">Organisation site identifier</label>
                            <input type="text" class="form-control">
                            <label for="">Pcr7120</label>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="">Organisation identifier</label>
                            <input type="text" class="form-control">
                            <label for="">Pcr7120</label>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="">Pathologist</label>
                            <input type="text" class="form-control">
                            <label for="">Pcr7120</label>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="">Pathologist entry identifier</label>
                            <input type="text" class="form-control">
                            <label for="">Pcr7120</label>
                        </div>
                    </div>
                </section>
            </div>
            <div class="modal-footer text-right">
                <button class="btn btn-info btn-lg btn-rounded">Save</button>
            </div>
        </div>
    </div>
</div>