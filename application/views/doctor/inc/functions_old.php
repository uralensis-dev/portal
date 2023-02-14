<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php

/**
 * MDT Dates
 */
function display_mdt($mdt_cats, $recordid, $request_query, $mdt_assign_dates) {
    ob_start();
    ?>
    <div class="mdt_dates_msg"></div>
    <form class="form" id="mdt_from_data">
        <div class="tg-groupschecks">
            <div class="tg-formradiohold">
                <?php
                $checked_for_mdt = '';
                if ($request_query[0]->mdt_case_status === 'for_mdt') {
                    $checked_for_mdt = 'checked';
                }
                ?>
                <div class="tg-radio">
                    <input <?php echo $checked_for_mdt; ?> type="radio" name="mdt_dates_radio" id="for_mdt" class="mdt_radio" value="for_mdt">
                    <label for="for_mdt">For MDT</label>
                </div>
                <?php
                $checked_not_for_mdt = '';
                if ($request_query[0]->mdt_case_status === 'not_for_mdt') {
                    $checked_not_for_mdt = 'checked';
                }
                ?>
                <div class="tg-radio">
                    <input <?php echo $checked_not_for_mdt; ?> type="radio" name="mdt_dates_radio" id="not_for_mdt" class="mdt_radio" value="not_for_mdt">
                    <label for="not_for_mdt">Not For MDT</label>
                </div>
            </div>
        </div>
        <div class="form-group tg-select mdt_dates_multi">
            <?php if (!empty($mdt_cats)) { ?>
                <label for="future_mdt_dates">Select MDT Date</label>
                <select multiple name="mdt_dates[]" id="future_mdt_dates">
                    <?php
                    foreach ($mdt_cats as $key => $dates) {
                        $selected = '';
                        $change_mdt_timestamp = date('Y-m-d', $dates->ura_mdt_timestamp);

                        if (!empty($mdt_assign_dates) && !empty($mdt_assign_dates[$key]) && in_array($change_mdt_timestamp, $mdt_assign_dates[$key])) {
                            $selected = 'selected';
                        }

                        $date_highlight = '';
                        if ($key === 0) {
                            $date_highlight = 'style="background:#ccc;"';
                        }
                        ?>
                        <option <?php echo $selected .' '. $date_highlight; ?> value="<?php echo $change_mdt_timestamp; ?>"><?php echo $dates->ura_mdt_date; ?></option>
                    <?php } ?>
                </select>
            <?php } ?>
        </div>
        <?php
        $specimen_array = array('Specimen 1', 'Specimen 2', 'Specimen 3', 'Specimen 4', 'Specimen 5');

        $specimen_status = $request_query[0]->mdt_specimen_status;
        if (!empty($specimen_status)) {
            $specimen_status = unserialize($specimen_status);
        }
        ?>
        <div class="form-group mdt_specimen_hide">
            <?php
            foreach ($specimen_array as $key => $value) {
                $checked = '';

                if (!empty($specimen_status) && in_array($value, $specimen_status)) {
                    $checked = 'checked';
                }
                ?>
                <label for="mdt_specimen"><?php echo $value; ?></label>
                <input <?php echo $checked; ?> type="checkbox" name="mdt_specimen[]" id="mdt_specimen" class="" value="<?php echo $value; ?>">
            <?php } ?>
        </div>
        <div class="form-group hide_report_option">
            <?php
            $add_to_report = '';
            if ($request_query[0]->mdt_case_status === 'not_for_mdt' && $request_query[0]->mdt_case === 'add_to_report') {
                $add_to_report = 'checked';
            }
            ?>
            <label for="add_to_report">Add To Report</label>
            <input <?php echo $add_to_report; ?> type="radio" name="report_option" id="add_to_report" class="report_option" value="add_to_report">
        </div>
        <div class="form-group hide_report_option">
            <?php
            $not_add_to_report = '';
            if ($request_query[0]->mdt_case_status === 'not_for_mdt' && $request_query[0]->mdt_case === 'not_to_add_to_report') {
                $not_add_to_report = 'checked';
            }
            ?>
            <label for="not_to_add_to_report">Not To Add To Report</label>
            <input <?php echo $not_add_to_report; ?> type="radio" name="report_option" id="not_to_add_to_report" class="report_option" value="not_to_add_to_report">
        </div>
        <input type="hidden" name="record_id" value="<?php echo $recordid; ?>">
        <input type="hidden" class="snomed_check_mdt" name="snomed_check_mdt" value="<?php echo $request_query[0]->mdt_case_status; ?>">
        <button type="button" class="btn btn-primary" id="assign_mdt">Assign</button>
    </form>
    <div class="clearfix"></div>
    
    <a data-toggle="collapse" class="btn btn-warning pull-right" data-target="#show_mdt_notes" href="javascript:;">Show MDT Note</a>
    <div class="clearfix"></div>
    <div id="show_mdt_notes" class="collapse">
        <hr>
        <?php
        if (!empty($request_query) && !empty($request_query[0]->mdt_case_msg)) {
            ?>
            <table class="table table-condensed table-striped">
                <tr>
                    <th>MDT Note</th>
                    <th>Timestamp</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                <tr>
                    <td><?php echo $request_query[0]->mdt_case_msg; ?></td>
                    <td>
                        <?php
                        $timestamp = date('d-m-Y', $request_query[0]->mdt_case_msg_timestamp);
                        echo $timestamp;
                        ?>
                    </td>
                    <td>
                        <a href="javascript:;" class="delete_mdt_note" data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>">
                            <img src="<?php echo base_url('assets/img/delete.png'); ?>">
                        </a>
                    </td>
                    <td>
                        <?php
                        $mdt_add_status = 'mdt_not_add';
                        $mdt_add_text = 'Add to Report';
                        if ($request_query[0]->mdt_case_add_to_report_status == 1) {
                            $mdt_add_status = 'mdt_add';
                            $mdt_add_text = 'Not Add to Report';
                        }
                        ?>
                        <a href="javascript:;" class="add_mdt_to_report" data-mdtstatus="<?php echo $mdt_add_status; ?>" data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>"><?php echo $mdt_add_text; ?></a>
                    </td>
                </tr>
            </table>
            <?php
        }else{
            echo '<div class="alert alert-danger">You have not added any note yet.</div>';
        }
        ?>
    </div>

    <?php
    if (!empty($mdt_list)) {
        $mdt_list_check = 'not_empty';
    } else {
        $mdt_list_check = 'empty';
    }
    ?>
    <div id="mdt_lists_model" date-mdtlistcheck="<?php echo $mdt_list_check; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">MDT Lists</h4>
                </div>
                <div class="modal-body">
                <?php
            $attributes = array('id'=>'mdt_message_form','class' => 'form');
            echo form_open("", $attributes);
            ?>
                    
                        <div class="form-group">
                            <?php if (!empty($mdt_list)) { ?>
                                <label for="choose_mdt_list">MDT List</label>
                                <select name="choose_mdt_list" class="choose_mdt_list form-control">
                                    <option value="">Choose Mdt List</option>
                                    <?php foreach ($mdt_list as $value) { ?>
                                        <option value="<?php echo $value->ura_mdt_list_id; ?>"><?php echo $value->ura_mdt_list_name; ?></option>
                                    <?php } ?>
                                </select>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="record_id" value="<?php echo $recordid; ?>">
                            <button class="btn btn-primary" id="add_mdt_msg_btn">Assign MDT List</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <?php
    echo ob_get_clean();
}

/**
 * Get User related data
 *
 * @param int $user_id
 * @return void
 */
function get_uralensis_username($user_id) {
    $ci = & get_instance();
    if (!empty($user_id)) {

       /* $f_name = $ci->ion_auth->user($user_id)->row()->first_name;
        $l_name = $ci->ion_auth->user($user_id)->row()->last_name;*/
        $getdetails = getRecords("AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name,AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name","users",array("id"=>$user_id));
        $username = $getdetails[0]->first_name . ' ' . $getdetails[0]->last_name;

        return $username;
    }
}

/**
 * Get User Data
 *
 * @param int $record_id
 * @param string $type
 * @return void
 */
function uralensis_get_user_data($record_id, $type = '') {
    $ci = & get_instance();
    $f_name = '';
    $l_name = '';
    $record_data = '';

    if (!empty($record_id) && $type === 'fullname') {
        $f_name = $ci->db->select('f_name')->from('request')->where('uralensis_request_id', $record_id)->get()->row_array()['f_name'];
        $l_name = $ci->db->select('sur_name')->from('request')->where('uralensis_request_id', $record_id)->get()->row_array()['sur_name'];
        $record_data = $f_name . ', ' . $l_name;
        if (empty($f_name) && empty($l_name)) {
            $record_data = 'No, Name';
        }
    } elseif ($type === 'initial') {
        $f_name = $ci->db->select('f_name')->from('request')->where('uralensis_request_id', $record_id)->get()->row_array()['f_name'];
        $l_name = $ci->db->select('sur_name')->from('request')->where('uralensis_request_id', $record_id)->get()->row_array()['sur_name'];
        $record_data = substr($f_name, 0, 1) . substr($l_name, 0, 1);
        if (empty($f_name) && empty($l_name)) {
            $record_data = 'NA';
        }
    } elseif ($type === 'gender') {
        $gender = $ci->db->select('gender')->from('request')->where('uralensis_request_id', $record_id)->get()->row_array()['gender'];
        if (!empty($gender) && strtolower($gender) === 'female') {
//            $record_data = base_url('assets/img/female.jpg');
            $record_data = "F";
        }
    } elseif ($type === 'age') {
        $dateOfBirth = $ci->db->select('dob')->from('request')->where('uralensis_request_id', $record_id)->get()->row_array()['dob'];

        if (!empty($dateOfBirth)) {
            $today = date("Y-m-d");
            $diff = date_diff(date_create($dateOfBirth), date_create($today));
            $record_data = $diff->format('%y');
        }
    }

    return $record_data;
}

/**
 * Get Next and Previous records
 *
 * @param array $unpublish_list
 * @param string $record_id
 * @param boolean $wrap
 * @param string $get_type
 * @return void
 */
function get_next_previous_records($unpublish_list = array(), $record_id = '', $wrap = false, $get_type = '', $req_type='') {
    if (!empty($unpublish_list) && !empty($record_id)) {
//        echo '<pre>'.$record_id; print_r($unpublish_list); exit;
        if (array_key_exists($record_id, $unpublish_list)) {
            $keys = array_keys($unpublish_list);
            $keyIndexes = array_flip($keys);
            $return = array();
            ob_start();
            if (!empty($get_type) && $get_type === 'prev') {
                if (isset($keys[$keyIndexes[$record_id] - 1])) {
                    $return['prev'] = $keys[$keyIndexes[$record_id] - 1];
                } else {
                    $return['prev'] = null;
                }

                if (false != $wrap && empty($return['prev'])) {
                    $end = end($unpublish_list);
                    $return['prev'] = key($unpublish_list);
                }
                ?>
                <div class="tg-previousrecord">
                    <a href="<?php echo base_url('index.php/doctor/doctor_record_detail_old/' . $return['prev'].$req_type); ?>">
                        <i class="fa fa-angle-left"></i>
                        <span>Previous Record<em><?php echo $unpublish_list[$return['prev']]; ?></em></span>
                    </a>
                </div>
                <?php
            } else {
                if (isset($keys[$keyIndexes[$record_id] + 1])) {
                    $return['next'] = $keys[$keyIndexes[$record_id] + 1];
                } else {
                    $return['next'] = null;
                }
                if (false != $wrap && empty($return['next'])) {
                    $beginning = reset($unpublish_list);
                    $return['next'] = key($unpublish_list);
                }
                ?>
                <div class="tg-nextecord">
                    <a href="<?php echo base_url('index.php/doctor/doctor_record_detail_old/' . $return['next'].$req_type); ?>">
                        <i class="fa fa-angle-right"></i>
                        <span>Next Record<em><?php echo $unpublish_list[$return['next']]; ?></em></span>
                    </a>
                </div>
                <?php
            }
            echo ob_get_clean();
        }
    }
}
