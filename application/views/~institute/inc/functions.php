<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php

/**
 * Display MDT View
 *
 * @param array $mdt_cats
 * @param int $recordid
 * @param array $request_query
 * @return void
 */
function display_mdt($mdt_cats, $recordid, $request_query) {

    ob_start();
    ?>
    <div class="mdt_dates_msg"></div>
    <form class="form-inline" id="mdt_from_data">
        <?php
        $checked_for_mdt = '';
        if ($request_query[0]->mdt_case_status === 'for_mdt') {
            $checked_for_mdt = 'checked';
        }
        ?>
        <div class="form-group">
            <label for="for_mdt">For MDT</label>
            <input <?php echo $checked_for_mdt; ?> type="radio" name="mdt_dates_radio" id="for_mdt" class="mdt_radio" value="for_mdt">
        </div>
        <?php
        $checked_not_for_mdt = '';
        if ($request_query[0]->mdt_case_status === 'not_for_mdt') {
            $checked_not_for_mdt = 'checked';
        }
        ?>
        <div class="form-group">
            <label for="not_for_mdt">Not For MDT</label>
            <input <?php echo $checked_not_for_mdt; ?> type="radio" name="mdt_dates_radio" id="not_for_mdt" class="mdt_radio" value="not_for_mdt">
        </div>
        <div class="form-group">
            <?php if (!empty($mdt_cats)) { ?>
                <select name="mdt_dates" id="future_mdt_dates">
                    <option value="false">Select MDT Date</option>
                    <?php
                    
                    foreach ($mdt_cats as $dates) {
                        $selected = '';
                        if ($request_query[0]->mdt_case == $dates->ura_mdt_timestamp) {
                            $selected = 'selected';
                        }
                        ?>
                        <option <?php echo $selected; ?> value="<?php echo $dates->ura_mdt_timestamp; ?>"><?php echo $dates->ura_mdt_date; ?></option>
                    <?php } ?>
                </select>
            <?php } ?>
        </div>
        <div class="form-group mdt_specimen_hide" >
            <label for="not_for_mdt">Specimen 1</label>
            <input type="checkbox" name="mdt_specimen[]" id="" class="" value="Specimen 1">
            <label for="not_for_mdt">Specimen 2</label>
            <input type="checkbox" name="mdt_specimen[]" id="" class="" value="Specimen 2">
            <label for="not_for_mdt">Specimen 3</label>
            <input type="checkbox" name="mdt_specimen[]" id="" class="" value="Specimen 3">
            <label for="not_for_mdt">Specimen 4</label>
            <input type="checkbox" name="mdt_specimen[]" id="" class="" value="Specimen 4">
            <label for="not_for_mdt">Specimen 5</label>
            <input type="checkbox" name="mdt_specimen[]" id="" class="" value="Specimen 5">
        </div>
        <div class="form-group hide_report_option">
            <?php
            $add_to_report = '';
            if ($request_query[0]->mdt_case_status === 'not_for_mdt' && $request_query[0]->mdt_case === 'add_to_report') {
                $add_to_report = 'checked';
            }
            ?>
            <label for="add_to_report">Add To Report</label>
            <input <?php echo $add_to_report; ?> type="radio" name="report_option" id="add_to_report" class="report_option" value="add_to_report">
        </div>
        <div class="form-group hide_report_option">
            <?php
            $not_add_to_report = '';
            if ($request_query[0]->mdt_case_status === 'not_for_mdt' && $request_query[0]->mdt_case === 'not_to_add_to_report') {
                $not_add_to_report = 'checked';
            }
            ?>
            <label for="not_to_add_to_report">Not To Add To Report</label>
            <input <?php echo $not_add_to_report; ?> type="radio" name="report_option" id="not_to_add_to_report" class="report_option" value="not_to_add_to_report">
        </div>
        <input type="hidden" name="record_id" value="<?php echo $recordid; ?>">
        <button type="button" id="assign_mdt">Assign</button>
    </form>
    <div id="mdt_message_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">MDT Message</h4>
                </div>
                <div class="modal-body">
                <?php
            $attributes = array('id'=>'mdt_message_form','class' => 'form');
            echo form_open("", $attributes);
            ?>
                  
                        <div class="form-group">
                            <label for="add_mdt_message">Add MDT Message</label>
                            <textarea class="form-control" id="add_mdt_message" name="mdt_message"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="record_id" value="<?php echo $recordid; ?>">
                            <button class="btn btn-primary" id="add_mdt_msg_btn">Add Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <a data-toggle="modal" data-target="#show_mdt_notes" href="#">Show MDT Note</a>

    <div id="show_mdt_notes" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">MDT Note</h4>
                </div>
                <div class="modal-body">
                    <?php
                    if (!empty($request_query) && !empty($request_query[0]->mdt_case_msg)) {
                        ?>
                        <table class="table table-condensed table-striped">
                            <tr>
                                <th>MDT Note</th>
                                <th>Timestamp</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                            <tr>
                                <td><?php echo $request_query[0]->mdt_case_msg; ?></td>
                                <td>
                                    <?php
                                    $timestamp = date('d-m-Y', $request_query[0]->mdt_case_msg_timestamp);
                                    echo $timestamp;
                                    ?>
                                </td>
                                <td>
                                    <a href="javascript:;" class="delete_mdt_note" data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>">
                                        <img src="<?php echo base_url('assets/img/delete.png'); ?>">
                                    </a>
                                </td>
                                <td>
                                    <?php
                                    $mdt_add_status = 'mdt_not_add';
                                    $mdt_add_text = 'Add to Report';
                                    if ($request_query[0]->mdt_case_add_to_report_status == 1) {
                                        $mdt_add_status = 'mdt_add';
                                        $mdt_add_text = 'Not Add to Report';
                                    }
                                    ?>
                                    <a href="javascript:;" class="add_mdt_to_report" data-mdtstatus="<?php echo $mdt_add_status; ?>" data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>"><?php echo $mdt_add_text; ?></a>
                                </td>
                            </tr>
                        </table>
                        <?php
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    echo ob_get_clean();
}
