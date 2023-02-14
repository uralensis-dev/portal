<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$cost_code_id = $_GET['cost_code_id'];
$hospital_id = $_GET['hospital_id'];
$code_desc = $_GET['code_desc'];
$code_rate = $_GET['code_rate'];
$code_price = $_GET['code_price'];
$code_type = $_GET['code_type'];
$code_prefix = $_GET['code_prefix'];
$storage_price = $_GET['storage_price'];
?>
<a href="<?php echo base_url('index.php/admin/manage_cost_codes/'); ?>"><button class="btn btn-primary"><< Go Back</button></a>
<hr>
<div class="cost_code_msg"></div>
<form class="form" id="update_cost_codes">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="service_type">Choose Type</label>
                <select style="margin-top:8px;" class="form-control" name="service_type" id="service_type">
                    <option value="null">Choose Type</option>
                    <?php
                    $cost_code_array = array(
                        'block' => 'Blocks',
                        'imf' => 'IMF',
                        'immuno' => 'Immunos',
                        'fwlevels' => 'Further Work Special Stains'
                    );

                    foreach ($cost_code_array as $key => $value) {
                        $selected = '';
                        if ($key == $code_type) {

                            $selected = 'selected';
                        }
                        echo '<option '.$selected.' value="' . $key . '">' . $value . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="rate">Per Rate Name</label>
                <input class="form-control" type="text" name="rate" id="rate" placeholder="Enter Rate. eg: Per Specimen" value="<?php echo (!empty($code_rate)) ? $code_rate : ''; ?>">
            </div>
            <div class="form-group">
                <label for="rate">Storage Price</label>
                <input class="form-control" type="text" name="storage_price" id="storage_price" placeholder="Enter Storage Price. eg: 1.00" value="<?php echo (!empty($storage_price)) ? $storage_price : ''; ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="prefix">Prefix</label>
                <input class="form-control" type="text" name="prefix" id="prefix" placeholder="Enter Prefix eg: CB001" value="<?php echo (!empty($code_prefix)) ? $code_prefix : ''; ?>">
            </div>
            <div class="form-group">
                <label for="cost">Cost</label>
                <input class="form-control" type="text" name="cost" id="cost" placeholder="Enter Cost (&pound;)" value="<?php echo (!empty($code_price)) ? $code_price : ''; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="service_desc">Service / Sample</label>
                <textarea rows="7" class="form-control" name="service_desc" id="service_desc" placeholder="Enter Your Service Description. eg: 1Block, 2Block"><?php echo (!empty($code_desc)) ? $code_desc : ''; ?></textarea>
            </div>
            <input type="hidden" name="cost_code_id" value="<?php echo $cost_code_id; ?>">
            <input type="hidden" name="cost_code_hospital_id" value="<?php echo $hospital_id; ?>">
            <div class="form-group">
                <button class="btn btn-warning" id="update_cost_codes_btn">Update Cost Code</button>
            </div>
        </div>
    </div>
</form>