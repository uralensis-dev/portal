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
    $specimen_qcd_by) {
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
    ?>


    <style type="text/css">
        .lab_btn_desc{display: none;}
    </style>
<div class="tg-inputshold specimen_content">
    <div class="tg-titlevtwo">
        <!-- <h3>Clinical:</h3> -->
    </div>
    <div class="delete_add_specimen">
        <a href="javascript:;" class="tg-detailsicon add_specimen tg-themeiconcolorone" data-toggle="modal" data-target="#add_specimen_modal">
            <i class="ti-plus"></i>
        </a>
        <a href="javascript:;" class="tg-detailsicon delete_specimen tg-themeiconcolortwo">
            <i class="ti-trash"></i>
        </a>
    </div>

    <div class="modal fade" id="add_specimen_modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
		<div class="tg-modaldialog modal-dialog" role="document">
			<div class="tg-modalhead">
				<a href="javascript:void(0);" class="fa fa-close tg-btnclose" data-dismiss="modal" aria-label="Close"></a>
				<div class="tg-boxtitle">
					<h2>Add Specimen</h2>
				</div>
				<div class="tg-rightarea">
					<a href="javascript:;" class="tg-btnspecimen btn-spcimen-add"><i class="fa fa-check"></i>Add Specimen</a>
				</div>
			</div>
			<div class="tg-modalbody modal-body">
            <?php
            $attributes = array('class' => 'tg-formtheme tg-formspecimen specimen_form');
            echo form_open("doctor/add_specimen_doctor/".$record_id, $attributes);
            ?>	<fieldset>
                        <div class="form-group halfform-group tg-withlabel">
                            <select name="specimen_accepted_by" class="form-control selectpicker">
                            <option value="" data-hidden="true" selected>Accepted:</option>
                                <?php
                                    if (!empty($specimen_accepted_by)) {
                                        foreach ($specimen_accepted_by as $key => $value) {
                                            echo '<option value="'.$value['spec_accep_by_id'].'">'.$value['spec_accep_by_name'].'</option>';
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
                                            echo '<option value="'.$value['spec_cutup_by_id'].'">'.$value['spec_cutup_by_name'].'</option>';
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
                                            echo '<option value="'.$value['spec_assis_by_id'].'">'.$value['spec_assis_by_name'].'</option>';
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
                                            echo '<option value="'.$value['spec_block_check_id'].'">'.$value['spec_block_check_name'].'</option>';
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
                                            echo '<option value="'.$value['spec_labeled_by_id'].'">'.$value['spec_labeled_by_name'].'</option>';
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
                                            echo '<option value="'.$value['spec_qcd_by_id'].'">'.$value['spec_qcd_by_name'].'</option>';
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
                            <input type="text" class="form-control" name="specimen_slides" id="date" placeholder="Specimen Slides" />
                        </div>
                        <div class="form-group halfform-group">
                            <?php $snomed_p_array = getSnomedCodes('p'); ?>
                            <select name="specimen_snomed_p" id="specimen_snomed_p" class="form-control selectpicker" data-live-search="true">
                            <option value="" data-hidden="true" selected>P Code</option>
                                <?php
                                    foreach ($snomed_p_array as $snomed_p_code) {
                                        $selected = '';
                                        $snomed_p = strtolower(str_replace(' ', '', trim($snomed_p_code['usmdcode_code'])));
                                        echo '<option data-pdesc="'.$snomed_p_code['usmdcode_code_desc'].'" value="'.$snomed_p.'">'.$snomed_p_code['usmdcode_code'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group halfform-group">
                            <?php $snomed_t_array = getSnomedCodes('t1'); ?>
                            <select name="specimen_snomed_t1" id="specimen_snomed_t1"  class="form-control selectpicker" data-live-search="true">
                            <option value="" data-hidden="true" selected>T1 Code</option>
                                <?php
                                    foreach ($snomed_t_array as $snomed_t_code) {
                                        $selected = '';
                                        $snomed_t = strtolower(str_replace(' ', '', trim($snomed_t_code['usmdcode_code'])));
                                        echo '<option data-tdesc="'.$snomed_t_code['usmdcode_code_desc'].'" value="'.$snomed_t.'">'.$snomed_t_code['usmdcode_code'].'</option>';
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
                                        echo '<option data-tdesc="'.$snomed_t2_code['usmdcode_code_desc'].'" value="'.$snomed_t.'">'.$snomed_t2_code['usmdcode_code'].'</option>';
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
                                    echo '<option value="'.$rcpath_code.'">'.$rcpath_code.'</option>';
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
    <ul class="tg-themenavtabs nav navbar-nav">
        <?php
            $active = 'active';
            $count = 1;
            foreach ($specimen_query as $row) {
        ?>
        <li class="nav-item <?php echo $active; ?>" data-currentspceimentab="<?php echo $count; ?>" data-specimenid="<?php echo $row->specimen_id; ?>" data-requestid="<?php echo $row->request_id; ?>">
            <a data-toggle="tab" id="doctor-detail-specimen-tab-<?php echo $row->specimen_id; ?>" class="doctor-detail-specimen-tab" href="#tabs_<?php echo $count; ?>">Specimen
                <?php echo $count; ?></a>
        </li>
        <?php
                $active = '';
                $count++;
            }
        ?>
    </ul>
    <div class="tg-tabcontentvtwo tab-content">
        <?php
            $tabs_active = 'active';
            $inner_tab_count = 1;
            $specimen_total_count = count($specimen_query);
            foreach ($specimen_query as $key => $row) { 
        ?>
        <div class="tg-navtabsdetails tab-pane fade in <?php echo $tabs_active; ?>" id="tabs_<?php echo $inner_tab_count; ?>">
            <form class="tg-formtheme tg-tabform tg-tabformvtwo doctor_update_specimen" id="doctor_update_specimen_record_<?php echo $inner_tab_count; ?>"
                method="post">
                <fieldset class="tg-tabfieldset tg-tabfieldsetvtwo">
                    <?php if (empty($request_query[0]->cl_detail)) { 
                            for($i = 1; $i <= $specimen_total_count; $i++){
                                $j = $i - 1;
                                if($i === $inner_tab_count){
                                    
                                    if($specimen_total_count === 1){
                                        $total_width = '100% !important';
                                    }else{
                                        $total_width = '50% !important';
                                    }
                                    ?>
                                    <div class="row">
                                <div class="col-lg-6">
                                    <div class="card doctorCard">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                            <label class="focus-label">Cinical</label>
                                            <img src="<?php echo base_url()?>assets/institute/img/iconBtn.png" align="btn">
                                            </span>
                                            <input class="form-control" list="clinical_desc" style="height:44px;">
                                            <datalist id="clinical_desc">
                                                <option value="Clinical Description 1">
                                                </option>
                                                <option value="Clinical Description 2">
                                                </option>
                                                <option value="Clinical Description 3">
                                                </option>
                                                <option value="Clinical Description 4">
                                                </option>
                                                <option value="Clinical Description 5">
                                                </option>
                                            </datalist> 
                                        </div>
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
                                    <?php
                                }else{
                                $total_width = 50 / ($specimen_total_count - 1);
                                    ?>
                                    <div class="form-group tg-inputicon tg-disabled-form-group" style="width:<?php echo $total_width . '% !important'; ?>">
                                        <i class="ti-fullscreen"></i>
                                        <textarea class="form-control editor_clinical_history_<?php echo intval($i); ?>" placeholder="<?php echo @strip_tags($specimen_query[$j]->specimen_clinical_history); ?>"></textarea>
                                        <ul class="tg-themeinputbtn">
                                            <li>
                                                <span class="tg-radio">
                                                    <input type="radio" id="tg-inputin1" name="inputin" value="inputin">
                                                    <label for="tg-inputin1">IN</label>
                                                </span>
                                            </li>
                                            <li>
                                                <span class="tg-radio">
                                                    <input type="radio" id="tg-inputbt1" name="inputin" value="inputin">
                                                    <label for="tg-inputbt1">BT</label>
                                                </span>	
                                            </li>
                                            <li>
                                                <span class="tg-radio">
                                                    <input type="radio" id="tg-inputat1" name="inputin" value="inputin">
                                                    <label for="tg-inputat1">AT</label>
                                                </span>
                                            </li>
                                            <li>
                                                <span class="tg-radio">
                                                    <input type="radio" id="tg-inputmt1" name="inputin" value="inputin">
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

                                </div>
                                <div class="col-lg-6">
                                    <div class="card doctorCard">
                                        <div class="input-group">
                                           <span class="input-group-text" id="basic-addon1">
                                            <label class="focus-label">Macro</label>
                                                <img src="<?php echo base_url()?>assets/subassets/img/iconBtn.png" align="btn">
                                            </span>
                                            <input class="form-control" list="macroscopic_desc" style="height:44px;" />
                                            <datalist id="macroscopic_desc">
                                              <option value="Macroscopic Description 1">
                                              <option value="Macroscopic Description 2">
                                              <option value="Macroscopic Description 3">
                                              <option value="Macroscopic Description 4">
                                              <option value="Macroscopic Description 5">
                                            </datalist>                                             
                                        </div>
                                        <textarea novalidate required name="specimen_macroscopic_description" id="specimen_macroscopic_description"
                                class="form-control tg-tinymceeditor form-controlactive" placeholder="Macroscopic Description"><?php echo $row->specimen_macroscopic_description; ?></textarea>
                                    </div>
                                </div>                                            
                            </div>
                </fieldset>
                <div class="tg-tabfieldsettwohold">
                    <fieldset class="tg-tabfieldsettwo">
                        <div class="col-md-3 form-group">
                            <select name="specimen_accepted_by" class="form-control">
                                <option value="">Accepted By:</option>
                                <?php
                                        if (!empty($specimen_accepted_by)) {
                                            foreach ($specimen_accepted_by as $key => $value) {
                                                $selected = '';
                                                if ($row->specimen_accepted_by === $value['spec_accep_by_id']) {
                                                    $selected = 'selected';
                                                }
                                                echo '<option '.$selected.' value="'.$value['spec_accep_by_id'].'">'.$value['spec_accep_by_name'].'</option>';
                                            }
                                        }
                                        ?>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <select name="specimen_cutupby" class="form-control">
                                <option value="">Cut up by:</option>
                                <?php
                                        if (!empty($specimen_cutup_by)) {
                                            foreach ($specimen_cutup_by as $key => $value) {
                                                $selected = '';
                                                if ($row->specimen_cutup_by === $value['spec_cutup_by_id']) {
                                                    $selected = 'selected';
                                                }
                                                echo '<option '.$selected.' value="'.$value['spec_cutup_by_id'].'">'.$value['spec_cutup_by_name'].'</option>';
                                            }
                                        }
                                        ?>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <select data-placeholder="Assisted by:" name="specimen_assisted_by" class="form-control">
                                <option value="">Assisted by:</option>
                                <?php
                                        if (!empty($specimen_assisted_by)) {
                                            foreach ($specimen_assisted_by as $key => $value) {
                                                $selected = '';
                                                if ($row->specimen_assisted_by === $value['spec_assis_by_id']) {
                                                    $selected = 'selected';
                                                }
                                                echo '<option '.$selected.' value="'.$value['spec_assis_by_id'].'">'.$value['spec_assis_by_name'].'</option>';
                                            }
                                        }
                                        ?>
                            </select>
                    	</div>
                        <div class="col-md-3 form-group">
                            <select data-placeholder="Block checked by:" name="specimen_block_checked_by" class="form-control">
                                <option value="">Block checked by:</option>
                                <?php
                                        if (!empty($specimen_block_checked_by)) {
                                            foreach ($specimen_block_checked_by as $key => $value) {
                                                $selected = '';
                                                if ($row->specimen_block_checked_by === $value['spec_block_check_id']) {
                                                    $selected = 'selected';
                                                }
                                                echo '<option '.$selected.' value="'.$value['spec_block_check_id'].'">'.$value['spec_block_check_name'].'</option>';
                                            }
                                        }
                                        ?>
                            </select>
                    	</div>
                        <div class="col-md-3 form-group">

                            <select data-placeholder="Labelled by:" name="specimen_labeled_by" class="form-control">
                                <option value="">Labeled by:</option>
                                <?php
                                        if (!empty($specimen_labeled_by)) {
                                            foreach ($specimen_labeled_by as $key => $value) {
                                                $selected = '';
                                                if ($row->specimen_labelled_by === $value['spec_labeled_by_id']) {
                                                    $selected = 'selected';
                                                }
                                                echo '<option '.$selected.' value="'.$value['spec_labeled_by_id'].'">'.$value['spec_labeled_by_name'].'</option>';
                                            }
                                        }
                                        ?>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <select data-placeholder="QC’d by:" name="specimen_qcd_by" class="form-control">
                                <option value="">QC’d by:</option>
                                <?php
                                        if (!empty($specimen_qcd_by)) {
                                            foreach ($specimen_qcd_by as $key => $value) {
                                                $selected = '';
                                                if ($row->specimen_qc_by === $value['spec_qcd_by_id']) {
                                                    $selected = 'selected';
                                                }
                                                echo '<option '.$selected.' value="'.$value['spec_qcd_by_id'].'">'.$value['spec_qcd_by_name'].'</option>';
                                            }
                                        }
                                        ?>
                            </select>
                    	</div>
                        <div class="col-md-3 form-group">
	                        <select name="specimen_block" id="specimen_block" class="form-control">
	                            <?php
	                                if (!empty($get_cost_codes)) {
	                                    foreach ($get_cost_codes as $codes) {
	                                        $selected = '';
	                                        if ($codes->ura_cost_code_desc == $row->specimen_block) {

	                                            $selected = 'selected';
	                                        }
	                                        echo '<option '.$selected.' value="'.$codes->ura_cost_code_desc.'">'.$codes->ura_cost_code_desc.'</option>';
	                                    }//endforeach
	                                } else {
	                                    echo '<option value="0">Please Add The Codes First.</option>';
	                                }//endif
	                            ?>
	                        </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <input type="text" class="form-control" name="specimen_slides" value="<?php echo $row->specimen_slides; ?>"
                                placeholder="Slide No:">
                        </div>
                        <!-- <div class="form-group form-group-tiny tg-lasttextarea tg-startextarea">
                            <div id="email" class="tg-starpalceholder">
                                <label for="email">Specimen Macroscopic Description </label>
                                <span class="tg-formstar">*</span>
                            </div>
                            <label for="">Specimen Macroscopic Description</label>
                            <textarea novalidate required name="specimen_macroscopic_description" id="specimen_macroscopic_description"
                                class="form-control tg-tinymceeditor form-controlactive" placeholder="Macroscopic Description"><?php //echo $row->specimen_macroscopic_description; ?></textarea>
                        </div> -->
                    </fieldset>
                </div>
                <div class="tg-tabfieldsetthreehold">
                    <fieldset class="tg-tabfieldsetthree specimen-micro-area" >
                        <div class="form-group">
                            <input type="text" data-microcodeid="" data-formid="<?php echo $inner_tab_count; ?>" name="specimen_microscopic_code"
                                class="form-control specimen_microscopic_code" id="specimen_microscopic_code"
                                placeholder="Specimen Microscopic Code" value="<?php echo $row->specimen_microscopic_code; ?>">
                        </div>
                        <div class="form-group halfform-group">
                            <span class="tg-select">
                                <select id="rcpath_codedata" data-placeholder="RCPath Code" name="rcpath_code" class="form-control rcpath_codedata rcpath_codedata_<?php echo $inner_tab_count; ?>">
                                    <option value="">Select RC Path</option>
                                    <?php
                                        for ($i= 1; $i <= 20; $i++) {
                                            $selected = '';
                                            if ($i == $row->specimen_rcpath_code) {
                                                $selected = 'selected';
                                            }
                                            echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
                                        }
                                    ?>
                                </select>
                            </span>
                        </div>
                        </fieldset>
                        
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12 form-group">
                        <button class="btn btn-info lab_btn" style="margin-top: 15px; font-size: 16px;">Lab 
                            <img src="<?php echo base_url()?>assets/icons/Laboratory.png" style="width: 30px; margin-left:10px;">
                        </button>
                    </div>
                    
                    <div class="col-lg-12 lab_btn_desc show">
                        <fieldset class="tg-tabfieldsetthree tg-tabfieldset">
                                
                            <div class="form-group form-group-tiny tg-lasttextarea tg-startextarea">
                                
                                <div class="col-md-12 np">
                                    <!-- <div class="form-group" style="margin:15px 0"> -->
                                    <?php if(!empty($row->patient_initial)) { 
                                        echo '<span class="noselect">Patient Initial: </span><strong>'.$row->patient_initial.'</strong><span class="noselect">&nbsp;&nbsp;&nbsp;</span>';
                                    }
                                    if(!empty($row->sur_name)) { 
                                        echo '<span class="noselect">Surname: </span><strong>'.$row->sur_name.'</strong><span class="noselect">&nbsp;&nbsp;&nbsp;</span>';
                                    }
                                    if(!empty($row->f_name)) { 
                                        echo '<span class="noselect">First Name: </span><strong>'.$row->f_name.'</strong><span class="noselect">&nbsp;&nbsp;&nbsp;</span>';
                                    }
                                    if(!empty($row->lab_number)) { 
                                        echo '<span class="noselect">Lab Number: </span><strong>'.$row->lab_number.'</strong><span class="noselect">&nbsp;&nbsp;&nbsp;</span>';
                                    }
                                    ?>
                                
                               
                                <div class="input-group">
                                   <span class="input-group-text" id="basic-addon2">
                                    <label class="focus-label">Microscopy</label>
                                        <img src="<?php echo base_url()?>assets/subassets/img/iconBtn.png" align="btn">
                                    </span>
                                    <input class="form-control" list="microscopy_desc" style="height:44px;" />
                                    <datalist id="microscopy_desc">
                                      <option value="Microscopy Description 1">
                                      <option value="Microscopy Description 2">
                                      <option value="Microscopy Description 3">
                                      <option value="Microscopy Description 4">
                                      <option value="Microscopy Description 5">
                                    </datalist>                                             
                                </div>
                                <textarea novalidate required class="form-control form-controlactive specimen_microscopic_description" name="specimen_microscopic_description" id="specimen_microscopic_description_<?php echo $inner_tab_count; ?>" placeholder="Microscopic Description" style="min-height:350px;"><?php echo trim($row->specimen_microscopic_description); ?></textarea>
                                </div>

                                
                            </div>
                        </fieldset>


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

                                <div class="form-group tg-formgroupcheck specimen-diagnose-field">
                                    <input data-overwrite="false" type="text" class="form-control specimen_dignosis_<?php echo $inner_tab_count; ?>" placeholder="Specimen Diagnosis"
                                        name="specimen_diagnosis" id="specimen_dignosis" value="<?php echo $row->specimen_diagnosis_description; ?>" />
                                    <div id="snomed-values-<?php echo $inner_tab_count; ?>" class="snomed-values">
                                        <span class="snomed-t1"><?php echo !empty($row->specimen_snomed_t) ? $row->specimen_snomed_t : ''; ?></span>
                                        <span class="snomed-t2"><?php echo !empty($row->specimen_snomed_t2) ? $row->specimen_snomed_t2 : ''; ?></span>
                                        <span class="snomed-p"><?php echo !empty($row->specimen_snomed_p) ? $row->specimen_snomed_p : ''; ?></span>
                                        <span class="snomed-m"><?php echo !empty($row->specimen_snomed_m) ? $row->specimen_snomed_m : ''; ?></span>
                                    </div>
                                </div>
                                                    
                                <div class="form-group halfformgroup specimen_snomed_options">
                                    <span class="tg-select specimen_snomed_select">
                                        <?php
                                            $snomed_t_array = getSnomedCodes('t1');
                                            $snomed_t_id = $row->specimen_snomed_t;
                                            $snomed_t_arr = explode(',', $snomed_t_id);
                                        ?>
                                        <label for="specimen_snomed_t1">Snomed T1</label>
                                        <select multiple data-max-options="1" name="specimen_snomed_t1[]" id="specimen_snomed_t1" data-formid="<?php echo $inner_tab_count; ?>" class="form-control selectpicker specimen_snomed_t1_<?php echo $inner_tab_count; ?>" data-live-search="true">
                                            <option data-hidden="true">Nothing Select</option>
                                            <?php
                                                foreach ($snomed_t_array as $snomed_t_code) {
                                                    $selected = '';
                                                    $snomed_t = strtolower(str_replace(' ', '', trim($snomed_t_code['usmdcode_code'])));
                                                    if (in_array($snomed_t, $snomed_t_arr)) {
                                                        $selected = 'selected';
                                                    }
                                                    $added_by = '';
                                                    if($snomed_t_code['snomed_added_by'] === $user_id){
                                                        $added_by = 'snomed_provisional';
                                                    }
                                                    echo '<option class="'.$added_by.'" data-tdesc="'.$snomed_t_code['usmdcode_code_desc'].'" value="'.$snomed_t.'" '.$selected.'>'.$snomed_t_code['usmdcode_code'].' '.$snomed_t_code['usmdcode_code_desc'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </span>
                                </div>
                                <div class="form-group halfformgroup specimen_snomed_options">
                                    <span class="tg-select specimen_snomed_select">
                                        <?php
                                            $snomed_t2_array = getSnomedCodes('t1');
                                            $snomed_t2_id = $row->specimen_snomed_t2;
                                            $snomed_t2_arr = explode(',', $snomed_t2_id);
                                        ?>
                                        <label for="specimen_snomed_t2">Snomed T2</label>
                                        <select multiple data-max-options="1" name="specimen_snomed_t2[]" id="specimen_snomed_t2" data-formid="<?php echo $inner_tab_count; ?>" class="form-control selectpicker specimen_snomed_t2_<?php echo $inner_tab_count; ?>" data-live-search="true">
                                            <option data-hidden="true">Nothing Select</option>
                                            <?php
                                                foreach ($snomed_t2_array as $snomed_t2_code) {
                                                    $selected = '';
                                                    $snomed_t = strtolower(str_replace(' ', '', trim($snomed_t2_code['usmdcode_code'])));
                                                    if (in_array($snomed_t, $snomed_t2_arr)) {
                                                        $selected = 'selected';
                                                    }
                                                    $added_by = '';
                                                    if($snomed_t2_code['snomed_added_by'] === $user_id){
                                                        $added_by = 'snomed_provisional';
                                                    }
                                                    echo '<option class="'.$added_by.'" data-tdesc="'.$snomed_t2_code['usmdcode_code_desc'].'" value="'.$snomed_t.'" '.$selected.'>'.$snomed_t2_code['usmdcode_code'].' '.$snomed_t2_code['usmdcode_code_desc'].'</option>';
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
                                        <select name="specimen_snomed_p[]" id="specimen_snomed_p" data-formid="<?php echo $inner_tab_count; ?>" class="form-control selectpicker specimen_snomed_p_<?php echo $inner_tab_count; ?>" data-live-search="true">
                                        <option data-hidden="true">Nothing Select</option>
                                            <?php
                                                foreach ($snomed_p_array as $snomed_p_code) {
                                                    $selected = '';
                                                    $snomed_p = strtolower(str_replace(' ', '', trim($snomed_p_code['usmdcode_code'])));
                                                    if (in_array($snomed_p, $snomed_p_arr)) {

                                                        $selected = 'selected';
                                                    }
                                                    $added_by = '';
                                                    if($snomed_p_code['snomed_added_by'] === $user_id){
                                                        $added_by = 'snomed_provisional';
                                                    }
                                                    echo '<option class="'.$added_by.'" data-pdesc="'.$snomed_p_code['usmdcode_code_desc'].'" value="'.$snomed_p.'" '.$selected.'>'.$snomed_p_code['usmdcode_code'].' '.$snomed_p_code['usmdcode_code_desc'].'</option>';
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
                                        <select name="specimen_snomed_m[]" id="specimen_snomed_m" data-formid="<?php echo $inner_tab_count; ?>" class="form-control selectpicker specimen_snomed_m_<?php echo $inner_tab_count; ?>"
                                            multiple data-live-search="true">
                                            <?php
                                                foreach ($snomed_m_array as $snomed_m_code) {
                                                    $selected = '';
                                                    $snomed_m = strtolower(str_replace(' ', '', trim($snomed_m_code['usmdcode_code'])));
                                                    if (in_array($snomed_m, $snomed_m_arr)) {

                                                        $selected = 'selected';
                                                    }
                                                    $added_by = '';
                                                    if($snomed_m_code['snomed_added_by'] === $user_id){
                                                        $added_by = 'snomed_provisional';
                                                    }
                                                    echo '<option class="'.$added_by.'" data-rcpath="'.$snomed_m_code['rc_path_score'].'" data-diagnoses="'.$snomed_m_code['snomed_diagnoses'].'" data-mdesc="'.$snomed_m_code['usmdcode_code_desc'].'" value="'.$snomed_m.'" '.$selected.'>'.$snomed_m_code['usmdcode_code'].' '.$snomed_m_code['usmdcode_code_desc'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </span>
                                </div>
                                <div class="form-group tg-formgroupcheck halfform-group">
                                    <textarea name="specimen_commnet_section" class="form-control" placeholder="Comments"><?php echo $row->specimen_comment_section; ?></textarea>
                                </div>
                                <div class="form-group tg-formgroupcheck halfform-group">
                                    <textarea name="specimen_special_notes" class="form-control" placeholder="Special Notes"><?php echo $row->specimen_special_notes; ?></textarea>
                                </div>
                                <div class="form-group tg-privmsg-btn tg-formgroupcheck halfformgroup">
                                    <a class="form-group-btn btn btn-default" href="#" data-toggle="modal" data-target="#sendprivatemessage"><i class="fa fa-envelope-o fa-2x"></i></a>
                                    <textarea name="specimen_feedback_to_lab" class="form-control" placeholder="Feedback to Lab:"><?php echo $row->specimen_feedback_to_lab; ?></textarea>
                                </div>
                                <div class="form-group tg-formgroupcheck halfformgroup">
                                    <a class="form-group-btn btn btn-default" href="#" data-toggle="modal" data-target="#sendprivatemessage"><i class="fa fa-envelope-o fa-2x"></i></a>
                                    <textarea name="specimen_feedback_to_secretary" class="form-control" placeholder="Feedback to Secretary:"><?php echo $row->specimen_feedback_to_secretary; ?></textarea>
                                </div>
                                <div class="form-group tg-privmsg-btn tg-formgroupcheck halfformgroup">
                                    <a class="form-group-btn btn btn-default" href="#" data-toggle="modal" data-target="#sendprivatemessage"><i class="fa fa-envelope-o fa-2x"></i></a>
                                    <textarea name="specimen_error_log" class="form-control" placeholder="Error Log:"><?php echo $row->specimen_error_log; ?></textarea>
                                </div>
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
                                                    <fieldset>
                                                        <?php
                                                            //Get Lab Number and Serial Number as Subject for Private Message
                                                            $serial_no = $request_query[0]->serial_number;
                                                            $lab_no = $request_query[0]->lab_number;

                                                            $priv_msg_subject = $serial_no .'&nbsp;|&nbsp;'. $lab_no;
                                                            //Get laboratory user id.
                                                            $lab_name = $request_query[0]->lab_name;
                                                            $laboratory_id = getLaboratoryUserId($lab_name);
                                                            $button_disableb = '';
                                                            $lab_user_id = '';
                                                            if(!empty($laboratory_id)){
                                                                $lab_user_id = $laboratory_id['user_lab_default_status'];
                                                                $lab_name = $laboratory_id['description'];
                                                            }
                                                            if(empty($laboratory_id['user_lab_default_status'])){
                                                                $button_disableb = 'disabled';
                                                                echo '<div class="alert alert-danger">This lab did not set any default user to receive private message, Please set first from admin side in edit group section or contact with Administrator.</div>';
                                                            }
                                                        ?>
                                                        <div class="form-group tg-inputwithicon" style="width:100%;">
                                                            <input readonly type="text" name="lab_name" value="" id="lab_name" class="form-control" placeholder="<?php echo $lab_name; ?>">
                                                            <input type="hidden" name="lab_name_id" value="<?php echo intval($lab_user_id); ?>">
                                                        </div>
                                                        <div class="form-group tg-inputwithicon" style="width:100%;">
                                                            <input readonly type="text" name="privmsg_subject" value="<?php echo $priv_msg_subject; ?>" id="privmsg_subject" maxlength="" size="40" class="form-control" placeholder="Subject">
                                                        </div>
                                                        <div class="form-group tg-inputwithicon" style="width:100%;">
                                                            <textarea name="privmsg_body" cols="80" rows="5" id="privmsg_body" class="form-control" placeholder="Message"></textarea>
                                                        </div>
                                                        <div class="tg-btnarea">
                                                            <input type="hidden" name="record_id" value="<?php echo intval($record_id); ?>">
                                                            <button <?php echo $button_disableb; ?> type="button" class="tg-btn specimen_pm_msg_btn">Send</button>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <!-- Buttons Container -->
                                <div class="page-buttons">
                                    <button class="btn btn-light" data-toggle="modal" data-target="#sendprivatemessage">
                                        <i class="fa fa-dot-circle-o mr-3"></i>
                                        Lab: 
                                        <span class="badge badge-pill bg-blue">3</span>
                                    </button>

                                    <button class="btn btn-light" data-toggle="modal" data-target="#sendprivatemessage">
                                        <i class="fa fa-dot-circle-o"></i>
                                        Secretary: 
                                        <span class="badge badge-pill bg-blue">3</span>
                                    </button>

                                    <button class="btn btn-light" data-toggle="modal" data-target="#sendprivatemessage">                            
                                        Error Log: 
                                        <span class="badge badge-pill bg-blue">3</span>
                                    </button>
                                   
                                    <button class="btn btn-light">
                                        <span class="badge badge-pill bg-blue">3</span>
                                        Primary Doctors                             
                                    </button>

                                    <button class="btn btn-light">
                                        <span class="badge badge-pill bg-blue">3</span>
                                        Others                             
                                    </button>
                                    <button class="btn btn-light">
                                        <span class="badge badge-pill bg-blue">3</span>
                                        GI                            
                                    </button>
                                    <button class="btn btn-light">
                                        <span class="badge badge-pill bg-blue">3</span>
                                        Others                             
                                    </button>
                                    <button class="btn btn-primary btn-sm btn-round">
                                       <i class="fa fa-arrow-right"></i>                             
                                    </button>

                                    <div class="pull-right" id="doctor_update_specimen_record_message_<?php echo $inner_tab_count; ?>"></div>
                                    <?php if (!$row->specimen_publish_status == 1) { ?>
                                    <button <?php echo $button_disable; ?> class="btn btn-info update_specimen_record_btn pull-right"
                                        id="doctor_update_specimen_record_btn_<?php echo $inner_tab_count; ?>" name="submit">Update Diagnosis</button>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <!-- <div class="form-group">
                                    <div id="doctor_update_specimen_record_message_<?php echo $inner_tab_count; ?>"></div>
                                    <?php if (!$row->specimen_publish_status == 1) { ?>
                                    <button <?php echo $button_disable; ?> class="btn btn-primary update_specimen_record_btn"
                                        id="doctor_update_specimen_record_btn_<?php echo $inner_tab_count; ?>" name="submit">Update Diagnosis</button>
                                    <?php } ?>
                                </div> -->
                            </div>
                        </div>
                        <input type="hidden" name="snomed_m_value" class="snomed_m_value" value="">
                        <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                        <input type="hidden" name="specimen_id" value="<?php echo $row->specimen_id; ?>">
                        <!--Modal Box For Microscopic Description X Field Start-->
                        <div id="change-micro-x-val-<?php echo $inner_tab_count; ?>" class="modal fade change-micro-x-val" data-backdrop="static" data-keyboard="false">
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
                    </div> 

                    
                </div>



                <!--Modal Box For Microscopic Description X Field End-->
            </form>
            <script>
                jQuery(document).ready(function () {
                    /**
                     * Change Microscopic Code Description Modal
                     */
                    $(document).on('click', '#change_micro_desc_btn_<?php echo $inner_tab_count; ?>', function(e){
                        e.preventDefault();
                        var _this = jQuery(this);

                        var form_id = <?php echo $inner_tab_count; ?>;

                        var micro_code_id = _this.parents('.tg-tabfieldsetbtn').find('input[name=specimen_microscopic_code]').data('microcodeid');
                        var micro_code = _this.parents('.tg-tabfieldsetbtn').find('input[name=specimen_microscopic_code]').val();
                        var micro_desc = _this.parents('.tg-tabfieldsetbtn').next('.tg-tabfieldsetthree').find('.specimen_microscopic_description_form_id').val();

                        $('#change_micro_code_desc_'+form_id).find('input[name=micro_code_id]').val(micro_code_id);
                        $('#change_micro_code_desc_'+form_id).find('.micro_code_edit_name').val(micro_code);
                        $('#change_micro_code_desc_'+form_id).find('.micro_code_edit_desc').val(micro_desc);

                        $('#change_micro_code_desc_'+form_id).modal({show:true});
                    });

                     $(document).on('click', '#save-micro-change-btn-<?php echo $inner_tab_count; ?>', function(e){
                        e.preventDefault();
                        var _this = $(this);
                        var micro_id = _this.parents('#change_micro_code_desc_<?php echo $inner_tab_count; ?>').find('input[name=micro_code_id]').val();
                        var micro_desc = _this.parents('#change_micro_code_desc_<?php echo $inner_tab_count; ?>').find('.micro_code_edit_desc').val();
                        jQuery.ajax({
                            type: "POST",
                            url: "<?php echo base_url() . '/index.php/doctor/setMicroscopicCodeData'; ?>",
                            data: {'micro_id' : micro_id, 'micro_desc' : micro_desc},
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

                    $(document).on('change', '.specimen_snomed_t1_<?php echo $inner_tab_count; ?>', function(){
                        var _this = jQuery(this);
                        _this.parents('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('#snomed-values-<?php echo $inner_tab_count; ?> .snomed-t1').text(_this.val()+'.');
                    });
                    $(document).on('change', '.specimen_snomed_t2_<?php echo $inner_tab_count; ?>', function(){
                        var _this = jQuery(this);
                        _this.parents('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('#snomed-values-<?php echo $inner_tab_count; ?> .snomed-t2').text(_this.val()+'.');
                    });
                    $(document).on('change', '.specimen_snomed_p_<?php echo $inner_tab_count; ?>', function(){
                        var _this = jQuery(this);
                        _this.parents('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('#snomed-values-<?php echo $inner_tab_count; ?> .snomed-p').text(_this.val()+'.');
                    });
                    $(document).on('change', '#doctor_update_specimen_record_<?php echo $inner_tab_count; ?> .specimen_snomed_m_<?php echo $inner_tab_count; ?>', function(){
                        var _this = jQuery(this);

                        var snome_multi_selected_vals = $('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('.specimen_snomed_m_<?php echo $inner_tab_count; ?> option:selected');
                        var snomedDiagnosesArr = [];
                        var snomedVals = [];
                        var rcpathScore = [];

                        if(snome_multi_selected_vals.length > 0){
                            _this.parents('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('#snomed-values-<?php echo $inner_tab_count; ?> .snomed-m').text(_this.val());

                            $.each( snome_multi_selected_vals, function( parent_key, parent_value ) {
                                snomedDiagnosesArr = $(this).data('diagnoses').split(',');
                                rcpathScore[parent_key] = $(this).data('rcpath');
                            });

                            var snomedCheckBox = jQuery('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('.specimen_classification_<?php echo $inner_tab_count; ?>');
                            $.each( snomedDiagnosesArr, function( key, value ) {
                                $.each( snomedCheckBox, function( input_key, input_value ) {
                                    if(typeof value !== 'undefined' && value == $(this).val()){
                                        $(this).prop('checked', true);
                                    }
                                });
                            });

                            var rcpathMaxVal = Math.max.apply(Math, rcpathScore);
                            _this.parents('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('.rcpath_codedata').val(rcpathMaxVal);
                        }else{
                            _this.parents('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('#snomed-values-<?php echo $inner_tab_count; ?> .snomed-m').text('');
                            jQuery('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('.specimen_classification_<?php echo $inner_tab_count; ?>').prop('checked', false);
                            _this.parents('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').find('.rcpath_codedata').val('');
                        }
                    });
                    jQuery('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?> input[name=specimen_diagnosis]').bind('keyup change', function(){
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

                            if(typeof _this.find('.specimen_snomed_t1_<?php echo $inner_tab_count; ?> :selected').data('tdesc') !== 'undefined'){
                                snomed_t1_desc = _this.find('.specimen_snomed_t1_<?php echo $inner_tab_count; ?> :selected').data('tdesc');
                            }

                            if(typeof _this.find('.specimen_snomed_t2_<?php echo $inner_tab_count; ?> :selected').data('tdesc') !== 'undefined'){
                                snomed_t2_desc = ' ('+_this.find('.specimen_snomed_t2_<?php echo $inner_tab_count; ?> :selected').data('tdesc')+') — ';
                            }
                            
                            if(typeof _this.find('.specimen_snomed_p_<?php echo $inner_tab_count; ?> :selected').data('pdesc') !== 'undefined'){
                                snomed_p_desc = ' : '+_this.find('.specimen_snomed_p_<?php echo $inner_tab_count; ?> :selected').data('pdesc');
                            }

                            var snome_multi_selected = $('.specimen_snomed_m_<?php echo $inner_tab_count; ?>').find("option:selected");
                          
                            var arrSelected = [];
                            var snomed_m_desc_data = '';
                            snome_multi_selected.each(function(){
                                arrSelected.push($(this).data('mdesc'));
                                snomed_m_desc_data += $(this).data('mdesc')+';';
                            });

                            var setData = snomed_t1_desc + snomed_p_desc + snomed_t2_desc + snomed_m_desc_data;
                        
                            var move = false;

                            if(_this.find('.specimen_dignosis_<?php echo $inner_tab_count; ?>').attr('data-overwrite') == 'false'){
                                _this.find('.specimen_dignosis_<?php echo $inner_tab_count; ?>').val(setData);
                                move = true;
                            }else{
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
										location.reload(),
                                        jQuery(document).scrollTop(0);
                                        window.setTimeout(function () {
                                            
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
        </div>
        <?php
                $tabs_active = '';
                $inner_tab_count++;
            }
            ?>
    </div>
</div>
<?php
}