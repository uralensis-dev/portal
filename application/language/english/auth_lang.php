<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Name:  Auth Lang - English
 *
 * Author: Ben Edmunds
 * ben.edmunds@gmail.com
 * @benedmunds
 *
 * Author: Daniel Davis
 * @ourmaninjapan
 *
 * Location: http://github.com/benedmunds/ion_auth/
 *
 * Created:  03.09.2013
 *
 * Description:  English language file for Ion Auth example views
 *
 */
// Errors
$lang['error_csrf'] = 'This form post did not pass our security checks.';

// Login
$lang['login_heading'] = 'Login';
$lang['login_subheading'] = 'Please login with your email/username and password below.';
$lang['login_identity_label'] = 'Email/Username *';
$lang['login_password_label'] = 'Password *';
$lang['login_remember_label'] = 'Remember Me:';
$lang['login_submit_btn'] = 'Login';
$lang['memorable_word_1'] = 'Enter Memorable Word - Letter ';
$lang['memorable_word_2'] = 'Enter Memorable Word - Letter ';
$lang['memorable_word_3'] = 'Enter Memorable Word - Letter ';
$lang['login_forgot_password'] = 'Forgot your password?';
$lang['Token_Enter'] = 'Enter PathHub Token sent to registered account email: ';
// Index
$lang['index_heading'] = 'Users';
$lang['index_subheading'] = 'Below is a list of the users.';
$lang['index_fname_th'] = 'First Name';
$lang['index_lname_th'] = 'Last Name';
$lang['index_email_th'] = 'Email';
$lang['index_groups_th'] = 'Groups';
$lang['index_status_th'] = 'Status';
$lang['index_action_th'] = 'Action';
$lang['index_active_link'] = 'Active';
$lang['index_inactive_link'] = 'Inactive';
$lang['index_create_user_link'] = 'Create a new user';
$lang['index_create_group_link'] = 'Create a new group';

// Deactivate User
$lang['deactivate_heading'] = 'Deactivate User';
$lang['deactivate_subheading'] = 'Are you sure you want to deactivate the user \'%s\'';
$lang['deactivate_confirm_y_label'] = 'Yes:';
$lang['deactivate_confirm_n_label'] = 'No:';
$lang['deactivate_submit_btn'] = 'Submit';
$lang['deactivate_validation_confirm_label'] = 'confirmation';
$lang['deactivate_validation_user_id_label'] = 'user ID';

// Create User
$lang['create_user_heading'] = 'Create User';
$lang['create_user_subheading'] = 'Please enter the user\'s information below.';
$lang['create_user_fname_label'] = 'First Name:';
$lang['create_user_lname_label'] = 'Last Name:';
$lang['create_user_company_label'] = 'Company Name:';
$lang['create_user_identity_label']                    = 'Identity:';
$lang['create_user_email_label'] = 'Email:';
$lang['create_user_phone_label'] = 'Phone:';
$lang['create_user_password_label'] = 'Password:';
$lang['create_user_password_confirm_label'] = 'Confirm Password:';
$lang['user_type'] = 'User Type : Use only one letter eg : For Hospitals Use only H letter and for Doctors use only D letter and For Secretary User use capital S letter and For Laboratory user use capital L letter.';
$lang['memorable'] = 'Enter Memorable Word 1 :';
$lang['memorable2'] = 'Enter Memorable Word 2 :';
$lang['memorable3'] = 'Enter Memorable Word 2 :';
$lang['create_user_validation_user_type_label'] = 'User Type';
$lang['create_user_validation_memorable_word_label'] = 'Memorable Word 1';
$lang['create_user_validation_memorable2_word_label'] = 'Memorable Word 2';
$lang['create_user_validation_memorable3_word_label'] = 'Memorable Word 3';
$lang['create_user_submit_btn'] = 'Create User';
$lang['create_user_validation_fname_label'] = 'First Name';
$lang['create_user_validation_lname_label'] = 'Last Name';
$lang['create_user_validation_identity_label']         = 'Identity';
$lang['create_user_validation_email_label'] = 'Email Address';
$lang['create_user_validation_phone_label'] = 'Phone';
$lang['create_user_validation_company_label'] = 'Company Name';
$lang['create_user_validation_password_label'] = 'Password';
$lang['create_user_validation_password_confirm_label'] = 'Password Confirmation';
$lang['create_user_validation_hospital_group_label'] = 'First Name';

// Edit User
$lang['edit_user_heading'] = 'Edit User';
$lang['edit_user_subheading'] = 'Please enter the user\'s information below.';
$lang['edit_user_fname_label'] = 'First Name:';
$lang['edit_user_lname_label'] = 'Last Name:';
$lang['edit_user_first_initial_label'] = 'First Initial:';
$lang['edit_user_last_initial_label'] = 'Last Initial:';
$lang['edit_user_company_label'] = 'Company Name:';
$lang['edit_user_email_label'] = 'Email:';
$lang['edit_user_phone_label'] = 'Phone:';
$lang['edit_user_password_label'] = 'Password: (if changing password)';
$lang['edit_user_password_confirm_label'] = 'Confirm Password: (if changing password)';
$lang['edit_user_memorable_label'] = 'Memorable';
$lang['edit_user_case_cost_label'] = 'Routine Per Case Rate';
$lang['edit_user_alopecia_case_cost_label'] = 'Alopecia Per Case Rate';
$lang['edit_user_imf_case_cost_label'] = 'IMF Per Case Rate';
$lang['edit_user_groups_heading'] = 'Member of groups';
$lang['edit_user_submit_btn'] = 'Save User';
$lang['edit_user_validation_fname_label'] = 'First Name';
$lang['edit_user_validation_lname_label'] = 'Last Name';
$lang['edit_user_validation_first_initial_label'] = 'First Initial';
$lang['edit_user_validation_last_initial_label'] = 'Last Initial';
$lang['edit_user_validation_email_label'] = 'Email Address';
$lang['edit_user_validation_phone_label'] = 'Phone';
$lang['edit_user_validation_dob_label'] = 'DOB';
$lang['edit_user_validation_company_label'] = 'Company Name';
$lang['edit_user_validation_groups_label'] = 'Groups';
$lang['edit_user_validation_password_label'] = 'Password';
$lang['edit_user_validation_password_confirm_label'] = 'Password Confirmation';
$lang['edit_user_validation_memorable_label'] = 'Memorable';
$lang['edit_user_validation_case_cost_label'] = 'Routine Per Case Rate';
$lang['edit_user_validation_alopecia_case_cost_label'] = 'Alopecia Per Case Rate';
$lang['edit_user_validation_imf_case_cost_label'] = 'IMF Per Case Rate';

// Create Group
$lang['create_group_title'] = 'Create Group';
$lang['create_group_heading'] = 'Create Group';
$lang['create_group_subheading'] = 'Please enter the group information below.';
$lang['create_group_name_label'] = 'Group Name:';
$lang['create_group_first_initial_label'] = 'First Initial:';
$lang['create_group_last_initial_label'] = 'Last Initial:';
$lang['create_group_desc_label'] = 'Description:';
// $lang['create_group_']
$lang['create_group_name_type'] = 'Gorup Type : (Enter only One Capital Letter like if this group related to Hospital then Enter only H letter and if doctor then only D letter and For Secretary use only capital S letter and For Laboratory use capital letter L.)';
$lang['create_group_report_information'] = 'Enter Group Information. (Hint : Copy the whole html which is edited according to described information and paste into this section.) <br> Please Double check the code before inserting and make sure that there is no Tag Bracket removes. (eg : &lt;tr&gt;Your Text Here&lt;/tr&gt;)<br>Also Note that this field only fill in the case of hospital its not intended to be used for doctors.';
$lang['create_group_submit_btn'] = 'Create Group';
$lang['create_group_validation_name_label'] = 'Group Name';
$lang['create_group_validation_first_initial_label'] = 'First Initial';
$lang['create_group_validation_last_initial_label'] = 'Last Initial';
$lang['create_group_validation_desc_label'] = 'Description';
$lang['create_group_lab_number_format'] = 'Choose Lab Format (Note: This Field is used for Laboratory Group)';
$lang['create_group_validation_type'] = 'Group Type';
$lang['create_group_validation_information'] = 'Group Information';

// Edit Group
$lang['edit_group_title'] = 'Edit Group';
$lang['edit_group_saved'] = 'Group Saved';
$lang['edit_group_heading'] = 'Edit Group';
$lang['edit_group_subheading'] = 'Please enter the group information below.';
$lang['edit_group_name_label'] = 'Group Name:';
$lang['edit_group_first_initial_label'] = 'First Initial:';
$lang['edit_group_last_initial_label'] = 'Last Initial:';
$lang['edit_group_group_type_label'] = 'Group Type:';
$lang['edit_group_lab_mask_label'] = 'Lab Mask:';
$lang['edit_group_desc_label'] = 'Description:';
$lang['edit_group_report_header'] = 'Report Header:';
$lang['edit_group_submit_btn'] = 'Save Group';
$lang['edit_group_validation_name_label'] = 'Group Name';
$lang['edit_group_validation_first_initial_label'] = 'First Initial';
$lang['edit_group_validation_last_initial_label'] = 'Last Initial';
$lang['edit_group_validation_desc_label'] = 'Description';

// Change Password
$lang['change_password_heading'] = 'Change Password';
$lang['change_password_old_password_label'] = 'Old Password:';
$lang['change_password_new_password_label'] = 'New Password (at least %s characters long):';
$lang['change_password_new_password_confirm_label'] = 'Confirm New Password:';
$lang['change_password_submit_btn'] = 'Change';
$lang['change_password_validation_old_password_label'] = 'Old Password';
$lang['change_password_validation_new_password_label'] = 'New Password';
$lang['change_password_validation_new_password_confirm_label'] = 'Confirm New Password';

// Forgot Password
$lang['forgot_password_heading'] = 'Forgot Password';
$lang['forgot_password_subheading'] = 'Please enter your %s so we can send you an email to reset your password.';
$lang['forgot_password_email_label'] = '%s:';
$lang['forgot_password_submit_btn'] = 'Submit';
$lang['forgot_password_validation_email_label'] = 'Email Address';
$lang['forgot_password_username_identity_label'] = 'Username';
$lang['forgot_password_identity_label'] = 'Identity';
$lang['forgot_password_email_identity_label'] = 'Email';
$lang['forgot_password_email_not_found'] = 'No record of that email address.';
$lang['forgot_password_identity_not_found']         = 'No record of that username.';

// Reset Password
$lang['reset_password_heading'] = 'Change Password';
$lang['reset_password_new_password_label'] = 'New Password (at least %s characters long):';
$lang['reset_password_new_password_confirm_label'] = 'Confirm New Password:';
$lang['reset_password_submit_btn'] = 'Change';
$lang['reset_password_validation_new_password_label'] = 'New Password';
$lang['reset_password_validation_new_password_confirm_label'] = 'Confirm New Password';
