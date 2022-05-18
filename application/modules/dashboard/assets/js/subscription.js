// subscription save data
"use strict";
function subscription_save() {
    var title = $("#title").val();
    var start_date = $("#start_datas").val();
    var end_date = $("#end_dates").val();
    var duration = $("#duration").val();
    var description = $("#description").val();
    var course_id = $("#course_id").val();
    var price = $("#price").val();
    var is_free = $("#is_free").val();
    var course_sub_content = $("#course_sub_content").val();
    if (title == "") {
        $("#title").focus();
        toastrErrorMsg("Title must field be required");
        return false;
    }
    // if (start_date == "") {
    //     $("#start_datas").focus();
    //     toastrErrorMsg("Start Date field must be required");
    //     return false;
    // }
    // if (end_date == "") {
    //     $("#end_dates").focus();
    //     toastrErrorMsg("End Date field must be required");
    //     return false;
    // }
    if (duration == "") {
        $("#duration").focus();
        toastrErrorMsg("Duration field must be required");
        return false;
    }
    // if (course_id == "") {
    //     $("#course_id").focus();
    //     toastrErrorMsg("Course field must be required");
    //     return false;
    // }
    // if(is_free=='0'){
    // if (price == "") {
    //     $("#price").focus();
    //     toastrErrorMsg("Price must be required");
    //     return false;
    // }
    // }
//    var course_sub_content_0 =$("#course_sub_content_0").val();
    // if (course_sub_content_0 == "") {
    //     $("#course_sub_content_0").focus();
    //     toastrErrorMsg("Content must be required");
    //     return false;
    // }
    

    var sublen= $('#subscription_content .d-flex').length;
    var content=[];
     for(var i=0; i<sublen;i++){
         content.push($("#course_sub_content_"+i+"").val());
       }
    var subscription_content = JSON.stringify(content);
    
    for(var i=0; i<sublen;i++){
        var course_sub_content=$("#course_sub_content_"+i).val();
         if(course_sub_content==''){
            toastrErrorMsg("Content must be required");
            return false;
         }
      }

    $.ajax({
        url: base_url + enterprise_shortname + "/subcription-save",
        type: "POST",
        data: {
            csrf_test_name: CSRF_TOKEN,
            title: title,
            // start_date: start_date,
            // end_date: end_date,
            duration: duration,
            description: description,
            price: price,
            // course_id: course_id,
            course_sub_content:subscription_content,
            // is_free:is_free
        },
        success: function (r) {
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


// edit subscription 
"use strict";
function edit_subscription(subscription_id) {
    $.ajax({
        type: "POST",
        url: base_url + enterprise_shortname + "/subscription-edit",
        data: {
            csrf_test_name: CSRF_TOKEN,
            subscription_id: subscription_id
        },
        success: function (data) {
            $('#edit').modal('show');
            $('.editinfos').html(data);
            
            $(".placeholder-single").select2();
            
            $('.start_datas').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
                locale: {
                    format: 'YYYY-MM-DD hh:mm'
                }
            });
            $('.end_dates').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
                locale: {
                    format: 'YYYY-MM-DD hh:mm'
                }
            });
        }
    });
}

"use strict";
function subscription_update() {
    var title = $("#edittitle").val();
    var subscription_id = $("#subscription_id").val();
    var start_date = $("#editstart_datas").val();
    var end_date = $("#editend_dates").val();
    var duration = $("#editduration").val();
    var description = $("#editdescription").val();
    var course_id = $("#edit_course_id").val();
    var price = $("#prices").val();
    var oldprice = $("#oldprices").val();
    var is_free = $("#is_frees").val();

    var count= $('#subscription_contents .d-flex').length;
  
    if (title == "") {
        $("#edittitle").focus();
        toastrErrorMsg("Title must be required");
        return false;
    }

    // if (start_date == "") {
    //     $("#editstart_datas").focus();
    //     toastrErrorMsg("Start Date must be required");
    //     return false;
    // }
    // if (end_date == "") {
    //     $("#editend_dates").focus();
    //     toastrErrorMsg("End Date must be required");
    //     return false;
    // }
    if (duration == "") {
        $("#editduration").focus();
        toastrErrorMsg("Duration must be required");
        return false;
    }
    // if (course_id == "") {
    //     $("#edit_course_id").focus();
    //     toastrErrorMsg("Course filed must be required");
    //     return false;
    // }
    // if(is_free=='0'){
    //     if (price == "") {
    //         $("#prices").focus();
    //         toastrErrorMsg("Price must be required");
    //         return false;
    //     }
    // }
    var contents=[];
    for(var i=0; i<count;i++){
        contents.push($("#course_sub_contents_"+i+"").val());
     }
    var subscription_content = JSON.stringify(contents);


    for(var i=0; i<count;i++){
        var course_sub_content=$("#course_sub_contents_"+i).val();
         if(course_sub_content==''){
            toastrErrorMsg("Content must be required");
            return false;
         }
      }
   
    $.ajax({
        url: base_url + enterprise_shortname + "/subcription-update",
        type: "POST",
        data: {
            csrf_test_name: CSRF_TOKEN,
            subscription_id: subscription_id,
            title: title,
            // start_date: start_date,
            // end_date: end_date,
            duration: duration,
            // course_id: course_id,
            price: price,
            description: description,
            course_sub_content: subscription_content,
            oldprice: oldprice,
            // is_free: is_free,
        },
        success: function (r) {
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

// delete subscription 
"use strict";
function subscription_delete(subscription_id) {
    var productmode = $("#productmode").val();
    if (productmode == "demo") {
        toastrWarningMsg("It is disabled for demo mode!");
        return false;
    }
    // alert(subscription_id);
    // return false;
    var base_url = $("#base_url").val();
    var CSRF_TOKEN = $("#CSRF_TOKEN").val();
    var r = confirm("Are you sure");
    if (r == true) {
        $.ajax({
            url: base_url + enterprise_shortname + "/subscription-delete",
            type: "POST",
            data: {
                csrf_test_name: CSRF_TOKEN,
                subscription_id: subscription_id
            },
            success: function (r) {

                if (r == 0) {
                    toastrErrorMsg("This Id  is missing on the Subscription Table");
                } else {
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
                        toastr.success("Subscription deleted successfully!");
                    }, 1000);
                }
            },
        });
    }
}



// datatable 
(function ($) {
    "use strict";
    $(document).ready(function () {
        var CSRF_TOKEN = $("#CSRF_TOKEN").val();
        var enterprise_shortname = $("#enterprise_shortname").val();
        var enterprise_id = $("#enterprise_id").val();
        var base_url = $("#base_url").val();

        var total_subscription = $("#total_subscription").val();
        $("#subscriptionlist").DataTable({
            responsive: true,
            "dom": "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>tp",
            aaSorting: [
                [0, "desc"]
            ],
            columnDefs: [{
                bSortable: true,
                aTargets: [0],
            },
            {   
                bSortable: false,
                targets: 4,
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
                [20, 50, 100, 150, 200, +total_subscription],
                [20, 50, 100, 150, 200, "All"],
            ],
            processing: true,
            sProcessing: "<span class='fas fa-sync-alt'></span>",
            serverSide: true,
            serverMethod: "post",

            ajax: {
                url: base_url + enterprise_shortname + "/get-subscriptionlist",
                data: function (data) {
                    data.csrf_test_name = CSRF_TOKEN;
                },
            },

            columns: [{
                data: "sl"
            },
            {
                data: "title",
            },
            {
                data: "duration",
            },
            {
                data: "price",
            },
            {
                data: "action"
            },
            ],
        });



    });
})(jQuery);


// add content 

("use strict");
var i= 1;
function appendContent() {
$("#subscription_content").append(
    "<div class='d-flex'>\n\
    <div class='flex-grow-1'>\n\
    <div class='form-group'>\n\
    <input type='text' class='form-control' name='course_sub_content[]' id='course_sub_content_"+i+"' placeholder='Course Content'>\n\
    </div>\n\
    </div>\n\
    <div class='col-sm-1'>\n\
    <button type='button' class='btn btn-danger btn-sm custom_btn m-t-0' name='button' onclick='removeContent(this)'> <i class='fa fa-minus'></i> </button>\n\
    </div>\n\
    </div>"
    );
    i++;  
}

// edit content 
("use strict");
function appendContentedit() {
var count= $('#subscription_contents .d-flex').length;
$("#subscription_contents").append(
    "<div class='d-flex'>\n\
    <div class='flex-grow-1'>\n\
    <div class='form-group'>\n\
    <input type='text' class='form-control' name='course_sub_content[]' id='course_sub_contents_"+count+"' placeholder='Course Content'>\n\
    </div>\n\
    </div>\n\
    <div class='col-sm-1'>\n\
    <button type='button' class='btn btn-danger btn-sm custom_btn m-t-0' name='button' onclick='removeContent(this)'> <i class='fa fa-minus'></i> </button>\n\
    </div>\n\
    </div>"
    );
    count++;  
}

("use strict");
function removeContent(requirementElem) {
$(requirementElem).parent().parent().remove();
}
