<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <div class="clearfix"></div>
        <div id="infoMessage">
            <?php echo html_purify($message); ?>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="tg-dashboardbox tg-userhistoryhold">
                <div class="tg-dashboardboxtitle">
                    <h2>
                        <?php echo lang('edit_group_heading'); ?>
                    </h2>
                    <p>
                        <?php echo lang('edit_group_subheading'); ?>
                    </p>
                </div>
                    <div class="col-md-8 mx-auto">
                        <?php echo form_open(current_url(), array('class' => 'tg-formtheme create_user_form')); ?>
                        <div class="tg-editformholder">
                            <fieldset>
                <div class="row">
                                
                                <div class="col-md-6 mb-3">
                                        <?php echo lang('edit_group_group_type_label', 'group_type'); ?> <br />
                                        <?php echo form_input(html_purify($group_type), '', "class='form-control'"); ?>
                                    </div>
                                   
                                    <div class="col-md-6 mb-3">
                                        <?php echo lang('edit_group_desc_label', 'Name'); ?> <br />
                                        <?php echo form_input(html_purify($group_description), '', "class='form-control'"); ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <?php echo lang('edit_group_first_initial_label', 'first_initial'); ?> <br />
                                        <?php echo form_input(html_purify($first_initial), '', "class='form-control'"); ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <?php echo lang('edit_group_last_initial_label', 'last_initial'); ?> <br />
                                        <?php echo form_input(html_purify($last_initial), '', "class='form-control'"); ?>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-md-6 mb-3">
                                       Address <br />
                                        <?php echo form_input(html_purify($hospital_address), '', "class='form-control'"); ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        City <br />
                                        <?php echo form_input(html_purify($hospital_city), '', "class='form-control'"); ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        State <br />
                                        <?php echo form_input(html_purify($hospital_state), '', "class='form-control'"); ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        Post Code <br />
                                        <?php echo form_input(html_purify($hospital_post_code), '', "class='form-control'"); ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        Phone No <br />
                                        <?php echo form_input(html_purify($hospital_number), '', "class='form-control'"); ?>
                                    </div>
                                    
                                    <?php if(!empty($group_type) &&
                                    $group_type['value'] === 'L') { ?>
                                    <div class="col-md-6 mb-3">
                                        <?php
                                            $pci_format = sprintf("%s%u%s", 'PU', date('y'), '-99999');
                                            $accute_format = sprintf("%s%u%s", 'S', date('y'), '/99999');
                                            $cheshire_format = sprintf("%s%s%u", 'H', '/99999/', date('y'));
                                            $christie_format = sprintf("%s%u%s", 'H', date('y'), '-99999');
                                            $nnu_format = sprintf("%u%s%s", date('y'), 'S', '99999');
                                            $other_format = sprintf("U", 'U');
                                        ?>
                                        <?php echo lang('create_group_lab_number_format', 'lab_number_format').' --- '. html_purify($lab_mask); ?>
                                        <select name="group_lab_number_format" id="group_lab_number_format" class="form-control group_lab_number_format">
                                            <option value="">Choose Format</option>
                                            <option value="<?php echo $pci_format; ?>">PCI</option>
                                            <option value="<?php echo $accute_format; ?>">Acute Pennine</option>
                                            <option value="<?php echo $cheshire_format; ?>">Mid-Cheshire</option>
                                            <option value="<?php echo $christie_format; ?>">Christie</option>
                                            <option value="<?php echo $nnu_format; ?>">NNU</option>
                                            <option value="<?php echo $other_format; ?>">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" readonly class="form-control lab_number_mask" value="<?php echo html_purify($lab_mask); ?>">
                                    </div>
                                    <?php } ?>
                                </div>

                                <div class="mb-3">                                    
                                    <?php if(!empty($group_type) &&
                                    $group_type['value'] !== 'L' 
                                    && $group_type['value'] !== 'D') { ?>
                                        <?php echo lang('edit_group_report_header', 'report_header'); ?> <br />
                                        <?php echo form_textarea($report_header, '', "class='form-control'"); ?>
                                    <?php } ?>
                                </div>
                            </fieldset>
                            <?php if(!empty($group_type) && $group_type['value'] === 'L') { ?>
                            <div class="tg-groupschecks">
                                <div class="tg-title">
                                    <h4>Select Default User</h4>
                                </div>
                                <div class="tg-formradiohold">
                                    <?php
                                        if ($this->ion_auth->is_admin()) {
                                        $group_id = $this->uri->segment(3);
                                        $users_data = getAllUsersByGroupId(intval($group_id));
                                        if (!empty($users_data)) {  
                                            $count_user = 0;
                                            foreach ($users_data as $user_key => $user_val) {
                                                $user_id_from_group_table = getSpecificUserIdFromGroups(intval($user_val['id']));
                                                
                                                $checked = '';
                                                if ($user_id_from_group_table === $user_val['id']) {
                                                    $checked = 'checked';
                                                }
                                    ?>
                                    <div class="tg-radio">
                                        <input <?php echo $checked; ?> id="tg-setdefaultuser-<?php echo $count_user ?>" type="radio" name="set_default_user" value="<?php echo intval($user_val['id']); ?>">
                                        <label for="tg-setdefaultuser-<?php echo $count_user ?>"><?php echo uralensis_get_username(intval($user_val['id'])); ?></label>
                                    </div>
                                    <?php $count_user++; } ?>
                                    <?php }
                                } ?>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="tg-btnarea text-center">
                                <button type="submit" class="btn btn-primary" style="border-radius: 6px;">
                                    <i class="fa fa-save"> </i> &nbsp;<?php echo lang('edit_group_submit_btn'); ?>
                                </button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>