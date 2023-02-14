<!-- Page Header -->
<div class="page-header">
	<div class="row align-items-center">
		<div class="col">
			<h3 class="page-title">Timesheet</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
				<li class="breadcrumb-item active">Timesheet</li>
			</ul>
		</div>
		<div class="col-auto float-right ml-auto">
<!--			<a href="#" class="btn add-btn btn-rounded" data-toggle="modal" data-target="#add_todaywork"><i class="fa fa-plus"></i> Add Today Work</a>-->
			<?php if($end_time_status==0){?>
                <a href="javascript:;" id="start_time_btn" class="btn add-btn btn-rounded"><i class="fa fa-clock-o"></i> Start Time</a>
            <?php } else {?>
                <a href="javascript:;" id="end_time_btnss" data-toggle="modal" data-target="#addTodayWorkModal" class="btn add-btn btn-rounded"><i class="fa fa-clock-o"></i> Stop Time</a>
            <?php } ?>
		</div>
	</div>
</div>
<!-- /Page Header -->

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table mb-0 datatable">
				<thead>
					<tr>
						<th>Employee</th>
						<th>Date</th>
						<th>Duration (Hour)</th>
						<th>Total Task</th>
						<th class="text-right">Actions</th>
					</tr>
				</thead>
				<tbody>
                <?php foreach ($userTimeSheetData as $uDetail){?>
					<tr>
                        <td>
                            <h2 class="table-avatar">
                                <a href="javascript:;" class="avatar dashboard_admin" style="pointer-events: none">
                                    <img alt="" class="profile-pic"
                                         src="<?php echo get_profile_picture($uDetail->profile_picture_path, $uDetail->first_name, $uDetail->last_name); ?>"></a>
                                <a href="javascript:;" style="pointer-events: none"><?php echo $uDetail->first_name." ".$uDetail->last_name; ?>
                                    <span><?php echo $this->ion_auth->get_users_groups($uDetail->user_id)->row()->description; ?></span></a>
                            </h2>
                        </td>
                        <td><?php echo date("Y-m-d",strtotime($uDetail->task_date))?></td>
                        <td><?php echo $uDetail->total_duration?></td>
                        <td><?php echo $uDetail->total_task ?></td>
						<td class="text-right">
                            <div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="<?php echo base_url()?>timesheet/timeDetail/<?php echo base64_encode($uDetail->user_id."__".$uDetail->task_date); ?>"><i class="la la-eye m-r-5"></i>Detail</a>
<!--									<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_workdetail"><i class="fa fa-trash-o m-r-5"></i> Delete</a>-->
								</div>
							</div>
						</td>
					</tr>
                <?php }?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<div id="add_task_detail" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Work Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $attributes = array('id' => 'addTaskDetailForm');
                echo form_open(current_url(), $attributes);
                ?>
                <input type="hidden" name="timesheet_id" id="timesheet_id">
                <!--                <form>-->
                <div class="form-group">
                    <label>Description <span class="text-danger">*</span></label>
                    <textarea rows="4" name="task_detail" id="task_detail" class="form-control"></textarea>
                </div>
                <div class="submit-section">
                    <button class="btn btn-primary submit-btn">Submit</button>
                </div>
                <?php echo form_close()?>
            </div>
        </div>
    </div>
</div>

<!-- Edit Today Work Modal -->
<div id="edit_todaywork" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Work Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="row">
						<div class="form-group col-sm-6">
							<label>Project <span class="text-danger">*</span></label>
							<select class="select">
								<option>Office Management</option>
								<option>Project Management</option>
								<option>Video Calling App</option>
								<option>Hospital Administration</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-4">
							<label>Deadline <span class="text-danger">*</span></label>
							<div class="cal-icon">
								<input class="form-control" type="text" value="5 May 2019" readonly>
							</div>
						</div>
						<div class="form-group col-sm-4">
							<label>Total Hours <span class="text-danger">*</span></label>
							<input class="form-control" type="text" value="100" readonly>
						</div>
						<div class="form-group col-sm-4">
							<label>Remaining Hours <span class="text-danger">*</span></label>
							<input class="form-control" type="text" value="60" readonly>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							<label>Date <span class="text-danger">*</span></label>
							<div class="cal-icon">
								<input class="form-control datetimepicker" value="03/03/2019" type="text">
							</div>
						</div>
						<div class="form-group col-sm-6">
							<label>Hours <span class="text-danger">*</span></label>
							<input class="form-control" type="text" value="9">
						</div>
					</div>
					<div class="form-group">
						<label>Description <span class="text-danger">*</span></label>
						<textarea rows="4" class="form-control">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel elit neque.</textarea>
					</div>
					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Edit Today Work Modal -->

<!-- Delete Today Work Modal -->
<div class="modal custom-modal fade" id="delete_workdetail" role="dialog">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<div class="form-header">
					<h3>Delete Work Details</h3>
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
</div>
<!-- Delete Today Work Modal -->

<?php //$this->load->view("timesheet/end_time_modal");?>