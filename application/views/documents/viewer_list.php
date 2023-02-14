<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet" />
<style type="text/css">
    .page-header {
        margin:0 0 1.875rem;
        border-bottom:0px;
    }
    .content{background: #f5f5f5}
    
    div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top:-58px;
        height: 37px !important;
        width: 50px !important;
        left: 29px;
        padding:0;
    }
    /*div.dataTables_wrapper div.dataTables_filter{display: none !important}*/
    .edit_icon {
        background: #e5e5e5;
        width: 30px;
        height: 30px;
        text-align: center;
        line-height: 1.7;
        font-size: 18px;
        border-radius: 15px;
        cursor: pointer;
        color: #000;
    }
    div.dataTables_wrapper div.dataTables_filter label{
    margin: 0;
        }

        .tg-searchrecordhold{padding: 0;}

    .user_image{
        width: 50px;
        border-radius: 30px;
    }
    div.dataTables_wrapper div.dataTables_filter {
        position: relative;
        top: -52px;
        right: 60px;
        max-width: 210px;
        float: right;
    }
    div.dataTables_wrapper div.dataTables_filter input{
        border-radius: 4px;
        height: 37px !important;
    }
    div.dataTables_wrapper div.dataTables_filter:before {
        content: "\f002";
        position: absolute;
        right: 0;
        top: 0;
        bottom: 0;
        width: 40px;
        z-index: 9;
        background: #55ce63;
        text-align: center;
        line-height: 2;
        color: #fff;
        font-family: 'FontAwesome';
        cursor: pointer;
    }
    .dataTables_wrapper .row:first-child{height: 1px;}
    
    .doct_pic_table{
        width: 40px;
        float: left;
        border-radius: 20px;
        margin-right: 5px;
    }
    .table.custom-table .dropdown-menu .dropdown-item{font-size: 14px;}
    .ubpub_pic{width: 25px; margin: 0 auto;}
    .record_id_unpublish:focus{outline: none;}
    .user-menu.nav > li > a > img{padding-top: 19px;}
    #admin_display_records.table > thead > tr > th:last-child,
    #admin_display_records.table > tbody > tr > td:last-child{
        text-align: right;
    }
    div.dataTables_wrapper div.dataTables_length select{
        padding: 0 10px;
    }
    .tg-cancel input{
        display: none;
    }

    .tg-cancel label i {
        color: red;
    }

    .tg-cancel label {
        cursor: pointer;
        margin-bottom: 0;
        width: 40px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 50%;
        margin-left: 2px;
    }
    div.dataTables_wrapper .dataTables_filter {
        display: block !important;
    }
    @media screen and (min-width: 1480px){
        div.dataTables_wrapper div.dataTables_filter{
            top:-58px;
            right: 70px;
        }
    }
    .tg-statusbar.tg-flagcolor .tg-checkboxgroup .tg-radio label{font-size: 14px;}
    .tg-filters > li.last .adv-search{line-height: 1.5;}
</style>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Document Viewer</h3>
        </div>
        <div class="col-auto float-right ml-auto">
            <div class="tg-breadcrumbarea tg-searchrecordhold">
                <?php echo $breadcrumbs; ?>
            </div>
            <a href="<?= base_url('documents/'); ?>" class="btn add-btn"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
</div>
<!-- /Page Header -->
<div class="">
    <table class="table custom-table table-striped datatables" id="document-table" style="width: 100%;">
        <thead>
        <tr>
            <th>No</th>
            <th>Document</th>
            <th>Type</th>
            <th>Viewer Name</th>
            <th>Organization</th>
            <th>Viewed AT</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        if (!empty($viewer_list)) {
            foreach ($viewer_list as $row) { ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row->file_name; ?></td>
                    <td><?= $row->file_type; ?></td>
                    <td><?= $row->last_name." ".$row->first_name; ?></td>
                    <td><?= $row->group_name; ?></td>
                    <td><?= date('d/m/Y H:i:s', strtotime($row->created_at)); ?></td>
                </tr>
                <?php $no++; } } else { echo '<tr><td colspan="6" class="text-center" style="font-weight: bold; color: red;"> No record found</td></tr>'; } ?>
        </tbody>
    </table>
</div>