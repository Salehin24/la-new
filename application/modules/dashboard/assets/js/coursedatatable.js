(function ($) {
  "use strict";
  $(document).ready(function () {
    var total_course = $("#total_course").val();
    if (usertype == 1) {
      var coursedatatablelist = $("#coursedatatablelist").DataTable({
        responsive: true,
        dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>tp",
        // aaSorting: [[0, 'desc']],
        columnDefs: [
          {
            bSortable: true,
            aTargets: [0],
          },
          {
            bSortable: false,
            targets: 4,
          },
          {
            bSortable: false,
            targets: 8,
            className: "text-center",
          },
        ],
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
            extend: "print",
            title: "ExampleFile",
            className: "btn-sm",
            title: "exportTitle",
            className: "btn-success",
          },
          {
            extend: "pdf",
            title: "ExampleFile",
            className: "btn-sm",
            title: "exportTitle",
            className: "btn-success",
          },
        ],
        lengthMenu: [
          [20, 50, 100, 150, 200, +total_course],
          [20, 50, 100, 150, 200, "All"],
        ],
        processing: true,
        sProcessing: "<span class='fas fa-sync-alt'></span>",
        serverSide: true,
        serverMethod: "post",

        ajax: {
          url: base_url + enterprise_shortname + "/course-datalist",
          data: function (data) {
            data.csrf_test_name = CSRF_TOKEN;
            data.category_id = $("#category_id").val();
            data.course_id = $("#course_id").val();
            data.faculty_id = $("#faculty_id").val();
            data.course_status = $("#course_status").val();
            data.start_date = $("#start_date").val();
            data.end_date = $("#end_date").val();
          },
        },

        columns: [
          { data: "sl" },
          { data: "course_name" },
          { data: "category_name" },
          { data: "faculty_name" },
          // { data: "totalsales" },
          { data: "lesson_section" },
          { data: "agreement_status" },
          { data: "feedback" },
          { data: "created_by" },
          { data: "updated_by" },
          { data: "published_by" },
          { data: "action" },
        ],
      });
    } else {
      var coursedatatablelist = $("#coursedatatablelist").DataTable({
        responsive: true,
        dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>tp",
        // aaSorting: [[0, "desc"]],
        columnDefs: [
          {
            bSortable: false,
            aTargets: [0],
          },
          {
            bSortable: false,
            targets: 9,
            className: "text-center",
          },
        ],
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
            extend: "print",
            title: "ExampleFile",
            className: "btn-sm",
            title: "exportTitle",
            className: "btn-success",
          },
          {
            extend: "pdf",
            title: "ExampleFile",
            className: "btn-sm",
            title: "exportTitle",
            className: "btn-success",
          },
        ],
        lengthMenu: [
          [20, 50, 100, 150, 200, +total_course],
          [20, 50, 100, 150, 200, "All"],
        ],
        processing: true,
        sProcessing: "<span class='fas fa-sync-alt'></span>",
        serverSide: true,
        serverMethod: "post",
        order: [],

        ajax: {
          url: base_url + enterprise_shortname + "/course-datalist",
          data: function (data) {
            data.csrf_test_name = CSRF_TOKEN;
            data.category_id = $("#category_id").val();
            data.course_id = $("#course_id").val();
            data.faculty_id = $("#faculty_id").val();
            data.course_status = $("#course_status").val();
            data.start_date = $("#start_date").val();
            data.end_date = $("#end_date").val();
          },
        },

        columns: [
          { data: "sl" },
          { data: "course_name" },
          { data: "category_name" },
          // { data : "totalsales" },
          { data: "lesson_section" },
          { data: "feedback" },
          { data: "created_by" },
          { data: "updated_by" },
          { data: "published_by" },
          { data: "action" },
        ],
      });
    }

    //course filtering
    $("body").on("click", "#coursefilter", function () {
      var category_id = $("#category_id").val();
      var course_id = $("#course_id").val();
      var start_date = $("#start_date").val();
      var end_date = $("#end_date").val();
      if (
        category_id == "" &&
        course_id == "" &&
        faculty_id == "" &&
        start_date == "" &&
        end_date == ""
      ) {
        setTimeout(function () {
          toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: "slideDown",
            timeOut: 1500,
          };
          toastr.error("Empty field not allow!");
        }, 1000);
      } else {
        coursedatatablelist.ajax.reload();
      }
    });

    // ================ its for course archive list =======
    var total_coursearchive = $("#total_coursearchive").val();
    if (usertype == 1) {
      var coursearchivelist = $("#coursearchivelist").DataTable({
        responsive: true,
        dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>tp",
        aaSorting: [[0, "desc"]],
        columnDefs: [
          {
            bSortable: true,
            aTargets: [0],
          },
          {
            bSortable: false,
            aTargets: [4],
          },
          {
            bSortable: false,
            targets: 11,
            className: "text-center",
          },
        ],
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
            extend: "print",
            title: "ExampleFile",
            className: "btn-sm",
            title: "exportTitle",
            className: "btn-success",
          },
          {
            extend: "pdf",
            title: "ExampleFile",
            className: "btn-sm",
            title: "exportTitle",
            className: "btn-success",
          },
        ],
        lengthMenu: [
          [20, 50, 100, 150, 200, +total_coursearchive],
          [20, 50, 100, 150, 200, "All"],
        ],
        processing: true,
        sProcessing: "<span class='fas fa-sync-alt'></span>",
        serverSide: true,
        serverMethod: "post",

        ajax: {
          url: base_url + enterprise_shortname + "/course-archivedatalist",
          data: function (data) {
            data.csrf_test_name = CSRF_TOKEN;
            data.category_id = $("#category_id").val();
            data.course_id = $("#course_id").val();
            data.faculty_id = $("#faculty_id").val();
            data.start_date = $("#start_date").val();
            data.end_date = $("#end_date").val();
          },
        },

        columns: [
          { data: "sl" },
          { data: "course_name" },
          { data: "category_name" },
          { data: "faculty_name" },
          { data: "sectionlesson_count" },
          { data: "created_date" },
          { data: "created_by" },
          { data: "updated_date" },
          { data: "updated_by" },
          { data: "deleted_date" },
          { data: "deleted_by" },
          { data: "action" },
        ],
      });
    } else {
      var coursearchivelist = $("#coursearchivelist").DataTable({
        responsive: true,
        dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>tp",
        aaSorting: [[0, "desc"]],
        columnDefs: [
          {
            bSortable: false,
            aTargets: [0],
          },
          {
            targets: 8,
            className: "text-center",
          },
        ],
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
            extend: "print",
            title: "ExampleFile",
            className: "btn-sm",
            title: "exportTitle",
            className: "btn-success",
          },
          {
            extend: "pdf",
            title: "ExampleFile",
            className: "btn-sm",
            title: "exportTitle",
            className: "btn-success",
          },
        ],
        lengthMenu: [
          [20, 50, 100, 150, 200, +total_coursearchive],
          [20, 50, 100, 150, 200, "All"],
        ],
        processing: true,
        sProcessing: "<span class='fas fa-sync-alt'></span>",
        serverSide: true,
        serverMethod: "post",

        ajax: {
          url: base_url + enterprise_shortname + "/course-archivedatalist",
          data: function (data) {
            data.csrf_test_name = CSRF_TOKEN;
            data.category_id = $("#category_id").val();
            data.course_id = $("#course_id").val();
            data.faculty_id = $("#faculty_id").val();
            data.start_date = $("#start_date").val();
            data.end_date = $("#end_date").val();
          },
        },

        columns: [
          { data: "sl" },
          { data: "course_name" },
          { data: "category_name" },
          { data: "sectionlesson_count" },
          { data: "created_date" },
          { data: "created_by" },
          { data: "updated_date" },
          { data: "updated_by" },
          { data: "deleted_date" },
          { data: "deleted_by" },
          { data: "action" },
        ],
      });
    }

    //course filtering
    $("body").on("click", "#coursearchivefilter", function () {
      var category_id = $("#category_id").val();
      var course_id = $("#course_id").val();
      var start_date = $("#start_date").val();
      var end_date = $("#end_date").val();
      if (
        category_id == "" &&
        course_id == "" &&
        faculty_id == "" &&
        start_date == "" &&
        end_date == ""
      ) {
        setTimeout(function () {
          toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: "slideDown",
            timeOut: 1500,
          };
          toastr.error("Empty field not allow!");
        }, 1000);
      } else {
        coursearchivelist.ajax.reload();
      }
    });
  });
})(jQuery);
