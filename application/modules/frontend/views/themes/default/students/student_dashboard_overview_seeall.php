<?php 
 $user_id = $this->session->userdata('user_id');
function zeroprefix($count){
    $lessoncount=count($count);
     $str_length=2;
     $lessonnumbershow = substr("0000{$lessoncount}", -$str_length);
     echo $lessonnumbershow;
  }
  $user_id = $this->session->userdata('user_id');
 ?>
    <!--Start Student Profile Header-->
    <?php  $this->load->view('dashboard_coverpage');?>  
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
                        <div class="col-lg-10 col-md-10">
                            <h4>Course Overview</h4>
                            <div class="section-header_divider"></div>
                        </div>
                        <div class="col-lg-2 col-md-2 mt-4 mt-md-0">
                            <select class="form-select" id="courseStatus"
                                onchange="student_progress_filtering(this.value,'<?php echo $user_id;?>')">
                                <option value="">Sort by</option>
                                <option value="most_progressed">Most Progressed</option>
                                <!-- <option value="incomplete"></option> -->
                            </select>
                         </div>
                    </div>
               </div>
            <!--End Section Header-->
            <div class="row"  id="before_filtering">
                <?php 
                $i=0;
                $sm=0;
     
                   // Sort by oldest first
                 foreach($courses_overviews_see_more as $course_overview){
              
                  
                 
                   
                    $course_id= $course_overview->product_id?$course_overview->product_id:'';
                    $course_name= $course_overview->course_name?$course_overview->course_name:'';
                    $instructor_name= $course_overview->faculty_id?$course_overview->faculty_id:'';

                    $totalSubCompleteLesson = $this->db->where('course_id',$course_id)->where('student_id', $user_id)->where('is_complete',1)->where('enterprise_id',$enterprise_id)->get('watch_time_tbl')->num_rows();
                    $totalLesson = $this->db->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->get('lesson_tbl')->num_rows();
                    $totalChapter = $this->db->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->get('section_tbl')->num_rows();   
                    // progress      
                        //======video % start calculation here=================== 
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
                        // new  
                        // $videoWatchPercentage=$eachVedioPercent*25/100;
                        $videoWatchPercentage=$eachVedioPercent*$total_video_per/100;

                        }else{
                            $videoWatchPercentage=0;
                        }
                        //======video % end calculation here=================== 

                        // text file and pdf  start
                        $textFilePerCalculation=$this->db->where('course_id',$course_id)->where('lesson_type !=',1)->where('enterprise_id',$enterprise_id)->get('lesson_tbl')->num_rows();
                        $completetextFile = $this->db->where('course_id',$course_id)->where('student_id', $user_id)->where('file_type',0)->where('is_complete',1)->where('enterprise_id',$enterprise_id)->get('watch_time_tbl')->num_rows();
                        if($completetextFile > 0 && $textFilePerCalculation>0){
                        $Textfilecount=$completetextFile*100/$textFilePerCalculation;
                        $Filecomplete =$Textfilecount*$total_textper/100;

                        }else{
                         $Filecomplete=0;
                        }
                     
                        //=========================text file and pdf  end=================================
                        $VideoAndFIle=(!empty($videoWatchPercentage) ? $videoWatchPercentage:'0')+(!empty($Filecomplete) ? $Filecomplete:'0'); //===text file video file % sum 
                        
                        $Lessonprogress=($VideoAndFIle*$total_lesson_per)/100;
                        // quiz percentage calculation 
                        //  quiz  count 
                        $quizCount=$this->db->select('*')->from('assign_courseexam_tbl')
                        ->where('course_id',$course_id)
                        ->where('enterprise_id',$enterprise_id)
                        // ->where('student_id',$user_id)
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
                    
                    // when one or multiple type of course is empty  
                    // $Newpercent=1;
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

                    //end

                    // $TotalProgress=number_format(($Filecomplete*$Newpercent)+($videoWatchPercentage*$Newpercent)+($quizPercentage*$Newpercent)+($assignment*$Newpercent),1);
                       
                    $TotalProgress=number_format($Lessonprogress+$quizPercentage+$assignment,1);
                    
                    // $TotalProgress=number_format($VideoAndFIle+$quizPercentage+25,1); //==Total % calculation 
                       $result= $this->db->select("*")->from('invoice_tbl')->where('is_subscription',1)->where('status',1)->where('invoice_id',$course_overview->invoice_id)->get()->row();
                      if($course_overview->is_subscription==1){
                        $startdate = $result->expeiredate;
                        $expiredate = date('Y-m-d', strtotime($startdate));
                        $todayDate = date('Y-m-d');    
                        if($expiredate > $todayDate){
                    ?>
                    <div class="col-lg-4 col-sm-6 py-3">
                        <!--Start Course Card-->
                        <div class="course-card my-lg-0 my-2 rounded-20 bg-white position-relative overflow-hidden shadow-none border">
                            <!--Start Course Image-->
                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $course_id); ?>" class="course-card_img">
                                <img src="<?php echo base_url(!empty(get_picturebyid($course_id)->picture) ? get_picturebyid($course_id)->picture : default_600_400()); ?>"  style="height:240px" class="img-fluid w-100" alt="">
                            </a>
                            <!--End Course Image-->
                            <!--Start Course Card Body-->
                            <div class="course-card_body bg-prussian-blue p-4 position-relative m-0 rounded-0 bg-white">
                                <!--Start Course Title-->
                                <h3 class="course-card__course--title text-capitalize fs-6 mb-0">
                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $course_id); ?>" class="text-dark text-decoration-none"><?php echo html_escape($course_name);?></a>
                                </h3>
                                <!--End Course Title-->
                                <!--Start Course instructor-->
                                <div class="course-card__instructor mb-3">
                                    <div class="course-card__instructor--name text-black-50 text-uppercase fw-medium fs-13">by <?php  echo html_escape(get_userinfo($instructor_name)->name);?></div>
                                </div>
                                <!--End Course instructor-->
                                <!--Start Course Hints-->
                                <table class="course-card__hints table table-borderless table-sm fw-medium">
                                    <tbody>
                                        <tr>
                                            <td class="ps-0">
                                                <div class="d-flex align-items-center">
                                                    <div class="course-card__hints--text">
                                                        <span class="text-primary"><?php echo completedChapter($course_id,$enterprise_id,$user_id);?></span>/<?php echo $totalChapter;?> Chapters
                                                    </div>
                                                </div>
                                            </td>
                                            <td>&nbsp;&nbsp;<span class="text-primary"><?php echo $totalSubCompleteLesson;?></span>/<?php echo $totalLesson; ?> Lessons</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-0">
                                                <div class="d-flex align-items-center">
                                                    <div class="course-card__hints--text">
                                                    <span class="text-primary"><?php echo $completetotalassignment;?></span>/<?php echo $totalassignment;?> Assignment
                                                    </div>
                                                </div>
                                            </td>
                                            <td>&nbsp;&nbsp;<span class="text-primary"><?php echo count($quizComplete);?></span>/<?php echo count($quizCount)?> Quiz</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--End Course Hints-->
                                <div class="d-flex  fw-bold justify-content-between mb-2">
                                    <div style="color: #1270ca;">Progress</div>
                                    <div style="color: #1270ca;font-size: 18px;"><?php echo $TotalProgress?number_format($TotalProgress):'0';?>% Completed</div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width:<?php echo $TotalProgress?number_format($TotalProgress):'0';?>%" aria-valuenow="<?php echo $TotalProgress?number_format($TotalProgress):'0';?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--End Course Card Body-->
                        </div>
                        <!--End Course Card-->
                    </div>
                   <?php $sm++;$i++;}}else{
                    if($course_overview->is_subscription!=1){
                   ?>
                 <div class="col-lg-4 col-sm-6 py-3">
                        <!--Start Course Card-->
                        <div class="course-card my-lg-0 my-2 rounded-20 bg-white position-relative overflow-hidden shadow-none border">
                            <!--Start Course Image-->
                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $course_id); ?>" class="course-card_img">
                                <img src="<?php echo base_url(!empty(get_picturebyid($course_id)->picture) ? get_picturebyid($course_id)->picture : default_600_400()); ?>" class="img-fluid w-100"  style="height:240px" alt="">
                            </a>
                            <!--End Course Image-->
                            <!--Start Course Card Body-->
                            <div class="course-card_body bg-prussian-blue p-4 position-relative m-0 rounded-0 bg-white">
                                <!--Start Course Title-->
                                <h3 class="course-card__course--title text-capitalize fs-6 mb-0">
                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $course_id); ?>" class="text-dark text-decoration-none"><?php echo html_escape($course_name);?></a>
                                </h3>
                                <!--End Course Title-->
                                <!--Start Course instructor-->
                                <div class="course-card__instructor mb-3">
                                    <div class="course-card__instructor--name text-black-50 text-uppercase fw-medium fs-13">by <?php  echo html_escape(get_userinfo($instructor_name)->name);?></div>
                                </div>
                                <!--End Course instructor-->
                                <!--Start Course Hints-->
                                <table class="course-card__hints table table-borderless table-sm fw-medium">
                                    <tbody>
                                        <tr>
                                            <td class="ps-0">
                                                <div class="d-flex align-items-center">
                                                    <div class="course-card__hints--text">
                                                        <span class="text-primary"><?php echo completedChapter($course_id,$enterprise_id,$user_id);?></span>/<?php echo $totalChapter;?> Chapters
                                                    </div>
                                                </div>
                                            </td>
                                            <td>&nbsp;&nbsp;<span class="text-primary"><?php echo $totalSubCompleteLesson;?></span>/<?php echo $totalLesson; ?> Lessons</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-0">
                                                <div class="d-flex align-items-center">
                                                    <div class="course-card__hints--text">
                                                    <span class="text-primary"><?php echo $completetotalassignment;?></span>/<?php echo $totalassignment;?> Assignment
                                                    </div>
                                                </div>
                                            </td>
                                            <td>&nbsp;&nbsp;<span class="text-primary"><?php echo count($quizComplete);?></span>/<?php echo count($quizCount)?> Quiz</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--End Course Hints-->
                                <div class="d-flex  fw-bold justify-content-between mb-2">
                                    <div style="color: #1270ca;">Progress</div>
                                    <div style="color: #1270ca;font-size: 18px;"><?php echo $TotalProgress?number_format($TotalProgress):'0';?>% Completed</div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width:<?php echo $TotalProgress?number_format($TotalProgress):'0';?>%" aria-valuenow="<?php echo $TotalProgress?number_format($TotalProgress):'0';?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--End Course Card Body-->
                        </div>
                        <!--End Course Card-->
                    </div>
                <?php } }}?>
            </div>
             <div id="show_purchase_data">
              <nav aria-label="Page navigation"><?php echo $links; ?></nav>
              </div>

            </div>
        </div>
    </div>
    <!--End Course Overview-->

    <script>
      function student_progress_filtering(type,user_id){
        var type = type;
        var student_id = user_id;
        // var enroller_type = enroller_type;
        $.ajax({
            url: base_url + enterprise_shortname + "/student-progress-sort-filtering",
            type: "POST",
            data: {
                csrf_test_name: CSRF_TOKEN,
                student_id: student_id,
                type: type
            },
            success: function(r) {
                // if(enroller_type=='purchased'){
                  $('#before_filtering').hide();
                  $('#show_purchase_data').html(r);
                // }
                // if(enroller_type=='subscrition'){
                // $('#before_filtering_subscription').hide();
                // $('#show_subscription_data').html(r);
                // }

            },
        });
      }

    </script>