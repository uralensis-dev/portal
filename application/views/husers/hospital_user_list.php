<!-- Page Header -->
<style type="text/css">
/*div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top: -65px;
        height: 37px !important;
        width: 50px !important;
        left: 29px;
        padding: 0;
        text-align: center;
        }*/

.form-control {
  border-color: #e3e3e3;
  box-shadow: none;
  font-size: 15px;
}

.user_groups_area .dash-widget-icon {
  display: block;
  max-width: 50px;
  width: 100%;
  height: 50px;
  margin: 0 auto 15px;
  text-align: center;
  float: unset;
  line-height: 1.5;
  padding: 0;
  background: transparent;
}

.user_groups_area a {
  color: #333;
}

.user_groups_area .dash-widget-icon img {
  width: 50px;
  margin: 0 auto;
}

.user_groups_area a:focus .card-body,
.user_groups_area a.active .card-body {
  background: #f1f9fbba;
}

.user_groups_area .dash-widget-info {
  text-align: center;
}

.user_groups_area .card-body {
  min-height: 192px;
}

.show {
  display: block !important;
}

.add-btn {
  border-radius: 50px;
}

.tg-cancel input[type=radio] {
  display: none;
}

.tg-cancel label {
  cursor: pointer;
  margin-bottom: 0;
  width: 45px;
  padding: 8px;
  border: 1px solid #ddd;
  border-radius: 50%;
}

li.tg-statusbar.tg-flagcolor.custome-flagcolors.float-right.nobefore.search_li button {
  height: 40px;
}

.tg-cancel label {
  width: 35px;
  padding: 5px;
}

.breadcrumb li {
  padding: 0 !important;
  margin-top: 5px;
}

.breadcrumb li:first-child:before {
  display: none !important;
}

div.dataTables_wrapper div.dataTables_length select {
  position: unset !important;
  padding: 0 15px;
}


/*@media screen and (max-width: 1580px){
    div.dataTables_wrapper div.dataTables_length select {
        top: -59px;
    }
    }*/

.scrd {
  background-color: aliceblue !important;
}
</style>
<!-- <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" /> -->
<link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet" />
<div class="page-header">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title">Hospital Users</h3>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
        <li class="breadcrumb-item active">All Users</li>
      </ul>
    </div>
    <div class="col-auto float-right ml-auto">
      <a href="javascript:void(0)" class="btn add-btn" id="huser_import" onclick="import_user('show');"> <i class="fa fa-file"></i>Import User</a> &nbsp;&nbsp;
      <!-- <a href="javascript:void(0);" class="btn add-btn" >
              <i class="fa fa-plus"></i>Add User</a> -->
      <div class="view-icons"> <a href="javascript:;" class="grid-view btn btn-link "><i class="fa fa-th"></i></a> <a href="javascript:;" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a> </div>
    </div>
  </div>
</div>
<!-- <div class="page-header"> -->
<!-- <div class="row align-items-center"> -->
<div style="width: 100%; display: none;" id="open_huser_import">
  <form action="<?php echo base_url('husers/huserlist'); ?>" id="laboratory_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
    <section class="form-group">
      <div class="card flex-fill"> <img src="<?php echo base_url('assets/img/decline_cricle.png')?>" alt="decline" onclick="import_user('hide');" id="huser_import_hide" style="width: 40px;margin-left: 96%;">
        <div class="card-body">
          <div class="row ">
            <div class="col-md-6">
              <div class="form-group">
                <label>Hospital user Import</label>
                <input class="form-control" name="laboratory_logo" id="laboratory_logo" value="" type="file"> </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>&nbsp;</label>
                <!-- <a href="" class="btn add-btn" style="margin-top: 34px;">Submit</a> -->
                <button class="btn add-btn" style="margin-top: 34px;"> Submit</button>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>CSV Format Download</label> <a href="<?php echo base_url(" assets/img/hospital_user.csv "); ?>" class="form-control" style="border: none;">
                              <img src="<?php echo base_url('assets/img/csv.png')?>" > 
                            </a> </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> </div>
<div id="grid_view" class="fade hidden ">
  <div class="row">
    <div class="col-md-12 mb-4">
      <h4 class="display-5">User Groups</h4> </div>
  </div>
  <div class="row user_groups_area">
    <div class="col">
      <div class="card dash-widget <?php echo ($role_id==63) ? 'scrd':'';?>">
        <a href="javascript:void(0);" onclick="getHostul('63')">
          <div class="card-body"> <span class="dash-widget-icon">
                      <img src="<?php echo base_url()?>assets/icons/hospital_accounts.svg" class="img-fluid">
                    </span>
            <div class="dash-widget-info">
              <h3><?php echo $HAusers;?></h3> <span>Hospital Accounts</span> </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="card dash-widget <?php echo ($role_id==33) ? 'scrd':'';?>">
        <a href="javascript:void(0);" onclick="getHostul('33')">
          <div class="card-body"> <span class="dash-widget-icon">
                      <img src="<?php echo base_url()?>assets/icons/clinician.svg" class="img-fluid">
                    </span>
            <div class="dash-widget-info">
              <h3><?php echo $CSusers;?></h3> <span>Clinician / Surgery</span> </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="card dash-widget <?php echo ($role_id==45) ? 'scrd':'';?>">
        <a href="javascript:void(0);" onclick="getHostul('45')">
          <div class="card-body"> <span class="dash-widget-icon">
                      <img src="<?php echo base_url()?>assets/icons/requester.svg" class="img-fluid">
                    </span>
            <div class="dash-widget-info">
              <h3><?php echo $Rusers;?></h3> <span>Requestor</span> </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="card dash-widget <?php echo ($role_id==14) ? 'scrd':'';?>">
        <a href="javascript:void(0);" onclick="getHostul('14')">
          <div class="card-body"> <span class="dash-widget-icon">
                      <img src="<?php echo base_url()?>assets/icons/pathology_secretary.svg" class="img-fluid">
                    </span>
            <div class="dash-widget-info">
              <h3><?php echo $HSusers;?></h3> <span>Hospital Secretary</span> </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="card dash-widget <?php echo ($role_id==15) ? 'scrd':'';?>">
        <a href="javascript:void(0);" onclick="getHostul('15')">
          <div class="card-body"> <span class="dash-widget-icon">
                      <img src="<?php echo base_url()?>assets/icons/cancer_service_icon.png" class="img-fluid">
                    </span>
            <div class="dash-widget-info">
              <h3><?php echo $CANusers;?></h3> <span>Cancer Service</span> </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="card dash-widget <?php echo ($role_id==6) ? 'scrd':'';?>">
        <a href="javascript:;" onclick="getHostul('6')">
          <div class="card-body"> <span class="dash-widget-icon">
                      <img src="<?php echo base_url()?>assets/icons/pathologist.svg" class="img-fluid">
                    </span>
            <div class="dash-widget-info">
              <h3><?php echo $Pathusers;?></h3> <span>Pathologist</span> </div>
          </div>
        </a>
      </div>
    </div>
  </div>
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
          <div class="profile-img"> <a href="profile.html" class="avatar"><img src="<?php echo base_url($hosValues['profile_picture'])?>" alt=""></a> </div>
          <div class="dropdown profile-action"> <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
            <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="<?php echo base_url('husers/edit_hospital_user/'.$hosValues['id'])?>"><i class="fa fa-pencil m-r-5"></i> Edit</a> <a class="dropdown-item" href="javascript:void(0);" onclick="delete_user('<?php echo $hosValues[" user_group_id "]?>','<?php echo $hosValues["id "]?>');"><i class="fa fa-trash-o m-r-5"></i> Delete</a> </div>
          </div>
          <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="profile.html"><?php echo $hosValues['first_name'].' '.$hosValues['last_name']?></a></h4>
          <div class="small text-muted">
            <?php echo $hosValues['phone'] ?>
          </div>
          <div class="small text-muted">
            <?php echo $hosValues['company'] ?>
          </div>
        </div>
      </div>
      <?php }

    }
    ?>
  </div>
</div>
<div id="list_view" class="fade hidden show">
    <!-- <div class="tg-haslayout">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-filterhold">
                        <ul class="tg-filters record-list-filters">
                            <li class="tg-statusbar tg-flagcolor">
                                
                            </li>
                            <li class="tg-statusbar tg-flagcolor" style="padding: 5px">
                                <div class="tg-checkboxgroup tg-checkboxgroupvtwo numbers_check">
                                    <span class="tg-radio tg-flagcolor1">
                                        <input class="tat" name="tat" id="tat5" type="radio">
                                        <label for="tat5"><span>&lt;5</span></label>
                                    </span>
                                    <span class="tg-radio tg-flagcolor2">
                                        <input class="tat" type="radio" name="tat" id="tat10">
                                        <label for="tat10"><span>&lt;10</span></label>
                                    </span>
                                    <span class="tg-radio tg-flagcolor3">
                                        <input class="tat" type="radio" name="tat" id="tat20">
                                        <label for="tat20"><span>&lt;20</span></label>
                                    </span>
                                    <span class="tg-radio tg-flagcolor4">
                                        <input class="tat" type="radio" name="tat" id="tat30">
                                        <label for="tat30"><span>&gt;20</span></label>
                                    </span>
                                    <span class="tg-cancel tg-flagcolor4" style="display: none;">
                                        <input class="tat" type="radio" name="tat" id="all_tat">
                                        <label for="all_tat">
                                            <img src="<?php echo base_url();?>assets/img/clearAll.png" class="img-responsive clearAll">
                                        </label>
                                    </span>
                                </div>
                            </li>
                            
                            <li class="tg-flagcolor" style="padding: 3px 8px">
                                <div class="tg-checkboxgroup tg-checkboxgroupvtwo flags_check">
                                                                    <span class="tg-radio tg-flagcolor1 first">
                                        
                                        <input type="radio" id="flag_blue" class="flag_status" name="flag_sorting">
                                        <label for="flag_blue"></label>
                                    </span>
                                    <span class="tg-radio tg-flagcolor2">
                                        
                                        <input type="radio" id="flag_green" class="flag_status" name="flag_sorting">
                                        <label for="flag_green"></label>
                                    </span>
                                    <span class="tg-radio tg-flagcolor3">
                                        
                                        <input type="radio" id="flag_yellow" class="flag_status" name="flag_sorting">
                                        <label for="flag_yellow"></label>
                                    </span>
                                    <span class="tg-radio tg-flagcolor4">
                                        
                                        <input type="radio" id="flag_black" class="flag_status" name="flag_sorting">
                                        <label for="flag_black"></label>
                                    </span>
                                    <span class="tg-radio tg-flagcolor5">
                                        
                                        <input type="radio" id="flag_red" class="flag_status" name="flag_sorting">
                                        <label for="flag_red"></label>
                                    </span>
                                    <span class="tg-cancel tg-flagcolor6" style="display: none">
                                        <input checked="" type="radio" class="flag_status" name="flag_sorting" id="flag_all">
                                        <label for="falg_all">
                                            <img src="<?php echo base_url();?>assets/img/clearAll.png" class="img-responsive clearAll">
                                        </label>
                                    </span>
                                </div>
                            </li>

                            <li class="tg-statusbar tg-flagcolor custome-flagcolors">
                                <div class="tg-checkboxgroup tg-checkboxgroupvtwo">
                                    
                                    <span class="tg-radio tg-flagcolor4" title="Urgent">
                                        <input id="report_urgent" class="report_urgency_status" type="radio" name="report_urgency">
                                        <label for="report_urgent">
                
                                            <img src="<?php echo base_url();?>assets/icons/Urgent-wb.png" class="img-responsive uncheck">
                                            <img src="<?php echo base_url();?>assets/icons/white/Urgent-wb-white.png" class="img-responsive checkd">
                                        </label>
                                    </span>

                                    <span class="tg-radio tg-flagcolor4" title="Routine">
                                        <input id="report_routine" class="report_urgency_status" type="radio" name="report_urgency">
                                        <label for="report_routine">
                                        <img src="<?php echo base_url();?>assets/icons/Rotate.png" class="img-responsive uncheck">
                                            <img src="<?php echo base_url();?>assets/icons/white/Rotate-white.png" class="img-responsive checkd">
                                        </label>
                                    </span>

                                    <span class="tg-radio tg-flagcolor4" title="2WW">
                                        <input id="report_2ww" class="report_urgency_status" type="radio" name="report_urgency">
                                        <label for="report_2ww">
                                            <img src="<?php echo base_url();?>assets/icons/2ww-wc.png" class="img-responsive uncheck">
                                            <img src="<?php echo base_url();?>assets/icons/white/2ww-wc-white.png" class="img-responsive checkd">
                                        </label>
                                    </span>

                                    <span class="tg-cancel tg-flagcolor4" title="Clear" style="display: none;">
                                        <input id="report_clear" class="report_urgency_status" type="radio" name="report_urgency">
                                        <label for="report_clear">
                                            <img src="<?php echo base_url();?>assets/img/clearAll.png" class="img-responsive clearAll">
                                        </label>
                                    </span>
                                </div>
                            </li>
                            <li class="tg-statusbar tg-flagcolor custome-flagcolors last float-right" style="padding: 0 10px;">                              
                                <button type="submit" class="btn btn-default adv-search" data-toggle="collapse" data-target="#collapse_adv_search"><i class="fa fa-cog"></i></button>
                            </li>
                            <li class="tg-statusbar tg-flagcolor custome-flagcolors float-right nobefore search_li" style="padding: 0">
                                <div class="input-group">
                                    <input id="unpub_custom_filter" type="text" class="form-control" placeholder="Search">
                                    <div class="input-group-btn">
                                      <button class="btn btn-success" type="submit">
                                        <i class="fa fa-search"></i>
                                      </button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
          </div> -->
  <div class="row user_groups_area">
    <div class="col">
      <div class="card dash-widget <?php echo ($role_id==63) ? 'scrd':'';?>">
        <a href="javascript:void(0);" onclick="getHostul('63')">
          <div class="card-body"> <span class="dash-widget-icon">
                      <img src="<?php echo base_url()?>assets/icons/hospital_accounts.svg" class="img-fluid">
                    </span>
            <div class="dash-widget-info">
              <h3><?php echo $HAusers;?></h3> <span>Hospital Accounts</span> </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="card dash-widget <?php echo ($role_id==33) ? 'scrd':'';?>">
        <a href="javascript:void(0);" onclick="getHostul('33')">
          <div class="card-body"> <span class="dash-widget-icon">
                      <img src="<?php echo base_url()?>assets/icons/clinician.svg" class="img-fluid">
                    </span>
            <div class="dash-widget-info">
              <h3><?php echo $CSusers;?></h3> <span>Clinician / Surgery</span> </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="card dash-widget <?php echo ($role_id==45) ? 'scrd':'';?>">
        <a href="javascript:void(0);" onclick="getHostul('45')">
          <div class="card-body"> <span class="dash-widget-icon">
                      <img src="<?php echo base_url()?>assets/icons/requester.svg" class="img-fluid">
                    </span>
            <div class="dash-widget-info">
              <h3><?php echo $Rusers;?></h3> <span>Requestor</span> </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="card dash-widget <?php echo ($role_id==14) ? 'scrd':'';?>">
        <a href="javascript:void(0);" onclick="getHostul('14')">
          <div class="card-body"> <span class="dash-widget-icon">
                      <img src="<?php echo base_url()?>assets/icons/pathology_secretary.svg" class="img-fluid">
                    </span>
            <div class="dash-widget-info">
              <h3><?php echo $HSusers;?></h3> <span>Hospital Secretary</span> </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="card dash-widget <?php echo ($role_id==15) ? 'scrd':'';?>">
        <a href="javascript:void(0);" onclick="getHostul('15')">
          <div class="card-body"> <span class="dash-widget-icon">
                      <img src="<?php echo base_url()?>assets/icons/cancer_service_icon.png" class="img-fluid">
                    </span>
            <div class="dash-widget-info">
              <h3><?php echo $CANusers;?></h3> <span>Cancer Service</span> </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="card dash-widget <?php echo ($role_id==6) ? 'scrd':'';?>">
        <a href="javascript:;" onclick="getHostul('6')">
          <div class="card-body"> <span class="dash-widget-icon">
                      <img src="<?php echo base_url()?>assets/icons/pathologist.svg" class="img-fluid">
                    </span>
            <div class="dash-widget-info">
              <h3><?php echo $Pathusers;?></h3> <span>Pathologist</span> </div>
          </div>
        </a>
      </div>
    </div>
    <!-- <div class="col">
            <div class="card dash-widget">
                <a href="javascript:;">
                    <div class="card-body">
                        <span class="dash-widget-icon">
                            <img src="<?php echo base_url()?>assets/icons/laboratory_icon.png" class="img-fluid">
                        </span>
                        <div class="dash-widget-info">
                            <h3>15</h3>
                            <span> Laboratory </span>
                        </div>
                    </div>
                </a>
            </div>
          </div> --></div>
  <div class="row">
    <div class="col-md-12">
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
              <td>
                <?php echo $i;?>
              </td>
              <td> <img src="<?php echo base_url($hosValues['profile_picture']);?>" style="width:40px;border-radius: 50%;background-color: #f0eaea;">
                <?php echo $hosValues['first_name'].' '.$hosValues['last_name'];?>
              </td>
              <td>
                <?php echo $hosValues['email'];?>
              </td>
              <td>
                <?php echo $hosValues['phone'];?>
              </td>
              <td>
                <?php $disbaled = ($hosValues['user_type']=='H')?'disabled="disabled"':'';?>
                  <select onchange="update_group_id(this.value, '<?php echo $hosValues[" id "]?>','<?php echo $hosValues["user_group_id "]?>')" <?php echo $disbaled;?>>
                    <option value=""> Select user type</option>
                    <option value="63" <?php if($hid=='63' ){echo "selected";}?> data-select2-id="18">Hospital Accounts</option>
                    <option value="33" <?php if($hid=='33' ){echo "selected";}?> data-select2-id="19">Clinician/Surgery</option>
                    <option value="45" <?php if($hid=='45' ){echo "selected";}?> data-select2-id="20">Requestor</option>
                    <option value="14" <?php if($hid=='14' ){echo "selected";}?> data-select2-id="21">Hospital Secretary</option>
                    <option value="15" <?php if($hid=='15' ){echo "selected";}?> data-select2-id="22">Cancer Service</option>
                    <option value="6" <?php if($hid=='6' ){echo "selected";}?> data-select2-id="22">Pathologist</option>
                  </select>
              </td>
              <td> <a href="<?php echo base_url('husers/edit_hospital_user/'.$hosValues['id'])?>"><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a href="javascript:void(0);" onclick="delete_user('<?php echo $hosValues[" user_group_id "]?>','<?php echo $hosValues["id "]?>');"><i class="fa fa-trash"></i></a> </td>
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
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
              <div class="card mb-4 ac-card">
                <div class="row mb-4">
                  <div class="col-md-12">
                    <button class="btn btn-primary" data-toggle="collapse" data-target="#active-directory-select-container">Active Directory </button>
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
                              <div class="profile-img-wrap edit-img"> <img class="inline-block" id="profile-pic-preview" src="<?php echo base_url('assets/newtheme/img/profiles/avatar-02.jpg'); ?>" alt="user">
                                <div class="fileupload btn">
                                  <san class="btn-text">edit</span>
                                    <input class="upload" type="file" id="profile-pic" name="profile_pic" accept="image/*" /> </div>
                              </div>
                            </div>
                          </div>
                          <!-- User Personal Information START -->
                          <fieldset>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group tg-inputwithicon"> <i class="lnr lnr-user"></i>
                                  <?php //. (array_key_exists('first_name', $user_error) ? 'is-invalid' : '')
                                                    echo form_input(array('type' => 'text', 'name' => 'first_name', 'id' => 'first_name', 'value' => $user_data['first_name'], 'class' => 'form-control ' , 'placeholder' => 'First Name')); ?>
                                    <div class="invalid-feedback"> Please provide a valid name </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group tg-inputwithicon"> <i class="lnr lnr-user"></i>
                                  <?php echo form_input(array('type' => 'text', 'name' => 'last_name', 'id' => 'last_name', 'value' => $user_data['last_name'], 'class' => 'form-control', 'placeholder' => 'Last Name')); ?>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group tg-inputwithicon"> <i class="lnr lnr-apartment"></i>
                                  <?php echo form_input(array('type' => 'text', 'name' => 'company', 'id' => 'company', 'value' => $user_data['company'], 'class' => 'form-control', 'placeholder' => 'Company Name')); ?>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group tg-inputwithicon"> <i class="lnr lnr-phone-handset"></i>
                                  <?php echo form_input(array('type' => 'text', 'name' => 'phone', 'id' => 'phone', 'value' => $user_data['phone'], 'class' => 'form-control', 'placeholder' => 'Phone')); ?>
                                </div>
                              </div>
                            </div>
                            <div class="form-group tg-inputwithicon"> <i class="lnr lnr-envelope"></i>
                              <?php //. (array_key_exists('email', $user_error) ? 'is-invalid' : '')
                                            echo form_input(array('type' => 'text', 'name' => 'email', 'id' => 'email', 'value' => $user_data['email'], 'class' => 'form-control check_email', 'placeholder' => 'Email')); ?> <span id="email_span" style="display: none;color: red"></span>
                                <div class="invalid-feedback">
                                  <?php //echo array_key_exists('email', $user_error) ? $user_error['email'] : ''; ?>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group tg-inputwithicon"> <i class="lnr lnr-lock"></i>
                                  <?php echo form_input(array('type' => 'text', 'name' => 'address1', 'id' => 'address1', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Address 1')); ?>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group tg-inputwithicon"> <i class="lnr lnr-lock"></i>
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
                                <div class="form-group tg-inputwithicon" id="memo-row"> <i class="lnr lnr-apartment"></i>
                                  <?php echo form_input(array('type' => 'text', 'name' => 'company_vat', 'id' => 'company_vat', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Company VAT No', 'maxlength' => 10, 'size' => 10)); ?>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group tg-inputwithicon" id="pin-row"> <i class="lnr lnr-apartment"></i>
                                  <?php echo form_input(array('type' => 'text', 'name' => 'credit_limit', 'id' => 'credit_limit', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Credit Limit Amount', 'maxlength' => 10, 'size' => 10)); ?>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group tg-inputwithicon"> <i class="lnr lnr-lock"></i>
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
                              <button class="btn btn-warning" id="user-form-clear-btn" type="button">Clear </button>
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
function getHostul(role_id = '') {
  if(role_id == 'all') {
    window.location.href = '<?php echo base_url('
    husers / huserlist ')?>';
  } else {
    window.location.href = '<?php echo base_url('
    husers / huserlist ? t = ')?>' + role_id;
  }
}

function import_user(type = '') {
  if(type == 'show') {
    $('#huser_import').attr('disabled');
    $('#open_huser_import').show();
  } else if(type == 'hide') {
    $('#huser_import').attr('enable');
    $('#open_huser_import').hide();
  }
}

function update_group_id(g_id = '', user_id = '', user_group_id = '') {
  var cct = $.cookie("<?php echo $this->config->item("
    csrf_cookie_name "); ?>");
  $.ajax({
    url: '<?php echo base_url('
    husers / update_group_id '); ?>',
    type: 'POST',
    global: false,
    dataType: 'json',
    beforeSend: function() {
      /*$.sticky('Please wait we are redirecting......', {
          classList: 'success',
          speed: 'slow'
        });*/
    },
    complete: function() {},
    data: {
      'user_id': user_id,
      'user_group_id': user_group_id,
      'g_id': g_id,
      '<?php echo $this->security->get_csrf_token_name(); ?>': cct
    },
    success: function(data) {
      if(data.type === 'success') {
        $.sticky(data.msg, {
          classList: 'success',
          speed: 200,
          autoclose: 7000
        });
        setTimeout(function() {
          location.reload();
        }, 500);
      }
    }
  });
}

function add_customer(group_id, group_type) {
  setTimeout(function() {
    $.get(_base_url + 'institute/get_active_directory_users?type=' + group_type, function(data) {
      $("#active-directory-select-container").empty();
      var template = $(`<select id="active-directory-select" class="select">
        </select>`);
      if(data.length === 0) {
        template = $('<p>Active directory empty for this group</p>');
      }
      for(let i = 0; i < data.length; i++) {
        var user = data[i];
        template.append(`<option value="${user.id}">${user.first_name} ${user.last_name}</option>`);
      }
      console.log(template);
      $("#active-directory-select-container").append(template);
      $("#active-directory-select").select2({
        width: '100%'
      });
      $("#active-directory-select").on('select2:select', function() {
        var user_id = $(this).val();
        $('input[name="active_directory_user"]').val(user_id);
        $.get(_base_url + 'institute/get_user_details?id=' + user_id, function(data) {
          //$("#password-row").hide();
          //$("#memo-row").hide();
          $("#email").prop('readonly', true);
          $("#first_name").val(data['first_name']);
          $("#last_name").val(data['last_name']);
          $("#company").val(data['company']);
          $("#phone").val(data['phone']);
          $("#email").val(data['email']);
          if(!(data['profile_picture'] === null || data['profile_picture'].length === 0)) {
            $("#profile-pic").val('');
            $("#profile-pic-preview").attr('src', _base_url + data['profile_picture']);
          }
        });
      });
      $("#user_group_type").val(group_type);
      $("#add-user-modal").modal('show');
    });
  }, 500);
}

function delete_user(group_id = '', user_id = '') {
  var r = confirm('Are you sure you want to remove');
  if(r) {
    $.get(_base_url + 'husers/remove_hos_users?group_id=' + group_id + '&&user_id=' + user_id, function(data) {
      if(data) {
        location.reload();
      }
    });
  }
}
</script>