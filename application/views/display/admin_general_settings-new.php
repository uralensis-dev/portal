<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
if (isset($_SESSION['msg_snomed'])) {
    $snomed_flash_data = $this->session->flashdata('msg_snomed');
}
?>
<div class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="tg-dashboardbox inner-page-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tg-tabsholder mdt_section_select">
                            <div class="tg-tabtitle">
                                <h3>Select hospital</h3>
                                <select name="hospital_id" class="form-control tg-select display_mdt_list_on_hospital">
                                    <option value="">Choose Hospital</option>
                                    <?php
                                    if (!empty($hospitals_list)) {
                                        foreach ($hospitals_list as $hospitals) {
                                            echo '<option value="' . $hospitals->id . '">' . $hospitals->description . '</option> ';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="display_hospitals_options hospitals_options">
                            <div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<h4 class="card-title">Top line tabs</h4>
										<ul class="nav nav-tabs nav-tabs-top">
											<li class="nav-item"><a class="nav-link" href="#add_mdt_dates" data-toggle="tab">Add MDT Dates</a></li>
											<li class="nav-item"><a class="nav-link" href="#add_hospital_clinician" data-toggle="tab">Add Hospital Clinician</a></li>
											<li class="nav-item"><a class="nav-link active" href="#add_dermatological_surgeon" data-toggle="tab">Add Dermatological Surgeon</a></li>
                                            <li class="nav-item"><a class="nav-link active" href="#tat_settings" data-toggle="tab">TAT Settings</a></li>
                                        </ul>
										<div class="tab-content">
											<div class="tab-pane show" id="add_mdt_dates">
                                            <div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mdt_date_msg"></div>
                            <h3 class="text-center">Add MDT Dates</h3>
                            <div class="well mdt_category_area" style="width:100%; float:left;">
                                <button data-toggle="collapse" data-target="#add-mdt-category">Add MDT Category</button>
                                <button class="refresh_mdt_category_data pull-right" data-refreshtype="button">Refresh MDT Category</button>
                                <div id="add-mdt-category" class="collapse in" aria-expanded="true">
                                                        <?php
                                $attributes = array('class' => 'form mdt_category_form');
                                    echo form_open("", $attributes);
                                    ?>
                                  <!--  <form class="form mdt_category_form">-->
                                        <div class="form-group">
                                            <label>Add MDT Category</label>
                                            <input type="text" class="form-control" name="mdt_category_name">
                                            <input type="hidden" name="mdt_category_hospital_id" value="">
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary save_mdt_category">Save</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="mdt_category_list" style="width:100%;float:left;"></div>
                            </div>
                            <?php
                                $attributes = array('mdt_dates_form' => 'form mdt_category_form','class'=>'form mdt_dates_form');
                                    echo form_open("", $attributes);
                                    ?>
                            <!--<form class="form mdt_dates_form" id="mdt_dates_form">-->
                                <div class="form-group">
                                    <label for="mdt_date"></label>
                                    <div class="input-group date" id="mdt_dates" style="margin-top:8px;">
                                        <input  type="text" name="mdt_date" id="mdt_date" class="form-control" style="margin-top:0px;" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    <div class="show_mdt_categories_inputs"></div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="mdt_date_hospital_id" value="">
                                    <button type="button" id="add_mdt_date_btn" class="btn btn-primary">Add Date</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div id='mdt_dates_calendar'></div>
                            <div id="fullCalModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                                            <h4 id="modalTitle" class="modal-title"></h4>
                                        </div>
                                        <div id="modalBody" class="modal-body">
                                            <p id="mdt_date"></p>
                                            <p id="mdt_cat_names"></p>
                                            <p id="mdt_total_records"></p>
                                            <p id="mdt_records_ids"></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <!-- <button class="btn btn-primary"><a id="eventUrl" target="_blank">Event Page</a></button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
											</div>
											<div class="tab-pane show" id="add_hospital_clinician">
                                            <div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                        <?php
                            $attributes = array('class' => 'form assign_hospital_clinician');
                                echo form_open("", $attributes);
                                ?>
                           <!-- <form class="form assign_hospital_clinician">-->
                                <div class="form-group">
                                    <label for="clinician_name">Clinician Name</label>
                                    <input type="text" class="form-control" name="clinician_name" id="clinician_name">
                                </div>
                                <div class="form-group">
                                    <label for="hospital_name">Hospitals</label>
                                    <select class="form-control" name="hospital_id" id="hospital_name">
                                        <option value="false">Choose Hospital</option>
                                        <?php
                                        if (!empty($hospitals_list)) {
                                            foreach ($hospitals_list as $hospitals) {
                                                echo '<option value="' . $hospitals->id . '">' . $hospitals->description . '</option> ';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary assign-clinician-btn">Assign Clinician</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-offset-1 col-md-6">
                            <form>
                                <div class="form-group">
                                    <label for="hospital_name">Search Clinicians</label>
                                    <select class="form-control search-hospital-clinician" name="hospital_id">
                                        <option value="">Choose Hospital</option>
                                        <?php
                                        if (!empty($hospitals_list)) {
                                            foreach ($hospitals_list as $hospitals) {
                                                echo '<option value="' . $hospitals->id . '">' . $hospitals->description . '</option> ';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </form>
                            <div class="hospital_clinician_result">

                            </div>
                        </div>
                    </div>
                </div>
											</div>
                                            <div class="tab-pane show" id="add_dermatological_surgeon">
                                            <div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="dermatological_msg"></div>
                            <?php
                            $attributes = array('id'=>'assign_dermatological_surgeon','class' => 'form');
                                echo form_open("", $attributes);
                                ?>
                           <!-- <form class="form" id="assign_dermatological_surgeon">-->
                                <div class="form-group">
                                    <label for="dermatological_surgeon_name">Dermatological Surgeon Name</label>
                                    <input type="text" class="form-control" name="dermatological_surgeon_name" id="dermatological_surgeon_name">
                                </div>
                                <div class="form-group">
                                    <label for="hospital_name">Hospitals</label>
                                    <select class="form-control" name="hospital_id" id="hospital_name">
                                        <option value="false">Choose Hospital</option>
                                        <?php
                                        if (!empty($hospitals_list)) {
                                            foreach ($hospitals_list as $hospitals) {
                                                echo '<option value="' . $hospitals->id . '">' . $hospitals->description . '</option> ';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" id="assign_dermatological">Assign Dermatological Surgeon</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-offset-1 col-md-6">
                            <form>
                                <div class="form-group">
                                    <label for="hospital_name">Search Dermatological Surgeon</label>
                                    <select class="form-control search-hospital-dermatological" name="hospital_id">
                                        <option value="">Choose Hospital</option>
                                        <?php
                                        if (!empty($hospitals_list)) {
                                            foreach ($hospitals_list as $hospitals) {
                                                echo '<option value="' . $hospitals->id . '">' . $hospitals->description . '</option> ';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </form>
                            <div class="hospital_dermatological_result"></div>
                        </div>
                    </div>
                </div>
											</div>
                                            <div class="tab-pane show" id="tat_settings">
                                            <div>
                    <hr>
                    <h3 class="text-center">TAT Settings</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <form class="form tat_assign_form">
                                <div class="form-group">
                                    <select name="tat_hospital" class="form-control">
                                        <option value="">Choose Hospital</option>
                                        <?php
                                        if (!empty($hospitals_list)) {
                                            foreach ($hospitals_list as $hospitals) {
                                                echo '<option value="' . $hospitals->id . '">' . $hospitals->description . '</option> ';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="tat_date">
                                        <option value="">Choose TAT Date</option>
                                        <option value="request_datetime">Request Date</option>
                                        <option value="publish_datetime">Publish Date</option>
                                        <option value="date_received_bylab">Received By Lab Date</option>
                                        <option value="data_processed_bylab">Processed By Lab Date</option>
                                        <option value="date_sent_touralensis">Lab Released Date</option>
                                        <option value="date_rec_by_doctor">Received By Doctor Date</option>
                                        <option value="date_taken">Date Taken</option>
                                    </select>
                                    <em>Please choose the date in which you want to apply TAT.</em>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary tat_assign_date">Save</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4 display_tat">
                            <div class="form-group">
                                <select name="tat_hospital" class="form-control show_tat_settings">
                                    <option value="">Choose Hospital</option>
                                    <?php
                                    if (!empty($hospitals_list)) {
                                        foreach ($hospitals_list as $hospitals) {
                                            echo '<option value="' . $hospitals->id . '">' . $hospitals->description . '</option> ';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="display_tat_settings"></div>
                        </div>
                    </div>
                </div>
											</div>
										</div>
									</div>
								</div>
							</div>


                               </div>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- Tabs -->
                <div class="row">
                <div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<h4 class="card-title">Rounded justified</h4>
										<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
											<li class="nav-item"><a class="nav-link" href="#publish_report_password" data-toggle="tab">Publish Password</a></li>
											<li class="nav-item"><a class="nav-link" href="#add_teach_mdt_cats" data-toggle="tab">Teaching & CPC</a></li>
											<li class="nav-item"><a class="nav-link" href="#add_sec_assign" data-toggle="tab">Secretary Assigning</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#add_lab_names" data-toggle="tab">Add Lab Names</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#add_microscopic_codes" data-toggle="tab">Add Microscopic Codes</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#add_snomed_codes" data-toggle="tab">Add Snomed Codes</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#add_datasets" data-toggle="tab">Add Datasets</a></li>
										</ul>
										<div class="tab-content">
				<div class="tab-pane show" id="publish_report_password">
                                            <div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="lead text-center">Change Your Published Report Authorization Password.</p>
                            <div id="publish_pass_change_status"></div>

                            <?php
                                $attributes = array('id' => 'doctor_publish_pass_form');
                                    echo form_open("", $attributes);
                                    ?>
                           <!-- <form id="doctor_publish_pass_form">-->
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="doctors_list">Change Password</label>
                                        <select class="form-control" name="doctors_list" id="doctors_list">
                                            <option value="0">Select Doctor</option>
                                            <?php
                                            if (!empty($doc_users_table_query) && is_array($doc_users_table_query)) {
                                                foreach ($doc_users_table_query as $list_doctors) {
                                                    echo '<option value="' . $list_doctors->id . '">' . $list_doctors->first_name . $list_doctors->last_name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div style="display:none;" class="form-group col-md-4 pass_field">
                                        <label for="doctor_publish_password">Enter Password</label>
                                        <input class="form-control" required type="text" name="doctor_publish_password" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <button id="submit_publish_pass" type="submit" class="btn btn-primary btn-sm">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <script>
                        jQuery(document).ready(function () {

                            jQuery(document).on('change', '#doctors_list', function (e) {
                                e.preventDefault();
                                if (jQuery('#doctors_list').val() == 0) {
                                    jQuery('.pass_field').hide();
                                } else {
                                    jQuery('.pass_field').show();
                                }
                            });

                            jQuery('#doctor_publish_pass_form').on('click', '#submit_publish_pass', function (e) {
                                e.preventDefault();
                                var form_data = jQuery('#doctor_publish_pass_form').serialize();

                                jQuery.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url('/index.php/Admin/change_publish_record_password'); ?>",
                                    data: form_data,
                                    dataType: "json",
                                    success: function (response) {
                                        if (response.type === 'success') {
                                            jQuery('#publish_pass_change_status').html(response.msg);
                                        } else {
                                            jQuery('#publish_pass_change_status').html(response.msg);
                                        }
                                    }
                                });
                            });
                        });
                    </script>
                    <hr>
                </div>
											</div>
											<div class="tab-pane" id="add_teach_mdt_cats">
												 <div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="lead text-center">ADD Teaching and CPC Categories.</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="parent_cat_msg"></div>
                                                                    <?php
                                        $attributes = array('id' => 'teach_and_mdt_cats');
                                            echo form_open("", $attributes);
                                            ?>
                                                                    <!--<form id="teach_and_mdt_cats">-->
                                        <div class="form-group">
                                            <label for="tech_mdt_cats">Add Parent Category</label>
                                            <input placeholder="Enter Parent Category Name" class="form-control" type="text" name="tech_mdt_cats" id="tech_mdt_cats" >
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="add_tech_mdt_parent" value="add_tech_mdt_parent">
                                            <button name="add_tech_mdt_parent" value="add_tech_mdt_parent" class="btn btn-primary" type="button" id="add_tech_mdt_parent">Add Parent Category</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <div class="child_cat_msg"></div>
                                    <?php
                                        $attributes = array('id' => 'teach_and_mdt_cats_child');
                                            echo form_open("", $attributes);
                                            ?>
                                                                <!-- <form id="teach_and_mdt_cats_child">-->
                                        <div class="form-group">
                                            <label for="tech_mdt_parent_cat">Parent Category</label>
                                            <select id="tech_mdt_parent_cat" name="tech_mdt_parent_cat" class="form-control">
                                                <option value="0">Select Parent Category</option>
                                                <?php
                                                if (!empty($list_cats)) {
                                                    foreach ($list_cats as $parent_cats) {
                                                        ?>
                                                        <option value="<?php echo $parent_cats->ura_tec_mdt_id; ?>"><?php echo $parent_cats->ura_tech_mdt_cat; ?></option>
                                                        <?php
                                                    }//endforeach
                                                }// endif
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="tech_mdt_cats_type">Choose Type</label>
                                            <select class="form-control" id="tech_mdt_cats_type" name="tech_mdt_cats_type">
                                                <option value="0">Select The Type</option>
                                                <option value="teaching">Teaching</option>
                                                <option value="cpc">CPC</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="tech_mdt_cats_child_name">Add Child Category</label>
                                            <input placeholder="Enter Child Category Name" class="form-control" type="text" name="tech_mdt_cats_child_name" id="tech_mdt_cats_child_name" >
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="add_tech_mdt_child" id="add_tech_mdt_child" value="add_tech_mdt_child">
                                            <button class="btn btn-primary" type="button" id="add_tech_mdt_child">Add Child Category</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <strong>Categories Tree View</strong>
                                    <div class="mdt_del_msg"></div>
                                    <hr>
                                    <div class="mdt_teach_cpc_list_wrapper">
                                        <ul id="mdt_teach_cpc_list" class="list-group">
                                            <?php
                                            if (!empty($tech_mdt_tree)) {
                                                foreach ($tech_mdt_tree as $row) {
                                                    ?>
                                                    <li id="mdt_teach_cpc_id_<?php echo $row['ura_tec_mdt_id']; ?>" class="list-group-item">
                                                        <?php echo $row['ura_tech_mdt_cat']; ?>
                                                        <?php if ($row['ura_tech_mdt_parent'] != 0) { ?>
                                                            <a data-mdtcpcteach="<?php echo $row['ura_tec_mdt_id']; ?>" href="javascript:;" class="delete_mdt_tec_cpc">
                                                                <i class="glyphicon glyphicon-remove pull-right" style="color: red;"></i>
                                                            </a>
                                                        <?php } ?>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
											</div>
											<div class="tab-pane" id="add_sec_assign">
                                            <div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="sec_assign_msg"></div>
                                                <?php
                            $attributes = array('id'=>'assign_secretary_form','class' => 'form assign_hospital_clinician');
                                echo form_open("", $attributes);
                                ?>
                            <!--<form id="assign_secretary_form" enctype="multipart/form-data">-->
                                <div class="form-group">
                                    <label for="sec_doc_list">Doctors</label>
                                    <select class="form-control" name="sec_doc_list" id="sec_doc_list">
                                        <option value="false">Choose Doctor</option>
                                        <?php
                                        if (!empty($doc_users_table_query) && is_array($doc_users_table_query)) {
                                            foreach ($doc_users_table_query as $list_doctors) {
                                                echo '<option value="' . $list_doctors->id . '">' . $list_doctors->first_name . $list_doctors->last_name . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="secretary">Choose Secretary</label>
                                    <select multiple class="form-control" id="secretary" name="secretary[]">
                                        <?php
                                        if (!empty($secretary_detail) && is_array($secretary_detail)) {
                                            foreach ($secretary_detail as $secretary) {
                                                echo '<option value="' . $secretary->id . '">' . $secretary->first_name . $secretary->last_name . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <button id="assign_secretary" type="button" class="btn btn-primary btn-sm">Assign</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="sec_del_msg"></div>
                            <table id="doc_sec_assign_table" class="table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr class="bg-info">
                                        <th>Doctor Name</th>
                                        <th>Secretary Name</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($doc_sec_list)) {
                                        foreach ($doc_sec_list as $key => $value) {
                                            // $doc_first = !empty($this->ion_auth->user($value->ura_doctor_id)->row()->first_name) ? $this->ion_auth->user($value->ura_doctor_id)->row()->first_name : '';
                                            // $doc_last = !empty($this->ion_auth->user($value->ura_doctor_id)->row()->last_name) ? $this->ion_auth->user($value->ura_doctor_id)->row()->last_name : '';
                                            // $sec_first = !empty($this->ion_auth->user($value->ura_sec_id)->row()->first_name) ? $this->ion_auth->user($value->ura_sec_id)->row()->first_name : '';
                                            // $sec_last = !empty($this->ion_auth->user($value->ura_sec_id)->row()->last_name) ? $this->ion_auth->user($value->ura_sec_id)->row()->last_name : '';
                                            
                                            $doc_first = getRecords("AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name","users",array("id"=>$value->ura_doctor_id));
                                            $doc_last = getRecords("AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name","users",array("id"=>$value->ura_doctor_id));
                                            $sec_first = getRecords("AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name","users",array("id"=>$value->ura_doctor_id));
                                            $sec_last = getRecords("AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name","users",array("id"=>$value->ura_doctor_id));
                                            ?>
                                            <tr>
                                                <td><?php echo $doc_first[0]->first_name . ' ' . $doc_last[0]->last_name; ?></td>
                                                <td><?php echo $sec_first[0]->first_name .' ' . $sec_last[0]->last_name; ?></td>
                                                <td>
                                                    <a class="delete_sec" href="javascript:;" data-rowid="<?php echo $value->ura_doc_sec_assign_id; ?>" data-docid="<?php echo $value->ura_doctor_id; ?>">
                                                        <img src="<?php echo base_url('assets/img/delete.png'); ?>"
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
											</div>
                                            <div class="tab-pane" id="add_lab_names">
                                            <div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <form class="form add_lab_name_form">
                                <div class="form-group">
                                    <label for="lab_name">Lab Name</label>
                                    <input type="text" class="form-control" name="lab_name" id="lab_name">
                                </div>
                                <div class="form-group">
                                    <label for="lab_email_1">Lab Email 1</label>
                                    <input type="email" class="form-control" name="lab_email[]" id="lab_email_1">
                                </div>
                                <div class="form-group">
                                    <label for="lab_email_2">Lab Email 2 (Optional)</label>
                                    <input type="email" class="form-control" name="lab_email[]" id="lab_email_2">
                                </div>
                                <div class="form-group">
                                    <label for="lab_email_3">Lab Email 3 (Optional)</label>
                                    <input type="email" class="form-control" name="lab_email[]" id="lab_email_3">
                                </div>
                                <div class="form-group">
                                    <label for="lab_email_4">Lab Email 4 (Optional)</label>
                                    <input type="email" class="form-control" name="lab_email[]" id="lab_email_4">
                                </div>
                                <div class="form-group">
                                    <?php
                                    $pci_format = sprintf("%s%u%s", 'PU', date('y'), '-99999');
                                    $accute_format = sprintf("%s%u%s", 'S', date('y'), '/99999');
                                    $cheshire_format = sprintf("%s%s%u", 'H', '/99999/', date('y'));
                                    $christie_format = sprintf("%s%u%s", 'H', date('y'), '-99999');
                                    $nnu_format = sprintf("%u%s%s", date('y'), 'S', '99999');
                                    $other_format = sprintf("s", 'U');
                                    ?>
                                    <label for="lab_number_format">Choose Format</label>
                                    <select name="lab_number_format" id="lab_number_format" class="form-control lab_number_format">
                                        <option value="">Choose Format</option>
                                        <option value="<?php echo $pci_format; ?>">PCI</option>
                                        <option value="<?php echo $accute_format; ?>">Acute Pennine</option>
                                        <option value="<?php echo $cheshire_format; ?>">Mid-Cheshire</option>
                                        <option value="<?php echo $christie_format; ?>">Christie</option>
                                        <option value="<?php echo $nnu_format; ?>">NNU</option>
                                        <option value="<?php echo $other_format; ?>">Other</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" readonly class="form-control lab_number_mask">
                                    <input type="hidden" name="submit_type" value="add">

                                </div>
                                <div class="form-group">
                                    <button type="button" data-submittype="add" class="btn btn-primary add_lab_names_btn">Add Lab</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <?php
                            if (!empty($lab_name_record)) {
                                ?>
                                <h3>Lab Names</h3>
                                <ul id="mdt_dates_list" class="list-group">
                                    <?php
                                    foreach ($lab_name_record as $key => $lab_data) {
                                        $lab_name_email = @unserialize($lab_data->lab_email);
                                        if ($lab_name_email !== FALSE) {
                                            //Do nothing
                                        } else {
                                            $lab_name_email[0] = $lab_data->lab_email;
                                        }

                                        $to = '';
                                        $bcc1 = '';
                                        $bcc2 = '';
                                        $bcc3 = '';
                                        if (!empty($lab_name_email[0])) {
                                            $to = $lab_name_email[0];
                                        }
                                        if (!empty($lab_name_email[1])) {
                                            $bcc1 = $lab_name_email[1];
                                        }

                                        if (!empty($lab_name_email[2])) {
                                            $bcc2 = $lab_name_email[2];
                                        }

                                        if (!empty($lab_name_email[3])) {
                                            $bcc3 = $lab_name_email[3];
                                        }
                                        ?>
                                        <li class="list-group-item">
                                            <?php echo $lab_data->lab_name; ?>
                                            <a data-labname="<?php echo $lab_data->lab_name_id; ?>" href="javascript:;" class="lab_name_delete"><i class="glyphicon glyphicon-remove pull-right" style="color: red;"></i></a>
                                            <a data-labname="<?php echo $lab_data->lab_name_id; ?>" href="javascript:;" data-toggle="modal" data-target="#lab_name_modal_edit_<?php echo $lab_data->lab_name_id; ?>"><i class="glyphicon glyphicon-edit pull-right" style="color: green; margin-right: 10px;"></i></a> 
                                        </li>

                                        <div id="lab_name_modal_edit_<?php echo $lab_data->lab_name_id; ?>" class="modal fade lab_name_modal_edit" role="dialog" data-labname="<?php echo $lab_data->lab_name_id; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <form class="form update_lab_name_form">
                                                            <div class="form-group">
                                                                <label for="lab_name">Lab Name</label>
                                                                <input type="text" class="form-control" name="lab_name" id="lab_name" value="<?php echo!empty($lab_data->lab_name) ? $lab_data->lab_name : ''; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="lab_email_1">Lab Email 1</label>
                                                                <input type="email" class="form-control" name="lab_email[]" id="lab_email_1" value="<?php echo!empty($to) ? $to : ''; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="lab_email_2">Lab Email 2 (Optional)</label>
                                                                <input type="email" class="form-control" name="lab_email[]" id="lab_email_2" value="<?php echo!empty($bcc1) ? $bcc1 : ''; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="lab_email_3">Lab Email 3 (Optional)</label>
                                                                <input type="email" class="form-control" name="lab_email[]" id="lab_email_3" value="<?php echo!empty($bcc2) ? $bcc2 : ''; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="lab_email_4">Lab Email 4 (Optional)</label>
                                                                <input type="email" class="form-control" name="lab_email[]" id="lab_email_4" value="<?php echo!empty($bcc3) ? $bcc3 : ''; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="lab_format_mask">Lab Format Mask</label>
                                                                <input type="text" id="lab_format_mask" name="lab_format_mask" value="<?php echo $lab_data->lab_format_mask; ?>" class="form-control">
                                                                <input type="hidden" name="submit_type" value="edit">
                                                                <input type="hidden" name="lab_id" value="<?php echo $lab_data->lab_name_id; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="button" class="btn btn-primary edit_lab_names_btn">Edit Lab</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                        </div>
                    </div>
                </div>
											</div>
                                            <div class="tab-pane" id="add_microscopic_codes">
                <div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <?php echo isset($msg) ? $msg : ''; ?>
                            <div class="microscopic_codes">
                                <form action="<?php echo base_url('index.php/admin/upload_microscopic_csv'); ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="upload_micro_csv">Upload Microscopic CSV</label>
                                        <input class="form-control" type="file" name="upload_micro_csv" id="upload_micro_csv">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success pull-left">Upload csv</button>
                                        <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#add_micro_codes">Add Microscopic Codes</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 microscopic">
                            <div class="micro_msg"></div>
                            <a href="<?php echo base_url('index.php/admin/download_microscopic_code_csv'); ?>" class="btn btn-primary pull-right">Download CSV</a>
                            <div class="clearfix"></div>
                            <hr>
                            <table id="microscopic_code_table" class="table table-striped" cellspacing="0" width="100%">
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
                                                <td><?php 
                                                 $username = getRecords("AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name,AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name","users",array("id"=>$codes->umc_added_by));
                                                 echo $username[0]->first_name." ".$username[0]->last_name;
                                                ///echo uralensisGetUsername($codes->umc_added_by, 'fullname'); ?></td>
                                                <td><?php echo $codes->umc_status; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('index.php/admin/edit_microscopic_code_view/' . $codes->umc_id); ?>" class="edit_micro_code">
                                                        <img src="<?php echo base_url('assets/img/edit_clinic.png'); ?>">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="javascript:;" class="delete_micro_code" data-microid="<?php echo $codes->umc_code; ?>">
                                                        <img src="<?php echo base_url('assets/img/delete.png'); ?>">
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
											</div>
                                            <div class="tab-pane" id="add_snomed_codes">
                                            <?php
                    $snomed_collapse = '';
                    $snomed_msg = '';
                    if (!empty($snomed_flash_data)) {
                        $snomed_msg = $snomed_flash_data['msg'];
                        $snomed_collapse = 'in';
                    }
                ?>
                <div>
                    <div class="row">
                        <hr>
                        <ul class="tg-themenavtabs nav navbar-nav">
                            <li class="nav-item active">
                                <a data-toggle="tab" href="#tabs_t1">Snomed Code T1&T2</a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="tab" href="#tabs_p">Snomed Code P</a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="tab" href="#tabs_m">Snomed Code M</a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                        <div class="tg-tabcontentvtwo tab-content">
                        <?php echo $snomed_msg; ?>
                            <div class="tg-navtabsdetails tab-pane fade in active" id="tabs_t1">
                                <div class="col-md-12">
                                        <hr>
                                        <strong>Add T1 & T2 Codes</strong> <br />
                                        <?php echo isset($msg) ? $msg : ''; ?>
                                        <div class="snomed_codes">
                                            <form action="<?php echo base_url('index.php/admin/uploadSnomedCodes'); ?>" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="upload_snomed_csv">Upload Snomed CSV</label>
                                                    <input class="form-control" type="file" name="upload_snomed_csv" id="upload_snomed_csv">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success pull-left">Upload csv</button>
                                                    <a href="<?php echo base_url('index.php/admin/deleteAllSnomedCodes/t1'); ?>" class="btn btn-danger pull-right delete_snomed_code">Delete</button>
                                                    <a href="<?php echo base_url('index.php/admin/downloadSnomedCodes/t1'); ?>" class="btn btn-info pull-right">Download</a>
                                                </div>
                                                <div class="clearfix"></div>
                                            </form>
                                        </div>
                                        <hr>
                                        <div class="clearfix"></div>
                                        <?php
                                            $snomed_codes = getSnomedCodesData('t1');
                                            if (!empty($snomed_codes)) { ?>
                                        <table id="snomed_t1_code_table" class="table table-striped" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>T1 & T2 Code</th>
                                                    <th>Description</th>
                                                    <th>Added By</th>
                                                    <th>Status</th>
                                                    <th>&nbsp;</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($snomed_codes as $snomed_data) { ?>
                                                    <tr>
                                                        <td><?php echo $snomed_data['usmdcode_code']; ?></td>
                                                        <td><?php echo $snomed_data['usmdcode_code_desc']; ?></td>
                                                        <td><?php
                                                        $username = getRecords("AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name,AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name","users",array("id"=>$snomed_data['snomed_added_by']));
                                                        echo $username[0]->first_name." ".$username[0]->last_name;
                                                        // echo uralensisGetUsername($snomed_data['snomed_added_by'], 'fullname'); ?></td>
                                                        <td><?php echo $snomed_data['snomed_status']; ?></td>
                                                        <td>
                                                            <a href="<?php echo base_url('index.php/admin/editSnomedCode/' . $snomed_data['usmd_code_id'].'/t1'); ?>" class="edit_snomed_code">
                                                                <img src="<?php echo base_url('assets/img/edit_clinic.png'); ?>">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="javascript:;" class="delete_snomed_code" data-snomedtype="t1" data-snomedid="<?php echo $snomed_data['usmd_code_id']; ?>">
                                                                <img src="<?php echo base_url('assets/img/delete.png'); ?>">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } else {
                                        echo 'No Record Added Yet!';
                                    } ?>
                                </div>
                            </div>
                            <div class="tg-navtabsdetails tab-pane fade" id="tabs_p">
                                <div class="col-md-12">
                                    <hr>
                                        <strong>Add P Codes</strong> <br>
                                        
                                            <?php echo isset($msg) ? $msg : ''; ?>
                                            <div class="snomed_codes">
                                                <form action="<?php echo base_url('index.php/admin/uploadSnomedCodes'); ?>" method="post" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="upload_snomed_csv">Upload Snomed CSV</label>
                                                        <input class="form-control" type="file" name="upload_snomed_csv" id="upload_snomed_csv">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success pull-left">Upload csv</button>
                                                        <a href="<?php echo base_url('index.php/admin/deleteAllSnomedCodes/p'); ?>" class="btn btn-danger pull-right delete_snomed_code">Delete</button>
                                                        <a href="<?php echo base_url('index.php/admin/downloadSnomedCodes/p'); ?>" class="btn btn-info pull-right">Download</a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </form>
                                            </div>
                                            <hr>
                                            <div class="clearfix"></div>
                                            <?php
                                                $snomed_codes = getSnomedCodesData('p');
                                                if (!empty($snomed_codes)) { 
                                            ?>
                                            <table id="snomed_p_code_table" class="table table-striped" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>P Code</th>
                                                        <th>Description</th>
                                                        <th>Added By</th>
                                                        <th>Status</th>
                                                        <th>&nbsp;</th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        <?php foreach ($snomed_codes as $snomed_data) { ?>
                                                            <tr>
                                                                <td><?php echo $snomed_data['usmdcode_code']; ?></td>
                                                                <td><?php echo $snomed_data['usmdcode_code_desc']; ?></td>
                                                                <td><?php 
                                                                
                                                                $username = getRecords("AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name,AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name","users",array("id"=>$snomed_data['snomed_added_by']));
                                                                echo $username[0]->first_name." ".$username[0]->last_name;
                                                                //echo uralensisGetUsername($snomed_data['snomed_added_by'], 'fullname'); ?></td>
                                                                <td><?php echo $snomed_data['snomed_status']; ?></td>
                                                                <td>
                                                                    <a href="<?php echo base_url('index.php/admin/editSnomedCode/' . $snomed_data['usmd_code_id'].'/p'); ?>" class="edit_snomed_code">
                                                                        <img src="<?php echo base_url('assets/img/edit_clinic.png'); ?>">
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:;" class="delete_snomed_code" data-snomedtype="p" data-snomedid="<?php echo $snomed_data['usmd_code_id']; ?>">
                                                                        <img src="<?php echo base_url('assets/img/delete.png'); ?>">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                </tbody>
                                            </table>
                                        <?php } else{ 
                                            echo 'No Record Added Yet!';
                                            } ?>
                                </div>
                            </div>
                            <div class="tg-navtabsdetails tab-pane fade" id="tabs_m">
                                <div class="col-md-12">
                                <hr>
                                <strong>Add M Codes</strong> <br>
                                
                                    <?php echo isset($msg) ? $msg : ''; ?>
                                    <div class="snomed_codes">
                                        <form action="<?php echo base_url('index.php/admin/uploadSnomedCodes'); ?>" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="upload_snomed_csv">Upload Snomed CSV</label>
                                                <input class="form-control" type="file" name="upload_snomed_csv" id="upload_snomed_csv">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success pull-left">Upload csv</button>
                                                <a href="<?php echo base_url('index.php/admin/deleteAllSnomedCodes/m'); ?>" class="btn btn-danger pull-right delete_snomed_code">Delete</button>
                                                <a href="<?php echo base_url('index.php/admin/downloadSnomedCodes/m'); ?>" class="btn btn-info pull-right">Download</a>
                                            </div>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                    <hr>
                                    <div class="clearfix"></div>
                                    <?php
                                        $snomed_codes = getSnomedCodesData('m');
                                        if (!empty($snomed_codes)) { 
                                    ?>
                                    <table id="snomed_m_code_table" class="table table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>M Code</th>
                                                <th>Description</th>
                                                <th>Diagnoses</th>
                                                <th>RCPath</th>
                                                <th>Added By</th>
                                                <th>Status</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php foreach ($snomed_codes as $snomed_data) { ?>
                                                    <tr>
                                                        <td><?php echo $snomed_data['usmdcode_code']; ?></td>
                                                        <td><?php echo $snomed_data['usmdcode_code_desc']; ?></td>
                                                        <td><?php echo $snomed_data['snomed_diagnoses']; ?></td>
                                                        <td><?php echo $snomed_data['rc_path_score']; ?></td>
                                                        <td><?php 
                                                         //$username = getRecords("AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name,AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name","users",array("id"=>$snomed_data['snomed_added_by']));
                                                         //echo $username[0]->first_name." ".$username[0]->last_name;
                                                        echo uralensisGetUsername($snomed_data['snomed_added_by'], 'fullname'); ?></td>
                                                        <td><?php echo $snomed_data['snomed_status']; ?></td>
                                                        <td>
                                                            <a href="<?php echo base_url('index.php/admin/editSnomedCode/' . $snomed_data['usmd_code_id'].'/m'); ?>" class="edit_snomed_code">
                                                                <img src="<?php echo base_url('assets/img/edit_clinic.png'); ?>">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="javascript:;" class="delete_snomed_code" data-snomedtype="m" data-snomedid="<?php echo $snomed_data['usmd_code_id']; ?>">
                                                                <img src="<?php echo base_url('assets/img/delete.png'); ?>">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else{ 
                                    echo 'No Record Added Yet!';
                                    } ?>
                            </div>
                        </div>
                    </div>
                </div>
				</div>
											</div>
                                            <div class="tab-pane" id="add_datasets">
                    <div>
                    <hr>
                    <h3 class="text-center">Datasets</h3>
                    <div class="row">
                        <div class="col-md-3">
                            <form class="form">
                                <div class="form-group">
                                    <label for="dataset_name">Dataset Name</label>
                                    <input type="text" class="form-control" name="dataset_name" id="dataset_name">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary save_dataset">Save Dataset</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <?php if (!empty($datasets)) { ?>
                                <div class="panel-group" id="datasets-accordion">
                                    <?php foreach ($datasets as $key => $value) { ?>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#datasets-accordion" href="#datacollase-<?php echo intval($value->ura_datasets_id); ?>">
                                                        <?php echo $value->ura_datasets_name; ?>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="datacollase-<?php echo intval($value->ura_datasets_id); ?>" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <button data-toggle="collapse" data-target="#dataset-cat-<?php echo intval($value->ura_datasets_id); ?>">Add Dataset Category</button>
                                                    <button class="refresh_dataset_data pull-right" data-datasetid="<?php echo intval($value->ura_datasets_id); ?>">Refresh Dataset</button>
                                                    <div class="clearfix"></div>
                                                    <div id="dataset-cat-<?php echo intval($value->ura_datasets_id); ?>" class="collapse">
                                                        <form class="form dataset_cat_form">
                                                            <div class="form-group">
                                                                <label>Dataset Category</label>
                                                                <input type="text" class="form-control" name="dataset_cat">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="hidden" name="dataset_parent_id" value="<?php echo intval($value->ura_datasets_id); ?>">
                                                                <button class="btn btn-primary save_dataset_cat">Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <hr>
                                                    <div class="refresh_dataset_response"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-5 dataset_data">
                            <?php if (!empty($datasets)) { ?>
                                <select name="dataset_parent_name" class="form-control dataset_parent_name">
                                    <option value="">Choose Dataset</option>
                                    <?php foreach ($datasets as $key => $value) { ?>
                                        <option value="<?php echo $value->ura_datasets_id; ?>"><?php echo $value->ura_datasets_name; ?></option>
                                    <?php } ?>
                                </select>
                            <?php } ?>
                            <div class="dataset_cat_response">

                            </div>
                        </div>
                    </div>
                </div>
											</div>
										</div>
									</div>
								</div>
							</div>
                </div>
                <!-- Tabs -->
               <!-- Tabs-->
               <div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<h4 class="card-title">Rounded justified</h4>
										<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
											<li class="nav-item"><a class="nav-link" href="#specimen_accepted_by" data-toggle="tab">Specimen Accepted By</a></li>
											<li class="nav-item"><a class="nav-link" href="#specimen_labeled_by" data-toggle="tab">Specimen Labeled By</a></li>
											<li class="nav-item"><a class="nav-link" href="#specimen_cutup_by" data-toggle="tab">Specimen Cut Up By</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#specimen_blockchecked_by" data-toggle="tab">Specimen Block Checked By</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#specimen_qcd_by" data-toggle="tab">Specimen QC'd By</a></li>
										</ul>
										<div class="tab-content">
											<div class="tab-pane show" id="specimen_accepted_by">
                <div>
                    <hr>
                 <div class="col-md-4">
                        <form class="form speci_data_form">
                            <div class="form-group">
                                <label>Specimen Accepted By Name</label>
                                <input type="text" class="form-control" name="specimen_accepted_by">
                                <input type="hidden" name="specimen_type" value="accepted_by">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info save_speci_data_btn" type="button">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <strong>Specimen Accepted By Data</strong>
                        <?php if (!empty($specimen_accepted_by)) { ?>
                            <ul class="list-group">
                                <?php foreach ($specimen_accepted_by as $key => $value) { ?>
                                    <li class="list-group-item">
                                        <?php echo $value['spec_accep_by_name']; ?>
                                        <a data-itemid="<?php echo $value['spec_accep_by_id']; ?>" data-itemtype="specimen_accepted_by" href="javascript:;" class="item_delete">
                                            <i class="glyphicon glyphicon-remove pull-right" style="color: red;"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
											</div>
											<div class="tab-pane show" id="specimen_labeled_by">
                <div>
                    <hr>
                    <div class="col-md-4">
                        <form class="form speci_data_form">
                            <div class="form-group">
                                <label>Specimen Labeled By Name</label>
                                <input type="text" class="form-control" name="specimen_labeled_by">
                                <input type="hidden" name="specimen_type" value="labeled_by">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info save_speci_data_btn" type="button">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <strong>Specimen Labeled By Data</strong>
                        <?php if (!empty($specimen_labeled_by)) { ?>
                            <ul class="list-group">
                                <?php foreach ($specimen_labeled_by as $key => $value) { ?>
                                    <li class="list-group-item">
                                        <?php echo $value['spec_labeled_by_name']; ?>
                                        <a data-itemid="<?php echo $value['spec_labeled_by_id']; ?>" data-itemtype="specimen_labeled_by" href="javascript:;" class="item_delete">
                                            <i class="glyphicon glyphicon-remove pull-right" style="color: red;"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
											</div>
                                            <div class="tab-pane show" id="specimen_cutup_by">
                <div>
                    <hr>
                    <div class="col-md-4">
                        <form class="form speci_data_form">
                            <div class="form-group">
                                <label>Specimen Cut Up By Name</label>
                                <input type="text" class="form-control" name="specimen_cutup_by">
                                <input type="hidden" name="specimen_type" value="cutup_by">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info save_speci_data_btn" type="button">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <strong>Specimen Cut Up By Data</strong>
                        <?php if (!empty($specimen_cutup_by)) { ?>
                            <ul class="list-group">
                                <?php foreach ($specimen_cutup_by as $key => $value) { ?>
                                    <li class="list-group-item">
                                        <?php echo $value['spec_cutup_by_name']; ?>
                                        <a data-itemid="<?php echo $value['spec_cutup_by_id']; ?>" data-itemtype="specimen_cutup_by" href="javascript:;" class="item_delete">
                                            <i class="glyphicon glyphicon-remove pull-right" style="color: red;"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
											</div>
                                            <div class="tab-pane show" id="specimen_blockchecked_by">
                <div>
                    <hr>
                    <div class="col-md-4">
                        <form class="form speci_data_form">
                            <div class="form-group">
                                <label>Specimen Blocked Checked By Name</label>
                                <input type="text" class="form-control" name="specimen_blockchecked_by">
                                <input type="hidden" name="specimen_type" value="blockchecked_by">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info save_speci_data_btn" type="button">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <strong>Specimen Blocked Checked By Data</strong>
                        <?php if (!empty($specimen_block_checked_by)) { ?>
                            <ul class="list-group">
                                <?php foreach ($specimen_block_checked_by as $key => $value) { ?>
                                    <li class="list-group-item">
                                        <?php echo $value['spec_block_check_name']; ?>
                                        <a data-itemid="<?php echo $value['spec_block_check_id']; ?>" data-itemtype="specimen_block_checked_by" href="javascript:;" class="item_delete">
                                            <i class="glyphicon glyphicon-remove pull-right" style="color: red;"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
											</div>
                                            <div class="tab-pane show" id="specimen_qcd_by">
                <div>
                    <hr>
                    <div class="col-md-4">
                        <form class="form speci_data_form">
                            <div class="form-group">
                                <label>Specimen QC'd By Name</label>
                                <input type="text" class="form-control" name="specimen_qcd_by">
                                <input type="hidden" name="specimen_type" value="qcd_by">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info save_speci_data_btn" type="button">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <strong>Specimen QC'd By Data</strong>
                        <?php if (!empty($specimen_qcd_by)) { ?>
                            <ul class="list-group">
                                <?php foreach ($specimen_qcd_by as $key => $value) { ?>
                                    <li class="list-group-item">
                                        <?php echo $value['spec_qcd_by_name']; ?>
                                        <a data-itemid="<?php echo $value['spec_qcd_by_id']; ?>" data-itemtype="specimen_qcd_by" href="javascript:;" class="item_delete">
                                            <i class="glyphicon glyphicon-remove pull-right" style="color: red;"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
											</div>
										</div>
									</div>
								</div>
							</div>
               <!-- Tabs-->
                
               
                
                
                    
               
                
                <div id="add_micro_codes" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Add Microscopic Information</h4>
                            </div>

                            <div class="modal-body">
                                <div class="display_msg"></div>
                                <form class="form" id="add_microscopic_codes_form">
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
               
                
               
                
                
            <div id="specimen_assisted_by" class="collapse">
                    <hr>
                <div class="col-md-4">
                        <form class="form speci_data_form">
                            <div class="form-group">
                                <label>Specimen Assisted By Name</label>
                                <input type="text" class="form-control" name="specimen_assisted_by">
                                <input type="hidden" name="specimen_type" value="assisted_by">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info save_speci_data_btn" type="button">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <strong>Specimen Assisted By Data</strong>
                        <?php if (!empty($specimen_assisted_by)) { ?>
                            <ul class="list-group">
                                <?php foreach ($specimen_assisted_by as $key => $value) { ?>
                                    <li class="list-group-item">
                                        <?php echo $value['spec_assis_by_name']; ?>
                                        <a data-itemid="<?php echo $value['spec_assis_by_id']; ?>" data-itemtype="specimen_assisted_by" href="javascript:;" class="item_delete">
                                            <i class="glyphicon glyphicon-remove pull-right" style="color: red;"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
                
               
               
               
            </div>
        </div>
    </div>
</div>