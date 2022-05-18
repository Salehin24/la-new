<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12 px-2 px-sm-4">
                        <form method="post">

                            <div>
                                <div class="row">
                                    <!-- <div class="col-md-12">
                                        <ul class="list-unstyled">
                                            <li class="d-flex"><span
                                                    class="fs-6 fw-semi-bold w-50 d-md-inline-block d-block">Course
                                                    Title:</span><span><?php echo $course_info->name?></span></li>
                                            <li class="d-flex"><span
                                                    class="fs-6 fw-semi-bold w-50 d-md-inline-block d-block">About This
                                                    Course:</span><span><?php echo $course_info->description?></span>
                                            </li>
                                            <li class="d-flex"><span
                                                    class="fs-6 fw-semi-bold w-50 d-md-inline-block d-block">What
                                                    students will learn:</span><span>
                                                    <ul class="list-inline"><?php 
												$benefits = ($course_info->benifits != '[""]'?json_decode($course_info->benifits):'');
												if($benefits){
                                         
                                          foreach($benefits as $gain){?>
                                                        <li class="list-inline-item"><?php echo $gain;?>,</li>
                                                        <?php }}?>
                                                    </ul>
                                                </span></li>
                                            <li class="d-flex"><span
                                                    class="fs-6 fw-semi-bold w-50 d-md-inline-block d-block">What
                                                    students need or require to learn this course?:</span><span>
                                                    <ul class="list-inline">
                                                        <?php $courserequirements = ($course_info->requirements != '[""]'?json_decode($course_info->requirements):'')?>
                                                        <?php if($courserequirements){
                                         
                                          foreach($courserequirements as $requirements){?>
                                                        <li class="list-inline-item"><?php echo $requirements;?>,</li>
                                                        <?php }
                                                    }
                                                    ?>
                                                    </ul>
                                                </span></li>
                                        </ul>
                                    </div> -->
                                    <!-- <div class="col-md-12">
                                        <ul class="list-unstyled">
                                            <li class="d-flex"><span
                                                    class="fs-6 fw-semi-bold w-50 d-md-inline-block d-block">Category:</span><span><?php echo $course_info->category_name?></span>
                                            </li>
                                            <li class="d-flex"><span
                                                    class="fs-6 fw-semi-bold w-50 d-md-inline-block d-block">Sub
                                                    Category:</span><span><?php echo ($course_info->subcategory_id?$course_info->sub_category:'')?></span>
                                            </li>
                                            <li class="d-flex"><span
                                                    class="fs-6 fw-semi-bold w-50 d-md-inline-block d-block">Course
                                                    Level:</span><span><?php if($course_info->course_level == 1){echo 'Beginner Level';}?><?php if($course_info->course_level == 2){echo 'Intermediate';}?><?php if($course_info->course_level == 3){echo 'Advanced';}?></span>
                                            </li>

                                            <li class="d-flex"><span
                                                    class="fs-6 fw-semi-bold w-50 d-md-inline-block d-block">What skills
                                                    student will gain:</span><span>
                                                    <?php 
                                                        // echo $course_info->career_outcomes;
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
                                                    class="fs-6 fw-semi-bold w-50 d-md-inline-block d-block">Related
                                                    Resources:</span><span>
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
                                    </div> -->
                                    <div class="col-md-12">

                                        <div class="row align-items-center mb-4">
                                            <div class="col-md-12">
                                                <?php
                                                    $urldata=$course_info->url;
                                                    $ddd= explode('/',$urldata); 
                                                    ?>
                                                <p>Course Promotional Video Trailer</p>
                                                <div class="border">
                                                    <div class="ratio ratio-16x9 video-upload">
                                                        <?php if($course_info->url){?>
                                                        <iframe id="iframe"
                                                            src="https://player.vimeo.com/video/<?php echo (!empty($ddd[3]) ? $ddd[3] : ''); ?>"
                                                            width="640" height="360" frameborder="0" allowfullscreen
                                                            allow="autoplay; encrypted-media"></iframe>

                                                        <?php }?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12">

                                        <div class="row align-items-center mb-4">
                                            <div class="col-md-6">
                                                <p>Course Mini Thumbnail</p>
                                                <div class="border">
                                                    <div class="ratio ratio-16x9 img-upload">
                                                        <img
                                                            src="<?php echo base_url(($course_miniimg?$course_miniimg->picture:''))?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Course Mini Thumbnail Hover</p>
                                                <div class="border">
                                                    <div class="ratio ratio-16x9 img-upload2">
                                                        <img src="<?php echo base_url($course_info->hover_thumbnail)?>"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div>

                                <h5 class="mb-2 fw-semi-bold">Course Curriculumn and Lessons</h5>
                                <p>Here's where you add course content like course sections, lessons, assignments and
                                    more</p>

                                <div class="accordion mb-4" id="accordionClass">
                                    <input type="hidden" id="number_of_chpater"
                                        value="<?php if(!empty($chapter_list)){echo count($chapter_list);}?>">
                                    <?php if($chapter_list){
                              $chpter_no = 1;
                              foreach($chapter_list as $chapters){
                              	$chapter_lesson = $this->Instructor_model->chapter_lessonLIst($course_info->course_id,$chapters->section_id);
                              	$chatperquizes = $this->Instructor_model->course_quizes($course_info->course_id,$chapters->section_id);
                               $chapter_assign_projects = $this->Instructor_model->chapter_assign_projects($course_info->course_id,$chapters->section_id);	  
                              ?>
                                    <div class="accordion-item mb-4">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#panelsStayOpen-collapsechap<?php echo $chpter_no?>"
                                                aria-expanded="true"
                                                aria-controls="panelsStayOpen-collapsechap<?php echo $chpter_no?>">
                                                Chapter : <?php echo $chpter_no?>
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapsechap<?php echo $chpter_no?>"
                                            class="accordion-collapse collapse show"
                                            aria-labelledby="panelsStayOpen-headingchap<?php echo $chpter_no?>">
                                            <div class="accordion-body p-xl-5">
                                                <div class="row g-3 mb-4">
                                                    <div class="col-md-7">
                                                        <div class="d-md-flex align-items-center">
                                                            <label for="chapter_title"
                                                                class="col-md-3 mb-2 mb-md-0">Chapter Title</label>
                                                            <span><?php echo $chapters->section_name?></span>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div id="lessoncontent_<?php echo $chpter_no?>">
                                                <?php if($chapter_lesson){
                                          $lesson_no = 1;
                                          foreach($chapter_lesson as $lessons){
                                          $lesson_attachment = $this->Instructor_model->course_image($lessons->lesson_id);
                                          $attach_img = ($lesson_attachment?$lesson_attachment->picture:'');		
                                          ?>
                                                    <div class="accordion-item mb-4 border-top"
                                                        id="lessondiv<?php echo $chpter_no?>_<?php echo $lesson_no?>">
                                                        <h2 class="accordion-header"
                                                            id="chapterlesson<?php echo $chpter_no?>_<?php echo $lesson_no?>">
                                                            <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#lessondivopen<?php echo $chpter_no?>_<?php echo $lesson_no?>"
                                                                aria-expanded="false"
                                                                aria-controls="lessondivopen<?php echo $chpter_no?>_<?php echo $lesson_no?>">Lesson
                                                                <?php echo $lesson_no?></button>
                                                        </h2>
                                                        <div id="lessondivopen<?php echo $chpter_no?>_<?php echo $lesson_no?>"
                                                            class="accordion-collapse collapse show"
                                                            aria-labelledby="chapterlesson<?php echo $chpter_no?>_<?php echo $lesson_no?>">
                                                            <div class="element">
                                                                <div class="p-xl-5 p-3 border position-relative">

                                                                    <div class="form-group row">
                                                                        <label for="QuiName2"
                                                                            class="col-md-3 mb-2 mb-md-0">Lesson
                                                                            Name</label>
                                                                        <div class="col-md-8">
                                                                            <span><?php echo $lessons->lesson_name?></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3"><label for="lessonDescription"
                                                                            class="form-label">Description</label><span><?php echo $lessons->description?></span>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="lesson_type"
                                                                            class="col-sm-3 col-form-label">Lesson
                                                                            type<i class="text-danger"> </i></label>
                                                                        <div class="col-sm-8">
                                                                            <span><?php echo ($lessons->lesson_type == 1?'Video':'')?>
                                                                                <?php echo ($lessons->lesson_type == 2?'Doc file':'')?>
                                                                                <?php echo ($lessons->lesson_type == 3?'Picture':'')?>
                                                                                <?php echo ($lessons->lesson_type == 4?'PPtx':'')?>
                                                                                <?php echo ($lessons->lesson_type == 5?'pdf':'')?>
                                                                            </span>

                                                                        </div>
                                                                    </div>
                                                                    <br />
                                                                    <div class="form-group"
                                                                        id="lessonshow_<?php echo $chpter_no?>_<?php echo $lesson_no?>">
                                                                        <?php if ($lessons->lesson_provider == 1 || $lessons->lesson_provider == 2) { ?>
                                                                        <label for='lesson_provider'
                                                                            class='col-sm-3 col-form-label'>Lesson
                                                                            Provider</label>
                                                                        <div class='col-sm-8'>
                                                                            <span>
                                                                                <?php echo ($lessons->lesson_provider == 1?'Youtube':'')?>
                                                                                <?php echo ($lessons->lesson_provider == 2?'Vimeo':'')?>

                                                                            </span>

                                                                        </div>
                                                                          <?php }else{ 
                                                                            // $ext = pathinfo( $attach_img, PATHINFO_EXTENSION);
                                                                        $lessonfiles = explode('-f-', $attach_img);

                                                                           if($lessons->lesson_type==2){?>
                                                                        <i class="far fa-file-word fs-2 m-1"></i>
                                                                        <?php echo $lessonfiles[1];?>
                                                                        <?php }elseif($lessons->lesson_type==4){?>
                                                                            <i class="fas fa-file-powerpoint"></i>
                                                                            <?php echo $lessonfiles[1];?>
                                                                        <?php }elseif($lessons->lesson_type==5){?>
                                                                            <i class="far fa-file-pdf"></i>
                                                                            <?php echo $lessonfiles[1];?>
                                                                        <?php }else{?>
                                                                        <label for='attachment'
                                                                            class='col-sm-3 col-form-label'>Attachment</label>
                                                                        <div class='col-sm-8'>
                                                                           <!-- File Name: <?php echo $lessonfiles[1];?> -->
                                                                          

                                                                            <?php 
                                                                              $multiple_image= $this->db->select("*")->from("picture_tbl")->where('from_id',$lessons->lesson_id)->get()->result();
                                                                              $m=1;
                                                                              foreach($multiple_image as $multipleImage){
                                                                            ?>  
                                                                            <?php //echo $multipleImage->picture;  
                                                                                    $multifilename = explode('-f-', $multipleImage->picture);
                                                                                     echo 'File Name: '.$multifilename[1]."<br>";

                                                                                    ?>
                                                                                      <img src="<?php echo base_url($multipleImage->picture)?>"
                                                                                width="100%">

                                                                            <?php }?>
                                                                        </div>
                                                                        <?php } }?>
                                                                    </div>
                                                                    <br />
                                                                    <div class=""
                                                                        id="providershow_<?php echo $chpter_no?>_<?php echo $lesson_no?>">
                                                                        <?php if($lessons->lesson_provider == 1 || $lessons->lesson_provider == 2){?>
                                                                        <?php
                                                                            if($lessons->provider_url){
                                                                                $vimeprovider_url=$lessons->provider_url;
                                                                                $vimeo_url= explode('/',$vimeprovider_url); 
                                                                                
                                                                        ?>
                                                                        <div class='form-group row'>
                                                                            <label for='provider_url'
                                                                                class='col-sm-3 col-form-label'>Provider
                                                                                URL</label>
                                                                            <div class='col-sm-8'>
                                                                                <iframe id="iframe"
                                                                                    src="https://player.vimeo.com/video/<?php echo (!empty($vimeo_url[3])?$vimeo_url[3] : ''); ?>"
                                                                                    width="500" height="360"
                                                                                    frameborder="0" allowfullscreen
                                                                                    allow="autoplay; encrypted-media"></iframe>
                                                                            </div>
                                                                        </div>
                                                                        <?php }?>

                                                                        <div class='form-group row'>
                                                                            <label for='duration'
                                                                                class='col-sm-3 col-form-label'>Duration</label>
                                                                            <div class='col-sm-8'>
                                                                                <span><?php echo $lessons->duration?></span>

                                                                            </div>
                                                                        </div>
                                                                        <?php }?>
                                                                    </div>
                                                                    <br />
                                                                    <div class="form-group row">
                                                                        <div class="offset-3 checkbox checkbox-success">
                                                                            <input
                                                                                id="is_preview_<?php echo $chpter_no?>_<?php echo $lesson_no?>"
                                                                                type="checkbox" name="is_preview"
                                                                                value="1"
                                                                                <?php echo ($lessons->is_preview == 1?'checked':'')?> /><label
                                                                                for="is_preview" class="ms-1">Is
                                                                                Preview</label>

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $lesson_no++;}}?>
                                                    <?php if($chatperquizes){
                                          $quiz_no = 1;
                                          foreach($chatperquizes as $quizes){
                                          $quiz_ques = $this->Instructor_model->quiz_questions($quizes->exam_id);
                                          ?>
                                                    <div class="accordion-item mb-4 border-top"
                                                        id="quizdiv<?php echo $chpter_no?>_<?php echo $quiz_no?>">
                                                        <h2 class="accordion-header"
                                                            id="panelsStayOpen-heading<?php echo $chpter_no?>_<?php echo $quiz_no?>">
                                                            <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#panelsStayOpen-collapse<?php echo $chpter_no?>_<?php echo $quiz_no?>"
                                                                aria-expanded="false"
                                                                aria-controls="panelsStayOpen-collapse<?php echo $chpter_no?>_<?php echo $quiz_no?>">
                                                                Quiz <?php echo $quiz_no?>
                                                            </button>
                                                        </h2>
                                                        <div id="panelsStayOpen-collapse<?php echo $chpter_no?>_<?php echo $quiz_no?>"
                                                            class="accordion-collapse collapse show"
                                                            aria-labelledby="panelsStayOpen-heading<?php echo $chpter_no?>_<?php echo $quiz_no?>">
                                                            <div class="accordion-body p-3 p-xl-5">
                                                                <div class="p-3 p-xl-5 border mb-4 position-relative">

                                                                    <div class="row g-3 mb-3">
                                                                        <div class="col-md-7">
                                                                            <div class="d-md-flex align-items-center">
                                                                                <label
                                                                                    for="quiz_name_<?php echo $chpter_no?>"
                                                                                    class="col-md-3 mb-2 mb-md-0">Quiz-Title</label><span><?php echo $quizes->name?></span>
                                                                            </div>
                                                                        </div>


                                                                    </div>

                                                                    <div class="mb-3 row">
                                                                        <label
                                                                            for="quiz_duration_<?php echo $chpter_no?><?php echo $quiz_no?>"
                                                                            class="col-md-2 col-form-label">Duration</label>
                                                                        <div class="col-md-10">
                                                                            <span><?php echo $quizes->duration?></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 row">
                                                                        <label
                                                                            for="pass_scrore_<?php echo $chpter_no?><?php echo $quiz_no?>"
                                                                            class="col-md-2 col-form-label">Pass
                                                                            Score</label>
                                                                        <div class="col-md-10">
                                                                            <span><?php echo $quizes->pass_mark?></span>
                                                                        </div>
                                                                    </div>

                                                                    <div
                                                                        id="questionSection_<?php echo $chpter_no?>_<?php echo $quiz_no?>">
                                                                        <?php if($quiz_ques){
                                                         $ques_no = 1;
                                                         foreach($quiz_ques as $questions){
                                                         ?>
                                                                        <div class="mb-3">
                                                                            <div class="questionSection_<?php echo $chpter_no?>_<?php echo $quiz_no?>"
                                                                                id="individual_question_<?php echo $chpter_no?>_<?php echo $quiz_no?>_<?php echo $ques_no?>">
                                                                                <div class="text-center">
                                                                                    <h4>Question No
                                                                                        <?php echo $ques_no?></h4>
                                                                                </div>
                                                                                <div>

                                                                                    <div class="mb-3 row">
                                                                                        <label for="question_type"
                                                                                            class="col-md-3">Question
                                                                                            Type <i class="text-danger">
                                                                                            </i></label>
                                                                                        <div class="col-md-9">
                                                                                            <span><?php echo ($questions->question_type == 1?'Radio(True/False)':'')?>
                                                                                                <?php echo ($questions->question_type == 2?'Checkbox(Multiple)':'')?>
                                                                                                <?php echo ($questions->question_type == 3?'Short Answer':'')?>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="mb-3 row">

                                                                                        <label for="question"
                                                                                            class="col-md-3">Question</label>
                                                                                        <div class="col-md-9">
                                                                                            <span><?php echo $questions->name?></span>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div
                                                                                            class="loaddata_<?php echo $chpter_no?>_<?php echo $quiz_no?>_<?php echo $ques_no?> col-sm-12 w-100p">
                                                                                            <?php if($questions->question_type == 1 || $questions->question_type == 2){?>
                                                                                            <div
                                                                                                class="table-responsive">
                                                                                                <input type="hidden"
                                                                                                    name="shortanswer<?php echo $chpter_no?><?php echo $quiz_no?>[]"
                                                                                                    id="shortanswer"
                                                                                                    class="form-control shortanswer">
                                                                                                <table
                                                                                                    class="table table-bordered"
                                                                                                    id="quesOptionTable<?php echo $chpter_no?>_<?php echo $quiz_no?>_<?php echo $ques_no?>">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th width="50%"
                                                                                                                class="text-center">
                                                                                                                Option
                                                                                                            </th>
                                                                                                            <th width="30%"
                                                                                                                class="text-center">
                                                                                                                Is
                                                                                                                Answer
                                                                                                            </th>

                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody
                                                                                                        id="addrowItem_<?php echo $chpter_no?>_<?php echo $quiz_no?>_<?php echo $ques_no?>">
                                                                                                        <?php $question_options = $this->Instructor_model->get_question_options($questions->question_id);?>
                                                                                                        <?php if($question_options){
                                                                                 $option = 1;
                                                                                 foreach($question_options as $options){
                                                                                 ?>
                                                                                                        <tr>
                                                                                                            <td
                                                                                                                class="text-right">
                                                                                                                <?php echo $options->option_name?>
                                                                                                            </td>
                                                                                                            <td
                                                                                                                class="text-center">
                                                                                                                <div
                                                                                                                    class="offset-2 checkbox checkbox-success">
                                                                                                                    <input
                                                                                                                        id="is_answer_<?php echo $chpter_no?><?php echo $quiz_no?><?php echo $ques_no?><?php echo $option?>"
                                                                                                                        name="question_is_answer<?php echo $chpter_no?><?php echo $quiz_no?><?php echo $ques_no?>[]"
                                                                                                                        type="checkbox"
                                                                                                                        value="<?php echo $options->is_answer?>"
                                                                                                                        <?php echo ($options->is_answer==1?'checked':'')?>
                                                                                                                        readonly>
                                                                                                                    <label
                                                                                                                        for="is_answer_<?php echo $chpter_no?>_<?php echo $option?>">Is
                                                                                                                        Answer</label>
                                                                                                                </div>

                                                                                                            </td>

                                                                                                        </tr>
                                                                                                        <?php $option++;}}?>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                            <?php }?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <hr />
                                                                                    <div class="mb-3 row">
                                                                                        <label for="correctAnsExplan"
                                                                                            class="col-md-3 col-form-label">Correct
                                                                                            Answer Explanation</label>
                                                                                        <div class="col-md-9">
                                                                                            <span><?php echo $questions->correct_ans_explanation?></span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="mb-3 row">
                                                                                        <label for="QuestionMarks"
                                                                                            class="col-md-3 col-form-label">Question
                                                                                            Marks</label>
                                                                                        <div class="col-md-4">
                                                                                            <span><?php echo $questions->question_mark?></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <br />
                                                                        <?php $ques_no++;}}?>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $quiz_no++;}}?>
                                                    <?php if($chapter_assign_projects){
                                          $project_no = 1;
                                          foreach($chapter_assign_projects as $projects){
                                          	$distributed_marks = $this->Instructor_model->project_distributed_marks($projects->assignment_id);
                                          ?>
                                                    <div class="accordion-item mb-4 border-top"
                                                        id="projectdiv<?php echo $chpter_no?>_<?php echo $project_no?>">
                                                        <h2 class="accordion-header"
                                                            id="panelsStayOpen-heading<?php echo $chpter_no?>_<?php echo $project_no?>">
                                                            <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#panelsStayOpen-collapseproject<?php echo $chpter_no?>_<?php echo $project_no?>"
                                                                aria-expanded="false"
                                                                aria-controls="panelsStayOpen-collapseproject<?php echo $chpter_no?>_<?php echo $project_no?>">
                                                                Project <?php echo $project_no?>
                                                            </button>
                                                        </h2>
                                                        <div id="panelsStayOpen-collapseproject<?php echo $chpter_no?>_<?php echo $project_no?>"
                                                            class="accordion-collapse collapse show"
                                                            aria-labelledby="panelsStayOpen-heading<?php echo $chpter_no?>_<?php echo $project_no?>">
                                                            <div class="accordion-body p-4 position-relative">


                                                                <div class="mb-3">
                                                                    <div class="row">
                                                                        <label for="project_title" class="col-2">Project
                                                                            Title</label>
                                                                        <div class="col-4">
                                                                            <span><?php echo $projects->title?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="row">
                                                                        <label for="categoryProject"
                                                                            class="col-2">Category</label>
                                                                        <div class="col-4">
                                                                            <span><?php echo ($projects->category == 1?'Chapter Project':'')?><?php echo ($projects->category == 2?'Final Project':'')?></span>

                                                                        </div>
                                                                        <div class="row mt-3"
                                                                            id="project_chapter_list_<?php echo $chpter_no?>_<?php echo $project_no?>">
                                                                            <?php if($projects->category == 1){?>
                                                                            <label for="chapters" class="col-2">Select
                                                                                Chapter</label>
                                                                            <div class="col-4">
                                                                                <span>
                                                                                    <option value="">Select Chapter
                                                                                    </option>
                                                                                    <?php if($chapter_list){
                                                                  foreach($chapter_list as $assignchapter){
                                                                  ?>
                                                                                    <?php if($projects->chapter_id == $assignchapter->section_id){echo $assignchapter->section_name;}?>

                                                                                    <?php }}?>
                                                                                </span>
                                                                            </div>
                                                                            <?php }?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <span><?php echo $projects->description?></span>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label for="passScore2"
                                                                        class="col-md-2 col-form-label">Pass
                                                                        Score</label>
                                                                    <div class="col-md-8">
                                                                        <span><?php echo $projects->pass_score?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label for="QuestionMarks2"
                                                                        class="col-md-2 col-form-label">Project
                                                                        Marks</label>
                                                                    <div class="col-md-8">
                                                                        <span><?php echo $projects->project_mark?></span>
                                                                    </div>
                                                                </div>
                                                                <table class="table table-bordered"
                                                                    id="project_marks_distribution_tbl_<?php echo $chpter_no?>_<?php echo $project_no?>">
                                                                    <thead class="bg-dark-cerulean text-light">
                                                                        <tr>
                                                                            <th class="text-center">Marking Base</th>
                                                                            <th class="text-center">Mark Distribution
                                                                            </th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody
                                                                        id="markdistribute_tbl_body_<?php echo $chpter_no?>_<?php echo $project_no?>">
                                                                        <?php if($distributed_marks){
                                                         $marks_sl = 1;
                                                         $total_marks = 0;
                                                         foreach($distributed_marks as $dmarks){
                                                         ?>
                                                                        <tr>
                                                                            <td><?php echo $dmarks->markes_title?></td>
                                                                            <td class="text-center">
                                                                                <?php echo $dmarks->marks;$total_marks += $dmarks->marks;?>
                                                                            </td>

                                                                        </tr>
                                                                        <?php $marks_sl++;}}?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td class="text-end"><b>Total</b></td>
                                                                            <td class="text-end"
                                                                                id="sum_total_marks_<?php echo $chpter_no?>_<?php echo $project_no?>">
                                                                                <?php echo number_format($total_marks,2)?>
                                                                            </td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                                <div class="mb-3">
                                                                    <span><?php echo $projects->tips?></span>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label for="bitRefer"
                                                                        class="col-sm-2 col-form-label">Reference</label>
                                                                    <div class="col-sm-10">
                                                                        <span><?php echo $projects->project_reference?></span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $project_no++;}}?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $chpter_no++;}}?>
                                </div>


                            </div>



                            <div>

                                <h5>Pricing</h5>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <?php $types = json_decode($course_info->course_type);
                                 ?>
                                        <div class="d-flex mb-3">
                                            <div class="form-check me-5">
                                                <input class="form-check-input" type="checkbox"
                                                    value="<?php if (in_array(1, $types)) {echo 1;}?>"
                                                    id="purchasePricing" name="course_types[]"
                                                    <?php if (in_array(1, $types)) {echo 'checked';}?> readonly>
                                                <label class="form-check-label" for="purchasePricing"> Purchase
                                                    &nbsp;</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="<?php if (in_array(2, $types)) {echo 2;}?>"
                                                    id="subscriptionPricing" name="course_types[]"
                                                    <?php if (in_array(2, $types)) {echo 'checked';}?> readonly>
                                                <label class="form-check-label" for="subscriptionPricing"> Subscription
                                                    &nbsp; &nbsp; </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="<?php if (in_array(3, $types)) {echo 3;}?>" id="freePricing"
                                                    name="course_types[]"
                                                    <?php if (in_array(3, $types)) {echo 'checked';}?> readonly>
                                                <label class="form-check-label" for="freePricing"> Free </label>
                                            </div>
                                        </div>
                                        <div class="row" id="priceContent"
                                            style="display: <?php if (in_array(1, $types)) {echo '';}else{echo 'none';}?>;">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text py-2 px-4"> Price </span>
                                                <input type="text" name=""
                                                    class="form-control valid_number my-3 my-sm-0 w-sm-100"
                                                    value="<?php echo $course_info->price?>" readonly>
                                                <span class="input-group-text py-2 px-4">BDT</span>
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text py-2 px-4">Old Price</span>
                                                <input type="text" name=""
                                                    class="form-control valid_number my-3 my-sm-0 w-sm-100"
                                                    value="<?php echo $course_info->oldprice?>" readonly>

                                                <span class="input-group-text py-2 px-4">BDT</span>
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text py-2 px-4">Discount</span>
                                                <input type="text" name=""
                                                    class="form-control valid_number my-3 my-sm-0 w-sm-100"
                                                    value="<?php echo $course_info->discount?>" readonly>

                                                <span class="input-group-text py-2 px-4">BDT</span>
                                            </div>
                                        </div>
                                        <!-- <div class="d-flex mb-3">
                                            <div class="form-check me-5">
                                                <input class="form-check-input" type="checkbox" value="" id="is_offer"
                                                    name="is_offer"
                                                    <?php echo ($course_info->is_offer == 1?'checked':'')?> readonly>
                                                <label class="form-check-label" for="is_offer">
                                                    Is Offer?
                                                </label>
                                            </div>
                                        </div> -->
                                        <div class="row" id="offer_coursediv"
                                            style="display: <?php echo ($course_info->is_offer == 1?'block':'none')?>;">
                                            <div class="col-md-12 mb-3">
                                                <div class="d-md-flex align-items-center">
                                                    <label for="offer_course" class="col-md-4 mb-2 mb-md-0">Select Offer
                                                        Courses :</label>
                                                    <div class="col-md-8">
                                                        <span><?php echo ($offer_courses?implode(',',$offer_courses):'') ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="d-md-flex align-items-center">
                                                    <label for="offer_price" class="col-md-4 mb-2 mb-md-0">Price With
                                                        Offer :</label>
                                                    <div class="col-md-8">
                                                        <span><?php echo $course_info->offer_courseprice?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- <div>
									<h5 class="mb-2 fw-semi-bold">Promotion</h5>
									<p>Here's where you get the options to promote your course</p>
									
									<div class="mb-3">
										<ul class="list-unstyled">
											<li class="d-flex"><span class="fs-6 fw-semi-bold w-25">Referred by:</span><span>John Milton</span></li>
											<li class="d-flex"><span class="fs-6 fw-semi-bold w-25">Coupons:</span><span>mcxl45210</span></li>
											<li class="d-flex"><span class="fs-6 fw-semi-bold w-25">Active Coupons:</span><span>52639841</span></li>
										</ul>
									</div>
								</div>

								<div>
									<h5>Course message</h5>
									<p>Write message to your students that will be sent automatically when they join or complete your course to encourage students to engage with course content. If you don't wish to send a welcome or congratulation message, leave the text box blank.</p>
									
									<ul class="list-unstyled">
										<li class="d-flex"><span class="fs-6 fw-semi-bold w-25">Welcome Message:</span><span>Hello Milton</span></li>
										<li class="d-flex"><span class="fs-6 fw-semi-bold w-25">Congratulations Message:</span><span>How are you </span></li>
									</ul>

								</div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>