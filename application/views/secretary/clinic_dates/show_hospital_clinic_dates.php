<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <?php
        if ($this->session->flashdata('hospital_error') != '') {
            echo $this->session->flashdata('hospital_error');
        }
        ?>
        <form method="get" action="<?php echo base_url('index.php/secretary/show_clinic_dates'); ?>" class="form">
            <div class="form-group">
                <label for="hospital_id">Choose Hospital to add clinic dates.</label>
                <select name="hospital_id" class="form-control">
                    <option value="false">Choose Hospital</option>
                    <?php
                    if (!empty($hospitals_list)) {
                        foreach ($hospitals_list as $hospitals) {
                            echo '<option value="' . intval($hospitals->id) . '">' . html_purify($hospitals->description) . '</option> ';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>
</div>