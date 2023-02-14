<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Billing Codes</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active"><a href="<?php echo base_url('invoice/billingCodeList'); ?>">Code list</a></li>
                <li class="breadcrumb-item active">Add Billing Code</li>
            </ul>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart("invoice/addBillingCode", array('class' => 'tg-formtheme tg-editform create_user_form')); ?>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <?php if (isset($message)) { ?>
                    <div id="infoMessage"><?php echo $message; ?></div>
                <?php } ?>

            </div>

<!--            <div class="col-sm-4 col-md-4">
                <div class="form-group">
                    <label>Pathhub Index</label>
                    <input class="form-control" type="text" name="pathhub_index" id="pathhub_index" readonly="readonly" value="<?php echo $pathhub_index; ?>">
                </div>
            </div>-->
           

<!--            <div class="col-sm-4 col-md-4">
                <div class="form-group">
                    <label>Departments<span class="text-danger">*</span></label>
                    <select class="select" name="lab_departments">
                        <?php foreach ($lab_departments as $depKey => $depValue) {     ?>
                            <option name="lab_departments" id="lab_departments_<?php echo $depValue->department_id; ?>" value="<?php echo $depValue->department_id; ?>"><?php echo $depValue->department; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-4 col-md-4">
                <div class="form-group" >
                    <label>Specialty<span class="text-danger">*</span></label>
                    <select class="select" name="lab_specialty">
                        <?php foreach ($speciality_groups as $labKey => $labValue) { ?>
                            <option name="lab_categories" id="lab_categories_<?php echo $labValue["spec_grp_id"]; ?>" value="<?php echo $labValue["spec_grp_id"]; ?>"><?php echo $labValue["spec_grp_name"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-4 col-md-4">
                <div class="form-group" >
                    <label>Test Categories<span class="text-danger">*</span></label>
                    <select class="select" name="lab_test_categories">
                        <?php foreach ($test_categories as $testKey => $testValue) { ?>
                            <option name="test_categories" id="test_categories_<?php echo $testValue->id; ?>" value="<?php echo $testValue->id; ?>"><?php echo $testValue->name; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>-->




            <div class="col-sm-4 col-md-4">
                <div class="form-group">
                    <label>Code Type<span class="text-danger">*</span></label>
                    <div class="field_wrapper_codeType">
                        <select class="select" name="code_type[]">
                            <?php foreach ($billing_codes as $billKey => $billValue) { ?>
                                <option name="code_type" id="code_type<?php echo $billValue->id; ?>" value="<?php echo $billValue->name; ?>"><?php echo $billValue->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>



            <div class="col-sm-4 col-md-4">
                <div class="form-group">
                    <label>Billing Code<span class="text-danger">*</span> </label> 
                    <div class="field_wrapper">
                        <input class="form-control" placeholder="Enter Billing Code" type="number" name="billing_code[]" id="billing_code" />
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-md-4">
                <div class="form-group">
                    <label>Code Name<span class="text-danger">*</span> </label> <a href="javascript:void(0);" class="btn btn-primary btn-sm  auto_save add_c_death_field add_button" style="float:right;"><i class="fa fa-plus"></i> </a>
                    <div class="field_wrapper_codeName">
                        <input class="form-control" placeholder="Enter Billing Code Name" type="text" name="billing_code_name[]" id="billing_code" />
                    </div>



                </div>
            </div>




            <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    <label>Rate<span class="text-danger">*</span></label>                       
                    <input class="form-control" type="number" name="billing_price" id="billing_price" />
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    <label>Country<span class="text-danger">*</span></label>
                    <select class="select" name="country" id="country" style="width:50%">
                        <option  value="UK">UK</option>
                        <option value="USA">USA</option>
                    </select>
                </div>
            </div>

            

            <div class="col-sm-6 col-md-12">
                <div class="form-group">
                    <label>Description</label>
                    <textarea  name= "description" class="form-control" rows="3"></textarea>
                </div>
            </div>

        </div>

        <div class="submit-section">

            <button class="btn btn-primary submit-btn">Save</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var cnt = 0; 
        
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector

        var wrapper = $('.field_wrapper'); //Input field wrapper
        var field_wrapper_codeType = $('.field_wrapper_codeType'); //Input field wrapper
        var field_wrapper_codeName = $('.field_wrapper_codeName'); //Input field wrapper

        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function () {
            //Check maximum number of input fields
            cnt++; 
            
              var fieldHTMLCodeType = '<div class="form-group ">\n\
                                    <div style ="width:100%; margin-top:5px;" class="remove_dv_codeType'+cnt+'">\n\
                                        <select class="select" name="code_type[]" style="width:100%"> <option name="code_type">ICD</option> <option name="code_type">CPT</option> </select>\n\
                                    </div> \n\
                                </div>'; //New input field html 

//billing Code
        var fieldHTML = '<div class="form-group remove"><div style ="width:100%; margin-top:5px;" class="remove_div_bill'+cnt+'"><input type="number" placeholder="Enter Billing Code" name="billing_code[]" value="" style="width:100%"/>\n\</div></div>'; //New input field html 
    
        var fieldHTMLCodeName = '<div class="form-group test_class" id="test_id" ><div style ="width:100%; margin-top:5px;" ><input type="text" placeholder="Enter Code Name" name="billing_code_name[]" value="" style="width:90%"/>\n\
<a href="javascript:void(0)" class="h_pathology_remove_field btn btn-danger btn-sm remove_button" onclick="removeClass()"><i class="fa fa-minus"></i></a>\n\
</div> \n\
</div>'; //New input field html 
            
            
            if (x < maxField) {
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
                $(field_wrapper_codeType).append(fieldHTMLCodeType); //Add field html
                $(field_wrapper_codeName).append(fieldHTMLCodeName); //Add field html
            }
        });

        //Once remove button is clicked
        $(field_wrapper_codeName).on('click', '.remove_button', function (e) {
            //  $("#").removeClass('remove_test');
           //console.log(cnt);
           
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            $(".remove_dv_codeType"+cnt).parent('div').remove(); //Remove field html
           // $(".remove_dv_codeType").parent('div').remove(); //Remove field html
            $(".remove_div_bill"+cnt).parent('div').remove(); //Remove field html
            ///$("#test_class").removeClass('remove_test'); //Remove field html
            cnt--;
            x--; //Decrement field counter
        });
    });
    
    function removeClass(){
        $("#test_id").removeClass('remove_test'); //Remove field html
    }
</script>