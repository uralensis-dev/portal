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
    @media screen and (max-width: 1024px) {
    div.dataTables_wrapper div.dataTables_length select{
      left: -25px;
    }
    .tg-flagcolor .tg-radio input[type=radio] + label:before{
      width: 30px!important;
    height: 30px!important;
    }
    .tg-radio label span {
    position: relative;
    top: -3px;
}
.list-track li {
    padding-left: 0px!important;
}
.list-track li a{
  padding: 10px 5px!important;
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
      padding: 0 0px;
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
    color: #56c0ef!important;
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
    z-index: 99;
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
.dt-button {
    border-radius: 4px;
    border: 1px solid #00c5fb;
    font-size: 13px;
    padding: 8px 20px;
    background-color: #00c5fb;
    color: #fff;
}
@media screen and (max-width: 768px) {
  div.dataTables_wrapper div.dataTables_length select {
    left: -85px;  
}
.box {
    width: 100%;
    position: relative;
    display: inline-flex;
}
.box .col-sm-1.col-md-1 {
    width: 15%;
}
.box .col-sm-2.col-md-2 {
    width: 35%;
}
#report-list-table form .col-sm-6.col-md-6 {
    width: 100%;
    padding-bottom: 10px;
}
.header .tg-searchrecord {
    right: 30%;
}
}
@media screen and (max-width: 580px) {
.box {
    width: 100%;
    position: relative;
    display: block;
}
.box .col-sm-2.col-md-2 {
    width: 70%;
    float: left;
}
.box .col-sm-1.col-md-1 {
    width: 30%;
    float: left;
}
.box .form-group .btn{
  width:100%;
}
.track-item {
    float: none;
    width: 100%;
    padding: 5px 0px;
}
#doctor_record_list_table_wrapper .row .col-sm-12.col-md-6 {
    width: 100%;
}
div.dataTables_wrapper div.dataTables_filter input {
    margin-left: 6.5em;
}
div.dataTables_wrapper div.dataTables_length select {
    left: -50px;
}
}
@media screen and (max-width:400px) {
.user-menu.nav > li > a {
    padding: 0 5px;
}
div.dataTables_wrapper div.dataTables_filter input {
    margin-left: 3.5em;
}
div.dataTables_wrapper div.dataTables_length select {
    left: -80px;
}
}
  </style>
  <div class="clearfix"></div>
  <div class="content container-fluid">
    <div class="row">
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style=" margin-bottom: 15px;">
      <h3 class="page-title">Records</h3>  
      <ol class="tg-breadcrumb tg-breadcrumbvtwo">     
                <li><a href="javascript:;">Dashboard</a></li>
                <li class="active">Records List</li>
            </ol>     
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
<div class="row">
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
                      </div>
    
                      <div class="row">
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
      </div>
    <div class="report_listing" id="report-list-table">
      <div class="row">
      
                  </div>

 <div class="clearfix"></div>
<div class="container-fluid track-item"> 
                  <div id="btn-place" style="margin: 10px 0px;"></div>
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
            <?php if($request_data && array_key_exists("speciality",$request_data['fields'])){ ?>
                <th style="width:10%;">Specialty</th>
            <?php } ?>       
            <?php if($request_data && array_key_exists("labNo",$request_data['fields'])){?>
                <th>Lab No.</th>
            <?php } ?>
            <?php if($request_data && array_key_exists("clinic",$request_data['fields'])){?>
                <th>Clinic</th>
            <?php } ?>
            <?php if($request_data && array_key_exists("courierNo",$request_data['fields'])){?>
                <th>Courier No.</th>
            <?php } ?>

            <?php if($request_data && array_key_exists("patient",$request_data['fields'])){?>
                <th>Patient</th>
            <?php } ?>

            <?php if($request_data && array_key_exists("pathologist",$request_data['fields'])){?>
                <th class="status_up">
              Pathologist
            </th>
            <?php } ?>

            <?php if($request_data && array_key_exists("addedby",$request_data['fields'])){?>
                <th>Added By</th>
            <?php } ?>

            <?php if($request_data && array_key_exists("requestedDate",$request_data['fields'])){?>
                <th>Requested Date</th>
            <?php } ?>

            <?php if($request_data && array_key_exists("publishedDate",$request_data['fields'])){?>
                <th>Published Date</th>
            <?php } ?>
            <?php if($request_data && array_key_exists("tat",$request_data['fields'])){?>
                <th>TAT</th>
            <?php } ?>
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
                  <?php if($request_data && array_key_exists("speciality",$request_data['fields'])){?>
                    <td class="<?php // echo $row_code; ?>">
                    <input type="checkbox"  name="select_doctor[]" class="ads_Checkbox" style="float:left" value="<?php echo $row->uralensis_request_id;?>">
                    <a class="hospital_initials" style="float:none; margin:auto;" alt="Histopathology / General" title="Histopathology / General" href="#" >
                    <?php //echo substr($row->spec_grp_name,0,1); ?>H / G</a></td>
                  <?php } ?>
                  
                  <?php if($request_data && array_key_exists("labNo",$request_data['fields'])){?> 
                    <td class="<?php // echo $row_code; ?>">
				  <a title="Edit" href="<?php echo site_url() . '/doctor/doctor_record_detail_old/' . $row->uralensis_request_id.$request_type; ?>"><?php echo $row->lab_number; ?></a><?php //echo $row->ura_barcode_no; ?></td>
                  <?php } ?>

                  <?php if($request_data && array_key_exists("clinic",$request_data['fields'])){?> 
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
                  <?php } ?>
                  
                  <?php if($request_data && array_key_exists("courierNo",$request_data['fields'])){?> 
                    <td><?= $row->courier_number; ?></td>
                  <?php } ?>

                  <?php if($request_data && array_key_exists("patient",$request_data['fields'])){?> 
                    <td>
                    <?php 
                    
                    echo $row->f_name; ?> <?php echo $row->sur_name; ?><br /><?php echo $age;
                     ?>
                  </td>
                  <?php } ?>

                  <?php if($request_data && array_key_exists("pathologist",$request_data['fields'])){?> 
                    <td>
                    <?php if($row->assign_status==1){?>
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
                  <?php } ?>

                  <?php if($request_data && array_key_exists("addedby",$request_data['fields'])){?> 
                    <td>
                   <?php

                    $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($row->request_add_user);
                    $profile_picture_path  = $decryptedDetails->profile_picture_path;
                    $img = get_profile_picture($profile_picture_path, $decryptedDetails->first_name, $decryptedDetails->last_name);
                    echo "<img src=".$img." class='avatar' title=$row->added_by>"; ?>
                       
                   </td>
                  <?php } ?>

                  <?php if($request_data && array_key_exists("requestedDate",$request_data['fields'])){?> 
                    <td><?php 
                    if (!empty($row->request_datetime)) {
                        echo  date('d-m-Y', strtotime($row->request_datetime));
                    }
                   ?></td>
                  <?php } ?>
                  <?php if($request_data && array_key_exists("publishedDate",$request_data['fields'])){?> 
                    <td><?php 
                    if (!empty($row->publish_datetime)) {
                        echo date('d-m-Y', strtotime($row->publish_datetime));
                    }
                   ?></td>
                  <?php } ?>

                  <?php if($request_data && array_key_exists("tat",$request_data['fields'])){?> 
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
                  <?php } ?>

                    
                  <!--<td><?php /*echo $courierNo; */?><br><?php /*echo $batchNo; */?></td>-->
                 
                  
                 
                   
                   
                   
                  <!--<td><br><?php //echo $lab_release_date; ?></td>-->
                  <!-- <td class="text-center"><div class="<?php echo $urgency_class; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $urgency_title; ?>" style="font-size:18px;"></div></td> -->
                  <!-- <td class="text-center">&nbsp;</td> -->
                    
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
