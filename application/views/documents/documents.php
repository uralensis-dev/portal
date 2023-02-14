<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" /> -->
<link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet" />
<style type="text/css">
    .page-header {
        margin:0 0 1.875rem;
        border-bottom:0px;
    }
    .content{background: #f5f5f5}
    
    /*div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top:-58px;
        height: 37px !important;
        width: 50px !important;
        left: 29px;
        padding:0;
    }*/
    /*div.dataTables_wrapper div.dataTables_filter{display: none !important}*/
    div.dataTables_wrapper div.dataTables_length select{
        padding: 0 8px;
    }
    table.dataTable thead > tr > th{font-weight: 600 !important;}
    .edit_icon {
        background: #e5e5e5;
        width: 30px;
        height: 30px;
        text-align: center;
        line-height: 1.7;
        font-size: 18px;
        border-radius: 15px;
        cursor: pointer;
        color: #000;
    }
    .add-btn {
        background-color: #00c5fb;
        border: 1px solid #00c5fb;
        border-radius: 3px !important;
        color: #fff;
        float: right;
        font-weight: 500 !important;
        min-width: 140px;
        font-size: 16px;
    }
    .add-btn:hover,
    .add-btn:focus{
        color: #fff !important;
    }
    .add-btn i {
        margin-right: 5px;
    }
    /*div.dataTables_wrapper div.dataTables_filter label{
    margin: 0;
        }

        .tg-searchrecordhold{padding: 0;}

    .user_image{
        width: 50px;
        border-radius: 30px;
    }
    div.dataTables_wrapper div.dataTables_filter {
        position: relative;
        top: -52px;
        right: 60px;
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
        right: 0;
        top: 0;
        bottom: 0;
        width: 40px;
        z-index: 9;
        background: #55ce63;
        text-align: center;
        line-height: 2;
        color: #fff;
        font-family: 'FontAwesome';
        cursor: pointer;
    }
    .dataTables_wrapper .row:first-child{height: 1px;}
    
    .doct_pic_table{
        width: 40px;
        float: left;
        border-radius: 20px;
        margin-right: 5px;
    }*/
    /*.table.custom-table .dropdown-menu .dropdown-item{font-size: 14px;}*/
    /*.ubpub_pic{width: 25px; margin: 0 auto;}
    .record_id_unpublish:focus{outline: none;}
    .user-menu.nav > li > a > img{padding-top: 19px;}
    #admin_display_records.table > thead > tr > th:last-child,
    #admin_display_records.table > tbody > tr > td:last-child{
        text-align: right;
    }*/
    /*div.dataTables_wrapper div.dataTables_length select{
        padding: 0 10px;
    }*/
    /*.tg-cancel input{
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
    }*/
    /*div.dataTables_wrapper .dataTables_filter {
        display: block !important;
    }
    @media screen and (min-width: 1480px){
        div.dataTables_wrapper div.dataTables_filter{
            top:-58px;
            right: 70px;
        }
    }*/
    /*.tg-statusbar.tg-flagcolor .tg-checkboxgroup .tg-radio label{font-size: 14px;}
    .tg-filters > li.last .adv-search{line-height: 1.5;}
    .viewerCount {
        font-size: 18px;
        color: darkturquoise;
    }*/
</style>
<div class="page-header breadcrimsetup">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title m-0">Documents</h3>
            <div class="tg-breadcrumbarea">
            <ol class="tg-breadcrumb tg-breadcrumbvtwo">
                <li class=""><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                <li class="active"><a href="<?php echo base_url('patient'); ?>">Patients</a></li>
</ol> 
</div>
        </div>
        <div class="col-auto float-right ml-auto">
            <div class="tg-breadcrumbarea tg-searchrecordhold hidden">
            <?php echo $breadcrumbs; ?>
            <div class="tg-rightarea">
                <div class="tg-haslayout">
                    <div class="row hidden">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopadding-right">
                            <div class="tg-filterhold">
                                <ul class="tg-filters record-list-filters ">
                                    <li class="tg-statusbar tg-flagcolor" style="padding-right: 10px !important;">
                                        <div class="tg-checkboxgroup tg-checkboxgroupvtwo">
                                            <?php $hospitals = getAllHospitals(); ?>
                                            <?php foreach($hospitals as $hospital): ?>
                                            <span title="<?php echo $hospital['description']?>" class="tg-radio tg-flagcolor1">
                                                <input value="<?php echo $hospital['first_initial']?><?php echo $hospital['last_initial']?>" class="filter_by_hospital_btn" name="hostpital" id="<?php echo $hospital['first_initial']?><?php echo $hospital['last_initial']?>"  type="radio">
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
            
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_doc"><i class="fa fa-plus"></i>New Documents</a>
            
        </div>
    </div>
</div>
<!-- /Page Header -->
<div class="tg-haslayout" >
        <div class="row hidden" >
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-filterhold" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                        
                        <li class="tg-flagcolor" style="padding: 3px 8px; display:none">
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
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors last float-right" style="padding: 0 10px;">                              
                            <button type="submit" class="btn btn-default adv-search" data-toggle="collapse" data-target="#collapse_adv_search"><i class="fa fa-cog"></i></button>
                        </li>
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors float-right nobefore search_li" style="padding: 0">
                            <!-- <div class="input-group">
                                <input id="unpub_custom_filter" type="text" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                  <button class="btn btn-success" type="submit">
                                    <i class="fa fa-search"></i>
                                  </button>
                                </div>
                            </div> -->
                        </li>
                    </ul>
                </div>
            </div>
        </div>
</div>
<div class="tg-dashboardform tg-haslayout custom-haslayout hidden">
    <div class="collapse" id="collapse_adv_search">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-dashboardformhold">
                    <form class="tg-formtheme" action="<?php echo base_url('index.php/doctor/search_request'); ?>" method="post">
                        <fieldset class="row col-md-12">
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
                        <fieldset class="col-md-12 row" style="padding-top: 10px !important;">
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
                                <input type="hidden" name="speciality_group_hdn" value="<?php echo $speciality_group_hdn; ?>">
                                <button type="submit" class="btn btn-success btn-search">Advance Search</button>
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
                        <table class="table table-bordered">
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
<!-- <div class="row mb-3">
    <div class="col text-right">
        <?php foreach ($hospitals as $h) : ?>
            <div data-toggle="tooltip" data-placement="top" title="<?php echo $h['description']; ?>" class="hospital-info"><?php echo $h['first_initial'] . $h['last_initial'] ?></div>
        <?php endforeach; ?>
        <span class="lnr lnr-cross-circle" id="clear-hospital" style="margin-left: 10px; position: relative; top: 4px; cursor: pointer;"></span>
    </div>
</div>
 -->

<?php if ($this->session->flashdata('upload_error') != '') { ?>
    <div class="error_list" style="color: red;">
        <?= $this->session->flashdata('upload_error'); ?>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('upload_success') != '') { ?>
    <div class="success_list" style="color: green;">
        <?= $this->session->flashdata('upload_success'); ?>
    </div>
<?php } ?>

<div class="">
    <table class="table custom-table table-striped" id="document-table" style="width: 100%;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Document</th>
                <th>Type</th>
                <th>Assigned To</th>
                <th>Viewer</th>
                <th>Uploaded By</th>
                <th>Upload Date</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $no = 1;
            if (!empty($upload_docs)) {
                foreach ($upload_docs as $row) { ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row->name; ?></td>
                    <td><?= $row->file_name; ?></td>
                    <td><?= $row->file_type; ?></td>
                    <td><?= $row->assign_to; ?></td>
                    <td>
                        <?php if($row->viewer > 0){ ?>
                            <a href="<?= base_url('documents/viewer_list/'.$row->id); ?>" title="Viewer List" class="viewerCount"><?= $row->viewer; ?></a>
                        <?php } else { ?>
                            <a href="javascript:void();" title="No Viewer" class="viewerCount"><?= $row->viewer; ?></a>
                        <?php } ?>
                    </td>
                    <td><?= $row->last_name." ".$row->first_name; ?></td>
                    <td><?= date('d/m/Y H:i:s', strtotime($row->uploaded_at)); ?></td>
                    <td class="text-right">
                        <a class="" href="javascript:void(0)" data-toggle="modal" data-target="#view_doc" onclick="embed_document2('<?= base_url($row->file_path); ?>')"><i class="fa fa-eye m-r-5"></i> </a>
                        <a class="" href="javascript:delete_document('<?= base_url('documents/delete_upload_docs/'.$row->id); ?>')" ><i class="fa fa-trash-o m-r-5"></i> </a>

                        <!-- <div class="dropdown dropdown-action text-right" style="width=100%">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#view_doc" onclick="embed_document2('<?= base_url($row->file_path); ?>')"><i class="fa fa-eye m-r-5"></i> View </a>
                                <a class="edit_doc_data" href="javascript:void(0)" data-toggle="modal" data-target="#edit_doc" data-row='<?= json_encode((array) $row); ?>'><i class="fa fa-pencil m-r-5"></i> Edit </a>
                                <a class="dropdown-item" href="<?= base_url('documents/download_forms/'.$row->file_name); ?>" ><i class="fa fa-cloud-download m-r-5"></i>Download</a>
                                <a class="dropdown-item" href="<?= base_url('documents/delete_upload_docs/'.$row->id); ?>" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                            </div> -->
                        </div>
                    </td>
                </tr>
            <?php $no++; } } else { echo '<tr><td colspan="9" class="text-center" style="font-weight: bold; color: red;"> No record found</td></tr>'; } ?>
        </tbody>
    </table>
</div>


<div id="add_doc" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">New Document</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tg-editformholder">
                    <?php echo form_open_multipart('documents/upload_files', array('class' => 'tg-formtheme tg-editform', 'id' => 'upload_document_form', 'name' => 'upload_document_form')); ?>
                    <?php //echo form_open('', array('id' => 'add-patient-form', 'class' => 'tg-formtheme tg-editform create_user_form')); ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <!-- Patient Personal Information START -->
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="tg-inputwithicon">
                                            <input type="text" name="name" value="" class="form-control" placeholder="Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <select name="assign_to" id="" class="form-control" required>
                                            <option value="">Assigned To</option>
                                            <option value="Hospital">Hospital</option>
                                            <option value="Laboratory">Laboratory</option>
                                            <option value="Pathologist">Pathologist</option>
                                            <option value="Clinician">Clinician</option>
                                            <option value="All">All</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="tg-inputwithicon">
                                            <input type="file" name="upload_doc" class="form-control" placeholder="Upload pdf | doc | jpg | png">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="tg-inputwithicon">
                                            <select name="file_type" value="" class="form-control" required>
                                                <option value="SOP Form">SOP's</option>
                                                <option value="Request Form">Request Form</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div class="form-group1">
                                            <button class="btn btn-success" id="user-create-btn">Uplaod Document</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                            </fieldset>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="edit_doc" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Update Document</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tg-editformholder">
                    <?php echo form_open_multipart('documents/update_document_data', array('class' => 'tg-formtheme tg-editform', 'id' => 'upload_edit_document_form', 'name' => 'upload_edit_document_form')); ?>
                    <?php //echo form_open('', array('id' => 'add-patient-form', 'class' => 'tg-formtheme tg-editform create_user_form')); ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <!-- Patient Personal Information START -->
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="tg-inputwithicon">
                                            <input type="hidden" name="id" value="" id="doc_id" />
                                            <input type="text" name="name" id="name" value="" class="form-control" placeholder="Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <select name="assign_to" class="form-control" id="assign_to" required>
                                            <option value="">Assigned To</option>
                                            <option value="Hospital">Hospital</option>
                                            <option value="Laboratory">Laboratory</option>
                                            <option value="Pathologist">Pathologist</option>
                                            <option value="Clinician">Clinician</option>
                                            <option value="All">All</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="tg-inputwithicon">
                                            <input type="file" name="upload_doc" class="form-control" placeholder="Upload pdf | doc | jpg | png">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="tg-inputwithicon">
                                            <select name="file_type" id="file_type" value="" class="form-control" required>
                                                <option value="SOP Form">SOP's</option>
                                                <option value="Request Form">Request Form</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div class="form-group1">
                                            <button class="btn btn-success" id="user-create-btn">Update</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                            </fieldset>
                        </div>
                    </div>
                    </form>
                </div>
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

            </div>
            <div class="modal-footer">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<div class="modal custom-modal fade" id="delete_document_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Document</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary continue-btn document-delete-btn">Delete</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-dismiss="modal"
                                class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.edit_doc_data', function (){
            let arr = $(this).attr('data-row');
            let dataArr = JSON.parse(arr);
            $(document).find('#edit_doc').find('#doc_id').val(dataArr.id);
            $(document).find('#edit_doc').find('#name').val(dataArr.name);
            $(document).find('#edit_doc').find('#assign_to').val(dataArr.assign_to);
            $(document).find('#edit_doc').find('#file_type').val(dataArr.file_type);
        });
    });
</script>