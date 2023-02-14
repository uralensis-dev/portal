<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
/**
 * Record History
 * Track user activity rather any record
 * field is edit or just viewed.
 * @param type $record_history
 */

function record_history($record_history) 
{
    ob_start();
    ?>
    <button class="btn btn-warning pull-right" data-toggle="modal" data-target="#rec_history_modal">View Record History Track</button>
    <div id="rec_history_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Record History</h4>
                </div>
                <div class="modal-body">
                    <?php if (!empty($record_history)) { ?>
                        <?php
                        $counter = 1;
                        foreach ($record_history as $history) {
                            $change_class = 'style="background: #666699; padding: 7px; color: #fff; font-size: 15px; font-weight: bold; margin: 0 0 10px 0;"';
                            if ($history['rec_history_status'] === 'view') {
                                $change_class = 'style="background: #009999; padding: 7px; color: #fff; font-size: 15px; font-weight: bold; margin: 0 0 10px 0;"';
                            } elseif ($history['rec_history_status'] === 'publish') {
                                $change_class = 'style="background: #70db70; padding: 7px; color: #fff; font-size: 15px; font-weight: bold; margin: 0 0 10px 0;"';
                            } elseif ($history['rec_history_status'] === 'fw_add') {
                                $change_class = 'style="background: #e67300; padding: 7px; color: #fff; font-size: 15px; font-weight: bold; margin: 0 0 10px 0;"';
                            } elseif ($history['rec_history_status'] === 'supple_add') {
                                $change_class = 'style="background: #cc00cc; padding: 7px; color: #fff; font-size: 15px; font-weight: bold; margin: 0 0 10px 0;"';
                            } elseif ($history['rec_history_status'] === 'supple_publish') {
                                $change_class = 'style="background: #ccccff; padding: 7px; color: #fff; font-size: 15px; font-weight: bold; margin: 0 0 10px 0;"';
                            } elseif ($history['rec_history_status'] === 'unpublish') {
                                $change_class = 'style="background: #999966; padding: 7px; color: #fff; font-size: 15px; font-weight: bold; margin: 0 0 10px 0;"';
                            }
                            ?>
                            <div <?php echo $change_class; ?> class="record_history">
                                <?php
                                //Get user first and last name
                                $history_user_id = $history['rec_history_user_id'];
                                $username = get_uralensis_username($history_user_id);
                                if ($history['rec_history_status'] === 'view') {
                                    $get_time = '';
                                    if (!empty($history['timestamp'])) {
                                        $get_time = date('d/m/Y -- (H:i:s A)', $history['timestamp']);
                                    }
                                    ?>
                                    Record viewed by: <?php echo $username; ?>&nbsp; at <?php echo $get_time; ?>
                                    <?php
                                } elseif ($history['rec_history_status'] === 'edit') {
                                    $get_time = '';
                                    if (!empty($history['timestamp'])) {
                                        $get_time = date('d/m/Y -- (H:i:s A)', $history['timestamp']);
                                    }
                                    ?>
                                    <a href="javascript:;" data-toggle="collapse" data-target="#edit_history_<?php echo $counter; ?>">Record edited by: <?php echo $username; ?>&nbsp; at <?php echo $get_time; ?></a>
                                    <div id="edit_history_<?php echo $counter; ?>" class="collapse edit_history_collapse">
                                        <?php
                                        $record_fields = unserialize($history['rec_history_data']);
                                        if (!empty($record_fields)) {
                                            ?>
                                            <table class="table table-striped">
                                                <?php foreach ($record_fields as $key => $value) { ?>
                                                    <tr>
                                                        <td><?php echo $key; ?></td>
                                                        <td><?php echo $value; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        <?php } ?>
                                    </div>
                                    <?php
                                } elseif ($history['rec_history_status'] === 'fw_add') {
                                    $get_time = '';
                                    if (!empty($history['timestamp'])) {
                                        $get_time = date('d/m/Y -- (H:i:s A)', $history['timestamp']);
                                    }
                                    ?>
                                    <a href="javascript:;" data-toggle="collapse" data-target="#edit_history_<?php echo $counter; ?>">Further Work Requested by: <?php echo $username; ?>&nbsp; at <?php echo $get_time; ?></a>
                                    <div id="edit_history_<?php echo $counter; ?>" class="collapse edit_history_collapse">
                                        <?php
                                        $record_fields = unserialize($history['rec_history_data']);
                                        if (!empty($record_fields)) {
                                            ?>
                                            <table class="table table-striped">
                                                <?php foreach ($record_fields as $key => $value) { ?>
                                                    <tr>
                                                        <td><?php echo $key; ?></td>
                                                        <td><?php echo $value; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        <?php } ?>
                                    </div>
                                    <?php
                                } elseif ($history['rec_history_status'] === 'publish') {
                                    $get_time = '';
                                    if (!empty($history['timestamp'])) {
                                        $get_time = date('d/m/Y -- (H:i:s A)', $history['timestamp']);
                                    }
                                    ?>
                                    Record published by: <?php echo $username; ?>&nbsp; at <?php echo $get_time; ?>
                                    <?php
                                } elseif ($history['rec_history_status'] === 'supple_add') {
                                    $get_time = '';
                                    if (!empty($history['timestamp'])) {
                                        $get_time = date('d/m/Y -- (H:i:s A)', $history['timestamp']);
                                    }
                                    ?>
                                    <a href="javascript:;" data-toggle="collapse" data-target="#edit_history_<?php echo $counter; ?>">Supplementary Report Added by: <?php echo $username; ?>&nbsp; at <?php echo $get_time; ?></a>
                                    <div id="edit_history_<?php echo $counter; ?>" class="collapse edit_history_collapse">
                                        <?php
                                        $record_fields = unserialize($history['rec_history_data']);
                                        if (!empty($record_fields)) {
                                            ?>
                                            <table class="table table-striped">
                                                <?php foreach ($record_fields as $key => $value) { ?>
                                                    <tr>
                                                        <td><?php echo $key; ?></td>
                                                        <td>
                                                            <?php
                                                            if ($value === 'in_session') {
                                                                echo 'Not Published.';
                                                            } else {
                                                                echo $value;
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        <?php } ?>
                                    </div>
                                    <?php
                                } elseif ($history['rec_history_status'] === 'supple_publish') {
                                    $get_time = '';
                                    if (!empty($history['timestamp'])) {
                                        $get_time = date('d/m/Y -- (H:i:s A)', $history['timestamp']);
                                    }
                                    ?>
                                    Supplementary Report published by: <?php echo $username; ?>&nbsp; at <?php echo $get_time; ?>
                                    <?php
                                } elseif ($history['rec_history_status'] === 'unpublish') {
                                    $get_time = '';
                                    if (!empty($history['timestamp'])) {
                                        $get_time = date('d/m/Y -- (H:i:s A)', $history['timestamp']);
                                    }
                                    ?>
                                    Report Un-Published by: <?php echo $username; ?>&nbsp; at <?php echo $get_time; ?>
                                <?php } ?>

                            </div>
                            <?php
                            $counter++;
                        }
                        ?>
                    <?php } else { ?>
                        <div class="bg-warning" style="padding: 7px;">Sorry no history recorded yet.</div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php
    echo ob_get_clean();
}

/**
 * Get User first and last name
 * @param type $user_id
 * @return string
 */
function get_uralensis_username($user_id) 
{
    $ci = & get_instance();
    if (!empty($user_id)) {

        $f_name = $ci->ion_auth->user($user_id)->row()->first_name;
        $l_name = $ci->ion_auth->user($user_id)->row()->last_name;
        $username = $f_name . ' ' . $l_name;

        return $username;
    }
}

/**
 * Check Record Data State
 *
 * @param [type] $record_id
 * @param string $type
 * @return void
 */
function check_record_data_state($record_id, $type = '') 
{
    $ci = & get_instance();
    if (!empty($record_id) && isset($type) && $type === 'doctor') {
        $query = $ci->db->select('user_id')->where('request_id', $record_id)->get('request_assignee')->row_array();
        return $query;
    } elseif (!empty($record_id) && isset($type) && $type === 'specimen_type') {
        $query = $ci->db->select('report_urgency')->where('uralensis_request_id', $record_id)->get('request')->row_array();
        return $query;
    }
}
