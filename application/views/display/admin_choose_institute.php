<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-6">
        <form class="form" action="<?php echo base_url('/index.php/admin/'); ?>">
            <div class="form-group">
            <label class="control-label" for="admin_chhose_hospital"><i>Choose Hospital which you want to assign the record.</i></label>
            <select class="form-control" name="hospital_user">
                <option value="0">Select Hospital</option>
                <?php
                    $get_hospital_users = $this->Admin_model->get_hospital_users();
                    if(!empty($get_hospital_users) && is_array($get_hospital_users)){
                        foreach($get_hospital_users as $hospital_users){
                            echo '<option value="'.$hospital_users->id.'">'.$hospital_users->first_name. ' ' . $hospital_users->last_name.'</option>';
                        }
                    }
                ?>
            </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Assign Hospital</button>
            </div>
        </form>
    </div>
    <hr>
</div>