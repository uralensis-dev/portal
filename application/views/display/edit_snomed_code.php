<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="tg-dashboardbox inner-page-content">
            <?php
                $snomed_id = $this->uri->segment(3);
                $snomed_type = $this->uri->segment(4);

                $title = '';
                $desc = '';
                if( isset($snomed_type) && $snomed_type === 't1' ) {
                    $title = 'Snomed T1 Code';
                    $desc  = 'Snomed T1 Code Description';
                } elseif($snomed_type === 't2') {
                    $title = 'Snomed T2 Code';
                    $desc  = 'Snomed T2 Code Description';
                } elseif($snomed_type === 'p') {
                    $title = 'Snomed P Code';
                    $desc  = 'Snomed P Code Description';
                } elseif($snomed_type === 'm') {
                    $title = 'Snomed M Code';
                    $desc  = 'Snomed M Code Description';
                }

                $snomed_code_val = !empty($snomed_result['usmdcode_code']) ? $snomed_result['usmdcode_code'] : '';
                $snomed_desc_val = !empty($snomed_result['usmdcode_code_desc']) ? $snomed_result['usmdcode_code_desc'] : '';
                $snomed_diagnoses = !empty($snomed_result['snomed_diagnoses']) ? $snomed_result['snomed_diagnoses'] : '';
                $rc_path_score = !empty($snomed_result['rc_path_score']) ? $snomed_result['rc_path_score'] : '';
            ?>
            <a class="btn btn-primary" href="<?php echo base_url('index.php/admin/general_settings'); ?>">Go back<<<</a> 
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <form class="form edit_snomed_form" method="post" action="<?php echo base_url('index.php/admin/updateSnomedCode'); ?>">
                        <div class="form-group">
                            <label for="snomed_code"><?php echo $title; ?></label>
                            <input type="text" class="form-control" name="snomed_code" id="snomed_code"
                                value="<?php echo $snomed_code_val; ?>">
                        </div>
                        <div class="form-group">
                            <label for="snomed_code_desc"><?php echo $desc; ?></label>
                            <input type="text" class="form-control" name="snomed_code_desc" id="snomed_code_desc"
                                value="<?php echo $snomed_desc_val; ?>">
                        </div>
                        <?php if($snomed_type === 'm') { ?>
                            <div class="form-group">
                                <label for="snomed_code_diagnoses">Snomed Diagnoses</label>
                                <input type="text" class="form-control" name="snomed_code_diagnoses" id="snomed_code_diagnoses"
                                    value="<?php echo $snomed_diagnoses; ?>">
                            </div>
                            <div class="form-group">
                                <label for="rcpath_score">RCPath Score</label>
                                <input type="text" class="form-control" name="rcpath_score" id="rcpath_score"
                                    value="<?php echo $rc_path_score; ?>">
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <input type="hidden" name="snomed_id" value="<?php echo $snomed_id; ?>">
                            <input type="hidden" name="snomed_type" value="<?php echo $snomed_type; ?>">
                            <button type="submit" class="btn btn-success edit_snomed_btn">Save Snomed Code</button>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>