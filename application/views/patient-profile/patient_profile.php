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
    .provider-id-table tr td{vertical-align: top;padding: 0; border: 0px;}
</style>
<div class="container-fluid cims_area">
    <div class="page-header">
        <div class="form-group">
           <div class="col-md-3">
                <h3 class="page-title">Dashboard/ Patient ID</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Patient ID</li>
                </ul>
           </div>
           <div class="tg-rightarea tg-rightsearchrecord">
              <div class="tg-searchrecordslide">
                 <div class="tg-previousrecord">
                    <a href="#">
                    <i class="fa fa-angle-left"></i>
                    <span>Previous Record</span>
                    </a>
                 </div>
                 <form class="tg-formtheme tg-searchrecord">
                    <fieldset>
                       <div class="form-group tg-inputicon">
                          <input type="text" class="form-control typeahead" placeholder="Search Record">
                          <i class="lnr lnr-magnifier"></i>
                       </div>
                    </fieldset>
                 </form>
                 <div class="tg-nextecord">
                    <a href="#">
                    <i class="fa fa-angle-right"></i>
                    <span>Next Record<em>0-20-6</em></span>
                    </a>
                 </div>
              </div>
              <div class="tg-flagcolor tg-flagcolortopbar">
                 <div class="tg-checkboxgroup">
                    <span class="tg-radio tg-flagcolor1">
                    <input  data-flag="flag_blue" data-serial="0-20-5" data-recordid="45092" class="detail_flag_change" type="radio" id="flag_blue" name="flag_sorting">
                    <label for="flag_blue" data-toggle="tooltip" data-placement="top" title="This case marked for ready to authorize." class="custom-tooltip"></label>
                    </span>
                    <span class="tg-radio tg-flagcolor2">
                    <input checked data-flag="flag_green" data-serial="0-20-5" data-recordid="45092" class="detail_flag_change" type="radio" id="flag_green" name="flag_sorting">
                    <label for="flag_green" data-toggle="tooltip" data-placement="top" title="This case marked as new case." class="custom-tooltip"></label>
                    </span>
                    <span class="tg-radio tg-flagcolor3">
                    <input  data-flag="flag_yellow" data-serial="0-20-5" data-recordid="45092" class="detail_flag_change" type="radio" id="flag_yellow" name="flag_sorting">
                    <label for="flag_yellow" data-toggle="tooltip" data-placement="top" title="This case marked for review." class="custom-tooltip"></label>
                    </span>
                    <span class="tg-radio tg-flagcolor4">
                    <input  type="radio" data-flag="flag_black" data-serial="0-20-5" data-recordid="45092" class="detail_flag_change" id="flag_black" name="flag_sorting">
                    <label for="flag_black" data-toggle="tooltip" data-placement="top" title="This case marked as complete." class="custom-tooltip"></label>
                    </span>
                    <span class="tg-radio tg-flagcolor5">
                    <input  data-flag="flag_red" data-serial="0-20-5" data-recordid="45092" class="detail_flag_change" type="radio" id="flag_red" name="flag_sorting">
                    <label for="flag_red" data-toggle="tooltip" data-placement="top" title="This case marked as urgent." class="custom-tooltip"></label>
                    </span>
                 </div>
              </div>
              <ul class="list-inline pull-right">
                 <li>
                    <a class="custom_badge_tat">
                    <span class="badge bg-warning">12</span>
                    </a>
                 </li>
              </ul>
              <figure class="tg-logobar">
                 <span class="tg-namelogo" data-toggle="tooltip" data-placement="top" title="">BH</span>
              </figure>
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

                <section class="provider_information form-group text-uppercase">
                    <div class="section_title">patient: provider ID</div>
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title form-group"><a href="javascript:;" class="edit-icon pull-right" data-toggle="modal" data-target="#edit_patient_service"><i class="fa fa-pencil"></i></a></h3>

                            <div class="row">
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
                    </div>
                </section>

                <section class="provider_information form-group text-uppercase">
                    <div class="section_title">speciment type</div>
                    <div class="card">
                        <div class="card-body">
                            <div class="circles">
                                <div class="circle circle_1">
                                    <p>Haematology</p>
                                    <img src="<?php echo base_url()?>assets/icons/pp01.png" class="img_circles" alt="">
                                </div>
                                <div class="circle circle_2">
                                    <p>Genetics</p>
                                    <img src="<?php echo base_url()?>assets/icons/pp02.png" class="img_circles" alt="">
                                </div>
                                <div class="circle circle_3">
                                    <p>Chemical</p>
                                    <img src="<?php echo base_url()?>assets/icons/pp03.png" class="img_circles" alt="">
                                </div>

                                <div class="logo_main">
                                    
                                    <img src="<?php echo base_url()?>assets/img/path_hub_logo2.png" class="img_circles" alt="">
                                
                                </div>
                                <div class="circle circle_4">
                                    <p>Virology</p>
                                    <img src="<?php echo base_url()?>assets/icons/pp04.png" class="img_circles" alt="">
                                </div>
                                <div class="circle circle_5">
                                    <p>Genetics</p>
                                    <img src="<?php echo base_url()?>assets/icons/pp05.png" class="img_circles" alt="">
                                </div>
                                <div class="circle circle_6">
                                    <p>Histopathology</p>
                                    <img src="<?php echo base_url()?>assets/icons/pp06.png" class="img_circles" alt="">
                                </div>
                                <div class="circle circle_7">
                                    <p>Microbiology</p>
                                    <img src="<?php echo base_url()?>assets/icons/pp07.png" class="img_circles" alt="">
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