<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    /*.container-fluid{
        margin-left: 20px;
    }*/
    div.dataTables_wrapper div.dataTables_length select {
        width: 55px;
        display: inline-block;
        padding: 0 5px;
        position: absolute;
        top: -56px;
        /*left: 0;*/
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
        width: 45px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 50%;
    }
     @media screen and (min-width: 1600px) {
        body{font-size: 18px;}
    }
    @media screen and (max-width: 1580px) {
        .tg-cancel label {
            width: 35px;
            padding: 5px;
        }
        div.dataTables_wrapper div.dataTables_length select{top: -59px;}
    }
</style>
<div class="container-fluid">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3 class="page-title">Request Details </h3>
        <div class="tg-breadcrumbarea tg-searchrecordhold">
            <div class="tg-breadcrumbarea tg-searchrecordhold">
                <ol class="tg-breadcrumb tg-breadcrumbvtwo">
                    <li><a href="javascript:;">Dashboard</a></li>
                    <li><a href="javascript:;" class="active">View Request Details</a></li>
                </ol>
                
            </div>
            <div class="tg-rightarea">
                <div class="tg-haslayout">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopadding-right">
                            <div class="tg-filterhold">
                                <ul class="tg-filters record-list-filters">
                                    <li class="tg-statusbar tg-flagcolor">
                                        <div class="tg-checkboxgroup tg-checkboxgroupvtwo">
                                            <?php $hospitals = getAllHospitals(); ?>
                                            <?php foreach($hospitals as $hospital): ?>
                                            <span title="<?php echo $hospital['description']?>" class="tg-radio tg-flagcolor1">
                                                <input value="<?php echo $hospital['id']?>" class="filter_by_hospital_btn" name="hostpital" id="<?php echo $hospital['first_initial']?><?php echo $hospital['last_initial']?>"  type="radio">
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
    </div>
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
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors last pull-right" style="padding: 0 10px;">                              
                            <button type="submit" class="btn btn-default adv-search" data-toggle="collapse" data-target="#collapse_adv_search"><i class="fa fa-cog"></i></button>
                        </li>
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors pull-right nobefore search_li" style="padding: 0">
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
    <!-- <div class="col-md-12">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-info">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Enable/Disable Search
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">

                    <?php echo form_open("Institute/search_request", array('class' => '')); ?>
                   
                            <table class="table table-bordered">
                                <tr class="bg-primary">
                                    <th>Emis No</th>
                                    <th>NHS No</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Lab No</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input class="form-control" type="text" id="emis_no" name="emis_no">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="nhs_no" name="nhs_no">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="f_name" name="f_name">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="l_name" name="l_name">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="lab_no" name="lab_no">
                                    </td>
                                </tr>

                            </table>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-warning">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
<?php
?>

<!--Flag Sorting Start-->
<!-- <div class="col-md-12">
    <div class="flag_sorting">
</div>
    <label for="flag_green">
        <input type="radio" name="flag_sorting" id="flag_green" class="flag_status">
        <img data-toggle="tooltip" data-placement="top" title="This case marked as released." src="<?php echo base_url('assets/img/flag_green.png'); ?>">
    </label>
    <label for="flag_red">
        <input type="radio" name="flag_sorting" id="flag_red" class="flag_status">
        <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="<?php echo base_url('assets/img/flag_red.png'); ?>">
    </label>
    <label for="flag_yellow">
        <input type="radio" name="flag_sorting" id="flag_yellow" class="flag_status">
        <img data-toggle="tooltip" data-placement="top" title="This case marked for typing." src="<?php echo base_url('assets/img/flag_yellow.png'); ?>">
    </label>
    <label for="flag_blue">
        <input type="radio" name="flag_sorting" id="flag_blue" class="flag_status">
        <img data-toggle="tooltip" data-placement="top" title="This case marked for pre authorization." src="<?php echo base_url('assets/img/flag_blue.png'); ?>">
    </label>
    <label for="flag_black">
        <input type="radio" name="flag_sorting" id="flag_black" class="flag_status">
        <img data-toggle="tooltip" data-placement="top" title="This case marked as further work." src="<?php echo base_url('assets/img/flag_black.png'); ?>">
    </label>
    <label for="flag_all">
        <input type="radio" name="flag_sorting" id="flag_all" class="flag_status">
        <img src="<?php echo base_url('assets/img/flag_all.png'); ?>">
    </label>
</div> -->
<!--Flag Sorting End-->
<div class="report_listing">
        <?php echo $this->session->flashdata('record-msg'); ?>
        <div class="flag_message"></div>
    <div class="col-md-12 table-responsive">
        <!-- <h3 class="text-center">Submitted Records</h3> -->
        <table id="display_submitted_records" class="table table-striped custom-table datatable" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>UL No.<br />Track No.</th>
                    <th>Client<br />Clinic</th>
                    <th>Batch<br />PCI No.</th>
                    <th>First<br />Surname</th>
                    <th>NHS No.<br />DOB</th>
                    <th>LAB No.<br />EMIS No.</th>
                    <th><i class="lnr lnr-layers" style="font-size:18px;"></i></th>
                    <th style="text-align: center; width: 104px;">Flag</th>
                    <th><i class="lnr lnr-bubble" style="font-size:18px;"></i></th>
                    <th><i class="lnr lnr-file-empty" style="font-size:18px;"></i></th>
                    <th>Detail</th>
                    <th>Status</th>
                    <th>V.Report</th>
                    <th>D.Report</th>
                    <th>Docs</th>
                    <th class="hide_content">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $flag_count = 11;
                if (count($query) == 0) {
                    echo '<p class="bg-danger" style="padding:5px;">Sorry there is no record yet. Kindly Add Request to see the submitted request.</p>';
                } else {
                    foreach ($query as $row) {
                        $row_code = '';

                        if (!empty($row->request_code_status) && $row->request_code_status === 'new') {
                            $row_code = 'row_yellow';
                        } elseif (!empty($row->request_code_status) && $row->request_code_status === 'rec_by_lab') {
                            $row_code = 'row_orange';
                        } elseif (!empty($row->request_code_status) && $row->request_code_status === 'pci_added') {
                            $row_code = 'row_purple';
                        } elseif (!empty($row->request_code_status) && $row->request_code_status === 'assign_doctor') {
                            $row_code = 'row_green';
                        } elseif (!empty($row->request_code_status) && $row->request_code_status === 'micro_add') {
                            $row_code = 'row_skyblue';
                        } elseif (!empty($row->request_code_status) && $row->request_code_status === 'add_to_authorize') {
                            $row_code = 'row_blue';
                        } elseif (!empty($row->request_code_status) && $row->request_code_status === 'furtherwork_add') {
                            $row_code = 'row_brown';
                        } elseif (!empty($row->request_code_status) && $row->request_code_status === 'record_publish') {
                            $row_code = 'row_white';
                        }

                        $urgency_class = '';
                        $urgency_title = '';
                        if (!empty($row->report_urgency) && $row->report_urgency === 'Urgent') {
                            $urgency_class = 'lnr lnr-star';
                            $urgency_title = 'Urgent';
                        } elseif (!empty($row->report_urgency) && $row->report_urgency === '2WW') {
                            $urgency_class = 'lnr lnr-heart';
                            $urgency_title = '2WW';
                        } else {
                            $urgency_class = 'lnr lnr-sync';
                            $urgency_title = 'Routine';
                        }

                        $dob = '';
                        if (!empty($row->dob)) {
                            $dob = date('d-m-Y', strtotime($row->dob));
                        }
                        $lab_release_date = '';
                        if (!empty($row->date_received_bylab)) {
                            $lab_release_date = date('d-m-Y', strtotime($row->date_received_bylab));
                        }
                        $batch_no = '';
                        if (!empty($row->record_batch_id)) {
                            $batch_no = $row->record_batch_id;
                        }
                        ?>
                        <tr class="<?php echo $row_code; ?>">
                            <td class="<?php echo $row_code; ?>"><?php echo html_purify($row->serial_number); ?><br><?php echo $row->ura_barcode_no; ?></td>
                            <td>
                                <?php
                                $f_initial = '';
                                $l_initial = '';
                                if (!empty($this->ion_auth->group($row->hospital_group_id)->row()->first_initial)) {
                                    $f_initial = $this->ion_auth->group($row->hospital_group_id)->row()->first_initial;
                                }
                                if (!empty($this->ion_auth->group($row->hospital_group_id)->row()->last_initial)) {
                                    $l_initial = $this->ion_auth->group($row->hospital_group_id)->row()->last_initial;
                                }
                                ?>
                                <a class="hospital_initials" data-toggle="tooltip" data-placement="top" title="<?php echo $this->ion_auth->group(intval($row->hospital_group_id))->row()->description; ?>" href="javascript:;" >
                                    <?php echo $f_initial . ' ' . $l_initial; ?>
                                </a>
                            </td>
                            <td><?php echo html_purify($batch_no); ?><br><?php echo html_purify($row->pci_number); ?></td>
                            <td><?php echo html_purify($row->f_name); ?><br><?php echo $row->sur_name; ?></td>
                            <td><?php echo html_purify($row->nhs_number); ?><br><?php echo $dob; ?></td>
                            <td><?php echo html_purify($row->lab_number); ?><br><?php echo html_purify($row->emis_number); ?></td>
                            <td><i class="<?php echo $urgency_class; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $urgency_title; ?>" style="font-size:18px;"></i></td>
                            <td class="flag_column">
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
                                    <ul class="report_flags list-unstyled list-inline" style="display:none;">
                                        <?php
                                        $active = '';
                                        if ($row->flag_status === 'flag_green') {
                                            $active = 'flag_active';
                                        }
                                        ?>
                                        <li class="<?php echo $active; ?>">
                                            <a href="javascript:;" data-flag="flag_green" data-serial="<?php echo html_purify($row->serial_number); ?>" data-recordid="<?php echo intval($row->uralensis_request_id); ?>" class="flag_change">
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
                                            <a href="javascript:;" data-flag="flag_red" data-serial="<?php echo html_purify($row->serial_number); ?>" data-recordid="<?php echo intval($row->uralensis_request_id); ?>" class="flag_change">
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
                                            <a href="javascript:;" data-flag="flag_yellow" data-serial="<?php echo html_purify($row->serial_number); ?>" data-recordid="<?php echo intval($row->uralensis_request_id); ?>" class="flag_change">
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
                                            <a href="javascript:;" data-flag="flag_blue" data-serial="<?php echo html_purify($row->serial_number); ?>" data-recordid="<?php echo intval($row->uralensis_request_id); ?>" class="flag_change">
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
                                            <a href="javascript:;" data-flag="flag_black" data-serial="<?php echo html_purify($row->serial_number); ?>" data-recordid="<?php echo intval($row->uralensis_request_id); ?>" class="flag_change">
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
                                            <a href="javascript:;" data-flag="flag_gray" data-serial="<?php echo html_purify($row->serial_number); ?>" data-recordid="<?php echo intval($row->uralensis_request_id); ?>" class="flag_change">
                                                <img data-toggle="tooltip" data-placement="top" title="This case marked awaiting reviews." src="<?php echo base_url('assets/img/flag_gray.png'); ?>">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="comments_icon">
                                    <a style="color:#000;" href="javascript:;" id="display_comment_box" class="display_comment_box" data-recordid="<?php echo intval($row->uralensis_request_id); ?>" data-modalid="<?php echo $flag_count; ?>">
                                        <i class="lnr lnr-bubble" style="font-size:18px;font-weight:bold;"></i>
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
                                                        <input type="hidden" name="record_id" value="<?php echo intval($row->uralensis_request_id); ?>">
                                                        <a class="btn btn-primary" id="flag_comments_save" href="javascript:;">Save Comments</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="comments_icon">
                                    <a style="color:#000;" href="javascript:;" id="show_comments_list" class="show_comments_list" data-recordid="<?php echo intval($row->uralensis_request_id); ?>" data-modalid="<?php echo $flag_count; ?>">
                                        <i class="lnr lnr-file-empty" style="font-size:18px;font-weight:bold;"></i>
                                    </a>
                                </div>
                                <div id="display_comments_list-<?php echo $flag_count; ?>" class="modal fade display_comments_list" role="dialog" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Flag Comments</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="display_flag_msg"></div>
                                                <div class="flag_comments_dynamic_data"></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="text-align:center;"><a href="<?php echo site_url() . '/Institute/view_singlerecord/' . intval($row->uralensis_request_id); ?>"><img src="<?php echo base_url('assets/img/detail.png'); ?>"></a></td>
                            <td style="text-align:center;">
                                <?php
                                if ($row->status == 0) {
                                    echo '<span data-toggle="tooltip" data-placement="top" title="In Progress."><img src="' . base_url('assets/img/error.png') . '"></span>';
                                } else {
                                    echo '<span data-toggle="tooltip" data-placement="top" title="Completed." style="color:green;"><img src="/uralensis/assets/img/success.gif"></span>';
                                }
                                ?>
                            </td>
                            <?php
                            if ($row->specimen_publish_status == 1) {
                                echo '<td style="text-align:center;"><a data-toggle="tooltip" data-placement="top" title="View Report." target="_blank" href="' . site_url('Institute/view_single_final/' . intval($row->uralensis_request_id)) . '">V.Report</a></td>';
                            } else {
                                echo '<td style="text-align:center;"><span data-toggle="tooltip" data-placement="top" title="Report not submitted by doctor.">N-S</span></td>';
                            }
                            ?>
                            <?php
                            if ($row->specimen_publish_status == 1) {
                                echo '<td style="text-align:center;"><a data-toggle="tooltip" data-placement="top" title="Download Report." href="' . site_url('Institute/download_pdf/' . intval($row->uralensis_request_id)) . '"><img src="' . base_url('assets/img/download.png') . '">D.Report</a></td>';
                            } else {
                                echo '<td style="text-align:center;"><span data-toggle="tooltip" data-placement="top" title="Not Submitted By Doctor.">N-S</span></td>';
                            }
                            ?>
                            <td style="text-align:center;">
                                <a data-toggle="tooltip" data-placement="top" title="Record Attached Documents." href="<?php echo site_url() . '/institute/institute_download_section/' . intval($row->uralensis_request_id); ?>"><img src="<?php echo base_url('assets/img/adobe.png'); ?>" /></a>
                            </td>
                            <td class="hide_content">
                                <p style="display:none;"><?php echo $row->flag_status; ?></p>
                            </td>
                        </tr>
                        <?php
                        $flag_count++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="clearfix"></div>
</div>
    <div class="clearfix"></div>

