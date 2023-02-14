<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
/**
 * Display MDT Reports
 *
 * @param array $mdt_cats
 * @param int $recordid
 * @param array $request_query
 * @return void
 */
function display_mdt($mdt_cats, $recordid, $request_query) 
{
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
            <input <?php echo html_purify($checked_for_mdt); ?> type="radio" name="mdt_dates_radio" id="for_mdt" class="mdt_radio" value="for_mdt">
        </div>
        <?php
        $checked_not_for_mdt = '';
        if ($request_query[0]->mdt_case_status === 'not_for_mdt') {
            $checked_not_for_mdt = 'checked';
        }
        ?>
        <div class="form-group">
            <label for="not_for_mdt">Not For MDT</label>
            <input <?php echo html_purify($checked_not_for_mdt); ?> type="radio" name="mdt_dates_radio" id="not_for_mdt" class="mdt_radio" value="not_for_mdt">
        </div>
        <div class="form-group">
            <?php if (!empty($mdt_cats)) { ?>
                <select name="mdt_dates" id="mdt_dates">
                    <option value="false">Select MDT Date</option>
                    <?php
                    foreach ($mdt_cats as $dates) {
                        $selected = '';
                        if ($request_query[0]->mdt_case == $dates->ura_mdt_timestamp) {
                            $selected = 'selected';
                        }
                        ?>
                        <option <?php echo html_purify($selected); ?> value="<?php echo $dates->ura_mdt_timestamp; ?>"><?php echo $dates->ura_mdt_date; ?></option>
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
            <input <?php echo html_purify($add_to_report); ?> type="radio" name="report_option" id="add_to_report" class="report_option" value="add_to_report">
        </div>
        <div class="form-group hide_report_option">
            <?php
            $not_add_to_report = '';
            if ($request_query[0]->mdt_case_status === 'not_for_mdt' && $request_query[0]->mdt_case === 'not_to_add_to_report') {
                $not_add_to_report = 'checked';
            }
            ?>
            <label for="not_to_add_to_report">Not To Add To Report</label>
            <input <?php echo html_purify($not_add_to_report); ?> type="radio" name="report_option" id="not_to_add_to_report" class="report_option" value="not_to_add_to_report">
        </div>
        <input type="hidden" name="record_id" value="<?php echo intval($recordid); ?>">
        <button type="button" id="assign_mdt_record">Assign</button>
    </form>
    <?php
    echo ob_get_clean();
}
