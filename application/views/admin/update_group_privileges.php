<style>
    .hidden {
        display: none;
    }
    a.btn.btn-default.pull-right {
        border: 1px solid #ddd;
        color: #000;
        margin-left: 10px;
        line-height: 1;
    }
    .privilege_checkbox {
        z-index: 995 !important;
        top: 8px !important;
        left: 35px !important;
        opacity: 1 !important;
        position: absolute !important
    }

    .dd-item.third {
        list-style-type: none;
        display: inline
    }

    .dd {
        max-width: none !important;
        clear: both
    }

    .dd-list > .dd-item {
        display: block
    }

    .dd-list > .dd-item > .dd-list > .dd-item > .dd-list {
        display: inline-block;
    }
</style>
<div class="page-header">
    <h3 class="page-title">Manage Group Privileges</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
        <li class="breadcrumb-item">User Groups</li>
        <li class="breadcrumb-item active">Manage Group Privileges</li>
    </ul>
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
                            <h4 class="">Manage Group Privileges</h4>
                            <!--                                    --><?php //if (user_is_privileged('Update user group privileges')) { ?>
                            <div class="pull-right add_btn" style="margin-left:10px; ">
                                <?php
                                $form_url = "Admin/manage_user_group/$group_id";
                                $attributes = array();
                                echo form_open($form_url, $attributes); ?>
                                <input type="submit" class="btn btn-info" name="update_group_privilege"
                                       value="Update Group Privileges"/>
                                <?php form_close(); ?>
                            </div>
                            <!--                                    --><?php //} ?>
                            <!--                                    --><?php //if (user_is_privileged('Insert user privilege')) { ?>
                            <div class="pull-right add_btn"><a href="<?php echo site_url('Admin/add_privilege'); ?>" class="btn btn-info"> Add New </a></div>
                            <!--                                    --><?php //} ?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="table-responsive">
                            <?php
                            $parent = 0;

                            $privileges_list = array(
                                'items' => array(),
                                'parents' => array()
                            );
                            //                        while ($items = mysqli_fetch_assoc($result)) {
                            if (!empty($privileges)) {
                                foreach ($privileges as $items) {
                                    // Create current menus item id into array
                                    $privileges_list['items'][$items['upriv_id']] = $items;
                                    // Creates list of all items with children
                                    $privileges_list['parents'][$items['parent_id']][] = $items['upriv_id'];
                                }
                                //                    echo '<pre>'; print_r($privileges_list); exit;
                                ?>
                                <div class='listings dd dd-draghandle bordered'>
                                    <?php echo createGroupPrivilegeTree($parent, $privileges_list, $group_privileges); ?>
                                </div>
                            <?php } else { ?>
                                <div class="white-box">
                                    <h3>No Data Found!</h3>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <!-- Row -->
    </div>
</div>
<!-- Row -->
