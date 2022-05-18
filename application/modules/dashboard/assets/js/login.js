(function ($) {
    "use strict";
    $(document).ready(function () {
        var info = $('table tbody tr');
        info.click(function () {
            var email = $(this).children().first().text();
            var password = $(this).children().first().next().text();
            var user_role = $(this).attr('data-role');

            $("input[type=text]").val(email);
            $("input[type=password]").val(password);
            $('select option[value=' + user_role + ']').attr("selected", "selected");
        });
    });
}(jQuery));

//    ============ its for is popular value add ============
"use strict";
function is_remember() {
    if ($("#rememberme").is(':checked')) {
        $('#rememberme').attr('value', '1');
    } else {
        $('#rememberme').attr('value', '0');
    }
}

function passShow() {
    "use strict";
    var x = document.getElementById("inputPassword");
    if (x.type === "password") {
      $("i").addClass("fa fa-eye-slash");
      x.type = "text";
    } else {
      $("i").removeClass("fa fa-eye-slash");
      $("i").addClass("fa fa-eye");
      x.type = "password";
    }
  }

