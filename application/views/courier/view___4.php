<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$courierStatus = array(
    NEW_COURIER,
    READY_PRINT,
    ORDER_CREATED,
    LABEL_PRINTED,
    MANIFESTED,
    COLLECTED,
    AT_DEPOT,
    IN_TRANSIT,
    DELIVERED,
    NEWSTATUS, 
    ACKNOWLEDGE
);
?>

<style type="text/css">
.form-group {
    margin-bottom: 0.2rem;
}
    .choose_courier_comp a, .choose_urgency a, .choose_unit a {
        background: #fff;
        color: #333;
        border-color: #ddd
    }

    .img-circle {
        border-radius: 50%;
    }

    .pagination > li > a, .pagination > li > span {
        color: #222
    }

    .nav-pills .nav-link {
        background: #5e5e5e;
        color: #fff;
        min-width: 150px;
        text-align: center;
        margin-right: 15px;
        font-size: 13px;
    }

    img {
        vertical-align: top
    }

    .filters_list li a, a.table_icon {
        color: #222;
        border: 1px solid #ccc;
        border-radius: 50%;
        padding: 5px;
        font-weight: bold;
        line-height: 1;
        width: 40px;
        height: 40px;
        text-align: center;
        display: inline-block;
        font-size: 24px;
        line-height: 1.25;
    }

    a.table_icon.filter_icon {
        font-size: 24px;
        line-height: 1.5;
        margin-right: 5px;
    }

    a.table_icon:hover,
    a.table_icon:focus,
    .filters_list li a:focus,
    .filters_list li a:hover {
        background: #007bff;
        color: #fff;
        border-color: #007bff;
    }
    .active_filter_btn{
        background: #007bff;
        color: #fff;
        border-color: #007bff;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        
    }
    .active_filter_btn a{
        color: #fff !important;
        border: 1px solid #007bff !important;
    }
    .upload-file-box {
        border: 1px solid #dfdfdf;
        border-radius: 5px;
        padding: 10px;
    }
    .d-block {
        font-weight: 600;
        font-size: 12px;
    }
    .enquireCaed .card-body{
	padding: 10px 1rem;
}
.enquireCaed .card-body h3{
	font-size: 16px;
}
.enquireCaed .card-body .justify-content-between, .enquireCaed .card-body .progress{
	margin-bottom: 10px !important;
}
.enquireCaed .card-body .justify-content-between div span.text-success{
    font-size: 13px;
}

.tabicon{
    margin-top: -58px;
    position: relative;
    left: 340px;
}

/* @media (min-width: 992px){
    max-width: 920px;
} */
</style>

<div class="row">
    <div class="col-lg-12">
        <?php if($this->session->flashdata('error') === true){ ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <strong><?php echo $this->session->flashdata('message');?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        <?php } ?>
        <?php if($this->session->flashdata('success') === true){ ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong><?php echo $this->session->flashdata('message');?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        <?php } ?>
    </div>
</div>

<div class="content container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col top-boxed">
                <h3 class="page-title">Courier Consignments</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url();?>">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="">Courier</a></li>
                </ul>
            </div>
            <div class="col top-boxed pull-right text-right">
                <a href=";javascript" data-toggle="modal"
                   data-target="#add_courier_modal" class="btn btn-primary btn-rounded"><i
                            class="fa fa-plus"></i> Consignment</a>
                <!--                <a href=";javascript" data-toggle="modal"-->
                <!--                   data-target="#add_courier_setup_modal" class="btn btn-primary btn-rounded"><i-->
                <!--                            class="fa fa-plus"></i> Courier</a>-->
                <a href=";javascript" data-toggle="modal"
                   data-target="#add_user_modal" class="btn btn-primary btn-rounded"><i
                            class="fa fa-plus"></i> User</a>
            </div>
        </div>
    </div>
    <div class="tg-haslayout">
        <?php
        if ($this->session->flashdata('record_status') != '') { ?>
            <p class="bg-success" style="padding:7px;"><?php echo $this->session->flashdata('record_status'); ?></p>
        <?php } ?>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_GET['msg']) && $_GET['msg'] == 'success') {

                echo '<p class="bg-success" style="padding:7px;">Success.</p>';
            }
            if ($this->session->flashdata('unpublish_record_message') != '') {
                echo $this->session->flashdata('unpublish_record_message');
            }
            ?>
        </div>
        <?php $flashData = $this->session->flashdata('sendData'); ?>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
        <input type="hidden" id="tab_id"
               value="<?php echo(isset($flashData['tab_id']) ? $flashData['tab_id'] : $tab_id); ?>">
        <input type="hidden" id="is_error" value="<?php echo($flashData['is_error'] ? 1 : 0); ?>">
        <textarea id="error_message" style="display: none"><?php echo $flashData['error_message']; ?></textarea>
    </div>

    <div class="row">
        <div class="col-md-12 top-boxed">
            <div class="card-group m-b-30 enquireCaed">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <?php
                                $totalTickets = $ticketsCountData['total'];

                                ?>
                                <span class="d-block">New Courier (Not Dispatched)</span>
                            </div>
                            <div>
                            <span class="text-success"><?php $centage = number_format(($ticketsCountData['new'] / $totalTickets) * 100, 2);
                                echo($centage == "nan" ? 0 : $centage); ?>%</span>
                            </div>
                        </div>
                        <h3 class="mb-3"><?php echo $ticketsCountData['new']; ?></h3>
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar"
                                 style="width: <?php echo $centage; ?>%;"
                                 aria-valuenow="40"
                                 aria-valuemin="0" aria-valuemax="<?php echo $totalTickets; ?>"></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <span class="d-block">Dispatched Package</span>
                            </div>
                            <div>
                            <span class="text-success"><?php $centage = number_format(($ticketsCountData['dispatch'] / $totalTickets) * 100, 2);
                                echo($centage == "nan" ? 0 : $centage); ?>%</span>
                            </div>
                        </div>
                        <h3 class="mb-3"><?php echo $ticketsCountData['dispatch'] ?></h3>
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar"
                                 style="width: <?php echo $centage; ?>%;"
                                 aria-valuenow="40"
                                 aria-valuemin="0" aria-valuemax="<?php echo $totalTickets; ?>"></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <span class="d-block">Received Package</span>
                            </div>
                            <div>
                            <span class="text-success"><?php $centage = number_format(($ticketsCountData['received'] / $totalTickets) * 100, 2);
                                echo($centage == "nan" ? 0 : $centage); ?>%</span>
                            </div>
                        </div>
                        <h3 class="mb-3"><?php echo $ticketsCountData['received'] ?></h3>
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar"
                                 style="width: <?php echo $centage; ?>%;"
                                 aria-valuenow="40"
                                 aria-valuemin="0" aria-valuemax="<?php echo $totalTickets; ?>"></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <span class="d-block">Courier Issues Log</span>
                            </div>
                            <div>
                            <span class="text-success"><?php $centage = number_format(($ticketsCountData['issue'] / $totalTickets) * 100, 2);
                                echo($centage == "nan" ? 0 : $centage); ?>%</span>
                            </div>
                        </div>
                        <h3 class="mb-3"><?php echo $ticketsCountData['issue'] ?></h3>
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar"
                                 style="width: <?php echo $centage; ?>%;"
                                 aria-valuenow="40"
                                 aria-valuemin="0" aria-valuemax="<?php echo $totalTickets; ?>"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row moble-srcoll">
        <div class="">
            <div class="card">
                <div class="card-body dash_tabs">
                    <ul class="nav nav-pills" id="courier_nav_tabs">
                        <li class="nav-item"><a class="nav-link active" href="#consignment_tab" data-toggle="tab">Consignments</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#courier_tab" data-toggle="tab">Courier</a></li>
                    </ul>
                    <div class="tab-content" >
                        <div class="tab-pane active" id="consignment_tab">
                            <?php
                            $attributes = array('id' => 'filter_courier_table');
                            echo form_open('', $attributes);

                            ?>
                            <input type="hidden" name="status" value="search">
                            <div class="row mb-3 d-flex align-content-center align-items-center">
                                <div class="col-xl-3">
                                    <input type="hidden" name="sender_search_filter" id="sender_search_filter" value="<?php echo $sender_type;?>">
                                    <ul class="list-inline list-ustyled filters_list mb-0 tabicon" >
                                        <li class="list-inline-item <?php echo($sender_type == "received" ? "active_filter_btn" : ""); ?>">
                                            <a href="javascript:;" title="Received" onclick="getCourierFilter('received')">
                                                <i class="la la-envelope"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item <?php echo($sender_type == "sent" ? "active_filter_btn" : ""); ?>">
                                            <a href="javascript:;" title="Sent"  onclick="getCourierFilter('sent')">
                                                <i class="lab la-telegram-plane"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item"  onclick="getCourierFilter('all')">
                                            <a href="javascript:;" title="Reset">
                                                <i class="la la-times"></i>
                                            </a>
                                        </li>
                                    </ul>
<!--                                     <div class=" select-focus">-->
<!--	                                    <label class="focus-label">Filter</label>-->
<!---->
<!--	                                    <select class="floating select2" name="sender_search" id="sensder_search" onchange=" document.getElementById('filter_courier_table').submit()"-->
<!--	                                            style="width: 100%">-->
<!--	                                        <option value=""> -- Select --</option>-->
<!--	                                        <option value="all" --><?php //echo($sender_type == "all" ? "selected" : ""); ?><!--All</option>
	                                        <option value="sent" --><?php //echo($sender_type == "sent" ? "selected" : ""); ?><!--Sent</option>
	                                        <option value="received" --><?php //echo($sender_type == "received" ? "selected" : ""); ?><!--Received</option>
	                                    </select>-->
<!--	                                </div>-->
                                </div>

<!--                                <div class="col-xl-5">-->
<!--                                    <div class="d-flex d-flex align-content-center align-items-center">-->
<!--                                        <div><a href="javascript:;" class="table_icon filter_icon">80</a> Entries</div>-->
<!--                                        <div>-->
<!--                                            <ul class="pagination pagination-md ml-3 mt-3">-->
<!--                                                <li class="page-item"><a class="page-link" href="#">10</a></li>-->
<!--                                                <li class="page-item active"><a class="page-link" href="#">20</a></li>-->
<!--                                                <li class="page-item"><a class="page-link" href="#">30</a></li>-->
<!--                                                <li class="page-item"><a class="page-link" href="#">All</a></li>-->
<!--                                            </ul>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-xl-4">-->
<!--                                    <div class="row d-flex d-flex align-content-center align-items-center">-->
<!--                                        <div class="col-md-12 ">-->
<!--                                            <div class="input-group ml-auto input-group-sm">-->
<!--                                                <input type="text" class="form-control form-control-lg">-->
<!--                                                <div class="input-group-prepend">-->
<!--                                                    <button class="btn btn-primary input-group-text  text-white">-->
<!--                                                        Search-->
<!--                                                    </button>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
                            </div>
                            <div class="clearfix"></div>
                            <div class="row report_listing">
                                <div class="col-md-12 courier-new">
                                    <div class="flag_message"></div>
                                    <table id="courier_listing_table"
                                           class="table table-striped custom-table" cellspacing="0"
                                           style="margin-top:40px; overflow: scroll; font-size:13px;">
                                        <thead>
                                        <tr>
                                            <th>Request No</th>
                                            <!-- <th>Batch No.</th> -->
                                           
                                            <th>Created By</th>
                                            <th>Collection Date/Time</th>
                                            
                                            <th>Sender</th>                                            
                                            <th>Receiver</th>
                                            
                                            <!--<th>Weight</th>-->
                                            <!-- <th>Urgency</th>
                                            <th>Courier</th> -->
                                            <!--                    <th>Manifest</th>-->
                                            <!--                    <th>Label</th>-->
                                            <th>Status</th>
                                            <th>Stamp Date/Time</th>
                                            <!--<th>Comments</th>-->
                                            <th>Attachment</th>
                                            <th>Request ID</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (!empty($couriers)) {
                                            $user_id = $this->ion_auth->user()->row()->id;
                                            foreach ($couriers as $row) {
                                                $generatedUserId = $this->Courier_model->generate_userids($row['created_by']);
                                                ?>
                                                <tr class="">

                                                    <td class=""><?php echo $row['initials'] . "-" . $row['courier_no']; ?></td>
                                                    <!--                            <td class="">-->
                                                    <?php //echo "BN-" . $row['batch_no']; ?><!--</td>-->
                                                    
                                                    <td class="text-center">
                                                        <?php
                                                        $userinfo = getLoggedInUserProfile(intval($row['created_by']));
                                                        ?>
                                                        <span class="user-img">
                                    <img title="<?php print $userinfo[0]->first_name.' '.$userinfo[0]->last_name; ?>" style="border-radius: 50%;width: 25px;height: 25px"
                                         src="<?php echo get_profile_picture($userinfo[0]->profile_picture_path, $userinfo[0]->first_name, $userinfo[0]->last_name); ?>"
                                         alt="<?php print $userinfo[0]->first_name.' '.$userinfo[0]->last_name; ?>">
                                </span>

                                                        <input type="hidden" id="user_edit_id<?php echo $row['id']; ?>"
                                                               data-profile="<?php echo get_profile_picture($userinfo[0]->profile_picture_path, $userinfo[0]->first_name, $userinfo[0]->last_name); ?>"
                                                               data-name="<?php echo $userinfo[0]->first_name . ' ' . $userinfo[0]->last_name; ?>"
                                                               value="<?php echo $generatedUserId; ?>">
                                                    </td>
                                                    <td class=""><?php echo($row['collection_date'] == "" ? "" : date("d-m-Y h:i a", strtotime($row['collection_date']))); ?></td>
                                                    
                                                    <td class=""><?= $row['sender_email'] . " (". $row['sender_org']. ")"; ?><i class="las fa fa-address-card" title="<?php echo "Address: ".$row['sender_address1']; ?>"></i></td>
                                                    
                                                    <td class=""><?= $row['receiver_email'] . " (". $row['receiver_org']. ")"; ?><i class="las fa fa-address-card" title="<?php echo "Address: ".$row['receiver_address1']; ?>"></i></td>
                                                    
                                                    <!--<td class=""><?php //echo $row['parcel_weight']; ?></td>-->
                                                    <!-- <td class=""><?php echo $row['urgency']; ?></td>
                                                    <td class="">
                                                         <span class="user-img">
                                                             <?php $company_logo = $row['company_logo']; ?>
                                                             <?php if ($company_logo != "") { ?>
                                                                 <img style="width: 70px;height: 40px;"
                                                                      src="<?php echo base_url("uploads/$company_logo"); ?>"
                                                                      alt="">
                                                             <?php } ?>
                                                        </span>
                                                    </td> -->

                                                    <!--                            <td></td>-->

                                                    <!--                            <td class=""><span class="badge badge-info">-->
                                                    <?php //echo $row['status']; ?><!--</span></td>-->
                                                    <td class="drop-down">
                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                           href="#"
                                                           data-toggle="dropdown" aria-expanded="false" style="font-size:12px;">
                                                            <i class="fa fa-dot-circle-o text-success"></i><?php echo $row['status']; ?>
                                                        </a>
                                                        <?php $is_admin = $this->ion_auth->is_admin(); ?>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-dot-circle-o text-info"></i>Request</a>

                                                            <?php //if ($user_id == $row['created_by'] || $user_id == $row['receiver_id'] || $is_admin) { ?>
                                                            <?php if ($user_id != $row['created_by'] || $is_admin) { ?>
                                                                <a class="dropdown-item"
                                                                   href="<?php echo site_url('addCourier/changeStatus/' . $row['id'] . "/1"); ?>"><i
                                                                            class="fa fa-dot-circle-o text-info"></i>
                                                                    <?php echo READY_PRINT; ?></a>
                                                                <a class="dropdown-item"
                                                                   href="<?php echo site_url('addCourier/changeStatus/' . $row['id'] . "/2"); ?>"><i
                                                                            class="fa fa-dot-circle-o text-info"></i>
                                                                    <?php echo ORDER_CREATED; ?></a>
                                                                <a class="dropdown-item"
                                                                   href="<?php echo site_url('addCourier/changeStatus/' . $row['id'] . "/3"); ?>"><i
                                                                            class="fa fa-dot-circle-o text-info"></i>
                                                                    <?php echo LABEL_PRINTED; ?></a>
                                                                <a class="dropdown-item"
                                                                   href="<?php echo site_url('addCourier/changeStatus/' . $row['id'] . "/4"); ?>"><i
                                                                            class="fa fa-dot-circle-o text-info"></i>
                                                                    <?php echo MANIFESTED; ?></a>
                                                                <a class="dropdown-item"
                                                                   href="<?php echo site_url('addCourier/changeStatus/' . $row['id'] . "/5"); ?>"><i
                                                                            class="fa fa-dot-circle-o text-info"></i>
                                                                    <?php echo COLLECTED; ?></a>
                                                                <a class="dropdown-item"
                                                                   href="<?php echo site_url('addCourier/changeStatus/' . $row['id'] . "/6"); ?>"><i
                                                                            class="fa fa-dot-circle-o text-info"></i>
                                                                    <?php echo AT_DEPOT; ?></a>
                                                                <a class="dropdown-item"
                                                                   href="<?php echo site_url('addCourier/changeStatus/' . $row['id'] . "/7"); ?>"><i
                                                                            class="fa fa-dot-circle-o text-info"></i>
                                                                    <?php echo IN_TRANSIT; ?></a>
                                                            <?php } ?>
                                                            <?php if ($user_id != $row['created_by'] || $is_admin) { ?>
                                                            <?php //if ($user_id == $row['sender_id'] or $user_id == $row['receiver_id'] or $is_admin) { ?>
                                                                <a class="dropdown-item"
                                                                   href="<?php echo site_url('addCourier/changeStatus/' . $row['id'] . "/8"); ?>"><i
                                                                            class="fa fa-dot-circle-o text-info"></i>
                                                                    <?php echo DELIVERED; ?></a>
                                                            <?php } ?>
                                                            <!--                            --><?php //if($user_id==$row['sender_id']){?>
                                                            <a class="dropdown-item courier_issue"
                                                               data-id="<?php echo $row['id']; ?>" data-toggle="modal"
                                                               data-target="#add_courier_comment_modal"
                                                               href=""><i
                                                                        class="fa fa-dot-circle-o text-info"></i>
                                                                <?php echo COURIERISSUE; ?></a>
                                                            <a class="dropdown-item"
                                                                href="<?php echo site_url('addCourier/changeStatus/' . $row['id'] . "/10"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-info"></i>
                                                                <?php echo NEWSTATUS; ?></a>
                                                            <a class="dropdown-item"
                                                                href="<?php echo site_url('addCourier/changeStatus/' . $row['id'] . "/11"); ?>"><i
                                                                        class="fa fa-dot-circle-o text-info"></i>
                                                                <?php echo ACKNOWLEDGE; ?></a>
                                                            
                                                        </div>
                                                    </td>
                                                    <td class="center"><?php if(strtotime($row['stamp_date'])>strtotime("2018-01-01 01:01:01")) { echo($row['stamp_date'] == "" ? "" : date("d-m-Y h:i a", strtotime($row['stamp_date']))) . '<i class="las fa fa-address-card" title="'.$row['ufirst_name']." ". $row['ulast_name'].'"/></i>'; } else { print "--";  } ?></td>
                                                    <!--<td>
                                                        <?php /*echo($row['status'] == COURIERISSUE ? $row['issue_comment'] : ""); */?>
                                                        <textarea id="text_are<?php /*echo $row['id']; */?>" style="display: none"><?/*= json_encode($row); */?></textarea>
                                                    </td>-->
                                                    <td>
                                                        <!--<a href="<?/*= base_url('laboratory/download_forms/'.$row['file_name']); */?>" ><i class="fa fa-cloud-download m-r-5"></i> <?/*= $row['file_name']; */?></a>-->
                                                            <a class="view-checklist viewCheckList_<?php echo $row['id'] ?>" href="javascript:void(0);" data-courierId="<?php echo $row['id'] ?>" data-request-filenames="<?= $row['filesnames']; ?>" data-request-filepaths="<?= $row['filespaths']; ?>" data-fileIds="<?= $row['filesIds']; ?>" data-toggle="modal" data-target="#view_checklist_items" title="View All Checklist Items"><?php echo ($row['checklist_title'] != '') ? $row['checklist_title'] : "Not Defined"; ?></a>
                                                        <!-- <?php if(!empty($row['file_name'])) {

                                                            $ext = pathinfo($row['file_name'], PATHINFO_EXTENSION);
                                                            if(in_array($ext, ['gif', 'jpg', 'png', 'jpeg', 'pdf'])){
                                                                $type=1;
                                                                $filePath = base_url('lab_uploads/'). $row['file_name'];
                                                            }else{
                                                                $type=2;
                                                                $filePath = base_url("laboratory/download_forms/").$row['file_name'];
                                                            } ?>

                                                            <?php if($type == 1){ ?>
                                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#view_document_modal" onclick="embed_document('<?= $filePath; ?>')"><?= $row['file_name']; ?></a>
                                                            <?php } else { ?>
                                                                <a href="<?= $filePath; ?>"><?= $row['file_name']; ?></a>
                                                        <?php } } ?> -->
                                                    </td>
                                                    <td>
                                                        <a class="view-request" href="javascript:void(0);" data-request-str="<?= $row['request_ids']; ?>" data-toggle="modal" data-target="#request_list_modal" title="View All Request ID"><i class="fa fa-eye m-r-5"></i></a>
                                                    </td>
                                                    <td class="text-center">
                                                        <textarea id="text_are<?= $row['id']; ?>" style="display: none"><?= json_encode($row); ?></textarea>
                                                        
                                                            
                                     <a class="edt-tckt edit_tckt_<?php echo $row['id']; ?>"
                                                                   href="javascript:void(0);" title="Edit Courier"
                                                                   data-id="<?php echo $row['id']; ?>"
                                                                   data-request-filenames="<?= $row['filesnames']; ?>"
                                                                   data-toggle="modal"
                                                                   data-target="#add_courier_modal"><i
                                                                            class="fa fa-pencil m-r-5"></i></a>
                                                                
                                                                <?php if($user_id==393) { ?>
                                                                <a class=" del-tckt" title="Delete Courier"
                                                                   href="javascript:void()"
                                                                   data-id="<?php echo $row['id']; ?>"
                                                                   data-info="<?php echo $row['id']; ?>"
                                                                   data-toggle="modal"
                                                                   data-target="#delete_ticket"><i
                                                                            class="fa fa-trash-o m-r-5"></i></a>
                                                                            <?php } ?>
                                                                <a class="" title="Track Courier Record" href="<?php echo base_url() ?>addCourier/trackCourier/<?php echo base64_encode($row['id']) ?>">
                                                                    <i class="fa fa-truck m-r-5"></i></a>
                                                                <?php if($row['stamp_date'] == '') {?> 
                                                                    <a class="" title="Set Stampdate" href="<?= base_url() ?>addCourier/stamp_date_add/<?= $row['id']; ?>"><i class="fa fa-check m-r-5"></i>  </a>
                                                                <?php } ?>
                                                        
                                                    </td>
                                                </tr>
                                            <?php }
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <input type="hidden" id="checklistBaseURL" value="<?php echo base_url(); ?>"/>
                            <?php echo form_close(); ?>
                        </div>
                        
                        <div class="tab-pane" id="courier_tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-10 form-group">
                                            <h3>Courier Companies</h3>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <a href=";javascript" data-toggle="modal"
                                               data-target="#add_company_setup_modal"
                                               class="btn btn-primary btn-rounded"><i
                                                        class="fa fa-plus"></i></a>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table custom-table table-bordered text-center">
                                                <thead>
                                                <th>Name</th>
                                                <th>Logo</th>
                                                <th>Actions</th>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($courier_companies as $company) { ?>
                                                    <tr id="row_<?php echo $company->id ?>">
                                                        <td><?php echo $company->name; ?></td>
                                                        <td>
                                                            <img src="<?php echo base_url() ?>uploads/<?php echo $company->logo; ?>"
                                                                 style="width: 70px;height: 40px;"></td>
                                                        <td>  
                                                            <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">  
                                                            <a class="dropdown-item" data-id = "<?php echo $company->id; ?>" data-name = "<?php echo $company->name; ?>" data-logo = "<?php echo base_url() ?>uploads/<?php echo $company->logo; ?>" data-prefix = "<?php echo $company->prefix; ?>" href="javascript:void(0)" onclick="update_courierCompany(this)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                            <a class="dropdown-item" href="javascript:delete_courierCompany(<?php echo  $company->id;  ?>)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                            </div></div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-10 form-group">
                                            <h3>Urgency</h3>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <a href=";javascript" data-toggle="modal"
                                               data-target="#add_urgency_setup_modal"
                                               class="btn btn-primary btn-rounded"><i
                                                        class="fa fa-plus"></i></a>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table custom-table table-bordered text-center">
                                                <thead>
                                                <th>Name</th>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($courier_urgency as $urgency) { ?>
                                                    <tr>
                                                        <td><?php echo $urgency->urgency; ?></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <div id="slide_details_modal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="padding-top: 10px;">
                    <h5 class="modal-title">Slide Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="form-group">
                        <div class="row">
                            <div class="col-md-4" id="slide_lab"></div>
                            <div class="col-md-4" id="slide_no_of_slides"></div>
                            <div class="col-md-4" id="slide_comments"></div>
                        </div>
                    </section>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div id="block_details_modal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="padding-top: 10px;">
                    <h5 class="modal-title">Block Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="form-group">
                        <div class="row">
                            <div class="col-md-4" id="block_lab"></div>
                            <div class="col-md-4" id="block_no_of_slides"></div>
                            <div class="col-md-4" id="block_comments"></div>
                        </div>
                    </section>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div id="other_details_modal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="padding-top: 10px;">
                    <h5 class="modal-title">Other Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="form-group">
                        <div class="row">
                            <div class="col-md-12" id="other_comments"></div>
                        </div>
                    </section>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- Add Ticket Modal -->
    <div id="add_courier_modal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Courier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body edt_modal_bdy">
                    <?php
//                    $attributes = array('id' => 'add_courier_form', 'enctype' => 'multipart/form-data');
//                    echo form_open('', $attributes);
                    ?>
                    <form method="post" action="<?= base_url('AddCourier/add'); ?>" enctype="multipart/form-data" id="add_courier_form">
                    <input type="hidden" name='save_type' id='save_type' value='add'/>
                    <input type="hidden" name='edit_id' id='edit_id' value=''/>
                    <input type="hidden" name='esender_id' id='esender_id' value='<?php echo intval($this->ion_auth->user()->row()->id); ?>'/>
                    <input type="hidden" name='ereceiver_id' id='ereceiver_id' value=''/>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group ">
                                <label>User ID
                                    <?php
                                    $userinfo = getLoggedInUserProfile(intval($this->ion_auth->user()->row()->id));
                                    ?>
                                    <span class="user-img">
                                    <img id="user_image_path" style="border-radius: 50%;width: 25px;height: 25px"
                                         src="<?php echo get_profile_picture($userinfo[0]->profile_picture_path, $userinfo[0]->first_name, $userinfo[0]->last_name); ?>"
                                         alt="">
                                </span>
                                    <span id="user_image_name"><?php echo $userinfo[0]->first_name . ' ' . $userinfo[0]->last_name; ?></span>
                                </label>
                                <input type="text" name="user_id" id="user_image_id"
                                       value="<?php echo $generated_user_id; ?>"
                                       class="form-control" disabled="disabled"/>
                            </div>


                        </div>
                        <div class="col-sm-4">
                            <div class="form-group ">
                                <label>Request No.</label>
                                <input type="text" name="courier_no" id="courier_no"
                                       value="<?php echo strtoupper(substr($_SESSION['first_name'], 0, 1)) . strtoupper(substr($_SESSION['last_name'], 0, 1)) . "-" . date("y") . "-" . $courier_no; ?>"
                                       class="form-control" disabled="disabled"/>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group ">
                                <label>Date</label>
                                <input type="text" id="requested_date" name="" value="<?php echo date("d-m-Y") ?>"
                                       class="form-control"
                                       disabled="disabled"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div><label class="label">Choose Urgency</label></div>
                                <!-- <select class="select2 floating" id="urgency_type" name="urgency_type" style="width: 100%">
                                    <option value=""> -- Select --</option>
                                    <option value="Fast Delivery"> Fast Delivery</option>
                                    <option value="First Class"> First Class</option>
                                    <option value="Second Class"> Second Class</option>
                                </select> -->
                                <input type="hidden" id="urgency_type" name="urgency_type" value="">
                                <div class="btn-group btn-group-sm choose_urgency">
                                    <?php foreach ($courier_urgency as $urgency) { ?>
                                        <a href="javascript:;" class="btn btn-primary btn_ugency_type <?php echo ($urgency->prefix==1?"active":""); ?>"
                                           onclick="storeValue('<?php echo $urgency->urgency; ?>','urgency_type')"
                                           data-value="<?php echo $urgency->urgency; ?>"
                                           data-title="<?php echo $urgency->urgency; ?>"><?php echo $urgency->urgency; ?></a>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div><label class="label">Courier Company</label></div>
                                <!-- <select class="select2 floating" id="urgency_type" name="urgency_type" style="width: 100%">
                                    <option value=""> -- Select --</option>
                                    <option value="Fast Delivery"> Fast Delivery</option>
                                    <option value="First Class"> First Class</option>
                                    <option value="Second Class"> Second Class</option>
                                </select> -->
                                <input type="hidden" id="courier_company" name="courier_company" value="">
                                <div class="btn-group btn-group-sm choose_courier_comp">
                                    <?php foreach ($courier_companies as $company) { ?>
                                        <a href="javascript:;" class="btn btn-primary btn_courier_company <?php echo ($company->prefix==1?"active":""); ?>"
                                           onclick="storeValue('<?php echo $company->id; ?>','courier_company')"
                                           data-value="<?php echo $company->name; ?>"
                                           data-title="<?php echo $company->id; ?>"><?php echo $company->name; ?></a>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="focus-label">Consignment No.</label>
                                <input type="text" name="consignment_no" id="consignment_no"
                                       class="form-control floating">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="focus-label">Collection Date & Time</label>

                                <!--					<input type="text" class="form-control floating" disabled="disabled">-->
                                <input class="form-control floating datepicker_new" type="text" name="collection_date"
                                       id="collection_date" value="<?php echo date("d-m-Y H:i a") ?>"
                                       readonly>
                            </div>
                        </div>
                    </div>
                    <input class="form-control floating datepicker_new" type="hidden" name="stamp_date" id="stamp_date" data-val="<?= date("d-m-Y H:i a") ?>" value="" readonly>
                    <div class="row" style="display:none" >
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="focus-label">&nbsp;</label>
                                <br>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="focus-label">Stamp Date & Time</label>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="focus-label" >Parcel Weight</label>
                                <select class="form-control floating" id="parcel_weight" name="parcel_weight">
                                    <option value="0">Between 1 to 5</option>
                                    <option value="1">Between 5 to 10</option>
                                    <option value="2">Between 10 to 100</option>
                                    <option value="3">Between 100 to 1000</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div><label class="label">Unit</label></div>
                                <input type="hidden" id="weight_unit" name="weight_unit" value="">
                                <div class="btn-group btn-group-sm choose_unit">
                                    <a href="javascript:;" class="btn btn-primary btn_weight_unit"
                                       onclick="storeValue('Gram','weight_unit')" data-value="Gram" data-title="Gram">Gram</a>
                                    <a href="javascript:;" class="btn btn-primary btn_weight_unit"
                                       onclick="storeValue('KG','weight_unit')" data-value="KG" data-title="KG">KG</a>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-5 form-group">
                            <div class=" select-focus">
                                <label class="focus-label">Sender Search</label>

                                <select class="floating courier_user_dp" name="sender_search" id="sender_search"
                                        style="width: 100%">
                                    <option value=""> -- Select --</option>
                                    <?php
                                    foreach ($user_data as $user) { ?>
                                        <option data-address="<?php echo $user->address1; ?>"
                                                data-phone="<?php echo $user->phone; ?>"
                                                data-address2="<?php echo $user->address2; ?>"
                                                title="<?php echo $user->profile_picture_path; ?>"
                                                value="<?php echo $user->user_id; ?>" <?php echo ($userinfo[0]->id == $user->user_id ? "selected" : "sss") ?>><?php echo $user->first_name . " " . $user->last_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1 form-group">
                            <a href="javascript:void(0)" class="btn btn-primary btn-rounded add_user_btn"
                               style="margin-top: 34px;">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                        <div class="col-md-5 form-group">
                            <div class=" select-focus">
                                <label class="focus-label">Receiver Search</label>

                                <select class="floating" name="receiver_search" id="receiver_search"
                                        style="width: 100%">
                                    <option value=""> -- Select --</option>
                                    <?php
                                    foreach ($user_data as $user) { ?>
                                        <option data-address="<?php echo $user->address1; ?>"
                                                data-phone="<?php echo $user->phone; ?>"
                                                data-address2="<?php echo $user->address2; ?>"
                                                title="<?php echo $user->profile_picture_path; ?>"
                                                value="<?php echo $user->user_id; ?>"><?php echo $user->first_name . " " . $user->last_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1 form-group">
                            <a href="javascript:void(0)" class="btn btn-primary btn-rounded add_user_btn"
                               style="margin-top: 34px;">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="focus-label">Organization</label>

                                <select class="floating select2" name="sender_organization" id="sender_organization"
                                        style="width: 100%">
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="focus-label">Organization</label>

                                <select class="floating select2" name="receiver_organization" id="receiver_organization"
                                        style="width: 100%">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <div class="form-group ">
                                <label class="focus-label">Sender Address</label>

                                <input type="text" class="form-control floating" id="sender_address"
                                       name="sender_address" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="form-group ">
                                <label class="focus-label">Receiver Address</label>

                                <input type="text" class="form-control floating" id="receiver_address"
                                       name="receiver_address" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <div class="form-group ">
                                <label class="focus-label">Sender Phone</label>

                                <input type="text" class="form-control floating" id="sender_phone"
                                       name="sender_phone" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="form-group ">
                                <label class="focus-label">Receiver Phone</label>

                                <input type="text" class="form-control floating" id="receiver_phone"
                                       name="receiver_phone" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="form-group ">
                                <label class="focus-label">Notes</label>
                                <textarea class="form-control floating" id="courier_notes" name="courier_notes"
                                          rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="form-group ">
                                <label class="focus-label">Checklist Title</label>
                                <input type="text" class="form-control floating" id="checklist_title"
                                       name="checklist_title">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="form-group">
                                <label class="focus-label">Upload Check List</label>
                                <span id="files_names" style="display: none;color:#007bff;font-size: 15px;"></span>
                                <div class="upload-file-box">
                                    <input type="hidden" name="file_type" value="Check List1">
                                    <input type="file" name="files[]" id="file" class="box__file" data-multiple-caption="{count} files selected" multiple/>
                                    <label for="file"><strong>Choose a file</strong></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="row extrachecklist hide">
                        <div class="col-md-12 form-group">
                            <div class="form-group">
                                <label class="focus-label">Upload Check List 2</label>
                                <div class="upload-file-box">
                                    <input type="hidden" name="file_type1" value="Check List2">
                                    <input type="file" name="files1[]" id="file1" class="box__file" data-multiple-caption="{count} files selected" />
                                    <label for="file"><strong>Choose a file</strong></label>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn tck-smbt-btn save-courier" type='submit'>Create Request</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <div id="add_courier_comment_modal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body edt_modal_bdy">
                    <?php
                    $attributes = array('id' => 'add_courier_comment_form');
                    echo form_open('', $attributes);

                    ?>
                    <input type="hidden" name='courier_id' id='courier_id' value=''/>
                    <input type="hidden" name='cstatus' id='cstatus' value=''/>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label class="focus-label">Comments.</label>
                                <textarea class="form-control floating" name="courier_comment" id="courier_comment"
                                          rows="3"></textarea>
                                <!--                                <input type="text" name="courier_comment" id="courier_comment"-->
                                <!--                                       class="form-control floating">-->
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary courier_submit" type='button'>Save</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <div id="add_company_setup_modal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Courier Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body edt_modal_bdy">
                    <div class="col-md-12">
                        <?php
                        $attributes = array('id' => 'add_courier_company_form', 'class' => 'courier_form');
                        echo form_open_multipart('', $attributes);

                        ?>
                        <input type="hidden" name="status" value="courier_company"/>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group ">
                                    <label class="focus-label">Courier Company Name</label>
                                    <input type="text" name="courier_company_name" id="courier_company_name"
                                           class="form-control floating">
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group ">
                                    <label class="focus-label">Logo</label>
                                    <input type="file" name="courier_company_logo" id="courier_company_logo"
                                           class="form-control floating">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group ">
                                    <label class="focus-label">Prefix</label>
                                    <input type="checkbox" name="courier_company_prefix" id="courier_company_prefix"
                                           class="form-control floating">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-2" style="margin-left: 45%">
                                <button class="btn btn-primary" type='submit'>Save</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="edit_company_setup_modal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Courier Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body edt_modal_bdy">
                    <div class="col-md-12">
                        <?php
                        $attributes = array('id' => 'edit_courier_company_form', 'class' => 'courier_form');
                        echo form_open_multipart('', $attributes);

                        ?>
                        <input type="hidden" name="status" value="courier_company"/>
                        <input type="hidden" name="cid" id="cid" value="0"/>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group ">
                                    <label class="focus-label">Courier Company Name</label>
                                    <input type="text" name="courier_company_name" id="edit_courier_company_name"
                                           class="form-control floating">
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group ">
                                    <label class="focus-label">Logo</label>
                                    <input type="file" name="courier_company_logo" id="edit_courier_company_logo"
                                           class="form-control floating">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group ">
                                    <label class="focus-label">Prefix</label>
                                    <input type="checkbox" name="courier_company_prefix" id="edit_courier_company_prefix"
                                           class="form-control floating">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-2" style="margin-left: 45%">
                                <button class="btn btn-primary" type='submit'>Save</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="add_urgency_setup_modal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Urgency Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body edt_modal_bdy">
                    <div class="col-md-12">
                        <?php
                        $attributes = array('id' => 'add_courier_urgency_form');
                        echo form_open('', $attributes);

                        ?>
                        <input type="hidden" name="status" value="courier_urgency"/>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label class="focus-label">Urgency</label>
                                    <input type="text" name="courier_urgency" id="courier_urgency"
                                           class="form-control floating">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group ">
                                    <label class="focus-label">Prefix</label>
                                    <input type="checkbox" name="courier_urgency_prefix" id="courier_urgency_prefix"
                                           class="form-control floating">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2" style="margin-left: 45%">
                                <button class="btn btn-primary" type='submit'>Save</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div id="request_list_modal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Request ID List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="requestIDtable">
                        <thead>
                            <th>Request ID</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="view_checklist_items" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Checkist Items</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="post" id="EditUploadedFiles" action="<?php echo base_url()?>AddCourier/addFiles" enctype="multipart/form-data">
                <input type="hidden" name="fedit_id" id="fedit_id"/>
                <div class="upload-file-box">
                                    <input type="hidden" name="file_type" value="Check List1">
                                    <input type="file" name="files[]" id="file" class="box__file" data-multiple-caption="{count} files selected" multiple="">
                                    <label for="file"><strong>Choose a file</strong></label>
                                </div>
                                <div class="submit-section" style="margin-bottom: 10px;">
                        <button class="btn btn-primary" type="submit">Upload</button>
                    </div>
                </form>
                    <table id="checklistTable" class="table table-striped">
                        <thead>
                            <th>Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="view_document_modal" class="modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="doc_embed">

                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Ticket Modal -->
    <div class="modal custom-modal fade" id="delete_ticket" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Courier</h3>
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
    <div id="add_user_modal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Courier User</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if ($group_type == "HA" or $group_type == "LA") { ?>
                        <!--                        <div class="row">-->
                        <!--                            <div class="col-md-2"><label>Show Couriers</label></div>-->
                        <!--                            <div class="col-md-2"><input type="radio" class="form-control" name="show_courier" value="1"></div>-->
                        <!--                            <div class="col-md-2"><input type="radio" class="form-control" name="show_courier" value="2"></div>-->
                        <!--                        </div>-->
                        <!---->
                        <!--                        <div class="row">-->
                        <!--                            <div class="col-sm-12">-->
                        <!--                                <div class="form-group">-->
                        <!---->
                        <!--                                    <div class="row">-->
                        <!--                                        <div class="col-sm-3">-->
                        <!--                                            <label>Show Couriers</label>-->
                        <!--                                        </div>-->
                        <!--                                        <div class="col-sm-2 radio text-primary">-->
                        <!--                                            <label>-->
                        <!--                                                <input type="radio" name="show_courier_status" value="1"> <strong>ALL</strong>-->
                        <!--                                            </label>-->
                        <!--                                        </div>-->
                        <!--                                        <div class="col-sm-2 radio text-primary">-->
                        <!--                                            <label>-->
                        <!--                                                <input type="radio" name="show_courier_status" value="2">-->
                        <!--                                                <strong>Only User</strong>-->
                        <!--                                            </label>-->
                        <!--                                        </div>-->
                        <!--                                        <div class="col-sm-2 radio text-primary">-->
                        <!--                                            <button class="btn btn-primary show_courier_btn" type="button" style="margin-top: -5px">Update</button>-->
                        <!--                                        </div>-->
                        <!--                                    </div>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                    <?php } ?>
                    <?php
                    $attributes = array('id' => 'add_user_form');
                    echo form_open('', $attributes);

                    ?>
                    <div class="card mb-4 ac-card">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <button class="btn btn-primary" data-toggle="collapse" type="button"
                                        data-target="#active-directory-select-container">Active Directory
                                </button>
                            </div>
                        </div>
                        <div class="collapse" id="active-directory-select-container">
                            <div class="row">
                                <div class="col-md-8 form-group">
                                    <div class=" select-focus">
                                        <label class="focus-label">Sender Search</label>

                                        <select class="floating select2" name="active_directory_user"
                                                id="active_directory_user"
                                                style="width: 100%">
                                            <option value=""> -- Select --</option>
                                            <?php
                                            foreach ($get_active_users as $auser) { ?>
                                                <option value="<?php echo $auser['id']; ?>"><?php echo $auser['first_name'] . " " . $auser['last_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success btn_add_courier" type="button">Add Users</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Ticket Modal -->
    <div class="modal custom-modal fade" id="delete_company_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Courier Company</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary continue-btn companty-delete-btn">Delete</a>
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

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.view-request', function (e){
            e.preventDefault();
            let reqStr = $(this).attr('data-request-str');
            $('#requestIDtable > tbody').html('');
            if(reqStr.length > 0){
                let reqArr = reqStr.split(',');
                if(reqArr.length > 0){
                    $.each(reqArr, function (i, req) {
                        let id = req.split('|')[0];
                        let title = req.split('|')[1];
                        let aTagHtml = '<a taget="_blank" href="<?php echo base_url('doctor/doctor_record_detail_old/'); ?>'+ id +'">'+ title +'</a>';
                        $('#requestIDtable > tbody:last-child').append('<tr><td>'+ aTagHtml +'</td></tr>');
                    });
                }else{
                    $('#requestIDtable > tbody').html('<tr><td style="color: red;">No record found</td></tr>');
                }
            }else{
                $('#requestIDtable > tbody').html('<tr><td style="color: red;">No record found</td></tr>');
            }
        });

        $(document).on('click', '.deleteChecklistFile', function(){
            if(confirm("Are you sure you want delete this?")){
                var fid = $(this).attr("data-fid");
                var cid= $(this).attr("data-cid");
                $.ajax({
                    url: _base_url + "AddCourier/deleteChecklistFile",
                    type: "POST",
                    global: false,
                    data: {
                        fid: fid,
                        cid : cid,
                        [csrf_name]: csrf_hash,
                    },
                    dataType : 'json',
                    success: function (data) {
                        if(data.status === 'success'){
                            $('.filerow_'+fid).remove();
                            
                            if(data.filesnames === null) data.filesnames = '';
                            if(data.filespaths === null) data.filespaths = '';
                            if(data.filesIds === null) data.filesIds = '';
                            $('.viewCheckList_'+cid).attr("data-request-filenames", data.filesnames);
                            $('.viewCheckList_'+cid).attr("data-request-filepaths", data.filespaths);
                            $('.viewCheckList_'+cid).attr("data-fileids", data.filesIds);
                            $.sticky("File has been deleted successfully!!!", {
                                classList: 'success',
                                speed: 200,
                                autoclose: 7000
                            });    
                        }else{
                            $.sticky("Something went wrong. Please try again!!!", {
                                classList: 'important',
                                speed: 200,
                                autoclose: 7000
                            });   
                        }
                        
                    },
                });
            }
        })

        $(document).on('click', '.view-checklist', function (e){
            e.preventDefault();
            AppendFiles(this)
        });
        $("#EditUploadedFiles").on('submit',(function(e) {
            e.preventDefault();
            var cid = $('#fedit_id').val();
            $.ajax({
                url: base_url+"AddCourier/addFiles",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                dataType : "json",
                success: function(data)
                {
                    $('.viewCheckList_' + cid).attr("data-request-filenames",data.fileInfo.filesnames).attr("data-request-filepaths",data.fileInfo.filespaths).attr("data-fileIds",data.fileInfo.filesIds);
                    $('.edit_tckt_' + cid).attr("data-request-filenames",data.fileInfo.filesnames);
                    // $('#view_checklist_items').modal('hide');
                    setTimeout(() => {
                        AppendFiles( $('.viewCheckList_' + cid));
                        $.sticky("File has been uploaded successfully!!!", {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        }); 
                    }, 100);
                    
                },
                error: function(e) 
                {
                    $.sticky("Something went wrong. Please try again!", {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        }); 
                }          
            });
        }));
    });

    function AppendFiles(row){
        let reqfiles = $(row).attr('data-request-filenames');
        let reqpaths = $(row).attr('data-request-filepaths');
        let fileIds = $(row).attr('data-fileIds');
        let courierId = $(row).attr('data-courierId');
        $('#fedit_id').val(courierId);
        $('#checklistTable > tbody').html('');
        if(reqfiles.length > 0){
            let reqfilesArr = reqfiles.split(',');
            let reqfilesIdsArr = fileIds.split(',');
            if(reqfilesArr.length > 0){
                $.each(reqfilesArr, function (i, req) {
                    console.log(req,"sdfdf");
                    let fileExtension = req.split('.')[1];
                    var extensions = ['gif', 'jpg', 'png', 'jpeg', 'pdf'];
                    var viewAction = '';
                    var downloadAction = ''
                    if(extensions.includes(fileExtension)){
                        var base_url = $('#checklistBaseURL').val()+'lab_uploads/'+req;
                        downloadAction = '<a href="'+base_url+'" download><i class="fa fa-download m-r-5"></i></a>';
                        viewAction = '<a href="javascript:void(0);" class="ViewFile"  data-href="'+base_url+'"><i class="fa fa-eye m-r-5"></i></a>'
                    }else{
                        var base_url = $('#checklistBaseURL').val()+'laboratory/download_forms/'+req;
                        downloadAction = '<a href="'+base_url+'" download><i class="fa fa-download m-r-5"></i></a>';
                        viewAction = '<a href="'+base_url+'"><i class="fa fa-eye m-r-5"></i></a>'
                    }
                    // let title = req.split('|')[1];
                    let aTagHtml = '<tr class="filerow_'+reqfilesIdsArr[i]+'">\
                    <td>'+req+'</td>\
                    <td>'+viewAction+downloadAction+'<a href="javascript:void(0)" class="deleteChecklistFile" data-cid="'+courierId+'" data-fid="'+reqfilesIdsArr[i]+'"><i class="fa fa-trash m-r-5"></i></a></td></tr>';
                    // let aTagHtml = '<a taget="_blank" href="<?php echo base_url('doctor/doctor_record_detail_old/'); ?>'+ id +'">'+ title +'</a>';
                    $('#checklistTable > tbody:last-child').append(aTagHtml);
                });
            }else{
                $('#checklistTable > tbody').html('<tr><td style="color: red;">No record found</td></tr>');
            }
        }else{
            $('#checklistTable > tbody').html('<tr><td style="color: red;">No record found</td></tr>');
        }
    }
</script>

<script type="text/javascript">
    $(function(){
        $(document).on('click', '.ViewFile', function(){
                var fileUrl = $(this).attr('data-href');
                let embed_div = document.getElementById('doc_embed');
                embed_div.innerHTML="";
                embed_div.innerHTML = "<embed src='"+ fileUrl +"' name='embeded_doc' type='application/pdf' frameborder='0' width='100%' height='400px'>";
                $('#view_document_modal').modal("show");
            });
    });
    function embed_document(file_name){
        let embed_div = document.getElementById('doc_embed');
        embed_div.innerHTML="";
        embed_div.innerHTML = "<embed src='"+ file_name +"' name='embeded_doc' type='application/pdf' frameborder='0' width='100%' height='400px'>";
    }
</script>