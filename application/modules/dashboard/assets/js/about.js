(function ($) {
  "use strict";
  $(document).ready(function () {
    var usertype = $("#usertype").val();
    var CSRF_TOKEN = $("#CSRF_TOKEN").val();
    var base_url = $("#base_url").val();
    var enterprise_shortname = $("#enterprise_shortname").val();
    var enterprise_id = $("#enterprise_id").val();

    var segment3 = $("#segment3").val();
    // alert(segment3);
    // if (uri == 58) {
    //   $("#v-pills-menu_58-tab").trigger("click");
    // }
    if (segment3 == 1) {
      $("#v-pills-menu_1-tab").trigger("click");
    } else if (segment3 == 2) {
      $("#v-pills-menu_2-tab").trigger("click");
    } else if (segment3 == 3) {
      $("#v-pills-menu_3-tab").trigger("click");
    }

    var about_id = $("#about_id").val();
    var choose_datalist = $("#choose_datalist").DataTable({
      responsive: true,
      // aaSorting: [[0, "desc"]],
      columnDefs: [
        {
          bSortable: true,
          aTargets: [0],
        },
        {
          bSortable: false,
          targets: [2, 3],
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
      ],

      lengthMenu: [
        [20, 50, 100, 150, 200, 250],
        [20, 50, 100, 150, 200, "All"],
      ],
      processing: true,
      sProcessing: "<span class='fas fa-sync-alt'></span>",
      serverSide: true,
      serverMethod: "post",

      ajax: {
        url: base_url + enterprise_shortname + "/get-choosenlist",
        data: function (data) {
          data.csrf_test_name = CSRF_TOKEN;
          data.about_id = about_id;
        },
      },

      columns: [
        { data: "sl" },
        { data: "choose_title" },
        { data: "picture" },
        { data: "action" },
      ],
    });

    var service_datalist = $("#service_datalist").DataTable({
      responsive: true,
      // aaSorting: [[0, "desc"]],
      columnDefs: [
        {
          bSortable: true,
          aTargets: [0],
        },
        {
          bSortable: false,
          targets: [2, 3],
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
      ],

      lengthMenu: [
        [20, 50, 100, 150, 200, 250],
        [20, 50, 100, 150, 200, "All"],
      ],
      processing: true,
      sProcessing: "<span class='fas fa-sync-alt'></span>",
      serverSide: true,
      serverMethod: "post",

      ajax: {
        url: base_url + enterprise_shortname + "/get-aboutservicelist",
        data: function (data) {
          data.csrf_test_name = CSRF_TOKEN;
          data.about_id = about_id;
        },
      },

      columns: [
        { data: "sl" },
        { data: "service_title" },
        { data: "service_logo" },
        { data: "action" },
      ],
    });
  });
})(jQuery);

// var usertype = $("#usertype").val();
// var CSRF_TOKEN = $("#CSRF_TOKEN").val();
// var base_url = $("#base_url").val();
// var enterprise_shortname = $("#enterprise_shortname").val();
// var enterprise_id = $("#enterprise_id").val();

("use strict");
var choose = 1;
function appendwhychooselogo() {
  choose++;
  var outcomes = $('[name="career_outcomes[]"]').length;
  var chooselogo = "aboutfileValueOne(this, 'chooselogo', " + choose + ")";
  // alert(chooselogo);
  if (outcomes >= 4) {
    toastrWarningMsg("You can not add more than four");
    return false;
  } else {
    $("#chooselogo_area").append(
      '<div class="form-group row m-r">\n\
        <div class="col-sm-5">\n\
              <div class="d-flex mt-2">\n\
                  <div class="flex-grow-1 pr-3">\n\
                      <div class="form-group">\n\
                          <input type="text" class="form-control" name="choose_title[]" id="choose_title" placeholder="Title">\n\
                      </div>\n\
                  </div>\n\
              </div>\n\
          </div>\n\
          <div class="col-sm-3">\n\
              <div class="d-flex mt-2">\n\
                  <div class="flex-grow-1 pr-3">\n\
                      <div class="form-group">\n\
                          <input type="file" class="form-control" name="chooselogo[]" id="chooselogo" onchange="' +
        chooselogo +
        '">\n\
                          <span class="text-danger mt-5">File size 320*183 </span>\n\
                      </div>\n\
                  </div>\n\
              </div>\n\
          </div>\n\
          <div class="col-sm-2">\n\
              <img id="image-preview-chooselogo-' +
        choose +
        '" src="" class="border border-' +
        choose +
        '" width="180px">\n\
          </div>\n\
      <div class="col-sm-1">\n\
          <button type="button" class="btn btn-danger btn-sm custom_btn m-t-10" name="button" onclick="removewhychooselog(this)">\n\
              <i class="fa fa-minus"></i> </button>\n\
      </div>\n\
    </div>'
    );
  }
}

("use strict");
function removewhychooselog(chooselogoElem) {
  $(chooselogoElem).parent().parent().remove();
}

// image preview js
function aboutfileValueOne(value, sectionval, sl) {
  // all old preview image hide
  var path = value.value;
  var extenstion = path.split(".").pop();
  if (
    extenstion == "jpg" ||
    extenstion == "svg" ||
    extenstion == "jpeg" ||
    extenstion == "png" ||
    extenstion == "gif" ||
    extenstion == "webp"
  ) {
    document.getElementById("image-preview-" + sectionval + "-" + sl).src =
      window.URL.createObjectURL(value.files[0]);
    var filename = path
      .replace(/^.*[\\\/]/, "")
      .split(".")
      .slice(0, -1)
      .join(".");
    // document.getElementById("filename").innerHTML = filename;
  } else {
    alert(
      "File not supported. Kindly Upload the Image of below given extension "
    );
  }
}

("use strict");
function appendService() {
  var outcomes = $('[name="subtitle[]"]').length;
  if (outcomes >= 4) {
    toastrWarningMsg("You can not add more than four");
    return false;
  } else {
    $("#service_area").append(
      '<div class="d-flex mt-2">\n\
        <div class="flex-grow-1 pr-3">\n\
            <div class="form-group">\n\
                <input type="text" class="form-control" name="subtitle[]" id="subtitle" placeholder="Subtitle">\n\
            </div>\n\
        </div>\n\
        <div class="col-sm-1">\n\
            <button type="button" class="btn btn-danger btn-sm custom_btn m-t-0" name="button" onclick="removeService(this)">\n\
                <i class="fa fa-minus"></i> </button>\n\
        </div>\n\
    </div>'
    );
  }
}

("use strict");
function removeService(chooselogoElem) {
  $(chooselogoElem).parent().parent().remove();
}

//========== its for aboutchoose edit =============
function aboutchoose_edit(id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/aboutchoose-edit",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, id: id },
    success: function (r) {
      $(".modal_ttlour").html("Our Feature Information");
      $("#infoour").html(r);
      $("#modal_infoour").modal("show");
    },
  });
}

//========== its for aboutchoose update info update =============
("use strict");
function aboutchoose_update(id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var fd = new FormData();
  var choose_id = $("#choose_id").val();
  var title = $("#edit_title").val();
  var old_logo = $("#old_logo").val();
  fd.append("logo", $("#edit_chooselogo")[0].files[0]);
  fd.append("title", title);
  fd.append("old_logo", old_logo);
  fd.append("choose_id", choose_id);
  fd.append("csrf_test_name", CSRF_TOKEN);
  if (title == "") {
    $("#edit_title").focus();
    toastrErrorMsg("Title must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }

  $.ajax({
    url: base_url + enterprise_shortname + "/aboutchoose-infoupdate",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      setTimeout(function () {}, 1000);
      $("#edit_title").val("");
      $("#modal_infoour").modal("hide");
      $("#infoour").modal("hide");
      $("#choose_datalist").DataTable().ajax.reload();
    },
  });
}

//========== its for our feature info delete =============
function aboutchoose_delete(id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/aboutchoose-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, id: id },
      success: function (r) {
        toastrSuccessMsg(r);
        $("#choose_datalist").DataTable().ajax.reload();
      },
    });
  }
}

//========== its for aboutservice edit =============
function aboutservice_edit(id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/aboutservice-edit",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, id: id },
    success: function (r) {
      $(".modal_ttlour").html("Update Information");
      $("#infoour").html(r);
      $("#modal_infoour").modal("show");
    },
  });
}

("use strict");
function appendEditService() {
  var edit_outcomes = $('[name="edit_subtitle[]"]').length;
  
  if (edit_outcomes >= 4) {
    toastrWarningMsg("You can not add more than four");
    return false;
  } else {
    $("#editservice_area").append(
      '<div class="d-flex mt-2">\n\
        <div class="flex-grow-1 pr-3">\n\
            <div class="form-group">\n\
                <input type="text" class="form-control" name="edit_subtitle[]" id="edit_subtitle" placeholder="Subtitle">\n\
            </div>\n\
        </div>\n\
        <div class="col-sm-1">\n\
            <button type="button" class="btn btn-danger btn-sm custom_btn m-t-0" name="button" onclick="removeService(this)">\n\
                <i class="fa fa-minus"></i> </button>\n\
        </div>\n\
    </div>'
    );
  }
}
appendEdotService;

//========== its for aboutchoose update info update =============
// ("use strict");
// function aboutchoose_update(id) {
//   var productmode = $("#productmode").val();
//   if (productmode == "demo") {
//     toastrWarningMsg("It is disabled for demo mode!");
//     return false;
//   }

//   var fd = new FormData();
//   var choose_id = $("#choose_id").val();
//   var title = $("#edit_title").val();
//   var old_logo = $("#old_logo").val();
//   fd.append("logo", $("#edit_chooselogo")[0].files[0]);
//   fd.append("title", title);
//   fd.append("old_logo", old_logo);
//   fd.append("choose_id", choose_id);
//   fd.append("csrf_test_name", CSRF_TOKEN);
//   if (title == "") {
//     $("#edit_title").focus();
//     toastrErrorMsg("Title must be required!");
//     setTimeout(function () {}, 1000);
//     return false;
//   }

//   $.ajax({
//     url: base_url + enterprise_shortname + "/aboutchoose-infoupdate",
//     type: "POST",
//     data: fd,
//     enctype: "multipart/form-data",
//     processData: false,
//     contentType: false,
//     success: function (r) {
//       toastrSuccessMsg(r);
//       setTimeout(function () {}, 1000);
//       $("#edit_title").val("");
//       $("#modal_infoour").modal("hide");
//       $("#infoour").modal("hide");
//       $("#choose_datalist").DataTable().ajax.reload();
//     },
//   });
// }

//========== its for about service delete =============
function aboutservice_delete(id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/aboutservice-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, id: id },
      success: function (r) {
        toastrSuccessMsg(r);
        $("#service_datalist").DataTable().ajax.reload();
      },
    });
  }
}
