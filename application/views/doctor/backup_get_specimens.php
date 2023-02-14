<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php

function get_specimens($specimen_query, $request_query, $record_id, $get_cost_codes, $opinion_data) {
    $button_disable = '';
    if (!empty($opinion_data[0]->ura_opinion_req_id) && $record_id == $opinion_data[0]->ura_opinion_req_id) {
        $button_disable = 'disabled';
    }
    /* Snomed T Code */
    require_once('application/views/doctor/inc/snomed/snomed-t-code.php');

    /* Snomed P Code */
    require_once('application/views/doctor/inc/snomed/snomed-p-code.php');

    /* Snomed M Code */
    require_once('application/views/doctor/inc/snomed/snomed-m-code.php');
    ?>
    <ul class="nav nav-tabs specimen_tabs">
        <?php
        $active = 'active';
        $count = 1;
        foreach ($specimen_query as $row) :
            ?>
            <li class="<?php echo $active; ?>"><a data-toggle="tab" href="#tabs_<?php echo $count; ?>">Specimen <?php echo $count; ?></a></li>
            <?php
            $active = '';
            $count++;
        endforeach;
        ?>
    </ul>
    <div class="tab-content specimen_tab_content">
        <?php
        $tabs_active = 'active';
        $inner_tab_count = 1;
        foreach ($specimen_query as $row) :
            ?>
            <div id="tabs_<?php echo $inner_tab_count; ?>" class="tab-pane fade in <?php echo $tabs_active; ?>">
                <form method="post" id="doctor_update_specimen_record_<?php echo $inner_tab_count; ?>" class="doctor_update_specimen">
                    <div class="row">
                        <div class="col-md-2 custom_width">
                            <div class="form-group">
                                <label>S.Site (T Code)</label>
                                <input type="text" class="form-control" name="specimen_site" id="date" value="<?php echo $row->specimen_site; ?>"/>
                            </div>
                        </div>
                        <div class="col-md-2 custom_width">
                            <div class="form-group">
                                <label>S (P Code)</label>
                                <input type="text" class="form-control" name="specimen_procedure" id="date" value="<?php echo $row->specimen_procedure; ?>"/>
                            </div>
                        </div>
                        <div class="col-md-2 custom_width">
                            <div class="form-group">
                                <label>S Type</label>
                                <input readonly type="text" class="form-control" name="specimen_type" id="date" placeholder="Specimen Type" value="<?php echo $row->specimen_type; ?>" />
                            </div>
                        </div>
                        <div class="col-md-2 custom_width">
                            <div class="form-group">
                                <label for="specimen_block">Specimen Block</label>
                                <select style="margin-top:8px;" name="specimen_block" id="specimen_block"  class="form-control">
                                    <?php
                                    if (!empty($get_cost_codes)) {
                                        foreach ($get_cost_codes as $codes) {
                                            $selected = '';
                                            if ($codes->ura_cost_code_desc == $row->specimen_block) {

                                                $selected = 'selected';
                                            }
                                            ?>
                                            <option <?php echo $selected; ?> value="<?php echo $codes->ura_cost_code_desc; ?>"><?php echo $codes->ura_cost_code_desc; ?></option>
                                            <?php
                                        }//endforeach
                                    } else {
                                        echo '<option value="0">Please Add The Codes First.</option>';
                                    }//endif
                                    ?>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-2 custom_width">
                            <div class="form-group">
                                <label>S Slides</label>
                                <input type="text" class="form-control" name="specimen_slides" id="date" value="<?php echo $row->specimen_slides; ?>"/>
                            </div>
                        </div>
                        <div class="col-md-2 custom_width">
                            <div class="form-group">
                                <label>S.Block Type</label>
                                <input type="text" class="form-control" name="specimen_block_type" id="date" value="<?php echo $row->specimen_block_type; ?>"/>
                            </div>
                        </div>
                        <div class="col-md-2 custom_width">
                            <div class="form-group">
                                <label>S.Snomed Code</label>
                                <input  type="text" class="form-control" name="specimen_snomed_code" id="specimen_snomed_code"  value="<?php echo $row->specimen_snomed_code; ?>"/>
                            </div>
                        </div>
                        <div class="col-md-2 custom_width">
                            <div class="form-group">
                                <label for="rcpath_code">RCPath Code</label>
                                <select style="margin-top:8px;" name="rcpath_code" class="form-control rcpath_code">
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
                                        $selected = '';
                                        if ($key == $row->specimen_rcpath_code) {

                                            $selected = 'selected';
                                        }
                                        ?>
                                        <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $rcpath_code; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php
                                $checked = '';
                                if ($row->specimen_benign == 'benign') {
                                    $checked = 'checked';
                                }
                                ?>
                                <label class="checkbox-inline">
                                    <input <?php echo $checked; ?> type="checkbox" class="specimen_classification" name="specimen_benign" value="benign" style="margin-top:0px;">Benign
                                </label>
                                <?php
                                $checked = '';
                                if ($row->specimen_atypical == 'atypical') {
                                    $checked = 'checked';
                                }
                                ?>
                                <label class="checkbox-inline"><input <?php echo $checked; ?> type="checkbox" class="specimen_classification" name="specimen_atypical" value="atypical" style="margin-top:0px;">Atypical</label>
                                <?php
                                $checked = '';
                                if ($row->specimen_malignant == 'malignant') {
                                    $checked = 'checked';
                                }
                                ?>
                                <label class="checkbox-inline"><input <?php echo $checked; ?> type="checkbox" class="specimen_classification" name="specimen_malignant" value="malignant" style="margin-top:0px;">Malignant</label>
                                <?php
                                $checked = '';
                                if ($row->specimen_inflammation == 'inflammation') {
                                    $checked = 'checked';
                                }
                                ?>
                                <label class="checkbox-inline"><input <?php echo $checked; ?> type="checkbox" class="specimen_classification" name="specimen_inflammation" value="inflammation" style="margin-top:0px;">Inflammation</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 dynamic_data">
                            <div class="form-group">
                                <label>Specimen Macroscopic Description <b style="color:red;">*</b></label>
                                <textarea rows="7" required class="form-control" name="specimen_macroscopic_description" id="specimen_macroscopic_description"><?php echo $row->specimen_macroscopic_description; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Specimen Microscopic Code </label>
                                <input type="text" data-formid="<?php echo $inner_tab_count; ?>" class="form-control specimen_microscopic_code" name="specimen_microscopic_code" id="specimen_microscopic_code" value="<?php echo $row->specimen_microscopic_code; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Specimen Microscopic Description <b style="color:red;">*</b></label>
                                <textarea rows="7" required class="form-control specimen_microscopic_description" name="specimen_microscopic_description" id="specimen_microscopic_description"><?php echo trim($row->specimen_microscopic_description); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Specimen Cancer Register</label>
                                <input type="text" class="form-control specimen_cancer" name="specimen_cancer" id="specimen_cancer" value="<?php echo $row->specimen_cancer_register; ?>"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Specimen Diagnosis</label>
                                <input type="text" class="form-control specimen_dignosis" name="specimen_diagnosis" id="specimen_dignosis" value="<?php echo $row->specimen_diagnosis_description; ?>"/>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php
                                $snomed_t_array = snomed_t_code();
                                $snomed_t_id = $row->specimen_snomed_t;
                                $snomed_t_arr = explode(',', $snomed_t_id);
                                ?>
                                <label for="specimen_snomed_t">Snomed T</label>
                                <select  name="specimen_snomed_t[]" id="specimen_snomed_t"  class="form-control selectpicker specimen_snomed_t" multiple data-live-search="true">
                                    <?php
                                    foreach ($snomed_t_array as $snomed_t_code) {
                                        $selected = '';
                                        $snomed_t = strtolower(str_replace(' ', '', trim($snomed_t_code)));
                                        if (in_array($snomed_t, $snomed_t_arr)) {

                                            $selected = 'selected';
                                        }
                                        ?>
                                        <option <?php echo $selected; ?> value="<?php echo $snomed_t; ?>"><?php echo $snomed_t_code; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php
                                $snomed_p_array = snomed_p_code();
                                $snomed_p_id = $row->specimen_snomed_p;
                                $snomed_p_arr = explode(',', $snomed_p_id);
                                ?>
                                <label for="specimen_snomed_p">Snomed P</label>
                                <select name="specimen_snomed_p[]" id="specimen_snomed_p"  class="form-control selectpicker specimen_snomed_p" multiple data-live-search="true">
                                    <?php
                                    foreach ($snomed_p_array as $key => $snomed_p_code) {
                                        $selected = '';
                                        $snomed_p = strtolower(str_replace(' ', '', trim($snomed_p_code)));
                                        if (in_array($snomed_p, $snomed_p_arr)) {

                                            $selected = 'selected';
                                        }
                                        ?>
                                        <option <?php echo $selected; ?> value="<?php echo $snomed_p; ?>"><?php echo $snomed_p_code; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php
                                $snomed_m_array = snomed_m_code();
                                $snomed_m_id = $row->specimen_snomed_m;
                                $snomed_m_arr = explode(',', $snomed_m_id);
                                ?>
                                <label for="specimen_snomed_m">Snomed M</label>
                                <select name="specimen_snomed_m[]" id="specimen_snomed_m"  class="form-control selectpicker specimen_snomed_m" multiple data-live-search="true">
                                    <?php
                                    foreach ($snomed_m_array as $key => $snomed_m_code) {
                                        $selected = '';
                                        $snomed_m = strtolower(str_replace(' ', '', trim($snomed_m_code)));
                                        if (in_array($snomed_m, $snomed_m_arr)) {

                                            $selected = 'selected';
                                        }
                                        ?>
                                        <option <?php echo $selected; ?> value="<?php echo $snomed_m; ?>"><?php echo $snomed_m_code; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div id="doctor_update_specimen_record_message_<?php echo $inner_tab_count; ?>"></div>
                                <?php if (!$row->specimen_publish_status == 1) { ?>
                                    <button <?php echo $button_disable; ?> class="btn btn-info update_specimen_record_btn" id="doctor_update_specimen_record_btn_<?php echo $inner_tab_count; ?>" name="submit">Update Diagnosis</button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="snomed_m_value" class="snomed_m_value" value="">
                    <input type="hidden" name="record_id" value="<?php echo $record_id; ?>" >
                    <input type="hidden" name="specimen_id" value="<?php echo $row->specimen_id; ?>" >
                </form>
                <script>
                    jQuery(document).ready(function () {
                        jQuery('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').on('submit', function (e) {
                            e.preventDefault();
                            var _this = jQuery(this);

                            var snomed_value = $('.snomed_m_value').val();

                            var snomed_m = '';
                            if (snomed_value != '' && snomed_value != null) {
                                snomed_m = snomed_value;
                            }

                            if (snomed_m.indexOf("melanoma") != -1) {
                                if ($('.snomed_check_mdt').val() == '') {
                                    jQuery.sticky('Please choose the mdt date first.', {classList: 'success', speed: 200, autoclose: 5000});
                                    return false;
                                }
                            }
                            var update_persoanl_record = jQuery('#doctor_update_specimen_record_<?php echo $inner_tab_count; ?>').serialize();
                            jQuery.ajax({
                                type: "POST",
                                url: "<?php echo base_url() . '/index.php/doctor/update_client_report'; ?>",
                                data: update_persoanl_record,
                                dataType: "json",
                                success: function (response) {
                                    if (response.type === 'success') {
                                        jQuery('#doctor_update_specimen_record_message_<?php echo $inner_tab_count; ?>').html(response.msg);
                                        window.setTimeout(function () {
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
            </div>
            <?php
            $tabs_active = '';
            $inner_tab_count++;
        endforeach;
        ?>
    </div>
    <?php
}
