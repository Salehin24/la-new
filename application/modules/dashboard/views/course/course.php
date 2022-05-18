<link rel="stylesheet" href="<?php echo base_url('application/modules/dashboard/assets/css/common.css') ?>">
<div class="row">
    <!-- Form controls -->
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
            unset($_SESSION['message']);
        }
        if ($file_uploaderror != '') {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>$file_uploaderror</div>";
        }
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $segment3 = $this->uri->segment(3);
        ?>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="m-2">
            </div>
            <div class="row">
                <!-- <div class="col-md-12">
                    <ul class="nav nav-tabs mb-3 ml-3" role="tablist">
                        <li role="presentation"  style="width: 15%"><a href="#home" aria-controls="home"
                                role="tab" data-toggle="tab" class="active font-weight-bold"><?php echo display('course');?></a>
                        </li>
                        <li role="presentation" style="width: 15%"><a href="#profile" aria-controls="profile" role="tab"
                                data-toggle="tab" class="font-weight-bold"><?php echo display('library');?></a>
                        </li>
                    </ul>
                </div> -->
                <div class="col-md-12">
                    <div class="tab-content">
                        <!-- add course  -->
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="nav flex-column nav-pills custom_tablist">
                                        <ul class="nav nav-pills d-inlineblock" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="v-pills-basic-tab" data-toggle="pill"
                                                    href="#v-pills-basic" role="tab" aria-controls="v-pills-basic"
                                                    aria-selected="true"><?php echo display('course_info'); ?></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="v-pills-pricing-tab" data-toggle="pill"
                                                    href="#v-pills-pricing" role="tab" aria-controls="v-pills-pricing"
                                                    aria-selected="false"><?php echo display('course_pricing'); ?></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="v-pills-curriculum-tab"
                                                    <?php if($segment3){ ?>data-toggle="pill" href="#v-pills-curriculum"
                                                    role="tab" aria-controls="v-pills-curriculum" aria-selected="true"
                                                    <?php }else{ echo 'disabled'; } ?>><?php echo display('curriculum'); ?></a>
                                            </li>
                                            <!-- <li class="nav-item">
                                                <a class="nav-link" id="v-pills-quiz-tab" data-toggle="pill"
                                                    href="#v-pills-quiz" role="tab" aria-controls="v-pills-quiz"
                                                    aria-selected="false"><?php echo display('course_quiz'); ?></a>
                                            </li> -->
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-9 p-15">
                                    <?php echo form_open_multipart(enterpriseinfo()->shortname . '/course-save', 'class="myform" id="myform"'); ?>
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-basic" role="tabpanel"
                                            aria-labelledby="v-pills-basic-tab">
                                            <div class="form-group row m-r">
                                                <label for="name"
                                                    class="col-sm-3"><?php echo display('course_name') ?><i
                                                        class="text-danger"> *</i></label>
                                                <div class="col-sm-9">
                                                    <input name="name" class="form-control" type="text"
                                                        placeholder="<?php echo display('name') ?>" id="name">
                                                </div>
                                            </div>
                                            <?php if ($user_type == 1 || $user_type == 2) { ?>
                                            <div class="form-group row m-r">
                                                <label for="faculty_id"
                                                    class="col-sm-3"><?php echo display('instructor') ?><i
                                                        class="text-danger"> *</i></label>
                                                <div class="col-sm-9">
                                                    <select class="form-control placeholder-single" id="faculty_id"
                                                        name="faculty_id"
                                                        data-placeholder="<?php echo display('select_one'); ?>">
                                                        <option value=""></option>
                                                        <?php foreach ($get_faculty as $faculty) { ?>
                                                        <option
                                                            value="<?php echo html_escape($faculty->faculty_id); ?>">
                                                            <?php echo html_escape($faculty->name); ?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php } else { ?>
                                            <input type="hidden" class="faculty_id" name="faculty_id"
                                                value="<?php echo html_escape($user_id); ?>">
                                            <?php } ?>
                                            <div class="form-group row m-r">
                                                <label for="category_id"
                                                    class="col-sm-3"><?php echo display('course') . " " . display('category') ?>
                                                    <i class="text-danger"> *</i></label>
                                                <div class="col-sm-9">
                                                    <select name="category_id" class="form-control placeholder-single"
                                                        id="category_id"
                                                        onchange="category_wise_subcategory(this.value)"
                                                        data-placeholder="<?php echo display('select_one'); ?>"
                                                        required>
                                                        <option value=""></option>
                                                        <?php foreach ($parent_category as $category) { ?>
                                                        <option
                                                            value="<?php echo html_escape($category->category_id); ?>">
                                                            <?php echo html_escape($category->name); ?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row m-r">
                                                <label for="subcategory_id"
                                                    class="col-sm-3"><?php echo display('sub') . " " . display('category') ?></label>
                                                <div class="col-sm-9">
                                                    <select name="subcategory_id"
                                                        class="form-control placeholder-single" id="subcategory_id"
                                                        data-placeholder="<?php echo display('select_one'); ?>">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row m-r">
                                                <label for="course_level" class="col-sm-3"><?php echo display('course_level') ?><i
                                                        class="text-danger"> *</i>
                                                </label>
                                                <div class="col-sm-9">
                                                    <select name="course_level" class="form-control placeholder-single"
                                                        id="course_level" data-placeholder="<?php echo display('select_one'); ?>">
                                                        <option value=""></option>
                                                        <option value="1">Begineer</option>
                                                        <option value="2">Intermediate</option>
                                                        <option value="3">Advanced</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row m-r">
                                                <label for="course_type"
                                                    class="col-sm-3"><?php echo display('course_type') ?><i
                                                        class="text-danger"> *</i></label>
                                                <div class="col-sm-9">
                                                    <select name="course_type[]" multiple
                                                        class="form-control placeholder-single" id="course_type"
                                                        data-placeholder="<?php echo display('select_one'); ?>">
                                                        <option value=""></option>
                                                        <option value="1"><?php echo display('purchase'); ?></option>
                                                        <option value="2"><?php echo display('subscription'); ?></option>
                                                        <option value="3"><?php echo display('free'); ?></option>
                                                        <option value="4"><?php echo display('govt'); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row m-r">
                                                <label for="language" class="col-sm-3"><?php echo display('language') ?>
                                                </label>
                                                <div class="col-sm-9">
                                                    <select name="language" class="form-control placeholder-single"
                                                        id="language"
                                                        data-placeholder="<?php echo display('select_one'); ?>">
                                                        <option value=""></option>
                                                        <?php foreach($get_languages as $language_k => $language_val){ ?>
                                                        <option value="<?php echo $language_k; ?>">
                                                            <?php echo $language_val; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group row m-r">
                                                <label for="course_material" class="col-sm-3">Course Materials</label>
                                                <div class="col-sm-9">
                                                    <textarea name="course_material" class="form-control"
                                                        placeholder="Course Materials" id="course_material"
                                                        rows="4"></textarea>
                                                </div>
                                            </div> -->
                                            <!-- <div class="form-group row m-r">
                                                <label for="course_isfor" class="col-sm-3">Who this course is for?</label>
                                                <div class="col-sm-9">
                                                    <textarea name="course_isfor" class="form-control"
                                                        placeholder="Who this course is for?"
                                                        id="course_isfor" rows="4"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row m-r">
                                                <label for="course_result" class="col-sm-3">Course Results</label>
                                                <div class="col-sm-9">
                                                    <textarea name="course_result" class="form-control"
                                                        placeholder="Course Result/What will learners have in the end of this course?"
                                                        id="course_result" rows="4"></textarea>
                                                </div>
                                            </div> -->
                                            <div class="form-group row m-r">
                                                <label for="career_outcomes" class="col-sm-3">Learner Career
                                                    Outcomes</label>
                                                <div class="col-sm-8">
                                                    <!-- <textarea name="career_outcomes" class="form-control"
                                                        placeholder="Learner Career Outcomes" id="career_outcomes"
                                                        rows="4"></textarea> -->
                                                    <div id="careeroutcome_area">
                                                        <div class="d-flex mt-2">
                                                            <div class="flex-grow-1 pr-3">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control carrer-out-1"
                                                                        name="career_outcomes[]" id="career_outcomes"
                                                                        onkeyup="characterlimitation('carrer-out', 1, 40, 'career-msgcount')"
                                                                        placeholder="<?php echo "Learner Career Outcomes"; ?>">
                                                                    <span class=" text-danger">Only <span
                                                                            class="career-msgcount-1">40</span>
                                                                        characters remaining</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <button type='button'
                                                                    class='btn btn-danger btn-sm custom_btn m-t-0'
                                                                    name='button' onclick='removeCareeroutcome(this)'>
                                                                    <i class='fa fa-minus'></i> </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-1">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-success text-white btn-sm custom_btn mt-2"
                                                        onclick="appendCareeroutcome()"><i class="fa fa-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="form-group row m-r">
                                                <label for="skillsgain" class="col-sm-3">Skills you will gain</label>
                                                <div class="col-sm-8">
                                                    <div id="skillsgain_area">
                                                        <div class="d-flex mt-2">
                                                            <div class="flex-grow-1 pr-3">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control skillsgain-1"
                                                                        name="skillsgain[]" id="skillsgain"
                                                                        onkeyup="characterlimitation('skillsgain', 1, 20, 'skillgain-msgcount')"
                                                                        placeholder="<?php echo "Skills you will gain"; ?>">
                                                                    <span class=" text-danger">Only <span
                                                                            class="skillgain-msgcount-1">20</span>
                                                                        characters remaining</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <button type='button'
                                                                    class='btn btn-danger btn-sm custom_btn m-t-0'
                                                                    name='button' onclick='removeSkillsgain(this)'> <i
                                                                        class='fa fa-minus'></i> </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-1">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-success text-white btn-sm custom_btn mt-2"
                                                        onclick="appendSkillsgain()"><i class="fa fa-plus"></i> </a>
                                                </div>
                                            </div>
                                            <div class="form-group row m-r">
                                                <label for="related_resource" class="col-sm-3">Related Resources</label>
                                                <div class="col-sm-8">
                                                    <!-- <textarea name="related_resource" class="form-control"
                                                        placeholder="Related Resources" id="related_resource"
                                                        rows="4"></textarea> -->
                                                    <div id="relatedresource_area">
                                                        <div class="d-flex mt-2">
                                                            <div class="flex-grow-1 pr-3">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control"
                                                                        name="related_resource[]" id="related_resource"
                                                                        placeholder="<?php echo "Related Resource"; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <button type='button'
                                                                    class='btn btn-danger btn-sm custom_btn m-t-0'
                                                                    name='button' onclick='removeRelatedresource(this)'>
                                                                    <i class='fa fa-minus'></i> </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-1">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-success text-white btn-sm custom_btn mt-2"
                                                        onclick="appendRelatedresource()"><i class="fa fa-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="form-group row m-r">
                                                <label for="description" class="col-sm-3">About this course
                                                </label>
                                                <div class="col-sm-9">
                                                    <textarea name="description" id="description" rows="10"
                                                        cols="80"></textarea>
                                                    <!-- /.Ck Editor -->
                                                </div>
                                            </div>
                                            <!-- <div class="form-group row m-r">
                                                <label for="summary"
                                                    class="col-sm-3"><?php echo display('short_description') ?>
                                                </label>
                                                <div class="col-sm-9">
                                                    <textarea name="summary" class="form-control"
                                                        placeholder="<?php echo display('short_description') ?>"
                                                        id="summary"></textarea>
                                                </div>
                                            </div> -->
                                            <!-- <div class="form-group row m-r">
                                                <label for="offer_courseid"
                                                    class="col-sm-3"><?php echo display('offer') ?> </label>
                                                <div class="col-sm-9">
                                                    <select name="offer_courseid[]"
                                                        class="form-control placeholder-single" id="offer_courseid"
                                                        data-placeholder="<?php echo display('select_one'); ?>"
                                                        multiple>
                                                        <option value=""></option>
                                                        <?php foreach ($get_course as $offer_course) { ?>
                                                        <option value="<?php echo $offer_course->course_id; ?>">
                                                            <?php echo $offer_course->name; ?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div> -->
                                            <div class="form-group row m-r">
                                                <label for="related_courseid"
                                                    class="col-sm-3"><?php echo display('related_course') ?> </label>
                                                <div class="col-sm-9">
                                                    <select name="related_courseid[]"
                                                        class="form-control placeholder-single" id="related_courseid"
                                                        data-placeholder="<?php echo display('select_one'); ?>"
                                                        multiple>
                                                        <option value=""></option>
                                                        <?php foreach ($get_course as $relatedcourse) { ?>
                                                        <option value="<?php echo $relatedcourse->course_id; ?>">
                                                            <?php echo $relatedcourse->name; ?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row m-r">
                                                <?php if ($user_type == 1) { ?>
                                                <!-- <div class="offset-3 checkbox checkbox-success">
                                                    <input id="is_popular" type="checkbox" name="is_popular" value="0">
                                                    <label for="is_popular"><?php echo display('is_popular'); ?></label>
                                                </div> -->
                                                <?php } ?>
                                                <!-- <div class="offset-1 checkbox checkbox-success">
                                                    <input id="is_new" type="checkbox" name="is_new" value="0">
                                                    <label for="is_new"><?php echo display('is_new'); ?></label>
                                                </div> -->
                                                <!-- <label for="commission"
                                                    class="col-sm-3 text-right"><?php echo display('commission') ?> <i
                                                        class="text-danger"> *</i></label>
                                                <div class="col-sm-1">
                                                    <input type="text" class="form-control" id="commission"
                                                        name="commission" placeholder="Commssion">
                                                </div> -->
                                            </div>
                                            <div class="form-group row m-r">
                                                <label class="col-sm-3" for="requirements">Pre Requisites</label>
                                                <div class="col-sm-8">
                                                    <div id="requirement_area">
                                                        <div class="d-flex mt-2">
                                                            <div class="flex-grow-1 pr-3">
                                                                <div class="form-group">
                                                                    <input type="text"
                                                                        class="form-control requirements-1"
                                                                        name="requirements[]" id="requirements"
                                                                        onkeyup="characterlimitation('requirements', 1, 40, 'requirements-msgcount')"
                                                                        placeholder="Pre Requisites">
                                                                    <span class=" text-danger">Only <span
                                                                            class="requirements-msgcount-1">40</span>
                                                                        characters remaining</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <button type='button'
                                                                    class='btn btn-danger btn-sm custom_btn m-t-0'
                                                                    name='button' onclick='removeRequirement(this)'>
                                                                    <i class='fa fa-minus'></i> </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-1">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-success text-white btn-sm custom_btn mt-2"
                                                        onclick="appendpreRequirement()"><i class="fa fa-plus"></i> </a>
                                                </div>
                                            </div>

                                            <div class="form-group row m-r">
                                                <label class="col-md-3"
                                                    for="outcomes"><?php echo display('what_you_will_learn'); ?></label>
                                                <div class="col-md-8">
                                                    <div id="outcomes_area">
                                                        <div class="d-flex mt-2">
                                                            <div class="flex-grow-1 pr-3">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control outcomes-1"
                                                                        name="benifits[]" id="outcomes"
                                                                        onkeyup="characterlimitation('outcomes', 1, 40, 'outcomes-msgcount')"
                                                                        placeholder="<?php echo display('what_you_will_learn'); ?>">
                                                                    <span class=" text-danger">Only <span
                                                                            class="outcomes-msgcount-1">40</span>
                                                                        characters remaining</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <button type='button'
                                                                    class='btn btn-danger btn-sm custom_btn m-t-0'
                                                                    name='button' onclick='removeOutcome(this)'>
                                                                    <i class='fa fa-minus'></i> </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <button type="button"
                                                        class="btn btn-success text-white btn-sm custom_btn mt-2"
                                                        name="button" onclick="appendlearnOutcome()"> <i
                                                            class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group row m-r">
                                                <label for="course_provider"
                                                    class="col-sm-3"><?php echo display('course_provider') . " " . display('source'); ?>
                                                </label>
                                                <div class="col-sm-9">
                                                    <select name="course_provider"
                                                        class="form-control placeholder-single" id="course_provider"
                                                        data-placeholder="<?php echo display('select_one'); ?>">
                                                        <option value=""></option>
                                                        <option value="1"><?php echo display('youtube') ?></option>
                                                        <option value="2"><?php echo display('vimeo') ?></option>
                                                    </select>
                                                </div>
                                            </div> -->
                                            <!-- <div class="form-group row m-r">
                                                <label for="url"
                                                    class="col-sm-3">Course Promotional Video </label>
                                                <div class="col-sm-9">
                                                    <input name="url" class="form-control" type="text"
                                                        placeholder="Course Promotional Video" id="url">
                                                </div>
                                            </div> -->
                                            <input type="hidden" name="url" id="url">
                                            <input type="hidden" name="course_provider" id="course_provider" value="2">
                                            <div class="form-group row m-r">
                                                <label for="pro_url" class="col-sm-3">Course Promotional Video<i
                                                        class="text-danger"> *</i></label>
                                                <div class="col-sm-4">
                                                    <div class="custom-file">
                                                        <input type="file" name="pro_url" id="pro_url" class="custom-file-input fileuploader">
                                                        <label class="custom-file-label" id="pro_url-custom-file-label" for="pro_url">Choose Course Promotional Video…</label>
                                                        <!-- <label for="pro_url">
                                                            <i class="fa fa-upload"></i>
                                                            <span>Choose Course Promotional Video…</span>
                                                        </label> -->
                                                        <br>
                                                        <br>
                                                        <div id="progress-container" class="progress"
                                                            style='display:none'>
                                                            <div id="progress"
                                                                class="progress-bar progress-bar-info progress-bar-striped active"
                                                                role="progressbar" aria-valuenow="46" aria-valuemin="0"
                                                                aria-valuemax="100" style="width: 0%">&nbsp;0%
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2" id="trailervideo_delete_content"
                                                    style="display:none">
                                                    <a class="btn btn-danger py-2 text-capitalize"
                                                        href="javascript:void(0)"
                                                        onclick="cancel_trailer_video()">cancel</a>
                                                </div>
                                            </div>

                                            <!-- <div class="form-group row m-r">
                                                <label for="url" class="col-sm-3">Course Promotional Video
                                                    Trailer</label>
                                                <div class="col-sm-4">
                                                    <div>
                                                        <input type="file" name="url" id="url"
                                                            class="custom-input-file"/>
                                                        <label for="url">
                                                            <i class="fa fa-upload"></i>
                                                            <span>Choose Video Trailer…</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div> -->


                                            <div class="form-group row m-r">
                                                <label for="thumbnail" class="col-sm-3">Course Mini Thumbnail<i
                                                        class="text-danger"> *</i></label>
                                                <div class="col-sm-4">
                                                    <!-- <div>
                                                        <input type="file" name="thumbnail" id="thumbnail"
                                                            class="custom-input-file"
                                                            onchange="fileValueOne(this,'course_featured_image')" />
                                                        <label for="thumbnail">
                                                            <i class="fa fa-upload"></i>
                                                            <span>Choose Course Mini Thumbnail…</span>
                                                        </label>
                                                    </div> -->
                                                    <div class="custom-file">
                                                        <input type="file" name="thumbnail" id="thumbnail" class="custom-file-input" onchange="fileValueOne(this,'course_featured_image')">
                                                        <label class="custom-file-label" id="thumbnail-custom-file-label" for="thumbnail">Choose Course Mini Thumbnail…</label>
                                                    </div>
                                                </div>
                                                <span class="text-danger">( 398×224 formats :png,jpg,jpeg,gif)</span>
                                            </div>
                                            <div class="form-group row m-r">
                                                <label for="thumbnail" class="col-sm-3"></label>
                                                <div class="col-sm-4">
                                                    <img id="image-preview-course_featured_image" src="" alt=""
                                                        class="border border-2" width="200px">
                                                </div>
                                            </div>

                                            <div class="form-group row m-r">
                                                <label for="hover_thumbnail" class="col-sm-3">Course Mini Thumbnail
                                                    Hover<i class="text-danger"> </i></label>
                                                <div class="col-sm-4">
                                                    <!-- <div>
                                                        <input type="file" name="hover_thumbnail" id="hover_thumbnail"
                                                            class="custom-input-file"
                                                            onchange="fileValueOne(this,'hover_thumbnail')" />
                                                        <label for="hover_thumbnail">
                                                            <i class="fa fa-upload"></i>
                                                            <span>Choose Course Mini Thumbnail Hover…</span>
                                                        </label>
                                                    </div> -->
                                                    <div class="custom-file">
                                                        <input type="file" name="hover_thumbnail" id="hover_thumbnail" class="custom-file-input" onchange="fileValueOne(this,'hover_thumbnail')">
                                                        <label class="custom-file-label" id="hover-custom-file-label" for="hover_thumbnail">Choose Course Mini Thumbnail Hover…</label>
                                                    </div>
                                                </div>
                                                <span class="text-danger">( 312×345 formats :png,jpg,jpeg,gif)</span>
                                            </div>
                                            <div class="form-group row m-r">
                                                <label for="hover_thumbnail" class="col-sm-3"></label>
                                                <div class="col-sm-4">
                                                    <img id="image-preview-hover_thumbnail" src="" alt=""
                                                        class="border border-2" width="200px">
                                                </div>
                                            </div>

                                            <div class="form-group row m-r">
                                                <label for="cover_thumbnail" class="col-sm-3">Cover
                                                    (Image/Thumbnail)<i class="text-danger"> </i></label>
                                                <div class="col-sm-4">
                                                    <!-- <div>
                                                        <input type="file" name="cover_thumbnail" id="cover_thumbnail"
                                                            class="custom-input-file"
                                                            onchange="fileValueOne(this,'course_cover_thumbnail')" />
                                                        <label for="cover_thumbnail">
                                                            <i class="fa fa-upload"></i>
                                                            <span>Choose Cover (Image/Thumbnail)…</span>
                                                        </label>
                                                    </div> -->
                                                    <div class="custom-file">
                                                        <input type="file" name="cover_thumbnail" id="cover_thumbnail" class="custom-file-input" onchange="fileValueOne(this,'course_cover_thumbnail')">
                                                        <label class="custom-file-label" id="cover_thumbnail-custom-file-label" for="cover_thumbnail">Choose Cover (Image/Thumbnail)…</label>
                                                    </div>
                                                </div>
                                                <span class="text-danger">( 1903×476 formats :png,jpg,jpeg,gif)</span>
                                            </div>
                                            <div class="form-group row m-r">
                                                <label for="cover_thumbnail" class="col-sm-3"></label>
                                                <div class="col-sm-4">
                                                    <img id="image-preview-course_cover_thumbnail" src="" alt=""
                                                        class="border border-2" width="200px">
                                                </div>
                                            </div>

                                            <div class="form-group row m-r">
                                                <label for="passing_grade"
                                                    class="col-sm-3"><?php echo 'Passing Grade' ?> <span
                                                        class="text-danger"> (%)</span><i class="text-danger">
                                                    </i></label>
                                                <div class="col-sm-4">
                                                    <input name="passing_grade" class="form-control" type="number"
                                                        placeholder="20%" id="passing_grade">
                                                </div>
                                            </div>
                                            <div class="form-group row m-r">
                                                <label for="syllabus"
                                                    class="col-sm-3"><?php echo display('syllabus') ?><i
                                                        class="text-danger"> </i></label>
                                                <div class="col-sm-4">
                                                    <!-- <div>
                                                        <input type="file" name="syllabu" id="syllabus"
                                                            onchange="uploadProgress('syllabus')"
                                                            class="custom-input-file" />
                                                        <label for="syllabus">
                                                            <i class="fa fa-upload"></i>
                                                            <span>Choose Syllabus…</span>
                                                        </label>
                                                    </div> -->
                                                    <div class="custom-file">
                                                        <input type="file" name="syllabu" id="syllabus" class="custom-file-input" onchange="uploadProgress('syllabus')">
                                                        <label class="custom-file-label" id="syllabus-custom-file-label" for="syllabus">Choose Syllabus…</label>
                                                    </div>
                                                    <!-- Progress bar -->
                                                    <div class="progress-area mt-2"></div>
                                                    <!-- Display upload status -->
                                                    <div id="uploadStatus"></div>
                                                </div>
                                            </div>
                                            <!-- <div id="zone_id">zone</div> -->

                                            <div class="form-group row">
                                                <label for='resource' class='col-sm-3'>Course Resource Files</label>
                                                <div class='col-sm-4' id="resource_area">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <input type='file' name='resource[]' id='resource_1'
                                                                onchange="fileuploaderprogress('1', 'resource_1', 'resource-uploadStatus-1', 'resource-progress-area-1')"
                                                                class='custom-input-file'>
                                                                <label for='resource_1'><i
                                                                    class='fa fa-upload'></i>
                                                                    <span class="filename-1">Choose a file...</span></label>

                                                                    <!-- <div class="custom-file">
                                                                        <input type="file" name='resource[]' id='resource_1' onchange="fileuploaderprogress('resource_1', 'resource-uploadStatus-1', 'resource-progress-area-1')" class="custom-file-input">
                                                                        <label class="custom-file-label" for="resource_1">Choose file</label>
                                                                    </div> -->
                                                            <br>
                                                            <div class="resource-uploadStatus-1 col-sm-8"></div>
                                                            <div class="resource-progress-area-1 col-sm-8 mb-3"></div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button type='button'
                                                                class='btn btn-danger btn-sm custom_btn mt-2'
                                                                name='button' onclick='removeResource(this)'> <i
                                                                    class='fa fa-minus'></i> </button>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="hidden" id="resource_sl" value="1">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-success text-white btn-sm custom_btn mt-2"
                                                        onclick="appendAddresource()"><i class="fa fa-plus"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="offset-3 mb-3 group-end">
                                                <input type="submit" class="btn btn-success text-white finishoff"
                                                    id="coursesave_btn" value="<?php echo display('finish'); ?>">
                                                <a class="btn btn-success text-white btnNext " id="v-pills-pricing-tab"
                                                    data-toggle="pill"
                                                    href="#v-pills-pricing"><?php echo display('next') ?></a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-pricing" role="tabpanel"
                                            aria-labelledby="v-pills-pricing-tab">
                                            <!-- <div class="form-group row">
                                                <div class="offset-2 checkbox checkbox-success">
                                                    <input id="is_free" name="is_free" type="checkbox" value="0">
                                                    <label
                                                        for="is_free"><?php echo display('is_free_course'); ?></label>
                                                </div>
                                            </div> -->
                                            <div class="dependent_freecourse">
                                                <div class="form-group row">
                                                    <label for="oldprice" class="col-sm-2">Base Price </label>
                                                    <div class="col-sm-9">
                                                        <input name="oldprice" class="form-control" type="number"
                                                            placeholder="Base Price" id="oldprice"
                                                            onkeyup="pricecalculation()">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-2 checkbox checkbox-success">
                                                        <input id="is_discount" name="is_discount" type="checkbox"
                                                            value="0">
                                                        <label
                                                            for="is_discount"><?php echo display('is_discount'); ?></label>
                                                    </div>
                                                </div>
                                                <div class="dependent_discountcourse">
                                                    <div class="form-group row">
                                                        <label for="discount_type"
                                                            class="col-sm-2"><?php echo display('discount_type'); ?>
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control placeholder-single"
                                                                name="discount_type" id="discount_type"
                                                                onchange="pricecalculation()"
                                                                data-placeholder="<?php echo display('select_one'); ?>">
                                                                <option value=""></option>
                                                                <option value="1">Fixed</option>
                                                                <option value="2">Percent</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="discount"
                                                            class="col-sm-2"><?php echo display('discount'); ?>
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <input name="discount" class="form-control" type="number"
                                                                placeholder="<?php echo display('discount') ?>"
                                                                id="discount" onkeyup="pricecalculation()">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="price"
                                                        class="col-sm-2"><?php echo display('current') . " " . display('price') ?>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input name="price" class="form-control" type="number"
                                                            placeholder="<?php echo display('price') ?>" id="price"
                                                            onkeyup="onlynumber_allow(this.value, 'price')" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div class="form-group row">
                                                <div class="offset-2 checkbox checkbox-success">
                                                    <input id="is_offer" name="is_offer" type="checkbox" value="0">
                                                    <label for="is_offer"><?php echo 'Apply Discount'; ?></label>
                                                </div>
                                            </div> -->

                                            <div class="dependent_offercourse">
                                                <div class="form-group row m-r">
                                                    <label for="offer_courseid"
                                                        class="col-sm-2"><?php echo display('offer') ?> </label>
                                                    <div class="col-sm-9">
                                                        <select name="offer_courseid[]"
                                                            class="form-control placeholder-single" id="offer_courseid"
                                                            data-placeholder="<?php echo display('select_one'); ?>"
                                                            multiple>
                                                            <option value=""></option>
                                                            <?php foreach ($get_course as $offer_course) { ?>
                                                            <option value="<?php echo $offer_course->course_id; ?>">
                                                                <?php echo $offer_course->name; ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="offer_courseprice" class="col-sm-2">Course Price</label>
                                                    <div class="col-sm-9">
                                                        <input name="offer_courseprice" class="form-control"
                                                            type="number" id="offer_courseprice">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="offset-3 mb-3 group-end">
                                                <!-- <a class="btn btn-danger btnPrevious" id="v-pills-basic-tab"
                                                    data-toggle="pill"
                                                    href="#v-pills-basic"><?php echo display('previous') ?></a>
                                                <a class="btn btn-success btnNext" id="v-pills-quiz-tab"
                                                    data-toggle="pill"
                                                    href="#v-pills-quiz"><?php echo display('next') ?></a> -->
                                                <a class="btn btn-danger btnPrevious" id="v-pills-media-tab"
                                                    data-toggle="pill"
                                                    href="#v-pills-media"><?php echo display('previous') ?></a>
                                                <input type="submit" class="btn btn-success text-white"
                                                    id="coursesave_btn" value="<?php echo display('finish'); ?>">
                                            </div>
                                        </div>

                                        <?php                                        
                                        if($segment3){ ?>
                                        <div class="tab-pane fade show" id="v-pills-curriculum" role="tabpanel"
                                            aria-labelledby="v-pills-curriculum-tab">
                                            <div class="form-group row">
                                                <button type="button"
                                                    class="btn btn-outline-success btn-sm col-sm-2 m-l-10"
                                                    onclick="addsection_form('<?php echo html_escape((!empty($edit_data->course_id) ? $edit_data->course_id : '')); ?>', '3')"><?php echo display('add_section'); ?>        
                                                </button>
                                                <button type="button" class="btn btn-outline-info col-sm-2 m-l-10"
                                                    onclick="addlesson_form('<?php echo html_escape((!empty($edit_data->course_id) ? $edit_data->course_id : '')); ?>')"><?php echo display('add_lesson'); ?>
                                                </button>
                                                <button type="button" class="btn btn-outline-primary col-sm-2 m-l-10"
                                                    onclick="assignExamForm('<?php echo html_escape((!empty($edit_data->course_id) ? $edit_data->course_id : '')); ?>')"><?php echo display('assign_exam'); ?>        
                                                </button>
                                                <button type="button" class="btn btn-outline-success col-sm-2 m-l-10"
                                                    onclick="projectassignmentForm('<?php echo html_escape($edit_data->course_id); ?>')">Project/Assignment</button>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <table class="table table-hover bg-margin-10-20">
                                                        <?php
                                                    $sl = 0;
                                                    foreach ($course_wise_section as $sinlge_section) {
                                                        $course_section_wise_lesson = $this->Course_model->course_section_wise_lesson($edit_data->course_id, $sinlge_section->section_id, get_enterpriseid());
                                                        $sl++;
                                                        ?>
                                                        <thead>
                                                            <tr>
                                                                <th><?php echo display('section') . " " . $sl; ?> :
                                                                    <?php echo html_escape($sinlge_section->section_name); ?>
                                                                </th>
                                                                <th width='' class="text-right">
                                                                    <a href="javascript:void(0)"
                                                                        onclick="section_edit('<?php echo html_escape($sinlge_section->section_id); ?>')"
                                                                        class="">
                                                                        <i class="btn-info btn-sm fa fa-edit"> </i>
                                                                    </a>
                                                                    <a href="javascript:void(0)"
                                                                        onclick="section_delete('<?php echo html_escape($sinlge_section->section_id); ?>')"
                                                                        class="">
                                                                        <i class="btn-danger btn-sm fa fa-trash"> </i>
                                                                    </a>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($course_section_wise_lesson as $lesson) { ?>
                                                            <tr>
                                                                <td class="pl-40">
                                                                    <?php echo html_escape($lesson->lesson_name); ?>
                                                                </td>
                                                                <td class="text-right">
                                                                    <a href="javascript:void(0)"
                                                                        onclick="edit_lesson('<?php echo html_escape($lesson->lesson_id); ?>', '<?php echo html_escape($edit_data->course_id); ?>')"
                                                                        class="">
                                                                        <i
                                                                            class="btn-success text-white btn-sm fa fa-edit">
                                                                        </i>
                                                                    </a>
                                                                    <a href="javascript:void(0)"
                                                                        onclick="lesson_delete('<?php echo html_escape($lesson->lesson_id); ?>')"
                                                                        class="">
                                                                        <i class="btn-danger btn-sm fa fa-trash"> </i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                        <?php } ?>
                                                    </table>
                                                </div>

                                                <div class="col-sm-12">
                                                    <h4 class="m-t-30 m-b-20">Assign Exam List</h4>
                                                    <table
                                                        class="table display table-bordered table-striped table-hover bg-white m-0"
                                                        id="assignexamlist">
                                                        <thead>
                                                            <tr>
                                                                <th><?php echo display('sl') ?></th>
                                                                <th><?php echo display('lesson_name') ?>ss</th>
                                                                <th><?php echo display('exam_name') ?></th>
                                                                <th class="text-center"><?php echo display('action') ?>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach($get_assignexamlist as $exam){ ?>
                                                            <tr>
                                                                <td><?php echo $sl; ?></td>
                                                                <td><?php echo $exam->lesson_name; ?></td>
                                                                <td><?php echo $exam->exam_name; ?></td>
                                                                <td class="text-center">
                                                                    <a href="javascript:void(0)"
                                                                        onclick="assignexamEdit('<?php echo $exam->course_id; ?>','<?php echo $exam->id; ?>')"
                                                                        data-toggle="tooltip" title="Edit"><i
                                                                            class="fa fa-edit btn-success text-white btn-sm"></i>
                                                                    </a>
                                                                    <a href="javascript:void(0)"
                                                                        onclick="assignexamDelete('<?php echo $exam->id; ?>')"
                                                                        data-toggle="tooltip" title="Delete"><i
                                                                            class="far fa-trash-alt btn-danger  btn-sm"></i></a>
                                                                </td>
                                                            <tr>
                                                                <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <br>
                                                <div class="col-sm-12">
                                                    <h4 class="m-t-30 m-b-20">Project / Assignment list</h4>
                                                    <table
                                                        class="table display table-bordered table-striped table-hover bg-white m-0"
                                                        id="assignexamlist">
                                                        <thead>
                                                            <tr>
                                                                <th><?php echo display('sl') ?></th>
                                                                <th><?php echo display('title') ?>ss</th>
                                                                <th>Pass Score</th>
                                                                <th>Pass Mark</th>
                                                                <th class="text-center"><?php echo display('action') ?>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                            $sl=0;
                                            foreach($get_assignmentprojectlist as $assignment){ 
                                                $sl++; ?>
                                                            <tr>
                                                                <td><?php echo $sl; ?></td>
                                                                <td><?php echo $assignment->title; ?></td>
                                                                <td><?php echo $assignment->pass_score; ?></td>
                                                                <td><?php echo $assignment->project_mark; ?></td>
                                                                <td class="text-center">
                                                                    <a href="javascript:void(0)"
                                                                        onclick="assignmentprojectEdit('<?php echo $assignment->course_id; ?>','<?php echo $assignment->id; ?>')"
                                                                        data-toggle="tooltip" title="Edit"><i
                                                                            class="fa fa-edit btn-success text-white btn-sm"></i>
                                                                    </a>
                                                                    <a href="javascript:void(0)"
                                                                        onclick="assignmentprojectDelete('<?php echo $assignment->id; ?>')"
                                                                        data-toggle="tooltip" title="Delete"><i
                                                                            class="far fa-trash-alt btn-danger  btn-sm"></i></a>
                                                                </td>
                                                            <tr>
                                                                <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                            <!-- <div class="offset-3 mb-3 group-end">
                                                <a class="btn btn-success text-white btnNext " id="v-pills-basic-tab"
                                                    data-toggle="pill"
                                                    href="#v-pills-basic"><?php echo display('next') ?></a>
                                            </div> -->
                                        </div>
                                        <?php } ?>

                                        <!-- <div class="tab-pane fade" id="v-pills-quiz" role="tabpanel"
                                            aria-labelledby="v-pills-quiz-tab">
                                            <div class="form-group row m-r">
                                                <div class="col-md-9">
                                                    <div id="question_area">
                                                        <div class="d-flex mt-2">
                                                            <div class="flex-grow-1 px-3 row">
                                                                <label class="col-md-2"
                                                                    for="question"><?php echo display('question'); ?></label>
                                                                <div class="form-group col-md-10">
                                                                    <input type="text" class="form-control"
                                                                        name="question[]"
                                                                        placeholder="<?php echo display('question'); ?>">
                                                                </div>
                                                                <label class="col-md-2"
                                                                    for="answer"><?php echo display('answer'); ?></label>
                                                                <div class="form-group col-md-6">
                                                                    <select class="form-control" name="qst_ans[]">
                                                                        <option value="">
                                                                            <?php echo display('select_one'); ?>
                                                                        </option>
                                                                        <option value="1"><?php echo display('yes'); ?>
                                                                        </option>
                                                                        <option value="0"><?php echo display('no'); ?>
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="">
                                                                <button type="button"
                                                                    class="btn btn-success text-white btn-sm custom_btn"
                                                                    name="button" onclick="appendQuestion()"> <i
                                                                        class="fa fa-plus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="offset-3 mb-3 group-end">
                                                <a class="btn btn-danger btnPrevious" id="v-pills-media-tab"
                                                    data-toggle="pill"
                                                    href="#v-pills-media"><?php echo display('previous') ?></a>
                                                <input type="submit" class="btn btn-success" id="coursesave_btn"
                                                    value="<?php //echo display('finish'); ?>">
                                            </div>
                                        </div>-->
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                        <!-- end add course -->

                        <!-- Add library -->
                        <div role="tabpanel" class="tab-pane" id="profile">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="nav flex-column nav-pills custom_tablist">
                                        <ul class="nav nav-pills d-inlineblock" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="v-pills-libinfo-tab" data-toggle="pill"
                                                    href="#v-pills-libinfo" role="tab" aria-controls="v-pills-libinfo"
                                                    aria-selected="true"><?php echo display("library_information"); ?></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="v-pills-libpricing-tab" data-toggle="pill"
                                                    href="#v-pills-libpricing" role="tab"
                                                    aria-controls="v-pills-libpricing"
                                                    aria-selected="false"><?php echo display('library_pricing'); ?></a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-9 p-15">
                                    <?php echo form_open_multipart(enterpriseinfo()->shortname . '/library-content-save', 'class="myform" id=""'); ?>
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-libinfo" role="tabpanel"
                                            aria-labelledby="v-pills-libinfo-tab">
                                            <div class="form-group row m-r">
                                                <label for="name"
                                                    class="col-sm-3 font-weight-bold"><?php echo display('name') ?><i
                                                        class="text-danger"> *</i></label>
                                                <div class="col-sm-9">
                                                    <input name="name" class="form-control" type="text"
                                                        placeholder="<?php echo display('name') ?>" id="names">
                                                </div>
                                            </div>
                                            <?php if ($user_type == 1 || $user_type == 2) { ?>
                                            <div class="form-group row m-r">
                                                <label for="faculty_ids"
                                                    class="col-sm-3 font-weight-bold"><?php echo display('faculty') ?><i
                                                        class="text-danger"> *</i></label>
                                                <div class="col-sm-9">

                                                    <select class="form-control placeholder-single" id="faculty_ids"
                                                        name="faculty_id"
                                                        data-placeholder="<?php echo display('select_one'); ?>">
                                                        <option value=""></option>
                                                        <?php foreach ($get_faculty as $faculty) { ?>
                                                        <option
                                                            value="<?php echo html_escape($faculty->faculty_id); ?>">
                                                            <?php echo html_escape($faculty->name); ?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php } else { ?>
                                            <input type="hidden" class="faculty_id" name="faculty_id"
                                                value="<?php echo html_escape($user_id); ?>">
                                            <?php } ?>
                                            <div class="form-group row m-r">
                                                <label for="category_id"
                                                    class="col-sm-3 font-weight-bold"><?php echo display('category') ?>
                                                    <i class="text-danger"> *</i></label>
                                                <div class="col-sm-9">
                                                    <select name="category_id" class="form-control placeholder-single"
                                                        id="category_ids"
                                                        data-placeholder="<?php echo display('select_one'); ?>">
                                                        <option value=""></option>
                                                        <?php foreach ($get_categoryforlibary as $category) { ?>
                                                        <option
                                                            value="<?php echo html_escape($category->category_id); ?>">
                                                            <?php echo html_escape($category->name); ?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row m-r">
                                                <label for="level"
                                                    class="col-sm-3 font-weight-bold"><?php echo display('level') ?><i
                                                        class="text-danger"> *</i>
                                                </label>
                                                <div class="col-sm-9">
                                                    <select name="level" class="form-control placeholder-single"
                                                        id="level"
                                                        data-placeholder="<?php echo display('select_one'); ?>">
                                                        <option value=""></option>
                                                        <option value="1">Basic</option>
                                                        <option value="2">Premium</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row m-r">
                                                <label for="languages"
                                                    class="col-sm-3 font-weight-bold"><?php echo display('language') ?>
                                                </label>
                                                <div class="col-sm-9">
                                                    <select name="language" class="form-control placeholder-single"
                                                        id="languages"
                                                        data-placeholder="<?php echo display('select_one'); ?>">
                                                        <option value=""></option>
                                                        <?php foreach($get_languages as $language_k => $language_val){ ?>
                                                        <option value="<?php echo $language_k; ?>">
                                                            <?php echo $language_val; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row m-r">
                                                <label for="description"
                                                    class="col-sm-3 font-weight-bold"><?php echo display('library') . " " . display('details') ?>
                                                </label>
                                                <div class="col-sm-9">
                                                    <textarea name="description" id="library_description" rows="10"
                                                        cols="80"></textarea>
                                                    <!-- /.Ck Editor -->
                                                </div>
                                            </div>

                                            <div class="form-group row m-r">
                                                <label for="offer_courseids"
                                                    class="col-sm-3 font-weight-bold"><?php echo display('offer') ?>
                                                </label>
                                                <div class="col-sm-9">
                                                    <select name="offer_courseid[]" multiple="multiple"
                                                        class="form-control placeholder-single" id="offer_courseids">
                                                        <?php foreach ($get_librarycourse as $offer_course) { ?>
                                                        <option value="<?php echo $offer_course->library_id; ?>">
                                                            <?php echo $offer_course->name; ?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="form-group row m-r">
                                                <label for="content_provider"
                                                    class="col-sm-3 font-weight-bold"><?php echo display("file_type"); ?><i
                                                        class="text-danger"> *</i>
                                                </label>
                                                <div class="col-sm-9">
                                                    <select name="content_provider"
                                                        class="form-control placeholder-single" id="content_providers"
                                                        data-placeholder="<?php echo display('select_one'); ?>">
                                                        <option value=""></option>
                                                        <option value="1">PDF</option>
                                                        <option value="2">Image</option>
                                                        <option value="3">Doc</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row m-r">
                                                <label for="url"
                                                    class="col-sm-3 font-weight-bold"><?php echo display("file_upload"); ?><i
                                                        class="text-danger"> *</i>
                                                </label>
                                                <div class="col-sm-9">

                                                    <input type="file" name="source" id="source" />


                                                </div>
                                            </div>
                                            <div class="form-group row m-r">
                                                <label for="thumbnail"
                                                    class="col-sm-3 font-weight-bold"><?php echo display('featured_image') ?><i
                                                        class="text-danger"> *</i></label>
                                                <div class="col-sm-4">
                                                    <div>
                                                        <input type="file" name="picture" id="picture" />

                                                    </div>
                                                </div>
                                                <span class="text-danger">( 250×200 )</span>
                                            </div>
                                            <div class="offset-3 mb-3 group-end">
                                                <a class="btn btn-success btnNext " id="v-pills-libpricing-tab"
                                                    data-toggle="pill"
                                                    href="#v-pills-libpricing"><?php echo display('next') ?></a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-libpricing" role="tabpanel"
                                            aria-labelledby="v-pills-libpricing-tab">
                                            <div class="form-group row">
                                                <div class="offset-2 checkbox checkbox-success">
                                                    <input id="is_frees" name="is_free" type="checkbox" value="0">
                                                    <label for="is_frees"><?php echo display("is_free"); ?></label>
                                                </div>
                                            </div>
                                            <div class="dependent_freecourses">
                                                <div class="form-group row">
                                                    <label for="price"
                                                        class="col-sm-2 font-weight-bold"><?php echo display('current') . " " . display('price') ?>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input name="price" class="form-control" type="number"
                                                            placeholder="<?php echo display('price') ?>" id="prices"
                                                            onkeyup="onlynumber_allow(this.value, 'price')">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="oldprice"
                                                        class="col-sm-2 font-weight-bold"><?php echo display('oldprice') ?>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input name="oldprice" class="form-control" type="number"
                                                            placeholder="<?php echo display('oldprice') ?>"
                                                            id="oldprice"
                                                            onkeyup="onlynumber_allow(this.value, 'oldprice')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="offset-2 checkbox checkbox-success">
                                                    <input id="is_discounts" name="is_discount" type="checkbox"
                                                        value="0">
                                                    <label for="is_discounts"
                                                        class="font-weight-bold"><?php echo display('is_discount'); ?></label>
                                                </div>
                                            </div>
                                            <div class="dependent_discountcourses">
                                                <div class="form-group row">
                                                    <label for="discount"
                                                        class="col-sm-2 "><?php echo display('discount'); ?>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input name="discount" class="form-control" type="number"
                                                            placeholder="<?php echo display('discount') ?>"
                                                            id="discounts"
                                                            onkeyup="onlynumber_allow(this.value, 'discount')">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="offset-3 mb-3 group-end">
                                                <a class="btn btn-danger btnPrevious" id="v-pills-libinfo-tab"
                                                    data-toggle="pill"
                                                    href="#v-pills-libinfo"><?php echo display('previous') ?></a>
                                                <input type="submit" class="btn btn-success" id="librarysave"
                                                    value="<?php echo display('finish'); ?>">
                                            </div>
                                        </div>

                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                        <!-- end library -->
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Inline form -->
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

<script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.active.js'); ?>"></script>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/course.js') ?>"></script>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/library.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/dist/js/vimeo-upload.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    // =================== pro_url ==============
    $("#pro_url").on("change", function() {
        var files = Array.from(this.files)
        var fileName = files.map(f => {
            return f.name
        }).join(", ")
        $(this).siblings("#pro_url-custom-file-label").addClass("selected").html(fileName);
    });
    // ==================
    // =================== thumbnail ==============
    $("#thumbnail").on("change", function() {
        var files = Array.from(this.files)
        var fileName = files.map(f => {
            return f.name
        }).join(", ")
        $(this).siblings("#thumbnail-custom-file-label").addClass("selected").html(fileName);
    });
    // ==================
    // =================== hover thumbnail ==============
    $("#hover_thumbnail").on("change", function() {
        var files = Array.from(this.files)
        var fileName = files.map(f => {
            return f.name
        }).join(", ")
        $(this).siblings("#hover-custom-file-label").addClass("selected").html(fileName);
    });
    // ==================
    // =================== cover thumbnail ==============
    $("#cover_thumbnail").on("change", function() {
        var files = Array.from(this.files)
        var fileName = files.map(f => {
            return f.name
        }).join(", ")
        $(this).siblings("#cover_thumbnail-custom-file-label").addClass("selected").html(fileName);
    });
    // ==================
    // =================== syllabus ==============
    $("#syllabus").on("change", function() {
        var files = Array.from(this.files)
        var fileName = files.map(f => {
            return f.name
        }).join(", ")
        $(this).siblings("#syllabus-custom-file-label").addClass("selected").html(fileName);
    });
    // ==================
});

function handleFileSelect(evt) {
    evt.stopPropagation()
    evt.preventDefault()

    var files = evt.dataTransfer ? evt.dataTransfer.files : $(this).get(0).files
    updateProgress(0)
    document.getElementById('progress-container').style.display = 'block';
    $(".btnNext").hide();
    $('#coursesave_btn').hide();
    $("#v-pills-pricing-tab").prop("disabled", true);
    $("#v-pills-pricing-tab").addClass("price_disable");
    var video_name = $("#name").val();
    var description = $("#description").val();

    /* Instantiate Vimeo Uploader */
    (new VimeoUpload({
        name: video_name,
        description: description,
        file: $(".fileuploader")[0].files[0],
        token: '9934bd59f90bb90c5b4b3526cdfa78c9',
        onError: function(data) {
            showMessage(JSON.parse(data).error, 'error');
        },
        onProgress: function(data) {
            updateProgress(data.loaded / data.total)
        },
        onComplete: function(videoId, index) {
            var url = 'https://vimeo.com/' + videoId
            $('#url').val(url);
            var type_id = $("#course_type").val();
            document.getElementById('trailervideo_delete_content').style.display = 'block';

            if (type_id == 2 || type_id == 3 || type_id == 4) {


                $("#v-pills-pricing-tab").prop("disabled", true);
                $('.btnNext').hide();
                $('#coursesave_btn').show();
                $("#v-pills-pricing-tab").addClass("price_disable");
            } else {


                $("#v-pills-pricing-tab").prop("disabled", false);
                $("#v-pills-pricing-tab").removeClass("price_disable");
                $('.btnNext').show();
                $('.finishoff').hide();
            }

            showMessage("Promotional video uploaded successfully", 'success');

        }
    })).upload()

    /* local function: show a user message */
    function showMessage(html, type) {
        /* hide progress bar */
        document.getElementById('progress-container').style.display = 'none'
        toastr.success(html);
    }
}



/**
 * Updat progress bar.
 */
function updateProgress(progress) {
    progress = Math.floor(progress * 100)
    var element = document.getElementById('progress')
    element.setAttribute('style', 'width:' + progress + '%')
    element.innerHTML = '&nbsp;' + progress + '%'
}
/**
 * Wire up drag & drop listeners once page loads
 */
document.addEventListener('DOMContentLoaded', function() {
    var browse = document.getElementById('pro_url')
    browse.addEventListener('change', handleFileSelect, false)
});


function cancel_trailer_video() {
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var vurl = $('#url').val();
    var vID = vurl.split('/');
    var videoID = vID[3];
    var url = $("#base_url").val();
    var enterprise_shortname = $("#enterprise_shortname").val();
    var r = confirm("Are you sure?");
    if (r == true) {
        $.ajax({
            url: url + enterprise_shortname + "/instructor-delete-video",
            type: "POST",
            data: {
                video_id: videoID,
                csrf_test_name: csrf_test_name
            },
            success: function(data) {
                toastr.success(data);
                document.getElementById('trailervideo_delete_content').style.display = 'none';
                $('#url').val('');

            },
            error: function(xhr) {
                alert('failed!');
            }
        });
    }
}
</script>