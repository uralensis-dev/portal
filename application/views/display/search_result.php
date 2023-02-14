<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
/**
 * @var $query
 */
?>
<div class="row">
    <div class="col-md-12">
	<?php
        if ($this->session->flashdata('record_not_found')){
            echo $this->session->flashdata('record_not_found');
        }else{
            echo $this->session->flashdata('record_found');
        }
        ?>
        <h4>Search Result</h4>
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
                    <td><a href="<?php echo site_url() . '/Admin/detail_view_record/' . $row->uralensis_request_id; ?>"><img src="<?php echo base_url('assets/img/detail.png'); ?>"></a></td>
                    <td>
                        <?php if($row->assign_status == 1):?>
                            <?php echo '<span style="color:green;">Assigned<span>'?>
                        <?php
                        else:
                            echo '<span>Not Assigned</span>';
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
