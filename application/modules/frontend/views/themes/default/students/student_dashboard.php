    <?php
    $user_id = $this->session->userdata('user_id');
    $user_type = $this->session->userdata('user_type');
    function zeroprefix($count)
    {
        $lessoncount = count($count);
        $str_length = 2;
        $lessonnumbershow = substr("0000{$lessoncount}", -$str_length);
        echo $lessonnumbershow;
    }
    $user_id = $this->session->userdata('user_id');

    //   echo $this->session->userdata('subscription_id');
    ?>
    <style>
    .chartjs-render-monitor {
        min-height: 420px !important;
    }

    .interestcheck {
        background: #ffbc00;
        border-color: #ffbc00;
        color: #000;
        /* background-color: #0dcaf0;
        border-color: #0dcaf0; */
    }

    .topics_select .interestcheck {
        width: 45px;
        height: 45px;
    }
    </style>
    <!--Start Student Profile Header-->
    <?php $this->load->view('dashboard_coverpage');?>
    <!--End Student Profile Header-->



    <div class="bg-dark-cerulean sticky-nav">
        <div class="container-lg">
            <?php
    $this->load->view('dashboard_topmenu');
    ?>
        </div>
    </div>

    <!--Start Course Overview-->
    <div class="bg-alice-blue py-3">
        <div class="container-lg">
            <!--Start Section Header-->
            <div class="section-header mb-4">
                <div class='row'>
                    <div class="col-lg-11 col-md-11">
                        <h4>Course Overview</h4>
                        <div class="section-header_divider"></div>
                    </div>
                    <?php if ($courses_overviews) {?>
                    <div class="col-lg-1 col-md-1 mt-4 mt-md-0">
                        <a href="<?php echo base_url($enterprise_shortname . '/student-courses-overviews'); ?>"
                            style="color:black">See All</a>
                    </div>
                    <?php }?>
                </div>
            </div>
            <!--End Section Header-->
            <div class="row">
                <?php
                // d($courses_overviews);
    if ($courses_overviews) {
        ?>
                <?php
    $i = 0;
        foreach ($courses_overviews as $course_overview) {
   
            $course_id = $course_overview->product_id ? $course_overview->product_id : '';
            $course_name = $course_overview->course_name ? $course_overview->course_name : '';
            $instructor_name = $course_overview->faculty_id ? $course_overview->faculty_id : '';

            $totalSubCompleteLesson = $this->db->where('course_id', $course_id)->where('student_id', $user_id)->where('is_complete', 1)->where('enterprise_id', $enterprise_id)->get('watch_time_tbl')->num_rows();
            $totalSubLesson = $this->db->where('course_id', $course_id)->where('enterprise_id', $enterprise_id)->get('lesson_tbl')->num_rows();
            $totalSubChapter = $this->db->where('course_id', $course_id)->where('enterprise_id', $enterprise_id)->get('section_tbl')->num_rows();

            // progress
            //======video % start calculation here===================
            $lesson_tbl = $this->db->select('*')->from('lesson_tbl')->where('course_id', $course_id)->where('lesson_type', 1)->where('enterprise_id', $enterprise_id)->get()->result();
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
            $eachVideoDuration = 0;
            $TotalWatchTime = 0;
            //isahaq
            $total_lesson_per = ($lesson_count > 0?50:0) + ($quizCount_per == 0?25:0) + ($totalassignment_per == 0?25:0);
            $total_quize_per  = ($quizCount_per > 0?25:0);
            $total_assing_per = ($totalassignment_per > 0?25:0);
            //isahaq
            $i = 0;
            //isahaq
            $total_video_per  = ($lesson_tbl?50:0) + (empty($textFilepercentage)?50:0);
            $total_textper    = (empty($lesson_tbl)?50:0) + ($textFilepercentage?50:0);
            foreach ($lesson_tbl as $lesson_tbl_duration) {
                list($hour, $minute, $second) = explode(':', html_escape($lesson_tbl_duration->duration));
                $hour1 = $hour * 3600;
                $minute1 = $minute * 60;
                $second1 = $second;
                $eachVideoDuration = $hour1 + $minute1 + $second1;
                $toTalLessonVideoDuration += $eachVideoDuration; //all lesson duration
                $watch = $this->db->select('*')->from('watch_time_tbl')->where('lesson_id', $lesson_tbl_duration->lesson_id)->where('student_id', $user_id)->where('course_id', $course_id)->where('enterprise_id', $enterprise_id)->get()->row();
                $eachvideoWatchTime = (!empty($watch->real_time) ? $watch->real_time : '1');
                if ($eachvideoWatchTime <= $eachVideoDuration) {
                    $TotalWatchTime += @$watch->real_time; //single video watch time
                } else {
                    $TotalWatchTime += $eachVideoDuration;
                }
            }
            if ($TotalWatchTime > 0 && $toTalLessonVideoDuration > 0) {
                $eachVedioPercent = number_format((@$TotalWatchTime * 100) / $toTalLessonVideoDuration, 2); //each video percentage
                $TotalVideo = $eachVedioPercent;
                // new
                $videoWatchPercentage=$eachVedioPercent*$total_video_per/100;

            } else {
                $videoWatchPercentage = 0;
            }
            //======video % end calculation here===================

            // text file and pdf  start
            $textFilePerCalculation = $this->db->where('course_id', $course_id)->where('lesson_type !=', 1)->where('enterprise_id', $enterprise_id)->get('lesson_tbl')->num_rows();
            $completetextFile = $this->db->where('course_id', $course_id)->where('student_id', $user_id)->where('file_type', 0)->where('is_complete', 1)->where('enterprise_id', $enterprise_id)->get('watch_time_tbl')->num_rows();
            if ($completetextFile > 0 && $textFilePerCalculation > 0) {
                $Textfilecount = $completetextFile * 100 / $textFilePerCalculation;
                $Filecomplete =$Textfilecount*$total_textper/100;
            } else {
                $Filecomplete = 0;
            }
           
            //=========================text file and pdf  end=================================
            $VideoAndFIle=(!empty($videoWatchPercentage) ? $videoWatchPercentage:'0')+(!empty($Filecomplete) ? $Filecomplete:'0');
            $Lessonprogress=($VideoAndFIle*$total_lesson_per)/100;

            // quiz percentage calculation
            //  quiz  count
            $quizCount = $this->db->select('*')->from('assign_courseexam_tbl')
                ->where('course_id', $course_id)
                ->where('enterprise_id', $enterprise_id)
            // ->where('student_id',$user_id)
                ->get()
                ->result();
            //  quiz complete status count
            $quizComplete = $this->db->select('*')->from('question_exam_tbl')
                ->where('is_done', 1)
                ->where('course_id', $course_id)
                ->where('enterprise_id', $enterprise_id)
                ->where('student_id', $user_id)
                ->get()
                ->result();
            if (count($quizComplete) > 0 && count($quizCount) > 0) {
                $quizindivisualP = (count($quizComplete) * 100) / count($quizCount);
                $quizPercentage =$quizindivisualP*$total_quize_per/100;
            } else {
                $quizPercentage = 0;
            }

            // $TotalProgress=number_format($VideoAndFIle+$quizPercentage+25,1); //==Total % calculation
            $totalassignment = $this->db->where('course_id', $course_id)->where('enterprise_id', $enterprise_id)->get('project_assingment')->num_rows();
            $completetotalassignment = $this->db->where('course_id', $course_id)->where('project_type', 1)->where('type', 1)->where('user_id', $user_id)->where('enterprise_id', $enterprise_id)->where('project_status', 1)->get('project_tbl')->num_rows();

            if ($completetotalassignment > 0 && $totalassignment > 0) {
                $assignmentindivisula = ($completetotalassignment * 100) / $totalassignment;
                $assignment= ($assignmentindivisula*$total_assing_per)/100;
            } else {
                $assignment = 0;
            }

            // when one or multiple type of course is empty
            // $Newpercent = 1;
            // if (empty($quizCount) && empty($totalassignment) && empty($textFilePerCalculation)) {
            //     $Newpercent = 4;
            // } else if (empty($quizCount) && empty($textFilePerCalculation)) {
            //     $Newpercent = 2;
            // } else if (empty($quizCount) && empty($totalassignment)) {
            //     $Newpercent = 2;
            // } else if (empty($totalassignment) && empty($textFilePerCalculation)) {
            //     $Newpercent = 2;
            // } else {
            //     if (!empty($quizCount) && !empty($totalassignment) && !empty($textFilePerCalculation)) {
            //         $Newpercent = 1;
            //     } else {

            //         $Newpercent = 1.333333333333;
            //     }
            // }

            //end

            // $TotalProgress = number_format(($Filecomplete * $Newpercent) + ($videoWatchPercentage * $Newpercent) + ($quizPercentage * $Newpercent) + ($assignment * $Newpercent), 1);
            $TotalProgress=number_format($Lessonprogress+$quizPercentage+$assignment,1);
            $result = $this->db->select("*")->from('invoice_tbl')->where('is_subscription', 1)->where('status', 1)->where('invoice_id', $course_overview->invoice_id)->get()->row();
            if ($course_overview->is_subscription == 1) {

                $startdate = $result->expeiredate;
                $expiredate = date('Y-m-d', strtotime($startdate));
                $todayDate = date('Y-m-d');
            
                if($result){
                if ($expiredate > $todayDate) {
                    // echo $expiredate;
                    ?>
                <div class="col-lg-4 col-sm-6">
                    <!--Start Course Card-->
                    <div
                        class="course-card my-lg-0 my-2 rounded-20 bg-white position-relative overflow-hidden shadow-none border">
                        <!--Start Course Image-->
                        <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $course_id); ?>"
                            class="course-card_img">
                            <img src="<?php echo base_url(!empty(get_picturebyid($course_id)->picture) ? get_picturebyid($course_id)->picture : default_600_400()); ?>"
                                class="img-fluid w-100" style="height:240px" alt="">
                        </a>
                        <!--End Course Image-->
                        <!--Start Course Card Body-->
                        <div class="course-card_body bg-prussian-blue p-4 position-relative m-0 rounded-0 bg-white">
                            <!--Start Course Title-->
                            <h3 class="course-card__course--title text-capitalize fs-6 mb-0">
                                <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $course_id); ?>"
                                    class="text-dark text-decoration-none"><?php echo html_escape($course_name); ?></a>
                            </h3>
                            <!--End Course Title-->
                            <!--Start Course instructor-->
                            <div class="course-card__instructor mb-3">
                                <div class="course-card__instructor--name text-black-50 text-uppercase fw-medium fs-13">by
                                    <?php echo html_escape(get_userinfo($instructor_name)->name); ?></div>
                            </div>
                            <!--End Course instructor-->
                            <!--Start Course Hints-->
                            <table class="course-card__hints table table-borderless table-sm fw-medium">
                                <tbody>
                                    <tr>
                                        <td class="ps-0">
                                            <div class="d-flex align-items-center">
                                                <div class="course-card__hints--text">
                                                    <span
                                                        class="text-primary"><?php echo completedChapter($course_id, $enterprise_id, $user_id); ?></span>/<?php echo $totalSubChapter; ?>
                                                    Chapters
                                                </div>
                                            </div>
                                        </td>
                                        <td> &nbsp;&nbsp;<span
                                                class="text-primary"><?php echo $totalSubCompleteLesson; ?></span>/<?php echo $totalSubLesson; ?>
                                            Lessons</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">
                                            <div class="d-flex align-items-center">
                                                <div class="course-card__hints--text">
                                                    <span
                                                        class="text-primary"><?php echo $completetotalassignment; ?></span>/<?php echo $totalassignment; ?>
                                                    Assignment
                                                </div>
                                            </div>
                                        </td>
                                        <td> &nbsp;&nbsp;<span
                                                class="text-primary"><?php echo count($quizComplete); ?></span>/<?php echo count($quizCount) ?>
                                            Quiz</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!--End Course Hints-->
                            <div class="d-flex fw-bold justify-content-between mb-2">
                                <div style="color: #1270ca;">Progress</div>
                                <div style="color: #1270ca;font-size: 18px;">
                                    <?php echo $TotalProgress ? number_format($TotalProgress) : '0'; ?>% Completed</div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped" role="progressbar"
                                    style="width:<?php echo $TotalProgress ? number_format($TotalProgress) : '0'; ?>%"
                                    aria-valuenow="55<?php echo $TotalProgress ? number_format($TotalProgress) : '0'; ?>" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--End Course Card Body-->
                    </div>
                    <!--End Course Card-->
                </div>
                <?php 
                //  continue;
                //$i++;
                }}} else {
            // if ($course_overview->is_subscription != 1) {   ?>
                <div class="col-lg-4 col-sm-6">
                    <!--Start Course Card-->
                    <div
                        class="course-card my-lg-0 my-2 rounded-20 bg-white position-relative overflow-hidden shadow-none border">
                        <!--Start Course Image-->
                        <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $course_id); ?>"
                            class="course-card_img">
                            <img src="<?php echo base_url(!empty(get_picturebyid($course_id)->picture) ? get_picturebyid($course_id)->picture : default_600_400()); ?>"
                                class="img-fluid w-100" alt="">
                        </a>
                        <!--End Course Image-->
                        <!--Start Course Card Body-->
                        <div class="course-card_body bg-prussian-blue p-4 position-relative m-0 rounded-0 bg-white">
                            <!--Start Course Title-->
                            <h3 class="course-card__course--title text-capitalize fs-6 mb-0">
                                <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $course_id); ?>"
                                    class="text-dark text-decoration-none"><?php echo html_escape($course_name); ?></a>
                            </h3>
                            <!--End Course Title-->
                            <!--Start Course instructor-->
                            <div class="course-card__instructor mb-3">
                                <div class="course-card__instructor--name text-black-50 text-uppercase fw-medium fs-13">by
                                    <?php echo html_escape(get_userinfo($instructor_name)->name); ?></div>
                            </div>
                            <!--End Course instructor-->
                            <!--Start Course Hints-->
                            <table class="course-card__hints table table-borderless table-sm fw-medium">
                                <tbody>
                                    <tr>
                                        <td class="ps-0">
                                            <div class="d-flex align-items-center">
                                                <div class="course-card__hints--text">
                                                    <span
                                                        class="text-primary"><?php echo completedChapter($course_id, $enterprise_id, $user_id); ?></span>/<?php echo $totalSubChapter; ?>
                                                    Chapters
                                                </div>
                                            </div>
                                        </td>
                                        <td>&nbsp;&nbsp;<span
                                                class="text-primary"><?php echo $totalSubCompleteLesson; ?></span>/<?php echo $totalSubLesson; ?>
                                            Lessons</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">
                                            <div class="d-flex align-items-center">
                                                <div class="course-card__hints--text">
                                                    <span
                                                        class="text-primary"><?php echo $completetotalassignment; ?></span>/<?php echo $totalassignment; ?>
                                                    Assignment
                                                </div>
                                            </div>
                                        </td>
                                        <td>&nbsp;&nbsp;<span
                                                class="text-primary"><?php echo count($quizComplete); ?></span>/<?php echo count($quizCount) ?>
                                            Quiz</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!--End Course Hints-->
                            <div class="d-flex fw-bold justify-content-between mb-2">
                                <div style="color: #1270ca;">Progress</div>
                                <div style="color: #1270ca;font-size: 18px;">
                                    <?php echo $TotalProgress ? number_format($TotalProgress) : '0'; ?>% Completed</div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped" role="progressbar"
                                    style="width:<?php echo $TotalProgress ? number_format($TotalProgress) : '0'; ?>%"
                                    aria-valuenow="55<?php echo $TotalProgress ? number_format($TotalProgress) : '0'; ?>" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--End Course Card Body-->
                    </div>
                    <!--End Course Card-->
                </div>
                <?php //}
                }
                }?>
                <?php } else {?>
                <div class="col-lg-4 col-sm-6">
                    <!--Start Course Card-->
                    <a href="<?php echo base_url($enterprise_shortname . '/allcourse/'); ?>"
                        class="bg-white d-block h-100 rounded-6">
                        <!--Start Course Image-->
                        <!--Start Course Card Body-->
                        <div class="m-0 px-3 py-5 rounded-6 text-center">

                            <div class="border d-inline-block rounded-circle text-center mb-3"
                                style="width:50px;height: 50px;"><i class="d-block text-dark" data-feather="plus"
                                    style="height: 48px;font-size: 25px;margin: 0 auto;"></i></div>
                            <div class="fw-bold text-dark">Find your desired course</div>
                        </div>
                        <!--End Course Card Body-->
                    </a>
                    <!--End Course Card-->
                </div>
                <div class="col-lg-4 col-sm-6">
                    <!--Start Course Card-->
                    <div class="empty-box-darker d-block h-100 rounded-6">
                        <!--Start Course Image-->

                    </div>
                    <!--End Course Card-->
                </div>
                <div class="col-lg-4 col-sm-6">
                    <!--Start Course Card-->
                    <div href="" class="empty-box-darker d-block h-100 rounded-6">
                        <!--Start Course Image-->
                    </div>
                    <!--End Course Card-->
                </div>
                <?php }?>




            </div>
        </div>
    </div>
    <!--End Course Overview-->
    <!--Start Upgrade Alert-->
    <div class="bg-alice-blue py-3">
        <div class="container-lg">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </symbol>
                <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                </symbol>
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </symbol>
            </svg>
            <!-- <div class="alert alert-danger d-flex align-items-center mb-0" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div class="d-flex align-items-center justify-content-between w-100">
                    <span class="fs-6">You Have 5 Days Left On Your Subscription</span>
                    <button type="button" class="btn btn-danger">Upgrade</button>
                </div>
            </div> -->
            <?php
    if ($checksubscription_day_left) {

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
        // $create_date = date("Y-m-d", strtotime($checksubscription_day_left->expeiredate));
        // if ($checksubscription_day_left->duration == 1) {
        //     $last_date = date('Y-m-d', strtotime($create_date . ' + 30 days'));
        // } else {
        //     $last_date = date('Y-m-d', strtotime($create_date . ' + 365 days'));
        // }
        // $event_date = strtotime($last_date); // or whenever the diwali is
        // $current = strtotime('now');

        // $diffference = ($event_date - $current);
        // $days = ceil($diffference / (60 * 60 * 24));
        // if ($days == 0) {
        //     $days = 1;
        // }
        //    if($days<=5){
        ?>
            <div class="alert alert-danger d-flex align-items-center justify-content-between py-2 w-100 mb-3 mb-sm-0"
                role="alert">
                <div>
                    <i data-feather="info" class="me-2"></i><span> <?php if ($days > 0) {echo "you have " . $days . " days left on your
                                subscrition";} else {echo "Your Subscription is expired " . abs($days) . " days ago";}?>
                    </span>
                </div>
                <a href="<?php echo base_url($enterprise_shortname . '/subscription-details'); ?>"
                    class="btn btn-info">Upgrade</a>

            </div>
            <?php
    //   }
    }
    ?>
        </div>
    </div>
    <!--End Upgrade Alert-->
    <?php
    //=========all enrolled course=========================
    $studentCompleteCourseOverview = $this->Frontend_model->studentCompleteCourseOverview($user_id, $enterprise_id); // this is used bellow all section
    $studentSkillProgress = $this->Frontend_model->studentSkillProgress($user_id, $enterprise_id); // this is used bellow all section

    // all enrolled course
    $studentAllenRolledCourseCount = $this->db->where('customer_id', $user_id)->where('enterprise_id', $enterprise_id)->where('status', 1)->group_by('product_id')->get('invoice_details')->num_rows();
    // all incomplete course
    $studentIncompleteCourseCount = $this->db->where('customer_id', $user_id)->where('enterprise_id', $enterprise_id)->where('status', 1)->where('complete_status', 0)->group_by('product_id')->get('invoice_details')->num_rows();
    // all complete course
    $studentCompleteCourseCount = $this->db->where('customer_id', $user_id)->where('enterprise_id', $enterprise_id)->where('status', 1)->where('complete_status', 1)->group_by('product_id')->get('invoice_details')->num_rows();
    //  Achived certificate
    $CertificateAchieved = $this->db->where('user_id', $user_id)->where('enterprise_id', $enterprise_id)->get('certificate_mapping_tbl')->num_rows();

    // Total Watch Time  count
    $total_watch_time = $this->db->select('SUM(real_time) as time')->from('watch_time_tbl')->where('student_id', $user_id)->where('enterprise_id', $enterprise_id)->get()->row();
    $totalTime = $total_watch_time->time ? $total_watch_time->time : '0';
    $s = $totalTime % 60;
    $m = ($totalTime % 3600) / 60;
    $h = ($totalTime % 86400) / 3600;
    // Total Watch Time end
    //  total complete lesson count
    $completeLesson = $this->db->select('count(is_complete) as complete')
        ->from('watch_time_tbl')
        ->where('is_complete', 1)
        ->where('student_id', $user_id)
        ->where('enterprise_id', $enterprise_id)
        ->get()->row();
    $complete = $completeLesson->complete ? $completeLesson->complete : '0';
    // end total complete lesson count
    ?>
    <div class="bg-alice-blue py-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-lg-6 col-xl-4 d-flex flex-column">
                    <!--Start Section Header-->
                    <div class="section-header mb-4">
                        <h5>Progress Overview</h5>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                    <div class="card border-0 rounded-0 shadow-sm flex-fill w-100  mb-3 mb-xl-0">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-sm-6 col-md-6 d-flex">
                                    <div class="row g-0 border rounded shadow-sm flex-fill w-100">
                                        <div class="col-8 align-self-center text-center py-2 px-1">
                                            <div
                                                class="progress-icon d-flex align-items-center justify-content-center text-white m-auto mb-2">
                                                <i data-feather="book"></i>
                                            </div>
                                            <div class="fs-13 fw-semi-bold">Enrolled Courses</div>
                                        </div>
                                        <div
                                            class="col-4 d-flex align-items-center justify-content-center fs-5 fw-semi-bold progress-counter">
                                            <?php echo html_escape($studentAllenRolledCourseCount ? $studentAllenRolledCourseCount : '0'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 d-flex">
                                    <div class="row g-0 border rounded shadow-sm flex-fill w-100">
                                        <div class="col-8 align-self-center text-center py-2 px-1">
                                            <div
                                                class="progress-icon d-flex align-items-center justify-content-center text-white m-auto mb-2">
                                                <i data-feather="clock"></i>
                                            </div>
                                            <?php

    //  $e=0;
    //  $complete_course_progress=0;
    //  $incomplete_course_progress=0;
    //  $TotalProgress=0;
    //  foreach($studentAllenRolledCourse as $coures){
    //     $course_id = $coures->product_id?$coures->product_id:$coures->course_id;
    //     // progress
    // //======video % start calculation here===================
    // $lesson_tbl=$this->db->select('*')->from('lesson_tbl')->where('course_id',$course_id)->where('lesson_type',1)->where('enterprise_id',$enterprise_id)->get()->result();
    // $toTalLessonVideoDuration = 0;
    // $eachVideoDuration= 0;
    // $TotalWatchTime=0;
    // $i=0;
    // foreach ($lesson_tbl as $lesson_tbl_duration) {
    //     list($hour, $minute, $second) = explode(':', html_escape($lesson_tbl_duration->duration));
    //     $hour1 = $hour * 3600;
    //     $minute1 = $minute * 60;
    //     $second1 = $second;
    // $eachVideoDuration=$hour1+$minute1+$second1;
    // $toTalLessonVideoDuration +=$eachVideoDuration; //all lesson duration
    // $watch=$this->db->select('*')->from('watch_time_tbl')->where('lesson_id',$lesson_tbl_duration->lesson_id)->where('student_id',$user_id)->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->get()->row();
    // $eachvideoWatchTime=(!empty($watch->real_time) ? $watch->real_time : '1');
    // if($eachvideoWatchTime<=$eachVideoDuration){
    //     $TotalWatchTime +=@$watch->real_time; //single video watch time
    // }else{
    //     $TotalWatchTime +=$eachVideoDuration;
    // }
    // }
    // if($TotalWatchTime > 0 && $toTalLessonVideoDuration>0){
    // $eachVedioPercent = number_format((@$TotalWatchTime * 100 )/ $toTalLessonVideoDuration,2); //each video percentage
    // $TotalVideo=$eachVedioPercent;
    // // new
    // $videoWatchPercentage=$eachVedioPercent*25/100;

    // }else{
    //     $videoWatchPercentage=0;
    // }
    // //======video % end calculation here===================

    // // text file and pdf  start
    // $textFilePerCalculation=$this->db->where('course_id',$course_id)->where('lesson_type !=',1)->where('enterprise_id',$enterprise_id)->get('lesson_tbl')->num_rows();
    // $completetextFile = $this->db->where('course_id',$course_id)->where('student_id', $user_id)->where('file_type',0)->where('is_complete',1)->where('enterprise_id',$enterprise_id)->get('watch_time_tbl')->num_rows();
    // if($completetextFile > 0 && $textFilePerCalculation>0){
    // $Textfilecount=$completetextFile*100/$textFilePerCalculation;
    // }else{
    // $Textfilecount=0;
    // }
    // $Filecomplete =$Textfilecount*25/100;
    // //=========================text file and pdf  end=================================
    // $VideoAndFIle=(!empty($videoWatchPercentage) ? $videoWatchPercentage:'0')+(!empty($Filecomplete) ? $Filecomplete:'0'); //===text file video file % sum

    // // quiz percentage calculation
    // //  quiz  count
    // $quizCount=$this->db->select('*')->from('question_exam_tbl')
    // ->where('course_id',$course_id)
    // ->where('enterprise_id',$enterprise_id)
    // ->where('student_id',$user_id)
    // ->get()
    // ->result();
    // //  quiz complete status count
    // $quizComplete=$this->db->select('*')->from('question_exam_tbl')
    // ->where('is_done',1)
    // ->where('course_id',$course_id)
    // ->where('enterprise_id',$enterprise_id)
    // ->where('student_id',$user_id)
    // ->get()
    // ->result();
    // if(count($quizComplete) > 0 && count($quizCount)>0){
    // $quizindivisualP=(count($quizComplete)*100)/count($quizCount);
    // $quizPercentage =$quizindivisualP*25/100;
    // }else{
    // $quizPercentage=0;
    // }
    // $q=25;

    // $TotalProgress=number_format($VideoAndFIle+$quizPercentage+25,1); //==Total % calculation

    //     if($TotalProgress==100){
    //         $complete_course_progress +=1;
    //     }
    //     if($TotalProgress!=100){
    //         $incomplete_course_progress +=1;
    //     }
    //   $e++;
    //  }

    ?>
                                            <div class="fs-13 fw-semi-bold">Learning Hour</div>
                                        </div>
                                        <div
                                            class="col-4 d-flex align-items-center justify-content-center fs-5 fw-semi-bold progress-counter">
                                            <?php echo html_escape(number_format($h, 0)); ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 d-flex">
                                    <div class="row g-0 border rounded shadow-sm flex-fill w-100">
                                        <div class="col-8 align-self-center text-center py-2 px-1">
                                            <div
                                                class="progress-icon d-flex align-items-center justify-content-center text-white m-auto mb-2">
                                                <i data-feather="bar-chart"></i>
                                            </div>
                                            <div class="fs-13 fw-semi-bold">Courses in progress</div>
                                        </div>
                                        <div
                                            class="col-4 d-flex align-items-center justify-content-center fs-5 fw-semi-bold progress-counter">
                                            <?php echo html_escape($studentIncompleteCourseCount ? $studentIncompleteCourseCount : '0'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 d-flex">
                                    <div class="row g-0 border rounded shadow-sm flex-fill w-100">
                                        <div class="col-8 align-self-center text-center py-2 px-1">
                                            <div
                                                class="progress-icon d-flex align-items-center justify-content-center text-white m-auto mb-2">
                                                <i data-feather="book-open"></i>
                                            </div>
                                            <div class="fs-13 fw-semi-bold">Lessons Completed</div>
                                        </div>
                                        <div
                                            class="col-4 d-flex align-items-center justify-content-center fs-5 fw-semi-bold progress-counter">
                                            <?php echo html_escape($complete); ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 d-flex">
                                    <div class="row g-0 border rounded shadow-sm flex-fill w-100">
                                        <div class="col-8 align-self-center text-center py-2 px-1">
                                            <div
                                                class="progress-icon d-flex align-items-center justify-content-center text-white m-auto mb-2">
                                                <i data-feather="check-square"></i>
                                            </div>
                                            <div class="fs-13 fw-semi-bold">Course Completed</div>
                                        </div>
                                        <div
                                            class="col-4 d-flex align-items-center justify-content-center fs-5 fw-semi-bold progress-counter">
                                            <?php echo html_escape($studentCompleteCourseCount ? $studentCompleteCourseCount : '0'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 d-flex">
                                    <div class="row g-0 border rounded shadow-sm flex-fill w-100">
                                        <div class="col-8 align-self-center text-center py-2 px-1">
                                            <div
                                                class="progress-icon d-flex align-items-center justify-content-center text-white m-auto mb-2">
                                                <i data-feather="award"></i>
                                            </div>
                                            <div class="fs-13 fw-semi-bold">Certificate Achieved</div>
                                        </div>
                                        <div
                                            class="col-4 d-flex align-items-center justify-content-center fs-5 fw-semi-bold progress-counter">
                                            <?php echo html_escape($CertificateAchieved); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4 d-flex flex-column">
                    <!--Start Section Header-->
                    <div class="section-header mb-4">
                        <h5>Skills Progress</h5>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                    <div class="card border-0 rounded-0 shadow-sm flex-fill w-100 mb-3 mb-xl-0">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between mb-4">
                                <!-- <h6 class="fs-5 mb-0">Skills Progress</h6> -->
                                <!-- <a href="#">View All</a> -->
                            </div>
                            <table class="table table-borderless mb-0 white-space-nowrap">
                                <tbody>
                                    <?php
                                    if ($studentSkillProgress) {
                                    
                                        $sss=0;
                                        foreach ($studentSkillProgress as $skill) {
                                            $studentSkill_category_wise_course=$this->Frontend_model->studentSkill_category_wise_course($skill->category_id,$user_id,$enterprise_id);
                                            $skillcomplete = 0;
                                            $skillIncomplete = 0;
                                            foreach( $studentSkill_category_wise_course as $skills){
                                            $lesson_tbl=$this->db->select('*')->from('lesson_tbl')->where('course_id',$skills->course_id)->where('lesson_type',1)->where('enterprise_id',$enterprise_id)->get()->result();
                                                  
                                            //isahaq
                                            $textFilepercentage=$this->db->select('*')->from('lesson_tbl')
                                            ->where('course_id',$skills->course_id)
                                            ->where('lesson_type !=',1)
                                            ->where('enterprise_id',$enterprise_id)
                                            ->get()
                                            ->result();
                                            $lesson_count=$this->db->select('*')->from('lesson_tbl')->where('course_id',$skills->course_id)->where('enterprise_id',$enterprise_id)->get()->num_rows();

                                            $quizCount_per=$this->db->select('*')->from('assign_courseexam_tbl')
                                            ->where('course_id',$skills->course_id)
                                            ->where('enterprise_id',$enterprise_id)
                                            ->get()
                                            ->num_rows();
                                            $totalassignment_per=$this->db->where('course_id',$skills->course_id)->where('enterprise_id',$enterprise_id)->get('project_assingment')->num_rows();
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
                                                    $watch=$this->db->select('*')->from('watch_time_tbl')->where('lesson_id',$lesson_tbl_duration->lesson_id)->where('student_id',$user_id)->where('course_id',$skills->course_id)->where('enterprise_id',$enterprise_id)->get()->row();
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
                                                                                    ->where('course_id',$skills->course_id)
                                                                                    ->where('lesson_type !=',1)
                                                                                    ->where('enterprise_id',$enterprise_id)
                                                                                    ->get()
                                                                                    ->result();
                                                    $completetextFile = $this->db->where('course_id',$skills->course_id)
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
                                                    $VideoAndFIle=(!empty($videoWatchPercentage) ? $videoWatchPercentage:'0')+(!empty($Filecomplete) ? $Filecomplete:'0');
                                                    $Lessonprogress=($VideoAndFIle*$total_lesson_per)/100;

                                                    //  quiz  count 
                                                    $quizCount=$this->db->select('*')->from('assign_courseexam_tbl')
                                                                        ->where('course_id',$skills->course_id)
                                                                        ->where('enterprise_id',$enterprise_id)
                                                                        //   ->where('student_id',$user_id)
                                                                        ->get()
                                                                        ->result();
                                                    //  quiz complete status count                    
                                                    $quizComplete=$this->db->select('*')->from('question_exam_tbl')
                                                                        ->where('is_done',1)
                                                                        ->where('course_id',$skills->course_id)
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

                                                    $totalassignment=$this->db->where('course_id',$skills->course_id)->where('enterprise_id',$enterprise_id)->get('project_assingment')->num_rows();
                                                    $completetotalassignment=$this->db->where('course_id',$skills->course_id)->where('project_type',1)->where('type',1)->where('user_id', $user_id)->where('enterprise_id',$enterprise_id)->where('project_status',1)->get('project_tbl')->num_rows();

                                                    if($completetotalassignment > 0 && $totalassignment>0){
                                                        $assignmentindivisula= ($completetotalassignment*100)/ $totalassignment;
                                                        $assignment= ($assignmentindivisula*$total_assing_per)/100;
                                                    }else{
                                                        $assignment=0;
                                                    }
                                                    



                                                    
                                                    
                                                    $totalassignment=$this->db->where('course_id',$skills->course_id)->where('enterprise_id',$enterprise_id)->get('project_assingment')->num_rows();
                                                    $lesson_tblvideo=$this->db->select('*')->from('lesson_tbl')->where('course_id',$skills->course_id)->where('lesson_type',1)->where('enterprise_id',$enterprise_id)->get()->num_rows();
                                                    $textFilePerCalculation=$this->db->select('*')->from('lesson_tbl')->where('course_id',$skills->course_id)->where('lesson_type !=',1)->where('enterprise_id',$enterprise_id)->get()->num_rows();
                                                    $quizCount=$this->db->select('*')->from('assign_courseexam_tbl')->where('course_id',$skills->course_id)->where('enterprise_id',$enterprise_id)->get()->num_rows();

                                                    // when one or multiple type of course is empty  
                                                    // $Newpercent=1;
                                                    // if(empty($quizCount) && empty($totalassignment) && empty($textFilePerCalculation)){
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
                                                
                                        // $TotalProgress=number_format(($Filecomplete*$Newpercent)+($videoWatchPercentage*$Newpercent)+($quizPercentage*$Newpercent)+($assignment*$Newpercent),1);
                                            $TotalProgress=number_format($Lessonprogress+$quizPercentage+$assignment,1);
                                             if ($TotalProgress == 100) {
                                                    $skillcomplete += 1;
                                                }
                                                if ($TotalProgress != 100) {
                                                    $skillIncomplete += 1;
                                                }

                                                $CategoryComplete = ceil(($skillcomplete * 100) / $skill->totalSale); 
                                                // print_r($CategoryComplete);
                                            }
                                
                                            

                                            ?>
                                    <tr>
                                        <td class="fw-semi-bold align-middle ps-0">
                                            <?php echo $skill->category_name//.$skill->totalSale." Complete ".($skillcomplete?$skillcomplete:'0')."<br>"; ?>
                                        </td>
                                        <td class="align-middle bar-width">
                                            <div class="rating-percent">
                                                <div class="progress">
                                                    <div class="progress-bar bg-success progress-bar-striped"
                                                        role="progressbar"
                                                        style="width: <?php echo (!empty($CategoryComplete) ? $CategoryComplete : 0); ?>%"
                                                        aria-valuenow="<?php echo (!empty($CategoryComplete) ? $CategoryComplete : 0); ?>"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="text-muted">
                                                <?php echo (!empty($CategoryComplete) ? $CategoryComplete : 0); ?>%</div>
                                        </td>
                                    </tr>
                                    <?php }} else {?>
                                    <a class="border d-flex mb-2 p-3 rounded text-center bg-white"
                                        href="<?php echo base_url($enterprise_shortname . '/allcourse/'); ?>">
                                        <div class="flex-grow-1">
                                            <div class="border d-inline-block rounded-circle text-center mb-2"
                                                style="width:50px;height: 50px;">
                                                <i class="d-block text-dark" data-feather="plus"
                                                    style="height: 48px;font-size: 25px;margin: 0 auto;"></i>
                                            </div>
                                            <div class="fw-bold text-dark">Find latest courses</div>
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

                                    <?php }?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-4 d-flex flex-column">
                    <!--Start Section Header-->
                    <div class="section-header mb-4">
                        <h5>News, Updates, Offers</h5>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                    <?php //d($get_offerscourses); ?>
                    <div class="card border-0 rounded-0 shadow-sm flex-fill w-100">
                        <div class="card-body p-4 mb-3 mb-xl-0">

                            <div class="news-carousel owl-carousel owl-theme">
                                <?php
    $allnotification = $this->db->select("*")->from("notifications_tbl")->where('isNotify', 1)->where('student_id', $user_id)->where('enterprise_id', $enterprise_id)->order_by("id", "desc")->get()->result();
    if($allnotification ){
    $count = 0;
    $div_count = count($allnotification) - 1;
    if ($count < count($allnotification)) {
        for ($i = 0; $i <= $div_count; $i += 4) {

            if($allnotification[$i]->notification_type == 1 
            || $allnotification[$i]->notification_type == 2 
            || $allnotification[$i]->notification_type == 3 
            || $allnotification[$i]->notification_type == 4){
            ?>
                                <div>
                                    <!--Start News, Events-->
                                    <?php
                                $child = $i + 4;
                                for ($j = $i; $j < $child; $j++) {
                                ?>

                                    <?php if (count($allnotification) > $j) {

                                if ($allnotification[$j]->notification_type == 1) {
                                    $course = $this->db->select('a.name,a.course_id,a.course_type,a.description,a.created_date,b.picture,c.name as category_name')
                                        ->from('course_tbl a')
                                        ->join('picture_tbl b', 'b.from_id = a.course_id', 'left')
                                        ->join('category_tbl c', 'c.category_id = a.category_id', 'left')
                                        ->where('a.course_id', $allnotification[$j]->notification_id)
                                        ->where('a.enterprise_id', $enterprise_id)
                                        ->where('a.status', 1)
                                        ->get()
                                        ->row();

                                    ?>
                                    <div class="d-flex border p-3 rounded mb-2">
                                        <div class="flex-shrink-0 width_70">
                                            <!-- <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/offer/01.jpg') ?>" alt="..." class="rounded"> -->
                                            <img src="<?php echo base_url($course->picture); //base_url($allnotification[$j]['picture'])  ?>"
                                                alt="..." class="rounded">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6><a href="#"
                                                    class="text-dark-cerulean"><?php echo $course->name; //echo ($allnotification[$j]['name'] ? $allnotification[$j]['name'] : ''); ?></a>
                                            </h6>
                                            <div class="text-muted fs-13">
                                                <?php echo $course->category_name; //$allnotification[$j]['category_name'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } elseif ($allnotification[$j]->notification_type == 2) {
                                    $event = $this->db->select('a.name,a.description,a.created_date,b.picture,c.name as category_name')
                                        ->from('course_tbl a')
                                    //  ->join('picture_tbl b','b.from_id=a.event_id')
                                        ->join('picture_tbl b', 'b.from_id = a.course_id', 'left')
                                        ->join('category_tbl c', 'c.category_id = a.category_id', 'left')
                                        ->where('a.course_id', $allnotification[$j]->notification_id)
                                        ->where('a.enterprise_id', $enterprise_id)
                                        ->where('a.status', 1)
                                        ->get()
                                        ->row();

                                    ?>
                                    <div class="d-flex border p-3 rounded mb-2">
                                        <div class="flex-shrink-0 width_70">
                                            <!-- <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/offer/01.jpg') ?>" alt="..." class="rounded"> -->
                                            <img src="<?php echo base_url($event->picture); //base_url($allnotification[$j]['picture'])  ?>"
                                                alt="..." class="rounded">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6><a href="#"
                                                    class="text-dark-cerulean"><?php echo $event->name; //echo ($allnotification[$j]['name'] ? $allnotification[$j]['name'] : ''); ?></a>
                                            </h6>
                                            <div class="text-muted fs-13">
                                                <?php echo $event->category_name; //$allnotification[$j]['category_name'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } elseif ($allnotification[$j]->notification_type == 3) {
                                            $forum = $this->db->select('a.*,b.picture')
                                                ->from('forum_tbl a')
                                            //  ->join('picture_tbl b','b.from_id=a.forum_id')
                                                ->join('picture_tbl b', 'b.from_id = a.forum_id', 'left')
                                                ->where('a.forum_id', $allnotification[$j]->notification_id)
                                                ->where('a.enterprise_id', $enterprise_id)
                                                ->where('a.status', 1)
                                                ->get()
                                                ->row();
                                                
                                            ?>
                                    <div class="d-flex border p-3 rounded mb-2">
                                        <div class="flex-shrink-0 width_70">
                                            <!-- <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/offer/01.jpg') ?>" alt="..." class="rounded"> -->
                                            <img src="<?php echo base_url($forum->picture); //base_url($allnotification[$j]['picture'])  ?>"
                                                alt="..." class="rounded">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6><a href="#"
                                                    class="text-dark-cerulean"><?php echo $forum->title; //echo ($allnotification[$j]['name'] ? $allnotification[$j]['name'] : ''); ?></a>
                                            </h6>
                                            <div class="text-muted fs-13">
                                                <?php //echo //$allnotification[$j]['category_name']?></div>
                                        </div>
                                    </div>
                                    <?php } elseif ($allnotification[$j]->notification_type == 4) {
                                        $course = $this->db->select('a.name,a.course_id,a.course_type,a.description,a.created_date,b.picture ,c.name as category_name')
                                            ->from('course_tbl a')
                                            ->join('picture_tbl b', 'b.from_id = a.course_id', 'left')
                                            ->join('category_tbl c', 'c.category_id = a.category_id', 'left')
                                            ->where('a.course_id', $allnotification[$j]->notification_id)
                                            ->where('a.enterprise_id', $enterprise_id)
                                            ->where('a.status', 1)
                                            ->get()
                                            ->row();
                                        ?>
                                    <div class="d-flex border p-3 rounded mb-2">
                                        <div class="flex-shrink-0 width_70">
                                            <!-- <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/offer/01.jpg') ?>" alt="..." class="rounded"> -->
                                            <img src="<?php echo base_url($course->picture); //base_url($allnotification[$j]['picture'])  ?>"
                                                alt="..." class="rounded">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6><a href="#"
                                                    class="text-dark-cerulean"><?php echo $course->name; //echo ($allnotification[$j]['name'] ? $allnotification[$j]['name'] : ''); ?></a>
                                            </h6>
                                            <div class="text-muted fs-13">
                                                <?php echo $course->category_name; //$allnotification[$j]['category_name'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }else{?>

                                    <?php }}?>
                                    <!--End News, Events-->

                                    <?php }?>
                                </div>
                                <?php $count += $j;
    }else{?>
                                <div>
                                    <a class="border d-flex mb-2 p-3 rounded text-center bg-white"
                                        href="<?php echo base_url($enterprise_shortname . '/allcourse/'); ?>">
                                        <div class="flex-grow-1">
                                            <div class="border d-inline-block rounded-circle text-center mb-2"
                                                style="width:50px;height: 50px;">
                                                <i class="d-block text-dark" data-feather="plus"
                                                    style="height: 48px;font-size: 25px;margin: 0 auto;"></i>
                                            </div>
                                            <div class="fw-bold text-dark">Find latest courses</div>
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
                                <?php 
        }
    }
    } 
    }else {
        ?>

                                <div>
                                    <a class="border d-flex mb-2 p-3 rounded text-center bg-white"
                                        href="<?php echo base_url($enterprise_shortname . '/allcourse/'); ?>">
                                        <div class="flex-grow-1">
                                            <div class="border d-inline-block rounded-circle text-center mb-2"
                                                style="width:50px;height: 50px;">
                                                <i class="d-block text-dark" data-feather="plus"
                                                    style="height: 48px;font-size: 25px;margin: 0 auto;"></i>
                                            </div>
                                            <div class="fw-bold text-dark">Find latest courses</div>
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
                                <?php }?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Start Topic-->
    <div class="bg-alice-blue py-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-xl-8 d-flex flex-column">
                    <!--Start Section Header-->
                    <div class="section-header mb-4">
                        <h5>Time Spent Learning</h5>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                    <div class="card border-0 rounded-0 shadow-sm flex-fill w-100 mb-3 mb-xl-0">
                        <div class="row">
                            <div class="col-sm-8  d-flex p-4">
                                <?php 
                                // $hourmintime=$this->db->select('sum(real_time) as todaywatchtime')
                                $hourmintime=$this->db->select('sum(studentwatchTime) as todaywatchtime')
                                ->from('daily_watch_time_tbl')
                                ->where('daily_watch_time_tbl.student_id',$user_id)
                                ->get()->row();
                                $dayseconds= (!empty($hourmintime->todaywatchtime)?$hourmintime->todaywatchtime:'');
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
                                            echo  sprintf("%dh %dmin ", $hours,$mins);
                                        }  
                            ?>
                                <p class="fs-4 fw-semi-bold text-dark-cerulean" style="margin-left: 37px;"><?php 
                                if(!empty($dayseconds)){
                                    echo  secondsToWords($dayseconds);
                                    }else{
                                    echo  "0 h 0 min";
                                    }
                            ?></p>

                            </div>
                            <div class="col-sm-4  d-flex p-4">
                                <select class="form-select" onchange="time_spent_filter(this.value)">
                                    <!-- <option value="">Select One</option> -->
                                    <option value="1">Last week</option>
                                    <option value="3">Last month</option>
                                    <option value="2">Last year</option>
                                </select>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <canvas id="myChart4"></canvas>
                        </div>
                        <!-- <div class="card-body p-4" id="myCharthide_two">
                            <canvas id="myChart5"></canvas>
                        </div> -->
                    </div>
                </div>
                <div class="col-xl-4 d-flex flex-column">
                    <!--Start Section Header-->
                    <div class="section-header mb-4">
                        <h5>Upcoming Events</h5>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                    <div class="card border-0 rounded-0 shadow-sm flex-fill w-100">
                        <div class="card-body p-4 card-scroll">
                            <!--Start Event-->
                            <?php
                        // dd($upcoming_liveevents);
                        if ($upcoming_liveevents) {
                            foreach ($upcoming_liveevents as $liveevent) {
                                $meetinginfo = $this->db->where('course_id', $liveevent->course_id)->get('meeting_tbl')->row();
                                $meeting_date = strtotime($liveevent->event_date);
                                if(strtotime(date("H:i:s")) <= strtotime($meetinginfo->end_time) &&  strtotime(date("Y-m-d"))<=strtotime($meetinginfo->end_date)){
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
                                        <h6><?php echo (!empty($liveevent->name) ? $liveevent->name : ''); ?></h6>
                                        <div class="fs-12 text-muted">
                                            <?php echo (!empty($meetinginfo->start_time) ? date('h:i:a', strtotime($meetinginfo->start_time)) : ''); ?>
                                            -
                                            <?php echo (!empty($meetinginfo->end_time) ? date('h:i:a', strtotime($meetinginfo->end_time)) : ''); ?>
                                        </div>
                                        <div>
                                            <?php echo (!empty($liveevent->category_name) ? $liveevent->category_name : ''); ?>
                                        </div>
                                    </div>
                                    <div>
                                        <?php if ($liveevent->countevent) {?>
                                        <a href="<?php echo base_url($enterprise_shortname . '/event-details/' . $liveevent->course_id); ?>"
                                            class="btn btn-outline-dark-cerulean btn-sm">Enrolled</a>
                                        <?php } else {?>
                                        <a href="<?php echo base_url($enterprise_shortname . '/event-details/' . $liveevent->course_id); ?>"
                                            class="btn btn-outline-dark-cerulean btn-sm">Enroll</a>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                            <?php }}
    } else {?>
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
                                <div class="border d-flex mb-2 p-3 rounded text-center empty-box-darker">
                                    <div class="flex-grow-1">
                                        <div class="d-inline-block rounded-circle text-center mb-2"
                                            style="width:50px;height: 50px;">

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <?php
    }
    ?>
                            <!--End Event-->
                            <!--Start Event-->
                            <!-- <div class="align-items-center bg-alice-blue border d-flex mb-2 p-2 pe-3 rounded shadow-sm">
                                <div class="flex-shrink-0">
                                    <div class="bg-white border event-date px-3 py-2 rounded text-center">
                                        <div class="fs-13 text-muted">Dec</div>
                                        <div class="fs-4 fw-semi-bold">02</div>
                                    </div>
                                </div>
                                <div class="align-items-center d-sm-flex flex-grow-1 justify-content-between ms-3">
                                    <div>
                                        <h6>Live workshop</h6>
                                        <div class="fs-12 text-muted">10:00am - 2:00pm</div>
                                        <div>Basics Online Marketing</div>
                                    </div>
                                    <div>
                                        <button class="btn btn-outline-dark-cerulean btn-sm">Enrolled</button>
                                    </div>
                                </div>
                            </div> -->
                            <!--End Event-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $topic_of_category = $this->db->select('a.*,b.*,c.*')
        ->from('interests_topics_tbl a')
        ->join('category_tbl b', 'b.category_id = a.category_id', 'left')
        ->join('picture_tbl c', 'c.from_id = a.category_id', 'left')
        ->where('a.student_id', $user_id)
        ->where('a.enterprise_id', $enterprise_id)
        ->where('a.status', 1)
        ->get()->result();
    ?>
    <div class="bg-alice-blue py-3" id="view_interets">
        <div class="container-lg">
            <div class="card border-0 rounded-0 shadow-sm">
                <div class="card-body p-4 p-xl-5">
                    <div class="d-md-flex align-items-center justify-content-between mb-4">
                        <!--Start Section Header-->
                        <div class="section-header mb-4 mb-md-0">
                            <h4>My Topic of Interests </h4>
                            <div class="section-header_divider"></div>
                        </div>
                        <!--End Section Header-->
                        <?php if ($topic_of_category) {?>
                        <div><a href="javascript:void(0)" class="btn btn-dark-cerulean" id="edit_topics">Manage my
                                Topics</a></div>
                        <?php }?>
                    </div>
                    <div class="row g-3">
                        <?php
    if ($topic_of_category) {
        foreach ($topic_of_category as $tnterests) {
            ?>
                        <div class="col-lg-2 col-sm-4 col-6 col-vs-12">
                            <!--Start Topics-->
                            <div class="topics d-block position-relative overflow-hidden rounded">
                                <img src="<?php echo base_url(!empty($tnterests->picture) ? $tnterests->picture : 'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/topics/02.jpg'); ?>"
                                    alt="" class="img-fluid" style="height:140px;background-size: cover;">
                                <!-- <div class="topics_info"> -->
                                <!-- <div  style="background-color: rgba(17, 59, 108, 0.7);"> -->
                                <div class="topics-name start-0 w-100 text-center text-white p-2 position-absolute translate-y"
                                    style="background-color: rgba(17, 59, 108, 0.7);top: 88% !important;">
                                    <h6 class="mb-0 topics_title"><a
                                            href="<?php echo base_url($enterprise_shortname . '/category-course/' . html_escape($tnterests->category_id)); ?>"
                                            class="text-white"><?php echo html_escape($tnterests->name); ?></a>
                                    </h6>
                                </div>
                                <!-- </div> -->
                            </div>
                            <!--End Topics-->
                        </div>
                        <?php }} else {?>
                        <div class="col-lg-2 col-sm-4 col-6 col-vs-12">
                            <!--Start Topics-->
                            <a class="border d-flex mb-2 px-2 py-4 rounded text-center bg-white" href="javascript:void(0)"
                                id="edit_topics">
                                <div class="flex-grow-1">
                                    <div class="border d-inline-block rounded-circle text-center mb-2"
                                        style="width:50px;height: 50px;">
                                        <i class="d-block text-dark" data-feather="plus"
                                            style="height: 48px;font-size: 25px;margin: 0 auto;"></i>
                                    </div>
                                    <div class="fw-bold text-dark">Add Learning Interests</div>
                                </div>
                            </a>
                            <!--End Topics-->
                        </div>
                        <div class="col-lg-2 col-sm-4 col-6 col-vs-12">
                            <!--Start Topics-->
                            <div class="border d-flex mb-2 px-2 py-4 rounded text-center empty-box-darker">
                                <div class="flex-grow-1">
                                    <div class=" d-inline-block rounded-circle text-center "
                                        style="width:50px;height: 80px;">
                                        <i class="d-block text-dark"
                                            style="height: 48px;font-size: 25px;margin: 0 auto;"></i>
                                    </div>
                                    <div class="fw-bold text-dark"></div>
                                </div>
                            </div>
                            <!--End Topics-->
                        </div>
                        <div class="col-lg-2 col-sm-4 col-6 col-vs-12">
                            <!--Start Topics-->
                            <div class="border d-flex mb-2 px-2 py-4 rounded text-center empty-box-darker">
                                <div class="flex-grow-1">
                                    <div class=" d-inline-block rounded-circle text-center "
                                        style="width:50px;height: 80px;">
                                        <i class="d-block text-dark"
                                            style="height: 48px;font-size: 25px;margin: 0 auto;"></i>
                                    </div>
                                    <div class="fw-bold text-dark"></div>
                                </div>
                            </div>
                            <!--End Topics-->
                        </div>
                        <div class="col-lg-2 col-sm-4 col-6 col-vs-12">
                            <!--Start Topics-->
                            <div class="border d-flex mb-2 px-2 py-4 rounded text-center empty-box-darker">
                                <div class="flex-grow-1">
                                    <div class=" d-inline-block rounded-circle text-center "
                                        style="width:50px;height: 80px;">
                                        <i class="d-block text-dark"
                                            style="height: 48px;font-size: 25px;margin: 0 auto;"></i>
                                    </div>
                                    <div class="fw-bold text-dark"></div>
                                </div>
                            </div>
                            <!--End Topics-->
                        </div>
                        <div class="col-lg-2 col-sm-4 col-6 col-vs-12">
                            <!--Start Topics-->
                            <div class="border d-flex mb-2 px-2 py-4 rounded text-center empty-box-darker">
                                <div class="flex-grow-1">
                                    <div class=" d-inline-block rounded-circle text-center "
                                        style="width:50px;height: 80px;">
                                        <i class="d-block text-dark"
                                            style="height: 48px;font-size: 25px;margin: 0 auto;"></i>
                                    </div>
                                    <div class="fw-bold text-dark"></div>
                                </div>
                            </div>
                            <!--End Topics-->
                        </div>
                        <div class="col-lg-2 col-sm-4 col-6 col-vs-12">
                            <!--Start Topics-->
                            <div class="border d-flex mb-2 px-2 py-4 rounded text-center empty-box-darker">
                                <div class="flex-grow-1">
                                    <div class=" d-inline-block rounded-circle text-center "
                                        style="width:50px;height: 80px;">
                                        <i class="d-block text-dark"
                                            style="height: 48px;font-size: 25px;margin: 0 auto;"></i>
                                    </div>
                                    <div class="fw-bold text-dark"></div>
                                </div>
                            </div>
                            <!--End Topics-->
                        </div>

                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-alice-blue py-3" id="manage_interets">
        <div class="container-lg">
            <div class="card border-0 rounded-0 shadow-sm">
                <div class="card-body p-4 p-xl-5">
                    <div class="d-md-flex align-items-center justify-content-between mb-4">
                        <!--Start Section Header-->
                        <div class="section-header mb-4 mb-md-0">
                            <h4>My Topic of Interests <span class="fs-15"
                                    style="letter-spacing: 0.7px; color: #a8a8a8;">(What would you like to learn)</span>
                            </h4>
                            <div class="section-header_divider"></div>
                        </div>
                        <!--End Section Header-->
                        <div><a href="javascript:void(0)" class="btn btn-dark-cerulean" id="intarestdone">Done</a></div>
                    </div>
                    <div class="row g-3" id='blr'>
                        <?php
                        $s = 0;
                        foreach ($topic_of_tnterests as $tnterests) {
                            $checkexsisting = $this->db->select('*')->from("interests_topics_tbl")->where('category_id', $tnterests->category_id)->where('student_id', $user_id)->where('enterprise_id', $enterprise_id)->where('status', 1)->get()->row();
                            $status = (!empty($checkexsisting->status) ? $checkexsisting->status : '');
                            ?>
                        <div class="col-lg-2 col-sm-4 col-6 col-vs-12">
                            <!--Start Topics-->
                            <div class="topics d-block position-relative overflow-hidden rounded">
                                <img src="<?php echo base_url(!empty($tnterests->picture) ? $tnterests->picture : 'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/topics/02.jpg'); ?>"
                                    alt="" class="img-fluid" style="height:140px;background-size: cover;">
                                <!-- <div class="topics_info"> -->
                                <!-- <div
                                        class="topics-name start-0 w-100 text-center text-white p-2 position-absolute translate-y">
                                        <h6 class="mb-0 topics_title"><?php echo html_escape($tnterests->category_name); ?>
                                        </h6>
                                    </div> -->
                                <!-- </div> -->
                                <div class="align-content-center d-flex position-absolute topics_select">
                                    <button
                                        class="btn btn-info w-100p btn-sm demo2 rounded-circle mb-0 interestcheck_<?php echo $s; ?> <?php if ($status == 1) {echo 'interestcheck';}?>"
                                        onclick="checedBox('<?php echo $s; ?>')">
                                        <input type="checkbox" <?php if ($status == 1) {echo 'checked';}?>
                                            id="imgCheck_<?php echo $s; ?>" name="imgCheck[]"
                                            value="<?php if ($status == 1) {echo '1';} else {echo '0';}?>"
                                            style="opacity:0; position:absolute; left:9999px;"
                                            class="<?php if ($status == 1) {echo 'checked';}?>">
                                        <i data-feather="<?php if ($status == 1) {echo 'check';} else {echo 'plus';}?>"
                                            id=""
                                            class="<?php if ($status == 1) {echo 'check_' . $s;} else {echo 'plus_' . $s;}?>"></i>
                                        <input type="hidden" value="<?php echo $tnterests->category_id; ?>"
                                            id="category_id_<?php echo $s; ?>">
                                        <input type="hidden" value="<?php echo $s; ?>" id="sl">
                                    </button>

                                    <div class="p-2 mt-2 text-center text-white w-100">
                                        <h6 class="mb-0 topics_title"><?php echo html_escape($tnterests->category_name); ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <!--End Topics-->
                        </div>
                        <?php $s++;}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Topic-->

    <!--Start Interest Course-->
    <div class="bg-alice-blue py-3">
        <div class="container-lg">
            <div class="card border-0 rounded-0 shadow-sm">
                <div class="card-body p-3 p-md-4 p-xl-5">
                    <div class="d-md-flex align-items-center justify-content-between mb-4">
                        <!--Start Section Header-->
                        <div class="section-header mb-4 mb-md-0">
                            <h4>Courses of Interests</h4>
                            <div class="section-header_divider"></div>
                        </div>
                        <!--End Section Header-->
                    </div>
                    <div class="viewe-carousel owl-carousel owl-theme">
                        <!--Start Course Card-->
                        <?php
                    // $interests_course = $this->db->select('a.*,c.toexplore,c.tagstatus,c.id,c.course_id, c.faculty_id, c.name, c.price, c.oldprice, c.summary, c.slug, '
                    //     . 'c.course_level,c.hover_thumbnail,is_new,c.url,c.course_type,c.offer_courseprice,c.is_offer,c.is_discount,c.discount, c.discount_type, c.is_free, c.is_livecourse, c.enterprise_id, e.picture, b.category_id, b.name as category_name, d.name instructor_name,f.name enterprise_name')
                    //     ->from('interests_topics_tbl a')
                    //     ->join('category_tbl b', 'b.category_id=a.category_id')
                    //     ->join('course_tbl c', 'c.category_id=a.category_id')
                    //     ->join('faculty_tbl d', 'd.faculty_id=c.faculty_id')
                    //     ->join('picture_tbl e', 'e.from_id = c.course_id', 'left')
                    //     ->join('loginfo_tbl f', 'f.log_id = b.enterprise_id', 'left')
                    //     ->where('a.enterprise_id', $enterprise_id)
                    //     ->where('a.student_id', $user_id)
                    //     ->where('a.status', 1)
                    //     ->get()->result();



                    $purchase=$this->db->select("*")
                    ->from("invoice_details")
                    ->where('invoice_details.customer_id',$user_id)
                    ->where('invoice_details.enterprise_id', $enterprise_id)
                    ->get()
                    ->result();
                    $p_id=[];
                    if($purchase){
                        foreach($purchase as $pid){
                            $p_id[]= $pid->product_id;
                        }
                    }
                        $interests_course = $this->db->select('a.*,c.tagstatus,c.id,c.course_id, c.faculty_id, c.name, c.price, c.oldprice, c.summary, c.slug, '
                        . 'c.course_level,c.hover_thumbnail,is_new,c.url,c.course_type,c.offer_courseprice,c.is_offer,c.is_discount,c.discount, c.discount_type, c.is_free, c.is_livecourse, c.enterprise_id, e.picture, b.category_id, b.name as category_name, d.name instructor_name,f.name enterprise_name');
                        $this->db->from('interests_topics_tbl a');
                        $this->db->join('category_tbl b', 'b.category_id=a.category_id');
                        $this->db->join('course_tbl c', 'c.category_id=a.category_id');
                        $this->db->join('faculty_tbl d', 'd.faculty_id=c.faculty_id');
                        $this->db->join('picture_tbl e', 'e.from_id = c.course_id', 'left');
                        $this->db->join('loginfo_tbl f', 'f.log_id = b.enterprise_id', 'left');
                        $this->db->where('a.enterprise_id', $enterprise_id);
                        if($p_id){
                        $this->db->where_not_in('c.course_id',$p_id);
                        }
                        $this->db->where('a.student_id', $user_id);
                        $this->db->where('a.status', 1);
                        $this->db->where('c.status', 1);
                        $this->db->where('c.is_livecourse', 0);
                        $qr=$this->db->get();
                        $interests_course = $qr->result();
    // echo $this->db->last_query();
        // print_r($interests_course);

    if ($interests_course) {
        foreach ($interests_course as $save_course) {
            $course_id = $save_course->course_id;
            $studentCount = $this->db->where('course_id', $course_id)->get('coursesave_tbl')->num_rows();
            //    ->where_not_in('student_id',$save_course->student_id)
    
            ?>
                        <div
                            class="course-card course-card-shadow rounded-6 bg-white position-relative overflow-hidden hideClass">
                            <div class="position-relative overflow-hidden bg-prussian-blue">
                                <!-- <div class="position-relative"> -->
                                <!--Start Course Image-->
                                <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $course_id); ?>"
                                    class="course-card_img">
                                    <img src="<?php echo base_url(!empty($save_course->picture) ? $save_course->picture : default_600_400()); ?>"
                                        class="img-fluid w-100" alt="">
                                </a>
                                <!--End Course Image-->
                                <!--Start items badge-->
                                <div
                                    class="align-items-center top-0 d-flex fs-12 position-absolute px-3 py-2 start-0 text-white w-100 z-index-2">
                                    <?php
    if ($save_course->tagstatus == 4) {?>
                                    <span class="badge-new  me-1">Most Popular</span>
                                    <?php
    } elseif ($save_course->tagstatus == 3) {?>
                                    <span class="badge-new  me-1">New</span>
                                    <?php } elseif ($save_course->tagstatus == 1) {?>
                                    <span class="badge-new  me-1">Recomended</span>

                                    <?php } elseif ($save_course->tagstatus == 2) {?>
                                    <span class="badge-new  me-1">Best Seller</span>
                                    <?php }?>
                                    <span
                                        class="badge-business"><?php echo html_escape($save_course->category_name); ?></span>
                                    <span id="savecourse<?php echo $save_course->course_id; ?>" class="ms-auto">
                                        <?php
                                        $coursesaved_checked = $this->Frontend_model->coursesaved_checked($user_id,$save_course->course_id);
                                        if (!$coursesaved_checked){
                                            if ($user_type == 4) {?>
                                        <img onclick="get_coursesaveloop(1, '<?php echo $save_course->course_id; ?>')"
                                            src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-1.png'); ?>"
                                            class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                                        <?php } else { ?>
                                        <img onclick="coursesavecheck()"
                                            src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-1.png'); ?>"
                                            class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                                        <?php }
                                        } else {?>
                                        <img onclick="get_coursesaveloop(0, '<?php echo $save_course->course_id; ?>')"
                                            src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-2.png'); ?>"
                                            class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                                        <?php } ?>
                                    </span>


                                </div>
                                <?php if (!empty($save_course->is_discount == 1)) {?>
                                <span
                                    class="px-0 badge m-3   position-absolute start-0 text-white   z-index-2 polygon-shape"
                                    style="top:25px">
                                    <span class="d-block fs-13 mb-1">Off</span>
                                    <span
                                        class="fs-15 fw-bold"><?php echo (($save_course->discount) ? $save_course->discount : ''); ?><?php if ($save_course->discount_type == 2) {echo "%";} else {echo " ";}?></span>
                                </span>
                                <?php }?>
                                <!--End items badge-->
                                <!-- </div> -->
                                <!--Start Course Card Body-->
                                <div class="bg-prussian-blue course-card_body course_middle px-3 py-2 text-white py-12">
                                    <!--Start Course Title-->
                                    <h3 class="course-card__course--title  mb-0 text-capitalize">
                                        <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                            class="text-decoration-none text-white"><?php echo (!empty($save_course->name) ? $save_course->name : ''); ?></a>
                                    </h3>
                                    <!--End Course Title-->
                                    <div class="course-card__instructor d-flex align-items-center">
                                        <div class="card__instructor--name my-2">
                                            <a class="text-capitalize instructor-name"
                                                href="<?php echo base_url($enterprise_shortname . '/instructor-profile-show/' . $save_course->faculty_id); ?>"><?php echo (!empty($save_course->instructor_name) ? $save_course->instructor_name : ''); ?></a>
                                        </div>
                                    </div>
                                    <!--Start Course Hints-->
                                    <table class="course-card__hints table table-borderless table-sm text-white mb-0">
                                        <tbody>
                                            <tr>
                                                <td width="80" class="ps-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="course-card__hints--icon me-3">
                                                            <?php
    if (@$save_course->course_level == 1) {?>
                                                            <div class="d-flex align-items-center">
                                                                <div class="bar-custom me-2">
                                                                    <span class="fill"></span>
                                                                    <span></span>
                                                                    <span></span>
                                                                </div>
                                                            </div>
                                                            <?php } elseif (@$save_course->course_level == 2) {?>
                                                            <div class="d-flex align-items-center">
                                                                <div class="bar-custom me-2">
                                                                    <span class="fill"></span>
                                                                    <span class="fill"></span>
                                                                    <span></span>
                                                                </div>
                                                            </div>
                                                            <?php } elseif (@$save_course->course_level == 3) {?>
                                                            <div class="d-flex align-items-center">
                                                                <div class="bar-custom me-2">
                                                                    <span class="fill"></span>
                                                                    <span class="fill"></span>
                                                                    <span class="fill"></span>
                                                                </div>
                                                            </div>
                                                            <?php }?>
                                                        </div>
                                                        <div class="course-card__hints--text fs-12 fw-bold text-white">
                                                            <?php
    if ($save_course->course_level == 1) {

                echo "Beginner  Level";
            } elseif ($save_course->course_level == 2) {
                echo "Intermediate Level";
            } elseif ($save_course->course_level == 3) {
                echo "Advanced Level";
            }
            ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="course-card__hints--icon me-3">
                                                            <svg id="document" xmlns="http://www.w3.org/2000/svg"
                                                                width="17.26" height="14.926" viewBox="0 0 17.26 14.926">
                                                                <path id="Path_148" data-name="Path 148"
                                                                    d="M16.065,17.081H1.2a1.2,1.2,0,0,0-1.2,1.2V28.364a1.2,1.2,0,0,0,1.2,1.2h8.67l-.262,1.6a.69.69,0,0,0,1.041.75l1.871-.985a.393.393,0,0,1,.248,0l1.871.985a.834.834,0,0,0,.388.1.656.656,0,0,0,.387-.123.726.726,0,0,0,.266-.728l-.262-1.6h.651a1.2,1.2,0,0,0,1.2-1.2V18.277A1.2,1.2,0,0,0,16.065,17.081ZM12.64,27.511a2.084,2.084,0,1,1,2.084-2.084A2.086,2.086,0,0,1,12.64,27.511Zm.6,2.5a1.383,1.383,0,0,0-1.2,0l-1.323.7.42-2.565a3.1,3.1,0,0,0,3.007,0l.164,1v.005l.256,1.56Zm2.994-1.651a.173.173,0,0,1-.171.171h-.819l-.187-1.142s0-.009,0-.013a3.108,3.108,0,1,0-4.831,0l0,.013-.187,1.142H1.2a.173.173,0,0,1-.171-.171V18.277a.173.173,0,0,1,.171-.171H16.065a.173.173,0,0,1,.171.171Z"
                                                                    transform="translate(0 -17.081)" fill="#B5C5DB" />
                                                                <path id="Path_149" data-name="Path 149"
                                                                    d="M43.246,60.243H31.631a.512.512,0,0,0,0,1.025H43.246a.512.512,0,0,0,0-1.025Z"
                                                                    transform="translate(-28.993 -57.295)" fill="#B5C5DB" />
                                                                <path id="Path_150" data-name="Path 150"
                                                                    d="M36.55,100.911H31.631a.512.512,0,0,0,0,1.025H36.55a.512.512,0,0,0,0-1.025Z"
                                                                    transform="translate(-28.993 -95.184)" fill="#B5C5DB" />
                                                            </svg>
                                                        </div>
                                                        <div class="course-card__hints--text fs-12 fw-bold text-white">
                                                            <?php if ($save_course->enterprise_name == 'Admin') {echo "Lead Academy";} else {echo $save_course->enterprise_name . " " . "Academy";}?>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <!--End Course Hints-->
                                    <div
                                        class="align-items-center d-flex fs-12 justify-content-between pt-1 text-white w-100">
                                        <div class="d-flex align-items-center">
                                            <div class="course-card__hints--icon me-3">
                                                <svg id="clock_1_" data-name="clock (1)" xmlns="http://www.w3.org/2000/svg"
                                                    width="16.706" height="16.706" viewBox="0 0 16.706 16.706">
                                                    <path id="Path_13" data-name="Path 13"
                                                        d="M8.353,0a8.353,8.353,0,1,0,8.353,8.353A8.363,8.363,0,0,0,8.353,0Zm0,15.662a7.309,7.309,0,1,1,7.309-7.309,7.317,7.317,0,0,1-7.309,7.309Z"
                                                        fill="#B5C5DB" />
                                                    <path id="Path_14" data-name="Path 14"
                                                        d="M208.838,83.118h-1.044v5.437l3.285,3.285.738-.738-2.979-2.979Z"
                                                        transform="translate(-199.963 -79.985)" fill="#B5C5DB" />
                                                </svg>
                                            </div>
                                            <div class="course-card__hints--text fs-12 fw-bold text-white">
                                                <?php
    $course_wise_lesson = $this->Course_model->course_wise_lesson($save_course->course_id);
            $seconds = 0;
            foreach ($course_wise_lesson as $lesson) {
                list($hour, $minute, $second) = explode(':', html_escape($lesson->duration));
                $seconds += $hour * 3600;
                $seconds += $minute * 60;
                $seconds += $second;
            }
            $hours = floor($seconds / 3600);
            $seconds -= $hours * 3600;
            $minutes = floor($seconds / 60);
            $seconds -= $minutes * 60;
            // echo  "14 hrs 33 min"
            echo ' ' . $hours . " hrs" . " " . $minutes . " min";
            ?>
                                            </div>
                                        </div>
                                        <div class="course-like d-flex align-items-center">
                                            <i class="fas fa-graduation-cap fs-15 me-1 " style="color:#B5C5DB"></i>
                                            <div class="d-block">
                                                <div class="reviews fs-12 fw-bold text-white"><?php
    $studentCount = $this->db->where('product_id', $save_course->course_id)->get('invoice_details')->num_rows();
            //echo  html_escape($studentCount?$studentCount:0)
            echo number_format($studentCount ? $studentCount : 0);
            ?></div>
                                            </div>
                                        </div>

                                        <!--Start Star Rating-->
                                        <div class="star-rating__wrap d-flex align-items-center ">
                                            <i class="fas fa-star me-1 text-warning" style="color:#B5C5DB"></i>
                                            <div class="d-block">
                                                <div class="reviews fs-12 fw-bold text-white">
                                                    <?php echo average_ratings_number($save_course->course_id, $enterprise_id); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End Course Card Body-->

                                <!--Start Course Card Hover Content-->

                                <div class="course-card__hover--content">
                                    <img src="<?php echo base_url(!empty($save_course->hover_thumbnail) ? $save_course->hover_thumbnail : default_600_400()); ?>"
                                        class="course-card__hover--content___img">
                                    <!--Start Video Icon With Popup Youtube-->
                                    <?php if ($save_course->url) {?>

                                    <a class="course-card__hover--content___icon popup-youtube"
                                        href="<?php echo (!empty($save_course->url) ? $save_course->url : ''); ?>" autoplay>
                                        <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/Playicon.png'); ?>"
                                            class="img-fluid" alt="">
                                    </a>
                                    <?php }?>
                                    <!--End Video Icon With Popup Youtube-->

                                    <h3
                                        class="bottom-0 course-card__hover--content___text d-block fs-15 mb-0 position-absolute text-capitalize text-decoration-none text-white">
                                        <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                            class="text-decoration-none text-white"><?php echo (!empty($save_course->name) ? $save_course->name : ''); ?></a>
                                    </h3>
                                </div>
                                <!--End Card Hover Content-->
                            </div>
                            <?php
                            $course_types = json_decode($save_course->course_type);
                            $checked_purchase = $this->db->where('customer_id',$user_id)->where('product_id', $save_course->course_id)->where('status',1)->get('invoice_details')->row();
                            ?>
                            <div class="course-card_footer g-2 px-3 py-12">

                                <?php 
                                // check purchase or subscription 
                                if($checked_purchase){?>
                                <div class="d-block">
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio" name="" id=""
                                            onclick="" disabled>
                                        <label class="form-check-label fw-bold opa-half course_price_cart"
                                            for="flexRadioDefault1">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio" name="" id=""
                                            onclick="" disabled>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                            style="width:100%;"
                                            for="flexRadioDefault2_<?php echo $save_course->course_id?>">
                                            <span class="course_price_cart">Course Price
                                                <span class="text-success">
                                                </span>
                                            </span>
                                            <span class="align-items-center d-flex  rounded text-center">
                                                <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                    <?php echo (($save_course->is_offer == 1) ? number_format($save_course->offer_courseprice) : number_format($save_course->price)); ?></span>
                                                <?php if(!empty($save_course->is_discount==1)){?>
                                                <del
                                                    class="fs-12 fw-bold text-muted2"><?php echo (($save_course->oldprice)?number_format($save_course->oldprice) :" "); ?></del>
                                                <?php }?>
                                            </span>
                                        </label>
                                        <!-- <span class="badge bg-success me-1 float-end ms-auto">  </span> -->
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="javascript:void(0)"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Enrolled</span>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img class="me-1"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Details</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php }else{?>
                                <div class="d-block">
                                    <?php if (in_array("1", $course_types) && in_array("2", $course_types)) {?>
                                    <input type="hidden" class="course" value="<?php echo $save_course->course_id; ?>"
                                        id="<?php echo $save_course->course_id; ?>">
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <!-- <input class="form-check-input" type="radio" name="flexRadioDefault1_<?php echo $save_course->course_id ?>" id="flexRadioDefault1_<?php echo $save_course->course_id ?>"  onclick="subscriptionchecedRadio('<?php echo $save_course->course_id; ?>')" > -->
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault1_<?php echo $save_course->course_id ?>"
                                            id="flexRadioDefault1_<?php echo $save_course->course_id ?>"
                                            onclick="subscriptionchecedRadio('<?php echo $save_course->course_id; ?>')">
                                        <label class="form-check-label fw-bold course_price_cart "
                                            for="flexRadioDefault1_<?php echo $save_course->course_id ?>">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="form-check d-flex align-items-center ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault2_<?php echo $save_course->course_id ?>"
                                            id="flexRadioDefault2_<?php echo $save_course->course_id ?>"
                                            onclick="coursechecedRadio('<?php echo $save_course->course_id; ?>')" checked>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                            style="width:100%;"
                                            for="flexRadioDefault2_<?php echo $save_course->course_id ?>">
                                            <span class="course_price_cart">Course Price
                                                <span class="text-success">
                                                </span>
                                            </span>
                                            <span class="align-items-center d-flex  rounded text-center">
                                                <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                    <?php echo (($save_course->is_offer == 1) ? number_format($save_course->offer_courseprice) : number_format($save_course->price)); ?></span>
                                                <?php if (!empty($save_course->is_discount == 1)) {?>
                                                <del
                                                    class="fs-12 fw-bold text-muted2"><?php echo (($save_course->oldprice) ? number_format($save_course->oldprice) : " "); ?></del>
                                                <?php }?>

                                            </span>
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2"
                                        id="course_purchase_<?php echo $save_course->course_id ?>">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13"> Purchase
                                                </span>

                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img class="me-1"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Details</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2"
                                        id="course_subscription_<?php echo $save_course->course_id ?>">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php echo base_url($enterprise_shortname . '/subscription-details'); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13"> Subscription
                                                </span>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img class="me-1"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Details</span>

                                            </a>
                                        </div>
                                    </div>
                                    <?php } elseif (in_array("3", $course_types) && in_array("4", $course_types)) {?>
                                    <!-- <div class="d-flex justify-content-between align-items-stretch ">
                                            <div class="flex-grow-1 me-1">
                                                <button type="button" class="btn btn-dark-cerulean w-100">
                                                    <i data-feather="shopping-cart" class="me-1"></i>
                                                    Subscription
                                                </button>
                                            </div>
                                            <div class="flex-grow-1">
                                                <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>" class="btn btn-dark-cerulean w-100">
                                                    <i data-feather="info" class="me-1"></i>
                                                    Details
                                                </a>
                                            </div>
                                        </div> -->
                                    <?php } elseif (in_array("1", $course_types)) {?>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault1_<?php echo $save_course->course_id ?>"
                                            id="flexRadioDefault1_<?php echo $save_course->course_id ?>"
                                            onclick="subscriptionchecedRadio('<?php echo $save_course->course_id; ?>')"
                                            disabled>
                                        <label class="form-check-label fw-bold opa-half course_price_cart"
                                            for="flexRadioDefault1">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="form-check d-flex align-items-center ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault2_<?php echo $save_course->course_id ?>"
                                            id="flexRadioDefault2_<?php echo $save_course->course_id ?>"
                                            onclick="coursechecedRadio('<?php echo $save_course->course_id; ?>')" checked>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                            style="width:100%"
                                            for="flexRadioDefault2_<?php echo $save_course->course_id ?>">
                                            <span class="course_price_cart">Course Price <span class="text-success"></span>
                                            </span>
                                            <span class="align-items-center d-flex  rounded text-center">
                                                <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                    <?php echo (($save_course->is_offer == 1) ? number_format($save_course->offer_courseprice) : number_format($save_course->price)); ?></span>
                                                <?php if (!empty($save_course->is_discount == 1)) {?>
                                                <del
                                                    class="fs-12 fw-bold text-muted2"><?php echo (($save_course->oldprice) ? number_format($save_course->oldprice) : " "); ?></del>
                                                <?php }?>
                                            </span>

                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13"> Purchase
                                                </span>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img class="me-1"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Details</span>
                                            </a>
                                        </div>
                                    </div>
                                    <?php } elseif (in_array("2", $course_types)) {?>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault1_<?php echo $save_course->course_id ?>"
                                            id="flexRadioDefault1_<?php echo $save_course->course_id ?>"
                                            onclick="subscriptionchecedRadio('<?php echo $save_course->course_id; ?>')"
                                            checked>
                                        <label class="form-check-label fw-bold course_price_cart"
                                            for="flexRadioDefault1_<?php echo $save_course->course_id ?>">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="form-check d-flex align-items-center ps-0 ">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault2_<?php echo $save_course->course_id ?>"
                                            id="flexRadioDefault2_<?php echo $save_course->course_id ?>"
                                            onclick="coursechecedRadio('<?php echo $save_course->course_id; ?>')" disabled>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between opa-half"
                                            style="width: calc(100% - 25px);" for="flexRadioDefault2">
                                            <span class="course_price_cart">Course Price <span
                                                    class="text-success"></span></span>
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php echo base_url($enterprise_shortname . '/subscription-details'); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13"> Subscription
                                                </span>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img class="me-1"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Details</span>
                                            </a>
                                        </div>
                                    </div>
                                    <?php } elseif (in_array("3", $course_types)) {?>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault1_<?php echo $save_course->course_id ?>"
                                            id="flexRadioDefault1_<?php echo $save_course->course_id ?>"
                                            onclick="subscriptionchecedRadio('<?php echo $save_course->course_id; ?>')"
                                            disabled>
                                        <label class="form-check-label fw-bold opa-half course_price_cart"
                                            for="flexRadioDefault1">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault2_<?php echo $save_course->course_id ?>"
                                            id="flexRadioDefault2_<?php echo $save_course->course_id ?>"
                                            onclick="coursechecedRadio('<?php echo $save_course->course_id; ?>')" disabled>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between opa-half"
                                            style="width: calc(100% - 25px);" for="flexRadioDefault2">
                                            <span class="course_price_cart">Course Price </span>
                                            <span class="d-flex px-2 rounded text-center">
                                                <span class="d-block fs-12 fw-bold me-2 text-success">
                                                    <!-- Free -->
                                                </span>
                                            </span>
                                        </label>
                                        <span class="badge bg-success me-1 float-end ms-auto"> Free</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13"> Enroll Free </span>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img class="me-1"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Details</span>
                                            </a>
                                        </div>
                                    </div>

                                    <?php } elseif (in_array("4", $course_types)) {?>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault1_<?php echo $save_course->course_id ?>"
                                            id="flexRadioDefault1_<?php echo $save_course->course_id ?>"
                                            onclick="subscriptionchecedRadio('<?php echo $save_course->course_id; ?>')"
                                            disabled>
                                        <label class="form-check-label fw-bold opa-half course_price_cart"
                                            for="flexRadioDefault1">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault2_<?php echo $save_course->course_id ?>"
                                            id="flexRadioDefault2_<?php echo $save_course->course_id ?>"
                                            onclick="coursechecedRadio('<?php echo $save_course->course_id; ?>')" disabled>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between opa-half"
                                            for="flexRadioDefault2_<?php echo $save_course->course_id ?>">
                                            <span class="course_price_cart">Course Price</span>
                                            <span class="bg-danger d-flex px-2 rounded text-center text-white">
                                                <!-- Govt -->
                                            </span>
                                        </label>
                                        <span class="badge bg-success me-1 float-end ms-auto"> Govt</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13"> Govt </span>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img class="me-1"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Details</span>
                                            </a>
                                        </div>
                                    </div>
                                    <?php } else {?>
                                    No Allow this type
                                    <?php }?>
                                </div>
                                <?php }?>

                            </div>


                        </div>
                        <?php }} else {?>

                        <div class="bg-white d-block h-100 rounded-6">
                            <!--Start Course Card-->
                            <div class=" border rounded-6 bg-white">
                                <a href="<?php echo base_url($enterprise_shortname . '/allcourse/'); ?>"
                                    class="bg-white d-block h-100 rounded-6">
                                    <!--Start Course Image-->
                                    <!--Start Course Card Body-->
                                    <div class="bg-white m-0 px-3 py-5 rounded-6 text-center">

                                        <div class="border d-inline-block rounded-circle text-center mb-3"
                                            style="width:50px;height: 50px;"><i class="d-block text-dark"
                                                data-feather="plus"
                                                style="height: 48px;font-size: 25px;margin: 0 auto;"></i></div>
                                        <div class="fw-bold text-dark">Find your desired course</div>
                                    </div>
                                    <!--End Course Card Body-->
                                </a>
                                <!--End Course Card-->
                            </div>
                        </div>
                        <div class="empty-box-darker d-block h-100 rounded-6">
                            <!--Start Course Card-->
                            <div class=" border rounded-6 empty-box-darker">
                                <div class="empty-box-darker d-block h-100 rounded-6">
                                    <!--Start Course Image-->
                                    <!--Start Course Card Body-->
                                    <div class="empty-box-darker m-0 px-3 py-5 rounded-6 text-center">

                                        <div class=" d-inline-block rounded-circle text-center mb-3"
                                            style="width:50px;height: 70px;"><i class="d-block text-dark"
                                                style="height: 48px;font-size: 25px;margin: 0 auto;"></i></div>
                                        <div class="fw-bold text-dark"></div>
                                    </div>
                                    <!--End Course Card Body-->
                                </div>
                                <!--End Course Card-->
                            </div>
                        </div>
                        <div class="empty-box-darker d-block h-100 rounded-6">
                            <!--Start Course Card-->
                            <div class="border rounded-6 empty-box-darker">
                                <div class="empty-box-darker d-block h-100 rounded-6">
                                    <!--Start Course Image-->
                                    <!--Start Course Card Body-->
                                    <div class="empty-box-darker m-0 px-3 py-5 rounded-6 text-center">

                                        <div class=" d-inline-block rounded-circle text-center mb-3"
                                            style="width:50px;height: 70px;"><i class="d-block text-dark"
                                                style="height: 48px;font-size: 25px;margin: 0 auto;"></i></div>
                                        <div class="fw-bold text-dark"></div>
                                    </div>
                                    <!--End Course Card Body-->
                                </div>
                                <!--End Course Card-->
                            </div>
                        </div>
                        <div class="empty-box-darker d-block h-100 rounded-6">
                            <!--Start Course Card-->
                            <div class=" border rounded-6 empty-box-darker">
                                <div class="empty-box-darker d-block h-100 rounded-6">
                                    <!--Start Course Image-->
                                    <!--Start Course Card Body-->
                                    <div class="empty-box-darker m-0 px-3 py-5 rounded-6 text-center">

                                        <div class=" d-inline-block rounded-circle text-center mb-3"
                                            style="width:50px;height: 70px;"><i class="d-block text-dark"
                                                style="height: 48px;font-size: 25px;margin: 0 auto;"></i></div>
                                        <div class="fw-bold text-dark"></div>
                                    </div>
                                    <!--End Course Card Body-->
                                </div>
                                <!--End Course Card-->
                            </div>
                        </div>

                        <?php }?>
                        <!--End Course Card-->
                    </div>
                    <!-- <div class="row">
                        <div class="col-12">
                            <div class="text-center mt-4">
                                <a href="course-category.html" class="btn btn-lg btn-dark-cerulean">
                                    Load more Courses
                                    <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="15" height="15.666" viewBox="0 0 28.56 15.666">
                                        <path id="right-arrow_3_" data-name="right-arrow (3)" d="M20.727,107.5l-1.272,1.272,5.661,5.661H0v1.8H25.116l-5.661,5.661,1.272,1.272,7.833-7.833Z" transform="translate(0 -107.5)" fill="#fff"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <!--End Popular Course-->
    <!--Start Save Course-->
    <div class="bg-alice-blue py-3">
        <div class="container-lg">
            <div class="card border-0 rounded-0 shadow-sm">
                <div class="card-body p-3 p-md-4 p-xl-5">
                    <!--Start Section Header-->
                    <div class="section-header mb-4">
                        <h4>Saved Courses</h4>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                    <div class="viewe-carousel owl-carousel owl-theme">
                        <!--Start Course Card-->
                        <?php
    if ($save_courses) {
        foreach ($save_courses as $save_course) {
            $course_id = $save_course->course_id;
            $studentCount = $this->db->where('course_id', $course_id)->get('coursesave_tbl')->num_rows();
            //    ->where_not_in('student_id',$save_course->student_id)
            $coursesaved_checked = $this->Frontend_model->coursesaved_checked($user_id, $course_id);
            ?>
                        <div
                            class="course-card course-card-shadow rounded-6 bg-white position-relative overflow-hidden hide_save_course">
                            <div class="position-relative overflow-hidden bg-prussian-blue">
                                <!-- <div class="position-relative"> -->
                                <!--Start Course Image-->
                                <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $course_id); ?>"
                                    class="course-card_img">
                                    <img src="<?php echo base_url(!empty($save_course->picture) ? $save_course->picture : default_600_400()); ?>"
                                        class="img-fluid w-100" alt="">
                                </a>
                                <!--End Course Image-->
                                <!--Start items badge-->
                                <div
                                    class="align-items-center top-0 d-flex fs-12 position-absolute px-3 py-2 start-0 text-white w-100 z-index-2">
                                    <?php
    if ($save_course->tagstatus == 4) {?>
                                    <span class="badge-new  me-1">Most Popular</span>
                                    <?php
    } elseif ($save_course->tagstatus == 3) {?>
                                    <span class="badge-new  me-1">New</span>
                                    <?php } elseif ($save_course->tagstatus == 1) {?>
                                    <span class="badge-new  me-1">Recomended</span>

                                    <?php } elseif ($save_course->tagstatus == 2) {?>
                                    <span class="badge-new  me-1">Best Seller</span>
                                    <?php }?>
                                    <span
                                        class="badge-business"><?php echo html_escape($save_course->category_name); ?></span>
                                    <span id="savecourse<?php echo $save_course->course_id; ?>" class="ms-auto">
                                        <?php if (!$coursesaved_checked) {?>
                                        <?php } else {?>
                                        <img onclick="get_coursesaves(0,4,'<?php echo $save_course->course_id; ?>','<?php echo $user_id; ?>')"
                                            src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-2.png'); ?>"
                                            class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                                        <?php }?>
                                    </span>
                                </div>
                                <?php if (!empty($save_course->is_discount == 1)) {?>
                                <span
                                    class="px-0 badge m-3   position-absolute start-0 text-white   z-index-2 polygon-shape"
                                    style="top:25px">
                                    <span class="d-block fs-13 mb-1">Off</span>
                                    <span
                                        class="fs-15 fw-bold"><?php echo (($save_course->discount) ? $save_course->discount : ''); ?><?php if ($save_course->discount_type == 2) {echo "%";} else {echo " ";}?></span>
                                </span>
                                <?php }?>
                                <!--End items badge-->
                                <!-- </div> -->
                                <!--Start Course Card Body-->
                                <div class="bg-prussian-blue course-card_body course_middle px-3 py-2 text-white py-12">
                                    <!--Start Course Title-->
                                    <h3 class="course-card__course--title  mb-0 text-capitalize">
                                        <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                            class="text-decoration-none text-white"><?php echo (!empty($save_course->name) ? $save_course->name : ''); ?></a>
                                    </h3>
                                    <!--End Course Title-->
                                    <div class="course-card__instructor d-flex align-items-center">
                                        <div class="card__instructor--name my-2">
                                            <a class="text-capitalize instructor-name"
                                                href="<?php echo base_url($enterprise_shortname . '/instructor-profile-show/' . $save_course->faculty_id); ?>"><?php echo (!empty($save_course->instructor_name) ? $save_course->instructor_name : ''); ?></a>
                                        </div>
                                    </div>
                                    <!--Start Course Hints-->
                                    <table class="course-card__hints table table-borderless table-sm text-white mb-0">
                                        <tbody>
                                            <tr>
                                                <td width="80" class="ps-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="course-card__hints--icon me-3">
                                                            <?php
    if (@$save_course->course_level == 1) {?>
                                                            <div class="d-flex align-items-center">
                                                                <div class="bar-custom me-2">
                                                                    <span class="fill"></span>
                                                                    <span></span>
                                                                    <span></span>
                                                                </div>
                                                            </div>
                                                            <?php } elseif (@$save_course->course_level == 2) {?>
                                                            <div class="d-flex align-items-center">
                                                                <div class="bar-custom me-2">
                                                                    <span class="fill"></span>
                                                                    <span class="fill"></span>
                                                                    <span></span>
                                                                </div>
                                                            </div>
                                                            <?php } elseif (@$save_course->course_level == 3) {?>
                                                            <div class="d-flex align-items-center">
                                                                <div class="bar-custom me-2">
                                                                    <span class="fill"></span>
                                                                    <span class="fill"></span>
                                                                    <span class="fill"></span>
                                                                </div>
                                                            </div>
                                                            <?php }?>
                                                        </div>
                                                        <div class="course-card__hints--text fs-12 fw-bold text-white">
                                                            <?php
    if ($save_course->course_level == 1) {

                echo "Beginner  Level";
            } elseif ($save_course->course_level == 2) {
                echo "Intermediate Level";
            } elseif ($save_course->course_level == 3) {
                echo "Advanced Level";
            }
            ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="course-card__hints--icon me-3">
                                                            <svg id="document" xmlns="http://www.w3.org/2000/svg"
                                                                width="17.26" height="14.926" viewBox="0 0 17.26 14.926">
                                                                <path id="Path_148" data-name="Path 148"
                                                                    d="M16.065,17.081H1.2a1.2,1.2,0,0,0-1.2,1.2V28.364a1.2,1.2,0,0,0,1.2,1.2h8.67l-.262,1.6a.69.69,0,0,0,1.041.75l1.871-.985a.393.393,0,0,1,.248,0l1.871.985a.834.834,0,0,0,.388.1.656.656,0,0,0,.387-.123.726.726,0,0,0,.266-.728l-.262-1.6h.651a1.2,1.2,0,0,0,1.2-1.2V18.277A1.2,1.2,0,0,0,16.065,17.081ZM12.64,27.511a2.084,2.084,0,1,1,2.084-2.084A2.086,2.086,0,0,1,12.64,27.511Zm.6,2.5a1.383,1.383,0,0,0-1.2,0l-1.323.7.42-2.565a3.1,3.1,0,0,0,3.007,0l.164,1v.005l.256,1.56Zm2.994-1.651a.173.173,0,0,1-.171.171h-.819l-.187-1.142s0-.009,0-.013a3.108,3.108,0,1,0-4.831,0l0,.013-.187,1.142H1.2a.173.173,0,0,1-.171-.171V18.277a.173.173,0,0,1,.171-.171H16.065a.173.173,0,0,1,.171.171Z"
                                                                    transform="translate(0 -17.081)" fill="#B5C5DB" />
                                                                <path id="Path_149" data-name="Path 149"
                                                                    d="M43.246,60.243H31.631a.512.512,0,0,0,0,1.025H43.246a.512.512,0,0,0,0-1.025Z"
                                                                    transform="translate(-28.993 -57.295)" fill="#B5C5DB" />
                                                                <path id="Path_150" data-name="Path 150"
                                                                    d="M36.55,100.911H31.631a.512.512,0,0,0,0,1.025H36.55a.512.512,0,0,0,0-1.025Z"
                                                                    transform="translate(-28.993 -95.184)" fill="#B5C5DB" />
                                                            </svg>
                                                        </div>
                                                        <div class="course-card__hints--text fs-12 fw-bold text-white">
                                                            <?php if ($save_course->enterprise_name == 'Admin') {echo "Lead Academy";} else {echo $save_course->enterprise_name . " " . "Academy";}?>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <!--End Course Hints-->
                                    <div
                                        class="align-items-center d-flex fs-12 justify-content-between pt-1 text-white w-100">
                                        <div class="d-flex align-items-center">
                                            <div class="course-card__hints--icon me-3">
                                                <svg id="clock_1_" data-name="clock (1)" xmlns="http://www.w3.org/2000/svg"
                                                    width="16.706" height="16.706" viewBox="0 0 16.706 16.706">
                                                    <path id="Path_13" data-name="Path 13"
                                                        d="M8.353,0a8.353,8.353,0,1,0,8.353,8.353A8.363,8.363,0,0,0,8.353,0Zm0,15.662a7.309,7.309,0,1,1,7.309-7.309,7.317,7.317,0,0,1-7.309,7.309Z"
                                                        fill="#B5C5DB" />
                                                    <path id="Path_14" data-name="Path 14"
                                                        d="M208.838,83.118h-1.044v5.437l3.285,3.285.738-.738-2.979-2.979Z"
                                                        transform="translate(-199.963 -79.985)" fill="#B5C5DB" />
                                                </svg>
                                            </div>
                                            <div class="course-card__hints--text fs-12 fw-bold text-white">
                                                <?php
    $course_wise_lesson = $this->Course_model->course_wise_lesson($save_course->course_id);
            $seconds = 0;
            foreach ($course_wise_lesson as $lesson) {
                list($hour, $minute, $second) = explode(':', html_escape($lesson->duration));
                $seconds += $hour * 3600;
                $seconds += $minute * 60;
                $seconds += $second;
            }
            $hours = floor($seconds / 3600);
            $seconds -= $hours * 3600;
            $minutes = floor($seconds / 60);
            $seconds -= $minutes * 60;
            // echo  "14 hrs 33 min"
            echo ' ' . $hours . " hrs" . " " . $minutes . " min";
            ?>
                                            </div>
                                        </div>
                                        <div class="course-like d-flex align-items-center">
                                            <i class="fas fa-graduation-cap fs-15 me-1 " style="color:#B5C5DB"></i>
                                            <div class="d-block">
                                                <div class="reviews fs-12 fw-bold text-white"><?php
    $studentCount = $this->db->where('product_id', $save_course->course_id)->get('invoice_details')->num_rows();
            //echo  html_escape($studentCount?$studentCount:0)
            echo number_format($studentCount ? $studentCount : 0);
            ?></div>
                                            </div>
                                        </div>

                                        <!--Start Star Rating-->
                                        <div class="star-rating__wrap d-flex align-items-center ">
                                            <i class="fas fa-star me-1 text-warning" style="color:#B5C5DB"></i>
                                            <div class="d-block">
                                                <div class="reviews fs-12 fw-bold text-white">
                                                    <?php echo average_ratings_number($save_course->course_id, $enterprise_id); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End Course Card Body-->

                                <!--Start Course Card Hover Content-->

                                <div class="course-card__hover--content">
                                    <img src="<?php echo base_url(!empty($save_course->hover_thumbnail) ? $save_course->hover_thumbnail : default_600_400()); ?>"
                                        class="course-card__hover--content___img">
                                    <!--Start Video Icon With Popup Youtube-->
                                    <?php if ($save_course->url) {?>

                                    <a class="course-card__hover--content___icon popup-youtube"
                                        href="<?php echo (!empty($save_course->url) ? $save_course->url : ''); ?>" autoplay>
                                        <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/Playicon.png'); ?>"
                                            class="img-fluid" alt="">
                                    </a>
                                    <?php }?>
                                    <!--End Video Icon With Popup Youtube-->

                                    <h3
                                        class="bottom-0 course-card__hover--content___text d-block fs-15 mb-0 position-absolute text-capitalize text-decoration-none text-white">
                                        <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                            class="text-decoration-none text-white"><?php echo (!empty($save_course->name) ? $save_course->name : ''); ?></a>
                                    </h3>
                                </div>
                                <!--End Card Hover Content-->
                            </div>
                            <?php $course_types = json_decode($save_course->course_type);
                            $checked_purchase = $this->db->where('customer_id',$user_id)->where('product_id', $save_course->course_id)->where('status',1)->get('invoice_details')->row();
                            ?>
                            <div class="course-card_footer g-2 px-3 py-12">
                                <?php 
                                // check purchase or subscription 
                                if($checked_purchase){?>
                                <div class="d-block">
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio" name="" id=""
                                            onclick="" disabled>
                                        <label class="form-check-label fw-bold opa-half course_price_cart"
                                            for="flexRadioDefault1">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio" name="" id=""
                                            onclick="" disabled>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                            style="width:100%;"
                                            for="flexRadioDefault2_<?php echo $save_course->course_id?>">
                                            <span class="course_price_cart">Course Price
                                                <span class="text-success">
                                                </span>
                                            </span>
                                            <span class="align-items-center d-flex  rounded text-center">
                                                <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                    <?php echo (($save_course->is_offer == 1) ? number_format($save_course->offer_courseprice) : number_format($save_course->price)); ?></span>
                                                <?php if(!empty($save_course->is_discount==1)){?>
                                                <del
                                                    class="fs-12 fw-bold text-muted2"><?php echo (($save_course->oldprice)?number_format($save_course->oldprice) :" "); ?></del>
                                                <?php }?>
                                            </span>
                                        </label>
                                        <!-- <span class="badge bg-success me-1 float-end ms-auto">  </span> -->
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="javascript:void(0)"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Enrolled</span>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img class="me-1"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Details</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php }else{?>
                                <div class="d-block">
                                    <?php if (in_array("1", $course_types) && in_array("2", $course_types)) {?>
                                    <input type="hidden" class="course" value="<?php echo $save_course->course_id; ?>"
                                        id="<?php echo $save_course->course_id; ?>">
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <!-- <input class="form-check-input" type="radio" name="flexRadioDefault1_<?php echo $save_course->course_id ?>" id="flexRadioDefault1_<?php echo $save_course->course_id ?>"  onclick="subscriptionchecedRadio('<?php echo $save_course->course_id; ?>')" > -->
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault1_1<?php echo $save_course->course_id ?>"
                                            id="flexRadioDefault1_1<?php echo $save_course->course_id ?>"
                                            onclick="subscriptionchecedRadios('<?php echo $save_course->course_id; ?>')">
                                        <label class="form-check-label fw-bold course_price_cart "
                                            for="flexRadioDefault1_1<?php echo $save_course->course_id ?>">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="form-check d-flex align-items-center ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault2_2<?php echo $save_course->course_id ?>"
                                            id="flexRadioDefault2_2<?php echo $save_course->course_id ?>"
                                            onclick="coursechecedRadios('<?php echo $save_course->course_id; ?>')" checked>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                            style="width:100%;"
                                            for="flexRadioDefault2_2<?php echo $save_course->course_id ?>">
                                            <span class="course_price_cart">Course Price
                                                <span class="text-success">
                                                </span>
                                            </span>
                                            <span class="align-items-center d-flex  rounded text-center">
                                                <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                    <?php echo (($save_course->is_offer == 1) ? number_format($save_course->offer_courseprice) : number_format($save_course->price)); ?></span>
                                                <?php if (!empty($save_course->is_discount == 1)) {?>
                                                <del
                                                    class="fs-12 fw-bold text-muted2"><?php echo (($save_course->oldprice) ? number_format($save_course->oldprice) : " "); ?></del>
                                                <?php }?>

                                            </span>
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2"
                                        id="course_purchasess_<?php echo $save_course->course_id ?>">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13"> Purchase
                                                </span>

                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img class="me-1"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Details</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2"
                                        id="course_subscriptionss_<?php echo $save_course->course_id ?>">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php echo base_url($enterprise_shortname . '/subscription-details'); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13"> Subscription
                                                </span>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img class="me-1"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Details</span>

                                            </a>
                                        </div>
                                    </div>
                                    <?php } elseif (in_array("3", $course_types) && in_array("4", $course_types)) {?>
                                    <!-- <div class="d-flex justify-content-between align-items-stretch ">
                                            <div class="flex-grow-1 me-1">
                                                <button type="button" class="btn btn-dark-cerulean w-100">
                                                    <i data-feather="shopping-cart" class="me-1"></i>
                                                    Subscription
                                                </button>
                                            </div>
                                            <div class="flex-grow-1">
                                                <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>" class="btn btn-dark-cerulean w-100">
                                                    <i data-feather="info" class="me-1"></i>
                                                    Details
                                                </a>
                                            </div>
                                        </div> -->
                                    <?php } elseif (in_array("1", $course_types)) {?>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault1_<?php echo $save_course->course_id ?>"
                                            id="flexRadioDefault1_<?php echo $save_course->course_id ?>"
                                            onclick="subscriptionchecedRadio('<?php echo $save_course->course_id; ?>')"
                                            disabled>
                                        <label class="form-check-label fw-bold opa-half course_price_cart"
                                            for="flexRadioDefault1">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="form-check d-flex align-items-center ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault2_<?php echo $save_course->course_id ?>"
                                            id="flexRadioDefault2_<?php echo $save_course->course_id ?>"
                                            onclick="coursechecedRadio('<?php echo $save_course->course_id; ?>')" checked>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                            style="width:100%"
                                            for="flexRadioDefault2_<?php echo $save_course->course_id ?>">
                                            <span class="course_price_cart">Course Price <span class="text-success"></span>
                                            </span>
                                            <span class="align-items-center d-flex  rounded text-center">
                                                <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                    <?php echo (($save_course->is_offer == 1) ? number_format($save_course->offer_courseprice) : number_format($save_course->price)); ?></span>
                                                <?php if (!empty($save_course->is_discount == 1)) {?>
                                                <del
                                                    class="fs-12 fw-bold text-muted2"><?php echo (($save_course->oldprice) ? number_format($save_course->oldprice) : " "); ?></del>
                                                <?php }?>
                                            </span>

                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13"> Purchase
                                                </span>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img class="me-1"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Details</span>
                                            </a>
                                        </div>
                                    </div>
                                    <?php } elseif (in_array("2", $course_types)) {?>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault1_<?php echo $save_course->course_id ?>"
                                            id="flexRadioDefault1_<?php echo $save_course->course_id ?>"
                                            onclick="subscriptionchecedRadio('<?php echo $save_course->course_id; ?>')"
                                            checked>
                                        <label class="form-check-label fw-bold course_price_cart"
                                            for="flexRadioDefault1_<?php echo $save_course->course_id ?>">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="form-check d-flex align-items-center ps-0 ">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault2_<?php echo $save_course->course_id ?>"
                                            id="flexRadioDefault2_<?php echo $save_course->course_id ?>"
                                            onclick="coursechecedRadio('<?php echo $save_course->course_id; ?>')" disabled>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between opa-half"
                                            style="width: calc(100% - 25px);" for="flexRadioDefault2">
                                            <span class="course_price_cart">Course Price <span
                                                    class="text-success"></span></span>
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php echo base_url($enterprise_shortname . '/subscription-details'); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13"> Subscription
                                                </span>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img class="me-1"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Details</span>
                                            </a>
                                        </div>
                                    </div>
                                    <?php } elseif (in_array("3", $course_types)) {?>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault1_<?php echo $save_course->course_id ?>"
                                            id="flexRadioDefault1_<?php echo $save_course->course_id ?>"
                                            onclick="subscriptionchecedRadio('<?php echo $save_course->course_id; ?>')"
                                            disabled>
                                        <label class="form-check-label fw-bold opa-half course_price_cart"
                                            for="flexRadioDefault1">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault2_<?php echo $save_course->course_id ?>"
                                            id="flexRadioDefault2_<?php echo $save_course->course_id ?>"
                                            onclick="coursechecedRadio('<?php echo $save_course->course_id; ?>')" disabled>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between opa-half"
                                            style="width: calc(100% - 25px);" for="flexRadioDefault2">
                                            <span class="course_price_cart">Course Price </span>
                                            <span class="d-flex px-2 rounded text-center">
                                                <span class="d-block fs-12 fw-bold me-2 text-success">
                                                    <!-- Free -->
                                                </span>
                                            </span>
                                        </label>
                                        <span class="badge bg-success me-1 float-end ms-auto"> Free</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13"> Enroll Free </span>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img class="me-1"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Details</span>
                                            </a>
                                        </div>
                                    </div>

                                    <?php } elseif (in_array("4", $course_types)) {?>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault1_<?php echo $save_course->course_id ?>"
                                            id="flexRadioDefault1_<?php echo $save_course->course_id ?>"
                                            onclick="subscriptionchecedRadio('<?php echo $save_course->course_id; ?>')"
                                            disabled>
                                        <label class="form-check-label fw-bold opa-half course_price_cart"
                                            for="flexRadioDefault1">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault2_<?php echo $save_course->course_id ?>"
                                            id="flexRadioDefault2_<?php echo $save_course->course_id ?>"
                                            onclick="coursechecedRadio('<?php echo $save_course->course_id; ?>')" disabled>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between opa-half"
                                            for="flexRadioDefault2_<?php echo $save_course->course_id ?>">
                                            <span class="course_price_cart">Course Price</span>
                                            <span class="bg-danger d-flex px-2 rounded text-center text-white">
                                                <!-- Govt -->
                                            </span>
                                        </label>
                                        <span class="badge bg-success me-1 float-end ms-auto"> Govt</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13"> Govt </span>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $save_course->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img class="me-1"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Details</span>
                                            </a>
                                        </div>
                                    </div>
                                    <?php } else {?>
                                    No Allow this type
                                    <?php }?>
                                </div>
                                <?php }?>
                            </div>


                        </div>
                        <?php }} else {?>

                        <div class="bg-white d-block h-100 rounded-6">
                            <!--Start Course Card-->
                            <div class=" border rounded-6 bg-white">
                                <a href="<?php echo base_url($enterprise_shortname . '/allcourse/'); ?>"
                                    class="bg-white d-block h-100 rounded-6">
                                    <!--Start Course Image-->
                                    <!--Start Course Card Body-->
                                    <div class="bg-white m-0 px-3 py-5 rounded-6 text-center">

                                        <div class="border d-inline-block rounded-circle text-center mb-3"
                                            style="width:50px;height: 50px;"><i class="d-block text-dark"
                                                data-feather="plus"
                                                style="height: 48px;font-size: 25px;margin: 0 auto;"></i></div>
                                        <div class="fw-bold text-dark">Find your desired course</div>
                                    </div>
                                    <!--End Course Card Body-->
                                </a>
                                <!--End Course Card-->
                            </div>
                        </div>
                        <div class="empty-box-darker d-block h-100 rounded-6">
                            <!--Start Course Card-->
                            <div class=" border rounded-6 empty-box-darker">
                                <div class="empty-box-darker d-block h-100 rounded-6">
                                    <!--Start Course Image-->
                                    <!--Start Course Card Body-->
                                    <div class="empty-box-darker m-0 px-3 py-5 rounded-6 text-center">

                                        <div class=" d-inline-block rounded-circle text-center mb-3"
                                            style="width:50px;height: 70px;"><i class="d-block text-dark"
                                                style="height: 48px;font-size: 25px;margin: 0 auto;"></i></div>
                                        <div class="fw-bold text-dark"></div>
                                    </div>
                                    <!--End Course Card Body-->
                                </div>
                                <!--End Course Card-->
                            </div>
                        </div>
                        <div class="empty-box-darker d-block h-100 rounded-6">
                            <!--Start Course Card-->
                            <div class="border rounded-6 empty-box-darker">
                                <div class="empty-box-darker d-block h-100 rounded-6">
                                    <!--Start Course Image-->
                                    <!--Start Course Card Body-->
                                    <div class="empty-box-darker m-0 px-3 py-5 rounded-6 text-center">

                                        <div class=" d-inline-block rounded-circle text-center mb-3"
                                            style="width:50px;height: 70px;"><i class="d-block text-dark"
                                                style="height: 48px;font-size: 25px;margin: 0 auto;"></i></div>
                                        <div class="fw-bold text-dark"></div>
                                    </div>
                                    <!--End Course Card Body-->
                                </div>
                                <!--End Course Card-->
                            </div>
                        </div>
                        <div class="empty-box-darker d-block h-100 rounded-6">
                            <!--Start Course Card-->
                            <div class=" border rounded-6 empty-box-darker">
                                <div class="empty-box-darker d-block h-100 rounded-6">
                                    <!--Start Course Image-->
                                    <!--Start Course Card Body-->
                                    <div class="empty-box-darker m-0 px-3 py-5 rounded-6 text-center">

                                        <div class=" d-inline-block rounded-circle text-center mb-3"
                                            style="width:50px;height: 70px;"><i class="d-block text-dark"
                                                style="height: 48px;font-size: 25px;margin: 0 auto;"></i></div>
                                        <div class="fw-bold text-dark"></div>
                                    </div>
                                    <!--End Course Card Body-->
                                </div>
                                <!--End Course Card-->
                            </div>
                        </div>

                        <?php }?>
                        <!--End Course Card-->
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--End Popular Course-->
    <!--Start Followed Instructor-->
    <div class="bg-alice-blue py-3">
        <div class="container-lg">
            <div class="card border-0 rounded-0 shadow-sm">
                <div class="card-body p-4">
                    <!--Start Section Header-->
                    <div class="section-header mb-4">
                        <h4>Followed Instructor </h4>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                    <div class="row">
                        <?php
    if ($get_followereinstructor) {
        foreach ($get_followereinstructor as $instructor) {
            $get_newcoursecount = $this->Frontend_model->get_newcoursecount($instructor->follower_id, $instructor->enterprise_id);
            $get_newoffercoursecount = $this->Frontend_model->get_newoffercoursecount($instructor->follower_id, $instructor->enterprise_id);
            $get_newforumcount = $this->Frontend_model->get_newforumcount($instructor->enterprise_id);
            $get_newlivecoursecount = $this->Frontend_model->get_newlivecoursecount($instructor->follower_id, $instructor->enterprise_id);
            $totalCount = 0;
            $totalCount = ($get_newcoursecount->newcourse + $get_newoffercoursecount->offercourse + $get_newforumcount->newforumcount + $get_newlivecoursecount->livecoursecount);
            ?>
                        <div class="col-md-6">
                            <div class="card rounded-20 mb-3">
                                <div class="card-body p-4">
                                    <div class="row mb-4">
                                        <div class="col-md-8">
                                            <div class="avatar d-flex align-items-center">
                                                <div class="avatar-img me-3">
                                                    <img src="<?php echo base_url(!empty($instructor->picture) ? $instructor->picture : default_image()) ?>"
                                                        alt="">
                                                </div>
                                                <div class="avatar-text">
                                                    <div class="avatar-position text-muted mb-1">Instructor </div>
                                                    <h5 class="avatar-name mb-0">
                                                        <a
                                                            href="<?php echo base_url($enterprise_shortname . '/instructor-profile-show/' . $instructor->follower_id); ?>">
                                                            <?php echo (!empty($instructor->name) ? $instructor->name : ''); ?>
                                                        </a>
                                                    </h5>
                                                    <div class="avatar-designation">
                                                        <?php echo (!empty($instructor->designation) ? $instructor->designation : ''); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">

                                            <button class="btn btn-danger btn-sm text-white mb-2 w-100"
                                                onclick="studentUnfollowInstructor('<?php echo $instructor->id; ?>')">Unfollow</button>
                                            <a href="javascript:void(0)" class="btn hiring-btn w-100">
                                                <span
                                                    class="text-danger"><?php echo (!empty($totalCount) ? $totalCount : '0'); ?>
                                                    New</span>&nbsp;Updates
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <a href="<?php echo base_url($enterprise_shortname . '/single-instructor-courses/' . $instructor->follower_id); ?>"
                                            class="btn  btn-sm btn-outline-dark-cerulean me-2">
                                            <span
                                                class="text-danger">+<?php echo (!empty($get_newcoursecount->newcourse) ? $get_newcoursecount->newcourse : '0'); ?></span>&nbsp;New
                                            Course
                                        </a>
                                        <a href="<?php echo base_url($enterprise_shortname . '/single-instructor-courses/' . $instructor->follower_id); ?>"
                                            class="btn  btn-sm btn-outline-dark-cerulean me-2">
                                            <span
                                                class="text-danger">+<?php echo (!empty($get_newoffercoursecount->offercourse) ? $get_newoffercoursecount->offercourse : '0'); ?></span>&nbsp;
                                            Offer Course
                                        </a>
                                        <a href="<?php echo base_url($enterprise_shortname . '/single-instructor-activities/' . $instructor->follower_id); ?>"
                                            class="btn  btn-sm btn-outline-dark-cerulean me-2">
                                            <span
                                                class="text-danger">+<?php echo (!empty($get_newforumcount->newforumcount) ? $get_newforumcount->newforumcount : '0'); ?></span>&nbsp;Blog
                                        </a>
                                        <a href="<?php echo base_url($enterprise_shortname . '/single-instructor-activities/' . $instructor->follower_id); ?>"
                                            class="btn  btn-sm btn-outline-dark-cerulean me-2">
                                            <span
                                                class="text-danger">+<?php echo (!empty($get_newlivecoursecount->livecoursecount) ? $get_newlivecoursecount->livecoursecount : '0'); ?></span>&nbsp;Live
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }} else {?>
                        <div class="col-md-6"> You didn't follow any instructor </div>
                        <?php }?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--End Followed Instructor-->


    <script>
    $('#manage_interets').hide();
    $('#edit_topics').on('click', function() {
        $('#manage_interets').show();
        $("#titles").html("Edit Your Choices");
        $('#view_interets').hide();
    });

    function checedBox(s) {

        if (!$('#imgCheck_' + s).is('.checked')) {
            // alert('checked');
            $(".interestcheck_" + s).removeClass('btn-info');
            $(".interestcheck_" + s).addClass("interestcheck");

            $('#imgCheck_' + s).addClass('checked');
            $('#imgCheck_' + s).prop('checked', true);
            $('#imgCheck_' + s).val("1");
            $(".plus_" + s).html('<polyline points="20 6 9 17 4 12"></polyline>');
            $(".check_" + s).html('<polyline points="20 6 9 17 4 12"></polyline>');


        } else {
            // alert('unchecked');
            $('#imgCheck_' + s).val("0");
            $('#imgCheck_' + s).removeClass('checked');
            $('#imgCheck_' + s).prop('checked', false);
            $(".interestcheck_" + s).addClass("btn-info");
            $(".interestcheck_" + s).removeClass("interestcheck");

            $(".check_" + s).html(
                '<line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line>');
            // $(".plus_"+s).html('<polyline points="20 6 9 17 4 12"></polyline>');
            $(".plus_" + s).html(
                '<line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line>');
        }


        // var checkeds = $('#imgCheck_' + s).val();
        // var user_id = $("#user_id").val();
        // var enterprise_id = $("#enterprise_id").val();
        // var category_id = $('#category_id_' + s).val();
        // $.ajax({
        //     url: base_url + enterprise_shortname + "/interest-save",
        //     type: "POST",
        //     data: {
        //         csrf_test_name: CSRF_TOKEN,
        //         user_id: user_id,
        //         category_id: category_id,
        //         checkeds: checkeds,
        //         enterprise_id: enterprise_id,
        //     },
        //     success: function(r) {

        //     },
        // });

    }
    $('#intarestdone').on('click', function() {
        var s = $("#sl").val();
        //     var fd = new FormData();
        //    var checkeds = $('#imgCheck_' + s).val();

        var user_id = $("#user_id").val();
        var enterprise_id = $("#enterprise_id").val();
        var dfile = $('input[name="imgCheck[]"]');
        var check_status = [];
        var category_ids = [];
        for (var i = 0; i < dfile.length; i++) {
            var ids = i + 1;
            var title = dfile[i];
            var tagid = title.value;
            check_status[i] = tagid;
            category_ids[i] = $('#category_id_' + i).val();
        }
        $.ajax({
            url: base_url + enterprise_shortname + "/interest-save",
            type: "POST",
            data: {
                csrf_test_name: CSRF_TOKEN,
                user_id: user_id,
                category_id: category_ids,
                ncategories: check_status,
                enterprise_id: enterprise_id,
            },
            success: function(r) {

                toastrSuccessMsg(r);
            },
        });

    });
    </script>


    <?php 

    ?>

    <script>
    // Bar CHart
    var ctx = document.getElementById("myChart4").getContext('2d');
    if (myChart) myChart.destroy();
    var myChart = new Chart(ctx, {
        type: 'bar',
        label: 'Demo',
        data: {
            <?php 
                    $list='';
                    $qdat = array();
                    $date_yd = array();
                    for($i = 6; $i >= 0; $i--)
                    {
                            $dateValue = date("Y-m-d", strtotime("-$i days"));
                            $time=strtotime($dateValue);
                            $date_m=date("m",$time);
                            $date_y=date("Y",$time);
                            $day=date("d",$time);
                            
                            $date = $day."-".$date_m."-".$date_y;
                            $qdat[] = $date_y."-".$date_m."-".$day;
                            $date_yd[] = $date_y;

                            // $list.= "'"."" . $date ."'". ",";
                            $list.= "'"."" . date('d '.'M' ,$time) ."'". ",";
                        
                    }

                    $color=[
                        '#caf270','#45c490',
                        '#008d93','#2e5468',
                        '#caf270','#45c490',
                        '#008d93','#2e5468',
                        '#caf270','#45c490',
                        '#008d93','#2e5468',
                        '#caf270','#45c490',
                        '#008d93','#2e5468',
                        '#caf270','#45c490',
                        '#008d93','#2e5468',
                        '#caf270','#45c490',
                        '#008d93','#2e5468',
                        '#caf270','#45c490',
                        '#008d93','#2e5468',
                        '#caf270','#45c490',
                        '#caf270','#45c490',
                        '#caf270','#45c490',
                        '#008d93','#2e5468',
                        '#caf270','#45c490',
                        '#008d93','#2e5468',
                        '#caf270','#45c490',
                        '#008d93','#2e5468',
                        '#caf270','#45c490',
                        '#008d93','#2e5468',
                        '#caf270','#45c490',
                        '#008d93','#2e5468',
                        '#caf270','#45c490',
                        '#008d93','#2e5468',
                        '#caf270','#45c490',
                        '#008d93','#2e5468',
                        '#caf270','#45c490',
                        '#008d93','#45c490',

                    ];
                    $query=$this->db->select('daily_watch_time_tbl.*,course_tbl.name')
                                        ->from('daily_watch_time_tbl')
                                        ->join('course_tbl ', 'course_tbl.course_id = daily_watch_time_tbl.course_id', 'left')
                                        ->where_in('daily_watch_time_tbl.date',$qdat)
                                        ->where('daily_watch_time_tbl.student_id',$user_id)
                                        ->where('daily_watch_time_tbl.enterprise_id',$enterprise_id)
                                        ->group_by('daily_watch_time_tbl.course_id')
                                        ->get()
                                        ->result();
                    
                    ?>
            labels: [<?php echo $list?>],

            datasets: [
                <?php foreach($query as $key=>$cname){ 
                                $count='';
                                for($i=0; 6>=$i; $i++) {
                                    $date = $qdat[$i];
                                    $rw=$this->db->select('sum(studentwatchTime) as todaywatchtime')
                                    ->from('daily_watch_time_tbl')
                                    ->where('date',$date)
                                    ->where('course_id',$cname->course_id)
                                    ->get()->row();
                                    // $count.=($rw->todaywatchtime?$rw->todaywatchtime:'0').',';
                                    //  $init = $rw->todaywatchtime;
                                    // $hours = floor($init / 3600);
                                    // $minutes = floor(($init / 60) % 60);
                                    // $seconds = $init % 60;
                                    /*** number of days ***/
                                    
                                    $minutes = floor ($rw->todaywatchtime / 60);
                                    //$count.= "$hours:$minutes:$seconds".',';
                                    $count.= "$minutes".',';
                                    
                                }
                            ?> {
                    label: '<?php echo $cname->name;?>',
                    backgroundColor: "<?php echo $color[$key]?>",
                    data: [<?php echo rtrim($count,',')?>],
                },
                <?php } ?>
            ],
        },

        options: {
            tooltips: {
                displayColors: true,
                enabled: true,
                // callbacks: {
                // 	mode: 'x',
                // },

                callbacks: {
                    mode: 'x',
                    afterBody: function(t, d) {
                        return 'Minutes'; // return a string that you wish to append
                    },
                    // use label callback to return the desired label
                    //  label: function(tooltipItem, data) {
                    //     // alert(tooltipItem.xLabel);
                    // //    return tooltipItem.xLabel + " :" + tooltipItem.yLabel;
                    //     return ;
                    // },
                    // remove title
                    title: function(tooltipItem, data) {
                        return;
                    }
                }


            },
            scales: {
                xAxes: [{
                    stacked: true,
                    gridLines: {
                        display: false,
                    },

                }],
                yAxes: [{
                    stacked: true,
                    ticks: {
                        beginAtZero: true,
                        userCallback: function(value, index, values) {
                            // Convert the number to a string and splite the string every 3 charaters from the end
                            value = value.toString();
                            value = value.split(/(?=(?:...)*$)/);
                            // Convert the array to a string and format the output
                            value = value.join('.');
                            return value + " " + 'Min';
                        }
                    },

                    type: 'linear',
                    scaleLabel: {
                        display: true,
                        labelString: 'Watch minutes'
                    },

                    displayValueAxis: true,
                }]
            },
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom'
            },
        },

    });



    // Bar CHart
    // var ctx = document.getElementById("myChart4").getContext('2d');
    // var myChart = new Chart(ctx, {
    //     type: 'bar',
    //     data: {
    //         labels: [<?php echo $sutdent_chart['dateName']; ?>],
    //         datasets: [{
    //                 label: 'Course',
    //                 backgroundColor: "#2e5468",
    //                 data: [<?php echo $sutdent_chart['time']; ?>],
    //             },
    //             <?php ?>
    //         ],
    //     },
    //     options: {
    //         tooltips: {
    //             displayColors: true,
    //             callbacks: {
    //                 mode: 'x',
    //             },
    //         },
    //         scales: {
    //             xAxes: [{
    //                 stacked: true,
    //                 gridLines: {
    //                     display: false,
    //                 }
    //             }],
    //             yAxes: [{
    //                 stacked: true,
    //                 ticks: {
    //                     beginAtZero: true,
    //                 },
    //                 type: 'linear',
    //             }]
    //         },
    //         responsive: true,
    //         maintainAspectRatio: false,
    //         legend: {
    //             position: 'bottom'
    //         },
    //     }
    // });


    function get_coursesaves(status, type, course_id, student_id) {
        if (type == "") {
            toastrErrorMsg("Login must be required!");
            return false;
        }
        $.ajax({
            url: base_url + enterprise_shortname + "/get-coursesave",
            type: "POST",
            data: {
                csrf_test_name: CSRF_TOKEN,
                status: status,
                student_id: student_id,
                course_id: course_id,
            },
            success: function(r) {
                toastrSuccessMsg('Unsave succesfully');
            },
        });
    }




    // insterest course checkobx
    $(document).ready(function() {
        $(".hide_save_course .course").each(function(index) {
            var p_course_id = $(this).attr('id');
            $("#course_subscriptionss_" + p_course_id).hide();
            $('#course_subscriptionss_' + p_course_id).removeClass('d-flex');
        });
    });

    function coursechecedRadios(s) {

        if (!$('#flexRadioDefault2_2' + s).is('.checked')) {
            $('#flexRadioDefault2_2' + s).addClass('checked');
            $('#flexRadioDefault2_2' + s).prop('checked', true);
            $('#flexRadioDefault2_2' + s).val("1");


            $('#flexRadioDefault1_1' + s).val("0");
            $('#flexRadioDefault1_1' + s).removeClass('checked');
            $('#flexRadioDefault1_1' + s).prop('checked', false);

            $("#course_subscriptionss_" + s).hide();
            $('#course_subscriptionss_' + s).removeClass('d-flex');
            $('#course_purchasess_' + s).addClass('d-flex');
            $("#course_purchasess_" + s).show();
        }

    }

    function subscriptionchecedRadios(s) {
        if (!$('#flexRadioDefault1_1' + s).is('.checked')) {
            $('#flexRadioDefault1_1' + s).addClass('checked');
            $('#flexRadioDefault1_1' + s).prop('checked', true);
            $('#flexRadioDefault1_1' + s).val("1");

            $('#flexRadioDefault2_2' + s).val("0");
            $('#flexRadioDefault2_2' + s).removeClass('checked');
            $('#flexRadioDefault2_2' + s).prop('checked', false);
            $("#course_subscriptionss_" + s).show();
            $('#course_subscriptionss_' + s).addClass('d-flex');
            $('#course_purchasess_' + s).removeClass('d-flex');
            $("#course_purchasess_" + s).hide();
        }

    }

    // $("#myCharthide_two").hide();



    function time_spent_filter(type) {
        var user_id = "<?php echo $user_id;?>";
        var enterprise_id = "<?php echo $enterprise_id;?>";
        // $("#myCharthide_one").hide();
        // $("#myCharthide_two").show();
        $.ajax({
            url: base_url + enterprise_shortname + "/get-time_spent_filter",
            type: "POST",
            data: {
                csrf_test_name: CSRF_TOKEN,
                user_id: user_id,
                enterprise_id: enterprise_id,
                type: type,
                enterprise_shortname: enterprise_shortname,
            },
            success: function(r) {

                $('#myChart4').html(r);
                // toastrSuccessMsg('Unsave succesfully');
            },
        });
    }
    </script>