<?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
<div class="form-group row">
    <label for="lesson_name" class="col-sm-3 col-form-label"><?php echo display('lesson_name') ?><i class="text-danger">
            *</i></label>
    <div class="col-sm-8">
        <input name="lesson_name" class="form-control" type="text" placeholder="<?php echo display('lesson_name') ?>"
            id="lesson_name" required>
    </div>
</div>
<div class="form-group row">
    <label for="section_id" class="col-sm-3 col-form-label"><?php echo display('section_name') ?><i class="text-danger">
            *</i></label>
    <div class="col-sm-8">
        <select name="section_id" class="form-control placeholder-single" id="section_id"
            data-placeholder="<?php echo display('select_one'); ?>">
            <option value=""><?php echo display('select_one'); ?></option>
            <?php foreach ($course_wise_section as $single) { ?>
            <option value="<?php echo html_escape($single->section_id); ?>">
                <?php echo html_escape($single->section_name); ?>
            </option>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="lesson_type" class="col-sm-3 col-form-label"><?php echo display('lesson_type') ?><i class="text-danger">
            *</i></label>
    <div class="col-sm-8">
        <select name="lesson_type" class="form-control placeholder-single" id="lesson_type"
            onchange="lessontype(this.value)" data-placeholder="<?php echo display('select_one'); ?>">
            <option value=""><?php echo display('select_one'); ?></option>
            <option value="1"><?php echo display('video'); ?></option>
            <option value="2"><?php echo 'Docx file'; ?></option>
            <option value="3"><?php echo display('picture'); ?></option>
            <option value="4"><?php echo display('pptx'); ?></option>
            <option value="5"><?php echo display('pdf'); ?></option>
        </select>
        <input type="hidden" class="lessontype_status" id="lessontype_status">
    </div>
</div>

<div class="" id="show"></div>
<div class="" id="providershow"></div>

<label class="col-sm-3 col-form-label"></label>
<div class="uploadStatus offset-3 col-sm-8"></div>
<div class="progress-area offset-3 col-sm-8 mb-3"></div>

<div class="form-group row">
    <label for="lesson_summary" class="col-sm-3 col-form-label"><?php echo display('summary') ?><i class="text-danger">
        </i></label>
    <div class="col-sm-8">
        <textarea name="summary" class="form-control" placeholder="<?php echo display('summary') ?>"
            id="lesson_summary"></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="lesson_description" class="col-sm-3 col-form-label"><?php echo display('description') ?><i
            class="text-danger"> </i></label>
    <div class="col-sm-8">
        <textarea name="description" class="form-control" placeholder="<?php echo display('description') ?>"
            id="lesson_description"></textarea>
    </div>
</div>
<div class="form-group row">
    <div class="offset-3 checkbox checkbox-success">
        <input id="is_preview" type="checkbox" name="is_preview" value="0">
        <label for="is_preview"><?php echo display('is_preview'); ?></label>
    </div>
</div>
<div class="form-group row">
    <label for='resource' class='col-sm-3 col-form-label'>Resource</label>
    <div class='col-sm-7' id="lessonresource_area">
        <div class="row" id="lessonresource-removediv-1">
            <div class="col-sm-10">
                <input type='file' name='lessonresource[]' id='lessonresource_1'
                    onchange="resourcefileuploaderprogress('1', 'lessonresource_1', 'resource-uploadStatus-1', 'resource-progress-area-1')"
                    class='custom-input-file'>
                <label for='lessonresource_1'><i class='fa fa-upload'></i><span class='res-filename-1'>Choose a file ...</span> </label>
                <br>
            </div>
            <div class="col-sm-2">
                <button type='button' class='btn btn-danger btn-sm custom_btn mt-2' name='button'
                    onclick='removelessonResource(1)'> <i class='fa fa-minus'></i> </button>
            </div>

            <div class="resource-uploadStatus-1 col-sm-8"></div>
            <div class="resource-progress-area-1 col-sm-8 mb-3"></div>
        </div>


    </div>
    <div class="col-sm-2">
        <input type="hidden" id="lessonresource_sl" value="1">
        <a href="javascript:void(0)" class="btn btn-success text-white btn-sm custom_btn mt-2"
            onclick="appendAddlessonresource()"><i class="fa fa-plus"></i>
        </a>
    </div>
</div>

<div class="form-group row " id="RemoveLessonButton">
    <div class="offset-3 col-md-2">
        <button type="button" class="btn btn-success text-white w-md m-b-5"
            onclick="lessonsave('<?php echo html_escape($course_id); ?>')"><?php echo display('save'); ?></button>
    </div>
</div>
<?php echo form_close(); ?>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/course.js?v=2') ?>"></script>
<script src="<?php //echo base_url('assets/plugins/ckeditor/ckeditor.active.js'); ?>"></script>

<!-- <input type='file' name='lesson_vfiles' id='lesson_vfiles' size='5' /> -->
<!-- Duration: <input type='text' name='f_du' id='f_du' size='5' /> seconds<br>
 Duration: <input type='text' name='f_dus' id='f_dus' size='5' /> seconds<br> 
<audio id='audio'></audio> -->

<script>
// var f_duration =0;
// document.getElementById('audio').addEventListener('canplaythrough', function(e){
//  f_duration = Math.round(e.currentTarget.duration);
// //  convert duration hour min sec
//  convertHMS(f_duration)
//  document.getElementById('f_du').value = f_duration;
//  URL.revokeObjectURL(obUrl);
// });
// var obUrl;
// document.getElementById('lesson_vfiles').addEventListener('change', function(e){
//  var file = e.currentTarget.files[0];
//  //check file extension for audio/video type
//  if(file.name.match(/\.(avi|mp3|mp4|mpeg|ogg)$/i)){
//  obUrl = URL.createObjectURL(file);
//  document.getElementById('audio').setAttribute('src', obUrl);
//  }
// });

// function convertHMS(value) {
//     const sec = parseInt(value, 10); // convert value to number if it's string
//     let hours   = Math.floor(sec / 3600); // get hours
//     let minutes = Math.floor((sec - (hours * 3600)) / 60); // get minutes
//     let seconds = sec - (hours * 3600) - (minutes * 60); //  get seconds
//     // add 0 if value < 10; Example: 2 => 02
//     if (hours   < 10) {hours   = "0"+hours;}
//     if (minutes < 10) {minutes = "0"+minutes;}
//     if (seconds < 10) {seconds = "0"+seconds;}
//    let convertime=  hours+':'+minutes+':'+seconds; // Return is HH : MM : SS
//     $('#duration').val(convertime);
// }
</script>


<script>
$(document).ready(function() {

    CKEDITOR.replace('lesson_description', {
        toolbarGroups: [{
                "name": "basicstyles",
                "groups": ["basicstyles"]
            },
            {
                "name": "links",
                "groups": ["links"]
            },
            {
                "name": "paragraph",
                "groups": ["list", "blocks"]
            },
            {
                "name": "document",
                "groups": ["mode"]
            },
            {
                "name": "insert",
                "groups": ["insert"]
            },
            {
                "name": "styles",
                "groups": ["styles"]
            },
            {
                "name": "about",
                "groups": ["about"]
            }
        ],
        // Remove the redundant buttons from toolbar groups defined above.
        removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
    });

    $("body").on('change', '#attachment', function(e) {
        var filename = e.target.files[0].name;
        $(".choose-lessonttype-title").text(filename);
    });


});



("use strict");
// var r = resource_sl;
function appendAddlessonresource() {
    var lessonresource_sl = $("#lessonresource_sl").val();

    var resource_sl = +lessonresource_sl + +1;
    //   alert(resource_sl);
    $("#lessonresource_sl").val(resource_sl);

    var attachment = ''+resource_sl+', "lessonresource_' + resource_sl + '", "resource-uploadStatus-' + resource_sl +
        '", "resource-progress-area-' + resource_sl + '"';


    $("#lessonresource_area").append(
        "<div class='row mt-2' id='lessonresource-removediv-" + resource_sl + "'>\n\
          <div class='col-sm-10'>\n\
              <input type='file' name='lessonresource[]' id='lessonresource_" + resource_sl +
        "' onchange='resourcefileuploaderprogress(" +
        attachment + ")' class='custom-input-file'>\n\
              <label for='lessonresource_" + resource_sl +
        "'><i class='fa fa-upload'></i><span class='res-filename-" + resource_sl +"'>Choose a file ...</span></label>\n\
              <br>\n\
          </div>\n\
          <div class='col-sm-2'>\n\
              <button type='button' class='btn btn-danger btn-sm custom_btn mt-2' name='button' onclick='removelessonResource(" +
        resource_sl + ")'> <i class='fa fa-minus'></i> </button>\n\
          </div>\n\
        <div class='resource-uploadStatus-" + resource_sl + " col-sm-8'></div>\n\
        <div class='resource-progress-area-" + resource_sl + " col-sm-8 mb-3'></div>\n\
      </div>\n\
      ");
    // }
}

("use strict");

function removelessonResource(sl) {
    var div = document.getElementById("lessonresource-removediv-" + sl);
    div.parentNode.removeChild(div);
}
</script>