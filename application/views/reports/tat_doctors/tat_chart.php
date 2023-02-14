<style>
    .hidden {
        display: none;
    }
    a.btn.btn-default.pull-right {
        border: 1px solid #ddd;
        color: #000;
        margin-left: 10px;
        line-height: 1;
    }
    .custom-table tr:hover{
        background: #f5f5f5;
    }
</style>
<div class="page-header">
    <h3 class="page-title">Dashboard/ TAT Chart</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
        <li class="breadcrumb-item active">TAT Chart</li>
    </ul>
</div>
<div class="row">
    <div class="col-sm-8"> </div>
    <div class="col-md-4">
        <ul class="list-inline pull-right">
            <li class="list-inline-item">
                <a href="javascript:void(0);" class="btn btn-default pull-right chart_view_btn hidden">
                    <i class="fa fa-bar-chart"></i>
                </a>
                <a href="javascript:void(0);" class="btn btn-default pull-right list_view_btn">
                    <i class="fa fa-th"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="row" id="chart_view">
    <div class="col-md-12 form-group">
        <div class="card">
            <div class="card-body" style="height: 450px;">
                <h3>TAT Last 12 Months (<?php echo $user_name; ?>)</h3>
                <div id="tats_graph" style="height: 95%"></div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="list_view" style="display: none;">
    <div class="col-md-12 form-group">
        <div class="card">
            <div class="card-body" style="max-height: 950px;">
                <div class="row">
                    <div class="col-md-6">
                        <h3>TAT Last 12 Months (<?php echo $user_name; ?>)</h3>
                    </div>
                    <div class="col-md-6 pull-right">
                        <ul class="list-inline pull-right">
                            <li class="list-inline-item">
                                <a href="<?php echo base_url('Cims/tat_chart_pdf'); ?>" class="btn btn-default pull-right">
                                    <i class="fa fa-download"></i>Pdf
                                </a>
                                <a href="<?php echo base_url('Cims/tat_chart_csv'); ?>" class="btn btn-default pull-right">
                                    <i class="fa fa-download"></i>CSV
                                </a>
                                <a href="<?php echo base_url('Cims/tat_chart_excel'); ?>" class="btn btn-default pull-right">
                                    <i class="fa fa-download"></i>Excel
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>


                    <table class="doctors_tat_table table custom-table mb-0">
                        <thead>
                        <tr>
                            <th>SR#</th>
                            <th>Publish Month</th>
                            <th>Total Cases</th>
                            <th>TAT less than 10</th>
                            <th>TAT less than 10 (%age)</th>
                            <th>Target TAT</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $itr = 1;
                        foreach ($twelve_month_tat as $row) { ?>

                            <tr class="<?php //echo $row_code; ?>">
                                <td> <?php echo $itr; ?></td>
                                <td><?php echo $row->publish_month; ?></td>
                                <td><a href="<?php echo base_url('cims/month_records_detail?m=').$row->publish_month; ?>"><?php echo $row->num_of_cases; ?></a></td>
                                <td><?php echo $row->tat_less_ten; ?></td>
                                <td><?php echo $row->tat_less_ten_percent; ?></td>
                                <td><?php echo $row->target_less_ten; ?></td>
                            </tr>
                            <!--############################## Data Display END #########################################-->
                            <?php
                            $itr++;
                        } //endforeach
                        ?>

                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 form-group">
        <div class="card">
            <div class="card-body" style="max-height: 750px; overflow-y: auto;">
                <h3>TAT Score by Case</h3>
                <table class=" table table-responsive custom-table mb-0" id="month_wise_detail">
                    <thead>
                    <tr>
                        <th>SR#</th>
                        <th>Date Published</th>
                        <th>Serial No</th>
                        <th>PCI</th>
                        <th>Patient Name</th>
                        <th>Lab Number</th>
                        <th>NHS</th>
                        <th>DOB</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Clinician</th>
                        <th>Clinic Date</th>
                        <th>Date Received By Lab</th>
                        <th>Date Received By Doctor</th>
                        <th>Doctor Name</th>
                        <th>TAT</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 form-group">
        <div class="card">
            <div class="card-body" style="height: 340px;">
                <div id="last_month_TAT" style="height: 100%"></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 form-group">
        <div class="card">
            <div class="card-body" style="height: 340px;">
                <div id="last_3months_TAT" style="height: 100%"></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 form-group">
        <div class="card">
            <div class="card-body" style="height: 340px;">
                <div id="last_6months_TAT" style="height: 100%"></div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<script>
    var base_url = '<?php echo base_url(); ?>';
    var twelve_month_tat     = <?php echo json_encode($twelve_month_tat, JSON_NUMERIC_CHECK ); ?>;
    var avg_lm_tat   = <?php echo json_encode($avg_lm_tat, JSON_NUMERIC_CHECK ); ?>;
    var avg_l3m_tat      = <?php echo json_encode($avg_l3m_tat, JSON_NUMERIC_CHECK ); ?>;
    var avg_l6m_tat      = <?php echo json_encode($avg_l6m_tat, JSON_NUMERIC_CHECK ); ?>;
    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>
