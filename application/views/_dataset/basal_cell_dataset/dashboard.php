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
//$get_record = get_basal_cell_dataset_record();
$side_menu_state = " hidden ";
$btn_label = "Save";
$dataset_record_id = "";
$html_response = "";

if ($this->uri->segment(4) != '') {
//    $get_record = $dataset_bcc = get_bcc_dataset_record($this->uri->segment(4), $this->uri->segment(13));
//    $dataset_bcc_specimen = get_bcc_dataset_specimen($this->uri->segment(4));
    if (!empty($get_record)) {
//        _print_r($get_record);
        $side_menu_state = "";
        $btn_label = "Update";
        $dataset_record_id = $get_record[0]['dataset_record_id'];
        $html_response = $get_record[0]['bcc_response_html'];
        $get_record[0] = json_decode($get_record[0]['bcc_data'], true);
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
    <form id='bcc_form' action="<?php echo site_url('_dataset/basal_cell_dataset/save_record') ?>" method="post" >
        <input type="hidden" value="<?php echo $this->uri->segment(4) ?>" name="record_id">
        <input type="hidden" value="<?php echo $dataset_record_id ?>" name="dataset_record_id">
        <input type="hidden" id="bcc_respons_html" value='<?= $html_response ?>' name="bcc_respons_html">
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
                    <input type="hidden" name="dataset_id" value="18">
                    <input type="hidden" name="dataset_type" value="Basal Cell">
                    <div class="col-sm-12">


<!--                        <select id='dataset_title' class="form-control" name="dataset_title">
                            <option value="Basal Cell">Basal Cell Carcinoma Dataset</option>
                            <option value="Breast Cancer">Breast Cancer Dataset</option>
                        </select> -->
                        <!--<i class="fa fa-pencil icon_inside"> </i>-->
                        <input type="hidden" name="dataset_title" value="Basal Cell">
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-right float-right ml-auto">
                <?php if ($this->uri->segment(4) != '') { ?>
                    <?php if ($dataset_bcc[0]['dataset_record_id'] != '') { ?>

                        <a onclick="return confirm_delete();" href="<?php echo site_url('_dataset/basal_cell_dataset/removeDatasetbyID/' . $dataset_bcc[0]['dataset_record_id'] . '/' . $dataset_bcc[0]['record_id']) ?>" class="btn btn-danger btn-rounded"><i class="fa fa-trash"></i> </a>

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
        <?php //_print_r($dataset_bcc); ?>
    <!--<h3 class="text-center"><?php echo $this->uri->segment(4) == '' ? '' : 'Record# ' . $this->uri->segment(4) ?></h3>-->
        <h5 class="text-center text-muted">
            <small>
                <strong> Created at: </strong> <?= $dataset_bcc[0]['created_at'] ?>
                <strong> Updated at: </strong> <?= $dataset_bcc[0]['modified_at'] ?>
            </small>
        </h5>

        <div class="row">

            <div class="col-md-3">
                <div>
                    <div class="col-sm-12 form-group">
                        <h3><i style="background: #00c5fb;color: white;padding: 10px;border-radius: 30px;font-size: 35px;" class="ti-harddrive" title="Datasets"></i> Basal Cell Carcinoma</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="faq-card">
                                <div class="card mb-1">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a id='slide_1202' href="#slide-022"> Clinical data </a>
                                        </h4>
                                    </div>
                                    <div id="">
                                        <div class="card-body">
                                            <ul class="list-unstyled">
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide022_stat success"></span><a id='slide_1202' href="#slide-022"> Maximum clinical dimension/diameter </a></li>                                                                                           <li><span class="fa fa-check <?php echo $side_menu_state ?> slide1_stat success"></span><a id='slide_01' href="#slide-1"> Specimen type </a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="faq-card">
                                <div class="card mb-1">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a id='slide_007' href="#slide-007">Macroscopic description</a>
                                        </h4>
                                    </div>
                                    <div id="">
                                        <div class="card-body">
                                            <ul class="list-unstyled">                                                                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide007_stat success"></span><a id='slide_007' href="#slide-007"> Dimension of specimen:  </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="faq-card">
                                <div class="card mb-1">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a id='slide_08' href="#slide-8">Histological data</a>
                                        </h4>
                                    </div>
                                    <div id="" >
                                        <div class="card-body">
                                            <ul class="list-unstyled">                                                                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide8_stat success"></span><a id='slide_08' href="#slide-8"> Low risk or High Risk:  </a></li>
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide11_stat success"></span><a id='slide_11' href="#slide-11"> Deep invasion </a></li>

                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide17_stat success"></span><a id='slide_17' href="#slide-17"> Perineural invasion   </a></li>
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide18_stat success"></span><a id='slide_18' href="#slide-18"> Lymphovascular invasion   </a></li>
                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide018_stat success"></span><a id='slide_018' href="#slide-018"> Margins   </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="faq-card">
                                <div class="card mb-1">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a id='slide_019' href="#slide-019"> Maximum dimension/diameter of lesion</a>
                                        </h4>
                                    </div>
                                    <div id="" >
                                        <div class="card-body">
                                            <ul class="list-unstyled">                                                                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide019_stat success"></span><a id='slide_019' href="#slide-019"> Indicate which used: </a></li>
                                                <ul class="list-unstyled">                                                                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide20_stat success"></span><a id='slide_20' href="#slide-20"> Dimension </a></li>
                                                </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="faq-card">
                                <div class="card mb-1">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a id='slide_21' href="#slide-21"> COMMENTS </a>
                                        </h4>
                                    </div>
                                    <div id="">
                                        <div class="card-body">
                                            <ul class="list-unstyled">                                                                                                <li><span class="fa fa-check <?php echo $side_menu_state ?> slide21_stat success"></span><a id='slide_21' href="#slide-21"> pTNM & COMMENTS </a></li>
                                                <ul class="list-unstyled">      
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
                        <li class="list-inline-item"><a href="#slide-022" class="circle_carousel active"></a></li>
                        <li class="list-inline-item"><a href="#slide-1" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-2" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-3" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-4" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="javascript:;" class="next_2"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                    <ul class="radio_links list-inline step2 hidden">
                        <li class="list-inline-item"><a href="javascript:;" class="back_1"><i class="fa fa-angle-left"></i></a></li>
                        <li class="list-inline-item"><a href="#slide-5" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-006" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-007" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-7" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-8" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="javascript:;" class="next_3"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                    <ul class="radio_links list-inline step3 hidden">
                        <li class="list-inline-item"><a href="javascript:;" class="back_2"><i class="fa fa-angle-left"></i></a></li>
                        <li class="list-inline-item"><a href="#slide-11" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-12" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-0012" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-1112" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-2212" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="javascript:;" class="next_4"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                    <ul class="radio_links list-inline step4 hidden">
                        <li class="list-inline-item"><a href="javascript:;" class="back_3"><i class="fa fa-angle-left"></i></a></li>
                        <li class="list-inline-item"><a href="#slide-3312" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-4412" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-17" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-0017" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-1117" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="javascript:;" class="next_5"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                    <ul class="radio_links list-inline step5 hidden">
                        <li class="list-inline-item"><a href="javascript:;" class="back_4"><i class="fa fa-angle-left"></i></a></li>
                        <li class="list-inline-item"><a href="#slide-18" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-0018" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-118" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-019" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-20" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="#slide-21" class="circle_carousel"></a></li>
                        <li class="list-inline-item"><a href="javascript:;" class=""><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div>

                <div class="row surgical_specimen_selection  ">
                    <div class="col-md-12 card">
                        <div class="card-body">
                            <div class="slides">
                                <div id="slide-022">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> histological_calcification text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Clinical Data</h3>
                                            <h4>Maximum clinical dimension/diameter</h4>
                                            <hr>

                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                <input type="number" min="0" id="clinicaldimention" class="form-control input-lg" name="clinicaldimention" value="<?php echo $btn_label == 'Update' && $get_record[0]['clinicaldimention'] != '' ? $get_record[0]['clinicaldimention'] : '' ?>" aria-describedby="basic-addon2">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">(mm)</span>
                                                </div>
                                            </div>
                                            <span class="btn btn-primary btn-right cus_btn" id="clinicaldimention_btn">Next</span>
                                        </div>
                                    </div>
                                    <a href="javascript:;" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-1" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-1">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h3>Clinical site</h3>
                                            <h4>Specimen type†:</h4>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="radioNotstated" name="Specimen_type" value="Not stated" <?php echo $btn_label == 'Update' && $get_record[0]['Specimen_type'] == 'Not stated' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioNotstated">Not stated</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioIncision" name="Specimen_type" value="Incision" <?php echo $btn_label == 'Update' && $get_record[0]['Specimen_type'] == 'Incision' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioIncision">Incision</label></span>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioExcision" name="Specimen_type" value="Excision" <?php echo $btn_label == 'Update' && $get_record[0]['Specimen_type'] == 'Excision' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioExcision">Excision</label></span>
                                        </div>


                                        <div class="col-md-4">
                                            <input type="radio" id="radioPunch" name="Specimen_type" value="Punch" <?php echo $btn_label == 'Update' && $get_record[0]['Specimen_type'] == 'Punch' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioPunch">Punch</label></span>
                                        </div>


                                        <div class="col-md-4">
                                            <input type="radio" id="radioCurettings" name="Specimen_type" value="Curettings" <?php echo $btn_label == 'Update' && $get_record[0]['Specimen_type'] == 'Curettings' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioCurettings">Curettings</label></span>
                                        </div>


                                        <div class="col-md-4">
                                            <input type="radio" id="radioShave" name="Specimen_type" value="Shave" <?php echo $btn_label == 'Update' && $get_record[0]['Specimen_type'] == 'Shave' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioShave">Shave</label></span>
                                        </div>


                                        <div class="col-md-4">
                                            <input type="radio" id="radioOther" name="Specimen_type" value="Other" <?php echo $btn_label == 'Update' && $get_record[0]['Specimen_type'] == 'Other' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="radioOther">Other</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-022" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-2" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-2">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_type_main  text-center">
                                        <div class="col-md-12  text-center">
                                            <h3>Clinical site</h3>
                                            <h4>Incision</h4>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="radio" id="Incision" name="Incision" value="Diagnostic"  <?php echo $btn_label == 'Update' && $get_record[0]['Incision'] == 'Diagnostic' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Incision">Diagnostic</label></span>
                                        </div>

                                    </div>
                                    <a href="#slide-1" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-3" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-3">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> specimen_radio_seen  text-center">
                                        <div class="col-md-12  text-center">
                                            <h3>Clinical site</h3>
                                            <h4>Excision</h4>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Excision_Diagnostic" name="Excision" value="Diagnostic"  <?php echo $btn_label == 'Update' && $get_record[0]['Excision'] == 'Diagnostic' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Excision_Diagnostic">Diagnostic</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Excision_Therapeutic" name="Excision" value="Therapeutic"  <?php echo $btn_label == 'Update' && $get_record[0]['Excision'] == 'Therapeutic' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Excision_Therapeutic">Therapeutic</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Excision_Uncertain" name="Excision" value="Uncertain"  <?php echo $btn_label == 'Update' && $get_record[0]['Excision'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Excision_Uncertain">Uncertain</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Excision_Re-excision" name="Excision" value="Re-excision"  <?php echo $btn_label == 'Update' && $get_record[0]['Excision'] == 'Re-excision' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Excision_Re-excision">Re-excision</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Excision_Wider" name="Excision" value="Wider local excision"  <?php echo $btn_label == 'Update' && $get_record[0]['Excision'] == 'Wider local excision' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Excision_Wider">Wider local excision</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-2" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-4" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-4">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> memo_absormality text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Clinical site</h3>
                                            <h4>Punch</h4>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Punch_Diagnostic" name="Punch" value="Diagnostic"  <?php echo $btn_label == 'Update' && $get_record[0]['Punch'] == 'Diagnostic' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Punch_Diagnostic">Diagnostic</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Punch_Therapeutic" name="Punch" value="Therapeutic"  <?php echo $btn_label == 'Update' && $get_record[0]['Punch'] == 'Therapeutic' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Punch_Therapeutic">Therapeutic</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Punch_Uncertain" name="Punch" value="Uncertain"  <?php echo $btn_label == 'Update' && $get_record[0]['Punch'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Punch_Uncertain">Uncertain</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-3" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-5" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-5">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> core_biopsy_seen text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Clinical site</h3>
                                            <h4>Curettings</h4>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Curettings_Diagnostic" name="Curettings" value="Diagnostic"  <?php echo $btn_label == 'Update' && $get_record[0]['Curettings'] == 'Diagnostic' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Curettings_Diagnostic">Diagnostic</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Curettings_Therapeutic" name="Curettings" value="Therapeutic"  <?php echo $btn_label == 'Update' && $get_record[0]['Curettings'] == 'Therapeutic' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Curettings_Therapeutic">Therapeutic</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Curettings_Uncertain" name="Curettings" value="Uncertain"  <?php echo $btn_label == 'Update' && $get_record[0]['Curettings'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Curettings_Uncertain">Uncertain</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-4" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-6" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-6">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> histological_calcification text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Clinical site</h3>
                                            <h4>Shave</h4>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Shave_Diagnostic" name="Shave" value="Diagnostic"  <?php echo $btn_label == 'Update' && $get_record[0]['Shave'] == 'Diagnostic' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Shave_Diagnostic">Diagnostic</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Shave_Therapeutic" name="Shave" value="Therapeutic"  <?php echo $btn_label == 'Update' && $get_record[0]['Shave'] == 'Therapeutic' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Shave_Therapeutic">Therapeutic</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Shave_Uncertain" name="Shave" value="Uncertain"  <?php echo $btn_label == 'Update' && $get_record[0]['Shave'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Shave_Uncertain">Uncertain</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-5" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-006" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-006">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> histological_calcification text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Clinical site</h3>
                                            <h4>Other</h4>
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <textarea id="CDOther" name="CDOther" style="height:200px" >  <?php echo $btn_label == 'Update' && $get_record[0]['CDOther'] != '' ? $get_record[0]['CDOther'] : '' ?> </textarea>
                                            <br><span class="btn btn-primary" id="CDOther_btn">Next</span>
                                        </div>
                                    </div>
                                    <a href="#slide-6" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-007" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-007">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Macroscopic description</h3>
                                            <h4>Dimension of specimen</h4>
                                            <hr>
                                        </div>
                                        <div class="col-md-4">
                                            <span style="font-size:20px">Length (mm)</span> <input type="number" id="specimendimention1" name="specimendimention1" value="<?php echo $btn_label == 'Update' && $get_record[0]['clinicaldimention'] != '' ? $get_record[0]['specimendimention1'] : '' ?>"   > <!-- <span style="font-size:20px">(mm)</span> -->
                                        </div>
                                        <div class="col-md-4">
                                            <span style="font-size:20px">Breadth (mm)</span><input type="number" id="specimendimention2" name="specimendimention2" value="<?php echo $btn_label == 'Update' && $get_record[0]['clinicaldimention'] != '' ? $get_record[0]['specimendimention2'] : '' ?>"   > 
                                        </div>
                                        <div class="col-md-4">
                                            <span style="font-size:20px">Depth (mm)</span><input type="number" id="specimendimention3" name="specimendimention3" value="<?php echo $btn_label == 'Update' && $get_record[0]['clinicaldimention'] != '' ? $get_record[0]['specimendimention3'] : '' ?>"   >
                                        </div>

                                        <div class="clearfix"></div>

                                        <hr>
                                        <div class="col-md-12  text-center" style="margin-top:80px">
                                            <h4>Maximum dimension/diameter of lesion†: </h4>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" id="Macroscopic_description" name="MDMacroscopic_description" value="<?php echo $btn_label == 'Update' && $get_record[0]['MDMacroscopic_description'] != '' ? $get_record[0]['MDMacroscopic_description'] : '' ?>"   >  <span style="font-size:20px">(mm)</span>
                                        </div>
                                        <br><br><br>
                                        <div class="col-md-6">
                                            <input type="radio" id="Macroscopic_Uncertain" name="Macroscopic" value="Uncertain"  <?php echo $btn_label == 'Update' && $get_record[0]['Macroscopic'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Macroscopic_Uncertain">Uncertain</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Macroscopic_No_lesion" name="Macroscopic" value="No lesion seen"  <?php echo $btn_label == 'Update' && $get_record[0]['Macroscopic'] == 'No lesion seen' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Macroscopic_No_lesion">No lesion seen</label></span>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <span class="btn btn-primary" id="specimendimention_btn">Next</span>
                                        </div>


                                    </div>
                                    <a href="#slide-006" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-8" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-8">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> Epithelial_proliferation text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Histological data </h3>
                                            <h5>Low risk:</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Histological_Superficial" name="Histological_low" value="Superficial"  <?php echo $btn_label == 'Update' && $get_record[0]['Histological_low'] == 'Superficial' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Histological_Superficial">Superficial</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Histological_Fibroepithelial" name="Histological_low" value="Fibroepithelial"  <?php echo $btn_label == 'Update' && $get_record[0]['Histological_low'] == 'Fibroepithelial' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Histological_Fibroepithelial">Fibroepithelial</label></span>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="radio" id="Histological_Nodular" name="Histological_low" value="Nodular"  <?php echo $btn_label == 'Update' && $get_record[0]['Histological_low'] == 'Nodular' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Histological_Nodular">Nodular</label></span>
                                        </div>
                                    </div>

                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> Invasive_carcinoma text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>OR high risk if present: </h3>
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="radio" id="Histological_Infiltrative" name="Histological_high" value="Infiltrative"  <?php echo $btn_label == 'Update' && $get_record[0]['Histological_high'] == 'Infiltrative' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Histological_Infiltrative">Infiltrative (infiltrating/sclerosing/micronodular)</label></span>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="radio" id="Histological_Basosquamous" name="Histological_high" value="Basosquamous carcinoma"  <?php echo $btn_label == 'Update' && $get_record[0]['Histological_high'] == 'Basosquamous carcinoma' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Histological_Basosquamous">Basosquamous carcinoma</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-007" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-11" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>

                                </div>

                                <div id="slide-11">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Histological data </h3>
                                            <h3>For pure superficial basal cell carcinoma, invasive entries can be omitted </h3>
                                            <h5>Deep invasion</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_Present" name="n_Histological_Present" value="Present"  <?php echo $btn_label == 'Update' && $get_record[0]['Histological_Present'] == 'Present' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Histological_Present">Present</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_NOTPresent" name="n_Histological_Present" value="Not Identified"  <?php echo $btn_label == 'Update' && $get_record[0]['Histological_Present'] == 'Not Identified' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Histological_NOTPresent">Not Identified</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-8" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-12" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-12">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Histological data </h3>
                                            <h3>For pure superficial basal cell carcinoma, invasive entries can be omitted </h3>
                                            <h5>Deep invasion : Thickness >6 mm</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_thickness_Present" name="n_Histological_thickness_Present" value="Present"  <?php echo $btn_label == 'Update' && $get_record[0]['Histological__thickness_Present'] == 'Present' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Histological_thickness_Present">Present</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_thickness_NOTPresent" name="n_Histological_thickness_Present" value="Not Identified"  <?php echo $btn_label == 'Update' && $get_record[0]['Histological_thickness_Present'] == 'Not Identified' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Histological_thickness_NOTPresent">Not Identified</label></span>
                                        </div>

                                    </div>
                                    <a href="#slide-11" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-0012" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-0012">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> text-center ">


                                        <div class="col-md-12  text-center">
                                            <h5>Level of invasion beyond subcutaneous fat</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_fat_Present" name="n_Histological_fat_Present" value="Present"  <?php echo $btn_label == 'Update' && $get_record[0]['Histological_fat_Present'] == 'Present' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Histological_fat_Present">Present</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_fat_NOTPresent" name="n_Histological_fat_Present" value="Not Identified"  <?php echo $btn_label == 'Update' && $get_record[0]['Histological_fat_Present'] == 'Not Identified' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Histological_fat_NOTPresent">Not Identified</label></span>
                                        </div>

                                    </div>
                                    <a href="#slide-12" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-1112" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-1112">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> text-center ">


                                        <div class="col-md-12  text-center">
                                            <h5>Specify tissue</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_Fascia" name="n_Histological_Specify_tissue" value="Fascia"  <?php echo $btn_label == 'Update' && $get_record[0]['n_Histological_Specify_tissue'] == 'Fascia' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Histological_Fascia">Fascia</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_Muscle" name="n_Histological_Specify_tissue" value="Muscle"  <?php echo $btn_label == 'Update' && $get_record[0]['n_Histological_Specify_tissue'] == 'Perichondrium' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Histological_Muscle">Muscle</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_Perichondrium" name="n_Histological_Specify_tissue" value="Perichondrium"  <?php echo $btn_label == 'Update' && $get_record[0]['n_Histological_Specify_tissue'] == 'Perichondrium' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Histological_Perichondrium">Perichondrium</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_Cartilage" name="n_Histological_Specify_tissue" value="Cartilage"  <?php echo $btn_label == 'Update' && $get_record[0]['n_Histological_Specify_tissue'] == 'Cartilage' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Histological_Cartilage">Cartilage</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_Paratendon-tendon" name="n_Histological_Specify_tissue" value="Paratendon-tendon"  <?php echo $btn_label == 'Update' && $get_record[0]['n_Histological_Specify_tissue'] == 'Paratendon-tendon' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Histological_Paratendon-tendon">Paratendon/tendon</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_Periosteum" name="n_Histological_Specify_tissue" value="Periosteum"  <?php echo $btn_label == 'Update' && $get_record[0]['n_Histological_Specify_tissue'] == 'Periosteum' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Histological_Periosteum">Periosteum</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_Bone" name="n_Histological_Specify_tissue" value="Bone"  <?php echo $btn_label == 'Update' && $get_record[0]['n_Histological_Specify_tissue'] == 'Bone' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Histological_Bone">Bone</label></span>
                                        </div>

                                    </div>
                                    <a href="#slide-0012" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-2212" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-2212">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> text-center ">

                                        <div class="col-md-12  text-center">
                                            <h4>If bone invasion present</h4>
                                            <h5>Minor bone erosion </h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_minor1" name="n_bone_minor" value="Present"  <?php echo $btn_label == 'Update' && $get_record[0]['n_bone_minor'] == 'Present' ? 'checked' : 'Present' ?> >
                                            <span class="new_label"><label for="n_bone_minor1">Present</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_minor2" name="n_bone_minor" value="Not identified"  <?php echo $btn_label == 'Update' && $get_record[0]['n_bone_minor'] == 'Not identified' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_bone_minor2">Not identified</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_minor3" name="n_bone_minor" value="Uncertain"  <?php echo $btn_label == 'Update' && $get_record[0]['n_bone_minor'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_bone_minor3">Uncertain</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_minor4" name="n_bone_minor" value="Cannot be assessed "  <?php echo $btn_label == 'Update' && $get_record[0]['n_bone_minor'] == 'Cannot be assessed ' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_bone_minor4">Cannot be assessed </label></span>
                                        </div>

                                    </div>
                                    <a href="#slide-1122" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-3312" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-3312">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> text-center ">

                                        <div class="col-md-12  text-center">
                                            <h5>Gross cortical/marrow invasion</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_gross1" name="n_bone_gross" value="Present"  <?php echo $btn_label == 'Update' && $get_record[0]['n_bone_gross'] == 'Present' ? 'checked' : 'Present' ?> >
                                            <span class="new_label"><label for="n_bone_gross1">Present</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_gross2" name="n_bone_gross" value="Not identified"  <?php echo $btn_label == 'Update' && $get_record[0]['n_bone_gross'] == 'Not identified' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_bone_gross2">Not identified</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_gross3" name="n_bone_gross" value="Uncertain"  <?php echo $btn_label == 'Update' && $get_record[0]['n_bone_gross'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_bone_gross3">Uncertain</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_gross4" name="n_bone_minor" value="Cannot be assessed "  <?php echo $btn_label == 'Update' && $get_record[0]['n_bone_minor'] == 'Cannot be assessed ' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_bone_gross4">Cannot be assessed </label></span>
                                        </div>

                                    </div>
                                    <a href="#slide-2212" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-4412" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <div id="slide-4412">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> text-center ">

                                        <div class="col-md-12  text-center">
                                            <h5>Axial/skull base/foraminal invasion</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_foraminal1" name="n_bone_foraminal" value="Present"  <?php echo $btn_label == 'Update' && $get_record[0]['n_bone_foraminal'] == 'Present' ? 'checked' : 'Present' ?> >
                                            <span class="new_label"><label for="n_bone_foraminal1">Present</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_foraminal2" name="n_bone_foraminal" value="Not identified"  <?php echo $btn_label == 'Update' && $get_record[0]['n_bone_foraminal'] == 'Not identified' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_bone_foraminal2">Not identified</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_foraminal3" name="n_bone_foraminal" value="Uncertain"  <?php echo $btn_label == 'Update' && $get_record[0]['n_bone_foraminal'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_bone_foraminal3">Uncertain</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_foraminal4" name="n_bone_foraminal" value="Cannot be assessed "  <?php echo $btn_label == 'Update' && $get_record[0]['n_bone_foraminal'] == 'Cannot be assessed ' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_bone_foraminal4">Cannot be assessed </label></span>
                                        </div>

                                    </div>
                                    <a href="#slide-3312" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-17" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-17"> 
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Histological data</h3>
                                            <h3>Perineural invasion†
                                                :** </h3>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_invasion1" name="n_invasion" value="Present"  <?php echo $btn_label == 'Update' && $get_record[0]['n_invasion'] == 'Present' ? 'checked' : 'Present' ?> >
                                            <span class="new_label"><label for="n_invasion1">Present</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_invasion2" name="n_invasion" value="Not identified"  <?php echo $btn_label == 'Update' && $get_record[0]['n_invasion'] == 'Not identified' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_invasion2">Not identified</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_invasion3" name="n_invasion" value="Uncertain"  <?php echo $btn_label == 'Update' && $get_record[0]['n_invasion'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_invasion3">Uncertain</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_invasion4" name="n_invasion" value="Cannot be assessed "  <?php echo $btn_label == 'Update' && $get_record[0]['n_invasion'] == 'Cannot be assessed ' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_invasion4">Cannot be assessed </label></span>
                                        </div>

                                    </div>
                                    <a href="#slide-4412" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-0017" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-0017"> 
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> text-center ">

                                        <div class="col-md-12  text-center">
                                            <h5>If present: Meets criteria to upstage pT1/pT2 to pT3?**</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_invasion_y" name="n_invasion_present" value="Yes"  <?php echo $btn_label == 'Update' && $get_record[0]['n_invasion_present'] == 'Yes' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_invasion_y">Yes</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_invasion_n" name="n_invasion_present" value="No"  <?php echo $btn_label == 'Update' && $get_record[0]['n_invasion_present'] == 'No' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_invasion_n">No</label></span>
                                        </div>

                                    </div>
                                    <a href="#slide-17" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-1117" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-1117"> 
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> text-center ">
                                        <div class="col-md-12  text-center">
                                            <h5>If yes: Named nerve </h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_invasion_m" name="n_invasion_yes_m" value="≥0.1 mm "  <?php echo $btn_label == 'Update' && $get_record[0]['n_invasion_yes_m'] == '≥0.1 mm ' ? 'checked' : '≥0.1 mm ' ?> >
                                            <span class="new_label"><label for="n_invasion_m">≥0.1 mm </label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_invasion_b" name="n_invasion_yes_m" valueBeyond dermisNo"  <?php echo $btn_label == 'Update' && $get_record[0]['n_invasion_yes_m'] == 'Beyond dermis' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_invasion_b">Beyond dermis</label></span>
                                        </div>

                                    </div>
                                    <a href="#slide-17" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-18" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-18"> 
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Histological data</h3>
                                            <h3>Lymphovascular invasion (basosquamous carcinoma only)†
                                                : </h3>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_carcinoma1" name="n_carcinoma" value="Present"  <?php echo $btn_label == 'Update' && $get_record[0]['n_carcinoma'] == 'Present' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_carcinoma1">Present</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_carcinoma2" name="n_carcinoma" value="Not identified"  <?php echo $btn_label == 'Update' && $get_record[0]['n_carcinoma'] == 'Not identified' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_carcinoma2">Not identified</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_carcinoma3" name="n_carcinoma" value="Uncertain"  <?php echo $btn_label == 'Update' && $get_record[0]['n_carcinoma'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_carcinoma3">Uncertain</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_carcinoma4" name="n_carcinoma" value="Cannot be assessed "  <?php echo $btn_label == 'Update' && $get_record[0]['n_carcinoma'] == 'Cannot be assessed ' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_carcinoma4">Cannot be assessed </label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-1117" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-018" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-018"> 
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Histological data</h3>
                                            <h3>Margins†: Peripheral</h3>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="n_Peripheral1" name="n_Peripheral" value="Involved"  <?php echo $btn_label == 'Update' && $get_record[0]['n_Peripheral'] == 'Involved' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Peripheral1">Involved</label></span>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="n_Peripheral4" name="n_Peripheral" value="Uncertain"  <?php echo $btn_label == 'Update' && $get_record[0]['n_Peripheral'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Peripheral4">Uncertain</label></span>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="n_Peripheral5" name="n_Peripheral" value="Not applicable"  <?php echo $btn_label == 'Update' && $get_record[0]['n_Peripheral'] == 'Not applicable' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Peripheral5">Not applicable</label></span>
                                        </div>
                                        <div class="col-sm-12">
                                            <h3>if not involved</h3>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="n_Peripheral6" name="n_Peripheral" value="<1 mm"  <?php echo $btn_label == 'Update' && $get_record[0]['n_Peripheral'] == '<1 mm' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Peripheral6"><1 mm</label></span>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="n_Peripheral2" name="n_Peripheral" value="1–5 mm "  <?php echo $btn_label == 'Update' && $get_record[0]['n_Peripheral'] == '1–5 mm ' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Peripheral2">1–5 mm </label></span>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="n_Peripheral3" name="n_Peripheral" value=">5 mm "  <?php echo $btn_label == 'Update' && $get_record[0]['n_Peripheral'] == '>5 mm ' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Peripheral3">>5 mm </label></span>
                                        </div>

                                    </div>
                                    <a href="#slide-18" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-118" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-118"> 
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> text-center ">

                                        <div class="col-md-12  text-center">
                                            <h3>Margins†: Deep</h3>
                                            <hr>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="n_Deep1" name="n_Deep" value="Involved"  <?php echo $btn_label == 'Update' && $get_record[0]['n_Deep'] == 'Involved' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Deep1">Involved</label></span>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="n_Deep5" name="n_Deep" value="Uncertain"  <?php echo $btn_label == 'Update' && $get_record[0]['n_Deep'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Deep5">Uncertain</label></span>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="n_Deep6" name="n_Deep" value="Not applicable"  <?php echo $btn_label == 'Update' && $get_record[0]['n_Deep'] == 'Not applicable' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Deep6">Not applicable</label></span>
                                        </div>
                                        <div class="col-sm-12">
                                            <h3>if not involved</h3>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="n_Deep2" name="n_Deep" value="<1 mm"  <?php echo $btn_label == 'Update' && $get_record[0]['n_Deep'] == '<1 mm' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Deep2"><1 mm</label></span>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="n_Deep3" name="n_Deep" value="1–5 mm "  <?php echo $btn_label == 'Update' && $get_record[0]['n_Deep'] == '1–5 mm ' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Deep3">1–5 mm </label></span>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="n_Deep4" name="n_Deep" value=">5 mm "  <?php echo $btn_label == 'Update' && $get_record[0]['n_Deep'] == '>5 mm ' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="n_Deep4">>5 mm </label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-018" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-019" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>


                                <div id="slide-019">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> Invasive_carcinoma text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Maximum dimension/diameter of lesion </h3>
                                            <h3>Indicate which used: </h3>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="radio" id="Maximum_Clinical" name="Maximum_Indicate" value="Clinical"  <?php echo $btn_label == 'Update' && $get_record[0]['Maximum_Indicate'] == 'Clinical' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Maximum_Clinical">Clinical</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Maximum_OR_Macroscopic" name="Maximum_Indicate" value="OR Macroscopic"  <?php echo $btn_label == 'Update' && $get_record[0]['Maximum_Indicate'] == 'OR Macroscopic' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Maximum_OR_Macroscopic">OR Macroscopic</label></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Maximum_OR_Microscopic" name="Maximum_Indicate" value="OR Microscopic"  <?php echo $btn_label == 'Update' && $get_record[0]['Maximum_Indicate'] == 'OR Microscopic' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Maximum_OR_Microscopic">OR Microscopic</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-118" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-20" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>

                                <div id="slide-20">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> Invasive_carcinoma text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Maximum dimension/diameter of lesion </h3>
                                            <h3>Dimension†</h3>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Maximum_20" name="Maximum_Dimention" value="≤20 mm"  <?php echo $btn_label == 'Update' && $get_record[0]['Maximum_Dimention'] == '≤20 mm' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Maximum_20">≤20 mm</label></span>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Maximum_20_40" name="Maximum_Dimention" value=">20 – ≤40 mm"  <?php echo $btn_label == 'Update' && $get_record[0]['Maximum_Dimention'] == '>20 – ≤40 mm' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Maximum_20_40">>20 – ≤40 mm</label></span>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Maximum_40" name="Maximum_Dimention" value=">40 mm"  <?php echo $btn_label == 'Update' && $get_record[0]['Maximum_Dimention'] == '>40 mm' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Maximum_40">>40 mm</label></span>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Maximum_Uncertain" name="Maximum_Dimention" value="Uncertain"  <?php echo $btn_label == 'Update' && $get_record[0]['Maximum_Dimention'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Maximum_Uncertain">Uncertain</label></span>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Maximum_Cannot" name="Maximum_Dimention" value="Cannot be assessed"  <?php echo $btn_label == 'Update' && $get_record[0]['Maximum_Dimention'] == 'Cannot be assessed' ? 'checked' : '' ?> >
                                            <span class="new_label"><label for="Maximum_Cannot">Cannot be assessed</label></span>
                                        </div>
                                    </div>
                                    <a href="#slide-019" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#slide-21" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>


                                <div id="slide-21">
                                    <div class="row form-group <?= $btn_label == "Update" ? '' : 'radio-toolbar' ?> ptnm_comments text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>pTNM/COMMENTS</h3>
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <span style="font-size:20px">pTNM pT</span><br>
                                            <!--<input type="text" id="ptnm" name="ptnm" value="m"  <?php echo $btn_label == 'Update' && $get_record[0]['ptnm'] != '' ? $get_record[0]['ptnm'] : '' ?> >--> 



                                            <select style="width: 85%;" class="from-control" id="ptnm" name="ptnm">
                                                <option value="">Please Select</option>
                                                <option <?php echo $btn_label == 'Update' && $get_record[0]['ptnm'] == 'pTX' ? $get_record[0]['ptnm'] : '' ?> value="pTX"> pTX Primary tumour cannot be assessed</option>
                                                <option <?php echo $btn_label == 'Update' && $get_record[0]['ptnm'] == 'pT0' ? $get_record[0]['ptnm'] : '' ?> value="pT0">pT0 No evidence of primary tumour</option>
                                                <option <?php echo $btn_label == 'Update' && $get_record[0]['ptnm'] == 'pTis' ? $get_record[0]['ptnm'] : '' ?> value="pTis">pTis Carcinoma in situ</option>
                                                <option <?php echo $btn_label == 'Update' && $get_record[0]['ptnm'] == 'pT1' ? $get_record[0]['ptnm'] : '' ?> value="pT1">pT1 Tumour ≤20 mm or less in maximum dimension (this is the clinical dimension but the pathological dimension, usually macroscopic, can be used if the clinical is not available)</option>
                                                <option <?php echo $btn_label == 'Update' && $get_record[0]['ptnm'] == 'pT2' ? $get_record[0]['ptnm'] : '' ?> value="pT2">pT2 Tumour >20 mm to ≤40 mm in maximum dimension (this is the clinical dimension but the pathological dimension, usually macroscopic, can be used if the clinical is not available)</option>
                                                <option <?php echo $btn_label == 'Update' && $get_record[0]['ptnm'] == 'pT3' ? $get_record[0]['ptnm'] : '' ?> value="pT3">pT3 Tumour >40 mm in maximum dimension (this is the clinical dimension but the pathological dimension, usually macroscopic, can be used if the clinical is not available) OR pT1 or pT2 can be upstaged to pT3 by one or more high-risk clinical/pathological features including deep invasion,* specifically defined perineural invasion* or minor bone erosion</option>
                                                <option <?php echo $btn_label == 'Update' && $get_record[0]['ptnm'] == 'pT4a' ? $get_record[0]['ptnm'] : '' ?> value="pT4a">pT4a Tumour with gross cortical/marrow invasion</option>
                                                <option <?php echo $btn_label == 'Update' && $get_record[0]['ptnm'] == 'pT4b' ? $get_record[0]['ptnm'] : '' ?> value="pT4b">pT4b Tumour with axial skeleton/skull base/foraminal invasion</option>
                                            </select>

                                        </div>
                                        <div class="col-md-12">
                                            <span style="font-size:20px">pTNM pN</span><br>



                                            <select style="width: 85%;" class="from-control" id="ptnm_N" name="ptnm_N">
                                                <option value="">Please Select</option>
                                                <option <?php echo $btn_label == 'Update' && $get_record[0]['ptnm_N'] == 'pNX' ? $get_record[0]['ptnm_N'] : '' ?> value="pNX">pNX Regional lymph nodes cannot be assessed</option>
                                                <option <?php echo $btn_label == 'Update' && $get_record[0]['ptnm_N'] == 'pN0' ? $get_record[0]['ptnm_N'] : '' ?> value="pN0">pN0 No regional lymph node metastasis</option>
                                                <option <?php echo $btn_label == 'Update' && $get_record[0]['ptnm_N'] == 'pN1' ? $get_record[0]['ptnm_N'] : '' ?> value="pN1">pN1 Metastasis in a single ipsilateral lymph node ≤30 mm in greatest dimension</option>
                                                <option <?php echo $btn_label == 'Update' && $get_record[0]['ptnm_N'] == 'pN2' ? $get_record[0]['ptnm_N'] : '' ?> value="pN2">pN2 Metastasis in a single ipsilateral lymph node >30 mm but not >60 mm in greatest dimension or in multiple ipsilateral lymph nodes, but not >60 mm in greatest dimension</option>
                                                <option <?php echo $btn_label == 'Update' && $get_record[0]['ptnm_N'] == 'pN3' ? $get_record[0]['ptnm_N'] : '' ?> value="pN3">pN3 Metastasis in a lymph node >60 mm in greatest dimension</option>
                                                <option <?php echo $btn_label == 'Update' && $get_record[0]['ptnm_N'] == 'pNX' ? $get_record[0]['ptnm_N'] : '' ?> value="pNX">pNX Regional lymph nodes cannot be assessed</option>
                                                <option <?php echo $btn_label == 'Update' && $get_record[0]['ptnm_N'] == 'pN0' ? $get_record[0]['ptnm_N'] : '' ?> value="pN0">pN0 No regional lymph node metastasis</option>
                                                <option <?php echo $btn_label == 'Update' && $get_record[0]['ptnm_N'] == 'pN1' ? $get_record[0]['ptnm_N'] : '' ?> value="pN1">pN1 Metastasis in a single ipsilateral lymph node ≤30 mm in greatest dimension, without extranodal extension</option>
                                                <option <?php echo $btn_label == 'Update' && $get_record[0]['ptnm_N'] == 'pN2a' ? $get_record[0]['ptnm_N'] : '' ?> value="pN2a">pN2a Metastasis in a single ipsilateral lymph node, >30 mm but not >60 mm in greatest dimension, without extranodal extension</option>
                                                <option <?php echo $btn_label == 'Update' && $get_record[0]['ptnm_N'] == 'pN2b' ? $get_record[0]['ptnm_N'] : '' ?> value="pN2b">pN2b Metastasis in multiple ipsilateral lymph nodes, none >60 mm in greatest dimension, without extranodal extension</option>
                                                <option <?php echo $btn_label == 'Update' && $get_record[0]['ptnm_N'] == 'pN2c' ? $get_record[0]['ptnm_N'] : '' ?> value="pN2c">pN2c Metastasis in bilateral or contralateral lymph nodes, none >60 mm in greatest dimension, without extranodal extension</option>
                                                <option <?php echo $btn_label == 'Update' && $get_record[0]['ptnm_N'] == 'pN3a' ? $get_record[0]['ptnm_N'] : '' ?> value="pN3a">pN3a Metastasis in a lymph node, >60 mm in greatest dimension, without extranodal extension.</option>
                                                <option <?php echo $btn_label == 'Update' && $get_record[0]['ptnm_N'] == 'pN3b' ? $get_record[0]['ptnm_N'] : '' ?> value="pN3b">pN3b Metastasis in a lymph node with extranodal extension</option>


                                            </select>

                                        </div>
                                        <div class="col-md-12">
                                            <span style="font-size:20px">Distant metastasis M</span><br>



                                            <select style="width: 85%;" class="from-control" id="ptnm_M" name="ptnm_M">
                                                <option value="">Please Select</option>
                                                <option  <?php echo $btn_label == 'Update' && $get_record[0]['ptnm_M'] == 'M0' ? $get_record[0]['ptnm_M'] : '' ?>  value="M0">M0 No distant metastasis</option>
                                                <option  <?php echo $btn_label == 'Update' && $get_record[0]['ptnm_M'] == 'M1/pM1' ? $get_record[0]['ptnm_M'] : '' ?>  value="M1/pM1">M1/pM1 Distant metastatic disease.</option>
                                            </select>

                                        </div>
                                        <div class="col-md-12 form-group">
                                            <br><br>
                                            <span style="font-size:20px">Comments</span><br>
                                            <textarea  style="height:200px" id="bcc_comments" name="bcc_comments"> <?php echo $btn_label == 'Update' && $get_record[0]['bcc_comments'] != '' ? $get_record[0]['bcc_comments'] : '' ?> </textarea>

                                        </div>


                                        <!--                                        <div class="col-md-12 text-center">
                                                                                    <span class="btn btn-primary" id="ptnm_comments">Next</span>
                                                                                </div>-->


                                    </div>
                                    <a href="#slide-20" class="left_slide bg-primary"><i class="fa fa-chevron-left"></i></a>
                                    <a href="javascript:;" class="right_slide bg-primary"><i class="fa fa-chevron-right"></i></a>
                                </div>


                            </div>
                            <?php if ($this->uri->segment(4) != '') { ?>
                                <div class="row pull-right" style="padding-top:30px">
                                    <input type="button" id="bcc_submit" class="btn btn-lg btn-primary" value="<?php echo $btn_label ?> Record">
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
                                        <!--                                        <div class="form-group">
                                        
                                                                                    <div class="tg-nameandtrack" style="padding-left: 60px;">
                                                                                        <h3> <input type="radio" id="patient_specimen1" class="patient_specimen" name="patient_specimen" value="1" <?= $get_record[0]['patient_specimen'] == 1 ? 'checked="true"' : $this->uri->segment(13) == 1 ? 'checked="true"' : '' ?>  required> Specimen 1
                                                                                        </h3>
                                                                                        <h3> <input type="radio" id="patient_specimen2" class="patient_specimen" name="patient_specimen" value="2" <?= $get_record[0]['patient_specimen'] == 2 ? 'checked="true"' : $this->uri->segment(13) == 2 ? 'checked="true"' : '' ?> required> Specimen 2
                                                                                        </h3>
                                                                                    </div>
                                                                                </div>-->


                                        <ul class="donate-now">
                                            <?php
                                            $sqCount = 1;
                                            foreach ($specimen_query as $sq) {
                                                ?>    
                                                <li>
                                                    <input type="radio" id="patient_specimen<?= $sqCount ?>" class="patient_specimen" name="patient_specimen" value="<?= $sqCount ?>" <?= $get_record[0]['patient_specimen'] == $sqCount ? 'checked="true"' : $this->uri->segment(13) == $sqCount ? 'checked="true"' : '' ?>  required>
                                                    <label for="patient_specimen<?= $sqCount ?>">
        <?= (in_array($sqCount, explode(',', $dataset_bcc_specimen))) ? '<span style="color: #12ff18;font-size: 2em;">&#8226;</span>' : '' ?>Specimen <?= $sqCount ?>
                                                    </label>
                                                </li>
                                                <?php
                                                $sqCount++;
                                            }
                                            ?>  
                                        </ul>

                                        <!--                                        <ul class="donate-now">
                                          <li>
                                            <input type="radio" id="patient_specimen1" class="patient_specimen" name="patient_specimen" value="1" <?= $get_record[0]['patient_specimen'] == 1 ? 'checked="true"' : $this->uri->segment(13) == 1 ? 'checked="true"' : '' ?>  required>
                                            <label for="patient_specimen1">Specimen 1</label>
                                          </li>
                                          <li>
                                            <input type="radio" id="patient_specimen2" class="patient_specimen" name="patient_specimen" value="2" <?= $get_record[0]['patient_specimen'] == 2 ? 'checked="true"' : $this->uri->segment(13) == 2 ? 'checked="true"' : '' ?> required> 
                                            <label for="patient_specimen2"> Specimen 2</label>
                                          </li>
                                        </ul>-->

                                    </fieldset>
<?php } ?>
                                <hr>
                                <div class="sidebar_title">BCC - Dataset</div>
                            </div>


                            <?php
                            if ($btn_label == 'Update') {
                                if ($html_response == '') {
                                    ?>
                                    <div id="bcc_answers">
                                        <div class="sidebar_subtitle"><h3 id="1st_spec1"></h3></div>
                                        <div class="col-sm-12">
                                            <span class="slide012_ans"></span>
                                            <span class="slide022_ans"></span>
                                            <span class="slide1_ans"></span>
                                            <span class="slide2_ans"></span>
                                            <span class="slide3_ans"></span>
                                            <span class="slide4_ans"></span>
                                            <span class="slide5_ans"></span>
                                            <span class="slide6_ans"></span>
                                            <span class="slide006_ans"></span>
                                        </div>
                                        <div class="sidebar_subtitle"><h3 id="1st_spec2"></h3></div>
                                        <div class="col-sm-12">
                                            <span class="slide007_ans"></span>
                                            <span class="slide7_ans"></span>
                                        </div>
                                        <div class="sidebar_subtitle"><h3 id="1st_spec3"></h3></div>
                                        <div class="col-sm-12">
                                            <span class="slide8_ans"></span>
                                            <span class="slide9_ans"></span>

                                            <span class="slide11_ans"></span>
                                            <span class="slide12_ans"></span>
                                            <span class="slide0012_ans"></span>
                                            <span class="slide1112_ans"></span>
                                            <span class="slide2212_ans"></span>
                                            <span class="slide3312_ans"></span>
                                            <span class="slide4412_ans"></span>
                                            <span class="slide17_ans"></span>
                                            <span class="slide0017_ans"></span>
                                            <span class="slide1117_ans"></span>
                                            <span class="slide18_ans"></span>
                                            <span class="slide018_ans"></span>
                                            <span class="slide118_ans"></span>
                                        </div>
                                        <div class="sidebar_subtitle"><h3 id="1st_spec4"></h3></div>
                                        <div class="col-sm-12">
                                            <span class="slide19_ans"></span>
                                            <span class="slide019_ans"></span>
                                            <span class="slide20_ans"></span>
                                        </div>
                                        <div class="sidebar_subtitle"><h3 id="1st_spec5"></h3></div>
                                        <div class="col-sm-12">
                                            <span class="slide21_ans"></span>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    echo $html_response;
                                }
                            } else {
                                ?>
                                <div id="bcc_answers">
                                    <div class="sidebar_subtitle"><h3 id="1st_spec1"></h3></div>
                                    <div class="col-sm-12">
                                        <span class="slide012_ans"></span>
                                        <span class="slide022_ans"></span>
                                        <span class="slide1_ans"></span>
                                        <span class="slide2_ans"></span>
                                        <span class="slide3_ans"></span>
                                        <span class="slide4_ans"></span>
                                        <span class="slide5_ans"></span>
                                        <span class="slide6_ans"></span>
                                        <span class="slide006_ans"></span>
                                    </div>
                                    <div class="sidebar_subtitle"><h3 id="1st_spec2"></h3></div>
                                    <div class="col-sm-12">
                                        <span class="slide007_ans"></span>
                                        <span class="slide7_ans"></span>
                                    </div>
                                    <div class="sidebar_subtitle"><h3 id="1st_spec3"></h3></div>
                                    <div class="col-sm-12">
                                        <span class="slide8_ans"></span>
                                        <span class="slide9_ans"></span>

                                        <span class="slide11_ans"></span>
                                        <span class="slide12_ans"></span>
                                        <span class="slide0012_ans"></span>
                                        <span class="slide1112_ans"></span>
                                        <span class="slide2212_ans"></span>
                                        <span class="slide3312_ans"></span>
                                        <span class="slide4412_ans"></span>
                                        <span class="slide17_ans"></span>
                                        <span class="slide0017_ans"></span>
                                        <span class="slide1117_ans"></span>
                                        <span class="slide18_ans"></span>
                                        <span class="slide018_ans"></span>
                                        <span class="slide118_ans"></span>
                                    </div>
                                    <div class="sidebar_subtitle"><h3 id="1st_spec4"></h3></div>
                                    <div class="col-sm-12">
                                        <span class="slide19_ans"></span>
                                        <span class="slide019_ans"></span>
                                        <span class="slide20_ans"></span>
                                    </div>
                                    <div class="sidebar_subtitle"><h3 id="1st_spec5"></h3></div>
                                    <div class="col-sm-12">
                                        <span class="slide21_ans"></span>
                                    </div>
                                </div>
<?php } ?>
                        </div>

                    </div>
                </div>

            </div>



        </div>

    </section>


    <a id='slide_02' href="#slide-2">  </a>
    <a id='slide_03' href="#slide-3">  </a>
    <a id='slide_04' href="#slide-4">  </a>
    <a id='slide_05' href="#slide-5">  </a>
    <a id='slide_06' href="#slide-6">  </a>
    <a id='slide_006' href="#slide-006">  </a>
    <a id='slide_12' href="#slide-12">  </a>
    <a id='slide_0012' href="#slide-0012">  </a>
    <a id='slide_1112' href="#slide-1112">  </a>
    <a id='slide_2212' href="#slide-2212">  </a>
    <a id='slide_3312' href="#slide-3312">  </a>
    <a id='slide_4412' href="#slide-4412">  </a>
    <a id='slide_0017' href="#slide-0017">  </a>
    <a id='slide_1117' href="#slide-1117">  </a>
    <a id='slide_118' href="#slide-118">  </a>
    <a id='slide_019' href="#slide-019">  </a>
    <a id='slide_20' href="#slide-20">  </a>
    <?php
    if ($this->uri->segment(4) != '') {
        echo "</form>";
    }
    ?>
