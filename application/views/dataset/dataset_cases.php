<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style type="text/css">
    div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top:-65px;
        height: 37px !important;
        width: 50px !important;
        left: 29px;
        padding:0;
    }
    .comments_icon a.opinion_status_btn {
        border: 1px solid #ddd;
        padding: 8px 4px;
        border-radius: 38px;
    }
    .btn-default{
        background: #f5f5f5 !important;
    }

    .alloc-circle {
        padding: 5px;
        width: 30px;
        height: 30px;
        text-align: center;
        line-height: 2;
        font-weight: bold;
        font-size: 16px;
        border: 1px solid #fff;
        border-radius: 100px;
    }
    .breadcrumb{padding: 0 !important}

    .tg-cancel input{
        display: none;
    }

    .tg-cancel label i {
        color: red;
    }

    .tg-cancel label {
        cursor: pointer;
        margin-bottom: 0;
        width: 45px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 50%;
    }
    /*.flags_check span.tg-radio {
        display: none;
    }
    .flags_check span.tg-radio.first {
        display: block;
    }*/

    @media screen and (min-width: 1600px) {
        body{font-size: 18px;}
    }
    @media screen and (min-width: 1380px) {
        .tg-cancel label {
            width: 35px;
            padding: 5px;
        }
        div.dataTables_wrapper div.dataTables_length select{top: -119px;}
    }
    ol.breadcrumb{float: left;}

    .clear_btn{
        cursor: pointer;
        margin-bottom: 0;
        margin-top: 5px;
        width: 50px !important;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 50%;
        display: inline-block;
    }
    .comments_icon a.opinion_status_btn{position: relative; display: inline-block;}
    .opinion_count, .opinion_count_pending {
        color: #fff;
        font-weight: 300;
        line-height: 1;
        padding: 4px;
        border-radius: 50%;
        font-size: 15px !important;
        text-align: center;
        position: absolute;
        top: -15px;
        /*right: 8px;*/
    }
    .opinion_count_pending{
        top: -20px;
        right: -10px;
    }
    /*.opinion_count_pending {
        color: #fff;
        font-weight: 700;
        position: absolute;
        right: 0;
        top: 0;
    }*/
</style>
<div class="clearfix"></div>


<div class="container-fluid">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3 class="page-title">Records</h3>
        <div class="tg-breadcrumbarea tg-searchrecordhold">
            <?php echo $breadcrumbs; ?>
        </div>
    </div>
    <div class="tg-haslayout">
        <?php
        if ($this->session->flashdata('record_status') != '') { ?>
        <p class="bg-success" style="padding:7px;"><?php echo $this->session->flashdata('record_status'); ?></p>
        <?php } ?>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-filterhold">
                    <?php
                    $attributes = array('method' => 'POST', 'id'=>'search_dataset_type_form');
                    echo form_open('doctor/datasets_cases', $attributes); ?>
                    <ul class="tg-filters record-list-filters">
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors nobefore search_li" style="padding: 0; max-width:220px;">
                            <div class="input-group">
<!--                                <select name="sr_dataset_type" class="form-control">-->
<!--                                    <optgroup label="Dataset Type">-->
<!--                                        <option value="all">All</option>-->
<!--                                        --><?php //if(!empty($datasets_case_types)){
//                                            foreach ($datasets_case_types as $key=>$val){ ?>
<!--                                                <option value="--><?php //echo $val; ?><!--" --><?php //echo ($sr_dataset_type == $val?'selected':''); ?><!-- > --><?php //echo $val; ?><!--</option>-->
<!--                                            --><?php //}
//                                        } ?>
<!--                                    </optgroup>-->
<!--                                </select>-->
                                <select name="sr_dataset_type[]" class="select2 form-control" multiple>
                                    <?php
                                    $counter = 0;
                                    foreach (get_Datasets() as $ds) {
                                    if ($ds->parent_dataset_id == 0) {
                                        echo ($counter!=0?'</optgroup>':"");
                                        echo '<optgroup label="'.$ds->dataset_code.'">';
                                    }
                                    if ($ds->parent_dataset_id > 0) {
                                        echo '<option value="'.$ds->dataset_id.'">'.$ds->dataset_code.'</option>';
                                    }
                                    }
                                    echo "</optgroup>";
                                    ?>
<!--                                    <optgroup label="Label 1">-->
<!--                                        <option value="1">One</option>-->
<!--                                        <option value="2">Two</option>-->
<!--                                        <option value="3">Three</option>-->
<!--                                    </optgroup>-->
<!--                                    <optgroup label="Label 2">-->
<!--                                        <option value="4">Four</option>-->
<!--                                        <option value="5">Five</option>-->
<!--                                        <option value="6">Six</option>-->
<!--                                    </optgroup>-->
                                </select>
                            </div>
                        </li>
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors nobefore search_li" style="padding: 0;">
                            <input type="hidden" id="reportranget" name="reportranget" />
                            <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                            <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                        </li>
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors nobefore search_li" style="padding: 0;">
                            <div class="input-group">
                                <button class="btn btn-lg btn-success" type="submit">Search</button>
                            </div>
                        </li>
                    </ul>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12" style="margin-bottom: 60px;">
            <?php
            if (isset($_GET['msg']) && $_GET['msg'] == 'success') {

                echo '<p class="bg-success" style="padding:7px;">Report Has Been Successfully Published.</p>';
            }
            if ($this->session->flashdata('unpublish_record_message') != '') {
                echo $this->session->flashdata('unpublish_record_message');
            }
            ?>
        </div>
    </div>

    <div class="row report_listing">
        <div class="col-md-12">
            <div class="flag_message"></div>

            <div class="col-md-10">
                <div id="container-chart"></div>
            </div>
        </div>
    </div>

    <?php
    $colorArray = array(
      "#354950",
      "#11A1E8",
      "#0000FF",
      "#FF0000",
      "#800080",
      "#FFFF00",
      "#7FFD4",
      "#008000",
      "#A52A2A",
      "#FFA500",
      "#5AA2E6"
    );
    ?>


</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    $(document).ready(function () {
        $(function() {

            var start = moment().subtract(6, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $('#reportranget').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

        });
        <?php if($_SERVER['REQUEST_METHOD']=="POST"){ ?>
        Highcharts.chart('container-chart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Dataset Cases'
            },
            xAxis: {
                categories: <?php echo json_encode($dates_data);?>,
                crosshair: true
            },

            yAxis: [
                { // Primary yAxis
                    gridLineColor: '#ffffff',
                    lineColor: '#ffffff',
                    min: 0,
                title: {
                    text: 'Total'
                }
            }],
            exporting: {
                enabled: false
            },
            // tooltip: {
            //     headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            //     pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            //         '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            //     footerFormat: '</table>',
            //     shared: true,
            //     useHTML: true
            // },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
                <?php $intt = 0; foreach ($dataset_data as $dataFin) {
                $dataset_type = $dataFin['dataset_type'];
                echo "{name:"."'$dataset_type',";
                echo "color:"."'$colorArray[$intt]',";
                echo "data:[";
                foreach ($dataFin['dataset_cases'] as $dataCases){
                    echo $dataCases->total_count.",";
                }
                echo "]},{";

                echo "type: 'spline',";
                echo "name: 'Percentage $dataset_type',";
                echo "color:"."'$colorArray[$intt]',";
                $arrayss = array_column($dataFin['dataset_cases'], 'total_count');
                echo "data:".json_encode($arrayss,JSON_NUMERIC_CHECK).",";?>
                tooltip: {
                        pointFormatter: function() {
                            console.log(this)
                            var string = this.series.name + ': ' + parseFloat((this.y/<?php echo max($arrayss)?> * 100),2) ;
                            return string;
                        },
                        shared: true
                    }
        <?php echo "},";



                ?>
                <?php $intt++;}
                ?>]
        });

        (function (){
            am4core.ready(function() {

                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end

                // Create chart instance
                var chart = am4core.create("tats_graph", am4charts.XYChart);
                // chart.numberFormatter.numberFormat = "#";

                // Add data
                chart.data = <?php echo json_encode($twelve_month_tat, JSON_NUMERIC_CHECK ); ?>

                // Chart Title
                //       var title = chart.titles.create();
                //           title.text = "TAT Last 12 Months";
                //           title.fontSize = 20;
                //           title.align = "left"
                //           title.marginBottom = 30;
                // Create axes
                var dateAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                dateAxis.dataFields.category = "publish_month";
                dateAxis.renderer.grid.template.location = 0;
                dateAxis.renderer.minGridDistance = 10;
                dateAxis.renderer.cellStartLocation = 0.3;
                dateAxis.renderer.cellEndLocation = 0.9;
                dateAxis.renderer.labels.template.rotation = 325;
                dateAxis.renderer.grid.template.disabled = true;
                //   dateAxis.dateFormatter = new am4core.DateFormatter();
                //   dateAxis.dateFormatter.dateFormat = "m/YY";
                // dateAxis.baseInterval = {
                //     "timeUnit": "month",
                //     "count": 1
                // }

                var valueAxis1 = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis1.title.text = "# of Cases";
                valueAxis1.renderer.grid.template.disabled = true;

                var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis2.title.text = "TAT < 10 (%age)";
                valueAxis2.renderer.opposite = true;
                valueAxis2.renderer.grid.template.disabled = true;

                // Create series
                function createSeries(field, name,color) {
                    var series = chart.series.push(new am4charts.ColumnSeries());
                    series.dataFields.valueY = field;
                    series.dataFields.categoryX  = "publish_month";
                    series.strokeWidth = 2;
                    series.minBulletDistance = 40;
                    series.name = name;
                    series.stroke = color;
                    series.fill = color
                    series.tooltipText = "{name}: [bold]{valueY}[/]";
                    series.columns.template.height = am4core.percent(100);
                    //        series.sequencedInterpolation = true;
                    series.numberFormatter.numberFormat = "#";
                    series.columns.template.width = am4core.percent(80);

                    var hs = series.columns.template.states.create("active");
                    hs.properties.fillOpacity = 1

                    // series.columns.template.events.on("hit", highlighColumn);

                }
                createSeries("num_of_cases", "Total Cases",am4core.color('#34444C'));
                createSeries("tat_less_ten", "Cases < 10 TAT",am4core.color('#019FEB'));

                var series3 = chart.series.push(new am4charts.LineSeries());
                series3.dataFields.valueY = "target_less_ten";
                series3.dataFields.categoryX  = "publish_month";
                series3.name = "Target Cases <10 TAT";
                series3.strokeWidth = 2;
                series3.tensionX = 0.7;
                series3.yAxis = valueAxis1;
                series3.stroke = am4core.color('#AA3631');
                series3.fill = am4core.color('#AA3631');
                series3.tooltipText = "{name}\n[bold font-size: 20]{valueY}[/]";
                series3.numberFormatter.numberFormat = "#.";

                var bullet3 = series3.bullets.push(new am4charts.CircleBullet());
                bullet3.circle.radius = 3;
                bullet3.circle.strokeWidth = 2;
                bullet3.circle.fill = am4core.color("#fff");

                var series4 = chart.series.push(new am4charts.LineSeries());
                series4.dataFields.valueY = "tat_less_ten_percent";
                series4.dataFields.categoryX  = "publish_month";
                series4.name = "Tat < 10";
                series4.strokeWidth = 2;
                series4.tensionX = 0.7;
                series4.yAxis = valueAxis2;
                series4.tooltipText = "{name}\n[bold font-size: 20]{valueY}%[/]";
                // series4.stroke = chart.colors.getIndex(0).lighten(0.5);
                series4.stroke = am4core.color('#262F4C');
                series4.fill = am4core.color('#262F4C');
                // series4.strokeDasharray = "3,3";
                series4.calculatePercent = true;

                var bullet4 = series4.bullets.push(new am4charts.CircleBullet());
                bullet4.circle.radius = 3;
                bullet4.circle.strokeWidth = 2;
                bullet4.circle.fill = am4core.color("#fff");

                // Add cursor
                chart.cursor = new am4charts.XYCursor();

                // Add legend
                chart.legend = new am4charts.Legend();
                chart.legend.position = "bottom";

                // Enable export
                chart.exporting.menu = new am4core.ExportMenu();

            }); // end am4core.ready()
        })();
    <?php } ?>
    });


    function set_opinion_id(opinion_id){
        document.getElementById('txt_opinion_id').value = opinion_id;
    }
    function set_opinion_id_rej(opinion_id){
        document.getElementById('rej_opinion_id').value = opinion_id;
        document.getElementById('ad_opinion_id').value = opinion_id;
    }

    function search_by_status(){
        document.getElementById('search_opinion_form').submit();
    }

    function search_by_type(){
        document.getElementById('search_dataset_type_form').submit();
    }

    function update_rej_reason(){
        var rej_reason_option = document.getElementById('reject_reason_opt').value;
        // alert(rej_reason_option);
        if(rej_reason_option == 'other'){
            document.getElementById("rej_other_reason").parentElement.classList.remove("hidden");
        }else{
            document.getElementById("rej_other_reason").parentElement.classList.add("hidden");
        }

    }

</script>