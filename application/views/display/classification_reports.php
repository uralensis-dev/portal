<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="well">
        <?php
           $attributes = array('class' => '');
            echo form_open("admin/classification_reports/", $attributes);
            ?>
           <!-- <form action="<?php //echo base_url('index.php/admin/classification_reports'); ?>" method="post">-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hospital_list">Choose Hospital</label>
                            <select class="form-control" name="hospital_list" id="hospital_list">
                                <option value="0">Choose Hospital</option>
                                <?php
                                if (!empty($hospital_groups)) {
                                    foreach ($hospital_groups as $groups) {
                                        echo '<option value="' . $groups->id . '">' . $groups->description . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="specimen_category">Choose Category</label>
                            <select class="form-control" name="specimen_category" id="specimen_category">
                                <option value="0">Choose Specimen Category</option>
                                <option value="benign">Benign</option>
                                <option value="atypical">Atypical</option>
                                <option value="malignant">Malignant</option>
                                <option value="inflammation">Inflammation</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary " name="search_specimen_cats" value="search_specimen_cats">Search</button>
            </form>
        </div>
    </div>
</div>
<hr>
<?php if (!empty($specimen_cats_reports)) { ?>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                
            </table>
        </div>
    </div>
<?php } ?>