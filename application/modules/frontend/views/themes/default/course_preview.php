
<div class="d-flex align-items-center justify-content-between mb-2">
    <span>Course Preview</span>
    <button type="button" class="btn-close" data-bs-dismiss="modal"
            aria-label="Close"></button>
</div>
<!--Course Preview Title-->
<h3 class="mb-4"><?php echo (!empty($get_coursedetails->name) ? $get_coursedetails->name : ''); ?></h3>
<div class="row align-items-center mb-4">
    <div class="col-auto">
        <div class="avatar d-flex align-items-center">
            <div class="avatar-img me-3">
                <!-- <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/avatar-01.jpg'); ?>"
                     alt=""> -->
                     <img src="<?php echo base_url(!empty($faculty_picture) ? $faculty_picture->picture : default_image()); ?>" alt="">
                    
            </div>
            <div class="avatar-text">
                <div class="instructor-designation"><?php echo display('instructor'); ?></div>
                <h5 class="instructor-name mb-1 fs-6">
                    <?php //echo (!empty($get_coursedetails->faculty_id) ? (get_userinfo($get_coursedetails->faculty_id)->name) : ''); ?>
                    <a href="<?php echo base_url($enterprise_shortname.'/instructor-profile-show/'.$get_coursedetails->faculty_id); ?>"><?php echo (!empty($get_coursedetails->faculty_id) ? get_userinfo($get_coursedetails->faculty_id)->name : ''); ?> </a>
                </h5>
            </div>
        </div>
    </div>
    <div class="col-auto">
        <div>Rating</div>
        <div>
            <i class="fas fa-star text-warning"></i>
            <?php   average_ratings_number($course_id,$enterprise_id);?>
        </div>
    </div>
    <div class="col-auto">
        <div>Enrolled</div>
        <div><?php echo $this->db->where('product_id',$course_id)->where('enterprise_id',$enterprise_id)->where('status',1)->get('invoice_details')->num_rows();?> already enrolled!</div>
    </div>
</div>
<!--Start Course Preview Video-->
<div class="course-preview__video">
    <div class="ratio ratio-16x9">
        <?php
//      d($get_youtubevimeovideoapi['embed_video']);
        if ($get_lessoninfo->lesson_provider == 1) {
            ?>
            <iframe src="<?php echo (!empty($get_youtubevimeovideoapi['embed_video']) ? $get_youtubevimeovideoapi['embed_video'] : ''); ?>" title="YouTube video" allowfullscreen></iframe>
        <?php } elseif ($get_lessoninfo->lesson_provider == 2) { ?>
            <iframe id="player1" src="<?php echo $get_youtubevimeovideoapi['embed_video'];?>?api=1&player_id=player1" width="100%" height="354"
    frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        <?php } ?>
    </div>
</div>
<!--End Start Course Preview Video-->
<div class="course-preview__separation--text fs-5 fw-medium my-3">
    <?php echo (!empty($get_lessoninfo->lesson_name) ? $get_lessoninfo->lesson_name : ''); ?>
</div>
<!--<div class="course-preview__separation--text fs-5 fw-medium my-3">
    Free Sample Videos:
</div>-->
<!--Start Course Preview Video List Items-->
<div class="accordion preview-accordion">

<?php 
 $course_id = $get_coursedetails->course_id;
$sl = 0;
$get_sections = get_sections($course_id, $enterprise_id);
foreach ($get_sections as $section) {
$course_section_wise_lesson = $this->Course_model->course_section_wise_lesson($course_id, $section->section_id, $enterprise_id);
$lecturecount = count($course_section_wise_lesson);
$seconds = 0;
foreach ($course_section_wise_lesson as $singletime) {
    list($hour, $minute, $second) = explode(':', html_escape($singletime->duration));
    $seconds += $hour * 3600;
    $seconds += $minute * 60;
    $seconds += $second;
}
$hours = floor($seconds / 3600);
$seconds -= $hours * 3600;
$minutes = floor($seconds / 60);
$seconds -= $minutes * 60;
$sl++;   
?>
    <div class="accordion-item">
        <h2 class="accordion-header" id="previewHeadingOne">
            <a href="#" class="accordion-button" data-bs-toggle="collapse"
               data-bs-target="#previewCollapseOne" aria-expanded="true"
               aria-controls="previewCollapseOne">
                <!--Start Round Progress-->
                <span class="progress round-progress me-3 flex-shrink-0"
                      data-percentage="70">
                    <span class="progress-left"><span
                            class="progress-bar"></span></span>
                    <span class="progress-right"><span
                            class="progress-bar"></span></span>
                    <span class="progress-value">1</span>
                </span>
                <!--End Round Progress-->
                <span class="flex-grow-1">
                    <span class="d-block"><?php echo html_escape($section->section_name); ?></span>
                    <span class="d-flex align-items-center preview-time mt-2">
                        <i data-feather="clock" class="me-2"></i>
                        <?php echo $hours . ":" . $minutes . ":" . $seconds; ?></span>
                </span>
            </a>
        </h2>
        <!-- <div id="previewCollapseOne" class="accordion-collapse collapse show"
             aria-labelledby="previewHeadingOne">
            <a href="#" class="content-item_list d-flex align-items-center">
                <i data-feather="play-circle"></i>
                <span class="d-flex justify-content-between w-100">Auto-Welcome
                    Message<span class="course-duration ms-auto">2m
                        42s</span></span>
            </a>
            <a href="#" class="content-item_list d-flex align-items-center">
                <i data-feather="file-text"></i>
                <span class="d-flex justify-content-between w-100">Course
                    Introduction<span class="course-duration ms-auto">6m
                        6s</span></span>
            </a>
            <a href="#" class="content-item_list d-flex align-items-center">
                <i data-feather="play-circle"></i>
                <span class="d-flex justify-content-between w-100">Course
                    Curriculum Overview<span class="course-duration ms-auto">5m
                        44s</span></span>
            </a>
            <a href="#" class="content-item_list d-flex align-items-center">
                <i data-feather="help-circle"></i>
                <span class="d-flex justify-content-between w-100">Course
                    FAQs<span class="course-duration ms-auto">2m
                        54s</span></span>
            </a>
        </div> -->
    </div>
<?php }?>
    <!-- <div class="accordion-item">
        <h2 class="accordion-header" id="previewHeadingTwo">
            <button class="accordion-button collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#previewCollapseTwo"
                    aria-expanded="false" aria-controls="previewCollapseTwo">
              
                <span class="progress round-progress me-3 flex-shrink-0"
                      data-percentage="50">
                    <span class="progress-left"><span
                            class="progress-bar"></span></span>
                    <span class="progress-right"><span
                            class="progress-bar"></span></span>
                    <span class="progress-value">2</span>
                </span>
                
                <span class="flex-grow-1">
                    <span class="d-block">Milestone Project - 1</span>
                    <span class="d-flex align-items-center preview-time mt-2"><i
                            data-feather="clock" class="me-2"></i>17m 28s</span>
                </span>
            </button>
        </h2>
        <div id="previewCollapseTwo" class="accordion-collapse collapse"
             aria-labelledby="previewHeadingTwo">
            <a href="#" class="content-item_list d-flex align-items-center">
                <i data-feather="play-circle"></i>
                <span class="d-flex justify-content-between w-100">Auto-Welcome
                    Message<span class="course-duration ms-auto">2m
                        42s</span></span>
            </a>
            <a href="#" class="content-item_list d-flex align-items-center">
                <i data-feather="file-text"></i>
                <span class="d-flex justify-content-between w-100">Course
                    Introduction<span class="course-duration ms-auto">6m
                        6s</span></span>
            </a>
            <a href="#" class="content-item_list d-flex align-items-center">
                <i data-feather="play-circle"></i>
                <span class="d-flex justify-content-between w-100">Course
                    Curriculum Overview<span class="course-duration ms-auto">5m
                        44s</span></span>
            </a>
            <a href="#" class="content-item_list d-flex align-items-center">
                <i data-feather="help-circle"></i>
                <span class="d-flex justify-content-between w-100">Course
                    FAQs<span class="course-duration ms-auto">2m
                        54s</span></span>
            </a>
        </div>
    </div> -->
    <!-- <div class="accordion-item">
        <h2 class="accordion-header" id="previewHeadingThree">
            <button class="accordion-button collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#previewCollapseThree"
                    aria-expanded="false" aria-controls="previewCollapseThree">
               
                <span class="progress round-progress me-3 flex-shrink-0"
                      data-percentage="90">
                    <span class="progress-left"><span
                            class="progress-bar"></span></span>
                    <span class="progress-right"><span
                            class="progress-bar"></span></span>
                    <span class="progress-value">3</span>
                </span>
                
                <span class="flex-grow-1">
                    <span class="d-block">Python Object and Data Structure
                        Basics</span>
                    <span class="d-flex align-items-center preview-time mt-2"><i
                            data-feather="clock" class="me-2"></i>17m 28s</span>
                </span>
            </button>
        </h2>
        <div id="previewCollapseThree" class="accordion-collapse collapse"
             aria-labelledby="previewHeadingThree">
            <a href="#" class="content-item_list d-flex align-items-center">
                <i data-feather="play-circle"></i>
                <span class="d-flex justify-content-between w-100">Auto-Welcome
                    Message<span class="course-duration ms-auto">2m
                        42s</span></span>
            </a>
            <a href="#" class="content-item_list d-flex align-items-center">
                <i data-feather="file-text"></i>
                <span class="d-flex justify-content-between w-100">Course
                    Introduction<span class="course-duration ms-auto">6m
                        6s</span></span>
            </a>
            <a href="#" class="content-item_list d-flex align-items-center">
                <i data-feather="play-circle"></i>
                <span class="d-flex justify-content-between w-100">Course
                    Curriculum Overview<span class="course-duration ms-auto">5m
                        44s</span></span>
            </a>
            <a href="#" class="content-item_list d-flex align-items-center">
                <i data-feather="help-circle"></i>
                <span class="d-flex justify-content-between w-100">Course
                    FAQs<span class="course-duration ms-auto">2m
                        54s</span></span>
            </a>
        </div>
    </div> -->
    <!-- <div class="accordion-item">
        <h2 class="accordion-header" id="previewHeadingFour">
            <button class="accordion-button collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#previewCollapseFour"
                    aria-expanded="false" aria-controls="previewCollapse">
               
                <span class="progress round-progress me-3 flex-shrink-0"
                      data-percentage="90">
                    <span class="progress-left"><span
                            class="progress-bar"></span></span>
                    <span class="progress-right"><span
                            class="progress-bar"></span></span>
                    <span class="progress-value">4</span>
                </span>
      
                <span class="flex-grow-1">
                    <span class="d-block">Object Oriented Programming</span>
                    <span class="d-flex align-items-center preview-time mt-2"><i
                            data-feather="clock" class="me-2"></i>179m
                        02s</span>
                </span>
            </button>
        </h2>
        <div id="previewCollapseFour" class="accordion-collapse collapse"
             aria-labelledby="previewHeadingFour">
            <a href="#" class="content-item_list d-flex align-items-center">
                <i data-feather="play-circle"></i>
                <span class="d-flex justify-content-between w-100">Auto-Welcome
                    Message<span class="course-duration ms-auto">2m
                        42s</span></span>
            </a>
            <a href="#" class="content-item_list d-flex align-items-center">
                <i data-feather="file-text"></i>
                <span class="d-flex justify-content-between w-100">Course
                    Introduction<span class="course-duration ms-auto">6m
                        6s</span></span>
            </a>
            <a href="#" class="content-item_list d-flex align-items-center">
                <i data-feather="play-circle"></i>
                <span class="d-flex justify-content-between w-100">Course
                    Curriculum Overview<span class="course-duration ms-auto">5m
                        44s</span></span>
            </a>
            <a href="#" class="content-item_list d-flex align-items-center">
                <i data-feather="help-circle"></i>
                <span class="d-flex justify-content-between w-100">Course
                    FAQs<span class="course-duration ms-auto">2m
                        54s</span></span>
            </a>
        </div>
    </div> -->
</div>
<!--End Course Preview Video List Items-->