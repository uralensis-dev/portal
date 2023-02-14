<div class="row">
    <div class="col-md-12">
    <?php if(!empty($record_query)) { ?>
        <table class="table table-bordered">
            <tbody>
                <tr class="bg-primary">
                    <th style="width:20%;">NHS No.</th>
                    <th style="width:20%;">LAB No.</th>
                    <th style="width:20%;">Emis No.</th>
                    <th style="width:40%;">Serial No.</th>
                </tr>
                <tr>
                    <td><?php echo html_purify($record_query['nhs_number']); ?></td>
                    <td><?php echo html_purify($record_query['lab_number']); ?></td>
                    <td><?php echo html_purify($record_query['emis_number']); ?></td>
                    <td><?php echo html_purify($record_query['serial_number']); ?></td>
                </tr>
                <tr>
                    <td class="active"><strong>Patient Initial</strong></td>
                    <td><?php echo html_purify($record_query['patient_initial']); ?></td>
                    <td class="active"><strong>PCI No.</strong></td>
                    <td><?php echo html_purify($record_query['pci_number']); ?></td>
                </tr>
                <tr>
                    <td class="active"><strong>Gender</strong></td>
                    <td><?php echo html_purify($record_query['gender']); ?></td>
                    <td class="active"><strong>Date of Birth</strong></td>
                    <td><?php echo html_purify($record_query['dob']); ?></td>
                </tr>
                <tr>
                    <td class="active"><strong>Lab Name</strong></td>
                    <td><?php echo html_purify($record_query['lab_name']); ?></td>
                </tr>
                <tr>
                    <td class="active"><strong>First Name</strong></td>
                    <td><?php echo html_purify($record_query['f_name']); ?></td>
                    <td class="active"><strong>Surname</strong></td>
                    <td><?php echo html_purify($record_query['sur_name']); ?></td>
                </tr>
                <tr>
                    <td class="active"><strong>Lab Receiving Date</strong></td>
                    <td><?php echo html_purify($record_query['date_received_bylab']); ?></td>
                </tr>
                <tr>
                    <td class="active"><strong>Received back from Lab</strong></td>
                    <td><?php echo html_purify($record_query['date_sent_touralensis']); ?></td>
                    <td class="active"><strong>Clinician Requesting Work</strong></td>
                    <td><?php echo html_purify($record_query['clrk']); ?></td>
                </tr>
                <tr>
                    <td class="active"><strong>Date Taken</strong></td>
                    <td><?php echo html_purify($record_query['date_taken']); ?></td>
                    <td class="active"><strong>Report Urgency</strong></td>
                    <td><?php echo html_purify($record_query['report_urgency']); ?></td>

                </tr>
                <tr>
                    <td class="active"><strong>Date Received By Doctor</strong></td>
                    <td><?php echo html_purify($record_query['date_rec_by_doctor']); ?></td>
                    <td class="active"><strong>Case Category</strong></td>
                    <td><?php echo html_purify($record_query['cases_category']); ?></td>
                </tr>
            </tbody>
        </table>
    <?php } ?>
    <?php if(!empty($specimen_query)) { ?>
        <ul class="tg-themenavtabs nav navbar-nav">
            <?php
                $active = 'active';
                $count = 1;
                foreach ($specimen_query as $row) {
                    ?>
            <li class="nav-item <?php echo $active; ?>" data-specimenid="<?php echo intval($row['specimen_id']); ?>" data-requestid="<?php echo intval($row['request_id']); ?>">
                <a data-toggle="tab" href="#tabs_<?php echo $count; ?>">Specimen <?php echo $count; ?></a>
            </li>
            <?php
                    $active = '';
                    $count++;
                }
                ?>
        </ul>

        <div class="tg-tabcontentvtwo tab-content">
        <?php
            $tabs_active = 'active';
            $inner_tab_count = 1;
            $specimen_total_count = count($specimen_query);
            foreach ($specimen_query as $key => $row) { 
        ?>
        <div class="tg-navtabsdetails tab-pane fade in <?php echo $tabs_active; ?>" id="tabs_<?php echo $inner_tab_count; ?>">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td width="25%"><strong>Clinical History</strong></td>
                        <td width="25%"><?php echo $row['specimen_clinical_history']; ?></td>
                        <td width="25%"><strong>Specimen Macroscopic</strong></td>
                        <td width="25%"><?php echo $row['specimen_macroscopic_description']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Specimen Type</strong></td>
                        <td><?php echo html_purify($row['specimen_type']); ?></td>
                        <td><strong>Specimen Blocks</strong></td>
                        <td><?php echo html_purify($row['specimen_block']); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php
            $tabs_active = '';
            $inner_tab_count++;
        }
        ?>
        </div>
    <?php } ?>
    </div>
</div>