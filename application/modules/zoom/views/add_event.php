<link href="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css'); ?>"
    rel="stylesheet">
<div class="row">
    <div class="col-sm-12">
        <?php
        $error = $this->session->flashdata('error');
        $success = $this->session->flashdata('success');
        if ($error != '') {
            echo $error;
            unset($_SESSION['error']);
        }
        if ($success != '') {
            echo $success;
            unset($_SESSION['success']);
        }
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    <i class="fas fa-video"> </i> <?php echo (!empty($title) ? $title : null) ?>
                    <small class="float-right">
                        <a href="<?php echo base_url(enterpriseinfo()->shortname .'/event-list'); ?>"
                            class="btn btn-success-soft">
                            <?php echo display('event_list'); ?>
                        </a>
                    </small>
                </h5>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart(enterpriseinfo()->shortname .'/live-event-save', 'class="myform" id="myform"'); ?>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label for="is_livecourse"
                                class="col-sm-3"><?php echo display('live') . ' ' . display('type') ?><i
                                    class="text-danger"> *</i></label>
                            <div class="col-sm-9">
                                <select class="form-control placeholder-single" id="is_livecourse" name="is_livecourse"
                                    data-placeholder="<?php echo display('select_one'); ?>" required>
                                    <option value=""></option>
                                    <option value="1">Live Course</option>
                                    <option value="2" selected>Live Event</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label for="name" class="col-sm-3"><?php echo display('title') ?><i class="text-danger">
                                    *</i></label>
                            <div class="col-sm-9">
                                <input name="name" class="form-control" type="text"
                                    placeholder="<?php echo display('name') ?>" id="name">
                            </div>
                        </div>
                    </div>
                    <?php if ($user_type == 1 || $user_type == 2) { ?>
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label for="faculty_id" class="col-sm-3"><?php echo display('instructor') ?><i
                                    class="text-danger"> *</i></label>
                            <div class="col-sm-9">
                                <select class="form-control placeholder-single" id="faculty_id" name="faculty_id"
                                    data-placeholder="<?php echo display('select_one'); ?>">
                                    <option value=""></option>
                                    <?php foreach ($get_faculty as $faculty) { ?>
                                    <option value="<?php echo html_escape($faculty->faculty_id); ?>">
                                        <?php echo html_escape($faculty->name); ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php } else { ?>
                    <input type="hidden" class="faculty_id" name="faculty_id"
                        value="<?php echo html_escape($user_id); ?>">
                    <?php } ?>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label for="meeting_id" class="col-sm-3"><?php echo display('event_id') ?> <i
                                    class="text-danger"> *</i></label>
                            <div class="col-sm-9">
                            <input name="meeting_id" class="form-control" type="text"
                    placeholder="<?php echo display('meeting_id') ?>" id="meeting_id"
                    value="<?php //echo get_zoomconfig(get_enterpriseid())->meetingid; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label for="meeting_password" class="col-sm-3"><?php echo display('event_password') ?></label>
                            <div class="col-sm-9">
                            <input name="meeting_password" class="form-control" type="text"
                    placeholder="<?php echo display('meeting_password') ?>" id="meeting_password"
                    value="<?php //echo get_zoomconfig(get_enterpriseid())->meeting_password; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <input name="meeting_id" class="form-control" type="text"
                    placeholder="<?php //echo display('meeting_id') ?>" id="meeting_id"
                    value="<?php //echo get_zoomconfig(get_enterpriseid())->meetingid; ?>">
                <input name="meeting_password" class="form-control" type="text"
                    placeholder="<?php //echo display('meeting_password') ?>" id="meeting_password"
                    value="<?php //echo get_zoomconfig(get_enterpriseid())->meeting_password; ?>"> -->
                <div class="row">
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label for="start_date" class="col-sm-3"><?php echo display('start_date') ?> <i
                                    class="text-danger"> *</i></label>
                            <div class="col-sm-9">
                                <input name="start_date" class="form-control datepicker" type="text" placeholder=""
                                    id="start_date" placeholder="YYYY-MM-DD">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label for="end_date" class="col-sm-3"><?php echo display('end_date') ?> <i
                                    class="text-danger"> *</i></label>
                            <div class="col-sm-9">
                                <input name="end_date" class="form-control datepicker" type="text" placeholder=""
                                    id="end_date" placeholder="YYYY-MM-DD">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label for="start_time" class="col-sm-3"><?php echo display('start_time') ?> <i
                                    class="text-danger"> *</i></label>
                            <div class="col-sm-9">
                                <input name="start_time" class="form-control time_picker" type="text"
                                    placeholder="<?php echo display('start_time') ?>" id="start_time">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label for="end_time" class="col-sm-3"><?php echo display('end_time') ?> <i
                                    class="text-danger"> *</i></label>
                            <div class="col-sm-9">
                                <input name="end_time" class="form-control time_picker" type="text"
                                    placeholder="<?php echo display('end_time') ?>" id="end_time">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label for="category_id" class="col-sm-3"><?php echo display('category') ?> <i
                                    class="text-danger"> *</i></label>
                            <div class="col-sm-9">
                                <select name="category_id" class="form-control placeholder-single" id="category_id"
                                    onchange="category_wise_subcategory(this.value)"
                                    data-placeholder="<?php echo display('select_one'); ?>" required>
                                    <option value=""></option>
                                    <?php foreach ($parent_category as $category) { ?>
                                    <option value="<?php echo html_escape($category->category_id); ?>">
                                        <?php echo html_escape($category->name); ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label for="subcategory_id" class="col-sm-3">Sub category </label>
                            <div class="col-sm-9">
                                <select name="subcategory_id" class="form-control placeholder-single"
                                    id="subcategory_id" data-placeholder="<?php echo display('select_one'); ?>">
                                    <option value=""></option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label for="course_level" class="col-sm-3"><?php echo display('event_level') ?> </label>
                            <div class="col-sm-9">
                                <select name="course_level" class="form-control placeholder-single" id="course_level"
                                    data-placeholder="<?php echo display('select_one'); ?>">
                                    <option value=""></option>
                                    <option value="1">Beginner</option>
                                    <option value="2">Intermediate</option>
                                    <option value="3">Advanced</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-group col-sm-6">
                        <div class="form-group row m-r">
                            <div class="offset-3 checkbox checkbox-success">
                                <input id="is_free" name="is_free" type="checkbox" value="0">
                                <label for="is_free"><?php echo display('is_free_course'); ?></label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label class="col-sm-3"
                                for="requirements"><?php echo display('event') . " " . display('requirements'); ?></label>
                            <div class="col-sm-8">
                                <div id="requirement_area">
                                    <div class="d-flex mt-2">
                                        <div class="flex-grow-1 px-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="requirements[]"
                                                    id="requirements"
                                                    placeholder="<?php echo display('course') . " " . display('requirements'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <button type='button' class='btn btn-danger btn-sm custom_btn m-t-0'
                                                name='button' onclick='removeRequirement(this)'>
                                                <i class='fa fa-minus'></i> </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <a href="javascript:void(0)" class="btn btn-success btn-sm custom_btn mt-2"
                                    onclick="appendRequirement()"><i class="fa fa-plus"></i> </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label class="col-md-3" for="outcomes"><?php echo display('what_you_will_learn'); ?></label>
                            <div class="col-md-8">
                                <div id="outcomes_area">
                                    <div class="d-flex mt-2">
                                        <div class="flex-grow-1 px-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="benifits[]" id="outcomes"
                                                    placeholder="<?php echo display('what_you_will_learn'); ?>">
                                            </div>
                                        </div>
                                        <div class="">
                                        <button type='button' class='btn btn-danger btn-sm custom_btn m-t-0'
                                                name='button' onclick='removeOutcome(this)'>
                                                <i class='fa fa-minus'></i> </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1">
                            <button type="button" class="btn btn-success btn-sm custom_btn mt-2"
                                                name="button" onclick="appendOutcome()"> <i class="fa fa-plus"></i>
                                            </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label for="thumbnail" class="col-sm-3"><?php echo display('featured_image') ?><i
                                    class="text-danger"> *</i></label>
                            <div class="col-sm-4">
                                <div>
                                    <input type="file" name="thumbnail" id="thumbnail" class="custom-input-file"
                                        onchange="fileValueOne(this,'event')" />
                                    <label for="thumbnail">
                                        <i class="fa fa-upload"></i>
                                        <span class="thumbnail-filename"><?php echo display('choose_file'); ?>???</span>
                                    </label>
                                </div>
                            </div>
                            <span class="text-danger">( 422??171 formats: gif,png,jpg,jpeg,svg )</span>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="image" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div>
                                    <img id="image-preview-event" src="" alt="" class="border border-2" width="200px">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label for="cover_thumbnail" class="col-sm-3">Cover Image<i class="text-danger"> *</i></label>
                            <div class="col-sm-4">
                                <div>
                                    <input type="file" name="cover_thumbnail" id="cover_thumbnail" class="custom-input-file"
                                        onchange="fileValueOne(this,'coverevent')" />
                                    <label for="cover_thumbnail">
                                        <i class="fa fa-upload"></i>
                                        <span class="cover-filename"><?php echo display('choose_file'); ?>???</span>
                                    </label>
                                </div>
                            </div>
                            <span class="text-danger">( 1903??287 formats: gif,png,jpg,jpeg,svg )</span>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="image" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div>
                                    <img id="image-preview-coverevent" src="" alt="" class="border border-2" width="200px">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row dependent_freecourse">
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label for="price"
                                class="col-sm-3"><?php echo display('current') . " " . display('price') ?> </label>
                            <div class="col-sm-9">
                                <input name="price" class="form-control" type="number"
                                    placeholder="<?php echo display('price') ?>" id="price"
                                    onkeyup="onlynumber_allow(this.value, 'price')">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label for="oldprice" class="col-sm-3"><?php echo display('oldprice') ?> </label>
                            <div class="col-sm-9">
                                <input name="oldprice" class="form-control" type="number"
                                    placeholder="<?php echo display('oldprice') ?>" id="oldprice"
                                    onkeyup="onlynumber_allow(this.value, 'oldprice')">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label for="description"
                                class="col-sm-3"><?php echo display('event') . " " . display('details') ?> </label>
                            <div class="col-sm-9">
                                <textarea name="description" id="description" rows="10" cols="65"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <?php if ($user_type == 1) { ?>
                            <div class="form-group row m-r">
                                <div class="checkbox checkbox-success">
                                    <input id="is_popular" type="checkbox" name="is_popular" value="0">
                                    <label for="is_popular"><?php echo display('is_popular'); ?></label>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="form-group offset-3 col-sm-2">
                    <button type="submit" class="btn btn-info w-md m-b-5" id="coursesave_btn" onclick=""
                        tabindex=""><?php echo display('save'); ?></button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- <script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.active.js'); ?>"></script> -->
<script src="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/moment.js'); ?>" type="text/javascript">
</script>
<script src="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js'); ?>">
</script>
<script src="<?php echo base_url('application/modules/zoom/assets/js/script.js') ?>"></script>