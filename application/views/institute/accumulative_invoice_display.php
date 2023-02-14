<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
            <label>Select Year</label>
            <select class="form-control search_yearly_invoice">
                <option value="">Select Year</option>
                <?php
                for ($i = 0; $i <= 10; $i++) {
                    $year = date("Y", strtotime("-" . $i . " year"));
                    echo '<option value="' . $year . '">' . $year . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="load_hospital_accumulative_invoice"></div>
    </div>
</div>