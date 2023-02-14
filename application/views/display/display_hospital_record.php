<link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet" />
<style type="text/css">
    .page-header {
        margin:0 0 1.875rem;
    }
    .content{background: #f5f5f5}
    table tr th:nth-child(11),
    table tr th:nth-child(12),
    table tr td:nth-child(11),
    table tr td:nth-child(12){
        display: none;
    }
    .user-menu.nav > li > a > img{padding-top: 19px;}
    #admin_display_records.table > thead > tr > th:last-child,
    #admin_display_records.table > tbody > tr > td:last-child{
        text-align: right;
    }
    div.dataTables_wrapper div.dataTables_length select{height: auto;}
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
</style>
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Records</h3>
            <!-- <ul class="breadcrumb">
                <li class="breadcrumb-item active"></li>
            </ul> -->
        </div>
    </div>
</div>
<!-- /Page Header -->

<!-- Search Filter -->
<div class="row filter-row">
    <div class="col-sm-3 col-md-3">  
        <div class="form-group form-focus select-focus">
            <div class="">
                <?php echo form_open("admin/display_all", array('id' => 'assign_doc_form')); ?>
                    <select class="select floating" name="doctor" id="doctor">
                        <option value="0">Choose Doctor</option>
                        <?php
                        foreach ($doctor_list as $doctors) :
                            ?>
                            <option value="<?php echo $doctors->id; ?>"><?php echo $doctors->username; ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                    <label class="focus-label">Choose Doctor</label>
                    
            </div>
        </div>
    </div>
    <div class="col-sm-1 col-md-1">
        <div class="form-group">
            <button type="button" id="assign_btn" class="btn btn-sm btn-primary" onClick="AssignDoctor()">Assign</button>
        </div>
                </form>
    </div>
    <div class="col-sm-6 col-md-6"> 
        <!-- <div class="flag-container border rounded" style='background-color:#fff;padding-left:15px;'>
            <span class="select2-selection__rendered" role="textbox" aria-readonly="true" title="Flag Type">Select Flag Type</span>
            <br>
            <label for="flag_green">
                <input type="radio" name="flag_sorting" id="flag_green" class="flag_status">
                <img data-toggle="tooltip" data-placement="top" title="This case marked as new case." src="<?php echo base_url('assets/img/flag_green.png'); ?>">
            </label>
            <label for="flag_red">
                <input type="radio" name="flag_sorting" id="flag_red" class="flag_status">
                <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="<?php echo base_url('assets/img/flag_red.png'); ?>">
            </label>
            <label for="flag_yellow">
                <input type="radio" name="flag_sorting" id="flag_yellow" class="flag_status">
                <img data-toggle="tooltip" data-placement="top" title="This case marked for review." src="<?php echo base_url('assets/img/flag_yellow.png'); ?>">
            </label>
            <label for="flag_blue">
                <input type="radio" name="flag_sorting" id="flag_blue" class="flag_status">
                <img data-toggle="tooltip" data-placement="top" title="This case marked for ready to authorize." src="<?php echo base_url('assets/img/flag_blue.png'); ?>">
            </label>
            <label for="flag_black">
                <input type="radio" name="flag_sorting" id="flag_black" class="flag_status">
                <img data-toggle="tooltip" data-placement="top" title="This case marked as complete." src="<?php echo base_url('assets/img/flag_black.png'); ?>">
            </label>
            <label for="flag_all">
                <input type="radio" name="flag_sorting" id="flag_all" class="flag_status">
                <img src="<?php echo base_url('assets/img/flag_all.png'); ?>">
            </label>
        </div> -->
        <div class="tg-haslayout">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-filterhold">
                    <ul class="tg-filters record-list-filters">
                       
                        
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
                                <span class="tg-cancel tg-flagcolor4" style="display: none">
                                    <input class="tat" type="radio" name="tat" id="all_tat">
                                    <label for="all_tat">
                                        <img src="<?php echo base_url()?>assets/img/clearAll.png" class="img-responsive clearAll">
                                    </label>
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

<!-- /Search Filter -->
<div class="row" >
    <div class="col-md-12">
        <div class="table-responsive2">
        
            <table id="admin_display_records2"  class="table table-striped custom-table mb-0">
                <thead>
                    <tr>
                        <th>PCI No.<br />Track No.</th>
                        <th>Client<br />Clinic</th>
                        <th>Courier<br />Assignment No.</th>
                        <th>Batch<br />PCI No.</th>
                        <th>First<br />Surname</th>
                        <th>NHS No.<br />DOB</th>
                        <th>LAB No.<br />Rel Date</th>
                        <th><i class="lnr lnr-layers" style="font-size:18px;"></i></th>
                        <th>Status</th>
                        <th style="text-align: center; width: 104px;">Flag</th>
                        <th><i class="lnr lnr-bubble" style="font-size:18px;"></i></th>
                        <th><i class="lnr lnr-file-empty" style="font-size:18px;"></i></th>
                        <th>Assigned</th>
                        <th><i class="la la-cloud-upload-alt"  style="font-size:28px;" ></i></th>
                        <th>Actions</th>
                    </tr>
                   
                    <?php if (!empty($display_unassign_records) && is_array($display_unassign_records)) { ?>
                <?php foreach ($display_unassign_records as $unassign_records) { ?>
                    <tr>
                        <td><input type="checkbox" name="assign_id[]" value="<?php echo $unassign_records->uralensis_request_id; ?>"></td>
                        <td><?php echo $unassign_records->serial_number; ?></td>
                        <td><?php echo $unassign_records->f_name; ?></td>
                        <td><?php echo $unassign_records->sur_name; ?></td>
                        <td><?php echo $unassign_records->emis_number; ?></td>
                        <td><?php echo $unassign_records->nhs_number; ?></td>
                        <td><?php echo $unassign_records->lab_number; ?></td>
                        <td><?php echo $unassign_records->lab_number; ?></td>
                        <td><?php echo $unassign_records->lab_number; ?></td>
                        <td><?php echo $unassign_records->lab_number; ?></td>
                        <td><?php echo $unassign_records->lab_number; ?></td>
                        <td><?php echo $unassign_records->lab_number; ?></td>
                        <td><?php echo $unassign_records->lab_number; ?></td>
                        <td>
                            <?php
                            if ($unassign_records->assign_status == 0) {
                                echo 'Not Assigned';
                            }
                            ?>
                        </td>
                       <th>Actions</th>
                    </tr>
                <?php } ?>
            <?php } ?>
                    
                </thead>
            </table>
        </div>
    </div>
</div>
