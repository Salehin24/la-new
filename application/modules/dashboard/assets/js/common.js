(function ($) {
    "use strict";
    $(document).ready(function () {
        // Enable pusher logging - don't include this in production
        var base_url = $("#base_url").val();
        var enterprise_shortname = $("#enterprise_shortname").val();
        var enterprise_id = $("#enterprise_id").val();
        var api_key = $("#api_key").val();
        var cluster = $("#cluster").val();

        // Pusher.logToConsole = true;
        // var pusher = new Pusher(api_key, {
        //     cluster: cluster,
        //     forceTLS: true
        // });

        // var channel = pusher.subscribe('my-channel');
        // channel.bind('my-event', function (data) {
        //     var obj = JSON.parse(JSON.stringify(data));
        //         // console.log(obj.message);
        //     // if (obj.message == 'faculty-registration') {
        //       $("#pending-faculty-count").text(obj.message);
        //     //     $("#pending-faculty-count").addClass('label label-danger');
        //     //     $(".linkpopulate").attr('href', base_url + 'faculty-list');
        //     // } else if (obj.message == 'course-pending') {
        //     //     $("#pending-faculty-count").text(obj.count);
        //     //     $("#pending-faculty-count").addClass('label label-danger');
        //     //     $(".linkpopulate").attr('href', base_url + 'course-list');
        //     // }
        // });
//        ============= close pusher configuration =============

//        ========== its for disabled demo mode =============
        $("body").on('click', '#disabled_btn', function () {
            var productmode = $("#productmode").val();
            if (productmode == 'demo') {
                toastrWarningMsg("It is disabled for demo mode!");
                return false;
            }
        });

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });

        $("#yearmonth_picker").datepicker({
            format: "yyyy-mm",
            viewMode: "months",
            minViewMode: "months",
            autoclose: true
        });
        $("#yearmonth_picker_sales").datepicker({
            format: "yyyy-mm",
            viewMode: "months",
            minViewMode: "months",
            autoclose: true
        });
        $("#yearmonth_todays_sales").datepicker({
            format: "yyyy-mm",
            viewMode: "months",
            minViewMode: "months",
            autoclose: true
        });
        $("#yearmonth_picker").datepicker({
            format: "yyyy-mm",
            viewMode: "months",
            minViewMode: "months",
            autoclose: true
        });
        $('.time_picker').datetimepicker({
//            format: 'HH:mm',
            format: 'HH:mm:ss',
        });
        $('.timepicker_hm').datetimepicker({
           format: 'HH:mm',
        });
        var segment1 = $("#segment1").val();
        var segment2 = $("#segment2").val();
     
     if(segment2 == 'home'){   
        $('.dashboard').addClass('mm-active');
    }else if (segment2 == 'course-edit' || segment2 == 'faculty-course-revenue' || segment2 == 'add-exam' || segment2 == 'exam-list' || segment2 == 'exam-edit' || segment2 == 'course-exam-edit') {
            $('.course').addClass('mm-active');
            $('#course').addClass('mm-show');
        } else if (segment2 == 'student-edit') {
            $(".students").addClass("mm-active");
            $("#students").addClass("mm-show");
        } else if (segment2 == 'faculty-edit') {
            $(".instructor").addClass("mm-active");
            $("#instructor").addClass("mm-show");
        } else if (segment2 == 'event-edit') {
            $(".news_and_events").addClass("mm-active");
            $("#news_and_events").addClass("mm-show");
        } else if(segment2 == 'category' || segment2 == 'category-edit'){
            $(".categories").addClass("mm-active");
            $("#categories").addClass("mm-show");
        } else if(segment2 == 'edit-coupon'){
            $(".coupon").addClass("mm-active");
            $("#coupon").addClass("mm-show");
        } else if(segment2 == 'live-course-list' || segment2 == 'live-course-edit' || segment2 == 'event-list' || segment2 == 'live-event-edit' || segment2 == 'zoom-config'){
            $(".events_or_live").addClass("mm-active");
            $("#events_or_live").addClass("mm-show");
        } else if(segment2 == 'showassign-certificate'){
            $(".certificate").addClass("mm-active");
            $("#certificate").addClass("mm-show");
        }

//        ====== its for web font ==========
        WebFont.load({
            google: {
                families: ['Nunito+Sans:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&display=swap']
            }
        });


//        ============= its for purchase addons =============
        $("body").on('click', '#install_now', function () {
            $(this).attr('disabled', 'disabled');
            var purchase_key = $('#purchase_key').val();
            var itemtype = $('#itemtype').val();

            if (purchase_key == '') {
                toastrErrorMsg("Please enter purchase key!");
                return false;
            }
            if (itemtype == '') {
                toastrErrorMsg("Please enter item type!");
                return false;
            }

            $("#loading").show();
            $(".waitmsg").css('display', 'block');

            $.ajax({
                type: 'post',
                url: base_url + "verify-purchase-request",
                data: "purchase_key=" + purchase_key + "&itemtype=" + itemtype,
                success: function (res) {
//                    console.log(res);                    return false;
                    if (res) {
                        // Timer set
                        var wait = 10000; //10 seconds
                        var time = 10;
                        setInterval(function () {
                            $("#wait").html(time);
                            time--;
                        }, 1000);
                        // End of Timer Set
                        setTimeout(function () {
                            window.location.href = base_url + "add-ons";
                        }, wait);
                    } else {
                        alert("Failed! Please Try Again");
                        $("#loading").hide();
                        $(".waitmsg").css('display', 'none');
                    }
                },
                error: function () {
                    alert("ERROR! Please Try Again");
                    $("#loading").hide();
                    $(".waitmsg").css('display', 'none');
                }
            });
        });

        // var max = 4;
        // $('.carrer-out-1').keypress(function(e) {
        //     if (e.which < 0x20) {
        //         // e.which < 0x20, then it's not a printable character
        //         // e.which === 0 - Not a character
        //         return;     // Do nothing
        //     }
        //     if (this.value.length == max) {
        //         e.preventDefault();
        //     } else if (this.value.length > max) {
        //         // Maximum exceeded
        //         this.value = this.value.substring(0, max);
        //     }
        // });

    });
}(jQuery));

//=========== its for mail special character remove ========= 
"use strict";
function mail_specialcharacter_remove(vtext, id) {
    var specialChars = $("#mail_specialcharacter_remove").val();
    var check = function (string) {
        for (i = 0; i < specialChars.length; i++) {
            if (string.indexOf(specialChars[i]) > -1) {
                return true
            }
        }
        return false;
    }
    if (check($('#' + id).val()) == false) {
        // Code that needs to execute when none of the above is in the string
    } else {
        toastrErrorMsg(specialChars + " these special character are not allowed")
        $("#" + id).val('').focus();
    }
}
//=========== its for special character remove =========
"use strict";
function special_character_remove(vtext, id) {
    var specialChars = $("#security_character").val();
    var check = function (string) {
        for (i = 0; i < specialChars.length; i++) {
            if (string.indexOf(specialChars[i]) > -1) {
                return true
            }
        }
        return false;
    }
    if (check($('#' + id).val()) == false) {
// Code that needs to execute when none of the above is in the string
    } else {
        toastrErrorMsg(specialChars + " these special character are not allowed")
        $("#" + id).val('').focus();
    }
}
//=========== its for coursespecial_character_remove =========
"use strict";
function coursespecial_character_remove(vtext, id) {
    var specialChars = $("#coursespecial_character").val();
    var check = function (string) {
        for (i = 0; i < specialChars.length; i++) {
            if (string.indexOf(specialChars[i]) > -1) {
                return true
            }
        }
        return false;
    }
    if (check($('#' + id).val()) == false) {
// Code that needs to execute when none of the above is in the string
    } else {
        toastrErrorMsg(specialChars + " these special character are not allowed")
        $("#" + id).val('').focus();
    }
}
//=========== its for only number allow=========
"use strict";
function onlynumber_allow(vtext, id) {
    var specialChars = $("#onlynumber_allow").val();
    var check = function (string) {
        for (i = 0; i < specialChars.length; i++) {
            if (string.indexOf(specialChars[i]) > -1) {
                return true
            }
        }
        return false;
    }
    if (check($('#' + id).val()) == false) {
// Code that needs to execute when none of the above is in the string
    } else {
        toastrErrorMsg(specialChars + " these special character are not allowed")
        $("#" + id).val('').focus();
    }
}
//            ========= its for toastr warning message =============
"use strict";
function toastrWarningMsg(r) {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    }
    toastr.warning(r);
}
//            ========= its for toastr error message =============
"use strict";
function toastrErrorMsg(r) {
    setTimeout(function () {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 1500,
        };
        toastr.error(r);
    }, 1000);
}
//            ========= its for toastr error message =============
"use strict";
function toastrSuccessMsg(r) {
    setTimeout(function () {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 1500,
        };
        toastr.success(r);
    }, 1000);
}
//=========== its for valid mail check ===============
"use strict";
function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        return false;
    } else {
        return true;
    }
}

//============ its for unique mail check =========
"use strict";
function unique_usernamecheck(d) {
    var base_url = $("#base_url").val();
    $.ajax({
        url: base_url + "checkuser-uniqueemail",
        type: "post",
        data: {email: d},
        success: function (data) {
            if (data != 0) {
                $("#email").css({'border': '2px solid red'}).focus();
                $("#username").css({'border': '2px solid red'}).focus();
                toastrErrorMsg("This email already exists!");
                $("#email").val('');
                $("#username").val('');
                return false;
            } else {
                $("#email").css({'border': '2px solid green'});
                $("#username").css({'border': '2px solid green'});
            }
        }
    });
}

//============= its for revenuestatus_monthyear =========
"use strict";
function revenuestatus_monthyear() {
    // var base_url = $("#base_url").val();
    // var CSRF_TOKEN = $('#CSRF_TOKEN').val();
    var yearmonth = $("#yearmonth_picker").val();
    
    if (yearmonth == '') {
        toastrErrorMsg("Empty filed not allow");
        return false;
    }
    $.ajax({
        url: base_url + enterprise_shortname +"/revenuestatus-monthyear",
        type: "POST",
        data: {'csrf_test_name': CSRF_TOKEN, yearmonth: yearmonth},
        success: function (r) {
            $("#revenueStatusResults").html(r);
        }
    });
}
//============= its for yearmonthly_salesamount ==============
"use strict";
function yearmonthly_salesamount() {
    var yearmonth_picker_sales = $("#yearmonth_picker_sales").val();
    if (yearmonth_picker_sales == '') {
        toastrErrorMsg("Empty field not allow");
        return false;
    }
    $.ajax({
        url: base_url + enterprise_shortname +"/yearmonthly-salesamount",
        type: "POST",
        data: {'csrf_test_name': CSRF_TOKEN, yearmonth_picker_sales: yearmonth_picker_sales},
        success: function (r) {
            $("#salesAmountResults").html(r);
        }
    });
}
//============= its for yearmonthly_todaysales =============
"use strict";
function yearmonthly_todaysales() {
    var yearmonth_todays_sales = $("#yearmonth_todays_sales").val();
    if (yearmonth_todays_sales == '') {
        toastrErrorMsg("Empty field not allow");
        return false;
    }
    $.ajax({
        url: base_url + enterprise_shortname+"/yearmonth-todays-sales",
        type: "POST",
        data: {'csrf_test_name': CSRF_TOKEN, yearmonth_todays_sales: yearmonth_todays_sales},
        success: function (r) {
            $("#filtering_results").html(r);
        }
    });
}

//    ============= add show category ============
("use strict");
function showcategory(category_id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/show-category",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, category_id: category_id },
    success: function (r) {
      $(".modal_ttl").html("Category Information");
      $("#info").html(r);
      $("#modal_info").modal("show");
    },
  });
}
//    ============= add show instructor ============
("use strict");
function showinstructor(faculty_id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/show-instructor",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, faculty_id: faculty_id },
    success: function (r) {
      $(".modal_ttl").html("Instructor Information");
      $("#info").html(r);
      $("#modal_info").modal("show");
    },
  });
}



// image preview js 
function fileValueOne(value,sectionval) {
    // all old preview image hide
    $('.img_border').hide();
    var path = value.value;
    var extenstion = path.split('.').pop();
    if (extenstion == "jpg" || extenstion == "svg" || extenstion == "jpeg" || extenstion == "png" || extenstion == "gif" || extenstion == "webp") {
      document.getElementById('image-preview-'+sectionval).src = window.URL.createObjectURL(value.files[0]);
        var filename = path.replace(/^.*[\\\/]/, '').split('.').slice(0, -1).join('.');
        // document.getElementById("filename").innerHTML = filename;
    } else {
        alert("File not supported. Kindly Upload the Image of below given extension ")
    }
}



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
  
  // ============= its for uploadCV ==============
  function uploadProgress(fileid) {
    //   alert(fileid);return false;
    filetypecheck(fileid);
    var fd = new FormData();
  
    // fd.append("resume", $("#syllabus")[0].files[0]);
    fd.append("resume", $("#"+fileid)[0].files[0]);
  
    // fd.append("name", $("#resume").val());
    $.ajax({
      type: "POST",
      url: base_url + enterprise_shortname + "/fileupload-progressbar-check",
      // data: new FormData(this),
      data: fd,
      contentType: false,
      cache: false,
      processData: false,
  
      error: function () {
        $("#uploadStatus").html(
          '<span style="color:#EA4335;">File upload failed, please try again.</span>'
        );
      },
      success: function (resp) {
        // console.log(resp);
        if (resp == "ok") {
          $("#uploadStatus").html(
            '<span style="color:#28A74B;">File has attached successfully!</span>'
          );
          $(".progress-area").html(
            '<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">100%</div></div>'
          );
        } else if (resp == "err") {
          $(".progress-area").html("");
          $("#uploadStatus").html(
            '<span style="color:#EA4335;">Please select a valid file to upload.</span>'
          );
        }
      },
    });
  }

//   ============= its for characterlimitation 
function characterlimitation(cls, sl, maxchars, msgcls){
    var value = $('.'+cls+'-'+sl).val();
    var tlength = value.length;
    $('.'+cls+'-'+sl).val(value.substring(0, maxchars));
    remain = maxchars - parseInt(tlength);
    $('.'+msgcls+'-'+sl).text(remain);
}