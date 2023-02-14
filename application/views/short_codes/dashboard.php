<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    .hidden{
        display: none;;
    }
</style>
<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Dashboard Codes</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Shortcodes</li>
            </ul>
        </div>
    </div>
</div>
<!-- /Page Header -->

<!-- /Page Dashboard Cards -->
<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
                <div class="dash-widget-info sc_open">
                    <h3>Short Codes</h3>
                    <span><a href="javascript:;">Macro & Micro</a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
                <div class="dash-widget-info sn_open">
                    <h3 class="text-uppercase">Snomed</h3>
                    <span style="visibility:hidden"><a href="javascript:;">admin</a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
                <div class="dash-widget-info icd_open">
                    <h3>ICD-10CM-Codes</h3>
                    <span style="visibility:hidden"><a href="javascript:;">admin</a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
                <div class="dash-widget-info cpt_open">
                    <h3>CPT Codes</h3>
                    <span style="visibility:hidden"><a href="javascript:;">admin</a></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <?php $userid = $this->ion_auth->user()->row()->id; ?>

    <div class="col-md-12 sc_opener hidden">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <input type="text" name="" class="form-control" placeholder="Search" />
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="list-item">M2034BCC</li>
                            <li class="list-item">M2034BCC</li>
                            <li class="list-item">M2034BCC</li>
                            <li class="list-item">M2034BCC</li>
                            <li class="list-item">M2034BCC</li>
                            <li class="list-item">M2034BCC</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <textarea rows="7" class="form-control" placeholder="Codes Description"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="">T1</label>
                                <select name="" id="" class="form-control">
                                    <option>Select T1</option>
                                    <option>Select T1</option>
                                    <option>Select T1</option>
                                    <option>Select T1</option>
                                    <option>Select T1</option>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">T2</label>
                                <select name="" id="" class="form-control">
                                    <option>Select T2</option>
                                    <option>Select T2</option>
                                    <option>Select T2</option>
                                    <option>Select T2</option>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">P</label>
                                <select name="" id="" class="form-control">
                                    <option>Snomed P </option>
                                    <option>Snomed P </option>
                                    <option>Snomed P </option>
                                    <option>Snomed P </option>
                                    <option>Snomed P </option>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">M</label>
                                <select name="" id="" class="form-control">
                                    <option>Snomed M</option>
                                    <option>Snomed M</option>
                                    <option>Snomed M</option>
                                    <option>Snomed M</option>
                                    <option>Snomed M</option>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">RCPath</label>
                                <select name="" id="" class="form-control">
                                    <option>Snomed M</option>
                                    <option>Snomed M</option>
                                    <option>Snomed M</option>
                                    <option>Snomed M</option>
                                    <option>Snomed M</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Doc</div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="list-item">Created</li>
                            <li class="list-item">Edited</li>
                            <li class="list-item">Deleted</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="card">
            <div class="card-header">
                <h3 class="card-title">Short Codes</h3>
            </div>
            <div class="card-body" style="min-height: 440px;">
                 <div id="add_microscopic_codes">
                     <?php $userid = $this->ion_auth->user()->row()->id; ?>
                     <div class="col-md-12 form-group">
                         <div class="micro_msg"></div>
                         <button type="button" class="btn btn-info pull-left" data-toggle="modal" data-target="#add_micro_codes">Add Microscopic Codes</button>
                         <a href="<?php echo base_url('index.php/admin/download_microscopic_code_csv'); ?>" class="btn btn-primary pull-right">Download CSV</a>
                         <div class="clearfix"></div>
                     </div>
                        <div class="row">
                            <div class="col-md-12 microscopic">
                                <table id="microscopic_code_table" class="table table-striped table-responsive custom-table" cellspacing="0" width="100%">
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
                                                            echo '<img style="cursor:pointer;" data-toggle="modal" data-target="#micro_code_'.$codes->umc_id.'" src="'.base_url('assets/img/chat_comments.png').'"></td>';
                                                        } 
                                                    ?>
                                                    </td>
                                                </tr>
                                                <div id="micro_code_<?php echo $codes->umc_id; ?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">

                                                            <h4 class="modal-title">Send Recommendation</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                                                                <button type="button" class="btn btn-success pull-right micro_code_privmsg_btn">Send Recommendation</button>
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
            </div>
        </div> -->
    </div>
    <div class="col-md-12 sn_opener hidden">
        <div class="card">
            <div class="card-header text-uppercase">
                <h3 class="card-title">Snomed</h3>
            </div>
            <div class="card-body">
                <!-- <div id="snomed_pie"></div> -->
                 <?php
                        $snomed_codes = getSnomedCodesData('t1');
                        if (!empty($snomed_codes)) { ?>
                            <table id="snomed_t1_code_table" class="table table-striped custom-table">
                                <thead>
                                    <tr>
                                        <th>T1 & T2 Code</th>
                                        <th>Description</th>
                                        <th>Added By</th>
                                        <th>Status</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($snomed_codes as $snomed_data) { ?>
                                        <tr>
                                            <td><?php echo $snomed_data['usmdcode_code']; ?></td>
                                            <td><?php echo $snomed_data['usmdcode_code_desc']; ?></td>
                                            <td><?php echo uralensisGetUsername($snomed_data['snomed_added_by'], 'fullname'); ?></td>
                                            <td><?php echo $snomed_data['snomed_status']; ?></td>
                                            <td>
                                            <?php 
                                            if($userid === $snomed_data['snomed_added_by']) {
                                                    echo '<a href="'.base_url('index.php/doctor/editSnomedCode/'.$snomed_data['usmd_code_id'].'/t1').'">Edit</a>';
                                            }else{
                                                echo '<img style="cursor:pointer; width:40px;" data-toggle="modal" data-target="#snomed_code_'.$snomed_data['usmdcode_code'].'" src="'.base_url('assets/icons/Comments.png').'"></td>';
                                            } 
                                            ?>
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
                                                        <button type="button" class="btn btn-success pull-right snomed_code_privmsg">Send Recommendation</button>
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
    </div>
    <div class="col-md-12 icd_opener hidden">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">ICD-10CM-Codes</h3>
            </div>
            <div class="card-body">
                <h4>2020 ICD-10-CM Codes</h4>
                <ul>
                    <li class="list-item">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                    </li>
                    <li class="list-item">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                    </li>
                    <li class="list-item">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                    </li>
                    <li class="list-item">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-12 cpt_opener hidden">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">CPT Codes</h3>
            </div>
            <div class="card-body">
                <ul>
                    <li class="list-item">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                    </li>
                    <li class="list-item">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                    </li>
                    <li class="list-item">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                    </li>
                    <li class="list-item">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>

<div id="add_micro_codes" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Microscopic Information</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                <div class="display_msg"></div>
                <form class="form" id="add_microscopic_codes_form">
                    <input type="hidden" name="return_url" value="ShortCodes/dashboard">
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
                        <button type="button" class="btn btn-success" id="save_micro">Add Microscopic Code</button>
                    </div>
                </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
        </div>

    </div>
</div>

<!-- /Page Content -->