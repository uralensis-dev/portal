<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <form class="form" action="<?php echo base_url('index.php/secretary/reports'); ?>" method="get">
            <div class="form-group">
                <label for="doctors_id">Doctors</label>
                <select name="doctors_id" class="form-control">
                    <option value="false">Choose Doctor</option>
                    <?php
                    if (!empty($doctors_list) && is_array($doctors_list)) {
                        foreach ($doctors_list as $doctor) {
                            $select = '';
                            $doc_first = $this->ion_auth->user($doctor->ura_doctor_id)->row()->first_name;
                            $doc_last = $this->ion_auth->user($doctor->ura_doctor_id)->row()->last_name;
                            if (isset($_GET['doctors_id']) && $_GET['doctors_id'] === $doctor->ura_doctor_id) {
                                $select = 'selected';
                            }
                            ?>
                            <option <?php echo html_purify($select); ?> value="<?php echo intval($doctor->ura_doctor_id); ?>"><?php echo html_purify($doc_first) . ' ' . html_purify($doc_last); ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Search Report</button>
            </div>
        </form>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php if (!empty($doctors_reports) && is_array($doctors_reports)) { ?>
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
                    $doctor_id = $_GET['doctors_id'];
                    foreach ($doctors_reports as $reports) {
                        ?>
                        <tr>
                            <td><?php echo html_purify($reports->serial_number); ?></td>
                            <td><?php echo html_purify($reports->f_name); ?></td>
                            <td><?php echo html_purify($reports->sur_name); ?></td>
                            <td><?php echo html_purify($reports->dob); ?></td>
                            <td><?php echo html_purify($reports->pci_number); ?></td>
                            <td><?php echo html_purify($reports->emis_number); ?></td>
                            <td><?php echo html_purify($reports->nhs_number); ?></td>
                            <td><?php echo html_purify($reports->lab_number); ?></td>
                            <td><a data-toggle="tooltip" data-placement="top" title="<?php echo $this->ion_auth->group(intval($reports->hospital_group_id))->row()->description; ?>" href="javascript:void(0);" ><img  src="<?php echo base_url('assets/img/hospital.png'); ?>"></a></td>
                            <td><?php echo $reports->report_urgency; ?></td>
                            <td>
                                <a data-toggle="modal" data-target="#assign_record_<?php echo intval($reports->uralensis_request_id); ?>">Assign</a>
                                <div id="assign_record_<?php echo intval($reports->uralensis_request_id); ?>" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Assign Record</h4>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
                                                $sec_perm = array();
                                                if (!empty($secretary_perms)) {
                                                    $sec_perm = unserialize($secretary_perms);
                                                }
                                                
                                                if (!in_array('sec_can_assign_cases', $sec_perm)) {
                                                    echo '<div class="alert alert-danger">You do not have any permission to assign cases.</div>';
                                                } else {
                                                    ?>
                                                    <div class="sec_rec_assign"></div>
                                                    <form id="assign_rec_sec_form" class="form">
                                                        <div class="form-group">
                                                            <label for="secretary_id">Secretary</label>
                                                            <select name="secretary_id" class="form-control">
                                                                <option value="false">Choose Secretary</option>
                                                                <?php
                                                                if (!empty($secretary_list)) {
                                                                    foreach ($secretary_list as $secretary) {
                                                                        $sec_first = '';
                                                                        $sec_last = '';
                                                                        if (!empty($this->ion_auth->user($secretary->ura_sec_id)->row()->first_name)) {
                                                                            $sec_first = $this->ion_auth->user($secretary->ura_sec_id)->row()->first_name;
                                                                        }
                                                                        if (!empty($this->ion_auth->user($secretary->ura_sec_id)->row()->last_name)) {
                                                                            $sec_last = $this->ion_auth->user($secretary->ura_sec_id)->row()->last_name;
                                                                        }
                                                                        if (!empty($sec_first) || !empty($sec_last)) {
                                                                            echo '<option value="' . intval($secretary->ura_sec_id) . '">' . html_purify($sec_first) . ' ' . html_purify($sec_last) . '</option>';
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" name="record_id" value="<?php echo intval($reports->uralensis_request_id); ?>">
                                                            <input type="hidden" name="doctor_id" value="<?php echo intval($doctor_id); ?>">
                                                            <button type="button" class="btn btn-primary assign_record" id="assign_record">Assign</button>
                                                        </div>
                                                    </form>
                                                <?php } ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>
