<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$micro_id = $this->uri->segment(3);

if (!empty($micro_result)) {

    $micro_code = !empty($micro_result->umc_code) ? $micro_result->umc_code : '';
    $micro_title = !empty($micro_result->umc_title) ? $micro_result->umc_title : '';
    $micro_desc = !empty($micro_result->umc_micro_desc) ? $micro_result->umc_micro_desc : '';
    $micro_disgnosis = !empty($micro_result->umc_disgnosis) ? $micro_result->umc_disgnosis : '';
    $micro_snomed_t_code = !empty($micro_result->umc_snomed_t_code) ? $micro_result->umc_snomed_t_code : '';
    $micro_snomed_t2_code = !empty($micro_result->umc_snomed_t2_code) ? $micro_result->umc_snomed_t2_code : '';
    $micro_snomed_m_code = !empty($micro_result->umc_snomed_m_code) ? $micro_result->umc_snomed_m_code : '';
    $micro_snomed_p_code = !empty($micro_result->umc_snomed_p_code) ? $micro_result->umc_snomed_p_code : '';
    $micro_classification = !empty($micro_result->umc_classification) ? $micro_result->umc_classification : '';
    $micro_cancer_register = !empty($micro_result->umc_cancer_register) ? $micro_result->umc_cancer_register : '';
    $micro_rcpath_score = !empty($micro_result->umc_rcpath_score) ? $micro_result->umc_rcpath_score : '';
    ?>
    <a class="btn btn-primary" href="<?php echo base_url('index.php/admin/general_settings'); ?>">Go back <<<</a>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form class="form edit_microscopic_form">
                <div class="form-group">
                    <label for="micro_code">Microscopic Code</label>
                    <input type="text" class="form-control" name="micro_code" id="micro_code" value="<?php echo $micro_code; ?>">
                </div>
                <div class="form-group">
                    <label for="micro_title">Microscopic Title</label>
                    <input type="text" class="form-control" name="micro_title" id="micro_title" value="<?php echo $micro_title; ?>">             
                </div>
                <div class="form-group">
                    <label for="micro_desc">Microscopic Description</label>
                    <textarea type="text" class="form-control" name="micro_desc" id="micro_desc"><?php echo $micro_desc; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="micro_diagnose">Microscopic Diagnosis</label>
                    <input type="text" class="form-control" name="micro_diagnose" id="micro_diagnose" value="<?php echo $micro_disgnosis; ?>">
                </div>
                <div class="form-group">
                    <label for="micro_sno_t_code">Microscopic Snomed T1 Code</label>
                    <input type="text" class="form-control" name="micro_sno_t_code" id="micro_sno_t_code" value="<?php echo $micro_snomed_t_code; ?>">
                </div>
                <div class="form-group">
                    <label for="micro_sno_t_code">Microscopic Snomed T2 Code</label>
                    <input type="text" class="form-control" name="micro_sno_t2_code" id="micro_sno_t2_code" value="<?php echo $micro_snomed_t2_code; ?>">
                </div>
                <div class="form-group">
                    <label for="micro_sno_m_code">Microscopic Snomed M Code</label>
                    <input type="text" class="form-control" name="micro_sno_m_code" id="micro_sno_m_code" value="<?php echo $micro_snomed_m_code; ?>">
                </div>
                <div class="form-group">
                    <label for="micro_sno_p_code">Microscopic Snomed P Code</label>
                    <input type="text" class="form-control" name="micro_sno_p_code" id="micro_sno_p_code" value="<?php echo $micro_snomed_p_code; ?>">
                </div>
                <div class="form-group">
                    <label for="micro_classi">Microscopic Classification</label>
                    <input type="text" class="form-control" name="micro_classi" id="micro_classi" value="<?php echo $micro_classification; ?>">
                </div>
                <div class="form-group">
                    <label for="micro_canc_reg">Microscopic Cancer Register</label>
                    <input type="text" class="form-control" name="micro_canc_reg" id="micro_canc_reg" value="<?php echo $micro_cancer_register; ?>">
                </div>
                <div class="form-group">
                    <label for="micro_rcpath">Microscopic RCPath Score</label>
                    <input type="text" class="form-control" name="micro_rcpath" id="micro_rcpath" value="<?php echo $micro_rcpath_score; ?>">
                </div>
                <div class="form-group">
                    <input type="hidden" name="micro_id" value="<?php echo $micro_id; ?>">
                    <button type="button" class="btn btn-success edit_micro_btn">Edit Microscopic Code</button>
                </div>
            </form>
        </div>
    </div>
<?php } ?>