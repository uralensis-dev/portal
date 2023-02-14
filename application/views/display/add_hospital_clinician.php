<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
						<div class="col-md-8 offset-md-2">
						
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title">Add Hospital Clinic</h3>
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
                                </select>										</div>
									</div>
									
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
                                        <div class="row">

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
									</div>
									
									
									
								
								</div>
								
							
                                    
								
							
						</div>
					</div>