<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-lg-6 col-sm-12">
                <h3 class="page-title">Tumor Board</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
                    <li class="breadcrumb-item active">Vernova Healthcare</li>
                </ul>
            </div>
            <div class="col-lg-6 col-sm-12 float-right ml-md-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#create_new_board"><i class="fa fa-plus"></i> Create New Board</a>
                <div class="view-icons">
                    <a href="javascript:;" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                    <a href="javascript:;" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-md-12 form-group">
            <h3>My Tumor Board</h3>
        </div>
    </div>
    <!-- Search Filter -->
    <div class="row filter-row">
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <input type="text" class="form-control floating">
                <label class="focus-label">Tumor Board Name</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <input type="text" class="form-control floating">
                <label class="focus-label">Tumor Member Search</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus select-focus">
                <select class="select floating">
                    <option>Select Roll</option>
                    <option>Cancer Coordinator</option>
                    <option>TB Lead</option>
                    <option>Cancer Nurse Specialist</option>
                    <option>Pathologist</option>
                    <option>Other</option>
                </select>
                <label class="focus-label">Designation</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <a href="#" class="btn btn-success btn-block"> Search </a>
        </div>
    </div>
    <!-- Search Filter -->
    <div class="row">
        <?php foreach ($meetings as $meeting): ?>
            <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown dropdown-action profile-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="<?php echo site_url('SkinTumorBoard'); ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                            </div>
                        </div>
                        <h4 class="project-title"><a href="#l"><?php echo $meeting->ura_mdt_list_name;?></a></h4>
                        <small class="block text-ellipsis m-b-15">
                            <span class="text-xs">0</span> <span class="text-muted">open tasks, </span>
                            <span class="text-xs">0</span> <span class="text-muted">tasks completed</span>
                        </small>
                        <p class="text-muted mdt_desc"><?php echo $meeting->ura_mdt_list_description;?></p>
                        <div class="pro-deadline m-b-15">
                            <div class="sub-title">
                                Created:
                            </div>
                            <div class="text-muted"><?php echo  date('d M Y',$meeting->ura_mdt_list_timestamp);?></div>
                        </div>
                        <div class="project-members m-b-15">
                            <div>Co-ordinator:</div>
                            <ul class="team-members">
                                <li>
                                    <a href="#" data-toggle="tooltip" title="" data-original-title="Jeffery Lalor"><img alt="" src="<?php echo base_url();?>assets/img/profiles/avatar-16.jpg"></a>
                                </li>
                            </ul>
                        </div>
                        <div class="project-members m-b-15">
                            <div>Team :</div>
                            <ul class="team-members">
                                <li>
                                    <a href="#" data-toggle="tooltip" title="" data-original-title="John Doe"><img alt="" src="<?php echo base_url();?>assets/img/profiles/avatar-05.jpg"></a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="tooltip" title="" data-original-title="Richard Miles"><img alt="" src="<?php echo base_url();?>assets/img/profiles/avatar-05.jpg"></a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="tooltip" title="" data-original-title="John Smith"><img alt="" src="<?php echo base_url();?>assets/img/profiles/avatar-05.jpg"></a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="tooltip" title="" data-original-title="Mike Litorus"><img alt="" src="<?php echo base_url();?>assets/img/profiles/avatar-05.jpg"></a>
                                </li>
                                <li class="dropdown avatar-dropdown">
                                    <a href="#" class="all-users dropdown-toggle" data-toggle="dropdown" aria-expanded="false">+15</a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="avatar-group">
                                            <a class="avatar avatar-xs" href="#">
                                                <img alt="" src="<?php echo base_url();?>assets/img/profiles/avatar-05.jpg">
                                            </a>
                                            <a class="avatar avatar-xs" href="#">
                                                <img alt="" src="<?php echo base_url();?>assets/img/profiles/avatar-05.jpg">
                                            </a>
                                            <a class="avatar avatar-xs" href="#">
                                                <img alt="" src="<?php echo base_url();?>assets/img/profiles/avatar-05.jpg">
                                            </a>
                                            <a class="avatar avatar-xs" href="#">
                                                <img alt="" src="<?php echo base_url();?>assets/img/profiles/avatar-05.jpg">
                                            </a>
                                            <a class="avatar avatar-xs" href="#">
                                                <img alt="" src="<?php echo base_url();?>assets/img/profiles/avatar-11.jpg">
                                            </a>
                                            <a class="avatar avatar-xs" href="#">
                                                <img alt="" src="<?php echo base_url();?>assets/img/profiles/avatar-12.jpg">
                                            </a>
                                            <a class="avatar avatar-xs" href="#">
                                                <img alt="" src="<?php echo base_url();?>assets/img/profiles/avatar-13.jpg">
                                            </a>
                                            <a class="avatar avatar-xs" href="#">
                                                <img alt="" src="<?php echo base_url();?>assets/img/profiles/avatar-01.jpg">
                                            </a>
                                            <a class="avatar avatar-xs" href="#">
                                                <img alt="" src="<?php echo base_url();?>assets/img/profiles/avatar-16.jpg">
                                            </a>
                                        </div>
                                        <div class="avatar-pagination">
                                            <ul class="pagination">
                                                <li class="page-item">
                                                    <a class="page-link" href="#" aria-label="Previous">
                                                        <span aria-hidden="true">«</span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                </li>
                                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#" aria-label="Next">
                                                        <span aria-hidden="true">»</span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <p class="m-b-5">Meeting Progress <span class="text-success float-right">60%</span></p>
                        <div class="progress progress-xs mb-0">
                            <div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="" style="width: 60%" data-original-title="60%"></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <div class="col-md-6 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header text-center">
                    <h3 class="card-title mb-0">
                        <i class="fa fa-chevron-left"></i>
                        Tumor Board Dates
                        <i class="fa fa-chevron-right"></i>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-nowrap custom-table mb-0">
                            <thead class="bg-gray">
                            <tr>
                                <th>Tumor Board</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th class="text-center">Cases</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Skin</td>
                                <td>11 Mar 2019</td>
                                <td>UK</td>
                                <td class="text-center">
                                    <a href="hospitals.html">14</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Skin</td>
                                <td>11 Mar 2019</td>
                                <td>UK</td>
                                <td class="text-center">
                                    <a href="hospitals.html">14</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Skin</td>
                                <td>11 Mar 2019</td>
                                <td>UK</td>
                                <td class="text-center">
                                    <a href="hospitals.html">14</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Skin</td>
                                <td>11 Mar 2019</td>
                                <td>UK</td>
                                <td class="text-center">
                                    <a href="hospitals.html">14</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="payments.html">Show All</a>
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
                                            <span contenteditable="true">
                                                        Skin Tumor Board
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
                                            <span contenteditable="true">
                                                        Skin Tumor Board
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
                                            <span contenteditable="true">
                                                        Skin Tumor Board
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
                                            <span contenteditable="true">
                                                        Skin Tumor Board
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
                                            <span contenteditable="true">
                                                        Skin Tumor Board
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
                                            <span contenteditable="true">
                                                        Skin Tumor Board
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
                    <a href="payments.html" style="visibility:hidden;">View all payments</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 alignRight">
            <div class="col-md-4 float-right">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating">
                    <label class="focus-label">Search Tumor Board</label>
                </div>
            </div>
            <div class="col-md-4 float-right text-right">
                <h3 style="margin-top: 10px">All Tumor Boards</h3>
            </div>
        </div>
        <div id="slider-2" class="carousel carousel-by-item slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown dropdown-action profile-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?php echo site_url('SkinTumorBoard'); ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                        <h4 class="project-title"><a href="project-view.html">Skin Tumor Board</a></h4>
                                        <small class="block text-ellipsis m-b-15">
                                            <span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
                                            <span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
                                        </small>
                                        <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. When an unknown printer took a galley of type and
                                            scrambled it...
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown dropdown-action profile-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_project"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                        <h4 class="project-title"><a href="project-view.html">Gl Tumor Board</a></h4>
                                        <small class="block text-ellipsis m-b-15">
                                            <span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
                                            <span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
                                        </small>
                                        <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. When an unknown printer took a galley of type and
                                            scrambled it...
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown dropdown-action profile-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_project"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                        <h4 class="project-title"><a href="project-view.html">Lymphoreticular Tumor Board</a></h4>
                                        <small class="block text-ellipsis m-b-15">
                                            <span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
                                            <span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
                                        </small>
                                        <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. When an unknown printer took a galley of type and
                                            scrambled it...
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown dropdown-action profile-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_project"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                        <h4 class="project-title"><a href="project-view.html">Lung Tumor Board</a></h4>
                                        <small class="block text-ellipsis m-b-15">
                                            <span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
                                            <span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
                                        </small>
                                        <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. When an unknown printer took a galley of type and
                                            scrambled it...
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown dropdown-action profile-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?php echo base_url('index.php/SkinTumorBoard'); ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                        <h4 class="project-title"><a href="project-view.html">Skin Tumor Board</a></h4>
                                        <small class="block text-ellipsis m-b-15">
                                            <span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
                                            <span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
                                        </small>
                                        <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. When an unknown printer took a galley of type and
                                            scrambled it...
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown dropdown-action profile-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_project"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                        <h4 class="project-title"><a href="project-view.html">Gl Tumor Board</a></h4>
                                        <small class="block text-ellipsis m-b-15">
                                            <span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
                                            <span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
                                        </small>
                                        <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. When an unknown printer took a galley of type and
                                            scrambled it...
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown dropdown-action profile-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_project"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                        <h4 class="project-title"><a href="project-view.html">Lymphoreticular Tumor Board</a></h4>
                                        <small class="block text-ellipsis m-b-15">
                                            <span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
                                            <span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
                                        </small>
                                        <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. When an unknown printer took a galley of type and
                                            scrambled it...
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown dropdown-action profile-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_project"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                        <h4 class="project-title"><a href="project-view.html">Lung Tumor Board</a></h4>
                                        <small class="block text-ellipsis m-b-15">
                                            <span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
                                            <span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
                                        </small>
                                        <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. When an unknown printer took a galley of type and
                                            scrambled it...
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#slider-2" role="button" data-slide="prev">
                <span class="fa fa-chevron-left fa-2x" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#slider-2" role="button" data-slide="next">
                <span class="fa fa-chevron-right fa-2x" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <!--<div id="create_new_board" class="modal custom-modal fade show" role="dialog">-->
    <div id="create_new_board" class="modal custom-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Tumor Board Meeting</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo  form_open(site_url('/tumorBoard/create_meeting/')); ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tumor Board Name</label>
                                <input required name="name" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Location</label>
                                <select required name="hospital_id" class="select">
                                    <?php foreach ($hospitals as $hospital): ?>
                                        <option value="<?php echo  $hospital->id; ?>"><?php echo  $hospital->description; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Meeting Date</label>
                                <div class="cal-icon">
                                    <input required name="date" class="form-control datetimepicker" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>From</label>
                                <input required name="from" placeholder="09:00 AM" class="form-control" type="time">
                            </div>
                        </div>
                        <!--                            <div class="col-sm-3">-->
                        <!--                                <div class="form-group">-->
                        <!--                                    <label>To</label>-->
                        <!--                                    <input name="to" placeholder="10:00 AM" class="form-control" type="text">-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                            <div class="col-sm-6">-->
                        <!--                                <div class="form-group">-->
                        <!--                                    <label>&nbsp;</label>-->
                        <!--                                    <input placeholder="" class="form-control" type="text">-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                    </div>
                    <div class="row">
                        <!--                            <div class="col-sm-6">-->
                        <!--                                <div class="form-group">-->
                        <!--                                    <ul class="list-inline teamsup">-->
                        <!--                                        <li>-->
                        <!--                                            <label>Co-ordinator</label>-->
                        <!--                                            <div class="project-members">-->
                        <!--                                                <a href="#" data-toggle="tooltip" title="Jeffery Lalor" class="avatar">-->
                        <!--                                                    <img src="<?php echo base_url();?>assets/img/profiles/avatar-16.jpg" alt="">-->
                        <!--                                                </a>-->
                        <!--                                            </div>-->
                        <!--                                        </li>-->
                        <!--                                        <li>-->
                        <!--                                            <label>Team Lead</label>-->
                        <!--                                            <div class="project-members">-->
                        <!--                                                <a href="#" data-toggle="tooltip" title="Jeffery Lalor" class="avatar">-->
                        <!--                                                    <img src="<?php echo base_url();?>assets/img/profiles/avatar-16.jpg" alt="">-->
                        <!--                                                </a>-->
                        <!--                                            </div>-->
                        <!--                                        </li>-->
                        <!--                                        <li>-->
                        <!--                                            <label>Lead Pathologist</label>-->
                        <!--                                            <div class="project-members">-->
                        <!--                                                <a href="#" data-toggle="tooltip" title="Jeffery Lalor" class="avatar">-->
                        <!--                                                    <img src="<?php echo base_url();?>assets/img/profiles/avatar-16.jpg" alt="">-->
                        <!--                                                </a>-->
                        <!--                                            </div>-->
                        <!--                                        </li>-->
                        <!--                                    </ul>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                            <div class="col-sm-6">-->
                        <!--                                <div class="form-group">-->
                        <!--                                    <label>Team Nurse</label>-->
                        <!--                                    <div class="project-members">-->
                        <!--                                        <a href="#" data-toggle="tooltip" title="John Doe" class="avatar">-->
                        <!--                                            <img src="<?php echo base_url();?>assets/img/profiles/avatar-16.jpg" alt="">-->
                        <!--                                        </a>-->
                        <!--                                    </div>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Add Coordinator</label>
                                <input name="coordinator" placeholder="someone@pathhub.com" class="form-control" type="email">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Add Team Lead</label>
                                <input name="team_lead" placeholder="someone@pathhub.com" class="form-control" type="email">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Add Clinical Nurse</label>
                                <input name="clinical_nurse" placeholder="someone@pathhub.com" class="form-control" type="email">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Add Pathologist</label>
                                <input name="pathologist" placeholder="someone@pathhub.com" class="form-control" type="email">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Add Team</label>
                                <input class="form-control" placeholder="someone@pathhub.com" class="form-control" type="email">
                            </div>
                        </div>
                    </div>
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-sm-6">-->
                    <!--                                <div class="form-group">-->
                    <!--                                    <label>Team Members</label>-->
                    <!--                                    <div class="project-members">-->
                    <!--                                        <a href="#" data-toggle="tooltip" title="John Doe" class="avatar">-->
                    <!--                                            <img src="<?php echo base_url();?>assets/img/profiles/avatar-16.jpg" alt="">-->
                    <!--                                        </a>-->
                    <!--                                        <a href="#" data-toggle="tooltip" title="John Doe" class="avatar">-->
                    <!--                                            <img src="<?php echo base_url();?>assets/img/profiles/avatar-16.jpg" alt="">-->
                    <!--                                        </a>-->
                    <!--                                        <a href="#" data-toggle="tooltip" title="John Doe" class="avatar">-->
                    <!--                                            <img src="<?php echo base_url();?>assets/img/profiles/avatar-16.jpg" alt="">-->
                    <!--                                        </a>-->
                    <!--                                        <a href="#" data-toggle="tooltip" title="John Doe" class="avatar">-->
                    <!--                                            <img src="<?php echo base_url();?>assets/img/profiles/avatar-16.jpg" alt="">-->
                    <!--                                        </a>-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" rows="4" class="form-control summernote" placeholder="Enter your message here"></textarea>
                    </div>
                    <!--                        <div class="form-group">-->
                    <!--                            <label>Upload Files</label>-->
                    <!--                            <input class="form-control" type="file">-->
                    <!--                        </div>-->
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>