<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="tg-trackrecords">
    <div class="container">
        <form class="form specimen_tracking_form tg-formtheme tg-formsearch">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-title">
                        <h3>Specimen Tracking</h3>
                    </div>
                </div>
                <div class="tg-searchareaform">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <fieldset>
                            <div class="form-group tg-inputwithicon">
                                <i class="fa fa-spinner"></i>
                                <input class="form-control" type="text" name="barcode_no" placeholder="Search Via Tracking No.">
                            </div>
                            <div class="form-group tg-or">
                                <em>-or-</em>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="tracking_no_ul" placeholder="Search Via Tracking No. (UL Number)">
                            </div>
                            <div class="form-group tg-or">
                                <em>-or-</em>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="tracking_no_lab" placeholder="Search Via  Tracking No. (Lab Number)">
                            </div>
                            <div class="add_specimen_wrap">

                            </div>
                            <div class="form-group tg-bookedbtn admin_book_out_to_lab_data">

                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="find_barcode_result">

                    </div>
                </div>
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
                                                        $hospital_name = explode(' ', $users->description);
                                                        ?>
                                                        <div class="input-holder">
                                                            <input class="tat hospital_user" data-hospitalname="<?php echo $hospital_name[0] . ' ' . $hospital_name[1]; ?>" type="radio" id="hospital_<?php echo $users->id; ?>" name="hospital_user" value="<?php echo $users->id; ?>">
                                                            <label for="hospital_<?php echo $users->id; ?>"><?php echo $hospital_name[0] . ' ' . $hospital_name[1]; ?></label>
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
                                                    'gi' => 'GI',
                                                    'skin' => 'Skin',
                                                    'other' => 'Other'
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
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12 load-track-record-data">

    </div>
</div>