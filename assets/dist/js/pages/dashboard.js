$(document).ready(function () {

    "use strict"; // Start of use strict

    //Card table
    $('.card-table').DataTable({
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false
    });

    //Tooltip
    $('[data-toggle="tooltip"]').tooltip();

    //Sparklines Charts
    $(".sparkline1").sparkline([34, 43, 43, 35, 44, 32, 44, 52, 25], {
        type: 'line',
        lineColor: '#37a000',
        fillColor: '#37a000',
        width: '150',
        height: '20'
    });
    $(".sparkline2").sparkline([5, 6, 7, 2, 0, -4, -2, 4, 5, 6, 3, 2, 4, -6, -5, -4, 6, 5, 4, 3], {
        type: 'bar',
        barColor: '#37a000',
        negBarColor: '#c6c6c6',
        width: '150',
        height: '20'
    });
    $(".sparkline3").sparkline([10, 2], {
        type: 'pie',
        sliceColors: ['#37a000', '#ffffff'],
        width: '150',
        height: '20'
    });
    $(".sparkline4").sparkline([34, 43, 43, 35, 44, 32, 15, 22, 46, 33, 86, 54, 73, 53, 12, 53, 23, 65, 23, 63, 53, 42, 34, 56, 76, 15, 54, 23, 44], {
        type: 'line',
        lineColor: '#37a000',
        fillColor: '#37a000',
        width: '150',
        height: '20'
    });
    $(".sparkline5").sparkline([1, 1, 0, 1, -1, -1, 1, -1, 0, 0, 1, 1], {
        type: 'tristate',
        posBarColor: '#37a000',
        negBarColor: '#ffffff',
        width: '150',
        height: '20'
    });
    $(".sparkline6").sparkline([4, 6, 7, 7, 4, 3, 2, 1, 4, 4, 5, 6, 3, 4, 5, 8, 7, 6, 9, 3, 2, 4, 1, 5, 6, 4, 3, 7], {
        type: 'discrete',
        lineColor: '#37a000',
        width: '150',
        height: '20'
    });


//   ============== its for start dashabor js =================
    var user_type = $("#user_type").val();
    var totalEarning = $("#totalEarning").val();
    var totalFacultyearning = $("#totalFacultyearning").val();
    var revenue = $("#revenue").val();

    if (user_type == 1) {
        //    ================ its for pie chart ============
        var data8 = [
            {label: "Total Earning (" + totalEarning + ")", data: totalEarning, color: "#1b5fa0"},
            {label: "Instructor Earning (" + totalFacultyearning + ")", data: totalFacultyearning, color: "#389861"},
            {label: "Revenue (" + revenue + ")", data: revenue, color: "#16BBCF"},
        ];
        var chartUsersOptions8 = {
            series: {
                pie: {
                    show: true
                }
            },
            grid: {
                hoverable: true
            },
            tooltip: true,
            tooltipOpts: {
                content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
                shifts: {
                    x: 20,
                    y: 0
                },
                defaultTheme: false
            }
        };
        $.plot($("#flotChart8"), data8, chartUsersOptions8);

//=============== its for single bar chart ==========
        var lastYearMonths = $("#lastYearMonths").val();
        var monthly_sales_amount = $("#monthly_sales_amount").val();

        var lastYearMonths = $("#lastYearMonths").val();
        var str2 = lastYearMonths.substring(0, lastYearMonths.length - 1);
        var res = str2.split(',');
        var totalsale = $("#monthly_sales_amount").val();

        var str3 = totalsale.substring(0, totalsale.length - 2);
        var res3 = str3.split(",");
        var salesChartCanvas = document.getElementById('singelBarChart').getContext('2d');
        var salesChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [
                {
                    label: 'Last Year Month',
                    backgroundColor: '#F7DC6F',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [0, 0]
                },
                {
                    label: 'Sale',
                    backgroundColor: '#1b5fa0',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: true,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [0, 0]
                },
            ]
        }

        salesChartData.labels = res;
        salesChartData.datasets[1].data = res3;


        var salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: true
            },
            scales: {
                xAxes: [{
                        gridLines: {
                            display: true,
                        }
                    }],
                yAxes: [{
                        gridLines: {
                            display: true,
                        }
                    }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        var salesChart = new Chart(salesChartCanvas, {
            type: 'bar',
            data: salesChartData,
            options: salesChartOptions
        });
//        ============== close bar chart ============


    }
    //    ================ its for course overview pie chart ============
    var active_course = $("#active_course").val();
    var popular_course = $("#popular_course").val();
    var data8 = [
        {label: "Active Course (" + active_course + ")", data: active_course, color: "#1b5fa0"},
        {label: "Popular Course (" + popular_course + ")", data: popular_course, color: "#16BBCF"},
    ];
    var chartUsersOptions8 = {
        series: {
            pie: {
                show: true
            }
        },
        grid: {
            hoverable: true
        },
        tooltip: true,
        tooltipOpts: {
            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
            shifts: {
                x: 20,
                y: 0
            },
            defaultTheme: false
        }
    };
    $.plot($("#courseOverview"), data8, chartUsersOptions8);






});
