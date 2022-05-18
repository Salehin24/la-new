(function ($) {
  "use strict";
  $(document).ready(function () {
    var CSRF_TOKEN = $("#CSRF_TOKEN").val();
    var enterprise_shortname = $("#enterprise_shortname").val();
    var enterprise_id = $("#enterprise_id").val();
    var base_url = $("#base_url").val();

    var total_enterprisecount = $("#total_enterprisecount").val();
    var categorydatatablelist = $("#enterpriselist").DataTable({
      responsive: true,
      "dom": "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>tp",
      "aaSorting": [[0, "desc"]],
      columnDefs: [
        {
          bSortable: true,
          aTargets: [0],
        },
        {
          bSortable: false,
          targets: 6,
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
        [20, 50, 100, 150, 200, +total_enterprisecount],
        [20, 50, 100, 150, 200, "All"],
      ],
      processing: true,
      sProcessing: "<span class='fas fa-sync-alt'></span>",
      serverSide: true,
      serverMethod: "post",

      ajax: {
        url: base_url + enterprise_shortname + "/get-enterpriselist",
        data: function (data) {
          data.csrf_test_name = CSRF_TOKEN;
        },
      },

      columns: [
        { data: "sl" },
        { data: "name" },
        { data: "mobile_no" },
        { data: "username" },
        { data: "student_capacity" },
        { data: "faculty_capacity" },
        { data: "action" },
      ],
    });
  });
})(jQuery);


var enterprise_shortname = $("#enterprise_shortname").val();
var enterprise_id = $("#enterprise_id").val();

("use strict");
function enterprise_save() {
  var fd = new FormData();
  var edit_mode = $("#edit_mode").val();
  var enterprise_shortname = $("#enterprise_shortname").val();
  var institute_id = $("#institute_id").val();
  var name = $("#name").val();
  var mobile = $("#mobile").val();
  var dateofbirth = $("#dateofbirth").val();
  var email = $("#email").val();
  var username = $("#username").val();
  var password = $("#password").val();
  var student_capacity = $("#student_capacity").val();
  var instructor_capacity = $("#instructor_capacity").val();
  var old_pass = $("#old_pass").val();
  var role_id = $("#role_id").val();
  // var institute_shortname = $("#institute_shortname").val();
  var base_url = $("#base_url").val();
  var csrf_test_name = $("[name=csrf_test_name]").val();

  if (name == "") {
    $("#name").focus();
    toastrErrorMsg("Enterprise name must be required");
    return false;
  }
  if (mobile == "") {
    $("#mobile").focus();
    toastrErrorMsg("Mobile must be required");
    return false;
  }
  if (dateofbirth == "") {
    $("#dateofbirth").focus();
    toastrErrorMsg("Date of birth must be required");
    return false;
  }
  if (email == "") {
    $("#email").focus();
    toastrErrorMsg("Email must be required");
    return false;
  }
  if (IsEmail(email) == false) {
    toastrErrorMsg("Invalid mail");
    return false;
  }
  if (username == "") {
    $("#username").focus();
    toastrErrorMsg("Username must be required");
    return false;
  }
  if (student_capacity == "") {
    $("#student_capacity").focus();
    toastrErrorMsg("Student Capacity must be required");
    return false;
  }
  if (instructor_capacity == "") {
    $("#instructor_capacity").focus();
    toastrErrorMsg("Instructor Capacity must be required");
    return false;
  }
  if (role_id == "") {
    $("#role_id").focus();
    toastrErrorMsg("Role must be required");
    return false;
  }

  if (edit_mode == "edit") {
    fd.append("enterpriseid", $("#enterpriseid").val());
  }
  fd.append("name", $("#name").val());
  fd.append("mobile", $("#mobile").val());
  fd.append("dateofbirth", dateofbirth);
  fd.append("email", $("#email").val());
  fd.append("username", $("#username").val());
  fd.append("password", $("#password").val());
  fd.append("student_capacity", student_capacity);
  fd.append("instructor_capacity", instructor_capacity);
  fd.append("old_pass", $("#old_pass").val());
  fd.append("role_id", $("#role_id").val());
  fd.append("csrf_test_name", csrf_test_name);

  $.ajax({
    url: base_url + enterprise_shortname + "/enterprise-save",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
        console.log(r);
      setTimeout(function () {
        toastr.options = {
          closeButton: true,
          progressBar: true,
          showMethod: "slideDown",
          timeOut: 1000,
          onHidden: function () {
            if (edit_mode == "edit") {
              location.href = base_url + enterprise_shortname + "/enterprise-list";
            } else {
              window.location.reload();
            }
          },
        };
        toastr.success(r);
      }, 100);
    },
  });
}
// ========= its for enterprise edit =============
("use strict");
function enterprise_edit(enterprise_id) {
  var base_url = $("#base_url").val();
  var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  
  $.ajax({
    url: base_url + enterprise_shortname +"/enterprise-editform",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, enterprise_id: enterprise_id },
    success: function (r) {
      $(".modal_ttl").html("Enterprise Information");
      $("#info").html(r);
      $("#modal_info").modal("show");
      $(".placeholder-single").select2();
    },
  });
}

//============= its for enterprise inactive ===========
("use strict");
function enterpriseinactive(enterprise_id) {
  var d = confirm("Are you sure?");
  if (d == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/enterprise-inactive",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, enterprise_id : enterprise_id },
      success: function (r) {
        toastrSuccessMsg(r);
        location.reload();
      },
    });
  }
}
//============= its for enterprise active ===========
("use strict");
function enterpriseactive(enterprise_id) {
  var d = confirm("Are you sure?");
  if (d == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/enterprise-active",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, enterprise_id: enterprise_id },
      success: function (r) {
        toastrSuccessMsg(r);
        location.reload();
      },
    });
  }
}


//========= its for enterprise delete ===========
"use strict";
function enterprise_delete(enterprise_id) {
    var base_url = $("#base_url").val();
    var CSRF_TOKEN = $('#CSRF_TOKEN').val();

    var r = confirm("Are you sure");
    if (r == true) {
        $.ajax({
            url: base_url  + enterprise_shortname + "/enterprise-delete",
            type: "POST",
            data: {'csrf_test_name': CSRF_TOKEN, enterprise_id: enterprise_id},
            success: function (r) {

                if (r == 0) {
                    toastrErrorMsg("It is not deletable");
                } else {
                    setTimeout(function () {
                        toastr.options = {
                            closeButton: true,
                            progressBar: true,
                            showMethod: 'slideDown',
                            timeOut: 1500,
                            onHidden: function () {
                                window.location.reload();
                            }
                        };
                        toastr.success("Enterprise deleted successfully!");
                    }, 1000);
                    $("#enterpriselist").DataTable().ajax.reload();
                }
            }
        });
    }
}

