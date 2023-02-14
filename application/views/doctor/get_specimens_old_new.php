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
        $slide_data, $specimen_blocks, $testListArr, $categoriesArr) {
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

   // $group_row = $this->ion_auth->get_users_main_groups()->row()->group_type;

    $initial = uralensis_get_user_data($request_query[0]->uralensis_request_id, 'initial');
    $fullname = uralensis_get_user_data($request_query[0]->uralensis_request_id, 'fullname');
    $serial_number = uralensis_get_record_db_detail($request_query[0]->uralensis_request_id, 'serial_number');
    $ura_barcode_no = uralensis_get_record_db_detail($request_query[0]->uralensis_request_id, 'ura_barcode_no');
	$template_id = uralensis_get_record_db_detail($request_query[0]->uralensis_request_id, 'template_id');
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
       
        .padding-bottom{
            padding-bottom: 20px;
        }
        .test-list > .error{
            padding-top: 30px !important;
        }
        .comments_icon{
            position: relative;
        }
        .comments_icon .badge {
            position: absolute;
            top: -20px;
            right: -10px;
        }
        img.rounded-circle.user_image {
            position: absolute;
            border-radius: 50%;
            top: 5px;
            left: 22px;
        }
        .users_hh {
            display: none;
            position: absolute;
            top: 24px;
            background: #fff;
            font-size: 14px;
            border: 1px solid #ddd;
            padding: 0 5px;
            color: #555;
            cursor: default;
        }
        .cursor:hover {
            color: #00c5fb
        }

        .cursor {
            cursor: pointer
        }

        .like:hover .users_hh{
            display: block;
        }
		
		.tg-tabfieldsettwo .form-group-tiny > div {
    border: 1px solid #ddd !important;
}
textarea, select, .tg-select select, .form-control, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
    background : none !important;
}
input.form-control.typeahead.tt-hint {
    background: white !important;
}	

	
    </style>
    <div class="modal custom-modal fade" id="delete_billing_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Billing</h3>
                        <p>Are you sure want to delete this request data?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="javascript:void(0);" class="btn continue-btn billing-delete-btn">Delete</a>
                            </div>
                            <div class="col-md-6">
                                <a href="javascript:void(0);" data-dismiss="modal" class="btn cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="barcode_action" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="margin-top:10%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Barcode Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id=''>

                            <div class='col-md-12 text-center'>
                            <center class='center_class'>
                            <a href="javascript:barcode_p(this,1);" data-value="" id="btn_barcode" data-type="1"  class="btn btn-primary">Generate Barcode</a>
                            <a href="javascript:barcode_p(this,2);" data-value="" id="btn_sp_pot" data-type="2" class="btn btn-success">Specimen Pot</a>
                            <a href="javascript:barcode_p(this,3);" data-value="" id="btn_sp_request" data-type="2" class="btn btn-info">Request</a>
                            </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="barcode_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Barcode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id='br_box' style="margin: 0 auto; text-align: center; height: 95px !important; width: 95px !important; overflow:hidden;">
                        <!-- <div class='main' style="margin: 0 auto; text-align: center; height: 95px !important; width: 95px !important; overflow:hidden;">
                            <center class='center_class'>
                                <div class="barcode_wrap" style="border: 1px solid #777;padding: 2px;border-radius: 5px;">    
                                
                                </div>
                            </center>
                            <div class='col-md-12 text-center hide' id='br_error_box'>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="javascript:print_barcode('br_box')" class="btn btn-primary">Print</a>
                </div>
            </div>
        </div>
    </div>

    <div class="tg-inputshold specimen_content">

        <div class="col-md-12 nopadding">
            <div class="sec_title form-group">
                Clinical <a href="javascript:void(0);" class="checv_up_down"><i class="fa fa-chevron-up"></i></a>
            </div>
            <div class="card hidden show">
                <div class="card-body">
                    <fieldset class="tg-tabfieldsettwo">
                        <div class="form-group form-group-tiny" style="width:100% !important;">
                            <label>Clinical Details </label>
                            <textarea id="tg-tinymceeditor" name="clinical_history" class="tg-tinymceeditor dusrd3 editor_clinical_history"><?php echo $specimen_query[0]->specimen_clinical_history; ?></textarea>
                            <ul class="tg-themeinputbtn">
                                <li>
                                    <span class="tg-radio">
                                        <input class="dusrd3 specimen_classification" name="specimen_benign" value="benign" type="checkbox" id="specimen_benign" <?= (($specimen_query[0]->specimen_benign == 'benign') ? 'checked' : ''); ?>>
                                        <label for="specimen_benign">BT</label>
                                    </span>
                                </li>
                                <li>
                                    <span class="tg-radio">
                                        <input type="checkbox" class="dusrd3 specimen_classification" name="specimen_inflammation" value="inflammation" id="specimen_inflammation" <?= (($specimen_query[0]->specimen_inflammation == 'inflammation') ? 'checked' : ''); ?>>
                                        <label for="specimen_inflammation">IN</label>
                                    </span>
                                </li>
                                <li>
                                    <span class="tg-radio">
                                        <input type="checkbox" class="dusrd3 specimen_classification" name="specimen_atypical" value="atypical" id="specimen_atypical" <?= (($specimen_query[0]->specimen_atypical == 'atypical') ? 'checked' : ''); ?>>
                                        <label for="specimen_atypical">AT</label>
                                    </span>
                                </li>
                                <li>
                                    <span class="tg-radio">
                                        <input type="checkbox" class="dusrd3 specimen_classification" name="specimen_malignant" value="malignant" id="specimen_malignant" <?= (($specimen_query[0]->specimen_malignant == 'malignant') ? 'checked' : ''); ?>>
                                        <label for="specimen_malignant">MT</label>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    <div class="tg-inputshold specimen_content">

        <div class="delete_add_specimen hide">
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
            <div class="tg-modaldialog modal-dialog" role="document" style="margin-top:10%; width:400px">
                <div class="tg-modalhead">
                    <a href="javascript:void(0);" class="fa fa-close tg-btnclose" data-dismiss="modal"
                       aria-label="Close"></a>
                    
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
                    <div class="form-group  tg-withlabel">
                    No Of Speciman:
                            <input type="text" class="form-control" name="count_speciman" id="count_speciman" value="1" />
                        </div>
                    
                        <div class="form-group halfform-group tg-withlabel" style="display:none">
                            <select name="specimen_accepted_by" class="form-control selectpicker dusrd">
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
                        <div class="form-group halfform-group tg-withlabel" style="display:none">
                            <select name="specimen_cutupby" class="form-control selectpicker dusrd">
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
                        <div class="form-group halfform-group tg-withlabel" style="display:none">
                            <select data-placeholder="Assisted by:" name="specimen_assisted_by"
                                    class="form-control selectpicker dusrd">
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
                        <div class="form-group halfform-group tg-withlabel" style="display:none">
                            <select data-placeholder="Block checked by:" name="specimen_block_checked_by"
                                    class="form-control selectpicker dusrd">
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
                        <div class="form-group halfform-group tg-withlabel" style="display:none">
                            <select data-placeholder="Labelled by:" name="specimen_labeled_by"
                                    class="form-control selectpicker dusrd">
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
                        <div class="form-group halfform-group tg-withlabel" style="display:none"> 
                            <select data-placeholder="QC’d by:" name="specimen_qcd_by"
                                    class="form-control selectpicker dusrd">
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
                        <div class="form-group halfform-group tg-withlabel" style="display:none">
                            <select name="specimen_block" id="specimen_block" class="form-control dusrd selectpicker">
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
                        <div class="form-group halfform-group" style="display:none">
                            <input type="text" class="form-control dusrd" name="specimen_slides" id="date"
                                   placeholder="Specimen Slides"/>
                        </div>
                        <div class="form-group halfform-group" style="display:none">
                        Select PCode:
                            <?php $snomed_p_array = getSnomedCodes('p'); ?>
                            <select name="specimen_snomed_p" id="specimen_snomed_p" class="form-control dusrd selectpicker"
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
                        <div class="form-group halfform-group" style="display:none">
                        Select TCode:
                            <?php $snomed_t_array = getSnomedCodes('t1'); ?>
                            <select name="specimen_snomed_t1" id="specimen_snomed_t1" class="form-control dusrd selectpicker"
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
                        <div class="form-group halfform-group " style="display:none">
                            <?php $snomed_t2_array = getSnomedCodes('t2'); ?>
                            <select name="specimen_snomed_t2" id="specimen_snomed_t2" class="form-control dusrd selectpicker"
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
                        <div class="form-group halfform-group" style="display:none">
                        Select RCPath Code:
                            <select name="rcpath_code" class="form-control dusrd selectpicker">
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
                        <div class="form-group" style="display:none">
                            <textarea id="clinical_history" name="specimen_clinical_history"
                                      placeholder="Specimen Clinical  History"></textarea>
                        </div>
                        <div class="form-group" style="display:none">
                            <textarea class="form-control" name="specimen_macroscopic_description2"
                                      placeholder="Specimen Macroscopic Description"></textarea>
                        </div>
                    </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="add_block_modal" tabindex="-1" role="dialog" aria-hidden="true"
             data-backdrop="static">
            <div class="tg-modaldialog modal-dialog" role="document" style="margin-top:10%; width:600px">
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
                    <input type="hidden" name="block_counter" id="block_counter" value="">
                    <input type="hidden" name="specimen_count" id="specimen_count" value="">
                    <input type="hidden" name="specimen_tab" id="block_specimen_tab" value="">
                    <input type="hidden" name="test_description" id="test_description" value="">
                    <input type="hidden" name="test_name" id="test_name" value="">
                    <input type="hidden" name="patientDOB" id="patientDOB" value="<?php echo $specimen_query[0]->dob; ?>">
                    

                    <div class="row blocks_wrapper" id="blocks_check">
                        <!--<div class="col-md-12">
                            <h4>Blocks &nbsp;&nbsp; <a href="javascript:;" id="add_blck_btn_id" class="<?php /*echo "add_blocks_btn" . $inner_tab_count; */?>"><i class="fa fa-plus"></i></a></h4>
                        </div>-->
                        <div class="col-md-4 padding-bottom">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" name="block_lab_no[]" readonly >
                                <label class="focus-label">Lab No.</label>
                            </div>
                        </div>
                        <div class="col-md-3 padding-bottom" style="display:none">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" name="block_specimen_no[]" readonly>
                                <label class="focus-label">Specimen No.</label>
                            </div>
                        </div>
                        <div class="col-md-3 padding-bottom">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" name="block_no_of_blocks[]" readonly>
                                <label class="focus-label">Block No.</label>
                            </div>
                        </div>
                        <!-- <div class="col-md-3 padding-bottom">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" name="block_comments[]">
                                <label class="focus-label">Block Description</label>
                            </div>
                        </div> -->
                        <div class="col-md-4 padding-bottom">
                            <div class="form-group">
                                <select multiple name="test_ids[]" id="testName" placeholder="Test" class="test-list form-control select2">
                                    <?php foreach ($testListArr as $testRow) {
                                        echo '<option class="" value="'.$testRow['id'].'" title="'.$testRow['test_id'] .' : '.$testRow['name'].'">'.$testRow['name'].'</option>';
                                    } ?>
                                </select>
                                <label class="focus-label"></label>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="add_billing_modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
            <div class="tg-modaldialog modal-dialog" role="document">
                <div class="tg-modalhead">
                    <a href="javascript:void(0);" class="fa fa-close tg-btnclose" data-dismiss="modal"
                       aria-label="Close"></a>
                    <div class="tg-boxtitle">
                        <h2>Add Billing</h2>
                    </div>
                    <div class="tg-rightarea">
                        <a href="javascript:;" class="tg-btnspecimen btn-block-add" onclick="$('#addBillingForm').submit();"><i class="fa fa-check"></i>Save</a>
                    </div>
                </div>
                <div class="tg-modalbody modal-body">
                    <?php
                    $attributes = array('class' => 'tg-formtheme tg-form-billing billing_form', 'id' => 'addBillingForm');
                    echo form_open("laboratory/add_billing_by_request/", $attributes);
                    ?>
                    <input type="hidden" name="request_id" id="requestId" value="<?= $record_id; ?>" />
                    $request_query[0]->hospital_group_id
                    <input type="hidden" name="specimen_id" id="specimen_id" value="" />
                    <input type="hidden" name="clinic_id" id="clinic_id" value="" />
                    <input type="hidden" name="bill_type" id="bill_type" value="" />
                    <div class="row blocks_wrapper" id="blocks_check">
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                <label>Bill Code</label>
                                <div class="field_wrapper">
                                    <input name="bill_code" class="form-control numberonly" placeholder="Enter Bill Code" type="text" id="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" name="price" class="form-control numberonly" placeholder="Enter Price Here" id="" />
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6"><!-- padding-bottom -->
                            <div class="form-group">
                                <label>Bill Description </label>
                                <div class="field_wrapper">
                                    <textarea type="text" rows="2" name="bill_description" class="form-control" placeholder="Enter Bill Description"></textarea>
                                </div>
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
                <li 
                    class="nav-item <?php echo $active; ?>" 
                    data-currentspceimentab="<?php echo $count; ?>"
                    data-specimenid="<?php echo $row->specimen_id; ?>" 
                    data-requestid="<?php echo $row->request_id; ?>">

                    <!--                    <a 
                                            data-toggle="tab" 
                                            class="ds_click" 
                                            data-ds-controls="<?php echo $count; ?>"  
                                            data-target="#tabs, #dscd_<?php echo $count; ?>, #dsma_<?php echo $count; ?>, #dsmi_<?php echo $count; ?>, #dsf_<?php echo $count; ?>"  
                                            href="#tabs_<?php echo $count; ?>">
                                            Specimen
                    <?php echo $count; ?></a>-->
                    <a 
                        data-toggle="tab" id="doctor_update_specimen_record_btn_<?php echo $count-1; ?>" 
                        class="ds_click" 
                        data-ds-controls="<?php echo $count; ?>"  
                        href="#tabs_<?php echo $count; ?>">
                        Specimen
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
                        <div class="col-md-12 nopadding hide">
                            <div class="sec_title form-group">
                                Clinical <a href="javascript:;" class="checv_up_down"><i
                                        class="fa fa-chevron-up"></i></a>
                            </div>
                            <div class="card hidden show">
                                <div class="card-body">
                                    <fieldset class="tg-tabfieldset">
                                        <?php
                                        if (empty($request_query[0]->cl_detail)) {
                                            for ($i = 1; $i <= $specimen_total_count; $i++) {
                                                $j = $i - 1;
                                                if ($i === $inner_tab_count) {

                                                    if ($specimen_total_count === 1) {
                                                        $total_width = '100% !important';
                                                    } else {
                                                        $total_width = '100% !important';
                                                    }
                                                    ?>
                                                    <div class="form-group form-group-tiny"
                                                         style="width:<?php echo $total_width; ?>;">
                                                        <label>Clinical Details <?php echo $i ?></label>

                                                        <textarea id="tg-tinymceeditor_<?php echo intval($i); ?>" name="specimen_clinical_history"
                                                                  class="tg-tinymceeditor dusrd editor_clinical_history_<?php echo intval($i); ?>"><?php echo $row->specimen_clinical_history; ?></textarea>
                                                        <ul class="tg-themeinputbtn">
                                                            <li>
                                                                <?php
                                                                $checked = '';
                                                                if ($row->specimen_benign == 'benign') {
                                                                    $checked = 'checked';
                                                                }
                                                                ?>
                                                                <span class="tg-radio">
                                                                    <input <?php echo $checked; ?> class="dusrd specimen_classification_<?php echo $inner_tab_count; ?>"
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
                                                                                                   class="dusrd specimen_classification_<?php echo $inner_tab_count; ?>"
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
                                                                                                   class="dusrd specimen_classification_<?php echo $inner_tab_count; ?>"
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
                                                                                                   class="dusrd specimen_classification_<?php echo $inner_tab_count; ?>"
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
                                                    // $total_width = 50 / ($specimen_total_count - 1);
                                                    ?>
                                                    <div class="col-md-12 form-group tg-inputicon tg-disabled-form-group"
                                                         style="">
                                                        <i class="ti-fullscreen"></i>
                                                        <label style="visibility: hidden;">No label</label>
                                                        <textarea
                                                            class=" form-control dusrd editor_clinical_history_<?php echo intval($i); ?>"
                                                            placeholder="<?php echo @strip_tags($specimen_query[$j]->specimen_clinical_history); ?>"></textarea>
                                                        <ul class="tg-themeinputbtn">
                                                            <li>
                                                                <span class="tg-radio">
                                                                    <input type="radio" id="tg-inputin1" name="inputin" class="dusrd"
                                                                           value="inputin">
                                                                    <label for="tg-inputin1">IN</label>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="tg-radio">
                                                                    <input type="radio" id="tg-inputbt1" name="inputin" class="dusrd"
                                                                           value="inputin">
                                                                    <label for="tg-inputbt1">BT</label>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="tg-radio">
                                                                    <input type="radio" id="tg-inputat1" name="inputin" class="dusrd"
                                                                           value="inputin">
                                                                    <label for="tg-inputat1">AT</label>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="tg-radio">
                                                                    <input type="radio" id="tg-inputmt1" name="inputin" class="dusrd"
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


                        <div class="col-md-12 nopadding">
                            <div class="sec_title form-group">
                               Specimen Macroscopic Description <a href="javascript:;" class="checv_up_down"><i
                                        class="fa fa-chevron-up"></i></a>
                            </div>
                            <div class="card hidden show">
                                <div class="card-body">
                                    <fieldset class="tg-tabfieldsettwo">
                                        
                                        <div id="macroscopic-description-container"
                                             class="form-group form-group-tiny tg-lasttextarea tg-startextarea">
                                            <div id="" class="">
                                                <label for="">Specimen Macroscopic Description </label>
                                            </div>
                                            <textarea name="specimen_macroscopic_description"
                                                      id="specimen_macroscopic_description_<?php echo intval($key+1); ?>"
                                                      class="form-control tg-tinymceeditor-microscopic form-controlactive"
                                                      placeholder="Macroscopic Description"><?php echo $row->specimen_macroscopic_description; ?></textarea>
                                        </div>
                                        

                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

<div class="col-md-12 nopadding form-group">
                            <div class="sec_title form-group">
                                Blocks <a href="javascript:;" class="checv_up_down"><i
                                        class="fa fa-chevron-up"></i></a>
                            </div>
                            <div class="card hidden show">
                                <div class="card-body">
                                    <fieldset class="tg-tabfieldsettwo">
                                                    <button type="button" class="hide btn btn-info block_model_btn_<?php echo $inner_tab_count; ?>"
                                                            data-specimenid="<?php echo $row->specimen_id; ?>"
                                                            data-labno="<?php echo $row->lab_number; ?>"
                                                            data-innertab="<?php echo $inner_tab_count; ?>"
                                                            <?php if (array_key_exists($row->specimen_id, $prefixes_data)) {
                                                                ?>
                                                                data-specimenprefix ="<?php echo $prefixes_data[$row->specimen_id]['specimen_prefix']; ?>"
                                                                data-specimenblkprefix ="<?php echo $prefixes_data[$row->specimen_id]['specimen_block_prefix']; ?>"
                                                            <?php } else { ?>
                                                                data-specimenprefix ="<?php echo $prefixes_data[0]['specimen_prefix']; ?>"
                                                                data-specimenblkprefix ="<?php echo $prefixes_data[0]['specimen_block_prefix']; ?>"
                                                            <?php } ?>
                                                            style="float: right;margin-right: 20px;"><i
                                                            class="fa fa-plus"></i></button>
                                                    <table class="table custom-table table-striped datatables dataTable no-footer" id="specimen_<?php echo $row->specimen_id; ?>">
                                                        <thead>
                                                        <th>Lab No.</th>                                                        
                                                        <th>Block No.</th>
                                                        
                                                        <th>Test</th>
                                                       
                                                        <!--<th>Block Description</th>-->
                                                        <th>Action</th>
                                                        </thead>
                                                        <tbody class="block_table">
                                                        <?php 
                                                            $lab_no = $row->lab_number; $lab_id = $row->id;
                                                            $parameters = array();
                                                            $parameters['lab_no'] = $lab_no;
                                                            $parameters['request_id'] = $request_query[0]->uralensis_request_id;                                                            
                                                            $parameters['lab_id'] = $lab_id;
                                                            //print_r($parameters);
                                                        ?>
                                                            <?php
                                                            $cnt = 0;
                                                            $list = json_decode(json_encode($specimen_blocks), true);
                                                            $count_speciment_block_tem = array_count_values(array_column($list, 'specimen_id'))[$row->specimen_id];
                                                            foreach ($specimen_blocks as $key => $sp_block) {
                                                                if ($sp_block->specimen_id == $row->specimen_id) {
                                                                    $cnt++;
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $row->lab_number;  ?></td>
                                                                        <td><?php echo $sp_block->block_no; ?></td>
                                                                       <!-- <td><?php $test = "H&E"; if($sp_block->name!='') { echo $test =$sp_block->name; } else { print "H&E";} ?></td> -->
                                                                        <td>
                                                                        <select multiple name="test_ids[]" data-id="<?= $sp_block->id; ?>" data-sid="<?php echo $sp_block->specimen_id; ?>" data-sno="<?php echo $sp_block->specimen_no; ?>" data-bno="<?php echo $sp_block->block_no; ?>" id="" placeholder="Test" class="test_wrap test-list form-control select2">
                                                                                <?php 
                                                                                    $temp = 0;
                                                                                    foreach ($testListArr as $testRow) {
                                                                                    $test_name = explode(",",$sp_block->test_names);
                                                                                    $selected = (in_array($testRow['name'], $test_name)) ? 'selected' : '';
                                                                                    if(($sp_block->name =='' || $sp_block->name =='H&E' ) && $temp == 0){
                                                                                        echo '<option class="" value="0" title="H&E" selected>H&E</option>';
                                                                                        $temp++;
                                                                                    }
                                                                                    echo '<option class="" value="'.$testRow['id'].'" title="'.$testRow['test_id'] .' : '.$testRow['name'].'" '.$selected.'>'.$testRow['name'].'</option>';
                                                                                } ?>
                                                                            </select>
                                                                        </td>
                                                                      
<!--                                                                        <td>--><?php echo $sp_block->description; ?><!--</td>-->
                                                                        <td>
                                                                        <?php 
                                                                        
                                                                        $parameters['test_id'] = $sp_block->test_ids; 
                                                                        // $parameters['test'] = $sp_block->test_names;
                                                                        $tests_values = '';
                                                                        $testInfo = explode(",",$sp_block->test_names);
                                                                        foreach($testInfo as $keyt => $testname){
                                                                            $tests_values.= $testname."_block_".$sp_block->block_no.",";
                                                                        }
                                                                        $tests_values = trim($tests_values, ",");
                                                                        $parameters['test'] = $tests_values;
                                                                        $param = '';
                                                                        $param = json_encode($parameters);
                                                                        
                                                                        ?>
                                                                        <a href='javascript:barcode_type(<?= $param; ?>)' class='hide text-success' title="Print Barcode."><strong><i class="fa-2x fa fa-barcode m-r-5"></i></strong></a>
                                                                        <!-- <a href="<?php echo site_url() . '/doctor/delete_multiple_test/' . urlencode($sp_block->test_ids) .'/'. $record_id; ?>" title="Remove this test."><strong><i class="fa-2x fa fa-trash-o m-r-5"></i></strong></a></td> -->
                                                                        <?php if($count_speciment_block_tem == $cnt) { ?>
                                                                            <a href="javascript:void(0);" data-sno="<?php echo $sp_block->specimen_no; ?>" data-href="<?php echo site_url() . '/doctor/delete_multiple_test/' . urlencode($sp_block->test_ids) .'/'. $record_id; ?>" title="Remove this test." class="hide delete_test"><strong><i class="fa-2x fa fa-trash-o m-r-5"></i></strong></a></td>
                                                                        <?php } ?>
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
                        </div>


                        <div class="col-md-12 nopadding form-group">
                            <div class="sec_title form-group">
                                Block/Specimen Type
                                <a href="javascript:;" class="checv_up_down"><i class="fa fa-chevron-up"></i></a>
                            </div>
                            <div class="card hidden show">
                                <div class="card-body">
                                    <fieldset class="tg-tabfieldsettwo">
                                        <table class="table custom-table table-striped datatables dataTable no-footer" id="specimen_<?php echo $row->specimen_id; ?>">
                                            <thead>
                                            <tr>
                                                <th>Block</th>
                                                <th>Specimen Type</th>
                                                <th>Tissue Type</th>
                                                <th>Number of Sliders</th>
                                                <th>Billing Code</th>
                                            </tr>
                                            </thead>
                                            <tbody class="block_table">
                                            <tr>
                                                <td><?= $row->specimen_block; ?></td>
                                                <td>
                                                    <select name="" class="form-control select2">
                                                        <?php if(count($row->specimenArr) > 0){
                                                            foreach ($row->specimenArr as $specimenType) {
                                                                $selectedSpecimen = ($row->specimen_id_val == $specimenType['id']) ? 'selected' : '';
                                                                ?>
                                                            <option value="<?= $specimenType['id']; ?>" <?= $selectedSpecimen; ?>><?= $specimenType['name']; ?></option>
                                                        <?php } } else { ?>
                                                            <option value="">No record found</option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select  name="" class="form-control select2">
                                                        <?php if(count($row->tissueTypeArr) > 0){
                                                            foreach ($row->tissueTypeArr as $tissueType) {
                                                                $selectedTissue = ($row->tissue_type_id == $tissueType['id']) ? 'selected': '';
                                                                ?>
                                                        <option value="<?= $tissueType['id']; ?>" <?= $selectedTissue; ?>><?= $tissueType['name']; ?></option>
                                                        <?php } } else { ?>
                                                            <option value="">No record found</option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td><?= $row->specimen_slides; ?></td>
                                                <td><?= (count($row->bill_code_arr) > 0) ? $row->bill_code_arr[0]['bill_code'] : ''; ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        

                        <div class="col-md-12 nopadding form-group">
                            <div class="sec_title form-group">
                                Billing
                                <a href="javascript:;" class="checv_up_down"><i class="fa fa-chevron-up"></i></a>
                            </div>
                            <div class="card hidden show">
                                <div class="card-body">
                                    <fieldset class="tg-tabfieldsettwo">
                                        <div class="col-md-11">
                                            <div class="radio">
                                                <label for="by_request"><input type="radio" name="billing_type" class="billing_type dusrd" value="by_request" id="by_request" <?= ($row->billing_type2 == 'by_request' || empty($row->billing_type)) ? 'checked' : ''; ?>> By Request</label>
                                                &nbsp;&nbsp;
                                                <label for="by_specimen"><input type="radio" name="billing_type" class="billing_type dusrd" value="by_specimen" id="by_specimen" <?= ($row->billing_type2 == 'by_specimen') ? 'checked' : ''; ?>> By Specimen</label>
                                                &nbsp;&nbsp;
                                                <label for="not_billed"><input type="radio" name="billing_type" class="billing_type dusrd" value="not_billed" id="not_billed" <?= ($row->billing_type2 == 'not_billed') ? 'checked' : ''; ?>> Not Billed (PCI)</label>
                                            </div>
                                        </div>
                                        <!--<div class="col-md-1">
                                            <button type="button" class="btn add_new_bill btn-info billing_model_btn_<?/*= $inner_tab_count; */?>" data-specimenid="<?/*= $row->specimen_id; */?>" data-labno="<?/*= $row->lab_number; */?>" data-innertab="<?/*= $inner_tab_count; */?>" style="float: right;margin-right: 20px;"><i class="fa fa-plus"></i></button>
                                        </div>-->
                                        <div class="specimen_bill_div">
                                        <?php $k=0; foreach ($specimen_query as $key1=>$row1) {
                                            $k++;
                                            if($row1->specimen_id != $row->specimen_id){ continue; }
                                            ?>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <strong>Specimen <?= $k; ?></strong>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <select multiple name="bill_code[<?= $row1->specimen_id; ?>][]" class="form-control dusrd select2" data-live-search="true">
                                                                <option value="">Select Bill Code</option>
                                                                <?php
                                                                    $addedIds = array_column($row->request, 'bill_code');
                                                                    foreach ($row1->bill_code_arr as $bData){
                                                                ?>
                                                                    <option value="<?= $bData['id']; ?>" <?= (in_array($bData['id'], $addedIds)) ? 'selected' : ''; ?>><?= $bData['bill_code']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="clearfix"></div>

                                                    <?php if(count($row->request) > 0){ ?>
                                                        <br>
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-3">
                                                            <label>Bill Code</label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>Price</label>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <label>Description</label>
                                                        </div>
                                                        <div class="col-md-1 hide">
                                                            <label>Action</label>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    <?php } ?>


                                                        <!--<div class="col-md-12">
                                                            <strong>Specimen <?/*= $k; */?></strong>
                                                        </div>
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-2 form-group">
                                                            <label>Bill Code</label>
                                                            <input class="form-control bill_code_display1" value="<?/*= $row1->bill_code_text; */?>" type="text" readonly />
                                                            <input class="form-control bill_code_id" value="<?/*= $row1->bill_code; */?>" type="hidden" />
                                                            <input class="form-control bill_type" value="<?/*= $row1->billing_type; */?>" type="hidden" />
                                                            <input class="form-control specimen_id" value="<?/*= $row1->specimen_id; */?>" type="hidden" />
                                                            <select name="bill_code[<?/*= $row1->specimen_id; */?>]" class="form-control bill_code bill_code_display2" id="bill_code_<?php /*echo intval($row1->specimen_id); */?>" style="display: none;">
                                                                <option value="">Select Bill Code</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>Price</label>
                                                            <input name="bill_code_text[<?/*= $row1->specimen_id; */?>]" class="bill_code_text" value="<?/*= $row1->bill_code_text; */?>" type="hidden" />
                                                            <input name="bill_price[<?/*= $row1->specimen_id; */?>]" class="form-control bill_price" value="<?/*= $row1->bill_price; */?>" id="bill_price_<?/*= $row1->specimen_id; */?>" readonly />
                                                        </div>
                                                        <div class="col-md-5">
                                                            <label>Description</label>
                                                            <input name="bill_description[<?/*= $row1->specimen_id; */?>]" placeholder="Enter Bill Description" id="bill_description_<?/*= $row1->specimen_id; */?>" class="form-control bill_description" value="<?/*= $row1->bill_description; */?>" />
                                                        </div>
                                                        <div class="col-md-1">
                                                            <label>Action</label>
                                                        </div>
                                                    </div>
                                                    <hr/>-->
                                            <?php foreach($row->request as $reqRow){ $row2 = (object) $reqRow; if(!empty($row2->bill_code_text)) { ?>
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-2 form-group">
                                                        <input class="form-control" value="<?= $row2->bill_code_text; ?>" type="text" readonly />
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input class="form-control" value="<?= $row2->bill_price; ?>" type="text" readonly />
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input class="form-control" value="<?= $row2->bill_description; ?>" type="text" readonly />
                                                    </div>
                                                    <div class="col-md-1 hide">
                                                        <a href="javascript:void(0);" class="delete_billing" data-url="<?= base_url("laboratory/delete_billing_by_request/$row2->id/$row2->request_id"); ?>" style="font-size:35px;"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </div>
                                            <?php } }  ?>
                                        <?php } ?>
                                        </div>
                                    </fieldset>
                                </div>
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
                                                    <div class="col-xs-3">
                                                        <span class="avatar">
                                                            <img src="<?php echo base_urL('assets/img/person-male.png'); ?>"
                                                                 alt="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-9">
                                                        <p class="vertical-align-p">Stefan Williams </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group halfform-group">
                                                <h3>Cut up / Grossing</h3>
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <span class="avatar">
                                                            <img src="<?php echo base_urL('assets/img/person-male.png'); ?>"
                                                                 alt="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-9">
                                                        <p class="vertical-align-p">Stefan Williams </p>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group halfform-group">
                                                <h3>Assisted By</h3>
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <span class="avatar">
                                                            <img src="<?php echo base_urL('assets/img/person-male.png'); ?>"
                                                                 alt="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-9">
                                                        <p class="vertical-align-p">Stefan Williams </p>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group halfform-group">
                                                <h3>Block Checked By</h3>
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <span class="avatar">
                                                            <img src="<?php echo base_urL('assets/img/person-male.png'); ?>"
                                                                 alt="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-9">
                                                        <p class="vertical-align-p">Stefan Williams </p>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group halfform-group">
                                                <h3>Labeled By</h3>
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <span class="avatar">
                                                            <img src="<?php echo base_urL('assets/img/person-male.png'); ?>"
                                                                 alt="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-9">
                                                        <p class="vertical-align-p">Stefan Williams </p>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group halfform-group">
                                                <h3>QC'd By</h3>
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <span class="avatar">
                                                            <img src="<?php echo base_urL('assets/img/person-male.png'); ?>"
                                                                 alt="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-9">
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
                                            <?php //echo $row->specimen_slides;         ?><!--"-->
                                            <!--                                                       placeholder="Slide No:">-->
                                            <!--                                            </div>-->
                                            <!--                                    <div class="sec_title form-group">-->
                                            <!--                                        Block  <a href="javascript:;" class="checv_up_down"><i class="fa fa-chevron-up"></i></a>-->
                                            <!--                                    </div>-->
                                            <!--                                            <button type="button" class="btn btn-info" data-toggle="collapse"-->
                                            <!--                                                    data-target="#demo">Block-->
                                            <!--                                            </button>-->
                                        </div>
                                        
                                        

                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        
                        
                        <?php if (get_ds_status($CI->uri->segment(3)) == 0) { ?>
                            <div class="col-md-12 nopadding">
                                <div class="sec_title form-group">
                                    Microscopic Description <a href="javascript:;" class="checv_up_down"><i
                                            class="fa fa-chevron-up"></i></a>
                                </div>
                                <div class="card hidden show">
                                    <div class="card-body">
                                        <fieldset class="tg-tabfieldsetthree specimen-micro-area">
                                            <div class="form-group">
                                            <select multiple name="specimen_microscopic_code[]"
                                                    data-formid="<?php echo $inner_tab_count; ?>"
                                                    class="form-control select2 microscopicCode"
                                                    id="microscopicCodeId<?php echo $inner_tab_count; ?>"
                                                    data-live-search="true">
                                                <option data-hidden="true">Nothing Select</option>
                                                <?php
                                                $microArray = explode(",",$row->specimen_microscopic_code);
                                                echo "<pre>";
                                                print_r($microArray);
                                                foreach ($request_query[0]->microscopicList as $value) {
                                                    $selected = '';
                                                    if(in_array($value->umc_code, $microArray)) {
                                                        $selected = 'selected';
                                                    }
                                                    if($value->umc_code != ''){
                                                        echo '<option data-tdesc="' . $value->umc_micro_desc . '" value="' .$value->umc_code . '" ' . $selected . '>' . $value->umc_code . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                                <!-- <input type="text" data-microcodeid=""
                                                       data-formid="<?php echo $inner_tab_count; ?>"
                                                       name="specimen_microscopic_code"
                                                       class="form-control dusrd specimen_microscopic_code"
                                                       id="specimen_microscopic_code"
                                                       placeholder="Specimen Microscopic Code"
                                                       value="<?php echo $row->specimen_microscopic_code; ?>"> -->
                                            </div>
                                            <div class="form-group halfform-group">
                                                <span class="tg-select">
                                                    <select id="rcpath_codedata" data-placeholder="RCPath Code" name="rcpath_code"
                                                            class="form-control dusrd rcpath_codedata rcpath_codedata_<?php echo $inner_tab_count; ?>">
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
                                                            First Name: <strong><?php echo $row->f_name; ?></strong>
                                                        </span>
                                                        <span class="microscopy_title_detail">
                                                            Last Name: <strong><?php echo $row->sur_name; ?></strong>
                                                        </span>
                                                        
                                                        <span class="microscopy_title_detail">
                                                            Lab Number: <strong><?php echo $row->lab_number; ?></strong>
                                                        </span>
                                                    </div>
                                          <textarea class="tg-tinymceeditor specimen_microscopic_description" name="specimen_microscopic_description" id="specimen_microscopic_description_<?php echo $inner_tab_count; ?>" placeholder="Microscopic Description" style="min-height:350px;"><?php echo trim($row->specimen_microscopic_description); ?></textarea>
                                                              
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="clearfix"></div>


                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div>
                            <!--FULL DATASET BCC-->
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
                                                    BASAL CELL CARCINOMA Dataset : <small>Specimen <?= $get_bcc_record[$clinical_arr]['patient_specimen'] ?></small><a href="javascript:;" class="checv_up_down"><i
                                                            class="fa fa-chevron-down"></i></a>
                                                </div>
                                                <div class="card hidden">
                                                    <div class="card-body">
                                                        <div class=" pull-right ">

                                                            <a title="Basal Cell Carcinoma" href="<?php echo site_url('_dataset/basal_cell_dataset/' . $dataset_url . '/' . $get_bcc_record[$clinical_arr]['patient_specimen']) ?>" class="btn btn-primary btn-rounded">
                                                                <i class="fa fa-pencil"> Edit</i>
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
                                                                    <textarea 
                                                                        novalidate 
                                                                        required
                                                                        class="form-control form-controlactive tg-tinymceeditor specimen_microscopic_description3"
                                                                        name=" "
                                                                        id=" "
                                                                        placeholder=" "
                                                                        style="min-height:350px;">                                                                                                                     
                                                                        Speciment Type : <?= $data_set['Specimen_type'] ?><br>
                                                                        Tumour type:  <br>
                                                                        Subtype:  <br>
                                                                        Basosquamous component : <br>
                                                                        Extent : <br>
                                                                        Perinueural invasion : <?= $data_set['n_invasion'] ?><br>
                                                                        Lymphovascular invasion : <?= $data_set['n_carcinoma'] ?><br>
                                                                        Maximum tumour diameter : <?= $data_set['Maximum_Indicate'] ?><br> 
                                                                        Maximum tumour depth: <?= $data_set['Maximum_Dimention'] . ' mm' ?><br>
                                                                        Clark level : <br> 
                                                                        Margins : <?= $data_set['n_Peripheral'] . ' mm; deep ' . $data_set['n_Deep'] . ' mm' ?><br>
                                                                        Additional comments : <?= $data_set['bcc_comments'] ?><br>
                                                                        Pathological risk status for skin cancer MDT : <?= $data_set['Histological_low'] != '' ? 'low' : 'high' ?><br>
                                                                        TBN pathological (p) stage (AJCC8) : <?= $data_set['ptnm'] ?> <?= $data_set['ptnm'] ?> <?= $data_set['ptnm'] ?><br>
                                                                        Summary : <br>
                                                                    </textarea>
                                                                </div>
                                                            </fieldset>
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
                            <!--FULL DATASET SSC-->
                            <div class="">
                                <?php
                                if (!empty($get_ssc_record)) {
                                    for ($clinical_arr = 0; $clinical_arr < sizeof($get_ssc_record); $clinical_arr++) {
                                        $html_response = $get_ssc_record[$clinical_arr]['ssc_response_html'];
                                        $data_set = json_decode($get_ssc_record[$clinical_arr]['ssc_data'], true);
                                        ?>
                                        <div id="dsf_<?= $get_ssc_record[$clinical_arr]['patient_specimen'] ?>">
                                            <div class="col-md-12 nopadding">
                                                <div class="sec_title form-group">
                                                    INVASIVE SQUAMOUS CELL CARCINOMA Dataset : <small>Specimen <?= $get_ssc_record[$clinical_arr]['patient_specimen'] ?></small><a href="javascript:;" class="checv_up_down"><i
                                                            class="fa fa-chevron-down"></i></a>
                                                </div>
                                                <div class="card hidden">
                                                    <div class="card-body">
                                                        <div class=" pull-right ">

                                                            <a title="INVASIVE SQUAMOUS CELL CARCINOMA" href="<?php echo site_url('_dataset/squamous_cell_dataset/' . $dataset_url . '/' . $get_ssc_record[$clinical_arr]['patient_specimen']) ?>" class="btn btn-primary btn-rounded">
                                                                <i class="fa fa-pencil"> Edit</i>
                                                            </a>
                                                        </div>
                                                        <!--                                                        <div class="edit_icon pull-right "   style="margin-right:10px">
                                                        
                                                                                                                    <a title="Download INVASIVE SQUAMOUS CELL CARCINOMA" href="<?= site_url($pdf_url) ?>" target="_blank" class="btn btn-primary btn-rounded">
                                                                                                                        <i class="fa fa-floppy-o"></i>
                                                                                                                    </a>
                                                                                                                </div>-->
                                                        <div class="delete_icon pull-right"   style="margin-right:10px">
                                                            <a onclick="return confirm_delete();" href="<?php echo site_url('_dataset/squamous_cell_dataset/removeDatasetbyID/' . $get_ssc_record[$clinical_arr]['dataset_record_id'] . '/' . $get_ssc_record[$clinical_arr]['record_id']) ?>" class="btn btn-danger btn-rounded"><i class="fa fa-trash"></i>  </a>

                                                        </div>



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
                                                                    <textarea 
                                                                        novalidate 
                                                                        required
                                                                        class="form-control form-controlactive tg-tinymceeditor specimen_microscopic_description3"
                                                                        name=""
                                                                        id=" "
                                                                        placeholder=" "
                                                                        style="min-height:350px;">                                                                                                                     
                                                                        Site : <?= $data_set['site'] ?><br>
                                                                        Specimen Type: <?= $data_set['specimen_type'] ?><br>
                                                                        Subtype: <?= $data_set['subtype'] ?><br>
                                                                        Differentiation : <?= $data_set['differentiation'] ?><br>
                                                                        Perineurial Invasion : <?= $data_set['perineurialInvasion'] ?><br>
                                                                        Lymphovascular invasion : <?= $data_set['lymphovascularInvasion'] ?><br>
                                                                        Maximum tumour diameter : <?= $data_set['max_diameter'] . ' mm' ?><br>
                                                                        Maximum tumour depth: <?= $data_set['depth'] . ' mm' ?><br>
                                                                        Clark level : <?= $data_set['clark_level'] ?><br>
                                                                        Margins : <?= 'epidermal: ' . $data_set['epidermal'] . ' mm deep: ' . $data_set['deep'] . ' mm' ?><br>
                                                                        Additional comments : <?= $data_set['additionalComments'] ?><br>
                                                                        Pathological risk status for skin cancer MDT : <?= $data_set['risk'] ?><br>
                                                                        TBN pathological (p) stage (AJCC8) : <?= $data_set['tnm'] ?><br>
                                                                        Summary : <?= $data_set['summary'] ?><br>
                                                                    </textarea>
                                                                </div>
                                                            </fieldset>
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
                            <!--FULL DATASET CMM-->
                            <div class="">
                                <?php
                                if (!empty($get_cmm_record)) {
                                    for ($clinical_arr = 0; $clinical_arr < sizeof($get_cmm_record); $clinical_arr++) {
                                        $html_response = $get_cmm_record[$clinical_arr]['cmm_response_html'];
                                        $data_set = json_decode($get_cmm_record[$clinical_arr]['cmm_data'], true);
                                        ?>
                                        <div id="dsf_<?= $get_cmm_record[$clinical_arr]['patient_specimen'] ?>">
                                            <div class="col-md-12 nopadding">
                                                <div class="sec_title form-group">
                                                    CUTANEOUS MALIGNANT MELANOMA CARCINOMA Dataset : <small>Specimen <?= $get_cmm_record[$clinical_arr]['patient_specimen'] ?></small><a href="javascript:;" class="checv_up_down"><i
                                                            class="fa fa-chevron-down"></i></a>
                                                </div>
                                                <div class="card hidden">
                                                    <div class="card-body">
                                                        <div class=" pull-right ">

                                                            <a title="Cutaneous Malignant Melanoma Carcinoma" href="<?php echo site_url('_dataset/cutaneous_malignant_melanoma_dataset/' . $dataset_url . '/' . $get_cmm_record[$clinical_arr]['patient_specimen']) ?>" class="btn btn-primary btn-rounded">
                                                                <i class="fa fa-pencil"> Edit</i>
                                                            </a>
                                                        </div>
                                                        <!--                                                        <div class="edit_icon pull-right "   style="margin-right:10px">
                                                        
                                                                                                                    <a title="Download INVASIVE SQUAMOUS CELL CARCINOMA" href="<?= site_url($pdf_url) ?>" target="_blank" class="btn btn-primary btn-rounded">
                                                                                                                        <i class="fa fa-floppy-o"></i>
                                                                                                                    </a>
                                                                                                                </div>-->
                                                        <div class="delete_icon pull-right"   style="margin-right:10px">
                                                            <a onclick="return confirm_delete();" href="<?php echo site_url('_dataset/cutaneous_malignant_melanoma_dataset/removeDatasetbyID/' . $get_cmm_record[$clinical_arr]['dataset_record_id'] . '/' . $get_cmm_record[$clinical_arr]['record_id']) ?>" class="btn btn-danger btn-rounded"><i class="fa fa-trash"></i>  </a>

                                                        </div>



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
                                                                    <textarea 
                                                                        novalidate 
                                                                        required
                                                                        class="form-control form-controlactive tg-tinymceeditor specimen_microscopic_description"
                                                                        name=" "
                                                                        id=" "
                                                                        placeholder=" "
                                                                        style="min-height:350px;">                                                                                                                     
                                                                        Site  : <?= $data_set['site'] ?> <br>  
                                                                        Specimen type   : <?= $data_set['specimen_type'] ?> <br>  
                                                                        Macroscopic ulceration   : <?= $data_set['macroscopic_ulceration'] ?> <br>  
                                                                        Photo taken  : <?= $data_set['Photo_taken'] ?> <br>  
                                                                        Histological type  : <?= $data_set['Histological_type'] ?> <br>  
                                                                        Growth phase (inavsion)  : <?= $data_set['Growth_phase'] ?> <br>   
                                                                        Invasive only  : <?= '<br>Breslow depth : ' . $data_set['breslow_depth'] . ' mm; <br>Breslow depth of scar :  ' . $data_set['breslow_depth_scar'] . ' mm <br>Clark level : ' . $data_set['clark_level'] . 'Ulceration : ' . $data_set['Ulceration'] . 'Mitoses : ' . $data_set['Mitoses'] . ' /mm<sup>2</sup>' ?> <br>   
                                                                        Solar damage  : <?= $data_set['Solar_damage'] ?> <br>  
                                                                        Host response  : <?= '<br> tumour inflitrating lymphocytes : ' . $data_set['tumour_infiltrating_'] . '<br> regression : ' . $data_set['regression'] ?> <br>  
                                                                        Locoregional spread   : <?= '<br> neurotropism : ' . $data_set['neurotropism'] . '<br> lymphatic vessel invasion : ' . $data_set['lymphatic_vessel_invasion'] . '<br> blood vessel invasion : ' . $data_set['blood_vessel_invasion'] . '<br> microsatellite : ' . $data_set['miscrosetellite'] . '<br> satellite : ' . $data_set['setellite'] . '<br> in transit metastasis  : ' . $data_set['in_transit_metastasis'] ?> <br>  
                                                                        Excision margins   : <?= '<br> epdermal in situ components : ' . $data_set['epi_insitu'] . ' mm<br> epdermal in invasive components : ' . $data_set['epi_invasive'] . ' mm<br> deep : ' . $data_set['deep'] . ' mm' ?> <br>  
                                                                        Co-existing lesion   : <?= $data_set['lesion'] ?> <br>  
                                                                        Special techniques   : <?= $data_set['special_techniques'] ?> <br>  
                                                                        Biomarkers  : <?= $data_set['biomarkers'] ?> <br>  
                                                                        Additional comments  : <?= $data_set['additional_comments'] ?> <br>  
                                                                        TNM stagin (AJCC7)   : <?= $data_set['tnm'] ?> <br>  
                                                                        SNOMED code  : <?= $data_set['snomed'] ?> <br>  
                                                                        In-situ  : <?= $data_set['insitu'] ?> <br>  
                                                                        Inavsive : <?= $data_set['_invasive'] ?> <br>  
                                                                    </textarea>
                                                                </div>
                                                            </fieldset>
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
                                                                <input <?php echo $checked; ?> class="dusrd specimen_classification_<?php echo $inner_tab_count; ?>"
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
                                                                                               class="dusrd specimen_classification_<?php echo $inner_tab_count; ?>"
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
                                                                                               class="dusrd specimen_classification_<?php echo $inner_tab_count; ?>"
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
                                                                                               class="dusrd specimen_classification_<?php echo $inner_tab_count; ?>"
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
                                                       class="form-control dusrd specimen_dignosis_<?php echo $inner_tab_count; ?>"
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
                                                        class="form-control dusrd select2 specimen_snomed_t1_<?php echo $inner_tab_count; ?>"
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
                                                            class="form-control dusrd select2 specimen_snomed_t2_<?php echo $inner_tab_count; ?>"
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
                                                            class="form-control dusrd select2 specimen_snomed_p_<?php echo $inner_tab_count; ?>"
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
                                                            class="form-control dusrd select2 specimen_snomed_m_<?php echo $inner_tab_count; ?>"
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
                                                <textarea name="specimen_commnet_section" class="form-control dusrd" placeholder="Add Comments"><?php echo $row->specimen_comment_section; ?></textarea>
                                            </div>
                                            <div class="form-group tg-formgroupcheck halfform-group">
                                                
                                                <div class="comments_detail_html" style="max-height: 156px;overflow: scroll;">
                                                    <?php $getHtml = getFlagCommentDetails($row->request_id,FALSE,C_SPECIAL_NOTES);
                                                    echo $getHtml;
                                                    ?>
                                                </div>
                                                <?php
                                                $attributes = array("id" => "addTaskCommentForm");
                                                //echo form_open(current_url(), $attributes);
                                                ?>
                                                <input type="hidden" name="task_comment_id" id="task_comment_id" value="<?php echo $row->request_id;?>">
                                                <input type="hidden" name="data_section" id="data_section" value="<?php echo C_SPECIAL_NOTES;?>">
                                                <div class="d-flex justify-content-center row">
                                                    <div class="col-md-12">
                                                        <div class="d-flex flex-column comment-section">
                                                            <div class="bg-light p-2">
                                                                <?php
                                                                $logInUser = $CI->ion_auth->user()->row()->id;
                                                                $logInUserData = getLoggedInUserProfile($logInUser);
                                                                //                                echo "<pre>";print_r($logInUserData);exit;
                                                                ?>
                                                                <div class="d-flex flex-row align-items-start mb-3">
                                                                    <img class="rounded-circle user_image" src="<?php echo get_profile_picture($logInUserData[0]->profile_picture_path, $logInUserData[0]->first_name, $logInUserData[0]->last_name); ?>" width="40" />
                                                                    <textarea class="form-control ml-1 dusrd shadow-none textarea" id="flag_commentss" name="flag_commentss" style="padding-left: 60px;"><?php echo $row->specimen_special_notes; ?></textarea>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <div class="mt-2 text-right" style="margin-top: 15px;">
                                                                    <button class="btn btn-primary btn-sm shadow-none post_comment_btn hide" type="button">Post comment
                                                                    </button>
                                                                    <!--                                                                    <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">-->
                                                                    <!--                                                                        Cancel-->
                                                                    <!--                                                                    </button>-->
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <?php //echo form_close(); ?>
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
                                                              id="m
                                                              dt_outcome_text"
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
                                    <div class="row">
                                        <div class="col-sm-8">
                                        <?php
                                    $CI->load->model("LabEnquiriesModel");
                                    $ticketsData = $CI->LabEnquiriesModel->getTicketListForRecord($user_id,$record_id);
                                    ?>
                                    <button type="button" id="feedback_to_lab_button" class="btn btn-light hidden-xs">
                                        <i class="fa fa-dot-circle-o mr-3" data-toggle="modal" data-target="#sendprivatemessage"></i>
                                        Lab:
                                        <span class="badge badge-pill bg-blue" id="show-labenquiry-records"><?php echo count($ticketsData);?></span>
                                    </button>
                                    <button type="button" id="feedback_to_secretary_button" class="btn btn-light hidden-xs"
                                            data-toggle="modal" data-target="#sendprivatemessage_secretary">
                                        <i class="fa fa-dot-circle-o mr-3"></i>
                                        Secretary:
                                        <span class="badge badge-pill bg-blue">0</span>
                                    </button>
                                    <button type="button" id="feedback_to_trainee_button" class="btn btn-light hidden-xs"
                                            data-toggle="modal" data-target="#sendprivatemessage_trainee">
                                        <i class="fa fa-dot-circle-o mr-3"></i>
                                        Trainee:
                                        <span class="badge badge-pill bg-blue">0</span>
                                    </button>
                                    <button type="button" id="feedback_to_consultant_button" class="btn btn-light hidden-xs"
                                            data-toggle="modal" data-target="#sendprivatemessage_consultant">
                                        <i class="fa fa-dot-circle-o mr-3"></i>
                                        Consultant:
                                        <span class="badge badge-pill bg-blue">0</span>
                                    </button>
                                    <button type="button" id="error_log_button" class="btn btn-light hidden-xs"
                                            data-toggle="modal" data-target="#sendprivatemessage_error">
                                        <i class="fa fa-dot-circle-o mr-3"></i>
                                        Error Log:
                                        <span class="badge badge-pill bg-blue">0</span>
                                    </button>

                                    <?php if (!$row->specimen_publish_status == 1) { ?>
                                    
                                    <input type="hidden" id="template_id" name="template_id" value="<?=$template_id?>">  
                              <input type="hidden" name="lab_id" id="lab_id" value="<?=$labId?>"></div>
                                        <div class="col-sm-4 save_btns">
                                        <?php if($request_query[0]->urole != 'Pathologist') {?>
                                            <button style="margin:10px;" class="hide btn btn-primary btn-rounded create_new_next_button pull-right"
                                            id="create_new_record_btn"
                                            name="submit">Save & Next
                                        </button>
                                        <?php } ?>
                                    
                                    &nbsp;&nbsp;&nbsp; 
                                        <button <?php echo $button_disable; ?>
                                            class="hide btn btn-primary btn-rounded update_specimen_record_btn pull-right"
                                            id="doctor_update_specimen_record_btn_<?php echo $inner_tab_count; ?>"
                                            style="margin:10px;" name="submit">Save Specimen <?php echo $inner_tab_count; ?>
                                        </button>
                                        
                                        
                                                   
                             
                                    <?php } ?>
                                </div>
                                <div id="doctor_update_specimen_record_message_<?php echo $inner_tab_count; ?>" style="clear:both; color:#fff"></div>
                                        </div>
                                    </div>
                                          
              

                            </div>
                        </div>


                        <div class="col-md-12" id="div-labenquiry-records" style="padding-top:50px;display: none">
                            <div class="sec_title form-group">
                                Lab Enquiries: <span class="text-danger">*</span> <a href="javascript:;" class="checv_up_down"><i class="fa fa-chevron-up">
                                </i></a>
                            </div>
                            <div class="card hidden show">
                                <div class="card-body">


                                    <div class="tg-tabfieldsetfourhold">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php if (empty($ticketsData)) { ?>
                                                    <p>No Enquiry To Show...</p>
                                                <?php } else {
                                                    ?>

                                                    <div class="table-responsive">
                                                        <table class="table table-striped custom-table mb-0" id="admin_users_activities">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Ticket Id</th>
                                                                <th>Ticket Subject</th>
                                                                <th>Assigned Staff</th>
                                                                <th>Created Date</th>
                                                                <th>Last Update</th>
                                                                <th>Priority</th>
                                                                <th class="text-center">Status</th>
                                                                <!--                                                <th class="text-right">Actions</th>-->
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $count = 1;
                                                            foreach ($ticketsData as $resultTicket):?>
                                                                <tr>
                                                                    <td><?php echo $count;
                                                                        $count++; ?></td>
                                                                    <td>
                                                                        <a href="<?php echo site_url('labEnquiries/viewTicket/' . $resultTicket['ticket_id']); ?>"># <?php echo $resultTicket['ticket_number'] ?></a>
                                                                    </td>
                                                                    <td><?php echo $resultTicket['ticket_subject'] ?></td>
                                                                    <td>
                                                                        <?php $ticketAssignee = $CI->LabEnquiriesModel->getTicketAssignee($resultTicket['ticket_id']);
                                                                        if (!empty($ticketAssignee)):
                                                                            $counter = 1; ?>
                                                                            <?php foreach ($ticketAssignee as $assignee): ?>
                                                                            <a href="javascript:void();" data-toggle="tooltip" data-placement="bottom" title=""
                                                                               class="avatar"
                                                                               data-original-title="<?php echo $assignee['enc_first_name'] . ' ' . $assignee['enc_last_name'] ?>">
                                                                                <?php echo $assignee['enc_first_name'][0] . $assignee['enc_last_name'][0]; ?></a>
                                                                        <?php endforeach; ?>
                                                                        <?php else: ?>
                                                                            <?php echo "<span class='badge badge-danger'>Un-Assigned</span>"; ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td><?php echo date("d M Y h:i A", strtotime($resultTicket['ticket_created_on'])) ?></td>
                                                                    <td><?php echo($resultTicket['ticket_mod_on'] != "" ? date("d M Y h:i A", strtotime($resultTicket['ticket_mod_on'])) : "N/A") ?></td>
                                                                    <td>
                                                                        <div class="dropdown action-label">

                                                                            <?php switch ($resultTicket['ticket_priority']) {
                                                                                case 'normal':
                                                                                    ?>
                                                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                                                       href="javascript:void(0);">
                                                                                        <i class="fa fa-dot-circle-o text-primary"></i>
                                                                                        Normal</a>
                                                                                    <?php
                                                                                    break;
                                                                                case 'high':
                                                                                    ?>
                                                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                                                       href="javascript:void(0);">
                                                                                        <i class="fa fa-dot-circle-o text-warning"></i>
                                                                                        High </a>
                                                                                    <?php
                                                                                    break;
                                                                                case 'critical':
                                                                                    ?>
                                                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                                                       href="javascript:void(0);">
                                                                                        <i class="fa fa-dot-circle-o text-danger"></i>
                                                                                        Critical</a>
                                                                                    <?php
                                                                                    break;
                                                                                default:
                                                                                    break;
                                                                            } ?>

                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <div class="dropdown action-label">

                                                                            <?php switch ($resultTicket['ticket_status']) {
                                                                                case 'open':
                                                                                    ?>
                                                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                                                       href="javascript:void(0);">
                                                                                        <i class="fa fa-dot-circle-o text-info"></i>Open
                                                                                    </a>
                                                                                    <?php
                                                                                    break;
                                                                                case 're_open':
                                                                                    ?>
                                                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#">
                                                                                        <i class="fa fa-dot-circle-o text-info"></i>Reopened
                                                                                    </a>
                                                                                    <?php
                                                                                    break;
                                                                                case 'hold':
                                                                                    ?>
                                                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#">
                                                                                        <i class="fa fa-dot-circle-o text-danger"></i>On Hold
                                                                                    </a>
                                                                                    <?php
                                                                                    break;
                                                                                case 'closed':
                                                                                    ?>
                                                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#">
                                                                                        <i class="fa fa-dot-circle-o text-success"></i>Closed
                                                                                    </a>
                                                                                    <?php
                                                                                    break;
                                                                                case 'in_progress':

                                                                                    ?>
                                                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#">
                                                                                        <i class="fa fa-dot-circle-o text-success"></i>In Progress
                                                                                    </a>

                                                                                    <?php
                                                                                    break;
                                                                                case 'cancelled':

                                                                                    ?>
                                                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#">
                                                                                        <i class="fa fa-dot-circle-o text-danger"></i>Cancelled
                                                                                    </a>
                                                                                    <?php
                                                                                    break;
                                                                                default:
                                                                                    break;

                                                                            } ?>
                                                                        </div>
                                                                    </td>
                                                                    <!--                                                    <td class="text-right">-->
                                                                    <!--                                                        <div class="dropdown dropdown-action">-->
                                                                    <!--                                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"-->
                                                                    <!--                                                               aria-expanded="false"><i class="material-icons">more_vert</i></a>-->
                                                                    <!--                                                            <div class="dropdown-menu dropdown-menu-right">-->
                                                                    <!--                                                                <a class="dropdown-item edt-tckt" href="javascript:void(0);"-->
                                                                    <!--                                                                   id='--><?php //echo $resultTicket['ticket_id']; ?><!--'-->
                                                                    <!--                                                                   data-info="--><?php //echo $resultTicket['ticket_id']; ?><!--" data-toggle="modal"-->
                                                                    <!--                                                                   data-target="#edit_ticket"><i-->
                                                                    <!--                                                                            class="fa fa-pencil m-r-5"></i> Edit</a>-->
                                                                    <!--                                                                <a class="dropdown-item del-tckt" href="javascript:void(0);"-->
                                                                    <!--                                                                   data-info="--><?php //echo $resultTicket['ticket_id']; ?><!--" data-toggle="modal"-->
                                                                    <!--                                                                   data-target="#delete_ticket"><i class="fa fa-trash-o m-r-5"></i> Delete</a>-->
                                                                    <!--                                                            </div>-->
                                                                    <!--                                                        </div>-->
                                                                    <!--                                                    </td>-->
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <?php
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>



                        <input type="hidden" name="snomed_m_value" class="snomed_m_value" value="">
                        <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                        <input type="hidden" name="specimen_id"  id="specimenID" value="<?php echo $row->specimen_id; ?>">
                        <input type="hidden" name="labId" id="labId" value="" />
                        <input type="hidden" name="labNo" id="labNo" value="" />
                        <input type="hidden" name="selectedTest" id="selectedTest" value="" />
                        <input type="hidden" name="selectedTestIds" id="selectedTestIds" value="" />
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
                                    <h5 class="modal-title">Add Enquiry</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
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
                                                        <p><?php echo $msg; ?></p>
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
                                    <input type="hidden" name='save_type' value='add'/>
                                    <input type="hidden" name='is_lab' value='<?php echo "1"; ?>'/>
                                    <input type="hidden" name='is_record' value='1'/>
                                    <input type="hidden" name='is_record_url' value='<?php echo uri_string(); ?>'/>
                                    <input type="hidden" name="ticket_record_id" value="<?php echo $record_id; ?>">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Ticket Subject <em class='text-danger'>*</em></label>
                                                <input class="form-control" type="text" name='ticket_subject' id='ticket_subject'
                                                       required>
                                            </div>
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
                                                        <option value="<?php echo $labId; ?>"><?php echo getGroupNameById($labId); ?></option>
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
                                                            <input type="radio" name="ticket_priority" value='high'>
                                                            <strong>High</strong>
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
                                                <input class="form-control" type="text" id='ticket_reference' name='ticket_reference'/>
                                                <p><small>Optional - You can Provide Reference for your records. For Instance an
                                                        internal
                                                        Issue Tracking Number. </small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button class="btn btn-primary tck-swtchrs" type="button" data-toggle="collapse"
                                                        data-target="#attachments" aria-expanded="false">
                                                    <i class='la la-paperclip'></i> Show Attachments
                                                </button>
                                                <button class="btn btn-primary tck-swtchrs" type="button" data-toggle="collapse"
                                                        data-target="#notifications" aria-expanded="false">
                                                    <i class='la la-bell'></i> Notification Settings
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row collapse" id='attachments' aria-expanded="false">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h4 class="card-title">Attachments</h4>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-end">
                                                    <div class="col-sm-4">
                                                        <p class="mb-0">You Can Attach any file here which you think may help our
                                                            engineers,
                                                            for instance error message, screen shots or server log files.</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input class="form-control" type="file" id='ticket_files' name='ticket_files[]'
                                                               multiple='true'>
                                                        <p><small>Allowed File Types: <span class='text-monospace'>pdf, doc, docx, jpg,
                                                jpeg, png, gif,</span></small><br><small>Max Size: <strong
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
                                                        <h4 class="card-title">Notifications</h4>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <p class="mb-0">Set weather you want text alerts, how replies can be made to the
                                                            request and weather to CC responses to any other contacts on your Path Hub
                                                            Account.</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="col-sm-12">

                                                            <div class="form-group row">
                                                                <label class="col-form-label col-md-12">CC Response To</label>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-12">
                                                                    <input class="form-control" type="email" name='ticket_cc_to'
                                                                           id='ticket_cc_to'/>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-md-12">Reply Security</label>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-12">
                                                                    <div class="radio">
                                                                        <label>
                                                                            <input type="radio" name="ticket_reply_thru" value='pathhub'
                                                                                   checked>
                                                                            Reply must be made through PathHub
                                                                        </label>
                                                                    </div>
                                                                    <div class="radio">
                                                                        <label>
                                                                            <input type="radio" name="ticket_reply_thru" value='any'>
                                                                            Reply can be
                                                                            made through PathHub or Email
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group row">
                                                                        <label class="col-form-label col-md-12">Receive Text
                                                                            Alerts</label>
                                                                    </div>
                                                                    <div class="radio">
                                                                        <label>
                                                                            <input type="radio" name="ticket_sms_alert" value='no'
                                                                                   checked> No
                                                                        </label>
                                                                    </div>
                                                                    <div class="radio">
                                                                        <label>
                                                                            <input type="radio" name="ticket_sms_alert" value='yes'> Yes
                                                                        </label>
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
                    
                       
<script src='<?= base_url() ?>assets/js/scripts/barcode.js'></script>

<script>
					$('#create_new_record_btn').on('click', function () 
	{
        var _this = $(this);
        var barcode = $("#barcode_no").val();
        var template_id = $("#template_id").val();
        var status_code = 'Booked In To Lab';
		var speciality_id = $("#bookingin_sepciality_id").val(); 
		var lab_id = $("#lab_id").val(); 
            $.ajax({
                url: _base_url + '/institute/batch_record',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {
                    'template_id': template_id,
                    'lab_id' : 114
					},
                success: function (data) {
                    if (data.type === 'success') 
					{
                        setTimeout(function () {
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
							window.location.href = data.redirect_url;
                            //$('.record_add_result').html(data.track_data);
                           // show_flags_on_hover();
                            //change_flag_status();
                            //flag_tooltip();
							
                        }, 500);
                    } else if (data.type === 'update_statuses') {
						} else 
					{
						}
                    setTimeout(function () {
						}, 500);
                },
                error: function (err) {
                    jQuery.sticky('Something went wrong.', {classList: 'important', speed: 200, autoclose: 7000});
                    console.log('Error Response: ', err);
                }
            });
        

    });
					</script>
                    
                    <script>
                        jQuery(document).ready(function () {

                            $('.delete_test').click(function(){
                                var href = $(this).attr('data-href');
                                var sno = $(this).attr("data-sno");
                                href = href + "?stab="+sno;
                                window.location.href = href;
                                
                            });
                            <?php 
                            if(isset($_GET['stab']) && $_GET['stab'] != ''){ ?>
                                $('.ds_click').each(function(){
                                    $(this).parent().removeClass('active');
                                    $('.ds_click').removeClass('active');

                                    if(parseInt($(this).attr('data-ds-controls')) ===  <?php echo $_GET['stab'] ?>){
                                        $(this).trigger('click');
                                        $(this).addClass('active');
                                        $(this).parent().addClass('active');
                                    }
                                })
                            <?php } ?>

                            tinymce.init({
                                menubar: false,
                                selector: '.tg-tinymceeditor',
                                readonly : 1,
                                init_instance_callback: function (editor) {
                                    editor.on('blur', function (e) {
                                        save_specimen_data();
                                    });
                                },
                                toolbar: 'undo redo ' +
                                    'bold italic backcolor | alignleft aligncenter ' +
                                    'alignright alignjustify | bullist numlist outdent indent | ' +
                                    'removeformat | help',
                                font_formats: "CircularStd=CircularStd;",
                                content_style: "@import url('https://db.onlinewebfonts.com/c/860c3ec7bbc5da3e97233ccecafe512e?family=CircularStd'); body { font-family: 'CircularStd' , sans-serif !important; font-size:18px; }"
                            });

                            tinymce.init({
                                menubar: false,
                                selector: '.tg-tinymceeditor-microscopic',
                                readonly : 1,
                                init_instance_callback: function (editor) {
                                    editor.on('blur', function (e) {
                                        save_specimen_data();
                                    });
                                },
                                toolbar: 'undo redo ' +
                                    'bold italic backcolor | alignleft aligncenter ' +
                                    'alignright alignjustify | bullist numlist outdent indent | ' +
                                    'removeformat | help',
                                font_formats: "CircularStd=CircularStd;",
                                content_style: "@import url('https://db.onlinewebfonts.com/c/860c3ec7bbc5da3e97233ccecafe512e?family=CircularStd'); body { font-family: 'CircularStd' , sans-serif !important; font-size:18px; }"
                            });

                            tinymce.init({
                                selector: '.tinyTextarea',
                                height: 200,
                                readonly : 1,
                                menubar: false,
                                plugins: [
                                    'advlist autolink lists link image charmap print preview anchor',
                                    'searchreplace visualblocks code fullscreen',
                                    'insertdatetime media table paste code help wordcount'
                                ],
                                toolbar: 'undo redo | formatselect | ' +
                                    'bold italic backcolor | alignleft aligncenter ' +
                                    'alignright alignjustify | bullist numlist outdent indent | ' +
                                    'removeformat | help',
                                content_css: '//www.tiny.cloud/css/codepen.min.css'
                            });

                            //var tabFlag = true;
                            var inner_tab_select = 1;

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

                            $(document).on('change','.test_wrap',function(){
                                var description = $(this).find('option:selected').map(function() {
                                        return $(this).attr('title');    
                                    }).get();
                                    
                                var name = $(this).find('option:selected').map(function() {
                                    return $(this).text();    
                                }).get();

                            
                                $('#test_description').val(description);
                                $('#test_name').val(name);

                                testBlock = {
                                    'test_ids' : $(this).val(),
                                    'name' : name,
                                    'description' : description,
                                    'sid': $(this).attr('data-sid'),
                                    'sno': $(this).attr('data-sno'),
                                    'bno': $(this).attr('data-bno'),
                                    [csrf_name]: csrf_hash
                                }
                                jQuery.ajax({
                                    type: "POST",
                                    url: '<?php echo base_url('index.php/doctor/editSpecimenBlock'); ?>',
                                    data: testBlock,
                                    dataType: "json",
                                    success: function (response) {
                                        //location.reload();
                                    }
                                });
                            });

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

                            jQuery('.ds_click').unbind().on('click', function (e) {
                                // e.preventDefault();
                                // e.stopPropagation();
                                // e.stopImmediatePropagation();
                                jQuery(this).addClass('active');
                                if(jQuery(this).hasClass('active')){
                                    jQuery(this).removeClass('active');
                                    let currentTab = jQuery(this).attr('data-ds-controls');
                                    var myContent1 = tinymce.get("tg-tinymceeditor_"+inner_tab_select).getContent();
                                    var myContent2 = tinymce.get("specimen_macroscopic_description_"+inner_tab_select).getContent();
                                    tinymce.get("tg-tinymceeditor_"+inner_tab_select).setContent(myContent1);
                                    tinymce.get("specimen_macroscopic_description_"+inner_tab_select).setContent(myContent2);
                                    jQuery('#doctor_update_specimen_record_' + inner_tab_select).trigger('submit');
                                    inner_tab_select = currentTab;
                                    //console.log(currentTab);
                                }
                            });

                            jQuery(document).find('.dusrd3').on('change', function (e) {
                                jQuery(document).find('#doctor_update_specimen_record_1').submit();
                            });

                            function getSelectedSpecimen(){
                                let flag = true;
                                let tab_value;
                                jQuery(document).find('.ds_click').each(function(i){
                                    if(jQuery(this).hasClass('active')){
                                        let tab_select = jQuery(this).attr('data-ds-controls');
                                        if (typeof tab_select != "undefined") {
                                            flag = false;
                                            tab_value = tab_select;
                                        }
                                    }
                                });
                                if(flag){
                                    tab_value = inner_tab_select;
                                }
                                return tab_value;
                            }

                            function save_specimen_data(){
                                /*let flag = true;
                                jQuery(document).find('.ds_click').each(function(i){
                                    if(jQuery(this).hasClass('active')){
                                        let tab_select = jQuery(this).attr('data-ds-controls');
                                        if (typeof tab_select != "undefined") {
                                            console.log(tab_select);
                                            flag = false;
                                            jQuery(document).find('#doctor_update_specimen_record_'+ tab_select).submit();
                                        }
                                    }
                                });
                                if(flag){
                                    jQuery(document).find('#doctor_update_specimen_record_'+inner_tab_select).submit();
                                }*/
                                /*if(jQuery('.ds_click').hasClass('active')){
                                   let tab_select = jQuery(this).attr('data-ds-controls');
                                   console.log(tab_select);
                                }*/
                                let selected_specimen = getSelectedSpecimen();
                                let contentData = tinymce.get("tg-tinymceeditor").getContent();
                                tinymce.get("tg-tinymceeditor_"+selected_specimen).setContent(contentData);
                                //console.log(selected_specimen);
                                jQuery(document).find('#doctor_update_specimen_record_'+selected_specimen).submit();
                            }

                            //dusrd = doctor_update_specimen_record_data
                            jQuery(document).find('.dusrd').on('select2:select, focusout, change', function (e) {
                                e.preventDefault();
                                save_specimen_data();
                            });

                            jQuery('.update_specimen_record_btn').click(function(e){
                                e.preventDefault();
                                let selected_specimen = getSelectedSpecimen();
                                jQuery(document).find('#doctor_update_specimen_record_'+selected_specimen).submit();
                                var origin = window.location.origin;
                                if (origin == 'http://localhost') {
                                    url = origin + '/pci/doctor/doctor_record_detail_old/' +$('#record_id').val() + '?stab='+ selected_specimen;
                                } else {
                                    url = origin + '/doctor/doctor_record_detail_old/' +$('#record_id').val() + '?stab='+ + selected_specimen;
                                }
                                window.location.href = url;

                            });
                            /*jQuery(document).find('#doctor_update_specimen_record_'+inner_tab_select).find('.dusrd').on('change', function (e){
                                e.preventDefault();
                                //setTimeout(function(){
                                    jQuery(document).find('#doctor_update_specimen_record_'+inner_tab_select).submit();
                                    console.log('specimen-' + inner_tab_select + ' '+ jQuery(this).val());
                                //},500);
                            });*/

                            jQuery('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').on('submit', function (e) {

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
                                            jQuery.sticky(response.msg_txt, {classList: 'success', speed: 200, autoclose: 5000});
                                            jQuery('#doctor_update_specimen_record_message_<?php echo $inner_tab_count; ?>').html(response.msg);
                                            window.setTimeout(function () {
                                                //location.reload(),
                                                //jQuery(document).scrollTop(0);
                                                jQuery('#doctor_update_specimen_record_message_<?php echo $inner_tab_count; ?>').html('');
                                            }, 5000);
                                        } else {
                                            jQuery.sticky(response.msg_txt, {classList: 'important', speed: 200, autoclose: 7000});
                                            //jQuery('#doctor_update_specimen_record_message_<?php //echo $inner_tab_count; ?>').html(response.msg);
                                        }
                                    }
                                });
                            });
                        });
                    </script>
                    <script>
                        $(document).ready(function () {

                            $('#testName').on('change',function(){
                                var description = $(this).find('option:selected').map(function() {
                                        return $(this).attr('title');    
                                    }).get();
                                    
                                var name = $(this).find('option:selected').map(function() {
                                    return $(this).text();    
                                }).get();

                            
                                $('#test_description').val(description);
                                $('#test_name').val(name);
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
                                    },
                                    'test_ids[]':{
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
                                                $.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});

                                                var origin = window.location.origin;
                                                if (origin == 'http://localhost') {
                                                    url = origin + '/pci/doctor/doctor_record_detail_old/' +$('#record_id').val() + '?stab='+$('.ds_click.active').attr('data-ds-controls');
                                                } else {
                                                    url = origin + '/doctor/doctor_record_detail_old/' +$('#record_id').val() + '?stab='+$('.ds_click.active').attr('data-ds-controls');
                                                }
                                                window.location.href = url;
                                                //location.reload();
                                            } else {
                                                $.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                                            }
                                        }
                                    });
                                    return false; // required to block normal submit since you used ajax
                                }
                            });
                            var spec_count = <?php echo $inner_tab_count; ?>;
                            // var modal_btn_class_blck = ".block_model_btn_"+spec_count;
                            $(document).on('click', '.block_model_btn_' + spec_count, function (e) {
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

                            $(document).on('click', '.billing_model_btn_' + spec_count, function (e) {
                                let modal = $('#add_billing_modal');
                                let billing_type = $(this).closest('.tg-tabfieldsettwo').find('input[name="billing_type"]:checked').val();
                                let specimen_id = $(this).closest('.tg-tabfieldsettwo').find('.specimen_id').val();
                                modal.modal('show');
                                modal.find('#bill_type').val(billing_type);
                                modal.find('#specimen_id').val(specimen_id);
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

            $('input, select, textarea').prop("disabled", true);
            $('.typeahead').css("background", '#fff !important');
            var specimen_count = $("#specimen_count").val();
            var blocks_wrapper = $(".blocks_wrapper"); //Fields wrapper
            // var specimen_add_blck_btn_cls = ".add_blocks_btn_"+specimen_count;
            var blocks_wrapper_add_btn = $('.add_blocks_btn' + specimen_count); //Add button ID
            var x = 1; //initlal text box count
            $(blocks_wrapper_add_btn).click(function (e) { //on add input button click
                e.preventDefault();
                var block_lab_no = $('#block_lab_no').val();
                var block_inner_tab = $('#block_inner_tab').val();
                console.log("Bllock Var Type" + typeof (block_inner_tab));
                console.log("Block Value before: " + block_inner_tab);
                var block_specimen_tab = $('#block_specimen_tab').val();
                var add_block_inner_tab = ++block_inner_tab;

                $(blocks_wrapper).append('' +
                        '<div class="add_block_div padding-bottom col-md-12"><div class="row"><div class="col-md-2"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="block_lab_no[]" value="' + block_lab_no + '" readonly>  <label class="focus-label">Lab No.</label> </div> </div>' +
                        '<div class="col-md-2"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="block_specimen_no[]" value="' + block_specimen_tab + '" readonly>  <label class="focus-label" >Specimen No.</label> </div> </div>' +
                        '<div class="col-md-2"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="block_no_of_blocks[]" value="' + block_specimen_tab + '' + add_block_inner_tab + '" readonly>  <label class="focus-label" >Block No.</label> </div> </div>' +
                        '<div class="col-md-5"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="block_comments[]">  <label class="focus-label">Block Description</label> </div> </div>' +
                        '<div class="col-md-5"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="test_ids[]">  <label class="focus-label">Test.</label> </div> </div>' +
                        '<div class="col-md-1"> <a href="javascript:void(0)" class="blocks_remove_row btn btn-danger btn-sm"><i class="fa fa-minus"></i></a> </div>' +
                        '</div> </div>'); //add inputs box

                $('#block_specimen_tab').val(block_specimen_tab);
                document.getElementById("block_inner_tab").value = add_block_inner_tab;
                x++; //text box increment
                // }
            });
            $(blocks_wrapper).on("click", ".blocks_remove_row", function (e) { //user click on remove text
                e.preventDefault();
                // var block_inner_tab = $('#block_inner_tab').val();
                // var min_block_inner_tab = --block_inner_tab;
                // document.getElementById("block_inner_tab").value = min_block_inner_tab;
                $(this).closest("div.add_block_div").remove();
                x--;
            });

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
            $("#show-labenquiry-records").click(function(){
                $("#div-labenquiry-records").toggle();
            });

            $(document).on("click",".display_comment_box",function () {
                var dataId = $(this).attr("data-recordid");
                $("#task_comment_id").val(dataId);

                $.ajax({
                    type: "POST",
                    url: _base_url + '/doctor/get_flag_comments/'+dataId,
                    data:  {[csrf_name]: csrf_hash,dataId: dataId,dataSection: 2},
                    dataType: "json",
                    success: function (response) {
                        // var specimenId = $('#block_specimen_id').val();
                        if (response.status === 'success') {
                            $('#comments_section_modal').modal('show');
                            $(".comments_detail_html").html(response.html);
                        }
                    }
                });
                return false; // required to block normal submit since you used ajax
            });
            $(document).on("click",".post_comment_btn",function () {
                var dataId = $("#task_comment_id").val();
                var dataSection = $("#data_section").val();
                var flag_comment = $("#flag_commentss").val();

                $.ajax({
                    type: "POST",
                    url: _base_url + '/doctor/save_flag_comments/',
                    data:  {[csrf_name]: csrf_hash,task_comment_id: dataId,data_section: dataSection,flag_comment: flag_comment},
                    dataType: "json",
                    success: function (response) {
                        if (response.status === 'success') {
                            // $('#add_todaywork').modal('hide');
                            // $("#specimen_" + specimenId + " .block_table").append(response.data);
                            $.sticky(response.message, {
                                classList: 'success',
                                speed: 200,
                                autoclose: 7000
                            });
                            $(".comments_detail_html").html(response.html);
                            // location.reload();
                        } else {
                            $.sticky(response.message, {
                                classList: 'important',
                                speed: 200,
                                autoclose: 7000
                            });
                        }
                    }
                });
                return false; // required to block normal submit since you used ajax
            });
            $(document).on("click", ".comment_like", function () {
                var thisSel = $(this);
                var dataId = $(this).attr("data-id");
                var dataSection = $(this).attr("data-section");
                var dataStatus = $(this).attr("data-status");

                $.ajax({
                    type: "POST",
                    url: _base_url + '/doctor/likeFlagComments/',
                    data:  {[csrf_name]: csrf_hash,dataId: dataId,dataSection: dataSection,dataStatus: dataStatus},
                    dataType: "json",
                    success: function (response) {
                        // var specimenId = $('#block_specimen_id').val();
                        if (response.status === 'success') {
                            $(document).find(".cursor").css("color", "#1F1F1F");
                            thisSel.css("color", "#00c5fb");
                            // thisSel.find("span").text("Liked");
                        }
                    }
                });
                return false; // required to block normal submit since you used ajax
            });
            $(document).on("click",".delete-comment-btn",function () {
                var dataId = $(this).attr("data-id");
                var datarecord_id = $(this).attr("data-recordid");

                $.ajax({
                    type: "POST",
                    url: _base_url + '/doctor/delete_comment_flg/',
                    data:  {[csrf_name]: csrf_hash,dataId: dataId,dataRecordId: datarecord_id,dataSection: <?php echo C_SPECIAL_NOTES?>},
                    dataType: "json",
                    success: function (response) {
                        // var specimenId = $('#block_specimen_id').val();
                        if (response.status === 'success') {
                            $(".comments_detail_html").html(response.html);
                        }
                    }
                });
                return false; // required to block normal submit since you used ajax
            });

            $("#addTaskCommentForm").validate({
                // ignore: ":hidden",
                rules: {
                    flag_comment: {
                        required: true
                    }
                },
                submitHandler: function (form) {
                    $.ajax({
                        type: "POST",
                        url: _base_url + '/doctor/save_flag_comments',
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function (response) {
                            // var specimenId = $('#block_specimen_id').val();
                            if (response.status === 'success') {
                                // $('#add_todaywork').modal('hide');
                                // $("#specimen_" + specimenId + " .block_table").append(response.data);
                                $.sticky(response.message, {
                                    classList: 'success',
                                    speed: 200,
                                    autoclose: 7000
                                });
                                $(".comments_detail_html").html(response.html);
                                // location.reload();
                            } else {
                                $.sticky(response.message, {
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

        });

    </script>
    <?php
}
?>
