(function ($) {
  "use strict";
  $(document).ready(function () {
    var usertype = $("#usertype").val();
    var CSRF_TOKEN = $("#CSRF_TOKEN").val();
    var base_url = $("#base_url").val();
    var enterprise_shortname = $("#enterprise_shortname").val();
    var enterprise_id = $("#enterprise_id").val();

    //        ========== its start for when submit to save use php then auto click the ===============
    var uri = $("#uri").val();
    // alert(uri);
    if (uri == 58) {
      $("#v-pills-menu_58-tab").trigger("click");
    }
    if (uri == 62) {
      $("#v-pills-menu_62-tab").trigger("click");
    }
    if (uri == 63) {
      $("#v-pills-menu_63-tab").trigger("click");
    }
    if (uri == 64) {
      $("#v-pills-menu_64-tab").trigger("click");
    }
    if (uri == 65) {
      $("#v-pills-menu_65-tab").trigger("click");
    }
    if (uri == 84) {
      $("#v-pills-menu_84-tab").trigger("click");
    }
    // if (uri == 7) {
    //   $("#v-pills-menu_13-tab").trigger("click");
    // }
    // if (uri == 30) {
    //   $("#v-pills-menu_23-tab").trigger("click");
    // }
    //        ============= its close auto click the tab =============
    $(".btnNext").on("click", function () {
      $(".nav-pills .active").parent().next("li").find("a").trigger("click");
    });

    $(".btnPrevious").on("click", function () {
      $(".nav-pills .active").parent().prev("li").find("a").trigger("click");
    });

    $("body").on("click", "#is_ready_subscription", function () {
      if ($("#is_ready_subscription").is(":checked")) {
        $("#is_ready_subscription").attr("value", "1");
      } else {
        $("#is_ready_subscription").attr("value", "0");
      }
    });


    var ourfeaturedatalist = $("#ourfeature_datalist").DataTable({
      responsive: true,
      // aaSorting: [[0, "desc"]],
      columnDefs: [
        {
          bSortable: true,
          aTargets: [0],
        },
        {
          bSortable: false,
          targets: [5, 6],
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
        url: base_url + enterprise_shortname + "/get-ourfeaturelist",
        data: function (data) {
          data.csrf_test_name = CSRF_TOKEN;
        },
      },

      columns: [
        { data: "sl" },
        { data: "name" },
        { data: "ordering" },
        { data: "link" },
        { data: "summary" },
        { data: "picture" },
        { data: "action" },
      ],
    });


  });
})(jQuery);

var usertype = $("#usertype").val();
var CSRF_TOKEN = $("#CSRF_TOKEN").val();
var base_url = $("#base_url").val();
var enterprise_shortname = $("#enterprise_shortname").val();
var enterprise_id = $("#enterprise_id").val();
//   ========= its for toastr error message =============
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
    };
    toastr.success(r);
  }, 1000);
}

//    =============== its for existing_mailcheck ==========
("use strict");
function existing_mailcheck() {
  var base_url = $("#base_url").val();
  var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var email = $("#email").val();
  var email = encodeURIComponent(email);
  $.ajax({
    url: base_url + enterprise_shortname + "/checkuser-uniqueemail",
    type: "post",
    data: { csrf_test_name: CSRF_TOKEN, email: email },
    success: function (data) {
      if (data != 0) {
        $("#email").css({ border: "2px solid red" }).focus();
        toastrErrorMsg("This email already exists!");
        setTimeout(function () {}, 500);
        return false;
      }
    },
  });
}

// ============== its for get_adduser =============
("use strict");
function get_adduser() {}

//=============== its for user_save ===========
("use strict");
function user_save() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var fd = new FormData();
  var base_url = $("#base_url").val();
  var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var name = $("#name").val();
  var email = $("#email").val();
  var password = $("#password").val();
  var status = $(".status:checked").val();
  var mobile_no = $("mobile_no").val();
  var date_of_birth = $("#date_of_birth").val();
  var address = $("#address").val();
  if (name == "") {
    $("#name").focus();
    toastrErrorMsg("Name must be required");
    setTimeout(function () {}, 500);
    return false;
  }
  if (email == "") {
    $("#email").focus();
    toastrErrorMsg("Email must be required");
    setTimeout(function () {}, 500);
    return false;
  }
  if (password == "") {
    $("#password").focus();
    toastrErrorMsg("Password must be required");
    setTimeout(function () {}, 500);
    return false;
  }
  if (IsEmail(email) == false) {
    toastrErrorMsg("Your mail is invalid");
    return false;
  }

  fd.append("image", $("#image")[0].files[0]);
  fd.append("name", $("#name").val());
  fd.append("email", $("#email").val());
  fd.append("password", $("#password").val());
  fd.append("mobile_no", $("#mobile_no").val());
  fd.append("date_of_birth", $("#date_of_birth").val());
  fd.append("address", $("#address").val());

  fd.append("status", status);
  fd.append("csrf_test_name", CSRF_TOKEN);

  $.ajax({
    url: base_url + enterprise_shortname + "/user-save",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      $("#name").val("");
      $("#email").val("");
      $("#password").val("");
      // console.log(r);
      // return false;
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
    },
  });
}

//=========== its for valid mail check ===============
("use strict");
function IsEmail(email) {
  var regex =
    /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if (!regex.test(email)) {
    return false;
  } else {
    return true;
  }
}
//    ============== its for getuserlist =============
("use strict");
function getuserlist() {
  $.ajax({
    url: base_url + enterprise_shortname + "/get-userlist",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".user_listshow").html(r);
    },
  });
}

//    ============= add user edit form ============
("use strict");
function get_useredit(user_id) {
  //   var base_url = $("#base_url").val();
  //   var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/useredit-form",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, user_id: user_id },
    success: function (r) {
      $(".modal_ttl").html("User Information");
      $("#info").html(r);
      $("#modal_info").modal("show");
    },
  });
}

//    =========== its for user info update ============
("use strict");
function update_userinfo() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var base_url = $("#base_url").val();
  var edit_firstname = $("#edit_name").val();
  var edit_email = $("#edit_email").val();
  var edit_date_of_birth = $("#edit_date_of_birth").val();

  if (edit_firstname == "") {
    $("#edit_name").focus();
    toastrErrorMsg("Name must be required");
    return false;
  }
  if (edit_email == "") {
    $("#edit_email").focus();
    toastrErrorMsg("Email must be required");
    return false;
  }
  var fd = new FormData();
  var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  fd.append("hdn_image", $("#hdn_image").val());
  fd.append("image", $("#edit_image")[0].files[0]);
  fd.append("name", $("#edit_name").val());
  fd.append("email", $("#edit_email").val());
  fd.append("oldpass", $("#oldpass").val());
  fd.append("password", $("#edit_password").val());
  fd.append("address", $("#edit_address").val());
  fd.append("date_of_birth", $("#edit_date_of_birth").val());
  fd.append("mobile_no", $("#edit_mobile").val());
  fd.append("user_id", $("#user_id").val());
  fd.append("csrf_test_name", CSRF_TOKEN);

  $.ajax({
    url: base_url + enterprise_shortname + "/user-update",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      // toastrSuccessMsg(r);
      // $("#modal_info").modal("hide");
      // getuserlist();
      setTimeout(function () {
        toastr.options = {
          closeButton: true,
          progressBar: true,
          showMethod: "slideDown",
          timeOut: 1500,
          onHidden: function () {
            window.location.reload();
            location.href = base_url + enterprise_shortname + "/settings/58";
          },
        };
        toastr.success(r);
      }, 1000);
    },
  });
}

//============= its for courseinactive ===========
("use strict");
function userinactive(log_id) {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $('#CSRF_TOKEN').val();
  var d = confirm("Are you sure?");
  if (d == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/user-inactive",
      type: "POST",
      data: {
        csrf_test_name: CSRF_TOKEN,
        log_id: log_id,
      },
      success: function (r) {
        toastrSuccessMsg(r);
        // location.reload();
        location.href = base_url + enterprise_shortname + "/settings/58";
      },
    });
  }
}
//============= its for courseactive ===========
("use strict");

function useractive(log_id) {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $('#CSRF_TOKEN').val();
  var d = confirm("Are you sure?");
  if (d == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/user-active",
      type: "POST",
      data: {
        csrf_test_name: CSRF_TOKEN,
        log_id: log_id,
      },
      success: function (r) {
        toastrSuccessMsg(r);
        // location.reload();
        location.href = base_url + enterprise_shortname + "/settings/58";
      },
    });
  }
}

//============ its for userdelete =============
("use strict");
function userdelete(user_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var r = confirm("Are you sure");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/user-delete",
      type: "post",
      data: { csrf_test_name: CSRF_TOKEN, user_id: user_id },
      success: function (r) {
        toastr.success(r);
        getuserlist();
      },
    });
  }
}
//    ============== its for getmenuform =============
("use strict");
function getmenuform() {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  $(".content-loder").show();
  $.ajax({
    url: base_url + enterprise_shortname + "/get-menuform",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        // $(".content-loder").hide();
      }, 50);
      $(".menu_setupshow").html(r);
      $(".placeholder-single").select2();
    },
  });
}

//    ============ its for menu save =============
("use strict");
function menusave() {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var menu_title = $("#menu_title").val();
  var page_url = $("#page_url").val();
  var module = $("#module").val();
  var ordering = $("#ordering").val();
  var is_homesetting = $("#is_homesetting").val();
  var is_settings = $("#is_settings").val();
  var is_role = $("#is_role").val();
  var icon = $("#icon").val();
  var parent_menu = $("#parent_menu").val();
  if (menu_title == "") {
    toastr.success("Menu title must be required");
    setTimeout(function () {}, 1000);
    return false;
  }

  $.ajax({
    url: base_url + enterprise_shortname + "/menu-save",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      menu_title: menu_title,
      page_url: page_url,
      module: module,
      ordering: ordering,
      is_homesetting: is_homesetting,
      is_settings: is_settings,
      is_role: is_role,
      icon: icon,
      parent_menu: parent_menu,
    },
    success: function (r) {
      toastrSuccessMsg(r);
      // toastrSuccessMsg("Menu save successfully");
      setTimeout(function () {}, 500);
      getmenuform();
    },
  });
}
//    ============== its for getmenulist =============
("use strict");
function getmenulist() {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  $(".content-loder").show();
  $.ajax({
    url: base_url + enterprise_shortname + "/get-menulist",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".menusetup_listshow").html(r);

      //            ======== itsf for expense item list datatables ==============
      var table = $("#menulist").DataTable({
        lengthMenu: [
          [10, 25, 50, -1],
          [10, 25, 50, "All"],
        ],
        order: [],
        paging: true,
        searching: true,
        processing: true,
        serverSide: true,
        columnDefs: [
          {
            targets: 5,
            className: "text-center",
          },
        ],
        ajax: {
          url: base_url + enterprise_shortname + "/menu-list",
          type: "POST",
          data: {
            csrf_test_name: CSRF_TOKEN,
          },
        },
      });
    },
  });
}
//    ============ its for menuinactive ============
("use strict");
function menuinactive(menu_id) {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var r = confirm("Are you sure");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/menu-inactive",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, menu_id: menu_id },
      success: function (r) {
        toastr.success(r);
        getmenulist();
      },
    });
  }
}
//    ============ its for menuactive ============
("use strict");
function menuactive(menu_id) {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var r = confirm("Are you sure");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/menu-active",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, menu_id: menu_id },
      success: function (r) {
        toastr.success(r);
        getmenulist();
      },
    });
  }
}

//    ============ its for editinfo  ===========
("use strict");
function menueditinfo(menu_id) {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/menu-edit",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, menu_id: menu_id },
    success: function (r) {
      $(".modal_ttl").html("Menu Information");
      $("#info").html(r);
      $("#modal_info").modal("show");
      $(".placeholder-single").select2();
    },
  });
}

//    =========== its for menu update =============
("use strict");
function menuupdate() {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var menu_id = $("#menu_id").val();
  var menu_title = $("#edit_menu_title").val();
  var page_url = $("#edit_page_url").val();
  var module = $("#edit_module").val();
  var ordering = $("#edit_ordering").val();
  var is_homesetting = $("#editis_homesetting").val();
  var is_settings = $("#is_settings").val();
  var is_role = $("#is_role").val();
  var icon = $("#icon").val();
  var parent_menu = $("#edit_parent_menu").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/menu-update",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      menu_id: menu_id,
      menu_title: menu_title,
      page_url: page_url,
      module: module,
      ordering: ordering,
      parent_menu: parent_menu,
      is_homesetting: is_homesetting,
      is_settings: is_settings,
      is_role: is_role,
      icon: icon,
    },
    success: function (r) {
      $("#modal_info").modal("hide");
      toastr.success(r);
      setTimeout(function () {}, 500);
      // getmenulist();
      $("#menulist").DataTable().ajax.reload();
    },
  });
}
//    ============== its for menudelete ==========
("use strict");
function menudelete(menu_id) {
  var base_url = $("#base_url").val();
  var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var r = confirm("Are you sure");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/menu-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, menu_id: menu_id },
      success: function (r) {
        toastrSuccessMsg(r);
        // getmenulist();
        $("#menulist").DataTable().ajax.reload();
      },
    });
  }
}
//    ============== its for getrolepermission_form =============
("use strict");
function getrolepermission_form() {
  $(".content-loder").show();
  $.ajax({
    url: base_url + enterprise_shortname + "/get-rolepermissionform",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".role_permissionshow").html(r);
    },
  });
}
//    ============== its for getrolepermission list =============
("use strict");
function getrolepermission_list() {
  $.ajax({
    url: base_url + enterprise_shortname + "/get-rolepermissionlist",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".role_listshow").html(r);
    },
  });
}

//============ its for role edit form ===========
("use strict");
function role_edit(role_id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/role-editform",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, role_id: role_id },
    success: function (r) {
      setTimeout(function () {}, 50);
      $(".role_listshow").html(r);
    },
  });
}

//============ its for role delete =============
("use strict");
function roledelete(menu_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  //   var base_url = $("#base_url").val();
  //   var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var r = confirm("Are you sure");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/role-delete",
      type: "post",
      data: { csrf_test_name: CSRF_TOKEN, menu_id: menu_id },
      success: function (r) {
        toastrSuccessMsg(r);
        getrolepermission_list();
      },
    });
  }
}

//============= its for user role check==============
("use strict");
function userRole(id) {
  //   var base_url = $("#base_url").val();
  //   var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/user-role-check",
    type: "post",
    data: { csrf_test_name: CSRF_TOKEN, user_id: id },
    success: function (r) {
      $(".existrole_ttl").html("Assigned Role");
      r = JSON.parse(r);
      $("#existrole ul").empty();
      $.each(r, function (ar, typeval) {
        if (typeval.role_name == "Not Found") {
          $("#existrole ul").html("<span class='text-danger'>Not Found</span>");
          $("#exitrole ul").css({ color: "red" });
        } else {
          $("#existrole ul").append("<li>" + typeval.role_name + "</li>");
        }
      });
    },
  });
}
//    ============== its for get assign user role =============
("use strict");
function getassignuserrole() {
  $.ajax({
    url: base_url + enterprise_shortname + "/assign-user-role",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".assign_user_roleshow").html(r);
    },
  });
}
//    ============== its for get assign user role =============
("use strict");
function getassignuserrolelist() {
  $.ajax({
    url: base_url + enterprise_shortname + "/assign-user-role-list",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".assign_user_role_listshow").html(r);
    },
  });
}
//============ its for user assign role edit ===============
("use strict");
function useraccessrole(user_id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/user-access-role-edit",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, user_id: user_id },
    success: function (r) {
      $(".assign_user_role_listshow").html(r);
    },
  });
}
//    ============== its for menudelete ==========
("use strict");
function roleassigndelete(user_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var r = confirm("Are you sure");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/role-assign-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, user_id: user_id },
      success: function (r) {
        toastrSuccessMsg(r);
        getassignuserrolelist();
      },
    });
  }
}
//    ============== its for get language add and list =============
("use strict");
function getlanguage() {
  $.ajax({
    url: base_url + enterprise_shortname + "/add-language",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".add_languageshow").html(r);
    },
  });
}
//    ============= its for save language ==========
("use strict");
function save_language() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var language = $("#language").val();
  if (language == "") {
    $("#language").focus();
    toastrErrorMsg("Empty field not allow");
    setTimeout(function () {}, 1000);
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/language-save",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, language: language },
    success: function (r) {
      toastrSuccessMsg(r);
      setTimeout(function () {}, 1000);
      $("#language").val("");
      getlanguage();
    },
  });
}
//    ============== its for get phrase add and list =============
("use strict");
function getphrase() {
  $.ajax({
    url: base_url + enterprise_shortname + "/add-phrase",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".add_phraseshow").html(r);
    },
  });
}

//    ============= its for save_phrase ==========
("use strict");
function save_phrase() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var phrase = $("#phrase").val();
  if (phrase == "") {
    $("#phrase").focus();
    toastrErrorMsg("Empty field not allow");
    setTimeout(function () {}, 1000);
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/phrase-save",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, phrase: phrase },
    success: function (r) {
      toastrSuccessMsg(r);
      setTimeout(function () {}, 1000);
      $("#phrase").val("");
      table.ajax.reload();
    },
  });
}
//=============== its for phraselabel =============
("use strict");
function phraselabel(phrase) {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/phrase-label-search",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, phrase: phrase },
    success: function (r) {
      $(".results").html(r);
    },
  });
}

//    ============= its for getmailconfig ==============
("use strict");
function getmailconfig() {
  // $(".content-loder").show();
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/mail-config",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".mail_configshow").html(r);
    },
  });
}
//    ================ its for mailconfig_save ==========
("use strict");
function mailconfig_save() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var protocol = $("#protocol").val();
  var smtp_host = $("#smtp_host").val();
  var smtp_port = $("#smtp_port").val();
  var smtp_user = $("#smtp_user").val();
  var smtp_pass = $("#smtp_pass").val();
  var mailtype = $("#mailtype").val();
  var isinvoice = $(".isinvoice:checked").val();
  var isreceive = $(".isreceive:checked").val();

  if (protocol == "") {
    $("#protocol").focus();
    toastrErrorMsg("Protocol must be required");
    return false;
  }
  if (smtp_host == "") {
    $("#smtp_host").focus();
    toastrErrorMsg("SMTP HOST must be required");
    return false;
  }
  if (smtp_port == "") {
    $("#smtp_port").focus();
    toastrErrorMsg("SMTP Port must be required");
    return false;
  }
  if (smtp_user == "") {
    $("#smtp_user").focus();
    toastrErrorMsg("Username must be required");
    return false;
  }
  if (smtp_pass == "") {
    $("#smtp_pass").focus();
    toastrErrorMsg("Password must be required");
    return false;
  }
  if (mailtype == "") {
    $("#mailtype").focus();
    toastrErrorMsg("Mailtype must be required");
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/mailconfig-update",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      protocol: protocol,
      smtp_host: smtp_host,
      smtp_port: smtp_port,
      smtp_user: smtp_user,
      smtp_pass: smtp_pass,
      mailtype: mailtype,
      isinvoice: isinvoice,
      isreceive: isreceive,
    },
    success: function (r) {
      toastrSuccessMsg(r);
    },
  });
}
//    ============= its for getsmsconfig ==============
("use strict");
function getsmsconfig() {
  // $(".content-loder").show();
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/sms-config",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".sms_configshow").html(r);
    },
  });
}
//    ============= its for getpaymentmethodlist ==============
("use strict");
function getpaymentmethodlist() {
  // $(".content-loder").show();
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/payment-method-list",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".payment_method_listshow").html(r);
    },
  });
}

//================= its for payment method config form ==========
("use strict");
function paymentmethodconfig(id) {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();

  $.ajax({
    url: base_url + enterprise_shortname + "/paymentmethod-config-form",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, id: id },
    success: function (r) {
      $(".modal_ttl").html("Payment method configuration");
      $("#info").html(r);
      $("#modal_info").modal("show");
    },
  });
}

//============= its for payment method update ============
("use strict");
function paymentmethodupdate() {
  var payment_method_name = $("#payment_method_name").val();
  var marchant_id = $("#paymentmenthod_marchant_id").val();
  var password = $("#paymentmenthod_password").val();
  var email = $("#paymentmenthod_email").val();
  var currency = $("#paymentmenthod_currency").val();
  var is_live = $("#paymentmenthod_is_live").val();
  var is_status = $("#paymentmenthod_status").val();
  var methodid = $("#methodid").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/payment-method-update",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      payment_method_name: payment_method_name,
      marchant_id: marchant_id,
      password: password,
      email: email,
      currency: currency,
      is_live: is_live,
      is_status: is_status,
      methodid: methodid,
    },
    success: function (r) {
      if(r==1){
      toastrSuccessMsg("Updated successfully!");
      setTimeout(function () {}, 1000);
      //            $("#name").val('');
      //            $("#modal_info").modal('hide');
      //            getpaymentmethodlist();
      location.href = base_url + enterprise_shortname + "/settings/7";
      }
    },
  });
}

//=========== its for payment method active/inactive =======
("use strict");
function paymentmethodactiveinactive(id, status) {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/payment-method-activeinactive",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, id: id, status: status },
      success: function (r) {
        toastr.success(r);
        getpaymentmethodlist();
      },
    });
  }
}

//    ================ its for smsconfig_save ==============
("use strict");
function smsconfig_save() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var provider_name = $("#provider_name").val();
  var user_name = $("#user_name").val();
  var password = $("#sms_password").val();
  var phone = $("#phone").val();
  var sender_name = $("#sender_name").val();
  var isinvoice = $(".isinvoice3:checked").val();
  var isreceive = $(".isreceive3:checked").val();

  if (user_name == "") {
    $("#user_name").focus();
    toastrErrorMsg("Username must be required");
    return false;
  }
  if (password == "") {
    $("#password").focus();
    toastrErrorMsg("Password must be required");
    return false;
  }

  $.ajax({
    url: base_url + enterprise_shortname + "/smsconfig-save",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      provider_name: provider_name,
      user_name: user_name,
      password: password,
      phone: phone,
      sender_name: sender_name,
      isinvoice: isinvoice,
      isreceive: isreceive,
    },
    success: function (r) {
      toastr.success(r);
    },
  });
}
//    ============= its for getpaypalconfig ==============
("use strict");
function getpaypalconfig() {
  $.ajax({
    url: base_url + enterprise_shortname + "/paypal-config",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".paypal_configshow").html(r);
    },
  });
}

//============== its for paypalconfig-save ===============
("use strict");
function paypalconfigsave() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var payment_gateway = $("#payment_gateway").val();
  var email = $("#paypalemail").val();
  var ClientID = $("#ClientID").val();
  var ClientSecret = $("#ClientSecret").val();
  var currency = $("#currency").val();
  var mode = $("#paypalmode").val();

  if (payment_gateway == "") {
    $("#payment_gateway").focus();
    toastrErrorMsg("Gateway must be required");
    return false;
  }
  if (ClientID == "") {
    $("#ClientID").focus();
    toastrErrorMsg("ClientID must be required");
    return false;
  }
  if (ClientSecret == "") {
    $("#ClientSecret").focus();
    toastrErrorMsg("ClientSecret must be required");
    return false;
  }
  if (mode == "") {
    $("#paypalmode").focus();
    toastrErrorMsg("Mode must be required");
    return false;
  }

  $.ajax({
    url: base_url + enterprise_shortname + "/paypalconfig-save",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      payment_gateway: payment_gateway,
      ClientID: ClientID,
      ClientSecret: ClientSecret,
      currency: currency,
      mode: mode,
    },
    success: function (r) {
      toastrSuccessMsg(r);
    },
  });
}
//    ============= its for getstripeconfig ==============
("use strict");
function getstripeconfig() {
  $.ajax({
    url: base_url + enterprise_shortname + "/stripe-config",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".stripe_configshow").html(r);
    },
  });
}

//============== its for payeer-config-save ===============
("use strict");
function stripeconfigsave() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var payment_method_name = $("#stripe_method_name").val();
  var marchant_id = $("#stripe_marchant_id").val();
  var password = $("#stripe_password").val();
  var email = $("#stripe_email").val();
  var currency = $("#stripe_currency").val();
  var is_live = $("#stripe_is_live").val();
  var status = $("#stripe_status").val();
  var id = $("#stripe_id").val();

  if (marchant_id == "") {
    $("#marchant_id").focus();
    toastrErrorMsg("Marchant ID must be required");
    return false;
  }
  if (password == "") {
    $("#password").focus();
    toastrErrorMsg("Password must be required");
    return false;
  }
  if (email == "") {
    $("#email").focus();
    toastrErrorMsg("Email must be required");
    return false;
  }

  $.ajax({
    url: base_url + enterprise_shortname + "/stripeconfig-save",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      payment_method_name: payment_method_name,
      marchant_id: marchant_id,
      password: password,
      email: email,
      currency: currency,
      is_live: is_live,
      status: status,
      id: id,
    },
    success: function (r) {
      toastrSuccessMsg(r);
    },
  });
}

//    ============= its for getpayeerconfig ==============
("use strict");
function getpayeerconfig() {
  // $(".content-loder").show();
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/payeer-config",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".payeer_configshow").html(r);
    },
  });
}

//============== its for payeer-config-save ===============
("use strict");
function payeerconfigsave() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var payment_method_name = $("#payeer_method_name").val();
  var marchant_id = $("#payeer_marchant_id").val();
  var password = $("#payeer_password").val();
  var email = $("#payeer_email").val();
  var currency = $("#payeer_currency").val();
  var is_live = $("#payeer_is_live").val();
  var status = $("#payeer_status").val();
  var id = $("#payeer_id").val();

  if (marchant_id == "") {
    $("#marchant_id").focus();
    toastrErrorMsg("Marchant ID must be required");
    return false;
  }
  if (password == "") {
    $("#password").focus();
    toastrErrorMsg("Password must be required");
    return false;
  }
  if (email == "") {
    $("#email").focus();
    toastrErrorMsg("Email must be required");
    return false;
  }

  $.ajax({
    url: base_url + enterprise_shortname + "/payeerconfig-save",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      payment_method_name: payment_method_name,
      marchant_id: marchant_id,
      password: password,
      email: email,
      currency: currency,
      is_live: is_live,
      status: status,
      id: id,
    },
    success: function (r) {
      toastrSuccessMsg(r);
    },
  });
}

//    ============= its for getpayuconfig ==============
("use strict");
function getpayuconfig() {
  // $(".content-loder").show();
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/payu-config",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".payu_configshow").html(r);
    },
  });
}

//============== its for payu-config-save ===============
("use strict");
function payuconfigsave() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var payment_method_name = $("#payu_method_name").val();
  var marchant_id = $("#payu_marchant_id").val();
  var password = $("#payu_password").val();
  var email = $("#payu_email").val();
  var currency = $("#payu_currency").val();
  var is_live = $("#payu_is_live").val();
  var status = $("#payu_status").val();
  var id = $("#payu_id").val();

  if (marchant_id == "") {
    $("#marchant_id").focus();
    toastrErrorMsg("Marchant ID must be required");
    return false;
  }
  if (password == "") {
    $("#password").focus();
    toastrErrorMsg("Password must be required");
    return false;
  }
  if (email == "") {
    $("#email").focus();
    toastrErrorMsg("Email must be required");
    return false;
  }

  $.ajax({
    url: base_url + enterprise_shortname + "/payuconfig-save",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      payment_method_name: payment_method_name,
      marchant_id: marchant_id,
      password: password,
      email: email,
      currency: currency,
      is_live: is_live,
      status: status,
      id: id,
    },
    success: function (r) {
      toastrSuccessMsg(r);
    },
  });
}
//    ============= its for getpusherconfig ==============
("use strict");
function getpusherconfig() {
  // $(".content-loder").show();
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/pusher-config",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".pusher_configshow").html(r);
    },
  });
}
//============== its for pusher config save ===============
("use strict");
function pusherconfigsave() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var api_id = $("#api_id").val();
  var api_key = $("#api_key").val();
  var secret_key = $("#secret_key").val();
  var cluster = $("#cluster").val();

  if (api_id == "") {
    $("#api_id").focus();
    toastrErrorMsg("API ID must be required");
    return false;
  }
  if (api_key == "") {
    $("#api_key").focus();
    toastrErrorMsg("API Key must be required");
    return false;
  }
  if (secret_key == "") {
    $("#secret_key").focus();
    toastrErrorMsg("Secret key must be required");
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/pusherconfig-save",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      api_id: api_id,
      api_key: api_key,
      secret_key: secret_key,
      cluster: cluster,
    },
    success: function (r) {
      toastrSuccessMsg(r);
    },
  });
}

//    ============= its for getsubscriberlist ==============
("use strict");
function getsubscriberlist() {
  $.ajax({
    url: base_url + enterprise_shortname + "/subscriber-list",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".newslettershow").html(r);

      var subscriberlist = $("#subscriberlist").DataTable({
        responsive: true,
        aaSorting: [[0, "desc"]],
        columnDefs: [
          {
            bSortable: true,
            aTargets: [0],
          },
          {
            bSortable: false,
            targets: [2],
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
          url: base_url + enterprise_shortname + "/get-subscriberlist",
          data: function (data) {
            data.csrf_test_name = CSRF_TOKEN;
          },
        },

        columns: [{ data: "sl" }, { data: "mail" }, { data: "is_receive" }],
      });
    },
  });
}
//    ============= its for getcompanies ==============
("use strict");
function getcompanies() {
  $.ajax({
    url: base_url + enterprise_shortname + "/companies",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".collaborateshow").html(r);
      var companydatalist = $("#companydatalist").DataTable({
        responsive: true,
        aaSorting: [[0, "desc"]],
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
          url: base_url + enterprise_shortname + "/get-companylist",
          data: function (data) {
            data.csrf_test_name = CSRF_TOKEN;
          },
        },

        columns: [
          { data: "sl" },
          { data: "name" },
          { data: "link" },
          { data: "ordering" },
          { data: "picture" },
          { data: "action" },
        ],
      });
    },
  });
}

//    ============= its for company info save  ==========
("use strict");
function company_infosave() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var fd = new FormData();
  var name = $("#company_name").val();
  var link = $("#link").val();
  var ordering = $("#ordering").val();
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  fd.append("logo", $("#logo")[0].files[0]);
  fd.append("name", $("#company_name").val());
  fd.append("link", $("#link").val());
  fd.append("ordering", $("#ordering").val());
  fd.append("csrf_test_name", CSRF_TOKEN);
  if (name == "") {
    $("#company_name").focus();
    toastrErrorMsg("Name must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/company-infosave",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      setTimeout(function () {}, 1000);
      $("#company_name").val("");
      getcompanies();
    },
  });
}
//    ================== its for company edit ===========
("use strict");
function company_edit(company_id) {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/company-edit",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, company_id: company_id },
    success: function (r) {
      $(".modal_ttls").html("Information update");
      $("#infos").html(r);
      $("#modal_infos").modal("show");
    },
  });
}

//========== its for company info update =============
("use strict");
function company_infoupdate(company_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var fd = new FormData();
  var name = $("#c_name").val();
  var link = $("#c_link").val();
  var ordering = $("#edit_ordering").val();
  var old_logo = $("#old_logo").val();
  var base_url = $("#base_url").val();
  var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  fd.append("logo", $("#c_logo")[0].files[0]);
  fd.append("name", $("#c_name").val());
  fd.append("link", $("#c_link").val());
  fd.append("ordering", $("#edit_ordering").val());
  fd.append("old_logo", $("#old_logo").val());
  fd.append("old_logofilename", $("#old_logofilename").val());
  fd.append("company_id", company_id);
  fd.append("csrf_test_name", CSRF_TOKEN);
  if (name == "") {
    $("#c_name").focus();
    toastrErrorMsg("Name must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/company-infoupdate",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      setTimeout(function () {}, 1000);
      $("#name").val("");
      $("#modal_infos").modal("hide");
      $("#infos").modal("hide");
      //  getcompanies();
      $("#companydatalist").DataTable().ajax.reload();
    },
  });
}
//============== its for company_delete =========
("use strict");
function company_delete(company_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/company-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, company_id: company_id },
      success: function (r) {
        toastrSuccessMsg(r);
      },
    });
    getcompanies();
  }
}
//    =========== its for getteammembers ==============
("use strict");
function getteammembers() {
  $.ajax({
    url: base_url + enterprise_shortname + "/team-members",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".team_membersshow").html(r);

      var teammemberlist = $("#teammemberlist").DataTable({
        responsive: true,
        aaSorting: [[0, "desc"]],
        columnDefs: [
          {
            bSortable: false,
            aTargets: [0],
          },
          {
            bSortable: false,
            targets: [3, 4],
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
          url: base_url + enterprise_shortname + "/get-teammemberlist",
          data: function (data) {
            data.csrf_test_name = CSRF_TOKEN;
          },
        },

        columns: [
          { data: "sl" },
          { data: "name" },
          { data: "designation" },
          { data: "picture" },
          { data: "action" },
        ],
      });
    },
  });
}

//======= its for teammember_infosave ==============
("use strict");
function teammemberinfo_save() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var fd = new FormData();
  var name = $("#member_name").val();
  var designation = $("#member_designation").val();
  fd.append("picture", $("#picture")[0].files[0]);
  fd.append("name", $("#member_name").val());
  fd.append("designation", $("#member_designation").val());
  fd.append("csrf_test_name", CSRF_TOKEN);
  if (name == "") {
    $("#name").focus();
    toastrErrorMsg("Name must be required!");
    return false;
  }
  if (designation == "") {
    $("#designation").focus();
    toastrErrorMsg("Designation must be required!");
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/teammembers-infosave",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      setTimeout(function () {}, 1000);
      $("#member_name").val("");
      $("#member_designation").val("");
      $("#picture").val("");
      // getteammembers();
      $("#teammemberlist").DataTable().ajax.reload();
    },
  });
}

//    ================== its for teammember edit ===========
("use strict");
function teammember_edit(teammember_id) {
  var base_url = $("#base_url").val();
  var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/teammember-edit",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, teammember_id: teammember_id },
    success: function (r) {
      $(".teammembermodal_ttl").html("Team member information update");
      $("#teammemberinfo").html(r);
      $("#teammembermodal_info").modal("show");
    },
  });
}

//========== its for team member info update =============
("use strict");
function teammemberinfo_update(teammember_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var fd = new FormData();
  var name = $("#cm_name").val();
  var designation = $("#cm_designation").val();
  var old_logo = $("#old_logo").val();
  fd.append("picture", $("#cm_picture")[0].files[0]);
  fd.append("name", $("#cm_name").val());
  fd.append("designation", $("#cm_designation").val());
  fd.append("old_logo", $("#old_logo").val());
  fd.append("teammember_id", teammember_id);
  fd.append("csrf_test_name", CSRF_TOKEN);
  if (name == "") {
    $("#cm_name").focus();
    toastrErrorMsg("Name must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }
  if (designation == "") {
    $("#cm_designation").focus();
    toastrErrorMsg("Designation must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/teammember-infoupdate",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      setTimeout(function () {}, 1000);
      $("#c_name").val("");
      $("#teammembermodal_info").modal("hide");
      // getteammembers();
      $("#teammemberlist").DataTable().ajax.reload();
    },
  });
}

//============== its for teammember_delete =========
("use strict");
function teammember_delete(teammember_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/teammember-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, teammember_id: teammember_id },
      success: function (r) {
        toastrSuccessMsg(r);
        $("#teammemberlist").DataTable().ajax.reload();
      },
    });
  }
}

//    =========== its for get proficiency ==============
("use strict");
function get_proficiency() {
  $.ajax({
    url: base_url + enterprise_shortname + "/get-proficiency",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      // setTimeout(function () {
      //   $(".content-loder").hide();
      // }, 50);
      $(".professional_proficiencyshow").html(r);

      var proficiencylist = $("#proficiencylist").DataTable({
        responsive: true,
        aaSorting: [[0, "desc"]],
        columnDefs: [
          {
            bSortable: false,
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
          url: base_url + enterprise_shortname + "/get-proficiencylist",
          data: function (data) {
            data.csrf_test_name = CSRF_TOKEN;
          },
        },

        columns: [
          { data: "sl" },
          { data: "title" },
          { data: "picture" },
          { data: "action" },
        ],
      });
    },
  });
}

//======= its for proficiencyinfo save ==============
("use strict");
function proficiencyinfo_save() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var fd = new FormData();
  var title = $("#proficiency_title").val();
  fd.append("picture", $("#proficiency_picture")[0].files[0]);
  fd.append("title", title);
  fd.append("csrf_test_name", CSRF_TOKEN);
  if (title == "") {
    $("#proficiency_title").focus();
    toastrErrorMsg("Title must be required!");
    return false;
  }

  $.ajax({
    url: base_url + enterprise_shortname + "/proficiency-infosave",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      if (r == 0) {
        toastrErrorMsg("This item already exists!");
      } else if(r == 1) {
        toastrSuccessMsg("Added successfully");
      }
      // setTimeout(function () {}, 1000);
      $("#proficiency_title").val("");
      $("#proficiency_picture").val("");
      $("#proficiencylist").DataTable().ajax.reload();
    },
  });
}

//    ================== its for proficiency edit ===========
("use strict");
function proficiency_edit(proficiency_id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/proficiency-edit",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, proficiency_id: proficiency_id },
    success: function (r) {
      $(".proficiencymodal_ttl").html("Proficiency information update");
      $("#proficiencyinfo").html(r);
      $("#proficiencymodal_info").modal("show");
    },
  });
}

//========== its for proficiency info update =============
("use strict");
function proficiencyinfo_update(proficiency_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var fd = new FormData();
  var title = $("#edit_proficiencytitle").val();
  var old_logo = $("#old_proficiencylogo").val();
  fd.append("picture", $("#edit_proficiencypicture")[0].files[0]);
  fd.append("title", title);
  fd.append("old_logo", $("#old_proficiencylogo").val());
  fd.append("proficiency_id", proficiency_id);
  fd.append("csrf_test_name", CSRF_TOKEN);

  if (title == "") {
    $("#edit_proficiencytitle").focus();
    toastrErrorMsg("Title must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }

  $.ajax({
    url: base_url + enterprise_shortname + "/proficiency-infoupdate",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      setTimeout(function () {}, 1000);
      $("#edit_proficiencytitle").val("");
      $("#proficiencymodal_info").modal("hide");
      $("#proficiencylist").DataTable().ajax.reload();
    },
  });
}

//============== its for proficiency delete =========
("use strict");
function proficiency_delete(proficiency_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/proficiency-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, proficiency_id: proficiency_id },
      success: function (r) {
        toastrSuccessMsg(r);
        $("#proficiencylist").DataTable().ajax.reload();
      },
    });
  }
}

//    =========== its for gettemplateinfo ==============
("use strict");
function gettemplateinfo() {
  $.ajax({
    url: base_url + enterprise_shortname + "/templateinfo",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".templateshow").html(r);
      $(".placeholder-single").select2();
      var templatelist = $("#templatelist").DataTable({
        responsive: true,
        aaSorting: [[0, "desc"]],
        columnDefs: [
          {
            bSortable: true,
            aTargets: [0],
          },
          {
            targets: [4],
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
          url: base_url + enterprise_shortname + "/get-templatelist",
          data: function (data) {
            data.csrf_test_name = CSRF_TOKEN;
          },
        },

        columns: [
          { data: "sl" },
          { data: "title" },
          { data: "template_type" },
          { data: "template_body" },
          { data: "action" },
        ],
      });
    },
  });
}

// =============== its for templateinfo save ================
("use sctrict");
function templateinfo_save() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var fd = new FormData();
  var id = $("#id").val();
  var mode = $("#mode").val();
  var title = $("#template_title").val();
  var template_type = $("#template_type").val();
  var template_body = $("#template_body").val();
  if (mode == "edit") {
    var title = $("#edit_template_title").val();
    var template_type = $("#edit_template_type").val();
    var template_body = $("#edit_template_body").val();
  }

  fd.append("id", id);
  fd.append("mode", mode);
  fd.append("title", title);
  fd.append("template_type", template_type);
  fd.append("template_body", template_body);
  fd.append("csrf_test_name", CSRF_TOKEN);

  if (title == "") {
    $("#title").focus();
    toastrErrorMsg("Title must be required!");
    return false;
  }

  if (template_type == "") {
    $("#template_type").focus();
    toastrErrorMsg("Template type must be required!");
    return false;
  }
  if (template_body == "") {
    $("#template_body").focus();
    toastrErrorMsg("Template body must be required!");
    return false;
  }

  $.ajax({
    url: base_url + enterprise_shortname + "/templateinfo-save",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      $("#template_title").val("");
      $("#template_body").val("");
      $("#templatemodal_info").modal("hide");
      $("#templatelist").DataTable().ajax.reload();
    },
  });
}

//    ================== its for teammember edit ===========
("use strict");
function template_edit(id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/template-edit",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, id: id },
    success: function (r) {
      $(".modal_ttl").html("Template information update");
      $("#templateinfo").html(r);
      $("#templatemodal_info").modal("show");
      $(".placeholder-single").select2();
    },
  });
}

//============== its for template delete =========
("use strict");
function template_delete(id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/template-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, id: id },
      success: function (r) {
        toastrSuccessMsg(r);
        $("#templatelist").DataTable().ajax.reload();
      },
    });
  }
}

//    ============= its for about us form ==============
("use strict");
function getaboutus() {
  $.ajax({
    url: base_url + enterprise_shortname + "/aboutus-form",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".about_usshow").html(r);
    },
  });
}
//    ============= its for privacy policy form ==============
("use strict");
function getprivacypolicy() {
  $.ajax({
    url: base_url + enterprise_shortname + "/privacy-policy-form",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".privacy_policyshow").html(r);

      // ========== its for ckeditor start ==========
      CKEDITOR.replace("privacy", {
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
      //            ============= its ckeditor close ===========
    },
  });
}
//============ its for privacypolicy_save ===========
("use strict");
function privacypolicy_save() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var title = $("#privacy_title").val();
  var description = CKEDITOR.instances["privacy"].getData();
  if (title == "") {
    $("#privacy_title").focus();
    toastrErrorMsg("Title must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }
  if (description == "") {
    $("#privacy").focus();
    toastrErrorMsg("Description must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/privacy-policy-save",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      title: title,
      description: description,
    },
    success: function (r) {
      toastrSuccessMsg(r);
    },
  });
}

//    ============= its for privacy policy form ==============
("use strict");
function get_refundpolicy() {
  $.ajax({
    url: base_url + enterprise_shortname + "/refund-policy-form",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
        $(".refund_policyshow").html(r);

      // ========== its for ckeditor start ==========
      CKEDITOR.replace("refund_policy", {
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
      //            ============= its ckeditor close ===========
    },
  });
}
//============ its for refundpolicy_save ===========
("use strict");
function refundpolicy_save() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var title = $("#refund_title").val();
  var description = CKEDITOR.instances["refund_policy"].getData();
  if (title == "") {
    $("#refund_title").focus();
    toastrErrorMsg("Title must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }
  if (description == "") {
    $("#privrefund_policyacy").focus();
    toastrErrorMsg("Description must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/refund-policy-save",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      title: title,
      description: description,
    },
    success: function (r) {
      toastrSuccessMsg(r);
    },
  });
}


//    ============= its for terms condition form ==============
("use strict");
function gettermscondition() {
  $.ajax({
    url: base_url + enterprise_shortname + "/termscondition-form",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".terms_conditionshow").html(r);
      //            ========== its for ckeditor start ==========
      CKEDITOR.replace("termscondition", {
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
      //            ============= its ckeditor close ===========
    },
  });
}
//============ its for termscondition_save ===========
("use strict");
function termscondition_save() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var title = $("#terms_title").val();
  var description = CKEDITOR.instances["termscondition"].getData();
  if (title == "") {
    $("#terms_title").focus();
    toastrErrorMsg("Title must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }
  if (description == "") {
    $("#termscondition").focus();
    toastrErrorMsg("Description must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/termscondition-save",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      title: title,
      description: description,
    },
    success: function (r) {
      toastrSuccessMsg(r);
    },
  });
}

//    ============== its for get  getslider =============
("use strict");
function getslider() {
  $.ajax({
    url: base_url + enterprise_shortname + "/slider-form",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      // setTimeout(function () {
      //   $(".content-loder").hide();
      // }, 50);
      $(".slidersshow").html(r);
    },
  });
}
//============ its for slider save ================
("use strict");
function slider_save() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var fd = new FormData();
  var title = $("#slider_title").val();
  var subtitle = $("#subtitle").val();
  var slider_logo = $("#slider_logo").val();

  var background_video_url = $("#background_video_url").val();
  var old_background_video = $("#old_background_video").val();
  var short_video_url = $("#short_video_url").val();
  var slider_point_one = $("#slider_point_one").val();
  var slider_point_two = $("#slider_point_two").val();
  var slider_point_three = $("#slider_point_three").val();
  // var tags = $("#tags").val();
  // var description = $("#slider_description").val();
  var old_image = $("#old_image").val();
  fd.append("slider_pic", $("#slider_pic")[0].files[0]);
  fd.append("subtitle_image", $("#subtitle_image")[0].files[0]);
  fd.append("old_image", $("#old_image").val());
  fd.append("old_slider_logo", $("#old_slider_logo").val());
  fd.append("slider_logo",$("#slider_logo")[0].files[0]);
  fd.append("title", $("#slider_title").val());
  fd.append("subtitle", $("#subtitle").val());
  fd.append("background_video_url", $("#background_video_url")[0].files[0]);
  fd.append("old_background_video", $("#old_background_video").val());
  fd.append("old_subtitle_image", $("#old_subtitle_image").val());
  fd.append("short_video_url", $("#short_video_url").val());
  fd.append("slider_point_one", $("#slider_point_one").val());
  fd.append("slider_point_two", $("#slider_point_two").val());
  fd.append("slider_point_three", $("#slider_point_three").val());
  fd.append("enterprise_id", $("#enterprise_id").val());
  fd.append("csrf_test_name", CSRF_TOKEN);
  if (title == "") {
    $("#slider_title").focus();
    toastrErrorMsg("Title must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/slider-info-save",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      // console.log(r);      return false;
      toastrSuccessMsg(r);
      setTimeout(function () {}, 1000);
      getslider();
    },
  });
}

//    ============== its for get  getcurrency =============
("use strict");
function getcurrency() {
  $.ajax({
    url: base_url + enterprise_shortname + "/currency-form",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".currencyshow").html(r);
    },
  });
}

//========== its for currency_save ==========
("use strict");
function currency_save() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var currencyname = $("#currencyname").val();
  var curr_icon = $("#curr_icon").val();
  if (currencyname == "") {
    $("#currencyname").focus();
    toastrErrorMsg("Currency name must be required!");
    return false;
  } else if (curr_icon == "") {
    $("#curr_icon").focus();
    toastrErrorMsg("Currency icon must be required!");
    return false;
  }

  $.ajax({
    url: base_url + enterprise_shortname + "/currency-save",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      currencyname: currencyname,
      curr_icon: curr_icon,
    },
    success: function (r) {
      toastrSuccessMsg(r);
      setTimeout(function () {}, 1000);
      $("#currencyname").val("");
      $("#curr_icon").val("");
      $("#currencylist").DataTable().ajax.reload();
    },
  });
}

//=========== its for editcurrencyinfo =========
("use strict");
function editcurrencyinfo(id) {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();

  $.ajax({
    url: base_url + enterprise_shortname + "/currencyedit-form",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, id: id },
    success: function (r) {
      $(".currencymodal_ttl").html("Currency Information");
      $("#currencyinfo").html(r);
      $("#currencymodal_info").modal("show");
    },
  });
}
//=========== its for update_currencyinfo ===========
("use strict");
function update_currencyinfo() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }
  var base_url = $("#base_url").val();
  var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var currencyid = $("#edt_currencyid").val();
  var currencyname = $("#edt_currencyname").val();
  var curr_icon = $("#edt_curr_icon").val();
  if (currencyname == "") {
    $("#currencyname").focus();
    toastrErrorMsg("Currency name must be required!");
    return false;
  } else if (curr_icon == "") {
    $("#curr_icon").focus();
    toastrErrorMsg("Currency icon must be required!");
    return false;
  }

  $.ajax({
    url: base_url + enterprise_shortname + "/currency-update",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      currencyid: currencyid,
      currencyname: currencyname,
      curr_icon: curr_icon,
    },
    success: function (r) {
      toastrSuccessMsg(r);
      setTimeout(function () {}, 1000);
      $("#currencyname").val("");
      $("#curr_icon").val("");
      $("#currencymodal_info").modal("hide");
      $("#currencylist").DataTable().ajax.reload();
      // getcurrency();
    },
  });
}

//========== its for currencyinfo_delete ==========
("use strict");
function currencyinfo_delete(currencyid) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var r = confirm("Are you sure");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/currencyinfo-delete",
      type: "post",
      data: { csrf_test_name: CSRF_TOKEN, currencyid: currencyid },
      success: function (r) {
        toastr.success(r);
        getcurrency();
      },
    });
  }
}

//    ============== its for get app settings =============
("use strict");
function getappsetting() {
  $.ajax({
    url: base_url + enterprise_shortname + "/add-appsetting",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".application_settingshow").html(r);
      $(".placeholder-single").select2();
    },
  });
}

//    ============= its for appsetting save ========
("use strict");
function appsetting_save() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var fd = new FormData();
  var id = $("#id").val();
  var title = $("#title").val();
  var stname = $("#stname").val();
  var address = $("#address").val();
  var email = $("#settingemail").val();
  var phone = $("#phone").val();
  var favicon = $("#favicon").val();
  var old_favicon = $("#old_favicon").val();
  var logo = $("#logo").val();
  var old_logo = $("#old_logo").val();
  var logoTwo = $("#logoTwo").val();
  var old_logoTwo = $("#old_logoTwo").val();
  var logoThree = $("#logoThree").val();
  var old_logoThree = $("#old_logoThree").val();
  var appslogo = $("#appslogo").val();
  var old_apps_logo = $("#old_apps_logo").val();
  var course_header_image = $("#course_header_image").val();
  var old_course_header_image = $("#old_course_header_image").val();
  var faculty_header_image = $("#faculty_header_image").val();
  var old_faculty_header_image = $("#old_faculty_header_image").val();
  var cart_header_image = $("#cart_header_image").val();
  var old_cart_header_image = $("#old_cart_header_image").val();
  var checkout_header_image = $("#checkout_header_image").val();
  var old_checkout_header_image = $("#old_checkout_header_image").val();
  var profile_header_image = $("#profile_header_image").val();
  var old_profile_header_image = $("#old_profile_header_image").val();
  var old_faq_header_image = $("#old_faq_header_image").val();
  var docusign_sample = $("#docusign_sample").val();
  var old_docusign_sample = $("#old_docusign_sample").val();

  var apps_url = $("#apps_url").val();
  var header_color = $("#header_color").val();
  var sidebar_color = $("#sidebar_color").val();
  var sidebar_activecolor = $("#sidebar_activecolor").val();
  var footer_color = $("#footer_color").val();
  var timezone = $("#timezone").val();
  var currency = $("#currency").val();
  var currency_position = $("#currency_position").val();
  var language = $("#language").val();
  var dateformat = $("#dateformat").val();
  var site_align = $("#site_align").val();
  var youtube_api_key = $("#youtube_api_key").val();
  var vimeo_api_key = $("#vimeo_api_key").val();
  var power_text = $("#power_text").val();
 

  fd.append("favicon", $("#favicon")[0].files[0]);
  fd.append("logo", $("#logo")[0].files[0]);
  fd.append("logoTwo", $("#logoTwo")[0].files[0]);
  fd.append("logoThree", $("#logoThree")[0].files[0]);
  // fd.append("appslogo", $("#appslogo")[0].files[0]);
  fd.append("course_header_image", $("#course_header_image")[0].files[0]);
  fd.append("faculty_header_image", $("#faculty_header_image")[0].files[0]);
  // fd.append("cart_header_image", $("#cart_header_image")[0].files[0]);
  // fd.append("checkout_header_image", $("#checkout_header_image")[0].files[0]);
  fd.append("profile_header_image", $("#profile_header_image")[0].files[0]);
  fd.append("faq_header_image", $("#faq_header_image")[0].files[0]);
  fd.append("project_header_image", $("#project_header_image")[0].files[0]);
  fd.append("event_header_image", $("#event_header_image")[0].files[0]);
  fd.append("contactus_header_image", $("#contactus_header_image")[0].files[0]);
  fd.append("forum_header_image", $("#forum_header_image")[0].files[0]);
  fd.append("docusign_sample", $("#docusign_sample")[0].files[0]);

  fd.append("old_favicon", $("#old_favicon").val());
  fd.append("old_logo", $("#old_logo").val());
  fd.append("old_logoTwo", $("#old_logoTwo").val());
  fd.append("old_logoThree", $("#old_logoThree").val());
  fd.append("old_apps_logo", $("#old_apps_logo").val());
  fd.append("old_course_header_image", $("#old_course_header_image").val());
  fd.append("old_faculty_header_image", $("#old_faculty_header_image").val());
  fd.append("old_cart_header_image", $("#old_cart_header_image").val());
  fd.append("old_checkout_header_image", $("#old_checkout_header_image").val());
  fd.append("old_profile_header_image", $("#old_profile_header_image").val());
  fd.append("old_faq_header_image", $("#old_faq_header_image").val());
  fd.append("old_project_header_image", $("#old_project_header_image").val());
  fd.append("old_event_header_image", $("#old_event_header_image").val());
  fd.append("old_contactus_header_image", $("#old_contactus_header_image").val());
  fd.append("old_forum_header_image", $("#old_forum_header_image").val());
  fd.append("old_docusign_sample", $("#old_docusign_sample").val());

  fd.append("id", $("#id").val());
  fd.append("title", $("#title").val());
  fd.append("stname", $("#stname").val());
  fd.append("address", $("#address").val());
  fd.append("email", $("#settingemail").val());
  fd.append("phone", $("#phone").val());
  fd.append("is_ready_subscription", $("#is_ready_subscription").val());
  fd.append("currency", $("#currency").val());
  fd.append("currency_position", $("#currency_position").val());
  fd.append("language", $("#language").val());
  fd.append("dateformat", $("#dateformat").val());
  fd.append("site_align", $("#site_align").val());
  fd.append("youtube_api_key", $("#youtube_api_key").val());
  fd.append("vimeo_api_key", $("#vimeo_api_key").val());
  fd.append("power_text", $("#power_text").val());
  fd.append("apps_url", $("#apps_url").val());
  fd.append("header_color", header_color);
  fd.append("sidebar_color", sidebar_color);
  fd.append("sidebar_activecolor", sidebar_activecolor);
  fd.append("button_color", button_color);
  fd.append("footer_color", footer_color);
  fd.append("timezone", $("#timezone").val());

  fd.append("csrf_test_name", CSRF_TOKEN);

  $.ajax({
    url: base_url + "/dashboard/setting/create",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      setTimeout(function () {}, 1000);
      location.href = base_url + enterprise_shortname + "/settings/84";
    },
  });
}

//============== its for student password change ============
("use strict");
function changepassword() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var user_id = $("#user_id").val();
  var current_password = $("#current_password").val();
  var new_password = $("#new_password").val();
  var retype_password = $("#retype_password").val();

  if (current_password == "") {
    toastrErrorMsg("Current password must be required");
    $("#current_password").focus();
    return false;
  } else if (new_password == "") {
    toastrErrorMsg("New password must be required");
    $("#new_password").focus();
  } else if (retype_password == "") {
    toastrErrorMsg("Retype password must be required");
    $("#retype_password").focus();
    return false;
  }
  if (new_password != retype_password) {
    toastrErrorMsg("New password and retype password does not match");
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/password-update",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      user_id: user_id,
      current_password: current_password,
      new_password: new_password,
      retype_password: retype_password,
    },
    success: function (r) {
      if (r == "0") {
        toastrErrorMsg("Current password does not match");
        return false;
      } else {
        setTimeout(function () {
          toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: "slideDown",
            timeOut: 1500,
            onHidden: function () {
              location.reload();
            },
          };
          toastr.success(r);
        }, 1000);
      }
    },
  });
}

//    =========== its for activities log  ==============
("use strict");
function activitieslog() {
  $.ajax({
    url: base_url + enterprise_shortname + "/get-activitieslog",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      $(".activities_logshow").html(r);

      var activitiesloglist = $("#activitiesloglist").DataTable({
        responsive: true,
        aaSorting: [[0, "desc"]],
        columnDefs: [
          {
            bSortable: false,
            aTargets: [0],
          },
          {
            targets: [3, 4, 5],
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
          url: base_url + enterprise_shortname + "/get-activitieslogdatalist",
          data: function (data) {
            data.csrf_test_name = CSRF_TOKEN;
          },
        },

        columns: [
          { data: "sl" },
          { data: "title" },
          { data: "action" },
          { data: "enterprise_name" },
          { data: "created_by" },
          { data: "created_date" },
        ],
      });
    },
  });
}

//    ============= its for get featured in ==============
("use strict");
function getfeaturedin() {
  $.ajax({
    url: base_url + enterprise_shortname + "/get-featuredin",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      // console.log(r);
      setTimeout(function () {
        $(".content-loder").hide();
      }, 50);
      $(".getfeaturedinshow").html(r);
      var companydatalist = $("#featuredin_datalist").DataTable({
        responsive: true,
        aaSorting: [[0, "desc"]],
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
          url: base_url + enterprise_shortname + "/get-featuredinlist",
          data: function (data) {
            data.csrf_test_name = CSRF_TOKEN;
          },
        },

        columns: [
          { data: "sl" },
          { data: "name" },
          { data: "link" },
          { data: "ordering" },
          { data: "picture" },
          { data: "action" },
        ],
      });
    },
  });
}

//========== its for featuredin info save =============
function featuredin_infosave() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var fd = new FormData();
  var name = $("#featuredin_name").val();
  var link = $("#link").val();
  fd.append("logo", $("#logofeaturedin")[0].files[0]);
  fd.append("name", $("#featuredin_name").val());
  fd.append("link", $("#link").val());
  fd.append("ordering", $("#ordering").val());
  fd.append("csrf_test_name", CSRF_TOKEN);
  if (name == "") {
    $("#featuredin_name").focus();
    toastrErrorMsg("Name must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/featuredin-infosave",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      setTimeout(function () {}, 1000);
      $("#featuredin_name").val("");
      $("#logofeaturedin").val("");
      $("#image-preview-featuredin").hide();
      // getfeaturedin();
      $("#featuredin_datalist").DataTable().ajax.reload();
    },
  });
}
//========== its for featuredin edit =============
function featuredin_edit(featuredin_id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/featuredin-edit",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, featuredin_id: featuredin_id },
    success: function (r) {
      $(".modal_ttlf").html("Featuredin information update");
      $("#infosf").html(r);
      $("#modal_infosf").modal("show");
    },
  });
}

//========== its for featuredin info update =============
("use strict");
function featuredin_infoupdate(featuredin_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }
  var fd = new FormData();
  var name = $("#c_name").val();
  var link = $("#c_link").val();
  var old_logo = $("#old_logo").val();
  var base_url = $("#base_url").val();
  var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  fd.append("logo", $("#c_logo")[0].files[0]);
  fd.append("name", $("#c_name").val());
  fd.append("link", $("#c_link").val());
  fd.append("ordering", $("#edit_ordering").val());
  fd.append("old_logo", $("#old_logo").val());
  fd.append("old_featured_filename", $("#old_featured_filename").val());
  fd.append("featuredin_id", featuredin_id);
  fd.append("csrf_test_name", CSRF_TOKEN);
  if (name == "") {
    $("#c_name").focus();
    toastrErrorMsg("Name must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/featuredin-infoupdate",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      setTimeout(function () {}, 1000);
      $("#name").val("");
      $("#modal_infosf").modal("hide");
      $("#infosf").modal("hide");
      $("#featuredin_datalist").DataTable().ajax.reload();
    },
  });
}
//========== its for featuredin info delete =============
function featuredin_delete(featuredin_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }
  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/featuredin-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, featuredin_id: featuredin_id },
      success: function (r) {
        toastrSuccessMsg(r);
        $("#featuredin_datalist").DataTable().ajax.reload();
      },
    });
  }
}


//    ============= its for ourfeaturessave ==========
("use strict");
function ourfeaturessave() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var fd = new FormData();
  var title = $("#featuretitle").val();
  var link = $("#featurelink").val();
  var summary = $("#featuresummary").val();
  var ordering = $("#featureordering").val();
  fd.append("image", $("#ourfeatureimage")[0].files[0]);
  fd.append("title", $("#featuretitle").val());
  fd.append("link", $("#featurelink").val());
  fd.append("summary", $("#featuresummary").val());
  fd.append("ordering", $("#featureordering").val());
  fd.append("csrf_test_name", CSRF_TOKEN);

  if (title == "") {
    $("#featuretitle").focus();
    toastrErrorMsg("Title must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }

  if (link == "") {
    $("#featurelink").focus();
    toastrErrorMsg("Link must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }
  if (summary == "") {
    $("#featuresummary").focus();
    toastrErrorMsg("Summary must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }
  if (ordering == "") {
    $("#featureordering").focus();
    toastrErrorMsg("Ordering must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/ourfeatures-save",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      setTimeout(function () {}, 1000);
      $("#featuretitle").val("");
      $("#featurelink").val("");
      $("#featuresummary").val("");
        $("#ourfeature_datalist").DataTable().ajax.reload();
    },
  });
}

//========== its for ourfeature edit =============
function ourfeature_edit(featuredin_id) {
  
  $.ajax({
    url: base_url + enterprise_shortname + "/ourfeature-edit",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, featuredin_id: featuredin_id },
    success: function (r) {
      $(".modal_ttlour").html("Our Feature Information");
      $("#infoour").html(r);
      $("#modal_infoour").modal("show");
    },
  });
}


//========== its for ourfeature update info update =============
("use strict");
function ourfeature_update(featuredin_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var fd = new FormData();
  var name = $("#edit_featurtitle").val();
  var link = $("#edit_featurelink").val();
  var summary = $("#edit_featuresummary").val();
  var ordering = $("#edit_featureordering").val();
  var old_logo = $("#old_ourfeaturelogo").val();
  fd.append("logo", $("#edit_ourfeaturelogo")[0].files[0]);
  fd.append("name", $("#edit_featurtitle").val());
  fd.append("link", $("#edit_featurelink").val());
  fd.append("summary", $("#edit_featuresummary").val());
  fd.append("ordering", $("#edit_featureordering").val());
  fd.append("old_logo", $("#old_ourfeaturelogo").val());
  fd.append("old_ourfeature_filename", $("#old_ourfeature_filename").val());
  fd.append("featuredin_id", featuredin_id);
  fd.append("csrf_test_name", CSRF_TOKEN);
  if (name == "") {
    $("#edit_featurtitle").focus();
    toastrErrorMsg("Title must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }
  if (link == "") {
    $("#edit_featurelink").focus();
    toastrErrorMsg("Link must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }
  if (summary == "") {
    $("#edit_featuresummary").focus();
    toastrErrorMsg("Summary must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }
  if (ordering == "") {
    $("#edit_featureordering").focus();
    toastrErrorMsg("Ordering must be required!");
    setTimeout(function () {}, 1000);
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/ourfeature-infoupdate",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      setTimeout(function () {}, 1000);
      $("#edit_featurtitle").val("");
      $("#edit_featurelink").val("");
      $("#edit_featuresummary").val("");
      $("#modal_infoour").modal("hide");
      $("#infoour").modal("hide");
      $("#ourfeature_datalist").DataTable().ajax.reload();
    },
  });
}

//========== its for our feature info delete =============
function ourfeature_delete(featuredin_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }
  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/ourfeature-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, featuredin_id: featuredin_id },
      success: function (r) {
        toastrSuccessMsg(r);
        $("#ourfeature_datalist").DataTable().ajax.reload();
      },
    });
  }
}

//    ============== its for get  website setting =============
("use strict");
function website_settingform() {
  $.ajax({
    url: base_url + enterprise_shortname + "/website-settingform",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      $(".website_settngsshow").html(r);
    },
  });
}

// ============== its for website_settingupate ==============
"use strict";
function website_settingupate(){
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }
  var fd = new FormData();
  var id = $("#id").val();
  var subscription_savetitle = $("#subscription_savetitle").val();
  var anyquestion_title = $("#anyquestion_title").val();
  var footer_about = $("#footer_about").val();
  var footer_text = $("#footer_text").val();
  var facebook_link = $("#facebook_link").val();
  var twitter_link = $("#twitter_link").val();
  var youtube_link = $("#youtube_link").val();
  var instagram_link = $("#instagram_link").val();
  
  
  var old_footer_logo = $("#old_footer_logo").val();
  var old_anyquestion_picture = $("#old_anyquestion_picture").val();
  var old_signin_picture = $("#old_signin_picture").val();
  var old_signup_picture = $("#old_signup_picture").val();
  // console.log($("#signin_picture")[0].files[0]); return false;
  // alert(id);return false;
  fd.append("anyquestion_picture", $("#anyquestion_picture")[0].files[0]);
  fd.append("footer_logo", $("#footer_logo")[0].files[0]);
  fd.append("signin_picture", $("#signin_picture")[0].files[0]);
  fd.append("signup_picture", $("#signup_pictures")[0].files[0]);

  fd.append("id", id);
  fd.append("subscription_savetitle", subscription_savetitle);
  fd.append("anyquestion_title", anyquestion_title);
  fd.append("footer_text", $("#footer_text").val());
  fd.append("footer_about", $("#footer_about").val());
  fd.append("facebook_link", $("#facebook_link").val());
  fd.append("twitter_link", $("#twitter_link").val());
  fd.append("youtube_link", $("#youtube_link").val());
  fd.append("instagram_link", $("#instagram_link").val());
  fd.append("old_anyquestion_picture", old_anyquestion_picture);
  fd.append("old_footer_logo", old_footer_logo);
  fd.append("old_signin_picture", old_signin_picture);
  fd.append("old_signup_picture", old_signup_picture);
  fd.append("csrf_test_name", CSRF_TOKEN);

  $.ajax({
    url: base_url + enterprise_shortname +"/website-settingupate",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      // location.href = base_url + enterprise_shortname + "/home-page-setting/5";
    },
  });

}

//    ============== its for get  strength_number =============
("use strict");
function strength_number() {
  $.ajax({
    url: base_url + enterprise_shortname + "/strength-number",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      // setTimeout(function () {
      //   $(".content-loder").hide();
      // }, 50);
      $(".strength_numbershow").html(r);
    },
  });
}


// ============== its for strengthnumber_upate ==============
"use strict";
function strengthnumber_upate(){
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }
  var fd = new FormData();
  var id = $("#id").val();
  var learner_count = $("#learner_count").val();
  var total_course = $("#total_course").val();
  var language_count = $("#language_count").val();
  var successfully_students = $("#successfully_students").val();

  fd.append("id", id);
  fd.append("learner_count", learner_count);
  fd.append("total_course", total_course);
  fd.append("language_count", language_count);
  fd.append("successfully_students", successfully_students);
  fd.append("csrf_test_name", CSRF_TOKEN);

  $.ajax({
    url: base_url + enterprise_shortname +"/strengthnumber-upate",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      // location.href = base_url + enterprise_shortname + "/home-page-setting/5";
    },
  });

}


//    ============= its for getsubscriberlist ==============
("use strict");
function need_consultation() {
  $.ajax({
    url: base_url + enterprise_shortname + "/need-consultation",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      setTimeout(function () {
      }, 50);
      $(".need_consultationshow").html(r);

      var subscriberlist = $("#consultationlist").DataTable({
        responsive: true,
        // aaSorting: [[0, "desc"]],
        columnDefs: [
          {
            bSortable: true,
            aTargets: [0],
          },
          // {
          //   targets: [2],
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
        ],

        lengthMenu: [
          [20, 50, 100, 150, 200, 500],
          [20, 50, 100, 150, 200, "All"],
        ],
        processing: true,
        sProcessing: "<span class='fas fa-sync-alt'></span>",
        serverSide: true,
        serverMethod: "post",

        ajax: {
          url: base_url + enterprise_shortname + "/get-consultationlist",
          data: function (data) {
            data.csrf_test_name = CSRF_TOKEN;
          },
        },

        columns: [
                  { data: "sl" }, 
                  { data: "name" }, 
                  { data: "mobile" }, 
                  { data: "email" }, 
                  { data: "whoami" }, 
                  { data: "organization" }, 
                  { data: "preffered_date" }, 
                  { data: "message" }
                ],
      });
    },
  });
}

//    ============= its for get featured in ==============
("use strict");
function paywith() {
  $.ajax({
    url: base_url + enterprise_shortname + "/paywith",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      // console.log(r);
      // setTimeout(function () {
      //   $(".content-loder").hide();
      // }, 50);
      $(".paywithshow").html(r);
      var paywith_datalist = $("#paywith_datalist").DataTable({
        responsive: true,
        // aaSorting: [[0, "desc"]],
        columnDefs: [
          {
            bSortable: true,
            aTargets: [0],
          },
          {
            bSortable: false,
            targets: [2],
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
          [10, 50, 100, 150, 200, 250],
          [10, 50, 100, 150, 200, "All"],
        ],
        processing: true,
        sProcessing: "<span class='fas fa-sync-alt'></span>",
        serverSide: true,
        serverMethod: "post",

        ajax: {
          url: base_url + enterprise_shortname + "/get-paywithlist",
          data: function (data) {
            data.csrf_test_name = CSRF_TOKEN;
          },
        },

        columns: [
          { data: "sl" },
          { data: "logo" },
          { data: "action" },
        ],
      });
    },
  });
}


//========== its for paywith info save =============
function paywith_infosave() {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  if ($('.img-load img').attr('src') == '') {
    toastrErrorMsg('please submit a logo!');
    return false;
  }

  var fd = new FormData();
  fd.append("logo", $("#logopaywith")[0].files[0]);
  fd.append("csrf_test_name", CSRF_TOKEN);
  
  $.ajax({
    url: base_url + enterprise_shortname + "/paywith-infosave",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      setTimeout(function () {}, 1000);
      $("#logopaywith").val("");
      $(".img-load").html('<img id="image-preview-paywith" src="" alt="" class="border border-2" width="200px">');
      $("#paywith_datalist").DataTable().ajax.reload();
    },
  });
}
//========== its for paywith edit =============
function paywith_edit(id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/paywith-edit",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, id: id },
    success: function (r) {
      $(".modal_ttlf").html("Paywith information update");
      $("#infosf").html(r);
      $("#modal_infosf").modal("show");
    },
  });
}

//========== its for paywith info update =============
("use strict");
function paywith_infoupdate(id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }
  var fd = new FormData();
  fd.append("logo", $("#edit_paywithlogo")[0].files[0]);
  fd.append("old_logo", $("#old_paywithlogo").val());
  fd.append("id", id);
  fd.append("csrf_test_name", CSRF_TOKEN);
  
  $.ajax({
    url: base_url + enterprise_shortname + "/paywith-infoupdate",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      setTimeout(function () {}, 1000);
      $("#name").val("");
      $("#modal_infosf").modal("hide");
      $("#infosf").modal("hide");
      $("#paywith_datalist").DataTable().ajax.reload();
    },
  });
}
//========== its for paywith info delete =============
function paywith_delete(id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }
  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/paywith-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, id: id },
      success: function (r) {
        toastrSuccessMsg(r);
        $("#paywith_datalist").DataTable().ajax.reload();
      },
    });
  }
}