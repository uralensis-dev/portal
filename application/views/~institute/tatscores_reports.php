<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-xs-12 col-md-2 col-md-offset-1">
                <a style="cursor:pointer;" data-toggle="collapse" data-target="#tat10" class="thumbnail">
                    <img src="<?php echo base_url('assets/img/tat10.jpg'); ?>" alt="TAT 10">
                </a>
            </div>
            <div class="col-xs-12 col-md-2">
                <a style="cursor:pointer;" data-toggle="collapse" data-target="#tat2w" class="thumbnail">
                    <img src="<?php echo base_url('assets/img/tat2w.jpg'); ?>" alt="TAT 2W">
                </a>
            </div>
            <div class="col-xs-12 col-md-2">
                <a style="cursor:pointer;" data-toggle="collapse" data-target="#tat3w" class="thumbnail">
                    <img src="<?php echo base_url('assets/img/tat3w.jpg'); ?>" alt="TAT 3W">
                </a>
            </div>
        </div>
        <hr>
        <div id="tat10" class="collapse">
            <?php display_tat10_form(); ?>
        </div>
        <div id="tat2w" class="collapse">
            <?php display_tat2w_form(); ?>
        </div>
        <div id="tat3w" class="collapse">
            <?php display_tat3w_form(); ?>
        </div>
    </div>
</div>