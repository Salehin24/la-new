<div class="col-lg-8">
    <?php 
        $sl = 0;
        $radio_right = 0;
        $checkbox_right = 0;
        $checkbox_correctcount = 0;
        $radio_correctcount = 0;
        $shortqst_correctcount = 0;
        foreach($get_examwisequestion as $question){
            $question_info = $this->Frontend_model->get_questionedit($question->question_id);
            $get_questionwiseoption = get_questionwiseoption($question->question_id);
            $sl++;
                ?>
    <div class="mb-4">
        <h6 class="mb-3"><span class="">Q-<?php echo $sl; ?> :</span>
            <?php echo (!empty($question->name) ? $question->name : ''); ?>
        </h6>
        <?php if($question->question_type == 1){ 
            $correctans_color = 'style="color: red;"';
            $answer_name = get_answername($question->question_id);
            ?>
        <div class="ms-3">
            <?php 
            $op = 0;
            foreach($get_questionwiseoption as $option){
                $op++;
                $one_style = '';
                foreach ($givenoption_array as $given) {
                    if ($given == $option->option_id && $option->is_answer == 1) {
                        $one_style = '<i class="far fa-check-circle right-ans"></i>';
                        $correctans_color = 'style="color: #02a702;"';
                    } elseif ($given == $option->option_id) {
                        $one_style = '<i class="far fa-check-circle right-ans"></i>';
                    }
                }
                ?>
            <div class="form-check">
                <?php echo $op.' . '; ?>
                <label class="form-check-label" for="flexCheckDefault01">
                    <?php echo (!empty($option->option_name) ? $option->option_name : ''); ?>
                    <?php echo $one_style; ?>
                </label>
            </div>
            <?php } ?>
            <div class="answer_area" <?php echo $correctans_color; ?>>
                <?php echo display('correct_answer'); ?> :
                <?php
                                                    foreach ($answer_name as $ans) {
                                                        $ans = $ans->option_name . ', ';
                                                        echo ' ' . rtrim($ans, ", ");
                                                    }
                                                    ?>
            </div>
        </div>
        <hr>
        <?php } ?>
        <?php if($question->question_type == 2){
            $checkboxcorrectans_color = 'style="color: red;"';
            $answer_name = get_answername($question->question_id);
            ?>
        <div class="ms-3">
            <?php 
            $op = 0;
            foreach($get_questionwiseoption as $option){
                $op++;
                if ($question->question_id == $option->question_id) {
                    $givenans = '';
                    $two_style = '';
                    foreach ($exam_set as $given) {
                        if ($given->question_type == 2 && $option->question_id == $given->question_id) {
                            $givenans .= $given->given_ans;
                            $two_style = '<i class="far fa-check-circle right-ans"></i>'; //'style="color: green;"';
                            $explode_data = explode(',', $given->given_ans);
                ?>
            <div class="form-check">
                <?php echo $op.' . '; ?>
                <label class="form-check-label" for="flexCheckDefault05">
                    <?php echo (!empty($option->option_name) ? $option->option_name : ''); ?>
                    <?php
                        if (in_array($option->option_id, $explode_data)) {
                            echo $two_style;
                        }
                    ?>
                </label>
                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
            </div>
            <?php } ?>


            <?php
                $checkbox_ans = '';
                $checkbox_anschk = '';
                foreach ($answer_name as $ans) {
                $checkbox_ans .= $ans->option_name . ', ';
                $checkbox_anschk .= $ans->option_id . ',';
                }
                if ($givenans == rtrim($checkbox_anschk, ", ")) {
                $checkboxcorrectans_color = 'style="color: #02a702;"';
                $checkbox_right += $question_info->question_mark;
                $checkbox_correctcount += 1;
                }
                ?>
            <div class="answer_area" <?php echo $checkboxcorrectans_color; ?>>
                <?php echo display('correct_answer'); ?> :
                <?php
                                                    echo "" . rtrim($checkbox_ans, ", ");
                                                    ?>
            </div>
        </div>
        <hr>
        <?php } ?>
        <?php if($question->question_type == 3){
            foreach ($exam_set as $shortans) {
                if ($shortans->question_type == 3 && $question->question_id == $shortans->question_id) {
                    ?>
        <div class="ms-3">
            <div class="row">
                <div class="col-md-7">
                    <p> <?php echo html_escape($shortans->shortanswers); ?> </p>
                </div>
            </div>
        </div>
        <?php }}} ?>
    </div>
    <?php }?>
</div>