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
                                                        <input class="tat hospital_user" data-hospitalname="<?php echo !empty($hospital_name) ? html_purify($hospital_name) : ''; ?>" type="radio" id="hospital_<?php echo ($users->id); ?>" name="hospital_user" value="<?php echo ($users->id); ?>">
                                                        <label for="hospital_<?php echo intval($users->id); ?>"><?php echo !empty($hospital_name) ?  html_purify($hospital_name) : ''; ?></label>
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

                <div class="col-md-4 col-md-offset-4">
                    <input class="form-control" type="text" name="tracking_no" placeholder="Enter Tracking No.">
                    <hr />
                    <button class="btn btn-success scan-barcode-btn">Submit</button>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="find_barcode_result"></div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12 load-track-record-data"></div>
</div>

<div class="tg-modalboxarea modal fade" tabindex="-1" role="dialog" id="record_found_modal">
    <div class="modal-dialog" role="document">
        <div class="tg-alreadybookmodal modal-content">
            <a href="javascript;;" class="tg-closebtn close"><i class="lnr lnr-cross" data-dismiss="modal" aria-label="Close"></i></a>
            <div class="modal-body">
                <span class="lnr lnr-thumbs-up"></span>
                <div class="tg-description">
                    <p>Record already existed with this tracking no.</p>
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
                    <p>Record added successfully.</p>
                </div>
            </div>
        </div>
    </div>
</div>