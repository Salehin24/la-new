<style>
.card-hd-bg {
    background-color: #ddd;
}

.card-hd-bg button {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.btn-pointer {
    display: block;
    width: 100%;
    text-align: left;
    font-weight: 600;
    text-transform: capitalize;
    text-decoration: none;
}

.btn-pointer i {
    transform: rotate(-180deg);
    transition-duration: 0.5s;
}

.btn-pointer.collapsed i {
    transform: rotate(0deg);
}

.btn-link.focus,
.btn-link:focus {
    text-decoration: underline;
    outline: none;
    box-shadow: none;
}

.btn-link:focus,
.btn-link:hover {
    text-decoration: none;
}

.qst-title {
    font-size: 17px;
    background: #ddd;
    font-weight: 600;
    line-height: 45px;
    margin-bottom: 25px;
}

.card {
    border: 1px solid #ddd;
}

.card-header {
    padding: 0.75rem 1.25rem;
}
</style>
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body">
                <div class="row">
                    <?php //d($course_info); ?>
                    <div class="col-xl-12 px-2 px-sm-4">
                        <div>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-unstyled">
                                        <li class="d-flex">
                                            <span class="fs-6 fw-semi-bold d-md-inline-block d-block w-25 pr-3">Course
                                                Title : </span>
                                            <strong class="w-75"><?php echo $course_info->name ?></strong>
                                        </li>
                                        <li class="d-flex">
                                            <span class="fs-6 fw-semi-bold d-md-inline-block d-block w-25 pr-3">About
                                                This Course:</span>
                                            <span class="w-75"><?php echo $course_info->description ?></span>
                                        </li>
                                        <li class="d-flex">
                                            <span class="fs-6 fw-semi-bold d-md-inline-block d-block w-25 pr-3">What
                                                students will learn : </span>
                                            <span class="w-25">
                                                <?php
                                                $benefits = ($course_info->benifits != '[""]' ? json_decode($course_info->benifits) : '');
                                                if ($benefits) {
                                                    $g = 0;
                                                    foreach ($benefits as $gain) {
                                                        $g++;
                                                        ?>
                                                <strong> <?php echo $g . '. ' . $gain; ?></strong><br>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </span>
                                        </li>
                                        <li class="d-flex">
                                            <span class="fs-6 fw-semi-bold d-md-inline-block d-block w-25 pr-3">What
                                                students need or require to learn this course? : </span><span>

                                                <?php $courserequirements = ($course_info->requirements != '[""]' ? json_decode($course_info->requirements) : '') ?>
                                                <?php
                                                if ($courserequirements) {
                                                    $re = 0;
                                                    foreach ($courserequirements as $requirements) {
                                                        $re++;
                                                        ?>
                                                <strong> <?php echo $re . '. ' . $requirements; ?></strong><br>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </span>
                                        </li>
                                        <li class="d-flex">
                                            <span class="fs-6 fw-semi-bold d-md-inline-block d-block  w-25 pr-3">Course
                                                Contents / Material:</span>
                                            <span><?php echo $course_info->course_material; ?></span>
                                        </li>
                                        <li class="d-flex"><span
                                                class="fs-6 fw-semi-bold d-md-inline-block d-block w-25 pr-3">Course
                                                Result:</span><span><?php echo $course_info->course_result ?></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-12">
                                    <ul class="list-unstyled">
                                        <li class="d-flex">
                                            <span
                                                class="fs-6 fw-semi-bold d-md-inline-block d-block w-25 pr-3">Category:</span><span><?php echo $categoryname; ?></span>
                                        </li>
                                        <li class="d-flex"><span
                                                class="fs-6 fw-semi-bold d-md-inline-block d-block w-25 pr-3">Sub
                                                Category:</span><span><?php echo $subcategoryname; ?></span>
                                        </li>
                                        <li class="d-flex"><span
                                                class="fs-6 fw-semi-bold d-md-inline-block d-block w-25 pr-3">Course
                                                Level:</span><span><?php
                                                if ($course_info->course_level == 1) {
                                                    echo 'Beginner Level';
                                                }
                                                ?><?php
                                                if ($course_info->course_level == 2) {
                                                    echo 'Intermediate';
                                                }
                                                ?><?php
                                                if ($course_info->course_level == 3) {
                                                    echo 'Advanced';
                                                }
                                                ?></span>
                                        </li>
                                        <li class="d-flex"><span
                                                class="fs-6 fw-semi-bold d-md-inline-block d-block w-25 pr-3">What
                                                skills student will gain:</span><span>
                                                <?php
                                                $career_outcomes = json_decode($course_info->career_outcomes);
                                                if ($career_outcomes) {
                                                    $o = 0;
                                                    foreach ($career_outcomes as $outcome) {
                                                        $o++;
                                                        if($outcome){
                                                            echo '<strong>' . $o . ' . ' . $outcome . ' </strong><br> ';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </span>
                                        </li>
                                        <li class="d-flex"><span
                                                class="fs-6 fw-semi-bold d-md-inline-block d-block w-25 pr-3">Related
                                                Resources:</span>
                                            <span>
                                                <?php
                                                $related_resource = json_decode($course_info->related_resource);
                                                if ($related_resource) {
                                                    $r = 0;
                                                    foreach ($related_resource as $resource) {
                                                        $r++;
                                                        if($resource){
                                                            echo '<strong>' . $r . ' . ' . $resource . ' </strong><br> ';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <?php //d($course_info);  ?>
                                <div class="col-md-12">
                                    <div class="row align-items-center mb-4">
                                        <div class="col-md-12">
                                            <?php
                                            $urldata = $course_info->url;
                                            $ddd = explode('/', $urldata);
                                            ?>
                                            <p>Course Promotional Video Trailer</p>
                                            <div class="">
                                                <div class="ratio ratio-16x9 video-upload">
                                                    <?php if ($course_info->url) { ?>
                                                    <iframe id="iframe"
                                                        src="https://player.vimeo.com/video/<?php echo (!empty($ddd[3]) ? $ddd[3] : ''); ?>"
                                                        width="100%" height="576" frameborder="0" allowfullscreen
                                                        allow="autoplay; encrypted-media"></iframe>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <?php //d($course_info);   ?>
                                <div class="col-md-12">
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <p>Course Mini Thumbnail Hover</p>
                                            <div class="">
                                                <div class="ratio ratio-16x9 img-upload2">
                                                    <img src="<?php echo base_url($course_info->hover_thumbnail) ?>"
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <p>Course Mini Thumbnail</p>
                                            <div class="">
                                                <div class="ratio ratio-16x9 img-upload">
                                                    <img
                                                        src="<?php echo base_url(($course_miniimg ? $course_miniimg->picture : '')) ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div>
                            <h5 class="mb-2 fw-semi-bold">Course Curriculumn and Lessons</h5>
                            <p>Here's where you add course content like course sections, lessons, assignments and more
                            </p>
                            <?php
                            if ($chapter_list) {
                                $chpter_no = 1;
                                foreach ($chapter_list as $chapters) {
                                    $chapter_lesson = $this->Instructor_model->chapter_lessonLIst($course_info->course_id, $chapters->section_id);
                                    $chatperquizes = $this->Instructor_model->course_quizes($course_info->course_id, $chapters->section_id);
                                    $chapter_assign_projects = $this->Instructor_model->chapter_assign_projects($course_info->course_id, $chapters->section_id);
                                    ?>
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header card-hd-bg" id="sec-heading-<?php echo $chpter_no; ?>">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link btn-pointer text-dark" data-toggle="collapse"
                                                data-target="#sec-collapse-<?php echo $chpter_no; ?>"
                                                aria-expanded="true"
                                                aria-controls="sec-collapse-<?php echo $chpter_no; ?>">
                                                <span><?php echo $chapters->section_name ?></span>
                                                <i class="ti-angle-down"></i>
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="sec-collapse-<?php echo $chpter_no; ?>" class="collapse show"
                                        aria-labelledby="sec-heading-<?php echo $chpter_no; ?>"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            <?php if ($chapter_lesson) { ?>
                                            <?php
                                                        $lesson_no = 1;
                                                        foreach ($chapter_lesson as $lessons) {
                                                            $lesson_attachment = $this->Instructor_model->course_image($lessons->lesson_id);
                                                            $attach_img = ($lesson_attachment ? $lesson_attachment->picture : '');
                                                            ?>
                                            <div id="lesson_accordion_<?php echo $chpter_no . '-' . $lesson_no; ?>">
                                                <div class="card mb-3">
                                                    <div class="card-header card-hd-bg">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link btn-pointer text-dark collapsed"
                                                                data-toggle="collapse"
                                                                data-target="#lesson_accor_<?php echo $chpter_no . '-' . $lesson_no; ?>"
                                                                aria-expanded="true"
                                                                aria-controls="lesson_accor_<?php echo $chpter_no . '-' . $lesson_no; ?>">
                                                                <span><?php echo $lessons->lesson_name; ?></span>
                                                                <i class="ti-angle-down"></i>
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="lesson_accor_<?php echo $chpter_no . '-' . $lesson_no; ?>"
                                                        class="collapse " aria-labelledby="headingOne"
                                                        data-parent="#lesson_accordion_<?php echo $chpter_no . '-' . $lesson_no; ?>">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <span
                                                                    class="fs-6 fw-semi-bold d-md-inline-block d-block w-25 pr-3">Lesson
                                                                    Nmae : </span>
                                                                <div class="w-75"><?php echo $lessons->lesson_name ?>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <span
                                                                    class="fs-6 fw-semi-bold d-md-inline-block d-block w-25 pr-3">Lesson
                                                                    Type : </span>
                                                                <div class="w-75">
                                                                    <?php echo ($lessons->lesson_type == 1 ? 'Video' : '') ?>
                                                                    <?php echo ($lessons->lesson_type == 2 ? 'Text file' : '') ?>
                                                                    <?php echo ($lessons->lesson_type == 3 ? 'Picture' : '') ?>
                                                                    <?php echo ($lessons->lesson_type == 4 ? 'PPtx' : '') ?>
                                                                    <?php echo ($lessons->lesson_type == 5 ? 'pdf' : '') ?>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <span
                                                                    class="fs-6 fw-semi-bold d-md-inline-block d-block w-25 pr-3">Description
                                                                    : </span>
                                                                <strong
                                                                    class="w-75"><?php echo $lessons->description; ?></strong>
                                                            </div>
                                                            <div class="row">
                                                                <?php if ($lessons->lesson_provider == 1 || $lessons->lesson_provider == 2) { ?>
                                                                <label for='lesson_provider' class='w-25'>Lesson
                                                                    Provider : </label>
                                                                <div class='w-75'>
                                                                    <span>
                                                                        <?php echo ($lessons->lesson_provider == 1 ? 'Youtube' : '') ?>
                                                                        <?php echo ($lessons->lesson_provider == 2 ? 'Vimeo' : '') ?>
                                                                    </span>
                                                                </div>
                                                                <?php } else { ?>
                                                                <label for='attachment' class='w-25'>Attachment :
                                                                </label>
                                                                <div class='w-75'>
                                                                    <?php if ($lessons->lesson_type == 3) { ?>
                                                                    <img src="<?php echo base_url($attach_img); ?>">
                                                                    <?php } ?>
                                                                    <?php if ($lessons->lesson_type == 2 || $lessons->lesson_type == 4 || $lessons->lesson_type == 5) { ?>
                                                                    <a href="<?php echo base_url(($lesson_attachment ? $lesson_attachment->picture : '')); ?>"
                                                                        target="_new">
                                                                        <i class="fas fa-book-open"></i>
                                                                    </a>
                                                                    <?php } ?>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="row">
                                                                <?php if ($lessons->lesson_provider == 1 || $lessons->lesson_provider == 2) { ?>
                                                                <?php
                                                                                    if ($lessons->provider_url) {
                                                                                        $vimeprovider_url = $lessons->provider_url;
                                                                                        $vimeo_url = explode('/', $vimeprovider_url);
                                                                                        ?>
                                                                <label for='provider_url' class='w-25'>Provider
                                                                    URL</label>
                                                                <div class='w-75'>
                                                                    <iframe id="iframe"
                                                                        src="https://player.vimeo.com/video/<?php echo (!empty($vimeo_url[3]) ? $vimeo_url[3] : ''); ?>"
                                                                        width="500" height="360" frameborder="0"
                                                                        allowfullscreen
                                                                        allow="autoplay; encrypted-media"></iframe>
                                                                </div>
                                                                <?php } ?>
                                                            </div>

                                                            <div class='row'>
                                                                <label for='duration' class='w-25'>Duration : </label>
                                                                <div class='w-75'>
                                                                    <span><?php echo $lessons->duration ?></span>
                                                                </div>
                                                            </div>
                                                            <div class='row'>
                                                                <label class='w-25'>Is Preview : </label>
                                                                <div class='w-75'>
                                                                    <span>
                                                                        <?php echo ($lessons->is_preview == 1 ? 'Yes' : 'No') ?></span>
                                                                </div>
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                            $lesson_no++;
                                                        }
                                                        ?>
                                            <?php } ?>


                                            <!-- ================ new quiz start =============== -->
                                            <?php if ($chatperquizes) { ?>
                                            <?php
                                                        $quiz_no = 1;
                                                        foreach ($chatperquizes as $quizes) {
                                                            $quiz_ques = $this->Instructor_model->quiz_questions($quizes->exam_id);
                                                            ?>
                                            <div id="quiz_accordion_<?php echo $chpter_no . '-' . $quiz_no; ?>">
                                                <div class="card mb-3">
                                                    <div class="card-header card-hd-bg">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link btn-pointer text-dark collapsed"
                                                                data-toggle="collapse"
                                                                data-target="#quiz_accor_<?php echo $chpter_no . '-' . $quiz_no; ?>"
                                                                aria-expanded="true"
                                                                aria-controls="quiz_accor_<?php echo $chpter_no . '-' . $quiz_no; ?>">
                                                                <span><?php echo $quizes->name ?></span>
                                                                <i class="ti-angle-down"></i>
                                                            </button>
                                                        </h5>
                                                    </div>

                                                    <div id="quiz_accor_<?php echo $chpter_no . '-' . $quiz_no; ?>"
                                                        class="collapse " aria-labelledby="headingOne"
                                                        data-parent="#quiz_accordion_<?php echo $chpter_no . '-' . $quiz_no; ?>">
                                                        <div class="card-body">
                                                            <div class="row mx-0">
                                                                <label class="mb-2 mb-md-0 w-25">Quiz-Title :</label>
                                                                <div class="w-75"><?php echo $quizes->name ?></div>
                                                            </div>

                                                            <div class="mb-3 row mx-0">
                                                                <label class="w-25">Duration :</label>
                                                                <div class="w-75"><?php echo $quizes->duration; ?>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row mx-0">
                                                                <label class="w-25">Pass Score :</label>
                                                                <div class="w-75">
                                                                    <span><?php echo $quizes->pass_mark; ?></span>
                                                                </div>
                                                            </div>

                                                            <div
                                                                id="questionSection_<?php echo $chpter_no ?>_<?php echo $quiz_no ?>">
                                                                <?php
                                                                                if ($quiz_ques) {
                                                                                    $ques_no = 1;
                                                                                    foreach ($quiz_ques as $questions) {
                                                                                        ?>
                                                                <div class="mb-3">
                                                                    <div class="questionSection_<?php echo $chpter_no ?>_<?php echo $quiz_no ?>"
                                                                        id="individual_question_<?php echo $chpter_no ?>_<?php echo $quiz_no ?>_<?php echo $ques_no ?>">
                                                                        <div class="text-center">
                                                                            <h4 class="qst-title">Question No
                                                                                <?php echo $ques_no ?></h4>
                                                                        </div>
                                                                        <div>

                                                                            <div class="mb-3 row mx-0">
                                                                                <label for="question_type"
                                                                                    class="w-25">Question Type : <i
                                                                                        class="text-danger">
                                                                                    </i></label>
                                                                                <div class="w-75">
                                                                                    <span><?php echo ($questions->question_type == 1 ? 'Radio(True/False)' : '') ?>
                                                                                        <?php echo ($questions->question_type == 2 ? 'Checkbox(Multiple)' : '') ?>
                                                                                        <?php echo ($questions->question_type == 3 ? 'Short Answer' : '') ?>
                                                                                    </span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="mb-3 row mx-0">
                                                                                <label for="question"
                                                                                    class="w-25">Question
                                                                                    : </label>
                                                                                <div class="w-75">
                                                                                    <span><?php echo $questions->name ?></span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div
                                                                                    class="loaddata_<?php echo $chpter_no ?>_<?php echo $quiz_no ?>_<?php echo $ques_no ?> col-sm-12 w-100p">
                                                                                    <?php if ($questions->question_type == 1 || $questions->question_type == 2) { ?>
                                                                                    <div class="table-responsive">
                                                                                        <input type="hidden"
                                                                                            name="shortanswer<?php echo $chpter_no ?><?php echo $quiz_no ?>[]"
                                                                                            id="shortanswer"
                                                                                            class="form-control shortanswer">
                                                                                        <table
                                                                                            class="table table-bordered"
                                                                                            id="quesOptionTable<?php echo $chpter_no ?>_<?php echo $quiz_no ?>_<?php echo $ques_no ?>">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th width="50%"
                                                                                                        class="text-left">
                                                                                                        Option
                                                                                                    </th>
                                                                                                    <th width="30%"
                                                                                                        class="text-left">
                                                                                                        Is
                                                                                                        Answer
                                                                                                    </th>

                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody
                                                                                                id="addrowItem_<?php echo $chpter_no ?>_<?php echo $quiz_no ?>_<?php echo $ques_no ?>">
                                                                                                <?php $question_options = $this->Instructor_model->get_question_options($questions->question_id); ?>
                                                                                                <?php
                                                                                                                                if ($question_options) {
                                                                                                                                    $option = 1;
                                                                                                                                    foreach ($question_options as $options) {
                                                                                                                                        ?>
                                                                                                <tr>
                                                                                                    <td
                                                                                                        class="text-left">
                                                                                                        <?php echo $options->option_name ?>
                                                                                                    </td>
                                                                                                    <td
                                                                                                        class="text-left">
                                                                                                        <div
                                                                                                            class="offset-2 checkbox checkbox-success">
                                                                                                            <?php echo ($options->is_answer == 1 ? 'Yes' : 'No') ?>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <?php
                                                                                                                                    $option++;
                                                                                                                                }
                                                                                                                            }
                                                                                                                            ?>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                            <hr />
                                                                            <div class="mb-3 row mx-0">
                                                                                <label for="correctAnsExplan"
                                                                                    class="w-25">Correct Answer
                                                                                    Explanation</label>
                                                                                <div class="w-75">
                                                                                    <span><?php echo $questions->correct_ans_explanation ?></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3 row mx-0">
                                                                                <label for="QuestionMarks"
                                                                                    class="w-25">Question Marks :
                                                                                </label>
                                                                                <div class="w-75">
                                                                                    <span><?php echo $questions->question_mark ?></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br />
                                                                <?php
                                                                                        $ques_no++;
                                                                                    }
                                                                                }
                                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                            $quiz_no++;
                                                        }
                                                        ?>
                                            <?php } ?>
                                            <!-- ================ new qiz close =============== -->




                                            <!-- ================ new assignment start =============== -->
                                            <?php if ($chapter_assign_projects) { ?>
                                            <?php
                                                        $project_no = 1;
                                                        foreach ($chapter_assign_projects as $projects) {
                                                            $distributed_marks = $this->Instructor_model->project_distributed_marks($projects->assignment_id);
                                                            ?>
                                            <div
                                                id="assignment_accordion_<?php echo $chpter_no . '-' . $project_no; ?>">
                                                <div class="card mb-3">
                                                    <div class="card-header card-hd-bg">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link btn-pointer text-dark collapsed"
                                                                data-toggle="collapse"
                                                                data-target="#assignment_accor_<?php echo $chpter_no . '-' . $project_no; ?>"
                                                                aria-expanded="true"
                                                                aria-controls="assignment_accor_<?php echo $chpter_no . '-' . $project_no; ?>">
                                                                <span><?php echo $projects->title ?></span>
                                                                <i class="ti-angle-down"></i>
                                                            </button>
                                                        </h5>
                                                    </div>

                                                    <div id="assignment_accor_<?php echo $chpter_no . '-' . $project_no; ?>"
                                                        class="collapse " aria-labelledby="headingOne"
                                                        data-parent="#assignment_accordion_<?php echo $chpter_no . '-' . $project_no; ?>">
                                                        <div class="card-body">
                                                            <div class="mb-3">
                                                                <div class="row mx-0">
                                                                    <label for="project_title" class="w-25">Project
                                                                        Title :
                                                                    </label>
                                                                    <div class="w-75">
                                                                        <span><?php echo $projects->title ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="row mx-0">
                                                                    <label for="categoryProject" class="w-25">Category
                                                                        :</label>
                                                                    <div class="w-75">
                                                                        <span><?php echo ($projects->category == 1 ? 'Chapter Project' : '') ?><?php echo ($projects->category == 2 ? 'Final Project' : '') ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="mb-3">
                                                                                <div class="row">
                                                                            <?php if ($projects->category == 1) { ?>
                                                                                                                                                                                <label for="chapters" class="w-25">Chapter : </label>
                                                                                                                                                                                <div class="w-75">
                                                                                <?php echo (($projects->chapter_id == $assignchapter->section_id) ? $assignchapter->section_name : ''); ?>
                                                                                                                                                                                </div>
                                                                            <?php } ?>
                                                                                </div>
                                                                            </div> -->
                                                            <div class="mb-3">
                                                                <div class="row mx-0">
                                                                    <label for="categoryProject"
                                                                        class="w-25">Description
                                                                        :</label>
                                                                    <div class="w-75">
                                                                        <?php echo $projects->description ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row mx-0">
                                                                <label for="passScore2" class="w-25">Pass Score
                                                                    :</label>
                                                                <div class="w-75">
                                                                    <span><?php echo $projects->pass_score ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row mx-0">
                                                                <label for="QuestionMarks2" class="w-25">Project Marks :
                                                                </label>
                                                                <div class="w-75">
                                                                    <span><?php echo $projects->project_mark ?></span>
                                                                </div>
                                                            </div>
                                                            <table class="table table-bordered"
                                                                id="project_marks_distribution_tbl_<?php echo $chpter_no ?>_<?php echo $project_no ?>">
                                                                <thead class="bg-primary text-light">
                                                                    <tr>
                                                                        <th class="text-center">Marking Base</th>
                                                                        <th class="text-center">Mark Distribution
                                                                        </th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody
                                                                    id="markdistribute_tbl_body_<?php echo $chpter_no ?>_<?php echo $project_no ?>">
                                                                    <?php
                                                                                        if ($distributed_marks) {
                                                                                            $marks_sl = 1;
                                                                                            $total_marks = 0;
                                                                                            foreach ($distributed_marks as $dmarks) {
                                                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $dmarks->markes_title ?></td>
                                                                        <td class="text-center">
                                                                            <?php
                                                                                                    echo $dmarks->marks;
                                                                                                    $total_marks += $dmarks->marks;
                                                                                                    ?>
                                                                        </td>

                                                                    </tr>
                                                                    <?php
                                                                                            $marks_sl++;
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td class="text-right"><b>Total</b></td>
                                                                        <td class="text-center"
                                                                            id="sum_total_marks_<?php echo $chpter_no ?>_<?php echo $project_no ?>">
                                                                            <?php echo number_format($total_marks, 2) ?>
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                            <div class="mb-3 row mx-0">
                                                                <label for="QuestionMarks2" class="w-25">Tips : </label>
                                                                <div class="w-75">
                                                                    <span><?php echo $projects->tips ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row mx-0">
                                                                <label for="bitRefer" class="w-25">Reference : </label>
                                                                <div class="w-75">
                                                                    <span><?php echo $projects->project_reference ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                            $project_no++;
                                                        }
                                                        ?>
                                            <?php } ?>
                                            <!-- ================ new assignment close =============== -->



                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div><br>
                        <?php
                                $chpter_no++;
                            }
                        }
                        ?>


                    </div>



                    <div>
                        <h5>Pricing</h5>
                        <div class="row">
                            <div class="col-lg-12">
                                <?php $types = json_decode($course_info->course_type);
                                ?>
                                <div class="d-flex mb-2">

                                    <ul>
                                        <?php if (in_array(1, $types)) { ?>
                                        <li>
                                            <?php echo 'Purchase'; ?>
                                        </li>
                                        <?php } ?>
                                        <?php if (in_array(2, $types)) { ?>
                                        <li>
                                            <?php echo 'Subscription'; ?>
                                        </li>
                                        <?php } ?>
                                        <?php if (in_array(3, $types)) { ?>
                                        <li>
                                            <?php echo 'Free'; ?>
                                        </li>
                                        <?php } ?>
                                    </ul>

                                    <!--                                    <div class="form-check me-5">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                   value="<?php
                                    if (in_array(1, $types)) {
                                        echo 1;
                                    }
                                    ?>" id="purchasePricing"
                                                                                   name="course_types[]" <?php
                                    if (in_array(1, $types)) {
                                        echo 'checked';
                                    }
                                    ?>
                                                                                   readonly>
                                                                            <label class="form-check-label" for="purchasePricing"> Purchase
                                                                                &nbsp;</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                   value="<?php
                                    if (in_array(2, $types)) {
                                        echo 2;
                                    }
                                    ?>" id="subscriptionPricing"
                                                                                   name="course_types[]" <?php
                                    if (in_array(2, $types)) {
                                        echo 'checked';
                                    }
                                    ?>
                                                                                   readonly>
                                                                            <label class="form-check-label" for="subscriptionPricing"> Subscription
                                                                                &nbsp; &nbsp; </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                   value="<?php
                                    if (in_array(3, $types)) {
                                        echo 3;
                                    }
                                    ?>" id="freePricing"
                                                                                   name="course_types[]" <?php
                                    if (in_array(3, $types)) {
                                        echo 'checked';
                                    }
                                    ?>
                                                                                   readonly>
                                                                            <label class="form-check-label" for="freePricing"> Free </label>
                                                                        </div>-->
                                </div>
                                <div class="row mx-0" id="priceContent" style="display: <?php
                                     if (in_array(1, $types)) {
                                         echo '';
                                     } else {
                                         echo 'none';
                                     }
                                     ?>">
                                    <?php if ($course_info->is_discount == 1) { ?>
                                    <div class="input-group mb-2">
                                        <span class="w-25"> Base Price : </span>
                                        <span class="w-75"><?php echo $course_info->oldprice ?> BDT</span>
                                    </div>
                                    <div class="input-group mb-2">
                                        <span class="w-25"> Discount Type : </span>
                                        <span class="w-75"><?php
                                                if ($course_info->discount_type == 1) {
                                                    echo 'Fixed';
                                                } elseif ($course_info->discount_type == 2) {
                                                    echo 'Percent';
                                                }
                                                ?>
                                    </div>
                                    <div class="input-group mb-2">
                                        <span class="w-25"> Discount : </span>
                                        <span class="w-75"><?php echo $course_info->discount; ?></span>
                                    </div>
                                    <?php } ?>
                                    <div class="input-group mb-2">
                                        <span class="w-25"> Price : </span>
                                        <span class="w-75"><?php echo $course_info->price; ?></span>
                                    </div>
                                </div>
                                <!--                                <div class="d-flex mb-3">
                                                                    <div class="form-check me-5">
                                                                        <input class="form-check-input" type="checkbox" value="" id="is_offer"
                                                                               name="is_offer" <?php echo ($course_info->is_offer == 1 ? 'checked' : '') ?>
                                                                               readonly>
                                                                        <label class="form-check-label" for="is_offer">
                                                                            Is Offer?
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="row" id="offer_coursediv"
                                                                     style="display: <?php echo ($course_info->is_offer == 1 ? 'block' : 'none') ?>;">
                                                                    <div class="col-md-12 mb-3">
                                                                        <div class="d-md-flex align-items-center">
                                                                            <label for="offer_course" class="col-md-4 mb-2 mb-md-0">Select Offer
                                                                                Courses :</label>
                                                                            <div class="col-md-8">
                                                                                <span><?php echo ($offer_courses ? implode(',', $offer_courses) : '') ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="d-md-flex align-items-center">
                                                                            <label for="offer_price" class="col-md-4 mb-2 mb-md-0">Price With
                                                                                Offer :</label>
                                                                            <div class="col-md-8">
                                                                                <span><?php echo $course_info->offer_courseprice ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                            </div>
                        </div>

                    </div>

                </div>
                
            </div>
        </div>
    </div>
</div>