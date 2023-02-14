<!-- Page Content -->
<style>
    .no_after_dropdown .dropdown-toggle::after{display: none;}
</style>
			<!-- Page Header -->
<div class="page-header">
	<div class="row align-items-center">
		<div class="col">
			<h3 class="page-title">Admin Leaves</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Leaves</a></li>
				<li class="breadcrumb-item active">Admin Leaves</li>
			</ul>
		</div>
<!--		<div class="col-auto float-right ml-auto">-->
<!--			<a href="javascript:;" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Add Leave</a>-->
<!--		</div>-->
	</div>
</div>
<!-- /Page Header -->

<!-- Leave Statistics -->
<div class="row">
	<div class="col-md-3">
		<div class="stats-info">
			<h6>Today Presents</h6>
			<h4><?php echo $totalTodayPresents->totalUsers - $totalTodayPresents->absent_today; ?> / <?php echo $totalTodayPresents->totalUsers; ?></h4>
		</div>
	</div>
	<div class="col-md-3">
		<div class="stats-info">
			<h6>Planned Leaves</h6>
			<h4><?php echo $plannedCount; ?> </h4>
		</div>
	</div>
	<div class="col-md-3">
		<div class="stats-info">
			<h6>Unplanned Leaves</h6>
			<h4><?php echo $unPannedCount; ?> </h4>
		</div>
	</div>
	<div class="col-md-3">
		<div class="stats-info">
			<h6>Pending Requests</h6>
			<h4><?php echo $totalPendingCount; ?></h4>
		</div>
	</div>
</div>
<!-- /Leave Statistics -->

<!-- Search Filter -->
<?php
$attributes = array('id' => 'loginFilterForm');
echo form_open(current_url(), $attributes);
?>
<div class="row filter-row">
   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
		<div class="form-group form-focus">
			<input type="text" class="form-control floating" name="emp_name" value="<?php echo $emp_name;?>">
			<label class="focus-label">Employee Name</label>
		</div>
   </div>
   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
		<div class="form-group form-focus select-focus">
			<select class="select floating" name="leave_types">
                <option value=""> -- Select -- </option>
                <?php foreach ($leaveTypes as $leave){?>
                    <option value="<?php echo $leave->id;?>" <?php echo ($leave_types==$leave->id?"selected":"");?>><?php echo $leave->name;?></option>
                <?php }?>
			</select>
			<label class="focus-label">Leave Type</label>
		</div>
   </div>
   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12"> 
		<div class="form-group form-focus select-focus">
			<select class="select floating" name="leave_status">
				<option value=""> -- Select -- </option>
				<option value="0" <?php echo (($leave_status==0 && $leave_status!="")?"selected":"");?>> Pending </option>
				<option value="1" <?php echo ($leave_status==1?"selected":"");?>> Approved </option>
				<option value="2" <?php echo ($leave_status==2?"selected":"");?>> Rejected </option>
			</select>
			<label class="focus-label">Leave Status</label>
		</div>
   </div>
   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-4 col-12">
		<div class="form-group form-focus">
			<div class="cal-icon">
<!--				<input class="form-control floating datetimepicker" type="text">-->
                <input class="form-control datepicker range2Picker" type="text" name="start_end_date"
                       id="start_end_date" value="<?php echo $start_end_date;?>" readonly/>
			</div>
			<label class="focus-label">Dater Range</label>
		</div>
	</div>
<!--   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  -->
<!--		<div class="form-group form-focus">-->
<!--			<div class="cal-icon">-->
<!--				<input class="form-control floating datetimepicker" type="text">-->
<!--			</div>-->
<!--			<label class="focus-label">To</label>-->
<!--		</div>-->
<!--	</div>-->
   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
		<button href="javascript:;" class="btn btn-success btn-block" type="submit"> Search </button>
   </div>     
</div>
<?php echo form_close();?>
<!-- /Search Filter -->
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table id="leaves_datatable" class="table table-striped">
                <thead>
                <tr>
                    <th>User</th>
                    <th>Hospital Name</th>
                    <th>Leave Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Total Leaves</th>
                    <th>Status</th>
                    <th>Date Applied</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $leavesTotal = 0;
                foreach ($userAllLeaves as $userLeave) { ?>
                    <tr id="leave_tr_<?php echo $userLeave->id; ?>">
                        <td>
                            <h2 class="table-avatar">
                                <a href="#" class="avatar dashboard_admin">
                                    <img alt="" class="profile-pic"
                                         src="<?php echo get_profile_picture($userLeave->profile_picture_path, $userLeave->first_name, $userLeave->last_name); ?>"></a>
                                <a href="#client-profile"><?php echo  $userLeave->first_name." ".$userLeave->last_name; ?> <span><?php echo  $this->ion_auth->get_users_groups($userLeave->user_id)->row()->description; ?></span></a>
                            </h2>
                        </td>
                        <td><?php echo $userLeave->hospital_name; ?></td>
                        <td><?php echo $userLeave->name; ?></td>
                        <td><?php echo date("d-M-Y", strtotime($userLeave->start_date)); ?></td>
                        <td><?php echo date("d-M-Y", strtotime($userLeave->end_date)); ?></td>
                        <td class="text-center">
                            <a class="custom_badge_tat">
                                    <span class="badge bg-success"> <?php echo $userLeave->total_days;
                                        $leavesTotal = $leavesTotal + $userLeave->total_days; ?></span>
                            </a>
                        </td>
                        <td>
                            <?php
                            $status = $class = "";
                            if ($userLeave->status == 0) {
                                $status = "Pending";
                                $class = "warning";
                            } else if ($userLeave->status == 1) {
                                $status = "Approved ".($userLeave->approve_flag==1?"Up":"P");
                                $class = "success";
                            } else if ($userLeave->status == 2) {
                                $status = "Rejected";
                                $class = "danger";
                            }
                            ?>
                            <div class="dropdown action-label no_after_dropdown">
                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-dot-circle-o status-badge text-<?php echo $class;?>"></i> <span class="status-text"><?php echo $status; ?></span>
                                </a>
                            </div>
                        </td>
                        <td><?php echo date("d-M-Y h:i A", strtotime($userLeave->applied_date)); ?></td>
                        <td>
                            <?php if ($status == "Pending") { ?>
                                <div class="dropdown action-label action-btns">
                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-dot-circle-o text-warning"></i> Pending
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item pending-status" href="javascript:;" data-id="<?php echo $userLeave->id; ?>"
                                           data-status="approve" data-leave="0" data-toggle="modal" data-target="#approve_leave"><i class="fa fa-dot-circle-o text-success"></i> Approve P</a>
                                        <a class="dropdown-item pending-status" href="javascript:;" data-id="<?php echo $userLeave->id; ?>"
                                           data-status="approve" data-leave="1" data-toggle="modal" data-target="#approve_leave"><i class="fa fa-dot-circle-o text-success"></i> Approve UP</a>
                                        <a class="dropdown-item pending-status" data-id="<?php echo $userLeave->id; ?>"
                                           data-status="reject" href="javascript:;" data-toggle="modal" data-target="#delete_approve"><i class="fa fa-dot-circle-o text-danger"></i> Reject</a>
                                    </div>
                                </div>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /Page Content -->

<!-- Add Leave Modal -->
<div id="add_leave" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Leave</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label>Leave Type <span class="text-danger">*</span></label>
						<select class="select">
							<option>Select Leave Type</option>
							<option>Casual Leave 12 Days</option>
							<option>Medical Leave</option>
							<option>Loss of Pay</option>
						</select>
					</div>
					<div class="form-group">
						<label>From <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input class="form-control datetimepicker" type="text">
						</div>
					</div>
					<div class="form-group">
						<label>To <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input class="form-control datetimepicker" type="text">
						</div>
					</div>
					<div class="form-group">
						<label>Number of days <span class="text-danger">*</span></label>
						<input class="form-control" readonly type="text">
					</div>
					<div class="form-group">
						<label>Remaining Leaves <span class="text-danger">*</span></label>
						<input class="form-control" readonly value="12" type="text">
					</div>
					<div class="form-group">
						<label>Leave Reason <span class="text-danger">*</span></label>
						<textarea rows="4" class="form-control"></textarea>
					</div>
					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Add Leave Modal -->

<!-- Edit Leave Modal -->
<div id="edit_leave" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Leave</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label>Leave Type <span class="text-danger">*</span></label>
						<select class="select">
							<option>Select Leave Type</option>
							<option>Casual Leave 12 Days</option>
						</select>
					</div>
					<div class="form-group">
						<label>From <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input class="form-control datetimepicker" value="01-03-2020" type="text">
						</div>
					</div>
					<div class="form-group">
						<label>To <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input class="form-control datetimepicker" value="01-03-2020" type="text">
						</div>
					</div>
					<div class="form-group">
						<label>Number of days <span class="text-danger">*</span></label>
						<input class="form-control" readonly type="text" value="2">
					</div>
					<div class="form-group">
						<label>Remaining Leaves <span class="text-danger">*</span></label>
						<input class="form-control" readonly value="12" type="text">
					</div>
					<div class="form-group">
						<label>Leave Reason <span class="text-danger">*</span></label>
						<textarea rows="4" class="form-control">Going to hospital</textarea>
					</div>
					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Edit Leave Modal -->

<!-- Approve Leave Modal -->
<div class="modal custom-modal fade" id="approve_leave" role="dialog">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<div class="form-header">
					<h3>Leave Approve</h3>
					<p>Are you sure want to approve for this leave?</p>
				</div>
				<div class="modal-btn delete-action">
					<div class="row">
						<div class="col-6">
							<a href="javascript:void(0);" class="btn btn-primary btn-approve continue-btn" data-leave="" data-id="" data-status="">Approve</a>
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
<!-- /Approve Leave Modal -->

<!-- Delete Leave Modal -->
<div class="modal custom-modal fade" id="delete_approve" role="dialog">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<div class="form-header">
					<h3>Leave Reject</h3>
					<p>Are you sure want to reject this leave?</p>
				</div>
				<div class="modal-btn delete-action">
					<div class="row">
						<div class="col-6">
							<a href="javascript:void(0);" class="btn btn-primary btn-reject continue-btn" data-leave="" data-id="" data-status="">Reject</a>
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
		<!-- /Delete Leave Modal -->