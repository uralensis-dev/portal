<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
<style type="text/css">
    label{font-weight: 600;}
    .tg-themeinputbtn li label {
        padding: 0;
        width: 28px;
        height: 28px;
        color: #263357;
        line-height: 26px;
        display: block;
        font-size: 12px;
        text-align: center;
        border-radius: 50px;
        border: 1px solid #ddd;
        text-transform: uppercase;
        font-weight: 700;
    }
    .tg-tinymceeditor{
        height: 160px !important
    }
    .btn.btn-rounded {
        border-radius: 50px;
    }
    .doctorCard .tg-themeinputbtn {
        width: 99.6%;
        position: absolute;
        bottom: 1px;
        left: 1px;
        padding-left: 22px;
        background: transparent !important;
    }
    .sec_title, .sec_title a {
        font-size: 18px;
        font-weight: 500;
        color: #000;
    }
    .delete_add_specimen {
        float: right;
        margin: 0 0 0 20px;
    }
    .delete_add_specimen a.tg-detailsicon {
        width: 32px;
        height: 32px;
        line-height: 32px;
        font-size: 17px;
        float: right;
        margin: 0 3px;
    }
    .delete_add_specimen a.tg-detailsicon + a.tg-detailsicon {
        margin-left: 8px;
    }
</style>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Dataset</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Dataset</li>
            </ul>
        </div>
    </div>
</div>
<section>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body patient_info" style="min-height: 110px; cursor: pointer;">
                    <span class="tg-namelogo">NA</span>
                    <div class="tg-nameandtrack">
                        <h3> H20,123000, Iskandar Ch.</h3>
                    </div>
                    <div class="clearfix"></div>
                    <ul class="my_list list-inline mb-0" style="margin-top: 12px;">
                        <li class="list-inline-item font-bold"><i class="fa fa-venus"></i> 35</li>
                        <li class="list-inline-item"><strong>DOB: <span>23/01/1990</span></strong></li>
                        <li class="list-inline-item"><strong>NHS No: <span>1234567</span></strong></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
                    <div class="dash-widget-info">
                        <h3>24</h3>
                        <span><a href="javascript:;"  class="clinical_info">Clinical</a></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
                    <div class="dash-widget-info">
                        <h3>24</h3>
                        <span><a href="javascript:;"  class="gross_cut_up">Gross Cut Up</a></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
                    <div class="dash-widget-info">
                        <h3>24</h3>
                        <span><a href="javascript:;" class="request_id">Request ID</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 hide_it_info patient_info_collapse hidden form-group">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <span class="tg-namelogo">NA</span>
                            <div class="tg-nameandtrack">
                                <h3>No, Name</h3>
                            </div>
                            <figure class="tg-nameandtrackimg">
                                <i class="fa fa-venus"></i> 35
                            </figure>
                            <div class="clearfix"></div>
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="">Initial</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">First Name </label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Surname</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Gender</label>
                            <select class="form-control">
                                <option value="">Male</option>
                                <option value="">Female</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">DOB</label>
                            <input type="text" class="form-control is-datepick" id="dob">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">NHS No.</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">EMIS No.</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Hospital No.</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Hospital Code</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="clearfix"></div>

                    </div>


                </div>
            </div>
        </div>
        <div class="col-md-12 hide_it_info grow_up_collapse hidden form-group">
            <div class="sec_title form-group">
                Grow Cut Up </a>
            </div>
            <div class="col-md-12 doctorCard nopadding">

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
        </div>
        <div class="col-md-12 hide_it_info request_id_collapse hidden form-group">
            <div class="sec_title form-group">
                Request ID
            </div>
            <div class="card">
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
                            <input type="text" name="" class="form-control" disabled="">
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
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                            <label>Snomed version (pathology) </label>
                            <input type="text" name="" class="form-control" disabled="">
                            <label>Pcr6990  </label>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                            <label>Specimen No.</label>
                            <input type="text" name="" class="form-control" disabled="">
                            <label>Pcr6220  </label>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 hide_it_info clinical_info_collapse hidden form-group">
            <div class="sec_title form-group">
                Clinical <a href="javascript:;" class="checv_up_down"></a>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class="pull-right">
                            <div class="delete_add_specimen">
                                <a href="javascript:;" class="btn btn-primary btn-rounded">Specimen 1</a>
                                <a href="javascript:;" class="btn btn-primary btn-rounded">Specimen 2</a>
                                <a href="javascript:;" class="tg-detailsicon delete_specimen tg-themeiconcolortwo">
                                    <i class="ti-trash"></i>
                                </a>
                                <a href="javascript:;" class="tg-detailsicon add_specimen tg-themeiconcolorone" data-toggle="modal" data-target="#add_specimen_modal">
                                    <i class="ti-plus"></i>
                                </a>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 doctorCard">

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

                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>  
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div style="">
                <div class="col-sm-12 form-group">
                    <div class="sidebar_title">Breast Cancer Dataset</div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="faq-card">
                            <div class="card mb-1">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <a class="collapsed font-16" data-toggle="collapse" href="#collapseOne" aria-expanded="false">Surgical Specimen <span class="text-danger">*</span></a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="card-collapse collapse" style="">
                                    <div class="card-body">
                                        <ul class="list-unstyled">
                                            <li> <a href="javascript:;" class="specimen_sideBtn"> Side </a> </li>
                                            <li> <a href="javascript:;" class="specimen_typeBtn">Specimen Type <span class="text-danger">*</span></a></li>
                                            <li><a href="javascript:;" class="specimen_radio_seenBtn"> Specimen Radiograph Seen <span class="text-danger">*</span></a></li>
                                            <li><a href="javascript:;" class="memo_abnorBtn"> Mammographic Abnormality</a></li>
                                            <li><a href="javascript:;" class="core_biopsyBtn"> Site of Previous Core Biopsy Seen </a></li>
                                            <li><a href="javascript:;" class="historical_clacificationBtn"> Histological Calcification <span class="text-danger">*</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-1">
                                <div class="card-header no_after">
                                    <h4 class="card-title">
                                        <a href="javascript:;" class="benign_lesionsBtn font-16">Benign lesions <span class="text-danger">*</span></a>
                                    </h4>
                                </div>
                            </div>
                            <div class="card mb-1">
                                <div class="card-header no_after">
                                    <h4 class="card-title">
                                        <a class="epithelial_proliferationBtn font-16" href="javascript:;">Epithelial proliferation <span class="text-danger">*</span></a>
                                    </h4>
                                </div>
                            </div>

                            <div class="card mb-1">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <a class="collapsed font-16" data-toggle="collapse" href="#collapse3" aria-expanded="false">Malignant Lesions </a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="card-collapse collapse" style="">
                                    <div class="card-body">
                                        <ul class="list-unstyled">
                                            <li><a href="javascript:;" class="Malignant_in_situ_lesionBtn">Malignant in situ lesion</a></li>
                                            <li><a href="javascript:;" class="Malignant_in_situ_componentsBtn">In situ components</a></li>
                                            <li><a href="javascript:;" class="DCIS_gradeBtn">DCIS grade</a></li>
                                            <li><a href="javascript:;" class="DCIS_growth_patternBtn">DCIS growth pattern</a></li>
                                            <li><a href="javascript:;" class="DCIS_necrosisBtn">DCIS necrosis</a></li>
                                            <li><a href="javascript:;" class="InflammationBtn">Inflammation</a></li>
                                            <li><a href="javascript:;" class="Pure_DCIS_size_mmBtn">Pure’ DCIS size mm</a></li>
                                            <li><a href="javascript:;" class="LCISBtn">LCIS</a></li>
                                            <li><a href="javascript:;" class="Pagets_diseaseBtn">Paget’s disease</a></li>
                                            <li><a href="javascript:;" class="MicroinvasiveBtn">Microinvasive</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-1">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <a class="collapsed font-16" data-toggle="collapse" href="#collapse4" aria-expanded="false">Size and extent <span class="text-danger">*</span></a>
                                    </h4>
                                </div>
                                <div id="collapse4" class="card-collapse collapse" style="">
                                    <div class="card-body">
                                        <ul class="list-unstyled">
                                            <li><a href="javascript:;" class="Size_and_extentBtn">Tumor Sizes (mm)</a></li>
                                            <li><a href="javascript:;" class="Disease_extentBtn">Disease extent</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-1">
                                <div class="card-header no_after">
                                    <h4 class="card-title">
                                        <a class="Invasive_carcinomaBtn font-16" href="javascript:;">Invasive carcinoma <span class="text-danger">*</span></a>
                                    </h4>
                                </div>
                            </div>


                            <div class="card mb-1">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <a class="collapsed font-16" data-toggle="collapse" href="#collapse_Histological_grade" aria-expanded="false">Histological grade </a>
                                    </h4>
                                </div>
                                <div id="collapse_Histological_grade" class="card-collapse collapse" style="">
                                    <div class="card-body">
                                        <ul class="list-unstyled">
                                            <li><a href="javascript:;" class="Histological_gradeBtn">Histological grade </a></li>
                                            <li><a href="javascript:;" class="Tubule_formationBtn">Tubule formation </a></li>
                                            <li><a href="javascript:;" class="Nuclear_pleomorphismBtn">Nuclear pleomorphism </a></li>
                                            <li><a href="javascript:;" class="MitosesBtn">Mitoses </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-1">
                                <div class="card-header no_after">
                                    <h4 class="card-title">
                                        <a class="Lymphovascular_invasionBtn font-16" href="javascript:;">Lymphovascular invasion<span class="text-danger">*</span></a>
                                    </h4>
                                </div>
                            </div>

                            <div class="card mb-1">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <a class="collapsed font-16" data-toggle="collapse" href="#collapse5" aria-expanded="false">Lymph node stage </a>
                                    </h4>
                                </div>
                                <div id="collapse5" class="card-collapse collapse" style="">
                                    <div class="card-body">
                                        <ul class="list-unstyled">
                                            <li> <a href="javascript:;" class="Intra_opetarative_assesmentBtn">Intra-operative assessment</a></li>
                                            <li> <a href="javascript:;" class="Axillary_nodes_presentBtn">Axillary nodes present</a></li>
                                            <li> <a href="javascript:;" class="Other_nodes_presentBtn">Other nodes present</a></li>
                                            <li> <a href="javascript:;" class="single_node_positiveBtn">single node positive</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-1">
                                <div class="card-header no_after">
                                    <h4 class="card-title">
                                        <a class="Invasive_tumour_typeBtn font-16" href="javascript:;">Invasive tumour type<span class="text-danger">*</span></a>
                                    </h4>
                                </div>
                            </div>

                            <button class="btn btn-info btn-block">Edit This Dataset</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">

            <div class="row surgical_specimen_selection hide_main hidden">
                <div class="col-md-12 card">
                    <div class="card-body">
                        <div class="row step1 hidden show">
                            <div class="col-md-12 form-group text-center">
                                <h3> Surgical Specimen(s)</h3>
                                <p>Is there  a history of neo-adjuvant theropy?</p>
                                <p class="text-muted">Select single option from the list below</p>
                            </div>        
                            <div class="col-md-12 form-group specimen_side hide_it">
                                <div class="row radio-toolbar">
                                    <div class="col-md-6 nextBtn2">
                                        <input type="radio" id="radioRight" name="specimen_sides" value="specimen_side_right">
                                        <label for="radioRight">Right</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="radio" id="radioLeft" name="specimen_sides" value="specimen_side_left" class="">
                                        <label for="radioLeft">Left</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group radio-toolbar specimen_type_main hide_it">
                                <div class="col-md-4">
                                    <input type="radio" id="specimen_type_yes" name="specimen_type_select" value="specimen_type_yes">
                                    <label for="specimen_type_yes">Yes</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="radio" id="specimen_type_no" name="specimen_type_select" value="specimen_type_no" class="">
                                    <label for="specimen_type_no">No</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="radio" id="specimen_type_not_know" name="specimen_type_select" value="specimen_type_not_know" class="">
                                    <label for="specimen_type_not_know">Not Know</label>
                                </div>

                            </div>

                            <div class="row form-group radio-toolbar specimen_radio_seen hide_it">
                                <div class="col-md-6">
                                    <input type="radio" id="specimen_radio_seen_yes" name="specimen_radio_seen" value="specimen_radio_seen_yes">
                                    <label for="specimen_radio_seen_yes">Yes</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" id="specimen_radio_seen_no" name="specimen_radio_seen" value="specimen_radio_seen_no" class="">
                                    <label for="specimen_radio_seen_no">No</label>
                                </div>
                            </div>

                            <div class="row form-group radio-toolbar memo_absormality hide_it">
                                <div class="col-md-4">
                                    <input type="radio" id="memo_absormality_yes" name="memo_absormality" value="memo_absormality_yes" class="">
                                    <label for="memo_absormality_yes">Yes</label>

                                </div>
                                <div class="col-md-4">
                                    <input type="radio" id="memo_absormality_no" name="memo_absormality" value="memo_absormality_no" class="">
                                    <label for="memo_absormality_no">No</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="radio" id="memo_absormality_unsure" name="memo_absormality" value="memo_absormality_unsure" class="">
                                    <label for="memo_absormality_unsure">Unsure</label>
                                </div>
                            </div>

                            <div class="row form-group radio-toolbar core_biopsy_seen hide_it">
                                <div class="col-md-6">
                                    <input type="radio" id="core_biopsy_yes" name="core_biopsy_seen" value="core_biopsy_yes" class="">
                                    <label for="core_biopsy_yes">Yes</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" id="core_biopsy_no" name="core_biopsy_seen" value="core_biopsy_no" class="">
                                    <label for="core_biopsy_no">No</label>
                                </div>
                            </div>
                            <div class="row form-group radio-toolbar histological_calcification hide_it">
                                <div class="col-md-3">
                                    <input type="radio" id="histological_calcification_absent" name="histological_calcification" value="histological_calcification_absent" class="">
                                    <label for="histological_calcification_absent">Absent</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="radio" id="histological_calcification_benign" name="histological_calcification" value="histological_calcification_benign" class="">
                                    <label for="histological_calcification_benign">Benign</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="radio" id="histological_calcification_malignant" name="histological_calcification" value="histological_calcification_malignant" class="">
                                    <label for="histological_calcification_malignant">Malignant</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="radio" id="histological_calcification_both" name="histological_calcification" value="histological_calcification_both" class="">
                                    <label for="histological_calcification_both">Both</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary pull-right nextBtn2">Next</button>
                            </div>
                        </div>
                        <div class="row step2 hide_it hidden">
                            <div class="col-md-12 form-group text-center">
                                <h3> Surgical Specimen(s)</h3>
                                <p>Is there  a history of neo-adjuvant theropy?</p>
                                <p class="text-muted">Select single option from the list below</p>
                            </div>

                            <div class="inputGroup">
                                <input id="wle" name="wle" type="checkbox"/>
                                <label for="wle">WLE</label>
                            </div>

                            <div class="inputGroup">
                                <input id="localisation_specimen" name="localisation_specimen" type="checkbox"/>
                                <label for="localisation_specimen">Localisation Specimen</label>
                            </div>
                            <div class="inputGroup">
                                <input id="exision_biopsy" name="exision_biopsy" type="checkbox"/>
                                <label for="exision_biopsy">Exision Biopsy</label>
                            </div>

                            <div class="inputGroup">
                                <input id="segmental_excision" name="segmental_excision" type="checkbox"/>
                                <label for="segmental_excision">Segmental excision</label>
                            </div>
                            <div class="inputGroup">
                                <input id="re_excision" name="re_excision" type="checkbox"/>
                                <label for="re_excision">Re-excision</label>
                            </div>
                            <div class="inputGroup">
                                <input id="further_margins" name="further_margins" type="checkbox"/>
                                <label for="further_margins">Further margins</label>
                            </div>
                            <div class="inputGroup">
                                <input id="microdochectomy_microductectomy " name="microdochectomy_microductectomy " type="checkbox"/>
                                <label for="microdochectomy_microductectomy ">Microdochectomy/microductectomy </label>
                            </div>
                            <div class="inputGroup">
                                <input id="sln" name="sln" type="checkbox"/>
                                <label for="sln">SLN</label>
                            </div>

                            <div class="inputGroup">
                                <input id="axillary_sampling" name="axillary_sampling" type="checkbox"/>
                                <label for="axillary_sampling">Axillary sampling </label>
                            </div>
                            <div class="inputGroup">
                                <input id="axillary_ln_level_1" name="axillary_ln_level_1" type="checkbox"/>
                                <label for="axillary_ln_level_1">Axillary LN level I </label>
                            </div>
                            <div class="inputGroup">
                                <input id="axillary_ln_level_2" name="axillary_ln_level_2" type="checkbox"/>
                                <label for="axillary_ln_level_2">Axillary LN level II </label>
                            </div>
                            <div class="inputGroup">
                                <input id="axillary_ln_level_3" name="axillary_ln_level_3" type="checkbox"/>
                                <label for="axillary_ln_level_3">Axillary LN level III </label>
                            </div>
                            <div class="inputGroup">
                                <input id="total_excision_procedure" name="total_excision_procedure" type="checkbox"/>
                                <label for="total_excision_procedure">Total duct excision/Hadfield’s procedure  </label>
                            </div>
                            <div class="inputGroup">
                                <input id="mastectomy" name="mastectomy" type="checkbox"/>
                                <label for="mastectomy">Mastectomy</label>
                            </div>
                            <div class="inputGroup">
                                <input id="subcutaneous_mastectomy" name="subcutaneous_mastectomy" type="checkbox"/>
                                <label for="subcutaneous_mastectomy">Subcutaneous Mastectomy</label>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-secondary pull-left backBtn1">Back</button>
                                <button class="btn btn-primary pull-right nextBtn3">Next</button>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="row step3 hide_it hidden">
                            <div class="col-md-12 form-group text-center">
                                <h3> Surgical Specimen(s)</h3>
                                <p>Is there  a history of neo-adjuvant theropy?</p>
                                <p class="text-muted">Select single option from the list below</p>
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea class="form-control" rows="6" placeholder="Add Details Here"></textarea>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-secondary backBtn2">Back</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row benign_lesions_main hide_main hidden">
                <div class="col-md-12 card">
                    <div class="card-body">
                        <div class="col-md-12 form-group text-center">
                            <h3> Benign lesions </h3>
                            <p>Is there  a history of neo-adjuvant theropy?</p>
                            <p class="text-muted">Select single option from the list below</p>
                        </div>

                        <div class="row form-group benign_lesions">
                            <div class="inputGroup">
                                <input id="columnar_cell_change" name="columnar_cell_change" type="checkbox"/>
                                <label for="columnar_cell_change">Columnar cell change</label>
                            </div>
                            <div class="inputGroup">
                                <input id="complex_sclerosing_lesion_radial_scar" name="complex_sclerosing_lesion_radial_scar" type="checkbox"/>
                                <label for="complex_sclerosing_lesion_radial_scar">Complex sclerosing lesion/radial scar</label>
                            </div>
                            <div class="inputGroup">
                                <input id="Fibroadenoma" name="Fibroadenoma" type="checkbox"/>
                                <label for="Fibroadenoma">Fibroadenoma</label>
                            </div>
                            <div class="inputGroup">
                                <input id="Fibrocystic_change" name="Fibrocystic_change" type="checkbox"/>
                                <label for="Fibrocystic_change">Fibrocystic change</label>
                            </div>
                            <div class="inputGroup">
                                <input id="Multiple_papillomas" name="Multiple_papillomas" type="checkbox"/>
                                <label for="Multiple_papillomas">Multiple papillomas</label>
                            </div>
                            <div class="inputGroup">
                                <input id="Papilloma_single" name="Papilloma_single" type="checkbox"/>
                                <label for="Papilloma_single">Papilloma (single)</label>
                            </div>
                            <div class="inputGroup">
                                <input id="Periductal_mastitis_duct_ectasia" name="Periductal_mastitis_duct_ectasia" type="checkbox"/>
                                <label for="Periductal_mastitis_duct_ectasia">Periductal mastitis/duct ectasia</label>
                            </div>
                            <div class="inputGroup">
                                <input id="Sclerosing_adenosis" name="Sclerosing_adenosis" type="checkbox"/>
                                <label for="Sclerosing_adenosis">Sclerosing adenosis</label>
                            </div>
                            <div class="inputGroup">
                                <input id="Solitary_cyst" name="Solitary_cyst" type="checkbox"/>
                                <label for="Solitary_cyst">Solitary cyst</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row epithelial_proliferation_main hide_main hidden">
                <div class="col-md-12 card">
                    <div class="card-body">
                        <div class="col-md-12 form-group text-center">
                            <h3> Epithelial proliferation </h3>
                            <p>Is there  a history of neo-adjuvant theropy?</p>
                            <p class="text-muted">Select single option from the list below</p>
                        </div>

                        <div class="row form-group benign_lesions">
                            <div class="inputGroup">
                                <input id="Not_present" name="Not_present" type="checkbox"/>
                                <label for="Not_present">Not present</label>
                            </div>
                            <div class="inputGroup">
                                <input id="Present_without_atypia" name="Present_without_atypia" type="checkbox"/>
                                <label for="Present_without_atypia">Present without atypia</label>
                            </div>
                            <div class="inputGroup">
                                <input id="Flat_epithelial_atypia" name="Flat_epithelial_atypia" type="checkbox"/>
                                <label for="Flat_epithelial_atypia">Flat epithelial atypia</label>
                            </div>
                            <div class="inputGroup">
                                <input id="atypia_ductal" name="atypia_ductal" type="checkbox"/>
                                <label for="atypia_ductal">Atypia (ductal)</label>
                            </div>
                            <div class="inputGroup">
                                <input id="atypia_lobular" name="atypia_lobular" type="checkbox"/>
                                <label for="atypia_lobular">Atypia (lobular)</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row Malignant_lesions_main hide_main hidden">
                <div class="col-md-12 card">
                    <div class="card-body">
                        <div class="col-md-12 form-group text-center">
                            <h3> Malignant lesions </h3>
                            <p>Is there  a history of neo-adjuvant theropy?</p>
                            <p class="text-muted">Select single option from the list below</p>
                        </div>

                        <div class="form-group Malignant_lesions">
                            <div class="row form-group radio-toolbar Malignant_in_situ_lesion hide_it">
                                <div class="col-md-6">
                                    <input type="radio" id="Malignant_in_situ_lesion_not_present" name="Malignant_in_situ_lesion" value="Malignant_in_situ_lesion_not_present" class="">
                                    <label for="Malignant_in_situ_lesion_not_present">Not Present</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" id="Malignant_in_situ_lesion_present" name="Malignant_in_situ_lesion" value="Malignant_in_situ_lesion_present" class="">
                                    <label for="Malignant_in_situ_lesion_present">Present</label>
                                </div>
                            </div>
                            <div class="row form-group radio-toolbar Malignant_in_situ_components hide_it">
                                <div class="col-md-4">
                                    <input type="radio" id="Malignant_in_situ_components_ductal" name="Malignant_in_situ_components" value="Malignant_in_situ_components_ductal" class="">
                                    <label for="Malignant_in_situ_components_ductal">Ductal</label>

                                </div>
                                <div class="col-md-4">
                                    <input type="radio" id="Malignant_in_situ_components_Lobular" name="Malignant_in_situ_components" value="Malignant_in_situ_components_Lobular" class="">
                                    <label for="Malignant_in_situ_components_Lobular">Lobular</label>

                                </div>
                                <div class="col-md-4">
                                    <input type="radio" id="Malignant_in_situ_components_Pagets" name="Malignant_in_situ_components" value="Malignant_in_situ_components_Pagets" class="">
                                    <label for="Malignant_in_situ_components_Pagets">Paget’s</label>

                                </div>

                            </div>
                            <div class="row form-group radio-toolbar CIS_grade hide_it">
                                <div class="col-md-6">
                                    <input type="radio" id="CIS_grade_High" name="CIS_grade" value="CIS_grade_High" class="">
                                    <label for="CIS_grade_High">High</label>

                                </div>
                                <div class="col-md-6">
                                    <input type="radio" id="CIS_grade_Intermediate" name="CIS_grade" value="CIS_grade_Intermediate" class="">
                                    <label for="CIS_grade_Intermediate">Intermediate</label>

                                </div>
                                <div class="col-md-6">
                                    <input type="radio" id="CIS_grade_Low" name="CIS_grade" value="CIS_grade_Low" class="">
                                    <label for="CIS_grade_Low">Low</label>

                                </div>
                                <div class="col-md-6">
                                    <input type="radio" id="CIS_grade_Not_assessable" name="CIS_grade" value="CIS_grade_Not_assessable" class="">
                                    <label for="CIS_grade_Not_assessable">Not assessable</label>

                                </div>

                            </div>
                            <div class="row form-group DCIS_growth_pattern hide_it">
                                <div class="inputGroup">
                                    <input id="Solid" name="Solid" type="checkbox"/>
                                    <label for="Solid">Solid </label>
                                </div>
                                <div class="inputGroup">
                                    <input id="Cribriform" name="Cribriform" type="checkbox"/>
                                    <label for="Cribriform">Cribriform </label>
                                </div>
                                <div class="inputGroup">
                                    <input id="Papillary" name="Papillary" type="checkbox"/>
                                    <label for="Papillary">Papillary </label>
                                </div>
                                <div class="inputGroup">
                                    <input id="Micropapillary" name="Micropapillary" type="checkbox"/>
                                    <label for="Micropapillary">Micropapillary </label>
                                </div>
                                <div class="inputGroup">
                                    <input id="Apocrine" name="Apocrine" type="checkbox"/>
                                    <label for="Apocrine">Apocrine </label>
                                </div>
                                <div class="inputGroup">
                                    <input id="Flat" name="Flat" type="checkbox"/>
                                    <label for="Flat">Flat </label>
                                </div>
                                <div class="inputGroup">
                                    <input id="Comedo" name="Comedo" type="checkbox"/>
                                    <label for="Comedo">Comedo </label>
                                </div>
                            </div>

                            <div class="row form-group radio-toolbar DCIS_necrosis hide_it">
                                <div class="col-md-6">
                                    <input type="radio" id="DCIS_necrosis_present" name="DCIS_necrosis" value="DCIS_necrosis_present" class="">
                                    <label for="DCIS_necrosis_present">Present</label>

                                </div>
                                <div class="col-md-6">
                                    <input type="radio" id="DCIS_necrosis_Absent" name="DCIS_necrosis" value="DCIS_necrosis_Absent" class="">
                                    <label for="DCIS_necrosis_Absent">Absent</label>

                                </div>
                            </div>

                            <div class="row form-group radio-toolbar Inflammation hide_it">
                                <div class="col-md-6">
                                    <input type="radio" id="Inflammation_present" name="Inflammation" value="Inflammation_present" class="">
                                    <label for="Inflammation_present">Present</label>

                                </div>
                                <div class="col-md-6">
                                    <input type="radio" id="Inflammation_present_Absent" name="Inflammation" value="Inflammation_present_Absent" class="">
                                    <label for="Inflammation_present_Absent">Absent</label>

                                </div>
                            </div>

                            <div class="row form-group Pure_DCIS_size_mm hide_it">
                                <div class="col-md-12">
                                    <input type="text" class="form-control input-lg" name="">
                                </div>
                            </div>

                            <div class="row form-group radio-toolbar LCIS hide_it">
                                <div class="col-md-6">
                                    <input type="radio" id="LCIS_present" name="LCIS" value="LCIS_present" class="">
                                    <label for="LCIS_present">Present</label>

                                </div>
                                <div class="col-md-6">
                                    <input type="radio" id="LCIS_absent" name="LCIS" value="LCIS_absent" class="">
                                    <label for="LCIS_absent">Absent</label>

                                </div>

                            </div>
                            <div class="row form-group radio-toolbar Pagets_disease hide_it">
                                <div class="col-md-6">
                                    <input type="radio" id="Pagets_disease_present" name="Pagets_disease" value="Pagets_disease_present" class="">
                                    <label for="Pagets_disease_present">Present</label>

                                </div>
                                <div class="col-md-6">
                                    <input type="radio" id="Pagets_disease_absent" name="Pagets_disease" value="Pagets_disease_absent" class="">
                                    <label for="Pagets_disease_absent">Absent</label>

                                </div>
                            </div>
                            <div class="row form-group radio-toolbar Microinvasive hide_it">
                                <div class="col-md-6">
                                    <input type="radio" id="Microinvasive_present" name="Microinvasive" value="Microinvasive_present" class="">
                                    <label for="Pagets_disease_present">Present</label>

                                </div>
                                <div class="col-md-6">
                                    <input type="radio" id="Microinvasive_absent" name="Microinvasive" value="Microinvasive_absent" class="">
                                    <label for="Microinvasive_absent">Absent</label>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row Invasive_carcinoma_main hide_main hidden">
                <div class="col-md-12 card">
                    <div class="card-body">
                        <div class="col-md-12 form-group text-center">
                            <h3> Invasive Carcinoma </h3>
                            <p>Is there  a history of neo-adjuvant theropy?</p>
                            <p class="text-muted">Select single option from the list below</p>
                        </div>
                        <div class="col-md-12 form-group Invasive_carcinoma hide_it">
                            <div class="row radio-toolbar">
                                <div class="col-md-6 form-group">
                                    <input type="radio" id="Invasive_carcinoma_present" name="Invasive_carcinoma" value="Invasive Carcinoma Present">
                                    <label for="Invasive_carcinoma_present">Present</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="radio" id="Invasive_carcinoma_absent" name="Invasive_carcinoma" value="Invasive Carcinoma Absent">
                                    <label for="Invasive_carcinoma_absent">Absent</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row Size_and_extent_main hide_main hidden">
                <div class="col-md-12 card">
                    <div class="card-body">
                        <div class="col-md-12 form-group text-center">
                            <h3> Size and extent </h3>
                            <p>Is there  a history of neo-adjuvant theropy?</p>
                            <p class="text-muted">Select single option from the list below</p>
                        </div>

                        <div class="form-group Size_and_extent">
                            <div class="row form-group tumor_sizes_mm hide_it">
                                <div class="col-md-6">
                                    <label for="">Tumour size (mm)</label>
                                    <input type="text" class="form-control input-lg">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Whole tumour size (mm)</label>
                                    <input type="text" class="form-control input-lg">
                                </div>
                            </div>
                            <div class="row form-group radio-toolbar Disease_extent hide_it">
                                <div class="col-md-6 form-group">
                                    <input type="radio" id="Disease_extent_Localised" name="Disease_extent" value="Disease_extent_Localised">
                                    <label for="Disease_extent_Localised">Localised</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="radio" id="Disease_extent_multi_invac" name="Disease_extent" value="Disease_extent_multi_invac">
                                    <label for="Disease_extent_multi_invac">Multiple invasive foci</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="radio" id="Disease_extent_not_assessable" name="Disease_extent" value="Disease_extent_not_assessable">
                                    <label for="Disease_extent_not_assessable">Not assessable</label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row Invasive_tumour_type_main hide_main hidden">
                <div class="col-md-12 card">
                    <div class="card-body">
                        <div class="col-md-12 form-group text-center">
                            <h3> Invasive Tumor Type </h3>
                            <p>Is there  a history of neo-adjuvant theropy?</p>
                            <p class="text-muted">Select single option from the list below</p>
                        </div>

                        <div class="form-group">
                            <div class="row form-group radio-toolbar Invasive_tumour_type hide_it">
                                <div class="col-md-6 form-group">
                                    <input type="radio" id="pure_check" name="Invasive_tumour_type" value="Invasive_tumour_type_pure">
                                    <label for="Invasive_tumour_type_pure">Pure (tick one box below)</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="radio" id="mixed_check" name="Invasive_tumour_type" value="Invasive_tumour_type_mixed">
                                    <label for="Invasive_tumour_type_mixed">Mixed (tick all components Blow)</label>
                                </div>

                            </div>
                            <div class="row form-group radio-toolbar pure_checked hidden">
                                <div class="col-md-6 form-group">
                                    <input type="radio" id="pure_checked_tubular" name="pure_checked" value="pure_checked_tubular">
                                    <label for="pure_checked_tubular">Tubular/Cribriform</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="radio" id="pure_checked_Lobular" name="pure_checked" value="pure_checked_Lobular">
                                    <label for="pure_checked_Lobular">Lobular</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="radio" id="pure_checked_Mucinous" name="pure_checked" value="pure_checked_Mucinous">
                                    <label for="pure_checked_Mucinous">Mucinous</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="radio" id="pure_checked_Medullary_like" name="pure_checked" value="pure_checked_Medullary_like">
                                    <label for="pure_checked_Medullary_like">Medullary-like</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="radio" id="pure_checked_Ductal_NST" name="pure_checked" value="pure_checked_Ductal_NST">
                                    <label for="pure_checked_Ductal_NST">Ductal/NST</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="radio" id="pure_checked_Micropapillary" name="pure_checked" value="pure_checked_Micropapillary">
                                    <label for="pure_checked_Micropapillary">Micropapillary</label>
                                </div>
                            </div>
                            <div class="row form-group mixed_checked hidden">
                                <div class="inputGroup">
                                    <input id="Tubular_Cribriform" name="Tubular_Cribriform" type="checkbox"/>
                                    <label for="Tubular_Cribriform">Tubular/Cribriform</label>
                                </div>
                                <div class="inputGroup">
                                    <input id="Lobular" name="Lobular" type="checkbox"/>
                                    <label for="Lobular">Lobular</label>
                                </div>
                                <div class="inputGroup">
                                    <input id="Mucinous" name="Mucinous" type="checkbox"/>
                                    <label for="Mucinous">Mucinous</label>
                                </div>
                                <div class="inputGroup">
                                    <input id="Medullary_like " name="Medullary_like " type="checkbox"/>
                                    <label for="Medullary_like ">Medullary-like </label>
                                </div>
                                <div class="inputGroup">
                                    <input id="Ductal_NST" name="Ductal_NST" type="checkbox"/>
                                    <label for="Ductal_NST">Ductal/NST</label>
                                </div>
                                <div class="inputGroup">
                                    <input id="Micropapillary" name="Micropapillary" type="checkbox"/>
                                    <label for="Micropapillary">Micropapillary </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row Histological_grade_main hide_main hidden">
                <div class="col-md-12 card">
                    <div class="card-body">
                        <div class="col-md-12 form-group text-center">
                            <h3> Histological Grade </h3>
                            <p>Is there  a history of neo-adjuvant theropy?</p>
                            <p class="text-muted">Select single option from the list below</p>
                        </div>

                        <div class="form-group Histological_grade-area">
                            <div class="row form-group Histological_grade hide_it">
                                <div class="row radio-toolbar">
                                    <div class="col-md-6 form-group">
                                        <input type="radio" id="Tubul_formation1" name="Histological_grade" value="Histological Grade 1">
                                        <label for="Tubul_formation1">1</label>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="radio" id="Histological_grade2" name="Histological_grade" value="Histological Grade 2" class="">
                                        <label for="Histological_grade2">2</label>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="radio" id="Histological_grade3" name="Histological_grade" value="Histological Grade 3" class="">
                                        <label for="Histological_grade3">3</label>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="radio" id="Histological_grade_not_assessable" name="Histological_grade" value="Histological Grade Not assessable" class="">
                                        <label for="Histological_grade_not_assessable">Not assessable</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group Tubule_formation hide_it">
                                <div class="row radio-toolbar">
                                    <div class="col-md-6 form-group">
                                        <input type="radio" id="Tubul_formation1" name="Tubul_formation" value="Tubul Formation 1">
                                        <label for="Tubul_formation1">1</label>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="radio" id="Tubul_formation2" name="Tubul_formation" value="Tubul Formation 2" class="">
                                        <label for="Tubul_formation2">2</label>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="radio" id="Tubul_formation3" name="Tubul_formation" value="Tubul Formation 3" class="">
                                        <label for="Tubul_formation3">3</label>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="radio" id="Tubul_formation_not_assessable" name="Tubul_formation" value="Tubul Formation Not assessable" class="">
                                        <label for="Tubul_formation_not_assessable">Not assessable</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group Nuclear_pleomorphism hide_it">
                                <div class="row radio-toolbar">
                                    <div class="col-md-6 form-group">
                                        <input type="radio" id="Nuclear_pleomorphism1" name="Nuclear_pleomorphism" value="Nuclear pleomorphism 1">
                                        <label for="Nuclear_pleomorphism1">1</label>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="radio" id="Nuclear_pleomorphism2" name="Nuclear_pleomorphism" value="Nuclear pleomorphism 2" class="">
                                        <label for="Nuclear_pleomorphism2">2</label>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="radio" id="Nuclear_pleomorphism3" name="Nuclear_pleomorphism" value="Nuclear pleomorphism 3" class="">
                                        <label for="Nuclear_pleomorphism3">3</label>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="radio" id="Nuclear_pleomorphism_not_assessable" name="Nuclear_pleomorphism" value="Nuclear pleomorphism Not assessable" class="">
                                        <label for="Nuclear_pleomorphism_not_assessable">Not assessable</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group Mitoses hide_it">
                                <div class="row radio-toolbar">
                                    <div class="col-md-6 form-group">
                                        <input type="radio" id="Mitoses1" name="Mitoses" value="Mitoses 1">
                                        <label for="Mitoses1">1</label>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="radio" id="Mitoses2" name="Mitoses" value="Mitoses 2" class="">
                                        <label for="Mitoses2">2</label>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="radio" id="Mitoses3" name="Mitoses" value="Mitoses 3" class="">
                                        <label for="Mitoses3">3</label>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="radio" id="Mitoses_not_assessable" name="Mitoses" value="Mitoses Not assessable" class="">
                                        <label for="Mitoses_not_assessable">Not assessable</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row Lymph_node_stage_main hide_main hidden">
                <div class="col-md-12 card">
                    <div class="card-body">
                        <div class="col-md-12 form-group text-center">
                            <h3> Lymph node stage </h3>
                            <p>Is there  a history of neo-adjuvant theropy?</p>
                            <p class="text-muted">Select single option from the list below</p>
                        </div>

                        <div class="col-md-12 form-group Lymph_node_stage-area">
                            <div class="row form-group Lymph_node_stage hide_it">
                                <row class="form-group">
                                    <h3>Sentinel LN assessed</h3>
                                </row>
                                <div class="row radio-toolbar">
                                    <div class="col-md-6 form-group">
                                        <input type="radio" id="Sentinel_LN_assessed_no" name="Sentinel_LN_assessed" value="Sentinel_LN_assessed No">
                                        <label for="Sentinel_LN_assessed_no">No</label>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="radio" id="Sentinel_LN_assessed_yes" name="Sentinel_LN_assessed" value="Sentinel_LN_assessed Yes" class="">
                                        <label for="Sentinel_LN_assessed_yes">Yes</label>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="radio" id="Sentinel_LN_assessed_positive" name="Sentinel_LN_assessed" value="Sentinel_LN_assessed Positive" class="">
                                        <label for="Sentinel_LN_assessed_positive">Positive</label>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="radio" id="Sentinel_LN_assessed_negative" name="Sentinel_LN_assessed" value="Sentinel_LN_assessed__negative" class="">
                                        <label for="Sentinel_LN_assessed_negative">Negatie</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group Sentinel_LN_positve hide_it">
                                <row class="form-group">
                                    <h3>Sentinel LN Positive</h3>
                                </row>
                                <div class="row radio-toolbar Macrometastasis_main">
                                    <div class="inputGroup">
                                        <input id="Macrometastasis" name="Macrometastasis" type="checkbox"/>
                                        <label for="Macrometastasis">Macrometastasis</label>
                                    </div>
                                    <div class="inputGroup">
                                        <input id="Micrometastasis" name="Micrometastasis" type="checkbox"/>
                                        <label for="Micrometastasis">Micrometastasis</label>
                                    </div>
                                    <div class="inputGroup">
                                        <input id="ITCs" name="ITCs" type="checkbox"/>
                                        <label for="ITCs">ITCs</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group Sentinel_LN_negative hide_it">
                                <row class="form-group">
                                    <h3>Sentinel LN Negative</h3>
                                    <p>Method of assessment</p>
                                </row>
                                <div class="row radio-toolbar Macrometastasis_main">
                                    <div class="inputGroup">
                                        <input id="PCR" name="PCR" type="checkbox"/>
                                        <label for="PCR">PCR </label>
                                    </div>
                                    <div class="inputGroup">
                                        <input id="OSNA" name="OSNA" type="checkbox"/>
                                        <label for="OSNA">OSNA</label>
                                    </div>
                                    <div class="inputGroup">
                                        <input id="Frozen_section" name="Frozen_section" type="checkbox"/>
                                        <label for="Frozen_section">Frozen section</label>
                                    </div>
                                    <div class="inputGroup">
                                        <input id="Cytology" name="Cytology" type="checkbox"/>
                                        <label for="Cytology">Cytology</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row Lymphovascular_invasion_main hide_main hidden">
                <div class="col-md-12 card">
                    <div class="card-body">
                        <div class="col-md-12 form-group text-center">
                            <h3> Lymphovascular invasion </h3>
                            <p>Is there  a history of neo-adjuvant theropy?</p>
                            <p class="text-muted">Select single option from the list below</p>
                        </div>
                        <div class="col-md-12 form-group Lymphovascular_invasion hide_it">
                            <div class="row radio-toolbar">
                                <div class="col-md-4 form-group">
                                    <input type="radio" id="Lymphovascular_invasion_present" name="Invasive_carcinoma" value="Invasive Carcinoma Present">
                                    <label for="Lymphovascular_invasion_present">Present</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <input type="radio" id="Lymphovascular_invasion_absent" name="Invasive_carcinoma" value="Invasive Carcinoma Absent">
                                    <label for="Lymphovascular_invasion_absent">Absent</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <input type="radio" id="Lymphovascular_invasion_possible" name="Invasive_carcinoma" value="Invasive Carcinoma Posible">
                                    <label for="Lymphovascular_invasion_possible">Possible</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
</section>