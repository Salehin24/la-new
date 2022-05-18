
<input type="hidden" id="yearmonthinstructor_earningschartdata"
    value="<?php echo $yearmonthinstructor_earningschartdata; ?>">
<input type="hidden" id="yearmonth_data" value="<?php echo $yearmonth_data; ?>,">


<div id="apexLineChart2"></div>
<!-- <script
    src="http://localhost/bdtask/leadacademy/application/modules/frontend/views/themes/default/assets/plugins/apexcharts/dist/apexcharts.min.js">
</script> -->
<script>
(function ($) {
    "use strict";
    var insearnings=$("#yearmonthinstructor_earningschartdata").val();
    var singleearnings = insearnings.substring(0, insearnings.length - 1);
    var earnings = singleearnings.split(",");
     
    var yearmonth_data = $("#yearmonth_data").val();      
    // alert(yearmonth_data);
    var singleearningsMonth = yearmonth_data.substring(0, yearmonth_data.length - 1);
    var yearMonth = singleearningsMonth.split(",");
   
    var apexCharts2 = {
        initialize: function () {
            this.apexLineChart();
        },
        apexLineChart: function () {
            var options = {
                chart: {
                    height: 320,
                    type: 'line',
                    fontFamily: 'Nunito Sans, sans-serif',
                    zoom: {
                        enabled: false
                    },
                },
                colors: ['#8663fe'],
                fill: {
                    type: "solid"
                },
                stroke: {
                    width: 4,
                    curve: 'smooth'
                },
                series: [{
                        name: "Earnings",
                        data: earnings //[0, 10, 5, 15, 10, 20, 15, 25, 20, 30, 25, 40]
                    }],
                xaxis: {
                    // categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    categories: yearMonth,
                }
            }
            var chart2 = new ApexCharts(
                    document.querySelector("#apexLineChart2"),
                    options
                    );

            chart2.render();
        }
    };
    // Initialize
    $(document).ready(function () {
        "use strict";
        apexCharts2.initialize();
    });
}(jQuery));

</script>