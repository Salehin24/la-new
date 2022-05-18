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
        
        <div class="modal" id="subcategoryModal">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Subcategory</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
                        <div class="form-group row">
                            <label for="sub_name" class="col-sm-3 col-form-label">Subcategory
                                <?php echo display('name') ?> <i class="text-danger"> *</i></label>
                            <div class="col-sm-9">
                                <input name="sub_name" class="form-control" type="text"
                                    placeholder="Subcategory <?php echo display('name') ?>" id="sub_name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="parent_id" class="col-sm-3 col-form-label"><?php echo display('category') ?><i
                                    class="text-danger"> *</i></label>
                            <div class="col-sm-9">
                                <select name="parent_id" class="form-control placeholder-single" id="parent_id"
                                    data-placeholder="<?php echo display('select_one'); ?>">
                                    <option value=""></option>
                                    <?php
                                    foreach ($parent_category as $parent) {
                                    ?>
                                    <option value="<?php echo html_escape($parent->category_id); ?>">
                                        <?php echo html_escape($parent->name); ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <label for="sub_ordering"
                                class="col-sm-3 col-form-label"><?php echo display('ordering'); ?></label>
                            <div class="col-sm-9">
                                <select class="form-control ordering placeholder-single" id="sub_ordering"
                                    data-placeholder="-- select one --" name="ordering">
                                    <option value=""></option>
                                    <?php for ($i = 1; $i < 51; $i++) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> -->
                        <!-- <div class="form-group row">
                            <label for="sub_category_type"
                                class="col-sm-3 col-form-label"><?php echo 'Category Type' ?><i class="text-danger">
                                    *</i></label>
                            <div class="col-sm-9">
                                <select name="category_type" class="form-control placeholder-single"
                                    id="sub_category_type" data-placeholder="<?php echo display('select_one'); ?>">
                                    <option value=""></option>
                                    <option value="1" selected><?php echo html_escape("Is Course"); ?></option>
                                </select>
                            </div>
                        </div> -->
                        <input type="hidden" name="category_type" class="form-control" value="1">
                        <div class="form-group row">
                            <label for="icon" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div class="checkbox checkbox-success">
                                    <input id="sub_is_popular" type="checkbox" class="is_popular" value="1">
                                    <label for="sub_is_popular">Add to Explore</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sub_image"
                                class="col-sm-3 col-form-label"><?php echo display('image') ?></label>
                            <div class="col-sm-9">
                                <div>
                                    <!-- checkfileExtesion() -->
                                    <input type="file" name="image" id="sub_image" class="custom-input-file"
                                        onchange="fileValueTwo(this,'subcategory')" />
                                    <label for="sub_image">
                                        <i class="fa fa-upload"></i>
                                        <span><?php echo display('choose_file'); ?>…</span>
                                    </label>
                                </div>
                                <span class="text-danger">Size:( 966x180) Formats:(png,jpeg,jpeg)</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div>
                                    <img id="image-preview-subcategory" src="" alt="" class="border border-2"
                                        width="200px">
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="button" onclick="subcategory_save()"
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
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#subcategoryModal">
                            Add Subcategory
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
                        id="subcategorylist">
                        <thead>
                            <tr>
                                <th width="10%"><?php echo display('sl') ?></th>
                                <th width="15%"><?php echo display('category') ?></th>
                                <th width="15%"><?php echo display('subcategory') ?></th>
                                <th width="10%"><?php echo display('ordering') ?></th>
                                <th width="10%"><?php echo display('created_date') ?></th>
                                <th width="10%"><?php echo display('created_by') ?></th>
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
<input type='hidden' id='total_subcategory' value='<?php echo $total_subcategory; ?>'>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/category.js') ?>"></script>
<script>
// image preview js 
function fileValueTwo(value, sectionval) {
    // all old preview image hide
    $('.img_border').hide();
    var path = value.value;
    var extenstion = path.split('.').pop();
    if (extenstion == "jpg" || extenstion == "svg" || extenstion == "jpeg" || extenstion == "png" || extenstion ==
        "gif") {
        document.getElementById('image-preview-' + sectionval).src = window.URL.createObjectURL(value.files[0]);
        var filename = path.replace(/^.*[\\\/]/, '').split('.').slice(0, -1).join('.');
        // document.getElementById("filename").innerHTML = filename;
    } else {
        alert("File not supported. Kindly Upload the Image of below given extension ")
    }
}
</script>