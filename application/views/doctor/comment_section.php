<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php

function comment_section($record_id, $request_query, $opinion_data) {
    $button_disable = '';
    if (!empty($opinion_data[0]->ura_opinion_req_id) && $record_id == $opinion_data[0]->ura_opinion_req_id) {
        $button_disable = 'disabled';
    }
    ?>

    <div class="well">
        <div id="comment_section_msg" class="comment_hide"></div>
        <div id="comment_clear_section_msg" class="comment_hide"></div>
        <form class="form" id="comment_section_form">
            <i style="color:red;">Leave Blank For Not Displaying Comments On Report . Note : Do Not Write Any Script or any HTML here. Add Just Text Here.</i>
            <div class="form-group">
                <label for="comment_section">Add Comments</label>
                <textarea rows="6" class="form-control" name="commnet_section" id="comment_section"><?php echo $request_query[0]->comment_section; ?></textarea>
            </div>
            <input type="hidden" name="record_id" value="<?php echo $record_id; ?>" />
            <div class="form-group">
                <button <?php echo $button_disable; ?> class="btn btn-success" id="add_comment_section">Add Comments</button>
                <button <?php echo $button_disable; ?> class="btn btn-warning pull-right" id="clear_comment_section">Clear Comments</button>
            </div>
        </form>

    </div>
    <?php
}
