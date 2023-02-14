<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php

function set_datasets_data($datasets, $record_id) {
    $ci = & get_instance();
    ob_start();
    ?>
    <div class="row">
        <div class="col-md-12">
            <h3>Datasets</h3>
            <hr>
            <?php if (!empty($datasets)) { ?>
                <div id="datasets-accordian" class="panel-group">
                    <?php foreach ($datasets as $key => $value) { ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#datasets-accordian" href="#datasets-<?php echo $value->ura_datasets_id; ?>"><?php echo $value->ura_datasets_name; ?></a>
                                </h4>
                            </div>
                            <div id="datasets-<?php echo $value->ura_datasets_id; ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php
                                    $datasets_cat_data = $ci->Doctor_model->get_datasets_category_names($value->ura_datasets_id);
                                    if (!empty($datasets_cat_data)) {
                                        foreach ($datasets_cat_data as $key => $cat_data) {
                                            ?>
                                            <button class="btn" data-toggle="modal" data-target="#cat_data_model_<?php echo $cat_data->ura_datasets_cat_id; ?>"><?php echo $cat_data->ura_dataset_cat_name; ?></button>
                                            <div id="cat_data_model_<?php echo $cat_data->ura_datasets_cat_id; ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Datasets Category</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="add_moveable_text">
                                                                <?php
                                                                $dataset_cat_ques_data = $ci->Doctor_model->get_datasets_category_questions_names($cat_data->ura_datasets_cat_id);

                                                                if (!empty($dataset_cat_ques_data)) {
                                                                    ?>
                                                                    <form class="form dataset_form">
                                                                        <div class="dataset-form-html">
                                                                            <?php
                                                                            foreach ($dataset_cat_ques_data as $key => $ques_data) {
                                                                                if ($ques_data->ura_datasets_ques_type === 'fillinblanks') {
                                                                                    ?>
                                                                                    <div class="form-group">
                                                                                        <label><?php echo $ques_data->ura_datasets_ques_title; ?></label>
                                                                                        <textarea class="form-control" name="<?php echo $ques_data->ura_datasets_ques_title; ?>"></textarea>
                                                                                    </div>
                                                                                    <?php
                                                                                } elseif ($ques_data->ura_datasets_ques_type === 'multiplechoice') {
                                                                                    $get_answer_data = $ci->Doctor_model->get_datasets_category_questions_answer_data($ques_data->ura_datasets_ques_id);
                                                                                    $answer_data = '';
                                                                                    if (!empty($get_answer_data[0])) {
                                                                                        $answer_data = $get_answer_data[0]->ura_answer_text;
                                                                                    }
                                                                                    $explode_ans = explode("|", $answer_data);
                                                                                    ?>
                                                                                    <div class="form-group">
                                                                                        <label><?php echo $ques_data->ura_datasets_ques_title; ?>: </label>
                                                                                        <?php
                                                                                        if (!empty($explode_ans)) {
                                                                                            foreach ($explode_ans as $ans) {
                                                                                                ?>
                                                                                                <input type="checkbox" name="<?php echo $ques_data->ura_datasets_ques_title; ?>[]" value="<?php echo $ans; ?>"><?php echo ucfirst($ans); ?>
                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                    <?php
                                                                                } elseif ($ques_data->ura_datasets_ques_type === 'truefalse') {
                                                                                    $get_answer_data = $ci->Doctor_model->get_datasets_category_questions_answer_data($ques_data->ura_datasets_ques_id);
                                                                                    $answer_data = '';
                                                                                    if (!empty($get_answer_data[0])) {
                                                                                        $answer_data = $get_answer_data[0]->ura_answer_text;
                                                                                    }
                                                                                    $explode_ans = explode("|", $answer_data);
                                                                                    ?>
                                                                                    <div class="form-group">
                                                                                        <label><?php echo $ques_data->ura_datasets_ques_title; ?>: </label>
                                                                                        <?php
                                                                                        if (!empty($explode_ans)) {
                                                                                            foreach ($explode_ans as $ans) {
                                                                                                ?>
                                                                                                <input checked type="radio" name="<?php echo $ques_data->ura_datasets_ques_title; ?>" value="<?php echo $ans; ?>"><?php echo ucfirst($ans); ?>
                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                        <button class="btn moveable_text dataset_specimen_id" data-recordid="<?php echo intval($record_id); ?>" data-datasetspecimenid="">Submit</button>
                                                                    </form>
                                                                <?php
                                                                } else {
                                                                    echo '<div class="alert alert-warning">No question found in this category, Please add questions first.</div>';
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        echo '<div class="alert alert-info">No question found in this dataset. Please add questions first from admin side.</div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                <?php } ?>
                </div>
            <?php } else { ?>
                <div class="alert alert-warning">Please add the datasets first from Admin side.</div>
    <?php } ?>
        </div>
    </div>
    <?php
    echo ob_get_clean();
}
?>


