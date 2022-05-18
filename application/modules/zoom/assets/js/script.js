//all js

//================= live streming start=============
$(document).ready(function () {
  var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var usertype = $("#usertype").val();
  var base_url = $("#base_url").val();
  var enterprise_shortname = $("#enterprise_shortname").val();
  var enterprise_id = $("#enterprise_id").val();

  $("body").on("change", "#thumbnail", function (e) {
    var filename = e.target.files[0].name;
    $(".thumbnail-filename").text(filename);
  });

  $("body").on("change", "#cover_thumbnail", function (e) {
    var filename = e.target.files[0].name;
    $(".cover-filename").text(filename);
  });


  

  var zoom_api_key = $("#zoom_api_key").val();
  var zoom_api_secret = $("#zoom_api_secret").val();
  var meetingID = $("#meetingID").val();
  var name = $("#name").val();
  var meeting_password = $("#meeting_password").val();
  var leaveUrl = $("#leaveUrl").val();
  var segment_3 = $("#segment_3").val();
  if (segment_3 == "host") {
    document.onkeydown = function (e) {
      if (event.keyCode == 123) {
        return false;
      }
      if (e.ctrlKey && e.shiftKey && e.keyCode == "I".charCodeAt(0)) {
        return false;
      }
      if (e.ctrlKey && e.shiftKey && e.keyCode == "C".charCodeAt(0)) {
        return false;
      }
      if (e.ctrlKey && e.shiftKey && e.keyCode == "J".charCodeAt(0)) {
        return false;
      }
      if (e.ctrlKey && e.keyCode == "U".charCodeAt(0)) {
        return false;
      }
    };

    ZoomMtg.preLoadWasm();
    ZoomMtg.prepareJssdk();
    var meetConfig = {
      apiKey: zoom_api_key,
      apiSecret: zoom_api_secret,
      meetingNumber: meetingID,
      userName: name,
      passWord: meeting_password,
      leaveUrl: leaveUrl,
      role: parseInt(1, 10), //5 for host assistant
    };
    // console.log(meetConfig);
    var signature = ZoomMtg.generateSignature({
      meetingNumber: meetConfig.meetingNumber,
      apiKey: meetConfig.apiKey,
      apiSecret: meetConfig.apiSecret,
      role: meetConfig.role,
      success: function (res) {
        console.log(res.result);
        ZoomMtg.getAttendeeslist({});
            ZoomMtg.getCurrentUser({
              success: function (res) {
                console.log("success getCurrentUser", res.result.currentUser);
              },
            });
      },
    });

    ZoomMtg.init({
      leaveUrl: meetConfig.leaveUrl,
      isSupportAV: true,
      success: function () {
        ZoomMtg.join({
          meetingNumber: meetConfig.meetingNumber,
          userName: meetConfig.userName,
          signature: signature,
          apiKey: meetConfig.apiKey,
          passWord: meetConfig.passWord,
          success: function (res) {
            $("#nav-tool").hide();
          },
          error: function (res) {
            console.log(res);
          },
        });
      },
      error: function (res) {
        alert(res);
        console.log(res);
      },
    });
  }

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
  //    ============ its for is popular value add ============
  $("body").on("click", "#is_popular", function () {
    if ($("#is_popular").is(":checked")) {
      $("#is_popular").attr("value", "1");
    } else {
      $("#is_popular").attr("value", "0");
    }
  });

  
});

//================= live streming close=============


var CSRF_TOKEN = $("#CSRF_TOKEN").val();
var usertype = $("#usertype").val();
var base_url = $("#base_url").val();
var enterprise_shortname = $("#enterprise_shortname").val();
var enterprise_id = $("#enterprise_id").val();
// =========== is_freeshowhide =============
("use strict");
function is_freeshowhide() {
  $(".dependent_freecourse").slideUp();
  $("#price").val("");
  $("#is_discount").prop("checked", false);
  $("#discount").val("");
}
("use strict");
function getJoinModal(id) {
  var base_url = $("#base_url").val();
    // alert(id);
  $.ajax({
    url: base_url + "zoom/zoomcontroler/joinModal",
    type: "POST",
    data: { meeting_id: id, enterprise_id : enterprise_id, enterprise_shortname : enterprise_shortname},
    dataType: "html",
    success: function (data) {
      $(".modal_title").html("Join Live Meeting");
      $("#meeting_info").html(data);
      $("#meeting_modalinfo").modal("show");
    },
  });
}

"use strict";
function loadlivejoin(meeting_id, record_id, enterprise_id, enterprise_shortname){
    // alert(CSRF_TOKEN);return false;
  $.ajax({
    url: base_url + "zoom/zoomcontroler/loadlivejoin",
    type: "POST",
    data: {csrf_test_name: CSRF_TOKEN, meeting_id: meeting_id, live_id : record_id, enterprise_id : enterprise_id, enterprise_shortname : enterprise_shortname},
    dataType: "html",
    success: function (data) {
      $("#loadliveevent").html(data);
    },
  });
}

//=========== its for live host modal ===============
("use strict");
function viewHost(id) {
  var base_url = $("#base_url").val();
  $.ajax({
    url: base_url + "zoom/zoomcontroler/viewHost",
    type: "POST",
    data: { meeting_id: id, enterprise_id : enterprise_id, enterprise_shortname : enterprise_shortname},
    dataType: "html",
    success: function (data) {
      $(".modal_ttl").html("Live Meeting Host");
      $("#info").html(data);
      $("#modal_info").modal("show");
    },
  });
}

//======== its for get_meetingedit ===========
("use strict");
function get_meetingedit(meetingid) {
  var base_url = $("#base_url").val();
  $.ajax({
    url: base_url + "meeting-edit",
    type: "POST",
    data: { meetingid: meetingid },
    dataType: "html",
    success: function (data) {
      $(".modal_ttl").html("Meeting Update");
      $("#info").html(data);
      $("#modal_info").modal("show");
    },
  });
}

//========== its for meeting delete =============
("use strict");
function meeting_delete(meetingid) {
  var base_url = $("#base_url").val();
  var r = confirm("Are you sure?");
  // alert(CSRF_TOKEN);return false;
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname +"/meeting-delete",
      type: "POST",
      data: { 'csrf_test_name': CSRF_TOKEN, meetingid: meetingid},
      dataType: "html",
      success: function (data) {
        location.reload();
      },
    });
  }
}

("use strict");
function appendRequirement() {
  $("#requirement_area").append(
    "<div class='d-flex mt-2'>\n\
            <div class='flex-grow-1 px-3'>\n\
            <div class='form-group'>\n\
            <input type='text' class='form-control' name='requirements[]' id='requirements' placeholder='Course Requirements'>\n\
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
function appendOutcome() {
  $("#outcomes_area").append(
    '<div class="d-flex mt-2">\n\
        <div class="flex-grow-1 px-3">\n\
        <div class="form-group">\n\
        <input type="text" class="form-control" name="benifits[]" id="outcomes" placeholder="What you will learn">\n\
        </div></div><div class="">\n\
        <button type="button" class="btn btn-danger btn-sm custom_btn  m-t-0" name="button" onclick="removeOutcome(this)"> <i class="fa fa-minus"></i> </button>\n\
        </div>\n\
        </div>'
  );
}
("use strict");
function removeOutcome(outcomeElem) {
  $(outcomeElem).parent().parent().remove();
}




  var total_livecourse = $("#total_livecourse").val();
  var livecoursedatatablelist = $("#livecoursedatatablelist").DataTable({
    responsive: true,
    "dom": "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>tp",
    aaSorting: [
      [0, "desc"]
    ],
    columnDefs: [{
      bSortable: false,
      aTargets: [0]
    },
    {
      targets: 5,
      className: "text-center",
    },
    ],
    buttons: [{
      extend: "copy",
      className: "btn-sm",
      className: "btn-success"
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
      [50, 100, 150, 200, +total_livecourse],
      [50, 100, 150, 200, "All"],
    ],
    processing: true,
    serverSide: true,
    serverMethod: "post",

    ajax: {
      url: base_url + enterprise_shortname + "/livecourse-datalist",
      data: function (data) {
        data.csrf_test_name = CSRF_TOKEN;
      },
    },

    columns: [
      { data: "sl" },
      { data: "course_name" },
      { data: "category_name" },
      { data: "price" },
      { data: "totalsales" },
      { data: "action" },
    ],
  });

  // ================ its for live event course =================
  var total_livecourse = $("#total_liveevent").val();
  var livecoursedatatablelist = $("#liveeventdatatablelist").DataTable({
    responsive: true,
    "dom": "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>tp",
    aaSorting: [
      [0, "desc"]
    ],
    columnDefs: [{
      bSortable: true,
      aTargets: [0]
    },
    {
      bSortable: false,
      targets: 5,
      className: "text-center",
    },
    ],
    buttons: [{
      extend: "copy",
      className: "btn-sm",
      className: "btn-success"
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
      [50, 100, 150, 200, +total_livecourse],
      [50, 100, 150, 200, "All"],
    ],
    processing: true,
    serverSide: true,
    serverMethod: "post",

    ajax: {
      url: base_url + enterprise_shortname + "/liveevent-datalist",
      data: function (data) {
        data.csrf_test_name = CSRF_TOKEN;
      },
    },

    columns: [
      { data: "sl" },
      { data: "name" },
      { data: "category_name" },
      { data: "price" },
      // { data: "totalsales" },
      { data: "total_participant"},
      { data: "action" },
    ],
  });
  // ============ close =================



var CSRF_TOKEN = $("#CSRF_TOKEN").val();
var usertype = $("#usertype").val();
var base_url = $("#base_url").val();
var enterprise_shortname = $("#enterprise_shortname").val();
var enterprise_id = $("#enterprise_id").val();

//=========== its for livecourse delete ============
// "use strict";
// function livecourse_delete(courseid) {
//   var r = confirm("Are you sure?");

//   if (r == true) {
//     $.ajax({
//       url: base_url +enterprise_shortname+'/live-course-delete',
//       type: 'POST',
//       data: { 'courseid': courseid },
//       dataType: "html",
//       success: function (data) {
        
//         setTimeout(function () {
//           toastr.options = {
//             closeButton: true,
//             progressBar: true,
//             showMethod: 'slideDown',
//             timeOut: 1500,
//           };
//           toastr.success("Deleted successfully!");
//         }, 1000);
//         location.reload();
//       }
//     });
//   }
// }
"use strict";
function livecourse_delete(courseid) {
  var productmode = $("#productmode").val();
  if (productmode == 'demo') {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $('#CSRF_TOKEN').val();
  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/live-course-delete",
      type: "POST",
      data: { 'csrf_test_name': CSRF_TOKEN, 'courseid': courseid },
      success: function (r) {
        toastrErrorMsg(r);
        location.reload();
      }
    });
  }
}
"use strict";
function liveevent_delete(courseid) {
  var productmode = $("#productmode").val();
  if (productmode == 'demo') {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $('#CSRF_TOKEN').val();
  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/live-event-delete",
      type: "POST",
      data: { 'csrf_test_name': CSRF_TOKEN, 'courseid': courseid },
      success: function (r) {
        toastrErrorMsg(r);
        location.reload();
      }
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






$("body").on("click", "#coursesave_btn", function () {
  // var productmode = $("#productmode").val();
  // if (productmode == "demo") {
  //   toastrWarningMsg("It is disabled for demo mode!");
  //   return false;
  // }

  var name = $("#name").val();
  var is_livecourse = $("#is_livecourse").val();
  var faculty_id = $("#faculty_id").val();
  var start_date = $("#start_date").val();
  var end_date = $("#end_date").val();
  var start_time = $("#start_time").val();
  var end_time = $("#end_time").val();


  var meeting_id = $("#meeting_id").val();
  var meeting_password = $("#meeting_password").val();


  var category_id = $("#category_id").val();
  // var faculty_id = $("#faculty_id").val();
  var is_free = $("#is_free").val();
  var price = $("#price").val();
  var course_id = $("#course_id").val();
 
  // var course_level = $("#course_level").val();
  // var course_type = $("#course_type").val();
  // var course_provider = $("#course_provider").val();
  // var url = $("#url").val();
  // var thumbnail = $("#thumbnail").val();
  // var is_discount = $("#is_discount").val();
  // var discount = $("#discount").val();
  
  if (name == "") {
    toastrErrorMsg("Name  required");
    return false;
  }
  if (is_livecourse == "") {
    toastrErrorMsg("Event type  required");
    return false;
  }
  if (faculty_id == "") {
    toastrErrorMsg("Instructor  required");
    return false;
  }
  if (meeting_id == "") {
    toastrErrorMsg("Event ID required");
    return false;
  }
  if (meeting_password == "") {
    toastrErrorMsg("Event password required");
    return false;
  }
  if (start_date == "") {
    toastrErrorMsg("Start date  required");
    return false;
  }
  if (end_date == "") {
    toastrErrorMsg("End date  required");
    return false;
  }
  if (start_time == "") {
    toastrErrorMsg("Start time  required");
    return false;
  }
  
  if (end_time == "") {
    toastrErrorMsg("End time  required");
    return false;
  }
  
  if (category_id == "") {
    toastrErrorMsg("Category required");
    return false;
  }
  if (course_id == undefined){
    // if(course_id ==" "){
          var inp = document.getElementById("thumbnail");
          if (inp.files.length == 0) {
            toastrErrorMsg("Featured Image required!");
            inp.focus();
            return false;
          }
          var cover = document.getElementById("cover_thumbnail");
          if (cover.files.length == 0) {
            toastrErrorMsg("Cover Image  required!");
            cover.focus();
            return false;
          }  
    
      // }
  }




  if (price == "" && is_free == 0) {
    toastrErrorMsg("Price or free  required");
    return false;
  }
  // var hover = document.getElementById("hover_thumbnail");
  // if (covehoverr.files.length == 0) {
  //   toastrErrorMsg("Course Hover Thumbnail  must be required!");
  //   hover.focus();
  //   return false;
  // }
});


