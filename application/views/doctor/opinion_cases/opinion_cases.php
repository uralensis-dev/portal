<style type="text/css">
    /*div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top:-65px;
        height: 37px !important;
        width: 50px !important;
        left: 29px;
        padding:0;
    }*/
    .dataTables_wrapper .row:first-child div{height: 1px;}
    div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top:-125px;
        height: 37px !important;
        width: 50px !important;
        left: 29px;
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
        top: -115px;
        right: 40px;
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
        right: -8px;
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
        .table .dropdown-action .dropdown-menu .dropdown-item{
            font-size: 16px;
        }
        div.dataTables_wrapper div.dataTables_filter{
            top: -133px;
            right: 60px;
        }
    }
    @media screen and (max-width: 1580px) {
        .tg-cancel label {
            width: 35px;
            padding: 5px;
        }
        /*div.dataTables_wrapper div.dataTables_length select{top: -59px;}*/
    }

    ol.breadcrumb{float: left;}
</style>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3 class="page-title">Records</h3>
        <div class="tg-breadcrumbarea tg-searchrecordhold">
            <ol class="breadcrumb nopadding" style="padding-left: 0 !important;">
                <li><a href="<?php echo base_url();?>doctor">Dashboard</a>
                </li><li class="active">Opinion Cases</li>
            </ol>
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
                                <input id="case_review_search_datatable" type="text" class="form-control custom_search_datatable" placeholder="Search">
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
                        <form>
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
                                    <button type="button" class="btn btn-success btn-search">Advance Search</button>
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
                            <table class="table table-bordered custom-search-table">
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
    <table id="doctor_opinion_record_list_table" class="table table-striped custom-table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>UL No.</th>
                <th>First name</th>
                <th>Surname</th>
                <th>DOB.</th>
                <th>PCI No.</th>
                <th>EMIS No.</th>
                <th>NHS No.</th>
                <th>Lab. No.</th>
                <th>Client</th>
                <th>Type</th>
                <th>Request Date:</th>
                <th>Received by Lab.</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($opinion_cases)) { ?>
                <?php foreach ($opinion_cases as $row) { ?>
                    <?php
                    // $row_code = '';

                    // if (!empty($row->request_code_status) && $row->request_code_status === 'new') {
                    //     $row_code = 'row_yellow';
                    // } elseif (!empty($row->request_code_status) && $row->request_code_status === 'rec_by_lab') {
                    //     $row_code = 'row_orange';
                    // } elseif (!empty($row->request_code_status) && $row->request_code_status === 'pci_added') {
                    //     $row_code = 'row_purple';
                    // } elseif (!empty($row->request_code_status) && $row->request_code_status === 'assign_doctor') {
                    //     $row_code = 'row_green';
                    // } elseif (!empty($row->request_code_status) && $row->request_code_status === 'micro_add') {
                    //     $row_code = 'row_skyblue';
                    // } elseif (!empty($row->request_code_status) && $row->request_code_status === 'add_to_authorize') {
                    //     $row_code = 'row_blue';
                    // } elseif (!empty($row->request_code_status) && $row->request_code_status === 'furtherwork_add') {
                    //     $row_code = 'row_brown';
                    // } elseif (!empty($row->request_code_status) && $row->request_code_status === 'record_publish') {
                    //     $row_code = 'row_white';
                    // }
                    ?>
                    <tr class="<?php echo $row_code; ?>">
                        <td><?php echo $row->serial_number; ?></td>
                        <td><?php echo $row->f_name; ?></td>
                        <td><?php echo $row->sur_name; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row->dob)); ?></td>
                        <td><?php echo $row->pci_number; ?></td>
                        <td><?php echo $row->emis_number; ?></td>
                        <td><?php echo $row->nhs_number; ?></td>
                        <td><?php echo $row->lab_number; ?></td>
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
                            <a class="hospital_initials" data-toggle="tooltip" data-placement="top" title="<?php echo $this->ion_auth->group($row->hospital_group_id)->row()->description; ?>" href="javascript:void(0);" >
                                <?php echo $f_initial . ' ' . $l_initial; ?>
                            </a>
                        </td>
                        <td><?php echo $row->report_urgency; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row->request_datetime)); ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row->date_received_bylab)); ?></td>
                        <td style="text-align:center;">
                            <?php
                            if ($row->specimen_update_status == 0 && $row->specimen_publish_status == 0) :
                                // echo '<a href="' . site_url() . '/doctor/opinion_record_detail/' . $row->uralensis_request_id . '" data-toggle="tooltip" data-placement="top" title="Please Update this ' . $row->serial_number . ' Record First."><img src="' . base_url('assets/img/detail.png') . '"></a>';
                                echo '<a href="' . site_url() . '/doctor/opinion_record_detail/' . $row->uralensis_request_id . '" data-toggle="tooltip" data-placement="top" title="Please Update this ' . $row->serial_number . ' Record First."><span class="badge badge-danger">Not Recorded</span></a>';
                            elseif ($row->specimen_update_status == 1 && $row->specimen_publish_status == 0) :
                                // echo '<a href="' . site_url() . '/doctor/opinion_record_detail/' . $row->uralensis_request_id . '" data-toggle="tooltip" data-placement="top" title="' . $row->serial_number . ' Record is Updated."><img src="' . base_url('assets/img/update.png') . '"></a>';
                                echo '<a href="' . site_url() . '/doctor/opinion_record_detail/' . $row->uralensis_request_id . '" data-toggle="tooltip" data-placement="top" title="' . $row->serial_number . ' Record is Updated."><span class="badge badge-success">Updated</span></a>';
                            elseif ($row->specimen_update_status == 1 && $row->specimen_publish_status == 1) :
                                echo '<a href="' . site_url() . '/doctor/opinion_record_detail/' . $row->uralensis_request_id . '" data-toggle="tooltip" data-placement="top" title="' . $row->serial_number . ' Record is Published."><span class="badge badge-primary">Published</span></a>';
                                // echo '<a href="' . site_url() . '/doctor/opinion_record_detail/' . $row->uralensis_request_id . '" data-toggle="tooltip" data-placement="top" title="' . $row->serial_number . ' Record is Published."><img src="' . base_url('assets/img/correct.png') . '"></a>';
                            endif;
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
    
</div>