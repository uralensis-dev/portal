<!-- Page Header -->
<style type="text/css">
.text-white {
    color: #fff;
}

.alloc-circle {
    padding: 5px;
    width: 40px;
    height: 40px;
    text-align: center;
    line-height: 2;
    font-weight: bold;
    font-size: 16px;
    border: 1px solid #fff;
    border-radius: 100px;
}

.px-0 {
    padding-left: 0;
    padding-right: 0
}

.px-20 {
    padding-left: 20;
    padding-right: 20
}

.mg-0 {
    margin: 0;
}

.py-10 {
    padding: 10px 0;
}

.by-1 {
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
}

.bg-white {
    background: #fff;
    color: #000;
    border-color: #ddd;
}

.table.custom-table>tbody>tr>td {
    height: 60px;
    vertical-align: middle;
}

.px-30 {
    padding-right: 30px;
    padding-left: 30px
}

.bg-warning,
.badge-warning {
    background-color: #ffab00b0 !important;
}

.table.custom-table>thead>tr>th {
    text-align: center;
}

.table.custom-table>thead>tr>th:nth-child(2n),
.table.custom-table>tbody>tr>td:nth-child(2n) {
    background: #f5f5f5
}

.table.custom-table>thead>tr>th:last-child,
.table.custom-table>tbody>tr>td:last-child {
    background: none;
}

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

.nav-tabs-solid.cust_tabs li a.active,
.nav-tabs-solid.cust_tabs li a:hover {
    background: #00adff;
    border-color: #00adff;
    color: #fff;
}

.list-inline-item:not(:last-child) {
    margin-right: 0.4rem;
}

.allocator-percent-alloc {
    cursor: pointer;
}

.arrow-button {
    border: none;
    box-shadow: none;
    border-radius: 25px;
    background-color: rgba(230, 230, 230, 0.5);
    width: 30px;
    height: 30px;
}

.arrow-button:hover {
    background-color: rgba(210, 210, 210, 1);
}

.arrow-button:active {
    background-color: rgba(150, 150, 150, 1);
}

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js" integrity="sha512-YSdqvJoZr83hj76AIVdOcvLWYMWzy6sJyIMic2aQz5kh2bPTd9dzY3NtdeEAzPp/PhgZqr4aJObB3ym/vsItMg==" crossorigin="anonymous"></script>
<?php
    $monday = strtotime("last monday");
    $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;


    $this_week_sd = $week_start;
    $today = $week_end;
    // TODO: Change dates to current
    // $this_week_sd = date("Y-m-d", strtotime('2020-08-03'));
    // $today = date("Y-m-d", strtotime('2020-08-05'));

    $today_day_of_week = strtolower(date('D', strtotime($today)));

    $start_date = $this_week_sd;
    $days = array();
    while ($start_date <= $today) {
        array_push($days, $start_date);
        $start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));
    }
?>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 class="page-title">Allocator</h3>
            <h2><?php echo $hospital_name?></h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="#">Allocator</a></li>
            </ul>
        </div>
        <?php if ($can_allocate):?>
        <div class="col-4 text-right">
            <button class="btn add-btn" id="allocate-confirm-button">Allocate</button>
        </div>
        <?php endif;?>
    </div>
</div>
<!-- /Page Header -->
<div class="row">

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4 col-xl-5">
                <ul class="nav nav-tabs nav-tabs-solid cust_tabs">
                    <li class="nav-item"><a class="nav-link" id="allocator-tab-switch-all" href="#all" data-toggle="tab">All</a></li>
                    <li class="nav-item"><a class="nav-link" id="allocator-tab-switch-speciality" href="#speciality" data-toggle="tab">Speciality</a></li>
                    <li class="nav-item"><a class="nav-link" id="allocator-tab-switch-pathologist" href="#pathologist" data-toggle="tab">Pathologist</a></li>
                </ul>

            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-sm-2">
                        <button class="arrow-button" onclick="goBackWeek()"> <i class="fas fa-chevron-left"></i> </button>
                    </div>
                    <div class="col-sm-7 text-center">
                    <select onchange="goToWeek(this)" class="form-control">
                        <?php foreach ($week_list as $ind => $wk): ?>
                            <option value="<?php echo $ind?>" <?php if($ind == $week) echo 'selected'; ?> ><?php echo $wk; ?></option>
                        <?php endforeach; ?>
                    </select>
                        
                    </div>
                    <div class="col">
                        <?php if(date("Y-m-d") != $week_end): ?>
                        <button class="arrow-button" onclick="goForwardWeek()"> <i class="fas fa-chevron-right"></i> </button>
                        <?php endif;?>
                    </div>
                </div>
            </div>
            <?php if($choose_hospital):?>
            <div class="col">
                <div class="dropdown text-right">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Choose Hospital
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php foreach($hospitals as $hospital): ?>
                        <a class="dropdown-item" href="<?php echo base_url();?>allocator/allocator/<?php echo $hospital['id'];?>"><?php echo $hospital['name'];?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif;?>
        </div>

    </div>

    <div class="tab-content">
        <div class="tab-pane" id="all">
            <div class="col-md-12">
                <table class="table table-stripped custom-table">
                    
                    <thead>
                        <tr>
                            <th>All</th>
                            <?php foreach($days as $day): ?>
                            <th><?php echo date('d-M-Y', strtotime($day)); ?></th>
                            <?php endforeach; ?>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <th></th>
                            <?php foreach($days as $day): ?>
                            <th><?php echo date('D', strtotime($day)); ?></th>
                            <?php endforeach; ?>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>All</td>
                            <?php
                                $unassigned_total = 0;
                                $assiged_total = 0;
                                $total_total = 0;
                            ?>
                            <?php foreach($week_summary_all as $sum): ?>
                            <?php
                                $unassigned_total += $sum['unassigned'];
                                $assiged_total += $sum['assigned'];
                                $total_total += $sum['total'];
                            ?>
                            <td>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-primary text-white" data-toggle="tooltip"
                                            data-placement="top" title="Unallocated"><?php echo round($sum['unassigned'])?>
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-dark text-white" data-toggle="tooltip"
                                            data-placement="top" title="Allocated"><?php echo round($sum['assigned'])?></div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-white" data-toggle="tooltip" data-placement="top"
                                            title="Total"><?php echo round($sum['total'])?></div>
                                    </li>
                                </ul>
                            </td>
                            <?php endforeach; ?>
                            <td>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-primary text-white" data-toggle="tooltip"
                                            data-placement="top" title="Unallocated"><?php echo round($unassigned_total)?>
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-dark text-white" data-toggle="tooltip"
                                            data-placement="top" title="Allocated"><?php echo round($assiged_total)?></div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-white" data-toggle="tooltip" data-placement="top"
                                            title="Total"><?php echo round($total_total)?></div>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <?php foreach($week_summary as $specialty => $s): ?>
                        <tr>
                            <td><?php echo $specialty?></td>
                            <?php
                                $day_unassigned_total = 0;
                                $day_assigned_total = 0;
                                $day_total_total = 0;
                            ?>
                            <?php foreach($s as $day_sum): ?>
                            <?php
                                $day_unassigned_total += $day_sum['unassigned'];
                                $day_assigned_total += $day_sum['assigned'];
                                $day_total_total += $day_sum['total'];
                            ?>
                            <td>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-primary text-white" data-toggle="tooltip"
                                            data-placement="top" title="Unallocated"><?php echo round($day_sum['unassigned'])?>
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-dark text-white" data-toggle="tooltip"
                                            data-placement="top" title="Allocated"><?php echo round($day_sum['assigned'])?>
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-white" data-toggle="tooltip" data-placement="top"
                                            title="Total"><?php echo round($day_sum['total'])?></div>
                                    </li>
                                </ul>
                            </td>
                            <?php endforeach; ?>
                            <td>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-primary text-white" data-toggle="tooltip"
                                            data-placement="top" title="Unallocated"><?php echo round($day_unassigned_total)?>
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-dark text-white" data-toggle="tooltip"
                                            data-placement="top" title="Allocated"><?php echo round($day_assigned_total)?>
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-white" data-toggle="tooltip" data-placement="top"
                                            title="Total"><?php echo round($day_total_total)?></div>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="tab-pane" id="speciality">
            <div class="col-md-12">
                <table class="table table-stripped custom-table" id="cust_table">
                    <thead>
                        <tr>
                            <th>
                                <select class="form-control" name="" id="specialty_report_list">
                                    <?php foreach($specialty_report_complete as $specialty => $report):?>
                                    <option <?php if ($specialties[$specialty] == $current_specialty) echo 'selected'; ?> value="<?php echo $specialties[$specialty]?>"><?php echo $specialties[$specialty]?></option>
                                    <?php endforeach; ?>
                                </select>
                            </th>
                            <?php foreach($days as $day): ?>
                            <th><?php echo date('d-M-Y', strtotime($day)); ?></th>
                            <?php endforeach; ?>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <th></th>
                            <?php foreach($days as $day): ?>
                            <th><?php echo date('D', strtotime($day)); ?></th>
                            <?php endforeach; ?>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($specialty_report_complete as $specialty => $report):?>
                        <?php foreach($report as $doctor => $d_report): ?>
                        <tr class="specialty-row" data-value="<?php echo $specialties[$specialty]?>">
                            <td><?php 
                        if ($doctor == 0):
                            echo 'Unallocated';
                        else:
                             echo $doctors[$doctor];
                        endif;?></td>
                            <?php if($doctor != 0):?>
                            <?php
                                $spec_total_est = 0;
                                $spec_total_actual = 0;
                                $spec_total_var = 0;    
                            ?>
                            <?php foreach($d_report as $day => $r):?>
                            <?php if($day != $today_day_of_week):?>
                            <?php if (count($r) == 0):?>
                            <td>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-primary text-white" data-toggle="tooltip"
                                            data-placement="top" title="Estimated">0</div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-dark text-white" data-toggle="tooltip"
                                            data-placement="top" title="Estimated %">0%</div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-white" data-toggle="tooltip" data-placement="top"
                                            title="Actual">0</div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-white" data-toggle="tooltip" data-placement="top"
                                            title="Variance">0</div>
                                    </li>
                                    
                                </ul>
                            </td>
                            <?php else: $r = $r[0];?>
                            <?php
                                $spec_total_est += $r['est'];
                                $spec_total_actual += $r['assigned'];
                                $spec_total_var += $r['remaining'];
                            ?>
                            <td>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-primary text-white" data-toggle="tooltip"
                                            data-placement="top" title="Estimated"><?php echo round($r['est']) ?></div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-primary text-white" data-toggle="tooltip"
                                            data-placement="top" title="Estimated %"><?php
                                            if ($r['est_percent'] > 100):
                                                echo '100%';
                                            else:
                                                echo round($r['est_percent']).'%';
                                            endif;
                                            ?></div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-dark text-white" data-toggle="tooltip"
                                            data-placement="top" title="Actual"><?php echo round($r['assigned']) ?></div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-white" data-toggle="tooltip" data-placement="top"
                                            title="Variance"><?php echo round($r['remaining']) ?></div>
                                    </li>
                                </ul>
                            </td>
                            <?php endif;?>
                            <?php else:?>
                            <?php if (count($r) == 0):?>
                            <td>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-primary text-white" data-toggle="tooltip"
                                            data-placement="top" title="Estimated">0</div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-dark text-white" data-toggle="tooltip"
                                            data-placement="top" title="Estimated %">0%</div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-white" data-toggle="tooltip" data-placement="top"
                                            title="Actual">0</div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-white" data-toggle="tooltip" data-placement="top"
                                            title="Variance">0</div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-white" data-toggle="tooltip" data-placement="top"
                                            title="Calculated">0</div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-white" data-toggle="tooltip" data-placement="top"
                                            title="Calculated %">0%</div>
                                    </li>
                                </ul>
                            </td>
                            <?php else: $r = $r[0];?>
                            <td>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-primary text-white" data-toggle="tooltip"
                                            data-placement="top" title="Estimated"><?php echo round($r['est']) ?></div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-primary text-white" data-toggle="tooltip"
                                            data-placement="top" title="Estimated %"><?php
                                            if ($r['est_percent'] > 100):
                                                echo '100%';
                                            else:
                                                echo round($r['est_percent']).'%';
                                            endif;
                                            ?></div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-dark text-white" data-toggle="tooltip"
                                            data-placement="top" title="Actual"><?php echo round($r['assigned']) ?></div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-white" data-toggle="tooltip" data-placement="top"
                                            title="Variance"><?php echo round($r['remaining']) ?></div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-dark text-white" data-toggle="tooltip"
                                            data-placement="top" title="Calculated"><?php echo round($r['calculated_points']) ?>
                                        </div>
                                    </li>
                                    <li class="list-inline-item allocator-percent-alloc">
                                        <div class="alloc-circle bg-dark text-white" data-toggle="tooltip"
                                            data-placement="top" title="Calculated %"
                                            id="allocator-percent-alloc-<?php echo $specialty?>-<?php echo $doctor?>"><?php
                                            $percent =  $r['percent_alloc'] * 100;
                                            $percent = round($percent).'%'; echo $percent;?>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                            <?php endif;?>
                            <?php endif;?>
                            <?php endforeach; ?>
                            <!-- Total TD -->
                            <td>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-primary text-white" data-toggle="tooltip"
                                            data-placement="top" title="Estimated"><?php echo round($spec_total_est)?></div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-white" data-toggle="tooltip" data-placement="top"
                                            title="Actual"><?php echo round($spec_total_actual)?></div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-white" data-toggle="tooltip" data-placement="top"
                                            title="Variance"><?php echo round($spec_total_var)?></div>
                                    </li>
                                    
                                </ul>
                            </td>
                            <?php else:?>
                            <?php foreach($d_report as $day => $value): ?>
                            <td>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-white" data-toggle="tooltip" data-placement="top"
                                            title="Unallocated"><?php echo $value['rcpath']?></div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="alloc-circle bg-white" data-toggle="tooltip" data-placement="top"
                                            title="Cases"><?php echo $value['cases']?></div>
                                    </li>
                                </ul>
                            </td>
                            <?php endforeach;?>
                            <td></td>
                            <?php endif;?>
                        </tr>
                        <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="tab-pane" id="pathologist">
            <div class="col-md-12">
                <table class="table table-stripped custom-table">
                    <thead>
                        <tr>
                            <th>
                            <select class="form-control" name="" id="doctor_report_list">
                                    <?php foreach($doctor_week_report as $doctor => $report):?>
                                    <option value="<?php echo $doctor?>"><?php echo $doctors[$doctor]?></option>
                                    <?php endforeach; ?>
                            </select>
                            </th>
                            <?php foreach($days as $day): ?>
                            <th><?php echo date('d-M-Y', strtotime($day)); ?></th>
                            <?php endforeach; ?>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <th></th>
                            <?php foreach($days as $day): ?>
                            <th><?php echo date('D', strtotime($day)); ?></th>
                            <?php endforeach; ?>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($doctor_week_report as $doctor => $report): ?>
                            <?php foreach($report as $specialty => $day_report): ?>
                                <tr class="doctor-row" data-value="<?php echo $doctor?>">
                                    <td><?php echo $specialties[$specialty]?></td>
                                    <?php
                                        $doc_est_total = 0;
                                        $doc_alloc_total = 0;
                                        $doc_var_total = 0;
                                    ?>
                                    <?php foreach($day_report as $day => $r):?>
                                        <?php
                                            $doc_est_total += $r['est'];
                                            $doc_alloc_total += $r['allocated'];
                                            $doc_var_total += $r['variance'];
                                        ?>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <div class="alloc-circle bg-primary text-white" data-toggle="tooltip"
                                                        data-placement="top" title="Estimated"><?php echo round($r['est'])?></div>
                                                </li>
                                                <li class="list-inline-item">
                                                    <div class="alloc-circle bg-dark text-white" data-toggle="tooltip"
                                                        data-placement="top" title="Allocated"><?php echo round($r['allocated'])?></div>
                                                </li>
                                                <li class="list-inline-item">
                                                    <div class="alloc-circle bg-white" data-toggle="tooltip" data-placement="top"
                                                        title="Total"><?php echo round($r['variance'])?></div>
                                                </li>
                                            </ul>
                                        </td>
                                    <?php endforeach; ?>
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <div class="alloc-circle bg-primary text-white" data-toggle="tooltip"
                                                    data-placement="top" title="Estimated"><?php echo round($doc_est_total)?></div>
                                            </li>
                                            <li class="list-inline-item">
                                                <div class="alloc-circle bg-dark text-white" data-toggle="tooltip"
                                                    data-placement="top" title="Allocated"><?php echo round($doc_alloc_total)?></div>
                                            </li>
                                            <li class="list-inline-item">
                                                <div class="alloc-circle bg-white" data-toggle="tooltip" data-placement="top"
                                                    title="Total"><?php echo round($doc_var_total)?></div>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        <?php endforeach;?>
                        
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
<!-- /Page Content -->




<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="allocatorPercentModalHeading"
    id="allocatorPercentModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="allocatorPercentModalHeading"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Unallocated</label>
                        <div class="col-sm-2">
                            <input type="text" readonly class="form-control-plaintext" id="allocator-unallocated"
                                value="6">
                        </div>
                    </div>
                    <script id="allocator-percent-doctor-template" type="text/x-custom-template">
                    <div class="form-group row allocator-percent-doctor-container">
                        <label for="inputPassword" class="col-sm-4 col-form-label allocator-percent-doctor-label">Dr. Iskander Chaudhry</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control allocator-percent-doctor" id="" min="0" max="100" value="56">
                        </div>
            
                    </div>
                    </script>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="allocator-percent-modal-save">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
var allocator_data = JSON.parse('<?php echo json_encode($specialty_report_complete);?>');
var allocator_specialties = JSON.parse('<?php echo json_encode($specialties);?>');
var allocator_doctors = JSON.parse('<?php echo json_encode($doctors);?>');
var allocator_hospital_id = <?php echo $hospital_id?>;
var allocator_tab = '<?php echo $current_tab;?>';
var allocator_current_specialty = '<?php echo $current_specialty; ?>';
</script>

<!-- /Add Employee Modal -->