<?php
$course_id = $get_coursedetails->course_id;
$session_id = $this->session->userdata('session_id');
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
$name = $this->session->userdata('name');
$fullname = $this->session->userdata('fullname');
$name = (($name) ? "$name" : "$fullname");
$email = $this->session->userdata('email');
$enterprise_id = $enterprise_id;
//echo $course_id." ". $session_id. " ". $user_type ." ". $user_id ." ".$name. " ". $fullname. " ".$email;die();

$lesson_tbl=$this->db->select('*')->from('lesson_tbl')->where('course_id',$course_id)->where('lesson_type',1)->where('enterprise_id',$enterprise_id)->get()->result();

//isahaq
$textFilepercentage=$this->db->select('*')->from('lesson_tbl')
                                ->where('course_id',$course_id)
                                ->where('lesson_type !=',1)
                                ->where('enterprise_id',$enterprise_id)
                                ->get()
                                ->result();
$lesson_count=$this->db->select('*')->from('lesson_tbl')->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->get()->num_rows();

$quizCount_per=$this->db->select('*')->from('assign_courseexam_tbl')
                      ->where('course_id',$course_id)
                      ->where('enterprise_id',$enterprise_id)
                      ->get()
                      ->num_rows();
$totalassignment_per=$this->db->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->get('project_assingment')->num_rows();
//isahaq

$toTalLessonVideoDuration = 0;
$eachVideoDuration= 0;
$TotalWatchTime=0;
//isahaq
$total_lesson_per = ($lesson_count > 0?50:0) + ($quizCount_per == 0?25:0) + ($totalassignment_per == 0?25:0);
$total_quize_per  = ($quizCount_per > 0?25:0);
$total_assing_per = ($totalassignment_per > 0?25:0);
//isahaq
$i=0;
//isahaq
$total_video_per  = ($lesson_tbl?50:0) + (empty($textFilepercentage)?50:0);
$total_textper    = (empty($lesson_tbl)?50:0) + ($textFilepercentage?50:0);

foreach ($lesson_tbl as $lesson_tbl_duration) {
    list($hour, $minute, $second) = explode(':', html_escape($lesson_tbl_duration->duration));
    $hour1 = $hour * 3600;
    $minute1 = $minute * 60;
    $second1 = $second;
   $eachVideoDuration=$hour1+$minute1+$second1;
   $toTalLessonVideoDuration +=$eachVideoDuration; //all lesson duration
   $watch=$this->db->select('*')->from('watch_time_tbl')->where('lesson_id',$lesson_tbl_duration->lesson_id)->where('student_id',$user_id)->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->get()->row();
   $eachvideoWatchTime=(!empty($watch->real_time) ? $watch->real_time : '1');
   if($eachvideoWatchTime<=$eachVideoDuration){
    $TotalWatchTime +=@$watch->real_time; //single video watch time
   }else{
     $TotalWatchTime +=$eachVideoDuration;
   }
}
if($TotalWatchTime > 0 && $toTalLessonVideoDuration>0){
$eachVedioPercent = number_format((@$TotalWatchTime * 100 )/ $toTalLessonVideoDuration,2); //each video percentage
$TotalVideo=$eachVedioPercent;
// $totalCourse=number_format(($TotalVideo/2)+$assignment+$q,1); //total course percentage

// new  
 $videoWatchPercentage=$eachVedioPercent*$total_video_per/100;

}else{
    $videoWatchPercentage=0;
}
//====================file percentage count =====================
$textFilePerCalculation=$this->db->select('*')->from('lesson_tbl')
                                ->where('course_id',$course_id)
                                ->where('lesson_type !=',1)
                                ->where('enterprise_id',$enterprise_id)
                                ->get()
                                ->result();
$completetextFile = $this->db->where('course_id',$course_id)
                             ->where('student_id', $user_id)
                             ->where('file_type',0)
                             ->where('is_complete',1)
                             ->where('enterprise_id',$enterprise_id)
                             ->get('watch_time_tbl')
                             ->result();
if(count($completetextFile) > 0 && count($textFilePerCalculation)>0){
$Textfilecount=(count($completetextFile)*100)/count($textFilePerCalculation);
  $Filecomplete =$Textfilecount*$total_textper/100;
}else{
  $Filecomplete=0;
}

// $VideoAndFIle=(!empty($videoWatchPercentage) ? $videoWatchPercentage:'0')+(!empty($Filecomplete) ? $Filecomplete:'0');
$VideoAndFIle=(!empty($videoWatchPercentage) ? $videoWatchPercentage:'0')+(!empty($Filecomplete) ? $Filecomplete:'0');

$Lessonprogress=($VideoAndFIle*$total_lesson_per)/100;


//  quiz  count 
$quizCount=$this->db->select('*')->from('assign_courseexam_tbl')
                      ->where('course_id',$course_id)
                      ->where('enterprise_id',$enterprise_id)
                    //   ->where('student_id',$user_id)
                      ->get()
                      ->result();
//  quiz complete status count                    
$quizComplete=$this->db->select('*')->from('question_exam_tbl')
                      ->where('is_done',1)
                      ->where('course_id',$course_id)
                      ->where('enterprise_id',$enterprise_id)
                      ->where('student_id',$user_id)
                      ->get()
                      ->result();  
if(count($quizComplete) > 0 && count($quizCount)>0){
$quizindivisualP=(count($quizComplete)*100)/count($quizCount);
$quizPercentage =$quizindivisualP*$total_quize_per/100;
}else{
    $quizPercentage=0;
}

$totalassignment=$this->db->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->get('project_assingment')->num_rows();
$completetotalassignment=$this->db->where('course_id',$course_id)->where('project_type',1)->where('type',1)->where('user_id', $user_id)->where('enterprise_id',$enterprise_id)->where('project_status',1)->get('project_tbl')->num_rows();

if($completetotalassignment > 0 && $totalassignment>0){
    $assignmentindivisula= ($completetotalassignment*100)/ $totalassignment;
    $assignment= ($assignmentindivisula*$total_assing_per)/100;
 }else{
     $assignment=0;
 }
 



 
  
$totalassignment=$this->db->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->get('project_assingment')->num_rows();
$lesson_tblvideo=$this->db->select('*')->from('lesson_tbl')->where('course_id',$course_id)->where('lesson_type',1)->where('enterprise_id',$enterprise_id)->get()->num_rows();
$textFilePerCalculation=$this->db->select('*')->from('lesson_tbl')->where('course_id',$course_id)->where('lesson_type !=',1)->where('enterprise_id',$enterprise_id)->get()->num_rows();
$quizCount=$this->db->select('*')->from('assign_courseexam_tbl')->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->get()->num_rows();

// when one or multiple type of course is empty  
 // $Newpercent=1;
 // if(empty($quizCount) && empty($totalassignment) && empty($textFilePerCalculation)){
 //        $Newpercent=4;
 //    }else if(empty($quizCount) && empty($textFilePerCalculation)){
 //        $Newpercent=2;
 //    }else if(empty($quizCount) && empty($totalassignment)){
 //        $Newpercent=2;
 //    }else if(empty($totalassignment) && empty($textFilePerCalculation)){
 //        $Newpercent=2;
 //    }else{
 //        if(!empty($quizCount) && !empty($totalassignment) && !empty($textFilePerCalculation)){
 //            $Newpercent=1;
 //        }else{
          
 //            $Newpercent=1.333333333333;

 //        }
 //    }

 //end

 // $TotalProgress=number_format(($Filecomplete*$Newpercent)+($videoWatchPercentage*$Newpercent)+($quizPercentage*$Newpercent)+($assignment*$Newpercent),1);

// question_exam_tbl

$TotalProgress=number_format($Lessonprogress+$quizPercentage+$assignment,1);


$active_lst_lesson=$this->db->select('*')->from('students_tbl')->where('last_activity',$course_id)->where('student_id',$user_id)->get()->row();
$query = $this->db->select('*')->from('lesson_tbl')->where('lesson_id', $active_lst_lesson->last_lesson)->get()->row();

?>
<script>
//     $( document ).ready(function() {
//     loadcoursecontent('video', 'LE26Z6V3H')
//  });
</script>
<style>
/* .activeremoveclass.active {
    color: #20e64a !important;
} */
</style>

<!-- accordion-body px-3 px-md-0 py-3 -->
<input type="hidden" id="course_id" name="course_id" value="<?php echo (!empty($course_id) ? $course_id : ''); ?>">
<input type="hidden" id="student_id" name="student_id" value="<?php echo $user_id; ?>">

<div class="bg-alice-blue pb-5">
    <div class="container custom-content p-0">
        <div class="row g-0">
            <div class="col-lg-8 sticky-content">
                <!--Start Course Preview Video-->
                <div class="course-preview__separation--text fs-5 fw-medium bg-white">

                    <div
                        class="align-items-center border-bottom-0 card-header d-flex justify-content-between px-0 py-3">
                        <h5 class="mb-0">
                            <?php echo (!empty($get_coursedetails->name) ? $get_coursedetails->name : ''); ?></h5>

                    </div>
                </div>
                <div class="course-preview__video loadcontent m-0 ">

                    <div class="ratio ratio-16x9">
                        <!--<div class="loadcontent">-->
                        <?php
                            if ($get_coursedetails->course_provider == 1) {
                            ?>
                        <iframe
                            src="<?php echo (!empty(@$get_youtubevimeovideoapi['embed_video']) ? @$get_youtubevimeovideoapi['embed_video'] : ''); ?>"
                            title="YouTube video" allowfullscreen></iframe>
                        <?php } elseif ($get_coursedetails->course_provider == 2) { 
                                if($get_coursedetails->url){?>

                        <iframe id="player1"
                            src="<?php echo (!empty(@$get_youtubevimeovideoapi['embed_video']) ? @$get_youtubevimeovideoapi['embed_video'] : ''); ?>?api=1&player_id=player1"
                            width="100%" height="354" frameborder="0" webkitallowfullscreen mozallowfullscreen
                            allowfullscreen></iframe>

                        <?php }else{?>
                        <img
                            src="<?php echo base_url(!empty($get_coursedetails->hover_thumbnail) ? $get_coursedetails->hover_thumbnail : 'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/header-bg-02.jpg'); ?>">
                        <?php }}?>
                        <!--</div>-->
                        <!--Start Quiz Overlay-->
                        <div
                            class="quiz-overlay bg-white d-flex align-items-center justify-content-center flex-column text-center p-3">
                            <div class="fs-3">Quiz title : Wordpress test quiz</div>
                            <div class="fs-6 text-muted">Number of questions : 1</div>
                            <a href="<?php echo base_url($enterprise_shortname.'/show-quizform/'.$get_coursedetails->course_id); ?>"
                                class="btn btn-dark-cerulean btn-lg mt-3">Get Started</a>
                        </div>
                        <!--End Quiz Overlay-->
                    </div>
                </div>
                <!--End Course Preview Video-->

                <div class="pe-4">
                    <div class="custom-tabs bg-white border-bottom border-top">
                        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                            <!-- <li class="nav-item" role="presentation">
                                <button class="nav-link " id="search-tab" data-bs-toggle="tab" data-bs-target="#search"
                                    type="button" role="tab" aria-controls="search" aria-selected="true">
                                    <svg id="search_4_" data-name="search (4)" xmlns="http://www.w3.org/2000/svg" width="21"
                                        height="21" viewBox="0 0 22.733 22.734">
                                        <g id="Group_16" data-name="Group 16" transform="translate(3.418 4.928)">
                                            <g id="Group_15" data-name="Group 15">
                                                <path id="Path_5" data-name="Path 5"
                                                    d="M79.837,111.222a.84.84,0,0,0-1.188,0,5.74,5.74,0,0,0-1.642,4.653.84.84,0,0,0,.835.756c.028,0,.056,0,.084,0a.84.84,0,0,0,.752-.919,4.067,4.067,0,0,1,1.158-3.3A.839.839,0,0,0,79.837,111.222Z"
                                                    transform="translate(-76.978 -110.975)" fill="#063663" />
                                            </g>
                                        </g>
                                        <g id="Group_18" data-name="Group 18">
                                            <g id="Group_17" data-name="Group 17">
                                                <path id="Path_6" data-name="Path 6"
                                                    d="M9.6,0a9.6,9.6,0,1,0,9.6,9.6A9.614,9.614,0,0,0,9.6,0Zm0,17.526A7.923,7.923,0,1,1,17.526,9.6,7.932,7.932,0,0,1,9.6,17.526Z"
                                                    fill="#063663" />
                                            </g>
                                        </g>
                                        <g id="Group_20" data-name="Group 20" transform="translate(14.95 14.951)">
                                            <g id="Group_19" data-name="Group 19">
                                                <path id="Path_7" data-name="Path 7"
                                                    d="M344.246,343.059l-6.1-6.1a.84.84,0,1,0-1.188,1.188l6.1,6.1a.84.84,0,0,0,1.188-1.188Z"
                                                    transform="translate(-336.708 -336.71)" fill="#063663" />
                                            </g>
                                        </g>
                                    </svg>
                                </button>
                            </li> -->
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                    aria-selected="true">Description</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="notes-tab" data-bs-toggle="tab" data-bs-target="#notesTab"
                                    type="button" role="tab" aria-controls="notesTab"
                                    aria-selected="false">Notes</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="quizproject-tab" data-bs-toggle="tab"
                                    data-bs-target="#quizprojectTab" type="button" role="tab"
                                    aria-controls="quizprojectTab" aria-selected="false">Quiz & Project</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="progress-tab" data-bs-toggle="tab"
                                    data-bs-target="#progressTab" type="button" role="tab" aria-controls="progressTab"
                                    aria-selected="false">Your Progress</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="resource-tab" data-bs-toggle="tab"
                                    data-bs-target="#resource" type="button" role="tab" aria-controls="resource"
                                    aria-selected="false">Related
                                    Resource</button>
                            </li>
                            <!-- <li class="nav-item" role="presentation">
                                <button class="nav-link" id="discussion-tab" data-bs-toggle="tab"
                                    data-bs-target="#discussion" type="button" role="tab" aria-controls="discussion"
                                    aria-selected="false">Discussion</button>
                            </li>
                            -->
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="modal"
                                    data-bs-target="#shareModal">Share</button>
                            </li>
                            <!-- Share Modal -->

                        </ul>
                    </div>
                </div>

                <div class="pb-md-0 ps-lg-0 pt-lg-4 px-0 px-lg-4 py-3">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="search" role="tabpanel" aria-labelledby="search-tab">

                            <div class="card border-0 rounded-0 shadow-sm" id="overview">
                                <div class="card-body p-4 p-xl-5">

                                    <div class="input-group course-search">
                                        <input type="text" class="form-control" placeholder="Search For Course"
                                            aria-label="Recipient's username" aria-describedby="button-addon2">
                                        <button class="btn btn-dark-cerulean btn-shadow" type="button"
                                            id="button-addon2">
                                            <svg id="search_4_" data-name="search (4)"
                                                xmlns="http://www.w3.org/2000/svg" width="24.894" height="24.894"
                                                viewBox="0 0 24.894 24.894">
                                                <g id="Group_16" data-name="Group 16"
                                                    transform="translate(3.743 5.396)">
                                                    <g id="Group_15" data-name="Group 15">
                                                        <path id="Path_5" data-name="Path 5"
                                                            d="M80.108,111.245a.919.919,0,0,0-1.3,0,6.286,6.286,0,0,0-1.8,5.1.92.92,0,0,0,.914.828c.031,0,.062,0,.092,0a.92.92,0,0,0,.824-1.007,4.453,4.453,0,0,1,1.268-3.612A.919.919,0,0,0,80.108,111.245Z"
                                                            transform="translate(-76.978 -110.976)" fill="#fff" />
                                                    </g>
                                                </g>
                                                <g id="Group_18" data-name="Group 18">
                                                    <g id="Group_17" data-name="Group 17">
                                                        <path id="Path_6" data-name="Path 6"
                                                            d="M10.516,0A10.516,10.516,0,1,0,21.032,10.516,10.528,10.528,0,0,0,10.516,0Zm0,19.192a8.676,8.676,0,1,1,8.676-8.676A8.686,8.686,0,0,1,10.516,19.192Z"
                                                            fill="#fff" />
                                                    </g>
                                                </g>
                                                <g id="Group_20" data-name="Group 20"
                                                    transform="translate(16.371 16.371)">
                                                    <g id="Group_19" data-name="Group 19">
                                                        <path id="Path_7" data-name="Path 7"
                                                            d="M344.962,343.663l-6.684-6.684a.92.92,0,0,0-1.3,1.3l6.684,6.684a.92.92,0,0,0,1.3-1.3Z"
                                                            transform="translate(-336.709 -336.71)" fill="#fff" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>

                                </div>
                            </div>
                            <!--End card-->
                        </div>
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <!--Start card-->
                            <div class="card border-0 rounded-0 shadow-sm mb-3 " id="overview">
                                <div class="card-body p-4 p-xl-5">
                                    <!--Start Section Header-->
                                    <div class="section-header mb-4">
                                        <h4 class="h5" id="about_lesson">About this Course</h4>
                                        <div class="section-header_divider"></div>
                                    </div>
                                    <!--End Section Header-->
                                    <div class="lesson_wise_information">
                                        <p><?php echo htmlspecialchars_decode(!empty($get_coursedetails->description) ? $get_coursedetails->description : ''); ?>
                                        </p>
                                    </div>
                                     <div id="course_description">
                                     <p><?php echo htmlspecialchars_decode(!empty($get_coursedetails->description) ? $get_coursedetails->description : ''); ?>
                                     </div>
                                </div>
                            </div>
                            <!--End card-->

                            <div class="card border-0 rounded-0 shadow-sm mb-3" id="lesson-resource-area">
                                <div class="card-body p-4 p-xl-5">
                                    <div class="section-header mb-4">
                                        <h4 class="h5">Lesson Exercise/Material</h4>
                                        <div class="section-header_divider"></div>
                                    </div>
                                    <div class="row load-lesson-resource">
                                    </div>
                                </div>
                            </div>

                            <!--Start Card-->
                            <div class="card border-0 rounded-0 shadow-sm mb-3" id="preRequisites">
                                <div class="card-body p-4 p-xl-5">
                                    <!--Start Section Header-->
                                    <div class="section-header mb-4">
                                        <h4 class="h5"><?php echo display('pre_requisites'); ?></h4>
                                        <div class="section-header_divider"></div>
                                    </div>
                                    <!--End Section Header-->
                                    <div class="row">
                                        <?php
                                            $get_requirements = json_decode($get_coursedetails->requirements);
                                            foreach ($get_requirements as $requirement) {
                                            ?>
                                        <div class="col-sm-6 col-md-6">
                                            <p>
                                                <i class="far fa-calendar-check"> </i>
                                                <?php echo (!empty($requirement) ? $requirement : ''); ?>
                                            </p>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!--End card-->
                            <!--Start card-->
                            <?php 
                             if(empty($lession_id)){
                            ?>
                            <div class="card border-0 rounded-0 shadow-sm mb-3" id="learnings">
                                <div class="card-body p-4 p-xl-5">
                                    <!--Start Section Header-->
                                    <div class="section-header mb-4">
                                        <h4 class="h5"><?php echo display('what_will_i_learn'); ?></h4>
                                        <div class="section-header_divider"></div>
                                    </div>
                                    <!--End Section Header-->
                                    <div class="row">
                                        <?php
                                                $get_benifits = json_decode($get_coursedetails->benifits);
                                                foreach ($get_benifits as $benifit) {
                                                    ?>
                                        <div class="col-sm-6 col-md-6">
                                            <p class="benifit-checked"><i class="fas fa-check"> </i>
                                                <?php echo (!empty($benifit) ? $benifit : ''); ?></p>
                                        </div>
                                        <?php }
                                                ?>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                            <!--End card-->
                            <!--Start card-->
                            <div class="card border-0 rounded-0 shadow-sm mb-3" id="instructor">
                                <div class="card-body p-4 p-xl-5">
                                    <!--Start Section Header-->
                                    <div class="section-header mb-4">
                                        <h4 class="h5"><?php echo display('meet_your_instructor'); ?></h4>
                                        <div class="section-header_divider"></div>
                                    </div>
                                    <!--End Section Header-->
                                    <div class="avatar d-flex mb-3">
                                        <div class="avatar-img me-3">
                                            <img src="<?php echo base_url(!empty($faculty_picture) ? $faculty_picture->picture : default_image()); ?>"
                                                alt="">
                                        </div>
                                        <div class="avatar-text">
                                            <h5 class="instructor-name mb-1 fs-6">
                                                <a
                                                    href="<?php echo base_url($enterprise_shortname.'/instructor-profile-show/'.$get_coursedetails->faculty_id); ?>">
                                                    <?php echo (!empty($get_coursedetails->faculty_id) ? get_userinfo($get_coursedetails->faculty_id)->name : ''); ?>
                                                </a>
                                            </h5>
                                            <p class="instructor-designation">
                                                <?php  echo (!empty($get_coursedetails->designation) ?$get_coursedetails->designation : ''); ?>
                                            </p>
                                            <ul class="list-unstyled">
                                                <li class="mb-1"><i class="fas fa-star text-warning me-1"></i>
                                                    <?php echo (!empty($instructor_rating)?number_format($instructor_rating,1):'0'); ?>
                                                    Instructor Rating
                                                </li>
                                                <li class="mb-1"><i class="fas fa-award text-warning me-1"></i>
                                                    <?php echo $this->db->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl') ?>
                                                    Reviews</li>
                                                <li class="mb-1"><i class="fas fa-user-graduate text-warning me-1"></i>
                                                    <?php echo (!empty($total_student)?$total_student:'0'); ?> Students
                                                </li>
                                                <li class="mb-1"><i
                                                        class="fas fa-book-open text-warning me-1"></i><?php echo get_coursecountbyinstructor($get_coursedetails->faculty_id); ?>
                                                    <?php echo display('courses'); ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php  echo (!empty($get_coursedetails->biography) ?$get_coursedetails->biography : ''); ?>
                                    <?php if($check_followinginstructor){ 
                                            // d($check_followinginstructor);
                                            ?>
                                    <button class="btn btn-danger btn-sm text-white"
                                        onclick="studentUnfollowInstructor('<?php echo $check_followinginstructor->id; ?>')">Unfollow</button>
                                    <?php }else{ ?>
                                    <button class="btn btn-warning btn-sm text-white"
                                        onclick="studentFollowInstructor('<?php echo $get_coursedetails->faculty_id; ?>')">Follow
                                        This Instructor</button>
                                    <?php } ?>
                                </div>
                            </div>
                            <!--End card-->
                            <!--Start Feedback-->
                            <div class="bg-alice-blue py-4">
                                <div class="container-lg">
                                    <div class="card border-0 shadow-sm rounded-0" id="reviews">
                                        <div class="card-body p-4">
                                            <!--Start Section Header-->
                                            <div class="section-header mb-4">
                                                <h4 class="h5">Student Feedback</h4>
                                                <div class="section-header_divider"></div>
                                            </div>
                                            <!--End Section Header-->
                                            <div class="row">
                                                <div class="col-md-4 col-lg-4 text-center">
                                                    <div
                                                        class="d-inline-block px-5 py-4 rating-block rounded-3 shadow text-center">
                                                        <div class="rating-point mb-3 text-center">
                                                            <h3 class="display-1 fw-light mb-0 fw-semi-bold">
                                                                <?php  echo  average_ratings_number($course_id,$enterprise_id);?>
                                                            </h3>
                                                            <div class="text-warning">
                                                                <?php  echo avg_rating($course_id,$enterprise_id);?>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            Course Ratings
                                                            <!-- Total -->
                                                            <?php //echo $this->db->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl') ?>
                                                            <!-- Ratings -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-8">
                                                    <?php 
                                                    $five =IndivisualRating($course_id,$enterprise_id,5);
                                                    $four =IndivisualRating($course_id,$enterprise_id,4);
                                                    $three=IndivisualRating($course_id,$enterprise_id,3);
                                                    $two  =IndivisualRating($course_id,$enterprise_id,2);
                                                    $one  =IndivisualRating($course_id,$enterprise_id,1);
                                                    $total=$this->db->select('SUM(rating) AS total_ratings')->from('rating_tbl')->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->get()->row();
                                              
                                                  //$total=$this->db->select('SUM(rating) AS total_ratings')->from('rating_tbl')->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->get()->row();
                              
                                                    $fivecount=$this->db->where('rating',5)->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl');
                                                    $fourcount=$this->db->where('rating',4)->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl');
                                                    $threecount=$this->db->where('rating',3)->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl');
                                                    $twocount=$this->db->where('rating',2)->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl');
                                                    $onecount=$this->db->where('rating',1)->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl');
                                                    $totalRating=$this->db->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl');
                                                    
                                                     $avg_count=$fivecount+$fourcount+$threecount+$twocount+$onecount;
                                              
                                              ?>
                                                    <table class="table table-borderless mb-0 white-space-nowrap">
                                                        <!-- <tbody>
                                                            <tr>
                                                                <td width="10%" class="align-middle">
                                                                    <div class="rating-quantity">
                                                                        5 <i class="fas fa-star text-warning"></i>
                                                                    </div>
                                                                </td>
                                                                <td width="70%" class="align-middle">
                                                                    <div class="rating-percent">
                                                                        <div class="progress">
                                                                            <div class="progress-bar bg-warning progress-bar-striped"
                                                                                role="progressbar"
                                                                                style="width: <?php if(!empty($five) && !empty($five)){ echo  round($five*100/$total->total_ratings);}else{ echo "0";}?>%"
                                                                                aria-valuenow="100" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td width="20%" class="align-middle">
                                                                    <div class="user-rating text-muted">
                                                                        <?php if(!empty($five) && !empty($five)){ echo round($five*100/$total->total_ratings);}else{ echo "0";}?>%
                                                                        Rating</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="10%" class="align-middle">
                                                                    <div class="rating-quantity">
                                                                        4 <i class="fas fa-star text-warning"></i>
                                                                    </div>
                                                                </td>
                                                                <td width="70%" class="align-middle">
                                                                    <div class="rating-percent">
                                                                        <div class="progress">
                                                                            <div class="progress-bar bg-warning progress-bar-striped"
                                                                                role="progressbar"
                                                                                style="width: <?php if(!empty($five) && !empty($five)){ echo  round($four*100/$total->total_ratings);}else{ echo "0";}?>%"
                                                                                aria-valuenow="100" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td width="20%" class="align-middle">
                                                                    <div class="user-rating text-muted">
                                                                        <?php if(!empty($five) && !empty($five)){ echo  round($four*100/$total->total_ratings);}else{ echo "0";}?>%
                                                                        Rating</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="10%" class="align-middle">
                                                                    <div class="rating-quantity">
                                                                        3 <i class="fas fa-star text-warning"></i>
                                                                    </div>
                                                                </td>
                                                                <td width="70%" class="align-middle">
                                                                    <div class="rating-percent">
                                                                        <div class="progress">
                                                                            <div class="progress-bar bg-warning progress-bar-striped"
                                                                                role="progressbar"
                                                                                style="width: <?php if(!empty($five) && !empty($five)){  echo   round($three*100/$total->total_ratings);}else{ echo "0";}?>%"
                                                                                aria-valuenow="60" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td width="20%" class="align-middle">
                                                                    <div class="user-rating text-muted">
                                                                        <?php  if(!empty($five) && !empty($five)){ echo   round($three*100/$total->total_ratings);}else{ echo "0";}?>%
                                                                        Rating</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="10%" class="align-middle">
                                                                    <div class="rating-quantity">
                                                                        2 <i class="fas fa-star text-warning"></i>
                                                                    </div>
                                                                </td>
                                                                <td width="70%" class="align-middle">
                                                                    <div class="rating-percent">
                                                                        <div class="progress">
                                                                            <div class="progress-bar bg-warning progress-bar-striped"
                                                                                role="progressbar"
                                                                                style="width: <?php if(!empty($five) && !empty($five)){ echo  round($two*100/$total->total_ratings);}else{ echo "0";}?>%"
                                                                                aria-valuenow="40" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td width="20%" class="align-middle">
                                                                    <div class="user-rating text-muted">
                                                                        <?php  if(!empty($five) && !empty($five)){ echo  round($two*100/$total->total_ratings);}else{ echo "0";}?>%
                                                                        Rating</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="10%" class="align-middle">
                                                                    <div class="rating-quantity">
                                                                        1 <i class="fas fa-star text-warning"></i>
                                                                    </div>
                                                                </td>
                                                                <td width="70%" class="align-middle">
                                                                    <div class="rating-percent">
                                                                        <div class="progress">
                                                                            <div class="progress-bar bg-warning progress-bar-striped"
                                                                                role="progressbar"
                                                                                style="width: <?php  if(!empty($five) && !empty($five)){ echo round($one*100/$total->total_ratings);}else{ echo "0";}?>%"
                                                                                aria-valuenow="20" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td width="20%" class="align-middle">
                                                                    <div class="user-rating text-muted">
                                                                        <?php if(!empty($five) && !empty($five)){echo  round($one*100/$total->total_ratings);}else{ echo "0";}?>%
                                                                        Rating</div>
                                                                </td>
                                                            </tr>
                                                        </tbody> -->
                                                        <tbody>
                                                            <tr>
                                                                <td width="70%" class="align-middle">
                                                                    <div class="rating-percent">
                                                                        <div class="progress">
                                                                            <div class="progress-bar bg-warning progress-bar-striped"
                                                                                role="progressbar"
                                                                                style="width: <?php  echo (($fivecount?$fivecount:0)*100)/($totalRating?$totalRating:1);//if(!empty($total->total_ratings)){echo round($five*100/$total->total_ratings);}?>%"
                                                                                aria-valuenow="100" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td width="10%" class="align-middle">
                                                                    <div class="rating-quantity">
                                                                        <i class="fas fa-star text-warning fs-4"></i>
                                                                        <i class="fas fa-star text-warning fs-4"></i>
                                                                        <i class="fas fa-star text-warning fs-4"></i>
                                                                        <i class="fas fa-star text-warning fs-4"></i>
                                                                        <i class="fas fa-star text-warning fs-4"></i>
                                                                    </div>
                                                                </td>
                                                                <td width="20%" class="align-middle">
                                                                    <div class="user-rating text-muted">
                                                                        <?php echo number_format((($fivecount?$fivecount:0)*100)/($totalRating?$totalRating:1),2);//if(!empty($total->total_ratings)){  echo round($five*100/$total->total_ratings);}?>%
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="70%" class="align-middle">
                                                                    <div class="rating-percent">
                                                                        <div class="progress">
                                                                            <div class="progress-bar bg-warning progress-bar-striped"
                                                                                role="progressbar"
                                                                                style="width: <?php  echo number_format((($fourcount?$fourcount:0)*100)/($totalRating?$totalRating:1),2);//if(!empty($total->total_ratings)){ echo round($four*100/$total->total_ratings);}?>%"
                                                                                aria-valuenow="100" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td width="10%" class="align-middle">
                                                                    <div class="rating-quantity">
                                                                        <i class="fas fa-star text-warning fs-4"></i>
                                                                        <i class="fas fa-star text-warning fs-4"></i>
                                                                        <i class="fas fa-star text-warning fs-4"></i>
                                                                        <i class="fas fa-star text-warning fs-4"></i>
                                                                        <i class="fas fa-star fs-4"
                                                                            style="color:#ffe6ad;"></i>
                                                                    </div>
                                                                </td>
                                                                <td width="20%" class="align-middle">
                                                                    <div class="user-rating text-muted">
                                                                        <?php echo number_format((($fourcount?$fourcount:0)*100)/($totalRating?$totalRating:1),2);//if(!empty($total->total_ratings)){ echo round($four*100/$total->total_ratings);}?>%
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="70%" class="align-middle">
                                                                    <div class="rating-percent">
                                                                        <div class="progress">
                                                                            <div class="progress-bar bg-warning progress-bar-striped"
                                                                                role="progressbar"
                                                                                style="width: <?php echo number_format((($threecount?$threecount:0)*100)/($totalRating?$totalRating:1),2);//if(!empty($total->total_ratings)){ echo round($three*100/$total->total_ratings);}?>%"
                                                                                aria-valuenow="60" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td width="10%" class="align-middle">
                                                                    <div class="rating-quantity">
                                                                        <i class="fas fa-star text-warning fs-4"></i>
                                                                        <i class="fas fa-star text-warning fs-4"></i>
                                                                        <i class="fas fa-star text-warning fs-4"></i>
                                                                        <i class="fas fa-star fs-4"
                                                                            style="color:#ffe6ad;"></i>
                                                                        <i class="fas fa-star fs-4"
                                                                            style="color:#ffe6ad;"></i>
                                                                    </div>
                                                                </td>
                                                                <td width="20%" class="align-middle">
                                                                    <div class="user-rating text-muted">
                                                                        <?php echo number_format((($threecount?$threecount:0)*100)/($totalRating?$totalRating:1),2);//if(!empty($total->total_ratings)){ echo round($three*100/$total->total_ratings);}?>%
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="70%" class="align-middle">
                                                                    <div class="rating-percent">
                                                                        <div class="progress">
                                                                            <div class="progress-bar bg-warning progress-bar-striped"
                                                                                role="progressbar"
                                                                                style="width: <?php echo number_format((($twocount?$twocount:0)*100)/($totalRating?$totalRating:1),2);//if(!empty($total->total_ratings)){echo round($two*100/$total->total_ratings);}?>%"
                                                                                aria-valuenow="40" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td width="10%" class="align-middle">
                                                                    <div class="rating-quantity">
                                                                        <i class="fas fa-star text-warning fs-4"></i>
                                                                        <i class="fas fa-star text-warning fs-4"></i>
                                                                        <i class="fas fa-star fs-4 "
                                                                            style="color:#ffe6ad;"></i>
                                                                        <i class="fas fa-star fs-4 "
                                                                            style="color:#ffe6ad;"></i>
                                                                        <i class="fas fa-star fs-4 "
                                                                            style="color:#ffe6ad;"></i>
                                                                    </div>
                                                                </td>
                                                                <td width="20%" class="align-middle">
                                                                    <div class="user-rating text-muted">
                                                                        <?php echo number_format((($twocount?$twocount:0)*100)/($totalRating?$totalRating:1),2); //if(!empty($total->total_ratings)){ echo round($two*100/$total->total_ratings);}?>%
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="70%" class="align-middle">
                                                                    <div class="rating-percent">
                                                                        <div class="progress">
                                                                            <div class="progress-bar bg-warning progress-bar-striped"
                                                                                role="progressbar"
                                                                                style="width: <?php echo number_format((($onecount?$onecount:0)*100)/($totalRating?$totalRating:1),2);//if(!empty($total->total_ratings)){echo  round($one*100/$total->total_ratings);}?>%"
                                                                                aria-valuenow="20" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td width="10%" class="align-middle">
                                                                    <div class="rating-quantity">
                                                                        <i class="fas fa-star text-warning fs-4"
                                                                            style="color:#ffe6ad;"></i>
                                                                        <i class="fas fa-star fs-4"
                                                                            style="color:#ffe6ad;"></i>
                                                                        <i class="fas fa-star fs-4"
                                                                            style="color:#ffe6ad;"></i>
                                                                        <i class="fas fa-star fs-4"
                                                                            style="color:#ffe6ad;"></i>
                                                                        <i class="fas fa-star fs-4"
                                                                            style="color:#ffe6ad;"></i>
                                                                    </div>
                                                                </td>
                                                                <td width="20%" class="align-middle">
                                                                    <div class="user-rating text-muted">
                                                                        <?php echo number_format((($onecount?$onecount:0)*100)/($totalRating?$totalRating:1),2);//if(!empty($total->total_ratings)){ echo  round($one*100/$total->total_ratings);}?>%
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                        // rating_review
                                 
                                        foreach ($rating_review as $review) {
                                            
                                        ?>
                                        <div class="card-footer bg-white p-4">
                                            <div class="row">
                                                <div class="col-12 col-sm-auto">
                                                    <div class="avatar d-flex align-items-center">
                                                        <div class="avatar-img me-3">
                                                            <img src="<?php echo base_url(html_escape(($review->picture) ? "$review->picture" : 'application/modules/frontend/views/themes/'.html_escape(get_activethemes()->name).'/assets/img/default.png')); ?>"
                                                                alt="">
                                                        </div>
                                                        <div class="avatar-text">
                                                            <h5 class="avatar-name mb-1">
                                                                <?php echo (!empty($review->name) ? $review->name : ''); ?>
                                                            </h5>
                                                            <div class="avatar-designation text-muted">

                                                                <?php
                                                                $last_activatiy=strtotime($review->review_date) ;
                                                                $current_time=strtotime(date('Y-m-d H:i:s'));
                                                                $time_diff=$current_time-$last_activatiy;
                                                                $sec     =  $time_diff;
                                                                $min     = round($time_diff / 60 );
                                                                $hrs     = round($time_diff  / 3600);
                                                                $days    = round($time_diff / 86400 );
                                                                $weeks   = round( $time_diff / 604800);
                                                                $mnths   = round( $time_diff / 2600640 );
                                                                $yrs     = round( $time_diff / 31207680 );
                                                                
                                                                

                                                                if($sec <= 60) {
                                                            echo "$sec seconds ago";
                                                                }else if($min <= 60) {
                                                                if($min==1) {
                                                                echo "one minute ago";
                                                                }
                                                                else {
                                                                echo "$min minutes ago";
                                                                }
                                                                }
                                                                // Check for hours
                                                                else if($hrs <= 24) {
                                                                if($hrs == 1) {
                                                                echo "an hour ago";
                                                                }
                                                                else {
                                                                echo "$hrs hours ago";
                                                                }
                                                                }
                                                                // Check for days
                                                                else if($days <= 7) {
                                                                if($days == 1) {
                                                                echo "Yesterday";
                                                                }
                                                                else {
                                                                echo "$days days ago";
                                                                }
                                                                }
                                                                // Check for weeks
                                                                else if($weeks <= 4.3) {
                                                                if($weeks == 1) {
                                                                echo "a week ago";
                                                                }
                                                                else {
                                                                echo "$weeks weeks ago";
                                                                }
                                                                }
                                                                // Check for months
                                                                else if($mnths <= 12) {
                                                                if($mnths == 1) {
                                                                echo "a month ago";
                                                                }
                                                                else {
                                                                echo "$mnths months ago";
                                                                }
                                                                }
                                                                // Check for years
                                                                else {
                                                                if($yrs == 1) {
                                                                echo "one year ago";
                                                                }
                                                                else {
                                                                echo "$yrs years ago";
                                                                }
                                                                }
                                                                ?>

                                                            </div>
                                                            <div><?php if($review->rating==1){?>
                                                                <i class="fas fa-star text-warning"></i>
                                                                <?php }elseif($review->rating==2){ ?>
                                                                <i class="fas fa-star text-warning"></i>
                                                                <i class="fas fa-star text-warning"></i>
                                                                <?php }elseif($review->rating==3){ ?>
                                                                <i class="fas fa-star text-warning"></i>
                                                                <i class="fas fa-star text-warning"></i>
                                                                <i class="fas fa-star text-warning"></i>
                                                                <?php }elseif($review->rating==4){ ?>
                                                                <i class="fas fa-star text-warning"></i>
                                                                <i class="fas fa-star text-warning"></i>
                                                                <i class="fas fa-star text-warning"></i>
                                                                <i class="fas fa-star text-warning"></i>
                                                                <?php }else{ ?>
                                                                <i class="fas fa-star text-warning"></i>
                                                                <i class="fas fa-star text-warning"></i>
                                                                <i class="fas fa-star text-warning"></i>
                                                                <i class="fas fa-star text-warning"></i>
                                                                <i class="fas fa-star text-warning"></i>
                                                                <?php }?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col mt-3 mt-sm-0">
                                                    <p><?php echo (!empty($review->comments) ? $review->comments : ''); ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                            <!--End Feedback-->
                        </div>

                        <div class="tab-pane fade" id="notesTab" role="tabpanel" aria-labelledby="notes-tab">
                            <!--Start card-->
                            <div class="card border-0 rounded-0 shadow-sm" id="overview">
                                <div class="card-body p-4 p-xl-5">
                                    <!-- Create the editor container -->
                                    <!-- <div id="editor"></div> -->
                                    <!--<input type="text" name="notes" id="editor">-->
                                    <textarea name="content" id="editor"></textarea>
                                    <div class="d-sm-flex align-items-center justify-content-between mt-3">
                                        <!-- <span class="mb-2 d-block mb-sm-0 notecount-area">
                                            <?php  echo count($get_coursenotes). ' Notes taken '; ?>
                                        </span> -->
                                        <span class="mb-2 d-block mb-sm-0">
                                            &nbsp
                                        </span>
                                        <div class="d-flex">
                                            <button type="button" onclick="" id="getdata"
                                                class="btn btn-outline-dark-cerulean rounded-0">Save note</button>
                                        </div>
                                    </div>
                                    <!--Start Filter-->
                                    <!-- <div class="text-sm-end mt-5">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                SORT BY
                                            </li>
                                            <li class="list-inline-item">
                                                <select class="form-select rounded-0"
                                                    aria-label="Default select example">
                                                    <option selected="">All Lectures</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </li>
                                            <li class="list-inline-item">
                                                <select class="form-select rounded-0"
                                                    aria-label="Default select example">
                                                    <option selected="">Short by most recent</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </li>
                                        </ul>
                                    </div> -->
                                    <!--End Filter-->
                                    <!--Start Notes Accordion-->
                                    <div class="mt-3" id="loadnotes">
                                        <table class="table table-striped table-borderless mb-0">
                                            <tbody>
                                                <?php
                                                if ($get_coursenotes) {
                                                    foreach ($get_coursenotes as $notes) {
                                                ?>
                                                <tr id="notedivreload_<?php echo $notes->id;?>">
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="notes-play-icon me-2">
                                                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/notes.svg'); ?>"
                                                                    alt="" style="width: 70%;">
                                                            </div>
                                                            <div>
                                                                <h6 class="fs-15 mb-1">
                                                                    <?php echo (!empty($notes->notes) ? $notes->notes : ''); ?>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle" width="80">
                                                        <a href="javascrip:void(0)"
                                                            onclick="noteedit('<?php echo $notes->id; ?>')"
                                                            class="d-flex align-items-center justify-content-end text-primary">
                                                            <i class="fas fa-edit"> </i>
                                                            <span class="ms-2"><?php echo display('edit'); ?></span>
                                                        </a>
                                                    </td>
                                                    <td class="align-middle" width="80">
                                                        <a href="javascrip:void(0)"
                                                            onclick="notedelete('<?php echo $notes->id; ?>')"
                                                            class="d-flex align-items-center justify-content-end text-danger">
                                                            <i class="fas fa-trash"> </i>
                                                            <span class="ms-2"><?php echo display('delete'); ?></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                                                }
                                                            }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!--End Notes Accordion-->
                                </div>
                            </div>
                            <!--End card-->

                            <!-- The Modal -->
                            <div class="modal fade" id="modal_info" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title modal_ttl"></h5>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body" id="info">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="quizprojectTab" role="tabpanel"
                            aria-labelledby="quizproject-tab">
                            <!--Start card-->
                            <div class="card border-0 rounded-0 shadow-sm quiz-project-scroll" id="overview">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-borderless mb-0 border">
                                            <thead>
                                                <tr style="font-size: 13px;">
                                                    <th>Quiz<?php //echo $user_id; ?></th>
                                                    <th>Q&amp;A</th>
                                                    <th>Correct</th>
                                                    <th>Incorrect</th>
                                                    <th>Skipped</th>
                                                    <th>Time</th>
                                                    <th>Score</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($get_courseexams){
                                                    $q=0;
                                                    foreach($get_courseexams as $courseexam){
                                                    $q++;
                                                    $get_examresults = $this->Frontend_model->get_examresults($user_id, $course_id, $courseexam->exam_id);
                                                    // d($get_examresults);
                                                    if($get_examresults){
                                            
                                                        //            ===================
                                                        $exam_set = json_decode($get_examresults->exam_set);
                                                        $questionmarks = json_decode($get_examresults->questionmarks);
                
                                                        $qst_count = $marks = $givennotans = $givenmcqqstcount = $shortqstcount = 0;
                                                        $givenoption_array = array();
                
                                                        foreach ($exam_set as $single) {
                                                            $question_info = $this->Frontend_model->get_questionedit($single->question_id);
                                                            // d($question_info);
                                                            $qst_count += 1;
                                                            $marks += (!empty($question_info->question_mark) ? $question_info->question_mark : 0);
                
                                                            if ($single->given_ans == NULL && $single->shortanswers == '') {
                                                                $givennotans += 1;
                                                            }
                
                                                            if ($single->given_ans) {
                                                                $givenmcqqstcount += 1;
                                                            }
                                                            if ($single->shortanswers) {
                                                                $shortqstcount += 1;
                                                            }
                
                                                            $givenoption_array[] = $single->given_ans;
                                                            $givenoption_array[] = $single->question_type;
                                                        }
                
                                                        if ($questionmarks) {
                                                            $questionid_array = array();
                                                            $questionmark_array = array();
                                                            foreach ($questionmarks as $qstmarks) {
                                                                $questionid_array[] = $qstmarks->question_id;
                                                                $questionmark_array[] = $qstmarks->marks;
                                                            }
                                                            $data['questionmarks_combinedarr'] = array_combine($questionid_array, $questionmark_array);
                                                        }
                
                                                        $data['marks'] = $marks;
                                                        $data['qst_count'] = $qst_count;
                                            //            $data['givenoption_array'] = $givenoption_array;
                
                                                        $radio_right = 0;
                                                        $checkbox_right = 0;
                                                        $shortans_right = 0;
                                                        $checkbox_correctcount = 0;
                                                        $radio_correctcount = 0;
                                                        $shortqst_correctcount = 0;
                
                                                        foreach ($exam_set as $sing) {
                                                            $question_info = $this->Frontend_model->get_questionedit($sing->question_id);
                                                            $get_questionwiseoption = get_questionwiseoption($sing->question_id);
                                                            
                                                            if ($sing->question_type == 1) {
                                                                $answer_name = get_answername($sing->question_id);
                
                                                                foreach ($get_questionwiseoption as $option) {
                                                                    foreach ($givenoption_array as $given) {
                                                                        if ($given == $option->option_id && $option->is_answer == 1) {
                                                                            $radio_right += $question_info->question_mark;
                                                                            $radio_correctcount += 1;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                            //
                                                            if ($sing->question_type == 2) {
                                                                $answer_name = get_answername($sing->question_id);
                
                                                                foreach ($get_questionwiseoption as $option) {
                                                                    if ($sing->question_id == $option->question_id) {
                                                                        $givenans = '';
                                                                        foreach ($exam_set as $given) {
                                                                            if ($given->question_type == 2 && $option->question_id == $given->question_id) {
                                                                                $givenans .= $given->given_ans;
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                $checkbox_anschk = '';
                                                                foreach ($answer_name as $ans) {
                                                                    $checkbox_anschk .= $ans->option_id . ',';
                                                                }
                                                                if ($givenans == rtrim($checkbox_anschk, ", ")) {
                                                                    $checkbox_right += $question_info->question_mark;
                                                                    $checkbox_correctcount += 1;
                                                                }
                                                            }
                                            //
                                                            if ($sing->question_type == 3) {
                                                                if ($sing->question_type == 3) {
                                                                    if((!empty($question_info->shortanswer) ? $question_info->shortanswer : '') == $sing->shortanswers){
                                                                        $shortqst_correctcount += 1;
                                                                        $shortans_right = $question_info->question_mark;
                                                                    }
                                                                }
                                                                // d($question_info);
                                                                // echo $question_info->shortanswer."<br>";
                                                                // echo $sing->shortanswers; 
                                                                // foreach ($exam_set as $shortans) {
                                                                //     if ($shortans->question_type == 3 && $single->question_id == $shortans->question_id) {
                                                                //         $shortqst_correctcount += 1;
                                                                //     }
                                                                // echo $shortans->shortanswers; 
                                                                // }
                                                            }
                                                        }
                
                                                        $totalcorrectans_count = $checkbox_correctcount + $radio_correctcount + $shortqst_correctcount;
                                                        $totalrightans_marks = $checkbox_right + $radio_right + $shortans_right;
                
                                            //            ============= right ans ===========
                                                        $correctans = $totalcorrectans_count;
                                                        $rightans = (!empty($correctans) ? $correctans : 0);
                                                        //            ============= right ans ===========
                
                                            //          ============== wrong ans ============
                                                        // d($shortqst_correctcount);
                                                        // d($givenmcqqstcount);
                                                        // d($totalcorrectans_count);
                                                        $wrongans = (($givenmcqqstcount+$shortqstcount) - $totalcorrectans_count);
                                                        $wrong_ans = $wrongans; //(!empty($wrongans) ? $wrongans : 0);
                                                        if ($wrong_ans < 0) {
                                                            $wrong_ans = 0;
                                                        } else {
                                                            $wrong_ans = $wrong_ans;
                                                        }
                                                        $wrongnumbers = 0; //$wrongans * $exam->negative_mark;
                                                        //          ============== wrong ans ============
                
                                                        $total_mark = $totalrightans_marks;
                
                                                                    
                                                        //          ============== total marks============
                                                        //          ============== obtained marks============
                                                        if ($correctans == 0) {
                                                            $obtainedmarks = 0;
                                                        } else {
                                                            $obtainedmarks = $total_mark - $wrongnumbers;
                                                            if ($obtainedmarks < 0) {
                                                                $obtainedmarks = 0;
                                                            } else {
                                                                $obtainedmarks = $obtainedmarks;
                                                            }
                                                        }
                            //          ============== obtained marks============
                                                        }
                                                    ?>

                                                <?php if($get_examresults){ ?>
                                                <tr>
                                                    <th><?php echo (!empty($courseexam->exam_name) ? $courseexam->exam_name : ''); ?>
                                                    </th>
                                                    <td><?php echo $get_examresults->total_question; ?>/<?php echo $get_examresults->total_answered; ?>
                                                    </td>
                                                    <td>
                                                        <?php //d($exam_set); 
                                                        echo (!empty($rightans) ? $rightans : 0); 
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php echo (!empty($wrong_ans) ? $wrong_ans : 0); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $ttl_unanswered = $get_examresults->total_question-$get_examresults->total_answered; ?>
                                                    </td>
                                                    <td><?php echo $get_examresults->duration; ?></td>
                                                    <?php         
                                                        $correct_statusbar = $wrong_statusbar = $unanswered_statusbar = 0;
                                                        if($obtainedmarks > 0){
                                                            $percentagescore = (($obtainedmarks*100)/$marks); 
                                                        }
                                                        // $percentagescore = (($obtainedmarks*100)/$marks);
                                                        $totalstatus = $rightans+$wrong_ans+$ttl_unanswered;
                                                        $correct_statusbar = ($totalstatus-($wrong_ans+$ttl_unanswered));
                                                        $wrong_statusbar = ($totalstatus-($rightans+$ttl_unanswered));
                                                        $unanswered_statusbar = ($totalstatus-($rightans+$wrong_ans));
                                                    ?>
                                                    <!-- <td>
                                                        <div class="progress">
                                                            <div class="progress-bar"
                                                                style="width:<?php //echo $correct_statusbar*100; ?>%; background-color: #07c145;">
                                                            </div>
                                                            <div class="progress-bar"
                                                                style="width:<?php //echo $wrong_statusbar*100; ?>%; background-color: #EF4444;">
                                                            </div>
                                                            <div class="progress-bar bg-hash"
                                                                style="width:<?php //echo $unanswered_statusbar*100; ?>%">
                                                            </div>
                                                        </div>
                                                        <?php  
                                                       // $percentage = number_format($percentagescore);
                                                        //if($percentage == 'nan'){ ?>
                                                        <span class="fs-15" style="color : #FF9900">
                                                            <i class="fas fa-info"></i>
                                                            Incomplete
                                                        </span>
                                                        <?php //}else{
                                                            //echo $percentage.'%'; 
                                                            //if($obtainedmarks >= $courseexam->pass_mark){ ?>
                                                        <span class="fs-15" style="color : #07c145">
                                                            <i class="fas fa-check-circle"></i>
                                                            <?php  //echo ' Passed'; ?>
                                                        </span>
                                                        <?php //}else{ ?>
                                                        <span class="fs-15" style="color : #EF4444">
                                                            <i class="far fa-times-circle"></i>
                                                            <?php  //echo ' Failed'; ?>
                                                        </span>
                                                        <?php //} 
                                                        //}
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                       // if($percentage == 'nan'){ ?>
                                                        <a href="<?php //echo base_url($enterprise_shortname.'/show-quizform/'.$courseexam->course_id.'/'. $courseexam->exam_id); ?>"
                                                            class="btn btn-sm"
                                                            style="background-color: #FF9900; ">Continue</a>
                                                        <?php //}else{ ?>
                                                        <?php //if($obtainedmarks >= $courseexam->pass_mark){ ?>
                                                        <span class="badge fs-15" style="background-color: #07c145;">
                                                            <?php  //echo 'Done'; ?>
                                                        </span>
                                                        <?php //}else{?>
                                                        <a href="<?php //echo base_url($enterprise_shortname.'/show-quizform/'.$courseexam->course_id.'/'. $courseexam->exam_id); ?>"
                                                            class="btn btn-sm btn-danger">Re-take</a>
                                                        <?php //} 
                                                      //  } ?>
                                                    </td> -->
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-success"
                                                                style="width:<?php echo $correct_statusbar*100; ?>%">
                                                            </div>
                                                            <div class="progress-bar bg-danger"
                                                                style="width:<?php echo $wrong_statusbar*100; ?>%">
                                                            </div>
                                                            <div class="progress-bar bg-hash"
                                                                style="width:<?php echo $unanswered_statusbar*100; ?>%">
                                                            </div>
                                                        </div>
                                                        <?php 
                                                        $percentage = number_format($percentagescore);
                                                        if($percentage == 'nan'){ ?>
                                                        <span class="badge bg-warning fs-15">
                                                            <!-- <i class="fas fa-info"></i> -->
                                                            Incomplete
                                                        </span>
                                                        <?php }else{
                                                            echo $percentage.'%'; 
                                                            if($obtainedmarks >= $courseexam->pass_mark){ ?>
                                                        <span class="fs-15" style="color : #07c145">
                                                            <i class="fas fa-check-circle"></i>
                                                            <?php  echo ' Passed'; ?>
                                                        </span>
                                                        <?php }else{ ?>
                                                        <span class="fs-15" style="color : #EF4444">
                                                            <i class="far fa-times-circle"></i>
                                                            <?php  echo ' Failed'; ?>
                                                        </span>
                                                        <?php } 
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <?php 
                                                                if($obtainedmarks >= $courseexam->pass_mark){
                                                                ?>
                                                            <?php if($get_examresults->is_done != 1){ ?>
                                                            <button type="button" class="btn btn-sm btn-success"
                                                                onclick="examDonestatus('<?php echo $get_examresults->questionexam_id?>')">Done</button>
                                                            <?php }else{ ?>
                                                            <!-- <button type="button" class="btn btn-sm btn-success">Completed</button> -->
                                                            <span
                                                                class="badge bg-success me-1 p-2 fw-bold">Completed</span>
                                                            <?php } ?>
                                                            <?php }else{ ?>
                                                            <a href="<?php echo base_url($enterprise_shortname.'/show-quizform/'.$course_id.'/'. $courseexam->exam_id); ?>"
                                                                class="btn btn-sm btn-danger">Re-take</a>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php }else{ ?>
                                                <tr>
                                                    <th><?php echo (!empty($courseexam->exam_name) ? $courseexam->exam_name : ''); ?>
                                                    </th>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>
                                                        <span class="badge bg-warning fs-15">
                                                            <!-- <i class="fas fa-info"></i> -->
                                                            Incomplete
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo base_url($enterprise_shortname.'/show-quizform/'.$course_id.'/'. $courseexam->exam_id); ?>"
                                                            class="btn btn-sm btn-primary">Start</a>
                                                    </td>
                                                </tr>
                                                <?php 
                                                    }
                                                }
                                            }else{ ?>
                                                <tr>
                                                    <th colspan='10' class='text-center text-danger'>Record not found!
                                                    </th>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-borderless mb-0 border">
                                            <thead>
                                                <tr style="font-size: 13px;">
                                                    <th>Project</th>
                                                    <th>Category</th>
                                                    <th>Mark Base 1</th>
                                                    <th>Mark Base 2</th>
                                                    <th>Mark Base 3</th>
                                                    <th>Mark Base 4</th>
                                                    <th>Total Mark</th>
                                                    <th>Detail info & Instructions</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($get_assignmentprojectlist){
                                                    foreach($get_assignmentprojectlist as $project){
                                                        $projectmarks = $this->Frontend_model->get_projectmarks($project->assignment_id);
                                                        $get_studentassignmentproject = $this->Frontend_model->get_studentassignmentproject($user_id, $project->assignment_id);
                                                        // d($get_studentassignmentproject);
                                                    ?>
                                                <tr>
                                                    <td><?php echo (!empty($project->title) ? $project->title : ''); ?>
                                                    </td>
                                                    <td><?php echo (($project->category == 1) ? "Chapter Project" : 'Final Project'); ?>
                                                    </td>
                                                    <?php
                                                        $p = 0;
                                                        $countproject = count($projectmarks);  
                                                                                                              
                                                        foreach($projectmarks as $marks){
                                                       $p++;                                                    
                                                         ?>
                                                    <td>
                                                        <?php echo (!empty($marks->marks) ? $marks->marks : ''); ?>
                                                    </td>
                                                    <?php }
                                                    if($countproject<4){ 
                                                       $totalrow= 4-$countproject;
                                                        for($k=1;$k<=$totalrow;$k++){
                                                    ?>
                                                    <td></td>

                                                    <?php 
                                                    }
                                                 } 
                                                 ?>
                                                    <td class="fw-black">
                                                        <?php echo (!empty($project->project_mark) ? $project->project_mark : ''); ?>
                                                    </td>
                                                    <td class="fw-black">
                                                        <button class="btn btn-sm btn-primary" onclick="showassignmentDetails('<?php echo $project->assignment_id; ?>')">View</button>
                                                    </td>
                                                    <td>
                                                        <?php if(empty($get_studentassignmentproject)){ ?>
                                                        <span class="badge text-warning fs-15">Incomplete</span>
                                                        <?php }elseif($get_studentassignmentproject->project_status == 1){  ?>
                                                        <span class="badge text-success fs-15">Approved</span>
                                                        <?php }elseif($get_studentassignmentproject->project_status == 2){  ?>
                                                        <span class="badge text-danger fs-15">Not Approved</span>
                                                        <?php }else{ ?>
                                                        <span class="badge text-primary fs-15">Not Review</span>
                                                        <?php  } ?>
                                                    </td>
                                                    <td>
                                                        <?php if(empty($get_studentassignmentproject)){ ?>
                                                        <a href="<?php echo base_url($enterprise_shortname.'/student-add-project/'.$project->assignment_id); ?>"
                                                            class="btn btn-warning btn-sm text-white"
                                                            title="Edit">Edit</a>
                                                        <?php }elseif($get_studentassignmentproject->project_status == 1){ ?>
                                                        <span class="badge bg-success fs-15">Done</span>
                                                        <?php }elseif($get_studentassignmentproject->project_status == 2){ ?>
                                                        <a href="<?php echo base_url($enterprise_shortname.'/student-project-edit/'.$get_studentassignmentproject->project_id); ?>"
                                                            class="btn btn-warning btn-sm text-white"
                                                            title="Edit">Edit</a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php 
                                            }
                                             }else{ ?>
                                                <tr>
                                                    <th colspan='10' class='text-center text-danger'>Record not found!
                                                    </th>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--End card-->
                        </div>

                        <div class="tab-pane fade" id="progressTab" role="tabpanel" aria-labelledby="progress-tab">
                            <div class="row g-3">
                                <div class="col-md-6 d-flex">
                                    <!--Start card-->
                                    <div class="card border-0 rounded-0 shadow-sm flex-fill w-100">
                                        <div class="card-body p-4">
                                            <!--Start Section Header-->
                                            <div class="section-header mb-4">
                                                <h4 class="h5">Course Completion</h4>
                                                <div class="section-header_divider"></div>
                                            </div>
                                            <!--End Section Header-->
                                            <div class="d-flex align-items-center">
                                                <!--Start Donut Chart-->

                                                <input type="hidden" id="percent" value="<?php echo number_format($TotalProgress);?>">
                                                <section class="chart me-3" id="chartContainer">
                                                    <figure class="chart__figure">
                                                        <canvas class="chart__canvas" id="chartCanvas" width="160"
                                                            height="160"
                                                            aria-label="Example doughnut chart showing data as a percentage"
                                                            role="img"></canvas>
                                                    </figure>
                                                </section>
                                                <!--End Donut Chart-->
                                                <div class="chart-legend">
                                                    <div class="chart-legend-item d-flex align-items-center my-2">
                                                        <div class="chart-legend-color me-2 bg-dark-cerulean"></div>
                                                        <p class="mb-0 fw-medium">Course Complete</p>
                                                    </div>
                                                    <div class="chart-legend-item d-flex align-items-center my-2">
                                                        <div class="chart-legend-color me-2 kelly-green2"></div>
                                                        <p class="mb-0 fw-medium">Course Incomplete</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End card-->
                                </div>
                                <div class="col-md-6 d-flex">
                                    <!--Start card-->
                                    <div class="card border-0 rounded-0 shadow-sm flex-fill w-100">
                                        <div class="card-body p-4">
                                            <div class="row g-2 mb-3">
                                                <div class="col-8">
                                                    <!--Start Section Header-->
                                                    <div class="section-header mb-4">
                                                        <h4 class="h5">Grades</h4>
                                                        <div class="section-header_divider"></div>
                                                    </div>
                                                    <!--End Section Header-->
                                                    <h5>Your Final Grade :<?php echo number_format($TotalProgress);?>%
                                                    </h5>
                                                    <?php if($get_coursedetails->passing_grade){?> <p>Passing Grade :
                                                        <?php echo $get_coursedetails->passing_grade;?>%</p><?php }?>
                                                </div>
                                                <div class="col-4">
                                                    <img src="assets/img/trophy.png" alt="" class="img-fluid">
                                                </div>
                                            </div>
                                            <p class="text-muted mb-0">Great Job on this course one of the most
                                                important <span class="text-navy-blue">You got 19/20 in
                                                    assignment</span> optimizing a website and strategically using
                                                keywords can yield visitors for years.</p>
                                        </div>
                                    </div>
                                    <!--End card-->
                                </div>
                                <div class="col-md-12">
                                    <!--Start card-->
                                    <div class="card border-0 rounded-0 shadow-sm mb-3">
                                        <div class="card-body p-4 p-xl-5">
                                            <!--Start Section Header-->
                                            <div class="section-header mb-4">
                                                <h4 class="h5">Earn a certificate</h4>
                                                <div class="section-header_divider"></div>
                                            </div>
                                            <!--End Section Header-->
                                            <p>Formulating a keyword strategy is one of the most important activities in
                                                marketing. Properly optimizing a website and strategically using
                                                keywords can yield visitors for years.</p>
                                            <!-- <button type="button" class="btn btn-dark-cerulean">Upgrade Now</button> -->
                                            <?php 
                                            $checkcertificate_download = $this->db->select('*')
                                                                              ->from('certificate_mapping_tbl')
                                                                              ->where('user_id', $user_id)
                                                                              ->where('course_id', $course_id)
                                                                              ->get()->row();
                                                                              
                                            $certificate = $this->db->select('certificate_id')
                                                                              ->from('course_tbl')
                                                                              ->where('course_id', $course_id)
                                                                              ->where('enterprise_id', $enterprise_id)
                                                                              ->get()->row();    
                                                                              
                                                                        
                                            ?>

                                            <?php if($TotalProgress==100){?>
                                            <?php if($checkcertificate_download){?>
                                            <button type="button" class="btn btn-dark-cerulean">Already Claimed a
                                                Certificate</button>
                                            <?php }else{ ?>
                                            <input type='hidden' value="<?php echo $certificate->certificate_id;?>"
                                                id="certificate_id">
                                            <button type="button" class="btn btn-dark-cerulean"
                                                onclick="assignedStudentCertificate()">Claim a Certificate</button>
                                            <!-- claimcertificatemodal() -->
                                            <?php }}else{?>
                                            <button type="button" class="btn btn-dark-cerulean"
                                                style="background:#ddd;border:1px solid #ddd">Claim a
                                                Certificate</button>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <!--End card-->
                                </div>
                            </div>
                            <!--Start card-->
                            <div class="card border-0 rounded-0 shadow-sm">
                                <div class="card-body p-4 p-xl-5">
                                    <!--Start Section Header-->
                                    <div class="section-header mb-4">
                                        <h4 class="h5">Grades Summary</h4>
                                        <div class="section-header_divider"></div>
                                    </div>
                                    <!--End Section Header-->
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-striped">
                                            <thead>
                                                <tr class="bg-dark-cerulean text-white">
                                                    <th class="fw-medium" width="45%">Assignment Type</th>
                                                    <th class="fw-medium">Weight</th>
                                                    <th class="fw-medium">Grade</th>
                                                    <th class="fw-medium">Weighted Grade</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>It is a long established fact that a reader will be distracted
                                                    </td>
                                                    <td>15%</td>
                                                    <td>0%</td>
                                                    <td>0%</td>
                                                </tr>
                                                <tr>
                                                    <td>There are many variations of passages of Lorem Ipsum available
                                                    </td>
                                                    <td>15%</td>
                                                    <td>0%</td>
                                                    <td>0%</td>
                                                </tr>
                                                <tr>
                                                    <td>Assignment can you sport the goal</td>
                                                    <td>15%</td>
                                                    <td>0%</td>
                                                    <td>0%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--End card-->
                        </div>
                        <div class="tab-pane fade" id="resource" role="tabpanel" aria-labelledby="resource-tab">

                            <?php //echo (!empty($get_coursedetails->related_resource) ? $get_coursedetails->related_resource : ''); ?>
                            <div class="card border-0 rounded-0 shadow-sm mb-3" id="overview">
                                <div class="card-body p-4 p-xl-5">
                                    <!--Start Section Header-->
                                    <div class="section-header mb-4">
                                        <h4 class="h5">Related Resource</h4>
                                        <div class="section-header_divider"></div>
                                    </div>
                                    <!--End Section Header-->
                                    <?php 
                                    $related_resources = json_decode($get_coursedetails->related_resource);
                                    if($related_resources[0]){
                                        ?>
                                    <ul class="mb-0 ps-4">
                                        <?php
                                                foreach ($related_resources as $related) {
                                                    ?>
                                        <li class="mb-1">
                                            <a href="<?php echo $related; ?>" target="_new"><?php echo $related; ?></a>
                                        </li>
                                        <?php
                                                }
                                            ?>
                                    </ul>
                                    <?php } ?>
                                    <div class="section-header mb-4 mt-4">
                                        <h4 class="h5">Exercise/Material</h4>
                                        <div class="section-header_divider"></div>
                                    </div>
                                    <!--End Section Header-->
                                    <div class="row">
                                        <?php 
                                        $downloadables=$this->db->select('*')->from('course_resource_tbl')->where('course_id',$course_id)->where('lesson_id',null)->where('chapter_id',null)->get()->result();
                                        if($downloadables){
                                            foreach($downloadables as $dfiles){

                                                $file_name=pathinfo($dfiles->files, PATHINFO_FILENAME);
                                  
                                                $List = explode('-f-', $file_name); 
                                         
                                        ?>

                                        <div class="mt-2 d-flex col-md-6">
                                            <?php  $ext = pathinfo($dfiles->files, PATHINFO_EXTENSION);?>
                                            <?php if($ext=='pdf'){?>
                                            <label for=""
                                                class="col-md-6 mb-2 mb-md-0 fw-bold"><?php echo $name2 =$List[1]; // file name without extension $ext;?></label>
                                            <a href="<?php echo base_url($dfiles->files); ?>" download><i
                                                    class="far fa-file-pdf fs-2 m-1"></i></a>
                                            <?php }elseif($ext =="txt"){?>
                                            <label for=""
                                                class="col-md-6 mb-2 mb-md-0 fw-bold"><?php echo $name2 =$List[1]; // file name without extension $ext;?></label>
                                            <a href="<?php echo base_url($dfiles->files); ?>" download><i
                                                    class="fa-file-alt far fs-2 m-1"></i></a>
                                            <?php }elseif($ext =="xlsx" || $ext =="xltx" || $ext =="csv" || $ext =="xls"){?>
                                            <label for=""
                                                class="col-md-6 mb-2 mb-md-0 fw-bold"><?php echo $name2 =$List[1]; // file name without extension $ext;?></label>
                                            <a href="<?php echo base_url($dfiles->files); ?>" download><i
                                                    class="far fa-file-excel fs-2 m-1"></i></a>
                                            <?php }elseif($ext =="doc" || $ext =="docx"){?>
                                            <label for=""
                                                class="col-md-6 mb-2 mb-md-0 fw-bold"><?php echo $name2 =$List[1]; // file name without extension $ext;?></label>
                                            <a href="<?php echo base_url($dfiles->files); ?>" download><i
                                                    class="far fa-file-word fs-2 m-1"></i></a>
                                            <?php }elseif($ext =="zip"){?>
                                            <label for=""
                                                class="col-md-6 mb-2 mb-md-0 fw-bold"><?php echo $name2 =$List[1]; // file name without extension $ext;?></label>
                                            <a href="<?php echo base_url($dfiles->files); ?>" download><i
                                                    class="fa-file-archive far fs-2 m-1"></i></a>
                                            <?php }else{?>
                                            <label for=""
                                                class="col-md-6 mb-2 mb-md-0 fw-bold"><?php echo $name2 =$List[1]; // file name without extension $ext;?></label>
                                            <!-- <img src="<?php echo base_url($dfiles->files);?>" class="img-fluid"
                                            width="100px">  -->
                                            <a href="<?php echo base_url($dfiles->files); ?>" download><i
                                                    class="far fa-file-image fs-2 m-1"></i></a>
                                            <?php }?>
                                        </div>
                                        <?php }}?>
                                        <p>
                                            <?php //echo htmlspecialchars_decode(!empty($get_coursedetails->description) ? $get_coursedetails->description : ''); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="discussion" role="tabpanel" aria-labelledby="discussion-tab">
                            discussion
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 px-3 px-md-0 sticky-content">
                <!--Start card-->
                <div class="card border-0 rounded-0 shadow-sm mb-0">
                    <div class="card-header d-flex align-items-center justify-content-between p-3 border-bottom-0">
                        <h5 class="mb-0">Course content</h5>
                        <a href="#notes" onClick="getallnotes()" class="d-flex align-items-center text-muted">
                            <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/notes.svg'); ?>"
                                alt=""><span class="ms-2">All Notes</span>
                        </a>
                    </div>
                    <div class="card-body p-4 p-md-3 p-lg-4 lesson-content-scroll">
                        <div class="accordion course-content_accordion" id="CourseContent">
                            <?php
                                    $coursefinalproject_assignment = '';
                                    $sl = 0;
                                    $get_sections = get_sections($course_id, $enterprise_id);
                                    foreach ($get_sections as $section) {
                                        $course_section_wise_lesson = $this->Course_model->course_section_wise_lesson($course_id, $section->section_id, $enterprise_id);
                                        $course_section_wise_assignment = $this->Course_model->course_section_wise_assignment($course_id, $section->section_id, $enterprise_id);
                                        $coursefinalproject_assignment = $this->Course_model->coursefinalproject_assignment($course_id, $enterprise_id);

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
                                <h2 class="accordion-header" id="PanelHeadingOne">
                                    <?php 
                                    $last_active_chapter= $this->db->select('section_id,lesson_id')->from("lesson_tbl")->where('lesson_id',$active_lst_lesson->last_lesson)->get()->row();
                                    $lstchpater=$last_active_chapter->section_id;
                                    ?>
                                    <button
                                        class="accordion-button text-dark <?php if(!empty($lstchpater==$section->section_id)){}else{  echo "collapsed";}?>"
                                        type="button" data-bs-toggle="collapse"
                                        data-bs-target="#section_<?php echo $sl; ?>" aria-expanded="true"
                                        aria-controls="section_<?php echo $sl; ?>">
                                        <span><?php echo html_escape($section->section_name); ?> </span> <span
                                            class="lesson-time ms-auto"><span><?php echo $lecturecount; ?>
                                                <?php echo display('lectures'); ?></span>&nbsp;•&nbsp;<span><?php echo $hours . ":" . $minutes . ":" . $seconds; ?></span></span>
                                    </button>
                                </h2>
                                <div id="section_<?php echo $sl; ?>"
                                    class="accordion-collapse collapse <?php if(!empty($lstchpater==$section->section_id)){ echo "show" ;}else{ }?>"
                                    aria-labelledby="PanelHeadingOne">
                                    <div class="accordion-body px-0 px-4 px-md-0 px-sm-0 py-3">
                                        <div class="accordion course-content_accordion--sub"
                                            id="accordionPanelsStayOpenExample">
                                            <?php 
                                            $lesson_order=0;
                                            foreach ($course_section_wise_lesson as $lesson) { 
                                                $check_lessonwatch = $this->Frontend_model->check_lessonwatch(get_userid(), $course_id, $lesson->lesson_id);
                                                ?>
                                            <div class="accordion-item border-0">
                                                <div
                                                    class="d-flex mb-3 mb-md-2 p-3 align-items-center lesson-block activeremoveclass <?php echo "lstactive_".$lesson->lesson_id ?>">
                                                    <div id="completelessonshow_<?php echo $lesson->lesson_id;?>"></div>
                                                    <?php if((!empty($check_lessonwatch->is_complete) ? $check_lessonwatch->is_complete : '0') == 1){ ?>
                                                    <i class="fas fa-check mt-1 me-1 <?php echo (empty($check_lessonwatch) ? '' : 'lesson-watch-design'); ?> activeremoveclass <?php echo "lstactive_".$lesson->lesson_id ?>" id="old_complete_icon_<?php echo $lesson->lesson_id;?>"></i>
                                                    <?php }else{
                                                        echo '<i class="mt-1 me-3" id="empty_complete_'.$lesson->lesson_id.'"></i>';
                                                        } 
                                                    ?>
                                                    <span><?php echo ++$lesson_order?>.</span>
                                                    <?php if ($lesson->lesson_type == 1) { ?>
                                                    <div class="flex-shrink-1 me-3 me-md-2 me-lg-3">
                                                        <i data-feather="play-circle" class="accordion-icon"></i>
                                                    </div>
                                                    <?php } else { ?>
                                                    <div class="flex-shrink-1 me-3 me-md-2 me-lg-3">
                                                        <i data-feather="file-text" class="accordion-icon"></i>
                                                    </div>
                                                    <?php } ?>
                                                    <div class="w-100">
                                                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                                            <button
                                                                class="py-lg-1 accordion-button fs-13 text-muted fw-normal pt-1 pb-0 px-0 collapsed"
                                                                type="button">
                                                                <?php if ($lesson->lesson_type == 1) { ?>
                                                                <a href="javascript:void(0)"
                                                                    onclick="loadcoursecontent('video', '<?php echo $lesson->lesson_id; ?>')"
                                                                    class="<?php echo (empty($check_lessonwatch) ? 'text-dark' : 'lesson-watch-design'); ?> "><?php echo html_escape($lesson->lesson_name); ?></a>
                                                                <?php } else { ?>
                                                                <a href="javascript:void(0)"
                                                                    onclick="loadcoursecontent('others', '<?php echo $lesson->lesson_id; ?>')"
                                                                    class="<?php echo (empty($check_lessonwatch) ? 'text-dark' : 'lesson-watch-design'); ?> "><?php echo html_escape($lesson->lesson_name); ?></a>
                                                                <?php } ?>
                                                                <?php if ($lesson->lesson_type == 1) { ?>
                                                                <span
                                                                    class="course-duration ms-auto <?php echo (empty($check_lessonwatch) ? '' : 'lesson-watch-design'); ?>"><?php echo html_escape($lesson->duration); ?></span>
                                                                <?php } ?>
                                                            </button>
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <!-- <h5 class="mb-0">Project/Assignment</h5> -->
                                            <!-- <ul> -->
                                            <div class="accordion-item border-0">
                                                <div class="d-flex mb-3 mb-md-2 mb-lg-3">

                                                    <?php if($course_section_wise_assignment){ 
                                                    foreach($course_section_wise_assignment as $assignment){
                                                 ?>
                                                    <div class="flex-shrink-1 me-3 me-md-2 me-lg-3">
                                                        <!-- <i data-feather="hash" class="accordion-icon"></i> -->
                                                        Project:
                                                    </div>
                                                    <div class="w-100">
                                                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                                            <button
                                                                class="accordion-button fs-13 text-muted fw-normal pt-1 pb-0 px-0 collapsed "
                                                                type="button">
                                                                <!-- <li> -->
                                                                <a class="text-dark"
                                                                    href="<?php echo base_url($enterprise_shortname.'/student-add-project/'.$assignment->assignment_id); ?>">
                                                                    <?php echo (!empty($assignment->title) ? $assignment->title : ''); ?>
                                                                </a>
                                                            </button>
                                                        </h2>
                                                    </div>
                                                    <!-- </li> -->
                                                    <?php 
                                                    } 
                                                 } 
                                                ?>
                                                    <!-- </ul> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                        </div>
                    </div>
                    <?php //if($coursefinalproject_assignment){?>
                    <!-- <div class="card-body p-4 p-md-3 fw-semi-bold">

                        <div class="d-flex align-items-center justify-content-between p-2 border-bottom-0">
                            <h6 class="mb-0">Project/Assignment</h6>
                        </div>
                        <?php //if($coursefinalproject_assignment){ 
                        //foreach($coursefinalproject_assignment as $finalassignment){                            
                            ?>
                        <div class="form-check mb-0">
                            <a class="text-dark"
                                href="<?php //echo base_url($enterprise_shortname.'/student-add-project/'.$finalassignment->assignment_id); ?>">
                                <i data-feather="hash" class="accordion-icon"></i>
                                <?php //echo (!empty($finalassignment->title) ? $finalassignment->title : ''); ?>
                            </a>
                        </div>
                        <?php
                           // }
                         //} 
                            ?>
                    </div> -->
                    <?php //} ?>
                    <?php //if($get_coursequiz){?>
                    <!-- <div class="card-body  p-md-3">
                        <div class="d-flex align-items-center justify-content-between p-2 border-bottom-0">
                            <h6 class="mb-0">Quiz</h6>
                        </div>
                        <?php
                        //$q=0;
                        //$s=0;
                        // foreach($get_coursequiz as $quiz){ 
                          //  $check_coursequiz = $this->Frontend_model->check_coursequiz($user_id, $course_id, $quiz->exam_id);
                         //   $q++;
                          //  if($check_coursequiz){
                            ?>
                        <div class="form-check mb-0">
                            <?php //echo ++$s;?>.
                            <a href="javascript:void(0)" class="form-check-label fw-semi-bold text-dark"
                                onclick="get_studentexamshow('<?php //echo $user_id; ?>', '<?php //echo $course_id; ?>', '<?php //echo $check_coursequiz->questionexam_id; ?>')">
                                <?php //echo (!empty($quiz->name) ? $quiz->name : ''); ?>
                            </a>
                        </div>

                        <?php //}else{?>

                        <div class="form-check mb-0">
                            <?php //echo ++$s;?>.
                            <a class="form-check-label fw-semi-bold text-dark"
                                href="<?php //echo base_url($enterprise_shortname.'/show-quizform/'.$course_id.'/'. $quiz->exam_id); ?>">
                                <?php //echo (!empty($quiz->name) ? $quiz->name : ''); ?>
                            </a>
                        </div>
                        <?php// } }?>
                    </div> -->
                    <?php //}?>



                </div>
                <br>
                <!--End card-->
                <!-- <div class="sidebar-block bg-img text-white mb-3 p-4" >
                    <div class="section-header mb-4">
                    <h5 class="mb-0">Related Courses</h5>
                    </div>
                </div> -->

                <div class="card border-0 rounded-0 shadow-sm mb-0">
                    <div class="card-header d-flex justify-content-between p-3 border-bottom-0">
                        <h5 class="mb-0"><?php echo "Give Your Review" //display('get_your_review'); ?></h5>
                    </div>
                    <div class="card-body p-4 p-md-3 p-lg-4">
                        <div class="review_message">
                            <form action="<?php ?>" method="post" class="m-0">
                                <div class="rating-form">
                                    <div class="form-group">
                                        <label
                                            class="control-label form-check-label fw-semi-bold mb-2"><?php echo display('your_rating'); ?>
                                            <i class='text-danger'> * </i></label>
                                        <div class='d-flex'>

                                            <div id="defaults" class='mb-2 '></div>
                                            <p class="m-1" id="hint"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group has-error">
                                    <label class="control-label form-check-label fw-semi-bold mb-2"
                                        for="reviewer_name"><?php echo display('your_name'); ?><i class='text-danger'> *
                                        </i></label>
                                    <input type="text" id="reviewer_name" class="form-control mb-2" name="reviewer_name"
                                        value="<?php echo html_escape((($name) ? "$name" : " ")) ?>" required readonly>
                                </div>
                                <div class="form-group">
                                    <label class="control-label form-check-label fw-semi-bold mb-2"
                                        for="reviewer_email"><?php echo display('email_address'); ?><i
                                            class='text-danger'> * </i></label>
                                    <input type="email" id="reviewer_email" class="form-control mb-2"
                                        name="reviewer_email"
                                        value="<?php echo html_escape((($email) ? "$email" : " ")); ?>" required=""
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label class="control-label form-check-label fw-semi-bold mb-2"
                                        for="review"><?php echo display('your_review'); ?></label>
                                    <textarea id="review" class="form-control " name="comments"
                                        rows="10"><?php echo (!empty($rating_review_byid->comments) ? $rating_review_byid->comments : '');?></textarea>
                                </div>
                                <input type="hidden" name="course_id" id="course_id"
                                    value="<?php echo html_escape($course_id); ?>">
                                <input type="hidden" name="user_id" id="user_id"
                                    value="<?php echo html_escape($user_id); ?>">
                                <input type="hidden" name="enterprise_id" id="enterprise_id"
                                    value="<?php echo html_escape($enterprise_id); ?>">
                                <div class="form-group">
                                    <?php if ($user_type) { ?>
                                    <button type="button" onclick="review_submit()"
                                        class="btn btn-dark-cerulean fw-medium btn_four mt-2"><?php echo display('submit'); ?></button>
                                    <?php } else { ?>

                                    <button type="button" onclick="review_submitcheck()"
                                        class="btn btn-dark-cerulean fw-medium btn_four mt-2"><?php echo display('submit'); ?></button>
                                    <?php } ?>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer px-4 py-3 border-top-0">
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


  <!-- Modal -->
  <div class="modal fade" id="assignment_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assignment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body assignmentdetails"></div>
            </div>
        </div>
    </div>


<div class="modal share-modal " id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="mb-3">Share This Course</h5>
                <!--Start Share Link Input-->
                <!-- <div class="share-input input-group mb-3">
                    <input type="text" class="form-control"
                        value="https://www.udemy.com/share/101W8Q/">
                    <button class="btn btn-outline-secondary px-4" type="button">Copy</button>
                </div> -->
                <!--End Share Link Input-->
                <!--Start Social Share-->
                <ul class="socail-share list-unstyled d-flex mb-0 justify-content-center">
                    <li><a href="https://www.facebook.com/sharer.php?u=<?php echo base_url($enterprise_shortname . '/course-details/' .$get_coursedetails->course_id); ?>"
                            target="_blank" class="d-block text-center me-3 text-muted">
                            <div class="socail-share_icon facebook"><i class="fab fa-facebook-f"></i></div>Facebook
                        </a></li>
                    <li><a href="https://twitter.com/share?text=<?php echo $get_coursedetails->name;?> &url=<?php echo base_url($enterprise_shortname.'/course-details/'.$get_coursedetails->course_id); ?> "
                            target="_blank" class="d-block text-center me-3 text-muted">
                            <div class="socail-share_icon twitter"><i class="fab fa-twitter"></i></div>Twitter
                        </a></li>
                    <li><a href="https://api.whatsapp.com/send?text=[<?php echo $get_coursedetails->name;?>] [<?php echo base_url($enterprise_shortname . '/course-details/' .$get_coursedetails->course_id); ?>]"
                            class="d-block text-center me-3 text-muted" target="_blank" rel="noopener">
                            <div class="socail-share_icon" style="background-color:#37b546;"><i class="fab fa-whatsapp"
                                    style="color:#fff;"></i></div>WhatsApp
                        </a></li>
                    <li>
                        <a href="mailto:?subject=<?php echo $get_coursedetails->name; ?> &body=<?php echo $get_coursedetails->description; ?> PLEASE VISIT THIS LINK:  <?php echo base_url($enterprise_shortname . '/course-details/' .$get_coursedetails->course_id); ?>"
                            class="d-block text-center me-3 text-muted">
                            <div class="socail-share_icon envelope"><i class="far fa-envelope"></i></div>Email
                        </a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/dialog/send?link=<?php echo base_url($enterprise_shortname.'/course-details/'.$get_coursedetails->course_id); ?>&app_id=311161661010577&redirect_uri=<?php echo base_url($enterprise_shortname.'/course-details/'.$get_coursedetails->course_id); ?>"
                            target="_blank" class="fbmsg text-capitalize" style="color: #9ea4a9;">
                            <div class="socail-share_icon" style="background-color: #1976d2;"><i style="color: #fff;"
                                    class="fab fa-facebook-messenger"></i></div>Messenger
                        </a>
                        <!-- https://www.facebook.com/dialog/send?link=https%3A%2F%2Flead.academy&app_id=291494419107518&redirect_uri=https%3A%2F%2Fwww.lead.academy -->
                    </li>
                </ul>
                <!--End Social Share-->
            </div>
        </div>
    </div>
</div>
<!-- alamin -->
<script src="https://f.vimeocdn.com/js/froogaloop2.min.js"></script>
<!-- <script src="https://player.vimeo.com/api/player.js"></script>   -->
<?php 
 $active_lst_lesson->last_activity;
if($active_lst_lesson->last_activity==@$query->course_id){

// others
$active_lesson_type=get_lessoninfo($active_lst_lesson->last_lesson);
if($active_lesson_type->lesson_type==1){
    $type="video";
}else{
    $type="others";
}
?>
<input type="hidden" id="last_lesson" value="<?php echo $active_lst_lesson->last_lesson;?>">
<input type="hidden" id="lastlesson_type" value="<?php echo $type;?>">
<input type="hidden" id="lastlesson_type_course" value="<?php echo $course_id;?>">
<script>
// $(window).on("load", function() {
$(document).ready(function() {
    // window.addEventListener('load', function () {
    var id = $("#last_lesson").val();
    var lastlesson_type = $("#lastlesson_type").val();
    loadcoursecontent(lastlesson_type, id);
});
</script>
<?php }?>
<script type="text/javascript">
function getallnotes() {
    $("#home-tab").removeClass("active");
    $("#home").removeClass("show active");
    $("#progress-tab").removeClass("active");
    $("#progressTab").removeClass("show active");
    $("#resource-tab").removeClass("active");
    $("#resource").removeClass("show active");
    $("#notes-tab").addClass("active");
    $("#notesTab").addClass("show active");

    var student_id = $("#student_id").val();
    var course_id = $("#course_id").val();
    //   var lesson_id = $("#last_lesson").val();

    $.ajax({
        url: base_url + enterprise_shortname + "/get-allnoteslist",
        type: "POST",
        data: {
            csrf_test_name: CSRF_TOKEN,
            student_id: student_id,
            course_id: course_id,
            //   lesson_id: lesson_id,
            enterprise_id: enterprise_id,
        },
        success: function(r) {
            $("#loadnotes").html(r);
        },
    });

    $.ajax({
        url: base_url + enterprise_shortname + "/get-allnotecount",
        type: "POST",
        data: {
            csrf_test_name: CSRF_TOKEN,
            student_id: student_id,
            course_id: course_id,
            //   lesson_id: lesson_id,
            enterprise_id: enterprise_id,
        },
        success: function(res) {
            $(".notecount-area").html(res);
        },
    });

}

function showassignmentDetails(assignment_id) {
    // alert(base_url);alert(enterprise_shortname);alert(assignment_id);
  $.ajax({
    url: base_url + enterprise_shortname + "/show-assignmentDetails",
    type: "POST",
    data: {
        assignment_id: assignment_id,
      csrf_test_name: CSRF_TOKEN,
    },
    success: function (data) {
      $(".assignmentdetails").html(data);
      $("#assignment_modal").modal("show");
    },
    error: function (xhr) {
      alert("failed!");
    },
  });
}
</script>
<script>
$(function() {
    //Doughnut Chart
    var percents = $('#percent').val();
    //Doughnut Chart
    const percent = percents;
    //Doughnut Chart
    const color = '#134779';
    const canvas = 'chartCanvas';
    const container = 'chartContainer';
    const percentValue = percent; // Sets the single percentage value
    const colorGreen = color, // Sets the chart color
        animationTime = '1400'; // Sets speed/duration of the animation

    const chartCanvas = document.getElementById(canvas), // Sets canvas element by ID
        chartContainer = document.getElementById(container), // Sets container element ID
        divElement = document.createElement(
            'div'), // Create element to hold and show percentage value in the center on the chart
        domString = '<div class="chart__value"><p>' + percentValue +
        '%</p></div>'; // String holding markup for above created element

    // Create a new Chart object
    const doughnutChart = new Chart(chartCanvas, {
        type: 'doughnut', // Set the chart to be a doughnut chart type
        data: {
            datasets: [{
                data: [percentValue, 100 -
                    percentValue
                ], // Set the value shown in the chart as a percentage (out of 100)
                backgroundColor: [colorGreen], // The background color of the filled chart
                borderWidth: 0 // Width of border around the chart
            }]
        },
        options: {
            cutoutPercentage: 84, // The percentage of the middle cut out of the chart
            responsive: false, // Set the chart to not be responsive
            tooltips: {
                enabled: false // Hide tooltips
            }
        }
    });
    Chart.defaults.global.animation.duration = animationTime; // Set the animation duration

    divElement.innerHTML = domString; // Parse the HTML set in the domString to the innerHTML of the divElement
    chartContainer.appendChild(divElement
        .firstChild); // Append the divElement within the chartContainer as it's child
});








$("document").ready(function() {
    var courseid_segment = $("#segment3").val();
    var segment4 = $("#segment4").val();
    if (courseid_segment && (segment4 == 1)) {
        $("#quizproject-tab").addClass('active');
        $("#quizprojectTab").addClass('show active');
        $("#home-tab").removeClass('active');
        $("#home").removeClass('show active');
    }
    // its for raty 
    $("#defaults").raty({
        starHalf: base_url +
            "/application/modules/frontend/views/themes/default/assets/plugins/raty/lib/images/star-half.png",
        starOff: base_url +
            "/application/modules/frontend/views/themes/default/assets/plugins/raty/lib/images/star-off.png",
        starOn: base_url +
            "/application/modules/frontend/views/themes/default/assets/plugins/raty/lib/images/star-on.png",
        <?php if($rating_review_byid){?>
        score: <?php echo $rating_review_byid->rating; ?>,
        <?php } ?>
        hints: [
            ["Very Poor", "Very Poor"],
            ["Poor", "Poor"],
            ["Neutral", "Neutral"],
            ["Satisfactory", "Satisfactory"],
            ["Delightful", "Delightful"],
        ],
        target: "#hint",

    });
});
</script>

<!-- score: <?php //echo $rating_review_byid->rating; ?>, -->