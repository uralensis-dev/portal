<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet" />
<style type="text/css">
    .page-header {
        margin:0 0 1.875rem;
        border-bottom:0px;
    }
    .content{background: #f5f5f5}
    
    div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top:-58px;
        height: 37px !important;
        width: 50px !important;
        left: 29px;
        padding:0;
    }
    /*div.dataTables_wrapper div.dataTables_filter{display: none !important}*/
    .edit_icon {
        background: #e5e5e5;
        width: 30px;
        height: 30px;
        text-align: center;
        line-height: 1.7;
        font-size: 18px;
        border-radius: 15px;
        cursor: pointer;
        color: #000;
    }
    div.dataTables_wrapper div.dataTables_filter label{
    margin: 0;
        }

        .tg-searchrecordhold{padding: 0;}

    .user_image{
        width: 50px;
        border-radius: 30px;
    }
    div.dataTables_wrapper div.dataTables_filter {
        position: relative;
        top: -52px;
        right: 60px;
        max-width: 210px;
        float: right;
    }
    div.dataTables_wrapper div.dataTables_filter input{
        border-radius: 4px;
        height: 37px !important;
    }
    div.dataTables_wrapper div.dataTables_filter:before {
        content: "\f002";
        position: absolute;
        right: 0;
        top: 0;
        bottom: 0;
        width: 40px;
        z-index: 9;
        background: #55ce63;
        text-align: center;
        line-height: 2;
        color: #fff;
        font-family: 'FontAwesome';
        cursor: pointer;
    }
    .dataTables_wrapper .row:first-child{height: 1px;}
    
    .doct_pic_table{
        width: 40px;
        float: left;
        border-radius: 20px;
        margin-right: 5px;
    }
    .table.custom-table .dropdown-menu .dropdown-item{font-size: 14px;}
    .ubpub_pic{width: 25px; margin: 0 auto;}
    .record_id_unpublish:focus{outline: none;}
    .user-menu.nav > li > a > img{padding-top: 19px;}
    #admin_display_records.table > thead > tr > th:last-child,
    #admin_display_records.table > tbody > tr > td:last-child{
        text-align: right;
    }
    div.dataTables_wrapper div.dataTables_length select{
        padding: 0 10px;
    }
    .tg-cancel input{
        display: none;
    }

    .tg-cancel label i {
        color: red;
    }

    .tg-cancel label {
        cursor: pointer;
        margin-bottom: 0;
        width: 40px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 50%;
        margin-left: 2px;
    }
    div.dataTables_wrapper .dataTables_filter {
        display: block !important;
    }
    @media screen and (min-width: 1480px){
        div.dataTables_wrapper div.dataTables_filter{
            top:-58px;
            right: 70px;
        }
    }
    .tg-statusbar.tg-flagcolor .tg-checkboxgroup .tg-radio label{font-size: 14px;}
    .tg-filters > li.last .adv-search{line-height: 1.5;}
</style>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Patients</h3>
            <!-- <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('patient'); ?>">Patients</a></li>
            </ul> -->
        </div>
        <div class="col-auto float-right ml-auto">
            <div class="tg-breadcrumbarea tg-searchrecordhold">
            <?php echo $breadcrumbs; ?>
            <div class="tg-rightarea">
                <div class="tg-haslayout">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopadding-right">
                            <div class="tg-filterhold">
                                <ul class="tg-filters record-list-filters">
                                    <li class="tg-statusbar tg-flagcolor" style="padding-right: 10px !important;">
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
            </div>
        </div>
            <?php if ($group_type != 'D') : ?>
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_patient"><i class="fa fa-plus"></i>Patient</a>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- /Page Header -->
<div class="tg-haslayout">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-filterhold">
                    <ul class="tg-filters record-list-filters">
                        <li class="tg-statusbar tg-flagcolor">
                            
                        </li>
                        <li class="tg-statusbar tg-flagcolor" style="padding: 5px">
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
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors last float-right" style="padding: 0 10px; display:none">                              
                            <button type="submit" class="btn btn-default adv-search" data-toggle="collapse" data-target="#collapse_adv_search"><i class="fa fa-cog"></i></button>
                        </li>
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors float-right nobefore search_li" style="padding: 0">
                            <!-- <div class="input-group">
                                <input id="unpub_custom_filter" type="text" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                  <button class="btn btn-success" type="submit">
                                    <i class="fa fa-search"></i>
                                  </button>
                                </div>
                            </div> -->
                        </li>
                    </ul>
                </div>
            </div>
        </div>
</div>
<div class="tg-dashboardform tg-haslayout custom-haslayout">
    <div class="collapse" id="collapse_adv_search">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-dashboardformhold">
                    <form class="tg-formtheme" action="<?php echo base_url('index.php/doctor/search_request'); ?>" method="post">
                        <fieldset class="row col-md-12">
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
                        <fieldset class="col-md-12 row" style="padding-top: 10px !important;">
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
<!-- <div class="row mb-3">
    <div class="col text-right">
        <?php foreach ($hospitals as $h) : ?>
            <div data-toggle="tooltip" data-placement="top" title="<?php echo $h['description']; ?>" class="hospital-info"><?php echo $h['first_initial'] . $h['last_initial'] ?></div>
        <?php endforeach; ?>
        <span class="lnr lnr-cross-circle" id="clear-hospital" style="margin-left: 10px; position: relative; top: 4px; cursor: pointer;"></span>
    </div>
</div>
 -->
<div class="">
    <table class="table custom-table table-striped datatables" id="patient-table" style="width: 100%;">
        <thead>
            <tr>
                <th>Animal ID</th>
                <th>Animal Name</th>
                <th>Owner Name</th>
                <th>Species</th>                
                <th>Practice</th>
                <th>DOB<br>Age</th>
                <th>Sex</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>


<div id="add_patient" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">New Patient</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tg-editformholder">
                    <?php echo form_open('', array('id' => 'add-patient-form', 'class' => 'tg-formtheme tg-editform create_user_form')); ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <!-- Patient Personal Information START -->
                            <fieldset>
                                <div class="form-group">
                                    <?php 
									//print $group_type."========";
									
									if ($group_type == 'H') { ?>
                                        <input type="hidden" id="group-input" name="group" value="<?php echo $hospitals[0]['id']; ?>">
                                        <input type="text" readonly disabled name="group-text" value="<?php echo $hospitals[0]['description']; ?>" class="form-control">
                                    <?php }
                                    if ($group_type == 'A' || $group_type == 'L' || $group_type == 'LA') { ?>
                                        
                                        <select type="text" name="group" id="group-input" value="" class="form-control select">
                                        <option value="">Select Hospital</option>
                                            <?php foreach ($hospitals as $hospital) : ?>
                                                <option value="<?php echo $hospital['id'] ?>"><?php echo $hospital['description']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php } ?>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-user"></i>
                                            <input type="text" name="first_name" id="first-name-input" value="" class="form-control" placeholder="Name">
                                        </div>
                                    </div>
                                   <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-user"></i>
                                            <input type="text" name="animal_id" id="animal_id" value="" class="form-control" placeholder="Animal ID">
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-user"></i>
                                            <input type="text" name="species" id="last-name-input" value="" class="form-control" placeholder="Species Name">
                                        </div>
                                    </div>
                                <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-license"></i>
                                            <input type="text" name="breed" id="breed" value="" class="form-control" placeholder="Breed">
                                        </div>
                                    </div>
                                
                                    
                                    
                                    
                                </div>
                                
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            
                                            <select name="gender" id="gender-input" value="" class="form-control">
                                                <option value="">Select Gender</option>
                                                <option value="Male Neutered">Male Neutered</option>
                                                <option value="Female Neutered">Female Neutered</option>
                                                <option value="Male Entire">Male Entire </option>
                                                <option value="Female Entire">Female Entire </option>
                                                <option value="Male Unknown">Male Unknown</option>
                                                <option value="Female Unknown">Female Unknown</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            
                                            <i class="lnr lnr-calendar-full"></i>
                                            <input type="date" name="dob" id="dob-input" value="" class="form-control" placeholder="Age">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                <div class="col-md-12">
                                        <div class="form-group tg-inputwithicon">
                                            <label for="gender-input">Owner Name</label>
                                            <input type="text" name="owner_name" id="owner_name" value="" class="form-control" placeholder="Owner Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="password-row">
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-envelope"></i>
                                            <input type="email" name="email" id="email-input" value="" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <span>
                                                <i class="lnr lnr-phone-handset"></i>
                                            </span>
                                            <input type="text" name="phone" id="phone-input" value="" class="form-control" placeholder="Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group tg-inputwithicon">
                                            <label for="address1-input">Address</label>
                                            <i class="lnr lnr-apartment"></i>
                                            <input type="text" name="address1" id="address1-input" value="" class="form-control" placeholder="Address Line 1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-apartment"></i>
                                            <input type="text" name="address2" id="address2-input" value="" class="form-control" placeholder="Address Line 2">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-map-marker"></i>
                                            <input type="text" name="city" id="city-input" value="" class="form-control" placeholder="City">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-map"></i>
                                            <input type="text" name="state" id="state-input" value="" class="form-control" placeholder="State">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-earth"></i>
                                            <input type="text" name="country" id="country-input" value="United Kingdom" class="form-control" placeholder="Country">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-pushpin"></i>
                                            <input type="text" name="post_code" id="post-code-input" value="" class="form-control" placeholder="Post Code">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success" id="user-create-btn">Create</button>
                                    <button class="btn btn-warning" id="user-form-clear-btn" type="button">Clear</button>
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
