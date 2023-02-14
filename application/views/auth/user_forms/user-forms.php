<?php
/**
 * Display Admin Form
 *
 * @return void
 */
function displayGeneralFormFields(
    $first_name,
    $last_name,
    $company,
    $phone,
    $password,
    $password_confirm,
    $email,
    $dob,
    $memorable,
    $street_address,
    $post_code,
    $additional_number,
    $gmc_no,
    $current_position,
    $current_status,
    $current_employer,
    $work_street_address,
    $work_post_code,
    $work_number,
    $work_email,
    $work_gmc_no,
    $responsible_officer,
    $revalidation_date,
    $last_appraisal_date,
    $last_appraisal_location,
    $last_appraisal_person,
    $fitness_to_practice,
    $conflict_of_interest
) {
    ob_start();
    ?>
    
    <fieldset>
        <div class="form-field-group">
            <div class="form-group tg-inputwithicon tg-input-onethird">
                <i class="lnr lnr-user"></i>
                <?php echo form_input($first_name, '', "class='form-control' placeholder='First Name'"); ?>
            </div>
            <div class="form-group tg-inputwithicon tg-input-onethird">
                <i class="lnr lnr-user"></i>
                <?php echo form_input($last_name, '', "class='form-control' placeholder='Last Name'"); ?>
            </div>
            <div class="form-group tg-inputwithicon tg-input-onethird">
                <i class="lnr lnr-calendar-full"></i>
                <?php echo form_input($dob, '', "class='form-control' placeholder='DOB'"); ?>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class="form-field-group">
            <div class="tg-usertitle"><h4>Home Details</h4></div>
            <div class="form-group tg-inputwithicon">
                <i class="lnr lnr-location"></i>
                <?php echo form_input($street_address, '', "class='form-control' placeholder='Street Address'"); ?>
            </div>

            <div class="form-group tg-inputwithicon tg-input-onethird">
                <i class="lnr lnr-tag"></i>
                <?php echo form_input($post_code, '', "class='form-control' placeholder='Post Code'"); ?>
            </div>
            <div class="form-group tg-inputwithicon tg-input-onethird">
                <i class="lnr lnr-phone-handset"></i>
                <?php echo form_input($phone, '', "class='form-control' placeholder='Phone'"); ?>
            </div>
            <div class="form-group tg-inputwithicon tg-input-onethird">
                <i class="lnr lnr-phone-handset"></i>
                <?php echo form_input($additional_number, '', "class='form-control' placeholder='Additional Number'"); ?>
            </div>

            <div class="form-group tg-inputwithicon tg-input-onethird">
                <i class="lnr lnr-envelope"></i>
                <?php echo form_input($email, '', "class='form-control' readonly"); ?>
            </div>
            <div class="form-group tg-inputwithicon tg-input-onethird">
                <i class="lnr lnr-layers"></i>
                <?php echo form_input($gmc_no, '', "class='form-control' placeholder='GMC No.'"); ?>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class="form-field-group">
            <div class="tg-usertitle"><h4>Work Details</h4></div>
            <div class="form-group tg-inputwithicon tg-input-onethird tg-inputwithlabel">
                <i class="lnr lnr-apartment"></i>
                <label for="current_position">Current Position:</label>
                <?php echo form_input($current_position, '', "class='form-control'"); ?>
            </div>
            <div class="form-group tg-inputwithicon tg-input-onethird tg-inputwithlabel">
                <i class="lnr lnr-star"></i>
                <label for="current_status">Current Status:</label>
                <?php echo form_input($current_status, '', "class='form-control'"); ?>
            </div>
            <div class="form-group tg-inputwithicon tg-input-onethird tg-inputwithlabel">
                <i class="lnr lnr-apartment"></i>
                <label for="current_employer">Current Employer:</label>
                <?php echo form_input($current_employer, '', "class='form-control'"); ?>
            </div>
            <div class="form-group tg-inputwithicon">
                <i class="lnr lnr-star"></i>
                <?php echo form_input($work_street_address, '', "class='form-control' placeholder='Street Address'"); ?>
            </div>
            <div class="form-group tg-inputwithicon tg-input-onethird">
                <i class="lnr lnr-apartment"></i>
                <?php echo form_input($work_post_code, '', "class='form-control' placeholder='Post Code'"); ?>
            </div>
            <div class="form-group tg-inputwithicon tg-input-onethird">
                <i class="lnr lnr-apartment"></i>
                <?php echo form_input($work_number, '', "class='form-control' placeholder='Work Number'"); ?>
            </div>
            <div class="form-group tg-inputwithicon tg-input-onethird">
                <i class="lnr lnr-apartment"></i>
                <?php echo form_input($work_email, '', "class='form-control' placeholder='Email'"); ?>
            </div>
            <div class="form-group tg-inputwithicon tg-input-onethird">
                <i class="lnr lnr-apartment"></i>
                <?php echo form_input($work_gmc_no, '', "class='form-control' placeholder='GMC No.'"); ?>
            </div>
            <div class="form-group tg-inputwithicon tg-input-onethird">
                <i class="lnr lnr-apartment"></i>
                <?php echo form_input($responsible_officer, '', "class='form-control' placeholder='Responsible Officer'"); ?>
            </div>
            <div class="form-group tg-inputwithicon tg-input-onethird">
                <i class="lnr lnr-apartment"></i>
                <?php echo form_input($revalidation_date, '', "class='form-control' placeholder='Date of Revalidation'"); ?>
            </div>
            <div class="form-group tg-inputwithicon tg-input-onethird tg-inputwithlabel">
                <i class="lnr lnr-apartment"></i>
                <label for="last_appraisal_date">Last Appraisal:</label>
                <?php echo form_input($last_appraisal_date, '', "class='form-control' placeholder='DD/MM/YYYY'"); ?>
            </div>
            <div class="form-group tg-inputwithicon tg-input-onethird tg-inputwithlabel">
                <i class="lnr lnr-apartment"></i>
                <label for="last_appraisal_location">Last Appraisal:</label>
                <?php echo form_input($last_appraisal_location, '', "class='form-control' placeholder='Location'"); ?>
            </div>
            <div class="form-group tg-inputwithicon tg-input-onethird tg-inputwithlabel">
                <i class="lnr lnr-apartment"></i>
                <label for="last_appraisal_person">Last Appraisal:</label>
                <?php echo form_input($last_appraisal_person, '', "class='form-control' placeholder='Person'"); ?>
            </div>
            <div class="form-group tg-inputwithicon">
                <i class="lnr lnr-apartment"></i>
                <?php echo form_input($fitness_to_practice, '', "class='form-control' placeholder='Fitness to Practice Restrictions/ Warnings/ Ongoing Investigations: If Y then they can comment'"); ?>
            </div>
            <div class="form-group tg-inputwithicon">
                <i class="lnr lnr-apartment"></i>
                <?php echo form_input($conflict_of_interest, '', "class='form-control' placeholder='Conflict of Interest: If Y then they can comment'"); ?>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <div class="form-field-group">
            <div class="tg-usertitle"><h4>Account Details</h4></div>
            <div class="form-group tg-inputwithicon tg-input-onethird">
                <i class="lnr lnr-apartment"></i>
                <?php echo form_input($company, '', "class='form-control' placeholder='Company Name'"); ?>
            </div>
            
            <div class="form-group tg-inputwithicon tg-input-onethird">
                <i class="lnr lnr-lock"></i>
                <?php echo form_input($password, '', "class='form-control' placeholder='Password'"); ?>
            </div>
            <div class="form-group tg-inputwithicon tg-input-onethird">
                <i class="lnr lnr-lock"></i>
                <?php echo form_input($password_confirm, '', "class='form-control' placeholder='Confirm Password'"); ?>
            </div>
            
            <div class="form-group tg-inputwithicon tg-input-onethird">
                <i class="lnr lnr-apartment"></i>
                <?php echo form_input($memorable, '', "class='form-control' placeholder='Memorable Word'"); ?>
            </div>
        </div>
    </fieldset>
    <?php
    echo ob_get_clean();
}

function displayOutsourceSpecialityFormFields(
    $outsource_work_name,
    $outsource_work_avail_date,
    $account_name,
    $account_number,
    $account_csv_code,
    $cases_limit,
    $cases_posted_address,
    $report_from_home,
    $receive_work_days
)
{
    ob_start();
    ?>
    <fieldset>
    <div class="form-field-group">
        <div class="tg-usertitle"><h4>Outsource Work</h4></div>
        <div class="form-group tg-inputwithicon tg-input-onefourth">
            <i class="lnr lnr-apartment"></i>
            <?php echo form_input($outsource_work_name, '', "class='form-control' placeholder='Are you working for any outsourcing companies?: If Yes, Name?'"); ?>
        </div>
        <div class="form-group tg-inputwithicon tg-input-onethird">
            <i class="lnr lnr-calendar-full"></i>
            <?php echo form_input($outsource_work_avail_date, '', "class='form-control' placeholder='Date Available'"); ?>
        </div>
    </div>
    </fieldset>
    <fieldset>
    <div class="form-field-group">
        <div class="tg-usertitle"><h4>Please List Billing/ Payments Details</h4></div>
        <div class="form-group tg-inputwithicon tg-input-onethird">
            <i class="lnr lnr-apartment"></i>
            <?php echo form_input($account_name, '', "class='form-control' placeholder='Account Name'"); ?>
        </div>
        <div class="form-group tg-inputwithicon tg-input-onethird">
            <i class="lnr lnr-phone"></i>
            <?php echo form_input($account_number, '', "class='form-control' placeholder='Account Number (XXXXXX256)'"); ?>
        </div>
        <div class="form-group tg-inputwithicon tg-input-onethird">
            <i class="lnr lnr-user"></i>
            <?php echo form_input($account_csv_code, '', "class='form-control' placeholder='Account CSV Code'"); ?>
        </div>
    </div>
    </fieldset>
    <fieldset>
    <div class="form-field-group">
        <div class="tg-usertitle"><h4>Case Related Details</h4></div>
        <nav class="tg-usergroupnav tg-usergroupnavradio">
            <ul>
                <li>
                    <div class="tg-radio">
                        <input id="tg-showa50" type="radio" name="cases_limit" value="30-50" <?php if ($cases_limit == '30-50') echo "checked='checked'"; ?>>
                        <label for="tg-showa50">30 - 50</label>
                    </div>
                </li>
                <li>
                    <div class="tg-radio">
                        <input id="tg-show70" type="radio" name="cases_limit" value="50-70" <?php if ($cases_limit == '50-70') echo "checked='checked'"; ?>>
                        <label for="tg-show70">50 - 70</label>
                    </div>
                </li>
                <li>
                    <div class="tg-radio">
                        <input id="tg-show100" type="radio" name="cases_limit" value="70-100" <?php if ($cases_limit == '70-100') echo "checked='checked'"; ?>>
                        <label for="tg-show100">70 - 100</label>
                    </div>
                </li>
                <li>
                    <div class="tg-radio">
                        <input id="tg-show130" type="radio" name="cases_limit" value="100-130" <?php if ($cases_limit == '100-130') echo "checked='checked'"; ?>>
                        <label for="tg-show130">100 - 130</label>
                    </div>
                </li>
            </ul>
            <div class="at-reportlink">
                <a href="javascript:void(0);">How many cases per week can you report?</a>
            </div>
        </nav>
        <div class="form-group tg-inputwithicon">
            <i class="lnr lnr-apartment"></i>
            <?php echo form_input($cases_posted_address, '', "class='form-control' placeholder='How would you like the cases posted to you? Address Details'"); ?>
            <p>Please note the package will need to be signed for during the daytime*</p>
        </div>
        <div class="form-group tg-inputwithicon">
            <i class="lnr lnr-apartment"></i>
            <?php echo form_input($report_from_home, '', "class='form-control' placeholder='Do you have facilities to report from home e.g. microscope/workspace? Address Details'"); ?>
        </div>
        <div class="tg-formradiohold tg-formradioholdvtwo">
            <span>What are the best days for you to receive work?</span>
            <div class="tg-radio">
                <input id="tg-monday" type="radio" name="receive_work_days" value="monday" <?php if ($receive_work_days == 'monday') echo "checked='checked'"; ?>>
                <label for="tg-monday">monday</label>
            </div>
            <div class="tg-radio">
                <input id="tg-tuesday" type="radio" name="receive_work_days" value="tuesday" <?php if ($receive_work_days == 'tuesday') echo "checked='checked'"; ?>>
                <label for="tg-tuesday">tuesday</label>
            </div>
            <div class="tg-radio">
                <input id="tg-wednesday" type="radio" name="receive_work_days" value="wednesday" <?php if ($receive_work_days == 'wednesday') echo "checked='checked'"; ?>>
                <label for="tg-wednesday">wednesday</label>
            </div>
            <div class="tg-radio">
                <input id="tg-thursday" type="radio" name="receive_work_days" value="thursday" <?php if ($receive_work_days == 'thursday') echo "checked='checked'"; ?>>
                <label for="tg-thursday">thursday</label>
            </div>
            <div class="tg-radio">
                <input id="tg-friday" type="radio" name="receive_work_days" value="friday" <?php if ($receive_work_days == 'friday') echo "checked='checked'"; ?>>
                <label for="tg-friday">friday</label>
            </div>
            <div class="tg-radio">
                <input id="tg-weekend" type="radio" name="receive_work_days" value="weekend" <?php if ($receive_work_days == 'weekend') echo "checked='checked'"; ?>>
                <label for="tg-weekend">weekend</label>
            </div>
        </div>
    </div>
    </fieldset>
    <fieldset>
        <div class="form-field-group">
            <div class="tg-usertitle"><h4>Member of Groups</h4></div>
            <div class="form-group tg-input-onethird">
            <ul class="tg-checkboxmt-holder">
                <li>
                    <div class="tg-checkboxmt">
                        <span class="tg-checkbox">
                            <input type="checkbox" id="tg-id1" name="tg-id1" value="tg-id1">
                            <label for="tg-id1"><span>bone</span></label>
                        </span>
                    </div>
                </li>
            </ul>
            </div>
        </div>
    </fieldset>
    <?php
    echo ob_get_clean();
}