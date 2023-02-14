<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <?php if (!empty($track_templates)) { ?>
            <div class="form-group">
                <label for="track_template_id">Choose Template</label>
                <select class="form-control track_template_id" name="track_template_id" id="track_template_id">
                    <option>Choose Track Template</option>
                    <?php foreach ($track_templates as $key => $value) { ?>
                        <option value="<?php echo $value['ura_rec_temp_id']; ?>"><?php echo $value['temp_input_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
        <?php } ?>
    </div>
    <hr>
    <div class="col-md-12">
        <div class="display_session_batch_data"></div>
    </div>
</div>
