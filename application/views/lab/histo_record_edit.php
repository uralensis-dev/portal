<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
        <link rel="stylesheet" href="<?php echo base_url('/assets/subassets/css/bootstrap.min.css')?>">
        <link href="<?php echo base_url('/assets/css/style.css'); ?>" rel="stylesheet" />

<style>
    .tg-nextecord a i, .tg-previousrecord a i {
        width: 46px;
        height: 46px;
        font-size: 36px;
        line-height: 41px;
    }
    .tg-searchrecord fieldset .form-group .form-control{height: 46px; width: 260px; font-size: 16px;}
    .tg-searchrecord fieldset .form-group i{top: 6px; font-size: 26px;}
    .page-title{
        width: 100%;
        display: block;
        margin-bottom: 10px;
    }
    .cims_area span.circle {
        display: inline-block;
        background: #f5f5f5;
        height: 50px;
        width: 50px;
        border: 1px solid #ddd;
        line-height: 3.5;
        text-align: center;
    }
    .page-header .breadcrumb {
        color: #6c757d;
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 0;
        display: block;
        padding-left: 0 !important;
        overflow:unset !important; 
    }
    .cims_area .wrap_con{
    position: relative;
    }
    .cims_area .tabs_area{
        width: 80px;
        position: fixed;
        right: 0;
        top: 180px;
    }
    .cims_area .nav-tabs.nav-tabs-solid > li {
        display: block;
        width: 100%;
        text-align: center;
    }
    .cims_area .nav-tabs.nav-tabs-solid > li a {
        display: block;
        background: #fff;
        height: 80px;
        border-bottom: 1px solid #ddd;
        line-height: 3.5;
    }
    .cims_area .nav-tabs.nav-tabs-solid > li a.active{
        background: #00c5fb;
        line-height: 3.5;
    }
    .cims_area .tab-content{
        width: 92%;
        float: left;
    }
    .cims_area .nav-link .simple{width: 50px;}
    .cims_area .nav-link.active .simple{display:none;}
    .cims_area .on_active{display: none;}
    .cims_area .nav-link.active .on_active{display:block; margin: 0 auto; width: 50px;}

    .cims_area span.circle {
        display: inline-block;
        background: #f5f5f5;
        height: 50px;
        width: 50px;
        border: 1px solid #ddd;
        line-height: 3;
        text-align: center;
    }
    .cims_area span.circle.bg-warning{
        color: #fff;
        border-color: #ffbc34;
        box-shadow: 0 0 2px #ffbc34;
    }

    .thumbnail p{
        color: #555;
        text-align: center;
        padding: 0 6px;
    }
    .page-buttons .btn{font-size: 14px;}

    .doctorCard .tg-themeinputbtn {
        padding-left: 22px;
        background: transparent !important;
    }
    .page-header .breadcrumb li:first-child:before{
        display: none;
    }

    .flags-select{
        width: 265px;
    }
    .second-sidebar{
        top: 185px !important;
    }
    .badge-lg, .tg-namelogo{
        margin: 0 5px;
        width:46px;
        height: 46px;
        font-size: 18px;
        line-height: 2.1;
    }
    .tg-namelogo{line-height: 2.4}

    .nav-tabs{border-bottom: 0px;}
    .nav-tabs a.tg-detailsicon{
        background: #6c757b !important;
        color: #fff !important;
        margin-right: 10px;
    }
    a#show_hidden:hover, a#show_hidden:focus{
        background: #555 !important;
    }
    .nav-tabs a.tg-detailsicon .tg-notificationtag{
        background: #6c757b;
        border-color:#6c757b;
        line-height: 26px;
        font-size: 14px;
        width: 30px; 
        height: 30px;
        top: -20px;
        right: -10px; 
    }
    .sec_title, .sec_title a{
        font-size: 18px;
        font-weight: 500;
        color: #000;
    }
    .checv_up_down{
        margin-left: 20px;
    }
    .delete_add_specimen a.tg-detailsicon{
        float: right;
        margin: 0 3px;
    }
    .show{display: block !important;}
    .tg-nameandtrackimg{
        position: absolute;
        top: 0;
        right: 15px;
    }
    .carousel-inner {
        width: 100%;
        max-width: 90%;
        margin: 30px auto;
        padding: 30px 35px 10px;
    }
    .carousel-control-prev, .carousel-control-next{
        width: 50px;
        opacity: 1;
    }
    .carousel-control-prev .fa, .carousel-control-next .fa{
        border: 1px solid #fff;
        font-size: 18px;
        border-radius: 20px;
        padding: 10px 12px;
        color: #222;

    }
    .nothing{
        background: none;
        box-shadow: none;
        padding: 0px;
        border-radius: 0px;
        border:0px;
    }
</style> 

<div class="container-fluid">
    
    <div class="page-header">
        <div class="row">
            <div class="col-sm-5">
                <h3 class="page-title">Record Detail</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item">Record Listing</li>
                    <li class="breadcrumb-item active">Record Detail</li>
                </ul>
            </div>
            <div class="col-sm-7">
                <div class="pull-right" style="padding-left: 30px">
                    <figure class="tg-logobar pull-right" style="margin-left: 0;">
                        <span class="tg-namelogo" data-toggle="tooltip" data-placement="top" title="" data-original-title="">BH</span>
                    </figure>
                  <a class="badge badge-lg badge-pill badge-danger" href="#">60</a>
                  <a class="badge badge-lg badge-pill badge-success select-flag collapsed" data-toggle="collapse" data-target="#flags-select" aria-expanded="false">
                    <i class="fa fa-flag" style="color:#fff"></i>
                  </a>
                    <ul class="list-inline flags-select collapse" id="flags-select">
                        <li>
                            <a class="badge badge-lg badge-pill badge-success">
                            <i class="fa fa-flag"></i>
                            </a>
                            <a class="badge badge-lg badge-pill badge-info">
                            <i class="fa fa-flag"></i>
                            </a>
                            <a class="badge badge-lg badge-pill badge-danger">
                            <i class="fa fa-flag"></i>
                            </a>
                            <a class="badge badge-lg badge-pill badge-warning">
                            <i class="fa fa-flag"></i>
                            </a>
                            <a class="badge badge-lg badge-pill badge-dark">
                            <i class="fa fa-flag"></i>
                            </a>
                        </li>
                    </ul>
                    
                </div>
                <div class="pull-right">
                  <div class="tg-searchrecordslide">
                     <div class="tg-previousrecord">
                        <a href="javascript:;">
                        <i class="fa fa-angle-left"></i>
                        </a>
                     </div>
                     <form class="tg-formtheme tg-searchrecord">
                        <fieldset>
                           <div class="form-group tg-inputicon">
                              <span class="twitter-typeahead" style="position: relative; display: inline-block;">
                                 <input type="text" class="form-control" name="">
                              </span>
                              <i class="lnr lnr-magnifier"></i>
                           </div>
                        </fieldset>
                     </form>
                     <div class="tg-nextecord">
                        <a href="#">
                        <i class="fa fa-angle-right"></i>
                        </a>
                     </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="sidebar second-sidebar ">
            <ul>
                <li>
                    <a class="btn btn-light btn-round" href="#">DW</a>
                </li>
                <li>
                    <a class="btn btn-light btn-round" href="#">JS</a>
                </li>
                <li class="active">
                    <a class="btn btn-light btn-round" href="#">JS</a>
                </li>
                <li>
                    <a class="btn btn-light btn-round" href="#">JS</a>
                </li>
                <li>
                    <a class="btn btn-light btn-round" href="#">JS</a>
                </li>
            </ul>
        </div>
    </div>
    <section style="padding-left: 55px; padding-top: 15px; padding-right: 90px;">
        <div class="cims_area">
            <div class="tabs_area">
                <ul class="nav nav-tabs nav-tabs-solid">
                    <li class="nav-item">
                        <a class="nav-link active" href="#patient_info" data-toggle="tab">
                            <img src="<?php echo base_url();?>assets/icons/cims_tab1_w.png" class="img-fluid on_active">
                            <img src="<?php echo base_url();?>assets/icons/cims_tab1.png" class="img-fluid simple">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#investigation" data-toggle="tab">
                            <img src="<?php echo base_url();?>assets/icons/cims_tab2_w.png" class="img-fluid on_active">
                            <img src="<?php echo base_url();?>assets/icons/cims_tab2.png" class="img-fluid simple">
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url();?>index.php/dataset/dashboard">
                            <img src="<?php echo base_url();?>assets/icons/cims_tab7_w.png" class="img-fluid on_active">
                            <img src="<?php echo base_url();?>assets/icons/cims_tab7.png" class="img-fluid simple">
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- <section class="cims_area form-group">
            <table class="table custom-table">
                <tbody> 
                	<tr>
	                    <td><span>Smith, Alan</span></td>
	                    <td><span class="circle">M26</span></td>
	                    <td><span>DOB: 10-10-2023</span></td>
	                    <td><span>NHS: 123456789</span></td>
	                    <td><span>EMIS: 123456789</span></td>
	                    <td><span>Hospital No.: C12345</span></td>
	                    <td><span>Hospital Code: C12345</span></td>
	                    <td><span class="circle bg-warning">12</span></td>
	                </tr>
	            </tbody>
	        </table>
        </section> -->
        
        <div class="row">
            <div class="col-md-12 form-group">
                <div class="sec_title form-group">
                    Patient ID <a href="javascript:;" class="checv_up_down"><i class="fa fa-chevron-up"></i></a>
                    <button class="btn btn-primary btn-round pull-right collapse_all" style="font-size: 16px;">Collapse All</button>
                </div>
                <div class="clearfix"></div>
                <div class="card hidden show">
                    <div class="card-body">
                        <h3 class="card-title"><a href="javascript:;" class="edit-icon pull-right" data-toggle="modal" data-target="#edit_patient_id"><i class="fa fa-pencil"></i></a></h3>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <span class="tg-namelogo"><?php echo uralensis_get_user_data($row->uralensis_request_id, 'initial'); ?></span>
                                <div class="tg-nameandtrack">
                                    <h3>><?php echo uralensis_get_user_data($row->uralensis_request_id, 'fullname'); ?></h3>
                                </div>
                                <figure class="tg-nameandtrackimg" style="font-size: 16px;">
                                    <i class="fa fa-venus"></i> 35
                                </figure>
                                <div class="clearfix"></div>
                                <ul class="my_list list-inline mb-0" style="margin-top: 12px;">
			                        <li class="list-inline-item"><strong><?php echo uralensis_get_record_db_detail($row->uralensis_request_id, 'serial_number'); ?></strong></li>
			                        <li class="list-inline-item"><strong><span><?php echo uralensis_get_record_db_detail($row->uralensis_request_id, 'ura_barcode_no'); ?></span></strong></li>
			                    </ul>
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="">Initial</label>
                                <input id="patient_initial" type="text" name="patient_initial" class="form-control" placeholder="Patient Initial" value="<?php echo $row->patient_initial; ?>">
                                <?php $json['patient_initial'] = $row->patient_initial; ?>
                                <label style="visibility:hidden">detials</label>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">First Name </label>
                                <input id="first_name" type="text" name="f_name" class="form-control" placeholder="First Name" value="<?php echo $row->f_name; ?>">
                                <?php $json['f_name'] = $row->f_name; ?>
                                <label>CR0060</label>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Surname</label>
                                <input id="sur_name" type="text" name="sur_name" class="form-control" placeholder="Surname" value="<?php echo $row->sur_name; ?>">
                                <?php $json['f_name'] = $row->f_name; ?>
                                <label>CR0050</label>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Gender</label>
                                <select class="form-control" name="gender" id="gender" disabled>
                                            <?php
                                            $gender_array = array(
                                                'Male' => 'Male',
                                                'Female' => 'Female'
                                            );

                                            foreach ($gender_array as $key => $gender) {
                                                $selected = '';
                                                if ($key == $row->gender) {

                                                    $selected = 'selected';
                                                }
                                                ?>
                                                <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $gender; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php $json['gender'] = $row->gender; ?>
                                <label>CR0080</label>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">DOB</label>
                                <input type="text" name="dob" id="dob" class="form-control" placeholder="Date of Birth" value="<?php echo!empty($row->dob) ? date('d-m-Y', strtotime($row->dob)) : ''; ?>" />
                                <?php $json['dob'] = date('d-m-Y', strtotime($row->dob)); ?>
                                <label>CR0100</label>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">NHS No.</label>
                                <input type="text" class="form-control" id="nhs_number" name="nhs_number" placeholder="Nhs Number" value="<?php echo $row->nhs_number; ?>">
                                <?php $json['nhs_number'] = $row->nhs_number; ?>
                                <label>CR0010</label>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">EMIS No.</label>
                                <input id="emis_number" type="text" name="emis_number" class="form-control" placeholder="Emis Number" value="<?php echo $row->emis_number; ?>">
                                <?php $json['emis_number'] = $row->emis_number; ?>
                                <label style="visibility:hidden">detials</label>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Patient Usual Address </label>
                                <input type="text" class="form-control" disabled>
                                <label>CR0030</label>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Postcode</label>
                                <input type="text" class="form-control" disabled>
                                <label>CR0070</label>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Hospital No.</label>
                                <input type="text" class="form-control" disabled>
                                <label style="visibility:hidden">detials</label>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Hospital Code</label>
                                <input type="text" class="form-control" disabled>
                                <label style="visibility:hidden">detials</label>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Track No.</label>
                                <input type="text" class="form-control" disabled>
                                <label style="visibility:hidden">detials</label>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">UL No.</label>
                                <input type="text" class="form-control" disabled>
                                <label style="visibility:hidden">detials</label>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Lab No.</label>
                                <input type="text" class="form-control" disabled>
                                <label style="visibility:hidden">detials</label>
                            </div>
                            <div class="clearfix"></div>

                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <div class="sec_title form-group">
                Request ID <a href="javascript:;" class="checv_up_down"><i class="fa fa-chevron-up"></i></a>
                </div>
                <div class="card hidden show">
                    <div class="card-body">
                        <h3 class="card-title"><a href="javascript:;" class="edit-icon pull-right" data-toggle="modal" data-target="#edit_patient_service"><i class="fa fa-pencil"></i></a></h3>
                        <div class="row">
	                        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
	                            <label>Specimen nature</label>
	                            <input type="text" name="" class="form-control" disabled="">
	                            <label>Pcr0970 </label>
	                        </div>
	                        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
	                            <label>Clinician</label>
	                            <input type="text" name="" class="form-control" disabled="">
	                            <label>Pcr7100 </label>
	                        </div>
	                        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
	                            <label>Surgeon  </label>
	                            <input type="text" name="" class="form-control" disabled="">
	                            <label>Pcr7100 </label>
	                        </div>
	                        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
	                            <label>Organisation site identifier</label>
	                            <input type="text" name="" class="form-control" disabled="">
	                            <label>Pcr0980  </label>
	                        </div>
	                        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
	                            <label>Organisation identifier</label>
	                            <input type="text" name="" class="form-control" disabled="">
	                            <label>Pcr0800  </label>
	                        </div>
	                        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
	                            <label>Date taken</label>
	                            <input type="text" name="" class="form-control" disabled="">
	                            <label>Pcr1010  </label>
	                        </div>
	                        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
	                            <label>Lab  </label>
	                            <input id="lab_number" type="text" name="lab_number" class="form-control" placeholder="Lab Number" value="<?php echo $row->lab_number; ?>">
                                <?php $json['lab_number'] = $row->lab_number; ?>
	                            <label>Pcr0980  </label>
	                        </div>
	                        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
	                            <label>Lab receipt date</label>
	                            <input type="text" name="" class="form-control" disabled="">
	                            <label>Pcr0770  </label>
	                        </div>
	                        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
	                            <label>Lab release date</label>
	                            <input type="text" name="" class="form-control" disabled="">
	                            <label style="visibility: hidden;">No PCR </label>
	                        </div>
	                        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
	                            <label>Digi Number</label>
	                            <input type="text" name="" class="form-control" disabled="">
	                            <label>Pcr0950  </label>
	                        </div>
	                        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
	                            <label>Path receipt date </label>
	                            <input type="text" name="" class="form-control" disabled="">
	                            <label style="visibility: hidden;">No PCR </label>
	                        </div>
	                        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
	                            <label>Pathologist</label>
	                            <input type="text" name="" class="form-control" disabled="">
	                            <label>Pcr7130  </label>
	                        </div>
	                        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
	                            <label>Published Date</label>
	                            <input type="text" name="" class="form-control" disabled="">
	                            <label>Pcr0780  </label>
	                        </div>
	                        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
	                            <label>Batch No.</label>
	                            <input type="text" name="" class="form-control" disabled="">
	                            <label style="visibility: hidden;">No PCR </label>
	                        </div>
	                        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
	                            <label>Courier No</label>
	                            <input type="text" name="" class="form-control" disabled="">
	                            <label style="visibility: hidden;">No PCR </label>
	                        </div><!-- 

	                        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
	                            <label>Snomed version (pathology) </label>
	                            <input type="text" name="" class="form-control" disabled="">
	                            <label>Pcr6990  </label>
	                        </div> -->
	                        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
	                            <label>Specimen No.</label>
	                            <input type="text" name="" class="form-control" disabled="">
	                            <label>Pcr6220  </label>
	                        </div>
                    	</div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <div class="row">

            <div class="col-md-12 nopadding form-group">
                <div class="col-md-7">
                    <ul class="nav nav-tabs block-tab nav-tabs-top" style="position:relative">
                    <li>
                        <a href="javascript:;" class="tg-detailsicon" data-toggle="modal" data-target="#related_document"><span class="tg-notificationtag">0</span><i data-toggle="tooltip" data-placement="top" title="" class="ti-link" data-original-title="Related Documents"></i></a>
                        <a href="javascript:;" class="tg-detailsicon" id="show_pdf_iframe"><i data-toggle="tooltip" data-placement="top" title="" class="ti-search" data-original-title="View Report"></i></a>
                        <a href="https://mskcc.uralensisdigital.co.uk/index.php/doctor/generate_report/44775" target="_blank" class="tg-detailsicon" id="show_pdf_iframe"><i data-toggle="tooltip" data-placement="top" title="" class="ti-notepad" data-original-title="View Final PDF"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-toggle="modal" data-target="#further_work" id="further_work_add"><i data-toggle="tooltip" data-placement="top" title="" class="ti-target" data-original-title="Add Further Work"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-recordid="44775" id="add_to_authorization"><i data-toggle="tooltip" data-placement="top" title="" class="ti-layers" data-original-title="Add to Queue"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-toggle="modal" data-target="#mdt_data_modal"><i data-toggle="tooltip" data-placement="top" title="" class="ti-archive" data-original-title="MDT"></i></a><a href="javascript:;" class="tg-detailsicon request_for_opinion" data-toggle="modal" data-target="#request_for_opinion"><i data-toggle="tooltip" data-placement="top" title="" class="ti-pulse" data-original-title="Request for opinion"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-toggle="modal" data-target="#assign_doctor_modal"><i data-toggle="tooltip" data-placement="top" title="" class="ti-support" data-original-title="Assign to other doctor"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-toggle="modal" data-target="#teaching_cpc_modal"><i data-toggle="tooltip" data-placement="top" title="" class="ti-bell" data-original-title="Assign as teaching and cpc"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-toggle="modal" data-target="#add_supplementary"><i data-toggle="tooltip" data-placement="top" title="" class="ti-plus" data-original-title="Add Supplementarty Report"></i></a>
                        <a href="javascript:;" id="publish_supplementary_btn" data-recordid="44775" class="tg-detailsicon hide_tag_selection"><i data-toggle="tooltip" data-placement="top" title="" class="ti-check-box" data-original-title="Publish Supplementarty Report"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-toggle="modal" data-target="#manage_supple"><i data-toggle="tooltip" data-placement="top" title="" class="ti-wallet" data-original-title="Manage Supplementary"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-toggle="modal" data-target="#related_document"><i class="ti-upload" data-toggle="tooltip" data-placement="top" title="" data-original-title="Uploaded Documents"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-toggle="modal" data-target="#record_download_history"><i data-toggle="tooltip" data-placement="top" title="" class="ti-clipboard" data-original-title="Report Download History"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-toggle="modal" data-target="#rec_history_modal"><i class="ti-folder" data-toggle="tooltip" data-placement="top" title="" data-original-title="Record History"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-toggle="modal" data-target="#relatedrecordscollapse"><i class="ti-harddrives" data-toggle="tooltip" data-placement="top" title="" data-original-title="Related Records"></i></a>
                        <a href="<?php echo site_url('_dataset/breast_cancer_dataset/dashboard/'.$this->uri->segment(3))?>" class="tg-detailsicon hide_tag_selection" ><i class="ti-harddrive" data-toggle="tooltip" data-placement="top" title="" data-original-title="Datasets"></i></a>
                        <a href="javascript:;" class="tg-detailsicon" id="show_hidden">...</a>
                    </li>
                </ul>
                </div>
                <div class="col-md-5 text-right form-group">
                    <div class="delete_add_specimen">
                        <a href="javascript:;" class="tg-detailsicon add_specimen tg-themeiconcolorone" data-toggle="modal" data-target="#add_specimen_modal">
                            <i class="ti-plus"></i>
                        </a>
                        <a href="javascript:;" class="tg-detailsicon delete_specimen tg-themeiconcolortwo">
                            <i class="ti-trash"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-primary btn-lg btn-rounded">Specimen 1</a>
                        <a href="javascript:;" class="btn btn-primary btn-lg btn-rounded">Specimen 2</a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group">
                <div class="sec_title form-group">
                    Clinical & Macro <a href="javascript:;" class="checv_up_down"><i class="fa fa-chevron-up"></i></a>
                </div>
                <div class="card hidden show">
                    <div class="card-body">
                        
                        <div class="col-md-6 doctorCard form-group">
                            <label>Clinical Discription</label>
                            
                            <textarea id="tg-tinymceeditor" name="specimen_clinical_history" class="tg-tinymceeditor editor_clinical_history_<?php echo intval($i); ?>"><?php echo $row->specimen_clinical_history; ?></textarea>
                            <ul class="tg-themeinputbtn">
                                <li>
                                    <?php
                                        $checked = '';
                                        if ($row->specimen_benign == 'benign') {
                                            $checked = 'checked';
                                        }
                                    ?>
                                    <span class="tg-radio">
                                        <input <?php echo $checked; ?> class="specimen_classification_<?php echo $inner_tab_count; ?>" name="specimen_benign" value="benign" type="checkbox" id="specimen_benign_<?php echo $inner_tab_count; ?>">
                                        <label for="specimen_benign_<?php echo $inner_tab_count; ?>">BT</label>
                                    </span>
                                </li>
                                <li>
                                    <?php
                                        $checked = '';
                                        if ($row->specimen_inflammation == 'inflammation') {
                                            $checked = 'checked';
                                        }
                                    ?>
                                    <span class="tg-radio">
                                        <input <?php echo $checked; ?> type="checkbox" class="specimen_classification_<?php echo $inner_tab_count; ?>" name="specimen_inflammation" value="inflammation" id="specimen_inflammation_<?php echo $inner_tab_count; ?>">
                                        <label for="specimen_inflammation_<?php echo $inner_tab_count; ?>">IN</label>
                                    </span>
                                </li>
                                <li>
                                    <?php
                                        $checked = '';
                                        if ($row->specimen_atypical == 'atypical') {
                                            $checked = 'checked';
                                        }
                                    ?>
                                    <span class="tg-radio">
                                        <input <?php echo $checked; ?> type="checkbox" class="specimen_classification_<?php echo $inner_tab_count; ?>" name="specimen_atypical" value="atypical" id="specimen_atypical_<?php echo $inner_tab_count; ?>">
                                        <label for="specimen_atypical_<?php echo $inner_tab_count; ?>">AT</label>
                                    </span>
                                </li>
                                <li>
                                    <?php
                                        $checked = '';
                                        if ($row->specimen_malignant == 'malignant') {
                                            $checked = 'checked';
                                        }
                                    ?>
                                    <span class="tg-radio">
                                        <input <?php echo $checked; ?> type="checkbox" class="specimen_classification_<?php echo $inner_tab_count; ?>" name="specimen_malignant" value="malignant" id="specimen_malignant_<?php echo $inner_tab_count; ?>">
                                        <label for="specimen_malignant_<?php echo $inner_tab_count; ?>">MT</label>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 doctorCard form-group">
                            <label>Macro Discription</label>
                            
                            <textarea id="tg-tinymceeditor" name="specimen_clinical_history" class="tg-tinymceeditor editor_clinical_history_<?php echo intval($i); ?>"><?php echo $row->specimen_clinical_history; ?></textarea>
                            <ul class="tg-themeinputbtn">
                                <li>
                                    <?php
                                        $checked = '';
                                        if ($row->specimen_benign == 'benign') {
                                            $checked = 'checked';
                                        }
                                    ?>
                                    <span class="tg-radio">
                                        <input <?php echo $checked; ?> class="specimen_classification_<?php echo $inner_tab_count; ?>" name="specimen_benign" value="benign" type="checkbox" id="specimen_benign_<?php echo $inner_tab_count; ?>">
                                        <label for="specimen_benign_<?php echo $inner_tab_count; ?>">BT</label>
                                    </span>
                                </li>
                                <li>
                                    <?php
                                        $checked = '';
                                        if ($row->specimen_inflammation == 'inflammation') {
                                            $checked = 'checked';
                                        }
                                    ?>
                                    <span class="tg-radio">
                                        <input <?php echo $checked; ?> type="checkbox" class="specimen_classification_<?php echo $inner_tab_count; ?>" name="specimen_inflammation" value="inflammation" id="specimen_inflammation_<?php echo $inner_tab_count; ?>">
                                        <label for="specimen_inflammation_<?php echo $inner_tab_count; ?>">IN</label>
                                    </span>
                                </li>
                                <li>
                                    <?php
                                        $checked = '';
                                        if ($row->specimen_atypical == 'atypical') {
                                            $checked = 'checked';
                                        }
                                    ?>
                                    <span class="tg-radio">
                                        <input <?php echo $checked; ?> type="checkbox" class="specimen_classification_<?php echo $inner_tab_count; ?>" name="specimen_atypical" value="atypical" id="specimen_atypical_<?php echo $inner_tab_count; ?>">
                                        <label for="specimen_atypical_<?php echo $inner_tab_count; ?>">AT</label>
                                    </span>
                                </li>
                                <li>
                                    <?php
                                        $checked = '';
                                        if ($row->specimen_malignant == 'malignant') {
                                            $checked = 'checked';
                                        }
                                    ?>
                                    <span class="tg-radio">
                                        <input <?php echo $checked; ?> type="checkbox" class="specimen_classification_<?php echo $inner_tab_count; ?>" name="specimen_malignant" value="malignant" id="specimen_malignant_<?php echo $inner_tab_count; ?>">
                                        <label for="specimen_malignant_<?php echo $inner_tab_count; ?>">MT</label>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>  
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group">
                <div class="sec_title form-group">
                    Laboratory Process Flow <a href="javascript:;" class="checv_up_down"><i class="fa fa-chevron-up"></i></a>
                </div>
                <div class="card hidden show">
                    <div class="card-body">
                        <div class="col-md-12 nopadding doctorSCard bcodes_area">
                            <div class="row">
                                <div class="col-md-3">
                                    
                                    <div class=" form-group">
                                        <label for="inputSysNo" class="focus-label">Cut Up (Primary)</label>
                                        <div class="input-group-append">        
                                            <img src="<?php echo base_url();?>assets/institute/img/qrCode.png" style="height:40px;">
                                            <input class="form-control input-lg" type="text">
                                        </div>
                                    </div>
                                    
                                    <div class=" form-group">
                                        <label for="inputSysNo" class="focus-label">Sectioned</label>
                                        <div class="input-group-append">        
                                            <img src="<?php echo base_url();?>assets/institute/img/qrCode.png" style="height:40px;">
                                            <input class="form-control input-lg" type="text">
                                        </div>
                                    </div>
                                    <div class=" form-group">
                                        <label for="inputSysNo" class="focus-label">Block Checked</label>
                                        <div class="input-group-append">        
                                            <img src="<?php echo base_url();?>assets/institute/img/qrCode.png" style="height:40px;">
                                            <input class="form-control input-lg" type="text">
                                        </div>
                                    </div>
                                
                                </div>

                                <div class="col-md-3">
                            
                                    <div class=" form-group">
                                        <label for="inputSysNo" class="focus-label">Processor</label>
                                        <div class="input-group-append">        
                                            <img src="<?php echo base_url();?>assets/institute/img/qrCode.png" style="height:40px;">
                                            <input class="form-control input-lg" type="text">
                                        </div>
                                    </div>
                                    <div class=" form-group">
                                        <label for="inputSysNo" class="focus-label">Date Rel. by Lab</label>
                                        <div class="input-group-append">        
                                            <img src="<?php echo base_url();?>assets/institute/img/qrCode.png" style="height:40px;">
                                            <input class="form-control input-lg" type="text">
                                        </div>
                                    </div>
                                    
                                    <div class=" form-group">
                                        <label for="inputSysNo" class="focus-label">Labeled</label>
                                        <div class="input-group-append">        
                                            <img src="<?php echo base_url();?>assets/institute/img/qrCode.png" style="height:40px;">
                                            <input class="form-control input-lg" type="text">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class=" form-group">
                                        <label for="inputSysNo" class="focus-label">QCd</label>
                                        <div class="input-group-append">        
                                            <img src="<?php echo base_url();?>assets/institute/img/qrCode.png" style="height:40px;">
                                            <input class="form-control input-lg" type="text">
                                        </div>
                                    </div>
                                    <div class=" form-group">
                                        <label for="inputSysNo" class="focus-label">Assisted</label>
                                        <div class="input-group-append">        
                                            <img src="<?php echo base_url();?>assets/institute/img/qrCode.png" style="height:40px;">
                                            <input class="form-control input-lg" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class=" form-group">
                                        <label for="inputSysNo" class="focus-label">Cut Up (Secondary)</label>
                                        <div class="input-group-append">        
                                            <img src="<?php echo base_url();?>assets/institute/img/qrCode.png" style="height:40px;">
                                            <input class="form-control input-lg" type="text">
                                        </div>
                                    </div>
                                    <div class=" form-group">
                                        <label for="inputSysNo" class="focus-label">Embeded</label>
                                        <div class="input-group-append">        
                                            <img src="<?php echo base_url();?>assets/institute/img/qrCode.png" style="height:40px;">
                                            <input class="form-control input-lg" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>  
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group">
                <div class="sec_title form-group">
                    Virtual Slide Panel <a href="javascript:;" class="checv_up_down"><i class="fa fa-chevron-up"></i></a>
                </div>
                <div class="card hidden show">
                    <div class="card-body">

                        <div id="media" class="carousel slide" data-ride="carousel">

                          <div class="carousel-inner bg-brown">
                            <div class="carousel-item  active">
                                <div class="row">
                                  <div class="col">
                                    <a class="thumbnail" href="#">
                                        <p>Add case title here</p>
                                        <img alt="" src="<?php echo base_url();?>assets/subassets/img/slidePlaceholder.jpg" style="height:200px;">
                                    </a>
                                  </div>
                                  <div class="col">
                                    <a class="thumbnail" href="#">
                                        <p>Add case title here</p>
                                        <img alt="" src="<?php echo base_url();?>assets/subassets/img/slidePlaceholder.jpg" style="height:200px;">
                                    </a>
                                  </div>
                                  <div class="col">
                                    <a class="thumbnail" href="#">
                                        <p>Add case title here</p>
                                        <img alt="" src="<?php echo base_url();?>assets/subassets/img/slidePlaceholder.jpg" style="height:200px;">
                                    </a>
                                  </div>
                                  <div class="col">
                                    <a class="thumbnail" href="#">
                                        <p>Add case title here</p>
                                        <img alt="" src="<?php echo base_url();?>assets/subassets/img/slidePlaceholder.jpg" style="height:200px;">
                                    </a>
                                  </div>
                                  <div class="col">
                                    <a class="thumbnail" href="#">
                                        <p>Add case title here</p>
                                        <img alt="" src="<?php echo base_url();?>assets/subassets/img/slidePlaceholder.jpg" style="height:200px;">
                                    </a>
                                  </div>
                                  <div class="col">
                                    <a class="thumbnail" href="#">
                                        <p>Add case title here</p>
                                        <img alt="" src="<?php echo base_url();?>assets/subassets/img/slidePlaceholder.jpg" style="height:200px;">
                                    </a>
                                  </div>
                                  <div class="col">
                                    <a class="thumbnail" href="#">
                                        <p>Add case title here</p>
                                        <img alt="" src="<?php echo base_url();?>assets/subassets/img/slidePlaceholder.jpg" style="height:200px;">
                                    </a>
                                  </div>
                                  <div class="col">
                                    <a class="thumbnail" href="#">
                                        <p>Add case title here</p>
                                        <img alt="" src="<?php echo base_url();?>assets/subassets/img/slidePlaceholder.jpg" style="height:200px;">
                                    </a>
                                  </div>
                                  <div class="col">
                                    <a class="thumbnail" href="#">
                                        <p>Add case title here</p>
                                        <img alt="" src="<?php echo base_url();?>assets/subassets/img/slidePlaceholder.jpg" style="height:200px;">
                                    </a>
                                  </div>          
                                  
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="row">
                                  
                                  <div class="col">
                                    <a class="thumbnail" href="#">
                                        <p>Add case title here</p>
                                        <img alt="" src="<?php echo base_url();?>assets/subassets/img/slidePlaceholder.jpg" style="height:200px;">
                                    </a>
                                  </div>
                                  <div class="col">
                                    <a class="thumbnail" href="#">
                                        <p>Add case title here</p>
                                        <img alt="" src="<?php echo base_url();?>assets/subassets/img/slidePlaceholder.jpg" style="height:200px;">
                                    </a>
                                  </div>
                                  <div class="col">
                                    <a class="thumbnail" href="#">
                                        <p>Add case title here</p>
                                        <img alt="" src="<?php echo base_url();?>assets/subassets/img/slidePlaceholder.jpg" style="height:200px;">
                                    </a>
                                  </div>
                                  <div class="col">
                                    <a class="thumbnail" href="#">
                                        <p>Add case title here</p>
                                        <img alt="" src="<?php echo base_url();?>assets/subassets/img/slidePlaceholder.jpg" style="height:200px;">
                                    </a>
                                  </div>
                                  <div class="col">
                                    <a class="thumbnail" href="#">
                                        <p>Add case title here</p>
                                        <img alt="" src="<?php echo base_url();?>assets/subassets/img/slidePlaceholder.jpg" style="height:200px;">
                                    </a>
                                  </div>
                                  <div class="col">
                                    <a class="thumbnail" href="#">
                                        <p>Add case title here</p>
                                        <img alt="" src="<?php echo base_url();?>assets/subassets/img/slidePlaceholder.jpg" style="height:200px;">
                                    </a>
                                  </div>
                                  <div class="col">
                                    <a class="thumbnail" href="#">
                                        <p>Add case title here</p>
                                        <img alt="" src="<?php echo base_url();?>assets/subassets/img/slidePlaceholder.jpg" style="height:200px;">
                                    </a>
                                  </div>
                                  <div class="col">
                                    <a class="thumbnail" href="#">
                                        <p>Add case title here</p>
                                        <img alt="" src="<?php echo base_url();?>assets/subassets/img/slidePlaceholder.jpg" style="height:200px;">
                                    </a>
                                  </div>
                                  <div class="col">
                                    <a class="thumbnail" href="#">
                                        <p>Add case title here</p>
                                        <img alt="" src="<?php echo base_url();?>assets/subassets/img/slidePlaceholder.jpg" style="height:200px;">
                                    </a>
                                  </div>
                                </div>
                            </div>
                          </div>

                          <!-- Left and right controls -->
                          <a class="carousel-control-prev" href="#media" data-slide="prev">
                            <i class="fa fa-chevron-left"></i>
                          </a>
                          <a class="carousel-control-next" href="#media" data-slide="next">
                            <i class="fa fa-chevron-right"></i>
                          </a>

                        </div>
                    </div>
                </div>  
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group">
                <div class="sec_title form-group">
                    Microscopy Description <a href="javascript:;" class="checv_up_down"><i class="fa fa-chevron-up"></i></a>
                </div>
                <div class="card hidden show">
                    <div class="card-body doctorCard">
                        <ul  style="border: 1px solid #ccc; margin-bottom: 15px; background: transparent;overflow:hidden;">
                            <li>
                                Patient initial: <?php echo $row->patient_initial?>
                            </li>
                            <li>
                                Surname: <?php echo $row->sur_name?>
                            </li>
                            <li>
                                First Name: <?php echo $row->f_name?>
                            </li>
                            <li>
                                Lab Number: <?php echo $row->lab_number?>
                            </li>
                        </ul>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <label class="focus-label">Microscopy</label>
                                    <img src="<?php echo base_url()?>assets/subassets/img/iconBtn.png" align="btn">
                                    
                                </span>
                            </div>
                                <input class="form-control" list="desc" style="height:44px;" />
                                <datalist id="desc">
                                  <option value="Macroscopic Description 1" />
                                  <option value="Macroscopic Description 2" />
                                  <option value="Macroscopic Description 3" />
                                  <option value="Macroscopic Description 4" />
                                  <option value="Macroscopic Description 5" />
                                </datalist>  
                           
                        </div>
                        <textarea class="form-control" name="" style="min-height:280px;"><?php echo trim($row->specimen_microscopic_description); ?></textarea>
                        <ul class="tg-themeinputbtn" style="bottom: 30px;">
                            <li>
                                <span class="tg-radio">
                                    <input checked="" class="specimen_classification_1" name="specimen_benign" value="benign" type="checkbox" id="specimen_benign_1">
                                    <label for="specimen_benign_1">BT</label>
                                </span>
                            </li>
                            <li>
                                <span class="tg-radio">
                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_inflammation" value="inflammation" id="specimen_inflammation_1">
                                    <label for="specimen_inflammation_1">IN</label>
                                </span>
                            </li>
                            <li>
                                <span class="tg-radio">
                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_atypical" value="atypical" id="specimen_atypical_1">
                                    <label for="specimen_atypical_1">AT</label>
                                </span>
                            </li>
                            <li>
                                <span class="tg-radio">
                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_malignant" value="malignant" id="specimen_malignant_1">
                                    <label for="specimen_malignant_1">MT</label>
                                </span>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>  
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group">
                <div class="sec_title form-group">
                    Diagnosis: <span class="text-danger">*</span> <a href="javascript:;" class="checv_up_down"><i class="fa fa-chevron-up"></i></a>
                </div>
                <div class="card hidden show">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <div class="tg-formhead">
                                    <ul class="tg-themeinputbtn">
                                        <li>
                                            <?php
                                                    $checked = '';
                                                    if ($row->specimen_benign == 'benign') {
                                                        $checked = 'checked';
                                                    }
                                                    ?>
                                            <span class="tg-radio">
                                                <input <?php echo $checked; ?> class="specimen_classification_<?php echo $inner_tab_count; ?>"
                                                name="specimen_benign" value="benign" type="checkbox" id="specimen_benign">
                                                <label for="specimen_benign">BT</label>
                                            </span>
                                        </li>
                                        <li>
                                            <?php
                                                $checked = '';
                                                if ($row->specimen_inflammation == 'inflammation') {
                                                    $checked = 'checked';
                                                }
                                            ?>
                                            <span class="tg-radio">
                                                <input <?php echo $checked; ?> type="checkbox"
                                                class="specimen_classification_<?php echo $inner_tab_count; ?>" name="specimen_inflammation"
                                                value="inflammation" id="specimen_inflammation">
                                                <label for="specimen_inflammation">IN</label>
                                            </span>
                                        </li>
                                        <li>
                                            <?php
                                                $checked = '';
                                                if ($row->specimen_atypical == 'atypical') {
                                                    $checked = 'checked';
                                                }
                                            ?>
                                            <span class="tg-radio">
                                                <input <?php echo $checked; ?> type="checkbox"
                                                class="specimen_classification_<?php echo $inner_tab_count; ?>" name="specimen_atypical" value="atypical"
                                                id="specimen_atypical">
                                                <label for="specimen_atypical">AT</label>
                                            </span>
                                        </li>
                                        <li>
                                            <?php
                                                $checked = '';
                                                if ($row->specimen_malignant == 'malignant') {
                                                    $checked = 'checked';
                                                }
                                            ?>
                                            <span class="tg-radio">
                                                <input <?php echo $checked; ?> type="checkbox"
                                                class="specimen_classification_<?php echo $inner_tab_count; ?>" name="specimen_malignant" value="malignant"
                                                id="specimen_malignant">
                                                <label for="specimen_malignant">MT</label>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8 form-group tg-formgroupcheck specimen-diagnose-field">
                                <input data-overwrite="false" type="text" class="form-control specimen_dignosis_<?php echo $inner_tab_count; ?>" placeholder="Specimen Diagnosis"
                                    name="specimen_diagnosis" id="specimen_dignosis" value="<?php echo $row->specimen_diagnosis_description; ?>" />
                                <div id="snomed-values-<?php echo $inner_tab_count; ?>" class="snomed-values">
                                    <span class="snomed-t1"><?php echo !empty($row->specimen_snomed_t) ? $row->specimen_snomed_t : ''; ?></span>
                                    <span class="snomed-t2"><?php echo !empty($row->specimen_snomed_t2) ? $row->specimen_snomed_t2 : ''; ?></span>
                                    <span class="snomed-p"><?php echo !empty($row->specimen_snomed_p) ? $row->specimen_snomed_p : ''; ?></span>
                                    <span class="snomed-m"><?php echo !empty($row->specimen_snomed_m) ? $row->specimen_snomed_m : ''; ?></span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-3 form-group">
                                <label for="">Snoomed T1</label>
                                <select name="" id="" class="form-control select2">
                                    <option>Snoomed</option>
                                    <option>Snoomed</option>
                                    <option>Snoomed</option>
                                    <option>Snoomed</option>
                                    <option>Snoomed</option>
                                </select>
                                <label>Pcr6990</label>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Snoomed T2</label>
                                <select name="" id="" class="form-control select2">
                                    <option>Snoomed</option>
                                    <option>Snoomed</option>
                                    <option>Snoomed</option>
                                    <option>Snoomed</option>
                                    <option>Snoomed</option>
                                </select>
                                <label style="visibility: none">Pcr6990</label>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Snoomed P</label>
                                <select name="" id="" class="form-control select2">
                                    <option>Snoomed</option>
                                    <option>Snoomed</option>
                                    <option>Snoomed</option>
                                    <option>Snoomed</option>
                                    <option>Snoomed</option>
                                </select>
                                <label style="visibility: none">Pcr6990</label>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Snoomed M</label>
                                <select name="" id="" class="form-control select2">
                                    <option>Snoomed</option>
                                    <option>Snoomed</option>
                                    <option>Snoomed</option>
                                    <option>Snoomed</option>
                                    <option>Snoomed</option>
                                </select>
                                <label style="visibility: none">Pcr6990</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <textarea name="" id="" class="form-control" rows="6" placeholder="Comments"></textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <textarea name="" id="" class="form-control" rows="6" placeholder="Internal Notes"></textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea name="" id="" class="form-control" rows="3" placeholder="MDT Outcome"></textarea>
                            </div>
                        </div>
                    
                        <div class="row">

                            <div class="col-md-12">
                                <!-- Buttons Container -->
                                <div class="page-buttons">
                                    <button class="btn btn-light" data-toggle="modal" data-target="#sendprivatemessage">
                                        <i class="fa fa-dot-circle-o mr-3"></i>
                                        Lab: 
                                        <span class="badge badge-pill bg-primary">3</span>
                                    </button>

                                    <button class="btn btn-light" data-toggle="modal" data-target="#sendprivatemessage">
                                        <i class="fa fa-dot-circle-o"></i>
                                        Secretary: 
                                        <span class="badge badge-pill bg-primary">3</span>
                                    </button>

                                    <button class="btn btn-light" data-toggle="modal" data-target="#sendprivatemessage">                            
                                        Error Log: 
                                        <span class="badge badge-pill bg-primary">3</span>
                                    </button>
                                   
                                    <button class="btn btn-light">
                                        <span class="badge badge-pill bg-primary">3</span>
                                        Primary Doctors                             
                                    </button>

                                    <button class="btn btn-light">
                                        <span class="badge badge-pill bg-primary">3</span>
                                        Others                             
                                    </button>
                                    
                                    <div class="pull-right" id="doctor_update_specimen_record_message_<?php echo $inner_tab_count; ?>"></div>
                                    <?php if (!$row->specimen_publish_status == 1) { ?>
                                    <button <?php echo $button_disable; ?> class="btn btn-primary update_specimen_record_btn pull-right"
                                        id="doctor_update_specimen_record_btn_<?php echo $inner_tab_count; ?>" name="submit">Update Diagnosis</button>
                                    <?php } ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>  
            </div>
        </div>



    </section>


</div>


