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
        position: absolute;
        top:-65px;
        height: 37px !important;
        width: 50px !important;
        left: 29px;
        padding:0;
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
</style>
<div class="container-fluid">
    <div class="col-xs-6">
        <h3 class="page-title">Microscopic Codes</h3>
        <div class="clearfix"></div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo  site_url('/doctor'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:;">Microscopic Codes</a></li>
            <!-- <li class="breadcrumb-item active">Records</li> -->
        </ul>
        <?php //echo !empty($breadcrumbs) ? $breadcrumbs : ''; ?>
    </div>
    <div class="col-xs-6 form-group text-right">
        <div class="micro_msg"></div>
        <button type="button" class="btn btn-success btn-rounded btn-lg" data-toggle="modal" data-target="#add_micro_codes">Add Microscopic Codes</button>
        <a href="<?php echo base_url('index.php/admin/download_microscopic_code_csv'); ?>" class="btn btn-info btn-lg btn-rounded">Download CSV</a>
        <div class="clearfix"></div>
    </div>
    <?php $userid = $this->ion_auth->user()->row()->id; ?>
    
    
    <div class="clearfix"></div>
    <!-- <div class="tg-rightarea">
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
    </div> -->
    <div class="tg-haslayout">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
<!--                        -->
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

    <div id="add_microscopic_codes">
        <div class="row">
            <div class="col-md-12 microscopic">
                <table id="microscopic_code_table" class="table table-striped custom-table custom-search-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Diagnoses</th>
                            <th>T Code</th>
                            <th>T2 Code</th>
                            <th>M Code</th>
                            <th>P Code</th>
                            <th>CLassification</th>
                            <th>Cancer Reg</th>
                            <th>RCPath</th>
                            <th>Added</th>
                            <th>Status</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($micro_codes)) { ?>
                            <?php foreach ($micro_codes as $codes) { ?>
                                <tr>
                                    <td><?php echo $codes->umc_code; ?></td>
                                    <td><?php echo $codes->umc_title; ?></td>
                                    <td><?php echo $codes->umc_micro_desc; ?></td>
                                    <td><?php echo $codes->umc_disgnosis; ?></td>
                                    <td><?php echo $codes->umc_snomed_t_code; ?></td>
                                    <td><?php echo $codes->umc_snomed_t2_code; ?></td>
                                    <td><?php echo $codes->umc_snomed_m_code; ?></td>
                                    <td><?php echo $codes->umc_snomed_p_code; ?></td>
                                    <td><?php echo $codes->umc_classification; ?></td>
                                    <td><?php echo $codes->umc_cancer_register; ?></td>
                                    <td><?php echo $codes->umc_rcpath_score; ?></td>
                                    <td><?php echo uralensisGetUsername($codes->umc_added_by, 'fullname'); ?></td>
                                    <td><?php echo $codes->umc_status; ?></td>
                                    <td>
                                    <?php 
                                        if($userid === $codes->umc_added_by) {
                                                echo '<a href="'.base_url('index.php/doctor/editMicroCode/'.$codes->umc_id).'">Edit</a>';
                                        }else{
                                            echo '<i style="cursor:pointer; font-size:28px" data-toggle="modal" data-target="#micro_code_'.$codes->umc_id.'" class="fa fa-comment-o"></i></td>';
                                        } 
                                    ?>
                                    </td>
                                </tr>
                                <div id="micro_code_<?php echo $codes->umc_id; ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Send Recommendation</h4>
                                        </div>
                                        <div class="modal-body micro_code_privmsg_form">
                                            <div class="form-group">
                                                <input readonly="" type="text" name="privmsg_subject" value="Micro Code Recommendation <?php echo $codes->umc_code; ?>" id="privmsg_subject" maxlength="" size="40" class="form-control" placeholder="Subject">
                                            </div>
                                            <div class="form-group" style="overflow:hidden">
                                                <textarea name="privmsg_body" cols="80" rows="5" id="privmsg_body" class="form-control" placeholder="Message"></textarea>
                                            </div>
                                            <div class="from-group">
                                                <input type="hidden" name="admin_id" value="<?php echo $codes->umc_added_by; ?>">
                                                <button type="button" class="btn btn-success btn-lg btn-rounded pull-right micro_code_privmsg_btn">Send Recommendation</button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="add_micro_codes" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Microscopic Information</h4>
                </div>

                <div class="modal-body">
                    <div class="display_msg"></div>
                    <form class="form" id="add_microscopic_codes_form">
                        <div class="form-group">
                            <label for="micro_code">Microscopic Code</label>
                            <input type="text" class="form-control" name="micro_code" id="micro_code">
                        </div>
                        <div class="form-group">
                            <label for="micro_title">Microscopic Title</label>
                            <input type="text" class="form-control" name="micro_title" id="micro_title">             
                        </div>
                        <div class="form-group">
                            <label for="micro_desc">Microscopic Description</label>
                            <textarea type="text" class="form-control" name="micro_desc" id="micro_desc"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="micro_diagnose">Microscopic Diagnosis</label>
                            <input type="text" class="form-control" name="micro_diagnose" id="micro_diagnose">
                        </div>
                        <div class="form-group">
                            <label for="micro_sno_t_code">Microscopic Snomed T Code</label>
                            <input type="text" class="form-control" name="micro_sno_t_code" id="micro_sno_t_code">
                        </div>
                        <div class="form-group">
                            <label for="micro_sno_t2_code">Microscopic Snomed T2 Code</label>
                            <input type="text" class="form-control" name="micro_sno_t2_code" id="micro_sno_t2_code">
                        </div>
                        <div class="form-group">
                            <label for="micro_sno_m_code">Microscopic Snomed M Code</label>
                            <input type="text" class="form-control" name="micro_sno_m_code" id="micro_sno_m_code">
                        </div>
                        <div class="form-group">
                            <label for="micro_sno_p_code">Microscopic Snomed P Code</label>
                            <input type="text" class="form-control" name="micro_sno_p_code" id="micro_sno_p_code">
                        </div>
                        <div class="form-group">
                            <label for="micro_classi">Microscopic Classification</label>
                            <input type="text" class="form-control" name="micro_classi" id="micro_classi">
                        </div>
                        <div class="form-group">
                            <label for="micro_canc_reg">Microscopic Cancer Register</label>
                            <input type="text" class="form-control" name="micro_canc_reg" id="micro_canc_reg">
                        </div>
                        <div class="form-group">
                            <label for="micro_rcpath">Microscopic RCPath Score</label>
                            <input type="text" class="form-control" name="micro_rcpath" id="micro_rcpath">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-success btn-lg " id="save_micro">Add Microscopic Code</button>
                        </div>
                    </form>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div> -->
            </div>

        </div>
    </div>
    
</div>