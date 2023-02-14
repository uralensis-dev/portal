
<style>

    .donate-now {
        list-style-type: none;
        margin: 25px 0 0 0;
        padding: 0;
    }

    .donate-now li {
        float: left;
        margin: 0 5px 0 0;
        width: 150px;
        height: 55px;
        position: relative;
        text-align: center;
    }

    .donate-now label,
    .donate-now input {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    .donate-now input[type="radio"] {
        opacity: 0.01;
        z-index: 100;
    }

    .donate-now input[type="radio"]:checked+label,
    .Checked+label {
        background: #0274da;
        color: white;
        border: 1px solid white;
        border-radius: 25px;
        width: 150px;
    }

    .donate-now label {
        padding: 7px;
        margin: 5px;
        background: #00bbf7;
        color: white;
        border: 1px solid white;
        border-radius: 25px;
        width: 150px;
    }

    .donate-now label:hover {
        background: #DDD;
    }

    .faq-card .card .card-header h4 > a:not(.collapsed):after {
        content: none;
    }
</style>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$get_record = get_breast_cancer_dataset_record();
$side_menu_state = " hidden ";
$btn_label = "Save";
$dataset_record_id = "";
$html_response = "";
if ($this->uri->segment(4) != '') {
//    $get_record = $dataset_breast_cancer = get_breast_cancer_dataset_record($this->uri->segment(4), $this->uri->segment(13));
//    $dataset_breast_cancer_specimen = get_breast_cancer_dataset_specimen($this->uri->segment(4));
    if (!empty($get_record)) {
//        _print_r($get_record);
        $side_menu_state = "";
        $btn_label = "Update";
        $dataset_record_id = $get_record[0]['dataset_record_id'];
        $html_response = $get_record[0]['breast_cancer_response_html'];
        $get_record[0] = json_decode($get_record[0]['breast_cancer_data'], true);
//        _print_r($get_record);
    } else {
        $side_menu_state = " hidden ";
        $btn_label = "Save";
        $dataset_record_id = "";
    }

    if ($btn_label == "Update") {
        ?>
        <style>
            .slides { display: initial }
            .right_slide,.left_slide {display: none; border-radius: 30px;}
            .new_label { font-size: 20px !important; color: #00c5fb;}
        </style>
    <?php } ?>
    <form id="breast_cancer_form" action="<?php echo site_url('_dataset/breast_cancer_dataset/save_record') ?>" method="post" accept-charset="utf-8">
        <input type="hidden" value="<?php echo $this->uri->segment(4) ?>" name="record_id">
        <input type="hidden" value="<?php echo $dataset_record_id ?>" name="dataset_record_id">
        <input type="hidden" id="breast_cancer_response_html" value='<?= $html_response ?>' name="breast_cancer_response_html">
    <?php }
    ?>

    <div class="page-header">
        <div class="row">
            <div class="col-sm-4">
                <h3 class="page-title">Datasets</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Datasets</li>
                </ul>
            </div>
            <div class="col-sm-4">
                <div class="row sidebar_title">
                    <input type="hidden" name="dataset_type" value="Breast">
                    <div class="col-sm-12">
                        <input type="hidden" name="dataset_title" value="Breast Cancer">
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-right float-right ml-auto">



                <?php if ($this->uri->segment(4) != '') { ?>
                    <?php if ($dataset_breast_cancer[0]['dataset_record_id'] != '') { ?>

                        <a onclick="return confirm_delete();" href="<?php echo site_url('_dataset/breast_cancer_dataset/removeDatasetbyID/' . $dataset_breast_cancer[0]['dataset_record_id'] . '/' . $dataset_breast_cancer[0]['record_id']) ?>" class="btn btn-danger btn-rounded"><i class="fa fa-trash"></i> </a>

                    <?php } ?>
                    <a href="<?php echo site_url('doctor/doctor_record_detail_old/' . $this->uri->segment(4)) ?>" class="btn btn-primary btn-rounded"><i class="fa fa-arrow-left"></i>   Back to Record  </a>

                <?php } else { ?>
                    <a href="<?php echo site_url('_dataset/dataset/dashboard') ?>" class="btn btn-primary btn-rounded btn-lg"><i class="fa fa-arrow-left"></i> Back </a>
                <?php } ?>

            </div>
        </div>
    </div>

    <?php if ($this->uri->segment(4) != '') { ?>
        <table class="table custom-table " style="margin-bottom: 10;    border: 1px solid gainsboro;">
            <tbody><tr style="box-shadow:0px 0px 0px 0px !important;">
                    <td>
                        <span class="tg-namelogo"> <?php echo urldecode($this->uri->segment(5)); ?>  </span>
                        <span style="display:inline-block; margin-top: 12px;; margin-left: 10px;"> <?php echo urldecode($this->uri->segment(6)); ?> </span>
                    </td>
                    <td><span>DOB:  <?php echo urldecode($this->uri->segment(9)); ?></span></td>
                    <td><span>NHS:  <?php echo urldecode($this->uri->segment(10)); ?></span></td>
                    <td> <span>Gender: <?php echo urldecode($this->uri->segment(11)); ?></span></td>
                    <td> <span>Lab No.: <?php echo urldecode($this->uri->segment(12)); ?></span></td>
                </tr>
            </tbody></table>

    <?php } ?>       
    <br>
    <section>
        <h5 class="text-center text-muted">
            <small>
                <strong> Created at: </strong> <?= $dataset_breast_cancer[0]['created_at'] ?>
                <strong> Updated at: </strong> <?= $dataset_breast_cancer[0]['modified_at'] ?>
            </small>
        </h5>

        <div class="row">

            <div class="col-md-3">
                <div style="">
                    <div class="col-sm-12 form-group">
                        <h3 style="padding-top:20px"><i style="background: #00c5fb;color: white;padding: 10px;border-radius: 30px;font-size: 35px;" class="ti-harddrive" title="Datasets"></i> Breast Cancer Dataset</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="faq-card">
                                <div class="card mb-1">
                                    <div class="card-header">
                                        <a href="#slide-1">
                                            <h4 class="card-title">Surgical Specimen
                                            </h4></a>
                                    </div>
                                    <div id="" style="">
                                        <div class="card-body">
                                            <ul class="list-unstyled">                                                                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide1_stat success"></span><a href="#slide-1"> Side </a></li>
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide2_stat success"></span><a id='slide_02' href="#slide-2"> Specimen Type </a></li>
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide3_stat success"></span><a id='slide_03' href="#slide-3"> Specimen Radiograph Seen </a></li>
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide4_stat success"></span><a id='slide_04' href="#slide-4"> Mammographic Abnormality </a></li>
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide5_stat success"></span><a id='slide_05' href="#slide-5"> Site of Previous Core Biopsy Seen </a></li>
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide6_stat success"></span><a id='slide_06' href="#slide-6"> Histological Calcification </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="faq-card">
                                <div class="card mb-1">
                                    <div class="card-header"><a id="slide_07" href="#slide-7">
                                            <h4 class="card-title">
                                                Benign lesions 
                                            </h4></a>
                                    </div>
                                    <div id="" style="">
                                        <div class="card-body">
                                            <ul class="list-unstyled">                                                                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide7_stat success"></span><a id='slide_07' href="#slide-7"> Benign lesions  </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="faq-card">
                                <div class="card mb-1">
                                    <div class="card-header"><a id="slide_08" href="#slide-8">
                                            <h4 class="card-title">
                                                Epithelial proliferation 
                                            </h4></a>
                                    </div>
                                    <div id="" style="">
                                        <div class="card-body">
                                            <ul class="list-unstyled">                                                                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide8_stat success"></span><a id='slide_08' href="#slide-8"> Epithelial proliferation  </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="faq-card">
                                <div class="card mb-1">
                                    <div class="card-header"><a id="slide_09" href="#slide-9">
                                            <h4 class="card-title">
                                                Malignant lesions 
                                            </h4></a>
                                    </div>
                                    <div id="" style="">
                                        <div class="card-body">
                                            <ul class="list-unstyled">                                                                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide9_stat success"></span><a id='slide_09' href="#slide-9"> Invasive carcinoma    </a></li>   
                                                <!--<li><span class="fa fa-check <?php echo $side_menu_state ?> slide10_stat success"></span><a id='slide_10' href="#slide-10"> Invasive carcinoma    </a></li>--> 
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide11_stat success"></span><a id='slide_11' href="#slide-11"> Size and extent  </a></li>   
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide12_stat success"></span><a id='slide_12' href="#slide-12"> Invasive tumour type    </a></li>  
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide13_stat success"></span><a id='slide_13' href="#slide-13"> Histological grade   </a></li> 
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide14_stat success"></span><a id='slide_14' href="#slide-14"> Lymphovascular invasion      </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="faq-card">
                                <div class="card mb-1">
                                    <div class="card-header"><a id="slide_15" href="#slide-15">
                                            <h4 class="card-title">
                                                Modifications for post neoadjuvant therapy cases
                                            </h4></a>
                                    </div>
                                    <div id="" style="">
                                        <div class="card-body">
                                            <ul class="list-unstyled">                                                                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide15_stat success"></span><a id='slide_15' href="#slide-15"> Residual tumour size and extent </a></li> 
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide16_stat success"></span><a id='slide_16' href="#slide-16"> Residual invasive tumour type    </a></li>
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide17_stat success"></span><a id='slide_17' href="#slide-17"> Residual tumour histological grade   </a></li>       
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row col-md-12 form-group">
                    <ul class="radio_links list-inline step1 hidden">
                        <li class="list-inline-item"><a href="javascript:;"><i class="fa fa-angle-left"></i></a></li>
                        <li class="list-inline-item"><a href="#slide-1" class="circle_carousel active"></a></li>
                        <li class="list-inline-item"><a href="#slide-2" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-3" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-4" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-5" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="javascript:;" class="next_2"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                    <ul class="radio_links list-inline step2 hidden">
                        <li class="list-inline-item"><a href="javascript:;" class="back_1"><i class="fa fa-angle-left"></i></a></li>
                        <li class="list-inline-item"><a href="#slide-6" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-7" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-8" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-9" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-11" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="javascript:;" class="next_3"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                    <ul class="radio_links list-inline step3 hidden">
                        <li class="list-inline-item"><a href="javascript:;" class="back_2"><i class="fa fa-angle-left"></i></a></li>
                        <li class="list-inline-item"><a href="#slide-12" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-13" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-14" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-15" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-16" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-17" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="javascript:;" class=""><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div>

                <div class="row surgical_specimen_selection  ">
                    <div class="col-md-12 card" style="">

                        <div class="card-body">

                            <div class="slides">

                                <div id="slide-1">  
                                    <div class="row form-group  <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h3>Surgical Specimen</h3>
                                            <h4>Is there  a history of neo-adjuvant theropy?</h4>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="radioRight" name="specimen_sides" value="Right" <?php echo $btn_label == 'Update' && $get_record[0]['specimen_sides'] == 'Right' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioRight">Right</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="radioLeft" name="specimen_sides" value="Left"  <?php echo $btn_label == 'Update' && $get_record[0]['specimen_sides'] == 'Left' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioLeft">Left</label></span>
                                        </div>
                                    </div>
                                    <a href="javascript:;" class="left_slide"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-2" class="right_slide"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-2">
                                    <div class="row form-group  <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main  text-center">
                                        <div class="col-md-12  text-center">
                                            <h3>Surgical Specimen</h3>
                                            <h4>Specimen Type?</h4>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="specimen_type_yes" name="specimen_type_select" value="Yes"  <?php echo $btn_label == 'Update' && $get_record[0]['specimen_type_select'] == 'Yes' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="specimen_type_yes">Yes</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="specimen_type_no" name="specimen_type_select" value="No"  <?php echo $btn_label == 'Update' && $get_record[0]['specimen_type_select'] == 'No' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="specimen_type_no">No</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="specimen_type_not_know" name="specimen_type_select" value="Not Know"  <?php echo $btn_label == 'Update' && $get_record[0]['specimen_type_select'] == 'Not Know' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="specimen_type_not_know">Not Know</label></span>
                                        </div>

                                    </div>
                                    <a href="#slide-1" class="left_slide"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-3" class="right_slide"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-3">
                                    <div class="row form-group  <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_radio_seen  text-center">
                                        <div class="col-md-12  text-center">
                                            <h3>Surgical Specimen</h3>
                                            <h4>Specimen Radiograph Seen?</h4>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="specimen_radio_seen_yes" name="specimen_radio_seen" value="Yes"  <?php echo $btn_label == 'Update' && $get_record[0]['specimen_radio_seen'] == 'Yes' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="specimen_radio_seen_yes">Yes</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="specimen_radio_seen_no" name="specimen_radio_seen" value="No"  <?php echo $btn_label == 'Update' && $get_record[0]['specimen_radio_seen'] == 'No' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="specimen_radio_seen_no">No</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-2" class="left_slide"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-4" class="right_slide"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-4">
                                    <div class="row form-group  <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> memo_absormality text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Surgical Specimen</h3>
                                            <h4>Mammographic Abnormality?</h4>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="memo_absormality_yes" name="memo_absormality" value="Yes"  <?php echo $btn_label == 'Update' && $get_record[0]['memo_absormality'] == 'Yes' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="memo_absormality_yes">Yes</label></span>

                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="memo_absormality_no" name="memo_absormality" value="No"  <?php echo $btn_label == 'Update' && $get_record[0]['memo_absormality'] == 'No' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="memo_absormality_no">No</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="memo_absormality_unsure" name="memo_absormality" value="Unsure"  <?php echo $btn_label == 'Update' && $get_record[0]['memo_absormality'] == 'Unsure' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="memo_absormality_unsure">Unsure</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-3" class="left_slide"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-5" class="right_slide"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-5">
                                    <div class="row form-group  <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> core_biopsy_seen text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Surgical Specimen</h3>
                                            <h4>Site of Previous Core Biopsy Seen?</h4>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="core_biopsy_yes" name="core_biopsy_seen" value="Yes"  <?php echo $btn_label == 'Update' && $get_record[0]['core_biopsy_seen'] == 'Yes' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="core_biopsy_yes">Yes</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="core_biopsy_no" name="core_biopsy_seen" value="No"  <?php echo $btn_label == 'Update' && $get_record[0]['core_biopsy_seen'] == 'No' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="core_biopsy_no">No</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-4" class="left_slide"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-6" class="right_slide"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-6">
                                    <div class="row form-group  <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> histological_calcification text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Surgical Specimen</h3>
                                            <h4>Histological Calcification?</h4>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="histological_calcification_absent" name="histological_calcification" value="Absent"  <?php echo $btn_label == 'Update' && $get_record[0]['histological_calcification'] == 'Absent' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="histological_calcification_absent">Absent</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="histological_calcification_benign" name="histological_calcification" value="Benign"  <?php echo $btn_label == 'Update' && $get_record[0]['histological_calcification'] == 'Benign' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="histological_calcification_benign">Benign</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="histological_calcification_malignant" name="histological_calcification" value="Malignant"  <?php echo $btn_label == 'Update' && $get_record[0]['histological_calcification'] == 'Malignant' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="histological_calcification_malignant">Malignant</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="histological_calcification_both" name="histological_calcification" value="Both"  <?php echo $btn_label == 'Update' && $get_record[0]['histological_calcification'] == 'Both' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="histological_calcification_both">Both</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-5" class="left_slide"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-7" class="right_slide"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-7">
                                    <div class="row form-group  <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> Benign_lesions text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Benign lesions </h3>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Columnar_cell_change" name="Benign_lesions" value="Columnar cell change"  <?php echo $btn_label == 'Update' && $get_record[0]['Benign_lesions'] == 'Columnar cell change' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Columnar_cell_change">Columnar cell change</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Complex_sclerosing_lesion" name="Benign_lesions" value="Complex sclerosing lesion or radial scar"  <?php echo $btn_label == 'Update' && $get_record[0]['Benign_lesions'] == 'Complex sclerosing lesion or radial scar' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Complex_sclerosing_lesion">Complex sclerosing lesion/radial scar</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Fibroadenoma" name="Benign_lesions" value="Fibroadenoma"  <?php echo $btn_label == 'Update' && $get_record[0]['Benign_lesions'] == 'Fibroadenoma' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Fibroadenoma">Fibroadenoma</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Fibrocystic_change" name="Benign_lesions" value="Fibrocystic change"  <?php echo $btn_label == 'Update' && $get_record[0]['Benign_lesions'] == 'Fibrocystic change' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Fibrocystic_change">Fibrocystic change</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Multiple_papillomas" name="Benign_lesions" value="Multiple papillomas"  <?php echo $btn_label == 'Update' && $get_record[0]['Benign_lesions'] == 'Multiple papillomas' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Multiple_papillomas">Multiple papillomas</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Papilloma" name="Benign_lesions" value="Papilloma - single"  <?php echo $btn_label == 'Update' && $get_record[0]['Benign_lesions'] == 'Papilloma - single' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Papilloma">Papilloma (single)</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Periductal_mastitis" name="Benign_lesions" value="Periductal mastitis or duct ectasia "  <?php echo $btn_label == 'Update' && $get_record[0]['Benign_lesions'] == 'Periductal mastitis or duct ectasia ' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Periductal_mastitis">Periductal mastitis/duct ectasia</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Sclerosing_adenosis" name="Benign_lesions" value="Sclerosing adenosis"  <?php echo $btn_label == 'Update' && $get_record[0]['Benign_lesions'] == 'Sclerosing adenosis' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Sclerosing_adenosis">Sclerosing adenosis</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Sclerosing_adenosis" id="" name="Benign_lesions" value="Sclerosing adenosis "  <?php echo $btn_label == 'Update' && $get_record[0]['id=""'] == 'Sclerosing adenosis ' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Sclerosing_adenosis">Sclerosing adenosis</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-6" class="left_slide"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-8" class="right_slide"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-8">
                                    <div class="row form-group  <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> Epithelial_proliferation text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Epithelial Proliferation </h3>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Not_present" name="Epithelial_proliferation" value="Not present"  <?php echo $btn_label == 'Update' && $get_record[0]['Epithelial_proliferation'] == 'Not present' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Not_present">Not present</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Present_without_atypia" name="Epithelial_proliferation" value="Present without atypia"  <?php echo $btn_label == 'Update' && $get_record[0]['Epithelial_proliferation'] == 'Present without atypia' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Present_without_atypia">Present without atypia </label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Flat_epithelial_atypia" name="Epithelial_proliferation" value="Flat epithelial atypia"  <?php echo $btn_label == 'Update' && $get_record[0]['Epithelial_proliferation'] == 'Flat epithelial atypia' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Flat_epithelial_atypia">Flat epithelial atypia</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Present_with_atypia" name="Epithelial_proliferation" value="Present with atypia - ductal"  <?php echo $btn_label == 'Update' && $get_record[0]['Epithelial_proliferation'] == 'Present with atypia - ductal' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Present_with_atypia">Present with atypia (ductal)</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Present_with_atypia" name="Epithelial_proliferation" value="Present with atypia - lobular"  <?php echo $btn_label == 'Update' && $get_record[0]['Epithelial_proliferation'] == 'Present with atypia - lobular' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Present_with_atypia">Present with atypia (lobular) </label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-7" class="left_slide"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-9" class="right_slide"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-9">
                                    <div class="row form-group  <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> Invasive_carcinoma text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Malignant lesions </h3>
                                            <h3>Invasive carcinoma </h3>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Absent" name="Invasive_carcinoma" value="Absent"  <?php echo $btn_label == 'Update' && $get_record[0]['Invasive_carcinoma'] == 'Absent' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Absent">Absent</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Present" name="Invasive_carcinoma" value="Present"  <?php echo $btn_label == 'Update' && $get_record[0]['Invasive_carcinoma'] == 'Present' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Present">Present</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-8" class="left_slide"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-11" class="right_slide"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-11">
                                    <div class="row form-group  <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> Size_and_extent text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Malignant lesions </h3>
                                            <h3>Size and extent </h3>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Localised" name="Size_and_extent" value="Localised"  <?php echo $btn_label == 'Update' && $get_record[0]['Size_and_extent'] == 'Localised' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Localised">Localised</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Multiple_invasive_foci" name="Size_and_extent" value="Multiple invasive foci"  <?php echo $btn_label == 'Update' && $get_record[0]['Size_and_extent'] == 'Multiple invasive foci' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Multiple_invasive_foci">Multiple invasive foci</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Not_assessable" name="Size_and_extent" value="Not assessable"  <?php echo $btn_label == 'Update' && $get_record[0]['Size_and_extent'] == 'Not assessable' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Not_assessable">Not assessable</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-9" class="left_slide"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-12" class="right_slide"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-12">
                                    <div class="row form-group  <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> Invasive_tumour_type text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Malignant lesions </h3>
                                            <h3>Invasive tumour type </h3>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Pure" name="Invasive_tumour_type" value="Pure"  <?php echo $btn_label == 'Update' && $get_record[0]['Invasive_tumour_type'] == 'Pure' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Pure">Pure</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Mixed" name="Invasive_tumour_type" value="Mixed"  <?php echo $btn_label == 'Update' && $get_record[0]['Invasive_tumour_type'] == 'Mixed' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Mixed">Mixed</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-11" class="left_slide"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-13" class="right_slide"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-13">
                                    <div class="row form-group  <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> Histological_grade text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Malignant lesions </h3>
                                            <h3> Histological grade </h3>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="1" name="Histological_grade" value="1"  <?php echo $btn_label == 'Update' && $get_record[0]['Histological_grade'] == '1' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="1">1</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="2" name="Histological_grade" value="2"  <?php echo $btn_label == 'Update' && $get_record[0]['Histological_grade'] == '3' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="2">2</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="3" name="Histological_grade" value="3"  <?php echo $btn_label == 'Update' && $get_record[0]['Histological_grade'] == '4' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="3">3</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Not_assessable" name="Histological_grade" value="Not assessable"  <?php echo $btn_label == 'Update' && $get_record[0]['Histological_grade'] == 'Not assessable' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Not_assessable">Not assessable</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-12" class="left_slide"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-14" class="right_slide"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-14">
                                    <div class="row form-group  <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> Lymphovascular_invasion text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Malignant lesions </h3>
                                            <h3>Lymphovascular invasion </h3>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Absent_" name="Lymphovascular_invasion" value="Absent"  <?php echo $btn_label == 'Update' && $get_record[0]['Lymphovascular_invasion'] == 'Right' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Absent_">Absent</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Present_" name="Lymphovascular_invasion" value="Present"  <?php echo $btn_label == 'Update' && $get_record[0]['Lymphovascular_invasion'] == 'Right' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Present_">Present</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Possible_" name="Lymphovascular_invasion" value="Possible"  <?php echo $btn_label == 'Update' && $get_record[0]['Lymphovascular_invasion'] == 'Right' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Possible_">Possible</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-13" class="left_slide"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-15" class="right_slide"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-15">
                                    <div class="row form-group  <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> Residual_tumour_size_and_extent text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Modifications for post neoadjuvant therapy cases </h3>
                                            <h3>Residual tumour size and extent </h3>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="_Localised" name="Residual_tumour_size_and_extent" value="Localised"  <?php echo $btn_label == 'Update' && $get_record[0]['Residual_tumour_size_and_extent'] == 'Right' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="_Localised">Localised</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="_Multiple_invasive_foci" name="Residual_tumour_size_and_extent" value="Multiple invasive foci"  <?php echo $btn_label == 'Update' && $get_record[0]['Residual_tumour_size_and_extent'] == 'Right' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="_Multiple_invasive_foci">Multiple invasive foci</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="_Not_assessable" name="Residual_tumour_size_and_extent" value="Not assessable"  <?php echo $btn_label == 'Update' && $get_record[0]['Residual_tumour_size_and_extent'] == 'Right' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="_Not_assessable">Not assessable</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-14" class="left_slide"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-16" class="right_slide"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-16">
                                    <div class="row form-group  <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> Residual_invasive_tumour_type text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Modifications for post neoadjuvant therapy cases </h3>
                                            <h3>Residual invasive tumour type </h3>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="_Pure" name="Residual_invasive_tumour_type" value="Pure"  <?php echo $btn_label == 'Update' && $get_record[0]['Residual_invasive_tumour_type'] == 'Right' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="_Pure">Pure</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="_Mixed" name="Residual_invasive_tumour_type" value="Mixed"  <?php echo $btn_label == 'Update' && $get_record[0]['Residual_invasive_tumour_type'] == 'Right' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="_Mixed">Mixed</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-15" class="left_slide"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-17" class="right_slide"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-17">
                                    <div class="row form-group  <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> Residual_tumour_histological_grade text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Modifications for post neoadjuvant therapy cases </h3>
                                            <h3> Histological grade </h3>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="_1" name="Residual_tumour_histological_grade" value="1"  <?php echo $btn_label == 'Update' && $get_record[0]['Residual_tumour_histological_grade'] == 'Right' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="_1">1</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="_2" name="Residual_tumour_histological_grade" value="2"  <?php echo $btn_label == 'Update' && $get_record[0]['Residual_tumour_histological_grade'] == 'Right' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="_2">2</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="_3" name="Residual_tumour_histological_grade" value="3"  <?php echo $btn_label == 'Update' && $get_record[0]['Residual_tumour_histological_grade'] == 'Right' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="_3">3</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="_Not_assessable" name="Residual_tumour_histological_grade" value="Not assessable"  <?php echo $btn_label == 'Update' && $get_record[0]['Residual_tumour_histological_grade'] == 'Right' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="_Not_assessable">Not assessable</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-16" class="left_slide"><i class="fa fa-chevron-left"></i></a>
                                    <a href="javascript:;" class="right_slide"><i class="fa fa-chevron-right"></i></a>
                                </div>
                            </div>

                            <?php if ($this->uri->segment(4) != '') { ?>
                                <div class="row pull-right" style="padding-top:30px">
                                    <input type="button" id="breast_cancer_submit" class="btn btn-lg btn-primary" value="<?php echo $btn_label ?> Record">
                                </div>
                            <?php } ?>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-3 col-sm-12"  id="section-to-print" style="margin-top:55px;">

                <div class="card col-md-12">
                    <div class="car-body pt-15">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <?php if ($this->uri->segment(4) == '') { ?>
                                    <h4>Info of Record (This is sample)</h4>
                                <?php } else {
                                    ?>
                                    <ul class="donate-now">
                                        <?php
                                        $sqCount = 1;
                                        foreach ($specimen_query as $sq) {
                                            ?>    
                                            <li>
                                                <input type="radio" id="patient_specimen<?= $sqCount ?>" class="patient_specimen" name="patient_specimen" value="<?= $sqCount ?>" <?= $get_record[0]['patient_specimen'] == $sqCount ? 'checked="true"' : $this->uri->segment(13) == $sqCount ? 'checked="true"' : '' ?>  required>
                                                <label for="patient_specimen<?= $sqCount ?>">
                                                    <?= (in_array($sqCount, explode(',', $dataset_breast_cancer_specimen))) ? '<span style="color: #12ff18;font-size: 2em;">&#8226;</span>' : '' ?>Specimen <?= $sqCount ?>
                                                </label>
                                            </li>
                                            <?php
                                            $sqCount++;
                                        }
                                        ?>  
                                    </ul>
                                <?php } ?>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="sidebar_title">Breast Cancer - Dataset</div>
                            </div>


                            <?php
                            if ($btn_label == 'Update') {
                                if ($html_response == '') {
                                    ?>
                                    <div id="breast_cancer_answers">

                                        <div class="sidebar_subtitle"><h3 id="1st_spec1"></h3></div>
                                        <div class="col-sm-12">
                                            <span class="slide1_ans"></span>
                                            <span class="slide2_ans"></span>
                                            <span class="slide3_ans"></span>
                                            <span class="slide4_ans"></span>
                                            <span class="slide5_ans"></span>
                                            <span class="slide6_ans"></span>
                                        </div>
                                        <div class="sidebar_subtitle"><h3 id="1st_spec2"></h3></div>
                                        <div class="col-sm-12">
                                            <span class="slide7_ans"></span>
                                        </div>
                                        <div class="sidebar_subtitle"><h3 id="1st_spec3"></h3></div>
                                        <div class="col-sm-12">
                                            <span class="slide8_ans"></span>
                                        </div>
                                        <div class="sidebar_subtitle"><h3 id="1st_spec4"></h3></div>
                                        <div class="col-sm-12">
                                            <span class="slide9_ans"></span>
                                            <span class="slide10_ans"></span>
                                            <span class="slide11_ans"></span>
                                            <span class="slide12_ans"></span>
                                            <span class="slide13_ans"></span>
                                            <span class="slide14_ans"></span>
                                        </div>
                                        <div class="sidebar_subtitle"><h3 id="1st_spec5"></h3></div>
                                        <div class="col-sm-12">
                                            <span class="slide15_ans"></span>
                                            <span class="slide16_ans"></span>
                                            <span class="slide17_ans"></span>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    echo $html_response;
                                }
                            } else {
                                ?>
                                <div id="breast_cancer_answers">

                                    <div class="sidebar_subtitle"><h3 id="1st_spec1"></h3></div>
                                    <div class="col-sm-12">
                                        <span class="slide1_ans"></span>
                                        <span class="slide2_ans"></span>
                                        <span class="slide3_ans"></span>
                                        <span class="slide4_ans"></span>
                                        <span class="slide5_ans"></span>
                                        <span class="slide6_ans"></span>
                                    </div>
                                    <div class="sidebar_subtitle"><h3 id="1st_spec2"></h3></div>
                                    <div class="col-sm-12">
                                        <span class="slide7_ans"></span>
                                    </div>
                                    <div class="sidebar_subtitle"><h3 id="1st_spec3"></h3></div>
                                    <div class="col-sm-12">
                                        <span class="slide8_ans"></span>
                                    </div>
                                    <div class="sidebar_subtitle"><h3 id="1st_spec4"></h3></div>
                                    <div class="col-sm-12">
                                        <span class="slide9_ans"></span>
                                        <span class="slide10_ans"></span>
                                        <span class="slide11_ans"></span>
                                        <span class="slide12_ans"></span>
                                        <span class="slide13_ans"></span>
                                        <span class="slide14_ans"></span>
                                    </div>
                                    <div class="sidebar_subtitle"><h3 id="1st_spec5"></h3></div>
                                    <div class="col-sm-12">
                                        <span class="slide15_ans"></span>
                                        <span class="slide16_ans"></span>
                                        <span class="slide17_ans"></span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                    <!--<a href="javascript:window.print();" class="btn btn-primary pts_bt btn-lg" style="margin:10px;"> <i class="fa fa-print"></i> Print / <i class="fa fa-file-pdf-o"></i> Save as PDF</a>-->

                    </div>
                </div>

            </div>



        </div>

    </section>
    <?php
    if ($this->uri->segment(4) != '') {
        echo "</form>";
    }
    ?>
