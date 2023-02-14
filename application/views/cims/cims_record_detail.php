<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style type="text/css">
    .custom-modal .modal-footer{
        padding: 15px;
    }
</style>
<div class="container-fluid cims_area">
    <div class="page-header">
        <div class="form-group">
           <div class="col-md-3">
                <h3 class="page-title">CIMS Records</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">CIMS Record Details</li>
                </ul>
           </div>
           <div class="tg-rightarea tg-rightsearchrecord">
              <div class="tg-searchrecordslide">
                 <div class="tg-previousrecord">
                    <a href="#">
                    <i class="fa fa-angle-left"></i>
                    <span>Previous Record<em>0-20-10</em></span>
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
                    <span class="badge bg-success">
                    12                                   </span>
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
                    <a class="nav-link" href="#investigation" data-toggle="tab">
                        <img src="<?php echo base_url()?>assets/icons/cims_tab2_w.png" class="img-fluid on_active">
                        <img src="<?php echo base_url()?>assets/icons/cims_tab2.png" class="img-fluid simple">
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#diagnosis_info" data-toggle="tab">
                        <img src="<?php echo base_url()?>assets/icons/cims_tab3_w.png" class="img-fluid on_active">
                        <img src="<?php echo base_url()?>assets/icons/cims_tab3.png" class="img-fluid simple">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#md_dataset" data-toggle="tab">
                        <img src="<?php echo base_url()?>assets/icons/cims_tab4_w.png" class="img-fluid on_active">
                        <img src="<?php echo base_url()?>assets/icons/cims_tab4.png" class="img-fluid simple">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#treatement_breach" data-toggle="tab">
                        <img src="<?php echo base_url()?>assets/icons/cims_tab5_w.png" class="img-fluid on_active">
                        <img src="<?php echo base_url()?>assets/icons/cims_tab5.png" class="img-fluid simple">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#mdt" data-toggle="tab">
                        <img src="<?php echo base_url()?>assets/icons/cims_tab6_w.png" class="img-fluid on_active">
                        <img src="<?php echo base_url()?>assets/icons/cims_tab6.png" class="img-fluid simple">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="tab">
                        <img src="<?php echo base_url()?>assets/icons/cims_tab7_w.png" class="img-fluid on_active">
                        <img src="<?php echo base_url()?>assets/icons/cims_tab7.png" class="img-fluid simple">
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <section class="form-group">
                <table class="table custom-table">
                    <tr>
                        <td><span>Smith, Alan</span></td>
                        <td><span class="circle">M26</span></td>
                        <td><span>DOB: 10-10-2023</span></td>
                        <td><span>NHS: 123456789</span></td>
                        <td><span>Provider: C12345</span></td>
                        <td><span>Breach Date: 12/08/2020</span></td>
                        <td><span class="circle bg-warning">12</span></td>
                    </tr>
                </table>
            </section>

            <section class="form-group">
                <table class="table custom-table">
                    <tr>
                        <td><span>Tumour Group: Skin</span></td>
                        <td><span>Diagnosis: Malignant Melanoma</span></td>
                        <td><span>Stage pT3b NX MX</span></td>
                        <td><span>NEXT APPT: 19/09/2020</span></td>
                    </tr>
                </table>
            </section>
        
            <div class="tab-pane show active" id="patient_info">

                <section class="provider_information form-group text-uppercase">
                    <div class="section_title">patient and provider information</div>
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title"><a href="javascript:;" class="edit-icon pull-right" data-toggle="modal" data-target="#edit_patient_service"><i class="fa fa-pencil"></i></a></h3>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label>Surename</label>
                                    <input type="text" name="" class="form-control" disabled>
                                    <label>CR0050</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label>First Name</label>
                                    <input type="text" name="" class="form-control" disabled>
                                    <label>CR0060</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label>DOB</label>
                                    <input type="text" name="" class="form-control" disabled>
                                    <label>CR0100</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label>COSD unique identifier</label>
                                    <input type="text" name="" class="form-control" disabled>
                                    <label>C000070</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label>nhs no.</label>
                                    <input type="text" name="" class="form-control" disabled>
                                    <label>CR0010</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label>local patient identifier</label>
                                    <input type="text" name="" class="form-control" disabled>
                                    <label>CR0020</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label>NHS no. status</label>
                                    <input type="text" name="" class="form-control" disabled>
                                    <label>CR0150</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label>organisation identifier</label>
                                    <input type="text" name="" class="form-control" disabled>
                                    <label>CR1350</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label>patient usual address</label>
                                    <input type="text" name="" class="form-control" disabled>
                                    <label>CR0030</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label>postcode of usual</label>
                                    <input type="text" name="" class="form-control" disabled>
                                    <label>CR0070</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label>person stated gender code</label>
                                    <input type="text" name="" class="form-control" disabled>
                                    <label>CR0080</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="provider_information form-group text-uppercase">
                    <div class="section_title">outpatient service</div>
                    <div class="card">

                        <div class="card-body">
                            <h3 class="card-title"><a href="javascript:;" class="edit-icon pull-right" data-toggle="modal" data-target="#edit_outpatient_service"><i class="fa fa-pencil"></i></a></h3>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">source of referral for</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">clinical symptoms</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">clinical sign</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">clinical diagnosis</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">clinician</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">priority type code</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">decision of refer date</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">cancer referral to</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">two week wait cancer for</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">consultation upgrade date</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">organisation site identifier</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">date first seen</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">organisation site identifier</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">waiting time adjustment</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">waiting time adjustment</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">cancer care spell delay</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">cancer care spell delay</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">cancer diagnostic referral</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">ki-67 indicator</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">ki-67 result</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">m1-h1 nulcear expression</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">pms2 nulcear expression</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">rapid diagnostic centre</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

             <div class="tab-pane" id="investigation">

                <section class="provider_information form-group text-uppercase">
                    <div class="section_title">Investigation</div>
                    <div class="card">

                        <div class="card-body">
                            <h3 class="card-title"><a href="javascript:;" class="edit-icon pull-right" data-toggle="modal" data-target="#edit_investigation"><i class="fa fa-pencil"></i></a></h3>

                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Investigation Result Date</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">Pcr0780</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Service Report Identifier</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">Pcr0950</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Pathology observation report identifier</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">Pcr6220</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">service report status</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">Pcr0960</label>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">professional registrant issuer code - consultant</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">Pcr7100</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">professional registration entry identifier - consultant</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">Pcr7120</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">organisation site identifier</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">Pcr0980</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">sample collection date</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">Pcr1010</label>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">sample reciept date</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">Pcr0770</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">organisation identifier</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">Pcr0800</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">professional registration issuer code</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">Pcr7130</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">professional registration entry identifier - consultant (pathologist)</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">Pcr7140</label>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">specimen nature</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">Pcr0970</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">snoomed version (pathology)</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">Pcr6990</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="tab-pane" id="diagnosis_info">

                <section class="provider_information form-group text-uppercase">
                    <div class="section_title">DIAGNOSIS / STAGING</div>
                    <div class="card">

                        <div class="card-body">
                            <h3 class="card-title"><a href="javascript:;" class="edit-icon pull-right" data-toggle="modal" data-target="#edit_diagnosis_info"><i class="fa fa-pencil"></i></a></h3>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Diagnosis (ICD Pathological)</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR0810</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">TUMOUR LATERALITY</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR0820</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Pathology Investigation</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR0760</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">pathology report text</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR1020</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Lesion size</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR0830</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Grade of differentiation</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR0860</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Cancer vascular</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR0870</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Excision Margin</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR0880</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Synchronous tumour</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR0840</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">No. Nodes exammined</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR0890</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">no. nodes positive</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR0900</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">TNM Coding Edition</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR6980</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">TNM version number</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR6820</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">T Category</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR0910</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">N Category</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR0920</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">M Category</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR0930</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">TNM Stage grouping</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR0940</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Neoadjuvant THERAPY</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR1000</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Ki-67 Indicator</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR7000</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">ki-67 Result</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR7010/label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">M1.H1 Nuclear Expression...</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR7020</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">PMS2 Nuclear Expression...</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR7030</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">MSH2 Nuclear Expression...</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR7040</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">MSH6 Nuclear Expression...</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR7050</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Microsatellite Instability... </label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">pCR7060</label>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="tab-pane" id="md_dataset">

                <section class="provider_information form-group text-uppercase">
                    <div class="section_title">MD outcomes Dataset</div>
                    <div class="card">

                        <div class="card-body">
                            <h3 class="card-title"><a href="javascript:;" class="edit-icon pull-right" data-toggle="modal" data-target="#edit_mdt_outcomes-dataset"><i class="fa fa-pencil"></i></a></h3>

                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <lable>Diagnosis Date</lable>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <lable>mode of diagnosis</lable>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <lable>Stage TNM</lable>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <lable>Performance Status</lable>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <lable>Histopathological diagnosis</lable>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <lable>cytological diagnosis</lable>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <lable>Co-morbidities</lable>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <lable>clinical trial(s)</lable>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <lable>genomic/genetic testing</lable>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <lable>Patient preference</lable>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <lable>special circumstances </lable>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <lable>MDT recommendation</lable>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <lable>treatment pathway</lable>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <lable>additional tumour-specific tests</lable>
                                    <input type="text" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="tab-pane" id="treatement_breach">
                
                <section class="provider_information form-group text-uppercase">
                    <div class="section_title">Treatment</div>
                    <div class="card">

                        <div class="card-body">
                            <h3 class="card-title"><a href="javascript:;" class="edit-icon pull-right" data-toggle="modal" data-target="#edit_treatment"><i class="fa fa-pencil"></i></a></h3>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Cancer Treatment modality</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">cwt029</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Cancer Care setting</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">CWT031 Treatment</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Clinical trial indicator</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">cwt030</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Radiotherapy priority</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">cwt032</label>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Source of refferal for Out-patients</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">cwt005</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">PRIORITY TYPE CODE </label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">cwt005</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Cancer or symptomatic Breast referrral patient status</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">cwt020</label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Cancer treatment event type</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">cwt028</label>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Decision to refer date</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">CWT007 Cancer or breast symptoms</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="provider_information form-group text-uppercase">
                    <div class="section_title">breach information</div>
                    <div class="card">

                        <div class="card-body">
                            <h3 class="card-title"><a href="javascript:;" class="edit-icon pull-right" data-toggle="modal" data-target="#edit_breach_info"><i class="fa fa-pencil"></i></a></h3>
                            <div class="row">
                                <div class="col-md-3 col-sm6 col-xs-12 form-group">
                                    <label for="">Cancer Care spell delay reason</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">CWT016 first seen</label>
                                </div>
                                <div class="col-md-3 col-sm6 col-xs-12 form-group">
                                    <label for="">cancer care spell delay reason comment</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">CWT017 first seen</label>
                                </div>
                                <div class="col-md-3 col-sm6 col-xs-12 form-group">
                                    <label for="">Clinical care spell delay reason</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">CWT033 decision to treatment</label>
                                </div>
                                <div class="col-md-3 col-sm6 col-xs-12 form-group">
                                    <label for="">cancer care spell delay reason comment</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">CWT034 decision to treatment</label>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-3 col-sm6 col-xs-12 form-group">
                                    <label for="">Cancer Care spell delay reason</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">CWT037 refferal to treatment</label>
                                </div>
                                <div class="col-md-3 col-sm6 col-xs-12 form-group">
                                    <label for="">cancer care spell delay reason comment</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">CWT038 refferal to treatment</label>
                                </div>
                                <div class="col-md-3 col-sm6 col-xs-12 form-group">
                                    <label for="">Clinical care spell delay reason</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">CWT039 consultant upgrade</label>
                                </div>
                                <div class="col-md-3 col-sm6 col-xs-12 form-group">
                                    <label for="">cancer care spell delay reason comment</label>
                                    <input type="text" class="form-control" disabled>
                                    <label for="">CWT040 consultant upgrade</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="tab-pane" id="mdt">

                <section class="provider_information form-group text-uppercase">
                    <div class="section_title">MDT</div>
                    <div class="card">

                        <div class="card-body">
                            <h3 class="card-title"><a href="javascript:;" class="edit-icon pull-right" data-toggle="modal" data-target="#edit_mdt"><i class="fa fa-pencil"></i></a></h3>

                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Consultant</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Cancer Site</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Sub-Type</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Pathway</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Notes Radiology, histology and general</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Next OPA</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">To be seen by</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Hospital</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Recurrence Indication</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Key Worker</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Surgon</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">First Treatment Data</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Clinic</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Oncologist</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Next Appointment</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Last Appointment</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Co. Morbidity Evaluation</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Last Captured PS</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">MDT Date</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">Next MDT</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="">MDT Comment</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>



        </div>
    </div>

    <!-- Popups  -->

    <div id="edit_patient_service" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PATIENT AND PROVIDER INFORMATION</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="form-group text-uppercase">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label>Surename</label>
                                <input type="text" name="" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label>First Name</label>
                                <input type="text" name="" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label>DOB</label>
                                <input type="text" name="" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label>COSD unique identifier</label>
                                <input type="text" name="" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label>nhs no.</label>
                                <input type="text" name="" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label>local patient identifier</label>
                                <input type="text" name="" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label>NHS no. status</label>
                                <input type="text" name="" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label>organisation identifier</label>
                                <input type="text" name="" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label>patient usual address</label>
                                <input type="text" name="" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label>postcode of usual</label>
                                <input type="text" name="" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label>person stated gender code</label>
                                <input type="text" name="" class="form-control">
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

    <div id="edit_investigation" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Investigation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="form-group text-uppercase">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">Investigation Result Date</label>
                                <input type="text" class="form-control datetimepicker">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">Service Report Identifier</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">Pathology observation report identifier</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">service report status</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">professional registrant issuer code - consultant</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">professional registration entry identifier - consultant</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="clearfix"></div>

                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">organisation site identifier</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">sample collection date</label>
                                <input type="text" class="form-control datetimepicker">
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">sample reciept date</label>
                                <input type="text" class="form-control datetimepicker">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">organisation identifier</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="clearfix"></div>

                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">professional registration issuer code</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">professional registration entry identifier - consultant (pathologist)</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">specimen nature</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">snoomed version (pathology)</label>
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

    <div id="edit_outpatient_service" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PATIENT AND PROVIDER INFORMATION</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="form-group text-uppercase">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">source of referral for</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">clinical symptoms</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">clinical sign</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">clinical diagnosis</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">clinician</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">priority type code</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">decision of refer date</label>
                                <input type="text" class="form-control datetimepicker">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">cancer referral to</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">two week wait cancer for</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">consultation upgrade date</label>
                                <input type="text" class="form-control datetimepicker">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">organisation site identifier</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">date first seen</label>
                                <input type="text" class="form-control datetimepicker">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">organisation site identifier</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">waiting time adjustment</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">waiting time adjustment</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">cancer care spell delay</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">cancer care spell delay</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">cancer diagnostic referral</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">ki-67 indicator</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">ki-67 result</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">m1-h1 nulcear expression</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">pms2 nulcear expression</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">rapid diagnostic centre</label>
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

    <div id="edit_diagnosis_info" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">DIAGNOSIS / STAGING</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="form-group text-uppercase">
                        <div class="row">
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">Diagnosis (ICD Pathological)</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">TUMOUR LATERALITY</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">Pathology Investigation</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">pathology report text</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">Lesion size</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">Grade of differentiation</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">Cancer vascular</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">Excision Margin</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">Synchronous tumour</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">No. Nodes exammined</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">no. nodes positive</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">TNM Coding Edition</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">TNM version number</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">T Category</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">N Category</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">M Category</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">TNM Stage grouping</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">Neoadjuvant THERAPY</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">Ki-67 Indicator</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">ki-67 Result</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">M1.H1 Nuclear Expression...</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">PMS2 Nuclear Expression...</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">MSH2 Nuclear Expression...</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">MSH6 Nuclear Expression...</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="">Microsatellite Instability... </label>
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

    <div id="edit_mdt_outcomes-dataset" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">MDT Outcomes dataset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="form-group text-uppercase">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <lable>Diagnosis Date</lable>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <lable>mode of diagnosis</lable>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <lable>Stage TNM</lable>
                                <input type="text" class="form-control">
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <lable>Performance Status</lable>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <lable>Histopathological diagnosis</lable>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <lable>cytological diagnosis</lable>
                                <input type="text" class="form-control">
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <lable>Co-morbidities</lable>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <lable>clinical trial(s)</lable>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <lable>genomic/genetic testing</lable>
                                <input type="text" class="form-control">
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <lable>Patient preference</lable>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <lable>special circumstances </lable>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <lable>MDT recommendation</lable>
                                <input type="text" class="form-control">
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <lable>treatment pathway</lable>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <lable>additional tumour-specific tests</lable>
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

    <div id="edit_treatment" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">treatement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="form-group text-uppercase">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">Cancer Treatment modality</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">Cancer Care setting</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">Clinical trial indicator</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">Radiotherapy priority</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">Source of refferal for Out-patients</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">PRIORITY TYPE CODE </label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">Cancer or symptomatic Breast referrral patient status</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">Cancer treatment event type</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label for="">Decision to refer date</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </section>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info btn-lg btn-rounded">Update Information</button>
                </div>
            </div>
        </div>
    </div>

    <div id="edit_breach_info" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">breach information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="form-group text-uppercase">
                        <div class="row">
                            <div class="col-md-4 col-sm6 col-xs-12 form-group">
                                <label for="">Cancer Care spell delay reason</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm6 col-xs-12 form-group">
                                <label for="">cancer care spell delay reason comment</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm6 col-xs-12 form-group">
                                <label for="">Clinical care spell delay reason</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-4 col-sm6 col-xs-12 form-group">
                                <label for="">cancer care spell delay reason comment</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm6 col-xs-12 form-group">
                                <label for="">Cancer Care spell delay reason</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm6 col-xs-12 form-group">
                                <label for="">cancer care spell delay reason comment</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-4 col-sm6 col-xs-12 form-group">
                                <label for="">Clinical care spell delay reason</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm6 col-xs-12 form-group">
                                <label for="">cancer care spell delay reason comment</label>
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

    <div id="edit_mdt" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">MDT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="form-group text-uppercase">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">Consultant</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">Cancer Site</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">Sub-Type</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">Pathway</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">Notes Radiology, histology and general</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">Next OPA</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">To be seen by</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">Hospital</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">Recurrence Indication</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">Key Worker</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">Surgon</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">First Treatment Data</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">Clinic</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">Oncologist</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">Next Appointment</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">Last Appointment</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">Co. Morbidity Evaluation</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">Last Captured PS</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">MDT Date</label>
                                <input type="text" class="form-control datetimepicker">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">Next MDT</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label for="">MDT Comment</label>
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