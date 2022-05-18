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
            unset($_SESSION['success']);
        }
        if ($file_uploaderror != '') {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>$file_uploaderror</div>";
        }
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        ?>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
            <?php echo html_escape((!empty($title) ? $title : null)) ?>
            </div>

            <div class="row">

                <div class="col-md-12">
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
                                            href="#v-pills-libpricing" role="tab" aria-controls="v-pills-libpricing"
                                            aria-selected="false"><?php echo display('library_pricing'); ?></a>
                                    </li>

                                </ul>
                            </div>

                        </div>
                        <div class="col-sm-9 p-15">
                            <?php echo form_open_multipart(enterpriseinfo()->shortname . '/library-content-update', 'class="myform" id=""'); ?>
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-libinfo" role="tabpanel"
                                    aria-labelledby="v-pills-libinfo-tab">
                                    <div class="form-group row m-r">
                                        <label for="name" class="col-sm-3"><?php echo display('name') ?><i
                                                class="text-danger"> *</i></label>
                                        <div class="col-sm-9">
                                            <input name="name" class="form-control" type="text"
                                                placeholder="<?php echo display('name') ?>" id="name"
                                                value="<?php echo $edit_data->name; ?>">
                                        </div>
                                    </div>
                                    <?php if ($user_type == 1 || $user_type == 2) { ?>
                                    <div class="form-group row m-r">
                                        <label for="faculty_ids" class="col-sm-3"><?php echo display('faculty') ?><i
                                                class="text-danger"> *</i></label>
                                        <div class="col-sm-9">
                                            <select class="form-control placeholder-single" id="faculty_ids"
                                                name="faculty_id"
                                                data-placeholder="<?php echo display('select_one'); ?>">
                                                <option value=""></option>
                                                <?php foreach ($get_faculty as $faculty) { ?>
                                                <option value="<?php echo html_escape($faculty->faculty_id); ?>"
                                                    <?php if ($edit_data->faculty_id == $faculty->faculty_id) { echo "selected";} ?>>
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
                                        <label for="category_id" class="col-sm-3"><?php echo display('category') ?> <i
                                                class="text-danger"> *</i></label>
                                        <div class="col-sm-9">
                                            <select name="category_id" class="form-control placeholder-single"
                                                id="category_ids"
                                                data-placeholder="<?php echo display('select_one'); ?>">
                                                <option value=""></option>
                                                <?php foreach ($get_categoryforlibary as $category) { ?>
                                                <option value="<?php echo html_escape($category->category_id); ?>"
                                                    <?php if ($edit_data->category_id == $category->category_id) { echo "selected";} ?>>
                                                    <?php echo html_escape($category->name); ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row m-r">
                                        <label for="level" class="col-sm-3"><?php echo display('level') ?><i class="text-danger"> *</i>
                                        </label>
                                        <div class="col-sm-9">
                                            <select name="level" class="form-control placeholder-single" id="level"
                                                data-placeholder="<?php echo display('select_one'); ?>">
                                                <option value=""></option>
                                                <option value="1" <?php if ($edit_data->level == 1) {
                                                                        echo "selected";
                                                                    } ?>>Basic</option>
                                                <option value="2" <?php if ($edit_data->level == 2) {
                                                                        echo "selected";
                                                                    } ?>>Premium</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row m-r">
                                        <label for="languages" class="col-sm-3"><?php echo display('language') ?>
                                        </label>
                                        <div class="col-sm-9">
                                            <select name="language" class="form-control placeholder-single"
                                                id="language" data-placeholder="<?php echo display('select_one'); ?>">
                                                <option value=""></option>
                                                <option value="english" <?php if ($edit_data->language == 'english') {
                                                                            echo 'selected';
                                                                        } ?>>English</option>
                                                <option value="urdu" <?php if ($edit_data->language == 'urdu') {
                                                                            echo 'selected';
                                                                        } ?>>Urdu</option>
                                                <option value="bangla" <?php if ($edit_data->language == 'bangla') {
                                                                            echo 'selected';
                                                                        } ?>>Bangla</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row m-r">
                                        <label for="description"
                                            class="col-sm-3"><?php echo display('library') . " " . display('details') ?>
                                        </label>
                                        <div class="col-sm-9">
                                            <textarea name="description" id="description" rows="10"
                                                cols="80"><?php echo html_escape($edit_data->details); ?></textarea>
                                            <!-- /.Ck Editor -->
                                        </div>
                                    </div>
                                    <?php
                                    
                                    $offer_courseid = json_decode($edit_data->offer_courseid);
                                    ?>
                                    <div class="form-group row m-r">
                                        <label for="offer_courseids" class="col-sm-3"><?php echo display('offer') ?>
                                        </label>
                                        <div class="col-sm-9">
                                            <select name="offer_courseid[]" class="form-control placeholder-single"
                                                id="offer_courseids" placeholder="<?php echo display('select_one'); ?>"
                                                multiple="multiple">
                                                <option value=""></option>
                                                <?php foreach ($get_librarycourse as $offer_course) {
                                                     if(in_array($offer_course->library_id, $offer_courseid)) {
                                                ?>
                                                <option value="<?php echo $offer_course->library_id; ?>" <?php if(in_array($offer_course->library_id, $offer_courseid)) {echo "selected";} ?>>
                                                    <?php echo $offer_course->name; ?>
                                                </option>
                                                <?php }else{?>
                                                    <option value="<?php echo $offer_course->library_id; ?>">
                                                    <?php echo $offer_course->name; ?>
                                                </option>
                                                <?php }}?>
                                            </select>
                                           
                                        </div>
                                    </div>

                                    <div class="form-group row m-r">
                                        <label for="content_provider" class="col-sm-3"><?php echo display("file_type"); ?><i
                                                class="text-danger"> *</i>
                                        </label>
                                        <div class="col-sm-9">
                                            <select name="content_provider" class="form-control placeholder-single"
                                                id="content_provider"
                                                data-placeholder="<?php echo display('select_one'); ?>">
                                                <option value=""></option>
                                                <option value="1" <?php if ($edit_data->content_provider == 1) {
                                                                        echo "selected";
                                                                    } ?>>PDF</option>
                                                <option value="2" <?php if ($edit_data->content_provider == 2) {
                                                                        echo "selected";
                                                                    } ?>>Image</option>
                                                <option value="3" <?php if ($edit_data->content_provider == 3) {
                                                                        echo "selected";
                                                                    } ?>>Doc</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row m-r">
                                        <label for="url" class="col-sm-3"><?php echo display("file_upload"); ?><i
                                                class="text-danger"> *</i>
                                        </label>
                                        <div class="col-sm-4">
                                           
                                            <div>
                                                <input type="file" name="source" id="sourceimage"
                                                    class="custom-input-file" />
                                                <label for="sourceimage">
                                                    <i class="fa fa-upload"></i>
                                                    <span><?php echo display('choose_file'); ?>…</span>
                                                </label>
                                            </div>
                                            <?php if ($edit_data->source) { ?>
                                            <div class="img_border">
                                                <input type="hidden"
                                                    value="<?php echo html_escape($edit_data->source); ?>"
                                                    name="oldsource">
                                                <img src="<?php echo base_url(html_escape($edit_data->source)); ?>"
                                                    alt="<?php echo html_escape($edit_data->name); ?>" width="20%">
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row m-r">

                                        <label for="thumbnails"
                                            class="col-sm-3"><?php echo display('featured_image') ?><i
                                                class="text-danger"> *</i></label>
                                        <div class="col-sm-4">
                                            <div>
                                                <input type="file" name="picture" id="thumbnails"
                                                    class="custom-input-file" />
                                                <label for="thumbnails">
                                                    <i class="fa fa-upload"></i>
                                                    <span><?php echo display('choose_file'); ?>…</span>
                                                </label>
                                            </div>

                                            <?php if ($edit_data->picture) { ?>
                                            <div class="img_border">
                                                <img src="<?php echo base_url(html_escape($edit_data->picture)); ?>"
                                                    alt="<?php echo html_escape($edit_data->name); ?>" width="20%">
                                            </div>
                                            <?php } ?>
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
                                            <input id="is_free" name="is_free" type="checkbox"
                                                value="<?php echo html_escape($edit_data->is_free); ?>"
                                                <?php if ($edit_data->is_free == 1) { echo 'checked';}?>>
                                            <label for="is_free"><?php echo display("is_free"); ?></label>
                                        </div>
                                    </div>
                                    <div class="dependent_freecourse">
                                        <?php if ($edit_data->is_free == 0) { ?>
                                        <div class="form-group row">
                                            <label for="price"
                                                class="col-sm-2"><?php echo display('current') . " " . display('price') ?>
                                            </label>
                                            <div class="col-sm-6">
                                                <input name="price" class="form-control" type="number"
                                                    placeholder="<?php echo display('price') ?>" id="price"
                                                    onkeyup="onlynumber_allow(this.value, 'price')"
                                                    value="<?php echo html_escape($edit_data->price); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="oldprice" class="col-sm-2"><?php echo display('oldprice') ?>
                                            </label>
                                            <div class="col-sm-6">
                                                <input name="oldprice" class="form-control" type="number"
                                                    placeholder="<?php echo display('oldprice') ?>" id="oldprice"
                                                    onkeyup="onlynumber_allow(this.value, 'oldprice')"
                                                    value="<?php echo html_escape($edit_data->oldprice); ?>">
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                  
                                    <div class="form-group row">
                                        <div class="offset-2 checkbox checkbox-success">
                                            <input id="is_discount" name="is_discount" type="checkbox"
                                                value="<?php echo $edit_data->is_discount; ?>"
                                                <?php echo (($edit_data->is_discount == 1) ? 'checked' : ''); ?>>
                                            <label for="is_discount"><?php echo display('is_discount'); ?></label>
                                        </div>
                                    </div>
                                    <div class="dependent_discountcourse">
                                        <?php if ($edit_data->is_discount == 1) { ?>
                                        <div class="form-group row">
                                            <label for="discount" class="col-sm-2"><?php echo display('discount'); ?>
                                            </label>
                                            <div class="col-sm-9">
                                                <input name="discount" class="form-control" type="number"
                                                    placeholder="<?php echo display('discount') ?>" id="discount"
                                                    onkeyup="onlynumber_allow(this.value, 'discount')" value="<?php echo $edit_data->discount;?>">
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>

                                    <div class="offset-3 mb-3 group-end">
                                        <input type="hidden" name="library_id" id="library_id"
                                            value="<?php echo html_escape($edit_data->library_id); ?>">
                                        <a class="btn btn-danger btnPrevious" id="v-pills-libinfo-tab"
                                            data-toggle="pill"
                                            href="#v-pills-libinfo"><?php echo display('previous') ?></a>


                                        <input type="submit" class="btn btn-success" id="libraryupdate"
                                            value="<?php echo display('finish'); ?>">
                                    </div>
                                </div>

                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Inline form -->
</div>

<script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.active.js'); ?>"></script>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/library_edit.js') ?>"></script>
