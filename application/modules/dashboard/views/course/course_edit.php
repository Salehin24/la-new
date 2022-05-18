<link rel="stylesheet" href="<?php echo base_url('application/modules/dashboard/assets/css/common.css'); ?>">
<?php
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
?>
<div class="row">
    <!-- Form controls -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <?php echo html_escape((!empty($title) ? $title : null)) ?>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="nav flex-column nav-pills custom_tablist">
                        <ul class="nav nav-pills d-inlineblock" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="v-pills-curriculum-tab" data-toggle="pill"
                                    href="#v-pills-curriculum" role="tab" aria-controls="v-pills-curriculum"
                                    aria-selected="true"><?php echo display('curriculum'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="v-pills-basic-tab" data-toggle="pill" href="#v-pills-basic"
                                    role="tab" aria-controls="v-pills-basic"
                                    aria-selected="true"><?php echo display('course_info'); ?></a>
                            </li>
                            <?php
                            $course_types = [];
                            if($edit_data->course_type){
                                $course_types = json_decode($edit_data->course_type);
                            }
                            if(in_array(1, $course_types)){
                            // if($edit_data->course_type==1){ 
                                ?>
                            <li class="nav-item">
                                <a class="nav-link course_type_enable" id="v-pills-pricing-tab" data-toggle="pill"
                                    href="#v-pills-pricing" role="tab" aria-controls="v-pills-pricing"
                                    aria-selected="false"><?php echo display('course_pricing'); ?></a>
                            </li>
                            <?php }else{?>
                            <li class="nav-item">
                                <a class="nav-link one_hide" id="v-pills-pricing-tab" data-toggle="pill"
                                    href="#v-pills-pricing" role="tab" aria-controls="v-pills-pricing"
                                    aria-selected="false"><?php echo display('course_pricing'); ?></a>
                            </li>
                            <?php }?>

                            <!-- <li class="nav-item">
                                <a class="nav-link" id="v-pills-assignexam-tab" data-toggle="pill"
                                    href="#v-pills-assignexam" role="tab" aria-controls="v-pills-assignexam"
                                    aria-selected="false"><?php echo display('assign_exam'); ?></a>
                            </li> -->
                        </ul>
                    </div>
                </div>
                <div class="col-sm-9 p-15">
                    <?php echo form_open_multipart(enterpriseinfo()->shortname .'/course-update', 'class="myform" id="myform"'); ?>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-curriculum" role="tabpanel"
                            aria-labelledby="v-pills-curriculum-tab">
                            <div class="form-group row">
                                <button type="button" class="btn btn-outline-success btn-sm col-sm-2 m-l-10"
                                    onclick="addsection_form('<?php echo html_escape($edit_data->course_id); ?>', '2')"><?php echo display('add_section'); ?></button>
                                <button type="button" class="btn btn-outline-info col-sm-2 m-l-10"
                                    onclick="addlesson_form('<?php echo html_escape($edit_data->course_id); ?>')"><?php echo display('add_lesson'); ?></button>
                                <!-- <button type="button" class="btn btn-outline-primary col-sm-2 m-l-10"
                                    onclick="assignExamForm('<?php echo html_escape($edit_data->course_id); ?>')"><?php echo display('assign_exam'); ?></button> -->
                                <button type="button" class="btn btn-outline-success col-sm-2 m-l-10"
                                    onclick="projectassignmentForm('<?php echo html_escape($edit_data->course_id); ?>')">Project/Assignment</button>
                                <a href="<?php echo base_url(enterpriseinfo()->shortname.'/add-exam/'.$edit_data->course_id); ?>"
                                    class="btn btn-outline-info col-sm-2 m-l-10">Add Exam</a>
                            </div>

                            <div class="col-sm-12">
                                <?php
                                    $error = $this->session->flashdata('error');
                                    $success = $this->session->flashdata('success');
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

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <table class="table table-hover bg-margin-10-20">
                                        <?php
                                        $sl = 0;
                                        foreach ($course_wise_section as $sinlge_section) {
                                            $course_section_wise_lesson = $this->Course_model->course_section_wise_lesson($edit_data->course_id, $sinlge_section->section_id, get_enterpriseid());
                                            $sl++;
                                            ?>
                                        <thead>
                                            <tr>
                                                <th><?php echo 'Chapter'; // . " " . $sl; ?> :
                                                    <?php echo html_escape($sinlge_section->section_name); ?></th>
                                                <th width='' class="text-right">
                                                    <a href="javascript:void(0)"
                                                        onclick="section_edit('<?php echo html_escape($sinlge_section->section_id); ?>')"
                                                        class="" data-toggle="tooltip" data-placement="top"
                                                        title="Section Edit">
                                                        <i class="btn-info btn-sm fa fa-edit"> </i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                        onclick="section_delete('<?php echo html_escape($sinlge_section->section_id); ?>')"
                                                        class="" data-toggle="tooltip" data-placement="top"
                                                        title="Section Delete">
                                                        <i class="btn-danger btn-sm fa fa-trash"> </i>
                                                    </a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $l=0;
                                            foreach ($course_section_wise_lesson as $lesson) {
                                                $l++;
                                                ?>
                                            <tr>
                                                <td class="pl-40">
                                                    <?php echo $l.' '. html_escape($lesson->lesson_name); ?></td>
                                                <td class="text-right">
                                                    <a href="javascript:void(0)"
                                                        onclick="edit_lesson('<?php echo html_escape($lesson->lesson_id); ?>', '<?php echo html_escape($edit_data->course_id); ?>')"
                                                        class="" data-toggle="tooltip" data-placement="top"
                                                        title="Lesson Edit">
                                                        <i class="btn-success text-white btn-sm fa fa-edit"> </i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                        onclick="lesson_delete('<?php echo html_escape($lesson->lesson_id); ?>')"
                                                        class="" data-toggle="tooltip" data-placement="top"
                                                        title="Lesson Delete">
                                                        <i class="btn-danger btn-sm fa fa-trash"> </i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <?php } ?>
                                    </table>
                                </div>

                                <div class="col-sm-12">
                                    <h4 class="m-t-30 m-b-20">Assign Exam List</h4>
                                    <table class="table display table-bordered table-striped table-hover bg-white m-0"
                                        id="assignexamlist">
                                        <thead>
                                            <tr>
                                                <th><?php echo display('sl') ?></th>
                                                <th>Chapter Name</th>
                                                <th><?php echo display('exam_name') ?></th>
                                                <th class="text-center"><?php echo display('action') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $sl=0;
                                            if($get_assignexamlist){ 
                                            foreach($get_assignexamlist as $exam){ 
                                                $sl++; ?>
                                            <tr>
                                                <td><?php echo $sl; ?></td>
                                                <td><?php echo $exam->section_name; ?></td>
                                                <td><?php echo $exam->exam_name; ?></td>
                                                <td class="text-center">
                                                    <!-- <a href="javascript:void(0)"
                                                        onclick="assignexamEdit('<?php echo $exam->course_id; ?>','<?php echo $exam->id; ?>')"
                                                        data-toggle="tooltip" title="Edit"><i
                                                            class="fa fa-edit btn-success text-white btn-sm"></i> </a> -->
                                                    <a href="<?php echo base_url(enterpriseinfo()->shortname.'/course-exam-edit/'. $exam->id); ?>"
                                                        data-toggle="tooltip" title="Exam Edit"><i
                                                            class="fa fa-edit btn-success text-white btn-sm"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                        onclick="assignexamDelete('<?php echo $exam->id; ?>')"
                                                        data-toggle="tooltip" title="Exam Delete"><i
                                                            class="far fa-trash-alt btn-danger  btn-sm"></i></a>
                                                </td>
                                            <tr>
                                                <?php 
                                        }
                                     }else{ ?>
                                            <tr>
                                                <th colspan="5" class='text-center text-danger'>Record not found!</th>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                                <br>
                                <div class="col-sm-12">
                                    <h4 class="m-t-30 m-b-20">Project / Assignment list</h4>
                                    <table class="table display table-bordered table-striped table-hover bg-white m-0"
                                        id="assignexamlist">
                                        <thead>
                                            <tr>
                                                <th><?php echo display('sl') ?></th>
                                                <th><?php echo display('title') ?></th>
                                                <th>Pass Score</th>
                                                <th>Project Mark</th>
                                                <th class="text-center"><?php echo display('action') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $sl=0;
                                            if($get_assignmentprojectlist){
                                            foreach($get_assignmentprojectlist as $assignment){ 
                                                $sl++; ?>
                                            <tr>
                                                <td><?php echo $sl; ?></td>
                                                <td><?php echo $assignment->title; ?></td>
                                                <td><?php echo $assignment->pass_score; ?></td>
                                                <td><?php echo $assignment->project_mark; ?></td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0)"
                                                        onclick="assignmentprojectEdit('<?php echo $assignment->course_id; ?>','<?php echo $assignment->id; ?>')"
                                                        data-toggle="tooltip" title="Assignment Edit"><i
                                                            class="fa fa-edit btn-success text-white btn-sm"></i> </a>
                                                    <a href="javascript:void(0)"
                                                        onclick="assignmentprojectDelete('<?php echo $assignment->id; ?>')"
                                                        data-toggle="tooltip" title="Assignment Delete"><i
                                                            class="far fa-trash-alt btn-danger  btn-sm"></i></a>
                                                </td>
                                            <tr>
                                                <?php }
                                                }else{ ?>
                                            <tr>
                                                <th colspan="5" class='text-center text-danger'>Record not found!</th>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="offset-3 mb-3 group-end">
                                <a class="btn btn-success text-white btnNext " id="v-pills-basic-tab" data-toggle="pill"
                                    href="#v-pills-basic"><?php echo display('next') ?></a>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="v-pills-basic" role="tabpanel"
                            aria-labelledby="v-pills-basic-tab">
                            <div class="form-group row m-r">
                                <label for="name" class="col-sm-3"><?php echo display('course_name') ?><i
                                        class="text-danger"> *</i></label>
                                <div class="col-sm-9">
                                    <input name="name" class="form-control" type="text"
                                        placeholder="<?php echo display('name') ?>" id="name"
                                        value="<?php echo html_escape($edit_data->name); ?>">
                                </div>
                            </div>
                            <?php if ($user_type == 1 || $user_type == 2) { ?>
                            <div class="form-group row m-r">
                                <label for="faculty_id" class="col-sm-3"><?php echo display('instructor') ?><i
                                        class="text-danger"> *</i></label>
                                <div class="col-sm-9">
                                    <select class="form-control placeholder-single" id="faculty_id" name="faculty_id"
                                        data-placeholder="<?php echo display('select_one'); ?>">
                                        <option value=""></option>
                                        <?php foreach ($get_faculty as $faculty) { ?>
                                        <option value="<?php echo html_escape($faculty->faculty_id); ?>" <?php
                                                if ($edit_data->faculty_id == $faculty->faculty_id) {
                                                    echo 'selected';
                                                }
                                                ?>>
                                            <?php echo html_escape($faculty->name); ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <?php } else { ?>
                            <input type="hidden" name="faculty_id" class="faculty_id"
                                value="<?php echo html_escape($user_id); ?>">
                            <?php } ?>
                            <div class="form-group row m-r">
                                <label for="category_id"
                                    class="col-sm-3"><?php echo display('course') . " " . display('category'); ?><i
                                        class="text-danger"> *</i>
                                </label>
                                <div class="col-sm-9">
                                    <select name="category_id" class="form-control placeholder-single" id="category_id"
                                        data-placeholder="<?php echo display('select_one'); ?>"
                                        onchange="category_wise_subcategory(this.value)" required>
                                        <option value=""></option>
                                        <?php foreach ($parent_category as $category) { ?>
                                        <option value="<?php echo html_escape($category->category_id); ?>" <?php
                                            if ($parent_id == $category->category_id) {
                                                echo 'selected';
                                            }
                                            ?>>
                                            <?php echo html_escape($category->name); ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row m-r">
                                <label for="subcategory_id"
                                    class="col-sm-3"><?php echo display('sub') . " " . display('category'); ?></label>
                                <div class="col-sm-9">
                                    <select name="subcategory_id" class="form-control placeholder-single"
                                        id="subcategory_id" data-placeholder="<?php echo display('select_one'); ?>">
                                        <option value=""></option>
                                        <?php foreach ($category_wise_subcategory as $category) { ?>
                                        <option value="<?php echo html_escape($category->category_id); ?>" <?php
                                            if ($edit_data->subcategory_id == $category->category_id) {
                                                echo 'selected';
                                            }
                                            ?>>
                                            <?php echo html_escape($category->name); ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row m-r">
                                <label for="course_level" class="col-sm-3"><?php echo display('course_level') ?><i
                                        class="text-danger"> *</i>
                                </label>
                                <div class="col-sm-9">
                                    <select name="course_level" class="form-control placeholder-single"
                                        id="course_level" data-placeholder="<?php echo display('select_one'); ?>">
                                        <option value=""></option>
                                        <option value="1" <?php
                                        if ($edit_data->course_level == '1') {
                                            echo 'selected';
                                        }
                                        ?>>Begineer</option>
                                        <option value="2" <?php
                                        if ($edit_data->course_level == '2') {
                                            echo 'selected';
                                        }
                                        ?>>Intermediate</option>
                                        <option value="3" <?php
                                        if ($edit_data->course_level == '3') {
                                            echo 'selected';
                                        }
                                        ?>>Advanced</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row m-r">
                                <label for="course_type" class="col-sm-3"><?php echo display('course_type') ?><i
                                        class="text-danger"> *</i></label>
                                <div class="col-sm-9">
                                    <select name="course_type[]" multiple class="form-control placeholder-single"
                                        id="course_type" data-placeholder="<?php echo display('select_one'); ?>">
                                        <option value=""></option>
                                        <option value="1" <?php if(in_array(1, $course_types)){ echo 'selected'; }?>
                                            <?php //echo (($edit_data->course_type == 1) ? 'selected' : ''); ?>>
                                            <?php echo display('purchase'); ?>
                                        </option>
                                        <option value="2" <?php if(in_array(2, $course_types)){ echo 'selected'; }?>
                                            <?php //echo (($edit_data->course_type == 2) ? 'selected' : ''); ?>>
                                            <?php echo display('subscription'); ?>
                                        </option>
                                        <option value="3" <?php if(in_array(3, $course_types)){ echo 'selected'; }?>
                                            <?php //echo (($edit_data->course_type == 3) ? 'selected' : ''); ?>>
                                            <?php echo display('free'); ?>
                                        </option>
                                        <option value="4" <?php if(in_array(4, $course_types)){ echo 'selected'; }?>>
                                            <?php echo display('govt'); ?>
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row m-r">
                                <label for="language" class="col-sm-3"><?php echo display('language') ?> </label>
                                <div class="col-sm-9">
                                    <select name="language" class="form-control placeholder-single" id="language"
                                        data-placeholder="<?php echo display('select_one'); ?>">
                                        <option value=""></option>
                                        <?php foreach($get_languages as $language_k => $language_val){ ?>
                                        <option value="<?php echo $language_k; ?>"
                                            <?php echo (($language_k == $edit_data->language) ? 'selected' : ''); ?>>
                                            <?php echo $language_val; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="form-group row m-r">
                                <label for="course_material" class="col-sm-3">Course Materials</label>
                                <div class="col-sm-9">
                                    <textarea name="course_material" class="form-control" placeholder="Course Materials"
                                        id="course_material"
                                        rows="4"><?php echo (!empty($edit_data->course_material) ? $edit_data->course_material : ''); ?></textarea>
                                </div>
                            </div> -->
                            <!-- <div class="form-group row m-r">
                                <label for="course_isfor" class="col-sm-3">Who this course is for?</label>
                                <div class="col-sm-9">
                                    <textarea name="course_isfor" class="form-control"
                                        placeholder="Who this course is for?" id="course_isfor"
                                        rows="4"><?php echo (!empty($edit_data->course_isfor) ? $edit_data->course_isfor : ''); ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row m-r">
                                <label for="course_result" class="col-sm-3">Course Results</label>
                                <div class="col-sm-9">
                                    <textarea name="course_result" class="form-control"
                                        placeholder="Course Result/What will learners have in the end of this course?"
                                        id="course_result"
                                        rows="4"><?php echo (!empty($edit_data->course_result) ? $edit_data->course_result : ''); ?></textarea>
                                </div>
                            </div> -->
                            <div class="form-group row m-r">
                                <label for="career_outcomes" class="col-sm-3">Learner Career Outcomes</label>
                                <div class="col-sm-8">
                                    <!-- <textarea name="career_outcomes" class="form-control"
                                        placeholder="Learner Career Outcomes" id="career_outcomes"
                                        rows="4"><?php echo (!empty($edit_data->career_outcomes) ? $edit_data->career_outcomes : ''); ?></textarea> -->
                                    <div id="careeroutcome_area">
                                        <?php
                                        $r = 0;
                                        $career_outcomes = json_decode($edit_data->career_outcomes);
                                        foreach ($career_outcomes as $outcome) {
                                            $r++;
                                            ?>
                                        <div class="d-flex mt-2">
                                            <div class="flex-grow-1 pr-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control carrer-out-<?php echo $r; ?>"
                                                        name="career_outcomes[]" id="career_outcomes_<?php echo $r; ?>"
                                                        onkeyup="characterlimitation('carrer-out', 1, 40, 'career-msgcount')"
                                                        value="<?php echo html_escape($outcome); ?>"
                                                        placeholder="Learner Career Outcomes" ;>
                                                    <span class=" text-danger">Only <span
                                                            class="career-msgcount-<?php echo $r; ?>">40</span>
                                                        characters remaining</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <button type='button' class='btn btn-danger btn-sm custom_btn m-t-0'
                                                    name='button' onclick='removeCareeroutcome(this)'> <i
                                                        class='fa fa-minus'></i> </button>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <a href="javascript:void(0)"
                                        class="btn btn-success text-white btn-sm custom_btn float-right mt-2"
                                        onclick="appendCareeroutcome()"><i class="fa fa-plus"></i> </a>
                                </div>
                            </div>
                            <div class="form-group row m-r">
                                <label for="career_outcomes" class="col-sm-3">Skills you will gain</label>
                                <div class="col-sm-8">
                                    <div id="skillsgain_area">
                                        <?php
                                        $s = 0;
                                        $skillsgain = json_decode($edit_data->skillsgain);
                                        foreach ($skillsgain as $skills) {
                                            $s++;
                                            ?>
                                        <div class="d-flex mt-2">
                                            <div class="flex-grow-1 pr-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control skillsgain-<?php echo $s; ?>"
                                                        onkeyup="characterlimitation('skillsgain', 1, 20, 'skillgain-msgcount')"
                                                        name="skillsgain[]" id="skillsgain_<?php echo $s; ?>"
                                                        value="<?php echo html_escape($skills); ?>"
                                                        placeholder="Skills you will gain?" ;>
                                                    <span class=" text-danger">Only <span
                                                            class="skillgain-msgcount-<?php echo $s; ?>">20</span>
                                                        characters remaining</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <button type='button' class='btn btn-danger btn-sm custom_btn m-t-0'
                                                    name='button' onclick='removeSkillsgain(this)'> <i
                                                        class='fa fa-minus'></i> </button>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <a href="javascript:void(0)"
                                        class="btn btn-success text-white btn-sm custom_btn float-right mt-2"
                                        onclick="appendSkillsgain()"><i class="fa fa-plus"></i> </a>
                                </div>
                            </div>
                            <div class="form-group row m-r">
                                <label for="related_resource" class="col-sm-3">Related Resources</label>
                                <div class="col-sm-8">
                                    <!-- <textarea name="related_resource" class="form-control"
                                        placeholder="Related Resources" id="related_resource"
                                        rows="4"><?php echo (!empty($edit_data->related_resource) ? $edit_data->related_resource : ''); ?></textarea> -->
                                    <div id="relatedresource_area">
                                        <?php
                                        $r = 0;
                                        $relatedresources = json_decode($edit_data->related_resource);
                                        foreach ($relatedresources as $relatedres) {
                                            $r++;
                                            ?>
                                        <div class="d-flex mt-2">
                                            <div class="flex-grow-1 pr-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="related_resource[]"
                                                        id="related_resource_<?php echo $r; ?>"
                                                        value="<?php echo html_escape($relatedres); ?>"
                                                        placeholder="Related Resource" ;>
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <button type='button' class='btn btn-danger btn-sm custom_btn m-t-0'
                                                    name='button' onclick='removeRelatedresource(this)'> <i
                                                        class='fa fa-minus'></i> </button>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <a href="javascript:void(0)"
                                        class="btn btn-success text-white btn-sm custom_btn float-right mt-2"
                                        onclick="appendRelatedresource()"><i class="fa fa-plus"></i> </a>
                                </div>
                            </div>
                            <div class="form-group row m-r">
                                <label for="description" class="col-sm-3">About this course </label>
                                <div class="col-sm-9">
                                    <textarea name="description" id="description" rows="10"
                                        cols="80"><?php echo html_escape($edit_data->description); ?></textarea>
                                </div>
                            </div>
                            <!-- <div class="form-group row m-r">
                                <label for="summary" class="col-sm-3"><?php echo display('short_description') ?>
                                </label>
                                <div class="col-sm-9">
                                    <textarea name="summary" class="form-control"
                                        placeholder="<?php echo display('short_description') ?>"
                                        id="summary"><?php echo html_escape($edit_data->summary); ?></textarea>
                                </div>
                            </div> -->

                            <?php 
                                $related_courses = [];
                                if($edit_data->related_courseid){
                                    $related_courses = json_decode($edit_data->related_courseid);
                                }
                            ?>
                            <div class="form-group row m-r">
                                <label for="related_courseid" class="col-sm-3"><?php echo display('related_course') ?>
                                </label>
                                <div class="col-sm-9">
                                    <select name="related_courseid[]" class="form-control placeholder-single"
                                        id="related_courseid" data-placeholder="<?php echo display('select_one'); ?>"
                                        multiple>
                                        <option value=""><?php echo display('select_one'); ?></option>
                                        <?php foreach($get_course as $relatedcourse){ 
                                            if($relatedcourse->course_id != $edit_data->course_id){
                                            ?>
                                        <option value="<?php echo $relatedcourse->course_id; ?>"
                                            <?php if(in_array($relatedcourse->course_id, $related_courses)){ echo 'selected'; }?>>
                                            <?php echo $relatedcourse->name; ?>
                                        </option>
                                        <?php 
                                        } 
                                    } 
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row m-r">
                                <?php if ($user_type == 1) { ?>
                                <!-- <div class="offset-3 checkbox checkbox-success">
                                    <input id="is_popular" name="is_popular" type="checkbox"
                                        value="<?php echo html_escape((($edit_data->is_popular == 1) ? "$edit_data->is_popular" : '0')); ?>" <?php
                                        if ($edit_data->is_popular == 1) {
                                            echo 'checked';
                                        }
                                        ?>>
                                    <label for="is_popular"><?php echo display('is_popular'); ?></label>
                                </div> -->
                                <?php } ?>
                                <!-- <div class="offset-1 checkbox checkbox-success">
                                    <input id="is_new" type="checkbox" name="is_new"
                                        value="<?php echo $edit_data->is_new; ?>"
                                        <?php echo (($edit_data->is_new == 1) ? 'checked' : ''); ?>>
                                    <label for="is_new"><?php echo display('is_new'); ?></label>
                                </div> -->

                                <!-- <label for="commission" class="col-sm-3 text-right"><?php echo display('commission') ?>
                                    <i class="text-danger"> *</i></label>
                                <div class="col-sm-1">
                                    <input type="text" class="form-control" id="commission" name="commission"
                                        placeholder="Commssion"
                                        value="<?php echo (!empty($edit_data->commission) ? $edit_data->commission : ''); ?>">
                                </div> -->

                            </div>
                            <div class="form-group row m-r">
                                <label class="col-sm-3" for="requirements">Pre Requisites</label>
                                <div class="col-sm-8">
                                    <div id="requirement_area">
                                        <?php
                                        $r = 0;
                                        $requirements = json_decode($edit_data->requirements);
                                        foreach ($requirements as $requirement) {
                                            $r++;
                                            ?>
                                        <div class="d-flex mt-2">
                                            <div class="flex-grow-1 pr-3">
                                                <div class="form-group">
                                                    <input type="text"
                                                        class="form-control requirements-<?php echo $r; ?>"
                                                        name="requirements[]" id="requirements_<?php echo $r; ?>"
                                                        onkeyup="characterlimitation('requirements', 1, 40, 'requirements-msgcount')"
                                                        value="<?php echo html_escape($requirement); ?>"
                                                        placeholder="Pre Requisites">
                                                    <span class=" text-danger">Only <span
                                                            class="requirements-msgcount-1">40</span> characters
                                                        remaining</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <button type='button' class='btn btn-danger btn-sm custom_btn m-t-0'
                                                    name='button' onclick='removeRequirement(this)'> <i
                                                        class='fa fa-minus'></i> </button>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <a href="javascript:void(0)"
                                        class="btn btn-success text-white btn-sm custom_btn float-right mt-2"
                                        onclick="appendpreRequirement()"><i class="fa fa-plus"></i> </a>
                                </div>
                            </div>
                            <div class="form-group row m-r">
                                <label class="col-md-3"
                                    for="outcomes"><?php echo display('what_you_will_learn'); ?></label>
                                <div class="col-md-8">
                                    <div id="outcomes_area">
                                        <?php
                                        $o = 0;
                                        $benifits = json_decode($edit_data->benifits);
                                        foreach ($benifits as $benifit) {
                                            $o++;
                                            ?>
                                        <div class="d-flex mt-2">
                                            <div class="flex-grow-1 pr-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control outcomes-<?php echo $o; ?>"
                                                        name="benifits[]" id="outcomes_<?php echo $o; ?>"
                                                        onkeyup="characterlimitation('outcomes', 1, 40, 'outcomes-msgcount')"
                                                        value="<?php echo html_escape($benifit); ?>"
                                                        placeholder="<?php echo display('course_benefit'); ?>">
                                                    <span class=" text-danger">Only <span
                                                            class="outcomes-msgcount-<?php echo $o; ?>">40</span>
                                                        characters remaining</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <button type="button" class="btn btn-danger btn-sm custom_btn m-t-0"
                                                    name="button" onclick="removeOutcome(this)"> <i
                                                        class="fa fa-minus"></i> </button>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <button type="button"
                                        class="btn btn-success text-white btn-sm custom_btn float-right mt-2"
                                        name="button" onclick="appendlearnOutcome()"> <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label for="course_provider"
                                    class="col-sm-3"><?php echo display('course_provider') . " " . display('source'); ?>
                                </label>
                                <div class="col-sm-6">
                                    <select name="course_provider" class="form-control placeholder-single"
                                        id="course_provider" data-placeholder="<?php echo display('select_one'); ?>">
                                        <option value=""></option>
                                        <option value="1" <?php
                                        // if ($edit_data->course_provider == 1) {
                                        //     echo 'selected';
                                        // }
                                        ?>><?php //echo display('youtube'); ?></option>
                                        <option value="2" <?php
                                       // if ($edit_data->course_provider == 2) {
                                         //   echo 'selected';
                                       /// }
                                        ?>><?php //echo display('vimeo'); ?></option>
                                    </select>
                                </div>
                            </div> -->
                            <!-- <div class="form-group row">
                                <label for="url" class="col-sm-3">Course Promotional Video Trailer</label>
                                <div class="col-sm-6">
                                    <input name="url" class="form-control" type="text"
                                        placeholder="Course Promotional Video Trailer" id="url"
                                        value="<?php //echo html_escape($edit_data->url); ?>">
                                </div>
                            </div> -->
                            <input type="hidden" name="url" id="url">
                            <input type='hidden' class='form-control' id='old_url' name='old_url'
                                value="<?php echo html_escape((!empty($edit_data->url)?$edit_data->url : '')); ?>">
                            <input type="hidden" name="course_provider" id="course_provider" value="2">
                            <div class="form-group row">
                                <label for="pro_url" class="col-sm-3">Course Promotional Video<i class="text-danger">
                                        *</i></label>
                                <div class="col-sm-6">
                                    <div>
                                        <!-- <input type="file" name="pro_url" id="pro_url"
                                            class="custom-input-file fileuploader">
                                        <label for="pro_url">
                                            <i class="fa fa-upload"></i>
                                            <span>Choose Course Promotional Video…</span>
                                        </label> -->
                                        <input type="file" name="pro_url" id="pro_url" class="custom-file-input fileuploader">
                                        <label class="custom-file-label" id="pro_url-custom-file-label" for="pro_url"><?php echo (!empty($edit_data->url) ? $edit_data->url : 'Choose Course Promotional Video…'); ?></label>
                                        <br>
                                        <br>
                                        <div id="progress-container" class="progress" style='display:none'>
                                            <div id="progress"
                                                class="progress-bar progress-bar-info progress-bar-striped active"
                                                role="progressbar" aria-valuenow="46" aria-valuemin="0"
                                                aria-valuemax="100" style="width: 0%">&nbsp;0%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2" id="trailervideo_delete_content"
                                    style="display:<?php echo ($edit_data->url?'block':'none')?>">
                                    <a class="btn btn-danger py-2 text-capitalize" href="javascript:void(0)"
                                        onclick="cancel_trailer_video()">cancel</a>
                                </div>
                            </div>
                            <div class="form-group row m-r">
                                <label for="pro_url" class="col-sm-3"> </label>
                                <div class="col-sm-6 ">
                                    <?php 
                                 if(!empty($edit_data->url)){
                                 $urldata=$edit_data->url;
                                 $ddd= explode('/',$urldata);
                                ?>
                                    <div class="row">
                                        <div class="ratio ratio-16x9 video-upload videopreview">
                                            <iframe id="iframe"
                                                src="https://player.vimeo.com/video/<?php echo (!empty($ddd[3]) ? $ddd[3] : ''); ?>"
                                                width="640" height="360" frameborder="0" allowfullscreen
                                                allow="autoplay; encrypted-media"></iframe>

                                        </div>
                                    </div>


                                    <?php }?>
                                </div>
                            </div>

                            <!-- <div class="form-group row">
                                <label for="url" class="col-sm-3">Course Promotional Video Trailer</label>
                                <div class="col-sm-6">
                                    <div>
                                        <input type="hidden" name="old_url" id="old_url"
                                            value="<?php echo (!empty($edit_data->url) ? $edit_data->url : ''); ?>">
                                        <input type="file" name="url" id="url" class="custom-input-file"/>
                                        <label for="url">
                                            <i class="fa fa-upload"></i>
                                            <span>Choose Video Trailer…</span>
                                        </label>
                                    </div>
                                    <br>
                                    <?php  if (!empty($edit_data->url)) { ?>
                                    <video width="400" controls>
                                        <source src="<?php echo base_url($edit_data->url); ?>">
                                    </video>
                                    <?php } ?>
                                </div>
                            </div> -->


                            <div class="form-group row">
                                <label for="thumbnail" class="col-sm-3">Course Mini Thumbnail<i class="text-danger">
                                        *</i> </label>
                                <div class="col-sm-6">
                                    <!-- <div>
                                        <input type="hidden" name="old_thumbnail" id="old_thumbnail"
                                            value="<?php echo (!empty($edit_data->picture) ? $edit_data->picture : ''); ?>">
                                        <input type="file" name="thumbnail" id="thumbnail" class="custom-input-file"
                                            onchange="fileValueOneCourse(this,'course_featured_image')" />
                                        <label for="thumbnail">
                                            <i class="fa fa-upload"></i>
                                            <span>Choose Course Mini Thumbnail…</span>
                                        </label>
                                    </div> -->
                                    <div class="custom-file">
                                        <input type="hidden" name="old_thumbnail_name" id="old_thumbnail_name"
                                            value="<?php echo (!empty($edit_data->filename) ? $edit_data->filename : ''); ?>">
                                        <input type="hidden" name="old_thumbnail" id="old_thumbnail"
                                            value="<?php echo (!empty($edit_data->picture) ? $edit_data->picture : ''); ?>">
                                        <input type="file" name="thumbnail" id="thumbnail" class="custom-file-input"
                                            onchange="fileValueOneCourse(this,'course_featured_image')">
                                        <label class="custom-file-label" id="thumbnail-custom-file-label"
                                            for="thumbnail"><?php echo (!empty($edit_data->filename) ? $edit_data->filename : 'Choose Course Mini Thumbnail…'); ?></label>
                                    </div>
                                    <span class="text-danger">( 398×224 formats :png,jpg,jpeg,gif)</span>
                                    <?php if ($edit_data->picture) { ?>
                                    <div class="img_border" id="img-preview-course_featured_image">
                                        <img src="<?php echo base_url(html_escape($edit_data->picture)); ?>"
                                            alt="<?php echo html_escape($edit_data->name); ?>" width="20%">
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="course_featured_image" class="col-sm-3"> </label>
                                <div class="col-sm-6">
                                    <img id="image-preview-course_featured_image" src="" alt="" class="border border-2"
                                        width="200px">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="hover_thumbnail" class="col-sm-3">Course Mini Thumbnail Hover<i
                                        class="text-danger"> *</i> </label>
                                <div class="col-sm-6">
                                    <!-- <div>  
                                        <input type="hidden" name="old_hover_thumbnail" id="old_hover_thumbnail"
                                            value="<?php echo (!empty($edit_data->hover_thumbnail) ? $edit_data->hover_thumbnail : ''); ?>">                                      
                                        <input type="file" name="hover_thumbnail" id="hover_thumbnail"
                                            class="custom-input-file"
                                            onchange="fileValueOneCourse(this,'hover_thumbnails')" />
                                        <label for="hover_thumbnail">
                                            <i class="fa fa-upload"></i>
                                            <span>Choose Course Mini Thumbnail Hover…</span>
                                        </label>
                                    </div> -->
                                    <div class="custom-file">
                                        <input type="hidden" name="old_hover_thumbnail_name" id="old_hover_thumbnail_name"
                                            value="<?php echo (!empty($edit_data->hover_thumbnail_name) ? $edit_data->hover_thumbnail_name : ''); ?>">
                                        <input type="hidden" name="old_hover_thumbnail" id="old_hover_thumbnail"
                                            value="<?php echo (!empty($edit_data->hover_thumbnail) ? $edit_data->hover_thumbnail : ''); ?>">
                                        <input type="file" name="hover_thumbnail" id="hover_thumbnail"
                                            class="custom-file-input"
                                            onchange="fileValueOneCourse(this,'hover_thumbnails')">
                                        <label class="custom-file-label" id="hover-custom-file-label"
                                            for="hover_thumbnail"><?php echo (!empty($edit_data->hover_thumbnail_name) ? $edit_data->hover_thumbnail_name : 'Choose Course Mini Thumbnail Hover…'); ?></label>
                                    </div>
                                    <span class="text-danger">( 312×345 formats :png,jpg,jpeg,gif)</span>
                                    <?php if ($edit_data->hover_thumbnail) { ?>
                                    <div class="img_border" id="img-preview-hover_thumbnails">
                                        <img src="<?php echo base_url(html_escape($edit_data->hover_thumbnail)); ?>"
                                            alt="<?php echo html_escape($edit_data->name); ?>" width="20%">
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hover_thumbnail" class="col-sm-3"> </label>
                                <div class="col-sm-6">
                                    <img id="image-preview-hover_thumbnails" src="" alt="" class="border border-2"
                                        width="200px">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cover_thumbnail" class="col-sm-3">Cover (Image/Thumbnail)<i
                                        class="text-danger"> </i> </label>
                                <div class="col-sm-6">
                                    <!-- <div>
                                        <input type="hidden" name="old_cover_thumbnail" id="old_cover_thumbnail"
                                            value="<?php echo (!empty($edit_data->cover_thumbnail) ? $edit_data->cover_thumbnail : ''); ?>">
                                        <input type="file" name="cover_thumbnail" id="cover_thumbnail"
                                            class="custom-input-file"
                                            onchange="fileValueOneCourse(this,'cover_thumbnails')" />
                                        <label for="cover_thumbnail">
                                            <i class="fa fa-upload"></i>
                                            <span>Choose Cover (Image/Thumbnail)…</span>
                                        </label>
                                    </div> -->
                                    <div class="custom-file">
                                        <input type="hidden" name="old_cover_thumbnail_name" id="old_cover_thumbnail_name"
                                            value="<?php echo (!empty($edit_data->cover_thumbnail_name) ? $edit_data->cover_thumbnail_name : ''); ?>">
                                        <input type="hidden" name="old_cover_thumbnail" id="old_cover_thumbnail"
                                            value="<?php echo (!empty($edit_data->cover_thumbnail) ? $edit_data->cover_thumbnail : ''); ?>">
                                        <input type="file" name="cover_thumbnail" id="cover_thumbnail"
                                            class="custom-file-input"
                                            onchange="fileValueOneCourse(this,'cover_thumbnails')">
                                        <label class="custom-file-label" id="cover_thumbnail-custom-file-label"
                                            for="cover_thumbnail"><?php echo (!empty($edit_data->cover_thumbnail_name) ? $edit_data->cover_thumbnail_name : 'Choose Cover (Image/Thumbnail)…'); ?></label>
                                    </div>
                                    <span class="text-danger">( 1903×476 formats :png,jpg,jpeg,gif)</span>
                                    <?php if ($edit_data->cover_thumbnail) { ?>
                                    <div class="img_border" id="img-preview-cover_thumbnails">
                                        <img src="<?php echo base_url(html_escape($edit_data->cover_thumbnail)); ?>"
                                            alt="<?php echo html_escape($edit_data->name); ?>" width="20%">
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cover_thumbnail" class="col-sm-3"> </label>
                                <div class="col-sm-6">
                                    <img id="image-preview-cover_thumbnails" src="" alt="" class="border border-2"
                                        width="200px">
                                </div>
                            </div>

                            <div class="form-group row m-r">
                                <label for="passing_grade" class="col-sm-3"><?php echo 'Passing Grade' ?><span
                                        class="text-danger"> (%)</span><i class="text-danger"> </i></label>
                                <div class="col-sm-4">
                                    <input name="passing_grade" class="form-control" type="number" placeholder="20%"
                                        id="passing_grade"
                                        value="<?php echo  (!empty($edit_data->passing_grade) ? $edit_data->passing_grade : ''); ?>">
                                </div>
                            </div>
                            <?php  //d($edit_data); ?>
                            <div class="form-group row m-r">
                                <label for="syllabus" class="col-sm-3"><?php echo display('syllabus') ?><i
                                        class="text-danger"> </i></label>
                                <div class="col-sm-4">
                                    <!-- <div>
                                        <input type="hidden" name="old_syllabus" id="old_syllabus"
                                            value="<?php echo (!empty($edit_data->syllabus) ? $edit_data->syllabus : ''); ?>">

                                        <input type="file" name="syllabus" id="syllabus"
                                            onchange="uploadProgress('syllabus')" class="custom-input-file" />
                                        <label for="syllabus">
                                            <i class="fa fa-upload"></i>
                                            <span>Choose Syllabus…</span>
                                        </label>
                                    </div> -->
                                    <div class="custom-file">
                                    <input type="hidden" name="old_syllabus_filename" id="old_syllabus_filename"
                                            value="<?php echo (!empty($edit_data->syllabus_filename) ? $edit_data->syllabus_filename : ''); ?>">
                                    <input type="hidden" name="old_syllabus" id="old_syllabus"
                                            value="<?php echo (!empty($edit_data->syllabus) ? $edit_data->syllabus : ''); ?>">
                                        <input type="file" name="syllabus" id="syllabus" class="custom-file-input"
                                        onchange="uploadProgress('syllabus')" class="custom-input-file">
                                        <label class="custom-file-label" id="syllabus-custom-file-label"
                                            for="syllabus"><?php echo (!empty($edit_data->syllabus_filename) ? $edit_data->syllabus_filename : 'Choose Syllabus…'); ?></label>
                                    </div>
                                    <div class="progress-area mt-2"></div>
                                    <!-- Display upload status -->
                                    <div id="uploadStatus"></div>
                                </div>
                                <?php if($edit_data->syllabus){ ?>
                                <a href="<?php echo base_url($edit_data->syllabus); ?>" target="_new">
                                    <i class="fas fa-book"></i>
                                </a>
                                <?php } ?>
                            </div>

                            <div class="form-group row">
                                <label for='resource' class='col-sm-3'>Course Resource Files</label>
                                <div class='col-sm-4' id="resource_area">
                                    <?php
                                    $re=0;
                                    foreach($get_courseresource as $resource){
                                        $re++;
                                        $resource_filename = '';
                                        if($resource->files){
                                            $resourcefile_name=($resource->files);
                                            $resource_filename = explode('-f-', $resourcefile_name);
                                            $resource_filename = $resource_filename[1];
                                        }
                                        ?>
                                    <div class="row" id="resource-deleted-sl-<?php echo $resource->id; ?>">
                                        <div class="col-sm-6" style="margin-top : 15px;">
                                            <a href="<?php echo base_url($resource->files); ?>" target="_new"><i
                                                    class="fa fa-book-open"></i>   <?php echo $resource_filename; ?></a>
                                        </div>
                                        <div class="col-sm-2">
                                            <a href="javascript:void(0)" class='btn btn-danger btn-sm custom_btn mt-2'
                                                name='button'
                                                onclick='deletecourseResource("<?php echo $resource->id; ?>")'>
                                                <i class='fa fa-minus'></i></a>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <input type='file' name='resource[]' id='resource_<?php echo $re; ?>'
                                                onchange="fileuploaderprogress('<?php echo $re; ?>', 'resource_<?php echo $re; ?>', 'resource-uploadStatus-<?php echo $re; ?>', 'resource-progress-area-<?php echo $re; ?>')"
                                                class='custom-input-file'>
                                            <label for='resource_<?php echo $re; ?>'><i
                                                    class='fa fa-upload'></i><span class="filename-<?php echo $re; ?>">Choose a file
                                                    ...</span> </label>
                                            <br>
                                        
                                            <div class="resource-uploadStatus-<?php echo $re; ?> col-sm-8"></div>
                                            <div class="resource-progress-area-<?php echo $re; ?> col-sm-8 mb-3"></div>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type='button' class='btn btn-danger btn-sm custom_btn mt-2'
                                                name='button' onclick='removeResource(this)'> <i
                                                    class='fa fa-minus'></i> </button>
                                        </div>
                                    </div>
                                 
                                </div>
                                <div class="col-sm-2">
                                    <input type="hidden" id="resource_sl" value="<?php echo $re; ?>">
                                    <a href="javascript:void(0)"
                                        class="btn btn-success text-white btn-sm custom_btn mt-2"
                                        onclick="appendAddresource()"><i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="offset-3 mb-3 group-end">
                                <a class="btn btn-danger btnPrevious" id="v-pills-curriculum-tab" data-toggle="pill"
                                    href="#v-pills-curriculum"><?php echo display('previous') ?></a>
                                <?php
                                if(in_array(1, $course_types)){
                                // if($edit_data->course_type==1){
                                    ?>
                                <a class="btn btn-success text-white btnNext pricenext" id="v-pills-pricing-tab"
                                    data-toggle="pill" href="#v-pills-pricing"><?php echo display('next') ?></a>
                                <?php }else{?>
                                <input type="submit" class="btn btn-success text-white submitbutton_second"
                                    id="courseupdate_btn" value="<?php echo display('finish'); ?>">
                                <?php }?>
                                <input type="submit" class="btn btn-success text-white submitbtn_first"
                                    id="courseupdate_btn" value="<?php echo display('finish'); ?>">
                                <a class="btn btn-success text-white btnNext finishnext" id="v-pills-pricing-tab"
                                    data-toggle="pill" href="#v-pills-pricing"><?php echo display('next') ?></a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-pricing" role="tabpanel"
                            aria-labelledby="v-pills-pricing-tab">
                            <!-- <div class="form-group row">
                                <div class="offset-2 checkbox checkbox-success">
                                    <input id="is_free" name="is_free" type="checkbox"
                                        value="<?php echo html_escape($edit_data->is_free); ?>" <?php
                                    if ($edit_data->is_free == 1) {
                                        echo 'checked';
                                    }
                                    ?>>
                                    <label for="is_free"><?php echo display('is_free_course') ?></label>
                                </div>
                            </div> -->
                            <!-- <div class="dependent_freecourse"> -->
                            <?php //if ($edit_data->is_free == 0) { ?>
                            <div class="form-group row">
                                <label for="oldprice" class="col-sm-2">Base Price </label>
                                <div class="col-sm-6">
                                    <input name="oldprice" class="form-control" type="number" placeholder="Base Price"
                                        id="oldprice" onkeyup="pricecalculation()"
                                        value="<?php echo html_escape($edit_data->oldprice); ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-2 checkbox checkbox-success">
                                    <input id="is_discount" name="is_discount" type="checkbox"
                                        value="<?php echo $edit_data->is_discount; ?>"
                                        <?php echo (($edit_data->is_discount == 1) ? 'checked' : ''); ?>>
                                    <label for="is_discount"><?php echo display('is_discount'); ?></label>
                                </div>
                            </div>

                            <div id="defaultdiscountoff">
                                <?php if($edit_data->is_discount == 1){ ?>
                                <div class="form-group row">
                                    <label for="discount_type" class="col-sm-2"><?php echo display('discount_type'); ?>
                                    </label>
                                    <div class="col-sm-6">
                                        <select class="form-control placeholder-single" name="discount_type"
                                            id="discount_type" onchange="pricecalculation()"
                                            data-placeholder="<?php echo display('select_one'); ?>">
                                            <option value=""></option>
                                            <option value="1"
                                                <?php echo (($edit_data->discount_type == 1) ? 'selected' : ''); ?>>
                                                Fixed</option>
                                            <option value="2"
                                                <?php echo (($edit_data->discount_type == 2) ? 'selected' : ''); ?>>
                                                Percent</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="discount" class="col-sm-2"><?php echo display('discount'); ?></label>
                                    <div class="col-sm-6">
                                        <input name="discount" class="form-control" type="number"
                                            value="<?php echo $edit_data->discount; ?>"
                                            placeholder="<?php echo display('discount') ?>" id="discount"
                                            onkeyup="pricecalculation()">
                                    </div>
                                </div>
                                <?php } ?>
                            </div>

                            <div class="dependent_discountcourse">
                            </div>

                            <div class="form-group row">
                                <label for="price"
                                    class="col-sm-2"><?php echo display('current') . " " . display('price') ?>
                                </label>
                                <div class="col-sm-6">
                                    <input name="price" class="form-control" type="number"
                                        placeholder="<?php echo display('price') ?>" id="price"
                                        onkeyup="onlynumber_allow(this.value, 'price')"
                                        value="<?php echo html_escape($edit_data->price); ?>" readonly>
                                </div>
                            </div>
                            <?php //} ?>
                            <!-- </div> -->


                            <!-- <div class="form-group row">
                                <div class="offset-2 checkbox checkbox-success">
                                    <input id="is_offer" name="is_offer" type="checkbox"
                                        value="<?php echo $edit_data->is_offer; ?>"
                                        <?php echo (($edit_data->is_offer == 1) ? 'checked' : ''); ?>>
                                    <label for="is_offer"><?php echo 'Apply Discount'; ?></label>
                                </div>
                            </div> -->
                            <?php 
                                $offercourse = [];
                                foreach($get_offercourses as $offer){
                                $offercourse[] = $offer->course_offerid;
                                }
                            ?>
                            <div id="defaultofferoff">
                                <?php if($edit_data->is_offer == 1){ ?>
                                <div class="form-group row">
                                    <label for="offer_courseid" class="col-sm-2"><?php echo display('offer'); ?></label>
                                    <div class="col-sm-6">
                                        <select name="offer_courseid[]" class="form-control placeholder-single"
                                            id="offer_courseid" data-placeholder="<?php echo display('select_one'); ?>"
                                            multiple>
                                            <option value=""><?php echo display('select_one'); ?></option>
                                            <?php foreach($get_course as $offer){ 
                                                if($offer->course_id != $edit_data->course_id){
                                                ?>
                                            <option value="<?php echo $offer->course_id; ?>"
                                                <?php if(in_array($offer->course_id, $offercourse)){ echo 'selected'; }?>>
                                                <?php echo $offer->name; ?>
                                            </option>
                                            <?php 
                                            } 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="offer_courseprice" class="col-sm-2">Course Price</label>
                                    <div class="col-sm-6">
                                        <input name="offer_courseprice" class="form-control" type="number"
                                            value="<?php echo $edit_data->offer_courseprice; ?>" id="offer_courseprice">
                                    </div>
                                </div>
                                <?php } ?>
                            </div>



                            <input type='hidden' id='offercourse_hiddenvalue' value='<?php foreach($get_course as $offer){ 
                                            if($offer->course_id != $edit_data->course_id){
                                            ?>
                                       <option value="<?php echo $offer->course_id; ?>">
                                            <?php echo $offer->name; ?>
                                        </option>
                                        <?php 
                                        } 
                                        }
                                         ?>'>
                            <div class="dependent_offercourse">
                            </div>



                            <div class="offset-3 mb-3 group-end">
                                <a class="btn btn-danger btnPrevious" id="v-pills-basic-tab" data-toggle="pill"
                                    href="#v-pills-basic"><?php echo display('previous') ?></a>
                                <!-- <a class="btn btn-success text-white btnNext" id="v-pills-assignexam-tab" data-toggle="pill"
                                    href="#v-pills-assignexam"><?php echo display('next') ?></a> -->
                                <input type="hidden" name="course_id" id="course_id"
                                    value="<?php echo html_escape($edit_data->course_id); ?>">
                                <input type="submit" class="btn btn-success text-white" id="courseupdate_btn"
                                    value="<?php echo display('finish'); ?>">
                            </div>

                        </div>
                        <!-- <div class="tab-pane fade" id="v-pills-assignexam" role="tabpanel"
                            aria-labelledby="v-pills-assignexam-tab">
                            <div class="form-group row m-r">

                                <div class="col-md-9">
                                    <table class="table display table-bordered table-striped table-hover bg-white m-0"
                                        id="assignexamlist">
                                        <thead>
                                            <tr>
                                                <th><?php //echo display('sl') ?></th>
                                                <th><?php //echo display('lesson_name') ?></th>
                                                <th><?php //echo display('exam_name') ?></th>
                                                <th class="text-center"><?php //echo display('action') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php //foreach($get_assignexamlist as $exam){ ?>
                                                <tr>
                                                    <td><?php //echo $sl; ?></td>
                                                    <td><?php //echo $exam->lesson_name; ?></td>
                                                    <td><?php //echo $exam->exam_name; ?></td>
                                                    <td>
                                                        
                                                    </td>
                                                <tr>
                                            <?php //} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="offset-3 mb-3 group-end">
                                <a class="btn btn-danger btnPrevious" id="v-pills-pricing-tab" data-toggle="pill"
                                    href="#v-pills-pricing"><?php echo display('previous') ?></a>
                                <input type="submit" class="btn btn-success" id="courseupdate_btn"
                                    value="<?php echo display('finish'); ?>">
                            </div>
                        </div> -->
                    </div>
                    <?php echo form_close(); ?>
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
<script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.active.js'); ?>"></script>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/course_edit.js?v=3') ?>"></script>
<script src="https://player.vimeo.com/api/player.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/dist/js/vimeo-upload.js"></script>
<script>
$(document).ready(function() {
     // =================== pro_url ==============
     $("#pro_url").on("change", function() {
        var files = Array.from(this.files)
        var fileName = files.map(f => {
            return f.name
        }).join(", ")
        $(this).siblings("#pro_url-custom-file-label").addClass("selected").html(fileName);
    });
    // ==================
    // =================== thumbnail ==============
    $("#thumbnail").on("change", function() {
        var files = Array.from(this.files)
        var fileName = files.map(f => {
            return f.name
        }).join(", ")
        $(this).siblings("#thumbnail-custom-file-label").addClass("selected").html(fileName);
    });
    // ==================
    // =================== hover thumbnail ==============
    $("#hover_thumbnail").on("change", function() {
        var files = Array.from(this.files)
        var fileName = files.map(f => {
            return f.name
        }).join(", ")
        $(this).siblings("#hover-custom-file-label").addClass("selected").html(fileName);
    });
    // ==================
    // =================== cover thumbnail ==============
    $("#cover_thumbnail").on("change", function() {
        var files = Array.from(this.files)
        var fileName = files.map(f => {
            return f.name
        }).join(", ")
        $(this).siblings("#cover_thumbnail-custom-file-label").addClass("selected").html(fileName);
    });
    // ==================
    // =================== syllabus ==============
    $("#syllabus").on("change", function() {
        var files = Array.from(this.files)
        var fileName = files.map(f => {
            return f.name
        }).join(", ")
        $(this).siblings("#syllabus-custom-file-label").addClass("selected").html(fileName);
    });
    // ==================
});

// image preview js 
// image preview js 
function fileValueOneCourse(value, sectionval) {
    // all old preview image hide

    var path = value.value;
    var extenstion = path.split('.').pop();
    if (extenstion == "jpg" || extenstion == "svg" || extenstion == "jpeg" || extenstion == "png" || extenstion ==
        "gif" || extenstion == "webp") {
        //   document.getElementById('image-preview-'+sectionval).src = window.URL.createObjectURL(value.files[0]);
        var img = '<img src="' + window.URL.createObjectURL(value.files[0]) + '" width="20%">'
        var filename = path.replace(/^.*[\\\/]/, '').split('.').slice(0, -1).join('.');
        $("#img-preview-" + sectionval).html(img);
        // document.getElementById("filename").innerHTML = filename;
    } else {
        alert("File not supported. Kindly Upload the Image of below given extension ")
    }
}



//     // video upload js
//     $(document).ready(function() {
// 	$("#loader-icon").hide();
// 	$('.fileuploader').change(function () {

// 		event.preventDefault();
// 	    var	base_url=$('#base_url').val();

//         // hide class 
// 		$(".btnNext").hide();
// 		$('#coursesave_btn').hide();
//         $("#v-pills-pricing-tab").prop("disabled", true);
//         $("#v-pills-pricing-tab").addClass("price_disable");
//         $("#iframe").hide();
//         // hide class 

// 		$("#phppot-message").removeClass("error");
// 		$("#phppot-message").removeClass("success");
// 		$("#phppot-message").text("");
// 		$("#btnUpload").hide();
// 		$("#loader-icon").show();
//         var video_file = $("#pro_url").val();
// 		var CSRF_TOKEN = $("#CSRF_TOKEN").val();
// 		var enterprise_shortname = $("#enterprise_shortname").val();
// 		var fd = new FormData();
// 		fd.append("video_file", $("#pro_url")[0].files[0]);
//         fd.append('csrf_test_name', (CSRF_TOKEN));

// 		$.ajax({ 
// 			url :base_url + enterprise_shortname + "/promo-video-upload",
// 			type : "POST",
// 			dataType : 'json',
// 			data : fd,
// 			contentType : false,
// 			processData : false,
// 			success : function(data) {

// 				if (data.type == "error") {
// 					$("#btnUpload").show();
// 					$("#loader-icon").hide();
// 					$("#phppot-message").addClass("error");
// 					$("#phppot-message").text(data.error_message);
//                     toastr.success(data.error_message);
// 				} else if (data.type == "success") {
// 					var type_id = $("#course_type").val();
//                     var myArray = type_id;
//                     if ($.inArray("1", myArray) >= 0) {
//                         $("#v-pills-pricing-tab").prop("disabled", false);
//                         $("#v-pills-pricing-tab").removeClass("price_disable");
//                         $(".finishnext").show();
//                         $("#courseupdate_btn").hide();
//                     } else {
//                         $("#v-pills-pricing-tab").prop("disabled", false);
//                         $("#v-pills-pricing-tab").addClass("price_disable");
//                         $(".finishnext").hide();
//                         $("#courseupdate_btn").show();
//                         $(".pricenext").hide();
//                     }

//                     $("#iframe").hide();
// 					$("#btnUpload").show();
// 					$("#loader-icon").hide();
// 					// $("#phppot-message").addClass("success");
// 					// $("#phppot-message").text("Video uploaded. " + data.link);
//                      toastr.success("Upload successfully");

// 					let str=data.link;
// 					myArr = str.split("/");
// 					video_id=myArr[3];
//                     $('#url').val(data.link);



//                    // $("#load").attr("src","https://player.vimeo.com/video/"+video_id);  
// 					// var iframe = "<iframe />";
// 					// var id = $(this).attr('id'); // 
// 					// var url = "http://player.vimeo.com/video/" + video_id + "?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1";

// 					// var width = 700;
// 					// var height = 394;
// 					// var frameborder = 0;

// 					//  $(iframe, {
// 					// 	name: 'videoframe',
// 					// 	id: 'videoframe',
// 					// 	src: url,
// 					// 	width: width,
// 					// 	height: height,
// 					// 	frameborder: frameborder,
// 					// 	type: 'text/html',
// 					// 	allowfullscreen: true,
// 					// 	webkitAllowFullScreen: true,
// 					// 	mozallowfullscreen: true
// 					// }).css({'position': 'absolute', 'top': '0', 'left': '0'}).appendTo(this);

// 					// $(this).find('img').fadeOut(function() { $(this).remove();});
// 					// <iframe class="iframe"  src="https://player.vimeo.com/video/629870843?title=0&byline=0&portrait=0&sidedock=0" width="100%" height="430" frameborder="0" webkitallowfullscreen   mozallowfullscreen allowfullscreen> </iframe>
// 					// jQuery('#opened-video').html('<iframe id="video-iframe" src="https://player.vimeo.com/video/'+video_id+'?title=0&byline=0&portrait=0&sidedock=0" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');







// 				}
// 			}
// 		});
// 	});

// });

function handleFileSelect(evt) {
    evt.stopPropagation()
    evt.preventDefault()

    var files = evt.dataTransfer ? evt.dataTransfer.files : $(this).get(0).files
    updateProgress(0)
    document.getElementById('progress-container').style.display = 'block';
    $(".btnNext").hide();
    $('#coursesave_btn').hide();
    $("#v-pills-pricing-tab").prop("disabled", true);
    $("#v-pills-pricing-tab").addClass("price_disable");
    var video_name = $("#name").val();
    var description = $("#description").val();

    /* Instantiate Vimeo Uploader */
    (new VimeoUpload({
        name: video_name,
        description: description,
        file: $(".fileuploader")[0].files[0],
        token: '9934bd59f90bb90c5b4b3526cdfa78c9',
        onError: function(data) {
            showMessage(JSON.parse(data).error, 'error');
        },
        onProgress: function(data) {
            updateProgress(data.loaded / data.total)
        },
        onComplete: function(videoId, index) {
            var url = 'https://vimeo.com/' + videoId
            $('#url').val(url);
            var type_id = $("#course_type").val();
            document.getElementById('trailervideo_delete_content').style.display = 'block';

            if (type_id == 2 || type_id == 3 || type_id == 4) {


                $("#v-pills-pricing-tab").prop("disabled", true);
                $('.btnNext').hide();
                $('#coursesave_btn').show();
                $("#v-pills-pricing-tab").addClass("price_disable");
            } else {


                $("#v-pills-pricing-tab").prop("disabled", false);
                $("#v-pills-pricing-tab").removeClass("price_disable");
                $('.btnNext').show();
                $('.finishoff').hide();
            }

            showMessage("Promotional video uploaded successfully", 'success');

        }
    })).upload()

    /* local function: show a user message */
    function showMessage(html, type) {
        /* hide progress bar */
        document.getElementById('progress-container').style.display = 'none'
        toastr.success(html);
    }
}



/**
 * Updat progress bar.
 */
function updateProgress(progress) {
    progress = Math.floor(progress * 100)
    var element = document.getElementById('progress')
    element.setAttribute('style', 'width:' + progress + '%')
    element.innerHTML = '&nbsp;' + progress + '%'
}
/**
 * Wire up drag & drop listeners once page loads
 */
document.addEventListener('DOMContentLoaded', function() {
    var browse = document.getElementById('pro_url')
    browse.addEventListener('change', handleFileSelect, false)
});


function cancel_trailer_video() {
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var vurl = $('#url').val();
    var vID = vurl.split('/');
    var videoID = vID[3];
    var url = $("#base_url").val();
    var enterprise_shortname = $("#enterprise_shortname").val();
    var r = confirm("Are you sure?");
    if (r == true) {
        $.ajax({
            url: url + enterprise_shortname + "/instructor-delete-video",
            type: "POST",
            data: {
                video_id: videoID,
                csrf_test_name: csrf_test_name
            },
            success: function(data) {
                toastr.success(data);
                document.getElementById('trailervideo_delete_content').style.display = 'none';
                $('#url').val('');

            },
            error: function(xhr) {
                alert('failed!');
            }
        });
    }
}

$(document).ready(function($) {

    // Once something is selected the change function will run
    $('.fileuploader').change(function() {

        $('.videopreview').html('<video  src="' + URL.createObjectURL(this.files[0]) +
            '" controls></video>');


    });
});
</script>