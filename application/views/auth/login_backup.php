<div class="row login_form">
    <div class="col-md-12">
        <div style="margin:0 auto; width:40%;background: #EEEEEE;  padding: 10px 36px 10px 36px;">
            <h1 style="text-align: center;"><?php echo lang('login_heading'); ?></h1>
            <p><?php echo lang('login_subheading'); ?></p>

            <div id="infoMessage"><?php echo $message; ?></div>

            <?php echo form_open("auth/login"); ?>

            <p>
                <?php echo lang('login_identity_label', 'identity'); ?>
                <?php echo form_input($identity); ?>
            </p>

            <p>
                <?php echo lang('login_password_label', 'password'); ?>
                <?php echo form_input($password); ?>
            </p>
            <p>
                <?php
                $random = mt_rand(1, 10);
                ?>
                <?php echo lang('memorable_word_1', 'memorable1') . '<strong>: ' . $random . '</strong>'; ?>
                <?php echo form_input($memorable1); ?>
                <input type="hidden" value="<?php echo $random; ?>" name="mem" id="mem">
            </p>
            <p>
                <?php
                $random2 = mt_rand(1, 10);
                
                ?>
                <?php echo lang('memorable_word_2', 'memorable2') . '<strong>: ' . $random2 . '</strong>'; ?>
                <?php echo form_input($memorable2); ?>
                <input type="hidden" value="<?php echo $random2; ?>" name="mem2" id="mem2">
            </p>
            
            <p>
                <?php echo lang('login_remember_label', 'remember'); ?>
                <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>
            </p>
            <p><?php echo form_submit('submit', lang('login_submit_btn')); ?></p>

            <?php echo form_close(); ?>

            <p><a href="forgot_password"><?php echo lang('login_forgot_password');  ?></a></p>
        </div>
    </div>
</div>