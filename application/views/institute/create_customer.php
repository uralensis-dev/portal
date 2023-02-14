<style type="text/css">
    .section_title {
        font-size: 22px;
        font-weight: 500;
        padding: 0px 0 20px;
        display: block;
    }

    img.setting_images {
        width: 40px;
        height: 40px;
        margin-bottom: 15px;
    }

    .text {
        font-size: 16px;
        font-weight: 500;
    }

    .user_image {
        max-width: 40px;
        border-radius: 20px;
        margin-right: 5px;
    }

    .breadcrumb-item+.breadcrumb-item::before {
        display: inline-block;
        padding-right: .5rem;
        color: #6c757d;
        content: "/";
    }
</style>

<div class="content container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Add Customer</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">New Customer</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
            </div>
        </div>
    </div>
<form action="#" id="laboratory_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
    <div class="row">
        <div class="col-md-12">
            <section class="form-group">
                <div class="card profile-box flex-fill">
                    <div class="card-body">
                        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
                        <p class="text-danger"></p>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Primary Name <span class="text-danger">*</span></label>
                                    <input class="form-control <?php if ($errors) echo empty($form_data['laboratory_name']['error']) ? 'is-valid' : 'is-invalid' ?>" <?php if ($errors) echo empty($form_data['laboratory_name']['error']) ? '' : 'aria-invalid="true"' ?> name="laboratory_name" id="laboratory_name" type="search" value="<?php echo $errors ? $form_data['laboratory_name']['value'] : ''; ?>">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['laboratory_name']['error'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>First Name<span class="text-danger">*</span></label>
                                    <input class="form-control" name="laboratory_initials_1" id="laboratory_initials_1" type="text" value="">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['laboratory_initials_1']['error'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Last Name<span class="text-danger">*</span></label>
                                    <input class="form-control" name="laboratory_initials_2" id="laboratory_initials_2" type="text" value="<?php echo $errors ? $form_data['laboratory_initials_2']['value'] : ''; ?>">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['laboratory_initials_2']['error'] ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" name="laboratory_address" id="laboratory_address" value="<?php echo $errors ? $form_data['laboratory_address']['value'] : ''; ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control" name="laboratory_country" id="laboratory_country">
                                        <option value="">Select Country</option>
                                        
                                        <?php foreach ($countries as $country) {  ?>
                                            <?php 
                                            $selected = ''; 
                                            if ($country['nicename'] === 'United Kingdom') {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                            ?>
                                            <?php if ($errors && $country['id'] === $form_data['laboratory_country']['value']) $selected = 'selected'; ?>
                                            <option <?php echo $selected; ?> value="<?php echo $country['id']; ?>"><?php echo $country['nicename']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>City</label>
                                    <input class="form-control" name="laboratory_city" id="laboratory_city" value="<?php echo $errors ? $form_data['laboratory_city']['value'] : ''; ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>State/Province</label>
                                    <input class="form-control" type="text" name="laboratory_state" id="laboratory_state" placeholder="" value="<?php echo $errors ? $form_data['laboratory_state']['value'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input class="form-control" name="laboratory_post_code" <?php echo $errors ? $form_data['laboratory_post_code']['value'] : ''; ?> id="laboratory_post_code" value="" type="text">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control <?php if ($errors) echo empty($form_data['laboratory_email']['error']) ? 'is-valid' : 'is-invalid' ?>" <?php if ($errors) echo empty($form_data['laboratory_email']['error']) ? '' : 'aria-invalid="true"' ?> name="laboratory_email" id="laboratory_email" value="<?php echo $errors ? $form_data['laboratory_email']['value'] : ''; ?>" type="email">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['laboratory_email']['value']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input class="form-control" name="laboratory_number" id="laboratory_number" value="<?php echo $errors ? $form_data['laboratory_number']['value'] : ''; ?>" type="text">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input class="form-control" name="laboratory_mobile_num" id="laboratory_mobile_num" value="<?php echo $errors ? $form_data['laboratory_mobile_num']['value'] : ''; ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fax</label>
                                    <input class="form-control" name="laboratory_fax" id="laboratory_fax" value="<?php echo $errors ? $form_data['laboratory_fax']['value'] : ''; ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Website Url</label>
                                    <input class="form-control <?php if ($errors) echo empty($form_data['laboratory_website']['error']) ? 'is-valid' : 'is-invalid' ?>" <?php if ($errors) echo empty($form_data['laboratory_website']['error']) ? '' : 'aria-invalid="true"' ?> name="laboratory_website" id="laboratory_website" value="<?php echo $errors ? $form_data['laboratory_website']['value'] : ''; ?>" type="text">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['laboratory_website']['value']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <h3>Finance Details</h3>
            <section>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Company Registration Number</label>
                                    <input class="form-control" name="laboratory_city" id="laboratory_city" value="<?php echo $errors ? $form_data['laboratory_city']['value'] : ''; ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Credit Card Limit</label>
                                    <input class="form-control" type="text" name="laboratory_state" id="laboratory_state" placeholder="" value="<?php echo $errors ? $form_data['laboratory_state']['value'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Sale Discount(%)</label>
                                    <input class="form-control" name="laboratory_post_code" <?php echo $errors ? $form_data['laboratory_post_code']['value'] : ''; ?> id="laboratory_post_code" value="" type="text">
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Bill Due Date</label>
                                    <input class="form-control <?php if ($errors) echo empty($form_data['laboratory_email']['error']) ? 'is-valid' : 'is-invalid' ?>" <?php if ($errors) echo empty($form_data['laboratory_email']['error']) ? '' : 'aria-invalid="true"' ?> name="laboratory_email" id="laboratory_email" value="<?php echo $errors ? $form_data['laboratory_email']['value'] : ''; ?>" type="email">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['laboratory_email']['value']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Invoice Due Date</label>
                                    <input class="form-control" name="laboratory_number" id="laboratory_number" value="<?php echo $errors ? $form_data['laboratory_number']['value'] : ''; ?>" type="text">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </section>           
        </div>
    </div>
    <button disable="true" id="form-submit-btn" class="btn btn-success btn-rounded">Submit</button>
    </form>

</div>
<!-- /Page Content -->