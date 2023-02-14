<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
/**
 * Show Suplementary Modal
 *
 * @param [type] $record_id
 * @param [type] $supplementary_query
 * @return void
 */
function show_supplementary_modal($record_id, $supplementary_query) {
    ?> 
    <div id="manage_supple" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Manage Supplementary Reports</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <div class="supple_msg"></div>
                    <table class="table table-striped manage_supple_table">
                        <tr class="info">
                            <th>Req ID.</th>
                            <th>Description</th>
                            <th>Date/Time</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                        if (!empty($supplementary_query) && is_array($supplementary_query)) {
                            foreach ($supplementary_query as $supply_rec) {
                                ?>
                                <tr>
                                    <td><?php echo $supply_rec->request_id; ?></td>
                                    <td><?php echo $supply_rec->description; ?></td>
                                    <td><?php echo $supply_rec->additional_work_time; ?></td>
                                    <td>
                                        <a class="delete_supple" href="javascript:void(0);" data-recordid="<?php echo $record_id; ?>" data-suppleid="<?php echo $supply_rec->additional_id; ?>">
                                            <img src="<?php echo base_url('assets/img/delete.png'); ?>">
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <?php
}
?>


