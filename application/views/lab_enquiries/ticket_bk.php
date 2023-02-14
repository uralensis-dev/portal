<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Header -->
<style type="text/css">
    body {
        font-size: 16px;
    }
    .nav-tabs .nav-link{
        min-width: 80px;
        text-align: center;
    }
    table.dataTable thead th:after,
    table.dataTable thead th:before{display: none !important;}

    .d-block {
        font-weight: 600;
        font-size: 18px;
    }

    .focus-label {
        font-size: 16px;
    }
    .tg-formtheme {
    width: 100%;
    float: left;
}
table.dataTable thead > tr > th {
    font-weight: 600 !important;
}
.tg-select {
    /*color: #666;*/
    color: #000;
    float: left;
    width: 100%;
    position: relative;
    text-transform: uppercase;
}
.tg-select select {
    z-index: 1;
    width: 100%;
    position: relative;
    appearance: none;
    -moz-appearance: none;
    -webkit-appearance: none;
}
.tg-select:after {
    top: 0;
    right: 10px;
    z-index: 2;
    color: #666;
    display: block;
    content: '\f107';
    position: absolute;
    text-align: center;
    font-size: inherit;
    line-height: 3;
    font-family: 'FontAwesome';
}
.tg-flagcolor .tg-radio input[type=radio], .tg-filtercolors .tg-checkbox input[type=checkbox] {
    display: none;
}
.tg-flagcolor span.tg-radio, .tg-filtercolors span.tg-radio{position:relative;}
.tg-filterradios fieldset .tg-radio input{display: none;}
.tg-filterradios fieldset .tg-radio{position:relative;}
.tg-formtheme fieldset {
    border: 0;
    margin: 0;
    padding: 0;
    width: 100%;
    float: left;
    position: relative;
}
.tg-radio input[type=radio] + label:before, .tg-checkbox input[type=checkbox] + label:before {
    top: 4px;
    left: 0;
    color: #373542;
    font-size: 14px;
    line-height: 14px;
    content: '\f096';
    position: absolute;
    font-family: 'FontAwesome';
}
.tg-filterradios .tg-radio, .tg-filterradios .tg-radio label, .tg-checkbox, .tg-checkbox label {
    margin: 0;
    width: auto;
    float: left;
    position: relative;
}

.tg-flagcolor .tg-checkboxgroup .tg-flagcolor2 input[type=radio]:checked + label:before{background: #92dd59;}

.tg-statusbar.tg-flagcolor .tg-checkboxgroup span input[type=radio] + label:before{display: none;}
.tg-statusbar.tg-flagcolor .tg-checkboxgroup span input[type=radio]:checked + label,
.tg-statusbar.tg-flagcolor .tg-checkboxgroup span input[type=radio]:checked + label span{
    color: #fff;
    background: #337ab7;
    border-color: #337ab7;
}
.tg-statusbar.tg-flagcolor .tg-checkboxgroup .tg-radio label {
    height: 36px;
    width: 36px;
    text-align: center;
    border-radius: 50%;
    position: relative;
    top: 0;
    left: 0;
    color: #555;
    display: inline-block;
    vertical-align: middle;
    border: 1px solid #ddd;
    padding: 0;
    font-size: 16px;
    line-height: 2;
}
.tg-statusbar.tg-flagcolor .tg-checkboxgroup span input[type=radio]:checked + label {
    background: #006df1;
    color: #fff;
    border-color: #006df1;
}
.tg-statusbar.tg-flagcolor .tg-checkboxgroup span input[type=radio]:checked + label span {
    background: transparent;
}
    @media screen and (min-width: 1600px) {
        body, .form-focus .select2-container--default .select2-selection--single .select2-selection__rendered,
        .form-focus .focus-label {
            font-size: 18px;
        }

        .form-focus.select-focus .focus-label {
            font-size: 14px;
        }

    }
	
.nav-tabs.nav-tabs-solid.nav-tabs-rounded
{
	border-radius: 0px !important;
}	
.nav-tabs.nav-tabs-solid.nav-tabs-rounded > li > a {
    border-radius: 0px !important;
}
	
</style>

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Enquires</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Enquiries</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <div class="tg-filterhold pull-left mr-3" style="display:none">
                <ul class="tg-filters record-list-filters list-unstyled">
                    <li class="tg-statusbar tg-flagcolor">
                        <div class="tg-checkboxgroup tg-checkboxgroupvtwo">                                                                        <span title="Newlife Hospital" class="tg-radio tg-flagcolor1">
                                <input value="9" class="filter_by_hospital_btn" name="hostpital" id="NH" type="radio">
                                <label for="NH"><span>NH</span></label>
                            </span>
                            <span title="Care &amp; Cure Hospital" class="tg-radio tg-flagcolor1">
                                <input value="18" class="filter_by_hospital_btn" name="hostpital" id="CH" type="radio">
                                <label for="CH"><span>CH</span></label>
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
            <a href="#" class="btn add-btn btn-rounded" data-toggle="modal" data-target="#add_ticket"><i class="fa fa-plus"></i> Add
                Enquiry</a>
        </div>
    </div>
</div>
<!-- /Page Header -->
<?php
if ($this->session->flashdata('inserted') === true) {
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success  alert-dismissible" role="alert">
                <strong><?php echo $this->session->flashdata('tckSuccessMsg'); ?></strong>
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
if ($this->session->flashdata('error') === true) {
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success  alert-dismissible" role="alert">
                <strong><?php echo $this->session->flashdata('tckSuccessMsg'); ?></strong>
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
                            <span class="d-block">New Enquiry (Not Assigned)</span>
                        </div>
                        <div>
                            <span class="text-success"><?php $centage = number_format(($ticketsCountData['new'] / $ticketsCountData['total']) * 100, 2);
                                echo($centage == "nan" ? 0 : $centage); ?>%</span>
                        </div>
                    </div>
                    <h3 class="mb-3"><?php echo $ticketsCountData['new']; ?></h3>
                    <div class="progress mb-2" style="height: 5px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $centage; ?>%;"
                             aria-valuenow="40"
                             aria-valuemin="0" aria-valuemax="<?php echo $ticketsCountData['total']; ?>"></div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="d-block">Closed Enquiry</span>
                        </div>
                        <div>
                            <span class="text-success"><?php $centage = number_format(($ticketsCountData['closed'] / $ticketsCountData['total']) * 100, 2);
                                echo($centage == "nan" ? 0 : $centage); ?>%</span>
                        </div>
                    </div>
                    <h3 class="mb-3"><?php echo $ticketsCountData['closed'] ?></h3>
                    <div class="progress mb-2" style="height: 5px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $centage; ?>%;"
                             aria-valuenow="40"
                             aria-valuemin="0" aria-valuemax="<?php echo $ticketsCountData['total']; ?>"></div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="d-block">In Progress Enquiry</span>
                        </div>
                        <div>
                            <span class="text-success"><?php $centage = number_format(($ticketsCountData['in_progress'] / $ticketsCountData['total']) * 100, 2);
                                echo($centage == "nan" ? 0 : $centage); ?>%</span>
                        </div>
                    </div>
                    <h3 class="mb-3"><?php echo $ticketsCountData['in_progress'] ?></h3>
                    <div class="progress mb-2" style="height: 5px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $centage; ?>%;"
                             aria-valuenow="40"
                             aria-valuemin="0" aria-valuemax="<?php echo $ticketsCountData['total']; ?>"></div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="d-block">Pending Enquiry</span>
                        </div>
                        <div>
                            <span class="text-success"><?php $centage = number_format(($ticketsCountData['pending'] / $ticketsCountData['total']) * 100, 2);
                                echo($centage == "nan" ? 0 : $centage); ?>%</span>
                        </div>
                    </div>
                    <h3 class="mb-3"><?php echo $ticketsCountData['pending'] ?></h3>
                    <div class="progress mb-2" style="height: 5px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $centage; ?>%;"
                             aria-valuenow="40"
                             aria-valuemin="0" aria-valuemax="<?php echo $ticketsCountData['total']; ?>"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search Filter -->
<form action="<?php echo site_url('labEnquiries/'); ?>" method="GET" accept-charset="utf-8" class="form-group">
    <div class="row filter-row form-group">
        <div class="col-sm col">
            <div class="form-group form-focuss select-focus">
                
                <select class="select floating" name='status'>
                    <option value=''> -- Select Status--</option>
                    <option <?php echo (isset($_REQUEST['status']) && $_REQUEST['status'] == 'open') ? "selected" : ""; ?>
                            value='open'> Open
                    </option>
                    <option <?php echo (isset($_REQUEST['status']) && $_REQUEST['status'] == 'on_hold') ? "selected" : ""; ?>
                            value='on_hold'> On Hold
                    </option>
                    <option <?php echo (isset($_REQUEST['status']) && $_REQUEST['status'] == 'closed') ? "selected" : ""; ?>
                            value='closed'> Closed
                    </option>
                    <option <?php echo (isset($_REQUEST['status']) && $_REQUEST['status'] == 'in_progress') ? "selected" : ""; ?>
                            value='in_progress'> In Progress
                    </option>
                    <option <?php echo (isset($_REQUEST['status']) && $_REQUEST['status'] == 'cancelled') ? "selected" : ""; ?>
                            value='cancelled'> Cancelled
                    </option>
                </select>
            </div>
        </div>
        <div class="col-sm col">
            <div class="form-group form-focuss select-focus">
                
                <select class="select floating" name='priority'>
                    <option value=''> -- SelectPriority--</option>
                    <option <?php echo (isset($_REQUEST['priority']) && $_REQUEST['priority'] == 'critical') ? "selected" : ""; ?>
                            value='critical'> Critical
                    </option>
                    <option <?php echo (isset($_REQUEST['priority']) && $_REQUEST['priority'] == 'high') ? "selected" : ""; ?>
                            value='high'> High
                    </option>
                    <option <?php echo (isset($_REQUEST['priority']) && $_REQUEST['priority'] == 'normal') ? "selected" : ""; ?>
                            value='normal'> Normal
                    </option>
                </select>
            </div>
        </div>

        <div class="col-sm col">
            <div class="form-group form-focus">
                <!--                <div class="cal-icon">-->
                <!--                    <input class="form-control floating datetimepicker" type="date" name='from_date'-->
                <!--                           value='-->
                <?php //echo (isset($_REQUEST['from_date']) && $_REQUEST['from_date'] != '') ? $_REQUEST['from_date'] : ''; ?><!--'>-->
                <!--                </div>-->
                <!--                <label class="focus-label">From</label>-->
                

                <input class="form-control datepicker range2Picker" type="text" placeholder="Date Range..." name="start_end_date"
                       id="start_end_date" value="<?php echo $_REQUEST['start_end_date']; ?>" readonly/>

            </div>
        </div>
<!--        <div class="col-sm col">-->
<!--            <div class="form-group form-focus">-->
<!--                <div class="cal-icon">-->
<!--                    <input class="form-control floating datetimepicker" type="date" name='to_date'-->
<!--                           value='--><?php //echo (isset($_REQUEST['to_date']) && $_REQUEST['to_date'] != '') ? $_REQUEST['to_date'] : ''; ?><!--'>-->
<!--                </div>-->
<!--                <label class="focus-label">To</label>-->
<!--            </div>-->
<!--        </div>-->
        <div class="col-sm col">            
            <button type='submit' class="btn btn-success btn-block">Search</button>
        </div>
    </div>
</form>
<!-- /Search Filter -->
<div class="col-md-12">
    <div class="row">
        <div class="col-md-12 card">
            <div class="card-body dash_tabs nopadding">
                <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                    <li class="nav-item"><a class="nav-link active" href="#allData" data-toggle="tab">All</a></li>
                    <li class="nav-item"><a class="nav-link" href="#general" data-toggle="tab">General</a></li>
                    <li class="nav-item"><a class="nav-link" href="#routine_and_specials" data-toggle="tab">Routine & Specials</a></li>
                    <li class="nav-item"><a class="nav-link" href="#immuno_general" data-toggle="tab">Immunochemistry - General</a></li>
                    <li class="nav-item"><a class="nav-link" href="#em_request" data-toggle="tab">EM Request</a></li>
                    <li class="nav-item"><a class="nav-link" href="#further_work" data-toggle="tab">Further Work</a></li>
                </ul>
                <div class="tab-content" style="padding: 20px;">
                    <div class="tab-pane active" id="allData">
                        <?php if (empty($ticketsData)) { ?>
                        <p>No Enquiry To Show...</p>
                            <?php } else {
                        ?>

                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0" id="admin_users_activities">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Id</th>
                                    <th>Ticket</th>
                                    <th>Assigned Staff</th>
                                    <th>Created/Last Update</th>                                    
                                    <th>Priority</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
								//print_r($ticketsData);
                                foreach ($ticketsData as $result):?>
                                    <tr  >
                                        <td><?php echo $count;
                                            $count++; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('labEnquiries/viewTicket/' . $result['ticket_id']); ?>"># <?php echo $result['ticket_number'] ?></a>
                                        </td>
                                        <td><strong><?php echo $result['ticket_subject'] ?></strong><br /><?php echo $result['ticket_message'] ?></td>
                                        <td>
                                            <?php $ticketAssignee = $this->lab_enquiries->getTicketAssignee($result['ticket_id']);
                                            if (!empty($ticketAssignee)):
                                                $counter = 1; ?>
                                                <?php foreach ($ticketAssignee as $assignee): ?>
                                                <a href="javascript:void();" data-toggle="tooltip" data-placement="bottom" title=""
                                                   class="avatar"
                                                   data-original-title="<?php echo $assignee['enc_first_name'] . ' ' . $assignee['enc_last_name'] ?>">
                                                    <?php echo $assignee['enc_first_name'][0] . $assignee['enc_last_name'][0]; ?></a>
                                            <?php endforeach; ?>
                                            <?php else: ?>
                                                <?php echo "<span class='badge badge-danger'>Un-Assigned</span>"; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo date("d M Y h:i A", strtotime($result['ticket_created_on'])) ?><br /><?php echo($result['ticket_mod_on'] != "" ? date("d M Y h:i A", strtotime($result['ticket_mod_on'])) : "N/A") ?></td>
                                        
                                        <td>
                                            <div class="dropdown action-label">

                                                <?php switch ($result['ticket_priority']) {
                                                    case 'normal':
                                                        ?>
                                                        <?php if (!$this->lab_enquiries->isLabAdmin()): ?>
                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                           href="javascript:void(0);">
                                                            <i class="fa fa-dot-circle-o text-primary"></i>
                                                            Normal</a>
                                                    <?php else: ?>
                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                           href="javascript:void(0);"
                                                           data-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-dot-circle-o text-primary"></i>
                                                            Normal</a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changePriority/' . $result['ticket_id'] . "/2"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-danger"></i>
                                                                Critical</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changePriority/' . $result['ticket_id'] . "/1"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-warning"></i>
                                                                High</a>
                                                        </div>
                                                    <?php endif; ?>
                                                        <?php
                                                        break;
                                                    case 'high':
                                                        ?>
                                                        <?php if (!$this->lab_enquiries->isLabAdmin()): ?>
                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                           href="javascript:void(0);">
                                                            <i class="fa fa-dot-circle-o text-warning"></i>
                                                            High </a>
                                                    <?php else: ?>
                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                           href="javascript:void(0);"
                                                           data-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-dot-circle-o text-warning"></i>
                                                            High </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changePriority/' . $result['ticket_id'] . "/0"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-primary"></i>
                                                                Normal</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changePriority/' . $result['ticket_id'] . "/2"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-danger"></i>
                                                                Critical</a>
                                                        </div>
                                                    <?php endif; ?>
                                                        <?php
                                                        break;
                                                    case 'critical':
                                                        ?>
                                                        <?php if (!$this->lab_enquiries->isLabAdmin()): ?>
                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                           href="javascript:void(0);">
                                                            <i class="fa fa-dot-circle-o text-danger"></i>
                                                            Critical</a>
                                                    <?php else: ?>
                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                           href="javascript:void(0);"
                                                           data-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-dot-circle-o text-danger"></i>
                                                            Critical</a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changePriority/' . $result['ticket_id'] . "/0"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-primary"></i>
                                                                Normal</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changePriority/' . $result['ticket_id'] . "/1"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-warning"></i>
                                                                High</a>
                                                        </div>
                                                    <?php endif; ?>
                                                        <?php
                                                        break;
                                                    default:
                                                        break;
                                                } ?>

                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown action-label">

                                                <?php switch ($result['ticket_status']) {
                                                    case 'open':
                                                        ?>
                                                        <?php if (!$this->lab_enquiries->isLabAdmin()): ?>
                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                           href="javascript:void(0);">
                                                            <i class="fa fa-dot-circle-o text-info"></i>Open
                                                        </a>
                                                    <?php else: ?>
                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                                           data-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-dot-circle-o text-info"></i>Open
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/1"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-info"></i>
                                                                Reopened</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/2"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-danger"></i> On
                                                                Hold</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/3"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-success"></i>
                                                                Closed</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/4"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-success"></i> In
                                                                Progress</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/5"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-danger"></i>
                                                                Cancelled</a>
                                                        </div>
                                                    <?php endif; ?>
                                                        <?php
                                                        break;
                                                    case 're_open':
                                                        ?>

                                                        <?php if (!$this->lab_enquiries->isLabAdmin()): ?>

                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#">
                                                            <i class="fa fa-dot-circle-o text-info"></i>Reopened
                                                        </a>
                                                    <?php else: ?>
                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                                           data-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-dot-circle-o text-info"></i>Reopened
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/0"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-info"></i>
                                                                Open</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/2"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-danger"></i> On
                                                                Hold</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/3"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-success"></i>
                                                                Closed</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/4"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-success"></i> In
                                                                Progress</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/5"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-danger"></i>
                                                                Cancelled</a>
                                                        </div>
                                                    <?php endif; ?>
                                                        <?php
                                                        break;
                                                    case 'hold':
                                                        ?>

                                                        <?php if (!$this->lab_enquiries->isLabAdmin()): ?>

                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#">
                                                            <i class="fa fa-dot-circle-o text-danger"></i>On Hold
                                                        </a>
                                                    <?php else: ?>
                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                                           data-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-dot-circle-o text-danger"></i>On Hold
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/0"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-info"></i>
                                                                Open</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/1"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-info"></i>
                                                                Reopened</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/3"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-success"></i>
                                                                Closed</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/4"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-success"></i> In
                                                                Progress</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/5"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-danger"></i>
                                                                Cancelled</a>
                                                        </div>
                                                    <?php endif; ?>
                                                        <?php
                                                        break;
                                                    case 'closed':
                                                        ?>

                                                        <?php if (!$this->lab_enquiries->isLabAdmin()): ?>

                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#">
                                                            <i class="fa fa-dot-circle-o text-success"></i>Closed
                                                        </a>
                                                    <?php else: ?>
                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                                           data-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-dot-circle-o text-success"></i>Closed
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/0"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-info"></i>
                                                                Open</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/1"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-info"></i>
                                                                Reopened</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/2"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-danger"></i> On
                                                                Hold</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/4"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-success"></i> In
                                                                Progress</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/5"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-danger"></i>
                                                                Cancelled</a>
                                                        </div>
                                                    <?php endif; ?>
                                                        <?php
                                                        break;
                                                    case 'in_progress':

                                                        ?>
                                                        <?php if (!$this->lab_enquiries->isLabAdmin()): ?>

                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#">
                                                            <i class="fa fa-dot-circle-o text-success"></i>In Progress
                                                        </a>
                                                    <?php else: ?>
                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                                           data-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-dot-circle-o text-success"></i>In Progress
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/0"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-info"></i>
                                                                Open</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/1"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-info"></i>
                                                                Reopened</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/2"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-danger"></i> On
                                                                Hold</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/3"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-success"></i>
                                                                Closed</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/5"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-danger"></i>
                                                                Cancelled</a>
                                                        </div>
                                                    <?php endif; ?>
                                                        <?php
                                                        break;
                                                    case 'cancelled':

                                                        ?>
                                                        <?php if (!$this->lab_enquiries->isLabAdmin()): ?>

                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#">
                                                            <i class="fa fa-dot-circle-o text-danger"></i>Cancelled
                                                        </a>
                                                    <?php else: ?>
                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                                           data-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-dot-circle-o text-danger"></i>Cancelled
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/0"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-info"></i>
                                                                Open</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/1"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-info"></i>
                                                                Reopened</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/2"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-danger"></i> On
                                                                Hold</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/3"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-success"></i>
                                                                Closed</a>
                                                            <a class="dropdown-item"
                                                               href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/4"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-success"></i> In
                                                                Progress</a>
                                                        </div>
                                                    <?php endif; ?>
                                                        <?php
                                                        break;
                                                    default:
                                                        break;

                                                } ?>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                        
                                        <a class="edt-tckt" href="javascript:void(0);"
                                                       id='<?php echo $result['ticket_id']; ?>'
                                                       data-info="<?php echo $result['ticket_id']; ?>" data-toggle="modal"
                                                       data-target="#edit_ticket"><i
                                                                class="fa fa-pencil m-r-5"></i></a>
                                                    <a class="del-tckt" href="javascript:void(0);"
                                                       data-info="<?php echo $result['ticket_id']; ?>" data-toggle="modal"
                                                       data-target="#delete_ticket"><i class="fa fa-trash-o m-r-5"></i></a>
                                        
                                            <div class="" style="display:none">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                   aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                            } ?>
                    </div>
                    <div class="tab-pane" id="general">
                      <h2>General</h2>
                    </div>
                    <div class="tab-pane" id="routine_and_specials">
                        <h2>Routine & Specials</h2>
                    </div>
                    <div class="tab-pane" id="immuno_general">
                       <h2>Immunochemistry - General</h2>
                    </div>
                    <div class="tab-pane" id="em_request">
                       <h2>EM Request</h2>
                    </div>
                    <div class="tab-pane" id="further_work">
                        <h2>Further Work</h2>
                        <?php if (empty($fwTicketsData)) { echo "<p>No Enquiry To Show...</p>"; } else {  ?>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table mb-0" id="further_work_datatable">
                                    <thead>
                                        <tr role="">
                                            <th>#</th>
                                            <th>Id</th>
                                            <th style="width:250px !important">Ticket</th>
                                            <th>Assigned Staff</th>
                                            <th>Created/Last Update</th>                                            
                                            <th>Priority</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($fwTicketsData as $result):?>

                                        <?php //if($result['record_type'] == 'FW'): ?>
                                            <tr>
                                                <td><?php echo $count; $count++; ?></td>
                                                <td>
                                                    <a href="<?= site_url('labEnquiries/viewTicket/'.$result['ticket_id']); ?>"># <?= $result['ticket_number'] ?></a>
                                                </td>
                                                <td><strong><?=$result['ticket_subject'] ?></strong><br /><?=$result['ticket_message'] ?></td>
                                                <td>
                                                    <?php $ticketAssignee = $this->lab_enquiries->getTicketAssignee($result['ticket_id']);
                                                    if (!empty($ticketAssignee)):
                                                        $counter = 1; ?>
                                                        <?php foreach ($ticketAssignee as $assignee): ?>
                                                            <a href="javascript:void();" data-toggle="tooltip" data-placement="bottom" title="" class="avatar" data-original-title="<?= $assignee['enc_first_name'] . ' ' . $assignee['enc_last_name']; ?>"><?= $assignee['enc_first_name'][0] . $assignee['enc_last_name'][0]; ?></a>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <?= "<span class='badge badge-danger'>Un-Assigned</span>"; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?=date("d M Y h:i A", strtotime($result['ticket_created_on'])); ?><br /><?= ($result['ticket_mod_on'] != "" ? date("d M Y h:i A", strtotime($result['ticket_mod_on'])) : "N/A"); ?></td>
                                                
                                                <td>
                                                    <div class="dropdown action-label">

                                                        <?php switch ($result['ticket_priority']) {
                                                            case 'normal':
                                                                ?>
                                                                <?php if (!$this->lab_enquiries->isLabAdmin()): ?>
                                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="javascript:void(0);"><i class="fa fa-dot-circle-o text-primary"></i>Normal</a>
                                                                <?php else: ?>
                                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="javascript:void(0);" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-dot-circle-o text-primary"></i>Normal</a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <a class="dropdown-item" href="<?= site_url('labEnquiries/changePriority/' . $result['ticket_id'] . "/2"); ?>"><i class="fa fa-dot-circle-o text-danger"></i>Critical</a>
                                                                        <a class="dropdown-item" href="<?= site_url('labEnquiries/changePriority/' . $result['ticket_id'] . "/1"); ?>"><i class="fa fa-dot-circle-o text-warning"></i>High</a>
                                                                    </div>
                                                                <?php endif; ?>

                                                                <?php
                                                                break;
                                                            case 'high':
                                                                ?>
                                                                <?php if (!$this->lab_enquiries->isLabAdmin()): ?>
                                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="javascript:void(0);"><i class="fa fa-dot-circle-o text-warning"></i>High </a>
                                                                <?php else: ?>
                                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="javascript:void(0);" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-dot-circle-o text-warning"></i>High </a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <a class="dropdown-item" href="<?= site_url('labEnquiries/changePriority/' . $result['ticket_id'] . "/0"); ?>"><i class="fa fa-dot-circle-o text-primary"></i>Normal</a>
                                                                        <a class="dropdown-item" href="<?= site_url('labEnquiries/changePriority/' . $result['ticket_id'] . "/2"); ?>"><i class="fa fa-dot-circle-o text-danger"></i>Critical</a>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <?php
                                                                break;
                                                            case 'critical':
                                                                ?>
                                                                <?php if (!$this->lab_enquiries->isLabAdmin()): ?>
                                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="javascript:void(0);"><i class="fa fa-dot-circle-o text-danger"></i>Critical</a>
                                                            <?php else: ?>
                                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="javascript:void(0);" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-dot-circle-o text-danger"></i>Critical</a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" href="<?= site_url('labEnquiries/changePriority/' . $result['ticket_id'] . "/0"); ?>"><i class="fa fa-dot-circle-o text-primary"></i>Normal</a>
                                                                    <a class="dropdown-item" href="<?= site_url('labEnquiries/changePriority/' . $result['ticket_id'] . "/1"); ?>"><i class="fa fa-dot-circle-o text-warning"></i>High</a>
                                                                </div>
                                                            <?php endif; ?>
                                                                <?php
                                                                break;
                                                            default:
                                                                break;
                                                        } ?>

                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="dropdown action-label">

                                                        <?php switch ($result['ticket_status']) {
                                                            case 'open':
                                                                ?>
                                                                <?php if (!$this->lab_enquiries->isLabAdmin()): ?>
                                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                                   href="javascript:void(0);">
                                                                    <i class="fa fa-dot-circle-o text-info"></i>Open
                                                                </a>
                                                            <?php else: ?>
                                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                                                   data-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-dot-circle-o text-info"></i>Open
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/1"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-info"></i>
                                                                        Reopened</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/2"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-danger"></i> On
                                                                        Hold</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/3"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-success"></i>
                                                                        Closed</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/4"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-success"></i> In
                                                                        Progress</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/5"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-danger"></i>
                                                                        Cancelled</a>
                                                                </div>
                                                            <?php endif; ?>
                                                                <?php
                                                                break;
                                                            case 're_open':
                                                                ?>

                                                                <?php if (!$this->lab_enquiries->isLabAdmin()): ?>

                                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#">
                                                                    <i class="fa fa-dot-circle-o text-info"></i>Reopened
                                                                </a>
                                                            <?php else: ?>
                                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                                                   data-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-dot-circle-o text-info"></i>Reopened
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/0"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-info"></i>
                                                                        Open</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/2"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-danger"></i> On
                                                                        Hold</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/3"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-success"></i>
                                                                        Closed</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/4"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-success"></i> In
                                                                        Progress</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/5"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-danger"></i>
                                                                        Cancelled</a>
                                                                </div>
                                                            <?php endif; ?>
                                                                <?php
                                                                break;
                                                            case 'hold':
                                                                ?>

                                                                <?php if (!$this->lab_enquiries->isLabAdmin()): ?>

                                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#">
                                                                    <i class="fa fa-dot-circle-o text-danger"></i>On Hold
                                                                </a>
                                                            <?php else: ?>
                                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                                                   data-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-dot-circle-o text-danger"></i>On Hold
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/0"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-info"></i>
                                                                        Open</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/1"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-info"></i>
                                                                        Reopened</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/3"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-success"></i>
                                                                        Closed</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/4"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-success"></i> In
                                                                        Progress</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/5"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-danger"></i>
                                                                        Cancelled</a>
                                                                </div>
                                                            <?php endif; ?>
                                                                <?php
                                                                break;
                                                            case 'closed':
                                                                ?>

                                                                <?php if (!$this->lab_enquiries->isLabAdmin()): ?>

                                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#">
                                                                    <i class="fa fa-dot-circle-o text-success"></i>Closed
                                                                </a>
                                                            <?php else: ?>
                                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                                                   data-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-dot-circle-o text-success"></i>Closed
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/0"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-info"></i>
                                                                        Open</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/1"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-info"></i>
                                                                        Reopened</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/2"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-danger"></i> On
                                                                        Hold</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/4"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-success"></i> In
                                                                        Progress</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/5"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-danger"></i>
                                                                        Cancelled</a>
                                                                </div>
                                                            <?php endif; ?>
                                                                <?php
                                                                break;
                                                            case 'in_progress':

                                                                ?>
                                                                <?php if (!$this->lab_enquiries->isLabAdmin()): ?>

                                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#">
                                                                    <i class="fa fa-dot-circle-o text-success"></i>In Progress
                                                                </a>
                                                            <?php else: ?>
                                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                                                   data-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-dot-circle-o text-success"></i>In Progress
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/0"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-info"></i>
                                                                        Open</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/1"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-info"></i>
                                                                        Reopened</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/2"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-danger"></i> On
                                                                        Hold</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/3"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-success"></i>
                                                                        Closed</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/5"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-danger"></i>
                                                                        Cancelled</a>
                                                                </div>
                                                            <?php endif; ?>
                                                                <?php
                                                                break;
                                                            case 'cancelled':

                                                                ?>
                                                                <?php if (!$this->lab_enquiries->isLabAdmin()): ?>

                                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#">
                                                                    <i class="fa fa-dot-circle-o text-danger"></i>Cancelled
                                                                </a>
                                                            <?php else: ?>
                                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                                                   data-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-dot-circle-o text-danger"></i>Cancelled
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/0"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-info"></i>
                                                                        Open</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/1"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-info"></i>
                                                                        Reopened</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/2"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-danger"></i> On
                                                                        Hold</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/3"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-success"></i>
                                                                        Closed</a>
                                                                    <a class="dropdown-item"
                                                                       href="<?php echo site_url('labEnquiries/changeStatus/' . $result['ticket_id'] . "/4"); ?>"><i
                                                                                class="fa fa-dot-circle-o text-success"></i> In
                                                                        Progress</a>
                                                                </div>
                                                            <?php endif; ?>
                                                                <?php
                                                                break;
                                                            default:
                                                                break;

                                                        } ?>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                
                                                <a class="edt-tckt" href="javascript:void(0);"
                                                               id='<?php echo $result['ticket_id']; ?>'
                                                               data-info="<?php echo $result['ticket_id']; ?>" data-toggle="modal"
                                                               data-target="#edit_ticket"><i
                                                                        class="fa fa-pencil m-r-5"></i></a>
                                                            <a class="del-tckt" href="javascript:void(0);"
                                                               data-info="<?php echo $result['ticket_id']; ?>" data-toggle="modal"
                                                               data-target="#delete_ticket"><i class="fa fa-trash-o m-r-5"></i></a>
                                                
                                                
                                                    <div class="dropdown dropdown-action" style="display:none">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                           aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php //endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div> 
<div class="row">
    <!-- /Page Content -->

    <!-- Add Ticket Modal -->
    <div id="add_ticket" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Enquiry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    if (isset($error) && $error === true) {
                        ?>
                        <div class="row">
                            <div class="alert alert-danger show">
                                <?php
                                if (isset($errorMsgs) && !empty($errorMsgs)) {
                                    foreach ($errorMsgs as $msg) {
                                        ?>
                                        <p><?php echo $msg; ?></p>
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
                    $attributes = array('method' => 'POST', 'enctype' => "multipart/form-data");
                    echo form_open("labEnquiries/", $attributes);

                    ?>
                    <input type="hidden" name='save_type' value='add'/>
                    <input type="hidden" name='is_lab' value='<?php echo(($isUserLab) ? 1 : 0); ?>>'/>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Ticket Subject <em class='text-danger'>*</em></label>
                                <input class="form-control" type="text" name='ticket_subject' id='ticket_subject'
                                       required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Lab Area</label>
                                <select id='product' name='product' class="select" required>
                                    <option value="GE">General Enquiry</option>
                                    <option value="RF">Request Form</option>
                                    <option value="MC">Macro cut up</option>
                                    <option value="MS">Micro - Slides</option>
                                    <option value="MB">Micro - Blocks</option>
                                    <option value="I">Immuno</option>
                                    <option value="S">Routine & Specials</option>
                                    <option value="R">Reports</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <?php if ($isUserLab) { ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Laboratories</label>
                                    <select id='user_lab_id' name='user_lab_id' class="select">
                                        <?php foreach ($userLabs as $labData) { ?>
                                            <option value="<?php echo $labData->id; ?>"><?php echo $labData->name; ?></option>
                                        <?php } ?>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

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
                                            <input type="radio" name="ticket_priority" value='high'>
                                            <strong>High</strong>
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
                    <?php if ($this->lab_enquiries->isLabAdmin()): ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Assign To</label>
                                    <!-- TODO: Add profile picture avatar to select option -->
                                    <!-- Populated through script in js/auth/ticket/ticket.js -->
                                    <select name="assignee" id="add-assignee" class="form-control">
                                        <option value="">--Select User--</option>
                                        <?php foreach ($usersList as $userL) { ?>
                                            <option value="<?php echo $userL['id']; ?>"><?php echo $userL['first_name'] . " " . $userL['last_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Your Reference</label>
                                <input class="form-control" type="text" id='ticket_reference' name='ticket_reference'/>
                                <p><small>Optional - You can Provide Reference for your records. For Instance an
                                        internal
                                        Issue Tracking Number. </small></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <button class="btn btn-primary tck-swtchrs" type="button" data-toggle="collapse"
                                        data-target="#attachments" aria-expanded="false">
                                    <i class='la la-paperclip'></i> Show Attachments
                                </button>
                                <button class="btn btn-primary tck-swtchrs" type="button" data-toggle="collapse"
                                        data-target="#notifications" aria-expanded="false">
                                    <i class='la la-bell'></i> Notification Settings
                                </button>
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
                                        <p class="mb-0">You Can Attach any file here which you think may help our
                                            engineers,
                                            for instance error message, screen shots or server log files.</p>
                                    </div>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="file" id='ticket_files' name='ticket_files[]'
                                               multiple='true'>
                                        <p><small>Allowed File Types: <span class='text-monospace'>pdf, doc, docx, jpg,
                                                jpeg, png, gif,</span></small><br><small>Max Size: <strong
                                                        class='text-monospace'>2 MB</strong></small></p>
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
                                                    <input class="form-control" type="email" name='ticket_cc_to'
                                                           id='ticket_cc_to'/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-12">Reply Security</label>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="ticket_reply_thru" value='pathhub'
                                                                   checked>
                                                            Reply must be made through PathHub
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="ticket_reply_thru" value='any'>
                                                            Reply can be
                                                            made through PathHub or Email
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-12">Receive Text
                                                            Alerts</label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="ticket_sms_alert" value='no'
                                                                   checked> No
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
                                <a href="javascript:void(0);"
                                   class="btn btn-primary continue-btn tckt-del-btn">Delete</a>
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