<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <table id="further_work_table_hospital" class="table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr class="info">
                    <th>Request No</th>
                    <th>Uralensis ID</th>
                    <th>Further Work Detail</th> 
                    <th>Doctor Name</th>
                    <th>Further Work Date</th>
                    <th>Status</th>
                    <th>Template</th>
                </tr>
            </thead>
            <tfoot>
                <tr class="info">
                    <th>Request No</th>
                    <th>Uralensis ID</th>
                    <th>Further Work Detail</th> 
                    <th>Doctor Name</th>
                    <th>Further Work Date</th>
                    <th>Status</th>
                    <th>Template</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                if (!empty($query)) {
                    $count = 0;
                    foreach ($query as $further) {
                        ?>

                        <tr>
                            <td><?php echo intval($further->request_id); ?></td>
                            <td><?php echo html_purify($further->serial_number); ?></td>
                            <td><?php echo html_purify($further->furtherword_description); ?></td>
                            <td><?php echo html_purify($further->first_name) . '&nbsp;' . html_purify($further->last_name); ?></td>
                            <td><?php echo $further->furtherwork_date; ?></td>
                            <td><?php echo html_purify($further->fw_status); ?></td>
                            <td><a href="#" data-toggle="modal" data-target="#fw_modal_<?php echo intval($count); ?>"><img width="24px" src="<?php echo base_url('assets/img/chat_comments.png'); ?>"></a>
                                    <div id="fw_modal_<?php echo intval($count); ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Copy Further Work Template</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <?php echo $further->fw_preview_template; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </td>
                        </tr>
                        <?php
                        $count++;
                    }//endforeach
                } else {
                    echo '<p class="bg-danger" style="padding:5px;">No Further Work Requested Or Completed Yet!.</div>';
                }//endif
                ?>
            </tbody>
        </table>

    </div>  

</div>