<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="col-sm-12">
            <?php
            $segment3 = $this->uri->segment(3);
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
                            class="btn btn-success">
                            Quiz List
                        </a> -->
                        <?php //} ?>
                    </small>
                </h4>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart(enterpriseinfo()->shortname . '/exam-save', 'class="", id=""'); ?>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="chapter_id" class="col-sm-5">Chapter Name <i class="text-danger"> * </i></label>
                        <div class="col-sm-9">
                            <select class="form-control placeholder-single" name="chapter_id" id="chapter_id"
                                data-placeholder="<?php echo display('select_one'); ?>" required>
                                <option value=""></option>
                                <?php foreach($course_wise_section as $chapter){ ?>
                                <option value='<?php echo $chapter->section_id; ?>'>
                                    <?php echo $chapter->section_name; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $segment3; ?>" name="course_id">
                    <div class="form-group col-sm-6">
                        <label for="name" class="col-sm-4">Quiz Title <i class="text-danger"> *
                            </i></label>
                        <div class="col-sm-9">
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="<?php echo display('name'); ?>" required>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="pass_mark" class="col-sm-4">Pass Score<i class="text-danger"> *
                            </i></label>
                        <div class="col-sm-9">
                            <input type="number" name="pass_mark" id="pass_mark" class="form-control"
                                placeholder="Pass Score" onkeyup="getpassscorecheck(this.value)" required>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="totalquestiondiv">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="question_type" class="col-sm-5"><?php echo display('question_type'); ?> <i
                                    class="text-danger"> * </i></label>
                            <div class="col-sm-9">
                                <select class="form-control placeholder-single" name="question_type[]"
                                    id="question_type" onchange="loadquestiondata(this.value, '1')"
                                    data-placeholder="<?php echo display('select_one'); ?>" required>
                                    <option value=""></option>
                                    <option value="1">True/False</option>
                                    <option value="2">Multiple Answer</option>
                                    <option value="3"><?php echo display('short_answer'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="question_mark" class="col-sm-4"><?php echo display('question_mark') ?> <i
                                    class="text-danger"> * </i></label>
                            <div class="col-sm-9">
                                <input type="number" min="1" name="question_mark[]" id="question_mark_1" onkeyup="questionmarktwodigit(this.value, 1)"
                                    class="form-control" placeholder="<?php echo display('question_mark'); ?>" required>
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="question_mark" class="col-sm-3">&nbsp</label>
                            <div class="col-sm-9">
                                <div class="sticky" style="position: static; top: 0px; z-index: 1; right: 112px;">
                                    <button id="add-question-item" class="btn btn-info btn-sm" name="add-question-item"
                                    onclick="addQuestionsection('addQuestionItem')" type="button"
                                    style="margin: 0px 15px 15px;"><i class="fa fa-plus"> </i> Add Question</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="question" class="col-sm-4"><strong><?php echo display('question') ?>
                                    1</strong></label>
                            <div class="col-sm-12">
                                <textarea name="question[]" id="question" class="form-control" rows="1" cols="80"
                                    required></textarea> <!-- /.Ck Editor -->
                                <input type="hidden" id="qst_editor" value="1">
                                <input type="hidden" id="qst_count_1" value="1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <input type="text" value="1" id="ansCountNumber_1"> -->
                        <div class="loaddata_1 col-sm-12 w-100p">

                        </div>
                    </div>
                    <hr>
                </div>

                <!-- <div clas -->

                <div class="form-group text-right">
                    <input type="hidden" id="insert_mode" value="1">
                    <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- <script>
    // Make sure you are using a correct path here.
    var editor = CKEDITOR.replace('question', {
        extraPlugins: 'mathjax',
        mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML',
        height: 320,

//        extraPlugins: 'videoembed',


        filebrowserBrowseUrl: '<?php echo base_url(); ?>assets/plugins/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: '<?php echo base_url(); ?>assets/plugins/ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl: '<?php echo base_url(); ?>assets/plugins/ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl: '<?php echo base_url(); ?>assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '<?php echo base_url(); ?>assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: '<?php echo base_url(); ?>assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
//        filebrowserUploadUrl: "upload.php",
        filebrowserUploadMethod: "form",
    });
//    CKFinder.setupCKEditor(editor, '../');
//    CKFinder.setupCKEditor(editor);
    CKFinder.setupCKEditor(editor, '/ckfinder/');
</script>
</script> -->

<script src="<?php echo base_url('application/modules/dashboard/assets/js/course.js') ?>"></script>