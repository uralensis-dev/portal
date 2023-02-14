<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
						<div class="col-md-8 offset-md-2">
						
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title">Add TAT Settings</h3>
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
                                    <!--end of row-->
                    </div>
									
									
									
								
								</div>
								
							
                                    
								
							
						</div>
					</div>