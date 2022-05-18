(function ($) {
    "use strict";
    $(document).ready(function () {
// ======== itsf for expense item list datatables ==============
        var base_url = $("#base_url").val();
        var CSRF_TOKEN = $('#CSRF_TOKEN').val();
        var enterprise_shortname = $('#enterprise_shortname').val();
        var table = $("#currencylist").DataTable({
            
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            order: [],
            paging: true,
            "searching": true,
            "processing": true,
            "serverSide": true,
            columnDefs: [
                {
                    bSortable: false,
                    aTargets: [0],
                },
                {
                    bSortable: false,
                    targets: [2, 3],
                    className: "text-left",
                },
                ],   
            "ajax": {
                "url": base_url + enterprise_shortname + "/currency-list",
                "type": "POST",
                data: {
                    'csrf_test_name': CSRF_TOKEN,
                },
            }
        });
    })
}(jQuery));
