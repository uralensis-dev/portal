<!-- Page Header -->
<style type="text/css">
	.card{
		min-height: 485px;
	}
</style>
<div class="page-header">
	<div class="row align-items-center">
		<div class="col">
			<h3 class="page-title">Projects</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
				<li class="breadcrumb-item active">Projects</li>
			</ul>
		</div>
		<div class="col-auto float-right ml-auto">
			<a href="javascript:;" class="btn add-btn" data-toggle="modal" data-target="#create_project"><i class="fa fa-plus"></i> Create Project</a>
			<!-- <div class="view-icons">
				<a href="projects.html" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
				<a href="project-list.html" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
			</div> -->
		</div>
	</div>
</div>
<!-- /Page Header -->

<!-- Search Filter -->
<form action="<?php echo site_url('project/dashboard/');?>" method="GET" accept-charset="utf-8">
<div class="row filter-row">
	<div class="col-sm-6 col-md-3">  
		<div class="form-group form-focus">
			<input type="text" class="form-control floating" name='project_name_srch'>
			<label class="focus-label">Project Name</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3"> 
		<div class="form-group form-focus select-focus">
			<select class="select floating"  name='project_users_srch'>
				<option>Select User</option>
				<?php foreach($userList as $users):?>
					<option value='<?php echo $users['user_id'];?>'><?php echo $users['enc_first_name']." ".$users['enc_last_name']?></option>
				<?php endforeach;?>
			</select>
			<label class="focus-label">Users</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3"> 
		<div class="form-group form-focus select-focus">
			<select class="select floating"  name='project_priority_srch'> 
				<option>Select Priority</option>
				<option value='Low'>Low</option>
				<option value='Medium'>Medium</option>
				<option value='High'>High</option>

			</select>
			<label class="focus-label">Priority</label>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">  
		<button type='submit' class="btn btn-success btn-block"> Search </button>  
	</div>     
</div>
</form>
<!-- Search Filter -->

<?php 
    if($this->session->flashdata('inserted') === true){
		$type = $this->session->flashdata('type');
		if(!isset($type) && $type ==''){
			$type  = "success";
		}
        ?>
        <div class="row">

            <div class="col-lg-12">

                <div class="alert alert-<?php echo $type;?> alert-dismissible" role="alert">
                    <strong><?php echo $this->session->flashdata('tckSuccessMsg');?></strong>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
                </div>
            </div>
        </div>
        <?php
    }
?>
<div class="row">
	<?php foreach($projectList as $project):?>
	
	<div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
		<div class="card">
			<div class="card-body">
				<div class="dropdown dropdown-action profile-action">
					<a href="javascript:;" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="javascript:;" data-toggle="modal" data-target="#edit_project" data-project='<?php echo $project['project_id'];?>'><i class="fa fa-pencil m-r-5"></i> Edit</a>
						<a class="dropdown-item" onclick="javascript:strartDelete(this);" data-toggle="modal" data-target="#delete_project" data-project='<?php echo $project['project_id'];?>'><i class="fa fa-trash-o m-r-5"></i> Delete</a>
					</div>
				</div>
				<h4 class="project-title"><a href="project-view.html"><?php echo $project['project_name'];?></a></h4>
				<?php // TODO : ADD NUMBER OF TASKS HERE AFTER TASKS ARE CREATED?>
				<small class="block text-ellipsis m-b-15">
					<span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
					<span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
				</small>
				<p class="text-muted" style="min-height: 80px"><?php echo $project['project_desc'];?>
				</p>
				<div class="pro-deadline m-b-15">
					<div class="sub-title">
						Deadline:
					</div>
					<div class="text-muted">
					<?php echo date("d M Y",strtotime($project['project_end_date']))?>
					</div>
				</div>
				<div class="project-members m-b-15">
					<div>Project Leader :</div>
					<ul class="team-members">
					<?php $projectLeads = $this->projects->getUserDetails($project['project_lead']);
						if(!empty($projectLeads)):
							$counter = 1;?>
							<?php foreach($projectLeads as $lead):?>
									<li><a href="javascript:void();" data-toggle="tooltip" data-placement="bottom" title="" class="avatar" data-original-title="<?php echo $lead['enc_first_name'].' '. $lead['enc_last_name']?>">
									<?php // TODO : ADD PROFILE IMAGES OF THE USERS?>
									<img alt="" src="<?php if (empty($users['profile_picture_path'])) echo base_url('assets/img/dummy-doctors.jpg'); else echo $users['profile_picture_path'] ?>"></a></li>
							<?php endforeach;?>
						<?php else:?>
							<?php echo "<li><span class='badge badge-danger'>Un-Assigned</span></li>";?>
						<?php endif;?>
					</ul>




					
						<!-- <ul class="team-members">
							<li>
								<a href="javascript:;" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="<?php echo base_url() ?>assets/img/dummy-doctors.jpg"></a>
							</li>
						</ul> -->
				</div>
				<div class="project-members m-b-15">
					<div>Team :</div>
					<ul class="team-members">
					<?php $temMembers = $this->projects->getUserDetails(@explode(",",$project['project_team']));
						if(!empty($temMembers)):
							$counter = 1;?>
							<?php foreach($temMembers as $lead):?>
									<li><a href="javascript:void();" data-toggle="tooltip" data-placement="bottom" title="" class="avatar" data-original-title="<?php echo $lead['enc_first_name'].' '. $lead['enc_last_name']?>">
									<img alt="" src="<?php if (empty($users['profile_picture_path'])) echo base_url('assets/img/dummy-doctors.jpg'); else echo $users['profile_picture_path'] ?>"></a></li></a></li>
							<?php endforeach;?>
						<?php else:?>
							<?php echo "<li><span class='badge badge-danger'>Un-Assigned</span></li>";?>
						<?php endif;?>
					</ul>
					<!-- <ul class="team-members">
						<li>
							<a href="javascript:;" data-toggle="tooltip" title="John Doe"><img alt="" src="<?php echo base_url() ?>assets/img/dummy-doctors.jpg"></a>
						</li>
						<li>
							<a href="javascript:;" data-toggle="tooltip" title="Richard Miles"><img alt="" src="<?php echo base_url() ?>assets/img/dummy-doctors.jpg"></a></a>
						</li>
						<li>
							<a href="javascript:;" data-toggle="tooltip" title="John Smith"><img alt="" src="<?php echo base_url() ?>assets/img/dummy-doctors.jpg"></a>
						</li>
						<li>
							<a href="javascript:;" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="<?php echo base_url() ?>assets/img/dummy-doctors.jpg"></a>
						</li>
						<li class="dropdown avatar-dropdown">
							<a href="javascript:;" class="all-users dropdown-toggle" data-toggle="dropdown" aria-expanded="false">+15</a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="avatar-group">
									<a class="avatar avatar-xs" href="javascript:;">
										<img alt="" src="<?php echo base_url() ?>assets/img/dummy-doctors.jpg">
									</a>
									<a class="avatar avatar-xs" href="javascript:;">
										<img alt="" src="<?php echo base_url() ?>assets/img/dummy-doctors.jpg">
									</a>
									<a class="avatar avatar-xs" href="javascript:;">
										<img alt="" src="<?php echo base_url() ?>assets/img/dummy-doctors.jpg">
									</a>
									<a class="avatar avatar-xs" href="javascript:;">
										<img alt="" src="<?php echo base_url() ?>assets/img/dummy-doctors.jpg">
									</a>
									<a class="avatar avatar-xs" href="javascript:;">
										<img alt="" src="<?php echo base_url() ?>assets/img/dummy-doctors.jpg">
									</a>
									<a class="avatar avatar-xs" href="javascript:;">
										<img alt="" src="<?php echo base_url() ?>assets/img/dummy-doctors.jpg">
									</a>
									<a class="avatar avatar-xs" href="javascript:;">
										<img alt="" src="<?php echo base_url() ?>assets/img/dummy-doctors.jpg">
									</a>
									<a class="avatar avatar-xs" href="javascript:;">
										<img alt="" src="<?php echo base_url() ?>assets/img/dummy-doctors.jpg">
									</a>
									<a class="avatar avatar-xs" href="javascript:;">
										<img alt="" src="<?php echo base_url() ?>assets/img/dummy-doctors.jpg">
									</a>
								</div>
								<div class="avatar-pagination">
									<ul class="pagination">
										<li class="page-item">
											<a class="page-link" href="javascript:;" aria-label="Previous">
												<span aria-hidden="true">«</span>
												<span class="sr-only">Previous</span>
											</a>
										</li>
										<li class="page-item"><a class="page-link" href="javascript:;">1</a></li>
										<li class="page-item"><a class="page-link" href="javascript:;">2</a></li>
										<li class="page-item">
											<a class="page-link" href="javascript:;" aria-label="Next">
												<span aria-hidden="true">»</span>
											<span class="sr-only">Next</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</li>
					</ul> -->
				</div>
				<?php // TODO : ADD PROGRESS AFTER TASKS MODULE?>
				<p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
				<div class="progress progress-xs mb-0">
					<div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="40%" style="width: 40%"></div>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach;?>
</div>

<!-- Create Project Modal -->
<div id="create_project" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Create Project</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php
				$attributes = array('method' => 'POST','enctype'=>"multipart/form-data" ,"id"=>'cst-project-form');
				echo form_open("project/saveData/", $attributes);
				?>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Project Name</label>
								<input class="form-control" type="text" name='project_name' required>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Client</label>
									<?php if(count($clientList) == 1):?>										
										<select class="select" name='client_id' id='client_id' required>
										<option value=''>Select Client</option>
										<option value='<?php echo $clientList[0]['client_id'];?>'><?php echo $clientList[0]['client_name'];?></option>
									<?php else:?>
										<select class="select" name='client_id' id='client_id' required>
										<option value=''>Select Client</option>
										<?php foreach($clientList as $clients):?>
										<option value='<?php echo $clients['client_id'];?>'><?php echo $clients['client_name'];?></option>
										<?php endforeach;?>
									<?php endif;?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Start Date</label>
								<div class="cal-icon">
									<input class="form-control datetimepicker" type="text" name='project_start_date' required>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>End Date</label>
								<div class="cal-icon">
									<input class="form-control datetimepicker" type="text" name='project_end_date' required>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<div class="form-group">
								<label>Rate</label>
								<input placeholder="$50" class="form-control" type="text" name='project_rate' required>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label>&nbsp;</label>
								<select class="select" name='project_rate_type' required>
									<option value='Hourly'>Hourly</option>
									<option value='Fixed'>Fixed</option>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Priority</label>
								<select class="select" name='project_piority' required>
									<option value='High'>High</option>
									<option value='Medium'>Medium</option>
									<option value='Low'>Low</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Add Project Leader</label>
								<select class="form-control select-adv" type="text" name='project_lead' id='project_lead' required>
									<option value=''>Select Project Leader</option>
									<?php /*foreach($userList as $users):?>
									<option value='<?php echo $users['user_id'];?>'><?php echo $users['enc_first_name']." ".$users['enc_last_name']?></option>
									<?php endforeach;*/?>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Add Project Team</label>
								<select class="form-control select-adv" type="text" name='project_team[]' id='project_team' multiple required>
									<?php /*foreach($userList as $users):?>
									<option value='<?php echo $users['user_id'];?>'><?php echo $users['enc_first_name']." ".$users['enc_last_name']?></option>
									<?php endforeach;*/?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea rows="4" class="form-control summernote" placeholder="Enter your message here"  name='project_desc' required></textarea>
					</div>
					<div class="form-group">
						<label>Upload Files</label>
						<input class="form-control" type="file" name='project_attachments[]' multiple='multiple'>
					</div>
					<div class="submit-section">
						<button type='submit' class="btn btn-primary submit-btn" id='cst-add-form-btn'>Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Create Project Modal -->

<!-- Edit Project Modal -->
<div id="edit_project" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Project</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id='projLoader' class="modal-body text-center"><i class='fa fa-spinner fa-spin fa-3x'></i></div>
			<div id='projData' class="modal-body" style="display: none;">
					<?php
					$attributes = array('method' => 'POST','enctype'=>"multipart/form-data","id"=>'cst-project-form-edt');
					echo form_open("project/saveData/", $attributes);
					?>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Project Name</label>
								<input class="form-control" type="text" name='project_name'>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
							<label>Client</label>
									<?php if(count($clientList) == 1):?>										
										<select class="select" name='client_id' id='client_id_etd'>
										<option value=''>Select Client</option>
										<option value='<?php echo $clientList[0]['client_id'];?>'><?php echo $clientList[0]['client_name'];?></option>
									<?php else:?>
										<select class="select" name='client_id' id='client_id_etd'>
										<option value=''>Select Client</option>
										<?php foreach($clientList as $clients):?>
										<option value='<?php echo $clients['client_id'];?>'><?php echo $clients['client_name'];?></option>
										<?php endforeach;?>
									<?php endif;?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Start Date</label>
								<div class="cal-icon">
									<input class="form-control datetimepicker" type="text" name='project_start_date'>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>End Date</label>
								<div class="cal-icon">
									<input class="form-control datetimepicker" type="text" name='project_end_date'>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<div class="form-group">
								<label>Rate</label>
								<input placeholder="$50" class="form-control" type="text" name='project_rate'>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label>&nbsp;</label>
								<select class="form-control" name='project_rate_type' id='project_rate_type'>>
									<option value='Hourly'>Hourly</option>
									<option value='Fixed'>Fixed</option>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Priority</label>
								<select class="select" name='project_piority' id='project_piority_edt'>
									<option value='High'>High</option>
									<option value='Medium'>Medium</option>
									<option value='Low'>Low</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Project Leader</label>
								<select class="form-control select-adv" type="text" name='project_lead' id='edt_project_lead'>
									<option value=''>Select Project Leader</option>
									<?php foreach($userList as $users):?>
									<option value='<?php echo $users['user_id'];?>'><?php echo $users['enc_first_name']." ".$users['enc_last_name']?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Project Team</label>
								<select class="form-control select-adv" type="text" name='project_team[]' multiple id='edt_project_teams'>
									<?php foreach($userList as $users):?>
									<option value='<?php echo $users['user_id'];?>'><?php echo $users['enc_first_name']." ".$users['enc_last_name']?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea rows="4" class="form-control summernote" placeholder="Enter your message here"  name='project_desc' ></textarea>
					</div>
					<div class="form-group">
						<label>Upload Files</label>
						<input class="form-control" type="file" name='project_attachments[]' multiple='multiple'>
					</div>
					<div class="form-group">
						<label>Uploaded Files</label>
						<table class='table' id='fileList'>
							<tr class='text-center'><td>No Files Attached</td></tr>
						</table>
					</div>
					<div class="submit-section">
						<button type='submit' class="btn btn-primary submit-btn" id='cst-update-form-btn'>Submit</button>
					</div>
					<input type='hidden' name='project_id' value=''>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Edit Project Modal -->

<!-- Delete Project Modal -->
<div class="modal custom-modal fade" id="delete_project" role="dialog">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<div class="form-header">
					<h3>Delete Project</h3>
					<p>Are you sure want to delete? <br> All taks in the Project will be Removed as well.</p>
				</div>
				<div class="modal-btn delete-action">
					<div class="row">
						<div class="col-6">
							<?php
							$attributes = array('method' => 'POST','id'=>"deleteProject");
							echo form_open("project/removeProject/", $attributes);
							?>
							<input type='hidden' id='project_id' name='project_id' value=''/>
							<a href="javascript:void();" class="btn btn-primary continue-btn" id='cnfrmDelete'>Delete</a>
							</form>
						</div>
						<div class="col-6">
							<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /Delete Project Modal -->