<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- Styles for this page is located in assets/css/department/style.css -->
<!-- Script for this page is located in assets/js/department/admin.js -->

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Departments Template</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('department'); ?>">Departments</a></li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="#" class="btn add-btn add-department-button"><i class="fa fa-plus"></i>Department</a>
        </div>
    </div>
</div>


<?php foreach ($departments as $d_id => $department) : ?>
    <div class="card department-card">
        <div class="card-body">
            <div class="department-title mb-2">
                <div class="row">
                    <div class="col-md-10 collapse-button" id="department-title-<?php echo $d_id; ?>" data-toggle="collapse" data-target="#specialties-<?php echo $d_id; ?>" aria-expanded="false" aria-controls="specialties-<?php echo $d_id; ?>">
                        <h4>
                            <span class="arrow-down mr-2">
                                <i class="fa fa-caret-right"></i>
                            </span>
                            <span id="department-text-<?php echo $d_id; ?>">
                                <?php echo $department["name"]; ?>
                            </span>
                        </h4>
                    </div>
                    <div class="col text-right">
                        <span class="edit-department mr-2" data-name="<?php echo $department['name']; ?>" data-id="<?php echo $d_id; ?>">
                            <i class="las la-pen"></i>
                        </span>
                        <span class="delete-department" data-id="<?php echo $d_id; ?>">
                            <i class="las la-trash-alt"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="department-specialties collapse" data-id="<?php echo $d_id; ?>" id="specialties-<?php echo $d_id; ?>">
                <?php foreach ($department["specialties"] as $s_id => $specialty) : ?>
                    <div class="card mb-1 speciality-card">
                        <div class="card-body">
                            <div class="specialty-title mb-2" data-toggle="collapse">
                                <div class="row">
                                    <div class="col-md-10 collapse-button" id="specialty-title-<?php echo $s_id; ?>" data-toggle="collapse" data-target="#category-<?php echo $s_id; ?>" aria-expanded="false" aria-controls="category-<?php echo $s_id; ?>">
                                        <h4>
                                            <span class="arrow-down mr-2">
                                                <i class="fa fa-caret-right"></i>
                                            </span>
                                            <span id="speciality-text-<?php echo $s_id; ?>">
                                                <?php echo $specialty["name"]; ?>
                                            </span>
                                        </h4>
                                    </div>
                                    <div class="col text-right">
                                        <span data-name="<?php echo $specialty['name'] ?>" data-id="<?php echo $s_id; ?>" class="edit-specialty mr-2">
                                            <i class="las la-pen"></i>
                                        </span>
                                        <span class="delete-specialty" data-id="<?php echo $s_id; ?>">
                                            <i class="las la-trash-alt"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="row collapse" id="category-<?php echo $s_id; ?>">
                                <div class="col">
                                    <h5 class="text-center mb-2">Categories</h5>
                                    <ul class="list-group">
                                        <?php foreach ($specialty['categories'] as $c_id => $category) : ?>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col">
                                                        <span class="mr-2" id="category-text-<?php echo $c_id; ?>">
                                                            <?php echo $category['name'] ?>
                                                        </span>
                                                        <span id="category-text-pa-<?php echo $c_id; ?>">
                                                            (<?php echo $category['pa']; ?>)
                                                        </span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <span data-name="<?php echo $category['name']; ?>" data-id="<?php echo $c_id ?>" data-pa="<?php echo $category['pa']; ?>" class="edit-category mr-2">
                                                            <i class="las la-pen"></i>
                                                        </span>
                                                        <span class="delete-category" data-id="<?php echo $c_id ?>">
                                                            <i class="las la-trash-alt"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <button data-name="<?php echo $specialty['name']; ?>" data-id="<?php echo $s_id; ?>" class="add-category-button mt-4 btn btn-primary btn-sm"><i style="font-size: 12px;" class="fa fa-plus"></i> Category</button>
                                </div>
                                <div class="col">
                                    <h5 class="text-center mb-2">Specimen type</h5>
                                    <ul class="list-group">
                                        <?php foreach ($specialty['specimen_types'] as $st_id => $specimen_type) : ?>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col">
                                                        <span id="specimen-text-<?php echo $st_id; ?>">
                                                            <?php echo $specimen_type['name'] ?>
                                                        </span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <span data-name="<?php echo $specimen_type['name']; ?>" data-id="<?php echo $st_id ?>" class="edit-specimen mr-2">
                                                            <i class="las la-pen"></i>
                                                        </span>
                                                        <span class="delete-specimen" data-id="<?php echo $st_id ?>">
                                                            <i class="las la-trash-alt"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <button data-name="<?php echo $specialty['name']; ?>" data-id="<?php echo $s_id; ?>" class="add-specimen-button mt-4 btn btn-primary btn-sm"><i style="font-size: 12px;" class="fa fa-plus"></i> Specimen Type</button>
                                    
                                    <h5 class="text-center mb-2">Lab Test Categories</h5>
                                    <ul class="list-group">
                                        <?php foreach ($specialty['test_categories'] as $cat) : ?>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col">
                                                        <span id="test-category-text-<?php echo $cat['id']; ?>">
                                                            <?php echo $cat['name'] ?>
                                                        </span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <span data-name="<?php echo $cat['name']; ?>" data-id="<?php echo $cat['id'] ?>" class="edit-test-category mr-2">
                                                            <i class="las la-pen"></i>
                                                        </span>
                                                        <span class="delete-test-category" data-id="<?php echo $cat['id'] ?>">
                                                            <i class="las la-trash-alt"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <button  data-name="<?php echo $specialty['name']; ?>" data-id="<?php echo $s_id; ?>" class="add-test-category-button mt-4 btn btn-primary btn-sm"><i style="font-size: 12px;" class="fa fa-plus"></i> Test Category</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div id="add-specialty-button-container" class="mt-4 mb-1 text-right">
                    <button class="add-specialty-button btn btn-primary" data-name="<?php echo $department['name']; ?>" data-id="<?php echo $d_id; ?>"><i class="fa fa-plus"></i> Specialty</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>



<div id="edit-field" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit field</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-2">
                    <div class="row">
                        <div class="col">
                            <input type="text" id="field-name" class="form-control">
                            <div class="invalid-feedback">
                            </div>
                            <input type="hidden" id="field-id">
                            <input type="hidden" id="field-type">
                        </div>
                        <div class="col" style="display: none;" id="field-pa-container">
                            <input type="number" min="0" step="1" id="field-pa" class="form-control" value="0">
                        </div>
                    </div>
                </div>
                <div class="action-button text-right">
                    <button id="field-save-button" class="btn btn-primary">Save</button>
                    <button data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="add-field" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add field</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-2">
                    <div class="row">
                        <div class="col">
                            <input type="text" id="field-add-name" class="form-control">
                            <div class="invalid-feedback">
                            </div>
                            <input type="hidden" id="field-add-id">
                            <input type="hidden" id="field-add-type">
                        </div>
                        <div class="col" style="display: none;" id="field-pa-add-container">
                            <input type="number" min="0" step="1" id="field-add-pa" class="form-control" value="0">
                        </div>
                    </div>
                </div>
                <div class="action-button text-right">
                    <button id="field-add-button" class="btn btn-primary">Add</button>
                    <button data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="add-test-category" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Test Category</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(base_url('department/add_test_category')); ?>
                <div class="form-group mb-2">
                    <div class="row">
                        <div class="col">
                            <input type="text" name="name" id="test-category-name" class="form-control">
                            <div class="invalid-feedback">
                            </div>
                            <input type="hidden" name="id" id="test-category-specialty-id">
                        </div>
                    </div>
                </div>
                <div class="action-button text-right">
                    <button id="test-category-add-button" class="btn btn-primary">Add</button>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancel</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>


<div id="delete-field" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Confirm Delete?</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="field-delete-id">
                <input type="hidden" id="field-delete-type">
                <p class="text-danger text-center">This will delete all the subcategories of this field</p>
                <p class="text-danger text-center" id="delete-error-message"></p>
                <div class="action-button mt-3 text-center">
                    <button id="field-delete-button" class="btn btn-danger">Delete</button>
                    <button data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>