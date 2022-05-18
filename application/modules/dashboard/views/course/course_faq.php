<div class="row">
    <!-- Form controls -->
    <div class="col-sm-12">
        <div class="col-sm-12">
            <?php
            $error = $this->session->flashdata('error');
            $success = $this->session->flashdata('success');
            $file_uploaderror = $this->session->flashdata('file_uploaderror');
            if ($error != '') {
                echo $error;
                unset($_SESSION['error']);
            }
            if ($success != '') {
                echo $success;
                unset($_SESSION['success']);
            }
            ?>
        </div>
        <div class="modal" id="myModal">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo display('add_faq'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
                        <div class="form-group row">
                            <label for="course_id" class="col-sm-2 col-form-label"><?php echo display('course') ?> <i
                                    class="text-danger"> *</i></label>
                            <div class="col-sm-9">
                                <select class="form-control placeholder-single" id="course_id" name="course_id"
                                    required>
                                    <option value="">-- select one --</option>
                                    <?php if($get_course){
                                              foreach( $get_course as $course_list){    
                                        ?>
                                    <option value="<?php echo $course_list->course_id; ?>">
                                        <?php echo $course_list->name; ?></option>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="form-group row"> -->
                        <!-- <label for="question" class="col-sm-3 col-form-label"><?php echo display('question') ?> <i
                                    class="text-danger"> *</i></label> -->
                        <!-- <div class="col-sm-4">
                                <input name="question" class="form-control" type="text"
                                    placeholder="<?php echo display('question') ?>" id="question" required>
                            </div> -->
                        <!-- <label for="answer" class="col-sm-3 col-form-label"><?php echo display('answer') ?> <i
                                    class="text-danger"> *</i></label> -->
                        <!-- <div class="col-sm-4">
                                <textarea name="answer" id="answer" class="form-control" cols="5" rows="2"
                                    placeholder="<?php echo display('answer') ?>"></textarea>
                            </div> -->
                        <!-- </div> -->
                        <div class="row">
                            <div class="loaddata_1 col-md-12 w-100p">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="faqTable">
                                        <thead>
                                            <tr>
                                                <th width="45%" class="text-center"><?php echo display('question') ?>
                                                </th>
                                                <th width="45%" class="text-center"><?php echo display('answer') ?></th>
                                                <th width="10%" class="text-center">Action </th>
                                            </tr>
                                        </thead>
                                        <tbody id="addrowItem_1">
                                            <tr>
                                                <td class="text-right">
                                                    <div class="">
                                                        <textarea name="question[]" class="form-control"
                                                            id="question_1"></textarea>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="">
                                                        <textarea name="answer[]" class="form-control"
                                                            id="answer_1"></textarea>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <button id="add-invoice-item" class="btn btn-info btn-sm"
                                                        name="add-new-item"
                                                        onclick="addInputFieldRow('addrowItem_1', 1)" type="button"
                                                        style="margin: 0px 15px 15px;"><i class="fa fa-plus">
                                                        </i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <button type="button" onclick="course_faq_save()"
                                class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>


                </div>
            </div>
        </div>

    </div>
    <!-- Inline form -->
</div>
<br>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?>
                    <small class="float-right">
                        <!-- Button to Open the Modal -->
                        <?php // if ($this->permission->check_label('category')->create()->access()) { ?>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                            <?php echo display('add_faq'); ?>
                        </button>
                        <?php // } ?>
                        <!-- The Modal -->
                    </small>
                </h4>

            </div>
            <div class="card-body">

                <div class="result_load">
                    <table class="table display table-bordered table-striped table-hover bg-white m-0" id="faqlists">
                        <thead>
                            <tr>
                                <th width="5%"><?php echo display('sl') ?></th>
                                <th width="35%"><?php echo display('name') ?></th>
                                <!-- <th width="45%"><?php echo display('answer') ?></th> -->
                                <th width="15%" class="text-center"><?php echo display('action') ?></th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="modal_info" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal_ttl"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="info">

            </div>
        </div>
    </div>
</div>
<input type='hidden' id='total_faqs' value='<?php echo $total_faqs; ?>'>
<script src="<?php //echo base_url('application/modules/dashboard/assets/js/course.js') ?>"></script>


<script>
var count = 2;
var cnt = 1;
limits = 500;
// ========== its for row add dynamically =============
("use strict");

function addInputFieldRow(t, sl) {
    // alert(sl);
    if (count == limits) {
        alert("You have reached the limit of adding" + count + "inputs");
    } else {

        // var trcount = $("#faqTable_1" + sl + " > tbody > tr").length + 1;
        var qst_count = $("#qst_count_" + sl).val();

        var a = "question_" + count,
            e = document.createElement("tr");
        (e.innerHTML =
            "<tr>\n\
                <td class='text-right'>\n\
                    <div class=''>\n\
                        <textarea name='question[]' class='form-control' id='question_" + count + "'></textarea>\n\
                    </div>\n\
                </td>\n\
                <td class='text-center'>\n\
                    <div class=''>\n\
                        <textarea name='answer[]' class='form-control' id='answer_" + count + "'></textarea>\n\
                    </div>\n\
                </td>\n\
                <td class='text-center'>\n\
                    <button id='add-invoice-item' class='btn btn-sm btn-danger' name='add-new-item' onclick='deleteRow(this)' type='button' style='margin: 0px 15px 15px;'><i class='fa fa-minus'> </i></button>\n\
                </td>\n\
            </tr>\n\
            "),
        document.getElementById(t).appendChild(e),
            document.getElementById(a).focus();

        count++, cnt++;
    }
}

// ============= its for row delete dynamically =========
("use strict");
d = 1;

function deleteRow(t) {
    d++;
    var a = $("#faqTable > tbody > tr").length;
    if (1 == a) {
        alert("There only one row you can't delete it.");
    } else {
        var e = t.parentNode.parentNode;
        e.parentNode.removeChild(e);
    }
}






//============= its for faqsave =============
("use strict");
function course_faq_save() {
    var fd = new FormData();


    var course_id = $("#course_id").val();
    var trcount = $("#faqTable> tbody > tr").length;
    if (course_id == '') {
        toastrErrorMsg("Course must be required");
        return false;
    }
    var contents_qst = [];
    var contents_ans = [];
    var answers = [];
    var questions = [];
    
    var question = $("[name='question[]']");
    var answer = $("[name='answer[]']");
    
    for (var i = 0; i < question.length; i++) {
        var questions = question[i];
        var q_test = questions.value;
        if (q_test == '') {
            toastrErrorMsg("Question must be required");
            return false;
        }
        contents_qst.push(q_test);
    }
    for (var j = 0; j < answer.length; j++) {
        var answers = answer[j];
        var ans_test = answers.value;
        if (ans_test == '') {
            toastrErrorMsg("Answer must be required");
            return false;
        }
        contents_ans.push(ans_test);
    }
    
    var all_question = JSON.stringify(contents_qst);
    var all_answer = JSON.stringify(contents_ans);

    $.ajax({
        url: base_url + enterprise_shortname + "/course-faq-save",
        type: "POST",
        data: {
            csrf_test_name: CSRF_TOKEN,
            question: all_question,
            answers: all_answer,
            course_id: course_id
        },
        success: function(r) {
            if (r == 2) {
                toastrErrorMsg("Already exists");
            } else {

                toastrSuccessMsg(r);
            }
            $("#mode").val("");
            $("#question").val("");
            $("#answer").val("");
            $("#edit_question").val("");
            $("#edit_answer").val("");
            $("#myModal").modal("hide");
            $("#modal_info").modal("hide");
            $("#info").modal("hide");
            $("#faqlists").DataTable().ajax.reload();
            setTimeout(function() {}, 1000);

        },
        //                    $("#enterpriselist").DataTable().ajax.reload();
    });
}


(function($) {
    "use strict";
    $(document).ready(function() {
        var usertype = $("#usertype").val();
        var CSRF_TOKEN = $("#CSRF_TOKEN").val();
        var base_url = $("#base_url").val();
        var enterprise_shortname = $("#enterprise_shortname").val();
        var enterprise_id = $("#enterprise_id").val();

        var total_faq = $("#total_faqs").val();
        var faqlist = $("#faqlists").DataTable({
            responsive: true,
            dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>tp",
            aaSorting: [
                [0, "desc"]
            ],
            columnDefs: [{
                    bSortable: true,
                    aTargets: [0],
                },
                {   
                    bSortable: false,
                    targets: 2,
                    className: "text-center",
                },
            ],
            buttons: [{
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
                [20, 50, 100, 150, 200, +total_faq],
                [20, 50, 100, 150, 200, "All"],
            ],
            processing: true,
            sProcessing: "<span class='fas fa-sync-alt'></span>",
            serverSide: true,
            serverMethod: "post",

            ajax: {
                url: base_url + enterprise_shortname + "/course-get-faqlist",
                data: function(data) {
                    data.csrf_test_name = CSRF_TOKEN;
                },
            },

            columns: [{
                    data: "sl"
                },
                {
                    data: "name"
                },
                // {data: "answer"},
                {
                    data: "action"
                },
            ],
        });


    });
})(jQuery);

function faqedits(id) {
    $.ajax({
        url: base_url + enterprise_shortname + "/course-faqedit-form",
        type: "POST",
        data: {
            csrf_test_name: CSRF_TOKEN,
            id: id
        },
        success: function(r) {
            $(".modal_ttl").html("FAQ Information");
            $("#info").html(r);
            $("#modal_info").modal("show");
        },
    });
}


("use strict");

function faq_delete(id) {
    var productmode = $("#productmode").val();
    if (productmode == "demo") {
        toastrWarningMsg("It is disabled for demo mode!");
        return false;
    }

    var r = confirm("Are you sure?");
    if (r == true) {
        $.ajax({
            url: base_url + enterprise_shortname + "/course-faq-delete",
            type: "POST",
            data: {
                csrf_test_name: CSRF_TOKEN,
                id: id
            },
            success: function(r) {
                toastrSuccessMsg(r);
                $("#faqlists").DataTable().ajax.reload();
            },
        });
    }
}
</script>