<div class="page-header">
    <h3 class="page-title">Add User Privilege</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
        <li class="breadcrumb-item">User Privileges</li>
        <li class="breadcrumb-item active">Add User Privilege</li>
    </ul>
    <?php if(!empty($this->session->flashdata('error_message'))){?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <?php echo $this->session->flashdata('error_message');?> </div>
    <?php } ?>
    <?php if(!empty($this->session->flashdata('success_message'))){?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <?php echo $this->session->flashdata('success_message');?> </div>
    <?php } ?>
</div>
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12 p_r_0 p_l_0">
                        <div class="card">
                            <div class="card-body main_container_padding">
                                <div class="card-title">
                                    <h4 class="">Add User Privilege</h4>
                                    <?php if (user_is_privileged('View user privileges list')) { ?>
                                        <div class="pull-right add_btn"><a href="<?php echo site_url('Admin/user_privileges'); ?>" class="btn btn-info"> View All </a></div>
                                    <?php } ?>
                                </div>
                                <?php $attributes = array('class' => 'form-horizontal mt-4 row', 'role' => 'form'); ?>
                                <?php echo form_open('Admin/add_privilege',$attributes); ?>
                                    <div class="form-group col-md-6 mt-3">
                                    <div class="form-group col-md-12 mt-3">
                                        <label class="control-label">Privilege Name <span class="text-danger">*</span></label>
                                        <input type="text" name="privilege_name" class="form-control" placeholder="Privilege Name">
                                        <span class="has-error text-danger"><?php echo form_error('privilege_name'); ?></span>
                                    </div>
                                    <div class="form-group col-md-12 mt-3">
                                        <label class="control-label " >Parent Privilege<span class="text-danger">*</span></label>
                                        <select class="select2 form-control custom-select" name="parent_privilege" style="width: 100%; height:45px;">
                                            <option value="0">Select Parent</option>
                                            <?php foreach ($parent_privileges as $parent_privilege) {?>
                                                <option value="<?php echo $parent_privilege['upriv_id']; ?>"> <?php echo $parent_privilege['upriv_name']; ?> </option>

                                            <?php } ?>
                                        </select>
                                        <span class="has-error text-danger"><?php echo form_error('parent_privilege'); ?></span>
                                    </div>
                                    </div>
                                    <div class="form-group col-md-6 mt-3">
                                        <label class="control-label">Privilege Description<span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="privilege_description" rows="6px"></textarea>
                                        <span class="has-error text-danger"><?php echo form_error('privilege_description'); ?></span>
                                    </div>
                                <div class="clearfix"></div>


                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-info mr-3">Submit</button>
                                    <a href="<?php echo base_url('Admin/user_privileges'); ?>" class="btn btn-danger waves-effect waves-light">Cancel</a>
                                </div>
                                <?php echo form_close(); ?>

                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
            </div>
        </div>
        <!-- Row -->
