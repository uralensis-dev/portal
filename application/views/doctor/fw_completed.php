<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid">
    <div class="col-md-12 form-group">
        <div class="pull-right"><a id="doctor_advance_search" href="javascript:void(0);"><i class="fa fa-search" style="margin-right:10px;"></i> Advance Search</a></div>
        <div class="clearfix"></div>
    </div>

    <div class="clearfix"></div>

    <div id="advance_search_table">
       <!-- <form action="<?php //echo site_url('Doctor/search_request'); ?>" method="post">-->
          
        <?php
               $attributes = array('class' => '');
                echo form_open("Doctor/search_request", $attributes);
                ?>
        <table class="table table-bordered">
                <tr class="bg-primary">
                    <th>First Name</th>
                    <th>Sur Name</th>
                    <th>EMIS No</th>
                    <th>LAB No</th>
                    <th>NHS No</th>
                </tr>
                <tr>
                    <td>
                        <input class="form-control" type="text" id="first_name" name="first_name">
                    </td>
                    <td>
                        <input class="form-control" type="text" id="sur_name" name="sur_name">
                    </td>
                    <td>
                        <input class="form-control" type="text" id="emis_no" name="emis_no">
                    </td>
                    <td>
                        <input class="form-control" type="text" id="lab_no" name="lab_no">
                    </td>
                    <td>
                        <input class="form-control" type="text" id="nhs_no" name="nhs_no">
                    </td>
                </tr>
            </table>
            <div class="form-group">
                <button type="submit" class="btn btn-success"><i class="fa fa-search" style="margin-right:5px;"></i> Search</button>
            </div> 
        </form>
    </div>
    <div class="clearfix"></div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Further Work Completed</div>
                <div class="panel-body">
                    <table id="further_work_table_completed" class="table table-striped" cellspacing="0" width="100%" style="border:1px solid #55ce63;">
                        <thead>
                            <tr class="bg-success" style="color:#fff">
                                <th style="width: 90px;">Uralensis ID</th>
                                <th>Further Work Detail</th> 
                                <th>Detail</th>
                                <th>Doctor Name</th>
                                <th>Further Work Date</th>
                                <th>Template</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($completed)) {
                                $count = 0;
                                foreach ($completed as $further_complete) {
                                    ?>
                                    <tr>
                                        <td><?php echo $further_complete->serial_number; ?></td>
                                        <td> <?php echo $further_complete->furtherword_description; ?></td>
                                        <td><a href="<?php echo site_url() . '/doctor/doctor_record_detail/' .$further_complete->request_id; ?>">Detail</a></td>
                                        <td> <?php echo $further_complete->first_name . '&nbsp;' . $further_complete->last_name; ?></td>
                                        <td><?php echo $further_complete->furtherwork_date; ?></td>
                                        <td><a href="#" data-toggle="modal" data-target="#fw_modal_<?php echo intval($count); ?>"><img width="24px" src="<?php echo base_url('assets/img/chat_comments.png'); ?>"></a>
                                        <div id="fw_modal_<?php echo intval($count); ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Copy Further Work Template</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo $further_complete->fw_preview_template; ?>
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
                                echo '<div class="bg-danger" style="padding:6px;">No Further Work Completed Yet!.</div><hr>';
                            }//endif
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>