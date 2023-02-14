<!-- Page Content -->
<div class="content container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Tracking</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tracking</li>
                </ul>
            </div>
            <!-- <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i> Add User</a>
            </div> -->
        </div>
    </div>
    <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- <ul id="myList" class="tg-navbtns load-temp-data-list">
                    <li>
                        <a href="javascript:;" class="tracking_template_button" data-hospitalid="18" data-clinicid="56" data-pathologist="10" data-labname="24" data-urgency="routine" data-speci="skin" data-templateid="37">
                            <i class="fa fa-pencil"></i>
                            <h3>Dr Chaudhry</h3>
                        </a>
                    </li>
                </ul> -->

                <div class="tg-trackhead">
                    
                    <div  class="tg-navholder">
                        <ul id="myList" class="tg-navbtns load-temp-data-list">
                            <?php
                            if (!empty($track_templates)) {
                                foreach ($track_templates as $key => $template) {
                                    ?>
                                    <li>
                                        <a href="javascript:;" class="tracking_template_button"
                                           data-hospitalid="<?php echo $template['temp_hospital_user']; ?>"
                                           data-clinicid="<?php echo $template['temp_clinic_user']; ?>"
                                           data-pathologist="<?php echo $template['temp_pathologist']; ?>"
                                           data-labname="<?php echo $template['temp_lab_name']; ?>"
                                           data-urgency="<?php echo $template['temp_report_urgency']; ?>"
                                           data-speci="<?php echo $template['temp_skin_type']; ?>"
                                           data-templateid="<?php echo $template['ura_rec_temp_id']; ?>">
                                            <i class="fa fa-pencil"></i>
                                            <h3><?php echo html_purify($template['temp_input_name']); ?></h3>
                                        </a>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="track_temp_tags">
                </div>
                <div class="tg-catagorytopics">
                    <div class="tg-catagoryholder load-track-edit-template-data load-track-new-template-data">

                    </div>
                </div>

                <!--Templates Search Area Start-->
                <div class="row">
                <div class="col-md-10 offset-1">
                    <div class="tg-tabholder statuses_tab">
                        <ul class="tg-navtabs tab_status_ul" role="tablist">
                            <li role="presentation" class="active show"><a href="#labortory" aria-controls="labortory" role="tab" data-toggle="tab" aria-expanded="false">Laboratory</a></li>
                        </ul>
                        <div class="tg-tabcontent tab-content tab_status_content">
                            <div role="tabpanel" class="tab-pane fade active in show" id="labortory">
                                <ul class="tg-findbtnsarea track_status_list">
                                    <li>
                                        <a href="javascript:;" class="check_status_btn" data-statuscode="Booked In To Lab">
                                            <span>Booked in</span>
                                            <h3>to Lab</h3>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="check_status_btn" data-statuscode="Ready To Allocate">
                                            <span>Ready To</span>
                                            <h3>Allocate</h3>
                                        </a>
                                    </li><li>
                                        <a href="javascript:;" class="check_status_btn" data-statuscode="Booked Out From Lab">
                                            <span>Booked out</span>
                                            <h3>from Lab</h3>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="check_status_btn" data-statuscode="FW Dispatched">
                                            <span>FW</span>
                                            <h3>Dispatched</h3>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tg-specimensearch">
                            <div class="tg-searchcontent">
                                <h3 class="change_status_text">Specimen Track Options</h3>
                                <div class="tg-searchspecimen">
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group form-focus">
                                                    <span class="fa fa-search barcode_no_search"></span>
                                                    <input type="text" name="search_track" value="" class="form-control floating">
                                                    <label class="focus-label">Search by Tracking Number</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <button class="btn btn-success btn-block search_btn btn-lg "  onClick="getsearchbarcode()">Search</button>
                                            </div>
                                        </div>
                                       <!--  <div class="form-group tg-inputicon tg-inputwithicon">
                                            <input type="search" name="barcode_no" class="form-control floating">
                                            <label class="floating">Search by Tracking Number</label>
                                        </div> -->
                                    </fieldset>
                                    <!-- <fieldset class="tg-recordfound hidden-boxes">
                                        <span><i class="fa fa-check"></i></span><p></p>
                                    </fieldset> -->
                                </div>

                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

        </div>
</div>
<!-- /Page Content -->

