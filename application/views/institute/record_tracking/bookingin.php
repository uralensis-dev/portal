<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script type="text/javascript" src="<?php echo base_url();?>assets/newtheme/js/jquery-3.2.1.min.js"></script>

<style type="text/css">
    .nav-tabs.nav-tabs-solid>li {
        margin-bottom: 6px;
    }
    div.dataTables_wrapper div.dataTables_length select{height: auto}

    .nav-tabs.nav-tabs-solid>li>a {
        color: #fff;
        margin-left: 10px;
        font-size: 20px;
        font-family: inherit;
        border-radius: 0px !important;
        padding: 15px 20px;
        float: left;
    }
    .tooltipIcon img {
        max-width: 34px;
        margin-top: 10px;
    }
    .submit_all button {
        min-width: 150px;
        border-radius: 30px;
        padding: 10px;
    }
    
    .btn-link:hover{
        text-decoration: none;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding-left: 45px;
    }

    #template_preview .card {
        min-height: 475px;
    }

    .custom_card .card {
        min-height: 597px;
    }
    /*thead tr th{background: #fff;}*/

    span.tooltipIcon {
        position: absolute;
        top: 0px;
        left: 17px;
        display: none;
    }

    button.add_temp {
        height: auto;
        right: 0;
        padding: 0 12px;
        width: auto;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .fa-file-o {
        position: absolute;
        left: 20px;
        width: 40px;
        text-align: center;
        font-size: 32px;
        z-index: 99;
        top: 15px;
    }
    .page-header .breadcrumb {
        background-color: transparent;
        color: #6c757d;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 0;
        padding: 0;
    }
    .custom-table tbody tr:nth-child(odd) td{
        background: #f8f8f8;
    }

    .page-header .breadcrumb a {
        color: #333;
    }

    .breadcrumb-item.active {
        color: #6c757d;
    }


    #barcode_no {
        height: 50px;
    }

    .nav-tabs.nav-tabs-solid>li>.dropdown-action {
        float: right;
    }

    .dropdown-menu-right a.dropdown-item {
        background: transparent;
        color: #222;
        font-size: 14px;
    }

    .nav-tabs.nav-tabs-solid>li>a:hover,
    .nav-tabs.nav-tabs-solid>li>a:focus {
        background-color: #00c5fb !important;
        border-color: #00c5fb !important;
        color: #fff !important;
    }

    .list_view {
        display: none;
    }

    .show {
        display: block;
    }

    .hide {
        display: none;
    }

    .cog-class {
        line-height: 1;
        margin-top: 10px;
    }

    .fa-th:before {
        content: "\f00a" !important;
    }

    a.action-icon.dropdown-toggle {
        background: #1b75cd;
        color: #fff;
        padding: 0 10px;
        height: 51px;
        border-radius: 0 !important;
        padding: 13px;
    }

    a.action-icon.dropdown-toggle:hover,
    a.action-icon.dropdown-toggle:focus {
        background-color: #00c5fb !important;
        border-color: #00c5fb !important;
        color: #fff !important;
    }

    .card {
        margin-bottom: 0;
    }

    .accordion-button {
        font-size: 1.5rem;
    }

    #patient-table tbody tr:hover {
        background-color: lightblue;
        cursor: pointer;
    }

    .page-wrapper.sidebar-patient {
        padding: 75px 30px 0;
    }

    .danger-text { 
        color: red;
    }

    #speciality-container {
        display: flex;
        flex-wrap: wrap;
    }

    .speciality-box {
        min-width: 200px;
        margin-right: 20px;
        padding: 20px 25px;
        border-radius: 12px;
        margin-bottom: 50px;
        box-shadow: 5px 5px 20px rgba(200, 200, 200, 0.7);
        cursor: pointer;
    }

    .selected-speciality {
        background-color: lightblue;
    }

    #next-button {
        position:absolute;
        bottom: 0;
        right: 10px;
        display: none;
    }

    .profile-widget{
        padding: 50px 15px;

    }

    .profile-img{
        width: auto;
        height: auto;
        margin-bottom: 20px;
    }

    .danger-text { 
        color: red;
    }

    #speciality-container {
        display: flex;
        flex-wrap: wrap;
    }


    .speciality-box {
        min-width: 200px;
        margin-right: 20px;
        padding: 20px 25px;
        border-radius: 12px;
        margin-bottom: 50px;
        box-shadow: 5px 5px 20px rgba(200, 200, 200, 0.7);
        cursor: pointer;
    }

    .selected-speciality {
        background-color: lightblue;
    }
</style>
<div class="patient-doctor" style="min-height: 75vh">
    <div class="container-fluid">
        <div class="page-header mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">New Record</li>
                        
                    </ul>
                </div>
                <div class="col pull-right mt-2">
                    <a href="<?php echo base_url('index.php/institute/view_session_records'); ?>" target="_blank">
                        <button title="View Session Records" data-toggle="tooltip" class="btn btn-sm btn-default pull-right" style="padding: 7px;">
                            <img src="<?php echo base_url() ?>assets/institute/img/View-session-b.png" class="img-responsive" style="max-width: 40px;">
                        </button>
                    </a>
                    <button title="Create New Session List" data-toggle="tooltip" class="btn btn-sm btn-default pull-right create_sess_list_btn" style="padding: 7px;  margin-right:10px">
                        <img src="<?php echo base_url() ?>assets/institute/img/Create-session-b.png" class="img-responsive" style="max-width: 40px;">
                    </button>

                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <section>
            <div class="row">
                <div class="col-md-8  mb-4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-5 mb-2"><strong>Laboratory:</strong> <span id="p_lab"> Manhattan District Lab </span> 
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-7 mb-2"><strong>Specialty: </strong> <span id="p_sep"> Histopathology </span>
                        <button class="btn btn-primary btn-sm ml-5 " data-toggle="modal" data-target="#openLabs">Change</button> 
                        </div>
                    </div>
                </div>
            </div>

            

            <div class="clearfix"></div>
             <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 offset-3">
                        <div class="form-group">
                            <i class="fa fa-file-o"></i>
                            <select data-placeholder="My Templates" name="template_name" id="template_name" class="form-control select2 input-lg">
                                <option value=""></option>
                                                            </select>
                            <span class="tooltipIcon" data-toggle="tooltip" title="Pathologist/Specialty/Clinic/Physician/Specimen No.">
                                <img src="<?php echo base_url();?>assets/institute/img/infoIcon.png">
                            </span>
                            <button type="button" class="btn btn-primary add_temp" data-toggle="modal" data-target="#add_temp">
                                <i class="fa fa-plus"></i></button>
                              
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body px-0 py-2">
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label for="">Template Name</label>
                                                <input type="text" class="form-control"/>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="">Template Author</label>
                                                <input type="text" class="form-control"/>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="">Template Referance No.</label>
                                                <input type="text" class="form-control"/>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Date &amp; Time</label>
                                                <input type="text" class="form-control datetimepicker"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body px-0 py-2">
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label for="">Hospitals</label>
                                                <select class="form-control">
                                                    <option>Select Hospital</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="">Clinician</label>
                                                <select class="form-control">
                                                    <option>Select Clinician</option>
                                                </select>
                                            </div>

                                            <div class="col-md-12 form-group">
                                                <label for="">Location</label>
                                                <select class="form-control">
                                                    <option>Select Location</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12" style="visibility: hidden">
                                                <label for="">test</label>
                                                <select class="form-control">
                                                    <option>tests</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body px-0 py-2">
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label for="">Pathologist</label>
                                                <select class="form-control">
                                                    <option>Select Pathologist</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="">Location</label>
                                                <select class="form-control">
                                                    <option>Select Location</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="">Departments</label>
                                                <select class="form-control">
                                                    <option>Select Department</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Specimen Type</label>
                                                <select class="form-control">
                                                    <option>Select Specimen Type</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-8 mx-auto">
                <div class="row mb-3">
                    <div class="col-md-12 mb-3 text-center">
                        <h3>Order Entry</h3>
                    </div>
                    <div class="col-sm-4 user-card">
                        <div class="profile-widget">

                            <div class="profile-img">

                                <a href="javascript:;" class="avatar" style="max-width: 50px; max-height: 50px;">
                                    <img src="<?php echo base_url();?>assets/img/user.jpg" alt="">
                                </a>

                            </div>

                            <h4 class="user-name m-t-10 mb-0 text-ellipsis" >
                                <button class="btn btn-link collapsed accordion-button find_a_patient_btn">
                                    By Patient
                                </button>
                            </h4>

                        </div>
                    </div>
                    <div class="col-sm-4 user-card">
                        <div class="profile-widget">

                            <div class="profile-img">
                                <a href="javascript:;" class="avatar" style="max-width: 50px; max-height: 50px;">
                                    <img src="<?php echo base_url();?>assets/img/user.jpg" alt="">
                                </a>
                                <a href="javascript:;" class="avatar" style="max-width: 50px; max-height: 50px;">
                                    <img src="<?php echo base_url();?>assets/img/user.jpg" alt="">
                                </a>
                                <a href="javascript:;" class="avatar" style="max-width: 50px; max-height: 50px;">
                                    <img src="<?php echo base_url();?>assets/img/user.jpg" alt="">
                                </a>
                            </div>

                            <h4 class="user-name m-t-10 mb-0 text-ellipsis">
                                <button class="btn btn-link accordion-button by_batch_btn" type="button">
                                    By Batch
                                </button>

                            </h4>

                        </div>
                    </div>
                     <div class="col-sm-4 user-card">
                        <div class="profile-widget">

                            <div class="mb-5">
                                <input type="file" name="" value="Uplaod File">
                                
                            </div>

                           <button class="btn btn-default">Bulk Upload</button>


                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                </div>
            </div>
            <div class="clearfix"></div>

        </section>
        <section class="mb-5">
            <div class="col-md-12 find_a_patient form-group hidden" id="patient-booking">
                <div class="row">
                    <div class="col-md-6 section_title"><strong>Find a Patient</strong></div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-info"><i class="fa fa-plus"></i> Add Record</button>
                    </div>
                    
                </div>
                <div class="table-responsive">
                    <table class="table custom-table datatable">
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>NHS Number</th>
                                <th>DOB</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Aaron Gray</td>
                                <td>0797738859</td>
                                <td>1955-06-24</td>
                                <td>66</td>
                                <td>Male</td>
                                <td><button class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Select</button></td>
                            </tr>
                             <tr>
                                <td>Aaron Gray</td>
                                <td>0797738859</td>
                                <td>1955-06-24</td>
                                <td>66</td>
                                <td>Male</td>
                                <td><button class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Select</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 by_batch form-group hidden" id="batch-bookingin">
                <div class="doctorSCard">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <h4>Laboratory Specimen No.</h4>
                        </div>
                        
                        <div class="col-sm-6 col-md-7">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" value="<?php print "NP-21-".rand(10000,99999);?>" id="barcode_no" name="barcode_no">
                                <label class="focus-label">Search / Add Record (Lab No.)</label>
                            </div>
                        </div>
                        <div class="col-md-2 nopadding">
                            <button class="btn btn-success btn-block btn-lg search_btn barcode_no_search" style="font-size:13px">Add Record</button><div class="col-sm-2">
                            <div class="row">
                             
                                 <div class="col-md-3  col-lg-3 col-xl-3 nopadding" style="display:none">
                                    <a href="javascript:;" class="list_view_show"><i class="fa fa-th fa-bars fa-2x cog-class"></i></a>
                                </div>
                            </div>
                        </div>
                        </div> 
                        
                    </div>
                </div>
                <div class="record_add_result">
                    <table class="track_search_table table table-stripped custom-table datatable">
                        <thead>
                            <tr>
                                <th>UL No.</th>
                                <th>Track No.</th>
                                <th>Client</th>
                                <th>First Name</th>
                                <th>Surname</th>
                                <th>DOB</th>
                                <th>NHS No.</th>
                                <th>Lab No.</th>
                                <th>Statuses</th>
                                <th>Flag</th>
                                <th>TAT</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="clearfix"></div>
            
        </section>
    </div>
</div>




<div class="modal fade" id="openLabs" tabindex="-1" role="dialog" aria-labelledby="openLabs" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="openLabs">Hospitals</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <select name="lab_name" id="lab_name" class="form-control  input-lg select2">
                    <option value="">Select Hospital</option>
                    <option value="44">manhattandistrictlab</option>
                    <option value="46">CancerService</option>
                </select>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Save</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add_temp">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Template</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                        <strong>Laboratory:</strong> 
                        <span id="p_lab"> Manhattan District Lab </span> 
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                        <strong>Specialty: </strong> 
                        <span id="p_sep"> Histopathology </span>
                    </div>
                </div>
                <div class="row">
                    <input type="hidden" name="edit_mod" value="add">
                    <div class="col-md-6 form-group ">
                        <label class="focus-label">Template Name</label>
                        <input type="text" name="template_name_pop" value="Template-H-1255" class="form-control input-lg">
                    </div>
                    <div class="col-md-6 form-group ">
                        <label class="focus-label">Template Reference No.</label>
                        <input type="text" name="temp_reff_no_add" value="HSH-21-0845" class="form-control input-lg">
                    </div>
                    <div class="col-md-6 form-group ">
                        <label class="focus-label">Template Author</label>
                        <input type="text" name="temp_author" class="form-control input-lg" value="megan.burns1@nhs.net">
                    </div>
                    <div class="col-md-6 form-group ">
                        <label class="focus-label">Date and Time</label>
                        <div class="cal-icon">
                            <input name="dateandtime" class="form-control input-lg datetimepicker" type="text" value="2021-11-30">
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="focus-label">Clinic</label>
                        <select name="hospital_id" class="clinician_pop form-control select2 ">
                            <option>Clinic</option>
                            <option>Newlife Hospital</option>
                            <option>Care & Cure Hospital</option>
                            <option>Rejuvenate Hospital</option>
                            <option>Redstar Hospital</option>
                            <option>redlifeexpresscare</option>
                            <option>testlab1</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="focus-label">Pathologist</label>
                        <select name="pathologist_pop" class="select2">
                            <option>Andrew Patterson</option>
                            <option>Mark Edwards</option>
                            <option>Jennifer Rees</option>
                            <option>Tim Jones</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="focus-label">Clinician</label>
                        <select name="clinician_pop" class="clinician_pop form-control select2 ">
                            <option>Clinician</option>
                            <option>Amelia Thompson</option>
                            <option>Abigail Tucker</option>
                            <option>Clark Holmes</option>
                            <option>Rafael Davis</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group ">
                        <label class="focus-label">Specimen</label>
                        <div id="spctype_div mb-3">
                            Multiple <input type="checkbox" name="multiple"/>
                            Matching <input type="checkbox" name="matching"/>
                        </div>
                    </div>

                    <div class=" col-md-12 text-center submit_all">
                        <button class="btn btn-info" id="save-track-template-add">Submit</button>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $(".find_a_patient_btn").click(function(){
            $(".find_a_patient").toggleClass("hidden");
            $(".by_batch").addClass("hidden");

        });
        $(".by_batch_btn").click(function(){
            $(".by_batch").toggleClass("hidden");
            $(".find_a_patient").addClass("hidden");

        });
    });
</script>