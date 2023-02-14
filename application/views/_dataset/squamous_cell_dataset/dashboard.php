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
//$get_record = get_squamous_cell_dataset_record();
$side_menu_state = " hidden ";
$btn_label = "Save";
$dataset_record_id = "";
$html_response = "";

if ($this->uri->segment(4) != '') {
//    $get_record = $dataset_ssc = get_ssc_dataset_record($this->uri->segment(4), $this->uri->segment(13));
//    $dataset_ssc_specimen = get_ssc_dataset_specimen($this->uri->segment(4));
    if (!empty($get_record)) {
//        _print_r($get_record);
        $side_menu_state = "";
        $btn_label = "Update";
        $dataset_record_id = $get_record[0]['dataset_record_id'];
        $html_response = $get_record[0]['ssc_response_html'];
        $get_record[0] = json_decode($get_record[0]['ssc_data'], true);
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
    <form id='ssc_form' action="<?php echo site_url('_dataset/squamous_cell_dataset/save_record') ?>" method="post" >
        <input type="hidden" value="<?php echo $this->uri->segment(4) ?>" name="record_id">
        <input type="hidden" value="<?php echo $dataset_record_id ?>" name="dataset_record_id">
        <input type="hidden" id="ssc_respons_html" value='<?= $html_response ?>' name="ssc_respons_html">
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
                    <input type="hidden" name="dataset_id" value="21">
                    <input type="hidden" name="dataset_type" value="Squamous Cell">
                    <div class="col-sm-12">
                        <input type="hidden" name="dataset_title" value="Squamous Cell">
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-right float-right ml-auto">
                <?php if ($this->uri->segment(4) != '') { ?>
                    <?php if ($dataset_ssc[0]['dataset_record_id'] != '') { ?>

                        <a onclick="return confirm_delete();" href="<?php echo site_url('_dataset/squamous_cell_dataset/removeDatasetbyID/' . $dataset_ssc[0]['dataset_record_id'] . '/' . $dataset_ssc[0]['record_id']) ?>" class="btn btn-danger btn-rounded"><i class="fa fa-trash"></i> </a>

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
        <?php //_print_r($dataset_ssc); ?>
    <!--<h3 class="text-center"><?php echo $this->uri->segment(4) == '' ? '' : 'Record# ' . $this->uri->segment(4) ?></h3>-->
        <h5 class="text-center text-muted">
            <small>
                <strong> Created at: </strong> <?= $dataset_ssc[0]['created_at'] ?>
                <strong> Updated at: </strong> <?= $dataset_ssc[0]['modified_at'] ?>
            </small>
        </h5>

        <div class="row">

            <div class="col-md-3">
                <div>
                    <div class="col-sm-12 form-group">
                        <h3><i style="background: #00c5fb;color: white;padding: 10px;border-radius: 30px;font-size: 35px;" class="ti-harddrive" title="Datasets"></i> Squamous Cell Carcinoma</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="faq-card">
                                <div class="card mb-1">
                                    <div id="">
                                        <div class="card-body">
                                            <ul class="list-unstyled">

                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide1_stat success"></span><a id='slide_01' href="#slide-01"> Site </a></li>   

                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide2_stat success"></span><a id='slide_02' href="#slide-2"> Specimen type </a></li>

                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide13_stat success"></span><a id='slide_013' href="#slide-13"> Subtype </a></li>
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide3_stat success"></span><a id='slide_03' href="#slide-3"> Differentiation </a></li>
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide4_stat success"></span><a id='slide_04' href="#slide-4"> Perineurial invasion </a></li>
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide5_stat success"></span><a id='slide_05' href="#slide-5"> Lymphovascular invasion </a></li>
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide6_stat success"></span><a id='slide_06' href="#slide-6"> Maximum tumour diameter </a></li>
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide7_stat success"></span><a id='slide_07' href="#slide-7"> Depth </a></li>
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide8_stat success"></span><a id='slide_08' href="#slide-8"> Clark level of invasion </a></li>
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide9_stat success"></span><a id='slide_09' href="#slide-9"> Distance from margins </a></li>
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide10_stat success"></span><a id='slide_010' href="#slide-10"> Additional comments </a></li>
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide11_stat success"></span><a id='slide_011' href="#slide-11"> Pathological risk status of skin cancer MDT </a></li>
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide12_stat success"></span><a id='slide_012' href="#slide-12"> TNM pathological (p) stage (AJCC8) </a></li>
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide14_stat success"></span><a id='slide_014' href="#slide-14"> Summary </a></li>

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
                        <li class="list-inline-item"><a href="#slide-13" class="circle_carousel"></a></li>
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
                        <li class="list-inline-item"><a href="#slide-14" class="circle_carousel"></a></li>
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
                                                <input type="text" id="site" class="form-control input-lg" name="site" value="<?php echo $btn_label == 'Update' && $get_record[0]['site'] != '' ? $get_record[0]['site'] : '' ?>" aria-describedby="basic-addon2">

                                            </div>
                                            <span class="btn btn-primary btn-right cus_btn" id="site_btn">Next</span>
                                        </div>
                                    </div>
                                    <a href="javascript:;" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-2" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>


                                <div id="slide-2">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Specimen type</h2>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioSpecimenType" name="specimen_type" value="excision biopsy" <?php echo $btn_label == 'Update' && $get_record[0]['specimen_type'] == 'excision biopsy' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioSpecimenType">excision biopsy</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioSpecimenType" name="specimen_type" value="incisional biopsy" <?php echo $btn_label == 'Update' && $get_record[0]['specimen_type'] == 'incisional biopsy' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioSpecimenType">incisional biopsy</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioSpecimenType" name="specimen_type" value="punch biopsy" <?php echo $btn_label == 'Update' && $get_record[0]['specimen_type'] == 'punch biopsy' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioSpecimenType">punch biopsy</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioSpecimenType" name="specimen_type" value="shave biopsy" <?php echo $btn_label == 'Update' && $get_record[0]['specimen_type'] == 'shave biopsy' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioSpecimenType">shave biopsy</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioSpecimenType" name="specimen_type" value="curettage" <?php echo $btn_label == 'Update' && $get_record[0]['specimen_type'] == 'curettage' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioSpecimenType">curettage</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioSpecimenType" name="specimen_type" value="not specified" <?php echo $btn_label == 'Update' && $get_record[0]['specimen_type'] == 'not specified' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioSpecimenType">not specified</label></span>
                                        </div>

                                    </div>
                                    <a href="#slide-01" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-3" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-13">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Subtype</h2>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioSubtype" name="subtype" value="NST" <?php echo $btn_label == 'Update' && $get_record[0]['subtype'] == 'NST' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioSubtype">NST</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioSubtype" name="subtype" value="SSC" <?php echo $btn_label == 'Update' && $get_record[0]['subtype'] == 'SSC' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioSubtype">SSC</label></span>
                                        </div>

                                    </div>
                                    <a href="#slide-02" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-4" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-3">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Differentiation</h2>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioDifferentiation" name="differentiation" value="well" <?php echo $btn_label == 'Update' && $get_record[0]['differentiation'] == 'well' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioDifferentiation">well</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioDifferentiation" name="differentiation" value="moderately" <?php echo $btn_label == 'Update' && $get_record[0]['differentiation'] == 'moderately' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioDifferentiation">moderately</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioDifferentiation" name="differentiation" value="poorly" <?php echo $btn_label == 'Update' && $get_record[0]['differentiation'] == 'poorly' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioDifferentiation">poorly</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioDifferentiation" name="differentiation" value="differentiated" <?php echo $btn_label == 'Update' && $get_record[0]['differentiation'] == 'differentiated' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioDifferentiation">differentiated</label></span>
                                        </div>

                                    </div>
                                    <a href="#slide-013" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-4" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-4">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Perineurial invasion</h2>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioPerineurialInvasion" name="perineurialInvasion" value="yes" <?php echo $btn_label == 'Update' && $get_record[0]['perineurialInvasion'] == 'yes' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioPerineurialInvasion">yes</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioPerineurialInvasion" name="perineurialInvasion" value="no" <?php echo $btn_label == 'Update' && $get_record[0]['perineurialInvasion'] == 'no' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioPerineurialInvasion">no</label></span>
                                        </div>

                                    </div>
                                    <a href="#slide-03" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-5" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-5">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Lymphovascular invasion</h2>
                                            <hr>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioLymphovascularInvasion" name="lymphovascularInvasion" value="yes" <?php echo $btn_label == 'Update' && $get_record[0]['lymphovascularInvasion'] == 'yes' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioLymphovascularInvasion">yes</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioLymphovascularInvasion" name="lymphovascularInvasion" value="no" <?php echo $btn_label == 'Update' && $get_record[0]['lymphovascularInvasion'] == 'no' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioLymphovascularInvasion">no</label></span>
                                        </div>

                                    </div>
                                    <a href="#slide-04" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-6" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-6">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Maximum tumour diameter  .mm</h2>
                                            <hr>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                <input type="number" min="0" id="max_diameter" class="form-control input-lg" name="max_diameter" value="<?php echo $btn_label == 'Update' && $get_record[0]['max_diameter'] != '' ? $get_record[0]['max_diameter'] : '' ?>" aria-describedby="basic-addon2">

                                            </div>
                                            <span class="btn btn-primary btn-right cus_btn" id="max_diameter_btn">Next</span>
                                        </div>

                                    </div>
                                    <a href="#slide-05" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-7" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-7">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Depth  .mm</h2>
                                            <hr>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                <input type="number" min="0" id="depth" class="form-control input-lg" name="depth" value="<?php echo $btn_label == 'Update' && $get_record[0]['depth'] != '' ? $get_record[0]['depth'] : '' ?>" aria-describedby="basic-addon2">

                                            </div>
                                            <span class="btn btn-primary btn-right cus_btn" id="depth_btn">Next</span>
                                        </div>

                                    </div>
                                    <a href="#slide-06" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-8" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-8">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Clark level of invasion</h2>
                                            <hr>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                <input type="text" id="clark_level" class="form-control input-lg" name="clark_level" value="<?php echo $btn_label == 'Update' && $get_record[0]['clark_level'] != '' ? $get_record[0]['clark_level'] : '' ?>" aria-describedby="basic-addon2">

                                            </div>
                                            <span class="btn btn-primary btn-right cus_btn" id="clark_level_btn">Next</span>
                                        </div>

                                    </div>
                                    <a href="#slide-07" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-9" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-9">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Distance from Margins</h2>
                                            <hr>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                <h5>Epidermal  .mm</h5>
                                                <input type="number" min="0" id="epidermal" class="form-control input-lg" name="epidermal" value="<?php echo $btn_label == 'Update' && $get_record[0]['epidermal'] != '' ? $get_record[0]['epidermal'] : '' ?>" aria-describedby="basic-addon2">
                                                <h5>Deep  .mm</h5>
                                                <input type="number" min="0" id="deep" class="form-control input-lg" name="deep" value="<?php echo $btn_label == 'Update' && $get_record[0]['deep'] != '' ? $get_record[0]['deep'] : '' ?>" aria-describedby="basic-addon2">

                                            </div>
                                            <span class="btn btn-primary btn-right cus_btn" id="margin_btn">Next</span>
                                        </div>

                                    </div>
                                    <a href="#slide-08" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-10" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-10">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Additional Comments</h2>
                                            <hr>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                <input type="text" id="additionalComments" class="form-control input-lg" name="additionalComments" value="<?php echo $btn_label == 'Update' && $get_record[0]['additionalComments'] != '' ? $get_record[0]['additionalComments'] : '' ?>" aria-describedby="basic-addon2">

                                            </div>
                                            <span class="btn btn-primary btn-right cus_btn" id="additionalComments_btn">Next</span>
                                        </div>

                                    </div>
                                    <a href="#slide-09" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-11" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-11">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Pathology risk status for skin cancer MDT</h2>
                                            <hr>
                                        </div>


                                        <div class="col-md-4">
                                            <input type="radio" id="radioRisk" name="risk" value="low" <?php echo $btn_label == 'Update' && $get_record[0]['risk'] == 'low' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioRisk">low</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioRisk" name="risk" value="high" <?php echo $btn_label == 'Update' && $get_record[0]['risk'] == 'high' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioRisk">high</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioRisk" name="risk" value="risk" <?php echo $btn_label == 'Update' && $get_record[0]['risk'] == 'risk' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioRisk">risk</label></span>
                                        </div>


                                    </div>
                                    <a href="#slide-010" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-12" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-12">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>TNM pathological (p) stage (AJCC8)</h2>
                                            <hr>
                                        </div>


                                        <div class="col-md-4">
                                            <input type="radio" id="radioTNM" name="tnm" value="pT1" <?php echo $btn_label == 'Update' && $get_record[0]['tnm'] == 'pT1' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioTNM">pT1</label></span>
                                        </div>



                                    </div>
                                    <a href="#slide-011" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-14" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-14">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h2>Summary</h2>
                                            <hr>
                                        </div>


                                       
                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                <input type="text" id="summary" class="form-control input-lg" name="summary" value="<?php echo $btn_label == 'Update' && $get_record[0]['summary'] != '' ? $get_record[0]['summary'] : '' ?>" aria-describedby="basic-addon2">

                                            </div>
                                           <?php if ($this->uri->segment(4) != '') { ?>
                                <div class=" text-center" style="padding-top:30px">
                                    <input type="button" id="ssc_submit" class="btn btn-lg btn-primary" value="<?php echo $btn_label ?> Record">
                                </div>
                            <?php } ?>
                                        </div>



                                    </div>
                             
                                </div>


                            </div>
                            <?php if ($this->uri->segment(4) != '') { ?>
                                <div class="row pull-right" style="padding-top:30px">
                                    <input type="button" id="ssc_submit" class="btn btn-lg btn-primary" value="<?php echo $btn_label ?> Record">
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
                                                        <?= (in_array($sqCount, explode(',', $dataset_ssc_specimen))) ? '<span style="color: #12ff18;font-size: 2em;">&#8226;</span>' : '' ?>Specimen <?= $sqCount ?>
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
                                <div class="sidebar_title">SSC - Dataset</div>
                            </div>


                            <?php
                            if ($btn_label == 'Update') {
                                if ($html_response == '') {
                                    ?>
                                    <div id="ssc_answers">
                                        <div class="col-sm-12">
                                            <span class="slide1_ans"></span>
                                            <span class="slide2_ans"></span>
                                            <span class="slide13_ans"></span>
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
                                            <span class="slide14_ans"></span>
                                        </div>                                    
                                    </div>
                                    <?php
                                } else {
                                    echo $html_response;
                                }
                            } else {
                                ?>
                                <div id="ssc_answers">

                                    <div class="col-sm-12">
                                        <span class="slide1_ans"></span>
                                        <span class="slide2_ans"></span>
                                        <span class="slide13_ans"></span>
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
                                        <span class="slide14_ans"></span>
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
    <a id='slide_013' href="#slide-13">  </a>
    <a id='slide_03' href="#slide-3">  </a>
    <a id='slide_04' href="#slide-4">  </a>
    <a id='slide_05' href="#slide-5">  </a>
    <a id='slide_06' href="#slide-6">  </a>
    <a id='slide_07' href="#slide-7">  </a>
    <a id='slide_08' href="#slide-8">  </a>
    <a id='slide_09' href="#slide-9">  </a>
    <a id='slide_010' href="#slide-10">  </a>
    <a id='slide_011' href="#slide-11">  </a>
    <a id='slide_012' href="#slide-12">  </a>
    <a id='slide_014' href="#slide-14">  </a>

    <?php
    if ($this->uri->segment(4) != '') {
        echo "</form>";
    }
    ?>
