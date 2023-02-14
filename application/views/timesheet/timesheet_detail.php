<style>
    .comments_icon{
        position: relative;
    }
    .comments_icon .badge {
        position: absolute;
        top: -20px;
        right: -10px;
    }
    .comments_detail_html .bg-white{position: relative;}
    .timesheet_ul{
        position: absolute;
        right: 0;
        top: 0px;
    }
    .users_hh {
        display: none;
        position: absolute;
        top: 24px;
        background: #fff;
        font-size: 14px;
        padding: 0 5px;
        color: #555;
        cursor: default;
    }

    .like:hover .users_hh{
        display: block;
        /*border: 1px solid #ddd;*/
    }
</style>
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Timesheet</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Timesheet</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <!--			<a href="#" class="btn add-btn btn-rounded" data-toggle="modal" data-target="#add_todaywork"><i class="fa fa-plus"></i> Add Today Work</a>-->
            <?php if ($end_time_status == 0) { ?>
                <a href="javascript:;" id="start_time_btn" class="btn add-btn btn-rounded"><i class="fa fa-clock-o"></i>
                    Start Time</a>
            <?php } else { ?>
                <a href="javascript:;" id="end_time_btnss" data-toggle="modal" data-target="#addTodayWorkModal"
                   class="btn add-btn btn-rounded"><i class="fa fa-clock-o"></i> Stop Time</a>
            <?php } ?>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table mb-0 datatable">
                <thead>
                <tr>
                    <th>Employee</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Duration (Hour)</th>
<!--                    <th>Comments</th>-->
                    <th><img data-toggle="tooltip" title="" src="<?php echo base_url() ?>/assets/icons/Comments.png"
                             class="img-responsive centerd" data-original-title="Comments" style="width: 40px;"></th>
                    <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($userTimeSheetData as $uDetail) { ?>
                    <tr>
                        <td>
                            <h2 class="table-avatar">
                                <a href="javascript:;" class="avatar dashboard_admin" style="pointer-events: none">
                                    <img alt="" class="profile-pic"
                                         src="<?php echo get_profile_picture($uDetail->profile_picture_path, $uDetail->first_name, $uDetail->last_name); ?>"></a>
                                <a href="javascript:;"
                                   style="pointer-events: none"><?php echo $uDetail->first_name . " " . $uDetail->last_name; ?>
                                    <span><?php echo $this->ion_auth->get_users_groups($uDetail->user_id)->row()->description; ?></span></a>
                            </h2>
                        </td>
                        <td><?php echo date("Y-m-d", strtotime($uDetail->task_date)) ?></td>
                        <td><?php echo date("h:i A", strtotime($uDetail->start_time)) ?></td>
                        <td><?php echo($uDetail->end_time == "" ? "" : date("h:i A", strtotime($uDetail->end_time))) ?></td>
                        <td><?php echo $uDetail->hours ?></td>
<!--                        <td>--><?php //echo $uDetail->comments ?><!--</td>-->
                        <td>
                            <div class="comments_icons text-center">
                                <a style="color:#000;" href="javascript:;" data-id="<?php echo $uDetail->id; ?>"
                                   id="display_comment_box" class="display_comment_box" data-toggle="modal"
                                   data-target="#time_comment_modal">
                                    <i class="fa fa-comment-o" style="font-size: 20px;"></i>
                                    <?php $getCommentsCount = getFlagCommentsCount($uDetail->id,C_TIMESHEET);?>
<!--                                    <i class="lnr lnr-bubble"></i>-->
                                    <span class="badge bg-info"><?php echo $getCommentsCount;?></span>
                                </a>
                            </div>
                        </td>
                        <td><?php echo $uDetail->description ?></td>
                        <!--						<td class="text-right">-->
                        <!--                            <textarea id="timedetail_-->
                        <?php //echo $uDetail->id;?><!--" style="display: none">-->
                        <?php //echo json_encode($uDetail);?><!--</textarea>-->
                        <!--                            <div class="dropdown dropdown-action">-->
                        <!--								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>-->
                        <!--								<div class="dropdown-menu dropdown-menu-right">-->
                        <!--									<a class="dropdown-item add_task_detail" data-id="-->
                        <?php //echo $uDetail->id;?><!--" href="javascript:;"><i class="la la-edit m-r-5"></i>Add Detail</a>-->
                        <!--									<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_workdetail"><i class="fa fa-trash-o m-r-5"></i> Delete</a>-->
                        <!--								</div>-->
                        <!--							</div>-->
                        <!--						</td>-->
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div id="add_task_detail" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Work Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $attributes = array('id' => 'addTaskDetailForm');
                echo form_open(current_url(), $attributes);
                ?>
                <input type="hidden" name="timesheet_id" id="timesheet_id">
                <!--                <form>-->
                <div class="form-group">
                    <label>Description <span class="text-danger">*</span></label>
                    <textarea rows="4" name="task_detail" id="task_detail" class="form-control"></textarea>
                </div>
                <div class="submit-section">
                    <button class="btn btn-primary submit-btn">Submit</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>

<!-- Edit Today Work Modal -->
<div id="edit_todaywork" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Work Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Project <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Office Management</option>
                                <option>Project Management</option>
                                <option>Video Calling App</option>
                                <option>Hospital Administration</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>Deadline <span class="text-danger">*</span></label>
                            <div class="cal-icon">
                                <input class="form-control" type="text" value="5 May 2019" readonly>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Total Hours <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" value="100" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Remaining Hours <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" value="60" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Date <span class="text-danger">*</span></label>
                            <div class="cal-icon">
                                <input class="form-control datetimepicker" value="03/03/2019" type="text">
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Hours <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" value="9">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description <span class="text-danger">*</span></label>
                        <textarea rows="4" class="form-control">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel elit neque.</textarea>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .date {
        /*font-size: 11px*/
    }

    .comment-text {
        /*font-size: 12px*/
    }

    .fs-12 {
        /*font-size: 12px*/
    }

    .shadow-none {
        box-shadow: none
    }

    .name {
        /*color: #00c5fb*/
    }

    .cursor:hover {
        color: #00c5fb
    }

    .cursor {
        cursor: pointer
    }

    .textarea {
        resize: none
    }
</style>
<!-- /Edit Today Work Modal -->
<div id="time_comment_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header py-2">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Comment</h4>
            </div>
            <div class="modal-body py-2">
                <?php
                $attributes = array("id" => "addTaskCommentForm");
                echo form_open(current_url(), $attributes);
                ?>
                <input type="hidden" name="task_comment_id" id="task_comment_id" value="">
                <input type="hidden" name="data_section" id="data_section" value="<?php echo C_TIMESHEET;?>">
                <div class="d-flex justify-content-center row">
                    <div class="col-md-12">
                        <div class="d-flex flex-column comment-section">
                            <div class="comments_detail_html" style="max-height: 300px;overflow: scroll;">

                            </div>
                            <div class="bg-light p-2">
                                <?php
                                $logInUser = $this->ion_auth->user()->row()->id;
                                $logInUserData = getLoggedInUserProfile($logInUser);
                                //                                echo "<pre>";print_r($logInUserData);exit;
                                ?>
                                <div class="d-flex flex-row align-items-start">
                                    <img class="rounded-circle"
                                         src="<?php echo get_profile_picture($logInUserData[0]->profile_picture_path, $logInUserData[0]->first_name, $logInUserData[0]->last_name); ?>"
                                         width="40">
                                    <input type="hidden" name="edit_status" id="edit_status" value="0">
                                    <input type="hidden" name="edit_com_id" id="edit_com_id" value="0">
                                    <textarea class="form-control ml-1 shadow-none textarea" id="flag_comment"
                                              name="flag_comment"></textarea>
                                </div>
                                <div class="mt-2 text-right">
                                    <button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment
                                    </button>
                                    <button class="btn btn-outline-primary btn-sm ml-1 shadow-none cancel-com-btn" type="button" style="display: none">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- <div id="time_comment_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Comment</h4>
            </div>
            <?php
//$attributes = array("id"=>"addTaskCommentForm");
//echo form_open(current_url(),$attributes);
?>
            <input type="hidden" name="task_comment_id" id="task_comment_id" value="">
            <div class="modal-body">
                <div class="flag_msg"></div>

                <div class="form-group">
                    <textarea name="flag_comment" id="flag_comment" class="form-control flag_comment"></textarea>
                </div>
                <div class="form-group">
                    <hr>
                    <button class="btn btn-primary flag_comments_save_record_list" id="flag_comments_save">Save Comments</button>
                </div>

            </div>
            <?php //echo form_close();?>
        </div>
    </div>
</div> -->

<!-- Delete Today Work Modal -->
<div class="modal custom-modal fade" id="delete_workdetail" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Work Details</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-dismiss="modal"
                               class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Delete Today Work Modal -->

<?php //$this->load->view("timesheet/end_time_modal");?>