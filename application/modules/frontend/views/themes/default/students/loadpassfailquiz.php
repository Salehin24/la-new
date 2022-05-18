<?php //dd($get_allcourseexams); ?>


<?php 
                                     //d($get_allcourseexams);
                                    $q=0;
                                    if($get_allcourseexams){
                                    foreach($get_allcourseexams as $courseexam){
                                        $q++;
                                        // $get_examresults = $this->Frontend_model->get_examresults($courseexam->customer_id, $courseexam->course_id, $courseexam->exam_id);
                                        // d($get_examresults);
                                                                                    
                                        //            ===================
                                        $exam_set = json_decode($courseexam->exam_set);
                                        $questionmarks = json_decode($courseexam->questionmarks);

                                        $qst_count = $marks = $givennotans = $givenmcqqstcount = $shortqstcount = 0;
                                        $givenoption_array = array();

                                        foreach ($exam_set as $single) {
                                            $question_info = $this->Frontend_model->get_questionedit($single->question_id);
                                            $qst_count += 1;
                                            $marks += $question_info->question_mark;

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
                                                    if($question_info->shortanswer == $sing->shortanswers){
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
                                        
                                    ?>

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
            <?php if($courseexam->is_done != 1){ ?>
            <button type="button" class="btn btn-sm btn-success"
                onclick="examDonestatus('<?php echo $courseexam->questionexam_id?>')">Done</button>
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
                    <!-- <th>Status</th> -->
                    <th>Score</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th><?php echo $courseexam->total_question; ?>/<?php echo $courseexam->total_answered; ?>
                    </th>
                    <td>
                        <?php echo $rightans;  ?>
                    </td>
                    <td>
                        <?php echo $wrong_ans; ?>
                    </td>
                    <td>
                        <?php echo $ttl_unanswered = $courseexam->total_question-$courseexam->total_answered; ?>
                    </td>
                    <td><?php echo $courseexam->duration; ?></td>
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
                            <div class="progress-bar bg-success" style="width:<?php echo $correct_statusbar*100; ?>%">
                                <!-- Success -->
                            </div>
                            <div class="progress-bar bg-danger" style="width:<?php echo $wrong_statusbar*100; ?>%">
                                <!-- Warning -->
                            </div>
                            <div class="progress-bar bg-hash" style="width:<?php echo $unanswered_statusbar*100; ?>%">
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
                        
                            <?php 
                                                         if($obtainedmarks >= $courseexam->pass_mark){
                                                            //  echo 'Passes';
                                                             echo '<span class="badge bg-success">Passes</span>';
                                                         }else{
                                                            //  echo 'Failed';
                                                            echo '<span class="badge bg-danger">Failed</span>';
                                                         }; ?>
                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php }   
}else{
    echo '<p class="text-danger">No quiz in your current courses</p>';
}  ?>