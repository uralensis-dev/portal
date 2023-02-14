<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php

/**
 * Get Specimen
 *
 * @param [type] $specimen_query
 * @param [type] $request_query
 * @param [type] $record_id
 * @param [type] $get_cost_codes
 * @param [type] $opinion_data
 * @param [type] $specimen_accepted_by
 * @param [type] $specimen_assisted_by
 * @param [type] $specimen_block_checked_by
 * @param [type] $specimen_cutup_by
 * @param [type] $specimen_labeled_by
 * @param [type] $specimen_qcd_by
 * @return void
 */
function get_specimens(
        $specimen_query,
        $request_query,
        $record_id,
        $get_cost_codes,
        $opinion_data,
        $specimen_accepted_by,
        $specimen_assisted_by,
        $specimen_block_checked_by,
        $specimen_cutup_by,
        $specimen_labeled_by,
        $specimen_qcd_by,
        $slide_data, $specimen_blocks) {

//    echo "<pre>";print_r($specimen_query);exit;
    $button_disable = '';
    if (!empty($opinion_data[0]->ura_opinion_req_id) && $record_id == $opinion_data[0]->ura_opinion_req_id) {
        $button_disable = 'disabled';
    }


    /* Snomed T Code */
// require_once('application/views/doctor/inc/snomed/snomed-t-code.php');
// /* Snomed P Code */
// require_once('application/views/doctor/inc/snomed/snomed-p-code.php');
// /* Snomed M Code */
// require_once('application/views/doctor/inc/snomed/snomed-m-code.php');

    $user_id = getRecordAssignUserID($request_query[0]->uralensis_request_id);

    $micro_perm = getUserPermission($user_id, 'micro_perm');

    $initial = uralensis_get_user_data($request_query[0]->uralensis_request_id, 'initial');
    $fullname = uralensis_get_user_data($request_query[0]->uralensis_request_id, 'fullname');
    $serial_number = uralensis_get_record_db_detail($request_query[0]->uralensis_request_id, 'serial_number');
    $ura_barcode_no = uralensis_get_record_db_detail($request_query[0]->uralensis_request_id, 'ura_barcode_no');
    $CI = &get_instance();
    $html_response = '';
    $get_bcc_record = get_bcc_dataset_record($CI->uri->segment(3), '');
    $get_breast_cancer_record = get_breast_cancer_dataset_record($CI->uri->segment(3), '');
    $ura_dob = date('d-m-Y', strtotime($request_query[0]->dob));
    $ura_nhs = $request_query[0]->nhs_number;
    $ura_gender = $request_query[0]->gender;
    $labNo = $request_query[0]->lab_number;
    $dataset_url = '/dashboard/' . $CI->uri->segment(3) . '/' . urlencode($initial) . '/' . urlencode($fullname) . '/' . urlencode($serial_number) . '/' . urlencode($ura_barcode_no) . '/' . urlencode($ura_dob) . '/' . urlencode($ura_nhs) . '/' . urlencode($ura_gender) . '/' . urlencode($labNo);
    $pdf_url = '/_dataset/gen_pdf/index/' . $CI->uri->segment(3) . '/' . urlencode($initial) . '/' . urlencode($fullname) . '/' . urlencode($serial_number) . '/' . urlencode($ura_barcode_no) . '/' . urlencode($ura_dob) . '/' . urlencode($ura_nhs) . '/' . urlencode($ura_gender) . '/' . urlencode($labNo);
    ?>


    <style>
        .padding-bottom{
            padding-bottom: 20px;
        }
    </style>
    <div class="tg-inputshold specimen_content">

        <div class="delete_add_specimen">
            <a href="javascript:;" class="tg-detailsicon add_specimen tg-themeiconcolorone" data-toggle="modal"
               data-target="#add_specimen_modal">
                <i class="ti-plus"></i>
            </a>
            <a href="javascript:;" class="tg-detailsicon delete_specimen tg-themeiconcolortwo">
                <i class="ti-trash"></i>
            </a>
        </div>
        <div class="modal fade" id="add_specimen_modal" tabindex="-1" role="dialog" aria-hidden="true"
             data-backdrop="static">
            <div class="tg-modaldialog modal-dialog" role="document">
                <div class="tg-modalhead">
                    <a href="javascript:void(0);" class="fa fa-close tg-btnclose" data-dismiss="modal"
                       aria-label="Close"></a>
                    <div class="tg-boxtitle">
                        <h2>Add Specimen</h2>
                    </div>
                    <div class="tg-rightarea">
                        <a href="javascript:;" class="tg-btnspecimen btn-spcimen-add"><i class="fa fa-check"></i>Add
                            Specimen</a>
                    </div>
                </div>
                <div class="tg-modalbody modal-body">
                    <?php
                    $attributes = array('class' => 'tg-formtheme tg-formspecimen specimen_form');
                    echo form_open("doctor/add_specimen_doctor/" . $record_id, $attributes);
                    ?>
                    <fieldset>
                        <div class="form-group halfform-group tg-withlabel">
                            <select name="specimen_accepted_by" class="form-control selectpicker">
                                <option value="" data-hidden="true" selected>Accepted:</option>
                                <?php
                                if (!empty($specimen_accepted_by)) {
                                    foreach ($specimen_accepted_by as $key => $value) {
                                        echo '<option value="' . $value['spec_accep_by_id'] . '">' . $value['spec_accep_by_name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group halfform-group tg-withlabel">
                            <select name="specimen_cutupby" class="form-control selectpicker">
                                <option value="" data-hidden="true" selected>Cut Up:</option>
                                <?php
                                if (!empty($specimen_cutup_by)) {
                                    foreach ($specimen_cutup_by as $key => $value) {
                                        echo '<option value="' . $value['spec_cutup_by_id'] . '">' . $value['spec_cutup_by_name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group halfform-group tg-withlabel">
                            <select data-placeholder="Assisted by:" name="specimen_assisted_by"
                                    class="form-control selectpicker">
                                <option value="" data-hidden="true" selected>Assisted:</option>
                                <?php
                                if (!empty($specimen_assisted_by)) {
                                    foreach ($specimen_assisted_by as $key => $value) {
                                        echo '<option value="' . $value['spec_assis_by_id'] . '">' . $value['spec_assis_by_name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group halfform-group tg-withlabel">
                            <select data-placeholder="Block checked by:" name="specimen_block_checked_by"
                                    class="form-control selectpicker">
                                <option value="" data-hidden="true" selected>Block Checked:</option>
                                <?php
                                if (!empty($specimen_block_checked_by)) {
                                    foreach ($specimen_block_checked_by as $key => $value) {
                                        echo '<option value="' . $value['spec_block_check_id'] . '">' . $value['spec_block_check_name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group halfform-group tg-withlabel">
                            <select data-placeholder="Labelled by:" name="specimen_labeled_by"
                                    class="form-control selectpicker">
                                <option value="" data-hidden="true" selected>Labeled:</option>
                                <?php
                                if (!empty($specimen_labeled_by)) {
                                    foreach ($specimen_labeled_by as $key => $value) {
                                        echo '<option value="' . $value['spec_labeled_by_id'] . '">' . $value['spec_labeled_by_name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group halfform-group tg-withlabel">
                            <select data-placeholder="QC’d by:" name="specimen_qcd_by"
                                    class="form-control selectpicker">
                                <option value="" data-hidden="true" selected>QC’d:</option>
                                <?php
                                if (!empty($specimen_qcd_by)) {
                                    foreach ($specimen_qcd_by as $key => $value) {
                                        echo '<option value="' . $value['spec_qcd_by_id'] . '">' . $value['spec_qcd_by_name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group halfform-group tg-withlabel">
                            <select name="specimen_block" id="specimen_block" class="form-control selectpicker">
                                <option value="" data-hidden="true" selected>Blocks:</option>
                                <?php
                                if (!empty($get_cost_codes)) {
                                    foreach ($get_cost_codes as $codes) {
                                        ?>
                                        <option value="<?php echo $codes->ura_cost_code_desc; ?>">
                                            <?php echo $codes->ura_cost_code_desc; ?>
                                        </option>
                                        <?php
                                    }//endforeach
                                } else {
                                    echo '<option value="0">Please Add The Codes First.</option>';
                                }//endif
                                ?>
                            </select>
                        </div>
                        <div class="form-group halfform-group">
                            <input type="text" class="form-control" name="specimen_slides" id="date"
                                   placeholder="Specimen Slides"/>
                        </div>
                        <div class="form-group halfform-group">
                            <?php $snomed_p_array = getSnomedCodes('p'); ?>
                            <select name="specimen_snomed_p" id="specimen_snomed_p" class="form-control selectpicker"
                                    data-live-search="true">
                                <option value="" data-hidden="true" selected>P Code</option>
                                <?php
                                foreach ($snomed_p_array as $snomed_p_code) {
                                    $selected = '';
                                    $snomed_p = strtolower(str_replace(' ', '', trim($snomed_p_code['usmdcode_code'])));
                                    echo '<option data-pdesc="' . $snomed_p_code['usmdcode_code_desc'] . '" value="' . $snomed_p . '">' . $snomed_p_code['usmdcode_code'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group halfform-group">
                            <?php $snomed_t_array = getSnomedCodes('t1'); ?>
                            <select name="specimen_snomed_t1" id="specimen_snomed_t1" class="form-control selectpicker"
                                    data-live-search="true">
                                <option value="" data-hidden="true" selected>T1 Code</option>
                                <?php
                                foreach ($snomed_t_array as $snomed_t_code) {
                                    $selected = '';
                                    $snomed_t = strtolower(str_replace(' ', '', trim($snomed_t_code['usmdcode_code'])));
                                    echo '<option data-tdesc="' . $snomed_t_code['usmdcode_code_desc'] . '" value="' . $snomed_t . '">' . $snomed_t_code['usmdcode_code'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group halfform-group ">
                            <?php $snomed_t2_array = getSnomedCodes('t2'); ?>
                            <select name="specimen_snomed_t2" id="specimen_snomed_t2" class="form-control selectpicker"
                                    data-live-search="true">
                                <option value="" data-hidden="true" selected>T2 Code</option>
                                <?php
                                foreach ($snomed_t2_array as $snomed_t2_code) {
                                    $selected = '';
                                    $snomed_t = strtolower(str_replace(' ', '', trim($snomed_t2_code['usmdcode_code'])));
                                    echo '<option data-tdesc="' . $snomed_t2_code['usmdcode_code_desc'] . '" value="' . $snomed_t . '">' . $snomed_t2_code['usmdcode_code'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group halfform-group">
                            <select name="rcpath_code" class="form-control selectpicker">
                                <option value="" data-hidden="true" selected>RCPath Code</option>
                                <?php
                                $rcpath_array = array(
                                    '0' => '0',
                                    '1' => '1',
                                    '2' => '2',
                                    '3' => '3',
                                    '4' => '4',
                                    '5' => '5',
                                    '6' => '6',
                                    '7' => '7',
                                    '8' => '8',
                                    '9' => '9',
                                    '10' => '10',
                                    '11' => '11',
                                    '12' => '12',
                                    '13' => '13',
                                    '14' => '14',
                                    '15' => '15',
                                    '16' => '16',
                                    '17' => '17',
                                    '18' => '18',
                                    '19' => '19',
                                    '20' => '20'
                                );
                                foreach ($rcpath_array as $key => $rcpath_code) {
                                    echo '<option value="' . $rcpath_code . '">' . $rcpath_code . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea name="specimen_clinical_history"
                                      placeholder="Specimen Clinical  History"></textarea>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="specimen_macroscopic_description"
                                      placeholder="Specimen Macroscopic Description"></textarea>
                        </div>
                    </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="add_block_modal" tabindex="-1" role="dialog" aria-hidden="true"
             data-backdrop="static">
            <div class="tg-modaldialog modal-dialog" role="document">
                <div class="tg-modalhead">
                    <a href="javascript:void(0);" class="fa fa-close tg-btnclose" data-dismiss="modal"
                       aria-label="Close"></a>
                    <div class="tg-boxtitle">
                        <h2>Add Block</h2>
                    </div>
                    <div class="tg-rightarea">
                        <a href="javascript:;" class="tg-btnspecimen btn-block-add"
                           onclick="$('#addBlockForm').submit();"><i class="fa fa-check"></i>Add
                            Block</a>
                    </div>
                </div>
                <div class="tg-modalbody modal-body">




                    <?php
                    $attributes = array('class' => 'tg-formtheme tg-formspecimen specimen_form', 'id' => 'addBlockForm');
                    echo form_open("doctor/add_block_form/" . $record_id, $attributes);
                    ?>
                    <input type="hidden" name="specimen_id" id="block_specimen_id" value="">
                    <input type="hidden" name="lab_no" id="block_lab_no" value="">
                    <input type="hidden" name="inner_tab" id="block_inner_tab" value="">

                    <div class="row blocks_wrapper" id="blocks_check">
                        <div class="col-md-12">
                            <h4>Blocks &nbsp;&nbsp; <a href="javascript:;" class="add_blocks_btn"><i class="fa fa-plus"></i></a></h4>
                        </div>
                        <div class="col-md-2 padding-bottom">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" name="block_lab_no[]" readonly >
                                <label class="focus-label">Lab No.</label>
                            </div>
                        </div>
                        <div class="col-md-2 padding-bottom">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" name="block_specimen_no[]" readonly>
                                <label class="focus-label">Specimen No.</label>
                            </div>
                        </div>
                        <div class="col-md-2 padding-bottom">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" name="block_no_of_blocks[]" readonly>
                                <label class="focus-label">Block No.</label>
                            </div>
                        </div>
                        <div class="col-md-6 padding-bottom">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" name="block_comments[]">
                                <label class="focus-label">Block Description</label>
                            </div>
                        </div>
                    </div>
                    <!--                    <fieldset>-->
                    <!--                        <div class="form-group halfform-group">-->
                    <!--                            <input type="text" class="form-control" name="block_slides" id="block_slides"-->
                    <!--                                   placeholder="Block Slide Url"/>-->
                    <!--                        </div>-->
                    <!--                        <div class="form-group halfform-group">-->
                    <!--                            <input type="text" class="form-control" name="block_slides_thumbnail"-->
                    <!--                                   id="block_slides_thumbnail"-->
                    <!--                                   placeholder="Block Slide Thumbnail Url"/>-->
                    <!--                        </div>-->
                    <!--                        <div class="form-group halfform-group">-->
                    <!--                            <input type="text" class="form-control" name="block_name" id="block_name"-->
                    <!--                                   placeholder="Block Name">-->
                    <!--                        </div>-->
                    <!--                        <div class="form-group halfform-group">-->
                    <!--                            <input type="text" class="form-control" name="block_description" id="block_description"-->
                    <!--                                   placeholder="Block Description"/>-->
                    <!--                        </div>-->
                    <!--                    </fieldset>-->
                    </form>
                </div>
            </div>
        </div>
        <ul class="tg-themenavtabs nav navbar-nav">
            <?php
            $active = 'active';
            $count = 1;
            foreach ($specimen_query as $row) {
                ?>
                <li class="nav-item <?php //echo $active;             ?>" data-currentspceimentab="<?php echo $count; ?>"
                    data-specimenid="<?php echo $row->specimen_id; ?>" data-requestid="<?php echo $row->request_id; ?>">
                    <a data-toggle="tab" data-ds-controls="<?php echo $count; ?>" data-target="#tabs, #dscd_<?php echo $count; ?>, #dsma_<?php echo $count; ?>, #dsmi_<?php echo $count; ?>, #dsf_<?php echo $count; ?>" class="ds_click" href="#tabs_<?php echo $count; ?>">Specimen
                        <?php echo $count; ?></a>
                </li>

                <?php
                $active = '';
                $count++;
            }
            ?>
        </ul>
        <div class="tg-tabcontentvtwo tab-content" style="padding-top: 0px !important;">
            <?php
            $tabs_active = 'active';
            $inner_tab_count = 1;
            $specimen_total_count = count($specimen_query);
            foreach ($specimen_query as $key => $row) {
                ?>
                <div class="tg-navtabsdetails tab-pane fade in <?php echo $tabs_active; ?>"
                     id="tabs_<?php echo $inner_tab_count; ?>">
                    <form class="tg-formtheme tg-tabform tg-tabformvtwo doctor_update_specimen"
                          id="doctor_update_specimen_record_<?php echo $inner_tab_count; ?>"
                          method="post">
                        <div class="col-md-12 nopadding">
                            <div class="sec_title form-group">
                                Clinical <a href="javascript:;" class="checv_up_down"><i
                                        class="fa fa-chevron-up"></i></a>
                            </div>
                            <div class="card hidden show">
                                <div class="card-body">
                                    <fieldset class="tg-tabfieldset tg-tabfieldsetvtwo">
                                        <?php
                                        if (empty($request_query[0]->cl_detail)) {
                                            for ($i = 1; $i <= $specimen_total_count; $i++) {
                                                $j = $i - 1;
                                                if ($i === $inner_tab_count) {

                                                    if ($specimen_total_count === 1) {
                                                        $total_width = '100% !important';
                                                    } else {
                                                        $total_width = '50% !important';
                                                    }
                                                    ?>
                                                    <div class="form-group form-group-tiny"
                                                         style="width:<?php echo $total_width; ?>;">
                                                        <label>Clinical Details <?php echo $i ?></label>

                                                        <textarea id="tg-tinymceeditor" name="specimen_clinical_history"
                                                                  class="tg-tinymceeditor editor_clinical_history_<?php echo intval($i); ?>"><?php echo $row->specimen_clinical_history; ?></textarea>
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
                                                                                                   name="specimen_benign"
                                                                                                   value="benign"
                                                                                                   type="checkbox"
                                                                                                   id="specimen_benign_<?php echo $inner_tab_count; ?>">
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
                                                                    <input <?php echo $checked; ?> type="checkbox"
                                                                                                   class="specimen_classification_<?php echo $inner_tab_count; ?>"
                                                                                                   name="specimen_inflammation"
                                                                                                   value="inflammation"
                                                                                                   id="specimen_inflammation_<?php echo $inner_tab_count; ?>">
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
                                                                    <input <?php echo $checked; ?> type="checkbox"
                                                                                                   class="specimen_classification_<?php echo $inner_tab_count; ?>"
                                                                                                   name="specimen_atypical"
                                                                                                   value="atypical"
                                                                                                   id="specimen_atypical_<?php echo $inner_tab_count; ?>">
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
                                                                    <input <?php echo $checked; ?> type="checkbox"
                                                                                                   class="specimen_classification_<?php echo $inner_tab_count; ?>"
                                                                                                   name="specimen_malignant"
                                                                                                   value="malignant"
                                                                                                   id="specimen_malignant_<?php echo $inner_tab_count; ?>">
                                                                    <label for="specimen_malignant_<?php echo $inner_tab_count; ?>">MT</label>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <?php
                                                } else {
                                                    $total_width = 50 / ($specimen_total_count - 1);
                                                    ?>
                                                    <div class="form-group tg-inputicon tg-disabled-form-group"
                                                         style="width:<?php echo $total_width . '% !important'; ?>">
                                                        <i class="ti-fullscreen"></i>
                                                        <label style="visibility: hidden;">No label</label>
                                                        <textarea
                                                            class=" form-control editor_clinical_history_<?php echo intval($i); ?>"
                                                            placeholder="<?php echo @strip_tags($specimen_query[$j]->specimen_clinical_history); ?>"></textarea>
                                                        <ul class="tg-themeinputbtn">
                                                            <li>
                                                                <span class="tg-radio">
                                                                    <input type="radio" id="tg-inputin1" name="inputin"
                                                                           value="inputin">
                                                                    <label for="tg-inputin1">IN</label>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="tg-radio">
                                                                    <input type="radio" id="tg-inputbt1" name="inputin"
                                                                           value="inputin">
                                                                    <label for="tg-inputbt1">BT</label>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="tg-radio">
                                                                    <input type="radio" id="tg-inputat1" name="inputin"
                                                                           value="inputin">
                                                                    <label for="tg-inputat1">AT</label>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="tg-radio">
                                                                    <input type="radio" id="tg-inputmt1" name="inputin"
                                                                           value="inputin">
                                                                    <label for="tg-inputmt1">MT</label>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </fieldset>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>


                        <div>
                            <!--CLINICAL DATASET-->
                            <div class="">
                                <?php
                                if (!empty($get_bcc_record)) {
                                    for ($clinical_arr = 0; $clinical_arr < sizeof($get_bcc_record); $clinical_arr++) {
                                        $html_response = $get_bcc_record[$clinical_arr]['bcc_response_html'];
                                        $data_set = json_decode($get_bcc_record[$clinical_arr]['bcc_data'], true);
                                        ?>
                                        <div id="dscd_<?= $get_bcc_record[$clinical_arr]['patient_specimen'] ?>">
                                            <div class="col-md-12 nopadding">
                                                <div class="sec_title form-group">
                                                    <?= (!empty($data_set) && $get_bcc_record[$clinical_arr]['dataset_type'] == "Basal Cell") ? 'Basal Cell Carcinoma' : 'Breast Cancer' ?> Dataset : (Clinical Data)  <small>Specimen <?= $get_bcc_record[$clinical_arr]['patient_specimen'] ?></small> <a href="javascript:;" class="checv_up_down"><i
                                                            class="fa fa-chevron-up"></i></a>
                                                </div>

                                                <div class="card hidden show">
                                                    <div class="card-body">
                                                        <div class="edit_icon pull-right "> 

                                                            <a title="Basal Cell Carcinoma" href="<?php echo site_url('_dataset/basal_cell_dataset/' . $dataset_url . '/' . $get_bcc_record[$clinical_arr]['patient_specimen']) ?>" class="btn btn-primary btn-rounded"> 
                                                                <i class="fa fa-pencil"></i> 
                                                            </a> 
                                                        </div>
                                                        <div class="edit_icon pull-right "   style="margin-right:10px"> 

                                                            <a title="Download Basal Cell Carcinoma" href="<?= site_url($pdf_url . '/clinical') ?>" target="_blank" class="btn btn-primary btn-rounded"> 
                                                                <i class="fa fa-floppy-o"></i> 
                                                            </a> 
                                                        </div>


                                                        <div class="tg-tabfieldsetfourhold">
                                                            <div class="form-group">
                                                                <div class="tg-formhead">
                                                                    <?php
                                                                    $circle_html = '<svg class="svg_serial_number" width="26" height="26">
                <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
            </svg>';
                                                                    foreach ($data_set as $key => $val) {
                                                                        if (in_array($key, array('clinicaldimention', 'Specimen_type', 'Incision', 'Excision', 'Punch', 'Curettings', 'Shave', 'CDOther'))) {
                                                                            if ($key == 'clinicaldimention') {
                                                                                $key = 'Maximum clinical dimension/diameter';
                                                                                $val = $val . ' mm';
                                                                            }
                                                                            if ($key == 'Specimen_type') {
                                                                                $key = 'Specimen type';
                                                                            }
                                                                            if ($key == 'CDOther') {
                                                                                $key = 'Other';
                                                                            }
                                                                            ?>
                                                                            <div class="col-sm-4" style="border: 1px solid gainsboro;line-height: 2;"><strong><?= $key ?>: </strong><div class="table-view-content"><?= $val != '' ? $circle_html . ' ' . $val : '-' ?></div></div>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>


                        <div class="col-md-12 nopadding">
                            <div class="sec_title form-group">
                                Laboratory Process Flow <a href="javascript:;" class="checv_up_down"><i
                                        class="fa fa-chevron-up"></i></a>
                            </div>
                            <div class="card hidden show">
                                <div class="card-body">
                                    <fieldset class="tg-tabfieldsettwo">
                                        <div class="tg-formgrouphold">
                                            <div class="form-group halfform-group">
                                                <h3>Lab Entry</h3>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <span class="avatar">
                                                            <img src="<?php echo base_urL('assets/img/person-male.png'); ?>"
                                                                 alt="">
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="vertical-align-p">Stefan Williams </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group halfform-group">
                                                <h3>Cut up / Grossing</h3>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <span class="avatar">
                                                            <img src="<?php echo base_urL('assets/img/person-male.png'); ?>"
                                                                 alt="">
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="vertical-align-p">Stefan Williams </p>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group halfform-group">
                                                <h3>Assisted By</h3>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <span class="avatar">
                                                            <img src="<?php echo base_urL('assets/img/person-male.png'); ?>"
                                                                 alt="">
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="vertical-align-p">Stefan Williams </p>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group halfform-group">
                                                <h3>Block Checked By</h3>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <span class="avatar">
                                                            <img src="<?php echo base_urL('assets/img/person-male.png'); ?>"
                                                                 alt="">
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="vertical-align-p">Stefan Williams </p>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group halfform-group">
                                                <h3>Labeled By</h3>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <span class="avatar">
                                                            <img src="<?php echo base_urL('assets/img/person-male.png'); ?>"
                                                                 alt="">
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="vertical-align-p">Stefan Williams </p>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group halfform-group">
                                                <h3>QC'd By</h3>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <span class="avatar">
                                                            <img src="<?php echo base_urL('assets/img/person-male.png'); ?>"
                                                                 alt="">
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="vertical-align-p">Stefan Williams </p>
                                                    </div>
                                                </div>

                                            </div>
                                            <!--                                            <div class="form-group halfform-group">-->
                                            <!--                                                <select name="specimen_block" id="specimen_block" class="form-control">-->
                                            <!--                                                    --><?php
                                            //                                                    if (!empty($get_cost_codes)) {
                                            //                                                        foreach ($get_cost_codes as $codes) {
                                            //                                                            $selected = '';
                                            //                                                            if ($codes->ura_cost_code_desc == $row->specimen_block) {
                                            //
                                            //                                                                $selected = 'selected';
                                            //                                                            }
                                            //                                                            echo '<option ' . $selected . ' value="' . $codes->ura_cost_code_desc . '">' . $codes->ura_cost_code_desc . '</option>';
                                            //                                                        }//endforeach
                                            //                                                    } else {
                                            //                                                        echo '<option value="0">Please Add The Codes First.</option>';
                                            //                                                    }//endif
                                            //                                                    
                                            ?>
                                            <!--                                                </select>-->
                                            <!--                                            </div>-->
                                            <!--                                            <div class="form-group halfform-group">-->
                                            <!--                                                <input type="text" class="form-control" name="specimen_slides"-->
                                            <!--                                                       value="-->
                                            <?php //echo $row->specimen_slides;        ?><!--"-->
                                            <!--                                                       placeholder="Slide No:">-->
                                            <!--                                            </div>-->
                                            <!--                                    <div class="sec_title form-group">-->
                                            <!--                                        Block  <a href="javascript:;" class="checv_up_down"><i class="fa fa-chevron-up"></i></a>-->
                                            <!--                                    </div>-->
                                            <!--                                            <button type="button" class="btn btn-info" data-toggle="collapse"-->
                                            <!--                                                    data-target="#demo">Block-->
                                            <!--                                            </button>-->
                                        </div>
                                        <div id="macroscopic-description-container"
                                             class="form-group form-group-tiny tg-lasttextarea tg-startextarea">
                                            <div id="" class="">
                                                <label for="">Specimen Macroscopic Description </label>
                                            </div>
                                            <textarea novalidate required name="specimen_macroscopic_description"
                                                      id="specimen_macroscopic_description"
                                                      class="form-control tg-tinymceeditor form-controlactive"
                                                      placeholder="Macroscopic Description"><?php echo $row->specimen_macroscopic_description; ?></textarea>
                                        </div>
                                        <div class="form-group halfform-group" style="float: right">
                                            <div class="sec_title form-group">
                                                Block<a href="javascript:;" class="checv_up_down" data-toggle="collapse"
                                                        data-target="#demo"><i
                                                        class="fa fa-chevron-down"></i></a>
                                            </div>
                                            <div id="demo" class="collapse">
                                                <fieldset class="tg-tabfieldsettwo">
                                                    <button type="button" class="btn btn-info block_model_btn"
                                                            data-specimenid="<?php echo $row->specimen_id; ?>"
                                                            data-labno="<?php echo $row->lab_number; ?>"
                                                            data-innertab="<?php echo $inner_tab_count; ?>"
                                                            style="float: right;margin-right: 20px;"><i
                                                            class="fa fa-plus"></i></button>
                                                    <table class="table" id="specimen_<?php echo $row->specimen_id; ?>">
                                                        <thead>
                                                        <th>Specimen No.</th>
                                                        <th>Block No.</th>
                                                        <th>Block Description</th>
                                                        </thead>
                                                        <tbody class="block_table">
                                                            <?php
                                                            foreach ($specimen_blocks as $sp_block) {
                                                                if ($sp_block->specimen_id == $row->specimen_id) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $sp_block->specimen_no; ?></td>
                                                                        <td><?php echo $sp_block->block_no; ?></td>
                                                                        <td><?php echo $sp_block->description; ?></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </fieldset>
                                            </div>
                                        </div>

                                    </fieldset>
                                </div>
                            </div>
                        </div>

                        <div>
                            <!--MACRO DATASET-->
                            <div class="">
                                <?php
                                if (!empty($get_bcc_record)) {
                                    for ($clinical_arr = 0; $clinical_arr < sizeof($get_bcc_record); $clinical_arr++) {
                                        $html_response = $get_bcc_record[$clinical_arr]['bcc_response_html'];
                                        $data_set = json_decode($get_bcc_record[$clinical_arr]['bcc_data'], true);
                                        ?>
                                        <div id="dsma_<?= $get_bcc_record[$clinical_arr]['patient_specimen'] ?>">
                                            <div class="col-md-12 nopadding">
                                                <div class="sec_title form-group">
                                                    <?= (!empty($data_set) && $get_bcc_record[$clinical_arr]['dataset_type'] == "Basal Cell") ? 'Basal Cell Carcinoma' : 'Breast Cancer' ?> Dataset : (Macroscopic Description)  <small>Specimen <?= $get_bcc_record[$clinical_arr]['patient_specimen'] ?></small> <a href="javascript:;" class="checv_up_down"><i
                                                            class="fa fa-chevron-up"></i></a>
                                                </div>
                                                <div class="card hidden show">
                                                    <div class="card-body">
                                                        <div class="edit_icon pull-right "> 

                                                            <a title="Basal Cell Carcinoma" href="<?php echo site_url('_dataset/basal_cell_dataset/' . $dataset_url . '/' . $get_bcc_record[$clinical_arr]['patient_specimen']) ?>" class="btn btn-primary btn-rounded"> 
                                                                <i class="fa fa-pencil"></i> 
                                                            </a> 
                                                        </div>
                                                        <div class="edit_icon pull-right "   style="margin-right:10px"> 

                                                            <a title="Download Basal Cell Carcinoma" href="<?= site_url($pdf_url . '/macro') ?>" target="_blank" class="btn btn-primary btn-rounded"> 
                                                                <i class="fa fa-floppy-o"></i> 
                                                            </a> 
                                                        </div>


                                                        <div class="tg-tabfieldsetfourhold">
                                                            <div class="form-group">
                                                                <div class="tg-formhead">
                                                                    <?php
                                                                    $circle_html = '<svg class="svg_serial_number" width="26" height="26">
                <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
            </svg>';
                                                                    foreach ($data_set as $key => $val) {
                                                                        if (in_array($key, array('specimendimention1', 'specimendimention2', 'specimendimention3', 'MDMacroscopic_description', 'Macroscopic'))) {
                                                                            if ($key == 'specimendimention1') {
                                                                                $key = 'Dimension of specimen (Length)';
                                                                                $val = $val . ' mm';
                                                                            }
                                                                            if ($key == 'specimendimention2') {
                                                                                $key = '(Breath)';
                                                                                $val = $val . ' mm';
                                                                            }
                                                                            if ($key == 'specimendimention3') {
                                                                                $key = '(Depth)';
                                                                                $val = $val . ' mm';
                                                                            }
                                                                            if ($key == 'MDMacroscopic_description') {
                                                                                $key = 'Maximum dimension';
                                                                                $val = $val . ' mm';
                                                                            }
                                                                            if ($key == 'Macroscopic') {
                                                                                $key = 'Diameter of lesion';
                                                                            }
                                                                            ?>
                                                                            <div class="col-sm-4" style="border: 1px solid gainsboro;line-height: 2;"><strong><?= $key ?>: </strong><div class="table-view-content"><?= $val != '' ? $circle_html . ' ' . $val : '-' ?></div></div>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="col-md-12 nopadding">
                            <div class="sec_title form-group">
                                Virtual Slide Panel <a href="javascript:;" class="checv_up_down"><i
                                        class="fa fa-chevron-up"></i></a>
                            </div>
                            <div class="card hidden show">
                                <div class="card-body">


                                    <fieldset>
                                        <div id="slide-carousel">
                                            <?php foreach ($slide_data as $index => $specimen_slide) { ?>
            <?php foreach ($specimen_slide['slides'] as $index => $slide) { ?>
                                                    <div class="thumbnail_slide_container">
                                                        <div class="thumbnail_slide"
                                                             onclick="viewRecord('<?php echo($specimen_slide['specimen_id'] . '_' . $index); ?>');">
                                                            <a class="" href="#">
                                                                <label><?php echo $slide['slide_name']; ?></label>
                                                                <img class="thumbnail_slide_img" alt=""
                                                                     src="<?php echo $slide['thumbnail'] ?>">
                                                            </a>
                                                        </div>
                                                    </div>
                                                <?php } ?>
        <?php } ?>
                                        </div>

                                    </fieldset>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <div class="col-md-12 nopadding">
                            <div class="sec_title form-group">
                                Microscopic Description <a href="javascript:;" class="checv_up_down"><i
                                        class="fa fa-chevron-up"></i></a>
                            </div>
                            <div class="card hidden show">
                                <div class="card-body">
                                    <fieldset class="tg-tabfieldsetthree specimen-micro-area">
                                        <div class="form-group">
                                            <input type="text" data-microcodeid=""
                                                   data-formid="<?php echo $inner_tab_count; ?>"
                                                   name="specimen_microscopic_code"
                                                   class="form-control specimen_microscopic_code"
                                                   id="specimen_microscopic_code"
                                                   placeholder="Specimen Microscopic Code"
                                                   value="<?php echo $row->specimen_microscopic_code; ?>">
                                        </div>
                                        <div class="form-group halfform-group">
                                            <span class="tg-select">
                                                <select id="rcpath_codedata" data-placeholder="RCPath Code" name="rcpath_code"
                                                        class="form-control rcpath_codedata rcpath_codedata_<?php echo $inner_tab_count; ?>">
                                                    <option value="">Select RC Path</option>
                                                    <?php
                                                    for ($i = 1; $i <= 20; $i++) {
                                                        $selected = '';
                                                        if ($i == $row->specimen_rcpath_code) {
                                                            $selected = 'selected';
                                                        }
                                                        echo '<option ' . $selected . ' value="' . $i . '">' . $i . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </span>
                                        </div>
                                    </fieldset>
                                    <div class="col-md-12 nopadding">
                                        <fieldset>
                                            <div class="microscopy-form-container form-group ">
                                                <!-- <hr style="margin: 0;"> -->
                                                <div>
                                                    <span>
                                                        Patient Initial: <strong><?php echo $row->patient_initial; ?></strong>
                                                    </span>
                                                    <span class="microscopy_title_detail">
                                                        Surname: <strong><?php echo $row->sur_name; ?></strong>
                                                    </span>
                                                    <span class="microscopy_title_detail">
                                                        First Name: <strong><?php echo $row->f_name; ?></strong>
                                                    </span>
                                                    <span class="microscopy_title_detail">
                                                        Lab Number: <strong><?php echo $row->lab_number; ?></strong>
                                                    </span>
                                                </div>
                                                <textarea novalidate required
                                                          class="form-control form-controlactive tg-tinymceeditor specimen_microscopic_description"
                                                          name="specimen_microscopic_description"
                                                          id="specimen_microscopic_description_<?php echo $inner_tab_count; ?>"
                                                          placeholder="Microscopic Description"
                                                          style="min-height:350px;"><?php echo trim($row->specimen_microscopic_description); ?></textarea>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="clearfix"></div>


                                </div>
                            </div>
                        </div>

                        <div>
                            <!--MICRO DATASET-->
                            <div class="">
                                <?php
                                if (!empty($get_bcc_record)) {
                                    for ($clinical_arr = 0; $clinical_arr < sizeof($get_bcc_record); $clinical_arr++) {
                                        $html_response = $get_bcc_record[$clinical_arr]['bcc_response_html'];
                                        $data_set = json_decode($get_bcc_record[$clinical_arr]['bcc_data'], true);
                                        ?>
                                        <div id="dsmi_<?= $get_bcc_record[$clinical_arr]['patient_specimen'] ?>">
                                            <div class="col-md-12 nopadding">
                                                <div class="sec_title form-group">
                <?= (!empty($data_set) && $get_bcc_record[$clinical_arr]['dataset_type'] == "Basal Cell") ? 'Basal Cell Carcinoma' : 'Breast Cancer' ?> Dataset : (Microscopic Description)  <small>Specimen <?= $get_bcc_record[$clinical_arr]['patient_specimen'] ?></small> <a href="javascript:;" class="checv_up_down"><i
                                                            class="fa fa-chevron-up"></i></a>
                                                </div>
                                                <div class="card hidden show">
                                                    <div class="card-body">
                                                        <div class="edit_icon pull-right "> 

                                                            <a title="Basal Cell Carcinoma" href="<?php echo site_url('_dataset/basal_cell_dataset/' . $dataset_url . '/' . $get_bcc_record[$clinical_arr]['patient_specimen']) ?>" class="btn btn-primary btn-rounded"> 
                                                                <i class="fa fa-pencil"></i> 
                                                            </a> 
                                                        </div>
                                                        <div class="edit_icon pull-right "   style="margin-right:10px"> 

                                                            <a title="Download Basal Cell Carcinoma" href="<?= site_url($pdf_url . '/micro') ?>" target="_blank" class="btn btn-primary btn-rounded"> 
                                                                <i class="fa fa-floppy-o"></i> 
                                                            </a> 
                                                        </div>


                                                        <div class="tg-tabfieldsetfourhold">
                                                            <div class="form-group">
                                                                <div class="tg-formhead">
                                                                    <?php
                                                                    $circle_html = '<svg class="svg_serial_number" width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                                    <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                                </svg>';
                                                                    foreach ($data_set as $key => $val) {
                                                                        if (in_array($key, array('Histological_low', 'n_invasion', 'n_invasion_present', 'n_invasion_yes_m', 'n_Peripheral', 'n_Deep', 'Maximum_Indicate', 'Maximum_Dimention', 'Histological_high', 'n_Histological_Specify_tissue', 'n_bone_minor', 'n_bone_gross', 'n_bone_foraminal'))) {
                                                                            if ($key == 'Histological_low') {
                                                                                $key = 'Low risk subtype';
                                                                            }
                                                                            if ($key == 'n_invasion') {
                                                                                $key = 'Perineural invasion† :**';
                                                                            }
                                                                            if ($key == 'n_invasion_present') {
                                                                                $key = 'If present: Meets criteria to upstage pT1/pT2 to pT3?**';
                                                                            }
                                                                            if ($key == 'n_invasion_yes_m') {
                                                                                $key = 'If yes: Named nerve';
                                                                            }
                                                                            if ($key == 'n_Peripheral') {
                                                                                $key = 'Margins†: (Peripheral)';
                                                                            }
                                                                            if ($key == 'n_Deep') {
                                                                                $key = 'Margins†: (Deep)';
                                                                            }
                                                                            if ($key == 'Maximum_Indicate') {
                                                                                $key = 'Maximum dimension/diameter of lesion (Indicate which used)';
                                                                            }
                                                                            if ($key == 'Maximum_Dimention') {
                                                                                $key = '(Dimension)';
                                                                            }
                                                                            if ($key == 'Histological_high') {
                                                                                $key = 'High risk if present';
                                                                            }
                                                                            if ($key == 'n_Histological_Specify_tissue') {
                                                                                $key = 'Specify tissue';
                                                                            }
                                                                            if ($key == 'n_bone_minor') {
                                                                                $key = 'Minor bone erosion';
                                                                            }
                                                                            if ($key == 'n_bone_gross') {
                                                                                $key = 'Gross cortical/marrow invasion';
                                                                            }
                                                                            if ($key == 'n_bone_foraminal') {
                                                                                $key = 'Axial/skull base/foraminal invasion';
                                                                            }
                                                                            ?>
                                                                            <div class="col-sm-6" style="border: 1px solid gainsboro;line-height: 2;"><strong><?= $key ?>: </strong><div class="table-view-content"><?= $val != '' ? $circle_html . ' ' . $val : '-' ?></div></div>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div>
                            <!--FULL DATASET-->
                            <div class="">
                                <?php
                                if (!empty($get_bcc_record)) {
                                    for ($clinical_arr = 0; $clinical_arr < sizeof($get_bcc_record); $clinical_arr++) {
                                        $html_response = $get_bcc_record[$clinical_arr]['bcc_response_html'];
                                        $data_set = json_decode($get_bcc_record[$clinical_arr]['bcc_data'], true);
                                        ?>
                                        <div id="dsf_<?= $get_bcc_record[$clinical_arr]['patient_specimen'] ?>">
                                            <div class="col-md-12 nopadding">
                                                <div class="sec_title form-group">
                <?= (!empty($data_set) && $get_bcc_record[$clinical_arr]['dataset_type'] == "Basal Cell") ? 'Basal Cell Carcinoma' : 'Breast Cancer' ?> Dataset : <small>Specimen <?= $get_bcc_record[$clinical_arr]['patient_specimen'] ?></small><a href="javascript:;" class="checv_up_down"><i
                                                            class="fa fa-chevron-down"></i></a>
                                                </div>
                                                <div class="card hide">
                                                    <div class="card-body">
                                                        <div class="edit_icon pull-right "> 

                                                            <a title="Basal Cell Carcinoma" href="<?php echo site_url('_dataset/basal_cell_dataset/' . $dataset_url . '/' . $get_bcc_record[$clinical_arr]['patient_specimen']) ?>" class="btn btn-primary btn-rounded"> 
                                                                <i class="fa fa-pencil"></i> 
                                                            </a> 
                                                        </div>
                                                        <div class="edit_icon pull-right "   style="margin-right:10px"> 

                                                            <a title="Download Basal Cell Carcinoma" href="<?= site_url($pdf_url) ?>" target="_blank" class="btn btn-primary btn-rounded"> 
                                                                <i class="fa fa-floppy-o"></i> 
                                                            </a> 
                                                        </div>
                                                        <div class="delete_icon pull-right"   style="margin-right:10px"> 
                                                            <a onclick="return confirm_delete();" href="<?php echo site_url('_dataset/basal_cell_dataset/removeDatasetbyID/' . $get_bcc_record[$clinical_arr]['dataset_record_id'] . '/' . $get_bcc_record[$clinical_arr]['record_id']) ?>" class="btn btn-danger btn-rounded"><i class="fa fa-trash"></i> </a>

                                                        </div>

                                                        <div class="tg-tabfieldsetfourhold">
                                                            <div class="form-group">
                                                                <div class="tg-formhead">
                                                                    <?php
                                                                    $circle_html = '<svg class="svg_serial_number" width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                                    <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                                </svg>';
                                                                    foreach ($data_set as $key => $val) {
                                                                        if (in_array($key, array('clinicaldimention', 'Specimen_type', 'Incision', 'Excision', 'Punch', 'Curettings', 'Shave', 'CDOther', 'specimendimention1', 'specimendimention2', 'specimendimention3', 'MDMacroscopic_description', 'Macroscopic', 'Histological_low', 'n_invasion', 'n_invasion_present', 'n_invasion_yes_m', 'n_Peripheral', 'n_Deep', 'Maximum_Indicate', 'Maximum_Dimention', 'Histological_high', 'n_Histological_Specify_tissue', 'n_bone_minor', 'n_bone_gross', 'n_bone_foraminal', 'ptnm', 'ptnm_N', 'ptnm_M', 'bcc_comments'))) {

                                                                            if ($key == 'clinicaldimention') {
                                                                                $key = 'Maximum clinical dimension/diameter';
                                                                                $val = $val . ' mm';
                                                                            }
                                                                            if ($key == 'Specimen_type') {
                                                                                $key = 'Specimen type';
                                                                            }
                                                                            if ($key == 'CDOther') {
                                                                                $key = 'Other';
                                                                            }
                                                                            if ($key == 'specimendimention1') {
                                                                                $key = 'Dimension of specimen (Length)';
                                                                                $val = $val . ' mm';
                                                                            }
                                                                            if ($key == 'specimendimention2') {
                                                                                $key = '(Breath)';
                                                                                $val = $val . ' mm';
                                                                            }
                                                                            if ($key == 'specimendimention3') {
                                                                                $key = '(Depth)';
                                                                                $val = $val . ' mm';
                                                                            }
                                                                            if ($key == 'MDMacroscopic_description') {
                                                                                $key = 'Maximum dimension';
                                                                                $val = $val . ' mm';
                                                                            }
                                                                            if ($key == 'Macroscopic') {
                                                                                $key = 'Diameter of lesion';
                                                                            }
                                                                            if ($key == 'Histological_low') {
                                                                                $key = 'Low risk subtype';
                                                                            }
                                                                            if ($key == 'n_invasion') {
                                                                                $key = 'Perineural invasion† :**';
                                                                            }
                                                                            if ($key == 'n_invasion_present') {
                                                                                $key = 'If present: Meets criteria to upstage pT1/pT2 to pT3?**';
                                                                            }
                                                                            if ($key == 'n_invasion_yes_m') {
                                                                                $key = 'If yes: Named nerve';
                                                                            }
                                                                            if ($key == 'n_Peripheral') {
                                                                                $key = 'Margins†: (Peripheral)';
                                                                            }
                                                                            if ($key == 'n_Deep') {
                                                                                $key = 'Margins†: (Deep)';
                                                                            }
                                                                            if ($key == 'Maximum_Indicate') {
                                                                                $key = 'Maximum dimension/diameter of lesion (Indicate which used)';
                                                                            }
                                                                            if ($key == 'Maximum_Dimention') {
                                                                                $key = '(Dimension)';
                                                                            }
                                                                            if ($key == 'Histological_high') {
                                                                                $key = 'High risk if present';
                                                                            }
                                                                            if ($key == 'n_Histological_Specify_tissue') {
                                                                                $key = 'Specify tissue';
                                                                            }
                                                                            if ($key == 'n_bone_minor') {
                                                                                $key = 'Minor bone erosion';
                                                                            }
                                                                            if ($key == 'n_bone_gross') {
                                                                                $key = 'Gross cortical/marrow invasion';
                                                                            }
                                                                            if ($key == 'n_bone_foraminal') {
                                                                                $key = 'Axial/skull base/foraminal invasion';
                                                                            }
                                                                            if ($key == 'ptnm') {
                                                                                $key = 'pTNM pT';
                                                                            }
                                                                            if ($key == 'ptnm_N') {
                                                                                $key = 'pTNM pN';
                                                                            }
                                                                            if ($key == 'ptnm_M') {
                                                                                $key = 'Distant metastasis M';
                                                                            }
                                                                            if ($key == 'bcc_comments') {
                                                                                $key = 'COMMENTS';
                                                                            }
                                                                            ?>

                                                                            <?= $key == 'Maximum clinical dimension/diameter' ? '<div class="col-sm-12"><h2>Clinical Data</h2></div>' : '' ?>
                                                                            <?= $key == 'Dimension of specimen (Length)' ? '<div class="col-sm-12"><h2>Macroscopic Description</h2></div>' : '' ?>
                                                                            <?= $key == 'Low risk subtype' || $key == 'High risk if present' ? '<div class="col-sm-12"><h2>Microscopic Description</h2></div>' : '' ?>
                                                                            <?= $key == 'Maximum dimension/diameter of lesion (Indicate which used)' ? '<div class="col-sm-12"><h2>Maximum dimension/diameter of lesion</h2></div>' : '' ?>
                        <?= $key == 'pTNM pT' ? '<div class="col-sm-12"><h2>pTNM & COMMENTS</h2></div>' : '' ?>
                                                                            <div class="col-sm-6" 
                                                                                 style="border: 1px solid gainsboro;line-height: 2;">
                                                                                <strong>
                                                                                    <?= $key ?>: </strong>
                                                                                <div class="table-view-content">
                        <?= $val != '' ? $circle_html . ' ' . $val : '-' ?>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div>
                            <!--FULL DATASET BREAST CANCER-->
                            <div class="">
                                <?php
                                if (!empty($get_breast_cancer_record)) {
                                    for ($clinical_arr = 0; $clinical_arr < sizeof($get_breast_cancer_record); $clinical_arr++) {
                                        $html_response = $get_breast_cancer_record[$clinical_arr]['bcc_response_html'];
                                        $data_set = json_decode($get_breast_cancer_record[$clinical_arr]['breast_cancer_data'], true);
                                        ?>
                                        <div id="dsfbc_<?= $get_breast_cancer_record[$clinical_arr]['patient_specimen'] ?>">
                                            <div class="col-md-12 nopadding">
                                                <div class="sec_title form-group">
                <?= (!empty($data_set) && $get_breast_cancer_record[$clinical_arr]['dataset_type'] == "Basal Cell") ? 'Basal Cell Carcinoma' : 'Breast Cancer' ?> Dataset : <small>Specimen <?= $get_breast_cancer_record[$clinical_arr]['patient_specimen'] ?></small><a href="javascript:;" class="checv_up_down"><i
                                                            class="fa fa-chevron-down"></i></a>
                                                </div>
                                                <div class="card hide">
                                                    <div class="card-body">
<!--                                                        <div class="edit_icon pull-right "> 

                                                            <a title="Breast Cancer" href="<?php echo site_url('_dataset/breast_cancer_dataset/' . $dataset_url . '/' . $get_breast_cancer_record[$clinical_arr]['patient_specimen']) ?>" class="btn btn-primary btn-rounded"> 
                                                                <i class="fa fa-pencil"></i> 
                                                            </a> 
                                                        </div>
                                                        <div class="edit_icon pull-right "   style="margin-right:10px"> 

                                                            <a title="Download Breast Cancer Dataset" href="<?= site_url($pdf_url) ?>" target="_blank" class="btn btn-primary btn-rounded"> 
                                                                <i class="fa fa-floppy-o"></i> 
                                                            </a> 
                                                        </div>-->
                                                        <div class="delete_icon pull-right"   style="margin-right:10px"> 
                                                            <a onclick="return confirm_delete();" href="<?php echo site_url('_dataset/breast_cancer_dataset/removeDatasetbyID/' . $get_breast_cancer_record[$clinical_arr]['dataset_record_id'] . '/' . $get_breast_cancer_record[$clinical_arr]['record_id']) ?>" class="btn btn-danger btn-rounded"><i class="fa fa-trash"></i> </a>

                                                        </div>

                                                        <div class="tg-tabfieldsetfourhold">
                                                            <div class="form-group">
                                                                <div class="tg-formhead">
                                                                    <?php
                                                                    $circle_html = '<svg class="svg_serial_number" width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                                    <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                                </svg>';
                                                                    foreach ($data_set as $key => $val) {
                                                                        if (!in_array($key, array('record_id','dataset_record_id','breast_cancer_response_html','dataset_type','dataset_title'))) {
                                                                        ?>
                                                                            <div class="col-sm-6" 
                                                                                 style="border: 1px solid gainsboro;line-height: 2;">
                                                                                <strong>
                                                                                    <?= $key ?>: </strong>
                                                                                <div class="table-view-content">
                        <?= $val != '' ? $circle_html . ' ' . $val : '-' ?>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                    }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="col-md-12 nopadding">
                            <div class="sec_title form-group">
                                Diagnosis: <span class="text-danger">*</span> <a href="javascript:;"
                                                                                 class="checv_up_down"><i
                                        class="fa fa-chevron-up"></i></a>
                            </div>
                            <div class="card hidden show">
                                <div class="card-body">


                                    <div class="tg-tabfieldsetfourhold">
                                        <fieldset class="tg-tabfieldsetfour">
                                            <div class="form-group">
                                                <div class="tg-formhead">
                                                    <h3>Diagnosis:</h3>
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
                                                                                               name="specimen_benign"
                                                                                               value="benign" type="checkbox"
                                                                                               id="specimen_benign">
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
                                                                                               class="specimen_classification_<?php echo $inner_tab_count; ?>"
                                                                                               name="specimen_inflammation"
                                                                                               value="inflammation"
                                                                                               id="specimen_inflammation">
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
                                                                                               class="specimen_classification_<?php echo $inner_tab_count; ?>"
                                                                                               name="specimen_atypical"
                                                                                               value="atypical"
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
                                                                                               class="specimen_classification_<?php echo $inner_tab_count; ?>"
                                                                                               name="specimen_malignant"
                                                                                               value="malignant"
                                                                                               id="specimen_malignant">
                                                                <label for="specimen_malignant">MT</label>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="form-group tg-formgroupcheck specimen-diagnose-field">
                                                <input data-overwrite="false" type="text"
                                                       class="form-control specimen_dignosis_<?php echo $inner_tab_count; ?>"
                                                       placeholder="Specimen Diagnosis"
                                                       name="specimen_diagnosis" id="specimen_dignosis"
                                                       value="<?php echo $row->specimen_diagnosis_description; ?>"/>
                                                <div id="snomed-values-<?php echo $inner_tab_count; ?>"
                                                     class="snomed-values">
                                                    <span class="snomed-t1"><?php echo!empty($row->specimen_snomed_t) ? $row->specimen_snomed_t : ''; ?></span>
                                                    <span class="snomed-t2"><?php echo!empty($row->specimen_snomed_t2) ? $row->specimen_snomed_t2 : ''; ?></span>
                                                    <span class="snomed-p"><?php echo!empty($row->specimen_snomed_p) ? $row->specimen_snomed_p : ''; ?></span>
                                                    <span class="snomed-m"><?php echo!empty($row->specimen_snomed_m) ? $row->specimen_snomed_m : ''; ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group halfformgroup specimen_snomed_options">
                                                <!--                                        <span class="tg-select specimen_snomed_select">-->
                                                <?php
                                                $snomed_t_array = getSnomedCodes('t1');
                                                $snomed_t_id = $row->specimen_snomed_t;
                                                $snomed_t_arr = explode(',', $snomed_t_id);
                                                $select2_lib = 'select2';
                                                if ($inner_tab_count == 1) {
                                                    $select2_lib = 'select2_snomed_1';
                                                }
                                                ?>
                                                <label for="specimen_snomed_t1">Snomed T1</label>
                                                <select multiple name="specimen_snomed_t1[]"
                                                        data-formid="<?php echo $inner_tab_count; ?>"
                                                        class="form-control select2 specimen_snomed_t1_<?php echo $inner_tab_count; ?>"
                                                        style="height: auto;">
                                                            <?php
                                                            foreach ($snomed_t_array as $snomed_t_code) {
                                                                $selected = '';
                                                                $snomed_t = strtolower(str_replace(' ', '', trim($snomed_t_code['usmdcode_code'])));
                                                                if (in_array($snomed_t, $snomed_t_arr)) {
                                                                    $selected = 'selected';
                                                                }
                                                                $added_by = '';
                                                                if ($snomed_t_code['snomed_added_by'] === $user_id) {
                                                                    $added_by = 'snomed_provisional';
                                                                }
                                                                echo '<option class="' . $added_by . '" data-tdesc="' . $snomed_t_code['usmdcode_code_desc'] . '" value="' . $snomed_t . '" ' . $selected . '>' . $snomed_t_code['usmdcode_code'] . ' ' . $snomed_t_code['usmdcode_code_desc'] . '</option>';
                                                            }
                                                            ?>
                                                </select>
                                                <!--                                        </span>-->
                                            </div>
                                            <div class="form-group halfformgroup specimen_snomed_options">
                                                <span class="tg-select specimen_snomed_select">
                                                    <?php
                                                    $snomed_t2_array = getSnomedCodes('t1');
                                                    $snomed_t2_id = $row->specimen_snomed_t2;
                                                    $snomed_t2_arr = explode(',', $snomed_t2_id);
                                                    ?>
                                                    <label for="specimen_snomed_t2">Snomed T2</label>
                                                    <select multiple name="specimen_snomed_t2[]"
                                                            data-formid="<?php echo $inner_tab_count; ?>"
                                                            class="form-control select2 specimen_snomed_t2_<?php echo $inner_tab_count; ?>"
                                                            data-live-search="true">
                                                        <option data-hidden="true">Nothing Select</option>
                                                        <?php
                                                        foreach ($snomed_t2_array as $snomed_t2_code) {
                                                            $selected = '';
                                                            $snomed_t = strtolower(str_replace(' ', '', trim($snomed_t2_code['usmdcode_code'])));
                                                            if (in_array($snomed_t, $snomed_t2_arr)) {
                                                                $selected = 'selected';
                                                            }
                                                            $added_by = '';
                                                            if ($snomed_t2_code['snomed_added_by'] === $user_id) {
                                                                $added_by = 'snomed_provisional';
                                                            }
                                                            echo '<option class="' . $added_by . '" data-tdesc="' . $snomed_t2_code['usmdcode_code_desc'] . '" value="' . $snomed_t . '" ' . $selected . '>' . $snomed_t2_code['usmdcode_code'] . ' ' . $snomed_t2_code['usmdcode_code_desc'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="form-group halfformgroup specimen_snomed_options">
                                                <span class="tg-select specimen_snomed_select">
                                                    <?php
                                                    $snomed_p_array = getSnomedCodes('p');
                                                    $snomed_p_id = $row->specimen_snomed_p;
                                                    $snomed_p_arr = explode(',', $snomed_p_id);
                                                    ?>
                                                    <label for="specimen_snomed_p">Snomed P</label>
                                                    <select multiple name="specimen_snomed_p[]"
                                                            data-formid="<?php echo $inner_tab_count; ?>"
                                                            class="form-control select2 specimen_snomed_p_<?php echo $inner_tab_count; ?>"
                                                            data-live-search="true">
                                                        <option data-hidden="true">Nothing Select</option>
                                                        <?php
                                                        foreach ($snomed_p_array as $snomed_p_code) {
                                                            $selected = '';
                                                            $snomed_p = strtolower(str_replace(' ', '', trim($snomed_p_code['usmdcode_code'])));
                                                            if (in_array($snomed_p, $snomed_p_arr)) {

                                                                $selected = 'selected';
                                                            }
                                                            $added_by = '';
                                                            if ($snomed_p_code['snomed_added_by'] === $user_id) {
                                                                $added_by = 'snomed_provisional';
                                                            }
                                                            echo '<option class="' . $added_by . '" data-pdesc="' . $snomed_p_code['usmdcode_code_desc'] . '" value="' . $snomed_p . '" ' . $selected . '>' . $snomed_p_code['usmdcode_code'] . ' ' . $snomed_p_code['usmdcode_code_desc'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="form-group halfformgroup specimen_snomed_options">
                                                <span class="tg-select specimen_snomed_select">
                                                    <?php
                                                    $snomed_m_array = getSnomedCodes('m');
                                                    $snomed_m_id = $row->specimen_snomed_m;
                                                    $snomed_m_arr = explode(',', $snomed_m_id);
                                                    ?>
                                                    <label for="specimen_snomed_m">Snomed M</label>
                                                    <select multiple name="specimen_snomed_m[]"
                                                            data-formid="<?php echo $inner_tab_count; ?>"
                                                            class="form-control select2 specimen_snomed_m_<?php echo $inner_tab_count; ?>"
                                                            data-live-search="true">
                                                                <?php
                                                                foreach ($snomed_m_array as $snomed_m_code) {
                                                                    $selected = '';
                                                                    $snomed_m = strtolower(str_replace(' ', '', trim($snomed_m_code['usmdcode_code'])));
                                                                    if (in_array($snomed_m, $snomed_m_arr)) {

                                                                        $selected = 'selected';
                                                                    }
                                                                    $added_by = '';
                                                                    if ($snomed_m_code['snomed_added_by'] === $user_id) {
                                                                        $added_by = 'snomed_provisional';
                                                                    }
                                                                    echo '<option class="' . $added_by . '" data-rcpath="' . $snomed_m_code['rc_path_score'] . '" data-diagnoses="' . $snomed_m_code['snomed_diagnoses'] . '" data-mdesc="' . $snomed_m_code['usmdcode_code_desc'] . '" value="' . $snomed_m . '" ' . $selected . '>' . $snomed_m_code['usmdcode_code'] . ' ' . $snomed_m_code['usmdcode_code_desc'] . '</option>';
                                                                }
                                                                ?>
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="form-group tg-formgroupcheck halfform-group">
                                                <textarea name="specimen_commnet_section" class="form-control"
                                                          placeholder="Add Comments"><?php echo $row->specimen_comment_section; ?></textarea>
                                            </div>
                                            <div class="form-group tg-formgroupcheck halfform-group">
                                                <textarea name="specimen_special_notes" class="form-control"
                                                          placeholder="Special Notes"><?php echo $row->specimen_special_notes; ?></textarea>
                                            </div>
                                            <!-- <div class="form-group tg-privmsg-btn tg-formgroupcheck halfformgroup">
                                        <a class="form-group-btn btn btn-default" href="#" data-toggle="modal" data-target="#sendprivatemessage">Pm
                                            Msg</a>
                                        <textarea name="specimen_feedback_to_lab" class="form-control" placeholder="Feedback to Lab:"><?php echo $row->specimen_feedback_to_lab; ?></textarea>
                                    </div>
                                    <div class="form-group tg-formgroupcheck halfformgroup">
                                        <textarea name="specimen_feedback_to_secretary" class="form-control" placeholder="Feedback to Secretary:"><?php echo $row->specimen_feedback_to_secretary; ?></textarea>
                                    </div>
                                    <div class="form-group tg-privmsg-btn tg-formgroupcheck halfformgroup">
                                        <a class="form-group-btn btn btn-default" href="#" data-toggle="modal" data-target="#sendprivatemessage">Pm
                                            Msg</a>
                                        <textarea name="specimen_error_log" class="form-control" placeholder="Error Log:"><?php echo $row->specimen_error_log; ?></textarea>
                                    </div> -->

        <?php if (!empty($row->mdt_case_status) && $row->mdt_case_status === 'for_mdt') { ?>
                                                <div class="form-group" style="width: 100% !important;">
                                                    <textarea style="height:100px;" class="form-control" name="mdt_outcome_text"
                                                              id="mdt_outcome_text"
                                                              placeholder="MDT Outcome"><?php echo $row->mdt_outcome_text; ?></textarea>
                                                </div>
        <?php } ?>


                                        </fieldset>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="page-buttons">
                                    <button type="button" id="feedback_to_lab_button" class="btn btn-light"
                                            data-toggle="modal" data-target="#sendprivatemessage">
                                        <i class="fa fa-dot-circle-o mr-3"></i>
                                        Feedback To Lab:
                                        <span class="badge badge-pill bg-blue">0</span>
                                    </button>
                                    <button type="button" id="feedback_to_secretary_button" class="btn btn-light"
                                            data-toggle="modal" data-target="#sendprivatemessage_secretary">
                                        <i class="fa fa-dot-circle-o mr-3"></i>
                                        Feedback To Secretary:
                                        <span class="badge badge-pill bg-blue">0</span>
                                    </button>
                                    <button type="button" id="error_log_button" class="btn btn-light"
                                            data-toggle="modal" data-target="#sendprivatemessage_error">
                                        <i class="fa fa-dot-circle-o mr-3"></i>
                                        Error Log:
                                        <span class="badge badge-pill bg-blue">0</span>
                                    </button>

        <?php if (!$row->specimen_publish_status == 1) { ?>
                                        <button <?php echo $button_disable; ?>
                                            class="btn btn-primary btn-rounded update_specimen_record_btn pull-right"
                                            id="doctor_update_specimen_record_btn_<?php echo $inner_tab_count; ?>"
                                            name="submit">Update Diagnosis
                                        </button>
        <?php } ?>
                                </div>
                                <div id="doctor_update_specimen_record_message_<?php echo $inner_tab_count; ?>"></div>

                            </div>
                        </div>
                        <input type="hidden" name="snomed_m_value" class="snomed_m_value" value="">
                        <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                        <input type="hidden" name="specimen_id" value="<?php echo $row->specimen_id; ?>">
                        <!--Modal Box For Microscopic Description X Field Start-->
                        <div id="change-micro-x-val-<?php echo $inner_tab_count; ?>"
                             class="modal fade change-micro-x-val" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Enter X Value In Integer</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="number" name="micro_x_val" min="1" max="9">
                                        </div>
                                        <div class="form-group pull-right">
                                            <button class="btn btn-success btn-add-x-val">Add</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Modal Box For Microscopic Description X Field End-->
                    </form>

                    <div id="sendprivatemessage" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Send Private Message</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form tg-formtheme tg-editform">

                                        <?php
//Get Lab Number and Serial Number as Subject for Private Message
                                        $serial_no = $request_query[0]->serial_number;
                                        $lab_no = $request_query[0]->lab_number;

                                        $priv_msg_subject = $serial_no . '&nbsp;|&nbsp;' . $lab_no;
//Get laboratory user id.
                                        $lab_name = $request_query[0]->lab_name;
                                        $laboratory_id = getLaboratoryUserId($lab_name);
                                        $button_disableb = '';
                                        $lab_user_id = '';
                                        $lab_email = '';
                                        if (!empty($laboratory_id)) {
                                            $lab_user_id = $laboratory_id['user_lab_default_status'];
                                            $lab_name = $laboratory_id['description'];
                                            $lab_email = getUserEmail($laboratory_id['id'])[0];
                                        }
                                        if (empty($laboratory_id['user_lab_default_status'])) {
                                            $button_disableb = 'disabled';
                                            echo '<div class="alert alert-danger">This lab did not set any default user to receive private message, Please set first from admin side in edit group section or contact with Administrator.</div>';
                                        }
                                        ?>
                                        <?php
                                        $attributes = ['class' => 'email', 'id' => 'pm_form', 'name' => 'pm_form'];
                                        echo form_open_multipart('pm/SendMessage', $attributes);
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>To: <?php echo $lab_name; ?></label>
                                                    <input class="form-control" list="desc" placeholder="To"
                                                           name="recipients" value="<?php echo $lab_email; ?>" required>

                                                    <input type="hidden" name="message_id"
                                                           value="<?php echo(isset($message_id) ? $message_id : ''); ?>"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" style="display: none;">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="email" placeholder="Cc" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="email" placeholder="Bcc" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Attachements</label>
                                                    <input type="file" class="form-control" name="files[]" multiple/>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Subject</label>
                                                    <input type="text" name="privmsg_subject" placeholder="Subject"
                                                           value="<?php echo $priv_msg_subject ?>" class="form-control"
                                                           required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Message</label>
                                                    <textarea rows="4" name="privmsg_body"
                                                              class="form-control summernote"
                                                              placeholder="Enter your message here" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="text-center">
                                                        <button <?php echo $button_disableb; ?> class="btn btn-primary"
                                                                                                type="submit"
                                                                                                name="send" value="1">
                                                            <span>Send</span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        </form>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        jQuery(document).ready(function () {
                            /**
                             * Change Microscopic Code Description Modal
                             */
                            $(document).on('click', '#change_micro_desc_btn_<?php echo $inner_tab_count; ?>', function (e) {
                                e.preventDefault();
                                var _this = jQuery(this);

                                var form_id = <?php echo $inner_tab_count; ?>;

                                var micro_code_id = _this.parents('.tg-tabfieldsetbtn').find('input[name=specimen_microscopic_code]').data('microcodeid');
                                var micro_code = _this.parents('.tg-tabfieldsetbtn').find('input[name=specimen_microscopic_code]').val();
                                var micro_desc = _this.parents('.tg-tabfieldsetbtn').next('.tg-tabfieldsetthree').find('.specimen_microscopic_description_form_id').val();

                                $('#change_micro_code_desc_' + form_id).find('input[name=micro_code_id]').val(micro_code_id);
                                $('#change_micro_code_desc_' + form_id).find('.micro_code_edit_name').val(micro_code);
                                $('#change_micro_code_desc_' + form_id).find('.micro_code_edit_desc').val(micro_desc);

                                $('#change_micro_code_desc_' + form_id).modal({show: true});
                            });

                            $(document).on('click', '#save-micro-change-btn-<?php echo $inner_tab_count; ?>', function (e) {
                                e.preventDefault();
                                var _this = $(this);
                                var micro_id = _this.parents('#change_micro_code_desc_<?php echo $inner_tab_count; ?>').find('input[name=micro_code_id]').val();
                                var micro_desc = _this.parents('#change_micro_code_desc_<?php echo $inner_tab_count; ?>').find('.micro_code_edit_desc').val();
                                jQuery.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url() . '/index.php/doctor/setMicroscopicCodeData'; ?>",
                                    data: {'micro_id': micro_id, 'micro_desc': micro_desc},
                                    dataType: "json",
                                    success: function (response) {
                                        if (response.type === 'success') {
                                            jQuery.sticky(response.msg, {
                                                classList: 'success',
                                                speed: 200,
                                                autoclose: 5000
                                            });
                                            setTimeout(() => {
                                                $('#change_micro_code_desc_<?php echo $inner_tab_count; ?>').modal('hide');
                                            }, 1500);

                                        } else {
                                            jQuery.sticky(response.msg, {
                                                classList: 'important',
                                                speed: 200,
                                                autoclose: 5000
                                            });
                                        }
                                    }
                                });
                            })

                            $(document).on('change', '.specimen_snomed_t1_<?php echo $inner_tab_count; ?>', function () {
                                var _this = jQuery(this);
                                _this.parents('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('#snomed-values-<?php echo $inner_tab_count; ?> .snomed-t1').text(_this.val() + '.');
                            });
                            $(document).on('change', '.specimen_snomed_t2_<?php echo $inner_tab_count; ?>', function () {
                                var _this = jQuery(this);
                                _this.parents('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('#snomed-values-<?php echo $inner_tab_count; ?> .snomed-t2').text(_this.val() + '.');
                            });
                            $(document).on('change', '.specimen_snomed_p_<?php echo $inner_tab_count; ?>', function () {
                                var _this = jQuery(this);
                                _this.parents('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('#snomed-values-<?php echo $inner_tab_count; ?> .snomed-p').text(_this.val() + '.');
                            });
                            $(document).on('change', '#doctor_update_specimen_record_<?php echo $inner_tab_count; ?> .specimen_snomed_m_<?php echo $inner_tab_count; ?>', function () {
                                var _this = jQuery(this);

                                var snome_multi_selected_vals = $('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('.specimen_snomed_m_<?php echo $inner_tab_count; ?> option:selected');
                                var snomedDiagnosesArr = [];
                                var snomedVals = [];
                                var rcpathScore = [];

                                if (snome_multi_selected_vals.length > 0) {
                                    _this.parents('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('#snomed-values-<?php echo $inner_tab_count; ?> .snomed-m').text(_this.val());

                                    $.each(snome_multi_selected_vals, function (parent_key, parent_value) {
                                        snomedDiagnosesArr = $(this).data('diagnoses').split(',');
                                        rcpathScore[parent_key] = $(this).data('rcpath');
                                    });

                                    var snomedCheckBox = jQuery('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('.specimen_classification_<?php echo $inner_tab_count; ?>');
                                    $.each(snomedDiagnosesArr, function (key, value) {
                                        $.each(snomedCheckBox, function (input_key, input_value) {
                                            if (typeof value !== 'undefined' && value == $(this).val()) {
                                                $(this).prop('checked', true);
                                            }
                                        });
                                    });

                                    var rcpathMaxVal = Math.max.apply(Math, rcpathScore);
                                    _this.parents('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('.rcpath_codedata').val(rcpathMaxVal);
                                } else {
                                    _this.parents('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('#snomed-values-<?php echo $inner_tab_count; ?> .snomed-m').text('');
                                    jQuery('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('.specimen_classification_<?php echo $inner_tab_count; ?>').prop('checked', false);
                                    _this.parents('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('.rcpath_codedata').val('');
                                }
                            });
                            jQuery('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?> input[name=specimen_diagnosis]').bind('keyup change', function () {
                                var _this = jQuery(this);
                                _this.attr('data-overwrite', 'ture');
                            });
                            jQuery('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').on('submit',
                                    function (e) {
                                        e.preventDefault();
                                        var _this = jQuery(this);

                                        tinymce.triggerSave();
                                        var snomed_value = $('.snomed_m_value').val();

                                        var snomed_m = '';
                                        if (snomed_value != '' && snomed_value != null) {
                                            snomed_m = snomed_value;
                                        }

                                        if (snomed_m.indexOf("melanoma") != -1) {
                                            if ($('.snomed_check_mdt').val() == '') {
                                                jQuery.sticky('Please choose the mdt date first.', {
                                                    classList: 'success',
                                                    speed: 200,
                                                    autoclose: 5000
                                                });
                                                return false;
                                            }
                                        }

                                        var snomed_t1_desc = '';
                                        var snomed_t2_desc = '';
                                        var snomed_p_desc = '';
                                        var snomed_m_desc = '';

                                        if (typeof _this.find('.specimen_snomed_t1_<?php echo $inner_tab_count; ?> :selected').data('tdesc') !== 'undefined') {
                                            snomed_t1_desc = _this.find('.specimen_snomed_t1_<?php echo $inner_tab_count; ?> :selected').data('tdesc');
                                        }

                                        if (typeof _this.find('.specimen_snomed_t2_<?php echo $inner_tab_count; ?> :selected').data('tdesc') !== 'undefined') {
                                            snomed_t2_desc = ' (' + _this.find('.specimen_snomed_t2_<?php echo $inner_tab_count; ?> :selected').data('tdesc') + ') — ';
                                        }

                                        if (typeof _this.find('.specimen_snomed_p_<?php echo $inner_tab_count; ?> :selected').data('pdesc') !== 'undefined') {
                                            snomed_p_desc = ' : ' + _this.find('.specimen_snomed_p_<?php echo $inner_tab_count; ?> :selected').data('pdesc');
                                        }

                                        var snome_multi_selected = $('.specimen_snomed_m_<?php echo $inner_tab_count; ?>').find("option:selected");

                                        var arrSelected = [];
                                        var snomed_m_desc_data = '';
                                        snome_multi_selected.each(function () {
                                            arrSelected.push($(this).data('mdesc'));
                                            snomed_m_desc_data += $(this).data('mdesc') + ';';
                                        });

                                        var setData = snomed_t1_desc + snomed_p_desc + snomed_t2_desc + snomed_m_desc_data;

                                        var move = false;

                                        if (_this.find('.specimen_dignosis_<?php echo $inner_tab_count; ?>').attr('data-overwrite') == 'false') {
                                            _this.find('.specimen_dignosis_<?php echo $inner_tab_count; ?>').val(setData);
                                            move = true;
                                        } else {
                                            move = true;
                                        }

                                        var update_persoanl_record = jQuery('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').serialize();

                                        jQuery.ajax({
                                            type: "POST",
                                            url: "<?php echo base_url() . 'index.php/doctor/update_client_report'; ?>",
                                            data: update_persoanl_record,
                                            dataType: "json",
                                            success: function (response) {
                                                if (response.type === 'success') {
                                                    jQuery(
                                                            '#doctor_update_specimen_record_message_<?php echo $inner_tab_count; ?>'
                                                            ).html(response.msg);
                                                    window.setTimeout(function () {
                                                        location.reload(),
                                                                jQuery(document).scrollTop(0);
                                                    }, 3000);
                                                } else {
                                                    jQuery(
                                                            '#doctor_update_specimen_record_message_<?php echo $inner_tab_count; ?>'
                                                            ).html(response.msg);
                                                }
                                            }
                                        });
                                    });
                        });
                    </script>
                    <script>
                        jQuery(document).ready(function () {
                            var blocks_wrapper = $(".blocks_wrapper"); //Fields wrapper
                            var blocks_wrapper_add_btn = $(".add_blocks_btn"); //Add button ID

                            $(blocks_wrapper_add_btn).click(function (e) { //on add input button click
                                e.preventDefault();

                                var block_lab_no = $('#block_lab_no').val();
                                var block_inner_tab = $('#block_inner_tab').val();

                                $(blocks_wrapper).append('' +
                                        '<div class="add_block_div padding-bottom col-md-12"><div class="row"><div class="col-md-2"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="block_lab_no[]" value="' + block_lab_no + '" readonly>  <label class="focus-label">Lab No.</label> </div> </div>' +
                                        '<div class="col-md-2"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="block_specimen_no[]" value="Sp-' + block_inner_tab + '" readonly>  <label class="focus-label" >Specimen No.</label> </div> </div>' +
                                        '<div class="col-md-2"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="block_no_of_blocks[]" value="' + block_inner_tab + '" readonly>  <label class="focus-label" >Block No.</label> </div> </div>' +
                                        '<div class="col-md-5"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="block_comments[]">  <label class="focus-label">Block Description</label> </div> </div>' +
                                        '<div class="col-md-1"> <a href="javascript:void(0)" class="blocks_remove_row btn btn-danger btn-sm"><i class="fa fa-minus"></i></a> </div>' +
                                        '</div> </div>'); //add inputs box
                                x++; //text box increment
                                // }
                            });
                            $(blocks_wrapper).on("click", ".blocks_remove_row", function (e) { //user click on remove text
                                e.preventDefault();
                                $(this).closest("div.add_block_div").remove();
                                x--;
                            });

                            var blockForm = $("#addBlockForm");
                            var validator = blockForm.validate({
                                // ignore: ":hidden",
                                rules: {
                                    'block_lab_no[]': {
                                        required: true
                                    },
                                    'block_specimen_no[]': {
                                        required: true
                                    },
                                    'block_no_of_blocks[]': {
                                        required: true
                                    },
                                    'block_comments[]': {
                                        required: true
                                    }
                                },
                                submitHandler: function (form) {
                                    $.ajax({
                                        type: "POST",
                                        url: '<?php echo base_url('index.php/doctor/addSpecimenBlock'); ?>',
                                        data: $(form).serialize(),
                                        dataType: "json",
                                        success: function (response) {
                                            $('#add_block_modal').modal('hide');
                                            var specimenId = $('#block_specimen_id').val();
                                            if (response.type === 'success') {
                                                $("#specimen_" + specimenId + " .block_table").append(response.data);
                                                $.sticky(response.msg, {
                                                    classList: 'success',
                                                    speed: 200,
                                                    autoclose: 7000
                                                });
                                            } else {
                                                $.sticky(response.msg, {
                                                    classList: 'important',
                                                    speed: 200,
                                                    autoclose: 7000
                                                });
                                            }
                                        }
                                    });
                                    return false; // required to block normal submit since you used ajax
                                }
                            });

                            $(document).on('click', '.block_model_btn', function (e) {
                                validator.resetForm();
                                blockForm.find(".error").removeClass("error");
                                $('#block_specimen_id').val($(this).attr('data-specimenid'));
                                $('#block_lab_no').val($(this).attr('data-labno'));
                                $('#block_inner_tab').val($(this).attr('data-innertab'));

                                $("input[name='block_lab_no[]']").val($(this).attr('data-labno'));
                                $("input[name='block_specimen_no[]']").val('Sp-' + $(this).attr('data-innertab'));
                                $("input[name='block_no_of_blocks[]']").val($(this).attr('data-innertab'));

                                $(".add_block_div").remove();
                                $('#add_block_modal').modal('show');
                            });

                        });
                    </script>
                </div>
                <?php
                $tabs_active = '';
                $inner_tab_count++;
            }
            ?>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $(".ds_click").on('click', function (event) {
                //alert($(this).data("ds-controls"));
                //alert(event);
                var ds_val = $(this).data("ds-controls");
                for (let i = 0; i < 20; i++) {

                    if (i == ds_val) {
                        $("#dscd_" + i).show();
                        $("#dsma_" + i).show();
                        $("#dsmi_" + i).show();
                        $("#dsf_" + i).show();
                    } else {
                        $("#dscd_" + i).hide();
                        $("#dsma_" + i).hide();
                        $("#dsmi_" + i).hide();
                        $("#dsf_" + i).hide();
                    }
                }

            });

            for (let i = 0; i < 20; i++) {
                $("#dscd_" + i).hide();
                $("#dsma_" + i).hide();
                $("#dsmi_" + i).hide();
                $("#dsf_" + i).hide();
            }
        });

    </script>
    <?php
}
?>
                