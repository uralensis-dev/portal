<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top: -62px;
        height: 37px !important;
        width: 50px !important;
        left: 29px;
        padding: 0;
    }

    table.dataTable thead > tr > th.sorting_asc, table.dataTable thead > tr > th.sorting_desc, table.dataTable thead > tr > th.sorting, table.dataTable thead > tr > td.sorting_asc, table.dataTable thead > tr > td.sorting_desc, table.dataTable thead > tr > td.sorting {
        padding-right: 15px !important
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

    @media screen and (min-width: 1600px) {
        body {
            font-size: 18px;
        }
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
</style>
<div class="container-fluid">
    <div class="record_publish_listing">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 class="page-title">Laboratory</h3>
            <div class="tg-breadcrumbarea tg-searchrecordhold">
                <ol class="tg-breadcrumb tg-breadcrumbvtwo">
                    <li><a href="javascript:;">Dashboard</a></li>
                    <li class="active">Add Test</li>
                </ol>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <span class="pull-right">
                        <a href="#" class="btn add-btn" style="background: #55ce63;" data-toggle="modal" data-target="#upload_test_modal"><i class="glyphicon glyphicon-upload"></i> Upload</a>
                        <a href="#" class="btn add-btn mr-2" data-toggle="modal" data-target="#add-laboratory-test-modal"><i class="glyphicon glyphicon-plus-sign"></i> Add Test</a>
                    </span>
                </div>
            </div>

            <div class="tg-haslayout">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="tg-filterhold">
                            <ul class="tg-filters record-list-filters">
                                <li class="tg-statusbar tg-flagcolor">

                                </li>

                                <li class="tg-statusbar tg-flagcolor custome-flagcolors last pull-right"
                                    style="padding: 0 10px;">
                                    <button type="submit" class="btn btn-default adv-search" data-toggle="collapse"
                                            data-target="#collapse_adv_search"><i class="fa fa-cog"></i></button>
                                </li>
                                <li class="tg-statusbar tg-flagcolor custome-flagcolors pull-right nobefore search_li"
                                    style="padding: 0">
                                    <div class="input-group">
                                        <input type="text" class="form-control custom_search_datatable"
                                               placeholder="Search"
                                               id="publish_record_search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-success" type="submit">
                                                <i class="glyphicon glyphicon-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tg-dashboardform tg-haslayout custom-haslayout">
                <div class="collapse" id="collapse_adv_search">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="tg-dashboardformhold">
                                <form class="tg-formtheme tg-advancesearch"
                                      action="<?php echo base_url('index.php/doctor/search_request'); ?>" method="post">
                                    <fieldset class="col-md-12">
                                        <div class="col-md-3 form-group">
                                            <input class="form-control" type="text" id="first_name" name="first_name"
                                                   placeholder="First Name">
                                        </div>
                                        <div class="col-md-3  form-group">
                                            <input class="form-control" type="text" id="sur_name" name="sur_name"
                                                   placeholder="Last Name">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <input class="form-control" type="text" id="nhs_no" name="nhs_no"
                                                   placeholder="NHS Number">
                                        </div>
                                        <div class="col-md-2 form-group tg-inputicon">
                                            <i class="lnr lnr-calendar-full"></i>
                                            <input type="text" name="dob" id="adv_dob" class="form-control unstyled"
                                                   placeholder="DOB">
                                        </div>
                                        <div class="col-md-1 form-group">
                                            <span class="tg-select">
                                                <select data-placeholder="Gender" name="gender">
                                                    <option value="">Gender</option>
                                                    <option value="male" selected>Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </span>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <button type="submit" class="btn btn-success btn-search">Advance Search
                                            </button>
                                        </div>
                                    </fieldset>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (isset($_GET['msg']) && $_GET['msg'] == 'success') {

                        echo '<p class="bg-success" style="padding:7px;">Report Has Been Successfully Published.</p>';
                    }
                    if ($this->session->flashdata('unpublish_record_message') != '') {
                        echo $this->session->flashdata('unpublish_record_message');
                    }
                    ?>
                    <?php
                    if ($this->session->flashdata('record_status') != '') {
                        echo $this->session->flashdata('record_status');
                    }
                    ?>
                </div>
            </div>

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

                    <table id="laboratory-test-table" class="table table-striped custom-table"
                           cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="check_all">
                                    <a href="javascript:;" class="generate-bulk-reports"
                                       data-bulkurl="<?php echo base_url('index.php/doctor/generateBulkReports'); ?>">
                                        <!-- <img width="22px" src="<?php //echo base_url('assets/icons/.png');   ?>"> -->
                                        <i class="fa fa-download"></i>
                                    </a><input type="hidden" name="bulk_report_ids">
                                </th>
                                <th>Test</th>
                                <th>Test ID</th>
                                <th>Lab</th>
                                <th>Category</th>
                                <th>Lab Ref:</th>
                                <th>Group</th>
                                <th>Cost</th>
                                <th>Sale</th>
                                <th>Added by</th>
                                <th>Time & Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="upload_test_modal" class="modal custom-modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Select CSV File</label>
                                    <input type="file">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info btn-rounded btn-lg">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div id="add-laboratory-test-modal" class="modal custom-modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <?php echo form_open(base_url('laboratory/add_test'), ['id' => 'laboratory_test_form']) ?>
                <div class="modal-header">
                    <h5 class="modal-title">Add Test</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label class="col-form-label">Lab Name:</label>
                                        <?php if ($group_type === 'A') { ?>
                                            <select name="lab_id" class="select2 form-control lab_id" id="lab_id" data-rule-required='true'>
                                                <?php
                                                if (isset($labs) && is_array($labs) && !empty($labs)) {
                                                    foreach ($labs as $lab) {
                                                        echo '<option value="' . $lab['id'] . '">' . $lab['description'] . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="">No Lab Found</option>';
                                                }
                                                ?>
                                            </select>
                                            <div class="invalid-feedback">

                                            </div>
                                        <?php } else { ?>
                                            <input type="text" readonly disabled class="form-control lab_id" value="<?php echo $lab['description'] ?>">
                                            <div class="invalid-feedback">

                                            </div>
                                            <input type="hidden" id="lab_id" name="lab_id" value="<?php echo $group_id ?>">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Test Id:</label>
                                        <input name="test_id" value="<?php echo $test_id ?>" class="form-control" type="text" data-rule-required='true' readonly>
                                    </div>
                                </div>
                                <div class="col-md-12" id="department_id_container" style="display: none;">
                                    <div class="form-group">
                                        <label class="col-form-label">Department</label>
                                        <select name="department_id" id="department_id" class="select2" data-rule-required='true'>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12" id="specialty_id_container" style="display: none;">
                                    <div class="form-group">
                                        <label class="col-form-label">Specialty</label>
                                        <select name="specialty_id" id="specialty_id" class="select2" data-rule-required='true'>

                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Code Type:</label>
                                        <select name="code_type" class="select2 form-control lab_id" id="code_type" data-rule-required='true' onchange="getBillingCode()">
                                            <?php foreach ($codeType as $cKey => $cValue) {
                                                ;
                                                ?>?>
                                                <option value="<?php echo $cValue->name; ?>"><?php echo $cValue->name; ?></option>
<?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12" id="dv_billing_codes" >
                                    <div class="form-group">
                                        <label class="col-form-label">Billing Code:</label>
                                        <select name="billing_code" class="select2 form-control lab_id" id="billing_code" data-rule-required='true'  onchange="getTestCodeDetails('<?php echo base_url(); ?>')">
                                            <?php foreach ($codeName as $codeNameKey => $codeNameValue) { ?>
                                                <option value="<?php echo $codeNameValue->id; ?>"><?php echo $codeNameValue->billing_code_name . "-" . $codeNameValue->billing_code; ?></option>
<?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12" id="dv_test_details" style="display:none" >

                                </div>





                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Lab Name Ref:</label>
                                    <input name="lab_ref" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Test Name:</label>
                                    <input name="test_name" class="form-control" type="text" data-rule-required='true'>
                                </div>
                            </div>
                            <div class="col-md-12" id="test_category_container" style="display: none;" >
                                <div class="form-group">
                                    <label class="col-form-label">Test Category:</label>
                                    <select name="test_category" id="test_category" class="select2" data-rule-required='true'>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label mr-2">Added by:</label>
                                    <a href="#" class="avatar"><img
                                            src="<?php echo get_profile_picture($user_data['profile_picture_path'], $user_data['first_name'], $user_data['last_name']); ?>" alt=""></a> <span><?php echo $user_data['first_name'] . ' ' . $user_data['last_name']; ?></span>
                                    <input type="hidden" name="user_id" value="<?php echo $user_data['id'] ?>">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Date Added:</label>
                                    <input class="form-control" type="text" name="created_at"
                                           value="<?php echo date('d-m-Y') ?>" readonly>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Discounted Price:</label>
                                    <input name="cost" class="form-control" type="text" data-rule-required='true'  onkeypress="return isNumber(event)">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Sale of Test:</label>
                                    <input name="sale" class="form-control" type="text" data-rule-required='true' onkeypress="return isNumber(event)">
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-info btn-rounded btn-lg submit-laboratory-test-form"
                            data-url="<?php echo base_url('laboratory/add_test'); ?>" type="submit">Submit
                    </button>
                </div>
<?php echo form_close() ?>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function getTestCodeDetails(url) {
            //  console.log(base_url); return false; 
            //$('#emptyDropdown').empty()
            var billingCode = $('#billing_code').val();

            // var carId = dropDown.options[dropDown.selectedIndex].value;
            $.ajax({
                type: "POST",
                url: url + "laboratory/getDataAgainstBillingCode",
                data: {'crsr_token': jQuery.now(), 'billingCode': billingCode},
                success: function (data) {
                    // console.log(data); return false; 
                    // Parse the returned json data
                    $("#dv_test_details").show();
                    $("#dv_test_details").html('');
                    $("#dv_test_details").append(data);
//                    var opts = $.parseJSON(data);
//                    // Use jQuery's each to iterate over the opts value
//                    $.each(opts, function (i, d) {
//                        // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
//                        $('#emptyDropdown').append('<option value="' + d.ModelID + '">' + d.ModelName + '</option>');
//                    });
                }
            });
        }

    </script>