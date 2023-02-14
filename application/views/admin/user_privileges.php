
<div class="page-header">
    <h3 class="page-title">User Privileges</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
        <li class="breadcrumb-item active">User Privileges</li>
    </ul>
</div>
<!-- ============================================================== -->
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
                            <h4 class="">User Privileges</h4>
<!--                            --><?php //if (user_is_privileged('Insert user privilege')) { ?>
                                <div class="pull-right add_btn"><a href="<?php echo site_url('Admin/add_privilege'); ?>" class="btn btn-info"> Add New </a></div>
<!--                            --><?php //} ?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="table-responsive">
                            <?php
                            $parent = 0;
                            $privileges_list = array(
                                'items' => array(),
                                'parents' => array()
                            );
                            if(!empty($privileges)){
                                //                        while ($items = mysqli_fetch_assoc($result)) {
                                foreach ($privileges as $items) {
                                    // Create current menus item id into array
                                    $privileges_list['items'][$items['upriv_id']] = $items;
                                    // Creates list of all items with children
                                    $privileges_list['parents'][$items['parent_id']][] = $items['upriv_id'];
                                }
                                //                    echo '<pre>'; print_r($privileges_list); exit;
                            }else{ ?>
                                <div class="white-box">
                                    <h3>No Data Found!</h3>
                                </div>
                            <?php }
                            ?>
                        </div>
                        <div class='listings dd dd-draghandle bordered'>
                            <?php echo createPrivilegeTree($parent, $privileges_list); ?>
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
