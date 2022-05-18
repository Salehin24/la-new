// form update validation 
"use strict";
$("body").on("click", "#libraryupdate",function() {
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
    var source = $("#source").val();
    var level = $("#level").val();
    var content_providers = $("#content_provider").val();
    if (name == "") {
        toastrErrorMsg("Name field must be required");
        return false;
    }
    if (faculty_id == "") {
        toastrErrorMsg("Faculty field must be required");
        return false;
    }
    if (category_id == "") {
        toastrErrorMsg("Category field must be required");
        return false;
    }
    if (level == "") {
        toastrErrorMsg("Level field must be required");
        return false;
    }

    if (source == "") {
        toastrErrorMsg("File upload field must be required");
        return false;
    }
    if (content_providers == "") {
        toastrErrorMsg("File Type field must be required");
        return false;
    }
    if (price == "" && is_free == 0) {
        toastrErrorMsg("Price or free field must be required");
        return false;
    }

});

// source image
var sourceimage = $("#sourceimage").val();
function fileUploadRequired() {
    var inp = document.getElementById("sourceimage");
    if (inp.files.length == 0) {
        alert("Attachment Required");
        inp.focus();
        return false;
    }
}
(function($) {
    "use strict";
    //=========next and previous===============
    $("body").on("click", ".btnNext", function() {
        $(".nav-pills .active").parent().next("li").find("a").trigger("click");
        $('.btnPrevious').removeClass('active');
    });
    $("body").on("click", ".btnPrevious", function() {
        $(".nav-pills .active").parent().next("li").find("a").trigger("click");
        $('.btnNext').removeClass('active');
    });

    //======== checkbox is_free  ==========
    $("body").on("click", "#is_free", function() {
        if ($("#is_free").is(":checked")) {
            $("#is_free").attr("value", "1");
            $(".dependent_freecourse").html("");
        } else {

            $(".dependent_freecourse").html(
                "<div class='form-group row'>\n\
         <label for='price' class='col-sm-2'>Price </label>\n\
       <div class='col-sm-6'>\n\
        <input name='price' class='form-control' type='text' placeholder='Price' id='price' onkeyup='onlynumber_allow(this.value,'price')'>\n\
        </div>\n\
        </div>\n\
<div class='form-group row'><label for='oldprice' class='col-sm-2'>Old Price</label><div class='col-sm-6'> <input name='oldprice' class='form-control' type='text' placeholder='Old Price' id='oldprice' onkeyup='onlynumber_allow(this.value, 'oldprice')'></div></div>\n\
        "
            );
            $("#is_free").attr("value", "0");
        }
    });
    //        ======= checkbox is discount  ==========
    $("body").on("click", "#is_discount", function() {
        if ($("#is_discount").is(":checked")) {
            $("#is_discount").attr("value", "1");
            $(".dependent_discountcourse").html(
                "<div class='form-group row'>\n\
                <label for='discount' class='col-sm-2'>Discount</label>\n\
                <div class='col-sm-6'>\n\
                    <input name='discount' class='form-control' type='number'\n\
                        placeholder='Discount' id='discount' onkeyup='onlynumber_allow(this.value, 'oldprice')'>\n\
                </div>\n\
            </div>"
            );
            $("#is_discount").attr("value", "1");
        } else {
            $(".dependent_discountcourse").html("");
        }
    });
})(jQuery);