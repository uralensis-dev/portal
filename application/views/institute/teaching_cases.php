<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <?php
        if ($this->session->flashdata('teaching_success_remove') != '') {
            echo $this->session->flashdata('teaching_success_remove');
        }
        ?>
        <a onclick="window.history.back();"><button class="btn btn-primary"><< Go Back</button></a>
        <br /><br />
        <table id="teaching_case_table" class="table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr class="info">
                    <th>Serial No</th>
                    <th>First Name</th>
                    <th>Sur Name</th>
                    <th>EMIS No</th>
                    <th>NHS No.</th>
                    <th>LAB No.</th>
                    <th>Gender</th>
                    <th>Request Date</th>
                    <th>Report</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tfoot>
                <tr class="info">
                    <th>Serial No</th>
                    <th>First Name</th>
                    <th>Sur Name</th>
                    <th>EMIS No</th>
                    <th>NHS No.</th>
                    <th>LAB No.</th>
                    <th>Gender</th>
                    <th>Request Date</th>
                    <th>Report</th>
                    <th>Status</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                if (!empty($query)) {
                    foreach ($query as $row) :
                        ?>
                        <tr>
                            <td style="font-size:11px;font-weight: bold;"><?php echo html_purify($row->serial_number); ?></td>
                            <td><?php echo html_purify($row->f_name); ?></td>
                            <td><?php echo html_purify($row->sur_name); ?></td>
                            <td><?php echo html_purify($row->emis_number); ?></td>
                            <td><?php echo $row->nhs_number; ?></td>
                            <td><?php echo html_purify($row->lab_number); ?></td>
                            <td><?php echo html_purify($row->gender); ?></td>
                            <td><?php echo date('M j Y g:i A', strtotime($row->request_datetime)); ?></td>
                            <td>
                                <?php
                                    if($row->specimen_publish_status == 1){
                                        echo '<a target="_blank" href="'.base_url('index.php/institute/view_single_final/'.intval($row->uralensis_request_id)).'"><img src="'.base_url('assets/img/Pdf_file_symbol_32.png').'" title="Pdf View"></a>';
                                    }else{
                                        echo 'Not Published';
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($row->specimen_update_status == 0 && $row->specimen_publish_status == 0) :
                                    echo '<span>Not Updated</span> <img src="' . base_url('assets/img/error.png') . '">';
                                elseif ($row->specimen_update_status == 1 && $row->specimen_publish_status == 0) :
                                    echo '<span style="color:green;"><strong>Updated ..</strong> &nbsp;&nbsp; </span> <img src="' . base_url('assets/img/update.png') . '">';
                                elseif ($row->specimen_update_status == 1 && $row->specimen_publish_status == 1) :
                                    echo '<span style="color:green;">Published</span> <img src="' . base_url('assets/img/correct.png') . '">';
                                endif;
                                ?>
                            </td>
                        </tr>

                        <?php
                    endforeach;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

