<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">  
                <tr class="info">
                    <th>Name</th>
                    <th>Final Submission Date</th>
                    <th>Detail</th>
                </tr>
                <?php foreach ($query as $q_val) :
                    ?>
                    <tr>
                        <td><?php echo $q_val->sur_name. '' . $q_val->first_name ; ?>  </td>
                        <?php 
                            if($q_val->specimen_update_status == 1) :
                        
                        echo '<td><a href="'.site_url('Institute/view_single_final/' . intval($q_val->request_id)).'">View</a></td>';
                        else : 
                             echo '<td><span>Not Submitted by Dr.</span></td>';
                            endif;
                        ?>
                        <td><a href="<?php site_url('Institute/view_single_final/' . intval($q_val->request_id)); ?>">Download</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div> 

