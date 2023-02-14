<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Records</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Records</li>
            </ul>
        </div>               
    </div>
</div>
<div>    
</div>	
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped datatable custom-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Lab No</th>
                        <th>Name</th>
                        <th>D.O.B</th>
                        <th>Specimen Letter</th>
                        <th>Speciman Type</th>
                        <th>No Of Slides</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody> 
                
                 <?php
                  $cnt =0;
                  foreach($records_data as $resKey => $kayvalue) 
				  {
					  $cnt++;
                  ?>                    
                    <tr>
                        <td><?php echo $cnt; ?></td>
                        <td><?php echo $kayvalue->lab_no;?> </td>
                        <td><?php echo $kayvalue->name;?></td>
                        <td><?php echo $kayvalue->dob;?></td>
                        <td><?php echo $kayvalue->specimen_type;?></td>
                        <td><?php echo $kayvalue->specimen;?></td>
                        <td><?php echo $kayvalue->slides;?></td>                        
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="javascript:;" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="#"><i class="fa fa-eye m-r-5"></i> View</a>
                                    <a class="dropdown-item" href="<?php echo base_url(); ?>institute/delete_records/<?php echo $kayvalue->id;?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>                                    
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
