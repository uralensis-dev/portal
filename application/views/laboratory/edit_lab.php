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
                <h3 class="page-title">Update Lab</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">Update Lab</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
            </div>
        </div>
    </div>
    <?php if($this->session->flashdata('error_message')){ ?>
        <div class="row message_box">
            <div class="col-md-5">
                <div class="alert alert-danger" role="alert">
                    <?= $this->session->flashdata('error_message'); ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php echo form_open_multipart('', array('id' => 'hospital_form')); ?>
    <div class="row">
        <div class="col-md-12">
            <section class="form-group">
                <div class="card profile-box flex-fill">
                    <div class="card-body">                        
                        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
                        <input type="hidden" name="is_active_directory" value="" id="is_active_directory"/>
                        <input type="hidden" name="hospital_information" value="H">
                        <p class="text-danger"></p>
                        <div class="row">                            
                            <div class="col-sm-6">
                                <div class="form-group">                                    
                                    <label>lab Name <span class="text-danger">*</span></label>
                                    <input class="enter_hospital form-control <?php if ($errors) echo empty($form_data['hospital_name']['error']) ? 'is-valid' : 'is-invalid' ?>" <?php if ($errors) echo empty($form_data['hospital_name']['error']) ? '' : 'aria-invalid="true"' ?> name="hospital_name" id="hospital_name" type="search" value="<?= $lab['lab_name']?>" required>
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['hospital_name']['error'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>First Initial<span class="text-danger">*</span></label>
                                    <input class="form-control <?php if ($errors) echo empty($form_data['hospital_initials_1']['error']) ? 'is-valid' : 'is-invalid';  ?>" <?php if ($errors) echo empty($form_data['hospital_initials_1']['error']) ? '' : 'aria-invalid="true"' ?> name="hospital_initials_1" id="hospital_initials_1" maxlength="1" type="text" value="<?= $lab['first_initial']; ?>" required>
                                    <div class="invalid-feedback">
                                        <?= form_error('hospital_initials_1'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Second Initial<span class="text-danger">*</span></label>
                                    <input class="form-control <?php if ($errors) echo empty($form_data['hospital_initials_2']['error']) ? 'is-valid' : 'is-invalid';  ?>" <?php if ($errors) echo empty($form_data['hospital_initials _2']['error']) ? '' : 'aria-invalid="true"' ?> name="hospital_initials_2" id="hospital_initials_2" maxlength="1" type="text" value="<?= $lab['last_initial']?>" required>
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['hospital_initials_2']['error'] ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" autocomplete="off" name="hospital_address" id="hospital_address" value="<?= $lab['lab_address']?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Country</label>                                    
                                    <select class="form-control" name="hospital_country" id="hospital_country">
                                        <option value="">Select Country</option>                                        
                                        <?php foreach ($countries as $country) {  ?>
                                            <?php 
                                            $selected = '';                                             
                                            if ($country['id'] === $lab['lab_country']) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                            ?>
                                            <?php if ($errors && $country['id'] === $form_data['hospital_country']['value']) $selected = 'selected'; ?>
                                            <option <?php echo $selected; ?> value="<?php echo $country['id']; ?>"><?php echo $country['nicename']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>City</label>
                                    <input class="form-control" name="hospital_city" id="hospital_city" value="<?= $lab['lab_city']; ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>State/Province</label>
                                    <input class="form-control" type="text" name="hospital_state" id="hospital_state" placeholder="" value="<?= $lab['lab_state']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input class="form-control" name="hospital_post_code" <?php echo $errors ? $form_data['hospital_post_code']['value'] : ''; ?> id="hospital_post_code" value="<?= $lab['lab_post_code']; ?>" type="text">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input autocomplete="off" class="form-control <?php if ($errors) echo empty($form_data['hospital_email']['error']) ? 'is-valid' : 'is-invalid' ?>" <?php if ($errors) echo empty($form_data['hospital_email']['error']) ? '' : 'aria-invalid="true"' ?> name="hospital_email" id="hospital_email" value="<?= $lab['lab_email']; ?>" type="email">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['hospital_email']['value']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Organisation site identifier</label>
                                    <input class="form-control" name="site_identifier" id="site_identifier" value="<?= $lab['site_identifier']; ?>" type="text">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Organisation identifier</label>
                                    <input class="form-control" name="identifier" id="identifier" value="<?= $lab['identifier']; ?>" type="text">
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input class="form-control" name="hospital_number" id="hospital_number" value="<?= $lab['lab_phone']; ?>" type="text">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input class="form-control" name="hospital_mobile_num" id="hospital_mobile_num" value="<?= $lab['lab_mobile']; ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fax</label>
                                    <input class="form-control" name="hospital_fax" id="hospital_fax" value="<?= $lab['lab_fax']; ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Website Url</label>
                                    <input class="form-control <?php if ($errors) echo empty($form_data['hospital_website']['error']) ? 'is-valid' : 'is-invalid' ?>" <?php if ($errors) echo empty($form_data['hospital_website']['error']) ? '' : 'aria-invalid="true"' ?> name="hospital_website" id="hospital_website" value="<?= $lab['lab_website']; ?>" type="text">
                                    <div class="invalid-feedback">
                                        <?php if ($errors) echo $form_data['hospital_website']['value']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input class="form-control" name="logo" id="hospital_logo" value="" type="file">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <?php 
                                $img = base_url('assets/img/default.jpg');
                                if($clinic['logo'] !='' && file_exists(FCPATH.'uploads/logo/'.$lab['logo'])){
                                    $img = base_url().'uploads/logo/'.$lab['logo'];
                                }
                                ?>
                                <img style="max-height: 94px; width: auto;" class="hospital-logo-preview" src="<?= $img; ?>" alt="Logo">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <button disable="true" id="form-submit-btn" class="btn btn-primary btn-lg btn-rounded">Submit</button>
</form>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>  
<script type="text/javascript" src="<?= base_url(); ?>assets/js/scripts/clinic.js"></script>