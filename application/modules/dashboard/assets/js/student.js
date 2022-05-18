(function ($) {
  "use strict";
  $(document).ready(function () {
    var CSRF_TOKEN = $("#CSRF_TOKEN").val();
    var usertype = $("#usertype").val();
    var base_url = $("#base_url").val();
    var enterprise_shortname = $("#enterprise_shortname").val();
    var enterprise_id = $("#enterprise_id").val();

    $("body").on("click", ".btnNext", function () {
      $(".nav-pills .active").parent().next("li").find("a").trigger("click");
    });
    $("body").on("click", ".btnPrevious", function () {
      $(".nav-pills .active").parent().prev("li").find("a").trigger("click");
    });

    $("body").on("click", "#studentsave_btn", function () {
      var productmode = $("#productmode").val();
      if (productmode == "demo") {
        toastrWarningMsg("It is disabled for demo mode!");
        return false;
      }

      var name = $("#name").val();
      var mobile = $("#mobile").val();
      var address = $("#address").val();
      var email = $("#email").val();
      var password = $("#password").val();
      if (name == "") {
        toastrErrorMsg("Name must be required");
        return false;
      }
      if (mobile == "") {
        toastrErrorMsg("Mobile must be required");
        return false;
      }
      if (email == "") {
        toastrErrorMsg("Email must be required");
        return false;
      }
      if (password == "") {
        toastrErrorMsg("Password must be required");
        return false;
      }
      if (IsEmail(email) == false) {
        toastrErrorMsg("Invalid mail");
        return false;
      }
    });

    // =============== its for student list datatables ===========
    var total_student = $("#total_student").val();
    var studentlist = $("#studentlist").DataTable({
      responsive: true,
      dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>tp",
      // aaSorting: [[0, "desc"]],
      columnDefs: [
        {
          bSortable: true,
          aTargets: [0],
        },
        {
          bSortable: false,
          targets: [4, 5],
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
        [10, 50, 100, 150, 200, +total_student],
        [10, 50, 100, 150, 200, "All"],
      ],
      processing: true,
      sProcessing: "<span class='fas fa-sync-alt'></span>",
      serverSide: true,
      serverMethod: "post",

      ajax: {
        url: base_url + enterprise_shortname + "/get-studentlist",
        data: function (data) {
          data.csrf_test_name = CSRF_TOKEN;
          data.student_id = $("#student_id").val();
          data.mobile = $("#mobile").val();
        },
      },

      columns: [
        { data: "sl" },
        { data: "name" },
        { data: "mobile" },
        { data: "email" },
        { data: "image" },
        { data: "action" },
      ],
    });

    $("body").on("click", "#students_filter", function () {
      var student_id = $("#student_id").val();
      var mobile = $("#mobile").val();

      if (student_id == "" && mobile == "") {
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
        studentlist.ajax.reload();
      }
    });

    // =============== its for assigned certificate student list datatables ===========
    var total_assignedcertificate = $("#total_assignedcertificate").val();
    var assignedcertificatelist = $("#assignedcertificatelist").DataTable({
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
          targets: [3],
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
        [10, 50, 100, 150, 200, +total_assignedcertificate],
        [10, 50, 100, 150, 200, "All"],
      ],
      processing: true,
      sProcessing: "<span class='fas fa-sync-alt'></span>",
      serverSide: true,
      serverMethod: "post",

      ajax: {
        url: base_url + enterprise_shortname + "/get-assignedcertificatelist",
        data: function (data) {
          data.csrf_test_name = CSRF_TOKEN;
          //  data.student_id = $("#student_id").val();
          //  data.mobile = $("#mobile").val();
        },
      },

      columns: [
        { data: "sl" },
        { data: "student_name" },
        { data: "certificate_name" },
        { data: "action" },
      ],
    });
  });
})(jQuery);

//============ its for student delete =============
("use strict");
function student_delete(studnet_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/student-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, studnet_id: studnet_id },
      success: function (r) {
        toastrSuccessMsg(r);
        location.reload();
      },
    });
  }
}

//============= its for student inactive ===========
("use strict");
function studentinactive(student_id) {
  var d = confirm("Are you sure?");
  if (d == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/student-inactive",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, student_id: student_id },
      success: function (r) {
        toastrSuccessMsg(r);
        location.reload();
      },
    });
  }
}
//============= its for student active ===========
("use strict");
function studentactive(student_id) {
  var d = confirm("Are you sure?");
  if (d == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/student-active",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, student_id: student_id },
      success: function (r) {
        toastrSuccessMsg(r);
        location.reload();
      },
    });
  }
}
//============== its for students_filter =========
("use strict");
function students_filter() {
  var student_id = $("#student_id").val();
  var mobile = $("#mobile").val();
  if (student_id == "" && mobile == "") {
    toastrErrorMsg("Empty field not allowed");
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/students-filter",
    type: "post",
    data: {
      csrf_test_name: CSRF_TOKEN,
      student_id: student_id,
      mobile: mobile,
    },
    success: function (r) {
      $(".results").html(r);
    },
  });
}

// ======== its for assigncertificate ================
("use strict");
function assigncertificate() {
  var fd = new FormData();
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }
  var mode = $("#mode").val();
  var id = $("#id").val();
  var student_id = $("#student_id").val();
  var certificate_id = $("#certificate_id").val();

  if (mode == "edit") {
    var student_id = $("#edit_student_id").val();
    var certificate_id = $("#edit_certificate_id").val();
  }

  if (student_id == "") {
    toastrErrorMsg("Student name must be required");
    $(student_id).focus();
    return false;
  }
  if (certificate_id == "") {
    toastrErrorMsg("Certificate name must be required");
    $(certificate_id).focus();
    return false;
  }

  fd.append("student_id", student_id);
  fd.append("certificate_id", certificate_id);
  fd.append("mode", mode);
  fd.append("id", id);

  fd.append("csrf_test_name", CSRF_TOKEN);
  $.ajax({
    url: base_url + enterprise_shortname + "/assign-certificate-save",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      location.reload();
    },
  });
}

// ========== its for showassign certificate ==============
function showassign_certificate(id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/showassign-certificate",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      id: id,
    },
    success: function (r) {
      $(".modal_ttl").html("Show Certificate Information");
      $("#info").html(r);
      $("#modal_info").modal("show");
    },
  });
}
// ========== its for assigncertificateedit ==============
function assigncertificateedit(id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/assigncertificate-edit",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      id: id,
    },
    success: function (r) {
      $(".modal_ttl").html("Edit Information");
      $("#info").html(r);
      $("#modal_info").modal("show");
      $(".placeholder-single").select2();
    },
  });
}

//============ its for assign certificate delete =============
("use strict");
function assigncertificatedelete(id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/assigncertificate-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, id: id },
      success: function (r) {
        toastrSuccessMsg(r);
        // location.reload();
        $("#assignedcertificatelist").DataTable().ajax.reload();
      },
    });
  }
}

//    ============= add student course show ============
("use strict");
function studentshowcourse(student_id) {
  
    $.ajax({
        url: base_url + enterprise_shortname + "/student-showcourse",
        type: "POST",
        data: {student_id: student_id, csrf_test_name: CSRF_TOKEN},
        success: function (r) {
            $(".modal_ttl").html("Courses List");
            $("#info").html(r);
            $("#modal_info").modal("show");
        },
    });
}
