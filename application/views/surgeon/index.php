<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$perm = $this->ion_auth->user()->row()->user_derm_clinician_perm;
if (!empty($perm) && $perm === 'on') {
?>
<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <form class="form" action="<?php echo base_url('index.php/surgeon/search_result'); ?>" method="post">
            <div class="form-group">
                <label for="search_result">Search Record</label>
                <input required id="search_result" type="text" name="search_result" class="form-control" placeholder="Enter Barcode Number">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Search Report</button>
            </div>
        </form>
        <hr>
    </div>
</div>
<?php } ?>
<div class="row">
    <div class="col-md-12">
        <?php if (!empty($result) && is_array($result)) { ?>
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
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $reports) {
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
                            <td><a href="<?php echo base_url('index.php/surgeon/record_detail/'.intval($reports['uralensis_request_id'])); ?>"><img src="<?php echo base_url('assets/img/detail.png'); ?>" /></a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php } else {
            echo '<div class="alert alert-danger">There is no record assign yet to this logged in dermatological surgeon.</div>';
        } ?>
    </div>
</div>
