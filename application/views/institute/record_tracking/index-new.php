<style type="text/css">
    .nav-tabs.nav-tabs-solid>li {
        margin-bottom: 6px;
    }
    @media screen and (min-width: 1550px){

        /*#template_preview .card{min-height: 320px !important;}*/
        .form-control, input[type="text"]{height: 49px}
    }
    input[type=checkbox], input[type=radio]{
        width: 22px;
        height: 22px;
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
    .edit_area{
        position: absolute;
        top: 0;
        bottom: 0;
        right: 8px;
    }
    
    .tooltipIcon img {
        max-width: 34px;
        margin-top: 10px;
    }
    
    .btn-link:hover{
        text-decoration: none;
    }
    #select2-template_name-container{
        padding-left: 45px;
    }

    #template_preview .card {
        min-height: 345px;
    }

    .custom_card .card {
        min-height: 597px;
    }

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
    @media screen and (max-width: 1600px) {
        .fa-file-o {top: 5px;}
        
    }
    .page-header .breadcrumb {
        background-color: transparent;
        color: #6c757d;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 0;
        padding: 0;
        margin-top: 35px;
        display: block;
    }
    .page-header .breadcrumb li{
        display: inline-block;
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
        background: #ddd;
        color: #222;
        padding: 0 10px;
        height: auto;
        border-radius: 0 !important;
        padding: 15px 10px;
    }
     @media screen and (max-width: 1400px) {
         a.action-icon.dropdown-toggle {padding: 5px 8px;}
     }

    a.action-icon.dropdown-toggle:hover,
    a.action-icon.dropdown-toggle:focus {
        background-color: #028ee1 !important;
        border-color: #028ee1 !important;
        color: #fff !important;
    }

    .card {
        margin-bottom: 0;
    }

    .accordion-button {
        font-size: 1.5rem;
    }
    #patient-table2 tbody tr:hover {
        background-color: lightblue;
        cursor: pointer;
    }
    .page-wrapper{overflow:hidden;}

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
    div.dataTables_wrapper div.dataTables_length select{
        /*padding: 0 10px;*/
        height: auto;
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

.card-body {
    -ms-flex: 1 1 auto;
    flex: 0 1 auto;
    padding: 1.25rem;
}
.stack-top{
        z-index: 9;
        margin: 0px; /* for demo purpose  */
		
    }

.form-control[disabled], fieldset[disabled] .form-control {
    cursor: not-allowed;
    background-color: #eee !important;
}
.select2-container--default.select2-container--disabled .select2-selection--single {
    background-color: #eee;
    
    cursor: not-allowed !important;
}
    .error_list {
        margin: 15px 0px;
        background-color: red;
        color: white;
        padding: 10px;
        border-radius: 5px;
    }
	
	.page-header .breadcrumb {
    background-color: transparent;
    color: #6c757d;
    font-size: 1rem;
    font-weight: 500;
    margin-bottom: 0;
    padding: 0;
}

.page-title {
    color: #1f1f1f;
    font-size: 26px;
    font-weight: 500;
    margin-bottom: 5px;
    display: block;
    width: 100%;
}

@media screen and (min-width: 1517.78px) and (max-width:) {
    a.action-icon.dropdown-toggle{
        padding: 4px 10px;
        margin-right: 8px;
    }
}
	
	
</style>
<?php
$snomed_t_array = getSnomedCodes('t1');
?>
<div class="patient-doctor no-sidebar" style="min-height: 75vh">
    <div class="content container-fluid" style="padding-top:50px">
        <div>
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="page-title">Booking In</h3>
                    
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">New Record</li>                            
                        </ul>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="<?php echo base_url('/Slide_label'); ?>" target="_blank"><button title="View Slide Label" data-toggle="tooltip" class="btn btn-sm btn-default pull-right" style="padding: 7px;">
                                <img src="<?php echo base_url() ?>assets/institute/img/View-session-b.png" class="img-responsive" style="max-width: 40px;">
                            </button></a>
                        <button title="Create New Session List" data-toggle="tooltip" class="btn btn-sm btn-default pull-right create_sess_list_btn" style="padding: 7px; display:none;  margin-right:10px">
                            <img src="<?php echo base_url() ?>assets/institute/img/Create-session-b.png" class="img-responsive" style="max-width: 40px;">
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <?php if ($this->session->flashdata('error') != '') { ?>
                <div class="error_list" style="color: red;">
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>
        </div>
        <section>
            <div class="row">
                <div class="col-md-12  mb-4" style="display:none">
                    <div class="row" >
                        
                        <div class="col-sm-12 col-md-6 col-lg-4 mb-2">
                            <strong><?php echo ($group_type =="H" ? 'Laboratory:' : 'Clinic:');?></strong> <span id="p_lab"> <?php echo $lab_names[0]["description"]; ?> </span> 
                        </div>
                        <?php if($group_type =="L" || $group_type =="LA") {?>
                        <div class="col-sm-12 col-md-6 col-lg-4 mb-2"><strong><?php
                		   echo ($group_type =="L" ? 'Laboratory:' : 'Hospitals:');?></strong> <span id="p_lab"> <?php echo $group_name;?> </span> 
                        </div>
                        <?php } ?>

                        <div class="col-sm-12 col-md-6 col-lg-4 mb-2 text-center">
                            <!-- <strong>Specialty: </strong>
                            <span id="p_sep"> <?php echo $Speciality[0]->specialty; ?> </span> -->
                            <button class="btn btn-info btn-sm ml-5 " data-toggle="modal" data-target="#openLabs">Change</button> 
                        </div>
                    </div>
                </div>
               <!--  <div class="col-md-4 mb-4">
                    <div class="" id="dis_data">                       
                        <form action="<?php echo base_url('institute/eximportcsv'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <div class="input-group">
                                        <input type="file" name="image" id="image" />
                                        <input type="hidden" name="hospital_uniq_id" value="5465465" />
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <input class="btn btn-default submitBtn" type="submit" name="submit" value="Upload CSV" />
                                </div>
                            </div>                            
                            <div class="col-md-12 input-group" style="display: none;">
                                Download Sample CSV from &nbsp;<a target="_blank" href="<?php echo base_url(); ?>uploads/project_files/import_records.csv">Here</a>      
                            </div>                                     
                        </form> 
                    </div>
                </div> -->
            </div>

            <div class="modal fade" id="openLabs" tabindex="-1" role="dialog" aria-labelledby="openLabs" aria-hidden="true">
                <div class="modal-dialog" role="document" style="width: 800px;min-width: 800px; max-height: 800px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="openLabs"><?php echo ($group_typ == "H" ? 'Laboratories' : 'Hospitals' );?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12" id="hospital_list">
                                    <select name="lab_name" id="lab_name" class="form-control  input-lg select2"  onchange="getBookingInLabs('lab');">
                                        <option value="">Select <?php echo ($group_typ == "H" ? 'Laboratory' : 'Hospital' );?></option>
                                        <?php
                                        foreach ($lab_names as $lKey => $labValues) {
                                            ?>
                                            <option value="<?php echo $labValues["id"]; ?>"><?php echo $labValues["name"]; ?></option>
                                        <?php } ?>
                                        <option value="add_new">Add New Hospital</option>
                                    </select>
                                </div>

                                <!-- Add New Hospital -->
                                <div class="col-md-12" id="add_new_hospital" style="display:none;">
                                    <div class="box-body" style="padding: 25px 0px 0px !important;">
                                        <?php
                                        $attributes = array('method' => 'POST', "id" => 'addHospitalForm');
                                        echo form_open("institute/saveHospitalData/", $attributes);
                                        ?>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <section class="form-group col border-right">
                                                    <h5 class="modal-title">Create Hospital</h5>
                                                    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
                                                    <input type="hidden" name="is_active_directory" value="" id="is_active_directory"/>
                                                    <p class="text-danger"></p>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input class="enter_hospital form-control" placeholder="Institute Name *" name="hospital_name" id="hospital_name" type="search" value="" required />
                                                                <input type="hidden" name="hospital_information" />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input placeholder="First Initial *" class="form-control <?php if ($errors) echo empty($form_data['hospital_initials_1']['error']) ? 'is-valid' : 'is-invalid';  ?>" <?php if ($errors) echo empty($form_data['hospital_initials_1']['error']) ? '' : 'aria-invalid="true"' ?> name="hospital_initials_1" id="hospital_initials_1" maxlength="1" type="text" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input placeholder="Second Initial *" class="form-control <?php if ($errors) echo empty($form_data['hospital_initials_2']['error']) ? 'is-valid' : 'is-invalid';  ?>" <?php if ($errors) echo empty($form_data['hospital_initials _2']['error']) ? '' : 'aria-invalid="true"' ?> name="hospital_initials_2" id="hospital_initials_2" maxlength="1" type="text" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input placeholder="Email" class="form-control <?php if ($errors) echo empty($form_data['hospital_email']['error']) ? 'is-valid' : 'is-invalid' ?>" <?php if ($errors) echo empty($form_data['hospital_email']['error']) ? '' : 'aria-invalid="true"' ?> name="hospital_email" id="hospital_email" value="<?php echo $errors ? $form_data['hospital_email']['value'] : ''; ?>" type="email">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input placeholder="Address" class="form-control" name="hospital_address" id="hospital_address" value="<?php echo $errors ? $form_data['hospital_address']['value'] : ''; ?>" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <select class="form-control" name="hospital_country" id="hospital_country">
                                                                    <option value="">Select Country</option>
                                                                    <?php foreach ($countries as $country) {  ?>
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($country['nicename'] === 'United Kingdom') {
                                                                            $selected = 'selected';
                                                                        } else {
                                                                            $selected = '';
                                                                        }
                                                                        ?>
                                                                        <?php if ($errors && $country['id'] === $form_data['hospital_country']['value']) $selected = 'selected'; ?>
                                                                        <option <?php echo $selected; ?> value="<?php echo $country['id']; ?>"><?php echo $country['nicename']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input placeholder="City" class="form-control" name="hospital_city" id="hospital_city" value="<?php echo $errors ? $form_data['hospital_city']['value'] : ''; ?>" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input placeholder="State/Province" class="form-control" type="text" name="hospital_state" id="hospital_state" placeholder="" value="<?php echo $errors ? $form_data['hospital_state']['value'] : ''; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input placeholder="Postal Code" class="form-control" name="hospital_post_code" <?php echo $errors ? $form_data['hospital_post_code']['value'] : ''; ?> id="hospital_post_code" value="" type="text">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </section>
                                            </div>
                                            <div class="col-md-4">
                                                <section class="form-group">
                                                    <h5 class="modal-title">Hospital Admin</h5>
                                                    <p class="text-danger"></p>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group  ">
                                                                <?php echo form_input(array('type' => 'text', 'name' => 'admin_first_name', 'id' => 'admin_first_name', 'value' => '', 'class' => 'form-control ', 'placeholder' => 'First Name *')); ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <?php echo form_input(array('type' => 'text', 'name' => 'admin_last_name', 'id' => 'admin_last_name', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Last Name *')); ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <?php echo form_input(array('type' => 'text', 'name' => 'admin_email', 'id' => 'admin_email', 'value' => '', 'class' => 'form-control ', 'placeholder' => 'Email *')); ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <?php echo form_input(array('type' => 'text', 'name' => 'admin_phone', 'id' => 'admin_phone', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Phone')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="" style="text-align: center;">
                                            <button type='button' class="btn btn-primary submit-btn" id='saveHospitalFormBtn'>Submit</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- End New Hospital -->
                            </div>
                        </div>

                        <!--<div class="modal-body" style="display:none;" id="dv_speciality">
                            <select name="specialityId" id="specialityId" class="form-control  input-lg select2" onchange="getBookingInLabs('sep'); getTcodesAgainstSpeciality();">
                                <option value="">Select Speciality</option>
                                <?php
/*                                foreach ($Speciality as $sKey => $sValues) {
                                    */?>
                                    <option value="<?php /*echo $sValues->id; */?>"><?php /*echo $sValues->specialty; */?></option>
                                <?php /*} */?>
                            </select>
                        </div>-->

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            
            <div class="col-md-10 mx-auto">
                <div class="row mb-3">
                    <div class="col-md-12 mb-3 text-center">
                        <h3>Order Entry</h3>
                    </div>                    
                     <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
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
                            
                            <div class="edit_area">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                    <!-- <button type="button" class="btn btn-info add_temp" data-toggle="modal" data-target="#add_temp"><i class="fa fa-plus"></i></button> -->
                                    <a class="dropdown-item" href="javascript:;" data-toggle="modal" data-target="#add_temp"><i class="fa fa-plus m-r-5"></i> Add</a>
                                    
                                    <a class="dropdown-item" id="delete_temp_id" href="javascript:;" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                    </div>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        
               
                <div class="col-md-12 form-group" id="template_preview" style="display:none; width:100%" >
                    <div class="row">
                    <div class="col-md-12 form-group " id="edit_tip" style="text-align:right">
                    <a class="dropdown-item" href="javascript:;"  onclick="active_edit();"><i class="fa fa-pencil m-r-5"></i></a>
                    </div>
                    
                        <div class="col-md-3" style="float:left">
                            <div class="card">
                                <div class="row card-body nopadding">
                                <div class="col-md-12 form-group">
                                     
                                        <label for="focus-label">Laboratory</label>
                                        
                                        <input type="text" readonly="readonly"  disabled="disabled" id="lab_name_pre_show2" value="<?php echo $lab_des[0]["description"]; ?>" name="lab_name_pre_show" class="form-control" style="display: none">
                                        <input type="hidden" id="lab_name_pre" name="lab_name_pre" value="<?php echo $lab_des[0]["description"]; ?>">
                                        <select name="labId" disabled="disabled" id="labId" class="labId form-control  input-lg select2" onchange="SetDefaultLab(this)">
                                            <?php
                                            if (!empty($doctor_list)) {
                                                foreach ($lab_info as $lkey => $labData) {
                                                    $selected = '';
                                                    if($labData['description'] == $lab_des[0]["description"]){
                                                        $selected = "selected";
                                                    }
                                                    ?>
                                                    <option value="<?php echo $labData['group_id'] ?>" <?php echo $selected ?>><?php echo $labData['description'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group ">
                                    <input type="hidden" name="template_id" value="" id="template_id" class="form-control input-lg">
                                        <label class="focus-label">Template Name</label>
                                        <input type="text" disabled="disabled" name="template_name_pre" value="Template-001" id="template_name_pre" class="form-control input-lg">
                                    </div>
                                    <div class="col-md-12 form-group ">
                                        <label class="focus-label">Template Ref. No.</label>
                                        <input type="text" disabled="disabled" name="temp_reff_pre" id="temp_reff_pre" class="form-control input-lg">
                                    </div>
                                    <div class="col-md-12 form-group " style="display:none">
                                        <label class="focus-label">Template Author</label>
                                        <input type="text" disabled="disabled" name="temp_author_pre" id="temp_author_pre" class="form-control input-lg">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="focus-label">Clinic</label>
                                        <select name="clinician_data_pre2" disabled="disabled" id="clinician_data_pre2" class="form-control  input-lg select2">                                            
                                           <?php
                                                if (!empty($hospitals)) 
												{
                                                    foreach ($hospitals as $hosKey => $hosValues) {
                //                                            print_r($hosValues); exit; 
                                                        ?>
                     <option value="<?php echo $hosValues["id"] ?>"  ><?php echo $hosValues["description"]; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group " style="display:none">
                                        <label class="focus-label">Request ID</label>
                                        <select name="request_name" disabled="disabled" id="request_name_pre" class="form-control input-lg select2">
                                            <option value="">Select Request ID</option>
                                            <option value="Web Specimen">Web Specimen</option>
                                            <option value="Blocks">Blocks</option>
                                            <option value="Slides">Slides</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"  style="float:left">
                            <div class="card">
                                <div class="row card-body nopadding">
                                    
                                    
                                    
                                    <div class="col-md-12 form-group">
                                        <label for="focus-label">Pathologist</label>
                                        <select name="pathologist_pre" disabled="disabled" id="pathologist_pre" class="pathologist_pop form-control  input-lg select2">
                                            <option>Pathologist</option>
                                            <?php
                                            if (!empty($doctor_list)) {
                                                foreach ($doctor_list as $doctor) {
                                                    ?>
                                                    <option value="<?php echo $doctor->id ?>"><?php echo $doctor->profile_pic ?> <?php echo $doctor->first_name . ' ' . $doctor->last_name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="focus-label">Clinician </label>
                                        <select name="clinician_data_pre" disabled="disabled" id="clinician_data_pre" class="clinician_pop form-control input-lg select2">
                                            <option>Clinician</option>
                                            <?php
                                            if (!empty($clinic_list)) {
                                                foreach ($clinic_list as $doctor) {
                                                    ?>
                                                    <option title="<?php echo $doctor->profile_picture_path; ?>" value="<?php echo $doctor->id ?>"><?php echo $doctor->first_name . ' ' . $doctor->last_name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                   <div class="col-md-12 form-group">
                                        <!--<label for="focus-label">Specimen No</label>
                                        <input type="text" name="specimen_no_pre" id="specimen_no_pre" disabled="disabled" class="form-control input-lg">-->
                                        <label for="focus-label">Department</label>
                                        <select name="department_pre_show" disabled="disabled" id="department_pre_show" class="form-control input-lg select2">
                                            <?php foreach ($department_list as $did => $department) { ?>
                                                <option value="<?= $did; ?>"><?= $department['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

 <div class="col-md-12 form-group">
                                        <label for="focus-label">Speciality</label>
                                        <select name="specialty_pre_show" disabled="disabled" id="specialty_pre_show" class="form-control input-lg select2">
                                            <?php foreach ($speciality_list as $sp) { ?>
                                                <option value="<?= $sp['id']; ?>"><?= $sp['text']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"  style="float:left">
                            <div class="card">
                                <div class="row card-body nopadding">

                                    
                                   
                                    <div class="col-md-12 form-group ">
                                        <label class="focus-label">Sub Speciality</label>                                        
                                        <input type="hidden" id="specialty_pre" name="specialty_pre">
                                        <select name="sub_specialty_pre_show" disabled="disabled" id="sub_specialty_pre_show" class="form-control  input-lg select2">
                                            <?php foreach ($sub_speciality_list as $ss) { ?>
                                                <option value="<?= $ss['id']; ?>"><?= $ss['text']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group ">
                                        <label class="focus-label">Snomed Codes</label>
                                        <input type="hidden" id="snomed_code_pre" name="snomed_code_pre">
                                        <select name="snomed_code_pre_show" disabled="disabled" id="snomed_code_pre_show" class="form-control  input-lg select2">
                                            <?php foreach ($snomed_code_list as $sc) { ?>
                                                <option value="<?= $sc['id']; ?>"><?= $sc['text']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-12 form-group ">
                                        <label class="focus-label">Report Schedule</label>
                                        <input type="text" name="report_schedule" id="report_schedule" disabled="disabled" class="form-control input-lg">
                                    </div>

 <div class="col-md-12 form-group ">
                                        <label class="focus-label">Category</label>
                                        <select name="category_name" disabled="disabled" id="category_name_pre" class="form-control input-lg select2">
                                            <option value="">Select Category</option>
                                            <option value="All">All</option>
                                            <option value="Lab Processing">Lab Processing</option>
                                            <option value="Reporting">Reporting</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group " style="display:none">
                                        <label for="focus-label">Specimen</label>
                                        <select name="specimen_pre_show" disabled="disabled" id="specimen_pre_show" class="form-control input-lg select2">
                                            <option value="">Select Specimen</option>
                                        </select>
                                    </div>

                                    <!--<div class="col-md-12 form-group ">
                                        <label class="focus-label">Snomed Codes</label>
                                        <select name="specimen_type_pre" id="specimen_type_pre" disabled="disabled" class="form-control  input-lg select2">
                                            <?php
/*                                            foreach ($snomed_t_array as $snomed_t_code) {
                                                $snomed_t = strtolower(str_replace(' ', '', trim($snomed_t_code['usmdcode_code'])));
                                                */?>
                                                <option value="<?php /*echo $snomed_t */?>"><?php /*echo $snomed_t_code['usmdcode_code'] */?></option>
                                            <?php /*} */?>
                                        </select>
                                    </div>-->
                                    
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="row card-body nopadding">
                                     <div class="col-md-12 form-group ">
                                        <label class="focus-label">No Of Specimen</label>
                                        <input type="text" name="specimen_no_pre" id="specimen_no_pre" value="1" disabled="disabled" class="form-control input-lg">
                                    </div>
                                    
                                    <div class="col-md-12 form-group ">
                                        <label class="focus-label">Courier ID</label>
                                         <select name="courier_no_pre" id="courier_no_pre" disabled="disabled" class="form-control  input-lg select2">
                                             <option value="">Select Courier ID</option>
                                             <?php
                                            foreach ($courier_data as $courier_l) {
                                                //$snomed_t = strtolower(str_replace(' ', '', trim($snomed_t_code['usmdcode_code'])));
                                                ?>
                                                <!-- <option value="<?php echo $courier_l->courier_no ?>" data-id="<?= $courier_l->id; ?>"><?= $courier_l->courier_no; ?> / <?= date('d-m-Y',strtotime($courier_l->courier_sent_at)); ?></option> -->
                                                <option value="<?php echo $courier_l->courier_no ?>" data-id="<?= $courier_l->id; ?>"><?= $courier_l->courier_no; ?> <?php echo ($courier_l->checklist_title != '') ? "/ ".$courier_l->checklist_title : "" ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                
                                  
                                    
                                    <div class="col-md-12 form-group ">
                                        <label class="focus-label">Receiver Name</label>
                                        <input type="text" name="batch_no_pre" id="batch_no_pre" disabled="disabled" class="form-control input-lg">
                                    </div>
                                    
                                    

                                    <div class="col-md-12 form-group " style="display:none">
                                        <label class="focus-label">Stamp Date Time</label>
                                        <div class="cal-icon">
                                            <input name="stamp_date_pre" id="stamp_date_pre" disabled="disabled" class="form-control input-lg datetimepicker" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-12 form-group ">
                                        <label for="focus-label">Tissue Type</label>
                                        <select name="tissue_type_pre_show" disabled="disabled" id="tissue_type_pre_show" class="form-control input-lg select2">
                                            <option value="">Select Tissue Type</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           <div class="clearfix"></div>
        
        
<div id="add_temp" class="modal custom-modal fade" role="dialog">
<form id="track_temp_add_form" action="<?php echo base_url() ?>institute/save_new_track_temp_data" name="track_temp_add_form" method="post">

<div class="modal-dialog modal-dialog-centered modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Add Template</h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<div class="row" style="display:none">
<div class="col-md-12  mb-4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-5 mb-2"><strong><?php echo ($group_type =="H" ? 'Laboratory:' : 'Hospitals:');?></strong> <span id="p_lab"> <?php echo $lab_names[0]["description"]; ?> </span> 
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-7 mb-2"><strong>Speciality: </strong> <span id="p_sep"> <?php echo $Speciality[0]->specialty; ?> </span>
                        <button style="display:none" class="btn btn-primary btn-sm ml-5 " data-toggle="modal" data-target="#openLabs">Change</button> 
                        </div>
                       
                        
                    </div>
                </div>
</div>


<input type="hidden" name="bookingin_lab_id" id="bookingin_lab_id"  value="<?php echo $lab_names[0]["id"]; ?>" />
<input type="hidden" name="bookingin_sepciality_id" id="bookingin_sepciality_id"  value="<?php echo $Speciality[0]->id; ?>" />
                                <div class="edit_fields">
                                    <div class="row">
                                        <input type="hidden" name="edit_mod" value="add">
                                        <div class="col-md-6 form-group ">
                                            <label class="focus-label">Template Name</label>
                                            <input type="text" name="template_name_pop" value="Template-<?php print $group_type;?>-<?php print $uniq_number; ?>" class="form-control input-lg">
                                        </div>
                                        <div class="col-md-6 form-group ">
                                            <label class="focus-label">Template Ref No.</label>
                                            <input type="text" name="temp_reff_no_add" value="HS<?php print $group_type;?>-<?php print date("y");?>-<?php print $uniq_number; ?>" class="form-control input-lg">
                                        </div>
                                        <div class="col-md-6 form-group " style="display:none">
                                            <label class="focus-label">Template Author</label>
    <input type="text" name="temp_author" class="form-control input-lg" value="<?php echo $authorname[0]->username ?>">
                                        </div>
                                        
                                        <!--                            <div class="col-md-6 form-group">
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
                                                                    </div>-->
                                                                    
                                            <div class="col-md-6 form-group">
                                            <label for="focus-label">Clinic</label>
                                            <select name="hospital_id" class="hospital_pop form-control select2" id="hospital_id">
                                                <option>Clinic</option>
                                                <?php
                                                if (!empty($hospitals)) 
												{
                                                    foreach ($hospitals as $hosKey => $hosValues) {
                //                                            print_r($hosValues); exit; 
                                                        ?>
                     <option value="<?php echo $hosValues["id"] ?>" <?php if($hosValues["id"]==$lab_names[0]["id"]){?> selected="selected" <?php } ?> ><?php echo $hosValues["description"]; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                                                    
                                        <div class="col-md-6 form-group">
                                            <label for="focus-label">Pathologist</label>
                                  <select name="pathologist_pop" class="pathologist_pop select2" onchange="show_hide('loc_id')">                                                
                                                <?php
                                                if (!empty($doctor_list)) {
                                                    foreach ($doctor_list as $doctor) 
													{
                                                        ?>
<option title="assets/img/person-male.png" value="<?php echo $doctor->id ?>"><?php echo $doctor->first_name . ' ' . $doctor->last_name ?></option>

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
                                            <label class="focus-label">Date and Time</label>
                                            <div class="cal-icon">
                                                <input name="dateandtime" class="form-control input-lg datetimepicker" type="text" value="<?php echo date("Y-m")."-2022 ".date("hh:mm:ss"); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group " style="display:none">
                                            <label class="focus-label">Specimen</label>
                                            <div id="spctype_div d-flex">
                                                <label><input type="checkbox" name="multiple" onchange="show_hide('spe_no')"  /> <span style="margin-top: -5px;">Multiple</span> </label>
                                                <label>
                                                    <input type="checkbox" name="matching" onchange="show_hide('spe_no')"  /> Matching
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label for="focus-label">Department</label>
                                            <select name="department_id" class="form-control select2" id="department_id">
                                                <option value="">Select Department</option>
                                                <?php foreach ($department_list as $did=>$department){ ?>
                                                <option value="<?= $did; ?>"><?= $department['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-6 form-group">
                                            <label for="focus-label">Tissue Type</label>
                                            <select name="tissue_type_id" class="form-control select2" id="tissue_type_id">
                                                <option value="">Select Tissue Type</option>
                                            </select>
                                        </div>
<div class="col-md-6 form-group" style="display:none">
                                            <label for="focus-label">Speciality</label>
                                            <select name="specimen_id" class="form-control select2" id="specimen_id">
                                                <option value="">Select Speciality</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group" style="display:none">
                                            <label for="focus-label">Request Type</label>
                                            <select name="request_name" class="form-control select2" id="request_name">
                                                <option value="">Select Request Type</option>
                                                <option value="Web Specimen">Web Specimen</option>
                                                <option value="Blocks">Blocks</option>
                                                <option value="Slides">Slides</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group" style="display:none">
                                            <label for="focus-label">Category</label>
                                            <select name="category_name" class="form-control select2" id="category_name">
                                                <option value="">Select Category</option>
                                                <option value="All">All</option>
                                                <option value="Lab Processing">Lab Processing</option>
                                                <option value="Reporting">Reporting</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 form-group" id="bill_type" style="display:none">
                                            <div>
                                                <label for="bill_type_1"><input type="radio" name="billing_type" value="by_request" id="bill_type_1" checked />&nbsp;By Request</label>&nbsp;&nbsp;
                                                <label for="bill_type_2"><input type="radio" name="billing_type" value="by_specimen" id="bill_type_2" />&nbsp;By Specimen</label>&nbsp;&nbsp;
                                                <label for="bill_type_3"><input type="radio" name="billing_type" value="not_billed" id="bill_type_3" />&nbsp;Not Billed (PCI)</label>
                                            </div>
                                        </div>


                                        <div class="col-md-6 form-group " style="display:none" id="spe_no">
                                            <label class="focus-label">Specimen No</label>
                                            <div id="spctype_div">
                                      1 <input type="radio" name="multiple" value="1" onclick="getSpecimanRow('1');"  />
                                      2 <input type="radio" name="multiple" value="2" onclick="getSpecimanRow('2');" />
                                      3 <input type="radio" name="multiple" value="3" onclick="getSpecimanRow('3');" />
                                      4 <input type="radio" name="multiple" value="4" onclick="getSpecimanRow('4');" />
                                      5 <input type="radio" name="multiple" value="5" onclick="getSpecimanRow('5');" />
                                    </div>
                                        </div>

                                        <div id="speciman_type_div" class="row"></div>

                                    </div>
                                </div>
                            
                        </div>
                        <div class="my-3 text-center submit_all">
                            <button class="btn btn-info" id="save-track-template-add">Submit</button>
                        </div>
                    </div>
                </div>
                 </form>
            </div>
                    
                    
    <div class="col-sm-12" id="template_preview_option" style="display:none;">
    
                    
                    <div class="col-sm-4 user-card" style="float:left">
                        <div class="profile-widget">

                            <div class="profile-img">

                                <a href="javascript:;" class="avatar" style="max-width: 50px; max-height: 50px;">
                                    <img src="<?php echo base_url(); ?>assets/img/user.jpg"
                                         alt="">
                                </a>

                            </div>

                            <h4 class="user-name m-t-10 mb-0 text-ellipsis">
                                <button class="btn btn-link collapsed accordion-button" data-toggle="collapse" data-target="#patient-booking" aria-expanded="false" aria-controls="patient-booking">
                                    By Patient
                                </button>
                            </h4>

                        </div>
                    </div>
                    <div class="col-sm-4 user-card" style="float:left">
                        <div class="profile-widget">

                            <div class="profile-img">
                                <a href="javascript:;" class="avatar" onclick="showupload()" style="max-width: 50px; max-height: 50px;">
                                    <img src="<?php echo base_url(); ?>assets/img/user.jpg"
                                         alt="">
                                </a>
                                <a href="javascript:;" class="avatar" onclick="showupload()" style="max-width: 50px; max-height: 50px;">
                                    <img src="<?php echo base_url(); ?>assets/img/user.jpg"
                                         alt="">
                                </a>
                                <a href="javascript:;" class="avatar" onclick="showupload()" style="max-width: 50px; max-height: 50px;">
                                    <img src="<?php echo base_url(); ?>assets/img/user.jpg"
                                         alt="">
                                </a>
                            </div>

                            <h4 class="user-name m-t-10 mb-0 text-ellipsis">
                            <button class="btn btn-link batch_create_records btn btn-link collapsed accordion-button" type="button"  >
                                    By Batch
                                </button>
                              <!--   <button class="btn btn-link accordion-button" type="button" data-toggle="collapse" data-target="#batch-bookingin" aria-expanded="true" aria-controls="batch-bookingin">
                                    By Batch
                                </button>
                                                               <a href="#" onclick="showupload()">Batch Entry</a>-->

                            </h4>

                        </div>
                    </div>
                    
                    <div class="col-sm-4 user-card" style="float:left">
                        <div class="profile-widget">

                            <div class="profile-img">
                                <a href="javascript:;" class="avatar" onclick="showupload()" style="max-width: 50px; max-height: 50px;">
                                    <img src="<?php echo base_url(); ?>assets/img/user.jpg"
                                         alt="">
                                </a>
                                <a href="javascript:;" class="avatar" onclick="showupload()" style="max-width: 50px; max-height: 50px;">
                                    <img src="<?php echo base_url(); ?>assets/img/user.jpg"
                                         alt="">
                                </a>
                                <a href="javascript:;" class="avatar" onclick="showupload()" style="max-width: 50px; max-height: 50px;">
                                    <img src="<?php echo base_url(); ?>assets/img/user.jpg"
                                         alt="">
                                </a>
                            </div>

                            <h4 class="user-name m-t-10 mb-0 text-ellipsis">
                                <button class="btn btn-link accordion-button batch_up" type="button" data-toggle="collapse" data-target="#batchupload" aria-expanded="true" aria-controls="batchupload">
                                    Batch Upload
                                </button>
                                <!--                                <a href="#" onclick="showupload()">Batch Entry</a>-->

                            </h4>

                        </div>
                    </div>
                    
                    
                    
                    </div>
                    <div class="clearfix"></div>
                    <!-- <div class="col-md-12 mb-3">
                        <input type="text" class="form-control input-lg" placeholder="Search">
                    </div> -->
					
                </div>
            </div>

        </section>
    <div class="col-md-12 ml-auto" >
        <div id="batchupload" class="collapse" aria-labelledby="batch-upload-heading" data-parent="#bookingin-accordion" style="background: #fff; box-shadow: 0px 0px 3px #ccc; padding: 20px; box-sizing: border-box;">
            <form action="<?php echo base_url('institute/addBookingDataFromCsv'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="col-lg-12">
                    <div class="row">
                        
                        <div class="col-md-4">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
<!--                            <input type="file" name="image" id="image" style="margin-top: 3px;"/>-->
                            <input type="file" name="UploadCSV" id="UploadCSV">
                            <input type="hidden" name="track_template_name" value="5465465" id="track_template_name"/>
                        </div>
                        <div class="col-md-4 text-center">
                            <a href="<?php echo base_url('assets/upload/Booking.csv'); ?>">Download sample file</a>
                        </div>
                        <div class="col-md-4 text-right">
                            <button class="btn btn-default">Bulk Upload</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

    
    <div id="batch-bookingin" class="collapse" aria-labelledby="batch-booking-heading" data-parent="#bookingin-accordion">
        
        
        
           
        
        
        <div class="card-body mb-5">
            <div class="doctorSCard">
                <div class="row">


                    <div class="col-sm-6 col-md-7">
                        <div class="form-group form-focus">
                            <input type="hidden" class="form-control floating" value="<?php print "NP-21-".rand(10000,99999);?>" id="barcode_no" name="barcode_no">
                           <select name="patients_pre" id="patients_pre" class="form-control input-lg select2 select2-hidden-accessible" data-select2-id="patients_pre" tabindex="-1" aria-hidden="true">
                                            <option data-select2-id="8">Search Patient</option>
                                            
                                            <?php
                                            if (!empty($patients)) {
                                                foreach ($patients as $patient) {
                                                    ?>
                                                    <option value="<?php echo $patient['patient_id']; ?>"><?php echo $patient['first_name']; ?> <?php echo $patient['last_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            
                                            
                                                                                           </select>
                        </div>
                    </div>
                    <div class="col-md-2 nopadding">
   <button class="btn btn-success btn-block btn-lg search_btn batch_create_records" style="font-size:13px">Add Record</button><div class="col-sm-2">
                        <div class="row">
                         
                             <div class="col-md-3  col-lg-3 col-xl-3 nopadding" style="display:none">
                                <a href="javascript:;" class="list_view_show"><i class="fa fa-th fa-bars fa-2x cog-class"></i></a>
                            </div>
                        </div>
                    </div>
                    </div>

                </div>
            </div>




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

                                    <select name="clinician_no" id="clinician_no" class="form-control input-lg">
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

            <div class="col-md-12 record_add_result">
                <?php if (1) { ?>
                   <!-- <a target="_blank" class="btn btn-default" href="<?php echo base_url('institute/print_session_records'); ?>">Print Records</a>-->
                    <table class="track_search_table table table-stripped custom-table" style="width: 130%;">
                        <tr>
                            <th>UL No.</th>
                            <th>Track No.</th>
                            <th>Client</th>
                            <th>First Name</th>
                            <th>Surname</th>
                            <th>DOB</th>
                            <th>NHS No.</th>
                            <th>Lab No.</th>
                           
                            <th>Status</th>
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
                                <?php /*?><td><?php echo ucwords(substr($row_data['report_urgency'], 0, 1)); ?></td>
                                <td>
                                    <?php
                                    $publish_date = '';
                                    if (!empty($row_data['publish_datetime'])) {
                                        $publish_date = date('d-m-Y', strtotime($row_data['publish_datetime']));
                                    }
                                    echo $publish_date;
                                    ?>
                                </td><?php */?>
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


            <div class="col-md-12">  
            </div>

            <!-- Page Content -->
            <div class="container-fluid">
                <p id="lab-specialty"></p>
                <div class="accordion" id="bookingin-accordion">
                    <!-- Page Content -->
                    <div class="row">
                        <div class="col-md-12">
                           
                           
                                        <div class="clerafix"></div>

                            <!-- Page Content -->
                            <div class="content container-fluid">


                                <p id="lab-specialty"></p>


                                <!-- Preview Section Ends-->
                            </div>
                        </div>

                    </div>

                </div>
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
                        });</script>


            
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
                        function showupload()
                        {
                        $("#dis_data").show();
                        }
						
				function showPatientRecord(pId) 
				{
        //console.log($("#booking_patient_id").val()); return false; 
        let pid = pId;
        let courier_no = $(document).find('#courier_no_pre').val();
        let courier_id = $('#courier_no_pre option').filter('[value=' + courier_no + ']').attr('data-id');
		//alert($('#template_name').val());
        $.ajax(
            {
                url: _base_url+'institute/add_patient_record',
                method: 'POST',
                data: {patient_id: pid, speciality_id:21, lab_id: $('#bookingin_lab_id').val(),tem_id:$('#template_name').val(), status_code: 'Booked In To Lab', 'courier_id': courier_id },
                success: function(data) {                    
                    if (data.type === 'success') {
                        setTimeout(function () {
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                            $('.patient_record_add_result').html(data.track_data);
                            show_flags_on_hover();
                            change_flag_status();
                            flag_tooltip();
                            window.location.href = data.redirect_url;
                        }, 500);
                    }
                },
                error: function (xhr, st, s) {
                    jQuery.sticky("Error Occurred, Try again later.", { classList: 'important', speed: 200, autoclose: 7000 });
                    console.log(xhr);
                }
            }
        );
    }		

                /*function showPatientRecord(pId) 
				{
				$("#ta"+pId).css("background-color", "#ccc");
				$("#selected-patient-show").show();
				
                $('.patient_record_add_result').html('');
                        if (pId > 0){
                $.ajax(
                {
                url: _base_url+'institute/get_patient_record',
                        method: 'POST',
                        data: {patient_id: pId},
                        success: function(data) {
                        $('.patient_record_add_result').html(data);
                                $('#selected-patient-show').show();
                                //            if (data.type === 'success') {
                                //            setTimeout(function () {
                                //            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                                //                    $('.patient_record_add_result').html(data);
                                //                    show_flags_on_hover();
                                //                    change_flag_status();
                                //                    flag_tooltip();
                                //            }, 500);
                                //            }
                        },
                        error: function (xhr, st, s) {
                        jQuery.sticky("Error Occurred, Try again later.", { classList: 'important', speed: 200, autoclose: 7000 });
                                console.log(xhr);
                        }
                }
                );
                }


                }*/

                function SetDefaultLab(row){
                    var labname = $(row).val();
                    $('#bookingin_lab_id').val(labname);
                }

                function getBookingInLabs(dropdown = '')
				{

                if (dropdown == 'lab'){
                    var lab_id = $("#lab_name").val();
                    if(lab_id == 'add_new'){
                        $('#add_new_hospital').show();
                    }else{
                        $('#add_new_hospital').hide();
                        var attText = $("#lab_name option:selected").text();
                        $("#p_lab").html(attText);
                        $("#bookingin_lab_id").val(lab_id);
                    }
                }


                $("#dv_speciality").show();
                        if (dropdown == 'sep'){
                var sep_id = $("#specialityId").val();
                        var sepText = $("#specialityId option:selected").text();
                        $("#p_sep").html(sepText);
                        $("#bookingin_sepciality_id").val(sep_id);
                }


                }


 				function getDrLocation(dropdown = '')
				{

                if (dropdown == 'lab')
				{
                var lab_id = $("#lab_name").val();
                        var attText = $("#lab_name option:selected").text();
                        $("#p_lab").html(attText);
                        $("#bookingin_lab_id").val(lab_id);
                }


                $("#dv_speciality").show();
                        if (dropdown == 'sep')
						{
                var sep_id = $("#specialityId").val();
                        var sepText = $("#specialityId option:selected").text();
                        $("#p_sep").html(sepText);
                        $("#bookingin_sepciality_id").val(sep_id);
                }


                }



                function improt_csv()
                {
                var year = '2021';
                        var photo = document.getElementById("image");
                        var file = photo.files[0];
                        alert(photo);
                        data = new FormData();
                        if (photo.files[0]) {
                data.append('file', file);
                } else {
                alert('upload csv file to further proceed it');
                        return false;
                }
                data.append('year', year);
                        $.ajax({
                        type: 'POST',
                                url: '<?php echo base_url() ?>institute/eximportcsv/' + year,
                                data: data,
                                enctype: 'multipart/form-data',
                                processData: false,
                                contentType: false,
                                beforeSend: function () {
                                $('.submitBtn').attr("disabled", "disabled");
                                        $('.modal-body').css('opacity', '.5');
                                },
                                success: function (msg) {
                                window.location = '<?php echo base_url('appadmin/expense/list') ?>';
                                },
                                error: function () {
                                $('#group_type_msg1').html('<span class="alert alert-danger col-sm-12 top10">Error! Announcement is not saved.</span>');
                                }
                        });
                }


                function getTcodesAgainstSpeciality()
                {
                var speciality_id = $("#bookingin_sepciality_id").val();
                        // data.append('speciality_id', speciality_id);
                        $.ajax({
                        url: `${_base_url}institute/getTCodesAgainstSpeciality`,
                                type: 'POST',
                                //global: false,
                                dataType: 'json',
                                data: { 'speciality_id': speciality_id },
                                success: function (data) {
                                    //alert(data); return false; 
                                if (data.type === 'success') {
                                 //   console.data(data); return false; 
                                    $("#dv_tCodes").append(data.data);
                                    $("#dv_tCodes").show();


                                } else {
                                setTimeout(function () {
                                _this.parents('.tg-inputicon').find('i').remove();
                                        jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                                        _this.parents('.tg-trackrecords').find('.tracking_search_result').html('');
                                }, 500);
                                }
                                $('input[name=barcode_no]').focus();
                                },
                                error: function (data) {
                                console.log('Error Data: ', data);
                                        jQuery.sticky('No TCode Found', { classList: 'important', speed: 200, autoclose: 7000 });
                                }
                        });
                }
				
				
				function show_hide(ids)
				{
					//alert(ids);
					$("#"+ids).show();
					if(!$('#'+ids).is(':visible'))
					{
						//$("#"+ids).hide();
					}
					else
					{
						//$("#"+ids).show();
					}
				}
            </script>

        </div>
    </div>
    </div>
 <script>
    $(document).ready(function(){
        $('#labId').trigger('change');
        $(".pathologist_pop").select2({
            placeholder: 'Nothing Selected',
            width: '100%',
            templateResult: formatUsersList,
            templateSelection: formatUsersList
        });
        function formatUsersList(user) {
            console.log(user);
            if (!user.id) {
                return user.text;
            }
            var picture_path = user.element.title;
            var base_url = "https://pci.pathhub.uk/";
            var full_picture_path = base_url + "/" + picture_path;


            var $user_option = $(
                '<span ><img style="display: inline-block;" width="30" height="30" src="' + full_picture_path + '" /> ' + user.text + '</span>'
            );
            return $user_option;
        }
    });
</script>   
    
    
    
    
    
    
    

    <div class="card doctorSCard collapse form-group mb-3" id="adv_searc_area">
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
    <!-- <div id="patient-booking" class="collapse" aria-labelledby="patient-booking-heading" data-parent="#bookingin-accordion">
        <div class="col-auto float-right ml-auto">
           
        </div>
        <div class="card-body">
            <h3>Find Patient </h3>

            
        </div>
    </div> -->

<div class="collapse"  id="patient-booking" aria-labelledby="patient-booking-heading" data-parent="#bookingin-accordion">
    <div class="card">
        <div class="card-body">
            <div class="col-md-12 form-group">
                <div class="card-title"><strong>Find a Patient</strong></div>
                   <div id="selected-patient-show" style="display:none" >
                        <div class="row">
                            <div class="col-md-8">
                                 <h4>Add Record for the patient</h4>

                                <!-- Add a bootstrap button to submit -->
                               
                            </div>
                            <div class="col-md-4 text-right">
                                 <button class="btn btn-primary" id="create-patient-record">Add Record</button>
                            </div>
                        </div>
                       
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="patient_record_add_result"></div>
                        </div>
                    </div>
              
                        
                <div class="col-md-12 mb-3 text-right">
                    
                    
                </div>


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

            <div class="table-responsive mb-4 mt-3">
                <div style="clear:both"></div>

                <table class="table custom-table datatable table-striped" id="bookingpatienttbl" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>DOB</th>
                            <th>Patient Id</th>
                            <th>Contact</th>
                            <th>City</th>
                            <th>PostCode</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($patients as $patient) :
                            //print_r($patient); 
                            $dob = $patient['dob'];
                           // $age = date('Y') - date('Y', strtotime($dob));
							
							$today = new DateTime();
							$dob_obj = date_create($dob);
							$diff = $today->diff($dob_obj);
							$age = $diff->y." y ";
							
                            ?>
                            <tr id="ta<?php echo $patient['patient_id']; ?>" data-id="<?php echo $patient['patient_id']; ?>">
                                <td><?php echo $patient['first_name']; ?> <?php echo $patient['last_name']; ?></td>
                                <td><?php echo $dob; ?> / <?php print $age; ?></td>
                                <td><?php echo $patient['p_id_1']; ?></td>
                                <td><?php echo $patient['phone']; ?></td>
                                <td><?php echo $patient['city']; ?></td>
                                <td><?php echo $patient['post_code']; ?></td>
                                <td><!--<button class="btn btn-primary btn-sm" data-dismiss="modal" data-toggle="modal" data-target="#add_specimen"><i class="fa fa-plus"></i> Specimen</button>-->
                                
                                <button class="btn btn-info btn-sm" onclick="showPatientRecord(<?php echo $patient['patient_id']; ?>);"  ><i class="fa fa-plus"></i>Record</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    

                </table>
            </div>
        </div>
            
      </div>
  </div>
</div>
</div>

<!-- <div class="collapse"  id="patient-booking" aria-labelledby="patient-booking-heading" data-parent="#bookingin-accordion">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Find a Patient</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      <div class="clearfix"></div>
      </div>

      <div class="modal-body" style="max-height: 550px; overflow-y: auto;" >
      
      
      <div id="selected-patient-show" style="display:none" >
                <h4>Add Record for the patient</h4>

                <button class="btn btn-primary" id="create-patient-record">Add Record</button>
            </div>
            <div class="patient_record_add_result"></div>
      
      
        <div class="col-md-12 mb-3 text-right">
            
            
        </div>


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

            <div class="table-responsive mb-4 mt-3">
                <div style="clear:both"></div>

                <table class="table custom-table datatable table-striped" id="patient-table2" style="width: 100%;">
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
                        <?php
                        foreach ($patients as $patient) :
                            //print_r($patient); 
                            $dob = $patient['dob'];
                            $age = date('Y') - date('Y', strtotime($dob));
                            ?>
                            <tr id="ta<?php echo $patient['patient_id']; ?>" data-id="<?php echo $patient['patient_id']; ?>" onclick="showPatientRecord(<?php echo $patient['patient_id']; ?>);">
                                <td><?php echo $patient['first_name'] . ' ' . $patient['last_name']; ?></td>
                                <td><?php echo $patient['nhs_number']; ?></td>
                                <td><?php echo $patient['dob']; ?></td>
                                <td><?php echo $age; ?></td>
                                <td><?php echo $patient['gender']; ?></td>
                                <td>
                                
                                <button class="btn btn-primary btn-sm" onclick="showPatientRecord(<?php echo $patient['patient_id']; ?>);"  ><i class="fa fa-plus"></i> Select</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
</div> -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<div class="modal" id="add_patient">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Patient</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<div class="modal" id="add_specimen">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Specimen</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
</div>

<script>
function updateDrLocation(ids) 
{
        let lab_id = ids;
        $.ajax({
            url: _base_url + 'institute/get_dr_location',
            data: {lab_id},
            success: function(data) 
			{
                if (data.status === 'success') {
                    departments = data.departments;
                    let selected_department = 0;
                    for(let [id, department] of Object.entries(departments)) {
                        if (department.name === 'Pathology') {
                            select_department.append(`<option selected value="${d_id}">${department.name}</option>`);
                            selected_department = d_id;
                        } else {
                            select_department.append(`<option value="${d_id}">${department.name}</option>`);
                        }
                        show = true;
                    }
                    if (show) {
                        $("#department_id_container").show();
                        if (selected_department === 0) {
                            selected_department = Object.keys(departments)[0];
                        }
                        updateSpecialty(selected_department);
                    } else {
                        $("#department_id_container").hide();
                        $("#specialty_id_container").hide();
                        $("#test_category_container").hide();
                    }
                } else {
                    $('.lab_id').addClass('is-invalid');
                    $('.lab_id').siblings('.invalid-feedback').html(data.message);
                }
                
            },
            error: function(xhr, statusText, status) {
                console.log(xhr);
            }
        });
    }
	


var departmentId;
  var specimen_num=0;
  function checkform(){
    alert('ok');
    return false;
  }
  function get_cate_speciman(row='', specialties_id=''){
    var dList = JSON.parse('<?php echo $dep_list;?>');
    var chtml='';
    var spe_html='';
    chtml+=`<option>Category</option>`;
    spe_html+=`<option>Specimen Type</option>`;
    for(var j=0; j<dList.length; j++){
      if(departmentId == dList[j].department_id){
        for(let n=0; n<dList[j].specialties.length; n++){
          if(specialties_id == dList[j].specialties[n].specialties_id)
		  {
            for(let m=0; m<dList[j].specialties[n].category.length; m++){
              chtml+=`<option value="`+dList[j].specialties[n].category[m].category_id+`">`+dList[j].specialties[n].category[m].category_name+`</option>`;
            }

            for(let m=0; m<dList[j].specialties[n].specimen.length; m++){
              spe_html+=`<option value="`+dList[j].specialties[n].specimen[m].specimen_id+`">`+dList[j].specialties[n].specimen[m].specimen_name+`</option>`;
            }
          }
          
        }
      }
    }
    $('#category_'+row).html(chtml);
    $('#specimen_'+row).html(spe_html);

  }
  function get_specility(row='', department_id=''){
    departmentId = department_id;
    var dList = JSON.parse('<?php echo $dep_list;?>');
    var shtml='';
    shtml+=`<option>Speciality</option>`;
    for(var j=0; j<dList.length; j++){
      if(department_id == dList[j].department_id){
        for(let n=0; n<dList[j].specialties.length; n++){
          shtml+=`<option value="`+dList[j].specialties[n].specialties_id+`">`+dList[j].specialties[n].specialties_name+`</option>`;
        }
      }
    }
    $('#specialties_'+row).html(shtml);
  }

  function get_doctors(row='', hospital_id=''){
    hospital_id = hospital_id;
    var dList = JSON.parse('<?php echo $dep_list;?>');
    var shtml='';
    shtml+=`<option>Pathologist</option>`;
    for(var j=0; j<dList.length; j++){
      if(hospital_id == dList[j].department_id){
        for(let n=0; n<dList[j].specialties.length; n++){
          shtml+=`<option value="`+dList[j].specialties[n].specialties_id+`">`+dList[j].specialties[n].specialties_name+`</option>`;
        }
      }
    }
    $('.clinician_pop').html(shtml);
  }


  function getBatchName(hospitalId){
    $.ajax({
        url: `institute/getHospitalclinicians/`+hospitalId,
        type: 'POST',
        global: false,
        dataType: 'json',
        data: { "hospitalId": hospitalId },
        success: function (response) {
            if (response.status === 'success') {
                $('#batch_no_pre').val(response.data.receiver_email);
                $('#stamp_date_pre').val(response.data.stamp_date);
                saveBatchData(response.data.receiver_email);
            } else {
                $('#batch_no_pre').val('');
                $.sticky(response.message, {classList: 'important', speed: 200, autoclose: 7000});
            }
        }
    });
}


 function getSpecimanRow(sno){
  specimen_num = sno;
  var dList = JSON.parse('<?php echo $dep_list;?>');

  var html='';
  for(var i=1; i<=sno; i++){
    html+=`<div class="col-md-12 form-group ">
    <label class="focus-label">Specimen `+i+`</label>
    </div>               


    <div class="col-md-3 form-group ">
    <label class="focus-label">Departments</label>

    <select name="department_no_pop[]" class="clinician_pop form-control select2" onchange="get_specility(`+i+`, this.value)">
    <option>Departments</option>`;
    for(var k=0; k<dList.length; k++){
      html+=`<option value="`+dList[k].department_id+`">`+dList[k].department_name+`</option>`;
    }

    html+=`</select>


    </div>
    <div class="col-md-3 form-group ">
    <label class="focus-label">Speciality</label>

    <select name="specialties_no_pop[]" id="specialties_`+i+`" class="clinician_pop form-control select2 " onchange="get_cate_speciman(`+i+`, this.value)">
    <option>Speciality</option>

    </select>


    </div>

    <div class="col-md-3 form-group ">
    <label class="focus-label">Category</label>

    <select name="category_no_pop[]" id="category_`+i+`" class="clinician_pop form-control select2 ">
    <option>Category</option>
   
    </select>


    </div>

    <div class="col-md-3 form-group ">
    <label class="focus-label">Specimen Type</label>

    <select name="specimen_no_pop[]" id="specimen_`+i+`" class="clinician_pop form-control select2 ">
    <option>Specimen Type</option>
   

    </select>

    </div>`;
  }
  $('#speciman_type_div').html(html);
}	
	
function active_edit()
{
	$( "#template_name_pre" ).prop( "disabled", false );
	$( "#temp_reff_pre" ).prop( "disabled", false );
	$( "#temp_author_pre" ).prop( "disabled", false );
	$( "#pathologist_pre" ).prop( "disabled", false );
    $( "#labId" ).prop( "disabled", false );
	$( "#clinician_data_pre" ).prop( "disabled", false );
	$( "#specimen_no_pre" ).prop( "disabled", false );
	$( "#clinician_data_pre2" ).prop( "disabled", false );
	$( "#request_name_pre" ).prop( "disabled", false );
	$( "#category_name_pre" ).prop( "disabled", false );

	$( "#department_pre_show" ).prop( "disabled", false );
    $( "#specimen_pre_show" ).prop( "disabled", false );
    $( "#tissue_type_pre_show" ).prop( "disabled", false );
	$( "#specialty_pre_show" ).prop( "disabled", false );
	$( "#sub_specialty_pre_show" ).prop( "disabled", false );
	$( "#snomed_code_pre_show" ).prop( "disabled", false );
	$( "#specimen_type_pre" ).prop( "disabled", false );
	$( "#courier_no_pre" ).prop( "disabled", false );
	$( "#batch_no_pre" ).prop( "disabled", false );
	$( "#dateandtime_pre" ).prop( "disabled", false );
    $( "#stamp_date_pre" ).prop( "disabled", false );
	$( "#edit_tip" ).hide();
	//$( "#x" ).prop( "disabled", false );
}
	
</script>

