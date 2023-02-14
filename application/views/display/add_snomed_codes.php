<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
						<div class="col-md-8 offset-md-2">
						
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title">Add Snomed Codes</h3>
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
                                    <!--end of row-->
                    </div>
									
									
									
								
								</div>
								
							
                                    
								
							
						</div>
					</div>