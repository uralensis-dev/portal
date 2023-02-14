<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">User Groups and Categories</h3>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<?php if(!empty($this->session->flashdata('updateMessage'))){?>
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong></strong><?php 
							if(!empty($this->session->flashdata('updateMessage')))
							echo $this->session->flashdata('updateMessage');?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php } ?>
					
					<div class="row">
						<div class="col-sm-4 col-md-4 col-lg-4 col-xl-3">
							<a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_role"><i class="fa fa-plus"></i> Add institutes</a>
							
							<div class="roles-menu">
								<ul>
                                <?php foreach($groups as $rec){

                                    $getparent = getRecords("*","groups",array("id"=>$rec->parent_id));
                                   
                                   // echo $getparent[0]->name;
                                   if($getparent[0]->name!="")
                                   {
                                       $parentname = $getparent[0]->name .">";
                                   }else{
                                       $parentname = "";
                                   }
                                     $active="";
                                    if($rec->group_type=="A")
                                    {
                                        $active = "active";
                                    }
                                     ?>
									<li class="<?php echo $active?>">
										<a href="<?php echo base_url()?>admin/getsettings/<?php echo $rec->id?>"><?php echo $parentname."".$rec->name?>
											<span class="role-action">
												

												<span class="action-circle large delete-btn" data-toggle="modal" data-target="#delete_role">
													<i class="material-icons">delete</i>
												</span>
											</span>
										</a>
									</li>
                                    <?php } ?>
									
								</ul>
							</div>
						</div>

						<div class="col-sm-4 col-md-4 col-lg-4 col-xl-3">
							<a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_category"><i class="fa fa-plus"></i> Add Category</a>
							
							<div class="roles-menu">
								<ul>
                                <?php foreach($category as $rec){

                                    $getparent = getRecords("*","groups",array("id"=>$rec->parent_cate));
                                   
                                   // echo $getparent[0]->name;
                                   if(!empty($getparent) && $getparent[0]->name!="")
                                   {
                                       $parentname = $getparent[0]->name .">";
                                   }else{
                                       $parentname = "";
                                   }
                                     $active="";
                                    if($rec->group_type=="A")
                                    {
                                        $active = "active";
                                    }
                                     ?>
									<li class="<?php echo $active?>">
										<a href="javascript:void(0);"><?php echo $parentname."".$rec->name?>
											<span class="role-action">
												<span class="action-circle large" data-toggle="modal" data-target="#edit_category_<?php echo $rec->id?>">
													<i class="material-icons">edit</i>
												</span>
												<span class="action-circle large delete-btn" data-toggle="modal" data-target="#delete_category">
													<i class="material-icons">delete</i>
												</span>
											</span>
										</a>
									</li>
                                    <?php } ?>
									
								</ul>
							</div>
						</div>
						<div class="col-sm-8 col-md-8 col-lg-8 col-xl-9">
							<h6 class="card-title m-b-20">Module Access</h6>
							<div class="m-b-30">
								<ul class="list-group notification-list">
									<li class="list-group-item">
										Employee
										<div class="status-toggle">
											<input type="checkbox" id="staff_module" class="check">
											<label for="staff_module" class="checktoggle">checkbox</label>
										</div>
									</li>
									<li class="list-group-item">
										Holidays
										<div class="status-toggle">
											<input type="checkbox" id="holidays_module" class="check" checked>
											<label for="holidays_module" class="checktoggle">checkbox</label>
										</div>
									</li>
									<li class="list-group-item">
										Leaves
										<div class="status-toggle">
											<input type="checkbox" id="leave_module" class="check" checked>
											<label for="leave_module" class="checktoggle">checkbox</label>
										</div>
									</li>
									<li class="list-group-item">
										Events
										<div class="status-toggle">
											<input type="checkbox" id="events_module" class="check" checked>
											<label for="events_module" class="checktoggle">checkbox</label>
										</div>
									</li>
									<li class="list-group-item">
										Chat
										<div class="status-toggle">
											<input type="checkbox" id="chat_module" class="check" checked>
											<label for="chat_module" class="checktoggle">checkbox</label>
										</div>
									</li>
									<li class="list-group-item">
										Jobs
										<div class="status-toggle">
											<input type="checkbox" id="job_module" class="check">
											<label for="job_module" class="checktoggle">checkbox</label>
										</div>
									</li>
								</ul>
							</div>      	
							<div class="table-responsive">
								<table class="table table-striped custom-table">
									<thead>
										<tr>
											<th>Module Permission</th>
											<th class="text-center">Read</th>
											<th class="text-center">Write</th>
											<th class="text-center">Create</th>
											<th class="text-center">Delete</th>
											<th class="text-center">Import</th>
											<th class="text-center">Export</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Employee</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
										</tr>
										<tr>
											<td>Holidays</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
										</tr>
										<tr>
											<td>Leaves</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
										</tr>
										<tr>
											<td>Events</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
											<td class="text-center">
												<input type="checkbox" checked="">
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->


				<!-- Add Category-->
				<div id="add_category" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Group Category</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
									<?php echo form_open(current_url(), array('class' => 'tg-formtheme create_user_form')); ?>
									<div class="form-group">
										<label>Category Name <span class="text-danger">*</span></label>
										<input class="form-control" name="group_name" type="text">
									</div>
								
									
									<div class="form-group">
										<label>Parent Category <span class="text-danger">*</span></label>
										<select class="form-control" name="parent_id_cat">
										<?php $userCat = getRecords("*","groups",array("type_cate"=>"category")) ?>
										<option value="0">Select Category</option>
                                        <?php foreach($userCat as $rec2){ 
                                          
                                            ?>
                                            <option value="<?php echo $rec2->id?>"><?php echo $rec2->name?></option>
                                        <?php } ?>
                                        </select>
									</div>
									<input type="hidden" name="method" value="addcategory" />
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- Add Category -->
				
				<!-- Add Role Modal -->
				<div id="add_role" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add institute</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
									<?php echo form_open(current_url(), array('class' => 'tg-formtheme create_user_form')); ?>
									<div class="form-group">
										<label> Name <span class="text-danger">*</span></label>
										<input class="form-control" name="group_name" type="text">
									</div>
								
									<div class="form-group">
										<label>institute Name <span class="text-danger">*</span></label>
										<select class="form-control" name="parent_id">
										<option value="0">Select institute</option>
										
                                        <?php foreach($groups as $rec2){ 
                                          
                                            ?>
                                            <option value="<?php echo $rec2->id?>"><?php echo $rec2->name?></option>
                                        <?php } ?>
                                        </select>
									</div>
									
									<input type="hidden" name="method" value="addusergroup" />
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Role Modal -->



				<!-- Update Category-->
				 <?php foreach($category as $rec){
                     
					    $getcategory = getRecords("*","groups",array("id"=>$rec->parent_cate,"type_cate"=>"category"));
					  
                    ?>
				<div id="edit_category_<?php echo $rec->id?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Group Category</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
									<?php echo form_open(current_url(), array('class' => 'tg-formtheme create_user_form')); ?>
									<div class="form-group">
										<label>Category Name <span class="text-danger">*</span></label>
										<input class="form-control" name="group_name" type="text" value="<?php echo $rec->name?>">
									</div>
								
									
									<div class="form-group">
										<label>Parent Category <span class="text-danger">*</span></label>
										<select class="form-control" name="parent_id_cat">
										<?php $userCat = getRecords("*","groups",array("type_cate"=>"category")) ?>
										<option value="0">Select Category</option>
                                        <?php foreach($userCat as $rec2){ 
                                            $selected4 = "";
											echo $rec2->id."-".$getcategory[0]->id;
                                            if($rec2->id==$getcategory[0]->id)
                                            {
                                                $selected4 = "selected='selected'";
                                            }
                                          
                                            ?>
                                            <option value="<?php echo $rec2->id?>" <?php echo $selected4?>><?php echo $rec2->name?></option>
                                        <?php } ?>
                                        </select>
									</div>
									<input type="hidden" name="method" value="editcategory" />
										<input  name="group_id" value="<?php echo $rec->id?>" type="hidden">
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				<!-- update Category -->
				
				<!-- Edit Role Modal -->
                <?php foreach($groups as $rec){
                      $getparent = getRecords("*","groups",array("id"=>$rec->parent_id,"type_cate"=>"usergroup"));
					    $getcategory = getRecords("*","groups",array("id"=>$rec->parent_cate,"type_cate"=>"category"));
					  
                    ?>
				<div id="edit_role_<?php echo $rec->id?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content modal-md">
							<div class="modal-header">
								<h5 class="modal-title">Edit User Group</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<?php echo form_open(current_url(), array('class' => 'tg-formtheme create_user_form')); ?>
									<div class="form-group">
										<label>User Group Name <span class="text-danger">*</span></label>
										<input class="form-control" name="group_name" value="<?php echo $rec->name?>" type="text">
									</div>
									<div class="form-group">
										<label>Usergroup Initial(Must be Unique) <span class="text-danger">*</span></label>
										<input class="form-control" name="group_type" type="text" value="<?php echo $rec->group_type?>" readonly="readonly">
									</div
                                    <div class="form-group">
										<label>Parent Usergroup Name <span class="text-danger">*</span></label>
										<select class="form-control" name="parent_id">
										<option value="0">Select Parent</option>
                                        <?php foreach($groups as $rec2){ 
                                            $selected2 = "";
                                            if($rec2->id==$getparent[0]->id)
                                            {
                                                $selected2 = "selected='selected'";
                                            }
                                            ?>
                                            <option value="<?php echo $rec2->id?>" <?php echo $selected2?>><?php echo $rec2->name?></option>
                                        <?php } ?>
                                        </select>
									</div>
									<div class="form-group">
										<label>User Category <span class="text-danger">*</span></label>
										<select class="form-control" name="parent_id_cat">
										<?php $userCat = getRecords("*","groups",array("type_cate"=>"category")) ?>
										<option value="0">Select Category</option>
                                        <?php foreach($userCat as $rec2){ 

											  $selected3 = "";
                                            if($rec2->id==$getcategory[0]->id)
                                            {
                                                $selected3 = "selected='selected'";
                                            }
                                          
                                            ?>
                                            <option value="<?php echo $rec2->id?>" <?php echo $selected3?>><?php echo $rec2->name?></option>
                                        <?php } ?>
                                        </select>
									</div>
									<input type="hidden" name="method" value="updateusergroup" />
									<input  name="group_id" value="<?php echo $rec->id?>" type="hidden">
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
                <?php } ?>
				<!-- /Edit Role Modal -->

				<!-- Delete Role Modal -->
				<div class="modal custom-modal fade" id="delete_role" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Role</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
										</div>
										<div class="col-6">
											<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>


						<!-- Delete Role Modal -->
				<div class="modal custom-modal fade" id="delete_category" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Category</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
										</div>
										<div class="col-6">
											<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>