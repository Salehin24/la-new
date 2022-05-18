<?php echo form_open_multipart(enterpriseinfo()->shortname.'/project-assignment-update', 'class="myform" id="myform"'); ?>
<div class="form-group row">
    <label for="title" class="col-sm-3 col-form-label">Project Title<i class="text-danger"> *</i></label>
    <div class="col-sm-7">
        <input name="title" class="form-control" type="text" placeholder="Project Title" id="title"
            value="<?php echo (!empty($get_asseignmenteditdata->title) ? $get_asseignmenteditdata->title : ''); ?>"
            required>
    </div>
</div>
<div class="form-group row">
    <label for="category" class="col-sm-3 col-form-label">Category<i class="text-danger"> * </i></label>
    <div class="col-sm-7">
        <select id="category" name="category" class="form-control" onchange="get_chapterproject(this.value)">
            <option value="">select one</option>
            <option value="1" <?php echo (($get_asseignmenteditdata->category == 1) ? 'selected' : ''); ?>>Chapter
                Project</option>
            <option value="2" <?php echo (($get_asseignmenteditdata->category == 2) ? 'selected' : ''); ?>>Final Project
            </option>
        </select>
    </div>
</div>
<div class="form-group row" id="project_chapter_list">
    <?php if($get_asseignmenteditdata->category == 1){ ?>
    <label for="chapters" class="col-sm-3 col-form-label">Select Chapter</label>
    <div class="col-7">
        <select name="project_chapter" id="project_chapter" class="form-control">
            <option value="">Select Chapter</option>
            <?php foreach($course_wise_section as $section){ ?>
            <option value="<?php echo $section->section_id; ?>"
                <?php echo (($get_asseignmenteditdata->chapter_id == $section->section_id) ? 'selected' : '');?>>
                <?php echo $section->section_name; ?>
            </option>
            <?php } ?>
        </select>
    </div>
    <?php } ?>
</div>
<div class="form-group row">
    <label for="description" class="col-sm-3 col-form-label">Description<i class="text-danger"> </i></label>
    <div class="col-sm-7">
        <textarea name="description" class="form-control" placeholder="Project Description" id="description"
            rows="5"><?php echo (!empty($get_asseignmenteditdata->description) ? $get_asseignmenteditdata->description : ''); ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="pass_score" class="col-sm-3 col-form-label">Pass Score<i class="text-danger"> *</i></label>
    <div class="col-sm-7">
        <input name="pass_score" class="form-control valid_number" type="text" placeholder="Pass Score" id="pass_score"
            value="<?php echo (!empty($get_asseignmenteditdata->pass_score) ? $get_asseignmenteditdata->pass_score : ''); ?>"
            required>
    </div>
</div>
<div class="form-group row">
    <label for="project_mark" class="col-sm-3 col-form-label">Project Marks<i class="text-danger"> * </i></label>
    <div class="col-sm-7">
        <input name="project_mark" class="form-control valid_number" type="text" placeholder="Project Mark"
            id="project_mark"
            value="<?php echo (!empty($get_asseignmenteditdata->project_mark) ? $get_asseignmenteditdata->project_mark : ''); ?>"
            required>
    </div>
</div>

<div class="form-group row">
    <table class="table table-bordered" id="project_marks_distribution_tbl">
        <thead class="bg-dark-cerulean">
            <tr>
                <th class="text-center">Marking Base</th>
                <th class="text-center">Mark Distribution</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody id="markdistribute_tbl_body">
            <?php 
            $sl=0;
            $total_marks = 0;
            // d(count($get_project_markdetails));
            foreach($get_project_markdetails as $details){
                $sl++; ?>
            <tr>
                <td><input type="text" class="form-control" id="distribute_title_<?php echo $sl; ?>"
                        name="distribute_title[]" value="<?php echo (!empty($details->markes_title) ? $details->markes_title : ''); ?>"></td>
                <td class="text-center">
                    <input type="number" class="form-control text-right distribut_number" onkeyup="marks_calculation(<?php echo $sl; ?>)"
                        onchange="marks_calculation('<?php echo $sl; ?>')" name="distribute_mark[]" value="<?php echo (!empty($details->marks) ? $details->marks : ''); ?>"
                        id="distribute_mark_<?php echo $sl; ?>" min="1">
                        <?php $total_marks += $details->marks; ?>
                </td>
                <td class="text-center">
                    <?php if($sl == 1){?>
                    <button type="button" class="btn btn-success" onclick="project_marks_fild()"><i
                            class="fas fa-plus"></i></button>
                    <?php }else{ ?>
                        <button type="button" class="btn btn-danger" onclick="removeproject_marks_fild(this,<?php echo $sl; ?>)"><i class="fas fa-minus"></i></button>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td class="text-right"><b>Total</b></td>
                <td class="text-right" id="sum_total_marks"><?php echo $total_marks; ?></td>
            </tr>
        </tfoot>
    </table>
</div>
<div class="form-group row">
    <label for="tips" class="col-sm-3 col-form-label">Tips<i class="text-danger"> </i></label>
    <div class="col-sm-7">
        <textarea name="tips" class="form-control" placeholder="Project tips" id="tips" rows="5"><?php echo (!empty($get_asseignmenteditdata->tips) ? $get_asseignmenteditdata->tips : ''); ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="reference" class="col-sm-3 col-form-label">Reference<i class="text-danger"> </i></label>
    <div class="col-sm-7">
        <textarea name="reference" class="form-control" placeholder="Project reference" id="reference"
            rows="5"><?php echo (!empty($get_asseignmenteditdata->project_reference) ? $get_asseignmenteditdata->project_reference : ''); ?></textarea>
    </div>
</div>

<div class="form-group row ">
    <div class="offset-3 col-md-2">
        <input type="hidden" name="course_id" id="course_id"
            value="<?php echo html_escape($get_asseignmenteditdata->course_id); ?>">
            <input type="hidden" name="assignment_id" id="assignment_id" value="<?php echo $get_asseignmenteditdata->assignment_id; ?>">
        <button type="submit" class="btn btn-success w-md m-b-5" onclick=""><?php echo display('update'); ?></button>
    </div>
</div>
<?php echo form_close(); ?>

<script>
$(document).ready(function() {

    $('body').on('keypress', '.valid_number', function(event) {
        var charCode = (event.which) ? event.which : event.keyCode;
        if (charCode != 46 && charCode != 45 && charCode > 31 &&
            (charCode < 48 || charCode > 57)) {
            toastr["error"]('Please Input Valid Number');
            return false;
        }
        return true;
    });
});


"use strict";

function get_chapterproject(category) {
    var base_url = $("#base_url").val();
    var CSRF_TOKEN = $("#CSRF_TOKEN").val();
    var course_id = $("#course_id").val();
    var enterprise_shortname = $("#enterprise_shortname").val();

    // var base_url = "<?php //echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
    // var csrf_test_name = $('[name="csrf_test_name"]').val();
    if (category == 1) {
        $.ajax({
            url: base_url + enterprise_shortname + "/get-chapterbycourse",
            type: "POST",
            data: {
                csrf_test_name: CSRF_TOKEN,
                course_id: course_id,
                // serial: sl,
                // project_no: pro_no
            },
            success: function(r) {
                console.log(r);
                $("#project_chapter_list").html(r);
            },
        });
    } else {
        $("#project_chapter_list").html('');
    }
}


var mcount = <?php echo count($get_project_markdetails)+1; ?>;

function project_marks_fild() {
    var trcount = $("#project_marks_distribution_tbl > tbody > tr").length + 1;
    if (trcount >= 5) {
    toastrWarningMsg("You can not add more than four");
    return false;
  } else {
    var a = "distribute_title_" + mcount;
    var e = document.createElement("tr");
    e.innerHTML = '<td><input type="text" class="form-control" id="distribute_title_' + mcount +
        '" name="distribute_title[]"></td><td class="text-center"><input type="number" class="form-control text-right distribut_number" name="distribute_mark[]" onkeyup="marks_calculation(' +
        mcount + ')" onchange="marks_calculation(' + mcount + ')"  min="1" id="distribute_mark_' + mcount +
        '"></td><td class="text-center"><button type="button" class="btn btn-danger" onclick="removeproject_marks_fild(this,1)"><i class="fas fa-minus"></i></button></td>';
    document.getElementById('markdistribute_tbl_body').appendChild(e);
    document.getElementById(a).focus();
    mcount++;
  }
}

function removeproject_marks_fild(t, sl) {
    var e = t.parentNode.parentNode;
    e.parentNode.removeChild(e);
    var gr_tot = 0;
    $(".distribut_number").each(function() {
        isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
    });
    $("#sum_total_marks").text(gr_tot.toFixed(2, 2));
}

function marks_calculation(content) {
    // var id = $(this).attr('id');
    var project_marks = $("#project_mark").val();
    if (project_marks == '') {
        toastr["error"]('Please Add Project Marks First');
        $("#distribute_mark_" + content).val(0);
        return false;
    }
    var gr_tot = 0;
    $(".distribut_number").each(function() {
        isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
    });
    if (parseFloat(project_marks) < parseFloat(gr_tot)) {
        toastr["error"]('Distribution Marks Can not More than Project Marks');
        $("#distribute_mark_" + content).val(0);
        //return false;
    }

    var gr_tot = 0;
    $(".distribut_number").each(function() {
        isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
    });
    $("#sum_total_marks").text(gr_tot.toFixed(2, 2));
}
</script>