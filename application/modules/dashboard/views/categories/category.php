<div class="row">
    <!-- Form controls -->
    <div class="col-sm-12">
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
            ?>
        </div>
        <div class="modal" id="myModal">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo display('add_category'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label"><?php echo display('name') ?> <i
                                    class="text-danger"> *</i></label>
                            <div class="col-sm-9">
                                <input name="name" class="form-control" type="text"
                                    placeholder="<?php echo display('name') ?>" id="name" required>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <label for="ordering"
                                class="col-sm-3 col-form-label"><?php echo display('ordering'); ?></label>
                            <div class="col-sm-9">
                                <select class="form-control ordering placeholder-single" id="ordering"
                                    data-placeholder="-- select one --" name="ordering">
                                    <option value=""></option>
                                    <?php for ($i = 1; $i < 51; $i++) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> -->
                        <!-- <div class="form-group row">
                            <label for="category_type" class="col-sm-3 col-form-label"><?php echo 'Category Type' ?><i
                                    class="text-danger"> *</i></label>
                            <div class="col-sm-9">
                                <select name="category_type" class="form-control placeholder-single" id="category_type">
                                    <option value="1" selected><?php echo html_escape("Is Course"); ?></option>
                                </select>
                            </div>
                        </div> -->
                        <input type="hidden" name="category_type" id="category_type" value="1">
                        <div class="form-group row">
                            <label for="icon" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div class="checkbox checkbox-success">
                                    <input id="is_popular" type="checkbox" class="is_popular" value="1">
                                    <label for="is_popular"><?php echo 'Add to Explore'; ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-3 col-form-label"><?php echo display('image') ?></label>
                            <div class="col-sm-9">
                                <div>
                                    <input type="file" name="image" id="image" class="custom-input-file"
                                        onchange="fileValueOne(this,'category')" />
                                    <label for="image">
                                        <i class="fa fa-upload"></i>
                                        <span class="filename"><?php echo display('choose_file'); ?>…</span>
                                    </label>
                                </div>
                                <span class="text-danger">Size:( 966x180 ) Formats:(png,jpeg,jpeg)</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div>
                                    <img id="image-preview-category" src="" alt="" class="border border-2"
                                        width="200px">
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="button" onclick="category_save()"
                                class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>


                </div>
            </div>
        </div>

    </div>
    <!-- Inline form -->
</div>
<br>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?>
                    <small class="float-right">
                        <!-- Button to Open the Modal -->
                        <?php if ($this->permission->check_label('category')->create()->access()) { ?>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                            Add Category
                        </button>
                        <?php } ?>
                        <!-- The Modal -->
                    </small>
                </h4>

            </div>
            <div class="card-body">

                <div class="result_load">
                    <div class="table-responsive">
                    <table class="table display table-bordered table-striped table-hover bg-white m-0 "
                        id="categorylist">
                        <thead>
                            <tr>
                                <th width="10%"><?php echo display('sl') ?></th>
                                <th width="20%"><?php echo display('category') ?></th>
                                <th width="10%"><?php echo display('ordering') ?></th>
                                <th width="15%"><?php echo display('created_date') ?></th>
                                <th width="15%"><?php echo display('created_by') ?></th>
                                <th width="10%"><?php echo display('updated_date') ?></th>
                                <th width="10%"><?php echo display('updated_by') ?></th>
                                <th width="10%" class="text-center"><?php echo display('action') ?></th>
                            </tr>
                        </thead>

                    </table>
                </div>
                </div>
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
<input type='hidden' id='total_category' value='<?php echo $total_category; ?>'>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/category.js') ?>"></script>
