<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel">
            <div class="panel-body">
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
                    ?>
                </div>
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
                        <a href="<?php echo base_url(enterpriseinfo()->shortname . '/email-list'); ?>"
                            class="btn btn-success">
                            <?php echo display('email_list'); ?>
                        </a>
                    </small>
                </h4>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart(enterpriseinfo()->shortname."/send-email") ?>
                <div class="form-group row">
                    <label for="title" class="col-sm-3 col-form-label">Subject <i class="text-danger">
                            *</i></label>
                    <div class="col-sm-6">
                        <input name="title" type="text" class="form-control" id="title" placeholder="Subject" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="type" class="col-sm-3 col-form-label"><?php echo display('type') ?> <i
                            class="text-danger"> *</i></label>
                    <div class="col-sm-6">
                        <select class="form-control placeholder-single" id="type" name="type"
                            data-placeholder="-- select one --" onchange="get_loadusers(this.value)" required>
                            <option value=""></option>
                            <option value="4"><?php echo display('students'); ?></option>
                            <option value="5"><?php echo display('instructor'); ?></option>
                            <option value="6">Others</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sendto" class="col-sm-3 col-form-label">To<i class="text-danger">
                        </i></label>
                    <div class="col-sm-6">
                        <div id="loadusers">
                            <!-- <select class="form-control placeholder-single" id="loadusers" name="sendto[]"
                                data-placeholder="-- select one --" multiple required>
                                <option value=""></option>
                            </select> -->
                        </div>
                    </div>
                </div>
                <div class="form-group row bcc-div">
                    <label for="bccsendto" class="col-sm-3 col-form-label">Bcc<i class="text-danger">
                        </i></label>
                    <div class="col-sm-6">
                        <div id="loadbccusers">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="message" class="col-sm-3 col-form-label"><?php echo display('message') ?> <i
                            class="text-danger"> *</i></label>
                    <div class="col-sm-6">
                        <textarea name="message" rows="10" class="form-control" id="message"
                            placeholder="<?php echo display('message') ?>" required></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="attachment" class="col-sm-3 col-form-label"><?php echo display('attachment') ?></label>
                    <div class="col-sm-6">
                        <div>
                            <input type="file" name="attachment" id="attachment" class="custom-input-file"
                                onchange="uploadProgress('attachment')" />
                            <label for="attachment">
                                <i class="fa fa-upload"></i>
                                <span class="filename"><?php echo display('choose_file'); ?>…</span>
                            </label>
                        </div>
                        <!-- Progress bar -->
                        <div class="progress-area mt-2"></div>
                        <!-- Display upload status -->
                        <div id="uploadStatus"></div>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="offset-4 mb-3">
                        <button type="submit"
                            class="btn btn-info w-md m-b-5 sendmailvalidation"><?php echo display('send') ?></button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <!-- Inline form -->

</div>

<script>
$(document).ready(function() {
    CKEDITOR.replace('message', {
        toolbarGroups: [{
                "name": "basicstyles",
                "groups": ["basicstyles"]
            },
            // {  "name": "links",  "groups": ["links"] },
            // {  "name": "paragraph", "groups": ["list", "blocks"] },
            // {   "name": "document",  "groups": ["mode"] },
            // {  "name": "insert",  "groups": ["insert"]  },
            {
                "name": "styles",
                "groups": ["styles"]
            },
            // {     "name": "about",   "groups": ["about"] }
        ],
        // Remove the redundant buttons from toolbar groups defined above.
        // removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
    });


    $("body").on("click", ".sendmailvalidation", function() {
        var sendto = $("#sendto").val();
        var bccsendto = $("#bccsendto").val();
        // alert(sendto);
        // alert(bccsendto);
        if (sendto == '' && bccsendto == '') {
            toastrErrorMsg("Sender name must be required!");
            return false;
        }
    });

    $("body").on("change", "#attachment", function (e) {
      var filename = e.target.files[0].name;
      $(".filename").text(filename);
    });
});

// ============ its for get_loadusers =============
"use strict";

function get_loadusers(type) {
    var fd = new FormData();
    var enterprise_id = $("#enterprise_id").val();

    fd.append("csrf_test_name", CSRF_TOKEN);
    fd.append("type", type);
    fd.append("enterprise_id", enterprise_id);
    $.ajax({
        url: base_url + enterprise_shortname + "/get-loadusers",
        type: "POST",
        data: fd,
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        success: function(r) {
            $("#loadusers").html(r);
            $(".placeholder-single").select2();
        }
    });
    $.ajax({
        url: base_url + enterprise_shortname + "/get-loadbccusers",
        type: "POST",
        data: fd,
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        success: function(r) {
            $("#loadbccusers").html(r);
            $(".placeholder-single").select2();
        }
    });
}

$(".bcc-div").hide();

function loadbccusers() {
    $(".bcc-div").show(300);
}


// =============== its for templateinfo save ================
// ("use sctrict");
// function certificateinfo_save() {
//     var productmode = $("#productmode").val();
//     if (productmode == "demo") {
//         toastrWarningMsg("It is disabled for demo mode!");
//         return false;
//     }

//     var fd = new FormData();
//     var id = $("#id").val();
//     var mode = $("#mode").val();
//     var title = $("#template_title").val();
//     var template_type = $("#template_type").val();
//     var template_body = $("#template_body").val();
//     if (mode == "edit") {
//         var title = $("#edit_template_title").val();
//         var template_type = $("#edit_template_type").val();
//         var template_body = $("#edit_template_body").val();
//     }

//     fd.append("id", id);
//     fd.append("mode", mode);
//     fd.append("title", title);
//     fd.append("template_type", template_type);
//     fd.append("template_body", template_body);
//     fd.append("csrf_test_name", CSRF_TOKEN);
//     fd.append("image", $("#image")[0].files[0]);

//     if (title == "") {
//         $("#title").focus();
//         toastrErrorMsg("Title must be required!");
//         return false;
//     }

//     if (template_type == "") {
//         $("#template_type").focus();
//         toastrErrorMsg("Template type must be required!");
//         return false;
//     }
//     if (template_body == "") {
//         $("#template_body").focus();
//         toastrErrorMsg("Template body must be required!");
//         return false;
//     }

//     $.ajax({
//         url: base_url + enterprise_shortname + "/certificateinfo-save",
//         type: "POST",
//         data: fd,
//         enctype: "multipart/form-data",
//         processData: false,
//         contentType: false,
//         success: function(r) {
//             toastrSuccessMsg(r);
//             $("#template_title").val("");
//             $("#template_body").val("");
//         },
//     });
// }
</script>