(function ($) {
    "use strict";
    $(document).ready(function () {
        var CSRF_TOKEN = $("#CSRF_TOKEN").val();
        var usertype = $("#usertype").val();
        var base_url = $("#base_url").val();
        var enterprise_shortname = $("#enterprise_shortname").val();
        var enterprise_id = $("#enterprise_id").val();
//        ========== its for summary editor ============
        var forumckeditor = $("#forumckeditor").val();
        if (forumckeditor == 1) {
            // CKEDITOR.replace('forumdescription', {
            //     toolbarGroups: [{
            //             "name": "basicstyles",
            //             "groups": ["basicstyles"]
            //         },
            //         {
            //             "name": "links",
            //             "groups": ["links"]
            //         },
            //         {
            //             "name": "paragraph",
            //             "groups": ["list", "blocks"]
            //         },
            //         {
            //             "name": "document",
            //             "groups": ["mode"]
            //         },
            //         {
            //             "name": "insert",
            //             "groups": ["insert"]
            //         },
            //         {
            //             "name": "styles",
            //             "groups": ["styles"]
            //         },
            //         {
            //             "name": "about",
            //             "groups": ["about"]
            //         }
            //     ],
            //     // Remove the redundant buttons from toolbar groups defined above.
            //     removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
            // });
        }

//        ========== its for disabled demo mode =============
        $("body").on('click', '#forumdisabled_btn', function () {
            var productmode = $("#productmode").val();
            if (productmode == 'demo') {
                toastrWarningMsg("It is disabled for demo mode!");
                return false;
            }
        });
    });
})(jQuery);
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


//=============== its for user_save ===========
"use strict";
function forumcategory_save() {
    var productmode = $("#productmode").val();
    if (productmode == 'demo') {
        toastrWarningMsg("It is disabled for demo mode!");
        return false;
    }

    var fd = new FormData();
    var base_url = $("#base_url").val();
    var CSRF_TOKEN = $('#CSRF_TOKEN').val();
    var title = $("#title").val();
    if (title == '') {
        $("#title").focus();
        toastrErrorMsg("Title must be required");
        return false;
    }
    fd.append('title', $('#title').val());
    fd.append('csrf_test_name', (CSRF_TOKEN));

    $.ajax({
        url: base_url + enterprise_shortname +"/forum-category-save",
        type: "POST",
        data: fd,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        success: function (r) {
            if (r == 'exists') {
                toastrErrorMsg("Already exists!")
            } else if (r == 'save') {
                toastrSuccessMsg("Save successfully");
                location.reload();
            }
        }
    });
}
//============ its for forumcategory edit ============== 
"use strict";
function forumcategory_edit(id) {
    $.ajax({
        url: base_url + enterprise_shortname +"/forumcategory-edit",
        type: "POST",
        data: {'csrf_test_name': CSRF_TOKEN, id: id},
        success: function (r) {
            $("#info").html(r);
            $("#modal_info").modal('show');
        }
    });
}
//============= its for forumcategory_update =============
"use strict";
function forumcategory_update() {
    var productmode = $("#productmode").val();
    if (productmode == 'demo') {
        toastrWarningMsg("It is disabled for demo mode!");
        return false;
    }

    var fd = new FormData();
    // var base_url = $("#base_url").val();
    // var CSRF_TOKEN = $('#CSRF_TOKEN').val();
    var title = $("#etitle").val();
    var forum_category_id = $("#forum_category_id").val();
    fd.append('title', $('#etitle').val());
    fd.append('forum_category_id', $('#forum_category_id').val());
    fd.append('csrf_test_name', (CSRF_TOKEN));
    $.ajax({
        url: base_url + enterprise_shortname +"/forumcategory-update",
        type: "POST",
        data: fd,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        success: function (r) {
            toastrSuccessMsg(r);
            location.reload();
        }
    });
}
//================ its for comment inactive ============
"use strict";
function commentinactive(comment_id) {
    // var base_url = $("#base_url").val();
    // var CSRF_TOKEN = $('#CSRF_TOKEN').val();
    var confirmMsg = confirm("Are you sure");
    if (confirmMsg == true) {
        $.ajax({
            url: base_url + enterprise_shortname+"/comment-inactive",
            type: "POST",
            data: {'csrf_test_name': CSRF_TOKEN, comment_id: comment_id},
            success: function (r) {
                toastrSuccessMsg(r);
                location.reload();
            }
        });
    }
}
//================ its for comment active ============
"use strict";
function commentactive(comment_id) {
    // var base_url = $("#base_url").val();
    // var CSRF_TOKEN = $('#CSRF_TOKEN').val();
    var confirmMsg = confirm("Are you sure");
    if (confirmMsg == true) {
        $.ajax({
            url: base_url + enterprise_shortname +"/comment-active",
            type: "POST",
            data: {'csrf_test_name': CSRF_TOKEN, comment_id: comment_id},
            success: function (r) {
                toastrSuccessMsg(r);
                location.reload();
            }
        });
    }
}
//=========== its for forum_filter ============
"use strict";
function forum_filter() {
    // var base_url = $("#base_url").val();
    // var CSRF_TOKEN = $('#CSRF_TOKEN').val();
    var forum_id = $("#forum_id").val();
    var category_id = $("#category_id").val();
    if (forum_id == '' && category_id == '') {
        toastrErrorMsg("Empty field not allowed");
        return false;
    }
    $.ajax({
        url: base_url + enterprise_shortname+"/forum-filter",
        type: "post",
        data: {'csrf_test_name': CSRF_TOKEN, forum_id: forum_id, category_id: category_id},
        success: function (r) {
            $(".results").html(r);
        }
    });
}
//========== its for forumcategory_delete =============
"use strict";
function forumcategory_delete(category_id) {
    var productmode = $("#productmode").val();
    if (productmode == 'demo') {
        toastrWarningMsg("It is disabled for demo mode!");
        return false;
    }

    // var base_url = $("#base_url").val();
    // var CSRF_TOKEN = $('#CSRF_TOKEN').val();
    var r = confirm("Are you sure!");
    if (r == true) {
        $.ajax({
            url: base_url + enterprise_shortname + "/forum-category-delete",
            type: "Post",
            data: {'csrf_test_name': CSRF_TOKEN, category_id: category_id},
            success: function (r) {
                if (r == 0) {
                    toastrErrorMsg("It has some forum dependent");
                } else if (r == 1) {
                    toastrSuccessMsg("Deleted successfully");
                    location.reload();
                }
            }
        });
    }
}