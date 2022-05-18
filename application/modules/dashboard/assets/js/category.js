(function ($) {
  "use strict";
  $(document).ready(function () {
    var CSRF_TOKEN = $("#CSRF_TOKEN").val();
    var enterprise_shortname = $("#enterprise_shortname").val();
    var enterprise_id = $("#enterprise_id").val();
    var base_url = $("#base_url").val();

    var total_category = $("#total_category").val();
    var categorydatatablelist = $("#categorylist").DataTable({
      responsive: false,
      dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>tp",
      aaSorting: [[0, "desc"]],
      columnDefs: [
        {
          bSortable: true,
          aTargets: [0],
        },
        {
          bSortable: false,
          targets: 7,
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
        [20, 50, 100, 150, 200, +total_category],
        [20, 50, 100, 150, 200, "All"],
      ],
      processing: true,
      sProcessing: "<span class='fas fa-sync-alt'></span>",
      serverSide: true,
      serverMethod: "post",

      ajax: {
        url: base_url + enterprise_shortname + "/get-categorylist",
        data: function (data) {
          data.csrf_test_name = CSRF_TOKEN;
        },
      },

      columns: [
        { data: "sl" },
        { data: "name" },
        { data: "ordering" },
        { data: "created_date" },
        { data: "created_by" },
        { data: "updated_date" },
        { data: "updated_by" },
        { data: "action" },
      ],
    });

    var total_subcategory = $("#total_subcategory").val();
    var categorydatatablelist = $("#subcategorylist").DataTable({
      responsive: false,
      dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>tp",
      aaSorting: [[0, "desc"]],
      columnDefs: [
        {
          bSortable: true,
          aTargets: [0],
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
        [20, 50, 100, 150, 200, +total_subcategory],
        [20, 50, 100, 150, 200, "All"],
      ],
      processing: true,
      sProcessing: "<span class='fas fa-sync-alt'></span>",
      serverSide: true,
      serverMethod: "post",

      ajax: {
        url: base_url + enterprise_shortname + "/get-subcategorylist",
        data: function (data) {
          data.csrf_test_name = CSRF_TOKEN;
        },
      },

      columns: [
        { data: "sl" },
        { data: "subcategory" },
        { data: "category_name" },
        { data: "ordering" },
        { data: "created_date" },
        { data: "created_by" },
        { data: "updated_date" },
        { data: "updated_by" },
        { data: "action" },
      ],
    });

    var total_categoryarchive = $("#total_categoryarchive").val();
    var categoryarchivelist = $("#categoryarchivelist").DataTable({
      responsive: true,
      dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>tp",
      // aaSorting: [[0, "desc"]],
      // columnDefs: [
      //   {
      //     bSortable: false,
      //     aTargets: [0],
      //   },
      //   {
      //     targets: 4,
      //     className: "text-center",
      //   },
      // ],
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
        [20, 50, 100, 150, 200, +total_categoryarchive],
        [20, 50, 100, 150, 200, "All"],
      ],
      processing: true,
      sProcessing: "<span class='fas fa-sync-alt'></span>",
      serverSide: true,
      serverMethod: "post",

      ajax: {
        url: base_url + enterprise_shortname + "/get-categoryarchivelist",
        data: function (data) {
          data.csrf_test_name = CSRF_TOKEN;
        },
      },

      columns: [
        { data: "sl" },
        { data: "category_name" },
        { data: "parent_category" },
        { data: "created_date" },
        { data: "created_by" },
        { data: "updated_date" },
        { data: "updated_by" },
        { data: "deleted_date" },
        { data: "deleted_by" },
        { data: "action" },
      ],
    });

    $("body").on("change", "#image", function (e) {
      var filename = e.target.files[0].name;
      $(".filename").text(filename);
    });

  });
})(jQuery);

var CSRF_TOKEN = $("#CSRF_TOKEN").val();
var base_url = $("#base_url").val();
var enterprise_shortname = $("#enterprise_shortname").val();
var enterprise_id = $("#enterprise_id").val();

("use strict");
function toastrErrorMsg(r) {
  setTimeout(function () {
    toastr.options = {
      closeButton: true,
      progressBar: true,
      showMethod: "slideDown",
      timeOut: 1500,
    };
    toastr.error(r);
  }, 1000);
}
//            ========= its for toastr error message =============
("use strict");
function toastrSuccessMsg(r) {
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
    toastr.success(r);
  }, 1000);
}
("use strict");
function category_save() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var fd = new FormData();
  var name = $("#name").val();
  var parent_id = ''; //$("#parent_id").val();
  var ordering = $("#ordering").val();
  var category_type = $("#category_type").val();
  // var commission = $("#commission").val();
  // var base_url = $("#base_url").val();
  var csrf_test_name = $("[name=csrf_test_name]").val();

  if ($(".is_popular:checked").val()) {
    var is_popular = 1;
  } else {
    var is_popular = 0;
  }

  if (name == "") {
    $("#name").focus();
    toastrErrorMsg("Category name must be required");
    return false;
  }
  if (category_type == "") {
    $("#category_type").focus();
    toastrErrorMsg("category type name must be required");
    return false;
  }
  // if (commission == "") {
  //   $("#commission").focus();
  //   toastrErrorMsg("Commission must be required");
  //   return false;
  // }
  fd.append("image", $("#image")[0].files[0]);
  fd.append("name", $("#name").val());
  fd.append("parent_id", parent_id);
  fd.append("ordering", ordering);
  fd.append("category_type", $("#category_type").val());
  // fd.append("commission", $("#commission").val());
  fd.append("is_popular", is_popular);
  fd.append("csrf_test_name", csrf_test_name);

  $.ajax({
    url: base_url + enterprise_shortname + "/category-save",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      if (r == 0) {
        toastrErrorMsg("This category name already exists!");
        return false;
      } else if(r == 1) {
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
          toastr.success("Category save successfully!");
        }, 1000);
      }
    },
  });
}
("use strict");
function subcategory_save() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var fd = new FormData();
  var name = $("#sub_name").val();
  var parent_id = $("#parent_id").val();
  var ordering = $("#sub_ordering").val();
  var category_type = $("#sub_category_type").val();
  var csrf_test_name = $("[name=csrf_test_name]").val();

  if ($(".is_popular:checked").val()) {
    var is_popular = 1;
  } else {
    var is_popular = 0;
  }

  if (name == "") {
    $("#sub_name").focus();
    toastrErrorMsg("Sub category name must be required");
    return false;
  }
  if (parent_id == "") {
    $("#parent_id").focus();
    toastrErrorMsg("Category name must be required");
    return false;
  }

  if (category_type == "") {
    $("#category_type").focus();
    toastrErrorMsg("category type name must be required");
    return false;
  }
  
  fd.append("image", $("#sub_image")[0].files[0]);
  fd.append("name", $("#sub_name").val());
  fd.append("parent_id", $("#parent_id").val());
  fd.append("ordering", ordering);
  fd.append("category_type", category_type);
  fd.append("is_popular", is_popular);
  fd.append("csrf_test_name", csrf_test_name);

  $.ajax({
    url: base_url + enterprise_shortname + "/category-save",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      if (r == 0) {
        toastrErrorMsg("This sub category name already exists!");
        return false;
      } else if(r == 1) {
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
          toastr.success("Sub category save successfully!");
        }, 1000);
      }
    },
  });
}
//=============== its for category update ===============
("use strict");
function category_update(category_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var fd = new FormData();
  var name = $("#name").val();
  var parent_id = $("#parent_id").val();
  var ordering = $("#ordering").val();
  var category_type = $("#category_type").val();
  // var commission = $("#commission").val();
  var csrf_test_name = $("[name=csrf_test_name]").val();
  // var base_url = $("#base_url").val();
  // alert(parent_id); return false; 
  if ($(".is_popular:checked").val()) {
    var is_popular = 1;
  } else {
    var is_popular = 0;
  }

  if (name == "") {
    $("#firstname").focus();
    toastrErrorMsg("Category name must be required");
    return false;
  }
  if (category_type == "") {
    $("#category_type").focus();
    toastrErrorMsg("category type name must be required");
    return false;
  }
  fd.append("image", $("#image")[0].files[0]);
  fd.append("name", $("#name").val());
  fd.append("parent_id", $("#parent_id").val());
  fd.append("ordering", ordering);
  fd.append("category_type", $("#category_type").val());
  // fd.append("commission", $("#commission").val());
  fd.append("is_popular", is_popular);
  fd.append("category_id", category_id);
  fd.append("csrf_test_name", csrf_test_name);

  $.ajax({
    url: base_url + enterprise_shortname + "/category-update",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      if(parent_id){
        setTimeout(function () {
          toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: "slideDown",
            timeOut: 1500,
            onHidden: function () {
              document.location.href =
                base_url + enterprise_shortname + "/subcategory";
            },
          };
          toastr.success(r);
        }, 1000);
      }else{
        setTimeout(function () {
          toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: "slideDown",
            timeOut: 1500,
            onHidden: function () {
              document.location.href =
                base_url + enterprise_shortname + "/category";
            },
          };
          toastr.success(r);
        }, 1000);
      }
    },
  });
}
//    ============= its for category_delete ===========
("use strict");
function category_delete(category_id) {
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
      url: base_url + enterprise_shortname + "/category-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, category_id: category_id },
      success: function (r) {
        if (r == 0) {
          toastrErrorMsg("It has some courses");
        } else {
          $("#categorylist").DataTable().ajax.reload();
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
            toastr.success("Category deleted successfully!");
          }, 1000);
        }
      },
    });
  }
}
//    ============= its for category restore ===========
("use strict");
function category_restore(category_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var r = confirm("Are you sure");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/category-restore",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, category_id: category_id },
      success: function (r) {
        if (r == 0) {
          toastrErrorMsg("It has some courses");
        } else {
          $("#categoryarchivelist").DataTable().ajax.reload();
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
            toastr.success("Category restore successfully!");
          }, 1000);
        }
      },
    });
  }
}
//============== its for category_search ============
// ("use strict");
// function category_search(category) {
//   var base_url = $("#base_url").val();
//   var CSRF_TOKEN = $("#CSRF_TOKEN").val();
//   $.ajax({
//     url: base_url + "category-search",
//     type: "POST",
//     data: { csrf_test_name: CSRF_TOKEN, category: category },
//     success: function (r) {
//       $(".result_load").html(r);
//     },
//   });
// }

//============ its for checkfileExtesion ===========
("use strict");
function checkfileExtesion() {
  var base_url = $("#base_url").val();
  var fileExtension = ["jpeg", "jpg", "png", "gif", "bmp"];
  if (
    $.inArray(
      $("#image").val().split(".").pop().toLowerCase(),
      fileExtension
    ) == -1
  ) {
    toastrErrorMsg("Only formats are allowed : " + fileExtension.join(", "));
    return false;
  }
}

//============= its for category inactive ===========
("use strict");
function categoryinactive(category_id) {
  var d = confirm("Are you sure?");
  
  if (d == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/category-inactive",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, category_id: category_id },
      success: function (r) {
        toastrSuccessMsg(r);
        // location.reload();
        $("#categorylist").DataTable().ajax.reload();
      },
    });
  }
}

//============= its for category active ===========
("use strict");
function categoryactive(category_id) {
  var d = confirm("Are you sure?");
  if (d == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/category-active",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, category_id: category_id },
      success: function (r) {
        toastrSuccessMsg(r);
        // location.reload();
        $("#categorylist").DataTable().ajax.reload();
      },
    });
  }
}
//============= its for sub category inactive ===========
("use strict");
function subcategoryinactive(category_id) {
  var d = confirm("Are you sure?");
  
  if (d == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/category-inactive",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, category_id: category_id },
      success: function (r) {
        toastrSuccessMsg(r);
        // location.reload();
        $("#subcategorylist").DataTable().ajax.reload();
      },
    });
  }
}

//============= its for category active ===========
("use strict");
function subcategoryactive(category_id) {
  var d = confirm("Are you sure?");
  if (d == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/category-active",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, category_id: category_id },
      success: function (r) {
        toastrSuccessMsg(r);
        // location.reload();
        $("#subcategorylist").DataTable().ajax.reload();
      },
    });
  }
}

function assignordering(id, ordervalue){
  $.ajax({
    url: base_url + enterprise_shortname + "/category-ordering-update",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, id : id, ordervalue : ordervalue },
    success: function (r) {
      // console.log(r);
      toastrSuccessMsg(r);
      // $("#categorylist").DataTable().ajax.reload();
    },
  });
}
function assignsubcategoryordering(id, ordervalue){
  $.ajax({
    url: base_url + enterprise_shortname + "/category-ordering-update",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, id : id, ordervalue : ordervalue },
    success: function (r) {
      // console.log(r);
      toastrSuccessMsg(r);
      // $("#subcategorylist").DataTable().ajax.reload();
    },
  });
}
