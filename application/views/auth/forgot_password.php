<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div style="margin:0 auto; width:40%">
                <h1><?php echo lang('forgot_password_heading'); ?></h1>
                <p><?php echo sprintf(lang('forgot_password_subheading'), html_purify($identity_label)); ?></p>

                <div id="infoMessage"><?php echo html_purify($message); ?></div>

                <?php echo form_open("auth/forgot_password"); ?>

                <p>
                    <label for="email"><?php echo sprintf(lang('forgot_password_email_label'), html_purify($identity_label)); ?></label> <br />
                    <?php echo form_input($email); ?>
                </p>

                <p><?php echo form_submit('submit', lang('forgot_password_submit_btn')); ?></p>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>