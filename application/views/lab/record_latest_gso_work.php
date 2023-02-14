<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
  div.dataTables_wrapper div.dataTables_length select {
    position: absolute;
    /* top:-125px; */
    height: 28px !important;
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
        width: 30px;
        height: 30px;
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
    
  </style>
  <div class="clearfix"></div>
  <div class="container-fluid">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style=" margin-bottom: 15px;">
      <h3 class="page-title">Records</h3> 
      <ol class="tg-breadcrumb tg-breadcrumbvtwo">
                <li><a href="javascript:;">Dashboard</a></li>
                <li class="active">Lab Record List</li>
            </ol>     
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
                <h3>Filter By Hospital</h3>
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

    <div class=" report_listing" id="report-list-table">
      <div class="col-md-12">
        <!-- <div class="flag_message"></div> -->
        <?php echo form_open("admin/display_all", array('id' => 'assign_doc_form')); ?>
        <div class="col-sm-2 col-md-2" style="padding-left: 0;">  
          <div class="form-group form-focus select-focus">
            <select class="form-control select2" name="doctors" id="select_assign_doctor">
              <option value="">Choose Pathologist</option>
                <?php foreach ($doctor_list as $doctors) : ?>
                    <option value="<?php echo $doctors->id; ?>" title="<?php echo $doctors->profile_picture_path; ?>">
                        <?php echo $doctors->first_name; ?> <?php echo $doctors->last_name; ?>
                    </option>
                <?php endforeach; ?>
            </select>
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
        <div class="col-sm-1 col-md-1" style="padding-left: 0;">
          <div class="form-group">
            <button type="button" id="assign_btn" class="btn btn-primary" onClick="assignDoctor()" style="padding: 8px 12px;">Assign</button>
          </div>
        </div>
        <div class="col-sm-9 col-md-9" style="padding-right:0; padding-left:0;">
          <div class="tg-haslayout">
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


                <li class="tg-statusbar tg-flagcolor" style="margin-top: 5px;">
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
                        </div>
                      </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="clearfix"></div>

      <table id="doctor_record_list_table" class="table table-striped custom-table mb-0 dataTable no-footer" cellspacing="0" width="100%" style="margin-top:1px !important">
        <thead>
          <tr>           
            <th>Specialty/Sub</th>
            <th>UL No.<br>Track No.</th>
            <th>Hospital.</th>
            <th>Courier No.</th>
            <th>Lab No.<br>Digi No.</th>
            <th>Patient</th>
             <th class="status_up">
              Pathologist
            </th>
            <th>Added By</th>
            <th class="text-center">
              <img data-toggle="tooltip" title="Urgency" src="<?php echo base_url('/assets/icons/Reported--UnReported.png'); ?>" class="img-responsive">
              <img data-toggle="tooltip" title="Flag" src="<?php echo base_url('/assets/icons/flag-skyblue.png'); ?>" class="img-responsive centerd">
              <img data-toggle="tooltip" title="Microscopic" src="<?php echo base_url('/assets/icons/VSlides.png'); ?>" class="img-responsive centerd">
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
          </tr>
        </thead>
        <tbody>
          <?php		  
          $flag_count = 11;
          foreach ($query as $row) 
          {
            
            $assign_user_info = getLoggedInUserProfile(intval($row->user_id)); 
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
				  <a class="hospital_initials" style="float:right" alt="Histopathology / General" title="Histopathology / General" href="#" >
				  <?php //echo substr($row->spec_grp_name,0,1); ?>H / G</a></td>
                  <td class="<?php // echo $row_code; ?>">
				  <a title="Edit" href="<?php echo site_url() . '/doctor/doctor_record_detail_old/' . $row->uralensis_request_id.$request_type; ?>"><?php echo $row->serial_number; ?></a><br><?php echo $row->ura_barcode_no; ?></td>
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
                    <a class="hospital_initials" title="<?php echo $this->ion_auth->group($row->hospital_group_id)->row()->description; ?>" href="#" >
                      <?php echo $f_initial. '' .$l_initial; ?>
                    </a>
                  </td>
                    <td><?= $row->courier_number; ?></td>
                  <!--<td><?php /*echo $courierNo; */?><br><?php /*echo $batchNo; */?></td>-->
                  <td><?php echo $row->lab_number; ?><br /><?php echo $row->pci_number; ?></td>
                  <td><?php echo $row->f_name; ?> <?php echo $row->sur_name; ?><br /><?php echo $age; ?></td>
                 <td class="text-center">
                    <?php if($row->assign_status==1){?>
                      <a style="color:#000;" href="javascript:;" id="show_comments_list" class="show_comments_record_list" data-recordid="<?php echo $row->uralensis_request_id; ?>" data-modalid="<?php echo $flag_count; ?>">
                        <!-- <i class="lnr lnr-file-empty" style=""></i> -->


                          <div class="row" style="width: 135px;">
                              <div class="col-md-3">
                                  <img class="doctor-pic" src="<?php echo get_profile_picture($assign_user_info[0]->profile_picture_path, $assign_user_info[0]->first_name, $assign_user_info[0]->last_name); ?>" title="<?= $assign_user_info[0]->first_name. " ". $assign_user_info[0]->last_name; ?>">
                              </div>
                              <div class="col-md-9" style="text-align:center">
                                  <?= $assign_user_info[0]->first_name. "<br>". $assign_user_info[0]->last_name; ?>
                              </div>
                          </div>


                      </a>
                       <?php } ?>
                  </td>
                   <td><?= "$row->added_by"; ?></td>
                  <!--<td><br><?php //echo $lab_release_date; ?></td>-->
                  <!-- <td class="text-center"><div class="<?php echo $urgency_class; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $urgency_title; ?>" style="font-size:18px;"></div></td> -->
                  <!-- <td class="text-center">&nbsp;</td> -->
                  <td class="flag_column text-center">
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
                  
                  <div class="comments_icon" style="margin-right: 0;">
                      <a style="color:#000;" href="javascript:;" id="display_comment_box" class="display_comment_box" data-recordid="<?php echo $row->uralensis_request_id; ?>" data-modalid="<?php echo $flag_count; ?>">
                        <i class="lnr lnr-bubble"></i>
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
                            <form class="form flag_comments" id="flag_comments_form">
                              <div class="form-group">
                                <textarea name="flag_comment" id="flag_comment" class="form-control flag_comment"></textarea>
                              </div>
                              <div class="form-group">
                                <hr>
                                <input type="hidden" name="record_id" value="<?php echo $row->uralensis_request_id; ?>">
                                <a class="btn btn-primary flag_comments_save_record_list" id="flag_comments_save" href="javascript:;">Save Comments</a>
                              </div>
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
                    <?php if($row->specimen_publish_status != 1)
                    { ?>
                        <a title="Edit" href="<?php echo site_url() . '/doctor/doctor_record_detail_old/' . $row->uralensis_request_id.$request_type; ?>"><i class="fa fa-pencil m-r-5"></i> </a>
                        <a title="Delete" href="<?php echo site_url() . '/lab/delete_record/' . $row->uralensis_request_id.$request_type; ?>" ><i class="fa fa-trash-o m-r-5"></i> </a>
                        <?php 
                    }else{
                        echo '-';
                    } ?>
                    



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
</tr>
<?php } ?>
<?php
$flag_count++;
                    }//endforeach
                    ?>
                  </tbody>
                </table>
              </form>
            </div>
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
              console.log(val);
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