<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
  div.dataTables_wrapper div.dataTables_length select {
    position: absolute;
    /* top:-125px; */
    height: 35px !important;
    width: 50px !important;
    left: 15px;
    padding:0;
  }
  .input-group-btn{
    right: 26px;
    z-index: 999;
  }
  .form-focus .form-control {
    height: 36px;
    padding: 0 12px;
  }
  .btn-default{
    background: #f5f5f5 !important;
  }
  .breadcrumb{padding: 0 !important}

  .tg-cancel input{
    display: none;
  }

  .tg-cancel label i {
    color: red;
  }

  .tg-cancel label {
    cursor: pointer;
    margin-bottom: 0;
    width: 45px;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 50%;
  }
  .table .dropdown-action .dropdown-menu{
    min-width: 90px;
  }
  .table .dropdown-action .dropdown-menu .dropdown-item{
    font-size: 14px;
  }
  .header .tg-searchrecord fieldset .form-group .form-control{
    
    height: 44px !important;
}
  .tg-inputicon i{
    top: 9px !important;
  }
    /*.flags_check span.tg-radio {
        display: none;
    }
    .flags_check span.tg-radio.first {
        display: block;
    }*/


  .ui-selectmenu-menu .ui-menu.customicons .ui-menu-item-wrapper {
      padding: 0.5em 0 0.5em 3em;
  }
  .ui-selectmenu-menu .ui-menu.customicons .ui-menu-item .ui-icon {
      height: 24px;
      width: 24px;
      top: 0.1em;
  }
  /* select with CSS avatar icons */
  option.avatar {
      background-repeat: no-repeat !important;
      padding-left: 20px;
  }
  .avatar .ui-icon {
      background-position: left top;
  }


    td img.doctor-pic {
        display: block;
        width: 35px;
        height: 35px;
        background: #1b75cd;
        color: #ffffff;
        text-align: center;
        border-radius: 50%;
        line-height: 15px;
        font-size: 8px;
        letter-spacing: -1px;
    }
    td a.hospital_initials {
      display: block;
      width: 30px;
      height: 30px;
      background: #1b75cd;
      color: #ffffff;
      text-align: center;
      border-radius: 50%;
      line-height: 30px;
      font-size: 11px;
      letter-spacing: -1px;
    }
    
    @media screen and (min-width: 1600px) {
      body{font-size: 18px;}
      .table .dropdown-action .dropdown-menu .dropdown-item{
        font-size: 16px;
      }
    }
    @media screen and (max-width: 1580px) {
      .tg-cancel label {
        width: 35px;
        padding: 5px;
      }
      div.dataTables_wrapper div.dataTables_length select{
        /* top: -125px; */
      }
    }
    ol.breadcrumb{float: left;}
    .form-focus .select2-container .select2-selection--single{
      height: 40px;
    }
    .form-focus .select2-container--default .select2-selection--single .select2-selection__arrow{
      height: 38px;
    }

    .form-focus .select2-container .select2-selection--single .select2-selection__rendered{
      padding-top: 0;
    }

    .tg-filterhold, .tg-breadcrumbarea{
      position: relative;
      
    }
    
    div.dataTables_wrapper div.dataTables_length select{
      margin-top:-10px;
    }

    #doctor_record_list_table_wrapper{
      padding: 0 15px;
    }

    .success_list {
        margin: 15px 0px;
        background-color: lightgreen;
        color: white;
        padding: 10px;
        border-radius: 5px;
    }
    #doctor_record_list_table_wrapper .row:nth-child(2){
      margin-left: 0;
    }
	
	
  #doctor_record_list_table_wrapper .row:nth-child(2) .col-sm-12{
      padding: 0;
      margin-top: 10px;
    }
    #doctor_record_list_table_wrapper .row .col-sm-12.col-md-6{ 
      width: 40%;
    }

    div.dataTables_wrapper div.dataTables_filter input{
    border-radius: 4px;
    height: 37px !important;
}
#doctor_record_list_table_filter:before {
    content: "\f002";
    position: absolute;
    right: 15px;
    top: 0;
    bottom: 0;
    width: 40px;
    height: 37px;
    z-index: 9;
    background: #55ce63;
    text-align: center;
    line-height: 34px;
    color: #fff;
    font-family: 'FontAwesome';
    cursor: pointer;
}

.list-track {
    list-style: none;
}
.list-track li {
    display: inline-block;
    padding-left: 8px;
    margin: 0px!important;
    padding-bottom: 15px;
}
.list-track li i {
    fill: #56c0ef;
    vertical-align: middle;
    padding: 2px;
    color: #56c0ef;
    width: 25px;
    text-align: center;
    font-size: 20px;
}
.list-track li svg {
    width: 25px;
    height: 25px;
    fill: #56c0ef;
    vertical-align: middle;
    padding: 2px;
}

.list-track li a {
    border-radius: 50px;
    border: 1px solid #56c0ef;
    padding: 8px 5px;
}
.dataTables_wrapper.dt-bootstrap4.no-footer #doctor_record_list_table_length {
    position: absolute;
    right: auto;
    z-index: 9999;
    left: 40%;
}
.tg-statusbar.tg-flagcolor .tg-checkboxgroup .tg-radio label {
    margin: 0 2px;
}
.tg-filters > li {
    display: inline-block;
    vertical-align: text-top;
    float:none;
} 
.tg-filters {
    float: none;
    list-style: none;
    text-align: end;
} 
.track-item {
    position: relative;
    float: left;
    width: 60%;
}
.tg-flagcolor .tg-radio input[type=radio] + label:before {
    width: 38px;
    height: 38px;
}
.list-track li .active {
    border: 1px solid #fff;
    background: #56c0ef;
}
.list-track li .active svg{
  fill:#fff;
}
input.form-control.form-control-sm {
    visibility: visible;
}
div#doctor_record_list_table_filter label {
    visibility: hidden;
}
.three-dot span i { 
    position: relative;
    top: 5px;
}
table#doctor_record_list_table tbody tr td.flag_column div img{
  width: 18px !important;
}

#class1-container {
    float: left;
    width: 100%;
    margin: -5px 0 0;
    padding: 0;
}
#class1-container span {
  top: -21px;
    left: 42px;
    margin: 0 5px;
    width: auto;
    float: left;
    height: auto;
    position: relative;
}
table#doctor_record_list_table tbody tr td.flag_column div img.vslideico {
    width: 15px !important;
    margin-left: 18px;
    top: -5px;
    position: relative;
}
table#doctor_record_list_table tbody tr td.flag_column div img {
    width: 22px !important;
    margin-left: 7px;
}
table#doctor_record_list_table tbody tr td.flag_column div {
  width: 30px;
    height: 30px;
    max-width:20px;
    background-size: 20px 20px;
}
.custom_badge_tat .bg-danger{
  background: #ee971f!important;
}
.hostipal-icon {
    width: 35px!important;
    height: 35px!important;
    font-size: 14px!important;
    line-height: 38px!important;
}
.bg-success, .badge-success {
    color: #ffff;
}
li.tg-flagcolor{
    padding: 3px 0px!important;
}
#doctor_record_list_table .status_up {
    width: 100px!important;
    text-align: left!important;
}
#doctor_record_list_table td img.doctor-pic{
  margin:auto;
}
span.icon-try {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    margin-top: 15px;
}
#doctor_record_list_table thead tr .text-center img {
    min-width: 25px;
    max-width: 25px;
    margin-right: 5px;
}
  </style>
  <div class="clearfix"></div>
  <div class="container-fluid">
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style=" margin-bottom: 15px;">
      <h3 class="page-title">Records</h3>  
      <ol class="tg-breadcrumb tg-breadcrumbvtwo">     
                <li><a href="javascript:;">Dashboard</a></li>
                <li class="active">Records List</li>
            </ol>     
    </div>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
    <div class="tg-haslayout" style="display:none">
     <div class="tg-filterhold" style="padding: 0;">
     <ul class="tg-filters record-list-filters"> 
     <li class="tg-statusbar tg-flagcolor" style="margin-top: 25px;">
                        <div class="tg-checkboxgroup tg-checkboxgroupvtwo">
                          <?php $hospitals = getAllHospitals(); ?>
                          <?php foreach($hospitals as $hospital): ?>
                            <span title="<?php echo $hospital['description']?>" class="tg-radio tg-flagcolor1">
                              <input value="<?php echo $hospital['first_initial']?><?php echo $hospital['last_initial']?>" class="filter_by_hospital_btn" name="hostpital" id="<?php echo $hospital['first_initial']?><?php echo $hospital['last_initial']?>"  type="radio">
                              <label for="<?php echo $hospital['first_initial']?><?php echo $hospital['last_initial']?>"><span><?php echo $hospital['first_initial']?><?php echo $hospital['last_initial']?></span></label>
                            </span>
                          <?php endforeach; ?>
                          <span title="All" class="tg-cancel tg-flagcolor1" style="display: none;">
                            <input value="0" class="filter_by_hospital_btn" name="hostpital" id="aa"  type="radio">
                            <label for="aa"><span><img src="<?php echo base_url();?>assets/img/clearAll.png" class="img-responsive clearAll"></span></label>
                          </span>
                          <span title="" class="tg-radio tg-flagcolor1 three-dot">
                              <label><span> <i class="material-icons">more_vert</i></span></label>
                            </span>
                        </div>
                      </li>
                     
</ul>
                          </div>
                          </div>
  
    </div> 
    <!-- <div class="tg-haslayout">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="tg-breadcrumbarea tg-searchrecordhold">
            <?php echo $breadcrumbs; ?>
            
          </div>
        </div>
      </div>
    </div> -->

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="tg-dashboardform tg-haslayout custom-haslayout">
      <div class="collapse" id="collapse_adv_search">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="tg-dashboardformhold">
              <form class="tg-formtheme" action="<?php echo base_url('index.php/doctor/search_request'); ?>" method="post">
                <fieldset class="col-md-12">
                  <div class="col-md-3 form-group">
                    <input class="form-control" type="text" id="adv_search_first_name" name="first_name" placeholder="First Name" value="<?php echo $sr_first_name; ?>" >
                  </div>
                  <div class="col-md-3  form-group">
                    <input class="form-control" type="text" id="adv_search_sur_name" name="sur_name" placeholder="Last Name" value="<?php echo $sr_sur_name; ?>" >
                  </div>
                  <div class="col-md-3 form-group">
                    <input class="form-control" type="text" id="adv_search_nhs_no" name="nhs_no" placeholder="NHS Number" value="<?php echo $sr_nhs_no; ?>" >
                  </div>
                  <div class="col-md-3 form-group">
                    <span class="tg-select">
                      <select data-placeholder="Gender" id="adv_search_gender" name="gender">
                        <option value="">Gender</option>
                        <option value="male" <?php echo (($sr_gender == 'male'?'selected':'')); ?> >Male</option>
                        <option value="female"  <?php echo (($sr_gender == 'female'?'selected':'')); ?>>Female</option>
                      </select>
                    </span>
                  </div>

                </fieldset>
                <fieldset class="col-md-12" style="padding-top: 10px !important;">
                  <div class="col-md-3 form-group tg-inputicon">
                    <i class="lnr lnr-calendar-full"></i>
                    <input type="text" name="dob" id="adv_search_dob" class="form-control unstyled" placeholder="DOB" value="<?php echo $sr_dob; ?>" >
                  </div>
                  <div class="col-md-3 form-group ">
                    <input type="text" name="" class="form-control" placeholder="Track No">
                  </div>
                  <div class="col-md-3 form-group ">
                    <input type="text" name="" class="form-control" placeholder="Lab No">
                  </div>

                  <div class="col-md-3 form-group ">
                    <span class="tg-select">
                      <select id="adv_search_speciality" data-placeholder="Speciality" name="specialty">
                        <option value="">Speciality</option>
                        <?php foreach($get_specialties as $spec){ ?>
                          <option value="<?php echo $spec['specialty']; ?>" <?php echo (($spec['id'] == $sr_specialty?'selected':'')); ?> > <?php echo $spec['specialty']; ?> </option>
                        <?php } ?>
                      </select>
                    </span>
                  </div>
                  <div class="col-md-3 form-group">
                    <input type="hidden" name="speciality_group_hdn" value="<?php echo $speciality_group_hdn; ?>">
                    <button type="submit" class="btn btn-success btn-search">Advance Search</button>
                  </div>

                </fieldset>

              </form>
            </div>
          </div>
        </div>
      </div>
      <div id="collapse_filter_hospital" class="collapse">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-push-2">
            <div class="tg-dashboardformhold">
              <div class="tg-titlevtwo">
                <h3>Filter By Clinic</h3>
              </div>
              <form method="post" class="filter_by_hospital_form">
                <table class="table table-bordered">
                  <tr class="bg-primary">
                    <th>Choose Clinic</th>
                  </tr>
                  <tr>
                    <td class="col-md-12">
                      <select class="form-control filter_by_hospital" name="filter_by_hospital">
                        <option value="0">Choose Clinic</option>
                        <?php
                        if (!empty($get_hospitals)) {
                          foreach ($get_hospitals as $list_hospitals) {

                            echo '<option value="' . $list_hospitals->id . '" >' . $list_hospitals->description . '</option>';
                          }
                        }
                        ?>
                      </select>
                    </td>
                  </tr>
                </table>
                <div class="pull-right">
                  <button type="button" class="btn btn-warning filter_by_hospital_btn">Filter Result</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>

    
      <div class="col-md-12">
        <?php
        if (isset($_GET['msg']) && $_GET['msg'] == 'success') {

          echo '<p class="bg-success" style="padding:7px;">Report Has Been Successfully Published.</p>';
        }
        if ($this->session->flashdata('unpublish_record_message') != '') {
          echo $this->session->flashdata('unpublish_record_message');
        }
        ?>
        <?php
        if ($this->session->flashdata('record_status') != '') {
          echo $this->session->flashdata('record_status');
        }
        ?>
      </div>
    

      <?php if ($this->session->flashdata('success') != '') { ?>
          <div class="success_list" style="color: green;">
              <?= $this->session->flashdata('success'); ?>
          </div>
      <?php } ?>

    <div class="report_listing" id="report-list-table" >
      <div class="col-md-12">
        <!-- <div class="flag_message"></div> -->
        <?php echo form_open("admin/display_all", array('id' => 'assign_doc_form')); ?>
        <div class="col-sm-2 col-md-2" style="padding-left: 0;">  
          <div class="form-group form-focus select-focus">
            <!-- <select class="form-control select2" name="doctors" id="select_assign_doctor">
              <option value="">Choose Pathologist</option>
                <?php foreach ($doctor_list as $doctors) : ?>
                    <option value="<?php echo $doctors->id; ?>" title="<?php echo $doctors->profile_picture_path; ?>">
                        <?php echo $doctors->first_name; ?> <?php echo $doctors->last_name; ?>
                    </option>
                <?php endforeach; ?>
            </select> -->
              <!--<fieldset>
                  <select class="form-control" name="doctors" id="doctors">
                      <option value="">Choose Pathologist</option>
                      <?php /*foreach ($doctor_list as $doctors) { */?>
                      <option value="<?/*= $doctors->id; */?>" data-class="avatar" data-style="background-image: url(&apos;http://www.gravatar.com/avatar/b3e04a46e85ad3e165d66f5d927eb609?d=monsterid&amp;r=g&amp;s=16&apos;);">
                          <img class="doctor-pic" src="<?/*= get_profile_picture($doctors->profile_picture_path, $doctors->first_name, $doctors->last_name); */?>">
                          <?/*= $doctors->first_name.' '.$doctors->last_name; */?>
                      </option>
                      <?php /*} */?>
                      <option value="3" data-class="avatar" data-style="background-image: url(https://www.kindpng.com/picc/m/252-2524695_dummy-profile-image-jpg-hd-png-download.png);">Jane Doe</option>
                  </select>
              </fieldset>-->


            <div style="display: none;">
             <?php //print_r($doctor_list); ?>          
             <select class="form-control select2" name="doctors" id="select_assign_doctor">
              <option value="">Choose Pathologist</option>
                <?php foreach ($doctor_list as $doctors) : ?>
                    <option value="<?php echo $doctors->id; ?>" title="<?php echo $doctors->profile_picture_path; ?>">
                        <?php echo $doctors->first_name; ?> <?php echo $doctors->last_name; ?>
                    </option>
                <?php endforeach; ?>
            </select>

          </div>
        </div>
        </div>
        <!-- <div class="col-sm-1 col-md-1" style="padding-left: 0;">
          <div class="form-group">
            <button type="button" id="assign_btn" class="btn btn-primary" onClick="assignDoctor()" style="padding: 8px 12px;">Assign</button>
          </div>
        </div> -->

        <div class="col-sm-2 col-md-2" style="padding-left: 0;">  
          <div class="form-group form-focus select-focus">
            <!-- <select class="form-control select2" name="couriers" id="select_assign_couriers">
            <option value="">Choose Courier</option>
            <option value="">Select Courier</option>
                    <?php
                foreach ($courier_data as $courier_l) {
                    //$snomed_t = strtolower(str_replace(' ', '', trim($snomed_t_code['usmdcode_code'])));
                    ?>
                    <option value="<?= $courier_l->id; ?>" data-id="<?= $courier_l->id; ?>"><?= $courier_l->courier_no; ?> / <?= date('y-m-d',strtotime($courier_l->courier_sent_at)); ?></option>
                <?php } ?>
            </select> -->
        </div>
        </div>
        <div class="col-sm-1 col-md-1" style="padding-left: 0;">
          <div class="form-group">
            <!-- <button type="button" id="assignCourier_btn" class="btn btn-primary" onClick="assignCourier()" style="padding: 8px 12px;">Assign</button> -->
          </div>
        </div>

        <div class="col-sm-6 col-md-6" style="padding-right:0; padding-left:0;" style="display:none">
          <div class="tg-haslayout" >
          <div class="tg-filterhold" style="padding: 0;">
              <ul class="tg-filters record-list-filters">              
                <li class="tg-statusbar tg-flagcolor" style="padding: 5px; margin-left: 0;">
                  <div class="tg-checkboxgroup tg-checkboxgroupvtwo numbers_check">
                    <span class="tg-radio tg-flagcolor1">
                      <input class="tat" name="tat" id="tat5"  type="radio">
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
                    <?php
                    if ($this->session->userdata('color_code') !== '') {
                      $session_color = $this->session->userdata('color_code');
                    }
                    ?>
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
                      <input checked type="radio" class="flag_status"  name="flag_sorting" id="flag_all">
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

                        <img src="<?php echo base_url('/assets/icons/Urgent-wb.png'); ?>" class="img-responsive uncheck">
                        <img src="<?php echo base_url('/assets/icons/white/Urgent-wb-white.png'); ?>" class="img-responsive checkd">
                      </label>
                    </span>

                    <span class="tg-radio tg-flagcolor4" title="Routine">
                      <input id="report_routine" class="report_urgency_status" type="radio" name="report_urgency">
                      <label for="report_routine">
                        <img src="<?php echo base_url('/assets/icons/Rotate.png'); ?>" class="img-responsive uncheck">
                        <img src="<?php echo base_url('/assets/icons/white/Rotate-white.png'); ?>" class="img-responsive checkd">
                      </label>
                    </span>

                    <span class="tg-radio tg-flagcolor4" title="2WW">
                      <input id="report_2ww" class="report_urgency_status" type="radio" name="report_urgency">
                      <label for="report_2ww">
                        <img src="<?php echo base_url('/assets/icons/2ww-wc.png'); ?>" class="img-responsive uncheck">
                        <img src="<?php echo base_url('/assets/icons/white/2ww-wc-white.png'); ?>" class="img-responsive checkd">
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
                <li class="tg-statusbar tg-flagcolor custome-flagcolors last pull-right" style="padding: 0 10px; display:none">                              
                  <button type="submit" class="btn btn-default adv-search" data-toggle="collapse" data-target="#collapse_adv_search"><i class="fa fa-cog"></i></button>
                </li>
                <li class="tg-statusbar tg-flagcolor custome-flagcolors pull-right nobefore search_li" style="padding: 0; display:none">
                  <div class="input-group">
                    <input id="unpub_custom_filter" type="text" class="form-control" placeholder="Search">
                    <div class="input-group-btn">
                      <button class="btn btn-success" type="submit">
                        <i class="glyphicon glyphicon-search"></i>
                      </button>
                    </div>
                  </div>
                </li>

              </ul>
            </div>
          </div>
        </div>
      </div>

 <div class="clearfix"></div>
<div class="container-fluid track-item">
<div class="row" style="">
  <div class="col-sm-12">
  <ul class="list-track">
    <li><a href="#" class="filter_by_status_btn" title="Reset All"><i class="fa fa-refresh" aria-hidden="true"></i></a></li>
   <li>
      <a href="#" class="filter_by_status_btn" data-toggle="collapse" title="Lab Entry" ><svg x="0px" y="0px" width="45.5px" height="40.9px" viewBox="0 0 45.5 40.9"><path d="M37.1,28.5v-6.9c-0.1-0.1-0.2-0.1-0.3-0.2c-0.5-0.3-0.7-0.9-0.5-1.4c0.1-0.5,0.6-0.9,1.1-0.9c1.1,0,2.3,0,3.4,0
  c0.5,0,0.9,0.4,1.1,0.9c0.2,0.5,0,1-0.4,1.4c-0.1,0.1-0.2,0.2-0.3,0.3v6.9c1.9,0.7,3.3,2,3.9,4c0.5,1.3,0.5,2.7,0.1,4
  c-0.8,2.3-3.3,4.6-6.7,4.3c-2.8-0.3-5.1-2.4-5.6-5.1C32.3,32.9,33.7,29.7,37.1,28.5 M37.8,29c-1.4,0.3-2.5,1.1-3.4,2.2
  c-0.8,1.2-1.2,2.5-1,3.9c0.4,3,2.6,4.8,5,5c2.7,0.3,5.2-1.3,6-3.9c0.4-1.2,0.4-2.4,0-3.6c-0.7-1.9-2.1-3.1-4-3.7v-7.7
  c0.1,0,0.1-0.1,0.2-0.1c0.5-0.3,0.6-0.6,0.5-1.1c-0.1-0.4-0.4-0.6-0.9-0.6c-0.4,0-0.8,0-1.2,0c-0.5,0-0.9,0-1.4,0
  c-0.5,0.1-0.8,0.4-0.7,0.9c0,0.4,0.3,0.7,0.9,0.8C37.8,21.1,37.8,29,37.8,29z M39,32.2c1.6,0,3,0.4,4.2,1.1c0.9,0.5,1.1,0.9,1,2
  c-0.2,1.2-0.6,2.2-1.4,3c-0.7,0.7-1.5,1.2-2.5,1.4c-1.3,0.3-2.5,0.2-3.6-0.4c-1.7-0.9-2.6-2.3-2.8-4.2c0-0.5,0.1-0.9,0.6-1.2
  c1.1-0.8,2.4-1.3,3.8-1.5C38.5,32.2,38.9,32.2,39,32.2 M38.5,38.3c0.6,0,0.9-0.4,0.9-0.9s-0.4-0.9-0.9-0.9s-1,0.4-1,0.9
  C37.6,37.9,37.9,38.3,38.5,38.3 M41.4,35.9c0-0.4-0.3-0.8-0.7-0.8c-0.5,0-0.8,0.3-0.9,0.7c0,0.5,0.3,0.8,0.8,0.9
  C41,36.7,41.4,36.3,41.4,35.9 M39.4,23.6c0.3,0,0.5,0.3,0.5,0.6c0,0.3-0.3,0.6-0.5,0.6c-0.3,0-0.6-0.3-0.6-0.6
  C38.8,23.9,39.1,23.6,39.4,23.6 M31.5,36.1c0.2,1.1,0.7,2.2,1.4,3.1c-2,0.4-4,0.5-6,0.7c-3.9,0.3-7.8,0.2-11.6,0.1
  c-3.3-0.1-6.6-0.3-9.8-1.1c-1.3-0.3-2.5-0.7-3.6-1.5C1,36.8,0.6,35.9,0.3,35c-0.1-0.2,0-0.4-0.1-0.5c-0.6-2.6,0.5-4.4,2.7-5.7
  c2-1.2,4.1-1.9,6.4-2.4c1.3-0.3,2.6-0.5,3.9-0.7c2.3,2.1,4.4,4.1,6.6,6.2c2.2-2.1,4.4-4.1,6.6-6.2c1,0.2,2.1,0.3,3.2,0.6
  c1.9,0.4,3.7,1,5.4,1.8h0.1C32.4,29.7,30.9,32.9,31.5,36.1 M30.9,11c0.2,5.4-4.2,11.1-11.1,11.1S8.6,16.4,8.6,11
  C8.7,4.9,13.5,0,19.7,0C26.7,0,31,5.7,30.9,11"></path></svg></a>
   </li>
   <li>
   <a href="#" class="filter_by_status_btn" title="Specimen Labelling"><svg x="0px" y="0px" width="39.2px" height="39.3px" viewBox="0 0 39.2 39.3">
                    <path d="M38.8,12.8L26.4,0.4c-0.5-0.5-1.4-0.6-2,0c-0.6,0.6-0.6,1.4,0,2l1,1l-12,12c-8.5,8.8-12,12.3-12.3,12.7
  c-1.7,2.7-1.4,6.4,0.8,8.8c1,1.1,2.4,1.9,3.8,2.2c0.8,0.2,2.4,0.2,3.1,0c0.9-0.2,1.7-0.5,2.4-1c0.5-0.3,3.2-3,12.6-12.3l11.9-11.9
  l1,1c0.5,0.6,1.4,0.6,2,0c0,0,0,0,0.1-0.1C39.3,14.2,39.3,13.4,38.8,12.8z M21.8,23.7c-9,9-12,11.9-12.4,12.1
  C8.6,36.2,8,36.4,7,36.3c-0.8,0-0.9-0.1-1.6-0.4C4.6,35.5,4,35,3.6,34.3c-0.9-1.4-0.9-2.9-0.2-4.5c0.2-0.4,2.7-3,12.1-12.4
  C22,10.9,27.4,5.5,27.4,5.5C27.6,5.6,29,7,30.6,8.7l3.1,3.1L21.8,23.7z M20.7,18.7h5l-8,8c-5.8,5.8-8.2,8.1-8.6,8.3
  c-0.7,0.4-2,0.5-2.8,0.2c-0.7-0.3-1.6-1.1-2-1.8C4,33,4,32.8,4,31.9c0-0.8,0.1-1.1,0.3-1.5c0.2-0.4,1.5-1.7,5.8-6.1l5.6-5.6H20.7z"></path></svg></a>
   </li>
   <li>
   <a href="#" class="filter_by_status_btn" title="Cut up / Grossing"><svg x="0px" y="0px" width="38.3px" height="40px" viewBox="0 0 38.3 40">
 <path d="M21.8,33.6c1-3.6,2.1-7.1,3.1-10.7c2.7,0.3,5.2,1.2,7.4,2.7c2.7,1.8,4.6,4.1,5.5,7.2c0.2,0.8,0.4,1.7,0.4,2.6
  c0.1,1.3,0,2.6,0,3.8c0,0.3,0,0.5,0,0.8H5.3c-0.1,0-0.1-0.1-0.1-0.1c0-2.2-0.3-4.5,0.3-6.7c0.9-3.5,3.1-6.1,6.2-7.9
  c1.9-1.2,4-1.9,6.2-2.3c0.5-0.1,0.7,0,0.8,0.5c0.9,3.2,1.8,6.4,2.8,9.6c0.1,0.2,0.1,0.4,0.2,0.6C21.7,33.7,21.7,33.7,21.8,33.6
   M30.8,4.7c0,0.4,0,0.9,0,1.3c0,0.7,0.1,1.3,0.5,1.9c1.1,1.9,0.3,4.2-1.1,4.9c-0.3,0.2-0.4,0.5-0.6,0.8c-0.7,1.7-1.4,3.5-2.1,5.2
  c-0.2,0.5-0.6,1-0.9,1.5c-1.7,2.6-4.2,3-7.1,2.2c-0.8-0.2-1.4-0.7-2-1.3c-1.3-1.4-2.1-3.1-2.8-4.8c-0.3-0.9-0.6-1.9-1-2.8
  c-0.1-0.3-0.3-0.6-0.6-0.8c-1.7-1-2-3.6-1.1-5c0.3-0.5,0.4-1.1,0.4-1.7c0-1.1,0-2.2,0-3.4c0-0.5,0.1-0.8,0.6-1
  c3.2-1.3,6.5-1.9,9.9-1.6c2.4,0.2,4.7,0.7,6.9,1.5c0.8,0.3,0.8,0.3,0.8,1.1C30.8,3.6,30.8,4.1,30.8,4.7 M18.7,15.6
  c-0.1-1.3,0.6-2,1.6-2.3c1.1-0.3,2.2-0.3,3.2,0.1c0.5,0.2,0.9,0.6,1.1,1.1c0.1,0.3,0.1,0.7,0.4,0.9c0.3,0.2,0.7,0.1,1,0.1
  c0.2,0,0.4,0,0.6,0c0.5,0.1,0.8-0.2,0.9-0.7c0.2-0.8,0.5-1.6,0.8-2.4c0.1-0.5,0.3-0.8,0.8-0.9c0.3-0.1,0.7-0.4,0.8-0.8
  c0.7-1.3-0.1-2.6-1.6-2.9c-3.8-0.6-7.6-0.7-11.5-0.3c-0.8,0.1-1.5,0.2-2.3,0.4s-1.2,0.9-1.2,1.8c0,0.9,0.4,1.5,1.1,1.7
  c0.4,0.1,0.6,0.3,0.7,0.7c0.3,0.9,0.6,1.9,0.9,2.8c0.1,0.3,0.2,0.5,0.6,0.5C17.2,15.6,17.9,15.6,18.7,15.6 M17,17.3
  c0.9,2.8,2.7,4.2,5.4,4c1.7-0.1,3.7-2.1,4-4h-1.6c0,1.1-0.6,1.8-1.5,2.1c-1,0.3-2.1,0.3-3.1,0c-0.7-0.2-1.3-0.6-1.4-1.4
  c-0.1-0.6-0.3-0.7-0.8-0.7C17.7,17.3,17.4,17.3,17,17.3 M0.1,27.8c0-3.3,0-6.7,0-10c0-0.6,0.2-1.2,0.7-1.6c0.4-0.4,0.6-1,0.3-1.5
  c-0.9-1.6-1.1-3.3-1-5C0.2,8.1,0.5,6.6,0.7,5c0.1-0.4,0.2-0.7,0.4-1c0.6-1.1,1.3-1.2,2-0.2c0.3,0.3,0.5,0.7,0.7,1.1
  C4.5,6.5,5,8.2,5.2,10c0.2,1.4-0.3,2.6-1.5,3.4c-0.8,0.6-1,1.3-0.9,2.2c0,0.2,0.1,0.4,0.3,0.5c0.7,0.5,0.8,1.2,0.8,2.1
  c0,4.5,0,9,0,13.4c0,1.9,0,3.7,0,5.6c0,0.3,0,0.6,0,1c-0.1,1-1,1.7-2,1.7c-0.9,0-1.8-0.8-1.9-1.8S0,36,0,35
  C0.1,32.6,0.1,30.2,0.1,27.8L0.1,27.8z"></path></svg></a>
   </li>
   <li>
   <a href="#" class="filter_by_status_btn" title="Embedding & Microtomy"><svg x="0px" y="0px" width="43.8px" height="33.3px" viewBox="0 0 43.8 33.3">
                    <path d="M13.8,24.3c-2.5-6.5-5-12.9-7.5-19.3C4.2,4.6,2.2,4.2,0,3.8c0.1,6.9,0.2,13.5,0.4,20.3c5.9,2,11.8,4,17.9,6
  c0.3-1.5,0.5-2.7,0.7-4.1C17.2,25.5,15.6,24.9,13.8,24.3 M4.7,20.1c-1.7,0-3-1.5-3-3.3c0-0.2,0-0.4,0.1-0.6c0.3-1.5,1.5-2.7,2.9-2.7
  c0.5,0,0.9,0.1,1.3,0.3c1,0.5,1.7,1.7,1.7,3C7.7,18.6,6.3,20.1,4.7,20.1 M17.3,22.9c3.5,1.3,6.8,2.6,10.2,3.9c3-1.3,6-2.5,9.1-3.8
  c-0.6-0.5-0.9-0.9-1.3-1.2c0-0.1,0.1-0.2,0.1-0.3c1.7,0,3.2,0.7,4.9,1.4c-4.3,1.8-8.5,3.5-12.8,5.3c-4.4-1.4-8.8-2.8-13.3-4.2
  c-2.4-6.2-4.8-12.4-7.3-18.9C8,4.9,9,4.6,10.1,4.4C12.5,10.6,14.9,16.7,17.3,22.9 M22.7,18.4v2.2c-1.6,0.5-3.1,1-4.8,1.5V7.7
  c3.5-0.8,7-1.7,10.5-2.5c0.4,3,0.7,5.7,1.1,8.4c-2.9,1.4-4.1,1.6-4.9,0.9c1.2-0.3,2.5-0.5,3.8-0.8V9.5c-1.8-0.1-3.5-0.4-5.3-0.4
  c-1.3,0-2.1,0.9-2.2,2.2c-0.1,1.8-0.1,3.6-0.1,5.3C20.6,18,21.6,18.3,22.7,18.4 M43.8,26.7C38.3,28.9,33,31,27.4,33.2
  c0.1-1.7,0.2-3.1,0.4-4.6c4.5-1.9,9.1-3.8,13.9-5.8C42.3,24,43,25.2,43.8,26.7 M25.6,3.2c-1.6,0.4-3,0.6-4.3,1.1
  c-3.1,1-6.1,1.1-9.1-0.1C11.1,3.8,9.8,3.6,8.6,4C6.4,4.7,4.3,4,1.8,3.4c0.7-0.3,1-0.5,1.4-0.6C6.5,1.9,9.7,1.1,13,0.2
  c0.6-0.1,1.2-0.3,1.8-0.1c3.4,0.8,6.8,1.7,10.2,2.6C25.2,2.8,25.3,3,25.6,3.2 M10.7,4.4c2.2,0.5,4,1,5.9,1.4
  c0.2,0.8,0.6,1.6,0.6,2.4c0.1,4,0,8,0,12c-0.1,0-0.2,0.1-0.3,0.1C14.9,15.2,12.9,10,10.7,4.4 M19.6,26.2c2.6,0.8,5,1.6,7.5,2.3
  c-0.1,1.5-0.2,3-0.3,4.8c-2.8-1-5.4-2.1-7.9-2.9C19.2,28.8,19.3,28,19.6,26.2 M35.1,23c-2.5,1-4.8,2-7.4,3.1
  c-0.1-1.8-0.2-3.3-0.3-5.1c2.1-0.6,4.2-1.3,6.3-1.9C34.2,20.4,34.7,21.6,35.1,23 M18.3,22.7c2.9-1.3,5.6-1.6,8.6-1.6v4.8
  C24,24.9,21.3,23.9,18.3,22.7 M23.4,20.9v-4.5c0.7-0.2,1.4-0.5,2.3-0.8c1,1.5,1.9,2.8,3,4.5C26.8,20.4,25.2,20.6,23.4,20.9
   M17.8,7.2c-0.2-0.5-0.4-0.8-0.7-1.3c3.6-0.8,7-1.6,10.5-2.4c0.2,0.4,0.4,0.7,0.6,1.2C24.7,5.5,21.3,6.3,17.8,7.2 M26,11.2
  c-0.1,0.8-0.2,1.3-0.3,2c-1.5-0.1-2.8-0.2-4.3-0.3v-2.1C22.9,10.9,24.3,11.1,26,11.2 M29.7,14.6c0.7-0.1,1.1-0.2,1.7-0.3
  c0.4,0.7,0.8,1.3,1.2,2c0.4,0.6,0.7,1.2,1.1,1.9c-0.5,0.2-0.8,0.4-1.3,0.6C31.5,17.4,30.7,16.1,29.7,14.6 M21.4,14.2h2.2
  c-0.5,1.3-0.9,2.4-1.4,3.5C20.9,17,20.7,16.3,21.4,14.2 M22.3,9.9c1.8-0.4,3.6-0.2,5.8,0.3C26.6,10.8,24.1,10.7,22.3,9.9 M27.8,11.2
  v2c-0.4,0.1-0.8,0.2-1.4,0.3v-2.1C26.9,11.3,27.3,11.3,27.8,11.2"></path>
                  </svg></a>
   </li>
   <li class="cust_dd_show hidden">
   <a href="#" class="filter_by_status_btn" title="Staining"> <svg x="0px" y="0px" width="17.3px" height="45.1px" viewBox="0 0 17.3 45.1">
                      <path d="M17.3,32.1c0,3.8,0,7.6,0,11.3c0,1.4-0.3,1.7-1.8,1.7c-4.6,0-9.2,0-13.8,0c-0.1,0-0.3,0-0.4,0
  C0.4,45,0.1,44.6,0,43.8c0-1.3,0-2.6,0-3.8c0-6.3,0-12.7,0-19c0-0.9,0.1-1.7,0.7-2.4c0.6-0.7,1.3-1.2,2.2-1.2c3.8,0,7.6,0,11.4,0
  c1.6,0,2.9,1.3,2.9,2.9c0,1.4,0,2.8,0,4.2C17.3,27,17.3,29.6,17.3,32.1 M16.7,21.6c-1-0.2-15.4-0.2-16,0c-0.2,1.3-0.1,17.8,0.1,18.5
  h15.9V21.6z M8.7,15.6c-1.7,0-3.4,0-5.1,0c-0.9,0-1.1-0.2-1.1-1.1c0-1,0-2.1,0-3.1c0-0.8,0.3-1.1,1.1-1.1c3.4,0,6.9,0,10.3,0
  c0.8,0,1.1,0.3,1.1,1.1c0,1,0,2.1,0,3.1c0,0.9-0.2,1.1-1.1,1.1C12.1,15.6,10.4,15.6,8.7,15.6 M12.3,9.8C11.6,10,5.8,10,5,9.8
  c0.3-1,0.6-2.1,0.9-3.1C6.5,4.8,7,2.9,7.6,1C7.9,0,8-0.1,9,0c0.4,0,0.6,0.2,0.8,0.6c0.9,3,1.8,6,2.6,9C12.4,9.6,12.3,9.7,12.3,9.8
   M13.3,30.9c0,2.6-2,4.6-4.6,4.6s-4.5-2-4.5-4.6s2-4.7,4.6-4.7C11.3,26.2,13.3,28.2,13.3,30.9 M8.7,28c-0.7,1.1-1.3,2.1-1.8,3.1
  c-0.4,0.8-0.2,1.8,0.5,2.3s1.9,0.5,2.6,0s1-1.5,0.5-2.3C10,30.1,9.4,29.2,8.7,28 M2.8,16.2h11.9v0.7H2.8V16.2z"></path>
                    </svg>  </a>
   </li>
   <li class="cust_dd_show hidden">
   <a href="#" class="filter_by_status_btn" title="Quality Assurance"><svg x="0px" y="0px" width="45.2px" height="45.2px" viewBox="0 0 45.2 45.2">
                    <path d="M11.6,45.2L0,33.6L33.6,0l11.6,11.6L11.6,45.2z M3.6,33.6l8.1,8.1l30-30l-8.1-8.1L3.6,33.6z M20.2,20.6
  c0.9-1.3,1.8-1.5,2.4-1.4c1.1,0.2,1.4,0.4,2.4-0.2c0.7-0.5,2.7-0.8,2.4,0c-0.6,1.7-1.3,1.8-2.1,2.3C22.6,23,23.6,23.1,24,25
  c0.1,0.5,0,0.9-0.3,1.2c-0.7,0.8-2.1,0.4-2.4-0.6c-0.2-0.8-0.8-1.7-2.2-1.9c-1.2-0.1-1.5-0.9-1.5-1.8c0-1,1-1.6,1.9-1.2l0,0
  C19.9,20.9,20.1,20.8,20.2,20.6"></path>
                  </svg></a>

   </li>
   <li class="cust_dd_show hidden">
   <a href="#" class="filter_by_status_btn" title="Slide Scanner"> <svg x="0px" y="0px" width="43.3px" height="43.2px" viewBox="0 0 43.3 43.2">
                    <path d="M43.2,9c0-0.5-0.6-0.9-1.1-0.8c0,0.2,0,0.4,0,0.5c-1.4-0.3-2.7-0.6-4-0.9V7.7c0.5,0,0.9,0,1.4-0.1
  c0-0.1,0-0.1,0-0.2c-0.9,0.1-1.8,0.2-2.7,0.2c0,0.4-0.1,0.5-0.1,0.7c0,1,0.1,2,0.1,3c0,1.9-0.1,3.7,0,5.6c0.1,1.4,0.1,1.5-1.3,1.5
  c-3.7-0.1-7.5-0.2-11.2-0.4c-0.4,0-0.8,0-1.1,0c-0.7,0-1.3-0.1-2-0.2c0,0-0.1-0.1-0.2-0.3h2.2c0.1-0.2,0.2-0.3,0.3-0.4
  c0.1,0.1,0.2,0.2,0.3,0.3c0.6,0,0.9-0.4,0.9-0.9c0-2.1,0-4.3,0-6.4c0-0.8-0.5-1.8,0.7-2.3c0-0.1,0.1-0.2,0-0.3
  c-0.3-2.4-0.6-4.7-1-7.1c0-0.2-0.5-0.4-0.7-0.4c-1.7,0-3.3,0.1-5,0.1c-0.4,0-0.8,0-1.3,0.1c-0.3,2.3-0.7,4.5-1,6.8h5.1
  c-0.4,0.6-0.7,1.1-1,1.4c-0.5,0.4-1,1-1.5,1.1c-1.6,0.1-3.1,0-4.7,0c-0.3,0-0.8,0.2-0.9,0.5c-0.3,0.5-0.4,1.1-0.6,1.6
  c-0.2,0.6-0.2,1.4-0.9,1.6c-0.9,0.2-1.7,0.3-2.4,1c-0.1,0.1-0.2,0-0.4,0V7.7c0.5-0.2,1-0.3,1.4-0.4c0-0.1-0.1-0.1-0.1-0.2
  c-2,0.2-3.9,0.4-5.9,0.6c0,0.3,0,0.5,0,0.7c0,1.1,0,2.1-0.2,3.2C4,13.5,4,15.3,5.2,16.9c0.4,0.6,0.2,0.9-0.3,1.3
  c-0.2,0.1-0.4,0.3-0.5,0.5c0,0.1,0,0.2,0.1,0.3h4.6c0,0.1,0,0.2,0,0.4H3.2c-0.8-0.3-1.4,0.1-1.8,1.2c-0.3,0.8-0.6,1.7-0.7,2.6
  c-0.3,1.4-0.6,2.8-0.6,4.3c-0.1,2.3,0,4.6,0,6.9c0,2.1-0.1,4.1-0.1,6.4c0.1,0,0.5,0.2,0.9,0.2c2.9,0.2,5.7,0.4,8.6,0.6
  c2,0.1,4,0.3,5.9,0.4c0.7,0,1.4,0,2.1,0.1c2.4,0.2,4.8,0.4,7.2,0.6c2.5,0.2,4.9,0.2,7.4,0.5c1.5,0.1,2.9,0.1,4-1.1
  c0.2-0.2,0.4-0.3,0.5-0.4c0.9-0.8,1.9-1.5,2.4-2.6c0.2-0.6,0.6-1,0.9-1.6s0.7-1.2,0.7-1.7c0.1-3.6,0.2-7.2,0.2-10.7
  c0-0.8,0-1.7-0.3-2.5c-0.6-1.6-0.3-3,1-4.1c1-0.8,1.7-1.8,1.8-3.1C43.3,13.1,43.2,11,43.2,9z M9,17.7c-0.1-0.6,0.2-0.9,0.8-0.9
  c0.5,0,1,0.2,1.5,0.2c0.7,1,1.8,0.9,2.9,1.1c-0.2,0.1-0.2,0.2-0.3,0.3c-1.4,0.1-2.7,0.2-4.1,0.3C9.1,18.7,9,18.3,9,17.7z M12.9,19.4
  c-0.7,0.1-1.8,0.7-3,0.3c0-0.1,0-0.2,0-0.3H12.9z M33.1,26.8c-0.2,2-0.6,4-0.8,6c-0.2,1.9-0.4,3.7-0.7,5.6c-0.1,0.8-0.3,1.5-0.5,2.2
  c-0.1,0.2-0.4,0.5-0.7,0.5c-2.5,0.4-5.1,0.6-7.6,0.1c-1.1-0.2-2.1-0.6-3-0.9c-0.6-2.7-1.1-5.2-1.6-7.8L3.4,31.9
  c-1.1-0.1-2-1-1.9-2.1c0.1-1.1,0.9-1.9,2-1.9h0.1l14.3,0.7c0-0.8,0-1.5,0-2.3c0.1-2.2,0.3-4.3,1.2-6.4c0.1-0.3,0.8-0.6,1.3-0.6
  c4.1,0.1,8.2,0.3,12.3,0.4c0.4,0,0.7-0.1,1.1-0.1c0.2,0,0.4,0.1,0.7,0.1C33.3,22.2,33.3,24.5,33.1,26.8z M21,22.4l10.5,0.5
  c0,0-0.8,5.2-0.8,6.3l-10.3-0.3C20.4,28.9,20.3,23.3,21,22.4z"></path>
                  </svg></a>
   </li>
   <li class="cust_dd_show hidden">
   <a href="#" class="filter_by_status_btn" title="Reporting"> <svg x="0px" y="0px" width="43.8px" height="42.2px" viewBox="0 0 43.8 42.2">
                    <path d="M24.5,7.7c-0.2-0.3-0.1-0.8,0.2-1s0.8-0.1,1,0.2s0.1,0.8-0.2,1C25.2,8.1,24.7,8,24.5,7.7 M12.9,30.6H9.8
  C4.4,30.6,0,35,0,40.4v1.8h22.6v-1.8C22.7,35,18.3,30.6,12.9,30.6 M21.9,15.4c-0.3-0.2-0.8-0.2-1,0.1c-0.2,0.3-0.2,0.8,0.1,1
  c0.3,0.2,0.8,0.2,1-0.1S22.2,15.6,21.9,15.4z M31.1,11.1c0.2-0.3,0.1-0.8-0.3-1c-0.3-0.2-0.8-0.1-1,0.3c-0.2,0.3-0.1,0.8,0.3,1
  C30.4,11.6,30.9,11.5,31.1,11.1z M22.8,10.8c0.4,0,0.7-0.3,0.7-0.7c0-0.4-0.3-0.7-0.7-0.7c-0.4,0-0.7,0.3-0.7,0.7
  C22.1,10.5,22.4,10.8,22.8,10.8z M26.4,11.2c0.4,0,0.8-0.2,0.8-0.6c0.1-0.4-0.2-0.7-0.6-0.8c-0.4,0-0.8,0.2-0.8,0.6
  S26,11.2,26.4,11.2z M33.1,14.2c0.1,0,0.2-0.1,0.3-0.2c0.2-0.2,0.3-0.5,0.1-0.8c-0.1-0.3-0.5-0.5-0.9-0.4c-0.3,0.1-0.5,0.3-0.5,0.6
  c0,0.1,0,0.2,0.1,0.4C32.3,14.2,32.7,14.4,33.1,14.2z M29.8,14.6c0.3-0.3,0.3-0.7,0-1s-0.8-0.3-1,0c-0.3,0.3-0.2,0.8,0,1
  C29.1,14.9,29.6,14.8,29.8,14.6z M23.9,14.8c0,0.4,0.4,0.7,0.8,0.7c0.4,0,0.7-0.4,0.7-0.8c0-0.4-0.4-0.7-0.8-0.7
  C24.2,14,23.9,14.4,23.9,14.8z M23.7,17.8c-0.3,0.2-0.5,0.6-0.3,1c0.2,0.3,0.6,0.5,1,0.3c0.3-0.2,0.5-0.6,0.3-1
  C24.5,17.7,24,17.6,23.7,17.8z M42.7,0H6C5.4,0,4.9,0.5,4.9,1.1V17c-1.1,1.4-1.8,3.1-1.8,5c0,4.4,3.6,8,8,8c3.4,0,6.3-2.1,7.4-5.1
  h16.3v-0.6h-16c0.2-0.7,0.3-1.5,0.3-2.3c0-0.1,0-0.3,0-0.4h20.6c0.4,0,0.8-0.3,0.8-0.8V3.9c-0.1-0.5-0.4-0.8-0.9-0.8H9
  c-0.4,0-0.8,0.3-0.8,0.8v10.7c-1,0.4-1.9,1-2.7,1.8V1.1c0-0.2,0.2-0.4,0.5-0.5h36.6c0.3,0,0.5,0.2,0.5,0.5v22.8
  c0,0.3-0.2,0.5-0.5,0.5h-2.5V25h2.5c0.6,0,1.1-0.5,1.2-1.2V1.1C43.8,0.5,43.3,0,42.7,0z M23.7,20.2l-1.4-1.5l1-1.8l2,0.4l0.2,2
  L23.7,20.2z M25.5,16.3l-2-0.1l-0.5-2l1.7-1.1l1.6,1.3L25.5,16.3z M34.3,13.1L33.6,15l-2-0.2l-0.5-2l1.7-1L34.3,13.1z M29.3,9.4h2
  l0.6,1.9l-1.6,1.3l-1.6-1.2L29.3,9.4z M30.5,13l0.2,2l-1.9,0.8l-1.3-1.5l1-1.7L30.5,13z M28.1,10.5l-1,1.7l-1.9-0.4l-0.2-2L26.8,9
  L28.1,10.5z M24.4,5.8l2,0.4l0.2,2l-1.8,0.9l-1.4-1.5L24.4,5.8z M22.9,8.5l1.5,1.4l-0.8,1.8l-2-0.2l-0.4-2L22.9,8.5z M20.3,14.8
  l2-0.3l0.9,1.8l-1.4,1.5l-1.8-1L20.3,14.8z M38.4,24.6c0,0.6-0.5,1.1-1.1,1.1s-1.1-0.5-1.1-1.1s0.5-1.1,1.1-1.1S38.4,24,38.4,24.6
   M21.1,26.4h6.4V27h-6.4V26.4z M17.9,28.6h12.8v0.6H17.9V28.6z"></path>
                  </svg> </a>
   </li>
   <li class="cust_dd_show hidden">
   <a href="#" class="filter_by_status_btn" title="Admin Support"><svg x="0px" y="0px" width="37.9px" height="45.1px" viewBox="0 0 37.9 45.1">
                    <path d="M37.9,38.5c0,0.6-0.1,1.1-0.2,1.7c-0.2,0.9-0.7,1.7-1.4,2.3c-1.3,0.9-2.8,1.3-4.3,1.7c-2,0.4-4,0.6-6,0.7
  c-3.7,0.3-7.4,0.2-11.2,0.1c-3.2-0.1-6.4-0.3-9.5-1c-1.2-0.3-2.4-0.7-3.4-1.4C1,42,0.6,41.2,0.3,40.3c-0.1-0.2,0-0.4-0.1-0.5
  c-0.6-2.5,0.5-4.2,2.6-5.5c1.9-1.1,4-1.9,6.1-2.4c1.2-0.3,2.5-0.5,3.7-0.7c2.2,2,4.2,3.9,6.4,5.9c2.1-2,4.2-3.9,6.4-5.9
  c1,0.2,2,0.3,3.1,0.5c1.8,0.4,3.6,0.9,5.2,1.7c0.9,0.4,1.8,1,2.6,1.6C37.4,35.9,38,37,37.9,38.5 M19.1,27.9c-5.3,0-9.1-3.5-10.3-7.6
  c1,0.9,2.7,1.7,5.4,2c0.2,0.5,0.6,0.8,1.2,0.8c0.7,0,1.2-0.6,1.2-1.2c0-0.7-0.6-1.2-1.2-1.2c-0.5,0-0.8,0.2-1.1,0.6
  c-2.6-0.3-4-1.1-4.8-1.8c-0.6-0.5-0.9-1-1.1-1.3c0-0.3,0-0.5,0-0.8C8.5,11.5,13,6.7,19,6.7c6.7,0,10.8,5.5,10.7,10.6
  C29.9,22.4,25.7,27.8,19.1,27.9 M19,0c2.9,0.1,5.6,0.9,8,2.6c3.3,2.3,5.3,5.5,6.1,9.4c0.2,0.9,0.2,1.7,0.3,2.6
  c0,0.3,0.1,0.5,0.4,0.6c0.7,0.4,1.1,1.1,1.4,1.8c0.6,1.7,0.5,3.3-0.2,4.9c-0.2,0.5-0.6,0.9-1,1.2c-0.7,0.6-1.7,0.5-2.4-0.2
  c-0.5-0.5-0.8-1.1-1-1.8c-0.5-1.6-0.4-3.2,0.4-4.8c0.3-0.5,0.6-0.9,1.1-1.3c0.1,0,0.1-0.2,0.1-0.3c0-1.4-0.3-2.8-0.7-4.2
  c-0.7-1.7-1.7-3.4-3.1-4.9c-0.7-0.8-1.6-1.5-2.5-2.1c-1.8-1.2-3.7-1.9-5.8-2c-2.6-0.2-5,0.3-7.2,1.5c-1.2,0.7-2.3,1.5-3.3,2.6
  c-2,2.1-3.2,4.7-3.6,7.5c-0.1,0.6-0.1,1.3-0.2,1.9c0,0.3,0.2,0.3,0.3,0.4c0.5,0.3,0.8,0.8,1.1,1.3c0.4,0.9,0.6,1.8,0.6,2.8
  c0,1.1-0.2,2.1-0.9,3.1c-0.4,0.6-0.9,1-1.6,1.1c-0.4,0-0.8-0.1-1.2-0.3c-1.1-0.8-1.4-2-1.6-3.3C2.4,19,2.5,18,2.9,17
  c0.4-0.9,0.9-1.5,1.6-1.9c0.1,0,0.1-0.2,0.1-0.2c0.1-2,0.5-3.9,1.2-5.8C6.3,7.8,7,6.6,7.9,5.5c0.5-0.4,0.9-0.9,1.4-1.4
  c2-2,4.4-3.3,7.2-3.8C17.3,0.2,18.2,0.1,19,0"></path>
                  </svg>   </a>
   </li>
   <li class="cust_dd_show hidden">
   <a href="#" class="filter_by_status_btn" title="Further Work"><svg x="0px" y="0px" width="44.7px" height="44.7px" viewBox="0 0 44.7 44.7">
                      <path d="M44.7,20.7h-4.6C39.3,12.3,32.5,5.6,24,5V0h-3.3v5C12.5,5.9,6.1,12.5,5.4,20.7H0V24h5.4
  c0.8,8.1,7.2,14.7,15.4,15.7v5H24v-5c8.5-0.6,15.3-7.3,16.1-15.7h4.6V20.7z M24,36.4v-4.1h-3.3v4c-6.3-0.9-11.3-6-12-12.3h3.7v-3.3
  H8.7c0.7-6.4,5.7-11.5,12-12.4v4H24V8.3c6.7,0.6,12,5.8,12.8,12.5h-4.4V24h4.4C36,30.6,30.7,35.8,24,36.4z"></path>
                    </svg></a>
   </li>

   <li class="cust_dd">
      <a href="javascript:;"><i class="las la-ellipsis-v"></i></a>                                
   </li>
</ul>

                  </div> 
                  </div> 
                  </div> 
                  </div> 
<script>
    $(document).ready(function () {
        <?php if($filterStatus != ''){ ?>
          setTimeout(function(){
            var status = "<?php echo base64_decode($filterStatus) ?>";
          $('.filter_by_status_btn').each(function(){
            if($(this).attr("title").trim() === status){
              $(this).trigger('click'); 
              $('.cust_dd').trigger('click');
            }
          });
          },100);
          
        <?php } ?>
        $(".cust_dd").click(function(){
            $(".cust_dd_show").toggleClass("hidden");
            $(".cust_dd i.la-ellipsis-v").toggleClass("la-minus");
        });


    });
</script>


      <table id="doctor_record_list_table" class="table table-striped custom-table mb-0 dataTable no-footer" cellspacing="0" width="100%" style="margin-top:1px !important">
        <thead>
          <tr>          
            <th style="width:10%">Specialty</th>
            <th>Lab No.<br>Track No.</th>
            <th>Clinic</th>
            <th>Courier No.<br />Digi No.</th>
            
            <th>Patient</th>
            <th>No Of Spec</th>
             <th class="status_up">
              Pathologist
            </th>
            <th>Added By</th>
            <th class="text-center">
              <img data-toggle="tooltip" title="Urgency" src="<?php echo base_url('/assets/icons/Reported--UnReported.png'); ?>" class="img-responsive">
              <img data-toggle="tooltip" title="Flag" src="<?php echo base_url('/assets/icons/flag-skyblue.png'); ?>" class="img-responsive centerd">
              <img data-toggle="tooltip" title="Microscopic" src="<?php echo base_url('/assets/icons/VSlides.png'); ?>" class="img-responsive centerd">
            </th>
              <th>
                  <img data-toggle="tooltip" title="Comments" src="<?php echo base_url('/assets/icons/Comments.png'); ?>" class="img-responsive centerd">
              </th>
                  
            <th>TAT</th>            
            <th  class="text-right">
              <img data-toggle="tooltip" title="Actions" src="<?php echo base_url('/assets/icons/Actions-Blue.png'); ?>" class="img-responsive pull-right">
            </th>
            <th class="hide_content">&nbsp;</th>
            <th class="hide_content">&nbsp;</th>
            <th class="hide_content">&nbsp;</th>
            <th class="hide_content">&nbsp;</th>
            <th class="hide_content">&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <?php
		  //print_r($query);
		 // print "=============";
		  //exit;
          $flag_count = 11;
          foreach ($query as $row) 
          {
            
            // $assign_user_info = getLoggedInUserProfile(intval($row->user_id)); 
            $assign_user_info = getAssignedDoctorDetails(intval($row->uralensis_request_id)); 
            $urgency_class = '';
            $urgency_title = '';
            if (!empty($row->report_urgency) && $row->report_urgency === 'Urgent') {
              $urgency_class = 'urgent-wb';
              $urgency_title = 'Urgent';
            } elseif (!empty($row->report_urgency) && $row->report_urgency === '2WW') {
              $urgency_class = 'two_ww';
              $urgency_title = '2WW';
            } else {
              $urgency_class = 'routine';
              $urgency_title = 'Routine';
            }

            $dob = '';
            if (!empty($row->dob)) {
              $dob = date('d-m-Y', strtotime($row->dob));
            }
            $courierNo = '';
            if (isset($row->ura_courier_id) && !empty($row->ura_courier_id)) {
              $courierNo = $row->ura_courier_id;
            }
            $batchNo = '';
            if (isset($row->ura_batch_ref) && !empty($row->ura_batch_ref)) {
              $batchNo = $row->ura_batch_ref;
            }
            $lab_release_date = '';
            if (!empty($row->date_received_bylab)) {
              $lab_release_date = date('d-m-Y', strtotime($row->date_received_bylab));
            }
            $specialty = get_record_specialty($row->uralensis_request_id);
            $specialty_id = get_record_specialty_id($row->uralensis_request_id);
            $has_slide = false;
            foreach($request_slides_id as $id) {
              if ($id->record_id == $row->uralensis_request_id) {
                $has_slide = true;
              }
            }

            ?>
            <?php if($sr_specialty !='')
            {}else{ ?>
                <tr class="<?php //echo $row_code; ?>" onclick="window.location.href=<?php echo site_url() . '/doctor/doctor_record_detail_old/' . $row->uralensis_request_id.$request_type; ?>">
                  
                  <td class="<?php // echo $row_code; ?>">
                  <input type="checkbox"  name="select_doctor[]" class="ads_Checkbox" style="float:left" value="<?php echo $row->uralensis_request_id;?>">
				  <a class="hospital_initials" style="float:none; margin:auto;" alt="Histopathology / General" title="Histopathology / General" href="#" >
				  <?php //echo substr($row->spec_grp_name,0,1); ?>H / G</a></td>
                  <td class="<?php // echo $row_code; ?>">
				  <a title="Edit" href="<?php echo site_url() . '/doctor/doctor_record_detail_old_new/' . $row->uralensis_request_id.$request_type; ?>"><?php echo $row->lab_number; ?></a><br><?php echo $row->ura_barcode_no; ?></td>
                  <td>
                    <?php
                    $f_initial = '';
                    $l_initial = '';
                    if (!empty($this->ion_auth->group($row->hospital_group_id)->row()->first_initial)) 
					{
                      $f_initial = $this->ion_auth->group($row->hospital_group_id)->row()->first_initial;
                    }
                    if (!empty($this->ion_auth->group($row->hospital_group_id)->row()->last_initial)) 
					{
                      $l_initial = $this->ion_auth->group($row->hospital_group_id)->row()->last_initial;
                    }					
					$today = new DateTime();
					$dob_obj = date_create($dob);
					$diff = $today->diff($dob_obj);
					$age = $diff->y." y";					
                    ?>
                    <a class="hospital_initials hostipal-icon" title="<?php echo $this->ion_auth->group($row->hospital_group_id)->row()->description; ?>" href="#" >
                      <?php echo $f_initial. '' .$l_initial; ?>
                    </a>
                  </td>
                    <td><?= $row->courier_number; ?><br /><?php echo $row->pci_number; ?></td>
                  <!--<td><?php /*echo $courierNo; */?><br><?php /*echo $batchNo; */?></td>-->
                 
                  <td><?php echo $row->f_name; ?> <?php echo $row->sur_name; ?><br /><?php echo $age; ?></td>
                  <td><?php echo $row->speciman_no ?></td>
                 <td class="text-center">
                    <?php if($row->request_assign_status==1){?>
                      <a style="color:#000;" href="javascript:;" id="show_comments_list" class="show_comments_record_list" data-recordid="<?php echo $row->uralensis_request_id; ?>" data-modalid="<?php echo $flag_count; ?>">
                        <!-- <i class="lnr lnr-file-empty" style=""></i> -->


                          <div class="row" >
                              <div class="col-md-9">
                                  <img class="doctor-pic" src="<?php echo get_profile_picture($assign_user_info[0]->profile_picture_path, $assign_user_info[0]->first_name, $assign_user_info[0]->last_name); ?>" title="<?= $assign_user_info[0]->first_name. " ". $assign_user_info[0]->last_name; ?>">
                              </div>
                              <div class="col-md-3" style="text-align:center">
                                  <!--<?= $assign_user_info[0]->first_name. "<br>". $assign_user_info[0]->last_name; ?>-->
                              </div>
                          </div>


                      </a>
                       <?php } ?>
                  </td>
                   <td>
                   <?php //"$row->added_by";
                   $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($row->request_add_user);
                    $profile_picture_path  = $decryptedDetails->profile_picture_path;
                    $img = get_profile_picture($profile_picture_path, $decryptedDetails->first_name, $decryptedDetails->last_name);
                   echo "<img src=$img class='avatar' title=$row->added_by>";
                    ?>
                       
                   </td>
                  <!--<td><br><?php //echo $lab_release_date; ?></td>-->
                  <!-- <td class="text-center"><div class="<?php echo $urgency_class; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $urgency_title; ?>" style="font-size:18px;"></div></td> -->
                  <!-- <td class="text-center">&nbsp;</td> -->
                  <td class="flag_column text-center">
                    <span class="icon-try">
                  <div class="<?php echo $urgency_class; ?>" title="<?php echo $urgency_title; ?>" style="font-size:18px;"></div>

                  <div class="hover_flags">
                      <div class="flag_images">
                        <?php if ($row->flag_status === 'flag_red') { ?>
                          <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_red.png'); ?>">
                        <?php } elseif ($row->flag_status === 'flag_yellow') { ?>
                          <img data-toggle="tooltip" data-placement="top" title="This case marked for typing." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_yellow.png'); ?>">
                        <?php } elseif ($row->flag_status === 'flag_blue') { ?>
                          <img data-toggle="tooltip" data-placement="top" title="This case marked for Pre-Authorization." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_blue.png'); ?>">
                        <?php } elseif ($row->flag_status === 'flag_black') { ?>
                          <img data-toggle="tooltip" data-placement="top" title="This case marked as further work." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_black.png'); ?>">
                        <?php } elseif ($row->flag_status === 'flag_gray') { ?>
                          <img data-toggle="tooltip" data-placement="top" title="This case marked as awaiting reviews." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_gray.png'); ?>">
                        <?php } else { ?>
                          <img data-toggle="tooltip" data-placement="top" title="This case marked as released." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_green.png'); ?>">
                        <?php } ?>
                      </div>
                      <ul class="report_flags record-list-flag list-unstyled list-inline" style="display:none;">
                        <?php
                        $active = '';
                        if ($row->flag_status === 'flag_green') {
                          $active = 'flag_active';
                        }
                        ?>
                        <li class="<?php echo $active; ?>">
                          <a href="javascript:;" data-flag="flag_green" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                            <img data-toggle="tooltip" data-placement="top" title="This case marked as released." src="<?php echo base_url('assets/img/flag_green.png'); ?>">
                          </a>
                        </li>
                        <?php
                        $active = '';
                        if ($row->flag_status === 'flag_red') {
                          $active = 'flag_active';
                        }
                        ?>
                        <li class="<?php echo $active; ?>">
                          <a href="javascript:;" data-flag="flag_red" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                            <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="<?php echo base_url('assets/img/flag_red.png'); ?>">
                          </a>
                        </li>
                        <?php
                        $active = '';
                        if ($row->flag_status === 'flag_yellow') {
                          $active = 'flag_active';
                        }
                        ?>
                        <li class="<?php echo $active; ?>">
                          <a href="javascript:;" data-flag="flag_yellow" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                            <img data-toggle="tooltip" data-placement="top" title="This case marked for typing." src="<?php echo base_url('assets/img/flag_yellow.png'); ?>">
                          </a>
                        </li>
                        <?php
                        $active = '';
                        if ($row->flag_status === 'flag_blue') {
                          $active = 'flag_active';
                        }
                        ?>
                        <li class="<?php echo $active; ?>">
                          <a href="javascript:;" data-flag="flag_blue" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                            <img data-toggle="tooltip" data-placement="top" title="This case marked for pre authorization." src="<?php echo base_url('assets/img/flag_blue.png'); ?>">
                          </a>
                        </li>
                        <?php
                        $active = '';
                        if ($row->flag_status === 'flag_black') {
                          $active = 'flag_active';
                        }
                        ?>
                        <li class="<?php echo $active; ?>">
                          <a href="javascript:;" data-flag="flag_black" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                            <img data-toggle="tooltip" data-placement="top" title="This case marked further work." src="<?php echo base_url('assets/img/flag_black.png'); ?>">
                          </a>
                        </li>
                        <?php
                        $active = '';
                        if ($row->flag_status === 'flag_gray') {
                          $active = 'flag_active';
                        }
                        ?>
                        <li class="<?php echo $active; ?>">
                          <a href="javascript:;" data-flag="flag_gray" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                            <img data-toggle="tooltip" data-placement="top" title="This case marked awaiting reviews." src="<?php echo base_url('assets/img/flag_gray.png'); ?>">
                          </a>
                        </li>
                      </ul>
                    </div>
                  <div><img <?php if ($has_slide) echo 'onclick = "window.location.href = \''.base_url().'doctor/doctor_record_detail/'.$row->uralensis_request_id.'/view\'"' ?> src="<?php if ($has_slide) echo base_url('/assets/icons/vslideico_green.png'); else echo base_url('/assets/icons/vslideico.png'); ?>" style="<?php if ($has_slide) echo 'width: 25px; cursor: pointer;'?>" class="img-responsive vslideico"></div>
                      </span>
                </td>
                <td>
                    <div class="comments_icon" style="margin-right: 0;">
                        <a style="color:#000;" href="javascript:;" id="display_comment_box" class="display_comment_box" data-recordid="<?php echo $row->uralensis_request_id; ?>" data-modalid="<?php echo $flag_count; ?>" data-description="<?php echo $row->description; ?>">
                        <i class="fa fa-commenting" aria-hidden="true" style="font-size: 20px; color: #0c8abd;"></i>
                        </a>
                    </div>
                    <div id="flag_comment_model-<?php echo $flag_count; ?>" class="flag_comment_model modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Flag Reason Comment</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="flag_msg"></div>
                                    <form method="post" class="form flag_comments" id="flag_comments_form_<?= $flag_count; ?>">
                                        <div class="form-group">
                                            <textarea name="flag_comment" id="flag_comment" rows="5" class="form-control flag_comment"></textarea>
                                            <input type="hidden" name="record_id" value="<?php echo $row->uralensis_request_id; ?>">
                                            <input type="hidden" name="data_section" value="1" />
                                        </div>
                                        <a class="btn btn-primary flag_comments_save_record_list" id="flag_comments_save" href="javascript:;">Save Comments</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>


                    <td>
                    <a class="custom_badge_tat">
                      <?php
                      $now = time();
                      $date_taken = !empty($row->date_taken) ? $row->date_taken : '';
                      $request_date = !empty($row->request_datetime) ? $row->request_datetime : '';
                      $tat_date = '';

                      $tat_settings = uralensis_get_tat_date_settings($row->hospital_group_id);

                      if (!empty($tat_settings) && $tat_settings['ura_tat_date_data'] === 'date_sent_touralensis') {
                        $date_sent_to_uralensis = !empty($row->date_sent_touralensis) ? $row->date_sent_touralensis : '';
                        $tat_date = $date_sent_to_uralensis;
                      } elseif ($tat_settings['ura_tat_date_data'] === 'date_rec_by_doctor') {
                        $data_rec_by_doctor = !empty($row->date_rec_by_doctor) ? $row->date_rec_by_doctor : '';
                        $tat_date = $data_rec_by_doctor;
                      } elseif ($tat_settings['ura_tat_date_data'] === 'data_processed_bylab') {
                        $data_processed_bylab = !empty($row->data_processed_bylab) ? $row->data_processed_bylab : '';
                        $tat_date = $data_processed_bylab;
                      } elseif ($tat_settings['ura_tat_date_data'] === 'date_received_bylab') {
                        $date_received_bylab = !empty($row->date_received_bylab) ? $row->date_received_bylab : '';
                        $tat_date = $date_received_bylab;
                      } elseif ($tat_settings['ura_tat_date_data'] === 'publish_datetime') {
                        $publish_datetime = !empty($row->publish_datetime) ? $row->publish_datetime : '';
                        $tat_date = $publish_datetime;
                      } else {
                        if (!empty($date_taken)) {
                          $tat_date = $date_taken;
                        } else {
                          $tat_date = $request_date;
                        }
                      }

                      if (!empty($tat_settings) && empty($tat_date)) {
                        $record_old_count = 'NR';
                      } elseif (!empty($tat_settings) && !empty($tat_date)) {
                        $compare_date = strtotime("$tat_date");
                        $datediff = $now - $compare_date;
                        $record_old_count = floor($datediff / (60 * 60 * 24));
                      } else {
                        $compare_date = strtotime("$tat_date");
                        $datediff = $now - $compare_date;
                        $record_old_count = floor($datediff / (60 * 60 * 24));
                      }

                      $badge = '';
                      if ($record_old_count <= 10) {
                        $badge = 'bg-success';
                      } elseif ($record_old_count > 10 && $record_old_count <= 20) {
                        $badge = 'bg-warning';
                      } else {
                        $badge = 'bg-danger';
                      }
                      ?>
                      <span class="badge <?php echo $badge; ?>">
                        <?php echo $record_old_count; ?>
                      </span>
                    </a>
                  </td>
                   
                  <td style="text-align:right; padding-right: 10px;">
                    <?php $request_type = '';
                    if($row->speciality_group_id=='2'){
                      $request_type = '/postmortem';
                    }
                    elseif($row->speciality_group_id=='3'){
                      $request_type = '/virology';
                    }
                    ?>
                    <!--<a title="Edit" href="<?php echo site_url() . '/doctor/doctor_record_detail_old/' . $row->uralensis_request_id.$request_type; ?>"><i class="fa fa-pencil m-r-5"></i> </a>
                        <a title="Delete" href="<?php echo site_url() . '/lab/delete_record/' . $row->uralensis_request_id.$request_type; ?>" ><i class="fa fa-trash-o m-r-5"></i> </a>-->



<!--                                    
 <div class="dropdown dropdown-action">-->
  <!--                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>-->
  <!--                                        <div class="dropdown-menu dropdown-menu-right">-->
    <!--                                            <a class="dropdown-item" href="--><?php ////echo site_url() . '/doctor/doctor_record_detail/' . $row->uralensis_request_id; ?><!--"><i class="fa fa-pencil m-r-5"></i> Edit</a>-->
    <!--                                            --><?php //$request_type = ($row->speciality_group_id=='2'?'/postmortem':''); ?>
    <!--                                            <a class="dropdown-item" href="--><?php //echo site_url() . '/doctor/doctor_record_detail_old/' . $row->uralensis_request_id.$request_type; ?><!--"><i class="fa fa-pencil m-r-5"></i> Edit</a>-->
    <!--                                            <a class="dropdown-item" href="#"><i class="fa fa-eye m-r-5"></i> View</a>-->
    <!--                                            <a class="dropdown-item" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>-->
    <!--                                        </div>-->
    <!--                                    </div> -->
    <!-- <a href="<?php //echo site_url() . '/doctor/doctor_record_detail/' . $row->uralensis_request_id; ?>" class="btn btn-info btn-sm"><i class="lnr lnr-pencil"></i></a> -->
  </td>
  <td class="hide_content">
    <p style="display:none;"><?php echo $row->flag_status; ?></p>
  </td>
  <td class="hide_content">
    <p style="display:none;"><?php // echo $row_code; ?></p>
  </td>
  <td class="hide_content">
    <p style="display:none;"><?php echo $urgency_title; ?></p>
  </td>
  <td class="hide_content">
    <p style="display:none;"><?php echo $row->hospital_group_id; ?></p>
  </td>
  <td class="hide_content">
    <p style="display:none;"><?php echo $row->request_code_status; ?></p>
  </td>
</tr>
<?php } ?>
<?php
$flag_count++;
                    }//endforeach
                    ?>
                  </tbody>
                </table>

            </div>
  </div>

<script type="text/javascript">
  function new_data(ids)
  {
   var str = $("#assign_id").val();
   var result=str+"_"+ids;
   var str = $("#assign_id").val(result);
 }

  $.widget( "custom.iconselectmenu", $.ui.selectmenu, {
      _renderItem: function( ul, item ) {
          var li = $("<li>"),
              wrapper = $("<div>", { text: item.label });

          if (item.disabled) {
              li.addClass( "ui-state-disabled" );
          }

          $("<span>", {
              style: item.element.attr( "data-style" ),
              "class": "ui-icon " + item.element.attr( "data-class" )
          }).appendTo( wrapper );

          return li.append( wrapper ).appendTo( ul );
      }
  });

  $( "#people" ).iconselectmenu().iconselectmenu( "menuWidget").addClass( "ui-menu-icons avatar" );


 function assignDoctor(){
  var sDoctr = $('#select_assign_doctor').val();
  if(sDoctr.trim()==''){
    alert('Plese select doctor');
    $('#select_assign_doctor').focus();
    return false;
  }else{
     var val = [];
      $(':checkbox:checked').each(function(i){
        val[i] = $(this).val();
      });
      console.log(val, "Here we are!!!!");
      if(val.length >=1){
        var f_data = new FormData();
        f_data.append('recored_id', val);

        f_data.append('doctor_id', sDoctr);
        $.ajax({
            url: '<?php echo base_url('lab/updateAssigndoctor')?>',
            type: 'POST',
            data: f_data,
            cache: false,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (data) {
              if(data.type=='success'){
                alert(data.msg);
                location.reload();
              }else{

               alert(data.msg);
               return false;
              }
            }
        });
      }else{
        alert('please checked atlest one record');
        return false;
      }

  }
 }

 function assignCourier(){
  var sCourier = $('#select_assign_couriers').val();
  if(sCourier.trim()==''){
    alert('Plese select courier');
    $('#select_assign_couriers').focus();
    return false;
  }else{
     var val = [];
      $(':checkbox:checked').each(function(i){
        val[i] = $(this).val();
      });
      console.log(val, "Here we are");
      if(val.length >=1){
        var f_data = new FormData();
        f_data.append('recored_id', val);

        $.ajax({
                type: "POST",
                url: '<?php echo base_url('/index.php/lab/updateAssignCourier'); ?>',
                data: {courier_id : sCourier, recored_id: val,  [csrf_name]: csrf_hash},
                dataType: "json",
                success: function (data) {
              if(data.type=='success'){
                alert(data.msg);
                location.reload();
              }else{

               alert(data.msg);
               return false;
              }
            }
            });
      }else{
        alert('please checked atlest one record');
        return false;
      }

  }
 }
</script>
<!-- 
<script type="text/javascript">
    $('.flags_check span.tg-radio.first').hover(
          function () {
            $(".flags_check span.tg-radio").show();
          },
          function () {
            $('.flags_check span.tg-radio').hide();
            $('.flags_check span.tg-radio.first').show();
          });
</script> -->
