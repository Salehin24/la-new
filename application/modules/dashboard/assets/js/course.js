(function ($) {
  "use strict";
  $(document).ready(function () {
    $(window).scroll(function (e) {
      var $el = $(".sticky");
      var isPositionFixed = $el.css("position") == "fixed";
      if ($(this).scrollTop() > 300 && !isPositionFixed) {
        $el.css({
          position: "fixed",
          top: "90px",
          "z-index": "1",
          right: "112px",
        });
      }
      if ($(this).scrollTop() < 300 && isPositionFixed) {
        $el.css({
          position: "static",
          top: "0px",
        });
      }
    });

    var usertype = $("#usertype").val();
    var CSRF_TOKEN = $("#CSRF_TOKEN").val();
    var base_url = $("#base_url").val();
    var enterprise_shortname = $("#enterprise_shortname").val();
    var enterprise_id = $("#enterprise_id").val();

    var segment3 = $("#segment3").val();
    if (segment3) {
      $("#v-pills-curriculum-tab").trigger("click");
    }

    //    ============ its for is popular value add ============
    $("body").on("click", "#is_popular", function () {
      if ($("#is_popular").is(":checked")) {
        $("#is_popular").attr("value", "1");
      } else {
        $("#is_popular").attr("value", "0");
      }
    });
    //    ============ its for is popular value add ============
    $("body").on("click", "#is_new", function () {
      if ($("#is_new").is(":checked")) {
        $("#is_new").attr("value", "1");
      } else {
        $("#is_new").attr("value", "0");
      }
    });
    //    ============ its for is preview value add ============
    $("body").on("click", "#is_preview", function () {
      if ($("#is_preview").is(":checked")) {
        $("#is_preview").attr("value", "1");
      } else {
        $("#is_preview").attr("value", "0");
      }
    });
    //        ======= checkbox is_free  ==========
    $("body").on("click", "#is_free", function () {
      if ($("#is_free").is(":checked")) {
        $("#is_free").attr("value", "1");
        is_freeshowhide();
      } else {
        $("#is_free").attr("value", "0");
        $(".dependent_freecourse").slideDown();
      }
    });
    // ================ its for is_discount =========
    $(".dependent_discountcourse").slideUp();
    $("body").on("click", "#is_discount", function () {
      if ($("#is_discount").is(":checked")) {
        $("#is_discount").attr("value", "1");
        $(".dependent_discountcourse").slideDown();
      } else {
        $("#is_discount").attr("value", "0");
        $(".dependent_discountcourse").slideUp();
      }
    });
    // ================ its for is_discount =========
    $(".dependent_offercourse").slideUp();
    $("body").on("click", "#is_offer", function () {
      if ($("#is_offer").is(":checked")) {
        $("#is_offer").attr("value", "1");
        $(".dependent_offercourse").slideDown();
      } else {
        $("#is_offer").attr("value", "0");
        $(".dependent_offercourse").slideUp();
      }
    });

    // $("body").on("change", "#zone_id", function (e) {
    //   alert('ok');
    // });
    $("body").on("click", "#coursesave_btn", function () {
      var productmode = $("#productmode").val();
      if (productmode == "demo") {
        toastrWarningMsg("It is disabled for demo mode!");
        return false;
      }

      var name = $("#name").val();
      var category_id = $("#category_id").val();
      var faculty_id = $("#faculty_id").val();
      var is_free = $("#is_free").val();
      var price = $("#price").val();
      var course_level = $("#course_level").val();
      var course_type = $("#course_type").val();
      var course_provider = $("#course_provider").val();
      var url = $("#url").val();
      var thumbnail = $("#thumbnail").val();
      var is_discount = $("#is_discount").val();
      var discount = $("#discount").val();

      if (name == "") {
        toastrErrorMsg("Name field must be required");
        return false;
      }
      if (category_id == "") {
        toastrErrorMsg("Category field must be required");
        return false;
      }
      if (faculty_id == "") {
        toastrErrorMsg("Faculty field must be required");
        return false;
      }
      if (course_level == "") {
        toastrErrorMsg("Course Level field must be required");
        return false;
      }
      if (course_type == "") {
        toastrErrorMsg("Course Type field must be required");
        return false;
      }
      // if((course_provider==1)|| (course_provider==2) ){
      //     if (url == "") {
      //         toastrErrorMsg("Promotional Video field must be required");
      //         return false;
      //     }
      // }
      // if(url!=''){
      //     if (course_provider == "") {
      //         toastrErrorMsg("Course Provider field must be required");
      //         return false;
      //     }
      // }
      if (course_type == 1) {
        if (price == "" && is_free == 0) {
          toastrErrorMsg("Price or free field must be required");
          return false;
        }
      }

      var myArray = course_type;
      var p = myArray.includes("1");
      if (p == true) {
        if (price == "") {
          toastrErrorMsg("Price must be required!");
          $("#price").focus();
          return false;
        }
      }
      if (is_discount == 1) {
        if (discount == "") {
          toastrErrorMsg("Discount must be required!");
          $("#discount").focus();
          return false;
        }
        if (discount == "0") {
          toastrErrorMsg("Discount value must be greater than Zero!");
          $("#discount").val("").focus();
          return false;
        }
      }

      var inp = document.getElementById("thumbnail");
      if (inp.files.length == 0) {
        toastrErrorMsg("Course Mini Thumbnail  must be required!");
        inp.focus();
        return false;
      }
      var cover = document.getElementById("cover_thumbnail");
      if (cover.files.length == 0) {
        toastrErrorMsg("Course Cover Thumbnail  must be required!");
        cover.focus();
        return false;
      }
      var hover = document.getElementById("hover_thumbnail");
      if (covehoverr.files.length == 0) {
        toastrErrorMsg("Course Hover Thumbnail  must be required!");
        hover.focus();
        return false;
      }
    });

    function fileUploadRequired() {
      var inp = document.getElementById("thumbnail");
      if (inp.files.length == 0) {
        alert("Attachment Required");
        inp.focus();
        return false;
      }
    }

    // ============= its for exam list ===============
    var total_exam = 250; //$("#total_exam").val();
    var examlist = $("#examlist").DataTable({
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
        [20, 50, 100, 150, 200, +total_exam],
        [20, 50, 100, 150, 200, "All"],
      ],
      processing: true,
      sProcessing: "<span class='fas fa-sync-alt'></span>",
      serverSide: true,
      serverMethod: "post",

      ajax: {
        url: base_url + enterprise_shortname + "/get-examlist",
        data: function (data) {
          data.csrf_test_name = CSRF_TOKEN;
        },
      },

      columns: [
        { data: "sl" },
        { data: "name" },
        { data: "created_date" },
        { data: "created_by" },
        { data: "updated_date" },
        { data: "updated_by" },
        { data: "action" },
      ],
    });

    var total_faq = $("#total_faq").val();
    var faqlist = $("#faqlist").DataTable({
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
          targets: 3,
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
        [20, 50, 100, 150, 200, +total_faq],
        [20, 50, 100, 150, 200, "All"],
      ],
      processing: true,
      sProcessing: "<span class='fas fa-sync-alt'></span>",
      serverSide: true,
      serverMethod: "post",

      ajax: {
        url: base_url + enterprise_shortname + "/get-faqlist",
        data: function (data) {
          data.csrf_test_name = CSRF_TOKEN;
        },
      },

      columns: [
        { data: "sl" },
        { data: "question" },
        { data: "answer" },
        { data: "action" },
      ],
    });

    $("body").on("click", "#checksubmit", function () {
      var facultypaypal = $("#facultypaypal").val();
      var payment_amount = $("#payment_amount").val();
      var total_balance = $("#total_balance").val();
      if (facultypaypal == "") {
        toastrErrorMsg("Paypal account is empty!");
        return false;
      }
      if (payment_amount == "") {
        toastrErrorMsg("Amount must be required");
        return false;
      }
      if (+payment_amount > +total_balance) {
        toastrErrorMsg("Pay amount is not greater than total amount");
        return false;
      }
    });
    $("body").on("click", ".btnNext", function () {
      $(".nav-pills .active").parent().next("li").find("a").trigger("click");
    });
    $("body").on("click", ".btnPrevious", function () {
      $(".nav-pills .active").parent().prev("li").find("a").trigger("click");
    });
  });
})(jQuery);

var usertype = $("#usertype").val();
var CSRF_TOKEN = $("#CSRF_TOKEN").val();
var base_url = $("#base_url").val();
var enterprise_shortname = $("#enterprise_shortname").val();
var enterprise_id = $("#enterprise_id").val();

("use strict");
var req = 1;
function appendpreRequirement() {
  req++;
  var requirement = "requirement-" + req;
  var cls = '"requirement"';
  var msgcls = '"requirement-msgcount"';

  $("#requirement_area").append(
    "<div class='d-flex mt-2'>\n\
            <div class='flex-grow-1'>\n\
            <div class='form-group'>\n\
            <input type='text' class='form-control " +
      requirement +
      "' onkeyup='characterlimitation(" +
      cls +
      ", " +
      req +
      ", 40, " +
      msgcls +
      ")' name='requirements[]' id='requirements' placeholder='Course Requirements'>\n\
            <span class='text-danger'>Only <span class='requirement-msgcount-" +
      req +
      "'>40</span> characters remaining</span>\n\
            </div>\n\
            </div>\n\
            <div class='col-sm-1'>\n\
            <button type='button' class='btn btn-danger btn-sm custom_btn m-t-0' name='button' onclick='removeRequirement(this)'> <i class='fa fa-minus'></i> </button>\n\
            </div>\n\
            </div>"
  );
}

("use strict");
function removeRequirement(requirementElem) {
  $(requirementElem).parent().parent().remove();
}

("use strict");
var outc = 1;
function appendlearnOutcome() {
  outc++;
  var outcomes = "outcomes-" + outc;
  var cls = '"outcomes"';
  var msgcls = '"outcomes-msgcount"';
  $("#outcomes_area").append(
    "<div class='d-flex mt-2'>\n\
    <div class='flex-grow-1 pr-3'>\n\
    <div class='form-group'>\n\
    <input type='text' class='form-control " +
      outcomes +
      "' onkeyup='characterlimitation(" +
      cls +
      ", " +
      outc +
      ", 40, " +
      msgcls +
      ")' name='benifits[]' id='outcomes' placeholder='What you will learn'>\n\
    <span class='text-danger'>Only <span class='outcomes-msgcount-" +
      outc +
      "'>40</span> characters remaining</span>\n\
    </div></div><div class='col-sm-1'>\n\
    <button type='button' class='btn btn-danger btn-sm custom_btn  m-t-0' name='button' onclick='removeOutcome(this)'> <i class='fa fa-minus'></i> </button>\n\
    </div>\n\
    </div>"
  );
}
("use strict");
function removeOutcome(outcomeElem) {
  $(outcomeElem).parent().parent().remove();
}
("use strict");
function appendQuestion() {
  $("#question_area").append(
    '<div class="d-flex mt-2">\n\
        <div class="flex-grow-1 px-3 row">\n\
        <label class="col-md-2" for="question">Question</label>\n\
        <div class="form-group col-md-10">\n\
        <input type="text" class="form-control" name="question[]" placeholder="Question">\n\
        </div>\n\
        <label class="col-md-2" for="answer">Answer</label>\n\
        <div class="form-group col-md-6">\n\
        <select class="form-control" name="qst_ans[]">\n\
            <option value="">-- select one --</option>\n\
            <option value="1">Yes</option>\n\
            <option value="0">No</option>\n\
        </select>\n\
        </div>\n\
        </div>\n\
        <div class="">\n\
        <button type="button" class="btn btn-danger btn-sm custom_btn  m-t-0" name="button" onclick="removeQuestion(this)"> <i class="fa fa-minus"></i> </button>\n\
        </div>\n\
        </div>'
  );
}

("use strict");
function removeQuestion(questionElem) {
  $(questionElem).parent().parent().remove();
}

("use strict");
var co = 1;
function appendCareeroutcome() {
  co++;
  var outcomes = $('[name="career_outcomes[]"]').length;
  var career_out = "carrer-out-" + co;
  var cls = '"carrer-out"';
  var msgcls = '"career-msgcount"';

  if (outcomes >= 4) {
    toastrWarningMsg("You can not add more than four career outcome");
    return false;
  } else {
    $("#careeroutcome_area").append(
      "<div class='d-flex mt-2'>\n\
            <div class='flex-grow-1'>\n\
            <div class='form-group'>\n\
            <input type='text' class='form-control " +
        career_out +
        "' onkeyup='characterlimitation(" +
        cls +
        ", " +
        co +
        ", 40, " +
        msgcls +
        ")' name='career_outcomes[]' id='career_outcomes' placeholder='Learner Career Outcome'>\n\
            <span class='text-danger'>Only <span class='career-msgcount-" +
        co +
        "'>40</span> characters remaining</span>\n\
            </div>\n\
            </div>\n\
            <div class='col-sm-1'>\n\
            <button type='button' class='btn btn-danger btn-sm custom_btn m-t-0' name='button' onclick='removeCareeroutcome(this)'> <i class='fa fa-minus'></i> </button>\n\
            </div>\n\
            </div>"
    );
  }
}

("use strict");
function removeCareeroutcome(careeroutcomeElem) {
  $(careeroutcomeElem).parent().parent().remove();
}

("use strict");
var skg = 1;
function appendSkillsgain() {
  skg++;
  var skillsgain = $('[name="skillsgain[]"]').length;
  var skillsgain_count = "skillsgain-" + skg;
  var cls = '"skillsgain"';
  var msgcls = '"skillsgain-msgcount"';
  if (skillsgain >= 4) {
    toastrWarningMsg("You can not add more than four skills gain");
    return false;
  } else {
    $("#skillsgain_area").append(
      "<div class='d-flex mt-2'>\n\
            <div class='flex-grow-1'>\n\
            <div class='form-group'>\n\
            <input type='text' class='form-control " +
        skillsgain_count +
        "' onkeyup='characterlimitation(" +
        cls +
        ", " +
        skg +
        ", 20, " +
        msgcls +
        ")' name='skillsgain[]' id='skillsgain' placeholder='Skills you will gain'>\n\
            <span class='text-danger'>Only <span class='skillsgain-msgcount-" +
        skg +
        "'>20</span> characters remaining</span>\n\
            </div>\n\
            </div>\n\
            <div class='col-sm-1'>\n\
            <button type='button' class='btn btn-danger btn-sm custom_btn m-t-0' name='button' onclick='removeSkillsgain(this)'> <i class='fa fa-minus'></i> </button>\n\
            </div>\n\
            </div>"
    );
  }
}

("use strict");
function removeSkillsgain(skillsgainElem) {
  $(skillsgainElem).parent().parent().remove();
}

("use strict");
function appendRelatedresource() {
  var resource = $('[name="related_resource[]"]').length;
  if (resource >= 4) {
    toastrWarningMsg("You can not add more than four related resource");
    return false;
  } else {
    $("#relatedresource_area").append(
      "<div class='d-flex mt-2'>\n\
            <div class='flex-grow-1'>\n\
            <div class='form-group'>\n\
            <input type='text' class='form-control' name='related_resource[]' id='related_resource' placeholder='Related Resource'>\n\
            </div>\n\
            </div>\n\
            <div class='col-sm-1'>\n\
            <button type='button' class='btn btn-danger btn-sm custom_btn m-t-0' name='button' onclick='removeRelatedResource(this)'> <i class='fa fa-minus'></i> </button>\n\
            </div>\n\
            </div>"
    );
  }
}

("use strict");
function removeRelatedResource(relatedresourceElem) {
  $(relatedresourceElem).parent().parent().remove();
}

// =========== is_freeshowhide =============
("use strict");
function is_freeshowhide() {
  $(".dependent_freecourse").slideUp();
  $("#price").val("");
  $("#is_discount").prop("checked", false);
  $("#discount").val("");
}

//    =============== its for course delete =============
("use strict");
function course_delete(course_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var base_url = $("#base_url").val();
  var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/course-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, course_id: course_id },
      success: function (r) {
        $("#coursedatatablelist").DataTable().ajax.reload();
        if (r == 0) {
          toastrErrorMsg(
            "This course already has been sale several times. You can’t delete its now."
          );
        } else {
          toastrSuccessMsg("Deleted successfully");
        }
        // location.reload();
      },
    });
  }
}
//============= its for category_wise_course =============
("use strict");
function category_wise_course(category_id) {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/category-wise-course",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, category_id: category_id },
    success: function (r) {
      r = JSON.parse(r);
      $("#course_id").empty();
      $("#course_id").html("<option value=''>-- select one -- </option>");
      $.each(r, function (ar, typeval) {
        $("#course_id").append(
          $("<option>").text(typeval.name).attr("value", typeval.course_id)
        );
      });
    },
  });
}

//    ============= add section form ============
("use strict");
function addsection_form(course_id, mode) {
  $.ajax({
    url: base_url + enterprise_shortname + "/addsection-form",
    type: "POST",
    data: { course_id: course_id, csrf_test_name: CSRF_TOKEN, mode: mode },
    success: function (r) {
      $(".modal_ttl").html("Section Information");
      $("#info").html(r);
      $("#modal_info").modal("show");
    },
  });
}

("use strict");
function appendSectionname() {
  $("#appendsection_area").append(
    "<div class='form-group row'>\n\
        <label for='section_name' class='col-sm-3 col-form-label'>&nbsp</label>\n\
        <div class='col-sm-8'>\n\
          <input name='section_name[]' class='form-control' type='text' placeholder='Section Name' id='section_name' required=''>\n\
        </div>\n\
        <div class='col-sm-1'>\n\
          <button type='button' class='btn btn-danger btn-sm custom_btn m-t-0' name='button' onclick='removeRequirement(this)'> <i class='fa fa-minus'></i> </button>\n\
        </div>\n\
    </div>"
  );
}

//======= its for section save =============
("use strict");
function section_save() {
  var fd = new FormData();
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var course_id = $("#courseid").val();
  var section_name = $("#section_name").val();
  var csrf_test_name = $("[name=csrf_test_name]").val();
  if (section_name == "") {
    toastrErrorMsg("Empty field not allow!");
    return false;
  }

  fd.append("course_id", course_id);
  fd.append("section_name", section_name);
  fd.append("csrf_test_name", CSRF_TOKEN);

  $.ajax({
    url: base_url + enterprise_shortname + "/section-save",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    // data: {
    //   course_id: course_id,
    //   section_name: section_name,
    //   csrf_test_name: csrf_test_name,
    // },
    success: function (r) {
      toastrSuccessMsg(r);
      console.log(r);
      // location.reload();
      $("#coursedatatablelist").DataTable().ajax.reload();
    },
  });
}
//    ============ its for section update =============
("use strict");
function sectionupdate() {
  // var base_url = $("#base_url").val();
  var section_id = $("#section_id").val();
  var section_name = $("#section_name").val();
  var csrf_test_name = $("[name=csrf_test_name]").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/section-update",
    type: "POST",
    data: {
      csrf_test_name: csrf_test_name,
      section_id: section_id,
      section_name: section_name,
    },
    success: function (r) {
      toastrSuccessMsg(r);
      location.reload();
    },
  });
}
//    ============= add lesson form ============
("use strict");
function addlesson_form(course_id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/addlesson-form",
    type: "POST",
    data: { course_id: course_id, csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      // alert(r);return false;
      $(".modal_ttl").html("Lesson Information");
      $("#info").html(r);
      $("#modal_info").modal("show");
    },
  });
}
//============= its for lessonsave =============
("use strict");
function lessonsave(course_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var fd = new FormData();
  var lesson_name = $("#lesson_name").val();
  var section_id = $("#section_id").val();
  var lesson_type = $("#lesson_type").val();
  var lesson_provider = $("#lesson_provider").val();
  var attachment = $("#attachment").val();
  var provider_url = $("#provider_url").val();
  var duration = $("#duration").val();
  var summary = $("#lesson_summary").val();
  var description = CKEDITOR.instances["lesson_description"].getData();
  var lessontype_status = $("#lessontype_status").val();

  if (lesson_name == "") {
    toastrErrorMsg("Lesson name must be required");
    $("#lesson_name").focus();
    return false;
  }

  if (lessontype_status == "attach") {
    fd.append("attachment", $("#attachment")[0].files[0]);
  }
  fd.append("lesson_name", $("#lesson_name").val());
  fd.append("section_id", $("#section_id").val());
  fd.append("lesson_type", $("#lesson_type").val());
  if (lessontype_status == "video") {
    fd.append("lesson_provider", $("#lesson_provider").val());
    fd.append("provider_url", $("#provider_url").val());
    fd.append("duration", $("#duration").val());
  }
  fd.append("summary", summary);
  fd.append("description", description);
  fd.append("is_preview", $("#is_preview").val());

  var resource_files = $('input[name="lessonresource[]"]');
  for (var i = 0; i < resource_files.length; i++) {
    var resourceid = resource_files[i].getAttribute("id");
    fd.append("resourcefile[]", $("#" + resourceid)[0].files[0]);
  }
  fd.append("resource_length", resource_files.length);

  fd.append("course_id", course_id);
  fd.append("csrf_test_name", CSRF_TOKEN);
  $.ajax({
    url: base_url + enterprise_shortname + "/lesson-save",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      // console.log(r);
      toastrSuccessMsg(r);
      location.reload();
    },
  });
}

//    ================== its for lesson edit ===========
("use strict");
function edit_lesson(lesson_id, course_id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/editlesson-form",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      lesson_id: lesson_id,
      course_id: course_id,
    },
    success: function (r) {
      $(".modal_ttl").html("Lesson Update");
      $("#info").html(r);
      $("#modal_info").modal("show");
      CKEDITOR.replace("lesson_description", {
        toolbarGroups: [
          {
            name: "basicstyles",
            groups: ["basicstyles"],
          },
          {
            name: "links",
            groups: ["links"],
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
            name: "insert",
            groups: ["insert"],
          },
          {
            name: "styles",
            groups: ["styles"],
          },
          {
            name: "about",
            groups: ["about"],
          },
        ],
        // Remove the redundant buttons from toolbar groups defined above.
        removeButtons:
          "Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar",
      });
      $(".placeholder-single").select2();
    },
  });
}

////============= its for lessonupdate =============
("use strict");
// function lessonupdate(lesson_id) {
//   var fd = new FormData();
//   var lesson_name = $("#lesson_name").val();
//   var section_id = $("#section_id").val();
//   var lesson_type = $("#lesson_type").val();
//   var lesson_provider = $("#lesson_provider").val();
//   var attachment = $("#attachment").val();
//   var provider_url = $("#provider_url").val();
//   var oldprovider_url = $("#oldprovider_url").val();
//   var duration = $("#duration").val();
//   var summary = $("#lesson_summary").val();
//   var description = CKEDITOR.instances["lesson_description"].getData();
//   var is_preview = $("#is_preview").val();
//   var lessontype_status = $("#lessontype_status").val();

//   if (lessontype_status == "attach") {
//     fd.append("attachment", $("#attachment")[0].files[0]);
//   }
//   fd.append("lesson_name", $("#lesson_name").val());
//   fd.append("section_id", $("#section_id").val());
//   fd.append("lesson_type", $("#lesson_type").val());
//   if (lessontype_status == "video") {
//     fd.append("lesson_provider", $("#lesson_provider").val());
//     fd.append("provider_url", $("#provider_url").val());
//     fd.append("oldprovider_url", $("#oldprovider_url").val());
//     fd.append("duration", $("#duration").val());
//   }
//   fd.append("summary", summary);
//   fd.append("description", description);
//   fd.append("is_preview", $("#is_preview").val());
//   fd.append("lesson_id", lesson_id);
//   fd.append("csrf_test_name", CSRF_TOKEN);
//   $.ajax({
//     url: base_url + enterprise_shortname + "/lesson-update",
//     type: "POST",
//     data: fd,
//     enctype: "multipart/form-data",
//     processData: false,
//     contentType: false,
//     success: function (r) {
//       toastr.success(r);
//       location.reload();
//     },
//   });
// }
//    ============= its for lesson delete ============
("use strict");
// function lesson_delete(lesson_id) {
//   var course_id = $("#course_id").val();
//   var r = confirm("Are you sure");
//   if (r == true) {
//     $.ajax({
//       url: base_url + enterprise_shortname + "/lesson-delete",
//       type: "POST",
//       data: {
//         csrf_test_name: CSRF_TOKEN,
//         lesson_id: lesson_id,
//         course_id: course_id,
//       },
//       success: function (r) {
//         if (r == 0) {
//           toastrErrorMsg(
//             "This course already has been sale several times. You can’t delete its lesson or sessions now."
//           );
//         } else {
//           toastrSuccessMsg("Deleted successfully");
//         }
//         location.reload();
//       },
//     });
//   }
// }

//    ============= assign exam form ============
("use strict");
function assignExamForm(course_id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/assignexam-form",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, course_id: course_id },
    success: function (r) {
      $(".modal_ttl").html("Assign Exam");
      $("#info").html(r);
      $("#modal_info").modal("show");
      $(".placeholder-single").select2();
    },
  });
}
// =============== its for assignExam =============
("use strict");
function assignExam(course_id, id) {
  var fd = new FormData();
  // var lesson_id = $("#lesson_id").val();
  var section_id = $("#section_id").val();
  var exam_id = $("#exam_id").val();

  if (section_id == "") {
    toastrErrorMsg("Chapter name must be required!");
    return false;
  }
  if (exam_id == "") {
    toastrErrorMsg("Exam name must be required!");
    return false;
  }

  // fd.append("lesson_id", lesson_id);
  fd.append("section_id", section_id);
  fd.append("exam_id", exam_id);
  fd.append("course_id", course_id);
  fd.append("id", id);
  fd.append("csrf_test_name", CSRF_TOKEN);

  $.ajax({
    url: base_url + enterprise_shortname + "/assign-exam",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastr.success(r);
      location.reload();
    },
  });
}

// ============== its for assignexamEdit =========
function assignexamEdit(course_id, id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/assignexam-edit",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      course_id: course_id,
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

// ============== its for assignexamDelete =========
function assignexamDelete(id) {
  var r = confirm("Are you sure");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/assignexam-delete",
      type: "POST",
      data: {
        csrf_test_name: CSRF_TOKEN,
        id: id,
      },
      success: function (r) {
        if (r == 0) {
          toastrErrorMsg("Not Possible");
        } else {
          toastrSuccessMsg("Deleted successfully");
        }
        location.reload();
      },
    });
  }
}

function getpassscorecheck(value) {
  var check_digit = $("#pass_mark").val().length;
  var maxchars = 3;
  if (check_digit > 3) {
    toastr["error"]("No pass scrore above 3 digit");
    $("#pass_mark").val(value.substring(0, maxchars));
    return false;
  }
}


("use strict");
function addresize_form(course_id) {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/photo-resize-form",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, course_id: course_id },
    success: function (r) {
      $(".modal_ttl").html("Course Image Resize");
      $("#info").html(r);
      $("#modal_info").modal("show");
    },
  });
}
("use strict");
function photoresize() {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var image_path = $(".image_path").val();
  var widthsize = $(".widthsize").val();
  var heightsize = $(".heightsize").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/photo-resize-submit",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      image_path: image_path,
      widthsize: widthsize,
      heightsize: heightsize,
    },
    success: function (r) {
      if (r == 1) {
        toastrSuccessMsg("Image resize completed");
        $("#modal_info").modal("hide");
      } else {
        toastrErrorMsg("All field must be required!");
      }
    },
  });
}
//============= its for courseinactive ===========
("use strict");
function courseinactive(course_id) {
  var d = confirm("Are you sure?");
  if (d == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/course-inactive",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, course_id: course_id },
      success: function (r) {
        toastrSuccessMsg(r);
        $("#coursedatatablelist").DataTable().ajax.reload();
        // location.reload();
      },
    });
  }
}

function coursefeedback(course_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }
  var feedback = $("#feedback").val();
  if (feedback == "") {
    toastrErrorMsg("Feedback must be required!");
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/course-feedbacksubmit",
    type: "POST",
    data: {
      course_id: course_id,
      feedback: feedback,
      csrf_test_name: CSRF_TOKEN,
    },
    success: function (data) {
      $("#preview_modal").modal("hide");
      toastrSuccessMsg(data);
      $("#coursedatatablelist").DataTable().ajax.reload();
      // location.reload();
      // window.location.reload();
    },
    error: function (xhr) {
      alert("failed!");
    },
  });
}

//============= its for courseactive ===========
("use strict");
function courseactive(course_id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/coursesharepercent-check",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, course_id: course_id },
    success: function (r) {
      // alert(r);return false;
      if (r == 0) {
        sharepercent_form(course_id);
      } else if (r == 1) {
        tagstatus_form(course_id);
      } else {
        var d = confirm("Are you sure?");
        if (d == true) {
          $.ajax({
            url: base_url + enterprise_shortname + "/course-active",
            type: "POST",
            data: { csrf_test_name: CSRF_TOKEN, course_id: course_id },
            success: function (r) {
              toastrSuccessMsg(r);
              $("#coursedatatablelist").DataTable().ajax.reload();
              // location.reload();
            },
          });
        }
      }
    },
  });
}

function coursereject(course_id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/course-inactivepreview",
    type: "POST",
    data: {
      course_id: course_id,
      csrf_test_name: CSRF_TOKEN,
    },
    success: function (data) {
      $("#exampleModalLabel").text("Course Feedback");
      $(".previewdetails").html(data);
      $("#preview_modal").modal("show");
    },
    error: function (xhr) {
      alert("failed!");
    },
  });
}

//============= its for coursepopularstatus ===========
// ("use strict");;
// function coursepopularstatus(course_id, sl) {
//     var popular  = '#is_popular_'+sl;
//     if ($(popular).is(":checked")) {
//         $('#is_popular_'+sl).attr('checked', '');
//         var is_popular = 0;
//     }else{
//         $('#is_popular_'+sl).attr('checked', 'checked');
//         var is_popular = 1;
//     }

//     $.ajax({
//         url: base_url + enterprise_shortname + "/course-popularstatus",
//         type: "POST",
//         data: {csrf_test_name: CSRF_TOKEN, course_id: course_id, is_popular : is_popular},
//         success: function (r) {
//             toastrSuccessMsg(r);
//             // location.reload();
//         },
//     });
// }
// //============= its for coursenewstatus ===========
// ("use strict");;
// function coursenewstatus(course_id, sl) {
//     var isnew  = '#is_new_'+sl;
//     if ($(isnew).is(":checked")) {
//         $('#is_new'+sl).attr('checked', '');
//         var is_new = 0;
//         // $('#is_new'+sl).val(0);
//     }else{
//         $('#is_new_'+sl).attr('checked', 'checked');
//         // $('#is_new'+sl).val(1);
//         var is_new = 1;
//     }

//     $.ajax({
//         url: base_url + enterprise_shortname + "/course-newstatus",
//         type: "POST",
//         data: {csrf_test_name: CSRF_TOKEN, course_id: course_id, is_new : is_new},
//         success: function (r) {
//             toastrSuccessMsg(r);
//             // location.reload();
//         },
//     });
// }

//============== its for student_salescourse ===============
("use strict");
function student_salescourse_filter() {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var student_id = $("#student_id").val();
  var mobile = $("#mobile").val();
  var start_date = $("#start_date").val();
  var end_date = $("#end_date").val();
  if (student_id == "" && mobile == "" && start_date == "" && end_date == "") {
    toastrErrorMsg("Empty field not allowed");
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/student-salescourse-filter",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      student_id: student_id,
      mobile: mobile,
      start_date: start_date,
      end_date: end_date,
    },
    success: function (r) {
      $(".results").html(r);
    },
  });
}
//========== its for faculty salescourse filter ===============
("use strict");
function faculty_salescourse_filter() {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var faculty_id = $("#faculty_id").val();
  var mobile = $("#mobile").val();
  var start_date = $("#start_date").val();
  var end_date = $("#end_date").val();
  if (faculty_id == "" && mobile == "" && start_date == "" && end_date == "") {
    toastrErrorMsg("Empty field not allowed");
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/faculty-salescourse-filter",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      faculty_id: faculty_id,
      mobile: mobile,
      start_date: start_date,
      end_date: end_date,
    },
    success: function (r) {
      $(".results").html(r);
    },
  });
}
//============== its for course filter ====================
("use strict");
function course_filter() {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var category_id = $("#category_id").val();
  var course_id = $("#course_id").val();
  var start_date = $("#start_date").val();
  var end_date = $("#end_date").val();
  if (
    category_id == "" &&
    course_id == "" &&
    start_date == "" &&
    end_date == ""
  ) {
    toastrErrorMsg("Empty field not allowed");
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/course-filter",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      category_id: category_id,
      course_id: course_id,
      start_date: start_date,
      end_date: end_date,
    },
    success: function (r) {
      $(".results").html(r);
    },
  });
}
//============ its for faculty wise course ===========
("use strict");
function faculty_wise_course(faculty_id) {
  // var base_url = $("#base_url").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/faculty-wise-course",
    type: "POST",
    data: { faculty_id: faculty_id },
    success: function (r) {
      r = JSON.parse(r);
      $("#course_id").empty();
      $("#course_id").html("<option value=''> -- select one -- </option>");
      $.each(r, function (ar, typeval) {
        $("#course_id").append(
          $("<option>").text(typeval.name).attr("value", typeval.course_id)
        );
      });
    },
  });
}
//=========== its for course wise price =========
("use strict");
function course_wise_courseinfo(course_id) {
  // var base_url = $("#base_url").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/course-wise-courseinfo",
    type: "POST",
    data: { course_id: course_id },
    success: function (r) {
      r = JSON.parse(r);
      $("#price").val(r.price);
    },
  });
}
//=========== its for commission_rate =============
("use strict");
function commission_rate(commission) {
  var price = $("#price").val();
  var rate = (price * commission) / 100;
  $("#rate").val(rate);
  onlynumber_allow(commission, "commission");
}
//=============its for commission save ==============
("use strict");
function commission_generate() {
  // var base_url = $("#base_url").val();
  var course_id = $("#course_id").val();
  var faculty_id = $("#faculty_id").val();
  var commission = $("#commission").val();
  var rate = $("#rate").val();
  if (course_id == "" || faculty_id == "" || commission == "") {
    toastrErrorMsg("Empty field not allowed");
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/commission-generate",
    type: "POST",
    data: { course_id: course_id, commission: commission, rate: rate },
    success: function (r) {
      toastrSuccessMsg(r);
      location.reload();
    },
  });
}

//============ its for paywith_paypal ===========
("use strict");
function paywith_paypal(faculty_id, sl) {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var ttlbalance = $("#ttlbalance_" + sl).val();
  var facultyname = $("#facultyname_" + sl).val();
  var facultyid = $("#facultyid_" + sl).val();
  var facultypaypal = $("#facultypaypal_" + sl).val();
  $.ajax({
    url: base_url + enterprise_shortname + "/pay-form",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, ttlbalance: ttlbalance },
    success: function (r) {
      $("#payModal").modal("show");
      $("#payform").html(r);
      $("#name").val(facultyname);
      $("#total_balance").val(ttlbalance);
      $("#faculty_id").val(facultyid);
      $("#facultypaypal").val(facultypaypal);
    },
  });
}

//============= its for lesson type wise next document ===============
("use strict");
function lessontype(typeid) {
  if (typeid == 1) {
    $(".lessontype_status").attr("value", "video");
    // $("#show").html(
    //         "<label for='lesson_provider' class='col-sm-3 col-form-label'>Lesson Provider</label>\n\
    //     <div class='col-sm-8'>\n\
    //     <select name='lesson_provider' class='form-control placeholder-single' id='lesson_provider' onchange='lessonprovider(this.value)'>\n\
    //     <option value=''>-- select one --</option>\n\
    //     <option value='1'>Youtube</option>\n\
    //     <option value='2'>Vimeo</option>\n\
    //     </select> \n\
    //     </div> "
    //         );
    $("#show").html(
      "<div class='form-group row'>\n\
        <label for='provider_url' class='col-sm-3 col-form-label'>Provider Video</label>\n\
        <div class='col-sm-8'>\n\
         <input type='file' class='form-control fileuploader' id='lesson_vfile' name='lesson_vfile'  onchange='lessonhandleFileSelect(this)' accept='video/*'>\n\
         <input type='hidden' class='form-control ' id='lesson_provider' name='lesson_provider' value='2' >\n\
          <input type='hidden' class='form-control' id='provider_url' name='provider_url' placeholder='Provider Video'>\n\
        <div id='progress-container_lesson' class='progress mt-3' style='display:none'>\n\
        <div id='progress_lesson' class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' aria-valuenow='46' aria-valuemin='0' aria-valuemax='100' style='width: 0%'>&nbsp;0%</div>\n\
        </div>\n\
         <div class='col-sm-1' id='lesson_delete_content' style='display:none;'>\n\
         <a class='btn btn-danger text-capitalize' style='width:60px;' href='javascript:void(0)' onclick='cancel_lesson_video()'>cancel</a></div>\n\
           </div>\n\
          </div>\n\
        <input type='hidden' name='f_du' id='f_du' size='5'/>\n\
        <label class='offset-3 invalidurl_cls' id = 'invalid_url'><?php echo 'Invalid URL' . '. ' . 'Your video link has to be either youtube or vimeo'; ?></label>\n\
        </div>\n\
        <div class='form-group row'>\n\
          <label for='duration' class='col-sm-3 col-form-label'>Duration</label>\n\
        <div class='col-sm-8'>\n\
          <input type='text' class='form-control' id='duration' name='duration' placeholder='00:00:00 Follow this format'>\n\
        </div>\n\
        </div>\n\
        "
    );
  } else if (typeid == 2 || typeid == 3 || typeid == 4 || typeid == 5) {
    $("#show").removeClass("form-group row");
    var attachment = '"1", "attachment", "uploadStatus", "progress-area"';
    $(".lessontype_status").attr("value", "attach");
    $("#show").html(
      "<div class='form-group row'>\n\
        <label for='attachment' class='col-sm-3 col-form-label'>Attachment</label>\n\
        <div class='col-sm-8'>\n\
          <input type='file' name='attachment' id='attachment' onchange='fileuploaderprogress(" +
        attachment +
        ")' class='custom-input-file'> \n\
            <label for='attachment'><i class='fa fa-upload'></i><span class='choose-lessonttype-title'>Choose a file ...</span> </label>\n\
        </div> \n\
      </div> \n\
            "
    );
    $("#providershow").html("");
  }
}

//    ============= its for lessonprovider =============
("use strict");
function lessonprovider(provider_id) {
  if (provider_id == 1 || provider_id == 2) {
    $("#providershow").html(
      "<div class='form-group row'>\n\
            <label for='provider_url' class='col-sm-3 col-form-label'>Provider URL</label>\n\
            <div class='col-sm-8'>\n\
               <input type='text' class='form-control' id='provider_url' name='provider_url' placeholder='Provider URL' onkeyup='getvideo_details(this.value)'>\n\
            </div>\n\
            </div>\n\
            <label class='offset-3 preloader_cls' id = 'perloader'><i class='fas fa-spinner fa-spin text-green'>&nbsp;</i><?php echo display('checking_url'); ?></label>\n\
            <label class='offset-3 invalidurl_cls' id = 'invalid_url'><?php echo 'Invalid URL' . '. ' . 'Your video link has to be either youtube or vimeo'; ?></label>\n\
            <div class='form-group row'>\n\
            <label for='duration' class='col-sm-3 col-form-label'>Duration</label>\n\
            <div class='col-sm-8'>\n\
            <input type='text' class='form-control' id='duration' name='duration' placeholder='00:00:00 Follow this format'>\n\
            </div></div>\n\
            "
    );
  }
}
//    =========== its for getvideo_details ===========
("use strict");
function getvideo_details(video_url) {
  var lesson_provider = $("#lesson_provider").val();

  if (checkURLValidity(video_url)) {
    $("#perloader").show();
    $.ajax({
      url: base_url + enterprise_shortname + "/get-video-details",
      type: "POST",
      data: {
        csrf_test_name: CSRF_TOKEN,
        lesson_provider: lesson_provider,
        video_url: video_url,
      },
      success: function (r) {
        var res = $.parseJSON(r);
        $("#duration").val(res.duration);
        $("#perloader").hide();
        $("#invalid_url").hide();
      },
    });
  } else {
    $("#invalid_url").show();
    $("#perloader").hide();
    $("#duration").val("");
  }
}
("use strict");
function checkURLValidity(video_url) {
  var youtubePregMatch =
    /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
  var vimeoPregMatch =
    /^(http\:\/\/|https\:\/\/)?(www\.)?(vimeo\.com\/)([0-9]+)$/;
  if (video_url.match(youtubePregMatch)) {
    return true;
  } else if (vimeoPregMatch.test(video_url)) {
    return true;
  } else {
    return false;
  }
}

//================ its for  yearmonthly_myrevenue  =============
("use strict");
function yearmonthly_myrevenue(faculty_id) {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var yearmonth = $("#yearmonth_picker").val();
  if (yearmonth == "") {
    toastrErrorMsg("Empty filed not allow");
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/yearmonthly-myrevenue",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      yearmonth: yearmonth,
      faculty_id: faculty_id,
    },
    success: function (r) {
      $(".yearmonth_results").html(r);
    },
  });
}

//========= its for load question data ============
// checkbox
("use strict");
function loadquestiondata(questiontype, sl) {
  if (questiontype == 1) {
    var item = "'addrowItem_" + sl + "'";
    var isAnscount = "'1_" + sl + "'";
    var qst_count = $("#qst_count_" + sl).val();

    $(".loaddata_" + sl).html(
      '<div class="table-responsive">\n\
      <input type="hidden" name="shortanswer[]" id="shortanswer" class="form-control shortanswer">\n\
                          <table class="table table-bordered" id="examTable_' +
        sl +
        '">\n\
                              <thead>\n\
                              <tr>\n\
                              <th width="50%" class="text-center">Option</th>\n\
                              <th width="30%" class="text-center">Is Answer</th>\n\
                              </tr>\n\
                              </thead>\n\
                              <tbody id="addrowItem_1">\n\
                              <tr>\n\
                              <td class="text-right">\n\
                              <div class="">\n\
  <textarea name="question_' +
        qst_count +
        '_option[]" class="form-control option_editor" id="option_editor" readonly>True</textarea>\n\
  </div>\n\
  </td>\n\
  <td class="text-center">\n\
  <div class="offset-2  checkbox-success">\n\
  <input id="is_answer_' +
        sl +
        '_1" name="question_' +
        qst_count +
        '_is_answer[]" type="radio" value="0" onclick="isAnswerRadio(' +
        sl +
        ',1)">\n\
  <label for="is_answer_' +
        sl +
        '_1">Is Answer</label></div>\n\
  <input type="hidden" name="question_' +
        qst_count +
        '_hdn_isans[]" value="0" id="hdn_isans_' +
        sl +
        '_1"></td>\n\
  </tr>\n\
  <tr>\n\
  <td class="text-right">\n\
  <div class="">\n\
  <textarea name="question_' +
        qst_count +
        '_option[]" class="form-control option_editor" id="option_editor" readonly>False</textarea>\n\
  </div>\n\
  </td>\n\
  <td class="text-center">\n\
  <div class="offset-2  checkbox-success">\n\
  <input id="is_answer_' +
        sl +
        '_2" name="question_' +
        qst_count +
        '_is_answer[]" type="radio" value="0" onclick="isAnswerRadio(' +
        sl +
        ',2)">\n\
  <label for="is_answer_' +
        sl +
        '_2">Is Answer</label></div>\n\
  <input type="hidden" name="question_' +
        qst_count +
        '_hdn_isans[]" value="0" id="hdn_isans_' +
        sl +
        '_2"></td>\n\
  </tr>\n\
  <tr>\n\
  <td class="text-right">\n\
  <div class="">\n\
  <textarea name="question_' +
        qst_count +
        '_option[]" class="form-control option_editor" id="option_editor" readonly>Not Given</textarea>\n\
  </div>\n\
  </td>\n\
  <td class="text-center">\n\
  <div class="offset-2  checkbox-success">\n\
  <input id="is_answer_' +
        sl +
        '_3" name="question_' +
        qst_count +
        '_is_answer[]" type="radio" value="0" onclick="isAnswerRadio(' +
        sl +
        ',3)">\n\
  <label for="is_answer_' +
        sl +
        '_3">Is Answer</label></div>\n\
  <input type="hidden" name="question_' +
        qst_count +
        '_hdn_isans[]" value="0" id="hdn_isans_' +
        sl +
        '_3"></td>\n\
  </tr>\n\
  </tbody>\n\
  </table>\n\
  </div>'
    );
  } else if (questiontype == 2) {
    var item = "'addrowItem_" + sl + "'";
    var isAnscount = "'1_" + sl + "'";
    var qst_count = $("#qst_count_" + sl).val();

    $(".loaddata_" + sl).html(
      '<div class="table-responsive">\n\
      <input type="hidden" name="shortanswer[]" id="shortanswer" class="form-control shortanswer">\n\
                            <table class="table table-bordered" id="examTable_' +
        sl +
        '">\n\
                                <thead>\n\
                                <tr>\n\
                                <th width="50%" class="text-center">Option</th>\n\
                                <th width="30%" class="text-center">Is Answer</th>\n\
                                <th width="10%" class="text-center">Action </th>\n\
                                </tr>\n\
                                </thead>\n\
                                <tbody id="addrowItem_' +
        sl +
        '">\n\
                                <tr>\n\
                                <td class="text-right">\n\
                                <div class="">\n\
    <textarea name="question_' +
        qst_count +
        '_option[]" class="form-control option_editor" id="option_editor"></textarea>\n\
    </div>\n\
    </td>\n\
    <td class="text-center">\n\
    <div class="offset-2 checkbox checkbox-success">\n\
    <input id="is_answer_' +
        sl +
        '_1" name="question_' +
        qst_count +
        '_is_answer[]"  type="checkbox" value="0" onclick="isAnswer(' +
        sl +
        ',1)">\n\
    <label for="is_answer_' +
        sl +
        '_1">Is Answer</label></div>\n\
    <input type="hidden" name="question_' +
        qst_count +
        '_hdn_isans[]" value="0" id="hdn_isans_' +
        sl +
        '_1"></td>\n\
    <td class="text-center">\n\
    <button id="add-invoice-item" class="btn btn-info btn-sm" name="add-new-item" onclick="addInputField(' +
        item +
        ", " +
        sl +
        ')" type="button" style="margin: 0px 15px 15px;"><i class="fa fa-plus"> </i> Add Option</button>\n\
    </td>\n\
    </tr>\n\
    </tbody>\n\
    </table>\n\
    </div>'
    );

    //        ========== its for option editor  ============
    //         CKEDITOR.config.autoParagraph = false;
    //         CKEDITOR.replace('option_editor', {
    //             toolbarGroups: [
    //                 {
    //                     "name": "basicstyles",
    //                     "groups": ["basicstyles"]
    //                 },
    //                 {
    //                     "name": "paragraph",
    //                     "groups": ["list", "blocks"]
    //                 },
    //                 {
    //                     "name": "document",
    //                     "groups": ["mode"]
    //                 },
    //                 {
    //                     "name": "styles",
    //                     "groups": ["styles"]
    //                 },
    //             ],
    //             // Remove the redundant buttons from toolbar groups defined above.
    // //            removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
    //             removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
    //         });
  } else if (questiontype == 3) {
    $(".loaddata_" + sl).html(
      '<div class="form-group col-sm-12">\n\
                        <label for="shortanswer" class="col-sm-4">Short Answer</label>\n\
                        <div class="col-sm-12">\n\
                            <textarea name="shortanswer[]" id="shortanswer" class="form-control shortanswer" rows="5" cols="80" required></textarea>\n\
                        </div>\n\
                    </div>'
    );
    //        ========== its for shortanswer  ============
    //         CKEDITOR.config.autoParagraph = false;
    //         CKEDITOR.replace('shortanswer', {
    //             toolbarGroups: [
    //                 {
    //                     "name": "basicstyles",
    //                     "groups": ["basicstyles"]
    //                 },
    //                 {
    //                     "name": "paragraph",
    //                     "groups": ["list", "blocks"]
    //                 },
    //                 {
    //                     "name": "document",
    //                     "groups": ["mode"]
    //                 },
    //                 {
    //                     "name": "styles",
    //                     "groups": ["styles"]
    //                 },
    //             ],
    // // Remove the redundant buttons from toolbar groups defined above.
    //             removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
    //         });
  }
}

var count = 2;
var cnt = 1;
limits = 500;
// ========== its for row add dynamically =============
("use strict");
function addInputField(t, sl) {
  if (count == limits) {
    alert("You have reached the limit of adding" + count + "inputs");
  } else {
    // var ansCountNumber = $("#ansCountNumber_"+sl).val();
    // var isAnscount = +ansCountNumber + +cnt;
    // var isAnscount = +ansCountNumber + +sl;
    // var rowCount = $('#myTable tr').length;
    var trcount = $("#examTable_" + sl + " > tbody > tr").length + 1;
    var qst_count = $("#qst_count_" + sl).val();
    // alert(trcount);
    // alert(ansCountNumber);
    // alert(cnt);
    // alert(isAnscount);
    var a = "option_text_" + count,
      e = document.createElement("tr");
    (e.innerHTML =
      "<td> <div id='" +
      a +
      "' class='" +
      count +
      "'>\n\
    <textarea name='question_" +
      qst_count +
      "_option[]' class='form-control option_editor' id='option_editor_" +
      count +
      "'></textarea></div></td>\n\
<td class='text-center'> <div class='offset-2 checkbox checkbox-success'><input id='is_answer_" +
      sl +
      "_" +
      trcount +
      "' name='question_" +
      qst_count +
      "_is_answer[]'  type='checkbox' value='0' onclick='isAnswer(" +
      sl +
      "," +
      trcount +
      ")'><label for='is_answer_" +
      sl +
      "_" +
      trcount +
      "'> Is Answer</label></div><input type='hidden' name='question_" +
      qst_count +
      "_hdn_isans[]' value='0' id='hdn_isans_" +
      sl +
      "_" +
      trcount +
      "'></td>\n\
<td class='text-center'><button style='text-align: right;' class='btn btn-sm btn-danger' type='button' onclick='deleteRow(this)'><i class='fa fa-minus'> </i></button></td>\n\
"),
      document.getElementById(t).appendChild(e),
      document.getElementById(a).focus();
    //        ========== its for option editor  ============
    //         CKEDITOR.config.autoParagraph = false;
    //         CKEDITOR.replace('option_editor_' + count, {
    //             toolbarGroups: [
    //                 {
    //                     "name": "basicstyles",
    //                     "groups": ["basicstyles"]
    //                 },
    //                 {
    //                     "name": "paragraph",
    //                     "groups": ["list", "blocks"]
    //                 },
    //                 {
    //                     "name": "document",
    //                     "groups": ["mode"]
    //                 },
    //                 {
    //                     "name": "styles",
    //                     "groups": ["styles"]
    //                 },
    //             ],
    // // Remove the redundant buttons from toolbar groups defined above.
    //             removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
    //         });
    count++, cnt++;
  }
}

// ============= its for row delete dynamically =========
("use strict");
d = 1;
function deleteRow(t) {
  d++;
  var a = $("#examTable_" + d + " > tbody > tr").length;
  if (1 == a) {
    alert("There only one row you can't delete it.");
  } else {
    var e = t.parentNode.parentNode;
    e.parentNode.removeChild(e);
  }
}

//    =========== its for optiontype load option ===========
// "use strict";
// function optiontype(optiontype, sl) {
//     if (optiontype == 1) {
//         $(".loadoption_" + sl).html('<input type="text" name="option_text[]" class="form-control" id="option_text_1">');
//     } else if (optiontype == 2) {
//         $(".loadoption_" + sl).html('<div><input type="file" name="picture[]" id="picture" class="custom-input-file" /><label for="picture"><i class="fa fa-upload"></i><span>Choose a file…</span></label></div>')
//     }
// }

function questionmarktwodigit(value, sl) {
  var check_digit = $("#question_mark_"+sl).val().length;
  var maxchars = 2;
  if (check_digit > maxchars) {
    toastr["error"]("No input question mark above 2 digit");
    $("#question_mark_"+sl).val(value.substring(0, maxchars));
    return false;
  }
}

("use strict");
function isAnswerRadio(sl, i) {
  if(i==1){
    $("#is_answer_" + sl + "_" + i).attr("value", "1");
    $("#hdn_isans_" + sl + "_" + i).val(1);

    $("#is_answer_" + sl + "_2").attr("value", "0");
    $("#hdn_isans_" + sl + "_2").val(0);
    $("#is_answer_" + sl + "_3").attr("value", "0");
    $("#hdn_isans_" + sl + "_3").val(0);
  }else if(i==2){
    $("#is_answer_" + sl + "_" + i).attr("value", "1");
    $("#hdn_isans_" + sl + "_" + i).val(1);

    $("#is_answer_" + sl + "_1").attr("value", "0");
    $("#hdn_isans_" + sl + "_1").val(0);
    $("#is_answer_" + sl + "_3").attr("value", "0");
    $("#hdn_isans_" + sl + "_3").val(0);
  }else{
    $("#is_answer_" + sl + "_" + i).attr("value", "1");
    $("#hdn_isans_" + sl + "_" + i).val(1);

    $("#is_answer_" + sl + "_1").attr("value", "0");
    $("#hdn_isans_" + sl + "_1").val(0);
    $("#is_answer_" + sl + "_2").attr("value", "0");
    $("#hdn_isans_" + sl + "_2").val(0);
  }
  
  
  // if ($("#is_answer_" + sl + "_" + i).is(":checked")) {
  //   $("#is_answer_" + sl + "_" + i).attr("value", "1");
  //   $("#hdn_isans_" + sl + "_" + i).val(1);
  // } else {
  //   $("#is_answer_" + sl + "_" + i).attr("value", "0");
  //   $("#hdn_isans_" + sl + "_" + i).val(0);
  // }
}
function isAnswer(sl, i) {
  if ($("#is_answer_" + sl + "_" + i).is(":checked")) {
    $("#is_answer_" + sl + "_" + i).attr("value", "1");
    $("#hdn_isans_" + sl + "_" + i).val(1);
  } else {
    $("#is_answer_" + sl + "_" + i).attr("value", "0");
    $("#hdn_isans_" + sl + "_" + i).val(0);
  }
}

// ============= its for addQuestionsection ============
("use strict");
var c = 1;
function addQuestionsection() {
  c++;
  var content =
    '<div class="questionSection_' +
    c +
    '">\n\
    <div class="row">\n\
  <div class="form-group col-sm-6">\n\
      <label for="question_type" class="col-sm-5">Question Type <i class="text-danger"> * </i></label>\n\
      <div class="col-sm-9">\n\
          <select class="form-control" name="question_type[]" id="question_type" onchange="loadquestiondata(this.value, ' +
    c +
    ')" required>\n\
              <option value="">-- select one --</option>\n\
              <option value="1">True/False</option>\n\
              <option value="2">Multiple Answer</option>\n\
              <option value="3">Short Answer</option>\n\
          </select>\n\
      </div>\n\
  </div>\n\
  <div class="form-group col-sm-4">\n\
      <label for="question_mark" class="col-sm-4">Question Mark<i class="text-danger"> * </i></label>\n\
      <div class="col-sm-9">\n\
          <input type="number" min="1" name="question_mark[]" id="question_mark_'+c+'" onkeyup="questionmarktwodigit(this.value, '+c+')" placeholder="Question Mark" class="form-control" required>\n\
      </div>\n\
  </div>\n\
  <div class="form-group col-sm-2">\n\
    <label for="question_mark" class="col-sm-4">&nbsp</label>\n\
    <div class="col-sm-9">\n\
        <button id="" class="btn btn-sm btn-danger" name="" onclick="deleteQuestion(this,' +
    c +
    ')" type="button" style="margin: 0px 15px 15px;">Delete Question</button>\n\
    </div>\n\
</div>\n\
</div>\n\
<div class="row">\n\
  <div class="form-group col-sm-12">\n\
      <label for="question" class="col-sm-4"><strong>Question ' +
    c +
    '</strong></label>\n\
      <div class="col-sm-12">\n\
          <textarea name="question[]" id="question" class="form-control" rows="1" cols="80" required></textarea>\n\
          <input type="hidden" id="qst_editor" value="1">\n\
          <input type="hidden" id="qst_count_' +
    c +
    '" value="' +
    c +
    '">\n\
      </div>\n\
  </div>\n\
</div>\n\
<div class="row">\n\
  <div class="loaddata_' +
    c +
    ' col-sm-12 w-100p">\n\
  </div>\n\
</div><hr></div>';
  $("#totalquestiondiv").append(content);
  $(".placeholder-single").select2();
}

// =========== its for question block delete ==============
("use strict");
function deleteQuestion(t, sl) {
  // var a = $("#examTable_" + sl + " > tbody > tr").length;
  // if (1 == a) {
  //   alert("There only one row you can't delete it.");
  // } else {
  var e = t.parentNode.parentNode;
  // alert(e);
  // alert(sl);
  // e.parentNode.removeChild(e);
  $(".questionSection_" + sl).remove();
  // }
}

// =========== its for addQusetionModal ============
("use strict");
function addQusetionModal(exam_id, action) {
  var assign_id = $("#assign_id").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/add-questionform",
    type: "POST",
    data: {
      exam_id: exam_id,
      assign_id: assign_id,
      action: action,
      csrf_test_name: CSRF_TOKEN,
    },
    success: function (r) {
      $(".placeholder-single").select2();
      $(".modal_ttl").html("Add Question");
      $("#info").html(r);
      $("#modal_info").modal("show");
    },
  });
}

//========= its for load question data modal ============
("use strict");
function loadquestiondatamodal(questiontype) {
  if (questiontype == 1) {
    var item = "'addinvoiceItem'";
    $(".loaddata_modal").html(
      '<div class="table-responsive">\n\
                        <table class="table table-bordered" id="questionModal">\n\
                            <thead>\n\
                            <tr>\n\
                            <th width="50%" class="text-center">Option</th>\n\
                            <th width="30%" class="text-center">Is Answer</th>\n\
                            </tr>\n\
                            </thead>\n\
                            <tbody id="addinvoiceItem">\n\
                            <tr>\n\
                            <td class="text-right">\n\
                            <div class="">\n\
<textarea name="option_text[]" class="form-control option_editor" id="option_editor" readonly>True</textarea>\n\
</div>\n\
</td>\n\
<td class="text-center">\n\
<div class="offset-2  checkbox-success">\n\
<input id="is_answer_1" name="is_answer[]"  type="radio" value="0" onclick="isAnswermodalRadio(1)">\n\
<label for="is_answer_1">Is Answer</label></div>\n\
<input type="hidden" name="hdn_isans[]" value="0" id="hdn_isans_1"></td>\n\
</tr>\n\
<tr>\n\
                            <td class="text-right">\n\
                            <div class="">\n\
<textarea name="option_text[]" class="form-control option_editor" id="option_editor" readonly>False</textarea>\n\
</div>\n\
</td>\n\
<td class="text-center">\n\
<div class="offset-2 checkbox-success">\n\
<input id="is_answer_2" name="is_answer[]"  type="radio" value="0" onclick="isAnswermodalRadio(2)">\n\
<label for="is_answer_2">Is Answer</label></div>\n\
<input type="hidden" name="hdn_isans[]" value="0" id="hdn_isans_2"></td>\n\
</tr>\n\
<tr>\n\
                            <td class="text-right">\n\
                            <div class="">\n\
<textarea name="option_text[]" class="form-control option_editor" id="option_editor" readonly>Not Given</textarea>\n\
</div>\n\
</td>\n\
<td class="text-center">\n\
<div class="offset-2 checkbox-success">\n\
<input id="is_answer_3" name="is_answer[]"  type="radio" value="0" onclick="isAnswermodalRadio(3)">\n\
<label for="is_answer_3">Is Answer</label></div>\n\
<input type="hidden" name="hdn_isans[]" value="0" id="hdn_isans_3"></td>\n\
</tr>\n\
</tbody>\n\
</table>\n\
</div>'
    );
  } else if (questiontype == 2) {
    var item = "'addinvoiceItem'";
    $(".loaddata_modal").html(
      '<div class="table-responsive">\n\
                        <table class="table table-bordered" id="questionModal">\n\
                            <thead>\n\
                            <tr>\n\
                            <th width="50%" class="text-center">Option</th>\n\
                            <th width="30%" class="text-center">Is Answer</th>\n\
                            <th width="10%" class="text-center">Action </th>\n\
                            </tr>\n\
                            </thead>\n\
                            <tbody id="addinvoiceItem">\n\
                            <tr>\n\
                            <td class="text-right">\n\
                            <div class="">\n\
<textarea name="option_text[]" class="form-control option_editor" id="option_editor"></textarea>\n\
</div>\n\
</td>\n\
<td class="text-center">\n\
<div class="offset-2 checkbox checkbox-success">\n\
<input id="is_answer_1" name="is_answer[]"  type="checkbox" value="0" onclick="isAnswermodal(1)">\n\
<label for="is_answer_1">Is Answer</label></div>\n\
<input type="hidden" name="hdn_isans[]" value="0" id="hdn_isans_1"></td>\n\
<td class="text-center">\n\
<button id="add-invoice-item" class="btn btn-info btn-sm" name="add-new-item" onclick="addQuestionOptionmodal(' +
        item +
        ')" type="button" style="margin: 0px 15px 15px;"><i class="fa fa-plus"> </i></button>\n\
</td>\n\
</tr>\n\
</tbody>\n\
</table>\n\
</div>'
    );
  } else if (questiontype == 3) {
    $(".loaddata_modal").html(
      '<div class="form-group col-sm-12">\n\
                    <label for="shortanswer" class="col-sm-4">Short Answer</label>\n\
                    <div class="col-sm-12">\n\
                        <textarea name="shortanswer" id="shortanswer" class="form-control shortanswer" rows="10" cols="80" required></textarea>\n\
                    </div>\n\
                </div>'
    );
  }
}

// var count = 2;
// var cnt = 1;
// limits = 500;
// ========== its for row add dynamically =============
("use strict");
function addQuestionOptionmodal(t) {
  if (count == limits) {
    alert("You have reached the limit of adding" + count + "inputs");
  } else {
    var ansCountNumber = 1; //$("#ansCountNumber").val();
    var isAnscount = +ansCountNumber + +cnt;
    var a = "option_text_" + count,
      e = document.createElement("tr");

    (e.innerHTML =
      "<td> <div id='" +
      a +
      "' class='" +
      count +
      "'>\n\
<textarea name='option_text[]' class='form-control option_editor' id='option_text_" +
      count +
      "'></textarea></div></td>\n\
<td class='text-center'> <div class='offset-2 checkbox checkbox-success'><input id='is_answer_" +
      isAnscount +
      "' name='is_answer[]'  type='checkbox' value='0' onclick='isAnswermodal(" +
      isAnscount +
      ")'><label for='is_answer_" +
      isAnscount +
      "'> Is Answer</label></div><input type='hidden' name='hdn_isans[]' value='0' id='hdn_isans_" +
      count +
      "'></td>\n\
<td class='text-center'><button style='text-align: right;' class='btn btn-sm btn-danger' type='button' onclick='deleteOptionmodalRow(this)'><i class='fa fa-minus'> </i></button></td>\n\
"),
      document.getElementById(t).appendChild(e),
      document.getElementById(a).focus();
    count++, cnt++;
  }
}

// ============= its for row delete dynamically =========
("use strict");
function deleteOptionmodalRow(t) {
  var a = $("#questionModal > tbody > tr").length;
  if (1 == a) {
    alert("There only one row you can't delete it.");
  } else {
    var e = t.parentNode.parentNode;
    e.parentNode.removeChild(e);
  }
}
// ============= its for isAnswermodal ==============


("use strict");
function isAnswermodal(sl) {
  if ($("#is_answer_" + sl).is(":checked")) {
    $("#is_answer_" + sl).attr("value", "1");
    $("#hdn_isans_" + sl).val(1);
  } else {
    $("#is_answer_" + sl).attr("value", "0");
    $("#hdn_isans_" + sl).val(0);
  }
}

function isAnswermodalRadio(sl) {

  if(sl==1){
    $("#is_answer_" + sl).attr("value", "1");
    $("#hdn_isans_" + sl).val(1);

    $("#is_answer_2").attr("value", "0");
    $("#hdn_isans_2").val(0);
    $("#is_answer_3").attr("value", "0");
    $("#hdn_isans_3").val(0);

  }else if(sl==2){
  
    $("#is_answer_" + sl).attr("value", "1");
    $("#hdn_isans_" + sl).val(1);
 
    $("#is_answer_1").attr("value", "0");
    $("#hdn_isans_1").val(0);
    $("#is_answer_3").attr("value", "0");
    $("#hdn_isans_3").val(0);

  }else{
    $("#is_answer_" + sl).attr("value", "1");
    $("#hdn_isans_" + sl).val(1);

    $("#is_answer_1").attr("value", "0");
    $("#hdn_isans_1").val(0);
    $("#is_answer_2").attr("value", "0");
    $("#hdn_isans_2").val(0);
  }
}

// ============== its for exam_delete =========
("use strict");
function exam_delete(exam_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/exam-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, exam_id: exam_id },
      success: function (r) {
        if (r == 0) {
          toastrErrorMsg(
            // "This exam already has been sale several times. You can’t delete its now."
            "Comming soon"
          );
        } else {
          toastrSuccessMsg("Deleted successfully");
        }
        location.reload();
      },
    });
  }
}

// =========== its for showExam ============
("use strict");
function showExam(exam_id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/show-examset",
    type: "POST",
    data: { exam_id: exam_id, csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      $(".modal_ttl").html("Exam Set");
      $("#info").html(r);
      $("#modal_info").modal("show");
    },
  });
}

//    ============= its for course restore ===========
("use strict");
function course_restore(course_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var r = confirm("Are you sure");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/course-restore",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, course_id: course_id },
      success: function (r) {
        if (r == 0) {
          toastrErrorMsg("It has some courses");
        } else {
          $("#coursearchivelist").DataTable().ajax.reload();
          setTimeout(function () {
            toastr.options = {
              closeButton: true,
              progressBar: true,
              showMethod: "slideDown",
              timeOut: 1500,
              onHidden: function () {
                // window.location.reload();
              },
            };
            toastr.success("Course restore successfully!");
          }, 1000);
        }
      },
    });
  }
}

// course type with course price
$("#coursesave_btn").hide();
$("body").on("change", "#course_type", function () {
  var type_id = $("#course_type").val();
  //  var pageURL = $('#v-pills-pricing-tab').attr("href");
  if (type_id == 2 || type_id == 3 || type_id == 4) {
    // $('#v-pills-pricing-tab').hide();
    $("#v-pills-pricing-tab").prop("disabled", true);
    $(".btnNext").hide();
    $("#coursesave_btn").show();
    $("#v-pills-pricing-tab").addClass("price_disable");
  } else {
    // $('#v-pills-pricing-tab').show();
    $("#v-pills-pricing-tab").prop("disabled", false);
    $("#v-pills-pricing-tab").removeClass("price_disable");
    $(".btnNext").show();
    $(".finishoff").hide();
  }
});

//============= its for exam inactive ===========
("use strict");
function examinactive(exam_id) {
  var d = confirm("Are you sure?");
  if (d == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/exam-inactive",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, exam_id: exam_id },
      success: function (r) {
        toastrSuccessMsg(r);
        // location.reload();
        $("#examlist").DataTable().ajax.reload();
      },
    });
  }
}
// //============= its for exam active ===========
("use strict");
function examactive(exam_id) {
  var d = confirm("Are you sure?");
  if (d == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/exam-active",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, exam_id: exam_id },
      success: function (r) {
        toastrSuccessMsg(r);
        // location.reload();
        $("#examlist").DataTable().ajax.reload();
      },
    });
  }
}

//============= its for faqsave =============
("use strict");
function faqsave(course_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var fd = new FormData();
  var mode = $("#mode").val();
  var id = $("#id").val();
  //    alert(mode);return false;
  if (mode == "edit") {
    var question = $("#edit_question").val();
    var answer = $("#edit_answer").val();
  } else {
    var question = $("#question").val();
    var answer = $("#answer").val();
  }

  if (question == "") {
    toastrErrorMsg("Question name must be required");
    $("#question").focus();
    return false;
  }
  if (answer == "") {
    toastrErrorMsg("Answer must be required");
    $("#answer").focus();
    return false;
  }

  fd.append("question", question);
  fd.append("answer", answer);
  fd.append("mode", mode);
  fd.append("id", id);

  //    fd.append("id", id);
  fd.append("csrf_test_name", CSRF_TOKEN);
  $.ajax({
    url: base_url + enterprise_shortname + "/faq-save",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      //            location.reload();toastrSuccessMsg(r);
      setTimeout(function () {}, 1000);
      $("#mode").val("");
      $("#question").val("");
      $("#answer").val("");
      $("#edit_question").val("");
      $("#edit_answer").val("");
      $("#myModal").modal("hide");
      $("#modal_info").modal("hide");
      $("#info").modal("hide");
      $("#faqlist").DataTable().ajax.reload();
    },
    //                    $("#enterpriselist").DataTable().ajax.reload();
  });
}

//========= its for faq faqedit ================
function faqedit(id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/faqedit-form",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, id: id },
    success: function (r) {
      $(".modal_ttl").html("FAQ Information");
      $("#info").html(r);
      $("#modal_info").modal("show");
    },
  });
}

//============== its for company_delete =========
("use strict");
function faq_delete(id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/faq-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, id: id },
      success: function (r) {
        toastrSuccessMsg(r);
        //        setTimeout(function () {}, 1000);
        $("#faqlist").DataTable().ajax.reload();
      },
    });
  }
}

(function ($) {
  "use strict";
  $(document).ready(function () {
    // ============= its for Archive list ===============
    var total_exam = $("#total_archive").val();
    var archivelist = $("#archivelist").DataTable({
      responsive: true,
      dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>tp",
      aaSorting: [[0, "desc"]],
      columnDefs: [
        {
          bSortable: true,
          aTargets: [0],
        },
        // {
        //   targets: 6,
        //   className: "text-center",
        // },
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
        [20, 50, 100, 150, 200, +total_exam],
        [20, 50, 100, 150, 200, "All"],
      ],
      processing: true,
      sProcessing: "<span class='fas fa-sync-alt'></span>",
      serverSide: true,
      serverMethod: "post",

      ajax: {
        url: base_url + enterprise_shortname + "/get-archivelist",
        data: function (data) {
          data.csrf_test_name = CSRF_TOKEN;
        },
      },

      columns: [
        { data: "sl" },
        { data: "name" },
        { data: "deleted_date" },
        { data: "deleted_by" },
        // { data: "action" }
      ],
    });
  });
})(jQuery);

$("#course_type").on("change", function () {
  var course_type = $(this).val();
  var myArray = course_type;
  var p = myArray.includes("1");
  var s = myArray.includes("2");
  var f = myArray.includes("3");
  var g = myArray.includes("4");
  if (
    (p && f) ||
    (p && g) ||
    (p && f && g) ||
    (s && f) ||
    (s && g) ||
    (s && f && g) ||
    (p && s && g) ||
    (p && s && f) ||
    (p && s && f && g)
  ) {
    toastr.error("invalid combination !");
    $("#course_type").val("");
    $(".placeholder-single").select2();
  }
});

//    ============= add sharepercent form ============
("use strict");
function sharepercent_form(course_id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/sharepercent-form",
    type: "POST",
    data: { course_id: course_id, csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      $(".modal_ttl").html("Instructor Share");
      $("#info").html(r);
      $("#modal_info").modal("show");
    },
  });
}

function getsignedagreementstatus(status){
//  alert(status);
  if(status == 4){
    $(".loadreason").html('<label for="" class="col-sm-2 col-form-label">Reason <i class="text-danger"> *</i></label>\n\
    <div class="col-sm-5">\n\
        <textarea id="agreement_reason" class="form-control" required autofocus></textarea>\n\
    </div>');
  }else{
    $(".loadreason").html('');
  }
}

//======= its for section save =============
("use strict");
function sharepercentsave() {
  var fd = new FormData();
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var course_id = $("#courseid").val();
  var share_percent = $("#share_percent").val();
  var certificate_id = $("#certificate_id").val();

  var tagstatus = 0;
  var toexplore = 0;
  var agreementstatus = 0;
  
  if ($("#recomended").is(":checked")) {
    var tagstatus = 1;
  } else if ($("#best_seller").is(":checked")) {
    var tagstatus = 2;
  } else if ($("#new").is(":checked")) {
    var tagstatus = 3;
  } else if ($("#popular").is(":checked")) {
    var tagstatus = 4;
  }

  if ($("#toexplore_yes").is(":checked")) {
    var toexplore = 1;
  } else if ($("#toexplore_yes").is(":checked")) {
    var toexplore = 0;
  }

  if ($("#approved").is(":checked")) {
    var agreementstatus = 2;
  } else if ($("#notapproved").is(":checked")) {
    var agreementstatus = 4;
  } else{
    var agreementstatus = 1;
  }
  // alert(agreementstatus); return false;
  var agreement_reason = $("#agreement_reason").val();
  // alert(agreement_reason); return false;
  if (
    tagstatus != 0 &&
    tagstatus != 1 &&
    tagstatus != 2 &&
    tagstatus != 3 &&
    tagstatus != 4
  ) {
    toastrErrorMsg("Empty field not allow!");
    return false;
  }

  var csrf_test_name = $("[name=csrf_test_name]").val();
  if (share_percent == "") {
    $("#share_percent").focus();
    toastrErrorMsg("Empty field not allow!");
    return false;
  }
  if (certificate_id == "") {
    $("#certificate_id").focus();
    toastrErrorMsg("Certificate assign required!");
    return false;
  }

  // fd.append("docusign", $("#docusign")[0].files[0]);
  // fd.append("old_docusign", $("#old_docusign").val());

  fd.append("certificate_id", certificate_id);
  fd.append("course_id", course_id);
  fd.append("share_percent", share_percent);
  fd.append("tagstatus", tagstatus);
  fd.append("toexplore", toexplore);
  fd.append("agreementstatus", agreementstatus);
  fd.append("agreement_reason", agreement_reason);

  fd.append("csrf_test_name", CSRF_TOKEN);
  // tagstatus_form(course_id);return false;
  $.ajax({
    url: base_url + enterprise_shortname + "/sharepercent-save",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      // toastr.success("Added successfully!");
      $("#modal_info").modal("hide");
      // tagstatus_form(course_id);
      $("#coursedatatablelist").DataTable().ajax.reload();
    },
  });
}

//    ============= add tagstatus form ============
("use strict");
function tagstatus_form(course_id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/tagstatus-form",
    type: "POST",
    data: { course_id: course_id, csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      $(".modal_ttl").html("Tag Status & To Explore");
      $("#info").html(r);
      $("#modal_info").modal("show");
    },
  });
}

// ("use strict");
// function tagstatussave(course_id) {
//   $.ajax({
//     url: base_url + enterprise_shortname + "/tagstatus-save",
//     type: "POST",
//     data: {
//       csrf_test_name: CSRF_TOKEN,
//       course_id: course_id,
//       tagstatus: tagstatus,
//       toexplore: toexplore,
//     },
//     success: function (r) {
//       toastrSuccessMsg(r);
//       $("#modal_info").modal("hide");
//       // location.reload();
//     },
//   });
// }
// =============== its for  file type check ===============
function filetypecheck(fileid) {
  var allowedTypes = [
    "application/pdf",
    "application/msword",
    "application/vnd.ms-office",
    "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    "image/jpeg",
    "image/png",
    "image/jpg",
    "image/gif",
  ];

  // var file = this.files[0];
  var file = $("#" + fileid)[0].files[0];
  var fileType = file.type;
  if (!allowedTypes.includes(fileType)) {
    alert("Please select a valid file (PDF/DOC/DOCX/JPEG/JPG/PNG/GIF).");
    $("#" + fileid).val("");
    return false;
  }
}

function courseagreement(fileid) {
  filetypecheck(fileid);
  var fd = new FormData();

  fd.append("docusign", $("#docusign")[0].files[0]);

  fd.append("courseid", $("#courseid").val());
  fd.append("old_docusign", $("#old_docusign").val());
  fd.append("csrf_test_name", CSRF_TOKEN);

  $.ajax({
    type: "POST",
    url: base_url + enterprise_shortname + "/course-agreement-paperupload",
    // data: new FormData(this),
    data: fd,
    contentType: false,
    cache: false,
    processData: false,

    error: function () {
      $("#uploadStatus").html(
        '<p style="color:#EA4335;">File upload failed, please try again.</p>'
      );
    },
    success: function (resp) {
      console.log(resp);
      if (resp == "ok") {
        $("#uploadStatus").html(
          '<p style="color:#28A74B;">File has uploaded successfully!</p>'
        );
        $(".progress-area").html(
          '<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">100%</div></div>'
        );
      } else if (resp == "err") {
        $(".progress-area").html("");
        $("#uploadStatus").html(
          '<p style="color:#EA4335;">Please select a valid file to upload.</p>'
        );
      }
    },
  });
}

("use strict");
function projectassignmentForm(course_id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/projectassignment-form",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, course_id: course_id },
    success: function (r) {
      $(".modal_ttl").html("Project Assignment");
      $("#info").html(r);
      $("#modal_info").modal("show");
      $(".placeholder-single").select2();
    },
  });
}
("use strict");
function assignmentprojectEdit(course_id, id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/projectassignment-editform",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, course_id: course_id, id: id },
    success: function (r) {
      $(".modal_ttl").html("Project Assignment Edit Information");
      $("#info").html(r);
      $("#modal_info").modal("show");
      $(".placeholder-single").select2();
    },
  });
}

// ============== its for assignmentprojectDelete =========
function assignmentprojectDelete(id) {
  var r = confirm("Are you sure");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/assignmentproject-delete",
      type: "POST",
      data: {
        csrf_test_name: CSRF_TOKEN,
        id: id,
      },
      success: function (r) {
        if (r == 0) {
          toastrErrorMsg("Not Possible");
        } else {
          toastrSuccessMsg("Deleted successfully");
        }
        location.reload();
      },
    });
  }
}

// ============== its for category_wise_subcategory ===============
("use strict");
function category_wise_subcategory(category_id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/category-wise-subcategory",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      category_id: category_id,
      enterprise_id: enterprise_id,
    },
    success: function (r) {
      $("#subcategory_id").html(r);
    },
  });
}

// lesson video upload
var f_duration = 0;
document
  .getElementById("audio")
  .addEventListener("canplaythrough", function (e) {
    f_duration = Math.round(e.currentTarget.duration);
    //  convert duration hour min sec
    convertHMS(f_duration);
    document.getElementById("f_du").value = f_duration;
    URL.revokeObjectURL(obUrl);
  });
var obUrl;
document
  .getElementById("lesson_vfile")
  .addEventListener("change", function (e) {
    var file = e.currentTarget.files[0];
    //check file extension for audio/video type
    if (file.name.match(/\.(avi|mp3|mp4|mpeg|ogg)$/i)) {
      obUrl = URL.createObjectURL(file);
      document.getElementById("audio").setAttribute("src", obUrl);
    }
  });

function convertHMS(value) {
  const sec = parseInt(value, 10); // convert value to number if it's string
  let hours = Math.floor(sec / 3600); // get hours
  let minutes = Math.floor((sec - hours * 3600) / 60); // get minutes
  let seconds = sec - hours * 3600 - minutes * 60; //  get seconds
  // add 0 if value < 10; Example: 2 => 02
  if (hours < 10) {
    hours = "0" + hours;
  }
  if (minutes < 10) {
    minutes = "0" + minutes;
  }
  if (seconds < 10) {
    seconds = "0" + seconds;
  }
  let convertime = hours + ":" + minutes + ":" + seconds; // Return is HH : MM : SS
  $("#duration").val(convertime);
}

$("#loader-icondddddd").hide();

// $('.fileuploader').change(function () {
//     event.preventDefault();
//     var  base_url=$('#base_url').val();
//     $("#phppot-message").removeClass("error");
//     $("#phppot-message").removeClass("success");
//     $("#phppot-message").text("");
//     $("#btnUpload").hide();
//     $("#loader-icondddddd").show();
//     $("#RemoveLessonButton").hide();
//     var video_file = $("#lesson_vfile").val();
//     var CSRF_TOKEN = $("#CSRF_TOKEN").val();
//     var enterprise_shortname = $("#enterprise_shortname").val();
//     var fd = new FormData();
//     fd.append("video_file", $("#lesson_vfile")[0].files[0]);
//     fd.append('csrf_test_name', (CSRF_TOKEN));
//     $.ajax({
//         url :base_url + enterprise_shortname + "/lesson-video-upload",
//         type : "POST",
//         dataType : 'json',
//         data : fd,
//         contentType : false,
//         processData : false,
//         success : function(data) {
//             $("#loader-icondddddd").hide();
//             if (data.type == "error") {
//                 $("#btnUpload").show();
//                 $("#loader-icondddddd").hide();
//                 $("#phppot-message").addClass("error");
//                 $("#phppot-message").text(data.error_message);
//                 toastr.success(data.error_message);
//             } else if (data.type == "success") {
//                 $("#btnUpload").show();
//                 $("#loader-icondddddd").hide();
//                 // $("#phppot-message").addClass("success");
//                 // $("#phppot-message").text("Video uploaded. " + data.link);
//                 toastr.success("Video Upload successfully");
//                 let str=data.link;
//                 myArr = str.split("/");
//                 video_id=myArr[3];
//                 $('#provider_url').val(data.link);
//                 $("#RemoveLessonButton").show();

//             }
//         }
//     });
// });

function lessonhandleFileSelect(evt) {
  var control = evt;
  lessonupdateProgress(0);
  document.getElementById("progress-container_lesson").style.display = "block";
  $("#RemoveLessonButton").hide();
  var video_name = $("#lesson_name").val();
  var description = $("#lesson_summary").val();

  var video = document.createElement("video");
  video.preload = "metadata";
  video.onloadedmetadata = function () {
    window.URL.revokeObjectURL(video.src);
    // alert("Duration : " + video.duration + " seconds");
    convertHMS(video.duration);
  };
  video.src = URL.createObjectURL(control.files[0]);

  /* Instantiate Vimeo Uploader */
  new VimeoUpload({
    name: video_name,
    description: description,
    file: $("#lesson_vfile")[0].files[0],
    token: "9934bd59f90bb90c5b4b3526cdfa78c9",
    onError: function (data) {
      showsMessage(JSON.parse(data).error, "error");
    },
    onProgress: function (data) {
      lessonupdateProgress(data.loaded / data.total);
    },
    onComplete: function (videoId, index) {
      var url = "https://vimeo.com/" + videoId;
      $("#provider_url").val(url);
      showsMessage("Lesson video uploaded successfully", "success");
    },
  }).upload();

  /* local function: show a user message */
  function showsMessage(html, type) {
    /* hide progress bar */
    document.getElementById("progress-container_lesson").style.display = "none";
    $("#RemoveLessonButton").show();
    toastr.success("Lesson video uploaded successfully");
  }
}

function lessonupdateProgress(progress) {
  progress = Math.floor(progress * 100);
  var element = document.getElementById("progress_lesson");
  element.setAttribute("style", "width:" + progress + "%");
  element.innerHTML = "&nbsp;" + progress + "%";
}

function cancel_lesson_video() {
  var csrf_test_name = $('[name="csrf_test_name"]').val();
  var vurl = $("#provider_url").val();
  var vID = vurl.split("/");
  var videoID = vID[3];
  var url = $("#base_url").val();
  var enterprise_shortname = $("#enterprise_shortname").val();
  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: url + enterprise_shortname + "/instructor-delete-video",
      type: "POST",
      data: { video_id: videoID, csrf_test_name: csrf_test_name },
      success: function (data) {
        toastr.success(data);
        document.getElementById("lesson_delete_content").style.display = "none";
        $("#provider_url").val("");
        $("#oldprovider_url").val("");

        $("#video_preview").html("");
      },
      error: function (xhr) {
        alert("failed!");
      },
    });
  }
}

function pricecalculation() {
  var discount = $("#discount").val();
  var oldprice = $("#oldprice").val();
  var discount_type = $("#discount_type").val();
  var price = oldprice;
  if (discount_type == 1) {
    var price = oldprice - discount;
  } else if (discount_type == 2) {
    var price = oldprice - (oldprice * discount) / 100;
  }
  $("#price").val(price);
}

function course_preview(course_id) {
  // var csrf_test_name = $('[name="csrf_test_name"]').val();
  // alert(base_url);
  // alert(enterprise_shortname);
  // alert(CSRF_TOKEN);

  $.ajax({
    url: base_url + enterprise_shortname + "/course-preview",
    type: "POST",
    data: {
      course_id: course_id,
      csrf_test_name: CSRF_TOKEN,
    },
    success: function (data) {
      $("#exampleModalLabel").text("Course Preview");
      $(".previewdetails").html(data);
      $("#preview_modal").modal("show");
    },
    error: function (xhr) {
      alert("failed!");
    },
  });
}

// ============= its for uploadCV ==============
function fileuploaderprogress(sl, fileid, msgscls, progressclss) {
  // filetypecheck(fileid);
  // $('#zone_id').trigger('change');
  
  $("body").on("change", "#"+fileid, function (e) {
    var filename = e.target.files[0].name;
    $(".filename-"+sl).text(filename);
  });

  var allowedTypes = [
    "application/pdf",
    "application/msword",
    "application/vnd.ms-office",
    "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    "application/vnd.openxmlformats-officedocument.presentationml.presentation",
    "image/jpeg",
    "image/png",
    "image/jpg",
    "image/gif",
    "image/svg+xml",
    "text/plain",
  ];
  var lesson_type = $("#lesson_type").val();
  var file = $("#" + fileid)[0].files[0];
  var fileType = file.type;
  var fileTyperesult = fileType.split('/');
  
  // alert(fileType);
  // alert(fileTyperesult[0]);
  if(lesson_type == 2){
    if(fileType != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
      toastrErrorMsg("Only docx file allow!");
      return false;
    }
  }
  if(lesson_type == 3){
    if(fileTyperesult[0] != 'image'){
      toastrErrorMsg("Only picture file allow!");
      return false;
    }
  }
  if(lesson_type == 4){
    if(fileType != 'application/vnd.openxmlformats-officedocument.presentationml.presentation'){
      toastrErrorMsg("Only power point file allow!");
      return false;
    }
  }
  if(lesson_type == 5){
    if(fileType != 'application/pdf'){
      toastrErrorMsg("Only pdf file allow!");
      return false;
    }
  }
  // alert(fileType); return false;

  if (!allowedTypes.includes(fileType)) {
    toastrWarningMsg(
      "Please select a valid file (PDF/DOC/DOCX/JPEG/JPG/PNG/GIF/TEXT)."
    );
    $("#" + fileid).val("");
    return false;
  } else {
    // var f = target.files[0].name;
    // alert(f);
    $("." + msgscls).html(
      '<p style="color:#28A74B;">File has attach successfully!</p>'
    );
    $("." + progressclss).html(
      '<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">100%</div></div>'
    );
  }
}

function resourcefileuploaderprogress(sl, fileid, msgscls, progressclss) {
  // filetypecheck(fileid);
  // alert(sl);
  $("body").on("change", "#"+fileid, function (e) {
    var filename = e.target.files[0].name;
    $(".res-filename-"+sl).text(filename);
  });
  
  var allowedTypes = [
    "application/pdf",
    "application/msword",
    "application/vnd.ms-office",
    "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    "image/jpeg",
    "image/png",
    "image/jpg",
    "image/gif",
    "text/plain",
    "image/svg+xml",
  ];
  
  var file = $("#" + fileid)[0].files[0];
  var fileType = file.type;
  var fileTyperesult = fileType.split('/');
  // alert(fileid);
  // alert(msgscls);
  // alert(progressclss);

  if (!allowedTypes.includes(fileType)) {
    toastrWarningMsg(
      "Please select a valid file (PDF/DOC/DOCX/JPEG/JPG/PNG/GIF/TEXT)."
    );
    $("#" + fileid).val("");
    return false;
  } else {
    $("." + msgscls).html(
      '<p style="color:#28A74B;">File has attach successfully!</p>'
    );
    $("." + progressclss).html(
      '<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">100%</div></div>'
    );
  }
}



("use strict");
var r = resource_sl;
function appendAddresource() {
  var resource_sl = $("#resource_sl").val();
 
  var resource_sl = +resource_sl+ +1;
  $("#resource_sl").val(resource_sl);
  // var attachment = '"attachment", "uploadStatus", "progress-area"';
  var attachment = ''+resource_sl+', "resource_'+resource_sl+'", "resource-uploadStatus-'+resource_sl+'", "resource-progress-area-'+resource_sl+'"';
  // alert(resource_sl);
  // r++;
  // var outcomes = $('[name="career_outcomes[]"]').length;
  // var career_out = "carrer-out-" + resource_sl;
  // var cls = '"carrer-out"';
  // var msgcls = '"career-msgcount"';

  // if (outcomes >= 4) {
  //   toastrWarningMsg("You can not add more than four career outcome");
  //   return false;
  // } else {
    $("#resource_area").append(
      "<div class='row mt-2'>\n\
          <div class='col-sm-10'>\n\
              <input type='file' name='resource[]' id='resource_"+resource_sl+"' onchange='fileuploaderprogress("+attachment+")' class='custom-input-file'>\n\
              <label for='resource_"+resource_sl+"'><i class='fa fa-upload'></i><span class='filename-"+resource_sl+"'>Choose a file ...</span></label>\n\
              <br>\n\
              <div class='resource-uploadStatus-"+resource_sl+" col-sm-8'></div>\n\
              <div class='resource-progress-area-"+resource_sl+" col-sm-8 mb-3'></div>\n\
          </div>\n\
          <div class='col-sm-2'>\n\
              <button type='button' class='btn btn-danger btn-sm custom_btn mt-2' name='button' onclick='removeResource(this)'> <i class='fa fa-minus'></i> </button>\n\
          </div>\n\
      </div>\n\
      ");
  // }
}

("use strict");
function removeResource(careeroutcomeElem) {
  $(careeroutcomeElem).parent().parent().remove();
}
