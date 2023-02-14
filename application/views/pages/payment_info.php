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
            <h3 class="page-title">Payment Info</h3>
            <ul class="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url('settings'); ?>">Settings</a></li>
                    <li class="breadcrumb-item active">Payment Info</li>
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
        <?php echo form_open_multipart("settings/payment_info", array('class' => 'tg-formtheme tg-editform create_user_form')); ?>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="form-group">
                    <label>Payment should be made by bank transfer to the following account:</label>
                    <div class="field_wrapper">
                        <textarea type="text" rows="10" name="detail" class="form-control" placeholder="Enter Payment Description"><?= $detail; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="submit-section">
            <button class="btn btn-primary submit-btn">Update</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setTimeout(function (){
            $('.notification').hide(9000);
        }, 5000);
    });
</script>