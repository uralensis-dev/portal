$(".list_view_btn").click(function () {
    $(".list_view_btn").hide();
    $(".chart_view_btn").show();
    $("#chart_view").hide();
    $("#list_view").show();

});
$(".chart_view_btn").click(function () {
    $(".chart_view_btn").hide();
    $(".list_view_btn").show();
    $("#chart_view").show();
    $("#list_view").hide();

});

$('.doctors_tat_table').DataTable({
    pageLength : 10,
    lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Show All']]
});

var tbl_month_detail = $('#month_wise_detail').DataTable({
    pageLength : 10,
    lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Show All']]
});


//################################## Twelve Month Bar Chart START ################################
(function (){
    am4core.ready(function() {

// Themes begin
        am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
        var chart = am4core.create("tats_graph", am4charts.XYChart);

// Add data
        chart.data = twelve_month_tat;

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
    dateAxis.renderer.minGridDistance = 30;
    dateAxis.renderer.cellStartLocation = 0.2;
    dateAxis.renderer.cellEndLocation = 0.7;
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
            series.numberFormatter.numberFormat = "#.0a";
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
        series3.name = "Target";
        series3.strokeWidth = 2;
        series3.tensionX = 0.7;
        series3.yAxis = valueAxis1;
        series3.stroke = am4core.color('#AA3631');
        series3.fill = am4core.color('#AA3631');
        series3.tooltipText = "{name}\n[bold font-size: 20]{valueY}[/]";

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

// Add events
        dateAxis.renderer.labels.template.events.on("hit", highlighColumn);
        dateAxis.renderer.labels.template.cursorOverStyle = am4core.MouseCursorStyle.pointer;

        function highlighColumn(ev) {
            // console.log(ev.target.dataItem.category);
            $.ajax({
                url:base_url+"index.php/Cims/month_report_detail",
                method:"POST",
                data: { [csrfName]: csrfHash,"report_month":ev.target.dataItem.category},
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
                            var g_clinician = final_result[key].clinician;
                            var g_date_taken = final_result[key].date_taken;
                            var g_date_received_by_lab = final_result[key].date_received_by_lab;
                            var g_date_rec_by_doctor = final_result[key].date_rec_by_doctor;
                            var g_doctor_name = final_result[key].doctor_name;
                            var g_tat_days = final_result[key].tat_days;
                            var g_tat_col= "badge-info";
                            if(g_tat_days>=20 && g_tat_days<30){
                                g_tat_col= "badge-warning";
                            }
                            if(g_tat_days>=30){
                                g_tat_col= "badge-danger";
                            }
                            var tat_days_styled= "<a><span class='badge "+g_tat_col+" dash_bade'>"+final_result[key].tat_days+"</a>";

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
                                g_clinician,
                                g_date_taken,
                                g_date_received_by_lab,
                                g_date_rec_by_doctor,
                                g_doctor_name,
                                tat_days_styled
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
//################################## Twelve Month Bar Chart END ##################################

//################################## Last Month Gauge START ######################################
am4core.ready(function() {

// Themes begin
        am4core.useTheme(am4themes_animated);
// Themes end

// create chart
        let chart = am4core.create("last_month_TAT", am4charts.GaugeChart);
        chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect

        chart.data = avg_lm_tat;
        // alert(chart.data['avg_tat']);

        // Chart Title
    let subtitle = chart.titles.create();
    subtitle.text = chart.data['last_month'];
        subtitle.fontSize = 12;
        subtitle.align = "center"
        subtitle.marginBottom = 10;

        // Chart Title
        let title = chart.titles.create();
        title.text = "Average TAT Last Month";
        title.fontSize = 20;
        title.align = "left"
        title.marginBottom = 5;

        chart.innerRadius = -15;

        let axis = chart.xAxes.push(new am4charts.ValueAxis());
        axis.min = 0;
        axis.max = 20;
        axis.strictMinMax = true;
        axis.renderer.grid.template.stroke = new am4core.InterfaceColorSet().getFor("background");
        axis.renderer.grid.template.strokeOpacity = 0.8;

        let colorSet = new am4core.ColorSet();

        let gradient = new am4core.LinearGradient();
        gradient.stops.push({color:am4core.color("#018100")});
        gradient.stops.push({color:am4core.color("#45A200")});
        gradient.stops.push({color:am4core.color("#97CB00")});
        gradient.rotation = 270;

        let range0 = axis.axisRanges.create();
        range0.value = 0;
        range0.endValue = 7;
        range0.axisFill.fillOpacity = 1;
        range0.axisFill.fill = gradient;
        range0.axisFill.zIndex = - 1;

        let gradient1 = new am4core.LinearGradient();
        gradient1.stops.push({color:am4core.color("#DFEF00")});
        gradient1.stops.push({color:am4core.color("#FFFF00")});
        gradient1.stops.push({color:am4core.color("#FFEB00")});
        gradient1.stops.push({color:am4core.color("#FFB200")});
        gradient1.rotation = 360;

        let range1 = axis.axisRanges.create();
        range1.value = 7;
        range1.endValue = 14;
        range1.axisFill.fillOpacity = 1;
        range1.axisFill.fill = gradient1;
        range1.axisFill.zIndex = -1;

        let gradient2 = new am4core.LinearGradient();
        gradient2.stops.push({color:am4core.color("#FFB200")});
        gradient2.stops.push({color:am4core.color("#FF8900")});
        gradient2.stops.push({color:am4core.color("#FF2800")});
        gradient2.stops.push({color:am4core.color("#FF0000")});
        gradient2.rotation = 90;

        let range2 = axis.axisRanges.create();
        range2.value = 14;
        range2.endValue = 20;
        range2.axisFill.fillOpacity = 1;
        range2.axisFill.fill = gradient2;
        range2.axisFill.zIndex = -1;

        let hand = chart.hands.push(new am4charts.ClockHand());
        hand.pin.disabled = true;
        hand.innerRadius = am4core.percent(40);
        hand.startWidth = 5;
        hand.endWidth = 0;
        hand.radius = am4core.percent(90);
        hand.zIndex = 100;
        let hand_val = (chart.data['avg_tat']>20?20:chart.data['avg_tat']);
        hand.showValue(hand_val, 1000, am4core.ease.cubicOut);


        let labelList = new am4core.ListTemplate(new am4core.Label());
        labelList.template.isMeasured = false;
        labelList.template.background.strokeWidth = 2;
        labelList.template.fontSize = 12;
// labelList.template.padding(2, 1, 2, 1);
        labelList.template.padding(0, 0, 0, 0);
// labelList.template.fontWeight = "bold";
        labelList.template.y = am4core.percent(40);
        labelList.template.horizontalCenter = "middle";

        let TitleLabel = labelList.create();
        TitleLabel.parent = chart.chartContainer;
        TitleLabel.x = am4core.percent(50);
        TitleLabel.y = am4core.percent(45);
// TitleLabel.background.stroke = am4core.color(budget_ytd_color);
        TitleLabel.fill = am4core.color("#000000");
        TitleLabel.text = "Average TAT";
        TitleLabel.textAlign = "middle";
        TitleLabel.zIndex = -1;

        let ValueLabel = labelList.create();
        ValueLabel.parent = chart.chartContainer;
        ValueLabel.x = am4core.percent(50);
        ValueLabel.y = am4core.percent(55);
// ValueLabel.background.stroke = am4core.color(budget_ytd_color);
        ValueLabel.fill = am4core.color("#000000");
        ValueLabel.text = chart.data['avg_tat'];
        ValueLabel.textAlign = "middle";
        ValueLabel.zIndex = -1;
        ValueLabel.fontSize = 40;

}); // end am4core.ready()
//################################## Last Month Gauge END ########################################


//################################## Last 3 Months Gauge START ###################################
am4core.ready(function() {

// Themes begin
        am4core.useTheme(am4themes_animated);
// Themes end

// create chart
        let chart = am4core.create("last_3months_TAT", am4charts.GaugeChart);
        chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect

        chart.data = avg_l3m_tat;
        // alert(chart.data['avg_tat']);

        // Chart SubTitle
    let subtitle = chart.titles.create();
    subtitle.text = chart.data['curr_month']+" - "+chart.data['last_month'];
            subtitle.fontSize = 12;
            subtitle.align = "center"
            subtitle.marginBottom = 10;

            // Chart Title
            let title = chart.titles.create();
            title.text = "Average TAT Last 3 Months";
            title.fontSize = 20;
            title.align = "left"
            title.marginBottom = 5;

            chart.innerRadius = -15;

            let axis = chart.xAxes.push(new am4charts.ValueAxis());
            axis.min = 0;
            axis.max = 20;
            axis.strictMinMax = true;
            axis.renderer.grid.template.stroke = new am4core.InterfaceColorSet().getFor("background");
            axis.renderer.grid.template.strokeOpacity = 0.8;

            let colorSet = new am4core.ColorSet();

            let gradient = new am4core.LinearGradient();
            gradient.stops.push({color:am4core.color("#018100")});
            gradient.stops.push({color:am4core.color("#45A200")});
            gradient.stops.push({color:am4core.color("#97CB00")});
            gradient.rotation = 270;

            let range0 = axis.axisRanges.create();
            range0.value = 0;
            range0.endValue = 7;
            range0.axisFill.fillOpacity = 1;
            range0.axisFill.fill = gradient;
            range0.axisFill.zIndex = - 1;

            let gradient1 = new am4core.LinearGradient();
            gradient1.stops.push({color:am4core.color("#DFEF00")});
            gradient1.stops.push({color:am4core.color("#FFFF00")});
            gradient1.stops.push({color:am4core.color("#FFEB00")});
            gradient1.stops.push({color:am4core.color("#FFB200")});
            gradient1.rotation = 360;

            let range1 = axis.axisRanges.create();
            range1.value = 7;
            range1.endValue = 14;
            range1.axisFill.fillOpacity = 1;
            range1.axisFill.fill = gradient1;
            range1.axisFill.zIndex = -1;

            let gradient2 = new am4core.LinearGradient();
            gradient2.stops.push({color:am4core.color("#FFB200")});
            gradient2.stops.push({color:am4core.color("#FF8900")});
            gradient2.stops.push({color:am4core.color("#FF2800")});
            gradient2.stops.push({color:am4core.color("#FF0000")});
            gradient2.rotation = 90;

            let range2 = axis.axisRanges.create();
            range2.value = 14;
            range2.endValue = 20;
            range2.axisFill.fillOpacity = 1;
            range2.axisFill.fill = gradient2;
            range2.axisFill.zIndex = -1;

            let hand = chart.hands.push(new am4charts.ClockHand());
            hand.pin.disabled = true;
            hand.innerRadius = am4core.percent(40);
            hand.startWidth = 5;
            hand.endWidth = 0;
            hand.radius = am4core.percent(90);
            hand.zIndex = 100;
            let hand_val = (chart.data['avg_tat']>20?20:chart.data['avg_tat']);
            hand.showValue(hand_val, 1000, am4core.ease.cubicOut);


            let labelList = new am4core.ListTemplate(new am4core.Label());
            labelList.template.isMeasured = false;
            labelList.template.background.strokeWidth = 2;
            labelList.template.fontSize = 12;
// labelList.template.padding(2, 1, 2, 1);
            labelList.template.padding(0, 0, 0, 0);
// labelList.template.fontWeight = "bold";
            labelList.template.y = am4core.percent(40);
            labelList.template.horizontalCenter = "middle";

            let TitleLabel = labelList.create();
            TitleLabel.parent = chart.chartContainer;
            TitleLabel.x = am4core.percent(50);
            TitleLabel.y = am4core.percent(45);
// TitleLabel.background.stroke = am4core.color(budget_ytd_color);
            TitleLabel.fill = am4core.color("#000000");
            TitleLabel.text = "Average TAT";
            TitleLabel.textAlign = "middle";
            TitleLabel.zIndex = -1;

            let ValueLabel = labelList.create();
            ValueLabel.parent = chart.chartContainer;
            ValueLabel.x = am4core.percent(50);
            ValueLabel.y = am4core.percent(55);
// ValueLabel.background.stroke = am4core.color(budget_ytd_color);
            ValueLabel.fill = am4core.color("#000000");
            ValueLabel.text = chart.data['avg_tat'];
            ValueLabel.textAlign = "middle";
            ValueLabel.zIndex = -1;
            ValueLabel.fontSize = 40;

}); // end am4core.ready()
//################################## Last 3 Months Gauge END #####################################

//################################## Last 6 Months Gauge START ###################################
am4core.ready(function() {

// Themes begin
        am4core.useTheme(am4themes_animated);
// Themes end

// create chart
        let chart = am4core.create("last_6months_TAT", am4charts.GaugeChart);
        chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect

        chart.data = avg_l6m_tat;

        // Chart SubTitle
    let subtitle = chart.titles.create();
    subtitle.text = chart.data['curr_month']+" - "+chart.data['last_month'];
            subtitle.fontSize = 12;
            subtitle.align = "center"
            subtitle.marginBottom = 10;

            // Chart Title
            let title = chart.titles.create();
            title.text = "Average TAT Last 6 Months";
            title.fontSize = 20;
            title.align = "left"
            title.marginBottom = 5;

            chart.innerRadius = -15;

            let axis = chart.xAxes.push(new am4charts.ValueAxis());
            axis.min = 0;
            axis.max = 20;
            axis.strictMinMax = true;
            axis.renderer.grid.template.stroke = new am4core.InterfaceColorSet().getFor("background");
            axis.renderer.grid.template.strokeOpacity = 0.8;

            let colorSet = new am4core.ColorSet();

            let gradient = new am4core.LinearGradient();
            gradient.stops.push({color:am4core.color("#018100")});
            gradient.stops.push({color:am4core.color("#45A200")});
            gradient.stops.push({color:am4core.color("#97CB00")});
            gradient.rotation = 270;

            let range0 = axis.axisRanges.create();
            range0.value = 0;
            range0.endValue = 7;
            range0.axisFill.fillOpacity = 1;
            range0.axisFill.fill = gradient;
            range0.axisFill.zIndex = - 1;

            let gradient1 = new am4core.LinearGradient();
            gradient1.stops.push({color:am4core.color("#DFEF00")});
            gradient1.stops.push({color:am4core.color("#FFFF00")});
            gradient1.stops.push({color:am4core.color("#FFEB00")});
            gradient1.stops.push({color:am4core.color("#FFB200")});
            gradient1.rotation = 360;

            let range1 = axis.axisRanges.create();
            range1.value = 7;
            range1.endValue = 14;
            range1.axisFill.fillOpacity = 1;
            range1.axisFill.fill = gradient1;
            range1.axisFill.zIndex = -1;

            let gradient2 = new am4core.LinearGradient();
            gradient2.stops.push({color:am4core.color("#FFB200")});
            gradient2.stops.push({color:am4core.color("#FF8900")});
            gradient2.stops.push({color:am4core.color("#FF2800")});
            gradient2.stops.push({color:am4core.color("#FF0000")});
            gradient2.rotation = 90;

            let range2 = axis.axisRanges.create();
            range2.value = 14;
            range2.endValue = 20;
            range2.axisFill.fillOpacity = 1;
            range2.axisFill.fill = gradient2;
            range2.axisFill.zIndex = -1;

            let hand = chart.hands.push(new am4charts.ClockHand());
            hand.pin.disabled = true;
            hand.innerRadius = am4core.percent(40);
            hand.startWidth = 5;
            hand.endWidth = 0;
            hand.radius = am4core.percent(90);
            hand.zIndex = 100;
            let hand_val = (chart.data['avg_tat']>20?20:chart.data['avg_tat']);
            hand.showValue(hand_val, 1000, am4core.ease.cubicOut);


            let labelList = new am4core.ListTemplate(new am4core.Label());
            labelList.template.isMeasured = false;
            labelList.template.background.strokeWidth = 2;
            labelList.template.fontSize = 12;
// labelList.template.padding(2, 1, 2, 1);
            labelList.template.padding(0, 0, 0, 0);
// labelList.template.fontWeight = "bold";
            labelList.template.y = am4core.percent(40);
            labelList.template.horizontalCenter = "middle";

            let TitleLabel = labelList.create();
            TitleLabel.parent = chart.chartContainer;
            TitleLabel.x = am4core.percent(50);
            TitleLabel.y = am4core.percent(45);
// TitleLabel.background.stroke = am4core.color(budget_ytd_color);
            TitleLabel.fill = am4core.color("#000000");
            TitleLabel.text = "Average TAT";
            TitleLabel.textAlign = "middle";
            TitleLabel.zIndex = -1;

            let ValueLabel = labelList.create();
            ValueLabel.parent = chart.chartContainer;
            ValueLabel.x = am4core.percent(50);
            ValueLabel.y = am4core.percent(55);
// ValueLabel.background.stroke = am4core.color(budget_ytd_color);
            ValueLabel.fill = am4core.color("#000000");
            ValueLabel.text = chart.data['avg_tat'];
            ValueLabel.textAlign = "middle";
            ValueLabel.zIndex = -1;
            ValueLabel.fontSize = 40;

}); // end am4core.ready()
//################################## Last 6 Months Gauge START ###################################