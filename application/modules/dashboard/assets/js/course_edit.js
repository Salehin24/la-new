(function ($) {
  "use strict";
  $(document).ready(function () {
    $("body").on("click", ".btnNext", function () {
      $(".nav-pills .active").parent().next("li").find("a").trigger("click");
    });
    $("body").on("click", ".btnPrevious", function () {
      $(".nav-pills .active").parent().prev("li").find("a").trigger("click");
    });

    //        ======= checkbox is_free  ==========
    $("body").on("click", "#is_free", function () {
      if ($("#is_free").is(":checked")) {
        $("#is_free").attr("value", "1");
        $(".dependent_freecourse").html("");
        $(".dependent_discountcourse").hide();
      } else {
        $(".dependent_freecourse").html(
          "<div class='form-group row'>\n\
         <label for='price' class='col-sm-2'>Price </label>\n\
       <div class='col-sm-6'>\n\
        <input name='price' class='form-control' type='text' placeholder='Price' id='price' onkeyup='onlynumber_allow(this.value,'price')'>\n\
        </div>\n\
        </div>\n\
<div class='form-group row'><label for='oldprice' class='col-sm-2'>Old Price</label><div class='col-sm-6'> <input name='oldprice' class='form-control' type='text' placeholder='Old Price' id='oldprice' onkeyup='onlynumber_allow(this.value, 'oldprice')'></div></div>\n\
 <div class='form-group row'>\n\
    <div class='offset-2 checkbox checkbox-success'>\n\
        <input id='is_discount' name='is_discount' type='checkbox' value='0'>\n\
        <label for='is_discount'>Is Discount</label>\n\
    </div>\n\
</div>"
        );
        $("#is_free").attr("value", "0");
        //  $('.dependent_discountcourse').show();
      }
    });
    //        ======= checkbox is discount  ==========
    $("body").on("click", "#is_discount", function () {
      if ($("#is_discount").is(":checked")) {
        $(".dependent_discountcourse").show();
        $("#defaultdiscountoff").hide();

        // $("#is_discount").attr("value", "1");
        $(".dependent_discountcourse").html(
          "<div class='form-group row'>\n\
          <label for='discount_type' class='col-sm-2'>Discount Type </label>\n\
          <div class='col-sm-6'>\n\
              <select class='form-control placeholder-single' id='discount_type' onchange='pricecalculation()'>\n\
                  <option value=''>-- select one -- </option>\n\
                  <option value='1'>Fixed</option>\n\
                  <option value='1'>Percent</option>\n\
              </select>\n\
          </div>\n\
          </div>\n\
          <div class='form-group row'>\n\
                <label for='discount' class='col-sm-2'>Discount</label>\n\
                <div class='col-sm-6'>\n\
                    <input name='discount' class='form-control' type='number'\n\
                        placeholder='Discount' id='discount' onkeyup='pricecalculation()'>\n\
                </div>\n\
            </div>"
        );
        $("#is_discount").attr("value", "1");
      } else {
        $("#is_discount").attr("value", "0");
        $("#defaultdiscountoff").hide();
        $(".dependent_discountcourse").html("");
        var oldprice = $("#oldprice").val();
        $("#price").val(oldprice);
      }
    });

    //        ======= checkbox is offer  ==========
    $("body").on("click", "#is_offer", function () {
      var offercourse_hiddenvalue = $("#offercourse_hiddenvalue").val();
      if ($("#is_offer").is(":checked")) {
        $(".dependent_offercourse").show();
        $("#defaultofferoff").hide();
        $("#is_offer").attr("value", "1");
        $(".dependent_offercourse").html(
          "<div class='form-group row'>\n\
                <label for='discount' class='col-sm-2'>offer</label>\n\
                <div class='col-sm-6'>\n\
                <select name='offer_courseid[]' class='form-control placeholder-single' id='offer_courseid' data-placeholder='-- select one --' multiple>\n\
                <option value=''>-- select one --</option>\n\
                " +
            offercourse_hiddenvalue +
            "\n\
            </select>\n\
                </div>\n\
            </div>\n\
            <div class='form-group row'>\n\
                <label for='offer_courseprice' class='col-sm-2'>Course Price</label>\n\
                <div class='col-sm-6'>\n\
                    <input name='offer_courseprice' class='form-control' type='number' id='offer_courseprice'>\n\
                </div>\n\
            </div>\n\
            "
        );
        $("#is_offer").attr("value", "1");
      } else {
        $("#offer_courseid").val("");
        $("#offer_courseprice").val("");
        $("#defaultofferoff").hide();
        $(".dependent_offercourse").html("");
      }
      $(".placeholder-single").select2();
    });

    //       ============ its for is popular value add ============
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

    //        ========== its for disabled demo mode =============
    $("body").on("click", "#courseupdate_btn", function () {
      var productmode = $("#productmode").val();
      if (productmode == "demo") {
        toastrWarningMsg("It is disabled for demo mode!");
        return false;
      }

      var name = $("#name").val();
      var category_id = $("#category_id").val();
      var faculty_id = $("#faculty_id").val();
      var is_free = $("#is_free").val();
      var oldprice = $("#oldprice").val();
      var price = $("#price").val();
      var course_level = $("#course_level").val();
      var course_type = $("#course_type").val();
      var course_provider = $("#course_provider").val();
      var url = $("#url").val();
      var thumbnail = $("#thumbnail").val();
      var is_discount = $("#is_discount").val();
      var discount = $("#discount").val();
      var discount_type = $("#discount_type").val();

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
      if (course_type == 1) {
      if(oldprice == ''){
        toastrErrorMsg("Base price must be required!");
        $("#oldprice").focus();
        return false;
      }
    }

      if (is_discount == 1) {
        if (discount == "") {
          toastrErrorMsg("Discount must be required!");
          $("#discount").focus();
          return false;
        }
        if (discount == '0') {
          toastrErrorMsg("Discount value must be greater than Zero!");
          $("#discount").val('').focus();
          return false;
        }
        if (discount_type == '') {
          toastrErrorMsg("Discount type must be required!");
          $("#discount_type").val('').focus();
          return false;
        }

      }

      var old_thumbnail = $("#old_thumbnail").val();
      var old_cover_thumbnail = $("#old_cover_thumbnail").val();
      var old_hover_thumbnail = $("#old_hover_thumbnail").val();

      if (old_thumbnail == "") {
        var inp = document.getElementById("thumbnail");
        if (inp.files.length == 0) {
          toastrErrorMsg("Course Mini Thumbnail  must be required!");
          inp.focus();
          return false;
        }
      }

      if (old_cover_thumbnail == "") {
        var cover = document.getElementById("cover_thumbnail");
        if (cover.files.length == 0) {
          toastrErrorMsg("Course Cover Thumbnail  must be required!");
          cover.focus();
          return false;
        }
      }

      if (old_hover_thumbnail == "") {
        var hover = document.getElementById("hover_thumbnail");
        if (covehoverr.files.length == 0) {
          toastrErrorMsg("Course Hover Thumbnail  must be required!");
          hover.focus();
          return false;
        }
      }
    });
  });
})(jQuery);

var CSRF_TOKEN = $("#CSRF_TOKEN").val();
var base_url = $("#base_url").val();
var enterprise_shortname = $("#enterprise_shortname").val();
var enterprise_id = $("#enterprise_id").val();

("use strict");
var req = 1;
function appendpreRequirement() {
  req++;
  var requirement = "requirement-"+ req;
  var cls = '"requirement"';
  var msgcls = '"requirement-msgcount"';
  $("#requirement_area").append(
    "<div class='d-flex mt-2'>\n\
            <div class='flex-grow-1 pr-3'>\n\
            <div class='form-group'>\n\
            <input type='text' class='form-control "+requirement+"' onkeyup='characterlimitation("+cls+", "+req+", 40, "+msgcls+")' name='requirements[]' id='requirements' placeholder='Pre Requisites'>\n\
            <span class='text-danger'>Only <span class='requirement-msgcount-"+req+"'>40</span> characters remaining</span>\n\
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
  var outcomes = "outcomes-"+ outc;
  var cls = '"outcomes"';
  var msgcls = '"outcomes-msgcount"';
  $("#outcomes_area").append(
    "<div class='d-flex mt-2'>\n\
    <div class='flex-grow-1 pr-3'>\n\
    <div class='form-group'>\n\
    <input type='text' class='form-control "+outcomes+"' onkeyup='characterlimitation("+cls+", "+outc+", 40, "+msgcls+")' name='benifits[]' id='outcomes' placeholder='What you will learn'>\n\
    <span class='text-danger'>Only <span class='outcomes-msgcount-"+outc+"'>40</span> characters remaining</span>\n\
    </div></div><div class='col-sm-1'>\n\
      <button type='button' class='btn btn-danger btn-sm custom_btn m-t-0'  name='button' onclick='removeOutcome(this)'> <i class='fa fa-minus'></i> </button>\n\
    </div>\n\
    </div>"
  );
}
("use strict");
function removeOutcome(outcomeElem) {
  $(outcomeElem).parent().parent().remove();
}


("use strict");
var co = 1;
function appendCareeroutcome() {
  co++;
  var career_out = "carrer-out-"+ co;
  var cls = '"carrer-out"';
  var msgcls = '"career-msgcount"';
  var career_outcomes = $('[name="career_outcomes[]"]').length;
  if(career_outcomes >=4){
    toastrWarningMsg('You can not add more than four career outcomes');
    return false;
       }else{
    $("#careeroutcome_area").append(
      "<div class='d-flex mt-2'>\n\
            <div class='flex-grow-1'>\n\
            <div class='form-group'>\n\
            <input type='text' class='form-control "+career_out+"' onkeyup='characterlimitation("+cls+", "+co+", 40, "+msgcls+")' name='career_outcomes[]' id='career_outcomes' placeholder='Learner Career Outcome'>\n\
            <span class='text-danger'>Only <span class='career-msgcount-"+co+"'>40</span> characters remaining</span>\n\
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
  var skillsgain_count = "skillsgain-"+ skg;
  var cls = '"skillsgain"';
  var msgcls = '"skillsgain-msgcount"';
  
  if(skillsgain >=4){
    toastrWarningMsg('You can not add more than four skills gain');
    return false;
       }else{
    $("#skillsgain_area").append(
      "<div class='d-flex mt-2'>\n\
            <div class='flex-grow-1'>\n\
            <div class='form-group'>\n\
            <input type='text' class='form-control "+skillsgain_count+"' onkeyup='characterlimitation("+cls+", "+skg+", 20, "+msgcls+")' name='skillsgain[]' id='skillsgain' placeholder='Skills you will gain'>\n\
            <span class='text-danger'>Only <span class='skillsgain-msgcount-"+skg+"'>20</span> characters remaining</span>\n\
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
  var related_resource = $('[name="related_resource[]"]').length;
  if(related_resource >=4){
    toastrWarningMsg('You can not add more than four related resource');
    return false;
       }else{
  $("#relatedresource_area").append(
    "<div class='d-flex mt-2'>\n\
            <div class='flex-grow-1 pr-3'>\n\
            <div class='form-group'>\n\
            <input type='text' class='form-control' name='related_resource[]' id='related_resource' placeholder='Related Resource'>\n\
            </div>\n\
            </div>\n\
            <div class='col-sm-1'>\n\
            <button type='button' class='btn btn-danger btn-sm custom_btn m-t-0' name='button' onclick='removeRelatedresource(this)'> <i class='fa fa-minus'></i> </button>\n\
            </div>\n\
            </div>"
  );
       }
}

("use strict");
function removeRelatedresource(relatedresourceElem) {
  $(relatedresourceElem).parent().parent().remove();
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
//    ============= add section form ============
("use strict");
function addsection_form(course_id, mode) {
  $.ajax({
    url: base_url + enterprise_shortname + "/addsection-form",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, course_id: course_id, mode: mode },
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
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var course_id = $("#courseid").val();
  var section_name = $("#section_name").val();
  if (section_name == "") {
    toastrErrorMsg("Empty field not allow!");
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/section-save",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      course_id: course_id,
      section_name: section_name,
    },
    success: function (r) {
      toastrSuccessMsg(r);
      location.reload();
    },
  });
}
//    ================== its for section_edit ===========
("use strict");
function section_edit(section_id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/editsection-form",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, section_id: section_id },
    success: function (r) {
      $(".modal_ttl").html("Section Update");
      $("#info").html(r);
      $("#modal_info").modal("show");
    },
  });
}

//    ============== its for section delete ==============
("use strict");
function section_delete(section_id) {
  var course_id = $("#course_id").val();
  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/section-delete",
      type: "POST",
      data: {
        csrf_test_name: CSRF_TOKEN,
        section_id: section_id,
        course_id: course_id,
      },
      success: function (r) {
        if (r == 0) {
          toastrErrorMsg(
            "This course already has been sale several times. You can’t delete its lesson or sessions now."
          );
        } else {
          toastrSuccessMsg("Deleted successfully");
        }
        location.reload();
      },
    });
  }
}


//    ============= add lesson form ============
("use strict");
function addlesson_form(course_id) {
  // alert(course_id);
  $.ajax({
    url: base_url + enterprise_shortname + "/addlesson-form",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, course_id: course_id },
    success: function (r) {
      $(".modal_ttl").html("Lesson Information");
      $("#info").html(r);
      $("#modal_info").modal("show");
      $(".placeholder-single").select2();
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
function lessonupdate(lesson_id) {
  var fd = new FormData();
  var lesson_name = $("#lesson_name").val();
  var course_id = $("#course_id").val();
  var section_id = $("#section_id").val();
  var lesson_type = $("#lesson_type").val();
  var lesson_provider = $("#lesson_provider").val();
  var attachment = $("#attachment").val();
  var provider_url = $("#provider_url").val();
  var duration = $("#duration").val();
  var summary = $("#lesson_summary").val();
  var description = CKEDITOR.instances["lesson_description"].getData();
  var is_preview = $("#is_preview").val();
  var lessontype_status = $("#lessontype_status").val();

  // var resource_files = $('input[name="resource[]"]').length;
  // alert(resource_files); return false;

  // alert(description);return false;
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
  // alert(resource_files);return false;
  for (var i = 0; i < resource_files.length; i++) {
    var resourceid = resource_files[i].getAttribute("id");
    fd.append("resourcefile[]", $("#" + resourceid)[0].files[0]);
  }
  fd.append("resource_length", resource_files.length);

  fd.append("lesson_id", lesson_id);
  fd.append("course_id", course_id);
  fd.append("csrf_test_name", CSRF_TOKEN);

  $.ajax({
    url: base_url + enterprise_shortname + "/lesson-update",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      // console.log(r);
      toastr.success(r);
      location.reload();
    },
  });
}
//    ============= its for lesson delete ============
("use strict");
function lesson_delete(lesson_id) {
  var course_id = $("#course_id").val();
  var r = confirm("Are you sure");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/lesson-delete",
      type: "POST",
      data: {
        csrf_test_name: CSRF_TOKEN,
        lesson_id: lesson_id,
        course_id: course_id,
      },
      success: function (r) {
        if (r == 0) {
          toastrErrorMsg(
            "This course already has been sale several times. You can’t delete its lesson or sessions now."
          );
        } else {
          toastrSuccessMsg("Deleted successfully");
        }
        location.reload();
      },
    });
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


// ============= its for uploadCV ==============
function fileuploaderprogress(sl, fileid, msgscls, progressclss) {
  // filetypecheck(fileid);

  $("body").on("change", "#"+fileid, function (e) {
    var filename = e.target.files[0].name;
    $(".filename-"+sl).text(filename);
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
    "image/svg+xml",
  ];

  var file = $("#" + fileid)[0].files[0];
  var fileType = file.type;
  if (!allowedTypes.includes(fileType)) {
    toastrWarningMsg(
      "Please select a valid file (PDF/DOC/DOCX/JPEG/JPG/PNG/GIF)."
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

//    ============== its for course resource delete ==============
("use strict");
function deletecourseResource(id) {
  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/resource-delete",
      type: "POST",
      data: {
        csrf_test_name: CSRF_TOKEN,
        id: id,
      },
      success: function (r) {
        var div = document.getElementById("resource-deleted-sl-" + id);
        div.parentNode.removeChild(div);
        toastrSuccessMsg("Deleted successfully");
        // location.reload();
      },
    });
  }
}
//    ============== its for resource delete ==============
("use strict");
function deletelessonResource(id) {
  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/resource-delete",
      type: "POST",
      data: {
        csrf_test_name: CSRF_TOKEN,
        id: id,
      },
      success: function (r) {
        // if (r == 0) {
        //   toastrErrorMsg(
        //     "This course already has been sale several times. You can’t delete its lesson or sessions now."
        //   );
        // } else {
        //   toastrSuccessMsg("Deleted successfully");
        // }
        var div = document.getElementById("resource-deleted-sl-" + id);
        div.parentNode.removeChild(div);
        toastrSuccessMsg("Deleted successfully");
        // location.reload();
      },
    });
  }
}

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
  var section_id = $("#section_id").val();
  var exam_id = $("#exam_id").val();

  // if (lesson_id == "") {
  //   toastrErrorMsg("Lesson name must be required!");
  //   return false;
  // }
  if (section_id == "") {
    toastrErrorMsg("Section name must be required!");
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

// course type with course price
$(".one_hide").prop("disabled", true);
$(".one_hide").addClass("price_disable");
$(".finishnext").hide();
$(".submitbtn_first").hide();
$("body").on("change", "#course_type", function () {
  var type_id = $("#course_type").val();

  var myArray = type_id;
  if ($.inArray("1", myArray) >= 0) {
    $("#v-pills-pricing-tab").prop("disabled", false);
    $("#v-pills-pricing-tab").removeClass("price_disable");
    $(".finishnext").show();
    $("#courseupdate_btn").hide();
  } else {
    $("#v-pills-pricing-tab").prop("disabled", true);
    $("#v-pills-pricing-tab").addClass("price_disable");
    $(".finishnext").hide();
    $("#courseupdate_btn").show();
    $(".pricenext").hide();
  }
});

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
    $(".placeholder-single").select2();
    $("#course_type").val("");
  }
});

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


function pricecalculation(){
  var discount = $("#discount").val();
  var oldprice = $("#oldprice").val();
  var discount_type = $("#discount_type").val();
  var price = oldprice;
  if(discount_type == 1){
    var price = (oldprice-discount);
  }else if(discount_type == 2){
    var price = (oldprice - (oldprice * discount) / 100);
  }
  $("#price").val(price);
}
