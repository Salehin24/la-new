<!--Start Student Profile Header-->
<?php 
function zeroprefix($count){
    $lessoncount=count($count);
     $str_length=2;
     $lessonnumbershow = substr("0000{$lessoncount}", -$str_length);
     echo $lessonnumbershow;
  }
  $user_id = $this->session->userdata('user_id');
?>
<style>
#courseStatus {
    /* margin-right: 120px;
    display: block;
    width: calc(100% - 120px); */
}

@media(max-width: 767px) {
    /* #courseStatus {
        width: 100%;
        max-width: 220px;
    } */
}

.nav-pills .nav-link.active,
.nav-pills .show>.nav-link {
    background-color: #07477d;
    color: #fff !important;
}

.bg-secondary {
    background-color: #07477D !important;
}

.bg-hash {
    background-color: #6C757D !important;
}
</style>
<?php $this->load->view('dashboard_coverpage');?>
<!--End Student Profile Header-->
<div class="bg-dark-cerulean sticky-nav">
    <div class="container-lg">
        <?php
                $this->load->view('dashboard_topmenu');
                ?>
    </div>
</div>
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="row">

            <div class="mt-3 mb-3">
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

            <div class="col-xl-4 col-md-6">
                <!--Start Section Header-->
                <div class="section-header mb-4">
                    <h5 class="fw-semi-bold active_page-text-blue">Last Activity</h5>
                    <div class="section-header_divider"></div>
                </div>
                <!--End Section Header-->
                <?php if($lastactivitycourse){
                ?>
                <!--Start Course Card-->
                <div class="course-card rounded-20 bg-white position-relative overflow-hidden shadow-none border mb-4 mb-xl-0">
                    <!--Start Course Image-->
                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $lastactivitycourse->course_id); ?>"
                        class="course-card_img">
                        <img src="<?php echo base_url(!empty($lastactivitycourse->picture) ? $lastactivitycourse->picture : default_600_400()); ?>"
                            class="img-fluid w-100" style="height:240px" alt="">
                    </a>
                    <!--End Course Image-->
                    <!--Start Course Card Body-->
                    <div class="course-card_body bg-prussian-blue p-4 position-relative m-0 rounded-0 bg-white">
                        <!--Start Course Title-->
                        <h3 class="course-card__course--title text-capitalize fs-6 mb-0">
                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $lastactivitycourse->course_id); ?>"
                                class="text-dark text-decoration-none"><?php echo (!empty($lastactivitycourse->name) ? $lastactivitycourse->name : ''); ?></a>
                        </h3>
                        <!--End Course Title-->
                        <!--Start Course instructor-->
                        <div class="course-card__instructor mb-3">
                            <div class="course-card__instructor--name text-black-50 text-uppercase fw-medium fs-13">by
                                <?php echo (!empty($lastactivitycourse->instructor_name) ? $lastactivitycourse->instructor_name : ''); ?>
                            </div>
                        </div>
                        <!--End Course instructor-->
                        <!--Start Course Hints-->
                        <div
                            class="course-card__hints d-flex justify-content-between align-items-center fw-medium mb-0">
                            <div class="ps-0">
                                <div class="d-flex align-items-center">
                                    <div class="course-card__hints--text">
                                        <span class="text-primary"><?php  
                                            $zero_length=2;
                                            echo  $chapter_complete = substr("0000{$chapter_complete}", -$zero_length);
                                            ?></span>/<?php  zeroprefix($total_chapter_count);?> Chapters
                                    </div>
                                </div>
                            </div>
                            <div> &nbsp;&nbsp;<span class="text-primary"><?php  zeroprefix($completelesson);?></span>/
                                <?php  zeroprefix($totalLesson);?> Lessons</div>
                            <div>
                                <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $lastactivitycourse->course_id); ?>"
                                    class="btn btn-primary">Resume<i data-feather="arrow-right" class="ms-2"></i></a>
                            </div>
                        </div>
                        <!--End Course Hints-->
                    </div>
                    <!--End Course Card Body-->
                </div>
                <?php }else{?>
                        <!--Start Course Card-->
                        <a  href="<?php echo base_url($enterprise_shortname . '/allcourse/'); ?>" class="card border-0 rounded shadow-sm w-100  flex-fill mb-4 mb-xl-0">
                            <!--Start Course Card Body-->
                            <div class="m-0 px-3 py-5 rounded-6 text-center card-body p-2 h-50 mb-4">
                                <div class="border d-inline-block rounded-circle text-center mb-3" style="width:50px;height: 50px;"><i class="d-block text-dark" data-feather="plus" style="height: 48px;font-size: 25px;margin: 0 auto;"></i></div>
                                <div class="fw-bold text-dark">Find your desired course</div>
                            </div>
                            <!--End Course Card Body-->
                            
                        </a>
                        <!--End Course Card-->
                <?php }?>
                <!--End Course Card-->
            </div>
            <div class="col-xl-4 col-md-6 d-flex flex-column">
                <!--Start Section Header-->
                <div class="section-header mb-4">
                    <h5 class="fw-semi-bold active_page-text-blue">Sticky Note</h5>
                    <div class="section-header_divider"></div>
                </div>
                <!--End Section Header-->
                <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4 mb-xl-0">
                    <div class="card-body p-2">
                        <div class="align-items-center d-flex justify-content-between mb-2">
                            <button class="btn btn-transparent px-0" data-bs-toggle="modal"
                                data-bs-target="#NoteModal"><i data-feather="plus-circle" class="me-1"></i>Create New
                                Note</button>
                        </div>
                        <div class="note-carousel owl-carousel owl-theme">

                            <?php
                                // print_r(count($get_studentstickynotes));
                                
                                $n=0;
                                foreach($get_studentstickynotes as $sticky){ 
                                    $n++;
                                    ?>
                            <div class="note_item">
                                <div class="p-4 bg-light-yellow rounded">
                                    <div class="d-flex position-absolute btn-act">
                                        <button class="btn bg-transparent px-0 me-1"  title="Delete" data-toggle="tooltip" data-placement="top"
                                            onclick="deleteStickynote('<?php echo $sticky->id; ?>')">
                                            <i data-feather="trash-2"></i>
                                        </button>
                                        <button class="btn bg-transparent p-0" title="Save" data-toggle="tooltip" data-placement="top"
                                            onclick="updateStickynote('<?php echo $sticky->id; ?>','<?php echo $n; ?>')">
                                            <!-- <i data-feather="check-square"></i> -->
                                            <i class="fas fa-save" style="font-size: 19px;line-height: 35px;"></i>
                                        </button>
                                        <!-- <button class="btn bg-transparent px-0" onclick="stickynoteedit('<?php echo $sticky->id; ?>','<?php echo $n; ?>')">
                                                <i data-feather="check-square"></i> -->
                                        </button>
                                    </div>
                                    <div class="border-bottom-ly pb-3 mb-3 mt-3">
                                        <textarea name="note"
                                            class="bg-transparent border-0 fs-13 fw-semi-bold note_heading w-100"
                                            id="notetitle_<?php echo $n; ?>"><?php echo (!empty($sticky->title) ? $sticky->title : ''); ?></textarea>
                                        <div class="fs-12 text-muted">Last Updated:
                                            <?php echo date('d F Y', strtotime($sticky->updated_date));  ?></div>

                                    </div>
                                    <textarea name="note" class="border-0 w-100 bg-transparent note_input"
                                        id="notedescription_<?php echo $n; ?>"><?php echo (!empty($sticky->notes) ? $sticky->notes : ''); ?></textarea>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- <div class="note_item">
                                    <div class="p-4 bg-light-yellow rounded">
                                        <div class="d-flex position-absolute btn-act">
                                            <button class="btn bg-transparent px-0 me-1">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                            <button class="btn bg-transparent px-0">
                                                <i data-feather="check-square"></i>
                                            </button>
                                        </div>
                                        <div class="border-bottom-ly pb-3 mb-3">
                                            <textarea name="note" class="border-0 w-100 bg-transparent note_heading">Lesson Two</textarea>
                                            <div class="fs-12 text-muted">Last Updated: 23 Sep 2020</div>
                                        </div>
                                        <textarea name="note" class="border-0 w-100 bg-transparent note_input">Lorem ipsum basem philo cuman delum perem seram veram plodo</textarea>
                                    </div>
                                </div>
                                <div class="note_item">
                                    <div class="p-4 bg-light-yellow rounded">
                                        <div class="d-flex position-absolute btn-act">
                                            <button class="btn bg-transparent px-0 me-1">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                            <button class="btn bg-transparent px-0">
                                                <i data-feather="check-square"></i>
                                            </button>
                                        </div>
                                        <div class="border-bottom-ly pb-3 mb-3">
                                            <textarea name="note" class="border-0 w-100 bg-transparent note_heading">Lesson Three</textarea>
                                            <div class="fs-12 text-muted">Last Updated: 23 Sep 2020</div>
                                        </div>
                                        <textarea name="note" class="border-0 w-100 bg-transparent note_input">Lorem ipsum basem philo cuman delum perem seram veram plodo</textarea>
                                    </div>
                                </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-12 col-md-6 d-flex flex-column">
                <!--Start Section Header-->
                <div class="section-header mb-4">
                    <h5 class="fw-semi-bold active_page-text-blue">Time Spent Today</h5>
                    <div class="section-header_divider"></div>
                </div>
                <!--End Section Header-->
                <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4 mb-xl-0">
                    <div class="card-body p-4">
                        <div class="align-items-center d-flex justify-content-between mb-2">
                            <div class="text-center">
                                <div class="fs-5 fw-semi-bold text-dark-cerulean">
                                    <?php $today = date("F j"); echo html_escape($today);?></div>
                                <div class="fs-13 text-muted"><?php  $day= date("l"); echo html_escape($day);?></div>
                            </div>
                            <div class="fs-5 fw-bold text-dark-cerulean">
                                <?php   
                                    
                                   $dayseconds= (!empty($TodayTotalTimeSpent[0]->todaywatchtime)?$TodayTotalTimeSpent[0]->todaywatchtime:'');
                                    function secondsToWords($dayseconds) {
                                        /*** number of days ***/
                                        $days = (int)($dayseconds / 86400);
                                        /*** if more than one day ***/
                                        $plural = $days > 1 ? 'days' : 'day';
                                        /*** number of hours ***/
                                        $hours = (int)(($dayseconds - ($days * 86400)) / 3600);
                                        /*** number of mins ***/
                                        $mins = (int)(($dayseconds - $days * 86400 - $hours * 3600) / 60);
                                        /*** number of seconds ***/
                                        $secs = (int)($dayseconds - ($days * 86400) - ($hours * 3600) - ($mins * 60));
                                        /*** return the string ***/
                                        echo  sprintf("%d hrs %d min ", $hours,$mins);
                                    }
                                    if(!empty($dayseconds)){
                                     secondsToWords($dayseconds);
                                    }else{
                                       echo  "0 hrs 0 min";
                                    }
                                    ?>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="ps-0">Course</th>
                                    <th class="pe-0 text-end">Spent</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i=1;
                                    if(!empty($todayTimeSpent)){
                                    foreach($todayTimeSpent as $todaycourse){
                                        
                                           
                                           $CourseWisETotalTime=$todaycourse->todaywatchtime;
                                            /*** number of days ***/
                                            $days = (int)($CourseWisETotalTime / 86400);
                                            /*** if more than one day ***/
                                            $plural = $days > 1 ? 'days' : 'day';
                                            /*** number of hours ***/
                                            $hours = (int)(($CourseWisETotalTime - ($days * 86400)) / 3600);
                                            /*** number of mins ***/
                                            $mins = (int)(($CourseWisETotalTime - $days * 86400 - $hours * 3600) / 60);
                                            /*** number of seconds ***/
                                            $secs = (int)($CourseWisETotalTime - ($days * 86400) - ($hours * 3600) - ($mins * 60));
                                            /*** return the string ***/
                                            // $CourseWisETotalTime= sprintf("%d hr %d m %d s", $hours,$mins,$secs);
                                            $CourseWisETotalTime= sprintf("%d hrs %d min", $hours, $mins);
                                        
                                    ?>
                                <tr>
                                    <td class="ps-0 align-middle">
                                        <div class="text-dark-cerulean fw-medium">
                                            <?php echo html_escape($todaycourse->name);?></div>
                                        <div class="fs-13 text-muted"><?php echo $todaycourse->instructor_name;?></div>
                                    </td>
                                    <td class="white-space-nowrap fs-6 fw-semi-bold align-middle pe-0 text-end">
                                        <?php echo html_escape($CourseWisETotalTime);?></td>
                                </tr>
                                <?php $i++;}}else{?>
                                <tr>
                                    <td class="ps-0 align-middle">
                                        <div class="text-dark-cerulean fw-medium"></div>
                                        <div class="fs-13 text-danger">No record found here today</div>
                                    </td>
                                    <td class="white-space-nowrap fs-6 fw-semi-bold align-middle pe-0 text-end"></td>
                                </tr>
                                <?php }?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Course Completed-->
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="row">
            <div class="col-xl-8">
                <!--Start Course Completed-->
                <div class="card border-0 rounded-0 shadow-sm mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center justify-content-between">
                            <!--Start Section Header-->
                            <div class="section-header mb-4">
                                <h4 class="fw-semi-bold active_page-text-blue">Take Quiz</h4>
                                <div class="section-header_divider"></div>
                            </div>
                            <!--End Section Header-->
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active text-dark" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                        aria-selected="true">All</button>
                                </li>
                                <!-- <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">New</button>
                                </li> -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-dark" onclick="get_passfailquiz(2)"
                                        id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
                                        type="button" role="tab" aria-controls="pills-contact"
                                        aria-selected="false">Incomplete</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-dark" onclick="get_passfailquiz(1)"
                                        id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
                                        type="button" role="tab" aria-controls="pills-contact"
                                        aria-selected="false">Passes</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-dark" onclick="get_passfailquiz(0)"
                                        id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
                                        type="button" role="tab" aria-controls="pills-contact"
                                        aria-selected="false">Failed</button>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">


                                <?php 
                                    // d($get_allcourseexams);
                                     if($get_allcourseexams){
                                    $q=0;
                                    foreach($get_allcourseexams as $courseexam){
                                        $q++;
                                        $get_examresults = $this->Frontend_model->get_examresults($courseexam->customer_id, $courseexam->course_id, $courseexam->exam_id);
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

                                <?php if($get_examresults){  ?>
                                <div class="border p-3 rounded-20 mb-3">
                                    <h5 class="mb-3">Course:
                                        <?php echo (!empty($courseexam->course_name) ? $courseexam->course_name : ''); ?>
                                    </h5>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <h5>
                                                <span class="badge bg-secondary me-1">Quiz :- <?php echo $q; ?></span>
                                                <?php echo (!empty($courseexam->exam_name) ? $courseexam->exam_name : ''); ?>
                                            </h5>
                                        </div>
                                        <div>
                                            <?php 
                                            // echo $obtainedmarks; 
                                            if($obtainedmarks >= $courseexam->pass_mark){
                                            ?>
                                            <?php if($get_examresults->is_done != 1){ ?>
                                            <button type="button" class="btn btn-sm btn-success"
                                                onclick="examDonestatus('<?php echo $get_examresults->questionexam_id?>')">Done</button>
                                            <?php }else{ ?>
                                            <!-- <button type="button" class="btn btn-sm btn-success">Completed</button> -->
                                            <span class="badge bg-success me-1 p-2 fw-bold">Completed</span>
                                            <?php } ?>
                                            <?php }else{ ?>
                                            <a href="<?php echo base_url($enterprise_shortname.'/show-quizform/'.$courseexam->course_id.'/'. $courseexam->exam_id); ?>"
                                                class="btn btn-sm btn-danger">Re-take</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-borderless mb-0 border">
                                            <thead>
                                                <tr>
                                                    <th>Q&amp;A</th>
                                                    <th>Correct</th>
                                                    <th>Incorrect</th>
                                                    <th>Unanswered</th>
                                                    <th>Avg Time</th>
                                                    <th>Status</th>
                                                    <th>Score</th>
                                                    <th>Result</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th><?php echo $get_examresults->total_question; ?>/<?php echo $get_examresults->total_answered; ?></th>
                                                    <td>
                                                        <?php //d($exam_set); 
                                                        echo $rightans;  ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $wrong_ans; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $ttl_unanswered = $get_examresults->total_question-$get_examresults->total_answered; ?>
                                                    </td>
                                                    <td><?php echo $get_examresults->duration; ?></td>
                                                    <?php                                                     
                                                        // echo ($obtainedmarks == 0) ? "N/A" : $obtainedmarks; 
                                                        // echo '<br>'; echo $marks; 
                                                        $correct_statusbar = $wrong_statusbar = $unanswered_statusbar = 0;
                                                        $percentagescore = (($obtainedmarks*100)/$marks);
                                                        $totalstatus = $rightans+$wrong_ans+$ttl_unanswered;
                                                        $correct_statusbar = ($totalstatus-($wrong_ans+$ttl_unanswered));
                                                        $wrong_statusbar = ($totalstatus-($rightans+$ttl_unanswered));
                                                        $unanswered_statusbar = ($totalstatus-($rightans+$wrong_ans));
                                                    ?>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-success"
                                                                style="width:<?php echo $correct_statusbar*100; ?>%">
                                                                <!-- Success -->
                                                            </div>
                                                            <div class="progress-bar bg-danger"
                                                                style="width:<?php echo $wrong_statusbar*100; ?>%">
                                                                <!-- Warning -->
                                                            </div>
                                                            <div class="progress-bar bg-hash"
                                                                style="width:<?php echo $unanswered_statusbar*100; ?>%">
                                                                <!-- Danger -->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class='fw-black'>
                                                        <?php 
                                                        // echo number_format($percentagescore, 2);
                                                        echo number_format($percentagescore).'%';
                                                    ?>
                                                    </td>
                                                    <td>
                                                        <?php if($obtainedmarks >= $courseexam->pass_mark){ ?>
                                                        <span class="badge bg-success fs-15">
                                                            <?php 
                                                        //  if($obtainedmarks >= $courseexam->pass_mark){
                                                            echo 'Passes';
                                                        //  }else{
                                                        //      echo 'Failed';
                                                        //  }; 
                                                        ?>
                                                        </span>
                                                        <?php }else{?>
                                                        <span class="badge bg-danger fs-15">
                                                            Failed
                                                        </span>
                                                        <?php }?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php }else{ ?>
                                <div class="border p-3 rounded-20 mb-3">
                                    <h5 class="mb-3">Course:
                                        <?php echo (!empty($courseexam->course_name) ? $courseexam->course_name : ''); ?>
                                    </h5>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <h5>
                                                <span class="badge bg-secondary me-1">Quiz :- <?php echo $q; ?></span>
                                                <?php echo (!empty($courseexam->exam_name) ? $courseexam->exam_name : ''); ?>
                                            </h5>
                                        </div>
                                        <div>
                                            <a href="<?php echo base_url($enterprise_shortname.'/show-quizform/'.$courseexam->course_id.'/'. $courseexam->exam_id); ?>"
                                                class="btn btn-sm btn-primary">Start</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-borderless mb-0 border">
                                            <thead>
                                                <tr>
                                                    <th>Q&amp;A</th>
                                                    <th>Correct</th>
                                                    <th>Incorrect</th>
                                                    <th>Unanswered</th>
                                                    <th>Avg Time</th>
                                                    <th>Status</th>
                                                    <th>Score</th>
                                                    <th>Result</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>0</th>
                                                    <td>0 </td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-hash"
                                                                style="width:<?php echo 100; ?>%">
                                                                <!-- Danger -->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="fw-black">N/A</td>
                                                    <td>
                                                        <span class="badge bg-warning fs-15">Incomplete</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php }
                             }
                            }else{?>
                                <p class="text-danger">No quiz in your current courses</p>
                                <?php }?>
                            </div>
                            <!-- <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">...</div> -->
                            <div class="tab-pane fade loadquizdata" id="pills-contact" role="tabpanel"
                                aria-labelledby="pills-contact-tab">...</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 d-flex flex-column">
                <div class="card border-0 rounded-0 shadow-sm flex-fill w-100">
                    <div class="card-body p-4">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <!--Start Section Header-->
                            <div class="section-header mb-3 mb-sm-0">
                                <h4 class="fw-semi-bold active_page-text-blue">Enrolled Events</h4>
                                <div class="section-header_divider"></div>
                            </div>
                            <!-- <button type="button" class="btn btn-dark-cerulean">Edit List</button> -->
                        </div>
                        <!--Start Event-->
                        <?php 
                        // $user_id = $this->session->userdata('user_id');
                        $purchaseeventlist=$this->db->select('a.*,b.course_id,b.name, c.meeting_date, c.start_time, c.end_time, d.name category_name')
                        ->from('invoice_details a')
                        ->join('course_tbl b','b.course_id=a.product_id')
                        ->join('meeting_tbl c', 'c.course_id = a.product_id')
                        ->join('category_tbl d','d.category_id=b.category_id')
                        ->where('a.customer_id',$user_id)
                        ->where('a.enterprise_id',$enterprise_id)
                        ->where('is_subscription',4)
                        ->group_by('c.course_id')
                        ->get()->result();
                        if($purchaseeventlist){
                         foreach($purchaseeventlist as  $purchaseevent){ 
                           $meeting_date = strtotime($purchaseevent->meeting_date);    
                        ?>
                        <div class="align-items-center bg-alice-blue border d-flex mb-2 p-2 pe-3 rounded shadow-sm">
                            <div class="flex-shrink-0">
                                <div class="bg-white border event-date px-3 py-2 rounded text-center">
                                    <div class="fs-13 text-muted"><?php echo date('M', $meeting_date); ?></div>
                                    <div class="fs-4 fw-semi-bold"><?php echo date('d', $meeting_date); ?></div>
                                </div>
                            </div>
                            <div class="align-items-center d-sm-flex flex-grow-1 justify-content-between ms-3">
                                <div>
                                    <h6><?php echo (!empty($purchaseevent->name) ? $purchaseevent->name : ''); ?></h6>
                                    <div class="fs-12 text-muted">
                                        <?php echo (!empty($purchaseevent->start_time) ? date('h:i:a', strtotime($purchaseevent->start_time)) : ''); ?>
                                        -
                                        <?php echo (!empty($purchaseevent->end_time) ? date('h:i:a', strtotime($purchaseevent->end_time)) : ''); ?>
                                    </div>
                                    <div>
                                        <?php echo (!empty($purchaseevent->category_name) ? $purchaseevent->category_name : ''); ?>
                                    </div>
                                </div>
                                <div>
                                    <a href="<?php echo base_url($enterprise_shortname.'/event-details/'.$purchaseevent->course_id);?>"
                                        class="btn btn-outline-dark-cerulean btn-sm">View</a>
                                </div>
                            </div>
                        </div>
                        <?php }
                        }else{ ?>
                        <!-- <p class="text-danger">No record found here! </p> -->
                        <div>
                            <a class="border d-flex mb-2 p-3 rounded text-center bg-white"
                                href="<?php echo base_url($enterprise_shortname . '/eventlist'); ?>">
                                <div class="flex-grow-1">
                                    <div class="border d-inline-block rounded-circle text-center mb-2"
                                        style="width:50px;height: 50px;">
                                        <i class="d-block text-dark" data-feather="plus"
                                            style="height: 48px;font-size: 25px;margin: 0 auto;"></i>
                                    </div>
                                    <div class="fw-bold text-dark">Join our upcoming Events</div>
                                </div>
                            </a>
                            <div class="border d-flex mb-2 p-3 rounded text-center empty-box-darker">
                                <div class="flex-grow-1">
                                    <div class="d-inline-block rounded-circle text-center mb-2"
                                        style="width:50px;height: 50px;">

                                    </div>

                                </div>
                            </div>
                            <div class="border d-flex mb-2 p-3 rounded text-center empty-box-darker">
                                <div class="flex-grow-1">
                                    <div class="d-inline-block rounded-circle text-center mb-2"
                                        style="width:50px;height: 50px;">

                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php }                        ?>
                        <!--End Event-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Start Course Completed-->
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <div class="d-md-flex align-items-center justify-content-between mb-4">
                    <!--Start Section Header-->
                    <div class="section-header mb-4 mb-md-0">
                        <h4 class="fw-semi-bold active_page-text-blue">My project / Assignment</h4>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                    <div><a href="<?php echo base_url($enterprise_shortname. '/student-add-project'); ?>"
                            class="btn btn-dark-cerulean">+&nbsp;Add New Project</a></div>
                </div>
                <div class="position-relative">
                    <!--Nav Pills-->
                    <ul class="nav nav-pills mb-3 assignment_nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active featured_work_color fw-semi-bold" id="pills-one-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-one" type="button" role="tab"
                                aria-controls="pills-one" aria-selected="true"
                                onclick="typewiseproject('0', 'edit')">All</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="featured_work_color fw-semi-bold nav-link" id="pills-two-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-two" type="button" role="tab"
                                aria-controls="pills-two" aria-selected="false"
                                onclick="typewiseproject('1', 'edit')">Course Project</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="featured_work_color fw-semi-bold nav-link" id="pills-five-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-five" type="button" role="tab"
                                aria-controls="pills-five" aria-selected="false"
                                onclick="typewiseproject('4', 'edit')">Client Project</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="featured_work_color fw-semi-bold nav-link" id="pills-three-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-three" type="button" role="tab"
                                aria-controls="pills-three" aria-selected="false"
                                onclick="typewiseproject('2', 'edit')">Personal
                                Project</button>
                        </li>
                        <!-- <li class="nav-item" role="presentation">
                            <button class="featured_work_color fw-semi-bold nav-link" id="pills-four-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-four" type="button" role="tab"
                                aria-controls="pills-four" aria-selected="false"
                                onclick="typewiseproject('3', 'edit')">Practice Project</button>
                        </li> -->
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-one" role="tabpanel"
                            aria-labelledby="pills-one-tab">
                            <div class="project-carousel owl-carousel owl-theme">
                                <!--Start Project Card-->
                                <?php
                                //  d($get_featuredproject); 
                                if($get_featuredproject){ ?>
                                <?php foreach($get_featuredproject as $project){ ?>
                                <div class="project-card">
                                    <div class="project-card_img position-relative overflow-hidden rounded">

                                        <img src="<?php echo base_url((!empty($project->coverpic) ? $project->coverpic : default_600_400())); ?>"
                                            alt="" class="img-fluid">

                                        <div
                                            class="featured-opacity  bottom-0 d-flex end-0 flex-wrap h-100 <?php if($project->publish_status==0){ echo "justify-content-center";}else{ echo "align-items-center";}?> p-3 position-absolute project-card_overlay start-0 top-0">
                                            <div class="w-100">
                                                <?php if($project->project_type==1){?>
                                                <div class="d-flex align-items-center text-white mb-1">
                                                    <div class="flex-shrink-0">
                                                        <div
                                                            class="project-card_round--icon bg-primary d-flex align-items-center justify-content-center">
                                                            <i data-feather="anchor"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2 fs-13">
                                                        <?php 
                                                            if($project->coursetype==1){
                                                                echo "Chapter Project";
                                                            }else{ 
                                                                echo "Final Project";
                                                            }
                                                            ?>
                                                    </div>
                                                </div>
                                                <?php }?>
                                                <div class="align-items-center d-flex text-white mb-1">
                                                    <div class="flex-shrink-0">
                                                        <div
                                                            class="project-card_round--icon bg-danger d-flex align-items-center justify-content-center">
                                                            <i data-feather="bookmark"></i>
                                                        </div>
                                                    </div>
                                                    <div class="fs-13 ms-2">
                                                        <?php if($project->project_type==1){?>
                                                        Course Project
                                                        <?php }elseif($project->project_type==2){?>
                                                        Personal Project
                                                        <?php }elseif($project->project_type==4){?>
                                                        Client Project
                                                        <?php }?>
                                                    </div>
                                                </div>
                                                <?php if($project->publish_status==0){?>
                                                <div class="align-items-center d-flex  text-white">
                                                    <div class="flex-shrink-0">
                                                        <div
                                                            class="project-card_round--icon bg-primary d-flex align-items-center justify-content-center">
                                                            <i data-feather="anchor"></i>
                                                        </div>
                                                    </div>
                                                    <div class=" ms-2 fs-13">
                                                        Draft
                                                    </div>
                                                </div>
                                                <?php }?>
                                            </div>

                                        </div>

                                        <!-- <div
                                            class="align-content-between bottom-0 end-0 flex-wrap h-100 p-3 position-absolute project-card_overlay start-0 top-0">
                                            <div class="w-100">
                                                <div class="d-flex align-items-center text-white mb-1">
                                                    <div class="flex-shrink-0">
                                                        <div
                                                            class="project-card_round--icon bg-primary d-flex align-items-center justify-content-center">
                                                            <i data-feather="anchor"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2 fs-13">
                                                        Featured
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center text-white">
                                                    <div class="flex-shrink-0">
                                                        <div
                                                            class="project-card_round--icon bg-danger d-flex align-items-center justify-content-center">
                                                            <i data-feather="bookmark"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2 fs-13">
                                                        Course Project
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="project-card_icon text-white w-100">
                                                <div class="mb-1 fs-13"><i data-feather="heart" class="me-1"></i>26
                                                </div>
                                                <div class="mb-1 fs-13"><i data-feather="message-circle"
                                                        class="me-1"></i>1</div>
                                                <div class="mb-1 fs-13"><i data-feather="eye" class="me-1"></i>225</div>
                                            </div>
                                        </div> -->
                                    </div>
                                    <h6 class="project-card-title mb-0 mt-2 text-truncate">
                                        <a class="fs-15 text-dark"
                                            href="<?php echo base_url($enterprise_shortname . '/student-project-view/'. $project->project_id); ?>">
                                            <?php echo (!empty($project->title) ? $project->title : ''); ?>
                                        </a>
                                    </h6>
                                    <!--Start Action Button-->
                                    <div class="action-btn align-items-center d-flex mt-3">
                                        <?php if($project->project_status != 1){ ?>
                                        <a href="<?php echo base_url($enterprise_shortname . '/student-project-edit/'. $project->project_id); ?>"
                                            class="me-2 text-dark">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-edit-3">
                                                <path d="M12 20h9"></path>
                                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z">
                                                </path>
                                            </svg>
                                            <span>Edit</span></a>
                                            <?php } ?>
                                        <a href="javascript:void(0)" class="align-items-center d-flex me-2 text-dark"
                                            onclick="studentprojectdelete('<?php echo $project->project_id; ?>')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                            <span>Delete</span></a>
                                    </div>
                                    <!--End Action Button-->
                                </div>
                                <?php } ?>
                                <?php }else{ ?>
                                <p>Record not found!</p>
                                <?php } ?>
                                <!--End Project Card-->

                            </div>
                        </div>

                        <div class="tab-pane fade load-project" id="pills-two" role="tabpanel"
                            aria-labelledby="pills-tow-tab">

                        </div>
                        <div class="tab-pane fade load-project" id="pills-three" role="tabpanel"
                            aria-labelledby="pills-three-tab">

                        </div>
                        <div class="tab-pane fade load-project" id="pills-four" role="tabpanel"
                            aria-labelledby="pills-four-tab">

                        </div>
                        <div class="tab-pane fade load-project" id="pills-five" role="tabpanel"
                            aria-labelledby="pills-five-tab">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Course Completed-->
<!--Start Course Completed-->
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <div class="row align-items-center justify-content-between mb-4">
                    <?php
                
                    if(!empty($checksubscription_day_left)){

                    $create_date = date("Y-m-d", strtotime($checksubscription_day_left->expeiredate));
                    if ($checksubscription_day_left->duration == 1) {
                        $last_date = date('Y-m-d', strtotime($create_date));
                    } else {
                        $last_date = date('Y-m-d', strtotime($create_date));
                    }
                    $event_date = strtotime($last_date); // or whenever the diwali is
                    $current = strtotime('now');
                    $diffference = ($event_date - $current);
                    $days = ceil($diffference / (60 * 60 * 24));
                    if ($days == 0) {
                        $days = 1;
                    }
                    // $create_date=date("Y-m-d",strtotime($checksubscription_day_left->date));
                    // if($checksubscription_day_left->duration ==1){
                    // $last_date=date('Y-m-d', strtotime($create_date. ' + 30 days'));
                    // }else{
                    //     $last_date=date('Y-m-d', strtotime($create_date. ' + 365 days'));
                    // }
                    // $event_date = strtotime($last_date); // or whenever the diwali is
                    // $current=strtotime('now');
                    // $diffference =($event_date-$current);
                    // $days=ceil($diffference / (60*60*24));
                    // if($days==0){
                    //     $days=1;
                    // }
                    // if($days<=5){
                    ?>
                    <div class="col-md-9 col-sm-8 col-lg-10">
                        <div class="alert alert-danger d-flex align-items-center justify-content-between py-2 w-100 mb-3 mb-sm-0"
                            role="alert">
                            <div>
                                <i data-feather="info" class="me-2"></i><span>
                                    <?php if($days>0){ echo "you have ".$days." days left on your
                                            subscription";}else{ echo "Your Subscription is expired " .abs($days)." days ago";}?>
                                </span>
                            </div>
                            <a href="<?php echo base_url($enterprise_shortname.'/subscription-details'); ?>"
                                class="btn btn-info">Upgrade</a>
                        </div>
                    </div>
                    <?php }else{?>
                    <div class="col-md-9 col-sm-8 col-lg-10">

                    </div>
                    <?php } //} 

                    $startdate = $checksubscription_day_left->expeiredate;

                    $expiredate = date('Y-m-d', strtotime($startdate));
                    $todayDate = date('Y-m-d');
                    if ($expiredate > $todayDate) {
                    if(!empty($subscription_courses)){?>
                    <div class="col-md-3 col-sm-4 col-lg-2">
                        <select class="form-select"
                            onchange="studentCourseFiltering(this.value,'subscrition','<?php echo $user_id;?>')">
                            <option value="all">All</option>
                            <option value="completed">Completed</option>
                            <option value="incomplete">Incomplete</option>
                        </select>
                    </div>
                    <?php }}?>

                </div>
                <!--Start Section Header-->
                <div class="section-header mb-4">
                    <h4 class="fw-semi-bold active_page-text-blue">Subscribed Courses</h4>
                    <div class="section-header_divider"></div>
                </div>
                <!--End Section Header-->
               
                <!--Start Course Carousel-->
                <div class="courses-carousel owl-carousel owl-theme" id="before_filtering_subscription">

                    <!--Start Course Card-->
                    <?php 
               
                        // if($checksubscription_day_left){
                        // $today_date= date("Y-m-d");
                        // $last_date=date('Y-m-d', strtotime($create_date. ' + 30 days'));

                       

                        if ($expiredate > $todayDate) {
                            
                          foreach($subscription_courses as  $coursesubscription){

                            // d($coursesubscription);
                            $totalSubCompleteLesson = $this->db->where('course_id',$coursesubscription->course_id)->where('student_id', $user_id)->where('is_complete',1)->where('enterprise_id',$enterprise_id)->get('watch_time_tbl')->num_rows();
                            $totalSubLesson = $this->db->where('course_id',$coursesubscription->course_id)->where('enterprise_id',$enterprise_id)->get('lesson_tbl')->num_rows();
                            $totalSubChapter = $this->db->where('course_id',$coursesubscription->course_id)->where('enterprise_id',$enterprise_id)->get('section_tbl')->num_rows();   
                            
                            $totalassignment=$this->db->where('course_id',$coursesubscription->course_id)->where('enterprise_id',$enterprise_id)->get('project_assingment')->num_rows();
                            $completetotalassignment=$this->db->where('course_id',$coursesubscription->course_id)->where('project_type',1)->where('type',1)->where('user_id', $user_id)->where('enterprise_id',$enterprise_id)->where('project_status',1)->get('project_tbl')->num_rows();
                       
                            
                       // progress           
                      //======video % start calculation here=================== 
                       $lesson_tbl=$this->db->select('*')->from('lesson_tbl')->where('course_id',$coursesubscription->course_id)->where('lesson_type',1)->where('enterprise_id',$enterprise_id)->get()->result();
                      
                      //isahaq
                        $textFilepercentage=$this->db->select('*')->from('lesson_tbl')
                        ->where('course_id',$coursesubscription->course_id)
                        ->where('lesson_type !=',1)
                        ->where('enterprise_id',$enterprise_id)
                        ->get()
                        ->result();
                        $lesson_count=$this->db->select('*')->from('lesson_tbl')->where('course_id',$coursesubscription->course_id)->where('enterprise_id',$enterprise_id)->get()->num_rows();

                        $quizCount_per=$this->db->select('*')->from('assign_courseexam_tbl')
                        ->where('course_id',$coursesubscription->course_id)
                        ->where('enterprise_id',$enterprise_id)
                        ->get()
                        ->num_rows();
                        $totalassignment_per=$this->db->where('course_id',$coursesubscription->course_id)->where('enterprise_id',$enterprise_id)->get('project_assingment')->num_rows();
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
                       $watch=$this->db->select('*')->from('watch_time_tbl')->where('lesson_id',$lesson_tbl_duration->lesson_id)->where('student_id',$user_id)->where('course_id',$coursesubscription->product_id)->where('enterprise_id',$enterprise_id)->get()->row();
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
                       // new  
                       $videoWatchPercentage=$eachVedioPercent*$total_video_per/100;

                       }else{
                           $videoWatchPercentage=0;
                       }
                        //======video % end calculation here=================== 

                        // text file and pdf  start
                       $textFilePerCalculation=$this->db->where('course_id',$coursesubscription->course_id)->where('lesson_type !=',1)->where('enterprise_id',$coursesubscription->enterprise_id)->get('lesson_tbl')->num_rows();
                       $completetextFile = $this->db->where('course_id',$coursesubscription->course_id)->where('student_id', $user_id)->where('file_type',0)->where('is_complete',1)->where('enterprise_id',$enterprise_id)->get('watch_time_tbl')->num_rows();
                       if($completetextFile > 0 && $textFilePerCalculation>0){
                       $Textfilecount=$completetextFile*100/$textFilePerCalculation;
                       $Filecomplete =$Textfilecount*$total_textper/100;
                       }else{
                        $Filecomplete=0;
                       }
                     
                        //=========================text file and pdf  end=================================

                       $VideoAndFIle=(!empty($videoWatchPercentage) ? $videoWatchPercentage:'0')+(!empty($Filecomplete) ? $Filecomplete:'0');//===text file video file % sum 
                       $Lessonprogress=($VideoAndFIle*$total_lesson_per)/100;
                       // quiz percentage calculation 
                        //  quiz  count 
                        $quizCount=$this->db->select('*')->from('assign_courseexam_tbl')
                        ->where('course_id',$coursesubscription->course_id)
                        ->where('enterprise_id',$enterprise_id)
                        // ->where('student_id',$user_id)
                        ->get()
                        ->result();
                        //  quiz complete status count                    
                        $quizComplete=$this->db->select('*')->from('question_exam_tbl')
                        ->where('is_done',1)
                        ->where('course_id',$coursesubscription->course_id)
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
                        if($completetotalassignment > 0 && $totalassignment>0){
                           $assignmentindivisula= ($completetotalassignment*100)/ $totalassignment;
                           $assignment= ($assignmentindivisula*$total_assing_per)/100;
                        }else{
                            $assignment=0;
                        }
                       
                       
            
                    //     $Newpercent=1;
                    //    // when one or multiple type of course is empty  
                    //     if(empty($quizCount) && empty($totalassignment) && empty($textFilePerCalculation)){
                    //         $Newpercent=4;
                    //     }else if(empty($quizCount) && empty($textFilePerCalculation)){
                    //         $Newpercent=2;
                    //     }else if(empty($quizCount) && empty($totalassignment)){
                    //         $Newpercent=2;
                    //     }else if(empty($totalassignment) && empty($textFilePerCalculation)){
                    //         $Newpercent=2;
                    //     }else{
                    //         if(!empty($quizCount) && !empty($totalassignment) && !empty($textFilePerCalculation)){
                    //             $Newpercent=1;
                    //         }else{

                    //             $Newpercent=1.333333333333;
                    //         }
                    //     }

                        // $TotalProgress=number_format($VideoAndFIle+$quizPercentage+$assignment,1); //== total % calculation 
                        // $TotalProgress=number_format(($Filecomplete*$Newpercent)+($videoWatchPercentage*$Newpercent)+($quizPercentage*$Newpercent)+($assignment*$Newpercent),1); //== total % calculation 
                      
                        $TotalProgress=number_format($Lessonprogress+$quizPercentage+$assignment,1);

                      ?>
                    <div
                        class="course-card rounded-20 bg-white position-relative overflow-hidden shadow-none border disabled">
                        <!--Start Course Image-->
                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $coursesubscription->course_id); ?>"
                            class="course-card_img">
                            <img src="<?php echo base_url(!empty(get_picturebyid($coursesubscription->course_id)->picture) ? get_picturebyid($coursesubscription->course_id)->picture : default_image()); ?>"
                                class="img-fluid w-100" style="height:240px" alt="">
                        </a>
                        <!--End Course Image-->
                        <!--Start Course Card Body-->
                        <div class="course-card_body bg-prussian-blue p-4 position-relative m-0 rounded-0 bg-white">
                            <!--Start Course Title-->
                            <h3 class="course-card__course--title text-capitalize fs-6 mb-0">
                                <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $coursesubscription->course_id); ?>"
                                    class="text-dark text-decoration-none"><?php echo html_escape($coursesubscription->course_name);?></a>
                            </h3>
                            <!--End Course Title-->
                            <!--Start Course instructor-->
                            <div class="course-card__instructor mb-3">
                                <div class="course-card__instructor--name text-black-50 text-uppercase fw-medium fs-13">
                                    by <?php echo get_userinfo($coursesubscription->faculty_id)->name;?></div>
                            </div>
                            <!--End Course instructor-->
                            <!--Start Course Hints-->
                            <table class="course-card__hints table table-borderless table-sm fw-medium">
                                <tbody>
                                    <tr>
                                        <td width="140" class="ps-0">
                                            <div class="d-flex align-items-center">
                                                <div class="course-card__hints--text">
                                                    <span
                                                        class="text-primary"><?php echo completedChapter($coursesubscription->course_id,$enterprise_id,$user_id);?></span>/<?php echo $totalSubChapter;?>
                                                    Chapters
                                                </div>
                                            </div>
                                        </td>
                                        <td>:&nbsp;&nbsp;<span
                                                class="text-primary"><?php echo $totalSubCompleteLesson;?></span>
                                            /<?php echo $totalSubLesson; ?> Lessons</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">
                                            <div class="d-flex align-items-center">
                                                <div class="course-card__hints--text">
                                                    <span
                                                        class="text-primary"><?php echo  $completetotalassignment;?></span>/<?php echo $totalassignment?>
                                                    Assignment
                                                </div>
                                            </div>
                                        </td>
                                        <td>:&nbsp;&nbsp;<span
                                                class="text-primary"><?php echo count($quizComplete);?></span>/
                                            <?php echo count($quizCount);?> Quiz</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!--End Course Hints-->
                            <div class="d-flex justify-content-between text-primary mb-2">
                                <div>Progress</div>
                                <div><?php echo number_format($TotalProgress);?>% Complete</div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped" role="progressbar"
                                    style="width:<?php echo number_format($TotalProgress);?>%"
                                    aria-valuenow="<?php echo number_format($TotalProgress);?>" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <!-- <div class="row g-2 mt-2 justify-content-between">
                                <div class="col align-self-end">
                                    <button type="button" class="btn btn-danger">Completed<i data-feather="arrow-right"
                                            class="ms-2"></i></button>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-outline-secondary w-100">Certificate</button>
                                </div>
                            </div> -->
                            <div class="row g-2 mt-2 justify-content-between">
                                <div class="col align-self-end">
                                    <?php if($TotalProgress==100){?>
                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $coursesubscription->course_id); ?>"
                                        class="btn btn-danger">Completed<i data-feather="arrow-right"
                                            class="ms-2"></i></a>
                                    <?php }elseif($TotalProgress>0){?>
                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $coursesubscription->course_id); ?>"
                                        class="btn" style="background-color:#5475ff;color:#fff">Go To Course<i
                                            data-feather="arrow-right" class="ms-2"></i></a>
                                    <?php }else{?>
                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $coursesubscription->course_id); ?>"
                                        class="btn" style="background-color:#B953FF;color:#fff">Start Now<i
                                            data-feather="arrow-right" class="ms-2"></i></a>
                                    <?php }?>
                                </div>
                                <?php if($TotalProgress==100){?>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-outline-secondary w-100">Certificate</button>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                        <!--End Course Card Body-->
                    </div>
                    <?php //} 
                     }}else{?>
                    <!-- allcourse?param=1 -->
                    <a class="bg-white rounded-6  border d-block h-100 "
                        href="<?php echo base_url($enterprise_shortname. '/allcourse/'); ?>">
                        <!--Start Course Card Body-->
                        <div class="m-0 px-3 py-5 rounded-6 text-center">
                            <div class="border d-inline-block rounded-circle text-center mb-3"
                                style="width:50px;height: 50px;"><i class="d-block text-dark" data-feather="plus"
                                    style="height: 48px;font-size: 25px;margin: 0 auto;"></i></div>
                            <div class="fw-bold text-dark">Find your desired course</div>
                        </div>
                        <!--End Course Card Body-->
                    </a>
                    <div class="rounded-6 empty-box-darker border d-block h-100" href="">
                        <!--Start Course Card Body-->
                        <div class="empty-box-darker m-0 px-3 py-5 rounded-6 text-center">
                            <div class=" d-inline-block rounded-circle text-center mb-3"
                                style="width:50px;height:70px;"><i class="d-block text-dark"
                                    style="height: 48px;font-size: 25px;margin: 0 auto;"></i></div>
                            <div class="fw-bold text-dark"></div>
                        </div>
                        <!--End Course Card Body-->
                    </div>
                    <div class="rounded-6 empty-box-darker border d-block h-100" href="">
                        <!--Start Course Card Body-->
                        <div class="empty-box-darker m-0 px-3 py-5 rounded-6 text-center">
                            <div class="d-inline-block rounded-circle text-center mb-3"
                                style="width:50px;height: 70px;"><i class="d-block text-dark"
                                    style="height: 48px;font-size: 25px;margin: 0 auto;"></i></div>
                            <div class="fw-bold text-dark"></div>
                        </div>
                        <!--End Course Card Body-->
                    </div>
                    <?php }?>
                    <!--End Course Card-->

                </div>
                <div id="show_subscription_data"></div>
                <!--End Course Carousel-->
            </div>
        </div>
    </div>
</div>
<!--End Course Completed-->
<!--Start Course Completed-->
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <div class="row align-items-center justify-content-between mb-4">
                    <div class="col-md-9 col-sm-8 col-lg-10">
                        <div class="alert  d-flex align-items-center justify-content-between py-2 w-100 mb-3 mb-sm-0"
                            role="alert">
                        </div>
                    </div>
                </div>
                <!--Start Section Header-->
                <div class="section-header mb-4">
                    <?php 
                     $purchasecourse=count($purchase_course);?>
                    <div class='row'>
                        <div
                            class="<?php if($purchasecourse<=3){ echo "col-lg-10 col-md-9";}else{ echo "col-lg-9 col-md-8";}?>">
                            <h4 class="fw-semi-bold active_page-text-blue">Purchased Courses</h4>
                            <div class="section-header_divider"></div>
                        </div>
                        <!-- col-lg-4 col-md-5 -->
                        <?php 
                        if(!empty($purchase_course)){
                       // $purchasecourse=count($purchase_course);?>
                        <div
                            class=" <?php if($purchasecourse<=3){ echo "col-md-3 col-sm-4 col-lg-2";}else{ echo "col-md-3 col-sm-4 col-lg-2 ";}?>  mt-4 mt-md-0 px-4">
                            <select class="form-select" id="courseStatus"
                                onchange="studentCourseFiltering(this.value,'purchased','<?php echo $user_id;?>')">
                                <option value="all">All</option>
                                <option value="completed">Completed</option>
                                <option value="incomplete">Incomplete</option>
                            </select>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <!--End Section Header-->
                <!--Start Course Carousel-->
                <div class="courses-carousel  owl-carousel owl-theme" id="before_filtering">
                    <?php 
                 
                        if(!empty($purchase_course)){?>
                    <!--Start Course Card-->
                    <?php 
                        foreach($purchase_course as $single_course){
                        $totalPurchaseCompleteLesson = $this->db->where('course_id',$single_course->product_id)->where('student_id', $user_id)->where('is_complete',1)->where('enterprise_id',$enterprise_id)->get('watch_time_tbl')->num_rows();
                        $totalPurchaseLesson = $this->db->where('course_id',$single_course->product_id)->where('enterprise_id',$enterprise_id)->get('lesson_tbl')->num_rows();
                        $totalPurchaseChapter = $this->db->where('course_id',$single_course->product_id)->where('enterprise_id',$enterprise_id)->get('section_tbl')->num_rows();
                       
                        $totalassignment=$this->db->where('course_id',$single_course->product_id)->where('enterprise_id',$enterprise_id)->get('project_assingment')->num_rows();
                        $completetotalassignment=$this->db->where('course_id',$single_course->product_id)->where('project_type',1)->where('type',1)->where('user_id', $user_id)->where('enterprise_id',$enterprise_id)->where('project_status',1)->get('project_tbl')->num_rows();
                
                 

                        // progress      
                        //======video % start calculation here=================== 
                        $lesson_tbl=$this->db->select('*')->from('lesson_tbl')->where('course_id',$single_course->product_id)->where('lesson_type',1)->where('enterprise_id',$enterprise_id)->get()->result();
                       
                       
                        //isahaq
                        $textFilepercentage=$this->db->select('*')->from('lesson_tbl')
                        ->where('course_id',$single_course->product_id)
                        ->where('lesson_type !=',1)
                        ->where('enterprise_id',$enterprise_id)
                        ->get()
                        ->result();
                        $lesson_count=$this->db->select('*')->from('lesson_tbl')->where('course_id',$single_course->product_id)->where('enterprise_id',$enterprise_id)->get()->num_rows();

                        $quizCount_per=$this->db->select('*')->from('assign_courseexam_tbl')
                        ->where('course_id',$single_course->product_id)
                        ->where('enterprise_id',$enterprise_id)
                        ->get()
                        ->num_rows();
                        $totalassignment_per=$this->db->where('course_id',$single_course->product_id)->where('enterprise_id',$enterprise_id)->get('project_assingment')->num_rows();
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
                        $watch=$this->db->select('*')->from('watch_time_tbl')->where('lesson_id',$lesson_tbl_duration->lesson_id)->where('student_id',$user_id)->where('course_id',$single_course->product_id)->where('enterprise_id',$enterprise_id)->get()->row();
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
                        // new  
                        $videoWatchPercentage=$eachVedioPercent*$total_video_per/100;

                        }else{
                            $videoWatchPercentage=0;
                        }
                        //======video % end calculation here=================== 

                        // text file and pdf  start
                        $textFilePerCalculation=$this->db->where('course_id',$single_course->product_id)->where('lesson_type !=',1)->where('enterprise_id',$enterprise_id)->get('lesson_tbl')->num_rows();
                        $completetextFile = $this->db->where('course_id',$single_course->product_id)->where('student_id', $user_id)->where('file_type',0)->where('is_complete',1)->where('enterprise_id',$enterprise_id)->get('watch_time_tbl')->num_rows();
                        if($completetextFile > 0 && $textFilePerCalculation>0){
                        $Textfilecount=$completetextFile*100/$textFilePerCalculation;
                        $Filecomplete =$Textfilecount*$total_textper/100;
                        }else{
                         $Filecomplete=0;
                        }
            
                        //=========================text file and pdf  end=================================
                        $VideoAndFIle=(!empty($videoWatchPercentage) ? $videoWatchPercentage:'0')+(!empty($Filecomplete) ? $Filecomplete:'0'); //===text file video file % sum 
                        // quiz percentage calculation 
                        $Lessonprogress=($VideoAndFIle*$total_lesson_per)/100;
                        //  quiz  count 
                        $quizCount=$this->db->select('*')->from('assign_courseexam_tbl')
                        ->where('course_id',$single_course->product_id)
                        ->where('enterprise_id',$enterprise_id)
                        // ->where('student_id',$user_id)
                        ->get()
                        ->result();
                        //  quiz complete status count                    
                        $quizComplete=$this->db->select('*')->from('question_exam_tbl')
                        ->where('is_done',1)
                        ->where('course_id',$single_course->product_id)
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
                        if($completetotalassignment > 0 && $totalassignment>0){
                            $assignmentindivisula= ($completetotalassignment*100)/ $totalassignment;
                            $assignment= ($assignmentindivisula*$total_assing_per)/100;
                         }else{
                             $assignment=0;
                         }

                        //  if($completetotalassignment > 0 && $totalassignment>0){
                        //     $assignmentindivisula= ($completetotalassignment*100)/ $totalassignment;
                        //     $assignment= ($assignmentindivisula*25)/100;
                        //  }else{
                        //      $assignment=0;
                        //  }
                         

                        $lesson_tblvideo=$this->db->select('*')->from('lesson_tbl')->where('course_id',$single_course->product_id)->where('lesson_type',1)->where('enterprise_id',$enterprise_id)->get()->num_rows();
            
                        // $Newpercent=1;
                        // // when one or multiple type of course is empty  
                        //  if(empty($quizCount) && empty($totalassignment) && empty($textFilePerCalculation)){
                        //      $Newpercent=4;
                        //  }else if(empty($quizCount) && empty($textFilePerCalculation)){
                        //      $Newpercent=2;
                        //  }else if(empty($quizCount) && empty($totalassignment)){
                        //      $Newpercent=2;
                        //  }else if(empty($totalassignment) && empty($textFilePerCalculation)){
                        //      $Newpercent=2;
                        //  }else{
                        //      if(!empty($quizCount) && !empty($totalassignment) && !empty($textFilePerCalculation)){
                        //          $Newpercent=1;
                        //      }else{
 
                        //          $Newpercent=1.333333333333;
                        //      }
                        //  }
                         $TotalProgress=number_format($Lessonprogress+$quizPercentage+$assignment,1);
                        //  $TotalProgress=number_format(($Filecomplete*$Newpercent)+($videoWatchPercentage*$Newpercent)+($quizPercentage*$Newpercent)+($assignment*$Newpercent),1);
                        // $TotalProgress=number_format($VideoAndFIle+$quizPercentage+$assignment,1); //==Total % calculation 
               
                       
                                               
                        ?>
                    <div class="course-card rounded-20 bg-white position-relative overflow-hidden shadow-none border">
                        <!--Start Course Image-->
                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $single_course->product_id); ?>"
                            class="course-card_img">

                            <img src="<?php echo base_url(html_escape(($single_course->picture) ? "$single_course->picture" : ''));?>"
                                class="img-fluid w-100" style="height:240px" alt="">
                        </a>
                        <!--End Course Image-->
                        <!--Start Course Card Body-->
                        <div class="course-card_body bg-prussian-blue p-4 position-relative m-0 rounded-0 bg-white">
                            <!--Start Course Title-->
                            <h3 class="course-card__course--title text-capitalize fs-6 mb-0">
                                <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $single_course->product_id); ?>"
                                    class="text-dark text-decoration-none"><?php echo $single_course->course_name ?></a>
                            </h3>
                            <!--End Course Title-->
                            <!--Start Course instructor-->
                            <div class="course-card__instructor mb-3">
                                <div class="course-card__instructor--name text-black-50 text-uppercase fw-medium fs-13">
                                    by <?php echo html_escape($single_course->instructor_name);?></div>
                            </div>
                            <!--End Course instructor-->
                            <!--Start Course Hints-->
                            <table class="course-card__hints table table-borderless table-sm fw-medium">
                                <tbody>
                                    <tr>
                                        <td width="140" class="ps-0">
                                            <div class="d-flex align-items-center">
                                                <div class="course-card__hints--text">
                                                    <span
                                                        class="text-primary"><?php echo completedChapter($single_course->product_id,$enterprise_id,$user_id);?></span>/<?php echo $totalPurchaseChapter;?>
                                                    Chapters
                                                </div>
                                            </div>
                                        </td>
                                        <td>&nbsp;&nbsp;<span
                                                class="text-primary"><?php echo $totalPurchaseCompleteLesson;?></span>/<?php echo $totalPurchaseLesson;?>
                                            Lessons</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">
                                            <div class="d-flex align-items-center">
                                                <div class="course-card__hints--text">
                                                    <span
                                                        class="text-primary"><?php echo $completetotalassignment;?></span>/
                                                    <?php echo $totalassignment;?> Assignment
                                                </div>
                                            </div>
                                        </td>
                                        <td>&nbsp;&nbsp;<span class="text-primary"><?php echo count($quizComplete);?>
                                            </span>/ <?php echo count($quizCount);?> Quiz</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!--End Course Hints-->
                            <div class="d-flex fw-bold justify-content-between mb-2">
                                <div style="color: #1270ca;">Progress</div>
                                <div style="color: #1270ca;font-size: 18px;"><?php echo  number_format($TotalProgress);?>% Completed
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped" role="progressbar"
                                    style="width: <?php echo  number_format($TotalProgress);?>%"
                                    aria-valuenow="<?php echo  number_format($TotalProgress);?>" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <div class="row g-2 mt-2 justify-content-between">
                                <div class="col align-self-end">
                                    <?php if($TotalProgress==100){?>
                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $single_course->product_id); ?>"
                                        class="btn btn-danger fs-16 fw-bold">Completed<i data-feather="arrow-right"
                                            class="ms-2"></i></a>
                                    <?php }elseif($TotalProgress>0){?>
                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $single_course->product_id); ?>"
                                        class="btn fs-16 fw-bold" style="background-color:#5475ff;color:#fff">Go To
                                        Course<i data-feather="arrow-right" class="ms-2"></i></a>
                                    <?php }else{?>
                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $single_course->product_id); ?>"
                                        class="btn fs-16 fw-bold" style="background-color:#B953FF;color:#fff">Start
                                        Now<i data-feather="arrow-right" class="ms-2"></i></a>
                                    <?php }?>
                                </div>
                                <?php if($TotalProgress==100){?>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-outline-secondary fw-bold w-100"
                                        style="color: #212529">Certificate</button>
                                </div>
                                <?php }else{?>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-outline-secondary w-100 fs-16 "
                                        disabled>Certificate</button>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                        <!--End Course Card Body-->
                    </div>
                    <?php }}else{?>
                    <a class="rounded-6 border d-block h-100 bg-white"
                        href="<?php echo base_url($enterprise_shortname. '/allcourse/'); ?>">
                        <!--Start Course Card Body-->
                        <div class="m-0 px-3 py-5 rounded-6 text-center">
                            <div class="border d-inline-block rounded-circle text-center mb-3"
                                style="width:50px;height: 50px;"><i class="d-block text-dark" data-feather="plus"
                                    style="height: 48px;font-size: 25px;margin: 0 auto;"></i></div>
                            <div class="fw-bold text-dark">Find your desired course</div>
                        </div>
                        <!--End Course Card Body-->
                    </a>
                    <div class="rounded-6 empty-box-darker border d-block h-100" href="">
                        <!--Start Course Card Body-->
                        <div class="empty-box-darker m-0 px-3 py-5 rounded-6 text-center">
                            <div class=" d-inline-block rounded-circle text-center mb-3"
                                style="width:50px;height:70px;"><i class="d-block text-dark"
                                    style="height: 48px;font-size: 25px;margin: 0 auto;"></i></div>
                            <div class="fw-bold text-dark"></div>
                        </div>
                        <!--End Course Card Body-->
                    </div>
                    <div class="rounded-6 empty-box-darker border d-block h-100" href="">
                        <!--Start Course Card Body-->
                        <div class="empty-box-darker m-0 px-3 py-5 rounded-6 text-center">
                            <div class="d-inline-block rounded-circle text-center mb-3"
                                style="width:50px;height: 70px;"><i class="d-block text-dark"
                                    style="height: 48px;font-size: 25px;margin: 0 auto;"></i></div>
                            <div class="fw-bold text-dark"></div>
                        </div>
                        <!--End Course Card Body-->
                    </div>

                    <?php }?>
                    <!--End Course Card-->

                </div>
                <div id="show_purchase_data"></div>
                <!--End Course Carousel-->
            </div>
        </div>
    </div>
</div>
<!--End Course Completed-->

<!-- Modal -->
<div class="modal fade" id="NoteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="notetitle" class="form-label">Title</label>
                    <input type="text" class="form-control" id="notetitle" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="stickynotesave()"
                    id="stickynotesave">Save</button>
                <!-- <button type="button" class="btn btn-primary" id="stickynoteupdate" onclick="updateStickynote()" style="display: none;">Update</button> -->
            </div>
        </div>
    </div>
</div>




<script>
// $(document).ready(function() {
//     var activity_segment = $("#segment3").val();

//     if (activity_segment.substring(0, 2) == "QE") {
//        var result_status = $("#result_status").val();
//        alert(result_status);return false;
//        if(result_status == 'Passed'){
//         swal({
//                 title: "Congratulation !! ",
//                 text: "You have passed with <?php echo (!empty($obtainedmarks) ? $obtainedmarks : ''); ?> marks",
//                 type: "success",
//                 showCancelButton: false,
//                 confirmButtonColor: '#14AD54',
//                 confirmButtonText: 'OK',
//                 // cancelButtonText: "No",
//                 closeOnConfirm: false,
//                 closeOnCancel: false
//             },
//             function(isConfirm) {
//                 if (isConfirm) {
//                     location.replace(base_url + enterprise_shortname + '/student-activity');
//                 }
//             });
//        }else if(result_status == 'Failed'){
//         swal({
//                 title: "You have failed.",
//                 text: "You need to obtain <?php echo (!empty($get_examresultinfo->pass_mark) ? $get_examresultinfo->pass_mark : ''); ?> marks to pass.You have obtain <?php echo (!empty($obtainedmarks) ? $obtainedmarks : ''); ?> marks.  Don't worry, You can try again later.",
//                 type: "error",
//                 showCancelButton: false,
//                 confirmButtonColor: '#14AD54',
//                 confirmButtonText: 'OK',
//                 // cancelButtonText: "No",
//                 closeOnConfirm: false,
//                 closeOnCancel: false
//             },
//             function(isConfirm) {
//                 if (isConfirm) {
//                     location.replace(base_url + enterprise_shortname + '/student-activity');
//                 }
//             });
//        }
//     }
// });

function studentCourseFiltering(value, enroller_type, id) {

    var type = value;
    var student_id = id;
    var enroller_type = enroller_type;

    $.ajax({
        url: base_url + enterprise_shortname + "/student-course-status-wise-show",
        type: "POST",
        data: {
            csrf_test_name: CSRF_TOKEN,
            student_id: student_id,
            enroller_type: enroller_type,
            type: type
        },
        success: function(r) {
            if (enroller_type == 'purchased') {
                $('#before_filtering').hide();
                $('#show_purchase_data').html(r);
                if (type == 'all') {
                    $('#before_filtering').show();
                }

            }
            if (enroller_type == 'subscrition') {
                $('#before_filtering_subscription').hide();
                $('#show_subscription_data').html(r);
                if (type == 'all') {
                    $('#before_filtering_subscription').show();
                }
            }


            $('.courses-carousel').owlCarousel({
                loop: false,
                margin: 20,
                dots: false,
                nav: true,
                navText: ["<i class='fas fa-caret-left'></i>",
                    "<i class='fas fa-caret-right'></i>"
                ],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });
        },
    });

}
</script>