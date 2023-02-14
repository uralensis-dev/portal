<!-- Page Content -->

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Working Week</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Leaves</a></li>
                <li class="breadcrumb-item active">Working Week</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="javascript:;" class="btn add-btn" data-toggle="modal"
               data-target="#add_leave_modal"><i class="fa fa-plus"></i> Add Working Week</a>
        </div>
    </div>
</div>
<!-- /Page Header -->

<!-- Add Leave Modal -->
<div id="add_leave_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 800px;max-width: 800px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Working Week</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $attributes = array('id'=>'addWorkingWeekForm');
                echo form_open('',$attributes);
                ?>
<!--                <form id="addLeaveTypeForm">-->
                    <div class="col-md-12">
                        <input class="form-control" type="hidden" id="form_status" name="form_status">
                        <input class="form-control" type="hidden" id="edit_id" name="edit_id">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Name<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="name" name="name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 form-group">
                                <div class="card-title with-switch">
                                    Monday
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="monday" class="onoffswitch-checkbox" id="monday" checked>
                                        <label class="onoffswitch-label" for="monday">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 form-group">
                                <div class="card-title with-switch">
                                    Tuesday
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="tuesday" class="onoffswitch-checkbox" id="tuesday" checked>
                                        <label class="onoffswitch-label" for="tuesday">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 form-group">
                                <div class="card-title with-switch">
                                    Wednesday
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="wednesday" class="onoffswitch-checkbox" id="wednesday" checked>
                                        <label class="onoffswitch-label" for="wednesday">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 form-group">
                                <div class="card-title with-switch">
                                    Thursday
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="thursday" class="onoffswitch-checkbox" id="thursday" checked>
                                        <label class="onoffswitch-label" for="thursday">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 form-group">
                                <div class="card-title with-switch">
                                    Friday
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="friday" class="onoffswitch-checkbox" id="friday" checked>
                                        <label class="onoffswitch-label" for="friday">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 form-group">
                                <div class="card-title with-switch">
                                    Saturday
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="saturday" class="onoffswitch-checkbox" id="saturday" checked>
                                        <label class="onoffswitch-label" for="saturday">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 form-group">
                                <div class="card-title with-switch">
                                    Sunday
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="sunday" class="onoffswitch-checkbox" id="sunday" checked>
                                        <label class="onoffswitch-label" for="sunday">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </div>
                <?php echo form_close();?>
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
                    <th>Name</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                    <th>Sunday</th>
                    <th class="text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($workingWeeks as $data) { ?>
                    <tr>
                        <td><?php echo $data->name; ?></td>
                        <td><?php if($data->mon==1){ echo '<i class="fa fa-check text-success"></i>';}else {echo '<i class="fa fa-close text-danger"></i>';}?></td>
                        <td><?php if($data->tue==1){ echo '<i class="fa fa-check text-success"></i>';}else {echo '<i class="fa fa-close text-danger"></i>';}?></td>
                        <td><?php if($data->wed==1){ echo '<i class="fa fa-check text-success"></i>';}else {echo '<i class="fa fa-close text-danger"></i>';}?></td>
                        <td><?php if($data->thu==1){ echo '<i class="fa fa-check text-success"></i>';}else {echo '<i class="fa fa-close text-danger"></i>';}?></td>
                        <td><?php if($data->fri==1){ echo '<i class="fa fa-check text-success"></i>';}else {echo '<i class="fa fa-close text-danger"></i>';}?></td>
                        <td><?php if($data->sat==1){ echo '<i class="fa fa-check text-success"></i>';}else {echo '<i class="fa fa-close text-danger"></i>';}?></td>
                        <td><?php if($data->sun==1){ echo '<i class="fa fa-check text-success"></i>';}else {echo '<i class="fa fa-close text-danger"></i>';}?></td>
                        <td class="text-right">
                            <textarea id="edit_<?php echo $data->id;?>" style="display:none;">
                                <?php echo json_encode($data);?>
                            </textarea>
                            <div class="dropdown dropdown-action">
                                <a href="javascript:;" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item editWorkingWeekBtn" data-id="<?php echo $data->id;?>" href="javascript:;"><i class="fa fa-pencil m-r-5"></i> Edit</a>
<!--                                    <a class="dropdown-item" href="javascript:;" data-toggle="modal"-->
<!--                                       data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i> Delete</a>-->
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
