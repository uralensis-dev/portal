<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if (!empty($auth_queue)) { ?>
<script src="<?php echo base_url('/assets/subassets/js/jquery-3.2.1.min.js')?>"></script>

<style type="text/css">
    .dataTables_wrapper .row:first-child div{height: 1px;}
    div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top:-58px;
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
        top: -60px;
        right: 80px;
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
    a#authorization_pdf_iframe{
        width: 22px;
        display: block;
        float: right;
    }
    .btn-default{outline: none !important}
    a#authorization_pdf_iframe img{
        width: 100%;
    }
    .btn.btn-rounded {
        width: 46px;
        height: 46px;
        text-align: center !important;
        background: transparent !important;
        font-size: 20px;
        line-height: 1;
        margin-top: 10px;
    }s
    .table.custom-table > thead > tr > th{font-weight: bold;}
    .tg-cancel input{
        display: none;
    }

    .tg-cancel label i {
        color: red;
    }
    li.tg-statusbar.tg-flagcolor.custome-flagcolors.last .btn-default{background: transparent !important;}

    .tg-cancel label {
        cursor: pointer;
        margin-bottom: 0;
        width: 45px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 50%;
    }
    @media screen and (max-width: 1380px){
        .tg-cancel label {
            width: 35px;
            padding: 5px;
        }
        .tg-filters > li.last .adv-search.btn-default{line-height: 1.5 !important}
    }
    @media screen and (min-width: 1600px) {
        body{font-size: 18px;}
        .table .dropdown-action .dropdown-menu .dropdown-item{
            font-size: 16px;
        }
        div.dataTables_wrapper div.dataTables_filter{
            top: -70px;
            right: 80px;
        }
    }
</style>
<div class="container-fluid">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-4">
                <h3 class="page-title">Records</h3>
            </div>
            <div class="col-md-8 text-right">
                <button id="publish_bulk_authorization_reports" class="btn btn-info" style="border-radius: 4px;"><i class="fa fa-upload" style="margin-right:5px;"></i> Publish Bulk</button>
            </div>
        </div>
        
        <div class="tg-breadcrumbarea tg-searchrecordhold">
            <div class="col-md-4 nopadding">
               <ol class="tg-breadcrumb tg-breadcrumbvtwo">
                    <li><a href="javascript:;">Dashboard</a></li>
                    <li class="active">Authorization Queue</li>
                </ol> 
            </div>
            <div class="col-md-8  nopadding">
                <div class="tg-rightarea">
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
                                           
                                        </div>
                                    </li>
                                    <li>
                                        <button class="btn btn-default btn-rounded btn-sm" onclick="print()"><i class="fa fa-print"></i></button>
                                        <button class="btn btn-default btn-rounded btn-sm"><i class="fa fa-file-pdf-o text-danger"></i></button>
                                    </li>
                                </ul>
                            </div>
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

    <div class="row report_listing">
        <div class="col-md-12">
                  
        <table id="record_list_table_authorization" class="table table-striped custom-table" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th><input type="checkbox"  class="publish_bulk_authroization" value=""  name="select-all" id="select-all"></th>
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
                    <th>&nbsp;</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;
                $ifram_json = array();
                if(!empty($auth_queue)){
                foreach ($auth_queue as $row) {
                    $ifram_json[] = $row;
                    ?>
                    <tr>
                        <td>
                            <span style="display:none;"><?php echo $row->uralensis_request_id; ?></span>
                        </td>
                        <td>
                            <input type="checkbox" name="publish_bulk_authroization[]" class="publish_bulk_authroization" value="<?php echo $row->uralensis_request_id; ?>">
                        </td>
                        <td><?php echo $row->serial_number; ?></td>
                        <td><?php echo $row->f_name; ?></td>
                        <td><?php echo $row->sur_name; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row->dob)); ?></td>
                        <td><?php echo $row->pci_number; ?></td>
                        <td><?php echo $row->emis_number; ?></td>
                        <td><?php echo $row->nhs_number; ?></td>
                        <td><?php echo $row->lab_number; ?></td>
                        <td><a data-toggle="tooltip" data-placement="top" title="<?php echo $this->ion_auth->group($row->hospital_group_id)->row()->description; ?>" href="javascript:void(0);" ><img  src="<?php echo base_url('assets/img/hospital.png'); ?>"></a></td>
                        <td><?php echo $row->report_urgency; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row->request_datetime)); ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row->date_received_bylab)); ?></td>
                        <td style="text-align:center;">
                            <?php
                            if ($row->specimen_update_status == 0 && $row->specimen_publish_status == 0) :
                                echo '<a href="' . site_url() . '/doctor/doctor_record_detail/' . $row->uralensis_request_id . '" data-toggle="tooltip" data-placement="top" title="Please Update this ' . $row->serial_number . ' Record First."><img src="' . base_url('assets/img/detail.png') . '"></a>';
                            elseif ($row->specimen_update_status == 1 && $row->specimen_publish_status == 0) :
                                echo '<a href="' . site_url() . '/doctor/doctor_record_detail/' . $row->uralensis_request_id . '" data-toggle="tooltip" data-placement="top" title="' . $row->serial_number . ' Record is Updated."><img src="' . base_url('assets/img/update.png') . '"></a>';
                            elseif ($row->specimen_update_status == 1 && $row->specimen_publish_status == 1) :
                                echo '<a href="' . site_url() . '/doctor/doctor_record_detail/' . $row->uralensis_request_id . '" data-toggle="tooltip" data-placement="top" title="' . $row->serial_number . ' Record is Published."><img src="' . base_url('assets/img/correct.png') . '"></a>';
                            endif;
                            ?>
                        </td>
                        <td style="text-align:right;">
                            <?php
                            if ($row->specimen_update_status == 1 && $row->specimen_publish_status == 0) {
                                ?>
                                <a onclick="openModal('<?php echo $count; ?>')" data-countframe="<?php echo $count; ?>" id="authorization_pdf_iframe" href="javascript:;" target="_blank" >
                                    <img data-toggle="tooltip" data-placement="top" title="<?php echo $row->serial_number; ?>Record is Updated." src="<?php echo base_url('assets/img/docs.png'); ?>">
                                </a>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                    $count++;
                }
                }else{ ?>
                    <tr class="odd"><td valign="top" colspan="16" class="dataTables_empty">No cases listed for Queue</td></tr>
            <?php } ?>
            </tbody>
        </table>
        
        <div id="display_iframe_pdf" class="modal fade display_iframe_pdf" role="dialog" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-1">
                                    <a id="navPrev" href="#" onclick="prevPdf()"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
                                </div>
                                <div class="col-xs-10">
                                    <object id="iframe_pdf" type="application/pdf" data="" width="100%" style="height: 80vh;">No Support</object>
                                </div>
                                <div class="col-xs-1">
                                    <a id="navNext" href="#" onclick="nextPdf()"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
                            <div class="record_publish_auth"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if (isset($auth_queue)) {
                $user_id = $this->ion_auth->user()->row()->id;
                foreach ($auth_queue as $check_publish) {
                    $record_id = $check_publish->uralensis_request_id;
                    if ($check_publish->specimen_update_status == 1) {
                        if ($check_publish->specimen_publish_status == 0) {
                            ?>
                            <div id="user_auth_popup_<?php echo $record_id; ?>" class="modal fade user_auth_popup" role="dialog" data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Publish Report</h4>
                                        </div>
                                        <div class="modal-body">
                                            <?php if (empty($check_publish->mdt_case) && empty($check_publish->mdt_case_status)) { ?>
                                                <div class="well">
                                                    <p>Please Select One Of The MDT Option.</p>
                                                    <a href="<?php echo base_url('index.php/doctor/doctor_record_detail/' . $record_id); ?>">
                                                        <button class="btn btn-sm btn-success">Add MDT</button>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                            <div id="publish_button"></div>
                                            <div class="publish_report_form">
                                                <form class="form" method="post" id="check_auth_pass_form">
                                                    <div class="form-group">
                                                        <p>Enter Your Pin To Publish This Report.</p>
                                                        <input autofocus maxlength="1" type="password" id="auth_pass1" name="auth_pass1">
                                                        <input maxlength="1" type="password" name="auth_pass2">
                                                        <input maxlength="1" type="password" name="auth_pass3">
                                                        <input maxlength="1" type="password" name="auth_pass4">
                                                        <input name="request_id" type="hidden" value="<?php echo $record_id; ?>">
                                                        <input name="user_id" type="hidden" value="<?php echo $user_id; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <button id="check_pass_authorization" class="btn btn-warning pull-right">Submit</button>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                    }
                }
            }
            ?>
            
            <script>
                var data = <?php echo json_encode($ifram_json); ?>;
                var currentItem = 0;
                var site_url = '<?php echo site_url() . '/doctor/view_report/'; ?>';
                function prevPdf() {
                    if (currentItem > 0) {
                        currentItem--;
                    }
                    loadData();
                }

                function nextPdf() {
                    if (currentItem < data.length - 1) {
                        currentItem++;
                    }
                    loadData();
                }

                function loadData() {
                    $("#iframe_pdf").attr("data", site_url + data[currentItem].uralensis_request_id);

                    if (data[currentItem].specimen_update_status == 1 && data[currentItem].specimen_publish_status == 0) {
                        $(".record_publish_auth").html('<a class="pull-left" style="cursor: pointer;" data-toggle="modal" data-target="#user_auth_popup_' + data[currentItem].uralensis_request_id + '"><img data-toggle="tooltip" data-placement="top" title="Click To Publish This Report" src="<?php echo base_url("assets/img/pdf.png"); ?>"></a>');
                    }

                    $("#navPrev").removeAttr("disabled");
                    $("#navNext").removeAttr("disabled");

                    if (currentItem == 0) {
                        $("#navPrev").attr("disabled", "disabled");
                    }
                    else if (currentItem == data.length - 1) {
                        $("#navNext").attr("disabled", "disabled");
                    }
                }

                function openModal(idx) {
                    currentItem = idx;
                    loadData();
                    $("#display_iframe_pdf").modal();
                }


            </script>
        </div>
    </div>
    <div id="bulk_authorization_publish" class="modal fade user_auth_popup" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Publish Report</h4>
                </div>
                <div class="modal-body">
                    <div class="well">
                        <p>Please Select One Of The MDT Option.</p>
                        <a href="<?php echo base_url('index.php/institutedoctor_record_list'); ?>">
                            <button class="btn btn-sm btn-success">Add MDT</button>
                        </a>
                    </div>
                    <div id="publish_button"></div>
                    <div class="publish_report_form">
                        <form class="form" method="post" id="check_auth_pass_form">
                            <div class="form-group">
                                <p>Enter Your Pin To Publish This Report.</p>
                                <input autofocus maxlength="1" type="password" id="auth_password1" name="auth_pass1">
                                <input maxlength="1" type="password" id="auth_password2" name="auth_pass2">
                                <input maxlength="1" type="password" id="auth_password3" name="auth_pass3">
                                <input maxlength="1" type="password" id="auth_password4" name="auth_pass4">
                            </div>
                            <div class="form-group">
                                <button id="check_pass_authorization_bulk" class="btn btn-warning pull-right">Submit</button>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

</div>
<script>

$('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
});
</script>