<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    .block-tab li a{font-size: 18px !important}
    /*label {
        font-size: 16px;
        font-weight: 300;
    }*/
    .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control{background: #e7e7e7 !important}
    /*.doctor_update_personal_record label{font-weight: 700 !important}*/
    .input-group {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -ms-flex-align: stretch;
        align-items: stretch;
        width: 100%;
    }
    .np{
    	padding: 0;
    }
    .np-l{
    	padding-left: 0;
    }
    .np-r{
    	padding-right: 0;
    }
    .input-group label {
        font-weight: 600;
    }
    a.form-group-btn.btn.btn-default{display: none;}
    .input-group-text {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding: .375rem .75rem;
        margin-bottom: 0;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        text-align: center;
        white-space: nowrap;
        background-color: #e9ecef;
        border: 1px solid #ced4da;
        border-radius: .25rem;
    }
    .input-group .form-control, .input-group-addon, .input-group-btn {
        display: table-cell;
    }
    .input-group>.custom-file, .input-group>.custom-select, .input-group>.form-control, .input-group>.form-control-plaintext {
        position: relative;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        width: 1%;
        margin-bottom: 0;
    }
</style>
<script src="<?php echo base_url('/assets/subassets/js/jquery-3.2.1.min.js')?>"></script>
<div class="container-fluid">
    <div class="doctor_record_detail_page">
        <?php
        $record_id = $this->uri->segment(3);
        $doc_id = $this->ion_auth->user()->row()->id;
       
        
        if (!empty($record_edit_status)) {
            $user_id = $record_edit_status[0]->user_id_for_edit;
            $edit_timestamp = $record_edit_status[0]->user_record_edit_timestamp;
            /* Get First & Last Name */
            $first_name = '';
            $last_name = '';
            $getdatils = getRecords("AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name,AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name","users",array("id"=>$doc_id));
            //echo last_query();exit;
          /*  if (!empty($this->ion_auth->user($user_id)->row()->first_name)) {
                $first_name = $this->ion_auth->user($user_id)->row()->first_name;
            }
            
            if (!empty($this->ion_auth->user($user_id)->row()->last_name)) {
                $last_name = $this->ion_auth->user($user_id)->row()->last_name;
            }*/

            $edit_full_name = $getdatils[0]->first_name . '&nbsp;' . $getdatils[0]->last_name;
         
        }

        if (!empty($request_query)) {
            $userid = $request_query[0]->request_add_user;
            $record_add_timestamp = $request_query[0]->request_add_user_timestamp;
            $first_name = '';
            $last_name = '';
            $getuserdetails = getRecords("AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name,AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name","users",array("id"=>$userid));
           /* if (!empty($this->ion_auth->user($userid)->row()->first_name)) {
                $first_name = $this->ion_auth->user($userid)->row()->first_name;
            }
            if (!empty($this->ion_auth->user($userid)->row()->last_name)) {
                $last_name = $this->ion_auth->user($userid)->row()->last_name;
            }*/
            $add_full_name = $getuserdetails[0]->first_name . '&nbsp;' . $getuserdetails[0]->last_name;
        }

        $micro_codes_data = array();
        if (!empty($micro_codes)) {
            foreach ($micro_codes as $mi_codes) {
                $micro_codes_data[] = $mi_codes;
            }
        }

        if (!empty($user_id) && $edit_timestamp) {
            ?>
            <div class="user_edit_status">Record Last Edited By : <?php echo $edit_full_name; ?>, At : <?php echo date('d-m-Y h:i:s A', $edit_timestamp); ?>
                <span><a href="javascript:;" data-toggle="modal" data-target="#edit_record_history">View History</a></span>
            </div>
        <?php } ?>
        <?php
        if (!empty($userid) && $record_add_timestamp) {
            ?>
            <div class="user_add_report_status">Record Added By : <?php echo $add_full_name; ?>, At : <?php echo date('d-m-Y h:i:s A', $record_add_timestamp); ?></div>
        <?php } ?>

        <div class="row">
            <div class="sidebar second-sidebar ">
                <ul>
                    <li>
                        <a class="btn btn-light btn-round" href="#">DW</a>
                    </li>
                    <li>
                        <a class="btn btn-light btn-round" href="#">JS</a>
                    </li>
                    <li class="active">
                        <a class="btn btn-light btn-round" href="#">JS</a>
                    </li>
                    <li>
                        <a class="btn btn-light btn-round" href="#">JS</a>
                    </li>
                    <li>
                        <a class="btn btn-light btn-round" href="#">JS</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="row">
            <div class="col-lg-3 col-xxl-2">
                
            </div>
            <div class="col-xs-12" style="padding-left: 55px;">
                <?php
                if ($this->session->flashdata('specimen_added') != '') {
                    echo $this->session->flashdata('specimen_added');
                }
                ?>
                <div class="tg-breadcrumbarea tg-searchrecordhold">
                    <?php echo !empty($breadcrumbs) ? $breadcrumbs : ''; ?>
                    <div class="tg-rightarea tg-rightsearchrecord">
                        <div class="tg-searchrecordslide">

                            <?php get_next_previous_records($unpublish_list, $record_id, true, 'prev'); ?>
                            <form class="tg-formtheme tg-searchrecord">
                                <fieldset>
                                    <div class="form-group tg-inputicon">
                                        <input type="text" class="form-control typeahead" placeholder="Search Record">
                                        <i class="lnr lnr-magnifier"></i>
                                    </div>
                                </fieldset>
                            </form>
                            <?php get_next_previous_records($unpublish_list, $record_id, true, 'next'); ?>

                        </div>
                        <div class="tg-flagcolor tg-flagcolortopbar">
                            <div class="tg-checkboxgroup">
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
                        <figure class="tg-logobar">
                            <?php if (!empty($request_query)) { ?>
                                <span class="tg-namelogo" data-toggle="tooltip" data-placement="top" title="<?php echo $this->ion_auth->group($request_query[0]->hospital_group_id)->row()->description; ?>"><?php echo $this->ion_auth->group($request_query[0]->hospital_group_id)->row()->first_initial . $this->ion_auth->group($request_query[0]->hospital_group_id)->row()->last_initial; ?></span>
                            <?php } ?>
                        </figure>
                    </div>
                </div>



        <div class="tg-haslayout">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <div class="slide-container">
                    <div class="slide-container-inner" style="margin-left: 25px;">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search">
                            <div class="input-group-append">
                               <button type="button" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                </button>
                                
                            </div>
                        </div>

                        <?php foreach ($slide_data as $index => $specimen_slide) {?>
                        <div class="slide-image-container" style="<?php if($index != 0) echo 'display: none;'?>" id="slide-image-container-<?php echo $specimen_slide['specimen_id']?>">
                        <?php foreach($specimen_slide['slides'] as $index => $slide) {?>
                            <div class="card" onclick="viewRecord('<?php echo($specimen_slide['specimen_id'].'_'.$index); ?>');">
                                    <span class="title"><?php echo $slide['slide_name']; ?></span>
                                    <img class="img-responsive" src="<?php echo $slide['thumbnail']?>" />   
                                    <span class="badge badge-pill bg-white color-green">
                                        <i class="fa fa-check"></i>
                                    </span>                       
                                </div>   

                        <?php }?>      
                        </div>
                        <?php }?>
                       
                    </div>
                    
                </div>
                </div>

                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <?php
                    if ($this->session->flashdata('update_report_message') != '') {
                        echo $this->session->flashdata('update_report_message');
                    }
                    ?>
                    <?php
                    if ($this->session->flashdata('update_specimen_message') != '') {
                        echo $this->session->flashdata('update_specimen_message');
                    }
                    ?>
                    <?php
                    if ($this->session->flashdata('final_report_message') != '') {
                        echo $this->session->flashdata('final_report_message');
                    }
                    ?>
                    <?php
                    if ($this->session->flashdata('message_additional') != '') {
                        ?>
                        <p class="bg-success" style="padding:7px;"> <?php echo $this->session->flashdata('message_additional'); ?></p>
                    <?php } ?>
                    <?php
                    if ($this->session->flashdata('message_further') != '') {
                        echo $this->session->flashdata('message_further');
                    }
                    if ($this->session->flashdata('message_email_send') != '') {
                        echo $this->session->flashdata('message_email_send');
                    }
                    if ($this->session->flashdata('message_email_not_sent') != '') {
                        echo $this->session->flashdata('message_email_not_sent');
                    }
                    ?>
                    <form class="" id="doctor_update_personal_record" method="post">
                        <?php
                        $json = array();
                        
                        if (!empty($request_query) && is_array($request_query)) {
                            foreach ($request_query as $row) {
                                $record_edit_serial = $row->record_edit_status;
                                $redit_status = unserialize($record_edit_serial);
                                ?>
                                <fieldset>
                                    <div class="col-md-3 form-group">
                                        <span class="tg-namelogo"><?php echo uralensis_get_user_data($row->uralensis_request_id, 'initial'); ?></span>
                                        <div class="tg-nameandtrack">
                                            <h3><?php echo uralensis_get_user_data($row->uralensis_request_id, 'fullname'); ?></h3>
                                            <span><?php echo uralensis_get_record_db_detail($row->uralensis_request_id, 'serial_number'); ?>
                                                <em>|</em>
                                                <em><?php echo uralensis_get_record_db_detail($row->uralensis_request_id, 'ura_barcode_no'); ?></em>
                                            </span>
                                        </div>
                                        <figure class="tg-nameandtrackimg">
                                            <img src="<?php echo uralensis_get_user_data($row->uralensis_request_id, 'gender'); ?>">
                                            <span><?php echo uralensis_get_user_data($row->uralensis_request_id, 'age'); ?></span>
                                        </figure>
                                    </div>
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['patient_initial']) && $redit_status['patient_initial'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['patient_initial']) && $redit_status['patient_initial'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="col-md-3 form-group  <?php echo $color_status; ?>" data-key="patient_initial">
                                        <label class="change_status_color" for="patient_initial">Initial</label>
                                        <input id="patient_initial" type="text" name="patient_initial" class="form-control" placeholder="Patient Initial" value="<?php echo $row->patient_initial; ?>">
                                        <?php $json['patient_initial'] = $row->patient_initial; ?>
                                    </div>

                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['first_name']) && $redit_status['first_name'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['first_name']) && $redit_status['first_name'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="col-md-3 form-group <?php echo $color_status; ?>" data-key="first_name">
                                        <label class="change_status_color" for="first_name">First Name</label>
                                        <input id="first_name" type="text" name="f_name" class="form-control" placeholder="First Name" value="<?php echo $row->f_name; ?>">
                                        <?php $json['f_name'] = $row->f_name; ?>
                                    </div>
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['sur_name']) && $redit_status['sur_name'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['sur_name']) && $redit_status['sur_name'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="col-md-3 form-group <?php echo $color_status; ?>" data-key="sur_name">
                                        <label class="change_status_color" for="sur_name">Surname</label>
                                        <input id="sur_name" type="text" name="sur_name" class="form-control" placeholder="Surname" value="<?php echo $row->sur_name; ?>">
                                        <?php $json['f_name'] = $row->f_name; ?>
                                    </div>
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['gender']) && $redit_status['gender'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['gender']) && $redit_status['gender'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="col-md-3 form-group <?php echo $color_status; ?>" data-key="gender">
                                        <label class="change_status_color" for="gender">Gender</label>
                                        <select class="form-control" name="gender" id="gender" disabled>
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
                                                <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $gender; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php $json['gender'] = $row->gender; ?>
                                    </div>
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['dob']) && $redit_status['dob'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['dob']) && $redit_status['dob'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="col-md-3 form-group  <?php echo $color_status; ?>" data-key="dob">
                                        <label class="change_status_color" for="dob">DOB</label>
                                        <input type="text" name="dob" id="dob" class="form-control" placeholder="Date of Birth" value="<?php echo!empty($row->dob) ? date('d-m-Y', strtotime($row->dob)) : ''; ?>" />
                                        <?php $json['dob'] = date('d-m-Y', strtotime($row->dob)); ?>
                                    </div>
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['lab_number']) && $redit_status['lab_number'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['lab_number']) && $redit_status['lab_number'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="col-md-3 form-group <?php echo $color_status; ?>" data-key="lab_number">
                                        <label class="change_status_color" for="lab_number">Lab No</label>
                                        <input id="lab_number" type="text" name="lab_number" class="form-control" placeholder="Lab Number" value="<?php echo $row->lab_number; ?>">
                                        <?php $json['lab_number'] = $row->lab_number; ?>
                                    </div>
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['pci_number']) && $redit_status['pci_number'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['pci_number']) && $redit_status['pci_number'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="col-md-3 form-group <?php echo $color_status; ?>" data-key="pci_number">
                                        <label class="change_status_color" for="pci_number">PCI NO</label>
                                        <input type="text" id="pci_no" class="form-control" name="pci_number" placeholder="PCI Number" value="<?php echo $row->pci_number; ?>">
                                        <?php $json['pci_number'] = $row->pci_number; ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['clrk']) && $redit_status['clrk'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['clrk']) && $redit_status['clrk'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="col-md-3 form-group  <?php echo $color_status; ?>" data-key="clrk">
                                        <label class="change_status_color" for="clrk">CLRW</label>
                                        <select class="form-control" readonly name="clrk" id="clrk">
                                            <option value="">Choose Clinician</option>
                                            <?php echo  $this->Doctor_model->get_clinician_and_derm($row->hospital_group_id, 'clinician', $row->clrk); ?>
                                        </select>
                                        <?php $json['clrk'] = $row->clrk; ?>
                                    </div>
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['date_taken']) && $redit_status['date_taken'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['date_taken']) && $redit_status['date_taken'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="col-md-3 form-group <?php echo $color_status; ?>" data-key="date_taken">
                                        <?php
                                        $date_taken = '';
                                        if (!empty($row->date_taken)) {
                                            $date_taken = date('d-m-Y', strtotime($row->date_taken));
                                        }
                                        ?>
                                        <label class="change_status_color" for="date_taken">Date Taken</label>
                                        <input class="form-control" type="text" name="date_taken" id="datetaken_doctor" placeholder="Date Taken" value="<?php echo $date_taken; ?>" />
                                        <?php $json['date_taken'] = date('d-m-Y', strtotime($row->date_taken)); ?>
                                    </div>
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['date_received_bylab']) && $redit_status['date_received_bylab'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['date_received_bylab']) && $redit_status['date_received_bylab'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="col-md-3 form-group <?php echo $color_status; ?>" data-key="date_received_bylab">
                                        <?php
                                        $rec_by_lab_date = '';
                                        if (!empty($row->date_received_bylab)) {
                                            $rec_by_lab_date = date('d-m-Y', strtotime($row->date_received_bylab));
                                        }
                                        ?>
                                        <label class="change_status_color" for="date_received_bylab">REC LAB</label>
                                        <input  class="form-control" type="text" name="date_received_bylab" id="date_received_bylab" placeholder="Lab Receiving Date" value="<?php echo $rec_by_lab_date; ?>" />
                                        <?php $json['date_received_bylab'] = date('d-m-Y', strtotime($row->date_received_bylab)); ?>
                                    </div>
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['date_sent_touralensis']) && $redit_status['date_sent_touralensis'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['date_sent_touralensis']) && $redit_status['date_sent_touralensis'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="col-md-3 form-group <?php echo $color_status; ?>" data-key="date_sent_touralensis">
                                        <?php
                                        $sent_to_uralensis_date = '';
                                        if (!empty($row->date_sent_touralensis)) {
                                            $sent_to_uralensis_date = date('d-m-Y', strtotime($row->date_sent_touralensis));
                                        } else {
                                            if (!empty($bck_frm_lab_date_data)) {
                                                $sent_to_uralensis_date = date('d-m-Y', strtotime($bck_frm_lab_date_data));
                                            }
                                        }
                                        ?>
                                        <label class="change_status_color" for="date_sent_touralensis">REL LAB</label>
                                        <input type="text" name="date_sent_touralensis" class="form-control" id="date_sent_touralensis" placeholder="Uralensis Sent Date" value="<?php echo $sent_to_uralensis_date; ?>" />
                                        <?php $json['date_sent_touralensis'] = date('d-m-Y', strtotime($sent_to_uralensis_date)); ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['rec_by_doc_date']) && $redit_status['rec_by_doc_date'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['rec_by_doc_date']) && $redit_status['rec_by_doc_date'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="col-md-3 form-group <?php echo $color_status; ?>" data-key="rec_by_doc_date">

                                        <?php
                                        $rec_by_doc_date = '';
                                        if (!empty($row->date_rec_by_doctor)) {
                                            $rec_by_doc_date = date('d-m-Y', strtotime($row->date_rec_by_doctor));
                                        } else {
                                            if (!empty($rec_by_doc_date_data)) {
                                                $rec_by_doc_date = date('d-m-Y', strtotime($rec_by_doc_date_data));
                                            }
                                        }
                                        ?>
                                        <label class="change_status_color" for="rec_by_doc_date">Rec by Doc</label>
                                        <input type="text" name="rec_by_doc_date" class="form-control" id="rec_by_doc_date" placeholder="Received by doctor date" value="<?php echo $rec_by_doc_date; ?>" />
                                        <?php $json['rec_by_doc_date'] = date('d-m-Y', strtotime($rec_by_doc_date)); ?>
                                    </div>
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['nhs_number']) && $redit_status['nhs_number'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['nhs_number']) && $redit_status['nhs_number'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="col-md-3 form-group <?php echo $color_status; ?>" data-key="nhs_number">
                                        <label class="change_status_color" for="nhs_number">Nhs NO</label>
                                        <input type="text" class="form-control" id="nhs_number" name="nhs_number" placeholder="Nhs Number" value="<?php echo $row->nhs_number; ?>">
                                        <?php $json['nhs_number'] = $row->nhs_number; ?>
                                    </div>
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['emis_number']) && $redit_status['emis_number'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['emis_number']) && $redit_status['emis_number'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="col-md-3 form-group <?php echo $color_status; ?>" data-key="emis_number">
                                        <label class="change_status_color" for="emis_number">Emis No</label>
                                        <input id="emis_number" type="text" name="emis_number" class="form-control" placeholder="Emis Number" value="<?php echo $row->emis_number; ?>">
                                        <?php $json['emis_number'] = $row->emis_number; ?>
                                    </div>
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['report_urgency']) && $redit_status['report_urgency'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['report_urgency']) && $redit_status['report_urgency'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="col-md-3 form-group  <?php echo $color_status; ?>" data-key="report_urgency">
                                        <label class="change_status_color" for="report_urgency">Status</label>
                                        <select name="report_urgency" class="form-control " id="report_urgency" disabled>
                                            <?php
                                            $report_urgency = array(
                                                'Routine' => 'Routine',
                                                'Urgent' => 'Urgent',
                                                '2WW' => '2WW'
                                            );

                                            foreach ($report_urgency as $key => $urgency) {
                                                $selected = '';
                                                if ($key == $row->report_urgency) {
                                                    $selected = 'selected';
                                                }
                                                ?>
                                                <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $urgency; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php $json['report_urgency'] = $row->report_urgency; ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['cases_category']) && $redit_status['cases_category'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['cases_category']) && $redit_status['cases_category'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="col-md-3 form-group <?php echo $color_status; ?>" data-key="cases_category">
                                        <label class="change_status_color" for="cases_category">Case Category</label>
                                        <select name="cases_category" id="cases_category" class="form-control" disabled>
                                            <option value="0">Choose Category</option>
                                            <?php
                                            $cases_category = array(
                                                'Routine' => 'Routine',
                                                'Alopecia' => 'Alopecia',
                                                'IMF' => 'IMF',
                                                'Review' => 'Review'
                                            );

                                            foreach ($cases_category as $key => $category) {
                                                $selected = '';
                                                if ($key == $row->cases_category) {

                                                    $selected = 'selected';
                                                }
                                                ?>
                                                <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $category; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php $json['cases_category'] = $row->cases_category; ?>
                                    </div>
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['dermatological_surgeon']) && $redit_status['dermatological_surgeon'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['dermatological_surgeon']) && $redit_status['dermatological_surgeon'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>

                                    <div class="col-md-3 form-group <?php echo $color_status; ?>" data-key="dermatological_surgeon">
                                        <label class="change_status_color" for="dermatological_surgeon">Surgeon</label>
                                        <select readonly name="dermatological_surgeon" id="dermatological_surgeon" class="form-control">
                                            <option value="">Choose Dermatological Surgeon</option>
                                            <?php echo $this->Doctor_model->get_clinician_and_derm($row->hospital_group_id, 'dermatological', $row->dermatological_surgeon); ?>
                                        </select>
                                        <?php $json['dermatological_surgeon'] = $row->dermatological_surgeon; ?>
                                    </div>

                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['lab_name']) && $redit_status['lab_name'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['lab_name']) && $redit_status['lab_name'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="col-md-3 form-group <?php echo $color_status; ?>" data-key="lab_name" >
                                        <label class="change_status_color" for="lab_name">Lab Name</label>
     