<?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
<!-- <div class="form-group row">
    <label for="question" class="col-sm-3 col-form-label"><?php echo display('question') ?> <i
            class="text-danger"> *</i></label>
    <div class="col-sm-9">
        <input name="question" class="form-control" type="text"
               placeholder="<?php echo display('question') ?>" id="edit_question" value="<?php echo (!empty($faqeditdata->question) ? $faqeditdata->question : ''); ?>" required>
    </div>
</div> -->
<!-- <div class="form-group row">
    <label for="answer" class="col-sm-3 col-form-label"><?php echo display('answer') ?> <i
            class="text-danger"> *</i></label>
    <div class="col-sm-9">
        <textarea name="answer" id="edit_answer" class="form-control" cols="40" rows="10"  placeholder="<?php echo display('answer') ?>"><?php echo (!empty($faqeditdata->answer) ? $faqeditdata->answer : ''); ?></textarea>
    </div>
</div> -->
<div class="form-group row">
    <label for="course_id" class="col-sm-2 col-form-label"><?php echo display('course') ?> <i class="text-danger">
            *</i></label>
    <div class="col-sm-9">
        <select class="form-control placeholder-single" id="course_ids" name="course_id" required>
            <option value="">-- select one --</option>
            <?php if($get_course){
                        foreach( $get_course as $course_list){    
                ?>
            <option value="<?php echo $course_list->course_id; ?>"
            <?php echo (($course_list->course_id == $faqeditdata->course_id) ? 'selected' : ''); ?>>
                <?php echo $course_list->name; ?></option>
            <?php }}?>
            <input type="hidden" id="old_id" value="<?php echo $faqeditdata->course_id;?>">
        </select>
    </div>
</div>

<div class="row">
    <div class="loaddata_1 col-md-12 w-100p">
        <div class="table-responsive">
            <table class="table table-bordered" id="faqTables">
                <thead>
                    <tr>
                        <th width="45%" class="text-center"><?php echo display('question') ?></th>
                        <th width="45%" class="text-center"><?php echo display('answer') ?></th>
                        <th width="10%" class="text-center">Action </th>
                    </tr>
                </thead>
                <tbody id="addrowItems_1">

                    <?php 
                   if($faqeditdata){
                  $question=json_decode($faqeditdata->question);
                  $answer=json_decode($faqeditdata->answer);
                  $sl=0;
                  $count=1;
                   foreach($question as $questionlist){?>
                    <tr>
                        <td class="text-right">
                            <div class="">
                                <textarea name="question_edit[]" class="form-control"
                                    id="questions_<?php echo $count;?>"><?php echo $questionlist;?></textarea>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="">
                                <textarea name="answer_edit[]" class="form-control"
                                    id="answers_<?php echo $count;?>"><?php echo $answer[$sl];?></textarea>
                            </div>
                        </td>
                        <td class="text-center">
                            <?php if($count==1){?>

                            <button id="add-invoice-item" class="btn btn-info btn-sm" name="add-new-item"
                                onclick='addInputFieldRow("addrowItems_<?php echo $count;?>", <?php echo $count;?>)'
                                type="button" style="margin: 0px 15px 15px;"><i class="fa fa-plus"> </i></button>
                            <?php }else{ ?>
                            <button id='add-invoice-item' class='btn btn-sm btn-danger' name='add-new-item'
                                onclick='deleteRow(this)' type='button' style='margin: 0px 15px 15px;'><i
                                    class='fa fa-minus'> </i></button>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php $count++;$sl++;}}?>


                </tbody>
            </table>
        </div>
    </div>
</div>
<input type="hidden" name="id" id="id" value="<?php echo $faqeditdata->id; ?>">
<div class="form-group text-right">
    <button type="button" onclick="course_faq_save()"
        class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
</div>
<?php echo form_close(); ?>

<script>
$(".placeholder-single").select2();
var count = $("#faqTables > tbody > tr").length + 1;

var cnt = 1;
limits = 500;
// ========== its for row add dynamically =============
("use strict");

function addInputFieldRow(t, sl) {

    if (count == limits) {
        alert("You have reached the limit of adding" + count + "inputs");
    } else {
        // var trcount = $("#faqTables_1" + sl + " > tbody > tr").length + 1;
        var qst_count = $("#qst_count_" + sl).val();

        var a = "question_" + count,
            e = document.createElement("tr");
        (e.innerHTML =
            "<tr>\n\
                <td class='text-right'>\n\
                    <div class=''>\n\
                        <textarea name='question_edit[]' class='form-control' id='questions_" + count + "'></textarea>\n\
                    </div>\n\
                </td>\n\
                <td class='text-center'>\n\
                    <div class=''>\n\
                        <textarea name='answer_edit[]' class='form-control' id='answers_" + count + "'></textarea>\n\
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
    var a = $("#faqTables > tbody > tr").length;
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
    var course_id = $("#course_ids").val();
    var old_id = $("#old_id").val();
    var id = $("#id").val();
    // alert(course_id+'  '+old_id);
    var trcount = $("#faqTables > tbody > tr").length;
    if (course_id == '') {
        toastrErrorMsg("Course must be required");
        return false;
    }

    var contents_qst = [];
    var contents_ans = [];
    var answers = [];
    var questions = [];

    var question = $("[name='question_edit[]']");
    var answer = $("[name='answer_edit[]']");

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
            course_id: course_id,
            id: id,
            old_id: old_id
        },
        success: function(r) {
            if (r == 2) {
                toastrErrorMsg("Already exists");
            } else {

                toastrSuccessMsg(r);
            }
            setTimeout(function() {}, 1000);
            $("#faqlists").DataTable().ajax.reload();
            $("#question").val("");
            $("#answer").val("");
            $("#edit_question").val("");
            $("#edit_answer").val("");
            $("#myModal").modal("hide");
            $("#modal_info").modal("hide");
            $("#info").modal("hide");
        },
    });
}
</script>