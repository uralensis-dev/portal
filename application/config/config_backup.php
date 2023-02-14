<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ENVIRONMENT == 'new-york' ?: date_default_timezone_set('Europe/London');
/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| URL to your CodeIgniter root. Typically this will be your base URL,
| WITH a trailing slash:
|
|	http://example.com/
|
| If this is not set then CodeIgniter will try guess the protocol, domain
| and path to your installation. However, you should always configure this
| explicitly and never rely on auto-guessing, especially in production
| environments.
|
*/
$config['base_url'] = 'https://localhost/msk/';
/*
|--------------------------------------------------------------------------
| Index File
|--------------------------------------------------------------------------
|
| Typically this will be your index.php file, unless you've renamed it to
| something else. If you are using mod_rewrite to remove the page set this
| variable so that it is blank.
|
*/
$config['index_page'] = 'index.php';
/*
|--------------------------------------------------------------------------
| URI PROTOCOL
|--------------------------------------------------------------------------
|
| This item determines which server global should be used to retrieve the
| URI string.  The default setting of 'REQUEST_URI' works for most servers.
| If your links do not seem to work, try one of the other delicious flavors:
|
| 'REQUEST_URI'    Uses $_SERVER['REQUEST_URI']
| 'QUERY_STRING'   Uses $_SERVER['QUERY_STRING']
| 'PATH_INFO'      Uses $_SERVER['PATH_INFO']
|
| WARNING: If you set this to 'PATH_INFO', URIs will always be URL-decoded!
*/
$config['uri_protocol'] = 'REQUEST_URI';
/*
|--------------------------------------------------------------------------
| URL suffix
|--------------------------------------------------------------------------
|
| This option allows you to add a suffix to all URLs generated by CodeIgniter.
| For more information please see the user guide:
|
| http://codeigniter.com/user_guide/general/urls.html
*/
$config['url_suffix'] = '';
/*
|--------------------------------------------------------------------------
| Default Language
|--------------------------------------------------------------------------
|
| This determines which set of language files should be used. Make sure
| there is an available translation if you intend to use something other
| than english.
|
*/
$config['language'] = 'english';
/*
|--------------------------------------------------------------------------
| Default Character Set
|--------------------------------------------------------------------------
|
| This determines which character set is used by default in various methods
| that require a character set to be provided.
|
| See http://php.net/htmlspecialchars for a list of supported charsets.
|
*/
$config['charset'] = 'UTF-8';
/*
|--------------------------------------------------------------------------
| Enable/Disable System Hooks
|--------------------------------------------------------------------------
|
| If you would like to use the 'hooks' feature you must enable it by
| setting this variable to TRUE (boolean).  See the user guide for details.
|
*/
$config['enable_hooks'] = TRUE;
$config['maintenance_mode'] = FALSE;
/*
|--------------------------------------------------------------------------
| Class Extension Prefix
|--------------------------------------------------------------------------
|
| This item allows you to set the filename/classname prefix when extending
| native libraries.  For more information please see the user guide:
|
| http://codeigniter.com/user_guide/general/core_classes.html
| http://codeigniter.com/user_guide/general/creating_libraries.html
|
*/
$config['subclass_prefix'] = 'MY_';
/*
|--------------------------------------------------------------------------
| Composer auto-loading
|--------------------------------------------------------------------------
|
| Enabling this setting will tell CodeIgniter to look for a Composer
| package auto-loader script in application/vendor/autoload.php.
|
|	$config['composer_autoload'] = TRUE;
|
| Or if you have your vendor/ directory located somewhere else, you
| can opt to set a specific path as well:
|
|	$config['composer_autoload'] = '/path/to/vendor/autoload.php';
|
| For more information about Composer, please visit http://getcomposer.org/
|
| Note: This will NOT disable or override the CodeIgniter-specific
|	autoloading (application/config/autoload.php)
*/
$config['composer_autoload'] = FALSE;
/*
|--------------------------------------------------------------------------
| Allowed URL Characters
|--------------------------------------------------------------------------
|
| This lets you specify which characters are permitted within your URLs.
| When someone tries to submit a URL with disallowed characters they will
| get a warning message.
|
| As a security measure you are STRONGLY encouraged to restrict URLs to
| as few characters as possible.  By default only these are allowed: a-z 0-9~%.:_-
|
| Leave blank to allow all characters -- but only if you are insane.
|
| The configured value is actually a regular expression character group
| and it will be executed as: ! preg_match('/^[<permitted_uri_chars>]+$/i
|
| DO NOT CHANGE THIS UNLESS YOU FULLY UNDERSTAND THE REPERCUSSIONS!!
|
*/
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';
/*
|--------------------------------------------------------------------------
| Enable Query Strings
|--------------------------------------------------------------------------
|
| By default CodeIgniter uses search-engine friendly segment based URLs:
| example.com/who/what/where/
|
| By default CodeIgniter enables access to the $_GET array.  If for some
| reason you would like to disable it, set 'allow_get_array' to FALSE.
|
| You can optionally enable standard query string based URLs:
| example.com?who=me&what=something&where=here
|
| Options are: TRUE or FALSE (boolean)
|
| The other items let you set the query string 'words' that will
| invoke your controllers and its functions:
| example.com/index.php?c=controller&m=function
|
| Please note that some of the helpers won't work as expected when
| this feature is enabled, since CodeIgniter is designed primarily to
| use segment based URLs.
|
*/
$config['allow_get_array'] = TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd';
/*
|--------------------------------------------------------------------------
| Error Logging Threshold
|--------------------------------------------------------------------------
|
| If you have enabled error logging, you can set an error threshold to
| determine what gets logged. Threshold options are:
| You can enable error logging by setting a threshold over zero. The
| threshold determines what gets logged. Threshold options are:
|
|	0 = Disables logging, Error logging TURNED OFF
|	1 = Error Messages (including PHP errors)
|	2 = Debug Messages
|	3 = Informational Messages
|	4 = All Messages
|
| You can also pass an array with threshold levels to show individual error types
|
| 	array(2) = Debug Messages, without Error Messages
|
| For a live site you'll usually only enable Errors (1) to be logged otherwise
| your log files will fill up very fast.
|
*/
$config['log_threshold'] = 1;
/*
|--------------------------------------------------------------------------
| Error Logging Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| application/logs/ directory. Use a full server path with trailing slash.
|
*/
$config['log_path'] = '';
/*
|--------------------------------------------------------------------------
| Log File Extension
|--------------------------------------------------------------------------
|
| The default filename extension for log files. The default 'php' allows for
| protecting the log files via basic scripting, when they are to be stored
| under a publicly accessible directory.
|
| Note: Leaving it blank will default to 'php'.
|
*/
$config['log_file_extension'] = '';
/*
|--------------------------------------------------------------------------
| Log File Permissions
|--------------------------------------------------------------------------
|
| The file system permissions to be applied on newly created log files.
|
| IMPORTANT: This MUST be an integer (no quotes) and you MUST use octal
|            integer notation (i.e. 0700, 0644, etc.)
*/
$config['log_file_permissions'] = 0644;
/*
|--------------------------------------------------------------------------
| Date Format for Logs
|--------------------------------------------------------------------------
|
| Each item that is logged has an associated date. You can use PHP date
| codes to set your own date formatting
|
*/
$config['log_date_format'] = 'Y-m-d H:i:s';
/*
|--------------------------------------------------------------------------
| Error Views Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| application/views/errors/ directory.  Use a full server path with trailing slash.
|
*/
$config['error_views_path'] = '';
/*
|--------------------------------------------------------------------------
| Cache Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| application/cache/ directory.  Use a full server path with trailing slash.
|
*/
$config['cache_path'] = '';
/*
|--------------------------------------------------------------------------
| Cache Include Query String
|--------------------------------------------------------------------------
|
| Set this to TRUE if you want to use different cache files depending on the
| URL query string.  Please be aware this might result in numerous cache files.
|
*/
$config['cache_query_string'] = TRUE;
/*
|--------------------------------------------------------------------------
| Encryption Key
|--------------------------------------------------------------------------
|
| If you use the Encryption class, you must set an encryption key.
| See the user guide for more info.
|
| http://codeigniter.com/user_guide/libraries/encryption.html
|
*/
$config['encryption_key'] = 'KeyReport';
/*
|--------------------------------------------------------------------------
| Session Variables
|--------------------------------------------------------------------------
|
| 'sess_driver'
|
|	The storage driver to use: files, database, redis, memcached
|
| 'sess_cookie_name'
|
|	The session cookie name, must contain only [0-9a-z_-] characters
|
| 'sess_expiration'
|
|	The number of SECONDS you want the session to last.
|	Setting to 0 (zero) means expire when the browser is closed.
|
| 'sess_save_path'
|
|	The location to save sessions to, driver dependant.
|
|	For the 'files' driver, it's a path to a writable directory.
|	WARNING: Only absolute paths are supported!
|
|	For the 'database' driver, it's a table name.
|	Please read up the manual for the format with other session drivers.
|
|	IMPORTANT: You are REQUIRED to set a valid save path!
|
| 'sess_match_ip'
|
|	Whether to match the user's IP address when reading the session data.
|
| 'sess_time_to_update'
|
|	How many seconds between CI regenerating the session ID.
|
| 'sess_regenerate_destroy'
|
|	Whether to destroy session data associated with the old session ID
|	when auto-regenerating the session ID. When set to FALSE, the data
|	will be later deleted by the garbage collector.
|
| Other session cookie settings are shared with the rest of the application,
| except for 'cookie_prefix' and 'cookie_httponly', which are ignored here.
|
*/
$config['sess_driver'] = 'database';
$config['sess_cookie_name'] = 'ci_session';
$config['sess_expiration'] = 7200;
$config['sess_save_path'] = 'ci_sessions';
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;
/*
|--------------------------------------------------------------------------
| Cookie Related Variables
|--------------------------------------------------------------------------
|
| 'cookie_prefix'   = Set a cookie name prefix if you need to avoid collisions
| 'cookie_domain'   = Set to .your-domain.com for site-wide cookies
| 'cookie_path'     = Typically will be a forward slash
| 'cookie_secure'   = Cookie will only be set if a secure HTTPS connection exists.
| 'cookie_httponly' = Cookie will only be accessible via HTTP(S) (no javascript)
|
| Note: These settings (with the exception of 'cookie_prefix' and
|       'cookie_httponly') will also affect sessions.
|
*/
$config['cookie_prefix'] = '';
$config['cookie_domain'] = '';
$config['cookie_path'] = '/';
$config['cookie_secure'] = FALSE;
$config['cookie_httponly'] = FALSE;
/*
|--------------------------------------------------------------------------
| Standardize newlines
|--------------------------------------------------------------------------
|
| Determines whether to standardize newline characters in input data,
| meaning to replace \r\n, \r, \n occurences with the PHP_EOL value.
|
| This is particularly useful for portability between UNIX-based OSes,
| (usually \n) and Windows (\r\n).
|
*/
$config['standardize_newlines'] = FALSE;
/*
|--------------------------------------------------------------------------
| Global XSS Filtering
|--------------------------------------------------------------------------
|
| Determines whether the XSS filter is always active when GET, POST or
| COOKIE data is encountered
|
| WARNING: This feature is DEPRECATED and currently available only
|          for backwards compatibility purposes!
|
*/
$config['global_xss_filtering'] = FALSE;
/*
|--------------------------------------------------------------------------
| Cross Site Request Forgery
|--------------------------------------------------------------------------
| Enables a CSRF cookie token to be set. When set to TRUE, token will be
| checked on a submitted form. If you are accepting user data, it is strongly
| recommended CSRF protection be enabled.
|
| 'csrf_token_name' = The token name
| 'csrf_cookie_name' = The cookie name
| 'csrf_expire' = The number in seconds the token should expire.
| 'csrf_regenerate' = Regenerate token on every submission
| 'csrf_exclude_uris' = Array of URIs which ignore CSRF checks
*/
$config['csrf_protection'] = TRUE;
$config['csrf_token_name'] = 'csrf_token';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$csrf_ignore = [
    '/doctor/save_user_view_status',
    '/doctor/add_specimen_doctor/[0-9]+',
    'doctor/update_client_report',
    '/doctor/check_auth_pass',
    '/doctor/update_only_report',
    '/doctor/publish_additional_work',
    '/doctor/display_published_reports_ajax_processing/',
    '/doctor/add_comments_section',
    '/doctor/clear_comments_section',
    '/doctor/add_special_notes',
    '/doctor/clear_special_notes',
    '/doctor/change_pin',
    '/doctor/change_password_doctor',
    '/doctor/further_work',
    '/doctor/insert_pm_by_doctor',
    '/doctor/assign_doctor',
    '/doctor/assign_mdt_record',
    '/doctor/assign_mdt_record',
    '/doctor/add_mdt_message',
    '/doctor/assign_opinion_cases',
    '/doctor/save_opinion_reply',
    '/doctor/set_input_change_color',
    '/doctor/set_microscopic_data',
    '/doctor/update_track_edit_temp_data',
    '/doctor/save_new_track_temp_data',
    '/doctor/save_flag_comments',
    '/doctor/addSnomedCodes',
    '/doctor/add_microscopic_codes',
    '/doctor/edit_microscopic_code',
    '/doctor/delete_specimen',
    '/doctor/add_record_to_authorization',
    '/doctor/set_flag_status',
    '/doctor/set_teach_and_mdt',
    '/doctor/do_upload/[0-9]+',
    '/doctor/set_color_code_session_data',
    'doctor/create_new_session_track_record_list',
    '/doctor/load_track_new_template',
    '/doctor/search_and_add_barcode_record',
    '/doctor/doctor_record_detail/[0-9]+',
    '/Institute/published_reports_ajax_load',
    '/Institute/viewed_reports_ajax_load',
    '/institute/find_prev_mdt_cases_new',
    '/admin/display_all_ajax_processing/',
    '/admin_tracking/SearchTracking/search_and_add_barcode_record',
    '/admin_tracking/SearchTracking/search_template_session_record_data',
    '/admin/generate_imf_reprot',
    '/admin/assign_dermatological_surgeon',
    '/doctor/set_populate_micro_data',
    '/institute/aleatha_image_uploader',
    '/institute/save_upload_area_document',
    'institute/update_upload_area_document_perms',
    '/institute/delete_upload_area_document_db',
    '/institute/cl_doc_save_upload_area_document',
    '/institute/cl_doc_delete_upload_area_document_db',
    '/institute/get_load_template_data_tags',
    '/institute/search_and_add_barcode_record',
    '/institute/create_new_session_track_record_list',
    '/institute/load_track_new_template',
    '/institute/save_new_track_temp_data',
    '/institute/save_flag_comments',
    '/institute/set_flag_status',
    '/institute/show_comments_box',
    '/institute/delete_flag_comments',
    '/doctor/manage_supplemenary',
    '/doctor/display_edu_cases',
    '/doctor/msg_trashsent_doctor',
    '/doctor/delete_trash_doctor',
    '/doctor/find_mdt_cases_new',
    '/doctor/find_prev_mdt_cases',
    '/doctor/find_mdt_dates',
    '/doctor/find_mdt_dates_new',
    '/doctor/find_mdt_dates_on_mdt_lists',
    '/doctor/find_mdt_dates_on_mdt_lists_new',
    '/doctor/find_prev_mdt_dates',
    '/doctor/find_prev_mdt_dates_new',
    '/doctor/find_prev_mdt_dates_on_mdt_lists',
    '/doctor/find_prev_mdt_dates_on_mdt_lists_new',
    '/doctor/publish_bulk_reports_authrization',
    '/doctor/search_lab_number_mask',
    '/doctor/find_lab_number_records',
    '/doctor/delete_mdt_record_note',
    '/doctor/add_mdt_record_note_on_report',
    '/doctor/search_barcode_record',
    '/admin/search_barcode_record',
    '/doctor/set_doctor_record_history_track_status',
    '/doctor/search_hospital_group_users',
    '/doctor/load_track_new_template',
    '/doctor/get_load_template_data_tags',
    '/doctor/load_track_edit_template_data',
    '/doctor/show_comments_box',
    '/doctor/delete_flag_comments',
    '/doctor/sendMessageSnomedToAdmin',
    '/doctor/sendMessageMicrocodeToAdmin',
    '/institute/find_matching_records',
    '/institute/msg_trashinbox_institute',
    '/institute/msg_trashsent_institute',
    '/institute/delete_trash_institute',
    '/institute/find_mdt_cases',
    '/institute/find_mdt_cases_new',
    '/institute/find_prev_mdt_cases',
    '/institute/delete_clinic_upload_files',
    '/institute/set_populate_request_form',
    '/institute/find_lab_number_records',
    '/institute/mark_read_records',
    '/institute/delete_mdt_record_note',
    '/institute/add_mdt_record_note_on_report',
    '/institute/load_track_edit_template_data',
    '/institute/delete_institute_document_file',
    '/institute/delete_upload_area_document',
    '/institute/cl_doc_update_upload_area_document_perms',
    '/institute/load_accumulative_yearly_invoices',
    '/institute/download_document_file',
    '/institute/saveIncidentReport',
    '/institute/updateIncidentReport',
    '/institute/deleteIncidentReport',
	'/admin/change_account_status',
	'/Admin/saveMdtCategory',
    '/admin/add_mdt_dates',
    'Api/register',
    'Api/login',
    'Api/userupdate',
    '/Admin/edit_report',
    '/admin/save_batch_assign',
    '/admin/aleatha_image_uploader',
    'Api/userprofile',
    'Api/emailExist',
    'Api/specimenslide',
    'Api/caserecordupload',
    '/institute/getTemplates',
    'Api/getPatientRecords',
    '/institute/SubmitSpecimenHospital',
    '/institute/updateTemplateWithId',
    '/institute/AddSubmitSpecimenHospital',
    '/institute/deletespeciment',
    '/doctor/do_upload/[0-9]+',
    '/institute/getTCodes',
    '/pm/markasread',
	'/Project/saveData',
    '/Project/getUsers',
    '/Project/getProjectData',
    '/Project/removeAttachment',
    '/chat/search_user',
    '/chat/check_chat_notification',
    '/chat/load_chat_user',
    '/chat/load_notification',
    '/chat/send_request',
    '/chat/load_chat_data',
    '/chat/send_chat',
    '/chat/accept_request',
    '/admin/save_dataset_cat_name',
    '/admin/save_dataset_question_data',
    '/auth/update_job_plan',
    '/auth/delete_job_plan',
    '/doctor/search_request',
    '/chat/creatgroup',
    '/chat/chat_message',
    '/pm/deletedraft',
    '/pm/createlabel',
    '/pm/markaslabeled',
    '/allocator/allocate_specialty'
    
];
foreach ($csrf_ignore as $ci) {
    if (strpos($_SERVER["REQUEST_URI"], $ci) !== FALSE) {
        $config['csrf_protection'] = FALSE;
        break;
    }
}
$config['csrf_regenerate'] = FALSE;
$config['csrf_exclude_uris'] = array('/pm/markaslabeled','/pm/createlabel','/pm/deletedraft','/chat/chat_message','/chat/creatgroup','/doctor/search_request','/admin/save_dataset_question_data','/admin/save_dataset_cat_name','/chat/accept_request','/chat/send_chat','/chat/load_chat_data','/chat/send_request','/chat/load_notification','/chat/load_chat_user','/chat/check_chat_notification','/chat/search_user','/pm/markasread','/institute/getTCodes','/institute/deletespeciment','/institute/AddSubmitSpecimenHospital','/institute/updateTemplateWithId','/institute/SubmitSpecimenHospital','Api/getPatientRecords','/institute/getTemplates','Api/caserecordupload','Api/emailExist','Api/userprofile','/admin/aleatha_image_uploader','/admin/save_batch_assign','/Admin/edit_report','Api/userupdate','Api/login','Api/register','/admin/add_mdt_dates','/Admin/saveMdtCategory','/admin/change_account_status','/institute/deleteIncidentReport','/institute/updateIncidentReport','/institute/saveIncidentReport','/institute/download_document_file','/institute/load_accumulative_yearly_invoices','/institute/cl_doc_update_upload_area_document_perms','/institute/delete_upload_area_document','/institute/delete_institute_document_file','/institute/load_track_edit_template_data','/institute/add_mdt_record_note_on_report','/institute/delete_mdt_record_note','/institute/mark_read_records','/institute/find_lab_number_records','/institute/set_populate_request_form','/institute/delete_clinic_upload_files','/institute/find_prev_mdt_cases','/institute/find_mdt_cases_new','/institute/find_mdt_cases','/institute/delete_trash_institute','/institute/msg_trashsent_institute','/institute/msg_trashinbox_institute','/institute/find_matching_records','/doctor/sendMessageMicrocodeToAdmin','/doctor/sendMessageSnomedToAdmin','/doctor/delete_flag_comments','/doctor/show_comments_box','/doctor/load_track_edit_template_data','/doctor/get_load_template_data_tags','/doctor/load_track_new_template','/doctor/search_hospital_group_users','/doctor/set_doctor_record_history_track_status','/admin/search_barcode_record','/doctor/search_barcode_record','/doctor/add_mdt_record_note_on_report','/doctor/delete_mdt_record_note','/doctor/find_lab_number_records','/doctor/search_lab_number_mask','/doctor/publish_bulk_reports_authrization','/doctor/find_prev_mdt_dates_on_mdt_lists_new','/doctor/find_prev_mdt_dates_on_mdt_lists','/doctor/find_prev_mdt_dates_new','/doctor/find_prev_mdt_dates','/doctor/find_mdt_dates_on_mdt_lists_new','/doctor/find_mdt_dates_on_mdt_lists','/doctor/find_mdt_dates_new','/doctor/find_mdt_dates','/doctor/find_prev_mdt_cases','/doctor/find_mdt_cases_new','/doctor/delete_trash_doctor','/doctor/msg_trashsent_doctor','/doctor/display_edu_cases','/doctor/manage_supplemenary','/doctor/publish_additional_work','/institute/delete_flag_comments', '/institute/show_comments_box','/institute/set_flag_status','/institute/save_flag_comments','/doctor/save_flag_comments','/institute/save_new_track_temp_data','/institute/load_track_new_template','/institute/create_new_session_track_record_list','/institute/search_and_add_barcode_record','/institute/get_load_template_data_tags','/institute/cl_doc_delete_upload_area_document_db','/institute/cl_doc_save_upload_area_document','/institute/delete_upload_area_document_db','institute/update_upload_area_document_perms','/institute/save_upload_area_document','/institute/aleatha_image_uploader','/doctor/set_populate_micro_data','/admin/assign_dermatological_surgeon','/admin/generate_imf_reprot','/admin_tracking/SearchTracking/search_template_session_record_data','/admin_tracking/SearchTracking/search_and_add_barcode_record','/admin/display_all_ajax_processing/','/institute/find_prev_mdt_cases_new','/Institute/viewed_reports_ajax_load','/Institute/published_reports_ajax_load','/doctor/load_track_new_template','doctor/create_new_session_track_record_list','/doctor/search_and_add_barcode_record','/doctor/search_and_add_barcode_record','/doctor/set_color_code_session_data','doctor/display_published_reports_ajax_processing/','/doctor/doctor_record_detail/[0-9]+','doctor/update_client_report','/doctor/add_specimen_doctor/[0-9]+','/doctor/do_upload/[0-9]+');
$config['csrf_exclude_uris'] = array('/chat/accept_request','/chat/send_chat','/chat/load_chat_data','/chat/send_request','/chat/load_notification','/chat/load_chat_user','/chat/check_chat_notification','/chat/search_user','/pm/markasread','/institute/getTCodes','/institute/deletespeciment','/institute/AddSubmitSpecimenHospital','/institute/updateTemplateWithId','/institute/SubmitSpecimenHospital','Api/getPatientRecords', 'Api/specimenslide','/institute/getTemplates','/auth/update_job_plan', '/auth/delete_job_plan', 'Api/caserecordupload','Api/emailExist','Api/userprofile','/admin/aleatha_image_uploader','/admin/save_batch_assign','/Admin/edit_report','Api/userupdate','Api/login','Api/register','/admin/add_mdt_dates','/Admin/saveMdtCategory','/admin/change_account_status','/institute/deleteIncidentReport','/institute/updateIncidentReport','/institute/saveIncidentReport','/institute/download_document_file','/institute/load_accumulative_yearly_invoices','/institute/cl_doc_update_upload_area_document_perms','/institute/delete_upload_area_document','/institute/delete_institute_document_file','/institute/load_track_edit_template_data','/institute/add_mdt_record_note_on_report','/institute/delete_mdt_record_note','/institute/mark_read_records','/institute/find_lab_number_records','/institute/set_populate_request_form','/institute/delete_clinic_upload_files','/institute/find_prev_mdt_cases','/institute/find_mdt_cases_new','/institute/find_mdt_cases','/institute/delete_trash_institute','/institute/msg_trashsent_institute','/institute/msg_trashinbox_institute','/institute/find_matching_records','/doctor/sendMessageMicrocodeToAdmin','/doctor/sendMessageSnomedToAdmin','/doctor/delete_flag_comments','/doctor/show_comments_box','/doctor/load_track_edit_template_data','/doctor/get_load_template_data_tags','/doctor/load_track_new_template','/doctor/search_hospital_group_users','/doctor/set_doctor_record_history_track_status','/admin/search_barcode_record','/doctor/search_barcode_record','/doctor/add_mdt_record_note_on_report','/doctor/delete_mdt_record_note','/doctor/find_lab_number_records','/doctor/search_lab_number_mask','/doctor/publish_bulk_reports_authrization','/doctor/find_prev_mdt_dates_on_mdt_lists_new','/doctor/find_prev_mdt_dates_on_mdt_lists','/doctor/find_prev_mdt_dates_new','/doctor/find_prev_mdt_dates','/doctor/find_mdt_dates_on_mdt_lists_new','/doctor/find_mdt_dates_on_mdt_lists','/doctor/find_mdt_dates_new','/doctor/find_mdt_dates','/doctor/find_prev_mdt_cases','/doctor/find_mdt_cases_new','/doctor/delete_trash_doctor','/doctor/msg_trashsent_doctor','/doctor/display_edu_cases','/doctor/manage_supplemenary','/doctor/publish_additional_work','/institute/delete_flag_comments', '/institute/show_comments_box','/institute/set_flag_status','/institute/save_flag_comments','/doctor/save_flag_comments','/institute/save_new_track_temp_data','/institute/load_track_new_template','/institute/create_new_session_track_record_list','/institute/search_and_add_barcode_record','/institute/get_load_template_data_tags','/institute/cl_doc_delete_upload_area_document_db','/institute/cl_doc_save_upload_area_document','/institute/delete_upload_area_document_db','institute/update_upload_area_document_perms','/institute/save_upload_area_document','/institute/aleatha_image_uploader','/doctor/set_populate_micro_data','/admin/assign_dermatological_surgeon','/admin/generate_imf_reprot','/admin_tracking/SearchTracking/search_template_session_record_data','/admin_tracking/SearchTracking/search_and_add_barcode_record','/admin/display_all_ajax_processing/','/institute/find_prev_mdt_cases_new','/Institute/viewed_reports_ajax_load','/Institute/published_reports_ajax_load','/doctor/load_track_new_template','doctor/create_new_session_track_record_list','/doctor/search_and_add_barcode_record','/doctor/search_and_add_barcode_record','/doctor/set_color_code_session_data','doctor/display_published_reports_ajax_processing/','/doctor/doctor_record_detail/[0-9]+','doctor/update_client_report','/doctor/add_specimen_doctor/[0-9]+','/doctor/do_upload/[0-9]+', '/allocator/allocate_specialty');

/*
|--------------------------------------------------------------------------
| Output Compression
|--------------------------------------------------------------------------
|
| Enables Gzip output compression for faster page loads.  When enabled,
| the output class will test whether your server supports Gzip.
| Even if it does, however, not all browsers support compression
| so enable only if you are reasonably sure your visitors can handle it.
|
| Only used if zlib.output_compression is turned off in your php.ini.
| Please do not use it together with httpd-level output compression.
|
| VERY IMPORTANT:  If you are getting a blank page when compression is enabled it
| means you are prematurely outputting something to your browser. It could
| even be a line of whitespace at the end of one of your scripts.  For
| compression to work, nothing can be sent before the output buffer is called
| by the output class.  Do not 'echo' any values with compression enabled.
|
*/
$config['compress_output'] = FALSE;
/*
|--------------------------------------------------------------------------
| Master Time Reference
|--------------------------------------------------------------------------
|
| Options are 'local' or any PHP supported timezone. This preference tells
| the system whether to use your server's local time as the master 'now'
| reference, or convert it to the configured one timezone. See the 'date
| helper' page of the user guide for information regarding date handling.
|
*/
$config['time_reference'] = 'local';
/*
|--------------------------------------------------------------------------
| Rewrite PHP Short Tags
|--------------------------------------------------------------------------
|
| If your PHP installation does not have short tag support enabled CI
| can rewrite the tags on-the-fly, enabling you to utilize that syntax
| in your view files.  Options are TRUE or FALSE (boolean)
|
*/
$config['rewrite_short_tags'] = FALSE;
/*
|--------------------------------------------------------------------------
| Reverse Proxy IPs
|--------------------------------------------------------------------------
|
| If your server is behind a reverse proxy, you must whitelist the proxy
| IP addresses from which CodeIgniter should trust headers such as
| HTTP_X_FORWARDED_FOR and HTTP_CLIENT_IP in order to properly identify
| the visitor's IP address.
|
| You can use both an array or a comma-separated list of proxy addresses,
| as well as specifying whole subnets. Here are a few examples:
|
| Comma-separated:	'10.0.1.200,192.168.5.0/24'
| Array:		array('10.0.1.200', '192.168.5.0/24')
*/
$config['proxy_ips'] = '';
