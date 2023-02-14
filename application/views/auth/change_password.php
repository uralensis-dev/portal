<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-7 login_area">              
                <div class="mx-auto login-box" id="login-box">
                    
                    <div class="login-box-body">
                        
                       
                                <div id="infoMessage"><?php echo html_purify($message);?></div>

<?php echo form_open("auth/change_password");?>

      <p>
            <?php echo lang('change_password_old_password_label', 'old_password');?> <br />
            <?php echo form_input($old_password);?>
      </p>

      <p>
            <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
            <?php echo form_input($new_password);?>
      </p>

      <p>
            <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
            <?php echo form_input($new_password_confirm);?>
      </p>

      <?php echo form_input($user_id);?>
      <p><?php echo form_submit('submit', lang('change_password_submit_btn'));?></p>

<?php echo form_close();?>
                    </div>
                </div>
            </div>
