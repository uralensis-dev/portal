<!-- Page Content -->
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Menu Items For - "<?php echo $menuData['menu_name']; ?>" - "<?php echo $menuData['name']; ?>"</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo site_url("menu/list"); ?>">Menu</a></li>
                    <li class="breadcrumb-item active">Menu Items List</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <?php if (!$isDefault) { ?>
                    <a href="<?php echo site_url('menu/itemCreate/' . $menuData['menu_id']); ?>" class="btn add-btn"><i class="fa fa-plus"></i> Add New Menu Item</a>
                <?php } else { ?>
                    <a href="<?php echo site_url('menu/confirmEdit/'); ?>" class="btn add-btn"><i class="fa fa-pen"></i>Edit</a>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-md-12">
            <?php
            if ($this->session->flashdata('showMessage') === true) {
            ?>
                <div class="col-md-12">
                    <div class="alert alert-<?php echo ($this->session->flashdata('type') !== 'success') ? "danger" : "success"; ?> show">
                        <p><?php echo $this->session->flashdata('message'); ?></p>
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="table-responsive">
                <table class="table custom-table mb-0">
                    <thead>
                        <tr>
                            <th style="width: 30px;">#</th>
                            <th>Item Name</th>
                            <th>Item Parent</th>
                            <th>Icon</th>
                            <th>Link</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        foreach ($menuItemsLIst as $itemKey => $zeroLvlItem) :
                        ?>

                            <tr>
                                <td><?php echo $counter++; ?></td>
                                <td><?php echo $zeroLvlItem['item_name']; ?></td>
                                <td></td>
                                <td><?php echo $zeroLvlItem['item_icon']; ?></td>
                                <td><?php echo $zeroLvlItem['item_link']; ?></td>
                                <td class='text-right'>
                                    <div class="dropdown action-label">
                                        <?php if (!$isDefault) : ?>
                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                <?php if ($zeroLvlItem['is_active'] == 1) : ?>
                                                    <i class="fa fa-dot-circle-o text-success"></i> Active
                                                <?php else : ?>
                                                    <i class="fa fa-dot-circle-o text-danger"></i> Inactive
                                                <?php endif; ?>
                                            </a>
                                            <div class="dropdown-menu">
                                                <?php if ($zeroLvlItem['is_active'] == 1) : ?>
                                                    <a class="dropdown-item" href="<?php echo site_url('menu/deactivateItem/' . $zeroLvlItem['menu_id'] . '/' . $zeroLvlItem['menu_item_id']); ?>"><i class="fa fa-dot-circle-o text-danger"></i> Deactivate</a>
                                                <?php else : ?>
                                                    <a class="dropdown-item" href="<?php echo site_url('menu/activateItem/' . $zeroLvlItem['menu_id'] . '/' . $zeroLvlItem['menu_item_id']); ?>"><i class="fa fa-dot-circle-o text-success"></i> Activate</a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <?php if (!$isDefault) : ?>
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?php echo site_url('menu/itemCreate/' . $zeroLvlItem['menu_id'] . "/" . $zeroLvlItem['menu_item_id']); ?>"><i class="fa fa-plus m-r-5"></i> Add Sub Item</a>
                                                <a class="dropdown-item" href="<?php echo site_url('menu/itemCreate/' . $zeroLvlItem['menu_id'] . "/0/" . $zeroLvlItem['menu_item_id']); ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="<?php echo site_url('menu/deleteItem/' . $zeroLvlItem['menu_id'] . '/' . $zeroLvlItem['menu_item_id']); ?>" onClick='return confirm("Are You Sure, This will remove all the Items As Well");'><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php if (!empty($zeroLvlItem['sub_menu'])) : ?>
                                <tr>
                                    <td colspan='7'></td>
                                </tr>
                                <?php admin_men_lister($zeroLvlItem['sub_menu'], !$isDefault); ?>

                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /Page Content -->