<form action="" method="post">
    <div class="form-group row">
        <label for="template_title" class="col-sm-3 col-form-label"><?php echo display('title') ?> <i class="text-danger">
                *</i></label>
        <div class="col-sm-9">
            <input name="title" type="text" class="form-control" id="edit_template_title"
                placeholder="<?php echo display('title') ?>"
                value="<?php echo (!empty($template_edit->title) ? $template_edit->title : ''); ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="template_type" class="col-sm-3 col-form-label"><?php echo display('type') ?> <i class="text-danger"> *</i></label>
        <div class="col-sm-9">
            <select class="form-control placeholder-single" id="edit_template_type" name="template_type"
                data-placeholder="-- select one --">
                <option value=""></option>
                <option value="certificate"
                    <?php echo (($template_edit->template_type == 'certificate') ? 'selected' : ''); ?>>
                    <?php echo display('certificate'); ?></option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="template_body" class="col-sm-3 col-form-label"><?php echo display('template_body') ?> <i class="text-danger">
                *</i></label>
        <div class="col-sm-9">
            <textarea name="template_body" rows="10" class="form-control" id="edit_template_body"
                placeholder="<?php echo display('template_body') ?>"
                required><?php echo (!empty($template_edit->template_body) ? $template_edit->template_body : ''); ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="template_body" class="col-sm-3">&nbsp</label>
        <div class="col-sm-9">
            <div class="text-danger">
                For Certificate : [name][summary][certificate_name][date][logo][signature]
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="image" class="col-sm-3 col-form-label"><?php echo display('logo') ?></label>
        <div class="col-sm-9">
            <div>
                <input type="file" name="image" id="image" class="custom-input-file"
                    onchange="fileValueOne(this,'logo')" />
                <label for="image">
                    <i class="fa fa-upload"></i>
                    <span><?php echo display('choose_file'); ?>…</span>
                </label>
            </div>
            <?php if ($template_edit->logo) { ?>
            <div class="mt-3">
                <img src="<?php echo base_url(html_escape($template_edit->logo)); ?>" id="image-preview-logo" alt="<?php echo html_escape($template_edit->title); ?>" class="border border-2" width="200px">
            </div>
            <?php }else{ ?>
                <img src="" id="image-preview-logo" class="border border-2" width="200px">
                <?php } ?>
            <input type="hidden" id="old_logo" value="<?php echo $template_edit->logo; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="signature" class="col-sm-3 col-form-label">Signature</label>
        <div class="col-sm-9">
            <div>
                <input type="file" name="signature" id="signature" class="custom-input-file"
                    onchange="fileValueOne(this,'signature')" />
                <label for="signature">
                    <i class="fa fa-upload"></i>
                    <span><?php echo display('choose_file'); ?>…</span>
                </label>
            </div>
            <?php if ($template_edit->signature) { ?>
            <div class="">
                <img src="<?php echo base_url(html_escape($template_edit->signature)); ?>"
                    alt="<?php echo html_escape($template_edit->title); ?>" id="image-preview-signature" src="" class="border border-2" width="200px">
            </div>
            <?php }else{ ?>
                <img src="" alt="" id="image-preview-signature" src="" class="border border-2" width="200px">
                <?php } ?>
            <input type="hidden" id="old_signature" value="<?php echo $template_edit->signature; ?>">
        </div>
    </div>

    <input type='hidden' value='edit' id='mode'>
    <input type='hidden' value='<?php echo $template_edit->id; ?>' id='id'>
    <div class="form-group row">
        <div class="offset-4 mb-3">
            <button type="button" class="btn btn-info w-md m-b-5"
                onclick="certificateinfo_save()"><?php echo display('update') ?></button>
        </div>
    </div>
</form>
<script>
// =============== its for certificateinfo save ================
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
        // var template_body = $("#edit_template_body").val();      
        var template_body = CKEDITOR.instances["edit_template_body"].getData();
        var old_logo = $("#old_logo").val();
        var old_signature = $("#old_signature").val();
    }

    fd.append("id", id);
    fd.append("mode", mode);
    fd.append("title", title);
    fd.append("template_type", template_type);
    fd.append("template_body", template_body);
    fd.append('old_logo', old_logo);
    fd.append('old_signature', old_signature);
    fd.append("csrf_test_name", CSRF_TOKEN);
    fd.append("image", $("#image")[0].files[0]);
    fd.append("signature", $("#signature")[0].files[0]);

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
            $("#templatemodal_info").modal("hide");
            $("#templatelist").DataTable().ajax.reload();
        },
    });
}
</script>