//===========save validation=================
"use strict";
$("body").on("click", "#librarysave", function() {
    var productmode = $("#productmode").val();
    if (productmode == "demo") {
        toastrWarningMsg("It is disabled for demo mode!");
        return false;
    }
    var name = $("#names").val();
    var category_id = $("#category_ids").val();
    var faculty_id = $("#faculty_ids").val();

    var is_free = $("#is_frees").val();
    var price = $("#prices").val();
    var source = $("#source").val();
    var level = $("#level").val();
    var picture = $("#picture").val();
    var content_providers = $("#content_providers").val();
    if (name == "") {
        toastrErrorMsg("Name field must be required");
        return false;
    }
    if (faculty_id == "") {
        toastrErrorMsg("Faculty field must be required");
        return false;
    }
    if (category_id == "") {
        toastrErrorMsg("Category field must be required");
        return false;
    }
    if (level == "") {
        toastrErrorMsg("Level field must be required");
        return false;
    }
    if (content_providers == "") {
        toastrErrorMsg("File Type field must be required");
        return false;
    }

    if (source == "") {
        toastrErrorMsg("File upload field must be required");
        return false;
    }
    var inp = document.getElementById("picture");
      if (inp.files.length == 0) {
        toastrErrorMsg("Featured Image must be required!");
        inp.focus();
        return false;
      }
    if (price == "" && is_free == 0) {
        toastrErrorMsg("Price or free field must be required");
        return false;
    }
});
"use strict";
$("body").on("click", "#is_frees", function() {
    if ($("#is_frees").is(":checked")) {
        $("#is_frees").attr("value", "1");
        is_freeshowhide_library();
    } else {
        $("#is_frees").attr("value", "0");
        $(".dependent_freecourses").slideDown();
    }
});

// =========== is_freeshowhide =============
("use strict");
function is_freeshowhide_library() {
    $(".dependent_freecourses").slideUp();
    $("#prices").val("");
    $("#is_discounts").prop("checked", false);
    $("#discounts").val("");
}
// ================ its for is_discount =========
$(".dependent_discountcourses").slideUp();
$("body").on("click", "#is_discounts", function() {
    if ($("#is_discounts").is(":checked")) {

        $("#is_discounts").attr("value", "1");
        $(".dependent_discountcourses").slideDown();
    } else {
        $("#is_discounts").attr("value", "0");
        $(".dependent_discountcourses").slideUp();
    }
});










//==============library delete================ 
"use strict";
function library_delete(library_id) {
    var productmode = $("#productmode").val();
    if (productmode == "demo") {
        toastrWarningMsg("It is disabled for demo mode!");
        return false;
    }
    var base_url = $("#base_url").val();
    var CSRF_TOKEN = $("#CSRF_TOKEN").val();
    var r = confirm("Are you sure");
    if (r == true) {
        $.ajax({
            url: base_url + enterprise_shortname + "/library-delete",
            type: "POST",
            data: { csrf_test_name: CSRF_TOKEN, library_id: library_id },
             success: function (r) {
                if (r == 0) {
                toastrErrorMsg("It has some courses");
                } else {
                setTimeout(function () {
                    toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: "slideDown",
                    timeOut: 1500,
                    onHidden: function () {
                        window.location.reload();
                    },
                    };
                    toastr.success("Library deleted successfully!");
                }, 1000);
                }
             },

        });
    }


}

(function($) {
    "use strict";
    $(document).ready(function() {
        var CSRF_TOKEN = $("#CSRF_TOKEN").val();
        var enterprise_shortname = $("#enterprise_shortname").val();
        var enterprise_id = $("#enterprise_id").val();
        var base_url = $("#base_url").val();
        var total_lib_content = $("#total_lib_content").val();
        var lib = $("#library_contentlist").DataTable({
            responsive: true,
            "dom": "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>tp",
            "aaSorting": [
                [0, "desc"]
            ],
            columnDefs: [{
                    bSortable: false,
                    aTargets: [0],
                },
                {
                    targets: 4,
                    className: "text-center",
                },
            ],
            buttons: [{
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

            lengthMenu: [
                [20, 50, 100, 150, 200,+total_lib_content],
                [20, 50, 100, 150, 200, "All"],
            ],
            processing: true,
            sProcessing: "<span class='fas fa-sync-alt'></span>",
            serverSide: true,
            serverMethod: "post",

            ajax: {
                url: base_url + enterprise_shortname + "/get-librarylist",
                data: function(data) {
                    data.csrf_test_name = CSRF_TOKEN;
                },
            },

            columns: [{
                    data: "sl"
                },
                {
                    data: "name",
                },
                {
                    data: "category_name",
                },
                {
                    data: "faculty_name",
                },

                {
                    data: "action"
                },
            ],
        });
    });
})(jQuery);