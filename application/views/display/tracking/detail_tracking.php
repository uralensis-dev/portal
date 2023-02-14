<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <?php
        if (!empty($tracking_detail)) {
            foreach ($tracking_detail as $tracking) {
                ?>
                <div class="row">
                    <div class="col-md-4">
                        <label class="label label-success" style="font-size:15px;">Batch Name : <?php echo $tracking->ura_track_batch_name; ?></label>
                    </div>
                    <div class="col-md-4">
                        <label class="label label-success" style="font-size:15px;">Batch Code : <?php echo $tracking->ura_track_batch_code; ?></label>
                    </div>
                    <div class="col-md-4">
                        <label class="label label-success" style="font-size:15px;">Batch Clinic Date & Time : <?php echo $tracking->ura_batch_clinic_date; ?></label>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <label class="label label-success" style="font-size:15px;">Download Attached Checklist :
                            <a style="color:white;text-decoration: underline;" href="<?php echo base_url() . 'uploads/' . $tracking->ura_batch_checklist_name; ?>" target="_blank">
                                <?php echo $tracking->ura_batch_checklist_name; ?>
                            </a>
                        </label>

                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="text-center">Sent To Lab</h3>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Drop off Location :</strong> <?php echo $tracking->ura_sent_to_address; ?></li>
                            <li class="list-group-item"><strong>Drop off Name :</strong> <?php echo $tracking->ura_sent_to_name; ?></li>
                            <li class="list-group-item"><strong>Drop off Date & Time :</strong> <?php echo $tracking->ura_sent_to_timestamp; ?></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h3 class="text-center">Received From Lab</h3>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Pick Up Location :</strong> <?php echo $tracking->ura_rec_from_lab_address; ?></li>
                            <li class="list-group-item"><strong>Pick Up Name :</strong> <?php echo $tracking->ura_rec_from_lab_name; ?></li>
                            <li class="list-group-item"><strong>Pick Up Date & Time :</strong> <?php echo $tracking->ura_rec_from_lab_timestamp; ?></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h3 class="text-center">Sent To Doctor</h3>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Drop off Location :</strong> <?php echo $tracking->ura_sent_to_doc_address; ?></li>
                            <li class="list-group-item"><strong>Drop off Name :</strong> <?php echo $tracking->ura_sent_to_doc_name; ?></li>
                            <li class="list-group-item"><strong>Drop off Date & Time :</strong> <?php echo $tracking->ura_sent_to_doc_timestamp; ?></li>
                        </ul>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <div class="row">
            <div class="col-md-8">
                <h3>Records Assigned To This Batch</h3>
                <div style="min-height:300px; overflow-y: scroll; width:100%;">
                    <table class="table table-condensed">
                        <tr>
                            <th>UL-No</th>
                            <th>EMIS No</th>
                            <th>NHS No</th>
                            <th>LAB No</th>
                            <th>Patient Name</th>
                            <th>Status</th>
                        </tr>
                        <?php
                        if (!empty($bacth_records)) {
                            foreach ($bacth_records as $records) {
                                ?>
                                <tr>
                                    <td><?php echo $records->serial_number; ?></td>
                                    <td><?php echo $records->emis_number; ?></td>
                                    <td><?php echo $records->nhs_number; ?></td>
                                    <td><?php echo $records->lab_number; ?></td>
                                    <td><?php echo $records->f_name . '&nbsp;' . $records->sur_name; ?></td>
                                    <td>
                                        <?php if($records->specimen_publish_status == 0){
                                            echo '<span style="color:red;">Un-Published</span>';
                                        }else{
                                            echo '<span style="color:green;">Published</span>';
                                        }?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </div> 
            </div>
        </div>
    </div>
</div>