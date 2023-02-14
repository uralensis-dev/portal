<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-----------------------------Report Listing Start------------------------------>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2">
                <a onclick="window.history.back();"><button class="btn btn-primary"><< Go Back</button></a>
                <br /><br />
            </div>
        </div>
        <table id="doctor_record_list_table" class="table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr class="info">
                    <th>UL No.</th>
                    <th>First name</th>
                    <th>Surname</th>
                    <th>DOB.</th>
                    <th>EMIS No</th>
                    <th>NHS No.</th>
                    <th>Lab. No.</th>
                    <th>Client</th>
                    <th>Type</th>
                    <th>Request Date:</th>
                    <th>Received by Lab.</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
                    <th>Docs</th>
                </tr>
            </thead>
            <tfoot>
                <tr class="info">
                    <th>UL No.</th>
                    <th>First name</th>
                    <th>Surname:</th>
                    <th>DOB.</th>
                    <th>EMIS No.</th>
                    <th>NHS No.</th>
                    <th>Lab. No.</th>
                    <th>Client</th>
                    <th>Type</th>
                    <th>Request Date:</th>
                    <th>Received by Lab.</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
                    <th>Docs</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                if(!empty($filter_data)){
                foreach ($filter_data as $row) :
                    ?>
                    <?php
                    if ($row->report_status == 1) :
                        echo '<tr style="background:rgba(148, 196, 43, 0.59) !important;" class="bg-success">';
                    else :
                        echo '<tr>';
                    endif;
                    ?>

                <td><?php echo $row->serial_number; ?></td>
                <td><?php echo $row->f_name; ?></td>
                <td><?php echo $row->sur_name; ?></td>
                <td><?php echo $row->dob; ?></td>
                <td><?php echo $row->emis_number; ?></td>
                <td><?php echo $row->nhs_number; ?></td>
                <td><?php echo $row->lab_number; ?></td>
                <td><?php echo $this->ion_auth->group($row->hospital_group_id)->row()->description; ?></td>
                <td><?php echo $row->report_urgency; ?></td>
                <td><?php echo date('M j Y', strtotime($row->request_datetime)); ?></td>
                <td><?php echo $row->date_received_bylab; ?></td>
                <td style="text-align:center;">
                    <?php
                    if ($row->specimen_update_status == 0 && $row->specimen_publish_status == 0) :
                        echo '<a href="' . site_url() . '/doctor/doctor_record_detail/' . $row->uralensis_request_id . '" data-toggle="tooltip" data-placement="top" title="Please Update this ' . $row->serial_number . ' Record First."><img src="' . base_url('assets/img/detail.png') . '"></a>';
                    elseif ($row->specimen_update_status == 1 && $row->specimen_publish_status == 0) :
                        echo '<a href="' . site_url() . '/doctor/doctor_record_detail/' . $row->uralensis_request_id . '" data-toggle="tooltip" data-placement="top" title="' . $row->serial_number . ' Record is Updated."><img src="' . base_url('assets/img/update.png') . '"></a>';
                    elseif ($row->specimen_update_status == 1 && $row->specimen_publish_status == 1) :
                        echo '<a href="' . site_url() . '/doctor/doctor_record_detail/' . $row->uralensis_request_id . '" data-toggle="tooltip" data-placement="top" title="' . $row->serial_number . ' Record is Published."><img src="' . base_url('assets/img/correct.png') . '"></a>';
                    endif;
                    ?>
                </td>
                <td>
                    <?php
                    if ($row->further_work_status == 1) {
                        echo '<a data-toggle="tooltip" data-placement="top" title="Further Work Requested For This ' . $row->serial_number . ' Record" href="javascript:void(0);"><img src="' . base_url('assets/img/further_work.png') . '"></a>';
                    }
                    ?> 
                </td>
                <td><a data-toggle="tooltip" data-placement="top" title="View Your Record Related Documents." href="<?php echo site_url() . '/doctor/doctor_download_section/' . $row->uralensis_request_id; ?>"><img src="<?php echo base_url('assets/img/adobe.png'); ?>" />&nbsp;</a></td>
                </tr>
                <?php
            endforeach;
                }else{
                    echo '<div class="alert bg-danger">Sorry No Record Found.</div>';
                }
            ?>
            </tbody>
        </table>
    </div>
</div>

