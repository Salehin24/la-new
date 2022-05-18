(function ($) {
    "use strict"; // Start of use strict
    //Card table
    $('.card-table').DataTable({
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false
    });

    var tableBootstrap4Style = {
        initialize: function () {
            this.bootstrap4Styling();
            this.bootstrap4Modal();
            this.print();
        },
        bootstrap4Styling: function () {
            $('.bootstrap4-styling').DataTable();
        },
        bootstrap4Modal: function () {
            $('.bootstrap4-modal').DataTable({
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function (row) {
                                var data = row.data();
                                return 'Details for ' + data[0] + ' ' + data[1];
                            }
                        }),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                            tableClass: 'table'
                        })
                    }
                }
            });
        },
        print: function () {
            var table = $('#example').DataTable({
                lengthChange: true,
                // paginate: false,
                // "info": false,
                /*call here length*/
                "dom": "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>tp",
                buttons: [
                    {
                        extend: "copy",
                        className: "btn-sm",
                        className: "btn-success",
                    },
                    {
                        extend: "csv",
                        title: "ExampleFile",
                        className: "btn-sm",
                        className: "btn-success",
                    },
                    {
                        extend: "excel",
                        title: "ExampleFile",
                        className: "btn-sm",
                        title: "exportTitle",
                        className: "btn-success",
                    },
                    {
                        extend: 'print',
                        title: 'ExampleFile',
                        className: 'btn-sm',
                        title: 'exportTitle',
                        className: 'btn-success'
                    },
                    {
                        extend: 'pdf',
                        title: 'ExampleFile',
                        className: 'btn-sm',
                        title: 'exportTitle',
                        className: 'btn-success'
                    }
                ],

            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');
        }

    };
    // Initialize
    $(document).ready(function () {
        "use strict"; // Start of use strict
        tableBootstrap4Style.initialize();
    });

}(jQuery));