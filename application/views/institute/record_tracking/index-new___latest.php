<!-- Page Wrapper -->
<style type="text/css">
    .nav-tabs.nav-tabs-solid>li {
        margin-bottom: 6px;
    }

    .nav-tabs.nav-tabs-solid>li>a {
        color: #fff;
        margin-left: 10px;
        font-size: 20px;
        font-family: inherit;
        border-radius: 0px !important;
        padding: 15px 20px;
        float: left;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding-left: 25px;
    }

    #template_preview .card {
        min-height: 475px;
    }

    .custom_card .card {
        min-height: 597px;
    }

    span.tooltipIcon {
        position: absolute;
        top: 0px;
        left: 17px;
    }

    button.add_temp {
        height: auto;
    }

    .fa-file-o {
        position: absolute;
        left: 6px;
        /*border: 1px solid #ddd;*/
        width: 40px;
        /*height: 40px;*/
        text-align: center;
        font-size: 20px;
        z-index: 99;
        top: 30px;
    }

    .page-header .breadcrumb {
        background-color: transparent;
        color: #6c757d;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 0;
        padding: 0;
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

    /*.blue-border {
    border: 1px solid blue !important;
}*/

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

    .page-header .breadcrumb {
        font-size: 16px;
    }
    .profile-widget{
        padding: 50px 15px;

    }
    .profile-img{
        width: auto;
        height: auto;
        margin-bottom: 20px;
    }

    .card-body {
        height: 70vh;
        position: relative;
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
</style>

<?php
$snomed_t_array = getSnomedCodes('t1');
?>
<div>
<div class="page-wrapper patient-doctor no-sidebar">
    <!-- Page Content -->
    <div class="content container-fluid">

        <div class="">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">New Record</li>
                        </ul>
                    </div>
                    <div class="col pull-right">
                        <a href="<?php echo base_url('index.php/institute/view_session_records'); ?>" target="_blank"><button title="View Session Records" data-toggle="tooltip" class="btn btn-sm btn-default pull-right" style="padding: 7px;">
                                <img src="<?php echo base_url() ?>assets/institute/img/View-session-b.png" class="img-responsive" style="max-width: 40px;">
                            </button></a>
                        <button title="Create New Session List" data-toggle="tooltip" class="btn btn-sm btn-default pull-right create_sess_list_btn" style="padding: 7px;  margin-right:10px">
                            <img src="<?php echo base_url() ?>assets/institute/img/Create-session-b.png" class="img-responsive" style="max-width: 40px;">
                        </button>

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

        </div>

        <p id="lab-specialty"></p>
        <section>
            <div class="row">
                <div class="col-12 mb-2"><strong>Lab: </strong>  Andrew Patterson <button class="btn btn-primary btn-sm ml-5">Change</button></div>
                <div class="col-12 mb-2"><strong>Specialty: </strong> Histopathology  <button class="btn btn-primary btn-sm ml-4">Change</button></div>
            </div>
            <div class="col-md-8 mx-auto">
                <div class="row mb-3">
                    <div class="col-sm-6 user-card">
                        <div class="profile-widget">

                            <div class="profile-img">


                                <a href="javascript:;" class="avatar" style="max-width: 50px; max-height: 50px;">
                                    <img src="<?php echo base_url(); ?>uploads/person-male.png"
                                         alt="">
                                </a>

                            </div>

                            <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="javascript:showdiv('patient')">By Patient</a></h4>

                        </div>
                    </div>
                    <div class="col-sm-6 user-card">
                        <div class="profile-widget">

                            <div class="profile-img">
                                <a href="javascript:;" class="avatar" style="max-width: 50px; max-height: 50px;">
                                    <img src="<?php echo base_url(); ?>uploads/person-male.png"
                                         alt="">
                                </a>
                                <a href="javascript:;" class="avatar" style="max-width: 50px; max-height: 50px;">
                                    <img src="<?php echo base_url(); ?>uploads/person-male.png"
                                         alt="">
                                </a>
                                <a href="javascript:;" class="avatar" style="max-width: 50px; max-height: 50px;">
                                    <img src="<?php echo base_url(); ?>uploads/person-male.png"
                                         alt="">
                                </a>
                            </div>

                            <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="javascript:showdiv('batch')">Batch Entry</a></h4>

                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 mx-auto">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating">
                            <label class="focus-label">Search/Add Record</label>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="card" id="dv_batch" style="display:none">
            <!--  				<div class="card-header" id="batch-booking-heading">
                                                    <h2 class="mb-0">
                                                            <button class="btn btn-link accordion-button" type="button" data-toggle="collapse" data-target="#batch-bookingin" aria-expanded="true" aria-controls="batch-bookingin">
                                                                    Booking In By Batch
                                                            </button>
                                                    </h2>
                                            </div>-->

            <div id="batch-bookingin" class="collapse show" aria-labelledby="batch-booking-heading" >
                <div class="card-body mb-5">
                    <div class="doctorSCard">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <h5 class="title_specimen">Laboratory Specimen No.</h5>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <i class="fa fa-file-o"></i>
                                    <select data-placeholder="My Templates" name="template_name" id="template_name" class="form-control select2 input-lg">
                                        <option value=""></option>
                                        <?php foreach ($track_templates as $rec) { ?>
                                            <option value="<?php echo $rec->ura_rec_temp_id ?>"><?php echo $rec->temp_input_name ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="tooltipIcon" data-toggle="tooltip" title="Pathologist/Specialty/Clinic/Physician/Specimen No.">
                                        <img src="<?php echo base_url() ?>assets/institute/img/infoIcon.png">
                                    </span>
                                    <button type="button" class="btn btn-primary add_temp" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#add_temp">
                                            <i class="fa fa-plus m-r-5"></i> Add</a>
                                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#edit_temp"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onClick="DeleteTemplate()"><i class="fa fa-trash-o m-r-5"></i> Delete</a>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating" id="barcode_no" name="barcode_no">
                                    <label class="focus-label">Search / Add Record</label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="row">
                                    <div class="col-md-9 col-lg-9  col-xl-9">
                                        <button class="btn btn-success btn-block btn-lg search_btn barcode_no_search">Search</button>
                                    </div>
                                    <div class="col-md-3  col-lg-3 col-xl-3 nopadding">
                                        <i class="fa fa-cog fa-2x cog-class" data-toggle="collapse" data-target="#adv_searc_area" style="margin-right:5px"></i>
                                        <a href="javascript:;" class="list_view_show"><i class="fa fa-th fa-bars fa-2x cog-class"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card doctorSCard collapse" id="adv_searc_area">
                        <form style="margin-bottom: 0;">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-3 padding-right-5">
                                        <div class="">
                                            <label class="focus-label">First Name</label>
                                            <input class="form-control input-lg " type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-3 padding-left-5">
                                        <div class="">
                                            <label class="focus-label">Last Name</label>
                                            <input class="form-control input-lg " type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-3 padding-left-5">
                                        <div class="">
                                            <label class="focus-label">NHS No.</label>
                                            <input class="form-control input-lg " type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-2 padding-left-5 tg-inputicon">
                                        <div class="">
                                            <div class="cal-icon">
                                                <label class="focus-label">DOB</label>
                                                <input class="form-control input-lg datetimepicker" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 padding-left-5">
                                        <div class="">
                                            <label class="focus-label">Gender</label>
                                            <select data-placeholder="Gender" name="gender" class="form-control input-lg">
                                                <option value=""></option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                    <!-- Preview Section Starts -->
                    <div id="template_preview" style="display:none">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="row card-body nopadding">
                                        <div class="col-md-12 form-group ">
                                            <label class="focus-label">Template Name</label>
                                            <input type="text" name="template_name_pre" id="template_name_pre" class="form-control input-lg">
                                        </div>
                                        <div class="col-md-12 form-group ">
                                            <label class="focus-label">Template Reference No.</label>
                                            <input type="text" name="temp_reff_pre" id="temp_reff_pre" class="form-control input-lg">
                                        </div>
                                        <div class="col-md-12 form-group ">
                                            <label class="focus-label">Template Author</label>
                                            <input type="text" name="temp_author_pre" id="temp_author_pre" class="form-control input-lg">
                                        </div>
                                        <div class="col-md-12 form-group ">
                                            <label class="focus-label">Date and Time</label>
                                            <div class="cal-icon">
                                                <input name="dateandtime_pre" id="dateandtime_pre" class="form-control input-lg datetimepicker" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="row card-body nopadding">
                                        <div class="col-md-12 form-group">
                                            <label for="focus-label">Urgency</label>
                                            <select name="report_urgency_pre" id="report_urgency_pre" class="form-control  input-lg select2">
                                                <option>Urgency</option>
                                                <?php
                                                $report_urgeny_data = array(
                                                    'routine' => 'Routine',
                                                    '2ww' => '2WW',
                                                    'urgent' => 'Urgent',
                                                );
                                                foreach ($report_urgeny_data as $key => $report_urgency) {
                                                    ?>
                                                    <option value="<?php echo $key ?>"><?php echo $report_urgency ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="focus-label">Pathologist </label>
                                            <select name="pathologist_pre" id="pathologist_pre" class="form-control  input-lg select2">
                                                <option>Pathologist</option>
                                                <?php
                                                if (!empty($doctor_list)) {
                                                    foreach ($doctor_list as $doctor) {
                                                        ?>
                                                        <option value="<?php echo $doctor->id ?>"><?php echo $doctor->first_name . ' ' . $doctor->last_name ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="focus-label">Clinician </label>
                                            <select name="clinician_data_pre" id="clinician_data_pre" class="form-control  input-lg select2">
                                                <option>Clinician</option>
                                                <?php
                                                if (!empty($clinic_list)) {
                                                    foreach ($clinic_list as $doctor) {
                                                        ?>
                                                        <option value="<?php echo $doctor->id ?>"><?php echo $doctor->first_name . ' ' . $doctor->last_name ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="focus-label">Lab</label>
                                            <input type="readonly" disabled id="lab_name_pre_show" name="lab_name_pre_show" class="form-control">
                                            <input type="hidden" id="lab_name_pre" name="lab_name_pre">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="row card-body nopadding">
                                        <div class="col-md-12 form-group ">
                                            <label class="focus-label">Request Type</label>
                                            <input type="readonly" disabled value="" id="request_type_pre_show" class="form-control">
                                            <input type="hidden" id="request_type_pre" name="request_type_pre">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="focus-label">Specimen No</label>
                                            <input type="text" name="specimen_no_pre" id="specimen_no_pre" class="form-control input-lg">
                                        </div>
                                        <div class="col-md-12 form-group ">
                                            <label class="focus-label">Specimen Type</label>
                                            <select name="specimen_type_pre" id="specimen_type_pre" class="form-control  input-lg select2">
                                                <?php
                                                foreach ($snomed_t_array as $snomed_t_code) {
                                                    $snomed_t = strtolower(str_replace(' ', '', trim($snomed_t_code['usmdcode_code'])));
                                                    ?>
                                                    <option value="<?php echo $snomed_t ?>"><?php echo $snomed_t_code['usmdcode_code'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12 form-group ">
                                            <label class="focus-label">Speciality</label>
                                            <input type="readonly" class="form-control input-lg" value="" disabled id="specialty_pre_show">
                                            <input type="hidden" id="specialty_pre" name="specialty_pre">
                                        </div>
                                        <div class="col-md-12 form-group ">
                                            <label class="focus-label">Courier No</label>
                                            <input type="text" name="courier_no_pre" id="courier_no_pre" class="form-control input-lg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="row card-body nopadding">
                                        <div class="col-md-12 form-group ">
                                            <label class="focus-label">Batch No</label>
                                            <input type="text" name="batch_no_pre" id="batch_no_pre" class="form-control input-lg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Preview Section Starts -->
                    <div class="clearfix"></div>

                    <div class="thumb_view hide">
                        <div class="row form-group custom_card">
                            <div class="col-xs-6 col-sm-6 col-md-3">
                                <div class="card">
                                    <div class="card-body nopadding">
                                        <div class="form-group  ">
                                            <label class="focus-label">NHS No.</label>
                                            <input name="nhs_number" id="nhs_number" class="form-control input-lg" type="text" style="border-color:#b1e2ff;">
                                        </div>
                                        <div class="form-group  ">
                                            <label class="focus-label">Hospital No.</label>
                                            <input name="hospital_no" id="hospital_no" class="form-control input-lg" type="text">
                                        </div>
                                        <div class="form-group  ">
                                            <label class="focus-label">First Name</label>
                                            <input name="f_name" id="f_name" class="form-control input-lg" type="text">
                                        </div>
                                        <div class="form-group  ">
                                            <label class="focus-label">Surname</label>
                                            <input name="sur_name" id="sur_name" class="form-control input-lg " type="text">
                                        </div>

                                        <div class="form-group  ">
                                            <label class="focus-label">Date of Birth</label>
                                            <div class="cal-icon">
                                                <input name="dob" id="dob" class="form-control input-lg datetimepicker" type="text" onblur="getAge(this.value)">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group  ">
                                                    <label class="focus-label">Age</label>
                                                    <input name="age" id="age" class="form-control input-lg" type="text" disabled=" ">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group  ">
                                                    <label class="focus-label">Gender</label>
                                                    <select name="gender" id="gender" class="form-control input-lg">
                                                        <option></option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-3">
                                <div class="card">
                                    <div class="card-body nopadding">
                                        <div class="form-group  ">
                                            <label class="focus-label">UL No.</label>
                                            <input name="serial_number" id="serial_number" class="form-control input-lg" type="text" disabled="">
                                        </div>
                                        <div class="form-group  ">
                                            <label class="focus-label">Track No.</label>
                                            <input name="ura_barcode_no" id="ura_barcode_no" class="form-control input-lg" type="text">
                                        </div>

                                        <div class="form-group  ">
                                            <label class="focus-label">EMIS / Additional Ref</label>
                                            <input name="emis_no" id="emis_no" class="form-control input-lg " type="text">
                                        </div>
                                        <div class="form-group  ">
                                            <label class="focus-label">Courier No.</label>
                                            <input name="courier_no" id="courier_no" class="form-control input-lg" type="text">
                                        </div>
                                        <div class="form-group  ">
                                            <label class="focus-label">Batch No.</label>
                                            <input name="batch_no" id="batch_no" class="form-control input-lg" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-3">
                                <div class="card">
                                    <div class="card-body nopadding">
                                        <div class="form-group  ">
                                            <label class="focus-label">Clinic</label>
                                            <input name="clinic_txt" id="clinic_txt" class="form-control input-lg" type="text">
                                        </div>
                                        <div class="form-group  ">
                                            <label class="focus-label">Clinician</label>

                                            <select name="clinician_no" id="clinician_no" class="form-control input-lg"">
                                                <option value="" disabled selected>--Select Clinician--</option>
                                                <?php
                                                if (!empty($clinic_list)) {
                                                    foreach ($clinic_list as $doctor) {
                                                        ?>
                                                        <option value=" <?php echo $doctor->id ?>"><?php echo $doctor->first_name . ' ' . $doctor->last_name ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="focus-label">Location (Ward/ OPD/ Other)</label>
                                            <input name="location" id="location" class="form-control input-lg " type="text">
                                        </div>
                                        <div class="form-group  ">
                                            <label class="focus-label">Clinic Date</label>
                                            <div class="cal-icon">
                                                <input name="toDate" id="toDate" class="form-control input-lg datetimepicker" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="focus-label">Speciality</label>
                                            <select name="Speciality" id="speciality" class="form-control input-lg">
                                                <?php foreach ($Speciality as $rec) { ?>
                                                    <option value="<?php echo $rec->id ?>"><?php echo $rec->specialty ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-3">
                                <div class="card">
                                    <div class="card-body nopadding">

                                        <div class="form-group  ">
                                            <label class="focus-label">Accession No. / Lab No.</label>
                                            <input name="assessment_no" id="assessment_no" class="form-control input-lg " type="text">
                                        </div>

                                        <div class="form-group  ">
                                            <label class="focus-label">Digit No.</label>
                                            <input name="digino" id="digino" class="form-control input-lg " type="text">
                                        </div>
                                        <div class="form-group  ">
                                            <label class="focus-label">Status</label>
                                            <select id="urgency" name="urgency" class="form-control input-lg">
                                                <option>Routine</option>
                                                <option>Urgent</option>
                                                <option>2WW</option>
                                            </select>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="focus-label">Lab Recieved Date</label>
                                            <div class="cal-icon">
                                                <input name="labdate" id="labdate" class="form-control input-lg " type="text" disabled="">
                                            </div>
                                        </div>

                                        <div class="form-group  ">
                                            <label class="focus-label">RCPath Status</label>
                                            <input name="rcpath" id="rcpath" class="form-control input-lg " type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hiding Laboratory Process Flow for work to be done in future  -->
                        <!-- TODO: Discuss if to be removed -->
                        <div class="lab_request col-md-12" style="display: none;">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h3>Laboratory Process Flow</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 nopadding doctorSCard bcodes_area" style="display: none;">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body nopadding">
                                            <div class=" form-group">
                                                <label for="inputSysNo" class="focus-label">Cut Up (Primary)</label>
                                                <div class="input-group-append">
                                                    <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" style="height:50px; max-height:50px;">
                                                    <input class="form-control input-lg" type="text">
                                                </div>
                                            </div>
                                            <div class=" form-group">
                                                <label for="inputSysNo" class="focus-label">Cut Up (Secondary)</label>
                                                <div class="input-group-append">
                                                    <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" style="height:50px; max-height:50px;">
                                                    <input class="form-control input-lg" type="text">
                                                </div>
                                            </div>
                                            <div class=" form-group">
                                                <label for="inputSysNo" class="focus-label">Assisted</label>
                                                <div class="input-group-append">
                                                    <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" style="height:50px; max-height:50px;">
                                                    <input class="form-control input-lg" type="text">
                                                </div>
                                            </div>
                                            <div class=" form-group">
                                                <label for="inputSysNo" class="focus-label">Block Checked</label>
                                                <div class="input-group-append">
                                                    <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" style="height:50px; max-height:50px;">
                                                    <input class="form-control input-lg" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body nopadding">
                                            <div class=" form-group">
                                                <label for="inputSysNo" class="focus-label">Processor</label>
                                                <div class="input-group-append">
                                                    <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" style="height:50px; max-height:50px;">
                                                    <input class="form-control input-lg" type="text">
                                                </div>
                                            </div>
                                            <div class=" form-group">
                                                <label for="inputSysNo" class="focus-label">Sectioned</label>
                                                <div class="input-group-append">
                                                    <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" style="height:50px; max-height:50px;">
                                                    <input class="form-control input-lg" type="text">
                                                </div>
                                            </div>
                                            <div class=" form-group">
                                                <label for="inputSysNo" class="focus-label">Embedded</label>
                                                <div class="input-group-append">
                                                    <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" style="height:50px; max-height:50px;">
                                                    <input class="form-control input-lg" type="text">
                                                </div>
                                            </div>
                                            <div class=" form-group">
                                                <label for="inputSysNo" class="focus-label">Labeled</label>
                                                <div class="input-group-append">
                                                    <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" style="height:50px; max-height:50px;">
                                                    <input class="form-control input-lg" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body nopadding">
                                            <div class=" form-group">
                                                <label for="inputSysNo" class="focus-label">QCd</label>
                                                <div class="input-group-append">
                                                    <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" style="height:50px; max-height:50px;">
                                                    <input class="form-control input-lg" type="text">
                                                </div>
                                            </div>
                                            <div class=" form-group">
                                                <label for="inputSysNo" class="focus-label">Date Rel. by Lab</label>
                                                <div class="input-group-append">
                                                    <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" style="height:50px; max-height:50px;">
                                                    <input class="form-control input-lg" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hiding Laboratory Process Flow for work to be done in future END -->

                        </div>
                        <input type="hidden" name="request_id" id="request_id" value="" />
                    </div>
                    <!-- Thumb view end -->
                    <div class="tracking_search_result"></div>

                    <div class="list_view show">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive" id="track_record">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 record_add_result">
                            <?php if (!empty($session_data)) { ?>
                                <a target="_blank" href="<?php echo base_url('institute/print_session_records'); ?>">Print Records</a>
                                <table class="track_search_table table table-stripped custom-table">
                                    <tr>
                                        <th>UL No.</th>
                                        <th>Track No.</th>
                                        <th>Client</th>
                                        <th>First Name</th>
                                        <th>Surname</th>
                                        <th>DOB</th>
                                        <th>NHS No.</th>
                                        <th>Lab No.</th>
                                        <th>Type</th>
                                        <th>Release Date</th>
                                        <th>Statuses</th>
                                        <th>Flag</th>
                                        <th><img src="<?php echo base_url('assets/img/comment-bubble-white.png'); ?>"></th>
                                        <th><img src="<?php echo base_url('assets/img/docs-white.png'); ?>"></th>
                                        <th>TAT</th>
                                        <th colspan="2">Actions</th>
                                    </tr>
                                    <?php foreach ($session_data as $row_data) { ?>
                                        <tr class="track_session_row" data-trackno="<?php echo $row_data['ura_barcode_no']; ?>">
                                            <td><?php echo html_purify($row_data['serial_number']); ?></td>
                                            <td><?php echo $row_data['ura_barcode_no']; ?></td>
                                            <td>
                                                <?php
                                                $f_initial = '';
                                                $l_initial = '';
                                                if (!empty($this->ion_auth->group($row_data['hospital_group_id'])->row()->first_initial)) {
                                                    $f_initial = $this->ion_auth->group($row_data['hospital_group_id'])->row()->first_initial;
                                                }
                                                if (!empty($this->ion_auth->group($row_data['hospital_group_id'])->row()->last_initial)) {
                                                    $l_initial = $this->ion_auth->group($row_data['hospital_group_id'])->row()->last_initial;
                                                }
                                                ?>
                                                <a class="hospital_initials" data-toggle="tooltip" data-placement="top" title="<?php echo $this->ion_auth->group($row_data['hospital_group_id'])->row()->description; ?>" href="javascript:;"><?php echo html_purify($f_initial) . ' ' . html_purify($l_initial); ?></a>
                                            </td>
                                            <td><?php echo html_purify($row_data['f_name']); ?></td>
                                            <td><?php echo html_purify($row_data['sur_name']); ?></td>
                                            <td>
                                                <?php
                                                $dob = '';
                                                if (!empty($row_data['dob'])) {
                                                    $dob = date('d-m-Y', strtotime($row_data['dob']));
                                                }
                                                echo $dob;
                                                ?>
                                            </td>
                                            <td><?php echo $row_data['nhs_number']; ?></td>
                                            <td><a target="_blank" href="<?php echo site_url() . '/admin/detail_view_record/' . html_purify($row_data['uralensis_request_id']); ?>"><?php echo html_purify($row_data['lab_number']); ?></a></td>
                                            <td><?php echo ucwords(substr($row_data['report_urgency'], 0, 1)); ?></td>
                                            <td>
                                                <?php
                                                $publish_date = '';
                                                if (!empty($row_data['publish_datetime'])) {
                                                    $publish_date = date('d-m-Y', strtotime($row_data['publish_datetime']));
                                                }
                                                echo $publish_date;
                                                ?>
                                            </td>
                                            <td class="dropdown tg-userdropdown tg-liststatuses">
                                                <a href="javascript:;" data-toggle="dropdown" aria-expanded="true"><?php echo $this->Institute_model->get_track_template_statuses($row_data['uralensis_request_id'], 'recent')['ura_rec_track_status']; ?></a>
                                                <ul class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-adminnav">
                                                    <?php
                                                    $list_statuses = $this->Institute_model->get_track_template_statuses($row_data['uralensis_request_id'], 'all');
                                                    if (!empty($list_statuses)) {
                                                        foreach ($list_statuses as $statuses) {
                                                            ?>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <span><?php echo $statuses['ura_rec_track_status']; ?></span>
                                                                </a>
                                                            </li>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </td>
                                            <td class="flag_column">
                                                <div class="hover_flags">
                                                    <div class="flag_images">
                                                        <?php
                                                        if ($row_data['flag_status'] === 'flag_red') {
                                                            echo '<img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_red.png') . '">';
                                                        } elseif ($row_data['flag_status'] === 'flag_yellow') {
                                                            echo '<img data-toggle="tooltip" data-placement="top" title="This case marked for typing." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_yellow.png') . '">';
                                                        } elseif ($row_data['flag_status'] === 'flag_blue') {
                                                            echo '<img data-toggle="tooltip" data-placement="top" title="This case marked for Pre-Authorization." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_blue.png') . '">';
                                                        } elseif ($row_data['flag_status'] === 'flag_black') {
                                                            echo '<img data-toggle="tooltip" data-placement="top" title="This case marked as further work." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_black.png') . '">';
                                                        } elseif ($row_data['flag_status'] === 'flag_gray') {
                                                            echo '<img data-toggle="tooltip" data-placement="top" title="This case marked as awaiting reviews." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_gray.png') . '">';
                                                        } else {
                                                            echo '<img data-toggle="tooltip" data-placement="top" title="This case marked as released." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_green.png') . '">';
                                                        }
                                                        ?>
                                                    </div>
                                                    <ul class="report_flags list-unstyled list-inline" style="display:none;">
                                                        <?php
                                                        $active = '';
                                                        if ($row_data['flag_status'] === 'flag_green') {
                                                            $active = 'flag_active';
                                                        }
                                                        ?>
                                                        <li class="<?php echo $active; ?>">
                                                            <a href="javascript:;" data-flag="flag_green" data-serial="<?php echo html_purify($row_data['serial_number']); ?>" data-recordid="<?php echo intval($row_data['uralensis_request_id']); ?>" class="flag_change">
                                                                <img data-toggle="tooltip" data-placement="top" title="This case marked as released." src="<?php echo base_url('assets/img/flag_green.png'); ?>">
                                                            </a>
                                                        </li>
                                                        <?php
                                                        $active = '';
                                                        if ($row_data['flag_status'] === 'flag_red') {
                                                            $active = 'flag_active';
                                                        }
                                                        ?>
                                                        <li class="<?php echo $active; ?>">
                                                            <a href="javascript:;" data-flag="flag_red" data-serial="<?php echo html_purify($row_data['serial_number']); ?>" data-recordid="<?php echo intval($row_data['uralensis_request_id']); ?>" class="flag_change">
                                                                <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="<?php echo base_url('assets/img/flag_red.png'); ?>">
                                                            </a>
                                                        </li>
                                                        <?php
                                                        $active = '';
                                                        if ($row_data['flag_status'] === 'flag_yellow') {
                                                            $active = 'flag_active';
                                                        }
                                                        ?>

                                                        <li class="<?php echo $active; ?>">
                                                            <a href="javascript:;" data-flag="flag_yellow" data-serial="<?php echo html_purify($row_data['serial_number']); ?>" data-recordid="<?php echo intval($row_data['uralensis_request_id']); ?>" class="flag_change">
                                                                <img data-toggle="tooltip" data-placement="top" title="This case marked for typing." src="<?php echo base_url('assets/img/flag_yellow.png'); ?>">
                                                            </a>
                                                        </li>
                                                        <?php
                                                        $active = '';
                                                        if ($row_data['flag_status'] === 'flag_blue') {
                                                            $active = 'flag_active';
                                                        }
                                                        ?>
                                                        <li class="<?php echo $active; ?>">
                                                            <a href="javascript:;" data-flag="flag_blue" data-serial="<?php echo html_purify($row_data['serial_number']); ?>" data-recordid="<?php echo intval($row_data['uralensis_request_id']); ?>" class="flag_change">
                                                                <img data-toggle="tooltip" data-placement="top" title="This case marked for pre authorization." src="<?php echo base_url('assets/img/flag_blue.png'); ?>">
                                                            </a>
                                                        </li>
                                                        <?php
                                                        $active = '';
                                                        if ($row_data['flag_status'] === 'flag_black') {
                                                            $active = 'flag_active';
                                                        }
                                                        ?>

                                                        <li class="<?php echo $active; ?>">
                                                            <a href="javascript:;" data-flag="flag_black" data-serial="<?php echo html_purify($row_data['serial_number']); ?>" data-recordid="<?php echo intval($row_data['uralensis_request_id']); ?>" class="flag_change">
                                                                <img data-toggle="tooltip" data-placement="top" title="This case marked further work." src="<?php echo base_url('assets/img/flag_black.png'); ?>">
                                                            </a>
                                                        </li>
                                                        <?php
                                                        $active = '';
                                                        if ($row_data['flag_status'] === 'flag_gray') {
                                                            $active = 'flag_active';
                                                        }
                                                        ?>
                                                        <li class="<?php echo $active; ?>">
                                                            <a href="javascript:;" data-flag="flag_gray" data-serial="<?php echo html_purify($row_data['serial_number']); ?>" data-recordid="<?php echo intval($row_data['uralensis_request_id']); ?>" class="flag_change">
                                                                <img data-toggle="tooltip" data-placement="top" title="This case marked awaiting reviews." src="<?php echo base_url('assets/img/flag_gray.png'); ?>">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <a class="custom_badge_track" data-toggle="tooltip" data-placement="top" title="" data-original-title="View your record comments or add comments.">
                                                    <img src="<?php echo base_url('assets/img/comment-bubble.png'); ?>">&nbsp;
                                                    <span class="badge bg-danger">0</span>
                                                </a>
                                            </td>
                                            <td>
                                                <?php
                                                $doctor_id = $this->Institute_model->get_record_assignee_doctor_id(intval($row_data['uralensis_request_id']));
                                                $count_docs_result = $this->Institute_model->count_documents(intval($row_data['uralensis_request_id']), intval($doctor_id));
                                                ?>
                                                <a class="custom_badge_track" data-toggle="tooltip" data-placement="top" title="" data-original-title="View your record comments or add comments.">
                                                    <img src="<?php echo base_url('assets/img/docs-black.png'); ?>">&nbsp;
                                                    <span class="badge bg-danger"><?php echo $count_docs_result; ?></span>
                                                </a>
                                            </td>
                                            <td>

                                                <a class="custom_badge_tat">
                                                    <?php
                                                    $now = time(); // or your date as well
                                                    $date_taken = !empty($row_data['date_taken']) ? $row_data['date_taken'] : '';
                                                    $request_date = !empty($row_data['request_datetime']) ? $row_data['request_datetime'] : '';
                                                    $tat_date = '';

                                                    if (!empty($date_taken)) {
                                                        $tat_date = $date_taken;
                                                    } else {
                                                        $tat_date = $request_date;
                                                    }

                                                    $compare_date = strtotime("$tat_date");
                                                    $datediff = $now - $compare_date;
                                                    $record_old_count = floor($datediff / (60 * 60 * 24));

                                                    $badge = '';
                                                    if ($record_old_count <= 10) {
                                                        $badge = 'bg-success';
                                                    } elseif ($record_old_count > 10 && $record_old_count <= 20) {
                                                        $badge = 'bg-warning';
                                                    } else {
                                                        $badge = 'bg-danger';
                                                    }
                                                    ?>
                                                    <span class="badge <?php echo $badge; ?>"><?php echo $record_old_count; ?></span>
                                                </a>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td class="dropdown tg-userdropdown tg-menu-dropdown">
                                                <a href="javascript:;" data-toggle="dropdown" aria-expanded="true"><span class="lnr lnr-menu"></span></a>
                                                <ul class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-adminnav">
                                                    <li>
                                                        <a class="record_id_delete" data-recordserial="<?php echo html_purify($row_data['serial_number']); ?>" href="javascript:;" data-delrecordid="<?php echo base_url('index.php/institute/delete_admin_side_record/' . intval($row_data['uralensis_request_id']) . '/track_del'); ?>"><i class="lnr lnr-trash"></i><em>Delete</em></a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- List view of session ends  -->

                </div>
                <!-- Card Body Ends -->

            </div>
        </div>
        <div style="clear:both;"></div>
        <div class="card" id="dv_byPatient" style="display:none">

            <div id="patient-booking">
                <div class="card-body">
                    <h3>Find Patient</h3>
                    <!-- Bootstrap select -->
                    <?php if ($group_type === 'A'): ?>
                        <label for="select_hospital">Select Hospital</label>
                        <select name="hospital" id="select-hospital" class="form-control">
                            <?php foreach ($hospitals as $hospital): ?>
                                <option value="<?php echo $hospital['id'] ?>"><?php echo $hospital['description']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                    <?php if ($group_type === 'H'): ?>
                        <input type="hidden" class="form-control" id="select-hospital" value="<?php echo $hospital['description']; ?>">
                    <?php endif; ?>

                    <div class="table-responsive mb-4">
                        <table class="table custom-table table-striped" id="patient-table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Patient Name</th>
                                    <th>NHS Number</th>
                                    <th>DOB</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($patients as $patient) :
                                    $dob = $patient['dob'];
                                    $age = date('Y') - date('Y', strtotime($dob));
                                    ?>
                                    <tr data-id="<?php echo $patient['id']; ?>">
                                        <td><?php echo $patient['first_name'] . ' ' . $patient['last_name']; ?></td>
                                        <td><?php echo $patient['nhs_number']; ?></td>
                                        <td><?php echo $patient['dob']; ?></td>
                                        <td><?php echo $age; ?></td>
                                        <td><?php echo $patient['gender']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="selected-patient-show" style="display: none;">
                        <h4>Add Record for the patient</h4>
                        <div class="row mb-3">
                            <div class="col-3">
                                Name: <span id="selected-patient-name"></span>
                            </div>
                            <div class="col-3">
                                NHS: <span id="selected-patient-nhs"></span>
                            </div>
                            <div class="col-3">
                                DOB: <span id="selected-patient-dob"></span>
                            </div>
                            <div class="col-3">
                                Gender: <span id="selected-patient-gender"></span>
                            </div>
                        </div>
                        <!-- Add a bootstrap button to submit -->
                        <button class="btn btn-primary" id="create-patient-record">Add Record</button>
                    </div>
                    <div class="patient_record_add_result"></div>
                </div>
            </div>
        </div>
        
        <div style="clear:both;"></div>

        <!-- Preview Section Ends-->
    </div>
</div>
<div style="clear:both;"></div>
<!-- /Page Content -->
</div>
<!-- /Page Wrapper -->

<script>
    tinymce.init({
        selector: '.tinyTextarea',
        height: 200,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
        content_css: '//www.tiny.cloud/css/codepen.min.css'
    });
</script>


<div id="edit_temp" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Template</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="track_temp_edit_form">
                    <div class="edit_fields">
                        <div class="row">
                            <input type="hidden" name="edit_mod" id="edit_mod" value="edit">
                            <input type="hidden" name="template_id" id="template_id" value="">
                            <div class="col-md-6 form-group ">
                                <label class="focus-label">Template Name</label>
                                <input type="text" name="template_name_pop" id="template_name_pop" class="form-control input-lg">
                            </div>
                            <div class="col-md-6 form-group ">
                                <label class="focus-label">Template Reference No.</label>
                                <input type="text" name="temp_reff_no" id="temp_reff_no" class="form-control input-lg">
                            </div>
                            <div class="col-md-6 form-group ">
                                <label class="focus-label">Template Author</label>
                                <input type="text" name="temp_author" id="temp_author" class="form-control input-lg">
                            </div>
                            <div class="col-md-6 form-group ">
                                <label class="focus-label">Date and Time</label>
                                <div class="cal-icon">
                                    <input name="dateandtime" id="dateandtime" class="form-control input-lg datetimepicker" type="text" value="">

                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="focus-label">Urgency</label>
                                <select name="report_urgency_pop" id="report_urgency_pop" class="form-control select2">
                                    <option>Urgency</option>
                                    <?php
                                    $report_urgeny_data = array(
                                        'routine' => 'Routine',
                                        '2ww' => '2WW',
                                        'urgent' => 'Urgent',
                                    );
                                    foreach ($report_urgeny_data as $key => $report_urgency) {
                                        ?>
                                        <option value="<?php echo $key ?>"><?php echo $report_urgency ?></option>

                                    <?php } ?>

                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="focus-label">Physician</label>
                                <select name="pathologist_pop" id="pathologist_pop" class="form-control select2 ">
                                    <option>Pathologist</option>
                                    <?php
                                    if (!empty($doctor_list)) {
                                        foreach ($doctor_list as $doctor) {
                                            ?>
                                            <option value="<?php echo $doctor->id ?>"><?php echo $doctor->first_name . ' ' . $doctor->last_name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="focus-label">Clinician</label>
                                <select name="clinician_pop" class="clinician_pop form-control select2 ">
                                    <option>Clinician</option>
                                    <?php
                                    if (!empty($clinic_list)) {
                                        foreach ($clinic_list as $doctor) {
                                            ?>
                                            <option value="<?php echo $doctor->id ?>"><?php echo $doctor->first_name . ' ' . $doctor->last_name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-6 form-group ">
                                <label class="focus-label">Specimen Type</label>
                                <div id="spctype_divedit">
                                    <select name="specimen_type_pop" id="specimen_type_pop" class="form-control select2">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 form-group ">
                                <label class="focus-label">Specimen No</label>
                                <input type="text" class="form-control input-lg" name="specimen_no" id="specimen_no">
                            </div>
                            <div class="col-md-6 form-group ">
                                <label class="focus-label">Courier No</label>
                                <input type="text" name="courier_no_pop" id="courier_no_pop" class="form-control input-lg">
                            </div>
                            <div class="col-md-6 form-group ">
                                <label class="focus-label">Batch No</label>
                                <input type="text" name="batch_no_pop" class="batch_no_pop form-control input-lg">
                            </div>
                        </div>
                    </div>
                    <div class="m-t-20 text-center submit_all">
                        <button class="btn btn-info" type="button" id="save-track-template">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add specimen model-->
<?php
$specialitylist = getRecords("*", "specialties");

$specilist = '<select name="speciality_list" id="speciality_list" class="form-control select2">';
foreach ($specialitylist as $myrec) {
    $specilist .= ' <option value="' . $myrec->id . '">' . $myrec->specialty . '</option>';
}
$specilist .= '</select>';

$snomed_p_array = getSnomedCodes('p');
$snomed_t_array = getSnomedCodes('t1');

$snomedhtml = '';
$snomed_thtml = '';


$snomedhtml = '<select name="specimen_snomed_p" id="specimen_snomed_p" class="form-control  input-lg select2">
                            <option value="" data-hidden="true" selected>P Code</option>';
foreach ($snomed_p_array as $snomed_p_code) {
    $selected = '';

    $snomed_p = strtolower(str_replace(' ', '', trim($snomed_p_code['usmdcode_code'])));
    if (property_exists($rec, 'specimen_snomed_p') && $rec->specimen_snomed_p == $snomed_p) {
        $selected = 'selected="selected"';
    }
    $snomedhtml .= '<option data-pdesc="' . $snomed_p_code['usmdcode_code_desc'] . '" value="' . $snomed_p . '" ' . $selected . '>' . $snomed_p_code['usmdcode_code'] . '</option>';
}

$snomedhtml .= '</select>';



$snomed_thtml = '<select name="specimen_snomed_t" id="specimen_snomed_t"  class="form-control  input-lg select2">
                            <option value="" data-hidden="true" selected>T1 Code</option>';

foreach ($snomed_t_array as $snomed_t_code) {
    $selected = '';
    $snomed_t = strtolower(str_replace(' ', '', trim($snomed_t_code['usmdcode_code'])));
    if (property_exists($rec, 'specimen_snomed_t') && $rec->specimen_snomed_t == $snomed_t) {
        $selected = 'selected="selected"';
    }
    $snomed_thtml .= '<option data-tdesc="' . $snomed_t_code['usmdcode_code_desc'] . '" value="' . $snomed_t . '" ' . $selected . '>' . $snomed_t_code['usmdcode_code'] . '</option>';
}

$snomed_thtml .= '</select>';
?>

<form id="add_specimen_form" action="<?php echo base_url() ?>index.php/institute/AddSubmitSpecimenHospital" method="post">
    <div id="add_specimen_div" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" name="request_id_addspeciment" id="request_id_addspeciment" value="" />
                    <h4 class="modal-title">Edit Specimen</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">

                            <label class="focus-label">Specialty</label>
                            <?php echo $specilist ?>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="newforms ">
                                <label class="focus-label">Block Details</label>
                                <input name="block_detail" id="block_detail" class="form-control input-lg " type="text" value="">
                            </div>

                        </div>
                        <div class="form-group col-md-12">
                            <div class="doctorSCard d-block">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <label class="focus-label">Clinical</label>
                                        <img src="<?php echo base_url() ?>assets/institute/img/iconBtn.png">
                                    </span>
                                    <input class="form-control" list="desc">
                                    <datalist id="desc">
                                        <option value="Clinical 1">
                                        </option>
                                        <option value="Clinical 2">
                                        </option>
                                        <option value="Clinical 3">
                                        </option>
                                        <option value="Clinical 4">
                                        </option>
                                        <option value="Clinical 5">
                                        </option>
                                    </datalist>
                                </div>
                                <textarea class="form-control" name="specimen_diagnosis_description" id="specimen_diagnosis_description"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="doctorSCard d-block">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <label class="focus-label">Microscopic</label>
                                        <img src="<?php echo base_url() ?>assets/institute/img/iconBtn.png">
                                    </span>
                                    <input class="form-control" list="desc">
                                    <datalist id="desc">
                                        <option value="Microscopic 1">
                                        </option>
                                        <option value="Microscopic 2">
                                        </option>
                                        <option value="Microscopic 3">
                                        </option>
                                        <option value="Microscopic 4">
                                        </option>
                                        <option value="Microscopic 5">
                                        </option>
                                    </datalist>
                                </div>
                                <textarea class="form-control" name="specimen_microscopic_description" id="specimen_microscopic_description"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="newforms ">
                                        <label class="focus-label">P Code</label>
                                        <?php echo $snomedhtml ?>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <div class="newforms ">
                                        <label class="focus-label">T Code</label>
                                        <?php echo $snomed_thtml ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="newforms ">
                                        <label class="focus-label">No. of Blocks</label>
                                        <input name="numberOfBlocks" id="numberOfBlocks" class="form-control input-lg " type="text" value="">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <div class="newforms ">
                                        <label class="focus-label">RCPath Score</label>
                                        <input name="specimen_rcpath_code" id="specimen_rcpath_code" class="form-control input-lg " type="text" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info btn-lg btn-rounded btn-save" id="insertspecimen">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>


<!-- Add speciment Model End-->


<div id="add_temp" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Template</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="track_temp_add_form">
                    <div class="edit_fields">
                        <div class="row">
                            <input type="hidden" name="edit_mod" value="add">
                            <div class="col-md-6 form-group ">
                                <label class="focus-label">Template Name</label>
                                <input type="text" name="template_name_pop" class="form-control input-lg">
                            </div>
                            <div class="col-md-6 form-group ">
                                <label class="focus-label">Template Reference No.</label>
                                <input type="text" name="temp_reff_no_add" class="form-control input-lg">
                            </div>
                            <div class="col-md-6 form-group ">
                                <label class="focus-label">Template Author</label>
                                <input type="text" name="temp_author" class="form-control input-lg" value="<?php echo $authorname[0]->username ?>">
                            </div>
                            <div class="col-md-6 form-group ">
                                <label class="focus-label">Date and Time</label>
                                <div class="cal-icon">
                                    <input name="dateandtime" class="form-control input-lg datetimepicker" type="text" value="<?php echo date("Y-m-d") ?>">
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="focus-label">Urgency</label>
                                <select name="report_urgency_pop" class="form-control select2">
                                    <option>Urgency</option>
                                    <?php
                                    $report_urgeny_data = array(
                                        'routine' => 'Routine',
                                        '2ww' => '2WW',
                                        'urgent' => 'Urgent',
                                    );
                                    foreach ($report_urgeny_data as $key => $report_urgency) {
                                        ?>
                                        <option value="<?php echo $key ?>"><?php echo $report_urgency ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="focus-label">Pathologist</label>
                                <select name="pathologist_pop" class="form-control select2 ">
                                    <option>Pathologist</option>
                                    <?php
                                    if (!empty($doctor_list)) {
                                        foreach ($doctor_list as $doctor) {
                                            ?>
                                            <option value="<?php echo $doctor->id ?>"><?php echo $doctor->first_name . ' ' . $doctor->last_name ?></option>

                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="focus-label">Clinician</label>
                                <select name="clinician_pop" class="clinician_pop form-control select2 ">
                                    <option>Clinician</option>
                                    <?php
                                    if (!empty($clinic_list)) {
                                        foreach ($clinic_list as $doctor) {
                                            ?>
                                            <option value="<?php echo $doctor->id ?>"><?php echo $doctor->first_name . ' ' . $doctor->last_name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group ">
                                <label class="focus-label">Specimen Type</label>
                                <div id="spctype_div">
                                    <select name="specimen_type_pop" class="form-control select2">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 form-group ">
                                <label class="focus-label">Specimen No</label>
                                <input type="text" name="specimen_no_new" class="form-control input-lg">
                            </div>
                            <div class="col-md-6 form-group ">
                                <label class="focus-label">Courier No</label>
                                <input type="text" name="courier_no_pop" class="form-control input-lg">
                            </div>
                            <div class="col-md-6 form-group ">
                                <label class="focus-label">Batch No</label>
                                <input type="text" name="batch_no_pop" class="batch_no_pop form-control input-lg">
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="m-t-20 text-center submit_all">
                <button class="btn btn-info" id="save-track-template-add">Submit</button>
            </div>
        </div>
    </div>
</div>

<?php
$patients_min = [];
foreach ($patients as $pt) {
    $patients_min[$pt['id']] = ['first_name' => $pt['first_name'], 'nhs_number' => $pt['nhs_number'], 'last_name' => $pt['last_name'], 'dob' => $pt['dob'], 'gender' => $pt['gender'], 'age' => date('Y') - date('Y', strtotime($pt['dob']))];
}
?>

<script>
    var labs = JSON.parse(`<?php echo json_encode($lab_names); ?>`);
            var specialties = JSON.parse(`<?php echo json_encode($specialties); ?>`);
            var patients = JSON.parse(`<?php echo json_encode($patients_min); ?>`);
            function showdiv(name) {
                // console.log(name); return false; 
                if (name == 'batch') {
                    $("#dv_batch").show();
                    $("#dv_byPatient").hide();
                }

                if (name == 'patient') {
                    $("#dv_batch").hide();
                    $("#dv_byPatient").show();
                }
            }
</script>