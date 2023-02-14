<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
/**
 * @var $query
 */
?>
<div class="container-fluid">
    <div class="col-md-12">
        <?php
        if ($this->session->flashdata('record_not_found')) {
            echo $this->session->flashdata('record_not_found');
        } else {
            echo $this->session->flashdata('record_found');
        }
        ?>
        <a href="<?php echo base_url('/index.php/institute/doctor_record_list'); ?>"><button class="btn btn-primary"><i class="fa fa-backward" style="margin-right:10px;"></i> Go Back</button></a>
        <br /><br />
        <table class="table table-bordered">
            <tr class="info">
                <th>First Name</th>
                <th>Sur Name</th>
                <th>NHS No.</th>
                <th>LAB No.</th>
                <th>HOS No.</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Date Taken</th>
                <th>Request Time</th>
                <th>Detail</th>
                <th>Status</th>
            </tr>
            <?php
            foreach ($query as $row) :
                ?>
                <tr>
                    <td><?php echo $row->f_name; ?></td>
                    <td><?php echo $row->sur_name; ?></td>
                    <td><?php echo $row->nhs_number; ?></td>
                    <td><?php echo $row->lab_number; ?></td>
                    <td><?php echo $row->hos_number; ?></td>
                    <td><?php echo $row->gender; ?></td>
                    <td><?php echo $row->dob; ?></td>
                    <td><?php echo $row->date_taken; ?></td>
                    <td><?php echo $row->request_datetime; ?></td>
                    <td><a href="<?php echo site_url() . '/doctor/doctor_record_detail/' . $row->uralensis_request_id; ?>"><img src="<?php echo base_url('assets/img/detail.png'); ?>"></a></td>
                    <td>
                        <?php
                        if ($row->specimen_update_status == 0) :
                            echo '<span>Not Updated</span> <img src="/uralensis/assets/img/fail.gif">';
                        else :
                            echo '<span style="color:green;">Updated</span> <img src="/uralensis/assets/img/success.gif">';
                        endif;
                        ?>
                    </td>
                </tr>
                <?php
            endforeach;
            ?>
        </table>
    </div>
</div>