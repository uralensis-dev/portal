<!-- Page Content -->
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Left Menu(s)</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo site_url("/admin/home");?>">Home</a></li>
                    <li class="breadcrumb-item active">Left Menu</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="<?php echo site_url("/menu/show");?>" class="btn add-btn"><i class="fa fa-plus"></i> Add New</a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <?php 
        
    ?>
    <div class="row">
        <div class="col-md-12">
            <?php 
                if($this->session->flashdata('showMessage') === true){
                    ?>
                        <div class="col-md-12">
                            <div class="alert alert-<?php echo ($this->session->flashdata('type') !== 'success')?"danger":"success";?> show">
                                <p><?php echo $this->session->flashdata('message');?></p>
                            </div>
                        </div>
                    <?php
                }
            ?>
            <div class="table-responsive">
                <table class="table table-striped custom-table mb-0 datatable">
                    <thead>
                        <tr>
                            <th style="width: 30px;">#</th>
                            <th>Menu Name</th>
                            <th>Group Name</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $cntr = 1;
                            foreach($menuList as $mnuz):?>
                            <tr>
                                <td><?php echo $cntr++;?></td>
                                <td><?php echo $mnuz->menu_name;?></td>
                                <?php if (empty($mnuz->default_menu)) { ?>
                                <td><?php echo $mnuz->description;?></td>
                                <?php }else{ ?>
                                <td></td>
                                <?php } ?>
                                <td class='text-center'>
                                    <?php if($mnuz->menu_id != 0):?>
                                    <div class="dropdown action-label">
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                        <?php if($mnuz->is_active == 1):?>
                                            <i class="fa fa-dot-circle-o text-success"></i> Active
                                            <?php else:?>
                                                <i class="fa fa-dot-circle-o text-danger"></i> Inactive
                                            <?php endif;?>    
                                        </a>
                                        <div class="dropdown-menu">
                                            <?php if($mnuz->is_active == 1):?>
                                                    <a class="dropdown-item" href="<?php echo site_url('menu/deactivate/'.$mnuz->menu_id);?>"><i class="fa fa-dot-circle-o text-danger"></i> Deactivate</a>
                                                <?php else:?>
                                                    <a class="dropdown-item" href="<?php echo site_url('menu/activate/'.$mnuz->menu_id);?>"><i class="fa fa-dot-circle-o text-success"></i> Activate</a>
                                                <?php endif;?>
                                        </div>
                                    </div>
                                    <?php endif;?>    
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="<?php echo site_url('menu/itemList/'.$mnuz->menu_id);?>"><i class="fa fa-list m-r-5"></i> Menu Item(s)</a>
                                            <?php if($mnuz->is_active == 1 && $mnuz->menu_id != 0):?>
                                            <a class="dropdown-item" href="<?php echo site_url('menu/show/'.$mnuz->menu_id);?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="<?php echo site_url('menu/delete/'.$mnuz->menu_id);?>" onClick='return confirm("Are You Sure, This will remove all the Items As Well");'><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            
                            <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /Page Content -->