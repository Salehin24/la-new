(function ($) {
  "use strict";
  $("document").ready(function () {
    //    ========= its for rating star ==============
    var base_url = $("#base_url").val();
    $('[data-toggle="tooltip"]').tooltip();
    var session_id = $("#session_id").val();
    var cart_contents = $("#cart_contents").val();
    var CSRF_TOKEN = $("#CSRF_TOKEN").val();
    var enterprise_id = $("#enterprise_id").val();
    var enterprise_shortname = $("#enterprise_shortname").val();
  
    

    // var segment2 = $("#segment2").val();
    // if(segment2 == "student-dashboard"){
    //   $(".student-dashboard").addClass("active");
    // }else if (segment2 == "student-profile-dashboard") {
    //   $(".student-profile-dashboard").addClass("active");
    // } else if (segment2 == "student-activity") {
    //   $(".student-activity").addClass("active");
    // } else if (segment2 == "student-notification") {
    //   $(".student-notification").addClass("active");
    // } else if (segment2 == "student-settings-account") {
    //   $(".student-settings-account").addClass("active");
    //   $(".settings-account").addClass("active");
    // } else if (segment2 == "student-settings-notification") {
    //   $(".student-settings-account").addClass("active");
    //   $(".settings-notification").addClass("active");
    // } else if (segment2 == "student-settings-payments") {
    //   $(".student-settings-account").addClass("active");
    //   $(".settings-payments").addClass("active");
    // }


    /* ---------------------------------------------
         Pre loader loader 
         --------------------------------------------- */
    $(".se-pre-con").fadeOut("slow");

  });
})(jQuery);

var base_url = $("#base_url").val();
var CSRF_TOKEN = $("#CSRF_TOKEN").val();
var enterprise_id = $("#enterprise_id").val();
var enterprise_shortname = $("#enterprise_shortname").val();
var user_id = $("#user_id").val();
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

// //            ========= its for toastr error message =============
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
// //            ========= its for toastr success message =============
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






// //=========== its for special character remove =========
("use strict");
function special_character_remove(vtext, id) {
  var specialChars = $("#security_character").val();
  var check = function (string) {
    for (i = 0; i < specialChars.length; i++) {
      if (string.indexOf(specialChars[i]) > -1) {
        return true;
      }
    }
    return false;
  };
  if (check($("#" + id).val()) == false) {
    // Code that needs to execute when none of the above is in the string
  } else {
    toastrErrorMsg(specialChars + " these special character are not allowed");
    $("#" + id)
      .val("")
      .focus();
  }
}
// //=========== its for only number allow=========
("use strict");
function onlynumber_allow(vtext, id) {
  var specialChars = $("#onlynumber_allow").val();
  var check = function (string) {
    for (i = 0; i < specialChars.length; i++) {
      if (string.indexOf(specialChars[i]) > -1) {
        return true;
      }
    }
    return false;
  };
  if (check($("#" + id).val()) == false) {
    // Code that needs to execute when none of the above is in the string
  } else {
    toastrErrorMsg(specialChars + " these special character are not allowed");
    $("#" + id)
      .val("")
      .focus();
  }
}




