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
                <th>Name</th>
                <th>NHS No.</th>
                <th>LAB No.</th>
                <th>HOS No.</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Date Taken</th>
                <th>Request Time</th>
                <th>Detail</th>
                <th>Status</th>
                <th>View</th>
                <th>Download</th>
            </tr>
            <?php foreach ($query as $row) : ?>
                <tr>
                    <td><?php echo html_purify($row->f_name); ?></td>
                    <td><?php echo html_purify($row->nhs_number); ?></td>
                    <td><?php echo html_purify($row->lab_number); ?></td>
                    <td><?php echo html_purify($row->hos_number); ?></td>
                    <td><?php echo html_purify($row->gender); ?></td>
                    <td><?php echo $row->dob; ?></td>
                    <td><?php echo $row->date_taken; ?></td>
                    <td><?php echo $row->request_datetime; ?></td>
                    <td><a href="<?php echo site_url() . '/Institute/view_singlerecord/' . intval($row->uralensis_request_id); ?>"><img class="img-size" src="/uralensis/assets/img/littleshowall.png"></a></td>
                    <td>
                        <?php
                        if ($row->status == 0) :
                            echo '<span>In Progress <img src="/uralensis/assets/img/fail.gif"></span>';
                        else :
                            echo '<span style="color:green;">Completed <img src="/uralensis/assets/img/success.gif"></span>';
                        endif;
                        ?>
                    </td>
                    <?php
                    if($row->specimen_update_status == 1) :

                        echo '<td><a href="'.site_url('Institute/view_single_final/' . intval($row->uralensis_request_id)).'">View Report</a></td>';

                    else :
                        echo '<td><span>Not Submitted by Dr.</span></td>';
                    endif;
                    ?>
                    <?php
                    if($row->specimen_update_status == 1) :

                        echo '<td><a href="'.site_url('Institute/download_pdf/' . intval($row->uralensis_request_id)).'">Download Report</a></td>';

                    else :
                        echo '<td><span>Not Submitted by Dr.</span></td>';
                    endif;
                    ?>
                </tr>
            <?php
            endforeach;
            ?>
        </table>
    </div>
</div>
