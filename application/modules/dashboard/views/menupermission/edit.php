<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd ">
            <div class="panel-heading">
                <div class="panel-title">

                </div>
            </div>
            <div class="panel-body">
                <?php echo form_open_multipart("#", array('id' => 'myform')) ?>
                <div class="form-group row">
                    <label for="menu_title" class="col-sm-3 col-form-label"><?php echo display('menu_title') ?></label>
                    <div class="col-sm-9">
                        <input name="menu_title" id="edit_menu_title"
                            value="<?php echo html_escape($menu_item->menu_title); ?>" class="form-control" type="text">
                    </div>
                </div>
                <input type="hidden" name="menu_id" id="menu_id"
                    value="<?php echo html_escape($menu_item->menu_id); ?>">
                <div class="form-group row">
                    <label for="page_url" class="col-sm-3 col-form-label"><?php echo display('page_url') ?></label>
                    <div class="col-sm-9">
                        <input name="page_url" id="edit_page_url"
                            value="<?php echo html_escape($menu_item->page_url); ?>" class="form-control" type="text">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="module" class="col-sm-3 col-form-label"><?php echo display('module') ?></label>
                    <div class="col-sm-9">
                        <input name="module" id="edit_module" value="<?php echo html_escape($menu_item->module); ?>"
                            class="form-control" type="text">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ordering" class="col-sm-3 col-form-label"><?php echo display('ordering'); ?></label>
                    <div class="col-sm-9">
                        <select class="form-control ordering placeholder-single" id="edit_ordering"
                            data-placeholder="-- select one --" name="ordering">
                            <option value=""></option>
                            <?php for ($i = 1; $i < 51; $i++) { ?>
                            <option value="<?php echo $i; ?>" <?php
                                if ($menu_item->ordering == $i) {
                                    echo 'selected';
                                }
                                ?>>
                                <?php echo $i; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="parent_menu"
                        class="col-sm-3 col-form-label"><?php echo display('parent_menu') ?></label>
                    <div class="col-sm-9">
                        <select class="form-control placeholder-single" name="parent_menu" id="edit_parent_menu"
                            data-placeholder="<?php echo display('select_one'); ?>">
                            <option value=""></option>
                            <?php foreach ($p_menu as $val) { ?>
                            <option value="<?php echo $val->menu_id; ?>" <?php
                                if ($menu_item->parent_menu == $val->menu_id) {
                                    echo 'selected';
                                }
                                ?>>
                                <?php echo html_escape($val->menu_title); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="is_homesetting"
                        class="col-sm-3 col-form-label">Is Home Setting </label>
                    <div class="col-sm-8">
                        <select class="form-control placeholder-single" name="is_homesetting" id="editis_homesetting"
                            data-placeholder="<?php echo display('select_one'); ?>">
                            <option value="0" <?php echo (($menu_item->is_homesetting == 0) ? 'selected' : ''); ?>>
                                <?php echo display('no'); ?></option>
                            <option value="1" <?php echo (($menu_item->is_homesetting == 1) ? 'selected' : ''); ?>>
                                <?php echo display('yes'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="is_settings"
                        class="col-sm-3 col-form-label"><?php echo display('is_settings') ?></label>
                    <div class="col-sm-8">
                        <select class="form-control placeholder-single" name="is_settings" id="is_settings"
                            data-placeholder="<?php echo display('select_one'); ?>">
                            <option value="0" <?php echo (($menu_item->is_settings == 0) ? 'selected' : ''); ?>>
                                <?php echo display('no'); ?></option>
                            <option value="1" <?php echo (($menu_item->is_settings == 1) ? 'selected' : ''); ?>>
                                <?php echo display('yes'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="is_role" class="col-sm-3 col-form-label"><?php echo display('is_role') ?></label>
                    <div class="col-sm-8">
                        <select class="form-control placeholder-single" name="is_role" id="is_role"
                            data-placeholder="<?php echo display('select_one'); ?>">
                            <option value="0" <?php echo (($menu_item->is_role == 0) ? 'selected' : ''); ?>>
                                <?php echo display('no'); ?></option>
                            <option value="1" <?php echo (($menu_item->is_role == 1) ? 'selected' : ''); ?>>
                                <?php echo display('yes'); ?></option>
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="icon" class="col-sm-3 col-form-label"><?php echo display('icon'); ?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon Class"
                            value="<?php echo html_escape($menu_item->icon); ?>">
                    </div>
                    <div class="col-sm-1">
                        <a href="javascript:void()"
                            onclick="window.open('<?php echo base_url(enterpriseinfo()->shortname .'/icon-load'); ?>', '_blank', 'width=1000,height=600,scrollbars=yes,menubar=no,status=yes,resizable=yes,screenx=100,screeny=10'); return false;"
                            class="btn btn-primary btn-sm"><?php echo display('library'); ?> </a>
                    </div>
                </div>
                <div class="form-group text-right">
                    <button type="button" class="btn btn-success w-md m-b-5"
                        onclick="menuupdate()"><?php echo display('update') ?></button>
                </div>
                <?php echo form_close() ?>

            </div>
        </div>
    </div>
</div>