<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style type="text/css">
    div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top:-65px;
        height: 37px !important;
        width: 50px !important;
        left: 29px;
        padding:0;
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
    /*.flags_check span.tg-radio {
        display: none;
    }
    .flags_check span.tg-radio.first {
        display: block;
    }*/

    @media screen and (min-width: 1600px) {
        body{font-size: 18px;}
    }
    @media screen and (min-width: 1380px) {
        .tg-cancel label {
            width: 35px;
            padding: 5px;
        }
        div.dataTables_wrapper div.dataTables_length select{top: -119px;}
    }
    ol.breadcrumb{float: left;}

    .clear_btn{
        cursor: pointer;
        margin-bottom: 0;
        margin-top: 5px;
        width: 50px !important;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 50%;
        display: inline-block;
    }
</style>
<div class="clearfix"></div>
<div class="container-fluid">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3 class="page-title">Records</h3>
        <div class="tg-breadcrumbarea tg-searchrecordhold">
            <?php echo $breadcrumbs; ?>
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
        <?php
        if ($this->session->flashdata('record_status') != '') { ?>
            <p class="bg-success" style="padding:7px;"><?php echo $this->session->flashdata('record_status'); ?></p>
        <?php } ?>
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
                        <!--                        <li class="tg-statusbar tg-flagcolor custome-flagcolors nobefore search_li" style="padding: 0">-->
                        <!--                                --><?php
                        //                                $attributes = array('method' => 'POST', 'id'=>'search_opinion_form');
                        //                                echo form_open('doctor/doctor_opinion_cases', $attributes); ?>
                        <!--                            <div class="input-group">-->
                        <!--                                <select name="sr_opinion_status" class="form-control" onchange="search_by_status()">-->
                        <!--                                    <optgroup label="Opinion Status">-->
                        <!--                                    <option value="Pending" --><?php //echo ($sr_opinion_status == 'Pending'?'selected':''); ?><!-- > -->
                        <!--                                        Pending Acceptance</option>-->
                        <!--                                    <option value="Accepted" --><?php //echo ($sr_opinion_status == 'Accepted'?'selected':''); ?><!-- > -->
                        <!--                                        Pending Reply</option>-->
                        <!--                                    <option value="Rejected" --><?php //echo ($sr_opinion_status == 'Rejected'?'selected':''); ?><!-- > -->
                        <!--                                        Rejected</option>-->
                        <!--                                    <option value="Reply Sent" --><?php //echo ($sr_opinion_status == 'Reply Sent'?'selected':''); ?><!-- > -->
                        <!--                                        Reply Sent</option>-->
                        <!--                                    </optgroup>-->
                        <!--                                </select>-->
                        <!--                            </div>-->
                        <!--                            --><?php //echo form_close(); ?>
                        <!--                        </li>-->
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


    <div class="row">
        <div class="col-md-12" style="margin-bottom: 60px;">
            <?php
            if (isset($_GET['msg']) && $_GET['msg'] == 'success') {

                echo '<p class="bg-success" style="padding:7px;">Report Has Been Successfully Published.</p>';
            }
            if ($this->session->flashdata('unpublish_record_message') != '') {
                echo $this->session->flashdata('unpublish_record_message');
            }
            ?>
        </div>
    </div>

    <div class="row report_listing">
        <div class="col-md-12">
            <div class="flag_message"></div>

            <table id="doctor_opinion_requested_list_table"  class="table table-responsive table-striped custom-table" cellspacing="0" style="overflow: scroll;">
                <thead>
                <tr>
                    <th>Specimen Type</th>
                    <th>UL No. <br> Track No.</th>
                    <th>Client<br>Clinic</th>
                    <!--                    <th>Courier No. <br> Batch No</th>-->
                    <th>Speciality</th>
                    <th>Accession /<br> Lab No.</th>
                    <th>First Name <br> Surname</th>
                    <th>NHS No.<br>DOB</th>
                    <th>Digi No.<br>Rel Date</th>
                    <th>
                        <!-- <i class="lnr lnr-layers" style="font-size:18px;"></i> -->
                        <img data-toggle="tooltip" title="Urgency" src="<?php echo base_url('/assets/icons/Reported--UnReported.png'); ?>" class="img-responsive">
                    </th>
                    <!-- <th>
                            <img data-toggle="tooltip" title="Status" src="<?php //echo base_url('/assets/icons/Track-Status.png'); ?>" class="img-responsive">
                            Status
                        </th> -->
                    <th class="text-center">
                        <!-- Flag -->
                        <!-- <i class="fa fa-flag-o"></i> -->
                        <img data-toggle="tooltip" title="Flag" src="<?php echo base_url('/assets/icons/flag-skyblue.png'); ?>" class="img-responsive centerd">
                    </th>
                    <th  class="text-center">
                        <img data-toggle="tooltip" title="Microscopic" src="<?php echo base_url('/assets/icons/VSlides.png'); ?>" class="img-responsive centerd">
                    </th>
                    <th  class="text-center">
                        <!-- <i class="lnr lnr-bubble" style="font-size::;"></i> -->
                        <img data-toggle="tooltip" title="Comments" src="<?php echo base_url('/assets/icons/Comments.png'); ?>" class="img-responsive centerd">
                    </th>
                    <th class="status_up">
                        Status
                        <!-- <i class="lnr lnr-file-empty" style="font-size:18px;"></i> -->
                        <!-- <img src="<?php //echo base_url('/assets/icons/Status.png'); ?>" class="img-responsive"> -->
                    </th>
                    <th>Opinion Status</th>
                    <th>Opinion Due Date</th>
                    <th>TAT</th>
                    <!--                    <th  class="text-right">-->
                    <!--                        <img data-toggle="tooltip" title="Actions" src="--><?php //echo base_url('/assets/icons/Actions-Blue.png'); ?><!--" class="img-responsive pull-right">-->
                    <!--                    </th>-->
                    <th class="hide_content">&nbsp;</th>
                    <th class="hide_content">&nbsp;</th>
                    <th class="hide_content">&nbsp;</th>
                    <th class="hide_content">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $flag_count = 11;
                foreach ($opinion_cases as $row) {
                    // $row_code = '';

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
                    $has_slide = false;
                    foreach($request_slides_id as $id) {
                        if ($id->record_id == $row->uralensis_request_id) {
                            $has_slide = true;
                        }
                    }

                    ?>
                    <tr class="<?php //echo $row_code; ?>">
                        <td><?php echo $row->spec_grp_name; ?></td>
                        <td class="<?php // echo $row_code; ?>"><?php echo $row->serial_number; ?><br><?php echo $row->ura_barcode_no; ?></td>
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
                            <a class="hospital_initials" data-toggle="tooltip" data-placement="top" title="<?php echo $this->ion_auth->group($row->hospital_group_id)->row()->description; ?>" href="javascript:;" >
                                <?php echo $f_initial . ' ' . $l_initial; ?>
                            </a>
                        </td>
                        <!--                        <td style="width:146px !important" width="146">--><?php //echo $courierNo; ?><!--<br>--><?php //echo $batchNo; ?><!--</td>-->
                        <td>Dermatopathology</td>
                        <td><?php echo $row->pci_number; ?><br></td>
                        <td style="width:93px !important" width="93"><?php echo $row->f_name; ?><br><?php echo $row->sur_name; ?></td>
                        <td><?php echo $row->nhs_number; ?><br><?php echo $dob; ?></td>
                        <td><?php echo $row->lab_number; ?><br><?php echo $lab_release_date; ?></td>
                        <td class="text-center"><div class="<?php echo $urgency_class; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $urgency_title; ?>" style="font-size:18px;"></div></td>
                        <!-- <td class="text-center">&nbsp;</td> -->
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
                            <img src="<?php if ($has_slide) echo base_url('/assets/icons/vslideico_green.png'); else echo base_url('/assets/icons/vslideico.png'); ?>" style="<?php if ($has_slide) echo 'width: 25px;'?>" class="img-responsive vslideico">
                        </td>
                        <td>
                            <div class="comments_icon">
                                <a style="color:#000;" href="javascript:;" id="display_comment_box" class="display_comment_box" data-recordid="<?php echo $row->uralensis_request_id; ?>" data-modalid="<?php echo $flag_count; ?>">
                                    <i class="lnr lnr-bubble" style=""></i>
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
                        <td class="text-center">
                            <div class="comments_icon">
                                <a style="color:#000;" href="javascript:;" id="show_comments_list" class="show_comments_record_list" data-recordid="<?php echo $row->uralensis_request_id; ?>" data-modalid="<?php echo $flag_count; ?>">
                                    <!-- <i class="lnr lnr-file-empty" style=""></i> -->
                                    <span class="badge  badge-info">With Doctor</span>
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
                        <td>
                            <div class="comments_icon">
                                <?php
                                $opinion_status = "";
                                $badge_color = "";
                                $status_text = "";
                                $data_toggle = "";
                                $data_target = "";
                                $data_onclick = "";
                                $a_href = "javascript:void(0);";
                                if(!empty($row->ura_rec_opinion_status)){
                                    $opinion_status = $row->ura_rec_opinion_status;
                                    if($opinion_status=='Pending'){
                                        $badge_color = "#ff6a1a";
                                        $status_text = "Pending";
//                                        $data_toggle = 'data-toggle="modal"';
//                                        $data_target = 'data-target="#update_opinion_status"';
//                                        $data_onclick = 'onclick="set_opinion_id('.$row->ura_opinion_id.')"'; ?>
                                        <a style="color:#000;" class="opinion_status_btn" href="<?php echo $a_href; ?>" <?php echo $data_toggle; ?> <?php echo $data_target; ?> <?php echo $data_onclick; ?> >
                                            
                                            <i class="fa fa-dot-circle-o" style="font-size: 18px; color: <?php echo $badge_color; ?>;"></i> <?php echo $status_text; ?> 
<!--                                            <span class="badge  --><?php //echo $badge_color; ?><!--">--><?php //echo $status_text; ?><!--</span>-->
                                        </a>
                                    <?php }else{
                                        if($opinion_status== 'Accepted'){
                                            $badge_color = "#188508";
                                            $status_text = "Accepted";
//                                            if($row->speciality_group_id== '2'){
//                                                $a_href = base_url('doctor/opinion_record_detail_new/').$row->uralensis_request_id.'/postmortem';
//                                            }else{
//                                                $a_href = base_url('doctor/opinion_record_detail_new/').$row->uralensis_request_id;
//                                            }
                                        }elseif($opinion_status == 'Rejected'){
                                            $badge_color = "#f62d51";
                                            $status_text = "Rejected";
                                        }elseif($opinion_status == 'Reply Sent'){
                                            $badge_color = "#00c5fb";
                                            $status_text = "Replied ";
                                        } ?>
                                         <a style="color:#000;" class="opinion_status_btn" href="<?php echo $a_href; ?>" <?php echo $data_toggle; ?> <?php echo $data_target; ?> <?php echo $data_onclick; ?> >
                                            
                                            <i class="fa fa-dot-circle-o" style="font-size: 18px; color: <?php echo $badge_color; ?>;"></i> <?php echo $status_text; ?> 
<!--                                            <span class="badge  --><?php //echo $badge_color; ?><!--">--><?php //echo $status_text; ?><!--</span>-->
                                        </a>
                                        
                                    <?php }

                                }

                                ?>
                            </div>
                        </td>
                        <td>
                            <!--                            --><?php //echo $row->ura_opinion_last_date; ?>
                            <?php echo (!empty($row->ura_opinion_last_date)?date('d-m-Y', strtotime($row->ura_opinion_last_date)):''); ?>
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
                        <!--                        <td style="text-align:right">-->
                        <!--                            <div class="dropdown dropdown-action">-->
                        <!--                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>-->
                        <!--                                <div class="dropdown-menu dropdown-menu-right">-->
                        <!--                                    <a class="dropdown-item" href="--><?php //echo site_url() . '/doctor/doctor_record_detail/' . $row->uralensis_request_id; ?><!--"><i class="fa fa-pencil m-r-5"></i> Edit</a>-->
                        <!--                                    <a class="dropdown-item" href="#"><i class="fa fa-eye m-r-5"></i> View</a>-->
                        <!--                                    <a class="dropdown-item" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </td>-->
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
                    <?php
                    $flag_count++;
                }//endforeach
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <!--    <div id="update_opinion_status" class="modal custom-modal fade" role="dialog">-->
    <!--        <div class="modal-dialog modal-dialog-centered modal-sm">-->
    <!--            <div class="modal-content">-->
    <!--                <div class="modal-header">-->
    <!--                    <h5 class="modal-title">Opinion Status</h5>-->
    <!--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
    <!--                        <span aria-hidden="true">&times;</span>-->
    <!--                    </button>-->
    <!--                </div>-->
    <!--                --><?php
    //                $attributes = array('method' => 'POST');
    //                echo form_open('doctor/update_opinion_status', $attributes); ?>
    <!--                <div class="modal-body">-->
    <!--                    <section class="form-group">-->
    <!--                        <div class="row">-->
    <!--                            <input type="hidden" id="txt_opinion_id" name="opinion_id" value="">-->
    <!--                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">-->
    <!--                                <label>Accept/Reject opinion</label>-->
    <!--                                <select name="opinion_status" class="form-control">-->
    <!--                                    <option value="Accepted">Accept</option>-->
    <!--                                    <option value="Rejected">Reject</option>-->
    <!--                                </select>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </section>-->
    <!--                </div>-->
    <!--                <div class="modal-footer">-->
    <!--                    <button class="btn btn-info btn-lg btn-rounded">Update Opinion Status</button>-->
    <!--                </div>-->
    <!--                --><?php //form_close(); ?>
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->

    <div id="reject_opinion_request" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Are you sure you want to reject this case?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
                $attributes = array('method' => 'POST');
                echo form_open('doctor/reject_opinion_request', $attributes); ?>
                <div class="modal-body">
                    <section class="form-group">
                        <div class="row">
                            <input type="hidden" id="rej_opinion_id" name="opinion_id" value="">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label>Rejection Reason</label>
                                <select name="reject_reason_opt" id="reject_reason_opt" class="form-control" onchange="update_rej_reason()" required>
                                    <option value="">Select Reason</option>
                                    <option value="not_my_specialty">This is not my specialty</option>
                                    <option value="other_commitments">I have other commitments</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group hidden">
                                <label>Other</label>
                                <textarea class="form-control" rows="3" name="rej_other_reason" id="rej_other_reason"></textarea>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-lg btn-rounded">Reject Opinion Request</button>
                </div>
                <?php form_close(); ?>
            </div>
        </div>
    </div>

</div>

<script>
    function set_opinion_id(opinion_id){
        document.getElementById('txt_opinion_id').value = opinion_id;
    }
    function set_opinion_id_rej(opinion_id){
        document.getElementById('rej_opinion_id').value = opinion_id;
    }

    function search_by_status(){
        document.getElementById('search_opinion_form').submit();
    }

    function update_rej_reason(){
        var rej_reason_option = document.getElementById('reject_reason_opt').value;
        // alert(rej_reason_option);
        if(rej_reason_option == 'other'){
            document.getElementById("rej_other_reason").parentElement.classList.remove("hidden");
        }else{
            document.getElementById("rej_other_reason").parentElement.classList.add("hidden");
        }

    }

</script>