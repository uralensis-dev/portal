<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php

/**
 * Record History
 * @param type $record_history
 */
function block_history($record_history, $userid, $record_add_timestamp, $add_full_name) {
    ob_start();
    ?>
    <div id="rec_block_history_modal" class="modal fade" role="dialog" style="margin-top:10%;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Block History</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">


                <div class="" style="width:100%" id="dv_lab_rec_history">
                    <table class="table custom-table" id="record-block-table">
                        <thead>
                        <!-- <tr>
                            <th id="record-history-table-heading" colspan="5" style="font-size: 20px; padding: 10px;">
                            Record History
                            </th>
                        </tr> -->
                        <tr>
                            <th>Ref</th>
                            <th>Date</th>
                            <!-- <th>Time</th> -->
                            <th>Status</th>
                            <th>User ID</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php
    echo ob_get_clean();
}
?>