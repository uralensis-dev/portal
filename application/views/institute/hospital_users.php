<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="load_hospital_accumulative_invoice">
        
        <table class="table table-striped">
        <thead>
        <tr class="bg-primary">
        <th>User Name.</th>
        <th>Email</th>
        <th>Phone</th>
      
        </tr>
        </thead>
        <tbody>
        <?php foreach($userslist as $rec){ ?>
        <tr>
        <td><?php echo $rec->enc_username?></td>
        <td><?php echo $rec->enc_email?></td>
        <td><?php echo $rec->enc_phone?></td>
        </tr>
        <?php } ?>
        
        </tbody></table>
        
        </div>
    </div>
</div>