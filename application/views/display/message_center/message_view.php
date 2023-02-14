<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <a href="<?php echo base_url('index.php/admin/messages_center'); ?>" class="btn btn-primary"><< Go Back</a>
        <hr>
        <?php if(!empty($display_msg)) { ?>
        <div class="well">
            <p><?php echo $display_msg[0]->privmsg_body; ?></p>
        </div>
        <?php } ?>
    </div>
</div>