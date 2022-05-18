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
    //        ========== its for summary editor ============
    var facultyckeditor = $("#facultyckeditor").val();
    if (facultyckeditor == 1) {
      CKEDITOR.replace("summary", {
        toolbarGroups: [
          {
            name: "basicstyles",
            groups: ["basicstyles"],
          },
          {
            name: "paragraph",
            groups: ["list", "blocks"],
          },
          {
            name: "document",
            groups: ["mode"],
          },
          {
            name: "styles",
            groups: ["styles"],
          },
        ],
        // Remove the redundant buttons from toolbar groups defined above.
        removeButtons:
          "Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar",
      });
    }

    //        ============ its for facultysave_btn ============
    $("body").on("click", "#facultysave_btn", function () {
      var productmode = $("#productmode").val();
      if (productmode == "demo") {
        toastrWarningMsg("It is disabled for demo mode!");
        return false;
      }

      var name = $("#name").val();
      var username = $("#username").val();
      var mobile = $("#mobile").val();
      var email = $("#email").val();
      var password = $("#password").val();
      if (name == "") {
        toastrErrorMsg("Name must be required");
        return false;
      }
      if (username == "") {
        toastrErrorMsg("Username must be required");
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

      // $.ajax({
      //   url: base_url + enterprise_shortname + "/faculty-capacity-check",
      //   type: "post",
      //   data: {
      //     csrf_test_name: CSRF_TOKEN,
      //     // email: d,
      //     // original_email: original_email,
      //   },
      //   success: function (data) {
      //     alert(data);return false;
      //     // if (data == 1) {
      //     //   toastrErrorMsg("This email already exists!");
      //     //   $("#email").val("");
      //     // }
      //   },
      // });

      
    });

    var total_faculty = $("#total_faculty").val();
    var facultylists = $("#facultylists").DataTable({
      responsive: true,
      dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>tp",
      aaSorting: [[0, "desc"]],
      columnDefs: [
        {
          bSortable: true,
          aTargets: [0],
          searchable: false,
        },

        {
          bSortable: false,
          targets: [5, 6],
          className: "text-center",
        },
        {
          bSortable: false,
          targets: 4,
          render: function (data) {
            return '<ul class="tabbox">' + data + "</ul>";
          },
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
        [10, 50, 100, 150, 200, +total_faculty],
        [10, 50, 100, 150, 200, "All"],
      ],
      processing: true,
      sProcessing: "<span class='fas fa-sync-alt'></span>",
      serverSide: true,
      serverMethod: "post",

      ajax: {
        url: base_url + enterprise_shortname + "/get-facultylist",
        data: function (data) {
          data.csrf_test_name = CSRF_TOKEN;
        },
      },
      columns: [
        { data: "sl" },
        { data: "name" },
        { data: "email" },
        { data: "mobile" },
        { data: "courses" },
        { data: "image" },
        { data: "action" },
      ],
    });

    $("body").on("change", "#picture", function (e) {
      var filename = e.target.files[0].name;
      $(".filename").text(filename);
    });

  });
})(jQuery);

var CSRF_TOKEN = $("#CSRF_TOKEN").val();
var usertype = $("#usertype").val();
var base_url = $("#base_url").val();
var enterprise_shortname = $("#enterprise_shortname").val();
var enterprise_id = $("#enterprise_id").val();

//   ============= its for email_goto_username ======
("use strict");
function email_goto_username(email) {
  getUniqueusername(email);
  $("#username").val(email);
}

("use strict");
function getUniqueusername(d) {
  var original_email = $("#original_email").val();
  var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/get-unique-username",
    type: "post",
    data: {
      csrf_test_name: CSRF_TOKEN,
      email: d,
      original_email: original_email,
    },
    success: function (data) {
      if (data == 1) {
        toastrErrorMsg("This email already exists!");
        $("#email").val("");
      }
    },
  });
}

("use strict");
function appendEducation() {
  $("#educations_area").append(
    "<div class='row'><div class='col-md-10'>\n\
    <div class='row'><div class='form-group  col-md-4'>\n\
    <input type='text' class='form-control' value='' name='degree_name[]' placeholder='Degree Name'>\n\
    </div><div class='form-group col-md-4'>\n\
    <input type='text' class='form-control' value='' name='institute[]' placeholder='Institute'>\n\
    </div>\n\
    <div class='form-group col-md-4'>\n\
    <input type='number' name='passing_year[]' class='form-control' placeholder='Passing Year'></div></div>\n\
    </div><div class='col-md-2'>\n\
    <button type='button' class='btn btn-danger btn-sm custom_btn m-t-0' name='button' onclick='removeEducation(this)'> <i class='fa fa-minus'></i> </button></div></div>"
  );
  $(".placeholder-single").select2();
}
("use strict");
function removeEducation(outcomeElem) {
  $(outcomeElem).parent().parent().remove();
}

("use strict");
function appendExperience() {
  $("#experience_area").append(
    "<div class='row'>\n\
                                           <div class='col-md-10'>\n\
                                            <div class='row'>\n\
                                                <div class='form-group  col-md-2'>\n\
                                                    <input type='text' class='form-control' name='designation[]' id='designation' placeholder='Designation'>\n\
                                                </div>\n\
                                                <div class='form-group col-md-3'>\n\
                                                    <input type='text' class='form-control' name='company_name[]' id='company_name' placeholder='Company Name'>\n\
                                                </div>\n\
                                                <div class='form-group col-md-2'>\n\
                                                    <input type='text' class='form-control datepicker' name='from[]' id='from' placeholder='From'>\n\
                                                </div>\n\
                                                <div class='form-group col-md-2'>\n\
                                                    <input type='text' class='form-control datepicker' name='to[]' id='to' placeholder='To'>\n\
                                                </div>\n\
                                                <div class='form-group col-md-3'>\n\
                                                    <input type='text' class='form-control' name='responsibility[]' id='responsibility' placeholder='Responsibility'>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class='col-md-2'>\n\
                                            <button type='button' class='btn btn-danger btn-sm custom_btn m-t-0' name='button' onclick='removeExperience(this)'> <i class='fa fa-minus'></i> </button>\n\
                                        </div>\n\
                                    </div>"
  );
  $(".datepicker").datepicker({
    format: "yyyy-mm-dd",
    autoclose: true,
    todayHighlight: true,
  });
}

("use strict");
function removeExperience(requirementElem) {
  $(requirementElem).parent().parent().remove();
}

//    ============ its for  faculty delete =========
("use strict");
function faculty_delete(faculty_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $('#CSRF_TOKEN').val();
  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/faculty-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, faculty_id: faculty_id },
      success: function (r) {
        toastrErrorMsg(r);
        location.reload();
      },
    });
  }
}
//============= its for courseinactive ===========
("use strict");
function facultyinactive(faculty_id) {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $('#CSRF_TOKEN').val();
  var d = confirm("Are you sure?");
  if (d == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/faculty-inactive",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, faculty_id: faculty_id },
      success: function (r) {
        toastrSuccessMsg(r);
        location.reload();
      },
    });
  }
}
//============= its for courseactive ===========
("use strict");
function facultyactive(faculty_id) {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $('#CSRF_TOKEN').val();
  var d = confirm("Are you sure?");
  if (d == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/faculty-active",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, faculty_id: faculty_id },
      success: function (r) {
        // console.log(r);
        toastrSuccessMsg(r);
        location.reload();
      },
    });
  }
}
//=========== its for faculty_filter =================
("use strict");
function faculty_filter() {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $('#CSRF_TOKEN').val();
  var faculty_id = $("#faculty_id").val();
  var email = $("#email").val();
  if (faculty_id == "" && email == "") {
    toastrErrorMsg("Empty field not allowed");
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/faculty-filter",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, faculty_id: faculty_id, email: email },
    success: function (r) {
      $(".results").html(r);
    },
  });
}
