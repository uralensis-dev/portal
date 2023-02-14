<!-- Page Header -->
<style type="text/css">
    .text-black { color: #333 !important; }
    .show{display: block !important;}
    .add-btn{border-radius: 50px;}

    .profile-widget:hover{
        cursor: pointer;
        background: #00c5fb;
        color: #fff
    }

    .profile-widget:hover h4, .profile-widget:hover p, .profile-widget:hover div, .profile-widget:hover a{
        color: #fff !important;
    }
    .edit-btn, .del-btn{
        position: relative;
        top: 0;
        border: 1px solid #ccc;
        color: #777;
        padding: 5px 10px;
        font-size: 14px;
        border-radius: 40px;
    }

    a.edit-btn:hover, a.del-btn:hover{
        color: #777 !important;
        background: #fff;
        border: 1px solid #fff;
    }

    .profile-img{
        background: #777;
        line-height: 80px;       
        border-radius: 50%;
    }
    .profile-img a{
        color: #fff;
        font-size: 30px;
    }
    .profile-widget:hover .profile-img, .profile-widget:hover .profile-img a{
        background: #fff;
        color: #777 !important;
    }

    .dropdown.profile-action{
        display: none
    }
    .table.custom-table > tbody > tr > td a.dropdown-item{
        float: left;
        display: contents;
    }
    .table.custom-table > tbody > tr > td a.dropdown-item:hover,
    .table.custom-table > tbody > tr > td a.dropdown-item:focus{
        color: #00c5fb;
    }    
    #list_view .hospital-info{ margin: 1px; display: inline-block;padding: 4px;width: 30px;height: 30px;text-align: center;}    
    #list_view .avatar > img{ height: auto;margin-top: -41px; }
    #list_view .profile-img{width: 40px; height: 40px; margin-right: 15px;}
    #list_view .profile-img .avatar{width: 40px; height: auto;}
    .status-btn { padding: 3px 20px; font-size: 12px; border-radius: 4px;}
    .hospital-info {
        border: 2px solid #0192E6;
        display: inline-block;
        padding: 4px;
        border-radius: 600px;
        font-size: 0.75rem;
        color: #0192E6;
        width: 30px;
        height: 30px;
        margin: 0 0 5px;
        line-height: 1.75;
    }
    #list_view .hospital-info{
        margin: 1px;
        display: inline-block;
        padding: 4px;
        width: 30px;
        height: 30px;
        text-align: center;
    }
    .avtar_visible{
        overflow: visible !important;
    }
    .add-btn {
    background-color: #00c5fb !important;
    border: 1px solid #00c5fb !important;
    border-radius: 3px !important;
    color: #fff !important;
    float: right !important;
    font-weight: 500 !important;
    min-width: 140px !important;
}
</style>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Team Members</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Team Members</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
           

            <div class="view-icons">
                <a style="margin-right: 10px;" href="<?php echo base_url()."laboratory/create_user/".base64_encode($group_id); ?>" class="btn add-btn"><i class="fa fa-plus"></i> User</a>
                <a href="javascript:;" class="grid-view btn btn-link list_option active"><i class="fa fa-th"></i></a>
                <a href="javascript:;" class="list-view btn btn-link list_option"><i class="fa fa-bars"></i></a>
            </div>
        </div>        
    </div>
</div>
<div id="grid_view" class="fade hidden show">
    <div class="row staff-grid-row">
    <?php
                      $cnt =0;                            
                      foreach($pathologist_info as $resKey => $resVal)
                      {
                          $resValue = (array) $resVal;
                          $cnt ++;
                      ?>   
    
        <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
                <div class="user-img">                    
                        <img class="user-img" src="<?php echo base_url();?><?= $resValue["profile_picture_path"];?>" width="75px" height="75px" style="border-radius:50px" alt=""> 
                       <!-- <i class="fa fa-suitcase"></i>
                         <?=$resValue["first_initial"] . $resValue["last_initial"];?> -->                    
                </div>
                <!-- <div class="dropdown profile-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?= base_url();?>auth/edit_group/<?= $resValue["user_id"];?>" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                        <a class="dropdown-item" href="<?= base_url();?>auth/delete_group/<?= $resValue["user_id"];?>"  ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                    </div>
                </div> -->
                <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="<?= base_url();?>auth/edit_group/<?= $resValue["user_id"];?>"><?= $resValue["first_name"].' '.$resValue["last_name"];?></a></h4>
                <h5><?= $resValue["description"]; ?>
                 <br />
				 <?=$resValue["company"];?></h5>
                           
                <div class="small text-muted"><?=$resValue["description"];?></div>
                <!--<p>Last Login: <?= $resValue["last_login"];?></p>
                <p>Total patients: <span>100</span></p>
                <p>Total patients: <span>100</span></p>
                <p>Total patients: <span>100</span></p>
                <a class="edit-btn" href="<?= base_url();?>auth/edit_group/<?= $resValue["user_id"];?>" ><i class="fa fa-pencil m-r-5"></i></a>
                <a class="del-btn" href="<?= base_url();?>auth/delete_group/<?= $resValue["user_id"];?>"  ><i class="fa fa-trash-o m-r-5"></i></a>-->
            </div>
        </div>
        
      <?php } ?>  
            </div>
</div>
<div id="list_view" class="fade hidden">
   <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped datatable custom-table user_list_data_Table">
                    <thead>
                        <tr>                            
                            <th class='text-left'>Name</th>                            
                            <th>Contact</th>
                            <th class='text-center'>Requests</th>
                            <th class='text-center'>Documents</th>
                            <th class='text-center'>Couriers</th>
                            <th class='text-center'>Enquires</th>
                            <th class='text-center'>In Directory</th>
                            <th class='text-center'>Last LogIn</th>
                            <th class='text-center'>Status</th>
                            <th class='text-center'>Send Password</th>
                            <th class="text-center" style="width: 100px;">Action</th>                            
                        </tr>
                    </thead>
                    <tbody> 
                      <?php
                      $cnt =0;                            
                      foreach($pathologist_info as $resKey => $resVal)
                      {
                          $resValue = (array) $resVal;                                                
                          $cnt ++;
                      ?>     
                        <tr>                            
                            <td>
                                <h2 class="table-avatar">
                                    <div class="profile-img">
                                        <a href="javascript:void(0);" class="avatar avtar_visible">
                                            <img src="<?php echo base_url();?><?= $resValue["profile_picture_path"];?>" width="75px" height="75px" style="border-radius:50px" alt=""> 
                                        </a>
                                    </div>
                                    <a href="javascript:void(0);">
                                        <?= $resValue["first_name"].' '.$resValue["last_name"]; ?><br>
                                        <span><?= $resValue["description"]; ?></span>                                        
                                        <span><?= (empty($resValue['active']) ? 'Block' : '') ?></span>
                                    </a>
                                </h2>                                
                            </td>                            
                            <td>
                                <a href="mailto:<?= $resValue["email"]; ?>" target="_blank" class='text-black'><?= $resValue["email"];?></a><br>
                                <?php if($resValue["enc_phone"]) { ?>
                                    <a href="tel:<?= $resValue["enc_phone"]; ?>" class='text-black'><i class='las la-phone mr-1 text-success'></i><?= $resValue["enc_phone"];?></a>
                                <?php } ?>
                            </td>
                            <td class='text-center'><?= $resValue['request_count']; ?></td>
                            <td class='text-center'><?= $resValue['doc_count']; ?></td>
                            <td class='text-center'><?= $resValue['courier_count']; ?></td>
                            <td class='text-center'><?= $resValue['enq_count']; ?></td>
                            <td class="text-center">
                                <input type="checkbox" class="update-directory" value="<?= $resValue['in_directory']; ?>" data-id="<?= $resValue['id']; ?>" <?= (!empty($resValue['in_directory']) ? 'checked' :''); ?> />
                            </td>
                            <td class='text-center'>
                                <?php if($resValue['last_login_date']) { 
                                    echo '<br><span title="Last Login">'.date('d M Y', strtotime($resValue['last_login_date'])).'<br>'.date('h:i a', strtotime($resValue['last_login_date'])).'</span>';
                                }else{
                                    echo '-';
                                }
                                ?>
                            </td>
                            <td class='text-center'>
                                <?php if($resValue['wrong_attempt'] >= 3) { ?>
                                    <button type="button" class="btn btn-danger status-btn inactive-user" data-id="<?= $resValue['id']; ?>" data-email="<?= $resValue['email']; ?>">Unblock</button>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-success status-btn">Active</button>
                                <?php } ?>                                
                            </td>    
                            <td><a class="btn btn-success status-btn" href="?send_password=<?php echo $resValue['id'] ?>">Send Password</a></td>                        
                            <td class='text-center'>
                                <div class="dropdown-menu-right">
                                <a class="dropdown-item" href="<?= base_url('laboratory/edit_user/') . $resValue["id"]; ?>"><i class="fa fa-pencil m-r-5"></i> </a>
                                <a class="dropdown-item" href="javascript:delete_team('<?= base_url();?>auth/delete_group/<?=$resValue["id"];?>')"><i class="fa fa-trash-o m-r-5"></i> </a>                                   
                                </div>
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
                                                    <span class="btn-text">edit</span>
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

<div class="modal custom-modal fade" id="delete_team_member_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Team Member</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary continue-btn team-member-delete-btn">Delete</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-dismiss="modal"
                                class="btn btn-primary cancel-btn">Cancel</a>
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
    $(document).on('click', '.inactive-user', function (){        
        let userID = $(this).attr('data-id');
        let userEmail = $(this).attr('data-email');
        if(userEmail != ''){
            $.ajax({
                type: "POST",
                url: _base_url + 'auth/inactive_user',
                data: { 'id' : userID, 'email' : userEmail},
                dataType: "json",
                success: function (response) {
                    if (response.status === 'success') {
                        $.sticky(response.message, {classList: 'success', speed: 200, autoclose: 7000});
                        location.reload();
                    } else {
                        $.sticky(response.message, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        }
    });
    $(document).on('change', '.update-directory', function (){
        let userID = $(this).attr('data-id');
        let directory = ($(this).prop('checked') == true) ? '1' : '';
        if(userID != ''){
            $.ajax({
                type: "POST",
                url: _base_url + 'auth/update_directory',
                data: { 'id' : userID, 'in_directory' : directory },
                dataType: "json",
                success: function (response) {
                    if (response.status === 'success') {
                        $.sticky(response.message, {classList: 'success', speed: 200, autoclose: 7000});
                        location.reload();
                    } else {
                        $.sticky(response.message, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        }
    });
    $(document).on('click', '.list_option', function(){
        if($(this).hasClass('list-view')){
            localStorage.list_option = 'list-view';
        }else{
            localStorage.removeItem('list_option');
        }
    })
    function delete_team(url){    
        $('#delete_team_member_modal').modal('show');    
        $('.team-member-delete-btn').attr('href', url);
    }
    $(document).ready(function(){        
        setTimeout(function(){
            $('.'+localStorage.list_option).click();
            $(".user_list_data_Table").dataTable().fnDestroy();
            $('.user_list_data_Table').DataTable({
                "columnDefs": [
                    { "orderable": false, "targets": [8,9] },
                ]
            });
        }, 50)
    })
</script>