<style type="text/css">
    .breadcrumb {
        color: #6c757d;
        font-size: 20px;
        font-weight: 500;
        margin-bottom: 20px;
        display: block;
        padding-left: 0 !important;
        overflow:hidden !important; 
    }
    .btn-group-lg>.btn, .btn-lg{
        font-size: unset;
        border-radius: unset;
    }
     div.dataTables_wrapper div.dataTables_length select {
        /*position: absolute;*/
        /*top:-215px;*/
        height: 37px !important;
        width: 90px !important;
        /*left: 29px;*/
        padding:4px;
    }
    .modal-title {
        font-weight: 700;
        font-size: 24px;
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

    @media screen and (min-width: 1600px) {
        body{font-size: 18px;}
    }
    .dataTables_wrapper .row+.row {
    width: auto;
}
</style>
<style type="text/css">

    .tg-themenavtabs li a{
        padding: 5px 15px;
        font-size: 16px;
    }
</style>

<div class="container-fluid">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php
        if ($this->session->flashdata('msg_snomed') != '') {
            echo $this->session->flashdata('msg_snomed');
        }
        ?>
        <div class="tg-breadcrumbarea tg-searchrecordhold">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="page-title">Snomed Codes</h3>
                    <ol class="tg-breadcrumb tg-breadcrumbvtwo">
                        <li><a href="javascript:;">Dashboard</a></li>
                        <li class="active">Snomed Codes</li>
                    </ol>
                </div>   
                
            </div>
        </div>
    </div>

    <div class="tg-haslayout">
        <div class="row">


        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 list-snomedset">
        <div class="tg-filterhold">
            <ul class="tg-themenavtabs nav navbar-nav">
                <li class="nav-item active">
                    <a data-toggle="tab" href="#tabs_t1">Snomed Code T1&T2</a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#tabs_p">Snomed Code P</a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#tabs_m">Snomed Code M</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('doctor/showMicroscopicCodes'); ?>">Short Code S</a>
                </li>
            </ul>
        </div>
    </div>

            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="tg-filterhold">
                    <ul class="tg-filters record-list-filters">
                        <li class="tg-statusbar tg-flagcolor">
                            
                        </li>
<!--                        <li class="tg-statusbar tg-flagcolor" style="padding: 5px">-->
<!--                            <div class="tg-checkboxgroup tg-checkboxgroupvtwo">-->
<!--                                <span class="tg-radio tg-flagcolor1">-->
<!--                                    <input class="tat" name="tat" id="tat5"  type="radio">-->
<!--                                    <label for="tat5"><span>&lt;5</span></label>-->
<!--                                </span>-->
<!--                                <span class="tg-radio tg-flagcolor2">-->
<!--                                    <input class="tat" type="radio" name="tat" id="tat10">-->
<!--                                    <label for="tat10"><span>&lt;10</span></label>-->
<!--                                </span>-->
<!--                                <span class="tg-radio tg-flagcolor3">-->
<!--                                    <input class="tat" type="radio" name="tat" id="tat20">-->
<!--                                    <label for="tat20"><span>&lt;20</span></label>-->
<!--                                </span>-->
<!--                                <span class="tg-radio tg-flagcolor4">-->
<!--                                    <input class="tat" type="radio" name="tat" id="tat30">-->
<!--                                    <label for="tat30"><span>&gt;20</span></label>-->
<!--                                </span>-->
<!--                                <span class="tg-cancel tg-flagcolor4" style="display: none;">-->
<!--                                    <input class="tat" type="radio" name="tat" id="all_tat">-->
<!--                                    <label for="all_tat">-->
<!--                                        <img src="--><?php //echo base_url();?><!--assets/img/clearAll.png" class="img-responsive clearAll">-->
<!--                                    </label>-->
<!--                                </span>-->
<!--                            </div>-->
<!--                        </li>-->
                        
<!--                        <li class="tg-flagcolor" style="padding: 3px 8px">-->
<!--                            <div class="tg-checkboxgroup tg-checkboxgroupvtwo">-->
<!--                                --><?php
//                                if ($this->session->userdata('color_code') !== '') {
//                                    $session_color = $this->session->userdata('color_code');
//                                }
//                                ?>
<!--                                <span class="tg-radio tg-flagcolor1">-->
<!--                                    -->
<!--                                    <input type="radio" id="flag_blue" class="flag_status" name="flag_sorting">-->
<!--                                    <label for="flag_blue"></label>-->
<!--                                </span>-->
<!--                                <span class="tg-radio tg-flagcolor2">-->
<!--                                    -->
<!--                                    <input type="radio" id="flag_green" class="flag_status" name="flag_sorting">-->
<!--                                    <label for="flag_green"></label>-->
<!--                                </span>-->
<!--                                <span class="tg-radio tg-flagcolor3">-->
<!--                                    -->
<!--                                    <input type="radio" id="flag_yellow" class="flag_status" name="flag_sorting">-->
<!--                                    <label for="flag_yellow"></label>-->
<!--                                </span>-->
<!--                                <span class="tg-radio tg-flagcolor4">-->
<!--                                    -->
<!--                                    <input type="radio" id="flag_black" class="flag_status" name="flag_sorting">-->
<!--                                    <label for="flag_black"></label>-->
<!--                                </span>-->
<!--                                <span class="tg-radio tg-flagcolor5">-->
<!--                                    -->
<!--                                    <input type="radio" id="flag_red" class="flag_status" name="flag_sorting">-->
<!--                                    <label for="flag_red"></label>-->
<!--                                </span>-->
<!--                                <span class="tg-cancel tg-flagcolor6" style="display: none">-->
<!--                                    <input checked type="radio" class="flag_status"  name="flag_sorting" id="flag_all">-->
<!--                                    <label for="falg_all">-->
<!--                                        <img src="--><?php //echo base_url();?><!--assets/img/clearAll.png" class="img-responsive clearAll">-->
<!--                                    </label>-->
<!--                                </span>-->
<!--                            </div>-->
<!--                        </li>-->
<!---->
<!--                        <li class="tg-statusbar tg-flagcolor custome-flagcolors">-->
<!--                            <div class="tg-checkboxgroup tg-checkboxgroupvtwo">-->
<!--                                -->
<!--                                <span class="tg-radio tg-flagcolor4" title="Urgent">-->
<!--                                    <input id="report_urgent" class="report_urgency_status" type="radio" name="report_urgency">-->
<!--                                    <label for="report_urgent">-->
<!--            -->
<!--                                        <img src="--><?php //echo base_url('/assets/icons/Urgent-wb.png'); ?><!--" class="img-responsive uncheck">-->
<!--                                        <img src="--><?php //echo base_url('/assets/icons/white/Urgent-wb-white.png'); ?><!--" class="img-responsive checkd">-->
<!--                                    </label>-->
<!--                                </span>-->
<!---->
<!--                                <span class="tg-radio tg-flagcolor4" title="Routine">-->
<!--                                    <input id="report_routine" class="report_urgency_status" type="radio" name="report_urgency">-->
<!--                                    <label for="report_routine">-->
<!--                                    <img src="--><?php //echo base_url('/assets/icons/Rotate.png'); ?><!--" class="img-responsive uncheck">-->
<!--                                        <img src="--><?php //echo base_url('/assets/icons/white/Rotate-white.png'); ?><!--" class="img-responsive checkd">-->
<!--                                    </label>-->
<!--                                </span>-->
<!---->
<!--                                <span class="tg-radio tg-flagcolor4" title="2WW">-->
<!--                                    <input id="report_2ww" class="report_urgency_status" type="radio" name="report_urgency">-->
<!--                                    <label for="report_2ww">-->
<!--                                        <img src="--><?php //echo base_url('/assets/icons/2ww-wc.png'); ?><!--" class="img-responsive uncheck">-->
<!--                                        <img src="--><?php //echo base_url('/assets/icons/white/2ww-wc-white.png'); ?><!--" class="img-responsive checkd">-->
<!--                                    </label>-->
<!--                                </span>-->
<!---->
<!--                                <span class="tg-cancel tg-flagcolor4" title="Clear" style="display: none;">-->
<!--                                    <input id="report_clear" class="report_urgency_status" type="radio" name="report_urgency">-->
<!--                                    <label for="report_clear">-->
<!--                                        <img src="--><?php //echo base_url();?><!--assets/img/clearAll.png" class="img-responsive clearAll">-->
<!--                                    </label>-->
<!--                                </span>-->
<!--                            </div>-->
<!--                        </li>-->
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors last pull-right" style="padding: 0 10px;">                              
                            <button type="submit" class="btn btn-default adv-search" data-toggle="collapse" data-target="#collapse_adv_search"><i class="fa fa-cog"></i></button>
                        </li>
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors pull-right nobefore search_li" style="padding: 0">
                            <div class="input-group">
                                <input id="unpub_custom_filter" type="text" class="form-control custom_search_datatable" placeholder="Search">
                                <div class="input-group-btn">
                                  <button class="btn btn-primary btn-rounded" type="submit">
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
        <div class="col-md-12">
        <div id="add_snomed_codes">

            <div class="clearfix"></div>
            <div class="tg-tabcontentvtwo tab-content">
                <div class="tg-navtabsdetails tab-pane fade in active" id="tabs_t1">
                    <div class="col-md-12">
                            <?php if($user_type == 'LA'){ ?>
                                <div class="col-md-6 form-group">
                                    <strong><i class="fa fa-plus"></i>  T1 & T2 Codes</strong>
                                    <p><?php echo isset($msg) ? $msg : ''; ?></p>
                                </div>
                            <div class="col-md-6 form-group text-right">
                                <button data-snomedtype="t1" data-toggle="modal" data-target="#snomed_code_t1" class="btn btn-primary btn-lg btn-rounded"><i class="fa fa-plus"></i> Snomed Code</button>
                            </div> 
                            <?php } ?>
                            <div class="clearfix"></div>
                            
                            <div id="snomed_code_t1" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title"><i class="fa fa-plus"></i>  Snomed T1 & T2</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form snomed_code_from_t1 snomed_codes">
                                            <div class="form-group">
                                                <input type="text" name="snomed_code" class="form-control" placeholder="Snomed Code T1 & T2">
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" name="snomed_desc" placeholder="Snomed Code Description"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" value="t1" name="snomed_type">
                                                <button type="button" class="btn btn-primary btn-rounded add-snomed-code pull-right"><i class="fa fa-plus"></i> Snomed</button>
                                                <div class="clearfix"></div>
                                            </div>
                                        </form>
                                    </div>
                                   
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <!-- <h3 class="title">T1 &amp; T2 Codes List</h3> -->
                            
                            <?php $userid = $this->ion_auth->user()->row()->id; ?>
                            <?php
                            $snomed_codes = getSnomedCodesData('t1');
                            if (!empty($snomed_codes)) { ?>
                                <table id="snomed_t1_code_table" class="table table-striped custom-table custom-search-table">
                                    <thead>
                                        <tr>
                                            <th>T1 & T2 Code</th>
                                            <th>Description</th>
                                            <th>Added By</th>
                                            <th>Status</th>
                                            <?php if($user_type == 'LA'){ ?>
                                            <th>&nbsp;</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($snomed_codes as $snomed_data) { ?>
                                            <tr>
                                                <td><?php echo $snomed_data['usmdcode_code']; ?></td>
                                                <td><?php echo $snomed_data['usmdcode_code_desc']; ?></td>
                                                <td><?php echo uralensisGetUsername($snomed_data['snomed_added_by'], 'fullname'); ?></td>
                                                <td><?php echo $snomed_data['snomed_status']; ?></td>
                                                <?php if($user_type == 'LA'){ ?>
                                                <td>
                                                <?php 
                                                if($userid === $snomed_data['snomed_added_by']) {
                                                        echo '<a href="'.base_url('index.php/doctor/editSnomedCode/'.$snomed_data['usmd_code_id'].'/t1').'">Edit</a>  <span> | </span>';
                                                    echo '<a href="'.base_url('index.php/doctor/deleteSnomedCode/'.$snomed_data['usmd_code_id'].'/t1').'" style="color: #9C0000;">Delete</a>';
                                                }else{
                                                    echo '<img style="cursor:pointer; width:40px;" data-toggle="modal" data-target="#snomed_code_'.$snomed_data['usmdcode_code'].'" src="'.base_url('assets/icons/Comments.png').'"></td>';
                                                } 
                                                ?>
                                                </td>
                                                <?php } ?>
                                            </tr>
                                            <div id="snomed_code_<?php echo $snomed_data['usmdcode_code']; ?>" class="modal fade snomed_code_recomendation" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Send Recommendation</h4>
                                                    </div>
                                                    <div class="modal-body snomed_privmsg_form">
                                                        <div class="form-group">
                                                            <input readonly="" type="text" name="privmsg_subject" value="Snomed Recommendation <?php echo $snomed_data['usmdcode_code']; ?>" id="privmsg_subject" maxlength="" size="40" class="form-control" placeholder="Subject">
                                                        </div>
                                                        <div class="form-group" style="overflow:hidden">
                                                            <textarea name="privmsg_body" cols="80" rows="5" id="privmsg_body" class="form-control" placeholder="Message"></textarea>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="from-group">
                                                            <input type="hidden" name="admin_id" value="<?php echo $snomed_data['snomed_added_by']; ?>">
                                                            <button type="button" class="btn btn-primary btn-rounded pull-right snomed_code_privmsg">Send Recommendation</button>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } else {
                                echo 'No Record Added Yet!';
                            } ?>
                    </div>
                </div>
                <div class="tg-navtabsdetails tab-pane fade in" id="tabs_p">
                    <div class="col-md-12">
                    <?php if($user_type == 'LA'){ ?>
                        <div class="col-md-6">
                            <strong><i class="fa fa-plus"></i>  P Codes</strong>
                        </div>
                        <div class="col-md-6">
                            <?php echo isset($msg) ? $msg : ''; ?>
                                <button data-snomedtype="p" class="btn btn-primary btn-rounded btn-lg pull-right" data-toggle="modal" data-target="#snomed_code_p"><i class="fa fa-plus"></i> Snomed Code</button>
                        </div>
                    <?php } ?>
                        <div id="snomed_code_p" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><i class="fa fa-plus"></i> Snomed P</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form snomed_code_from_p snomed_codes">
                                    <div class="form-group">
                                        <input type="text" name="snomed_code" class="form-control" placeholder="Snomed P Code">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="snomed_desc" placeholder="Snomed Code Description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" value="p" name="snomed_type">
                                        <button type="button" class="btn btn-primary btn-rounded add-snomed-code pull-right"><i class="fa fa-plus"></i> Snomed</button>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                            <!-- <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div> -->
                            </div>
                        </div>
                        </div>
                        <div class="clearfix"></div>
                        <?php
                            $snomed_codes = getSnomedCodesData('p');
                            if (!empty($snomed_codes)) { 
                        ?>
                        <table id="snomed_p_code_table" class="table table-striped custom-table custom-search-table">
                            <thead>
                                <tr>
                                    <th>P Code</th>
                                    <th>Description</th>
                                    <th>Added By</th>
                                    <th>Status</th>
                                    <?php if($user_type == 'LA'){ ?>
                                    <th>&nbsp;</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php foreach ($snomed_codes as $snomed_data) { ?>
                                        <tr>
                                            <td><?php echo $snomed_data['usmdcode_code']; ?></td>
                                            <td><?php echo $snomed_data['usmdcode_code_desc']; ?></td>
                                            <td><?php echo uralensisGetUsername($snomed_data['snomed_added_by'], 'fullname'); ?></td>
                                            <td><?php echo $snomed_data['snomed_status']; ?></td>
                                            <?php if($user_type == 'LA'){ ?>
                                            <td>
                                            <?php 
                                            if($userid === $snomed_data['snomed_added_by']) {
                                                    echo '<a href="'.base_url('index.php/doctor/editSnomedCode/'.$snomed_data['usmd_code_id'].'/p').'">Edit</a>  <span> | </span>';
                                                    echo '<a href="'.base_url('index.php/doctor/deleteSnomedCode/'.$snomed_data['usmd_code_id'].'/p').'" style="color: #9C0000;">Delete</a>';
                                            }else{
                                                echo '<img style="cursor:pointer;" data-toggle="modal" data-target="#snomed_code_'.$snomed_data['usmdcode_code'].'" src="'.base_url('assets/img/chat_comments.png').'"></td>';
                                            } 
                                            ?> 
                                            </td>
                                            <?php } ?>
                                        </tr>
                                        <div id="snomed_code_<?php echo $snomed_data['usmdcode_code']; ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Send Recommendation</h4>
                                                </div>
                                                <div class="modal-body snomed_privmsg_form">
                                                    <div class="form-group">
                                                        <input readonly="" type="text" name="privmsg_subject" value="Snomed Recommendation <?php echo $snomed_data['usmdcode_code']; ?>" id="privmsg_subject" maxlength="" size="40" class="form-control" placeholder="Subject">
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea name="privmsg_body" cols="80" rows="5" id="privmsg_body" class="form-control" placeholder="Message"></textarea>
                                                    </div>
                                                    <div class="from-group">
                                                        <input type="hidden" name="admin_id" value="<?php echo $snomed_data['snomed_added_by']; ?>">
                                                        <button type="button" class="btn btn-primary btn-rounded pull-right snomed_code_privmsg">Send Recommendation</button>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                            </tbody>
                        </table>
                    <?php } else{ 
                        echo 'No Record Added Yet!';
                        } ?>
                    </div>
                </div>
                <div class="tg-navtabsdetails tab-pane fade in" id="tabs_m">
                    <div class="col-md-12">
                    <?php if($user_type == 'LA'){ ?>
                        <div class="col-md-6"> <strong><i class="fa fa-plus"></i>  M Codes</strong></div>
                        <div class="col-md-6">
                             <?php echo isset($msg) ? $msg : ''; ?>
                            <button data-snomedtype="m" class="btn btn-primary btn-rounded btn-lg pull-right" data-toggle="modal" data-target="#snomed_code_m"><i class="fa fa-plus"></i>  Snomed Code</button>
                        </div>
                        <?php } ?>
                   
                       
                        <div id="snomed_code_m" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Snomed Code M</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form snomed_code_from_m snomed_codes">
                                        <div class="form-group">
                                            <input type="text" name="snomed_code" class="form-control" placeholder="Snomed Code M">
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" name="snomed_desc" placeholder="Snomed Code Description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="snomed_diagnosis" class="form-control" placeholder="Snomed Diagnosis (eg: benign,inflammation,atypical,malignant)">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" name="snomed_rc_path" class="form-control" placeholder="Snomed RCPath Score" min="1" max="20">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" value="m" name="snomed_type">
                                            <button type="button" class="btn btn-primary btn-rounded add-snomed-code pull-right"><i class="fa fa-plus"></i>  Snomed</button>
                                            <div class="clearfix"></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="clearfix"></div>
                        <?php
                            $snomed_codes = getSnomedCodesData('m');
                            if (!empty($snomed_codes)) { 
                        ?>
                        <table id="snomed_m_code_table" class="table table-striped custom-table custom-search-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>M Code</th>
                                    <th>Description</th>
                                    <th>Diagnoses</th>
                                    <th>RCPath</th>
                                    <th>Added By</th>
                                    <th>Status</th>
                                    <?php if($user_type == 'LA'){ ?>
                                    <th>&nbsp;</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php foreach ($snomed_codes as $snomed_data) { ?>
                                        <tr>
                                            <td><?php echo $snomed_data['usmdcode_code']; ?></td>
                                            <td><?php echo $snomed_data['usmdcode_code_desc']; ?></td>
                                            <td><?php echo $snomed_data['snomed_diagnoses']; ?></td>
                                            <td><?php echo $snomed_data['rc_path_score']; ?></td>
                                            <td><?php echo uralensisGetUsername($snomed_data['snomed_added_by'], 'fullname'); ?></td>
                                            <td><?php echo $snomed_data['snomed_status']; ?></td>
                                            <?php if($user_type == 'LA'){ ?>
                                            <td>
                                            <?php 
                                            if($userid === $snomed_data['snomed_added_by']) {
                                                    echo '<a href="'.base_url('index.php/doctor/editSnomedCode/'.$snomed_data['usmd_code_id'].'/m').'">Edit</a>';
                                            }else{
                                                echo '<img style="cursor:pointer;" data-toggle="modal" data-target="#snomed_code_'.$snomed_data['usmdcode_code'].'" src="'.base_url('assets/img/chat_comments.png').'"></td>';
                                            } 
                                            ?> 
                                            </td>
                                            <?php } ?>
                                        </tr>
                                        <div id="snomed_code_<?php echo $snomed_data['usmdcode_code']; ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Send Recommendation</h4>
                                                    </div>
                                                    <div class="modal-body snomed_privmsg_form">
                                                        <div class="form-group">
                                                            <input readonly="" type="text" name="privmsg_subject" value="Snomed Recommendation <?php echo $snomed_data['usmdcode_code']; ?>" id="privmsg_subject" maxlength="" size="40" class="form-control" placeholder="Subject">
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea name="privmsg_body" cols="80" rows="5" id="privmsg_body" class="form-control" placeholder="Message"></textarea>
                                                        </div>
                                                        <div class="from-group">
                                                            <input type="hidden" name="admin_id" value="<?php echo $snomed_data['snomed_added_by']; ?>">
                                                            <button type="button" class="btn btn-primary btn-rounded pull-right snomed_code_privmsg">Send Recommendation</button>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { echo 'No Record Added Yet!'; } ?>
                </div>
            </div>
                <div class="tg-navtabsdetails tab-pane fade in" id="tabs_s">
                    <div class="col-md-12">
                    <hr>
                    <strong><i class="fa fa-plus"></i>  Short Codes</strong> <br>
                        <?php echo isset($msg) ? $msg : ''; ?>
                        <button data-snomedtype="m" class="btn btn-primary pull-right" data-toggle="modal" data-target="#snomed_code_s"><i class="fa fa-plus"></i>  Snomed Code</button>
                        <div id="snomed_code_s" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Short Code S</h4>
                                </div>
                                    <div class="modal-body">
                                        <form class="form snomed_code_from_s snomed_codes">
                                            <div class="form-group">
                                                <input type="text" name="snomed_code" class="form-control" placeholder="Short Code S">
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" name="snomed_desc" placeholder="Short Code Description"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="snomed_diagnosis" class="form-control" placeholder="Diagnosis (eg: Skin,Fibrous tissue)">
                                            </div>
                                            <div class="form-group">
                                                <input type="number" name="snomed_rc_path" class="form-control" placeholder="RCPath Score" min="1" max="20">
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" value="s" name="snomed_type">
                                                <button type="button" class="btn btn-primary btn-rounded add-snomed-code pull-right"><i class="fa fa-plus"></i>  Snomed</button>
                                                <div class="clearfix"></div>
                                            </div>
                                        </form>
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="clearfix"></div>
                        <?php
                            $short_codes = getMicroCodes();
                            if (!empty($short_codes)) {
                        ?>
                        <table id="snomed_s_code_table" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Short Code</th>
                                    <th>Description</th>
                                    <th>Diagnoses</th>
                                    <th>RCPath</th>
                                    <th>Added By</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php foreach ($short_codes as $snomed_data) { ?>
                                        <tr>
                                            <td><?php echo $snomed_data['umc_code']; ?></td>
                                            <td><?php echo $snomed_data['umc_micro_desc']; ?></td>
                                            <td><?php echo $snomed_data['umc_disgnosis']; ?></td>
                                            <td><?php echo $snomed_data['umc_rcpath_score']; ?></td>
                                            <td><?php echo uralensisGetUsername($snomed_data['umc_added_by'], 'fullname'); ?></td>
                                            <td><?php echo $snomed_data['umc_status']; ?></td>
                                            <td>
                                            <?php
                                            if($userid === $snomed_data['umc_added_by']) {
                                                    echo '<a href="'.base_url('index.php/doctor/editSnomedCode/'.$snomed_data['umc_id'].'/s').'">Edit</a> <span> | </span>';
                                                    echo '<a href="'.base_url('index.php/doctor/deleteSnomedCode/'.$snomed_data['umc_id'].'/s').'" style="color: #9C0000;">Delete</a>';
                                            }else{
                                                echo '<img style="cursor:pointer;" data-toggle="modal" data-target="#snomed_code_'.$snomed_data['umc_code'].'" src="'.base_url('assets/img/chat_comments.png').'"></td>';
                                            }
                                            ?>
                                            </td>
                                        </tr>
                                        <div id="snomed_code_<?php echo $snomed_data['umc_code']; ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Send Recommendation</h4>
                                                    </div>
                                                    <div class="modal-body snomed_privmsg_form">
                                                        <div class="form-group">
                                                            <input readonly="" type="text" name="privmsg_subject" value="Snomed Recommendation <?php echo $snomed_data['umc_code']; ?>" id="privmsg_subject" maxlength="" size="40" class="form-control" placeholder="Subject">
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea name="privmsg_body" cols="80" rows="5" id="privmsg_body" class="form-control" placeholder="Message"></textarea>
                                                        </div>
                                                        <div class="from-group">
                                                            <input type="hidden" name="admin_id" value="<?php echo $snomed_data['umc_added_by']; ?>">
                                                            <button type="button" class="btn btn-primary btn-rounded pull-right snomed_code_privmsg">Send Recommendation</button>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { echo 'No Record Added Yet!'; } ?>
                </div>
            </div>
         </div>
        </div>
    </div>
