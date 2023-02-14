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
                                        <?php $json['lab_name'] = $row->lab_name; ?>
                                        <select class="form-control lab_name" id="lab_name" name="lab_name" disabled>
                                            <option value="0">Choose Lab Name</option>
                                            <?php
                                            $get_lab_names = $this->Doctor_model->getLabNamesFromLabGroups();

                                            if (!empty($get_lab_names) && is_array($get_lab_names)) :
                                                foreach ($get_lab_names as $lab_key => $lab_val) {
                                                    $selected = '';
                                                    if ($lab_val['name'] == $row->lab_name) {
                                                        $selected = 'selected';
                                                    }
                                                    echo '<option data-labnameid="' . $lab_val['id'] . '" ' . $selected . ' value="' . $lab_val['name'] . '">' . ucwords($lab_val['description']) . '</option>';
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
                                    
                                    <div class="col-md-3 form-group">
                                        <?php uralensis_get_cost_code_dropdown($row->hospital_group_id, $row); ?>
                                    </div>
                                </fieldset>
                                <fieldset>




                                    <?php
                                    if (!empty($row->cl_detail)) {
                                        ?>

                                        <div class="form-group" style="width:100%;">
                                            <textarea style="height:100px;" class="form-control"  required name="cl_detail" id="cl_detail" placeholder="Clinical Detail"><?php echo $row->cl_detail; ?></textarea>
                                        </div>
                                    <?php } ?>
                                    <?php if (!empty($row->mdt_case_status) && $row->mdt_case_status === 'for_mdt') { ?>
                                    <div class="form-group" style="width:100%;">
                                        <textarea style="height:100px;" class="form-control" name="mdt_outcome_text" id="mdt_outcome_text" placeholder="MDT Outcome"><?php echo $row->mdt_outcome_text; ?></textarea>
                                    </div>
                                    <?php } ?>
                                </fieldset>
                                <?php
                            }//endforeach
                        }//endif 
                        ?>
                        <?php $json_data = json_encode($json); ?>
                        <input type="hidden" name="json_edit_data" value='<?php echo $json_data; ?>'>
                        <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                    </form>
                </div>

                
            </div>
        </div>
    </div>
    <div class="col-md-12" style="padding-left: 60px">

        <div class="tg-haslayout uralensis_icons_actions">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="tg-themedetailsicon">
                            <li>
                                <a href="javascript:;" class="tg-detailsicon collapse-related-docs"><span class="tg-notificationtag"><?php echo count($files); ?></span><i data-toggle="tooltip" data-placement="top" title="Related Documents" class="ti-link"></i></a>
                                <?php if ($request_query[0]->specimen_update_status == 1) { ?>
                                    <a href="javascript:;" class="tg-detailsicon" id="show_pdf_iframe"><i data-toggle="tooltip" data-placement="top" title="View Report" class="ti-search"></i></a>
                                <?php } ?>
                                <?php if ($request_query[0]->specimen_publish_status == 1) { ?>
                                    <a href="<?php echo site_url() . '/doctor/generate_report/' . $request_query[0]->uralensis_request_id; ?>" target="_blank" class="tg-detailsicon" id="show_pdf_iframe"><i data-toggle="tooltip" data-placement="top" title="View Final PDF" class="ti-notepad"></i></a>
                                <?php } ?>
                                <a href="javascript:;" class="tg-detailsicon" id="further_work_add"><i data-toggle="tooltip" data-placement="top" title="Add Further Work" class="ti-target"></i></a>
                                <a href="javascript:;" class="tg-detailsicon" data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>" id="add_to_authorization"><i data-toggle="tooltip" data-placement="top" title="Add to Queue" class="ti-layers"></i></a>
                                <a href="javascript:;" class="tg-detailsicon" data-toggle="modal" data-target="#mdt_data_modal"><i data-toggle="tooltip" data-placement="top" title="MDT" class="ti-archive"></i></a>
                            </li>
                            <li>
                                <a href="javascript:;" class="tg-detailsicon request_for_opinion"><i data-toggle="tooltip" data-placement="top" title="Request for opinion" class="ti-pulse"></i></a>
                                <a href="javascript:;" class="tg-detailsicon" data-toggle="modal" data-target="#assign_doctor_modal"><i data-toggle="tooltip" data-placement="top" title="Assign to other doctor" class="ti-support"></i></a>
                                <a href="javascript:;" class="tg-detailsicon" data-toggle="modal" data-target="#teaching_cpc_modal"><i data-toggle="tooltip" data-placement="top" title="Assign as teaching and cpc" class="ti-bell"></i></a>
                                <?php if ($request_query[0]->specimen_publish_status == 1) { ?>
                                    <a href="javascript:;" class="tg-detailsicon" data-toggle="modal" data-target="#add_supplementary"><i data-toggle="tooltip" data-placement="top" title="Add Supplementarty Report" class="ti-plus"></i></a>
                                <?php } ?>
                                <?php if ($request_query[0]->additional_data_state === 'in_session') { ?>
                                    <a href="javascript:;" id="publish_supplementary_btn" data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>" class="tg-detailsicon"><i data-toggle="tooltip" data-placement="top" title="Publish Supplementarty Report" class="ti-check-box"></i></a>
                                <?php } ?>
                                <a href="javascript:;" class="tg-detailsicon" data-toggle="modal" data-target="#manage_supple"><i data-toggle="tooltip" data-placement="top" title="Manage Supplementary" class="ti-wallet"></i></a>
                            </li>
                            <li>
                                <a href="javascript:;" class="tg-detailsicon" data-toggle="collapse" data-target="#relateddocs"><i class="ti-upload" data-toggle="tooltip" data-placement="top" title="Uploaded Documents"></i></a>
                                <a href="javascript:;" class="tg-detailsicon" data-toggle="modal" data-target="#record_download_history"><i data-toggle="tooltip" data-placement="top" title="Report Download History" class="ti-clipboard"></i></a>
                                <a href="javascript:;" class="tg-detailsicon" data-toggle="modal" data-target="#rec_history_modal"><i class="ti-folder" data-toggle="tooltip" data-placement="top" title="Record History"></i></a>
                                <a href="javascript:;" class="tg-detailsicon" data-toggle="collapse" data-target="#relatedrecordscollapse"><i class="ti-harddrives" data-toggle="tooltip" data-placement="top" title="Related Records"></i></a>
                                <a href="javascript:;" class="tg-detailsicon" data-toggle="collapse" data-target="#datasets"><i class="ti-harddrive" data-toggle="tooltip" data-placement="top" title="Datasets"></i></a>
                            </li>
                            <li class="tg-reloadoption">
                                <a href="javascript:;" id="make_editable" class="tg-detailsicon disable tg-themeiconcolorone"><i class="ti-power-off" data-toggle="tooltip" data-placement="top" title="Enable/Disable Fields"></i></a>
                                <?php
                                $button_disable = '';
                                if (!empty($opinion_data[0]->ura_opinion_req_id) && $record_id == $opinion_data[0]->ura_opinion_req_id) {
                                    $button_disable = 'disabled';
                                }
                                ?>
                                <a href="javascript:;" <?php echo $button_disable; ?> class="tg-detailsicon tg-themeiconcolortwo update_doctor_personal_report_btn" id="update_doctor_personal_report_btn"><i class="ti-reload"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>

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
                        <div id="relateddocs" class="collapse">
                            <h3>Related Documents</h3>
                            <div class="well">
                                <form method="post" class="form-inline" enctype="multipart/form-data" action="<?php echo base_url('index.php/doctor/do_upload/' . $record_id); ?>">
                                    <div class="form-group">
                                        <input required id="upload_user_file" class="form-control" type="file" name="userfile" />
                                    </div>
                                    <button type="submit" class="btn btn-default">Upload</button>
                                </form>
                                <div id="files">
                                    <table class="table table-striped">
                                        <h3>Files</h3>
                                        <tr class="bg-info">
                                            <th>File Name</th>
                                            <th>Type</th>
                                            <th>File Ext</th>
                                            <th>View File</th>
                                            <th>Download File</th>
                                            <th>Delete</th>
                                            <th>Uploaded by</th>
                                            <th>Upload On</th>
                                        </tr>
                                        <?php
                                        if (isset($files) && is_array($files)) {
                                            $doctor_id = $this->ion_auth->user()->row()->id;
                                            $record_id = $this->uri->segment(3);
                                            foreach ($files as $file) {
                                                $file_id = $file->files_id;
                                                $file_path = $file->file_path;
                                                $session_data = array(
                                                    'file_path' => $file_path
                                                );
                                                $file_ext = ltrim($file->file_ext, ".");
                                                $modify_ext = strtolower($file_ext);
                                                $this->session->set_userdata($session_data);
                                                ?>
                                                <tr>
                                                    <td><?php echo $file->title; ?></td>
                                                    <td><?php
                                                        if ($file->is_image == 1) {
                                                            echo '<img src="' . base_url('assets/img/image_type.png') . '" />';
                                                        } else {
                                                            echo '<img src="' . base_url('assets/img/doc_type.png') . '" />';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $file->file_ext; ?></td>
                                                    <td>
                                                        <a data-exttype="<?php echo $modify_ext; ?>"  data-imageurl="<?php echo base_url() . 'uploads/' . $file->file_name; ?>" href="<?php echo base_url() . 'uploads/' . $file->file_name; ?>" target="_blank">
                                                            <img src="<?php echo base_url('assets/img/view.png'); ?>" />
                                                            <?php echo ucfirst($file->title); ?>
                                                        </a>
                                                        <?php if ($modify_ext === 'png' || $modify_ext === 'jpg') { ?>
                                                            <div style="display:none;" class="hover_image_frame hover_<?php echo $modify_ext; ?>" >
                                                                <img src="<?php echo base_url() . 'uploads/' . $file->file_name; ?>">
                                                                <hr>
                                                                <button class="btn btn-warning" id="close_hover_image">Close</button>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($modify_ext === 'pdf' || $modify_ext === 'txt') { ?>
                                                            <div style="display:none;" class="hover_image_frame hover_<?php echo $modify_ext; ?>" >
                                                                <iframe width="700" height="500"  src="<?php echo base_url() . 'uploads/' . $file->file_name; ?>"></iframe>
                                                                <hr>
                                                                <button class="btn btn-warning" id="close_hover_image">Close</button>
                                                            </div>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <a download href="<?php echo base_url() . 'uploads/' . $file->file_name; ?>" target="_blank">
                                                            <img src="<?php echo base_url('assets/img/download.png'); ?>" />
                                                            <?php echo ucfirst($file->title); ?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php if ($doctor_id == $file->user_id) : ?>
                                                            <a href="<?php echo site_url() . '/doctor/delete_record_files?file_id=' . $file_id . '&record_id=' . $record_id; ?>">
                                                                <img src="<?php echo base_url('assets/img/delete.png'); ?>" />
                                                            </a>
                                                        <?php else : ?>
                                                            <span>No Access</span>
                                                        <?php endif; ?>

                                                    </td>
                                                    <td><?php echo ucwords($file->user); ?></td>
                                                    <td><?php
                                                        $time = $file->upload_date;
                                                        echo date('M j Y g:i A', strtotime($time));
                                                        ?></td>
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
                                                <input type="hidden" name="<?php echo $codes->ura_cost_code_type; ?>" value="<?php echo $fw_levels; ?>">

                                                <label for="report_check_<?php echo $check_count; ?>"><?php echo $codes->ura_cost_code_desc; ?></label>
                                                <input id="report_check_<?php echo $check_count; ?>" <?php echo $selected; ?> name="<?php echo $codes->ura_cost_code_type; ?>" type="checkbox" value="<?php echo $codes->ura_cost_code_type; ?>">
                                                <?php
                                                $check_count++;
                                            }//endforeach
                                        }//endif
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Further Work Date</label>
                                        <input type="text" value="" readonly class="form-control" name="furtherwork_date"  id="furtherwork_date" placeholder="Further Work Date">
                                        <input type="hidden" value="" name="furtherwork_date"  id="further_work_date_hide">
                                    </div>
                                    <div class="form-group">
                                        <label for="further_work">Further Work:</label>
                                        <textarea class="form-control" rows="5" id="further_work" name="description"></textarea>
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
                <div id="display_iframe_pdf" class="modal fade display_iframe_pdf" role="dialog" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <object type="application/pdf" data="<?php echo site_url() . '/doctor/view_report/' . $record_id; ?>" width="100%" style="height: 80vh;">No Support</object>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                                <?php if ($request_query[0]->specimen_update_status == 1 && $request_query[0]->specimen_publish_status == 0) { ?>
                                    <a class="pull-left" style="cursor: pointer;" data-toggle="modal" data-target="#user_auth_popup">
                                        <img data-toggle="tooltip" data-placement="top" title="Click To Publish This Report" src="<?php echo base_url('assets/img/pdf.png'); ?>">
                                    </a>
                                <?php } else { ?>
                                    <p class="label label-success pull-left" style="font-size:16px;">Report Already Has Been Published!</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($request_query[0]->specimen_update_status == 1 && $request_query[0]->specimen_publish_status == 0) { ?>
                    <div id="user_auth_popup" class="modal fade user_auth_popup" role="dialog" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Publish Report</h4>
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
                                            <p><strong>* </strong><em>Insert Surname from Request Form as final ID check.</em></p>
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
                                                <input type="hidden" name="surname_data" value='<?php echo count($dom_array) - 1; ?>'>
                                            </div>
                                            <div class="ura-pin-area">
                                                <div class="form-group ura-password-fields">
                                                    <p>Enter Your Pin To Publish This Report.</p>
                                                    <input autofocus maxlength="1" type="password" id="auth_pass1" name="auth_pass1">
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
                                                <div class="form-group"><button type="button" id="check_pass" class="btn btn-warning pull-right">Submit</button></div>
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
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Opinion Request</h4>
                            </div>
                            <div class="modal-body">
                                <?php $rec_id = $this->uri->segment(3); ?>
                                <form class="form opinion_cases_form">
                                    <div class="form-group">
                                        <label for="opinion_case_doctors">Choose Doctors</label>
                                        <select multiple class="form-control" style="padding:2px;" name="opinion_case_doctors[]" id="opinion_case_doctors">
                                            <?php
                                            if (!empty($list_doctors)) {
                                                foreach ($list_doctors as $value) {
                                                    ?>
                                                    <option value="<?php echo $value->id; ?>"><?php echo $value->first_name . ' ' . $value->last_name; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Opinion Request Date</label>
                                        <input type="text" value="" readonly class="form-control" name="opinion_date"  id="opinion_date" placeholder="Opinion Request Date">
                                        <input type="hidden" value="" name="opinion_date"  id="opinion_date_hide">
                                    </div>
                                    <div class="form-group">
                                        <label for="opinion_comment">Opinion Comment</label>
                                        <textarea id="opinion_comment" name="opinion_comment" class="form-control"></textarea>
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
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Assign to other doctor</h4>
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
                                                    <option value="<?php echo $value->id; ?>"><?php echo $value->first_name . ' ' . $value->last_name; ?></option>
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
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Education and CPC</h4>
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
                                        <input type="hidden" name="record_id" id="record_id" value="<?php echo $record_id; ?>">
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
                <div class="related-doc-collapse-section collapse">
                    <div class="well">
                        <table class="table table-striped">
                            <h3>Files</h3>
                            <tr class="bg-info">
                                <th>File Name</th>
                                <th>Type</th>
                                <th>File Ext</th>
                                <th>View File</th>
                                <th>Download File</th>
                                <th>Uploaded by</th>
                                <th>Upload On</th>
                            </tr>
                            <?php
                            if (isset($files) && is_array($files)) {
                                $doctor_id = $this->ion_auth->user()->row()->id;
                                $record_id = $this->uri->segment(3);
                                foreach ($files as $file) {
                                    $file_id = $file->files_id;
                                    $file_path = $file->file_path;
                                    $session_data = array(
                                        'file_path' => $file_path
                                    );
                                    $file_ext = ltrim($file->file_ext, ".");
                                    $modify_ext = strtolower($file_ext);
                                    $this->session->set_userdata($session_data);
                                    ?>
                                    <tr>
                                        <td><?php echo $file->title; ?></td>
                                        <td><?php
                                            if ($file->is_image == 1) {
                                                echo '<img src="' . base_url('assets/img/image_type.png') . '" />';
                                            } else {
                                                echo '<img src="' . base_url('assets/img/doc_type.png') . '" />';
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $file->file_ext; ?></td>
                                        <td>
                                            <a class="hover_image" data-exttype="<?php echo $modify_ext; ?>"  data-imageurl="<?php echo base_url() . 'uploads/' . $file->file_name; ?>" href="<?php echo base_url() . 'uploads/' . $file->file_name; ?>" target="_blank">
                                                <img src="<?php echo base_url('assets/img/view.png'); ?>" />
                                                <?php echo ucfirst($file->title); ?>
                                            </a>
                                            <?php if ($modify_ext === 'png' || $modify_ext === 'jpg') { ?>
                                                <div style="display:none;" class="hover_image_frame hover_<?php echo $modify_ext; ?>" >
                                                    <img src="<?php echo base_url() . 'uploads/' . $file->file_name; ?>">
                                                    <hr>
                                                    <button class="btn btn-warning" id="close_hover_image">Close</button>
                                                </div>
                                            <?php } ?>
                                            <?php if ($modify_ext === 'pdf' || $modify_ext === 'txt') { ?>
                                                <div style="display:none;" class="hover_image_frame hover_<?php echo $modify_ext; ?>" >
                                                    <iframe width="700" height="500"  src="<?php echo base_url() . 'uploads/' . $file->file_name; ?>"></iframe>
                                                    <hr>
                                                    <button class="btn btn-warning" id="close_hover_image">Close</button>
                                                </div>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a download href="<?php echo base_url() . 'uploads/' . $file->file_name; ?>" target="_blank">
                                                <img src="<?php echo base_url('assets/img/download.png'); ?>" />
                                                <?php echo ucfirst($file->title); ?>
                                            </a>
                                        </td>
                                       
                                        <td><?php echo ucwords($file->user); ?></td>
                                        <td><?php
                                            $time = $file->upload_date;
                                            echo date('M j Y g:i A', strtotime($time));
                                            ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <div id="mdt_data_modal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content" style="float:left;width:100%;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">MDT Assigning</h4>
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
                                        <button class="btn btn-warning pull-right" id="leave_mdt_notes_msg_btn">Leave this.</button>
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
                                <form method="post" action="<?php echo site_url('doctor/additional_work'); ?>">
                                    <div class="form-group">
                                        <label for="additional_work">Add Supplementary Report:</label>
                                        <textarea class="form-control" rows="5" id="additional_work" name="additional_description"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php show_supplementary_modal($record_id, $supplementary_query); ?> 
        </div>

        <div class="tg-haslayout">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?php
                    if (empty($opinion_data)) {
                        $opinion_data = array();
                    }

                    $hospital_id = $request_query[0]->hospital_group_id;
                    $get_cost_codes['cost_codes'] = $this->Doctor_model->get_cost_codes_by_block($hospital_id);

                    get_specimens($specimen_query, $request_query, $request_query[0]->uralensis_request_id, $get_cost_codes['cost_codes'], $opinion_data, $specimen_accepted_by, $specimen_assisted_by, $specimen_block_checked_by, $specimen_cutup_by, $specimen_labeled_by, $specimen_qcd_by);
                    
                    ?>


                </div>

            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <?php
                if (empty($opinion_data)) {
                    $opinion_data = array();
                }
                if (!empty($request_query[0]->comment_section)) {
                    comment_section($record_id, $request_query, $opinion_data);
                }
                ?> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <?php
                if (empty($opinion_data)) {
                    $opinion_data = array();
                }

                if (!empty($request_query[0]->special_notes)) {
                    if (class_exists('Notes')) {
                        Notes::special_notes($record_id, $request_query, $opinion_data);
                    }
                }
                ?> 
            </div>
        </div>
        <div class="row">
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
        </div>

        <div>
			<script>
	            var micro_data = <?php echo json_encode($micro_codes_data); ?>;
	        </script>
        </div>

        
    </div>
</div>



<div id="edit_record_history" class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">View Record Details</h4>
        </div>
        <div class="modal-body">
            <?php
                if (!empty($record_edit_status_full)) {
                    foreach ($record_edit_status_full as $value) {
                        $user_id = $value->user_id_for_edit;
                        $edit_timestamp = $value->user_record_edit_timestamp;
                        $getUDetails = getRecords("AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name,AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name","users",array("id"=>$user_id));


                       // $first_name = $this->ion_auth->user($user_id)->row()->first_name;
                        //$last_name = $this->ion_auth->user($user_id)->row()->last_name;
                        $full_name = $getUDetails[0]->first_name . '&nbsp;' . $getUDetails[0]->last_name;
                        ?>
                        <div class="alert alert-success">
                          <strong>Record Last Edited By : </strong> <?php echo $full_name; ?>, At : <?php echo date('d-m-Y h:i:s A', $edit_timestamp); ?>
                        </div>
                        <?php
                    }
                }
                ?>
        </div>
      </div>
    </div>
</div>

<script>
    function viewRecord(id) {
        var url = new URL("<?php echo base_url('/doctor/doctor_record_detail/'.$request_query[0]->uralensis_request_id.'/view');?>");
        url.searchParams.append('slide', id);
        window.location.href = url.href;
        console.log(url.href);
    }

    $(document).ready(function() {
        $('.doctor-detail-specimen-tab').click(function() {
            var id = $(this).attr('id');
            var index = id.split("-")[4];
            console.log(index);
            $(".slide-image-container").hide();
            $("#slide-image-container-"+index).show();
        });
    });
    
</script>