<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
						<div class="col-md-8 offset-md-2">
						
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title">Add Dermatological Surgeon</h3>
									</div>
								</div>
							</div>
							<!-- /Page Header -->
							<?php
                            $attributes = array('id'=>'assign_dermatological_surgeon','class' => 'form');
                                echo form_open("", $attributes);
                                ?>
							
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
								<div class="row">
                        <div class="col-md-4">
                            <div class="dermatological_msg"></div>
                            
                           <!-- <form class="form" id="assign_dermatological_surgeon">-->
                               
                                <div class="form-group">
                                    <label for="hospital_name">Clinician</label>
                                    <select class="form-control" name="clinician_id" id="clinician_id">
                                        <option value="false">Choose Clinican</option>
                                        <?php
                                        if (!empty($clinican)) {
                                            foreach ($clinican as $hospitals) {

                                                $nameClinician = $hospitals->first_name .' '.$hospitals->last_name ;
                                                echo '<option value="' . $nameClinician . '">' . $hospitals->first_name .' '.$hospitals->last_name . '</option> ';
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
                       
                    </div>
									
									
									
								
								</div>
								
							
                                    
								
							
						</div>
					</div>