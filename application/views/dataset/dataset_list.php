<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style type="text/css">
    div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top:-65px;
        height: 37px !important;
        width: 50px !important;
        left: 29px;
        padding:0;
    }
    .comments_icon a.opinion_status_btn {
        border: 1px solid #ddd;
        padding: 8px 4px;
        border-radius: 38px;
    }
    .btn-default{
        background: #f5f5f5 !important;
    }

    .alloc-circle {
        padding: 5px;
        width: 30px;
        height: 30px;
        text-align: center;
        line-height: 2;
        font-weight: bold;
        font-size: 16px;
        border: 1px solid #fff;
        border-radius: 100px;
    }
    .breadcrumb{padding: 0 !important}

    .tg-cancel input{
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
    /*.flags_check span.tg-radio {
        display: none;
    }
    .flags_check span.tg-radio.first {
        display: block;
    }*/

    @media screen and (min-width: 1600px) {
        body{font-size: 18px;}
    }
    @media screen and (min-width: 1380px) {
        .tg-cancel label {
            width: 35px;
            padding: 5px;
        }
        /*div.dataTables_wrapper div.dataTables_length select{top: -119px;}*/
    }
    ol.breadcrumb{float: left;}

    .clear_btn{
        cursor: pointer;
        margin-bottom: 0;
        margin-top: 5px;
        width: 50px !important;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 50%;
        display: inline-block;
    }
    .comments_icon a.opinion_status_btn{position: relative; display: inline-block;}
    .opinion_count, .opinion_count_pending {
        color: #fff;
        font-weight: 300;
        line-height: 1;
        padding: 4px;
        border-radius: 50%;
        font-size: 15px !important;
        text-align: center;
        position: absolute;
        top: -15px;
        /*right: 8px;*/
    }
    .opinion_count_pending{
        top: -20px;
        right: -10px;
    }

    #updateDatasetForm .error{
        color:red;
    }
    /*.opinion_count_pending {
        color: #fff;
        font-weight: 700;
        position: absolute;
        right: 0;
        top: 0;
    }*/
</style>
<div class="clearfix"></div>


<div class="container-fluid">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3 class="page-title">Records</h3>
        <div class="tg-breadcrumbarea tg-searchrecordhold">
            <?php echo $breadcrumbs; ?>
            <div class="tg-rightarea">
                <div class="tg-haslayout">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopadding-right">
                            <div class="tg-filterhold">
                                <ul class="tg-filters record-list-filters">
                                    <li class="tg-statusbar tg-flagcolor">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tg-haslayout">
        <?php
        if ($this->session->flashdata('record_status') != '') { ?>
        <p class="bg-success" style="padding:7px;"><?php echo $this->session->flashdata('record_status'); ?></p>
        <?php } ?>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-filterhold">
                    <ul class="tg-filters record-list-filters">
                        <li class="tg-statusbar tg-flagcolor">

                        </li>


                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12" style="margin-bottom: 60px;">
            <?php
            if (isset($_GET['msg']) && $_GET['msg'] == 'success') {

                echo '<p class="bg-success" style="padding:7px;">Report Has Been Successfully Published.</p>';
            }
            if ($this->session->flashdata('unpublish_record_message') != '') {
                echo $this->session->flashdata('unpublish_record_message');
            }
            ?>
        </div>
    </div>

    <div class="row report_listing">
        <div class="col-md-12">
            <div class="flag_message"></div>
            <table id="doctor_opinion_record_list_table"  class="table table-responsive table-striped custom-table" cellspacing="0" style="margin-top:40px; overflow: scroll;">
                <thead>
                <tr>
                    <th>Hospital</th>
                    <th>Dataset Name</th>
                    <th>Dataset Code</th>
                    <th>Parent</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $flag_count = 11;
//                echo "<pre>";print_r($datasets_cases);exit;

                foreach ($datasets_cases as $row) {
                    // $row_code = ''; ?>
                    <tr class="<?php //echo $row_code; ?>">
                        <td>
                            <?php echo $row->hospital_name;?>
                        </td>
                        <td>
                            <?php echo $row->dataset_name;?>
                        </td>
                        <td>
                            <?php echo $row->dataset_code;?>
                        </td>
                        <td>
                            <?php
                            if($row->parent_dataset_id!=0){
                                $getData = $this->Doctor_model->select_where("dataset_name", "tbl_datasets", array("dataset_id"=>$row->parent_dataset_id))->row();
                                echo $getData->dataset_name;
                            } else {
                                echo "N/A";

                            }
                            ?>
                        </td>


                        <td class="text-right">
                            <textarea id="textarea_<?php echo $row->id; ?>" style="display: none;"><?php echo json_encode($row);?></textarea>
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item edt-dataset" href="javascript:void(0);"
                                       id='<?php echo $row->id; ?>' data-id="<?php echo $row->id; ?>" data-toggle="modal"
                                       data-target="#edit_dataset_modal"><i
                                            class="fa fa-pencil m-r-5"></i> Edit</a>

                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                    $flag_count++;
                }//endforeach
                ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Add Leave Modal -->
<div id="edit_dataset_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 800px;max-width: 800px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dataset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $attributes = array('id'=>'updateDatasetForm');
                echo form_open('',$attributes);
                ?>
                <!--                <form id="addLeaveTypeForm">-->
                <div class="col-md-12">
                    <input class="form-control" type="hidden" id="edit_id" name="edit_id">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Leave Codes <span class="text-danger">*</span></label>
                            <select class="select2" id="hospital_id" name="hospital_id">
                                <option>Select Hospitals</option>
                                <?php foreach ($get_hospitals as $hospitalData){ ?>
                                    <option value="<?php echo $hospitalData->id;?>"><?php echo $hospitalData->name;?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Dataset Name <em class='text-danger'>*</em></label>
                                <input class="form-control" type="text" name='dataset_name' id='dataset_name' required>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Dataset Code <em class='text-danger'>*</em></label>
                                <input class="form-control" type="text" name='dataset_code' id='dataset_code'
                                       required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Dataset Code </label>
                                <select id='dataset_parent' name='dataset_parent' class="select2" >
                                    <option>Select Parent</option>
                                    <?php foreach ($datasets_cases as $row) { if($row->parent_dataset_id==0){?>
                                        <option value="<?php echo $row->id;?>"><?php echo $row->dataset_name;?></option>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </div>
                <?php echo form_close();?>
                <!--                </form>-->
            </div>
        </div>
    </div>
</div>
<!-- /Add Leave Modal -->
<script>
    $(document).ready(function () {
        $("#updateDatasetForm").validate({
            // ignore: ":hidden",
            rules: {
                hospital_id: {
                    required: true
                },
                dataset_name: {
                    required: true
                },
                dataset_code: {
                    required: true
                }
            },
            submitHandler: function (form) {
                $.ajax({
                    type: "POST",
                    url: _base_url + '/doctor/updateDatasetRecord',
                    data: $(form).serialize(),
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);return;
                        // var specimenId = $('#block_specimen_id').val();
                        if (response.status === 'success') {
                            $('#leave_modal').modal('hide');
                            // $("#specimen_" + specimenId + " .block_table").append(response.data);
                            $.sticky(response.message, {
                                classList: 'success',
                                speed: 200,
                                autoclose: 7000
                            });
                            location.reload();
                        } else {
                            $.sticky(response.message, {
                                classList: 'important',
                                speed: 200,
                                autoclose: 7000
                            });
                        }
                    }
                });
                return false; // required to block normal submit since you used ajax
            }
        });

    });

    $(document).on("click",".edt-dataset",function () {
        var dataId = $(this).attr("data-id");
        var getAllData = $.parseJSON($("#textarea_"+dataId).val());
        $("#edit_id").val(dataId);
        $("#hospital_id").val(getAllData.hospital_id).trigger("change");
        $("#dataset_name").val(getAllData.dataset_name);
        $("#dataset_code").val(getAllData.dataset_code);
        if(Number(getAllData.parent_dataset_id)==0){
            $("#dataset_parent").prop("disabled",true);
        } else{
            $("#dataset_parent").prop("disabled",false);
            $("#dataset_parent").val(getAllData.parent_dataset_id).trigger("change");
        }
    });
</script>
