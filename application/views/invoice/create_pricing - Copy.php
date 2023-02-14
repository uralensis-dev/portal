<!-- Page Header -->


<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Invoice</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/billing/invoice">Invoice</a></li>
                <li class="breadcrumb-item active">Create Invoice</li>
            </ul>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-sm-12">
        <form>
            <div class="row">

                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Pathhub Index</label>
                        <input class="form-control" type="text" name="pathhub_index" id="pathhub_index" readonly="readonly" value="<?php echo $pathhub_index; ?>">
                    </div>
                </div>

                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Categories<span class="text-danger">*</span></label>
                        <select class="select">
                            <?php foreach ($lab_test_category as $labKey => $labValue) { ?>
                                <option name="lab_categories" id="lab_categories_<?php echo $labValue->id; ?>" value="<?php echo $labValue->id; ?>"><?php echo $labValue->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Departments<span class="text-danger">*</span></label>
                        <select class="select">
                            <?php foreach ($lab_departments as $depKey => $depValue) { ?>
                                <option name="lab_departments" id="lab_departments_<?php echo $depValue->department_id; ?>" value="<?php echo $depValue->department_id; ?>"><?php echo $depValue->department; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>


                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Billing Code<span class="text-danger">*</span></label>
                        <select class="select">
                            <?php foreach ($billing_codes as $billKey => $billValue) { ?>
                                <option name="billing_code" id="billing_code_<?php echo $billValue->id; ?>" value="<?php echo $billValue->id; ?>"><?php echo $billValue->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-sm-6 col-md-2">
                    <div class="form-group">
                        <label>Rate<span class="text-danger">*</span></label>
                       
                        <input class="form-control" type="number" name="billing_price" id="billing_price" />
                           

                       
                    </div>
                </div>
                <div class="col-sm-6 col-md-2">
                    <div class="form-group">
                         <label>Currency<span class="text-danger">*</span></label>
                       
                      
                            <select class="select" name="currency" id="currency" style="width:50%">

                                <option  value="USD">USD</option>
                                <option value="USD">GBP</option>

                            </select>

                       
                    </div>
                </div>

                <div class="col-sm-6 col-md-8">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea  name= "discription" class="form-control" rows="3"></textarea>
                    </div>
                </div>
              
            </div>
            
            <div class="submit-section">
                
                <button class="btn btn-primary submit-btn">Save</button>
            </div>
        </form>
    </div>
</div>