<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--<script src="https://code.highcharts.com/highcharts.js"></script>-->
<!--<script src="https://code.highcharts.com/modules/exporting.js"></script>-->
<!--<script src="https://code.highcharts.com/modules/export-data.js"></script>-->
<!--<script src="https://code.highcharts.com/modules/accessibility.js"></script>-->

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
            <input type="hidden" id="calendar_type" value="<?php echo $calendar_type;?>">
            <input type="hidden" id="post_dates" value="<?php echo $post_dates;?>">
            <input type="hidden" id="post_category" value="<?php echo implode(",",$post_category);?>">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-filterhold">
                    <?php
                    $attributes = array('method' => 'POST', 'id'=>'search_dataset_type_form');
                    echo form_open('doctor/record_cases', $attributes); ?>
                    <ul class="tg-filters record-list-filters">
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors nobefore search_li" style="padding: 0; max-width:220px;">
                            <div class="input-group">
                                <select id="new_select" name="sr_dataset_type[]" multiple="multiple" class="form-control">
                                        <option value="M80903" <?php echo (in_array("M80903",$post_category)?"selected":"")?>>M80903 BCC Cancer</option>
                                    <optgroup label="All">
                                        <option value="P1100" <?php echo (in_array("P1100",$post_category)?"selected":"")?>>P1100 Ex</option>
                                        <option value="P1140" <?php echo (in_array("P1140",$post_category)?"selected":"")?>>P1140 Biopsy</option>
                                        <option value="P1154" <?php echo (in_array("P1154",$post_category)?"selected":"")?>>P1154 C&C</option>
                                    </optgroup>
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

    <div class="row" id="chart_view">
        <div class="col-md-12 form-group">
            <div class="card">
                <div class="card-body" style="height: 450px;">
                    <h3>Cases</h3>
                <div id="tats_graph" style="height: 95%"></div>
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
                            <th>Snomed code p</th>
                            <th>Snomed code m</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
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

<script>
    $(document).ready(function () {
        $(function() {

            var start = moment().subtract(6, 'days');
            var end = moment();

            <?php if($_SERVER['REQUEST_METHOD']=="POST"){
                $xpplodedDates = explode(" - ",$post_dates)
                ?>
            var start = moment('<?php echo $xpplodedDates[0]?>');
            var end = moment('<?php echo $xpplodedDates[1]?>');
            <?php } ?>

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
        var tbl_month_detail = $('#month_wise_detail').DataTable({
            pageLength : 10,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Show All']]
        });
        <?php if($_SERVER['REQUEST_METHOD']=="POST"){ ?>

        (function (){
            am4core.ready(function() {

                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end

                // Create chart instance
                var chart = am4core.create("tats_graph", am4charts.XYChart);
                // chart.numberFormatter.numberFormat = "#";

                // Add data
                chart.data = <?php echo json_encode($dataset_data, JSON_NUMERIC_CHECK ); ?>

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
                valueAxis2.title.text = "Percentage";
                valueAxis2.renderer.opposite = true;
                valueAxis2.renderer.grid.template.disabled = true;



                // Create series
                function createSeries(field, name) {
                    var series = chart.series.push(new am4charts.ColumnSeries());
                    series.dataFields.valueY = field;
                    series.dataFields.categoryX  = "publish_month";
                    series.strokeWidth = 2;
                    series.minBulletDistance = 40;
                    series.name = name;
                    // series.stroke = color;
                    // series.fill = color
                    series.tooltipText = "{name}: [bold]{valueY}[/]";
                    series.columns.template.height = am4core.percent(100);
                    //        series.sequencedInterpolation = true;
                    series.numberFormatter.numberFormat = "#";
                    series.columns.template.width = am4core.percent(80);

                    var hs = series.columns.template.states.create("active");
                    hs.properties.fillOpacity = 1

                    // series.columns.template.events.on("hit", highlighColumn);

                }
                function createBullets(field,name,valueAxis) {
                    var series4 = chart.series.push(new am4charts.LineSeries());
                    series4.dataFields.valueY = field;
                    series4.dataFields.categoryX  = "publish_month";
                    series4.name = name;
                    series4.strokeWidth = 2;
                    series4.tensionX = 0.7;
                    series4.yAxis = valueAxis;
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

                }
                <?php $counter = 1;foreach ($dataset_types as $datatypes=>$dataValue){?>
                createSeries("<?php echo "category_".$counter;?>", "<?php echo $dataValue;?>");
                <?php $counter++;}?>
                // createSeries("num_of_cases", "Total Cases",am4core.color('#34444C'));
                // createSeries("tat_less_ten", "Cases < 10 TAT",am4core.color('#019FEB'));



                <?php $counter = 1;foreach ($dataset_types as $datatypes=>$dataValue){?>
                createBullets("<?php echo "percentage_".$counter;?>", "<?php echo "Percentage ".$dataValue;?>",valueAxis2);
                <?php $counter++;}?>

// Set cell size in pixels




               // var series3 = chart.series.push(new am4charts.LineSeries());
               // series3.dataFields.valueY = "target_less_ten";
               // series3.dataFields.categoryX  = "publish_month";
               // series3.name = "Target Cases <10 TAT";
               // series3.strokeWidth = 2;
               // series3.tensionX = 0.7;
               // series3.yAxis = valueAxis1;
               // series3.stroke = am4core.color('#AA3631');
               // series3.fill = am4core.color('#AA3631');
               // series3.tooltipText = "{name}\n[bold font-size: 20]{valueY}[/]";
               // series3.numberFormatter.numberFormat = "#.";
               //
               // var bullet3 = series3.bullets.push(new am4charts.CircleBullet());
               // bullet3.circle.radius = 3;
               // bullet3.circle.strokeWidth = 2;
               // bullet3.circle.fill = am4core.color("#fff");
               //
               // var series4 = chart.series.push(new am4charts.LineSeries());
               // series4.dataFields.valueY = "tat_less_ten_percent";
               // series4.dataFields.categoryX  = "publish_month";
               // series4.name = "Tat < 10";
               // series4.strokeWidth = 2;
               // series4.tensionX = 0.7;
               // series4.yAxis = valueAxis2;
               // series4.tooltipText = "{name}\n[bold font-size: 20]{valueY}%[/]";
               // // series4.stroke = chart.colors.getIndex(0).lighten(0.5);
               // series4.stroke = am4core.color('#262F4C');
               // series4.fill = am4core.color('#262F4C');
               // // series4.strokeDasharray = "3,3";
               // series4.calculatePercent = true;
               //
               //  var bullet4 = series4.bullets.push(new am4charts.CircleBullet());
               //  bullet4.circle.radius = 3;
               //  bullet4.circle.strokeWidth = 2;
               //  bullet4.circle.fill = am4core.color("#fff");

// Add events
                dateAxis.renderer.labels.template.events.on("hit", highlighColumn);
                dateAxis.renderer.labels.template.cursorOverStyle = am4core.MouseCursorStyle.pointer;

                function highlighColumn(ev) {
                    const base_url = `<?php echo base_url() ?>`;
                    // CSRF Token
                    var csrf_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
                    var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
                    // console.log(ev.target.dataItem.category);
                    var calendar_type = $("#calendar_type").val();
                    var selected_category = ev.target.dataItem.category;
                    var post_dates = $("#post_dates").val();
                    var post_category = $("#post_category").val();
                    // console.log(dataArray);
                    $.ajax({
                        url:base_url+"doctor/chart_report_detail",
                        method:"POST",
                        data: { [csrf_name]: csrf_hash,
                            calendar_type:calendar_type,
                            selected_category:selected_category,
                            post_dates:post_dates,
                            post_category:post_category,
                        },
                        dataType: "json",
                        success:function(data)
                        {
                            // console.log(data); return false;
                            if (data.type === 'error') {
                                alert(data.msg);
                            }else{
                                // console.log(data.data);
                                var final_result = data.data;

                                tbl_month_detail.clear().draw();
                                var i=1;
                                // Getting data from Data Object
                                Object.keys(final_result).forEach(function (key, property) {
                                    var g_publish_date = final_result[key].publish_date;
                                    var g_serial_number = final_result[key].serial_number;
                                    var g_pci_number = final_result[key].pci_number;
                                    var g_patient_name = final_result[key].patient_name;
                                    var g_lab_number = final_result[key].lab_number;
                                    var g_nhs_number = final_result[key].nhs_number;
                                    var g_dob = final_result[key].dob;
                                    var g_age = final_result[key].age;
                                    var g_gender = final_result[key].gender;
                                    var g_snomencode_p = final_result[key].specimen_snomed_p;
                                    var g_snomencode_m = final_result[key].specimen_snomed_m;
                                    tbl_month_detail.row.add( [
                                        i,
                                        g_publish_date,
                                        g_serial_number,
                                        g_pci_number,
                                        g_patient_name,
                                        g_lab_number,
                                        g_nhs_number,
                                        g_dob,
                                        g_age,
                                        g_gender,
                                        g_snomencode_p,
                                        g_snomencode_m
                                    ] ).draw( false );
                                    // tbl_month_detail.row.tooltip({
                                    //   placement : '',
                                    //   html : true
                                    // });
                                    i++;

                                });

                            }
                        }
                    });
                }

// Add cursor
                chart.cursor = new am4charts.XYCursor();

// Add legend
                chart.legend = new am4charts.Legend();
                chart.legend.position = "bottom";
// Enable export
                chart.exporting.menu = new am4core.ExportMenu();

// Add scrollbar
//           chart.scrollbarX = new am4charts.XYChartScrollbar();
//           chart.scrollbarX.series.push(series1);
//           chart.scrollbarX.series.push(series3);
//           chart.scrollbarX.parent = chart.bottomAxesContainer;

            }); // end am4core.ready()
        })();
    <?php } ?>
    });

</script>

<link rel="stylesheet" type="text/css" href="https://www.jqueryscript.net/demo/jQuery-Multiple-Select-Plugin-For-Bootstrap-Bootstrap-Multiselect/css/bootstrap-multiselect.css" />
<script type="text/javascript" src="https://www.jqueryscript.net/demo/jQuery-Multiple-Select-Plugin-For-Bootstrap-Bootstrap-Multiselect/js/bootstrap-multiselect.js"></script>
<script>
    $('#new_select').multiselect();

</script>