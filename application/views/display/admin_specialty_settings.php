<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Specialties</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Settings</a></li>
                <li class="breadcrumb-item active">Specialties</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <!--            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#create_project"><i class="fa fa-plus"></i> Create Project</a>-->
            <div class="view-icons">
                <!--                <a href="projects.html" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>-->
                <!--                <a href="project-list.html" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a>-->
            </div>
        </div>
    </div>
</div>
<!-- /Page Header -->
<div class="row">
    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-3">
        <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_specialty"><i class="fa fa-plus"></i> Add Specialty</a>
        <div class="roles-menu">
            <ul>
                <?php foreach ($specialties as $specialty): ?>
                    <li class="">
                        <a href="javascript:void(0);"><?php echo  $specialty->specialty; ?>
                            <span class="role-action">
                            <span class="action-circle large edit-specialty" onclick="editSpecialty(<?php echo  $specialty->id; ?>)" data-specialty-id="" data-target="#edit_specialty">
                                <i class="material-icons">edit</i>
                            </span>
                            <span class="action-circle large delete-btn" onclick="confirmDeleteSpecialty(<?php echo  $specialty->id; ?>)">
                                <i class="material-icons">delete</i>
                            </span>
                        </span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-9">
        <!-- Search Filter -->
        <div class="row filter-row">
            <div class="col-sm-4 col-md-4">
                <div class="form-group form-focus">
                    <input name="code" type="text" class="form-control floating">
                    <label class="focus-label">Code or Prefix</label>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="form-group form-focus select-focus">
                    <select name="specialty_id" class="select floating">
                        <?php foreach ($specialties as $specialty): ?>
                            <option value="<?php echo  $specialty->id; ?>"><?php echo  $specialty->specialty; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label class="focus-label">Specialty</label>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <button class="btn btn-success btn-block"><i class="fa fa-plus"></i> Add Code</button>
            </div>
        </div>
        <!-- /Search Filter -->
        <hr/>
        <div class="table-responsive">
            <table id="specialty_codes_datatable" class="table table-striped">
                <thead>
                <th>Specialty</th>
                <th>Desc</th>
                <th>Code</th>
                <th class="text-right">Actions</th>
                </thead>
                <tbody>
                <?php foreach ($specialtyCodes as $code): ?>
                    <tr>
                        <td><?php echo  $code->specialty; ?></td>
                        <td><?php echo  $code->usmdcode_code_desc; ?></td>
                        <td><?php echo  $code->code; ?></td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action show">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-40px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <!--                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_employee"><i class="fa fa-pencil m-r-5"></i> Edit</a>-->
                                    <a class="dropdown-item" href="#" onclick="confirmDeleteSpecialtyCode(<?php echo  $specialty->id; ?>, '<?php echo  $code->code; ?>')"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /Page Content -->
<!-- Create Specialty Modal -->
<div id="add_specialty" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Specialty</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo  form_open(site_url('/admin/specialties')); ?>
                <?php echo  form_hidden('action', 'create_specialty'); ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Specialty</label>
                            <input required name="specialty" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>PA</label>
                            <input value="0" name="pa" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Code or Prefix</label>
                            <input name="code" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <div class="submit-section">
                    <button class="btn btn-primary submit-btn">Submit</button>
                </div>
                <?php echo  form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- /Create Specialty Modal -->
<!-- Edit Specialty Modal -->
<div id="edit_specialty" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Specialty</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo  form_open(site_url('/admin/specialties')); ?>
                <?php echo  form_hidden('action', 'update_specialty'); ?>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Specialty</label>
                            <input name="id" class="form-control" type="hidden">
                            <input name="specialty" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>PA</label>
                            <input name="pa" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <div class="submit-section">
                    <button class="btn btn-primary submit-btn">Submit</button>
                </div>
                <?php echo  form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Specialty Modal -->
<!-- Delete Specialty Modal -->
<div class="modal custom-modal fade" id="delete_specialty" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Specialty</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <input type="hidden" name="id"/>
                    <?php echo  form_open(site_url('/admin/specialties')); ?>
                    <?php echo  form_hidden('action', 'delete_specialty'); ?>
                    <input type="hidden" name="id"/>
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary continue-btn w-100">Delete</button>
                        </div>
                        <div class="col-6">
                            <a data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                    <?php echo  form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Delete Specialty Code Modal -->
<div class="modal custom-modal fade" id="delete_specialty_code" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete T Code</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <input type="hidden" name="id"/>
                    <?php echo  form_open(site_url('/admin/specialties')); ?>
                    <?php echo  form_hidden('action', 'delete_specialty_code'); ?>
                    <input type="hidden" name="id"/>
                    <input type="hidden" name="code"/>
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary continue-btn w-100">Delete</button>
                        </div>
                        <div class="col-6">
                            <a data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                    <?php echo  form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function confirmDeleteSpecialty(id) {
    $('#delete_specialty input[name="id"]').val(id);
    $('#delete_specialty').modal('show');
}

function confirmDeleteSpecialtyCode(id, code) {
    $('#delete_specialty_code input[name="id"]').val(id);
    $('#delete_specialty_code input[name="code"]').val(code);
    $('#delete_specialty_code').modal('show');
}

function editSpecialty(id) {
    $.getJSON('<?php echo  site_url('/admin/specialty/');?>' + id)
        .then(function(data) {
            $('#edit_specialty input[name="id"]').val(data.id);
            $('#edit_specialty input[name="specialty"]').val(data.specialty);
            $('#edit_specialty input[name="pa"]').val(data.pa);
            $('#edit_specialty').modal('show');
        });
}
</script>