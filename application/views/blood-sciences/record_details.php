
<style type="text/css">
        .input-group-append button{
        position: absolute;
        right: 0;
        z-index: 99;
        line-height: 1.75;
    }
    a.nav-link.active.show {
        background: #009efb1f;
    }
    .card-header {
        padding: 10px;
        overflow: hidden;
    }
</style>
<div class="container-fluid">
    <div class="page-header" style="padding: 0 15px;">
        <div class="align-items-center">
            <div class="col">
                <h3 class="page-title">Record Details</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
                    <li class="breadcrumb-item">Blood Sciences</li>
                    <li class="breadcrumb-item active">Record Details</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="tg-haslayout">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form class="tg-formtheme" id="doctor_update_personal_record" method="post">
                    <div class="col-md-12 form-group" style="padding-right: 0;">
                        <div class="sec_title p_id form-group"> <span id="" class="">
                                Patient ID
                                <span class="edit_icon pull-right make_editable" style="margin-right: 40px;">
                                    <i class="fa fa-pencil"></i>
                                </span> </span>
                             </div>
                        <div class="card">
                            <div class="card-body form-group">
                                <div id="table-view-patient">
                                    <div class="row">
                                        <div class="form-group col-sm-3"> <span class="tg-namelogo">VR</span>
                                            <div class="tg-nameandtrack">
                                                <h3>VALERIE, RICHARDSON                                            </h3> <span>UL-20-23921                                                <em>|</em>
                                            <em>20-PH0001</em>
                                        </span> </div>
                                            <figure class="tg-nameandtrackimg"> <span> F</span> <span>57</span> </figure>
                                        </div>
                                        <div class="col-md-3 nopadding">
                                            <div class="col-sm-6 nopadding">
                                                <div class="table-view-container">
                                                    <div class="row" data-key="patient_initial">
                                                        <div class="table_view_svg col-sm-2 change_status_color" style="margin-left: 0">
                                                            <svg class="svg_patient_initial" width="26" height="26">
                                                                <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                                <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                            </svg>
                                                        </div>
                                                        <div class="col-sm-9 ">
                                                            <div class="table-view-heading">Initials</div>
                                                            <div class="table-view-content">VR</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nopadding">
                                                <div class="table-view-container">
                                                    <div class="row" data-key="gender">
                                                        <div class="table_view_svg col-sm-2 change_status_color" style="margin-left: 0">
                                                            <svg class="svg_gender" width="26" height="26">
                                                                <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                                <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                            </svg>
                                                        </div>
                                                        <div class="col-sm-9 ">
                                                            <div class="table-view-heading">Gender</div>
                                                            <div class="table-view-content">Female</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row" data-key="f_name">
                                                    <div class="table_view_svg col-sm-2 change_status_color">
                                                        <svg class="svg_f_name" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">First Name</div>
                                                        <div class="table-view-content">VALERIE</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row" data-key="sur_name">
                                                    <div class="table_view_svg col-sm-2 change_status_color">
                                                        <svg class="svg_sur_name" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Surname</div>
                                                        <div class="table-view-content">RICHARDSON</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row" data-key="dob">
                                                    <div class="table_view_svg col-sm-2 change_status_color">
                                                        <svg class="svg_dob" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">DOB</div>
                                                        <div class="table-view-content">05-09-1963</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row" data-key="nhs_number">
                                                    <div class="table_view_svg col-sm-2 change_status_color">
                                                        <svg class="svg_nhs_number" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">NHS No.</div>
                                                        <div class="table-view-content">7083437865</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row">
                                                    <div class="table_view_svg col-sm-2">
                                                        <svg width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Hospital No.</div>
                                                        <div class="table-view-content"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row">
                                                    <div class="table_view_svg col-sm-2">
                                                        <svg width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Hospital Code</div>
                                                        <div class="table-view-content"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row">
                                                    <div class="table_view_svg col-sm-2">
                                                        <svg width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Patient Usual Address</div>
                                                        <div class="table-view-content"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row">
                                                    <div class="table_view_svg col-sm-2">
                                                        <svg width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Postcode</div>
                                                        <div class="table-view-content"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="edit-view-patient" style="display: none;">
                                    <fieldset>
                                        <div class="form-group col-md-3"> <span class="tg-namelogo">VR</span>
                                            <div class="tg-nameandtrack">
                                                <h3>VALERIE, RICHARDSON                                        </h3> <span>UL-20-23921                                            <em>|</em>
                                        <em>20-PH0001</em>
                                    </span> </div>
                                            <figure class="tg-nameandtrackimg"> <span>F</span> <span>57</span> </figure>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="patient_initial">Initial </label>
                                            <div class="form_input_container" data-key="patient_initial">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg class="svg_patient_initial" width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input id="patient_initial" type="text" name="patient_initial" class="form_input" placeholder="Patient Initial" value="VR" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="first_name">First Name - CR0060 </label>
                                            <div class="form_input_container" data-key="f_name">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg class="svg_f_name" width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input id="first_name" type="text" name="f_name" class="form_input" placeholder="First Name" value="VALERIE" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="sur_name">Surname - CR0050</label>
                                            <div class="form_input_container" data-key="sur_name">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg class="svg_sur_name" width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input id="sur_name" type="text" name="sur_name" class="form_input" placeholder="Surname" value="RICHARDSON" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                            <!-- <label></label> -->
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="gender">Gender - CR0080</label>
                                            <div class="form_input_container" data-key="gender">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg class="svg_gender" width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <select class="form_input" name="gender" id="gender" style="background: rgb(204, 204, 204);">
                                                    <option value="Male">Male</option>
                                                    <option selected="" value="Female">Female</option>
                                                </select>
                                            </div>
                                            <label></label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="dob">DOB -CR0100</label>
                                            <div class="form_input_container" data-key="dob">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg class="svg_dob" width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input type="text" name="dob" id="dob" class="form_input is-datepick" placeholder="Date of Birth" value="05-09-1963" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="nhs_number">NHS No. - CR0010</label>
                                            <div class="form_input_container" data-key="nhs_number">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg class="svg_nhs_number" width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input type="text" class="form_input" id="nhs_number" name="nhs_number" placeholder="Nhs Number" value="7083437865" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="hospital_no" class="text-warning">Hospital No.</label>
                                            <div class="form_input_container" data-key="hospital_no">
                                                <div class="radial_btn_container">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input type="text" class="form_input" id="hospital_no" name="hospital_no" placeholder="Hospital No." value="" disabled="" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="hospital_code" class="text-warning">Hospital Code</label>
                                            <div class="form_input_container" data-key="hospital_code">
                                                <div class="radial_btn_container">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input type="text" class="form_input" id="hospital_code" name="hospital_code" placeholder="Hospital Code" value="" disabled="" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="patient_usual_address" class="text-warning">Patient Usual Address - CR0030</label>
                                            <div class="form_input_container" data-key="patient_usual_address">
                                                <div class="radial_btn_container">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input type="text" class="form_input" id="patient_usual_address" name="patient_usual_address" placeholder="Address" value="" disabled="" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="patient_city" class="text-warning">Patient City - CR0030</label>
                                            <div class="form_input_container" data-key="patient_city">
                                                <div class="radial_btn_container">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input type="text" class="form_input" id="patient_city" name="patient_city" placeholder="City" value="" disabled="" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="postcode" class="text-warning">Postcode - CR0070</label>
                                            <div class="form_input_container" data-key="postcode">
                                                <div class="radial_btn_container">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input type="text" class="form_input" id="postcode" name="postcode" placeholder="City" value="" disabled="" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                    </fieldset>
                                    <fieldset> </fieldset>
                                </div>
                                <input type="hidden" name="json_edit_data" value="{&quot;patient_initial&quot;:&quot;VR&quot;,&quot;f_name&quot;:&quot;VALERIE&quot;,&quot;sur_name&quot;:&quot;RICHARDSON&quot;,&quot;gender&quot;:&quot;Female&quot;,&quot;dob&quot;:&quot;05-09-1963&quot;,&quot;nhs_number&quot;:&quot;7083437865&quot;}">
                                <input type="hidden" name="record_id" value="45104"> </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-12" style="padding-right: 0;">
                        <div class="sec_title p_id form-group"> Request ID <span class="edit_icon pull-right make_editable" style="margin-right: 40px;">
                                <i class="fa fa-pencil"></i>
                            </span> </div>
                        <div class="card" style="margin-bottom: 0px; ">
                            <div class="card-body">
                                <div id="table-view-request">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row" data-key="serial_number">
                                                    <div class="table_view_svg col-sm-2 change_status_color">
                                                        <svg class="svg_serial_number" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">UL No.</div>
                                                        <div class="table-view-content">UL-20-23921</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row">
                                                    <div class="table_view_svg col-sm-2">
                                                        <svg width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Track No.</div>
                                                        <div class="table-view-content"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row" data-key="lab_number">
                                                    <div class="table_view_svg col-sm-2 change_status_color">
                                                        <svg class="svg_lab_number" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Lab No.</div>
                                                        <div class="table-view-content">PH0001A</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row">
                                                    <div class="table_view_svg col-sm-2">
                                                        <svg width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Specimen Nature</div>
                                                        <div class="table-view-content"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row">
                                                    <div class="table_view_svg col-sm-2">
                                                        <svg width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Organisation site identifier</div>
                                                        <div class="table-view-content"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row">
                                                    <div class="table_view_svg col-sm-2">
                                                        <svg width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Organisation identifier</div>
                                                        <div class="table-view-content"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row" data-key="lab_name">
                                                    <div class="table_view_svg col-sm-2 change_status_color">
                                                        <svg class="svg_lab_name" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Lab Name</div>
                                                        <div class="table-view-content">Virchow</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row" data-key="dermatological_surgeon">
                                                    <div class="table_view_svg col-sm-2 change_status_color">
                                                        <svg class="svg_dermatological_surgeon" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Dermatological Surgeon</div>
                                                        <div class="table-view-content"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row" data-key="location">
                                                    <div class="table_view_svg col-sm-2 change_status_color">
                                                        <svg class="svg_location" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Location</div>
                                                        <div class="table-view-content"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row">
                                                    <div class="table_view_svg col-sm-2">
                                                        <svg width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Surgeon</div>
                                                        <div class="table-view-content"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row" data-key="date_taken">
                                                    <div class="table_view_svg col-sm-2 change_status_color">
                                                        <svg class="svg_date_taken" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Date Taken</div>
                                                        <div class="table-view-content">23-10-2020</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row">
                                                    <div class="table_view_svg col-sm-2">
                                                        <svg width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Pathologist</div>
                                                        <div class="table-view-content"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row" data-key="date_received_bylab">
                                                    <div class="table_view_svg col-sm-2 change_status_color">
                                                        <svg class="svg_date_received_bylab" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">REC LAB</div>
                                                        <div class="table-view-content">24-10-2020</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row" data-key="date_sent_touralensis">
                                                    <div class="table_view_svg col-sm-2 change_status_color">
                                                        <svg class="svg_date_sent_touralensis" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">REL LAB</div>
                                                        <div class="table-view-content">25-10-2020</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row" data-key="emis_number">
                                                    <div class="table_view_svg col-sm-2 change_status_color">
                                                        <svg class="svg_emis_number" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Scanner Type</div>
                                                        <div class="table-view-content">Hamamatsu</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row" data-key="pci_number">
                                                    <div class="table_view_svg col-sm-2 change_status_color">
                                                        <svg class="svg_pci_number" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Digi Number</div>
                                                        <div class="table-view-content">PH0001A</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row">
                                                    <div class="table_view_svg col-sm-2">
                                                        <svg width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Speciality</div>
                                                        <div class="table-view-content"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row">
                                                    <div class="table_view_svg col-sm-2">
                                                        <svg width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Specimen No.</div>
                                                        <div class="table-view-content"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row">
                                                    <div class="table_view_svg col-sm-2">
                                                        <svg width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Courier No.</div>
                                                        <div class="table-view-content"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row">
                                                    <div class="table_view_svg col-sm-2">
                                                        <svg width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Batch No.</div>
                                                        <div class="table-view-content"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="table-view-container">
                                                <div class="row" data-key="report_urgency">
                                                    <div class="table_view_svg col-sm-2 change_status_color">
                                                        <svg class="svg_report_urgency" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                            <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                        </svg>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                        <div class="table-view-heading">Status</div>
                                                        <div class="table-view-content">Urgent</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="edit-view-request" style="display: none;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="serial_number">UL No.</label>
                                            <div class="form_input_container" data-key="serial_number">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg class="svg_serial_number" width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input id="serial_number" type="text" name="serial_number" class="form_input" placeholder="UL No." value="UL-20-23921" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="track_number" class="text-warning">Track No.</label>
                                            <div class="form_input_container" data-key="track_number">
                                                <div class="radial_btn_container">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input type="text" class="form_input" id="track_number" name="track_number" placeholder="Address" value="" disabled="" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                            <label></label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="lab_number">Lab No. - CR0010</label>
                                            <div class="form_input_container" data-key="lab_number">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg class="svg_lab_number" width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input type="text" class="form_input" id="lab_number" name="lab_number" placeholder="Lab Number" value="PH0001A" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="specimen_nature" class="text-warning">Specimen Nature - Pcr0970</label>
                                            <div class="form_input_container" data-key="specimen_nature">
                                                <div class="radial_btn_container">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input type="text" class="form_input" id="specimen_nature" name="specimen_nature" placeholder="Specimen Nature" value="" disabled="" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="organisation_site_identifier" class="text-warning">Organisation site identifier - Pcr0980</label>
                                            <div class="form_input_container" data-key="organisation_site_identifier">
                                                <div class="radial_btn_container">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input type="text" class="form_input" id="organisation_site_identifier" name="organisation_site_identifier" placeholder="Organisation site identifier" value="" disabled="" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="organisation_identifier" class="text-warning">Organisation identifier - Pcr0800</label>
                                            <div class="form_input_container" data-key="organisation_identifier">
                                                <div class="radial_btn_container">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input type="text" class="form_input" id="organisation_identifier" name="organisation_identifier" placeholder="Organisation Identifier" value="" disabled="" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="lab_name">Lab Name - Pcr0980</label>
                                            <div class="form_input_container" data-key="lab_name">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg class="svg_lab_name" width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <select class="form_input lab_name" id="lab_name" name="lab_name" style="background: rgb(204, 204, 204);">
                                                    <option value="0">Choose</option>
                                                    <option data-labnameid="24" selected="" value="Virchow">Virchow's Laboratory</option>
                                                    <option data-labnameid="44" value="manhattandistrictlab">Manhattan District Lab</option>
                                                    <option data-labnameid="58" value="pci">PCI</option>
                                                    <option value="U">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="dermatological_surgeon">Choose Dermatological Surgeon - Pcr7100</label>
                                            <div class="form_input_container" data-key="dermatological_surgeon">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg class="svg_dermatological_surgeon" width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <select name="dermatological_surgeon" id="dermatological_surgeon" class="form_input" style="background: rgb(204, 204, 204);">
                                                    <option value="">Choose</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="location">Location</label>
                                            <div class="form_input_container" data-key="location">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg class="svg_location" width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input type="text" class="form_input" id="location" name="location" placeholder="Location" value="" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="surgeon" class="text-warning">Surgeon - CR0030</label>
                                            <div class="form_input_container" data-key="surgeon">
                                                <div class="radial_btn_container">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input type="text" class="form_input" id="surgeon" name="surgeon" placeholder="Surgeon" value="" disabled="" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="date_taken">Date Taken - Pcr1010</label>
                                            <div class="form_input_container" data-key="date_taken">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg class="svg_date_taken" width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input class="form_input is-datepick" type="text" name="date_taken" id="datetaken_doctor" placeholder="Date Taken" value="23-10-2020" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="pathologist" class="text-warning">Pathologist - Pcr6990</label>
                                            <div class="form_input_container" data-key="pathologist">
                                                <div class="radial_btn_container">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input type="text" class="form_input" id="pathologist" name="pathologist" placeholder="pathologist" value="" disabled="" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="date_received_bylab">REC LAB - Pcr0770</label>
                                            <div class="form_input_container" data-key="date_received_bylab">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg class="svg_date_received_bylab" width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input class="form_input is-datepick" type="text" name="date_received_bylab" id="datetaken_doctor" placeholder="REC LAB" value="24-10-2020" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="date_sent_touralensis">REL LAB</label>
                                            <div class="form_input_container" data-key="date_sent_touralensis">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg class="svg_date_sent_touralensis" width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input type="text" name="date_sent_touralensis" class="form_input is-datepick" id="date_sent_touralensis" placeholder="Uralensis Sent Date" value="25-10-2020" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="emis_number">Scanner Type</label>
                                            <div class="form_input_container" data-key="emis_number">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg class="svg_emis_number" width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input id="emis_number" type="text" name="emis_number" class="form_input" placeholder="Scanner Type" value="Hamamatsu" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                            <label></label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="pci_number">Digi Number - Pcr0950</label>
                                            <div class="form_input_container" data-key="pci_number">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg class="svg_pci_number" width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input id="pci_number" type="text" name="pci_number" class="form_input" placeholder="Digi Number" value="PH0001A" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="hospital_code" class="text-warning">Hospital Code</label>
                                            <div class="form_input_container" data-key="hospital_code">
                                                <div class="radial_btn_container">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input type="text" class="form_input" id="hospital_code" name="hospital_code" placeholder="Hospital Code" value="" disabled="" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="request_specialty" class="text-warning">Specialty - Pcr7130</label>
                                            <div class="form_input_container" data-key="request_specialty">
                                                <div class="radial_btn_container">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input type="text" class="form_input" id="request_specialty" name="request_specialty" placeholder="Specialty" value="" disabled="" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="specimen_no" class="text-warning">Specimen No. - Pcr6220</label>
                                            <div class="form_input_container" data-key="specimen_no">
                                                <div class="radial_btn_container">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input type="text" class="form_input" id="specimen_no" name="specimen_no" placeholder="Specimen No." value="" disabled="" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="courier_no" class="text-warning">Courier no.</label>
                                            <div class="form_input_container" data-key="courier_no">
                                                <div class="radial_btn_container">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input type="text" class="form_input" id="courier_no" name="courier_no" placeholder="Courier no." value="" disabled="" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="batch_no" class="text-warning">Batch no.</label>
                                            <div class="form_input_container" data-key="batch_no">
                                                <div class="radial_btn_container">
                                                    <svg width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="orange" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="orange" fill="orange" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <input type="text" class="form_input" id="batch_no" name="batch_no" placeholder="Batch no." value="" disabled="" readonly="" style="background: rgb(204, 204, 204);"> </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="report_urgency">Status</label>
                                            <div class="form_input_container" data-key="report_urgency">
                                                <div class="radial_btn_container change_status_color">
                                                    <svg class="svg_report_urgency" width="26" height="26">
                                                        <circle cx="13" cy="13" r="12" stroke="blue" fill-opacity="0" stroke-width="1"></circle>
                                                        <circle cx="13" cy="13" r="7" stroke="blue" fill="blue" stroke-width="2"></circle>
                                                    </svg>
                                                </div>
                                                <select name="report_urgency" class="form_input " id="report_urgency" style="background: rgb(204, 204, 204);">
                                                    <option value="Routine">Routine</option>
                                                    <option selected="" value="Urgent">Urgent</option>
                                                    <option value="2WW">2WW</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-7">
        <div class="card">

            <div class="card-body">
                <div class="col-lg-12 form-group">
                    <div class="row">
                        <div class="col-lg-6 form-group nopadding">
                            <label for="" style="margin-top: 10px;"><strong>Histopathology Tests</strong></label>
                        </div>
                        <div class="col-lg-6 form-group nopadding">
                            <ul class="list-unstyled pull-right">
                       
                                <li class="nav-item">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" id="quickBox">
                                        <div class="input-group-append">
                                          <button class="btn btn-success" type="button">
                                            <i class="fa fa-search"></i>
                                          </button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
               
                <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                    <li class="nav-item"><a class="nav-link active" href="#solid-rounded-tab1" data-toggle="tab">Routine & Specials</a></li>
                    <li class="nav-item"><a class="nav-link" href="#solid-rounded-tab2" data-toggle="tab">Immunochemistry</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="solid-rounded-tab1">
                        <div class="form-group">
                            <ul class="qucikSearch">
                                <li><a href="javascript:;" class="btn btn-info btn-block">Alcian Blue</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">AB PAS</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">AB DPAS</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Congo Red</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">EVG</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Formalin Pig Removal</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Giemsa</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Gram</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Gram Twort</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Grocott</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Hales</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">MSB</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Mason Fontana</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Oil Red O</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">P.A. Silver</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">PAS</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">PAS +D</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Perl's</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Thick Perl's</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Retic</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Rhodanine</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Shikata</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Von Kossa</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">ZN</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Mod ZN</a></li>
                            </ul>
                        </div>
                        
                    </div>
                    <div class="tab-pane table-responsive" id="solid-rounded-tab2">
                        <div class="form-group">
                            <ul class="qucikSearch">
                                <li><a href="javascript:;" class="btn btn-info btn-block">34BE12</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">IHC 1 A-1-AT</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">AE1/AE3</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">AFP</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">ALK1</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">AMACR</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Amyloid A</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Amyloid P</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">AR</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">B-Catenin</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">BAP1</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">BCL-2</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">BCL-6</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Ber-EP4</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">BRAF V600E</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CA 125</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Ca 19.9</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Calcitonin</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Caldesmon (h)</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Calponin</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Calretinin</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 1a</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 2</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 3</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 4</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 5</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 6</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 7</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 8 </a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 9</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 10</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 15</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 20 </a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 21</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 23</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 25</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 30</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 31</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 34</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 44</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 56</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 61</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 68</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 79a</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 99</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 117</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CD 138</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CDK 4</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CDX 2</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CEA</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">C-erb B2</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CGA</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CK (MNF-116)</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CK 5</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CK 7</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CK 8/18</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CK 14</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CK 17</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CK 20</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">CMV</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">c-Myc</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Cyclin D1</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">D2 40</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Desmin</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">DOG1</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">EBER</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">E-Cadherin</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">EMA</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">ER</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">ERG</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Factor 8</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Factor 13</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Gastrin</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">GATA3</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">GCDFP-15</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">GFAP</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Glycophorin A</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Granzyme B</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">HCG</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Hepatocyte</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Hep B CA</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Hep B SA</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">HHV8</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">HLO</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">HMB 45 - Brown</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">HMB 45 - Red</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">HSV 1 & 2</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">lgA</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">lgG</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">lgG4</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">lgG4-Renal</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">lgM</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">IMP3</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Inhibin</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">K/L B IHC</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">K/L P ISH</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Ki-67</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">LCA</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Mamma</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">MCT Brown</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">MCT Red</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Mel A Brown</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Mel A Red</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">MITF Brown</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">MITF Red</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">MSI Markers</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">MUC 1</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">MUC 2</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">MUC 4</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">MUC 5AC</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">MUM 1</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Myo D1</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Myogenin</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Myoglobin</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Myosin</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Myeloperoxidase</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Napsin A</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">NFP</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">NSE</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">OCT 3/4</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">P16 - Brown</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">P16 - Red</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">P40</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">P53</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">P57</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">P63</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Parathyroid</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Parvovirus</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">PAX 8</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">PLAP</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">PNC (PCP)</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">PR</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">PSA</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">RCC</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Renals Panel</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">S-100 Brown</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">S-100 Red</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">SMA</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">SMM-HC</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">SOX10 Brown</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">SOX10 Red</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Spirochete</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">STAT6</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Synapto</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">TdT</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Thrombo</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Thyroglob</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">TTF-1</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Vimentin</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">VS38c</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">WT-1</a></li>
                            </ul>
                        </div>
                    </div>
                    
                </div>

                
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-5 nopadding">
        <div id="editor"></div>
        <div class="card print_section" style="width: 100%">
            <div id="print_section" style="overflow: hidden; width: 100%">
                <div class="card-header">
                    <div class="card-title mb-0">
                        <div class="col-sm-12">
                            Request List
                            <span class="pull-right" style="float: right;">
                                <strong>Date:</strong> 08-22-2020
                            </span>
                        </div>
                        <div class="col-lg-12">
                            Requestor Name : Tim Kilman
                            <span class="pull-right"  style="float: right;">
                                <strong>Time:</strong> 06:40 PM
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive form-group">
                        <table class="table table-stripped custom-table custom-table-search" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Lab No.</th>
                                    <th>Patient Intials</th>
                                    <th>Test</th>
                                    <th>Specimen</th>
                                    <th>Block</th>
                                    <th class="text-right">Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <label>Reason for Request</label>
                            <p id="divID"></p>
                        </div>

                        <div class="col-lg-12 form-group">
                            <label>Comments</label>
                            <p id="divID2"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <div class="row">
                    <div class="col-lg-12 form-group">
                        <button class="btn btn-primary print_button" onclick="print()"> <i class="fa fa-print"></i> Print </button>
                        <button class="btn btn-primary print_button" onclick="generatePDF2()"><i class="fa fa-file-pdf-o"></i> Save as PDF</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" style="display: none;">
        <div id="editor2"></div>
        <div class="row" id="print_section_new">
            <div class="col-sm-6">
                <div class="card print_section2">
                    <div class="card-header">
                        <div class="card-title mb-0 text-right">*18S29657*</div>
                    </div>
                    <div class="card-body">
                        
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>
                                        <label>Lab No.</label>
                                        <p>18S29657</p>
                                    </td>
                                    <td>
                                        <label>Blocks</label>
                                        <p>1</p>
                                    </td>
                                    <td>
                                        <label>Patient Name</label>
                                        <p>Taqi Raza</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="">Requesting Path</label>
                                        <p>IHC  </p>
                                    </td>
                                    <td colspan="2">
                                        <label for="">Date & Time</label>
                                        <p>11/10/2020 11:17 </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <label>Levels</label>
                                        <p>Level 1</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>18S29657</p>
                                    </td>
                                    <td>
                                        <p>1</p>
                                    </td>
                                    <td>
                                        <p>Taqi Raza</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>IHC  </p>
                                    </td>
                                    <td colspan="2">
                                        <p>11/10/2020 11:17 </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <label><strong>Specials</strong></label>
                                        <ul class="list-unstyled">
                                            <li>Von Kosa</li>
                                            <li>Retic</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <label><strong>Other Requests</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Free Text) </label>
                                        <p></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card print_section2">
                    <div class="card-header">
                        <div class="card-title mb-0 text-right">*18S29657*</div>
                    </div>
                    <div class="card-body" style="min-height: 706px">
                        
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>
                                        <label>Lab No.</label>
                                        <p>18S29657</p>
                                    </td>
                                    <td>
                                        <label>Blocks</label>
                                        <p>1</p>
                                    </td>
                                    <td>
                                        <label>Patient Name</label>
                                        <p>Taqi Raza</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="">Requesting Path</label>
                                        <p>Pandey   </p>
                                    </td>
                                    <td colspan="2">
                                        <label for="">Date & Time</label>
                                        <p>11/10/2020 11:17 </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <label><strong>Immuno</strong></label>
                                        <ul class="list-unstyled">
                                            <li>S-100 - Brown</li>
                                            <li>Melan A - Brown</li>
                                            <li>Desmin</li>
                                            <li>CD 34</li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>