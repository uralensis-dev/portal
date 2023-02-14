<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-8 offset-md-2">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Add Data Set</h3>
                </div>
            </div>
        </div>
        <!-- /Page Header -->


        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Select hospital <span class="text-danger">*</span></label>
                    <select name="hospital_id" class="form-control tg-select display_mdt_list_on_hospital">
                        <option value="">Choose Hospital</option>
                        <?php
                        if (!empty($hospitals_list)) {
                            foreach ($hospitals_list as $hospitals) {
                                echo '<option value="' . $hospitals->id . '">' . $hospitals->description . '</option> ';
                            }
                        }
                        ?>
                    </select>						
                </div>
            </div>

        </div>
        <!--start of row-->
        <div>
            <hr>
            <h3 class="text-center">Datasets</h3>
            <div class="row">
                <div class="col-md-3">
                    <form class="form">
                        <div class="form-group">
                            <label for="dataset_name">Dataset Name</label>
                            <input type="text" class="form-control" name="dataset_name" id="dataset_name">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary save_dataset">Save Dataset</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <?php if (!empty($datasets)) { ?>
                        <div class="panel-group" id="datasets-accordion">
                            <?php foreach ($datasets as $key => $value) { ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#datasets-accordion" href="#datacollase-<?php echo intval($value->ura_datasets_id); ?>">
                                                <?php echo $value->ura_datasets_name; ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="datacollase-<?php echo intval($value->ura_datasets_id); ?>" class="panel-collapse">
                                        <div class="panel-body">
                                            <button data-toggle="collapse" data-target="#dataset-cat-<?php echo intval($value->ura_datasets_id); ?>">Add Dataset Category</button>
                                            <button class="refresh_dataset_data pull-right" data-datasetid="<?php echo intval($value->ura_datasets_id); ?>">Refresh Dataset</button>
                                            <div class="clearfix"></div>
                                            <div id="dataset-cat-<?php echo intval($value->ura_datasets_id); ?>">
                                                <form class="form dataset_cat_form">
                                                    <div class="form-group">
                                                        <label>Dataset Category</label>
                                                        <input type="text" class="form-control" name="dataset_cat">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="hidden" name="dataset_parent_id" value="<?php echo intval($value->ura_datasets_id); ?>">
                                                        <button class="btn btn-primary save_dataset_cat">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <hr>
                                            <div class="refresh_dataset_response"></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-5 dataset_data">
                    <?php if (!empty($datasets)) { ?>
                        <select name="dataset_parent_name" class="form-control dataset_parent_name">
                            <option value="">Choose Dataset</option>
                            <?php foreach ($datasets as $key => $value) { ?>
                                <option value="<?php echo $value->ura_datasets_id; ?>"><?php echo $value->ura_datasets_name; ?></option>
                            <?php } ?>
                        </select>
                    <?php } ?>
                    <div class="dataset_cat_response">

                    </div>
                </div>
            </div>
        </div>
        <!--end of row-->
    </div>




</div>





</div>
</div>