<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet" />
<style type="text/css">
    .page-header {
        margin:0 0 1.875rem;
        border-bottom:0px;
    }
    .content{ background: #f5f5f5 }
    .error_list {
        margin: 15px 0px;
        background-color: red;
        color: white;
        padding: 10px;
        border-radius: 5px;
    }
    .success_list {
        margin: 15px 0px;
        background-color: lightgreen;
        color: white;
        padding: 10px;
        border-radius: 5px;
    }
    div.dataTables_wrapper div.dataTables_length select{
        padding: 0 8px;
    }
    table.dataTable thead > tr > th{font-weight: 600 !important;}
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
    .add-btn {
        background-color: #00c5fb;
        border: 1px solid #00c5fb;
        border-radius: 3px !important;
        color: #fff;
        float: right;
        font-weight: 500 !important;
        min-width: 140px;
        font-size: 16px;
    }
    .add-btn:hover,
    .add-btn:focus{
        color: #fff !important;
    }
    .add-btn i {
        margin-right: 5px;
    }
</style>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-sm-10">
            <h3 class="page-title m-0">Lab Templates</h3>
        </div>
        <div class="col-sm-2">
            <div class="pull-right">
                <button class="btn add-btn" data-toggle="modal" data-target="#add_template_modal"><i class="fa fa-plus"></i> Add Template</button>
            </div>
        </div>
    </div>
</div>

<?php if ($this->session->flashdata('error') != '') { ?>
    <div class="error_list">
        <?= $this->session->flashdata('error'); ?>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('success') != '') { ?>
    <div class="success_list">
        <?= $this->session->flashdata('success'); ?>
    </div>
<?php } ?>

<div class="">
    <table class="table custom-table table-striped" id="document-table" style="width: 100%;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Logo</th>
                <th>Template Name</th>
                <th>Category</th>
                <th>Clinic</th>
                <th>Created By</th>
                <th>Created Date</th>
                <th>Default</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $no = 1;
            if (!empty($lab_templates)) {
                foreach ($lab_templates as $row) { ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><img src="<?= base_url($row->logo_path); ?>" style="width: 50px; height: 50px;"/></td>
                    <td><?= $row->template_name; ?></td>
                    <td><?= $row->category; ?></td>
                    <td><?= $row->clinic; ?></td>
                    <td><?= $row->user_name; ?></td>
                    <td><?= date('d-m-Y H:i:s', strtotime($row->created_at)); ?></td>
                    <th>
                        <input type="radio" class="set_as_default" value="1" name="is_default" data-id="<?= $row->id; ?>" <?php if($row->is_default == 1){ echo "checked"; } ?>/>
                    </th>
                    <td class="text-right">
                        <a class="dropdown-item edit_template" href="javascript:void(0);" data-id="<?= $row->id; ?>"><i class="fa fa-pencil m-r-5"></i> </a>
                        <a class="dropdown-item" href="<?= base_url('laboratory/delete_lab_template/') . $row->id; ?>" ><i class="fa fa-trash m-r-5"></i> </a>
                    </td>
                    </td>
                </tr>
            <?php $no++; } } else { echo '<tr><td colspan="8" class="text-center" style="font-weight: bold; color: red;"> No record found</td></tr>'; } ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="add_template_modal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Template</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('laboratory/add_template'); ?>" enctype="multipart/form-data" id="add_template" class="tg-formtheme tg-editform create_user_form">
                <?php //echo form_open_multipart("laboratory/add_template", array('method'=>'post', 'class' => 'tg-formtheme tg-editform create_user_form', 'id'=>'add_template')); ?>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="group_id" value="<?= $group_id; ?>" />
                        <input type="hidden" name="lab_id" value="<?= $user_id; ?>" />
                        <div class="col-md-9 form-group">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class="focus-label">Template Name</label>
                                    <input type="text" name="template_name" value="" class="form-control input-lg" placeholder="Enter template name">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="focus-label">Categories:</label>
                                    <select name="category_id" class="select2" data-rule-required='true'>
                                        <option value="">Select Category</option>
                                        <?php foreach ($categories as $category) { ?>
                                            <option value="<?= $category['id']; ?>"><?= $category["name"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div><div class="col-md-6 form-group">
                                    <label class="focus-label">Clinic:</label>
                                    <select name="hospital_id" class="select2 clinic" data-rule-required='true' id="hospital_id">
                                        <option value="">Select Clinic</option>
                                        <?php foreach ($hospital_list as $hospital) { ?>
                                            <option value="<?= $hospital['hosp_id']; ?>" data-phone="<?= $hospital["hosp_phone"]; ?>" data-address="<?= $hospital["hosp_address"]; ?>" data-group-id="<?= $hospital["group_id"]; ?>" <?php echo ($clinicId != '' && $clinicId == $hospital['hosp_id']) ? "selected" : ""; ?>><?= $hospital["name"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 form-group">
                            <div class="profile-img-wrap edit-img">
                                <img class="inline-block" id="profile-pic-preview" src="<?= base_url('assets/newtheme/img/profiles/avatar-02.jpg'); ?>" alt="user">
                                <div class="fileupload btn">
                                    <span class="btn-text">edit</span>
                                    <input class="upload" type="file" id="files" name="files[]" accept="image/*"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="focus-label">Header</label>
                            <textarea type="text" name="header" class="form-control input-lg" rows="5" placeholder="Enter header content"></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="focus-label">Footer</label>
                            <textarea type="text" name="footer" class="form-control input-lg" rows="5" placeholder="Enter footer content"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12 text-center submit_all">
                        <button class="btn btn-info" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_template_modal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Template</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('laboratory/edit_template'); ?>" enctype="multipart/form-data" id="edit_template" class="tg-formtheme tg-editform create_user_form">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="group_id" id="elt_group_id" value="" />
                        <input type="hidden" name="id" id="elt_id" value="" />
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class="focus-label">Template Name</label>
                                    <input type="text" name="template_name" id="elt_template_name" value="" class="form-control input-lg" placeholder="Enter template name">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="focus-label">Categories:</label>
                                    <select name="category_id" class="select2" data-rule-required='true' id="elt_category_id">
                                        <option value="">Select Category</option>
                                        <?php foreach ($categories as $category) { ?>
                                            <option value="<?= $category['id']; ?>"><?= $category["name"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div><div class="col-md-6 form-group">
                                    <label class="focus-label">Clinic:</label>
                                    <select name="hospital_id" class="select2 clinic" data-rule-required='true' id="elt_hospital_id">
                                        <option value="">Select Clinic</option>
                                        <?php foreach ($hospital_list as $hospital) { ?>
                                            <option value="<?= $hospital['hosp_id']; ?>" data-group-id="<?= $hospital["group_id"]; ?>"><?= $hospital["name"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="profile-img-wrap edit-img">
                                <img class="inline-block" id="profile-pic-preview" src="<?= base_url('assets/newtheme/img/profiles/avatar-02.jpg'); ?>" alt="user">
                                <div class="btn">
                                    <span class="btn-text">edit</span>
                                    <input class="upload" type="file" id="files" name="files[]" accept="image/*"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="focus-label">Header</label>
                            <textarea type="text" name="header" class="form-control input-lg" rows="5" placeholder="Enter header content" id="elt_header"></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="focus-label">Footer</label>
                            <textarea type="text" name="footer" class="form-control input-lg" rows="5" placeholder="Enter footer content" id="elt_footer"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12 text-center submit_all">
                        <button class="btn btn-info" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $(".select2").select2({
            placeholder: 'Nothing Selected',
            width: '100%'
        });
        $('#add_template').validate({
            rules: {
                template_name: {required: true},
                "files[]": {required: true},
                header: {required: true},
                footer: {required: true}
            }
        });
        $('#edit_template').validate({
            rules: {
                template_name: {required: true},
                header: {required: true},
                footer: {required: true}
            }
        });
        $(document).find('.clinic').trigger('change');
        $(document).on('change', '.clinic', function (){
            let group_id = $(this).find(":selected").data("group-id");
            $('#add_template_modal').find('input[name=group_id]').val(group_id);
        });
        $(document).on('click', '.edit_template', function (){
            let id = $(this).attr('data-id');
            if(id > 0){
                $.ajax({
                    url: '<?= base_url('/laboratory/get_template_data'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {'id': id },
                    success: function (response) {
                        if (response.status === 'success') {
                            let modal = $(document).find('#edit_template_modal');
                            let arr = response.data;
                            modal.find('#elt_id').val(arr.id);
                            modal.find('#elt_group_id').val(arr.group_id);
                            modal.find('#elt_template_name').val(arr.template_name);
                            modal.find('#elt_category_id').val(arr.category_id).trigger('change');
                            modal.find('#elt_hospital_id').val(arr.hospital_id).trigger('change');
                            modal.find('#elt_header').text(arr.header);
                            modal.find('#elt_footer').text(arr.footer);
                            modal.find('#profile-pic-preview').attr('src', '<?= base_url('/'); ?>' + arr.logo_path);
                            modal.modal('show');
                        } else {
                            jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 5000});
                        }
                    }
                });
            }
        });
        $(document).on('change', '.set_as_default', function (){
           let id = $(this).attr('data-id');
            if(id > 0){
                $.ajax({
                    url: '<?= base_url('/laboratory/set_default_template'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {'id': id },
                    success: function (response) {
                        jQuery.sticky(response.msg, {classList: response.type, speed: 200, autoclose: 5000});
                    }
                });
            }
        });
        $(document).on("change",'#hospital_id',function(){
            var hName = $(this).find(':selected').text() + "\n";
            var hAddress = $(this).find(':selected').data("address") + "\n";
            var hPhone = $(this).find(':selected').data("phone");
            $('#tHeader').text(hName + hAddress + hPhone);
        });
        <?php if($clinicId != ''){?>
            $('#hospital_id').val(<?php echo $clinicId; ?>).trigger('change');
        <?php }?>
    });
</script>