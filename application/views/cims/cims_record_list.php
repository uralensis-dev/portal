<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style type="text/css">
    div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top:-62px;
        height: 37px !important;
        width: 50px !important;
        left: 29px;
        padding:0;
    }
</style>
<div class="clearfix"></div>
    <div class="container-fluid">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3 class="page-title">CIMS Records</h3>
        <div class="tg-breadcrumbarea tg-searchrecordhold">
            <div class="tg-breadcrumbarea tg-searchrecordhold">
            <ol class="tg-breadcrumb tg-breadcrumbvtwo"><li><a href="<?php echo base_url();?>">Dashboard</a></li><li class="active">CIMS Record Listing</li></ol>            <div class="tg-rightarea">
                <div class="tg-haslayout">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="tg-filterhold">
                                <ul class="tg-filters record-list-filters">
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
                                            <!-- <span>
                                                <button class="btn btn-success">Search</button>
                                            </span> -->
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <button class="btn btn-primary" data-toggle="collapse" data-target="#collapse_filter_hospital">Filter By Hospital</button> -->
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
                                <span class="tg-radio tg-flagcolor4">
                                    <input class="tat" type="radio" name="tat" id="all_tat">
                                    <label for="all_tat">
                                        <img src="<?php echo base_url('/assets/icons/Show-all.png'); ?>" class="img-responsive uncheck">
                                        <img src="<?php echo base_url('/assets/icons/white/Show-all-white.png'); ?>" class="img-responsive checkd">
                                    </label>
                                </span>
                            </div>
                        </li>
                        
                        <li class="tg-flagcolor" style="padding: 3px 8px">
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
                            </div>
                        </li>

                        <li class="tg-statusbar tg-flagcolor custome-flagcolors">
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
                            </div>
                        </li>
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors last pull-right" style="padding: 0 10px;">                              
                            <button type="submit" class="btn btn-default adv-search" data-toggle="collapse" data-target="#collapse_adv_search"><i class="fa fa-cog"></i></button>
                        </li>
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors pull-right nobefore" style="padding: 0">
                            <button class="btn btn-success btn-block newbtn" type="submit" style="">
                                    Search
                                  </button>
                        </li>
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors pull-right nobefore" style="padding: 0 6px;">
                            <div class="form-focus">
                                <input type="text" class="form-control floating">
                                <label class="focus-label">Text</label>
                            </div>
                            <!-- <input type="text" class="form-control" placeholder="Text..." id="txtSearch"/ style="margin-top:-5px"> -->
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
                                <div class="col-md-3 form-group">
                                    <input class="form-control" type="text" id="first_name" name="first_name" placeholder="First Name">
                                </div>
                                <div class="col-md-3  form-group">
                                    <input class="form-control" type="text" id="sur_name" name="sur_name" placeholder="Last Name">
                                </div>
                                <div class="col-md-3 form-group">
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
                                <!-- <div class="col-md-2 form-group">
                                    <button type="submit" class="btn btn-success btn-search">Advance Search</button>
                                </div> -->
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
    </div>

    <div class="row report_listing">
        <div class="col-md-12">
            <!-- <div class="row">
                <div class="col-md-2 form-group">
                    <a onclick="window.history.back();"><button class="btn btn-primary"><i class="fa fa-backward" style="margin-right:10px;"></i> Go Back</button></a>
                </div>
            </div> -->

            <div class="flag_message"></div>
        
            <table class="table table-striped custom-table datatable" cellspacing="0" width="100%" style="margin-top:40px">
                <thead>
                    <tr>
                        <th>UL No. <br> Track No.</th>
                        <th>Client<br>Clinic</th>
                        <th>Tumor Group <br>Type</th>
                        <th>First Name <br> Surname</th>
                        <th>Accession /<br> Lab No.</th>
                        <th>NHS No.<br>DOB</th>
                        <th>Referral Receipt Date Consultant</th>
                        <th>1st Appt. Date</th>
                        <th>Pathway</th>
                        <th>CWT RTT Target</th>
                        <th class="text-center">
                            <img data-toggle="tooltip" title="Flag" src="<?php echo base_url('/assets/icons/flag-skyblue.png'); ?>" class="img-responsive centerd">
                        </th>
                        <th  class="text-center">
                            <img data-toggle="tooltip" title="Microscopic" src="<?php echo base_url('/assets/icons/VSlides.png'); ?>" class="img-responsive centerd">
                        </th>
                        <th  class="text-center">
                            <img data-toggle="tooltip" title="Comments" src="<?php echo base_url('/assets/icons/Comments.png'); ?>" class="img-responsive centerd">
                        </th>
                        <th style="width: 80px !important">
                            Status
                        </th>
                        <th>CWT</th>
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
                    <tr>
                        <td>0-20-5 <br> 452354</td>
                        <td>BHH</td>
                        <td>Dermatopathology <br> SCC</td>
                        <td>David Williams</td>
                        <td>6209834383<br>26-10-1978</td>
                        <td>20PHBB837498</td>
                        <td>24-07-2020</td>
                        <td>24-07-2020</td>
                        <td class="text-center">
                            <div class="routine" data-toggle="tooltip" data-placement="top" title="" style="font-size:18px;" data-original-title="Routine" aria-describedby="tooltip648310"></div>
                        </td>
                        <td>NA</td>
                        <td class="flag_column text-center">
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
                        </td>
                        
                        <td>
                            <img src="<?php echo base_url();?>assets/icons/vslideico.png" style="" class="img-responsive vslideico">
                        </td>
                        <td>
                            <a style="color:#000;" href="javascript:;" id="display_comment_box" class="display_comment_box">
                                        <i class="lnr lnr-bubble" style=""></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <div class="comments_icon">
                                <a  href="javascript:;" id="show_comments_list" class="show_comments_record_list">
                                    <span class="badge badge-info">With Doctor</span>
                                </a>
                            </div>
                            <div class="modal fade display_comments_list" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">×</button>
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
                        <td>
                            <a class="custom_badge_tat">
                                <span class="badge bg-warning"> 4 </span>
                            </a>
                        </td>
                        <td style="text-align:right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="<?php echo base_url()?>cims/cims_record_detail"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-eye m-r-5"></i> View</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                        <td class="hide_content">&nbsp;</td>
                        <td class="hide_content">&nbsp;</td>
                        <td class="hide_content">&nbsp;</td>
                        <td class="hide_content">&nbsp;</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>