<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Suppliers</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Suppliers</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="<?php echo base_url(); ?>index.php/invoice/addBillingCode" class="btn add-btn"><i class="fa fa-plus"></i>Suppliers</a>
        </div>        
    </div>
</div>
<div>    
</div>	
<br /></br>
<!-- /Page Header -->
<!-- /Search Filter -->
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
                        <th>Registred Company Name</th>
                        <th>Total Invoice</th>
                        <th>Billing Date</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>  
                <tr>
                        <td>1</td>
                        <td>Jared Ellis</td>
                        <td>Jaredws@gmail.com</td>
                        <td>01625 661253</td>
                        <td>laboratoryname</td>
                        <td>UK</td>
                        <td>20/10/2021</td>                        
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="javascript:;" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
<!--                                    <a class="dropdown-item" href="edit-invoice.html"><i class="fa fa-pencil m-r-5"></i> Edit</a>-->
<!--                                    <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/billing/view_invoice"><i class="fa fa-eye m-r-5"></i> View</a>
                                    <a class="dropdown-item" href="javascript:;"><i class="fa fa-file-pdf-o m-r-5"></i> Download</a>-->
<!--                                    <a class="dropdown-item" href="<?php echo base_url("invoice/details/".$resValue["id"]); ?>"><i class="fa fa-eye m-r-5"></i> View</a>-->
                                    <a class="dropdown-item" href="<?php echo base_url('invoice/deleteBillingCode/')?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                    
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                                      
                  <?php
                  $cnt =0; 
                  foreach($result as $resKey => $resValue) 
				  {
                      $cnt ++;
                  ?>                    
                    <tr>
                        <td><?php echo $cnt; ?></td>
                        <td><?php echo $resValue["code_type"];?></td>
                        <td><?php echo $resValue["billing_code"];?></td>
                        <td><?php echo $resValue["billing_code_name"];?></td>
                        <td><?php echo $resValue["billing_rate"];?></td>
                        <td><?php echo $resValue["country"];?></td>
                        <td><?php echo $resValue["description"];?></td>                        
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="javascript:;" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
<!--                                    <a class="dropdown-item" href="edit-invoice.html"><i class="fa fa-pencil m-r-5"></i> Edit</a>-->
<!--                                    <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/billing/view_invoice"><i class="fa fa-eye m-r-5"></i> View</a>
                                    <a class="dropdown-item" href="javascript:;"><i class="fa fa-file-pdf-o m-r-5"></i> Download</a>-->
<!--                                    <a class="dropdown-item" href="<?php echo base_url("invoice/details/".$resValue["id"]); ?>"><i class="fa fa-eye m-r-5"></i> View</a>-->
                                    <a class="dropdown-item" href="<?php echo base_url('invoice/deleteBillingCode/')?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                    
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                  <?php } ?> 
                  
                </tbody>
            </table>
        </div>
    </div>
</div>
