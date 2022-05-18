(function ($) {
    "use strict";
    var mlabel=$("#earnings_monthlabel").val();
    var splitlabel = mlabel.substring(0, mlabel.length - 1);
    var labels = splitlabel.split(",");

    var mdata=$("#monthly_chartdata").val();
    var splitdata = mdata.substring(0, mdata.length - 1);
    var chartdata = splitdata.split(",");
    // alert(chartdata);
    // alert(labels);
    var apexCharts = {
        initialize: function () {
            this.apexMixedChart();
        },
        apexMixedChart: function () {
            var options = {
                colors: ['#ebe5ff'],
                chart: {
                    height: 345,
                    type: 'line',
                },
                series: [{
                        name: 'Earnings',
                        type: 'column',
                        data: chartdata
                    }],
                stroke: {
                    width: [0, 3],
                    curve: 'smooth'
                },
                title: {
                    text: 'Earning Statement'
                },
                // labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                labels: labels,
                xaxis: {
                    // type: 'datetime',
                    type: 'text'
                }

            }
            var chart = new ApexCharts(
                    document.querySelector("#apexMixedChart-earning"),
                    options
                    );

            chart.render();
        }
    };

    // ===================== its for withdraw ========================
    var withdraw_monthdata=$("#withdrawearnings_months").val();
    var withdraw_splitdata = withdraw_monthdata.substring(0, withdraw_monthdata.length - 1);
    var withdraw_chartdata = withdraw_splitdata.split(",");

    var apexCharts_withdraw = {
        initialize: function () {
            this.apexMixedChart();
        },
        apexMixedChart: function () {
            var options = {
                colors: ['#ebe5ff'],
                chart: {
                    height: 345,
                    type: 'line',
                },
                series: [{
                        name: 'Earnings',
                        type: 'column',
                        // data: [440, 505, 414, 671, 227, 413, 440, 505, 414, 671, 227, 413]
                        data: withdraw_chartdata
                    }],
                stroke: {
                    width: [0, 3],
                    curve: 'smooth'
                },
                title: {
                    text: 'Earning Statement'
                },
                //  labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],              
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                xaxis: {
                    type: 'text'
                }

            }
            var chart = new ApexCharts(
                    document.querySelector("#apexMixedChart-withdraw"),
                    options
                    );

            chart.render();
        }
    };


    // Initialize
    $(document).ready(function () {
        "use strict";
        apexCharts.initialize();
        apexCharts_withdraw.initialize();
    });
}(jQuery));