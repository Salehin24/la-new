<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel">
            <div class="panel-body">

            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Form controls -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?>
                    <small class="float-right">
                        <a href="<?php echo base_url(enterpriseinfo()->shortname . '/certificate-list'); ?>"
                            class="btn btn-success">
                            <?php echo display('certificate_list'); ?>
                        </a>
                    </small>
                </h4>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart("#") ?>
                <div class="form-group row">
                    <label for="template_title" class="col-sm-3 col-form-label"><?php echo display('title') ?> <i
                            class="text-danger">
                            *</i></label>
                    <div class="col-sm-6">
                        <input name="title" type="text" class="form-control" id="template_title"
                            placeholder="<?php echo display('title') ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="template_type" class="col-sm-3 col-form-label"><?php echo display('template_type') ?> <i
                            class="text-danger"> *</i></label>
                    <div class="col-sm-6">
                        <select class="form-control placeholder-single" id="template_type" name="template_type"
                            data-placeholder="-- select one --">
                            <option value=""></option>
                            <!-- <option value="sms"><?php echo display('sms'); ?></option>
                            <option value="email"><?php echo display('email'); ?></option> -->
                            <option value="certificate" selected><?php echo display('certificate'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="template_body" class="col-sm-3 col-form-label"><?php echo display('template_body') ?> <i
                            class="text-danger"> *</i></label>
                    <div class="col-sm-6">
                        <textarea name="template_body" rows="10" class="form-control" id="template_body"
                            placeholder="<?php echo display('template_body') ?>" required></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="template_body" class="col-sm-3">&nbsp</label>
                    <div class="col-sm-6">
                        <div class="text-danger">
                            For Certificate : [name][summary][certificate_name][date]
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-sm-3 col-form-label"><?php echo display('image') ?></label>
                    <div class="col-sm-6">
                        <div>
                            <!-- checkfileExtesion() -->
                            <input type="file" name="image" id="image" class="custom-input-file"
                                onchange="fileValueOne(this,'logo')" />
                            <label for="image">
                                <i class="fa fa-upload"></i>
                                <span><?php echo display('choose_file'); ?>…</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="image" class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <div>
                            <img id="image-preview-logo" src="" alt="" class="border border-2" width="200px">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="offset-4 mb-3">
                        <button type="button" class="btn btn-info w-md m-b-5"
                            onclick="certificateinfo_save()"><?php echo display('save') ?></button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <!-- Inline form -->

</div>

<script>
// =============== its for templateinfo save ================
("use sctrict");

function certificateinfo_save() {
    var productmode = $("#productmode").val();
    if (productmode == "demo") {
        toastrWarningMsg("It is disabled for demo mode!");
        return false;
    }

    var fd = new FormData();
    var id = $("#id").val();
    var mode = $("#mode").val();
    var title = $("#template_title").val();
    var template_type = $("#template_type").val();
    var template_body = $("#template_body").val();
    if (mode == "edit") {
        var title = $("#edit_template_title").val();
        var template_type = $("#edit_template_type").val();
        var template_body = $("#edit_template_body").val();
    }

    fd.append("id", id);
    fd.append("mode", mode);
    fd.append("title", title);
    fd.append("template_type", template_type);
    fd.append("template_body", template_body);
    fd.append("csrf_test_name", CSRF_TOKEN);
    fd.append("image", $("#image")[0].files[0]);

    if (title == "") {
        $("#title").focus();
        toastrErrorMsg("Title must be required!");
        return false;
    }

    if (template_type == "") {
        $("#template_type").focus();
        toastrErrorMsg("Template type must be required!");
        return false;
    }
    if (template_body == "") {
        $("#template_body").focus();
        toastrErrorMsg("Template body must be required!");
        return false;
    }

    $.ajax({
        url: base_url + enterprise_shortname + "/certificateinfo-save",
        type: "POST",
        data: fd,
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        success: function(r) {
            toastrSuccessMsg(r);
            $("#template_title").val("");
            $("#template_body").val("");
        },
    });
}
</script>