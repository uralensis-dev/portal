<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Departments <?php
                if (isset($hospital)) {
                    echo "of " . $hospital['description'];
                }
                ?></h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('department'); ?>">Departments</a></li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="#" class="btn add-btn" id="add-department-button"><i class="fa fa-plus"></i>Department</a>
        </div>
    </div>
</div>

<?php if ($group_type != "H" || $group_type != "HA") : ?>
    <div class="row mb-3">
        <div class="col-md-5">
            <div class="form-group">
                <label for="select-hospital">Select Hospital</label>
                <select class="form-control" id="select-hospital">
                    <?php
                    foreach ($hospitals as $h) :
                        $selected = "";
                        if (isset($hospital) && $hospital['id'] === $h['id']) {
                            $selected = "selected";
                        }
                        ?>
                        <option <?php echo $selected; ?> value="<?php echo $h['id']; ?>"><?php echo $h['description']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-7">
            <div class="form-group text-right">
                <button onclick="window.location.href = _base_url + 'department/admin'" class="btn btn-primary mt-4">Template Edit</button>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (isset($hospital)) : ?>

    <?php  foreach ($departments as $d_id => $department) : ?>
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
                                        <div class="col-md-10 collapse-button" style="width:50%" id="specialty-title-<?php echo $s_id; ?>" data-toggle="collapse" data-target="#category-<?php echo $s_id; ?>" aria-expanded="false" aria-controls="category-<?php echo $s_id; ?>">
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
                                            <span data-name="<?php echo $specialty['name'] ?>" data-did="<?php echo $d_id; ?>" data-id="<?php echo $s_id; ?>" class="edit-specialty mr-2">
                                                <i class="las la-pen"></i>
                                            </span>
                                            <span class="delete-specialty" data-did="<?php echo $d_id; ?>" data-id="<?php echo $s_id; ?>">
                                                <i class="las la-trash-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>


                                <div class="row collapse" id="category-<?php echo $s_id; ?>">
                                    <div class="col-md-12">
                                        
                                        <ul class="list-group ">
                                        
                                        <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mr-2"  id="category-text-<?php echo $c_id; ?>">
                                                               Category
                                                            </div>
                                                           
                                                        </div>
                                                        
                                                        <div class="col">
                                                            
                                                            <div  id="category-text-pa-<?php echo $c_id; ?>">
                                                                RCPath Points/PA
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col">
                                                            
                                            <div style="width:45%;"  id="category-text-pa-<?php echo $c_id; ?>">
                                                               Specimen Type
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col text-right">
  
      &nbsp;
                                                        </div>
                                                    </div>
                                                </li>
                                        
                                        
                                        
                                            <?php foreach ($specialty['categories'] as $c_id => $category) : ?>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mr-2"  id="category-text-<?php echo $c_id; ?>">
                                                                <?php echo $category['name'] ?>
                                                            </div>
                                                           
                                                        </div>
                                                        
                                                        <div class="col">
                                                            
                                                            <div  id="category-text-pa-<?php echo $c_id; ?>">
                                                                <?php echo $category['pa']; ?>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col">
                                                            
                                                            <div  float:right" id="category-text-pa-<?php echo $c_id; ?>">
                                                               <ul class="list-group">
<?php  foreach ($specialty['specimen_types'] as $st_id => $specimen_type) : ?>
<?php if($specimen_type['category_id']==$c_id) { ?>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col">
                                                            <span id="specimen-text-<?php echo $st_id; ?>">
                                                                <?php echo $specimen_type['name'] ?> 
                                                            </span>
                                                        </div>
                                                        <div class="col text-right">
                                                            <span data-name="<?php echo $specimen_type['name']; ?>" data-did="<?php echo $d_id; ?>" data-sid="<?php echo $s_id; ?>" data-id="<?php echo $st_id ?>" class="edit-specimen mr-2">
                                                                <i class="las la-pen"></i>
                                                            </span>
                                                            <span class="delete-specimen" data-did="<?php echo $d_id; ?>" data-sid="<?php echo $s_id; ?>" data-id="<?php echo $st_id ?>">
                                                                <i class="las la-trash-alt"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php } ?>
                                            <?php endforeach; ?>
                                        </ul>
                                                                
                                                                <button data-name="<?php echo $department['name'] ?>/<?php echo $specialty['name']; ?>/<?php echo $category['name'] ?>" data-did="<?php echo $d_id; ?>" data-cid="<?php echo $c_id; ?>" data-sid="<?php echo $s_id; ?>" class="add-specimen-button mt-4 btn btn-primary btn-sm"><i style="font-size: 12px;" class="fa fa-plus"></i></button>
                                                                
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col text-right">
  <span data-name="<?php echo $category['name']; ?>" data-did="<?php echo $d_id; ?>" data-sid="<?php echo $s_id; ?>" data-id="<?php echo $c_id ?>" data-pa="<?php echo $category['pa']; ?>" class="edit-category mr-2">
                                                                <i class="las la-pen"></i>
                                                            </span>
      <span class="delete-category" data-did="<?php echo $d_id; ?>" data-sid="<?php echo $s_id; ?>" data-id="<?php echo $c_id ?>">
                                                                <i class="las la-trash-alt"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                                
                                            <?php endforeach; ?>
                                        </ul>
                                        <button data-name="<?php echo $department['name'] ?>/<?php echo $specialty['name']; ?>" data-did="<?php echo $d_id; ?>" data-sid="<?php echo $s_id; ?>" class="add-category-button mt-4 btn btn-primary btn-sm"><i style="font-size: 12px;" class="fa fa-plus"></i> Category</button>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-md-5" style="display:none" >
                                        <h5 class="text-center mb-2" style="display:none">Specimen type</h5>
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
                                                            <span data-name="<?php echo $specimen_type['name']; ?>" data-did="<?php echo $d_id; ?>" data-sid="<?php echo $s_id; ?>" data-id="<?php echo $st_id ?>" class="edit-specimen mr-2">
                                                                <i class="las la-pen"></i>
                                                            </span>
                                                            <span class="delete-specimen" data-did="<?php echo $d_id; ?>" data-sid="<?php echo $s_id; ?>" data-id="<?php echo $st_id ?>">
                                                                <i class="las la-trash-alt"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <button style="display:none" data-name="<?php  echo $department['name'] ?>/<?php echo $specialty['name']; ?>" data-did="<?php echo $d_id; ?>" data-sid="<?php echo $s_id; ?>"  class="add-specimen-button mt-4 btn btn-primary btn-sm"><i style="font-size: 12px;" class="fa fa-plus"></i> Specimen Type</button>

                                        <h5 class="text-center mb-2" style="display:none">Lab Test Categories</h5>
                                        <ul class="list-group" style="display:none">
                                            <?php
                                            foreach ($specialty['test_categories'] as $cat) :
                                              //  $priceBasicResult = getLabTests($cat['id']);
                                                //$priceCodeResult = getCodeDetails($priceBasicResult["id"]);
                                                ?>
                                                <li class="list-group-item">

                                                    <div class="row" data-toggle="collapse" data-target="#showPricing_"<?php echo $cat['id']; ?>>
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
                                                    <?php if ($priceBasicResult > 0) { ?>  
<!--                                                        <div id="showPricing_"<?php echo $cat['id']; ?> class="collapse">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="card-body">

                                                                            <div class="table-responsive">
                                                                                <table class="table table-striped table-hover">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Departments</th>
                                                                                            <th>Specialty</th>
                                                                                            <th>Test Categories</th>
                                                                                            <th>Rate</th>
                                                                                            <th>Country</th>
                                                                                            <th class="d-none d-sm-table-cell">DESCRIPTION</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td><?php echo $priceBasicResult["department_name"]; ?></td>
                                                                                            <td><?php echo $priceBasicResult["speciality_name"]; ?></td>
                                                                                            <td><?php echo $priceBasicResult["test_category"]; ?></td>
                                                                                            <td><?php echo $priceBasicResult["rate"]; ?></td>
                                                                                            <td><?php echo $priceBasicResult["country"]; ?></td>
                                                                                            <td><?php echo $priceBasicResult["description"]; ?></td>

                                                                                        </tr>

                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                           <?php if(count($priceCodeResult) > 0) { ?> 
                                                                            <div class="invoice-info">
                                                                                <strong>Billing Codes</strong>

                                                                            </div>
                                                                            <div class="table-responsive">
                                                                                <table class="table table-striped table-hover">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>#</th>
                                                                                            <th>Code Type</th>
                                                                                            <th>Billing Code</th>
                                                                                            <th>Code Name</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php
                                                                                        $cnt = 0;
                                                                                        foreach ($priceCodeResult as $priceKey => $priceValue) {
                                                                                            $cnt++;
                                                                                            ?>

                                                                                            <tr>
                                                                                                <td><?php echo $cnt; ?></td>
                                                                                                <td><?php echo $priceValue["code_type"]; ?></td>
                                                                                                <td><?php echo $priceValue["billing_code"]; ?></td>
                                                                                                <td><?php echo $priceValue["billing_code_name"]; ?></td>
                                                                                            </tr>

                                                                                        <?php } ?>



                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            
                                                                           <?php }?>




                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>-->
                                                    <?php } ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <button data-name="<?php echo $department['name'] ?>/<?php echo $specialty['name']; ?>" data-sid="<?php echo $s_id; ?>" data-did="<?php echo $d_id; ?>" class="add-test-category-button mt-4 btn btn-primary btn-sm"><i style="font-size: 12px;" class="fa fa-plus"></i> Test Category</button>
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


    <div id="add-hospital-department" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Department</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="accordion" id="add-department-accordion">
                        <div class="card mb-0">
                            <div class="card-header collapsible-header" id="add-department-template-heading">
                                <h2 class="mb-0">
                                    <button class="accordion-button btn btn-link" type="button" data-toggle="collapse" data-target="#department-template-form" aria-expanded="true" aria-controls="department-template-form">
                                        From Template
                                    </button>
                                </h2>
                            </div>

                            <div id="department-template-form" class="collapse show" aria-labelledby="add-department-template-heading" data-parent="#add-department-accordion">
                                <div class="card-body">
                                    <?php $dep_ids = array_keys($template_departments); ?>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <ul class="list-group">
                                                <?php for ($i = 0; $i < count($dep_ids); $i += 2) : ?>
                                                    <?php $dep = $template_departments[$dep_ids[$i]]; ?>
                                                    <li class="list-group-item">
                                                        <div class="form-check">
                                                            <input class="form-check-input template-dep-input" type="checkbox" value="<?php echo $dep_ids[$i]; ?>" id="department-template-check-<?php echo $dep_ids[$i]; ?>">
                                                            <label class="form-check-label" for="department-template-check-<?php echo $dep_ids[$i]; ?>">
                                                                <?php echo $dep['name']; ?>
                                                            </label>
                                                        </div>
                                                    </li>
                                                <?php endfor; ?>
                                            </ul>
                                        </div>
                                        <div class="col">
                                            <?php for ($i = 1; $i < count($dep_ids); $i += 2) : ?>
                                                <?php $dep = $template_departments[$dep_ids[$i]]; ?>
                                                <li class="list-group-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input template-dep-input" type="checkbox" value="<?php echo $dep_ids[$i]; ?>" id="department-template-check-<?php echo $dep_ids[$i]; ?>">
                                                        <label class="form-check-label" for="department-template-check-<?php echo $dep_ids[$i]; ?>">
                                                            <?php echo $dep['name']; ?>
                                                        </label>
                                                    </div>
                                                </li>
                                            <?php endfor; ?>
                                        </div>
                                    </div>

                                    <div class="error-message" id="template-department-error-message">
                                        This is an error message
                                    </div>

                                    <div class="action-button text-right">
                                        <button id="template-dep-add-button" class="btn btn-primary">Add</button>
                                        <button data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header collapsible-header" id="add-department-custom-heading">
                                <h2 class="mb-0">
                                    <button class="btn accordion-button btn-link collapsed" type="button" data-toggle="collapse" data-target="#department-custom-form" aria-expanded="false" aria-controls="department-custom-form">
                                        Custom Department
                                    </button>
                                </h2>
                            </div>
                            <div id="department-custom-form" class="collapse" aria-labelledby="add-department-custom-heading" data-parent="#add-department-accordion">
                                <div class="card-body">
                                    <div class="form-group mb-2">
                                        <div class="row">
                                            <div class="col">
                                                <label for="field-add-division">Division</label>
                                                <select class="form-control" id="field-add-division"> 
                                                <option value="0">Division</option>
                                                <option value="1">Medicine Division</option>
                                                <option value="2">Surgery Division</option>
                                                <option value="3">Family Services Division</option>
                                                <option value="4">Clinical And Scientific Division</option>
                                                
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="field-add-name">Department Name</label>
                                                <input type="text" id="field-add-name" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="error-message" id="custom-department-error-message">
                                        This is an error message
                                    </div>
                                    <div class="action-button text-right">
                                        <button id="custom-dep-add-button" class="btn btn-primary">Add</button>
                                        <button data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="add-specialty-department" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Speciality</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="accordion" id="add-specialty-accordion">
                        <div class="card mb-0" id="specialty-template-form-container">
                            <div class="card-header collapsible-header" id="add-specialty-template-heading">
                                <h2 class="mb-0">
                                    <button class="accordion-button btn btn-link" type="button" data-toggle="collapse" data-target="#specialty-template-form" aria-expanded="true" aria-controls="specialty-template-form">
                                        From Template
                                    </button>
                                </h2>
                            </div>

                            <div id="specialty-template-form" class="collapse show" aria-labelledby="add-specialty-template-heading" data-parent="#add-specialty-accordion">
                                <div class="card-body">
                                    <?php foreach ($template_departments as $d_id => $dep) : ?>
                                        <div class="specialty-department-block" data-id="<?php echo $d_id; ?>" data-name="<?php echo $dep['name']; ?>" id="specialty-department-block-<?php echo $d_id; ?>">
                                            <h4 class="mb-3"><?php echo $dep['name']; ?></h4>
                                            <div class="row mb-2">
                                                <?php $specialties = $dep['specialties']; ?>
                                                <?php $sp_ids = array_keys($specialties); ?>
                                                <div class="col">
                                                    <ul class="list-group">
                                                        <?php for ($i = 0; $i < count($sp_ids); $i += 2) : ?>
                                                            <?php $spec = $specialties[$sp_ids[$i]]; ?>
                                                            <li class="list-group-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input template-spec-input" type="checkbox" value="<?php echo $sp_ids[$i]; ?>" id="specialty-template-check-<?php echo $sp_ids[$i]; ?>">
                                                                    <label class="form-check-label" for="department-template-check-<?php echo $sp_ids[$i]; ?>">
                                                                        <?php echo $spec['name']; ?>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        <?php endfor; ?>
                                                    </ul>
                                                </div>
                                                <div class="col">
                                                    <ul class="list-group">
                                                        <?php for ($i = 1; $i < count($sp_ids); $i += 2) : ?>
                                                            <?php $spec = $specialties[$sp_ids[$i]]; ?>
                                                            <li class="list-group-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input template-spec-input" type="checkbox" value="<?php echo $sp_ids[$i]; ?>" id="specialty-template-check-<?php echo $sp_ids[$i]; ?>">
                                                                    <label class="form-check-label" for="specialty-template-check-<?php echo $sp_ids[$i]; ?>">
                                                                        <?php echo $spec['name']; ?>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        <?php endfor; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                    <div class="error-message" id="template-specialty-error-message">
                                        This is an error message
                                    </div>

                                    <div class="action-button text-right">
                                        <button id="template-spec-add-button" class="btn btn-primary">Add</button>
                                        <button data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header collapsible-header" id="add-specialty-custom-heading">
                                <h2 class="mb-0">
                                    <button class="btn accordion-button btn-link collapsed" type="button" data-toggle="collapse" data-target="#specialty-custom-form" aria-expanded="false" aria-controls="specialty-custom-form">
                                        Custom Specialty
                                    </button>
                                </h2>
                            </div>
                            <div id="specialty-custom-form" class="collapse" aria-labelledby="add-specialty-custom-heading" data-parent="#add-specialty-accordion">
                                <div class="card-body">
                                    <div class="form-group mb-2">
                                        <div class="row">
                                            <div class="col">
                                                <label for="specialty-add-name">Specialty Name</label>
                                                <input type="text" id="specialty-add-name" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="error-message" id="custom-specialty-error-message">
                                        This is an error message
                                    </div>
                                    <div class="action-button text-right">
                                        <button id="custom-spec-add-button" class="btn btn-primary">Add</button>
                                        <button data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="add-specialty-category" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Category</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="accordion" id="add-category-accordion">
                        <div class="card mb-0" id="category-template-form-container">
                            <div class="card-header collapsible-header" id="add-category-template-heading">
                                <h2 class="mb-0">
                                    <button class="accordion-button btn btn-link" type="button" data-toggle="collapse" data-target="#category-template-form" aria-expanded="true" aria-controls="category-template-form">
                                        From Template
                                    </button>
                                </h2>
                            </div>

                            <div id="category-template-form" class="collapse show" aria-labelledby="add-category-template-heading" data-parent="#add-category-accordion">
                                <div class="card-body">
                                    <?php foreach ($template_departments as $d_id => $dep) : ?>
                                        <?php $specialties = $dep['specialties']; ?>
                                        <?php foreach ($specialties as $s_id => $specialty): ?>
                                            <?php $category = $specialty['categories']; ?>
                                            <div class="category-department-block" data-did="<?php echo $d_id; ?>" data-sid="<?php echo $s_id; ?>" data-name="<?php echo $dep['name']; ?>/<?php echo $specialty['name'] ?>" >
                                                <h4 class="mb-3"><?php echo $dep['name']; ?> / <?php echo $specialty['name']; ?></h4>
                                                <div class="row mb-2">
                                                    <?php $c_ids = array_keys($category); ?>
                                                    <div class="col">
                                                        <ul class="list-group">
                                                            <?php for ($i = 0; $i < count($c_ids); $i += 2) : ?>
                                                                <?php $cat = $category[$c_ids[$i]]; ?>
                                                                <li class="list-group-item">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input template-cat-input" type="checkbox" value="<?php echo $c_ids[$i]; ?>">
                                                                        <label class="form-check-label">
                                                                            <?php echo $cat['name']; ?>
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            <?php endfor; ?>
                                                        </ul>
                                                    </div>
                                                    <div class="col">
                                                        <ul class="list-group">
                                                            <?php for ($i = 1; $i < count($c_ids); $i += 2) : ?>
                                                                <?php $cat = $category[$c_ids[$i]]; ?>
                                                                <li class="list-group-item">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input template-cat-input" type="checkbox" value="<?php echo $c_ids[$i]; ?>">
                                                                        <label class="form-check-label">
                                                                            <?php echo $cat['name']; ?>
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            <?php endfor; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>

                                    <div class="error-message" id="template-category-error-message">
                                        This is an error message
                                    </div>

                                    <div class="action-button text-right">
                                        <button id="template-cat-add-button" class="btn btn-primary">Add</button>
                                        <button data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header collapsible-header" id="add-category-custom-heading">
                                <h2 class="mb-0">
                                    <button class="btn accordion-button btn-link collapsed" type="button" data-toggle="collapse" data-target="#category-custom-form" aria-expanded="false" aria-controls="category-custom-form">
                                        Custom Category
                                    </button>
                                </h2>
                            </div>
                            <div id="category-custom-form" class="collapse" aria-labelledby="add-category-custom-heading" data-parent="#add-category-accordion">
                                <div class="card-body">
                                    <div class="form-group mb-2">
                                        <div class="row">
                                            <div class="col">
                                                <label for="category-add-name">Category Name</label>
                                                <input type="text" id="category-add-name" class="form-control">
                                            </div>
                                            <div class="col">
                                                <label for="category-add-name">PA</label>
                                                <input type="number" min="0" step="1" id="category-pa-add-name" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="error-message" id="custom-category-error-message">
                                        This is an error message
                                    </div>
                                    <div class="action-button text-right">
                                        <button id="custom-cat-add-button" class="btn btn-primary">Add</button>
                                        <button data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="add-specialty-specimen" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Specimen Type</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="accordion" id="add-specimen-accordion">
                        <div class="card mb-0" id="specimen-template-form-container">
                            <div class="card-header collapsible-header" id="add-category-template-heading">
                                <h2 class="mb-0">
                                    <button class="accordion-button btn btn-link" type="button" data-toggle="collapse" data-target="#specimen-template-form" aria-expanded="true" aria-controls="specimen-template-form">
                                        From Template
                                    </button>
                                </h2>
                            </div>

                            <div id="specimen-template-form" class="collapse show" aria-labelledby="add-specimen-template-heading" data-parent="#add-specimen-accordion">
                                <div class="card-body">
                                    <?php foreach ($template_departments as $d_id => $dep) : ?>
                                        <?php $specialties = $dep['specialties']; ?>
                                        <?php foreach ($specialties as $s_id => $specialty): ?>
                                            <?php $specimen = $specialty['specimen_types']; ?>
                                            <div class="specimen-department-block" data-did="<?php echo $d_id; ?>" data-sid="<?php echo $s_id; ?>" data-name="<?php echo $dep['name']; ?>/<?php echo $specialty['name'] ?>" >
                                                <h4 class="mb-3"><?php echo $dep['name']; ?> / <?php echo $specialty['name']; ?></h4>
                                                <div class="row mb-2">
                                                    <?php $c_ids = array_keys($specimen); ?>
                                                    <div class="col">
                                                        <ul class="list-group">
                                                            <?php for ($i = 0; $i < count($c_ids); $i += 2) : ?>
                                                                <?php $cat = $specimen[$c_ids[$i]]; ?>
                                                                <li class="list-group-item">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input template-sp-input" type="checkbox" value="<?php echo $c_ids[$i]; ?>">
                                                                        <label class="form-check-label">
                                                                            <?php $cat_pa = (isset($cat['pa']) ? $cat['pa'] : ''); ?>
                                                                            <?php echo $cat['name'] . ' (' . $cat_pa . ')'; ?>
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            <?php endfor; ?>
                                                        </ul>
                                                    </div>
                                                    <div class="col">
                                                        <ul class="list-group">
                                                            <?php for ($i = 1; $i < count($c_ids); $i += 2) : ?>
                                                                <?php $cat = $specimen[$c_ids[$i]]; ?>
                                                                <li class="list-group-item">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input template-sp-input" type="checkbox" value="<?php echo $c_ids[$i]; ?>">
                                                                        <label class="form-check-label">
                                                                            <?php $cat_pa = (isset($cat['pa']) ? $cat['pa'] : ''); ?>
                                                                            <?php echo $cat['name'] . ' (' . $cat_pa . ')'; ?>
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            <?php endfor; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>

                                    <div class="error-message" id="template-specimen-error-message">
                                        This is an error message
                                    </div>

                                    <div class="action-button text-right">
                                        <button id="template-sp-add-button" class="btn btn-primary">Add</button>
                                        <button data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header collapsible-header" id="add-specimen-custom-heading">
                                <h2 class="mb-0">
                                    <button class="btn accordion-button btn-link collapsed" type="button" data-toggle="collapse" data-target="#specimen-custom-form" aria-expanded="false" aria-controls="specimen-custom-form">Custom Specimen Type</button>
                                </h2>
                            </div>
                            <div id="specimen-custom-form" class="collapse" aria-labelledby="add-specimen-custom-heading" data-parent="#add-specimen-accordion">
                                <div class="card-body">
                                    <div class="form-group mb-2">
                                        <div class="row">
                                            <div class="col">
                                                <label for="specimen-add-name">Specimen Type Name</label>
                                                <input type="text" id="specimen-add-name" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="error-message" id="custom-specimen-error-message">
                                        This is an error message
                                    </div>
                                    <div class="action-button text-right">
                                        <button id="custom-sp-add-button" class="btn btn-primary">Add</button>
                                        <button data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="add-specialty-test-category" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Test Category</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="accordion" id="add-test-category-accordion">
                        <div class="card mb-0" id="test-category-template-form-container">
                            <div class="card-header collapsible-header" id="add-category-template-heading">
                                <h2 class="mb-0">
                                    <button class="accordion-button btn btn-link" type="button" data-toggle="collapse" data-target="#test-category-template-form" aria-expanded="true" aria-controls="test-category-template-form">
                                        From Template
                                    </button>
                                </h2>
                            </div>

                            <div id="test-category-template-form" class="collapse show" aria-labelledby="add-test-category-template-heading" data-parent="#add-test-category-accordion">
                                <div class="card-body">
                                    <?php foreach ($template_departments as $d_id => $dep) : ?>
                                        <?php $specialties = $dep['specialties']; ?>
                                        <?php foreach ($specialties as $s_id => $specialty): ?>
                                            <?php $test_category = $specialty['test_categories']; ?>
                                            <div class="test-category-department-block" data-did="<?php echo $d_id; ?>" data-sid="<?php echo $s_id; ?>" data-name="<?php echo $dep['name']; ?>/<?php echo $specialty['name'] ?>" >
                                                <h4 class="mb-3"><?php echo $dep['name']; ?> / <?php echo $specialty['name']; ?></h4>
                                                <div class="row mb-2">
                                                    <?php
                                                    $c_ids = array();
                                                    foreach ($test_category as $tc) {
                                                        array_push($c_ids, $tc['id']);
                                                    }
                                                    ?>
                                                    <div class="col">
                                                        <ul class="list-group">
                                                            <?php for ($i = 0; $i < count($c_ids); $i += 2) : ?>
                                                                <?php $cat = $test_category[$i]; ?>
                                                                <li class="list-group-item">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input template-tc-input" type="checkbox" value="<?php echo $c_ids[$i]; ?>">
                                                                        <label class="form-check-label">
                                                                            <?php echo $cat['name']; ?>
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            <?php endfor; ?>
                                                        </ul>
                                                    </div>
                                                    <div class="col">
                                                        <ul class="list-group">
                                                            <?php for ($i = 1; $i < count($c_ids); $i += 2) : ?>
                                                                <?php $cat = $test_category[$i]; ?>
                                                                <li class="list-group-item">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input template-sp-input" type="checkbox" value="<?php echo $c_ids[$i]; ?>">
                                                                        <label class="form-check-label">
                                                                            <?php echo $cat['name']; ?>
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            <?php endfor; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>

                                    <div class="error-message" id="template-test-category-error-message">
                                        This is an error message
                                    </div>

                                    <div class="action-button text-right">
                                        <button id="template-tc-add-button" class="btn btn-primary">Add</button>
                                        <button data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header collapsible-header" id="add-test-category-custom-heading">
                                <h2 class="mb-0">
                                    <button class="btn accordion-button btn-link collapsed" type="button" data-toggle="collapse" data-target="#test-category-custom-form" aria-expanded="false" aria-controls="test-category-custom-form">
                                        Custom Test Category
                                    </button>
                                </h2>
                            </div>
                            <div id="test-category-custom-form" class="collapse" aria-labelledby="add-test-category-custom-heading" data-parent="#add-test-category-accordion">
                                <div class="card-body">
                                    <div class="form-group mb-2">
                                        <div class="row">
                                            <div class="col">
                                                <label for="test-category-add-name">Test Category</label>
                                                <input type="text" id="test-category-add-name" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="error-message" id="custom-test-category-error-message">
                                        This is an error message
                                    </div>
                                    <div class="action-button text-right">
                                        <button id="custom-tc-add-button" class="btn btn-primary">Add</button>
                                        <button data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div id="edit-department" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Department</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <div class="row">
                            <div class="col">
                                <label for="edit-department-name">Department Name</label>
                                <input type="text" id="edit-department-name" class="form-control">
                                <div class="invalid-feedback">
                                </div>
                                <input type="hidden" id="d-department-id">
                            </div>
                        </div>
                    </div>
                    <div class="action-button text-right">
                        <button id="department-save-button" class="btn btn-primary">Save</button>
                        <button data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="edit-category" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Category</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <div class="row">
                            <div class="col">
                                <label for="edit-category-name">Category Name</label>
                                <input type="text" id="edit-category-name" class="form-control">
                                <div class="invalid-feedback">
                                </div>
                                <input type="hidden" id="c-department-id">
                                <input type="hidden" id="c-specialty-id">
                                <input type="hidden" id="c-category-id">
                            </div>
                            <div class="col">
                                <label for="edit-category-pa">PA</label>
                                <input type="number" min="0" step="1"id="edit-category-pa" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="action-button text-right">
                        <button id="category-save-button" class="btn btn-primary">Save</button>
                        <button data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div id="edit-specimen" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Specimen Type</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <div class="row">
                            <div class="col">
                                <label for="edit-specimen-name">Specimen Type</label>
                                <input type="text" id="edit-specimen-name" class="form-control">
                                <div class="invalid-feedback">
                                </div>
                                <input type="hidden" id="s-department-id">
                                <input type="hidden" id="s-specialty-id">
                                <input type="hidden" id="s-specimen-id">
                            </div>
                        </div>
                    </div>
                    <div class="action-button text-right">
                        <button id="specimen-save-button" class="btn btn-primary">Save</button>
                        <button data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="edit-specialty" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Specialty</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <div class="row">
                            <div class="col">
                                <label for="edit-specialty-name">Specialty Name</label>
                                <input type="text" id="edit-specialty-name" class="form-control">
                                <div class="invalid-feedback">
                                </div>
                                <input type="hidden" id="sp-department-id">
                                <input type="hidden" id="sp-specialty-id">
                            </div>
                        </div>
                    </div>
                    <div class="action-button text-right">
                        <button id="specialty-save-button" class="btn btn-primary">Save</button>
                        <button data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="delete-field-modal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Confirm Delete</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="action-button text-center">
                        <input type="hidden" id="delete-department-id">
                        <input type="hidden" id="delete-type">
                        <input type="hidden" id="delete-specialty-id">
                        <input type="hidden" id="delete-category-id">
                        <input type="hidden" id="delete-specimen-id">
                        <p class="error-message" id="delete-error-message"></p>
                        <button id="delete-field-button" class="btn btn-danger">Delete</button>
                        <button data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>





<?php endif; ?>


<script>
    var hospital_id = "<?php echo isset($hospital) ? $hospital['id'] : ""; ?>";
</script>