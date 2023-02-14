<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
						<div class="col-md-8 offset-md-2">
						
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title">Specimen Accepted By</h3>
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
                                    <!--end of row-->
                    </div>
									
									
									
								
								</div>
								
							
                                    
								
							
						</div>
					</div>