<script src="<?php echo base_url('application/modules/dashboard/assets/js/course.js?v=2') ?>"></script>
<?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
<div class="form-group row">
    <label for="lesson_name" class="col-sm-3 col-form-label"><?php echo display('lesson_name') ?><i class="text-danger">
            *</i></label>
    <div class="col-sm-8">
        <input name="lesson_name" class="form-control" type="text" placeholder="<?php echo display('lesson_name') ?>"
            id="lesson_name" value="<?php echo html_escape($lesson_editdata->lesson_name); ?>">
    </div>
</div>
<div class="form-group row">
    <label for="section_name" class="col-sm-3 col-form-label"><?php echo display('section_name') ?><i
            class="text-danger"> *</i></label>
    <div class="col-sm-8">
        <select name="section_id" class="form-control placeholder-single" id="section_id"
            data-placeholder="<?php echo display('select_one'); ?>">
            <option value=""><?php echo display('select_one'); ?></option>
            <?php foreach ($course_wise_section as $single) { ?>
            <option value="<?php echo html_escape($single->section_id); ?>" <?php
                    if ($lesson_editdata->section_id == $single->section_id) {
                        echo "selected";
                    }
                    ?>>
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
            <option value="1" <?php
                if ($lesson_editdata->lesson_type == 1) {
                    echo "selected";
                }
                ?>><?php echo display('video'); ?></option>
            <option value="2" <?php
                if ($lesson_editdata->lesson_type == 2) {
                    echo "selected";
                }
                ?>><?php echo 'Docx file'; ?></option>
            <option value="3" <?php
                if ($lesson_editdata->lesson_type == 3) {
                    echo "selected";
                }
                ?>><?php echo display('picture'); ?></option>
            <option value="4" <?php
                if ($lesson_editdata->lesson_type == 4) {
                    echo "selected";
                }
                ?>><?php echo display('pptx'); ?></option>
            <option value="5" <?php
                if ($lesson_editdata->lesson_type == 5) {
                    echo "selected";
                }
                ?>><?php echo display('pdf'); ?></option>
        </select>
        <input type="hidden" class="lessontype_status" id="lessontype_status" value="<?php
            if ($lesson_editdata->lesson_type == 1) {
                echo 'video';
            } elseif ($lesson_editdata->lesson_type == 2 || $lesson_editdata->lesson_type == 3) {
                echo 'attach';
            }
            ?>">
    </div>
</div>
<div class="form-group row" id="show">
    <?php if ($lesson_editdata->lesson_type == 1) { ?>
    <input type="hidden" id="lesson_provider" value="2">
    <!-- <label for='lesson_provider' class='col-sm-3 col-form-label'><?php echo display('lesson_provider') ?></label>?>
            <div class='col-sm-8'>
    
                <select name='lesson_provider' class='form-control placeholder-single' id='lesson_provider' data-placeholder='<?php echo display('select_one'); ?>' onchange='lessonprovider(this.value)'>
                    <option value=''></option>
                    <option value='1' <?php
                    if ($lesson_editdata->lesson_provider == 1) {
                        echo 'selected';
                    }
                    ?>><?php echo display('youtube'); ?></option>
                    <option value='2' <?php
                    if ($lesson_editdata->lesson_provider == 2) {
                        echo 'selected';
                    }
                    ?>><?php echo display('vimeo'); ?></option>
                </select>
            </div>  -->
    <?php
        }
        if ($lesson_editdata->lesson_type == 2 || $lesson_editdata->lesson_type == 3) {
            ?>
    <label for='attachment' class='col-sm-3 col-form-label'><?php echo display('attachment') ?></label>
    <div class='col-sm-8'>
        <!-- attachment   uploadStatus   progress-area -->
        <input type='file' name='attachment' id='attachment' class='custom-input-file'
            onchange='fileuploaderprogress("attachment", "uploadStatus", "progress-area")'>
        <label for='attachment'><i class='fa fa-upload'></i>
            <span
                class='choose-lessonttype-title'><?php echo (!empty($lesson_editdata->filename) ? $lesson_editdata->filename : display('choose_file').'...'); ?>
            </span></label>
    </div>

    <div class="offset-3 img_border">
        <?php if ($lesson_editdata->lesson_type == 3) { ?>
        <img src="<?php echo base_url(html_escape($lesson_editdata->picture)); ?>"
            alt="<?php echo html_escape($lesson_editdata->lesson_name); ?>">
        <?php
                }
                if ($lesson_editdata->lesson_type == 2) {
                    ?>
        <i class="far fa-file-pdf"></i>
        <?php } ?>
    </div>
    <?php } ?>
</div>
<div class="" id="providershow">
    <?php if ($lesson_editdata->lesson_provider == 1 || $lesson_editdata->lesson_provider == 2) { 
        ?>
    <div class='form-group row'>
        <label for='provider_url' class='col-sm-3 col-form-label'><?php echo display('provider_url') ?></label>
        <div class='col-sm-8'>
            <input type='hidden' class='form-control' id='oldprovider_url' name='oldprovider_url'
                value="<?php echo html_escape($lesson_editdata->provider_url); ?>">
            <input type='hidden' class='form-control' id='provider_url' name='provider_url'
                value="<?php echo html_escape($lesson_editdata->provider_url); ?>">
            <input type='file' class='form-control fileuploaders' id='lesson_vfile' name='lesson_vfiles'
                onchange='lessonhandleFileSelect(this)' accept='video/*'>
            <!-- <i id='loader-icons' class='fas fa-spinner fa-spin'>&nbsp;</i> -->
            <div id='progress-container_lesson' class='progress mt-3' style='display:none'>
                <div id='progress_lesson' class='progress-bar progress-bar-info progress-bar-striped active'
                    role='progressbar' aria-valuenow='46' aria-valuemin='0' aria-valuemax='100' style='width: 0%'>
                    &nbsp;0%</div>
            </div>
        </div>
        <div class="col-sm-1" id="lesson_delete_content" style="display:none;">
            <a class="btn btn-danger text-capitalize" style="width:60px;" href="javascript:void(0)"
                onclick="cancel_lesson_video()">cancel</a>
        </div>
    </div>
</div>

<label class="col-sm-3 col-form-label"></label>
<div class="uploadStatus offset-3 col-sm-8"></div>
<div class="progress-area offset-3 col-sm-8 mb-3"></div>

<div class="form-group row m-r">
    <label for="pro_url" class="col-sm-3"> </label>
    <div class="col-sm-6">
        <?php 
                        if(!empty($lesson_editdata->provider_url)){
                        $urldata=$lesson_editdata->provider_url;
                        $ddd= explode('/',$urldata);
                    ?>
        <div id="video_preview">
            <iframe id="iframes" src="https://player.vimeo.com/video/<?php echo (!empty($ddd[3]) ? $ddd[3] : ''); ?>"
                width="400" height="300" frameborder="0" allowfullscreen allow="autoplay; encrypted-media"></iframe>
        </div>
        <?php }?>
    </div>
</div>
<div class='form-group row'>
    <label for='duration' class='col-sm-3 col-form-label'><?php echo display('duration') ?></label>
    <div class='col-sm-8'>
        <input type='text' class='form-control' id='duration' name='duration'
            value="<?php echo html_escape($lesson_editdata->duration); ?>"
            placeholder='<?php echo display('duration'); ?>'>
    </div>
</div>
<?php } ?>
</div>
<div class="form-group row">
    <label for="lesson_summary" class="col-sm-3 col-form-label"><?php echo display('summary') ?><i class="text-danger">
        </i></label>
    <div class="col-sm-8">
        <textarea name="summary" class="form-control" placeholder="<?php echo display('summary') ?>"
            id="lesson_summary"><?php echo html_escape($lesson_editdata->summary); ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="lesson_description" class="col-sm-3 col-form-label"><?php echo display('description') ?><i
            class="text-danger"> </i></label>
    <div class="col-sm-8">
        <textarea name="description" class="form-control" placeholder="<?php echo display('description') ?>"
            id="lesson_description"><?php echo html_escape($lesson_editdata->description); ?></textarea>
    </div>
</div>
<div class="form-group row">
    <div class="offset-3 checkbox checkbox-success">
        <input id="is_preview" type="checkbox" name="is_preview"
            value="<?php echo html_escape((($lesson_editdata->is_preview == 1) ? "$lesson_editdata->is_preview" : '0')); ?>" <?php
            if ($lesson_editdata->is_preview == 1) {
                echo 'checked';
            }
            ?>>
        <label for="is_preview"><?php echo display('is_preview'); ?></label>
    </div>
</div>
<div class="form-group row">
    <label for='resource' class='col-sm-3 col-form-label'>Resource</label>
    <div class='col-sm-7' id="lessonresource_area">
        <?php 
         $r=0;
        foreach($lesson_wise_resource as $resource){
        $r++;
        $lessonresource_filename = '';
        if($resource->files){
            $lessonresourcefile_name=($resource->files);
            $lessonresource_filename = explode('-f-', $lessonresourcefile_name);
            $lessonresource_filename = $lessonresource_filename[1];
        }
         ?>
        <div class="row" id="resource-deleted-sl-<?php echo $resource->id; ?>">
            <div class="col-sm-2" style="margin-top : 15px;">
                <a href="<?php echo base_url($resource->files); ?>" target="_new">
                <i class="fa fa-book-open"></i>
                <?php echo $lessonresource_filename; ?>
            </a>
            </div>
            <div class="col-sm-2">
                <a href="javascript:void(0)" class='btn btn-danger btn-sm custom_btn mt-2' name='button'
                    onclick='deletelessonResource("<?php echo $resource->id; ?>")'>
                    <i class='fa fa-minus'></i></a>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-sm-10">
                <input type='file' name='resource[]' id='resource_<?php echo $r; ?>' onchange="fileuploaderprogress('resource_<?php echo $r; ?>', 'resource-uploadStatus-<?php echo $r; ?>', 'resource-progress-area-<?php echo $r; ?>')" class='custom-input-file'>
                <label for='resource_<?php echo $r; ?>'><i class='fa fa-upload'></i><span>Choose a file ...</span></label>
                <a href="<?php echo base_url($resource->files); ?>" target="_new"><i class="fa fa-book-open"></i></a>
                <input type='text' name='old_resource[]' value="<?php echo $resource->files; ?>">
            </div>
            <div class="col-sm-2">
                <button type='button' class='btn btn-danger btn-sm custom_btn mt-2' name='button'
                    onclick='removeResource(this)'> <i class='fa fa-minus'></i> </button>
            </div>
        </div>
        
        <div class="resource-uploadStatus-<?php echo $r; ?> col-sm-8"></div>
        <div class="resource-progress-area-<?php echo $r; ?> col-sm-8 mb-3"></div> -->

        <?php } ?>

        <div class="row mt-2">
            <div class="col-sm-8">
                <input type='file' name='lessonresource[]' id='resource_<?php echo $r; ?>'
                    onchange="resourcefileuploaderprogress('<?php echo $r; ?>', 'resource_<?php echo $r; ?>', 'resource-uploadStatus-<?php echo $r; ?>', 'resource-progress-area-<?php echo $r; ?>')"
                    class='custom-input-file'>
                <label for='resource_<?php echo $r; ?>'><i class='fa fa-upload'></i><span
                        class='res-filename-<?php echo $r; ?>'>Choose a file
                        ...</span></label>
            </div>
            <div class="col-sm-2">
                <button type='button' class='btn btn-danger btn-sm custom_btn mt-2' name='button'
                    onclick='removeResource(this)'> <i class='fa fa-minus'></i> </button>
            </div>
        </div>

        <div class="resource-uploadStatus-<?php echo $r; ?> col-sm-8"></div>
        <div class="resource-progress-area-<?php echo $r; ?> col-sm-8 mb-3"></div>
    </div>
    <div class="col-sm-2">
        <input type="hidden" id="lessonresource_sl" value="<?php echo $r; ?>">
        <a href="javascript:void(0)" class="btn btn-success text-white btn-sm custom_btn mt-2"
            onclick="appendAddlessonresource()"><i class="fa fa-plus"></i>
        </a>
    </div>
</div>
<div class="form-group row" id="RemoveLessonButton">
    <div class="offset-3 col-md-2">
        <button type="button" class="btn btn-success text-white w-md m-b-5"
            onclick="lessonupdate('<?php echo html_escape($lesson_editdata->lesson_id); ?>')"><?php echo display('update'); ?></button>
    </div>
</div>
<input type='hidden' name='f_dus' id='f_dus' size='5' />
<audio id='audio'></audio>
<?php echo form_close(); ?>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $('.fileuploaders').change(function() {
        $('#video_preview').html('<video style="height:300px;width:400px;" src="' + URL.createObjectURL(
            this.files[0]) + '" controls></video>');
    });

    $("body").on('change', '#attachment', function(e) {
        console.log(e);
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

    var attachment = '' + resource_sl + ', "resource_' + resource_sl + '", "resource-uploadStatus-' + resource_sl +
        '", "resource-progress-area-' + resource_sl + '"';


    $("#lessonresource_area").append(
        "<div class='row mt-2' id='lessonresource-removediv-" + resource_sl + "'>\n\
          <div class='col-sm-10'>\n\
              <input type='file' name='lessonresource[]' id='resource_" + resource_sl +
        "' onchange='resourcefileuploaderprogress(" +
        attachment + ")' class='custom-input-file'>\n\
              <label for='resource_" + resource_sl +
        "'><i class='fa fa-upload'></i><span class='res-filename-" + resource_sl +
        "'>Choose a file ...</span></label>\n\
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