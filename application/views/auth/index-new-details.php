<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style type="text/css">
    .profile-widget {
        min-height: 220px;
    }

    .small.text-muted a {
        display: block;
        height: 38px;
    }
    .profile-widget .icons_users_type{
        display: inherit;
    }
    .profile-widget .icons_users_type:hover:after{
        left: 20px;
    }
    .hospital-container {
        position: absolute;
        left: 0.6rem;
        top: 0.5rem;
        display: inline;
    }

    .hospital-info {
        border: 2px solid #0192E6;
        display: inline;
        padding: 6px 4px;
        border-radius: 600px;
        font-size: 0.75rem;
        color: #0192E6;
    }

    .avatar > img {
        height: 80px
    }

    .profile-widget {
        padding-top: 30px;
    }


    .tg-checkboxgroup .tg-radio {
        top: 0;
        left: 0;
        margin: 0;
        width: auto;
        float: left;
        height: auto;
    }
    .tg-statusbar.tg-flagcolor.custome-flagcolors .tg-checkboxgroup .tg-radio label {
        padding: 8px;
    }
    .tg-statusbar.tg-flagcolor .tg-checkboxgroup .tg-radio label {
        padding: 0;
        font-size: 16px;
        line-height: 2;
    }
    .tg-statusbar.tg-flagcolor .tg-checkboxgroup .tg-radio label {
        height: 36px;
        width: 36px;
        text-align: center;
        padding: 7px;
        border-radius: 50%;
        color: #555;
    }
    .tg-statusbar.tg-flagcolor .tg-checkboxgroup .tg-radio label {
        color: #999;
        width: auto;
        height: auto;
        cursor: pointer;
        margin: 0 5px;
        padding: 0 10px;
        font-size: 12px;
        line-height: 20px;
        position: relative;
        border-radius: 15px;
        display: inline-block;
        vertical-align: middle;
        border: 1px solid #ddd;
    }
    .carousel-inner > .item > a > img, .carousel-inner > .item > img, .img-responsive, .thumbnail a > img, .thumbnail > img {
        display: block;
        max-width: 100%;
        height: auto;
    }
</style>
<div class="page-header">
    <input type="hidden" id="user_role_get" name="user_role_get" value="<?php echo $group_id; ?>">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Users</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ul>
        </div>
        
        <div class="clearfix"></div>
    </div>
</div>
<!--<div class="row">
    <div class="col-md-6">
        <ul class="list-inline">
            <li class="list-inline-item">
                <a class="btn btn-light icons_users_type btn-sm all_icon user_status" href="javascript:;" data-id="all">
                    <img src="<?php echo base_url()?>assets/icons/all_icon.png" class="img-fluid" />
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn btn-light icons_users_type btn-sm locked_icon user_status" href="javascript:;" data-id="2">
                    <img src="<?php echo base_url()?>assets/icons/locked_icon.png" class="img-fluid" />
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn btn-light icons_users_type btn-sm spammers_icon user_status" href="javascript:;" data-id="3">
                    <img src="<?php echo base_url()?>assets/icons/spam_icon.png" class="img-fluid" />
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn btn-light icons_users_type btn-sm validating_icon user_status" href="javascript:;" data-id="0">
                    <img src="<?php echo base_url()?>assets/icons/validating_icon.png" class="img-fluid" />
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn btn-light icons_users_type btn-sm validated_icon user_status" href="javascript:;" data-id="1">
                    <img src="<?php echo base_url()?>assets/icons/validated_icon.png" class="img-fluid" />
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn btn-light icons_users_type btn-sm banned_icon user_status" href="javascript:;" data-id="4">
                    <img src="<?php echo base_url()?>assets/icons/banned_icon.png" class="img-fluid" />
                </a>
            </li>
        </ul>
    </div>
    <div class="col-md-6 text-right">
        <div class="col-auto float-right ml-auto">
            <a href="<?php echo base_url('auth/create_user'); ?>" class="btn add-btn"><i class="fa fa-plus"></i>
                User</a>
        </div>
        
         <div class="col-auto float-right ml-auto">
            <a href="<?php echo base_url('institute/AddLaboratory'); ?>" class="btn add-btn"><i class="fa fa-plus"></i>
                Laboratory</a>
        </div>
        
        <div class="col-auto float-right ml-auto">
            <a href="<?php echo base_url('auth/create_hospital'); ?>" class="btn add-btn"><i class="fa fa-plus"></i>
                Hospital</a>
        </div>
    </div>
</div>-->
<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
               <span class="dash-widget-icon">
                    <img src="<?php echo base_url();?>assets/icons/network_icon.png" class="img-fluid"/>
                </span>
                <div class="dash-widget-info">
                    <h3>5</h3>
                    <span><a href="javascript:;">Network</a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-hospital-o"></i></span>
                <div class="dash-widget-info">
                    <h3><?php echo $firstRowCounts[0]["hosp_counts"];?></h3>
                    <span><a href="javascript:;">Hospital</a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon">
                    <img src="<?php echo base_url();?>assets/icons/laboratory_icon.png" class="img-fluid"/>
                </span>
                <div class="dash-widget-info">
                    <h3><?php echo $firstRowCounts[0]["lab_counts"];?></h3>
                    <span><a href="javascript:;">Laboratory</a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon">
                    <img src="<?php echo base_url();?>assets/icons/cancer_service_icon.png" class="img-fluid"/>
                </span>
                <div class="dash-widget-info">
                     <h3><?php echo $firstRowCounts[0]["cancer_counts"];?></h3>
                    <span><a href="javascript:;">Cancer Service</a></span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /Page Header -->
<!-- Search Filter -->
<div class="row filter-row">
    <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus select-focus hospital-select-container" style="display: none;">
            <select class="floating" name="hospital" id="select-hospital">
                <option value="">Select Hospital</option>

            </select>
            <label class="focus-label">Hospital</label>
        </div>
    </div>
    
    <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus select-focus org-select-container" style="display: none;">
            <select class="floating" name="organization" id="select-organization">
                <option value="">Select Organization</option>
            </select>
            <label class="focus-label">Organization</label>
        </div>
    </div>
    
    <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus select-focus name-select-container" style="display: none;">
            <select class="floating" name="user_name" id="select-name">

            </select>
            <label class="focus-label">Name</label>
        </div>
    </div>
    
    <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus select-focus role-select-container" style="display: none;">
            <select class="floating" name="groups" id="group-select">
                <option value="">Select Role</option>
            </select>
            <label class="focus-label">Role</label>
        </div>
    </div>
    
<!--     <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus select-focus">
            <select class="floating" name="user_status" id="user_status">
                <option value="">Select Status</option>
                <option value="0">All</option>
                <option value="1">Validated</option>
                <option value="2">Locked</option>
                <option value="3">Banned</option>
                <option value="4">Spammers</option>
            </select>
            <label class="focus-label">Status</label>
        </div>
    </div>
 --><!--    <div class="col-sm-2 col-md-1">
        <div class="form-group form-focus" style="display: none;">
            <button class="btn btn-primary" id="clear-filter" alt="Clear Filter"><i class="fa fa-refresh"></i></button>
        </div>
    </div>-->
</div>
<!-- /Search Filter -->
<div class="row staff-grid-row">
    <?php
    /**
     * Check if Query String is Set in URL
     */
    $url_user_group_id = '';
    if (isset($_GET) && !empty($_GET['group_id'])) {
        $url_user_group_id = $_GET['group_id'];
    }
    $custom_users = $usersList;

    if (!empty($custom_users)) {
        ?>
        <script>
            var user_data = [];
        </script>
    <?php
//    print_r($custom_users); exit; 
    $color_count = 0;
    foreach ($custom_users

    as $key => $value) {
    $is_hospital_admin = $value->is_hospital_admin;
    $full_name = '';
    $first_name = htmlspecialchars($value->enc_first_name, ENT_QUOTES, 'UTF-8');
    $last_name = htmlspecialchars($value->enc_last_name, ENT_QUOTES, 'UTF-8');
    if (!empty($first_name) || !empty($last_name)) {
        $full_name = $first_name . ' ' . $last_name;
    }
    $user_email = htmlspecialchars($value->enc_email, ENT_QUOTES, 'UTF-8');
    if ($value->active) {
        $user_active_status = anchor("auth/deactivate/" . $value->user_id, lang('index_active_link'));
    } else {
        $user_active_status = anchor("auth/activate/" . $value->user_id, lang('index_inactive_link'));
    }
    //Get Hospital Group ID From User Meta Table

    $hospital_linked_name = '';
    $related_hospital = get_related_hospital($value->user_id, $value->group_id, $value->group_type, $value->type_cate);
//    echo $this->db->last_query(); exit; 
    if ($value->group_type === 'H') {
        $value->description = 'Hospital Staff';
        if ($value->is_hospital_admin) {
            $value->description = 'Hospital Admin';
        }
    }

    ?>
        <script>
            user_data.push({
                'user_id': `<?php echo $value->user_id; ?>`,
                'first_name': `<?php echo $first_name; ?>`,
                'last_name': `<?php echo $last_name; ?>`,
                'group_id': `<?php echo $value->group_id; ?>`,
                'description': `<?php echo $value->description; ?>`,
                'group_type': `<?php echo $value->group_type; ?>`
            });
        </script>
        <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3 ">
            <div class="profile-widget">
                <div class="hospital-container">
                    <?php foreach ($related_hospital as $h) : ?>
                        <div data-toggle="tooltip" data-placement="top" title="<?php echo $h['description']; ?>"
                             class="hospital-info"><?php echo $h['first_initial'] . $h['last_initial'] ?></div>
                    <?php endforeach; ?>
                </div>
                <div class="profile-img">
                    <a href="<?php echo base_url() ?>auth/edit_user/<?php echo $value->user_id ?>" class="avatar">
                        <img src="<?php echo get_profile_picture($value->profile_picture_path, $first_name, $last_name) ?>"
                             alt="">
                    </a>
                </div>
                <div class="dropdown profile-action">
                    <a class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                                class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item"
                           href="<?php echo base_url() ?>auth/edit_user/<?php echo $value->user_id ?>"><i
                                    class="fa fa-pencil m-r-5"></i> Edit</a>
                        <a class="dropdown-item btn-delete" href="#" data-id="<?php echo $value->user_id ?>"
                           data-toggle="modal" data-target="#delete_employees"><i class="fa fa-trash-o m-r-5"></i>
                            Delete</a>
                        <a class="dropdown-item btn-temp-pass" href="#" data-toggle="modal"
                           data-id="<?php echo $value->user_id ?>" data-target="#temperory_password"><i
                                    class="fa fa-key m-r-5"></i> Password</a>
                    </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a><?php echo html_purify($full_name); ?></a></h4>
                <div class="small text-muted"><?php
                    echo anchor("auth/edit_group/" . intval($value->group_id), htmlspecialchars(ucwords($value->description), ENT_QUOTES, 'UTF-8'));
                    ?>
                </div>
                <?php if($value->user_status==0){
                    $icon_img = "validating_icon.png";
                    $icon_text = "validating_icon";
                } else if($value->user_status==1){
                    $icon_img = "validated_icon.png";
                    $icon_text = "validated_icon";
                }else if($value->user_status==2){
                    $icon_img = "locked_icon.png";
                    $icon_text = "locked_icon";
                }else if($value->user_status==3){
                    $icon_img = "spam_icon.png";
                    $icon_text = "spammers_icon";
                }else if($value->user_status==4){
                    $icon_img = "banned_icon.png";
                    $icon_text = "banned_icon";
                }

                    ?>
                <a href="javascript:;" class="icons_users_type <?php echo $icon_text;?>">
                    <img src="<?php echo base_url() ?>assets/icons/<?php echo $icon_img; ?>" class="adminstatus"/>
                </a>
                <a href="javascript:;" onClick="loadasAdmin(<?php echo intval($value->user_id); ?>)">

                    <img src="<?php echo base_url() ?>assets/icons/adminlogin.png" class="adminlogin"/>
                </a>
            </div>
        </div>
        <?php $color_count++;
    } ?>
    <?php } ?>
</div>
<!-- Profile Modal -->
<div id="temperory_password" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(uri_string(), array('id' => 'update_password_form')); ?>
                <input type="hidden" name="user_id" id="user_id"
                       value="<?php echo empty($user_id) ? '' : $user_id; ?>"/>
                <input type="hidden" name="password_status" id="password_status" value="0"/>
                <input type="hidden" name="pass_status" id="pass_status" value="1"/>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">New Password</label>
                    <div class="col-sm-8">
                        <input type="password" id="password" name="password" class="form-control" value="">
                    </div>
                </div>
                <div class="submit-section">
                    <button class="btn btn-primary password-submit-btn" type="button">Submit</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- /Profile Modal -->
<!-- Profile Modal -->
<div class="modal custom-modal fade" id="delete_employee" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <?php echo form_open(uri_string(), array('id' => 'delete_user_form')); ?>
                <div class="form-header">
                    <h3>Delete User</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <input type="hidden" name="delete_user_id" id="delete_user_id" value=""/>
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);"
                               class="btn btn-primary btn-user-delete continue-btn">Delete</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-dismiss="modal"
                               class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- /Profile Modal -->