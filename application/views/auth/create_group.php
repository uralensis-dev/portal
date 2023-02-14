<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div id="infoMessage">
                <?php echo html_purify($message); ?>
            </div>
            <div class="tg-dashboardbox">
                <div class="tg-dashboardboxtitle">
                    <h2>
                        <?php echo lang('create_group_heading'); ?>
                    </h2>
                    <span>
                        <?php echo lang('create_group_subheading'); ?></span>
                </div>
                <div class="well" style="width:100%;float:left;">
                    <p>
                        <i style="color:red;">
                            This code will print on each hospital report on bottom section. Make sure
                            first that every thing is correct then enter the html code on left side in Group
                            Information Box.
                        </i>
                    </p>
                    <textarea rows="60" cols="20" style="width: 100%; height: 500px;">
                        <table>
                            <tr>
                                <td  width="24%" style="font-size:13px;text-align:right;">
                                    <table>
                                        <tr><td><b>Uralensis Ltd</b></td></tr>
                                        <tr><td><a href="http://uralensis.com">http://uralensis.com</a></td></tr>
                                        <tr><td><a href="mailto:iskander.chaudhry@nhs.net">iskander.chaudhry@nhs.net</a> </td></tr>
                                        <tr><td>Office: 01619808882</td></tr>
                                <tr><td>305 Brooklands Road</td></tr>
                                        <tr><td>Manchester</td></tr>
                                        <tr><td>M239HE</td></tr>
                                    </table>
                                </td>
                            <td width="3.7%"></td>
                            <td width="30%" style="font-size:13px;text-align:left;">
                                    <table>
                                        <tr><td><b>Virgin Care Limited</b></td></tr>
                                        <tr><td>6400 Daresbury Business Park</td></tr>
                                        <tr><td>Daresbury</td></tr>
                                        <tr><td>Warrington </td></tr>
                                <tr><td>WA4 4GE </td></tr>
                                <tr><td>Account holder is Mark Dollar </td></tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </textarea>
                </div>
                <div class="tg-editformholder">
                    <?php echo form_open("auth/create_group", array('class' => 'tg-formtheme create_user_form')); ?>
                    <fieldset>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo lang('create_group_name_label', 'group_name'); ?> <br />
                                <?php echo form_input($group_name, '', "class='form-control'"); ?>
                            </div>
                            <div class="form-group">
                                <?php echo lang('create_group_last_initial_label', 'last_initial'); ?> <br />
                                <?php echo form_input($last_initial, '', "class='form-control'"); ?>
                            </div>
                            <div class="form-group">
                                <?php echo lang('create_group_name_type', 'group_type'); ?> <br />
                                <?php
                                $data = array(
                                    'type' => 'text',
                                    'name' => 'group_type',
                                    'id' => 'group_type',
                                    'required' => 'required'
                                );
                                echo form_input($data, '', "class='form-control'");
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $pci_format = sprintf("%s%u%s", 'PU', date('y'), '-99999');
                                $accute_format = sprintf("%s%u%s", 'S', date('y'), '/99999');
                                $cheshire_format = sprintf("%s%s%u", 'H', '/99999/', date('y'));
                                $christie_format = sprintf("%s%u%s", 'H', date('y'), '-99999');
                                $nnu_format = sprintf("%u%s%s", date('y'), 'S', '99999');
                                $other_format = sprintf("U", 'U');
                                ?>
                                <?php echo lang('create_group_lab_number_format', 'lab_number_format'); ?>
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
                            <div class="form-group">
                                <input type="text" readonly class="form-control lab_number_mask">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo lang('create_group_first_initial_label', 'first_initial'); ?> <br />
                                <?php echo form_input($first_initial, '', "class='form-control'"); ?>
                            </div>
                            <div class="form-group">
                                <?php echo lang('create_group_desc_label', 'description'); ?> <br />
                                <?php echo form_input($description, '', "class='form-control'"); ?>
                            </div>
                            <div class="form-group">
                                <?php echo lang('create_group_report_information', 'group_info'); ?> <br />
                                <?php
                                $data = array(
                                    'name' => 'group_info',
                                    'id' => 'group_info',
                                    'width' => '100%',
                                    'cols' => '60',
                                    'rows' => '10'
                                );
                                echo form_textarea($data, '', "class='form-control'");
                                ?>
                            </div>
                        </div>
                    </fieldset>
                    <div class="tg-btnarea">
                        <button type="submit" class="tg-btn">
                            <?php echo lang('create_group_submit_btn'); ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>