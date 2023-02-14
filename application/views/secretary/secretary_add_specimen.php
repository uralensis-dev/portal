<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <h1 style="text-align: center;">Add Specimen</h1>
        <hr />
        <?php
        if ($this->session->flashdata('record_add_msg') != '') {
            ?>
            <?php echo $this->session->flashdata('record_add_msg'); ?>
        <?php } ?>
        <?php
        if ($this->session->flashdata('specimen_add_msg') != '') {
            ?>
            <?php echo $this->session->flashdata('specimen_add_msg'); ?>
        <?php } ?>
        <form class="form" method="post" action="<?php echo site_url('secretary/add_specimen'); ?>">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Specimen Site (T Code)</label>
                    <input type="text" class="form-control" name="specimen_site" id="date" placeholder="Specimen Site"/>
                </div>
                <div class="form-group">
                    <label for="specimen">Specimen Type</label>
                    <select name="specimen_type" id="specimen"  class="form-control">
                        <?php
                        $data['query'] = $this->Secretary_model->specimen_type();
                        foreach ($data['query'] as $type) :
                            ?>
                            <option <?php echo $type->rtypeid == 5 ? ' selected="selected"' : ''; ?> value="<?php echo html_purify($type->rtypetitle); ?>"><?php echo html_purify($type->rtypetitle); ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>
                <div class="form-group">
                    <label for="specimen_block">Specimen Block</label>
                    <i>Please Add Codes Before Selecting.</i>
                    <select name="specimen_block" id="specimen_block"  class="form-control">
                        <?php
                        if (!empty($cost_codes)) {
                            foreach ($cost_codes as $codes) {
                                ?>
                                <option value="<?php echo html_purify($codes->ura_cost_code_desc); ?>"><?php echo html_purify($codes->ura_cost_code_desc); ?></option>
                                <?php
                            }//endforeach
                        }//endif
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Specimen Slides</label>
                    <input type="text" class="form-control" name="specimen_slides" id="date" placeholder="Specimen Slides"/>
                </div>
                <div class="form-group">
                    <label>Specimen Block Type</label>
                    <input type="text" class="form-control" name="specimen_block_type" id="date" placeholder="Specimen Block Type"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Specimen Procedure (P Code)</label>
                    <input type="text" class="form-control" name="specimen_procedure" id="date" placeholder="Specimen Procedure"/>
                </div>
                <div class="form-group">
                    <label>Specimen Macroscopic Description</label>
                    <input type="text" class="form-control" name="specimen_macroscopic_description" id="date" placeholder="Specimen Macroscopic Description"  />
                </div>
                <div class="form-group">
                    <label>Specimen Diagnosis</label>
                    <input type="text" class="form-control" name="specimen_diagnosis" id="date" placeholder="Specimen Diagnosis Description"  />
                </div>
                <div class="form-group">
                    <label>Specimen Cancer Register</label>
                    <input type="text" class="form-control" name="specimen_cancer_register" id="date" placeholder="Specimen Cancer Register"  />
                </div>
                <div class="form-group">
                    <label for="rcpath_code">RCPath Code</label>
                    <select name="rcpath_code" class="form-control">
                        <?php
                        $rcpath_array = array(
                            '0' => '0',
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                            '7' => '7',
                            '8' => '8',
                            '9' => '9',
                            '10' => '10',
                            '11' => '11',
                            '12' => '12',
                            '13' => '13',
                            '14' => '14',
                            '15' => '15',
                            '16' => '16',
                            '17' => '17',
                            '18' => '18',
                            '19' => '19',
                            '20' => '20'
                        );
                        foreach ($rcpath_array as $key => $rcpath_code) {
                            ?>
                            <option value="<?php echo intval($key); ?>"><?php echo intval($rcpath_code); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <button name="submit" type="submit" class="btn btn-primary">Add Specimen</button>
            </div>
        </form>
        <?php
        if ($this->session->flashdata('specimen_add_msg')) {
            ?>
            <div class="pull-right"><button id="finish_specimen" class="btn btn-warning">Finish Specimen</button></div>
        <?php } ?>
    </div>
</div>


