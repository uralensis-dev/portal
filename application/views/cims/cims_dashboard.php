<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">CIMS Dashboard</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">CIMS Dashboard</li>
            </ul>
        </div>
    </div>
</div>
<!-- /Page Header -->
<div class="row top_dash">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
                <div class="dash-widget-info">
                    <h3>112</h3>
                    <span>TWW</span>
                </div>
                <p class="">Two week wait from referral to date first seen</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-usd"></i></span>
                <div class="dash-widget-info">
                    <h3>44</h3>
                    <span>31d</span>
                </div>
                <p class="">31-day wait from decision to treat to treatment start date</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-diamond"></i></span>
                <div class="dash-widget-info">
                    <h3>37</h3>
                    <span>Subsequent Treatment 31d</span>
                </div>
                <p class="">31-day wait from first treatment to sunsequent treatment</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-diamond"></i></span>
                <div class="dash-widget-info">
                    <h3>37</h3>
                    <span>Padiatric 31d</span>
                </div>
                <p class="">31-day wait from referral to treatment for child and rare cancers</p>
            </div>
        </div>
    </div>
    
</div>
<div class="row top_dash">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
                <div class="dash-widget-info">
                    <h3>112</h3>
                    <span>28d </span>
                </div>
                <p class="">FDS 28-day wait from referral to the date on which the patient is told whether cancer is diagnosed or ruled out (new)</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                <div class="dash-widget-info">
                    <h3>218</h3>
                    <span>62d</span>

                </div>
                <div class="progress mb-2" style="height: 5px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="">62-day wait from referral or consultant upgrade to first treatment</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-diamond"></i></span>
                <div class="dash-widget-info">
                    <h3>37</h3>
                    <span>Reports</span>
                </div>
                <p class="">62 day and 104 day backlog</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-usd"></i></span>
                <div class="dash-widget-info">
                    <h3>44</h3>
                    <span>PTLs</span>
                </div>
                <p class="">(Patient Tracking list)</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 text-center">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">COSD and National Audit Compaliance</h3>
                        <div id="bar-charts"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Specific Treatment and Procedure Data</h3>
                        <div id="line-charts"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /Statistics Widget -->
<div class="row">
    <div class="col-md-6 d-flex">
        <div class="card card-table flex-fill">
            <div class="card-header">
                <h3 class="card-title mb-0">Users</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-nowrap custom-table mb-0">
                        <thead>
                        <tr>
                            <th>Invoice ID</th>
                            <th>Hospitals</th>
                            <th>Due Date</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><a href="invoice-view.html">#INV-0001</a></td>
                            <td>
                                <h2><a href="#">Dubai National Healthcare</a></h2>
                            </td>
                            <td>11 Mar 2020</td>
                            <td>$380</td>
                            <td>
                                <span class="badge bg-inverse-warning">Partially Paid</span>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="invoice-view.html">#INV-0002</a></td>
                            <td>
                                <h2><a href="#">Ingrid Institute of Medicine</a></h2>
                            </td>
                            <td>8 Feb 2020</td>
                            <td>$500</td>
                            <td>
                                <span class="badge bg-inverse-success">Paid</span>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="invoice-view.html">#INV-0003</a></td>
                            <td>
                                <h2><a href="#">Texas Medical Center</a></h2>
                            </td>
                            <td>23 Jan 2020</td>
                            <td>$60</td>
                            <td>
                                <span class="badge bg-inverse-danger">Unpaid</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="invoices.html">View all invoices</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 d-flex">
        <div class="card card-table flex-fill">
            <div class="card-header">
                <h3 class="card-title mb-0">MDT's</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table custom-table table-nowrap mb-0">
                        <thead>
                        <tr>
                            <th>Invoice ID</th>
                            <th>Hospitals</th>
                            <th>Payment Type</th>
                            <th>Paid Date</th>
                            <th>Paid Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><a href="invoice-view.html">#INV-0001</a></td>
                            <td>
                                <h2><a href="#">Dubai National Healthcare</a></h2>
                            </td>
                            <td>Paypal</td>
                            <td>11 Mar 2020</td>
                            <td>$380</td>
                        </tr>
                        <tr>
                            <td><a href="invoice-view.html">#INV-0002</a></td>
                            <td>
                                <h2><a href="#">Ingrid Institute of Medicine</a></h2>
                            </td>
                            <td>Paypal</td>
                            <td>8 Feb 2020</td>
                            <td>$500</td>
                        </tr>
                        <tr>
                            <td><a href="invoice-view.html">#INV-0003</a></td>
                            <td>
                                <h2><a href="#">Texas Medical Center</a></h2>
                            </td>
                            <td>Paypal</td>
                            <td>23 Jan 2020</td>
                            <td>$60</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="payments.html">View all payments</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 d-flex">
        <div class="card card-table flex-fill">
            <div class="card-header">
                <h3 class="card-title mb-0">Search Records</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table custom-table mb-0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                                                    <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar"><img alt="" src="https://mskcc.uralensisdigital.co.uk/uploads/Avatar-03.png"></a>
                                        <a href="client-profile.html">Knightbridge University Medical Centre <span>Kirsten</span></a>
                                    </h2>
                                </td>
                                <td>office@nnuh.nhs.uk</td>
                                                                <td>
                                    <div class="dropdown action-label">
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-dot-circle-o text-success"></i> Inactive                                        </a>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="https://mskcc.uralensisdigital.co.uk/development/auth/edit_user/57"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar"><img alt="" src="https://mskcc.uralensisdigital.co.uk/uploads/Avatar-03.png"></a>
                                        <a href="client-profile.html">Knightbridge University Medical Centre <span>Julia</span></a>
                                    </h2>
                                </td>
                                <td>micasony@gmail.com</td>
                                                                <td>
                                    <div class="dropdown action-label">
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-dot-circle-o text-success"></i> Inactive                                        </a>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="https://mskcc.uralensisdigital.co.uk/development/auth/edit_user/56"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar"><img alt="" src="https://mskcc.uralensisdigital.co.uk/uploads/Avatar-03.png"></a>
                                        <a href="client-profile.html">Belgrave Hospital and Cancer Centre <span>Vanessa</span></a>
                                    </h2>
                                </td>
                                <td>megan.burns1@nhs.net</td>
                                                                <td>
                                    <div class="dropdown action-label">
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-dot-circle-o text-success"></i> Active                                        </a>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="https://mskcc.uralensisdigital.co.uk/development/auth/edit_user/22"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar"><img alt="" src="https://mskcc.uralensisdigital.co.uk/uploads/Avatar-03.png"></a>
                                        <a href="client-profile.html">Belgrave Hospital and Cancer Centre <span>Alexia</span></a>
                                    </h2>
                                </td>
                                <td>lesley.wood7@nhs.net</td>
                                                                <td>
                                    <div class="dropdown action-label">
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-dot-circle-o text-success"></i> Active                                        </a>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="https://mskcc.uralensisdigital.co.uk/development/auth/edit_user/41"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar"><img alt="" src="https://mskcc.uralensisdigital.co.uk/uploads/Avatar-03.png"></a>
                                        <a href="client-profile.html">Belgrave Hospital and Cancer Centre <span>Tess</span></a>
                                    </h2>
                                </td>
                                <td>becky.critchley@nhs.net</td>
                                                                <td>
                                    <div class="dropdown action-label">
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-dot-circle-o text-success"></i> Inactive                                        </a>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="https://mskcc.uralensisdigital.co.uk/development/auth/edit_user/34"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                                                </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?php echo base_url();?>">View all Users</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 d-flex">
        <div class="card flex-fill">
           <div class="card-body">
              <h4 class="card-title">Tasks</h4>
              <div class="statistics">
                 <div class="row">
                    <div class="col-md-6 col-6 text-center">
                       <div class="stats-box mb-4">
                          <p>Total Tasks</p>
                          <h3>7</h3>
                       </div>
                    </div>
                    <div class="col-md-6 col-6 text-center">
                       <div class="stats-box mb-4">
                          <p>Overdue Tasks</p>
                          <h3>1</h3>
                       </div>
                    </div>
                 </div>
              </div>
              <div class="progress mb-4">
                 <div class="progress-bar bg-purple" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                 <div class="progress-bar bg-warning" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                 <div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                 <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                 <div class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
              </div>
              <div>
                 <p><i class="fa fa-dot-circle-o text-purple mr-2"></i>Completed Tasks <span class="float-right">0</span></p>
                 <p><i class="fa fa-dot-circle-o text-warning mr-2"></i>In Progress Tasks <span class="float-right">0</span></p>
                 <p><i class="fa fa-dot-circle-o text-success mr-2"></i>On Hold Tasks <span class="float-right">0</span></p>
                 <p><i class="fa fa-dot-circle-o text-danger mr-2"></i>Pending Tasks <span class="float-right">7</span></p>
                 <p><i class="fa fa-dot-circle-o text-info mr-2"></i>Review Tasks <span class="float-right">0</span></p>
              </div>
           </div>
        </div>    
    </div>
</div>

<div class="row">
    <div class="col-md-6 d-flex">
        <div class="card card-table flex-fill">
            <div class="card-header">
                <h3 class="card-title mb-0">Documents</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                 <div class="table-responsive">
                    <table class="table custom-table mb-0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                                                    <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar"><img alt="" src="https://mskcc.uralensisdigital.co.uk/uploads/Avatar-03.png"></a>
                                        <a href="client-profile.html">Knightbridge University Medical Centre <span>Kirsten</span></a>
                                    </h2>
                                </td>
                                <td>office@nnuh.nhs.uk</td>
                                                                <td>
                                    <div class="dropdown action-label">
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-dot-circle-o text-success"></i> Inactive                                        </a>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="https://mskcc.uralensisdigital.co.uk/development/auth/edit_user/57"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar"><img alt="" src="https://mskcc.uralensisdigital.co.uk/uploads/Avatar-03.png"></a>
                                        <a href="client-profile.html">Knightbridge University Medical Centre <span>Julia</span></a>
                                    </h2>
                                </td>
                                <td>micasony@gmail.com</td>
                                                                <td>
                                    <div class="dropdown action-label">
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-dot-circle-o text-success"></i> Inactive                                        </a>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="https://mskcc.uralensisdigital.co.uk/development/auth/edit_user/56"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar"><img alt="" src="https://mskcc.uralensisdigital.co.uk/uploads/Avatar-03.png"></a>
                                        <a href="client-profile.html">Belgrave Hospital and Cancer Centre <span>Vanessa</span></a>
                                    </h2>
                                </td>
                                <td>megan.burns1@nhs.net</td>
                                                                <td>
                                    <div class="dropdown action-label">
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-dot-circle-o text-success"></i> Active                                        </a>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="https://mskcc.uralensisdigital.co.uk/development/auth/edit_user/22"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar"><img alt="" src="https://mskcc.uralensisdigital.co.uk/uploads/Avatar-03.png"></a>
                                        <a href="client-profile.html">Belgrave Hospital and Cancer Centre <span>Alexia</span></a>
                                    </h2>
                                </td>
                                <td>lesley.wood7@nhs.net</td>
                                                                <td>
                                    <div class="dropdown action-label">
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-dot-circle-o text-success"></i> Active                                        </a>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="https://mskcc.uralensisdigital.co.uk/development/auth/edit_user/41"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar"><img alt="" src="https://mskcc.uralensisdigital.co.uk/uploads/Avatar-03.png"></a>
                                        <a href="client-profile.html">Belgrave Hospital and Cancer Centre <span>Tess</span></a>
                                    </h2>
                                </td>
                                <td>becky.critchley@nhs.net</td>
                                                                <td>
                                    <div class="dropdown action-label">
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-dot-circle-o text-success"></i> Inactive                                        </a>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="https://mskcc.uralensisdigital.co.uk/development/auth/edit_user/34"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                                                </tbody>
                    </table>
                </div>   
                </div>
            </div>
            <!-- <div class="card-footer">
                <a href="<?php //echo base_url();?>">View all Users</a>
            </div> -->
        </div>
    </div>
    <div class="col-md-6 d-flex">
        <div class="card flex-fill">
           <div class="card-body">
              <h4 class="card-title">Login</h4>
              <table class="table custom-table mb-0">
                        <thead>
                        <tr>
                            <th>UL No.</th>
                            <th>Client Clinic</th>
                            <th>Request Datetime</th>
                        </tr>
                        </thead>
                        <tbody>
                                                    <tr>
                                <td>
                                    <h2>0-20-4</h2>
                                </td>
                                <td>
                                    BelgraveHospital                                </td>
                                <td>25,Jul,2020 10:07</td>
                            </tr>
                                                    <tr>
                                <td>
                                    <h2>0-20-3</h2>
                                </td>
                                <td>
                                    BelgraveHospital                                </td>
                                <td>25,Jul,2020 07:07</td>
                            </tr>
                                                    <tr>
                                <td>
                                    <h2>0-20-2</h2>
                                </td>
                                <td>
                                    BelgraveHospital                                </td>
                                <td>25,Jul,2020 07:07</td>
                            </tr>
                                                    <tr>
                                <td>
                                    <h2>0-20-1</h2>
                                </td>
                                <td>
                                    BelgraveHospital                                </td>
                                <td>25,Jul,2020 07:07</td>
                            </tr>
                                                    <tr>
                                <td>
                                    <h2>UL-20-3249</h2>
                                </td>
                                <td>
                                    BelgraveHospital                                </td>
                                <td>08,Jul,2020 02:07</td>
                            </tr>
                                                </tbody>
                    </table>
           </div>
        </div>    
    </div>
</div>
<!-- /Page Content -->