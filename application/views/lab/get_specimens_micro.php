<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <?php


get_instance()->load->helper('globalfunctions');

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
        $slide_data, $specimen_blocks) 
        {
            
            
    $button_disable = '';
    if (!empty($opinion_data[0]->ura_opinion_req_id) && $record_id == $opinion_data[0]->ura_opinion_req_id) {
        $button_disable = 'disabled';
    }

    $user_id = getRecordAssignUserID($request_query[0]->uralensis_request_id);

    $micro_perm = getUserPermission($user_id, 'micro_perm');




    $initial = uralensis_get_user_data($request_query[0]->uralensis_request_id, 'initial');
    $fullname = uralensis_get_user_data($request_query[0]->uralensis_request_id, 'fullname');
    $serial_number = uralensis_get_record_db_detail($request_query[0]->uralensis_request_id, 'serial_number');
    $ura_barcode_no = uralensis_get_record_db_detail($request_query[0]->uralensis_request_id, 'ura_barcode_no');
    $CI = &get_instance();
    $html_response = '';
    $get_bcc_record = get_bcc_dataset_record($CI->uri->segment(3), '');
    $get_ssc_record = get_ssc_dataset_record($CI->uri->segment(3), '');
    $get_cmm_record = get_cmm_dataset_record($CI->uri->segment(3), '');
    $get_breast_cancer_record = get_breast_cancer_dataset_record($CI->uri->segment(3), '');
    $ura_dob = date('d-m-Y', strtotime($request_query[0]->dob));
    $ura_nhs = $request_query[0]->nhs_number;
    $ura_gender = $request_query[0]->gender;
    $labNo = $request_query[0]->lab_number;
    $requestId = $request_query[0]->uralensis_request_id;
    $labId = $request_query[0]->lab_id;
    $prefixes_data = getRecordLaboratoryPrefixes($requestId, $labId);

    $dataset_url = '/dashboard/' . $CI->uri->segment(3) . '/' . urlencode($initial) . '/' . urlencode($fullname) . '/' . urlencode($serial_number) . '/' . urlencode($ura_barcode_no) . '/' . urlencode($ura_dob) . '/' . urlencode($ura_nhs) . '/' . urlencode($ura_gender) . '/' . urlencode($labNo);
    $pdf_url = '/_dataset/gen_pdf/index/' . $CI->uri->segment(3) . '/' . urlencode($initial) . '/' . urlencode($fullname) . '/' . urlencode($serial_number) . '/' . urlencode($ura_barcode_no) . '/' . urlencode($ura_dob) . '/' . urlencode($ura_nhs) . '/' . urlencode($ura_gender) . '/' . urlencode($labNo);
    

    
    ?>
        <style>
        .padding-bottom {
            padding-bottom: 20px;
        }
        </style>
        <div class="tg-inputshold specimen_content">
            <div class="delete_add_specimen">
                <a href="javascript:;" class="tg-detailsicon add_specimen tg-themeiconcolorone" data-toggle="modal" data-target="#add_specimen_modal"> <i class="ti-plus"></i> </a>
                <a href="javascript:;" class="tg-detailsicon delete_specimen tg-themeiconcolortwo"> <i class="ti-trash"></i> </a>
            </div>
            <div class="modal fade" id="add_specimen_modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                <div class="tg-modaldialog modal-dialog" role="document">
                    <div class="tg-modalhead">
                        <a href="javascript:void(0);" class="fa fa-close tg-btnclose" data-dismiss="modal" aria-label="Close"></a>
                        <div class="tg-boxtitle">
                            <h2>Add Specimen</h2> </div>
                        <div class="tg-rightarea"> <a href="javascript:;" class="tg-btnspecimen btn-spcimen-add"><i class="fa fa-check"></i>Add
                            Specimen</a> </div>
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
                                    <select data-placeholder="Assisted by:" name="specimen_assisted_by" class="form-control selectpicker">
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
                                    <select data-placeholder="Block checked by:" name="specimen_block_checked_by" class="form-control selectpicker">
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
                                    <select data-placeholder="Labelled by:" name="specimen_labeled_by" class="form-control selectpicker">
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
                                    <select data-placeholder="QC’d by:" name="specimen_qcd_by" class="form-control selectpicker">
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
                                    <input type="text" class="form-control" name="specimen_slides" id="date" placeholder="Specimen Slides" /> </div>
                                <div class="form-group halfform-group">
                                    <?php $snomed_p_array = getSnomedCodes('p'); ?>
                                        <select name="specimen_snomed_p" id="specimen_snomed_p" class="form-control selectpicker" data-live-search="true">
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
                                        <select name="specimen_snomed_t1" id="specimen_snomed_t1" class="form-control selectpicker" data-live-search="true">
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
                                        <select name="specimen_snomed_t2" id="specimen_snomed_t2" class="form-control selectpicker" data-live-search="true">
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
                                    <textarea name="specimen_clinical_history" placeholder="Specimen Clinical  History"></textarea>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="specimen_macroscopic_description" placeholder="Specimen Macroscopic Description"></textarea>
                                </div>
                            </fieldset>
                            </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="add_block_modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                <div class="tg-modaldialog modal-dialog" role="document">
                    <div class="tg-modalhead">
                        <a href="javascript:void(0);" class="fa fa-close tg-btnclose" data-dismiss="modal" aria-label="Close"></a>
                        <div class="tg-boxtitle">
                            <h2>Add Block</h2> </div>
                        <div class="tg-rightarea"> <a href="javascript:;" class="tg-btnspecimen btn-block-add" onclick="$('#addBlockForm').submit();"><i class="fa fa-check"></i>Add
                            Block</a> </div>
                    </div>
                    <div class="tg-modalbody modal-body">
                        <?php
                    $attributes = array('class' => 'tg-formtheme tg-formspecimen specimen_form', 'id' => 'addBlockForm');
                    echo form_open("doctor/add_block_form/" . $record_id, $attributes);
                    ?>
                            <input type="hidden" name="specimen_id" id="block_specimen_id" value="">
                            <input type="hidden" name="lab_no" id="block_lab_no" value="">
                            <input type="hidden" name="inner_tab" id="block_inner_tab" value="">
                            <input type="hidden" name="block_counter" id="block_counter" value="">
                            <input type="hidden" name="specimen_count" id="specimen_count" value="">
                            <input type="hidden" name="specimen_tab" id="block_specimen_tab" value="">
                            <div class="row blocks_wrapper" id="blocks_check">
                                <div class="col-md-12">
                                    <h4>Blocks &nbsp;&nbsp; <a href="javascript:;" id="add_blck_btn_id" class="<?php echo "add_blocks_btn" . $inner_tab_count; ?>"><i class="fa fa-plus"></i></a></h4> </div>
                                <div class="col-md-2 padding-bottom">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating" name="block_lab_no[]" readonly>
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
                    <li class="nav-item <?php echo $active; ?>" data-currentspceimentab="<?php echo $count; ?>" data-specimenid="<?php echo $row->specimen_id; ?>" data-requestid="<?php echo $row->request_id; ?>"> <a data-toggle="tab" class="ds_click" data-ds-controls="<?php echo $count; ?>" href="#tabs_<?php echo $count; ?>">
                        Specimen
                        <?php echo $count; ?></a> </li>
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
                    <div class="tg-navtabsdetails tab-pane fade in <?php echo $tabs_active; ?>" id="tabs_<?php echo $inner_tab_count; ?>">
                        <form class="tg-formtheme tg-tabform tg-tabformvtwo doctor_update_specimen" id="doctor_update_specimen_record_<?php echo $inner_tab_count; ?>" method="post">
                            <div class="col-md-12 nopadding">
                                <div class="sec_title form-group"> Clinical <a href="javascript:;" class="checv_up_down"><i
                                        class="fa fa-chevron-down"></i></a> </div>
                                <div class="card hidden">
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
                                                <div class="form-group form-group-tiny" style="width:<?php echo $total_width; ?>;">
                                                    <label id="c_del">Clinical Details
                                                        <?php echo $i ?>
                                                    </label>
                                                    <textarea id="tg-tinymceeditor" name="specimen_clinical_history" class="tg-tinymceeditor editor_clinical_history_<?php echo intval($i); ?>">
                                                        <?php echo $row->specimen_clinical_history; ?>
                                                    </textarea>
                                                    <ul class="tg-themeinputbtn">
                                                        <li>
                                                            <?php
                                                                $checked = '';
                                                                if ($row->specimen_benign == 'benign') {
                                                                    $checked = 'checked';
                                                                }
                                                                ?> <span class="tg-radio">
                                                                    <input <?php echo $checked; ?> class="specimen_classification_<?php echo $inner_tab_count; ?>"><label for="specimen_benign_<?php echo $inner_tab_count; ?>">BT</label>
                                                                </span> </li>
                                                        <li>
                                                            <?php
                                                                $checked = '';
                                                                if ($row->specimen_inflammation == 'inflammation') {
                                                                    $checked = 'checked';
                                                                }
                                                                ?> <span class="tg-radio">
                                                                    <input <?php echo $checked; ?> type="checkbox"><label for="specimen_inflammation_<?php echo $inner_tab_count; ?>">IN</label>
                                                                </span> </li>
                                                        <li>
                                                            <?php
                                                                $checked = '';
                                                                if ($row->specimen_atypical == 'atypical') {
                                                                    $checked = 'checked';
                                                                }
                                                                ?> <span class="tg-radio">
                                                                    <input <?php echo $checked; ?> type="checkbox">
                                                                    <label for="specimen_atypical_<?php echo $inner_tab_count; ?>">AT</label>
                                                                </span> </li>
                                                        <li>
                                                            <?php
                                                                $checked = '';
                                                                if ($row->specimen_malignant == 'malignant') {
                                                                    $checked = 'checked';
                                                                }
                                                                ?> <span class="tg-radio">
                                                                    <input <?php echo $checked; ?> type="checkbox">
                                                                    <label for="specimen_malignant_<?php echo $inner_tab_count; ?>">MT</label>
                                                                </span> </li>
                                                    </ul>
                                                </div>
                                                <?php
                                                } else {
                                                    $total_width = 50 / ($specimen_total_count - 1);
                                                    ?>
                                                    <div class="form-group tg-inputicon tg-disabled-form-group" style="width:<?php echo $total_width . '% !important'; ?>"> <i class="ti-fullscreen"></i>
                                                        <label style="">Clinical Details
                                                            <?php echo intval($i); ?>
                                                        </label>
                                                        <textarea class=" form-control editor_clinical_history_<?php echo intval($i); ?>" placeholder="<?php echo @strip_tags($specimen_query[$j]->specimen_clinical_history); ?>"></textarea>
                                                        <ul class="tg-themeinputbtn">
                                                            <li> <span class="tg-radio">
                                                                    <input type="radio" id="tg-inputin1" name="inputin"
                                                                           value="inputin">
                                                                    <label for="tg-inputin1">IN</label>
                                                                </span> </li>
                                                            <li> <span class="tg-radio">
                                                                    <input type="radio" id="tg-inputbt1" name="inputin"
                                                                           value="inputin">
                                                                    <label for="tg-inputbt1">BT</label>
                                                                </span> </li>
                                                            <li> <span class="tg-radio">
                                                                    <input type="radio" id="tg-inputat1" name="inputin"
                                                                           value="inputin">
                                                                    <label for="tg-inputat1">AT</label>
                                                                </span> </li>
                                                            <li> <span class="tg-radio">
                                                                    <input type="radio" id="tg-inputmt1" name="inputin"
                                                                           value="inputin">
                                                                    <label for="tg-inputmt1">MT</label>
                                                                </span> </li>
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
                            <div class="col-md-12 form-group nopadding">
                                <div class="sec_title form-group"> Laboratory Process Flow <a href="javascript:;" class="checv_up_down"><i
                                        class="fa fa-chevron-down"></i></a> </div>
                                <div class="card hidden">
                                    <div class="card-body">
                                        <fieldset class="tg-tabfieldsettwo">
                                            <div class="tg-formgrouphold">
                                                <div class="form-group halfform-group">
                                                    <h3>Lab Entry</h3>
                                                    <div class="row">
                                                        <div class="col-sm-3"> <span class="avatar">
                                                            <img src="<?php echo base_urL('assets/img/person-male.png'); ?>"
                                                                 alt="">
                                                        </span> </div>
                                                        <div class="col-sm-9">
                                                            <p class="vertical-align-p">Stefan Williams </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group halfform-group">
                                                    <h3>Cut up / Grossing</h3>
                                                    <div class="row">
                                                        <div class="col-sm-3"> <span class="avatar">
                                                            <img src="<?php echo base_urL('assets/img/person-male.png'); ?>"
                                                                 alt="">
                                                        </span> </div>
                                                        <div class="col-sm-9">
                                                            <p class="vertical-align-p">Stefan Williams </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group halfform-group">
                                                    <h3>Assisted By</h3>
                                                    <div class="row">
                                                        <div class="col-sm-3"> <span class="avatar">
                                                            <img src="<?php echo base_urL('assets/img/person-male.png'); ?>"
                                                                 alt="">
                                                        </span> </div>
                                                        <div class="col-sm-9">
                                                            <p class="vertical-align-p">Stefan Williams </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group halfform-group">
                                                    <h3>Block Checked By</h3>
                                                    <div class="row">
                                                        <div class="col-sm-3"> <span class="avatar">
                                                            <img src="<?php echo base_urL('assets/img/person-male.png'); ?>"
                                                                 alt="">
                                                        </span> </div>
                                                        <div class="col-sm-9">
                                                            <p class="vertical-align-p">Stefan Williams </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group halfform-group">
                                                    <h3>Labeled By</h3>
                                                    <div class="row">
                                                        <div class="col-sm-3"> <span class="avatar">
                                                            <img src="<?php echo base_urL('assets/img/person-male.png'); ?>"
                                                                 alt="">
                                                        </span> </div>
                                                        <div class="col-sm-9">
                                                            <p class="vertical-align-p">Stefan Williams </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group halfform-group">
                                                    <h3>QC'd By</h3>
                                                    <div class="row">
                                                        <div class="col-sm-3"> <span class="avatar">
                                                            <img src="<?php echo base_urL('assets/img/person-male.png'); ?>"
                                                                 alt="">
                                                        </span> </div>
                                                        <div class="col-sm-9">
                                                            <p class="vertical-align-p">Stefan Williams </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="macroscopic-description-container" class="form-group form-group-tiny tg-lasttextarea tg-startextarea">
                                                <div id="" class="">
                                                    <label for="">Specimen Macroscopic Description </label>
                                                </div>
                                                <textarea novalidate required name="specimen_macroscopic_description" id="specimen_macroscopic_description" class="form-control tg-tinymceeditor form-controlactive" placeholder="Macroscopic Description">
                                                    <?php echo $row->specimen_macroscopic_description; ?>
                                                </textarea>
                                            </div>
                                            <div class="form-group halfform-group" style="float: right">
                                                <div class="sec_title form-group"> Block<a href="javascript:;" class="checv_up_down" data-toggle="collapse" data-target="#demo"><i
                                                        class="fa fa-chevron-down"></i></a> </div>
                                                <div id="demo" class="collapse">
                                                    <fieldset class="tg-tabfieldsettwo">
                                                        <button type="button" class="btn btn-info block_model_btn_<?php echo $inner_tab_count; ?>" data-specimenid="<?php echo $row->specimen_id; ?>" data-labno="<?php echo $row->lab_number; ?>" data-innertab="<?php echo $inner_tab_count; ?>" <?php if (array_key_exists($row->specimen_id, $prefixes_data)) { ?> data-specimenprefix ="
                                                            <?php echo $prefixes_data[$row->specimen_id]['specimen_prefix']; ?>" data-specimenblkprefix ="
                                                                <?php echo $prefixes_data[$row->specimen_id]['specimen_block_prefix']; ?>"
                                                                    <?php } else { ?> data-specimenprefix ="
                                                                        <?php echo $prefixes_data[0]['specimen_prefix']; ?>" data-specimenblkprefix ="
                                                                            <?php echo $prefixes_data[0]['specimen_block_prefix']; ?>"
                                                                                <?php } ?> style="float: right;margin-right: 20px;"><i class="fa fa-plus"></i></button>
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
                                                                        <td>
                                                                            <?php echo $sp_block->specimen_no; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $sp_block->block_no; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $sp_block->description; ?>
                                                                        </td>
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
                            <div class="col-md-12 form-group nopadding">
                                <div class="row">
                                    <div class="col-md-4">
                                        <button class="btn btn-primary btn-block">Cut Up/ Grossing</button>
                                    </div>
                                    <div class="col-md-8 text-right">
                                        <ul class="list-inline">
                                            <li>
                                                <a href="" class="btn btn-default btn-sm">
                                                    <img src="<?php echo base_url();?>/assets/icons/Secratory.png" class="img-fluid" width="30">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" class="btn btn-default btn-sm">
                                                    <img src="<?php echo base_url();?>/assets/icons/Secratory.png" class="img-fluid" width="30">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" class="btn btn-default btn-sm">
                                                    <img src="<?php echo base_url();?>/assets/icons/Secratory.png" class="img-fluid" width="30">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group nopadding">
                                <div class="col-md-12 nopadding">
                                    <div class="sec_title form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                Lab Entry
                                               <span class="info_lab">
                                                   <span><i class="fa fa-user"></i></span>
                                                   John Smith
                                               </span>
                                            </div>
                                            <div class="col-md-6">
                                                Cut Up
                                                <span class="info_lab">
                                                    <span><i class="fa fa-user"></i></span>
                                                    John Smith
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group nopadding">
                                <div class="sec_title">
                                    Specimen Microscopic Description
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                  
                                        <!-- Wrapper for slides -->
                                          <div class="carousel-inner" style="margin: 0 30px;">
                                            <div class="item active">
                                              <div class="row">
                                                  <div class="col-md-4">
                                                      <a href="javascript:;" class="btn btn-primary btn-block">Dermapathologist</a>
                                                  </div>
                                                  <div class="col-md-4">
                                                      <a href="javascript:;" class="btn btn-primary btn-block">Dermapathologist</a>
                                                  </div>
                                                  <div class="col-md-4">
                                                      <a href="javascript:;" class="btn btn-primary btn-block">Dermapathologist</a>
                                                  </div>
                                              </div>
                                            </div>
                                            <div class="item">
                                              <div class="row">
                                                  <div class="col-md-4">
                                                      <a href="javascript:;" class="btn btn-primary btn-block">Histoloygy</a>
                                                  </div>
                                                  <div class="col-md-4">
                                                      <a href="javascript:;" class="btn btn-primary btn-block">Histoloygy</a>
                                                  </div>
                                                  <div class="col-md-4">
                                                      <a href="javascript:;" class="btn btn-primary btn-block">Histoloygy</a>
                                                  </div>
                                              </div>
                                            </div>
                                            <div class="item">
                                              <div class="row">
                                                  <div class="col-md-4">
                                                      <a href="javascript:;" class="btn btn-primary btn-block">Hospital</a>
                                                  </div>
                                                  <div class="col-md-4">
                                                      <a href="javascript:;" class="btn btn-primary btn-block">Hospital</a>
                                                  </div>
                                                  <div class="col-md-4">
                                                      <a href="javascript:;" class="btn btn-primary btn-block">Hospital</a>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>

                                          <!-- Left and right controls -->
                                          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                            <span class="sr-only">Previous</span>
                                          </a>
                                          <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                            <span class="sr-only">Next</span>
                                          </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group noppadding">
                               
                            </div>
                            

                            <input type="hidden" name="snomed_m_value" class="snomed_m_value" value="">
                            <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                            <input type="hidden" name="specimen_id" value="<?php echo $row->specimen_id; ?>">
                            <div id="change-micro-x-val-<?php echo $inner_tab_count; ?>" class="modal fade change-micro-x-val" data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Enter X Value In Integer</h4> </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="number" name="micro_x_val" min="1" max="9"> </div>
                                            <div class="form-group pull-right">
                                                <button class="btn btn-success btn-add-x-val">Add</button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div id="sendprivatemessage" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Enquiry</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                    if (isset($error) && $error === true) {
                                        ?>
                                            <div class="row">
                                                <div class="alert alert-danger show">
                                                    <?php
                                                if (isset($errorMsgs) && !empty($errorMsgs)) {
                                                    foreach ($errorMsgs as $msg) {
                                                        ?>
                                                        <p>
                                                            <?php echo $msg; ?>
                                                        </p>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                </div>
                                            </div>
                                            <?php
                                    }
                                    ?>
                                                <?php
                                    $attributes = array('method' => 'POST', 'enctype' => "multipart/form-data",'id'=>"labEnquiryForm");
                                    echo form_open("labEnquiries/", $attributes);

                                    ?>
                                                    <input type="hidden" name='save_type' value='add' />
                                                    <input type="hidden" name='is_lab' value='<?php echo "1"; ?>' />
                                                    <input type="hidden" name='is_record' value='1' />
                                                    <input type="hidden" name='is_record_url' value='<?php echo uri_string(); ?>' />
                                                    <input type="hidden" name="ticket_record_id" value="<?php echo $record_id; ?>">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Ticket Subject <em class='text-danger'>*</em></label>
                                                                <input class="form-control" type="text" name='ticket_subject' id='ticket_subject' required> </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Lab Area</label>
                                                                <select id='product' name='product' class="form-control" required>
                                                                    <option value="GE">General Enquiry</option>
                                                                    <option value="RF">Request Form</option>
                                                                    <option value="MC">Macro cut up</option>
                                                                    <option value="MS">Micro - Slides</option>
                                                                    <option value="MB">Micro - Blocks</option>
                                                                    <option value="I">Immuno</option>
                                                                    <option value="S">Specials</option>
                                                                    <option value="R">Reports</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Laboratory</label>
                                                                <select id='user_lab_id' name='user_lab_id' class="form-control" required>
                                                                    <option value="<?php echo $labId; ?>">
                                                                        <?php echo getGroupNameById($labId); ?>
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <label>Priority</label>
                                                                    </div>
                                                                    <div class="col-sm-4 radio text-primary">
                                                                        <label>
                                                                            <input type="radio" name="ticket_priority" value='normal' checked> <strong>Normal</strong>
                                                                            <p>Non-Critical Queries, advice & support.</p>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-sm-4 radio text-warning">
                                                                        <label>
                                                                            <input type="radio" name="ticket_priority" value='high'> <strong>High</strong>
                                                                            <p>Important requests that are not Business Critical.</p>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-sm-4 radio text-danger">
                                                                        <label>
                                                                            <input type="radio" name="ticket_priority" value='critical'> <strong>Critical</strong>
                                                                            <p>Requests with Business Critical impact.</p>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Message <em class='text-danger'>*</em></label>
                                                                <textarea class="form-control" id='ticket_message' name='ticket_message'></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Your Reference</label>
                                                                <input class="form-control" type="text" id='ticket_reference' name='ticket_reference' />
                                                                <p><small>Optional - You can Provide Reference for your records. For Instance an
                                                        internal
                                                        Issue Tracking Number. </small></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <button class="btn btn-primary tck-swtchrs" type="button" data-toggle="collapse" data-target="#attachments" aria-expanded="false"> <i class='la la-paperclip'></i> Show Attachments </button>
                                                                <button class="btn btn-primary tck-swtchrs" type="button" data-toggle="collapse" data-target="#notifications" aria-expanded="false"> <i class='la la-bell'></i> Notification Settings </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row collapse" id='attachments' aria-expanded="false">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <h4 class="card-title">Attachments</h4> </div>
                                                                </div>
                                                                <div class="row justify-content-end">
                                                                    <div class="col-sm-4">
                                                                        <p class="mb-0">You Can Attach any file here which you think may help our engineers, for instance error message, screen shots or server log files.</p>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <input class="form-control" type="file" id='ticket_files' name='ticket_files[]' multiple='true'>
                                                                        <p><small>Allowed File Types: <span class='text-monospace'>pdf, doc, docx, jpg,
                                                jpeg, png, gif,</span></small>
                                                                            <br><small>Max Size: <strong
                                                                        class='text-monospace'>2 MB</strong></small></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row collapse" id='notifications' aria-expanded="false">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <h4 class="card-title">Notifications</h4> </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <p class="mb-0">Set weather you want text alerts, how replies can be made to the request and weather to CC responses to any other contacts on your Path Hub Account.</p>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group row">
                                                                                <label class="col-form-label col-md-12">CC Response To</label>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-md-12">
                                                                                    <input class="form-control" type="email" name='ticket_cc_to' id='ticket_cc_to' /> </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-form-label col-md-12">Reply Security</label>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-md-12">
                                                                                    <div class="radio">
                                                                                        <label>
                                                                                            <input type="radio" name="ticket_reply_thru" value='pathhub' checked> Reply must be made through PathHub </label>
                                                                                    </div>
                                                                                    <div class="radio">
                                                                                        <label>
                                                                                            <input type="radio" name="ticket_reply_thru" value='any'> Reply can be made through PathHub or Email </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group row">
                                                                                        <label class="col-form-label col-md-12">Receive Text Alerts</label>
                                                                                    </div>
                                                                                    <div class="radio">
                                                                                        <label>
                                                                                            <input type="radio" name="ticket_sms_alert" value='no' checked> No </label>
                                                                                    </div>
                                                                                    <div class="radio">
                                                                                        <label>
                                                                                            <input type="radio" name="ticket_sms_alert" value='yes'> Yes </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="submit-section">
                                                        <button class="btn btn-primary submit-btn tck-smbt-btn" type='submit'>Create Request</button>
                                                    </div>
                                                    </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                        jQuery(document).ready(function() {
                            /**
                             * Change Microscopic Code Description Modal
                             */
                            $(document).on('click', '#change_micro_desc_btn_<?php echo $inner_tab_count; ?>', function(e) {
                                e.preventDefault();
                                var _this = jQuery(this);
                                var form_id = <?php echo $inner_tab_count; ?>;
                                var micro_code_id = _this.parents('.tg-tabfieldsetbtn').find('input[name=specimen_microscopic_code]').data('microcodeid');
                                var micro_code = _this.parents('.tg-tabfieldsetbtn').find('input[name=specimen_microscopic_code]').val();
                                var micro_desc = _this.parents('.tg-tabfieldsetbtn').next('.tg-tabfieldsetthree').find('.specimen_microscopic_description_form_id').val();
                                $('#change_micro_code_desc_' + form_id).find('input[name=micro_code_id]').val(micro_code_id);
                                $('#change_micro_code_desc_' + form_id).find('.micro_code_edit_name').val(micro_code);
                                $('#change_micro_code_desc_' + form_id).find('.micro_code_edit_desc').val(micro_desc);
                                $('#change_micro_code_desc_' + form_id).modal({
                                    show: true
                                });
                            });
                            $(document).on('click', '#save-micro-change-btn-<?php echo $inner_tab_count; ?>', function(e) {
                                e.preventDefault();
                                var _this = $(this);
                                var micro_id = _this.parents('#change_micro_code_desc_<?php echo $inner_tab_count; ?>').find('input[name=micro_code_id]').val();
                                var micro_desc = _this.parents('#change_micro_code_desc_<?php echo $inner_tab_count; ?>').find('.micro_code_edit_desc').val();
                                jQuery.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url() . '/index.php/doctor/setMicroscopicCodeData'; ?>",
                                    data: {
                                        'micro_id': micro_id,
                                        'micro_desc': micro_desc
                                    },
                                    dataType: "json",
                                    success: function(response) {
                                        if(response.type === 'success') {
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
                            $(document).on('change', '.specimen_snomed_t1_<?php echo $inner_tab_count; ?>', function() {
                                var _this = jQuery(this);
                                _this.parents('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('#snomed-values-<?php echo $inner_tab_count; ?> .snomed-t1').text(_this.val() + '.');
                            });
                            $(document).on('change', '.specimen_snomed_t2_<?php echo $inner_tab_count; ?>', function() {
                                var _this = jQuery(this);
                                _this.parents('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('#snomed-values-<?php echo $inner_tab_count; ?> .snomed-t2').text(_this.val() + '.');
                            });
                            $(document).on('change', '.specimen_snomed_p_<?php echo $inner_tab_count; ?>', function() {
                                var _this = jQuery(this);
                                _this.parents('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('#snomed-values-<?php echo $inner_tab_count; ?> .snomed-p').text(_this.val() + '.');
                            });
                            $(document).on('change', '#doctor_update_specimen_record_<?php echo $inner_tab_count; ?> .specimen_snomed_m_<?php echo $inner_tab_count; ?>', function() {
                                var _this = jQuery(this);
                                var snome_multi_selected_vals = $('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('.specimen_snomed_m_<?php echo $inner_tab_count; ?> option:selected');
                                var snomedDiagnosesArr = [];
                                var snomedVals = [];
                                var rcpathScore = [];
                                if(snome_multi_selected_vals.length > 0) {
                                    _this.parents('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('#snomed-values-<?php echo $inner_tab_count; ?> .snomed-m').text(_this.val());
                                    $.each(snome_multi_selected_vals, function(parent_key, parent_value) {
                                        snomedDiagnosesArr = $(this).data('diagnoses').split(',');
                                        rcpathScore[parent_key] = $(this).data('rcpath');
                                    });
                                    var snomedCheckBox = jQuery('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('.specimen_classification_<?php echo $inner_tab_count; ?>');
                                    $.each(snomedDiagnosesArr, function(key, value) {
                                        $.each(snomedCheckBox, function(input_key, input_value) {
                                            if(typeof value !== 'undefined' && value == $(this).val()) {
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
                            jQuery('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?> input[name=specimen_diagnosis]').bind('keyup change', function() {
                                var _this = jQuery(this);
                                _this.attr('data-overwrite', 'ture');
                            });
                            jQuery('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').on('submit', function(e) {
                                e.preventDefault();
                                var _this = jQuery(this);
                                tinymce.triggerSave();
                                var snomed_value = $('.snomed_m_value').val();
                                var snomed_m = '';
                                if(snomed_value != '' && snomed_value != null) {
                                    snomed_m = snomed_value;
                                }
                                if(snomed_m.indexOf("melanoma") != -1) {
                                    if($('.snomed_check_mdt').val() == '') {
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
                                if(typeof _this.find('.specimen_snomed_t1_<?php echo $inner_tab_count; ?> :selected').data('tdesc') !== 'undefined') {
                                    snomed_t1_desc = _this.find('.specimen_snomed_t1_<?php echo $inner_tab_count; ?> :selected').data('tdesc');
                                }
                                if(typeof _this.find('.specimen_snomed_t2_<?php echo $inner_tab_count; ?> :selected').data('tdesc') !== 'undefined') {
                                    snomed_t2_desc = ' (' + _this.find('.specimen_snomed_t2_<?php echo $inner_tab_count; ?> :selected').data('tdesc') + ') — ';
                                }
                                if(typeof _this.find('.specimen_snomed_p_<?php echo $inner_tab_count; ?> :selected').data('pdesc') !== 'undefined') {
                                    snomed_p_desc = ' : ' + _this.find('.specimen_snomed_p_<?php echo $inner_tab_count; ?> :selected').data('pdesc');
                                }
                                var snome_multi_selected = $('.specimen_snomed_m_<?php echo $inner_tab_count; ?>').find("option:selected");
                                var arrSelected = [];
                                var snomed_m_desc_data = '';
                                snome_multi_selected.each(function() {
                                    arrSelected.push($(this).data('mdesc'));
                                    snomed_m_desc_data += $(this).data('mdesc') + ';';
                                });
                                var setData = snomed_t1_desc + snomed_p_desc + snomed_t2_desc + snomed_m_desc_data;
                                var move = false;
                                if(_this.find('.specimen_dignosis_<?php echo $inner_tab_count; ?>').attr('data-overwrite') == 'false') {
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
                                    success: function(response) {
                                        if(response.type === 'success') {
                                            jQuery('#doctor_update_specimen_record_message_<?php echo $inner_tab_count; ?>').html(response.msg);
                                            window.setTimeout(function() {
                                                location.reload(),
                                                    jQuery(document).scrollTop(0);
                                            }, 3000);
                                        } else {
                                            jQuery('#doctor_update_specimen_record_message_<?php echo $inner_tab_count; ?>').html(response.msg);
                                        }
                                    }
                                });
                            });
                        });
                        </script>
                        <script>
                        $(document).ready(function() {
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
                                submitHandler: function(form) {
                                    $.ajax({
                                        type: "POST",
                                        url: '<?php echo base_url('
                                        index.php / doctor / addSpecimenBlock '); ?>',
                                        data: $(form).serialize(),
                                        dataType: "json",
                                        success: function(response) {
                                            $('#add_block_modal').modal('hide');
                                            var specimenId = $('#block_specimen_id').val();
                                            if(response.type === 'success') {
                                                $("#specimen_" + specimenId + " .block_table").append(response.data);
                                                $.sticky(response.msg, {
                                                    classList: 'success',
                                                    speed: 200,
                                                    autoclose: 7000
                                                });
                                                location.reload();
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
                            var spec_count = <?php echo $inner_tab_count; ?>;
                            // var modal_btn_class_blck = ".block_model_btn_"+spec_count;
                            $(document).on('click', '.block_model_btn_' + spec_count, function(e) {
                                validator.resetForm();
                                blockForm.find(".error").removeClass("error");
                                var inner_tab_count = $(this).attr('data-innertab');
                                $('#block_specimen_id').val($(this).attr('data-specimenid'));
                                $('#block_lab_no').val($(this).attr('data-labno'));
                                // $('#block_inner_tab').val($(this).attr('data-innertab'));
                                $('#specimen_count').val(inner_tab_count);
                                $('#block_specimen_tab').val($(this).attr('data-specimenprefix'));
                                $('#block_inner_tab').val($(this).attr('data-specimenblkprefix'));
                                $("input[name='block_lab_no[]']").val($(this).attr('data-labno'));
                                $("input[name='block_specimen_no[]']").val($(this).attr('data-specimenprefix'));
                                $("input[name='block_no_of_blocks[]']").val($(this).attr('data-specimenprefix') + $(this).attr('data-specimenblkprefix'));
                                var inc_block_btn_class = 'add_blocks_btn_' + inner_tab_count;
                                $("#add_blck_btn_id").removeClass();
                                $("#add_blck_btn_id").addClass(inc_block_btn_class);
                                $(".add_block_div").remove();
                                $('#add_block_modal').modal('show');
                            });
                        });
                        </script>
                    </div>
                    <?php  $tabs_active = '';
                $inner_tab_count++; } ?>
            </div>
        </div>
        <script>
        $(document).ready(function() {
            var specimen_count = $("#specimen_count").val();
            var blocks_wrapper = $(".blocks_wrapper"); //Fields wrapper
            // var specimen_add_blck_btn_cls = ".add_blocks_btn_"+specimen_count;
            var blocks_wrapper_add_btn = $('.add_blocks_btn' + specimen_count); //Add button ID
            var x = 1; //initlal text box count
            $(blocks_wrapper_add_btn).click(function(e) { //on add input button click
                e.preventDefault();
                var block_lab_no = $('#block_lab_no').val();
                var block_inner_tab = $('#block_inner_tab').val();
                console.log("Bllock Var Type" + typeof(block_inner_tab));
                console.log("Block Value before: " + block_inner_tab);
                var block_specimen_tab = $('#block_specimen_tab').val();
                var add_block_inner_tab = ++block_inner_tab;
                $(blocks_wrapper).append('' + '<div class="add_block_div padding-bottom col-md-12"><div class="row"><div class="col-md-2"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="block_lab_no[]" value="' + block_lab_no + '" readonly>  <label class="focus-label">Lab No.</label> </div> </div>' + '<div class="col-md-2"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="block_specimen_no[]" value="' + block_specimen_tab + '" readonly>  <label class="focus-label" >Specimen No.</label> </div> </div>' + '<div class="col-md-2"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="block_no_of_blocks[]" value="' + block_specimen_tab + '' + add_block_inner_tab + '" readonly>  <label class="focus-label" >Block No.</label> </div> </div>' + '<div class="col-md-5"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="block_comments[]">  <label class="focus-label">Block Description</label> </div> </div>' + '<div class="col-md-1"> <a href="javascript:void(0)" class="blocks_remove_row btn btn-danger btn-sm"><i class="fa fa-minus"></i></a> </div>' + '</div> </div>'); //add inputs box
                $('#block_specimen_tab').val(block_specimen_tab);
                document.getElementById("block_inner_tab").value = add_block_inner_tab;
                x++; //text box increment
                // }
            });
            $(blocks_wrapper).on("click", ".blocks_remove_row", function(e) { //user click on remove text
                e.preventDefault();
                // var block_inner_tab = $('#block_inner_tab').val();
                // var min_block_inner_tab = --block_inner_tab;
                // document.getElementById("block_inner_tab").value = min_block_inner_tab;
                $(this).closest("div.add_block_div").remove();
                x--;
            });
        });
        $(document).ready(function() {
            $('#labEnquiryForm').validate({ // initialize the plugin
                rules: {
                    ticket_subject: {
                        required: true
                    },
                    user_lab_id: {
                        required: true
                    },
                    ticket_message: {
                        required: true
                    }
                }
            });
            $("#show-labenquiry-records").click(function() {
                $("#div-labenquiry-records").toggle();
            });
        });
        </script>
        <?php
}
?>