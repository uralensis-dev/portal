<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Header -->

<style type="text/css">
    body{
        font-size: 16px;
    }
    .d-block {
        font-weight: 600;
        font-size: 18px;
    }
    .focus-label{
        font-size: 16px;
    }
    @media screen and (min-width: 1600px) {
        body,.form-focus .select2-container--default .select2-selection--single .select2-selection__rendered,
        .form-focus .focus-label{font-size: 18px;}
        .form-focus.select-focus .focus-label{font-size: 14px;}
        
    }
</style>

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Tickets</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Tickets</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_ticket"><i class="fa fa-plus"></i> Add
                Ticket</a>
        </div>
    </div>
</div>
<!-- /Page Header -->
<?php 
    if($this->session->flashdata('inserted') === true){
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success  alert-dismissible" role="alert">
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
<?php 
    if($this->session->flashdata('error') === true){
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success  alert-dismissible" role="alert">
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
    <div class="col-md-12">
        <div class="card-group m-b-30">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="d-block">New Tickets (Not Assigned)</span>
                        </div>
                        <div>
                            <span class="text-success"><?php echo $centage = number_format(($ticketsCountData['new'] / $ticketsCountData['total']) * 100,2); ?>%</span>
                        </div>
                    </div>
                    <h3 class="mb-3"><?php echo $ticketsCountData['new'];?></h3>
                    <div class="progress mb-2" style="height: 5px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $centage;?>%;" aria-valuenow="40"
                            aria-valuemin="0" aria-valuemax="<?php echo $ticketsCountData['total'];?>"></div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="d-block">Closed Tickets</span>
                        </div>
                        <div>
                        <span class="text-success"><?php echo $centage = number_format(($ticketsCountData['closed'] / $ticketsCountData['total']) * 100,2); ?>%</span>
                        </div>
                    </div>
                    <h3 class="mb-3"><?php echo $ticketsCountData['closed']?></h3>
                    <div class="progress mb-2" style="height: 5px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $centage;?>%;" aria-valuenow="40"
                            aria-valuemin="0" aria-valuemax="<?php echo $ticketsCountData['total'];?>"></div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="d-block">In Progress Tickets</span>
                        </div>
                        <div>
                        <span class="text-success"><?php echo $centage = number_format(($ticketsCountData['in_progress'] / $ticketsCountData['total']) * 100,2); ?>%</span>
                        </div>
                    </div>
                    <h3 class="mb-3"><?php echo $ticketsCountData['in_progress']?></h3>
                    <div class="progress mb-2" style="height: 5px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $centage;?>%;" aria-valuenow="40"
                            aria-valuemin="0" aria-valuemax="<?php echo $ticketsCountData['total'];?>"></div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="d-block">Pending Tickets</span>
                        </div>
                        <div>
                            <span class="text-success"><?php echo $centage = number_format(($ticketsCountData['pending'] / $ticketsCountData['total']) * 100,2); ?>%</span>
                        </div>
                    </div>
                    <h3 class="mb-3"><?php echo $ticketsCountData['pending']?></h3>
                    <div class="progress mb-2" style="height: 5px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $centage;?>%;" aria-valuenow="40"
                            aria-valuemin="0" aria-valuemax="<?php echo $ticketsCountData['total'];?>"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search Filter -->
<form action="<?php echo site_url('tickets/');?>" method="GET" accept-charset="utf-8" class="form-group">
    <div class="row filter-row form-group">
        <div class="col-sm col">
            <div class="form-group form-focus select-focus">
                <select class="select floating" name='status'>
                    <option value=''> -- Select -- </option>
                    <option <?php echo (isset($_REQUEST['status']) && $_REQUEST['status'] == 'open')?"selected":"";?> value='open'> Open </option>
                    <option <?php echo (isset($_REQUEST['status']) && $_REQUEST['status'] == 'on_hold')?"selected":"";?> value='on_hold'> On Hold </option>
                    <option <?php echo (isset($_REQUEST['status']) && $_REQUEST['status'] == 'closed')?"selected":"";?> value='closed'> Closed </option>
                    <option <?php echo (isset($_REQUEST['status']) && $_REQUEST['status'] == 'in_progress')?"selected":"";?> value='in_progress'> In Progress </option>
                    <option <?php echo (isset($_REQUEST['status']) && $_REQUEST['status'] == 'cancelled')?"selected":"";?> value='cancelled'> Cancelled </option>
                </select>
                <label class="focus-label">Status</label>
            </div>
        </div>
        <div class="col-sm col">
            <div class="form-group form-focus select-focus">
                <select class="select floating" name='priority'>
                    <option value=''> -- Select -- </option>
                    <option <?php echo (isset($_REQUEST['priority']) && $_REQUEST['priority'] == 'critical')?"selected":"";?> value='critical'> Critical </option>
                    <option <?php echo (isset($_REQUEST['priority']) && $_REQUEST['priority'] == 'high')?"selected":"";?> value='high'> High </option>
                    <option <?php echo (isset($_REQUEST['priority']) && $_REQUEST['priority'] == 'normal')?"selected":"";?> value='normal'> Normal </option>
                </select>
                <label class="focus-label">Priority</label>
            </div>
        </div>
        <div class="col-sm col">
            <div class="form-group form-focus">
                <div class="cal-icon">
                    <input class="form-control floating datetimepicker" type="date" name='from_date' value='<?php echo (isset($_REQUEST['from_date']) && $_REQUEST['from_date']!='')?$_REQUEST['from_date']:'';?>'>
                </div>
                <label class="focus-label">From</label>
            </div>
        </div>
        <div class="col-sm col">
            <div class="form-group form-focus">
                <div class="cal-icon">
                    <input class="form-control floating datetimepicker" type="date" name='to_date' value='<?php echo (isset($_REQUEST['to_date']) && $_REQUEST['to_date']!='')?$_REQUEST['to_date']:'';?>'>
                </div>
                <label class="focus-label">To</label>
            </div>
        </div>
        <div class="col-sm col">
            <button type='submit' class="btn btn-success btn-block"> Search </button>
        </div>
    </div>
</form>
<!-- /Search Filter -->

<div class="row">
    <div class="col-md-12">
        <?php if(empty($ticketsData)){?>
            <p>No Tickets To Show...</p>
        <?php }else{
            ?>
          
        <div class="table-responsive">
            <table class="table table-striped custom-table mb-0 datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ticket Id</th>
                        <th>Ticket Subject</th>
                        <th>Assigned Staff</th>
                        <th>Created Date</th>
                        <th>Last Update</th>
                        <th>Priority</th>
                        <th class="text-center">Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $count = 1;
                foreach($ticketsData as $result):?>
                    <tr>
                        <td><?php echo $count;$count++;?></td>
                        <td><a href="<?php echo site_url('tickets/viewTicket/'.$result['ticket_id']);?>"># <?php echo $result['ticket_number']?></a></td>
                        <td><?php echo $result['ticket_subject']?></td>
                        <td>
                            <?php $ticketAssignee = $this->tickets-> getTicketAssignee($result['ticket_id']);
                            if(!empty($ticketAssignee)):
                                $counter = 1;?>
                                <?php foreach($ticketAssignee as $assignee):?>
                                        <a href="javascript:void();" data-toggle="tooltip" data-placement="bottom" title="" class="avatar" data-original-title="<?php echo $assignee['enc_first_name'].' '. $assignee['enc_last_name']?>">
                                        <?php echo $assignee['enc_first_name'][0].$assignee['enc_last_name'][0];?></a>
                                <?php endforeach;?>
                            <?php else:?>
                                <?php echo "<span class='badge badge-danger'>Un-Assigned</span>";?>
                            <?php endif;?>
                        </td>
                        <td><?php echo date("d M Y h:i A",strtotime($result['ticket_created_on']))?></td>
                        <td><?php echo date("d M Y h:i A",strtotime($result['ticket_mod_on']))?></td>
                        <td>
                            <div class="dropdown action-label">
                               
                                    <?php switch($result['ticket_priority']){
                                        case 'normal':
                                            ?>
                                            <?php if(!$this->ion_auth->is_admin()):?>
                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="javascript:void(0);">
                                                <i class="fa fa-dot-circle-o text-primary"></i> 
                                                Normal</a>
                                            <?php else:?>
                                             <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="javascript:void(0);"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o text-primary"></i> 
                                                    Normal</a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changePriority/'.$result['ticket_id']."/2");?>"><i class="fa fa-dot-circle-o text-danger"></i>
                                                    Critical</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changePriority/'.$result['ticket_id']."/1");?>"><i class="fa fa-dot-circle-o text-warning"></i>
                                                    High</a>
                                            </div>
                                            <?php endif;?>
                                            <?php
                                        break;
                                        case 'high':
                                            ?>
                                            <?php if(!$this->ion_auth->is_admin()):?>
                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="javascript:void(0);">
                                                <i class="fa fa-dot-circle-o text-warning"></i> 
                                                High </a>
                                            <?php else:?>
                                             <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="javascript:void(0);"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o text-warning"></i> 
                                                    High </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changePriority/'.$result['ticket_id']."/0");?>"><i class="fa fa-dot-circle-o text-primary"></i>
                                                    Normal</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changePriority/'.$result['ticket_id']."/2");?>"><i class="fa fa-dot-circle-o text-danger"></i>
                                                    Critical</a>
                                            </div>
                                            <?php endif;?>
                                            <?php
                                        break;
                                        case 'critical':
                                            ?>
                                            <?php if(!$this->ion_auth->is_admin()):?>
                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="javascript:void(0);">
                                                <i class="fa fa-dot-circle-o text-danger"></i> 
                                                Critical</a>
                                            <?php else:?>
                                             <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="javascript:void(0);"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o text-danger"></i> 
                                                   Critical</a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changePriority/'.$result['ticket_id']."/0");?>"><i class="fa fa-dot-circle-o text-primary"></i>
                                                    Normal</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changePriority/'.$result['ticket_id']."/1");?>"><i class="fa fa-dot-circle-o text-warning"></i>
                                                    High</a>
                                            </div>
                                            <?php endif;?>
                                            <?php
                                        break;
                                        default:
                                        break;
                                    }?>
                                    
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="dropdown action-label">
                                
                                <?php switch($result['ticket_status']){
                                        case 'open':
                                            ?>
                                            <?php if(!$this->ion_auth->is_admin()):?>
                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="javascript:void(0);">
                                                <i class="fa fa-dot-circle-o text-info"></i>Open
                                                </a>
                                            <?php else:?>
                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                                data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-dot-circle-o text-info"></i>Open
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/1");?>"><i class="fa fa-dot-circle-o text-info"></i>
                                                        Reopened</a>
                                                    <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/2");?>"><i class="fa fa-dot-circle-o text-danger"></i> On
                                                        Hold</a>
                                                    <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/3");?>"><i class="fa fa-dot-circle-o text-success"></i>
                                                        Closed</a>
                                                    <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/4");?>"><i class="fa fa-dot-circle-o text-success"></i> In
                                                        Progress</a>
                                                    <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/5");?>"><i class="fa fa-dot-circle-o text-danger"></i>
                                                        Cancelled</a>
                                                </div>
                                            <?php endif;?>
                                            <?php
                                        break;
                                        case 're_open':
                                            ?>
                                            
                                            <?php if(!$this->ion_auth->is_admin()):?>
                                            
                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#">
                                                <i class="fa fa-dot-circle-o text-info"></i>Reopened
                                            </a>
                                            <?php else:?>
                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                            data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o text-info"></i>Reopened
                                            </a>
                                             <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/0");?>"><i class="fa fa-dot-circle-o text-info"></i>
                                                    Open</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/2");?>"><i class="fa fa-dot-circle-o text-danger"></i> On
                                                    Hold</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/3");?>"><i class="fa fa-dot-circle-o text-success"></i>
                                                    Closed</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/4");?>"><i class="fa fa-dot-circle-o text-success"></i> In
                                                    Progress</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/5");?>"><i class="fa fa-dot-circle-o text-danger"></i>
                                                    Cancelled</a>
                                            </div>
                                            <?php endif;?>
                                            <?php
                                        break;
                                        case 'hold':
                                            ?>
                                            
                                            <?php if(!$this->ion_auth->is_admin()):?>
                                            
                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#">
                                                <i class="fa fa-dot-circle-o text-danger"></i>On Hold
                                            </a>
                                            <?php else:?>
                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                            data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o text-danger"></i>On Hold
                                            </a>
                                             <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/0");?>"><i class="fa fa-dot-circle-o text-info"></i>
                                                    Open</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/1");?>"><i class="fa fa-dot-circle-o text-info"></i>
                                                    Reopened</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/3");?>"><i class="fa fa-dot-circle-o text-success"></i>
                                                    Closed</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/4");?>"><i class="fa fa-dot-circle-o text-success"></i> In
                                                    Progress</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/5");?>"><i class="fa fa-dot-circle-o text-danger"></i>
                                                    Cancelled</a>
                                            </div>
                                            <?php endif;?>
                                            <?php
                                        break;
                                        case 'closed':
                                            ?>
                                            
                                            <?php if(!$this->ion_auth->is_admin()):?>
                                            
                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#">
                                                <i class="fa fa-dot-circle-o text-success"></i>Closed
                                            </a>
                                            <?php else:?>
                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                            data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o text-success"></i>Closed
                                            </a>
                                             <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/0");?>"><i class="fa fa-dot-circle-o text-info"></i>
                                                    Open</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/1");?>"><i class="fa fa-dot-circle-o text-info"></i>
                                                    Reopened</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/2");?>"><i class="fa fa-dot-circle-o text-danger"></i> On
                                                    Hold</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/4");?>"><i class="fa fa-dot-circle-o text-success"></i> In
                                                    Progress</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/5");?>"><i class="fa fa-dot-circle-o text-danger"></i>
                                                    Cancelled</a>
                                            </div>
                                            <?php endif;?>
                                            <?php
                                        break;
                                        case 'in_progress':
                                            
                                            ?>
                                            <?php if(!$this->ion_auth->is_admin()):?>
                                            
                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#">
                                                <i class="fa fa-dot-circle-o text-success"></i>In Progress
                                            </a>
                                            <?php else:?>
                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                            data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o text-success"></i>In Progress
                                            </a>
                                             <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/0");?>"><i class="fa fa-dot-circle-o text-info"></i>
                                                    Open</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/1");?>"><i class="fa fa-dot-circle-o text-info"></i>
                                                    Reopened</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/2");?>"><i class="fa fa-dot-circle-o text-danger"></i> On
                                                    Hold</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/3");?>"><i class="fa fa-dot-circle-o text-success"></i>
                                                    Closed</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/5");?>"><i class="fa fa-dot-circle-o text-danger"></i>
                                                    Cancelled</a>
                                            </div>
                                            <?php endif;?>
                                            <?php
                                        break;
                                        case 'cancelled':
                                            
                                            ?>
                                            <?php if(!$this->ion_auth->is_admin()):?>
                                            
                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#">
                                                <i class="fa fa-dot-circle-o text-danger"></i>Cancelled
                                            </a>
                                            <?php else:?>
                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                            data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o text-danger"></i>Cancelled
                                            </a>
                                             <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/0");?>"><i class="fa fa-dot-circle-o text-info"></i>
                                                    Open</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/1");?>"><i class="fa fa-dot-circle-o text-info"></i>
                                                    Reopened</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/2");?>"><i class="fa fa-dot-circle-o text-danger"></i> On
                                                    Hold</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/3");?>"><i class="fa fa-dot-circle-o text-success"></i>
                                                    Closed</a>
                                                <a class="dropdown-item" href="<?php echo site_url('tickets/changeStatus/'.$result['ticket_id']."/4");?>"><i class="fa fa-dot-circle-o text-success"></i> In
                                                    Progress</a>
                                            </div>
                                            <?php endif;?>
                                            <?php
                                        break;
                                        default:
                                        break;
                                
                                    }?>
                            </div>
                        </td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item edt-tckt" href="javascript:void(0);" id='<?php echo $result['ticket_id'];?>' data-info="<?php echo $result['ticket_id'];?>" data-toggle="modal" data-target="#edit_ticket"><i
                                            class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item del-tckt" href="javascript:void(0);" data-info="<?php echo $result['ticket_id'];?>" data-toggle="modal"
                                        data-target="#delete_ticket"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
        }?>
    </div>
<!-- /Page Content -->

<!-- Add Ticket Modal -->
<div id="add_ticket" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
			<?php 
				if(isset($error) && $error === true){
					?>
					<div class="row">
						<div class="alert alert-danger show">
							<?php 
							if(isset($errorMsgs) && !empty($errorMsgs)){
								foreach($errorMsgs as $msg){
									?>
									<p><?php echo $msg;?></p>
									<?php
								}
							}
							?>
						</div>
					</div>
					<?php
				}
			?>
				
                <?php
               		$attributes = array('method' => 'POST','enctype'=>"multipart/form-data");
                    echo form_open("tickets/", $attributes);
                    
                ?>
                <input type="hidden" name='save_type' value='add'/>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Ticket Subject <em class='text-danger'>*</em></label>
                            <input class="form-control" type="text" name='ticket_subject' id='ticket_subject' required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Product</label>
                            <select id='product' name='product' class="select">
                                <?php
								foreach ($products as $prod_id => $prod_name) {
									?>
									<option value='<?php echo $prod_id;?>'><?php echo $prod_name;?></option>
									<?php 
								}?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">

                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Priority</label>
                                </div>
                                <div class="col-sm-4 radio text-primary">
                                    <label>
                                        <input type="radio" name="ticket_priority" value='normal' checked> <strong>Normal</strong>
                                        <p>Non-Critical Queries, advice & support.</p>
                                    </label>
                                </div>
                                <div class="col-sm-4 radio text-warning">
                                    <label>
                                        <input type="radio" name="ticket_priority" value='high'> <strong>High</strong>
                                        <p>Important requests that are not Business Critical.</p>
                                    </label>
                                </div>
                                <div class="col-sm-4 radio text-danger">
                                    <label>
                                        <input type="radio" name="ticket_priority" value='critical'> <strong>Critical</strong>
                                        <p>Requests with Business Critical impact.</p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Message <em class='text-danger'>*</em></label>
                            <textarea class="form-control" id='ticket_message' name='ticket_message'></textarea>
                        </div>
                    </div>
                </div>
                <?php if ($this->ion_auth->is_admin()):?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Assign To</label>
                            <!-- TODO: Add profile picture avatar to select option -->
                            <!-- Populated through script in js/auth/ticket/ticket.js -->
                            <select name="assignee" id="add-assignee" class="form-control">
                            </select>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Your Reference</label>
                            <input class="form-control" type="text" id='ticket_reference' name='ticket_reference' />
                            <p><small>Optional - You can Provide Reference for your records. For Instance an internal
                                    Issue Tracking Number. </small></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <button class="btn btn-primary tck-swtchrs" type="button" data-toggle="collapse"
                                data-target="#attachments" aria-expanded="false">
                                <i class='la la-paperclip'></i> Show Attachments </button>
                            <button class="btn btn-primary tck-swtchrs" type="button" data-toggle="collapse"
                                data-target="#notifications" aria-expanded="false">
                                <i class='la la-bell'></i> Notification Settings </button>
                        </div>
                    </div>
                </div>
                <div class="row collapse" id='attachments' aria-expanded="false">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="card-title">Attachments</h4>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-4">
                                    <p class="mb-0">You Can Attach any file here which you think may help our engineers,
                                        for instance error message, screen shots or server log files.</p>
                                </div>
                                <div class="col-sm-8">
                                    <input class="form-control" type="file" id='ticket_files' name='ticket_files[]'
                                        multiple='true'>
                                    <p><small>Allowed File Types: <span class='text-monospace'>pdf, doc, docx, jpg,
                                                jpeg, png, gif,</span></small><br><small>Max Size: <strong class='text-monospace'>2 MB</strong></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row collapse" id='notifications' aria-expanded="false">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="card-title">Notifications</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Set weather you want text alerts, how replies can be made to the
                                        request and weather to CC responses to any other contacts on your Path Hub
                                        Account.</p>
                                </div>
                                <div class="col-sm-8">
                                    <div class="col-sm-12">

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-12">CC Response To</label>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input class="form-control" type="email" name='ticket_cc_to' id='ticket_cc_to'/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-12">Reply Security</label>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="ticket_reply_thru" value='pathhub' checked>
                                                        Reply must be made through PathHub
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="ticket_reply_thru" value='any'> Reply can be
                                                        made through PathHub or Email
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-12">Receive Text Alerts</label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="ticket_sms_alert" value='no' checked> No
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="ticket_sms_alert" value='yes'> Yes
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="submit-section">
                    <button class="btn btn-primary submit-btn tck-smbt-btn" type='submit'>Create Request</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Ticket Modal -->

<!-- Edit Ticket Modal -->
<div id="edit_ticket" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body " id='edt_modal_bdy'>        
                <div class="text-center">
                    <div class="spinner-border " role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Ticket Modal -->

<!-- Delete Ticket Modal -->
<div class="modal custom-modal fade" id="delete_ticket" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Ticket</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary continue-btn tckt-del-btn">Delete</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-dismiss="modal"
                                class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
<?php 

	if(isset($showDiag) && $showDiag == 'addDiag'){
		?>var dialogType = 'addDiag';<?php
    }
    
    if(isset($showDiag) && $showDiag == 'editDiag'){
		?> var dialogType = 'editDiag';<?php
		?> var attachmentID = '<?php echo $attachmentID;?>';<?php
	}

	?>
</script>