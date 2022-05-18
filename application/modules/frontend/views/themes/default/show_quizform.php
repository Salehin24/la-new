<?php
date_default_timezone_set('Asia/Dhaka');
$course_id = $get_coursedetails->course_id;
$session_id = $this->session->userdata('session_id');
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
$name = $this->session->userdata('name');
$fullname = $this->session->userdata('fullname');
$name = (($name) ? "$name" : "$fullname");
$email = $this->session->userdata('email');
$enterprise_id = $enterprise_id;
$segment3 = $this->uri->segment(3);
// dd($segment3);
//echo $course_id." ". $session_id. " ". $user_type ." ". $user_id ." ".$name. " ". $fullname. " ".$email;die();
?>
<style type="text/css">
/*=========== its for pagination start ==========*/
/*Sample CSS used for the Virtual Pagination Demos. Modify/ remove as desired*/
.paginationstyle {
    /*Style for demo pagination divs*/
    width: 250px;
    text-align: center;
    padding: 2px 0;
    margin: 10px 0;
}
.paginationstyle select {
    /*Style for demo pagination divs' select menu*/
    border: 1px solid navy;
    margin: 0 15px;
}

.paginationstyle a {
    /*Pagination links style*/
    padding: 0 5px;
    text-decoration: none;
    border: 1px solid black;
    color: navy;
    background-color: white;
}

.paginationstyle a:hover,
.paginationstyle a.selected {
    color: #000;
    background-color: #FEE496;
}

.paginationstyle a.disabled,
.paginationstyle a.disabled:hover {
    /*Style for "disabled" previous or next link*/
    background-color: white;
    cursor: default;
    color: #929292;
    border-color: transparent;
}

.paginationstyle a.imglinks {
    /*Pagination Image links style (class="imglinks") */
    border: 0;
    padding: 0;
}

.paginationstyle a.imglinks img {
    vertical-align: bottom;
    border: 0;
}

.paginationstyle a.imglinks a:hover {
    background: none;
}

.paginationstyle .flatview a:hover,
.paginationstyle .flatview a.selected {
    /*Pagination div "flatview" links style*/
    color: #000;
    background-color: yellow;
}

/*=========== close pagination =======*/
.unselectable {
    -webkit-user-select: none;
    -webkit-touch-callout: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.mc_que p {
    margin-bottom: 0;
    margin-left: 12px;
}

.showpause_btn,
.showpause_btn:focus,
.showpause_btn:active,
.showpause_btn:visited,
.showpause_btn:hover {
    background-color: transparent;
    box-shadow: none;
}
</style>
<div class="bg-alice-blue py-3 pt-md-0 pb-md-5">
    <div class="container-xxl custom-content">
        <div class="row g-1">
            <div class="col-md-12 sticky-content">
                <!--Start card-->
                <?php echo form_open_multipart($enterprise_shortname . '/exam-submit', '') ?>
                <input type="hidden" name="course_id" id="course_id"
                    value="<?php echo html_escape($get_coursedetails->course_id); ?>">
                <input type="hidden" name="student_id" id="student_id" value="<?php echo $user_id; ?>">
                <input type="hidden" name="exam_id" id="exam_id" value="<?php echo $get_examwisequestion[0]->exam_id; ?>">
                <input type="hidden" name="full_duration" id="full_duration"
                    value="<?php //echo html_escape(!empty($get_packageinfo->time_duration) ? convertToHoursMins($get_packageinfo->time_duration) : ''); ?>">
                <input type="hidden" name="duration" id="duration" value="">
                <input type="hidden" id="enterprise_shortname" name="enterprise_shortname"
                    value="<?php echo html_escape($enterprise_shortname); ?>">
                <input type="hidden" id="enterprise_id" name="enterprise_id"
                    value="<?php echo html_escape($enterprise_id); ?>">
                <input type="hidden" id="total_question" name="total_question"
                    value="<?php echo html_escape($qst_count); ?>">
                <input type="hidden" id="fullmarks" name="fullmarks" value="<?php echo html_escape($marks); ?>">
                <input type="hidden" id="packagetype" name="packagetype"
                    value="1">
                <input type="hidden" id="instant_result" name="instant_result"
                    value="<?php //echo html_escape($get_packageinfo->instant_result); ?>">
                <input type="hidden" id="confirmation_message" name="confirmation_message"
                    value="<?php echo 'Exam submit successfully done!'; ?>">
                <input type="hidden" id="examstarttime" name="examstarttime" value="<?php echo date('Y-m-d H:i:s'); ?>">
                <div class="card border-0 rounded-0 shadow-sm strest">
                    <div class="card-body p-4 p-xl-5">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 loadcontent">
                                <!--Start Section Header-->
                                
                                <div class="section-header mb-4">
                                    <h4 class="h5 text-primary">Question 1-<?php echo count($get_examwisequestion); ?></h4>
                                </div>
                                <?php //d($get_examwisequestion); ?>
                                <!--End Section Header-->
                                <?php 
                                $sl = 0;
                                foreach($get_examwisequestion as $question){
                                    $get_questionwiseoption = get_questionwiseoption($question->question_id);
                                    $sl++;
                                     ?>
                                <div class="mb-4 virtualpage hidepiece">
                                    <h6 class="mb-3">
                                        <span class="">Q-<?php echo $sl; ?> :</span>
                                        <?php echo $question->name; ?>
                                    </h6>
                                    <input type="hidden" name="question_id[]" id="question_id" value="<?php echo $question->question_id; ?>">
                                    <input type="hidden" name="question_type[]" id="question_type" value="<?php echo $question->question_type; ?>">
                                    <?php
                                        if ($question->question_type == 1) {
                                        //d(get_answername($question->question_id)); 
                                    ?>
                                    <input type="hidden" class="form-control" name="shortanswer[]" value="">
                                    <div class="ms-3">
                                        <?php foreach($get_questionwiseoption as $option){ ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="q_<?php echo $question->question_id; ?>_option_id[]" value="<?php echo $option->option_id; ?>"
                                                id="<?php echo $option->option_id; ?>" >
                                            <label class="form-check-label" for="<?php echo $option->option_id; ?>">
                                                <?php echo (!empty($option->option_name) ? $option->option_name : ''); ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <hr>
                                    <?php } ?>

                                    <?php
                                        if ($question->question_type == 2) {
                                    ?>
                                    <input type="hidden" class="form-control" name="shortanswer[]" value="">

                                    <div class="ms-3">
                                        <?php foreach($get_questionwiseoption as $option){ ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="q_<?php echo html_escape($question->question_id); ?>_option_id[]" value="<?php echo html_escape($option->option_id); ?>"
                                                id="<?php echo html_escape($option->option_id); ?>">
                                            <label class="form-check-label" for="<?php echo html_escape($option->option_id); ?>">
                                                <?php echo (!empty($option->option_name) ? $option->option_name : ''); ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                       
                                    </div>
                                    <hr>
                                    <?php } ?>

                                    <?php if ($question->question_type == 3) {?>
                                    <div class="ms-3">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <textarea class="form-control" name="shortanswer[]" placeholder="Your Answer" rows="2"
                                                    cols="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between border-top-0 p-3">
                        <!-- <div>
                            Question 1 0f 10
                        </div> -->
                        <div id="gallerypaginate" class="paginationstyle">
                            <a href="#" rel="previous">Prev</a> <span class="flatview"></span> <a href="#"
                                rel="next">Next</a>
                        </div>

                        <?php //if ($qst_count == $sl) { ?>
                            
                        <div class="d-flex offset-sm-5">
                            <!-- <a href="<?php echo base_url($enterprise_shortname. '/course-details/'.$segment3 ); ?>" class="btn btn-danger btn-sm" style="margin-right:5px;"> Back </a> -->
                            <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-danger btn-sm" style="margin-right:5px;"> Back </a>
                            <button type="submit"
                                class="btn btn-dark-cerulean"><?php //echo $qst_count.' s '. $sl; ?><?php echo display('submit'); ?>
                            </button>
                        </div>
                        <?php //} ?>
                        <div>
                            <!-- <a href="#" id="panel-fullscreens" role="button" title="Toggle fullscreen"><i
                                    class="fas fa-expand"></i></a> -->
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
                <!--End card-->

            </div>


            
        </div>
    </div>
</div>


<?php 
$obtainedmarks = 0;
    if($get_examresultinfo){    
        // d($get_examresultinfo);                         
        //   ===================
        $exam_set = json_decode($get_examresultinfo->exam_set);
        $questionmarks = json_decode($get_examresultinfo->questionmarks);
       
        // d($get_examresultinfo->exam_set);
        $qst_count = $marks = $givennotans = $givenmcqqstcount = $shortqstcount = 0;
        $givenoption_array = array();

        foreach ($exam_set as $single) {
            $question_info = $this->Frontend_model->get_questionedit($single->question_id);
            $qst_count += 1;
            $marks += (!empty($question_info->question_mark) ? $question_info->question_mark : 0);

            // if ($single->given_ans == NULL && $single->shortanswers == '') {
            //     $givennotans += 1;
            // }

            // if ($single->given_ans) {
            //     $givenmcqqstcount += 1;
            // }
            // if ($single->shortanswers) {
            //     $shortqstcount += 1;
            // }

            $givenoption_array[] = $single->given_ans;
            $givenoption_array[] = $single->question_type;
        }

        // if ($questionmarks) {
        //     $questionid_array = array();
        //     $questionmark_array = array();
        //     foreach ($questionmarks as $qstmarks) {
        //         $questionid_array[] = $qstmarks->question_id;
        //         $questionmark_array[] = $qstmarks->marks;
        //     }
        //     $data['questionmarks_combinedarr'] = array_combine($questionid_array, $questionmark_array);
        // }

        $data['marks'] = $marks;
        $data['qst_count'] = $qst_count;

        $radio_right = 0;
        $checkbox_right = 0;
        $shortans_right = 0;
        $checkbox_correctcount = 0;
        $radio_correctcount = 0;
        $shortqst_correctcount = 0;

        foreach ($exam_set as $sing) {
            $question_info = $this->Frontend_model->get_questionedit($sing->question_id);
            $get_questionwiseoption = get_questionwiseoption($sing->question_id);
            // d($givenoption_array);
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
            }
        }

        $totalcorrectans_count = $checkbox_correctcount + $radio_correctcount + $shortqst_correctcount;
        $totalrightans_marks = $checkbox_right + $radio_right + $shortans_right;
        // d($checkbox_right);
        // d($radio_right);
        // dd($shortans_right);
//            ============= right ans ===========
        $correctans = $totalcorrectans_count;
        $rightans = (!empty($correctans) ? $correctans : 0);
        //            ============= right ans ===========

//          ============== wrong ans ============
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
<?php 
$course_id = $this->session->userdata('course_id');
$passmarks = (!empty($get_examresultinfo->pass_mark) ? $get_examresultinfo->pass_mark : 0);
// echo 'OB Marks '. $obtainedmarks . ' And Pass Mark '. $passmarks. ' course id '.$course_id;

if($obtainedmarks >= $passmarks){  ?>
    <input type="hidden" id="result_status" value="Passed">
 <?php }else{ ?>
    <input type="hidden" id="result_status" value="Failed">
 <?php }  ?>



<script>
var gallery = new virtualpaginate({
    piececlass: "virtualpage", //class of container for each piece of content
    piececontainer: 'div', //container element type (ie: "div", "p" etc)
    pieces_per_page: <?php echo 20; ?>, //Pieces of content to show per page (1=1 piece, 2=2 pieces etc)
    defaultpage: 0, //Default page selected (0=1st page, 1=2nd page etc). Persistence if enabled overrides this setting.
    persist: false, //Remember last viewed page and recall it when user returns within a browser session?
    wraparound: false,
})
gallery.buildpagination(["gallerypaginate", "gallerypaginate2"]);

</script>
<script>
    $(document).ready(function() {
    var activity_segment = $("#segment5").val();
    var course_id = '<?php echo $course_id; ?>';
    
    if (activity_segment.substring(0, 2) == "QE") {
       var result_status = $("#result_status").val();
    // alert(result_status);return false;
       if(result_status == 'Passed'){
        swal({
                title: "Congratulation !! ",
                text: "You have passed with <?php echo (!empty($obtainedmarks) ? $obtainedmarks : ''); ?> marks",
                type: "success",
                showCancelButton: false,
                confirmButtonColor: '#14AD54',
                confirmButtonText: 'OK',
                // cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    location.replace(base_url + enterprise_shortname + '/course-details/'+course_id+'/1');
                }
            });
       }else if(result_status == 'Failed'){
        swal({
                title: "You have failed.",
                text: "You need to obtain <?php echo (!empty($get_examresultinfo->pass_mark) ? $get_examresultinfo->pass_mark : ''); ?> marks to pass.You have obtain <?php echo (!empty($obtainedmarks) ? $obtainedmarks : ''); ?> marks.  Don't worry, You can try again later.",
                type: "error",
                showCancelButton: false,
                confirmButtonColor: '#14AD54',
                confirmButtonText: 'OK',
                // cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    location.replace(base_url + enterprise_shortname + '/course-details/'+course_id);
                }
            });
       }
    }
});
    </script>