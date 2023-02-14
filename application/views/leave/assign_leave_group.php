<!-- Page Content -->

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-auto">
            <h3 class="page-title">Assign Leave Group</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Leaves</a></li>
                <li class="breadcrumb-item active">Assign Leave Group</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="javascript:;" class="btn add-btn btn-rounded" data-toggle="modal"
               data-target="#add_leave_modal"><i class="fa fa-plus"></i>Assign Leave Group</a>
        </div>
    </div>
</div>
<!-- /Page Header -->

<!-- Add Leave Modal -->
<div id="add_leave_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 800px;max-width: 800px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Leave Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $attributes = array('id' => 'assignGroupForm');
                echo form_open('', $attributes);
                ?>
                <!--                <form id="addLeaveTypeForm">-->
                <div class="col-md-12">
                    <input class="form-control" type="hidden" id="form_status" name="form_status">
                    <input class="form-control" type="hidden" id="edit_id" name="edit_id">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Group<span class="text-danger">*</span></label>
                            <select class="select" id="group_id" name="group_id">
                                <option value="">--Select Group--</option>
                                <?php
                                foreach ($groups as $data) { ?>
                                        <option value="<?php echo $data->group_id; ?>"><?php echo $data->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Leave Group<span class="text-danger">*</span></label>
                            <select class="select" id="leave_group_id" name="leave_group_id">
                                <option value="">--Select Leave Group--</option>
                                <?php
                                foreach ($leaveGroups as $leave) { ?>
                                    <option value="<?php echo $leave->id; ?>"><?php echo $leave->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <!--                        <div class="col-md-4 form-group">-->
                        <!--                            <label>Working Week<span class="text-danger">*</span></label>-->
                        <!--                            <select class="select" id="working_week_id" name="working_week_id">-->
                        <!--                                <option value="">--Select Working Week--</option>-->
                        <!--                                --><?php
                        //                                foreach ($workingWeeks as $data) { ?>
                        <!--                                    <option value="--><?php //echo $data->id; ?><!--">-->
                        <?php //echo $data->name; ?><!--</option>-->
                        <!--                                    --><?php
                        //                                }
                        //                                ?>
                        <!--                            </select>-->
                        <!--                        </div>-->
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
                <!--                </form>-->
            </div>
        </div>
    </div>
</div>
<!-- /Add Leave Modal -->

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table mb-0 simpletable">
                <thead>
                <tr>
                    <th>Role</th>
                    <!--                    <th>Email</th>-->
                    <!--                    <th>Group</th>-->
                    <th>Leave Group</th>
                    <th class="text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($groups as $data => $value) {
                    ?>
                    <tr>
                        <td><?php echo $value->name; ?></td>
<!--                        <td>--><?php //echo $user_email; ?><!--</td>-->
<!--                        <td>-->
<!--                            --><?php
//                            echo anchor("auth/edit_group/" . intval($value->group_id), htmlspecialchars(ucwords($value->description), ENT_QUOTES, 'UTF-8'));
//                            ?>
<!--                        </td>-->
                        <td>
                            <?php echo $value->leave_group; ?>
                        </td>
                        <td class="text-right">
                            <textarea id="edit_<?php echo $value->group_id; ?>" style="display:none;">
                                <?php
                                $insRecord['group_id'] = $value->group_id;
                                $insRecord['leave_group_id'] = $value->leave_group_id;
                                echo json_encode($insRecord);

                                ?>
                            </textarea>
                            <div class="dropdown dropdown-action">
                                <a href="javascript:;" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item editAssignGroupFormBtn"
                                       data-id="<?php echo $value->group_id; ?>"
                                       href="javascript:;"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <!--                                    <a class="dropdown-item" href="javascript:;" data-toggle="modal"-->
                                    <!--                                       data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i> Delete</a>-->
                                </div>
                            </div>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
