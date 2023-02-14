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
                            <input required name="pa" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Code or Prefix</label>
                            <input required name="code" class="form-control" type="text">
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
                <?php echo  form_hidden('action', 'edit_specialty'); ?>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Specialty</label>
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
<!-- Delete Project Modal -->
<div class="modal custom-modal fade" id="delete_specialty" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Project</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <input type="hidden" name="id"/>
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0)" onclick="deleteSpecialty()" class="btn btn-primary continue-btn">Delete</a>
                        </div>
                        <div class="col-6">
                            <a data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function deleteSpecialty(e) {
    console.log($('#delete_specialty [name="id"]').val());
}

function confirmDeleteSpecialty(id) {
    $('#delete_specialty [name="id"]').val(id);
    $('#delete_specialty').modal('show');
}

function editSpecialty(id) {
    fetch('<?php echo  site_url();?>/admin/specialty/' + id)
        .then(function(res) {
            return res.json();
        })
        .then(function(data) {
            $('#edit_specialty [name="specialty"]').val(data.specialty);
            $('#edit_specialty [name="pa"]').val(data.pa);
            $('#edit_specialty').modal('show');
        });
}
</script>