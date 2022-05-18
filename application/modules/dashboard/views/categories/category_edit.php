<link rel="stylesheet" href="<?php echo base_url('application/modules/dashboard/assets/css/common.css') ?>">
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?></h4>
            </div>
            <div class="card-body">
                <?php //d($edit_data); ?>
                <?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label"><?php echo display('name') ?> <i
                            class="text-danger"> * </i></label>
                    <div class="col-sm-6">
                        <input name="name" class="form-control" type="text"
                            value="<?php echo html_escape($edit_data->name); ?>"
                            placeholder="<?php echo display('name') ?>" id="name">
                    </div>
                </div>
                <?php if($edit_data->parent_id){ ?>
                <div class="form-group row">
                    <label for="parent_id" class="col-sm-3 col-form-label"><?php echo display('category') ?> </label>
                    <div class="col-sm-6">
                        <select name="parent_id" class="form-control placeholder-single"
                            data-placeholder="<?php echo display('select_one'); ?>" id="parent_id">
                            <option value=""></option>
                            <?php
                            foreach ($parent_category as $parent) {
                                ?>
                            <option value="<?php echo html_escape($parent->category_id); ?>" <?php
                                if ($edit_data->parent_id == $parent->category_id) {
                                    echo 'selected';
                                }
                                ?>>
                                <?php echo html_escape($parent->name); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <?php }else{ ?>
                <input type="hidden" id="parent_id">
                <?php } ?>
                <!-- <div class="form-group row">
                    <label for="ordering" class="col-sm-3 col-form-label"><?php echo display('ordering'); ?></label>
                    <div class="col-sm-6">
                        <select class="form-control ordering placeholder-single" id="ordering"
                            data-placeholder="-- select one --" name="ordering">
                            <option value=""></option>
                            <?php for ($i = 1; $i < 51; $i++) { ?>
                            <option value="<?php echo $i; ?>"
                                <?php echo (($edit_data->ordering == $i) ? 'selected' : ''); ?>>
                                <?php echo $i; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div> -->
                <!-- <div class="form-group row">
                    <label for="category_type" class="col-sm-3 col-form-label"><?php echo 'Category Type' ?><i
                            class="text-danger"> *</i></label>
                    <div class="col-sm-6">
                        <select name="category_type" class="form-control placeholder-single" id="category_type"
                            data-placeholder="<?php echo display('select_one'); ?>">
                            <option value=""></option>
                            <option value="1" <?php if($edit_data->category_type==1){ echo html_escape("Selected");}?>>
                                <?php  echo html_escape("Is Course");?></option>
                        </select>
                    </div>
                </div> -->
                <input type="hidden" name="category_type" id="category_type" value="1">
                <div class="form-group row">
                    <label for="icon" class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <div class="checkbox checkbox-success">
                            <input id="is_popular" type="checkbox" class="is_popular"
                                value="<?php echo $edit_data->is_popular; ?>"
                                <?php echo (($edit_data->is_popular == 1) ? 'checked' : ''); ?>>
                            <label for="is_popular"><?php echo 'Add to Explore'; ?></label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="image" class="col-sm-3 col-form-label"><?php echo display('image') ?></label>
                    <div class="col-sm-6">
                        <div>
                            <input type="file" name="image" id="image" class="custom-input-file"
                                onchange="fileValueOne(this,'editcategory')" />
                            <label for="image">
                                <i class="fa fa-upload"></i>
                                <span class='filename'><?php echo display('choose_file'); ?>…</span>
                            </label>
                        </div>
                        <span class="text-danger">Size:( 966x180 ) Formats:(png,jpeg,jpeg)</span>
                        <?php if ($edit_data->picture) { ?>
                        <div class="img_border">
                            <img src="<?php echo base_url(html_escape($edit_data->picture)); ?>"
                                alt="<?php echo html_escape($edit_data->name); ?>" width="20%">
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="image" class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-6">
                        <div>
                            <img id="image-preview-editcategory" src="" alt="" class="border border-2" width="200px">
                        </div>
                    </div>
                    <div class="col-sm-offset-3 col-sm-5 text-right">
                        <button type="button" class="btn btn-success w-md m-b-5"
                            onclick="category_update('<?php echo html_escape($edit_data->category_id); ?>')"><?php echo display('update') ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('application/modules/dashboard/assets/js/category.js') ?>"></script>