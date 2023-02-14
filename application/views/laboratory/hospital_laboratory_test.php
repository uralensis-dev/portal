<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    /*div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top: -62px;
        height: 37px !important;
        width: 50px !important;
        left: 29px;
        padding: 0;
    }*/
    .select2-container .select2-selection--single, .select2-container {
        height: 40px !important;
    }

    table.dataTable thead > tr > th.sorting_asc, table.dataTable thead > tr > th.sorting_desc, table.dataTable thead > tr > th.sorting, table.dataTable thead > tr > td.sorting_asc, table.dataTable thead > tr > td.sorting_desc, table.dataTable thead > tr > td.sorting {
        padding-right: 15px !important
    }

    .select2-container .select2-selection--multiple .select2-selection__rendered {
        height: unset !important
    }

    .custome_BTN label:focus {
        background: #006df1;
        color: #fff !important;
        border-color: #006df1;
    }

    .breadcrumb {
        padding: 0 !important
    }

    .tg-cancel input {
        display: none;
    }

    .tg-cancel label i {
        color: red;
    }

    .tg-cancel label {
        cursor: pointer;
        margin-bottom: 0;
        width: 45px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 50%;
    }

    div.dataTables_wrapper div.dataTables_length select {
        padding: 5px 10px !important;
    }

    @media screen and (min-width: 1600px) {
        body {
            font-size: 18px;
        }
    }

    .select2-container--default .select2-search--inline .select2-search__field {
        height: unset !important;
    }

    @media screen and (max-width: 1380px) {
        .tg-cancel label {
            width: 35px;
            padding: 5px;
        }

        div.dataTables_wrapper div.dataTables_length select {
            top: -59px;
        }
    }

    .action_th_icon {
        float: right !important;
    }

    .form-control.is-invalid, .was-validated .form-control:invalid {
        border-color: #dc3545;
        padding-right: calc(1.5em + .75rem);
        /*background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23dc3545' viewBox='-2 -2 7 7'%3e%3cpath stroke='%23dc3545' d='M0 0l3 3m0-3L0 3'/%3e%3ccircle r='.5'/%3e%3ccircle cx='3' r='.5'/%3e%3ccircle cy='3' r='.5'/%3e%3ccircle cx='3' cy='3' r='.5'/%3e%3c/svg%3E);*/
        background-repeat: no-repeat;
        background-position: center right calc(.375em + .1875rem);
        background-size: calc(.75em + .375rem) calc(.75em + .375rem);
    }

    .invalid-feedback {
        width: 100%;
        margin-top: .25rem;
        font-size: 80%;
        color: #dc3545;
    }

    .form-control.is-valid, .was-validated .form-control:valid {
        border-color: #28a745;
        padding-right: calc(1.5em + .75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: center right calc(.375em + .1875rem);
        background-size: calc(.75em + .375rem) calc(.75em + .375rem);
    }

    .valid-feedback {
        width: 100%;
        margin-top: .25rem;
        font-size: 80%;
        color: #28a745;
    }

    .treeview span.icon {
        width: 12px;
        margin-right: 7px !important;
    }

    .search-result {
        margin-bottom: 0px;
    }

    .test_category_container{
        display: none !important;
    }
    .page-wrapper.sidebar-patient {
    padding-top: 55px!important;
}
.dataTables_wrapper .row+.row {
    overflow-x: unset!important;
    width: auto;
}
</style>
<div class="content container-fluid">
    <div class="record_publish_listing">
        <div class="row">
        <div class="col-xs-12 col-sm-8 form-group">
            <h3 class="page-title">Laboratory</h3>
            <div class="tg-breadcrumbarea tg-searchrecordhold">
                <ol class="tg-breadcrumb tg-breadcrumbvtwo">
                    <li><a href="javascript:;">Dashboard</a></li>
                    <li class="active">Laboratories Test</li>
                </ol>
            </div>
        </div>
</div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($this->session->flashdata('message_further') != '') {
                    ?>
                    <p class="bg-success"
                       style="padding:7px;"> <?php echo $this->session->flashdata('message_further'); ?></p>
                <?php } ?>
                <?php
                if ($this->session->flashdata('message_additional') != '') {
                    ?>
                    <p class="bg-success"
                       style="padding:7px;"> <?php echo $this->session->flashdata('message_additional'); ?></p>
                <?php } ?>
                <?php
                if ($this->session->flashdata('final_report_message') != '') {
                    echo $this->session->flashdata('final_report_message');
                }
                ?>
                <?php
                if ($this->session->flashdata('record_updated') != '') {
                    echo $this->session->flashdata('record_updated');
                }
                ?>
                <div class="flag_message"></div>
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <table id="laboratory-test-tabless" class="table table-striped custom-table"
                       cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="check_all">
                            <a href="javascript:;" class="generate-bulk-reports"
                               data-bulkurl="<?php echo base_url('index.php/doctor/generateBulkReports'); ?>">
                                <!-- <img width="22px" src="<?php //echo base_url('assets/icons/.png');     ?>"> -->
                                <i class="fa fa-download"></i>
                            </a><input type="hidden" name="bulk_report_ids">
                        </th>
                        <th>Name</th>
                        <th>Test ID</th>
                        <th>Lab</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Lab Ref:</th>
                        <th>Speciality</th>
                        <th>Cost</th>
                        <th>Sale</th>
                        <th>Added by</th>
                        <th>Time & Date</th>
                        <th class="hide">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($lab_test as $test_data){?>
                        <tr>
                            <td><input type="checkbox" value="<?php echo $test_data['id'];?>"></td>
                            <td><?php echo $test_data['name'];?></td>
                            <td><?php echo $test_data['test_id'];?></td>
                            <td><?php echo str_replace(",", "<br/>", $test_data['lab_name']);?></td>
                            <td><?php echo str_replace(",", "<br/>", $test_data['test_category']);?></td>
                            <td><?php echo $test_data['lab_ref_name'];?></td>
                            <td><span class="badge badge-success"><?php echo $test_data['spec_grp_name'];?></span></td>
                            <td><?php echo $test_data['cost'];?></td>
                            <td><?php echo $test_data['sale'];?></td>
                            <td><?php echo $test_data['user_name'];?></td>
                            <td><?php echo $test_data['created_at'];?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>