
<style>
    button.cus_btn {
        font-size: 27px !important;
        background: black !important;
        color: white !important;
        padding: 9px !important;
        border-radius: 7px !important;
    }
</style>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$get_record = get_basal_cell_dataset_record();
$side_menu_state = " hidden ";
$btn_label = "Save";
$dataset_record_id = "";
if ($this->uri->segment(4) != '') {
    $get_record = get_breast_cancer_dataset_record($this->uri->segment(4));
    if (!empty($get_record)) {
//        _print_r($get_record);
        $side_menu_state = "";
        $btn_label = "Update";
        $dataset_record_id = $get_record[0]['bcc_dataset_record_id'];
    } else {
        $side_menu_state = " hidden ";
        $btn_label = "Save";
        $dataset_record_id = "";
    }
    ?>
    <form action="<?php echo  site_url('_dataset/basal_cell_dataset/save_record') ?>" method="post" accept-charset="utf-8">
        <input type="hidden" value="<?php echo  $this->uri->segment(4) ?>" name="record_id">
        <input type="hidden" value="<?php echo  $dataset_record_id ?>" name="dataset_record_id">
    <?php }
    ?>

    <div class="page-header">
        <div class="row">
            <div class="col-sm-8">
                <h3 class="page-title">Dataset</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Dataset</li>
                </ul>
            </div>
            <div class="col-sm-4 text-right">
                <?php if ($this->uri->segment(4) != '') { ?>
                    <a href="<?php echo  site_url('doctor/doctor_record_detail_old/' . $this->uri->segment(4)) ?>" class="btn btn-dark"><i class="fa fa-arrow-circle-left"></i> Back to Case</a>
                <?php } else { ?>
                    <a href="<?php echo  site_url('_dataset/dataset/dashboard') ?>" class="btn btn-dark"><i class="fa fa-arrow-circle-left"></i> Back to Dataset Performas</a>
                <?php } ?>
            </div>
        </div>
    </div>

    <section>

        <h3 class="text-center"><?php echo  $this->uri->segment(4) == '' ? '-- PROFORMA / SAMPLE --' : 'Record# ' . $this->uri->segment(4) ?></h3>

        <div class="row">

            <div class="col-md-3">
                <div style="">
                    <div class="col-sm-12 form-group">
                        <div class="sidebar_title">
                            <input type="hidden" name="dataset_type" value="Bacal Cell">
                            Basal Cell | <input id='dataset_title' name="dataset_title" type="text" value="<?php echo  $btn_label == 'Update' && $get_record[0]['bcc_dataset_title'] != '' ? $get_record[0]['bcc_dataset_title'] : 'Dataset' ?>" onchange="return changeTitle();"> <i class="fa fa-pencil"> </i></div>

                        <h3 style="padding-top:20px">Basal Cell <span id='dataset_title_view'>Dataset</span></h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="faq-card">
                                <div class="card mb-1">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            Clinical data
                                        </h4>
                                    </div>
                                    <div id="" style="">
                                        <div class="card-body">
                                            <ul class="list-unstyled">
                                                <li><span class="fa fa-check <?php echo  $side_menu_state ?> slide012_stat success"></span><a id='slide_0102' href="#slide-012"> Clinical Site </a></li>
                                                <li><span class="fa fa-check <?php echo  $side_menu_state ?> slide022_stat success"></span><a id='slide_1202' href="#slide-022"> Maximum clinical dimension/diameter </a></li>                                                                                           <li><span class="fa fa-check <?php echo  $side_menu_state ?> slide1_stat success"></span><a id='slide_01' href="#slide-1"> Specimen type </a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="faq-card">
                                <div class="card mb-1">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            Macroscopic description
                                        </h4>
                                    </div>
                                    <div id="" style="">
                                        <div class="card-body">
                                            <ul class="list-unstyled">                                                                                                <li><span class="fa fa-check <?php echo  $side_menu_state ?> slide007_stat success"></span><a id='slide_007' href="#slide-007"> Dimension of specimen:  </a></li>
                                                <ul class="list-unstyled">                                                                                                <li><span class="fa fa-check <?php echo  $side_menu_state ?> slide7_stat success"></span><a id='slide_07' href="#slide-7"> Maximum dimension/diameter of lesion†:  </a></li>
                                                </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="faq-card">
                                <div class="card mb-1">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            Histological data
                                        </h4>
                                    </div>
                                    <div id="" style="">
                                        <div class="card-body">
                                            <ul class="list-unstyled">                                                                                                <li><span class="fa fa-check <?php echo  $side_menu_state ?> slide8_stat success"></span><a id='slide_08' href="#slide-8"> Low risk subtype:  </a></li>
                                                <li><span class="fa fa-check <?php echo  $side_menu_state ?> slide9_stat success"></span><a id='slide_09' href="#slide-9"> OR high risk if present:  </a></li>
                                                <li><span class="fa fa-check <?php echo  $side_menu_state ?> slide11_stat success"></span><a id='slide_11' href="#slide-11"> Deep invasion </a></li>
<!--                                                <li><span class="fa fa-check <?php echo  $side_menu_state ?> slide12_stat success"></span><a id='slide_12' href="#slide-12"> Thickness >6 mm    </a></li>
                                                <li><span class="fa fa-check <?php echo  $side_menu_state ?> slide13_stat success"></span><a id='slide_13' href="#slide-13"> Level of invasion beyond subcutaneous fat   </a></li>-->
                                                <li><span class="fa fa-check <?php echo  $side_menu_state ?> slide14_stat success"></span><a id='slide_14' href="#slide-14"> Minor bone erosion   </a></li>
                                                <li><span class="fa fa-check <?php echo  $side_menu_state ?> slide15_stat success"></span><a id='slide_15' href="#slide-15"> Gross cortical/marrow invasion </a></li>
                                                <li><span class="fa fa-check <?php echo  $side_menu_state ?> slide16_stat success"></span><a id='slide_16' href="#slide-16"> Axial/skull base/foraminal invasion   </a></li>

                                                <li><span class="fa fa-check <?php echo  $side_menu_state ?> slide17_stat success"></span><a id='slide_17' href="#slide-17"> Perineural invasion   </a></li>
                                                <li><span class="fa fa-check <?php echo  $side_menu_state ?> slide18_stat success"></span><a id='slide_18' href="#slide-18"> Lymphovascular invasion   </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="faq-card">
                                <div class="card mb-1">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            Maximum dimension/diameter of lesion
                                        </h4>
                                    </div>
                                    <div id="" style="">
                                        <div class="card-body">
                                            <ul class="list-unstyled">                                                                                                <li><span class="fa fa-check <?php echo  $side_menu_state ?> slide19_stat success"></span><a id='slide_19' href="#slide-19"> Indicate which used: </a></li>
                                                <ul class="list-unstyled">                                                                                                <li><span class="fa fa-check <?php echo  $side_menu_state ?> slide20_stat success"></span><a id='slide_20' href="#slide-20"> Dimension </a></li>
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

                <div class="row surgical_specimen_selection  ">
                    <div class="col-md-12 card" style="    margin-top: 55px;">
                        <div class="card-body">
                            <div class="slides">
                                <div id="slide-012">
                                    <div class="row form-group radio-toolbar histological_calcification text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Clinical site</h3>
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" id="clinicalsite" name="clinicalsite" value="<?php echo  $btn_label == 'Update' && $get_record[0]['n_bcc_clinicalsite'] != '' ? $get_record[0]['n_bcc_clinicalsite'] : '' ?>"   >
                                            <br><button class="cus_btn" id="clinicalsite_btn">Next</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="slide-022">
                                    <div class="row form-group radio-toolbar histological_calcification text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Clinical site</h3>
                                            <h4>Other</h4>
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" id="clinicaldimention" name="clinicaldimention" value="<?php echo  $btn_label == 'Update' && $get_record[0]['n_bcc_clinicaldimention'] != '' ? $get_record[0]['n_bcc_clinicaldimention'] : '' ?>"   > <span style="font-size:20px">(mm)</span>
                                            <br><button class="cus_btn" id="clinicaldimention_btn">Next</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="slide-1">
                                    <div class="row form-group radio-toolbar specimen_type_main text-center">
                                        <div class="col-md-12  text-center">
                                            <h3>Clinical site</h3>
                                            <h4>Specimen type†:</h4>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="radioNotstated" name="Specimen_type" value="Not stated" <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Specimen_type'] == 'Not stated' ? 'checked' : '' ?> >
                                            <label for="radioNotstated">Not stated</label>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="radio" id="radioIncision" name="Specimen_type" value="Incision" <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Specimen_type'] == 'Incision' ? 'checked' : '' ?> >
                                            <label for="radioIncision">Incision</label>
                                        </div>


                                        <div class="col-md-4">
                                            <input type="radio" id="radioPunch" name="Specimen_type" value="Punch" <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Specimen_type'] == 'Punch' ? 'checked' : '' ?> >
                                            <label for="radioPunch">Punch</label>
                                        </div>


                                        <div class="col-md-4">
                                            <input type="radio" id="radioCurettings" name="Specimen_type" value="Curettings" <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Specimen_type'] == 'Curettings' ? 'checked' : '' ?> >
                                            <label for="radioCurettings">Curettings</label>
                                        </div>


                                        <div class="col-md-4">
                                            <input type="radio" id="radioShave" name="Specimen_type" value="Shave" <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Specimen_type'] == 'Shave' ? 'checked' : '' ?> >
                                            <label for="radioShave">Shave</label>
                                        </div>


                                        <div class="col-md-4">
                                            <input type="radio" id="radioOther" name="Specimen_type" value="Other" <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Specimen_type'] == 'Other' ? 'checked' : '' ?> >
                                            <label for="radioOther">Other</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="slide-2">
                                    <div class="row form-group radio-toolbar specimen_type_main  text-center">
                                        <div class="col-md-12  text-center">
                                            <h3>Clinical site</h3>
                                            <h4>Incision</h4>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="radio" id="Incision" name="Incision" value="Diagnostic"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Incision'] == 'Diagnostic' ? 'checked' : '' ?> >
                                            <label for="Incision">Diagnostic</label>
                                        </div>

                                    </div>
                                </div>
                                <div id="slide-3">
                                    <div class="row form-group radio-toolbar specimen_radio_seen  text-center">
                                        <div class="col-md-12  text-center">
                                            <h3>Clinical site</h3>
                                            <h4>Excision</h4>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Excision_Diagnostic" name="Excision" value="Diagnostic"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Excision'] == 'Diagnostic' ? 'checked' : '' ?> >
                                            <label for="Excision_Diagnostic">Diagnostic</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Excision_Therapeutic" name="Excision" value="Therapeutic"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Excision'] == 'Therapeutic' ? 'checked' : '' ?> >
                                            <label for="Excision_Therapeutic">Therapeutic</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Excision_Uncertain" name="Excision" value="Uncertain"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Excision'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <label for="Excision_Uncertain">Uncertain</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Excision_Re-excision" name="Excision" value="Re-excision"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Excision'] == 'Re-excision' ? 'checked' : '' ?> >
                                            <label for="Excision_Re-excision">Re-excision</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Excision_Wider" name="Excision" value="Wider local excision"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Excision'] == 'Wider local excision' ? 'checked' : '' ?> >
                                            <label for="Excision_Wider">Wider local excision</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="slide-4">
                                    <div class="row form-group radio-toolbar memo_absormality text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Clinical site</h3>
                                            <h4>Punch</h4>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Punch_Diagnostic" name="Punch" value="Diagnostic"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Punch'] == 'Diagnostic' ? 'checked' : '' ?> >
                                            <label for="Punch_Diagnostic">Diagnostic</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Punch_Therapeutic" name="Punch" value="Therapeutic"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Punch'] == 'Therapeutic' ? 'checked' : '' ?> >
                                            <label for="Punch_Therapeutic">Therapeutic</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Punch_Uncertain" name="Punch" value="Uncertain"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Punch'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <label for="Punch_Uncertain">Uncertain</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="slide-5">
                                    <div class="row form-group radio-toolbar core_biopsy_seen text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Clinical site</h3>
                                            <h4>Curettings</h4>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Curettings_Diagnostic" name="Curettings" value="Diagnostic"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Curettings'] == 'Diagnostic' ? 'checked' : '' ?> >
                                            <label for="Curettings_Diagnostic">Diagnostic</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Curettings_Therapeutic" name="Curettings" value="Therapeutic"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Curettings'] == 'Therapeutic' ? 'checked' : '' ?> >
                                            <label for="Curettings_Therapeutic">Therapeutic</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Curettings_Uncertain" name="Curettings" value="Uncertain"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Curettings'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <label for="Curettings_Uncertain">Uncertain</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="slide-6">
                                    <div class="row form-group radio-toolbar histological_calcification text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Clinical site</h3>
                                            <h4>Shave</h4>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Shave_Diagnostic" name="Shave" value="Diagnostic"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Shave'] == 'Diagnostic' ? 'checked' : '' ?> >
                                            <label for="Shave_Diagnostic">Diagnostic</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Shave_Therapeutic" name="Shave" value="Therapeutic"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Shave'] == 'Therapeutic' ? 'checked' : '' ?> >
                                            <label for="Shave_Therapeutic">Therapeutic</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Shave_Uncertain" name="Shave" value="Uncertain"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Shave'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <label for="Shave_Uncertain">Uncertain</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="slide-006">
                                    <div class="row form-group radio-toolbar histological_calcification text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Clinical site</h3>
                                            <h4>Other</h4>
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" id="CDOther" name="CDOther" value="<?php echo  $btn_label == 'Update' && $get_record[0]['n_bcc_CDOther'] != '' ? $get_record[0]['n_bcc_CDOther'] : '' ?>"   >
                                            <br><button class="cus_btn" id="CDOther_btn">Next</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="slide-007">
                                    <div class="row form-group radio-toolbar histological_calcification text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Macroscopic description</h3>
                                            <h4>Dimension of specimen</h4>
                                            <hr>
                                        </div>
                                        <div class="col-md-4">
                                            <span style="font-size:20px">Length</span> <input type="text" id="specimendimention1" name="specimendimention1" value="<?php echo  $btn_label == 'Update' && $get_record[0]['n_bcc_clinicaldimention'] != '' ? $get_record[0]['n_bcc_specimendimention1'] : '' ?>"   > <span style="font-size:20px">(mm)</span>
                                        </div>
                                        <div class="col-md-4">
                                            <span style="font-size:20px">Breadth</span><input type="text" id="specimendimention2" name="specimendimention2" value="<?php echo  $btn_label == 'Update' && $get_record[0]['n_bcc_clinicaldimention'] != '' ? $get_record[0]['n_bcc_specimendimention2'] : '' ?>"   > <span style="font-size:20px">(mm)</span>
                                        </div>
                                        <div class="col-md-4">
                                            <span style="font-size:20px">Depth</span><input type="text" id="specimendimention3" name="specimendimention3" value="<?php echo  $btn_label == 'Update' && $get_record[0]['n_bcc_clinicaldimention'] != '' ? $get_record[0]['n_bcc_specimendimention3'] : '' ?>"   > <span style="font-size:20px">(mm)</span>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <button class="cus_btn" id="specimendimention_btn">Next</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="slide-7">
                                    <div class="row form-group radio-toolbar Benign_lesions text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Macroscopic description </h3>
                                            <h4>Maximum dimension/diameter of lesion†: </h4>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" id="Macroscopic_description" name="MDMacroscopic_description" value="<?php echo  $btn_label == 'Update' && $get_record[0]['n_bcc_MDMacroscopic_description'] != '' ? $get_record[0]['n_bcc_MDMacroscopic_description'] : '' ?>"   >  <span style="font-size:20px">(mm)</span>
                                        </div>
                                        <br><br><br>
                                        <div class="col-md-6">
                                            <input type="radio" id="Macroscopic_Uncertain" name="Macroscopic" value="Uncertain"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Macroscopic'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <label for="Macroscopic_Uncertain">Uncertain</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Macroscopic_No_lesion" name="Macroscopic" value="No lesion seen"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Macroscopic'] == 'No lesion seen' ? 'checked' : '' ?> >
                                            <label for="Macroscopic_No_lesion">No lesion seen</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="slide-8">
                                    <div class="row form-group radio-toolbar Epithelial_proliferation text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Histological data </h3>
                                            <h5>Low risk subtype:</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Histological_Superficial" name="Histological_low" value="Superficial"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Histological_low'] == 'Superficial' ? 'checked' : '' ?> >
                                            <label for="Histological_Superficial">Superficial</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Histological_Fibroepithelial" name="Histological_low" value="Superficial"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Histological_low'] == 'Fibroepithelial' ? 'checked' : '' ?> >
                                            <label for="Histological_Fibroepithelial">Fibroepithelial</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Histological_Nodular" name="Histological_low" value="Nodular"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Histological_low'] == 'Nodular' ? 'checked' : '' ?> >
                                            <label for="Histological_Nodular">Nodular</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="slide-9">
                                    <div class="row form-group radio-toolbar Invasive_carcinoma text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Histological data </h3>
                                            <h3>OR high risk if present: </h3>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Histological_Infiltrative" name="Histological_high" value="Infiltrative"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Histological_high'] == 'Infiltrative' ? 'checked' : '' ?> >
                                            <label for="Histological_Infiltrative">Infiltrative (infiltrating/sclerosing/micronodular)</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="Histological_Basosquamous" name="Histological_high" value="Basosquamous carcinoma"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Histological_high'] == 'Basosquamous carcinoma' ? 'checked' : '' ?> >
                                            <label for="Histological_Basosquamous">Basosquamous carcinoma</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="slide-11">
                                    <div class="row form-group radio-toolbar text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Histological data </h3>
                                            <h3>For pure superficial basal cell carcinoma, invasive entries can be omitted </h3>
                                            <h5>Deep invasion</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_Present" name="n_Histological_Present" value="Present"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_bcc_Histological_Present'] == 'Present' ? 'checked' : '' ?> >
                                            <label for="n_Histological_Present">Present</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_NOTPresent" name="n_Histological_Present" value="Not Identified"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_bcc_Histological_Present'] == 'Not Identified' ? 'checked' : '' ?> >
                                            <label for="n_Histological_NOTPresent">Not Identified</label>
                                        </div>
                                    </div>
                                </div>
                                
                                                                <div id="slide-12">
                                    <div class="row form-group radio-toolbar text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Histological data </h3>
                                            <h3>For pure superficial basal cell carcinoma, invasive entries can be omitted </h3>
                                            <h5>Deep invasion : Thickness >6 mm</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_thickness_Present" name="n_Histological_thickness_Present" value="Present"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_bcc_Histological__thickness_Present'] == 'Present' ? 'checked' : '' ?> >
                                            <label for="n_Histological_thinkness_Present">Present</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_thickness_NOTPresent" name="n_Histological_thickness_Present" value="Not Identified"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_bcc_Histological_thickness_Present'] == 'Not Identified' ? 'checked' : '' ?> >
                                            <label for="n_Histological_thickness_NOTPresent">Not Identified</label>
                                        </div>
                                        
                                        
                                        <div class="col-md-12  text-center">
                                            <h5>Level of invasion beyond subcutaneous fat</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_fat_Present" name="n_Histological_fat_Present" value="Present"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_bcc_Histological_fat_Present'] == 'Present' ? 'checked' : '' ?> >
                                            <label for="n_Histological_fat_Present">Present</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_fat_NOTPresent" name="n_Histological_fat_Present" value="Not Identified"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_bcc_Histological_fat_Present'] == 'Not Identified' ? 'checked' : '' ?> >
                                            <label for="n_Histological_fat_NOTPresent">Not Identified</label>
                                        </div>
                                        
                                           
                                        
                                        <div class="col-md-12  text-center">
                                            <h5>Specify tissue</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_Fascia" name="n_Histological_Specify_tissue" value="Fascia"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_Histological_Specify_tissue'] == 'Fascia' ? 'checked' : '' ?> >
                                            <label for="n_Histological_Fascia">Fascia</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_Muscle" name="n_Histological_Specify_tissue" value="Muscle"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_Histological_Specify_tissue'] == 'Perichondrium' ? 'checked' : '' ?> >
                                            <label for="n_Histological_Muscle">Muscle</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_Perichondrium" name="n_Histological_Specify_tissue" value="Perichondrium"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_Histological_Specify_tissue'] == 'Perichondrium' ? 'checked' : '' ?> >
                                            <label for="n_Histological_Perichondrium">Perichondrium</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_Cartilage" name="n_Histological_Specify_tissue" value="Cartilage"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_Histological_Specify_tissue'] == 'Cartilage' ? 'checked' : '' ?> >
                                            <label for="n_Histological_Cartilage">Cartilage</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_Paratendon-tendon" name="n_Histological_Specify_tissue" value="Paratendon-tendon"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_Histological_Specify_tissue'] == 'Paratendon-tendon' ? 'checked' : '' ?> >
                                            <label for="n_Histological_Paratendon-tendon">Paratendon/tendon</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_Periosteum" name="n_Histological_Specify_tissue" value="Periosteum"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_Histological_Specify_tissue'] == 'Periosteum' ? 'checked' : '' ?> >
                                            <label for="n_Histological_Periosteum">Periosteum</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_Histological_Bone" name="n_Histological_Specify_tissue" value="Bone"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_Histological_Specify_tissue'] == 'Bone' ? 'checked' : '' ?> >
                                            <label for="n_Histological_Bone">Bone</label>
                                        </div>
                                        
                                        
                                        <div class="col-md-12  text-center">
                                            <h4>If bone invasion present</h4>
                                            <h5>Minor bone erosion </h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_minor1" name="n_bone_minor" value="Present"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_bone_minor'] == 'Present' ? 'checked' : 'Present' ?> >
                                            <label for="n_bone_minor1">Present</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_minor2" name="n_bone_minor" value="Not identified"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_bone_minor'] == 'Not identified' ? 'checked' : '' ?> >
                                            <label for="n_bone_minor2">Not identified</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_minor3" name="n_bone_minor" value="Uncertain"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_bone_minor'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <label for="n_bone_minor3">Uncertain</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_minor4" name="n_bone_minor" value="Cannot be assessed "  <?php echo  $btn_label == 'Update' && $get_record[0]['n_bone_minor'] == 'Cannot be assessed ' ? 'checked' : '' ?> >
                                            <label for="n_bone_minor4">Cannot be assessed </label>
                                        </div>
                                        
                                        <div class="col-md-12  text-center">
                                            <h5>Gross cortical/marrow invasion</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_gross1" name="n_bone_gross" value="Present"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_bone_gross'] == 'Present' ? 'checked' : 'Present' ?> >
                                            <label for="n_bone_gross1">Present</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_gross2" name="n_bone_gross" value="Not identified"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_bone_gross'] == 'Not identified' ? 'checked' : '' ?> >
                                            <label for="n_bone_gross2">Not identified</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_gross3" name="n_bone_gross" value="Uncertain"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_bone_gross'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <label for="n_bone_gross3">Uncertain</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_gross4" name="n_bone_minor" value="Cannot be assessed "  <?php echo  $btn_label == 'Update' && $get_record[0]['n_bone_minor'] == 'Cannot be assessed ' ? 'checked' : '' ?> >
                                            <label for="n_bone_gross4">Cannot be assessed </label>
                                        </div>
                                        
                                        <div class="col-md-12  text-center">
                                            <h5>Axial/skull base/foraminal invasion</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_foraminal1" name="n_bone_foraminal" value="Present"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_bone_foraminal'] == 'Present' ? 'checked' : 'Present' ?> >
                                            <label for="n_bone_foraminal1">Present</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_foraminal2" name="n_bone_foraminal" value="Not identified"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_bone_foraminal'] == 'Not identified' ? 'checked' : '' ?> >
                                            <label for="n_bone_foraminal2">Not identified</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_foraminal3" name="n_bone_foraminal" value="Uncertain"  <?php echo  $btn_label == 'Update' && $get_record[0]['n_bone_foraminal'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <label for="n_bone_foraminal3">Uncertain</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="n_bone_foraminal4" name="n_bone_foraminal" value="Cannot be assessed "  <?php echo  $btn_label == 'Update' && $get_record[0]['n_bone_foraminal'] == 'Cannot be assessed ' ? 'checked' : '' ?> >
                                            <label for="n_bone_foraminal4">Cannot be assessed </label>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                
                                <div id="slide-19">
                                    <div class="row form-group radio-toolbar Invasive_carcinoma text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Maximum dimension/diameter of lesion </h3>
                                            <h3>Indicate which used: </h3>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Maximum_Clinical" name="Maximum_Indicate" value="Clinical"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Maximum_Indicate'] == 'Clinical' ? 'checked' : '' ?> >
                                            <label for="Maximum_Clinical">Clinical</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Maximum_OR_Macroscopic" name="Maximum_Indicate" value="OR Macroscopic"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Maximum_Indicate'] == 'OR Macroscopic' ? 'checked' : '' ?> >
                                            <label for="Maximum_OR_Macroscopic">OR Macroscopic</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Maximum_OR_Microscopic" name="Maximum_Indicate" value="OR Microscopic"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Maximum_Indicate'] == 'OR Microscopic' ? 'checked' : '' ?> >
                                            <label for="Maximum_OR_Microscopic">OR Microscopic</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="slide-20">
                                    <div class="row form-group radio-toolbar Invasive_carcinoma text-center ">
                                        <div class="col-md-12  text-center">
                                            <h3>Maximum dimension/diameter of lesion </h3>
                                            <h3>Dimension†</h3>
                                            <h5>Select single option from the list below</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Maximum_20" name="Maximum_Dimention" value="≤20 mm"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Maximum_Dimention'] == '≤20 mm' ? 'checked' : '' ?> >
                                            <label for="Maximum_20">≤20 mm</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Maximum_20_40" name="Maximum_Dimention" value=">20 – ≤40 mm"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Maximum_Dimention'] == '>20 – ≤40 mm' ? 'checked' : '' ?> >
                                            <label for="Maximum_20_40">>20 – ≤40 mm</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Maximum_40" name="Maximum_Dimention" value=">40 mm"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Maximum_Dimention'] == '>40 mm' ? 'checked' : '' ?> >
                                            <label for="Maximum_40">>40 mm</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Maximum_Uncertain" name="Maximum_Dimention" value="Uncertain"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Maximum_Dimention'] == 'Uncertain' ? 'checked' : '' ?> >
                                            <label for="Maximum_Uncertain">Uncertain</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" id="Maximum_Cannot" name="Maximum_Dimention" value="Cannot be assessed"  <?php echo  $btn_label == 'Update' && $get_record[0]['bcc_Maximum_Dimention'] == 'Cannot be assessed' ? 'checked' : '' ?> >
                                            <label for="Maximum_Cannot">Cannot be assessed</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if ($this->uri->segment(4) != '') { ?>
                                <div class="row pull-right" style="padding-top:30px">
                                    <input type="submit" class="btn btn-lg btn-success" value="<?php echo  $btn_label ?> Record">
                                </div>
                            <?php } ?>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-3"  id="section-to-print" style="margin-top:55px;">

                <div class="card col-md-12">
                    <div class="car-body pt-15">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <?php if ($this->uri->segment(4) == '') { ?>
                                    <h4>Info of Record (This is sample)</h4>
                                <?php } else {
                                    ?>
                                    <fieldset>
                                        <div class="form-group">
                                            <span
                                                class="tg-namelogo text-center" style="position: absolute"><?php echo urldecode($this->uri->segment(5)); ?></span>
                                            <div class="tg-nameandtrack" style="padding-left: 60px;">
                                                <h3><?php echo urldecode($this->uri->segment(6)); ?>
                                                </h3>
                                                <span><?php echo urldecode($this->uri->segment(7)); ?>
                                                    <em>|</em>
                                                    <em><?php echo urldecode($this->uri->segment(8)); ?></em>
                                                </span>
                                            </div>
                                        </div>
                                    </fieldset>
                                <?php } ?>
                                <hr>
                                <div class="sidebar_title">Dataset BCC</div>
                            </div>


                            <?php if ($btn_label == 'Update') { ?>




                                <div class="sidebar_subtitle"><h3 id="1st_spec1">- Specimen type</h3></div>
                                <div class="col-sm-12">
                                    <span class="slide1_ans"><div class="sidebar_subtitle">Specimen type : <span><?php echo  $get_record[0]['bcc_Specimen_type'] ?></span></div></span>
                                    <span class="slide2_ans"><div class="sidebar_subtitle">Incision : <span><?php echo  $get_record[0]['bcc_Incision'] ?></span></div></span>
                                    <span class="slide3_ans"><div class="sidebar_subtitle">Excision : <span><?php echo  $get_record[0]['bcc_Excision'] ?></span></div></span>
                                    <span class="slide4_ans"><div class="sidebar_subtitle">Punch : <span><?php echo  $get_record[0][''] ?></span></div></span>
                                    <span class="slide5_ans"><div class="sidebar_subtitle">Curettings : <span><?php echo  $get_record[0]['bcc_Punch'] ?></span></div></span>
                                    <span class="slide6_ans"><div class="sidebar_subtitle">Shave : <span><?php echo  $get_record[0]['bcc_Curettings'] ?></span></div></span>
                                </div>
                                <div class="sidebar_subtitle"><h3 id="1st_spec2">- Macroscopic Description</h3></div>
                                <div class="col-sm-12">
                                    <span class="slide7_ans"><div class="sidebar_subtitle">Macroscopic Description : <span><?php echo  $get_record[0]['bcc_Shave'] ?></span></div></span>
                                </div>
                                <div class="sidebar_subtitle"><h3 id="1st_spec3">- Histological data</h3></div>
                                <div class="col-sm-12">
                                    <span class="slide8_ans"><div class="sidebar_subtitle">Histological data : <span><?php echo  $get_record[0]['bcc_Macroscopic'] ?></span></div></span>
                                    <span class="slide9_ans"><div class="sidebar_subtitle">Histological data : <span><?php echo  $get_record[0]['bcc_Histological_low'] ?></span></div></span>
                                </div>
                                <div class="sidebar_subtitle"><h3 id="1st_spec4">- Maximum dimension/diameter of lesion</h3></div>
                                <div class="col-sm-12">
                                    <span class="slide19_ans"><div class="sidebar_subtitle">Indicate which used: : <span><?php echo  $get_record[0]['bcc_Maximum_Indicate'] ?></span></div></span>
                                    <span class="slide20_ans"><div class="sidebar_subtitle">Dimention : <span><?php echo  $get_record[0]['bcc_Maximum_Dimention'] ?></span></div></span>
                                </div>

                            </div>
                        <?php } else { ?>

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
                                <span class="slide13_ans"></span>
                                <span class="slide14_ans"></span>
                                <span class="slide15_ans"></span>
                                <span class="slide16_ans"></span>
                                <span class="slide17_ans"></span>
                                <span class="slide18_ans"></span>
                            </div>
                            <div class="sidebar_subtitle"><h3 id="1st_spec4"></h3></div>
                            <div class="col-sm-12">
                                <span class="slide19_ans"></span>
                                <span class="slide20_ans"></span>
                            </div>
                        <?php } ?>
                    </div>

                    <a href="javascript:window.print();" class="btn btn-mg btn-warning print-btn" style="margin:10px;"> <i class="fa fa-print"></i> Print / Save as PDF</a>

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
    <?php
    if ($this->uri->segment(4) != '') {
        echo "</form>";
    }
    ?>
