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
            <div class="col-xs-12 col-md-2">
                <a style="cursor:pointer;" data-toggle="collapse" data-target="#fw_report" class="thumbnail">
                    <img src="<?php echo base_url('assets/img/fw.jpg'); ?>" alt="FW Report">
                </a>
            </div>
            <div class="col-xs-12 col-md-2">
                <a style="cursor:pointer;" data-toggle="collapse" data-target="#imf_report" class="thumbnail">
                    <img src="<?php echo base_url('assets/img/imf.jpg'); ?>" alt="IMF Report">
                </a>
            </div>
        </div>
        <hr>
        <?php
        if ($this->session->flashdata('fw_search_error') != '') {
            echo $this->session->flashdata('fw_search_error');
        }
        if ($this->session->flashdata('imf_search_error') != '') {
            echo $this->session->flashdata('imf_search_error');
        }
        ?>
        <div id="tat10" class="collapse">
            <?php display_tat10_form($hospital_groups); ?>
        </div>
        <div id="tat2w" class="collapse">
            <?php display_tat2w_form($hospital_groups); ?>
        </div>
        <div id="tat3w" class="collapse">
            <?php display_tat3w_form($hospital_groups); ?>
        </div>
        <div id="fw_report" class="collapse">
            <?php display_fw_report($hospital_groups); ?>
        </div>
        <div id="imf_report" class="collapse">
            <?php display_imf_report($hospital_groups); ?>
        </div>
    </div>
</div>