<form action="" method="post">
    <div class="form-group row">
        <label for="edit_featurtitle" class="col-sm-3 col-form-label"><?php echo display('title') ?> <i class="text-danger">
                *</i></label>
        <div class="col-sm-6">
            <input name="edit_featurtitle" type="text" class="form-control" id="edit_featurtitle"
                placeholder="<?php echo display('title') ?>" value="<?php echo html_escape($featuredin_edit->name); ?>"
                required>
        </div>
    </div>
    <div class="form-group row">
        <label for="edit_featurelink" class="col-sm-3 col-form-label"><?php echo display('link') ?> <i class="text-danger"> *
            </i></label>
        <div class="col-sm-6">
            <input name="edit_featurelink" class="form-control" type="text" placeholder="<?php echo display('link') ?>"
                id="edit_featurelink" value="<?php echo html_escape($featuredin_edit->link); ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="c_link" class="col-sm-3 col-form-label"><?php echo display('summary') ?> <i class="text-danger"> </i></label>
        <div class="col-sm-6">
            <textarea name="edit_featuresummary" class="form-control" placeholder="<?php echo display('summary') ?>"
                id="edit_featuresummary"><?php echo html_escape($featuredin_edit->summary); ?></textarea>
                <span style="padding-left:10px; color: red;">Total word Count :
                                            <span id="edit_display_count" style="font-size:16px; color:black; color: red;">0</span> words
                                            &
                                            <span id="edit_count_left" style="font-size:16px; color:black;  color: red;">15</span> words
                                            left.</span>
        </div>
    </div>

    <div class="form-group row">
        <label for="edit_featureordering" class="col-sm-3 col-form-label"><?php echo display('ordering'); ?> <i class="text-danger"> *</i></label>
        <div class="col-sm-6">
            <select class="form-control edit_featureordering placeholder-single" id="edit_featureordering" data-placeholder="-- select one --"
                name="edit_featureordering">
                <option value="">-- select one --</option>
                <?php for ($i = 1; $i < 5; $i++) { ?>
                <option value="<?php echo $i; ?>" <?php echo (($featuredin_edit->ordering == $i) ? 'selected' : ''); ?>>
                    <?php echo $i; ?>
                </option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="edit_ourfeaturelogo" class="col-sm-3 col-form-label"><?php echo display('image') ?> </label>
        <div class="col-sm-6">
            <!-- <input name="edit_ourfeaturelogo" type="file" class="form-control" id="edit_ourfeaturelogo"
                onchange="fileValueOne(this,'editfeaturedin')"> -->
                <input type="file" name="edit_ourfeaturelogo" id="edit_ourfeaturelogo"
                                                class="custom-input-file" onchange="fileValueOne(this,'editfeaturedin')" />
                <label for="edit_ourfeaturelogo">
                    <i class="fa fa-upload"></i>
                    <span class="editourfeature-filename"><?php echo (!empty($featuredin_edit->picture) ? $featuredin_edit->filename :  display('choose_file'). '...'); ?></span>
                </label>

            <span class="text-danger">Size:( 59*59 ) Formats:(png,jpg,jpeg, svg)</span>
            <input type="hidden" name="old_ourfeaturelogo" id="old_ourfeaturelogo"
                value="<?php echo html_escape($featuredin_edit->picture) ?>">
            <input type="hidden" name="old_ourfeature_filename" id="old_ourfeature_filename"
                value="<?php echo html_escape($featuredin_edit->filename) ?>">
            <?php if ($featuredin_edit->picture) { ?>
            <div class="img_border">
                <img src="<?php echo base_url(html_escape($featuredin_edit->picture)); ?>"
                    alt="<?php echo html_escape($featuredin_edit->name); ?>" width="100%">
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-3"></label>
        <div class="col-sm-6">
            <img id="image-preview-editfeaturedin" src="" alt="" class="border border-2" width="200px">
        </div>
    </div>

    <div class="form-group row">
        <div class="offset-4 mb-3">
            <button type="button" class="btn btn-info w-md m-b-5"
                onclick="ourfeature_update('<?php echo $featuredin_edit->featuredin_id; ?>')"><?php echo display('update') ?></button>
        </div>
    </div>
</form>
<script>
var max_count = 15;
$(document).ready(function() {
    var wordCounts = {};
    $("#edit_featuresummary").keyup(function() {
        var matches = this.value.match(/\b/g);
        wordCounts["edit_featuresummary"] = matches ? matches.length / 2 : 0;
        var finalCount = 0;
        $.each(wordCounts, function(k, v) {
            finalCount += v;
        });
        var vl = this.value;
        if (finalCount > max_count) {
            vl = vl.substring(0, vl.length - 1);
            this.value = vl;
        alert("Must be "+max_count+" word limited!");
        }
        var countleft = parseInt(max_count - finalCount);

        $('#edit_display_count').html(finalCount);
        $('#edit_count_left').html(countleft);

    });
    $("#edit_featuresummary").bind('change paste',function() {
        var matches = this.value.match(/\b/g);
        wordCounts["edit_featuresummary"] = matches ? matches.length / 2 : 0;
        var finalCount = 0;
        $.each(wordCounts, function(k, v) {
            finalCount += v;
        });
        var vl = this.value;
        var countleft = parseInt(max_count - finalCount);
        if (finalCount > max_count) {
            $("#edit_featuresummary").val('');
        }

        $('#edit_display_count').html(finalCount);
        $('#edit_count_left').html(countleft);
    });

    $("body").on("change", "#edit_ourfeaturelogo", function (e) {
      var filename = e.target.files[0].name;
      $(".editourfeature-filename").text(filename);
    });

});
</script>