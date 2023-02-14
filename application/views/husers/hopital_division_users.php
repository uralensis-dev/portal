<!-- Page Header -->
<style type="text/css">
    .show{display: block !important;}
    .add-btn{border-radius: 50px;}
</style>
<!-- <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" /> -->
<!-- <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet" /> -->

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title"><?php echo $Heading;?></h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><?php echo $Breadcum;?></li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            
           
            <!-- <a href="javascript:void(0);" class="btn add-btn" >
                <i class="fa fa-plus"></i>Add User</a> -->

             <div class="view-icons">
                <a href="javascript:;" class="grid-view btn btn-link "><i class="fa fa-th"></i></a>
                <a href="javascript:;" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a>
            </div>
        </div>        
    </div>
</div>



<div id="grid_view" class="fade hidden ">
    <!--div class="row filter-row">
        <div class="col-sm-6 col-md-3"> 
            <div class="form-group form-focus select-focus">
                <select class="select floating"> 
                    <option>Select Hospital</option>
                    <option>Select Hospital</option>
                    <option>Select Hospital</option>
                    <option>Select Hospital</option>
                </select>
                <label class="focus-label">Hospital</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3"> 
            <div class="form-group form-focus select-focus">
                <select class="select floating"> 
                    <option>Select Organization</option>
                    <option>Select Organization</option>
                    <option>Select Organization</option>
                    <option>Select Organization</option>
                </select>
                <label class="focus-label">Organization</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">  
            <div class="form-group form-focus">
                <input type="text" class="form-control floating">
                <label class="focus-label">Name</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3"> 
            <div class="form-group form-focus select-focus">
                <select class="select floating"> 
                    <option>Select Role</option>
                    <option>Select Role</option>
                    <option>Select Role</option>
                    <option>Select Role</option>
                </select>
                <label class="focus-label">Role</label>
            </div>
        </div>
    </div>-->
    

    <div class="row staff-grid-row">

        <?php if(!empty($hospital_array)){
            // echo "<pre>"; print_r($hospital_array);die;
            $i=0;
            foreach($hospital_array as $hosValues){
                $hid = $hosValues['group_id'];
                $i++;
            ?>
        <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3" data-group="<?php echo $hosValues['group_id']?>" data-type="<?php echo $hosValues['user_type']?>" id="user-card-<?php echo $hosValues['id']?>" style="">
            <div class="profile-widget">
                <div class="profile-img">
                    <a href="profile.html" class="avatar"><img src="<?php echo base_url($hosValues['profile_picture'])?>" alt=""></a>
                </div>
                <div class="dropdown profile-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?php echo base_url('husers/edit_hospital_user/'.$hosValues['id'])?>" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                        <a class="dropdown-item" href="javascript:void();" onclick="delete_user('<?php echo $hosValues["user_group_id"]?>','<?php echo $hosValues["id"]?>');"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                    </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="profile.html"><?php echo $hosValues['first_name'].' '.$hosValues['last_name']?></a></h4>
                <div class="small text-muted"><?php echo $hosValues['phone'] ?></div>
                <div class="small text-muted"><?php echo $hosValues['company'] ?></div>
            </div>
        </div>
    <?php }

}
?>
        
        
         
    </div>
</div>
<div id="list_view" class="fade hidden show">
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
                            <th>User Type</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody> 
                        <?php if(!empty($hospital_array)){
                            $i=0;
                            foreach($hospital_array as $hosValues){
                                $hid = $hosValues['group_id'];
                                $i++;
                            ?>
                            <tr>
                            <td><?php echo $i;?></td>
                            
                            <td>
                                <img src="<?php echo base_url($hosValues['profile_picture']);?>" style="width:40px;border-radius: 50%; background-color: #eae8e8;">
                                <?php echo $hosValues['first_name'].' '.$hosValues['last_name'];?></td>
                            <td><?php echo $hosValues['email'];?></td>
                            <td><?php echo $hosValues['phone'];?></td>

                            <td>
                                <select onchange="update_group_id(this.value, '<?php echo $hosValues["id"]?>','<?php echo $hosValues["user_group_id"]?>')" disabled="disabled">
                                    <option value=""> Select user type</option>
                                <option value="63" <?php if($hid=='63'){echo "selected";}?> data-select2-id="18">Hospital Accounts</option>
                                <option value="33" <?php if($hid=='33'){echo "selected";}?> data-select2-id="19">Clinician/Surgery</option>
                                <option value="45" <?php if($hid=='45'){echo "selected";}?> data-select2-id="20">Requestor</option>
                                <option value="14" <?php if($hid=='14'){echo "selected";}?> data-select2-id="21">Hospital Secretary</option>
                                <option value="15" <?php if($hid=='15'){echo "selected";}?> data-select2-id="22">Cancer Service</option>
                                <option value="6" <?php if($hid=='6'){echo "selected";}?> data-select2-id="22">Pathologist</option>
                            </select>
                            </td>
                            <td>
                                <a href="<?php echo base_url('husers/edit_hospital_user/'.$hosValues['id'])?>"><i class="fa fa-pencil"></i></a>
                                &nbsp;&nbsp;
                                <a href="javascript" onclick="delete_user('<?php echo $hosValues["user_group_id"]?>','<?php echo $hosValues["id"]?>');"><i class="fa fa-trash"></i></a>
                            </td>
                            
                            
                        </tr>
                            <?php 
                            }
                        }

                        ?>
                                       
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
                            <?php //if (array_key_exists('general', $user_error)) : ?>
                                <div class="row">
                                    <div class="col">
                                        <p style="color: red;">Cannot create user now try again later</p>
                                    </div>
                                </div>
                            <?php //endif; ?>
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
                                                    <?php //. (array_key_exists('first_name', $user_error) ? 'is-invalid' : '')
                                                    echo form_input(array('type' => 'text', 'name' => 'first_name', 'id' => 'first_name', 'value' => $user_data['first_name'], 'class' => 'form-control ' , 'placeholder' => 'First Name')); ?>
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
                                            <?php //. (array_key_exists('email', $user_error) ? 'is-invalid' : '')
                                            echo form_input(array('type' => 'text', 'name' => 'email', 'id' => 'email', 'value' => $user_data['email'], 'class' => 'form-control check_email', 'placeholder' => 'Email')); ?>
                                            <span id="email_span" style="display: none;color: red"></span>
                                            <div class="invalid-feedback">
                                                <?php //echo array_key_exists('email', $user_error) ? $user_error['email'] : ''; ?>
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

    /*$(".user_status").on("click", function () {
        var gid = $(this).attr("data-id");
        hideUserCard();
        $(this).val(gid).trigger('change');
        if (gid == "all") {
            showAllUserCard();
        } else {
            $(`[data-status="${gid}"]`).show();
        }
    });*/

    function getHostul(role_id=''){
        if(role_id=='all'){
            window.location.href = '<?php echo base_url('husers/huserlist')?>';
        }else{
            window.location.href = '<?php echo base_url('husers/huserlist?t=')?>'+role_id; 
        }
    }

function import_user(type=''){
    if(type=='show'){
        $('#huser_import').attr('disabled');
        $('#open_huser_import').show();
    }else if(type=='hide'){
        $('#huser_import').attr('enable');
        $('#open_huser_import').hide();
    }
}

function update_group_id(g_id='', user_id='', user_group_id=''){
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('husers/update_group_id'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            beforeSend: function () {
                /*$.sticky('Please wait we are redirecting......', {
                    classList: 'success',
                    speed: 'slow'
                });*/
            },
            complete: function () {

            },
            data: {
                'user_id': user_id,
                'user_group_id': user_group_id,
                'g_id': g_id,
                '<?php echo $this->security->get_csrf_token_name(); ?>': cct
            },
            success: function (data) {
                if (data.type === 'success') {
                    $.sticky(data.msg, {
                        classList: 'success',
                        speed: 200,
                        autoclose: 7000
                    });
                    setTimeout(function () {
                        location.reload();
                    }, 500);
                }
            }
        });
    
}

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

function delete_user(group_id='', user_id=''){

    var r = confirm('Are you sure you want to remove');
    if(r){
        $.get(_base_url + 'husers/remove_hos_users?group_id='+group_id+'&&user_id='+user_id, function(data) {
           if(data){
            location.reload();
           }
        });
    }
     
}

</script>