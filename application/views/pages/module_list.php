<!-- Page Content -->

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Module</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Settings</a></li>
                <li class="breadcrumb-item active">Module</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="javascript:;" class="btn add-btn" data-toggle="modal"
               data-target="#add_module_modal"><i class="fa fa-plus"></i> Add Module</a>
        </div>
    </div>
</div>
<!-- /Page Header -->
<input type="hidden" value="<?php echo base_url()?>" id="base_url">
<!-- Add Leave Modal -->
<div id="add_module_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 800px;max-width: 800px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Module</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $attributes = array('id'=>'addModuleManagementForm');
                echo form_open('',$attributes);
                ?>
                    <div class="col-md-12">
                        <input class="form-control" type="hidden" id="form_status" name="form_status">
                        <input class="form-control" type="hidden" id="edit_id" name="edit_id">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Name<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="name" name="name">
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
            <table id="admin_users_datatable" class="table table-striped custom-table mb-0 simpletable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th class="text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($moduleData as $module) { ?>
                    <tr>
                        <td><?php echo $module->name; ?></td>
                        <td class="text-right">
                            <textarea id="edit_<?php echo $module->id;?>" style="display:none;">
                                <?php echo json_encode($module);?>
                            </textarea>
                            <div class="dropdown dropdown-action">
                                <a href="javascript:;" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item editBtnModule" data-id="<?php echo $module->id;?>" href="javascript:;"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item btn-delete-module" href="javascript:;" data-toggle="modal" data-id="<?php echo $module->id;?>"
                                       data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

<!-- Delete Leave Modal -->
<div class="modal custom-modal fade" id="delete_approve" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Module</h3>
                    <p>Are you sure want to delete this Module?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary continue-btn continue-btn-module" data-id="">Delete</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Leave Modal -->
