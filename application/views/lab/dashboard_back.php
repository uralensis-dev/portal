<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">

    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">View Recored</h3>
                </div>
                <div class="panel-body">
                    <p>View Your Request</p>
                    <?php echo anchor('institute/doctor_record_list', '<button type="button" class="btn btn-primary ">View</button>', 'title="view"'); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Status Bar</h3>
                </div>
                <div class="panel-body"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Other</h3>
                </div>
                <div class="panel-body">
                    Dynamic Content Goes Here.
                </div>
            </div>
        </div>
    </div> 
</div>

