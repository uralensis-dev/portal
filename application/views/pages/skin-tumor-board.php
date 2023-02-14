<style type="text/css">
    .input-img{position: absolute; top: 0; height: 42px;}
</style>
<div class="content container-fluid">
                
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Skin Tumor Board <i class="fa fa-pencil-square-o" style="margin-left:10px;"></i></h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
                    <li class="breadcrumb-item">Vernova Healthcare</li>
                    <li class="breadcrumb-item active">Skin Tumor Board</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <div class="view-icons">
                    <!-- <a href="javascript:void(0);" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a> -->
                    <a href="javascript:void(0);" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa fa-calendar"></i></span>
                    <div class="dash-widget-info">
                        <h3>Every Monday</h3>
                        <span>First week each Month 2-4 PM</span>
                        <!-- <span>location </span> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url() ?>assets/icons/Hot-Reporting-blue.png" alt="">
                    </span>
                    <div class="dash-widget-info">
                        <h3>32</h3>
                        <span>Hot Reporting</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa fa-tasks"></i></span>
                    <div class="dash-widget-info">
                        <h3>37</h3>
                        <span>Tasks</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url() ?>assets/icons/Tumor.png" alt="">
                    </span>
                    <div class="dash-widget-info">
                        <h3>14</h3>
                        <span>Tumor Board Cases</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header text-center">
                    <h3 class="card-title mb-0">
                        <i class="fa fa-chevron-left"></i>
                        Tumor Board Dates
                        <i class="fa fa-chevron-right"></i>
                        <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#add_mdt">Add MDT</button>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="col-md-12 table-responsive" style="margin: 15px;">
		                <table class="table table-nowrap custom-table datatable mb-0">
		                    <thead class="bg-gray">
		                        <tr>
		                            <th>Serial No</th>
		                            <th>First Name	</th>
		                            <th>Sur Name</th>
		                            <th>EMIS No</th>
                                    <th>Date</th>
		                        </tr>
		                    </thead>
		                    <tbody>
                            <?php foreach($mdtdata as $row){ ?>
		                        <tr>
		                            
		                            <td><?php echo $row->serial_number?></td>
		                            <td><?php echo $row->f_name?></td>
		                            <td><?php echo $row->sur_name?></td>
		                            <td>
		                                <?php echo $row->emis_number?>
                                        <td><?php echo date("Y-m-d",strtotime($row->publish_datetime))?></td>
		                        </tr>
                                <?php } ?>
		                       
		                    </tbody>
		                </table>
		            </div>
                </div>

                <div class="card-footer">
                    <a href="#">Show All</a>
                </div>
                
            </div>
        </div>
        <div class="col-md-6 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header text-center">
                <div class="row">
                    <div class="col-md-3">
                        <div class="add-task-btn-wrapper">
                            <span class="add-task-btn btn btn-white btn-sm">
                                Add Task
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3 class="card-title mb-0">Outstanding Tasks</h3>
                    </div>
                    <div class="col-md-3">
                        <ul class="nav float-right custom-menu">
                            <li class="nav-item dropdown dropdown-action">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-cog"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void(0)">Pending Tasks</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Completed Tasks</a>
                                    <a class="dropdown-item" href="javascript:void(0)">All Tasks</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="task-wrapper">
                        <div class="task-list-container">
                            <div class="task-list-body">
                                <ul id="task-list">
                                    <li class="task">
                                        <div class="task-container">
                                            <span class="task-action-btn task-check">
                                                <span class="action-circle large complete-btn" title="Mark Complete">
                                                    <i class="material-icons">check</i>
                                                </span>
                                            </span>
                                            <span class="task-label" contenteditable="true">Patient appointment booking</span>
                                            <span class="task-action-btn task-btn-right">
                                                <span class="action-circle large" title="Assign">
                                                    <i class="material-icons">person_add</i>
                                                </span>
                                                <span class="action-circle large delete-btn" title="Delete Task">
                                                    <i class="material-icons">delete</i>
                                                </span>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="task">
                                        <div class="task-container">
                                            <span class="task-action-btn task-check">
                                                <span class="action-circle large complete-btn" title="Mark Complete">
                                                    <i class="material-icons">check</i>
                                                </span>
                                            </span>
                                            <span class="task-label" contenteditable="true">Appointment booking with payment gateway</span>
                                            <span class="task-action-btn task-btn-right">
                                                <span class="action-circle large" title="Assign">
                                                    <i class="material-icons">person_add</i>
                                                </span>
                                                <span class="action-circle large delete-btn" title="Delete Task">
                                                    <i class="material-icons">delete</i>
                                                </span>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="completed task">
                                        <div class="task-container">
                                            <span class="task-action-btn task-check">
                                                <span class="action-circle large complete-btn" title="Mark Complete">
                                                    <i class="material-icons">check</i>
                                                </span>
                                            </span>
                                            <span class="task-label">Doctor available module</span>
                                            <span class="task-action-btn task-btn-right">
                                                <span class="action-circle large" title="Assign">
                                                    <i class="material-icons">person_add</i>
                                                </span>
                                                <span class="action-circle large delete-btn" title="Delete Task">
                                                    <i class="material-icons">delete</i>
                                                </span>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="task">
                                        <div class="task-container">
                                            <span class="task-action-btn task-check">
                                                <span class="action-circle large complete-btn" title="Mark Complete">
                                                    <i class="material-icons">check</i>
                                                </span>
                                            </span>
                                            <span class="task-label" contenteditable="true">Patient and Doctor video conferencing</span>
                                            <span class="task-action-btn task-btn-right">
                                                <span class="action-circle large" title="Assign">
                                                    <i class="material-icons">person_add</i>
                                                </span>
                                                <span class="action-circle large delete-btn" title="Delete Task">
                                                    <i class="material-icons">delete</i>
                                                </span>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="task">
                                        <div class="task-container">
                                            <span class="task-action-btn task-check">
                                                <span class="action-circle large complete-btn" title="Mark Complete">
                                                    <i class="material-icons">check</i>
                                                </span>
                                            </span>
                                            <span class="task-label" contenteditable="true">Private chat module</span>
                                            <span class="task-action-btn task-btn-right">
                                                <span class="action-circle large" title="Assign">
                                                    <i class="material-icons">person_add</i>
                                                </span>
                                                <span class="action-circle large delete-btn" title="Delete Task">
                                                    <i class="material-icons">delete</i>
                                                </span>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="task">
                                        <div class="task-container">
                                            <span class="task-action-btn task-check">
                                                <span class="action-circle large complete-btn" title="Mark Complete">
                                                    <i class="material-icons">check</i>
                                                </span>
                                            </span>
                                            <span class="task-label" contenteditable="true">Patient Profile add</span>
                                            <span class="task-action-btn task-btn-right">
                                                <span class="action-circle large" title="Assign">
                                                    <i class="material-icons">person_add</i>
                                                </span>
                                                <span class="action-circle large delete-btn" title="Delete Task">
                                                    <i class="material-icons">delete</i>
                                                </span>
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="task-list-footer">
                                <div class="new-task-wrapper">
                                    <textarea id="new-task" placeholder="Enter new task here. . ."></textarea>
                                    <span class="error-message hidden">You need to enter a task first</span>
                                    <span class="add-new-task-btn btn" id="add-task">Add Task</span>
                                    <span class="btn" id="close-task-panel">Close</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="#" style="visibility:hidden;">View all payments</a>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-md-12">
            <div class="card-group m-b-30">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <span class="d-block">
                                    Coordinator
                                    <img src="<?php echo base_url('assets/img/avatar-16.jpg')?>" style="width:30px; border-radius:20px; margin-left:15px; margin-top:-5px;">
                                </span>
                            </div>
                            <div>
                                <span class="text-success">+10%</span>
                            </div>
                        </div>
                        <!-- <h3 class="mb-3">10</h3> -->
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mb-0">Attendance 12/35 Meeting</p>
                    </div>
                </div>
            
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <span class="d-block">
                                    Lead
                                    <img src="<?php echo base_url('assets/img/avatar-16.jpg')?>" style="width:30px; border-radius:20px; margin-left:15px; margin-top:-5px;">
                                </span>
                            </div>
                            <div>
                                <span class="text-success">+12.5%</span>
                            </div>
                        </div>
                        <!-- <h3 class="mb-3">$1,42,300</h3> -->
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mb-0">Attendance 12/35 Meeting</p>
                    </div>
                </div>
            
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <span class="d-block">
                                    Pathologist
                                    <img src="<?php echo base_url('assets/img/avatar-16.jpg')?>" style="width:30px; border-radius:20px; margin-left:15px; margin-top:-5px;">
                                </span>
                            </div>
                            <div>
                                <span class="text-danger">-2.8%</span>
                            </div>
                        </div>
                        <!-- <h3 class="mb-3">$8,500</h3> -->
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mb-0">Attendance 12/35 Meeting</p>
                    </div>
                </div>
            
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <span class="d-block">
                                    Nurse
                                    <img src="<?php echo base_url('assets/img/avatar-16.jpg')?>" style="width:30px; border-radius:20px; margin-left:15px; margin-top:-5px;">
                                </span>
                            </div>
                            <div>
                                <span class="text-danger">-75%</span>
                            </div>
                        </div>
                        <!-- <h3 class="mb-3">$1,12,000</h3> -->
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mb-0">Attendance 12/35 Meeting</p>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    
    
    
    <div class="row">
        <div class="col-md-6 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h3 class="card-title mb-0">
                        <span style="margin-right:20px;">Team Members</span>
                        <span>Past Team Members</span>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-19.jpg"></a>
                                            <a href="client-profile.html">Barry Cuda <span>CEO</span></a>
                                        </h2>
                                    </td>
                                    <td>barrycuda@example.com</td>
                                    <td>
                                        <div class="dropdown action-label">
                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o text-success"></i> Active
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-19.jpg"></a>
                                            <a href="client-profile.html">Tressa Wexler <span>Manager</span></a>
                                        </h2>
                                    </td>
                                    <td>tressawexler@example.com</td>
                                    <td>
                                        <div class="dropdown action-label">
                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o text-danger"></i> Inactive
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="client-profile.html" class="avatar"><img alt="" src="assets/img/profiles/avatar-07.jpg"></a>
                                            <a href="client-profile.html">Ruby Bartlett <span>CEO</span></a>
                                        </h2>
                                    </td>
                                    <td>rubybartlett@example.com</td>
                                    <td>
                                        <div class="dropdown action-label">
                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o text-danger"></i> Inactive
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="client-profile.html" class="avatar"><img alt="" src="assets/img/profiles/avatar-06.jpg"></a>
                                            <a href="client-profile.html"> Misty Tison <span>CEO</span></a>
                                        </h2>
                                    </td>
                                    <td>mistytison@example.com</td>
                                    <td>
                                        <div class="dropdown action-label">
                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o text-success"></i> Active
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="client-profile.html" class="avatar"><img alt="" src="assets/img/profiles/avatar-14.jpg"></a>
                                            <a href="client-profile.html"> Daniel Deacon <span>CEO</span></a>
                                        </h2>
                                    </td>
                                    <td>danieldeacon@example.com</td>
                                    <td>
                                        <div class="dropdown action-label">
                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o text-danger"></i> Inactive
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="clients.html">View all clients</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 d-flex">
            <div class="card card-table flex-fill bg-gray noborder">
                
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row mt-150">
                            <div class="col-md-6 form-group">
                                <input class="form-control input-lg bg-info input-qr" />
                                <img src="<?php echo base_url('assets/img/qr-code.png')?>" class="input-img" />
                            </div>
                            <div class="col-md-6 form-group">
                                <button class="btn btn-success btn-lg btn-block"> Search</button>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="form-focus">
                                    <input type="text" class="form-control datetimepicker floating">
                                    <label class="focus-label">From</label>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="form-focus">
                                    <input type="text" class="form-control datetimepicker floating">
                                    <label class="focus-label">To</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="card-footer">
                    <a href="projects.html">View all projects</a>
                </div> -->
            </div>
        </div>
    </div>

</div>
<!-- /Page Content -->


<div id="add_mdt" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add MDT</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 form-group">
						<label>Tumor Board</label>
						<input type="text" class="form-control">
					</div>
					<div class="col-md-12 form-group">
						<label>Date</label>
						<div class="cal-icon">
							<input class="form-control datetimepicker" type="text" name='project_start_date' required>
						</div>
					</div>
					<div class="col-md-12 form-group">
						<label>Location</label>
						<select class="form-control">
							<option>UK</option>
							<option>UK</option>
							<option>UK</option>
						</select>
					</div>
					<div class="col-md-12 form-group">
						<label>Cases</label>
						<input type="text" class="form-control">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="col-md-12"><button class="btn btn-primary btn-rounded">Add MDT</button></div>
			</div>
		</div>
	</div>
</div>
