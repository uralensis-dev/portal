<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <a class="btn btn-primary" href="<?php echo base_url('index.php/surgeon'); ?>">Go Back</a>
        <?php if (!empty($query_result) && is_array($query_result)) { ?>
            <table id="sec_doc_records" cellspacing="0" width="100%" class="table table-striped">
                <thead>
                    <tr class="bg-primary">
                        <th>UL No.</th>
                        <th>First name</th>
                        <th>Surname</th>
                        <th>DOB.</th>
                        <th>PCI No.</th>
                        <th>EMIS No.</th>
                        <th>NHS No.</th>
                        <th>Lab. No.</th>
                        <th>Client</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($query_result as $reports) {
                        ?>
                        <tr>
                            <td><?php echo html_purify($reports['serial_number']); ?></td>
                            <td><?php echo html_purify($reports['f_name']); ?></td>
                            <td><?php echo html_purify($reports['sur_name']); ?></td>
                            <td><?php echo !empty($reports['dob']) ? html_purify($reports['dob']) : ''; ?></td>
                            <td><?php echo html_purify($reports['pci_number']); ?></td>
                            <td><?php echo html_purify($reports['emis_number']); ?></td>
                            <td><?php echo html_purify($reports['nhs_number']); ?></td>
                            <td><?php echo html_purify($reports['lab_number']); ?></td>
                            <td><a data-toggle="tooltip" data-placement="top" title="<?php echo $this->ion_auth->group(intval($reports['hospital_group_id']))->row()->description; ?>" href="javascript:void(0);" ><img  src="<?php echo base_url('assets/img/hospital.png'); ?>"></a></td>
                            <td><?php echo $reports['report_urgency']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php } else {
            echo '<div class="alert alert-danger">No Record Found</div>';
        }?>
    </div>
</div>
