<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
						<div class="col-md-8 offset-md-2">
						
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title">Add Lab Names</h3>
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
                                    <!--end of row-->
                    </div>
									
									
									
								
								</div>
								
							
                                    
								
							
						</div>
					</div>