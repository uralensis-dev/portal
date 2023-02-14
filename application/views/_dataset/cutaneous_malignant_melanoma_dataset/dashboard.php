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
//$get_record = get_cutaneous_malignant_melanoma_dataset_record();
$side_menu_state = " hidden ";
$btn_label = "Save";
$dataset_record_id = "";
$html_response = "";

if ($this->uri->segment(4) != '') {
//    $get_record = $dataset_cmm = get_cmm_dataset_record($this->uri->segment(4), $this->uri->segment(13));
//    $dataset_cmm_specimen = get_cmm_dataset_specimen($this->uri->segment(4));
    if (!empty($get_record)) {
//        _print_r($get_record);
        $side_menu_state = "";
        $btn_label = "Update";
        $dataset_record_id = $get_record[0]['dataset_record_id'];
        $html_response = $get_record[0]['cmm_response_html'];
        $get_record[0] = json_decode($get_record[0]['cmm_data'], true);
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
    <form id='cmm_form' action="<?php echo site_url('_dataset/cutaneous_malignant_melanoma_dataset/save_record') ?>" method="post" >
        <input type="hidden" value="<?php echo $this->uri->segment(4) ?>" name="record_id">
        <input type="hidden" value="<?php echo $dataset_record_id ?>" name="dataset_record_id">
        <input type="hidden" id="cmm_respons_html" value='<?= $html_response ?>' name="cmm_respons_html">
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
                    <input type="hidden" name="dataset_id" value="19">
                    <input type="hidden" name="dataset_type" value="Cutaneous Malignant Melanoma">
                    <div class="col-sm-12">
                        <input type="hidden" name="dataset_title" value="Cutaneous Malignant Melanoma">
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-right float-right ml-auto">
                <?php if ($this->uri->segment(4) != '') { ?>
                    <?php if ($dataset_cmm[0]['dataset_record_id'] != '') { ?>

                        <a onclick="return confirm_delete();" href="<?php echo site_url('_dataset/cutaneous_malignant_melanoma_dataset/removeDatasetbyID/' . $dataset_cmm[0]['dataset_record_id'] . '/' . $dataset_cmm[0]['record_id']) ?>" class="btn btn-danger btn-rounded"><i class="fa fa-trash"></i> </a>

                    <?php } ?>
                    <a href="<?php echo site_url('doctor/doctor_record_detail_old/' . $this->uri->segment(4)) ?>" class="btn btn-primary btn-rounded"><i class="fa fa-arrow-left"></i>  Back to Record </a>

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
        <?php //_print_r($dataset_cmm); ?>
    <!--<h3 class="text-center"><?php echo $this->uri->segment(4) == '' ? '' : 'Record# ' . $this->uri->segment(4) ?></h3>-->
        <h5 class="text-center text-muted">
            <small>
                <strong> Created at: </strong> <?= $dataset_cmm[0]['created_at'] ?>
                <strong> Updated at: </strong> <?= $dataset_cmm[0]['modified_at'] ?>
            </small>
        </h5>

        <div class="row">

            <div class="col-md-3">
                <div>
                    <div class="col-sm-12 form-group">
                        <h3><i style="background: #00c5fb;color: white;padding: 10px;border-radius: 30px;font-size: 35px;" class="ti-harddrive" title="Datasets"></i> Cutaneous Malignant Melanoma Carcinoma</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="faq-card">
                                <div class="card mb-1">
                                    <div id="">
                                        <div class="card-body">
                                            <ul class="list-unstyled">

                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide1_stat success"></span><a id='slide_01' href="#slide-01"> Site  </a></li>   
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide2_stat success"></span><a id='slide_02' href="#slide-02"> Specimen type </a></li>   
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide3_stat success"></span><a id='slide_03' href="#slide-03"> Macroscopic ulceration </a></li>   
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide4_stat success"></span><a id='slide_04' href="#slide-04"> Photo taken  </a></li>   
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide5_stat success"></span><a id='slide_05' href="#slide-05"> Histological type  </a></li>   
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide6_stat success"></span><a id='slide_06' href="#slide-06"> Growth phase (inavsion)  </a></li>   
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide7_stat success"></span><a id='slide_07' href="#slide-07"> Invasive only  </a></li>   
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide8_stat success"></span><a id='slide_08' href="#slide-08"> Solar damage  </a></li>   
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide9_stat success"></span><a id='slide_09' href="#slide-09"> Host response </a></li>   
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide10_stat success"></span><a id='slide_010' href="#slide-010"> Locoregional spread </a></li>   
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide11_stat success"></span><a id='slide_011' href="#slide-011"> Excision margins </a></li>   
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide12_stat success"></span><a id='slide_012' href="#slide-012"> Co-existing lesion </a></li>   
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide13_stat success"></span><a id='slide_013' href="#slide-013"> Special techniques </a></li>   
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide14_stat success"></span><a id='slide_014' href="#slide-014"> Biomarkers  </a></li>   
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide15_stat success"></span><a id='slide_015' href="#slide-015"> Additional comments  </a></li>   
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide16_stat success"></span><a id='slide_016' href="#slide-016"> TNM stagin (AJCC7)   </a></li>   
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide17_stat success"></span><a id='slide_017' href="#slide-017"> SNOMED code  </a></li>   
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide18_stat success"></span><a id='slide_018' href="#slide-018"> In-situ  </a></li>   
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide19_stat success"></span><a id='slide_019' href="#slide-019"> Inavsive </a></li>   

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
                        <li class="list-inline-item"><a href="#slide-1" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-2" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-3" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-4" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-5" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-6" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-7" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-8" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-9" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-10" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-11" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-12" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-13" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-14" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-15" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-16" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-17" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-18" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-19" class="circle_carousel"></a></li>

                    </ul>
                </div>

                <div class="row surgical_specimen_selection  ">
                    <div class="col-md-12 card">
                        <div class="card-body">
                            <div class="slides">

                                <div id="slide-01">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> histological_calcification text-center ">
                                        <div class="col-md-12  text-center">
                                            <h2>Site</h2>
                                            <hr>

                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                <input type="number" min="0" id="site" class="form-control input-lg" name="site" value="<?php echo $btn_label == 'Update' && $get_record[0]['site'] != '' ? $get_record[0]['site'] : '' ?>" aria-describedby="basic-addon2">

                                            </div>
                                            <span class="btn btn-primary btn-right cus_btn" id="site_btn">Next</span>
                                        </div>
                                    </div>
                                    <a href="javascript:;" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-2" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>


                                <div id="slide-02">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Specimen type</h2>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioSpecimenType1" name="specimen_type" value="excision biopsy" <?php echo $btn_label == 'Update' && $get_record[0]['specimen_type'] == 'excision biopsy' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioSpecimenType1">excision biopsy</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioSpecimenType2" name="specimen_type" value="incision biopsy" <?php echo $btn_label == 'Update' && $get_record[0]['specimen_type'] == 'incision biospsy' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioSpecimenType2">incision (diagnostic) biopsy</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioSpecimenType3" name="specimen_type" value="punch biopsy" <?php echo $btn_label == 'Update' && $get_record[0]['specimen_type'] == 'punch biopsy' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioSpecimenType3">punch biopsy</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioSpecimenType4" name="specimen_type" value="shave biopsy" <?php echo $btn_label == 'Update' && $get_record[0]['specimen_type'] == 'shave biopsy' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioSpecimenType4">shave biopsy</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioSpecimenType5" name="specimen_type" value="curettage" <?php echo $btn_label == 'Update' && $get_record[0]['specimen_type'] == 'curettage' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioSpecimenType5">curettage</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioSpecimenType6" name="specimen_type" value="not specified" <?php echo $btn_label == 'Update' && $get_record[0]['specimen_type'] == 'not specified' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioSpecimenType6">not specified</label></span>
                                        </div>

                                    </div>
                                    <a href="#slide-01" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-3" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>


                                <div id="slide-03">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Macroscopic ulceration</h2>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioMacroscopic_ulceration1" name="macroscopic_ulceration" value="no" <?php echo $btn_label == 'Update' && $get_record[0]['macroscopic_ulceration'] == 'no' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioMacroscopic_ulceration1">no</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioMacroscopic_ulceration2" name="macroscopic_ulceration" value="yes" <?php echo $btn_label == 'Update' && $get_record[0]['macroscopic_ulceration'] == 'yes' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioMacroscopic_ulceration2">yes</label></span>
                                        </div>

                                    </div>
                                    <a href="#slide-02" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-4" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>


                                <div id="slide-04">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Photo taken</h2>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioPhoto_taken1" name="Photo_taken" value="no" <?php echo $btn_label == 'Update' && $get_record[0]['Photo_taken'] == 'no' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioPhoto_taken1">no</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioPhoto_taken2" name="Photo_taken" value="yes" <?php echo $btn_label == 'Update' && $get_record[0]['Photo_taken'] == 'yes' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioPhoto_taken2">yes</label></span>
                                        </div>

                                    </div>
                                    <a href="#slide-03" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-5" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>


                                <div id="slide-05">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Histological type</h2>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioHistological_type1" name="Histological_type" value="lentigo" <?php echo $btn_label == 'Update' && $get_record[0]['Histological_type'] == 'lentigo' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioHistological_type1">lentigo</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioHistological_type2" name="Histological_type" value="maligna" <?php echo $btn_label == 'Update' && $get_record[0]['Histological_type'] == 'maligna' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioHistological_type2">maligna</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioHistological_type3" name="Histological_type" value="superficial" <?php echo $btn_label == 'Update' && $get_record[0]['Histological_type'] == 'superficial' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioHistological_type3">superficial</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioHistological_type4" name="Histological_type" value="spreading" <?php echo $btn_label == 'Update' && $get_record[0]['Histological_type'] == 'spreading' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioHistological_type4">spreading</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioHistological_type5" name="Histological_type" value="acral" <?php echo $btn_label == 'Update' && $get_record[0]['Histological_type'] == 'acral' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioHistological_type5">acral</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioHistological_type6" name="Histological_type" value="lentiginous" <?php echo $btn_label == 'Update' && $get_record[0]['Histological_type'] == 'lentiginous' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioHistological_type6">lentiginous</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioHistological_type7" name="Histological_type" value="nodular" <?php echo $btn_label == 'Update' && $get_record[0]['Histological_type'] == 'nodular' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioHistological_type7">nodular</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioHistological_type8" name="Histological_type" value="desmoplastic" <?php echo $btn_label == 'Update' && $get_record[0]['Histological_type'] == 'desmoplastic' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioHistological_type8">desmoplastic</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioHistological_type9" name="Histological_type" value="unclassified" <?php echo $btn_label == 'Update' && $get_record[0]['Histological_type'] == 'unclassified' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioHistological_type9">unclassified</label></span>
                                        </div>


                                    </div>
                                    <a href="#slide-04" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-6" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>


                                <div id="slide-06">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Growth phase (invasion)</h2>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioGrowth_phase1" name="Growth_phase" value="radial" <?php echo $btn_label == 'Update' && $get_record[0]['Growth_phase'] == 'radial' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioGrowth_phase1">radial</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioGrowth_phase2" name="Growth_phase" value="vertical" <?php echo $btn_label == 'Update' && $get_record[0]['Growth_phase'] == 'vertical' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioGrowth_phase2">vertical growth phase (in situ microinvasive invasive)</label></span>
                                        </div>

                                    </div>
                                    <a href="#slide-05" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-7" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>


                                <div id="slide-07">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Growth phase (invasion)</h2>
                                            <h3>Breslow's depth</h3>
                                            <hr>
                                        </div>

                                        <div class="col-md-12">                                            
                                                <input type="number" min="0" id="breslow_depth" class="form-control input-lg" name="breslow_depth" value="<?php echo $btn_label == 'Update' && $get_record[0]['breslow_depth'] != '' ? $get_record[0]['breslow_depth'] : '' ?>" aria-describedby="basic-addon2"> <h5>mm</h5>
                                        </div>
                                       
                                        <div class="col-md-12  text-center">
                                            <h3>Breslow's depth of scar (if complete regression)</h3>
                                            <hr>
                                        </div>

                                        <div class="col-md-12">
                                            <input type="number" min="0" id="breslow_depth_scar" class="form-control input-lg" name="breslow_depth_scar" value="<?php echo $btn_label == 'Update' && $get_record[0]['breslow_depth_scar'] != '' ? $get_record[0]['breslow_depth_scar'] : '' ?>" aria-describedby="basic-addon2"> <h5>mm</h5>
                                        </div>
                                        
                                        <div class="col-md-12  text-center">
                                            <h3>Clark level</h3>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioclark_level1" name="clark_level" value="II" <?php echo $btn_label == 'Update' && $get_record[0]['clark_level'] == 'II' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioclark_level1">II (papillary dermis)</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioclark_level2" name="clark_level" value="III" <?php echo $btn_label == 'Update' && $get_record[0]['clark_level'] == 'III' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioclark_level2">III (fills/expands pap. dermis)</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioclark_level3" name="clark_level" value="IV" <?php echo $btn_label == 'Update' && $get_record[0]['clark_level'] == 'IV' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioclark_level3">IV (reticular dermis)</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioclark_level4" name="clark_level" value="V" <?php echo $btn_label == 'Update' && $get_record[0]['clark_level'] == 'V' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioclark_level4">V (subcutis)</label></span>
                                        </div>
                                        
                                        <div class="col-md-12  text-center">
                                            <h3>Ulceration</h3>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioUlceration1" name="Ulceration" value="no" <?php echo $btn_label == 'Update' && $get_record[0]['Ulceration'] == 'no' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioUlceration1">no</label></span>
                                        </div>
 
                                        <div class="col-md-4">
                                            <input type="radio" id="radioUlceration2" name="Ulceration" value="not assessable" <?php echo $btn_label == 'Update' && $get_record[0]['Ulceration'] == 'not assessable' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioUlceration2">not assessable</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioUlceration3" name="Ulceration" value="yes" <?php echo $btn_label == 'Update' && $get_record[0]['Ulceration'] == 'yes' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioUlceration3">yes</label></span>
                                        </div>                                        
                                        
                                        <div class="col-md-12  text-center">
                                            <h3>Mitoses</h3>
                                            <hr>
                                        </div>

                                         <div class="col-md-12">                                            
                                                <input type="number" min="0" id="Mitoses" class="form-control input-lg" name="Mitoses" value="<?php echo $btn_label == 'Update' && $get_record[0]['Mitoses'] != '' ? $get_record[0]['breslow_depth'] : '' ?>" aria-describedby="basic-addon2"> <h5>/mm<sup>2</sup></h5>
                                            <span class="btn btn-primary btn-right cus_btn" id="invasive_btn">Next</span>
                                        </div>

                                        

                                    </div>
                                    <a href="#slide-06" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-8" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>


                                <div id="slide-08">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Solar damage</h2>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioSolar_damage1" name="Solar_damage" value="absent" <?php echo $btn_label == 'Update' && $get_record[0]['Solar_damage'] == 'absent' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioSolar_damage1">absent</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioSolar_damage2" name="Solar_damage" value="mild" <?php echo $btn_label == 'Update' && $get_record[0]['Solar_damage'] == 'mild' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioSolar_damage2">mild</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioSolar_damage3" name="Solar_damage" value="moderate" <?php echo $btn_label == 'Update' && $get_record[0]['Solar_damage'] == 'moderate' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioSolar_damage3">moderate</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioSolar_damage4" name="Solar_damage" value="severe" <?php echo $btn_label == 'Update' && $get_record[0]['Solar_damage'] == 'severe' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioSolar_damage4">severe</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioSolar_damage5" name="Solar_damage" value="not assessable" <?php echo $btn_label == 'Update' && $get_record[0]['Solar_damage'] == 'not assessable' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioSolar_damage5">not assessable</label></span>
                                        </div>


                                    </div>
                                    <a href="#slide-07" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-9" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>


                                <div id="slide-09">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Host response</h2>
                                            <h3>tumour infiltrating lymphocytes</h3>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioStumour_infiltrating1" name="tumour_infiltrating_" value="absent" <?php echo $btn_label == 'Update' && $get_record[0]['tumour_infiltrating_'] == 'absent' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioStumour_infiltrating1">absent</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioStumour_infiltrating2" name="tumour_infiltrating_" value="brisk" <?php echo $btn_label == 'Update' && $get_record[0]['tumour_infiltrating_'] == 'brisk' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioStumour_infiltrating2">brisk</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioStumour_infiltrating3" name="tumour_infiltrating_" value="non brisk" <?php echo $btn_label == 'Update' && $get_record[0]['tumour_infiltrating_'] == 'non brisk' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioStumour_infiltrating3">non brisk</label></span>
                                        </div>
                                        
                                        <div class="col-md-12  text-center">
                                            <h3>regression</h3>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioregression1" name="regression" value="absent" <?php echo $btn_label == 'Update' && $get_record[0]['regression'] == 'absent' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioregression1">absent</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioregression1" name="regression" value="partial" <?php echo $btn_label == 'Update' && $get_record[0]['regression'] == 'partial' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioregression1">partial</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioregression1" name="regression" value="complete" <?php echo $btn_label == 'Update' && $get_record[0]['regression'] == 'complete' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioregression1">complete</label></span>
                                            
                                            <span class="btn btn-primary btn-right cus_btn" id="host_btn">Next</span>
                                        </div>

                                        


                                    </div>
                                    <a href="#slide-08" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-10" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>


                                <div id="slide-010">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Locoregional spread</h2>
                                            <h3>neurotropism</h3>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioneurotropism1" name="neurotropism" value="absent" <?php echo $btn_label == 'Update' && $get_record[0]['neurotropism'] == 'absent' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioneurotropism1">absent</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioneurotropism2" name="neurotropism" value="yes" <?php echo $btn_label == 'Update' && $get_record[0]['neurotropism'] == 'yes' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioneurotropism2">yes</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioneurotropism3" name="neurotropism" value="uncertain" <?php echo $btn_label == 'Update' && $get_record[0]['neurotropism'] == 'uncertain' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioneurotropism3">uncertain</label></span>
                                        </div>
                                      
                                        <div class="col-md-12  text-center">
                                            <h3>lymphatic vessel invasion</h3>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiolymphatic_vessel_invasion1" name="lymphatic_vessel_invasion" value="absent" <?php echo $btn_label == 'Update' && $get_record[0]['lymphatic_vessel_invasion'] == 'absent' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiolymphatic_vessel_invasion1">absent</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiolymphatic_vessel_invasion2" name="lymphatic_vessel_invasion" value="yes" <?php echo $btn_label == 'Update' && $get_record[0]['lymphatic_vessel_invasion'] == 'yes' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiolymphatic_vessel_invasion2">yes</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiolymphatic_vessel_invasion3" name="lymphatic_vessel_invasion" value="uncertain" <?php echo $btn_label == 'Update' && $get_record[0]['lymphatic_vessel_invasion'] == 'uncertain' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiolymphatic_vessel_invasion3">uncertain</label></span>
                                        </div>
                                      
                                        <div class="col-md-12  text-center">
                                            <h3>blood vessel invasion</h3>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioblood_vessel_invasion1" name="blood_vessel_invasion" value="absent" <?php echo $btn_label == 'Update' && $get_record[0]['blood_vessel_invasion'] == 'absent' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioblood_vessel_invasion1">absent</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioblood_vessel_invasion2" name="blood_vessel_invasion" value="yes" <?php echo $btn_label == 'Update' && $get_record[0]['blood_vessel_invasion'] == 'yes' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioblood_vessel_invasion2">yes</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioblood_vessel_invasion3" name="blood_vessel_invasion" value="uncertain" <?php echo $btn_label == 'Update' && $get_record[0]['blood_vessel_invasion'] == 'uncertain' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioblood_vessel_invasion3">uncertain</label></span>
                                        </div>
                                      
                                        <div class="col-md-12  text-center">
                                            <h3>miscrosetellite</h3>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiomiscrosetellite1" name="miscrosetellite" value="absent" <?php echo $btn_label == 'Update' && $get_record[0]['miscrosetellite'] == 'absent' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiomiscrosetellite1">absent</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiomiscrosetellite2" name="miscrosetellite" value="yes" <?php echo $btn_label == 'Update' && $get_record[0]['miscrosetellite'] == 'yes' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiomiscrosetellite2">yes</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiomiscrosetellite3" name="miscrosetellite" value="uncertain" <?php echo $btn_label == 'Update' && $get_record[0]['miscrosetellite'] == 'uncertain' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiomiscrosetellite3">uncertain</label></span>
                                        </div>
                                      
                                        <div class="col-md-12  text-center">
                                            <h3>setellite</h3>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiosetellite1" name="setellite" value="absent" <?php echo $btn_label == 'Update' && $get_record[0]['setellite'] == 'absent' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiosetellite1">absent</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiosetellite2" name="setellite" value="yes" <?php echo $btn_label == 'Update' && $get_record[0]['setellite'] == 'yes' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiosetellite2">yes</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiosetellite3" name="setellite" value="uncertain" <?php echo $btn_label == 'Update' && $get_record[0]['setellite'] == 'uncertain' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiosetellite3">uncertain</label></span>
                                        </div>
                                        
                                        <div class="col-md-12  text-center">
                                            <h3>in transit metastasis</h3>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioin_transit_metastasis1" name="in_transit_metastasis" value="absent" <?php echo $btn_label == 'Update' && $get_record[0]['in_transit_metastasis'] == 'absent' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioin_transit_metastasise1">absent</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioin_transit_metastasis2" name="in_transit_metastasis" value="yes" <?php echo $btn_label == 'Update' && $get_record[0]['in_transit_metastasis'] == 'yes' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioin_transit_metastasis2">yes</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioin_transit_metastasis3" name="in_transit_metastasis" value="uncertain" <?php echo $btn_label == 'Update' && $get_record[0]['in_transit_metastasis'] == 'uncertain' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioin_transit_metastasis3">uncertain</label></span>
                                            <span class="btn btn-primary btn-right cus_btn" id="locoregional_btn">Next</span>
                                        </div>

                                        
                                        

                                    </div>
                                    <a href="#slide-09" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-11" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>


                                <div id="slide-011">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Excision margnis</h2>
                                            <h3>epidermal in situ component</h3>
                                            <hr>
                                        </div>

                                        <div class="col-md-12">                                            
                                                <input type="number" min="0" id="epi_insitu" class="form-control input-lg" name="epi_insitu" value="<?php echo $btn_label == 'Update' && $get_record[0]['epi_insitu'] != '' ? $get_record[0]['epi_insitu'] : '' ?>" aria-describedby="basic-addon2"> <h5>mm</h5>
                                        </div>                                     
                                       
                                        <div class="col-md-12  text-center">
                                            <h3>epidermal invasive component</h3>
                                            <hr>
                                        </div>

                                        <div class="col-md-12">                                            
                                                <input type="number" min="0" id="epi_invasive" class="form-control input-lg" name="epi_invasive" value="<?php echo $btn_label == 'Update' && $get_record[0]['epi_invasive'] != '' ? $get_record[0]['epi_invasive'] : '' ?>" aria-describedby="basic-addon2"> <h5>mm</h5>
                                        </div>                                     
                                        
                                        <div class="col-md-12  text-center">
                                            <h3>deep</h3>
                                            <hr>
                                        </div>

                                         <div class="col-md-12">                                            
                                                <input type="number" min="0" id="deep" class="form-control input-lg" name="deep" value="<?php echo $btn_label == 'Update' && $get_record[0]['deep'] != '' ? $get_record[0]['deep'] : '' ?>" aria-describedby="basic-addon2"> <h5>mm</h5>
                                            <span class="btn btn-primary btn-right cus_btn" id="excision_btn">Next</span>
                                        </div>

                                        

                                    </div>
                                    <a href="#slide-010" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-12" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>


                                <div id="slide-012">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Co-existing lesion</h2>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiolesion1" name="lesion" value="no" <?php echo $btn_label == 'Update' && $get_record[0]['lesion'] == 'no' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiolesion1">no</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiolesion2" name="lesion" value="uncertain" <?php echo $btn_label == 'Update' && $get_record[0]['lesion'] == 'uncertain' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiolesion2">uncertain</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiolesion3" name="lesion" value="benign" <?php echo $btn_label == 'Update' && $get_record[0]['lesion'] == 'benign' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiolesion3">benign</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiolesion4" name="lesion" value="dysplastic" <?php echo $btn_label == 'Update' && $get_record[0]['lesion'] == 'dysplastic' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiolesion4">dysplastic</label></span>
                                        </div>

                                        


                                    </div>
                                    <a href="#slide-011" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-13" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>


                                <div id="slide-013">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Special techniques</h2>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiospecial_techniques1" name="special_techniques" value="not done" <?php echo $btn_label == 'Update' && $get_record[0]['special_techniques'] == 'not done' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiospecial_techniques1">not done</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiospecial_techniques2" name="special_techniques" value="levels IHC" <?php echo $btn_label == 'Update' && $get_record[0]['special_techniques'] == 'levels IHC' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiospecial_techniques2">levels IHC</label></span>
                                        </div>

                                        


                                    </div>
                                    <a href="#slide-012" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-14" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-014">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Biomarkers</h2>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiobiomarkers1" name="biomarkers" value="BRAF" <?php echo $btn_label == 'Update' && $get_record[0]['biomarkers'] == 'BRAF' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiobiomarkers1">BRAF</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiobiomarkers2" name="biomarkers" value="NRAS" <?php echo $btn_label == 'Update' && $get_record[0]['biomarkers'] == 'NRAS' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiobiomarkers2">NRAS</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiobiomarkers3" name="biomarkers" value="cKIT" <?php echo $btn_label == 'Update' && $get_record[0]['biomarkers'] == 'cKIT' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiobiomarkers3">cKIT</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiobiomarkers4" name="biomarkers" value="PD-L1" <?php echo $btn_label == 'Update' && $get_record[0]['biomarkers'] == 'PD-L1' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiobiomarkers4">PD-L1</label></span>
                                        </div>

                                        


                                    </div>
                                    <a href="#slide-013" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-15" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                
                                

                                <div id="slide-015">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> histological_calcification text-center ">
                                        <div class="col-md-12  text-center">
                                            <h2>Additional comments</h2>
                                            <hr>

                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                <input type="ttext" id="additional_comments" class="form-control input-lg" name="additional_comments" value="<?php echo $btn_label == 'Update' && $get_record[0]['additional_comments'] != '' ? $get_record[0]['additional_comments'] : '' ?>" aria-describedby="basic-addon2">

                                            </div>
                                            <span class="btn btn-primary btn-right cus_btn" id="additional_comments_btn">Next</span>
                                        </div>
                                    </div>
                                    <a href="#slide-014" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-16" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                

                                <div id="slide-016">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>TNM staging (AJCC7)</h2>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiotnm2" name="tnm" value="pT1a" <?php echo $btn_label == 'Update' && $get_record[0]['tnm'] == 'pT1a' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiotnm2">pT1a</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiotnm3" name="tnm" value="pT1b" <?php echo $btn_label == 'Update' && $get_record[0]['tnm'] == 'pT1b' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiotnm3">pT1b</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiotnm4" name="tnm" value="pT2a" <?php echo $btn_label == 'Update' && $get_record[0]['tnm'] == 'pT2a' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiotnm4">pT2a</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radiotnm5" name="tnm" value="pT3a/b" <?php echo $btn_label == 'Update' && $get_record[0]['tnm'] == 'pT3a/b' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiotnm5">pT3a/b</label></span>
                                        </div>


                                        <div class="col-md-4">
                                            <input type="radio" id="radiotnm1" name="tnm" value="pT4a/b" <?php echo $btn_label == 'Update' && $get_record[0]['tnm'] == 'pT4a/b' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radiotnm1">pT4a/b</label></span>
                                        </div> 
                                        


                                    </div>
                                    <a href="#slide-015" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-17" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                

                                <div id="slide-017">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>SNOMED code</h2>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radio_snomed1" name="snomed" value="T01000M" <?php echo $btn_label == 'Update' && $get_record[0]['snomed'] == 'T01000M' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radio_snomed1">T01000M</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radio_snomed2" name="snomed" value="Primary cutaneous in-situ malignant melanoma NOS M87202" <?php echo $btn_label == 'Update' && $get_record[0]['snomed'] == 'Primary cutaneous in-situ malignant melanoma NOS M87202' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radio_snomed2">Primary cutaneous in-situ malignant melanoma NOS M87202</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radio_snomed3" name="snomed" value="Primary cutaneous in-situ malignant melanoma NOS M87203" <?php echo $btn_label == 'Update' && $get_record[0]['snomed'] == 'Primary cutaneous in-situ malignant melanoma NOS M87203' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radio_snomed3">Primary cutaneous in-situ malignant melanoma NOS M87203</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radio_snomed4" name="snomed" value="Metastatic cutaneous malignant melanoma NOS M87206" <?php echo $btn_label == 'Update' && $get_record[0]['snomed'] == 'Metastatic cutaneous malignant melanoma NOS M87206' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radio_snomed4">Metastatic cutaneous malignant melanoma NOS M87206</label></span>
                                        </div>
                                        


                                    </div>
                                    <a href="#slide-016" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-18" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                

                                <div id="slide-018">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>In-situ</h2>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radio_insitu1" name="insitu" value="Lentigo maligna M87422" <?php echo $btn_label == 'Update' && $get_record[0]['insitu'] == 'Lentigo maligna M87422' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radio_insitu1">Lentigo maligna M87422</label></span>
                                        </div>
                                        


                                    </div>
                                    <a href="#slide-017" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-19" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                

                                <div id="slide-019">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Invasive</h2>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radio__invasive1" name="_invasive" value="Nodular M87213" <?php echo $btn_label == 'Update' && $get_record[0]['_invasive'] == 'Nodular M87213' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radio__invasive1">Nodular M87213</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radio__invasive2" name="_invasive" value="Lentigo maligna M87423" <?php echo $btn_label == 'Update' && $get_record[0]['_invasive'] == 'Lentigo maligna M87423' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radio__invasive2">Lentigo maligna M87423</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radio__invasive3" name="_invasive" value="Superficial spreading M87433" <?php echo $btn_label == 'Update' && $get_record[0]['_invasive'] == 'Superficial spreading M87433' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radio__invasive3">Superficial spreading M87433</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radio__invasive4" name="_invasive" value="Acral lentiginous M87443" <?php echo $btn_label == 'Update' && $get_record[0]['_invasive'] == 'Acral lentiginous M87443' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radio__invasive4">Acral lentiginous M87443</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radio__invasive5" name="_invasive" value="Desmoplastic M87453" <?php echo $btn_label == 'Update' && $get_record[0]['_invasive'] == 'Desmoplastic M87453' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radio__invasive5">Desmoplastic M87453</label></span>
                                        </div>
                                        


                                    </div>
                                    <a href="#slide-018" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-19" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                        
                                </div>


                            </div>
                            <?php if ($this->uri->segment(4) != '') { ?>
                                <div class="row pull-right" style="padding-top:30px">
                                    <input type="button" id="cmm_submit" class="btn btn-lg btn-primary" value="<?php echo $btn_label ?> Record">
                                </div>
                            <?php } ?>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-3"  id="section-to-print" style="margin-top:15px;">

                <div class="card col-md-12">
                    <div class="car-body pt-15">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <?php if ($this->uri->segment(4) == '') { ?>
                                    <h4>Info of Record (This is sample)</h4>
                                <?php } else {
                                    ?><fieldset>

                                        <ul class="donate-now">
                                            <?php
                                            $sqCount = 1;
                                            foreach ($specimen_query as $sq) {
                                                ?>    
                                                <li>
                                                    <input type="radio" id="patient_specimen<?= $sqCount ?>" class="patient_specimen" name="patient_specimen" value="<?= $sqCount ?>" <?= $get_record[0]['patient_specimen'] == $sqCount ? 'checked="true"' : $this->uri->segment(13) == $sqCount ? 'checked="true"' : '' ?>  required>
                                                    <label for="patient_specimen<?= $sqCount ?>">
                                                        <?= (in_array($sqCount, explode(',', $dataset_cmm_specimen))) ? '<span style="color: #12ff18;font-size: 2em;">&#8226;</span>' : '' ?>Specimen <?= $sqCount ?>
                                                    </label>
                                                </li>
                                                <?php
                                                $sqCount++;
                                            }
                                            ?>  
                                        </ul>


                                    </fieldset>
                                <?php } ?>
                                <hr>
                                <div class="sidebar_title">CMM - Dataset</div>
                            </div>


                            <?php
                            if ($btn_label == 'Update') {
                                if ($html_response == '') {
                                    ?>
                                    <div id="cmm_answers">
                                        <div class="col-sm-12">
                                            <span class="slide1_ans"></span>
                                            <span class="slide2_ans"></span>
                                            <span class="slide3_ans"></span>
                                            <span class="slide4_ans"></span>
                                            <span class="slide5_ans"></span>
                                            <span class="slide6_ans"></span>
                                            <span class="slide7_ans"></span>
                                            <span class="slide8_ans"></span>
                                            <span class="slide9_ans"></span>
                                            <span class="slide10_ans"></span>
                                            <span class="slide11_ans"></span>
                                            <span class="slide12_ans"></span>
                                            <span class="slide13_ans"></span>
                                            <span class="slide14_ans"></span>
                                            <span class="slide15_ans"></span>
                                            <span class="slide16_ans"></span>
                                            <span class="slide17_ans"></span>
                                            <span class="slide18_ans"></span>
                                            <span class="slide19_ans"></span>
                                        </div>                                    
                                    </div>
                                    <?php
                                } else {
                                    echo $html_response;
                                }
                            } else {
                                ?>
                                <div id="cmm_answers">

                                    <div class="col-sm-12">
                                        <span class="slide1_ans"></span>
                                        <span class="slide2_ans"></span>
                                        <span class="slide3_ans"></span>
                                        <span class="slide4_ans"></span>
                                        <span class="slide5_ans"></span>
                                        <span class="slide6_ans"></span>
                                        <span class="slide7_ans"></span>
                                        <span class="slide8_ans"></span>
                                        <span class="slide9_ans"></span>
                                        <span class="slide10_ans"></span>
                                        <span class="slide11_ans"></span>
                                        <span class="slide12_ans"></span>
                                        <span class="slide13_ans"></span>
                                        <span class="slide14_ans"></span>
                                        <span class="slide15_ans"></span>
                                        <span class="slide16_ans"></span>
                                        <span class="slide17_ans"></span>
                                        <span class="slide18_ans"></span>
                                        <span class="slide19_ans"></span>
                                    </div> 
                                </div>
                            <?php } ?>
                        </div>

                    </div>
                </div>

            </div>



        </div>

    </section>


    <a id='slide_01' href="#slide-1">  </a>
    <a id='slide_02' href="#slide-2">  </a>
    <a id='slide_03' href="#slide-3">  </a>
    <a id='slide_04' href="#slide-4">  </a>
    <a id='slide_05' href="#slide-5">  </a>
    <a id='slide_05' href="#slide-6">  </a>
    <a id='slide_07' href="#slide-7">  </a>
    <a id='slide_08' href="#slide-8">  </a>
    <a id='slide_09' href="#slide-9">  </a>
    <a id='slide_010' href="#slide-10">  </a>
    <a id='slide_011' href="#slide-11">  </a>
    <a id='slide_012' href="#slide-12">  </a>
    <a id='slide_013' href="#slide-13">  </a>
    <a id='slide_014' href="#slide-14">  </a>
    <a id='slide_015' href="#slide-15">  </a>
    <a id='slide_016' href="#slide-16">  </a>
    <a id='slide_017' href="#slide-17">  </a>
    <a id='slide_018' href="#slide-18">  </a>
    <a id='slide_019' href="#slide-19">  </a>

    <?php
    if ($this->uri->segment(4) != '') {
        echo "</form>";
    }
    ?>
