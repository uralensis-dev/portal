<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Customer Invoice</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Customers Invoice</li>
            </ul>
        </div>                
    </div>
</div>
<div>    
</div>	

<div class="row">
    <div class="col-md-12">
     <div class="row">
     <div class="col-md-6 card" style="width:100%; padding:1%">
     <?php
	 foreach($hospital_data as $hos_data)
	 { 
	 ?>
     <h4>Contact Details:</h4><?php print $hos_data->description;?><br />
<?php print $hos_data->hosp_email;?><br />
<?php print $hos_data->hosp_phone;?><br /><?php print $hos_data->hosp_address;?><br /><?php print $hos_data->hosp_post_code;?>
     </div>     
    <?php } ?>
     <div class="col-md-6 card" style="width:100%; padding:1%">
     <h4>Finance Details: <a style="float:right" href="<?php echo base_url(); ?>customer/Deletecustomer/<?=$resValue->group_id?>"><i class="fa fa-edit"></i></a></h4>
      <?php
	 foreach($finance_data as $fin_data)
	 {
	// print "<pre>"; 
	// print_r($fin_data);
	// print "</pre>"; 	 
	 ?>
     Billing Due Date: <?php print $fin_data->bill_due_date;?> of every month<br />
     Sales Account No: <?php print $fin_data->sales_account_no;?><br />Sales VAT No: <?php print $fin_data->sales_vat;?> <br />Purchase Account No: <?php print $fin_data->purchase_account_no;?><br />
     Purchase VAT No: <?php print $fin_data->purchase_vat;?>
     <?php } ?>
     </div>
     </div>
    <div class="row">
     <div class="card" style="width:100%; padding:2%">
     <h4>No of invoice awaiting payment  <span style="float:right">&nbsp; 0.00 USD</span></h4>
     </div>
     </div>
        <div class="table-responsive">
            <table class="table table-striped datatable custom-table" id="dtable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Status</th>
                        <th>Invoice Number</th>
                        <th>Refrence</th>
                        <th>Date</th>
                        <th>Due Date</th>
                        <th>Total</th>
                        <th class="text-right">Action</th>

                    </tr>
                </thead>
                <tbody> 
                <tr>
                        <td>1</td>
                        <td>Unpaid</td>
                        <td>INV-343536</td>
                        <td>Customer Name<br />
                        Email<br />999999999</td>
                        <td>25-08-2021</td>
                        <td>02-09-2021</td>
                        <td>2,340 USD</td> 
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="javascript:;" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="#"><i class="fa fa-eye m-r-5"></i> View</a>
                                    <a class="dropdown-item" href="<?php echo base_url(); ?>customer/Deletecustomer/<?=$resValue->group_id?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>                                    
                                </div>
                            </div>
                        </td>                       
                        
                    </tr> 
                    <tr>
                        <td>1</td>
                        <td>Unpaid</td>
                        <td>INV-343536</td>
                        <td>Customer Name<br />
                        Email<br />999999999</td>
                        <td>25-08-2021</td>
                        <td>02-09-2021</td>
                        <td>2,340 USD</td>  
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="javascript:;" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="#"><i class="fa fa-eye m-r-5"></i> View</a>
                                    <a class="dropdown-item" href="<?php echo base_url(); ?>customer/Deletecustomer/<?=$resValue->group_id?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>                                    
                                </div>
                            </div>
                        </td>                      
                        
                    </tr> 

                    

                                   
                </tbody>
            </table>

 
</div>
<script>
  
        // Initialize the DataTable
        $(document).ready(function () {
            $('#dtable').DataTable({
  
                // Enable the searching
                // of the DataTable
                searching: true
            });
        });
    </script>           
 </div>
    </div>
</div>
