<style>
    .avatar > img {
        border-radius: 50%;
        display: block;
        overflow: hidden;
        width: 100%;
        height: 40px;
    }
    .no_after_dropdown .dropdown-toggle::after{display: none;}
    table.table td h2 a{
        white-space: normal; word-break: break-word;
    }
    .user_groups_area .dash-widget-icon{
        display: block;
        max-width: 50px;
        width: 100%;
        height: 50px;
        margin: 0 auto 15px;
        text-align: center;
        float: unset;
        line-height: 1.5;
    }
    .user_groups_area{overflow: hidden;}
    .user_groups_area .dash-widget-info{text-align: center;}
    .user_groups_area .card-body{min-height: 185px;}
    .user_groups_area li{
        float: left;
        width: calc(100%/6);
        padding: 0 15px;
    }
    .user_groups_area li .card.dash-widget{min-height: 205px;}
    @media screen and (max-width: 768px) {
        .user_groups_area li{width: calc(100%/4);}
    }
    @media screen and (max-width: 414px) {
        .user_groups_area li{width: 100%;}
    }
    .table-nowrap thead th:nth-child(2){
        width: 150px;
    }
    @media screen and (min-width: 1500px) {
        .table-nowrap thead th:nth-child(2){
            width: auto;
        }
    }

    @media screen and (max-width: 786px){
        #line-charts {
            max-height: 412px;
        }
    }
</style>
<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Welcome Admin!</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active">Dashboard</li>
            </ul>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <!-- <span class="dash-widget-icon"></span> -->
               <span class="dash-widget-icon">
                    <img src="<?php echo base_url();?>assets/icons/network_icon.png" class="img-fluid"/>
                </span>
                <div class="dash-widget-info">
                    <h3><?php echo $hospital_networks[0]["_CNT"];?></h3>
                    <span><a href="javascript:;">Network</a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-hospital-o"></i></span>
                <div class="dash-widget-info">
                    <h3><?php echo (isset($firstRowCounts[0]["hosp_counts"]) ? $firstRowCounts[0]["hosp_counts"] : 0);?></h3>
                    <span><a href="<?php echo base_url('institute/Hview'); ?>" target="_blank">Clinic</a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon">
                    <img src="<?php echo base_url();?>assets/icons/laboratory_icon.png" class="img-fluid"/>
                </span>
                <div class="dash-widget-info">
                    <h3><?php echo (isset($firstRowCounts[0]["lab_counts"]) ? $firstRowCounts[0]["lab_counts"] : 0);?></h3>
                    <span><a href="<?php echo base_url('laboratory/Labview'); ?>" target="_blank">Laboratory</a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon">
                    <img src="<?php echo base_url();?>assets/icons/cancer_service_icon.png" class="img-fluid"/>
                </span>
                <div class="dash-widget-info">
                    <h3><?php echo (isset($firstRowCounts[0]["cancer_counts"]) ? $firstRowCounts[0]["cancer_counts"] : 0);?></h3>
                    <span><a href="<?php echo base_url('auth/dashoardDetails?group_type=CS'); ?>" target="_blank">Cancer Service</a></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mb-4">
        <h4 class="display-5">User Groups</h4>
    </div>
</div>

<div class="row user_groups_area">
    <ul class="list-unstyled">

        <li>
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url()?>assets/icons/admin.svg" class="img-fluid">
                    </span>
                    <div class="dash-widget-info">
                        <h3>4</h3>
                        <!-- <span><a href="<?php echo base_url();?>index.php?group_id=1">System Admin</a></span> -->
                        <span><a href="<?php echo base_url();?>admin/usergroups/1/system-admin">System Admin</a></span>
                    </div>
                </div>
            </div>
        </li>
        
        <li>
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url()?>assets/icons/members.svg" class="img-fluid">
                    </span>
                    <div class="dash-widget-info">
                        <h3>1</h3>
                        <!-- <span><a href="<?php echo base_url();?>index.php?group_id=2">Members</a></span> -->
                        <span><a href="<?php echo base_url();?>admin/usergroups/2/members">Members</a></span>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url()?>assets/icons/pathologist.svg" class="img-fluid">
                    </span>
                    <div class="dash-widget-info">
                        <h3>2</h3>
                        <!-- <span><a href="<?php echo base_url();?>index.php?group_id=6">Pathologist</a></span> -->
                        <span><a href="<?php echo base_url();?>admin/usergroups/6/pathologist">Pathologist</a></span>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url()?>assets/icons/pathology_secretary.svg" class="img-fluid">
                    </span>
                    <div class="dash-widget-info">
                        <h3>0</h3>
                        <!-- <span><a href="<?php echo base_url();?>index.php?group_id=14">Hospital Secretary</a></span> -->
                        <span><a href="<?php echo base_url();?>admin/usergroups/14/hospital-secretary">Hospital Secretary</a></span>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url()?>assets/icons/clinician.svg" class="img-fluid">
                    </span>
                    <div class="dash-widget-info">
                        <h3>0</h3>
                        <!-- <span><a href="<?php echo base_url();?>index.php?group_id=33">Clinician</a></span> -->
                        <span><a href="<?php echo base_url();?>admin/usergroups/33/clinician">Clinician</a></span>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url()?>assets/icons/requester.svg" class="img-fluid">
                    </span>
                    <div class="dash-widget-info">
                        <h3>0</h3>
                        <!-- <span><a href="<?php echo base_url();?>index.php?group_id=45">Requestor</a></span> -->
                        <span><a href="<?php echo base_url();?>admin/usergroups/45/requestor">Requestor</a></span>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url()?>assets/icons/hospital_admin.svg" class="img-fluid">
                    </span>
                    <div class="dash-widget-info">
                        <h3>0</h3>
                        <!-- <span><a href="<?php echo base_url();?>index.php?group_id=47">Hospital Admin</a></span> -->
                        <span><a href="<?php echo base_url();?>admin/usergroups/47/hospital-admin">Hospital Admin</a></span>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url()?>assets/icons/network_admin.svg" class="img-fluid">
                    </span>
                    <div class="dash-widget-info">
                        <h3>0</h3>
                        <!-- <span><a href="<?php echo base_url();?>index.php?group_id=61">Network Admin</a></span> -->
                        <span><a href="<?php echo base_url();?>admin/usergroups/61/network-admin">Network Admin</a></span>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url()?>assets/icons/hospital_accounts.svg" class="img-fluid">
                    </span>
                    <div class="dash-widget-info">
                        <h3>0</h3>
                        <!-- <span><a href="<?php echo base_url();?>index.php?group_id=63">Hospital Accounts</a></span> -->
                        <span><a href="<?php echo base_url();?>admin/usergroups/63/hospital-accounts">Hospital Accounts</a></span>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url()?>assets/icons/pathology_secretary.svg" class="img-fluid">
                    </span>
                    <div class="dash-widget-info">
                        <h3>0</h3>
                        <!-- <span><a href="<?php echo base_url();?>index.php?group_id=64">Pathology Secretary</a></span> -->
                        <span><a href="<?php echo base_url();?>admin/usergroups/64/pathology-secretary">Pathology Secretary</a></span>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url()?>assets/icons/lab_system_admin.svg" class="img-fluid">
                    </span>
                    <div class="dash-widget-info">
                        <h3>0</h3>
                        <!-- <span><a href="<?php echo base_url();?>index.php?group_id=65">Lab System Admin</a></span> -->
                        <span><a href="<?php echo base_url();?>admin/usergroups/65/lab-system-admin">Lab System Admin</a></span>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url()?>assets/icons/lab_data_entry.svg" class="img-fluid">
                    </span>
                    <div class="dash-widget-info">
                        <h3>0</h3>
                        <!-- <span><a href="<?php echo base_url();?>index.php?group_id=66">Lab Data Entry</a></span> -->
                        <span><a href="<?php echo base_url();?>admin/usergroups/66/lab-data-entry">Lab Data Entry</a></span>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url()?>assets/icons/lab_scientist.svg" class="img-fluid">
                    </span>
                    <div class="dash-widget-info">
                        <h3>0</h3>
                        <!-- <span><a href="<?php echo base_url();?>index.php?group_id=67">Lab Scientist</a></span> -->
                        <span><a href="<?php echo base_url();?>admin/usergroups/67/lab-scientist">Lab Scientist</a></span>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url()?>assets/icons/lab_accounts.svg" class="img-fluid">
                    </span>
                    <div class="dash-widget-info">
                        <h3>0</h3>
                        <!-- <span><a href="<?php echo base_url();?>index.php?group_id=68">Lab Accounts</a></span> -->
                        <span><a href="<?php echo base_url();?>admin/usergroups/68/lab-accounts">Lab Accounts</a></span>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>

<!-- <div class="row">

    <?php 
    $getgroups = getRecords("*","groups",array("type_cate"=>"category"));
    foreach($getgroups as $rec){



     ?>
<div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <?php //$hospital_group_id = getAllUsersGroups('H');

                $getcount = getRecords("COUNT(*) AS TOTROWS","users",array("user_type"=>$rec->group_type));
                ?>
                <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
                <div class="dash-widget-info">
                    <h3><?php echo $getcount[0]->TOTROWS; ?></h3>
                    <span><a href="<?php echo base_url('index.php?group_id=' . $rec->id); ?>"><?php echo $rec->name?></a></span>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div> -->
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 text-center">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Total Revenue</h3>
                        <div id="bar-charts"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Sales Overview</h3>
                        <div id="line-charts"></div>
                    </div>
                </div>
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
                            <span class="d-block">Unpublished Records</span>
                        </div>
                        <div>
                            <span class="text-success">+<?php echo  round(floor($totalreportsCurrentYear[1]['TOTROWS'] / $totalreports[1]['TOTROWS'] * 100),2); ?>%</span>
                        </div>
                    </div>
                    <h3 class="mb-3"><?php echo  $totalreports[1]['TOTROWS'] ?></h3>
                    <div class="progress mb-2" style="height: 5px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo  $totalreportsCurrentYear[1]['TOTROWS'] / $totalreports[1]['TOTROWS'] * 100 ?>%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mb-0">Current Year <?php echo  $totalreportsCurrentYear[1]['TOTROWS'] ?></p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="d-block">Published Records</span>
                        </div>
                        <div>
                            <span class="text-success">+<?php echo  round(floor($totalreportsCurrentYear[0]['TOTROWS'] / $totalreports[0]['TOTROWS'] * 100),2); ?>%</span>
                        </div>
                    </div>
                    <h3 class="mb-3"><?php echo  $totalreports[0]['TOTROWS'] ?></h3>
                    <div class="progress mb-2" style="height: 5px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo  $totalreportsCurrentYear[0]['TOTROWS'] / $totalreports[0]['TOTROWS'] * 100 ?>%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mb-0">Current Year <span class="text-muted"><?php echo  $totalreportsCurrentYear[0]['TOTROWS'] ?></span></p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="d-block">Further Work</span>
                        </div>
                        <div>
                            <span class="text-danger"><?php echo  round(($totalfurthercase[0]['TOTROWS'] / $totalfurthercasecurryear[0]['TOTROWS'] * 100),2); ?>%</span>
                        </div>
                    </div>
                    <h3 class="mb-3"><?php echo  $totalfurthercase[0]['TOTROWS'] ?></h3>
                    <div class="progress mb-2" style="height: 5px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo  $totalfurthercase[0]['TOTROWS'] / $totalfurthercasecurryear[0]['TOTROWS'] * 100 ?>%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mb-0">Current Year <span class="text-muted"><?php echo  $totalfurthercasecurryear[0]['TOTROWS'] ?></span></p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="d-block">TAT 10 days</span>
                        </div>
                    </div>
                    <h3 class="mb-3"><?php echo  $tatmorethanten[0]['TOTROWS'] ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Statistics Widget -->
<div class="row">
    <div class="col-md-6 col-lg-6 col-xl-4 d-flex">
        <div class="card flex-fill dash-statistics">
            <div class="card-body">
                <h5 class="card-title">Statistics</h5>
                <div class="stats-list">
                    <div class="stats-info">
                        <p>Today Leave <strong>4 <small>/ <?php echo $totalNoAdmin;?></small></strong></p>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="stats-info">
                        <p>Pending Invoice <strong>15 <small>/ 92</small></strong></p>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="stats-info">
                        <p>Completed Projects <strong>85 <small>/ 112</small></strong></p>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="stats-info">
                        <p>Open Tickets <strong>190 <small>/ 212</small></strong></p>
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="stats-info">
                        <p>Closed Tickets <strong>22 <small>/ 212</small></strong></p>
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (!empty($task_stats)): ?>
        <?php $this->load->view('tasks/widgets/task_stats', ['task_stats' => $task_stats]); ?>
    <?php endif; ?>
    <div class="col-md-6 col-lg-6 col-xl-4 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <h4 class="card-title">Today Absent <span class="badge bg-inverse-danger ml-2">5</span></h4>
                <div class="leave-info-box">
                        <a href="profile.html" class="avatar"><img alt="" src="<?php echo base_url() ?>assets/img/dummy-doctors.jpg"></a>
                    <div class="media align-items-center">
                        <div class="media-body">
                            <div class="text-sm my-0">Martin Lewis</div>
                        </div>
                    </div>
                    <div class="row align-items-center mt-3">
                        <div class="col-6">
                            <h6 class="mb-0">4 Sep 2020</h6>
                            <span class="text-sm text-muted">Leave Date</span>
                        </div>
                        <div class="col-6 text-right">
                            <span class="badge bg-inverse-danger">Pending</span>
                        </div>
                    </div>
                </div>
                <div class="leave-info-box">
                    <div class="media align-items-center">
                        <a href="profile.html" class="avatar dashboard_admin"><img alt="" src="<?php echo base_url() ?>assets/img/dummy-doctors.jpg"></a>
                        <div class="media-body">
                            <div class="text-sm my-0">Edwina Ross</div>
                        </div>
                    </div>
                    <div class="row align-items-center mt-3">
                        <div class="col-6">
                            <h6 class="mb-0">14 Oct 2020</h6>
                            <span class="text-sm text-muted">Leave Date</span>
                        </div>
                        <div class="col-6 text-right">
                            <span class="badge bg-inverse-success">Approved</span>
                        </div>
                    </div>
                </div>
                <div class="load-more text-center">
                    <a class="text-dark" href="javascript:void(0);">Load More</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 d-flex">
        <div class="card card-table flex-fill">
            <div class="card-header">
                <h3 class="card-title mb-0">Invoices</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-nowrap custom-table mb-0">
                        <thead>
                        <tr>
                            <th>Invoice ID</th>
                            <th>Hospitals</th>
                            <th>Due Date</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><a href="<?php echo base_url();?>billing/view_invoice">#INV-0001</a></td>
                            <td>
                                <h2><a href="#">Dubai National Healthcare</a></h2>
                            </td>
                            <td>11 Mar 2020</td>
                            <td>&pound;380</td>
                            <td>
                                <span class="badge bg-inverse-warning">Partially Paid</span>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="<?php echo base_url();?>billing/view_invoice">#INV-0002</a></td>
                            <td>
                                <h2><a href="#">Ingrid Institute of Medicine</a></h2>
                            </td>
                            <td>8 Feb 2020</td>
                            <td>&pound;500</td>
                            <td>
                                <span class="badge bg-inverse-success">Paid</span>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="<?php echo base_url();?>billing/view_invoice">#INV-0003</a></td>
                            <td>
                                <h2><a href="#">Texas Medical Center</a></h2>
                            </td>
                            <td>23 Jan 2020</td>
                            <td>&pound;60</td>
                            <td>
                                <span class="badge bg-inverse-danger">Unpaid</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="invoices.html">View all invoices</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 d-flex">
        <div class="card card-table flex-fill">
            <div class="card-header">
                <h3 class="card-title mb-0">Payments</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table custom-table table-nowrap mb-0">
                        <thead>
                        <tr>
                            <th>Invoice ID</th>
                            <th>Hospitals</th>
                            <th>Payment <br> Type</th>
                            <th>Paid <br>Date</th>
                            <th>Paid <br>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><a href="<?php echo base_url();?>billing/view_invoice">#INV-0001</a></td>
                            <td>
                                <h2><a href="#">Dubai National Healthcare</a></h2>
                            </td>
                            <td>Paypal</td>
                            <td>11 Mar 2020</td>
                            <td>&pound;380</td>
                        </tr>
                        <tr>
                            <td><a href="<?php echo base_url();?>billing/view_invoice">#INV-0002</a></td>
                            <td>
                                <h2><a href="#">Ingrid Institute of Medicine</a></h2>
                            </td>
                            <td>Paypal</td>
                            <td>8 Feb 2020</td>
                            <td>&pound;500</td>
                        </tr>
                        <tr>
                            <td><a href="<?php echo base_url();?>billing/view_invoice">#INV-0003</a></td>
                            <td>
                                <h2><a href="#">Texas Medical Center</a></h2>
                            </td>
                            <td>Paypal</td>
                            <td>23 Jan 2020</td>
                            <td>&pound;60</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="payments.html">View all payments</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 d-flex">
        <div class="card card-table flex-fill">
            <div class="card-header">
                <h3 class="card-title mb-0">Hospitals</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table custom-table mb-0 no_after_dropdown">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($gethospitals as $rec) { ?>
                            <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar dashboard_admin"><img alt="" src="https://mskcc.uralensisdigital.co.uk/uploads/Avatar-03.png"></a>
                                        <a href="#client-profile"><?php echo  $rec->description ?> <span><?php echo  $rec->first_name ?></span></a>
                                    </h2>
                                </td>
                                <td><?php echo  $rec->email ?></td>
                                <?php
                                $status = "";
                                if ($rec->user_status == "true")
                                    $status = "Active";
                                else
                                    $status = "Inactive";
                                ?>
                                <td>
                                    <div class="dropdown action-label">
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-dot-circle-o text-success"></i> <?php echo get_user_status($rec->status); ?>
                                        </a>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="<?php echo  base_url() ?>auth/edit_user/<?php echo  $rec->userid ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?php echo site_url('Auth/index'); ?>">View all Users</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 d-flex">
        <div class="card card-table flex-fill">
            <div class="card-header">
                <h3 class="card-title mb-0">Recent Published Cases</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table custom-table mb-0">
                        <thead>
                        <tr>
                            <th>UL No.</th>
                            <th>Client Clinic</th>
                            <th>Request Datetime</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($getpublishedcases as $rec) {
                            ?>
                            <tr>
                                <td>
                                    <h2><?php echo  $rec->serial_number ?></h2>
                                </td>
                                <td>
                                    <?php echo  $rec->name ?>
                                </td>
                                <td><?php echo  date("d,M,Y h:m", strtotime($rec->request_datetime)) ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--<div class="card-footer">
                <a href="projects.html">View all projects</a>
            </div>-->
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 d-flex">
        <div class="card card-table flex-fill">
            <div class="card-header">
                <h3 class="card-title mb-0">Users</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table custom-table no_after_dropdown mb-0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Login</th>
                            <th>IP</th>
                            <th>Status</th>
<!--                            <th class="text-right">Action</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($usersLogins as $uDetail){?>
                            <tr>
                                <?php
                                $user_detail = base64_encode($uDetail->session_userid."___".$uDetail->client_ip);
                                ?>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar dashboard_admin">
                                            <img alt="" class="profile-pic"
                                                 src="<?php echo get_profile_picture($uDetail->profile_picture_path, $uDetail->first_name, $uDetail->last_name); ?>"></a>
                                        <a href="<?php echo base_url()."/admin/";?>getLoginDetail/<?php echo $user_detail;?>"><?php echo  $uDetail->first_name ?> <span><?php echo  $this->ion_auth->get_users_groups($uDetail->session_userid )->row()->description; ?></span></a>                                    </h2>
                                </td>
                                <td><?php echo date("d-M-Y h:i A",$uDetail->login_time); ?></td>
                                <td><?php echo  $uDetail->client_ip ?></td>
                                <?php
                                $innerText=$innerClass=$toolText="";
                                if($uDetail->remember==0){
                                    $innerText = "New IP";
                                    $innerClass = "warning";
                                    $toolText = "A new sign on has been detected but not verified";
                                }else if($uDetail->remember==1){
                                    $innerText = "Approved IP";
                                    $innerClass = "success";
                                    $toolText = "New sign on verified by user";
                                } else {
                                    $innerText = "Reported IP";
                                    $innerClass = "danger";
                                    $toolText = "New sign no not recognised by user";
                                }
                                ?>
                                <td>
                                    <div class="dropdown action-label">
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-dot-circle-o text-<?php echo $innerClass;?>"></i> <?php echo $innerText; ?>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?php echo site_url('admin/allLoginUsers'); ?>">View all Users</a>
            </div>
        </div>
    </div>
</div>