<?php echo form_open_multipart('javascript:void', 'class="myform" id="myform"'); ?>
<div class="form-group row">
    <label for="share_percent" class="col-sm-3 col-form-label"><?php echo display('share_percent') ?><i
            class="text-danger"> *</i></label>
    <div class="col-sm-8">
        <input name="share_percent" class="form-control" type="number" min="1"
            value="<?php echo (!empty($edit_data->share_percent) ? $edit_data->share_percent : ''); ?>"
            placeholder="<?php echo display('share_percent') ?>" id="share_percent" required>
    </div>
</div>
<?php 
    $agreementpaper_name = '';
    if($edit_data->docusign){
        $docusign_explode = explode('/',$edit_data->docusign);
        $agreementpaper = explode('-f-', $docusign_explode[4]);
        $agreementpaper_name = $agreementpaper[1];
    }
    ?>
<?php //if(empty($edit_data->docusign)){?>
<div class="form-group row">
    <label for="docusign" class="col-sm-3 col-form-label">Course Agreement</label>
    <div class="col-sm-8">
        <!-- <div>
            <input type="file" name="docusign" id="docusign" class="custom-input-file"
                onchange="courseagreement('docusign')" />
            <label for="docusign">
                <i class="fa fa-upload"></i>
                <span><?php echo display('choose_file'); ?>…</span>
            </label>
        </div> -->
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="docusign" onchange="courseagreement('docusign')">
            <label class="custom-file-label" for="docusign"><?php echo (!empty($agreementpaper_name) ? $agreementpaper_name : 'Choose file'); ?></label>
        </div>
        <div class="progress-area mt-2"></div>
        <div id="uploadStatus"></div>
    </div>
    <?php
     if($edit_data->docusign){ ?>
    <input type="hidden" id="old_docusign" name="old_docusign"
        value="<?php echo (!empty($edit_data->docusign) ? $edit_data->docusign : '');  ?>">
    <div class="col-sm-4 offset-sm-3" style="margin-right : 30px;">
        <a href="<?php echo base_url($edit_data->docusign); ?>" class="btn btn-info w-md m-b-5 text-white"
            download><?php echo display('download'); ?></a>
            <!-- <span class="d-block"></span> -->
    </div>
    <?php } ?>
    &nbsp;
    <?php if($edit_data->submit_agreement){ ?>
    <div class="col-sm-4">
        <a href="<?php echo base_url($edit_data->submit_agreement); ?>" class="btn btn-success w-md m-b-5 text-white"
            download>Signed Agreement Download</a>
    </div>
    <?php } ?>
</div>
<?php //} ?>

<!-- <div class="form-group row">
    <label for="docusign" class="col-sm-2 col-form-label">Files </label>
    <div class="col-sm-3">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile" multiple>
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
    </div>
</div> -->

<?php if($edit_data->submit_agreement){ ?>
<div class="form-group row">
    <label for="" class="col-sm-3 col-form-label">Signed Agreement <i class="text-danger"> *</i></label>
    <div class="col-sm-8">
        <label for="approved">
            <input type="radio" id="approved" name=signedagreement" onchange="getsignedagreementstatus(2)" value="2"
                <?php echo (($edit_data->agreement_status == 2) ? 'checked' : ''); ?>> Approved
        </label>
        <label for="notapproved">
            <input type="radio" id="notapproved" name=signedagreement" onclick="getsignedagreementstatus(4)" value="4"
                <?php echo (($edit_data->agreement_status == 4) ? 'checked' : ''); ?>> Not Approved
        </label>
    </div>
</div>


<div class="form-group row loadreason">
    <?php if($edit_data->agreement_status == 4){ ?>
    <label for="" class="col-sm-2 col-form-label">Reason <i class="text-danger"> *</i></label>
    <div class="col-sm-5">
        <textarea id="agreement_reason" class="form-control" required
            autofocus><?php echo (!empty($edit_data->agreement_reason) ? $edit_data->agreement_reason : ''); ?></textarea>
    </div>
    <?php } ?>
</div>
<?php } ?>


<div class="form-group row">
    <label for="docusign" class="col-sm-3 col-form-label">Assign Certificate <i class="text-danger"> *</i></label>
    <div class="col-sm-8">
        <select class="form-control placeholder-single" id="certificate_id" name="certificate_id">
            <option value="">-- select one -- </option>
            <?php foreach($get_templates as $template){ ?>
            <option value="<?php echo $template->id; ?>"
                <?php echo (($edit_data->certificate_id == $template->id) ? 'selected' : ''); ?>>
                <?php echo $template->title; ?> </option>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group align-items-center row">
    <label for="tag" class="col-sm-3 col-form-label"><?php echo "Tags "; ?><i class="text-danger">
            *</i></label>
    <div class="col-sm-8">
        <div class="d-flex">
            <div class="radio">
                <input type="radio" name="tag" id="none" value="0"
                    <?php echo (($edit_data->tagstatus == 0) ? 'checked' : ''); ?>>
                <label for="none" class="mb-0">None</label>
            </div>
            <div class="radio">
                <input type="radio" name="tag" id="recomended" value="1"
                    <?php echo (($edit_data->tagstatus == 1) ? 'checked' : ''); ?>>
                <label for="recomended" class="mb-0">Recommended</label>
            </div>
            <div class="radio">
                <input type="radio" name="tag" id="best_seller" value="2"
                    <?php echo (($edit_data->tagstatus == 2) ? 'checked' : ''); ?>>
                <label for="best_seller" class="mb-0">Best Sellers</label>
            </div>
            <div class="radio">
                <input type="radio" name="tag" id="new" value="3"
                    <?php echo (($edit_data->tagstatus == 3) ? 'checked' : ''); ?>>
                <label for="new" class="mb-0">New Courses</label>
            </div>
            <div class="radio">
                <input type="radio" name="tag" id="popular" value="4"
                    <?php echo (($edit_data->tagstatus == 4) ? 'checked' : ''); ?>>
                <label for="popular" class="mb-0">Most Popular</label>
            </div>

        </div>
    </div>
</div>
<div class="form-group align-items-center row">
    <label for="share_percent" class="col-sm-3 col-form-label"><?php echo "To Explore "; ?><i class="text-danger">
        </i></label>
    <div class="col-sm-8">
        <div class="d-flex">
            <div class="radio">
                <input type="radio" name="toexplore" id="toexplore_yes" value="1"
                    <?php echo (($edit_data->toexplore == 1) ? 'checked' : ''); ?>>
                <label for="toexplore_yes" class="mb-0">Yes</label>
            </div>
            <div class="radio">
                <input type="radio" name="toexplore" id="toexplore_no" value="0"
                    <?php echo (($edit_data->toexplore == 0) ? 'checked' : ''); ?>>
                <label for="toexplore_no" class="mb-0">No</label>
            </div>


        </div>
    </div>
</div>

<div class="form-group row ">
    <div class="offset-3 col-md-2">
        <input type="hidden" name="course_id" id="courseid" value="<?php echo html_escape($course_id); ?>">
        <button type="button" class="btn btn-success w-md m-b-5"
            onclick="sharepercentsave()"><?php echo display('add'); ?></button>
    </div>
</div>
<?php echo form_close(); ?>

<script>
$(document).ready(function() {
    $(".placeholder-single").select2();

    $(".custom-file-input").on("change", function() {
        var files = Array.from(this.files)
        var fileName = files.map(f => {
            return f.name
        }).join(", ")
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
});
</script>