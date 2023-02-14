<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php

function display_tat10_form() {
    ?>
    <div class="well">
        <form id="generate_tat10_report" action="<?php echo base_url('index.php/institute/generate_tat10/'); ?>" method="post">
            <div class="col-md-12">
                <div class="form-group">
                    <button value="tat10_pdf" name="tat10_pdf" id="tat10_pdf" type="submit" class="btn btn-primary pull-left">Generate PDF</button>
                    <button value="tat10_csv" name="tat10_csv" id="tat10_csv" type="submit" class="btn btn-primary pull-right">Generate CSV</button>
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
    </div>
    <?php
}

function display_tat2w_form() {
    ?>
    <div class="well">
        <form id="generate_tat2w_report" action="<?php echo base_url('index.php/institute/generate_tat2w/'); ?>" method="post">
            <div class="col-md-12">
                <div class="form-group">
                    <button value="tat2w_pdf" name="tat2w_pdf" id="tat2w_pdf" type="submit" class="btn btn-primary pull-left">Generate PDF</button>
                    <button value="tat2w_csv" name="tat2w_csv" id="tat2w_csv" type="submit" class="btn btn-primary pull-right">Generate CSV</button>
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
    </div>
    <?php
}

function display_tat3w_form() {
    ?>
    <div class="well">
        <form id="generate_tat3w_report" action="<?php echo base_url('index.php/institute/generate_tat3w/'); ?>" method="post">
            <div class="col-md-12">
                <div class="form-group">
                    <button value="tat3w_pdf" name="tat3w_pdf" id="tat3w_pdf" type="submit" class="btn btn-primary pull-left">Generate PDF</button>
                    <button value="tat3w_csv" name="tat3w_csv" id="tat3w_csv" type="submit" class="btn btn-primary pull-right">Generate CSV</button>
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
    </div>
    <?php
}
