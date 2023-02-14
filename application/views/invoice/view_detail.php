<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Invoice</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('invoice/price_listing'); ?>">Bill Codes</a></li>
                <li class="breadcrumb-item"><a href="">Details</a></li>

            </ul>
        </div>
        <!--		<div class="col-auto float-right ml-auto">
                                <div class="btn-group btn-group-sm">
                                        <button class="btn btn-white">CSV</button>
                                        <button class="btn btn-white">PDF</button>
                                        <button class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button>
                                </div>
                        </div>-->
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Departments</th>
                                <th>Specialty</th>
                                <th>Test Categories</th>
                                <th>Rate</th>
                                <th>Country</th>
                                <th class="d-none d-sm-table-cell">DESCRIPTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $result[0]["department_name"];?></td>
                                <td><?php echo $result[0]["speciality_name"];?></td>
                                <td><?php echo $result[0]["test_category"];?></td>
                                <td><?php echo $result[0]["rate"];?></td>
                                <td><?php echo $result[0]["country"];?></td>
                                <td><?php echo $result[0]["description"];?></td>
                              
                            </tr>

                        </tbody>
                    </table>
                </div>


                <div class="invoice-info">
                    <strong>Billing Codes</strong>
                    
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code Type</th>
                                <th>Billing Code</th>
                                <th>Code Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $cnt = 0;
                                foreach ($priceCode as $priceKey => $priceValue) {
                                    $cnt++;
                                ?>
                            
                                <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $priceValue["code_type"];?></td>
                                <td><?php echo $priceValue["billing_code"];?></td>
                                <td><?php echo $priceValue["billing_code_name"];?></td>
                            </tr>
                            
                            <?php }?>
                            
                            
                            
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>