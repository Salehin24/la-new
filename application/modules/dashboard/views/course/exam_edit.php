<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="col-sm-12">
            <?php
            $error = $this->session->flashdata('error');
            $success = $this->session->flashdata('success');
            $file_uploaderror = $this->session->flashdata('file_uploaderror');
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
        <div class="card">
            <div class="card-header">
                <h4>
                    <?php echo html_escape((!empty($title) ? $title : null)); ?>
                    <small class="float-right">
                        <?php //if ($this->permission->check_label('question_list')->read()->access()) { ?>
                        <!-- <a href="<?php echo base_url(enterpriseinfo()->shortname . '/exam-list'); ?>"
                            class="btn btn-success text-white">
                            <?php echo 'Quiz List'; ?>
                        </a> -->
                        <?php //} ?>
                        <?php //if ($this->permission->check_label('question_list')->read()->access()) { ?>
                        <!-- <a href="<?php echo base_url(enterpriseinfo()->shortname . '/add-exam'); ?>"
                            class="btn btn-success">
                            <?php echo display('add_exam'); ?>
                        </a> -->
                        <?php //} ?>
                    </small>
                </h4>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart(enterpriseinfo()->shortname . '/exam-update', 'class="", id=""'); ?>
                <div class="row">
                    <div class="form-group col-sm-5">
                        <label for="name" class="col-sm-4"><?php echo display('name') ?> <i class="text-danger"> *
                            </i></label>
                        <div class="col-sm-9">
                            <input type='hidden' name='course_id' id="course_id" value='<?php echo $course_id; ?>'>
                            <input type='hidden' name='assign_id' id="assign_id" value='<?php echo $assign_id; ?>'>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="<?php echo display('name'); ?>"
                                value="<?php echo (!empty($get_exameditdata->name) ? $get_exameditdata->name : ''); ?>"
                                required>
                        </div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="pass_mark" class="col-sm-4">Pass Score <i class="text-danger"> *
                            </i></label>
                        <div class="col-sm-9">
                            <input type="number" name="pass_mark" id="pass_mark" class="form-control"
                                placeholder="Pass Score"
                                value="<?php echo (!empty($get_exameditdata->pass_mark) ? $get_exameditdata->pass_mark : ''); ?>"
                                onkeyup="getpassscorecheck(this.value)" required>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="question_mark" class="col-sm-3">&nbsp</label>
                        <div class="col-sm-9">
                            <!-- <button id="add-question-item" class="btn btn-info btn-sm" name="add-question-item"
                                onclick="addQuestionsection('addQuestionItem')" type="button"
                                style="margin: 0px 15px 15px;"><i class="fa fa-plus"> </i> Add Question</button> -->
                            <div class="sticky" style="position: static; top: 0px; z-index: 1; right: 112px;">
                                <button id="add-question-item" class="btn btn-info btn-sm" name="add-question-item"
                                    onclick="addQusetionModal('<?php echo $get_exameditdata->exam_id; ?>','edit')"
                                    type="button" style="margin: 0px 15px 15px;"><i class="fa fa-plus"> </i> Add
                                    Question</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <div id="totalquestiondiv">
                    <?php 
                    $sl=0;
                    foreach($get_examwisequestion as $questiondiv){ 
                        $get_questionwiseoption = get_questionwiseoption($questiondiv->question_id);
                        $sl++;
                        ?>
                    <div class="questionSection_<?php echo $sl; ?>">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="question_type" class="col-sm-5"><?php echo display('question_type'); ?> <i
                                        class="text-danger"> * </i></label>
                                <div class="col-sm-9">
                                    <select class="form-control placeholder-single" name="question_type[]"
                                        id="question_type" onchange="loadquestiondata(this.value, '<?php echo $sl; ?>')"
                                        required>
                                        <option value=""><?php echo display('select_one'); ?></option>
                                        <option value="1"
                                            <?php echo (($questiondiv->question_type == 1) ? 'selected' : ''); ?>>
                                            True/False</option>
                                        <option value="2"
                                            <?php echo (($questiondiv->question_type == 2) ? 'selected' : ''); ?>>
                                            Multiple Answer</option>
                                        <option value="3"
                                            <?php echo (($questiondiv->question_type == 3) ? 'selected' : ''); ?>>
                                            <?php echo display('short_answer'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="question_mark_<?php echo $sl; ?>" class="col-sm-4"><?php echo display('question_mark') ?> <i
                                        class="text-danger"> * </i></label>
                                <div class="col-sm-9">
                                    <input type="number" min="1" name="question_mark[]" id="question_mark_<?php echo $sl; ?>"
                                        class="form-control" onkeyup="questionmarktwodigit(this.value, <?php echo $sl; ?>)" placeholder="<?php echo display('question_mark'); ?>"
                                        value="<?php echo (!empty($questiondiv->question_mark) ? $questiondiv->question_mark : ''); ?>"
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="question_mark" class="col-sm-3">&nbsp</label>
                                <div class="col-sm-9">
                                    <button id="" class="btn btn-sm btn-danger" name=""
                                        onclick="deleteQuestion(this,'<?php echo $sl; ?>')" type="button"
                                        style="margin: 0px 15px 15px;">Delete Question</button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="question" class="col-sm-4"><strong><?php echo display('question') ?>
                                        <?php echo $sl; ?></strong></label>
                                <div class="col-sm-12">
                                    <textarea name="question[]" id="question" class="form-control" rows="1" cols="80"
                                        required><?php echo (!empty($questiondiv->name) ? $questiondiv->name : ''); ?></textarea>
                                    <!-- /.Ck Editor -->
                                    <input type="hidden" id="qst_editor" value="1">
                                    <input type="hidden" id="qst_count_<?php echo $sl; ?>" value="<?php echo $sl; ?>">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <!-- <input type="text" value="1" id="ansCountNumber_1"> -->
                            <div class="loaddata_<?php echo $sl; ?> col-sm-12 w-100p">
                                <?php if($questiondiv->question_type == 1){ ?>

                                <table class="table table-bordered" id="examTable_<?php echo $sl; ?>">
                                    <thead>
                                        <tr>
                                            <th width="50%" class="text-center">Option</th>
                                            <th width="30%" class="text-center">Is Answer</th>
                                        </tr>
                                    </thead>
                                    <tbody id="addrowItem_<?php echo $sl; ?>">
                                        <?php 
                                    $o=0;
                                    foreach($get_questionwiseoption as $option){
                                        $o++;
                                ?>
                                        <tr>
                                            <td class="text-right">
                                                <div class="">
                                                    <textarea name="question_<?php echo $sl; ?>_option[]"
                                                        class="form-control option_editor" id="option_editor"
                                                        <?php echo (($questiondiv->question_type == 1) ? 'readonly' : ''); ?>><?php echo (!empty($option->option_name) ? $option->option_name : ''); ?></textarea>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                            <!-- checkbox checkbox-success -->
                                                <div class="offset-2 ">
                                                    <input id="is_answer_<?php echo $sl; ?>_<?php echo $o; ?>"
                                                        name="question_<?php echo $sl; ?>_is_answer[]" type="radio"
                                                        value="<?php echo $option->is_answer; ?>"
                                                        <?php echo (($option->is_answer == 1) ? 'checked' : ''); ?>
                                                        onclick="isAnswerRadio('<?php echo $sl; ?>','<?php echo $o; ?>')">
                                                    <label for="is_answer_<?php echo $sl; ?>_<?php echo $o; ?>">Is
                                                        Answer</label>
                                                </div>
                                                <input type="hidden" name="question_<?php echo $sl; ?>_hdn_isans[]"
                                                    value="<?php echo $option->is_answer; ?>"
                                                    id="hdn_isans_<?php echo $sl; ?>_<?php echo $o; ?>">
                                            </td>
                                            
                                        </tr>
                                        <?php } ?>
     
                                    </tbody>
                                </table>
                         <?php }else if($questiondiv->question_type == 2){?>
                                
                            <?php 
                            //if($questiondiv->question_type == 2){ 
                            
                            ?>
                                <button id="add-invoice-item" class="btn btn-info btn-sm" name="add-new-item"
                                    onclick="addInputField('addrowItem_<?php echo $sl; ?>',<?php echo $sl; ?>)"
                                    type="button" style="margin: 0px 15px 15px; float : right; "><i class="fa fa-plus">
                                    </i>
                                    Add Option</button>
                            <?php //} ?>
                                <table class="table table-bordered" id="examTable_<?php echo $sl; ?>">
                                    <thead>
                                        <tr>
                                            <th width="50%" class="text-center">Option</th>
                                            <th width="30%" class="text-center">Is Answer</th>
                                            <?php //if($questiondiv->question_type == 2){ ?>
                                            <th width="10%" class="text-center">Action </th>
                                            <?php //} ?>
                                        </tr>
                                    </thead>
                                    <tbody id="addrowItem_<?php echo $sl; ?>">
                                        <?php 
                                    $o=0;
                                    foreach($get_questionwiseoption as $option){
                                        $o++;
                                ?>
                                        <tr>
                                            <td class="text-right">
                                                <div class="">
                                                    <textarea name="question_<?php echo $sl; ?>_option[]"
                                                        class="form-control option_editor" id="option_editor"
                                                        <?php echo (($questiondiv->question_type == 1) ? 'readonly' : ''); ?>><?php echo (!empty($option->option_name) ? $option->option_name : ''); ?></textarea>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="offset-2 checkbox checkbox-success">
                                                    <input id="is_answer_<?php echo $sl; ?>_<?php echo $o; ?>"
                                                        name="question_<?php echo $sl; ?>_is_answer[]" type="checkbox"
                                                        value="<?php echo $option->is_answer; ?>"
                                                        <?php echo (($option->is_answer == 1) ? 'checked' : ''); ?>
                                                        onclick="isAnswer('<?php echo $sl; ?>','<?php echo $o; ?>')">
                                                    <label for="is_answer_<?php echo $sl; ?>_<?php echo $o; ?>">Is
                                                        Answer</label>
                                                </div>
                                                <input type="hidden" name="question_<?php echo $sl; ?>_hdn_isans[]"
                                                    value="<?php echo $option->is_answer; ?>"
                                                    id="hdn_isans_<?php echo $sl; ?>_<?php echo $o; ?>">
                                            </td>
                                            <?php //if($questiondiv->question_type == 2){ ?>
                                            <td class="text-center">
                                                <!-- <button id="add-invoice-item" class="btn btn-info btn-sm"
                                                name="add-new-item" onclick="addInputField('+item+" ,"+sl+')"
                                                type="button" style="margin: 0px 15px 15px;"><i class="fa fa-plus"> </i>
                                                Add Option</button> -->
                                                <button style='text-align: right;' class='btn btn-sm btn-danger'
                                                    type='button' onclick='deleteRow(this)'><i class='fa fa-minus'>
                                                    </i></button>
                                            </td>
                                            <?php //} ?>
                                        </tr>
                                        <?php } ?>
                                        <!-- <tr>
                                        <th colspan="3" class="text-right">
                                               
                                        </th>
                                    </tr> -->
                                    </tbody>
                                </table>
                                <?php }else{ ?>
                                <div class="form-group col-sm-12">
                                    <label for="shortanswer" class="col-sm-4">Short Answer</label>
                                    <div class="col-sm-12">
                                        <textarea name="shortanswer[]" id="shortanswer" class="form-control shortanswer"
                                            rows="5" cols="80"
                                            required><?php echo (!empty($questiondiv->shortanswer) ? $questiondiv->shortanswer : ''); ?></textarea>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <?php } ?>
                </div>

                <!-- <div clas -->

                <div class="form-group text-right">
                    <input type="hidden" name="exam_id" id="exam_id" value="<?php echo $get_exameditdata->exam_id; ?>">
                    <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="modal_info" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal_ttl"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="info">

            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/course.js') ?>"></script>