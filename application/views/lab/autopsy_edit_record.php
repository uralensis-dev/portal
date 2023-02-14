<?php defined('BASEPATH') or exit('No direct script access allowed'); error_reporting(0); ?>
<!-- Page Header -->

<style type="text/css">
    .tg-searchrecordslide {
        float: left;
        width: auto;
    }
    .tg-rightsearchrecord .tg-searchrecordslide {
        padding: 4px 10px;
        margin: 0 10px 0px 0px;
        border-left: 1px solid #ddd;
        border-right: 1px solid #ddd;
    }
    .tg-nextecord a, .tg-previousrecord a {
        display: block;
    }
    .info_nndn tbody tr td{
        border-top: 0px !important;
    }
    .tg-nextecord a i, .tg-previousrecord a i {
        color: #444;
        margin: 0 7px 0 0;
        text-align: center;
        border-radius: 50px;
        border: 1px solid #ddd;
        display: inline-block;
        vertical-align: middle;
        width: 36px;
        height: 36px;
        font-size: 26px;
        line-height: 34px;
    }
    .tg-nextecord a span, .tg-previousrecord a span {
        color: #999;
        font-size: 14px;
        line-height: 16px;
        display: inline-block;
        vertical-align: middle;
    }
    .tg-nextecord a span em, .tg-previousrecord a span em {
        display: block;
        font-style: normal;
    }

    .tg-searchrecord fieldset .form-group i {
        top: 6px;
        font-size: 26px;
    }

    .tg-flagcolortopbar {
        float: left;
        width: auto;
    }
    .tg-checkboxgroup {
        float: left;
        width: 100%;
        padding: 0;
    }
    .tg-checkboxgroup .tg-radio {
        top: 0;
        left: 0;
        margin: 0;
        width: auto;
        float: left;
        height: auto;
    }
    .tg-flagcolor .tg-checkboxgroup .tg-flagcolor1 input[type=radio]:checked + label:before{background: #006df1; color: #fff;}
    .tg-flagcolor .tg-checkboxgroup .tg-flagcolor2 input[type=radio]:checked + label:before{background: #92dd59; color: #fff;}
    .tg-flagcolor .tg-checkboxgroup .tg-flagcolor3 input[type=radio]:checked + label:before{background: #f0ce3b; color: #fff;}
    .tg-flagcolor .tg-checkboxgroup .tg-flagcolor4 input[type=radio]:checked + label:before{background: #000; color: #fff;}
    .tg-flagcolor .tg-checkboxgroup .tg-flagcolor5 input[type=radio]:checked + label:before{background: #e74c3c; color: #fff;}
    .tg-flagcolor .tg-checkboxgroup .tg-flagcolor6 input[type=radio]:checked + label:before{background: #D1D3D4; color: #fff;}


    .tg-flagcolor .tg-checkboxgroup .tg-radio + .tg-radio{margin: 0;}
    .tg-flagcolor .tg-checkboxgroup .tg-flagcolor1 input[type=radio] + label:before{color: #006df1;}
    .tg-flagcolor .tg-checkboxgroup .tg-flagcolor2 input[type=radio] + label:before{color: #92dd59}
    .tg-flagcolor .tg-checkboxgroup .tg-flagcolor3 input[type=radio] + label:before{color: #f0ce3b}
    .tg-flagcolor .tg-checkboxgroup .tg-flagcolor4 input[type=radio] + label:before{color: #000}
    .tg-flagcolor .tg-checkboxgroup .tg-flagcolor5 input[type=radio] + label:before{color: #e74c3c}
    .tg-flagcolor .tg-checkboxgroup .tg-flagcolor6 input[type=radio] + label:before{color: #D1D3D4}

    .custom_badge_tat .badge {
        min-width: 36px;
        line-height: 28px;
        min-height: 36px;
        font-weight: 700;
        text-align: center;
        white-space: nowrap;
        vertical-align: top;
        border-radius: 50px;
        font-size: 14px;
        background: #e04c4c;
        color: #fff;
        box-shadow: 0px 0px 4px 0px rgba(255, 48, 16, 0.53);
        -moz-box-shadow: 0px 0px 4px 0px rgba(255, 48, 16, 0.53);
        -webkit-box-shadow: 0px 0px 4px 0px rgba(255, 48, 16, 0.53);
    }
    .tg-searchrecord fieldset .form-group .form-control {
        height: 38px;
        width: 215px;
        font-size: 16px;
        color: #999;
        border-color: #ddd;
        padding: 5px 40px 5px 20px;
    }
    .tg-previousrecord {
        float: left;
        width: auto;
    }
    .tg-formtheme {
        width: 100%;
        float: left;
    }
    .tg-searchrecordslide .tg-formtheme {
        width: inherit;
    }
    .tg-nextecord {
        float: right;
    }
    .tg-searchrecordoptionvtwo {
        line-height: 40px;
    }
    .tg-searchrecordoption, .tg-searchrecordoption li + li {
        margin: 0 0 0 10px;
    }
    .tg-searchrecordoption {
        float: left;
        list-style: none;
        line-height: 30px;
        padding: 0;
    }
    .tg-searchrecordoption li {
        float: left;
        width: auto;
        line-height: inherit;
        list-style-type: none;
    }
    .tg-rightsearchrecord .tg-searchrecord {
        margin: 0 20px;
    }
    .tg-flagcolor span.tg-radio, .tg-filtercolors span.tg-radio {
        position: relative;
    }
    .tg-flagcolor .tg-radio input[type=radio], .tg-filtercolors .tg-checkbox input[type=checkbox] {
        display: none;
    }
    .tg-checkboxgroup .tg-radio label {
        top: 0;
        left: 0;
        margin: 0;
        padding: 0;
        height: 24px;
        width: 24px;
    }
    .tg-flagcolor .tg-checkboxgroup .tg-radio label {
        height: 40px;
        width: 40px;
    }
    .tg-flagcolor .tg-radio input[type=radio] + label:before {
        top: 0;
        left: 0;
        height: 40px;
        cursor: pointer;
        width: 40px;
        height: 40px;
        font-size: 14px;
        content: '\f024';
        line-height: 34px;
        text-align: center;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #fff;
        font-family: 'FontAwesome';
    }
    .tg-flagcolor .tg-checkboxgroup .tg-flagcolor1 input[type=radio] + label:before {
        color: #006df1;
    }
    .list-unstyled {
        padding-left: 0;
        list-style: none;
    }

    .nohead_border thead th {
        border-top: 0px;
    }
    .content{padding: 0 15px; background: #f5f5f5}

    .border-right {
        border-right: 1px solid #ddd;
    }
    .tg-searchrecordoptionvtwo li a{height: 36px; width: 36px;}
    .custom_badge_tat .badge {
        min-width: 36px;
        line-height: 28px;
        min-height: 36px;
    }
    ul li.hover_it{position: relative;}
    ul.list-unstyled.hover_cont {
        position: absolute;
        left: 0;
        width: 180px;
        top: 40px;
        padding: 5px 0;
        display: none;
    }
    ul li.hover_it:hover ul.hover_cont {
        display: block;
    }
    .npr {
        padding-right: 0;
    }
    .breadcrumb li {
        padding: 0;
        font-size: 14px;
    }
    .breadcrumb li:first-child:before {
        display: none
    }
    .pro-edit {

        line-height: 1.5; position: absolute; right: 50px; top: 50%; transform: translateY(-50%);
    }
    .edit-icon{font-size: 16px; border-radius: 20px;}
    .edit-icon .fa{line-height: 1.5}
    .table td, .table th {
        padding: 4px 8px !important;
        /*font-size: 14px;*/
    }
    .disable{background-color: #eee !important; color: #bbb;}
    .disable:hover{background-color: #00c5fb !important; color: #fff;}
    .enable{
        background: #00c5fb;
        color: #fff;
    }

    .faq-card .card .card-header h4 > a:after {
        top: 0;
    }

    .faq-card .card .card-header h4 > a:not(.collapsed):after {
        content: "\f077";
    }

    .faq-card .card .card-header h4 > a.collapsed:after {
        content: "\f078";
    }

    .auto_save {
        position: absolute;
        right: 60px;
        top: 50%;
        transform: translateY(-50%);
    }

    .save_icon {
        position: absolute;
        right: 85px;
        top: 50%;
        transform: translateY(-50%);
    }
    .histology_blocks {
        position: absolute;
        right: 100px;
        top: 14px;
    }

    .table.custom-table > tbody > tr > td {
        padding: 4px 8px !important;
    }
    [class^="ti-"], [class*=" ti-"]{line-height: 2.25;}
    @media screen and (min-width: 1600px) {
        .table td, .table th {
            font-size: 16px;
        }

        .font-16 {
            font-size: 18px;
        }
    }

    .font-16 {
        font-size: 16px;
    }
    #edit-view-patient .form-group {
        height: 100px;
    }

    .table-view-container {
        background-color: rgb(250, 250, 250);
        width: 100%;
        height: 68px;
        padding: 10px;
        border: 1px solid rgb(180, 180, 180);
    }

    .table-view-heading {
        margin-bottom: 1px;
        font-size: 0.8rem;
        color: rgba(100, 100, 100, 0.8);
        font-weight: bold;
    }

    #table-view-patient .row .col-sm-3, #table-view-request .row .col-sm-3 {
        margin: 0;
        padding: 0;
    }

    #table-view-patient, #table-view-request {
        margin: 10px 10px 10px 20px;
    }
    #table-view-patient fieldset, #table-view-request fieldset {
        margin-bottom: 20px;
    }

    .form_input_container{
        height: 43px; border:1px solid #ddd; border-radius: 5px; padding: 0 15px;
    }

    .form_input {
        display: inline-block;
        width: 82%;
        border: none !important;
        margin-top: -17px !important;
        background-color: transparent !important;
    }

    #edit-view-patient .form-group {
        height: 100px;
    }
    #edit-view-request .form-group {
        height: 100px;
    }


    .radial_btn_container{
        width: 15%;
        margin: 0;
        height: 25px;
        margin-top: 7px;
        display: inline-block;
    }

    .table_view_svg {
        margin-top: 8px;
        margin-left: 8px;
    }

    .badge-lg, .tg-namelogo{
        margin: 0 5px;
        width:36px;
        height: 36px;
        font-size: 18px;
        line-height: 1.75;
    }
    /*.tg-namelogo{line-height: 2.4}*/
    .tg-nameandtrackimg{
        position: absolute;
        top: 0;
        right: 15px;
    }
    .top-right{
        top: 59px !important;
    }
    .update_wrap_1 {
        border: 2px solid #e3e3e3;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 20px;
    }
</style>
<div class="page-header">
    <?php
    $record_id = $this->uri->segment(3);
    $doc_id = $this->ion_auth->user()->row()->id;
    $button_disable = '';
    if (!empty($opinion_data[0]->ura_opinion_req_id) && $record_id == $opinion_data[0]->ura_opinion_req_id) {
        $button_disable = 'disabled';
    }

    if (!empty($record_edit_status)) {
        $user_id = $record_edit_status[0]->user_id_for_edit;
        $edit_timestamp = $record_edit_status[0]->user_record_edit_timestamp;
        /* Get First & Last Name */
        $first_name = '';
        $last_name = '';
        $getdatils = getRecords("AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name,AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name","users",array("id"=>$doc_id));

        $edit_full_name = $getdatils[0]->first_name . '&nbsp;' . $getdatils[0]->last_name;

    }

    if (!empty($request_query)) {
        $userid = $request_query[0]->request_add_user;
        $record_add_timestamp = $request_query[0]->request_add_user_timestamp;
        $first_name = '';
        $last_name = '';
        $getuserdetails = getRecords("AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name,AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name","users",array("id"=>$userid));

        $add_full_name = $getuserdetails[0]->first_name . '&nbsp;' . $getuserdetails[0]->last_name;
    }

    $micro_codes_data = array();
    if (!empty($micro_codes)) {
        foreach ($micro_codes as $mi_codes) {
            $micro_codes_data[] = $mi_codes;
        }
    }
    ?>
    <div class="row form-group">
        <div class="col-sm-4 form-group">
            <h3 class="page-title">Autopsy Record</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Records</li>
                <li class="breadcrumb-item active">Edit Autopsy Record</li>
            </ul>
        </div>
        <div class="col-sm-8 form-group g-rightarea tg-rightsearchrecord">
            <div class="tg-searchrecordslide">
                <?php get_next_previous_records($unpublish_list, $record_id, true, 'prev','/postmortem'); ?>
                <form class="tg-formtheme tg-searchrecord">
                    <fieldset>
                        <div class="form-group tg-inputicon">
                            <input type="text" class="form-control ap_typeahead" placeholder="Search Record">
                            <i class="lnr lnr-magnifier"></i>
                        </div>
                    </fieldset>
                </form>
                <?php get_next_previous_records($unpublish_list, $record_id, true, 'next','/postmortem'); ?>
            </div>
            <div class="tg-flagcolor tg-flagcolortopbar">
                <div class="tg-checkboxgroup">
                    <ul class="list-unstyled">
                        <li class="hover_it">
                            <span class="tg-radio tg-flagcolor1">
                                <?php
                                $checked = '';
                                if ($request_query[0]->flag_status === 'flag_blue') {
                                    $checked = 'checked';
                                }
                                ?>
                                <input <?php echo $checked; ?> data-flag="flag_blue" data-serial="<?php echo $request_query[0]->serial_number; ?>" data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>" class="detail_flag_change" type="radio" id="flag_blue" name="flag_sorting">
                                <label for="flag_blue" data-toggle="tooltip" data-placement="top" title="This case marked for ready to authorize." class="custom-tooltip"></label>
                            </span>

                              <ul class="list-unstyled hover_cont">
                                <li class="">
                                    <span class="tg-radio tg-flagcolor2">
                                        <?php
                                        $checked = '';
                                        if ($request_query[0]->flag_status === 'flag_green') {
                                            $checked = 'checked';
                                        } 
                                        ?>
                                        <input <?php echo $checked; ?> data-flag="flag_green" data-serial="<?php echo $request_query[0]->serial_number; ?>" data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>" class="detail_flag_change" type="radio" id="flag_green" name="flag_sorting">
                                        <label for="flag_green" data-toggle="tooltip" data-placement="top" title="This case marked as new case." class="custom-tooltip"></label>
                                    </span>
                                </li>
                                <li class="">
                                    <span class="tg-radio tg-flagcolor3">
                                        <?php
                                        $checked = '';
                                        if ($request_query[0]->flag_status === 'flag_yellow') {
                                            $checked = 'checked';
                                        }
                                        ?>
                                        <input <?php echo $checked; ?> data-flag="flag_yellow" data-serial="<?php echo $request_query[0]->serial_number; ?>" data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>" class="detail_flag_change" type="radio" id="flag_yellow" name="flag_sorting">
                                        <label for="flag_yellow" data-toggle="tooltip" data-placement="top" title="This case marked for review." class="custom-tooltip"></label>
                                    </span>
                                </li>
                                <li class="">
                                    <span class="tg-radio tg-flagcolor4">
                                        <?php
                                        $checked = '';
                                        if ($request_query[0]->flag_status === 'flag_black') {
                                            $checked = 'checked';
                                        }
                                        ?>
                                        <input <?php echo $checked; ?> type="radio" data-flag="flag_black" data-serial="<?php echo $request_query[0]->serial_number; ?>" data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>" class="detail_flag_change" id="flag_black" name="flag_sorting">
                                        <label for="flag_black" data-toggle="tooltip" data-placement="top" title="This case marked as complete." class="custom-tooltip"></label>
                                    </span>
                                </li>
                                <li class="">
                                    <span class="tg-radio tg-flagcolor5">
                                        <?php
                                        $checked = '';
                                        if ($request_query[0]->flag_status === 'flag_red') {
                                            $checked = 'checked';
                                        }
                                        ?>
                                        <input <?php echo $checked; ?> data-flag="flag_red" data-serial="<?php echo $request_query[0]->serial_number; ?>" data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>" class="detail_flag_change" type="radio" id="flag_red" name="flag_sorting">
                                        <label for="flag_red" data-toggle="tooltip" data-placement="top" title="This case marked as urgent." class="custom-tooltip"></label>
                                    </span>
                                </li>
                            </ul>
                    
                        </li>
                    </ul>
                  
                    
                            
                            
                            
                </div>
            </div>
            <ul class="tg-searchrecordoption tg-searchrecordoptionvtwo">
                <li>
                    <a class="custom_badge_tat">
                        <?php
                        $now = time();
                        $date_taken = !empty($request_query[0]->date_taken) ? $request_query[0]->date_taken : '';
                        $request_date = !empty($request_query[0]->request_datetime) ? $request_query[0]->request_datetime : '';
                        $tat_date = '';

                        $tat_settings = uralensis_get_tat_date_settings($request_query[0]->hospital_group_id);

                        if (!empty($tat_settings) && $tat_settings['ura_tat_date_data'] === 'date_sent_touralensis') {
                            $date_sent_to_uralensis = !empty($request_query[0]->date_sent_touralensis) ? $request_query[0]->date_sent_touralensis : '';
                            $tat_date = $date_sent_to_uralensis;
                        } elseif ($tat_settings['ura_tat_date_data'] === 'date_rec_by_doctor') {
                            $data_rec_by_doctor = !empty($request_query[0]->date_rec_by_doctor) ? $request_query[0]->date_rec_by_doctor : '';
                            $tat_date = $data_rec_by_doctor;
                        } elseif ($tat_settings['ura_tat_date_data'] === 'data_processed_bylab') {
                            $data_processed_bylab = !empty($request_query[0]->data_processed_bylab) ? $request_query[0]->data_processed_bylab : '';
                            $tat_date = $data_processed_bylab;
                        } elseif ($tat_settings['ura_tat_date_data'] === 'date_received_bylab') {
                            $date_received_bylab = !empty($request_query[0]->date_received_bylab) ? $request_query[0]->date_received_bylab : '';
                            $tat_date = $date_received_bylab;
                        } elseif ($tat_settings['ura_tat_date_data'] === 'publish_datetime') {
                            $publish_datetime = !empty($request_query[0]->publish_datetime) ? $request_query[0]->publish_datetime : '';
                            $tat_date = $publish_datetime;
                        } else {
                            if (!empty($date_taken)) {
                                $tat_date = $date_taken;
                            } else {
                                $category = $request_date;
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
                </li>
            </ul>
            <span class="tg-logobar">
                <?php if (!empty($request_query)) { ?>
                    <span class="tg-namelogo" data-toggle="tooltip" data-placement="top" title="<?php echo $this->ion_auth->group($request_query[0]->hospital_group_id)->row()->description; ?>"><?php echo $this->ion_auth->group($request_query[0]->hospital_group_id)->row()->first_initial . $this->ion_auth->group($request_query[0]->hospital_group_id)->row()->last_initial; ?></span>
                <?php } ?>
            </span>
            </div>
            
    </div>
</div>
<!-- /Page Header -->

<!--<div class="col-md-12 nopadding form-group ">-->
<!--    <p class="font-16">this report is confidential. it should not be discloused to a third party without the coroner's-->
<!--        consent.-->
<!--        Post-mortem examination </p>-->
<!--    <p class="font-16">Corner :</p>-->
<!--</div>-->
<!--<div class="col-md-12 nopadding ">-->
<!--    <p class="font-16">Name of deceased: --><?php //echo $request_query[0]->f_name . ' ' . $request_query[0]->sur_name; ?><!-- </p>-->
<!--</div>-->

<div class="tg-haslayout uralensis_icons_actions">
    <div class="container-fluid"  style="padding-right: 130px;">
        <div id="relatedrecordscollapse" class="collapse">
            <?php
            $hospital_name = '';
            if (!empty($related_query)) {
                $hospital_name = $this->ion_auth->group($related_query[0]->hospital_group_id)->row()->description;
                display_related_posts($related_query, $hospital_name);
            } else {
                echo '<div class="alert alert-info">Sorry No Related Records Found.</div>';
            }
            ?>
        </div>

        <div id="datasets" class="collapse">
            <?php set_datasets_data($datasets, $record_id); ?>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php
                if ($this->session->userdata('id') !== '') {
                    $record_id = $this->session->userdata('id');
                }
                ?>
                <?php
                if ($this->session->flashdata('upload_error') != '') {
                    echo $this->session->flashdata('upload_error');
                }
                ?>
                <?php
                if ($this->session->flashdata('upload_success') != '') {
                    echo $this->session->flashdata('upload_success');
                }
                ?>
                <?php
                if ($this->session->flashdata('delete_file') != '') {
                    echo $this->session->flashdata('delete_file');
                }
                ?>

            </div>
        </div>
        <div id="further_work" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Further Work</h4>
                    </div>
                    <div class="modal-body">
                        <div class="fw_msg"></div>
                        <form id="further_work_form" method="post">
                            <div class="form-group">
                                <?php
                                $req_id = $this->uri->segment(3);
                                $doc_name = $this->session->userdata('doc_name');
                                $check_count = 1;
                                $hospital_id = $request_query[0]->hospital_group_id;
                                $get_cost_codes['cost_codes'] = $this->Doctor_model->get_cost_codes($hospital_id);


                                if (!empty($get_cost_codes['cost_codes'])) {
                                    foreach ($get_cost_codes['cost_codes'] as $codes) {
                                        $selected = '';
                                        $fw_levels = '';
                                        if ($codes->ura_cost_code_type == $request_query[0]->fw_levels) {
                                            $selected = 'checked disabled';
                                            $fw_levels = $codes->ura_cost_code_type;
                                        }
                                        if ($codes->ura_cost_code_type == $request_query[0]->fw_immunos) {
                                            $selected = 'checked disabled';
                                            $fw_levels = $codes->ura_cost_code_type;
                                        }
                                        if ($codes->ura_cost_code_type == $request_query[0]->fw_imf) {
                                            $selected = 'checked disabled';
                                            $fw_levels = $codes->ura_cost_code_type;
                                        }
                                        ?>
                                        <input type="hidden" name="<?php echo $codes->ura_cost_code_type; ?>"
                                               value="<?php echo $fw_levels; ?>">

                                        <label
                                                for="report_check_<?php echo $check_count; ?>"><?php echo $codes->ura_cost_code_desc; ?></label>
                                        <input id="report_check_<?php echo $check_count; ?>" <?php echo $selected; ?>
                                               name="<?php echo $codes->ura_cost_code_type; ?>" type="checkbox"
                                               value="<?php echo $codes->ura_cost_code_type; ?>">
                                        <?php
                                        $check_count++;
                                    }//endforeach
                                }//endif
                                ?>
                            </div>
                            <div class="form-group">
                                <label>Further Work Date</label>
                                <input type="text" value="" readonly class="form-control" name="furtherwork_date"
                                       id="furtherwork_date" placeholder="Further Work Date">
                                <input type="hidden" value="" name="furtherwork_date" id="further_work_date_hide">
                            </div>
                            <div class="form-group">
                                <label for="further_work">Further Work:</label>
                                <textarea class="form-control" rows="5" id="further_work"
                                          name="description"></textarea>
                            </div>
                            <input type="hidden" name="record_id" value="<?php echo $req_id; ?>">
                            <input type="hidden" name="hospital_group_id" value="<?php echo $hospital_id; ?>">
                            <button type="button" id="fw_submit_btn" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <?php
        $record_id = $this->uri->segment(3);
        $user_id = $this->ion_auth->user()->row()->id;
        ?>
        <div id="display_iframe_pdf" class="modal fade display_iframe_pdf" role="dialog" data-backdrop="static"
             data-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <object type="application/pdf"
                                data="<?php echo site_url() . '/doctor/view_autopsy_report/' . $record_id; ?>" width="100%"
                                style="height: 80vh;">No Support</object>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                        <?php if ($request_query[0]->specimen_update_status == 1 && $request_query[0]->specimen_publish_status == 0) { ?>
                            <a class="pull-left" style="cursor: pointer;" id="pdf-icon">
                                <img data-toggle="tooltip" data-placement="top" title="Click To Publish This Report"
                                     src="<?php echo base_url('assets/img/pdf.png'); ?>">
                            </a>
                        <?php } else { ?>
                            <p class="label label-success pull-left" style="font-size:16px;">Report Already Has Been
                                Published!</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($request_query[0]->specimen_update_status == 1 && $request_query[0]->specimen_publish_status == 0) { ?>
            <div id="user_auth_popup" class="modal fade user_auth_popup" role="dialog" data-backdrop="static"
                 data-keyboard="false">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Publish Report</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <?php if (empty($request_query[0]->mdt_case) && empty($request_query[0]->mdt_case_status)) { ?>
                                <div class="well">
                                    <p>Please Select One Of The MDT Option.</p>
                                    <button class="btn btn-sm btn-success" id="close_popups_for_mdt">Add MDT</button>
                                </div>
                            <?php } ?>
                            <div id="publish_button"></div>
                            <div class="publish_report_form">
                                <form class="form" method="post" id="check_auth_pass_form">
                                    <?php
                                    $split_surname = uralensis_get_record_db_detail($record_id, 'sur_name');
                                    if (!empty($split_surname)) {
                                        ?>
                                        <div class="form-group ura-surname-field" data-recordid="<?php echo $record_id; ?>">
                                            <p><strong>Enter Surname Letters.</strong></p>
                                            <p><strong>* </strong><em>Insert Surname from Request Form as final ID
                                                    check.</em></p>
                                            <?php
                                            $dom_array = array();
                                            $splitted_name = str_split(strtolower($split_surname));
                                            $custom_split_data = array();
                                            if (!empty($splitted_name)) {
                                                foreach ($splitted_name as $key_name => $key_value) {
                                                    $dom_array[] = trim($key_value);
                                                    echo '<input maxlength="1" type="text" data-namekey="'.$key_name.'" data-namevalue="'.$key_value.'" name="checksurname[]"> ';
                                                }
                                            }
                                            ?>
                                            <input type="hidden" name="surname_data"
                                                   value='<?php echo count($dom_array) - 1; ?>'>
                                        </div>
                                        <div class="ura-pin-area">
                                            <div class="form-group ura-password-fields">
                                                <p>Enter Your Pin To Publish This Report.</p>
                                                <input autofocus maxlength="1" type="password" id="auth_pass1"
                                                       name="auth_pass1">
                                                <input maxlength="1" type="password" name="auth_pass2">
                                                <input maxlength="1" type="password" name="auth_pass3">
                                                <input maxlength="1" type="password" name="auth_pass4">
                                                <input name="request_id" type="hidden" value="<?php echo $record_id; ?>">
                                                <input name="user_id" type="hidden" value="<?php echo $user_id; ?>">
                                                <?php
                                                if (empty($request_query[0]->mdt_case) && empty($request_query[0]->mdt_case_status)) {
                                                    echo '<input name="mdt_not_select" type="hidden" value="mdt_uncheck">';
                                                }
                                                ?>
                                            </div>
                                            <div class="form-group"><button type="button" id="check_pass"
                                                                            class="btn btn-warning pull-right">Submit</button></div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <?php
                                    } else {
                                        echo 'Please enter the surname first.';
                                    }
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div id="request_for_opinion" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Opinion Request</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <?php $rec_id = $this->uri->segment(3); ?>
                        <form class="form opinion_cases_form">
                            <div class="form-group">
                                <label for="opinion_case_doctors">Choose Doctors</label>
                                <select name="opinion_case_doctors[]" id="opinion_case_doctors" class="form-control select_multiple_imgs" multiple>
                                    <option value="">Nothing Selected</option>
                                    <?php
                                    if (!empty($list_doctors)) {
                                        foreach ($list_doctors as $value) {
                                            ?>
                                            <option value="<?php echo $value->id; ?>" >
                                                <?php echo $value->first_name . ' ' . $value->last_name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Opinion Request Date</label>
                                <input type="text" value="" readonly class="form-control" name="opinion_date"
                                       id="opinion_date" placeholder="Opinion Request Date">
                                <input type="hidden" value="" name="opinion_date" id="opinion_date_hide">
                            </div>
                            <div class="form-group">
                                <label>Opinion Request Due Date</label>
                                <input type="text" value="" readonly class="form-control datepicker_new" name="opinion_last_date"
                                       id="opinion_last_date" placeholder="Opinion Request Last Date">
                            </div>
                            <div class="form-group">
                                <label for="opinion_comment">Opinion Comment</label>
                                <textarea id="opinion_comment" name="opinion_comment"
                                          class="form-control"></textarea>
                            </div>
                            <input type="hidden" name="record_id" value="<?php echo $rec_id; ?>">
                            <div class="form-group">
                                <button type="button" class="btn btn-success assign_to_opinion_case">Assign</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="assign_doctor_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Assign to other doctor</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="assign_doctor_and_authorize">
                            <div class="doctor_assign_msg"></div>
                            <form id="doctor_assign_form">
                                <select class="form-control" name="assign_doctor" id="assign_doctor">
                                    <option value="0">Choose Doctor</option>
                                    <?php
                                    if (!empty($list_doctors)) {
                                        foreach ($list_doctors as $value) {
                                            ?>
                                            <option value="<?php echo $value->id; ?>">
                                                <?php echo $value->first_name . ' ' . $value->last_name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="teaching_cpc_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Education and CPC</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <div class="modal-body">
                        <form id="teach_and_mdt_form" class="form teach_and_mdt_form">
                            <div class="teach_mdt_cpc_msg"></div>
                            <div class="form-group">
                                <label for="education_cats">Education</label>
                                <select name="education_cats" id="education_cats" class="form-control">
                                    <option value="0">Select Education Category</option>
                                    <?php
                                    if (!empty($education_cats)) {
                                        foreach ($education_cats as $cats) {
                                            $selected = '';
                                            if ($cats->ura_tec_mdt_id === $request_query[0]->teaching_case) {
                                                $selected = 'selected';
                                            }
                                            echo '<option ' . $selected . ' value="' . $cats->ura_tec_mdt_id . '">' . $cats->ura_tech_mdt_cat . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cpc_cats">CPC</label>
                                <select name="cpc_cats" id="cpc_cats" class="form-control">
                                    <option value="0">Select CPC Category</option>
                                    <?php
                                    if (!empty($cpc_cats)) {
                                        foreach ($cpc_cats as $cats) {
                                            echo '<option value="' . $cats->ura_tec_mdt_id . '">' . $cats->ura_tech_mdt_cat . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="record_id" id="record_id"
                                       value="<?php echo $record_id; ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="record_download_history" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Record Download History</h4>
                    </div>
                    <div class="modal-body">
                        <table class='table table-bordered'>
                            <tr>
                                <th>ID</th>
                                <th>Record</th>
                                <th>Timestamp</th>
                            </tr>
                            <?php
                            if (!empty($download_history)) {
                                foreach ($download_history as $key => $value) {
                                    $timestamp = '';
                                    if (!empty($value['ura_bulk_report_timestamp'])) {
                                        $timestamp = date('d-m-Y H:i:s', $value['ura_bulk_report_timestamp']);
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $value['ura_bulk_report_history']; ?></td>
                                        <td><?php echo $value['ura_bulk_report_record_data']; ?></td>
                                        <td><?php echo $timestamp; ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php record_history($record_history, $userid, $record_add_timestamp, $add_full_name); ?>

        <div id="mdt_data_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" style="float:left;width:100%;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Assign to MDT</h4>
                    </div>
                    <div class="modal-body">
                        <div class="record_detail_page">
                            <?php
                            $recordid = $this->uri->segment(3);
                            display_mdt($mdt_cats, $recordid, $request_query, $mdt_assign_dates);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Show this modal when user wants to add message-->
        <div id="mdt_message_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" style="width:100%;float:left;">
                    <div class="modal-header">
                        <h4 class="modal-title">MDT Message</h4>
                    </div>
                    <div class="modal-body">

                        <form class="form" id="mdt_message_form">
                            <div class="form-group">
                                <label for="add_mdt_message">Add MDT Message</label>
                                <textarea class="form-control" id="add_mdt_message" name="mdt_message"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="record_id" value="<?php echo $this->uri->segment(3); ?>">
                                <button class="btn btn-primary" id="add_mdt_msg_btn">Add Message</button>
                                <button class="btn btn-warning pull-right" id="leave_mdt_notes_msg_btn">Leave
                                    this.</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Show this modal when user wants to add message-->
        <div id="add_supplementary" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Supplementary</h4>
                    </div>
                    <div class="modal-body">
                        <?php
                        $attributes = array('id' => 'addiotional','class'=>'addiotional');
                        echo form_open(site_url()."/doctor/additional_work", $attributes);
                        ?>
                        <!-- <form method="post" action="<?php echo site_url('doctor/additional_work'); ?>">-->
                        <div class="form-group">
                            <label for="additional_work">Add Supplementary Report:</label>
                            <textarea class="form-control" rows="5" id="additional_work"
                                      name="additional_description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php show_supplementary_modal($record_id, $supplementary_query); ?>
    </div>
</div>
<form class="tg-formtheme doctor_update_autopsy_record" id="" method="post">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <div class="faq-card autosp_cards">
        <div class="update_wrap_1">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">

                    <a class="collapsed p_id" data-toggle="collapse" href="#patient_id">
                        <span id="p_id_title" class="hidden">Patient ID</span>
                        <table class="table custom-table info_nndn" style="margin-bottom: 0;">
                            <tr style="box-shadow:0px 0px 0px 0px !important;">
                                <td>
                                    <span class="tg-namelogo"><?php echo uralensis_get_user_data($request_query[0]->uralensis_request_id, 'initial'); ?></span>
                                    <span style="display:inline-block; margin-top: 12px;"><?php echo uralensis_get_user_data($request_query[0]->uralensis_request_id, 'fullname'); ?></span>
                                </td>
                                <td><span>DOB: <?php echo!empty($request_query[0]->dob) ? date('d-m-Y', strtotime($request_query[0]->dob)) : ''; ?></span></td>
                                <td><span>NHS: <?php echo $request_query[0]->nhs_number; ?></span></td>
                                <td>
                                    <span>Gender: <?php $gender = ($request_query[0]->gender=='Male'?'M':'F'); ?> 
                                        <?php echo $gender; ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </a>
                    <button <?php echo $button_disable; ?> id="p_id_upd_btn" class="btn btn-primary btn-sm pull-right save_icon update_doctor_autopsy_report_btn hidden" name="submit"><i class="fa fa-floppy-o"></i></button>
                    <div class="pro-edit"><a id="make_editable" class="make_editable edit-icon" href="#">
                        <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Enable/Disable Fields"></i></a>
                    </div>
                    
                    <!-- <span id="make_editable" class="make_editable tg-detailsicon disable tg-themeiconcolorone" style="height: 25px; width: 25px; line-height: 1.5; position: absolute; right: 50px; top: 50%; transform: translateY(-50%);">
                        <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Enable/Disable Fields"></i></span> -->
                </h4>
            </div>
            <div id="patient_id" class="card-collapse collapse">
                <div class="card-body">
                    <?php
                    $json = array();

                    if (!empty($request_query) && is_array($request_query)) {
                        foreach ($request_query as $row) {
                            $record_edit_serial = $row->record_edit_status;
                            $redit_status = unserialize($record_edit_serial);
                            ?>
                            <div id="table-view-patient">
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                            <span
                                                    class="tg-namelogo"><?php echo uralensis_get_user_data($row->uralensis_request_id, 'initial'); ?></span>
                                        <div class="tg-nameandtrack">
                                            <h3><?php echo uralensis_get_user_data($row->uralensis_request_id, 'fullname'); ?>
                                            </h3>
                                            <span><?php echo uralensis_get_record_db_detail($row->uralensis_request_id, 'serial_number'); ?>
                                                    <em>|</em>
                                                    <em><?php echo uralensis_get_record_db_detail($row->uralensis_request_id, 'ura_barcode_no'); ?></em>
                                                </span>
                                        </div>

                                        <?php
                                        $initial=uralensis_get_user_data($row->uralensis_request_id, 'initial');
                                        $fullname=uralensis_get_user_data($row->uralensis_request_id, 'fullname');
                                        $serial_number=uralensis_get_record_db_detail($row->uralensis_request_id, 'serial_number');
                                        $ura_barcode_no=uralensis_get_record_db_detail($row->uralensis_request_id, 'ura_barcode_no');
                                        ?>
                                        <figure class="tg-nameandtrackimg">
                                            <span><?php echo uralensis_get_user_data($row->uralensis_request_id, 'age'); ?></span>
<!--                                            --><?php //echo uralensis_get_user_data($row->uralensis_request_id, 'gender'); ?>
                                        </figure>
                                    </div>
                                    <div class="col-sm-3" >
                                        <div class="table-view-container">
                                            <?php
                                            $color_status = 'orange';
                                            if (!empty($redit_status['patient_initial']) && $redit_status['patient_initial'] == '1') {
                                                $color_status = 'green';
                                            } elseif (!empty($redit_status['patient_initial']) && $redit_status['patient_initial'] == '2') {
                                                $color_status = 'blue';
                                            }
                                            ?>
                                            <div class="row" data-key="patient_initial">
                                                <div class="table_view_svg col-sm-2 change_status_color" >

                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                        <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm-9 ">
                                                    <div class="table-view-heading">Initials</div>
                                                    <div class="table-view-content"><?php echo $row->patient_initial; ?></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-3" >
                                        <div class="table-view-container">
                                            <?php
                                            $color_status = 'orange';
                                            if (!empty($redit_status['f_name']) && $redit_status['f_name'] == '1') {
                                                $color_status = 'green';
                                            } elseif (!empty($redit_status['f_name']) && $redit_status['f_name'] == '2') {
                                                $color_status = 'blue';
                                            }
                                            ?>
                                            <div class="row" data-key="f_name">
                                                <div class="table_view_svg col-sm-2 change_status_color" >

                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                        <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm-9 ">
                                                    <div class="table-view-heading">First Name</div>
                                                    <div class="table-view-content"><?php echo $row->f_name; ?></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-3" >
                                        <div class="table-view-container">
                                            <?php
                                            $color_status = 'orange';
                                            if (!empty($redit_status['sur_name']) && $redit_status['sur_name'] == '1') {
                                                $color_status = 'green';
                                            } elseif (!empty($redit_status['sur_name']) && $redit_status['sur_name'] == '2') {
                                                $color_status = 'blue';
                                            }
                                            ?>
                                            <div class="row" data-key="sur_name">
                                                <div class="table_view_svg col-sm-2 change_status_color" >

                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                        <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm-9 ">
                                                    <div class="table-view-heading">Surname</div>
                                                    <div class="table-view-content"><?php echo $row->sur_name; ?></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3" >
                                        <div class="table-view-container">
                                            <?php
                                            $color_status = 'orange';
                                            if (!empty($redit_status['gender']) && $redit_status['gender'] == '1') {
                                                $color_status = 'green';
                                            } elseif (!empty($redit_status['gender']) && $redit_status['gender'] == '2') {
                                                $color_status = 'blue';
                                            }
                                            ?>
                                            <div class="row" data-key="gender">
                                                <div class="table_view_svg col-sm-2 change_status_color" >

                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                        <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm-9 ">
                                                    <div class="table-view-heading">Gender</div>
                                                    <div class="table-view-content"><?php echo $row->gender; ?></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-3" >
                                        <div class="table-view-container">
                                            <?php
                                            $color_status = 'orange';
                                            if (!empty($redit_status['dob']) && $redit_status['dob'] == '1') {
                                                $color_status = 'green';
                                            } elseif (!empty($redit_status['dob']) && $redit_status['dob'] == '2') {
                                                $color_status = 'blue';
                                            }
                                            ?>
                                            <div class="row" data-key="dob">
                                                <div class="table_view_svg col-sm-2 change_status_color" >

                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                        <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm-9 ">
                                                    <div class="table-view-heading">DOB</div>
                                                    <div class="table-view-content"><?php echo!empty($row->dob) ? date('d-m-Y', strtotime($row->dob)) : ''; ?></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-3" >
                                        <div class="table-view-container">
                                            <?php
                                            $color_status = 'orange';
                                            if (!empty($redit_status['nhs_number']) && $redit_status['nhs_number'] == '1') {
                                                $color_status = 'green';
                                            } elseif (!empty($redit_status['nhs_number']) && $redit_status['nhs_number'] == '2') {
                                                $color_status = 'blue';
                                            }
                                            ?>
                                            <div class="row" data-key="nhs_number">
                                                <div class="table_view_svg col-sm-2 change_status_color" >

                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                        <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm-9 ">
                                                    <div class="table-view-heading">NHS No.</div>
                                                    <div class="table-view-content"><?php echo $row->nhs_number; ?></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm-3" >
                                        <div class="table-view-container">
                                            <?php
                                            $color_status = 'orange';

                                            ?>
                                            <div class="row">
                                                <div class="table_view_svg col-sm-2" >

                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                        <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm-9 ">
                                                    <div class="table-view-heading">Hospital No.</div>
                                                    <div class="table-view-content"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-sm-3" >
                                        <div class="table-view-container">
                                            <?php
                                            $color_status = 'orange';

                                            ?>
                                            <div class="row">
                                                <div class="table_view_svg col-sm-2" >

                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                        <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm-9 ">
                                                    <div class="table-view-heading">Hospital Code</div>
                                                    <div class="table-view-content"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm-3" >
                                        <div class="table-view-container">
                                            <?php
                                            $color_status = 'orange';

                                            ?>
                                            <div class="row">
                                                <div class="table_view_svg col-sm-2" >

                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                        <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm-9 ">
                                                    <div class="table-view-heading">Patient Usual Address</div>
                                                    <div class="table-view-content"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm-3" >
                                        <div class="table-view-container">
                                            <?php
                                            $color_status = 'orange';

                                            ?>
                                            <div class="row">
                                                <div class="table_view_svg col-sm-2" >

                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                        <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm-9 ">
                                                    <div class="table-view-heading">Postcode</div>
                                                    <div class="table-view-content"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="edit-view-patient" style="display: none; margin: 20px;">
                                <fieldset>
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                    <span
                                            class="tg-namelogo"><?php echo uralensis_get_user_data($row->uralensis_request_id, 'initial'); ?></span>
                                            <div class="tg-nameandtrack">
                                                <h3><?php echo uralensis_get_user_data($row->uralensis_request_id, 'fullname'); ?>
                                                </h3>
                                                <span><?php echo uralensis_get_record_db_detail($row->uralensis_request_id, 'serial_number'); ?>
                                            <em>|</em>
                                            <em><?php echo uralensis_get_record_db_detail($row->uralensis_request_id, 'ura_barcode_no'); ?></em>
                                        </span>
                                            </div>

                                            <?php
                                            $initial = uralensis_get_user_data($row->uralensis_request_id, 'initial');
                                            $fullname = uralensis_get_user_data($row->uralensis_request_id, 'fullname');
                                            $serial_number = uralensis_get_record_db_detail($row->uralensis_request_id, 'serial_number');
                                            $ura_barcode_no = uralensis_get_record_db_detail($row->uralensis_request_id, 'ura_barcode_no');
                                            ?>
                                            <figure class="tg-nameandtrackimg">
                                                <span><?php echo uralensis_get_user_data($row->uralensis_request_id, 'age'); ?></span>
<!--                                                --><?php //echo uralensis_get_user_data($row->uralensis_request_id, 'gender'); ?>
                                            </figure>
                                        </div>
                                        <?php
                                        $color_status = 'orange';
                                        if (!empty($redit_status['patient_initial']) && $redit_status['patient_initial'] == '1') {
                                            $color_status = 'green';
                                        } elseif (!empty($redit_status['patient_initial']) && $redit_status['patient_initial'] == '2') {
                                            $color_status = 'blue';
                                        }
                                        ?>
                                        <div class="form-group col-md-3">
                                            <label for="patient_initial">Initials </label>
                                            <div class="form_input_container" data-key="patient_initial">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0"
                                                                stroke-width="1"/>
                                                        <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>"
                                                                fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                                    </svg>

                                                </div>
                                                <input id="patient_initial" type="text" name="patient_initial" class="form_input"
                                                       placeholder="Patient Initials" value="<?php echo $row->patient_initial; ?>">
                                            </div>
                                            <?php $json['patient_initial'] = $row->patient_initial; ?>
                                        </div>
                                        <?php
                                        $color_status = 'orange';
                                        if (!empty($redit_status['first_name']) && $redit_status['first_name'] == '1') {
                                            $color_status = 'green';
                                        } elseif (!empty($redit_status['first_name']) && $redit_status['first_name'] == '2') {
                                            $color_status = 'blue';
                                        }
                                        ?>

                                        <div class="form-group col-md-3">
                                            <label for="first_name">First Name (CR0060) </label>
                                            <div class="form_input_container" data-key="first_name">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0"
                                                                stroke-width="1"/>
                                                        <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>"
                                                                fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                                    </svg>

                                                </div>
                                                <input id="first_name" type="text" name="f_name" class="form_input" placeholder="First Name"
                                                       value="<?php echo $row->f_name; ?>">
                                            </div>
                                            <?php $json['f_name'] = $row->f_name; ?>
                                        </div>

                                        <?php
                                        $color_status = 'orange';
                                        if (!empty($redit_status['sur_name']) && $redit_status['sur_name'] == '1') {
                                            $color_status = 'green';
                                        } elseif (!empty($redit_status['sur_name']) && $redit_status['sur_name'] == '2') {
                                            $color_status = 'blue';
                                        }
                                        ?>

                                        <div class="form-group col-md-3">
                                            <label for="sur_name">Surname (CR0050)</label>
                                            <div class="form_input_container" data-key="sur_name">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0"
                                                                stroke-width="1"/>
                                                        <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>"
                                                                fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                                    </svg>

                                                </div>
                                                <input id="sur_name" type="text" name="sur_name" class="form_input" placeholder="Surname"
                                                       value="<?php echo $row->sur_name; ?>">
                                            </div>
                                            <?php $json['sur_name'] = $row->sur_name; ?>
                                        </div>


                                        <?php
                                        $color_status = 'orange';
                                        if (!empty($redit_status['gender']) && $redit_status['gender'] == '1') {
                                            $color_status = 'green';
                                        } elseif (!empty($redit_status['gender']) && $redit_status['gender'] == '2') {
                                            $color_status = 'blue';
                                        }
                                        ?>

                                        <div class="form-group col-md-3">
                                            <label for="gender">Gender (CR0080)</label>
                                            <div class="form_input_container" data-key="gender">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0"
                                                                stroke-width="1"/>
                                                        <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>"
                                                                fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                                    </svg>

                                                </div>
                                                <select class="form_input" name="gender" id="gender">
                                                    <?php
                                                    $gender_array = array(
                                                        'Male' => 'Male',
                                                        'Female' => 'Female'
                                                    );

                                                    foreach ($gender_array as $key => $gender) {
                                                        $selected = '';
                                                        if ($key == $row->gender) {

                                                            $selected = 'selected';
                                                        }
                                                        ?>
                                                        <option <?php echo $selected; ?>
                                                                value="<?php echo $key; ?>"><?php echo $gender; ?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                            <?php $json['gender'] = $row->gender; ?>
                                        </div>

                                        <?php
                                        $color_status = 'orange';
                                        if (!empty($redit_status['dob']) && $redit_status['dob'] == '1') {
                                            $color_status = 'green';
                                        } elseif (!empty($redit_status['dob']) && $redit_status['dob'] == '2') {
                                            $color_status = 'blue';
                                        }
                                        ?>

                                        <div class="form-group col-md-3">
                                            <label for="dob">DOB (CR0100)</label>
                                            <div class="form_input_container" data-key="dob">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0"
                                                                stroke-width="1"/>
                                                        <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>"
                                                                fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                                    </svg>

                                                </div>
                                                <input type="text" name="dob" id="dob" class="form_input" placeholder="Date of Birth"
                                                       value="<?php echo !empty($row->dob) ? date('d-m-Y', strtotime($row->dob)) : ''; ?>"/>
                                            </div>
                                            <?php $json['dob'] = date('d-m-Y', strtotime($row->dob)); ?>
                                        </div>

                                        <?php
                                        $color_status = 'orange';
                                        if (!empty($redit_status['nhs_number']) && $redit_status['nhs_number'] == '1') {
                                            $color_status = 'green';
                                        } elseif (!empty($redit_status['nhs_number']) && $redit_status['nhs_number'] == '2') {
                                            $color_status = 'blue';
                                        }
                                        ?>

                                        <div class="form-group col-md-3">
                                            <label for="nhs_number">NHS No. (CR0010)</label>
                                            <div class="form_input_container" data-key="nhs_number">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0"
                                                                stroke-width="1"/>
                                                        <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>"
                                                                fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                                    </svg>

                                                </div>
                                                <input type="text" class="form_input" id="nhs_number" name="nhs_number" placeholder="Nhs Number"
                                                       value="<?php echo $row->nhs_number; ?>">
                                            </div>
                                            <?php $json['nhs_number'] = $row->nhs_number; ?>
                                        </div>

                                        <?php
                                        $color_status = 'orange';
                                        ?>
                                        <div class="form-group col-md-3">
                                            <label for="hospital_no" class="text-warning">Hospital No.</label>
                                            <div class="form_input_container" data-key="hospital_no">
                                                <div class="radial_btn_container">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0"
                                                                stroke-width="1"/>
                                                        <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>"
                                                                fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                                    </svg>

                                                </div>
                                                <input type="text" class="form_input" id="hospital_no" name="hospital_no"
                                                       placeholder="Hospital No." value="" disabled>
                                            </div>
                                            <label></label>
                                        </div>

                                        <?php
                                        $color_status = 'orange';
                                        ?>
                                        <div class="form-group col-md-3">
                                            <label for="hospital_code" class="text-warning">Hospital Code</label>
                                            <div class="form_input_container" data-key="hospital_code">
                                                <div class="radial_btn_container">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0"
                                                                stroke-width="1"/>
                                                        <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>"
                                                                fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                                    </svg>

                                                </div>
                                                <input type="text" class="form_input" id="hospital_code" name="hospital_code"
                                                       placeholder="Hospital Code" value="" disabled>
                                            </div>
                                            <label></label>
                                        </div>

                                        <?php
                                        $color_status = 'orange';
                                        ?>
                                        <div class="form-group col-md-3">
                                            <label for="patient_usual_address" class="text-warning">Address (CR0030)</label>
                                            <div class="form_input_container" data-key="patient_usual_address">
                                                <div class="radial_btn_container">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0"
                                                                stroke-width="1"/>
                                                        <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>"
                                                                fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                                    </svg>

                                                </div>
                                                <input type="text" class="form_input" id="patient_usual_address" name="patient_usual_address"
                                                       placeholder="Address" value="" disabled>
                                            </div>
                                        </div>

                                        <?php
                                        $color_status = 'orange';
                                        ?>
                                        <div class="form-group col-md-3">
                                            <label for="patient_city" class="text-warning">Patient City (CR0030)</label>
                                            <div class="form_input_container" data-key="patient_city">
                                                <div class="radial_btn_container">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0"
                                                                stroke-width="1"/>
                                                        <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>"
                                                                fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                                    </svg>

                                                </div>
                                                <input type="text" class="form_input" id="patient_city" name="patient_city" placeholder="City"
                                                       value="" disabled>
                                            </div>
                                        </div>


                                        <?php
                                        $color_status = 'orange';
                                        ?>
                                        <div class="form-group col-md-3">
                                            <label for="postcode" class="text-warning">Postcode (CR0070)</label>
                                            <div class="form_input_container" data-key="postcode">
                                                <div class="radial_btn_container">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0"
                                                                stroke-width="1"/>
                                                        <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>"
                                                                fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                                    </svg>

                                                </div>
                                                <input type="text" class="form_input" id="postcode" name="postcode" placeholder="City" value=""
                                                       disabled>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>

                                    <?php
                                    if (!empty($row->cl_detail)) {
                                        ?>
                                        <div class="form-group" style="width:100%;">
                                    <textarea style="height:100px;" class="form-control" required name="cl_detail"
                                              id="cl_detail"
                                              placeholder="Clinical Detail"><?php echo $row->cl_detail; ?></textarea>
                                        </div>
                                    <?php } ?>


                                </fieldset>
                            </div>
                            <?php
                        }//endforeach
                    }//endif
                    ?>
                    <?php $json_data = json_encode($json); ?>
                    <input type="hidden" name="json_edit_data" value='<?php echo $json_data; ?>'>
                    <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <a class="collapsed" data-toggle="collapse" href="#request_id">Request ID</a>
                    <button <?php echo $button_disable; ?> id="p_id_upd_btn2" class="btn btn-primary btn-sm pull-right save_icon update_doctor_autopsy_report_btn hidden" name="submit"><i class="fa fa-floppy-o"></i></button>
                    <div class="pro-edit">
                    <span id="make_editable" class="make_editable edit-icon disable tg-themeiconcolorone">
                        <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Enable/Disable Fields"></i></span>
                        </div>
                </h4>
            </div>
            <div id="request_id" class="card-collapse collapse">
                <div class="card-body">
                    <div id="table-view-request">
                        <div class="row">
                            <div class="col-sm-3" >
                                <div class="table-view-container">
                                    <?php
                                    $color_status = 'orange';
                                    if (!empty($redit_status['serial_number']) && $redit_status['serial_number'] == '1') {
                                        $color_status = 'green';
                                    } elseif (!empty($redit_status['serial_number']) && $redit_status['serial_number'] == '2') {
                                        $color_status = 'blue';
                                    }
                                    ?>
                                    <div class="row" data-key="serial_number">
                                        <div class="table_view_svg col-sm-2 change_status_color" >

                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <div class="col-sm-9 ">
                                            <div class="table-view-heading">UL No.</div>
                                            <div class="table-view-content"><?php echo $row->serial_number; ?></div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-3" >
                                <div class="table-view-container">
                                    <?php
                                    $color_status = 'orange';

                                    ?>
                                    <div class="row">
                                        <div class="table_view_svg col-sm-2" >

                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <div class="col-sm-9 ">
                                            <div class="table-view-heading">Track No.</div>
                                            <div class="table-view-content"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-3" >
                                <div class="table-view-container">
                                    <?php
                                    $color_status = 'orange';
                                    if (!empty($redit_status['ap_pm_number']) && $redit_status['ap_pm_number'] == '1') {
                                        $color_status = 'green';
                                    } elseif (!empty($redit_status['ap_pm_number']) && $redit_status['ap_pm_number'] == '2') {
                                        $color_status = 'blue';
                                    }
                                    ?>
                                    <div class="row" data-key="ap_pm_number">
                                        <div class="table_view_svg col-sm-2 change_status_color" >

                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <div class="col-sm-9 ">
                                            <div class="table-view-heading">PM No.</div>
                                            <div class="table-view-content"><?php echo $row->ap_pm_number; ?></div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-3" >
                                <div class="table-view-container">
                                    <?php
                                    $color_status = 'orange';
                                    if (!empty($redit_status['ap_coroner_reference']) && $redit_status['ap_coroner_reference'] == '1') {
                                        $color_status = 'green';
                                    } elseif (!empty($redit_status['ap_coroner_reference']) && $redit_status['ap_coroner_reference'] == '2') {
                                        $color_status = 'blue';
                                    }
                                    ?>
                                    <div class="row" data-key="ap_coroner_reference">
                                        <div class="table_view_svg col-sm-2 change_status_color" >

                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <div class="col-sm-9 ">
                                            <div class="table-view-heading">Coroner Reference</div>
                                            <div class="table-view-content"><?php echo $row->ap_coroner_reference; ?></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3" >
                                <div class="table-view-container">
                                    <?php
                                    $color_status = 'orange';

                                    ?>
                                    <div class="row">
                                        <div class="table_view_svg col-sm-2" >

                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <div class="col-sm-9 ">
                                            <div class="table-view-heading">Specimen Nature</div>
                                            <div class="table-view-content"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-3" >
                                <div class="table-view-container">
                                    <?php
                                    $color_status = 'orange';

                                    ?>
                                    <div class="row">
                                        <div class="table_view_svg col-sm-2" >

                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <div class="col-sm-9 ">
                                            <div class="table-view-heading">Organisation site identifier</div>
                                            <div class="table-view-content"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-3" >
                                <div class="table-view-container">
                                    <?php
                                    $color_status = 'orange';

                                    ?>
                                    <div class="row">
                                        <div class="table_view_svg col-sm-2" >

                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <div class="col-sm-9 ">
                                            <div class="table-view-heading">Organisation identifier</div>
                                            <div class="table-view-content"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-3" >
                                <div class="table-view-container">
                                    <?php
                                    $color_status = 'orange';
                                    if (!empty($redit_status['lab_name']) && $redit_status['lab_name'] == '1') {
                                        $color_status = 'green';
                                    } elseif (!empty($redit_status['lab_name']) && $redit_status['lab_name'] == '2') {
                                        $color_status = 'blue';
                                    }
                                    ?>
                                    <div class="row" data-key="lab_name">
                                        <div class="table_view_svg col-sm-2 change_status_color" >

                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <div class="col-sm-9 ">
                                            <div class="table-view-heading">Lab Name</div>
                                            <div class="table-view-content"><?php echo $row->lab_name; ?></div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-3" >
                                <div class="table-view-container">
                                    <?php
                                    $color_status = 'orange';
                                    if (!empty($redit_status['dermatological_surgeon']) && $redit_status['dermatological_surgeon'] == '1') {
                                        $color_status = 'green';
                                    } elseif (!empty($redit_status['dermatological_surgeon']) && $redit_status['dermatological_surgeon'] == '2') {
                                        $color_status = 'blue';
                                    }
                                    ?>
                                    <div class="row" data-key="dermatological_surgeon">
                                        <div class="table_view_svg col-sm-2 change_status_color" >

                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <div class="col-sm-9 ">
                                            <div class="table-view-heading">Clinician (Pcr7100)</div>
                                            <div class="table-view-content"><?php echo $row->dermatological_surgeon; ?></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-3" >
                                <div class="table-view-container">
                                    <?php
                                    $color_status = 'orange';
                                    if (!empty($redit_status['ap_patient_id']) && $redit_status['ap_patient_id'] == '1') {
                                        $color_status = 'green';
                                    } elseif (!empty($redit_status['ap_patient_id']) && $redit_status['ap_patient_id'] == '2') {
                                        $color_status = 'blue';
                                    }
                                    ?>
                                    <div class="row" data-key="ap_patient_id">
                                        <div class="table_view_svg col-sm-2 change_status_color" >

                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <div class="col-sm-9 ">
                                            <div class="table-view-heading">Patient ID</div>
                                            <div class="table-view-content"><?php echo $row->ap_patient_id; ?></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-3" >
                                <div class="table-view-container">
                                    <?php
                                    $color_status = 'orange';
                                    if (!empty($redit_status['ap_fridge_no']) && $redit_status['ap_fridge_no'] == '1') {
                                        $color_status = 'green';
                                    } elseif (!empty($redit_status['ap_fridge_no']) && $redit_status['ap_fridge_no'] == '2') {
                                        $color_status = 'blue';
                                    }
                                    ?>
                                    <div class="row" data-key="ap_fridge_no">
                                        <div class="table_view_svg col-sm-2 change_status_color" >

                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <div class="col-sm-9 ">
                                            <div class="table-view-heading">Fridge No.</div>
                                            <div class="table-view-content"><?php echo $row->ap_fridge_no; ?></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-3" >
                                <div class="table-view-container">
                                    <?php
                                    $color_status = 'orange';
                                    if (!empty($redit_status['location']) && $redit_status['location'] == '1') {
                                        $color_status = 'green';
                                    } elseif (!empty($redit_status['location']) && $redit_status['location'] == '2') {
                                        $color_status = 'blue';
                                    }
                                    ?>
                                    <div class="row" data-key="location">
                                        <div class="table_view_svg col-sm-2 change_status_color" >

                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <div class="col-sm-9 ">
                                            <div class="table-view-heading">Location</div>
                                            <div class="table-view-content"><?php echo $row->location; ?></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3" >
                                <div class="table-view-container">
                                    <?php
                                    $color_status = 'orange';

                                    ?>
                                    <div class="row">
                                        <div class="table_view_svg col-sm-2" >

                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <div class="col-sm-9 ">
                                            <div class="table-view-heading">Surgeon</div>
                                            <div class="table-view-content"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-3" >
                                <div class="table-view-container">
                                    <?php
                                    $color_status = 'orange';
                                    if (!empty($redit_status['death_datetime']) && $redit_status['death_datetime'] == '1') {
                                        $color_status = 'green';
                                    } elseif (!empty($redit_status['death_datetime']) && $redit_status['death_datetime'] == '2') {
                                        $color_status = 'blue';
                                    }
                                    ?>
                                    <div class="row" data-key="death_datetime">
                                        <div class="table_view_svg col-sm-2 change_status_color" >

                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <div class="col-sm-9 ">
                                            <div class="table-view-heading">Date & Time of Death</div>
                                            <?php
                                            $death_datetime = '';
                                            if (!empty($row->ap_death_datetime)) {
                                                $death_datetime = date('d-m-Y H:i', strtotime($row->ap_death_datetime));
                                            }
                                            ?>
                                            <div class="table-view-content"><?php echo $death_datetime; ?></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-3" >
                                <div class="table-view-container">
                                    <?php
                                    $color_status = 'orange';

                                    ?>
                                    <div class="row">
                                        <div class="table_view_svg col-sm-2" >

                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <div class="col-sm-9 ">
                                            <div class="table-view-heading">Pathologist</div>
                                            <div class="table-view-content"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-3" >
                                <div class="table-view-container">
                                    <?php
                                    $color_status = 'orange';
                                    if (!empty($redit_status['ap_apt']) && $redit_status['ap_apt'] == '1') {
                                        $color_status = 'green';
                                    } elseif (!empty($redit_status['ap_apt']) && $redit_status['ap_apt'] == '2') {
                                        $color_status = 'blue';
                                    }
                                    ?>
                                    <div class="row" data-key="ap_apt">
                                        <div class="table_view_svg col-sm-2 change_status_color" >

                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <div class="col-sm-9 ">
                                            <div class="table-view-heading">APT</div>
                                            <div class="table-view-content"><?php echo $row->ap_apt; ?></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
<!--                        <div class="row">-->
<!---->
<!--                            <div class="col-sm-3" >-->
<!--                                <div class="table-view-container">-->
<!--                                    --><?php
//                                    $color_status = 'orange';
//                                    if (!empty($redit_status['date_received_bylab']) && $redit_status['date_received_bylab'] == '1') {
//                                        $color_status = 'green';
//                                    } elseif (!empty($redit_status['date_received_bylab']) && $redit_status['date_received_bylab'] == '2') {
//                                        $color_status = 'blue';
//                                    }
//                                    ?>
<!--                                    <div class="row" data-key="date_received_bylab">-->
<!--                                        <div class="table_view_svg col-sm-2 change_status_color" >-->
<!---->
<!--                                            <svg width="26" height="26">-->
<!--                                                <circle cx="13" cy="13" r="12" stroke="--><?php //echo $color_status; ?><!--" fill-opacity="0" stroke-width="1"/>-->
<!--                                                <circle cx="13" cy="13" r="7" stroke="--><?php //echo $color_status; ?><!--" fill="--><?php //echo $color_status; ?><!--" stroke-width="2"/>-->
<!--                                            </svg>-->
<!--                                        </div>-->
<!--                                        <div class="col-sm-9 ">-->
<!--                                            <div class="table-view-heading">REC LAB</div>-->
<!--                                            --><?php
//                                            $date_received_bylab = '';
//                                            if (!empty($row->date_received_bylab)) {
//                                                $date_received_bylab = date('d-m-Y', strtotime($row->date_received_bylab));
//                                            }
//                                            ?>
<!--                                            <div class="table-view-content">--><?php //echo $date_received_bylab; ?><!--</div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                            <div class="col-sm-3" >-->
<!--                                <div class="table-view-container">-->
<!--                                    --><?php
//                                    $color_status = 'orange';
//                                    if (!empty($redit_status['date_sent_touralensis']) && $redit_status['date_sent_touralensis'] == '1') {
//                                        $color_status = 'green';
//                                    } elseif (!empty($redit_status['date_sent_touralensis']) && $redit_status['date_sent_touralensis'] == '2') {
//                                        $color_status = 'blue';
//                                    }
//                                    ?>
<!--                                    <div class="row" data-key="date_sent_touralensis">-->
<!--                                        <div class="table_view_svg col-sm-2 change_status_color" >-->
<!---->
<!--                                            <svg width="26" height="26">-->
<!--                                                <circle cx="13" cy="13" r="12" stroke="--><?php //echo $color_status; ?><!--" fill-opacity="0" stroke-width="1"/>-->
<!--                                                <circle cx="13" cy="13" r="7" stroke="--><?php //echo $color_status; ?><!--" fill="--><?php //echo $color_status; ?><!--" stroke-width="2"/>-->
<!--                                            </svg>-->
<!--                                        </div>-->
<!--                                        <div class="col-sm-9 ">-->
<!--                                            <div class="table-view-heading">REL LAB</div>-->
<!--                                            --><?php
//                                            $sent_to_uralensis_date = '';
//                                            if (!empty($row->date_sent_touralensis)) {
//                                                $sent_to_uralensis_date = date('d-m-Y', strtotime($row->date_sent_touralensis));
//                                            } else {
//                                                if (!empty($bck_frm_lab_date_data)) {
//                                                    $sent_to_uralensis_date = date('d-m-Y', strtotime($bck_frm_lab_date_data));
//                                                }
//                                            }
//                                            ?>
<!--                                            <div class="table-view-content">--><?php //echo $sent_to_uralensis_date; ?><!--</div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-sm-3" >-->
<!--                                <div class="table-view-container">-->
<!--                                    --><?php
//                                    $color_status = 'orange';
//                                    if (!empty($redit_status['emis_number']) && $redit_status['emis_number'] == '1') {
//                                        $color_status = 'green';
//                                    } elseif (!empty($redit_status['emis_number']) && $redit_status['emis_number'] == '2') {
//                                        $color_status = 'blue';
//                                    }
//                                    ?>
<!--                                    <div class="row" data-key="emis_number">-->
<!--                                        <div class="table_view_svg col-sm-2 change_status_color" >-->
<!---->
<!--                                            <svg width="26" height="26">-->
<!--                                                <circle cx="13" cy="13" r="12" stroke="--><?php //echo $color_status; ?><!--" fill-opacity="0" stroke-width="1"/>-->
<!--                                                <circle cx="13" cy="13" r="7" stroke="--><?php //echo $color_status; ?><!--" fill="--><?php //echo $color_status; ?><!--" stroke-width="2"/>-->
<!--                                            </svg>-->
<!--                                        </div>-->
<!--                                        <div class="col-sm-9 ">-->
<!--                                            <div class="table-view-heading">Scanner Type</div>-->
<!--                                            <div class="table-view-content">--><?php //echo $row->emis_number; ?><!--</div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-sm-3" >-->
<!--                                <div class="table-view-container">-->
<!--                                    --><?php
//                                    $color_status = 'orange';
//                                    if (!empty($redit_status['pci_number']) && $redit_status['pci_number'] == '1') {
//                                        $color_status = 'green';
//                                    } elseif (!empty($redit_status['pci_number']) && $redit_status['pci_number'] == '2') {
//                                        $color_status = 'blue';
//                                    }
//                                    ?>
<!--                                    <div class="row" data-key="pci_number">-->
<!--                                        <div class="table_view_svg col-sm-2 change_status_color" >-->
<!---->
<!--                                            <svg width="26" height="26">-->
<!--                                                <circle cx="13" cy="13" r="12" stroke="--><?php //echo $color_status; ?><!--" fill-opacity="0" stroke-width="1"/>-->
<!--                                                <circle cx="13" cy="13" r="7" stroke="--><?php //echo $color_status; ?><!--" fill="--><?php //echo $color_status; ?><!--" stroke-width="2"/>-->
<!--                                            </svg>-->
<!--                                        </div>-->
<!--                                        <div class="col-sm-9 ">-->
<!--                                            <div class="table-view-heading">Digi Number</div>-->
<!--                                            <div class="table-view-content">--><?php //echo $row->pci_number; ?><!--</div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                        </div>-->
<!--                        <div class="row">-->
<!--                            <div class="col-sm-3" >-->
<!--                                <div class="table-view-container">-->
<!--                                    --><?php
//                                    $color_status = 'orange';
//
//                                    ?>
<!--                                    <div class="row">-->
<!--                                        <div class="table_view_svg col-sm-2" >-->
<!---->
<!--                                            <svg width="26" height="26">-->
<!--                                                <circle cx="13" cy="13" r="12" stroke="--><?php //echo $color_status; ?><!--" fill-opacity="0" stroke-width="1"/>-->
<!--                                                <circle cx="13" cy="13" r="7" stroke="--><?php //echo $color_status; ?><!--" fill="--><?php //echo $color_status; ?><!--" stroke-width="2"/>-->
<!--                                            </svg>-->
<!--                                        </div>-->
<!--                                        <div class="col-sm-9 ">-->
<!--                                            <div class="table-view-heading">Speciality</div>-->
<!--                                            <div class="table-view-content"></div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-sm-3" >-->
<!--                                <div class="table-view-container">-->
<!--                                    --><?php
//                                    $color_status = 'orange';
//
//                                    ?>
<!--                                    <div class="row">-->
<!--                                        <div class="table_view_svg col-sm-2" >-->
<!---->
<!--                                            <svg width="26" height="26">-->
<!--                                                <circle cx="13" cy="13" r="12" stroke="--><?php //echo $color_status; ?><!--" fill-opacity="0" stroke-width="1"/>-->
<!--                                                <circle cx="13" cy="13" r="7" stroke="--><?php //echo $color_status; ?><!--" fill="--><?php //echo $color_status; ?><!--" stroke-width="2"/>-->
<!--                                            </svg>-->
<!--                                        </div>-->
<!--                                        <div class="col-sm-9 ">-->
<!--                                            <div class="table-view-heading">Specimen No.</div>-->
<!--                                            <div class="table-view-content"></div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-sm-3" >-->
<!--                                <div class="table-view-container">-->
<!--                                    --><?php
//                                    $color_status = 'orange';
//
//                                    ?>
<!--                                    <div class="row">-->
<!--                                        <div class="table_view_svg col-sm-2" >-->
<!---->
<!--                                            <svg width="26" height="26">-->
<!--                                                <circle cx="13" cy="13" r="12" stroke="--><?php //echo $color_status; ?><!--" fill-opacity="0" stroke-width="1"/>-->
<!--                                                <circle cx="13" cy="13" r="7" stroke="--><?php //echo $color_status; ?><!--" fill="--><?php //echo $color_status; ?><!--" stroke-width="2"/>-->
<!--                                            </svg>-->
<!--                                        </div>-->
<!--                                        <div class="col-sm-9 ">-->
<!--                                            <div class="table-view-heading">Courier No.</div>-->
<!--                                            <div class="table-view-content"></div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-sm-3" >-->
<!--                                <div class="table-view-container">-->
<!--                                    --><?php
//                                    $color_status = 'orange';
//
//                                    ?>
<!--                                    <div class="row">-->
<!--                                        <div class="table_view_svg col-sm-2" >-->
<!---->
<!--                                            <svg width="26" height="26">-->
<!--                                                <circle cx="13" cy="13" r="12" stroke="--><?php //echo $color_status; ?><!--" fill-opacity="0" stroke-width="1"/>-->
<!--                                                <circle cx="13" cy="13" r="7" stroke="--><?php //echo $color_status; ?><!--" fill="--><?php //echo $color_status; ?><!--" stroke-width="2"/>-->
<!--                                            </svg>-->
<!--                                        </div>-->
<!--                                        <div class="col-sm-9 ">-->
<!--                                            <div class="table-view-heading">Batch No.</div>-->
<!--                                            <div class="table-view-content"></div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                        </div>-->
<!--                        <div class="row">-->
<!--                            <div class="col-sm-3" >-->
<!--                                <div class="table-view-container">-->
<!--                                    --><?php
//                                    $color_status = 'orange';
//                                    if (!empty($redit_status['report_urgency']) && $redit_status['report_urgency'] == '1') {
//                                        $color_status = 'green';
//                                    } elseif (!empty($redit_status['report_urgency']) && $redit_status['report_urgency'] == '2') {
//                                        $color_status = 'blue';
//                                    }
//                                    ?>
<!--                                    <div class="row" data-key="report_urgency">-->
<!--                                        <div class="table_view_svg col-sm-2 change_status_color" >-->
<!---->
<!--                                            <svg width="26" height="26">-->
<!--                                                <circle cx="13" cy="13" r="12" stroke="--><?php //echo $color_status; ?><!--" fill-opacity="0" stroke-width="1"/>-->
<!--                                                <circle cx="13" cy="13" r="7" stroke="--><?php //echo $color_status; ?><!--" fill="--><?php //echo $color_status; ?><!--" stroke-width="2"/>-->
<!--                                            </svg>-->
<!--                                        </div>-->
<!--                                        <div class="col-sm-9 ">-->
<!--                                            <div class="table-view-heading">Status</div>-->
<!--                                            <div class="table-view-content">--><?php //echo $row->report_urgency; ?><!--</div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!---->
<!--                        </div>-->
                    </div>
                    <div id="edit-view-request" style="display: none;">
                        <div class="card-body">
                            <div class="row">
                                <?php
                                $color_status = 'orange';
                                if (!empty($redit_status['serial_number']) && $redit_status['serial_number'] == '1') {
                                    $color_status = 'green';
                                } elseif (!empty($redit_status['serial_number']) && $redit_status['serial_number'] == '2') {
                                    $color_status = 'blue';
                                }
                                ?>

                                <div class="form-group col-md-3">
                                    <label for="serial_number">UL No.</label>
                                    <div class="form_input_container" data-key="serial_number">
                                        <div class="radial_btn_container change_status_color">
                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>

                                        </div>
                                        <input id="serial_number" type="text" name="serial_number" class="form_input" placeholder="UL No." value="<?php echo $row->serial_number; ?>">
                                    </div>
                                    <?php $json['serial_number'] = $row->serial_number; ?>
                                </div>


                                <?php
                                $color_status='orange';
                                ?>
                                <div class="form-group col-md-3">
                                    <label for="track_number" class="text-warning">Track No.</label>
                                    <div class="form_input_container" data-key="track_number">
                                        <div class="radial_btn_container">
                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>

                                        </div>
                                        <input type="text" class="form_input" id="track_number" name="track_number" placeholder="Address" value="" disabled>
                                    </div>
                                    <label></label>
                                </div>

                                <?php
                                $color_status = 'orange';
                                if (!empty($redit_status['ap_pm_number']) && $redit_status['ap_pm_number'] == '1') {
                                    $color_status = 'green';
                                } elseif (!empty($redit_status['ap_pm_number']) && $redit_status['ap_pm_number'] == '2') {
                                    $color_status = 'blue';
                                }
                                ?>

                                <div class="form-group col-md-3">
                                    <label for="ap_pm_number">PM No. (Pcr0980)</label>
                                    <div class="form_input_container" data-key="ap_pm_number">
                                        <div class="radial_btn_container change_status_color">
                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>

                                        </div>
                                        <input type="text" class="form_input" id="ap_pm_number" name="ap_pm_number" placeholder="PM Number" value="<?php echo $row->ap_pm_number; ?>">
                                    </div>
                                    <?php $json['ap_pm_number'] = $row->ap_pm_number; ?>
                                </div>

                                <?php
                                $color_status = 'orange';
                                if (!empty($redit_status['ap_coroner_reference']) && $redit_status['ap_coroner_reference'] == '1') {
                                    $color_status = 'green';
                                } elseif (!empty($redit_status['ap_coroner_reference']) && $redit_status['ap_coroner_reference'] == '2') {
                                    $color_status = 'blue';
                                }
                                ?>

                                <div class="form-group col-md-3">
                                    <label for="ap_coroner_reference">Coroner Reference</label>
                                    <div class="form_input_container" data-key="ap_coroner_reference">
                                        <div class="radial_btn_container change_status_color">
                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>

                                        </div>
                                        <input type="text" class="form_input" id="ap_coroner_reference" name="ap_coroner_reference" placeholder="Coroner Reference" value="<?php echo $row->ap_coroner_reference; ?>">
                                    </div>
                                    <?php $json['ap_coroner_reference'] = $row->ap_coroner_reference; ?>
                                </div>

                                <?php
                                $color_status='orange';
                                ?>

                                <div class="form-group col-md-3">
                                    <label for="specimen_nature" class="text-warning">Specimen Nature (Pcr0970)</label>
                                    <div class="form_input_container" data-key="specimen_nature">
                                        <div class="radial_btn_container">
                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>

                                        </div>
                                        <input type="text" class="form_input" id="specimen_nature" name="specimen_nature" placeholder="Specimen Nature" value="" disabled>
                                    </div>
                                </div>


                                <div class="form-group col-md-3">
                                    <label for="organisation_site_identifier" class="text-warning">Org Site ID (Pcr0980)</label>
                                    <div class="form_input_container" data-key="organisation_site_identifier">
                                        <div class="radial_btn_container">
                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>

                                        </div>
<!--                                        <input type="text" class="form_input" id="organisation_site_identifier" name="organisation_site_identifier" placeholder="Organisation site identifier" value="" disabled>-->
                                        <select class="form_input" id="request_from" name="request_from">
                                            <option value="">Select Org Site ID</option>
                                            <?php foreach ($request_from_to_list as $req_f_t) {
//                                                echo '<pre>'; print_r($req_f_t); exit;
                                                if($req_f_t['identifier_type']=='from'){ ?>
                                                    <option value="<?php echo $req_f_t['id']; ?>"> <?php echo $req_f_t['identifier_name']; ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group col-md-3">
                                    <label for="organisation_identifier" class="text-warning">Org ID (Pcr0800)</label>
                                    <div class="form_input_container" data-key="organisation_identifier">
                                        <div class="radial_btn_container">
                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>

                                        </div>
<!--                                        <input type="text" class="form_input" id="organisation_identifier" name="organisation_identifier" placeholder="Organisation Identifier" value="">-->
                                        <select class="form_input" id="request_to" name="request_to">
                                            <option value="">Select Org ID</option>
                                            <?php foreach ($request_from_to_list as $req_f_t) {
//                                                echo '<pre>'; print_r($req_f_t); exit;
                                                if($req_f_t['identifier_type']=='to'){ ?>
                                                <option value="<?php echo $req_f_t['id']; ?>"> <?php echo $req_f_t['identifier_name']; ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>


                                <?php
                                $color_status = 'orange';
                                if (!empty($redit_status['lab_name']) && $redit_status['lab_name'] == '1') {
                                    $color_status = 'green';
                                } elseif (!empty($redit_status['lab_name']) && $redit_status['lab_name'] == '2') {
                                    $color_status = 'blue';
                                }
                                ?>

                                <div class="form-group col-md-3">
                                    <label for="lab_name">Lab Name (Pcr0980)</label>
                                    <div class="form_input_container" data-key="lab_name">
                                        <div class="radial_btn_container change_status_color">
                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>

                                        </div>
                                        <select class="form_input lab_name" id="lab_name" name="lab_name">
                                            <option value="0">Choose</option>
                                            <?php
                                            $get_lab_names = $this->Doctor_model->getLabNamesFromLabGroups();

                                            if (!empty($get_lab_names) && is_array($get_lab_names)) :
                                                foreach ($get_lab_names as $lab_key => $lab_val) {
                                                    $selected = '';
                                                    if ($lab_val['id'] == $row->lab_id) {
                                                        $selected = 'selected';
                                                    }
                                                    echo '<option data-labnameid="' . $lab_val['id'] . '" ' . $selected . ' value="' . $lab_val['id'] . '">' . ucwords($lab_val['description']) . '</option>';
                                                }
                                            endif;
                                            ?>
                                            <?php
                                            $selected = '';
                                            if ($row->lab_name === 'U') {
                                                $selected = 'selected';
                                            }
                                            ?>
                                            <option <?php echo $selected; ?> value="U">Other</option>
                                        </select>
                                    </div>
                                    <?php $json['lab_name'] = $row->lab_name; ?>
                                </div>

                                <?php
                                $color_status = 'orange';
                                if (!empty($redit_status['dermatological_surgeon']) && $redit_status['dermatological_surgeon'] == '1') {
                                    $color_status = 'green';
                                } elseif (!empty($redit_status['dermatological_surgeon']) && $redit_status['dermatological_surgeon'] == '2') {
                                    $color_status = 'blue';
                                }
                                ?>

                                <div class="form-group col-md-3">
                                    <label for="dermatological_surgeon">Clinician (Pcr7100)</label>
                                    <div class="form_input_container" data-key="dermatological_surgeon">
                                        <div class="radial_btn_container change_status_color">
                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>

                                        </div>
                                        <select name="dermatological_surgeon" id="dermatological_surgeon" class="form_input">
                                            <option value="">Choose</option>
                                            <?php echo $this->Doctor_model->get_clinician_and_derm($row->hospital_group_id, 'dermatological', $row->dermatological_surgeon); ?>
                                        </select>
                                    </div>
                                    <?php $json['dermatological_surgeon'] = $row->dermatological_surgeon; ?>
                                </div>

                                <?php
                                $color_status = 'orange';
                                if (!empty($redit_status['ap_patient_id']) && $redit_status['ap_patient_id'] == '1') {
                                    $color_status = 'green';
                                } elseif (!empty($redit_status['ap_patient_id']) && $redit_status['ap_patient_id'] == '2') {
                                    $color_status = 'blue';
                                }
                                ?>

                                <div class="form-group col-md-3">
                                    <label for="location">Patient ID</label>
                                    <div class="form_input_container" data-key="ap_patient_id">
                                        <div class="radial_btn_container change_status_color">
                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>

                                        </div>
                                        <input type="text" class="form_input" id="ap_patient_id" name="ap_patient_id" placeholder="Pateint ID" value="<?php echo $row->ap_patient_id; ?>">
                                    </div>
                                    <label></label>
                                    <?php $json['ap_patient_id'] = $row->ap_patient_id; ?>
                                </div>

                                <?php
                                $color_status = 'orange';
                                if (!empty($redit_status['ap_fridge_no']) && $redit_status['ap_fridge_no'] == '1') {
                                    $color_status = 'green';
                                } elseif (!empty($redit_status['ap_fridge_no']) && $redit_status['ap_fridge_no'] == '2') {
                                    $color_status = 'blue';
                                }
                                ?>

                                <div class="form-group col-md-3">
                                    <label for="location">Fridge No.</label>
                                    <div class="form_input_container" data-key="ap_fridge_no">
                                        <div class="radial_btn_container change_status_color">
                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>

                                        </div>
                                        <input type="text" class="form_input" id="ap_fridge_no" name="ap_fridge_no" placeholder="Fridge No." value="<?php echo $row->ap_fridge_no; ?>">
                                    </div>
                                    <label></label>
                                    <?php $json['ap_fridge_no'] = $row->ap_fridge_no; ?>
                                </div>

                                <?php
                                $color_status = 'orange';
                                if (!empty($redit_status['location']) && $redit_status['location'] == '1') {
                                    $color_status = 'green';
                                } elseif (!empty($redit_status['location']) && $redit_status['location'] == '2') {
                                    $color_status = 'blue';
                                }
                                ?>

                                <div class="form-group col-md-3">
                                    <label for="location">Location</label>
                                    <div class="form_input_container" data-key="location">
                                        <div class="radial_btn_container change_status_color">
                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>

                                        </div>
                                        <input type="text" class="form_input" id="location" name="location" placeholder="Location" value="<?php echo $row->location; ?>">
                                    </div>
                                    <label></label>
                                    <?php $json['location'] = $row->location; ?>
                                </div>

                                <?php
                                $color_status='orange';
                                ?>
                                <div class="form-group col-md-3">
                                    <label for="surgeon" class="text-warning">Surgeon (CR0030)</label>
                                    <div class="form_input_container" data-key="surgeon">
                                        <div class="radial_btn_container">
                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>

                                        </div>
                                        <input type="text" class="form_input" id="surgeon" name="surgeon" placeholder="Surgeon" value="" disabled>
                                    </div>
                                </div>

                                <?php
                                $color_status = 'orange';
                                if (!empty($redit_status['ap_death_datetime']) && $redit_status['ap_death_datetime'] == '1') {
                                    $color_status = 'green';
                                } elseif (!empty($redit_status['ap_death_datetime']) && $redit_status['ap_death_datetime'] == '2') {
                                    $color_status = 'blue';
                                }
                                ?>

                                <div class="form-group col-md-3">
                                    <label for="ap_death_datetime">Date & Time of Death (Pcr1010)</label>
                                    <div class="form_input_container" data-key="ap_death_datetime">
                                        <div class="radial_btn_container change_status_color">
                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>

                                        </div>
                                        <?php
                                        $death_datetime = '';
                                        if (!empty($row->ap_death_datetime)) {
                                            $death_datetime = date('d-m-Y H:i', strtotime($row->ap_death_datetime));
                                        }
                                        ?>
                                        <input class="form_input datetimepicker" type="text" name="ap_death_datetime" placeholder="Date & Time of Death" value="<?php echo $death_datetime; ?>" />
                                    </div>
                                    <?php $json['ap_death_datetime'] = date('d-m-Y H:i:s', strtotime($row->ap_death_datetime)); ?>
                                </div>

                                <?php
                                $color_status='orange';
                                ?>

                                <div class="form-group col-md-3">
                                    <label for="pathologist" class="text-warning">Pathologist (Pcr6990)</label>
                                    <div class="form_input_container" data-key="pathologist">
                                        <div class="radial_btn_container">
                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>

                                        </div>
                                        <select class="form-control"  id="pathologist" name="pathologist">
                                            <option>Select Pathologist</option>
                                            <option>Select Pathologist</option>
                                            <option>Select Pathologist</option>
                                            <option>Select Pathologist</option>
                                            <option>Select Pathologist</option>
                                        </select>
                                        <!-- <input type="text" class="form_input" id="pathologist" name="pathologist" placeholder="pathologist" value="" disabled> -->
                                    </div>
                                </div>

                                <?php
                                $color_status = 'orange';
                                if (!empty($redit_status['ap_apt']) && $redit_status['ap_apt'] == '1') {
                                    $color_status = 'green';
                                } elseif (!empty($redit_status['ap_apt']) && $redit_status['ap_apt'] == '2') {
                                    $color_status = 'blue';
                                }
                                ?>

                                <div class="form-group col-md-3">
                                    <label for="location">APT</label>
                                    <div class="form_input_container" data-key="ap_apt">
                                        <div class="radial_btn_container change_status_color">
                                            <svg width="26" height="26">
                                                <circle cx="13" cy="13" r="12" stroke="<?php echo $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                <circle cx="13" cy="13" r="7" stroke="<?php echo $color_status; ?>" fill="<?php echo $color_status; ?>" stroke-width="2"/>
                                            </svg>

                                        </div>
                                        <input type="text" class="form_input" id="ap_apt" name="ap_apt" placeholder="Apt" value="<?php echo $row->ap_apt; ?>">
                                    </div>
                                    <label></label>
                                    <?php $json['ap_apt'] = $row->ap_apt; ?>
                                </div>

<!--                                --><?php
//                                $color_status = 'orange';
//                                if (!empty($redit_status['date_received_bylab']) && $redit_status['date_received_bylab'] == '1') {
//                                    $color_status = 'green';
//                                } elseif (!empty($redit_status['date_received_bylab']) && $redit_status['date_received_bylab'] == '2') {
//                                    $color_status = 'blue';
//                                }
//                                ?>
<!---->
<!--                                <div class="form-group col-md-3">-->
<!--                                    <label for="date_received_bylab">REC LAB (Pcr0770)</label>-->
<!--                                    <div class="form_input_container" data-key="date_received_bylab">-->
<!--                                        <div class="radial_btn_container change_status_color">-->
<!--                                            <svg width="26" height="26">-->
<!--                                                <circle cx="13" cy="13" r="12" stroke="--><?php //echo $color_status; ?><!--" fill-opacity="0" stroke-width="1"/>-->
<!--                                                <circle cx="13" cy="13" r="7" stroke="--><?php //echo $color_status; ?><!--" fill="--><?php //echo $color_status; ?><!--" stroke-width="2"/>-->
<!--                                            </svg>-->
<!---->
<!--                                        </div>-->
<!--                                        --><?php
//                                        $date_received_bylab = '';
//                                        if (!empty($row->date_received_bylab)) {
//                                            $date_received_bylab = date('d-m-Y', strtotime($row->date_received_bylab));
//                                        }
//                                        ?>
<!--                                        <input class="form_input" type="text" name="date_received_bylab" id="datetaken_doctor" placeholder="REC LAB" value="--><?php //echo $date_received_bylab; ?><!--" />-->
<!--                                    </div>-->
<!--                                    --><?php //$json['date_received_bylab'] = date('d-m-Y', strtotime($row->date_received_bylab)); ?>
<!--                                </div>-->
<!---->
<!---->
<!--                                --><?php
//                                $color_status = 'orange';
//                                if (!empty($redit_status['date_sent_touralensis']) && $redit_status['date_sent_touralensis'] == '1') {
//                                    $color_status = 'green';
//                                } elseif (!empty($redit_status['date_sent_touralensis']) && $redit_status['date_sent_touralensis'] == '2') {
//                                    $color_status = 'blue';
//                                }
//                                ?>
<!---->
<!--                                <div class="form-group col-md-3">-->
<!--                                    <label for="date_sent_touralensis">REL LAB</label>-->
<!--                                    <div class="form_input_container" data-key="date_sent_touralensis">-->
<!--                                        <div class="radial_btn_container change_status_color">-->
<!--                                            <svg width="26" height="26">-->
<!--                                                <circle cx="13" cy="13" r="12" stroke="--><?php //echo $color_status; ?><!--" fill-opacity="0" stroke-width="1"/>-->
<!--                                                <circle cx="13" cy="13" r="7" stroke="--><?php //echo $color_status; ?><!--" fill="--><?php //echo $color_status; ?><!--" stroke-width="2"/>-->
<!--                                            </svg>-->
<!---->
<!--                                        </div>-->
<!--                                        --><?php
//                                        $sent_to_uralensis_date = '';
//                                        if (!empty($row->date_sent_touralensis)) {
//                                            $sent_to_uralensis_date = date('d-m-Y', strtotime($row->date_sent_touralensis));
//                                        } else {
//                                            if (!empty($bck_frm_lab_date_data)) {
//                                                $sent_to_uralensis_date = date('d-m-Y', strtotime($bck_frm_lab_date_data));
//                                            }
//                                        }
//                                        ?>
<!--                                        <input type="text" name="date_sent_touralensis" class="form_input" id="date_sent_touralensis" placeholder="Uralensis Sent Date" value="--><?php //echo $sent_to_uralensis_date; ?><!--" />-->
<!--                                    </div>-->
<!--                                    <label></label>-->
<!--                                    --><?php //$json['date_sent_touralensis'] = date('d-m-Y', strtotime($sent_to_uralensis_date)); ?>
<!--                                </div>-->
<!---->
<!--                                --><?php
//                                $color_status = 'orange';
//                                if (!empty($redit_status['emis_number']) && $redit_status['emis_number'] == '1') {
//                                    $color_status = 'green';
//                                } elseif (!empty($redit_status['emis_number']) && $redit_status['emis_number'] == '2') {
//                                    $color_status = 'blue';
//                                }
//                                ?>
<!---->
<!--                                <div class="form-group col-md-3">-->
<!--                                    <label for="emis_number">Scanner Type</label>-->
<!--                                    <div class="form_input_container" data-key="emis_number">-->
<!--                                        <div class="radial_btn_container change_status_color">-->
<!--                                            <svg width="26" height="26">-->
<!--                                                <circle cx="13" cy="13" r="12" stroke="--><?php //echo $color_status; ?><!--" fill-opacity="0" stroke-width="1"/>-->
<!--                                                <circle cx="13" cy="13" r="7" stroke="--><?php //echo $color_status; ?><!--" fill="--><?php //echo $color_status; ?><!--" stroke-width="2"/>-->
<!--                                            </svg>-->
<!---->
<!--                                        </div>-->
<!--                                        <input id="emis_number" type="text" name="emis_number" class="form_input" placeholder="Scanner Type" value="--><?php //echo $row->emis_number; ?><!--">-->
<!--                                    </div>-->
<!--                                    <label></label>-->
<!--                                    --><?php //$json['emis_number'] = $row->emis_number; ?>
<!--                                </div>-->
<!---->
<!---->
<!--                                --><?php
//                                $color_status = 'orange';
//                                if (!empty($redit_status['pci_number']) && $redit_status['pci_number'] == '1') {
//                                    $color_status = 'green';
//                                } elseif (!empty($redit_status['pci_number']) && $redit_status['pci_number'] == '2') {
//                                    $color_status = 'blue';
//                                }
//                                ?>
<!---->
<!--                                <div class="form-group col-md-3">-->
<!--                                    <label for="pci_number">Digi Number (Pcr0950)</label>-->
<!--                                    <div class="form_input_container" data-key="pci_number">-->
<!--                                        <div class="radial_btn_container change_status_color">-->
<!--                                            <svg width="26" height="26">-->
<!--                                                <circle cx="13" cy="13" r="12" stroke="--><?php //echo $color_status; ?><!--" fill-opacity="0" stroke-width="1"/>-->
<!--                                                <circle cx="13" cy="13" r="7" stroke="--><?php //echo $color_status; ?><!--" fill="--><?php //echo $color_status; ?><!--" stroke-width="2"/>-->
<!--                                            </svg>-->
<!---->
<!--                                        </div>-->
<!--                                        <input id="pci_number" type="text" name="pci_number" class="form_input" placeholder="Digi Number" value="--><?php //echo $row->pci_number; ?><!--">-->
<!--                                    </div>-->
<!--                                    --><?php //$json['pci_number'] = $row->pci_number; ?>
<!--                                </div>-->
<!---->
<!--                                --><?php
//                                $color_status='orange';
//                                ?>
<!--                                <div class="form-group col-md-3">-->
<!--                                    <label for="request_specialty" class="text-warning">Specialty (Pcr7130)</label>-->
<!--                                    <div class="form_input_container" data-key="request_specialty">-->
<!--                                        <div class="radial_btn_container">-->
<!--                                            <svg width="26" height="26">-->
<!--                                                <circle cx="13" cy="13" r="12" stroke="--><?php //echo $color_status; ?><!--" fill-opacity="0" stroke-width="1"/>-->
<!--                                                <circle cx="13" cy="13" r="7" stroke="--><?php //echo $color_status; ?><!--" fill="--><?php //echo $color_status; ?><!--" stroke-width="2"/>-->
<!--                                            </svg>-->
<!---->
<!--                                        </div>-->
<!--                                        <input type="text" class="form_input" id="request_specialty" name="request_specialty" placeholder="Specialty" value="" disabled>-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                                --><?php
//                                $color_status='orange';
//                                ?>
<!--                                <div class="form-group col-md-3">-->
<!--                                    <label for="specimen_no" class="text-warning">Specimen No. (Pcr6220)</label>-->
<!--                                    <div class="form_input_container" data-key="specimen_no">-->
<!--                                        <div class="radial_btn_container">-->
<!--                                            <svg width="26" height="26">-->
<!--                                                <circle cx="13" cy="13" r="12" stroke="--><?php //echo $color_status; ?><!--" fill-opacity="0" stroke-width="1"/>-->
<!--                                                <circle cx="13" cy="13" r="7" stroke="--><?php //echo $color_status; ?><!--" fill="--><?php //echo $color_status; ?><!--" stroke-width="2"/>-->
<!--                                            </svg>-->
<!---->
<!--                                        </div>-->
<!--                                        <input type="text" class="form_input" id="specimen_no" name="specimen_no" placeholder="Specimen No." value="" disabled>-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                                --><?php
//                                $color_status='orange';
//                                ?>
<!--                                <div class="form-group col-md-3">-->
<!--                                    <label for="courier_no" class="text-warning">Courier no.</label>-->
<!--                                    <div class="form_input_container" data-key="courier_no">-->
<!--                                        <div class="radial_btn_container">-->
<!--                                            <svg width="26" height="26">-->
<!--                                                <circle cx="13" cy="13" r="12" stroke="--><?php //echo $color_status; ?><!--" fill-opacity="0" stroke-width="1"/>-->
<!--                                                <circle cx="13" cy="13" r="7" stroke="--><?php //echo $color_status; ?><!--" fill="--><?php //echo $color_status; ?><!--" stroke-width="2"/>-->
<!--                                            </svg>-->
<!---->
<!--                                        </div>-->
<!--                                        <input type="text" class="form_input" id="courier_no" name="courier_no" placeholder="Courier no." value="" disabled>-->
<!--                                    </div>-->
<!--                                    <label></label>-->
<!--                                </div>-->
<!---->
<!--                                --><?php
//                                $color_status='orange';
//                                ?>
<!--                                <div class="form-group col-md-3">-->
<!--                                    <label for="batch_no" class="text-warning">Batch no.</label>-->
<!--                                    <div class="form_input_container" data-key="batch_no">-->
<!--                                        <div class="radial_btn_container">-->
<!--                                            <svg width="26" height="26">-->
<!--                                                <circle cx="13" cy="13" r="12" stroke="--><?php //echo $color_status; ?><!--" fill-opacity="0" stroke-width="1"/>-->
<!--                                                <circle cx="13" cy="13" r="7" stroke="--><?php //echo $color_status; ?><!--" fill="--><?php //echo $color_status; ?><!--" stroke-width="2"/>-->
<!--                                            </svg>-->
<!---->
<!--                                        </div>-->
<!--                                        <input type="text" class="form_input" id="batch_no" name="batch_no" placeholder="Batch no." value="" disabled>-->
<!--                                    </div>-->
<!--                                    <label></label>-->
<!--                                </div>-->
<!---->
<!--                                --><?php
//                                $color_status = 'orange';
//                                if (!empty($redit_status['report_urgency']) && $redit_status['report_urgency'] == '1') {
//                                    $color_status = 'green';
//                                } elseif (!empty($redit_status['report_urgency']) && $redit_status['report_urgency'] == '2') {
//                                    $color_status = 'blue';
//                                }
//                                ?>
<!---->
<!--                                <div class="form-group col-md-3">-->
<!--                                    <label for="report_urgency">Status</label>-->
<!--                                    <div class="form_input_container" data-key="report_urgency">-->
<!--                                        <div class="radial_btn_container change_status_color">-->
<!--                                            <svg width="26" height="26">-->
<!--                                                <circle cx="13" cy="13" r="12" stroke="--><?php //echo $color_status; ?><!--" fill-opacity="0" stroke-width="1"/>-->
<!--                                                <circle cx="13" cy="13" r="7" stroke="--><?php //echo $color_status; ?><!--" fill="--><?php //echo $color_status; ?><!--" stroke-width="2"/>-->
<!--                                            </svg>-->
<!---->
<!--                                        </div>-->
<!--                                        <select name="report_urgency" class="form_input " id="report_urgency">-->
<!--                                            --><?php
//                                            $report_urgency = array(
//                                                'Routine' => 'Routine',
//                                                'Urgent' => 'Urgent',
//                                                '2WW' => '2WW'
//                                            );
//
//                                            foreach ($report_urgency as $key => $urgency) {
//                                                $selected = '';
//                                                if ($key == $row->report_urgency) {
//                                                    $selected = 'selected';
//                                                }
//                                                ?>
<!--                                                <option --><?php //echo $selected; ?><!-- value="--><?php //echo $key; ?><!--">--><?php //echo $urgency; ?><!--</option>-->
<!--                                            --><?php //} ?>
<!--                                        </select>-->
<!--                                    </div>-->
<!--                                    <label></label>-->
<!--                                    --><?php //$json['report_urgency'] = $row->report_urgency; ?>
<!--                                </div>-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="tg-themedetailsicon">
                    <li>
                        <a href="javascript:void(0);" class="tg-detailsicon" data-toggle="modal" data-target="#view_doc" <?php echo (!empty($files && is_array($files))?'onclick="embed_doc()"':'') ?> title="Related Documents"><span
                                    title="Related Documents"   class="tg-notificationtag"><?php echo count($files); ?></span>
                            <i class="ti-eye"></i>
                        </a>
                        <a href="javascript:;" class="tg-detailsicon tg-filtercolors" title="View Report" id="show_pdf_iframe">
                            <i title="View Report" class="ti-search"></i>
                        </a>
                        <!--                        --><?php //if ($request_query[0]->specimen_publish_status == 1) { ?>
                        <!--                            <a href="--><?php //echo site_url() . '/doctor/generate_report/' . $request_query[0]->uralensis_request_id; ?><!--"-->
                        <!--                               target="_blank" class="tg-detailsicon" id="show_pdf_iframe"><i title="View Final PDF" class="ti-notepad"></i></a>-->
                        <!--                        --><?php //} ?>
                        <a href="javascript:;" class="tg-detailsicon" id="further_work_add" title="Add Further Work"><i title="Add Further Work" class="ti-target"></i></a>
                        <!--                        <a href="javascript:;" class="tg-detailsicon" title="Add to Queue"-->
                        <!--                           data-recordid="--><?php //echo $request_query[0]->uralensis_request_id; ?><!--"-->
                        <!--                           id="add_to_authorization"><i title="Add to Queue"-->
                        <!--                                                        class="ti-layers"></i></a>-->
                        <!--                            <a href="javascript:;" class="tg-detailsicon" data-toggle="modal" title="MDT"-->
                        <!--                               data-target="#mdt_data_modal"><i title="MDT"-->
                        <!--                                                                class="ti-archive"></i></a>-->
                    </li>
                    <li>
                        <a href="javascript:;" class="tg-detailsicon request_for_opinion" data-toggle="modal" title="Request for opinion" data-target="#request_for_opinion">
                            <i title="Request for opinion" class="ti-pulse"></i></a>
                        <a href="javascript:;" class="tg-detailsicon" data-toggle="modal" title="Assign to other doctor"
                           data-target="#assign_doctor_modal"><i title="Assign to other doctor" class="ti-support"></i></a>
                        <a href="javascript:;" class="tg-detailsicon" data-toggle="modal" title="Assign as teaching and cpc"
                           data-target="#teaching_cpc_modal"><i title="Assign as teaching and cpc"
                                                                class="ti-bell"></i></a>
                        <!--                        --><?php //if ($request_query[0]->specimen_publish_status == 1) { ?>
                        <!--                            <a href="javascript:;" class="tg-detailsicon" data-toggle="modal" title="Add Supplementarty Report"-->
                        <!--                               data-target="#add_supplementary"><i title="Add Supplementarty Report" class="ti-plus"></i></a>-->
                        <!--                        --><?php //} ?>
                        <!--                        --><?php //if ($request_query[0]->additional_data_state === 'in_session') { ?>
                        <!--                            <a href="javascript:;" id="publish_supplementary_btn" title="Publish Supplementarty Report"-->
                        <!--                               data-recordid="--><?php //echo $request_query[0]->uralensis_request_id; ?><!--"-->
                        <!--                               class="tg-detailsicon"><i title="Publish Supplementarty Report"-->
                        <!--                                                         class="ti-check-box"></i></a>-->
                        <!--                        --><?php //} ?>
                        <a href="javascript:;" class="tg-detailsicon" data-toggle="modal" title="Manage Supplementary"
                           data-target="#manage_supple"><i title="Manage Supplementary"
                                                           class="ti-wallet"></i></a>
                    </li>
                    <li>
                        <a href="javascript:;" class="tg-detailsicon" data-toggle="collapse" title="Uploaded Documents"
                           data-target="#relateddocs"><i class="ti-clip" title="Uploaded Documents" ></i></a>
                        <a href="javascript:;" class="tg-detailsicon" data-toggle="modal" title="Record History"
                           data-target="#rec_history_modal"><i class="ti-folder" title="Record History" ></i></a>
                    </li>
                    <li class="tg-reloadoption">
                        <!--                        <a href="javascript:void(0)" id="make_editable"-->
                        <!--                           class="tg-detailsicon disable tg-themeiconcolorone">-->
                        <!--                            <i class="ti-power-off" data-toggle="tooltip" data-placement="top" title="Enable/Disable Fields"></i></a>-->
                        <?php
                        $button_disable = '';
                        if (!empty($opinion_data[0]->ura_opinion_req_id) && $record_id == $opinion_data[0]->ura_opinion_req_id) {
                            $button_disable = 'disabled';
                        }
                        ?>
                        <!--                        <a href="javascript:;" --><?php //echo $button_disable; ?>
                        <!--                           class="tg-detailsicon tg-themeiconcolortwo update_doctor_autopsy_report_btn">-->
                        <!--                            <i class="ti-reload"></i>-->
                        <!--                        </a>-->
                        
                        <span class="btn btn-primary btn-rounded" style="background-color: #00c5fb;" data-toggle="modal" data-target="#weights_modal">Weights</span>
                    </li>
                </ul>
                </form>
                <div id="relateddocs" class="collapse">
                    <h3>Related Documents</h3>

                    <div class="col-md-12">
                        <?php
                        $attributes = array('class' => '');
                        echo form_open_multipart("doctor/do_upload_multiple/". $record_id, $attributes);
                        ?>

                            <div class="row">
                                <div class="form-group col-md-4">
                                <input type="hidden" name="autopsy_url" value="<?php echo base_url('doctor/doctor_record_detail_old/').$record_id.'/postmortem'; ?>">
                                <input required id="upload_user_file" class="form-control" type="file" multiple="" name="userfile[]" />
                        </div>
                            <div class="form-group col-md-2">
                        <button type="submit" class="btn btn-info mb-2 ">Upload</button>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <form class="tg-formtheme doctor_update_autopsy_record" id="" method="post">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <div class="update_wrap_1">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <a class="collapsed " data-toggle="collapse" href="#collapseOne">
                        <div class="row">
                            <div class="col-md-4">Identified By</div>
                            <div class="col-md-4">Place of Examination</div>
                            <div class="col-md-4">Date & Time of Examination</div>
                        </div>
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="card-collapse collapse">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <select class="form-control" name="ap_identified_by" >
                                <option value="0">Choose Doctor</option>
                                <?php
                                if (!empty($list_doctors)) {
                                    foreach ($list_doctors as $value) {
                                        ?>
                                        <option value="<?php echo $value->id; ?>" <?php echo(($value->id==$row->ap_identified_by?'selected':'')); ?> >
                                            <?php echo $value->first_name . ' ' . $value->last_name; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4"><input type="text" name="ap_examination_place" placeholder="Place of Examination" value="<?php echo $row->ap_examination_place; ?>" class="form-control"></div>
                        <div class="col-md-4"><input type="text" name="ap_examination_datetime" placeholder="Date & Time of Examination" value="<?php echo!empty($row->ap_examination_datetime) ? date('d-m-Y H:i', strtotime($row->ap_examination_datetime)) : ''; ?>" class="form-control datetimepicker"></div>
                    </div>
                    <!-- <table class="table custom-table">
                        <tbody>
                            <tr>
                                <td>Pathologist</td>
                                <td>ABC Hospital</td>
                                <td>date & time  of examination</td>
                            </tr>
                        </tbody>
                    </table> -->

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <a class="collapsed " data-toggle="collapse" href="#collapseTwo">History</a>
                </h4>
            </div>
            <div id="collapseTwo" class="card-collapse collapse">
                <div class="card-body">
                    <div class="col-md-12">
                        <table class="table table-striped nohead_border">
                            <thead>
                            <tr>
                                <th class="">Circumstance of Death</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <textarea rows="6" class="form-control" name="ap_death_circumstance"><?php echo $row->ap_death_circumstance; ?></textarea>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <a class="collapsed " data-toggle="collapse" href="#external_exams">External Examination</a>
                </h4>
            </div>
            <div id="external_exams" class="card-collapse collapse">
                <div class="card-body">
                    <div class="col-md-12">
                        <table class="table table-striped nohead_border">
                            <thead>
                            <tr>
                                <th colspan="2" class=""></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="border-right" width="180">Height (cm):</td>
                                <td><span class="form-control" style="padding: .375rem .75rem;"><?php echo $row->ap_height_cm; ?></span></td>
                                <td class="border-right" width="180">Weight (Kg):</td>
                                <td><span class="form-control" style="padding: .375rem .75rem;"><?php echo $row->ap_weight_kg; ?></span></td>
                                <td class="border-right" width="180">BMI:</td>
                                <td><span class="form-control" style="padding: .375rem .75rem;"><?php echo $row->ap_bmi_calculated; ?></span></td>
                            </tr>
                            <tr>
                                <td class="border-right">Description:</td>
                                <td colspan="5">
                                    <textarea rows="3" class="form-control" name="ap_external_exam_desc"><?php echo $row->ap_external_exam_desc; ?></textarea>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="text-center">
            <div class="form-group">
                <button <?php echo $button_disable; ?> class="btn btn-primary btn-rounded update_doctor_autopsy_report_btn " name="submit">Update</button>
            </div>
        </div>
        </div>
        <div class="update_wrap_1">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <span class="" style="color: #090909; display: block; font-size: 20px;
                    font-weight: 400; padding-right: 60px; position: relative;">Internal Examination</span>
                </h4>
            </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseThree">Central Nervous System</a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="card-collapse collapse">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <table class="table table-striped nohead_border">
                                            <thead>
                                            <tr>
                                                <th colspan="2" class=""></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="border-right" width="180">Brain Weight (g):</td>
                                                <td><span class="form-control" style="padding: .375rem .75rem;"><?php echo round($row->ap_brain_weight_gm); ?></span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-right" width="180">Brain</td>
                                                <td colspan="5"><input type="text" class="form-control" name="ap_ext_brain_status" value="<?php echo $row->ap_ext_brain_status; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td class="border-right">Circle of Willis</td>
                                                <td colspan="5"><input type="text" class="form-control" name="ap_ext_circle_wilis" value="<?php echo $row->ap_ext_circle_wilis; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td class="border-right">Meningies and Dura:</td>
                                                <td colspan="5"><input type="text" class="form-control" name="ap_ext_meningies_dura" value="<?php echo $row->ap_ext_meningies_dura; ?>"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <a class="collapsed " data-toggle="collapse" href="#collapseCardio">Cardiovascular System</a>
                                </h4>
                            </div>
                            <div id="collapseCardio" class="card-collapse collapse">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <table class="table table-striped nohead_border">
                                            <thead>
                                            <tr>
                                                <th colspan="2" class=""></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="border-right" width="180">Heart Weight (g):</td>
                                                <td><span class="form-control" style="padding: .375rem .75rem;"><?php echo round($row->ap_heart_weight_gm); ?></span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-right" width="180">Pericardium:</td>
                                                <td colspan="5"><input type="text" class="form-control" name="ap_pericardium" value="<?php echo $row->ap_pericardium; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td class="border-right">Coronary Vessels:</td>
                                                <td colspan="5"><input type="text" class="form-control" name="ap_coronary_vessels" value="<?php echo $row->ap_coronary_vessels; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td class="border-right">Atria, Valve, Myocardium:</td>
                                                <td colspan="5"><input type="text" class="form-control" name="ap_atrium_valves_myocardium" value="<?php echo $row->ap_atrium_valves_myocardium; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td class="border-right">Aorta, Great veins:</td>
                                                <td colspan="5"><input type="text" class="form-control" name="ap_aorta_great_veins" value="<?php echo $row->ap_aorta_great_veins; ?>"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <a class="collapsed " data-toggle="collapse" href="#collapseFour">Respiratory System</a>
                                    <!--                <button class="btn btn-primary btn-sm pull-right auto_save"><i class="fa fa-save"></i></button>-->
                                </h4>
                            </div>
                            <div id="collapseFour" class="card-collapse collapse">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <table class="table table-striped custom-table table-bordered">
                                            <tbody>
                                            <tr>
                                                <td width="190">Larynx and Trachea :</td>
                                                <td>
                                                    <input type="text" name="ap_lyranx_trachea" class="form-control" value="<?php echo $row->ap_lyranx_trachea; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Bronchi:</td>
                                                <td>
                                                    <input type="text" name="ap_bronchi" class="form-control" value="<?php echo $row->ap_bronchi; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-right" width="180">Right Lung Weight (g):</td>
                                                <td><span class="form-control" style="padding: .375rem .75rem;"><?php echo round($row->ap_rt_lung_weight_gm); ?></span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-right" width="180">Left Lung Weight (g):</td>
                                                <td><span class="form-control" style="padding: .375rem .75rem;"><?php echo round($row->ap_lt_lung_weight_gm); ?></span></td>
                                            </tr>
                                            <tr>
                                                <td>Lungs:</td>
                                                <td>
                                                    <input type="text" name="ap_lungs" class="form-control" value="<?php echo $row->ap_lungs; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pleura:</td>
                                                <td>
                                                    <input type="text" name="ap_pleura" class="form-control" value="<?php echo $row->ap_pleura; ?>">
                                                </td>
                                            </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <a class="collapsed " data-toggle="collapse" href="#collapseFive">Alimentary System</a>
                                    <!--                <button class="btn btn-primary btn-sm pull-right auto_save"><i class="fa fa-save"></i></button>-->

                                </h4>
                            </div>
                            <div id="collapseFive" class="card-collapse collapse">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <table class="table table-striped custom-table table-bordered">

                                            <tbody>
                                            <tr>
                                                <td width="300">Mouth, tongue, pharynx, oesophagus:</td>
                                                <td>
                                                    <input type="text" name="ap_mouth_t_phyr_oesophagus" class="form-control" value="<?php echo $row->ap_mouth_t_phyr_oesophagus; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Stomach:</td>
                                                <td>
                                                    <input type="text" name="ap_stomach" class="form-control" value="<?php echo $row->ap_stomach; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Small and large intestines:</td>
                                                <td>
                                                    <input type="text" name="ap_sm_lg_intestine" class="form-control" value="<?php echo $row->ap_sm_lg_intestine; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-right" width="180">Liver Weight (g):</td>
                                                <td><span class="form-control" style="padding: .375rem .75rem;"><?php echo round($row->ap_liver_weight_gm); ?></span></td>
                                            </tr>
                                            <tr>
                                                <td>Liver:</td>
                                                <td>
                                                    <input type="text" name="ap_liver" class="form-control" value="<?php echo $row->ap_liver; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Gall bladder:</td>
                                                <td>
                                                    <input type="text" name="ap_gall_bladder" class="form-control" value="<?php echo $row->ap_gall_bladder; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pancreas:</td>
                                                <td>
                                                    <input type="text" name="ap_pancreas" class="form-control" value="<?php echo $row->ap_pancreas; ?>" >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Peritoneum:</td>
                                                <td>
                                                    <input type="text" name="ap_peritoneum" class="form-control" value="<?php echo $row->ap_peritoneum; ?>" >
                                                </td>
                                            </tr>

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseSix">Genito-Urinary System</a>
                                </h4>
                            </div>
                            <div id="collapseSix" class="card-collapse collapse">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <table class="table table-striped custom-table table-bordered">
                                            <tbody>
                                            <tr>
                                                <td class="border-right" width="180">Right Kidney Weight (g):</td>
                                                <td><span class="form-control" style="padding: .375rem .75rem;"><?php echo round($row->ap_rt_kidney_weight_gm); ?></span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-right" width="180">Left Kidney Weight (g):</td>
                                                <td><span class="form-control" style="padding: .375rem .75rem;"><?php echo round($row->ap_lt_kidney_weight_gm); ?></span></td>
                                            </tr>
                                            <tr>
                                                <td width="200">Kidneys:</td>
                                                <td><input type="text" name="ap_kidneys" class="form-control" value="<?php echo $row->ap_kidneys; ?>" ></td>
                                            </tr>
                                            <tr>
                                                <td>Ureters, bladder:</td>
                                                <td><input type="text" name="ap_uretus_bladder" class="form-control" value="<?php echo $row->ap_uretus_bladder; ?>" ></td>
                                            </tr>
                                            <tr>
                                                <td>Uterus, cervix, ovaries:</td>
                                                <td><input type="text" name="ap_uterus_cerv_overies" class="form-control" value="<?php echo $row->ap_uterus_cerv_overies; ?>" ></td>
                                            </tr>
                                            <tr>
                                                <td>Prostate:</td>
                                                <td><input type="text" name="ap_prostate" class="form-control" value="<?php echo $row->ap_prostate; ?>" ></td>
                                            </tr>
                                            <tr>
                                                <td>External genitalia:</td>
                                                <td><input type="text" name="ap_external_genitalia" class="form-control" value="<?php echo $row->ap_external_genitalia; ?>" ></td>
                                            </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a class="collapsed" data-toggle="collapse" href="#collapseSeven_1">Reticulo-Endothelial System</a>
                                        </h4>
                                    </div>
                                    <div id="collapseSeven_1" class="card-collapse collapse">
                                        <div class="card-body">
                                            <div class="col-md-12">
                                                <table class="table table-striped custom-table table-bordered">

                                                    <tbody>
                                                    <tr>
                                                        <td class="border-right" width="180">Spleen Weight (g):</td>
                                                        <td><span class="form-control" style="padding: .375rem .75rem;"><?php echo round($row->ap_spleen_weight_gm); ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="140">Spleen:</td>
                                                        <td><input type="text" name="ap_spleen" class="form-control" value="<?php echo $row->ap_spleen; ?>" ></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lymph nodes:</td>
                                                        <td><input type="text" name="ap_lymph_nodes" class="form-control" value="<?php echo $row->ap_lymph_nodes; ?>" ></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Thymus:</td>
                                                        <td><input type="text" name="ap_thymus" class="form-control" value="<?php echo $row->ap_thymus; ?>" ></td>
                                                    </tr>

                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a class="collapsed" data-toggle="collapse" href="#collapseSeven_2">Endocrine System</a>
                                        </h4>
                                    </div>
                                    <div id="collapseSeven_2" class="card-collapse collapse">
                                        <div class="card-body">
                                            <div class="col-md-12">
                                                <table class="table table-striped custom-table table-bordered">

                                                    <tbody>
                                                    <tr>
                                                        <td class="border-right" width="180">Thyroid Weight (g):</td>
                                                        <td><span class="form-control" style="padding: .375rem .75rem;"><?php echo round($row->ap_thyroid_wt_gm); ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="150">Thyroid, adrenals:</td>
                                                        <td><input type="text" name="ap_thyroid_adrenals" class="form-control" value="<?php echo $row->ap_thyroid_adrenals; ?>" ></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pituitary gland:</td>
                                                        <td><input type="text" name="ap_pituitary_gland" class="form-control" value="<?php echo $row->ap_pituitary_gland; ?>" ></td>
                                                    </tr>
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a class="collapsed" data-toggle="collapse" href="#collapseEight_1">Musculoskeletal System</a>
                                        </h4>
                                    </div>
                                    <div id="collapseEight_1" class="card-collapse collapse">
                                        <div class="card-body">
                                            <div class="col-md-12">
                                                <table class="table table-striped custom-table table-bordered">

                                                    <tbody>
                                                    <tr>
                                                        <td><input type="text" name="ap_musculoskeletal" placeholder="Musculoskeletal System" class="form-control" value="<?php echo $row->ap_musculoskeletal; ?>" ></td>
                                                    </tr>
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <a class="collapsed" data-toggle="collapse" href="#collapseEight_2">Pathological Findings</a>
                            <span class="btn btn-primary btn-sm pull-right auto_save add_path_f_field"><i class="fa fa-plus"></i> </span>
                        </h4>
                    </div>
                    <div id="collapseEight_2" class="card-collapse collapse">
                        <div class="card-body">
                            <div class="col-md-12">
                                <table class="table custom-table table-bordered">

                                    <tbody class="path_f_fields_wrap">
                                    <?php
                                    $path_finding_obj = json_decode($row->ap_pathological_finding, true);
                                    $remove_icon = "";
                                    if(!empty($path_finding_obj)){
                                        $itr2 = 1;
                                        foreach ($path_finding_obj as $key=>$val){
                                            if($itr2!==1){
                                                $remove_icon = '<td><a href="javascript:void(0)" class="pathology_remove_field btn btn-danger btn-sm"><i class="fa fa-minus"></i></a></td>';
                                            }
                                        ?>
                                            <tr>
                                                <td><input type="text" name="ap_pathological_finding[<?php echo $key; ?>]" placeholder="Pathological Finding" class="form-control" value="<?php echo $val; ?>" ></td>
                                                <?php echo $remove_icon; ?>
                                            </tr>
                                    <?php
                                        $itr2++;
                                        }
                                    }else{
                                    ?>
                                    <tr>
                                        <td><input type="text" name="ap_pathological_finding[]" placeholder="Pathological Finding" class="form-control" value="<?php echo $row->ap_pathological_finding; ?>" ></td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <a class="collapsed" data-toggle="collapse" href="#collapseNine_1">Histopathological Findings</a>
                            <span class="btn btn-primary btn-sm pull-right auto_save add_h_path_f_field"><i class="fa fa-plus"></i> </span>
                            <span class="btn btn-primary btn-sm btn-rounded pull-right histology_blocks" data-toggle="modal" data-target="#add_histology">Histology Blocks</span>
                        </h4>
                    </div>
                    <div id="collapseNine_1" class="card-collapse collapse">
                        <div class="card-body">
                            <div class="col-md-12">
                                <table class="table custom-table table-bordered">

                                    <tbody class="h_path_f_fields_wrap">
                                    <?php
                                    $h_path_finding_obj = json_decode($row->ap_histopathological_finding, true);
                                    $remove_icon = "";
                                    if(!empty($h_path_finding_obj)){
                                        $itr1=1;
                                        foreach ($h_path_finding_obj as $key=>$val){
                                            if($itr1!==1){
                                                $remove_icon = '<td><a href="javascript:void(0)" class="h_pathology_remove_field btn btn-danger btn-sm"><i class="fa fa-minus"></i></a></td>';
                                            }
                                            ?>
                                            <tr>
                                                <td><input type="text" name="ap_histopathological_finding[<?php echo $key; ?>]" placeholder="Histopathological Finding" class="form-control" value="<?php echo $val; ?>" ></td>
                                                <?php echo $remove_icon; ?>
                                            </tr>
                                            <?php
                                            $itr1++;
                                        }
                                    }else{
                                        ?>
                                        <tr>
                                            <td><input type="text" name="ap_histopathological_finding[]" placeholder="Histopathological Finding" class="form-control" value="<?php echo $row->ap_histopathological_finding; ?>" ></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <a class="collapsed" data-toggle="collapse" href="#collapseNine_2">Toxicology Report</a>
                        </h4>
                    </div>
                    <div id="collapseNine_2" class="card-collapse collapse">
                        <div class="card-body">
                            <div class="col-md-12">
                                <table class="table custom-table table-bordered">

                                    <tbody>
                                    <tr>
                                        <td>
                                            <textarea rows="3" class="form-control" name="ap_toxicology_report"><?php echo $row->ap_toxicology_report; ?></textarea>
                                        </td>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <a class="collapsed " data-toggle="collapse" href="#collapseTen_1">Cause of Death</a>
                            <span class="btn btn-primary btn-sm pull-right auto_save add_c_death_field"><i class="fa fa-plus"></i> </span>
                        </h4>
                    </div>
                    <div id="collapseTen_1" class="card-collapse collapse">
                        <div class="card-body">
                            <div class="col-md-12 nopadding" style="max-height:200px; overflow-y: auto; ">
                                <table class="table custom-table table-bordered">
                                <tbody class="c_death_fields_wrap">
                                <?php
                                $c_of_death_obj = json_decode($row->ap_cause_of_death, true);
                                $key="";
                                $val="";
                                $itrr=1;
                                if(!empty($c_of_death_obj)){
                                    $label = "";
                                    $remove_icon = "";
                                    foreach ($c_of_death_obj as $key=>$val){
                                        if($itrr==1){
                                            $label="1a";
                                        }elseif ($itrr==2){ $label="1b";
                                            $remove_icon = '<td><a href="javascript:void(0)" class="c_death_remove_field btn btn-danger btn-sm"><i class="fa fa-minus"></i></a></td>';
                                        }
                                        elseif ($itrr==3){ $label="1c";
                                            $remove_icon = '<td><a href="javascript:void(0)" class="c_death_remove_field btn btn-danger btn-sm"><i class="fa fa-minus"></i></a></td>';
                                        }
                                        else{$label=2;
                                            $remove_icon = '<td><a href="javascript:void(0)" class="c_death_remove_field btn btn-danger btn-sm"><i class="fa fa-minus"></i></a></td>';
                                        }
                                        ?>
                                        <tr>
                                            <td class="form-inline">
                                                <label><?php echo $label; ?></label>
                                                <input type="text" name="ap_cause_of_death[]" placeholder="" class="form-control ml-2" style="width: 92%;" value="<?php echo $val; ?>" >
                                            </td>
                                            <?php echo $remove_icon; ?>
                                        </tr>
                                        <?php
                                    $itrr=$itrr+1;
                                    }
                                }else{
                                    ?>
                                    <tr>
                                        <td><label>1a</label><input type="text" name="ap_cause_of_death[<?php echo $key; ?>]" placeholder="Cause of Death" class="form-control" value="" ></td>
                                    </tr>
                                <?php } ?>
                                <input type="hidden" id="dt_fields_count" value="<?php echo $itrr; ?>">
                                </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <a class="collapsed" data-toggle="collapse" href="#collapseTen_2">Comments</a>
                        </h4>
                    </div>
                    <div id="collapseTen_2" class="card-collapse collapse">
                        <div class="card-body">
                            <div class="col-md-12">
                                <table class="table table-striped custom-table table-bordered">

                                    <tbody>
                                    <tr>
                                        <td>
<!--                                            <label for="ap_comments">Comments</label>-->
                                            <textarea rows="5" class="form-control" name="ap_comments"><?php echo $row->ap_comments; ?></textarea>
                                        </td>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <a class="collapsed" data-toggle="collapse" href="#collapseTen_3">SNOMED & Record Notes</a>
                        </h4>
                    </div>
                    <div id="collapseTen_3" class="card-collapse collapse">
                        <div class="card-body">
                            <div class="tg-tabfieldsetfourhold">
                                <fieldset class="tg-tabfieldsetfour">
                                    <div class="row">
                                        <div class="form-group col-md-3 halfformgroup specimen_snomed_options">
                                        <span class="tg-select specimen_snomed_select">
                                            <?php
                                            $snomed_t_array = getSnomedCodes('t1');
                                            $ap_snomed_t1 = array();
                                            $ap_snomed_t1_obj = json_decode($row->ap_snomed_t1, true);
                                            if(!empty($ap_snomed_t1_obj)){
                                                $ap_snomed_t1 = $ap_snomed_t1_obj;
                                            }
                                            ?>
                                            <label for="ap_snomed_t1">SNOMED T1</label>
                                            <select name="ap_snomed_t1[]" id="ap_snomed_t1" class="form-control select2" multiple>
                                                <option data-hidden="true">Nothing Selected</option>
                                                <?php
                                                foreach ($snomed_t_array as $snomed_t_code) { ?>
                                                    <option value="<?php echo $snomed_t_code['usmd_code_id']; ?>" <?php echo (in_array($snomed_t_code['usmd_code_id'],$ap_snomed_t1)?'selected':''); ?> > <?php echo $snomed_t_code['usmdcode_code'].' '.$snomed_t_code['usmdcode_code_desc']; ?> </option>
                                                <?php   }
                                                ?>
                                            </select>
                                        </span>
                                        </div>
                                        <div class="form-group col-md-3 halfformgroup specimen_snomed_options">
                                        <span class="tg-select specimen_snomed_select">
                                            <?php
                                            $snomed_t2_array = getSnomedCodes('t1');
                                            $ap_snomed_t2 = array();
                                            $ap_snomed_t2_obj = json_decode($row->ap_snomed_t2, true);
                                            if(!empty($ap_snomed_t2_obj)){
                                                $ap_snomed_t2 = $ap_snomed_t2_obj;
                                            }
                                            ?>
                                            <label for="ap_snomed_t2">SNOMED T2</label>
                                            <select name="ap_snomed_t2[]" id="ap_snomed_t2" class="form-control select2" multiple>
                                                <option data-hidden="true">Nothing Selected</option>
                                                <?php
                                                foreach ($snomed_t2_array as $snomed_t2_code) { ?>
                                                    <option value="<?php echo $snomed_t2_code['usmd_code_id']; ?>" <?php echo (in_array($snomed_t2_code['usmd_code_id'],$ap_snomed_t2)?'selected':''); ?> > <?php echo $snomed_t2_code['usmdcode_code'].' '.$snomed_t2_code['usmdcode_code_desc']; ?> </option>
                                                <?php }
                                                ?>
                                            </select>
                                        </span>
                                        </div>
                                        <div class="form-group col-md-3 tg-formgroupcheck halfform-group">
                                        <span class="tg-select specimen_snomed_select">
                                            <?php
                                            $snomed_p_array = getSnomedCodes('p');
                                            $ap_snomed_p = array();
                                            $ap_snomed_p_obj = json_decode($row->ap_snomed_p, true);
                                            if(!empty($ap_snomed_p_obj)){
                                                $ap_snomed_p = $ap_snomed_p_obj;
                                            }
                                            ?>
                                            <label for="ap_snomed_p">SNOMED P</label>
                                            <select name="ap_snomed_p[]" id="ap_snomed_p"class="form-control select2" multiple>
                                            <option data-hidden="true">Nothing Selected</option>
                                                <?php
                                                foreach ($snomed_p_array as $snomed_p_code) { ?>
                                                    <option value="<?php echo $snomed_p_code['usmd_code_id']; ?>" <?php echo (in_array($snomed_p_code['usmd_code_id'],$ap_snomed_p)?'selected':''); ?> > <?php echo $snomed_p_code['usmdcode_code'].' '.$snomed_p_code['usmdcode_code_desc']; ?> </option>
                                                <?php }
                                                ?>
                                            </select>
                                        </span>
                                        </div>
                                        <div class="form-group col-md-3 tg-formgroupcheck halfform-group">
                                            <?php
                                            $snomed_m_array = getSnomedCodes('m');
                                            $ap_snomed_m = array();
                                            $ap_snomed_m_obj = json_decode($row->ap_snomed_m, true);
                                            if(!empty($ap_snomed_m_obj)){
                                                $ap_snomed_m = $ap_snomed_m_obj;
                                            }
                                            ?>
                                            <label>SNOMED M</label><br>
                                            <select name="ap_snomed_m[]" id="ap_snomed_m" class="form-control select2" multiple>
                                                <option data-hidden="true">Nothing Selected</option>
                                                <?php
                                                foreach ($snomed_m_array as $snomed_m_code) { ?>
                                                    <option value="<?php echo $snomed_m_code['usmd_code_id']; ?>" <?php echo (in_array($snomed_m_code['usmd_code_id'],$ap_snomed_m)?'selected':''); ?>  > <?php echo $snomed_m_code['usmdcode_code'].' '.$snomed_m_code['usmdcode_code_desc']; ?> </option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 tg-formgroupcheck halfform-group">
                                            <textarea name="ap_special_notes" class="form-control" rows="5" placeholder="Notes"><?php echo $row->ap_special_notes; ?></textarea>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group tg-privmsg-btn tg-formgroupcheck halfformgroup">
                                        <a class="form-group-btn btn btn-default" href="#" data-toggle="modal" data-target="#sendprivatemessage">Pm
                                            Msg</a>
                                        <textarea name="specimen_feedback_to_lab" class="form-control" placeholder="Feedback to Lab:"><?php echo $row->specimen_feedback_to_lab; ?></textarea>
                                    </div>
                                    <div class="form-group tg-formgroupcheck halfformgroup">
                                        <textarea name="specimen_feedback_to_secretary" class="form-control" placeholder="Feedback to Secretary:"><?php echo $row->specimen_feedback_to_secretary; ?></textarea>
                                    </div>
                                    <div class="form-group tg-privmsg-btn tg-formgroupcheck halfformgroup">
                                        <a class="form-group-btn btn btn-default" href="#" data-toggle="modal" data-target="#sendprivatemessage">Pm
                                            Msg</a>
                                        <textarea name="specimen_error_log" class="form-control" placeholder="Error Log:"><?php echo $row->specimen_error_log; ?></textarea>
                                    </div> -->

                                </fieldset>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--        <div class="card">-->
<!--            <div class="card-header">-->
<!--                <h4 class="card-title">-->
<!--                    <a class="collapsed " data-toggle="collapse" href="#collapseEleven">consultant-->
<!--                        histopathologist</a>-->
<!--                </h4>-->
<!--            </div>-->
<!--            <div id="collapseEleven" class="card-collapse collapse">-->
<!--                <div class="card-body">-->
<!--                    <div class="col-md-12">-->
<!--                        <table class="table table-striped custom-table table-bordered">-->
<!---->
<!--                            <tbody>-->
<!--                            <tr>-->
<!--                                <td colspan="2">MBChB, FRCPath</td>-->
<!--                            </tr>-->
<!--                            <tr>-->
<!--                                <td colspan="2">GMC No. --><?php //echo $this->ion_auth->user()->row()->gmc_code ?><!--</td>-->
<!--                            </tr>-->
<!--                            <tr>-->
<!--                                <td width="200">Name in BLOCK LETTERS</td>-->
<!--                                <td>ISKANDER H. CHAUDHRY</td>-->
<!--                            </tr>-->
<!--                            </tbody>-->
<!--                            <tfoot>-->
<!--                            </tfoot>-->
<!---->
<!--                        </table>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->


        <!--    <div class="col-md-12 ">-->
        <!--        <p>this report is confidential. it should not be discloused to a third party without the coroner's consent</p>-->
        <!--    </div>-->

    <div class="row">
        <div class="col-md-12">
            <div class="page-buttons">
                <button type="button" id="feedback_to_lab_button" class="btn btn-light" data-toggle="modal" data-target="#sendprivatemessage" >
                    <i class="fa fa-dot-circle-o mr-3"></i>
                    Lab:
                    <span class="badge badge-pill bg-blue">0</span>
                </button>
                <button type="button" id="feedback_to_mortuary_button" class="btn btn-light" data-toggle="modal" data-target="#send_feedback_mortuary" >
                    <i class="fa fa-dot-circle-o mr-3"></i>
                    Mortuary:
                    <span class="badge badge-pill bg-blue">0</span>
                </button>
                <button type="button" id="feedback_to_secretary_button" class="btn btn-light" data-toggle="modal" data-target="#sendprivatemessage_secretary">
                    <i class="fa fa-dot-circle-o mr-3"></i>
                    Feedback To Secretary:
                    <span class="badge badge-pill bg-blue">0</span>
                </button>
                <button type="button" id="error_log_button" class="btn btn-light" data-toggle="modal" data-target="#sendprivatemessage_error">
                    <i class="fa fa-dot-circle-o mr-3"></i>
                    Error Log:
                    <span class="badge badge-pill bg-blue">0</span>
                </button>
                <button type="button" id="error_log_button2" class="btn btn-light" data-toggle="modal" data-target="#colleagues_list">
                    <i class="fa fa-dot-circle-o mr-3"></i>
                    + Doctors:
                    <span class="badge badge-pill bg-blue">
                        <?php
                        $relevant_doctors = array();
                        $relevant_doctors_obj = json_decode($row->ap_relevant_doctors, true);
                        if(!empty($relevant_doctors_obj)){
                            $relevant_doctors = $relevant_doctors_obj;
                        }
                        ?>
                        <?php echo count($relevant_doctors); ?>
                    </span>
                </button>

                <button <?php echo $button_disable; ?> class="btn btn-primary btn-rounded update_doctor_autopsy_report_btn pull-right" name="submit">Update</button>
            </div>
        </div>
    </div>
    </div>
</form>
<div class="clearfix"></div>
<div class="update_wrap_1">
    <div class="row ">
        <div class="col-md-12">
            <?php
            if (empty($opinion_data)) {
                $opinion_data = array();
            }
            if (empty($opinion_data_reply['opinion_data_reply'])) {
                $opinion_data_reply = array();
            }
            if (class_exists('Opinion_Cases')) {
                Opinion_Cases::display_comments($record_id, $opinion_data, $opinion_data_reply);
            }
            ?>
        </div>
    </div>
</div>

<div class="modal font-16" id="weights_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h4 class="modal-title" style="width: 100%">BMI</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form id="ap_bmi_weights_form" method="post">
                <input name="request_id" type="hidden" value="<?php echo $record_id; ?>">
                <div class="row">
                    <div class="col-md-3 form-group">Height (cm)</div>
                    <div class="col-md-3 form-group">
                        <input type="text" id="ap_height_cm" name="ap_height_cm" value="<?php echo round($request_query[0]->ap_height_cm); ?>" onkeypress="return isNumberKey(event)" onkeyup="calculate_bmi()" class="form-control">
                    </div>
                    <div class="col-md-3 form-group">Weight (Kg)</div>
                    <div class="col-md-3 form-group">
                        <input type="text" id="ap_weight_kg" name="ap_weight_kg" value="<?php echo round($request_query[0]->ap_weight_kg); ?>" onkeypress="return isNumberKey(event)" onkeyup="calculate_bmi()" class="form-control">
                    </div>
                    <div class="col-md-12 form-group text-center">
                        <span id="calculated_bmi_span">BMI: <?php echo (!empty($request_query[0]->ap_bmi_calculated)?$request_query[0]->ap_bmi_calculated:''); ?>  </span>
                        <input type="hidden" id="ap_bmi_calculated" name="ap_bmi_calculated" value="<?php echo round($request_query[0]->ap_bmi_calculated); ?>" >
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-md-12 text-center form-group">
                        Organs Weights (grams)
                        <button class="btn btn-rounded btn-primary pull-right"><i class="fa fa-plus" style="font-size: 16px;"></i>
                        </button>
                    </div>
                    <div class="col-md-2 npr form-group">Brain</div>
                    <div class="col-md-4 form-group">
                        <input type="text" name="ap_brain_weight_gm" value="<?php echo round($request_query[0]->ap_brain_weight_gm); ?>" onkeypress="return isNumberKey(event)" class="form-control">
                    </div>
                    <div class="col-md-2 npr form-group">Heart</div>
                    <div class="col-md-4 form-group">
                        <input type="text" name="ap_heart_weight_gm" value="<?php echo round($request_query[0]->ap_heart_weight_gm); ?>" onkeypress="return isNumberKey(event)" class="form-control">
                    </div>
                    <div class="col-md-2 npr form-group">Right Ventricle</div>
                    <div class="col-md-4 form-group">
                        <input type="text" name="ap_rt_ventricle_weight_gm" value="<?php echo round($request_query[0]->ap_rt_ventricle_weight_gm); ?>" onkeypress="return isNumberKey(event)" class="form-control">
                    </div>
                    <div class="col-md-2 npr form-group">Left Ventricle</div>
                    <div class="col-md-4 form-group">
                        <input type="text" name="ap_lt_ventricle_weight_gm" value="<?php echo round($request_query[0]->ap_lt_ventricle_weight_gm); ?>" onkeypress="return isNumberKey(event)" class="form-control">
                    </div>
                    <div class="col-md-2 npr form-group">Right Lung</div>
                    <div class="col-md-4 form-group">
                        <input type="text" name="ap_rt_lung_weight_gm" value="<?php echo round($request_query[0]->ap_rt_lung_weight_gm); ?>" onkeypress="return isNumberKey(event)" class="form-control">
                    </div>
                    <div class="col-md-2 npr form-group">Left Lung</div>
                    <div class="col-md-4 form-group">
                        <input type="text" name="ap_lt_lung_weight_gm" value="<?php echo round($request_query[0]->ap_lt_lung_weight_gm); ?>" onkeypress="return isNumberKey(event)" class="form-control">
                    </div>
                    <div class="col-md-2 npr form-group">Liver</div>
                    <div class="col-md-4 form-group">
                        <input type="text" name="ap_liver_weight_gm" value="<?php echo round($request_query[0]->ap_liver_weight_gm); ?>" onkeypress="return isNumberKey(event)" class="form-control">
                    </div>
                    <div class="col-md-2 npr form-group">Spleen</div>
                    <div class="col-md-4 form-group">
                        <input type="text" name="ap_spleen_weight_gm" value="<?php echo round($request_query[0]->ap_spleen_weight_gm); ?>" onkeypress="return isNumberKey(event)" class="form-control">
                    </div>
                    <div class="col-md-2 npr form-group">Right Kidney</div>
                    <div class="col-md-4 form-group">
                        <input type="text" name="ap_rt_kidney_weight_gm" value="<?php echo round($request_query[0]->ap_rt_kidney_weight_gm); ?>" onkeypress="return isNumberKey(event)" class="form-control">
                    </div>
                    <div class="col-md-2 npr form-group">Left Kidney</div>
                    <div class="col-md-4 form-group">
                        <input type="text" name="ap_lt_kidney_weight_gm" value="<?php echo round($request_query[0]->ap_lt_kidney_weight_gm); ?>" onkeypress="return isNumberKey(event)" class="form-control">
                    </div>
                    <div class="col-md-2 npr form-group">Thyroid</div>
                    <div class="col-md-4 form-group">
                        <input type="text" name="ap_thyroid_wt_gm" value="<?php echo round($request_query[0]->ap_thyroid_wt_gm); ?>" onkeypress="return isNumberKey(event)" class="form-control">
                    </div>
                    <div class="col-md-12 text-right"></div>
                </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" id="btn_bmi_weights_form" class="btn btn-primary btn-rounded">Save</button>
                <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
            </div>

        </div>
    </div>
</div>

<div id="view_doc" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open_multipart(uri_string(), array('id'=>'edit_cv_appraisal','name' => 'edit_cv_appraisal')); ?>
            <input type="hidden" name="edit_cv_appraisal" value="1">
            <div class="modal-body" id="doc_embed">
                <?php $file_path = $cv_appr_data['cv_doc_file_name']; ?>

            </div>
            <div class="modal-footer row">
                <div class="col-md-12">
                    <hr>
                    <span id="total_docs" style="float:left; padding: 0px 0px 10px 0px">Total Uploaded Document(s): 0</span>
                </div>
                <div class="row" style="width: 100%;">
                <div class="col-md-6">
                    <a href="javascript:void(0)" class="btn btn-primary pull-left" id="prev_button">Previous</a>
                </div>
                <div class="col-md-6">
                    <a href="javascript:void(0)" class="btn btn-primary pull-right" id="next_button">Next</a>
                </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<div id="add_histology" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Histology Key</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="doc_embed">
               <div class="row">
                   <div class="col-md-6 form-group">
                       <lable>Lab No</lable>
                       <input type="text" class="form-control">
                   </div>
                   <div class="col-md-6 form-group">
                       <lable style="visibility: hidden; display: block">Specimen No.</lable>
                       <button class="btn btn-primary btn-sm">Specimen No</button>
                       <span class="btn btn-primary added_dd"><i class="fa fa-plus"></i></span>
                   </div>
               </div>
               
               <div class="row form-group">
                    <div class="col-md-12 text-right">    
                        <span class="btn btn-primary added_dd"><i class="fa fa-plus"></i></span>
                    </div>

                   <div class="col-md-3">
                       <lable>Block</lable>
                        <input type="text" class="form-control">
                   </div>
                   <div class="col-md-3">
                       <lable>Tissue</lable>
                        <input type="text" class="form-control">
                   </div>
                   <div class="col-md-6 form-group">
                       <lable>Discription</lable>
                       <textarea rows="3" class="form-control"></textarea>
                   </div>
               </div>

            </div>
            <div class="modal-footer row">
                <div class="col-md-12 text-right">
                   <button class="btn btn-success">Save</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<div id="sendprivatemessage" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Send Private Email to Lab</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row ">
                    <div id="ed_success_alert"></div>
                    <div id="ed_error_alert"></div>
                </div>
                <div class="form tg-formtheme tg-editform">
                    <?php
                    //Get Lab Number and Serial Number as Subject for Private Message
                    $serial_no = $request_query[0]->serial_number;
                    $lab_no = $request_query[0]->ap_pm_number;
                    $priv_msg_subject = $serial_no .'&nbsp;|&nbsp;'. $lab_no;
                    ?>
                    <form id="ap_feedback_to_lab" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>To:</label>
                                <input type="email" class="form-control" list="desc" placeholder="To" name="recipients" id="email_to" value="">
                            </div>
                        </div>
                    </div>

                    <div class="row" style="display: none;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" placeholder="Cc" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" placeholder="Bcc" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Attachments</label>
                                <input type="file" class="form-control" name="files[]" multiple />

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" name="privmsg_subject" placeholder="Subject" value="<?php echo  $priv_msg_subject ?>" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Message</label>
                                <textarea rows="4" name="privmsg_body" class="form-control summernote" placeholder="Enter your message here"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="text-center">
                                    <button class="btn btn-primary" id="btn_feedback_to_lab" type="submit" name="send"><span>Send</span></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    </form>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="send_feedback_mortuary" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Send Private Email to Mortuary</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row ">
                    <div id="mort_success_alert"></div>
                    <div id="mort_error_alert"></div>
                </div>
                <div class="form tg-formtheme tg-editform">
                    <?php
                    //Get Lab Number and Serial Number as Subject for Private Message
                    $serial_no = $request_query[0]->serial_number;
                    $lab_no = $request_query[0]->ap_pm_number;
                    $priv_msg_subject = $serial_no .'&nbsp;|&nbsp;'. $lab_no;
                    ?>
                    <form id="ap_feedback_to_mortuary" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>To:</label>
                                <input type="email" class="form-control" list="desc" placeholder="To" name="recipients" id="mort_email_to" value="">
                            </div>
                        </div>
                    </div>

                    <div class="row" style="display: none;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" placeholder="Cc" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" placeholder="Bcc" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Attachments</label>
                                <input type="file" class="form-control" name="files[]" multiple />

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" name="privmsg_subject" placeholder="Subject" value="<?php echo  $priv_msg_subject ?>" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Message</label>
                                <textarea rows="4" name="privmsg_body" class="form-control summernote" placeholder="Enter your message here"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="text-center">
                                    <button class="btn btn-primary" id="btn_feedback_to_lab" type="submit" name="send"><span>Send</span></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    </form>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="colleagues_list" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">+ Doctors</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="ap_relevant_doctors_form" method="post">
                <div class="form tg-formtheme tg-editform">
                    <input name="request_id" type="hidden" value="<?php echo $record_id; ?>">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
<!--                                <label for="ap_relevant_doctors">Reporting Doctor(s)</label>-->
                                <?php
                                $relevant_doctors = array();
                                $relevant_doctors_obj = json_decode($row->ap_relevant_doctors, true);
                                if(!empty($relevant_doctors_obj)){
                                    $relevant_doctors = $relevant_doctors_obj;
                                }
                                //                                            echo '<pre>'; print_r($relevant_doctors_obj); exit;
                                ?>
                                <select name="ap_relevant_doctors[]" id="ap_relevant_doctors" class="form-control select_multiple_imgs" multiple="multiple">
                                    <option value="">Nothing Selected</option>
                                    <?php
                                    if (!empty($list_doctors)) {
                                        foreach ($list_doctors as $value) {
                                            ?>
                                            <option value="<?php echo $value->id; ?>" <?php echo (in_array($value->id,$relevant_doctors)?'selected':''); ?> >
                                                <?php echo $value->first_name . ' ' . $value->last_name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="text-center">
                                    <button class="btn btn-primary btn-rounded" id="btn_update_relevant_doctors" type="submit" name="send"><span>Update</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>

    function calculate_bmi(){
        var ap_height = parseFloat(document.getElementById('ap_height_cm').value);
        var ap_weight = parseFloat(document.getElementById('ap_weight_kg').value);

        ap_height = ap_height || 0;
        ap_weight = ap_weight || 0;

        if(ap_weight>0 && ap_height>0){
            ap_height = ap_height/100;
            ap_height = ap_height*ap_height;
            var ap_height_m_sq = ap_height;
            var ap_bmi = (ap_weight/ap_height_m_sq).toFixed(2);

            document.getElementById('ap_bmi_calculated').value = "";
            document.getElementById('calculated_bmi_span').innerHTML = "";

            document.getElementById('ap_bmi_calculated').value = ap_bmi;
            document.getElementById('calculated_bmi_span').innerHTML = "BMI: "+ap_bmi;
        }else{
            document.getElementById('ap_bmi_calculated').value = "";
            document.getElementById('calculated_bmi_span').innerHTML = "BMI: ";
        }

    }

    function embed_doc(){
        var base_url = '<?php echo base_url(); ?>';
        var files = <?php echo json_encode($files); ?>;
        var total_files = files.length;
        // console.log(files[0]); return false;
        first_file = base_url+'uploads/'+files[0]['file_name'];


        var embed_div = document.getElementById('doc_embed');
        var total_docs_span = document.getElementById('total_docs');
        total_docs_span.innerHTML ="";
        total_docs_span.innerHTML ="Total Uploaded Document(s): "+total_files;

        embed_div.innerHTML="";
        embed_div.innerHTML = "<embed src='"+first_file+"' name='embeded_doc' type='application/pdf' frameborder='0' width='100%' height='400px'>";

        var i = 0;

        function nextItem() {
            i = i + 1; // increase i by one
            i = i % files.length; // if we've gone too high, start from `0` again
            return base_url+'uploads/'+files[i]['file_name'];
            // return files[i]; // give us back the item of where we are now
        }

        function prevItem() {
            if (i === 0) { // i would become 0
                i = files.length; // so put it at the other end of the array
            }
            i = i - 1; // decrease by one
            return base_url+'uploads/'+files[i]['file_name'];
            // return files[i]; // give us back the item of where we are now
        }

        document.getElementById('prev_button').addEventListener(
            'click', // we want to listen for a click
            function (e) { // the e here is the event itself
                var prev_file = prevItem();
                embed_div.innerHTML="";
                embed_div.innerHTML = "<embed src='"+prev_file+"' name='embeded_doc' type='application/pdf' frameborder='0' width='100%' height='400px'>";

            }
        );

        document.getElementById('next_button').addEventListener(
            'click', // we want to listen for a click
            function (e) { // the e here is the event itself
                var next_file = nextItem();
                embed_div.innerHTML="";
                embed_div.innerHTML = "<embed src='"+next_file+"' name='embeded_doc' type='application/pdf' frameborder='0' width='100%' height='400px'>";

            }
        );

    }

</script>