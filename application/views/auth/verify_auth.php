<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <div style="margin:0 auto; width:40%;" class="well text-center">
            <div class="auth_message"></div>
            <div id="loader"><img src="<?php echo base_url('assets/img/ajax-loader.gif'); ?>"></div>
            <h3>Enter Access Token</h3>
            <input type="text" name="verify_auth" id="verify_auth">
            <hr>
            <button data-setaccesspath="<?php echo base_url('index.php/auth/check_access_token'); ?>" class="btn btn-success" id="access_token">Login</button>
            <p><input id="remember_this_access" value="true" type="checkbox" name="remember_this_access"> Remember this device for 1 month.</p>
            <p><a class="float:right;" style="cursor: pointer;" id="resend_access_token" data-resendaccessurl="<?php echo base_url('index.php/auth/resend_auth_code'); ?>">Resend Access Code</a></p>
        </div>
    </div>
</div>