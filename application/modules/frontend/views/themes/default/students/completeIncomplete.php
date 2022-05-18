

                <div class="courses-carousel owl-carousel owl-theme">
    <!---=======Sub purchase course =================================-->
                    <?php if($enroller_type=='purchased'){
                        //    ================complete purchased course =====================
                         if($type =='completed' && !empty($purchase_course_complete)){
                         foreach($purchase_course_complete as $single_course){
                            $totalPurchaseCompleteLesson = $this->db->where('course_id',$single_course->product_id)->where('student_id', $user_id)->where('is_complete',1)->where('enterprise_id',$single_course->enterprise_id)->get('watch_time_tbl')->num_rows();
                            $totalPurchaseLesson = $this->db->where('course_id',$single_course->product_id)->where('enterprise_id',$single_course->enterprise_id)->get('lesson_tbl')->num_rows();
                            $totalPurchaseChapter = $this->db->where('course_id',$single_course->product_id)->where('enterprise_id',$single_course->enterprise_id)->get('section_tbl')->num_rows();
                            
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
                            $textFilePerCalculation=$this->db->where('course_id',$single_course->product_id)->where('lesson_type !=',1)->where('enterprise_id',$single_course->enterprise_id)->get('lesson_tbl')->num_rows();
                            $completetextFile = $this->db->where('course_id',$single_course->product_id)->where('student_id', $user_id)->where('file_type',0)->where('is_complete',1)->where('enterprise_id',$enterprise_id)->get('watch_time_tbl')->num_rows();
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
                             
                             // when one or multiple type of course is empty  
                            //   $Newpercent=1;
                            //   if(empty($quizCount) && empty($totalassignment) && empty($textFilePerCalculation)){
                            //       $Newpercent=4;
                            //   }else if(empty($quizCount) && empty($textFilePerCalculation)){
                            //       $Newpercent=2;
                            //   }else if(empty($quizCount) && empty($totalassignment)){
                            //       $Newpercent=2;
                            //   }else if(empty($totalassignment) && empty($textFilePerCalculation)){
                            //       $Newpercent=2;
                            //   }else{
                            //       if(!empty($quizCount) && !empty($totalassignment) && !empty($textFilePerCalculation)){
                            //           $Newpercent=1;
                            //       }else{
      
                            //           $Newpercent=1.333333333333;
                            //       }
                            //   }
                            $TotalProgress=number_format($Lessonprogress+$quizPercentage+$assignment,1);
                            //  $TotalProgress=number_format(($Filecomplete*$Newpercent)+($videoWatchPercentage*$Newpercent)+($quizPercentage*$Newpercent)+($assignment*$Newpercent),1);
                            //$TotalProgress=number_format($VideoAndFIle+$quizPercentage+25,1); //==Total % calculation
                             // ===========complete purchased course ==================================================================
                           // if( $type =='completed'){ if( $TotalProgress =='100'){ 
                             ?>
                            <div class="course-card rounded-20 bg-white position-relative overflow-hidden shadow-none border">
                                <!--Start Course Image-->
                                <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $single_course->product_id); ?>"
                                    class="course-card_img">

                                    <img src="<?php echo base_url(html_escape(($single_course->picture) ? "$single_course->picture" : ''));?>"
                                        class="img-fluid w-100"  style="height:240px" alt="">
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
                                                            <span class="text-primary"><?php echo $completetotalassignment;?></span>/ <?php echo  $totalassignment;?> Assignment
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>&nbsp;&nbsp;<span class="text-primary"><?php echo  count($quizComplete);?></span>/ <?php echo count($quizCount);?> Quiz</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--End Course Hints-->
                                    <div class="d-flex fw-bold justify-content-between mb-2">
                                        <div style="color: #1270ca;">Progress</div>
                                        <div style="color: #1270ca;font-size: 18px;"><?php echo  number_format($TotalProgress);?>% Completed</div>
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
                                                class="btn fs-16 fw-bold" style="background-color:#5475ff;color:#fff">Go To Course<i
                                                    data-feather="arrow-right" class="ms-2"></i></a>
                                            <?php }else{?>
                                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $single_course->product_id); ?>"
                                                class="btn fs-16 fw-bold" style="background-color:#B953FF;color:#fff">Start Now<i
                                                    data-feather="arrow-right" class="ms-2"></i></a>
                                            <?php }?>
                                        </div>
                                        <?php if($TotalProgress==100){?>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-outline-secondary fw-bold w-100" style="color: #212529">Certificate</button>
                                        </div>
                                        <?php }else{?>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-outline-secondary w-100 fs-16 " disabled>Certificate</button>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                                <!--End Course Card Body-->
                            </div>
                        <?php //}
                            // }
                            }
                        }
    // ===========incomplete purchased course ==================================================================
                        if($type =='incomplete' && !empty($purchase_course_incomplete)){
                        foreach($purchase_course_incomplete as $single_course){
                            $totalPurchaseCompleteLesson = $this->db->where('course_id',$single_course->product_id)->where('student_id', $user_id)->where('is_complete',1)->where('enterprise_id',$single_course->enterprise_id)->get('watch_time_tbl')->num_rows();
                            $totalPurchaseLesson = $this->db->where('course_id',$single_course->product_id)->where('enterprise_id',$single_course->enterprise_id)->get('lesson_tbl')->num_rows();
                            $totalPurchaseChapter = $this->db->where('course_id',$single_course->product_id)->where('enterprise_id',$single_course->enterprise_id)->get('section_tbl')->num_rows();

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
                            $textFilePerCalculation=$this->db->where('course_id',$single_course->product_id)->where('lesson_type !=',1)->where('enterprise_id',$single_course->enterprise_id)->get('lesson_tbl')->num_rows();
                            $completetextFile = $this->db->where('course_id',$single_course->product_id)->where('student_id', $user_id)->where('file_type',0)->where('is_complete',1)->where('enterprise_id',$enterprise_id)->get('watch_time_tbl')->num_rows();
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
                             
                        
                            // when one or multiple type of course is empty  
                            //  $Newpercent=1;
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

                             $TotalProgress=number_format($Lessonprogress+$quizPercentage+$assignment,1);
                            // $TotalProgress=number_format(($Filecomplete*$Newpercent)+($videoWatchPercentage*$Newpercent)+($quizPercentage*$Newpercent)+($assignment*$Newpercent),1);

                            // $TotalProgress=number_format($VideoAndFIle+$quizPercentage+25,1); //==Total % calculation
                            // if( $type =='incomplete'){
                           
                            ?>
                            <div class="course-card rounded-20 bg-white position-relative overflow-hidden shadow-none border">
                                <!--Start Course Image-->
                                <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $single_course->product_id); ?>"
                                    class="course-card_img">

                                    <img src="<?php echo base_url(html_escape(($single_course->picture) ? "$single_course->picture" : ''));?>"
                                        class="img-fluid w-100"  style="height:240px" alt="">
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
                                                            <span class="text-primary"><?php echo $completetotalassignment;?></span>/<?php echo $totalassignment;?> Assignment
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>&nbsp;&nbsp;<span class="text-primary"><?php echo count($quizComplete);?></span>/ <?php echo count($quizCount);?> Quiz</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--End Course Hints-->
                                    <div class="d-flex fw-bold justify-content-between mb-2">
                                        <div style="color: #1270ca;">Progress</div>
                                        <div style="color: #1270ca;font-size: 18px;"><?php echo  number_format($TotalProgress);?>% Completed</div>
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
                                                class="btn fs-16 fw-bold" style="background-color:#5475ff;color:#fff">Go To Course<i
                                                    data-feather="arrow-right" class="ms-2"></i></a>
                                            <?php }else{?>
                                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $single_course->product_id); ?>"
                                                class="btn fs-16 fw-bold" style="background-color:#B953FF;color:#fff">Start Now<i
                                                    data-feather="arrow-right" class="ms-2"></i></a>
                                            <?php }?>
                                        </div>
                                        <?php if($TotalProgress==100){?>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-outline-secondary fw-bold w-100" style="color: #212529">Certificate</button>
                                        </div>
                                        <?php }else{?>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-outline-secondary w-100 fs-16 " disabled>Certificate</button>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                                <!--End Course Card Body-->
                            </div>
                        <?php 
                         //}                    
                           }
                      }
                    ?>

                    <?php }?>


    <!-- ==== subscription course================== -->
               <?php if($enroller_type=='subscrition'){

                if($type =='completed' && !empty($subscription_course_complete)){
                foreach($subscription_course_complete as  $coursesubscription){
        
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
                $textFilePerCalculation=$this->db->where('course_id',$coursesubscription->course_id)->where('lesson_type !=',1)->where('enterprise_id',$enterprise_id)->get('lesson_tbl')->num_rows();
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
                 
                // // when one or multiple type of course is empty  
                //   $Newpercent=1;
                //   if(empty($quizCount) && empty($totalassignment) && empty($textFilePerCalculation)){
                //       $Newpercent=4;
                //   }else if(empty($quizCount) && empty($textFilePerCalculation)){
                //       $Newpercent=2;
                //   }else if(empty($quizCount) && empty($totalassignment)){
                //       $Newpercent=2;
                //   }else if(empty($totalassignment) && empty($textFilePerCalculation)){
                //       $Newpercent=2;
                //   }else{
                //       if(!empty($quizCount) && !empty($totalassignment) && !empty($textFilePerCalculation)){
                //           $Newpercent=1;
                //       }else{

                //           $Newpercent=1.333333333333;
                //       }
                //   }
                
                 //end
                 $TotalProgress=number_format($Lessonprogress+$quizPercentage+$assignment,1);
                // $TotalProgress=number_format(($Filecomplete*$Newpercent)+($videoWatchPercentage*$Newpercent)+($quizPercentage*$Newpercent)+($assignment*$Newpercent),1);

                
                // $TotalProgress=number_format($VideoAndFIle+$quizPercentage+25,1); //== total % calculation  
                // if( $type =='completed'){
                //     if( $TotalProgress =='100'){
                  //====complete subscription course==================
                ?>
                        <div class="course-card rounded-20 bg-white position-relative overflow-hidden shadow-none border">
                            <!--Start Course Image-->
                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $coursesubscription->course_id); ?>"
                                class="course-card_img">
                                <img src="<?php echo base_url(!empty(get_picturebyid($coursesubscription->course_id)->picture) ? get_picturebyid($coursesubscription->course_id)->picture : default_image()); ?>"
                                    class="img-fluid w-100"  style="height:240px" alt="">
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
                                            <td>&nbsp;&nbsp;<span
                                                    class="text-primary"><?php echo $totalSubCompleteLesson;?></span>
                                                /<?php echo $totalSubLesson; ?> Lessons</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-0">
                                                <div class="d-flex align-items-center">
                                                    <div class="course-card__hints--text">
                                                        <span class="text-primary"><?php echo $completetotalassignment?></span>/<?php echo  $totalassignment;?> Assignment
                                                    </div>
                                                </div>
                                            </td>
                                            <td>&nbsp;&nbsp;<span class="text-primary"><?php echo count($quizComplete);?></span>/ <?php echo count($quizCount);?> Quiz</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--End Course Hints-->
                                <div class="d-flex fw-bold justify-content-between mb-2">
                                    <div style="color: #1270ca;">Progress</div>
                                    <div style="color: #1270ca;font-size: 18px;"><?php echo number_format($TotalProgress);?>% Completed</div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped" role="progressbar"
                                        style="width:<?php echo number_format($TotalProgress);?>%"
                                        aria-valuenow="<?php echo number_format($TotalProgress);?>" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <div class="row g-2 mt-2 justify-content-between">
                                    <div class="col align-self-end">
                                        <?php if($TotalProgress==100){?>
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $coursesubscription->product_id); ?>"
                                            class="btn btn-danger fs-16 fw-bold">Completed<i data-feather="arrow-right"
                                                class="ms-2"></i></a>
                                        <?php }elseif($TotalProgress>0){?>
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $coursesubscription->product_id); ?>"
                                            class="btn fs-16 fw-bold" style="background-color:#5475ff;color:#fff">Go To Course<i
                                                data-feather="arrow-right" class="ms-2"></i></a>
                                        <?php }else{?>
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $coursesubscription->product_id); ?>"
                                            class="btn fs-16 fw-bold" style="background-color:#B953FF;color:#fff">Start Now<i
                                                data-feather="arrow-right" class="ms-2"></i></a>
                                        <?php }?>
                                    </div>
                                    <?php if($TotalProgress==100){?>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-outline-secondary fw-bold w-100" style="color: #212529">Certificate</button>
                                    </div>
                                    <?php }else{?>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-outline-secondary w-100 fs-16 " disabled>Certificate</button>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                            <!--End Course Card Body-->
                        </div>
                <?php }}
                // }}
                if($type =='incomplete' && !empty($subscription_course_incomplete)){
                //====incomplete subscription course==================
                foreach($subscription_course_incomplete as  $coursesubscription){
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
                $textFilePerCalculation=$this->db->where('course_id',$coursesubscription->course_id)->where('lesson_type !=',1)->where('enterprise_id',$enterprise_id)->get('lesson_tbl')->num_rows();
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
                 
                // // when one or multiple type of course is empty  
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
                // $TotalProgress=number_format($VideoAndFIle+$quizPercentage+25,1); //== total % calculation 
                // if( $type =='incomplete'){ 
                //     if($TotalProgress !='100'){
                ?>
                <div class="course-card rounded-20 bg-white position-relative overflow-hidden shadow-none border">
                    <!--Start Course Image-->
                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $coursesubscription->course_id); ?>"
                        class="course-card_img">
                        <img src="<?php echo base_url(!empty(get_picturebyid($coursesubscription->course_id)->picture) ? get_picturebyid($coursesubscription->course_id)->picture : default_image()); ?>"
                            class="img-fluid w-100"  style="height:240px" alt="">
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
                                    <td>&nbsp;&nbsp;<span
                                            class="text-primary"><?php echo $totalSubCompleteLesson;?></span>
                                        /<?php echo $totalSubLesson; ?> Lessons</td>
                                </tr>
                                <tr>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                            <div class="course-card__hints--text">
                                                <span class="text-primary"><?php echo $completetotalassignment;?></span>/<?php echo  $totalassignment;?> Assignment
                                            </div>
                                        </div>
                                    </td>
                                    <td>&nbsp;&nbsp;<span class="text-primary"><?php echo  count($quizComplete);?></span>/ <?php echo  count($quizCount);?> Quiz</td>
                                </tr>
                            </tbody>
                        </table>
                        <!--End Course Hints-->
                        <div class="d-flex fw-bold justify-content-between mb-2">
                            <div style="color: #1270ca;">Progress</div>
                            <div style="color: #1270ca;font-size: 18px;"><?php echo number_format($TotalProgress);?>% Completed</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped" role="progressbar"
                                style="width:<?php echo number_format($TotalProgress);?>%"
                                aria-valuenow="<?php echo number_format($TotalProgress);?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="row g-2 mt-2 justify-content-between">
                            <div class="col align-self-end">
                                <?php if($TotalProgress==100){?>
                                <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $coursesubscription->product_id); ?>"
                                    class="btn btn-danger fs-16 fw-bold">Completed<i data-feather="arrow-right"
                                        class="ms-2"></i></a>
                                <?php }elseif($TotalProgress>0){?>
                                <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $coursesubscription->product_id); ?>"
                                    class="btn fs-16 fw-bold" style="background-color:#5475ff;color:#fff">Go To Course<i
                                        data-feather="arrow-right" class="ms-2"></i></a>
                                <?php }else{?>
                                <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $coursesubscription->product_id); ?>"
                                    class="btn fs-16 fw-bold" style="background-color:#B953FF;color:#fff">Start Now<i
                                        data-feather="arrow-right" class="ms-2"></i></a>
                                <?php }?>
                            </div>
                            <?php if($TotalProgress==100){?>
                            <div class="col-auto">
                                <button type="button" class="btn btn-outline-secondary fw-bold w-100" style="color: #212529">Certificate</button>
                            </div>
                            <?php }else{?>
                            <div class="col-auto">
                                <button type="button" class="btn btn-outline-secondary w-100 fs-16 " disabled>Certificate</button>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                    <!--End Course Card Body-->
                </div>
                <?php }}
                //    }
               }
            ?>






                <!-- free course -->
                <?php //if($enroller_type=='subscrition' && !empty($purchase_course)){
                            //foreach($subscription_courses as  $coursesubscription){
                            
                          // if(){ //is_complete
                            //if(){  //progress
                        ?>
                       <?php //}}}?>
                <?php //}else{?>
                
                <?php //}?>
                </div>



                <!-- elseif($enroller_type=='purchased' && !empty($purchase_course) && ($type =='completed')){ -->