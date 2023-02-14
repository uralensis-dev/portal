<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
						<div class="col-md-8 offset-md-2">
						
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title">Add Microscopic Codes</h3>
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
                                    <!--end of row-->
                    </div>
									
									
									
								
								</div>
								
							
                                    
								
							
						</div>
					</div>