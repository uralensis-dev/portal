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
	</div>
</div>
<!-- /Page Header -->
<div class="row">
    <div class="col-md-12">
        <?php
        $attributes = array('id' => 'loginFilterForm');
        echo form_open(current_url(), $attributes);
        ?>
        <input type="hidden" name="filter_status" value="1">
        <div class="row">
            <div class="col-md-4">
                <label class="form-label">User</label>
                <select class="floating select2" name="timereport_users" id="timereport_users"
                        style="width: 100%">
                    <option value="">--Select--</option>
                    <?php
                    foreach ($usersData as $user) { ?>
                        <option value="<?php echo $user->id; ?>" title="<?php echo $user->profile_picture_path; ?>" <?php echo ($userFilter==$user->id?"selected":"")?>><?php echo $user->first_name . " " . $user->last_name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Searchable Date Range</label>
                <input class="form-control datepicker range2Picker" type="text" name="start_end_date"
                       id="start_end_date" value="<?php echo $date_filtered;?>" readonly/>
            </div>
            <div class="col-3 filter-row">
                <label class="form-label"></label>
                <button href="javascript:void(0);" type="submit" class="btn btn-success btn-block">Search</button>
            </div>
        </div>

        <?php echo form_close(); ?>
    </div>

</div>
<br/>
<br/>
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

<!-- Add Today Work Modal -->
<div id="add_todaywork" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Today Work details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
                <?php
                $attributes = array('id' => 'addTaskForm');
                echo form_open(current_url(), $attributes);
                ?>
<!--                <form>-->
					<div class="row">
						<div class="form-group col-sm-12">
							<label>Task <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="task_name" name="task_name">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							<label>Start Date & Time <span class="text-danger">*</span></label>
							<div class="cal-icon">
								<input class="form-control datepicker_new" type="text" id="start_date_time" name="start_date_time" readonly>
							</div>
						</div>
						<div class="form-group col-sm-6">
							<label>End Date & Time <span class="text-danger"></span></label>
							<input class="form-control datepicker_new" type="text" id="end_date_time" name="end_date_time" readonly>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							<label>Hours <span class="text-danger"></span></label>
							<input class="form-control" type="text" readonly>
						</div>
					</div>
					<div class="form-group">
						<label>Description <span class="text-danger">*</span></label>
						<textarea rows="4" class="form-control"></textarea>
					</div>
					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Submit</button>
					</div>
                <?php echo form_close()?>
			</div>
		</div>
	</div>
</div>
<!-- /Add Today Work Modal -->

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
<script>
    $(function() {
        var start = moment().subtract(6, 'days');
        var end = moment();

        <?php if($_SERVER['REQUEST_METHOD']=="POST"){
        $xpplodedDates = explode(" - ",$postDates);
        ?>
        var start = moment('<?php echo $xpplodedDates[0]?>');
        var end = moment('<?php echo $xpplodedDates[1]?>');
        <?php } ?>

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $('#reportranget').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('.range2Picker').daterangepicker({
            showDropdowns: true,
            locale: {
                format: 'DD-MM-YYYY'
            },
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

    });
</script>