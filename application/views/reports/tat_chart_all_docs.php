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
</style>
<div class="page-header">
    <h3 class="page-title">Dashboard/ TAT Chart</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
        <li class="breadcrumb-item active">TAT Chart</li>
    </ul>
</div>
<div class="row">
    <div class="col-sm-10">
        <?php
        $attributes = array('id' => 'chart_range_form','name'=>'chart_range_form');
        echo form_open("Reports/tat_chart", $attributes);
        ?>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="">Select Date Range</label>
                    <div class="cal-icon">
                        <input data-bind="daterangepicker: dateRange" class="form-control date_range" name="date_range"
                               type="text" value="<?php echo $sr_dt_range; ?>">
                    </div>
            </div>
            <div class="form-group col-md-4">
                <label class="">Select Group By</label>
                    <select class="form-control" name="chart_group_by">
                        <option value="Doctor" <?php echo($sr_group_by == "Doctor" ? "selected" : ""); ?> >Doctor
                        </option>
                        <option value="Speciality" <?php echo($sr_group_by == "Speciality" ? "selected" : ""); ?> >
                            Speciality
                        </option>
                    </select>
            </div>
            <div class="form-group col-md-4" style="padding-top: 8px;">
                <label class=""></label>
                <div class="col-md-6">
                    <button class="btn btn-sm btn-info form-control" id="btn_date_range" type="submit">Apply</button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <div class="col-md-2">
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
<!--                --><?php //echo $user_name; ?>
                <h3>TAT Last Month (All Doctors) </h3>
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
<!--                        --><?php //echo $user_name; ?>
                        <h3>TAT Last Month (All Doctors)</h3>
                    </div>
                    <div class="col-md-6 pull-right">
                        <ul class="list-inline pull-right">
                            <li class="list-inline-item">
                                <a href="<?php echo base_url('Reports/tat_chart_pdf/'.urlencode(urlencode($sr_dt_range)).'/'.urlencode($sr_group_by)); ?>" class="btn btn-default pull-right">
                                    <i class="fa fa-download"></i>Pdf
                                </a>
                                <a href="<?php echo base_url('Reports/tat_chart_csv'); ?>" class="btn btn-default pull-right">
                                    <i class="fa fa-download"></i>CSV
                                </a>
                                <a href="<?php echo base_url('Reports/tat_chart_excel'); ?>" class="btn btn-default pull-right">
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
                            <?php if($sr_group_by=="Doctor"){ ?>
                                <th>Doctor Name</th>
                            <?php } ?>
                            <?php if($sr_group_by=="Speciality"){ ?>
                                <th>Speciality Name</th>
                            <?php } ?>

                            <th>Total Cases</th>
                            <th>TAT less than 10</th>
                            <th>TAT less than 10 (%age)</th>
                            <th>Target TAT</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $itr = 1;
                        foreach ($all_docs_l_month_data as $row) { ?>

                            <tr class="<?php //echo $row_code; ?>">
                                <td> <?php echo $itr; ?> </td>
                                <td><?php if($sr_group_by=="Doctor"){ echo $row->doctor_name; } if($sr_group_by=="Speciality"){ echo $row->speciality_group; }?></td>
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
    var all_docs_l_month_data     = <?php echo json_encode($all_docs_l_month_data, JSON_NUMERIC_CHECK ); ?>;
    var avg_last_month_tat_data   = <?php echo json_encode($avg_lm_tat, JSON_NUMERIC_CHECK ); ?>;
    var avg_last_3m_tat_data      = <?php echo json_encode($avg_l3m_tat, JSON_NUMERIC_CHECK ); ?>;
    var avg_last_6m_tat_data      = <?php echo json_encode($avg_l6m_tat, JSON_NUMERIC_CHECK ); ?>;
    var group_by                  = "<?php echo $sr_group_by; ?>";
    var x_axis_name               = "";
    if(group_by =="Doctor"){
        x_axis_name = "doctor_name";
    }
    if(group_by == "Speciality"){
        x_axis_name = "speciality_group";
    }
    console.log(x_axis_name);

</script>