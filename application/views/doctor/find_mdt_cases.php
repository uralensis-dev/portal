<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <p class="text-center"><i style='color:red;'>By Clicking Correct Sign Icon in Pending Table the Pending MDT Moved to Post MDT.</i></p>
        <a href="<?php echo base_url('index.php/doctor/mdt_cases'); ?>"><button class="btn btn-primary"><< Go Back</button></a>
        <div class="clearfix"></div>
        <hr>
        <?php
        if ($this->session->flashdata('pending_to_post_success_msg') != '') {
            echo $this->session->flashdata('pending_to_post_success_msg');
        }
        if ($this->session->flashdata('pending_mdt_success_remove') != '') {
            echo $this->session->flashdata('pending_mdt_success_remove');
        }
        if ($this->session->flashdata('post_mdt_success_remove') != '') {
            echo $this->session->flashdata('post_mdt_success_remove');
        }
        ?>
        <div class="col-md-6">
            <?php if (!empty($pending_mdt)) { ?>
            <a href="<?php echo base_url('index.php/doctor/download_pending_mdt/'.$_GET['hospital_id']); ?>">
                <img src="<?php echo base_url('assets/img/csv.png'); ?>">
                Downlaod Pending MDT
            </a>
            <?php } ?>
            <div class="panel panel-info">
                <div class="panel-heading text-center"><strong>Pending MDT Cases</strong></div>
                <div class="panel-body">
                    <table id="mdt_table_pending" class="table table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr class="info">
                                <th>Serial No</th>
                                <th>First Name</th>
                                <th>Sur Name</th>
                                <th>EMIS No</th>
                                <th>Gender</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="info">
                                <th>Serial No</th>
                                <th>First Name</th>
                                <th>Sur Name</th>
                                <th>EMIS No</th>
                                <th>Gender</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (!empty($pending_mdt)) {
                                $hospital_id = $_GET['hospital_id'];
                                foreach ($pending_mdt as $pending_cases) {
                                    ?>
                                    <tr>
                                        <td><?php echo $pending_cases->serial_number; ?></td>
                                        <td><?php echo $pending_cases->f_name; ?></td>
                                        <td><?php echo $pending_cases->sur_name; ?></td>
                                        <td><?php echo $pending_cases->emis_number; ?></td>
                                        <td><?php echo $pending_cases->gender; ?></td>
                                        <td><a href="<?php echo base_url('index.php/doctor/publish_to_post_mdt/?record_id=' . $pending_cases->uralensis_request_id . '&hospital_id=' . $hospital_id); ?>"><img src="<?php echo base_url('assets/img/success.gif'); ?>" ></a></td>
                                        <th><a href="<?php echo base_url('index.php/doctor/remove_mdt_case_pending/?record_id=' . $pending_cases->uralensis_request_id . '&hospital_id=' . $hospital_id); ?>"><img src="<?php echo base_url('assets/img/error.png'); ?>" ></a></th>
                                    </tr>
                                    <?php
                                }//endforeach
                            } else {
                                echo '<div class="bg-danger" style="padding:6px;">No Pending MDT Cases Found!.</div><hr>';
                            }//endif
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <?php if (!empty($post_mdt)) { ?>
            <a href="<?php echo base_url('index.php/doctor/download_post_mdt/'.$_GET['hospital_id']); ?>">
                <img src="<?php echo base_url('assets/img/csv.png'); ?>">
                Downlaod Post MDT
            </a>
            <?php } ?>
            <div class="panel panel-success">
                <div class="panel-heading text-center"><strong>Post MDT Cases</strong></div>
                <div class="panel-body">
                    <table id="mdt_table_post" class="table table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr class="info">
                                <th>Serial No</th>
                                <th>First Name</th>
                                <th>Sur Name</th>
                                <th>EMIS No</th>
                                <th>Gender</th>
                                <th>Report</th>
                                <th>Detail</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="info">
                                <th>Serial No</th>
                                <th>First Name</th>
                                <th>Sur Name</th>
                                <th>EMIS No</th>
                                <th>Gender</th>
                                <th>Report</th>
                                <th>Detail</th>
                                <th>&nbsp;</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (!empty($post_mdt)) {
                                $hospital_id = $_GET['hospital_id'];
                                foreach ($post_mdt as $post_cases) {
                                    ?>
                                    <tr>
                                        <td><?php echo $post_cases->serial_number; ?></td>
                                        <td><?php echo $post_cases->f_name; ?></td>
                                        <td><?php echo $post_cases->sur_name; ?></td>
                                        <td><?php echo $post_cases->emis_number; ?></td>
                                        <td><?php echo $post_cases->gender; ?></td>
                                        <td>
                                            <?php
                                            if ($post_cases->specimen_publish_status == 1) {
                                                echo '<a target="_blank" href="' . base_url('index.php/doctor/generate_report/' . $post_cases->uralensis_request_id) . '"><img src="' . base_url('assets/img/Pdf_file_symbol_32.png') . '" title="Pdf View"></a>';
                                            } else {
                                                echo 'Not Published';
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align:center;"><a href="<?php echo site_url() . '/doctor/mdt_case_detail?record_id=' . $post_cases->uralensis_request_id . '&hospital_id=' . $hospital_id; ?>"><img src="<?php echo base_url('assets/img/detail.png'); ?>"></a></td>
                                        <td><a href="<?php echo base_url('index.php/doctor/remove_mdt_case_post/?record_id=' . $post_cases->uralensis_request_id . '&hospital_id=' . $hospital_id); ?>"><img src="<?php echo base_url('assets/img/error.png'); ?>" ></a></td>
                                    </tr>
                                    <?php
                                }//endforeach
                            } else {
                                echo '<div class="bg-danger" style="padding:6px;">No Post MDT Cases Found!.</div><hr>';
                            }//endif
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  
    </div>
</div>
