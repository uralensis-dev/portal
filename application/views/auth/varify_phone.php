<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <div style="margin:0 auto; width:40%;" class="well text-center">
            <div class="auth_message"></div>
            <div id="loader"><img src="<?php echo base_url('assets/img/ajax-loader.gif'); ?>"></div>
            <h3>Add Registered Phone</h3>
            <input type="text" name="verify_phone" id="verify_phone">
            <hr>
            <button data-setvarifypath="<?php echo base_url('index.php/auth/check_phone_verification'); ?>" class="btn btn-success" id="phone_verify">Verify</button>
        </div>
    </div>
</div>