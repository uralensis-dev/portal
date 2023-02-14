<style type="text/css">
    .radio_div {
        margin-top: 10px;
    }
    .radio_div label{
        padding: 0px 10px;
    }
</style>
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">SNOMED Codes for <?php echo getGroupNameById($group_id); ?></h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Settings</a></li>
                <li class="breadcrumb-item active">SNOMED Codes</li>
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
        <!--        <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_specialty"><i class="fa fa-plus"></i> Add Specialty</a>-->
        <p>Department: <?php echo $categories['department']; ?>  Specialty: <?php echo $categories['specialty']; ?></p>
        <div class="roles-menu">
            <ul id="categories_list">
                <li data-cat-id="0">
                    <a href="javascript:void(0);" data-cat-id="0" data-subcat-id="0" onclick="setSnomedCodes(this,'0')" style="background-color: #eee; border-color: #00c5fb;">
                        <i class="fa fa-list-alt"></i> <?php echo $categories['department']." => ".$categories['specialty']; ?>
                    </a>
                </li>
                <?php foreach ($categories['categories'] as $key_category=>$val_category){ ?>
                    <li class="" >
                        <a href="javascript:void(0);" data-cat-id="<?php echo $key_category; ?>" data-subcat-id="0" onclick="setSnomedCodes(this,'0')" ><?php echo  $val_category['name']; ?>
                            <span class="role-action">
                            <span class="action-circle large edit-specialty" onclick="editSpecialty(<?php echo $key_category; ?>)" data-specialty-id="" data-target="#edit_specialty">
                                <i class="material-icons">edit</i>
                            </span>
                        </span>
                        </a>
                        <?php if($val_category['sub_categories']){ ?>
                            <ul>
                                <?php foreach ($val_category['sub_categories'] as $k_sub_cat=>$v_sub_cat){ ?>
                                <li class="" >
                                    <a href="javascript:void(0);" data-cat-id="<?php echo $key_category; ?>" data-subcat-id="<?php echo $k_sub_cat; ?>" onclick="setSnomedCodes(this,'1')"><?php echo $v_sub_cat['name']; ?>
                                        <span class="role-action">
                                            <span class="action-circle large edit-specialty" onclick="editSpecialty(<?php echo $k_sub_cat; ?>)" data-specialty-id="" data-target="#edit_specialty">
                                                <i class="material-icons">edit</i>
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-9">
        <?php $attributes = array('id'=>'add_codes_form'); ?>
        <?php echo form_open("",$attributes); ?>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
        <input type="hidden" name="hid_dept_id"  id="hid_dept_id" value="<?php echo $categories['department_id']; ?>">
        <input type="hidden" name="hid_specialty_id"  id="hid_specialty_id" value="<?php echo $categories['specialty_id']; ?>">
        <input type="hidden" name="hid_cat_id"  id="hid_cat_id" value="">
        <input type="hidden" name="hid_sub_cat_id"  id="hid_sub_cat_id" value="">
        <input type="hidden" name="hid_is_sub_cat"  id="hid_is_sub_cat" value="">
        <!-- Search Filter -->
        <div class="row filter-row">
            <div class="col-sm-3 col-md-3">
                <div class="form-group form-focus">
                    <input name="code" id="id_code" type="text" class="form-control" disabled >
                    <label class="focus-label">Code </label>
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="form-group form-focus radio_div" >
                    <div class="radio">
                        <label><input type="radio" name="schedule_type" class="schedule_type" value='weekly' checked disabled> Weekly</label>
                        <label><input type="radio" name="schedule_type" class="schedule_type" value='days' disabled> Days</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3" id="weekly_option">
                <div class="form-group form-focus">
                    <select name="week_name" class="select floating" id="week_name" disabled>
                        <option value="sunday">Sunday</option>
                        <option value="monday">Monday</option>
                        <option value="tuesday">Tuesday</option>
                        <option value="wednesday">Wednesday</option>
                        <option value="thursday">Thursday</option>
                        <option value="friday">Friday</option>
                        <option value="saturday">Saturday</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3 col-md-3" id="day_option" style="display: none;">
                <div class="form-group form-focus">
                    <input name="days_count" id="days" type="text" class="form-control numberonly" disabled />
                    <label class="focus-label">Days </label>
                </div>
            </div>
<!--            <div class="col-sm-4 col-md-4">-->
<!--                <div class="form-group form-focus select-focus">-->
<!--                    <select name="specialty_id" class="select floating">-->
<!--                        --><?php //foreach ($specialties as $specialty): ?>
<!--                            <option value="--><?php //echo  $specialty->id; ?><!--">--><?php //echo  $specialty->specialty; ?><!--</option>-->
<!--                        --><?php //endforeach; ?>
<!--                    </select>-->
<!--                    <label class="focus-label">Specialty</label>-->
<!--                </div>-->
<!--            </div>-->
            <div class="col-sm-3 col-md-3">
                <button class="btn btn-success btn-block" id="btn_add_code" disabled><i class="fa fa-plus"></i> Add Code</button>
            </div>
        </div>
        <!-- /Search Filter -->
        <?php echo form_close(); ?>
        <hr/>
        <div class="table-responsive">
            <table id="specialty_codes_datatable" class="table table-striped">
                <thead>
                <th>Category</th>
                <th>Code</th>
                <th>Report Schedule</th>
                <th class="text-right">Actions</th>
                </thead>
                <tbody>
                <?php foreach ($specialtyCodes as $code){                    
                    ?>
                    <tr class="code_row" data-lscatall="0" data-lscat-id="<?php echo $code['category_id']; ?>" data-lssubcat-id="<?php echo ($code['sub_category_id']==''?0:$code['sub_category_id']); ?>">
                        <td><?php echo $code['category_name']; ?></td>
                        <td><?php echo $code['snomed_code_desc']; ?></td>
                        <td><?php echo ucwords($code['schedule_title']); ?></td>
                        <td class="text-right">
                            <a  href="javascript:edit_code(<?= $code['snomed_code_id'] ?>, <?= $code['category_id'] ?>)"><i class="fa fa-pencil m-r-5 fa-2x"></i></a>
                            <a  href="#" onclick="confirmDeleteSpecialtyCode('<?= $code['snomed_code_id']; ?>', '<?= $code['snomed_code']; ?>')"><i class="fa-2x fa fa-trash-o m-r-5"></i></a>
                            <!-- <div class="dropdown dropdown-action show">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-40px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_employee"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="#" onclick="confirmDeleteSpecialtyCode('<?= $code['snomed_code_id']; ?>', '<?= $code['snomed_code']; ?>')"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div> -->
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /Page Content -->
<div id="edit_code" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id='edit_code_frm'>
                
                    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>"
                       value="<?= $this->security->get_csrf_hash(); ?>">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Code</label>
                                <input required name="code" class="form-control" type="text" id='code'>
                            </div>
                            <div class="form-group form-focus radio_div">
                                <div class="radio">
                                    <label><input type="radio" name="edit_schedule_type" class="schedule_type" value="weekly" id='weekly'> Weekly</label>
                                    <label><input type="radio" name="edit_schedule_type" class="schedule_type" value="days" id='edit_days'> Days</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class='input_day' id='edit_day_option' style="display: none;">
                                    <label>Days</label>
                                    <input type="number" name="edit_days"  class='form-control' id='no_of_days'>
                                </div>
                                <div class='select_day' id="edit_weekly_option">
                                    <select name="week_name" class="form-control" id='select_day'>
                                        <option value="sunday" data-select2-id="2">Sunday</option>
                                        <option value="monday" data-select2-id="8">Monday</option>
                                        <option value="tuesday" data-select2-id="9">Tuesday</option>
                                        <option value="wednesday" data-select2-id="10">Wednesday</option>
                                        <option value="thursday" data-select2-id="11">Thursday</option>
                                        <option value="friday" data-select2-id="12">Friday</option>
                                        <option value="saturday" data-select2-id="13">Saturday</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="snomed_code_id" value="0" class="snomed_code_id" />
                                <input type="hidden" name="category_id" value="0" class="category_id" />
                                <input type="submit" name="submit" value="Save" class="btn btn-primary" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
                    <?php 
                    $attributes = array('id' => 'delete_code_record_frm');
                    echo  form_open(site_url('/department/specialties'), $attributes); ?>
                    <?php echo  form_hidden('action', 'delete_specialty_code'); ?>
                    <input type="hidden" name="id"/>
                    <input type="hidden" name="code"/>
                    <input type="hidden" name="redirect_url"/>
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
    var url = window.location.href;
    var last = url.split("/");
    var redirect_to = last[last.length-4]+'/'+last[last.length-3]+'/'+last[last.length-2]+'/'+last[last.length-1];
    $('#delete_specialty_code input[name="redirect_url"]').val(redirect_to);
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

function edit_code(snomed_id, cat_id){
    $.ajax({
        type: "POST",
        url: "<?= base_url('department/get_code'); ?>",
        data: {snomed_code: snomed_id, [csrf_name]: csrf_hash},
        dataType: 'JSON',
        success: function(data){
            $('.category_id').val(cat_id);
            $('#code').val(data['snomed_code_desc']);
            if(data['schedule_type'].toLowerCase() == 'weekly'){
                $('#weekly').trigger('click');
                $('#select_day').val(data['schedule_value'])
            }else{
                $('#edit_days').trigger('click');
                $('#no_of_days').val(data['schedule_value'])
            }
            $('.snomed_code_id').val(data['snomed_code_id'])
            $('#edit_code').modal('show');
            //$('#code').val(data['snomed_code_desc']);
        },
        error: function(xhr, status, error){
            console.error(xhr);
        }
    });    
    
}
$(document).ready(function(){
    var cat_id = localStorage.getItem('cid');
    //var link = $("a").find("[data-cat-id='" + cat_id + "']").html();
    var link = $("a[data-cat-id='" + cat_id +"']").click();
    $("a[data-cat-id='" + cat_id +"']").parent('li').addClass('active');    

    $('#edit_code_frm').on('submit', function(e){
        e.preventDefault();        
        localStorage.setItem('cid', $('.category_id').val());        
        $.ajax({
            type: 'post',
            url: '<?= base_url('department/save_edit_code'); ?>',
            data: $('#edit_code_frm').serialize(),
            success: function (reponse) {
                if(reponse == 1) {
                    $('#edit_code').modal('hide');
                    message('Updated Successfully.', 'success');
                    setTimeout(function(){
                        location.reload();
                    },800);
                }
            }
          });

    })
});
</script>
