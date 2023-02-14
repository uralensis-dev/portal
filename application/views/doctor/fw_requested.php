<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    .dataTables_wrapper .row:first-child{height: 1px;}
    div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top:-58px;
        height: 37px !important;
        width: 50px !important;
        left: 26px;
        padding:0;
    }
    div.dataTables_wrapper .dataTables_filter{display: block !important; margin: 0; color: transparent;}
    .input-group-btn{
        right: 26px;
        z-index: 999;
    }
    div.dataTables_wrapper div.dataTables_filter label{
        margin: 0;
        color: transparent;
        font-size: 1px;
    }
       div.dataTables_wrapper div.dataTables_filter {
        position: relative;
        top: -52px;
        right: 0px;
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
        line-height: 2.2;
        color: #fff;
        font-family: 'FontAwesome';
        cursor: pointer;
        height: 37px;
    }

.tg-searchrecordhold{padding: 0;}

    .form-focus .form-control {
        height: 36px;
        padding: 0 12px;
    }
    .comments_icon{
        position: relative;
    }
    .comments_icon .badge {
        position: absolute;
        top: -20px;
        right: -10px;
    }
    .users_hh {
        display: none; 
        position: absolute;
        top: 24px;
        background: #fff;
        font-size: 14px;
        border: 1px solid #ddd;
        padding: 0 5px;
        color: #555;
        cursor: default;
    }
    .like:hover .users_hh{
        display: block;
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
    ul.tg-filters.record-list-filters.new_fil li span label:focus {
        background: #006df1 !important;
        color: #fff;
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
    /*.flags_check span.tg-radio {
        display: none;
    }
    .flags_check span.tg-radio.first {
        display: block;
    }*/
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
    }
    ol.breadcrumb{float: left;}
    .no_work.bg-danger {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
}
.btn-default.bg_blue_select:hover {
    background: #006df1 !important;
    color: #fff !important;
    border-color: #006df1 !important;
}
div.dataTables_wrapper div.dataTables_length select{
    left: 0;
}
.form-width {
    width: 19%;
}
#further_work_table_requested_length,
.dataTables_wrapper div.dataTables_filter {
    position: absolute;
}
.dataTables_wrapper .row+.row {
    width: auto;
}
</style>
<div class="content container-fluid publish-record">
    <div class=''>
        <div class="row align-items-center">
            <div class="speace-setup col-sm-12">
                <h3 class="page-title">Laboratory/ Requests</h3>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-sm-6 col-lg-6">
        <div class="tg-breadcrumbarea tg-searchrecordhold">
            <ol class="tg-breadcrumb tg-breadcrumbvtwo">
                <li><a href="javascript:;">Dashboard</a></li>
                <li class="active">Requests</li>
            </ol>
</div>
</div>
<div class="col-sm-6 col-lg-6">
            <div class="tg-rightarea">
                <div class="tg-haslayout">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="tg-filterhold">
                                <!-- <ul class="tg-filters record-list-filters">
                                    <li class="tg-statusbar tg-flagcolor">
                                        <div class="tg-checkboxgroup tg-checkboxgroupvtwo">
                                            <span class="tg-radio tg-flagcolor1">
                                                <input class="tat" name="hostpital" id="nn" type="radio">
                                                <label for="nn"><span>NN</span></label>
                                            </span>
                                            <span class="tg-radio tg-flagcolor2">
                                                <input class="tat" type="radio" name="hostpital" id="vn">
                                                <label for="vn"><span>VN</span></label>
                                            </span>
                                            <span class="tg-radio tg-flagcolor3">
                                                <input class="tat" type="radio" name="hostpital" id="ss">
                                                <label for="ss"><span>SS</span></label>
                                            </span>
                                           
                                        </div>
                                    </li>
                                    <li>
                                        <button class="btn btn-default bg_blue_select btn-rounded btn-sm" onclick="print()"><i class="fa fa-print fa-2x"></i></button>
                                        <button class="btn btn-default bg_red_select btn-rounded btn-sm"><i class="fa fa-file-pdf-o fa-2x text-danger"></i></button>
                                    </li>
                                </ul> -->
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
                            <div class="tg-checkboxgroup tg-checkboxgroupvtwo">
                                <span class="tg-radio tg-flagcolor1">
                                    <input class="tat" name="tat" id="tat5"  type="radio" onClick="gettatvalue(5)">
                                    <label for="tat5"><span>&lt;5</span></label>
                                </span>
                                <span class="tg-radio tg-flagcolor2">
                                    <input class="tat" type="radio" name="tat" id="tat10" onClick="gettatvalue(10)">
                                    <label for="tat10"><span>&lt;10</span></label>
                                </span>
                                <span class="tg-radio tg-flagcolor3">
                                    <input class="tat" type="radio" name="tat" id="tat20" onClick="gettatvalue(20)">
                                    <label for="tat20"><span>&lt;20</span></label>
                                </span>
                                <span class="tg-radio tg-flagcolor4">
                                    <input class="tat" type="radio" name="tat" id="tat30" onClick="gettatvalue(30)">
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
                        
                       <!--  <li class="tg-flagcolor" style="padding: 3px 8px">
                            <div class="tg-checkboxgroup tg-checkboxgroupvtwo">
                                <?php
                                if ($this->session->userdata('color_code') !== '') {
                                    $session_color = $this->session->userdata('color_code');
                                }
                                ?>
                                <span class="tg-radio tg-flagcolor1">
                                    <?php
                                    $checked = '';
                                    if (!empty($session_color) && $session_color === 'blue') {
                                        $checked = 'checked';
                                    }
                                    ?>
                                    <input type="radio" id="flag_blue" class="flag_status" name="flag_sorting" <?php echo $checked; ?>>
                                    <label for="flag_blue"></label>
                                </span>
                                <span class="tg-radio tg-flagcolor2">
                                    <?php
                                    $checked = '';
                                    if (!empty($session_color) && $session_color === 'green') {
                                        $checked = 'checked';
                                    }
                                    ?>
                                    <input <?php echo $checked; ?> type="radio" id="flag_green" class="flag_status" name="flag_sorting">
                                    <label for="flag_green"></label>
                                </span>
                                <span class="tg-radio tg-flagcolor3">
                                    <?php
                                    $checked = '';
                                    if (!empty($session_color) && $session_color === 'yellow') {
                                        $checked = 'checked';
                                    }
                                    ?>
                                    <input <?php echo $checked; ?> type="radio" id="flag_yellow" class="flag_status" name="flag_sorting">
                                    <label for="flag_yellow"></label>
                                </span>
                                <span class="tg-radio tg-flagcolor4">
                                    <?php
                                    $checked = '';
                                    if (!empty($session_color) && $session_color === 'black') {
                                        $checked = 'checked';
                                    }
                                    ?>
                                    <input <?php echo $checked; ?> type="radio" id="flag_black" class="flag_status" name="flag_sorting">
                                    <label for="flag_black"></label>
                                </span>
                                <span class="tg-radio tg-flagcolor5">
                                    <?php
                                    $checked = '';
                                    if (!empty($session_color) && $session_color === 'red') {
                                        $checked = 'checked';
                                    }
                                    ?>
                                    <input <?php echo $checked; ?> type="radio" id="flag_red" class="flag_status" name="flag_sorting">
                                    <label for="flag_red"></label>
                                </span>
                                <span class="tg-radio tg-flagcolor6">
                                    <?php
                                    $checked = '';
                                    if (empty($session_color)) {
                                        $checked = 'checked';
                                    }
                                    ?>
                                    <input <?php echo $checked; ?> type="radio" id="flag_all" class="flag_status" name="flag_sorting">
                                    <label for="flag_all"></label>
                                </span>
                                <span class="tg-cancel tg-flagcolor4" style="display: none;">
                                    <input class="tat" type="radio" name="tat" id="all_tat">
                                    <label for="all_tat">
                                        <img src="<?php echo base_url();?>assets/img/clearAll.png" class="img-responsive clearAll">
                                    </label>
                                </span>
                            </div>
                        </li> -->
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

                        <!-- <li class="tg-statusbar tg-flagcolor custome-flagcolors">
                            <div class="tg-checkboxgroup tg-checkboxgroupvtwo">
                                
                                <span class="tg-radio tg-flagcolor4">
                                    <input id="report_urgent" class="report_urgency_status" type="radio" name="report_urgency">
                                    <label for="report_urgent">
                                        <img src="<?php echo base_url('/assets/icons/Rotate.png'); ?>" class="img-responsive uncheck">
                                        <img src="<?php echo base_url('/assets/icons/white/Rotate-white.png'); ?>" class="img-responsive checkd">
                                    </label>
                                </span>

                                <span class="tg-radio tg-flagcolor4">
                                    <input id="report_routine" class="report_urgency_status" type="radio" name="report_urgency">
                                    <label for="report_routine">
                                        <img src="<?php echo base_url('/assets/icons/Urgent-wb.png'); ?>" class="img-responsive uncheck">
                                        <img src="<?php echo base_url('/assets/icons/white/Urgent-wb-white.png'); ?>" class="img-responsive checkd">
                                    </label>
                                </span>

                                <span class="tg-radio tg-flagcolor4">
                                    <input id="report_2ww" class="report_urgency_status" type="radio" name="report_urgency">
                                    <label for="report_2ww">
                                        <img src="<?php echo base_url('/assets/icons/2ww-wc.png'); ?>" class="img-responsive uncheck">
                                        <img src="<?php echo base_url('/assets/icons/white/2ww-wc-white.png'); ?>" class="img-responsive checkd">
                                    </label>
                                </span>
                                <span class="tg-cancel tg-flagcolor4" style="display: none;">
                                    <input class="tat" type="radio" name="tat" id="all_tat">
                                    <label for="all_tat">
                                        <img src="<?php echo base_url();?>assets/img/clearAll.png" class="img-responsive clearAll">
                                    </label>
                                </span>
                            </div>
                        </li> -->
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors last pull-right" style="padding: 0 10px;">                              
                            <button type="submit" class="btn btn-default adv-search" data-toggle="collapse" data-target="#collapse_adv_search"><i class="fa fa-cog"></i></button>
                        </li>
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors pull-right nobefore search_li" style="padding: 0">
                            <!-- <div class="input-group">
                                <input type="text" class="form-control custom_search_datatable" placeholder="Search" id="publish_record_search">
                                <div class="input-group-btn">
                                  <button class="btn btn-success" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
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
                        <form class="tg-formtheme tg-advancesearch" action="<?php echo base_url('index.php/doctor/search_request'); ?>" method="post">
                            <fieldset class="col-md-12">
                                <div class="col-md-3 form-width form-group">
                                    <input class="form-control" type="text" id="first_name" name="first_name" placeholder="First Name">
                                </div>
                                <div class="col-md-3 form-width form-group">
                                    <input class="form-control" type="text" id="sur_name" name="sur_name" placeholder="Last Name">
                                </div>
                                <div class="col-md-3 form-width form-group">
                                    <input class="form-control" type="text" id="nhs_no" name="nhs_no" placeholder="NHS Number">
                                </div>
                                <div class="col-md-2 form-group tg-inputicon">
                                    <i class="lnr lnr-calendar-full"></i>
                                    <input type="text" name="dob" id="adv_dob" class="form-control unstyled" placeholder="DOB">
                                </div>
                                <div class="col-md-1 form-group">
                                    <span class="tg-select">
                                        <select data-placeholder="Gender" name="gender">
                                            <option value="">Gender</option>
                                            <option value="male" selected>Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </span>
                                </div>
                                 <div class="col-md-2 form-group">
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
                                                   
                                                    echo '<option value="' . $list_hospitals->id . '" '.$selected.'>' . $list_hospitals->description . '</option>';
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
    <div class="clearfix"></div>

    <div class="form-group">     
        <table id="further_work_table_requested" class="table table-stripped custom-table">
            <thead>
                <tr>
                    <!-- <th>Uralensis ID</th> -->
                    
                    <th>Lab No.</th>
                     <th>Block</th>
                    <th>Test</th>
                    <th>Patient Name</th>
                    <th>MRN No.</th>
                    
                    <th>Request Date & Time</th>
                    <th>
                        <img data-toggle="tooltip" title="Urgency" src="<?php echo base_url('/assets/icons/Reported--UnReported.png'); ?>" class="img-responsive">
                    </th>
                    <th style="text-align:center">Requester</th>
                    <th style="text-align:center">Lab Status</th>
                    <th>TAT</th>
                    <th>
                        <img data-toggle="tooltip" title="Actions" src="<?php echo base_url('/assets/icons/Actions-Blue.png'); ?>" class="img-responsive pull-right">
                    </th>
                </tr>
            </thead>
            <tbody>
            <?php
            if (!empty($requested)) {
                $count = 0;
				
				//print_r($requested);
				
                foreach ($requested as $row) 
				{
                    ?>
                    <tr>
                        <!-- <td><?= (!empty($row->serial_number) ? $row->serial_number : 'N/A'); ?></td> -->
                        <td><?= (!empty($row->lab_number) ? $row->lab_number : 'N/A'); ?></td>
                         <td><?=$row->further_block_no; ?></td>
                    		<td><?= (!empty($row->test_name)) ? $row->test_name : 'H&E'; ?></td>
                        <td><?= (!empty($row->patient_name) ? $row->patient_name : 'N/A'); ?></td>
                        <td><?= (!empty($row->nhs_number) ? $row->nhs_number : 'N/A'); ?></td>
                        
                         
                        <td><?= date('d-m-Y h:i A', strtotime($row->furtherwork_date)); ?></td>
                        <!-- <td></td> -->
                        <td>
                            <div class="routine" data-toggle="tooltip" data-placement="top" title="" style="font-size:18px; margin: auto;" title="Routine"></div>
                        </td>

                        <td style="text-align: center;">
                            <span class="badge badge-success"><?= $row->requester; ?></span>
                        </td>
                        <td style="text-align: center;">
                            <select class="change_further_status" data-rid="<?php echo $row->further_status_id; ?>">
                                <option value="">--Select Status--</option>
                                <option value="complete" <?php print ($row->further_starus == 'complete') ? "selected" : "";?>>complete</option>
                                <option value="requested" <?php print ($row->further_starus == 'requested') ? "selected" : "";?>>requested</option>
                            </select>
                            <!-- <span class="badge badge-success"><?php print $row->fw_status;?></span> -->
                        </td>
                        <!-- <td style="text-align: center;">
                            <select class="change_status" data-rid="<?php echo $row->request_id; ?>">
                                <option value="complete" <?php print ($row->fw_status == 'complete') ? "selected" : "";?>>complete</option>
                                <option value="requested" <?php print ($row->fw_status == 'requested') ? "selected" : "";?>>requested</option>
                            </select>
                            <!-- <span class="badge badge-success"><?php print $row->fw_status;?></span> -->
                        <!-- </td> -->
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
                                <span class="badge <?= $badge; ?>"><?= $record_old_count; ?></span>
                            </a>
                        </td>
                        <td style="text-align:center">
                            <div class="pull-right" >
                                <a href="<?php echo base_url('doctor/add_further_work_new/') . $row->request_id; ?>"<i class="fa fa-pencil edit_icon"></i></a>
                            </div>
                            <!-- <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="fa fa-eye m-r-5"></i> View</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div> -->
                        </td>
                    </tr>
                    <?php
                    $count++;
                }//endforeach
            } else {
                echo '<div class="no_work bg-danger" style="padding: 6px;margin-top: 245px;">No Further Work Requested Yet!.</div>';
            }//endif
            ?>
            </tbody>
        </table>
        
        <div class="clearfix"></div>
    </div>

    <div class="clearfix"></div>

</div></div>

<script>
    $(document).ready(function(){
        

        $(document).on('change', '.change_further_status',function(){
            var rid = $(this).attr('data-rid');
            $.ajax({
            type: "post",
            url: "<?php echo base_url(); ?>/doctor/updateFurtherRequestStatus",
            data: {
                statusChange: $(this).val(),
                changeId: rid,
                [csrf_name]: csrf_hash
            },
            success: function (response) {
                location.reload();
            },
            error: function () {
                alert("Error");
            },
        });
        });
    });
</script>