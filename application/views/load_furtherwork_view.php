<tr class="dynamicFurther" style="display: none;" data-fid="<?php echo $fwId ?>">
<td colspan="8">
<div class="card" style="width: 100%">
    <div style="overflow: hidden; width: 100%">
        <div class="card-body" style="padding: 0">
            <div class="table-responsive form-group">
                <table class="table table-stripped custom-table" style="width: 100%;">
                    <thead class="thead-light">
                        <tr>
                            <th><b>Block No</th>
                            <th><b>Test<b></th>
                            <th><b>Status<b></th>
                            <th><b>Created Date & Time<b></th>
                            <th><img data-toggle="tooltip" title="Actions" src="<?php echo base_url('/assets/icons/Actions-Blue.png'); ?>" class="img-responsive pull-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($specimen_blocks_listing as $sp_block) {
                            $parameters['lab_no'] = $postData['labNumber'];
                            $parameters['request_id'] = $postData['request_id'];                                                            
                            $parameters['lab_id'] = $postData['id'];
                            $parameters['test_id'] = $sp_block->test_id; 

                            $parameters['test'] = $postData['test_name'];
                            $parameters['blockNo'] = $sp_block->block_no;
                            $parameters['page'] = "further_work";
                            $parameters['dropdownSelector'] = 'blocks_'.$sp_block->further_request_detail_id;
                            $parameters['dataValues'] = $postData['labNumber'].",".$postData['pSurname'];
                            $parameters['patientName'] = $patientInfo;
                            $parameters['pathologistName'] = $postData['pathologistName'];
                            $param = json_encode($parameters);
                        ?>
                            <tr>
                                <td><?php echo $sp_block->block_no; ?></td>
                                <td><?php echo $sp_block->description; ?></td>
                                <td>
                                <select class="change_further_status" data-rid="<?php echo $sp_block->id; ?>" data-action="single">
                                    <option value="">--Select Status--</option>
                                    <option value="pending" <?php print ($sp_block->fw_status == 'pending') ? "selected" : "";?>>Pending</option>
                                    <option value="processing" <?php print ($sp_block->fw_status == 'processing') ? "selected" : "";?>>Processing</option>
                                    <option value="completed" <?php print ($sp_block->fw_status == 'completed') ? "selected" : "";?>>Completed</option>
                                </select>
                                </td>
                                <td><?php echo date('d-m-Y h:i A', strtotime($sp_block->date_entered)); ?></td>
                                <td style="text-align:center">
                                <div class="pull-right">
                                
                                <select multiple name="test_ids[]"  id="blocks_<?php echo $sp_block->further_request_detail_id; ?>" placeholder="Test" class="test_wrap test-list form-control hide">
                                    <?php 
                                        echo '<option class="" value="'.$sp_block->test_id.'" title="'.$sp_block->test_id .' : '.$sp_block->test_name.'" selected>'.$sp_block->test_name.'</option>';
                                        ?>
                                </select>
                                    <a href='javascript:barcode_type(<?= $param; ?>,1)' class='text-success' title="Print Barcode."><strong><i class="fa-2x fa fa-barcode m-r-5"></i></strong></a>
                                    <!-- <a href='javascript:barcode_type(<?= $param; ?>,2)' class='text-success' title="Print Barcode."><strong><i class="fa-2x fa fa-barcode m-r-5"></i></strong></a> -->
                                </div>
                                <!-- <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="fa fa-eye m-r-5"></i> View</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                    </div>
                                </div> -->
                            </td>
                            </tr>
                        <?php
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</td>
</tr>