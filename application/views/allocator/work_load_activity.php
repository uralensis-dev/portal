<!-- Page Header -->
<style type="text/css">
    .text-white{color: #fff;}
    .circle {
        padding: 5px;
        min-width: 44px;
        min-height: 44px;
        text-align: center;
        line-height: 2;
        font-weight: bold;
        font-size: 16px;
        border:1px solid #fff;
    }
    .bg-white{background: #fff; color: #000;     border-color: #ddd;}
    .table.custom-table > tbody > tr > td{height: 60px; vertical-align: middle;}
    .px-30{padding-right: 30px; padding-left: 30px}
    .px-0{padding-right: 0; padding-left: 0}
    .bg-warning, .badge-warning {
        background-color: #ffab00b0 !important;
    }
    .table.custom-table > thead > tr > th{text-align: center;}
    .table.custom-table > thead > tr > th:nth-child(2n),
    .table.custom-table > tbody > tr > td:nth-child(2n){
        background:#f5f5f5
    }
    .custom-table tr{box-shadow: unset;}
    .bg-gray{background:#f5f5f5}
    .bg-whitw{background:#ffffff}
    .fa.fa-download{
        position: absolute;
        right: -12px;
        top: 0;
        background: #00c5fb;
        color: #fff;
        bottom: 8px;
        line-height: 3;
        padding: 0 7px;
        cursor: pointer;
    }
    .canvasjs-chart-toolbar {
        margin-top: -35px !important;
    }

    /*.table.custom-table > thead > tr > th:last-child,
    .table.custom-table > tbody > tr > td:last-child{
        background: none;
    }*/
    .nav-tabs-solid.cust_tabs li {
        margin-right: 30px;
    }
    .nav-tabs-solid.cust_tabs li a {
        padding: 8px 30px;
        background: #00c5fb;
        border-color: #00c5fb;
        color: #fff;
        display: inline-block;
    }
    .nav-tabs-solid.cust_tabs li a.active,.nav-tabs-solid.cust_tabs li a:hover  {
        background: #00adff;
        border-color: #00adff;
        color: #fff;
    }
    .list-inline-item:not(:last-child) {
        margin-right: 0.4rem;
    }
</style>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Work Load Activity</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="#">Work Load Activity</a></li>
            </ul>
        </div>
        <!-- <div class="col text-right">
            <button class="btn add-btn" data-toggle="modal" data-target="#add_employee">Allocate</button>
        </div> -->
    </div>
</div>
<!-- /Page Header -->
<div class="row">
    
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-tabs nav-tabs-solid cust_tabs">
                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                </ul>
                
            </div>
            <div class="col-md-3">
                <input type="text" name="" class="form-control text-center" disabled placeholder="10-July-2020 TO 25-July-2020">
                <i class="fa fa-download"></i>
            </div>
            <div class="col-md-6">
                <ul class="pagination pull-right">
                    <li class="page-item disabled">
                        <a class="page-link text-dark" href="#" tabindex="-1"><i class="fa fa-angle-double-left"></i> Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">Current</a></li>
                    
                    <li class="page-item">
                        <a class="page-link text-dark" href="#">Next <i class="fa fa-angle-double-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        
    </div>

    <div class="col-md-12 tab-content px-0 form-group">
        <div class="tab-pane show active" id="activity">
            <div class="col-md-12">
                <table class="table table-stripped custom-table">
                    <thead>
                        
                        <tr>
                            <th style="width: 20%" rowspan="2">Period </th>
                            <th style="width: 20%" rowspan="2">Estimated</th>
                            <th style="width: 20%" rowspan="2">Actual</th>
                            <th style="width: 20%" rowspan="2">Variance</th>
                            <th style="width: 20%" colspan="3">Cumulative</th>
                            
                        </tr>
                         <tr>
                            <th class="bg-white">Period</th>
                            <th class="bg-white">Score</th>
                            <th class="bg-white">Variance</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>Dr. Chaudhry <span style="margin-left: 15px;">Week 1</span></td>
                            <td>
                                <ul class="list-inline text-center">
                                    <li class="list-inline-item"><div class="circle bg-primary text-white" data-toggle="tooltip" data-placement="top" title="Estimated">45</div></li>
                                </ul>
                            </td>
                            <td>
                                <ul class="list-inline text-center">
                                    
                                    <li class="list-inline-item"><div class="circle bg-dark text-white" data-toggle="tooltip" data-placement="top" title="Actual">55</div></li>
                                    
                                </ul>
                            </td>
                            <td>
                                <ul class="list-inline text-center">
                                    
                                    <li class="list-inline-item"><div class="circle bg-white" data-toggle="tooltip" data-placement="top" title="Variance">+10</div></li>
                                    
                                </ul>
                            </td>
                            
                            <td>
                                <ul class="list-inline text-center">
                                    
                                    <li class="list-inline-item">3 Months</li>
                                </ul>
                            </td>
                            <td class="bg-white">
                                <ul class="list-inline text-center">
                                    <li class="list-inline-item"><div class="circle bg-info text-white" data-toggle="tooltip" data-placement="top" title="Total">295</div></li>
                                    
                                </ul>
                            </td>

                            <td class="bg-white">
                                <ul class="list-inline text-center">
                                    
                                    <li class="list-inline-item"><div class="circle bg-white" data-toggle="tooltip" data-placement="top" title="Total Variance">-100</div></li>
                                </ul>
                            </td>
                        </tr>


                       	<tr>
                            <td>Dr. Chaudhry <span style="margin-left: 15px;">Week 2</span></td>
                            <td>
                                <ul class="list-inline text-center">
                                    <li class="list-inline-item"><div class="circle bg-primary text-white" data-toggle="tooltip" data-placement="top" title="Estimated">75</div></li>
                                </ul>
                            </td>
                            <td>
                                <ul class="list-inline text-center">
                                    
                                    <li class="list-inline-item"><div class="circle bg-dark text-white" data-toggle="tooltip" data-placement="top" title="Actual">55</div></li>
                                    
                                </ul>
                            </td>
                            <td>
                                <ul class="list-inline text-center">
                                    
                                    <li class="list-inline-item"><div class="circle bg-white" data-toggle="tooltip" data-placement="top" title="Variance">-20</div></li>
                                    
                                </ul>
                            </td>
                            
                            <td>
                                <ul class="list-inline text-center">
                                    
                                    <li class="list-inline-item">3 Months</li>
                                </ul>
                            </td>
                            <td class="bg-white">
                                <ul class="list-inline text-center">
                                    <li class="list-inline-item"><div class="circle bg-info text-white" data-toggle="tooltip" data-placement="top" title="Total">350</div></li>
                                    
                                </ul>
                            </td>

                            <td class="bg-white">
                                <ul class="list-inline text-center">
                                    
                                    <li class="list-inline-item"><div class="circle bg-white" data-toggle="tooltip" data-placement="top" title="Total Variance">-120</div></li>
                                </ul>
                            </td>
                        </tr>

                        <tr>
                            <td>Dr. Chaudhry <span style="margin-left: 15px;">Week 3</span></td>
                            <td>
                                <ul class="list-inline text-center">
                                    <li class="list-inline-item"><div class="circle bg-primary text-white" data-toggle="tooltip" data-placement="top" title="Estimated">100</div></li>
                                </ul>
                            </td>
                            <td>
                                <ul class="list-inline text-center">
                                    
                                    <li class="list-inline-item"><div class="circle bg-dark text-white" data-toggle="tooltip" data-placement="top" title="Actual">120</div></li>
                                    
                                </ul>
                            </td>
                            <td>
                                <ul class="list-inline text-center">
                                    
                                    <li class="list-inline-item"><div class="circle bg-white" data-toggle="tooltip" data-placement="top" title="Variance">+20</div></li>
                                    
                                </ul>
                            </td>
                            
                            <td>
                                <ul class="list-inline text-center">
                                    
                                    <li class="list-inline-item">3 Months</li>
                                </ul>
                            </td>
                            <td class="bg-white">
                                <ul class="list-inline text-center">
                                    <li class="list-inline-item"><div class="circle bg-info text-white" data-toggle="tooltip" data-placement="top" title="Total">450</div></li>
                                    
                                </ul>
                            </td>

                            <td class="bg-white">
                                <ul class="list-inline text-center">
                                    
                                    <li class="list-inline-item"><div class="circle bg-white" data-toggle="tooltip" data-placement="top" title="Total Variance">-100</div></li>
                                </ul>
                            </td>
                        </tr>
                       

                    </tbody>
                </table>
            </div>    
        </div>
        
    </div>

    <div class="col-md-12 form-group">
        <div class="col-md-12 card">
            <div class="card-body">
                <h3 class="text-center"> Work Load Activity </h3>
                <div id="chartContainer" style="height: 300px; width: 100%;">
            </div>
        </div>
    </div>
    
</div>
<!-- /Page Content -->



<!-- Add Employee Modal -->
<div id="add_employee" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Allocate Pathologist</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label> Select Pathologist</label>
                            <select class="form-control input-lg">
                                <option>Iskander</option>
                                <option>Pathologist 2</option>
                                <option>Pathologist 3</option>
                                <option>Pathologist 4</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label> Allocation Date</label>
                            <div class="cal-icon"><input class="form-control datetimepicker" type="text"></div>
                        </div>
                        <div class="col-md-12 mb-10">
                            <label> Select Number</label>
                            <input type="text" name="" class="form-control input-lg">
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn add-btn">Allocate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Employee Modal -->
