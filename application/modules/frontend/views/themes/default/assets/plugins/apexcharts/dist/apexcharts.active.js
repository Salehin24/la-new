(function ($) {
    "use strict";
      var insearnings=$("#instructor_earningschartdata").val();
      var singleearnings = insearnings.substring(0, insearnings.length - 1);
      var earnings = singleearnings.split(",");

      var allpreviousmonths = $("#allpreviousmonths").val();
      var single_months = allpreviousmonths.substring(0, allpreviousmonths.length - 1);
      var singlemonths = single_months.split(",");
    //   alert(allpreviousmonths);
    //   alert(single_months);
    //   alert(singlemonths);
    var apexCharts = {
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
                        data: earnings
                    }],
                xaxis: {
                    // categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    categories: singlemonths,
                }
            }
            var chart = new ApexCharts(
                    document.querySelector("#apexLineChart"),
                    options
                    );

            chart.render();
        }
    };
    // Initialize
    $(document).ready(function () {
        "use strict";
        apexCharts.initialize();
    });
}(jQuery));