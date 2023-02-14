<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
/**
 * Display Related Products
 *
 * @param array $related_query
 * @param string $hospital_name
 * @return void
 */
function display_related_posts($related_query, $hospital_name) {
    if (!empty($related_query) && is_array($related_query)) {
        ?>
        <h4>Related Reports</h4>
        <ul class="nav nav-tabs">
            <?php foreach ($related_query as $row) { ?>
                <li>
                    <?php
                    if ($row->specimen_update_status == 0 && $row->specimen_publish_status == 0) :
                        echo '<a href="' . site_url() . '/doctor/doctor_record_detail/' . $row->uralensis_request_id . '" data-toggle="tooltip" data-placement="top" title="Please Update this ' . $row->serial_number . ' Record First."><img width="32px" src="' . base_url('assets/img/detail.png') . '"></a>';
                    elseif ($row->specimen_update_status == 1 && $row->specimen_publish_status == 0) :
                        echo '<a href="' . site_url() . '/doctor/doctor_record_detail/' . $row->uralensis_request_id . '" data-toggle="tooltip" data-placement="top" title="' . $row->serial_number . ' Record is Updated."><img src="' . base_url('assets/img/update.png') . '"></a>';
                    elseif ($row->specimen_update_status == 1 && $row->specimen_publish_status == 1) :
                        echo '<a target="_blank" href="' . site_url() . '/doctor/generate_report/' . $row->uralensis_request_id . '" data-toggle="tooltip" data-placement="top" title="' . $row->serial_number . ' Record is Published."><img src="' . base_url('assets/img/pdf.png') . '"></a>';
                    endif;
                    ?>
                </li>
            <?php } ?>
        </ul>
        <?php
    }
}
