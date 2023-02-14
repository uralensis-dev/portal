<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php

/**
 * @package Uralensis
 * @desc Special Notes Class
 */
class Notes {

    /**
     * Special Notes Method
     * @method type specialnotes
     */
    public static function special_notes($record_id, $request_query, $opinion_data) {
        $button_disable = '';
        if (!empty($opinion_data[0]->ura_opinion_req_id) && $record_id == $opinion_data[0]->ura_opinion_req_id) {
            $button_disable = 'disabled';
        }
        ?>
        <div class="well">
            <div id="special_notes_msg"></div>
            <form class="form" id="special_notes_form">
                <i style="color:red;">Note : Do Not Write Any Script or any HTML here. Add Just Text Here.</i>
                <div class="form-group">
                    <label for="special_notes">Special Notes</label>
                    <textarea rows="6" class="form-control" name="special_notes" id="special_notes"><?php echo $request_query[0]->special_notes; ?></textarea>
                </div>
                <input type="hidden" name="record_id" value="<?php echo $record_id; ?>" />
                <div class="form-group">
                    <button <?php echo $button_disable; ?> class="btn btn-success" id="add_special_notes">Add Notes</button>
                    <button <?php echo $button_disable; ?>  class="btn btn-warning pull-right" id="clear_special_notes">Clear Notes</button>
                </div>
            </form>
        </div>
        <?php
    }

}

new Notes();
