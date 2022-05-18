<link rel="stylesheet" href="<?php echo base_url('application/modules/dashboard/assets/css/event.css') ?>">
<div class="row">
    <div class="col-sm-12 col-md-12">
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
            ?>
        </div>
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?>
                    <small class="float-right">
                        <a href="<?php echo base_url(enterpriseinfo()->shortname.'/forum-list'); ?>" class="btn btn-success">
                            <?php echo display('forum_list'); ?>
                        </a>
                    </small>
                </h4>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart(enterpriseinfo()->shortname.'/forum-update', 'class="myform" id="myform"'); ?>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="title') " class="col-sm-5"><?php echo display('title') ?> <i class="text-danger">
                                *</i></label>
                        <div class="col-sm-9">
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="<?php echo display('title'); ?>"
                                value="<?php echo html_escape($edit_forumdata->title); ?>" required>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="category_id" class="col-sm-4"><?php echo display('category') ?> <i
                                class="text-danger"> *</i></label>
                        <div class="col-sm-9">
                            <select class="form-control placeholder-single" name="category_id" id="category_id"
                                data-placeholder="<?php echo display('select_one'); ?>" required>
                                <option value=""></option>
                                <?php foreach ($get_forumcategory as $forumcategory) { ?>
                                <option value="<?php echo html_escape($forumcategory->forum_category_id); ?>" <?php
                                    if ($edit_forumdata->category_id == $forumcategory->forum_category_id) {
                                        echo "selected";
                                    }
                                    ?>>
                                    <?php echo html_escape($forumcategory->title); ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="description" class="col-sm-4"><?php echo display('description') ?> </label>
                        <div class="col-sm-12">
                            <input type="hidden" id="forumckeditor" value="1">
                            <textarea name="description" id="forumdescription" class="form-control" rows="10" cols="80"
                                required><?php echo html_escape($edit_forumdata->description); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="picture" class="col-sm-4"><?php echo display('picture') ?> <i class="text-danger">
                            </i></label>
                        <div class="col-sm-8">
                            <input type="file" name="picture" id="picture" class="custom-input-file" onchange="fileValueOne(this,'editforum')" />
                            <label for="picture">
                                <i class="fa fa-upload"></i>
                                <span><?php echo display('choose_file'); ?>…</span>
                            </label>
                            <?php if ($edit_forumdata->picture) { ?>
                            <div class="img_border">
                                <img src="<?php echo base_url(html_escape($edit_forumdata->picture)); ?>"
                                    alt="<?php echo html_escape($edit_forumdata->title); ?>" width="30%">
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="is_front" class="col-sm-4"><?php echo display('is_front') ?> <i class="text-danger">
                            </i></label>
                        <div class="col-sm-8">
                            <select class="form-control placeholder-single" id="is_front" name="is_front"
                                data-placeholder="-- select one --">
                                <option value=""></option>
                                <option value="1" <?php
                                if ($edit_forumdata->is_front == 1) {
                                    echo 'selected';
                                }
                                ?>><?php echo display('yes'); ?></option>
                                <option value="0" <?php
                                if ($edit_forumdata->is_front == 0) {
                                    echo 'selected';
                                }
                                ?>><?php echo display('no'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="is_slide" class="col-sm-4"><?php echo display('is_slide') ?> <i class="text-danger">
                            </i></label>
                        <div class="col-sm-8">
                            <select class="form-control placeholder-single" id="is_slide" name="is_slide"
                                data-placeholder="-- select one --">
                                <option value=""></option>
                                <option value="1" <?php
                                if ($edit_forumdata->is_slide == 1) {
                                    echo 'selected';
                                }
                                ?>><?php echo display('yes'); ?>
                                </option>
                                <option value="0" <?php
                                if ($edit_forumdata->is_slide == 0) {
                                    echo 'selected';
                                }
                                ?>><?php echo display('no'); ?>
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="picture" class="col-sm-4"><i class="text-danger"> </i></label>
                        <div class="col-sm-8">
                            <img id="image-preview-editforum" src="" alt="" class="border border-2" width="200px">
                        </div>
                    </div>
                </div>
                <div class="form-group text-right">
                    <input type="hidden" name="forum_id" value="<?php echo html_escape($edit_forumdata->forum_id); ?>">
                    <button type="submit" class="btn btn-success w-md m-b-5"
                        id="forumdisabled_btn"><?php echo display('save') ?></button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/forum.js') ?>"></script>