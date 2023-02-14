<!-- Page Header -->
<style type="text/css">
    .show{display: block !important;}
    .add-btn{border-radius: 50px;}
</style>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Clinic</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Clinic</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <!--<a href="<?php echo base_url("/institute/AddLaboratory"); ?>" class="btn add-btn" ><i class="fa fa-plus"></i>Add Laboratory</a>-->

            <div class="view-icons">
                <a href="javascript:;" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                <a href="javascript:;" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
            </div>
        </div>        
    </div>
</div>
<div id="grid_view" class="fade hidden show">
    <div class="row staff-grid-row">
    <?php
                      $cnt =0;    
					  
					  //print_r($lab_info);
					                          
                      foreach($lab_info as $resKey => $resValue) 
                      {
						  
						 // print_r($lab_info);
						  
                          $cnt ++;
                      ?>   
    
        <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
                <div class="profile-img">
                    <a href="<?php echo base_url();?>auth/edit_group/<?php echo $resValue["id"];?>" class="avatar"><img src="assets/img/profiles/avatar-02.jpg" alt=""><?php echo $resValue["first_initial"];?><?php echo $resValue["last_initial"];?></a>
                </div>
                <div class="dropdown profile-action" style="display:none">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?php echo base_url();?>auth/edit_group/<?php echo $resValue["id"];?>" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                        <a class="dropdown-item" href="<?php echo base_url();?>auth/delete_group/<?php echo $resValue["id"];?>"  ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                    </div>
                </div>
                <h5 class="user-name m-t-10 mb-0 text-ellipsis"><a href="<?php echo base_url();?>auth/edit_group/<?php echo $resValue["id"];?>"><?php echo $resValue["description"];?></a></h5>
                <div class="small text-muted"><?php echo $resValue["hosp_city"];?></div>
                 <div class="small text-muted"><?php echo $resValue["hosp_phone"];?></div>
            </div>
        </div>
        
      <?php } ?>  
            </div>
</div>
<div id="list_view" class="fade hidden">
   <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped datatable custom-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Address</th>
                            <th>Avaiable Tests</th>
                            <th>Billing Date</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody> 
                      <?php
                      $cnt =0;                            
                      foreach($lab_info as $resKey => $resValue) 
                      {
                          $cnt ++;
                      ?>                    
                        <tr>
                            <td><?php echo $cnt; ?></td>
                            <td><?php echo $resValue["description"];?> </td>
                            <td><?php echo $resValue["hosp_email"];?></td>
                            <td><?php echo $resValue["hosp_phone"];?></td>
                            <td><?php echo $resValue["hosp_address"];?><br /><?php echo $resValue["hosp_city"];?></td>
                            <td>0</td>
                            <td>0</td>                        
                            <td ><a  href="#"><i class="fa fa-eye m-r-5"></i></a> <a href="#"><i class="fa fa-trash-o m-r-5"></i></a>                                    
                                  
                            </td>
                        </tr>                    
                      <?php } ?>                   
                    </tbody>
                </table>

                
         <div id="add-user-modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">New User</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card mb-4 ac-card">
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <button class="btn btn-primary" data-toggle="collapse"
                                            data-target="#active-directory-select-container">Active Directory
                                    </button>
                                </div>
                            </div>
                            <div class="collapse" id="active-directory-select-container"></div>

                        </div>
                        <div class="tg-editformholder">
                            <?php if (array_key_exists('general', $user_error)) : ?>
                                <div class="row">
                                    <div class="col">
                                        <p style="color: red;">Cannot create user now try again later</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php echo form_open_multipart("institute/create_customer", array('class' => 'tg-formtheme tg-editform create_user_form')); ?>
                            <input type="hidden" name="user_group_type" id="user_group_type" />
                            <div class="card mb-4">
                                <div class="card-body">
                                    <!-- Profile Picture Input -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="profile-img-wrap edit-img">
                                                <img class="inline-block" id="profile-pic-preview"
                                                     src="<?php echo base_url('assets/newtheme/img/profiles/avatar-02.jpg'); ?>"
                                                     alt="user">
                                                <div class="fileupload btn">
                                                    <san class="btn-text">edit</span>
                                                        <input class="upload" type="file" id="profile-pic" name="profile_pic" accept="image/*"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- User Personal Information START -->
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group tg-inputwithicon">
                                                    <i class="lnr lnr-user"></i>
                                                    <?php echo form_input(array('type' => 'text', 'name' => 'first_name', 'id' => 'first_name', 'value' => $user_data['first_name'], 'class' => 'form-control ' . (array_key_exists('first_name', $user_error) ? 'is-invalid' : ''), 'placeholder' => 'First Name')); ?>
                                                    <div class="invalid-feedback">
                                                        Please provide a valid name
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group tg-inputwithicon">
                                                    <i class="lnr lnr-user"></i>
                                                    <?php echo form_input(array('type' => 'text', 'name' => 'last_name', 'id' => 'last_name', 'value' => $user_data['last_name'], 'class' => 'form-control', 'placeholder' => 'Last Name')); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group tg-inputwithicon">
                                                    <i class="lnr lnr-apartment"></i>
                                                    <?php echo form_input(array('type' => 'text', 'name' => 'company', 'id' => 'company', 'value' => $user_data['company'], 'class' => 'form-control', 'placeholder' => 'Company Name')); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group tg-inputwithicon">
                                                    <i class="lnr lnr-phone-handset"></i>
                                                    <?php echo form_input(array('type' => 'text', 'name' => 'phone', 'id' => 'phone', 'value' => $user_data['phone'], 'class' => 'form-control', 'placeholder' => 'Phone')); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-envelope"></i>
                                            <?php echo form_input(array('type' => 'text', 'name' => 'email', 'id' => 'email', 'value' => $user_data['email'], 'class' => 'form-control check_email' . (array_key_exists('email', $user_error) ? 'is-invalid' : ''), 'placeholder' => 'Email')); ?>
                                            <span id="email_span" style="display: none;color: red"></span>
                                            <div class="invalid-feedback">
                                                <?php echo array_key_exists('email', $user_error) ? $user_error['email'] : ''; ?>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group tg-inputwithicon">
                                                    <i class="lnr lnr-lock"></i>
                                                    <?php echo form_input(array('type' => 'text', 'name' => 'address1', 'id' => 'address1', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Address 1')); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group tg-inputwithicon">
                                                    <i class="lnr lnr-lock"></i>
                                                    <?php echo form_input(array('type' => 'text', 'name' => 'address2', 'id' => 'address2', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Address 2')); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="password-row">
                                            <div class="col-md-6">
                                                <div class="form-group tg-inputwithicon">Finance Details</div>
                                            </div>                                    
                                        </div>                               
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group tg-inputwithicon" id="memo-row">
                                                    <i class="lnr lnr-apartment"></i>
                                                    <?php echo form_input(array('type' => 'text', 'name' => 'company_vat', 'id' => 'company_vat', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Company VAT No', 'maxlength' => 10, 'size' => 10)); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group tg-inputwithicon" id="pin-row">
                                                    <i class="lnr lnr-apartment"></i>
                                                    <?php echo form_input(array('type' => 'text', 'name' => 'credit_limit', 'id' => 'credit_limit', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Credit Limit Amount', 'maxlength' => 10, 'size' => 10)); ?>
                                                </div>
                                            </div>                                   
                                        </div>                               
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group tg-inputwithicon">
                                                    <i class="lnr lnr-lock"></i>
                                                    <select class="select form-control" name="block_status" id="country">
                                                        <option value="">Do you want to stop billing after cross limit?</option>                                               
                                                            <option value="1">Yes</option>
                                                          <option value="0">No</option>                                               
                                                    </select>
                                                </div>
                                            </div>                                    
                                        </div>
                                        <input type="hidden" name="group_id" value="<?php echo $user_data['group_id'] ?>">
                                        <input type="hidden" name="active_directory_user" value="<?php echo $user_data['active_directory_user'] ?>">
                                        <div class="form-group">
                                            <button class="btn btn-success" id="user-create-btn">Create</button>
                                            <button class="btn btn-warning" id="user-form-clear-btn" type="button">Clear
                                            </button>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
function add_customer(group_id, group_type) {
    
	 setTimeout(function() {
        $.get(_base_url + 'institute/get_active_directory_users?type='+group_type, function(data) {
            $("#active-directory-select-container").empty();
            var template = $(`<select id="active-directory-select" class="select">
            </select>`);
            if (data.length === 0) {
                template = $('<p>Active directory empty for this group</p>');
            }
            for (let i = 0; i < data.length; i++) {
                var user = data[i];
                template.append(`<option value="${user.id}">${user.first_name} ${user.last_name}</option>`);
            }
            console.log(template);
            $("#active-directory-select-container").append(template);
            $("#active-directory-select").select2({width: '100%'});
            $("#active-directory-select").on('select2:select', function() {
                var user_id = $(this).val();
                $('input[name="active_directory_user"]').val(user_id);
                $.get(_base_url + 'institute/get_user_details?id='+user_id, function(data) {
                    //$("#password-row").hide();
                    //$("#memo-row").hide();
                    $("#email").prop('readonly', true);
                    $("#first_name").val(data['first_name']);
                    $("#last_name").val(data['last_name']);
                    $("#company").val(data['company']);
                    $("#phone").val(data['phone']);
                    $("#email").val(data['email']);
                    if (!(data['profile_picture'] === null || data['profile_picture'].length === 0)) {
                        $("#profile-pic").val('');
                        $("#profile-pic-preview").attr('src', _base_url+data['profile_picture']);
                    }
                });
            });
            $("#user_group_type").val(group_type);
            $("#add-user-modal").modal('show');
        });
    }, 500);
}

</script>