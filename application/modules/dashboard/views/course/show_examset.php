<script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML' async></script>
<style>
    .mc_que {
        font-size: 20px;
        color: #2b2b2b;
        font-weight: 600;
        text-transform: capitalize;
        display: flex;
        align-items: center;
        margin-bottom: 13px;
    }
    .mc_que p{
        margin-bottom: 0;
    }
    .mc_que span{
        margin-right: 5px;
    }
    .mc_options {
        max-width: 75%;
        display: block;
        margin-bottom: 25px;
    }
    .mc_options .opt{
        margin: 8px 0;
        /* display: inline-block; */
        width: 49%;
        padding-left: 0;
    }
    .opt p{
        display: inline-block;
        margin-bottom: 0;
    }
    .opt i{
        color: green;
        font-size: 20px;
    }
    .answer_area{
        color: green;
        font-size: 18px;
    }
    .answer_area p {
        display: inline-block;
    }
    .mc_options label {
        position: relative;
        display: inline-block;
        padding: 3px 3px 3px 28px;
        font-weight: 400;
    }
    .toggle-on.btn {
        padding-right: 1rem;
    }
    .custommarks{
        text-align: right;
        font-weight: 800;
        margin-top: 10px;
    }
</style>
<div class="body-content">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-12 col-xl-12">

            <!--/.End of header-->
            <div class="card card-body">
                <div class="row">
                    <div class="col-12">
                        <center>
                            <h3 class="header-title fs-25 font-weight-400 m-b-10">
                                <?php echo display('exam_name'); ?> :
                                <?php echo html_escape('Exam Name'); ?>
                            </h3>
                            <h6>
                                <?php //echo display('exam_time'); ?> :  <?php //echo html_escape($get_examinfo->start_date) . " - " . html_escape($get_packageinfo->end_date); ?>
                            </h6>
                            <h6>
                                <?php echo display('pass_mark'); ?> :  <?php echo html_escape($get_examinfo->pass_mark); ?>
                            </h6>
                        </center>
                    </div>
                    <hr><br>
                    <?php  //d($get_examinfo); ?>
                    <div class="col-12">
                        <div class="row">
                            <?php
                            $a = 0;
                            foreach ($get_examwisequestion as $single) {
                                $a++;
                                $question_info = $this->Course_model->get_questioninfo(html_escape($single->question_id));
                                $get_questionwiseoption = get_questionwiseoption(html_escape($single->question_id));
                                ?>
                                <div class="col-md-10">
                                    <div class="mc_que">
                                        <span><?php echo $a; ?>. </span> <?php echo (!empty(($question_info->name)) ? ($question_info->name) : ''); //. ' ID ' . $question_info->question_id;                                       ?>
                                    </div>
                                    <div class="mc_options">
                                        <div class="">
                                            <?php
                                            if ($single->question_type == 1) {
                                                $answer_name = get_answername(html_escape($single->question_id));
                                                $b = 0;
                                                foreach ($get_questionwiseoption as $option) {
                                                    $b++;
                                                    ?>
                                                    <div class="opt">
                                                        <span><?php echo $b . " . "; ?></span><?php echo ($option->option_name); ?>
                                                    </div>
                                                <?php } ?>
                                                <div class="answer_area">
                                                    <?php echo display('correct_answer'); ?> :
                                                    <?php
                                                    foreach ($answer_name as $ans) {
                                                        $ans = ($ans->option_name) . ', ';
                                                        echo ' ' . rtrim(($ans), ", ");
                                                    }
                                                    ?>
                                                </div>
                                                <?php //if ($question_info->isanswer_feedback == 1) { ?>
                                                    <!-- <div class="answer_feedback">
                                                        <?php echo display('answer_feedback'); ?> : <?php echo html_escape($question_info->answer_feedback); ?>
                                                    </div> -->
                                                <?php //} ?>
                                                <?php
                                            }
                                            if ($single->question_type == 2) {
                                                $answer_name = get_answername(html_escape($single->question_id));
                                                ?>
                                                <?php
                                                $c = '';
                                                foreach ($get_questionwiseoption as $option) {
                                                    $c++;
                                                    if ($single->question_id == $option->question_id) {
                                                        ?>
                                                        <div class="opt">
                                                            <span><?php echo $c . " . "; ?></span> <?php echo ($option->option_name); ?>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                }
                                                $checkbox_ans = '';
                                                foreach ($answer_name as $ans) {
                                                    $checkbox_ans .= $ans->option_name . ', ';
                                                }
                                                ?>
                                                <div class="answer_area">
                                                    <?php echo display('correct_answer'); ?> : 
                                                    <?php
                                                    echo "" . rtrim(($checkbox_ans), ", ");
                                                    ?>
                                                </div>
                                                <?php //if ($question_info->isanswer_feedback == 1) { ?>
                                                    <!-- <div class="answer_feedback">
                                                        <?php echo display('answer_feedback'); ?> : <?php echo ($question_info->answer_feedback); ?>
                                                    </div> -->
                                                <?php //} ?>
                                            <?php } ?>
                                            <?php
                                            if ($single->question_type == 3) {
                                                ?>
                                                <p>
                                                    <?php echo ($question_info->shortanswer); ?>
                                                </p>
                                                <?php //if ($question_info->isanswer_feedback == 1) { ?>
                                                    <!-- <div class="answer_feedback">
                                                        <?php //echo display('answer_feedback'); ?> :  <?php //echo ($question_info->answer_feedback); ?>
                                                    </div> -->
                                                <?php //} ?>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <strong class="float-right"><?php echo (!empty($question_info->question_mark) ? html_escape($question_info->question_mark) : ''); ?></strong>
                                </div>
                            <?php } ?>

                        </div>
                        <hr class="my-5">


                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/.body content-->
<script src="<?php //echo base_url('application/modules/dashboard/assets/js/package.js'); ?>"></script>