<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style type="text/css">
    .custom-modal .modal-footer{
        padding: 15px;
    }
    .modal-dialog.modal-dialog-centered.modal-lg {
        width: 1000px;
    }
    .section_sub_title{
        font-size: 18px;
        font-weight: 700;
        padding: 10px 0;
    }
    .provider_information.request a{color: #000;font-weight: 700}
    .provider-id-table tr td{vertical-align: top;padding: 0; border: 0px;}
    .dash-widget-img{
        float: left;
        width: 60px;
    }
</style>
<div class="container-fluid cims_area">
    <div class="page-header">
        <div class="form-group">
           <div class="col-md-12">
                <h3 class="page-title">Dashboard/ Request an Investigation</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Request an Investigation</li>
                </ul>
           </div>
           
            <div class="clearfix"></div>  
        </div>  
    </div>

    <div class="wrap_con">

        <div class="tabs_area">
            <ul class="nav nav-tabs nav-tabs-solid">
                <li class="nav-item">
                    <a class="nav-link active" href="#patient_info" data-toggle="tab">
                        <img src="<?php echo base_url()?>assets/icons/cims_tab1_w.png" class="img-fluid on_active">
                        <img src="<?php echo base_url()?>assets/icons/cims_tab1.png" class="img-fluid simple">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#historical" data-toggle="tab">
                        <img src="<?php echo base_url()?>assets/icons/cims_tab2_w.png" class="img-fluid on_active">
                        <img src="<?php echo base_url()?>assets/icons/cims_tab2.png" class="img-fluid simple">
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
        
            <div class="tab-pane show active" id="patient_info">

                <section class="col-md-12 provider_information form-group text-uppercase">
                    <div class="section_title">provider ID</div>
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title form-group"><a href="javascript:;" class="edit-icon pull-right" data-toggle="modal" data-target="#edit_patient_service"><i class="fa fa-pencil"></i></a></h3>

                            <div class="col-md-12">
                                <table class="table custom-table provider-id-table">
                                    <tbody>
                                        <tr>
                                            <td style="width:25%">
                                                <p><label>Surename</label> : <span class="text-muted">ABC</span>
                                                <p><label>CR0060</label>
                                            </td>
                                            <td style="width:25%">
                                                <p><label>First Name</label> : <span class="text-muted">ABC</span>
                                                <p><label>CR0060</label>
                                            </td>
                                            <td style="width:25%">
                                                <p><label>DOB</label> : <span class="text-muted">1-1-1978</span>
                                                <p><label></label>
                                            </td>
                                            <td style="width:25%">
                                                <p><label>organisation identifier</label> : <span class="text-muted">ABC</span>
                                                <p><label>CR0030</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <p><label>Address (1st Line)</label> : <span class="text-muted">ABC</span>
                                                <p><label>CR0070</label>
                                            </td>
                                            <td colspan="2">
                                                <p><label>Address (2nd Line)</label> : <span class="text-muted">ABC</span>
                                                <p><label>CR0070</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><label>Postcode</label> : <span class="text-muted">ABC</span>
                                                <p><label>CR0080</label>
                                            </td>
                                            <td>
                                                <p><label>gender code</label> : <span class="text-muted">ABC</span>
                                                <p><label>CR3170</label>
                                            </td>
                                            <td>
                                                <p><label>COSD unique identifier</label> : <span class="text-muted">ABC</span>
                                                <p><label>CR0007</label>
                                            </td>
                                            <td>
                                                <p><label>NHS no.</label> : <span class="text-muted">ABC</span>
                                                <p><label>CR0010</label>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>
                                                <p><label>EMIS No.</label> : <span class="text-muted">ABC</span>
                                                <p><label>CR0020</label>
                                            </td>
                                            <td>
                                                <p><label>LOCAL PATIENT IDENTIFIER </label> : <span class="text-muted">ABC</span>
                                                <p><label>CR0020</label>
                                            </td>
                                            <td>
                                                <p><label>NHS NUMBER STATUS INDICATOR CODE </label> : <span class="text-muted">ABC</span>
                                                <p><label>CR0020</label>
                                            </td>
                                            <td></td>
                                        </tr>                                              
                                    </tbody>
                                </table>  
                            </div>
                        </div>
                    </div>
                </section>

                <section class="col-md-12 provider_information request form-group text-uppercase">
                    <div class="section_title">Request</div>
                    <div class="row">
                        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                            <div class="card dash-widget">
                                <div class="card-body">
                                    <span class="dash-widget-img">
                                        <img src="<?php echo base_url()?>assets/icons/haematology-b.png">
                                    </span>
                                    <div class="dash-widget-info">
                                        <h3>2</h3>
                                        <span><a href="javascript:;">Haematology</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                            <div class="card dash-widget">
                                <div class="card-body">
                                    <span class="dash-widget-img">
                                        <img src="<?php echo base_url()?>assets/icons/chemical-b.png">
                                    </span>
                                    <div class="dash-widget-info">
                                        <h3>2</h3>
                                        <span><a href="javascript:;">Chemical</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                            <div class="card dash-widget">
                                <div class="card-body">
                                    <span class="dash-widget-img">
                                        <img src="<?php echo base_url()?>assets/icons/genetics-b.png">
                                    </span>
                                    <div class="dash-widget-info">
                                        <h3>2</h3>
                                        <span><a href="javascript:;">Genetics</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                            <div class="card dash-widget">
                                <div class="card-body">
                                    <span class="dash-widget-img">
                                        <img src="<?php echo base_url()?>assets/icons/microbiology-b.png">
                                    </span>
                                    <div class="dash-widget-info">
                                        <h3>2</h3>
                                        <span><a href="javascript:;">Microbiology</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                            <div class="card dash-widget">
                                <div class="card-body">
                                    <span class="dash-widget-img">
                                        <img src="<?php echo base_url()?>assets/icons/histopathology-b.png">
                                    </span>
                                    <div class="dash-widget-info">
                                        <h3>2</h3>
                                        <span><a href="javascript:;">Histopathology</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                            <div class="card dash-widget">
                                <div class="card-body">
                                    <span class="dash-widget-img">
                                        <img src="<?php echo base_url()?>assets/icons/virology-b.png">
                                    </span>
                                    <div class="dash-widget-info">
                                        <h3>2</h3>
                                        <span><a href="javascript:;">Virology</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                            <div class="card dash-widget">
                                <div class="card-body">
                                    <span class="dash-widget-img">
                                        <img src="<?php echo base_url()?>assets/icons/mol-gene-b.png">
                                    </span>
                                    <div class="dash-widget-info">
                                        <h3>2</h3>
                                        <span><a href="javascript:;">Molecular & Genetics</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                            <div class="card dash-widget">
                                <div class="card-body">
                                    <span class="dash-widget-img">
                                        <img src="<?php echo base_url()?>assets/icons/forensic-b.png">
                                    </span>
                                    <div class="dash-widget-info">
                                        <h3>2</h3>
                                        <span><a href="javascript:;">Forensic</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                    
                </section>
            </div>

            <div class="tab-pane" id="historical">

                <section class="provider_information form-group text-uppercase">
                    <div class="section_title">patient: historical information </div>
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title form-group"><a href="javascript:;" class="edit-icon pull-right" data-toggle="modal" data-target="#edit_historical"><i class="fa fa-pencil"></i></a></h3>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="">Lab No</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for=""></label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">Digi No.</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for=""></label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">Lab</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for=""></label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">sample release date (by lab)</label>
                                    <label for=""></label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for="">PCR0970</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">sample reciept date (by doctor)</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for="">PCR0970</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">specimen nature</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for="">PCR0970</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">specimen category</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for="">PCR0970</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">status</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for="">PCR0970</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">sample collection date</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for="">PCR0970</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">sample reciept date (by lab)</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for="">PCR0970</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">SNOOMED VERSION (PATHOLOGY)</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for="">PCR0970</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">authorization date</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for="">PCR0970</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">service report identifier</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for="">PCR0970</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">PATHOLOGY OBSERVATION REPORT IDENTIFIER</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for="">PCR0970</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">SERVICE REPORT STATUS</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for="">PCR0970</label>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4 form-group">
                                    <label for="">Clinician</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for="">PCR0970</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">Clinician entry identifier</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for="">PCR0970</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">surgeon</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for="">PCR0970</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">surgeon entry identifier</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for="">PCR0970</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">ORGANISATION SITE IDENTIFIER</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for="">PCR0970</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">ORGANISATION IDENTIFIER</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for="">PCR0970</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">Pathologgy</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for="">PCR0970</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">Pathologgy entry identifier</label>
                                    <input type="text" class="form-control" disabled="">
                                    <label for="">PCR0970</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Popups  -->

    <div id="edit_historical" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title">PATIENT: HISTORICAL  INFORMATION</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="form-group text-uppercase">
                        <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="">Lab No</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">Digi No.</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">Lab</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">sample release date (by lab)</label>
                                    <label for=""></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">sample reciept date (by doctor)</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">specimen nature</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">specimen category</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">status</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">sample collection date</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">sample reciept date (by lab)</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">SNOOMED VERSION (PATHOLOGY)</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">authorization date</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">service report identifier</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">PATHOLOGY OBSERVATION REPORT IDENTIFIER</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">SERVICE REPORT STATUS</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4 form-group">
                                    <label for="">Clinician</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">Clinician entry identifier</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">surgeon</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">surgeon entry identifier</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">ORGANISATION SITE IDENTIFIER</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">ORGANISATION IDENTIFIER</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">Pathologgy</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">Pathologgy entry identifier</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                    </section>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info btn-lg btn-rounded">Update Information</button>
                </div>
            </div>
        </div>
    </div>

</div>