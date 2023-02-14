<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="tg-trackrecords">
    <div class="container">
        <form class="form specimen_tracking_form tg-formtheme tg-formsearch">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-title">
                        <h3>Specimen Tracking</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3 pull-left">
                            <div id="track_template_input" class="collapse">
                                <input type="text" name="track_template_name" placeholder="Enter Template Name">
                            </div>
                            <a href="javascript:;" class="btn btn-success pull-right save_track_template">Save as Template</a>
                        </div>
                        <div class="col-md-3 pull-right">
                            <?php if (!empty($track_templates)) { ?>
                                <select class="form-control load_track_template">
                                    <option value="">Choose Template</option>
                                    <?php foreach ($track_templates as $temp) { ?>
                                        <option data-hospitalid="<?php echo $temp['temp_hospital_user']; ?>"
                                                data-clinicid="<?php echo $temp['temp_clinic_user']; ?>"
                                                data-pathologist="<?php echo $temp['temp_pathologist']; ?>"
                                                data-labname="<?php echo $temp['temp_lab_name']; ?>"
                                                data-urgency="<?php echo $temp['temp_report_urgency']; ?>"
                                                data-speci="<?php echo $temp['temp_skin_type']; ?>"
                                                value="<?php echo $temp['ura_rec_temp_id']; ?>">
                                                    <?php echo $temp['temp_input_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <button class="load_track_temp_btn">Load Template</button>
                            <?php } ?>
                        </div>
                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="tg-tagsarea">
                        <li class="tg-clinic">

                        </li>
                        <li class="tg-users">

                        </li>
                        <li class="tg-labs">

                        </li>
                        <li class="tg-pathologist">

                        </li>
                        <li class="tg-urgency">

                        </li>
                        <li class="tg-specimen">

                        </li>
                    </ul>
                </div>
                <div class="tg-catagorytopics">
                    <div class="col-xs-12 col-sm-1 col-md-12 col-lg-12">
                        <div class="tg-catagoryholder">
                            <div class="tg-topic">
                                <a href="javascript:;" class="show_clinic_btn">
                                    <div class="tg-catagorytopic tg-clinic">
                                        <i class="lnr lnr-apartment"></i>
                                        <h3>Select Clinic</h3>
                                        <span class="display_selected_option"></span>
                                        <em>+</em>
                                    </div>
                                </a>
                                <div class="show-data-holder" style="background: #1abc9c;">
                                    <div class="show_clinic">
                                        <div class="show_clinic_title">
                                            <a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>
                                            <h4><i class="lnr lnr-apartment"></i>Select Clinic</h4>
                                        </div>
                                        <div class="input-scroll-holder ura-custom-scrollbar">
                                            <?php
                                            if (!empty($hos_users)) {
                                                foreach ($hos_users as $users) {
                                                    $hospital_name = $users->description;
                                                    ?>
                                                    <div class="input-holder">
                                                        <input class="tat hospital_user" data-hospitalname="<?php echo!empty($hospital_name) ? $hospital_name : ''; ?>" type="radio" id="hospital_<?php echo $users->id; ?>" name="hospital_user" value="<?php echo $users->id; ?>">
                                                        <label for="hospital_<?php echo $users->id; ?>"><?php echo!empty($hospital_name) ? $hospital_name : ''; ?></label>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tg-topic hidden-boxes">

                            </div>
                            <div class="tg-topic">
                                <a href="javascript:;" class="show_lab_btn">
                                    <div class="tg-catagorytopic tg-heartpuls">
                                        <i class="lnr lnr-heart-pulse"></i>
                                        <h3>Select Lab</h3>
                                        <span class="display_selected_option"></span>
                                        <em>+</em>
                                    </div>
                                </a>
                                <div class="show-data-holder" style="background: #3498db;">
                                    <div class="show_labs">
                                        <div class="show_clinic_title">
                                            <a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>
                                            <h4><i class="lnr lnr-heart-pulse"></i>Select Lab</h4>
                                        </div>
                                        <div class="input-scroll-holder ura-custom-scrollbar">
                                            <?php
                                            if (!empty($lab_names)) {
                                                foreach ($lab_names as $labs) {
                                                    ?>
                                                    <div class="input-holder">
                                                        <input class="track_lab_name" data-labname="<?php echo $labs->lab_name; ?>" type="radio" id="lab_<?php echo $labs->lab_name_id; ?>" name="lab_name" value="<?php echo $labs->lab_name_id; ?>">
                                                        <label for="lab_<?php echo $labs->lab_name_id; ?>"><?php echo $labs->lab_name; ?></label>
                                                    </div>                                                   
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tg-topic">
                                <a href="javascript:;" class="show_pathologists_btn">
                                    <div class="tg-catagorytopic tg-pathologist">
                                        <i class="lnr lnr-heart"></i>
                                        <h3>Select Pathologist</h3>
                                        <span class="display_selected_option"></span>
                                        <em>+</em>
                                    </div>
                                </a>
                                <div class="show-data-holder" style="background: #9b59b6;">
                                    <div class="show_pathologists">
                                        <div class="show_clinic_title">
                                            <a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>
                                            <h4><i class="lnr lnr-heart"></i>Select Pathologist</h4>
                                        </div>
                                        <div class="input-scroll-holder ura-custom-scrollbar">
                                            <?php
                                            if (!empty($doctor_list)) {
                                                foreach ($doctor_list as $doctor) {
                                                    ?>
                                                    <div class="input-holder">
                                                        <input class="pathologist" type="radio" data-pathologist="<?php echo $doctor->first_name . ' ' . $doctor->last_name; ?>" id="doctor_<?php echo $doctor->id; ?>" name="pathologist" value="<?php echo $doctor->id; ?>">
                                                        <label for="doctor_<?php echo $doctor->id; ?>"><?php echo $doctor->first_name . ' ' . $doctor->last_name; ?></label>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tg-topic">
                                <a href="javascript:;" class="show_report_urgency_btn">
                                    <div class="tg-catagorytopic tg-urgency">
                                        <i class="lnr lnr-clock"></i>
                                        <h3>Select Report Urgency</h3>
                                        <span class="display_selected_option"></span>
                                        <em>+</em>
                                    </div>
                                </a>
                                <div class="show-data-holder" style="background: #e67e22;">
                                    <div class="show_report_urgency">
                                        <div class="show_clinic_title">
                                            <a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>
                                            <h4><i class="lnr lnr-clock"></i>Select Report Urgency</h4>
                                        </div>
                                        <div class="input-scroll-holder">
                                            <?php
                                            $report_urgeny_data = array(
                                                'routine' => 'Routine',
                                                '2ww' => '2WW',
                                                'urgent' => 'Urgent',
                                            );
                                            foreach ($report_urgeny_data as $key => $urgency) {
                                                ?>
                                                <div class="input-holder">
                                                    <input class="report_urgency" data-urgency="<?php echo $urgency; ?>" type="radio" id="report_<?php echo $key; ?>" name="report_urgency" value="<?php echo $key; ?>">
                                                    <label for="report_<?php echo $key; ?>"><?php echo $urgency; ?></label>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tg-topic">
                                <a href="javascript:;" class="show_specimen_type_btn">
                                    <div class="tg-catagorytopic tg-specimentype">
                                        <i class="lnr lnr-layers"></i>
                                        <h3>Select Specimen Type</h3>
                                        <span class="display_selected_option"></span>
                                        <em>+</em>
                                    </div>
                                </a>
                                <div class="show-data-holder" style="background: #e74c3c;">
                                    <div class="show_specimen_type">
                                        <div class="show_clinic_title">
                                            <a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>
                                            <h4><i class="lnr lnr-layers"></i>Select Specimen Type</h4>
                                        </div>
                                        <div class="input-scroll-holder">
                                            <?php
                                            $specimen_type_data = array(
                                                'gi' => 'GI',
                                                'skin' => 'Skin',
                                                'other' => 'Other'
                                            );
                                            foreach ($specimen_type_data as $key => $specimen_type) {
                                                ?>
                                                <div class="input-holder">
                                                    <input class="specimen_type" data-specimentype="<?php echo $specimen_type; ?>" type="radio" id="speci_type_<?php echo $key; ?>" name="specimen_type" value="<?php echo $key; ?>">
                                                    <label for="speci_type_<?php echo $key; ?>"><?php echo $specimen_type; ?></label>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <input style="margin-top:0px;" class="form-control specimen_count" type="number" min="1" max="6" name="specimen_count" placeholder="Specimen No's">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-4">
                    <a class="tg-btnbooktab" href="javascript:;" data-barcode="' . $barcode . '" data-recordid="' . $record_id . '" data-statuskey="booked_out_to_lab">
                        <img src="<?php echo base_url('assets/img/Central-Admin.png'); ?>">
                        <span>Booked Out To Lab</span>
                        <input class="form-control" type="text" name="tracking_no" placeholder="Enter Tracking No.">
                        <hr>
                        <button class="btn btn-success scan-barcode-btn">Submit</button>
                    </a>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="find_barcode_result">

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12 load-track-record-data">

    </div>
</div>

<div class="tg-modalboxarea modal fade" tabindex="-1" role="dialog" id="record_found_modal">
    <div class="modal-dialog" role="document">
        <div class="tg-alreadybookmodal modal-content">
            <a href="javascript;;" class="tg-closebtn close"><i class="lnr lnr-cross" data-dismiss="modal" aria-label="Close"></i></a>
            <div class="modal-body">
                <span class="lnr lnr-thumbs-up"></span>
                <div class="tg-description">
                    <p>Record already existed with this number.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tg-modalboxarea modal fade" tabindex="-1" role="dialog" id="record_not_found_modal">
    <div class="modal-dialog" role="document">
        <div class="tg-alreadybookmodal modal-content">
            <a href="javascript;;" class="tg-closebtn close"><i class="lnr lnr-cross" data-dismiss="modal" aria-label="Close"></i></a>
            <div class="modal-body">
                <span class="lnr lnr-thumbs-up"></span>
                <div class="tg-description">
                    <p>Record added and booked out to lab.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<hr style="border: 2px dotted #ccc; margin-bottom: 50px;">
<div class="track_search_record">
    <div class="col-md-4">
        <div class="admin_book_in_from_clinic_data text-center"></div>
    </div>
    <div class="col-md-4">
        <div class="tg-title">
            <h3>Search a case</h3>
        </div>
        <div class="tg-searchareaform">
            <div class="form-group tg-inputwithicon">
                <input class="form-control" type="text" name="barcode_no" placeholder="Search Via Tracking No.">
            </div>
            <a href="javascript:;" data-toggle="collapse" data-target="#advanced_search">+ Advanced Search</a>
        </div>

        <div class="col-md-12">
            <div id="advanced_search" class="collapse">
                <div class="form-group">
                    <input class="form-control" type="text" name="tracking_no_ul" placeholder="Search Via Tracking No. (UL Number)">
                </div>
                <div class="form-group tg-or">
                    <em>-or-</em>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="tracking_no_lab" placeholder="Search Via  Tracking No. (Lab Number)">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="admin_received_from_lab_data text-center"></div>
    </div>
    <div class="tg-trackrecords">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-title">
                        <h3>Search Result</h3>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="tg-tagsarea">

                    </ul>
                </div>
                <div class="show-data-holder" style="background: #1abc9c;">
                    <div class="show_clinic">
                        <div class="show_clinic_title">
                            <a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>
                            <h4><i class="lnr lnr-apartment"></i>Select Clinic</h4>
                        </div>
                        <div class="input-scroll-holder ura-custom-scrollbar">
                            <?php
                            if (!empty($hos_users)) {
                                foreach ($hos_users as $users) {
                                    $hospital_name = $users->description;
                                    ?>
                                    <div class="input-holder">
                                        <input class="tat hospital_user" data-hospitalname="<?php echo!empty($hospital_name) ? $hospital_name : ''; ?>" type="radio" id="hospital_<?php echo $users->id; ?>" name="hospital_user" value="<?php echo $users->id; ?>">
                                        <label for="hospital_<?php echo $users->id; ?>"><?php echo!empty($hospital_name) ? $hospital_name : ''; ?></label>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <form class="form specimen_tracking_form tg-formtheme tg-formsearch">
                    <div id="specimen_tracking" class="collapse">
                        <div class="tg-catagorytopics">
                            <div class="col-xs-12 col-sm-1 col-md-12 col-lg-12">
                                <div class="tg-catagoryholder">
                                    <div class="tg-topic">
                                        <a href="javascript:;" class="show_clinic_btn">
                                            <div class="tg-catagorytopic tg-clinic">
                                                <i class="lnr lnr-apartment"></i>
                                                <h3>Select Clinic</h3>
                                                <span class="display_selected_option"></span>
                                                <em>+</em>
                                            </div>
                                        </a>
                                        <div class="show-data-holder" style="background: #1abc9c;">
                                            <div class="show_clinic">
                                                <div class="show_clinic_title">
                                                    <a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>
                                                    <h4><i class="lnr lnr-apartment"></i>Select Clinic</h4>
                                                </div>
                                                <div class="input-scroll-holder ura-custom-scrollbar">
                                                    <?php
                                                    if (!empty($hos_users)) {
                                                        foreach ($hos_users as $users) {
                                                            $hospital_name = $users->description;
                                                            ?>
                                                            <div class="input-holder">
                                                                <input class="tat hospital_user" data-hospitalname="<?php echo!empty($hospital_name) ? $hospital_name : ''; ?>" type="radio" id="hospital_<?php echo $users->id; ?>" name="hospital_user" value="<?php echo $users->id; ?>">
                                                                <label for="hospital_<?php echo $users->id; ?>"><?php echo!empty($hospital_name) ? $hospital_name : ''; ?></label>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tg-topic hidden-boxes">

                                    </div>
                                    <div class="tg-topic">
                                        <a href="javascript:;" class="show_lab_btn">
                                            <div class="tg-catagorytopic tg-heartpuls">
                                                <i class="lnr lnr-heart-pulse"></i>
                                                <h3>Select Lab</h3>
                                                <span class="display_selected_option"></span>
                                                <em>+</em>
                                            </div>
                                        </a>
                                        <div class="show-data-holder" style="background: #3498db;">
                                            <div class="show_labs">
                                                <div class="show_clinic_title">
                                                    <a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>
                                                    <h4><i class="lnr lnr-heart-pulse"></i>Select Lab</h4>
                                                </div>
                                                <div class="input-scroll-holder ura-custom-scrollbar">
                                                    <?php
                                                    if (!empty($lab_names)) {
                                                        foreach ($lab_names as $labs) {
                                                            ?>
                                                            <div class="input-holder">
                                                                <input class="tat" data-labname="<?php echo $labs->lab_name; ?>" type="radio" id="lab_<?php echo $labs->lab_name_id; ?>" name="lab_name" value="<?php echo $labs->lab_name_id; ?>">
                                                                <label for="lab_<?php echo $labs->lab_name_id; ?>"><?php echo $labs->lab_name; ?></label>
                                                            </div>                                                   
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tg-topic">
                                        <a href="javascript:;" class="show_pathologists_btn">
                                            <div class="tg-catagorytopic tg-pathologist">
                                                <i class="lnr lnr-heart"></i>
                                                <h3>Select Pathologist</h3>
                                                <span class="display_selected_option"></span>
                                                <em>+</em>
                                            </div>
                                        </a>
                                        <div class="show-data-holder" style="background: #9b59b6;">
                                            <div class="show_pathologists">
                                                <div class="show_clinic_title">
                                                    <a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>
                                                    <h4><i class="lnr lnr-heart"></i>Select Pathologist</h4>
                                                </div>
                                                <div class="input-scroll-holder ura-custom-scrollbar">
                                                    <?php
                                                    if (!empty($doctor_list)) {
                                                        foreach ($doctor_list as $doctor) {
                                                            ?>
                                                            <div class="input-holder">
                                                                <input class="tat" type="radio" data-pathologist="<?php echo $doctor->first_name . ' ' . $doctor->last_name; ?>" id="doctor_<?php echo $doctor->id; ?>" name="pathologist" value="<?php echo $doctor->id; ?>">
                                                                <label for="doctor_<?php echo $doctor->id; ?>"><?php echo $doctor->first_name . ' ' . $doctor->last_name; ?></label>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tg-topic">
                                        <a href="javascript:;" class="show_report_urgency_btn">
                                            <div class="tg-catagorytopic tg-urgency">
                                                <i class="lnr lnr-clock"></i>
                                                <h3>Select Report Urgency</h3>
                                                <span class="display_selected_option"></span>
                                                <em>+</em>
                                            </div>
                                        </a>
                                        <div class="show-data-holder" style="background: #e67e22;">
                                            <div class="show_report_urgency">
                                                <div class="show_clinic_title">
                                                    <a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>
                                                    <h4><i class="lnr lnr-clock"></i>Select Report Urgency</h4>
                                                </div>
                                                <div class="input-scroll-holder">
                                                    <?php
                                                    $report_urgeny_data = array(
                                                        'routine' => 'Routine',
                                                        '2ww' => '2WW',
                                                        'urgent' => 'Urgent',
                                                    );
                                                    foreach ($report_urgeny_data as $key => $urgency) {
                                                        ?>
                                                        <div class="input-holder">
                                                            <input class="tat" data-urgency="<?php echo $urgency; ?>" type="radio" id="report_<?php echo $key; ?>" name="report_urgency" value="<?php echo $key; ?>">
                                                            <label for="report_<?php echo $key; ?>"><?php echo $urgency; ?></label>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tg-topic">
                                        <a href="javascript:;" class="show_specimen_type_btn">
                                            <div class="tg-catagorytopic tg-specimentype">
                                                <i class="lnr lnr-layers"></i>
                                                <h3>Select Specimen Type</h3>
                                                <span class="display_selected_option"></span>
                                                <em>+</em>
                                            </div>
                                        </a>
                                        <div class="show-data-holder" style="background: #e74c3c;">
                                            <div class="show_specimen_type">
                                                <div class="show_clinic_title">
                                                    <a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>
                                                    <h4><i class="lnr lnr-layers"></i>Select Specimen Type</h4>
                                                </div>
                                                <div class="input-scroll-holder">
                                                    <?php
                                                    $specimen_type_data = array(
                                                        'skin' => 'Skin',
                                                        'na_site' => 'NA Site',
                                                        'mixed' => 'Mixed'
                                                    );
                                                    foreach ($specimen_type_data as $key => $specimen_type) {
                                                        ?>
                                                        <div class="input-holder">
                                                            <input class="tat" data-specimentype="<?php echo $specimen_type; ?>" type="radio" id="speci_type_<?php echo $key; ?>" name="specimen_type" value="<?php echo $key; ?>">
                                                            <label for="speci_type_<?php echo $key; ?>"><?php echo $specimen_type; ?></label>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <input style="margin-top:0px;" class="form-control specimen_count" type="number" min="1" max="6" name="specimen_count" placeholder="Specimen No's">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-info scan-barcode-btn" style="width:100%;">Add Record</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12 load-track-record-data">

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table id="display_track_addded_records" class="table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr class="info">
                    <th>Serial No</th>
                    <th>Tracking No</th>
                    <th>Status</th>
                    <th>First Name</th>
                    <th>Sur Name</th>
                    <th>EMIS No</th>
                    <th>NHS No.</th>
                    <th>LAB No.</th>
                    <th>Gender</th>
                    <th>Request Time</th>
                    <th>Detail</th>
                    <th>Edit</th>
                    <th>A.Status</th>
                    <th>P.Status</th>
                    <th>Delete</th>
                    <th class="text-center">Flag</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $flag_count = 11;
                foreach ($track_records as $row) {
                    $row_code = '';

                    if (!empty($row->request_code_status) && $row->request_code_status === 'new') {
                        $row_code = 'row_yellow';
                    } elseif (!empty($row->request_code_status) && $row->request_code_status === 'rec_by_lab') {
                        $row_code = 'row_orange';
                    } elseif (!empty($row->request_code_status) && $row->request_code_status === 'pci_added') {
                        $row_code = 'row_purple';
                    } elseif (!empty($row->request_code_status) && $row->request_code_status === 'assign_doctor') {
                        $row_code = 'row_green';
                    } elseif (!empty($row->request_code_status) && $row->request_code_status === 'micro_add') {
                        $row_code = 'row_skyblue';
                    } elseif (!empty($row->request_code_status) && $row->request_code_status === 'add_to_authorize') {
                        $row_code = 'row_blue';
                    } elseif (!empty($row->request_code_status) && $row->request_code_status === 'furtherwork_add') {
                        $row_code = 'row_brown';
                    } elseif (!empty($row->request_code_status) && $row->request_code_status === 'record_publish') {
                        $row_code = 'row_white';
                    }
                    ?>
                    <tr class="<?php echo $row_code; ?>">
                        <td style="font-size:11px;font-weight: bold;"><?php echo $row->serial_number; ?></td>
                        <td><?php echo $row->ura_barcode_no; ?></td>
                        <td>
                            <?php
                            $track_record_data = $this->Admin_model->get_track_record_data_from_record_id($row->uralensis_request_id);
                            ?>
                            <button type="button" data-toggle="modal" data-target="#track_record_<?php echo $flag_count; ?>">Show</button>
                            <div id="track_record_<?php echo $flag_count; ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Record Tracking Detail</h4>
                                        </div>
                                        <div class="modal-body">
                                            <?php if (!empty($track_record_data)) { ?>
                                                <table class="table">
                                                    <tr class="bg-primary">
                                                        <th>Track No.</th>
                                                        <th>Time/Date</th>
                                                        <th>Location</th>
                                                        <th>Status</th>
                                                        <th>Pathologist</th>
                                                    </tr>
                                                    <?php foreach ($track_record_data as $record_data) { ?>
                                                        <tr class="bg-info">
                                                            <td><?php echo $record_data->ura_rec_track_no; ?></td>
                                                            <td><?php echo date('h:i, d/m/Y', $record_data->timestamp); ?></td>
                                                            <td><?php echo $record_data->ura_rec_track_location; ?></td>
                                                            <td><?php echo $record_data->ura_rec_track_status; ?></td>
                                                            <td><?php echo $record_data->ura_rec_track_pathologist; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </table>
                                            <?php } else { ?>
                                                <div class="alert alert-danger">Sorry no track record found.</div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><?php echo $row->f_name; ?></td>
                        <td><?php echo $row->sur_name; ?></td>
                        <td><?php echo $row->emis_number; ?></td>
                        <td><?php echo $row->nhs_number; ?></td>
                        <td><?php echo $row->lab_number; ?></td>
                        <td><?php echo $row->gender; ?></td>
                        <td><?php echo $row->request_datetime; ?></td>
                        <td style="text-align:center;"><a href="<?php echo site_url() . '/Admin/detail_view_record/' . $row->uralensis_request_id; ?>"><img src="<?php echo base_url('assets/img/detail.png'); ?>"></a></td>
                        <td><a href="<?php echo site_url() . '/Admin/edit_report/' . $row->uralensis_request_id; ?>"><img src="<?php echo base_url('assets/img/edit.png'); ?>">&nbsp;Edit Report</a></td>
                        <td>
                            <?php if ($row->assign_status == 1): ?>
                                <?php echo '<span style="color:green;"><img src="' . base_url('assets/img/correct.png') . '" />&nbsp;Assigned<span>' ?>

                                <?php
                            else:
                                echo '<span style=""><img src="' . base_url('assets/img/error.png') . '" />&nbsp;Not Assigned</span>';
                            endif;
                            ?>
                        </td>
                        <td>
                            <?php if ($row->specimen_publish_status == 1) : ?>
                                <button class="record_id_unpublish btn btn-link" data-recordserial="<?php echo $row->serial_number; ?>" data-unpublishrecordid="<?php echo site_url() . '/admin/unpublish_record/' . $row->uralensis_request_id; ?>">
                                    Un-Publish
                                </button>
                                <?php
                            else :
                                echo 'Not Published';
                            endif;
                            ?>
                        </td>
                        <td>
                            <button class="record_id_delete btn btn-link" data-recordserial="<?php echo $row->serial_number; ?>" data-delrecordid="<?php echo site_url() . '/admin/delete_admin_side_record/' . $row->uralensis_request_id; ?>">
                                <img src="<?php echo base_url('assets/img/delete.png'); ?>" />
                            </button>
                        </td>
                        <td class="flag_column">
                            <div class="hover_flags">
                                <div class="flag_images">
                                    <?php if ($row->flag_status === 'flag_red') { ?>
                                        <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_red.png'); ?>">
                                    <?php } elseif ($row->flag_status === 'flag_yellow') { ?>
                                        <img data-toggle="tooltip" data-placement="top" title="This case marked for typing." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_yellow.png'); ?>">
                                    <?php } elseif ($row->flag_status === 'flag_blue') { ?>
                                        <img data-toggle="tooltip" data-placement="top" title="This case marked for Pre-Authorization." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_blue.png'); ?>">
                                    <?php } elseif ($row->flag_status === 'flag_black') { ?>
                                        <img data-toggle="tooltip" data-placement="top" title="This case marked as further work." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_black.png'); ?>">
                                    <?php } elseif ($row->flag_status === 'flag_gray') { ?>
                                        <img data-toggle="tooltip" data-placement="top" title="This case marked as awaiting reviews." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_gray.png'); ?>">
                                    <?php } else { ?>
                                        <img data-toggle="tooltip" data-placement="top" title="This case marked as released." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_green.png'); ?>">
                                    <?php } ?>
                                </div>
                                <ul class="report_flags list-unstyled list-inline">
                                    <?php
                                    $active = '';
                                    if ($row->flag_status === 'flag_green') {
                                        $active = 'flag_active';
                                    }
                                    ?>
                                    <li class="<?php echo $active; ?>">
                                        <a href="javascript:;" data-flag="flag_green" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked as released." src="<?php echo base_url('assets/img/flag_green.png'); ?>">
                                        </a>
                                    </li>
                                    <?php
                                    $active = '';
                                    if ($row->flag_status === 'flag_red') {
                                        $active = 'flag_active';
                                    }
                                    ?>
                                    <li class="<?php echo $active; ?>">
                                        <a href="javascript:;" data-flag="flag_red" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="<?php echo base_url('assets/img/flag_red.png'); ?>">
                                        </a>
                                    </li>
                                    <?php
                                    $active = '';
                                    if ($row->flag_status === 'flag_yellow') {
                                        $active = 'flag_active';
                                    }
                                    ?>
                                    <li class="<?php echo $active; ?>">
                                        <a href="javascript:;" data-flag="flag_yellow" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked for typing." src="<?php echo base_url('assets/img/flag_yellow.png'); ?>">
                                        </a>
                                    </li>
                                    <?php
                                    $active = '';
                                    if ($row->flag_status === 'flag_blue') {
                                        $active = 'flag_active';
                                    }
                                    ?>
                                    <li class="<?php echo $active; ?>">
                                        <a href="javascript:;" data-flag="flag_blue" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked for pre authorization." src="<?php echo base_url('assets/img/flag_blue.png'); ?>">
                                        </a>
                                    </li>
                                    <?php
                                    $active = '';
                                    if ($row->flag_status === 'flag_black') {
                                        $active = 'flag_active';
                                    }
                                    ?>
                                    <li class="<?php echo $active; ?>">
                                        <a href="javascript:;" data-flag="flag_black" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked further work." src="<?php echo base_url('assets/img/flag_black.png'); ?>">
                                        </a>
                                    </li>
                                    <?php
                                    $active = '';
                                    if ($row->flag_status === 'flag_gray') {
                                        $active = 'flag_active';
                                    }
                                    ?>
                                    <li class="<?php echo $active; ?>">
                                        <a href="javascript:;" data-flag="flag_gray" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked awaiting reviews." src="<?php echo base_url('assets/img/flag_gray.png'); ?>">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="comments_icon">
                                <a href="javascript:;" id="display_comment_box" class="display_comment_box" data-recordid="<?php echo $row->uralensis_request_id; ?>" data-modalid="<?php echo $flag_count; ?>">
                                    <img src="<?php echo base_url('assets/img/information.png'); ?>">
                                </a>
                                <a href="javascript:;" id="show_comments_list" class="show_comments_list" data-recordid="<?php echo $row->uralensis_request_id; ?>" data-modalid="<?php echo $flag_count; ?>">
                                    <img src="<?php echo base_url('assets/img/chat_comments.png'); ?>">
                                </a>
                            </div>
                            <div id="flag_comment_model-<?php echo $flag_count; ?>" class="flag_comment_model modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Flag Reason Comment</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="flag_msg"></div>
                                            <form class="form flag_comments" id="flag_comments_form">
                                                <div class="form-group">
                                                    <textarea name="flag_comment" id="flag_comment" class="form-control flag_comment"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <hr>
                                                    <input type="hidden" name="record_id" value="<?php echo $row->uralensis_request_id; ?>">
                                                    <a class="btn btn-primary" id="flag_comments_save" href="javascript:;">Save Comments</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="display_comments_list-<?php echo $flag_count; ?>" class="modal fade display_comments_list" role="dialog" data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Flag Comments</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="display_flag_msg"></div>
                                            <div class="flag_comments_dynamic_data"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><p style="display:none;"><?php echo $row->flag_status; ?></p></td>
                    </tr>
                    <?php
                    $flag_count++;
                }//endforeach
                ?>
            </tbody>
        </table>
    </div>
</div>