<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
						<div class="col-md-8 offset-md-2">
						
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title">Add Secretary</h3>
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
                                    <!--end of row-->
                    </div>
									
									
									
								
								</div>
								
							
                                    
								
							
						</div>
					</div>