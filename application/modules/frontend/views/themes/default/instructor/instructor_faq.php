<div class="pt-4 bg-alice-blue">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between">



                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <?php echo display('add_faq'); ?>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"> <?php echo display('add_faq'); ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
                                    <div class="form-group row">
                                        <label for="course_id"
                                            class="col-sm-2 col-form-label"><?php echo display('course') ?> <i
                                                class="text-danger"> *</i></label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="course_id" name="course_id" required>
                                                <option value="">-- select one --</option>
                                            <?php if($get_courselist){
                                              foreach($get_courselist as $course){    
                                                ?>
                                                <option value="<?php echo $course->course_id; ?>">
                                                    <?php echo $course->name; ?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="loaddata_1 col-md-12 w-100p">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="faqTable">
                                                    <thead>
                                                        <tr>
                                                            <th width="45%" class="text-center">
                                                                <?php echo display('question') ?></th>
                                                            <th width="45%" class="text-center">
                                                                <?php echo display('answer') ?></th>
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
                                                                <button id="add-invoice-item"
                                                                    class="btn btn-info btn-sm" name="add-new-item"
                                                                    onclick="addInputFieldRow('addrowItem_1', 1)"
                                                                    type="button" style="margin: 0px 15px 15px;"><i
                                                                        class="fa fa-plus"> </i></button>
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
                                <!-- <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--End Counter-->

<div class="py-4 bg-alice-blue">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 rounded-0 shadow-sm flex-fill w-100">
                    <div class="card-body p-4 mb-3 mb-xl-0 table-responsive">
                        <div class="mb-3">
                            <h4 class="mb-3">FAQ List</h4>
                        </div>
                        <table class="table align-middle datatablenn table-bordered">
                            <thead class="">
                                <tr class="">
                                    <th scope="col">Sl No</th>
                                    <th scope="col">Courses</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
									if($get_faqlist){
                                        $sl=0;
										foreach($get_faqlist as $faq){
                                            $sl++;
										?>
                                <tr>
                                    <td><?php echo $sl; ?></td>
                                    <td>
                                        <?php echo $faq->name?>
                                    </td>
                                    <td class="text-center">
                                    <a href="javascript:void(0)" onclick="faqedits('<?php echo $faq->id; ?>')" data-toggle="tooltip" title="Edit" ><i class="fa fa-edit btn btn-sm btn-success text-white"></i> </a> 
                                    <a href="javascript:void(0)" onclick="faq_delete('<?php echo $faq->id; ?>')" data-toggle="tooltip" title="Delete" ><i class="far fa-trash-alt btn-danger  btn btn-sm"></i></a>
                                    </td>
                                </tr>
                                <?php 
                                }
                            }
                            ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal fade" id="faqmodalinfo" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal_ttl"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="faqinfo">

            </div>
        </div>
    </div>
</div>
<script>
var base_url = $("#base_url").val();
var enterprise_shortname = $("#enterprise_shortname").val();
var CSRF_TOKEN = $('#CSRF_TOKEN').val();
var enterprise_id = $("#enterprise_id").val();


var count = 2;
var cnt = 1;
limits = 500;
// ========== its for row add dynamically =============
("use strict");
function addInputFieldRow(t, sl) {

    if (count == limits) {
        alert("You have reached the limit of adding" + count + "inputs");
    } else {

        // var trcount = $("#faqTable" + sl + " > tbody > tr").length + 1;
        var qst_count = $("#qst_count_" + sl).val();

        var a = "question_" + count,
                e = document.createElement("tr");
        (e.innerHTML =
                "<tr>\n\
                <td class='text-right'>\n\
                    <div class=''>\n\
                        <textarea name='question[]' class='form-control' id='question_"+count+"'></textarea>\n\
                    </div>\n\
                </td>\n\
                <td class='text-center'>\n\
                    <div class=''>\n\
                        <textarea name='answer[]' class='form-control' id='answer_"+count+"'></textarea>\n\
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

function faqedits(id) {
    $.ajax({
        url: base_url + enterprise_shortname + "/instructor-faqeditform",
        type: "POST",
        data: {csrf_test_name: CSRF_TOKEN, id: id},
        success: function (r) {
            $(".modal_ttl").html("FAQ Information");
            $("#faqinfo").html(r);
            $("#faqmodalinfo").modal("show");
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

  var r = confirm("Do you want to delete?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/course-faq-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, id: id },
      success: function (r) {
        toastrSuccessMsg(r);
            $("#faqlists").DataTable().ajax.reload();
      },
    });
  }
}
</script>