<!-- Page Header -->
<style type="text/css">
    .show{display: block !important;}
    .add-btn{border-radius: 50px;}
</style>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title"><?php echo $name; ?></h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><?php echo $name; ?></li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="javascript:;" class="btn add-btn" ><i class="fa fa-plus"></i>Add <?php echo $name; ?></a>

            <div class="view-icons">
                <a href="javascript:;" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                <a href="javascript:;" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
            </div>
        </div>        
    </div>
</div>
<div id="grid_view" class="fade hidden show">
    <div class="row staff-grid-row">
    <?php
	                  $cnt =0;                            
                      foreach($groupDetail as $resKey => $resValue) 
                      {
                          $cnt ++;
                      ?>   
    
        <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
                <div class="profile-img">
                    <a href="javascript:;" class="avatar"><img src="assets/img/profiles/avatar-02.jpg" alt=""><?php echo $resValue->first_initial;?><?php echo $resValue->last_initial;?></a>
                </div>
                <div class="dropdown profile-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="javascript:;" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                        <a class="dropdown-item" href="javascript:;" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                    </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis"><?php echo $resValue->enc_first_name.' '.$resValue->enc_last_name;?></h4>
               <br /> <div class="small text-muted"><?php echo $resValue->description; ?> </div>
            </div>
        </div>
        
      <?php } ?>  
        
          
    </div>
</div>
 <div id="list_view" class="fade hidden">
   <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped datatable custom-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Company</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody> 
                      <?php
                      $cnt =0;
                      foreach($groupDetail as $resKey => $resValue)
                      {
                          $cnt ++;
                      ?>                    
                        <tr>
                            <td><?php echo $cnt; ?></td>
                            <td><?php echo $resValue->enc_first_name.' '.$resValue->enc_last_name;?> </td>
                            <td><?php echo $resValue->enc_email;?></td>
                            <td><?php echo $resValue->enc_phone;?></td>
                            <td><?php echo $resValue->enc_company;?></td>
                            <td>
                                <a class="dropdown-item" href="javascript:;"><i class="fa fa-pencil m-r-5"></i></a>
                                <a class="dropdown-item" href="javascript:;"><i class="fa fa-trash-o m-r-5"></i></a>
<!--                                <a class="dropdown-item" href="--><?php //echo base_url();?><!--auth/delete_group/--><?php //echo $resValue->group_id;?><!--"><i class="fa fa-pencil m-r-5"></i></a> -->
<!--                                <a class="dropdown-item" onclick="return confirm('Are you sure you want to delete this group?');" href="--><?php //echo base_url();?><!--auth/delete_group/--><?php //echo $resValue->group_id;?><!--"><i class="fa fa-trash-o m-r-5"></i></a>-->
                            </td>
                        </tr>                    
                      <?php } ?>                   
                    </tbody>
                </table>

    </div>
</div>