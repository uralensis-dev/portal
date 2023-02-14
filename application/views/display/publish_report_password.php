<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
						<div class="col-md-8 offset-md-2">
						
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title">Change Your Published Report Authorization Password</h3>
									</div>
								</div>
							</div>
							<!-- /Page Header -->
							
							
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label>Select hospital <span class="text-danger">*</span></label>
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
									</div>
									
								</div>
                                <!--start of row-->
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
                                    <!--end of row-->
                    </div>
									
									
									
								
								</div>
								
							
                                    
								
							
						</div>
					</div>