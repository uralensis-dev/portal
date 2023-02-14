<style type="text/css">
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
</style>

<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Add Pathologist</h3>
            <ul class="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url('laboratory/pathologist'); ?>">Pathologist</a></li>
                    <li class="breadcrumb-item active">Add pathologist</li>
                </ul>
            </ul>
        </div>
    </div>
</div>

<div class="notification">
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
</div>

<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart("laboratory/add_pathologist", array('class' => 'tg-formtheme tg-editform create_user_form')); ?>
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label>Pathologist<span class="text-danger">*</span></label>
                            <select class="select2" name="pathologist_id" id="pathologist_id">
                                <?php foreach ($pathologistArr as $pathologist){ ?>
                                    <option value="<?= $pathologist->id; ?>"><?= $pathologist->first_name .' '. $pathologist->last_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="radio">
                                <label for="by_request"><input type="radio" name="type" class="radio_type" value="by_request" id="by_request" checked> By Request</label>
                                &nbsp;&nbsp;
                                <label for="by_specimen"><input type="radio" name="type" class="radio_type" value="by_specimen" id="by_specimen"> By Specimen</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label>Price<span class="text-danger">*</span></label>
                            <input type="text" name="price" class="form-control numberonly" placeholder="Enter Price Here" id="" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    <label>Description<span class="text-danger">*</span></label>
                    <div class="field_wrapper">
                        <textarea type="text" rows="8" name="description" class="form-control" placeholder="Enter Description"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="submit-section">
            <button class="btn btn-primary submit-btn">Save</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setTimeout(function (){
            $('.notification').hide(9000);
        }, 5000);

        $('#pathologist_id').select2({width: '100%'});
        $('body').on('keypress', '.numberonly', function (e){
            var charCode = (e.which) ? e.which : event.keyCode
            if (String.fromCharCode(charCode).match(/[^0-9]/g)){ return false; }
        });
    });
</script>